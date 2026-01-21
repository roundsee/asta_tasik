<?php

session_start();
$dir = '../../';
include_once '../../../../config/koneksi.php';
include '../../../../config/fungsi_rupiah.php';

// print_r($_SESSION);
// $kd_alatbayar=$_POST['kd_alatbayar'];
$kd_aplikasi = $_POST['kd_aplikasi'];
// $kd_aplikasi=$_SESSION['kd_aplikasi'];
// echo 'kd Aplikasi = '.$kd_aplikasi;
?>

<!-- <input type="hidden" name="kd_alatbayar" value="<? //php echo $kd_alatbayar;
                                                      ?>"> -->

<!-- SUB ALATBAYAR-->
<div class="col-lg-6 table-responsive" id="showAlatbayar2" style="height:560px;margin-left: 15px;width: 640px;">
  <!-- <div class="showAlatbayar"> -->
  <div class="row" style="padding-right: 10px;">
    <?php

    $data = mysqli_query($koneksi, "SELECT kdsub_alat,nama,tarif_fee,acuan_fee,b_packing,photo FROM subalat_bayar where kd_alat!='100' AND
      peruntukan='$kd_aplikasi' AND kd_alat!='202' AND kd_alat!='208' AND kd_alat!='206' AND kd_alat!='209' AND kd_alat!='211' AND kd_alat!='210' ORDER BY kdsub_alat ");

    $count = mysqli_num_rows($data);

    if ($count == 0) {
      // echo "<script>clear_alatbayar();</script>";
      echo "<script>close_sub_alatbayar();</script>";
      echo "<script>alert('Alat bayar tdk sesuai.');</script>";
    } else {

      while ($d = mysqli_fetch_array($data)) {

    ?>

        <div class="filtr-item col-sm-2" data-sort="white sample" style="padding-left: 15px;padding-right: 1px;padding-top: 5px;">
          <div class="menupilihan_sub_alatbayar">
            <input type="hidden" id="alatbayar_kode_<?php echo $d['kdsub_alat']; ?>" value="<?php echo $d['kdsub_alat']; ?>">
            <input type="hidden" id="alatbayar_nama_<?php echo $d['kdsub_alat']; ?>" value="<?php echo $d['nama']; ?>">
            <input type="hidden" id="alatbayar_tarif_<?php echo $d['kdsub_alat']; ?>" value="<?php echo $d['tarif_fee']; ?>">
            <input type="hidden" id="alatbayar_ket_<?php echo $d['kdsub_alat']; ?>" value="">
            <input type="hidden" name="nama_subalat_bayar" value="<?php echo $d['nama']; ?>">
            <input type="hidden" name="tarif_fee" value="<?php echo $d['tarif_fee']; ?>">
            <input type="hidden" name="acuan_fee" value="<?php echo $d['acuan_fee']; ?>">
            <input type="hidden" name="b_packing" value="<?php echo $d['b_packing']; ?>">
            <input type="hidden" name="kd_aplikasi" value="<?php echo $kd_aplikasi; ?>">

            <a class="payment-pilih-sub-alatbayar" id="<?php echo $d['kdsub_alat']; ?>" data-dismiss="modal"><img src="<?php echo $dir; ?>images/sub_alat_bayar/<?php echo $d['photo']; ?>" class="img-fluid mb-2" alt="white sample" style="width: 80px;border-radius: 10px;" id="tombol-tambahkan1" />
              <div class="menunama_sub_alatbayar ">
                <?php echo $d['nama']; ?>
              </div>
              <?php
              ?>

            </a>
          </div>
        </div>
    <?php

      }
    }
    ?>
  </div>
</div>

<!-- <button type="button" class="btn-sm tombol1 pull-right" onclick="close_sub_alatbayar()" style="font-size:110%;font-weight:600"> Alat Bayar close</button> -->