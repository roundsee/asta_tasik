<?php 

$dir = "../../../../";
include $dir."config/koneksi.php";
include '../../../../config/library.php';

session_start();

$faktur=$_GET['id'];

$kd_area=$_SESSION['kd_area'];

?>
<!DOCTYPE html>
<html>
<head>
	<title>Cetak Menu Dapur</title>
</head>
<body style='font-family:tahoma; font-size:9pt;' onload="printOut()">
 <?php 

 $j1='Waroeng Steak & Shake';
 $j2='Jl MT Haryono No 3A, Purwokerto Wetan';
 $j3='Purwokerto';
 $j4='Whatsapp :'.'0813-1720-0000';
 $j5='www.waroengsteakandshake.com';

 $d5="DINE IN";

 $f1='TERIMA KASIH ATAS KUNJUNGAN ANDA';

 $query=mysqli_query($koneksi,"SELECT * FROM setup  ");

 $stp=mysqli_fetch_array($query);

 $f1=$stp['pesan1'];



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

<table>
      <!-- <tr>
        <center>
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
      </tr> -->
      <tr style="text-align:left;font-size:9pt;">
        <td style="width:55pt">No Invoice
          <br>Tanggal
          <br>Kasir
          <br>No Meja
          <br>Jenis
        </td>
        <td>:<br>:<br>:<br>:<br>:</td>
        <td><?php echo $faktur;?>
        <br><?php echo $tanggal;?>
        <br><?php echo $oleh;?>
        <br><?php echo $no_meja;?>
        <br><?php echo $jt['nama'];?></td>
      </tr>
    </table>
    <hr>

    <table>
      <tbody>
        <?php
        $query1=mysqli_query($koneksi,"SELECT * FROM daily_jualdetil where faktur= '$faktur' ");

        $total_diskon=0;
        $tot_sel=0;

        while ($q1=mysqli_fetch_array($query1))
        { 
      // $total_diskon=$total_diskon+$q1['diskon'];

          $query2=mysqli_query($koneksi,"SELECT * FROM barang where kd_brg='$q1[kd_brg]' ");
          $q2=mysqli_fetch_array($query2);
          $tot_harga=$q1['banyak']*$q1['harga'];
          $tot_sel=$tot_sel+$tot_harga;

          ?>
        <tr style="font-size: 12pt;">
          <td style="width: 100pt; ">
            <?php echo $q2['nama']; ?>
          </td>
          <td style="width: 30pt; text-align: right;">
            <?php echo $q1['banyak']; ?>
          </td>
        </tr>
        <tr style="font-size: 12pt;">
          <td colspan="2" style="width: 150pt; border-bottom: 1px solid black;">
            <span style="font-weight: bold; font-size: 12pt;"><?php echo $q1['penyajian']; ?></span>
          </td>
        </tr>

            <?php
          }
          ?>
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td><hr></td>
          </tr>

        </tbody>

      </table>
      <center>
      <span style="font-weight: bold;">---- CETAK ULANG ----</span>
      <?php echo '<br>'.$pesan_jam;?>
      <center>
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