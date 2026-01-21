<?php
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    require '../../../../config/koneksi.php'; // Adjust path if necessary
    daftarBarang($_GET['search']);
}

function daftarBarang($search)
{
    global $koneksi;

    // Check connection
    if ($koneksi->connect_error) {
        die("Connection failed: " . $koneksi->connect_error);
    }

    // Sanitize input to prevent SQL injection
    $search = $koneksi->real_escape_string($search);

    // Query to fetch data matching the search term
    $sql = "
        SELECT 
            b.kd_brg,
            b.nama,
            b.hrg_pcs,
            b.qty_satuan1,
            b.qty_satuan2,
            b.qty_satuan3,
            b.qty_satuan4,
            b.qty_satuan5,
            b.Box,
            b.Dus
        FROM barang b
        WHERE b.kd_brg LIKE '%$search%' OR b.nama LIKE '%$search%'
        ORDER BY b.nama ASC
        LIMIT 3000
    ";

    $result = $koneksi->query($sql);

    if ($result->num_rows > 0) {
        $list = array();
        while ($row = $result->fetch_assoc()) {
            $list[] = [
                'id' => $row['kd_brg'],
                'text' => $row['kd_brg'] . ' - ' . $row['nama'],
                'html' => "<option value='{$row['kd_brg']}'
                            data-harga='{$row['hrg_pcs']}'
                            data-pcs='{$row['qty_satuan1']}'
                            data-renteng='{$row['qty_satuan2']}'
                            data-pak='{$row['qty_satuan3']}'
                            data-ikat='{$row['qty_satuan4']}'
                            data-ball='{$row['qty_satuan5']}'
                            data-box='{$row['Box']}'
                            data-dus='{$row['Dus']}'>
                            {$row['kd_brg']} - {$row['nama']}</option>"
            ];
        }
        echo json_encode($list);
    } else {
        echo json_encode([]);
    }

    $koneksi->close();
}
