<?php
include '../../../../config/koneksi.php';
session_start();
$employee = $_SESSION['employee_number'];
// echo $employee;


$query_kdcus = "SELECT kd_cus FROM user_login where employee_number = '$employee'";
$result_kd_cus = mysqli_query($koneksi, $query_kdcus);
$q1 = mysqli_fetch_array($result_kd_cus);
$kd_cus = $q1['kd_cus'] ?? null;


// Inisialisasi variabel tgl_awal dan tgl_akhir
$tgl_awal = isset($_GET['tgl_awal']) ? $_GET['tgl_awal'] : null;
$tgl_akhir = isset($_GET['tgl_akhir']) ? $_GET['tgl_akhir'] : null;
$act = isset($_GET['act']) ? $_GET['act'] : null;

// echo "<br>" . $act;



if ($act == 'keduanya') {
    // echo "Masuk ke keduanya <br>";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Array untuk menyimpan data yang dipilih
        $selected_pilihan1 = [];
        $selected_pilihan2 = [];
        $selected_pilihan3 = [];

        foreach ($_POST as $key => $value) {
            // Pastikan ini adalah radio button yang dipilih
            if (strpos($key, 'selection_') === 0) {
                // Ambil kode barang dari value
                $selected_value = $value;
                $kd_brg = str_replace(['qty_order_rata_', 'qty_order_tertinggi_', 'minimum_order_'], '', $selected_value);

                // Tentukan tipe pilihan berdasarkan value
                if (strpos($selected_value, 'qty_order_rata_') !== false) {
                    $selected_pilihan1[] = $kd_brg;
                } elseif (strpos($selected_value, 'qty_order_tertinggi_') !== false) {
                    $selected_pilihan2[] = $kd_brg;
                } elseif (strpos($selected_value, 'minimum_order_') !== false) {
                    $selected_pilihan3[] = $kd_brg;
                }
            }
        }

        // Jika tidak ada pilihan yang dipilih, tampilkan alert dan kembali ke form
        if (count($selected_pilihan1) == 0 && count($selected_pilihan2) == 0 && count($selected_pilihan3) == 0) {
            echo "<script>alert('Tidak ada item yang dipilih.'); history.go(-1);</script>";
            exit; // Hentikan eksekusi skrip
        }

        // Tampilkan hasil untuk pilihan 1
        if (count($selected_pilihan1) > 0) {
            // echo "Pilihan 1 (Qty Order Rata):<br>";
            foreach ($selected_pilihan1 as $kd_brg) {


                // Gunakan kd_brg untuk memastikan variabel POST yang sesuai digunakan
                $kd_supp = $_POST["kd_supp_$kd_brg"];
                $waktu_kirim_barang = $_POST["waktu_kirim_barang_$kd_brg"];
                $waktu_kirim_supplier = $_POST["waktu_kirim_supplier_$kd_brg"];
                $current_order_rata = $_POST["qty_order_$kd_brg"];
                $tanggal_beli = date('Y-m-d'); // Tanggal pembelian hari ini


                // echo $kd_supp;
                // echo $waktu_kirim_supplier;

                // Mengambil harga dari terakhir pembelian/ penerimaan barang
                $query_harga =  "SELECT harga,Satuan1,qty_satuan1 FROM `barang` WHERE kd_brg = '$kd_brg'";
                $result_harga = mysqli_query($koneksi, $query_harga);
                $row_harga = $result_harga ? mysqli_fetch_assoc($result_harga) : [];
                $price = isset($row_harga['harga']) ? $row_harga['harga'] : 0;
                $satuan = isset($row_harga['Satuan1']) ? $row_harga['Satuan1'] : 'Pcs';
                $qtysatuan = isset($row_harga['qty_satuan1']) ? $row_harga['qty_satuan1'] : 1;



                // Cek apakah kombinasi kd_supp dan tgl_beli sudah ada dalam array
                if (!isset($supplier_info[$kd_supp][$tanggal_beli][$waktu_kirim_barang])) {
                    // Ambil kd_beli terakhir
                    $tgl = date('Y-m-d'); // Format lengkap YYYY-MM-DD
                    $tahun_bulan = date('ym', strtotime($tgl)); // Format YYMM

                    // Query untuk mencari kode pembelian terakhir di bulan yang sama
                    $query_last_po = mysqli_query($koneksi, "SELECT kd_beli FROM pembelian WHERE kd_beli LIKE 'PR-$tahun_bulan%' ORDER BY kd_beli DESC LIMIT 1");

                    if (mysqli_num_rows($query_last_po) > 0) {
                        // Jika sudah ada kode pembelian di bulan tersebut
                        $data_last_po = mysqli_fetch_assoc($query_last_po);
                        $last_kd_po = $data_last_po['kd_beli']; // Gunakan kd_beli sebagai referensi

                        // Ambil bagian nomor terakhir
                        $parts = explode('-', $last_kd_po);
                        $last_number = (int)$parts[2]; // Ambil bagian ketiga dari kode
                        $new_number = str_pad($last_number + 1, 5, '0', STR_PAD_LEFT);
                    } else {
                        // Jika belum ada kode pembelian di bulan tersebut
                        $new_number = "00001";
                    }

                    // Buat kode baru
                    $kd_beli = "PR-$tahun_bulan-$new_number";
                    $kd_po = "PO-$tahun_bulan-$new_number";

                    // Simpan informasi supplier berdasarkan kd_supp dan tgl_beli
                    $supplier_info[$kd_supp][$tanggal_beli][$waktu_kirim_barang] = [
                        'kd_beli' => $kd_beli,
                        'kd_po' => $kd_po
                    ];

                    // Masukkan data ke tabel pembelian
                    $query_insert_pembelian = "
                      INSERT INTO pembelian (kd_cus, kd_beli, kd_supp, durasi_kirim, tgl_beli, kd_po, user_input, tujuan_kirim)
                      VALUES ('$kd_cus', '$kd_beli', '$kd_supp', '$waktu_kirim_barang', '$tanggal_beli', '$kd_po' , '$employee', 8001)";
                    // echo $query_insert_pembelian . "<br>";
                    $result = mysqli_query($koneksi, $query_insert_pembelian);

                    if (!$result) {
                        die("Query error: " . mysqli_error($koneksi));
                    }
                } else {
                    // Gunakan kode beli dan kode PO yang sudah ada untuk kd_supp, tgl_beli, dan waktu_kirim_barang ini
                    $kd_beli = $supplier_info[$kd_supp][$tanggal_beli][$waktu_kirim_barang]['kd_beli'];
                    $kd_po = $supplier_info[$kd_supp][$tanggal_beli][$waktu_kirim_barang]['kd_po'];
                }

                $query = mysqli_query($koneksi, "SELECT max(urut) as urut_max FROM pembelian_detail WHERE kd_beli='$kd_beli' ");
                $data = mysqli_fetch_array($query);
                $urut = $data['urut_max'];
                $urut++;

                // // Masukkan data ke tabel pembelian_detail
                $query_insert_pembelian_detail = "
                  INSERT INTO pembelian_detail (kd_beli, kd_brg, jml, price,satuan, jumlah_pcs, kd_po, urut)
                  VALUES ('$kd_beli', '$kd_brg', '$current_order_rata','$price', '$satuan', '$qtysatuan', '$kd_po', '$urut')";
                // echo $query_insert_pembelian_detail;
                mysqli_query($koneksi, $query_insert_pembelian_detail);
            }
        } else {
            // echo "Tidak ada pilihan untuk qty_order_rata.<br>";
        }

        // Tampilkan hasil untuk pilihan 2
        if (count($selected_pilihan2) > 0) {
            // echo "Pilihan 2 (Qty Order Tertinggi):<br>";
            foreach ($selected_pilihan2 as $kd_brg) {


                // Gunakan kd_brg untuk memastikan variabel POST yang sesuai digunakan
                $kd_supp = $_POST["kd_supp_$kd_brg"];
                $waktu_kirim_barang = $_POST["waktu_kirim_barang_$kd_brg"];
                // $waktu_kirim_supplier = $_POST["waktu_kirim_supplier_$kd_brg"];
                $current_order_rata = $_POST["qty_order_max_$kd_brg"];
                $tanggal_beli = date('Y-m-d'); // Tanggal pembelian hari ini


                // echo $kd_supp;
                // echo $waktu_kirim_supplier;

                // Mengambil harga dari terakhir pembelian/ penerimaan barang
                $query_harga =  "SELECT harga,Satuan1,qty_satuan1 FROM `barang` WHERE kd_brg = '$kd_brg'";
                $result_harga = mysqli_query($koneksi, $query_harga);
                $row_harga = $result_harga ? mysqli_fetch_assoc($result_harga) : [];
                $price = isset($row_harga['harga']) ? $row_harga['harga'] : 0;
                $satuan = isset($row_harga['Satuan1']) ? $row_harga['Satuan1'] : 'Pcs';
                $qtysatuan = isset($row_harga['qty_satuan1']) ? $row_harga['qty_satuan1'] : 1;



                // Cek apakah kombinasi kd_supp dan tgl_beli sudah ada dalam array
                if (!isset($supplier_info[$kd_supp][$tanggal_beli][$waktu_kirim_barang])) {
                    // Ambil kd_beli terakhir
                    $tgl = date('Y-m-d'); // Format lengkap YYYY-MM-DD
                    $tahun_bulan = date('ym', strtotime($tgl)); // Format YYMM

                    // Query untuk mencari kode pembelian terakhir di bulan yang sama
                    $query_last_po = mysqli_query($koneksi, "SELECT kd_beli FROM pembelian WHERE kd_beli LIKE 'PR-$tahun_bulan%' ORDER BY kd_beli DESC LIMIT 1");

                    if (mysqli_num_rows($query_last_po) > 0) {
                        // Jika sudah ada kode pembelian di bulan tersebut
                        $data_last_po = mysqli_fetch_assoc($query_last_po);
                        $last_kd_po = $data_last_po['kd_beli']; // Gunakan kd_beli sebagai referensi

                        // Ambil bagian nomor terakhir
                        $parts = explode('-', $last_kd_po);
                        $last_number = (int)$parts[2]; // Ambil bagian ketiga dari kode
                        $new_number = str_pad($last_number + 1, 5, '0', STR_PAD_LEFT);
                    } else {
                        // Jika belum ada kode pembelian di bulan tersebut
                        $new_number = "00001";
                    }

                    // Buat kode baru
                    $kd_beli = "PR-$tahun_bulan-$new_number";
                    $kd_po = "PO-$tahun_bulan-$new_number";


                    // Simpan informasi supplier berdasarkan kd_supp dan tgl_beli
                    $supplier_info[$kd_supp][$tanggal_beli][$waktu_kirim_barang] = [
                        'kd_beli' => $kd_beli,
                        'kd_po' => $kd_po
                    ];

                    // Masukkan data ke tabel pembelian
                    $query_insert_pembelian = "
                    INSERT INTO pembelian (kd_cus ,kd_beli, kd_supp, durasi_kirim, tgl_beli, kd_po, user_input, tujuan_kirim)
                    VALUES ('$kd_cus','$kd_beli', '$kd_supp', '$waktu_kirim_barang', '$tanggal_beli', '$kd_po' , '$employee', 8001)";
                    $result = mysqli_query($koneksi, $query_insert_pembelian);

                    if (!$result) {
                        die("Query error: " . mysqli_error($koneksi));
                    }
                } else {
                    // Gunakan kode beli dan kode PO yang sudah ada untuk kd_supp, tgl_beli, dan waktu_kirim_barang ini
                    $kd_beli = $supplier_info[$kd_supp][$tanggal_beli][$waktu_kirim_barang]['kd_beli'];
                    $kd_po = $supplier_info[$kd_supp][$tanggal_beli][$waktu_kirim_barang]['kd_po'];
                }


                $query = mysqli_query($koneksi, "SELECT max(urut) as urut_max FROM pembelian_detail WHERE kd_beli='$kd_beli' ");
                $data = mysqli_fetch_array($query);
                $urut = $data['urut_max'];
                $urut++;
                // // Masukkan data ke tabel pembelian_detail
                $query_insert_pembelian_detail = "
                INSERT INTO pembelian_detail (kd_beli, kd_brg, jml, price,satuan, jumlah_pcs, kd_po, urut)
                VALUES ('$kd_beli', '$kd_brg', '$current_order_rata','$price','$satuan', '$qtysatuan', '$kd_po','$urut' )";
                mysqli_query($koneksi, $query_insert_pembelian_detail);
            }
        } else {
            // echo "Tidak ada pilihan untuk qty_order_tertinggi.<br>";
        }

        // Tampilkan hasil untuk pilihan 2

        if (count($selected_pilihan3) > 0) {
            // echo "Pilihan 3 (berdasarkan minimum order):<br>";
            foreach ($selected_pilihan3 as $kd_brg) {


                // Gunakan kd_brg untuk memastikan variabel POST yang sesuai digunakan
                $kd_supp = $_POST["kd_supp_$kd_brg"];
                $waktu_kirim_barang = $_POST["waktu_kirim_barang_$kd_brg"];
                $current_order_rata = $_POST["minimum_order_$kd_brg"];
                $tanggal_beli = date('Y-m-d'); // Tanggal pembelian hari ini


                // echo $kd_supp;
                // echo $waktu_kirim_barang;

                // Mengambil harga dari terakhir pembelian/ penerimaan barang
                $query_harga =  "SELECT harga,Satuan1,qty_satuan1 FROM `barang` WHERE kd_brg = '$kd_brg'";
                $result_harga = mysqli_query($koneksi, $query_harga);
                $row_harga = $result_harga ? mysqli_fetch_assoc($result_harga) : [];
                $price = isset($row_harga['harga']) ? $row_harga['harga'] : 0;
                $satuan = isset($row_harga['Satuan1']) ? $row_harga['Satuan1'] : 'Pcs';
                $qtysatuan = isset($row_harga['qty_satuan1']) ? $row_harga['qty_satuan1'] : 1;



                // Cek apakah kombinasi kd_supp, tgl_beli, dan waktu_kirim_barang sudah ada dalam array
                if (!isset($supplier_info[$kd_supp][$tanggal_beli][$waktu_kirim_barang])) {
                    // Ambil kd_beli terakhir
                    $tgl = date('Y-m-d'); // Format lengkap YYYY-MM-DD
                    $tahun_bulan = date('ym', strtotime($tgl)); // Format YYMM

                    // Query untuk mencari kode pembelian terakhir di bulan yang sama
                    $query_last_po = mysqli_query($koneksi, "SELECT kd_beli FROM pembelian WHERE kd_beli LIKE 'PR-$tahun_bulan%' ORDER BY kd_beli DESC LIMIT 1");

                    if (mysqli_num_rows($query_last_po) > 0) {
                        // Jika sudah ada kode pembelian di bulan tersebut
                        $data_last_po = mysqli_fetch_assoc($query_last_po);
                        $last_kd_po = $data_last_po['kd_beli']; // Gunakan kd_beli sebagai referensi

                        // Ambil bagian nomor terakhir
                        $parts = explode('-', $last_kd_po);
                        $last_number = (int)$parts[2]; // Ambil bagian ketiga dari kode
                        $new_number = str_pad($last_number + 1, 5, '0', STR_PAD_LEFT);
                    } else {
                        // Jika belum ada kode pembelian di bulan tersebut
                        $new_number = "00001";
                    }

                    // Buat kode baru
                    $kd_beli = "PR-$tahun_bulan-$new_number";
                    $kd_po = "PO-$tahun_bulan-$new_number";


                    // Simpan informasi supplier berdasarkan kd_supp, tgl_beli, dan waktu_kirim_barang
                    $supplier_info[$kd_supp][$tanggal_beli][$waktu_kirim_barang] = [
                        'kd_beli' => $kd_beli,
                        'kd_po' => $kd_po
                    ];

                    // Masukkan data ke tabel pembelian
                    $query_insert_pembelian = "
                    INSERT INTO pembelian (kd_cus, kd_beli, kd_supp, durasi_kirim, tgl_beli, kd_po, user_input, tujuan_kirim)
                    VALUES ('$kd_cus', '$kd_beli', '$kd_supp', '$waktu_kirim_barang', '$tanggal_beli', '$kd_po', '$employee', 8001)";
                    $result = mysqli_query($koneksi, $query_insert_pembelian);

                    if (!$result) {
                        die("Query error: " . mysqli_error($koneksi));
                    }
                } else {
                    // Gunakan kode beli dan kode PO yang sudah ada untuk kd_supp, tgl_beli, dan waktu_kirim_barang ini
                    $kd_beli = $supplier_info[$kd_supp][$tanggal_beli][$waktu_kirim_barang]['kd_beli'];
                    $kd_po = $supplier_info[$kd_supp][$tanggal_beli][$waktu_kirim_barang]['kd_po'];
                }

                $query = mysqli_query($koneksi, "SELECT max(urut) as urut_max FROM pembelian_detail WHERE kd_beli='$kd_beli' ");
                $data = mysqli_fetch_array($query);
                $urut = $data['urut_max'];
                $urut++;

                // Masukkan data ke tabel pembelian_detail
                $query_insert_pembelian_detail = "
                INSERT INTO pembelian_detail (kd_beli, kd_brg, jml, price, satuan, jumlah_pcs, kd_po, urut)
                VALUES ('$kd_beli', '$kd_brg', '$current_order_rata', '$price', '$satuan', '$qtysatuan', '$kd_po', '$urut')";
                mysqli_query($koneksi, $query_insert_pembelian_detail);
            }
        } else {
            // echo "Tidak ada pilihan untuk qty_order_tertinggi.<br>";
        }
    }
}

echo "<script>alert('Data Berhasil Disimpan')</script>";
// echo "<script>window.history.back();</script>";
echo "<script>window.location.href='../../main.php?route=beli&act&ide=$employee&asal=beli';</script>";
