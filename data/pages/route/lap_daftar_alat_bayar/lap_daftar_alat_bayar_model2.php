<?php

include "../../../../config/koneksi.php";
include "../../../../config/fungsi_rupiah.php";

$judulform="Daftar Alat Pembayaran";

$data='lap_daftar_alat_bayar';
$rute='daftar_alat_bayar';
$aksi='aksi_daftar_alat_bayar';

$tabel="subalat_bayar";
$f1='kdsub_alat';
$f2='kd_alat';
$f3='nama';

$j1='Kode Sub Alat Bayar';
$j2='Kode Alat Bayar';
$j3='Nama';


$kd_alat=$_GET['kd_alat'];

$query=mysqli_query($koneksi,"SELECT nama FROM alat_bayar where kd_alat='$kd_alat' ");
$q1=mysqli_fetch_array($query);

$nama_alat=$q1['nama'];

$judul='Laporan Daftar Alat Pembayaran';
$judul2=$nama_alat;
$judul3='';

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


			<br><center><h4><?php echo $judul ;?>
				<h5><?php echo $nama_alat ;?></h5>
			</h4></center> 
		</div><!-- /.container-fluid -->
	</section>
	<table id="example" class="table table-bordered table-striped">
		<thead style="background-color:  lightgray;" class="elevation-2">
			<tr>
				<th width="30px">Noo.</th>
				<th width="130px">Nama alat Bayar</th>
				<th width="90px">Kode Sub Alat Bayar</th>
				<th width="130px">Nama Sub Alat Bayar</th>
			</tr>
		</thead>
		<tbody>
			<?php

			$query="SELECT sb.kdsub_alat,
			ab.nama as ab_nama,sb.nama as sb_nama
			FROM alat_bayar ab 
			join subalat_bayar sb on sb.kd_alat=ab.kd_alat 
			WHERE ab.kd_alat='$kd_alat'
			order by ab.kd_alat asc;
			";

			$sql1=mysqli_query($koneksi,$query);
			$no=1;

			while($s1=mysqli_fetch_array($sql1))
			{
				?>
				<tr align="left">
					<td><?php echo $no; ?></td>
					<td><?php echo $s1['ab_nama']; ?></td> 
					<td><?php echo $s1['kdsub_alat']; ?></td>
					<td><?php echo $s1['sb_nama']; ?></td>
				</tr>
				<?php
				$no++;

			}
			?>
		</tbody>

	</table>
	<hr>
	<!-- </div> -->

	<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
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
	</script> -->

	<?php include '../footer_lap.php'; ?>
	