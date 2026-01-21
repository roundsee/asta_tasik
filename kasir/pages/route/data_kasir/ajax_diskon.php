<?php
include "../../../../config/koneksi.php";
header('Content-Type: application/json');
$kode_brg = isset($_GET['kode']) ? $_GET['kode'] : '';
$satuan = isset($_GET['satuan']) ? $_GET['satuan'] : '';
$status_member = isset($_GET['status_member']) ? $_GET['status_member'] : '';

$sql = "SELECT kd_brg,Satuan1,Satuan2,Satuan3,Satuan4,Satuan5, `hrg_satuan1`, `hrg_satuan2`, `hrg_satuan3`, `hrg_satuan4`, `hrg_satuan5`,
`hrg_satuan1_grosir`, `hrg_satuan2_grosir`, `hrg_satuan3_grosir`, `hrg_satuan4_grosir`, `hrg_satuan5_grosir`, `hrg_satuan1_online`, `hrg_satuan2_online`, `hrg_satuan3_online`, `hrg_satuan4_online`, `hrg_satuan5_online`, 
`hrg_satuan1_ms`, `hrg_satuan2_ms`, `hrg_satuan3_ms`, `hrg_satuan4_ms`, `hrg_satuan5_ms`, `hrg_satuan1_mg`, `hrg_satuan2_mg`, `hrg_satuan3_mg`, `hrg_satuan4_mg`, `hrg_satuan5_mg`, `hrg_satuan1_mp`, `hrg_satuan2_mp`, `hrg_satuan3_mp`, `hrg_satuan4_mp`, `hrg_satuan5_mp`
FROM barang WHERE kd_brg = ?;";
$stmt = mysqli_prepare($koneksi, $sql);
mysqli_stmt_bind_param($stmt, 's', $kode_brg);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$dataSatuan = mysqli_fetch_array($result, MYSQLI_ASSOC);
$data = array();


if ($status_member == 1) {
    if (trim($satuan) == trim($dataSatuan['Satuan1'])) {
        $data['harga'] = $dataSatuan['hrg_satuan1'];
    } elseif (trim($satuan) == trim($dataSatuan['Satuan2'])) {
        $data['harga'] = $dataSatuan['hrg_satuan2'];
    } elseif (trim($satuan) == trim($dataSatuan['Satuan3'])) {
        $data['harga'] = $dataSatuan['hrg_satuan3'];
    } elseif (trim($satuan) == trim($dataSatuan['Satuan4'])) {
        $data['harga'] = $dataSatuan['hrg_satuan4'];
    } elseif (trim($satuan) == trim($dataSatuan['Satuan5'])) {
        $data['harga'] = $dataSatuan['hrg_satuan5'];
    }
} elseif ($status_member == 2) {
    if (trim($satuan) == trim($dataSatuan['Satuan1'])) {
        $data['harga'] = $dataSatuan['hrg_satuan1_grosir'];
    } elseif (trim($satuan) == trim($dataSatuan['Satuan2'])) {
        $data['harga'] = $dataSatuan['hrg_satuan2_grosir'];
    } elseif (trim($satuan) == trim($dataSatuan['Satuan3'])) {
        $data['harga'] = $dataSatuan['hrg_satuan3_grosir'];
    } elseif (trim($satuan) == trim($dataSatuan['Satuan4'])) {
        $data['harga'] = $dataSatuan['hrg_satuan4_grosir'];
    } elseif (trim($satuan) == trim($dataSatuan['Satuan5'])) {
        $data['harga'] = $dataSatuan['hrg_satuan5_grosir'];
    }
} elseif ($status_member == 3) {
    if (trim($satuan) == trim($dataSatuan['Satuan1'])) {
        $data['harga'] = $dataSatuan['hrg_satuan1_online'];
    } elseif (trim($satuan) == trim($dataSatuan['Satuan2'])) {
        $data['harga'] = $dataSatuan['hrg_satuan2_online'];
    } elseif (trim($satuan) == trim($dataSatuan['Satuan3'])) {
        $data['harga'] = $dataSatuan['hrg_satuan3_online'];
    } elseif (trim($satuan) == trim($dataSatuan['Satuan4'])) {
        $data['harga'] = $dataSatuan['hrg_satuan4_online'];
    } elseif (trim($satuan) == trim($dataSatuan['Satuan5'])) {
        $data['harga'] = $dataSatuan['hrg_satuan5_online'];
    }
} elseif ($status_member == 4) {
    if (trim($satuan) == trim($dataSatuan['Satuan1'])) {
        $data['harga'] = $dataSatuan['hrg_satuan1_ms'];
    } elseif (trim($satuan) == trim($dataSatuan['Satuan2'])) {
        $data['harga'] = $dataSatuan['hrg_satuan2_ms'];
    } elseif (trim($satuan) == trim($dataSatuan['Satuan3'])) {
        $data['harga'] = $dataSatuan['hrg_satuan3_ms'];
    } elseif (trim($satuan) == trim($dataSatuan['Satuan4'])) {
        $data['harga'] = $dataSatuan['hrg_satuan4_ms'];
    } elseif (trim($satuan) == trim($dataSatuan['Satuan5'])) {
        $data['harga'] = $dataSatuan['hrg_satuan5_ms'];
    }
} elseif ($status_member == 5) {
    if (trim($satuan) == trim($dataSatuan['Satuan1'])) {
        $data['harga'] = $dataSatuan['hrg_satuan1_mg'];
    } elseif (trim($satuan) == trim($dataSatuan['Satuan2'])) {
        $data['harga'] = $dataSatuan['hrg_satuan2_mg'];
    } elseif (trim($satuan) == trim($dataSatuan['Satuan3'])) {
        $data['harga'] = $dataSatuan['hrg_satuan3_mg'];
    } elseif (trim($satuan) == trim($dataSatuan['Satuan4'])) {
        $data['harga'] = $dataSatuan['hrg_satuan4_mg'];
    } elseif (trim($satuan) == trim($dataSatuan['Satuan5'])) {
        $data['harga'] = $dataSatuan['hrg_satuan5_mg'];
    }
} elseif ($status_member == 6) {
    if (trim($satuan) == trim($dataSatuan['Satuan1'])) {
        $data['harga'] = $dataSatuan['hrg_satuan1_mp'];
    } elseif (trim($satuan) == trim($dataSatuan['Satuan2'])) {
        $data['harga'] = $dataSatuan['hrg_satuan2_mp'];
    } elseif (trim($satuan) == trim($dataSatuan['Satuan3'])) {
        $data['harga'] = $dataSatuan['hrg_satuan3_mp'];
    } elseif (trim($satuan) == trim($dataSatuan['Satuan4'])) {
        $data['harga'] = $dataSatuan['hrg_satuan4_mp'];
    } elseif (trim($satuan) == trim($dataSatuan['Satuan5'])) {
        $data['harga'] = $dataSatuan['hrg_satuan5_mp'];
    }
}
echo json_encode($data);
exit;
