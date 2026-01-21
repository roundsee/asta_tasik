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
			<th width="160px">Kode Barang</th>
			<th width="200px">Nama Barang</th>
			<th width="60px">Satuan</th>
			<th>Banyak</th>
			<th>Harga</th>
			<th>Harga Total</th>
			<th>Diskon</th>
			<th>Jumlah</th>
		</tr>
	</thead>
	<tbody>
		<?php

		$query = "SELECT  penjualan.tanggal,penjualan.oleh,subalat_bayar.nama as sb_nama,penjualan.jumlah,
		penjualan.ongkir,penjualan.voucher_nilai_diskon,penjualan.byr_pocer,(penjualan.jumlah+penjualan.ongkir-penjualan.voucher_nilai_diskon - penjualan.byr_pocer) as semua_total,
		penjualan.faktur,jualdetil.kd_brg,barang.nama,jualdetil.satuan,jualdetil.banyak,jualdetil.harga,jualdetil.diskon,jualdetil.jumlah as jumlah_detil
		FROM jualdetil
		JOIN penjualan on penjualan.faktur = jualdetil.faktur 
		JOIN barang on jualdetil.kd_brg = barang.kd_brg
		join subalat_bayar on subalat_bayar.kdsub_alat=penjualan.kdsub_alatbayar

		WHERE penjualan.faktur_void IS NULL AND (penjualan.tanggal between '$tgl_awal' and '$tgl_akhir'  +interval 1 day) AND penjualan.subjumlah <> 0 
		AND jualdetil.diskon <> 0;
		";
		$sql1 = mysqli_query($koneksi, $query);
		$no = 1;
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

			$link = "main.php?route=lap_pb1_detil_view&act&id={$s1[$f1]}&asal=pb1&{$info_query}";

		?>
			<tr align="left">
				<td><?php echo $no; ?></td>
				<td><?php echo $s1[$f2]; ?></td>
				<td width="160px"><a href="<?php echo $link; ?>" title="Detail"><?php echo $s1[$f1]; ?></a></td>
				<td width="160px"><?php echo $s1['kd_brg']; ?></td>
				<td width="200px"><?php echo $s1['nama']; ?></td>
				<td width="60px"><?php echo $s1['satuan']; ?></td>
				<td style="text-align: right;"><?php echo number_format($s1['banyak']); ?></td>
				<td style="text-align: right;"><?php echo number_format($s1['harga']); ?></td>
				<td style="text-align: right;"><?php echo number_format($s1['harga'] * $s1['banyak']); ?></td>
				<td style="text-align: right;"><?php echo number_format($s1['diskon']); ?></td>
				<td style="text-align: right;"><?php echo number_format($s1['jumlah_detil']); ?></td>
			</tr>

		<?php
			$no++;
		}
		?>
	</tbody>
</table>