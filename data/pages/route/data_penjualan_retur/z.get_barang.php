<?php
include '../../../../config/koneksi.php'; // Sesuaikan dengan koneksi database Anda

if (isset($_POST['faktur'])) {
    $faktur = $_POST['faktur'];

    // Ambil data barang berdasarkan faktur dari tabel jualdetil
    $query = "SELECT jualdetil.kd_brg, barang.nama AS nama_barang, jualdetil.jumlah, jualdetil.harga,jualdetil.banyak,jualdetil.satuan,jualdetil.qty_satuan,jualdetil.kd_cus,pelanggan.nama AS nama_gudang FROM jualdetil LEFT JOIN barang ON jualdetil.kd_brg=barang.kd_brg
    LEFT JOIN pelanggan ON jualdetil.kd_cus=pelanggan.kd_cus WHERE jualdetil.faktur = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("s", $faktur);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode($data);
}
