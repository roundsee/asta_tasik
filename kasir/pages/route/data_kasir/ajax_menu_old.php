<?php

session_start();
$dir = '../../';
include_once '../../../../config/koneksi.php';
include '../../../../config/fungsi_rupiah.php';

$tgl = date('Y-m-d');

$kd_aplikasi = $_POST['kd_aplikasi'];
$_SESSION['kd_aplikasi'] = $kd_aplikasi;
$kd_aplikasi = $_SESSION['kd_aplikasi'];
$kd_kota = $_SESSION['kd_kota'];
$kd_cus = $_SESSION['kd_cus'];
$kodeAppValue = $_COOKIE['kode_kategori'] ?? null;


$query = mysqli_query($koneksi, "SELECT id_kat FROM pelanggan where kd_cus='$kd_cus' ");
$q1 = mysqli_fetch_array($query);

$id_kat = $q1['id_kat'];

// print_r($_SESSION);
// echo $kd_aplikasi;

?>

<style type="text/css">
    .col-sm-2 {
        width: 19%;
    }
</style>


<input type="hidden" name="kd_aplikasi" value="<?php echo $kd_aplikasi; ?>">
<div class="row table-responsive" style="height: 85%;width:100%;overflow-x: hidden;">
    <div class="filter-container p-0 row" style="height:186px!important;padding-right: 10px;">

        <?php

        if (!empty($_POST["kd_aplikasi"])) { ?>
            <div id="makanan">

                <?php
                $data = mysqli_query($koneksi, "SELECT b.kd_brg, b.nama, b.kd_subgrup, b.kd_grup, b.photo, b.hrg_satuan1 AS harga, 
        b.Satuan1, b.qty_satuan1, b.ktg_online, b.ktg_ms, b.ktg_mg, b.ktg_mp,b.ktg_grosir,b.Satuan2,b.Satuan3,b.Satuan4,b.Satuan5, b.qty_satuan2, b.qty_satuan3, b.qty_satuan4, b.qty_satuan5
          FROM barang b
          WHERE 
          b.nama!='';");

                // $d = mysqli_fetch_array($data);
                // print_r($d);

                while ($d = mysqli_fetch_array($data)) {

                    if ($kd_aplikasi == 11) {
                        $harga_dasar = $d['harga'];
                    } elseif ($d['harga_dine_in'] == 0) {
                        $harga_dasar = $d['harga'] - ($d['harga'] * 10 / 100);
                    } else {
                        $harga_dasar = $d['harga_dine_in'];
                    }

                    $data1 = mysqli_query($koneksi, "SELECT kd_promo,diskon,ket FROM tarif_diskon
            WHERE
            tgl_awal<= '$tgl' AND
            tgl_akhir>= '$tgl' AND
            kd_jenis = '$kd_aplikasi' AND
            (cakupan = 'Nasional' OR kd_kota = '$kd_kota' OR kd_cus = '$kd_cus' ) AND
            (kd_brg = 'Semua' OR kd_brg = '$d[kd_brg]' ) 
            ORDER BY diskon ");


                    $d1 = mysqli_fetch_array($data1);

                    if ($d1 == null) {
                        $disc = 0;
                        $kd_promo = '';
                    } else {
                        if ($d1['ket'] == 'Persen') {
                            $disc = ($d1['diskon'] / 100) * $d['harga'];
                            $kd_promo = $d1['kd_promo'];
                        } else {
                            $disc = $d1['diskon'];
                            $kd_promo = $d1['kd_promo'];
                        }
                    }
                    $kode_ktg = '';
                    $kode_barang23 = $d['kd_brg'];
                    $satuan222 = $d['Satuan1'];
                    $quantitiy222 = $d['qty_satuan1'];

                    if ($kodeAppValue == 2) {
                        $kode_ktg = 'ktg_grosir';
                    } elseif ($kodeAppValue == 3) {
                        $kode_ktg = 'ktg_online';
                    } elseif ($kodeAppValue == 4) {
                        $kode_ktg = 'ktg_ms';
                    } elseif ($kodeAppValue == 5) {
                        $kode_ktg = 'ktg_mg';
                    } elseif ($kodeAppValue == 6) {
                        $kode_ktg = 'ktg_mp';
                    }
                    if ($kodeAppValue != 1) {
                        $querysql1 = mysqli_query($koneksi, "SELECT IFNULL(kategori_nilai.layer1,0) AS layer11,
            IFNULL(SUBSTRING_INDEX(kategori_nilai.layer2, '-', 1),0) AS layer21,
            IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(kategori_nilai.layer2, '-', 2), '-', -1),0) AS layer22,
            IFNULL(SUBSTRING_INDEX(kategori_nilai.layer3, '-', 1),0) AS layer31,
            IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(kategori_nilai.layer3, '-', 3), '-', -1),0) AS layer33,
            IFNULL(SUBSTRING_INDEX(kategori_nilai.layer4, '-', 1),0) AS layer41,
            IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(kategori_nilai.layer4, '-', 4), '-', -1),0) AS layer44,
            IFNULL(SUBSTRING_INDEX(kategori_nilai.layer5, '-', 1),0) AS layer51,
            IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(kategori_nilai.layer5, '-', 5), '-', -1),0) AS layer55,
            kategori_nilai.id_kat,kategori_nilai.Nama_kategoriNilai,barang.`$kode_ktg`,barang.harga
            FROM barang JOIN kategori_nilai ON barang.`$kode_ktg` = kategori_nilai.Nama_kategoriNilai 
            where kategori_nilai.id_kat = $kodeAppValue AND barang.kd_brg = $kode_barang23 ");

                        while ($s1 = mysqli_fetch_array($querysql1)) {
                            if ($kodeAppValue == 2) {
                                if (!empty($d['Satuan5'])) {
                                    $d['harga'] = $s1['harga'] + ($s1['harga'] * $s1['layer55'] / 100);
                                    $satuan222 = $d['Satuan5'];
                                    $quantitiy222 = $d['qty_satuan5'];
                                } else if (!empty($d['Satuan4'])) {
                                    $d['harga'] = $s1['harga'] + ($s1['harga'] * $s1['layer44'] / 100);
                                    $satuan222 = $d['Satuan4'];
                                    $quantitiy222 = $d['qty_satuan4'];
                                } else if (!empty($d['Satuan3'])) {
                                    $d['harga'] = $s1['harga'] + ($s1['harga'] * $s1['layer33'] / 100);
                                    $satuan222 = $d['Satuan3'];
                                    $quantitiy222 = $d['qty_satuan3'];
                                } else if (!empty($d['Satuan2'])) {
                                    $d['harga'] = $s1['harga'] + ($s1['harga'] * $s1['layer22'] / 100);
                                    $satuan222 = $d['Satuan2'];
                                    $quantitiy222 = $d['qty_satuan2'];
                                } else if (!empty($d['Satuan1'])) {
                                    $d['harga'] = $s1['harga'] + ($s1['harga'] * $s1['layer11'] / 100);
                                }
                            } else {
                                if (!empty($d['Satuan5'])) {
                                    $d['harga'] = $s1['harga'] + ($s1['harga'] * $s1['layer51'] / 100);
                                } else if (!empty($d['Satuan4'])) {
                                    $d['harga'] = $s1['harga'] + ($s1['harga'] * $s1['layer41'] / 100);
                                } else if (!empty($d['Satuan3'])) {
                                    $d['harga'] = $s1['harga'] + ($s1['harga'] * $s1['layer31'] / 100);
                                } else if (!empty($d['Satuan2'])) {
                                    $d['harga'] = $s1['harga'] + ($s1['harga'] * $s1['layer21'] / 100);
                                } else if (!empty($d['Satuan1'])) {
                                    $d['harga'] = $s1['harga'] + ($s1['harga'] * $s1['layer11'] / 100);
                                }
                            }
                        }
                    }
                ?>
                    <div class="filtr-item col-lg-12" style="padding-left: 15px;padding-right: 1px;padding-top: 1px;">
                        <div class="menupilihan">
                            <input type="hidden" id="kode_<?php echo $d['kd_brg']; ?>" value="<?php echo $d['kd_brg']; ?>">
                            <input type="hidden" id="nama_<?php echo $d['kd_brg']; ?>" value="<?php echo $d['nama']; ?>">
                            <input type="hidden" id="harga_<?php echo $d['kd_brg']; ?>" value="<?php echo $d['harga']; ?>">
                            <input type="hidden" id="diskon_<?php echo $d['kd_brg']; ?>" value="<?php echo $disc; ?>">
                            <input type="hidden" id="kd_promo_<?php echo $d['kd_brg']; ?>" value="<?php echo $kd_promo; ?>">
                            <input type="hidden" id="ket_<?php echo $d['kd_brg']; ?>" value="">
                            <input type="hidden" id="harga_dasar_<?php echo $d['kd_brg']; ?>" value="<?php echo $harga_dasar; ?>">
                            <input type="hidden" id="satuan_<?php echo $d['kd_brg']; ?>" value="<?php echo $satuan222; ?>">
                            <input type="hidden" id="satuan_awal_<?php echo $d['kd_brg']; ?>" value="<?php echo $satuan222; ?>">
                            <input type="hidden" id="satuan_qty_<?php echo $d['kd_brg']; ?>" value="<?= $quantitiy222; ?>">

                            <a class="modal-pilih-produk" id="<?php echo $d['kd_brg']; ?>" data-dismiss="modal">
                                <span class="menunama ">
                                    <?php echo $d['nama']; ?>
                                </span>

                                <span class="menunama2 ">
                                    <?php echo 'Rp. <b>' . format_rupiah($d['harga']) . '</b>'; ?>
                                </span>

                                <span class="menunama3 ">
                                    <?php echo 'Promo : ' . $kd_promo; ?>
                                </span>


                            </a>
                        </div>
                    </div>
                <?php

                } // END WHILE

                ?>
            </div>
            <?php

            ?>

            <input type="hidden" name="kd_aplikasi" value="<?php echo $kd_aplikasi; ?>">
        <?php

        } else {
            // echo '<option value="">Grup not available</option>'; 
        }
        ?>
    </div>

    <!-- <input type="hidden" name="kd_promo" value="<?php echo $kd_promo; ?>"> -->