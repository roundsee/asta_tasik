<?php
include "../../../../config/koneksi.php";
// open file for writing
// set headers for file download
header("Content-Type: text/plain; charset=UTF-8");
header("Content-Disposition: attachment; filename=data_supplier_" . date('Ymd') . ".txt");

// open PHP output stream directly (no temp file)
$output = fopen('php://output', 'w');

// write header line (no quotes) with Windows line ending
fwrite($output, "20101,1,Vendors\r\n\r\n");

// query supplier names
$query = "SELECT nama FROM supplier";
$sql1 = mysqli_query($koneksi, $query);

// write each supplier line
while ($s1 = mysqli_fetch_array($sql1)) {
    $code = trim($s1['nama']); // trim to avoid trailing spaces

    $row = [$code, "", "", "", "", "", "", "", "", "", "", "", "", "IDR", ""];
    $csv_line = implode(',', array_map(function ($item) {
        return '"' . $item . '"';
    }, $row));

    fwrite($output, $csv_line . ",\r\n"); // Windows line ending
}

fclose($output);
exit;
