<?php 
session_start();

include '../../../../config/koneksi.php';
include '../../../../config/fungsi_rupiah.php';
include '../../../../config/library.php';

$login_hash=$_SESSION['login_hash'];
$namauser=$_SESSION['namauser'];

$tujuan=$_GET['tujuan'];

$judulform="Daftar Omzet Outlet";

$data='lap_omzet';
$rute='omzet';
$aksi='aksi_omzet';

$tabel="penjualan";
$f1='faktur';
$f2='tanggal';
$f3='kd_cus';
$f4='kd_aplikasi';
$f5='no_meja';
$f6='oleh';
$f7='subjumlah';
$f8='ppn';
$f9='jumlah';
$f10='byr_pocer';
$f11='byr_tunai';
$f12='byr_non_tunai';
$f13='kd_alatbayar';
$f14='no_urut';
$f15='tahun';
$f16='bulan';
$f17='jam';
$f18='kdsub_alatbayar';
$f19='subjumlah_offline';
$f20='ket_aplikasi';
$f21='dasar_fee';
$f22='acuan_fee';
$f23='tarif_fee';
$f24='b_packing';
$f25='no_online';
$f26='no_ofline';
$f27='tarif_pb1';
$f28='faktur_refund';
$f29='dasar_faktur';

$j1='Faktur';
$j2='Tanggal';
$j3='Kode Outlet';
$j4='kd_aplikasi';
$j5='no_meja';
$j6='oleh';
$j7='Sub jumlah';
$j8='PB1';
$j9='Jumlah';
$j10='byr_pocer';
$j11='byr_tunai';
$j12='byr_non_tunai';
$j13='kd_alatbayar';
$j14='no_urut';
$j15='tahun';
$j16='bulan';
$j17='jam';
$j18='kdsub_alatbayar';
$j19='subjumlah_offline';
$j20='ket_aplikasi';
$j21='dasar_fee';
$j22='acuan_fee';
$j23='tarif_fee';
$j24='b_packing';
$j25='no_online';
$j26='no_ofline';
$j27='tarif_pb1';
$j28='faktur_refund';
$j29='dasar_faktur';


$tabel2='kotabaru';
$ff1='kode';
$tabel3='pelanggan';
$gg1='kd_cus';

?>

<html>
<head>
	<title><?php echo $judul;?></title>

</head>
<body style='font-family:tahoma;' onload="javascript:window.print()" >
	<?php

	$tgl_awal=$_GET['tgl_awal'];
	$tgl_akhir=$_GET['tgl_akhir'];
	$filter=$_GET['filter'];
	$nilai=$_GET['nilai'];

        // echo "<br/>".$tgl_awal;
        // echo "<br/>".$tgl_akhir;
        // echo "<br/>".$filter;
        // echo "<br/>".$nilai;
	if ($tujuan=='aplikasi') {
		$kondisi2='Aplikasi';
		$kondisi_group=' ,penjualan.kd_aplikasi';
	}elseif($tujuan=='carabayar'){
		$kondisi2='Alat Bayar';
		$kondisi_group=' ,penjualan.kd_alatbayar';
	}elseif($tujuan=='kasir'){
		$kondisi2='Kasir';
		$kondisi_group=' ,penjualan.oleh';
	}else{
		$kondisi2='';
		$kondisi_group='';
	}

	if($filter=='kota'){
		$kondisi="AND pelanggan.kd_kota='$nilai'";
		$query=mysqli_query($koneksi,"SELECT nama FROM kotabaru WHERE kode='$nilai' ");
		$q1=mysqli_fetch_array($query);
		$judul_nilai= $q1['nama'];
	}elseif($filter=='outlet'){
		$kondisi="AND penjualan.kd_cus='$nilai'";
		$query=mysqli_query($koneksi,"SELECT nama FROM pelanggan WHERE kd_cus='$nilai' ");
		$q1=mysqli_fetch_array($query);
		$judul_nilai= $q1['nama'];
	}elseif($filter=='area'){
		$kondisi="AND kotabaru.kd_area='$nilai'";
		$query=mysqli_query($koneksi,"SELECT nama FROM area WHERE kode='$nilai' ");
		$q1=mysqli_fetch_array($query);
		$judul_nilai= $q1['nama'];
	}else{
		$kondisi="";
		$judul_nilai='';
	}

	$judul=$judulform.$kondisi2;
	$judul2=$filter." : ".$judul_nilai;
	$judul3='Periode : '.$tgl_awal." s/d ".$tgl_akhir;    

	?>
	
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper" >
		<div class="container-fluid">
			<center><h4><?php echo $judul;?></h4>
				<h5><?php echo $judul2;?></h5>
				<?php echo $judul3;?></center>  
			</div><!-- /.container-fluid -->

			<!-- Main content -->
			<!-- <section class="content wow fadeInUp" data-wow-duration=".2s" data-wow-delay=".1s" > -->
				<div class="container-fluid">
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
											<div class="table-responsive">

												<table border="1" id="example1" class="table table-bordered table-striped">
													<thead style="background-color:  lightgray;" class="elevation-2">
														<tr>
															<th>No.</th>
															<th width="100px"><?php echo $j2; ?></th>
															<th width="250px">Struk REGULAR</th>
															<th width="250px">Struk ON Line</th>
															<th>Ket Aplikasi</th>
															<th>Sebelum <br>Pajak</th>
															<th width="100px">Pajak <br>(PB1 10%)</th>
															<th>Sesudah <br>Pajak</th>
														</tr>
													</thead>
													<tbody>
														<?php

														$query="SELECT penjualan.faktur, penjualan.kd_aplikasi,penjualan.ket_aplikasi, 
														pelanggan.nama as p_nama,
														kotabaru.nama as kb_nama ,
														jenis_transaksi.nama as jt_nama, 
														DATE_FORMAT(tanggal,'%Y-%m-%d') as tgl_faktur,
														sum(subjumlah) as subtotaljumlah, 
														sum(ppn) as tot_ppn,
														max(faktur) as max_no_faktur 
														FROM penjualan 
														join pelanggan on pelanggan.kd_cus=penjualan.kd_cus 
														join kotabaru on kotabaru.kode=pelanggan.kd_kota 
														join jenis_transaksi on jenis_transaksi.kd_jenis=penjualan.kd_aplikasi 
														WHERE tanggal between '$tgl_awal' and '$tgl_akhir'  +interval 1 day $kondisi 
														GROUP by tgl_faktur ,penjualan.ket_aplikasi";


														$sql1=mysqli_query($koneksi,$query);
														$no=1;

														$tot_subjumlah=0;
														$tot_ppn=0;
														$tot_jumlah=0;

														$tot_11=0;
														$tot_22=0;
														$tot_33=0;
														$tot_44=0;

														$tot_ofline=0;
														$tot_online=0;
														$tot_sebelum_pajak=0;
														$tot_pb1=0;
														$tot_sdh_pajak=0;
														$tgl_lama="";
														$pertama_kali=1;
														$pertama_kedua=1;
														$urut_awal='0001';
														$urut_akhir=0;
                             // $vurut_akhir=0;


														while($s1=mysqli_fetch_array($sql1))
														{
															?>
															<tr align="left">

																<td><?php echo $no; ?></td>
																<td><?php echo $s1['tgl_faktur']; ?></td>

																<?php if($s1[$f20]=='OF LINE'){ ?>
																	<td><?php echo substr($s1['faktur'],5,9).'-'.$urut_awal.' s/d -'.substr($s1['max_no_faktur'],6,14); ?></td>
																	<td></td>
																<?php }else{ ?>
																	<td></td>
																	<td><?php echo substr($s1['faktur'],5,9).'-'.$urut_awal.' s/d -'.substr($s1['max_no_faktur'],6,13); ?></td>
																<?php } ?>

																<td><?php echo $s1[$f20]; ?></td>
																<td style="text-align: right;"><?php echo format_rupiah($s1['subtotaljumlah']);?></td>
																<td style="text-align: right;"><?php echo format_rupiah($s1['tot_ppn']);?></td>
																<td style="text-align: right;"><?php echo format_rupiah($s1['subtotaljumlah']+$s1['tot_ppn']);?></td>
															</tr>

															<?php
															$no++;
															$tot_subjumlah=$tot_subjumlah+$s1['subtotaljumlah'];
															$tot_ppn=$tot_ppn+$s1['tot_ppn'];
															$tot_jumlah=$tot_jumlah+$s1['subtotaljumlah']+$s1['tot_ppn'];

															if($s1[$f4]=='11'){
																$tot_11++;
															}
															if($s1[$f4]=='22'){
																$tot_22++;
															}
															if($s1[$f4]=='33'){
																$tot_33++;
															}
															if($s1[$f4]=='44'){
																$tot_44++;
															}

															$tot_online=$tot_22+$tot_33+$tot_44;
															$tot_ofline=$tot_11;

														}
														?>

													</tbody>
													<tfoot>
														<tr style="font-weight:800">
															<td colspan="5" style="text-align:right;"> Total :</td>
															<td style="text-align:right;width: 100pt;"><?php echo format_rupiah($tot_subjumlah);?></td>
															<td style="text-align:right;width: 100pt;"><?php echo format_rupiah($tot_ppn);?></td>
															<td style="text-align:right;width: 100pt;"><?php echo format_rupiah($tot_jumlah);?></td>
														</tr>
													</tfoot>

												</table>
												<!--  <hr> -->
												<div>
													SUMMARY REPORT
												</div>
												<table id="example" border="1" class="table table-bordered table-striped" style="width:400px">
													<thead style="background-color:  lightgray;" class="elevation-2">
														<th>Uraian</th>
														<th style="text-align:right;">Jumlah</th>

													</thead>
													<tbody>
														<tr>
															<td style="width:200px"> Total</td>
															<td style="text-align:right;"><?php echo format_rupiah($tot_subjumlah);?></td>
														</tr>
														<tr>
															<td> Total PB1</td>
															<td style="text-align:right;"><?php echo format_rupiah($tot_ppn);?></td>
														</tr>

														<tr>
															<td> Total sesudah Pajak</td>
															<td style="text-align:right;"><?php echo format_rupiah($tot_jumlah);?></td>
														</tr>

														<tr>
															<td></td>
															<td></td>
														</tr>

														<tr>
															<td>Total OFF Line </td>
															<td style="text-align:right;"><?php echo $tot_ofline;?></td>
														</tr>
														<tr>
															<td>Total ON Line </td>
															<td style="text-align:right;"><?php echo $tot_online;?></td>
														</tr>
													</tbody>

												</table>
											</div>
										</div><!-- /.box-body -->
									</div><!-- /.box -->
								</section><!-- /.Left col -->
							</div><!-- /.row (main row) -->
						</div>
					</div>
				</div>
				<!-- </section>/.content -->
			</div><!-- /.content-wrapper -->
			<!-- Main Footer -->
			<footer class="main-footer bg_primary_1"  style="padding:.3rem;font-size:.75rem">

				<!-- Default to the left -->
				<strong>Copyright &copy; 2020-<?php echo $thn_sekarang." ".$perusahaan;?>.</strong>  by Develop. All rights Reserved.
				<!-- Default to the right -->
				<div class="float-right d-none d-sm-inline">
					<b>Version</b> <?php echo $ver;?>
				</div>
			</footer>

		</body>
		</html>
