<div class="col-lg-7 bg-white" style="height: 65px!important;min-height: 65px!important;">

	<!-- wrapper 1 -->
	<div class="wrapper bg-white">
		<div class="row">

			<div class="col-lg-5">
				<a href="#"><img src="<?php echo $dir; ?>images/logo1.png" style="width: 50px"></a>
			</div>

			<div class="col-lg-2">
				<a href="main.php?route=profile"><img src="<?php echo $dir; ?>images/staff/<?php echo $photo; ?>" style="height: 50px"></a>
			</div>
			<div class="col-lg-3 d-flex text-right">
			</div>
			<div class="col-lg-2" style="text-align:end; display:none">
				<div class="form-group">
					<button type="button" class="btn-default btn tombol" onclick="open_aplikasi()" id="tombolAplikasi" style="width:140px;height: 50px;" disabled> Pilih Aplikasi</button>
				</div>
				<input type="hidden" name="nama_aplikasi" class="input_nama_aplikasi">
				<input type="hidden" name="kd_aplikasi" class="input_kd_aplikasi">
				<input type="hidden" id="isSubmitting" name='isSubmitting' value="false">

			</div>
		</div>
	</div>
	<!-- end wrapper 1-->
	<div class="modal fade" id="modal-member" tabindex="-1" aria-labelledby="modal-memberLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" style="width: 1200px;">
			<div class="modal-content">
				<div class="modal-header">
					<h2 class="modal-title">Tambah Member Baru</h2>
					<button type="button" id="button-close" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body px-3">
					<div class="form-member">
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label for="kode_member" class="col-form-label">No. HP</label>
									<input type="text" class="form-control" name="kode_member" id="kode_member" required>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="nama" class="col-form-label">Nama</label>
									<input type="text" class="form-control" name="nama" id="nama" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label for="telepon" class="col-form-label">NIK</label>
									<input type="text" class="form-control" name="telepon" id="telepon">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="alamat" class="col-form-label">Alamat</label>
									<input type="text" class="form-control" name="alamat" id="alamat">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label for="kecamatan" class="col-form-label">Kecamatan</label>
									<input type="text" class="form-control" name="kecamatan" id="kecamatan">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="kabupaten" class="col-form-label">Kabupaten</label>
									<input type="text" class="form-control" name="kabupaten" id="kabupaten">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label for="provinsi" class="col-form-label">Provinsi</label>
									<input type="text" class="form-control" name="provinsi" id="provinsi">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="kelurahan" class="col-form-label">Kelurahan</label>
									<input type="text" class="form-control" name="kelurahan" id="kelurahan">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label for="keterangan">Keterangan Member</label>
									<select id="keterangan" name="keterangan">
										<option value="4">Member Silver</option>
										<option value="5">Member Gold</option>
										<option value="6">Member Platinum</option>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="data-tabel-member" style="max-height: 50vh; display: none;">
						<div class="row">
							<div class="col-sm-2">
								Nama | No .Hp :
							</div>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="cari_member" id="cari_member">
							</div>
						</div>
						<div style="max-height: 300px;overflow-y: auto;">
							<table class="table tabel-member">
								<thead class="thead-light">
									<tr class="text-center">
										<th style="vertical-align: middle;">No</th>
										<th style="vertical-align: middle;">No. Hp</th>
										<th style="vertical-align: middle;">Nama</th>
										<th style="vertical-align: middle;">NIK</th>
										<th style="vertical-align: middle;">Alamat</th>
										<th style="vertical-align: middle;">Keterangan</th>
										<th style="vertical-align: middle;">Aksi</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" id="btn-batal-member" data-dismiss="modal">Batal</button>
					<button type="button" class="btn btn-primary" id="btn-daftar-member">Daftar Member</button>
					<button type="button" class="btn btn-secondary" id="btn-kembali-member" style="display: none;">Kembali</button>
					<button type="button" class="btn btn-primary" id="btn-save-member">Tambah</button>
					<button type="button" class="btn btn-primary" id="btn-update-member" style="display: none;">Edit</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Kategori -->
	<div class="modal fade" id="modal-kategori" tabindex="-1" aria-labelledby="modal-kategoriLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h2 class="modal-title">Tambah Kategori Baru</h2>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body px-3">
					<div class="form-kategori">
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label for="id_kat" class="col-form-label">Kategori</label>
									<input type="text" class="form-control" name="id_kat" id="id_kat" required>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="Retail" class="col-form-label">Retail (Contoh: 1.2)</label>
									<input type="number" class="form-control" name="Retail" id="Retail" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label for="Grosir" class="col-form-label">Grosir (Contoh: 1.2)</label>
									<input type="number" class="form-control" name="Grosir" id="Grosir">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="Online" class="col-form-label">Online (Contoh: 1.2)</label>
									<input type="number" class="form-control" name="Online" id="Online">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label for="MR" class="col-form-label">MR (Contoh: 1.2)</label>
									<input type="number" class="form-control" name="MR" id="MR">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="MG" class="col-form-label">MG (Contoh: 1.2)</label>
									<input type="number" class="form-control" name="MG" id="MG">
								</div>
							</div>
						</div>
					</div>
					<div class="data-tabel-kategori" style="max-height: 50vh;overflow-y: scroll; display: none;">
						<div class="row">
							<div class="col-sm-2">
								Kategori :
							</div>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="cari_kategori" id="cari_kategori">
							</div>
						</div>
						<table class="table tabel-kategori">
							<thead class="thead-light">
								<tr class="text-center">
									<th style="vertical-align: middle;">kategori</th>
									<th style="vertical-align: middle;">Retail</th>
									<th style="vertical-align: middle;">Grosir</th>
									<th style="vertical-align: middle;">Online</th>
									<th style="vertical-align: middle;">MR</th>
									<th style="vertical-align: middle;">MG</th>
									<th style="vertical-align: middle;">Aksi</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" id="btn-batal-kategori" data-dismiss="modal">Batal</button>
					<button type="button" class="btn btn-primary" id="btn-daftar-kategori">Daftar kategori</button>
					<button type="button" class="btn btn-secondary" id="btn-kembali-kategori" style="display: none;">Kembali</button>
					<button type="button" class="btn btn-primary" id="btn-save-kategori">Tambah</button>
					<button type="button" class="btn btn-primary" id="btn-update-kategori" style="display: none;">Edit</button>
				</div>
			</div>
		</div>
	</div>

	<div class="wrapper box-poly" style="height:510px!important;background-color: inherit;">
		<div class="table-responsive" style="padding:1px 10px 10 10px">
			<!-- wrapper 2-->
			<div class="wrapper bg-white " style="padding: 0px 10px 1px;margin:  5 -5 -1;">

				<div class="row">

					<div class="col-lg-4">
						<table style="font-size:85%">
							<tr>
								<td style="width:50px">Kasir</td>
								<td>:</td>
								<td><b><?php echo $namakasir; ?></b></td>
								<input type="hidden" id="nama_kasir" value="<?php echo $namakasir; ?>">
							</tr>
							<tr>
								<td>Outlet</td>
								<td>:</td>
								<td><b><?php echo $nama_cab; ?></b></td>
								<input type="hidden" id="nama_cab" value="<?php echo $nama_cab; ?>">
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
					$last4 = substr($en, -4);

					$tgl_inv = $thn . $bln . $hari;
					$char = $last4 . '-' . $tgl_inv . '-' . $kasir;
					$kd_cus_tgl_inv = $last4 . '-' . $tgl_inv;

					// echo $char;
					$hasil = mysqli_query($koneksi, "SELECT faktur,max(faktur) as maxKode FROM penjualan where substr(faktur,1,14) ='$char' ");
					$kp = mysqli_fetch_array($hasil);
					$kodeInvoice = $kp['maxKode'];
					// echo 'kode :'.$kodeInvoice;
					// echo "no : ";
					$noUrut = substr((string) $kodeInvoice, 15, 4);
					if ($noUrut != "") {
						$noUrut++;
					} else {
						$noUrut = 1;
					}

					// echo 'norut ='.$noUrut;

					$noInvoice = $char . '-' . sprintf("%04s", $noUrut);

					?>

					<input type="hidden" name="oleh" value="<?php echo $namakasir; ?>">
					<input type="hidden" name="nama_cab" value="<?php echo $nama_cab; ?>">

					<input type="hidden" name="no_urut" value="<?php echo $noUrut; ?>">

					<input type="hidden" name="tahun" value="<?php echo $thn; ?>">
					<input type="hidden" name="bulan" value="<?php echo $bln; ?>">
					<input type="hidden" name="no_inv" value="<?php echo $noInvoice; ?>">
					<!-- <td><input type="text" name="nilai_inv" value="<?php echo $kd_cus_tgl_inv; ?>" id='nilai_kd_cus_tgl_inv'></td> -->

					<div class="col-lg-3 text-right" style="padding-right: 1px;">
						<table style="font-size:90%">

							<tr>
								<td style="width:45px">No Inv</td>
								<td style="text-align: right;">: <input type="text" name="no_inv" id="tampil_invoice" style="width: 110px;border-style: none;margin: 2;"></td>
							</tr>
						</table>
					</div>
					<div class="col-lg-1 text-right">
						<button type="button" class="btn btn-sm btn-primary" id="btn-tambah-member" data-toggle="modal" data-target="#modal-member"><i class="fa fa-plus-circle"></i> Member</button>
					</div>
					<!-- <div class="col-lg-3 text-right">
						<button type="button" class="btn btn-sm btn-success" id="btn-pilih-lokasi" data-toggle="modal" data-target="#modal-lokasi"><i class="fa fa-home"></i> Lokasi</button>
					</div> -->
					<!-- hilangin kategori
					<div class="col-lg-1 text-right">
						<button type="button" class="btn btn-sm btn-primary" id="btn-tambah-kategori" data-toggle="modal" data-target="#modal-kategori"><i class="fa fa-plus-circle"></i> Kategori</button>
					</div>-->
					<div class="col-lg-1"></div>
					<div class="col-lg-6" style="padding-right: 1px;">
						<table style="font-size:90%">
							<tr>
								<td style="width:45px">Nama</td>
								<td style="text-align: right;">: <input type="text" name="nama_member" id="nama_member" style="width: 110px;border-style: none;margin: 2;" readonly></td>
								<td style="width:100px" id="member_kategori"><b>-</b></td>
							</tr>
							<tr>
								<td style="width:45px!important">No. Hp</td>
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
					<div class="table-responsive table-scroll" style="height:410px;background-color: whitesmoke;width: 100%;">
						<table class="table  table-striped table-hover" id="table-pembelian" style="font-size:95%;">
							<thead style="border-style: single;background-color: lightgray;position: sticky; top: 0;">
								<tr>
									<th style="width: 30px;line-height: 1.8em;text-align: center;">Aksi</th>
									<th style="width: 100px;line-height: 1.8em;">Nama Produk</th>
									<th style="width: 10px;text-align: center;line-height: 1.8em;">Jml</th>
									<th style="width: 30px;text-align: right;line-height: 1.8em;">Harga</th>
									<th style="width: 120px;text-align: center;line-height: 1.8em;">Satuan</th>
									<th style="width: 120px;text-align: center;line-height: 1.8em;">Isi</th>
									<th style="width: 33px;text-align: right;line-height: 1.8em;">Sub Total</th>
									<th style="width: 20px;text-align: center;line-height: 1.8em;">Disc</th>
									<th style="width: 70px;text-align: right;line-height: 1.8em">Total</th>
									<th style="width: 120px;text-align: left;line-height: 1.8em;">Ket</th>
									<!-- <th style="width: 60px;text-align: left;line-height: 1.8em;">Promo</th> -->
								</tr>
							</thead>
							<tbody>
							</tbody>
							<tfoot style="position: sticky; bottom: 0;">
								<tr class="bg-info">
									<td style="text-align: right;" colspan="2"><b>Total</b></td>
									<td style="text-align: center;"><span class="pembelian_jumlah" id="0">0</span></td>
									<td></td>
									<td></td>
									<td></td>
									<td style="text-align: right;"><b><span class="pembelian_total" id="0">Rp.0</span></b></td>
									<td></td>
									<td style="text-align: right;"><b><span class="pembelian_total_diskon" id="0">Rp.0</span></b></td>
									<!-- <td></td> -->
									<td></td>
								</tr>
							</tfoot>
						</table>

					</div>

				</div>
				<div class="row">
					<!-- <div class="col-lg-3" id="form_jml" style="display:none;padding: 5 5 5 5;">
						<span class='btn btn-xs btn-info' onclick="tombol_minus()"><i class='fa fa-minus'></i></span>

						<input type="text" class="" id="tambahkan_jumlah" name="jml" style="width:30px ;border-style: none;">

						<span class='btn btn-xs btn-info' onclick="tombol_plus()"><i class='fa fa-plus'></i></span>
					</div> -->

					<div class="col-lg-6" id="form_ket" style="display:none">
						<input type="hidden" class="" id="tambahkan_ket" style="width:180px ;border-style: none;padding: 5 5 5 5" placeholder="keterangan">
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
				<input type="hidden" class="form-control" id="tambahkan_satuan" disabled>
			</div>
			<br />


			<!-- wrapper 3b-->
			<div class="wrapper bg-white">

				<div class="col-lg-6 ">
					<div class="row" style="margin-left: -40px;">



						<div class="col-lg-12" style="height:70px; margin-top: 1px;">
							<div class="row">
								<div class="col-lg-5">
									<div class="form-group">
										<button type="button" class="btn-default btn tombol1" onclick="open_pembayaran()" id="tombolPayment"><i class="fa fa-cc-mastercard"></i> Payment</button>
									</div>
								</div>

								<div class="col-lg-4">
									<div class="form-group">
										<button type="button" class="btn-default btn tombol1 tombol-simpan" id="tombol-simpan"><i class="fa fa-save"></i> Process</button>
									</div>
								</div>

							</div>
						</div>

						<div class="col-lg-12" style="height:40px;">

							<div class="row">
								<div class="col-lg-7">
									<div class="form-group">
										<button type="button" class="btn-default btn tombol1" style="padding-left: 4px;padding-right: 4px;background-color: skyblue;width: 95px;opacity: .8;" onclick="window.location.href='../../data/pages/main.php?route=home&to=kasir&hash=7'">
											<i class="fa fa-pie-chart"></i> Laporan
										</button>
									</div>
								</div>

							</div>

						</div>
						<div class="col-lg-12" style="height:25px; margin-top: 15px;">
							<div class="row">
								<div class="col-lg-5">
									<div class="form-group">
										<button type="button" class="btn-default btn tombol1" id="resetTransaction" onClick="document.location.reload()" style="padding-left: 9px;padding-right: 9px;background-color: red;color: ghostwhite;opacity: .7;"><i class="fa fa-refresh"></i> Reset</button>
									</div>
								</div>

								<!-- </div>
						</div>

						<div class="col-lg-12" style="height:40px; margin-top: 15px;">
							<div class="row"> -->
								<div class="col-lg-5">
									<div class="form-group">
										<button type="button" class="btn-default btn tombol1" style="padding-left: 4px;padding-right: 4px;background-color: red;width: 95px;opacity: .7;"><a href="../../logout.php" style="color:ghostwhite;"><img src="../../assets/icons/person-leave-solid-w.png" width="20px"> Log Out</a> </button>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-6 box-poly" style="padding:10 10 5 14">
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

						<tr style="visibility:hidden">
							<td style="vertical-align:middle;width: 500px;">Tax : <input type="hidden" class="total_tax" id="0" name="tax" value="<?php echo $tarif_pb1; ?>" disabled style="width:40px;"> %</td>
							<input type="hidden" name="tarif_pb1" value="<?php echo $tarif_pb1; ?>">
							<td>
								<input type="hidden" name="nilai_tax" class="hasil_tax_form" value="10" style="width:100px;">
								<span class="hasil_tax pull-right" id="0">0</span>
							</td>
						</tr>

						<tr style="font-size:110%;font-weight: 600;color: black;">
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

					<!-- <div class="row" style="padding-right:15px;padding-left: 0px;">

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

					</div> -->
				</div>
			</div>
			<!-- end wrapper 3b -->
		</div>
	</div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script>
	$(document).ready(function() {
		// Retail();
		<?php if ($kategori_kasir_harga == 2) { ?>
			Grosir();
		<?php } else if ($kategori_kasir_harga == 3) { ?>
			Online();
		<?php } else { ?>
			Retail();
		<?php } ?>
		// $('#tombolBuatTransaksi').attr('disabled','disabled');
		$("#tombol-simpan").attr('disabled', 'disabled');
		$("#tombol-simpan2").attr('disabled', 'disabled');
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
			if ($('#isSubmitting').val() === 'true') {
				console.log('Already submitting, ignoring click');
				return false;
			}
			$('#isSubmitting').val('true');
			$(".tombol-simpan, #tombol-simpan2").prop('disabled', true);
			const kd_alatbayar = document.getElementById('payment_sub_alatbayar').value.slice(0, 3);

			function validateStockWithServer() {
				const inputIds = document.getElementsByName('transaksi_produk[]');
				const inputQty = document.getElementsByName('transaksi_jumlah[]');
				const inputSatuan = document.getElementsByName('transaksi_satuan_qty[]');
				const inputNama = document.getElementsByName('transaksi_nama[]');
				const inputSwalayan = document.getElementsByName('kategorilockswalayan[]');
				const inputGudang = document.getElementsByName('kategorilockgudang[]');

				let itemMap = {};

				for (let i = 0; i < inputIds.length; i++) {
					const id = inputIds[i].value;
					const nama = inputNama[i].value;
					const jumlah = parseFloat(inputQty[i].value) * parseFloat(inputSatuan[i].value);
					const lockSwalayan = inputSwalayan[i].value;
					const lockGudang = inputGudang[i].value;

					if (!itemMap[id]) {
						itemMap[id] = {
							id: id,
							nama: nama,
							jumlah: 0,
							lock_swalayan: lockSwalayan,
							lock_gudang: lockGudang
						};
					}

					itemMap[id].jumlah += jumlah;
				}

				const items = Object.values(itemMap);
				const hargaKategori = document.getElementById('kd_kategori_harga_online').value;

				let isValid = false;

				$.ajax({
					url: './route/data_kasir/ajax_pengecekan_stok.php',
					type: 'POST',
					contentType: 'application/json',
					dataType: 'json',
					async: false, // make it synchronous
					data: JSON.stringify({
						harga_kategori: hargaKategori,
						items: items
					}),
					success: function(result) {
						if (!result.success) {
							alert(result.message || "Stock validation failed on server.");
							$('#isSubmitting').val('false');
							isValid = false;
						} else {
							isValid = true;
						}
					},
					error: function(xhr, status, error) {
						console.error(error);
						alert("Error connecting to stock validation server.");
						$('#isSubmitting').val('false');
						isValid = false;
					}
				});

				return isValid;
			}

			// let input1 = document.getElementsByName('stockunit[]');
			// let input2 = document.getElementsByName('transaksi_satuan_qty[]');
			// let input3 = document.getElementsByName('transaksi_jumlah[]');
			// let input4 = document.getElementsByName('transaksi_nama[]');
			// let input5 = document.getElementsByName('kategorilockswalayan[]');
			// let input6 = document.getElementsByName('kategorilockgudang[]');
			// let input7 = document.getElementsByName('transaksi_produk');


			// function validateStock(currentStockInputs, buyingStockInputs, buyingStockSatuanInputs, namabarang, lockswalayan, lockgudang) {
			// 	for (let i = 0; i < currentStockInputs.length; i++) {
			// 		let currentStock = currentStockInputs[i].value;
			// 		let buyingStock = buyingStockInputs[i].value;
			// 		let satuan = buyingStockSatuanInputs[i].value;
			// 		let pembelian = buyingStock * satuan;
			// 		let nama = namabarang[i].value;
			// 		let kategorilockswalayan = lockswalayan[i].value;
			// 		let kategorilockgudang = lockgudang[i].value;

			// 		if (document.getElementById('kd_kategori_harga_online').value == 1) {
			// 			if (kategorilockswalayan !== null && kategorilockswalayan !== '' && kategorilockswalayan !== '0' && kategorilockswalayan !== 0) {
			// 				if (currentStock < 0) {
			// 					alert(`Stock error at ${nama}: Stok terkini (${currentStock}) is negative.`);
			// 					return false;
			// 				}
			// 				if (pembelian < 0) {
			// 					alert(`Stock error at ${nama}: Stok pembelian yang di input (${pembelian}) is negative.`);
			// 					return false;
			// 				}
			// 				if (pembelian > currentStock) {
			// 					alert(`Stock error at ${nama}: Stok pembelian yang di input (${pembelian}) > Stok terkini (${currentStock})`);
			// 					return false;
			// 				}
			// 			}
			// 		} else {
			// 			if (kategorilockgudang !== null && kategorilockgudang !== '' && kategorilockgudang !== '0' && kategorilockgudang !== 0) {
			// 				if (currentStock < 0) {
			// 					alert(`Stock error at ${nama}: Stok terkini (${currentStock}) is negative.`);
			// 					return false;
			// 				}
			// 				if (pembelian < 0) {
			// 					alert(`Stock error at ${nama}: Stok pembelian yang di input (${pembelian}) is negative.`);
			// 					return false;
			// 				}
			// 				if (pembelian > currentStock) {
			// 					alert(`Stock error at ${nama}: Stok pembelian yang di input (${pembelian}) > Stok terkini (${currentStock})`);
			// 					return false;
			// 				}
			// 			}
			// 		}

			// 		// if (currentStock < 0) {
			// 		// 	alert(`Stock error at ${nama}: Stok terkini (${currentStock}) is negative.`);
			// 		// 	return false;
			// 		// }
			// 		// if (pembelian < 0) {
			// 		// 	alert(`Stock error at ${nama}: Stok pembelian yang di input (${pembelian}) is negative.`);
			// 		// 	return false;
			// 		// }
			// 		// if (pembelian > currentStock) {
			// 		// 	alert(`Stock error at ${nama}: Stok pembelian yang di input (${pembelian}) > Stok terkini (${currentStock})`);
			// 		// 	return false;
			// 		// }
			// 		// ini diubah
			// 	}
			// 	return true;
			// }

			if (kd_alatbayar == 214 && document.getElementById("tampil_aplikasi_keterangan").value == 0 || document.getElementById("tampil_aplikasi_keterangan").value == "") {
				alert("Transaksi Paylater Harus Memasukan Member");
				$('#isSubmitting').val('false');
				return false;
			} else {
				if (!validateStockWithServer()) {
					alert('Stock validation failed.');
					return false;
				}
				$("#resetTransaction").attr('disabled', 'disabled');
				$("#tombolPayment").attr('disabled', 'disabled');
				// $("#tombol-simpan").attr('disabled', 'disabled');
				// $("#tombol-simpan2").attr('disabled', 'disabled');
				var x10 = document.getElementById("state");
				x10.style.display = "none";
				console.log('clicked');
				$("#tombol-simpan").prop('disabled', true);
				$("#tombol-simpan2").prop('disabled', true);

				var data = $('.form-user').serialize();

				$.ajax({
					type: 'POST',
					url: "route/data_kasir/aksi_2.php",
					data: data,
					success: function(response) {
						const jsonMatch = JSON.parse(response);

						window.location.href = "route/data_kasir/cetak_nota.php?id=" + jsonMatch.no_invoice;
						// var x11 = document.getElementById("print");
						// x11.style.display = "block";
						// $('#print').load("route/data_kasir/cetak.php");
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
			}
		});
		// default aplikasi
		var id = 11;
		var kode = 11;
		var nama = "Retail";
		<?php if ($kategori_kasir_harga == 2) { ?>
			nama = "Grosir";
		<?php } else if ($kategori_kasir_harga == 3) { ?>
			nama = "Online";
		<?php } ?>
		console.log(kode);
		console.log(nama);
		menupilihankanan(kode);
		var btn = document.getElementById("tombolAplikasi");
		var x = document.getElementById("label_header_kanan");
		// var y1 = document.getElementById("btn_menu_all");
		// var y2 = document.getElementById("btn_menu_makanan");
		// var y3 = document.getElementById("btn_menu_minuman");
		// var y4 = document.getElementById("btn_menu_paket");
		// var y5 = document.getElementById("btn_menu_tambahan");

		btn.innerHTML = nama;
		x.innerHTML = nama;

		$('#search_menu').removeAttr('disabled');

		$(".input_nama_aplikasi").val(nama);

		x.style.backgroundColor = "black";
		x.style.color = "white";
		// y1.style.backgroundColor = "black";
		// y2.style.backgroundColor = "black";
		// y3.style.backgroundColor = "black";
		// y4.style.backgroundColor = "black";
		// y5.style.backgroundColor = "black";
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
			// var y1 = document.getElementById("btn_menu_all");
			// var y2 = document.getElementById("btn_menu_makanan");
			// var y3 = document.getElementById("btn_menu_minuman");
			// var y4 = document.getElementById("btn_menu_paket");
			// var y5 = document.getElementById("btn_menu_tambahan");

			// var z = document.getElementById("payment_nilai_tunai");



			btn.innerHTML = nama;
			// nama_aplikasi.innerHTML=nama;


			$(".input_nama_aplikasi").val(nama);

			if (id == '22') {
				x.style.backgroundColor = "red";
				x.style.color = "white";
				// y1.style.backgroundColor = "red";
				// y2.style.backgroundColor = "red";
				// y3.style.backgroundColor = "red";
				// y4.style.backgroundColor = "red";
				// y5.style.backgroundColor = "red";
				$("#payment_nilai_tunai").attr('disabled', 'disabled');
				document.cookie = "kode_app=22";
			} else if (id == '33') {
				x.style.backgroundColor = "green";
				x.style.color = "white";
				// y1.style.backgroundColor = "green";
				// y2.style.backgroundColor = "green";
				// y3.style.backgroundColor = "green";
				// y4.style.backgroundColor = "green";
				// y5.style.backgroundColor = "green";
				$("#payment_nilai_tunai").attr('disabled', 'disabled');
				document.cookie = "kode_app=33";
			} else if (id == '44') {
				x.style.backgroundColor = "red";
				x.style.color = "black";
				// y1.style.backgroundColor = "red";
				// y2.style.backgroundColor = "red";
				// y3.style.backgroundColor = "red";
				// y4.style.backgroundColor = "red";
				// y5.style.backgroundColor = "red";
				$("#payment_nilai_tunai").attr('disabled', 'disabled');
				document.cookie = "kode_app=44";
			} else {
				x.style.backgroundColor = "black";
				x.style.color = "red";
				// y1.style.backgroundColor = "black";
				// y2.style.backgroundColor = "black";
				// y3.style.backgroundColor = "black";
				// y4.style.backgroundColor = "black";
				// y5.style.backgroundColor = "black";
				$('#payment_nilai_tunai').removeAttr('disabled');
				document.cookie = "kode_app=11";

			}

			close_aplikasi();

		});
		// Retail();
		<?php if ($kategori_kasir_harga == 2) { ?>
			Grosir();
		<?php } else if ($kategori_kasir_harga == 3) { ?>
			Online();
		<?php } else { ?>
			Retail();
		<?php } ?>

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
		document.getElementById('payment_nilai_tunai').value = "";
		document.getElementById('ongkos_kirim').value = "";

		document.getElementById('payment_sub_alatbayar').value = 0;
		document.getElementById('payment_awal_sub_alatbayar').value = 0;

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
				// input.value = '0';
				// $('#tampil_aplikasi_keterangan').removeAttr('disabled');
				$("#form_voucher").show();
				input_invoice.value = u + '-' + '01' + '-0000';

				$('#tampil_invoice').attr('readonly', 'readonly');
			} else {
				// input.value = 'On Line';
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
	// refresh kiri harga menu
	function formatNumber(num) {
		num = Number(num);
		if (Number.isInteger(num)) {
			return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
		} else {
			num = num.toFixed(2);
			let parts = num.split(".");
			parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
			return parts.join(".");
		}
		// benerin return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
	}

	function harga_table_kiri(filter) {
		let row = $(`#table-pembelian tbody tr`);
		const temporary_filehargaonline = document.getElementById('kd_kategori_harga_online').value;


		if (row.length > 0) {
			let jumlahkan_total_diskon = 0;

			function number_format23(number) {
				return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
			}

			row.each(function(i, el) {
				let kd_brg = $(el).find('.transaksi_produk').val();
				let satuan = $(el).find('select#transaksi_satuan_' + kd_brg).val();
				let options = '';

				if (filter == 2 || temporary_filehargaonline == 2) {
					if ($(el).find('select#transaksi_satuan_' + kd_brg + ' option:last').val() != $(el).find('select#transaksi_satuan_' + kd_brg).val()) {
						pilih_satuan($(el).find('.transaksi_produk').val(), $(el).find('select#transaksi_satuan_' + kd_brg + ' option:last').val(), $(el).find('select#transaksi_satuan_' + kd_brg).val());
					}
					let lastOption = $(el).find('select#transaksi_satuan_' + kd_brg + ' option:last').clone();
					let currentSelectedValue = $(el).find('select#transaksi_satuan_' + kd_brg).val();
					$(el).find('select#transaksi_satuan_' + kd_brg).empty();
					if (lastOption.val() === currentSelectedValue) {
						$(el).find('select#transaksi_satuan_' + kd_brg).append(lastOption);
					} else {
						$(el).find('select#transaksi_satuan_' + kd_brg).append(lastOption).val(lastOption.val());
					}
					satuan = $(el).find('select#transaksi_satuan_' + kd_brg).val();
					$.ajax({
						"url": "./route/data_kasir/ajax_satuan_option.php?id=" + kd_brg,
						"type": "GET",
						"dataType": "json",
						"async": false,
						"success": function(response) {
							// Get the currently selected option
							let currentSelectedValue = $(el).find('select#transaksi_satuan_' + kd_brg).val();

							// Clear existing options
							$(el).find('select#transaksi_satuan_' + kd_brg).empty();

							// Generate options from response
							response.forEach((element, i) => {
								// Check if the current element matches the previously selected value
								let isSelected = element === currentSelectedValue ? 'selected' : '';
								options += `<option value="${element}" ${isSelected}>${element}</option>`;
							});

							// Append the new options
							$(el).find('select#transaksi_satuan_' + kd_brg).append(options);
						},
						"error": function(jqXHR, textStatus, errorThrown) {
							console.log(textStatus, errorThrown);
						}
					});
				} else if (filter == 3 || temporary_filehargaonline == 3) {
					if ($(el).find('select#transaksi_satuan_' + kd_brg + ' option:first').val() != $(el).find('select#transaksi_satuan_' + kd_brg).val()) {
						pilih_satuan($(el).find('.transaksi_produk').val(), $(el).find('select#transaksi_satuan_' + kd_brg + ' option:first').val(), $(el).find('select#transaksi_satuan_' + kd_brg).val());
					}
					let firstOption = $(el).find('select#transaksi_satuan_' + kd_brg + ' option:first').clone();
					let currentSelectedValue = $(el).find('select#transaksi_satuan_' + kd_brg).val();
					$(el).find('select#transaksi_satuan_' + kd_brg).empty();
					if (firstOption.val() === currentSelectedValue) {
						$(el).find('select#transaksi_satuan_' + kd_brg).append(firstOption);
					} else {
						$(el).find('select#transaksi_satuan_' + kd_brg).append(firstOption).val(firstOption.val());
					}
					satuan = $(el).find('select#transaksi_satuan_' + kd_brg).val();
					$.ajax({
						"url": "./route/data_kasir/ajax_satuan_option.php?id=" + kd_brg,
						"type": "GET",
						"dataType": "json",
						"async": false,
						"success": function(response) {
							// Get the currently selected option
							let currentSelectedValue = $(el).find('select#transaksi_satuan_' + kd_brg).val();

							// Clear existing options
							$(el).find('select#transaksi_satuan_' + kd_brg).empty();

							// Generate options from response
							response.forEach((element, i) => {
								// Check if the current element matches the previously selected value
								let isSelected = element === currentSelectedValue ? 'selected' : '';
								options += `<option value="${element}" ${isSelected}>${element}</option>`;
							});

							// Append the new options
							$(el).find('select#transaksi_satuan_' + kd_brg).append(options);
						},
						"error": function(jqXHR, textStatus, errorThrown) {
							console.log(textStatus, errorThrown);
						}
					});
				} else {
					$.ajax({
						"url": "./route/data_kasir/ajax_satuan_option.php?id=" + kd_brg,
						"type": "GET",
						"dataType": "json",
						"async": false,
						"success": function(response) {
							// Get the currently selected option
							let currentSelectedValue = $(el).find('select#transaksi_satuan_' + kd_brg).val();

							// Clear existing options
							$(el).find('select#transaksi_satuan_' + kd_brg).empty();

							// Generate options from response
							response.forEach((element, i) => {
								// Check if the current element matches the previously selected value
								let isSelected = element === currentSelectedValue ? 'selected' : '';
								options += `<option value="${element}" ${isSelected}>${element}</option>`;
							});

							// Append the new options
							$(el).find('select#transaksi_satuan_' + kd_brg).append(options);
						},
						"error": function(jqXHR, textStatus, errorThrown) {
							console.log(textStatus, errorThrown);
						}
					});
				}

				//new
				let status_member = filter;
				let kd_value = $(el).find('.transaksi_jumlah').val();
				let kd_satuan = $(el).find('.transaksi_satuan_awal').val();
				let kd_valuesatuan = $(el).find('.transaksi_satuan_qty').val();

				//
				let diskon_total = parseInt($(el).find('.transaksi_diskon').val());
				$.ajax({
					type: 'GET',
					url: 'route/data_kasir/ajax_diskon.php?kode=' + kd_brg + '&satuan=' + satuan + '&status_member=' + status_member,
					dataType: 'json',
					async: false,
					success: function(response) {
						harga_member = response['harga'];
					},
					error: function(xhr, status, error) {
						console.log(xhr.responseText);
					}
				});
				//new
				$(el).find('.transaksi_harga').val(harga_member);
				$(el).find('td:eq(3) input').val(harga_member);

				//$(el).find('td:eq(3)').html(formatNumber(harga_member));
				ubah_jumlah(kd_brg, kd_value, kd_satuan);
				//
				jumlahkan_total_diskon += diskon_total;

				$(el).find('.transaksi_total_diskon').val(diskon_total);
				$(el).find('.tombol-hapus-penjualan').attr("total_diskon", diskon_total);

			});

			// $(".pembelian_total_diskon").attr("id", jumlahkan_total_diskon);
			// let jumlahkan_total = $(".pembelian_total").attr("id");
			// var tax = $(".total_tax").val();
			// $(".pembelian_total_diskon").text("Rp." + formatNumber(jumlahkan_total_diskon.toFixed(0)));
			// $(".sub_total_pembelian").text("Rp." + formatNumber(jumlahkan_total) + "");

			// var subjumlah = Math.round(jumlahkan_total - jumlahkan_total_diskon);
			// var g_total = Math.round(((jumlahkan_total - jumlahkan_total_diskon) + (jumlahkan_total - jumlahkan_total_diskon) * tax / 100));
			// $(".total_pembelian").text("Rp." + formatNumber(g_total.toFixed(0)) + "");

			// $(".total_pembelian").attr("id", g_total);
			// $(".sub_total_pembelian").attr("id", jumlahkan_total);

			// $(".total_form").val(g_total);
			// $(".sub_total_form").val(jumlahkan_total);

			// // total_diskon
			// $(".total_diskon_pembelian").text("Rp." + formatNumber(jumlahkan_total_diskon.toFixed(0)) + ",-");
			// $(".sub_total_diskon_pembelian").text("Rp." + formatNumber(jumlahkan_total_diskon.toFixed(0)) + "");
			// $(".total_diskon_pembelian").attr("id", jumlahkan_total_diskon);
			// $(".sub_total_diskon_pembelian").attr("id", jumlahkan_total_diskon);

			// $(".total_diskon_form").val(jumlahkan_total_diskon);
			// $(".sub_total_diskon_form").val(jumlahkan_total_diskon);
			// $(".subjumlah_form").val(subjumlah);

			// // kosongkan
			// $("#tambahkan_id").val("");
			// $("#tambahkan_kode").val("");
			// $("#tambahkan_nama").val("");
			// $("#tambahkan_jumlah").val("");
			// $("#tambahkan_harga").val("");
			// $("#tambahkan_total").val("");
			// $("#tambahkan_diskon").val("");
			// $("#tambahkan_total_diskon").val("");
			// $("#tambahkan_ket").val("");
			// $("#tambahkan_kd_promo").val("");
			// $("#tambahkan_harga_dasar").val("");
			// //$(".pembelian_total_diskon").text("Rp." + formatNumber(jumlahkan_total_diskon.toFixed(0)));
			// $(".pembelian_total_diskon").text("Rp." + formatNumber(g_total.toFixed(0)) + "");

			// // update Tax
			// var tax = $(".total_tax").val();
			// if (tax.length != 0 && tax != "") {

			// 	var sub_total = $(".sub_total_pembelian").attr("id");

			// 	var total_diskon = $(".sub_total_diskon_pembelian").attr("id");

			// 	var hasil_tax = Math.round((sub_total - total_diskon) * (tax / 100));

			// 	$(".hasil_tax").text("Rp." + formatNumber(hasil_tax.toFixed(0)) + "");
			// 	$(".hasil_tax_form").val(hasil_tax.toFixed(0));
			// } else {
			// 	var sub_total_pembelian = $(".sub_total_pembelian").attr("id");

			// 	$(".total_pembelian").attr("id", sub_total_pembelian);
			// 	$(".total_pembelian").text("Rp." + formatNumber(sub_total_pembelian) + ",-");
			// }
			// $('#tombolAplikasi').attr('disabled', 'disabled');
			// $('#tombol-simpan').attr('disabled', 'disabled');
			// $('#tombol-simpan2').attr('disabled', 'disabled');
			// // $('#tombolPayment').show();
			// $('#tombolPayment').removeAttr('disabled');
			// paymenttotalkembali();
		}
	}

	function Retail() {
		$("#tombol-simpan, #tombol-simpan2, #tombolPayment").prop("disabled", true);

		// 📝 Show "please wait" message under tombol-simpan
		if ($("#wait-message").length === 0) {
			$("#tombol-simpan").after(
				'<p id="wait-message" style="color:red; margin-top:5px;">⏳ Updating harga...</p>'
			);
		}
		console.log("masuk Retail");
		clear_form_kanan();
		clear_form_search();
		//document.getElementById("tampil_aplikasi_keterangan").value = null;
		document.getElementById("nama_member").value = null;
		document.getElementById("member_kategori").innerHTML = "-";
		var x = document.getElementById("label_header_kanan");
		x.innerHTML = "Retail";

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
		document.cookie = "kode_kategori=1";
		document.cookie = "kode_kategori_tambahan=1";
		menupilihankanan(11);
		harga_table_kiri(1);
		$(document).one("ajaxStop", function() {
			$("#tombolPayment").prop("disabled", false);
			$("#wait-message").remove(); // remove the <p> message
			console.log("All AJAX done → buttons enabled again");
		});
		const jumlah_diskon_input = document.querySelectorAll('.jumlah_diskon_input');
		jumlah_diskon_input.forEach(input => {
			input.setAttribute('readonly', true);
			input.setAttribute('disabled', true);

		});
		const keterangan_input = document.querySelectorAll('.keterangan_input');
		keterangan_input.forEach(input => {
			input.setAttribute('readonly', true);
			input.setAttribute('disabled', true);

		});
		const jumlah_harga_online_input = document.querySelectorAll('.jumlah_harga_online_input');
		jumlah_harga_online_input.forEach(input => {
			input.setAttribute('readonly', true);
			input.setAttribute('disabled', true);
		});
		document.getElementById('kd_kategori_harga_online').value = 1;

	};

	function Grosir() {
		Retail();
		// 🔒 Disable buttons
		$("#tombol-simpan, #tombol-simpan2, #tombolPayment").prop("disabled", true);

		// 📝 Show "please wait" message under tombol-simpan
		if ($("#wait-message").length === 0) {
			$("#tombol-simpan").after(
				'<p id="wait-message" style="color:red; margin-top:5px;">⏳ Updating harga...</p>'
			);
		}
		console.log("masuk Grosir");
		clear_form_kanan();
		clear_form_search();
		// document.getElementById("tampil_aplikasi_keterangan").value = null;
		document.getElementById("nama_member").value = null;
		document.getElementById("member_kategori").innerHTML = "-";


		var x = document.getElementById("label_header_kanan");
		x.innerHTML = "Grosir";


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
		document.cookie = "kode_kategori=2";
		document.cookie = "kode_kategori_tambahan=2";
		menupilihankanan(11);
		harga_table_kiri(2);
		$(document).one("ajaxStop", function() {
			$("#tombolPayment").prop("disabled", false);
			$("#wait-message").remove(); // remove the <p> message
			console.log("All AJAX done → buttons enabled again");
		});
		const jumlah_diskon_input = document.querySelectorAll('.jumlah_diskon_input');
		jumlah_diskon_input.forEach(input => {
			if (input.hasAttribute('readonly')) {
				input.removeAttribute('readonly');
				input.removeAttribute('disabled');

			}
		});
		const keterangan_input = document.querySelectorAll('.keterangan_input');
		keterangan_input.forEach(input => {
			if (input.hasAttribute('readonly')) {
				input.removeAttribute('readonly');
				input.removeAttribute('disabled');

			}
		});
		const jumlah_harga_online_input = document.querySelectorAll('.jumlah_harga_online_input');
		jumlah_harga_online_input.forEach(input => {
			input.setAttribute('readonly', true);
			input.setAttribute('disabled', true);
		});
		document.getElementById('kd_kategori_harga_online').value = 2;
	};

	function Online() {
		Retail();
		$("#tombol-simpan, #tombol-simpan2, #tombolPayment").prop("disabled", true);

		// 📝 Show "please wait" message under tombol-simpan
		if ($("#wait-message").length === 0) {
			$("#tombol-simpan").after(
				'<p id="wait-message" style="color:red; margin-top:5px;">⏳ Updating harga...</p>'
			);
		}
		console.log("masuk Online");
		clear_form_kanan();
		clear_form_search();
		var x = document.getElementById("label_header_kanan");
		x.innerHTML = "Online";
		// document.getElementById("tampil_aplikasi_keterangan").value = null;
		document.getElementById("nama_member").value = null;
		document.getElementById("member_kategori").innerHTML = "-";
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
		document.cookie = "kode_kategori=3";
		document.cookie = "kode_kategori_tambahan=3";
		menupilihankanan(11);
		harga_table_kiri(3);
		$(document).one("ajaxStop", function() {
			$("#tombolPayment").prop("disabled", false);
			$("#wait-message").remove(); // remove the <p> message
			console.log("All AJAX done → buttons enabled again");
		});
		const jumlah_diskon_input = document.querySelectorAll('.jumlah_diskon_input');
		jumlah_diskon_input.forEach(input => {
			if (input.hasAttribute('readonly')) {
				input.removeAttribute('readonly');
				input.removeAttribute('disabled');
			}
		});
		const keterangan_input = document.querySelectorAll('.keterangan_input');
		keterangan_input.forEach(input => {
			if (input.hasAttribute('readonly')) {
				input.removeAttribute('readonly');
				input.removeAttribute('disabled');
			}
		});
		const jumlah_harga_online_input = document.querySelectorAll('.jumlah_harga_online_input');
		jumlah_harga_online_input.forEach(input => {
			if (input.hasAttribute('readonly')) {
				input.removeAttribute('readonly');
			}
			if (input.hasAttribute('disabled')) {
				input.removeAttribute('disabled');
			}
		});
		document.getElementById('kd_kategori_harga_online').value = 3;


	};

	function MS() {
		$("#tombol-simpan, #tombol-simpan2, #tombolPayment").prop("disabled", true);

		// 📝 Show "please wait" message under tombol-simpan
		if ($("#wait-message").length === 0) {
			$("#tombol-simpan").after(
				'<p id="wait-message" style="color:red; margin-top:5px;">⏳ Updating harga...</p>'
			);
		}
		console.log("masuk MS");
		clear_form_kanan();
		clear_form_search();
		var x = document.getElementById("label_header_kanan");
		x.innerHTML = "Member Silver";

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
		document.cookie = "kode_kategori=4";
		menupilihankanan(11);
		harga_table_kiri(4);
		$(document).one("ajaxStop", function() {
			$("#tombolPayment").prop("disabled", false);
			$("#wait-message").remove(); // remove the <p> message
			console.log("All AJAX done → buttons enabled again");
		});
		// const jumlah_diskon_input = document.querySelectorAll('.jumlah_diskon_input');
		// jumlah_diskon_input.forEach(input => {
		// 	input.setAttribute('readonly', true);
		// 	input.setAttribute('disabled', true);
		// });
		// const keterangan_input = document.querySelectorAll('.keterangan_input');
		// keterangan_input.forEach(input => {
		// 	input.setAttribute('readonly', true);
		// 	input.setAttribute('disabled', true);
		// });
		// const jumlah_harga_online_input = document.querySelectorAll('.jumlah_harga_online_input');
		// jumlah_harga_online_input.forEach(input => {
		// 	input.setAttribute('readonly', true);
		// 	input.setAttribute('disabled', true);
		// });

		// document.getElementById('kd_kategori_harga_online').value = 4;

	};

	function MG() {
		$("#tombol-simpan, #tombol-simpan2, #tombolPayment").prop("disabled", true);

		// 📝 Show "please wait" message under tombol-simpan
		if ($("#wait-message").length === 0) {
			$("#tombol-simpan").after(
				'<p id="wait-message" style="color:red; margin-top:5px;">⏳ Updating harga...</p>'
			);
		}
		console.log("masuk MG");
		clear_form_kanan();
		clear_form_search();
		var x = document.getElementById("label_header_kanan");
		x.innerHTML = "Member Gold";

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
		document.cookie = "kode_kategori=5";
		menupilihankanan(11);
		harga_table_kiri(5);
		$(document).one("ajaxStop", function() {
			$("#tombolPayment").prop("disabled", false);
			$("#wait-message").remove(); // remove the <p> message
			console.log("All AJAX done → buttons enabled again");
		});
		// const jumlah_diskon_input = document.querySelectorAll('.jumlah_diskon_input');
		// jumlah_diskon_input.forEach(input => {
		// 	input.setAttribute('readonly', true);
		// 	input.setAttribute('disabled', true);
		// });
		// const keterangan_input = document.querySelectorAll('.keterangan_input');
		// keterangan_input.forEach(input => {
		// 	input.setAttribute('readonly', true);
		// 	input.setAttribute('disabled', true);
		// });
		// const jumlah_harga_online_input = document.querySelectorAll('.jumlah_harga_online_input');
		// jumlah_harga_online_input.forEach(input => {
		// 	input.setAttribute('readonly', true);
		// 	input.setAttribute('disabled', true);
		// });


		// document.getElementById('kd_kategori_harga_online').value = 5;

	};

	function MP() {
		$("#tombol-simpan, #tombol-simpan2, #tombolPayment").prop("disabled", true);

		// 📝 Show "please wait" message under tombol-simpan
		if ($("#wait-message").length === 0) {
			$("#tombol-simpan").after(
				'<p id="wait-message" style="color:red; margin-top:5px;">⏳ Updating harga...</p>'
			);
		}
		console.log("masuk MP");
		clear_form_kanan();
		clear_form_search();
		var x = document.getElementById("label_header_kanan");
		x.innerHTML = "Member Platinum";

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
		document.cookie = "kode_kategori=6";
		menupilihankanan(11);
		harga_table_kiri(6);
		$(document).one("ajaxStop", function() {
			$("#tombolPayment").prop("disabled", false);
			$("#wait-message").remove(); // remove the <p> message
			console.log("All AJAX done → buttons enabled again");
		});
		// const jumlah_diskon_input = document.querySelectorAll('.jumlah_diskon_input');
		// jumlah_diskon_input.forEach(input => {
		// 	input.setAttribute('readonly', true);
		// 	input.setAttribute('disabled', true);
		// });
		// const keterangan_input = document.querySelectorAll('.keterangan_input');
		// keterangan_input.forEach(input => {
		// 	input.setAttribute('readonly', true);
		// 	input.setAttribute('disabled', true);
		// });
		// const jumlah_harga_online_input = document.querySelectorAll('.jumlah_harga_online_input');
		// jumlah_harga_online_input.forEach(input => {
		// 	input.setAttribute('readonly', true);
		// 	input.setAttribute('disabled', true);
		// });
		// document.getElementById('kd_kategori_harga_online').value = 6;


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