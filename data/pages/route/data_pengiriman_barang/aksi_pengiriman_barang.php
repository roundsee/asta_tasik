<?php
include '../../../../config/koneksi.php';
session_start();
$employee = $_SESSION['employee_number'];

if (isset($_POST['kode_permintaan'])) {
    $kode_permintaan = $_POST['kode_permintaan'];
    $kd_barang = $_POST['kd_barang']; // Array barang yang dikirim
    $tanggal = $_POST['tanggal'];
    $qty_kirim = $_POST['qty_kirim']; // Array jumlah yang dikirim
    $qty_satuanArray = $_POST['qty_satuan']; // Array jumlah diterima
    $satuanArray = $_POST['satuan'];
    $status_barang = $_POST['status_barang'];
    $kd_cus_pengirim = $_POST['kd_cus_pengirim']; // Pastikan ini sudah ada dalam session atau POST

    // Mengubah status_barang
    if ($status_barang == "Selesai") {
        $status_barang = 1;
    } else {
        $status_barang = 0;
    }
    $tanggal = date("Ymd");

    // Periksa apakah sudah ada kode_pengiriman untuk kode_permintaan ini
    $query_check = mysqli_query($koneksi, "
        SELECT kode_pengiriman 
        FROM pengiriman_barang_internal 
        WHERE kode_permintaan = '$kode_permintaan' AND kd_cus_pengirim = '$kd_cus_pengirim'
    ");
    $data_check = mysqli_fetch_array($query_check);

    if ($data_check) {
        // Jika sudah ada kode_pengiriman untuk kode_permintaan ini, gunakan kode yang sudah ada
        $kode_pengiriman = $data_check['kode_pengiriman'];
    } else {
        // Jika belum ada, buat kode pengiriman baru
        $query = mysqli_query($koneksi, "
            SELECT MAX(CAST(SUBSTRING_INDEX(kode_pengiriman, '-', -1) AS UNSIGNED)) AS kodeTerbesar 
            FROM pengiriman_barang_internal 
            WHERE kode_pengiriman LIKE 'DEL-$tanggal-$kd_cus_pengirim-%'
        ");
        $data = mysqli_fetch_array($query);

        // Jika ada data, ambil nomor urutan terakhir, jika tidak, mulai dari 0
        $urutan = isset($data['kodeTerbesar']) ? (int) $data['kodeTerbesar'] : 0;
        $urutan++;

        // Buat kode pengiriman baru
        $kodeUrut = sprintf("%04s", $urutan);
        $kode_pengiriman = "DEL-$tanggal-$kd_cus_pengirim-$kodeUrut";

        // Query untuk insert pengiriman_barang_internal
        $query_insert_pengiriman_barang_internal = "
            INSERT INTO pengiriman_barang_internal (kode_pengiriman, kode_permintaan, kd_cus_pengirim) 
            VALUES ('$kode_pengiriman', '$kode_permintaan', '$kd_cus_pengirim')
        ";
        $sql_insert = mysqli_query($koneksi, $query_insert_pengiriman_barang_internal);
    }

    // Ambil urutan maksimum di luar loop
    $query = mysqli_query($koneksi, "SELECT max(urut) as urut_max FROM pengiriman_barang_detail_internal WHERE kode_pengiriman='$kode_pengiriman'");
    $data = mysqli_fetch_array($query);
    $urut = isset($data['urut_max']) ? (int)$data['urut_max'] : 0;

    // Flag untuk memeriksa apakah ada barang yang dikirim
    $barang_dikirim = false;

    // Loop untuk setiap barang yang dikirim
    $peringatan = [];
    foreach ($kd_barang as $index => $kode_barang) {
        $urut++;
        $qty = (int)$qty_kirim[$index];
        $qty_satuan = (int)$qty_satuanArray[$index];
        $satuan = $satuanArray[$index];

        if ($qty > 0) {
            // Cek stok di tabel inventory
            // $query_check_stok = "
            //     SELECT stok 
            //     FROM inventory 
            //     WHERE kd_cus = '$kd_cus_pengirim' AND kd_brg = '$kode_barang'
            // ";
            // $result_check_stok = mysqli_query($koneksi, $query_check_stok);
            // $data_stok = mysqli_fetch_assoc($result_check_stok);

            // $stok = isset($data_stok['stok']) ? (int)$data_stok['stok'] : 0;
            // $qty_total = $qty * $qty_satuan;

            // Insert ke pengiriman_barang_detail_internal
            $query_insert_pengiriman_barang_detail_internal = "
             INSERT INTO pengiriman_barang_detail_internal (kode_pengiriman, kd_cus_pengirim, tanggal_pengiriman, kd_barang, qty_dikirim, satuan, urut,user_kirim) 
             VALUES ('$kode_pengiriman', '$kd_cus_pengirim', '$tanggal', '$kode_barang', '$qty', '$satuan', '$urut', '$employee' )
            ";
            mysqli_query($koneksi, $query_insert_pengiriman_barang_detail_internal);

            // Update qty_terkirim di permintaan_barang_detail
            $query_update_qty_terkirim_permintaan_barang_detail = "
                UPDATE permintaan_barang_detail 
                SET qty_terkirim = qty_terkirim + $qty
                WHERE kode_permintaan = '$kode_permintaan' AND kd_barang = '$kode_barang' AND satuan = '$satuan'
            ";
            mysqli_query($koneksi, $query_update_qty_terkirim_permintaan_barang_detail);

            // Set flag bahwa barang berhasil dikirim
            $barang_dikirim = true;

            // if ($stok >= $qty_total) {
            //     // Insert ke pengiriman_barang_detail_internal
            //     $query_insert_pengiriman_barang_detail_internal = "
            //         INSERT INTO pengiriman_barang_detail_internal (kode_pengiriman, kd_cus_pengirim, tanggal_pengiriman, kd_barang, qty_dikirim, satuan, urut,user_kirim) 
            //         VALUES ('$kode_pengiriman', '$kd_cus_pengirim', '$tanggal', '$kode_barang', '$qty', '$satuan', '$urut', '$employee' )
            //     ";
            //     mysqli_query($koneksi, $query_insert_pengiriman_barang_detail_internal);

            //     // Update qty_terkirim di permintaan_barang_detail
            //     $query_update_qty_terkirim_permintaan_barang_detail = "
            //         UPDATE permintaan_barang_detail 
            //         SET qty_terkirim = qty_terkirim + $qty
            //         WHERE kode_permintaan = '$kode_permintaan' AND kd_barang = '$kode_barang' AND satuan = '$satuan'
            //     ";
            //     mysqli_query($koneksi, $query_update_qty_terkirim_permintaan_barang_detail);

            //     // Set flag bahwa barang berhasil dikirim
            //     $barang_dikirim = true;
            // } else {
            //     // Stok tidak cukup, tambahkan ke peringatan
            //     $peringatan[] = "Stok tidak mencukupi untuk barang: $kode_barang ";
            //     // $peringatan[] = "Stok tidak mencukupi untuk barang: $kode_barang (Stok tersedia: $stok, Qty diminta: $qty_total)";
            // }
        }
    }

    // Tampilkan peringatan jika ada
    if (!empty($peringatan)) {
        echo "<script>alert('" . implode("\\n", $peringatan) . "');</script>";
    }

    if ($barang_dikirim) {
        // Jika ada barang yang berhasil dikirim, update status permintaan_barang
        $query_update_qty_terkirim_permintaan_barang_detail = "
            UPDATE permintaan_barang
            SET status_permintaan = 1
            WHERE kode_permintaan = '$kode_permintaan'
        ";
        $sql2 = mysqli_query($koneksi, $query_update_qty_terkirim_permintaan_barang_detail);
        if (!$sql2) {
            die("Error: " . mysqli_error($koneksi)); // Debug jika update gagal
        }
        echo "<script>alert('Data berhasil disimpan.'); history.go(-1);</script>";
    } else {
        // Jika tidak ada barang yang dikirim, beri peringatan
        // echo "kesini gak sih";
        echo "<script>alert('Tidak ada barang yang dapat dikirim.'); history.go(-1);</script>";
    }
}
