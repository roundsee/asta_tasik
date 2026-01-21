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
        function realUpTo100($value)
        {
            return ceil($value / 100) * 100;
        }
        function roundUpTo100($value)
        {
            return ceil($value / 100) * 100;
            // return round($value);
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
                    $ktg_retail = strtoupper($ktg_retail);

                    $ktg_buffer = isset($data['O']) ? mysqli_real_escape_string($koneksi, $data['O']) : '';
                    $QuantitySwalayan = isset($data['P']) ? mysqli_real_escape_string($koneksi, $data['P']) : '';
                    $QuantityGudang = isset($data['Q']) ? mysqli_real_escape_string($koneksi, $data['Q']) : '';

                    if ($QuantitySwalayan != '') {
                        $updatestock = mysqli_query($koneksi, "UPDATE inventory SET 
                            stok ='$QuantitySwalayan'
                            WHERE kd_brg = '$kd_barang' AND kd_cus = 1316");
                        $check_barang_sql = "SELECT COUNT(*) AS count FROM inventory WHERE kd_brg = '$kd_barang' AND kd_cus = 1316";
                        $check_barang_result = mysqli_query($koneksi, $check_barang_sql);
                        $check_barang_data = mysqli_fetch_assoc($check_barang_result);
                        if ($check_barang_data['count'] <= 0) {
                            $insertstock = mysqli_query($koneksi, "INSERT INTO inventory (kd_brg, kd_cus, stok, satuan) 
                                VALUES ('$kd_barang', 1316, '$QuantitySwalayan', 'Pcs')");
                        }
                    }

                    // Query 2: Update Gudang stock
                    if ($QuantityGudang != '') {
                        $updatestock = mysqli_query($koneksi, "UPDATE inventory SET 
                            stok ='$QuantityGudang'
                            WHERE kd_brg = '$kd_barang' AND kd_cus = 8001");
                        $check_barang_sql = "SELECT COUNT(*) AS count FROM inventory WHERE kd_brg = '$kd_barang' AND kd_cus = 8001";
                        $check_barang_result = mysqli_query($koneksi, $check_barang_sql);
                        $check_barang_data = mysqli_fetch_assoc($check_barang_result);
                        if ($check_barang_data['count'] <= 0) {
                            $insertstock = mysqli_query($koneksi, "INSERT INTO inventory (kd_brg, kd_cus, stok, satuan) 
                                VALUES ('$kd_barang', 8001, '$QuantityGudang', 'Pcs')");
                        }
                    }


                    $hargake_values = [];
                    $satuanke = [
                        2 => $Satuan2,
                        3 => $Satuan3,
                        4 => $Satuan4,
                        5 => $Satuan5
                    ];
                    $quantityke = [
                        1 => $qty_satuan1,
                        2 => $qty_satuan2,
                        3 => $qty_satuan3,
                        4 => $qty_satuan4,
                        5 => $qty_satuan5
                    ];

                    $previous_hargake = null;

                    for ($id_kat = 1; $id_kat <= 6; $id_kat++) {
                        $querysql1 = mysqli_query($koneksi, "SELECT 
                            IFNULL(layer1, 0) AS layer11,
                            IFNULL(SUBSTRING_INDEX(layer2, '|', 1), 0) AS layer21, 
                            IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer2, '|', 2), '|', -1), 0) AS layer22,
                            IFNULL(SUBSTRING_INDEX(layer3, '|', 1), 0) AS layer31,  
                            IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer3, '|', 2), '|', -1), 0) AS layer32,  
                            IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer3, '|', 3), '|', -1), 0) AS layer33, 
                            IFNULL(SUBSTRING_INDEX(layer4, '|', 1), 0) AS layer41, 
                            IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer4, '|', 2), '|', -1), 0) AS layer42, 
                            IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer4, '|', 3), '|', -1), 0) AS layer43, 
                            IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer4, '|', 4), '|', -1), 0) AS layer44,  
                            IFNULL(SUBSTRING_INDEX(layer5, '|', 1), 0) AS layer51,  
                            IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 2), '|', -1), 0) AS layer52, 
                            IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 3), '|', -1), 0) AS layer53,  
                            IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 4), '|', -1), 0) AS layer54,  
                            IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 5), '|', -1), 0) AS layer55
                        FROM kategori_nilai 
                        WHERE Nama_kategoriNilai = '$ktg_retail' AND id_kat = $id_kat");

                        if ($s1 = mysqli_fetch_array($querysql1)) {
                            $temp_hargake = array_fill(0, 5, 0);
                            for ($i = 5; $i >= 1; $i--) {
                                if ($i == 1) {
                                    $temp_hargake[0] = realUpTo100($quantityke[$i] * $harga * (1 + $s1["layer11"] / 100));
                                } else if (!empty($satuanke[$i])) {
                                    for ($j = 1; $j <= $i; $j++) {
                                        $layer_column = "layer{$i}$j";
                                        $temp_hargake[$j - 1] = roundUpTo100($harga * $quantityke[$j] * (1 + $s1[$layer_column] / 100));
                                    }
                                    break;
                                }
                            }
                            $previous_hargake = $temp_hargake;

                            $hargake_values = array_merge($hargake_values, $temp_hargake);
                        } else {
                            if ($previous_hargake !== null) {
                                $hargake_values = array_merge($hargake_values, $previous_hargake);
                            }
                        }
                    }
                    $query_values = array_map(function ($value) {
                        return "'" . roundUpTo100($value) . "'";
                    }, $hargake_values);
                    // $query_values = array_map(function ($value) {
                    //     return "'" . $value . "'";
                    // }, $hargake_values);


                    $check_barang_sql = "SELECT COUNT(*) AS count FROM barang WHERE kd_brg='$kd_barang'";
                    $check_barang_result = mysqli_query($koneksi, $check_barang_sql);
                    $check_barang_data = mysqli_fetch_assoc($check_barang_result);
                    if ($check_barang_data['count'] > 0) {
                        $temporary_update_barang = 0;
                        //             $query_values = array_map(function ($value) {
                        //                 $value = str_replace("'", "", $value);
                        //                 return intval($value);
                        //             }, $hargake_values);
                        //             $sql_update_barang = "
                        //             UPDATE barang 
                        //             SET 
                        //                 nama='$nama',
                        //                 satuan='$Satuan1',
                        //                 harga='$harga',
                        //                 Satuan1='$Satuan1',
                        //                 Satuan2='$Satuan2',
                        //                 Satuan3='$Satuan3',
                        //                 Satuan4='$Satuan4',
                        //                 Satuan5='$Satuan5',
                        //                 qty_satuan1='$qty_satuan1',
                        //                 qty_satuan2='$qty_satuan2',
                        //                 qty_satuan3='$qty_satuan3',
                        //                 qty_satuan4='$qty_satuan4',
                        //                 qty_satuan5='$qty_satuan5',
                        //                 ktg_retail='$ktg_retail',
                        //                 ktg_grosir='$ktg_retail',
                        //                 ktg_online='$ktg_retail',
                        //                 ktg_ms='$ktg_retail',
                        //                 ktg_mg='$ktg_retail',
                        //                 ktg_mp='$ktg_retail',
                        //                 ktg_buffer='$ktg_buffer',
                        //                 hrg_satuan1 = '{$query_values[0]}',
                        //                 hrg_satuan2 = '{$query_values[1]}',
                        //                 hrg_satuan3 = '{$query_values[2]}',
                        //                 hrg_satuan4 = '{$query_values[3]}',
                        //                 hrg_satuan5 = '{$query_values[4]}',
                        //                 hrg_satuan1_grosir = '{$query_values[5]}',
                        //                 hrg_satuan2_grosir = '{$query_values[6]}',
                        //                 hrg_satuan3_grosir = '{$query_values[7]}',
                        //                 hrg_satuan4_grosir = '{$query_values[8]}',
                        //                 hrg_satuan5_grosir = '{$query_values[9]}',
                        //                 hrg_satuan1_online = '{$query_values[10]}',
                        //                 hrg_satuan2_online = '{$query_values[11]}',
                        //                 hrg_satuan3_online = '{$query_values[12]}',
                        //                 hrg_satuan4_online = '{$query_values[13]}',
                        //                 hrg_satuan5_online = '{$query_values[14]}',
                        //                 hrg_satuan1_ms ='{$query_values[15]}',
                        //                 hrg_satuan2_ms ='{$query_values[16]}',
                        //                 hrg_satuan3_ms ='{$query_values[17]}',
                        //                 hrg_satuan4_ms ='{$query_values[18]}',
                        //                 hrg_satuan5_ms ='{$query_values[19]}',
                        //                 hrg_satuan1_mg ='{$query_values[20]}',
                        //                 hrg_satuan2_mg ='{$query_values[21]}',
                        //                 hrg_satuan3_mg ='{$query_values[22]}',
                        //                 hrg_satuan4_mg ='{$query_values[23]}',
                        //                 hrg_satuan5_mg ='{$query_values[24]}',
                        //                 hrg_satuan1_mp ='{$query_values[25]}',
                        //                 hrg_satuan2_mp ='{$query_values[26]}',
                        //                 hrg_satuan3_mp ='{$query_values[27]}',
                        //                 hrg_satuan4_mp ='{$query_values[28]}',
                        //                 hrg_satuan5_mp ='{$query_values[29]}'
                        //     WHERE kd_brg='$kd_barang'
                        // ";
                        //             mysqli_query($koneksi, $sql_update_barang);
                    } else if (!empty($kd_barang)) {
                        $sql_insert_barang = "
                INSERT INTO barang 
                    (kd_brg, nama, satuan, harga, Satuan1,Satuan2,Satuan3,Satuan4,Satuan5,qty_satuan1,qty_satuan2,qty_satuan3,qty_satuan4,qty_satuan5,
                    ktg_retail,ktg_online,ktg_ms,ktg_mg,ktg_mp,hrg_satuan1,hrg_satuan2,hrg_satuan3,hrg_satuan4,hrg_satuan5,hrg_satuan1_grosir,hrg_satuan2_grosir,hrg_satuan3_grosir,hrg_satuan4_grosir,hrg_satuan5_grosir,hrg_satuan1_online,hrg_satuan2_online,hrg_satuan3_online,hrg_satuan4_online,hrg_satuan5_online,hrg_satuan1_ms,hrg_satuan2_ms,hrg_satuan3_ms,hrg_satuan4_ms,hrg_satuan5_ms,hrg_satuan1_mg,hrg_satuan2_mg,hrg_satuan3_mg,hrg_satuan4_mg,hrg_satuan5_mg,hrg_satuan1_mp,hrg_satuan2_mp,hrg_satuan3_mp,hrg_satuan4_mp,hrg_satuan5_mp,ktg_grosir,ktg_buffer) 
                VALUES 
                    ('$kd_barang', '$nama', '$Satuan1', '$harga', '$Satuan1', '$Satuan2', '$Satuan3', '$Satuan4', '$Satuan5', '$qty_satuan1', '$qty_satuan2', '$qty_satuan3', '$qty_satuan4', '$qty_satuan5', 
                    '$ktg_retail', '$ktg_retail', '$ktg_retail', '$ktg_retail', '$ktg_retail',
                    " . implode(", ", $query_values) . ",'$ktg_retail', '$ktg_buffer')
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
