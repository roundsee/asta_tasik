<?php 
// include 'header.php';
include '../../config/koneksi.php';

$judulform="VOUCHER";

$data='data_pocer';
$rute='pocer';
$aksi='aksi_pocer';

$tabel="pocer";
$f1='no_pocer';
$f2='cakupan';
$f3='nilai';
$f4='harga_jual';
$f5='tgl_terbit';
$f6='tgl_daluarsa';
$f7='keterangan';

$j1='No Pocer';
$j2='Cakupan';
$j3='Nilai';
$j4='Harga Jual';
$j5='Tgl Terbit';
$j6='Tgl Daluarsa';
$j7='Keterangan';

$query=mysqli_query($koneksi,"SELECT * FROM pocer_temp ORDER by no_pocer");

$q = mysqli_fetch_array($query);
$jml = mysqli_num_rows($query);

$no_pocer= $q['no_pocer'];
$cakupan= $q['cakupan'];
$nilai= $q['nilai'];
$harga_jual= $q['harga_jual'];
$tgl_terbit=$q['tgl_terbit'];
$tgl_daluarsa=$q['tgl_daluarsa'];
$keterangan=$q['keterangan'];

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"style="background-color:ghostwhite;">
	<!-- Content Header (Page header) -->
	<section class="content-header  wow fadeInDown" data-wow-duration=".3s" data-wow-delay=".3s" >
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="list-gds">
						<b><?php echo $judulform ;?></b> <small style="font-weight: 100;">entry</small>
					</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="main.php?route=home">Beranda</a></li>
						<li class="breadcrumb-item active">Laporan</li>
						<li class="breadcrumb-item active"><?php echo $judulform ;?></li>
					</ol>
				</div>
			</div> 
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content wow" >
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

								<!-- <form method="post" action="simpan_index.php?act=proses1"  >  -->
									<!-- Wraper 1 -->
									<div class="wrapper" style="background-color:darkgray;min-height: 30%;">
										<!-- Batas 1 -->
										<div class="row">

											<div class="col-lg-2">
												<div class="col-lg-7">
													<div class="form-group">
														<label>Cakupan : <span><?php echo $cakupan;?></span>							
														</label>
														<div>
															<input type="radio" name="cakup" onclick="displayResult(this.value)" value="Nasional" disabled> Nasional
														</div>
														<div>
															<input type="radio" name="cakup" onclick="displayResult(this.value)" value="Kota" disabled> Kota
														</div>
														<div>
															<input type="radio" name="cakup" onclick="displayResult(this.value)" value="Outlet" disabled> Outlet
														</div>

														<div>
															
															<input type="hidden" id="result">
															
														</div>

													</div>
												</div>

											</div>


											<!-- Batas -------------- -->


											<div class="col-lg-2">

												<div class="form-group">
													<label>Tanggal Awal</label>
													<input type="date" name="tgl_awal" value="<?php echo $tgl_terbit;?>" disabled >
												</div>

												<div class="form-group">
													<label>Tanggal Akhir</label>
													<input type="date" name="tgl_akhir"  value="<?php echo $tgl_daluarsa;?>" disabled>
												</div>
											</div>


											<div class="col-lg-2">
												<div class="row">
													<div class="col-lg-7">
														<div class="form-group">
															<label>Nilai Voucher</label>
															<input type="text" name="nilaivoucher" value="<?php echo $nilai;?>" disabled>
														</div>  
													</div>

													<div class="col-lg-7">
														<div class="form-group">
															<label>Harga Jual</label>
															<input type="text" name="hargajual"  value="<?php echo $harga_jual;?>" disabled>
														</div>  
													</div>
												</div>
											</div>

											<div class="col-lg-4">
												<div class="row">
													<div class="col-lg-7">
														<div class="form-group">
															<label>Keterangan</label>
															<textarea type="text" name="keterangan"  style="width:300px" disabled><?php echo $keterangan;?></textarea>
														</div>  
													</div>
												</div>
											</div>

											<div class="col-lg-2">

												<div class="row">
													<div class="col-lg-8">
														<div class="form-group">
															<label>Jumlah Voucher</label>
															<input type="text" name="jmlvoucher" value="<?php echo $jml;?>" placeholder="jumlah voucher" required="required" disabled>
														</div> 

													</div>
												</div>
											</div>

										</div>
										<!-- End Batas 1 -->
									</div>
									<!-- end Wraper 1 -->
									<hr/>

									<!-- Wrapper 2-------------- -->
									<div class="wrapper" style="min-height:30%">
										<div class="row">
											<!-- Show Pilihan kota/outlet -->
											<div class="col-lg-3">
												<div class="row">

													<!-- Show Utk Nasional -->
													<div id="isian0">
														<div class="row" style="height:133px">
															<div class="col-lg-7">
																<form role="form" action="route/<?php echo $data;?>/main.php?route=<?php echo $rute;?>&act=proses2a" method="post"> 
																	<div class="form-group">
																		<hr />
																		<input type="submit" class="btn btn-primary elevation-2" style="opacity: .7" value="Proses" />
																	</div>
																</form>
															</div>
														</div>
													</div>

													<!-- Show Utk Kota -->
													<div  id="isian1">
														<div class="row">
															<div class="col-lg-7">
																<div class="form-group">
																	<form method="post" action="route/<?php echo $data;?>/<?php echo $aksi;?>.php?route=<?php echo $rute;?>&act=proses2b"   >
																		<label>Kode Kota</label>
																		<input type="hidden" class="form-control" name="kota" required="required" id="tampil_kota_id">
																		<input type="text" class="form-control" required="required" id="tampil_kota_kode" placeholder="Isi Kode Kota">

																		<label>Kota <span id="status_kota"></span></label>
																		<input type="text" class="form-control" name="nama"  value="" required="required" placeholder="Nama Kota .." id="tampil_kota_nama" readonly style="width: 160px;">

																		<hr />
																		<div class="form-group">
																			<input type="hidden" name="cakup" value="<?php echo $cakupan;?>"/>
																			<input type="submit" class="btn btn-primary elevation-2" style="opacity: .7" value="Add Kota" />
																		</div>
																	</form>
																</div>  
															</div>

															<div class="col-lg-5">
																<div class="form-group">

																	<button style="margin-top: 27px" type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#cariKota">
																		<i class="fa fa-search"></i> Cari Kota
																	</button>

																	<!-- Modal KOTA-->
																	<div class="modal fade" id="cariKota" tabindex="-1" role="dialog" aria-labelledby="cariKotaLabel" aria-hidden="true">
																		<div class="modal-dialog" role="document">
																			<div class="modal-content">
																				<div class="modal-header">
																					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																						<span aria-hidden="true">&times;</span>
																					</button>
																					Pilih Kota
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
																								$no=1;
																								$data = mysqli_query($koneksi,"SELECT * FROM kotabaru ORDER BY kode ASC");
																								while($d = mysqli_fetch_array($data)){
																									?>
																									<tr>
																										<td width="1%" class="text-center"><?php echo $no++; ?></td>
																										<td width="30%"><?php echo $d['kode']; ?></td>
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
													<div  id="isian2">
														<div class="row">
															<div class="col-lg-7">
																<div class="form-group">
																	<form method="post" action="route/data_pocer/aksi_pocer.php?route=pocer&act=proses2b">

																		<label>Kode Outlet</label>
																		<input type="hidden" class="form-control" name="outlet" required="required" id="tampil_outlet_id">
																		<input type="text" class="form-control" required="required" id="tampil_outlet_kode" placeholder="Isi Kode Outlet">

																		<label>Outlet <span id="status_outlet"></span></label>
																		<input type="text" class="form-control" name="nama" value="" required="required" placeholder="Nama Outlet .." id="tampil_outlet_nama" readonly>

																		<hr />
																		<div class="form-group">

																			<input type="hidden" name="cakup" value="<?php echo $cakupan;?>"/>
																			<input type="submit" class="btn btn-primary elevation-2" style="opacity: .7" value="Add Outlet" />
																		</div>
																	</form>
																</div>  
															</div>

															<div class="col-lg-5">
																<div class="form-group">

																	<button style="margin-top: 27px" type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#cariOutlet">
																		<i class="fa fa-search"></i> Cari Outlet
																	</button>

																	<!-- Modal OUTLET-->
																	<div class="modal fade" id="cariOutlet" tabindex="-1" role="dialog" aria-labelledby="cariOutletLabel" aria-hidden="true">
																		<div class="modal-dialog" role="document">
																			<div class="modal-content">
																				<div class="modal-header">
																					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																						<span aria-hidden="true">&times;</span>
																					</button>
																					Pilih Outlet
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
																								$no=1;
																								$data = mysqli_query($koneksi,"SELECT * FROM pelanggan ORDER BY kd_cus ASC");
																								while($d = mysqli_fetch_array($data)){
																									?>
																									<tr>
																										<td width="1%" class="text-center"><?php echo $no++; ?></td>
																										<td width="30%"><?php echo $d['kd_cus']; ?></td>
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

												</div>
											</div>

											<!-- ========= tabel Kota list -->
											<div class="col-lg-5">

												<div class="table-responsive" style="height: 230px;border-radius: 10px;">
													<table class="table table-bordered table-striped table-hover" id="table-datatable-kota">
														<thead style="background-color:lightslategray;color: ghostwhite;">
															<tr>
																<th class="text-center">NO</th>
																<th>Kode</th>
																<th>Nama</th>
																<th>Area</th>
																<th>Aksi</th>
															</tr>
														</thead>
														<tbody>
															<?php 
															$no=1;
															$data = mysqli_query($koneksi,"SELECT * FROM pocer_kota_outlet_temp ORDER BY nama ASC");
															while($d = mysqli_fetch_array($data)){
																?>
																<tr>
																	<td class="text-center"><?php echo $no++; ?></td>
																	<td><?php echo $d['kode']; ?></td>
																	<td><?php echo $d['nama']; ?></td>
																	<td class="text-center"><?php echo $d['kd_area']; ?></td>

																	<td width="1%">              
																		<a href="route/data_pocer/aksi_pocer.php?route=pocer&act=hapuskota&id=<?php echo $d['kode']; ?>"><button type="button" class="btn btn-danger btn-xs" style="opacity: .7;" ><i class="fa fa-trash"></i></button></a>
																	</td>
																</tr>
																<?php 
															}
															?>
														</tbody>
													</table>
												</div>
											</div>
											<!-- ========= tabel Kota list end-->

											<!-- ========= tabel VOUCHER list -->
											<div class="col-lg-4">

												<div class="table-responsive elevation-2" style="height: 230px;border-radius: 7px;">
													<table class="table table-bordered table-striped table-hover" id="table-datatable-kota">
														<thead style="background-color:  lightgray;" class="elevation-2">
															<tr>
																<th class="text-center">NO</th>
																<th>No Voucher</th>
																<th>Cakupan</th>
																<!-- <th>Nilai</th>
																<th>Harga Jual</th>
																<th>Tgl Terbit</th> -->
															</tr>
														</thead>
														<tbody>
															<?php 
															$no=1;
															$data = mysqli_query($koneksi,"SELECT * FROM pocer_temp ORDER BY no_pocer ASC");
															while($d = mysqli_fetch_array($data)){
																?>
																<tr>
																	<td class="text-center"><?php echo $no++; ?></td>
																	<td><?php echo $d['no_pocer']; ?></td>
																	<td><?php echo $d['cakupan']; ?></td>
																	<!-- <td class="text-center"><?php echo $d['nilai']; ?></td>
																	<td><?php echo $d['harga_jual']; ?></td>
																	<td><?php echo $d['tgl_terbit']; ?></td> -->
																</tr>
																<?php 
															}
															?>
														</tbody>
													</table>
												</div>
											</div>
											<!-- ========= tabel VOUCHER list end-->

										</div>

									</div>
									<!-- end Wraper 2 -->
									<hr/>


									<!-- Wraper 3 -->
									<div class="wrapper" style="min-height:30">
										<div class="row">
											<div class="col-lg-7">
												<div class="form-group">
													<a href="main.php?route=<?php echo $rute;?>&act" title="Batal"> <button class="btn btn-danger btn-sm elevation-2" style="opacity: .7;width:80px"><i class="fa fa-edit"></i> Batal</button></a>

													<a href="route/data_pocer/aksi_pocer.php?route=pocer&act=save" title="Save"> <button class="btn btn-primary btn-sm elevation-2" style="opacity: .7;width:80px"><i class="fa fa-edit"></i> Save</button></a>
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
// include 'footer.php';
include 'wibjs.php';
?>

<script>
	function displayHasil(tgl_awal){ 
		document.getElementById("tgl_awalHasil").value=tgl_awal; 
	};

</script>
<script>
	var cakup = "<?php echo $cakupan ?>";
// var kota = document.getElementById("kota");
var x0 = document.getElementById("isian0");
var x1 = document.getElementById("isian1");
var x2 = document.getElementById("isian2");

if (cakup=="Nasional"){
	x0.style.display = "none";
	x1.style.display = "none";
	x2.style.display = "none";
}else if (cakup=="Kota"){
	x0.style.display = "none";
	x1.style.display = "block";
	x2.style.display = "none";
}else if(cakup=="Outlet"){
	x0.style.display = "none";
	x1.style.display = "none";
	x2.style.display = "block";
}

</script>

<script type="text/javascript">
	<?php 
	if(isset($_GET['alert'])){
		if($_GET['alert'] == "gagal"){
			echo "<div class='alert alert-danger'>File yang diperbolehkan hanya file gambar!</div>";
		}elseif($_GET['alert'] == "duplikat"){
			echo "<div class='alert alert-danger'><b>Kode Barang</b> sudah pernah digunakan!</div>";
		}
	}
	?>
</script>

