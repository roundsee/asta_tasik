<?php 

$dir = "../../../../";
include $dir."config/koneksi.php";
include $dir."config/library.php";

session_start();

$faktur=$_GET['id'];

$transaksi_produk=$_SESSION['transaksi_produk'];
$transaksi_harga=$_SESSION['transaksi_harga']; // ini
$transaksi_jumlah=$_SESSION['transaksi_jumlah']; // ini
$transaksi_total=$_SESSION['transaksi_total']; // ini
$transaksi_diskon=$_SESSION['transaksi_diskon']; // ini
$transaksi_ket=$_SESSION['transaksi_ket'];
$transaksi_kd_promo=$_SESSION['transaksi_kd_promo'];

$transaksi_nama=$_SESSION['transaksi_nama'];

$alamat=$_SESSION['alamat'];
$nama_cab=$_SESSION['nama_cab'];

$kd_area=$_SESSION['kd_area'];

$nama_sub_alat_bayar=$_SESSION['nama_sub_alat_bayar'];
$nama_transaksi=$_SESSION['nama_transaksi'];
$kd_alatbayar=$_SESSION['kd_alatbayar'];


$kd_alatbayar=$_SESSION['kd_alatbayar'];
$byr_pocer=$_SESSION['byr_pocer'];
$byr_tunai=$_SESSION['byr_tunai'];
$byr_non_tunai=$_SESSION['byr_non_tunai'];
$no_meja=$_SESSION['no_meja'];
$oleh=$_SESSION['oleh'];
// $tanggal=$tgl_sekarang.' '.$jam_sekarang;
$dibayar=$_SESSION['dibayar'];
$jumlah=$_SESSION['jumlah'];
$tarif_pb1=$_SESSION['tarif_pb1'];

if($kd_area==10){
  $jam=time()+ (60*60);
  $tgl_jam=date('H:i:s',$jam);
  $pesan_jam= $jam_sekarang.' WIB.';
}else
{
  $tgl_jam = $jam_sekarang;
  $pesan_jam= '';
}

$tanggal=$tgl_sekarang.' '.$tgl_jam;

?>
<!DOCTYPE html>
<html>
<head>
  <title>Cetak Menu Dapur</title>
</head>
<body style='font-family:tahoma; font-size:9pt;' onload="printOut()">
   <?php 

   $input_tunai = ($jumlah - $byr_non_tunai - $byr_pocer);

   if($no_meja==null OR $no_meja==0){
    $no_meja=0;
  }

  $j2=$alamat;
  $j3=$nama_cab;

  ?>

  <table>

    <tr style="text-align:left;font-size:9pt;">
      <td style="width:55pt">No Invoice
        <br>Tanggal
        <br>Kasir
      </td>
      <td>:<br>:<br>:</td>
      <td><?php echo $faktur;?>
      <br><?php echo $tanggal;?>
      <br><?php echo $oleh;?>
    </tr>

    <tr style="text-align:left;font-size:9pt;">
      <td style="width:55pt">No Meja</td>
      <td>:</td>
      <td style="font-weight: bold; font-size: 18px;"><?php echo $no_meja; ?></td>
    </tr>
    <tr style="text-align:left;font-size:9pt;">
      <td style="width:55pt">Jenis</td>
      <td>:</td>
      <td style="font-weight: bold; font-size: 18px;"><?php echo $nama_transaksi; ?></td>
    </tr>

  </table>
  <table>
    <tbody>

      <tr>
        <td colspan="2" style="border-bottom: 2px solid black ;">
        </td>
      </tr>
      
      <?php
      $total_diskon=0;
      $tot_sel_harga=0;
      $grand_disc=0;

      $jumlah_pembelian = count($transaksi_produk);

      for($a=0;$a<$jumlah_pembelian;$a++)
      {

        $t_produk = $transaksi_produk[$a];
        $t_harga = $transaksi_harga[$a];
        $t_jumlah = $transaksi_jumlah[$a];
        $t_total = $transaksi_total[$a];
        $t_diskon = $transaksi_diskon[$a];
        $t_ket = $transaksi_ket[$a];
        $t_kd_promo = $transaksi_kd_promo[$a];

        $t_nama = $transaksi_nama[$a];

        ?>

        <tr style="font-size: 12pt;">
          <td style="width: 100pt; ">
            <?php echo $t_nama; ?>
          </td>
          <td style="width: 30pt; text-align: right;">
            <?php echo $t_jumlah; ?>
          </td>
        </tr>
        <tr style="font-size: 12pt;">
          <td colspan="2" style="width: 150pt; border-bottom: 1px solid black;">
            <span style="font-weight: bold; font-size: 12pt;"><?php echo $t_ket; ?></span>
          </td>
        </tr>

      <?php } ?>
      

    </tbody>

  </table>

</div>

</div>


<script>
  var lama = 2000;
  t = null;
  function printOut(){
    window.print();
    t = setTimeout("self.close()",lama);
  }
</script>

</body>
</html>