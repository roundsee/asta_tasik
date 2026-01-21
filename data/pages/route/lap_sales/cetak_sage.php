<?php 

include '../../../../config/koneksi.php';
include '../../../../config/fungsi_rupiah.php';
include '../../../../config/library.php';

session_start();

$login_hash=$_SESSION['login_hash'];
$en=$_SESSION['employee_number'];
$namauser=$_SESSION['namauser'];

$judulform="Sales Report ";

$data='lap_sales';
$rute='rekap_sales_report';
$aksi='aksi_rekap_sales_report';

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
	<title><?php echo $judulform;?></title>

	<!-- <link rel="stylesheet" type="text/css" href="../style_cetak.css"> -->
	<style type="text/css">
		table {
	border-collapse: collapse;
	font-family:Arial, Helvetica, sans-serif;
	font-size:14px;
}

td {
	font-size:11px;
}

table, td, th {
	border: 1px solid lightgray;
	padding: 1px;
}

th{
	padding-top: 10px;
	padding-bottom: 10px;
	border: 1px solid gray;
}
	</style>

</head>
<body style='font-family:Arial;background-color: ghostwhite;font-size: 8pt;' onload="javascript:window.print()">
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

	if($login_hash=='6' OR $login_hash=='7'){
		$filter='Outlet';
		$query=mysqli_query($koneksi,"SELECT * FROM employee WHERE employee_number='$en' ");
		$q1=mysqli_fetch_array($query);
		$nilai= $q1['cabang_e'];
		$kondisi="AND penjualan.kd_cus='$nilai'";
		$query=mysqli_query($koneksi,"SELECT * FROM pelanggan WHERE kd_cus='$nilai' ");
		$q1=mysqli_fetch_array($query);
		$judul_nilai= $q1['nama'];
	}

	$judul='Laporan '.$judulform;
	$judul2=$filter." : ".$judul_nilai;
	$judul3='Date : '.$tgl_awal." s/d ".$tgl_akhir;

	?>

	<div class="row" >
		<strong><h2><?php echo $judulform;?></h2></strong>
		<br>
		<?php echo $judul2;?>
		<br>
		<?php echo $judul3;?>
		<br>
		By : <?php echo $namauser;?>
	</div>

	<table border="1" cellspacing="1"  style="font-size:8pt;" >

		<thead style="background-color:  lightgray;" class="elevation-2">
			<tr>
				<th style="text-align:center;width: 30px;">No.</th>
				<th style="width: 400px;">  Menu Code  </th>
				<th style="text-align:right ;width:80px;">Qty</th>
				<th style="text-align: right;width: 100px;">Payment</th>
				<!-- <th style="padding-bottom:1px;text-align: right;">Diskon</th> -->

			</tr>
		</thead>
		<tbody>
			<?php

      // Total Seluruh

			$query="SELECT * , 
			penjualan.tarif_pb1 as penjualan_tarif_pb1,
			pelanggan.nama as p_nama,
			kotabaru.nama as kb_nama ,
			jenis_transaksi.nama as jt_nama,
			alat_bayar.nama as ab_nama,
			penjualan.kd_aplikasi as ka_kode,
			penjualan.kd_alatbayar as p_alat_bayar, 
			sum(penjualan.jumlah) as rekap_jumlah, 
			sum(penjualan.ppn) as rekap_ppn, 
			sum(penjualan.byr_pocer) as rekap_pocer
			FROM penjualan 
			join pelanggan on pelanggan.kd_cus=penjualan.kd_cus 
			join kotabaru on kotabaru.kode=pelanggan.kd_kota 
			join jenis_transaksi on jenis_transaksi.kd_jenis=penjualan.kd_aplikasi 
			join alat_bayar on alat_bayar.kd_alat=penjualan.kd_alatbayar 
			WHERE penjualan.tanggal>='$tgl_awal' AND penjualan.tanggal <= '$tgl_akhir' +interval 1 day $kondisi
			";

			$sql=mysqli_query($koneksi,$query);
			$s1=mysqli_fetch_array($sql);

			$tarif_pb1=$s1['penjualan_tarif_pb1'];
      // echo $tarif_pb1;

			$grand_penjualan=$s1['rekap_jumlah'];
			$grand_pajak=$grand_penjualan*($tarif_pb1/100);
			$grand_stlh_pajak=$grand_penjualan+$grand_pajak;
			$grand_ppn=$s1['rekap_ppn'];
			$grand_pocer=$s1['rekap_pocer'];

			$query="SELECT * , 
			pelanggan.nama as p_nama,
			kotabaru.nama as kb_nama ,
			jenis_transaksi.nama as jt_nama,
			alat_bayar.nama as ab_nama,
			penjualan.kd_aplikasi as ka_kode, 
			jualdetil.kd_brg as jd_kd_brg,
			barang.nama as brg_nama, 
			sum(jualdetil.banyak) as rekap_jualdetil_banyak,
			sum(jualdetil.jumlah) as rekap_jualdetil_jumlah,
			sum(penjualan.jumlah) as rekap_jumlah, 
			sum(penjualan.byr_tunai) as rekap_tunai, 
			sum(penjualan.byr_non_tunai) as rekap_non_tunai, 
			sum(penjualan.byr_pocer) as rekap_pocer 
			FROM penjualan 
			join pelanggan on pelanggan.kd_cus=penjualan.kd_cus 
			join kotabaru on kotabaru.kode=pelanggan.kd_kota 
			join jenis_transaksi on jenis_transaksi.kd_jenis=penjualan.kd_aplikasi 
			join alat_bayar on alat_bayar.kd_alat=penjualan.kd_alatbayar 
			join jualdetil on jualdetil.faktur=penjualan.faktur 
			join barang on barang.kd_brg=jualdetil.kd_brg
			WHERE penjualan.tanggal>='$tgl_awal' AND penjualan.tanggal <= '$tgl_akhir' +interval 1 day $kondisi
			GROUP By pelanggan.kd_kota, jualdetil.kd_brg
			";

			$sql1=mysqli_query($koneksi,$query);
			$no=1;

			$tot_subjumlah=0;
			$tot_ppn=0;
			$tot_jumlah=0;

			$tot_penjualan=0;
			$tot_byr_tunai=0;
			$tot_byr_non_tunai=0;
			$tot_pocer=0;

			$tot_11=0;
			$tot_22=0;
			$tot_33=0;
			$tot_44=0;

			$tot_ofline=0;
			$tot_online=0;

			$grand_jumlah=0;
			$nilai_tunai_khusus=0;


			while($s1=mysqli_fetch_array($sql1))
			{
				$total_stlh_pajak=$s1['rekap_jualdetil_jumlah']+($s1['rekap_jualdetil_jumlah']*($s1['tarif_pb1']/100))
				?>
				<!-- <tr align="left">
					<td><?php echo $no; ?></td>
					<td style="width:500px"><?php echo $s1['brg_nama']; ?></td>
					<td style="text-align: right;"><?php echo number_format($s1['rekap_jualdetil_banyak']);?></td>
					<td style="text-align: right;"><?php echo number_format($total_stlh_pajak);?></td>

				</tr> -->
				<?php
				$no++;
				$tot_subjumlah=$tot_subjumlah+$s1[$f7];
				$tot_ppn=$tot_ppn+$s1[$f8];
				$tot_jumlah=$tot_jumlah+$s1[$f9];

				$tot_penjualan=$tot_penjualan + $s1['rekap_jumlah'];
				$tot_byr_tunai=$tot_byr_tunai + $s1['rekap_tunai'];
				$tot_byr_non_tunai=$tot_byr_non_tunai + $s1['rekap_non_tunai'];
				$tot_pocer=$tot_pocer + $s1['rekap_pocer'];

				$grand_jumlah=$grand_jumlah+$s1['rekap_jumlah'];


				if($s1['ka_kode']=='11'){
					$tot_11++;
				}
				if($s1['ka_kode']=='22'){
					$tot_22++;
				}
				if($s1['ka_kode']=='33'){
					$tot_33++;
				}
				if($s1['ka_kode']=='44'){
					$tot_44++;
				}

				$tot_online=$tot_22+$tot_33+$tot_44;
				$tot_ofline=$tot_11;

			}
			?>
		</tbody>
	</table>
	<br/>

	<div class="row">
		SUMMARY
	</div>


	<table border="1" cellspacing="1"  style="font-size:8pt;width:140pt" >
		<thead>
			<th colspan="2" width="">Keterangan</th>
			<th colspan="2">TOTAL</th>	
		</thead>
		<tbody align="right">

			<?php 


			$query2="SELECT  
			pelanggan.nama as p_nama,
			kotabaru.nama as kb_nama ,
			jenis_transaksi.nama as jt_nama,
			alat_bayar.nama as ab_nama,
			penjualan.kd_aplikasi as ka_kode, 
			penjualan.kd_alatbayar as p_alat_bayar, 
			sum(penjualan.jumlah) as rekap_jumlah,
			sum(penjualan.byr_tunai) as rekap_tunai,
			sum(penjualan.byr_non_tunai) as rekap_non_tunai
			FROM penjualan 
			join pelanggan on pelanggan.kd_cus=penjualan.kd_cus 
			join kotabaru on kotabaru.kode=pelanggan.kd_kota 
			join jenis_transaksi on jenis_transaksi.kd_jenis=penjualan.kd_aplikasi 
			join alat_bayar on alat_bayar.kd_alat=penjualan.kd_alatbayar 
			WHERE penjualan.tanggal>='$tgl_awal' AND penjualan.tanggal <= '$tgl_akhir' +interval 1 day $kondisi";

			$sql2=mysqli_fetch_array(mysqli_query($koneksi,$query2));

			$nilai_tunai_khusus=$sql2['rekap_tunai'];

			$query1="SELECT  
			pelanggan.nama as p_nama,
			kotabaru.nama as kb_nama ,
			jenis_transaksi.nama as jt_nama,
			alat_bayar.nama as ab_nama,
			penjualan.kd_aplikasi as ka_kode, 
			penjualan.kd_alatbayar as p_alat_bayar, 
			sum(penjualan.jumlah) as rekap_jumlah,
			sum(penjualan.byr_tunai) as rekap_tunai,
			sum(penjualan.byr_non_tunai) as rekap_non_tunai
			FROM penjualan 
			join pelanggan on pelanggan.kd_cus=penjualan.kd_cus 
			join kotabaru on kotabaru.kode=pelanggan.kd_kota 
			join jenis_transaksi on jenis_transaksi.kd_jenis=penjualan.kd_aplikasi 
			join alat_bayar on alat_bayar.kd_alat=penjualan.kd_alatbayar 
			WHERE penjualan.tanggal>='$tgl_awal' AND penjualan.tanggal <= '$tgl_akhir' +interval 1 day $kondisi
			GROUP By p_alat_bayar
			";

			$sql=mysqli_query($koneksi,$query1);


			$jumlah_tunai=0;
			$jumlah_edc_bca=0;
			$jumlah_edc_mandiri=0;

			while($qq1=mysqli_fetch_array($sql))
			{
				if($qq1['ab_nama']=='TUNAI'){
					?>
					<tr>
						<td colspan="2"><?php echo $qq1['ab_nama'];?></td>
						<td colspan="2" align="right"><?php echo number_format($nilai_tunai_khusus);?></td>
					</tr>
					<?php
				}else{
					?>
					<tr>
						<td colspan="2"><?php echo $qq1['ab_nama'];?></td>
						<td colspan="2" align="right"><?php echo number_format($qq1['rekap_non_tunai']);?></td>
					</tr>

					<?php
				}
			}

			?>

			<tr>
				<td colspan="2">Total Voucher </td>
				<td colspan="2" align="right"><?php echo number_format($grand_pocer);?></td>
			</tr>

			<tr>
				<td colspan="2">Total Jumlah </td>
				<td colspan="2" align="right" style="font-size:105%;font-weight:600"><?php echo number_format($grand_penjualan);?></td>
			</tr>
			<tr>
				<td colspan="2">Total Pajak </td>
				<td colspan="2" align="right"><?php echo number_format($grand_ppn);?></td>
			</tr>
		</tbody>

	</table>
	<br/>

	<div class="row" style="font-size:80%">
		<footer class="main-footer bg_primary_1"  style="padding:.3rem;">
			<!-- To the right -->
			<div class="float-right d-none d-sm-inline">
				<b>Version</b> <?php echo $ver;?>
			</div>
			<!-- Default to the left -->
			<strong>Copyright &copy; 2020-<?php echo $thn_sekarang." ".$perusahaan;?>.</strong>  by Develop. All rights Reserved.
		</footer>
	</div>	
	<br/>

</body>
</html>
