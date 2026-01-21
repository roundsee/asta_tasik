<?php 

$dir = "../../../../";
include $dir."config/koneksi.php";
// include '../../../../config/library.php';

session_start();

$faktur=$_GET['id'];
// echo $faktur;

?>
<!DOCTYPE html>
<html>
<head>
	<title>Cetak Struk</title>
</head>
<body style='font-family:tahoma; font-size:9pt;' onload="printOut()">
 <?php 

 $j1='Waroeng Steak & Shake';
 $j2='Jl ';
 $j3='kota';
 $j4='Whatsapp :'.'0813-1720';
 $j5='www.';

 $d5="DINE IN";

 $f1='TERIMA KASIH......';

 $query=mysqli_query($koneksi,"SELECT * FROM setup  ");

 $stp=mysqli_fetch_array($query);

 $f1=$stp['pesan1'];
 $j4='Whatsapp :'.$stp['telp'];
 $j5=$stp['web'];


 $query=mysqli_query($koneksi,"SELECT * FROM daily_penjualan where faktur= '$faktur' ");

 $q=mysqli_fetch_array($query);

 $kd_cus=$q['kd_cus'];
 $oleh=$q['oleh'];
 $tanggal=$q['tanggal'];
 $no_meja=$q['no_meja'];
 $kd_aplikasi=$q['kd_aplikasi'];
 $subjumlah=$q['subjumlah'];
 $diskon=0;
 $byr_pocer=$q['byr_pocer'];
 $byr_tunai=$q['byr_tunai'];
 $ppn=$q['ppn'];
 $jumlah=$q['jumlah'];
 $byr_non_tunai=$q['byr_non_tunai'];
 $tarif_pb1=$q['tarif_pb1'];
 $dibayar=$q['dibayar'];
        // $kembali=0;

 $input_tunai = ($jumlah - $byr_non_tunai - $byr_pocer);

 if($no_meja==null OR $no_meja==0){
  $no_meja=0;
}

$subalatbayar=mysqli_query($koneksi,"SELECT * FROM subalat_bayar where kdsub_alat='$q[kdsub_alatbayar]' ");
$s=mysqli_fetch_array($subalatbayar);

if($s['kd_alat']==100){
  $nama_alat_bayar='';
}else{
  $nama_alat_bayar='('.$s['nama'].')';
}


$query1=mysqli_query($koneksi,"SELECT * FROM daily_jualdetil where faktur= '$faktur' ");


$jenis_transaksi=mysqli_query($koneksi,"SELECT * FROM jenis_transaksi where kd_jenis= '$kd_aplikasi' ");

$jt=mysqli_fetch_array($jenis_transaksi);

$query=mysqli_query($koneksi,"SELECT *,kotabaru.nama as kotabaru_nama
  FROM pelanggan JOIN kotabaru ON kotabaru.kode=pelanggan.kd_kota
  where pelanggan.kd_cus = '$kd_cus' ");
$p=mysqli_fetch_array($query);


$j2=$p['alamat'];
$j3=$p['kotabaru_nama'];

?>

<table>
  <tr><center>
    <?php 

    echo '<br>'.$j1;
    echo '<br>'.$j2;
    echo '<br>'.$j3;
    echo '<br>'.$j4;
    echo '<br>'.$j5;
    echo '<br>';
    echo '<br>';

    ?>
  </center>
</tr>
<!-- <tr><td></td></tr> -->
<tr style="text-align:left;font-size:9pt;">
  <td style="width:55pt">No Invoice
    <br>Tanggal
    <br>Kasir
    <br>No Meja
    <br>Jenis
    </td>
  <td>:<br>:<br>:<br>:<br>:</td>
  <td style="width:150pt"><?php echo $faktur;?>
  <br><?php echo $tanggal;?>
  <br><?php echo $oleh;?>
  <br><span style="font-weight: bold; font-size: 9pt;"><?php echo $no_meja;?></span>
  <br><span style="font-weight: bold; font-size: 9pt;"><?php echo $jt['nama'];?></span>
  </td>
</tr>
</table>
<hr>

<table>
  <tbody>
    <?php

    $total_diskon=0;
    $tot_sel_harga=0;
    $grand_disc=0;


    while ($q1=mysqli_fetch_array($query1))
    { 
      $total_diskon=$total_diskon+$q1['diskon'];

      $query2=mysqli_query($koneksi,"SELECT * FROM barang where kd_brg='$q1[kd_brg]' ");
      $q2=mysqli_fetch_array($query2);
      $tot_harga=$q1['banyak']*$q1['harga'];
      $tot_sel_harga=$tot_sel_harga+$tot_harga;

      ?>
      <tr style="font-size:9pt;">
        <td colspan="2" style="width:250pt;"><?php echo $q2['nama'];?><br>&emsp;
          <?php echo $q1['banyak'];?> x <?php echo number_format($q1['harga']);?></td>
          <!-- <td></td> -->
          <td><br>:</td>
          <td style="width:60pt;text-align:right"><br><?php echo number_format($tot_harga);?></td>
        </tr>

        <?php if ($q1['diskon']>0){ 
          $sub_tot_disc=$q1['banyak']*$q1['diskon'];
          $grand_disc=$grand_disc+$sub_tot_disc;
          ?>
          <tr style="font-size:9pt;">
            <td>&emsp;
              <?php echo $q1['banyak'];?> x -<?php echo number_format($q1['diskon']);?></td>
              <td style="text-align:left">diskon</td>
              <td>:</td>
              <td>-<?php echo number_format($sub_tot_disc);?></td>

            </tr>
          <?php } ?>


          <?php
        }

        $sub_total=$tot_sel_harga-$grand_disc;
        $pb1=ceil(($tarif_pb1/100)*$sub_total);

        $total_stlh_pajak=($sub_total)+($pb1);

        $total_bayar=$byr_pocer+$byr_non_tunai+$dibayar;
        $kembalian=$total_bayar-$total_stlh_pajak;

        if($total_stlh_pajak<=$byr_pocer){
          $kembalian=0;
        }

        ?>
        <tr>
          <td></td>
          <td></td>
          <td></td>
          <td><hr></td>
        </tr>

      </tbody>
      <tfoot>
        <tr style="text-align:right;font-size:9pt">
          <td colspan="3" style="text-align:right;font-size:9pt">Sub Total :
            <br>Tax 10% :
            <br>Total :
          </td>
      <td style="text-align:right; font-weight:bold; font-size:9pt;"><?php echo number_format($sub_total).
      "<br>".number_format($pb1).
      "<br>".number_format($total_stlh_pajak);?>
    </td>

      </tr>
      <tr style="text-align:left;font-size:9pt">
        <td colspan="4">Cara Pembayaran :</td>
      </tr>

      <tr style="text-align:right;font-size:9pt">
        <td colspan="3">Voucher :
          <br>non Tunai :
          <?php if ($s['kd_alat']!=100){ ?>
            <br><i><?php echo $nama_alat_bayar;?></i>
          <?php };?>
          <br>Tunai :
          <br>
          <br>Kembali : 
        </td>

        <td><span style="font-weight: bold;"><?php echo number_format($byr_pocer);?></span>
        <br><span style="font-weight: bold;"><?php echo number_format($byr_non_tunai);?></span>
        <?php if ($s['kd_alat']!=100){ ?>
          <br>
        <?php };?>
        <br><span style="font-weight: bold;"><?php echo number_format($dibayar);?></span>
        <br>
        <br><span style="font-weight: bold;"><?php echo number_format($kembalian);?></span>
      </td>
    </tr>

  </tfoot>
</table>
<hr>
<center>
  <?php echo $f1; ?>
  <br>
  <span style="font-weight: bold;">----- CETAK ULANG -----</span>
</center>
</div>

</div>
<script>
  var lama = 3000;
  t = null;
  function printOut(){
    window.print();
    t = setTimeout("self.close()",lama);
  }
</script>

</body>
</html>