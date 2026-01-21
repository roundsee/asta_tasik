<?php 

include '../../../../config/koneksi.php';
include '../../../../config/fungsi_rupiah.php';
include '../../../../config/library.php';


$judulform="Daftar tarif PB1";

$data='lap_pb1';
$rute='pb1';
$aksi='aksi_pb1';

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
$j8='PPn';
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
	<title>Cetak Lap PB1</title>

</head>
<!-- <body> -->
	<!-- <body style='font-family:tahoma; font-size:9pt;' onload="javascript:window.print()"> -->
		
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

			if($filter=='kota'){
				$kondisi="AND pelanggan.kd_kota='$nilai'";
				$query=mysqli_query($koneksi,"SELECT * FROM kotabaru WHERE kode='$nilai' ");
				$q1=mysqli_fetch_array($query);
				$judul_nilai= $q1['nama'];
			}elseif($filter=='outlet'){
				$kondisi="AND penjualan.kd_cus='$nilai'";
				$query=mysqli_query($koneksi,"SELECT * FROM pelanggan WHERE kd_cus='$nilai' ");
				$q1=mysqli_fetch_array($query);
				$judul_nilai= $q1['nama'];
			}elseif($filter=='area'){
				$kondisi="AND kotabaru.kd_area='$nilai'";
				$query=mysqli_query($koneksi,"SELECT * FROM area WHERE kode='$nilai' ");
				$q1=mysqli_fetch_array($query);
				$judul_nilai= $q1['nama'];
			}else{
				$kondisi="";
				$judul_nilai='';
			}

			?>

			
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper" >

				<div class="container-fluid">

					<br><center><h4>Laporan Omset dan PB1
						<br><?php echo $filter." : ".$judul_nilai;?>
						<!-- <br><?php echo $q1['nama'];?> -->
						<br/>Periode : <?php echo $tgl_awal." s/d ".$tgl_akhir;?></h4></center>
						<br>tgl cetak : <?php echo $tgl_sekarang;?>
						<br> 
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
																	<th>Tanggal</th>
																	<th>Faktur</th>
																	<th>Nama Outlet</th>
																	<th>Nama Aplikasi</th>
																	<th>Penjualan</th>
																	<th>Pajak</th>
																	<th>Penjualan & Pajak</th>
																</tr>
															</thead>
															<tbody>
																<?php


																$query="SELECT * , pelanggan.nama as p_nama,kotabaru.nama as kb_nama ,jenis_transaksi.nama as jt_nama
																FROM penjualan 
																join pelanggan on pelanggan.kd_cus=penjualan.kd_cus
																join kotabaru on kotabaru.kode=pelanggan.kd_kota
																join jenis_transaksi on jenis_transaksi.kd_jenis=penjualan.kd_aplikasi
																WHERE tanggal>='$tgl_awal' AND tanggal <= '$tgl_akhir' $kondisi ";



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


																while($s1=mysqli_fetch_array($sql1))
																{
																	?>
																	<tr align="left">
																		<td><?php echo $no; ?></td>
																		<td style="width: 140pt;"><?php echo $s1['tanggal']; ?></td>
																		<td style="width: 140pt;"><?php echo $s1['faktur']; ?></td>
																		<td style="width: 140pt;"><?php echo $s1['p_nama']; ?></td>
																		<td style="width: 140pt;"><?php echo $s1['jt_nama']; ?></td>
																		<td style="text-align: right;"><?php echo format_rupiah($s1['subjumlah']);?></td>
																		<td style="text-align: right;"><?php echo format_rupiah($s1['ppn']);?></td>
																		<td style="text-align: right;"><?php echo format_rupiah($s1['jumlah']);?></td>

																	</tr>
																	<?php
																	$no++;
																	$tot_subjumlah=$tot_subjumlah+$s1[$f7];
																	$tot_ppn=$tot_ppn+$s1[$f8];
																	$tot_jumlah=$tot_jumlah+$s1[$f9];

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
														<table style="font-weight:700">
															<tr>
																<td style="width:200px"> Total</td>
																<td style="width:30px">:</td>
																<td style="text-align:right;"><?php echo format_rupiah($tot_subjumlah);?></td>
															</tr>
															<tr>
																<td> Total PPn</td>
																<td>:</td>
																<td style="text-align:right;"><?php echo format_rupiah($tot_ppn);?></td>
															</tr>

															<tr>
																<td> Total setelah Pajak</td>
																<td>:</td>
																<td style="text-align:right;"><?php echo format_rupiah($tot_jumlah);?></td>
															</tr>

															<tr>
																<td>.</td>
															</tr>

															<tr>
																<td>Total OFF Line </td>
																<td>:</td>
																<td><?php echo $tot_ofline;?></td>
															</tr>
															<tr>
																<td>Total ON Line </td>
																<td>:</td>
																<td><?php echo $tot_online;?></td>
															</tr>
															<tr>
																<td>.</td>
															</tr>
															<tr>
																<td>Total Dine In</td>
																<td>:</td>
																<td><?php echo $tot_11;?></td>
															</tr>
															<tr>
																<td>Total Aplikasi Shoppe</td>
																<td>:</td>
																<td><?php echo $tot_22;?></td>
															</tr>
															<tr>
																<td>Total Aplikasi Grab</td>
																<td>:</td>
																<td><?php echo $tot_33;?></td>
															</tr>
															<tr>
																<td>Total Aplikasi GoJek</td>
																<td>:</td>
																<td><?php echo $tot_44;?></td>
															</tr>

															
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

				</body>
				</html>
