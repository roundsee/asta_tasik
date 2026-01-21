<?php
include '../../../../config/koneksi.php';

// Validasi koneksi database
if (!isset($koneksi)) {
    echo json_encode(['error' => 'Database connection is not initialized.']);
    exit;
}

// Tangkap parameter dari permintaan AJAX
$search = isset($_POST['search']) ? $_POST['search'] : '';
$limit = isset($_POST['limit']) ? (int)$_POST['limit'] : 20;

try {
    $searchTerm = "%$search%";
    $sql = "SELECT kd_brg, nama, harga FROM barang WHERE nama LIKE ? OR kd_brg LIKE ? LIMIT ?";
    $query = $koneksi->prepare($sql);

    if (!$query) {
        throw new Exception('Query preparation failed: ' . $koneksi->error);
    }

    $query->bind_param('ssi', $searchTerm, $searchTerm, $limit);
    $query->execute();
    $result = $query->get_result();

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = [
            'kode_barang' => $row['kd_brg'],
            'nama_barang' => $row['nama'],
            'harga' => $row['harga']
        ];
    }

    echo json_encode($data);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
