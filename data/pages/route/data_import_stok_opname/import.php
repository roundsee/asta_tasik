
<?php
$dir = "../../../../";
include $dir . "config/koneksi.php";

if (isset($_POST['submit'])) {
    $file = $_FILES['file']['name'];
    $ekstensi = explode(".", $file);
    $file_name = "file-" . round(microtime(true)) . "." . end($ekstensi);
    $sumber = $_FILES['file']['tmp_name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . $file_name;

    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0775, true);
    }

    $upload = move_uploaded_file($sumber, $target_file);

    if (!$upload) {
        die("Failed to upload file. Please check the directory permissions.");
    }

    require 'phpExcel/Classes/PHPExcel.php'; // Include PHPExcel Autoloader
    $obj = PHPExcel_IOFactory::load($target_file);
    $all_data = $obj->getActiveSheet()->toArray(null, true, true, true);

    foreach ($all_data as $index => $data) {
        // Skip the header row if present
        if ($index == 1) continue;

        $tgl = isset($data['A']) ? mysqli_real_escape_string($koneksi, $data['A']) : '';
        $kd_cus = isset($data['B']) ? mysqli_real_escape_string($koneksi, $data['B']) : '';
        $kd_brg = isset($data['C']) ? mysqli_real_escape_string($koneksi, $data['C']) : '';
        $qty_opname = isset($data['D']) ? mysqli_real_escape_string($koneksi, $data['D']) : '';
        $nilai_opname = isset($data['E']) ? mysqli_real_escape_string($koneksi, $data['E']) : '';

        if (empty($kd_brg)) {
            continue; 
        }

        $nilai_opname = is_numeric($nilai_opname) ? $nilai_opname : 0;
        $qty_opname = is_numeric($qty_opname) ? $qty_opname : 0;

        // Insert atau update kd_sage yang diinputkan ke mutasi_semua untuk qty_jual
        $query_check = "SELECT * FROM mutasi_stok WHERE tgl = '$tgl' AND kd_cus = '$kd_cus' AND kd_brg = '$kd_brg'";
        $result_check = mysqli_query($koneksi, $query_check);

        if (mysqli_num_rows($result_check) > 0) {
            // Update jika data sudah ada
            $query_update = "UPDATE mutasi_stok SET 
                    stok_opname = $qty_opname,
                    nilai_opname =  $nilai_opname
                   WHERE tgl = '$tgl' AND kd_cus = '$kd_cus' AND kd_brg = '$kd_brg'";
     

            $resut_update = mysqli_query($koneksi, $query_update);
            if (!$resut_update) {
                die("Query update ke mutasi_semua gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
            }
        } else {

            // Insert data baru
            $query_insert = "INSERT INTO mutasi_stok 
                    (tgl, kd_cus, kd_brg, satuan,stok_opname,
                    nilai_opname) VALUES (
                        '$tgl',
                        '$qty_awal',
                        '$nilai_awal',
                        '$qty_awal',
                        '$nilai_awal',
                        '$harga_rata_sebelumnya',
                        '$kd_cus',
                        '$kd_brg',
                        'Pcs',
                        '$qt_jual',
                        '$nilai_jual',
                        '$harga_rata_sebelumnya' * '$qt_jual',
                        '$qty_awal' - '$qt_jual',
                        '$harga_rata_sebelumnya' * ( '$qty_awal' - '$qt_jual' )
                    )";

            // echo "<pre>";
            // echo $query_insert;
            // echo "</pre>";

            $result_insert = mysqli_query($koneksi, $query_insert);
            if (!$result_insert) {
                die("Query insert ke mutasi_semua gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
            }
        }
    }

    unlink($target_file);
    echo "<script>alert('Data berhasil di Input.');</script>";
    echo "<script>history.go(-1);</script>";
}

?>
