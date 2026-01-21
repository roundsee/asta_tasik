<?php
include "../../../../config/koneksi.php";
header('Content-Type: application/json');
$value = isset($_GET['value']) ? $_GET['value'] : '';
$valuesUM = isset($_GET['valuesUM']) ? $_GET['valuesUM'] : '';

$valuesUMArray = array_filter(explode(',', $valuesUM));
$data = [];

$query = "SELECT ROW_NUMBER() OVER (ORDER BY bukti_kas) as no, bukti_kas, nilai_faktur, kd_cus, tanggal, bayar_lalu FROM uang_muka WHERE kd_cus = ?";
if (!empty($valuesUMArray)) {
    $placeholders = rtrim(str_repeat('?,', count($valuesUMArray)), ',');
    $query .= " AND bukti_kas NOT IN ($placeholders)";
}

$stmt = $koneksi->prepare($query);

if (!empty($valuesUMArray)) {
    $params = array_merge([$value], $valuesUMArray);
    $types = str_repeat('s', count($params));
    $stmt->bind_param($types, ...$params);
} else {
    $stmt->bind_param("s", $value);
}

$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $tanggal = DateTime::createFromFormat('Y-m-d', $row['tanggal']);
    $formattedDate = $tanggal ? $tanggal->format('d/m/Y') : 'Invalid date';
    $data[] = [
        'no' => $row['no'],
        'tanggal' => $row['tanggal'],
        'formatetanggal' => $formattedDate,
        'bukti_kas' => $row['bukti_kas'],
        'kd_cus' => $row['kd_cus'],
        'nilai_faktur' => $row['nilai_faktur'],
        'bayar_lalu' => $row['bayar_lalu'],
        'nilai_fakturformat' => number_format($row['nilai_faktur'], 0, '', '.')
    ];
}

$stmt->close();

echo json_encode($data);

exit;
