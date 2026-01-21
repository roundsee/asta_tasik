<?php
include '../../../../config/koneksi.php'; // Sesuaikan dengan koneksi database Anda

if (isset($_POST['faktur'])) {
    $faktur = $_POST['faktur'];

    // Ambil data barang berdasarkan faktur dari tabel jualdetil
    $query = "SELECT jualdetil.kd_brg, barang.nama AS nama_barang, jualdetil.jumlah, jualdetil.harga,jualdetil.banyak,jualdetil.satuan,jualdetil.qty_satuan,jualdetil.kd_cus,
    pelanggan.nama AS nama_gudang,penjualan.oleh, r.total_retur as total_retur,penjualan.b_paking
    FROM jualdetil 
    LEFT JOIN barang ON jualdetil.kd_brg=barang.kd_brg
    LEFT JOIN penjualan ON jualdetil.faktur=penjualan.faktur
    LEFT JOIN (
        SELECT faktur, kd_brg, SUM(total_retur) AS total_retur
        FROM retur_penjualan
        GROUP BY faktur, kd_brg
    ) r ON jualdetil.faktur = r.faktur 
    AND jualdetil.kd_brg = r.kd_brg
    LEFT JOIN pelanggan ON jualdetil.kd_cus=pelanggan.kd_cus WHERE jualdetil.faktur = ? GROUP BY jualdetil.kd_brg";
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
