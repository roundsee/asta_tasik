<div class="col-lg-4 bg-white" style="height: 65px!important;min-height: 65px!important;">

	<!-- wrapper 1 -->
	<div class="wrapper bg-white">
		<div class="row">

			<div class="col-lg-5">
				<a href="#"><img src="<?php echo $dir; ?>images/steak_outline_shadow_clear.png" style="width: 150px"></a>
			</div>

			<div class="col-lg-2">
				<a href="main.php?route=profile"><img src="<?php echo $dir; ?>images/staff/<?php echo $photo; ?>" style="height: 50px"></a>
			</div>
			<div class="col-lg-5" style="text-align:end">
				<div class="form-group">
					<button type="button" class="btn-default btn tombol" onclick="open_aplikasi()" id="tombolAplikasi" style="width:140px;height: 50px;"> Pilih Aplikasi</button>
				</div>
				<input type="hidden" name="nama_aplikasi" class="input_nama_aplikasi">
				<input type="hidden" name="kd_aplikasi" class="input_kd_aplikasi">

			</div>

		</div>
	</div>
	<!-- end wrapper 1-->

	<div class="wrapper box-poly" style="height:510px!important;background-color: inherit;">
		<div class="table-responsive" style="padding:1px 10px 10 10px">
			<!-- wrapper 2-->
			<div class="wrapper bg-white " style="padding: 0px 10px 1px;margin:  5 -5 -1;">

				<div class="row" >

					<div class="col-lg-6">
						<table style="font-size:85%">
						<tr>
							<td style="width:50px">Kasir</td>
							<td>:</td>
							<td><b><?php echo $namakasir; ?></b></td>
						</tr>
						<tr>
							<td>Outlet</td>
							<td>:</td>
							<td><b><?php echo $nama_cab; ?></b></td>
						</tr>
						<tr>
							<td>Hari</td>
							<td>:</td>
							<td><b> <?php echo $hari_ini; ?></b>, <?php echo tgl_indo_short($tgl_sekarang); ?></td>
						</tr>
					</table>
					</div>

					<?php


					$kasir = sprintf("%02s", $no_kasir);

					$thn = date('y');
					$bln = date('m');
					$hari = date('d');

					$tgl_inv = $thn . $bln . $hari;
					$char = $kd_cus . '-' . $tgl_inv . '-' . $kasir;
					$kd_cus_tgl_inv = $kd_cus . '-' . $tgl_inv;

					// echo $char;
					$hasil = mysqli_query($koneksi, "SELECT faktur,max(faktur) as maxKode FROM daily_penjualan where substr(faktur,1,14) ='$char' ");
					$kp = mysqli_fetch_array($hasil);
					$kodeInvoice = $kp['maxKode'];
					// echo 'kode :'.$kodeInvoice;
					// echo "no : ";
					$noUrut = substr($kodeInvoice, 15, 4);
					if ($noUrut != "") {
						$noUrut++;
					} else {
						$noUrut = 1;
					}

					// echo 'norut ='.$noUrut;

					$noInvoice = $char . '-' . sprintf("%04s", $noUrut);

					?>

					<input type="hidden" name="no_urut" value="<?php echo $noUrut; ?>">

					<input type="hidden" name="tahun" value="<?php echo $thn; ?>">
					<input type="hidden" name="bulan" value="<?php echo $bln; ?>">
					<input type="hidden" name="no_inv" value="<?php echo $noInvoice; ?>">
					<!-- <td><input type="text" name="nilai_inv" value="<?php echo $kd_cus_tgl_inv; ?>" id='nilai_kd_cus_tgl_inv'></td> -->

					<div class="col-lg-6" style="padding-right: 1px;">
						<table style="font-size:90%">

							<tr>
								<td style="width:45px">No Inv</td>
								<td style="text-align: right;">: <input type="text" name="no_inv" id="tampil_invoice" style="width: 110px;border-style: none;margin: 2;"></td>
							</tr>
							<tr>
								<td style="width:45px!important">No Meja</td>
								<td style="text-align: right;">: <input type="text" name="no_meja" id="tampil_aplikasi_keterangan" style="width: 110px;border-style: none;margin: 2;"></td>
							</tr>
						</table>
					</div>

				</div>
			</div>
			<!-- end warpper 2 -->

			<!-- wrapper 3 a -->
			<div class="wrapper bg-white box-poly-up" style="padding: 5px 25px 5px 20px;min-height: 500px!important ;">
				<div class="row table-container">
					<div class="table-responsive table-scroll" style="height:410px;background-color: whitesmoke;width: 750px;">
						<table class="table  table-striped table-hover" id="table-pembelian" style="font-size:95%;">
							<thead style="border-style: single;background-color: lightgray;position: sticky; top: 0;">
								<tr>
									<th style="width: 30px;line-height: 1.8em;text-align: center;">Aksi</th>
									<th style="width: 100px;line-height: 1.8em;">Nama Produk</th>
									<th style="width: 10px;text-align: center;line-height: 1.8em;">Jml</th>
									<th style="width: 30px;text-align: right;line-height: 1.8em;">Harga</th>
									<th style="width: 33px;text-align: right;line-height: 1.8em;">Total</th>
									<th style="width: 20px;text-align: right;line-height: 1.8em;">Disc</th>
									<th style="width: 70px;text-align: right;line-height: 1.8em">Total Disc</th>
									<th style="width: 120px;text-align: left;line-height: 1.8em;">Ket</th>
									<th style="width: 60px;text-align: left;line-height: 1.8em;">Promo</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
							<tfoot style="position: sticky; bottom: 0;">
								<tr class="bg-info">
									<td style="text-align: right;" colspan="2"><b>Total</b></td>
									<td style="text-align: center;"><span class="pembelian_jumlah" id="0">0</span></td>
									<td></td>
									<td style="text-align: right;"><b><span class="pembelian_total" id="0">Rp.0</span></b></td>
									<td></td>
									<td style="text-align: right;"><b><span class="pembelian_total_diskon" id="0">Rp.0</span></b></td>
									<td></td>
									<td></td>
								</tr>
							</tfoot>
						</table>

					</div>

				</div>
				<div class="row">
					<div class="col-lg-3" id="form_jml" style="display:none;padding: 5 5 5 5;">
						<span class='btn btn-xs btn-info' onclick="tombol_minus()"><i class='fa fa-minus'></i></span>

						<input type="text" class="" id="tambahkan_jumlah" name="jml" style="width:30px ;border-style: none;">

						<span class='btn btn-xs btn-info' onclick="tombol_plus()"><i class='fa fa-plus'></i></span>
					</div>

					<div class="col-lg-6" id="form_ket" style="display:none">
						<input type="text" class="" id="tambahkan_ket" style="width:180px ;border-style: none;padding: 5 5 5 5" placeholder="keterangan">
					</div>
					<!-- <div class="form-group"> -->
					<div class="col-lg-3" style="height:35px">
						<?php
						include 'edit_tabel.php';
						?>
					</div>
				</div>
			</div>
			<!-- end wrapper 3a -->


			<div class="form-group">
				<!-- <label>Produk</label> -->
				<input type="hidden" class="form-control" id="tambahkan_nama" disabled>
			</div>

			<div class="form-group">
				<!-- <label>Harga</label> -->
				<input type="hidden" class="form-control" id="tambahkan_harga" disabled>
			</div>

			<div class="form-group">
				<!-- <label>Jumlah</label> -->
				<input type="hidden" class="form-control" id="tambahkan_jumlah" min="1">
			</div>

			<div class="form-group">
				<!-- <label>Total</label> -->
				<input type="hidden" class="form-control" id="tambahkan_total" disabled>
			</div>

			<div class="form-group">
				<!-- <label>Diskon</label> -->
				<input type="hidden" class="form-control" id="tambahkan_diskon" disabled>
			</div>

			<div class="form-group">
				<!-- <label>Total Diskon</label> -->
				<input type="hidden" class="form-control" id="tambahkan_total_diskon" disabled>
			</div>

			<div class="form-group">
				<!-- <label>Total Diskon</label> -->
				<!-- <input type="hidden" class="form-control" id="alatbayar" disabled> -->
			</div>
			<br/>


			<!-- wrapper 3b-->
			<div class="wrapper bg-white">

				<div class="col-lg-4 ">
					<div class="row" style="margin-left: -40px;">

						<div class="col-lg-12" style="height:80px;">

							<div class="row">
								<div class="col-lg-5">
									<div class="form-group">
										<button type="button" class="btn-default btn tombol1" style="padding-left: 4px;padding-right: 4px;background-color: skyblue;width: 95px;opacity: .8;"><a href="../../kasir_steak_b/pages/main.php?route=kasir" style="color:navy;"><i class="fa fa-toggle-left"></i> Kasir B</a></button>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-lg-7">
									<div class="form-group">
										<button type="button" class="btn-default btn tombol1" style="padding-left: 4px;padding-right: 4px;background-color: skyblue;width: 95px;opacity: .8;"><a href="../../steak/pages/main.php?route=home&to=kasir&hash=7" target="_blank" style="color:navy;"><i class="fa fa-pie-chart"></i> Laporan</a> </button>
									</div>
								</div>

							</div>
						</div>

						<div class="col-lg-12" style="height:40px; margin-top: 95px;">
							<div class="row">
								<div class="col-lg-5">
									<div class="form-group">
										<button type="button" class="btn-default btn tombol1" style="padding-left: 4px;padding-right: 4px;background-color: red;width: 95px;opacity: .7;"><a href="../../logout.php" style="color:ghostwhite;"><img src="../../assets/icons/person-leave-solid-w.png" width="20px"> Log Out</a> </button>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-8 box-poly" style="padding:10 10 5 14">
					<table class="table table-striped" style="padding-bottom: 1px;padding-bottom: 1px;font-size: 95%;">

						<tr>
							<td>Jumlah Item</td>
							<td>
								<input type="hidden" name="sub_total" class="jumlah_total_form" value="0" style="width:100px;">
								<span class="jumlah_total_pembelian pull-right" id="0">0</span>
							</td>
						</tr>

						<tr>
							<td>Sub Total</td>
							<td>
								<input type="hidden" name="sub_total" class="sub_total_form" value="0" style="width:100px;">
								<span class="sub_total_pembelian pull-right" id="0">0</span>
							</td>
						</tr>
						<tr>
							<td>Total Diskon</td>
							<td>
								<input type="hidden" name="sub_total_diskon" class="sub_total_diskon_form" value="0" style="width:100px;">
								<span class="sub_total_diskon_pembelian pull-right" id="0">0</span>
							</td>
						</tr>

						<tr>
							<td style="vertical-align:middle;width: 500px;">PB1 : <input class="total_tax" id="0" name="tax" value="<?php echo $tarif_pb1; ?>" disabled style="width:40px;"> %</td>
							<input type="hidden" name="tarif_pb1" value="<?php echo $tarif_pb1; ?>">
							<td>
								<input type="hidden" name="nilai_tax" class="hasil_tax_form" value="10" style="width:100px;">
								<span class="hasil_tax pull-right" id="0">0</span>
							</td>
						</tr>

						<tr style="font-size:120%;font-weight: 900;color: black;">
							<td>Total</td>
							<td>
								<input type="hidden" name="total" class="total_form" value="0" style="width:100px;">
								<span class="total_pembelian pull-right" id="0" style="font-size:larger;">0</span>
							</td>
						</tr>
					</table>
					<div class="form-group" style="color:crimson;">
						<div class="form-group" style="text-align:center">
							<label id="lbl_status_pembayaran" style="font-size:120%">Belum ada item barang</label>

						</div>
					</div>

					<input type="hidden" name="subjumlah" class="subjumlah_form" value="0" style="width:100px;">

					<div class="row" style="padding-right:15px;padding-left: 0px;">

						<div class="col-lg-3" style="padding-left:5px">
							<div class="form-group">
								<button type="button" class="btn-default btn tombol1" id="resetTransaction" onClick="document.location.reload()" style="padding-left: 9px;padding-right: 9px;background-color: red;color: ghostwhite;opacity: .7;"><i class="fa fa-refresh"></i> Reset</button>
							</div>
						</div>

						<div class="col-lg-5">
							<div class="form-group">
								<button type="button" class="btn-default btn tombol1" onclick="open_pembayaran()" id="tombolPayment"><i class="fa fa-cc-mastercard"></i> Payment</button>
							</div>
						</div>

						<div class="col-lg-4">
							<div class="form-group">
								<button type="button" class="btn-default btn tombol1 tombol-simpan" id="tombol-simpan"><i class="fa fa-save"></i> Save</button>
							</div>
						</div>

					</div>
				</div>
			</div>
			<!-- end wrapper 3b -->
		</div>
	</div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script>
	$(document).ready(function() {
		// $('#tombolBuatTransaksi').attr('disabled','disabled');
		$("#tombol-simpan").attr('disabled', 'disabled');
		// $("#tombolBuatTransaksi").hide();
		$("#tombolPayment").attr('disabled', 'disabled');
		//$("#search_menu").attr('disabled', 'disabled');


		showPayment();
		showAplikasi();
		showAlatbayar();
		showVoucher();

		$('#country').on('change', function() {
			var countryID = $(this).val();
			// console.log(countryID)

			menupilihankanan(countryID);
		});


		$(".tombol-simpan").click(function() {
			$("#resetTransaction").attr('disabled', 'disabled');
			$("#tombolPayment").attr('disabled', 'disabled');
			$("#tombol-simpan").attr('disabled', 'disabled');

			var x10 = document.getElementById("state");
			x10.style.display = "none";

			var data = $('.form-user').serialize();
			$.ajax({
				type: 'POST',
				url: "route/data_kasir/aksi_2.php",
				data: data,
				success: function() {
					var x11 = document.getElementById("print");
					x11.style.display = "block";
					$('#print').load("route/data_kasir/cetak.php");
					// console.log(data);
				},
				error: function(jqXHR, textStatus, errorThrown) {
					// $('button').prop('disabled', false);
					alert('Message: ' + textStatus + ' , HTTP: ' + errorThrown);

				},

				// complete:function(data){
				// 	var json = data
				// 	console.log('ini data kedua = '+val(data));
				// }
			});
		});
		// default aplikasi
		var id = 11;
		var kode = 11;
		var nama = "DINE IN";
		console.log(kode);
		console.log(nama);
		menupilihankanan(kode);
		var btn = document.getElementById("tombolAplikasi");
		var x = document.getElementById("label_header_kanan");
		var y1 = document.getElementById("btn_menu_all");
		var y2 = document.getElementById("btn_menu_makanan");
		var y3 = document.getElementById("btn_menu_minuman");
		var y4 = document.getElementById("btn_menu_paket");
		var y5 = document.getElementById("btn_menu_tambahan");

		btn.innerHTML = nama;
		x.innerHTML = nama;

		$('#search_menu').removeAttr('disabled');

		$(".input_nama_aplikasi").val(nama);

		x.style.backgroundColor = "black";
		x.style.color = "red";
		y1.style.backgroundColor = "black";
		y2.style.backgroundColor = "black";
		y3.style.backgroundColor = "black";
		y4.style.backgroundColor = "black";
		y5.style.backgroundColor = "black";
		$('#payment_nilai_tunai').removeAttr('disabled');
		document.cookie = "kode_app=11";



		// pilih Aplikasi
		$(document).on("click", ".pilih-aplikasi", function() {
			$('#search_menu').removeAttr('disabled');

			var id = $(this).attr('id');
			var kode = $("#aplikasi_kode_" + id).val();
			var nama = $("#aplikasi_nama_" + id).val();

			console.log(kode);
			console.log(nama);
			menupilihankanan(kode);
			var btn = document.getElementById("tombolAplikasi");
			var x = document.getElementById("label_header_kanan");
			var y1 = document.getElementById("btn_menu_all");
			var y2 = document.getElementById("btn_menu_makanan");
			var y3 = document.getElementById("btn_menu_minuman");
			var y4 = document.getElementById("btn_menu_paket");
			var y5 = document.getElementById("btn_menu_tambahan");

			// var z = document.getElementById("payment_nilai_tunai");



			btn.innerHTML = nama;
			// nama_aplikasi.innerHTML=nama;
			x.innerHTML = nama;


			$(".input_nama_aplikasi").val(nama);

			if (id == '22') {
				x.style.backgroundColor = "red";
				x.style.color = "white";
				y1.style.backgroundColor = "red";
				y2.style.backgroundColor = "red";
				y3.style.backgroundColor = "red";
				y4.style.backgroundColor = "red";
				y5.style.backgroundColor = "red";
				$("#payment_nilai_tunai").attr('disabled', 'disabled');
				document.cookie = "kode_app=22";
			} else if (id == '33') {
				x.style.backgroundColor = "green";
				x.style.color = "white";
				y1.style.backgroundColor = "green";
				y2.style.backgroundColor = "green";
				y3.style.backgroundColor = "green";
				y4.style.backgroundColor = "green";
				y5.style.backgroundColor = "green";
				$("#payment_nilai_tunai").attr('disabled', 'disabled');
				document.cookie = "kode_app=33";
			} else if (id == '44') {
				x.style.backgroundColor = "red";
				x.style.color = "black";
				y1.style.backgroundColor = "red";
				y2.style.backgroundColor = "red";
				y3.style.backgroundColor = "red";
				y4.style.backgroundColor = "red";
				y5.style.backgroundColor = "red";
				$("#payment_nilai_tunai").attr('disabled', 'disabled');
				document.cookie = "kode_app=44";
			} else {
				x.style.backgroundColor = "black";
				x.style.color = "red";
				y1.style.backgroundColor = "black";
				y2.style.backgroundColor = "black";
				y3.style.backgroundColor = "black";
				y4.style.backgroundColor = "black";
				y5.style.backgroundColor = "black";
				$('#payment_nilai_tunai').removeAttr('disabled');
				document.cookie = "kode_app=11";

			}

			close_aplikasi();

		});
		show_all();

		function menupilihankanan(countryID) {
			// var countryID = $(this).val();


			if (countryID) {
				var dt = {};
				dt.kd_aplikasi = countryID;
				dt.kd_kota = '<?php echo $kd_kota; ?>';

				console.log(countryID)
				console.log(dt.kd_aplikasi)
				console.log(dt.kd_kota)
				// console.log(dt.kd_aplikasi)

				var kd_aplikasi = dt.kd_aplikasi;
				console.log(kd_aplikasi);


				var input = document.getElementById('tampil_aplikasi_keterangan');
				var input_invoice = document.getElementById('tampil_invoice');
				$(".input_kd_aplikasi").val(countryID);
				// var nilai_kd_cus_tgl_inv = document.getElementById('nilai_kd_cus_tgl_inv');

				t = input_invoice.value;
				// s = nilai_kd_cus_tgl_inv.value;
				k = '<?php echo $kd_cus . '-' . $tgl_inv; ?>';
				u = '<?php echo $kd_cus_tgl_inv; ?>';
				console.log('t = ' + t)


				// input_invoice.value = u+'-'+dt.kd_aplikasi+'-0000';


				if (dt.kd_aplikasi == '11') {
					// $('#lbl_aplikasi').html("<label>Dine IN</label>");
					input.value = '0';
					// $('#tampil_aplikasi_keterangan').removeAttr('disabled');
					$("#form_voucher").show();
					input_invoice.value = u + '-' + '01' + '-0000';

					$('#tampil_invoice').attr('readonly', 'readonly');
				} else {
					input.value = 'On Line';
					$("#form_voucher").hide();
					input_invoice.value = u + '-' + '02' + '-0000';
					// $('#tampil_aplikasi_keterangan').attr('disabled','disabled');
					$('#tampil_invoice').attr('readonly', 'readonly');
					// $('#tampil_aplikasi_keterangan').attr('readonly','readonly');
				}

				// }else if(dt.kd_aplikasi=='22'){
				// 	$('#lbl_aplikasi').html("<label>Aplikasiii Shopee</label>");
				// 	input.value ='On Line'; 
				// 	$('#tampil_aplikasi_keterangan').attr('disabled','disabled');
				// }else if(dt.kd_aplikasi=='33'){
				// 	$('#lbl_aplikasi').html("<label>Aplikasi Grab</label>");
				// 	input.value ='On Line'; 
				// 	$('#tampil_aplikasi_keterangan').attr('disabled','disabled');
				// }else if(dt.kd_aplikasi=='44'){
				// 	$('#lbl_aplikasi').html("<label>Aplikasi GoJek</label>");
				// 	input.value ='On Line'; 
				// 	$('#tampil_aplikasi_keterangan').attr('disabled','disabled');
				// }else{
				// 	$('#lbl_aplikasi').html("<label>Pilih</label>");
				// }

				$.ajax({
					type: 'POST',
					url: 'route/data_kasir/ajax_menu.php',
					data: dt,
					success: function(html) {
						// console.log(res);
						$('#state').html(html);
						// $('#state2').html(html);
						$('#city').html('<option value="">Select state first</option>');
						// $("#tampil_invoice").val(s+'-'+dt.kd_aplikasi);

					}
				});

				$.ajax({
					type: 'POST',
					url: 'route/data_kasir/ajax_alatbayar.php',
					data: dt,
					success: function(html) {
						// console.log(res);
						$('#sub_alat_bayar').html(html);
						// $('#state2').html(html);
						$('#city').html('<option value="">Select state first</option>');
						// $("#tampil_invoice").val(s+'-'+dt.kd_aplikasi);

					}
				});

			} else {
				$('#state').html('<option value="">Select country first</option>');
				$('#city').html('<option value="">Select state first</option>');
			}

		};


		$('#state').on('change', function() {
			var stateID = $(this).val();
			if (stateID) {
				$.ajax({
					type: 'POST',
					url: 'route/data_kasir/ajax2.php',
					data: 'state_id=' + stateID,
					success: function(html) {
						$('#city').html(html);
					}
				});
			} else {
				$('#city').html('<option value="">Select state first</option>');
			}
		});
	});
</script>


<script type="text/javascript">
	var clickCount = 0;

	function pilihmenu() {
		console.log('testingatas')
		var pilih1 = document.getElementById('pilih').value;
		//var pilih = $('#pilih').val('kodelagi');
		console.log('testingatas2')

		console.log(pilih1)
		console.log(pilih)

		var masuk = 'testingmasuk';
		var kota = '<?= $kd_kota ?>';
		console.log(masuk)
		var dt = {};
		dt.kd_aplikasi = $("id").val();
		dt.kd_kota = '<?php echo $kd_kota; ?>';
		console.log(dt.kd_aplikasi)
		console.log(dt.kd_kota)


		$.ajax({
			type: 'POST',
			url: 'route/data_kasir/ajax_menu.php',
			data: dt,
			success: function(html) {
				// console.log(res);
				$('#state').html(html);
				$('#state2').html(html);
				$('#city').html('<option value="">Select state first</option>');
				$(".tampil_aplikasi_keterangan").html('<option value="">Select state first</option>');
			}
		});
	}


	function reloadpage() {
		location.reload()
	}

	function showAplikasi() {
		console.log("masuk showAplikasi");

		$.ajax({
			type: 'POST',
			url: 'route/data_kasir/aplikasi.php',
			success: function(html) {
				// console.log(res);
				$('#aplikasi').html(html);
				// $('#city').html('<option value="">Select state first</option>');
				// $("#tampil_aplikasi_keterangan").val(keterangan);

			}
		});
	};

	function showPayment() {
		console.log("masuk showPayment");

		$.ajax({
			type: 'POST',
			url: 'route/data_kasir/payment.php',
			success: function(html) {
				// console.log(res);
				$('#payment').html(html);
				// $('#city').html('<option value="">Select state first</option>');
				// $("#tampil_aplikasi_keterangan").val(keterangan);

			}
		});
	};

	function showAlatbayar() {
		console.log("masuk showAlatbayar");

		$.ajax({
			type: 'POST',
			url: 'route/data_kasir/alatbayar.php',
			success: function(html) {
				// console.log(res);
				$('#alatbayar').html(html);
				// $('#city').html('<option value="">Select state first</option>');
				// $("#tampil_aplikasi_keterangan").val(keterangan);

			}
		});
	};


	function showVoucher() {
		console.log("masuk showVoucher");

		$.ajax({
			type: 'POST',
			url: 'route/data_kasir/voucher.php',
			success: function(html) {
				// console.log(res);
				$('#voucher').html(html);
				// $('#city').html('<option value="">Select state first</option>');
				// $("#tampil_aplikasi_keterangan").val(keterangan);

			}
		});
	};


	function showPrint() {
		console.log("masuk showPrint");

		$.ajax({
			type: 'POST',
			url: 'route/data_kasir/cetak.php',
			success: function(html) {
				// console.log(res);
				$('#print').html(html);
				// $('#city').html('<option value="">Select state first</option>');
				// $("#tampil_aplikasi_keterangan").val(keterangan);
				open_print();

			}
		});
	};


	function open_print() {
		console.log("open print");
		var x11 = document.getElementById("print");

		x11.style.display = "block";

	};

	function open_pembayaran() {
		console.log("open pembayaran");
		var x1 = document.getElementById("payment");
		var x6 = document.getElementById("alatbayar");
		var x7 = document.getElementById("voucher");
		var x5 = document.getElementById("sub_alat_bayar");

		$("#layerpayment").show();
		$("#payment").fadeIn(100);

		// x1.style.display = "block";
		// x6.style.display = "none";
		x7.style.display = "none";
		x5.style.display = "block";


	};

	function open_aplikasi() {
		console.log("open aplikasi");
		var x4 = document.getElementById("aplikasi");

		x4.style.display = "block";

	};

	function open_alatbayar() {
		console.log("open alatbayar");
		var x6 = document.getElementById("alatbayar");
		x6.style.display = "block";

		var x7 = document.getElementById("voucher");
		x7.style.display = "none";

	};

	function open_sub_alatbayar() {
		console.log("open sub alatbayar");
		var x5 = document.getElementById("sub_alat_bayar");
		console.log(x5)

		x5.style.display = "block";


	};

	function open_voucher() {
		console.log("open voucher");
		var x7 = document.getElementById("voucher");

		x7.style.display = "block";

	};

	function show_makanan1() {
		console.log("open makanan");
		var x6 = document.getElementById("alatbayar");

		x6.style.display = "block";
		var x7 = document.getElementById("voucher");

		x7.style.display = "none";

	};

	function open_print() {
		console.log("open print");
		// var x1 = document.getElementById("payment");
		// var x6 = document.getElementById("alatbayar");
		// var x7 = document.getElementById("voucher");
		var x8 = document.getElementById("print");

		// x1.style.display = "none";
		// x6.style.display = "none";
		// x7.style.display = "none";
		x8.style.display = "block";

	};


	function clear_form_kanan() {
		var state = document.getElementById('state');
		state.style.display = 'none';
		var tempat_search = document.getElementById('tempat_search');
		tempat_search.style.display = 'none';
	}

	function clear_form_search() {
		var search_menu = document.getElementById('search_menu');
		search_menu.value = '';
	}

	function clear_alatbayar() {
		var alatbayar_nama = document.getElementById('payment_alatbayar_nama');
		alatbayar_nama.value = '';
		var tampil_alatbayar_pin = document.getElementById('tampil_alatbayar_pin');
		tampil_alatbayar_pin.value = '';
		var payment_nilai_non_tunai = document.getElementById('payment_nilai_non_tunai');
		payment_nilai_non_tunai.value = 0;
		paymenttotalkembali();
		close_sub_alatbayar();
		close_alatbayar();
		$('#tombol_payment_close').removeAttr('disabled');
	}

	function clear_form_bayar() {
		$("#table-voucher tbody").empty();
		$("#table-datatable2 tbody").empty();
		kode_seri = [];
		var formGroupDiv = document.getElementById('text_voucher');
		if (formGroupDiv) {
			formGroupDiv.innerHTML = "";
		}
		$(".voucher_nilai").attr("id", 0);
		$(".voucher_harga").attr("id", 0);
		$(".voucher_jumlah").attr("id", 0);
		$(".voucher_total").attr("id", 0);
		$(".total_voucher").attr("id", 0);
		$(".total_voucher").text(0);
		$(".voucher_nilai").text(0);
		$(".voucher_harga").text(0);
		$(".voucher_jumlah").text(0);
		$(".voucher_total").text(0);
		document.getElementById('input_voucher').value = "";
		document.getElementById('payment_nilai_voucher').value = 0;
		document.getElementById('payment_nilai_tunai').value = 0;
		document.getElementById('payment_sub_alatbayar').value = 0;
		var alatbayar_nama = document.getElementById('payment_alatbayar_nama');
		alatbayar_nama.value = '';
		var tampil_alatbayar_pin = document.getElementById('tampil_alatbayar_pin');
		tampil_alatbayar_pin.value = '';
		var payment_nilai_non_tunai = document.getElementById('payment_nilai_non_tunai');
		payment_nilai_non_tunai.value = 0;
		paymenttotalkembali();
		// close_sub_alatbayar();
		// close_alatbayar();
		$('#tombol_payment_close').removeAttr('disabled');
		document.getElementById('tampil_alatbayar_pin').disabled = true;
		document.getElementById('payment_nilai_non_tunai').disabled = true;
	}


	function show_all() {
		console.log("masuk show All");
		clear_form_kanan();
		clear_form_search();

		var state = document.getElementById('state');
		state.style.display = 'block';

		var menu1 = document.getElementById("makanan");
		if (menu1) {
			menu1.style.display = "block";
		}
		var menu2 = document.getElementById("minuman");
		if (menu2) {
			menu2.style.display = "block";
		}

		var menu3 = document.getElementById("paket");
		if (menu3) {
			menu3.style.display = "block";
		}
		var menu4 = document.getElementById("tambahan");
		if (menu4) {
			menu4.style.display = "block";
		}
	};

	function show_makanan() {
		console.log("masuk show makanan");
		clear_form_kanan();
		clear_form_search();

		var state = document.getElementById('state');
		state.style.display = 'block';

		var menu1 = document.getElementById("makanan");
		menu1.style.display = "block";

		var menu2 = document.getElementById("minuman");
		menu2.style.display = "none";

		var menu3 = document.getElementById("paket");
		menu3.style.display = "none";

		var menu4 = document.getElementById("tambahan");
		menu4.style.display = "none";

	};

	function show_minuman() {
		console.log("masuk show minuman");
		clear_form_kanan();
		clear_form_search();

		var state = document.getElementById('state');
		state.style.display = 'block';

		var menu2 = document.getElementById("minuman");
		menu2.style.display = "block";

		var menu1 = document.getElementById("makanan");
		menu1.style.display = "none";

		var menu3 = document.getElementById("paket");
		menu3.style.display = "none";

		var menu4 = document.getElementById("tambahan");
		menu4.style.display = "none";


	};

	function show_paket() {
		console.log("masuk show paket");
		clear_form_kanan();
		clear_form_search();

		var state = document.getElementById('state');
		state.style.display = 'block';

		var menu3 = document.getElementById("paket");
		menu3.style.display = "block";

		var menu1 = document.getElementById("makanan");
		menu1.style.display = "none";

		var menu2 = document.getElementById("minuman");
		menu2.style.display = "none";

		var menu4 = document.getElementById("tambahan");
		menu4.style.display = "none";

	};

	function show_tambahan() {
		console.log("masuk show tambahan");
		clear_form_kanan();
		clear_form_search();

		var state = document.getElementById('state');
		state.style.display = 'block';

		var menu4 = document.getElementById("tambahan");
		menu4.style.display = "block";

		var menu1 = document.getElementById("makanan");
		menu1.style.display = "none";

		var menu2 = document.getElementById("minuman");
		menu2.style.display = "none";

		var menu3 = document.getElementById("paket");
		menu3.style.display = "none";

	};

	function show_ket() {
		var ket = document.getElementById("form_ket");
		ket.style.display = 'block';
	}

	function hide_ket() {
		var ket = document.getElementById("form_ket");
		ket.style.display = 'none';
	}

	// function tombol_minus(){
	// 	var jml = document.getElementById("tambahkan_jumlah").value;

	// 	if (jml!=0) {
	// 		var nilai_jumlah= eval(jml) - 1;
	// 		console.log(jml)
	// 		console.log(nilai_jumlah)
	// 		$("#tambahkan_jumlah").val( nilai_jumlah );
	// 	}
	// }
	function tombol_minus() {
		var jml = document.getElementById("tambahkan_jumlah").value;
		if (jml != 0) {
			var nilai_jumlah = eval(jml) - 1;
			var harga = document.getElementById("tambahkan_harga").value;
			var total = eval(nilai_jumlah) * eval(harga);
			console.log('jml = ' + jml)
			console.log('nilai_jumlah = ' + nilai_jumlah)
			console.log('total = ' + total)
			$("#tambahkan_jumlah").val(nilai_jumlah);
			$("#tambahkan_total").val(total);
		}
	}


	function tombol_plus() {
		clickCount++;
		var jml = document.getElementById("tambahkan_jumlah").value;
		var nilai_jumlah = eval(jml) + 1;
		var harga = document.getElementById("tambahkan_harga").value;
		var total = eval(nilai_jumlah) * eval(harga);
		console.log('jml = ' + jml)
		console.log('nilai_jumlah = ' + nilai_jumlah)
		console.log('total = ' + total)
		$("#tambahkan_jumlah").val(nilai_jumlah);
		$("#tambahkan_total").val(total);
	}
</script>

<script>
	function goBack() {
		window.history.back();
	}
</script>