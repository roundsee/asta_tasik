<?php 
include '../../../../config/koneksi.php';
// include 'acak.php';

$route=$_GET['route'];
$act=$_GET['act'];

	//Hapus area
if($route=='refund_pos' AND $act=='proses1')
{

// $kode  = $_POST['kode'];
// $pelanggan = mysqli_query($koneksi,"SELECT * from pocer_temp where kode='$kode'")or die(mysqli_error($koneksi));

	// $no_pocer='nopocer03';
	// $cakupan='kotaBandung';
	$thn=date('y');
	$bln=date('m');

	echo '<br/>'.$hasil_1= acak(4);
	echo '<br/>'.$hasil_2= acak2(4);
	echo '<br/>'.$thn.$hasil_3= acak3(8);

	echo '<br/>'.$hasil_acak= $thn.$hasil_2.$bln.$hasil_1;

	$cakup=$_POST['cakup'];
	//echo '<br/>'.$cakup;
	$jmlvoucher=$_POST['jmlvoucher'];
	//echo '<br/>'.$jmlvoucher;
	$tgl_awal=$_POST['tgl_awal'];
	//echo '<br/>'.$tgl_awal;
	$tgl_akhir=$_POST['tgl_akhir'];
	//echo '<br/>'.$tgl_akhir;
	$nilaivoucher=$_POST['nilaivoucher'];
	//echo '<br/>'.$nilaivoucher;
	$hargajual=$_POST['hargajual'];
	//echo '<br/>'.$hargajual;
	$keterangan=$_POST['keterangan'];
	//echo '<br/>'.$keterangan;
	// $outlet=$_POST['outlet'];
	// echo '<br/>'.$outlet;
	// $kota=$_POST['kota'];
	// echo '<br/>'.$kota;


	$no=1;
	$xmax=$_POST['jmlvoucher'];
	while ($no <= $xmax)
	{
		$hasil_1= acak(4);
		$hasil_2= acak2(4);
		$thn.$hasil_3= acak3(8);
		$hasil_acak= $thn.$hasil_2.$bln.$hasil_1;

		mysqli_query($koneksi,"INSERT INTO pocer_temp (
			no_pocer,cakupan,nilai,harga_jual,tgl_terbit,tgl_daluarsa,keterangan) 
		values (
			'$hasil_acak', '$cakup', '$nilaivoucher', '$hargajual', '$tgl_awal', '$tgl_akhir', '$keterangan'
		) " ) or die(mysqli_error($koneksi));
		$no ++;
	}

	if ($cakup=='Nasional'){
		$query=mysqli_query($koneksi,"SELECT * FROM pocer_temp ORDER by no_pocer");

		while($q = mysqli_fetch_array($query)){

			$no_pocer= $q['no_pocer'];
			$cakupan= $q['cakupan'];
			$nilai= $q['nilai'];
			$harga_jual=$q['harga_jual'];
			$tgl_terbit=$q['tgl_terbit'];
			$tgl_daluarsa=$q['tgl_daluarsa'];
			$keterangan=$q['keterangan'];

			if($cakupan=='Nasional'){
				$kd_kota=$kota;
				$kd_cus='';
			}

			$jadi = $no_pocer.'-'.$cakupan;

			mysqli_query($koneksi,"INSERT INTO pocer_detil_temp (
				jadi,no_pocer,cakupan,kd_kota,kd_cus,nilai,tgl_terbit,tgl_daluarsa) 
			values (
				'$jadi','$no_pocer', '$cakupan', '$kd_kota','$kd_cus','$nilai', '$tgl_terbit', '$tgl_daluarsa'
			) " ) or die(mysqli_error($koneksi));
		}
	}

	header('location:../../main.php?route=index_edit');
	
}elseif($route=='refund_pos' AND $act=='proses2b')
{

	$cakup=$_POST['cakup'];
	echo '<br/>'.$cakup;


	$nama=$_POST['nama'];
	//echo '<br/>'.$nama;

	if($cakup=='Kota'){
		$kode=$_POST['kota'];
			//echo '<br/>'.$kota;
		$query=mysqli_query($koneksi,"SELECT * from kotabaru where kode='$kode' ");			
	}elseif($cakup=='Outlet'){
		$kode=$_POST['outlet'];
			//echo '<br/>'.$outlet;
		$query=mysqli_query($koneksi,"SELECT * from pelanggan where kd_cus='$kode' ");
	}

		// $jadi = $no_pocer.'-'.$cakupan.'-'.$kd_kota;

	$q1=mysqli_fetch_array($query);
	$kd_area=$q1['kd_area'];

	$query=mysqli_query($koneksi,"SELECT * FROM pocer_kota_outlet_temp where kode='$kode' ");
	if ($q1=mysqli_fetch_row($query)){
		echo "<script>alert('Data sdh ada.')</script>";
		header('location:../../main.php?route=index_edit&act');
	}

	mysqli_query($koneksi,"INSERT INTO pocer_kota_outlet_temp (
		kode,nama,kd_area) 
	values (
		'$kode','$nama','$kd_area'
	) " ) or die(mysqli_error($koneksi));
	
	header('location:../../main.php?route=index_edit&act');

}
elseif($route=='refund_pos' AND $act=='hapuskota')
{

	// $outlet=$_POST['outlet'];
	// echo '<br/>'.$outlet;
	$id=$_GET['id'];
	//echo '<br/>'.$id;

	//$nama=$_POST['nama'];
	//echo '<br/>'.$nama;

		// $jadi = $no_pocer.'-'.$cakupan.'-'.$kd_kota;

	mysqli_query($koneksi,"DELETE from pocer_kota_outlet_temp where kode='$id' ")
	or die(mysqli_error($koneksi));
	
	header('location:../../main.php?route=index_edit&act');
}

elseif($route=='refund_pos' AND $act=='save')
{

	$query=mysqli_query($koneksi,"SELECT * FROM pocer_temp ORDER by no_pocer");

	while($q = mysqli_fetch_array($query)){

		$no_pocer= $q['no_pocer'];
		$cakupan= $q['cakupan'];
		$nilai= $q['nilai'];
		$harga_jual=$q['harga_jual'];
		$tgl_terbit=$q['tgl_terbit'];
		$tgl_daluarsa=$q['tgl_daluarsa'];
		$keterangan=$q['keterangan'];

		mysqli_query($koneksi,"INSERT INTO pocer (
			no_pocer,cakupan,nilai,harga_jual,tgl_terbit,tgl_daluarsa,keterangan) 
		values (
			'$no_pocer', '$cakupan','$nilai', '$harga_jual','$tgl_terbit', '$tgl_daluarsa', '$keterangan'
		) " ) or die(mysqli_error($koneksi));

	}

		// Entry tabel pocer detil

	if($cakupan=='Nasional'){
		$query=mysqli_query($koneksi,"SELECT * FROM pocer_detil_temp ORDER by no_pocer");

		while($q = mysqli_fetch_array($query)){
		//$jadi= $q['jadi'];
			$no_pocer= $q['no_pocer'];
			$cakupan= $q['cakupan'];
			$kd_cus='';
			$kd_kota='';
			$jadi = $no_pocer.'-'.$cakupan;
			$nilai= $q['nilai'];
			$tgl_terbit=$q['tgl_terbit'];
			$tgl_daluarsa=$q['tgl_daluarsa'];
			mysqli_query($koneksi,"INSERT INTO pocer_detil (
				jadi,no_pocer,cakupan,kd_kota,kd_cus,nilai,tgl_terbit,tgl_daluarsa) 
			values (
				'$jadi','$no_pocer', '$cakupan','$kd_kota','$kd_cus','$nilai', '$tgl_terbit', '$tgl_daluarsa'
			) " ) or die(mysqli_error($koneksi));
		}

	}else{

		$query=mysqli_query($koneksi,"SELECT * FROM pocer_temp ORDER by no_pocer");

		while($q = mysqli_fetch_array($query)){
		//$jadi= $q['jadi'];
			$no_pocer= $q['no_pocer'];
			$cakupan= $q['cakupan'];
		// $kd_kota= $q['kd_kota'];
		// $kd_cus= $q['kd_cus'];
			$nilai= $q['nilai'];
			$tgl_terbit=$q['tgl_terbit'];
			$tgl_daluarsa=$q['tgl_daluarsa'];

			$query2=mysqli_query($koneksi,"SELECT * FROM pocer_kota_outlet_temp ORDER by nama");
			while($q2 = mysqli_fetch_array($query2)){
				if($cakupan=='Kota'){
					$kd_kota=$q2['kode'];
					$jadi = $no_pocer.'-'.$cakupan.'-'.$kd_kota;
					$kd_cus='';
				}elseif($cakupan=='Outlet'){
					$kd_cus=$q2['kode'];
					$jadi = $no_pocer.'-'.$cakupan.'-'.$kd_cus;
					$kd_kota='';
				}

				mysqli_query($koneksi,"INSERT INTO pocer_detil (
					jadi,no_pocer,cakupan,kd_kota,kd_cus,nilai,tgl_terbit,tgl_daluarsa) 
				values (
					'$jadi','$no_pocer', '$cakupan','$kd_kota','$kd_cus','$nilai', '$tgl_terbit', '$tgl_daluarsa'
				) " ) or die(mysqli_error($koneksi));
			}

		}
	}


	// header('location:index.php');
	header('location:../../main.php?route='.$route.'&act');

}
elseif($route=='refund_pos' AND $act=='report')
{

	$tgl_awal=$_POST['tgl_awal'];
	$tgl_akhir=$_POST['tgl_akhir'];
	// $filter=$_POST['filter'];
	$kota=$_POST['kota'];
	$outlet=$_POST['outlet'];
	$area=$_POST['area'];

	echo '<br/>'.$tgl_awal;
	echo '<br/>'.$tgl_akhir;
	// echo '<br/>'.$filter;
	echo '<br/>'.$kota;
	echo '<br/>'.$outlet;
	echo '<br/>'.$area;

	if($kota!=''){
		$filter='kota';
		$nilai=$kota;
	}elseif($outlet!=''){
		$filter='outlet';
		$nilai=$outlet;
	}elseif($area!=''){
		$filter='area';
		$nilai=$area;
	}else{
		$filter='semua';
		$nilai='semua';
	}

	header('location:../../main.php?route='.$route.'&act=report&filter='.$filter.'&nilai='.$nilai.'&tgl_awal='.$tgl_awal.'&tgl_akhir='.$tgl_akhir);
	// header('location:../../route/lap_pb1/lap_1.php?filter='.$filter.'&nilai='.$nilai.'&tgl_awal='.$tgl_awal.'&tgl_akhir='.$tgl_akhir);

}
elseif($route=='refund_pos' AND $act=='report_refund_pos1')
{

	$tgl_awal=$_POST['tgl_awal'];
	$tgl_akhir=$_POST['tgl_akhir'];
	// $filter=$_POST['filter'];
	$kota=$_POST['kota'];
	$outlet=$_POST['outlet'];
	$area=$_POST['area'];
	$kasir=$_POST['kasir'];

	echo '<br/>'.$tgl_awal;
	echo '<br/>'.$tgl_akhir;
	// echo '<br/>'.$filter;
	echo '<br/>'.$kota;
	echo '<br/>'.$outlet;
	echo '<br/>'.$area;
	echo '<br/>'.$kasir;

	if($kota!=''){
		$filter='kota';
		$nilai=$kota;
	}elseif($outlet!=''){
		$filter='outlet';
		$nilai=$outlet;
	}elseif($area!=''){
		$filter='area';
		$nilai=$area;
	}elseif($kasir!=''){
		$filter='kasir';
		$nilai=$kasir;
	}else{
		$filter='semua';
		$nilai='semua';
	}

	// header('location:../../main.php?route='.$route.'&act=report&filter='.$filter.'&nilai='.$nilai.'&tgl_awal='.$tgl_awal.'&tgl_akhir='.$tgl_akhir);
	header('location:../../route/lap_refund/lap_refund_pos1.php?filter='.$filter.'&nilai='.$nilai.'&tgl_awal='.$tgl_awal.'&tgl_akhir='.$tgl_akhir);

}
elseif($route=='refund_pos' AND $act=='report_refund_pos2')
{

	$tgl_awal=$_POST['tgl_awal'];
	$tgl_akhir=$_POST['tgl_akhir'];
	// $filter=$_POST['filter'];
	$kota=$_POST['kota'];
	$outlet=$_POST['outlet'];
	$area=$_POST['area'];
	$kasir=$_POST['kasir'];

	echo '<br/>'.$tgl_awal;
	echo '<br/>'.$tgl_akhir;
	// echo '<br/>'.$filter;
	echo '<br/>'.$kota;
	echo '<br/>'.$outlet;
	echo '<br/>'.$area;
	echo '<br/>'.$kasir;

	if($kota!=''){
		$filter='kota';
		$nilai=$kota;
	}elseif($outlet!=''){
		$filter='outlet';
		$nilai=$outlet;
	}elseif($area!=''){
		$filter='area';
		$nilai=$area;
	}elseif($kasir!=''){
		$filter='kasir';
		$nilai=$kasir;
	}else{
		$filter='semua';
		$nilai='semua';
	}

	// header('location:../../main.php?route='.$route.'&act=report&filter='.$filter.'&nilai='.$nilai.'&tgl_awal='.$tgl_awal.'&tgl_akhir='.$tgl_akhir);
	header('location:../../route/lap_refund/lap_refund_pos2.php?filter='.$filter.'&nilai='.$nilai.'&tgl_awal='.$tgl_awal.'&tgl_akhir='.$tgl_akhir);

}

