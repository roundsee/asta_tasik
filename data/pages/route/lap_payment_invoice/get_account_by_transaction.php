<?php
include '../../../../config/koneksi.php'; // Sesuaikan dengan file koneksi Anda

if (isset($_POST['kd_jenis'])) {
    $kd_jenis = $_POST['kd_jenis'];

    // Ambil data akun yang sesuai dengan kd_jenis
    $query = mysqli_query($koneksi, "SELECT * FROM account WHERE kd_jenis = '$kd_jenis'");
    
    echo '<option value="">Pilih Akun</option>'; // Default option
    
    while ($row = mysqli_fetch_array($query)) {
        echo "<option value='$row[no_account]'>$row[no_account] - $row[deskripsi]</option>";
    }
}
?>
