<?php
$login_hash = $_SESSION['login_hash'];
$en = $_SESSION['employee_number'];
$to = $_SESSION['to'];

$judulform = "Laporan Penjualan Grosir (BARANG)";

$data = 'lap_mutasi';
$rute = 'list_mutasi';
$aksi = 'aksi_list_mutasi';


$tabel = 'mutasi_semua';
$f1 = 'tgl';
$f2 = 'regional';
$f3 = 'kd_cus';
$f4 = 'nama_outlet';
$f5 = 'kd_sage';
$f6 = 'nama_barang';
$f7 = 'satuan';
$f8 = 'qty_awal';
$f9 = 'nilai_awal';
$f10 = 'qty_beli';
$f11 = 'nilai_beli';
$f12 = 'qt_produksi';
$f13 = 'nilai_produksi';
$f14 = 'qt_terima_int';
$f15 = 'nilai_terima_int';
$f16 = 'qt_tersedia';
$f17 = 'nilai_tersedia';
$f18 = 'harga_rata';
$f19 = 'qt_kirim_int';
$f20 = 'nilai_kirim_int';
$f21 = 'qt_pake';
$f22 = 'nilai_pake';
$f23 = 'qt_jual';
$f24 = 'nilai_jual';
$f25 = 'hpp_jual';
$f26 = 'qt_akhir';
$f27 = 'nilai_akhir';


$j1 = 'Tanggal';
$j2 = 'Regional';
$j3 = 'Kd Cus';
$j4 = 'Nama Outlet';
$j5 = 'Kd Sage';
$j6 = 'Nama Barang';
$j7 = 'Satuan';
$j8 = 'Qty Awal';
$j9 = 'Nilai Awal';
$j10 = 'Qty Beli';
$j11 = 'Nilai Beli';
$j12 = 'Qty Produksi';
$j13 = 'Nilai Produksi';
$j14 = 'Qty Terima Int';
$j15 = 'Nilai Terima Int';
$j16 = 'Qty Tersedia';
$j17 = 'Nilai Tersedia';
$j18 = 'Harga Rata';
$j19 = 'Qty Kirim Int';
$j20 = 'Nilai Kirim Int';
$j21 = 'Qty Pakai';
$j22 = 'Nilai Pakai';
$j23 = 'Qty Jual';
$j24 = 'Nilai Jual';
$j25 = 'Hpp Jual';
$j26 = 'Qty Akhir';
$j27 = 'Nilai Akhir';

//session_start();
if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
	echo "<link href='style.css' rel='stylesheet' type='text/css'>
  <center>Untuk mengakses modul, Anda harus login <br>";
	echo "<a href=../../index.php><b>LOGIN</b></a></center>";
} else {

	switch ($_GET['act']) {
		//Tampil Data 
		default:
?>

			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper" style="background-color: ghostwhite;">
				<!-- Content Header (Page header) -->
				<section class="content-header  wow fadeInDown" data-wow-duration=".3s" data-wow-delay=".3s">
					<div class="container-fluid">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1 class="list-gds">
									<b><?php echo $judulform; ?></b> <small style="font-weight: 100;">report</small>
								</h1>
							</div>
							<div class="col-sm-6">
								<ol class="breadcrumb float-sm-right">
									<li class="breadcrumb-item"><a href="main.php?route=home">Beranda</a></li>
									<li class="breadcrumb-item active">Laporan</li>
									<li class="breadcrumb-item active"><?php echo $judulform; ?></li>
								</ol>
							</div>
						</div>
					</div><!-- /.container-fluid -->
				</section>

				<!-- Main content -->
				<!-- <section class="content wow fadeInUp" data-wow-duration=".2s" data-wow-delay=".1s" > -->
				<section class="content wow ">
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

											<!-- Wrapper 1 -->
											<div class="wrapper" style="min-height:30%">
												<form role="form" action="route/<?php echo $data; ?>/<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=report-laba-penjualan_grosir" method="post">
													<div class="row">
														<!-- Batas -------------- -->


														<div class="col-lg-2">

															<div class="form-group">
																<label>Tanggal Awal</label>
																<input type="date" class="form-control" name="tgl_awal" onclick="displayHasil(this.value)" placeholder="Masukkan Tanggal Awal .. (Wajib)" value="<?php echo date('Y-m-d') ?>" required="required">
															</div>




															<div class="form-group">
																<label>Tanggal Akhir</label>
																<input type="date" class="form-control" name="tgl_akhir" onclick="displayHasil(this.value)" placeholder="Masukkan Tanggal Akhir .. (Wajib)" value="<?php echo date('Y-m-d') ?>" required="required">
															</div>
														</div>

														<!-- Filter -->
														<div class="col-lg-2">
															<!-- <div class="col-lg-12"> -->
															<div class="form-group">
																<label>Filter
																</label>
																<!-- <div>
                                      <input type="radio" name="cakup" onclick="displayResult(this.value)" value="Kota"> Kota
                                    </div> -->
																<!-- <div>
                                      <input type="radio" name="cakup" onclick="displayResult(this.value)" value="Outlet"> Outlet
                                    </div> -->
																<!-- <div>
																	<input type="radio" name="cakup" onclick="displayResult(this.value)" value="Unitkerja"> Unit Kerja
																</div>
																<div>
																	<input type="radio" name="cakup" onclick="displayResult(this.value)" value="Area"> Regional
																</div> -->
																<div>
																	<input type="radio" name="cakup" onclick="displayResult(this.value)" value="Semua"> Semua
																</div>
																<!-- <div>
                                      <input type="radio" name="cakup" onclick="displayResult(this.value)" value="Divisi"> Divisi
                                    </div> -->


																<div class="form-group">
																	<!-- <label>Cakupan terpilih : </label> -->
																	<input type="text" id="result" readonly style="width:100;font-size:120%;font-weight:600">
																</div>

															</div>
															<!-- </div> -->
														</div>
														<!-- Filter -->



														<!-- Filter Isian-------------- -->

														<div class="col-lg-3">
															<div class="row">

																<div id="isian0" style="display: none;">
																	<div class="row" style="height:133px">
																		<div class="col-lg-7">
																			<div class="form-group">
																				<form method="post" action="simpan_index.php?act=proses2">
																				</form>
																			</div>
																		</div>

																	</div>
																</div>

																<!-- Show Utk Kota -->
																<div id="isian1" style="display: none;">
																	<div class="row">
																		<div class="col-lg-10">
																			<div class="form-group">
																				<form method="post" action="simpan_index.php">
																					<div class="row">
																						<div class="col-lg-7">

																							<label>Kode Kota</label>
																							<input type="text" class="form-control" required="required" id="tampil_kota_kode" placeholder="Isi Kode Kota">
																						</div>
																						<div class="col-lg-5">
																							<button style="margin-top: 27px" type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#cariKota">
																								<i class="fa fa-search"></i> Cari Kota
																							</button>
																						</div>
																					</div>

																					<label>Kota <span id="status_kota"></span></label>
																					<input type="text" class="form-control" name="kota" value="" required="required" placeholder="Nama Kota .." id="tampil_kota_nama" readonly>

																				</form>
																			</div>
																		</div>

																		<div class="col-lg-5">
																			<div class="form-group">

																				<!-- Modal KOTA-->
																				<div class="modal fade" id="cariKota" tabindex="-1" role="dialog" aria-labelledby="cariKotaLabel" aria-hidden="true">
																					<div class="modal-dialog" role="document">
																						<div class="modal-content">
																							<div class="modal-header">
																								Data KOTA
																								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																									<span aria-hidden="true">&times;&nbsp; Close</span>
																								</button>
																							</div>
																							<div class="modal-body">

																								<div class="table-responsive">
																									<table class="table table-bordered table-striped table-hover" id="table-datatable-kota">
																										<thead>
																											<tr>
																												<th class="text-center">NO</th>
																												<th>KODE KOTA</th>
																												<th>NAMA KOTA</th>
																												<th>KD AREA</th>
																												<th></th>
																											</tr>
																										</thead>
																										<tbody>
																											<?php
																											$no = 1;
																											$data = mysqli_query($koneksi, "SELECT kode,nama,kd_area FROM kotabaru ORDER BY kode ASC");
																											while ($d = mysqli_fetch_array($data)) {
																											?>
																												<tr>
																													<td width="1%" class="text-center"><?php echo $no++; ?></td>
																													<td width="3%"><?php echo $d['kode']; ?></td>
																													<td><?php echo $d['nama']; ?></td>
																													<td width="1%" class="text-center"><?php echo $d['kd_area']; ?></td>
																													<td width="1%">
																														<button type="button" class="btn btn-success btn-sm modal-pilih-kota" id="<?php echo $d['kode']; ?>" kode="<?php echo $d['kode']; ?>" nama="<?php echo $d['nama']; ?>" data-dismiss="modal">Pilih</button>
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
																	</div>
																</div>
																<!-- Show Utk Kota End-->

																<!-- Show utk Outlet -->
																<div id="isian2" style="display: none;">
																	<div class="row">
																		<div class="col-lg-10">
																			<div class="form-group">
																				<form method="post" action="simpan_index.php">
																					<div class="row">
																						<div class="col-lg-7">

																							<label>Kode Outlet</label>
																							<input type="text" class="form-control" name="kd_outlet" required="required" id="tampil_outlet_kode" placeholder="Isi Kode Outlet">
																						</div>
																						<div class="col-lg-5">
																							<button style="margin-top: 27px" type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#cariOutlet">
																								<i class="fa fa-search"></i> Cari Outlet
																							</button>
																						</div>
																					</div>

																					<label>Outlet <span id="status_outlet"></span></label>
																					<input type="text" class="form-control" name="outlet" value="" required="required" placeholder="Nama Outlet .." id="tampil_outlet_nama" readonly>

																				</form>
																			</div>
																		</div>

																		<div class="col-lg-5">
																			<div class="form-group">

																				<!-- Modal OUTLET-->
																				<div class="modal fade" id="cariOutlet" tabindex="-1" role="dialog" aria-labelledby="cariOutletLabel" aria-hidden="true">
																					<div class="modal-dialog" role="document">
																						<div class="modal-content">
																							<div class="modal-header">
																								Data OUTLET
																								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																									<span aria-hidden="true">&times;&nbsp; Close</span>
																								</button>
																							</div>
																							<div class="modal-body">

																								<div class="table-responsive">
																									<table class="table table-bordered table-striped table-hover" id="table-datatable-outlet">
																										<thead>
																											<tr>
																												<th class="text-center">NO</th>
																												<th>KODE OUTLET</th>
																												<th>NAMA OUTLET</th>
																												<th>KD AREA</th>
																												<th></th>
																											</tr>
																										</thead>
																										<tbody>
																											<?php
																											$no = 1;
																											$data = mysqli_query($koneksi, "SELECT kd_cus,nama,kd_area FROM pelanggan ORDER BY kd_cus ASC");
																											while ($d = mysqli_fetch_array($data)) {
																											?>
																												<tr>
																													<td width="1%" class="text-center"><?php echo $no++; ?></td>
																													<td width="3%"><?php echo $d['kd_cus']; ?></td>
																													<td><?php echo $d['nama']; ?></td>
																													<td width="1%" class="text-center"><?php echo $d['kd_area']; ?></td>
																													<td width="1%">
																														<button type="button" class="btn btn-success btn-sm modal-pilih-outlet" id="<?php echo $d['kd_cus']; ?>" kode="<?php echo $d['kd_cus']; ?>" nama="<?php echo $d['nama']; ?>" data-dismiss="modal">Pilih</button>
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
																				<!-- Modal OUTLET End-->

																			</div>
																		</div>
																	</div>
																</div>
																<!-- Show utk Outlet End -->

																<!-- Show utk Area -->
																<div id="isian3" style="display: none;">
																	<div class="row">
																		<div class="col-lg-10">
																			<div class="form-group">
																				<form method="post" action="simpan_index.php">

																					<div class="row">
																						<div class="col-lg-7">
																							<label>Kode Area</label>
																							<!-- <input type="hidden" class="form-control" name="area" required="required" id="tampil_area_id"> -->
																							<input type="text" class="form-control" required="required" id="tampil_area_kode" placeholder="Isi Kode area">
																						</div>
																						<div class="col-lg-5">

																							<button style="margin-top: 27px" type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#cariArea">
																								<i class="fa fa-search"></i> Cari Area
																							</button>
																						</div>
																					</div>

																					<label>Area <span id="status_area"></span></label>
																					<input type="text" class="form-control" name="area" value="" required="required" placeholder="Nama Area .." id="tampil_area_nama" readonly>

																				</form>
																			</div>
																		</div>

																		<div class="col-lg-5">
																			<div class="form-group">

																				<!-- Modal Area-->
																				<div class="modal fade" id="cariArea" tabindex="-1" role="dialog" aria-labelledby="cariAreaLabel" aria-hidden="true">
																					<div class="modal-dialog" role="document">
																						<div class="modal-content">
																							<div class="modal-header">
																								Data AREA
																								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																									<span aria-hidden="true">&times;&nbsp; CLose</span>
																								</button>
																							</div>
																							<div class="modal-body">

																								<div class="table-responsive">
																									<table class="table table-bordered table-striped table-hover" id="table-datatable-area">
																										<thead>
																											<tr>
																												<th class="text-center">NO</th>
																												<th>KODE AREA</th>
																												<th>NAMA AREA</th>
																												<th></th>
																											</tr>
																										</thead>
																										<tbody>
																											<?php
																											$no = 1;
																											$data = mysqli_query($koneksi, "SELECT kode,nama FROM area ORDER BY kode ASC");
																											while ($d = mysqli_fetch_array($data)) {
																											?>
																												<tr>
																													<td width="1%" class="text-center"><?php echo $no++; ?></td>
																													<td width="3%"><?php echo $d['kode']; ?></td>
																													<td><?php echo $d['nama']; ?></td>
																													<td width="1%">
																														<button type="button" class="btn btn-success btn-sm modal-pilih-area" id="<?php echo $d['kode']; ?>" kode="<?php echo $d['kode']; ?>" nama="<?php echo $d['nama']; ?>" data-dismiss="modal">Pilih</button>
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
																				<!-- Modal Area End-->

																			</div>
																		</div>
																	</div>
																</div>
																<!-- Show utk Area End -->


																<!-- Show utk Divisi -->
																<div id="isian4" style="display: none;">
																	<div class="row">
																		<div class="col-lg-10">
																			<div class="form-group">
																				<form method="post" action="simpan_index.php">

																					<div class="row">
																						<div class="col-lg-7">
																							<label>Kode Divisi</label>
																							<!-- <input type="hidden" class="form-control" name="area" required="required" id="tampil_area_id"> -->
																							<input type="text" class="form-control" required="required" id="tampil_divisi_kode" placeholder="Isi Kode Divisi">
																						</div>
																						<div class="col-lg-5">

																							<button style="margin-top: 27px" type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#cariDivisi">
																								<i class="fa fa-search"></i> Cari Divisi
																							</button>
																						</div>
																					</div>

																					<label>Divisi <span id="status_divisi"></span></label>
																					<input type="text" class="form-control" name="area" value="" required="required" placeholder="Nama Divisi .." id="tampil_divisi_nama" readonly>

																				</form>
																			</div>
																		</div>

																		<div class="col-lg-5">
																			<div class="form-group">

																				<!-- Modal Area-->
																				<div class="modal fade" id="cariDivisi" tabindex="-1" role="dialog" aria-labelledby="cariDivisiLabel" aria-hidden="true">
																					<div class="modal-dialog" role="document">
																						<div class="modal-content">
																							<div class="modal-header">
																								Data Divisi
																								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																									<span aria-hidden="true">&times;&nbsp; CLose</span>
																								</button>
																							</div>
																							<div class="modal-body">

																								<div class="table-responsive">
																									<table class="table table-bordered table-striped table-hover" id="table-datatable-divisi">
																										<thead>
																											<tr>
																												<th class="text-center">NO</th>
																												<th>KODE DIVISI</th>
																												<th>NAMA DIVISI</th>
																												<th></th>
																											</tr>
																										</thead>
																										<tbody>
																											<?php
																											$no = 1;
																											$data = mysqli_query($koneksi, "SELECT kode_pengaju,nama_unit FROM pengaju WHERE manager>10 ORDER BY kode_pengaju ASC");
																											while ($d = mysqli_fetch_array($data)) {
																											?>
																												<tr>
																													<td width="1%" class="text-center"><?php echo $no++; ?></td>
																													<td width="3%"><?php echo $d['kode_pengaju']; ?></td>
																													<td><?php echo $d['nama_unit']; ?></td>
																													<td width="1%">
																														<button type="button" class="btn btn-success btn-sm modal-pilih-divisi" id="<?php echo $d['kode_pengaju']; ?>" kode="<?php echo $d['kode_pengaju']; ?>" nama="<?php echo $d['nama_unit']; ?>" data-dismiss="modal">Pilih</button>
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
																				<!-- Modal Divisi End-->

																			</div>
																		</div>
																	</div>
																</div>
																<!-- Show utk Divisi End -->
																<!-- Show utk Unit Kerja -->
																<div id="isian5" style="display: none;">
																	<div class="row">
																		<div class="col-lg-10">
																			<div class="form-group">
																				<form method="post" action="simpan_index.php">
																					<div class="row">
																						<div class="col-lg-6">

																							<label>Kode Unit Kerja</label>
																							<input type="text" class="form-control" name="kd_unitkerja" required="required" id="tampil_unitkerja_kode" placeholder="Isi Kode Unit Kerja">
																						</div>
																						<div class="col-lg-6">
																							<button style="margin-top: 27px" type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#cariUnitkerja">
																								<i class="fa fa-search"></i> Cari Unit Kerja
																							</button>
																						</div>
																					</div>

																					<label>Unit Kerja <span id="status_unitkerja"></span></label>
																					<input type="text" class="form-control" name="unitkerja" value="" required="required" placeholder="Nama Unit Kerja .." id="tampil_unitkerja_nama" readonly>

																				</form>
																			</div>
																		</div>

																		<div class="col-lg-5">
																			<div class="form-group">

																				<!-- Modal UNIT KERJA-->
																				<div class="modal fade" id="cariUnitkerja" tabindex="-1" role="dialog" aria-labelledby="cariUnitkerjaLabel" aria-hidden="true">
																					<div class="modal-dialog" role="document">
																						<div class="modal-content">
																							<div class="modal-header">
																								Data UNIT KERJA
																								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																									<span aria-hidden="true">&times;&nbsp; Close</span>
																								</button>
																							</div>
																							<div class="modal-body">

																								<div class="table-responsive">
																									<table class="table table-bordered table-striped table-hover" id="table-datatable-unitkerja">
																										<thead>
																											<tr>
																												<th class="text-center">NO</th>
																												<th>KODE UNIT</th>
																												<th>NAMA UNIT KERJA</th>
																												<th>KD AREA</th>
																												<th></th>
																											</tr>
																										</thead>
																										<tbody>
																											<?php
																											$no = 1;
																											$data = mysqli_query($koneksi, "SELECT kd_cus,nama,kd_area FROM unit_kerja ORDER BY kd_cus ASC");
																											while ($d = mysqli_fetch_array($data)) {
																											?>
																												<tr>
																													<td width="1%" class="text-center"><?php echo $no++; ?></td>
																													<td width="3%"><?php echo $d['kd_cus']; ?></td>
																													<td><?php echo $d['nama']; ?></td>
																													<td width="1%" class="text-center"><?php echo $d['kd_area']; ?></td>
																													<td width="1%">
																														<button type="button" class="btn btn-success btn-sm modal-pilih-unitkerja" id="<?php echo $d['kd_cus']; ?>" kode="<?php echo $d['kd_cus']; ?>" nama="<?php echo $d['nama']; ?>" data-dismiss="modal">Pilih</button>
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
																				<!-- Modal UNIT KERJA End-->

																			</div>
																		</div>
																	</div>
																</div>
																<!-- Show utk unitkerja End -->




															</div>

														</div>

														<!-- Filter Isian -->



														<!-- Generate -->
														<div class="col-lg-3">

															<div class="row">
																<div class="col-lg-12">
																	<input type="hidden" name="kota" id="tampil_kota_id">
																	<input type="hidden" name="outlet" id="tampil_outlet_id">
																	<input type="hidden" name="area" id="tampil_area_id">
																	<input type="hidden" name="divisi" id="tampil_divisi_id">
																	<input type="hidden" name="unitkerja" id="tampil_unitkerja_id">

																	<div class="form-group">
																		<input type="submit" class="btn btn-primary elevation-2" style="opacity: .7" value="Generate Report" />
																	</div>

																</div>
															</div>
														</div>
														<!-- Generate -->

													</div>
												</form>
											</div>
											<!-- end Wrapper 1 -->

											<hr />

											<!-- <input style="width: 100px;"  value="RESET" onclick="window.location='main.php?route=pb1&act';" class="btn btn-sm btn-danger "> -->

											<!-- Wraper 3 -->
											<div class="wrapper" style="min-height:10">
												<div class="row">
													<div class="col-lg-7">
														<div class="form-group">
															<a href="main.php?route=home" title="Batal"> <button class="btn btn-danger btn-sm elevation-2" style="opacity: .7;width:80px"><i class="fa fa-edit"></i> Batal</button></a>
														</div>
													</div>
												</div>
											</div>
											<!-- end Wraper 3 -->

										</div><!-- /.box-body -->
									</div><!-- /.box -->
								</section><!-- /.Left col -->
							</div><!-- /.row (main row) -->
						</div>
					</div>
				</section><!-- /.content -->
			</div><!-- /.content-wrapper -->


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
					var x3 = document.getElementById("isian3");
					var x4 = document.getElementById("isian4");
					var x5 = document.getElementById("isian5")

					x0.style.display = "none";
					x1.style.display = "none";
					x2.style.display = "none";
					x3.style.display = "none";
					x4.style.display = "none";
					x5.style.display = "none";

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
					var x3 = document.getElementById("isian3");
					var x4 = document.getElementById("isian4");
					var x5 = document.getElementById("isian5");
					if (x == "Semua") {
						x0.style.display = "block";
						x1.style.display = "none";
						x2.style.display = "none";
						x3.style.display = "none";
						x4.style.display = "none";
						// alert(x + " adalah Filter 2");
					} else if (x == "Kota") {
						x0.style.display = "none";
						x1.style.display = "block";
						x2.style.display = "none";
						x3.style.display = "none";
						x4.style.display = "none";
						x5.style.display = "none";
						// alert(x + " adalah Filter 3");
					} else if (x == "Outlet") {
						x0.style.display = "none";
						x1.style.display = "none";
						x2.style.display = "block";
						x3.style.display = "none";
						x4.style.display = "none";
						x5.style.display = "none";
						// alert(x + " adalah Filter 4");
					} else if (x == "Area") {
						x0.style.display = "none";
						x1.style.display = "none";
						x2.style.display = "none";
						x3.style.display = "block";
						x4.style.display = "none";
						x5.style.display = "none";
						// alert(x + " adalah Filter 5");
					} else if (x == "Divisi") {
						x0.style.display = "none";
						x1.style.display = "none";
						x2.style.display = "none";
						x3.style.display = "none";
						x4.style.display = "block";
						x5.style.display = "none";
						// alert(x + " adalah Filter 6");
					} else if (x == "Unitkerja") {
						x0.style.display = "none";
						x1.style.display = "none";
						x2.style.display = "none";
						x3.style.display = "none";
						x4.style.display = "none";
						x5.style.display = "block";
						// alert(x + " adalah Filter 7");
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

			<?php
			break;
			?>
			<script>
				$(document).ready(function() {
					$('#example').DataTable({
						lengthMenu: [
							[50, 100, 500, -1],
							[50, 100, 500, 'All'],
						],

					});
				});
			</script>


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

<?php
			break;
	}
}
?>