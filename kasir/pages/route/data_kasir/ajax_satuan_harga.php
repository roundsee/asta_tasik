<?php
include "../../../../config/koneksi.php";
include '../../../../config/fungsi_rupiah.php';
header('Content-Type: application/json');
$kd_kota = isset($_SESSION['kd_kota']) ? $_SESSION['kd_kota'] : 'BDG';
$kd_cus = isset($_SESSION['kd_cus']) ? $_SESSION['kd_cus'] : '1308';
$kd_aplikasi = isset($_SESSION['kd_aplikasi']) ? $_SESSION['kd_aplikasi'] : '11';
$kodeinput = isset($_GET['kode']) ? $_GET['kode'] : '';
$satuan = isset($_GET['satuan']) ? $_GET['satuan'] : '';
$hrg = '';
$qty = '';
$kodeAppValue = $_COOKIE['kode_kategori'] ?? null;
function roundUpTo100($value)
{
    return ceil($value / 100) * 100;
}
$sql = "SELECT kd_brg,Satuan1,Satuan2,Satuan3,Satuan4,Satuan5, `hrg_satuan1`, `hrg_satuan2`, `hrg_satuan3`, `hrg_satuan4`, `hrg_satuan5`,
`hrg_satuan1_grosir`, `hrg_satuan2_grosir`, `hrg_satuan3_grosir`, `hrg_satuan4_grosir`, `hrg_satuan5_grosir`, `hrg_satuan1_online`, `hrg_satuan2_online`, `hrg_satuan3_online`, `hrg_satuan4_online`, `hrg_satuan5_online`, 
`hrg_satuan1_ms`, `hrg_satuan2_ms`, `hrg_satuan3_ms`, `hrg_satuan4_ms`, `hrg_satuan5_ms`, `hrg_satuan1_mg`, `hrg_satuan2_mg`, `hrg_satuan3_mg`, `hrg_satuan4_mg`, `hrg_satuan5_mg`, `hrg_satuan1_mp`, `hrg_satuan2_mp`, `hrg_satuan3_mp`, `hrg_satuan4_mp`, `hrg_satuan5_mp`
FROM barang WHERE kd_brg = ?;";
$stmt = mysqli_prepare($koneksi, $sql);
mysqli_stmt_bind_param($stmt, 's', $kodeinput);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$dataSatuan = mysqli_fetch_array($result, MYSQLI_ASSOC);

// menentukan kolom satuan

if ($kodeAppValue == 1) {
    if (trim($satuan) == trim($dataSatuan['Satuan1'])) {
        $qty = 'qty_satuan1';
        $hrg = 'hrg_satuan1';
    } elseif (trim($satuan) == trim($dataSatuan['Satuan2'])) {
        $qty = 'qty_satuan2';
        $hrg = 'hrg_satuan2';
    } elseif (trim($satuan) == trim($dataSatuan['Satuan3'])) {
        $qty = 'qty_satuan3';
        $hrg = 'hrg_satuan3';
    } elseif (trim($satuan) == trim($dataSatuan['Satuan4'])) {
        $qty = 'qty_satuan4';
        $hrg = 'hrg_satuan4';
    } elseif (trim($satuan) == trim($dataSatuan['Satuan5'])) {
        $qty = 'qty_satuan5';
        $hrg = 'hrg_satuan5';
    }
} elseif ($kodeAppValue == 2) {
    if (trim($satuan) == trim($dataSatuan['Satuan1'])) {
        $qty = 'qty_satuan1';
        $hrg = 'hrg_satuan1_grosir';
    } elseif (trim($satuan) == trim($dataSatuan['Satuan2'])) {
        $qty = 'qty_satuan2';
        $hrg = 'hrg_satuan2_grosir';
    } elseif (trim($satuan) == trim($dataSatuan['Satuan3'])) {
        $qty = 'qty_satuan3';
        $hrg = 'hrg_satuan3_grosir';
    } elseif (trim($satuan) == trim($dataSatuan['Satuan4'])) {
        $qty = 'qty_satuan4';
        $hrg = 'hrg_satuan4_grosir';
    } elseif (trim($satuan) == trim($dataSatuan['Satuan5'])) {
        $qty = 'qty_satuan5';
        $hrg = 'hrg_satuan5_grosir';
    }
} elseif ($kodeAppValue == 3) {
    if (trim($satuan) == trim($dataSatuan['Satuan1'])) {
        $qty = 'qty_satuan1';
        $hrg = 'hrg_satuan1_online';
    } elseif (trim($satuan) == trim($dataSatuan['Satuan2'])) {
        $qty = 'qty_satuan2';
        $hrg = 'hrg_satuan2_online';
    } elseif (trim($satuan) == trim($dataSatuan['Satuan3'])) {
        $qty = 'qty_satuan3';
        $hrg = 'hrg_satuan3_online';
    } elseif (trim($satuan) == trim($dataSatuan['Satuan4'])) {
        $qty = 'qty_satuan4';
        $hrg = 'hrg_satuan4_online';
    } elseif (trim($satuan) == trim($dataSatuan['Satuan5'])) {
        $qty = 'qty_satuan5';
        $hrg = 'hrg_satuan5_online';
    }
} elseif ($kodeAppValue == 4) {
    if (trim($satuan) == trim($dataSatuan['Satuan1'])) {
        $qty = 'qty_satuan1';
        $hrg = 'hrg_satuan1_ms';
    } elseif (trim($satuan) == trim($dataSatuan['Satuan2'])) {
        $qty = 'qty_satuan2';
        $hrg = 'hrg_satuan2_ms';
    } elseif (trim($satuan) == trim($dataSatuan['Satuan3'])) {
        $qty = 'qty_satuan3';
        $hrg = 'hrg_satuan3_ms';
    } elseif (trim($satuan) == trim($dataSatuan['Satuan4'])) {
        $qty = 'qty_satuan4';
        $hrg = 'hrg_satuan4_ms';
    } elseif (trim($satuan) == trim($dataSatuan['Satuan5'])) {
        $qty = 'qty_satuan5';
        $hrg = 'hrg_satuan5_ms';
    }
} elseif ($kodeAppValue == 5) {
    if (trim($satuan) == trim($dataSatuan['Satuan1'])) {
        $qty = 'qty_satuan1';
        $hrg = 'hrg_satuan1_mg';
    } elseif (trim($satuan) == trim($dataSatuan['Satuan2'])) {
        $qty = 'qty_satuan2';
        $hrg = 'hrg_satuan2_mg';
    } elseif (trim($satuan) == trim($dataSatuan['Satuan3'])) {
        $qty = 'qty_satuan3';
        $hrg = 'hrg_satuan3_mg';
    } elseif (trim($satuan) == trim($dataSatuan['Satuan4'])) {
        $qty = 'qty_satuan4';
        $hrg = 'hrg_satuan4_mg';
    } elseif (trim($satuan) == trim($dataSatuan['Satuan5'])) {
        $qty = 'qty_satuan5';
        $hrg = 'hrg_satuan5_mg';
    }
} elseif ($kodeAppValue == 6) {
    if (trim($satuan) == trim($dataSatuan['Satuan1'])) {
        $qty = 'qty_satuan1';
        $hrg = 'hrg_satuan1_mp';
    } elseif (trim($satuan) == trim($dataSatuan['Satuan2'])) {
        $qty = 'qty_satuan2';
        $hrg = 'hrg_satuan2_mp';
    } elseif (trim($satuan) == trim($dataSatuan['Satuan3'])) {
        $qty = 'qty_satuan3';
        $hrg = 'hrg_satuan3_mp';
    } elseif (trim($satuan) == trim($dataSatuan['Satuan4'])) {
        $qty = 'qty_satuan4';
        $hrg = 'hrg_satuan4_mp';
    } elseif (trim($satuan) == trim($dataSatuan['Satuan5'])) {
        $qty = 'qty_satuan5';
        $hrg = 'hrg_satuan5_mp';
    }
}

$tgl = date('Y-m-d');
$data = array();
if ($hrg == '' || $qty == '') {
    $sql = "SELECT b.kd_brg,b.nama,b.kd_subgrup,b.kd_grup,b.photo, b.harga AS harga
            FROM barang b
            WHERE 
            b.nama!='' AND b.kd_brg='$kodeinput';";
} else {
    $sql = "SELECT b.kd_brg,b.nama,b.kd_subgrup,b.kd_grup,b.photo, b.harga AS harga, {$qty}, {$hrg}
            FROM barang b
            WHERE 
            b.nama!='' AND b.kd_brg='$kodeinput';";
}
$query = mysqli_query($koneksi, $sql);
if (mysqli_num_rows($query) > 0) {
    $data = array('status' => 1, 'msg' => 'Data Found');
    $data['data'] = mysqli_fetch_all($query, MYSQLI_ASSOC);
    foreach ($data['data'] as $key => &$d) {
        $harga_dasar = 0;
        $d['harga'] = isset($d[$hrg]) ? $d[$hrg] : $d['harga'];
        $d['satuan_qty'] = isset($d[$qty]) ? $d[$qty] : 0;


        $harga_dasar = $d['harga'];
        $disc = 0;
        $kd_promo = '';
        $d['harga_dasar'] = format_rupiah($harga_dasar);
        $d['diskon'] = strval($disc);
        $d['kd_promo'] = $kd_promo;
    }
} else {
    $data = array('status' => 0, 'msg' => 'Data Not Found');
}
echo json_encode($data);
exit;
