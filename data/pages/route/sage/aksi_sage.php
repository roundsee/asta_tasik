<?php
include '../../../../config/koneksi.php';


$route = $_GET['route'];
$act = $_GET['act'];


if ($route == 'import_sage' and $act == 'import_sage1') {
	$tgl_awal = $_POST['tgl_awal'];
	// $tgl_akhir=$_POST['tgl_akhir'];
	$formatted_date = date("m/d/Y", strtotime($tgl_awal));

	$date = new DateTime($tgl_awal);
	$year = $date->format("y");
	$month = $date->format("m");
	$day = $date->format("d");
	$codeGR = "GR-" . $year . $month . "-0" . $day;
	$codeRE = "RE-" . $year . $month . "-0" . $day;

	$filename = "data_penjualan_" . $tgl_awal . ".csv";

	header('Content-Type: text/csv');
	header('Content-Disposition: attachment; filename="' . $filename . '"');

	$output = fopen('php://output', 'w');

	$data = [
		["<Version>"],
		[12001, "1"],
		["</Version>"],
		["<SalInvoice>"],
	];


	//GROSIR
	$data[] = ["Grosir", "0", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-"];
	// $data[] = [52, "", "$codeGR", $formatted_date, 0, "TUNAI", "75902450", 0, "PPN", 0, 1, 0, 0];
	$sumjumlah = 0;
	$sumbarang = 0;
	$data1 = [];
	$query = "SELECT jualdetil.kd_brg,sum(jualdetil.banyak*jualdetil.qty_satuan) as quantity
	,sum(jualdetil.jumlah) as nilai,penjualan.b_paking
			FROM jualdetil 
			JOIN penjualan ON penjualan.faktur = jualdetil.faktur
			WHERE penjualan.b_paking >= 2 AND penjualan.tanggal>='$tgl_awal' AND penjualan.tanggal <= '$tgl_awal' +interval 1 day 
			GROUP BY jualdetil.kd_brg
			 ";
	$sql1 = mysqli_query($koneksi, $query);
	while ($s1 = mysqli_fetch_array($sql1)) {
		$var1 = $s1['kd_brg'];
		$var2 = ($s1['quantity']);
		if ($var2 != 0) {
			$var3 = rtrim(rtrim(number_format($s1['nilai'] / $var2, 4, '.', ''), '0'), '.');
			$var4 = $s1['nilai'];
			$sumjumlah += $s1['nilai'];
			$sumbarang++;
			$data1[] = [$var1, "$var2", "$var3", "$var4", "PPN", "0", "1", "0", "0"];
		}
	}
	$data[] = [$sumbarang, "", "$codeGR", $formatted_date, 0, "TUNAI", "$sumjumlah", 0, "PPN", 0, 1, 0, 0];
	if (!empty($data1)) {
		$data = array_merge($data, $data1);
	}
	$data[] = ["</SalInvoice>"];



	//RETAIL
	$data[] = [];
	$data[] = ["<SalInvoice>"];
	$data[] = ["Retail", "0", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-"];
	$sumjumlah = 0;
	$sumbarang = 0;
	$data1 = [];
	$query = "SELECT jualdetil.kd_brg,sum(jualdetil.banyak*jualdetil.qty_satuan) as quantity
	,sum(jualdetil.jumlah) as nilai,penjualan.b_paking
			FROM jualdetil 
			JOIN penjualan ON penjualan.faktur = jualdetil.faktur
			WHERE penjualan.b_paking = 1 AND penjualan.tanggal>='$tgl_awal' AND penjualan.tanggal <= '$tgl_awal' +interval 1 day 
			GROUP BY jualdetil.kd_brg
			 ";
	$sql1 = mysqli_query($koneksi, $query);
	while ($s1 = mysqli_fetch_array($sql1)) {
		$var1 = $s1['kd_brg'];
		$var2 = ($s1['quantity']);
		if ($var2 != 0) {
			$var3 = rtrim(rtrim(number_format($s1['nilai'] / $var2, 4, '.', ''), '0'), '.');
			$var4 = $s1['nilai'];
			$sumjumlah += $s1['nilai'];
			$sumbarang++;
			$data1[] = [$var1, "$var2", "$var3", "$var4", "PPN", "0", "1", "0", "0"];
		}
	}
	$data[] = [$sumbarang, "", "$codeRE", $formatted_date, 0, "TUNAI", "$sumjumlah", 0, "PPN", 0, 1, 0, 0];
	if (!empty($data1)) {
		$data = array_merge($data, $data1);
	}
	$data[] = ["</SalInvoice>"];

	// Manually format and write each row to ensure correct output
	foreach ($data as $row) {
		// Create the CSV line with each element properly enclosed in quotes
		$csv_line = implode(',', array_map(function ($item) {
			// Always wrap item in double quotes, even if it's a number or date
			return '"' . $item . '"';
			// return ($item[1] === '<') ? $item : '"' . $item . '"';
		}, $row));

		// Write the formatted line to the output
		fwrite($output, $csv_line . "\n");
	}

	// Close the output stream
	fclose($output);
	exit;
} else if ($route == 'import_sage' and $act == 'import_sage_build') {
	$tgl_awal = $_POST['tgl_awal'];
	// $tgl_akhir=$_POST['tgl_akhir'];
	$formatted_date = date("m/d/Y", strtotime($tgl_awal));
	$date = new DateTime($tgl_awal);
	$year = $date->format("y");
	$month = $date->format("m");
	$day = $date->format("d");
	$memo = "MEMO-" . $month . "" . $day;

	$filename = "data_build_" . $tgl_awal . ".csv";

	header('Content-Type: text/csv');
	header('Content-Disposition: attachment; filename="' . $filename . '"');

	$output = fopen('php://output', 'w');

	$data = [
		["<Version>"],
		[12001, "1"],
		["</Version>"],
		["<PurInvoice>"],
		["ZZ_BUILD", "0", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-"],
	];
	$sumbarang = 0;
	$data1 = [];
	$data2 = [];
	$query = "SELECT assembly_results.kd_brg,sum(assembly_results.banyak*assembly_results.qty_satuan) as quantity
	,sum(assembly_results.jumlah) as nilai
			FROM assembly_results 
			WHERE assembly_results.tanggal>='$tgl_awal' AND assembly_results.tanggal <= '$tgl_awal' +interval 1 day 
			GROUP BY assembly_results.kd_brg
			 ";
	$sql1 = mysqli_query($koneksi, $query);
	while ($s1 = mysqli_fetch_array($sql1)) {
		$var1 = $s1['kd_brg'];
		$var2 = ($s1['quantity']);
		if ($var2 != 0) {
			$var3 = rtrim(rtrim(number_format($s1['nilai'] / $var2, 4, '.', ''), '0'), '.');
			$var4 = $s1['nilai'];
			$sumbarang++;
			$data1[] = [$var1, "$var2", "$var3", "$var4", "PPN", "0", "1", "0", "0"];
		}
	}
	$query = "SELECT assembly_components.kd_brg,sum(assembly_components.banyak*assembly_components.qty_satuan) as quantity
	,sum(assembly_components.jumlah) as nilai
			FROM assembly_components 
			WHERE assembly_components.tanggal>='$tgl_awal' AND assembly_components.tanggal <= '$tgl_awal' +interval 1 day 
			GROUP BY assembly_components.kd_brg
			 ";
	$sql1 = mysqli_query($koneksi, $query);
	while ($s1 = mysqli_fetch_array($sql1)) {
		$var1 = $s1['kd_brg'];
		$var2 = ($s1['quantity']);
		if ($var2 != 0) {
			$var3 = rtrim(rtrim(number_format($s1['nilai'] / $var2, 4, '.', ''), '0'), '.');
			$var4 = $s1['nilai'];
			$sumbarang++;
			$data2[] = [$var1, "-$var2", "$var3", "-$var4", "PPN", "0", "1", "0", "0"];
		}
	}
	$data[] = [$sumbarang, "0", "$memo", $formatted_date, 0, 0, 0, 0, 0, "PPN", 0, 1, 0, 0];

	if (!empty($data1)) {
		$data = array_merge($data, $data1);
	}
	if (!empty($data2)) {
		$data = array_merge($data, $data2);
	}
	$data[] = ["</PurInvoice>"];

	foreach ($data as $row) {
		$csv_line = implode(',', array_map(function ($item) {
			return '"' . $item . '"';
		}, $row));

		fwrite($output, $csv_line . "\n");
	}

	fclose($output);
	exit;
} else if ($route == 'import_sage' and $act == 'import_sage_pembelian') {
	$tgl_awal = $_POST['tgl_awal'];
	$tgl_akhir = $_POST['tgl_akhir'];

	$formatted_date = date("m/d/Y", strtotime($tgl_awal));

	$filename = "data_pembelian_" . $tgl_awal . "-" . $tgl_akhir . ".csv";

	header('Content-Type: text/csv');
	header('Content-Disposition: attachment; filename="' . $filename . '"');

	$output = fopen('php://output', 'w');

	$data = [
		["<Version>"],
		[12001, "1"],
		["</Version>"],
	];


	$query = "SELECT pembelian_invoice.no_invoice,supplier.nama,pembelian_invoice.tanggal_invoice
	FROM pembelian_invoice
	JOIN supplier ON supplier.kd_supp = pembelian_invoice.kd_supp
    WHERE pembelian_invoice.tanggal_invoice BETWEEN '$tgl_awal' AND '$tgl_akhir'
	GROUP BY pembelian_invoice.no_invoice
	 ";
	$sql1 = mysqli_query($koneksi, $query);
	while ($s1 = mysqli_fetch_array($sql1)) {
		$code = $s1['nama'];
		$invoice = $s1['no_invoice'];
		$data[] = ["<PurInvoice>"];
		$data[] = ["$code", "0", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-"];
		$sumjumlah = 0;
		$sumbarang = 0;
		$data1 = [];
		$formatted_date = date("m/d/Y", strtotime($s1['tanggal_invoice']));
		$query2 = "SELECT pembelian_invoice_detail.kd_brg,(pembelian_invoice_detail.nilai * pembelian_invoice_detail.jml) as newnilai,
			(pembelian_invoice_detail.jml*pembelian_invoice_detail.jml_pcs) as quantity
			FROM pembelian_invoice_detail 
			WHERE pembelian_invoice_detail.no_invoice = '$invoice'
			";
		$sql2 = mysqli_query($koneksi, $query2);
		while ($s2 = mysqli_fetch_array($sql2)) {
			$var1 = $s2['kd_brg'];
			$var2 = ($s2['quantity']);
			if ($var2 != 0) {
				$var3 = rtrim(rtrim(number_format($s2['newnilai'] / $var2, 4, '.', ''), '0'), '.');
				$var4 = $s2['newnilai'];
				$sumjumlah += $s2['newnilai'];
				$sumbarang++;
				$data1[] = [$var1, "$var2", "$var3", "$var4", "PPN", "0", "1", "0", "0"];
			}
		}
		$data[] = [$sumbarang, "0", "$invoice", $formatted_date, "$sumjumlah", 0, 0, 0, 0, "PPN", 0, 1, 0, 0];
		if (!empty($data1)) {
			$data = array_merge($data, $data1);
		}
		$data[] = ["</PurInvoice>"];
		$data[] = [];
	}


	foreach ($data as $row) {
		$csv_line = implode(',', array_map(function ($item) {
			return '"' . $item . '"';
		}, $row));

		fwrite($output, $csv_line . "\n");
	}

	fclose($output);
	exit;
} else if ($route == 'import_sage' and $act == 'import_sage2') {
	$tgl_awal = $_POST['tgl_awal'];
	// $tgl_akhir=$_POST['tgl_akhir'];
	$formatted_date = date("m/d/Y", strtotime($tgl_awal));

	$date = new DateTime($tgl_awal);
	$year = $date->format("y");
	$month = $date->format("m");
	$day = $date->format("d");
	$codeGR = "GR-" . $year . $month . "-0" . $day;
	$codeRE = "RE-" . $year . $month . "-0" . $day;

	$filename = "data_penjualan_" . $tgl_awal . ".csv";

	header('Content-Type: text/csv');
	header('Content-Disposition: attachment; filename="' . $filename . '"');

	$output = fopen('php://output', 'w');

	$data = [
		["<Version>"],
		[12001, "1"],
		["</Version>"],
		["<SalInvoice>"],
	];


	//GROSIR
	$data[] = ["Grosir", "0", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-"];
	// $data[] = [52, "", "$codeGR", $formatted_date, 0, "TUNAI", "75902450", 0, "PPN", 0, 1, 0, 0];
	$sumjumlah = 0;
	$sumbarang = 0;
	$data1 = [];
	$query = "SELECT jualdetil.kd_brg,
	SUM(
		CASE jualdetil.satuan
		WHEN barang.Satuan1 THEN barang.qty_satuan1 * jualdetil.banyak
		WHEN barang.Satuan2 THEN barang.qty_satuan2 * jualdetil.banyak
		WHEN barang.Satuan3 THEN barang.qty_satuan3 * jualdetil.banyak
		WHEN barang.Satuan4 THEN barang.qty_satuan4 * jualdetil.banyak
		WHEN barang.Satuan5 THEN barang.qty_satuan5 * jualdetil.banyak
		ELSE NULL
		END
	) AS quantity
	,sum(jualdetil.jumlah) as nilai,penjualan.b_paking
			FROM jualdetil 
			JOIN penjualan ON penjualan.faktur = jualdetil.faktur
			JOIN barang 
			ON LPAD(CONVERT(barang.kd_brg USING utf8mb4), 100, '0') = LPAD(jualdetil.kd_brg, 100, '0')
			WHERE penjualan.b_paking = 2 AND penjualan.tanggal>='$tgl_awal' AND penjualan.tanggal <= '$tgl_awal' +interval 1 day 
			GROUP BY jualdetil.kd_brg
			 ";
	$sql1 = mysqli_query($koneksi, $query);
	while ($s1 = mysqli_fetch_array($sql1)) {
		$var1 = $s1['kd_brg'];
		$var2 = ($s1['quantity']);
		if ($var2 != 0) {
			$var3 = rtrim(rtrim(number_format($s1['nilai'] / $var2, 4, '.', ''), '0'), '.');
			$var4 = $s1['nilai'];
			$sumjumlah += $s1['nilai'];
			$sumbarang++;
			$data1[] = [$var1, "$var2", "$var3", "$var4", "PPN", "0", "1", "0", "0"];
		}
	}
	$data[] = [$sumbarang, "", "$codeGR", $formatted_date, 0, "TUNAI", "$sumjumlah", 0, "PPN", 0, 1, 0, 0];
	if (!empty($data1)) {
		$data = array_merge($data, $data1);
	}
	$data[] = ["</SalInvoice>"];



	//RETAIL
	$data[] = [];
	$data[] = ["<SalInvoice>"];
	$data[] = ["Retail", "0", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-"];
	$sumjumlah = 0;
	$sumbarang = 0;
	$data1 = [];
	$query = "SELECT jualdetil.kd_brg,
	SUM(
		CASE jualdetil.satuan
		WHEN barang.Satuan1 THEN barang.qty_satuan1 * jualdetil.banyak
		WHEN barang.Satuan2 THEN barang.qty_satuan2 * jualdetil.banyak
		WHEN barang.Satuan3 THEN barang.qty_satuan3 * jualdetil.banyak
		WHEN barang.Satuan4 THEN barang.qty_satuan4 * jualdetil.banyak
		WHEN barang.Satuan5 THEN barang.qty_satuan5 * jualdetil.banyak
		ELSE NULL
		END
	) AS quantity
	,sum(jualdetil.jumlah) as nilai,penjualan.b_paking
			FROM jualdetil 
			JOIN penjualan ON penjualan.faktur = jualdetil.faktur
			JOIN barang 
			ON LPAD(CONVERT(barang.kd_brg USING utf8mb4), 100, '0') = LPAD(jualdetil.kd_brg, 100, '0')
			WHERE penjualan.b_paking = 1 AND penjualan.tanggal>='$tgl_awal' AND penjualan.tanggal <= '$tgl_awal' +interval 1 day 
			GROUP BY jualdetil.kd_brg
			 ";
	$sql1 = mysqli_query($koneksi, $query);
	while ($s1 = mysqli_fetch_array($sql1)) {
		$var1 = $s1['kd_brg'];
		$var2 = ($s1['quantity']);
		if ($var2 != 0) {
			$var3 = rtrim(rtrim(number_format($s1['nilai'] / $var2, 4, '.', ''), '0'), '.');
			$var4 = $s1['nilai'];
			$sumjumlah += $s1['nilai'];
			$sumbarang++;
			$data1[] = [$var1, "$var2", "$var3", "$var4", "PPN", "0", "1", "0", "0"];
		}
	}
	$data[] = [$sumbarang, "", "$codeRE", $formatted_date, 0, "TUNAI", "$sumjumlah", 0, "PPN", 0, 1, 0, 0];
	if (!empty($data1)) {
		$data = array_merge($data, $data1);
	}
	$data[] = ["</SalInvoice>"];

	// Manually format and write each row to ensure correct output
	foreach ($data as $row) {
		// Create the CSV line with each element properly enclosed in quotes
		$csv_line = implode(',', array_map(function ($item) {
			// Always wrap item in double quotes, even if it's a number or date
			return '"' . $item . '"';
			// return ($item[1] === '<') ? $item : '"' . $item . '"';
		}, $row));

		// Write the formatted line to the output
		fwrite($output, $csv_line . "\n");
	}

	// Close the output stream
	fclose($output);
	exit;
} else if ($route == 'import_sage' and $act == 'import_sage_retur_jual') {
	$tgl_awal = $_POST['tgl_awal'];
	// $tgl_akhir=$_POST['tgl_akhir'];
	$formatted_date = date("m/d/Y", strtotime($tgl_awal));

	$date = new DateTime($tgl_awal);
	$year = $date->format("y");
	$month = $date->format("m");
	$day = $date->format("d");
	$codeGR = "GR-" . $year . $month . "-0" . $day;
	$codeRE = "RE-" . $year . $month . "-0" . $day;

	$filename = "data_retur_penjualan_" . $tgl_awal . ".csv";

	header('Content-Type: text/csv');
	header('Content-Disposition: attachment; filename="' . $filename . '"');

	$output = fopen('php://output', 'w');

	$data = [
		["<Version>"],
		[12001, "1"],
		["</Version>"],
		["<SalInvoice>"],
	];


	//GROSIR
	$data[] = ["Grosir", "0", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-"];
	// $data[] = [52, "", "$codeGR", $formatted_date, 0, "TUNAI", "75902450", 0, "PPN", 0, 1, 0, 0];
	$sumjumlah = 0;
	$sumbarang = 0;
	$data1 = [];
	$query = " SELECT 
				rp.kd_brg,
				SUM(rp.subtotal) AS quantity,
				SUM(rp.total_retur * rp.harga) AS nilai,
				rp.kd_cus
			FROM retur_penjualan rp
			WHERE rp.kd_cus != 1316 
			AND rp.tanggal_retur = '$tgl_awal'
			GROUP BY rp.kd_brg
			 ";
	$sql1 = mysqli_query($koneksi, $query);
	while ($s1 = mysqli_fetch_array($sql1)) {
		$var1 = $s1['kd_brg'];
		$var2 = $s1['quantity'];
		if ($var2 != 0) {
			$var3 = rtrim(rtrim(number_format($s1['nilai'] / $var2, 4, '.', ''), '0'), '.');
			$var4 = $s1['nilai'];
			$sumjumlah += $s1['nilai'];
			$sumbarang++;
			$data1[] = [$var1, "-$var2", "$var3", "-$var4", "PPN", "0", "1", "0", "0"];
		}
	}
	$data[] = [$sumbarang, "", "$codeGR", $formatted_date, 0, "TUNAI", "-$sumjumlah", 0, "PPN", 0, 1, 0, 0];
	if (!empty($data1)) {
		$data = array_merge($data, $data1);
	}
	$data[] = ["</SalInvoice>"];



	//RETAIL
	$data[] = [];
	$data[] = ["<SalInvoice>"];
	$data[] = ["Retail", "0", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-"];
	$sumjumlah = 0;
	$sumbarang = 0;
	$data1 = [];
	$query = " SELECT 
				rp.kd_brg,
				SUM(rp.subtotal) AS quantity,
				SUM(rp.total_retur * rp.harga) AS nilai,
				rp.kd_cus
			FROM retur_penjualan rp
			WHERE rp.kd_cus = 1316 
			AND rp.tanggal_retur = '$tgl_awal'
			GROUP BY rp.kd_brg
			 ";
	$sql1 = mysqli_query($koneksi, $query);
	while ($s1 = mysqli_fetch_array($sql1)) {
		$var1 = $s1['kd_brg'];
		$var2 = $s1['quantity'];
		if ($var2 != 0) {
			$var3 = rtrim(rtrim(number_format($s1['nilai'] / $var2, 4, '.', ''), '0'), '.');
			$var4 = $s1['nilai'];
			$sumjumlah += $s1['nilai'];
			$sumbarang++;
			$data1[] = [$var1, "-$var2", "$var3", "-$var4", "PPN", "0", "1", "0", "0"];
		}
	}
	$data[] = [$sumbarang, "", "$codeRE", $formatted_date, 0, "TUNAI", "-$sumjumlah", 0, "PPN", 0, 1, 0, 0];
	if (!empty($data1)) {
		$data = array_merge($data, $data1);
	}
	$data[] = ["</SalInvoice>"];

	// Manually format and write each row to ensure correct output
	foreach ($data as $row) {
		// Create the CSV line with each element properly enclosed in quotes
		$csv_line = implode(',', array_map(function ($item) {
			// Always wrap item in double quotes, even if it's a number or date
			return '"' . $item . '"';
			// return ($item[1] === '<') ? $item : '"' . $item . '"';
		}, $row));

		// Write the formatted line to the output
		fwrite($output, $csv_line . "\n");
	}

	// Close the output stream
	fclose($output);
	exit;
} else if ($route == 'import_sage' and $act == 'import_sage_retur_beli') {
	$tgl_awal = $_POST['tgl_awal'];

	$formatted_date = date("m/d/Y", strtotime($tgl_awal));

	$filename = "data_retur_pembelian_" . $tgl_awal  . ".csv";

	header('Content-Type: text/csv');
	header('Content-Disposition: attachment; filename="' . $filename . '"');

	$output = fopen('php://output', 'w');

	$data = [
		["<Version>"],
		[12001, "1"],
		["</Version>"],
	];


	$query = "SELECT retur_pembelian.nota_retur as no_invoice,supplier.nama,retur_pembelian.tanggal_retur as tanggal_invoice
	FROM retur_pembelian
	JOIN supplier ON supplier.kd_supp = retur_pembelian.kd_supp
    WHERE retur_pembelian.tanggal_retur = '$tgl_awal' 
	GROUP BY retur_pembelian.nota_retur
	 ";
	$sql1 = mysqli_query($koneksi, $query);
	while ($s1 = mysqli_fetch_array($sql1)) {
		$code = $s1['nama'];
		$invoice = $s1['no_invoice'];
		$data[] = ["<PurInvoice>"];
		$data[] = ["$code", "0", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-"];
		$sumjumlah = 0;
		$sumbarang = 0;
		$data1 = [];
		$formatted_date = date("m/d/Y", strtotime($s1['tanggal_invoice']));
		$query2 = "SELECT retur_pembelian.kd_brg,retur_pembelian.total_retur as newnilai,
			(retur_pembelian.banyak*retur_pembelian.isi) as quantity
			FROM retur_pembelian 
			WHERE retur_pembelian.nota_retur = '$invoice'
			";
		$sql2 = mysqli_query($koneksi, $query2);
		while ($s2 = mysqli_fetch_array($sql2)) {
			$var1 = $s2['kd_brg'];
			$var2 = ($s2['quantity']);
			if ($var2 != 0) {
				$var3 = rtrim(rtrim(number_format($s2['newnilai'] / $var2, 4, '.', ''), '0'), '.');
				$var4 = $s2['newnilai'];
				$sumjumlah += $s2['newnilai'];
				$sumbarang++;
				$data1[] = [$var1, "-$var2", "$var3", "-$var4", "PPN", "0", "1", "0", "0"];
			}
		}
		$data[] = [$sumbarang, "0", "$invoice", $formatted_date, "-$sumjumlah", 0, 0, 0, 0, "PPN", 0, 1, 0, 0];
		if (!empty($data1)) {
			$data = array_merge($data, $data1);
		}
		$data[] = ["</PurInvoice>"];
		$data[] = [];
	}


	foreach ($data as $row) {
		$csv_line = implode(',', array_map(function ($item) {
			return '"' . $item . '"';
		}, $row));

		fwrite($output, $csv_line . "\n");
	}

	fclose($output);
	exit;
}
