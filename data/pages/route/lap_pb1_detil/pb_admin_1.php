
<?php if ($filter=='outlet') { ?>

	<table id="example" class="table table-bordered table-striped">
		<thead style="background-color:  lightgray;font-size: 90%;" class="elevation-2">
			<tr>
				<th>No.</th>
				<th width="180px"><?php echo $j2; ?></th>
				<th width="160px"><?php echo $j1; ?></th>
				<th>Ket Aplikasi</th>
				<th>Kode Aplikasi</th>
				<th width="140px">Nama Aplikasi</th>
				<th width="140px">Sub alat Bayar</th>
				<th><?php echo $j7; ?></th>
				<th><?php echo $j8; ?></th>
				<th><?php echo $j9; ?></th>

			</tr>
		</thead>
		<tbody>
			<?php

			$query="SELECT  
			faktur,tanggal,kd_aplikasi,subjumlah,ppn,jumlah,ket_aplikasi,
			jenis_transaksi.nama as jt_nama,
			subalat_bayar.nama as sb_nama
			FROM penjualan 
			join jenis_transaksi on jenis_transaksi.kd_jenis=penjualan.kd_aplikasi
			join subalat_bayar on subalat_bayar.kdsub_alat=penjualan.kdsub_alatbayar
			WHERE (tanggal between '$tgl_awal' and '$tgl_akhir'  +interval 1 day) $kondisi 
			";


			$sql1=mysqli_query($koneksi,$query);
			$no=1;

			$tot_subjumlah=0;
			$tot_ppn=0;
			$tot_jumlah=0;

			while($s1=mysqli_fetch_array($sql1))
			{

				?>
				<tr align="left">
					<td><?php echo $no; ?></td>
					<td><?php echo $s1[$f2]; ?></td>
					<td width="160px"><?php echo $s1[$f1]; ?></td>
					<td><?php echo $s1[$f20]; ?></td>
					<td style="text-align: center;"><?php echo $s1[$f4]; ?></td>
					<td><?php echo $s1['jt_nama']; ?></td>
					<td><?php echo $s1['sb_nama']; ?></td>
					<td style="text-align: right;"><?php echo number_format($s1[$f7]);?></td>

					<td style="text-align: right;"><?php echo number_format($s1[$f8]);?></td>
					<td style="text-align: right;"><?php echo number_format($s1[$f9]);?></td>

				</tr>

				<?php
				$no++;
				$tot_subjumlah=$tot_subjumlah+$s1[$f7];

				$tot_ppn=$tot_ppn+$s1[$f8];
				$tot_jumlah=$tot_jumlah+$s1[$f9];

			}
			?>
		</tbody>
		<tfoot>
			<tr style="font-weight:800;background-color: antiquewhite;">
				<td colspan="7" style="text-align:right;"> Total :</td>
				<td style="text-align:right;"><?php echo number_format($tot_subjumlah);?></td>

				<td style="text-align:right;"><?php echo number_format($tot_ppn);?></td>
				<td style="text-align:right;"><?php echo number_format($tot_jumlah);?></td>
			</tr>
		</tfoot>

	</table>
<?php }elseif($filter=='kota'){ ?>

	<table id="example" class="table table-bordered table-striped">
		<thead style="background-color:  lightgray;font-size: 90%;" class="elevation-2">
			<tr>

				<th>No.</th>
				<th width="140px">Nama Outlet</th>
				<th width="140px">Jumlah Faktur</th>
				<th><?php echo $j7; ?></th>
				<th><?php echo $j8; ?></th>
				<th><?php echo $j9; ?></th>

			</tr>
		</thead>
		<tbody>
			<?php

			$query="SELECT count(penjualan.faktur) as p_faktur,
			sum(penjualan.subjumlah) as p_subjumlah, 
			sum(penjualan.ppn) as p_ppn, 
			sum(penjualan.jumlah) as p_jumlah, 
			pelanggan.nama as p_nama, 
			kotabaru.nama as kb_nama 
			FROM penjualan 
			join pelanggan on pelanggan.kd_cus=penjualan.kd_cus 
			join kotabaru on kotabaru.kode=pelanggan.kd_kota 
			WHERE (tanggal between '$tgl_awal' and '$tgl_akhir' +interval 1 day) AND pelanggan.kd_kota='$nilai' GROUP BY pelanggan.nama ";


			$sql1=mysqli_query($koneksi,$query);
			$no=1;

			$tot_subjumlah=0;
			$tot_ppn=0;
			$tot_jumlah=0;
			$tot_faktur=0;

			while($s1=mysqli_fetch_array($sql1))
			{

				?>
				<tr align="left">
					<td><?php echo $no; ?></td>
					<td><?php echo $s1['p_nama']; ?></td>
					<td style="text-align: right;"><?php echo number_format($s1['p_faktur']);?></td>
					<td style="text-align: right;"><?php echo number_format($s1['p_subjumlah']);?></td>
					<td style="text-align: right;"><?php echo number_format($s1['p_ppn']);?></td>
					<td style="text-align: right;"><?php echo number_format($s1['p_jumlah']);?></td>

				</tr>
				<?php
				$no++;
				$tot_subjumlah=$tot_subjumlah+$s1['p_subjumlah'];
				$tot_ppn=$tot_ppn+$s1['p_ppn'];
				$tot_jumlah=$tot_jumlah+$s1['p_jumlah'];
				$tot_faktur=$tot_faktur+$s1['p_faktur'];


			}
			?>
		</tbody>
		<tfoot>
			<tr style="font-weight:800;background-color: antiquewhite;">
				<td colspan="2" style="text-align:right;"> Total :</td>
				<td style="text-align:right;"><?php echo number_format($tot_faktur);?></td>
				<td style="text-align:right;"><?php echo number_format($tot_subjumlah);?></td>

				<td style="text-align:right;"><?php echo number_format($tot_ppn);?></td>
				<td style="text-align:right;"><?php echo number_format($tot_jumlah);?></td>
			</tr>
		</tfoot>

	</table>

<?php }elseif($filter=='area'){ ?>

	<table id="example" class="table table-bordered table-striped">
		<thead style="background-color:  lightgray;font-size: 90%;" class="elevation-2">
			<tr>

				<th>No.</th>
				<th width="140px">Nama Kota</th>
				<th width="140px">Nama Outlet</th>
				<th width="140px">Jumlah Faktur</th>
				<th><?php echo $j7; ?></th>
				<th><?php echo $j8; ?></th>
				<th><?php echo $j9; ?></th>

			</tr>
		</thead>
		<tbody>
			<?php

			$query="SELECT count(penjualan.faktur) as p_faktur,
			sum(penjualan.subjumlah) as p_subjumlah, 
			sum(penjualan.ppn) as p_ppn, 
			sum(penjualan.jumlah) as p_jumlah, 
			pelanggan.nama as p_nama, 
			kotabaru.nama as kb_nama 
			FROM penjualan 
			join pelanggan on pelanggan.kd_cus=penjualan.kd_cus 
			join kotabaru on kotabaru.kode=pelanggan.kd_kota 
			WHERE (tanggal between '$tgl_awal' and '$tgl_akhir' +interval 1 day) AND kotabaru.kd_area='$nilai' GROUP BY pelanggan.kd_cus ORDER by kotabaru.kode,pelanggan.kd_cus";


			$sql1=mysqli_query($koneksi,$query);
			$no=1;

			$tot_subjumlah=0;
			$tot_ppn=0;
			$tot_jumlah=0;
			$tot_faktur=0;

			while($s1=mysqli_fetch_array($sql1))
			{

				?>
				<tr align="left">
					<td><?php echo $no; ?></td>
					<td><?php echo $s1['kb_nama']; ?></td>
					<td><?php echo $s1['p_nama']; ?></td>
					<td style="text-align: right;"><?php echo number_format($s1['p_faktur']);?></td>
					<td style="text-align: right;"><?php echo number_format($s1['p_subjumlah']);?></td>
					<td style="text-align: right;"><?php echo number_format($s1['p_ppn']);?></td>
					<td style="text-align: right;"><?php echo number_format($s1['p_jumlah']);?></td>

				</tr>
				<?php
				$no++;
				$tot_subjumlah=$tot_subjumlah+$s1['p_subjumlah'];
				$tot_ppn=$tot_ppn+$s1['p_ppn'];
				$tot_jumlah=$tot_jumlah+$s1['p_jumlah'];
				$tot_faktur=$tot_faktur+$s1['p_faktur'];

			}
			?>
		</tbody>
		<tfoot>
			<tr style="font-weight:800;background-color: antiquewhite">
				<td colspan="3" style="text-align:right;"> Total :</td>
				<td style="text-align:right;"><?php echo number_format($tot_faktur);?></td>
				<td style="text-align:right;"><?php echo number_format($tot_subjumlah);?></td>

				<td style="text-align:right;"><?php echo number_format($tot_ppn);?></td>
				<td style="text-align:right;"><?php echo number_format($tot_jumlah);?></td>
			</tr>
		</tfoot>

	</table>


<?php }elseif($filter=='semua' AND $nilai=='semua'){ ?>

	<table id="example" class="table table-bordered table-striped">
		<thead style="background-color:  lightgray;font-size: 90%;" class="elevation-2">
			<tr>

				<th>No.</th>
				<th width="140px">Nama Area</th>
				<th width="140px">Nama Kota</th>
				<th width="140px">Nama Outlet</th>
				<th width="140px">Jumlah Faktur</th>
				<th><?php echo $j7; ?></th>
				<th><?php echo $j8; ?></th>
				<th><?php echo $j9; ?></th>

			</tr>
		</thead>
		<tbody>
			<?php

			$query="SELECT count(penjualan.faktur) as p_faktur,
			sum(penjualan.subjumlah) as p_subjumlah, 
			sum(penjualan.ppn) as p_ppn, 
			sum(penjualan.jumlah) as p_jumlah, 
			pelanggan.nama as p_nama, 
			kotabaru.nama as kb_nama,
			area.nama as a_nama 
			FROM penjualan 
			join pelanggan on pelanggan.kd_cus=penjualan.kd_cus 
			join kotabaru on kotabaru.kode=pelanggan.kd_kota 
			join area on area.kode=pelanggan.kd_area
			WHERE (tanggal between '$tgl_awal' and '$tgl_akhir' +interval 1 day)  GROUP BY pelanggan.kd_cus ORDER by area.kode,kotabaru.kode,pelanggan.kd_cus";


			$sql1=mysqli_query($koneksi,$query);
			$no=1;

			$tot_subjumlah=0;
			$tot_ppn=0;
			$tot_jumlah=0;
			$tot_faktur=0;

			while($s1=mysqli_fetch_array($sql1))
			{

				?>
				<tr align="left">
					<td><?php echo $no; ?></td>
					<td><?php echo $s1['a_nama']; ?></td>
					<td><?php echo $s1['kb_nama']; ?></td>
					<td><?php echo $s1['p_nama']; ?></td>
					<td style="text-align: right;"><?php echo number_format($s1['p_faktur']);?></td>
					<td style="text-align: right;"><?php echo number_format($s1['p_subjumlah']);?></td>
					<td style="text-align: right;"><?php echo number_format($s1['p_ppn']);?></td>
					<td style="text-align: right;"><?php echo number_format($s1['p_jumlah']);?></td>

				</tr>
				<?php
				$no++;
				$tot_subjumlah=$tot_subjumlah+$s1['p_subjumlah'];
				$tot_ppn=$tot_ppn+$s1['p_ppn'];
				$tot_jumlah=$tot_jumlah+$s1['p_jumlah'];
				$tot_faktur=$tot_faktur+$s1['p_faktur'];


			}
			?>
		</tbody>
		<tfoot>
			<tr style="font-weight:800;background-color: antiquewhite">
				<td colspan="4" style="text-align:right;"> Total :</td>
				<td style="text-align:right;"><?php echo number_format($tot_faktur);?></td>
				<td style="text-align:right;"><?php echo number_format($tot_subjumlah);?></td>

				<td style="text-align:right;"><?php echo number_format($tot_ppn);?></td>
				<td style="text-align:right;"><?php echo number_format($tot_jumlah);?></td>
			</tr>
		</tfoot>

	</table>

	<?php } ?>

<br>
<br>

<div style="
    font-weight: 900;
    font-size: large;
">
	SUMMARY REPORT
</div>

<table id="example" class="table table-bordered table-striped" style="width:600px">
	<thead style="background-color:  lightgray;" class="elevation-2">
		<th>Uraian</th>
		<th>Faktur</th>
		<th style="text-align:right;">Sub Jumlah</th>
		<th style="text-align:right;">Pajak</th>
		<th style="text-align:right;width: 180px;">Jumlah & Pajak</th>
	</thead>
	<tbody>
		<?php 
		$query="SELECT 
		pelanggan.nama as p_nama,
		kotabaru.nama as kb_nama ,
		jenis_transaksi.nama as jt_nama,
		sum(penjualan.jumlah) as pj_jumlah,
		count(penjualan.jumlah) as count_jumlah,
		sum(penjualan.subjumlah) as pj_subjumlah,
		sum(penjualan.ppn) as pj_ppn
		FROM penjualan 
		join pelanggan on pelanggan.kd_cus=penjualan.kd_cus
		join kotabaru on kotabaru.kode=pelanggan.kd_kota
		join jenis_transaksi on jenis_transaksi.kd_jenis=penjualan.kd_aplikasi
		WHERE (tanggal between '$tgl_awal' and '$tgl_akhir'  +interval 1 day) 
		$kondisi
		group by jenis_transaksi.kd_jenis 
		";

		$sql1=mysqli_query($koneksi,$query);
		$tot_rekap_ppn=0;
		$tot_rekap_subjumlah=0;
		$tot_rekap_jumlah=0;
		$tot_line=0;

		while($s1=mysqli_fetch_array($sql1))
		{
			?>

			<tr>
				<td width="200px"><?php echo $s1['jt_nama'];?></td>
				<td align="right"><?php echo number_format($s1['count_jumlah']);?></td>
				<td align="right"><?php echo number_format($s1['pj_subjumlah']);?></td>

				<td align="right"><?php echo number_format($s1['pj_ppn']);?></td>
				<td align="right"><?php echo number_format($s1['pj_jumlah']);?></td>
			</tr>

			<?php
			$tot_rekap_ppn=$tot_rekap_ppn+$s1['pj_ppn'];
			$tot_rekap_jumlah=$tot_rekap_jumlah+$s1['pj_jumlah'];

			$tot_line=$tot_line+$s1['count_jumlah'];
			$tot_rekap_subjumlah=$tot_rekap_subjumlah+$s1['pj_subjumlah'];

		}

		?>
	</tbody>
	<tr style="font-weight:600;font-size:110%">
		<td width="200px">Total Rekap </td>
		<td align="right"><?php echo number_format($tot_line);?></td>
		<td align="right"><?php echo number_format($tot_rekap_subjumlah);?></td>

		<td align="right"><?php echo number_format($tot_rekap_ppn);?></td>
		<td align="right"><?php echo number_format($tot_rekap_jumlah);?></td>

	</tr>

</table>