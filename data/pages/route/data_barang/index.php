<?php
// include 'header.php';
include '../../config/koneksi.php';

$judulform = "Daftar Barang";

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
$f7 = 'photo';
$f8 = 'rating';
$f9 = 'Quantity';
$f10 = 'Pcs';
$f11 = 'Renteng';
$f12 = 'Pak';
$f13 = 'ikat';
$f14 = 'Ball';
$f15 = 'Box';
$f16 = 'Dus';
$f17 = 'hrg_pcs';
$f18 = 'hrg_renteng';
$f19 = 'hrg_pak';
$f20 = 'hrg_ikat';
$f21 = 'hrg_ball';
$f22 = 'hrg_box';
$f23 = 'hrg_dus';
$f24 = 'disc_pcs';
$f25 = 'disc_renteng';
$f26 = 'disc_pak';
$f27 = 'disc_ikat';
$f28 = 'disc_ball';
$f29 = 'disc_box';
$f30 = 'disc_dus';
$f31 = 'id_kat';
$f32 = 'id_kat_satuan';



$j1 = 'Kode Barang';
$j2 = 'Nama';
$j3 = 'Harga';
$j4 = 'Satuan';
$j5 = 'kd_subgrup';
$j6 = 'kd_grup';
$j7 = 'photo';
$j8 = 'rating';
$j9 = 'Quantity';
$j10 = 'Pcs';
$j11 = 'Renteng';
$j12 = 'Pak';
$j13 = 'Ikat';
$j14 = 'Ball';
$j15 = 'Box';
$j16 = 'Dus';
$j17 = 'Harga Pcs';
$j18 = 'Harga Renteng';
$j19 = 'Harga Pak';
$j20 = 'Harga Ikat';
$j21 = 'Harga Ball';
$j22 = 'Harga Box';
$j23 = 'Harga Dus';
$j24 = 'Disc Pcs';
$j25 = 'Disc Renteng';
$j26 = 'Disc Pak';
$j27 = 'Disc Ikat';
$j28 = 'Disc Ball';
$j29 = 'Disc Box';
$j30 = 'Disc Dus';
$j31 = 'ID kategori filter';
$j32 = 'ID Kategori Satuan';
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
													<label><?php echo $j1; ?></label>
													<input type="text" name="<?php echo $f1; ?>" class="form-control" placeholder="Masukan <?php echo $j1; ?> ..." required="required" />
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


												<div class="form-group">
													<label><?php echo $j9; ?></label>
													<input type="text" name="<?php echo $f9; ?>" class="form-control" placeholder="Masukan <?php echo $j9; ?> ..." />
												</div>

												<div class="form-group">
													<label><?php echo $j10; ?></label>
													<input type="text" name="<?php echo $f10; ?>" class="form-control" placeholder="Masukan <?php echo $j10; ?> ..." />
												</div>

												<div class="form-group">
													<label><?php echo $j11; ?></label>
													<input type="text" name="<?php echo $f11; ?>" class="form-control" placeholder="Masukan <?php echo $j11; ?> ..." />
												</div>

												<div class="form-group">
													<label><?php echo $j12; ?></label>
													<input type="text" name="<?php echo $f12; ?>" class="form-control" placeholder="Masukan <?php echo $j12; ?> ..." />
												</div>

												<div class="form-group">
													<label><?php echo $j13; ?></label>
													<input type="text" name="<?php echo $f13; ?>" class="form-control" placeholder="Masukan <?php echo $j13; ?> ..." />
												</div>

												<div class="form-group">
													<label><?php echo $j14; ?></label>
													<input type="text" name="<?php echo $f14; ?>" class="form-control" placeholder="Masukan <?php echo $j14; ?> ..." />
												</div>

												<div class="form-group">
													<label><?php echo $j15; ?></label>
													<input type="text" name="<?php echo $f15; ?>" class="form-control" placeholder="Masukan <?php echo $j15; ?> ..." />
												</div>

												<div class="form-group">
													<label><?php echo $j16; ?></label>
													<input type="text" name="<?php echo $f16; ?>" class="form-control" placeholder="Masukan <?php echo $j16; ?> ..." />
												</div>

												<div class="form-group">
													<label><?php echo $j17; ?></label>
													<input type="text" name="<?php echo $f17; ?>" class="form-control" placeholder="Masukan <?php echo $j17; ?> ..." />
												</div>

												<div class="form-group">
													<label><?php echo $j18; ?></label>
													<input type="text" name="<?php echo $f18; ?>" class="form-control" placeholder="Masukan <?php echo $j18; ?> ..." />
												</div>

												<div class="form-group">
													<label><?php echo $j19; ?></label>
													<input type="text" name="<?php echo $f19; ?>" class="form-control" placeholder="Masukan <?php echo $j19; ?> ..." />
												</div>

												<div class="form-group">
													<label><?php echo $j20; ?></label>
													<input type="text" name="<?php echo $f20; ?>" class="form-control" placeholder="Masukan <?php echo $j20; ?> ..." />
												</div>

												<div class="form-group">
													<label><?php echo $j21; ?></label>
													<input type="text" name="<?php echo $f21; ?>" class="form-control" placeholder="Masukan <?php echo $j21; ?> ..." />
												</div>

												<div class="form-group">
													<label><?php echo $j22; ?></label>
													<input type="text" name="<?php echo $f22; ?>" class="form-control" placeholder="Masukan <?php echo $j22; ?> ..." />
												</div>

												<div class="form-group">
													<label><?php echo $j23; ?></label>
													<input type="text" name="<?php echo $f23; ?>" class="form-control" placeholder="Masukan <?php echo $j23; ?> ..." />
												</div>

												<div class="form-group">
													<label><?php echo $j24; ?></label>
													<input type="text" name="<?php echo $f24; ?>" class="form-control" placeholder="Masukan <?php echo $j24; ?> ..." />
												</div>

												<div class="form-group">
													<label><?php echo $j25; ?></label>
													<input type="text" name="<?php echo $f25; ?>" class="form-control" placeholder="Masukan <?php echo $j25; ?> ..." />
												</div>

												<div class="form-group">
													<label><?php echo $j26; ?></label>
													<input type="text" name="<?php echo $f26; ?>" class="form-control" placeholder="Masukan <?php echo $j26; ?> ..." />
												</div>

												<div class="form-group">
													<label><?php echo $j27; ?></label>
													<input type="text" name="<?php echo $f27; ?>" class="form-control" placeholder="Masukan <?php echo $j27; ?> ..." />
												</div>

												<div class="form-group">
													<label><?php echo $j28; ?></label>
													<input type="text" name="<?php echo $f28; ?>" class="form-control" placeholder="Masukan <?php echo $j28; ?> ..." />
												</div>

												<div class="form-group">
													<label><?php echo $j29; ?></label>
													<input type="text" name="<?php echo $f29; ?>" class="form-control" placeholder="Masukan <?php echo $j29; ?> ..." />
												</div>

												<div class="form-group">
													<label><?php echo $j30; ?></label>
													<input type="text" name="<?php echo $f30; ?>" class="form-control" placeholder="Masukan <?php echo $j30; ?> ..." />
												</div>

												<div class="form-group">
													<label><?php echo $j31; ?></label>
													<input type="text" name="<?php echo $f31; ?>" class="form-control" placeholder="Masukan <?php echo $j31; ?> ..." />
												</div>
												<div class="form-group">
													<label><?php echo $j32; ?></label>
													<input type="text" name="<?php echo $f32; ?>" class="form-control" placeholder="Masukan <?php echo $j32; ?> ..." />
												</div>

											</div>

											<div class="col-lg-7">
												<div class="row">
													<div class="col-sm-6">
														<div class="form-group">
															<div id="msg"></div>
															<input type="file" name="photo" class="file">
															<div class="input-group my-3">
																<input type="text" class="form-control" disabled placeholder="Upload Gambar (max 100kb)" id="file">
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
										<hr>

										<input type="submit" class="btn btn-primary btn-sm elevation-2" style="opacity: .7" value="Simpan" />

										<a href="main.php?route=<?php echo $rute; ?>&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=<?php echo $rute; ?>"><button class="btn btn-primary btn-sm elevation-2" style="opacity: .7">Back</button></a>
									</div>
								</form>


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