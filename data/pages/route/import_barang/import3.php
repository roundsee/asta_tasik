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
    $upload = move_uploaded_file($sumber, $target_file);


    if ($upload) {
        require 'phpExcel/Classes/PHPExcel.php';
        $obj = PHPExcel_IOFactory::load($target_file);
        $all_data = $obj->getActiveSheet()->toArray(null, true, true, true);

        $batch_size = 1000;
        $chunked_data = array_chunk($all_data, $batch_size, true);
        function roundUpTo100($value)
        {
            return ceil($value / 100) * 100;
        }
        foreach ($chunked_data as $chunk_index => $data_chunk) {
            $start_row = ($chunk_index * $batch_size) + 1; // Starting row for this batch
            $end_row = $start_row + $batch_size - 1;       // Ending row for this batch

            mysqli_begin_transaction($koneksi); // Start transaction for each batch

            try {
                foreach ($data_chunk as $index => $data) {
                    if ($index == 1) continue; // Skip header row

                    $kd_barang = isset($data['A']) ? mysqli_real_escape_string($koneksi, $data['A']) : '';
                    $nama = isset($data['B']) ? mysqli_real_escape_string($koneksi, $data['B']) : '';
                    $harga = isset($data['C']) ? mysqli_real_escape_string($koneksi, $data['C']) : 0;
                    $Satuan1 = isset($data['D']) ? mysqli_real_escape_string($koneksi, $data['D']) : '';
                    $Satuan2 = isset($data['E']) ? mysqli_real_escape_string($koneksi, $data['E']) : '';
                    $Satuan3 = isset($data['F']) ? mysqli_real_escape_string($koneksi, $data['F']) : '';
                    $Satuan4 = isset($data['G']) ? mysqli_real_escape_string($koneksi, $data['G']) : '';
                    $Satuan5 = isset($data['H']) ? mysqli_real_escape_string($koneksi, $data['H']) : '';
                    $qty_satuan1 = isset($data['I']) ? mysqli_real_escape_string($koneksi, $data['I']) : 0;
                    $qty_satuan2 = isset($data['J']) ? mysqli_real_escape_string($koneksi, $data['J']) : 0;
                    $qty_satuan3 = isset($data['K']) ? mysqli_real_escape_string($koneksi, $data['K']) : 0;
                    $qty_satuan4 = isset($data['L']) ? mysqli_real_escape_string($koneksi, $data['L']) : 0;
                    $qty_satuan5 = isset($data['M']) ? mysqli_real_escape_string($koneksi, $data['M']) : 0;
                    $ktg_retail = isset($data['N']) ? mysqli_real_escape_string($koneksi, $data['N']) : '';
                    $ktg_grosir = isset($data['O']) ? mysqli_real_escape_string($koneksi, $data['O']) : '';
                    $ktg_online = isset($data['P']) ? mysqli_real_escape_string($koneksi, $data['P']) : '';
                    $ktg_ms = isset($data['Q']) ? mysqli_real_escape_string($koneksi, $data['Q']) : '';
                    $ktg_mg = isset($data['R']) ? mysqli_real_escape_string($koneksi, $data['R']) : '';
                    $ktg_mp = isset($data['S']) ? mysqli_real_escape_string($koneksi, $data['S']) : '';
                    $ktg_buffer = isset($data['T']) ? mysqli_real_escape_string($koneksi, $data['T']) : '';
                    $Quantity = isset($data['U']) ? mysqli_real_escape_string($koneksi, $data['U']) : 0;
                    $hrg_satuan1 = 0;
                    $hrg_satuan2 = 0;
                    $hrg_satuan3 = 0;
                    $hrg_satuan4 = 0;
                    $hrg_satuan5 = 0;
                    $querysql1 = mysqli_query($koneksi,  "SELECT 
			IFNULL(layer1,0) AS layer11,
			IFNULL(SUBSTRING_INDEX(layer2, '|', 1),0) AS layer21, 
			IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer2, '|', 2), '|', -1),0) AS layer22,
			IFNULL(SUBSTRING_INDEX(layer3, '|', 1),0) AS layer31,  
			IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer3, '|', 2), '|', -1),0) AS layer32,  
			IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer3, '|', 3), '|', -1),0) AS layer33, 
			IFNULL(SUBSTRING_INDEX(layer4, '|', 1),0) AS layer41, 
			IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer4, '|', 2), '|', -1),0) AS layer42, 
			IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer4, '|', 3), '|', -1),0) AS layer43, 
			IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer4, '|', 4), '|', -1),0) AS layer44,  
			IFNULL(SUBSTRING_INDEX(layer5, '|', 1),0) AS layer51,  
			IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 2), '|', -1),0) AS layer52, 
			IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 3), '|', -1),0) AS layer53,  
			IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 4), '|', -1),0) AS layer54,  
			IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 5), '|', -1),0) AS layer55,id_kat,Nama_kategoriNilai
			 FROM kategori_nilai WHERE Nama_kategoriNilai = '$ktg_retail' AND id_kat =  1");

                    while ($s1 = mysqli_fetch_array($querysql1)) {

                        if (!empty($Satuan5)) {
                            $hrg_satuan1 = $harga + ($harga * $s1["layer51"] / 100);
                            $hrg_satuan2 = $harga + ($harga * $s1["layer52"] / 100);
                            $hrg_satuan3 = $harga + ($harga * $s1["layer53"] / 100);
                            $hrg_satuan4 = $harga + ($harga * $s1["layer54"] / 100);
                            $hrg_satuan5 = $harga + ($harga * $s1["layer55"] / 100);
                        } else if (!empty($Satuan4)) {
                            $hrg_satuan1 = $harga + ($harga * $s1["layer41"] / 100);
                            $hrg_satuan2 = $harga + ($harga * $s1["layer42"] / 100);
                            $hrg_satuan3 = $harga + ($harga * $s1["layer43"] / 100);
                            $hrg_satuan4 = $harga + ($harga * $s1["layer44"] / 100);
                        } else if (!empty($Satuan3)) {
                            $hrg_satuan1 = $harga + ($harga * $s1["layer31"] / 100);
                            $hrg_satuan2 = $harga + ($harga * $s1["layer32"] / 100);
                            $hrg_satuan3 = $harga + ($harga * $s1["layer33"] / 100);
                        } else if (!empty($Satuan2)) {
                            $hrg_satuan1 = $harga + ($harga * $s1["layer21"] / 100);
                            $hrg_satuan2 = $harga + ($harga * $s1["layer22"] / 100);
                        } else if (!empty($Satuan1)) {
                            $hrg_satuan1 = $harga + ($harga * $s1["layer11"] / 100);
                        }
                    }

                    $hargaroundup_1 = roundUpTo100($hrg_satuan1);
                    $hargaroundup_2 = roundUpTo100($hrg_satuan2);
                    $hargaroundup_3 = roundUpTo100($hrg_satuan3);
                    $hargaroundup_4 = roundUpTo100($hrg_satuan4);
                    $hargaroundup_5 = roundUpTo100($hrg_satuan5);
                    $check_barang_sql = "SELECT COUNT(*) AS count FROM barang WHERE kd_brg='$kd_barang'";
                    $check_barang_result = mysqli_query($koneksi, $check_barang_sql);
                    $check_barang_data = mysqli_fetch_assoc($check_barang_result);
                    if ($check_barang_data['count'] > 0) {
                        $sql_update_barang = "
                UPDATE barang 
                SET 
                    nama='$nama',
                    satuan='$Satuan1',
                    harga='$harga',
                    Satuan1='$Satuan1',
                    Satuan2='$Satuan2',
                    Satuan3='$Satuan3',
                    Satuan4='$Satuan4',
                    Satuan5='$Satuan5',
                    qty_satuan1='$qty_satuan1',
                    qty_satuan2='$qty_satuan2',
                    qty_satuan3='$qty_satuan3',
                    qty_satuan4='$qty_satuan4',
                    qty_satuan5='$qty_satuan5',
                    ktg_retail='$ktg_retail',
                    ktg_grosir='$ktg_grosir',
                    ktg_online='$ktg_online',
                    ktg_ms='$ktg_ms',
                    ktg_mg='$ktg_mg',
                    ktg_mp='$ktg_mp',
                    ktg_buffer='$ktg_buffer',
                    Quantity='$Quantity',
                    hrg_satuan1 = '$hargaroundup_1',
                    hrg_satuan2 = '$hargaroundup_2', 
                    hrg_satuan3 = '$hargaroundup_3', 
                    hrg_satuan4 = '$hargaroundup_4', 
                    hrg_satuan5 = '$hargaroundup_5'
                    
                WHERE kd_brg='$kd_barang'
            ";
                        mysqli_query($koneksi, $sql_update_barang);
                    } else if (!empty($kd_barang)) {
                        $sql_insert_barang = "
                INSERT INTO barang 
                    (kd_brg, nama, satuan, harga, Satuan1,Satuan2,Satuan3,Satuan4,Satuan5,qty_satuan1,qty_satuan2,qty_satuan3,qty_satuan4,qty_satuan5,ktg_retail,ktg_online,ktg_ms,ktg_mg,ktg_mp,hrg_satuan1,hrg_satuan2,hrg_satuan3,hrg_satuan4,hrg_satuan5,ktg_grosir,ktg_buffer,Quantity) 
                VALUES 
                    ('$kd_barang', '$nama', '$Satuan1', '$harga', '$Satuan1', '$Satuan2', '$Satuan3', '$Satuan4', '$Satuan5', '$qty_satuan1', '$qty_satuan2', '$qty_satuan3', '$qty_satuan4', '$qty_satuan5', '$ktg_retail', '$ktg_online', '$ktg_ms', '$ktg_mg', '$ktg_mp','$hargaroundup_1', '$hargaroundup_2', '$hargaroundup_3', '$hargaroundup_4', '$hargaroundup_5', '$ktg_grosir', '$ktg_buffer', '$Quantity')
            ";
                        mysqli_query($koneksi, $sql_insert_barang);
                    }
                }

                mysqli_commit($koneksi); // Commit transaction for this batch

            } catch (Exception $e) {
                mysqli_rollback($koneksi); // Rollback if error occurs in batch
                echo "<script>alert('Batch failed: rows $start_row to $end_row. Error: " . addslashes($e->getMessage()) . "');</script>";
            }
        }
        unlink($target_file);

        echo "<script>alert('Data berhasil di Input.');</script>";
        echo "<script>window.location.href = '../../main.php?route=import_barang';</script>";
    } else {
        echo "<script>alert('File gagal diupload.');</script>";
        echo "<script>window.location.href = '../../main.php?route=import_barang';</script>";
    }
}
