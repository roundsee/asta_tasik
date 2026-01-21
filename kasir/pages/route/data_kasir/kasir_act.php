<?php 
include '../../../../config/koneksi.php';
include '../../../../config/library.php';
session_start();

$no_inv 				= $_POST['no_inv'];
$kd_cus 				= $_POST['kd_cus'];
$kd_aplikasi 		= $_SESSION['kd_aplikasi']; 
$no_meja 				= $_POST['no_meja'];
$oleh 					= $_POST['oleh'];
$subjumlah			= $_POST['subjumlah'];
$ppn						= ceil($_POST['nilai_tax']);
$jumlah 				= $_POST['total'];
$byr_pocer			= $_POST['byr_pocer'];
$byr_tunai			= $_POST['byr_tunai'];
$byr_non_tunai	= $_POST['byr_non_tunai'];
$kd_alatbayar		= $_POST['kd_alatbayar'];
$tahun					= date('Y');
$bulan					= date('Ym');
$jam 						= date("H:i:s");
$kdsub_alatbayar	= $_POST['kdsub_alatbayar'];
$subjumlah_offline 	= 0;
$dasar_fee			= 0;
$faktur_refund 	= $_POST['faktur_refund'];
$dasar_faktur 	= $_POST['dasar_faktur'];
// $kd_promo				= $_POST['kd_promo'];

// mencari no Invoice
$char=substr($no_inv,0,14);
echo '<br> '.$char;


$hasil = mysqli_query($koneksi,"SELECT no_urut,max(no_urut) as max_nourut FROM penjualan where substr(faktur,1,14) ='$char' ");

$hsl = mysqli_fetch_array($hasil);
$no_urut = $hsl['max_nourut'];
// echo 'kode :'.$no_urut;
// echo "no : ";
echo 'norut 1 ='.$no_urut;
if($no_urut!=""){
	$no_urut++;
}else{
	$no_urut=1;
}

echo 'norut 2 ='.$no_urut;

$noInvoice = substr($no_inv,0,14) .'-'. sprintf("%04s", $no_urut);

// mencari ket_aplikasi,no_online,no_ofline
if($kd_aplikasi=='11'){
	$ket_aplikasi='OF LINE';
	$no_online=0;
	$no_ofline=1;
}else{
	$ket_aplikasi='ON LINE';
	$no_online=1;
	$no_ofline=0;
}

// Jika pembayaran Tunai (kdsub_alatbayar)
if($kdsub_alatbayar=='0'){
	$kdsub_alatbayar='100-01';
	$kd_alatbayar='100';
}

// mencari tarif_fee,acuan_fee,b_paking
if($kd_alatbayar!=null){
	$query1=mysqli_query($koneksi,"SELECT tarif_fee,acuan_fee,b_packing FROM subalat_bayar where kdsub_alat='$kdsub_alatbayar' ");
	$q1=mysqli_fetch_array($query1);

	$tarif_fee=$q1['tarif_fee'];
	$acuan_fee=$q1['acuan_fee'];
	$b_paking=$q1['b_packing'];
}else{
	$tarif_fee=0;
	$acuan_fee="";
	$b_paking=0;

}


// mencari kd_kota
$query2=mysqli_query($koneksi,"SELECT kd_kota FROM pelanggan where kd_cus='$kd_cus' ");
$q2=mysqli_fetch_array($query2);
$kd_kota=$q2['kd_kota'];

// mencari tarif_pb1
$query3=mysqli_query($koneksi,"SELECT tarif_pb1 FROM kotabaru where kode='$kd_kota' ");
$q3=mysqli_fetch_array($query3);
$tarif_pb1=$q3['tarif_pb1'];


echo ' noInvoice = '.$noInvoice; 		
echo ' kd_cus=> '.$kd_cus; 			
echo ' kd_aplikasi=> '.$kd_aplikasi; 		
echo ' no_meja=> '.$no_meja; 		
echo ' oleh=> '.$oleh; 		
echo ' subjumlah=> '.$subjumlah	;	
echo ' ppn=> '.$ppn;			
echo ' jumlah=> '.$jumlah; 		
echo ' byr_pocer=> '.$byr_pocer;		
echo ' byr_tunai=> '.$byr_tunai;		
echo ' byr_non_tunai=> '.$byr_non_tunai;	
echo ' kd_alatbayar=> '.$kd_alatbayar;	
echo ' no_urut=> '.$no_urut;		
echo ' tahun=> '.$tahun	;		
echo ' bulan=> '.$bulan;			
echo ' jam=> '.$jam;
echo '<br>';
echo ' kdsub_alatbayar=> '.$kdsub_alatbayar;	
echo ' subjumlah_offline=> '.$subjumlah_offline;

echo ' ket_aplikasi=> '.$ket_aplikasi ;		
echo ' acuan_fee=> '.$acuan_fee ;		
echo ' tarif_fee=> '.$tarif_fee ;		
echo ' b_paking=> '.$b_paking ;		
echo ' no_online=> '.$no_online	;		
echo ' no_ofline=> '.$no_ofline	;	
echo ' tarif_pb1=> '.$tarif_pb1 ;		
echo ' faktur_refund=> '.$faktur_refund;
echo ' dasar_faktur=> '.$dasar_faktur ;




if($byr_pocer > $jumlah){
	$input_tunai=0;
}elseif($byr_pocer < $jumlah){
	$input_tunai = ($jumlah - $byr_non_tunai - $byr_pocer);
}

echo ' input Tunai=> '.$input_tunai ;

$transaksi_produk = $_POST['transaksi_produk'];
$transaksi_harga = $_POST['transaksi_harga'];
$transaksi_jumlah = $_POST['transaksi_jumlah'];
$transaksi_total = $_POST['transaksi_total'];
$transaksi_diskon = $_POST['transaksi_diskon'];
$transaksi_ket = $_POST['transaksi_ket'];
$transaksi_kd_promo = $_POST['transaksi_kd_promo'];

$jumlah_pembelian = count($transaksi_produk);

echo '<br> jumlah item : '.$jumlah_pembelian;

$urut=1;
$tot_subjumlah_offline=0;

for($a=0;$a<$jumlah_pembelian;$a++){

	$t_produk = $transaksi_produk[$a];
	$t_harga = $transaksi_harga[$a];
	$t_jumlah = $transaksi_jumlah[$a];
	$t_total = $transaksi_total[$a];
	$t_diskon = $transaksi_diskon[$a];
	$t_ket = $transaksi_ket[$a];
	$t_kd_promo = $transaksi_kd_promo[$a];

	$kd_detail_barang=$kd_kota.'-'.$kd_aplikasi.'-'.$t_produk;
	$hitungan_total=$t_total-($t_diskon*$t_jumlah);

	echo "<br/>".$kd_detail_barang;
	echo "<br/>";

	echo ' = produk : '.$t_produk;
	echo ' = harga : '.$t_harga;
	echo ' = jumlah : '.$t_jumlah;
	echo ' = total : '.$t_total;
	echo ' = diskon : '.$t_diskon;
	echo ' = ket : '.$t_ket;
	echo ' = kd_promo : '.$t_kd_promo;
	echo ' = hitungan Total : '.$hitungan_total;


	$query6=mysqli_query($koneksi, "SELECT harga,harga_cafe,harga_dine_in,harga_cafe FROM barang_kota where jadi='$kd_detail_barang' ");
	$q6=mysqli_fetch_array($query6);

	if($kd_aplikasi==11){
		$harga_dasar=$q6['harga'];
	}elseif($q6['harga_dine_in']==0){
		$harga_dasar=$q6['harga']-($q6['harga']*10/100);
	}else{
		$harga_dasar=$q6['harga_dine_in'];
	}

	echo 'harga dasar = '.$harga_dasar;

	$tot_subjumlah_offline=$tot_subjumlah_offline+($t_jumlah * $harga_dasar);

	$jadi=$noInvoice."-".sprintf("%04s", $urut);
	echo ' <br> jadi :'.$jadi;
	$urut++;

	// simpan data pembelian

	mysqli_query($koneksi, "INSERT into jualdetil values('$jadi','$noInvoice',NULL,'$kd_cus','$kd_aplikasi','$t_kd_promo','$t_produk','$t_jumlah','$t_harga','$t_diskon','$hitungan_total',NULL,'$t_ket','$harga_dasar')")or die(mysqli_errno($koneksi));
}
// END Pengisian Penjualan dan detail 
echo '<br>masuk tahap 2';
$subjumlah_offline=$tot_subjumlah_offline;
echo '<br>sub subjumlah_offline = '.$subjumlah_offline;

// mencari dasar_fee
$nilai_tarif_fee=$tarif_fee/100;
$selisih_harga=($subjumlah-$subjumlah_offline);

echo '<br> : '.$nilai_tarif_fee;
echo '<br> : '.$selisih_harga;
if($acuan_fee=='Harga Jual'){
	$dasar_fee=$subjumlah*$nilai_tarif_fee;
	echo '<br> if 1 harga jual ';
	echo '<br> : '.$dasar_fee;
	echo '<br> : '.$tarif_fee;
}elseif($acuan_fee=='Selisih Harga Jual'){
	$dasar_fee=$selisih_harga*$nilai_tarif_fee;
	echo '<br> if 2 selisih harga';
	echo '<br> : '.$dasar_fee;
	echo '<br> : '.$tarif_fee;
}else{
	$dasar_fee=0;
	echo '<br> else ';
	echo '<br> : '.$dasar_fee;
}

// Pengisian Penjualan

mysqli_query($koneksi, "INSERT into penjualan (faktur,tanggal,kd_cus,kd_aplikasi,no_meja,oleh,subjumlah,ppn,jumlah,byr_pocer,byr_tunai,byr_non_tunai,kd_alatbayar,no_urut,tahun,bulan,jam,kdsub_alatbayar,subjumlah_offline,ket_aplikasi,dasar_fee,acuan_fee,tarif_fee,b_paking,no_online,no_ofline,tarif_pb1,faktur_refund,dasar_faktur)
values(
	'$noInvoice',null,'$kd_cus','$kd_aplikasi','$no_meja','$oleh','$subjumlah','$ppn','$jumlah','$byr_pocer','$input_tunai','$byr_non_tunai','$kd_alatbayar','$no_urut','$tahun','$bulan','$jam','$kdsub_alatbayar','$subjumlah_offline','$ket_aplikasi','$dasar_fee','$acuan_fee','$tarif_fee','$b_paking','$no_online','$no_ofline','$tarif_pb1','$faktur_refund','$dasar_faktur'
)")or die(mysqli_errno($koneksi));

echo "<br> simpan ke Penjualan";


// END Pengisian penjulan


echo '<br> Tahap 3';

// Pengisian Detail Voucher

$urut=1;
if($kd_aplikasi=='11' AND isset($_POST['voucher_produk'])){
	$voucher_produk = $_POST['voucher_produk'];
	$voucher_nilai = $_POST['voucher_nilai'];

	$jumlah_voucher = count($voucher_produk);

	echo '<br> jumlah voucher : '.$jumlah_voucher;

	for($b=0;$b<$jumlah_voucher;$b++){
		$v_produk = $voucher_produk[$b];
		$v_nilai = $voucher_nilai[$b];

		echo "<br/>";
		echo ' = produk : '.$v_produk;
		echo ' = nilai : '.$v_nilai;

		$jadiVoucher=$noInvoice."-".sprintf("%04s", $urut);
		echo $jadiVoucher;
		$urut++;

	//simpan data pembelian

		mysqli_query($koneksi, "INSERT into jualdetilpocer values('$jadiVoucher','$noInvoice',NULL,'$kd_cus','$kd_aplikasi','$v_produk','$v_nilai','$oleh',NULL)")or die(mysqli_errno($koneksi));

		mysqli_query($koneksi, "UPDATE pocer set status = 1 WHERE no_pocer='$v_produk' ") or die(mysqli_errno($koneksi));
	}
}

header("location:../../main.php?route=print&id=$noInvoice&dibayar=$byr_tunai");