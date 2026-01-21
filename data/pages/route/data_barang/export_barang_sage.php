<?php
include "../../../../config/koneksi.php";
// open file for writing
// set headers for file download
header("Content-Type: text/plain; charset=UTF-8");
header("Content-Disposition: attachment; filename=data_barang_" . date('Ymd') . ".txt");

// open PHP output stream directly (no temp file)
$output = fopen('php://output', 'w');

// write header line (no quotes) with Windows line ending
fwrite($output, "20101,1,Inventory\r\n\r\n");

// query supplier names
$query = "SELECT `kd_brg`, `nama`, `Satuan1` FROM `barang` WHERE `kd_subgrup` IS NULL";
$sql1 = mysqli_query($koneksi, $query);

// write each supplier line
while ($s1 = mysqli_fetch_array($sql1)) {
    $code = trim($s1['kd_brg']);
    $nama = trim($s1['nama']);
    $Satuan1 = trim($s1['Satuan1']);

    // quoted string fields
    $quoted = [
        '"' . $code . '"',
        '"' . $nama . '"',
        '"Inventory"',
        '"' . $Satuan1 . '"'
    ];

    // numeric fields (no quotes)
    $numeric = [0, 0, 11015010, 41011120, 50011110, 0];

    // combine all fields
    $row = array_merge($quoted, $numeric);

    // join all with commas and add trailing comma + CRLF
    $csv_line = implode(',', $row) . ",\r\n";

    fwrite($output, $csv_line);
}

fclose($output);
exit;
