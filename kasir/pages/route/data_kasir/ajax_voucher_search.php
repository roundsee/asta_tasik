<?php

session_start();
$dir = '../../';
include_once '../../../../config/koneksi.php';
include '../../../../config/fungsi_rupiah.php';

$en = $_SESSION['employee_number'];

$query = mysqli_query($koneksi, "SELECT kd_cus from user_login where employee_number='$en' ");
$q = mysqli_fetch_array($query);

$kd_cus = $q['kd_cus'];

$query2 = mysqli_query($koneksi, "SELECT nama,alamat,kd_kota,kd_area from pelanggan where kd_cus='$kd_cus' ");
$q2 = mysqli_fetch_array($query2);

$nama_cab = $q2['nama'];
$alamat = $q2['alamat'];
$kd_kota = $q2['kd_kota'];
$kd_area = $q2['kd_area'];

?>

<div class="filter-container p-0 row">

  <?php
  $keyword = "";
  if (isset($_POST['search'])) {
    $keyword = $_POST['search'];
  }
  ?>

  <?php
  $no = 1;
  $tgl = date('Y-m-d');

  // $cek1 = mysqli_query($koneksi, "SELECT jadi FROM jualdetilpocer WHERE noseri_pocer ='$keyword' 
  //   ORDER BY tanggal ");
  // $dcek21 = mysqli_query($koneksi, "SELECT jadi FROM daily_jualdetilpocer WHERE noseri_pocer ='$keyword' 
  //   ORDER BY tanggal ");
  // $c1 = mysqli_num_rows($cek1);
  // $dc2213 = mysqli_num_rows($dcek21);

  $cek1 = mysqli_query($koneksi, "SELECT status_voucher FROM retur_penjualan WHERE no_voucher ='$keyword' LIMIT 1");
  $c1 = mysqli_num_rows($cek1);
  $qp = mysqli_fetch_array($cek1);

  // $pocer = mysqli_query($koneksi, "SELECT id_pocer,tgl_terbit,tgl_daluarsa FROM pocer WHERE no_pocer ='$keyword' AND approve=1
  //   ORDER BY no_pocer ");
  // $p = mysqli_num_rows($pocer);
  // $qp = mysqli_fetch_array($pocer);
  $pesan = "Voucher Belum di Print";
  if ($c1 > 0) {
    if ($qp['status_voucher'] == 2) {
      $pesan = "Voucher sudah di gunakan";
    } else if ($qp['status_voucher'] == 1) {
      $pesan = "Voucher tersedia";
    }
  } else if ($c1 <= 0) {
    $pesan = "Voucher tidak tersedia";
  }

  // else {
  //   if ($p > 0) {
  //     if ($qp['tgl_terbit'] <= $tgl and $qp['tgl_daluarsa'] >= $tgl) {
  //       $pesan = "Voucher Ready";
  //     } elseif ($qp['tgl_daluarsa'] <= $tgl) {
  //       $pesan = " Voucher sudah kadaluarsa";
  //     } elseif ($qp['tgl_terbit'] >= $tgl) {
  //       $pesan = " Voucher blm berlaku";
  //     }
  //   } else {
  //     $pesan = "Voucher tsb tidak ada";
  //   }
  // }

  ?>
  <div class="form-group" id="text_voucher" style="text-align:center;font-size: 130%;
  color: mediumblue;font-weight: 800;">
    <?php echo $pesan; ?>
  </div>

  <table class="table table-striped table-hover" id="table-datatable2">
    <thead>
      <tr>
        <!-- <th class="text-center">NO</th> -->
        <th style="text-align:center">No Seri</th>
        <th style="text-align:center">Nilai</th>
        <th style="text-align:center">Proses</th>
      </tr>
    </thead>
    <tbody>


      <?php

      // $data = mysqli_query($koneksi, "SELECT * FROM pocer p
      // join pocer_detil pd on pd.no_pocer=p.no_pocer
      // WHERE p.no_pocer ='$keyword' AND p.approve=1 AND
      // p.tgl_terbit<= '$tgl' AND p.tgl_daluarsa>= '$tgl' AND 
      // (pd.kd_kota='$kd_kota' OR pd.kd_cus='$kd_cus' OR pd.cakupan='Nasional')
      // ORDER BY p.no_pocer ");

      $data = mysqli_query($koneksi, "SELECT no_voucher as no_pocer,SUM(`harga`*`total_retur`) as harga_jual,tanggal_retur,status_voucher FROM retur_penjualan WHERE no_voucher ='$keyword'");

      while ($d = mysqli_fetch_array($data)) {
        $harga = number_format($d['harga_jual'] ?? 0, 2);

      ?>

        <tr>
          <td width="40%" class="text-center"><?php echo $d['no_pocer']; ?></td>
          <td width="30%" class="text-center"><?php echo $harga; ?></td>
          <td style="text-align:center">
            <input type="hidden" id="kode_<?php echo $d['no_pocer']; ?>" value="<?php echo $d['no_pocer']; ?>">
            <input type="hidden" id="noseri_<?php echo $d['no_pocer']; ?>" value="<?php echo $d['no_pocer']; ?>">
            <input type="hidden" id="nilai_<?php echo $d['no_pocer']; ?>" value="<?php echo $d['harga_jual']; ?>">
            <input type="hidden" id="harga_<?php echo $d['no_pocer']; ?>" value="<?php echo $d['harga_jual']; ?>">
            <input type="hidden" id="terbit_<?php echo $d['no_pocer']; ?>" value="<?php echo $d['tanggal_retur']; ?>">
            <input type="hidden" id="daluarsa_<?php echo $d['no_pocer']; ?>" value="-">
            <!-- <input type="hidden" id="daluarsa_<?php echo $d['no_pocer']; ?>" value="<?php echo $d['tgl_daluarsa']; ?>"> -->
            <?php
            if ($c1 <= 0 || $d['status_voucher']  == 2) {
            ?>
              not available

            <?php

            } else { ?>

              <button type="button" class="btn btn-success btn-sm modal-pilih-voucher" id="<?php echo $d['no_pocer']; ?>" data-dismiss="modal">OK</button>
            <?php } ?>
          </td>
        <?php

      }
        ?>
        </tr>

    </tbody>
  </table>

</div>