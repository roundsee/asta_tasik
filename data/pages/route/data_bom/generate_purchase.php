<?php

session_start();
// Pastikan halaman ini hanya diakses setelah pengiriman form dari halaman sebelumnya
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sertakan file koneksi
    include '../../../../config/koneksi.php';
    $employee = $_SESSION['employee_number'];
    
    // Tangkap data yang dikirimkan dari form
    if (isset($_POST['selected_items']) && !empty($_POST['selected_items'])) {
        // Escape data untuk mencegah SQL injection
        $selected_items = $_POST['selected_items'];
        // echo "kode PURCHASE REQUEST YANG DIPILIH : ";
        // print_r($selected_items);
        // die();

        // Tanggal update
        $tanggal_update = date('Y-m-d');
        // echo "<br>" . $tanggal_update;

        // Loop melalui item yang dipilih
        foreach ($selected_items as $selected) {
            list($kd_beli) = explode('|', $selected);
            $kd_beli = mysqli_real_escape_string($koneksi, $kd_beli);
            // echo "kode PURCHASE REQUEST YANG DIPILIH : ";


            // print_r($kd_beli) ;
            // die();

            // Update status menjadi 1 di tabel stock_opname
            $query_update = "UPDATE pembelian 
                             SET status_pembelian = 1 , tgl_po = '$tanggal_update', user_input_terbit = '$employee'
                             WHERE kd_beli= '$kd_beli'";

            if (!mysqli_query($koneksi, $query_update)) {
                echo "Error: " . $query_update . "<br>" . mysqli_error($koneksi);
            }

            // echo $query_update ;
            // die();

           
        }

        echo "<script>alert('Data berhasil diupdate.');</script>";
        echo "<script>history.go(-1)</script>";
    } else {
        echo "<script>alert('Tidak ada item yang dipilih.');</script>";
        echo "<script>history.go(-1)</script>";
    }

    // Tutup koneksi database (disediakan dalam koneksi.php)
    mysqli_close($koneksi);
} else {
    // Jika halaman diakses tanpa POST request, redirect atau tampilkan pesan kesalahan
    echo "<script>alert('Metode pengiriman tidak valid.');</script>";
    // echo "<script>history.go(-1)</script>";
}
