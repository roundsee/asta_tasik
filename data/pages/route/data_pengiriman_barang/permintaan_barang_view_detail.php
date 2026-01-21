<?php

$judulform = "Permintaan Barang";

$data = 'data_pengiriman_barang';
$rute = 'pengiriman_barang';
$aksi = 'aksi_pengiriman_barang';
$view = 'pengiriman_barang_view';
$view2 = 'permintaan_barang_view_detail';

$rute_detail = 'pengiriman_barang_detail';


$tabel = 'permintaan_barang';

// Variabel untuk nama kolom tabel permintaan_barang
$f1 = 'kode_permintaan';
$f2 = 'kd_cus_peminta';
$f3 = 'kd_cus_pengirim';
$f4 = 'tanggal_permintaan';
$f5 = 'status_permintaan';
$f6 = 'keterangan';

// Variabel untuk label kolom
$j1 = 'Kode Permintaan';
$j2 = 'Kode Customer Peminta';
$j3 = 'Kode Customer Pengirim';
$j4 = 'Tanggal Permintaan';
$j5 = 'Status Permintaan';
$j6 = 'Keterangan';

$tabel2 = "permintaan_barang_detail";

// Variabel untuk nama kolom tabel permintaan_barang_detail
$ff1 = 'id_detail';
$ff2 = 'kode_permintaan';
$ff3 = 'kd_cus_peminta';
$ff4 = 'kd_barang';
$ff5 = 'nama_barang';
$ff6 = 'qty_diajukan';
$ff7 = 'qty_terkirim';
$ff8 = 'qty_diterima';
$ff9 = 'qty_satuan';
$ff10 = 'satuan';
$ff11 = 'harga';
$ff12 = 'urut';
$ff13 = 'status_item';

// Variabel untuk label kolom
$jj1 = 'ID Detail';
$jj2 = 'Kode Permintaan';
$jj3 = 'Kode Customer Peminta';
$jj4 = 'Kode Barang';
$jj5 = 'Nama Barang';
$jj6 = 'Quantity Permintaan';
$jj7 = 'Quantity Terkirim';
$jj8 = 'Quantity Diterima';
$jj9 = 'Quantity Satuan';
$jj10 = 'Satuan';
$jj11 = 'Harga';
$jj12 = 'Urut';
$jj13 = 'Status Item';


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

			$query = mysqli_query($koneksi, "SELECT $tabel.*  from $tabel  where $f1='$_GET[id]'");


			if (!$query) {
				$querry_message = mysqli_error($koneksi);
				echo "<script>alert('Querry gagal '.$querry_message )</script>";
			}

			$q1 = mysqli_fetch_array($query);


			$query2 = mysqli_query($koneksi, "SELECT * from $tabel2 where $ff1='$_GET[id]' ");
			$q2 = mysqli_fetch_array($query2);




			// Query untuk mendapatkan kd_cus dan nama_pelanggan berdasarkan tujuan kirim
			$query = "
			SELECT pelanggan.kd_cus, pelanggan.nama AS nama_pelanggan 
			FROM pelanggan 
			WHERE pelanggan.kd_cus IN ('" . $q1['kd_cus_pengirim'] . "', '" . $q1['kd_cus_peminta'] . "')
			";
			$result = mysqli_query($koneksi, $query);

			// Tambahkan pengecekan error pada query
			if (!$result) {
				die("Query Error: " . mysqli_error($koneksi));
			}

			// Inisialisasi array untuk menyimpan hasil
			$pelanggan = [];

			// Ambil data pengirim dan penerima
			while ($row = mysqli_fetch_assoc($result)) {
				$pelanggan[$row['kd_cus']] = $row['nama_pelanggan'];
			}

			// Cek apakah data ditemukan
			$kd_cus_pengirim = $q1['kd_cus_pengirim'];
			$kd_cus_penerima = $q1['kd_cus_peminta'];

			$nama_cus_pengirim = $pelanggan[$kd_cus_pengirim] ?? 'Tidak ditemukan';
			$nama_cus_penerima = $pelanggan[$kd_cus_penerima] ?? 'Tidak ditemukan';

			// echo "Pengirim: kd_cus = $kd_cus_pengirim, Nama = $nama_cus_pengirim <br>";
			// echo "Penerima: kd_cus = $kd_cus_penerima, Nama = $nama_cus_penerima";



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
														<form method="POST" action="route/<?php echo $data; ?>/<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=edit&id=<?php echo $q1[$f1]; ?>" enctype="multipart/form-data">

															<div class="row">

																<!-- Nomor Pengiriman -->
																<div class="col-lg-4">
																	<div class="form-group">
																		<label>Kode Permintaan</label>
																		<input type="text" name="<?php echo $f1; ?>" class="form-control" value="<?php echo $id; ?>" readonly />
																	</div>
																</div>

																<!-- Tanggal Permintaan -->
																<div class="col-lg-4">
																	<div class="form-group">
																		<label>Tanggal Permintaan</label>
																		<input type="date" name="<?php echo $f2; ?>" class="form-control" value="<?php echo date('Y-m-d'); ?>" readonly />
																	</div>
																</div>

																<!-- Tanggal Dikirim -->
																<!-- <div class="col-lg-4">
																	<div class="form-group">
																		<label>Tanggal Dikirim</label>
																		<input type="date" name="<?php echo $f3; ?>" class="form-control" value="<?php echo $tgl_dikirim; ?>" readonly />
																	</div>
																</div> -->
															</div>
															<div class="row">

																<!-- Kode Pengirim -->
																<div class="col-lg-4">
																	<div class="form-group">
																		<label>Kode Pengirim</label>
																		<input type="text" name="<?php echo $f4; ?>" class="form-control" value="<?php echo $kd_cus_pengirim . ' - ' . $nama_cus_pengirim; ?>" readonly />
																	</div>
																</div>

																<!-- Kode Penerima -->
																<div class="col-lg-4">
																	<div class="form-group">
																		<label>Kode Penerima</label>
																		<input type="text" name="<?php echo $f5; ?>" class="form-control" value="<?php echo $kd_cus_penerima . '- ' . $nama_cus_penerima; ?>" readonly />
																	</div>
																</div>

																<!-- Status Transfer -->
																<div class="col-lg-4">
																	<div class="form-group">
																		<label>Status Transfer Barang</label>
																		<select name="<?php echo $f5; ?>" class="form-control" disabled>
																			<option value="1" <?= ($f5 == 1) ? 'selected' : ''; ?>>Proses</option>
																			<option value="2" <?= ($f5 == 2) ? 'selected' : ''; ?>>Selesai</option>
																			<option value="0" <?= ($f5 == 0) ? 'selected' : ''; ?>>Proses</option>
																		</select>
																	</div>
																</div>

															</div>

													</div> <!-- col-lg-7 -->


													<div class="col-lg-3">
														<div class="form-group">
														</div>
													</div>
													</form>
												</div>

												<hr>

												<table id="example1" width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-bordered table-striped">
													<thead style="background-color: #ddd;">
														<tr style="font-weight:600">
															<td align="center"> No</td>
															<!-- <td align="left"><?php echo $jj2; ?></td> -->
															<td align="left"><?php echo $jj4; ?></td>
															<td align="left"><?php echo $jj5 ?></td>
															<td align="left"><?php echo $jj6; ?></td>
															<td align="left"><?php echo $jj7; ?></td>
															<td align="left"><?php echo $jj8; ?></td>
															<td align="center">Satuan</td>
															<td align="right">Status</td>
															<td align="center">Permintaan oleh</td>

														</tr>
													</thead>
													<tbody>
														<?php
														$no = 1;
														$subtotal = 0;
														$stotal = 0;
														$stotalDiajukan = 0;
														$stotalTerkirim = 0;
														$stotalDiterima = 0;
														$sql1 = mysqli_query($koneksi, "SELECT pd.*, b.nama AS nama_barang  ,employee.name_e as user_input
														from $tabel2 pd
														LEFT JOIN employee ON employee.employee_number = pd.user_input
													 	JOIN barang b ON b.kd_brg=pd.kd_barang
														where pd.kode_permintaan='$_GET[id]' 
														ORDER BY pd.user_input DESC ");

														if (!$sql1) {
															die('error' . mysqli_error($koneksi));
														}

														while ($s1 = mysqli_fetch_array($sql1)) {
															$grand_total = ($s1['harga'] *  $s1['qty_diajukan']);
															$total_price = $s1['qty_diajukan']  * $s1['harga'];
															$nilai_pjk = 0;
															$subtotal = $grand_total + $nilai_pjk;
															$stotal = $stotal + $subtotal;
															$stotalDiajukan += $s1['qty_diajukan'];
															$stotalTerkirim += $s1['qty_terkirim'];
															$stotalDiterima += $s1['qty_diterima'];
															if ($no == 1) {
																$user_input = $s1['user_input'];
															}

															if ($s1[$ff8] == $s1[$ff6]) {
																$status = 'Selesai';
															} else {
																$status = 'Proses';
															}
														?>
															<tr>
																<td align="right"><?php echo $no;
																					echo "<input type='hidden' name='id[$no]' value='$s1[$ff1]'"; ?></td>
																<!-- <td align="left"><?php echo $s1[$ff2]; ?></td> -->
																<td align="left"><?php echo $s1[$ff4]; ?></td>
																<td align="left"><?php echo $s1[$ff5]; ?></td>
																<td align="right"><?php echo number_format($s1[$ff6]); ?></td>
																<td align="right"><?php echo number_format($s1[$ff7]); ?></td>
																<td align="right"><?php echo number_format($s1[$ff8]); ?></td>
																<td align="left"><?php echo $s1['satuan']; ?></td>
																<td align="left"><?php echo $status; ?></td>
																<td align="center"><?php echo $user_input; ?></td>
															</tr>

														<?php
															$no++;
														}
														?>
													</tbody>
													<tfoot>
														<tr style="font-weight:600">
															<td colspan="3" align="right">T o t a l</td>
															<td align="right"><?php echo number_format($stotalDiajukan); ?></td>
															<td align="right"><?php echo number_format($stotalTerkirim); ?></td>
															<td align="right"><?php echo number_format($stotalDiterima); ?></td>
															<td colspan="2"></td>
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
														<!-- <button id="addFormButton" type="button" class="btn btn-primary btn-sm elevation-2" style="opacity: .7;">
															<i class="fa fa-plus"></i> Tambah
														</button> -->
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
													
																		<input type="hidden" name="kd_po" class="form-control" value="<?php echo $kd_po; ?>" readonly />
															

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
																							data-pcs='{$pro['qty_satuan1']}'
																							data-renteng='{$pro['qty_satuan2']}'
																							data-pak='{$pro['qty_satuan3']}'
																							data-ikat='{$pro['qty_satuan4']}'
																							data-ball='{$pro['qty_satuan5']}'
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
																			<label>Isi</label>
																			<input type="text" class="form-control" name="total_pcs[]" readonly>
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
																			<input type="text" class="form-control" name="hasil_perkalian[]" readonly>
																		</div>
																	</div>
																	<div class="col-lg-2">
																		<div class="form-group">
																			<label>Harga</label>
																			<input type="text" name="harga[]" class="form-control harga-input" placeholder="Masukan Harga" required>
																		</div>
																	</div>
																	<div class="col-lg-2">
																		<div class="form-group">
																			<label>Diskon</label>
																			<input type="text" name="diskon[]" class="form-control diskon-input" placeholder="Masukan Diskon" required>
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
															var selectedAcc = selectedOption.val(); // Get the selected value directly
															var totalPcsValue = $('input[name="total_pcs[]"]').val().trim();

															var kdBrg = selectedOption.val().trim();
															console.log('Kode barangnya adalah ' + kdBrg);

															// Find the satuan select within the same row as the changed kd_acc2
															var $satuanSelect = $(this).closest('.row').find('select[name="satuan[]"]');
															if (totalPcsValue != null) {
																$.ajax({
																	url: './route/data_beli/get_satuan.php',
																	type: 'POST',
																	data: {
																		id: selectedAcc
																	},
																	success: function(data) {
																		console.log('Raw response:', data); // Log the raw response

																		try {
																			// Assuming `data` is a valid JSON array
																			var options = data; // Parse the JSON response
																			$satuanSelect.empty(); // Clear existing options
																			$satuanSelect.append('<option value="">Pilih Satuan</option>'); // Add placeholder option

																			// Loop through the options returned from the server and add them to the 'satuan[]' select element
																			for (var i = 0; i < options.length; i++) {
																				$satuanSelect.append('<option value="' + options[i].value + '">' + options[i].text + '</option>');
																			}
																		} catch (e) {
																			console.error('Parsing error:', e); // Handle JSON parsing errors
																			alert('Error parsing response data. Check console for details.');
																		}
																	},
																	error: function() {
																		alert('Error retrieving data.'); // Handle AJAX request errors
																	}
																});
															}

															var namaBrg = selectedOption.text().split(' - ')[1].trim();

															// Set the values for kode_account and nama_account in the same row
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
														var selectedOption = row.find('select[name="kd_acc2[]"]').find('option:selected');
														var satuan = row.find('select[name="satuan[]"]').val();
														var totalPcs = selectedOption.data(satuan) || 0;

														row.find('input[name="total_pcs[]"]').val(totalPcs);
														updateHasilPerkalian(row);
													}

													function updateHasilPerkalian(row) {
														var totalPcs = parseFloat(row.find('input[name="total_pcs[]"]').val()) || 0;
														var jumlah = parseFloat(row.find('input[name="jumlah[]"]').val()) || 0;

														var hasilPerkalian = totalPcs * jumlah;
														row.find('input[name="hasil_perkalian[]"]').val(hasilPerkalian);
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
			<!-- Tambahkan script untuk menangani event perubahan -->
			<script>
				document.getElementById('pilihan').addEventListener('change', function() {
					var ppnValue = this.value;
					var ppnOptions = document.getElementById('ppn-options');

					if (ppnValue === '1') {
						// Tampilkan dropdown jenis PPN jika opsi PPN dipilih
						ppnOptions.style.display = 'block';
					} else {
						// Sembunyikan dropdown jenis PPN jika opsi Non PPN dipilih
						ppnOptions.style.display = 'none';
					}
				});
			</script>


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
																	<input type="text" name="<?php echo $ff3; ?>" class="form-control" value="<?php echo $s1[$ff3] * $s1[$ff_31]; ?>" readonly />
																</div>

															</div>

															<div class="col-lg-4">
																<div class="form-group">
																	<label><?php echo $jj3; ?></label>
																	<input type="text" name="<?php echo $ff3; ?>" class="form-control" value="<?php echo $s1[$ff3] * $s1[$ff_31]; ?>" autofocus="" />
																</div>
															</div>

															<div class="col-lg-2">
																<div class="form-group">
																	<label><?php echo $jj4; ?></label>
																	<input type="text" name="<?php echo $ff4; ?>" class="form-control" value="<?php echo $s1[$ff4]; ?>" autofocus="" />
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<label><?php echo $jj7; ?></label>
																	<input type="text" name="<?php echo $ff7; ?>" class="form-control" value="<?php echo $s1[$ff7]; ?>" autofocus="" />
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