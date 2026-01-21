<?php

include "../../../../config/koneksi.php";
include "../../../../config/fungsi_rupiah.php";

$judulform="Tabel Penjualan Detil";

$data='test_penjualan';
$rute='rekap';
$aksi='aksi_rekap_penjualan';

$tabel="daily_jualdetil";
$f1='jadi';
$f2='faktur';
$f3='tanggal';
$f4='kd_cus';
$f5='kd_aplikasi';
$f6='kd_promo';
$f7='kd_brg';
$f8='banyak';
$f9='harga';
$f10='diskon';
$f11='jumlah';
$f12='faktur_refund';
$f13='penyajian';
$f14='harga_dasar';


$j1='jadi';
$j2='faktur';
$j3='tanggal';
$j4='kd_cus';
$j5='kd_aplikasi';
$j6='kd_promo';
$j7='kd_brg';
$j8='banyak';
$j9='harga';
$j10='diskon';
$j11='jumlah';
$j12='faktur_refund';
$j13='penyajian';
$j14='harga_dasar';

$tabel2='kotabaru';
$ff1='kode';
$tabel3='pelanggan';
$gg1='kd_cus';

$tgl_awal=$_GET['tgl_awal'];
$tgl_akhir=$_GET['tgl_akhir'];
$filter=$_GET['filter'];
$nilai=$_GET['nilai'];

$tujuan=$_GET['tujuan'];
$tgl_akhir=$tgl_awal;

        // echo "<br/>".$tgl_awal;
        // echo "<br/>".$tgl_akhir;
        // echo "<br/>".$filter;
        // echo "<br/>".$nilai;
				// echo $tujuan;

if ($tujuan=='aplikasi') {
	$kondisi2='Aplikasi';
	$kondisi_group=' ,daily_penjualan.kd_aplikasi';
}elseif($tujuan=='carabayar'){
	$kondisi2='Alat Bayar';
	$kondisi_group=' ,daily_penjualan.kd_alatbayar';
}elseif($tujuan=='kasir'){
	$kondisi2='Kasir';
	$kondisi_group=' ,daily_penjualan.oleh';
}else{
	$kondisi2='';
	$kondisi_group='';

}

if($filter=='kota'){
      $kondisi="AND pelanggan.kd_kota='$nilai' ";
      $kondisi_order=" ORDER BY pelanggan.kd_kota ,  tanggal desc";
      $query=mysqli_query($koneksi,"SELECT * FROM kotabaru WHERE kode='$nilai' ");
      $q1=mysqli_fetch_array($query);
      $judul_nilai= $q1['nama'];
    }elseif($filter=='outlet'){
      $kondisi="AND daily_jualdetil.kd_cus='$nilai' ";
      $kondisi_order=" ORDER BY daily_jualdetil.kd_cus, tanggal desc";
      $query=mysqli_query($koneksi,"SELECT * FROM pelanggan WHERE kd_cus='$nilai' ");
      $q1=mysqli_fetch_array($query);
      $judul_nilai= $q1['nama'];
    }elseif($filter=='area'){
      $kondisi="AND kotabaru.kd_area='$nilai' ";
      $kondisi_order="ORDER BY kotabaru.kd_area , tanggal desc";
      $query=mysqli_query($koneksi,"SELECT * FROM area WHERE kode='$nilai' ");
      $q1=mysqli_fetch_array($query);
      $judul_nilai= $q1['nama'];
    }else{
      $kondisi='';
      $kondisi_order="ORDER BY tanggal desc";
      $judul_nilai='';
    }

$judul=$judulform.$kondisi2;
$judul2=$filter." : ".$judul_nilai;
$judul3='Periode : '.$tgl_awal." s/d ".$tgl_akhir;

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
			<?php echo $judul3;?></h4></center> 
		</div><!-- /.container-fluid -->
	</section>

	<table id="example"  class="table table-bordered table-striped table-responsive">

		<thead style="background-color:  lightgray;" class="elevation-2">
			
			<tr>

				<th style="">No</th>
				<th style="padding-right: 140px!important"><?php echo $f1;?></th>
				<th style="padding-right: 100px!important"><?php echo $f2;?></th>
				<th style="padding-right: 80px!important"><?php echo $f3;?></th>
				<th style=""><?php echo $f4;?></th>
				<th style=""><?php echo $f5;?></th>
				<th style=""><?php echo $f6;?></th>
				<th style="padding-right: 60px!important"><?php echo $f7;?></th>
				<th style=""><?php echo $f8;?></th>
				<th style=""><?php echo $f9;?></th>
				<th style=""><?php echo $f10;?></th>
				<th style=""><?php echo $f11;?></th>
				<th style=""><?php echo $f12;?></th>
				<th style=""><?php echo $f13;?></th>
				<th style=""><?php echo $f14;?></th>
			</tr>
		</thead>
		<tbody>
			<?php

			$query="SELECT * 
			FROM daily_jualdetil 
			JOIN pelanggan ON pelanggan.kd_cus=daily_jualdetil.kd_cus
			JOIN kotabaru ON kotabaru.kode=pelanggan.kd_kota
			WHERE tanggal>='$tgl_awal' AND tanggal <= '$tgl_akhir' +interval 1 day 
			$kondisi 
			 ";


			$sql1=mysqli_query($koneksi,$query);
			$no=1;

			while($s1=mysqli_fetch_array($sql1))
			{
				?>
				<tr align="left">
					<td><?php echo $no; ?></td>
					<td style="width:200px"><?php echo $s1[$f1]; ?></td>
					<td><?php echo $s1[$f2]; ?></td>
					<td><?php echo $s1[$f3]; ?></td>
					<td><?php echo $s1[$f4]; ?></td>
					<td><?php echo $s1[$f5]; ?></td>
					<td><?php echo $s1[$f6]; ?></td>
					<td style="text-align:right;"><?php echo $s1[$f7]; ?></td>
					<td style="text-align:right;"><?php echo number_format($s1[$f8]); ?></td>
					<td style="text-align:right;"><?php echo number_format($s1[$f9]); ?></td>
					<td style="text-align:right;"><?php echo number_format($s1[$f10]); ?></td>
					<td style="text-align:right;"><?php echo number_format($s1[$f11]); ?></td>
					<td><?php echo $s1[$f12]; ?></td>
					<td><?php echo $s1[$f13]; ?></td>
					<td style="text-align:right;"><?php echo number_format($s1[$f14]); ?></td>

				</tr>
				<?php
				$no++;
				
			}
			?>
		</tbody>

	</table>
	<hr>
	

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

	<?php include '../footer_lap.php'; ?>
	