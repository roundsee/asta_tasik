
<?php

$tabel = 'mutasi_stok';
$f1 = 'tgl';
$f2 = 'kd_cus';
$f3 = 'kd_brg';
$f4 = 'satuan';
$f5 = 'qty_awal';
$f6 = 'nilai_awal';
$f7 = 'qty_beli';
$f8 = 'nilai_beli';
$f9 = 'qty_beli_retur';
$f10 = 'nilai_beli_retur';
$f11 = 'qt_tersedia';
$f12 = 'nilai_tersedia';
$f13 = 'harga_rata';
$f14 = 'qt_jual';
$f15 = 'nilai_jual';
$f16 = 'hpp_jual';
$f17 = 'qt_akhir';
$f18 = 'nilai_akhir';
$f19 = 'stok_opname';
$f20 = 'nilai_opname';


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

        $tanggal = isset($data['A']) ? mysqli_real_escape_string($koneksi, $data['A']) : '';
        $kd_cus_pengirim = isset($data['B']) ? mysqli_real_escape_string($koneksi, $data['B']) : '';
        $kd_cus_penerima = isset($data['C']) ? mysqli_real_escape_string($koneksi, $data['C']) : '';
        $kode_barang = isset($data['D']) ? mysqli_real_escape_string($koneksi, $data['D']) : '';
        $qty = isset($data['E']) ? mysqli_real_escape_string($koneksi, $data['E']) : '';

        // echo "Tanggal: $tanggal\n";
        // echo "Kode Customer Pengirim: $kd_cus_pengirim\n";
        // echo "Kode Customer Penerima: $kd_cus_penerima\n";
        // echo "Kode Barang: $kode_barang\n";
        // echo "Quantity: $qty\n";
        

        if (empty($kode_barang)) {
            continue; // Skip if kd_sage is empty
        }

        // UNTUK PENGIRIM NYAA


        $query_harga_beli_terbaru = "SELECT harga FROM barang WHERE kd_brg = '$kode_barang'";
        $resutl_harga_beli_terbaru = mysqli_query($koneksi, $query_harga_beli_terbaru);

        if (!$resutl_harga_beli_terbaru) {
            die("Query gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
        }

        // Periksa apakah ada hasil yang dikembalikan
        if (mysqli_num_rows($resutl_harga_beli_terbaru) > 0) {
            $rows = mysqli_fetch_assoc($resutl_harga_beli_terbaru);
            if (isset($rows['harga'])) {
                $harga_beli_terbaru = $rows['harga'];
            }
        } else {
            $harga_beli_terbaru = 0; // Atau nilai default lain yang sesuai
        }
        $harga_beli_terbaru = is_numeric($harga_beli_terbaru) ? $harga_beli_terbaru : 0;





        // Query untuk mendapatkan data dari tanggal terbaru yang sesuai dengan unit pengirim dan barang sage
        $query_awal = "SELECT 
         tgl AS tgl_terakhir, 
         nilai_akhir AS nilai_awal, 
         qt_akhir AS qty_awal, 
         nilai_beli AS nilai_beli_sebelumnya, 
         qty_beli AS qty_beli_sebelumnya,
         stok_opname, nilai_opname 
         FROM 
         mutasi_stok  
         WHERE  
         kd_cus = '$kd_cus_pengirim' AND kd_brg = '$kode_barang' 
         ORDER BY 
         tgl_terakhir DESC 
         LIMIT 1";

        $result_awal = mysqli_query($koneksi, $query_awal);

        if (!$result_awal) {
            die("Query untuk mendapatkan nilai awal, qty awal, nilai beli sebelumnya, dan qty beli sebelumnya gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
        }

        if (mysqli_num_rows($result_awal) > 0) {
            $row_awal = mysqli_fetch_assoc($result_awal);
            $qty_awal = $row_awal['qty_awal'];
            $nilai_awal = $row_awal['nilai_awal'];
            $nilai_beli_sebelumnya = $row_awal['nilai_beli_sebelumnya'];
            $qty_beli_sebelumnya = $row_awal['qty_beli_sebelumnya'];
          

            $stok_opname = $row_awal['stok_opname'];
            $nilai_opname = $row_awal['nilai_opname'];
        } else {
            $nilai_awal = 0;
            $qty_awal = 0;
            $nilai_beli_sebelumnya = 0;
            $qty_beli_sebelumnya = 0;
            $stok_opname = 0; // Default jika tidak ada data
            $nilai_opname = 0; // Default jika tidak ada data    
        }

        // Tentukan nilai qty_awal
        $qty_awal = $stok_opname != 0 ? $stok_opname : $qty_awal;
        $nilai_awal = $nilai_opname != 0 ? $nilai_opname : $nilai_awal;

        // Validasi untuk memastikan nilai numerik
        $nilai_awal = is_numeric($nilai_awal) ? $nilai_awal : 0;
    


        // Cek apakah data dengan kombinasi yang sama sudah ada untuk pengirim sudah ada di hari yang sama
        $query_check_pengirim = "SELECT * FROM mutasi_stok WHERE tgl = '$tanggal' AND kd_cus = '$kd_cus_pengirim' AND kd_brg = '$kode_barang'";
        $result_check_pengirim = mysqli_query($koneksi, $query_check_pengirim);


        if ($result_check_pengirim && mysqli_num_rows($result_check_pengirim) > 0) {
            $row_harga_rata = mysqli_fetch_assoc($result_check_pengirim);
            $harga_rata_pengirim = $row_harga_rata['harga_rata'];
        } else {
            $harga_rata_pengirim = 0;
        }



        if (($nilai_awal <= 0 || $qty_awal <= 0)) {
            $harga_rata = $harga_beli_terbaru;
        } else {
            $harga_rata = ($nilai_awal  / $qty_awal);
        }

        if (!$result_check_pengirim) {
            die("Query gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
        }

        if (mysqli_num_rows($result_check_pengirim) > 0) {
            // Update data yang ada dengan menjumlahkan qt_kirim_int untuk pengirim
            $query_update_pengirim = "UPDATE mutasi_stok SET 
            qt_kirim_int = qt_kirim_int + $qty,
            nilai_kirim_int = nilai_kirim_int + ('$harga_rata_pengirim' * $qty),
            qt_akhir = qt_akhir - $qty ,
            nilai_akhir = CEIL('$harga_rata_pengirim' * qt_akhir)
            WHERE tgl = '$tanggal' AND kd_cus = '$kd_cus_pengirim' AND kd_brg = '$kode_barang'";

            // echo "update_pengirim tanpa BOM : " . $query_update_pengirim;
            $result_update_pengirim = mysqli_query($koneksi, $query_update_pengirim);

            if (!$result_update_pengirim) {
                die("Query update gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
            }
        } else {
            $query_insert_pengirim = "INSERT INTO 
            mutasi_stok (tgl, qty_awal, nilai_awal,qt_tersedia,
            nilai_tersedia,harga_rata, kd_cus, kd_brg, satuan,
             qt_kirim_int,nilai_kirim_int, qt_akhir, nilai_akhir) VALUES (
            '$tanggal', 
            '$qty_awal',
            '$nilai_awal',
            '$qty_awal',
            '$nilai_awal',
            '$harga_rata',
            '$kd_cus_pengirim', 
            '$kode_barang',  
            'Pcs',
            '$qty',
            '$qty' * $harga_rata,
            '$qty_awal' - '$qty',
            ('$qty_awal' - '$qty') * $harga_rata
         )";
            // echo "<br>";
            // echo "pengiriman biasa tanpa bom ini yang sedang dicari: " . $query_insert_pengirim;
            $result_insert_pengirim = mysqli_query($koneksi, $query_insert_pengirim);

            if (!$result_insert_pengirim) {
                die("Query insert gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
            }

        }



        // UNTUK PENERIMANYA

         // Query untuk mendapatkan data dari tanggal terbaru yang sesuai dengan unit penerima 
         $query_awal = "SELECT 
         tgl AS tgl_terakhir, 
         nilai_akhir AS nilai_awal, 
         qt_akhir AS qty_awal, 
         nilai_beli AS nilai_beli_sebelumnya, 
         qty_beli AS qty_beli_sebelumnya,
         stok_opname, nilai_opname 
         FROM 
         mutasi_stok  
         WHERE  
         kd_cus = '$kd_cus_penerima' AND kd_brg = '$kode_barang' 
         ORDER BY 
         tgl_terakhir DESC 
         LIMIT 1";


        $result_awal = mysqli_query($koneksi, $query_awal);

        if (!$result_awal) {
            die("Query untuk mendapatkan nilai awal, qty awal, nilai beli sebelumnya, dan qty beli sebelumnya gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
        }

        if (mysqli_num_rows($result_awal) > 0) {
            $row_awal = mysqli_fetch_assoc($result_awal);
            $nilai_awal = $row_awal['nilai_awal'];
            $qty_awal = $row_awal['qty_awal'];
            $nilai_beli_sebelumnya = $row_awal['nilai_beli_sebelumnya'];
            $qty_beli_sebelumnya = $row_awal['qty_beli_sebelumnya'];
            $stok_opname = $row_awal['stok_opname'];
            $nilai_opname = $row_awal['nilai_opname'];
        } else {
            $nilai_awal = 0;
            $qty_awal = 0;
            $nilai_beli_sebelumnya = 0;
            $qty_beli_sebelumnya = 0;
            $stok_opname = 0; // Default jika tidak ada data
            $nilai_opname = 0; // Default jika tidak ada data    
        }

        // Tentukan nilai qty_awal
        $qty_awal = $stok_opname != 0 ? $stok_opname : $qty_awal;
        $nilai_awal = $nilai_opname != 0 ? $nilai_opname : $nilai_awal;

        // Validasi untuk memastikan nilai numerik
        $nilai_awal = is_numeric($nilai_awal) ? $nilai_awal : 0;
        $qty_awal = is_numeric($qty_awal) ? $qty_awal : 0;


        // Cek apakah data dengan kombinasi yang sama sudah ada untuk penerima
        $query_check_penerima = "SELECT * FROM mutasi_stok WHERE tgl = '$tanggal' AND kd_cus = '$kd_cus_penerima' AND kd_brg = '$kode_barang'";
        $result_check_penerima = mysqli_query($koneksi, $query_check_penerima);


        if ($result_check_penerima && mysqli_num_rows($result_check_penerima) > 0) {
            $row_harga_rata_penerima_tanggal_sama = mysqli_fetch_assoc($result_check_penerima);
            $harga_rata_penerima_tanggal_sama = $row_harga_rata_penerima_tanggal_sama['harga_rata'];
        } else {
            $harga_rata_penerima_tanggal_sama = 0;
        }

       
        if (($nilai_awal <= 0 || $qty_awal <= 0)) {
            $harga_rata_penerima = $harga_rata_pengirim;
        } else {
            $harga_rata_penerima =  ($nilai_awal + ($harga_rata * $qty )) /($qty_awal + $qty )  ;
        }




        if (!$result_check_penerima) {
            die("Query gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
        }

        if (mysqli_num_rows($result_check_penerima) > 0) {
            $query_update_penerima = "UPDATE mutasi_stok SET 
             qt_terima_int = qt_terima_int + $qty , 
             nilai_terima_int = nilai_terima_int +  ('$harga_rata_pengirim' * $qty ),
             qt_tersedia = qt_tersedia + $qty ,
             nilai_tersedia = nilai_tersedia + ('$harga_rata_pengirim' * $qty ),
             harga_rata = CASE
                 WHEN qt_tersedia = 0 AND nilai_tersedia < 0 THEN '$harga_beli_terbaru'
                 WHEN qt_tersedia = 0 THEN '$harga_beli_terbaru'
                 ELSE nilai_tersedia / qt_tersedia
             END,
             qt_akhir = qt_akhir + $qty,
             nilai_akhir =CEIL(harga_rata * qt_akhir)
             WHERE tgl = '$tanggal' AND kd_cus = '$kd_cus_penerima' AND kd_brg = '$kode_barang'";
            $result_update_penerima = mysqli_query($koneksi, $query_update_penerima);

            if (!$result_update_penerima) {
                die("Query update gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
            }
        } else {
            // Insert data baru untuk penerima
            $query_insert_penerima = "INSERT INTO mutasi_stok
              (tgl, qty_awal, nilai_awal, kd_cus, kd_brg, satuan,
               nilai_terima_int, qt_terima_int, qt_tersedia, nilai_tersedia, qt_akhir, nilai_akhir, harga_rata) VALUES (
             '$tanggal', 
             '$qty_awal',
             '$nilai_awal',
             '$kd_cus_penerima',
             '$kode_barang',  
             'Pcs',
             '$harga_rata' * $qty ,
              $qty ,
             '$qty_awal' + $qty ,
             '$nilai_awal'+ ('$harga_rata' * $qty ),
             '$qty_awal' +  $qty ,
             ('$qty_awal' +  $qty) * '$harga_rata_penerima',
            '$harga_rata_penerima'

          )";
            $result_insert_penerima = mysqli_query($koneksi, $query_insert_penerima);

            if (!$result_insert_penerima) {
                die("Query insert gagal dijalankan yang ini ?: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
            }
        }



       

    }

    // Remove the uploaded file
    unlink($target_file);
    echo "<script>alert('Data berhasil di Input.');</script>";
    echo "<script>history.go(-1);</script>";
}

?>
