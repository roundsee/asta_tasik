
<?php
include "../../../../config/koneksi.php";
header('Content-Type: application/json');
$value = isset($_GET['value']) ? $_GET['value'] : '';
$valuesUM = isset($_GET['valuesUM']) ? $_GET['valuesUM'] : '';

$valuesUMArray = array_filter(explode(',', $valuesUM));
$data = [];
$query = "SELECT * FROM barang ORDER BY kd_brg DESC LIMIT 2000;
";

$stmt = $koneksi->prepare($query);

$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $data[] = [
        'no' => $row['kd_brg'],
        'tanggal' =>  $row['nama'],
        'formatetanggal' => $row['nama'],
        'faktur' => $row['kd_brg'],
        'kd_cus' => $row['Satuan1'],
        'nilai_faktur' => $row['Satuan1'],
        'bayar_lalu' => $row['Satuan1'],
        'nilai_fakturformat' => number_format($row['harga'], 0, '', '.')
    ];
}

$stmt->close();

echo json_encode($data);
exit;
