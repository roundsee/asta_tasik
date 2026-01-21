<?php
include '../../../../config/koneksi.php'; // Sesuaikan dengan koneksi database Anda

if (isset($_POST['tanggal'])) {
    $tanggal = $_POST['tanggal'];
    $tgl_param = "%" . $tanggal . "%"; // Tambahkan wildcard %

    $query = "SELECT faktur FROM penjualan WHERE tanggal LIKE ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("s", $tgl_param);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode($data);
}
