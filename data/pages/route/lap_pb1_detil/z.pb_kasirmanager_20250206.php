<table id="example" class="table table-bordered table-striped">
	<thead style="background-color:  lightgray;font-size: 90%;" class="elevation-2">
		<tr>
			<th width="30px">No.</th>
			<th width="180px"><?php echo $j2; ?></th>
			<th width="160px"><?php echo $j1; ?></th>
			<th width="160px">Nama Admin</th>

			<!--<th>Ket Aplikasi</th>
			<th>Kode Aplikasi</th>-->
			<th width="120px">Sub alat Bayar</th>
			<th>Kode Barang</th>
			<th>Barang</th>
			<th>Satuan</th>
			<th>Qty</th>
			<th>Harga</th>
			<!--<th><?php echo $j7; ?></th>
			<th><?php echo $j8; ?></th>-->
			<th>Subjumlah</th>
			<th>Ongkir</th>
			<th>Voucher</th>
			<th><?php echo $j9; ?></th>
			<?php if (($login_hash == 6  or $filter == 'outlet' or $login_hash == 2) && $tgl_awal == date("Y-m-d")) { ?>
				<th width="140px">Void</th>

			<?php } ?>
			<th width="140px">Print Ulang</th>
		</tr>
	</thead>
	<tbody>
		<?php
		function safe_int($value)
		{
			return is_numeric($value) ? (int)$value : 0;
		}

		$query = "SELECT  
		faktur as fakturall,tanggal,kd_aplikasi,subjumlah,ppn,penjualan.jumlah,
		penjualan.ongkir,penjualan.voucher_nilai_diskon,(penjualan.jumlah+penjualan.ongkir-penjualan.voucher_nilai_diskon) as semua_total,
		ket_aplikasi,oleh,''as kodebarang,''as namabarang,''as satuanbarang,''as jumlahbarang,''as hargabarang,
		-- jenis_transaksi.nama as jt_nama,
		subalat_bayar.nama as sb_nama
		FROM penjualan 
		-- join jenis_transaksi on jenis_transaksi.kd_jenis=penjualan.kd_aplikasi
		JOIN (SELECT DISTINCT name_e, kategori_kasir FROM employee $kondisilokasi) AS filtered_employee ON filtered_employee.name_e = penjualan.oleh  
		join subalat_bayar on subalat_bayar.kdsub_alat=penjualan.kdsub_alatbayar
		WHERE (tanggal between '$tgl_awal' and '$tgl_akhir'  +interval 1 day) $kondisi
		UNION ALL
		SELECT  
		jualdetil.faktur as fakturall,'' as tanggal,'' as kd_aplikasi,'' as subjumlah,'' as ppn,'' as jumlah,
		'' as ongkir, '' as voucher_nilai_diskon,'' as  semua_total,
		ifnull((SELECT nama from barang where barang.kd_brg = jualdetil.kd_brg),' ') as namabarang,
		'' as ket_aplikasi,'' as oleh, jualdetil.kd_brg as kodebarang, jualdetil.satuan as satuanbarang,jualdetil.banyak as jumlahbarang, jualdetil.jumlah as hargabarang,
		-- jenis_transaksi.nama as jt_nama,
		'' as sb_nama
		FROM jualdetil 
		join penjualan on penjualan.faktur =jualdetil.faktur
		-- join jenis_transaksi on jenis_transaksi.kd_jenis=penjualan.kd_aplikasi
		JOIN (SELECT DISTINCT name_e, kategori_kasir FROM employee $kondisilokasi) AS filtered_employee ON filtered_employee.name_e = penjualan.oleh  
		join subalat_bayar on subalat_bayar.kdsub_alat=penjualan.kdsub_alatbayar
		WHERE (penjualan.tanggal between '$tgl_awal' and '$tgl_akhir'  +interval 1 day) $kondisi
		ORDER BY fakturall, tanggal desc;
		";

		$sql1 = mysqli_query($koneksi, $query);
		$row_count = mysqli_num_rows($sql1);
		$no = 1;

		$tot_subjumlah = 0;
		$tot_ongkir = 0;
		$tot_voucher = 0;
		$tot_jumlah_semua = 0;

		$tot_ppn = 0;
		$tot_jumlah = 0;

		while ($s1 = mysqli_fetch_array($sql1)) {
		?>
			<tr align="left">
				<td><?php echo $no; ?></td>
				<td><?php echo $s1[$f2]; ?></td>
				<td width="160px"><?php echo $s1['fakturall']; ?></td>
				<td width="160px"><?php echo $s1['oleh']; ?></td>

				<!--<td><?php echo $s1[$f20]; ?></td>
				<td style="text-align: center;"><?php echo $s1[$f4]; ?></td>-->
				<td><?php echo $s1['sb_nama']; ?></td>
				<td><?php echo $s1['kodebarang']; ?></td>
				<td><?php echo $s1['namabarang']; ?></td>
				<td><?php echo $s1['satuanbarang']; ?></td>
				<td><?php echo (!isset($s1['jumlahbarang']) || $s1['jumlahbarang'] === null || $s1['jumlahbarang'] === "" ? "" : number_format($s1['jumlahbarang'])); ?></td>
				<td><?php echo (!isset($s1['hargabarang']) || $s1['hargabarang'] === null || $s1['hargabarang'] === "" ? "" : number_format($s1['hargabarang'])); ?></td>

				<td style="text-align: right;"><?php echo (!isset($s1[$f9]) || $s1[$f9] === null || $s1[$f9] === "" ? "" : number_format($s1[$f9])); ?></td>
				<td style="text-align: right;"><?php echo (!isset($s1['ongkir']) || $s1['ongkir'] === null || $s1['ongkir'] === "" ? "" : number_format($s1['ongkir'])); ?></td>
				<td style="text-align: right;"><?php echo (!isset($s1['voucher_nilai_diskon']) || $s1['voucher_nilai_diskon'] === null || $s1['voucher_nilai_diskon'] === "" ? "" : number_format($s1['voucher_nilai_diskon'])); ?></td>
				<td style="text-align: right;"><?php echo (!isset($s1['semua_total']) || $s1['semua_total'] === null || $s1['semua_total'] === "" ? "" : number_format($s1['semua_total'])); ?></td>



				<?php if (($login_hash == 6  or $filter == 'outlet' or $login_hash == 2) && $tgl_awal == date("Y-m-d")) { ?>
					<?php if ($s1['tanggal'] != "") { ?>
						<td align='center' width="100px;">
							<button type="button" onclick="navigateVoid(this)" class="btn btn-danger"><i class="fa fa-close"></i><strong style="color: whitesmoke; opacity: .7;"> VOID</strong></button>

						</td>
					<?php } else { ?>
						<td align='center' width="100px;"><?php echo $s1['tanggal']; ?></td>

					<?php } ?>
				<?php } ?>
				<?php if ($s1['tanggal'] != "") { ?>

					<td align='center' width="100px;">
						<button type="button" onclick="navigatePrintUlang(this)" class="btn btn-primary"><i class="fa fa-close"></i><strong style="color: whitesmoke; opacity: .7;"> PRINT</strong></button>

					</td>
				<?php } else { ?>
					<td align='center' width="100px;"><?php echo $s1['tanggal']; ?></td>

				<?php } ?>


			</tr>

		<?php
			$no++;
			$tot_subjumlah += safe_int($s1[$f7] ?? null);
			$tot_ppn += safe_int($s1[$f8] ?? null);
			$tot_jumlah += safe_int($s1[$f9] ?? null);
			$tot_ongkir += safe_int($s1['ongkir'] ?? null);
			$tot_voucher += safe_int($s1['voucher_nilai_diskon'] ?? null);
			$tot_jumlah_semua += safe_int($s1['semua_total'] ?? null);


			// $tot_subjumlah = $tot_subjumlah + $s1[$f7];

			// $tot_ppn = $tot_ppn + $s1[$f8];
			// $tot_jumlah = $tot_jumlah + $s1[$f9];
			// $tot_ongkir += $s1['ongkir'];
			// $tot_voucher += $s1['voucher_nilai_diskon'];
			// $tot_jumlah_semua += $s1['semua_total'];
		}
		?>
	</tbody>
	<tfoot>
		<tr style="font-weight:800;background-color: antiquewhite">
			<td colspan="10" style="text-align:right;"> Total :</td>
			<!--<td style="text-align:right;"><?php echo number_format($tot_subjumlah); ?></td>

			<td style="text-align:right;"><?php echo number_format($tot_ppn); ?></td>-->
			<td style="text-align:right;"><?php echo number_format($tot_jumlah); ?></td>
			<td style="text-align:right;"><?php echo number_format($tot_ongkir); ?></td>
			<td style="text-align:right;"><?php echo number_format($tot_voucher); ?></td>
			<td style="text-align:right;"><?php echo number_format($tot_jumlah_semua); ?></td>

			<?php if (($login_hash == 6  or $filter == 'outlet' or $login_hash == 2) && $tgl_awal == date("Y-m-d")) { ?>
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
		<th>Faktur</th>
		<!-- <th style="text-align:right;">Sub Jumlah</th>
		<th style="text-align:right;">Pajak</th>-->
		<th style="text-align:right;width: 180px;">Jumlah</th>
	</thead>
	<tbody>
		<?php
		$query = "SELECT 
		-- pelanggan.nama as p_nama,
		-- kotabaru.nama as kb_nama ,
		alat_bayar.keterangan as jt_nama,
		-- jenis_transaksi.nama as jt_nama,
		sum(penjualan.jumlah + penjualan.ongkir) as pj_jumlah,
		count(penjualan.jumlah) as count_jumlah,
		sum(penjualan.subjumlah) as pj_subjumlah,
		sum(penjualan.ppn) as pj_ppn
		FROM penjualan 
		-- join pelanggan on pelanggan.kd_cus=penjualan.kd_cus
		-- join kotabaru on kotabaru.kode=pelanggan.kd_kota
		join alat_bayar on alat_bayar.kd_alat=penjualan.kd_alatbayar
		JOIN (SELECT DISTINCT name_e, kategori_kasir FROM employee $kondisilokasi) AS filtered_employee ON filtered_employee.name_e = penjualan.oleh  
		-- join jenis_transaksi on jenis_transaksi.kd_jenis=penjualan.kd_aplikasi
		WHERE (tanggal between '$tgl_awal' and '$tgl_akhir'  +interval 1 day) 
		$kondisi AND penjualan.subjumlah <> 0
		-- group by jenis_transaksi.kd_jenis 
		group by alat_bayar.keterangan 
		HAVING sum(penjualan.subjumlah) <> 0
		";

		$sql1 = mysqli_query($koneksi, $query);
		$tot_rekap_ppn = 0;
		$tot_rekap_subjumlah = 0;
		$tot_rekap_jumlah = 0;
		$tot_line = 0;

		while ($s1 = mysqli_fetch_array($sql1)) {
		?>

			<tr>
				<td width="200px"><?php echo $s1['jt_nama']; ?></td>
				<td align="right"><?php echo number_format($s1['count_jumlah']); ?></td>
				<!--<td align="right"><?php echo number_format($s1['pj_subjumlah']); ?></td>

				<td align="right"><?php echo number_format($s1['pj_ppn']); ?></td>-->
				<td align="right"><?php echo number_format($s1['pj_jumlah']); ?></td>
			</tr>

		<?php
			$tot_rekap_ppn = $tot_rekap_ppn + $s1['pj_ppn'];
			$tot_rekap_jumlah = $tot_rekap_jumlah + $s1['pj_jumlah'];

			$tot_line = $tot_line + $s1['count_jumlah'];
			$tot_rekap_subjumlah = $tot_rekap_subjumlah + $s1['pj_subjumlah'];
		}

		?>
	</tbody>
	<tr style="font-weight:600;font-size:110%">
		<td width="200px">Total Rekap </td>
		<td align="right"><?php echo number_format($tot_line); ?></td>
		<!--<td align="right"><?php echo number_format($tot_rekap_subjumlah); ?></td>

		<td align="right"><?php echo number_format($tot_rekap_ppn); ?></td>-->
		<td align="right"><?php echo number_format($tot_rekap_jumlah); ?></td>

	</tr>

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
				url: 'route/lap_pb1_detil/ajax_void.php?keteranganvoid=' + keteranganvoid + '&nomorfaktur=' + tdValue + '&emplyeenumber=' + te1s,
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
		window.location.href = 'route/lap_pb1_detil/ajax_cetak.php?nomorfaktur=' + tdValue;
	}
</script>