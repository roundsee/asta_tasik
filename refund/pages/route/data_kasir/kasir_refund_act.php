<?php 
include '../../../../config/koneksi.php';
include '../../../../config/library.php';

session_start();

$en=$_SESSION['employee_number'];

$no_faktur=$_POST['no_faktur'];

$no_faktur_refund=$no_faktur.'R';
// echo $no_faktur_refund;


$query=mysqli_query($koneksi,"SELECT * FROM penjualan WHERE faktur='$no_faktur' ");
$q=mysqli_fetch_array($query);

// mencari kd_kota
$query2=mysqli_query($koneksi,"SELECT * FROM pelanggan where kd_cus='$q[kd_cus]' ");
$q2=mysqli_fetch_array($query2);
$kd_kota=$q2['kd_kota'];


$kd_cus=$q['kd_cus'];
$kd_aplikasi=$q['kd_aplikasi'];
$no_meja=$q['no_meja'];
$oleh=$q['oleh'];
$subjumlah=$q['subjumlah'];
$ppn=$q['ppn'];
$jumlah=$q['jumlah'];
$byr_pocer=$q['byr_pocer'];
$byr_tunai=$q['byr_tunai'];
$byr_non_tunai=$q['byr_non_tunai'];
$kd_alatbayar=$q['kd_alatbayar'];
$no_urut=$q['no_urut'];
$tahun= date('Y');
$bulan= date('Ym');
$jam = date("H:i:s");
$kdsub_alatbayar=$q['kdsub_alatbayar'];
$subjumlah_offline=$q['subjumlah_offline'];
$ket_aplikasi=$q['ket_aplikasi'];
$dasar_fee=$q['dasar_fee'];
$acuan_fee=$q['acuan_fee'];
$tarif_fee=$q['tarif_fee'];
$b_paking=$q['b_paking'];
$no_online=$q['no_online'];
$no_ofline=$q['no_ofline'];
$tarif_pb1=$q['tarif_pb1'];
$faktur_refund=$q['faktur_refund'];
$dasar_faktur=$q['dasar_faktur'];

$subjumlah=0-$q['subjumlah'];
$ppn=0-$q['ppn'];
$jumlah=0-$q['jumlah'];

$subjumlah_offline=0-$q['subjumlah_offline'];

$byr_tunai=0-($byr_tunai+$byr_non_tunai);
$byr_non_tunai=0;

// echo 'simpan penjualan refund';

mysqli_query($koneksi,"INSERT INTO penjualan (faktur,tanggal,kd_cus,kd_aplikasi,no_meja,oleh,subjumlah,ppn,jumlah,byr_pocer,byr_tunai,byr_non_tunai,kd_alatbayar,no_urut,tahun,bulan,jam,kdsub_alatbayar,subjumlah_offline,ket_aplikasi,dasar_fee,acuan_fee,tarif_fee,b_paking,no_online,no_ofline,tarif_pb1,faktur_refund,dasar_faktur) values('$no_faktur_refund',NULL,'$kd_cus','$kd_aplikasi','$no_meja','$oleh','$subjumlah','$ppn','$jumlah','$byr_pocer','$byr_tunai','$byr_non_tunai','$kd_alatbayar','$no_urut','$tahun','$bulan','$jam','$kdsub_alatbayar','$subjumlah_offline','$ket_aplikasi','$dasar_fee','$acuan_fee','$tarif_fee','$b_paking','$no_online','$no_ofline','$tarif_pb1','$no_faktur','$dasar_faktur') ");



$query=mysqli_query($koneksi,"SELECT * FROM jualdetil WHERE faktur='$no_faktur' ");

// echo ' cek jualdetail';

$urut=1;
while($q=mysqli_fetch_array($query))
{
	$jadi_detil = $q['jadi'];
	$kd_cus_detil = $q['kd_cus'];
	$kd_aplikasi_detil = $q['kd_aplikasi'];
	$kd_promo_detil = $q['kd_promo'];
	$kd_brg_detil = $q['kd_brg'];
	$banyak_detil = 0-$q['banyak'];
	$harga_detil = $q['harga'];
	$diskon_detil = $q['diskon'];
	$jumlah_detil = 0-$q['jumlah'];
	$penyajian_detil = $q['penyajian'];
	$harga_dasar_detil = $q['harga_dasar'];
	

	$no_faktur_refund=$no_faktur.'R';
	$jadi_detil = $no_faktur_refund.'-'.substr($q['jadi'],20,4);
	echo $no_faktur;
	echo $no_faktur_refund;
	echo $jadi_detil;


	// simpan data pembelian
	// echo 'simpan jual detil refund';

	mysqli_query($koneksi, "INSERT into jualdetil values('$jadi_detil','$no_faktur_refund',NULL,'$kd_cus_detil','$kd_aplikasi_detil','$kd_promo_detil','$kd_brg_detil','$banyak_detil','$harga_detil','$diskon_detil','$jumlah_detil','$no_faktur',NULL,'$harga_dasar_detil')")or die(mysqli_errno($koneksi));
}
// END Pengisian Penjualan dan detail

// Pengisian Detail Voucher

$query=mysqli_query($koneksi,"SELECT * FROM jualdetilpocer WHERE faktur='$no_faktur' ");

$urut=1;
while($q=mysqli_fetch_array($query))
{

	$jadi_pocer=$q['jadi'];
	$tanggal_pocer=$q['tanggal'];
	$kd_cus_pocer=$q['kd_cus'];
	$kd_aplikasi_pocer=$q['kd_aplikasi'];
	$noseri_pocer=$q['noseri_pocer'];
	$nilai_pocer=$q['nilai'];
	$oleh_pocer=$q['oleh'];


	//simpan data pembelian

	mysqli_query($koneksi, "INSERT into jualdetilpocer values('$jadi_pocer','$no_faktur_refund','$tanggal_pocer','$kd_cus_pocer','$kd_aplikasi_pocer','$noseri_pocer','$nilai_pocer','$oleh_pocer','$no_faktur')");

	mysqli_query($koneksi, "UPDATE pocer set status = 0 WHERE no_pocer='$noseri_pocer' ");
}

// echo 'Pengisian log trans';
mysqli_query($koneksi, "INSERT into log_trans (id_log,tanggal,jenis_transaksi,no_faktur,kd_cus,id_user) values(NULL,NULL,'Refund','$no_faktur_refund','$kd_cus','$en') ")or die(mysqli_errno($koneksi));

echo "<script>history.go(-1)</script>";

?>
