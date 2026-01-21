<?php
$dir = "../../../../";
session_start();



//$tabel_sebelum="subalat_bayar";

$judulform = "Penjualan Retur";

$data = 'data_penjualan_retur';
$aksi = 'aksi_penjualan_2_retur';
$tujuan = 'penjualan_retur';

$tabel = 'retur_penjualan';
$f1 = 'tanggal_retur';
$f2 = 'kd_retur';
$f3 = 'faktur';
$f4 = 'kd_brg';
$f5 = 'harga';
$f6 = 'banyak';
$f7 = 'satuan';
$f8 = 'subtotal';
$f9 = 'total_retur';
$f10 = 'login_hash';


$j1 = 'Tanggal Retur';
$j2 = 'Kode Retur';
$j3 = 'Faktur';
$j4 = 'Kode Barang';
$j5 = 'Harga';
$j6 = 'Banyak';
$j7 = 'satuan';
$j8 = 'subtotal';
$j9 = 'Total Retur';
$j10 = 'Login Hash';

if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
    echo "<link href='style.css' rel='stylesheet' type='text/css'>
	<center>Untuk mengakses modul, Anda harus login <br>";
    echo "<a href=../../index.php><b>LOGIN</b></a></center>";
} else {
    include $dir . "config/koneksi.php";

    $route = $_GET['route'];
    $act = $_GET['act'];
    // var_dump($_GET);

    //Hapus area
    if ($route == $tujuan and $act == 'hapus-detail') {
        // Ambil data yang akan dihapus sebelum menghapusnya
        $query_get_retur = "SELECT * FROM $tabel WHERE faktur = '$_GET[id]' AND kd_brg='$_GET[id2]' AND kd_retur='$_GET[id3]' AND kd_cus='$_GET[id4]'";
        $result_get_retur = mysqli_query($koneksi, $query_get_retur);

        if ($row = mysqli_fetch_assoc($result_get_retur)) {
            $faktur = $row['faktur'];
            $kd_cus = $row['kd_cus'];
            $kd_brg = $row['kd_brg'];
            $jumlah_retur = $row['total_retur']; // Jumlah retur yang akan dikembalikan

            // **1. Kembalikan jumlah ke tabel `jualdetil`**
            $query_update_jualdetil = "UPDATE jualdetil 
                                       SET banyak = banyak + '$jumlah_retur'
                                       WHERE faktur = '$faktur' 
                                       AND kd_cus = '$kd_cus' 
                                       AND kd_brg = '$kd_brg'";
            mysqli_query($koneksi, $query_update_jualdetil);

            // **2. Kembalikan ke tabel `inventory`**
            $query_update_inventory = "UPDATE inventory 
                                       SET stok = stok - '$jumlah_retur'
                                       WHERE kd_brg = '$kd_brg' 
                                       AND kd_cus = '$kd_cus'";
            mysqli_query($koneksi, $query_update_inventory);

            // **3. Ambil harga per barang dari `jualdetil`**
            $query_get_harga = "SELECT harga FROM jualdetil 
                                WHERE faktur = '$faktur' 
                                AND kd_cus = '$kd_cus' 
                                AND kd_brg = '$kd_brg'";
            $result_get_harga = mysqli_query($koneksi, $query_get_harga);
            $row_harga = mysqli_fetch_assoc($result_get_harga);
            $harga_per_barang = $row_harga['harga'];

            // **4. Ambil jumlah terbaru setelah update `banyak`**
            $query_get_banyak = "SELECT banyak FROM jualdetil 
                                 WHERE faktur = '$faktur' 
                                 AND kd_cus = '$kd_cus' 
                                 AND kd_brg = '$kd_brg'";
            $result_get_banyak = mysqli_query($koneksi, $query_get_banyak);
            $row_banyak = mysqli_fetch_assoc($result_get_banyak);
            $banyak_baru = $row_banyak['banyak']; // Jumlah terbaru setelah retur dikembalikan

            // **5. Hitung total harga baru**
            $harga_update = $banyak_baru * $harga_per_barang;

            // **6. Update harga total di `jualdetil`**
            $query_update_harga = "UPDATE jualdetil 
                                   SET jumlah = '$harga_update' 
                                   WHERE faktur = '$faktur' 
                                   AND kd_cus = '$kd_cus' 
                                   AND kd_brg = '$kd_brg'";
            mysqli_query($koneksi, $query_update_harga);

            // **7. Hapus data retur setelah update berhasil**
            $query_delete = "DELETE FROM $tabel WHERE faktur = '$_GET[id]' AND kd_brg='$_GET[id2]' AND kd_retur='$_GET[id3]' AND kd_cus='$_GET[id4]'";
            mysqli_query($koneksi, $query_delete);

            echo "<script>alert('Data berhasil dihapus dan stok dikembalikan');</script>";
            echo "<script>history.go(-1)</script>";
        } else {
            echo "<script>alert('Data tidak ditemukan!');</script>";
            echo "<script>history.go(-1)</script>";
        }
    } elseif ($route == $tujuan and $act == 'edit-detail') {
        // Ambil data retur lama sebelum diubah
        $query_get_retur = "SELECT * FROM $tabel 
                            WHERE faktur = '$_GET[id]' 
                            AND kd_brg = '$_GET[id2]' 
                            AND kd_retur = '$_GET[id3]' 
                            AND kd_cus = '$_GET[id4]'";
        $result_get_retur = mysqli_query($koneksi, $query_get_retur);

        if ($row = mysqli_fetch_assoc($result_get_retur)) {
            $faktur = $row['faktur'];
            $kd_cus = $row['kd_cus'];
            $kd_brg = $row['kd_brg'];
            $jumlah_retur_lama = $row['total_retur']; // Jumlah retur sebelum diedit
            $jumlah_retur_baru = $_POST['total_retur']; // Jumlah retur baru dari form

            // Hitung selisih jumlah retur
            $selisih = $jumlah_retur_baru - $jumlah_retur_lama;

            // **1. Update jumlah di `jualdetil` sesuai selisih retur**
            $query_update_jualdetil = "UPDATE jualdetil 
                                       SET banyak = banyak - '$selisih'
                                       WHERE faktur = '$faktur' 
                                       AND kd_cus = '$kd_cus' 
                                       AND kd_brg = '$kd_brg'";
            mysqli_query($koneksi, $query_update_jualdetil);

            // **2. Update stok di `inventory` sesuai selisih retur**
            $query_update_inventory = "UPDATE inventory 
                                       SET stok = stok + '$selisih'
                                       WHERE kd_brg = '$kd_brg' 
                                       AND kd_cus = '$kd_cus'";
            mysqli_query($koneksi, $query_update_inventory);

            // **3. Ambil harga per barang dari `jualdetil`**
            $query_get_harga = "SELECT harga FROM jualdetil 
                                WHERE faktur = '$faktur' 
                                AND kd_cus = '$kd_cus' 
                                AND kd_brg = '$kd_brg'";
            $result_get_harga = mysqli_query($koneksi, $query_get_harga);
            $row_harga = mysqli_fetch_assoc($result_get_harga);
            $harga_per_barang = $row_harga['harga'];

            // **4. Ambil jumlah terbaru setelah update `banyak`**
            $query_get_banyak = "SELECT banyak FROM jualdetil 
                                 WHERE faktur = '$faktur' 
                                 AND kd_cus = '$kd_cus' 
                                 AND kd_brg = '$kd_brg'";
            $result_get_banyak = mysqli_query($koneksi, $query_get_banyak);
            $row_banyak = mysqli_fetch_assoc($result_get_banyak);
            $banyak_baru = $row_banyak['banyak']; // Jumlah terbaru setelah retur diedit

            // **5. Hitung total harga baru**
            $harga_update = $banyak_baru * $harga_per_barang;

            // **6. Update harga total di `jualdetil`**
            $query_update_harga = "UPDATE jualdetil 
                                   SET jumlah = '$harga_update' 
                                   WHERE faktur = '$faktur' 
                                   AND kd_cus = '$kd_cus' 
                                   AND kd_brg = '$kd_brg'";
            mysqli_query($koneksi, $query_update_harga);

            // **7. Update jumlah retur di tabel retur**
            $query_update_retur = "UPDATE $tabel 
                                   SET total_retur = '$jumlah_retur_baru' 
                                   WHERE faktur = '$_GET[id]' 
                                   AND kd_brg = '$_GET[id2]' 
                                   AND kd_retur = '$_GET[id3]' 
                                   AND kd_cus = '$_GET[id4]'";
            mysqli_query($koneksi, $query_update_retur);

            echo "<script>alert('Data retur berhasil diperbarui');</script>";
            echo "<script>history.go(-1)</script>";
        } else {
            echo "<script>alert('Data tidak ditemukan!');</script>";
            echo "<script>history.go(-1)</script>";
        }
    }
}
