<?php

session_start();
$dir = '../../';
include_once '../../../../config/koneksi.php';
include '../../../../config/fungsi_rupiah.php';

// $tgl=date("Y-m-d");
// $tgl=date("2022-04-16");
$tgl = date('Y-m-d');


$kd_aplikasi = $_SESSION['kd_aplikasi'];
$kd_kota = $_SESSION['kd_kota'];
$kd_cus = $_SESSION['kd_cus'];
$kodeAppValue = $_COOKIE['kode_kategori'] ?? null;
$kodestock = 1316;
$en = $_SESSION['employee_number'];
$query1 = mysqli_query($koneksi, "SELECT kategori_kasir from employee where employee_number='$en' ");
$q1 = mysqli_fetch_array($query1);
// $kategoripenguranganstok = $q1['kategori_kasir'];
$kategoripenguranganstok = $_COOKIE['kode_kategori'] ?? null;
$kategoristokharga = $_COOKIE['kode_kategori_tambahan'] ?? null;

if ($kategoristokharga >= 2) {
  $kodestock = 8001;
}

echo "<script>console.log('Debug Objects: " .  $kodeAppValue . "' );</script>";

$query = mysqli_query($koneksi, "SELECT id_kat FROM pelanggan where kd_cus='$kd_cus' ");
$q1 = mysqli_fetch_array($query);

$id_kat = $q1['id_kat'];

// print_r($_SESSION);

?>

<input type="hidden" name="kd_aplikasi" value="<?php echo $kd_aplikasi; ?>">
<div class="row table-responsive" style="height: 80%;width:100%;overflow-x: hidden;">
  <div class="filter-container p-0 row" style="height:186px!important;padding-right: 10px;">

    <?php
    $keyword = "";
    if (isset($_POST['search'])) {
      $keyword = $_POST['search'];
    }

    if (empty($_POST["kd_aplikasi"])) {
    ?>
      <div id="show_search">

        <?php
        function roundUpTo100($value)
        {
          return ceil($value / 100) * 100;
        }
        $data = mysqli_query($koneksi, "SELECT b.Quantity,b.kd_brg, b.nama, b.kd_subgrup, b.kd_grup, b.photo, b.hrg_satuan1 AS harga, 
        hrg_satuan1_grosir,hrg_satuan2_grosir,hrg_satuan3_grosir,hrg_satuan4_grosir,hrg_satuan5_grosir,hrg_satuan1_online,
        hrg_satuan1_ms,hrg_satuan1_mg,hrg_satuan1_mp,
        hrg_satuan2_ms,hrg_satuan2_mg,hrg_satuan2_mp,
        hrg_satuan3_ms,hrg_satuan3_mg,hrg_satuan3_mp,
        hrg_satuan4_ms,hrg_satuan4_mg,hrg_satuan4_mp,
        hrg_satuan5_ms,hrg_satuan5_mg,hrg_satuan5_mp,
        b.Satuan1, b.qty_satuan1, b.ktg_online, b.ktg_ms, b.ktg_mg, b.ktg_mp,b.ktg_grosir,b.Satuan2,b.Satuan3,b.Satuan4,b.Satuan5,b.ktg_retail,
        b.qty_satuan2,b.qty_satuan3,b.qty_satuan4,b.qty_satuan5,IFNULL((SELECT stok FROM inventory WHERE inventory.kd_brg = b.kd_brg AND kd_cus = '$kodestock'),0) as stock,
        b.Pcs,b.Renteng
        FROM barang b
        WHERE kd_subgrup is null AND
        (b.nama LIKE '%" . $keyword . "%' OR b.kd_brg LIKE '%" . $keyword . "%')
        ORDER BY b.nama LIMIT 50;");

        // $d = mysqli_fetch_array($data);
        // print_r($d);

        while ($d = mysqli_fetch_array($data)) {
          if ($d['ktg_retail'] != "manual" || $d['ktg_online'] != "manual" || $d['ktg_grosir'] != "manual" || $d['ktg_ms'] != "manual" || $d['ktg_mg'] != "manual" || $d['ktg_mp'] != "manual") {
            $kategorihargamanual = $d['ktg_retail'];
          } else {
            $kategorihargamanual = "manual";
          }

          $harga_dasar = $d['harga'];
          $nama_satuan_stock_barang = $d['Satuan1'];
          $stock_barang = $d['stock'] * $d['qty_satuan1'];
          if ($kategoripenguranganstok == 2 || $kategoristokharga == 2) {
            if (!empty($d['Satuan5'] && $d['Satuan5'] != " ")) {
              $nama_satuan_stock_barang = $d['Satuan5'];
              $stock_barang = ($d['stock'] != 0 && !empty($d['qty_satuan5']))
                ? floor($d['stock'] / $d['qty_satuan5'])
                : 0;
            } else if (!empty($d['Satuan4'] && $d['Satuan4'] != " ")) {
              $nama_satuan_stock_barang = $d['Satuan4'];
              $stock_barang = ($d['stock'] != 0 && !empty($d['qty_satuan4']))
                ? floor($d['stock'] / $d['qty_satuan4'])
                : 0;
            } else if (!empty($d['Satuan3'] && $d['Satuan3'] != " ")) {
              $nama_satuan_stock_barang = $d['Satuan3'];
              $stock_barang = ($d['stock'] != 0 && !empty($d['qty_satuan3']))
                ? floor($d['stock'] / $d['qty_satuan3'])
                : 0;
            } else if (!empty($d['Satuan2'] && $d['Satuan2'] != " ")) {
              $nama_satuan_stock_barang = $d['Satuan2'];
              $stock_barang = ($d['stock'] != 0 && !empty($d['qty_satuan2']))
                ? floor($d['stock'] / $d['qty_satuan2'])
                : 0;
            } else {
              $nama_satuan_stock_barang = $d['Satuan1'];
              $stock_barang = ($d['stock'] != 0 && !empty($d['qty_satuan1']))
                ? floor($d['stock'] / $d['qty_satuan1'])
                : 0;
            }
          }
          $disc = 0;
          $kd_promo = '';
          if ($kodeAppValue == 2 || $kategoripenguranganstok == 2) {
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
          } elseif ($kodeAppValue == 3 || $kategoripenguranganstok == 3) {
            $d['harga'] = $d['hrg_satuan1_online'];
          } elseif ($kodeAppValue == 4 || $kategoripenguranganstok == 4) {
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
          } elseif ($kodeAppValue == 5 || $kategoripenguranganstok == 5) {
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
          } elseif ($kodeAppValue == 6 || $kategoripenguranganstok == 6) {
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
              <input type="hidden" id="satuan_<?php echo $d['kd_brg']; ?>" value="<?php echo trim($d['Satuan1']); ?>">
              <input type="hidden" id="satuan_awal_<?php echo $d['kd_brg']; ?>" value="<?php echo trim($d['Satuan1']); ?>">
              <input type="hidden" id="satuan_qty_<?php echo $d['kd_brg']; ?>" value="<?= $d['qty_satuan1']; ?>">
              <input type="hidden" id="stockunit_<?php echo $d['kd_brg']; ?>" value="<?= $d['stock']; ?>">
              <input type="hidden" id="kategorihargamanual_<?php echo $d['kd_brg']; ?>" value="<?= $kategorihargamanual; ?>">
              <input type="hidden" id="kategorilockswalayan_<?php echo $d['kd_brg']; ?>" value="<?= $d['Pcs']; ?>">
              <input type="hidden" id="kategorilockgudang_<?php echo $d['kd_brg']; ?>" value="<?= $d['Renteng']; ?>">


              <a class="modal-pilih-produk" id="<?php echo $d['kd_brg']; ?>" data-dismiss="modal">
                <span class="menunama ">
                  <?php echo $d['nama']; ?>
                </span>

                <span class="menunama2 ">
                  <?php echo 'Rp. <b>' . format_rupiah((int)$d['harga']) . '</b>'; ?>
                </span>

                <!-- <span class="menunama3 ">
                  <?php echo 'Promo : ' . $kd_promo; ?>
                </span> -->
                <span class="menunama2 ">
                  <?php echo 'Stock (' . $nama_satuan_stock_barang . ') : ' . $stock_barang; ?>
                </span>


              </a>
            </div>
          </div>
        <?php

        } // END WHILE

        ?>
      </div>
      <input type="hidden" name="kd_aplikasi" value="<?php echo $kd_aplikasi; ?>">
    <?php


    } else {
      // echo '<option value="">Grup not available</option>'; 
    }
    ?>
  </div>

  <!-- <input type="hidden" name="kd_promo" value="<?php echo $kd_promo; ?>"> -->