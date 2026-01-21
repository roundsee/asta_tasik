
<?php
include '../../../../config/koneksi.php';
session_start();

$employee = $_SESSION['employee_number'];

$query_kdcus = mysqli_query($koneksi, "SELECT kd_cus FROM user_login where employee_number = '$employee'");
$q1 = mysqli_fetch_assoc($query_kdcus);
$kd_cus = $q1['kd_cus'];



// Cek apakah form telah di-submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Ambil data dari form
    $no_invoice = $_POST['no_invoice'];
    $kd_beli = $_POST['kd_beli'];
    $kd_supp = $_POST['kd_supp'];
    $ongkir = $_POST['ongkos_kirim'];
    $ppn = $_POST['ppn'];  // Menghapus koma dari angka
    $tanggal_invoice = $_POST['tgl_invoice'];  // Tanggal hari ini
    $tujuan_kirim = $_POST['tujuan_kirim'];
    echo $tujuan_kirim;

    // Cek apakah no_invoice sudah ada dalam database untuk kd_po yang berbeda
    $query_check_invoice = "SELECT no_invoice FROM pembelian_invoice WHERE no_invoice = '$no_invoice' AND kd_po != '$kd_beli'";
    $result_check_invoice = mysqli_query($koneksi, $query_check_invoice);

    if (mysqli_num_rows($result_check_invoice) > 0) {
        // Jika ditemukan nomor invoice yang sama dengan kd_po yang berbeda
        echo "<script>alert('Nomor Invoice sudah ada dan tidak boleh sama!');</script>";
        echo "<script>history.go(-1);</script>";
    } else {

        $update_status = mysqli_query($koneksi, "UPDATE pembelian SET status_invoice = 1 WHERE kd_po = '$kd_beli'");

        // echo $update_status;
        // die();


        // Insert ke tabel pembelian_invoice
        $query_invoice = "INSERT INTO pembelian_invoice (kd_cus, no_invoice, tanggal_invoice, kd_po, kd_supp, ppn, ongkir)
                              VALUES ('$kd_cus', '$no_invoice', '$tanggal_invoice', '$kd_beli', '$kd_supp', '$ppn', '$ongkir')";

        // echo $query_invoice;
        mysqli_query($koneksi, $query_invoice);

        // Periksa apakah query invoice berhasil
        if (mysqli_affected_rows($koneksi) > 0) {
            // echo "Data invoice berhasil ditambahkan.<br>";
        } else {
            // echo "Gagal menambahkan data invoice.<br>";
        }

        // Insert ke tabel pembelian_invoice_detail (karena bisa banyak barang, lakukan perulangan)
        foreach ($_POST['jumlah'] as $index => $jumlah) {
            $kd_brg = $_POST['kd_brg'][$index];
            $jml_pcs = $_POST['jml_pcs'][$index];
            $urut = $_POST['urut'][$index];
            $satuan = $_POST['satuan'][$index];
            $harga = str_replace(",", "", $_POST['harga'][$index]);  // Menghapus koma dari angka
            $diskon = str_replace(",", "", $_POST['diskon'][$index]);  // Menghapus koma dari angka
            // Insert ke pembelian_invoice_detail
            $query_detail = "INSERT INTO pembelian_invoice_detail (no_invoice, kd_po, kd_brg, nilai, disc, jml, jml_pcs,urut,satuan)
                                 VALUES ('$no_invoice', '$kd_beli', '$kd_brg', '$harga', '$diskon', '$jumlah','$jml_pcs','$urut', '$satuan')";
            mysqli_query($koneksi, $query_detail);

            // Periksa apakah query detail berhasil
            if (mysqli_affected_rows($koneksi) > 0) {
                // echo "Detail barang $kd_brg berhasil ditambahkan.<br>";
            } else {
                // echo "Gagal menambahkan detail barang $kd_brg.<br>";
            }

            // Update harga ke table barang 
            $query_update_barang = "UPDATE barang SET harga = '$harga' WHERE kd_brg = '$kd_brg'";
            $result_query_update_barang = mysqli_query($koneksi, $query_update_barang);
            if (!$result_query_update_barang) {
                die('Update Harga gagal dijalankan' . mysqli_error($koneksi));
            }


            // Mengupdate atau menambah ke inventory
            $query_check = "SELECT * FROM inventory WHERE kd_cus = '$tujuan_kirim' AND kd_brg = '$kd_brg' ";
            $result_check = mysqli_query($koneksi, $query_check);

            if (mysqli_num_rows($result_check) > 0) {
                $query_update = "UPDATE inventory SET 
            stok = stok + ($jumlah * $jml_pcs)
            WHERE kd_cus = '$tujuan_kirim' AND kd_brg = '$kd_brg' ";
                $result_update = mysqli_query($koneksi, $query_update);

                if (!$result_update) {
                    die("Query update gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
                }
            } else {
                // Data belum ada, masukkan data baru
                $query_insert = "INSERT INTO inventory (kd_cus,kd_brg,stok,satuan) VALUES (
                '$tujuan_kirim', 
                '$kd_brg',  
                '$jumlah' * '$jml_pcs',
                'Pcs'
            )";

                $result_insert = mysqli_query($koneksi, $query_insert);

                if (!$result_insert) {
                    die("Query insert gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
                }
            }



            // Update Langsung Ke mutasi stok
            $query_awal = "SELECT 
        tgl AS tgl_terakhir, 
          nilai_akhir AS nilai_awal, 
          qt_akhir AS qty_awal, 
          nilai_beli AS nilai_beli_sebelumnya, 
          qty_beli AS qty_beli_sebelumnya, 
          harga_rata ,
          stok_opname, nilai_opname 
          FROM 
          mutasi_stok  
          WHERE  
          kd_cus = '$tujuan_kirim' AND kd_brg = '$kd_brg' 
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
                $harga_rata_sebelumnya = $row_awal['harga_rata'];
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
                $harga_rata_sebelumnya = 0;
                $stok_opname = 0; // Default jika tidak ada data
                $nilai_opname = 0; // Default jika tidak ada data

            }

            $nilai_awal = is_numeric($nilai_awal) ? $nilai_awal : 0;
            $qty_awal = is_numeric($qty_awal) ? $qty_awal : 0;
            $nilai_beli_sebelumnya = is_numeric($nilai_beli_sebelumnya) ? $nilai_beli_sebelumnya : 0;
            $qty_beli_sebelumnya = is_numeric($qty_beli_sebelumnya) ? $qty_beli_sebelumnya : 0;
            $stok_opname = is_numeric($stok_opname) ? $stok_opname : 0;
            $nilai_opname = is_numeric($nilai_opname) ? $nilai_opname : 0;
            // Hitung harga rata-rata
            if (($qty_awal + ($jumlah * $jml_pcs)) != 0) {
                $harga_rata = (($nilai_awal + ($harga * ($jumlah * $jml_pcs))) / ($qty_awal + ($jumlah * $jml_pcs)));
            } else {
                $harga_rata = is_numeric($harga_rata) ? $harga_rata : 0;
            }




            // Cek apakah data dengan tanggal, kd_cus, dan kd_barang_sage yang sama sudah ada
            $query_check = "SELECT * FROM mutasi_stok WHERE tgl = '$tanggal_invoice' AND kd_cus = '$tujuan_kirim' AND kd_brg = '$kd_brg'";
            $result_check = mysqli_query($koneksi, $query_check);

            if (mysqli_num_rows($result_check) > 0) {
                // Data sudah ada, update data yang ada dengan menjumlahkan banyak
                $query_update = "UPDATE mutasi_stok SET 
            qty_beli = qty_beli + ($jumlah * $jml_pcs),
            nilai_beli = nilai_beli + ($harga * ($jumlah * $jml_pcs)),
            qt_tersedia = qt_tersedia + ($jumlah * $jml_pcs),
            qt_akhir = qt_akhir + ($jumlah * $jml_pcs),
            harga_rata = CASE 
                WHEN (qty_awal + qty_beli) <= 0 OR (nilai_awal ) <=0 THEN (nilai_beli / qty_beli)
                ELSE (nilai_awal + nilai_beli) / (qty_awal + qty_beli)
            END,
            nilai_tersedia = harga_rata * qt_tersedia,
            nilai_akhir = harga_rata * qt_akhir
        WHERE tgl = '$tanggal_invoice' AND kd_cus = '$tujuan_kirim' AND kd_brg = '$kd_brg'";
                $result_update = mysqli_query($koneksi, $query_update);
                // echo "<pre>";
                // echo $result_update;
                // echo "</pre>";

                if (!$result_update) {
                    die("Update Mutasi Stok gagal Dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
                }
            } else {
                // Data belum ada, masukkan data baru
                $query_insert = "INSERT INTO mutasi_stok (
                    tgl, 
                    kd_cus, 
                    kd_brg, 
                    satuan, 
                    qty_awal, 
                    nilai_awal, 
                    qty_beli, 
                    nilai_beli, 
                    qt_tersedia, 
                    nilai_tersedia, 
                    qt_akhir, 
                    nilai_akhir, 
                    harga_rata
                ) VALUES (
                    '$tanggal_invoice', 
                    '$tujuan_kirim', 
                    '$kd_brg',  
                    'Pcs',
                    '$qty_awal',
                    '$nilai_awal',
                    ('$jumlah' * '$jml_pcs'),
                    ('$harga' * ('$jumlah' * '$jml_pcs')),
                    (('$jumlah' * '$jml_pcs') + '$qty_awal'),
                    ((('$jumlah' * '$jml_pcs') + '$qty_awal') * '$harga_rata'),
                    (('$jumlah' * '$jml_pcs') + '$qty_awal'),
                    ((('$jumlah' * '$jml_pcs') + '$qty_awal') * '$harga_rata'),
                    '$harga_rata'
                )";
                

                // echo "<pre>";
                // echo $query_insert;
                // echo "</pre>";


                $result_insert = mysqli_query($koneksi, $query_insert);

                if (!$result_insert) {
                    die("Query insert gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
                }
            }
        } //Penutup untuk perulaangan



        echo "<script>alert('invoice berhasil dicatat')</script>";
        echo "<script>history.go(-2)</script>";
    }
} else {
    echo "Form belum di-submit.";
}

?>

