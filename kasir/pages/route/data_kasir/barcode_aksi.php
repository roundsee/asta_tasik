<?php
include "../../../../config/koneksi.php";
include '../../../../config/fungsi_rupiah.php';
header('Content-Type: application/json');
$kd_kota = isset($_SESSION['kd_kota']) ? $_SESSION['kd_kota'] : 'BDG';
$kd_cus = isset($_SESSION['kd_cus']) ? $_SESSION['kd_cus'] : '1308';
$kd_aplikasi = isset($_SESSION['kd_aplikasi']) ? $_SESSION['kd_aplikasi'] : '11';
$kodeinput = $_GET['kode'];
$kodeAppValue = $_COOKIE['kode_kategori'] ?? null;
$kategoristokharga = $_COOKIE['kode_kategori_tambahan'] ?? null;

$kodestock = 1316;
if ($kategoristokharga >= 2) {
    $kodestock = 8001;
}

$tgl = date('Y-m-d');
$data = array();
$sql = "SELECT b.kd_brg,b.nama,b.kd_subgrup,b.kd_grup,b.photo, b.hrg_satuan1 AS harga,
        hrg_satuan1_grosir,hrg_satuan2_grosir,hrg_satuan3_grosir,hrg_satuan4_grosir,hrg_satuan5_grosir,hrg_satuan1_online,
        hrg_satuan1_ms,hrg_satuan1_mg,hrg_satuan1_mp, 
        hrg_satuan2_ms,hrg_satuan2_mg,hrg_satuan2_mp,
        hrg_satuan3_ms,hrg_satuan3_mg,hrg_satuan3_mp,
        hrg_satuan4_ms,hrg_satuan4_mg,hrg_satuan4_mp,
        hrg_satuan5_ms,hrg_satuan5_mg,hrg_satuan5_mp,
        b.Satuan1, b.qty_satuan1, b.ktg_online, b.ktg_ms, b.ktg_mg, b.ktg_mp,b.ktg_grosir,b.Satuan2,b.Satuan3,b.Satuan4,b.Satuan5,b.ktg_retail,
        b.qty_satuan2,qty_satuan3,qty_satuan4,qty_satuan5,IFNULL((SELECT stok FROM inventory WHERE inventory.kd_brg = b.kd_brg AND kd_cus = '$kodestock'),0) as stock, 
        ifnull(b.Pcs,0) as Pcs,ifnull(b.Renteng,0) as Renteng
        FROM barang b
        WHERE 
        b.nama!='' AND b.kd_brg='$kodeinput' AND kd_subgrup is null LIMIT 1;";
$query = mysqli_query($koneksi, $sql);
function roundUpTo100($value)
{
    return ceil($value / 100) * 100;
}
if (mysqli_num_rows($query) > 0) {
    $data = array('status' => 1, 'msg' => 'Data Found');
    $data['data'] = mysqli_fetch_all($query, MYSQLI_ASSOC);
    foreach ($data['data'] as $key => &$d) {
        $harga_dasar = $d['harga'];
        $d['harga_dasar'] = format_rupiah($harga_dasar);
        $disc = 0;
        $kd_promo = '';
        if ($kodeAppValue == 2) {
            if (!empty($d['Satuan5']) && $d['Satuan5'] != " ") {
                $d['harga'] = $d['hrg_satuan5_grosir'];
                $d['qty_satuan1'] =  $d['qty_satuan5'];
                $d['Satuan1'] = $d['Satuan5'];
            } else if (!empty($d['Satuan4']) && $d['Satuan4'] != " ") {
                $d['harga'] = $d['hrg_satuan4_grosir'];
                $d['qty_satuan1'] =  $d['qty_satuan4'];
                $d['Satuan1'] = $d['Satuan4'];
            } else if (!empty($d['Satuan3']) && $d['Satuan3'] != " ") {
                $d['harga'] = $d['hrg_satuan3_grosir'];
                $d['qty_satuan1'] =  $d['qty_satuan3'];
                $d['Satuan1'] = $d['Satuan3'];
            } else if (!empty($d['Satuan2']) && $d['Satuan2'] != " ") {
                $d['harga'] = $d['hrg_satuan2_grosir'];
                $d['qty_satuan1'] =  $d['qty_satuan2'];
                $d['Satuan1'] = $d['Satuan2'];
            } else if (!empty($d['Satuan1']) && $d['Satuan1'] != " ") {
                $d['harga'] = $d['hrg_satuan1_grosir'];
            }
        } elseif ($kodeAppValue == 3) {
            $d['harga'] = $d['hrg_satuan1_online'];
        } elseif ($kodeAppValue == 4) {
            $d['harga'] = $d['hrg_satuan1_ms'];
            if ($kategoristokharga == 2) {
                if (!empty($d['Satuan5']) && $d['Satuan5'] != " ") {
                    $d['harga'] = $d['hrg_satuan5_ms'];
                    $d['qty_satuan1'] =  $d['qty_satuan5'];
                    $d['Satuan1'] = $d['Satuan5'];
                } else if (!empty($d['Satuan4']) && $d['Satuan4'] != " ") {
                    $d['harga'] = $d['hrg_satuan4_ms'];
                    $d['qty_satuan1'] =  $d['qty_satuan4'];
                    $d['Satuan1'] = $d['Satuan4'];
                } else if (!empty($d['Satuan3']) && $d['Satuan3'] != " ") {
                    $d['harga'] = $d['hrg_satuan3_ms'];
                    $d['qty_satuan1'] =  $d['qty_satuan3'];
                    $d['Satuan1'] = $d['Satuan3'];
                } else if (!empty($d['Satuan2']) && $d['Satuan2'] != " ") {
                    $d['harga'] = $d['hrg_satuan2_ms'];
                    $d['qty_satuan1'] =  $d['qty_satuan2'];
                    $d['Satuan1'] = $d['Satuan2'];
                } else if (!empty($d['Satuan1']) && $d['Satuan1'] != " ") {
                    $d['harga'] = $d['hrg_satuan1_ms'];
                }
            }
        } elseif ($kodeAppValue == 5) {
            $d['harga'] = $d['hrg_satuan1_mg'];
            if ($kategoristokharga == 2) {
                if (!empty($d['Satuan5']) && $d['Satuan5'] != " ") {
                    $d['harga'] = $d['hrg_satuan5_mg'];
                    $d['qty_satuan1'] =  $d['qty_satuan5'];
                    $d['Satuan1'] = $d['Satuan5'];
                } else if (!empty($d['Satuan4']) && $d['Satuan4'] != " ") {
                    $d['harga'] = $d['hrg_satuan4_mg'];
                    $d['qty_satuan1'] =  $d['qty_satuan4'];
                    $d['Satuan1'] = $d['Satuan4'];
                } else if (!empty($d['Satuan3']) && $d['Satuan3'] != " ") {
                    $d['harga'] = $d['hrg_satuan3_mg'];
                    $d['qty_satuan1'] =  $d['qty_satuan3'];
                    $d['Satuan1'] = $d['Satuan3'];
                } else if (!empty($d['Satuan2']) && $d['Satuan2'] != " ") {
                    $d['harga'] = $d['hrg_satuan2_mg'];
                    $d['qty_satuan1'] =  $d['qty_satuan2'];
                    $d['Satuan1'] = $d['Satuan2'];
                } else if (!empty($d['Satuan1']) && $d['Satuan1'] != " ") {
                    $d['harga'] = $d['hrg_satuan1_mg'];
                }
            }
        } elseif ($kodeAppValue == 6) {
            $d['harga'] = $d['hrg_satuan1_mp'];
            if ($kategoristokharga == 2) {
                if (!empty($d['Satuan5']) && $d['Satuan5'] != " ") {
                    $d['harga'] = $d['hrg_satuan5_mp'];
                    $d['qty_satuan1'] =  $d['qty_satuan5'];
                    $d['Satuan1'] = $d['Satuan5'];
                } else if (!empty($d['Satuan4']) && $d['Satuan4'] != " ") {
                    $d['harga'] = $d['hrg_satuan4_mp'];
                    $d['qty_satuan1'] =  $d['qty_satuan4'];
                    $d['Satuan1'] = $d['Satuan4'];
                } else if (!empty($d['Satuan3']) && $d['Satuan3'] != " ") {
                    $d['harga'] = $d['hrg_satuan3_mp'];
                    $d['qty_satuan1'] =  $d['qty_satuan3'];
                    $d['Satuan1'] = $d['Satuan3'];
                } else if (!empty($d['Satuan2']) && $d['Satuan2'] != " ") {
                    $d['harga'] = $d['hrg_satuan2_mp'];
                    $d['qty_satuan1'] =  $d['qty_satuan2'];
                    $d['Satuan1'] = $d['Satuan2'];
                } else if (!empty($d['Satuan1']) && $d['Satuan1'] != " ") {
                    $d['harga'] = $d['hrg_satuan1_mp'];
                }
            }
        }
        if ($d['ktg_retail'] != "manual" || $d['ktg_online'] != "manual" || $d['ktg_grosir'] != "manual" || $d['ktg_ms'] != "manual" || $d['ktg_mg'] != "manual" || $d['ktg_mp'] != "manual") {
            $d['kategorihargamanual'] = $d['ktg_retail'];
        } else {
            $d['kategorihargamanual'] = "manual";
        }
        $d['diskon'] = strval($disc);
        $d['kd_promo'] = $kd_promo;
    }
} else {
    $data = array('status' => 0, 'msg' => 'Data Not Found');
}
echo json_encode($data);
exit;
