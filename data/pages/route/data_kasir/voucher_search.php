<?php
include '../../../../config/koneksi.php'; // Sesuaikan dengan koneksi database Anda

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $kd_voucher = $_POST['kd_voucher'];

  // Query untuk mencari nilai voucher
  $query = "SELECT nilai FROM voucher WHERE kd_voucher = ?";
  $stmt = $koneksi->prepare($query);
  $stmt->bind_param("s", $kd_voucher);
  $stmt->execute();
  $stmt->bind_result($nilai_voucher);

  if ($stmt->fetch()) {
    echo json_encode(["success" => true, "nilai_voucher" => $nilai_voucher]);
  } else {
    echo json_encode(["success" => false]);
  }

  $stmt->close();
  $koneksi->close();
}
