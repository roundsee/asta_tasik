<?php
$dir = "../../../../";
$judulform = "Biaya";

$data = 'data_biaya';
$tujuan = 'biaya';
$aksi = 'aksi_biaya';
$view = 'beli_view';

$rute_detail = 'beli_detail';

$tabel = 'biaya';

$f1 = 'no_account';
$f2 = 'nomor_bukti';
$f3 = 'tanggal';
$f4 = 'nama_biaya';
$f5 = 'keterangan';
$f6 = 'jumlah';

session_start();
if (empty($_SESSION['username']) && empty($_SESSION['passuser'])) {
    echo "<link href='style.css' rel='stylesheet' type='text/css'>
    <center>Untuk mengakses modul, Anda harus login <br>";
    echo "<a href=../../index.php><b>LOGIN</b></a></center>";
} else {
    include $dir . "config/koneksi.php";
    include $dir . "config/library.php";

    $route = $_GET['route'];
    $act = $_GET['act'];

    // Handle "input-baru" action
    if ($route == $tujuan && $act == 'input-baru') {
        echo "masuk sini";

        // Get and sanitize form inputs
        $no_account = mysqli_real_escape_string($koneksi, $_POST['no_account']);
        $tanggal = mysqli_real_escape_string($koneksi, $_POST['tanggal']);
        $nama_biaya = mysqli_real_escape_string($koneksi, $_POST['nama_biaya']);
        $keterangan = mysqli_real_escape_string($koneksi, $_POST['keterangan']);
        $jumlah = str_replace(['Rp.', '.', ','], '', $_POST['jumlah']); // Remove formatting

        // Get the month part for nomor_bukti format (by-yyyymmdd-xxxx)
        $monthPart = date('Ymd', strtotime($tanggal));

        // Check the last nomor_bukti with the same month prefix
        $queryLastNomorBukti = "SELECT $f2 FROM $tabel WHERE $f2 LIKE 'BY-$monthPart-%' ORDER BY $f2 DESC LIMIT 1";
        $resultLastNomorBukti = mysqli_query($koneksi, $queryLastNomorBukti);
        $lastNomorBukti = mysqli_fetch_assoc($resultLastNomorBukti)[$f2] ?? null;

        if ($lastNomorBukti) {
            // Extract the last number from the last nomor_bukti
            $lastNumber = (int)substr($lastNomorBukti, -4);
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            // Start from 0001 if no previous nomor_bukti exists for the month
            $newNumber = '0001';
        }

        // Create new nomor_bukti
        $nomor_bukti = "BY-$monthPart-$newNumber";

        // Insert the data into the `biaya` table, including the generated nomor_bukti
        $query = "INSERT INTO $tabel ($f2, $f1, $f3, $f4, $f5, $f6) VALUES ('$nomor_bukti', '$no_account', '$tanggal', '$nama_biaya', '$keterangan', '$jumlah')";

        $result = mysqli_query($koneksi, $query);

        // Check if the query was successful
        if ($result) {
            echo "<script>alert('Data berhasil ditambahkan.');history.go(-2);</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan saat menambahkan data: " . mysqli_error($koneksi) . "'); history.go(-1);</script>";
        }
    }


    // Handle "hapus" action
    elseif ($route == $tujuan && $act == 'hapus') {


        $result =   mysqli_query($koneksi, "DELETE from biaya where $f2 = '$_GET[id]'");


        if ($result) {
            echo "<script>alert('Data berhasil dihapus.'); history.go(-1);</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan saat menghapus data.'); history.go(-1);</script>";
        }
    }
    // Handle "edit" action
    elseif ($route == $tujuan && $act == 'edit') {
        // Ambil data dari form dan lakukan sanitasi
        $no_account = mysqli_real_escape_string($koneksi, $_POST['no_account']);
        $nomor_bukti = mysqli_real_escape_string($koneksi, $_POST['nomor_bukti']);
        $tanggal = mysqli_real_escape_string($koneksi, $_POST['tanggal']);
        $nama_biaya = mysqli_real_escape_string($koneksi, $_POST['nama_biaya']);
        $keterangan = mysqli_real_escape_string($koneksi, $_POST['keterangan']);
        $jumlah = str_replace(['Rp.', '.', ','], '', $_POST['jumlah']); // Hilangkan format Rupiah

        // Query untuk update data
        $query = "UPDATE $tabel SET 
                  $f1 = '$no_account', 
                  $f3 = '$tanggal', 
                  $f4 = '$nama_biaya', 
                  $f5 = '$keterangan', 
                  $f6 = '$jumlah' 
                WHERE $f2 = '$nomor_bukti'";
        // Eksekusi query dan cek hasilnya
        if (mysqli_query($koneksi, $query)) {
            echo "<script>alert('Data berhasil diubah.');history.go(-1)</script>";
        } else {
            // Jika terjadi kesalahan, tampilkan pesan error dari MySQL
            $error_message = mysqli_error($koneksi);
            echo "<script>alert('Terjadi kesalahan saat mengubah data: $error_message'); history.go(-1);</script>";
        }
    }
}
