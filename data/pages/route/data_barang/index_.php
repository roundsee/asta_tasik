<?php
// include 'header.php';
include '../../config/koneksi.php';

$judulform = "Daftar Menu";

$data = 'data_barang';
$rute = 'barang';
$aksi = 'aksi_barang';

$tabel = 'barang';
$f1 = 'kd_brg';
$f2 = 'nama';
$f3 = 'harga';
$f4 = 'satuan';
$f5 = 'kd_subgrup';
$f6 = 'kd_grup';
$f7 = 'kd_jenis';
$f8 = 'photo';

$j1 = 'Kode Barang';
$j2 = 'Nama Barang';
$j3 = 'Harga';
$j4 = 'Satuan';
$j5 = 'Kode Sub Grup';
$j6 = 'Kode Grup';
$j7 = 'kode Jenis';
$j8 = 'Photo';

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color: ghostwhite;">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<div style="margin:10px;"></div>
					<h1 class="list-gds">
						<b><?php echo $judulform; ?></b> <small style="font-weight: 100;">tambah</small>
					</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="main.php?route=home">Beranda</a></li>
						<li class="breadcrumb-item active">Data</li>
						<li class="breadcrumb-item active"><?php echo $judulform; ?></li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<!-- <section class="content wow fadeInUp" data-wow-duration=".2s" data-wow-delay=".1s" > -->
	<section class="content">
		<div class="card card-default">
			<!-- /.card-header -->
			<div class="card-body">
				<!-- Main row -->
				<div class="row">
					<!-- Left col -->
					<section class="col-lg-12 connectedSortable">
						<!-- Custom tabs (Charts with tabs)-->
						<div class="box">
							<div class="box-body">
								<form method="post" enctype="multipart/form-data" action="route/<?php echo $data; ?>/<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=input">

									<div class="wrapper">
										<div class="row">
											<div class="col-lg-5">
												<div class="form-group">
													<label>Kode SubGrup</label>
													<input type="hidden" class="form-control" name="id" required="required" id="tampil_kota_id">
													<input type="text" class="form-control" required="required" id="tampil_kota_kode" placeholder="Isi Kode Subgrup">

													<div class="col-lg-8">
														<div class="form-group">
															<button style="margin-top: 27px" type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#cariKota">
																<i class="fa fa-search"></i> Cari Sub Grup
															</button>

															<!-- Modal SubGrup-->
															<div class="modal fade" id="cariKota" tabindex="-1" role="dialog" aria-labelledby="cariKotaLabel" aria-hidden="true">
																<div class="modal-dialog" role="document">
																	<div class="modal-content">
																		<div class="modal-header">
																			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																				<span aria-hidden="true">&times;&ensp; </span>
																			</button>
																			Pilih Kota
																		</div>
																		<div class="modal-body">
																			<div class="table-responsive">
																				<table class="table table-bordered table-striped table-hover" id="table-datatable-kota">
																					<thead>
																						<tr>
																							<th class="text-center">NO</th>
																							<th>KODE SUBGRUP</th>
																							<th>NAMA SUBGRUP</th>
																							<th>KD JENIS</th>
																							<th>ACTION</th>
																						</tr>
																					</thead>
																					<tbody>
																						<?php
																						$no = 1;
																						$data = mysqli_query($koneksi, "SELECT * FROM barang_subgrup ORDER BY kd_subgrup ASC");
																						while ($d = mysqli_fetch_array($data)) {
																						?>
																							<tr>
																								<td width="1%" class="text-center"><?php echo $no++; ?></td>
																								<td width="30%"><?php echo $d['kd_subgrup']; ?></td>
																								<td><?php echo $d['nama']; ?></td>
																								<td class="text-center"><?php echo $d['kd_jenis']; ?></td>
																								<td width="1%">
																									<button type="button" class="btn btn-success btn-sm modal-pilih-kota" id="<?php echo $d['kd_subgrup']; ?>" kode="<?php echo $d['kd_subgrup']; ?>" nama="<?php echo $d['nama']; ?>" data-dismiss="modal">Pilih</button>
																								</td>
																							</tr>
																						<?php
																						}
																						?>
																					</tbody>
																				</table>
																			</div>

																		</div>
																	</div>
																</div>
															</div>
															<!-- Modal KOTA End-->

														</div>
													</div>

													<label>Nama SubGrup <span id="status_kota"></span></label>
													<input type="text" class="form-control" name="nama" value="" required="required" placeholder="Nama Subgrup .." id="tampil_kota_nama" readonly>
												</div>

												<div class="form-group">
													<label><?php echo $j2; ?></label>
													<input type="text" name="<?php echo $f2; ?>" class="form-control" placeholder="Masukan <?php echo $j2; ?> ..." required="required" />
												</div>

												<div class="form-group">
													<label><?php echo $j3; ?></label>
													<input type="text" name="<?php echo $f3; ?>" class="form-control" placeholder="Masukan <?php echo $j3; ?> ..." required="required" />
												</div>
												<div class="form-group">
													<label><?php echo $j4; ?></label>
													<input type="text" name="<?php echo $f4; ?>" class="form-control" placeholder="Masukan <?php echo $j4; ?> ..." required="required" />
												</div>

											</div>

											<div class="col-lg-7">
												<div class="row">
													<div class="col-sm-6">
														<div class="form-group">
															<div id="msg"></div>
															<input type="file" name="photo" class="file">
															<div class="input-group my-3">
																<input type="text" class="form-control" disabled placeholder="Upload Gambar" id="file">
															</div>

															<img src="../../images/images.jpeg" id="preview" class="img-thumbnail elevation-3" style="width:200px">
														</div>
														<div class="input-group-append">
															<button type="button" id="pilih_gambar" class="browse btn btn-dark elevation-3">Pilih Gambar</button>
														</div>
													</div>
												</div>
											</div>

										</div>
									</div>


									<input type="submit" class="btn btn-primary btn-sm elevation-2" style="opacity: .7" value="Simpan" />


								</form>
								<hr />


								<a href="main.php?route=<?php echo $rute; ?>&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=<?php echo $rute; ?>"><button class="btn btn-primary btn-sm elevation-2" style="opacity: .7">Back</button></a>


							</div><!-- /.box-body -->
						</div><!-- /.box -->
					</section><!-- /.Left col -->
				</div><!-- /.row (main row) -->
			</div>
		</div>
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<?php
include 'wibjs.php';
?>

<script>
	function displayHasil(tgl_awal) {
		document.getElementById("tgl_awalHasil").value = tgl_awal;
	};
</script>

<script type="text/javascript">
	jQuery(document).ready(function(event) {
		var x0 = document.getElementById("isian0");
		var x1 = document.getElementById("isian1");
		var x2 = document.getElementById("isian2");

		x1.style.display = "none";
		x2.style.display = "none";

	});
</script>

<!-- Cakupan ========== -->
<script>
	function displayResult(cakup) {
		document.getElementById("result").value = cakup;
		var x = document.getElementById("result").value;
		var x0 = document.getElementById("isian0");
		var x1 = document.getElementById("isian1");
		var x2 = document.getElementById("isian2");
		if (x == "Nasional") {
			x0.style.display = "block";
			x1.style.display = "none";
			x2.style.display = "none";
			// alert(x + " adalah Cakupan 2");
		} else if (x == "Kota") {
			x0.style.display = "none";
			x1.style.display = "block";
			x2.style.display = "none";
			// alert(x + " adalah Cakupan 3");
		} else if (x == "Outlet") {

			x0.style.display = "none";
			x1.style.display = "none";
			x2.style.display = "block";
			// alert(x + " adalah Cakupan 4");
		}
	}
</script>
<!-- Cakupan ========== -->

<script type="text/javascript">
	<?php
	if (isset($_GET['alert'])) {
		if ($_GET['alert'] == "gagal") {
			echo "<div class='alert alert-danger'>File yang diperbolehkan hanya file gambar!</div>";
		} elseif ($_GET['alert'] == "duplikat") {
			echo "<div class='alert alert-danger'><b>Kode Barang</b> sudah pernah digunakan!</div>";
		}
	}
	?>
</script>

<style>
	.file {
		visibility: hidden;
		position: absolute;
	}
</style>

<script>
	function konfirmasi() {
		konfirmasi = confirm("Apakah anda yakin ingin menghapus gambar ini?")
		document.writeln(konfirmasi)
	}

	$(document).on("click", "#pilih_gambar", function() {
		var file = $(this).parents().find(".file");
		file.trigger("click");
	});

	$('input[type="file"]').change(function(e) {
		var fileName = e.target.files[0].name;
		$("#file").val(fileName);

		var reader = new FileReader();
		reader.onload = function(e) {
			// get loaded data and render thumbnail.
			document.getElementById("preview").src = e.target.result;
		};
		// read the image file as a data URL.
		reader.readAsDataURL(this.files[0]);
	});
</script>