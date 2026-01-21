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
$rute='rekap_penjualan_menu_outlet';
$aksi='aksi_rekap_penjualan_menu_outlet';

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
	<title><?php echo $judul;?></title>
	<style type="text/css">
		table {
			border-collapse: collapse;
			font-family:Arial, Helvetica, sans-serif;
			font-size:14px;
		}

		td {
			font-size:14px;
		}

		table, td, th {
			border: 1px solid lightgray;
			padding: 1px;
		}

		th{
			padding-top: 10px;
			padding-bottom: 10px;
			border: 1px solid gray;
		}
	</style>

</head>
<!-- <body style='font-family:tahoma; font-size:9pt;' onload="javascript:window.print()"> -->

	<body style='font-family:Arial;' onload="javascript:window.print()" >
		<?php

		$tgl_awal=$_GET['tgl_awal'];
		$tgl_akhir=$_GET['tgl_akhir'];
		$filter=$_GET['filter'];
		$nilai=$_GET['nilai'];

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
		<table id="example" border="1" class="table table-bordered table-striped">
			<thead style="background-color:  lightgray;" class="elevation-2">
				<tr>

					<th style="text-align:center;font-weight: 800;width: 30px;">No.</th>
					<th style="font-weight: 800;">Kode</th>
					<th style="font-weight: 800;">Outlet</th>

					<?php if($filter!='kota' AND $filter!='outlet' AND $filter!='area' AND $filter!='semua'){ ?>
						<th style="font-weight: 800;">Kode</th>
						<th style="font-weight: 800;">Kota</th>
					<?php } ?>

					<th style="width:100px;">Kode</th>
					<th style="">Nama</th>
					<th width="20px" style="text-align: right;">Banyak</th>
					<th width="20px" style="text-align: right;">Jumlah</th>

				</tr>
			</thead>
			<tbody>
				<?php

				if($filter=='outlet'){

					$query="SELECT penjualan.tarif_pb1,penjualan.kd_cus, 
					pelanggan.nama as p_nama,
					kotabaru.nama as kb_nama ,
					jenis_transaksi.nama as jt_nama,
					alat_bayar.nama as ab_nama,
					penjualan.kd_aplikasi as ka_kode, 
					jualdetil.kd_brg as jd_kd_brg,
					barang.nama as brg_nama, 
					jualdetil.banyak as jualdetil_banyak,
					jualdetil.jumlah as jualdetil_jumlah,
					sum(jualdetil.banyak) as rekap_jualdetil_banyak,
					sum(jualdetil.jumlah) as rekap_jualdetil_jumlah
					FROM penjualan 
					join pelanggan on pelanggan.kd_cus=penjualan.kd_cus 
					join kotabaru on kotabaru.kode=pelanggan.kd_kota 
					join jenis_transaksi on jenis_transaksi.kd_jenis=penjualan.kd_aplikasi 
					join alat_bayar on alat_bayar.kd_alat=penjualan.kd_alatbayar 
					join jualdetil on jualdetil.faktur=penjualan.faktur 
					join barang on barang.kd_brg=jualdetil.kd_brg
					WHERE penjualan.tanggal>='$tgl_awal' AND penjualan.tanggal <= '$tgl_akhir' +interval 1 day AND pelanggan.kd_cus='$nilai'
					GROUP by pelanggan.kd_cus,jualdetil.kd_brg
					order by pelanggan.kd_cus,jualdetil.kd_brg
					";
				}elseif($filter=='kota'){
					$query="SELECT penjualan.tarif_pb1,penjualan.kd_cus,  
					pelanggan.nama as p_nama,
					kotabaru.nama as kb_nama ,
					penjualan.kd_aplikasi as ka_kode, 
					jualdetil.kd_brg as jd_kd_brg,
					barang.nama as brg_nama, 
					jualdetil.banyak as jualdetil_banyak,
					jualdetil.jumlah as jualdetil_jumlah,
					sum(jualdetil.banyak) as rekap_jualdetil_banyak,
					sum(jualdetil.jumlah) as rekap_jualdetil_jumlah
					FROM penjualan 
					join pelanggan on pelanggan.kd_cus=penjualan.kd_cus 
					join kotabaru on kotabaru.kode=pelanggan.kd_kota 
					join jualdetil on jualdetil.faktur=penjualan.faktur 
					join barang on barang.kd_brg=jualdetil.kd_brg
					WHERE penjualan.tanggal>='$tgl_awal' AND penjualan.tanggal <= '$tgl_akhir' +interval 1 day AND pelanggan.kd_kota='$nilai'
					GROUP by pelanggan.kd_cus,jualdetil.kd_brg
					order by pelanggan.kd_cus,jualdetil.kd_brg
					";

				}elseif($filter=='area'){
					$query="SELECT penjualan.tarif_pb1,penjualan.kd_cus,
					pelanggan.nama as p_nama,
					kotabaru.nama as kb_nama ,
					penjualan.kd_aplikasi as ka_kode, 
					jualdetil.kd_brg as jd_kd_brg,
					barang.nama as brg_nama, 
					jualdetil.banyak as jualdetil_banyak,
					jualdetil.jumlah as jualdetil_jumlah,
					sum(jualdetil.banyak) as rekap_jualdetil_banyak,
					sum(jualdetil.jumlah) as rekap_jualdetil_jumlah
					FROM penjualan 
					join pelanggan on pelanggan.kd_cus=penjualan.kd_cus 
					join kotabaru on kotabaru.kode=pelanggan.kd_kota 
					join jualdetil on jualdetil.faktur=penjualan.faktur 
					join barang on barang.kd_brg=jualdetil.kd_brg
					WHERE penjualan.tanggal>='$tgl_awal' AND penjualan.tanggal <= '$tgl_akhir' +interval 1 day AND kotabaru.kd_area='$nilai'
					GROUP by pelanggan.kd_cus,jualdetil.kd_brg
					order by pelanggan.kd_cus,jualdetil.kd_brg
					";
				}else{
					$query="SELECT penjualan.tarif_pb1,penjualan.kd_cus,
					pelanggan.nama as p_nama,
					kotabaru.nama as kb_nama ,
					penjualan.kd_aplikasi as ka_kode, 
					jualdetil.kd_brg as jd_kd_brg,
					barang.nama as brg_nama, 
					jualdetil.banyak as jualdetil_banyak,
					jualdetil.jumlah as jualdetil_jumlah,
					sum(jualdetil.banyak) as rekap_jualdetil_banyak,
					sum(jualdetil.jumlah) as rekap_jualdetil_jumlah
					FROM penjualan 
					join pelanggan on pelanggan.kd_cus=penjualan.kd_cus 
					join kotabaru on kotabaru.kode=pelanggan.kd_kota 
					join jualdetil on jualdetil.faktur=penjualan.faktur 
					join barang on barang.kd_brg=jualdetil.kd_brg
					WHERE penjualan.tanggal>='$tgl_awal' AND penjualan.tanggal <= '$tgl_akhir' +interval 1 day 
					GROUP by pelanggan.kd_cus,jualdetil.kd_brg
					order by pelanggan.kd_cus,jualdetil.kd_brg
					";
				}


				$sql1=mysqli_query($koneksi,$query);
				$no=1;

				$tot_subjumlah=0;
				$tot_ppn=0;
				$tot_jumlah=0;

				$tot_penjualan=0;
				$tot_byr_tunai=0;
				$tot_byr_non_tunai=0;
				$tot_pocer=0;

				$tot_11=0;
				$tot_22=0;
				$tot_33=0;
				$tot_44=0;

				$tot_ofline=0;
				$tot_online=0;

				$tot_jualdetil_banyak=0;


				while($s1=mysqli_fetch_array($sql1))
				{
					$total_stlh_pajak=$s1['rekap_jualdetil_jumlah']+($s1['rekap_jualdetil_jumlah']*($s1['tarif_pb1']/100));

					$tot_jualdetil_banyak=$tot_jualdetil_banyak+$s1['jualdetil_banyak'];
					?>
					<tr align="left">
						<td><?php echo $no; ?></td>
						<td><?php echo $s1['kd_cus']; ?></td>
						<td style="width:160px;"><?php echo $s1['p_nama']; ?></td>

						<?php if ($filter!='kota' AND $filter!='outlet' AND $filter!='area' AND $filter!='semua'){ ?>
							<td><?php echo $s1['kd_kota']; ?></td>
							<td><?php echo $s1['kb_nama']; ?></td>
						<?php } ?>


						<td style="width:100px;text-align: center;"><?php echo $s1['jd_kd_brg']; ?></td>
						<td><?php echo $s1['brg_nama']; ?></td>
						<td style="text-align: right;"><?php echo number_format($s1['rekap_jualdetil_banyak']);?></td>
						<td style="text-align: right;"><?php echo number_format($total_stlh_pajak);?></td>

					</tr>
					<?php
					$no++;

				}
				?>
			</tbody>

		</table>
		<br>
		
		<!-- Main Footer -->
		<footer class="main-footer bg_primary_1"  style="padding:.3rem;font-size:.75rem">

			<!-- Default to the left -->
			<strong>Copyright &copy; 2020-<?php echo $thn_sekarang." ".$perusahaan;?>.</strong>  by Develop. All rights Reserved.
			<div class="float-right d-none d-sm-inline">
        <b>Version</b> <?php echo $ver;?>
    </div>
		</footer>

	</body>
	</html>
