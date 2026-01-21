<?php
include "../../../../config/koneksi.php";
header('Content-Type: application/json');
$action = isset($_GET['action']) ? $_GET['action'] : '';
$data = [];

if ($action == 'get') {
    $id_kategoriNilai = isset($_GET['kode']) ? $_GET['kode'] : '';

    $sql = "SELECT * FROM `kategori_nilai` WHERE id_kategoriNilai= ?;";
    $stmt = mysqli_prepare($koneksi, $sql);
    mysqli_stmt_bind_param($stmt, 's', $id_kategoriNilai);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) > 0) {
        $kategori = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $data['id_kategoriNilai'] = $kategori['id_kategoriNilai'];
        $data['data'] = $kategori;
        $data['status'] = true;
    } else {
        $data['status'] = false;
    }
} elseif ($action == 'save') {
    try {
        $stmt = mysqli_prepare($koneksi, "INSERT INTO `kategori_nilai`(`id_kategoriNilai`, `nilai1`, `nilai2`, `nilai3`, `nilai4`, `nilai5`) VALUES (?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, 'ssssss', $_POST['id_kategoriNilai'], $_POST['nilai1'], $_POST['nilai2'], $_POST['nilai3'], $_POST['nilai4'], $_POST['nilai5']);
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
        $stmt = mysqli_prepare($koneksi, "UPDATE `kategori_nilai` SET `nilai1` = ?, `nilai2` = ?, `nilai3` = ?, `nilai4` = ?, `nilai5` = ? WHERE `id_kategoriNilai` = ?");
        mysqli_stmt_bind_param($stmt, 'ssssss', $_POST['nilai1'], $_POST['nilai2'], $_POST['nilai3'], $_POST['nilai4'], $_POST['nilai5'], $_POST['id_kategoriNilai']);
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
        $stmt = mysqli_prepare($koneksi, "DELETE FROM `kategori_nilai` WHERE id_kategoriNilai = ?;");
        mysqli_stmt_bind_param($stmt, 's', $_POST['id_kategoriNilai']);
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
        $sql = "SELECT * FROM `kategori_nilai` LIMIT 100;";
    } else {
        $sql = "SELECT * FROM `kategori_nilai` WHERE id_kategoriNilai LIKE '{$search}' LIMIT 100;";
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
