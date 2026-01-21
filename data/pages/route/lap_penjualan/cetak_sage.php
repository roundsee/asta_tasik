<?php 

include '../../../../config/koneksi.php';
include '../../../../config/fungsi_rupiah.php';
include '../../../../config/library.php';

session_start();

$login_hash=$_SESSION['login_hash'];
$en=$_SESSION['employee_number'];
$namauser=$_SESSION['namauser'];
$tujuan=$_GET['tujuan'];

$tgl_awal=$_GET['tgl_awal'];
$tgl_akhir=$_GET['tgl_akhir'];
$filter=$_GET['filter'];
$nilai=$_GET['nilai'];
$judul=$_GET['judul'];

$judulform="Rekap Penjualan ";

$data='lap_penjualan';
$rute='rekap_penjualan';
$aksi='aksi_rekap_penjualan';

$tabel="penjualan";
$f1='faktur';
$f2='tanggal';
$f3='kd_cus';
$f4='kd_aplikasi';
$f5='no_meja';
$f6='oleh';
$f7='subjumlah';
$f8='ppn';
$f9='jumlah';
$f10='byr_pocer';
$f11='byr_tunai';
$f12='byr_non_tunai';
$f13='kd_alatbayar';
$f14='no_urut';
$f15='tahun';
$f16='bulan';
$f17='jam';
$f18='kdsub_alatbayar';
$f19='subjumlah_offline';
$f20='ket_aplikasi';
$f21='dasar_fee';
$f22='acuan_fee';
$f23='tarif_fee';
$f24='b_packing';
$f25='no_online';
$f26='no_ofline';
$f27='tarif_pb1';
$f28='faktur_refund';
$f29='dasar_faktur';
$f30='faktur_void';
$f31='dibayar';
$f32='no_ref';

$j1='Faktur';
$j2='Tanggal';
$j3='Kode Outlet';
$j4='kd_aplikasi';
$j5='no_meja';
$j6='oleh';
$j7='Sub jumlah';
$j8='PB1';
$j9='Jumlah';
$j10='byr_pocer';
$j11='byr_tunai';
$j12='byr_non_tunai';
$j13='kd_alatbayar';
$j14='no_urut';
$j15='tahun';
$j16='bulan';
$j17='jam';
$j18='kdsub_alatbayar';
$j19='subjumlah_offline';
$j20='ket_aplikasi';
$j21='dasar_fee';
$j22='acuan_fee';
$j23='tarif_fee';
$j24='b_packing';
$j25='no_online';
$j26='no_ofline';
$j27='tarif_pb1';
$j28='faktur_refund';
$j29='dasar_faktur';
$j30='faktur_void';
$j31='dibayar';
$j32='no_ref';


$tabel2='kotabaru';
$ff1='kode';
$tabel3='pelanggan';
$gg1='kd_cus';

?>

<html>
<head>
	<title><?php echo $judul;?></title>

</head>
<!-- <body style='font-family:tahoma; font-size:9pt;' onload="javascript:window.print()"> -->

	<body style='font-family:Arial;' onload="javascript:window.print()" >
		<?php

        // echo "<br/>".$tgl_awal;
        // echo "<br/>".$tgl_akhir;
        // echo "<br/>".$filter;
        // echo "<br/>".$nilai;
		if ($tujuan=='aplikasi') {
			$kondisi2='Aplikasi';
			$kondisi_group=' ,penjualan.kd_aplikasi';
		}elseif($tujuan=='carabayar'){
			$kondisi2='Sub Alat Bayar';
			$kondisi_group=' ,penjualan.kdsub_alatbayar';
		}elseif($tujuan=='alatbayar'){
			$kondisi2='Alat Bayar';
			$kondisi_group=' ,penjualan.kd_alatbayar';
		}elseif($tujuan=='kasir'){
			$kondisi2='Kasir';
			$kondisi_group=' ,penjualan.oleh';
		}elseif($tujuan=='outlet'){
			$kondisi2='Outlet';
			$kondisi_group=' ,penjualan.kd_cus';
		}else{
			$kondisi2='';
			$kondisi_group='';
		}

		if($filter=='kota'){
			$kondisi="AND pelanggan.kd_kota='$nilai'";
			$query=mysqli_query($koneksi,"SELECT nama FROM kotabaru WHERE kode='$nilai' ");
			$q1=mysqli_fetch_array($query);
			$judul_nilai= $q1['nama'];
		}elseif($filter=='outlet'){
			$kondisi="AND penjualan.kd_cus='$nilai'";
			$query=mysqli_query($koneksi,"SELECT nama FROM pelanggan WHERE kd_cus='$nilai' ");
			$q1=mysqli_fetch_array($query);
			$judul_nilai= $q1['nama'];
		}elseif($filter=='area'){
			$kondisi="AND kotabaru.kd_area='$nilai'";
			$query=mysqli_query($koneksi,"SELECT nama FROM area WHERE kode='$nilai' ");
			$q1=mysqli_fetch_array($query);
			$judul_nilai= $q1['nama'];
		}else{
			$kondisi="";
			$judul_nilai='';
		}


		if($login_hash=='6' OR $login_hash=='7'){
			$filter='Outlet';
			$query=mysqli_query($koneksi,"SELECT cabang_e FROM employee WHERE employee_number='$en' ");
			$q1=mysqli_fetch_array($query);
			$nilai= $q1['cabang_e'];
			$kondisi="AND penjualan.kd_cus='$nilai'";
			$query=mysqli_query($koneksi,"SELECT nama FROM pelanggan WHERE kd_cus='$nilai' ");
			$q1=mysqli_fetch_array($query);
			$judul_nilai= $q1['nama'];
		}

		$judul=$_GET['judul'];
		$judul2=$filter." : ".$judul_nilai;
		$judul3='Periode : '.$tgl_awal." s/d ".$tgl_akhir;

		?>

		<h3><?php echo $judul;?></h3>
		<?php echo $judul2;?>
		<br>
		<?php echo $judul3;?>
		<?php

		$query="SELECT  pelanggan.kd_cus as p_kd_cus,pelanggan.nama as p_nama,kotabaru.nama as kb_nama ,jenis_transaksi.nama as jt_nama,alat_bayar.nama as ab_nama,subalat_bayar.nama as sab_nama,penjualan.kd_aplikasi as ka_kode,penjualan.kd_alatbayar as kd_alatbayar,penjualan.kdsub_alatbayar as kdsub_alatbayar,
		sum(penjualan.jumlah) as rekap_jumlah,
		sum(penjualan.byr_tunai) as rekap_tunai,
		sum(penjualan.byr_non_tunai) as rekap_non_tunai,
		sum(penjualan.byr_pocer) as rekap_pocer
		FROM penjualan 
		join pelanggan on pelanggan.kd_cus=penjualan.kd_cus
		join kotabaru on kotabaru.kode=pelanggan.kd_kota
		join jenis_transaksi on jenis_transaksi.kd_jenis=penjualan.kd_aplikasi
		join alat_bayar on alat_bayar.kd_alat=penjualan.kd_alatbayar
		join subalat_bayar on subalat_bayar.kdsub_alat=penjualan.kdsub_alatbayar
		WHERE tanggal>='$tgl_awal' AND tanggal <= '$tgl_akhir' +interval 1 day $kondisi
		GROUP By pelanggan.kd_cus,ab_nama 
		";

		$sql1=mysqli_query($koneksi,$query);
		$no=1;

		$p_nama=[];
		$kd_cus=[];
		$kb_nama=[];
		$jt_nama=[];
		$kd_alatbayar=[];
		$ab_nama=[];
		$kdsub_alatbayar=[];
		$sab_nama=[];
		$ka_kode=[];
		$rekap_jumlah=[];
		$rekap_tunai=[];
		$rekap_non_tunai=[];
		$rekap_pocer=[];

		$total_tunai=0;
		$total_pocer=0;

		while($s1=mysqli_fetch_array($sql1))
		{
			$kd_cus[]=$s1['p_kd_cus'];
			$p_nama[]=$s1['p_nama'];
			$kb_nama[]=$s1['kb_nama'];
			$jt_nama[]=$s1['jt_nama'];
			$kd_alatbayar[]=$s1['kd_alatbayar'];
			$ab_nama[]=$s1['ab_nama'];
			$kdsub_alatbayar[]=$s1['kdsub_alatbayar'];
			$sab_nama[]=$s1['sab_nama'];
			$ka_kode[]=$s1['ka_kode'];
			$rekap_jumlah[]=$s1['rekap_jumlah'];
			$rekap_tunai[]=$s1['rekap_tunai'];
      // $rekap_non_tunai[]=$s1['rekap_non_tunai'];
			$rekap_pocer[]=$s1['rekap_pocer'];
			$total_tunai=$total_tunai+$s1['rekap_tunai'];
			$total_pocer=$total_pocer+$s1['rekap_pocer'];

			if($s1['kd_alatbayar']==100){
				$rekap_non_tunai[]=$total_tunai;
				$total_tunai=0;

				$kd_cus[]=$s1['p_kd_cus'];
				$p_nama[]=$s1['p_nama'];
				$kb_nama[]=$s1['kb_nama'];
				$jt_nama[]=$s1['jt_nama'];
				$kd_alatbayar[]=900;
				$ab_nama[]='VOUCHER';
				$kdsub_alatbayar[]=$s1['kdsub_alatbayar'];
				$sab_nama[]=$s1['sab_nama'];
				$ka_kode[]=$s1['ka_kode'];
				$rekap_jumlah[]=$s1['rekap_jumlah'];
				$rekap_tunai[]=0;
				$rekap_pocer[]=$s1['rekap_pocer'];
				$rekap_non_tunai[]=$total_pocer;
				$total_pocer=0;



			}else
			{
				$rekap_non_tunai[]=$s1['rekap_non_tunai'];
			}

		}

		?>

		<!-- MENGGUNAKAN ARRAY -->

		<!-- <table>

			<?php
			$pjg_data=count($p_nama);
			for ($i=0; $i < $pjg_data; $i++) { 
				?>
				<tr>
					<td><?php echo $i+1;?></td>
					<td><?php echo $p_nama[$i];?></td>
					<td><?php echo $kd_alatbayar[$i];?></td>
					<td><?php echo $ab_nama[$i];?></td>
					<td style="text-align:right;"><?php echo number_format($rekap_tunai[$i]);?></td>
					<td style="text-align:right;"><?php echo number_format($rekap_non_tunai[$i]);?></td>
					<td style="text-align:right;"><?php echo number_format($rekap_pocer[$i]);?></td>
				</tr>

				<?php
			}
			?>
		</table> -->

		<table id="example" border="1" class="table table-bordered table-striped">
			<thead style="background-color:  lightgray;" class="elevation-2">
				<th>No</th>
				<th>Kode</th>
				<th>Outlet</th>
				<th>Kode</th>
				<th>Nama</th>
				<th>Pembayaran</th>
			</thead>
			<tbody>
				<?php

				$pjg_data=count($p_nama);

				for ($i=0; $i < $pjg_data; $i++) { 
					?>
					<tr>
						<td><?php echo $i+1;?></td>
						<td><?php echo $kd_cus[$i];?></td>
						<td><?php echo $p_nama[$i];?></td>
						<td><?php echo $kd_alatbayar[$i];?></td>
						<td><?php echo $ab_nama[$i];?></td>
						<td style="text-align:right;"><?php echo number_format($rekap_non_tunai[$i]);?></td>

					</tr>

					<?php
				}
				?>
			</tbody>

		</table>
		<br>

		<div class="row">
			<footer class="main-footer "  style="padding:.3rem;background-color: yellow;">

				<!-- Default to the left -->
				<strong>Copyright &copy; 2020-<?php echo $thn_sekarang." ".$perusahaan;?>.</strong>  by Develop. All rights Reserved.
				<!-- To the right -->
				<div class="float-right d-none d-sm-inline">
					<b>Version</b> <?php echo $ver;?>
				</div>
			</footer>
		</div>

	</body>
	</html>
