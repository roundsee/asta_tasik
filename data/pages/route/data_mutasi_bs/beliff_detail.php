<?php

$judulform = "Pengajuan";

$data = 'data_pengajuan';
$rute = 'pengajuan';
$aksi = 'aksi_pengajuan';
$rute_detail = 'pengajuan_detail';

$tabel = 'pengajuan';
$f1 = 'no_pengajuan';
$f2 = 'tgl_pengajuan';
$f3 = 'ket';
$f4 = 'no_rek';
$f5 = 'nama_bank';
$f6 = 'atas_nama';
$f7 = 'submit';
$f8 = 'st1';
$f9 = 'tgl_proses';
$f10 = 'tgl_submit1';
$f11 = 'tgl_submit2';
$f12 = 'tgl_submit3';
$f13 = 'note1';
$f14 = 'note2';
$f15 = 'note3';
$f16 = 'unit';
$f17 = 'manager';
$f18 = 'kode_pengaju';

$j1 = 'No Pengajuan';
$j2 = 'Tgl Pengajuan';
$j3 = 'Keterangan';
$j4 = 'No Rek';
$j5 = 'Nama Bank';
$j6 = 'Atas Nama';
$j7 = 'Submit';
$j8 = 'st1';
$j9 = 'Tgl Pencairan';
$j10 = 'Tgl Submit 1';
$j11 = 'Tgl Submit 2';
$j12 = 'Tgl Submit 3';
$j13 = 'Note1';
$j14 = 'Note2';
$j15 = 'Note3';
$j16 = 'Unit';
$j17 = 'Manager';
$j18 = 'Kode Pengaju';

$tabel2 = 'pengajuan_detail';

$ff1 = 'no_pengajuan';
$ff2 = 'kd_acc';
$ff3 = 'uraian';
$ff4 = 'jumlah';
$ff5 = 'unsur_pph';
$ff6 = 'akun';
$ff7 = 'persen_pph';
$ff8 = 'urut';
$ff9 = 'pph21';
$ff10 = 'pph23';
$ff11 = 'pph4';


$jj1 = 'No Pengajuan';
$jj2 = 'Kode Account';
$jj3 = 'Uraian';
$jj4 = 'Jumlah';
$jj5 = 'Unsur PPh';
$jj6 = 'Akun';
$jj7 = 'PPh (%)';
$jj8 = 'Urut';
$jj9 = 'PPh 21 (%)';
$jj10 = 'PPh 23 (%)';
$jj11 = 'PPh 4 (%)';

//rujukan
$rujukan1 = 'partner';
$fr1 = 'id_par';
$fr2 = 'par_no';
$fr3 = 'par_type';
$fr4 = 'nama_par';
$fr5 = 'npwp_par';
$fr6 = 'kontak_par';
$fr7 = 'alamat_par';
$fr8 = 'alamat2_par';
$fr9 = 'alamat_kirim_par';

$jr1 = 'Id Partner';
$jr2 = 'Partner No';
$jr3 = 'Partner Type';
$jr4 = 'Nama';
$jr5 = 'Npwp';
$jr6 = 'Kontak';
$jr7 = 'Alamat';
$jr8 = 'Alamat NPWP';
$jr9 = 'Alamat Kirim';


$rujukan2 = 'employee';
$frr1 = 'employee_number';
$frr2 = 'name_e';

$jrr1 = 'Kode Sales';
$jrr2 = 'Nama Sales';



//session_start();
if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
	echo "<link href='style.css' rel='stylesheet' type='text/css'>
	<center>Untuk mengakses modul, Anda harus login <br>";
	echo "<a href=../../index.php><b>LOGIN</b></a></center>";
} else {

	switch ($_GET['act']) {
		default:

			$id = $_GET['id'];

			$query = mysqli_query($koneksi, "SELECT * from $tabel where $f1='$_GET[id]'");
			$q1 = mysqli_fetch_array($query);

			$query2 = mysqli_query($koneksi, "SELECT * from $tabel2 where $ff1='$_GET[id]' ");
			$q2 = mysqli_fetch_array($query2);


			$dir = '../../';
?>

			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper" style="height:70%">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<div class="container-fluid">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1 class="list-gds wow slideInUp" data-wow-duration=".5s" data-wow-delay=".1s">
									<b><?php echo $judulform; ?></b> <small>detail</small>
								</h1>
							</div>
							<div class="col-sm-6">
								<ol class="breadcrumb float-sm-right">
									<li class="breadcrumb-item"><a href="main.php?route=home">Beranda</a></li>
									<li class="breadcrumb-item active"><a href="main.php?route=<?php echo $rute; ?>&act"><?php echo $judulform; ?></a></li>
									<li class="breadcrumb-item active"> detail</li>
								</ol>
							</div>
						</div>
					</div><!-- /.container-fluid -->
				</section>

				<!-- Main content -->
				<section class="content" style="height:90%">
					<div class="container-fluid table-responsive" style="height:100%">
						<div class="card card-default">
							<!-- /.card-header -->
							<div class="card-body" style="height:70%">
								<div class="row">
									<!-- right column -->
									<div class="col-lg-12">
										<!-- general form elements disabled -->
										<div class="box box-warning">
											<div class="box-body">

												<div class="row">
													<div class="col-lg-7" style="background-color:ghostwhite;">
														<form method="POST" action="route/<?php echo $data; ?>/<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=edit&id=<?php echo $e['$f1']; ?>" enctype="multipart/form-data">

															<div class="row">

																<div class="col-lg-4">
																	<div class="form-group">
																		<label>No Pengajuan</label>
																		<input type="text" name="<?php echo $f1; ?>" class="form-control" value="<?php echo $id; ?>" readonly />
																	</div>
																</div>

																<div class="col-lg-3">
																	<div class="form-group">
																		<label>Tanggal Pengajuan</label>
																		<input type="date" class="form-control" name="<?php echo $f2; ?>" onclick="displayHasil(this.value)" placeholder="Masukan <?php echo $j2; ?> (Wajib)" value="<?php echo date('Y-m-d') ?>" readonly>
																	</div>
																</div>

																<div class="col-lg-3">
																	<div class="form-group">
																		<label><?php echo $j9; ?></label>
																		<input type="date" class="form-control" name="<?php echo $f9; ?>" onclick="displayHasil(this.value)" placeholder="Masukan <?php echo $j9; ?> (Wajib)" value="<?php echo date('Y-m-d') ?>" readonly>
																	</div>
																</div>

															</div> <!-- row -->


													</div> <!-- col-lg-7 -->

													<div class="col-lg-5" style="background-color:ghostwhite;">
														<div class="form-group">
															<label><?php echo $j3; ?></label>
															<textarea type="text" name="<?php echo $f3; ?>" value="<?php echo $q1[$f3]; ?>" class="form-control" rows="6" cols="50"><?php echo $q1[$f3]; ?></textarea>
														</div>
													</div>
													</form>
												</div>

												<hr>

												<table id="example1" width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-bordered table-striped">
													<thead style="background-color: #ddd;">
														<tr style="font-weight:600">
															<td align="center" width="40px">No</td>
															<td align="left" width="120px"><?php echo $jj2; ?></td>
															<td align="left" width="240px">Deskripsi</td>
															<td align="left" width="240px"><?php echo $jj3; ?></td>
															<td align="right" width="100px"><?php echo $jj4; ?></td>
															<td align="center" style="min-width:60px;width: 80px;">Aksi</td>
														</tr>
													</thead>
													<tbody>
														<?php
														$no = 1;
														$sql1 = mysqli_query($koneksi, "SELECT * from pengajuan_detail pd
														JOIN account a ON a.no_account=pd.kd_acc
														where pd.no_pengajuan='$_GET[id]' ");

														$total = 0;
														$grandtotal = 0;
														$diskon = 0;
														$spph21 = 0;
														$spph23 = 0;
														$spph4 = 0;
														$stotal = 0;
														while ($s1 = mysqli_fetch_array($sql1)) {
															$pph21 = $s1[$ff4] * ($s1[$ff9] / 100);
															$pph23 = $s1[$ff4] * ($s1[$ff10] / 100);
															$pph4 = $s1[$ff4] * ($s1[$ff11] / 100);
															$spph21 = $spph21 + $pph21;
															$spph23 = $spph23 + $pph23;
															$spph4 = $spph4 + $pph4;
															$total = $s1[$ff4] + $pph21 + $pph23 + $pph4;
															$stotal = $stotal + $s1[$ff4];
															$grandtotal = $grandtotal + $total;
														?>
															<tr>
																<td align="right"><?php echo $no;
																									echo "<input type='hidden' name='id[$no]' value='$s1[$ff1]'"; ?></td>
																<td align="left"><?php echo $s1[$ff2]; ?></td>
																<td align="left"><?php echo $s1['deskripsi']; ?></td>
																<td align="left"><?php echo $s1[$ff3]; ?></td>
																<td align="right"><?php echo number_format($s1[$ff4]); ?></td>
																<td align="center">
																	<?php
																	if (1 == 1) { ?>

																		<a href="main.php?route=<?php echo $rute_detail; ?>&act=edit-detail&id=<?php echo $s1[$ff1]; ?>&id2=<?php echo $s1[$ff2]; ?>&id3=<?php echo $s1[$ff8]; ?>" title="edit"><button class="btn btn-xs btn-primary elevation-1" style="opacity: .7"><i class="fa fa-edit"></i></button></a>

																		<!-- <a href="main.php?route=<?php echo $rute_detail; ?>&act=nego-detail&id=<?php echo $s1[$ff1]; ?>&idp=<?php echo $s1[$ff3]; ?>" title="nego"><button class="btn btn-xs btn-primary elevation-1" style="opacity: .7" ><i class="fa fa-plus"></i></button></a> -->

																		<a href="route/<?php echo $data; ?>/<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=hapus-detail&id=<?php echo $s1[$ff1]; ?>&id2=<?php echo $s1[$ff2]; ?>&id3=<?php echo $s1[$ff8]; ?>" title="Hapus Data Ini" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA PENTING INI ... ?')"><button class="btn btn-xs btn-danger elevation-1" style="opacity: .7"><i class="fa fa-trash"></i></button></a>

																	<?php } ?>

																</td>
															</tr>

														<?php
															$no++;
														}
														?>
													</tbody>
													<tfoot>
														<tr style="font-weight:600">
															<td colspan="4" align="right">T o t a l</td>
															<td align="right"><?php echo number_format($stotal); ?></td>
															<td></td>
														</tr>
													</tfoot>

												</table>

												<!-- tambah keterngan utk Proses .....-->
												<?php
												if ($q1['submit'] <= 1) { ?>

													<form id="inputDetailForm" method="post" action="route/<?php echo $data; ?>/<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=input-detail&id=<?php echo $_GET['id']; ?>">
														<button id="addFormButton" type="button" class="btn btn-primary btn-sm elevation-2" style="opacity: .7;">
															<i class="fa fa-plus"></i> Tambah
														</button>
														<div id="newFormContainer"></div>
														<div style="margin:10px"></div>
														<br>
													</form>
													<div style="margin:10px"></div>
													<br><br>

													<script>
														document.getElementById('addFormButton').addEventListener('click', function() {
															// Define the new form HTML
															var newFormHtml = `
														<br>		
														<div class="form-group">
														<h5>Data Detail</h5>
														</div>
														<div class="row">
														<div class="col-lg-3">
														<div class="form-group">
														<label for="">Account</label>
														<select name="kd_acc2[]" class="form-control select2" style="width:100%;" required>
														<option></option>
														<?php
														if ($manager = false) {
															$produk = mysqli_query($koneksi, "SELECT * FROM account  order by no_account asc");
														} else {
															$produk = mysqli_query($koneksi, "SELECT * FROM account WHERE filter=1 order by no_account asc");
														}

														while ($pro = mysqli_fetch_array($produk)) {
															echo "<option value='$pro[no_account]-$pro[deskripsi]'>$pro[no_account] - $pro[deskripsi]</option>";
														}
														?>
														</select>
														</div>
														</div>
														<div class="col-lg-2">
														<div class="form-group">
														<label>Kode Account</label>
														<input type="text" class="form-control" name="kd_acc[]" id="kode_account" placeholder="Autofill by Account" readonly>
														</div>
														</div>
														<div class="col-lg-3">
														<div class="form-group">
														<label>Nama Account</label>
														<input type="text" class="form-control" id="nama_account" name="uraian[]" placeholder="Autofill by Account" readonly>
														</div>
														</div>
														<div class="col-lg-2">
														<div class="form-group">
														<label>Jumlah</label>
														<input type="text" name="jumlah[]" id="tanpa-rupiah" class="form-control" placeholder="Masukan Jumlah" required>
														</div>
														</div>
														</div>

														<button type="submit" class="btn btn-success btn-xs pull-right  elevation-1" style="opacity: .7"> Save ...</button>
														`;

															// Append the new form to the container
															var newFormContainer = document.getElementById('newFormContainer');
															var newFormElement = document.createElement('div');
															newFormElement.innerHTML = newFormHtml;
															newFormContainer.appendChild(newFormElement);

															// Reinitialize Select2 for the newly added element
															$(newFormElement).find('.select2').select2({
																theme: 'bootstrap4'
															});

															// Add event listener for autosplitaccount on change of #kd_acc in the newly added form
															$(newFormElement).find('select[name="kd_acc2[]"]').on('change', function() {
																var selectedValue = $(this).val();
																var parts = selectedValue.split('-');
																$(this).closest('.row').find('#kode_account').val(parts[0]); // Masukkan no_account ke input dengan id kode_account
																$('#nama_account').val(parts[1]); // Masukkan deskripsi ke input dengan id nama_account
															});
														});

														// Initialize Select2 for existing elements on page load
														$(function() {
															$('.select2').select2({
																theme: 'bootstrap4'
															});
														});
													</script>


													<!-- <a href="route/<?php echo $data; ?>/<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=proses-sph&id=<?php echo $_GET['id']; ?>"><button class="btn btn-success btn-xs pull-right  elevation-1" style="opacity: .7">Submit ...</button></a>
													<div style="margin:10px"></div>												
													<br><br> -->
												<?php }

												if ($q1['submit'] == 1) { ?>

													<button class="btn btn-danger btn-sm elevation-2 " style="opacity: .7;" onclick="window.location='route/<?php echo $data; ?>/<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&id=<?php echo $id; ?>&act=pengajuan_ulang'"><i class="fa fa-check" ;></i> Pengajuan Ulang</button>

													<div style="margin:10px"></div>
													<br>


													<!-- <a href="route/<?php echo $data; ?>/<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=proses-sph&id=<?php echo $_GET['id']; ?>"><button class="btn btn-success btn-xs pull-right  elevation-1" style="opacity: .7">Submit ...</button></a>
													<div style="margin:10px"></div>												
													<br><br> -->
												<?php } ?>



												<!-- end tambah keterngan utk Proses .....-->
												<div class="row">
													<div class="col-lg-6">

														<button class="btn btn-primary btn-sm elevation-2 " style="opacity: .7;" onclick="window.location='main.php?route=<?php echo $rute; ?>&id=<?php echo $id; ?>&act=pengajuan'"> Back</button>

													</div>
													<div class="col-lg-6" style="text-align:right">


													</div>
												</div>

											</div>
											<hr>

											<?php include 'navbar.php'; ?>


										</div><!-- /.box-body -->
										<!-- </div>  -->
										<!-- /.box -->

									</div><!--/.col (right) -->
								</div> <!-- /.row -->
							</div>

				</section><!-- /.content -->
			</div><!-- /.content-wrapper -->

		<?php
			break;

			//Form Edit detail 
		case "edit-detail":

			// echo '<br>'.$_GET['id'];
			// echo '<br>'.$_GET['idp'];
			// echo '<br>'.$_GET['idb'];

			$edit = mysqli_query($koneksi, "SELECT * from $tabel where $f1='$_GET[id]'");
			$e = mysqli_fetch_array($edit);

			$sql = mysqli_query($koneksi, "SELECT * from pengajuan_detail 
						where no_pengajuan='$_GET[id]' AND kd_acc='$_GET[id2]' AND urut='$_GET[id3]' ");
			$s1 = mysqli_fetch_array($sql);

		?>
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper" style="background-color: ghostwhite;">
				<!-- Content Header (Page header) -->
				<section class="content-header ">
					<div class="container-fluid">
						<div class="row mb-2">
							<div class="col-sm-6">
								<div style="margin:10px;"></div>
								<h1 class="list-gds animated tdFadeInDown">
									<b><?php echo $judulform; ?></b> <small> Detail edit</small>
								</h1>
							</div>
							<div class="col-sm-6">
								<ol class="breadcrumb float-sm-right">
									<li class="breadcrumb-item"><a href="main.php?route=home">Beranda</a></li>

									<li class="breadcrumb-item active"><a href="main.php?route=<?php echo $rute; ?>&act"><?php echo $judulform; ?></a></li>
									<li class="breadcrumb-item active">edit detail</li>
								</ol>
							</div>
						</div>
					</div><!-- /.container-fluid -->
				</section>

				<!-- Main content -->
				<section class="content wow fadeInUp" data-wow-duration=".2s" data-wow-delay=".1s">
					<div class="container-fluid">
						<div class="card card-default">
							<!-- /.card-header -->
							<div class="card-body animated tdFadeIn">
								<div class="row">
									<!-- right column -->
									<div class="col-md-12">
										<!-- general form elements disabled -->
										<div class="box box-warning">
											<div class="box-body">

												<form method="POST" action="route/<?php echo $data; ?>/<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=edit-detail&id=<?php echo $s1[$ff1]; ?>&id2=<?php echo $s1[$ff2]; ?>&id3=<?php echo $s1[$ff8]; ?>" enctype="multipart/form-data">

													<section class="base">
														<div class="row">

															<div class="col-lg-2">
																<div class="form-group">
																	<label><?php echo $jj2; ?></label>
																	<input type="text" name="<?php echo $ff2; ?>" class="form-control" value="<?php echo $s1[$ff2]; ?>" readonly />
																</div>

															</div>


															<div class="col-lg-2">
																<div class="form-group">
																	<label><?php echo $jj3; ?></label>
																	<input type="text" name="<?php echo $ff3; ?>" class="form-control" value="<?php echo $s1[$ff3]; ?>" readonly />
																</div>

															</div>

															<div class="col-lg-4">
																<div class="form-group">
																	<label><?php echo $jj3; ?></label>
																	<input type="text" name="<?php echo $ff3; ?>" class="form-control" value="<?php echo $s1[$ff3]; ?>" autofocus="" />
																</div>
															</div>

															<div class="col-lg-2">
																<div class="form-group">
																	<label><?php echo $jj4; ?></label>
																	<input type="text" name="<?php echo $ff4; ?>" class="form-control" value="<?php echo $s1[$ff4]; ?>" autofocus="" />
																</div>
															</div>


														</div>

														<hr />

														<div class="form-group">
															<button type="submit" class="btn btn-primary elevation-2" style="opacity: .7">Simpan Perubahan</button>
														</div>

													</section>
												</form>
												<a href="main.php?route=<?php echo $rute_detail; ?>&act&id=<?php echo $s1[$f1]; ?>&asal=<?php echo $rute; ?>"><button class="btn btn-primary btn-sm elevation-1" style="opacity: .7">Back</button></a>

											</div><!-- /.box-body -->
										</div><!-- /.box -->
									</div><!--/.col (right) -->
								</div> <!-- /.row -->
				</section><!-- /.content -->
			</div><!-- /.content-wrapper -->

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

			<!-- Page script -->
			<script type="text/javascript">
				$(function() {
					//Datemask dd/mm/yyyy
					$("#datemask").inputmask("dd/mm/yyyy", {
						"placeholder": "dd/mm/yyyy"
					});
					//Datemask2 mm/dd/yyyy
					$("#datemask2").inputmask("mm/dd/yyyy", {
						"placeholder": "mm/dd/yyyy"
					});
					//Money Euro
					$("[data-mask]").inputmask();

					//Date range picker
					$('#reservation').daterangepicker();
					//Date range picker with time picker
					$('#reservationtime').daterangepicker({
						timePicker: true,
						timePickerIncrement: 30,
						format: 'MM/DD/YYYY h:mm A'
					});
					//Date range as a button
					$('#daterange-btn').daterangepicker({
							ranges: {
								'Today': [moment(), moment()],
								'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
								'Last 7 Days': [moment().subtract('days', 6), moment()],
								'Last 30 Days': [moment().subtract('days', 29), moment()],
								'This Month': [moment().startOf('month'), moment().endOf('month')],
								'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
							},
							startDate: moment().subtract('days', 29),
							endDate: moment()
						},
						function(start, end) {
							$('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
						}
					);

					//iCheck for checkbox and radio inputs
					$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
						checkboxClass: 'icheckbox_minimal-blue',
						radioClass: 'iradio_minimal-blue'
					});
					//Red color scheme for iCheck
					$('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
						checkboxClass: 'icheckbox_minimal-red',
						radioClass: 'iradio_minimal-red'
					});
					//Flat red color scheme for iCheck
					$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
						checkboxClass: 'icheckbox_flat-green',
						radioClass: 'iradio_flat-green'
					});

					//Colorpicker
					$(".my-colorpicker1").colorpicker();
					//color picker with addon
					$(".my-colorpicker2").colorpicker();

					//Timepicker
					$(".timepicker").timepicker({
						showInputs: false
					});
				});
			</script>

			<script>
				$(function() {
					var dt = '';
					$('#d1').datepicker();


					$('#d2').datepicker({
						changeMonth: true,
						dateFormat: 'yy-mm-dd',
						changeYear: true,
					});

					$('#d3').datepicker({
						changeMonth: true,
						dateFormat: 'yy-mm-dd',
						changeYear: true,
						onClose: function(date) {
							dt = date;
							$("#d4").datepicker("destroy");
							showdate();

						}
					});

					$('#d5').datepicker({
						changeYear: true,
					});

					$("#d6").datepicker();
					$("#hFormat").change(function() {
						$("#d6").datepicker("option", "dateFormat", $(this).val());
					});



					function showdate() {
						$('#d4').datepicker({
							changeMonth: true,
							dateFormat: 'yy-mm-dd',
							changeYear: true,
							minDate: new Date(dt),
							hideIfNoPrevNext: true
						});
					}

				});
			</script>


		<?php
			break;
			//Form Tambah lagi 
		case "tambah-lagi":
			$edit = mysqli_query($koneksi, "SELECT * from $tabel where $f2='$_GET[id]'");
			$e = mysqli_fetch_array($edit);

			// echo $_GET['id'];
			// echo "<br/>".$e[$f2];

		?>

			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper" style="background-color: ghostwhite;">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<div class="container-fluid">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1 class="list-gds animated tdFadeInDown">
									<b><?php echo $judulform; ?></b> <small>detail | tambah</small>
								</h1>
							</div>
							<div class="col-sm-6">
								<ol class="breadcrumb float-sm-right">
									<li class="breadcrumb-item"><a href="main.php?route=home">Beranda</a></li>
									<li class="breadcrumb-item active">Data Master</li>
									<li class="breadcrumb-item active"><?php echo $judulform; ?></li>
									<li class="breadcrumb-item active">tambah</li>
								</ol>
							</div>
						</div>
					</div><!-- /.container-fluid -->
				</section>

				<!-- Main content -->
				<section class="content wow fadeInUp" data-wow-duration=".2s" data-wow-delay=".1s">
					<div class="container-fluid">
						<div class="card card-default">
							<!-- /.card-header -->
							<div class="card-body animated tdFadeIn">
								<div class="row">
									<!-- right column -->
									<div class="col-md-12">
										<!-- general form elements disabled -->
										<div class="box box-warning">
											<div class="box-body">

												<form method="POST" action="route/<?php echo $data; ?>/<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=input-lagi" enctype="multipart/form-data">

													<div class="row">
														<div class="col-lg-6">

															<div class="form-group">
																<label><?php echo $jj1; ?></label>
																<input type="text" name="<?php echo $ff1; ?>" value="<?php echo $e[$f2]; ?>" class="form-control" placeholder="Masukan <?php echo $jj1; ?> ..." readonly />
															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-lg-4">

															<div class="form-group">
																<label><?php echo $jj3; ?></label>
																<input type="text" name="<?php echo $ff3; ?>" class="form-control" placeholder="Masukan <?php echo $jj3; ?> ..." required="required" />
															</div>
														</div>
														<div class="col-lg-2">

															<div class="form-group">
																<label><?php echo $jj4; ?></label>
																<input type="text" name="<?php echo $ff4; ?>" class="form-control" placeholder="Masukan <?php echo $jj4; ?> ..." required="required" />
															</div>
														</div>

														<div class="col-lg-1">
															<div class="form-group">
																<label><?php echo $jj5; ?></label>
																<input type="text" name="<?php echo $ff5; ?>" class="form-control" placeholder="Masukan <?php echo $jj5; ?> ..." required="required" />
															</div>
														</div>

														<div class="col-lg-1">
															<div class="form-group">
																<label><?php echo $jj6; ?></label>
																<input type="text" name="<?php echo $ff6; ?>" class="form-control" placeholder="Masukan <?php echo $jj6; ?> ..." required="required" />
															</div>
														</div>

														<div class="col-lg-2">
															<div class="form-group">
																<label><?php echo $jj8; ?></label>
																<input type="text" name="<?php echo $ff8; ?>" class="form-control" placeholder="Masukan <?php echo $jj8; ?> ..." required="required" />
															</div>
														</div>

														<div class="col-lg-2">
															<div class="form-group">
																<label><?php echo $jj7; ?></label>
																<select name="desc_type" class="form-control">
																	<?php

																	$query = mysqli_query($koneksi, "SELECT * from desc_type order by nama_desc asc");
																	while ($x = mysqli_fetch_array($query)) {
																		echo "<option value='$x[nama_desc]'>$x[nama_desc]</option>";
																	}
																	?>
																</select>

															</div>
														</div>


													</div>

													<div class="form-group">
														<label><?php echo $jj9; ?></label>
														<input type="text" name="<?php echo $ff9; ?>" class="form-control" placeholder="Masukan <?php echo $jj9; ?> ..." required="required" />
													</div>

													<div class="form-group">
														<hr />
														<input type="submit" class="btn btn-primary elevation-1" style="opacity: .7" value="Simpan" />
													</div>

												</form>

												<a href="main.php?route=<?php echo $rute_detail; ?>&act&id=<?php echo $_GET['id']; ?>&ide=<?php echo $_SESSION['employee_number']; ?>&asal=<?php echo $rute; ?>"><button class="btn btn-primary btn-sm elevation-1" style="opacity: .7">Back</button></a>

											</div><!-- /.box-body -->
										</div><!-- /.box -->
									</div><!--/.col (right) -->
								</div> <!-- /.row -->
				</section><!-- /.content -->
			</div><!-- /.content-wrapper -->


			<style>
				.file {
					visibility: hidden;
					position: absolute;
				}
			</style>
			<script>
				function isi_otomatis() {
					var <?php echo $f1; ?> = $("#<?php echo $f1; ?>").val();
					$.ajax({
						url: 'ajax.php',
						data: "<?php echo $f1; ?>=" + <?php echo $f1; ?>,
					}).success(function(data) {
						var json = data,
							obj = JSON.parse(json);
						$('#<?php echo $f2; ?>').val(obj.<?php echo $f2; ?>);

					});
				}
			</script>

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



			<!-- Page script -->
			<script type="text/javascript">
				$(function() {
					//Datemask dd/mm/yyyy
					$("#datemask").inputmask("dd/mm/yyyy", {
						"placeholder": "dd/mm/yyyy"
					});
					//Datemask2 mm/dd/yyyy
					$("#datemask2").inputmask("mm/dd/yyyy", {
						"placeholder": "mm/dd/yyyy"
					});
					//Money Euro
					$("[data-mask]").inputmask();

					//Date range picker
					$('#reservation').daterangepicker();
					//Date range picker with time picker
					$('#reservationtime').daterangepicker({
						timePicker: true,
						timePickerIncrement: 30,
						format: 'MM/DD/YYYY h:mm A'
					});
					//Date range as a button
					$('#daterange-btn').daterangepicker({
							ranges: {
								'Today': [moment(), moment()],
								'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
								'Last 7 Days': [moment().subtract('days', 6), moment()],
								'Last 30 Days': [moment().subtract('days', 29), moment()],
								'This Month': [moment().startOf('month'), moment().endOf('month')],
								'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
							},
							startDate: moment().subtract('days', 29),
							endDate: moment()
						},
						function(start, end) {
							$('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
						}
					);

					//iCheck for checkbox and radio inputs
					$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
						checkboxClass: 'icheckbox_minimal-blue',
						radioClass: 'iradio_minimal-blue'
					});
					//Red color scheme for iCheck
					$('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
						checkboxClass: 'icheckbox_minimal-red',
						radioClass: 'iradio_minimal-red'
					});
					//Flat red color scheme for iCheck
					$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
						checkboxClass: 'icheckbox_flat-green',
						radioClass: 'iradio_flat-green'
					});

					//Colorpicker
					$(".my-colorpicker1").colorpicker();
					//color picker with addon
					$(".my-colorpicker2").colorpicker();

					//Timepicker
					$(".timepicker").timepicker({
						showInputs: false
					});
				});
			</script>

			<script>
				$(function() {
					var dt = '';
					$('#d1').datepicker();


					$('#d2').datepicker({
						changeMonth: true,
						dateFormat: 'yy-mm-dd',
						changeYear: true,
					});

					$('#d3').datepicker({
						changeMonth: true,
						dateFormat: 'yy-mm-dd',
						changeYear: true,
						onClose: function(date) {
							dt = date;
							$("#d4").datepicker("destroy");
							showdate();

						}
					});

					$('#d5').datepicker({
						changeYear: true,
					});

					$("#d6").datepicker();
					$("#hFormat").change(function() {
						$("#d6").datepicker("option", "dateFormat", $(this).val());
					});



					function showdate() {
						$('#d4').datepicker({
							changeMonth: true,
							dateFormat: 'yy-mm-dd',
							changeYear: true,
							minDate: new Date(dt),
							hideIfNoPrevNext: true
						});
					}

				});
			</script>
		<?php
			break;

			//Form nego detail 
		case "nego-detail":


			// $tabel_nego='sph_nego';
			// $fn1='no_sph';
			// $fn2='no_request';
			// $fn3='tgl_nego';
			// $fn4='ket';
			// $fn5='harga_nego';
			// $fn6='manager';


			// $jn1='No SPH';
			// $jn2='No Request';
			// $jn3='Tgl';
			// $jn4='Ket';
			// $jn5='Harga';
			// $jn6='Manager';

			// echo '<br>'.$_GET['id'];
			// echo '<br>'.$_GET['idp'];
			// echo '<br>'.$_GET['idb'];
			$edit = mysqli_query($koneksi, "SELECT * from $tabel where $f1='$_GET[id]'");
			$e = mysqli_fetch_array($edit);

			$sql = mysqli_query($koneksi, "SELECT * from $tabel2 where $ff1='$_GET[id]' AND $ff3='$_GET[idp]'");
			$s1 = mysqli_fetch_array($sql);

		?>
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper" style="background-color: ghostwhite;">
				<!-- Content Header (Page header) -->
				<section class="content-header ">
					<div class="container-fluid">
						<div class="row mb-2">
							<div class="col-sm-6">
								<div style="margin:10px;"></div>
								<h1 class="list-gds animated tdFadeInDown">
									<b><?php echo $judulform; ?></b> <small>nego</small>
								</h1>
							</div>
							<div class="col-sm-6">
								<ol class="breadcrumb float-sm-right">
									<li class="breadcrumb-item"><a href="main.php?route=home">Beranda</a></li>

									<li class="breadcrumb-item active"><a href="main.php?route=<?php echo $rute; ?>&act"><?php echo $judulform; ?></a></li>
									<li class="breadcrumb-item active">nego</li>
								</ol>
							</div>
						</div>
					</div><!-- /.container-fluid -->
				</section>

				<!-- Main content -->
				<section class="content wow fadeInUp" data-wow-duration=".2s" data-wow-delay=".1s">
					<div class="container-fluid">
						<div class="card card-default">
							<!-- /.card-header -->
							<div class="card-body animated tdFadeIn">
								<div class="row">
									<!-- right column -->
									<div class="col-md-12">
										<!-- general form elements disabled -->
										<div class="box box-warning">
											<div class="box-body">

												<form method="POST" action="route/<?php echo $data; ?>/<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=nego-input&id=<?php echo $s1[$ff1]; ?>&idp=<?php echo $s1[$ff3]; ?>" enctype="multipart/form-data">

													<section class="base">
														<div class="row">
															<div class="col-lg-6">

																<div class="form-group">
																	<label><?php echo $jn1; ?></label>
																	<input type="text" name="<?php echo $fn1; ?>" class="form-control" value="<?php echo $s1[$ff1]; ?>" readonly />
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-lg-6">


																<div class="form-group">
																	<label><?php echo $jn6; ?></label>
																	<input type="text" name="<?php echo $fn6; ?>" class="form-control" autofocus="" />
																</div>
															</div>
															<div class="col-lg-2">

																<div class="form-group">
																	<label><?php echo $jn7; ?></label>
																	<input type="text" name="<?php echo $fn7; ?>" class="form-control" autofocus="" />
																</div>
															</div>
															<div class="col-lg-4">

																<div class="form-group">
																	<label><?php echo $jn8; ?></label>
																	<input type="text" name="<?php echo $fn8; ?>" class="form-control" autofocus="" />
																</div>
															</div>
														</div>


														<hr />

														<div class="form-group">
															<button type="submit" class="btn btn-primary elevation-2" style="opacity: .7">Simpan Perubahan</button>
														</div>

													</section>
												</form>
												<a href="main.php?route=<?php echo $rute_detail; ?>&act&id=<?php echo $s1[$f2]; ?>&asal=<?php echo $rute; ?>"><button class="btn btn-primary btn-sm elevation-1" style="opacity: .7">Back</button></a>

											</div><!-- /.box-body -->
										</div><!-- /.box -->
									</div><!--/.col (right) -->
								</div> <!-- /.row -->
				</section><!-- /.content -->
			</div><!-- /.content-wrapper -->


<?php
			break;
	}
}
?>

<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
	$('#example3').DataTable({
		"paging": true,
		"lengthChange": false,
		"searching": true,
		"ordering": true,
		"info": true,
		"autoWidth": false,
		"responsive": true,
	});
</script>