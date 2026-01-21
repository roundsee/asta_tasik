<?php
// Set your predefined authentication code
$predefinedAuthCode = '123456'; // Ganti dengan kode autentikasi yang valid

// Ambil data JSON yang dikirim oleh klien
$data = json_decode(file_get_contents('php://input'), true);

// Periksa apakah kode autentikasi dikirim dan cocok dengan yang sudah ditentukan
if (isset($data['authCode']) && $data['authCode'] === $predefinedAuthCode) {
    // Jika kode autentikasi valid, kirim respons sukses
    echo json_encode(['status' => true]);
} else {
    // Jika kode autentikasi tidak valid, kirim respons gagal
    echo json_encode(['status' => false, 'message' => 'kode autentikasi tidak valid']);
}
?>
