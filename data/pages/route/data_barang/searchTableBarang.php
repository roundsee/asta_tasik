<?php

include "../../../../config/koneksi.php";
include "../../../../config/fungsi_rupiah.php";

header('Content-Type: application/json');

$value = isset($_GET['value']) ? $_GET['value'] : '';

if (isset($value)) {
    $search = mysqli_real_escape_string($koneksi, $value);
    if ($search === "") {
        $query = "SELECT * FROM barang WHERE kd_subgrup is null ORDER BY kd_brg ASC LIMIT 100";
    } else {
        $query = "SELECT * FROM barang WHERE (nama LIKE '%$search%' OR kd_brg LIKE '%$search%') AND kd_subgrup is null ORDER BY kd_brg ASC LIMIT 100";
    }

    $result = mysqli_query($koneksi, $query);
    if (!$result) {
        // Output an error message in JSON format
        echo json_encode(['error' => mysqli_error($koneksi)]);
        exit;
    }

    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = [
            'f1' => $row['kd_brg'],
            'f2' => $row['nama'],
            'f3' => format_rupiah($row['harga']),
            'f_41' => $row['Satuan1'],
            'f_42' => $row['Satuan2'],
            'f_43' => $row['Satuan3'],
            'f_44' => $row['Satuan4'],
            'f_45' => $row['Satuan5'],
            'f_91' => $row['qty_satuan1'],
            'f_92' => $row['qty_satuan2'],
            'f_93' => $row['qty_satuan3'],
            'f_94' => $row['qty_satuan4'],
            'f_95' => $row['qty_satuan5'],
            'f_31' => format_rupiah($row['hrg_satuan1']),
            'f_32' => format_rupiah($row['hrg_satuan2']),
            'f_33' => format_rupiah($row['hrg_satuan3']),
            'f_34' => format_rupiah($row['hrg_satuan4']),
            'f_35' => format_rupiah($row['hrg_satuan5']),
            'f31' => $row['ktg_retail'],
            'f32' => $row['ktg_grosir'],
            'f33' => $row['ktg_online'],
            'f34' => $row['ktg_ms'],
            'f35' => $row['ktg_mg'],
            'f36' => $row['ktg_mp'],
            'f37' => $row['ktg_buffer'],
            'f9' => $row['Quantity'],
            'datagambar' => empty($row['photo']) ? 'images.jpeg' : $row['photo']
        ];
    }

    echo json_encode($data);
    exit;
}
