<?php 

include '../../../../config/koneksi.php';
include '../../../../config/fungsi_rupiah.php';
include '../../../../config/library.php';

session_start();

$login_hash=$_SESSION['login_hash'];
$en=$_SESSION['employee_number'];
$namauser=$_SESSION['namauser'];

$tujuan=$_GET['tujuan'];

$judulform="Beban Fee";

$data='lap_beban_adm';
$rute='menu_lap_beban_adm';
$aksi='aksi_beban_adm';

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


$tabel2='kotabaru';
$ff1='kode';
$tabel3='pelanggan';
$gg1='kd_cus';

?>

<html>
<head>
	<title><?php echo $judulform;?></title>

</head>
<!-- <body> -->
	<!-- <body style='font-family:tahoma; font-size:9pt;' onload="javascript:window.print()"> -->
		
		<body style='font-family:Arial;background-color: ghostwhite;' onload="javascript:window.print()">
			<?php

			$tgl_awal=$_GET['tgl_awal'];
			$tgl_akhir=$_GET['tgl_akhir'];
			$filter=$_GET['filter'];
			$nilai=$_GET['nilai'];

        // echo "<br/>".$tgl_awal;
        // echo "<br/>".$tgl_akhir;
        // echo "<br/>".$filter;
        // echo "<br/>".$nilai;

			if ($tujuan=='aplikasi') {
				$kondisi2='Aplikasi';
			}elseif($tujuan=='carabayar'){
				$kondisi2='Cara Bayar';
			}elseif($tujuan=='kasir'){
				$kondisi2='Kasir';
			}else{
				$kondisi2='';
			}


			if($filter=='kota'){
				$kondisi="AND pelanggan.kd_kota='$nilai' ";
				$kondisi_order=" ORDER BY pelanggan.kd_kota ,  tanggal desc";
				$query=mysqli_query($koneksi,"SELECT nama FROM kotabaru WHERE kode='$nilai' ");
				$q1=mysqli_fetch_array($query);
				$judul_nilai= $q1['nama'];
			}elseif($filter=='outlet'){
				$kondisi="AND penjualan.kd_cus='$nilai' ";
				$kondisi_order=" ORDER BY penjualan.kd_cus, tanggal desc";
				$query=mysqli_query($koneksi,"SELECT nama FROM pelanggan WHERE kd_cus='$nilai' ");
				$q1=mysqli_fetch_array($query);
				$judul_nilai= $q1['nama'];
			}elseif($filter=='area'){
				$kondisi="AND kotabaru.kd_area='$nilai' ";
				$kondisi_order="ORDER BY kotabaru.kd_area , tanggal desc";
				$query=mysqli_query($koneksi,"SELECT nama FROM area WHERE kode='$nilai' ");
				$q1=mysqli_fetch_array($query);
				$judul_nilai= $q1['nama'];
			}else{
				$kondisi='';
				$kondisi_order="ORDER BY tanggal desc";
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

			$judul='Rekap '.$judulform;
			$judul2=$filter." : ".$judul_nilai;
			$judul3='Date : '.$tgl_awal." s/d ".$tgl_akhir;

			?>

			<div class="row" >
				<h3><?php echo $judul;?></h3>
				<br>
				<?php echo $judul2;?>
				<br>
				<?php echo $judul3;?>
				<br>
				By : <?php echo $namauser;?>
			</div>

			<table border="1" cellspacing="1"  >

				<thead>
					<tr>
						<th style="width:20px;padding-bottom:1px;">No</th>
						<th style="width:60px;padding-bottom:1px;">Kota</th>
						<th style="width:160px;padding-bottom:1px;">Outlet</th>
						<th style="padding-bottom:1px;">Alat Bayar</th>
						<th style="padding-bottom:1px;">Kode Sub Alat bayar</th>
						<th style="padding-bottom:1px;">Aplikasi</th>
						<th style="padding-bottom:1px;">Penjualan<br>+ PB1</th>
						<th style="padding-bottom:1px;">Penjualan</th>
						<th style="width:90px ;padding-bottom:1px;">Acuan<br>Fee</th>
						<th style="padding-bottom:1px;">Tarif<br>Fee (%)</th>
						<th style="padding-bottom:1px;">Nilai<br>Fee (Rp.)</th>
					</tr>
				</thead>
				<tbody>
					<?php

					$query="SELECT penjualan.faktur,penjualan.tanggal,penjualan.subjumlah,penjualan.jumlah,penjualan.byr_tunai,penjualan.byr_non_tunai,penjualan.tarif_fee,penjualan.dasar_fee,penjualan.acuan_fee, 
					pelanggan.nama as pelanggan_nama ,
					subalat_bayar.nama as subalatbayar_nama,
					kotabaru.nama as kotabaru_nama, 
					alat_bayar.nama as alatbayar_nama,
					jenis_transaksi.nama as jt_nama,
					sum(penjualan.jumlah) as rekap_jumlah , 
					sum(penjualan.subjumlah) as rekap_subjumlah,
					sum(penjualan.dasar_fee) as rekap_dasar_fee
					FROM penjualan
					Join pelanggan ON pelanggan.kd_cus=penjualan.kd_cus
					Join kotabaru ON kotabaru.kode=pelanggan.kd_kota
					Join area ON area.kode=kotabaru.kd_area
					Join alat_bayar ON alat_bayar.kd_alat=penjualan.kd_alatbayar
					Join subalat_bayar ON subalat_bayar.kdsub_alat=penjualan.kdsub_alatbayar
					Join jenis_transaksi ON jenis_transaksi.kd_jenis=penjualan.kd_aplikasi
					WHERE tanggal>='$tgl_awal' AND tanggal <= '$tgl_akhir' +interval 1 day AND 
					penjualan.no_online=1  $kondisi 
					Group by pelanggan.kd_kota , penjualan.kdsub_alatbayar ,penjualan.kd_aplikasi
					";


					$sql1=mysqli_query($koneksi,$query);
					$no=1;
					$tot_rekap_dasar_fee=0;

					while($s1=mysqli_fetch_array($sql1))
					{
						if ($s1['alatbayar_nama']!='TUNAI'){

							$rekap_dasar_fee=$s1['rekap_dasar_fee'];
							$tot_rekap_dasar_fee=$tot_rekap_dasar_fee+round($rekap_dasar_fee,2);
							?>
							<tr align="left">
								<td><?php echo $no; ?></td>
								<td><?php echo $s1['kotabaru_nama']; ?></td>
								<td><?php echo $s1['pelanggan_nama']; ?></td>
								<td><?php echo $s1['alatbayar_nama']; ?></td>
								<td><?php echo $s1['subalatbayar_nama']; ?></td>
								<td><?php echo $s1['jt_nama']; ?></td>
								<td align="right"><?php echo number_format($s1['rekap_jumlah']); ?></td>
								<td align="right"><?php echo number_format($s1['rekap_subjumlah']); ?></td>
								<td align="right"><?php echo $s1['acuan_fee']; ?></td>
								<td align="right"><?php echo number_format($s1['tarif_fee'],2); ?></td>
								<td align="right"><?php echo number_format($s1['rekap_dasar_fee']); ?></td>

							</tr>
							<?php
							$no++;

						}
					}
					?>
				</tbody>
				
			</table>
			<table border="1">
				<thead>
					<tr>
						<td colspan="9" align="right">TOTAL Fee Penjualan</td>
						<td style="text-align: right;"><?php echo number_format($tot_rekap_dasar_fee);?></td>
					</tr>
				</thead>
			</table>
			<br>
			<!-- </div> -->
			<?php include '../footer_lap.php' ;?>
