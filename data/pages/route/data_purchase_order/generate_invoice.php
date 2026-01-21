
<?php
include '../../../../config/koneksi.php';
session_start();

$employee = $_SESSION['employee_number'];

$query_kdcus = mysqli_query($koneksi, "SELECT kd_cus FROM user_login where employee_number = '$employee'");
$q1 = mysqli_fetch_assoc($query_kdcus);
$kd_cus = $q1['kd_cus'];



// Cek apakah form telah di-submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Ambil data dari form
    $no_invoice = $_POST['no_invoice'];
    $kd_beli = $_POST['kd_beli'];
    $kd_supp = $_POST['kd_supp'];
    $ongkir = $_POST['ongkos_kirim'];
    $ppn = $_POST['ppn'];  // Menghapus koma dari angka
    $tanggal_invoice = $_POST['tgl_invoice'];  // Tanggal hari ini
    $tujuan_kirim = $_POST['tujuan_kirim'];
    // echo $tujuan_kirim;
    function realUpTo100($value)
    {
        return ceil($value / 100) * 100;
    }
    function roundUpTo100($value)
    {
        return ceil($value / 100) * 100;
        // return round($value);
    }

    // Cek apakah no_invoice sudah ada dalam database untuk kd_po yang berbeda
    $query_check_invoice = "SELECT no_invoice FROM pembelian_invoice WHERE no_invoice = '$no_invoice' OR kd_po = '$kd_beli'";
    $result_check_invoice = mysqli_query($koneksi, $query_check_invoice);

    if (mysqli_num_rows($result_check_invoice) > 0) {
        // Jika ditemukan nomor invoice yang sama dengan kd_po yang berbeda
        echo "<script>alert('GAGAL MENYIMPAN Nomor Invoice sudah ada dan tidak boleh sama!');</script>";
        echo "<script>window.location.href = '../../main.php?route=purchase_order_keuangan&act&ide={$employee}&asal=purchase_order';</script>";
    } else {

        $update_status = mysqli_query($koneksi, "UPDATE pembelian SET status_invoice = 1 WHERE kd_po = '$kd_beli'");

        // echo $update_status;
        // die();


        // Insert ke tabel pembelian_invoice
        $query_invoice = "INSERT INTO pembelian_invoice (kd_cus, no_invoice, tanggal_invoice, kd_po, kd_supp, ppn, ongkir)
                              VALUES ('$kd_cus', '$no_invoice', '$tanggal_invoice', '$kd_beli', '$kd_supp', '$ppn', '$ongkir')";

        // echo $query_invoice;
        mysqli_query($koneksi, $query_invoice);

        // Periksa apakah query invoice berhasil
        if (mysqli_affected_rows($koneksi) > 0) {
            // echo "Data invoice berhasil ditambahkan.<br>";
        } else {
            // echo "Gagal menambahkan data invoice.<br>";
        }
        $bonus_map = []; // Store total quantity per item
        $harga_map = []; // Store total price per item (just summed, not multiplied by qty)

        foreach ($_POST['jumlah'] as $i => $val) {
            $kode_barang = $_POST['kd_brg'][$i];
            $jumlah = (int) $_POST['jumlah'][$i];
            $jml_pcs = (int) $_POST['jml_pcs'][$i];
            $total_qty = $jml_pcs * $jumlah;

            // Clean up the price (e.g., "1,000" => 1000)
            $harga = (int) str_replace(",", "", $_POST['subtotal'][$i]);

            // Initialize if not set
            if (!isset($bonus_map[$kode_barang])) {
                $bonus_map[$kode_barang] = 0;
            }

            if (!isset($harga_map[$kode_barang])) {
                $harga_map[$kode_barang] = 0;
            }

            // Accumulate total quantity
            $bonus_map[$kode_barang] += $total_qty;

            // Just add price once per row (no multiplication)
            $harga_map[$kode_barang] += $harga;
        }



        // Insert ke tabel pembelian_invoice_detail (karena bisa banyak barang, lakukan perulangan)
        foreach ($_POST['jumlah'] as $index => $jumlah) {
            $kd_brg = $_POST['kd_brg'][$index];
            $jml_pcs = $_POST['jml_pcs'][$index];
            $jml_pcs_bonus = $bonus_map[$kd_brg];

            // $jml_pcs_bonus = $_POST['jml_pcs'][$index] * $jumlah;
            // foreach ($_POST['kd_brg'] as $i => $kode_barang) {
            //     if ($i !== $index && $kd_brg == $kode_barang) {
            //         $jml_pcs_bonus += $_POST['jml_pcs'][$i] * $_POST['jumlah'][$i];
            //     }
            // }
            $urut = $_POST['urut'][$index];
            $satuan = $_POST['satuan'][$index];
            $harga = str_replace(",", "", $_POST['harga'][$index]);  // Menghapus koma dari angka
            $harga_pcs_bonus = $harga_map[$kd_brg];

            $diskon = str_replace(",", "", $_POST['diskon'][$index]);  // Menghapus koma dari angka

            $harga_pcs = ($jml_pcs_bonus != 0) ? ($harga_pcs_bonus / $jml_pcs_bonus) : 0;
            // echo "Row $index - kd_brg: $kd_brg | jml_pcs: $jml_pcs | jumlah: $jumlah | total bonus: $jml_pcs_bonus<br>";
            // echo "harga $harga_pcs_bonus - kd_brg: $kd_brg | harga total $harga_pcs<br>";

            // echo "Row $harga - kd_brg: $kd_brg | jml_pcs: $jml_pcs | jumlah: $jumlah | total bonus: $jml_pcs_bonus<br>";

            // Insert ke pembelian_invoice_detail
            $query_detail = "INSERT INTO pembelian_invoice_detail (no_invoice, kd_po, kd_brg, nilai, disc, jml, jml_pcs,urut,satuan)
                                 VALUES ('$no_invoice', '$kd_beli', '$kd_brg', '$harga', '$diskon', '$jumlah','$jml_pcs','$urut', '$satuan')";
            mysqli_query($koneksi, $query_detail);

            // Periksa apakah query detail berhasil
            if (mysqli_affected_rows($koneksi) > 0) {
                // echo "Detail barang $kd_brg berhasil ditambahkan.<br>";
            } else {
                // echo "Gagal menambahkan detail barang $kd_brg.<br>";
            }

            // Update harga ke table barang 

            if ($harga_pcs != 0) {
                $check_barang_sql = "SELECT COUNT(*) AS count,
                ktg_retail,ktg_online,ktg_ms,ktg_mg,ktg_mp,ktg_grosir,
                Satuan1,Satuan2,Satuan3,Satuan4,Satuan5,
                hrg_satuan1,hrg_satuan2,hrg_satuan3,hrg_satuan4,hrg_satuan5,
                hrg_satuan1_grosir,hrg_satuan2_grosir,hrg_satuan3_grosir,hrg_satuan4_grosir,hrg_satuan5_grosir,
                hrg_satuan1_online,hrg_satuan2_online,hrg_satuan3_online,hrg_satuan4_online,hrg_satuan5_online,
                hrg_satuan1_ms,hrg_satuan2_ms,hrg_satuan3_ms,hrg_satuan4_ms,hrg_satuan5_ms,
                hrg_satuan1_mg,hrg_satuan2_mg,hrg_satuan3_mg,hrg_satuan4_mg,hrg_satuan5_mg,
                hrg_satuan1_mp,hrg_satuan2_mp,hrg_satuan3_mp,hrg_satuan4_mp,hrg_satuan5_mp,qty_satuan1,qty_satuan2,qty_satuan3,qty_satuan4,qty_satuan5 
                 FROM barang WHERE kd_brg='$kd_brg'";
                $check_barang_result = mysqli_query($koneksi, $check_barang_sql);
                $check_barang_data = mysqli_fetch_assoc($check_barang_result);
                if ($check_barang_data['count'] > 0) {
                    $hargake_values = [];

                    $satuanke = [
                        2 => !empty($check_barang_data['Satuan2']) ? $check_barang_data['Satuan2'] : NULL,
                        3 => !empty($check_barang_data['Satuan3']) ? $check_barang_data['Satuan3'] : NULL,
                        4 => !empty($check_barang_data['Satuan4']) ? $check_barang_data['Satuan4'] : NULL,
                        5 => !empty($check_barang_data['Satuan5']) ? $check_barang_data['Satuan5'] : NULL
                    ];
                    $quantityke = [
                        1 => !empty($check_barang_data['qty_satuan1']) ? $check_barang_data['qty_satuan1'] : 0,
                        2 => !empty($check_barang_data['qty_satuan2']) ? $check_barang_data['qty_satuan2'] : 0,
                        3 => !empty($check_barang_data['qty_satuan3']) ? $check_barang_data['qty_satuan3'] : 0,
                        4 => !empty($check_barang_data['qty_satuan4']) ? $check_barang_data['qty_satuan4'] : 0,
                        5 => !empty($check_barang_data['qty_satuan5']) ? $check_barang_data['qty_satuan5'] : 0
                    ];
                    $previous_hargake = null;

                    for ($id_kat = 1; $id_kat <= 6; $id_kat++) {
                        switch ($id_kat) {
                            case 1:
                                $Nama_kategoriNilaiidkat = !empty($check_barang_data['ktg_retail']) ? $check_barang_data['ktg_retail'] : NULL;
                                $prefixes = '';
                                break;
                            case 2:
                                $Nama_kategoriNilaiidkat = !empty($check_barang_data['ktg_grosir']) ? $check_barang_data['ktg_grosir'] : NULL;
                                $prefixes = '_grosir';
                                break;
                            case 3:
                                $Nama_kategoriNilaiidkat = !empty($check_barang_data['ktg_online']) ? $check_barang_data['ktg_online'] : NULL;
                                $prefixes = '_online';
                                break;
                            case 4:
                                $Nama_kategoriNilaiidkat = !empty($check_barang_data['ktg_ms']) ? $check_barang_data['ktg_ms'] : NULL;
                                $prefixes = '_ms';
                                break;
                            case 5:
                                $Nama_kategoriNilaiidkat = !empty($check_barang_data['ktg_mg']) ? $check_barang_data['ktg_mg'] : NULL;
                                $prefixes = '_mg';
                                break;
                            case 6:
                                $Nama_kategoriNilaiidkat = !empty($check_barang_data['ktg_mp']) ? $check_barang_data['ktg_mp'] : NULL;
                                $prefixes = '_mp';
                                break;
                            default:
                                $Nama_kategoriNilaiidkat = "";
                                $prefixes = '';
                                break;
                        }
                        $querysql1 = mysqli_query($koneksi, "SELECT 
                        IFNULL(layer1, 0) AS layer11,
                        IFNULL(SUBSTRING_INDEX(layer2, '|', 1), 0) AS layer21, 
                        IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer2, '|', 2), '|', -1), 0) AS layer22,
                        IFNULL(SUBSTRING_INDEX(layer3, '|', 1), 0) AS layer31,  
                        IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer3, '|', 2), '|', -1), 0) AS layer32,  
                        IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer3, '|', 3), '|', -1), 0) AS layer33, 
                        IFNULL(SUBSTRING_INDEX(layer4, '|', 1), 0) AS layer41, 
                        IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer4, '|', 2), '|', -1), 0) AS layer42, 
                        IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer4, '|', 3), '|', -1), 0) AS layer43, 
                        IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer4, '|', 4), '|', -1), 0) AS layer44,  
                        IFNULL(SUBSTRING_INDEX(layer5, '|', 1), 0) AS layer51,  
                        IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 2), '|', -1), 0) AS layer52, 
                        IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 3), '|', -1), 0) AS layer53,  
                        IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 4), '|', -1), 0) AS layer54,  
                        IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 5), '|', -1), 0) AS layer55
                    FROM kategori_nilai 
                    WHERE Nama_kategoriNilai = '$Nama_kategoriNilaiidkat' AND id_kat = $id_kat");

                        if ($s1 = mysqli_fetch_array($querysql1)) {
                            $temp_hargake = array_fill(0, 5, 0);

                            for ($i = 5; $i >= 1; $i--) {
                                if ($i == 1) {
                                    $temp_hargake[0] = realUpTo100($quantityke[$i] * $harga_pcs * (1 + $s1["layer11"] / 100));
                                } else if (!empty($satuanke[$i])) {
                                    for ($j = 1; $j <= $i; $j++) {
                                        $layer_column = "layer{$i}$j";
                                        $temp_hargake[$j - 1] = roundUpTo100($harga_pcs * $quantityke[$j] * (1 + $s1[$layer_column] / 100));
                                    }
                                    break;
                                }
                            }
                            $previous_hargake = $temp_hargake;

                            $hargake_values = array_merge($hargake_values, $temp_hargake);
                        } else {
                            if ($Nama_kategoriNilaiidkat == 'manual') {
                                $temp_hargamanualke = array_fill(0, 5, 0);
                                for ($i = 0; $i < 5; $i++) {
                                    // $fieldName = 'hrg_satuan' . $i . $prefixes;
                                    // $postKey = ${$fieldName};
                                    // $temp_hargamanualke[$i] = !empty($check_barang_data['hrg_satuan' . $i + 1 . $prefixes]) ? $check_barang_data['hrg_satuan' . $i + 1 . $prefixes] : 0;
                                    $temp_hargamanualke[$i] = !empty($check_barang_data['hrg_satuan' . ($i + 1) . $prefixes])
                                        ? $check_barang_data['hrg_satuan' . ($i + 1) . $prefixes]
                                        : 0;
                                }
                                $hargake_values = array_merge($hargake_values, $temp_hargamanualke);
                            } else if ($previous_hargake !== null) {
                                $hargake_values = array_merge($hargake_values, $previous_hargake);
                            }
                        }
                    }

                    $query_values = array_map(function ($value) {
                        return "'" . roundUpTo100($value) . "'";
                    }, $hargake_values);
                    $query_values = array_map(function ($value) {
                        $value = str_replace("'", "", $value);
                        return intval($value);
                    }, $hargake_values);

                    $query_update_barang  = "UPDATE
                    barang SET harga = '$harga_pcs',
                    hrg_satuan1 = '{$query_values[0]}',
                    hrg_satuan2 = '{$query_values[1]}',
                    hrg_satuan3 = '{$query_values[2]}',
                    hrg_satuan4 = '{$query_values[3]}',
                    hrg_satuan5 = '{$query_values[4]}',
                    hrg_satuan1_grosir = '{$query_values[5]}',
                    hrg_satuan2_grosir = '{$query_values[6]}',
                    hrg_satuan3_grosir = '{$query_values[7]}',
                    hrg_satuan4_grosir = '{$query_values[8]}',
                    hrg_satuan5_grosir = '{$query_values[9]}',
                    hrg_satuan1_online = '{$query_values[10]}',
                    hrg_satuan2_online = '{$query_values[11]}',
                    hrg_satuan3_online = '{$query_values[12]}',
                    hrg_satuan4_online = '{$query_values[13]}',
                    hrg_satuan5_online = '{$query_values[14]}',
                    hrg_satuan1_ms ='{$query_values[15]}',
                    hrg_satuan2_ms ='{$query_values[16]}',
                    hrg_satuan3_ms ='{$query_values[17]}',
                    hrg_satuan4_ms ='{$query_values[18]}',
                    hrg_satuan5_ms ='{$query_values[19]}',
                    hrg_satuan1_mg ='{$query_values[20]}',
                    hrg_satuan2_mg ='{$query_values[21]}',
                    hrg_satuan3_mg ='{$query_values[22]}',
                    hrg_satuan4_mg ='{$query_values[23]}',
                    hrg_satuan5_mg ='{$query_values[24]}',
                    hrg_satuan1_mp ='{$query_values[25]}',
                    hrg_satuan2_mp ='{$query_values[26]}',
                    hrg_satuan3_mp ='{$query_values[27]}',
                    hrg_satuan4_mp ='{$query_values[28]}',
                    hrg_satuan5_mp ='{$query_values[29]}'
                    WHERE kd_brg = '$kd_brg'
                    ";
                    $result_query_update_barang = mysqli_query($koneksi, $query_update_barang);
                    if (!$result_query_update_barang) {
                        die('Update Harga gagal dijalankan' . mysqli_error($koneksi));
                    }
                }
            }




            // Mengupdate atau menambah ke inventory
            $query_check = "SELECT * FROM inventory WHERE kd_cus = '$tujuan_kirim' AND kd_brg = '$kd_brg' ";
            $result_check = mysqli_query($koneksi, $query_check);

            if (mysqli_num_rows($result_check) > 0) {
                $query_update = "UPDATE inventory SET 
            stok = stok + ($jumlah * $jml_pcs)
            WHERE kd_cus = '$tujuan_kirim' AND kd_brg = '$kd_brg' ";
                $result_update = mysqli_query($koneksi, $query_update);

                if (!$result_update) {
                    die("Query update gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
                }
            } else {
                // Data belum ada, masukkan data baru
                $query_insert = "INSERT INTO inventory (kd_cus,kd_brg,stok,satuan) VALUES (
                '$tujuan_kirim', 
                '$kd_brg',  
                '$jumlah' * '$jml_pcs',
                'Pcs'
                 )";

                $result_insert = mysqli_query($koneksi, $query_insert);

                if (!$result_insert) {
                    die("Query insert gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
                }
            }





            // Update Langsung Ke mutasi stok


            // $query_harga_beli_terbaru = "SELECT harga FROM barang WHERE kd_brg = '$kd_brg'";
            // $resutl_harga_beli_terbaru = mysqli_query($koneksi, $query_harga_beli_terbaru);

            // if (!$resutl_harga_beli_terbaru) {
            //     die("Query gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
            // }

            // // Periksa apakah ada hasil yang dikembalikan
            // if (mysqli_num_rows($resutl_harga_beli_terbaru) > 0) {
            //     $rows = mysqli_fetch_assoc($resutl_harga_beli_terbaru);
            //     if (isset($rows['harga'])) {
            //         $harga_beli_terbaru = $rows['harga'];
            //     }
            // } else {
            //     $harga_beli_terbaru = 0; // Atau nilai default lain yang sesuai
            // }
            // $harga_beli_terbaru = is_numeric($harga_beli_terbaru) ? $harga_beli_terbaru : 0;


            $query_awal = "SELECT 
        tgl AS tgl_terakhir, 
          nilai_akhir AS nilai_awal, 
          qt_akhir AS qty_awal, 
          nilai_beli AS nilai_beli_sebelumnya, 
          qty_beli AS qty_beli_sebelumnya, 
          harga_rata ,
          stok_opname, nilai_opname 
          FROM 
          mutasi_stok  
          WHERE  
          kd_cus = '$tujuan_kirim' AND kd_brg = '$kd_brg' 
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
                $harga_rata_sebelumnya = $row_awal['harga_rata'];
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
                $harga_rata_sebelumnya = 0;
                $stok_opname = 0; // Default jika tidak ada data
                $nilai_opname = 0; // Default jika tidak ada data

            }

            // Tentukan nilai qty_awal
            $qty_awal = $stok_opname != 0 ? $stok_opname : $qty_awal;
            $nilai_awal = $nilai_opname != 0 ? $nilai_opname : $nilai_awal;

            $nilai_awal = is_numeric($nilai_awal) ? $nilai_awal : 0;
            $qty_awal = is_numeric($qty_awal) ? $qty_awal : 0;
            $nilai_beli_sebelumnya = is_numeric($nilai_beli_sebelumnya) ? $nilai_beli_sebelumnya : 0;
            $qty_beli_sebelumnya = is_numeric($qty_beli_sebelumnya) ? $qty_beli_sebelumnya : 0;
            $stok_opname = is_numeric($stok_opname) ? $stok_opname : 0;
            $nilai_opname = is_numeric($nilai_opname) ? $nilai_opname : 0;
            // Hitung harga rata-rata

            // Hitung harga rata-rata
            if ($qty_awal < 0 || $nilai_awal < 0) {
                // Jika qty_awal atau nilai_awal kurang dari 0
                $harga_rata =  $jumlah * $jml_pcs > 0 ? (($harga_pcs * ($jumlah * $jml_pcs)) / ($jumlah * $jml_pcs)) : 0;
            } else {
                // Jika qty_awal dan nilai_awal tidak kurang dari 0
                $harga_rata = ($qty_awal +  ($jumlah * $jml_pcs)) > 0 ? (($nilai_awal + ($harga_pcs * ($jumlah * $jml_pcs))) / ($qty_awal + ($jumlah * $jml_pcs))) : $harga_pcs;
            }



            // if (($qty_awal + ($jumlah * $jml_pcs)) != 0) {
            //     $harga_rata = (($nilai_awal + ($harga_pcs * ($jumlah * $jml_pcs))) / ($qty_awal + ($jumlah * $jml_pcs)));
            // } else {
            //     $harga_rata = is_numeric($harga_rata) ? $harga_rata : 0;
            // }




            // Cek apakah data dengan tanggal, kd_cus, dan kd_barang_sage yang sama sudah ada
            $query_check = "SELECT * FROM mutasi_stok WHERE tgl = '$tanggal_invoice' AND kd_cus = '$tujuan_kirim' AND kd_brg = '$kd_brg'";
            $result_check = mysqli_query($koneksi, $query_check);

            if (mysqli_num_rows($result_check) > 0) {
                // Data sudah ada, update data yang ada dengan menjumlahkan banyak
                $query_update = "UPDATE mutasi_stok SET 
            qty_beli = qty_beli + ($jumlah * $jml_pcs),
            nilai_beli = nilai_beli + ($harga_pcs * ($jumlah * $jml_pcs)),
            qt_tersedia = qt_tersedia + ($jumlah * $jml_pcs),
            nilai_tersedia = nilai_tersedia + ($harga_pcs * ($jumlah * $jml_pcs)),
            harga_rata = $harga_rata,
            qt_akhir = qt_akhir + ($jumlah * $jml_pcs),
            nilai_akhir = CEIL(qt_akhir * harga_rata)
        WHERE tgl = '$tanggal_invoice' AND kd_cus = '$tujuan_kirim' AND kd_brg = '$kd_brg'";
                $result_update = mysqli_query($koneksi, $query_update);
                // echo "<pre>";
                // echo $result_update;
                // echo "</pre>";

                if (!$result_update) {
                    die("Update Mutasi Stok gagal Dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
                }
            } else {
                // Data belum ada, masukkan data baru
                $query_insert = "INSERT INTO mutasi_stok (
                    tgl, 
                    kd_cus, 
                    kd_brg, 
                    satuan, 
                    qty_awal, 
                    nilai_awal, 
                    qty_beli, 
                    nilai_beli, 
                    qt_tersedia, 
                    nilai_tersedia, 
                    qt_akhir, 
                    nilai_akhir, 
                    harga_rata
                ) VALUES (
                    '$tanggal_invoice', 
                    '$tujuan_kirim', 
                    '$kd_brg',  
                    'Pcs',
                    '$qty_awal',
                    '$nilai_awal',
                    ('$jumlah' * '$jml_pcs'),
                    ('$harga_pcs' * ('$jumlah' * '$jml_pcs')),
                    (('$jumlah' * '$jml_pcs') + '$qty_awal'),
                    ((('$jumlah' * '$jml_pcs') + '$qty_awal') * '$harga_pcs'),
                    (('$jumlah' * '$jml_pcs') + '$qty_awal'),
                    ((('$jumlah' * '$jml_pcs') + '$qty_awal') * '$harga_rata'),
                    '$harga_rata'
                )";


                // echo "<pre>";
                // echo $query_insert;
                // echo "</pre>";


                $result_insert = mysqli_query($koneksi, $query_insert);

                if (!$result_insert) {
                    die("Query insert gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
                }
            }
        } //Penutup untuk perulaangan



        echo "<script>alert('invoice berhasil dicatat')</script>";
        // echo "<script>history.go(-2)</script>";
        echo "<script>window.location.href = '../../main.php?route=purchase_order_keuangan&act&ide={$employee}&asal=purchase_order';</script>";
    }
} else {
    echo "Form belum di-submit.";
}

?>

