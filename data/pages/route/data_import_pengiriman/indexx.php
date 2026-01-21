<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Import File XLSX</title>
</head>
<body>
    <h2>Import Data dari File XLSX</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="file">Pilih File XLSX:</label>
        <input type="file" name="file" id="file" accept=".xlsx">
        <button type="submit" name="submit">Import</button>
    </form>
</body>
</html>

<?php
// function uploadFile() {
//     require 'db_config.php';
//     if (isset($_POST['submit'])) {
//         $file = $_FILES['file']['name'];
//         $ekstensi = explode(".", $file);
//         $file_name = "file-" . round(microtime(true)) . "." . end($ekstensi);
//         $sumber = $_FILES['file']['tmp_name'];
//         $target_dir = "uploads/";
//         $target_file = $target_dir . $file_name;
//         $upload = move_uploaded_file($sumber, $target_file);

//         require 'phpExcel/Classes/PHPExcel.php'; // Include PHPExcel Autoloader
//         $obj = PHPExcel_IOFactory::load($target_file);
//         $all_data = $obj->getActiveSheet()->toArray(null, true, true, true);

//         $sql ="INSERT INTO testing (id, nama, alamat, umur) VALUES";
//         for ($i=1; $i <= count($all_data) ; $i++){
//             $id = $i;
//             $nama = $all_data[$i]['A'];
//             $alamat = $all_data[$i]['B'];
//             $umur = (int)$all_data[$i]['C']; // Convert umur to integer

//             $sql .= "('$id', '$nama', '$alamat', '$umur'),";
//         }
//         $sql = substr($sql, 0, -1);
//         mysqli_query($mysqli, $sql) or die (mysqli_error($mysqli));
//         unlink($target_file);

//     }
// }
// uploadFile();
?>
