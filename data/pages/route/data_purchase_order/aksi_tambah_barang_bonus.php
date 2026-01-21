<?php
header('Content-Type: application/json');
include '../../../../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil dan decode data form
    $formData = isset($_POST['formData']) ? json_decode($_POST['formData'], true) : [];

    if (empty($formData)) {
        echo json_encode(['status' => 'error', 'message' => 'No data received']);
        exit;
    }

    // Pastikan data `kd_beli_detail` dan `kd_po_detail` ada
    if (!isset($_POST['kd_beli_detail'], $_POST['kd_po_detail'])) {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak lengkap.']);
        exit;
    }

    $kd_beli = $_POST['kd_beli_detail'];
    $kd_po = $_POST['kd_po_detail'];
    $tabel2 = 'pembelian_detail'; // Pastikan tabel ini sesuai

    // Mulai transaksi
    mysqli_begin_transaction($koneksi);

    try {
        foreach ($formData as $data) {
            // Validasi data
            if (empty($data['kd_acc']) || empty($data['satuan']) || empty($data['total_pcs']) || empty($data['jumlah'])) {
                throw new Exception('Data barang tidak lengkap.');
            }

            $kd_brg = $data['kd_acc'];
            $qty_satuan = (int)$data['total_pcs'];
            $quantity_barang = (int)$data['jumlah'];
            $status_barang = 1;

            	// Query SQL
				$query = mysqli_query($koneksi, "SELECT kd_brg, nama,
                CASE 
                    WHEN qty_satuan1 = '$qty_satuan' THEN Satuan1
                    WHEN qty_satuan2 = '$qty_satuan' THEN Satuan2
                    WHEN qty_satuan3 = '$qty_satuan' THEN Satuan3
                    WHEN qty_satuan4 = '$qty_satuan' THEN Satuan4
                    WHEN qty_satuan5 = '$qty_satuan' THEN Satuan5
                    ELSE 'Tidak ada'
                END AS satuan,
                CASE 
                    WHEN qty_satuan1 = '$qty_satuan' THEN qty_satuan1
                    WHEN qty_satuan2 = '$qty_satuan' THEN qty_satuan2
                    WHEN qty_satuan3 = '$qty_satuan' THEN qty_satuan3
                    WHEN qty_satuan4 = '$qty_satuan' THEN qty_satuan4
                    WHEN qty_satuan5 = '$qty_satuan' THEN qty_satuan5
                    ELSE NULL
                END AS qty
                 FROM barang
                 WHERE '$qty_satuan' IN (qty_satuan1, qty_satuan2, qty_satuan3, qty_satuan4, qty_satuan5 ) AND kd_brg=  '$kd_brg'");
         
                         // Memeriksa hasil query
                         if ($data = mysqli_fetch_array($query)) {
                             $satuan = $data['satuan']; // Mengambil nilai dari kolom 'satuan'
                             $qty = $data['qty'];       // Mengambil nilai dari kolom 'qty'
                         }
         

        	$query = mysqli_query($koneksi, "SELECT max(urut) as urut_max FROM $tabel2 WHERE kd_beli='$kd_beli' ");
				$data = mysqli_fetch_array($query);
				$urut = $data['urut_max'];
				$urut++;

            // Insert data ke tabel `pembelian_detail`
            $insertQuery = "INSERT INTO pembelian_detail 
                            (kd_beli, kd_brg, jml, urut, satuan, jumlah_pcs, kd_po, status_barang, price) 
                            VALUES 
                            ('$kd_beli', '$kd_brg', $quantity_barang, $urut, '$satuan', $qty_satuan, '$kd_po', $status_barang, 0)";
            if (!mysqli_query($koneksi, $insertQuery)) {
                throw new Exception('Gagal menyimpan data: ' . mysqli_error($koneksi));
            }
        }

        // Commit transaksi
        mysqli_commit($koneksi);
        echo json_encode(['status' => 'success', 'message' => 'Data saved successfully']);
    } catch (Exception $e) {
        // Rollback jika terjadi error
        mysqli_rollback($koneksi);
        error_log('Error: ' . $e->getMessage());
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }

    exit;
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
