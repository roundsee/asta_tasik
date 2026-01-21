<?php
include "../../../../config/koneksi.php";
header('Content-Type: application/json');
$action = isset($_GET['action']) ? $_GET['action'] : '';
$data = [];
if ($action == 'get') {
    $kode_member = isset($_GET['kode']) ? $_GET['kode'] : '';

    $sql = "SELECT * FROM `member` WHERE kd_member= ?;";
    $stmt = mysqli_prepare($koneksi, $sql);
    mysqli_stmt_bind_param($stmt, 's', $kode_member);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) > 0) {
        $member = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $data['nama'] = $member['nama'];
        $data['member_ket'] = $member['member_ket'];

        $data['data'] = $member;
        $data['status'] = true;
    } else {
        $data['status'] = false;
    }
} elseif ($action == 'save') {
    try {
        $stmt = mysqli_prepare($koneksi, "INSERT INTO `member`(`kd_member`, `telp`, `nama`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `provinsi`, `member_ket`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, 'sssssssss', $_POST['kode_member'], $_POST['telepon'], $_POST['nama'], $_POST['alamat'], $_POST['kelurahan'], $_POST['kecamatan'], $_POST['kabupaten'], $_POST['provinsi'], $_POST['member_ket']);
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
        $stmt = mysqli_prepare($koneksi, "UPDATE `member` SET `telp` = ?, `nama` = ?, `alamat` = ?, `kelurahan` = ?, `kecamatan` = ?, `kabupaten` = ?, `provinsi` = ?, `kd_member` = ? , `member_ket` = ? WHERE `id` = ?");
        mysqli_stmt_bind_param($stmt, 'sssssssssi', $_POST['telepon'], $_POST['nama'], $_POST['alamat'], $_POST['kelurahan'], $_POST['kecamatan'], $_POST['kabupaten'], $_POST['provinsi'], $_POST['kode_member'], $_POST['member_ket'], $_POST['id']);
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
        $stmt = mysqli_prepare($koneksi, "DELETE FROM `member` WHERE kd_member = ?;");
        mysqli_stmt_bind_param($stmt, 's', $_POST['kode_member']);
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
        $sql = "SELECT * FROM `member` JOIN kategori ON member.member_ket = kategori.id_kat LIMIT 100;";
    } else {
        $sql = "SELECT * FROM `member` JOIN kategori ON member.member_ket = kategori.id_kat WHERE kd_member LIKE '{$search}' OR nama LIKE '{$search}' LIMIT 100;";
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
