<?php 

include '../../../../config/koneksi.php';
include '../../../../config/fungsi_rupiah.php';
include '../../../../config/library.php';

session_start();

$login_hash=$_SESSION['login_hash'];
$en=$_SESSION['employee_number'];
$namauser=$_SESSION['namauser'];

$tujuan=$_GET['tujuan'];

$judulform="Beban Fee Penjualan ";

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


			$judul='Laporan '.$judulform;
			$judul2=$filter." : ".$judul_nilai;
			$judul3='Date : '.$tgl_awal." s/d ".$tgl_akhir;


			?>

			<div class="row" >
				<center><strong><?php echo $judul;?></strong></center>
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
						<th style="width:15px;padding-bottom:1px;">No</th>
						<th style="width:100px;padding-bottom:1px;">Keterangan</th>
						<th style="padding-bottom:1px;">Alat Bayar</th>
						<th style="padding-bottom:1px;">Kode Sub Alat bayar</th>
						<th style="width:130px;padding-bottom:1px;">No Faktur</th>
						<th style="width:70px;padding-bottom:1px;">Tgl Faktur</th>
						<th style="padding-bottom:1px;">Penjualan<br>+ PB1</th>
						<th style="padding-bottom:1px;">Penjualan</th>
						<th style="width:60px ;padding-bottom:1px;">Acuan<br>Fee</th>
						<th style="padding-bottom:1px;">Tarif<br>Fee (%)</th>
						<th style="padding-bottom:1px;">Nilai<br>Fee (Rp.)</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$query="SELECT penjualan.faktur,penjualan.tanggal,penjualan.subjumlah,penjualan.jumlah,penjualan.byr_tunai,penjualan.byr_non_tunai,penjualan.tarif_fee,penjualan.dasar_fee,penjualan.acuan_fee, 
					pelanggan.nama as pelanggan_nama ,
					subalat_bayar.nama as subalatbayar_nama ,
					subalat_bayar.tarif_fee as sb_tarif_fee,
					subalat_bayar.acuan_fee as sb_acuan_fee,
					kotabaru.nama as kotabaru_nama, 
					alat_bayar.nama as alatbayar_nama,
					jenis_transaksi.nama as jt_nama
					FROM penjualan
					Join pelanggan ON pelanggan.kd_cus=penjualan.kd_cus
					Join kotabaru ON kotabaru.kode=pelanggan.kd_kota
					Join area ON area.kode=kotabaru.kd_area
					Join alat_bayar ON alat_bayar.kd_alat=penjualan.kd_alatbayar
					Join subalat_bayar ON subalat_bayar.kdsub_alat=penjualan.kdsub_alatbayar
					Join jenis_transaksi ON jenis_transaksi.kd_jenis=penjualan.kd_aplikasi
					WHERE tanggal>='$tgl_awal' AND tanggal <= '$tgl_akhir' +interval 1 day AND penjualan.no_online=1 $kondisi $kondisi_order";


					$sql1=mysqli_query($koneksi,$query);
					$no=1;

					$tot_subjumlah=0;
					$tot_ppn=0;
					$tot_jumlah=0;
					$tot_fee=0;
					$tot_dasar_fee=0;
                           // print_r(mysqli_fetch_array($sql1));


					while($s1=mysqli_fetch_array($sql1))
					{
						if ($s1['alatbayar_nama']!='TUNAI'){
                            // mencari dasar_fee
							$jumlah=$s1['jumlah'];
							$subjumlah=$s1['subjumlah'];
							$dasar_fee=$s1['dasar_fee'];
							$acuan_fee=$s1['sb_acuan_fee'];
							$tarif_fee=$s1['sb_tarif_fee'];

							$tot_dasar_fee=$tot_dasar_fee+round($dasar_fee);

							?>
							<tr align="left">
								<td><?php echo $no; ?></td>
								<?php
								if ($filter!='kota') {
									?>
									<td><?php echo $s1['kotabaru_nama']; ?></td>
									<?php 
								}elseif ($filter!='outlet') {
									?>
									<td><?php echo $s1['pelanggan_nama']; ?></td>
									<?php
								}elseif($filter!='area'){
									?>

									<?php
								}
								?>
								<td><?php echo $s1['alatbayar_nama']; ?></td>
								<td><?php echo $s1['subalatbayar_nama']; ?></td>
								<td><?php echo $s1['faktur']; ?></td>
								<td><?php echo $s1['tanggal']; ?></td>
								<td align="right"><?php echo number_format($s1['jumlah'],); ?></td>
								<td align="right"><?php echo number_format($subjumlah); ?></td>
								<td align="right"><?php echo $acuan_fee; ?></td>
								<td align="right"><?php echo number_format($tarif_fee,2); ?></td>
								<td align="right"><?php echo number_format($dasar_fee); ?></td>

							</tr>
							<?php
							$no++;

						}
					}
					?>
				</tbody>
			</table>
			<div>
				SUMMARY REPORT
			</div>

			<table border="1">
				<thead style="background-color:  lightgray;" class="elevation-2">
					<th>Uraian</th>
					<th style="text-align:right;">Nilai Fee</th>
				</thead>
				<tbody>

					<?php
					$query="SELECT 
					pelanggan.nama as pelanggan_nama ,
					subalat_bayar.nama as subalatbayar_nama ,
					subalat_bayar.tarif_fee as sb_tarif_fee,
					subalat_bayar.acuan_fee as sb_acuan_fee,
					kotabaru.nama as kotabaru_nama, 
					alat_bayar.nama as alatbayar_nama,
					jenis_transaksi.nama as jt_nama,
					sum(penjualan.dasar_fee) as tot_dasar_fee
					FROM penjualan
					Join pelanggan ON pelanggan.kd_cus=penjualan.kd_cus
					Join kotabaru ON kotabaru.kode=pelanggan.kd_kota
					Join area ON area.kode=kotabaru.kd_area
					Join alat_bayar ON alat_bayar.kd_alat=penjualan.kd_alatbayar
					Join subalat_bayar ON subalat_bayar.kdsub_alat=penjualan.kdsub_alatbayar
					Join jenis_transaksi ON jenis_transaksi.kd_jenis=penjualan.kd_aplikasi
					WHERE tanggal>='$tgl_awal' AND tanggal <= '$tgl_akhir' +interval 1 day AND penjualan.no_online=1 $kondisi
					GROUP BY penjualan.kd_aplikasi
					$kondisi_order";

					$sql1=mysqli_query($koneksi,$query);
					$no=1;
					$grand_fee=0;


					while($s1=mysqli_fetch_array($sql1))
					{
                            // if ($s1['alatbayar_nama']!='TUNAI'){
						?>
						<tr align="left">
							<td><?php echo $s1['jt_nama']; ?></td>
							<td align="right"><?php echo format_rupiah($s1['tot_dasar_fee']); ?></td>
						</tr>
						<?php
						$no++;
						$grand_fee=$grand_fee+$s1['tot_dasar_fee'];

                          // }
					}
					?>
				</tbody>
				<tfoot style="background-color: darkgrey; color: black;font-weight: 600;">
					<td>Total</td>
					<td align="right"><?php echo number_format($grand_fee); ?></td>
				</tfoot>

			</table>
			<br>

			<!-- </div> -->
			<?php include '../footer_lap.php' ;?>
