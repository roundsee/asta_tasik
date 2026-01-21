<?php
session_start();

include "../../../../config/koneksi.php";
include "../../../../config/fungsi_rupiah.php";

$judulform="Daftar Harga";

$data='lap_daftar_harga';
$rute='daftar_harga_model2';
$aksi='aksi_daftar_harga';

$tabel="barang_kota";
$f1='jadi';
$f2='kd_brg';
$f3='kd_kota';
$f4='harga';
$f5='kd_aplikasi';
$f6='harga_dine_in';
$f7='harga_cafe';
$f8='harga_spot';

$j1='Kode Jadi';
$j2='Kode Barang';
$j3='Kode Kota';
$j4='Harga';
$j5='Kode Aplikasi';
$j6='Harga Dine In';
$j7='Harga The Cofee';
$j8='Harga Spot';


$kota=$_GET['kota'];
$kd_aplikasi=$_GET['kd_aplikasi'];

// echo "<br/>".$kota;
// echo "<br/>".$kd_aplikasi;

if($kota!=''){
	$kondisi=" WHERE bk.kd_kota='$kota' ";
	$query=mysqli_query($koneksi,"SELECT nama FROM kotabaru WHERE kode='$kota' ");
	$q1=mysqli_fetch_array($query);
	$judul_nilai= $q1['nama'];

	if($kd_aplikasi!=''){
		$kondisi2=" AND bk.kd_aplikasi='$kd_aplikasi' ";
		$query=mysqli_query($koneksi,"SELECT nama FROM jenis_transaksi WHERE kd_jenis='$kd_aplikasi' ");
		$q1=mysqli_fetch_array($query);
		$judul_nilai2= $q1['nama'];
	}else{
		$kondisi2='';
		$judul_nilai2='Semua';
	}
}elseif($kd_aplikasi!=''){
	$kondisi='';
	$judul_nilai='Semua';
	$kondisi2=" WHERE bk.kd_aplikasi='$kd_aplikasi' ";
	$query=mysqli_query($koneksi,"SELECT nama FROM jenis_transaksi WHERE kd_jenis='$kd_aplikasi' ");
	$q1=mysqli_fetch_array($query);
	$judul_nilai2= $q1['nama'];
}else{
	$kondisi='';
	$kondisi2='';
	$judul_nilai='Semua';
	$judul_nilai2='Semua';
}

$judul='Laporan Daftar Harga';
$judul2='Kota : '. $judul_nilai ;
$judul3='Aplikasi : '. $judul_nilai2;

include '../header_lap_1.php';
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
				<h5><?php echo $judul3;?></h5>
			</h4></center> 
		</div><!-- /.container-fluid -->
	</section>
	<table id="example" class="table table-bordered table-striped">
		<thead style="background-color:  lightgray;" class="elevation-2">
			<tr>
				<th>No.</th>
				<th style="width:120px">No. jadi</th>
				<th>Kode Aplikasi</th>
				<th style="width:80px">Kode</th>
				<th style="width:120px">Nama Barang</th>
				<th>Harga</th>
				<th>The Coffee</th>
				<th>Spot</th>
				<th>Express</th>
				<th style="width:150px;text-align:center;">Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php

			$query="SELECT bk.jadi,bk.kd_brg, b.nama,
			jt.nama as jt_nama ,
			bk.harga as bk_harga ,
			bk.harga_cafe as bk_harga_cafe ,
			bk.harga_spot as bk_harga_spot ,
			bk.harga_express as bk_harga_express 
			FROM `barang_kota` bk 
			join jenis_transaksi jt on jt.kd_jenis=bk.kd_aplikasi 
			join kotabaru kb on kb.kode=bk.kd_kota 
			join barang b on b.kd_brg=bk.kd_brg $kondisi $kondisi2 ";

			$sql1=mysqli_query($koneksi,$query);
			$no=1;

			while($s1=mysqli_fetch_array($sql1))
			{
				?>
				<tr align="left">
					<td><?php echo $no; ?></td>
					<td><?php echo $s1['jadi']; ?></td>
					<td><?php echo $s1['jt_nama']; ?></td>
					<td><?php echo $s1['kd_brg']; ?></td>
					<td><?php echo $s1['nama']; ?></td>
					<td style="text-align: right;"><?php echo number_format($s1['bk_harga']);?></td>
					<td style="text-align: right;"><?php echo number_format($s1['bk_harga_cafe']);?></td>
					<td style="text-align: right;"><?php echo number_format($s1['bk_harga_spot']);?></td>
					<td style="text-align: right;"><?php echo number_format($s1['bk_harga_express']);?></td>
					<td>
						<a href="../../main.php?route=<?php echo $rute;?>&act=edit&id=<?php echo $s1[$f1]; ?>&kota=<?php echo $kota;?> &kd_aplikasi=<?php echo $kd_aplikasi;?>" title="Edit"> <button class="btn btn-primary btn-sm elevation-2" style="opacity: .7;width:80px"><i class="fa fa-edit"></i> Edit</button></a>
						<a href="<?php echo $aksi;?>.php?route=<?php echo $rute;?>&act=hapus&id=<?php echo $s1[$f1]; ?>&kota=<?php echo $kota;?> &kd_aplikasi=<?php echo $kd_aplikasi;?>" title="Hapus" onclick="return confirm('Apakah anda yakin ingin menghapus ini ?')"> <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</button></a> 
					</td>
				</tr>
				<?php
				$no++;

			}
			?>
		</tbody>

	</table>
	<hr>
	<!-- </div> -->

	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>

	<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>

	<!-- <script> 
		$(document).ready(function() {
			$('#example').DataTable( {
				dom: 'Bfrtip',
				buttons: [
				'copy', 'csv', 'excel', 'pdf', 'print'
				]
			} );
		} );
	</script> -->

	<?php include '../footer_lap_1.php'; ?>
	