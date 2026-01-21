<?php

$dir = "../../../../";
include $dir . "config/koneksi.php";
include $dir . "config/library.php";

session_start();

$faktur = $_GET['id'];

$transaksi_produk = $_SESSION['transaksi_produk'];
$transaksi_harga = $_SESSION['transaksi_harga'];
$transaksi_jumlah = $_SESSION['transaksi_jumlah'];
$transaksi_total = $_SESSION['transaksi_total'];
$transaksi_diskon = $_SESSION['transaksi_diskon'];
$transaksi_ket = $_SESSION['transaksi_ket'];
$transaksi_kd_promo = $_SESSION['transaksi_kd_promo'];
$allowPrint = $_SESSION['status_simpan'];

$transaksi_nama = $_SESSION['transaksi_nama'];
$transaksi_satuan = $_SESSION['transaksi_satuan'];
$transaksi_satuan_qty = $_SESSION['transaksi_satuan_qty'];
$transaksi_satuan_awal = $_SESSION['transaksi_satuan_awal'];


$transaksi_total_diskon = $_SESSION['transaksi_total_diskon'];

$alamat = $_SESSION['alamat'];
$nama_cab = $_SESSION['nama_cab'];

$kd_area = $_SESSION['kd_area'];

$nama_sub_alat_bayar = $_SESSION['nama_sub_alat_bayar'];
$nama_transaksi = isset($_SESSION['nama_transaksi']) ? $_SESSION['nama_transaksi'] : "";
$kd_alatbayar = $_SESSION['kd_alatbayar'];

$kd_alatbayar = $_SESSION['kd_alatbayar'];
$byr_pocer = $_SESSION['byr_pocer'];
$byr_tunai = $_SESSION['byr_tunai'];
$byr_non_tunai = $_SESSION['byr_non_tunai'];
$ongkos_kirim  = $_COOKIE['ongkos_kirim'];
if ($ongkos_kirim == null) {
  $ongkos_kirim = 0;
}
$voucher_nilai_diskon  = $_COOKIE['voucher_nilai_diskon'];
if ($voucher_nilai_diskon == null) {
  $voucher_nilai_diskon = 0;
}

$no_meja = $_SESSION['no_meja'];
$nama_member = (isset($_SESSION['nama_member']) && trim($_SESSION['nama_member']) !== "") ? $_SESSION['nama_member'] : "-";
$oleh = isset($_SESSION['oleh']) ? $_SESSION['oleh'] : "";
// $tanggal=$tgl_sekarang.' '.$jam_sekarang;
$dibayar = $_SESSION['dibayar'];
$jumlah = $_SESSION['jumlah'];
$tarif_pb1 = $_SESSION['tarif_pb1'];

if ($kd_area == 10) {
  $jam = time() + (60 * 60);
  $tgl_jam = date('H:i:s', $jam);
  $pesan_jam = $jam_sekarang . ' WIB.';
} else {
  $tgl_jam = $jam_sekarang;
  $pesan_jam = '';
}

$tanggal = $tgl_sekarang . ' ' . $tgl_jam;

?>
<!DOCTYPE html>
<html>

<head>
  <title>Cetak Struk</title>
</head>

<body style='font-family:tahoma; font-size:9pt;' onload="printOut()">

  <?php

  $query = mysqli_query($koneksi, "SELECT pesan1,pesan2,perusahaan,telp,web FROM setup  ");
  $stp = mysqli_fetch_array($query);

  $f1 = $stp['pesan1'];
  $f2 = $stp['pesan2'];
  $j1 = $stp['perusahaan'];
  $j2 = $alamat;
  $j3 = $nama_cab;
  $j4 = $stp['telp'];
  $j5 = $stp['web'];

  $input_tunai = ($jumlah - $byr_non_tunai - $byr_pocer);

  if ($no_meja == null or $no_meja == 0) {
    $no_meja = 0;
  }

  ?>

  <table style="width: 100%; border-collapse: collapse;">
    <tr>
      <!-- Left-aligned cell with logo -->
      <td style="text-align: left; vertical-align: middle; width: 40%;">
        <img src="../../../../images/logo1.png" height="60px" alt="Logo">
      </td>
      <!-- Right-aligned cell -->
      <td style="text-align: left; font-size: 8pt; width: 60%;">
        <?php
        echo '<br>' . $j1;
        echo '<br>' . $j2;
        echo '<br>' . $j4;
        echo '<br>';
        echo '<br>';
        ?>
      </td>
    </tr>
  </table>
  <table>
    <tr style="text-align:left;font-size:9pt;">
      <td style="width:55pt">No Invoice
        <br>Tanggal
        <br>Kasir
        <br>Member
        <!-- <br>Jenis -->
      </td>
      <td>:<br>:<br>:<br>:</td>
      <td><?php echo $faktur; ?>
        <br><?php echo $tanggal; ?>
        <br><?php echo $oleh; ?>
        <br><?php echo $nama_member; ?>
        <!-- <br><span style="font-weight: bold; font-size: 12px;"><?php echo $nama_transaksi; ?></span> -->
      </td>
    </tr>
  </table>
  <hr>


  <table>
    <tbody>
      <?php
      $no = 1;

      $total_diskon = 0;
      $tot_sel_harga = 0;
      $grand_disc = 0;

      $tot_sel_diskon = 0;

      $jumlah_pembelian = count($transaksi_produk);

      for ($a = 0; $a < $jumlah_pembelian; $a++) {

        $t_produk = $transaksi_produk[$a];
        $t_harga = $transaksi_harga[$a];
        $t_jumlah = $transaksi_jumlah[$a];
        $t_total = $transaksi_total[$a];
        $t_diskon = $transaksi_diskon[$a];
        $t_ket = $transaksi_ket[$a];
        $t_kd_promo = $transaksi_kd_promo[$a];

        $t_nama = $transaksi_nama[$a];
        $t_satuan = $transaksi_satuan[$a];
        $t_satuan_qty = $transaksi_satuan_qty[$a];
        $t_satuan_awal = $transaksi_satuan_awal[$a];


        $t_total_diskon = $transaksi_diskon[$a];

        $hitungan_total = $t_total - ($t_diskon * $t_jumlah);

        $total_diskon = $total_diskon + $t_diskon;
        $tot_harga = $t_total;
        $tot_sel_harga = $tot_sel_harga + $tot_harga;
        // $tot_sel_harga = $tot_sel_harga + $t_total;
        $tot_sel_diskon = $tot_sel_diskon + $t_total_diskon;

      ?>

        <tr style="font-size:8pt; line-height:1.5; text-align:left;">
          <td style="width:6pt; text-align:center;"><?php echo $no++; ?>.</td>
          <td style="width:150pt; text-align:left;"><?php echo $t_nama; ?></td>
          <td style="width:30pt; text-align:right;"><?php echo '(' . $t_jumlah . ')'; ?></td>
          <td style="width:30pt; text-align:right;"><?php echo $t_satuan; ?></td>
          <td style="width:50pt; text-align:right;"><?php echo '(' . number_format($t_harga, 0, ',', '.') . ')'; ?></td>
          <td style="width:10pt; text-align:center;">:</td>
          <td style="width:50pt; text-align:right;"><?php echo number_format($t_total, 0, ',', '.'); ?></td>
        </tr>

        <?php if ($t_diskon > 0) {
          $sub_tot_disc = $t_diskon;
          $grand_disc = $grand_disc + $sub_tot_disc;
        ?>
          <tr style="font-size:9pt;">
            <td style="text-align:left;" colspan="6">- Diskon ( <?php echo $t_ket; ?> )</td>
            <td style="text-align:right;">-<?php echo number_format($sub_tot_disc); ?></td>
          </tr>
        <?php } ?>


      <?php

      }

      // $sub_total = $tot_sel_harga - $grand_disc;
      $sub_total = $tot_sel_harga - $tot_sel_diskon;
      $pb1 = round(($tarif_pb1 / 100) * $sub_total);

      $total_stlh_pajak = ($sub_total) + ($pb1);

      $total_bayar = $byr_pocer + $byr_non_tunai + $dibayar;
      $kembalian = $total_bayar - $total_stlh_pajak;

      if ($total_stlh_pajak <= $byr_pocer) {
        $kembalian = 0;
      }

      ?>
      <tr>
        <td colspan="7">
          <hr>
        </td>
      </tr>

    </tbody>

    <tfoot>
      <tr style="text-align:right;font-size:9pt">
        <td colspan="6" style="text-align:right;font-size:9pt">Sub Total :
          <!-- <br>Tax 10% :
        <br>Total : -->
        </td>
        <td style="font-weight:bold;"><?php echo number_format($sub_total)
                                        // "<br>".number_format($pb1).
                                        // "<br>".number_format($total_stlh_pajak)
                                      ; ?>
        </td>

      </tr>
      <tr style="text-align:right;font-size:9pt">
        <td colspan="6" style="text-align:right;font-size:9pt">Ongkir :
          <!-- <br>Tax 10% :
        <br>Total : -->
        </td>
        <td style="font-weight:bold;"><?php echo number_format($ongkos_kirim)
                                        // "<br>".number_format($pb1).
                                        // "<br>".number_format($total_stlh_pajak)
                                      ; ?>
        </td>

      </tr>
      <tr style="text-align:right;font-size:9pt">
        <td colspan="6" style="text-align:right;font-size:9pt">Voucher :
          <!-- <br>Tax 10% :
        <br>Total : -->
        </td>
        <td style="font-weight:bold;"><?php echo number_format($voucher_nilai_diskon + $byr_pocer)
                                        // "<br>".number_format($pb1).
                                        // "<br>".number_format($total_stlh_pajak)
                                      ; ?>
        </td>

      </tr>
      <tr style="text-align:right;font-size:9pt">
        <td colspan="6" style="text-align:right;font-size:9pt">Total :
          <!-- <br>Tax 10% :
        <br>Total : -->
        </td>
        <td style="font-weight:bold;"><?php echo number_format($sub_total + $ongkos_kirim - $voucher_nilai_diskon - $byr_pocer)
                                        // "<br>".number_format($pb1).
                                        // "<br>".number_format($total_stlh_pajak)
                                      ; ?>
        </td>

      </tr>
      <!-- <tr style="text-align:left;font-size:9pt">
        <td colspan="6" style="text-align:right;font-size:9pt">Total Diskon :
        </td>
        <td style="font-weight:bold;text-align:right;"><?php echo number_format($tot_sel_diskon); ?>
        </td>
      </tr> -->

      <tr style="text-align:right;font-size:9pt">
        <td colspan="6"> <!-- Voucher :-->
          <br>non Tunai :
          <?php if ($kd_alatbayar != null) { ?>
            <br>(<i><?php echo $nama_sub_alat_bayar; ?></i>)&emsp;
          <?php } ?>
          <br>Tunai :
          <br>
          <br>Kembali :
        </td>

        <td><!--<span style="font-weight: bold;"><?php echo number_format($byr_pocer); ?></span>-->
          <br><span style="font-weight: bold;"><?php echo number_format($byr_non_tunai); ?></span>
          <?php if ($kd_alatbayar != null) { ?>
            <br>
          <?php }; ?>
          <br><span style="font-weight: bold;"><?php echo number_format($dibayar); ?></span>
          <br>
          <br><span style="font-weight: bold;"><?php echo number_format($kembalian - $ongkos_kirim + $voucher_nilai_diskon); ?></span>
        </td>
      </tr>


    </tfoot>
  </table>
  <hr>

  <center>
    <?php echo $f1; ?>
    <?php echo '<br>' . $f2; ?>
    <?php echo '<br>' . $pesan_jam; ?>
    <!-- <br>ig :
    <br>shoope :
    <br>tokopedia : -->
  </center>
  </div>

  </div>


  <script>
    var lama = 1;
    t = null;

    function printOut() {
      const allowPrint = '<?= $allowPrint ?>';
      if (allowPrint == 'berhasil') {
        window.print();
      }
      t = setTimeout("document.location.replace('../../main.php?route=kasir&showModal=1')", lama);
    }

    //updated
    // var lama = 1;
    // var t = null;

    // function printOut() {
    //   window.print();
    //   setTimeout(() => {
    //     window.print();
    //     t = setTimeout(() => {
    //       document.location.replace('../../main.php?route=kasir&showModal=1');
    //     }, lama);
    //   }, 500); 
    // }

    //sampe sini

    // function printOut() {
    //   window.print();

    //   const enterEvent = new KeyboardEvent("keydown", {
    //     key: "Enter",
    //     keyCode: 13,
    //     code: "Enter",
    //     which: 13,
    //     bubbles: true
    //   });

    //   document.addEventListener("keydown", function(event) {
    //     if (event.key === "Enter") {
    //       document.location.replace('../../main.php?route=kasir');
    //     }
    //   });

    //   document.dispatchEvent(enterEvent);
    // }
  </script>

</body>

</html>