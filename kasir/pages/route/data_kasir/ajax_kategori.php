<?php
include "../../../../config/koneksi.php";
header('Content-Type: application/json');
$action = isset($_GET['action']) ? $_GET['action'] : '';
$data = [];

if ($action == 'get') {
    $id_kat = isset($_GET['kode']) ? $_GET['kode'] : '';

    $sql = "SELECT * FROM `kategori` WHERE id_kat= ?;";
    $stmt = mysqli_prepare($koneksi, $sql);
    mysqli_stmt_bind_param($stmt, 's', $id_kat);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) > 0) {
        $kategori = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $data['id_kat'] = $kategori['id_kat'];
        $data['data'] = $kategori;
        $data['status'] = true;
    } else {
        $data['status'] = false;
    }
} elseif ($action == 'save') {
    try {
        $stmt = mysqli_prepare($koneksi, "INSERT INTO `kategori`(`id_kat`, `Retail`, `Grosir`, `Online`, `MR`, `MG`) VALUES (?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, 'ssssss', $_POST['id_kat'], $_POST['Retail'], $_POST['Grosir'], $_POST['Online'], $_POST['MR'], $_POST['MG']);
        if (mysqli_stmt_execute($stmt)) {
            $data['status'] = true;
        } else {
            $data['status'] = false;
            $data['error'] = mysqli_error($koneksi);
        }
    } catch (Throwable $th) {
        $data['status'] = false;
        $data['error'] = $th->getMessage();
    }
} elseif ($action == 'update') {
    try {
        $stmt = mysqli_prepare($koneksi, "UPDATE `kategori` SET `Retail` = ?, `Grosir` = ?, `Online` = ?, `MR` = ?, `MG` = ? WHERE `id_kat` = ?");
        mysqli_stmt_bind_param($stmt, 'ssssss', $_POST['Retail'], $_POST['Grosir'], $_POST['Online'], $_POST['MR'], $_POST['MG'], $_POST['id_kat']);
        if (mysqli_stmt_execute($stmt)) {
            $data['status'] = true;
        } else {
            $data['status'] = false;
            $data['error'] = mysqli_error($koneksi);
        }
    } catch (Throwable $th) {
        $data['status'] = false;
        $data['error'] = $th->getMessage();
    }
} elseif ($action == 'delete') {
    try {
        $stmt = mysqli_prepare($koneksi, "DELETE FROM `kategori` WHERE id_kat = ?;");
        mysqli_stmt_bind_param($stmt, 's', $_POST['id_kat']);
        if (mysqli_stmt_execute($stmt)) {
            $data['status'] = true;
        } else {
            $data['status'] = false;
            $data['error'] = mysqli_error($koneksi);
        }
    } catch (Throwable $th) {
        $data['status'] = false;
        $data['error'] = $th->getMessage();
    }
} elseif ($action == 'getall') {
    $search = empty($_GET['search']) ? '' : '%' . $_GET['search'] . '%';
    if (empty($search)) {
        $sql = "SELECT * FROM `kategori` LIMIT 100;";
    } else {
        $sql = "SELECT * FROM `kategori` WHERE id_kat LIKE '{$search}' LIMIT 100;";
    }
    $result = mysqli_query($koneksi, $sql);
    if (mysqli_num_rows($result) > 0) {
        $data['data'] = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $data['status'] = true;
    } else {
        $data['status'] = false;
    }
}

echo json_encode($data);
