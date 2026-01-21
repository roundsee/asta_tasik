<?php
include '../../../../config/koneksi.php';
session_start();
if (!isset($_POST['submit_token']) || $_POST['submit_token'] !== $_SESSION['submit_token']) {
    echo json_encode(['success' => false, 'message' => 'Transaksi duplikat terdeteksi.']);
    echo "<script>history.go(-1)</script>";
    exit;
}
unset($_SESSION['submit_token']); // hanya bisa sekali dipakai
$employee = $_SESSION['employee_number'];


if (isset($_POST['kd_beli'])) {






    $surat_jalan = $_POST['surat_jalan'];
    $kd_beli = $_POST['kd_beli'];
    $kd_brg = $_POST['kd_brg']; // Ini adalah array
    $jml = $_POST['jml'];
    $qty_terima = $_POST['qty_terima']; // Ini juga array
    $tujuan_kirim = $_POST['tujuan_kirim'];
    $urut = $_POST['urut'];
    $satuan = $_POST['satuan'];

    $tanggal = $_POST['tanggal'];

    // Cek apakah checkbox generate otomatis aktif
    if (isset($_POST['autoSuratJalan'])) {
        // Ambil urutan terakhir surat jalan untuk tanggal yang dipilih
        $result = mysqli_query($koneksi, "SELECT surat_jalan FROM penerimaan_barang WHERE tgl_terima = '$tanggal' ORDER BY surat_jalan DESC LIMIT 1");
        $last_sj = mysqli_fetch_assoc($result);

        if ($last_sj) {
            // Ambil nomor urutan dari surat jalan terakhir dan tambahkan 1
            $last_number = (int)substr($last_sj['surat_jalan'], -4); // Ambil 4 digit terakhir sebagai nomor
            $new_number = str_pad($last_number + 1, 4, '0', STR_PAD_LEFT);
        } else {
            // Jika belum ada surat jalan pada tanggal tersebut, mulai dari 0001
            $new_number = '0001';
        }

        // Format surat jalan baru
        $surat_jalan = "SJ-$tanggal-$new_number";

        // Cek apakah surat jalan ini sudah ada di database untuk menghindari duplikasi
        $check_existing = mysqli_query($koneksi, "SELECT COUNT(*) as count FROM penerimaan_barang WHERE surat_jalan = '$surat_jalan'");
        $count_result = mysqli_fetch_assoc($check_existing);

        if ($count_result['count'] > 0) {
            // Jika sudah ada, increment lagi
            $new_number = str_pad($last_number + 2, 4, '0', STR_PAD_LEFT); // Tambah 2 untuk memastikan unik
            $surat_jalan = "SJ-$tanggal-$new_number";
        }
    } else {
        // Jika tidak generate otomatis, gunakan input user
        $surat_jalan = $_POST['surat_jalan'];
    }

    // Debugging dengan print_r dalam elemen <pre>
    // echo "<pre>";
    // print_r([
    //     'Employee' => $employee,
    //     'Surat Jalan' => $surat_jalan,
    //     'Kode Beli' => $kd_beli,
    //     'Kode Barang' => $kd_brg,
    //     'Qty Terima' => $qty_terima,
    // ]);
    // echo "</pre>";

    // Update status_pembelian menjadi 4
    $check_pembelian = mysqli_query($koneksi, "SELECT ppn FROM pembelian WHERE kd_beli = '$kd_beli'");
    $row_check_pembelian = $check_pembelian ? mysqli_fetch_assoc($check_pembelian) : [];
    $ppn = isset($row_check_pembelian['ppn']) ? $row_check_pembelian['ppn'] : 0;


    // Query untuk mengambil data dari pembelian_detail berdasarkan kd_beli
    $query = mysqli_query($koneksi, "SELECT kd_po, kd_brg, price, jml , disc, satuan,jumlah_pcs, urut FROM pembelian_detail WHERE kd_beli='$kd_beli' ");

    $status_terima = true; // Inisialisasi status berhasil
    // Periksa apakah data ditemukan
    if (mysqli_num_rows($query) > 0) {
        while ($data = mysqli_fetch_assoc($query)) {
            $kd_po = $data['kd_po'];
            $kd_brg_query = $data['kd_brg'];
            $price = $data['price'];
            // $jml = $data['jml'];
            $disc = $data['disc'];
            // $satuan = $data['satuan'];







            foreach ($kd_brg as $index => $kode_barang) {
                if ($kode_barang == $kd_brg_query) {
                    $qty_terima_value = isset($qty_terima[$index]) ? $qty_terima[$index] : 0;
                    $urut_value = isset($urut[$index]) ? $urut[$index] : 0;
                    $tujuan_kirim_value = isset($tujuan_kirim[$index]) ? $tujuan_kirim[$index] : 0;
                    $satuan_value = isset($satuan[$index]) ? $satuan[$index] : 'undefinded';
                    $jml_value = isset($jml[$index]) ? $jml[$index] : 0;
                    // Cek apakah ada kd_po yang berbeda dengan surat_jalan yang sama
                    $cek_surat_jalan = "SELECT * FROM penerimaan_barang WHERE surat_jalan = '$surat_jalan' AND kd_po != '$kd_po'";
                    $result_cek_surat_jalan = mysqli_query($koneksi, $cek_surat_jalan);

                    if (mysqli_num_rows($result_cek_surat_jalan) > 0) {
                        // Jika ada hasil, berarti surat jalan sudah digunakan untuk kd_po yang berbeda
                        echo "<script>alert('Surat Jalan $surat_jalan sudah digunakan dengan kode PO yang berbeda!')</script>";
                        $status_terima = false;
                        break;
                    } else {
                        // Cek apakah kombinasi kd_po dan urut sudah ada
                        $cek_urut_query = "SELECT * FROM penerimaan_barang WHERE kd_po = '$kd_po' AND urut = '$urut_value'";
                        $result_cek_urut = mysqli_query($koneksi, $cek_urut_query);

                        if (mysqli_num_rows($result_cek_urut) > 0) {
                            continue; // Lanjutkan ke iterasi berikutnya
                        } else {
                            // Jika tidak ada, lanjutkan proses insert
                            $query_insert_penerimaan_barang = "INSERT INTO penerimaan_barang (kd_po, surat_jalan, tgl_terima, kd_brg, jumlah, jumlah_datang, penerima, urut, tujuan_kirim, satuan) 
                                               VALUES ('$kd_po', '$surat_jalan', '$tanggal', '$kode_barang', '$jml_value', '$qty_terima_value', '$employee', '$urut_value', '$tujuan_kirim','$satuan_value')";
                            $sql1 = mysqli_query($koneksi, $query_insert_penerimaan_barang);
                        }

                        // Update quantity ke master barang
                        // $query_update_barang = "UPDATE barang SET Quantity = Quantity + '$qty_terima_value' WHERE kd_brg = '$kode_barang'";
                        // $result_query_update_barang = mysqli_query($koneksi, $query_update_barang);

                        // Insert ke tabel payment_detail (opsional)
                        // $query_insert_payment_detail = "INSERT INTO payment_detail (no_payment, kd_brg, jumlah, jumlah_datang, harga, disc, satuan) 
                        //                                 VALUES ('$no_payment', '$kode_barang', '$jml', '$qty_terima_value', '$price', '$disc', '$satuan')";
                        // $sql_payment_detail = mysqli_query($koneksi, $query_insert_payment_detail);
                    }
                }
            }


            // include "../data_mutasi_stok/aksi_mutasi_stok.php";

        }

        if ($status_terima) {
            $update_status = mysqli_query($koneksi, "UPDATE pembelian SET status_pembelian = 4 WHERE kd_beli = '$kd_beli'");
            echo "<script>alert('Data berhasil diterima')</script>";
        }
        echo "<script>history.go(-1)</script>";
    } else {
        echo "Tidak ada data yang ditemukan untuk kd_beli: $kd_beli";
        echo "<script>history.go(-1)</script>";
    }
}
