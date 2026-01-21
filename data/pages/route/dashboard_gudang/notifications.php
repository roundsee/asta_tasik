<?php
include "../../../../config/koneksi.php";
header('Content-Type: application/json');

$notifications = [];
$query = "SELECT * FROM gudang_order WHERE `status`= 0 ORDER BY tanggal DESC";

$stmt = $koneksi->prepare($query);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $notifications[] = $row;
}

$stmt->close();
echo json_encode($notifications);
exit;
