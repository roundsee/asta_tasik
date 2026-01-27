<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $kode_mutasi_bs = $_POST['kode_mutasi_bs'];
    $kd_cus         = $_POST['kd_cus'];
    $tanggal        = $_POST['tanggal'];
    $keterangan     = $_POST['keterangan'];

    // 1️⃣ INSERT MASTER
    $sql = "INSERT INTO mutasi_bs 
            (kode_mutasi_bs, kd_cus, tanggal, status, keterangan)
            VALUES (?, ?, ?, 1, ?)";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssss",
        $kode_mutasi_bs,
        $kd_cus,
        $tanggal,
        $keterangan
    );
    mysqli_stmt_execute($stmt);

    $id_mutasi_bs = mysqli_insert_id($conn);

    // 2️⃣ INSERT DETAIL
    if (!empty($_POST['kd_brg'])) {
        foreach ($_POST['kd_brg'] as $i => $kd_brg) {

            if ($kd_brg == '') continue;

            $jumlah = $_POST['jumlah'][$i];
            $satuan = $_POST['satuan'][$i];

            $sql = "INSERT INTO mutasi_bs_detail
                    (id_mutasi_bs, kd_brg, jumlah, satuan)
                    VALUES (?, ?, ?, ?)";

            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "isss",
                $id_mutasi_bs,
                $kd_brg,
                $jumlah,
                $satuan
            );
            mysqli_stmt_execute($stmt);
        }
    }

    echo "<script>alert('Data berhasil disimpan');location.href='mutasi_bs_add.php';</script>";
}
?>
