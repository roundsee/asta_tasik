<?php
include '../../../../config/koneksi.php';
session_start();
if (!isset($_POST['submit_token']) || $_POST['submit_token'] !== $_SESSION['submit_token']) {
    echo json_encode(['success' => false, 'message' => 'Transaksi duplikat terdeteksi.']);
    echo "<script>alert('Data duplikat.'); history.go(-1);</script>";
    exit;
}
unset($_SESSION['submit_token']);
$employee = $_SESSION['employee_number'];

if (isset($_POST['kode_permintaan'])) {
    $kode_permintaan = mysqli_real_escape_string($koneksi, $_POST['kode_permintaan']);
    $kd_barang = $_POST['kd_barang']; // Array barang
    $tanggal = date("Ymd");
    $qty_terima = $_POST['qty_terima']; // Array jumlah diterima
    $qty_terima = preg_replace('/\D/', '', $qty_terima);
    $qty_satuanArray = $_POST['qty_satuan']; // Array jumlah diterima
    $satuanArray = $_POST['satuan'];
    $kd_cus_penerima = mysqli_real_escape_string($koneksi, $_POST['kd_cus_peminta']); // Customer penerima
    $kd_cus_pengirim = $_POST['kd_cus_pengirim']; // Customer penerima

    echo $kd_cus_pengirim;


    // Cek kode_penerimaan yang sudah ada
    $query_check = "SELECT kode_penerimaan 
                    FROM penerimaan_barang_internal 
                    WHERE kode_permintaan = '$kode_permintaan' 
                    AND kd_cus_penerima = '$kd_cus_penerima'";
    $result_check = mysqli_query($koneksi, $query_check);

    if ($result_check && mysqli_num_rows($result_check) > 0) {
        $data_check = mysqli_fetch_assoc($result_check);
        $kode_penerimaan = $data_check['kode_penerimaan'];
    } else {
        // Generate kode_penerimaan baru
        $query_max = "SELECT MAX(CAST(SUBSTRING_INDEX(kode_penerimaan, '-', -1) AS UNSIGNED)) AS kodeTerbesar 
                      FROM penerimaan_barang_internal 
                      WHERE kode_penerimaan LIKE 'TRM-$tanggal-$kd_cus_penerima-%'";
        $result_max = mysqli_query($koneksi, $query_max);
        $data_max = mysqli_fetch_assoc($result_max);
        $urutan = isset($data_max['kodeTerbesar']) ? (int)$data_max['kodeTerbesar'] : 0;
        $urutan++;

        $kodeUrut = sprintf("%04s", $urutan);
        $kode_penerimaan = "TRM-$tanggal-$kd_cus_penerima-$kodeUrut";

        $query_insert = "INSERT INTO penerimaan_barang_internal (kode_penerimaan, kode_permintaan, kd_cus_penerima) 
                         VALUES ('$kode_penerimaan', '$kode_permintaan', '$kd_cus_penerima')";
        if (!mysqli_query($koneksi, $query_insert)) {
            die("Error insert penerimaan_barang_internal: " . mysqli_error($koneksi));
        }
    }

    // Ambil urut maksimum untuk detail
    $query_max_urut = "SELECT MAX(urut) AS urut_max 
                       FROM penerimaan_barang_detail_internal 
                       WHERE kode_penerimaan = '$kode_penerimaan'";
    $result_urut = mysqli_query($koneksi, $query_max_urut);
    $data_urut = mysqli_fetch_assoc($result_urut);
    $urut = isset($data_urut['urut_max']) ? (int)$data_urut['urut_max'] : 0;

    foreach ($kd_barang as $index => $kode_barang) {
        $urut++;
        $kode_barang = mysqli_real_escape_string($koneksi, $kode_barang);
        $qty = (int)$qty_terima[$index];
        $qty_satuan = (int)$qty_satuanArray[$index];
        $satuan = mysqli_real_escape_string($koneksi, $satuanArray[$index]);

        if ($qty > 0) {
            // Insert detail penerimaan
            $query_detail = "INSERT INTO penerimaan_barang_detail_internal 
                             (kode_penerimaan, kd_cus_penerima, tanggal_penerimaan, kd_barang, qty_diterima, satuan, urut, user_terima) 
                             VALUES ('$kode_penerimaan', '$kd_cus_penerima', '$tanggal', '$kode_barang', $qty, '$satuan', $urut, '$employee')";
            if (!mysqli_query($koneksi, $query_detail)) {
                die("Error insert detail: " . mysqli_error($koneksi));
            }

            // Update qty_diterima di permintaan_barang_detail
            $query_update_qty = "UPDATE permintaan_barang_detail 
                                 SET qty_diterima = qty_diterima + $qty 
                                 WHERE kode_permintaan = '$kode_permintaan' 
                                 AND kd_barang = '$kode_barang' 
                                 AND satuan = '$satuan'";
            if (!mysqli_query($koneksi, $query_update_qty)) {
                die("Error update qty_diterima: " . mysqli_error($koneksi));
            }

            // Update status_item jika qty_diajukan = qty_diterima
            $query_update_status_item = "UPDATE permintaan_barang_detail 
                                         SET status_item = 1 
                                         WHERE kode_permintaan = '$kode_permintaan' 
                                         AND kd_barang = '$kode_barang' 
                                         AND satuan = '$satuan' 
                                         AND qty_diajukan = qty_diterima";
            if (!mysqli_query($koneksi, $query_update_status_item)) {
                die("Error update status_item: " . mysqli_error($koneksi));
            }


            // Mengupdate atau menambah ke inventory untuk si penerimanyaa
            $query_check = "SELECT * FROM inventory WHERE kd_cus = '$kd_cus_penerima' AND kd_brg = '$kode_barang' ";
            $result_check = mysqli_query($koneksi, $query_check);

            if (mysqli_num_rows($result_check) > 0) {
                $query_update = "UPDATE inventory SET 
             stok = stok + ($qty * $qty_satuan)
             WHERE kd_cus = '$kd_cus_penerima' AND kd_brg = '$kode_barang' ";
                $result_update = mysqli_query($koneksi, $query_update);

                if (!$result_update) {
                    die("Query update gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
                }
            } else {
                // Data belum ada, masukkan data baru
                $query_insert = "INSERT INTO inventory (kd_cus,kd_brg,stok,satuan) VALUES (
                 '$kd_cus_penerima', 
                 '$kode_barang',  
                 '$qty' * '$qty_satuan',
                 'Pcs'
             )";

                $result_insert = mysqli_query($koneksi, $query_insert);

                if (!$result_insert) {
                    die("Query insert gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
                }
            }


            //  Ini untuk pengirim mengurangi stok di inventorynya untuk si pengirimnya
            $query_check = "SELECT * FROM inventory WHERE kd_cus = '$kd_cus_pengirim' AND kd_brg = '$kode_barang' ";
            $result_check = mysqli_query($koneksi, $query_check);

            if (mysqli_num_rows($result_check) > 0) {
                $query_update = "UPDATE inventory SET 
             stok = stok - ($qty * $qty_satuan)
             WHERE kd_cus = '$kd_cus_pengirim' AND kd_brg = '$kode_barang' ";
                $result_update = mysqli_query($koneksi, $query_update);

                if (!$result_update) {
                    die("Query update gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
                }
            } else {
                $query_insert = "INSERT INTO inventory (kd_cus,kd_brg,stok,satuan) VALUES (
                 '$kd_cus_pengirim', 
                 '$kode_barang',  
                 -($qty * $qty_satuan),
                 'Pcs'
             )";

                $result_insert = mysqli_query($koneksi, $query_insert);

                if (!$result_insert) {
                    die("Query insert gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
                }
                // echo "<script>alert('Tidak ditemukan Barangnya')</script>";
            }


            // insert atau update ke mutasi stok 

            $query_harga_beli_terbaru = "SELECT harga FROM barang WHERE kd_brg = '$kode_barang'";
            $resutl_harga_beli_terbaru = mysqli_query($koneksi, $query_harga_beli_terbaru);

            if (!$resutl_harga_beli_terbaru) {
                die("Query gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
            }

            // Periksa apakah ada hasil yang dikembalikan
            if (mysqli_num_rows($resutl_harga_beli_terbaru) > 0) {
                $rows = mysqli_fetch_assoc($resutl_harga_beli_terbaru);
                if (isset($rows['harga'])) {
                    $harga_beli_terbaru = $rows['harga'];
                }
            } else {
                $harga_beli_terbaru = 0; // Atau nilai default lain yang sesuai
            }
            $harga_beli_terbaru = is_numeric($harga_beli_terbaru) ? $harga_beli_terbaru : 0;





            // Query untuk mendapatkan data dari tanggal terbaru yang sesuai dengan unit pengirim dan barang sage
            $query_awal = "SELECT 
             tgl AS tgl_terakhir, 
             nilai_akhir AS nilai_awal, 
             qt_akhir AS qty_awal, 
             nilai_beli AS nilai_beli_sebelumnya, 
             qty_beli AS qty_beli_sebelumnya,
             qt_produksi AS qt_produksi_sebelumnya,
             nilai_produksi AS nilai_produksi_sebelumnya,
             qt_terima_int AS qty_terima_sebelumnya,
             nilai_terima_int AS nilai_terima_sebelumnya,
             stok_opname, nilai_opname 
             FROM 
             mutasi_stok  
             WHERE  
             kd_cus = '$kd_cus_pengirim' AND kd_brg = '$kode_barang' 
             ORDER BY 
             tgl_terakhir DESC 
             LIMIT 1";

            $result_awal = mysqli_query($koneksi, $query_awal);

            if (!$result_awal) {
                die("Query untuk mendapatkan nilai awal, qty awal, nilai beli sebelumnya, dan qty beli sebelumnya gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
            }

            if (mysqli_num_rows($result_awal) > 0) {
                $row_awal = mysqli_fetch_assoc($result_awal);
                $nilai_awal = $row_awal['nilai_awal'];
                $qty_awal = $row_awal['qty_awal'];
                $nilai_beli_sebelumnya = $row_awal['nilai_beli_sebelumnya'];
                $qty_beli_sebelumnya = $row_awal['qty_beli_sebelumnya'];
                $qty_produksi_sebelumnya = $row_awal['qt_produksi_sebelumnya'];
                $nilai_produksi_sebelumnya = $row_awal['nilai_produksi_sebelumnya'];
                $qty_terima_sebelumnya = $row_awal['qty_terima_sebelumnya'];
                $nilai_terima_sebelumnya = $row_awal['nilai_terima_sebelumnya'];

                $stok_opname = $row_awal['stok_opname'];
                $nilai_opname = $row_awal['nilai_opname'];
            } else {
                $nilai_awal = 0;
                $qty_awal = 0;
                $nilai_beli_sebelumnya = 0;
                $qty_beli_sebelumnya = 0;
                $stok_opname = 0; // Default jika tidak ada data
                $nilai_opname = 0; // Default jika tidak ada data  
                $qty_produksi_sebelumnya = 0;
                $nilai_produksi_sebelumnya = 0;
                $qty_terima_sebelumnya = 0;
                $nilai_terima_sebelumnya = 0;
            }

            // Tentukan nilai qty_awal
            $qty_awal = $stok_opname != 0 ? $stok_opname : $qty_awal;
            $nilai_awal = $nilai_opname != 0 ? $nilai_opname : $nilai_awal;

            // Validasi untuk memastikan nilai numerik
            $nilai_awal = is_numeric($nilai_awal) ? $nilai_awal : 0;
            $qty_awal = is_numeric($qty_awal) ? $qty_awal : 0;
            $nilai_beli_sebelumnya = is_numeric($nilai_beli_sebelumnya) ? $nilai_beli_sebelumnya : 0;
            $qty_beli_sebelumnya = is_numeric($qty_beli_sebelumnya) ? $qty_beli_sebelumnya : 0;
            $qty_produksi_sebelumnya = is_numeric($qty_produksi_sebelumnya) ? $qty_produksi_sebelumnya : 0;
            $nilai_produksi_sebelumnya = is_numeric($nilai_produksi_sebelumnya) ? $nilai_produksi_sebelumnya : 0;
            $qty_terima_sebelumnya = is_numeric($qty_terima_sebelumnya) ? $qty_terima_sebelumnya : 0;
            $nilai_terima_sebelumnya = is_numeric($nilai_terima_sebelumnya) ? $nilai_terima_sebelumnya : 0;
            $stok_opname = is_numeric($stok_opname) ? $stok_opname : 0;
            $nilai_opname = is_numeric($nilai_opname) ? $nilai_opname : 0;



            // Cek apakah data dengan kombinasi yang sama sudah ada untuk pengirim
            $query_check_pengirim = "SELECT harga_rata FROM mutasi_stok WHERE tgl = '$tanggal' AND kd_cus = '$kd_cus_pengirim' AND kd_brg = '$kode_barang'";
            $result_check_pengirim = mysqli_query($koneksi, $query_check_pengirim);


            if ($result_check_pengirim && mysqli_num_rows($result_check_pengirim) > 0) {
                $row_harga_rata = mysqli_fetch_assoc($result_check_pengirim);
                $harga_rata_pengirim = $row_harga_rata['harga_rata'];
            } else {
                // Tangani kasus tidak ada data yang ditemukan
                $harga_rata_pengirim = $harga_beli_terbaru;
            }



            if (($nilai_awal <= 0 || $qty_awal <= 0)) {
                $harga_rata = $harga_beli_terbaru;
            } else if (($qty_awal + $qty_beli_sebelumnya) != 0) {
                $harga_rata = ($nilai_awal / $qty_awal);
            } else {
                $harga_rata = $harga_beli_terbaru;
            }

            if (!$result_check_pengirim) {
                die("Query gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
            }

            if (mysqli_num_rows($result_check_pengirim) > 0) {
                // Update data yang ada dengan menjumlahkan qt_kirim_int untuk pengirim
                $query_update_pengirim = "UPDATE mutasi_stok SET 
                qt_kirim_int = qt_kirim_int + ($qty * $qty_satuan),
                nilai_kirim_int = nilai_kirim_int +  ('$harga_rata_pengirim' * ($qty * $qty_satuan)),
                qt_akhir = qt_akhir - ($qty * $qty_satuan),
                nilai_akhir = CEIL('$harga_rata_pengirim' *  qt_akhir)
                WHERE tgl = '$tanggal' AND kd_cus = '$kd_cus_pengirim' AND kd_brg = '$kode_barang'";

                // echo "update_pengirim tanpa BOM : " . $query_update_pengirim;
                $result_update_pengirim = mysqli_query($koneksi, $query_update_pengirim);

                if (!$result_update_pengirim) {
                    die("Query update gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
                }
            } else {
                $query_insert_pengirim = "INSERT INTO 
                mutasi_stok (tgl, qty_awal, nilai_awal,qt_tersedia,
                nilai_tersedia,harga_rata, kd_cus, kd_brg, satuan,
                 qt_kirim_int,nilai_kirim_int, qt_akhir, nilai_akhir) VALUES (
                '$tanggal', 
                '$qty_awal',
                '$nilai_awal',
                '$qty_awal',
                '$nilai_awal',
                '$harga_rata',
                '$kd_cus_pengirim', 
                '$kode_barang',  
                'Pcs',
                '$qty '* '$qty_satuan',
                ('$qty' * '$qty_satuan') * $harga_rata,
                '$qty_awal' - ('$qty' * '$qty_satuan'),
                ('$qty_awal' - ('$qty' * '$qty_satuan')) * $harga_rata
            )";


                // echo "<br>";
                // echo "pengiriman biasa tanpa bom ini yang sedang dicari: " . $query_insert_pengirim;
                $result_insert_pengirim = mysqli_query($koneksi, $query_insert_pengirim);

                if (!$result_insert_pengirim) {
                    die("Query insert gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
                }
            }



            // Query untuk mendapatkan data dari tanggal terbaru yang sesuai dengan unit penerima 
            $query_awal = "SELECT 
             tgl AS tgl_terakhir, 
             nilai_akhir AS nilai_awal, 
             qt_akhir AS qty_awal, 
             nilai_beli AS nilai_beli_sebelumnya, 
             qty_beli AS qty_beli_sebelumnya,
             stok_opname, nilai_opname 
             FROM 
             mutasi_stok  
             WHERE  
             kd_cus = '$kd_cus_penerima' AND kd_brg = '$kode_barang' 
             ORDER BY 
             tgl_terakhir DESC 
             LIMIT 1";


            $result_awal = mysqli_query($koneksi, $query_awal);

            if (!$result_awal) {
                die("Query untuk mendapatkan nilai awal, qty awal, nilai beli sebelumnya, dan qty beli sebelumnya gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
            }

            if (mysqli_num_rows($result_awal) > 0) {
                $row_awal = mysqli_fetch_assoc($result_awal);
                $nilai_awal = $row_awal['nilai_awal'];
                $qty_awal = $row_awal['qty_awal'];
                $nilai_beli_sebelumnya = $row_awal['nilai_beli_sebelumnya'];
                $qty_beli_sebelumnya = $row_awal['qty_beli_sebelumnya'];
                $stok_opname = $row_awal['stok_opname'];
                $nilai_opname = $row_awal['nilai_opname'];
            } else {
                $nilai_awal = 0;
                $qty_awal = 0;
                $nilai_beli_sebelumnya = 0;
                $qty_beli_sebelumnya = 0;
                $stok_opname = 0; // Default jika tidak ada data
                $nilai_opname = 0; // Default jika tidak ada data    
            }

            $nilai_beli_sebelumnya = is_numeric($nilai_beli_sebelumnya) ? $nilai_beli_sebelumnya : 0;
            $qty_beli_sebelumnya = is_numeric($qty_beli_sebelumnya) ? $qty_beli_sebelumnya : 0;
            $stok_opname = is_numeric($stok_opname) ? $stok_opname : 0;
            $nilai_opname = is_numeric($nilai_opname) ? $nilai_opname : 0;


            // Tentukan nilai qty_awal
            // $qty_awal = $stok_opname != 0 ? $stok_opname : $qty_awal;
            // $nilai_awal = $nilai_opname != 0 ? $nilai_opname : $nilai_awal;

            // Validasi untuk memastikan nilai numerik
            $nilai_awal = is_numeric($nilai_awal) ? $nilai_awal : 0;
            $qty_awal = is_numeric($qty_awal) ? $qty_awal : 0;
            $nilai_terima_int_newValue = $harga_rata * ($qty * $qty_satuan);
            $qt_terima_intt_newValue = $qty * $qty_satuan;
            if (($nilai_awal <= 0 || $qty_awal <= 0)) {
                $rata_rata_harga_newvalue = $harga_rata;
            } else {
                $rata_rata_harga_newvalue = ($nilai_awal + $nilai_terima_int_newValue) / ($qty_awal +  $qt_terima_intt_newValue);
            }

            // Cek apakah data dengan kombinasi yang sama sudah ada untuk penerima
            $query_check_penerima = "SELECT harga_rata FROM mutasi_stok WHERE tgl = '$tanggal' AND kd_cus = '$kd_cus_penerima' AND kd_brg = '$kode_barang'";
            $result_check_penerima = mysqli_query($koneksi, $query_check_penerima);
            $harga_DB_rata_penerima_tanggal_sama = 0;
            if ($result_check_penerima && mysqli_num_rows($result_check_penerima) > 0) {
                $row_harga_rata_penerima_tanggal_sama = mysqli_fetch_assoc($result_check_penerima);
                $harga_DB_rata_penerima_tanggal_sama = $row_harga_rata_penerima_tanggal_sama['harga_rata'];
            }


            if (($nilai_awal <= 0 || $qty_awal <= 0)) {
                $harga_rata_penerima = $harga_beli_terbaru;
                $harga_rata_penerima_tanggal_sama = $harga_beli_terbaru;
            } else {
                $harga_rata_penerima =  ($nilai_awal + ($harga_beli_terbaru * ($qty * $qty_satuan))) / ($qty_awal + ($qty * $qty_satuan));
                $harga_rata_penerima_tanggal_sama = ($nilai_awal + ($harga_DB_rata_penerima_tanggal_sama * ($qty * $qty_satuan))) / ($qty_awal + ($qty * $qty_satuan));
            }



            if (!$result_check_penerima) {
                die("Query gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
            }

            if (mysqli_num_rows($result_check_penerima) > 0) {
                // Update data yang ada dengan menjumlahkan qt_terima_int dan memperbarui nilai beli dan belinya untuk penerima
                $query_update_penerima = "UPDATE mutasi_stok SET 
                 qt_terima_int = qt_terima_int + ($qty * $qty_satuan), 
                 nilai_terima_int = nilai_terima_int + ('$harga_rata' * ($qty * $qty_satuan)),
                 qt_tersedia = qt_tersedia + ($qty * $qty_satuan),
                 nilai_tersedia = nilai_tersedia + ('$harga_rata' * ($qty * $qty_satuan)),
                 harga_rata = CASE
                     WHEN qt_tersedia <= 0 THEN '$harga_rata'
                     WHEN nilai_tersedia <= 0 THEN '$harga_rata'
                     ELSE '$rata_rata_harga_newvalue'
                 END,
                 qt_akhir = qt_akhir + ($qty * $qty_satuan),
                 nilai_akhir = harga_rata * qt_akhir
                 WHERE tgl = '$tanggal' AND kd_cus = '$kd_cus_penerima' AND kd_brg = '$kode_barang'";
                $result_update_penerima = mysqli_query($koneksi, $query_update_penerima);

                if (!$result_update_penerima) {
                    die("Query update gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
                }
            } else {
                // Insert data baru untuk penerima
                $query_insert_penerima = "INSERT INTO mutasi_stok
                  (tgl, qty_awal, nilai_awal, kd_cus, kd_brg, satuan,
                   nilai_terima_int, qt_terima_int, qt_tersedia, nilai_tersedia, qt_akhir, nilai_akhir, harga_rata) VALUES (
                 '$tanggal', 
                 '$qty_awal',
                 '$nilai_awal',
                 '$kd_cus_penerima',
                 '$kode_barang',  
                 'Pcs',
                 '$nilai_terima_int_newValue',
                 '$qt_terima_intt_newValue',
                 '$qty_awal' + ($qty * $qty_satuan),
                 '$nilai_awal'+ ('$harga_rata' * ($qty * $qty_satuan)),
                 '$qty_awal' +  ($qty * $qty_satuan),
                 '$rata_rata_harga_newvalue' * ('$qty_awal' +  ($qty * $qty_satuan)),
                 '$rata_rata_harga_newvalue'
             )";
                //  echo $query_insert_penerima;
                $result_insert_penerima = mysqli_query($koneksi, $query_insert_penerima);

                if (!$result_insert_penerima) {
                    die("Query insert gagal dijalankan yang ini ?: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
                }
            }
        }
    }



    // Cek apakah semua item pada kode_permintaan memiliki status_item = 1
    $query_check_all_items = "SELECT COUNT(*) AS total_items, 
                                     SUM(CASE WHEN status_item = 1 THEN 1 ELSE 0 END) AS completed_items 
                              FROM permintaan_barang_detail 
                              WHERE kode_permintaan = '$kode_permintaan'";
    $result_check_all_items = mysqli_query($koneksi, $query_check_all_items);
    $data_check_all_items = mysqli_fetch_assoc($result_check_all_items);

    if ($data_check_all_items['total_items'] == $data_check_all_items['completed_items']) {
        // Update status_permintaan di tabel permintaan_barang
        $query_update_permintaan = "UPDATE permintaan_barang 
                                    SET status_permintaan = 2
                                    WHERE kode_permintaan = '$kode_permintaan'";
        if (!mysqli_query($koneksi, $query_update_permintaan)) {
            die("Error update status_permintaan: " . mysqli_error($koneksi));
        }
    }

    echo "<script>alert('Data berhasil disimpan.'); history.go(-1);</script>";
} else {
    echo "<script>alert('Data tidak lengkap.'); history.go(-1);</script>";
}
