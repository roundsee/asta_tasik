<?php
include "../../../../config/koneksi.php";
header('Content-Type: application/json');

$nomorfaktur = isset($_GET['nomorfaktur']) ? $_GET['nomorfaktur'] : '';

if (!empty($nomorfaktur)) {
    $query = "UPDATE gudang_order SET `status` = 1 WHERE faktur = ?";
    $stmt = $koneksi->prepare($query);

    if ($stmt) {
        $stmt->bind_param("s", $nomorfaktur);

        $success = $stmt->execute();
        $stmt->close();

        echo json_encode([
            'success' => $success,
            'faktur' => $nomorfaktur
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'error' => 'Statement preparation failed'
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'error' => 'No faktur provided'
    ]);
}
exit;
