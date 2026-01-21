<?php
// Pastikan request adalah POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Cek apakah file telah diunggah dengan benar
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] === UPLOAD_ERR_OK) {
        // Tentukan direktori tujuan untuk menyimpan file
        $uploadDirectory = "uploads/";
        // Ambil nama file
        $fileName = basename($_FILES["file"]["name"]);
        // Gabungkan direktori tujuan dengan nama file
        $uploadFilePath = $uploadDirectory . $fileName;
        // Tentukan tipe file yang diizinkan
        $allowedExtensions = array("xls", "xlsx");
        // Ambil ekstensi file yang diunggah
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
        // Validasi ekstensi file
        if (in_array(strtolower($fileExtension), $allowedExtensions)) {
            // Pindahkan file yang diunggah ke direktori tujuan
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $uploadFilePath)) {
                // Proses file yang telah diunggah
                echo "File berhasil diunggah dan diproses.";
                // Lakukan proses lainnya seperti membaca data dari file dan memasukkan ke dalam database
            } else {
                echo "Terjadi kesalahan saat menyimpan file.";
            }
        } else {
            echo "File type tidak diizinkan. Hanya file Excel (.xls, .xlsx) yang diperbolehkan.";
        }
    } else {
        echo "Terjadi kesalahan saat mengunggah file.";
    }
} else {
    echo "Metode request tidak valid.";
}
?>
