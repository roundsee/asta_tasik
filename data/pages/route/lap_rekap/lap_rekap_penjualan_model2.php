<?php

include "../../../../config/koneksi.php";
include "../../../../config/fungsi_rupiah.php";

$judulform="Rekap Penjualan ";

$data='lap_rekap';
$rute='rekap';
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

$tgl_awal=$_GET['tgl_awal'];
$tgl_akhir=$_GET['tgl_akhir'];
$filter=$_GET['filter'];
$nilai=$_GET['nilai'];

$tujuan=$_GET['tujuan'];

        // echo "<br/>".$tgl_awal;
        // echo "<br/>".$tgl_akhir;
        // echo "<br/>".$filter;
        // echo "<br/>".$nilai;
				// echo $tujuan;

if ($tujuan=='aplikasi') {
	$kondisi2='Aplikasi';
	$kondisi_group=' ,penjualan.kd_aplikasi';
}elseif($tujuan=='carabayar'){
	$kondisi2='Alat Bayar';
	$kondisi_group=' ,penjualan.kd_alatbayar';
}elseif($tujuan=='kasir'){
	$kondisi2='Kasir';
	$kondisi_group=' ,penjualan.oleh';
}else{
	$kondisi2='';

}

if($filter=='kota'){
	$kondisi="AND pelanggan.kd_kota='$nilai'";
	$query=mysqli_query($koneksi,"SELECT * FROM kotabaru WHERE kode='$nilai' ");
	$q1=mysqli_fetch_array($query);
	$judul_nilai= $q1['nama'];
}elseif($filter=='outlet'){
	$kondisi="AND penjualan.kd_cus='$nilai'";
	$query=mysqli_query($koneksi,"SELECT * FROM pelanggan WHERE kd_cus='$nilai' ");
	$q1=mysqli_fetch_array($query);
	$judul_nilai= $q1['nama'];
}elseif($filter=='area'){
	$kondisi="AND kotabaru.kd_area='$nilai'";
	$query=mysqli_query($koneksi,"SELECT * FROM area WHERE kode='$nilai' ");
	$q1=mysqli_fetch_array($query);
	$judul_nilai= $q1['nama'];
}else{
	$kondisi="";
	$judul_nilai='All';
}

$judul='Laporan '.$judulform.$kondisi2;
$judul2=$filter." : ".$judul_nilai;
$judul3='Periode : '.$tgl_awal." s/d ".$tgl_akhir;

include '../header_lap.php';
?>

<link rel="stylesheet"  href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet"  href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">
<!-- <div class="container"> -->

	<section class="content-header  wow fadeInDown" data-wow-duration=".3s" data-wow-delay=".3s" >
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="list-gds">
						<b><?php echo $judulform ;?></b> <small style="font-weight: 100;">report</small>
					</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="../../main.php?route=home">Beranda</a></li>
						<li class="breadcrumb-item active">Laporan</li>
						<li class="breadcrumb-item active"><?php echo $judulform ;?></li>
					</ol>
				</div>

			</div>

			<br><center><h4><?php echo $judul;?>
			<h5><?php echo $judul2;?></h5>
			<?php echo $judul3;?></h4></center> 
		</div><!-- /.container-fluid -->
	</section>

	<table id="example" class="table table-bordered table-striped">

		<thead style="background-color:  lightgray;" class="elevation-2">
			<tr>
				<th rowspan="2" style="text-align:center;vertical-align: middle;font-weight: 800;padding-top: 1px;width: 1%;">No.</th>
				<th colspan="2" style="text-align:center;font-weight: 800;padding-top: 1px">Outlet</th>
				<th colspan="2" style="text-align:center;font-weight: 800;padding-top: 1px">Kota</th>
				<?php
				if ($tujuan=='aplikasi') {
					?>
					<th colspan="2" style="text-align:center;font-weight: 800;padding-top: 1px">Aplikasi</th>
					<th rowspan="2" style="text-align:center;vertical-align: middle;font-weight: 800;padding-top: 1px">Penjualan</th>
					<?php 
				}elseif ($tujuan=='kasir') {
					?>
					<th rowspan="2" style="text-align:center;vertical-align: middle;font-weight: 800;padding-top: 1px">Kasir</th>
					<th rowspan="2" style="text-align:center;vertical-align: middle;font-weight: 800;padding-top: 1px">Penjualan</th>
					<?php
				}elseif($tujuan=='carabayar'){
					?>
					<th colspan="2" style="text-align:center;font-weight: 800;padding-top: 1px">Alat Bayar</th>
					<?php
				}
				?>

				<th colspan="3" style="text-align:center;font-weight: 800;padding-top: 1px">Pembayaran</th>
			</tr>

			<tr>
				<th style="width:1%;padding-bottom:1px;">Kode</th>
				<th style="padding-bottom:1px;">Nama</th>
				<th style="width:1%;padding-bottom:1px;">Kode</th>
				<th style="padding-bottom:1px;">Nama</th>

				<?php
				if ($tujuan=='aplikasi') {
					?>
					<th style="width:1%;padding-bottom:1px;">Kode</th>
					<th style="padding-bottom:1px;">Nama</th>
					<th style="padding-bottom:1px;">Tunai</th>
					<th style="padding-bottom:1px;">Non Tunai</th>
					<th style="padding-bottom:1px;">Voucher</th>
					<?php 
				}elseif ($tujuan=='kasir') {
					?>
					<th style="padding-bottom:1px;">Tunai</th>
					<th style="padding-bottom:1px;">Non Tunai</th>
					<th style="padding-bottom:1px;">Voucher</th>

					<?php
				}elseif($tujuan=='carabayar'){
					?>
					<th style="width:1%;padding-bottom:1px;">Kode</th>
					<th style="padding-bottom:1px;">Nama</th>
					<th style="padding-bottom:1px;text-align: right;">Tunai</th>
					<th style="padding-bottom:1px;text-align: right;">Non Tunai</th>
					<?php
				}
				?>

			</tr>
		</thead>
		<tbody>
			<?php

			$query="SELECT * , pelanggan.nama as p_nama,kotabaru.nama as kb_nama ,jenis_transaksi.nama as jt_nama,alat_bayar.nama as ab_nama,penjualan.kd_aplikasi as ka_kode,
			sum(penjualan.jumlah) as rekap_jumlah,
			sum(penjualan.byr_tunai) as rekap_tunai,
			sum(penjualan.byr_non_tunai) as rekap_non_tunai,
			sum(penjualan.byr_pocer) as rekap_pocer
			FROM penjualan 
			join pelanggan on pelanggan.kd_cus=penjualan.kd_cus
			join kotabaru on kotabaru.kode=pelanggan.kd_kota
			join jenis_transaksi on jenis_transaksi.kd_jenis=penjualan.kd_aplikasi
			join alat_bayar on alat_bayar.kd_alat=penjualan.kd_alatbayar
			WHERE tanggal>='$tgl_awal' AND tanggal <= '$tgl_akhir' +interval 1 day $kondisi
			GROUP By pelanggan.kd_kota $kondisi_group
			 ";

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


			while($s1=mysqli_fetch_array($sql1))
			{
				?>
				<tr align="left">
					<td><?php echo $no; ?></td>
					<td><?php echo $s1['kd_cus']; ?></td>
					<td><?php echo $s1['p_nama']; ?></td>
					<td><?php echo $s1['kd_kota']; ?></td>
					<td><?php echo $s1['kb_nama']; ?></td>

					<?php
					if ($tujuan=='aplikasi') {
						?>
						<td style="text-align: center;"><?php echo $s1['ka_kode']; ?></td>
						<td><?php echo $s1['jt_nama']; ?></td>
						<td style="text-align: right;"><?php echo number_format($s1['rekap_jumlah']);?></td>
						<td style="text-align: right;"><?php echo number_format($s1['rekap_tunai']);?></td>
						<td style="text-align: right;"><?php echo number_format($s1['rekap_non_tunai']);?></td>
						<td style="text-align: right;"><?php echo number_format($s1['rekap_pocer']);?></td>
						<?php 
					}elseif ($tujuan=='kasir') {
						?>
						<td><?php echo $s1['oleh']; ?></td>
						<td style="text-align: right;"><?php echo number_format($s1['rekap_jumlah']);?></td>
						<td style="text-align: right;"><?php echo number_format($s1['rekap_tunai']);?></td>
						<td style="text-align: right;"><?php echo number_format($s1['rekap_non_tunai']);?></td>
						<td style="text-align: right;"><?php echo number_format($s1['rekap_pocer']);?></td>
						<?php
					}elseif($tujuan=='carabayar'){
						?>
						<td style="text-align: center;"><?php echo $s1['kd_alatbayar']; ?></td>
						<td><?php echo $s1['ab_nama']; ?></td>
						<td style="text-align: right;"><?php echo number_format($s1['rekap_tunai']);?></td>
						<td style="text-align: right;"><?php echo number_format($s1['rekap_non_tunai']);?></td>
						<?php
					}
					?>

				</tr>
				<?php
				$no++;
				$tot_subjumlah=$tot_subjumlah+$s1[$f7];
				$tot_ppn=$tot_ppn+$s1[$f8];
				$tot_jumlah=$tot_jumlah+$s1[$f9];

				$tot_penjualan=$tot_penjualan + $s1['rekap_jumlah'];
				$tot_byr_tunai=$tot_byr_tunai + $s1['rekap_tunai'];
				$tot_byr_non_tunai=$tot_byr_non_tunai + $s1['rekap_non_tunai'];
				$tot_pocer=$tot_pocer + $s1['rekap_pocer'];


				if($s1['ka_kode']=='11'){
					$tot_11++;
				}
				if($s1['ka_kode']=='22'){
					$tot_22++;
				}
				if($s1['ka_kode']=='33'){
					$tot_33++;
				}
				if($s1['ka_kode']=='44'){
					$tot_44++;
				}

				$tot_online=$tot_22+$tot_33+$tot_44;
				$tot_ofline=$tot_11;

			}
			?>
		</tbody>

	</table>
	<hr>
	<div>
		SUMMARY REPORT
	</div>
	<table style="background-color:beige;font-weight:700">
		<tr>
			<td style="width:300px"> Total Penjualan</td>
			<td style="width:30px">:</td>
			<td style="text-align:right;"><?php echo number_format($tot_penjualan);?></td>
		</tr>
		<tr>
			<td> Total Pembayaran Tunai</td>
			<td>:</td>
			<td style="text-align:right;"><?php echo number_format($tot_byr_tunai);?></td>
		</tr>

		<tr>
			<td> Total Pembayaran non Tunai</td>
			<td>:</td>
			<td style="text-align:right;"><?php echo number_format($tot_byr_non_tunai);?></td>
		</tr>

		<tr>
			<td> Total Pembayaran Voucher</td>
			<td>:</td>
			<td style="text-align:right;"><?php echo number_format($tot_pocer);?></td>
		</tr>

	</table>
<!-- 
	<?php
	if ($tujuan=='aplikasi'){ ?>

	<div>
		SUMMARY REPORT by Aplikasi
	</div>
	<table style="background-color:beige;font-weight:700">
		<tr>
			<td style="width:250px"> Total Pembayaran Dine In</td>
			<td style="width:30px">:</td>
			<td style="text-align:right;"><?php echo number_format($tot_11);?></td>
		</tr>
		<tr>
			<td> Total Pembayaran ShopeeFood</td>
			<td>:</td>
			<td style="text-align:right;"><?php echo number_format($tot_22);?></td>
		</tr>

		<tr>
			<td> Total Pembayaran GrabFood</td>
			<td>:</td>
			<td style="text-align:right;"><?php echo number_format($tot_33);?></td>
		</tr>

		<tr>
			<td> Total Pembayaran GoFood</td>
			<td>:</td>
			<td style="text-align:right;"><?php echo number_format($tot_44);?></td>
		</tr>

	</table>
<?php  } ?> -->
	<!-- </div> -->

	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>

	<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>

	<script> 
		$(document).ready(function() {
			$('#example').DataTable( {
				dom: 'Bfrtip',
				buttons: [
					'copy', 'csv', 'excel', 'pdf', 'print'
					]
			} );
		} );
	</script>

	<?php include '../footer_lap.php'; ?>
	