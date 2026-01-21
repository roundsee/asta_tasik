<?php
include "../../../../config/koneksi.php";
header('Content-Type: application/json');
$keteranganvoid = isset($_GET['keteranganvoid']) ? $_GET['keteranganvoid'] : '';
$nomorfaktur = isset($_GET['nomorfaktur']) ? $_GET['nomorfaktur'] : '';
$emplyeenumber = isset($_GET['emplyeenumber']) ? $_GET['emplyeenumber'] : '';
function roundUpTo100($value)
{
    return ceil($value / 100) * 100;
}
$tgl = date('Y-m-d');

$query = mysqli_query($koneksi, "SELECT name_e FROM `employee` WHERE employee_number ='$emplyeenumber' ");
while ($q = mysqli_fetch_array($query)) {
    mysqli_query($koneksi, "UPDATE assemblies SET 
    user_void='$q[name_e]',keterangan_void='$keteranganvoid'
    WHERE build='$nomorfaktur' ") or die(mysqli_errno($koneksi));
}


$querycomponents = mysqli_query($koneksi, "SELECT kd_cus,kd_brg,banyak,qty_satuan,jumlah FROM `assembly_components` WHERE build ='$nomorfaktur' ");
while ($qcomponents = mysqli_fetch_array($querycomponents)) {
    $quantity = $qcomponents['banyak'] * $qcomponents['qty_satuan'];
    $total = $qcomponents['jumlah'];
    if ($quantity > 0) {
        $updatestock = mysqli_query($koneksi, "UPDATE inventory set 
        stok = stok + '$quantity'
        WHERE kd_brg = '$qcomponents[kd_brg]' AND kd_cus = '$qcomponents[kd_cus]'");
        if (mysqli_affected_rows($koneksi) == 0) {
            $insertstock = mysqli_query($koneksi, "INSERT INTO inventory (kd_brg, kd_cus, stok,satuan) VALUES ('$qcomponents[kd_brg]', '$qcomponents[kd_cus]', '$quantity','Pcs')");
        }
    }
    $qt_jual = $quantity;
    $nilai_jual =  $total;
    $query_update = "UPDATE mutasi_stok SET 
        qt_pake = qt_pake - $qt_jual ,
        nilai_pake = nilai_pake - $nilai_jual ,
        qt_akhir = qt_akhir + $qt_jual,
        nilai_akhir = IF(qt_akhir = 0,0, qt_akhir * harga_rata)
    WHERE tgl = '$tgl' AND kd_cus = '$qcomponents[kd_cus]' AND kd_brg = '$qcomponents[kd_brg]'";


    $resut_update = mysqli_query($koneksi, $query_update);
    if (!$resut_update) {
        die("Query update ke mutasi_semua gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
    }
}

$queryresults = mysqli_query($koneksi, "SELECT kd_cus,kd_brg,banyak,qty_satuan,harga,harga_dasar,jumlah FROM `assembly_results` WHERE build ='$nomorfaktur' ");
while ($qresults = mysqli_fetch_array($queryresults)) {
    $quantity = $qresults['banyak'] * $qresults['qty_satuan'];
    $hargabaru = $qresults['harga'];
    $hargalama = $qresults['harga_dasar'];
    $kodebarangjadi = $qresults['kd_brg'];
    $total = $qresults['jumlah'];

    if ($quantity > 0) {
        $updatestock = mysqli_query($koneksi, "UPDATE inventory set 
        stok = stok - '$quantity'
        WHERE kd_brg = '$qresults[kd_brg]' AND kd_cus = '$qresults[kd_cus]'");
        if (mysqli_affected_rows($koneksi) == 0) {
            $insertstock = mysqli_query($koneksi, "INSERT INTO inventory (kd_brg, kd_cus, stok,satuan) VALUES ('$qresults[kd_brg]', '$qresults[kd_cus]', '$quantity','Pcs')");
        }
    }
    $qt_jual = $quantity;
    $nilai_jual =  $total;
    $query_update = "UPDATE mutasi_stok SET 
        qt_produksi = qt_produksi - $qt_jual,
        nilai_produksi = nilai_produksi - $nilai_jual,
        qt_tersedia = qt_tersedia - $qt_jual,
        nilai_tersedia = nilai_tersedia - $nilai_jual,
        harga_rata = CASE 
                     WHEN qt_tersedia > 0 THEN nilai_tersedia / qt_tersedia
                     ELSE 0 
                     END,                          
        hpp_jual = CASE 
                     WHEN qt_tersedia > 0 THEN (nilai_tersedia / qt_tersedia) * qt_jual
                     ELSE 0 
                     END,
        qt_akhir = qt_akhir - $qt_jual,
        nilai_akhir = CASE 
                     WHEN qt_tersedia > 0 THEN (nilai_tersedia / qt_tersedia) * qt_akhir
                     ELSE 0 
                     END
    WHERE tgl = '$tgl' AND kd_cus = '$qresults[kd_cus]' AND kd_brg = '$kodebarangjadi'";

    $resut_update = mysqli_query($koneksi, $query_update);
    if (!$resut_update) {
        die("Query update ke mutasi_semua gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
    }
    if ($hargabaru != $hargalama) {
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
                            $temp_hargake[0] = roundUpTo100($quantityke[$i] * $hargalama * (1 + $s1["layer11"] / 100));
                        } else if (!empty($satuanke[$i])) {
                            for ($j = 1; $j <= $i; $j++) {
                                $layer_column = "layer{$i}$j";
                                $temp_hargake[$j - 1] = roundUpTo100($hargalama * $quantityke[$j] * (1 + $s1[$layer_column] / 100));
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
                            $temp_hargamanualke[$i] = !empty($check_barang_data['hrg_satuan' . $i + 1 . $prefixes]) ? $check_barang_data['hrg_satuan' . $i + 1 . $prefixes] : 0;
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
                barang SET harga = '$hargalama',
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
    }
}

$data = $nomorfaktur;
echo json_encode($data);
exit;
