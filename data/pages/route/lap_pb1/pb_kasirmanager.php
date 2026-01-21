<?php
$forty_eight_hours_ago = date('Y-m-d H:i:s', strtotime('-48 hours'));
$two_days_ago = date('Y-m-d', strtotime('-2 days'));
?>
<table id="example" class="table table-bordered table-striped">
	<thead style="background-color:  lightgray;font-size: 90%;" class="elevation-2">
		<tr>
			<th width="30px">No.</th>
			<th width="180px"><?php echo $j2; ?></th>
			<th width="160px"><?php echo $j1; ?></th>
			<th width="160px">Nama Admin</th>
			<th width="160px">Nama Member</th>

			<!--<th>Ket Aplikasi</th>
			<th>Kode Aplikasi</th>-->
			<th width="120px">Sub alat Bayar</th>
			<!--<th><?php echo $j7; ?></th>
			<th><?php echo $j8; ?></th>-->
			<th>Subjumlah</th>
			<th>Ongkir</th>
			<th>Voucher</th>
			<th><?php echo $j9; ?></th>
			<?php if ((($login_hash == 6  or $filter == 'outlet' or $login_hash == 2)) or $login_hash == 0) { ?>
				<th width="140px">Void</th>

			<?php } ?>
			<th width="140px">Print Ulang</th>
		</tr>
	</thead>
	<tbody>
		<?php

		$query = "SELECT  
		faktur,tanggal,kd_aplikasi,subjumlah,ppn,penjualan.jumlah,
		penjualan.ongkir,penjualan.voucher_nilai_diskon,penjualan.byr_pocer,(penjualan.jumlah+penjualan.ongkir-penjualan.voucher_nilai_diskon - penjualan.byr_pocer) as semua_total,
		ket_aplikasi,oleh,
		-- jenis_transaksi.nama as jt_nama,
		subalat_bayar.nama as sb_nama,COALESCE(
                                                    (SELECT member.nama
                                                    FROM member 
                                                    WHERE penjualan.no_meja = member.kd_member LIMIT 1), 
                                                    '-'
                                                ) AS namamember
		FROM penjualan 
		-- join jenis_transaksi on jenis_transaksi.kd_jenis=penjualan.kd_aplikasi
		join subalat_bayar on subalat_bayar.kdsub_alat=penjualan.kdsub_alatbayar
		WHERE penjualan.faktur_void IS NULL AND (tanggal between '$tgl_awal' and '$tgl_akhir'  +interval 1 day) $kondisi AND penjualan.subjumlah <> 0 $kondisiJoin
		";


		$sql1 = mysqli_query($koneksi, $query);
		$no = 1;

		$tot_subjumlah = 0;
		$tot_ongkir = 0;
		$tot_voucher = 0;
		$tot_jumlah_semua = 0;

		$tot_ppn = 0;
		$tot_jumlah = 0;

		while ($s1 = mysqli_fetch_array($sql1)) {
			$info = [
				$s1[$f2],
				$s1['oleh'],
				$s1['sb_nama'],
				number_format($s1[$f9]),
				number_format($s1['ongkir']),
				number_format($s1['voucher_nilai_diskon'] + $s1['byr_pocer']),
				number_format($s1['semua_total'])
			];

			$info_query = http_build_query(['info' => $info]);

			$link = "main.php?route={$view}&act&id={$s1[$f1]}&asal={$rute}&{$info_query}";

		?>
			<tr align="left">
				<td><?php echo $no; ?></td>
				<td><?php echo $s1[$f2]; ?></td>
				<!-- <td width="160px"><?php echo $s1[$f1]; ?></td> -->
				<td width="160px"><a href="<?php echo $link; ?>" title="Detail"><?php echo $s1[$f1]; ?></a></td>
				<td width="160px"><?php echo $s1['oleh']; ?></td>
				<td width="160px"><?php echo $s1['namamember']; ?></td>

				<!--<td><?php echo $s1[$f20]; ?></td>
				<td style="text-align: center;"><?php echo $s1[$f4]; ?></td>-->
				<td><?php echo $s1['sb_nama']; ?></td>
				<!--<td style="text-align: right;"><?php echo number_format($s1[$f7]); ?></td>

				<td style="text-align: right;"><?php echo number_format($s1[$f8]); ?></td>-->
				<td style="text-align: right;"><?php echo number_format($s1[$f9]); ?></td>
				<td style="text-align: right;"><?php echo number_format($s1['ongkir']); ?></td>
				<td style="text-align: right;"><?php echo number_format($s1['voucher_nilai_diskon'] + $s1['byr_pocer']); ?></td>
				<td style="text-align: right;"><?php echo number_format($s1['semua_total']); ?></td>

				<?php if ((($login_hash == 6  or $filter == 'outlet' or $login_hash == 2) && $s1['tanggal'] >= $forty_eight_hours_ago) or $login_hash == 0) { ?>
					<td align='center' width="100px;">
						<button type="button" onclick="navigateVoid(this)" class="btn btn-danger"><i class="fa fa-close"></i><strong style="color: whitesmoke; opacity: .7;"> VOID</strong></button>

					</td>
				<?php } else if ((($login_hash == 6  or $filter == 'outlet' or $login_hash == 2) && $s1['tanggal'] < $forty_eight_hours_ago) or $login_hash == 0) { ?>
					<td align='center' width="100px;"></td>
				<?php } ?>
				<td align='center' width="100px;">
					<button type="button" onclick="navigatePrintUlang(this)" class="btn btn-primary"><i class="fa fa-close"></i><strong style="color: whitesmoke; opacity: .7;"> PRINT</strong></button>

				</td>
			</tr>

		<?php
			$no++;
			$tot_subjumlah = $tot_subjumlah + $s1[$f7];

			$tot_ppn = $tot_ppn + $s1[$f8];
			$tot_jumlah = $tot_jumlah + $s1[$f9];
			$tot_ongkir += $s1['ongkir'];
			$tot_voucher += $s1['voucher_nilai_diskon'] +  $s1['byr_pocer'];
			$tot_jumlah_semua += $s1['semua_total'];
		}
		?>
	</tbody>
	<tfoot>
		<tr style="font-weight:800;background-color: antiquewhite">
			<td colspan="6" style="text-align:right;"> Total :</td>
			<!--<td style="text-align:right;"><?php echo number_format($tot_subjumlah); ?></td>

			<td style="text-align:right;"><?php echo number_format($tot_ppn); ?></td>-->
			<td style="text-align:right;"><?php echo number_format($tot_jumlah); ?></td>
			<td style="text-align:right;"><?php echo number_format($tot_ongkir); ?></td>
			<td style="text-align:right;"><?php echo number_format($tot_voucher); ?></td>
			<td style="text-align:right;"><?php echo number_format($tot_jumlah_semua); ?></td>

			<?php if ((($login_hash == 6  or $filter == 'outlet' or $login_hash == 2)) or $login_hash == 0) { ?>
				<td style="text-align:right;"></td>

			<?php } ?>
			<td style="text-align:right;"></td>

		</tr>
	</tfoot>

</table>


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
		<!-- <th style="text-align:right;">Sub Jumlah</th>
		<th style="text-align:right;">Pajak</th>-->
		<th style="text-align:right;width: 180px;">Jumlah</th>
	</thead>
	<tbody>
		<?php
		// $query = "SELECT 
		// -- pelanggan.nama as p_nama,
		// -- kotabaru.nama as kb_nama ,
		// alat_bayar.keterangan as jt_nama,
		// -- jenis_transaksi.nama as jt_nama,
		// sum(penjualan.jumlah + penjualan.ongkir) as pj_jumlah,
		// count(penjualan.jumlah) as count_jumlah,
		// sum(penjualan.subjumlah) as pj_subjumlah,
		// sum(penjualan.ppn) as pj_ppn,
		// sum(penjualan.byr_tunai) as rekap_tunai,
		// sum(penjualan.byr_non_tunai) as rekap_non_tunai
		// FROM penjualan 
		// -- join pelanggan on pelanggan.kd_cus=penjualan.kd_cus
		// -- join kotabaru on kotabaru.kode=pelanggan.kd_kota
		// join alat_bayar on alat_bayar.kd_alat=penjualan.kd_alatbayar
		// -- join jenis_transaksi on jenis_transaksi.kd_jenis=penjualan.kd_aplikasi
		// WHERE penjualan.faktur_void IS NULL AND (tanggal between '$tgl_awal' and '$tgl_akhir'  +interval 1 day) 
		// $kondisi AND penjualan.subjumlah <> 0 $kondisiJoin
		// -- group by jenis_transaksi.kd_jenis 
		// group by alat_bayar.keterangan 
		// HAVING sum(penjualan.subjumlah) <> 0
		// ORDER BY alat_bayar.keterangan ASC
		// ";

		// $sql1 = mysqli_query($koneksi, $query);
		// $tot_rekap_ppn = 0;
		// $tot_rekap_subjumlah = 0;
		// $tot_rekap_jumlah = 0;
		// $tot_line = 0;
		// $rekap_tunai_sum = 0;

		// while ($s1 = mysqli_fetch_array($sql1)) {
		// 	$rekap_tunai_sum += $s1['rekap_tunai'];

		?>

		<!-- <tr>
				<td width="200px"><?php echo $s1['jt_nama']; ?></td>
				<td align="right"><?php echo number_format($s1['count_jumlah']); ?></td> -->
		<!--<td align="right"><?php echo number_format($s1['pj_subjumlah']); ?></td>

				<td align="right"><?php echo number_format($s1['pj_ppn']); ?></td>-->
		<!-- <td align="right"><?php echo number_format($s1['pj_jumlah']); ?></td> -->
		<!-- <td align="right"> <?php echo ($s1['jt_nama'] == 'Tunai') ? number_format($rekap_tunai_sum) : number_format($s1['rekap_non_tunai']); ?>
		</td>
		</tr> -->

		<?php
		// 	$tot_rekap_ppn = $tot_rekap_ppn + $s1['pj_ppn'];
		// 	$tot_rekap_jumlah = $tot_rekap_jumlah + $s1['pj_jumlah'];

		// 	$tot_line = $tot_line + $s1['count_jumlah'];
		// 	$tot_rekap_subjumlah = $tot_rekap_subjumlah + $s1['pj_subjumlah'];
		// }

		?>
		<?php


		$query2 = "SELECT 
				sum(penjualan.byr_tunai) as rekap_tunai
				FROM penjualan 
				WHERE penjualan.faktur_void IS NULL AND penjualan.tanggal>='$tgl_awal' AND penjualan.tanggal <= '$tgl_akhir' +interval 1 day $kondisi $kondisiJoin ";

		$sql2 = mysqli_fetch_array(mysqli_query($koneksi, $query2));

		$nilai_tunai_khusus = $sql2['rekap_tunai'] ?? 0;

		$nilai_non_tunai_khusus = 0;
		?>
		<tr>
			<td width="200px">TUNAI</td>
			<td align="right"> <?php echo number_format($nilai_tunai_khusus); ?></td>
		</tr>
		<?php
		$query1 = "SELECT  
				alat_bayar.nama as ab_nama,
				penjualan.kd_alatbayar as p_alat_bayar, 
				sum(penjualan.byr_tunai) as rekap_tunai,
				sum(penjualan.byr_non_tunai) as rekap_non_tunai
				FROM penjualan
				join alat_bayar on alat_bayar.kd_alat=penjualan.kd_alatbayar 
				WHERE penjualan.faktur_void IS NULL AND penjualan.tanggal>='$tgl_awal' AND penjualan.tanggal <= '$tgl_akhir' +interval 1 day $kondisi $kondisiJoin 
				GROUP By p_alat_bayar
				";

		$sql = mysqli_query($koneksi, $query1);


		$jumlah_tunai = 0;
		$jumlah_edc_bca = 0;
		$jumlah_edc_mandiri = 0;

		while ($qq1 = mysqli_fetch_array($sql)) {
			if ($qq1['ab_nama'] == 'TUNAI') {
			} else {
				$nilai_non_tunai_khusus += $qq1['rekap_non_tunai'];
		?>
				<tr>
					<td width="200px"><?php echo $qq1['ab_nama']; ?></td>
					<td align="right"> <?php echo number_format($qq1['rekap_non_tunai']); ?></td>
				</tr>

		<?php
			}
		}

		?>
		<tr style="font-weight:600;font-size:110%">
			<td width="200px">Total Rekap </td>
			<td align="right"><?php echo number_format($nilai_tunai_khusus + $nilai_non_tunai_khusus); ?></td>
		</tr>
	</tbody>
</table>

<script>
	function navigateVoid(button) {
		var row = button.closest('tr');
		const te1s = '<?php echo $en; ?>';
		var tdValue = row.querySelector('td:nth-child(3)').textContent;
		const keteranganvoid = prompt("Masukan Keterangan VOID");
		if (keteranganvoid) {
			$.ajax({
				type: 'GET',
				url: 'route/lap_pb1/ajax_void.php?keteranganvoid=' + keteranganvoid + '&nomorfaktur=' + tdValue + '&emplyeenumber=' + te1s,
				dataType: 'json',
				success: function(response) {
					location.reload();
				},
				error: function(xhr, status, error) {
					console.log(xhr.responseText);
				}
			});
		}
	}

	function navigatePrintUlang(button) {
		var row = button.closest('tr');
		var tdValue = row.querySelector('td:nth-child(3)').textContent;
		window.location.href = 'route/lap_pb1/ajax_cetak.php?nomorfaktur=' + tdValue;
	}
</script>