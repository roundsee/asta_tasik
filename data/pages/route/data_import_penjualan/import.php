
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
        $qt_jual = isset($data['D']) ? mysqli_real_escape_string($koneksi, $data['D']) : '';
        $nilai_jual = isset($data['E']) ? mysqli_real_escape_string($koneksi, $data['E']) : '';

        if (empty($kd_brg)) {
            continue; // Skip if kd_sage is empty
        }

        $nilai_jual = is_numeric($nilai_jual) ? $nilai_jual : 0;
        $qt_jual = is_numeric($qt_jual) ? $qt_jual : 0;

        // Insert atau update kd_sage yang diinputkan ke mutasi_semua untuk qty_jual
        $query_check = "SELECT * FROM mutasi_stok WHERE tgl = '$tgl' AND kd_cus = '$kd_cus' AND kd_brg = '$kd_brg'";
        $result_check = mysqli_query($koneksi, $query_check);

        if (mysqli_num_rows($result_check) > 0) {
            // Update jika data sudah ada
            $query_update = "UPDATE mutasi_stok SET 
                    qt_jual = qt_jual + $qt_jual ,
                    nilai_jual = nilai_jual + $nilai_jual,
                    hpp_jual = qt_jual * harga_rata,
                    qt_akhir = qt_akhir - $qt_jual,
                    nilai_akhir = IF(qt_akhir = 0,0, qt_akhir * harga_rata)
                   WHERE tgl = '$tgl' AND kd_cus = '$kd_cus' AND kd_brg = '$kd_brg'";
            // echo "<pre>";
            // echo $query_update;
            // echo $f14;
            // echo "</pre>";

            $resut_update = mysqli_query($koneksi, $query_update);
            if (!$resut_update) {
                die("Query update ke mutasi_semua gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
            }
        } else {

            // Query untuk mendapatkan nilai awal, qty awal, nilai beli sebelumnya, dan qty beli sebelumnya dari tanggal terbaru
            $query_awal = "SELECT
                tgl AS tgl_terakhir, 
                nilai_akhir AS nilai_awalakhir,
                qt_akhir AS qty_awalakhir,
                stok_opname, nilai_opname       
                FROM mutasi_stok 
                WHERE kd_cus = '$kd_cus' AND kd_brg = '$kd_brg' 
                ORDER BY 
                tgl_terakhir DESC 
                LIMIT 1";

            $result_awal = mysqli_query($koneksi, $query_awal);

            if (!$result_awal) {
                die("Query untuk mendapatkan nilai awal, qty awal, nilai beli sebelumnya, dan qty beli sebelumnya gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
            }

            if (mysqli_num_rows($result_awal) > 0) {
                $row_awal = mysqli_fetch_assoc($result_awal);
                $nilai_awal = $row_awal['nilai_awalakhir'];
                $qty_awal = $row_awal['qty_awalakhir'];
                $stok_opname = $row_awal['stok_opname'];
                $nilai_opname = $row_awal['nilai_opname'];
            } else {
                $nilai_awal = 0;
                $qty_awal = 0;
                $stok_opname = 0;
                $nilai_opname = 0;
            }



            // Tentukan nilai qty_awal
            $qty_awal = $stok_opname != 0 ? $stok_opname : $qty_awal;
            $nilai_awal = $nilai_opname != 0 ? $nilai_opname : $nilai_awal;
            $nilai_awal = is_numeric($nilai_awal) ? $nilai_awal : 0;
            $qty_awal = is_numeric($qty_awal) ? $qty_awal : 0;
            if ($qty_awal != 0) {
                $harga_rata_sebelumnya = $nilai_awal / $qty_awal;
            } else {
                $harga_rata_sebelumnya = 0;
            }
            // Insert data baru
            $query_insert = "INSERT INTO mutasi_stok 
                    (tgl, qty_awal, nilai_awal, qt_tersedia, nilai_tersedia,  
                    harga_rata , kd_cus, kd_brg, satuan,
                    qt_jual, nilai_jual,hpp_jual,
                    qt_akhir, nilai_akhir) VALUES (
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
