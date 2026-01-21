<?php
include "../../../../config/koneksi.php";
header('Content-Type: application/json');
$kode_brg = isset($_GET['kode']) ? $_GET['kode'] : '';
$satuan = isset($_GET['satuan']) ? $_GET['satuan'] : '';
$status_member = isset($_GET['status_member']) ? $_GET['status_member'] : '';
$hrg = '';
$kode_ktg = '';
function roundUpTo100($value)
{
    return ceil($value / 100) * 100;
}

if ($status_member == 1) {
    $kode_ktg = 'ktg_retail';
} elseif ($status_member == 2) {
    $kode_ktg = 'ktg_grosir';
} elseif ($status_member == 3) {
    $kode_ktg = 'ktg_online';
} elseif ($status_member == 4) {
    $kode_ktg = 'ktg_ms';
} elseif ($status_member == 5) {
    $kode_ktg = 'ktg_mg';
} elseif ($status_member == 6) {
    $kode_ktg = 'ktg_mp';
}


$sql = "SELECT kd_brg,Satuan1,Satuan2,Satuan3,Satuan4,Satuan5
FROM barang WHERE kd_brg = ?;";
$stmt = mysqli_prepare($koneksi, $sql);
mysqli_stmt_bind_param($stmt, 's', $kode_brg);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$dataSatuan = mysqli_fetch_array($result, MYSQLI_ASSOC);

// menentukan kolom satuan
if ($satuan == $dataSatuan['Satuan1']) {
    $hrg = 'hrg_satuan1';
} elseif ($satuan == $dataSatuan['Satuan2']) {
    $hrg = 'hrg_satuan2';
} elseif ($satuan == $dataSatuan['Satuan3']) {
    $hrg = 'hrg_satuan3';
} elseif ($satuan == $dataSatuan['Satuan4']) {
    $hrg = 'hrg_satuan4';
} elseif ($satuan == $dataSatuan['Satuan5']) {
    $hrg = 'hrg_satuan5';
}


$querysql1 = mysqli_query($koneksi, "SELECT IFNULL(kategori_nilai.layer1,0) AS layer11,IFNULL(SUBSTRING_INDEX(kategori_nilai.layer2, '|', 1),0) AS layer21, IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(kategori_nilai.layer2, '|', 2), '|', -1),0) AS layer22,IFNULL(SUBSTRING_INDEX(kategori_nilai.layer3, '|', 1),0) AS layer31,  IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(kategori_nilai.layer3, '|', 2), '|', -1),0) AS layer32,  IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(kategori_nilai.layer3, '|', 3), '|', -1),0) AS layer33, IFNULL(SUBSTRING_INDEX(kategori_nilai.layer4, '|', 1),0) AS layer41, IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(kategori_nilai.layer4, '|', 2), '|', -1),0) AS layer42, IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(kategori_nilai.layer4, '|', 3), '|', -1),0) AS layer43, IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(kategori_nilai.layer4, '|', 4), '|', -1),0) AS layer44,  IFNULL(SUBSTRING_INDEX(kategori_nilai.layer5, '|', 1),0) AS layer51,  IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(kategori_nilai.layer5, '|', 2), '|', -1),0) AS layer52, IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(kategori_nilai.layer5, '|', 3), '|', -1),0) AS layer53,  IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(kategori_nilai.layer5, '|', 4), '|', -1),0) AS layer54,  IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(kategori_nilai.layer5, '|', 5), '|', -1),0) AS layer55,
kategori_nilai.id_kat,kategori_nilai.Nama_kategoriNilai,barang.`$kode_ktg`,barang.harga
FROM barang JOIN kategori_nilai ON barang.`$kode_ktg` = kategori_nilai.Nama_kategoriNilai where kategori_nilai.id_kat = $status_member AND barang.kd_brg = $kode_brg ");
while ($s1 = mysqli_fetch_array($querysql1)) {

    if (!empty($dataSatuan['Satuan5'])) {
        if ($hrg == 'hrg_satuan5') {
            $data['harga'] = $s1['harga'] + ($s1['harga'] * $s1['layer55'] / 100);
        } else if ($hrg == 'hrg_satuan4') {
            $data['harga'] = $s1['harga'] + ($s1['harga'] * $s1['layer54'] / 100);
        } else if ($hrg == 'hrg_satuan3') {
            $data['harga'] = $s1['harga'] + ($s1['harga'] * $s1['layer53'] / 100);
        } else if ($hrg == 'hrg_satuan2') {
            $data['harga'] = $s1['harga'] + ($s1['harga'] * $s1['layer52'] / 100);
        } else if ($hrg == 'hrg_satuan1') {
            $data['harga'] = $s1['harga'] + ($s1['harga'] * $s1['layer51'] / 100);
        }
    } else if (!empty($dataSatuan['Satuan4'])) {
        if ($hrg == 'hrg_satuan4') {
            $data['harga'] = $s1['harga'] + ($s1['harga'] * $s1['layer44'] / 100);
        } else if ($hrg == 'hrg_satuan3') {
            $data['harga'] = $s1['harga'] + ($s1['harga'] * $s1['layer43'] / 100);
        } else if ($hrg == 'hrg_satuan2') {
            $data['harga'] = $s1['harga'] + ($s1['harga'] * $s1['layer42'] / 100);
        } else if ($hrg == 'hrg_satuan1') {
            $data['harga'] = $s1['harga'] + ($s1['harga'] * $s1['layer41'] / 100);
        }
    } else if (!empty($dataSatuan['Satuan3'])) {
        if ($hrg == 'hrg_satuan3') {
            $data['harga'] = $s1['harga'] + ($s1['harga'] * $s1['layer33'] / 100);
        } else if ($hrg == 'hrg_satuan2') {
            $data['harga'] = $s1['harga'] + ($s1['harga'] * $s1['layer32'] / 100);
        } else if ($hrg == 'hrg_satuan1') {
            $data['harga'] = $s1['harga'] + ($s1['harga'] * $s1['layer31'] / 100);
        }
    } else if (!empty($dataSatuan['Satuan2'])) {
        if ($hrg == 'hrg_satuan2') {
            $data['harga'] = $s1['harga'] + ($s1['harga'] * $s1['layer22'] / 100);
        } else if ($hrg == 'hrg_satuan1') {
            $data['harga'] = $s1['harga'] + ($s1['harga'] * $s1['layer21'] / 100);
        }
    } else if (!empty($dataSatuan['Satuan1'])) {
        $data['harga'] = $s1['harga'] + ($s1['harga'] * $s1['layer11'] / 100);
    }
    $data['harga'] = roundUpTo100($data['harga']);
}
echo json_encode($data);
exit;
