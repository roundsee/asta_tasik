<?php
include '../../../../config/koneksi.php';

session_start();

$employee = $_SESSION['employee_number'];
$query_kdcus = "SELECT kd_cus FROM user_login where employee_number = '$employee'";
$result_kd_cus = mysqli_query($koneksi, $query_kdcus);
$q1 = mysqli_fetch_array($result_kd_cus);
$kd_cus = $q1['kd_cus'] ?? null;


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
            // echo "Kode Barang: $kd_brg<br>";
            // echo "Nama Barang: " . htmlspecialchars($_POST["nama_barang_$kd_brg"]) . "<br>";
            // echo "Buffer: " . htmlspecialchars($_POST["buffer_$kd_brg"]) . "<br>";
            // echo "Stok Akhir: " . htmlspecialchars($_POST["stok_akhir_$kd_brg"]) . "<br>";
            // echo "Perhitungan Stok Akhir: " . htmlspecialchars($_POST["perhitungan_stok_akhir_$kd_brg"]) . "<br>";
            // echo "Rata Minggu I: " . htmlspecialchars($_POST["rata_minggu_I_$kd_brg"]) . "<br>";
            // echo "Rata Minggu II: " . htmlspecialchars($_POST["rata_minggu_II_$kd_brg"]) . "<br>";
            // echo "Rata Minggu III: " . htmlspecialchars($_POST["rata_minggu_III_$kd_brg"]) . "<br>";
            // echo "Rata Minggu IV: " . htmlspecialchars($_POST["rata_minggu_IV_$kd_brg"]) . "<br>";
            // echo "Max Rata Per Minggu: " . htmlspecialchars($_POST["max_rata_per_minggu_$kd_brg"]) . "<br>";
            // echo "Max Tertinggi Per Minggu: " . htmlspecialchars($_POST["max_tertinggi_perminggu_$kd_brg"]) . "<br>";
            // echo "Waktu Kirim Supplier: " . htmlspecialchars($_POST["waktu_kirim_supplier_$kd_brg"]) . "<br>";
            // echo "Kode Supplier: " . htmlspecialchars($_POST["kd_supp_$kd_brg"]) . "<br>";
            // echo "Qty Order Rata Rata: " . htmlspecialchars($_POST["qty_order_$kd_brg"]) . "<br>";
            // echo "<hr>";

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
                // $query_last_kd_beli = "SELECT kd_beli FROM pembelian ORDER BY kd_beli DESC LIMIT 1";
                // $result_last_kd_beli = mysqli_query($koneksi, $query_last_kd_beli);
                // $row_last_kd_beli = $result_last_kd_beli ? mysqli_fetch_assoc($result_last_kd_beli) : [];

                // if ($row_last_kd_beli) {
                //     $last_kd_beli = $row_last_kd_beli['kd_beli'];
                //     $last_number = (int)substr($last_kd_beli, -4); // Ambil 4 digit terakhir
                //     $new_number = str_pad($last_number + 1, 4, '0', STR_PAD_LEFT); // Tambahkan 1 dan pad kiri dengan 0
                // } else {
                //     $new_number = '0001'; // Jika belum ada data, mulai dari 0001
                // }
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

                // Bentuk format kd_beli dan kd_po
                // $kd_beli = "PR-" . $new_number;
                // $kd_po = "PO-" . $new_number;
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
                  VALUES ('$kd_cus','$kd_beli', '$kd_supp', '$waktu_kirim_barang', '$tanggal_beli', '$kd_po' , '$employee', 8001)";
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
            // echo "Kode Barang: $kd_brg<br>";
            // echo "Nama Barang: " . htmlspecialchars($_POST["nama_barang_$kd_brg"]) . "<br>";
            // echo "Buffer: " . htmlspecialchars($_POST["buffer_$kd_brg"]) . "<br>";
            // echo "Stok Akhir: " . htmlspecialchars($_POST["stok_akhir_$kd_brg"]) . "<br>";
            // echo "Perhitungan Stok Akhir: " . htmlspecialchars($_POST["perhitungan_stok_akhir_$kd_brg"]) . "<br>";
            // echo "Rata Minggu I: " . htmlspecialchars($_POST["rata_minggu_I_$kd_brg"]) . "<br>";
            // echo "Rata Minggu II: " . htmlspecialchars($_POST["rata_minggu_II_$kd_brg"]) . "<br>";
            // echo "Rata Minggu III: " . htmlspecialchars($_POST["rata_minggu_III_$kd_brg"]) . "<br>";
            // echo "Rata Minggu IV: " . htmlspecialchars($_POST["rata_minggu_IV_$kd_brg"]) . "<br>";
            // echo "Max Rata Per Minggu: " . htmlspecialchars($_POST["max_rata_per_minggu_$kd_brg"]) . "<br>";
            // echo "Max Tertinggi Per Minggu: " . htmlspecialchars($_POST["max_tertinggi_perminggu_$kd_brg"]) . "<br>";
            // echo "Waktu Kirim Supplier: " . htmlspecialchars($_POST["waktu_kirim_supplier_$kd_brg"]) . "<br>";
            // echo "Qty Order Tertinggi: " . htmlspecialchars($_POST["qty_order_max_$kd_brg"]) . "<br>";
            // echo "<hr>";

            // Gunakan kd_brg untuk memastikan variabel POST yang sesuai digunakan
            $kd_supp = $_POST["kd_supp_$kd_brg"];
            $waktu_kirim_barang = $_POST["waktu_kirim_barang_$kd_brg"];
            // $waktu_kirim_supplier = $_POST["waktu_kirim_supplier_$kd_brg"];
            $current_order_rata = $_POST["qty_order_max_$kd_brg"];
            $tanggal_beli = date('Y-m-d'); // Tanggal pembelian hari ini


            // echo $kd_supp;
            // echo $waktu_kirim_supplier;

            // Mengambil harga dari terakhir pembelian/ penerimaan barang
            $query_harga =  "SELECT harga,Satuan1,qty_satuan1 FROM `barang` WHERE kd_brg ='$kd_brg'";
            $result_harga = mysqli_query($koneksi, $query_harga);
            $row_harga = $result_harga ? mysqli_fetch_assoc($result_harga) : [];
            $price = isset($row_harga['harga']) ? $row_harga['harga'] : 0;
            $satuan = isset($row_harga['Satuan1']) ? $row_harga['Satuan1'] : 'Pcs';
            $qtysatuan = isset($row_harga['qty_satuan1']) ? $row_harga['qty_satuan1'] : 1;



            // Cek apakah kombinasi kd_supp dan tgl_beli sudah ada dalam array
            if (!isset($supplier_info[$kd_supp][$tanggal_beli][$waktu_kirim_barang])) {
                // Ambil kd_beli terakhir
                // $query_last_kd_beli = "SELECT kd_beli FROM pembelian ORDER BY kd_beli DESC LIMIT 1";
                // $result_last_kd_beli = mysqli_query($koneksi, $query_last_kd_beli);
                // $row_last_kd_beli = $result_last_kd_beli ? mysqli_fetch_assoc($result_last_kd_beli) : [];

                // if ($row_last_kd_beli) {
                //     $last_kd_beli = $row_last_kd_beli['kd_beli'];
                //     $last_number = (int)substr($last_kd_beli, -4); // Ambil 4 digit terakhir
                //     $new_number = str_pad($last_number + 1, 4, '0', STR_PAD_LEFT); // Tambahkan 1 dan pad kiri dengan 0
                // } else {
                //     $new_number = '0001'; // Jika belum ada data, mulai dari 0001
                // }
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

                // Bentuk format kd_beli dan kd_po
                // $kd_beli = "PR-" . $new_number;
                // $kd_po = "PO-" . $new_number;
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
                VALUES ('$kd_cus','$kd_beli', '$kd_supp', '$waktu_kirim_barang', '$tanggal_beli', '$kd_po' , '$employee', 8001)";
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
            mysqli_query($koneksi, $query_insert_pembelian_detail);
        }
    } else {
        // echo "Tidak ada pilihan untuk qty_order_tertinggi.<br>";
    }

    // Tampilkan hasil untuk pilihan 2

    if (count($selected_pilihan3) > 0) {
        // echo "Pilihan 3 (berdasarkan minimum order):<br>";
        foreach ($selected_pilihan3 as $kd_brg) {
            // echo "Kode Barang: $kd_brg<br>";
            // echo "Nama Barang: " . htmlspecialchars($_POST["nama_barang_$kd_brg"]) . "<br>";
            // echo "Buffer: " . htmlspecialchars($_POST["buffer_$kd_brg"]) . "<br>";
            // echo "Stok Akhir: " . htmlspecialchars($_POST["stok_akhir_$kd_brg"]) . "<br>";
            // echo "Perhitungan Stok Akhir: " . htmlspecialchars($_POST["perhitungan_stok_akhir_$kd_brg"]) . "<br>";
            // echo "Rata Minggu I: " . htmlspecialchars($_POST["rata_minggu_I_$kd_brg"]) . "<br>";
            // echo "Rata Minggu II: " . htmlspecialchars($_POST["rata_minggu_II_$kd_brg"]) . "<br>";
            // echo "Rata Minggu III: " . htmlspecialchars($_POST["rata_minggu_III_$kd_brg"]) . "<br>";
            // echo "Rata Minggu IV: " . htmlspecialchars($_POST["rata_minggu_IV_$kd_brg"]) . "<br>";
            // echo "Max Rata Per Minggu: " . htmlspecialchars($_POST["max_rata_per_minggu_$kd_brg"]) . "<br>";
            // echo "Max Tertinggi Per Minggu: " . htmlspecialchars($_POST["max_tertinggi_perminggu_$kd_brg"]) . "<br>";
            // echo "Waktu Kirim Supplier: " . htmlspecialchars($_POST["waktu_kirim_supplier_$kd_brg"]) . "<br>";
            // echo "Qty Order Tertinggi: " . htmlspecialchars($_POST["qty_order_max_$kd_brg"]) . "<br>";
            // echo "<hr>";

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
                // $query_last_kd_beli = "SELECT kd_beli FROM pembelian ORDER BY kd_beli DESC LIMIT 1";
                // $result_last_kd_beli = mysqli_query($koneksi, $query_last_kd_beli);
                // $row_last_kd_beli = $result_last_kd_beli ? mysqli_fetch_assoc($result_last_kd_beli) : [];

                // if ($row_last_kd_beli) {
                //     $last_kd_beli = $row_last_kd_beli['kd_beli'];
                //     $last_number = (int)substr($last_kd_beli, -4); // Ambil 4 digit terakhir
                //     $new_number = str_pad($last_number + 1, 4, '0', STR_PAD_LEFT); // Tambahkan 1 dan pad kiri dengan 0
                // } else {
                //     $new_number = '0001'; // Jika belum ada data, mulai dari 0001
                // }
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


                // Bentuk format kd_beli dan kd_po
                // $kd_beli = "PR-" . $new_number;
                // $kd_po = "PO-" . $new_number;
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

echo "<script>alert('Data Berhasil Disimpan')</script>";
// // echo "<script>window.history.back();</script>";
echo "<script>window.location.href='../../main.php?route=beli&act&ide=$employee&asal=beli';</script>";
