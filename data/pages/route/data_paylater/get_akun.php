<?php
include '../../../../config/koneksi.php'; // Sesuaikan dengan file koneksi Anda

if (isset($_POST['kd_jenis'])) {
    $kd_jenis = $_POST['kd_jenis'];

    // Query untuk mengambil akun berdasarkan kd_jenis
    $query = mysqli_query($koneksi, "SELECT no_account, deskripsi FROM account WHERE kd_jenis = '$kd_jenis'");

    $akun_options = [];

    while ($row = mysqli_fetch_assoc($query)) {
        $akun_options[] = [
            'no_account' => $row['no_account'],
            'deskripsi' => $row['deskripsi']
        ];
    }

    // Mengirim hasil dalam format JSON
    echo json_encode($akun_options);
}
?>
