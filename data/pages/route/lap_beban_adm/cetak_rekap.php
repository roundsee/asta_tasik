<?php 

include '../../../../config/koneksi.php';
include '../../../../config/fungsi_rupiah.php';
include '../../../../config/library.php';

session_start();

$login_hash=$_SESSION['login_hash'];
$en=$_SESSION['employee_number'];
$namauser=$_SESSION['namauser'];

$tujuan=$_GET['tujuan'];

$judulform="Beban Adm Bank";

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
						<th style="padding-bottom:1px;">Penjualan + PB1</th>
						<th style="padding-bottom:1px;">Byr Non Tunai</th>
						<th style="padding-bottom:1px;">Nilai Adm</th>
					</tr>
				</thead>
				<tbody>
					<?php

					$query="SELECT penjualan.faktur,penjualan.tanggal,penjualan.jumlah,penjualan.byr_tunai,penjualan.byr_non_tunai,penjualan.tarif_fee, 
					pelanggan.nama as pelanggan_nama ,
					subalat_bayar.nama as subalatbayar_nama ,
					kotabaru.nama as kotabaru_nama, 
					alat_bayar.nama as alatbayar_nama,
					sum(penjualan.jumlah) as rekap_jumlah , 
					sum(penjualan.byr_non_tunai) as rekap_non_tunai
					FROM penjualan
					Join pelanggan ON pelanggan.kd_cus=penjualan.kd_cus
					Join kotabaru ON kotabaru.kode=pelanggan.kd_kota
					Join area ON area.kode=kotabaru.kd_area
					Join alat_bayar ON alat_bayar.kd_alat=penjualan.kd_alatbayar
					Join subalat_bayar ON subalat_bayar.kdsub_alat=penjualan.kdsub_alatbayar
					WHERE tanggal>='$tgl_awal' AND tanggal <= '$tgl_akhir' +interval 1 day AND 
                          penjualan.no_ofline=1  $kondisi
					Group by pelanggan.kd_kota , penjualan.kdsub_alatbayar
					";

					$sql1=mysqli_query($koneksi,$query);
					$no=1;
					$grand_beban_adm=0;

					while($s1=mysqli_fetch_array($sql1))
					{
						$rekap_beban_adm = $s1['rekap_non_tunai'] * ($s1['tarif_fee']/100); 
						$grand_beban_adm=$grand_beban_adm+$rekap_beban_adm;
						?>
						<tr align="left">
							<td><?php echo $no; ?></td>
							<td><?php echo $s1['kotabaru_nama']; ?></td>
							<td><?php echo $s1['pelanggan_nama']; ?></td>
							<td><?php echo $s1['alatbayar_nama']; ?></td>
							<td><?php echo $s1['subalatbayar_nama']; ?></td>
							<td align="right"><?php echo number_format($s1['rekap_jumlah']); ?></td>
							<td align="right"><?php echo number_format($s1['rekap_non_tunai']); ?></td>
							<td align="right"><?php echo number_format($rekap_beban_adm); ?></td>
							<?php
							if ($tujuan=='aplikasi') {
								?>
								<td style="text-align: center;"><?php echo $s1['ka_kode']; ?></td>
								<td><?php echo $s1['jt_nama']; ?></td>
								<td style="text-align: right;"><?php echo number_format($s1['jumlah']);?></td>
								<td style="text-align: right;"><?php echo number_format($s1['byr_tunai']);?></td>
								<td style="text-align: right;"><?php echo number_format($s1['byr_non_tunai']);?></td>
								<td style="text-align: right;"><?php echo number_format($s1['byr_pocer']);?></td>
								<?php 
							}elseif ($tujuan=='kasir') {
								?>
								<td><?php echo $s1['oleh']; ?></td>
								<td style="text-align: right;"><?php echo number_format($s1['jumlah']);?></td>
								<td style="text-align: right;"><?php echo number_format($s1['byr_tunai']);?></td>
								<td style="text-align: right;"><?php echo number_format($s1['byr_non_tunai']);?></td>
								<td style="text-align: right;"><?php echo number_format($s1['byr_pocer']);?></td>
								<?php
							}elseif($tujuan=='carabayar'){
								?>
								<td style="text-align: center;"><?php echo $s1['kd_alatbayar']; ?></td>
								<td><?php echo $s1['ab_nama']; ?></td>
								<td style="text-align: right;"><?php echo number_format($s1['byr_non_tunai']);?></td>
								<?php
							}
							?>

						</tr>
						<?php
						$no++;

					}
					?>
				</tbody>
				<tfoot>
					<td colspan="7" align="right">TOTAL</td>
					<td style="text-align: right;"><?php echo number_format($grand_beban_adm);?></td>

				</tfoot>
			</table>
			

			<div class="row">
				<footer class="main-footer "  style="padding:.3rem;">
					<!-- To the right -->
					<div class="float-right d-none d-sm-inline">
						<b>Version</b> <?php echo $ver;?>
					</div>
					<!-- Default to the left -->
					<strong>Copyright &copy; 2020-<?php echo $thn_sekarang." ".$perusahaan;?>.</strong>  by Develop. All rights Reserved.
				</footer>
			</div>

		</body>
		</html>
