<?php 

include '../../../../config/koneksi.php';
include '../../../../config/fungsi_rupiah.php';
include '../../../../config/library.php';

session_start();

$login_hash=$_SESSION['login_hash'];
$en=$_SESSION['employee_number'];
$tujuan=$_GET['tujuan'];

$judulform="Daftar Diskon";

$data='lap_daftar_diskon';
$rute='daftar_diskon';
$aksi='aksi_daftar_diskon';

$tabel="tarif_diskon";
$f1='jadi';
$f2='kd_promo';
$f3='kd_jenis';
$f4='cakupan';
$f5='kd_kota';
$f6='kd_cus';
$f7='jenis_barang';
$f8='kd_brg';
$f9='diskon';
$f10='ket';
$f11='tgl_awal';
$f12='tgl_akhir';

$j1='Jadi';
$j2='Kode Promo';
$j3='Kode Jenis';
$j4='Cakupan';
$j5='Kode Kota';
$j6='Kode Outlet';
$j7='Jenis Barang';
$j8='Kode Barang';
$j9='Diskon';
$j10='Keterangan';
$j11='Tgl Awal';
$j12='Tgl Akhir';


$tabel2='kotabaru';
$ff1='kode';
$tabel3='pelanggan';
$gg1='kd_cus';

$tgl_awal=$_GET['tgl_awal'];
$tgl_akhir=$_GET['tgl_akhir'];
$filter=$_GET['filter'];
$nilai=$_GET['nilai'];



?>

<html>
<head>
	<title><?php echo $judul;?></title>

</head>
<!-- <body style='font-family:tahoma; font-size:9pt;' onload="javascript:window.print()"> -->

	<body style='font-family:Arial;' onload="javascript:window.print()" >
		<?php

        // echo "<br/>".$tgl_awal;
        // echo "<br/>".$tgl_akhir;
        // echo "<br/>".$filter;
        // echo "<br/>".$nilai;

		if ($tujuan=='aplikasi') {
	$kondisi2='Aplikasi';
}elseif($tujuan=='carabayar'){
	$kondisi2='Cara Bayar';
}elseif($tujuan=='kasir'){
	$kondisi2='Kasir';
}else{
	$kondisi2='';

}


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

$judul='Daftar Diskon dan Promosi';
$judul2=$filter." : ".$judul_nilai;
$judul3='Periode : '.$tgl_awal." s/d ".$tgl_akhir;

		?>

		<br><h3><?php echo $judul;?></h3>
		<?php echo $judul2;?>
		<br>
		<?php echo $judul3;?>
		<table border="1" >
			<thead style="background-color:  lightgray;" >
				<tr>
				<th>No.</th>
				<th style="width:200px"><?php echo $j1; ?></th>
				<th><?php echo $j3; ?></th>
				<th>Nama Outlet</th>
				<th>Kode Kota</th>
				<th>Nama Kota</th>
				<th><?php echo $j2; ?></th>
				<th>Ket Aplikasi</th>
				<th>Cakupan</th>
				<th>Nama Aplikasi</th>
				<th><?php echo $j7; ?></th>
				<th><?php echo $j8; ?></th>
				<th><?php echo $j9; ?></th>
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

			$query="SELECT * , pelanggan.nama as p_nama,kotabaru.nama as kb_nama,jenis_transaksi.nama as jt_nama
			FROM tarif_diskon 
			join pelanggan on pelanggan.kd_cus=tarif_diskon.kd_cus
			join kotabaru on kotabaru.kode=pelanggan.kd_kota
			join jenis_transaksi on jenis_transaksi.kd_jenis=tarif_diskon.kd_jenis
			WHERE tgl_awal>='$tgl_awal' AND tgl_akhir <= '$tgl_akhir' +interval 1 day $kondisi 
			";



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
					<td><?php echo $s1[$f1]; ?></td>
					<td><?php echo $s1[$f3]; ?></td>
					<td><?php echo $s1['p_nama']; ?></td>
					<td><?php echo $s1['kd_kota']; ?></td>
					<td><?php echo $s1['kb_nama']; ?></td>
					<td><?php echo $s1[$f2]; ?></td>
					<td><?php echo $s1[$f10]; ?></td>
					<td style="text-align: center;"><?php echo $s1[$f4]; ?></td>
					<td><?php echo $s1['jt_nama']; ?></td>
					<td style="text-align: right;"><?php echo ($s1[$f7]);?></td>
					<td style="text-align: right;"><?php echo ($s1[$f8]);?></td>
					<td style="text-align: right;"><?php echo ($s1[$f9]);?></td>

				</tr>
				<?php
				$no++;
                              // $tot_subjumlah=$tot_subjumlah+$s1[$f7];
                              // $tot_ppn=$tot_ppn+$s1[$f8];
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
			<!-- <tfoot> -->

				<!-- <tr style="font-weight:800">
					<td colspan="4" style="text-align:right;"> Total :</td>
					<td align="right" colspan="2"><?php echo number_format($tot_jumlah);?></td>
				</tr> -->
				<!-- </tfoot> -->

			</table>

			<!-- <div>
				SUMMARY REPORT
			</div>

			<table id="example" border="1" cellpadding="0"  style="width:600px">
				<thead style="background-color:  lightgray;" >
					<th>No</th>
					<th>Uraian</th>
					<th>Banyak</th>
					<th style="text-align:right;">Jumlah & Pajak</th>
				</thead>
				<tbody>
					<?php 
					$query="SELECT *,pelanggan.nama as p_nama,
                          penjualan.jumlah as p_jumlah,
                          penjualan.tarif_pb1 as p_pb1,
                          kotabaru.nama as kb_nama ,
                          jenis_transaksi.nama as jt_nama,
                          sum((penjualan.jumlah+(penjualan.jumlah*(penjualan.tarif_pb1/100)))) as p_tot,
                          count(penjualan.jumlah) as count_jumlah
                          FROM penjualan 
                          join pelanggan on pelanggan.kd_cus=penjualan.kd_cus
                          join kotabaru on kotabaru.kode=pelanggan.kd_kota
                          join jenis_transaksi on jenis_transaksi.kd_jenis=penjualan.kd_aplikasi
                          WHERE penjualan.tanggal>='$tgl_awal' AND penjualan.tanggal <= '$tgl_akhir' +interval 1 day $kondisi 
                          GROUP BY jenis_transaksi.kd_jenis
                          ";

					$sql1=mysqli_query($koneksi,$query);
					$tot_rekap_ppn=0;
					$tot_rekap_subjumlah=0;
					$tot_rekap_jumlah=0;
					$tot_line=0;
					$no=1;

					while($s1=mysqli_fetch_array($sql1))
					{
						?>

						<tr>
							<td width="20px"><?php echo $no;?></td>
							<td width="200px"><?php echo $s1['jt_nama'];?></td>
							<td align="right"><?php echo format_rupiah($s1['count_jumlah']);?></td>
							<td align="right"><?php echo format_rupiah($s1['p_tot']);?></td>
						</tr>

						<?php
						$tot_rekap_jumlah=$tot_rekap_jumlah+$s1['p_tot'];
						$tot_line=$tot_line+$s1['count_jumlah'];
						$no++;

					}

					?>
				</tbody>
				<tr>
					<td></td>
					<td width="200px">Total Rekap </td>
					<td align="right"><?php echo format_rupiah($tot_line);?></td>
					<td align="right"><?php echo format_rupiah($tot_rekap_jumlah);?></td>
				</tr>

			</table> -->
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
