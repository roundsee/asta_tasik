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
			<th>byr_tunai</th>
			<th>byr_non_tunai</th>

			<?php if (($login_hash == 6  or $filter == 'outlet' or $login_hash == 2) && $tgl_awal == date("Y-m-d")) { ?>
				<!-- <th width="140px">Void</th> -->

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
		penjualan.ongkir,(penjualan.voucher_nilai_diskon + penjualan.byr_pocer) as voucher_nilai_diskon,(penjualan.jumlah+penjualan.ongkir-penjualan.voucher_nilai_diskon- penjualan.byr_pocer) as semua_total,
		ket_aplikasi,oleh,''as kodebarang,''as namabarang,''as satuanbarang,''as jumlahbarang,''as hargabarang,byr_tunai,byr_non_tunai,
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
		WHERE penjualan.faktur_void IS NULL AND (tanggal between '$tgl_awal' and '$tgl_akhir'  +interval 1 day) $kondisi $kondisiJoin
		UNION ALL
		SELECT  
		jualdetil.faktur as fakturall,'' as tanggal,'' as kd_aplikasi,'' as subjumlah,'' as ppn,'' as jumlah,
		'' as ongkir, '' as voucher_nilai_diskon,'' as  semua_total,
		'' as ket_aplikasi,'' as oleh,jualdetil.kd_brg as kodebarang,ifnull((SELECT nama from barang where barang.kd_brg = jualdetil.kd_brg),' ') as namabarang,
		jualdetil.satuan as satuanbarang,jualdetil.banyak as jumlahbarang, jualdetil.jumlah as hargabarang,'' as byr_tunai,'' as byr_non_tunai,
		-- jenis_transaksi.nama as jt_nama,
		'' as sb_nama, '' as namamember
		FROM jualdetil 
		join penjualan on penjualan.faktur =jualdetil.faktur
		-- join jenis_transaksi on jenis_transaksi.kd_jenis=penjualan.kd_aplikasi
		join subalat_bayar on subalat_bayar.kdsub_alat=penjualan.kdsub_alatbayar
		WHERE penjualan.faktur_void IS NULL AND (penjualan.tanggal between '$tgl_awal' and '$tgl_akhir'  +interval 1 day) $kondisi $kondisiJoin
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
		$tanggal_1 = 0;
		$oleh_1 = 0;
		$sub_bayar_1 = 0;
		$faktur_1 = 0;
		$namamember_1 = 0;

		$subjumlah123 = 0;
		$ongki123 = 0;
		$voucher123 = 0;
		$jumlah123 = 0;
		$bayartunai123 = 0;
		$bayarnontunai123 = 0;


		while ($s1 = mysqli_fetch_array($sql1)) {
			$penanda = 0;
			if ($faktur_1 != $s1['fakturall']) {
				$tanggal_1 = $s1[$f2];
				$oleh_1 = $s1['oleh'];
				$namamember_1 = $s1['namamember'];
				$sub_bayar_1 = $s1['sb_nama'];
				$faktur_1 = $s1['fakturall'];
				$subjumlah123 = (!isset($s1[$f9]) || $s1[$f9] === null || $s1[$f9] === "" ? "" : number_format($s1[$f9]));
				$ongki123 = (!isset($s1['ongkir']) || $s1['ongkir'] === null || $s1['ongkir'] === "" ? "" : number_format($s1['ongkir']));
				$voucher123 = (!isset($s1['voucher_nilai_diskon']) || $s1['voucher_nilai_diskon'] === null || $s1['voucher_nilai_diskon'] === "" ? "" : number_format($s1['voucher_nilai_diskon']));
				$jumlah123 = (!isset($s1['semua_total']) || $s1['semua_total'] === null || $s1['semua_total'] === "" ? "" : number_format($s1['semua_total']));
				$bayartunai123 = (!isset($s1['byr_tunai']) || $s1['byr_tunai'] === null || $s1['byr_tunai'] === "" ? "" : number_format($s1['byr_tunai']));
				$bayarnontunai123 = (!isset($s1['byr_non_tunai']) || $s1['byr_non_tunai'] === null || $s1['byr_non_tunai'] === "" ? "" : number_format($s1['byr_non_tunai']));
				$penanda = 1;
			}
		?>
			<tr align="left">
				<td><?php echo $no; ?></td>
				<td><?php echo $tanggal_1; ?></td>
				<td width="160px"><?php echo $s1['fakturall']; ?></td>
				<td width="160px"><?php echo $oleh_1; ?></td>
				<td width="160px"><?php echo $namamember_1; ?>
					<!--<td><?php echo $s1[$f20]; ?></td>
				<td style="text-align: center;"><?php echo $s1[$f4]; ?></td>-->
				<td><?php echo $sub_bayar_1; ?></td>
				<td><?php echo $s1['kodebarang']; ?></td>
				<td><?php echo $s1['namabarang']; ?></td>
				<td><?php echo $s1['satuanbarang']; ?></td>
				<td><?php echo (!isset($s1['jumlahbarang']) || $s1['jumlahbarang'] === null || $s1['jumlahbarang'] === "" ? "" : number_format($s1['jumlahbarang'])); ?></td>
				<td><?php echo (!isset($s1['hargabarang']) || $s1['hargabarang'] === null || $s1['hargabarang'] === "" ? "" : number_format($s1['hargabarang'])); ?></td>
				<?php if ($penanda == 1) { ?>
					<td style="text-align: right;"><?php echo $subjumlah123; ?></td>
					<td style="text-align: right;"><?php echo $ongki123; ?></td>
					<td style="text-align: right;"><?php echo $voucher123; ?></td>
					<td style="text-align: right;"><?php echo $jumlah123; ?></td>
					<td style="text-align: right;"><?php echo $bayartunai123; ?></td>
					<td style="text-align: right;"><?php echo $bayarnontunai123; ?></td>
				<?php } else if ($penanda != 1 && $cetakasli != 1) { ?>
					<td style="text-align: right; color: transparent;"><?php echo $subjumlah123; ?></td>
					<td style="text-align: right; color: transparent;"><?php echo $ongki123; ?></td>
					<td style="text-align: right; color: transparent;"><?php echo $voucher123; ?></td>
					<td style="text-align: right; color: transparent;"><?php echo $jumlah123; ?></td>
					<td style="text-align: right; color: transparent;"><?php echo $bayartunai123; ?></td>
					<td style="text-align: right; color: transparent;"><?php echo $bayarnontunai123; ?></td>
				<?php } else { ?>
					<td style="text-align: right;"></td>
					<td style="text-align: right;"></td>
					<td style="text-align: right;"></td>
					<td style="text-align: right;"></td>
					<td style="text-align: right;"></td>
					<td style="text-align: right;"></td>
				<?php } ?>

				<?php if (($login_hash == 6  or $filter == 'outlet' or $login_hash == 2) && $tgl_awal == date("Y-m-d")) { ?>
					<?php if ($s1['tanggal'] != "") { ?>
						<!-- <td align='center' width="100px;">
							<button type="button" onclick="navigateVoid(this)" class="btn btn-danger"><i class="fa fa-close"></i><strong style="color: whitesmoke; opacity: .7;"> VOID</strong></button>

						</td> -->
					<?php } else { ?>
						<!-- <td align='center' width="100px;"><?php echo $s1['tanggal']; ?></td> -->

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
			<td colspan="11" style="text-align:right;"> Total :</td>
			<!--<td style="text-align:right;"><?php echo number_format($tot_subjumlah); ?></td>

			<td style="text-align:right;"><?php echo number_format($tot_ppn); ?></td>-->
			<td style="text-align:right;"><?php echo number_format($tot_jumlah); ?></td>
			<td style="text-align:right;"><?php echo number_format($tot_ongkir); ?></td>
			<td style="text-align:right;"><?php echo number_format($tot_voucher); ?></td>
			<td style="text-align:right;"><?php echo number_format($tot_jumlah_semua); ?></td>
			<td style="text-align:right;"></td>
			<td style="text-align:right;"></td>

			<?php if (($login_hash == 6  or $filter == 'outlet' or $login_hash == 2) && $tgl_awal == date("Y-m-d")) { ?>
				<!-- <td style="text-align:right;"></td> -->

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