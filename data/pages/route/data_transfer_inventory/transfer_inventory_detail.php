<?php

$judulform = "Transfer inventory";

$data = 'data_transfer_inventory';
$rute = 'transfer_inventory';
$aksi = 'aksi_transfer_inventory';
$view = 'transfer_inventory_view';

$rute_detail = 'transfer_inventory_detail';
$tabel = 'transfer_inventory';

// Variabel untuk nama kolom tabel transfer_inventory
$f1 = 'nomor_pengiriman';
$f2 = 'tgl_permintaan';
$f3 = 'tgl_dikirim';
$f4 = 'kd_pengirim';
$f5 = 'kd_penerima';
$f6 = 'status_transfer';

// Variabel untuk label kolom
$j1 = 'Nomor Pengiriman';
$j2 = 'Tanggal Permintaan';
$j3 = 'Tanggal Dikirim';
$j4 = 'Kode Pengirim';
$j5 = 'Kode Penerima';
$j6 = 'Status Transfer';

$tabel2 = 'transfer_inventory_detail';

// Variabel untuk nama kolom tabel transfer_inventory_detail
$ff1 = 'nomor_pengiriman';
$ff2 = 'kd_brg';
$ff3 = 'jml';
$ff4 = 'jumlah_pcs';
$ff5 = 'jumlah_datang';
$ff6 = 'harga';
$ff7 = 'disc';
$ff8 = 'satuan';
$ff9 = 'urut';

// Variabel untuk label kolom
$jj1 = 'Nomor Pengiriman';
$jj2 = 'Kode Barang';
$jj3 = 'Jumlah';
$jj4 = 'Jumlah PCS';
$jj5 = 'Jumlah Datang';
$jj6 = 'Harga';
$jj7 = 'Diskon';
$jj8 = 'Satuan';
$jj9 = 'Urut';
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
WHERE pelanggan.kd_cus IN ('" . $q1['kd_pengirim'] . "', '" . $q1['kd_penerima'] . "')
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
			$kd_cus_pengirim = $q1['kd_pengirim'];
			$kd_cus_penerima = $q1['kd_penerima'];

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
									<b><?php echo $judulform; ?></b> <small>edit</small>
								</h1>
							</div>
							<div class="col-sm-6">
								<ol class="breadcrumb float-sm-right">
									<li class="breadcrumb-item"><a href="main.php?route=home">Beranda</a></li>
									<li class="breadcrumb-item active"><a href="main.php?route=<?php echo $rute; ?>&act"><?php echo $judulform; ?></a></li>
									<li class="breadcrumb-item active"> edit</li>
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

																<div class="col-lg-4">
																	<div class="form-group">
																		<label><?php echo $j1; // Nomor Pengiriman 
																				?></label>
																		<input type="text" name="<?php echo $f1; ?>" class="form-control" value="<?php echo $id; ?>" readonly />
																	</div>
																</div>

																<div class="col-lg-4">
																	<div class="form-group">
																		<label><?php echo $j2; // Tanggal Permintaan 
																				?></label>
																		<input type="date" name="<?php echo $f2; ?>" class="form-control" value="<?php echo $q1['tgl_permintaan']; ?>" />
																	</div>
																</div>

																<div class="col-lg-4">
																	<div class="form-group">
																		<label><?php echo $j3; // Tanggal Dikirim 
																				?></label>
																		<input type="date" name="<?php echo $f3; ?>" class="form-control" value="<?php echo $tgl_dikirim; ?>" readonly />
																	</div>
																</div>

																<div class="col-lg-6">
																	<div class="form-group">
																		<label><?php echo 'Tujuan Kirim'; // Kode Pengirim 
																				?></label>
																		<select name="<?php echo $f5; ?>" class="form-control">
																			<option value="">Tujuan Kirim </option>
																			<?php
																			// Ambil nilai tujuan kirim yang sudah ada di database
																			$tujuan_terpilih = $q1['kd_penerima'] ?? '';

																			// Ambil data gudang dari database dan buat opsi dropdown
																			$query = mysqli_query($koneksi, "SELECT kd_cus, nama, alamat FROM pelanggan WHERE kd_cus != '0000'");
																			while ($x = mysqli_fetch_assoc($query)) {
																				// Tentukan apakah opsi ini yang terpilih
																				$selected = ($x['kd_cus'] == $tujuan_terpilih) ? 'selected' : '';
																				// Cetak opsi dropdown dengan nilai dan nama gudang
																				echo "<option value='{$x['kd_cus']}' $selected>{$x['kd_cus']} - {$x['nama']}</option>";
																			}
																			?>
																		</select>
																	</div>
																</div>

																<div class="col-lg-4">
																	<label>Permintaan Kepada</label>
																	<select class="form-control" name="<?= $f4; ?>" id="">
																		<option value="">Permintaan Kepada</option>
																		<?php
																		// Ambil nilai tujuan kirim yang sudah ada di database
																		$tujuan_terpilih = $q1['kd_pengirim'] ?? '';

																		// Ambil data gudang dari database dan buat opsi dropdown
																		$query = mysqli_query($koneksi, "SELECT kd_cus, nama, alamat FROM pelanggan WHERE kd_cus != '0000'");
																		while ($x = mysqli_fetch_assoc($query)) {
																			// Tentukan apakah opsi ini yang terpilih
																			$selected = ($x['kd_cus'] == $tujuan_terpilih) ? 'selected' : '';
																			// Cetak opsi dropdown dengan nilai dan nama gudang
																			echo "<option value='{$x['kd_cus']}' $selected>{$x['kd_cus']} - {$x['nama']}</option>";
																		}
																		?>
																	</select>
																</div>

																<div class="col-lg-4">
																	<div class="form-group">
																		<label><?php echo $j6; // Status Transfer 
																				?></label>
																		<select name="<?php echo $f6; ?>" class="form-control" disabled>
																			<?php
																			$status_transfer = [
																				'0' => 'Proses',
																				'1' => 'Selesai'

																			];
																			foreach ($status_transfer as $key => $value) {
																				$selected = ($q1['status_transfer'] == $key) ? 'selected' : '';
																				echo "<option value='$key' $selected>$value</option>";
																			}
																			?>
																		</select>

																	</div>
																</div>

															</div> <!-- row -->
															<div class="col-lg-4">
																<div class="form-group">
																	<button type="submit" class="btn btn-primary elevation-2 mr-4" style="opacity: .7;">Simpan</button>
																</div>
															</div>

													</div> <!-- col-lg-7 -->



													</form>
												</div>

												<hr>

												<table id="example1" width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-bordered table-striped">
													<thead style="background-color: #ddd;">
														<tr style="font-weight:600">
															<td align="center" width="40px">No</td>
															<td align="left" width="120px"><?php echo $jj2; ?></td>
															<td align="left" width="240px">Nama Barang</td>
															<td align="left" width="240px"><?php echo $jj3; ?></td>
															<td align="center" width="100px">Satuan</td>
															<td align="right" width="100px">Harga</td>
															<td align="right" width="100px">Sub Total</td>
															<!-- <td align="right" width="100px">Diskon</td>
															<td align="right" width="100px">Ppn</td> -->
															<td align="right" width="100px">Total</td>
															<td align="center" style="min-width:60px;width: 80px;">Aksi</td>
														</tr>
													</thead>
													<tbody>
														<?php
														$no = 1;
														$subtotal = 0;
														$stotal = 0;
														$sql1 = mysqli_query($koneksi, "SELECT pd.*, b.nama AS nama_barang from $tabel2 pd
														JOIN barang b ON b.kd_brg=pd.kd_brg
													   JOIN transfer_inventory ON transfer_inventory.nomor_pengiriman = pd.nomor_pengiriman
													   where pd.nomor_pengiriman='$_GET[id]' ");

														if (!$sql1) {
															die('error' . mysqli_error($koneksi));
														}

														while ($s1 = mysqli_fetch_array($sql1)) {
															$grand_total = ($s1['harga'] * $s1[$ff3]) - $s1[$ff7];
															$total_price = $s1[$ff3] * $s1['harga'];



															$nilai_pjk = 0;

															$subtotal = $grand_total + $nilai_pjk;
															$stotal = $stotal + $subtotal;

														?>
															<tr>
																<td align="right"><?php echo $no;
																					echo "<input type='hidden' name='id[$no]' value='$s1[$ff1]'"; ?></td>
																<td align="left"><?php echo $s1[$ff2]; ?></td>
																<td align="left"><?php echo $s1['nama_barang']; ?></td>
																<td align="right"><?php echo number_format($s1[$ff3]); ?></td>
																<td align="center"><?php echo $s1['satuan']; ?></td>
																<td align="right"><?php echo number_format($s1['harga']); ?></td>
																<td align="right"><?php echo number_format($total_price); ?></td>
																<!-- <td align="right"><?php echo number_format($s1[$ff7]); ?></td>
																<td align="right"><?php echo number_format($nilai_pjk); ?></td> -->
																<td align="right"><?php echo number_format($subtotal); ?></td>
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
															<td colspan="7" align="right">T o t a l</td>
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
														<button type="submit" id="save-detail" class="btn btn-success btn-xs pull-right elevation-1" style="opacity: .7;">Save</button>
													</div>
												</form>
												<div style="margin:10px"></div>
												<br><br>

												<script>
													// $('#save-detail').hide()
													document.getElementById('addFormButton').addEventListener('click', function() {
														$('#formFooter').show();
														var formFooter = document.getElementById('formFooter');
														var newFormContainer = document.getElementById('newFormContainer');

														var newFormFieldsHtml = `
																<div class="row border-bottom">
																	${newFormContainer.children.length === 0 ? `
																	<div class="col-12">
																		<div class="form-group mt-2">
																			<h5>Data Detail</h5>
																		</div>
																	</div>` : ''
																	}
													
																		<input type="hidden" name="kd_po" class="form-control" value="<?php echo $kd_po; ?>" readonly />
															

																	<div class="col-lg-3 ">
																		<div class="form-group">
																			<label for="">Barang</label>
																			<select name="kd_acc2[]" class="form-control select2" style="width:100%;" required>
																				<option></option>
																				<?php
																				$kdSupp = $q1['kd_supp'];
																				$produk = mysqli_query($koneksi, "SELECT * FROM barang b ");
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
																			<select name="satuan[]" class="form-control satuan-select" required>
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
																			<label>Isi (PCS)</label>
																			<input type="text" class="form-control" name="total_pcs[]" readonly>
																		</div>
																	</div>
																	<div class="col-lg-2">
																		<div class="form-group">
																			<label>Banyak</label>
																			<input type="text" data-format = "currency" name="jumlah[]" class="form-control jumlah-input" placeholder="Masukan Jumlah" required>
																		</div>
																	</div>
																	<div class="col-lg-2">
																		 <div class="form-group">
																			<label>Banyak Total (PCS)</label>
																			<input type="text" class="form-control" name="hasil_perkalian[]" readonly>
																		</div>
																	</div>
																	<div class="col-lg-2">
																		<div class="form-group">
																			<label>Harga Satuan</label>
																			<input type="text" name="harga[]"  data-format = "currency" class="form-control harga-input" placeholder="Masukan Harga" required value = 0>
																		</div>
																	</div>
																	<div class="col-lg-2">
																		<div class="form-group">
																			<label>Harga Total</label>
																			<input type="text" name="hargaTotal[]"  data-format = "currency" class="form-control harga-input" placeholder="Masukan Harga" required value = 0>
																		</div>
																	</div>
																    <div class="col-lg-2">
																		<div class="form-group">
																			<label>Diskon</label>
																			<input type="text" class="form-control diskon" data-format="currency"  name="diskon[]" placeholder="Masukan  diskon" required value = 0>
																		</div>
																	</div>
																	<div class="col-lg-1 d-flex align-items-center">
																		<button type="button" class="btn btn-danger btn-sm remove-form">Hapus</button>
																	</div>
																</div>
																
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


														// // Format harga input
														// $(newFormElement).find('.harga-input').on('input', function(e) {
														// 	let inputVal = e.target.value.replace(/[^,\d]/g, '');
														// 	e.target.value = new Intl.NumberFormat('id-ID').format(inputVal);
														// });


														$(newFormElement).find('.remove-form').on('click', function() {
															// Menghapus baris yang sesuai
															$(this).closest('.row').remove();
															console.log('Element removed. Remaining rows:', $('#newFormContainer .row').length);

															// Memeriksa jumlah baris yang tersisa
															if ($('#newFormContainer .row').length === 0) {
																console.log('No more rows, showing #save-detail');
																// $('#save-form').hide(); 
																$('#formFooter').hide(); // Menyembunyikan footer
																$('#hr').hide(); // Menyembunyikan footer
															}
														});



														// $(newFormElement).find('.remove-form').on('click', function() {
														// 	$(this).closest('.row').remove();
														// 	if (newFormContainer.children.length === 0) {
														// 		formFooter.style.display = 'none';
														// 	}
														// });
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

														// Ambil nilai jumlah dan hapus format rupiah (titik atau koma)
														var jumlah = row.find('input[name="jumlah[]"]').val();
														jumlah = jumlah.replace(/[.,]/g, ''); // Menghilangkan titik dan koma

														// Konversi jumlah menjadi angka desimal
														jumlah = parseFloat(jumlah) || 0;

														var hasilPerkalian = totalPcs * jumlah;
														console.log("hasil perkalian nyaa/ jumlah totalnya ", hasilPerkalian);
														row.find('input[name="hasil_perkalian[]"]').val(hasilPerkalian);
													}


													document.addEventListener('input', function(event) {
														const row = event.target.closest('.row');
														if (!row) return;

														// Ambil elemen input terkait
														const jumlahInput = row.querySelector('input[name="jumlah[]"]');
														const hargaSatuanInput = row.querySelector('input[name="harga[]"]');
														const hargaTotalInput = row.querySelector('input[name="hargaTotal[]"]');

														// Fungsi untuk parsing dan formatting currency
														const parseCurrency = (value) => parseFloat(value.replace(/[.,]/g, '') || 0);
														const formatCurrency = (value) =>
															new Intl.NumberFormat('id-ID', {
																minimumFractionDigits: 0,
																maximumFractionDigits: 0,
															}).format(value);

														// Jika input yang berubah adalah Harga Satuan atau Jumlah
														if (event.target === hargaSatuanInput || event.target === jumlahInput) {
															const jumlah = parseCurrency(jumlahInput.value);
															const hargaSatuan = parseCurrency(hargaSatuanInput.value);

															// Hitung Harga Total
															const hargaTotal = jumlah * hargaSatuan;
															hargaTotalInput.value = formatCurrency(hargaTotal);
														}

														// Jika input yang berubah adalah Harga Total
														if (event.target === hargaTotalInput) {
															const jumlah = parseCurrency(jumlahInput.value);
															const hargaTotal = parseCurrency(hargaTotalInput.value);

															// Hitung Harga Satuan
															const hargaSatuan = jumlah > 0 ? hargaTotal / jumlah : 0;
															hargaSatuanInput.value = formatCurrency(hargaSatuan);
														}
													});





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
			<script type="text/javascript">
				// Fungsi untuk memformat input menjadi format ribuan tanpa "Rp"
				function formatCurrency(inputElement) {
					let input = inputElement.value.replace(/[^,\d]/g, ''); // Menghapus karakter non-digit
					let formattedInput = new Intl.NumberFormat('id-ID', {
						style: 'currency',
						currency: 'IDR',
						minimumFractionDigits: 0
					}).format(input);

					// Mengupdate nilai input dengan format rupiah tanpa "Rp"
					inputElement.value = formattedInput.replace('Rp', '').trim();
				}

				// Event delegation untuk elemen dengan atribut data-format="currency"
				document.addEventListener('input', function(e) {
					if (e.target.matches('[data-format="currency"]')) {
						formatCurrency(e.target);
					}
				});


				// Menghapus format saat submit form
				document.querySelector('#inputDetailForm').addEventListener('submit', function(e) {
					const diskonInputs = document.querySelectorAll('.diskon');

					diskonInputs.forEach((input) => {
						input.value = input.value.replace(/\./g, ''); // Hapus titik sebelum submit
					});

					console.log(diskonInputs);
				});






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
						where $ff1='$_GET[id]' AND $ff2='$_GET[id2]' AND $ff8 = '$_GET[id3]' ");
			$s1 = mysqli_fetch_array($sql);
			$sql2 = mysqli_query($koneksi, "SELECT * from barang 
						where  $ff2='$_GET[id2]'  ");
			$s2 = mysqli_fetch_array($sql2)

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
																	<input type="text" id="kd_acc" name="<?php echo $ff2; ?>" class="form-control" value="<?php echo $s1[$ff2]; ?>" readonly />
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<label>Nama Barang</label>
																	<input type="text" id="" name="nama_barang" class="form-control" value="<?php echo $s2['nama']; ?>" readonly />
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-lg-2">
																<div class="form-group">
																	<label><?php echo $jj3; ?> Sekarang</label>
																	<input type="text" name="<?php echo $ff3; ?>" class="form-control" value="<?php echo $s1[$ff3]; ?>" readonly />
																</div>
															</div>


															<div class="col-lg-2">
																<div class="form-group">
																	<label>Satuan</label>
																	<select name="<?php echo $ff8; ?>" id="satuan" class="form-control" required>
																		<!-- Menampilkan satuan default dari PHP -->
																		<option value="<?php echo $s1['satuan']; ?>" selected>
																			<?php echo $s1['satuan'] ? $s1['satuan'] : 'Pilih Satuan'; ?>
																		</option>
																		<!-- Pilihan akan diisi otomatis melalui AJAX -->
																	</select>
																</div>
															</div>

															<div class="col-lg-2">
																<div class="form-group">
																	<label>Isi (PCS)</label>
																	<input type="text" class="form-control" data-format="currency" name="isi" readonly>
																	<input type="hidden" name="isi_hidden">
																</div>
															</div>

															<div class="col-lg-2">
																<div class="form-group">
																	<label>Banyak</label>
																	<input type="text" id="banyak" name="<?php echo $ff3; ?>" class="form-control currency-input"
																		data-format="currency"
																		data-value="<?php echo $s1[$ff3]; ?>"
																		value="<?php echo number_format($s1[$ff3], 0, ',', '.'); ?>"
																		autofocus="">
																</div>
															</div>
															<div class="col-lg-2">
																<div class="form-group">
																	<label>Banyak Total (PCS)</label>
																	<input type="text" class="form-control" data-format="currency" name="" id="banyakTotal" readonly>
																</div>
															</div>
														</div>
														<div class="row">


															<div class="col-lg-2">
																<div class="form-group">
																	<label>Harga Satuan</label>
																	<input type="text" id="hargaSatuan" name="<?php echo $ff6; ?>" class="form-control currency-input"
																		data-format="currency"
																		data-value="<?php echo $s1[$ff6]; ?>"
																		value="<?php echo number_format($s1[$ff6], 0, ',', '.'); ?>"
																		autofocus="">
																</div>
															</div>

															<div class="col-lg-2">
																<div class="form-group">
																	<label>Harga Total</label>
																	<input type="text" id="hargaTotal" name="hargaTotal" class="form-control currency-input"
																		data-format="currency"
																		data-value="<?php echo $s1[$ff6] * $s1[$ff3]; ?>"
																		value="<?php echo number_format($s1[$ff6] * $s1[$ff3], 0, ',', '.'); ?>"
																		autofocus="">
																</div>
															</div>

															<div class="col-lg-2">
																<div class="form-group">
																	<label><?php echo $jj7; ?></label>
																	<input type="text" name="<?php echo $ff7; ?>" class="form-control currency-input" data-format="currency" data-value="<?php echo $s1[$ff7]; ?>" value="<?php echo number_format($s1[$ff7], 0, ',', '.'); ?>" autofocus="">
																</div>
															</div>
														</div>



														<hr />

														<div class="form-group">
															<button type="submit" id="submitBtn" class="btn btn-primary elevation-2" style="opacity: .7">Simpan Perubahan</button>
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
				$(document).ready(function() {
					// Fungsi untuk menghapus format currency dan mengembalikan angka
					function parseCurrency(value) {
						return parseFloat(value.replace(/[.,]/g, '') || 0);
					}

					// Fungsi untuk memformat angka menjadi currency
					function formatCurrency(value) {
						return new Intl.NumberFormat('id-ID', {
							minimumFractionDigits: 0,
							maximumFractionDigits: 0
						}).format(value);
					}

					// Fungsi untuk format rupiah dan menyimpan nilai asli di data-value
					function applyCurrencyFormat(inputElement) {
						let input = inputElement.value.replace(/[^0-9]/g, '');
						inputElement.setAttribute('data-value', input);
						let formattedInput = new Intl.NumberFormat('id-ID', {
							style: 'currency',
							currency: 'IDR',
							minimumFractionDigits: 0
						}).format(input);
						inputElement.value = formattedInput.replace('Rp', '').trim();
					}

					// Event listener untuk memformat saat input diisi
					$(document).on('input', '[data-format="currency"]', function(e) {
						applyCurrencyFormat(this);
					});

					// Event listener saat form disubmit untuk mengirim nilai numerik asli
					$('form').on('submit', function(e) {
						$('[data-format="currency"]').each(function() {
							$(this).val($(this).attr('data-value'));
						});
					});

					// Event listener untuk tombol submit
					$('#submitBtn').on('click', function(e) {
						var isiPcsValue = $('input[name="isi"]').val();

						if (!isiPcsValue || isiPcsValue.trim() === '') {
							alert('Silakan pilih satuannya kembali sebelum menyimpannya.');
							e.preventDefault();
							return false;
						}
					});

					// Mendapatkan nilai dari elemen #kd_acc
					var kdAccValue = $('#kd_acc').val();

					if (kdAccValue) {
						// AJAX untuk mendapatkan data satuan dari server
						$.ajax({
							url: 'route/data_beli/get_satuan.php',
							type: 'POST',
							data: {
								id: kdAccValue
							},
							dataType: 'json',
							success: function(data) {
								console.log('Raw response:', data);

								if (Array.isArray(data) && data.length > 0) {
									var defaultSatuan = "<?php echo $s1['satuan']; ?>";
									$('#satuan').empty();

									if (defaultSatuan) {
										$('#satuan').append('<option value="' + defaultSatuan + '" selected>' + defaultSatuan + '</option>');
									}

									data.forEach(function(option) {
										$('#satuan').append('<option value="' + option.value + '">' + option.text + '</option>');
									});

									// Setelah mengisi dropdown, update 'Isi (PCS)'
									updateIsiPcs(data);
								} else {
									alert('Tidak ada satuan tersedia untuk barang ini.');
								}
							},
							error: function(xhr, status, error) {
								console.error('AJAX Error:', status, error);
								alert('Gagal mengambil data satuan dari server.');
							}
						});
					} else {
						alert('Kode akun tidak tersedia.');
					}

					// AJAX untuk mendapatkan data 'Isi (PCS)' dari server
					if (kdAccValue) {
						$.ajax({
							url: 'route/data_beli/get_isi.php',
							type: 'POST',
							data: {
								id: kdAccValue
							},
							dataType: 'json',
							success: function(data) {
								updateIsiPcs(data);

								$('#satuan').on('change', function() {
									updateIsiPcs(data);
									updateBanyakTotal();
									updateHargaTotal(); // Pastikan harga total diperbarui saat satuan berubah
								});

								$('#banyak').on('input', function() {
									updateBanyakTotal();
									updateHargaTotal(); // Pastikan harga total diperbarui saat banyak berubah
								});

								$('#hargaSatuan').on('input', function() {
									updateHargaTotal();
								});

								$('#hargaTotal').on('input', function() {
									updateHargaSatuan();
								});
							},
							error: function(xhr) {
								alert('Gagal mengambil data satuan');
							}
						});
					} else {
						alert('Kode akun tidak tersedia.');
					}

					// Fungsi untuk memperbarui nilai 'Isi (PCS)' berdasarkan satuan yang dipilih
					function updateIsiPcs(data) {
						var selectedSatuan = $('#satuan').val();
						var isiValue = data[selectedSatuan] || '';
						$('input[name="isi"]').val(isiValue);
						$('input[name="isi_hidden"]').val(isiValue);
					}

					// Fungsi untuk memperbarui total banyak
					function updateBanyakTotal() {
						var isiPcs = parseCurrency($('input[name="isi"]').val());
						var banyak = parseCurrency($('#banyak').val());
						var banyakTotal = isiPcs * banyak;
						$('#banyakTotal').val(formatCurrency(banyakTotal));
						$('#banyakTotal').attr('data-value', banyakTotal); // Pastikan data-value diupdate
					}

					// Fungsi untuk memperbarui harga total
					function updateHargaTotal() {
						var hargaSatuan = parseCurrency($('#hargaSatuan').val());
						var banyakTotal = parseCurrency($('#banyak').val());
						var hargaTotal = hargaSatuan * banyakTotal;
						$('#hargaTotal').val(formatCurrency(hargaTotal));
						$('#hargaTotal').attr('data-value', hargaTotal); // Pastikan data-value diupdate
					}

					// Fungsi untuk memperbarui harga satuan berdasarkan harga total
					function updateHargaSatuan() {
						var banyak = parseCurrency($('#banyak').val());
						if (banyak > 0) {
							var hargaTotal = parseCurrency($('#hargaTotal').val());
							var hargaSatuan = hargaTotal / banyak;
							$('#hargaSatuan').val(formatCurrency(hargaSatuan));
							$('#hargaSatuan').attr('data-value', hargaSatuan); // Pastikan data-value diupdate
						} else {
							alert('Nilai "Banyak" harus lebih dari 0 untuk menghitung Harga Satuan.');
						}
					}
				});

				// format selesai



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