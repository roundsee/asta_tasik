<?php
session_start();


$employee = $_SESSION['employee_number'];


if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
    echo "<link href='style.css' rel='stylesheet' type='text/css'>
 	<center>Untuk mengakses modul, Anda harus login <br>";
    echo "<a href=../../index.php><b>LOGIN</b></a></center>";
} else {
    include "../../../../config/koneksi.php";
    include "../../../../config/fungsi_kode_otomatis.php";

    $route = $_GET['route'];
    $act = $_GET['act'];
    if ($route == 'assembly' && $act == 'submit') {

        $tanggal = $_POST['tanggal'];
        $lokasi = $_POST['lokasi'] && $_POST['lokasi'] !== '' ? $_POST['lokasi'] : '';
        $nama_user = $_POST['nama_user'] && $_POST['nama_user'] !== '' ? $_POST['nama_user'] : '';
        $sumber = $_POST['sumber'] && $_POST['sumber'] !== '' ? $_POST['sumber'] : '';
        $keterangan = $_POST['keterangan'] && $_POST['keterangan'] !== '' ? $_POST['keterangan'] : '';
        $totalkomponen = $_POST['totalkomponen'] && $_POST['totalkomponen'] !== '' ? $_POST['totalkomponen'] : 0;
        $totalbarang = $_POST['totalbarang'] && $_POST['totalbarang'] !== '' ? $_POST['totalbarang'] : 0;
        $additionalcosts_display = $_POST['additionalcosts_display'] && $_POST['additionalcosts_display'] !== '' ? $_POST['additionalcosts_display'] : 0;
        function roundUpTo100($value)
        {
            return ceil($value / 100) * 100;
        }
        $thn = date('y');
        $bln = date('m');
        $hari = date('d');
        date_default_timezone_set("Asia/Bangkok");
        $jam = date("H:i:s");
        $datetime = DateTime::createFromFormat('Y-m-d', $tanggal);
        $tgl = date('Y-m-d');


        if ($datetime) {
            $formattedDate = $datetime->format('Y-m-d H:i:s');
        }
        $tgl_build = $thn . $bln . $hari;
        $no_build = 'BUILD-' . $lokasi . '-' . $tgl_build;
        $char = substr($no_build, 0, 17);
        $query = "
            SELECT 
                MAX(no_urut) AS max_nourut 
            FROM 
                assemblies 
            WHERE 
                SUBSTR(build, 1, 17) = '$char'
        ";
        $hasil = mysqli_query($koneksi, $query);
        $hsl = mysqli_fetch_assoc($hasil);
        $no_urut = $hsl['max_nourut'] ? $hsl['max_nourut'] + 1 : 1;
        $noBuild = $char . '-' . sprintf("%04s", $no_urut);

        $assemblies = mysqli_query($koneksi, "INSERT into assemblies (`build`, `tanggal`, `kd_cus`, `oleh`, `no_urut`, `jam`, `total_components`, `total_results`, `additional_costs`, `sumber`, `keterangan`)
        values('$noBuild','$formattedDate','$lokasi','$nama_user','$no_urut','$jam','$totalkomponen','$totalbarang','$additionalcosts_display','$sumber','$keterangan')");

        $urutankomponen = 1;
        $urutanbarang = 1;

        foreach ($_POST['namakomponen'] as $index => $namaProduk) {
            $namakomponen = $_POST['namakomponen'][$index];
            $kodekomponen = $_POST['kodekomponen'][$index];
            $jml = $_POST['jml'][$index];
            $harga = $_POST['hargakomponen'][$index];
            $satuan = $_POST['satuan'][$index];
            $isi = $_POST['isikomponen'][$index];
            $total = $_POST['totalhargasmuakomponen'][$index];

            $nomorcomponen = "COMPONENTS-" . $noBuild . "-" . sprintf("%04s", $urutankomponen);
            $quantity = $isi * $jml;
            $negative_quantity = -$quantity;
            if ($quantity > 0) {
                $updatestock = mysqli_query($koneksi, "UPDATE inventory set 
            stok = stok - '$quantity'
            WHERE kd_brg = '$kodekomponen' AND kd_cus = '$lokasi'");
                if (mysqli_affected_rows($koneksi) == 0) {
                    $insertstock = mysqli_query($koneksi, "INSERT INTO inventory (kd_brg, kd_cus, stok,satuan) VALUES ('$kodekomponen', '$lokasi', '$negative_quantity','Pcs')");
                }
            }
            $assembly_components = mysqli_query($koneksi, "INSERT INTO `assembly_components`(`build_components`, `build`, `tanggal`, `kd_cus`, `kd_brg`,`nama_brg`, `banyak`, `harga`, `jumlah`, `satuan`, `qty_satuan`) 
            values('$nomorcomponen','$noBuild','$formattedDate','$lokasi','$kodekomponen','$namakomponen','$jml','$harga','$total','$satuan','$isi')");
            $qt_jual = $quantity;
            $nilai_jual =  $total;
            $query_check = "SELECT * FROM mutasi_stok WHERE tgl = '$tgl' AND kd_cus = '$lokasi' AND kd_brg = '$kodekomponen'";
            $result_check = mysqli_query($koneksi, $query_check);

            if (mysqli_num_rows($result_check) > 0) {
                // Update jika data sudah ada
                $query_update = "UPDATE mutasi_stok SET 
                    qt_pake = qt_pake + $qt_jual ,
                    nilai_pake = nilai_pake + $nilai_jual ,
                    qt_akhir = qt_akhir - $qt_jual,
                    nilai_akhir = IF(qt_akhir = 0,0, qt_akhir * harga_rata)
                WHERE tgl = '$tgl' AND kd_cus = '$lokasi' AND kd_brg = '$kodekomponen'";


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
                stok_opname, nilai_opname       
                FROM mutasi_stok 
                WHERE kd_cus = '$lokasi' AND kd_brg = '$kodekomponen' 
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
                } else {
                    $nilai_awal = 0;
                    $qty_awal = 0;
                    $stok_opname = 0;
                    $nilai_opname = 0;
                }
                // Tentukan nilai qty_awal
                $qty_awal = $stok_opname != 0 ? $stok_opname : $qty_awal;
                $nilai_awal = $nilai_opname != 0 ? $nilai_opname : $nilai_awal;
                $nilai_awal = is_numeric($nilai_awal) ? $nilai_awal : 0;
                $qty_awal = is_numeric($qty_awal) ? $qty_awal : 0;
                if ($qty_awal > 0) {
                    $harga_rata_sebelumnya = $nilai_awal / $qty_awal;
                } else {
                    $harga_rata_sebelumnya = $harga;
                }
                // Insert data baru
                $query_insert = "INSERT INTO mutasi_stok 
                (tgl, qty_awal, nilai_awal, qt_tersedia, nilai_tersedia,  
                harga_rata , kd_cus, kd_brg, satuan,
                qt_pake, nilai_pake,
                qt_akhir, nilai_akhir) VALUES (
                    '$tgl',
                    '$qty_awal',
                    '$nilai_awal',
                    '$qty_awal',
                    '$nilai_awal',
                    '$harga_rata_sebelumnya',
                    '$lokasi',
                    '$kodekomponen',
                    'Pcs',
                    '$qt_jual',
                    '$harga_rata_sebelumnya' * '$qt_jual',
                    '$qty_awal' - '$qt_jual',
                    '$harga_rata_sebelumnya' * ( '$qty_awal' - '$qt_jual' )
                )";
                $result_insert = mysqli_query($koneksi, $query_insert);
                if (!$result_insert) {
                    die("Query insert ke mutasi_semua gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
                }
            }
            $urutankomponen++;
        }
        foreach ($_POST['namabarangjadi'] as $index => $namaProduk) {
            $namabarangjadi = $_POST['namabarangjadi'][$index];
            $kodebarangjadi = $_POST['kodebarangjadi'][$index];
            $jml = $_POST['jmlbarangjadi'][$index];
            $harga = $_POST['hargabarangjadi'][$index];
            $satuan = $_POST['satuanbarangjadi'][$index];
            $isi = $_POST['isibarangjadi'][$index];
            $total = $_POST['totalbarangjadi'][$index];
            $hargaawal = $_POST['hargaawal'][$index];

            $nomorresults = "RESULTS-" . $noBuild . "-" . sprintf("%04s", $urutanbarang);
            $quantity = $isi * $jml;
            if ($quantity > 0) {
                $updatestock = mysqli_query($koneksi, "UPDATE inventory set 
            stok = stok + '$quantity'
            WHERE kd_brg = '$kodebarangjadi' AND kd_cus = '$lokasi'");
                if (mysqli_affected_rows($koneksi) == 0) {
                    $insertstock = mysqli_query($koneksi, "INSERT INTO inventory (kd_brg, kd_cus, stok,satuan) VALUES ('$kodebarangjadi', '$lokasi', '$quantity','Pcs')");
                }
            }
            $assembly_results = mysqli_query($koneksi, "INSERT INTO `assembly_results`(`build_results`, `build`, `tanggal`, `kd_cus`, `kd_brg`,`nama_brg`, `banyak`, `harga`, `jumlah`, `satuan`, `qty_satuan`, `harga_dasar`) 
            values('$nomorresults','$noBuild','$formattedDate','$lokasi','$kodebarangjadi','$namabarangjadi','$jml','$harga','$total','$satuan','$isi','$hargaawal')");
            $qt_jual = $quantity;
            $nilai_jual =  $total;
            $query_check = "SELECT kd_cus FROM mutasi_stok WHERE tgl = '$tgl' AND kd_cus = '$lokasi' AND kd_brg = '$kodebarangjadi'";
            $result_check = mysqli_query($koneksi, $query_check);

            if (mysqli_num_rows($result_check) > 0) {
                // Update jika data sudah ada
                $query_update = "UPDATE mutasi_stok SET 
                    qt_produksi = qt_produksi + $qt_jual,
                    nilai_produksi = nilai_produksi + $nilai_jual,
                    qt_tersedia = qt_tersedia + $qt_jual,
                    nilai_tersedia = nilai_tersedia + $nilai_jual,
                    harga_rata = CASE 
                                 WHEN qt_tersedia > 0 THEN nilai_tersedia / qt_tersedia
                                 ELSE $harga
                                 END,                          
                    hpp_jual = CASE 
                                 WHEN qt_tersedia > 0 THEN (nilai_tersedia / qt_tersedia) * qt_jual
                                 ELSE $harga * qt_jual
                                 END,
                    qt_akhir = qt_akhir + $qt_jual,
                    nilai_akhir = CASE 
                                 WHEN qt_tersedia > 0 THEN (nilai_tersedia / qt_tersedia) * qt_akhir
                                 ELSE $harga * qt_akhir
                                 END
                WHERE tgl = '$tgl' AND kd_cus = '$lokasi' AND kd_brg = '$kodebarangjadi'";

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
                stok_opname, nilai_opname       
                FROM mutasi_stok 
                WHERE kd_cus = '$lokasi' AND kd_brg = '$kodebarangjadi' 
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
                } else {
                    $nilai_awal = 0;
                    $qty_awal = 0;
                    $stok_opname = 0;
                    $nilai_opname = 0;
                }

                // Tentukan nilai qty_awal
                $qty_awal = $stok_opname != 0 ? $stok_opname : $qty_awal;
                $nilai_awal = $nilai_opname != 0 ? $nilai_opname : $nilai_awal;
                $nilai_awal = is_numeric($nilai_awal) ? $nilai_awal : 0;
                $qty_awal = is_numeric($qty_awal) ? $qty_awal : 0;
                $qt_tersedia = $qty_awal + $qt_jual;
                $nilai_tersedia = $nilai_awal + $nilai_jual;

                if ($qt_tersedia > 0) {
                    $harga_rata_sebelumnya = $nilai_tersedia / $qt_tersedia;
                } else {
                    $harga_rata_sebelumnya = $harga;
                }
                // Insert data baru
                $query_insert = "INSERT INTO mutasi_stok 
                (tgl, qty_awal,nilai_awal,qt_produksi, nilai_produksi, qt_tersedia, nilai_tersedia,  
                harga_rata , kd_cus, kd_brg, satuan,
                qt_akhir, nilai_akhir) VALUES (
                '$tgl',
                '$qty_awal',
                '$nilai_awal',
                '$qt_jual',
                '$nilai_jual',
                '$qt_tersedia',
                '$nilai_tersedia',
                '$harga_rata_sebelumnya',
                '$lokasi',
                '$kodebarangjadi',
                'Pcs',
                '$qt_tersedia',
                '$nilai_tersedia'
            )";
                $result_insert = mysqli_query($koneksi, $query_insert);
                if (!$result_insert) {
                    die("Query insert ke mutasi_semua gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
                }
            }
            $check_barang_sql = "SELECT COUNT(*) AS count,
            ktg_retail,ktg_online,ktg_ms,ktg_mg,ktg_mp,ktg_grosir,
            Satuan1,Satuan2,Satuan3,Satuan4,Satuan5,
            hrg_satuan1,hrg_satuan2,hrg_satuan3,hrg_satuan4,hrg_satuan5,
            hrg_satuan1_grosir,hrg_satuan2_grosir,hrg_satuan3_grosir,hrg_satuan4_grosir,hrg_satuan5_grosir,
            hrg_satuan1_online,hrg_satuan2_online,hrg_satuan3_online,hrg_satuan4_online,hrg_satuan5_online,
            hrg_satuan1_ms,hrg_satuan2_ms,hrg_satuan3_ms,hrg_satuan4_ms,hrg_satuan5_ms,
            hrg_satuan1_mg,hrg_satuan2_mg,hrg_satuan3_mg,hrg_satuan4_mg,hrg_satuan5_mg,
            hrg_satuan1_mp,hrg_satuan2_mp,hrg_satuan3_mp,hrg_satuan4_mp,hrg_satuan5_mp,qty_satuan1,qty_satuan2,qty_satuan3,qty_satuan4,qty_satuan5 
            FROM barang WHERE kd_brg='$kodebarangjadi'";
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
                                $temp_hargake[0] = roundUpTo100($quantityke[$i] * $harga * (1 + $s1["layer11"] / 100));
                            } else if (!empty($satuanke[$i])) {
                                for ($j = 1; $j <= $i; $j++) {
                                    $layer_column = "layer{$i}$j";
                                    $temp_hargake[$j - 1] = roundUpTo100($harga * $quantityke[$j] * (1 + $s1[$layer_column] / 100));
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
                barang SET harga = '$harga',
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
                WHERE kd_brg = '$kodebarangjadi'
                ";
                $result_query_update_barang = mysqli_query($koneksi, $query_update_barang);
                if (!$result_query_update_barang) {
                    die('Update Harga gagal dijalankan' . mysqli_error($koneksi));
                }
            }
            $urutanbarang++;
        }
        if ($assemblies and $assembly_components and $assembly_results) {
            mysqli_commit($koneksi);
            $_SESSION['status_simpan'] = 'berhasil';
            $result['success'] = true;
            $result['message'] = "Data berhasil disimpan";
            $result['no_build'] = $noBuild;
            header("Content-type:text/html; charset=UTF-8");
            echo json_encode($result, JSON_PRETTY_PRINT);
            echo "<script>window.location.href = '../../main.php?route=assembly';</script>";
        } else {
            mysqli_rollback($koneksi);
            $_SESSION['status_simpan'] = 'gagal';
            $result['success'] = false;
            $result['message'] = "Data gagal disimpan";
            header("Content-type:text/html; charset=UTF-8");
            echo json_encode($result, JSON_PRETTY_PRINT);
        }
    }
}
