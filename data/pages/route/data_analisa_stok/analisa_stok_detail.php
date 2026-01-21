<?php

$judulform = "Analisa Stok";

$data = 'data_analisa_stok';
$rute = 'analisa_stok';
$aksi = 'aksi_analisa_stok';

$rute_detail = 'analisa_stok_detail';


$tabel = 'pembelian';

$f1 = 'kd_beli';
$f2 = 'tgl_beli';
$f3 = 'kd_supp';
$f4 = 'ket_payment';
$f5 = 'status_payment';
$f6 = 'jenis_po';
$f7 = 'ppn';


$j1 = 'Kode Pembelian';
$j2 = 'Tanggal';
$j3 = 'Kode Supplier';
$j4 = 'Ket ';
$j5 = 'Status';
$j6 = 'Jenis';
$j7 = 'PB1';

$tabel2 = 'pembelian_detail';

$ff1 = 'kd_beli';
$ff2 = 'kd_brg';
$ff3 = 'jml';
$ff4 = 'price';
$ff5 = 'currency';
$ff6 = 'kurs';
$ff7 = 'disc';
$ff8 = 'urut';


$jj1 = 'Kode Beli';
$jj2 = 'Kode Barang';
$jj3 = 'Jumlah';
$jj4 = 'Price';
$jj5 = 'Currency';
$jj6 = 'Kurs';
$jj7 = 'Discount';
$jj8 = 'urut';

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

			$query = mysqli_query($koneksi, "SELECT $tabel.* , supplier.nama from $tabel JOIN supplier ON supplier.kd_supp = $tabel.kd_supp where $f1='$_GET[id]'");
			// 	if (!$query) {
			// 		$error_message = mysqli_error($koneksi);
			// 		echo "<script>alert('Query gagal: " . addslashes($error_message) . "');</script>";
			// }

			if (!$query) {
				$querry_message = mysqli_error($koneksi);
				echo "<script>alert('Querry gagal '.$querry_message )</script>";
			}

			$q1 = mysqli_fetch_array($query);
			$kdSupp = $q1['kd_supp'];
			$namaSupp = $q1['nama'];

			$query2 = mysqli_query($koneksi, "SELECT * from $tabel2 where $ff1='$_GET[id]' ");
			$q2 = mysqli_fetch_array($query2);

			if ($q1['ppn'] == 1) {
				$ppn = 'PB1';
			} else {
				$ppn = 'Non PB1';
			}


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
																		<label><?php echo $j1; ?></label>
																		<input type="text" name="<?php echo $f1; ?>" class="form-control" value="<?php echo $id; ?>" readonly />
																	</div>
																</div>

																<div class="col-lg-4">
																	<div class="form-group">
																		<label><?php echo $j3; ?></label>
																		<input type="text" name="<?php echo $f3; ?>" class="form-control" value="<?php echo $kdSupp; ?>" readonly />
																	</div>
																</div>
																<div class="col-lg-4">
																	<div class="form-group">
																		<label>Nama Supllier</label>
																		<input type="text" name="<?php echo $f3; ?>" class="form-control" value="<?php echo $namaSupp; ?>" readonly />
																	</div>
																</div>

																<div class="col-lg-3">
																	<div class="form-group">
																		<label><?php echo $j2; ?></label>
																		<input type="date" class="form-control" name="<?php echo $f2; ?>" onclick="displayHasil(this.value)" placeholder="Masukan <?php echo $j2; ?> (Wajib)" value="<?php echo date('Y-m-d') ?>" readonly>
																	</div>
																</div>


																<div class="col-lg-2">
																	<div class="form-group">
																		<label>PPn</label>
																		<select name="" id="pilihan" class="form-control" />
																		<option value=0><?php echo $ppn; ?></option>
																		</select>
																	</div>
																</div>



															</div> <!-- row -->


													</div> <!-- col-lg-7 -->

													<div class="col-lg-5" style="background-color:ghostwhite;">
														<div class="form-group">
															<label><?php echo $j4; ?></label>
															<textarea type="text" name="<?php echo $f4; ?>" value="<?php echo $q1[$f4]; ?>" class="form-control" rows="2" cols="50"><?php echo $q1[$f4]; ?></textarea>
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
															<!-- <td align="left" width="240px">Nama Barang</td> -->
															<td align="left" width="240px"><?php echo $jj3; ?></td>
															<td align="right" width="100px"><?php echo $jj4; ?></td>
															<td align="right" width="100px">Total</td>
															<td align="center" style="min-width:60px;width: 80px;">Aksi</td>
														</tr>
													</thead>
													<tbody>
														<?php
														$no = 1;
														$subtotal = 0;
														$stotal = 0;
														$sql1 = mysqli_query($koneksi, "SELECT * from pembelian_detail pd
														JOIN barang b ON b.kd_brg=pd.kd_brg
														where pd.kd_beli='$_GET[id]' ");
														echo 'ID: ' . htmlspecialchars($_GET['id']);

														if (!$sql1) {
															die("query error" . mysqli_error($koneksi));
														}

														while ($s1 = mysqli_fetch_array($sql1)) {
															$subtotal = $s1[$ff3] * $s1[$ff4];
															$stotal = $stotal + $subtotal;

														?>
															<tr>
																<td align="right"><?php echo $no;
																									echo "<input type='hidden' name='id[$no]' value='$s1[$ff1]'"; ?></td>
																<td align="left"><?php echo $s1[$ff2]; ?></td>
																<!-- <td align="left"><?php echo $s1['b.nama']; ?></td> -->
																<td align="left"><?php echo $s1[$ff3]; ?></td>
																<td align="right"><?php echo number_format($s1[$ff4]); ?></td>
																<td align="right"><?php echo number_format($subtotal); ?></td>
																<td align="center">
																	<?php
																	if (1 == 1) { ?>

																		<a href="main.php?route=<?php echo $rute_detail; ?>&act=edit-detail&id=<?php echo $s1[$ff1]; ?>&id2=<?php echo $s1[$ff2]; ?>&id3=<?php echo $s1[$ff8]; ?>" title="edit"><button class="btn btn-xs btn-primary elevation-1" style="opacity: .7"><i class="fa fa-edit"></i></button></a>

																		<!-- <a href="main.php?route=<?php echo $rute_detail; ?>&act=nego-detail&id=<?php echo $s1[$ff1]; ?>&idp=<?php echo $s1[$ff3]; ?>" title="nego"><button class="btn btn-xs btn-primary elevation-1" style="opacity: .7" ><i class="fa fa-plus"></i></button></a> -->

																		<a href="route/<?php echo $data; ?>/<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=hapus-detail&id=<?php echo $s1[$ff1]; ?>&id2=<?php echo $s1[$ff2]; ?>" title="Hapus Data Ini" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA PENTING INI ... ?')"><button class="btn btn-xs btn-danger elevation-1" style="opacity: .7"><i class="fa fa-trash"></i></button></a>

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
															<td colspan="3" align="right">T o t a l</td>
															<td align="right"><?php echo number_format($stotal); ?></td>
															<td></td>
														</tr>
													</tfoot>

												</table>

												<!-- tambah keterngan utk Proses .....-->
												<?php
												// if ($q1['submit'] <= 1) { 
												?>
												<form id="inputDetailForm" method="post" action="route/<?php echo $data; ?>/<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=input-detail&id=<?php echo $_GET['id']; ?>">
													<div id="formControls">
														<button id="addFormButton" type="button" class="btn btn-primary btn-sm elevation-2" style="opacity: .7;">
															<i class="fa fa-plus"></i> Tambah
														</button>
													</div>
													<div id="newFormContainer"></div>
													<div id="formFooter" style="display:none;">
														<br>
														<button type="submit" class="btn btn-success btn-xs pull-right elevation-1" style="opacity: .7">Save</button>
													</div>
												</form>
												<div style="margin:10px"></div>
												<br><br>

												<script>
													document.getElementById('addFormButton').addEventListener('click', function() {
														var formFooter = document.getElementById('formFooter');
														var newFormContainer = document.getElementById('newFormContainer');

														var newFormFieldsHtml = `
            <div class="row">
                ${newFormContainer.children.length === 0 ? `
                <div class="col-12">
                    <div class="form-group mt-2">
                        <h5>Data Detail</h5>
                    </div>
                </div>` : ''
                }
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="">Barang</label>
                        <select name="kd_acc2[]" class="form-control select2" style="width:100%;" required>
                            <option></option>
                            <?php
														$kdSupp = $q1['kd_supp'];
														$produk = mysqli_query($koneksi, "SELECT * FROM barang b INNER JOIN supplier_barang sb ON b.kd_brg = sb.kd_brg 
																WHERE sb.kd_supp = '$kdSupp'");
														while ($pro = mysqli_fetch_array($produk)) {
															echo "<option value='{$pro['kd_brg']}'
																									data-harga='{$pro['hrg_pcs']}'
																									data-pcs='{$pro['Pcs']}'
																									data-renteng='{$pro['Renteng']}'
																									data-pak='{$pro['Pak']}'
																									data-ikat='{$pro['ikat']}'
																									data-ball='{$pro['Ball']}'
																									data-box='{$pro['Box']}'
																									data-dus='{$pro['Dus']}'>
																									{$pro['kd_brg']} - {$pro['nama']}
																					</option>";
														}
														?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <label>Kode Barang</label>
                        <input type="text" class="form-control kode_account" name="kd_acc[]" placeholder="Autofill by Account" readonly>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" class="form-control nama_account" name="uraian[]" placeholder="Autofill by Account" readonly>
                    </div>
                </div>
                <div class="col-lg-1">
                    <div class="form-group">
                        <label>Satuan</label>
                        <select name="satuan[]" class="form-control satuan-select">
                            <option value="pcs">Pcs</option>
                            <option value="renteng">Renteng</option>
                            <option value="pak">Pak</option>
                            <option value="ikat">Ikat</option>
                            <option value="ball">Ball</option>
                            <option value="box">Box</option>
                            <option value="dus">Dus</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <label>Isi </label>
                        <input type="text" class="form-control total_pcs" readonly>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <label>Jumlah</label>
                        <input type="text" name="jumlah[]" class="form-control jumlah-input" placeholder="Masukan Jumlah" required>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <label>Jumlah Total</label>
                        <input type="text" name="jumlah_pcs[]" class="form-control hasil_perkalian" readonly>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <label>Harga</label>
                        <input type="text" name="harga[]" class="form-control harga-input" placeholder="Masukan Harga" required>
                    </div>
                </div>
                <div class="col-lg-1 d-flex align-items-center">
                    <button type="button" class="btn btn-danger btn-sm remove-form">Hapus</button>
                </div>
            </div>
            <hr>
        `;





														var newFormElement = document.createElement('div');
														newFormElement.innerHTML = newFormFieldsHtml;
														newFormContainer.appendChild(newFormElement);

														if (!formFooter.classList.contains('initialized')) {
															formFooter.style.display = 'block';
															formFooter.classList.add('initialized');
														}

														$(newFormElement).find('.select2').select2({
															theme: 'bootstrap4'
														});

														$(newFormElement).find('select[name="kd_acc2[]"]').on('change', function() {
															var selectedOption = $(this).find('option:selected');
															var kdBrg = selectedOption.val().trim();
															var namaBrg = selectedOption.text().split(' - ')[1].trim();

															$(this).closest('.row').find('.kode_account').val(kdBrg);
															$(this).closest('.row').find('.nama_account').val(namaBrg);
														});


														// Format harga input
														$(newFormElement).find('.harga-input').on('input', function(e) {
															let inputVal = e.target.value.replace(/[^,\d]/g, '');
															e.target.value = new Intl.NumberFormat('id-ID').format(inputVal);
														});

														$(newFormElement).find('.remove-form').on('click', function() {
															$(this).closest('.row').remove();
															if (newFormContainer.children.length === 0) {
																formFooter.style.display = 'none';
															}
														});
													});

													$('#newFormContainer').on('change', '.satuan-select', function() {
														updateTotalPcs($(this).closest('.row'));
													});

													$('#newFormContainer').on('input', '.jumlah-input', function() {
														updateHasilPerkalian($(this).closest('.row'));
													});

													function updateTotalPcs(row) {
														var satuan = row.find('.satuan-select').val();
														console.log(satuan);
														var totalPcs = row.find('select[name="kd_acc2[]"]').find('option:selected').data(satuan);
														console.log(totalPcs);

														row.find('.total_pcs').val(totalPcs + ' Pcs');
														updateHasilPerkalian(row);
													}

													function updateHasilPerkalian(row) {
														var totalPcs = parseFloat(row.find('.total_pcs').val()) || 0;
														var jumlah = parseFloat(row.find('.jumlah-input').val()) || 0;
														var hasilPerkalian = totalPcs * jumlah;
														row.find('.hasil_perkalian').val(hasilPerkalian + ' Pcs');
													}

													$(function() {
														$('.select2').select2({
															theme: 'bootstrap4'
														});
													});
												</script>



												<!-- <a href="route/<?php echo $data; ?>/<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=proses-sph&id=<?php echo $_GET['id']; ?>"><button class="btn btn-success btn-xs pull-right  elevation-1" style="opacity: .7">Submit ...</button></a>
													<div style="margin:10px"></div>												
													<br><br> -->
												<?php

												?>



												<!-- end tambah keterngan utk Proses .....-->
												<div class="row">
													<div class="col-lg-6">

														<button class="btn btn-primary btn-sm elevation-2 " style="opacity: .7;" onclick="window.location='main.php?route=<?php echo $rute; ?>&id=<?php echo $id; ?>&act='"> Back</button>

													</div>
													<div class="col-lg-6" style="text-align:right">


													</div>
												</div>

											</div>
											<hr>


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

			$sql = mysqli_query($koneksi, "SELECT * from $tabel2 
						where $ff1='$_GET[id]' AND $ff2='$_GET[id2]'  ");
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