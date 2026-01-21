<?php
include '../../../../config/koneksi.php'; // Koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $keterangan = $_POST['keterangan'];
    $tanggal_retur = $_POST['tanggal_retur']; // Ambil tanggal retur
    session_start();
    $employee = $_SESSION['employee_number'];
    $query_kdcus = mysqli_query($koneksi, "SELECT username FROM user_login WHERE employee_number = '$employee'");
    if (!$query_kdcus) {
        die("Error Query Username: " . mysqli_error($koneksi));
    }
    $q1 = mysqli_fetch_assoc($query_kdcus);
    $username = $q1['username'];
    $tanggalKode = date("Ymd", strtotime($tanggal_retur));

    // Generate NOTA Retur otomatis
    $query_last = mysqli_query($koneksi, "SELECT nota_retur FROM retur_pembelian WHERE nota_retur LIKE 'BR-$tanggalKode-%' ORDER BY nota_retur DESC LIMIT 1");
    if (!$query_last) {
        die("Error Query kd_retur: " . mysqli_error($koneksi));
    }

    $last_kd_retur = mysqli_fetch_assoc($query_last);
    if ($last_kd_retur) {
        $last_number = (int)substr($last_kd_retur['nota_retur'], -4); // Ambil 4 digit terakhir
        $new_number = str_pad($last_number + 1, 4, '0', STR_PAD_LEFT); // Tambah 1 dan tetap 4 digit
    } else {
        $new_number = "0001";
    }
    $lokasi = $_POST['lokasi'];
    $supplier = $_POST['supplier'];

    $kd_retur = "BR-$tanggalKode-$new_number";
    function realUpTo100($value)
    {
        return ceil($value / 100) * 100;
    }
    function roundUpTo100($value)
    {
        return ceil($value / 100) * 100;
        // return round($value);
    }

    if (!empty($_POST['kd_acc']) && is_array($_POST['kd_acc'])) {
        $jumlah_data = count($_POST['kd_acc']);
        $tgl = date('Y-m-d');

        foreach ($_POST['kd_acc'] as $i => $kd_brg) {
            // $kd_brg = $_POST['kd_acc'][$i];
            $nama_barang = $_POST['uraian'][$i];
            $jumlah_retur = (int) str_replace(',', '', $_POST['hasil_perkalian'][$i]);
            // echo $i . "adsadas;dansdlasndlajsds" . $kd_brg;


            if ($jumlah_retur > 0) {
                $hargaawal = str_replace(".", "", $_POST['price'][$i]); // Hilangkan titik dari format harga
                $totalharga = str_replace(".", "", $_POST['hargaTotal'][$i]); // Hilangkan titik dari format harga
                $tambahanharga = str_replace(".", "", $_POST['tambahan_harga'][$i]); // Hilangkan titik dari format harga
                $qty_satuan = $_POST['total_pcs'][$i];
                $harga = $hargaawal / $qty_satuan;
                $satuan = $_POST['satuan'][$i];
                $kd_cus = $lokasi;
                $banyak = $_POST['jumlah'][$i];
                $subtotal = $jumlah_retur; // Perbaikan perhitungan subtotal


                $query_last123 = mysqli_query($koneksi, "SELECT 
                  CASE
                    WHEN qty_satuan1 = $qty_satuan THEN Satuan1
                    WHEN qty_satuan2 = $qty_satuan THEN Satuan2
                    WHEN qty_satuan3 = $qty_satuan THEN Satuan3
                    WHEN qty_satuan4 = $qty_satuan THEN Satuan4
                    WHEN qty_satuan5 = $qty_satuan THEN Satuan5
                    ELSE NULL
                  END AS satuan
                FROM barang
                WHERE kd_brg = '$kd_brg'
                LIMIT 1;
                ");
                if (!$query_last123) {
                    die("Error Query kd_retur: " . mysqli_error($koneksi));
                }

                $last_kd_retur123 = mysqli_fetch_assoc($query_last123);
                $last_satuan = $last_kd_retur123['satuan'];

                $query = "INSERT INTO retur_pembelian (tanggal_retur,nota_retur, kd_brg, harga, banyak, satuan, kd_cus, user_input,status_retur,total_retur,tambahan,keterangan,isi,kd_supp)
                          VALUES ('$tanggal_retur', '$kd_retur', '$kd_brg', '$harga', '$banyak', '$last_satuan','$kd_cus', '$username',0,'$totalharga','$tambahanharga','$keterangan','$qty_satuan','$supplier')";
                $result = mysqli_query($koneksi, $query);
                if (!$result) {
                    die("Error saat menyimpan retur: " . mysqli_error($koneksi));
                }
                // **UPDATE INVENTORY**
                // Cek apakah barang sudah ada di inventory berdasarkan kd_brg dan kd_cus
                $query_cek = "SELECT stok FROM inventory WHERE kd_brg = '$kd_brg' AND kd_cus = '$kd_cus'";
                $result_cek = mysqli_query($koneksi, $query_cek);

                if (!$result_cek) {
                    die("Error Query Cek Inventory: " . mysqli_error($koneksi));
                }

                if (mysqli_num_rows($result_cek) > 0) {
                    // Jika barang sudah ada, update jumlahnya
                    $row = mysqli_fetch_assoc($result_cek);
                    $jumlah_sekarang = $row['stok'];
                    $jumlah_baru = $jumlah_sekarang - $subtotal;

                    $query_update = "UPDATE inventory SET stok = '$jumlah_baru' WHERE kd_brg = '$kd_brg' AND kd_cus = '$kd_cus'";
                    $result_update = mysqli_query($koneksi, $query_update);

                    if (!$result_update) {
                        die("Error Update Inventory: " . mysqli_error($koneksi));
                    }

                    // echo "Inventory diperbarui untuk kd_brg: $kd_brg, kd_cus: $kd_cus, jumlah baru: $jumlah_baru\n";
                } else {
                    // Jika barang belum ada, insert baru
                    $query_insert = "INSERT INTO inventory (kd_brg, kd_cus, stok) VALUES ('$kd_brg', '$kd_cus', '-$subtotal')";
                    $result_insert = mysqli_query($koneksi, $query_insert);

                    if (!$result_insert) {
                        die("Error Insert Inventory: " . mysqli_error($koneksi));
                    }

                    // echo "Inventory baru ditambahkan untuk kd_brg: $kd_brg, kd_cus: $kd_cus, jumlah: $subtotal\n";
                }
                // Mutasi Stock
                $query_check = "SELECT kd_cus FROM mutasi_stok WHERE tgl = '$tgl' AND kd_cus = '$kd_cus' AND kd_brg = '$kd_brg'";
                $result_check = mysqli_query($koneksi, $query_check);

                if (mysqli_num_rows($result_check) > 0) {
                    // Update jika data sudah ada
                    $query_update = "UPDATE mutasi_stok SET 
                        qty_beli_retur = qty_beli_retur + $subtotal,
                        nilai_beli_retur = nilai_beli_retur + $totalharga,
                        qt_akhir = qt_akhir - $subtotal,
                        nilai_akhir = CEIL('$harga' *  qt_akhir)
                    WHERE tgl = '$tgl' AND kd_cus = '$kd_cus' AND kd_brg = '$kd_brg'";

                    $resut_update = mysqli_query($koneksi, $query_update);
                    if (!$resut_update) {
                        die("Query update ke mutasi_semua gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
                    }
                } else {

                    // Query untuk mendapatkan nilai awal, qty awal, nilai beli sebelumnya, dan qty beli sebelumnya dari tanggal terbaru
                    $query_awal = "SELECT
                    tgl AS tgl_terakhir, 
                    nilai_akhir AS nilai_awalakhir,
                    qt_akhir AS qty_awalakhir,
                    stok_opname, nilai_opname,harga_rata       
                    FROM mutasi_stok 
                    WHERE kd_cus = '$kd_cus' AND kd_brg = '$kd_brg' 
                    ORDER BY 
                    tgl_terakhir DESC 
                    LIMIT 1";

                    $result_awal = mysqli_query($koneksi, $query_awal);

                    if (!$result_awal) {
                        die("Query untuk mendapatkan nilai awal, qty awal, nilai beli sebelumnya, dan qty beli sebelumnya gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
                    }

                    if (mysqli_num_rows($result_awal) > 0) {
                        $row_awal = mysqli_fetch_assoc($result_awal);
                        $nilai_awal = $row_awal['nilai_awalakhir'];
                        $qty_awal = $row_awal['qty_awalakhir'];
                        $stok_opname = $row_awal['stok_opname'];
                        $nilai_opname = $row_awal['nilai_opname'];
                        $harga_rata_baru = $row_awal['harga_rata'];
                    } else {
                        $nilai_awal = 0;
                        $qty_awal = 0;
                        $stok_opname = 0;
                        $nilai_opname = 0;
                        $harga_rata_baru = 0;
                    }

                    // Tentukan nilai qty_awal
                    $qty_awal = $stok_opname != 0 ? $stok_opname : $qty_awal;
                    $nilai_awal = $nilai_opname != 0 ? $nilai_opname : $nilai_awal;
                    $nilai_awal = is_numeric($nilai_awal) ? $nilai_awal : 0;
                    $qty_awal = is_numeric($qty_awal) ? $qty_awal : 0;
                    $qt_tersedia = $qty_awal - $subtotal;
                    $nilai_tersedia = $nilai_awal - $totalharga;

                    if ($harga_rata_baru <= 0) {
                        $harga_rata_sebelumnya = $nilai_awal / $qty_awal;
                    } else {
                        $harga_rata_sebelumnya = $harga_rata_baru;
                    }
                    // Insert data baru
                    $query_insert = "INSERT INTO mutasi_stok 
                    (tgl, qty_awal,nilai_awal,qty_beli_retur, nilai_beli_retur,qt_tersedia,
                    nilai_tersedia,  
                    harga_rata , kd_cus, kd_brg, satuan,
                    qt_akhir, nilai_akhir) VALUES (
                    '$tgl',
                    '$qty_awal',
                    '$nilai_awal',
                    '$subtotal',
                    '$totalharga',
                    '$qty_awal',
                    '$nilai_awal',
                    '$harga_rata_sebelumnya',
                    '$kd_cus',
                    '$kd_brg',
                    'Pcs',
                    '$qt_tersedia',
                    '$nilai_tersedia'
                )";
                    $result_insert = mysqli_query($koneksi, $query_insert);
                    if (!$result_insert) {
                        die("Query insert ke mutasi_semua gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
                    }
                }
                // echo $i . "adsadas;dansdlasndlajsds";

                // update harga
                // if ($harga != 0) {
                //     function roundUpTo100($value)
                //     {
                //         return ceil($value / 100) * 100;
                //         // return round($value);
                //     }
                //     $check_barang_sql = "SELECT COUNT(*) AS count,
                //     ktg_retail,ktg_online,ktg_ms,ktg_mg,ktg_mp,ktg_grosir,
                //     Satuan1,Satuan2,Satuan3,Satuan4,Satuan5,
                //     hrg_satuan1,hrg_satuan2,hrg_satuan3,hrg_satuan4,hrg_satuan5,
                //     hrg_satuan1_grosir,hrg_satuan2_grosir,hrg_satuan3_grosir,hrg_satuan4_grosir,hrg_satuan5_grosir,
                //     hrg_satuan1_online,hrg_satuan2_online,hrg_satuan3_online,hrg_satuan4_online,hrg_satuan5_online,
                //     hrg_satuan1_ms,hrg_satuan2_ms,hrg_satuan3_ms,hrg_satuan4_ms,hrg_satuan5_ms,
                //     hrg_satuan1_mg,hrg_satuan2_mg,hrg_satuan3_mg,hrg_satuan4_mg,hrg_satuan5_mg,
                //     hrg_satuan1_mp,hrg_satuan2_mp,hrg_satuan3_mp,hrg_satuan4_mp,hrg_satuan5_mp,qty_satuan1,qty_satuan2,qty_satuan3,qty_satuan4,qty_satuan5 
                //      FROM barang WHERE kd_brg='$kd_brg'";
                //     $check_barang_result = mysqli_query($koneksi, $check_barang_sql);
                //     $check_barang_data = mysqli_fetch_assoc($check_barang_result);
                //     if ($check_barang_data['count'] > 0) {
                //         $hargake_values = [];

                //         $satuanke = [
                //             2 => !empty($check_barang_data['Satuan2']) ? $check_barang_data['Satuan2'] : NULL,
                //             3 => !empty($check_barang_data['Satuan3']) ? $check_barang_data['Satuan3'] : NULL,
                //             4 => !empty($check_barang_data['Satuan4']) ? $check_barang_data['Satuan4'] : NULL,
                //             5 => !empty($check_barang_data['Satuan5']) ? $check_barang_data['Satuan5'] : NULL
                //         ];
                //         $quantityke = [
                //             1 => !empty($check_barang_data['qty_satuan1']) ? $check_barang_data['qty_satuan1'] : 0,
                //             2 => !empty($check_barang_data['qty_satuan2']) ? $check_barang_data['qty_satuan2'] : 0,
                //             3 => !empty($check_barang_data['qty_satuan3']) ? $check_barang_data['qty_satuan3'] : 0,
                //             4 => !empty($check_barang_data['qty_satuan4']) ? $check_barang_data['qty_satuan4'] : 0,
                //             5 => !empty($check_barang_data['qty_satuan5']) ? $check_barang_data['qty_satuan5'] : 0
                //         ];
                //         $previous_hargake = null;

                //         for ($id_kat = 1; $id_kat <= 6; $id_kat++) {
                //             switch ($id_kat) {
                //                 case 1:
                //                     $Nama_kategoriNilaiidkat = !empty($check_barang_data['ktg_retail']) ? $check_barang_data['ktg_retail'] : NULL;
                //                     $prefixes = '';
                //                     break;
                //                 case 2:
                //                     $Nama_kategoriNilaiidkat = !empty($check_barang_data['ktg_grosir']) ? $check_barang_data['ktg_grosir'] : NULL;
                //                     $prefixes = '_grosir';
                //                     break;
                //                 case 3:
                //                     $Nama_kategoriNilaiidkat = !empty($check_barang_data['ktg_online']) ? $check_barang_data['ktg_online'] : NULL;
                //                     $prefixes = '_online';
                //                     break;
                //                 case 4:
                //                     $Nama_kategoriNilaiidkat = !empty($check_barang_data['ktg_ms']) ? $check_barang_data['ktg_ms'] : NULL;
                //                     $prefixes = '_ms';
                //                     break;
                //                 case 5:
                //                     $Nama_kategoriNilaiidkat = !empty($check_barang_data['ktg_mg']) ? $check_barang_data['ktg_mg'] : NULL;
                //                     $prefixes = '_mg';
                //                     break;
                //                 case 6:
                //                     $Nama_kategoriNilaiidkat = !empty($check_barang_data['ktg_mp']) ? $check_barang_data['ktg_mp'] : NULL;
                //                     $prefixes = '_mp';
                //                     break;
                //                 default:
                //                     $Nama_kategoriNilaiidkat = "";
                //                     $prefixes = '';
                //                     break;
                //             }
                //             $querysql1 = mysqli_query($koneksi, "SELECT 
                //                 IFNULL(layer1, 0) AS layer11,
                //                 IFNULL(SUBSTRING_INDEX(layer2, '|', 1), 0) AS layer21, 
                //                 IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer2, '|', 2), '|', -1), 0) AS layer22,
                //                 IFNULL(SUBSTRING_INDEX(layer3, '|', 1), 0) AS layer31,  
                //                 IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer3, '|', 2), '|', -1), 0) AS layer32,  
                //                 IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer3, '|', 3), '|', -1), 0) AS layer33, 
                //                 IFNULL(SUBSTRING_INDEX(layer4, '|', 1), 0) AS layer41, 
                //                 IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer4, '|', 2), '|', -1), 0) AS layer42, 
                //                 IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer4, '|', 3), '|', -1), 0) AS layer43, 
                //                 IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer4, '|', 4), '|', -1), 0) AS layer44,  
                //                 IFNULL(SUBSTRING_INDEX(layer5, '|', 1), 0) AS layer51,  
                //                 IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 2), '|', -1), 0) AS layer52, 
                //                 IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 3), '|', -1), 0) AS layer53,  
                //                 IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 4), '|', -1), 0) AS layer54,  
                //                 IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 5), '|', -1), 0) AS layer55
                //             FROM kategori_nilai 
                //             WHERE Nama_kategoriNilai = '$Nama_kategoriNilaiidkat' AND id_kat = $id_kat");

                //             if ($s1 = mysqli_fetch_array($querysql1)) {
                //                 $temp_hargake = array_fill(0, 5, 0);

                //                 for ($i = 5; $i >= 1; $i--) {
                //                     if ($i == 1) {
                //                         $temp_hargake[0] = realUpTo100($quantityke[$i] * $harga * (1 + $s1["layer11"] / 100));
                //                     } else if (!empty($satuanke[$i])) {
                //                         for ($j = 1; $j <= $i; $j++) {
                //                             $layer_column = "layer{$i}$j";
                //                             $temp_hargake[$j - 1] = roundUpTo100($harga * $quantityke[$j] * (1 + $s1[$layer_column] / 100));
                //                         }
                //                         break;
                //                     }
                //                 }
                //                 $previous_hargake = $temp_hargake;

                //                 $hargake_values = array_merge($hargake_values, $temp_hargake);
                //             } else {
                //                 if ($Nama_kategoriNilaiidkat == 'manual') {
                //                     $temp_hargamanualke = array_fill(0, 5, 0);
                //                     for ($i = 0; $i < 5; $i++) {
                //                         // $fieldName = 'hrg_satuan' . $i . $prefixes;
                //                         // $postKey = ${$fieldName};
                //                         // $temp_hargamanualke[$i] = !empty($check_barang_data['hrg_satuan' . $i + 1 . $prefixes]) ? $check_barang_data['hrg_satuan' . $i + 1 . $prefixes] : 0;
                //                         $temp_hargamanualke[$i] = !empty($check_barang_data['hrg_satuan' . ($i + 1) . $prefixes])
                //                             ? $check_barang_data['hrg_satuan' . ($i + 1) . $prefixes]
                //                             : 0;
                //                     }
                //                     $hargake_values = array_merge($hargake_values, $temp_hargamanualke);
                //                 } else if ($previous_hargake !== null) {
                //                     $hargake_values = array_merge($hargake_values, $previous_hargake);
                //                 }
                //             }
                //         }

                //         $query_values = array_map(function ($value) {
                //             return "'" . roundUpTo100($value) . "'";
                //         }, $hargake_values);
                //         $query_values = array_map(function ($value) {
                //             $value = str_replace("'", "", $value);
                //             return intval($value);
                //         }, $hargake_values);

                //         $query_update_barang  = "UPDATE
                //             barang SET harga = '$harga',
                //             hrg_satuan1 = '{$query_values[0]}',
                //             hrg_satuan2 = '{$query_values[1]}',
                //             hrg_satuan3 = '{$query_values[2]}',
                //             hrg_satuan4 = '{$query_values[3]}',
                //             hrg_satuan5 = '{$query_values[4]}',
                //             hrg_satuan1_grosir = '{$query_values[5]}',
                //             hrg_satuan2_grosir = '{$query_values[6]}',
                //             hrg_satuan3_grosir = '{$query_values[7]}',
                //             hrg_satuan4_grosir = '{$query_values[8]}',
                //             hrg_satuan5_grosir = '{$query_values[9]}',
                //             hrg_satuan1_online = '{$query_values[10]}',
                //             hrg_satuan2_online = '{$query_values[11]}',
                //             hrg_satuan3_online = '{$query_values[12]}',
                //             hrg_satuan4_online = '{$query_values[13]}',
                //             hrg_satuan5_online = '{$query_values[14]}',
                //             hrg_satuan1_ms ='{$query_values[15]}',
                //             hrg_satuan2_ms ='{$query_values[16]}',
                //             hrg_satuan3_ms ='{$query_values[17]}',
                //             hrg_satuan4_ms ='{$query_values[18]}',
                //             hrg_satuan5_ms ='{$query_values[19]}',
                //             hrg_satuan1_mg ='{$query_values[20]}',
                //             hrg_satuan2_mg ='{$query_values[21]}',
                //             hrg_satuan3_mg ='{$query_values[22]}',
                //             hrg_satuan4_mg ='{$query_values[23]}',
                //             hrg_satuan5_mg ='{$query_values[24]}',
                //             hrg_satuan1_mp ='{$query_values[25]}',
                //             hrg_satuan2_mp ='{$query_values[26]}',
                //             hrg_satuan3_mp ='{$query_values[27]}',
                //             hrg_satuan4_mp ='{$query_values[28]}',
                //             hrg_satuan5_mp ='{$query_values[29]}'
                //             WHERE kd_brg = '$kd_brg'
                //     ";
                //         $result_query_update_barang = mysqli_query($koneksi, $query_update_barang);
                //         if (!$result_query_update_barang) {
                //             die('Update Harga gagal dijalankan' . mysqli_error($koneksi));
                //         }
                //     }
                // }
                // Update harga ke table barang 
                $harga_pcs = $harga;
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
            }
        }
        echo "<script>alert('Retur berhasil diproses oleh $username! Kode Retur: $kd_retur');</script>";
        echo "<script>window.location='../../main.php?route=pembelian_retur_detail&act&id=$kd_retur'</script>";
    } else {
        echo "<script>alert('Tidak ada barang yang dipilih untuk diretur!'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Akses tidak diizinkan!'); window.history.back();</script>";
}
