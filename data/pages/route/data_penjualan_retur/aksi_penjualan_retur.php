<?php
include '../../../../config/koneksi.php'; // Koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // echo "<pre>";

    $faktur = $_POST['faktur'];
    // $query_barang = "SELECT b_paking FROM penjualan WHERE faktur = '$faktur'";
    // $result_barang = mysqli_query($koneksi, $query_barang);

    // if (mysqli_num_rows($result_barang) > 0) {
    //     $row = mysqli_fetch_assoc($result_barang);
    //     if ($row['b_paking'] != 1) {
    //         $lokasi = 8001;
    //     } else {
    //         $lokasi = 1316;
    //     }
    // }
    $tanggal_retur = $_POST['tanggal_retur']; // Ambil tanggal retur

    // echo "Faktur: $faktur\n";
    // echo "Tanggal Retur: $tanggal_retur\n";

    // Format tanggal untuk kd_retur
    $tanggalKode = date("Ymd", strtotime($tanggal_retur));
    // echo "Tanggal Kode: $tanggalKode\n";

    // Ambil employee_number dari sesi
    session_start();
    $employee = $_SESSION['employee_number'];
    // echo "Employee Number: $employee\n";

    // Ambil username berdasarkan employee_number
    $query_kdcus = mysqli_query($koneksi, "SELECT username FROM user_login WHERE employee_number = '$employee'");
    if (!$query_kdcus) {
        die("Error Query Username: " . mysqli_error($koneksi));
    }

    $q1 = mysqli_fetch_assoc($query_kdcus);
    $username = $q1['username']; // Username pengguna
    // echo "Username: $username\n";

    // Generate kd_retur otomatis
    $query_last = mysqli_query($koneksi, "SELECT kd_retur FROM retur_penjualan WHERE kd_retur LIKE 'PR-$tanggalKode-%' ORDER BY kd_retur DESC LIMIT 1");
    if (!$query_last) {
        die("Error Query kd_retur: " . mysqli_error($koneksi));
    }

    $last_kd_retur = mysqli_fetch_assoc($query_last);
    if ($last_kd_retur) {
        $last_number = (int)substr($last_kd_retur['kd_retur'], -4); // Ambil 4 digit terakhir
        $new_number = str_pad($last_number + 1, 4, '0', STR_PAD_LEFT); // Tambah 1 dan tetap 4 digit
    } else {
        $new_number = "0001"; // Jika belum ada, mulai dari 0001
    }

    $kd_retur = "PR-$tanggalKode-$new_number";

    // **Tambahkan Kode Voucher**
    $tanggalVoucher = date('Ymd'); // Format tanggal YYYYMMDD

    // Ambil nomor terakhir hari ini dari database
    $query_voucher = mysqli_query($koneksi, "SELECT no_voucher FROM retur_penjualan WHERE no_voucher LIKE 'VCR-$tanggalVoucher%' ORDER BY no_voucher DESC LIMIT 1");
    $last_voucher = mysqli_fetch_assoc($query_voucher);

    if ($last_voucher) {
        $last_voucher_number = (int)substr($last_voucher['no_voucher'], -4); // Ambil 4 digit terakhir
        $new_voucher_number = str_pad($last_voucher_number + 1, 4, '0', STR_PAD_LEFT); // Tambah 1 dan tetap 4 digit
    } else {
        $new_voucher_number = "0001"; // Jika belum ada, mulai dari 0001
    }

    $kode_voucher = "VCR-$tanggalVoucher-$new_voucher_number";
    // echo "Generated kd_retur: $kd_retur\n";

    if (!empty($_POST['kd_brg']) && is_array($_POST['kd_brg'])) {
        $jumlah_data = count($_POST['kd_brg']);
        $tgl = date('Y-m-d');

        // echo "Jumlah Data: $jumlah_data\n";

        foreach ($_POST['kd_brg'] as $i => $kd_brg) {
            // $kd_brg = $_POST['kd_brg'][$i];
            $nama_barang = $_POST['nama_barang'][$i];
            $jumlah_retur = $_POST['jumlah_retur'][$i];

            if ($jumlah_retur > 0) {
                $harga = str_replace(".", "", $_POST['harga'][$i]); // Hilangkan titik dari format harga
                $qty_satuan = $_POST['qty_satuan'][$i];
                $satuan = $_POST['satuan'][$i];
                $kd_cus = $_POST['kd_cus'][$i];
                $banyak = $_POST['banyak'][$i];
                $banyak_awal_faktur = $_POST['banyak_awal_faktur'][$i];

                $jumlah_harga =  str_replace(".", "", $_POST['jumlah'][$i]);
                $harga_satuan_baru = $jumlah_harga / $banyak_awal_faktur;
                $harga_retur_baru = $harga_satuan_baru * $jumlah_retur;
                $subtotal = $jumlah_retur * $qty_satuan; // Perbaikan perhitungan subtotal
                $banyak_update = $banyak - $jumlah_retur;
                $harga_retur = $harga * $jumlah_retur;

                // echo "Barang: $kd_brg - $nama_barang | Harga: $harga | Banyak: $banyak | Subtotal: $subtotal\n";

                // Simpan data retur ke tabel retur_penjualan
                $query = "INSERT INTO retur_penjualan (kd_retur, faktur, tanggal_retur, kd_brg, harga, banyak, satuan, subtotal, total_retur, kd_cus, login_hash,no_voucher)
                          VALUES ('$kd_retur', '$faktur', '$tanggal_retur', '$kd_brg', '$harga_satuan_baru', '$banyak', '$satuan', '$subtotal', '$jumlah_retur', '$kd_cus', '$username','$kode_voucher')";

                // echo "Executing Query: $query\n"; // Debugging Query

                $result = mysqli_query($koneksi, $query);
                if (!$result) {
                    die("Error saat menyimpan retur: " . mysqli_error($koneksi));
                }
                $query_voucher = "INSERT INTO voucher(kd_voucher,faktur,tanggal_voucher,nilai,harga_pcs)
                VALUE ('$kode_voucher','$faktur','$tanggalVoucher','$harga_retur_baru','$harga_satuan_baru')";


                $result_voucher = mysqli_query($koneksi, $query_voucher);
                if (!$result_voucher) {
                    die("Error saat menyimpan vocher: " . mysqli_error($koneksi));
                }
                // **UPDATE INVENTORY**
                // Cek apakah barang sudah ada di inventory berdasarkan kd_brg dan kd_cus
                $query_cek = "SELECT stok FROM inventory WHERE kd_brg = '$kd_brg' AND kd_cus = '$kd_cus'";
                $result_cek = mysqli_query($koneksi, $query_cek);

                if (!$result_cek) {
                    die("Error Query Cek Inventory: " . mysqli_error($koneksi));
                }

                if (mysqli_num_rows($result_cek) > 0) {
                    // Jika barang sudah ada, update jumlahnya
                    $row = mysqli_fetch_assoc($result_cek);
                    $jumlah_sekarang = $row['stok'];
                    $jumlah_baru = $jumlah_sekarang + $subtotal;

                    $query_update = "UPDATE inventory SET stok = '$jumlah_baru' WHERE kd_brg = '$kd_brg' AND kd_cus = '$kd_cus'";
                    $result_update = mysqli_query($koneksi, $query_update);

                    if (!$result_update) {
                        die("Error Update Inventory: " . mysqli_error($koneksi));
                    }

                    // echo "Inventory diperbarui untuk kd_brg: $kd_brg, kd_cus: $kd_cus, jumlah baru: $jumlah_baru\n";
                } else {
                    // Jika barang belum ada, insert baru
                    $query_insert = "INSERT INTO inventory (kd_brg, kd_cus, stok) VALUES ('$kd_brg', '$kd_cus', '$subtotal')";
                    $result_insert = mysqli_query($koneksi, $query_insert);

                    if (!$result_insert) {
                        die("Error Insert Inventory: " . mysqli_error($koneksi));
                    }

                    // echo "Inventory baru ditambahkan untuk kd_brg: $kd_brg, kd_cus: $kd_cus, jumlah: $subtotal\n";
                }
                // Mutasi Stock
                $query_check = "SELECT kd_cus FROM mutasi_stok WHERE tgl = '$tgl' AND kd_cus = '$kd_cus' AND kd_brg = '$kd_brg'";
                $result_check = mysqli_query($koneksi, $query_check);

                if (mysqli_num_rows($result_check) > 0) {
                    // Update jika data sudah ada
                    $query_update = "UPDATE mutasi_stok SET 
                        qt_retur_jual = qt_retur_jual + $subtotal,
                        nilai_retur_jual = nilai_retur_jual + (harga_rata * $subtotal),
                        qt_tersedia = qt_tersedia + $subtotal,
                        nilai_tersedia = nilai_tersedia + (harga_rata * $subtotal) ,
                        harga_rata = CASE 
                                     WHEN qt_tersedia > 0 THEN nilai_tersedia / qt_tersedia
                                     ELSE $harga
                                     END,                          
                        hpp_jual = CASE 
                                     WHEN qt_tersedia > 0 THEN (nilai_tersedia / qt_tersedia) * qt_jual
                                     ELSE $harga * qt_jual
                                     END,
                        qt_akhir = qt_akhir + $subtotal,
                        nilai_akhir = CASE 
                                     WHEN qt_tersedia > 0 THEN (nilai_tersedia / qt_tersedia) * qt_akhir
                                     ELSE $harga * qt_akhir
                                     END
                    WHERE tgl = '$tgl' AND kd_cus = '$kd_cus' AND kd_brg = '$kd_brg'";

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
                    stok_opname, nilai_opname, harga_rata       
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
                        $nilai_hpp_rata2 = $row_awal['harga_rata'];
                    } else {
                        $nilai_awal = 0;
                        $qty_awal = 0;
                        $stok_opname = 0;
                        $nilai_opname = 0;
                        $nilai_hpp_rata2 = $harga_retur;
                    }

                    // Tentukan nilai qty_awal
                    $qty_awal = $stok_opname != 0 ? $stok_opname : $qty_awal;
                    $nilai_awal = $nilai_opname != 0 ? $nilai_opname : $nilai_awal;
                    $nilai_awal = is_numeric($nilai_awal) ? $nilai_awal : 0;
                    $qty_awal = is_numeric($qty_awal) ? $qty_awal : 0;
                    $qt_tersedia = $qty_awal + $subtotal;
                    $nilai_tersedia = $nilai_awal + ($nilai_hpp_rata2 * $subtotal);

                    if ($qt_tersedia > 0) {
                        $harga_rata_sebelumnya = $nilai_tersedia / $qt_tersedia;
                    } else {
                        $harga_rata_sebelumnya = $nilai_hpp_rata2;
                    }
                    $nilai_retur_baru = $harga_rata_sebelumnya * $subtotal;
                    // Insert data baru
                    $query_insert = "INSERT INTO mutasi_stok 
                    (tgl, qty_awal,nilai_awal,qt_retur_jual, nilai_retur_jual, qt_tersedia, nilai_tersedia,  
                    harga_rata , kd_cus, kd_brg, satuan,
                    qt_akhir, nilai_akhir) VALUES (
                    '$tgl',
                    '$qty_awal',
                    '$nilai_awal',
                    '$subtotal',
                    '$nilai_retur_baru',
                    '$qt_tersedia',
                    '$nilai_tersedia',
                    '$harga_rata_sebelumnya',
                    '$kd_cus',
                    '$kd_brg',
                    'Pcs',
                    '$qt_tersedia',
                    '$nilai_tersedia'
                )";
                    $result_insert = mysqli_query($koneksi, $query_insert);
                    if (!$result_insert) {
                        die("Query insert ke mutasi_semua gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
                    }
                }


                // // **UPDATE PENJUALAN (Kurangi jumlah barang yang diretur)**
                // $query_penjualan = "SELECT banyak AS banyak_terjual FROM jualdetil WHERE faktur = '$faktur' AND kd_brg = '$kd_brg' AND kd_cus='$kd_cus'";
                // $result_penjualan = mysqli_query($koneksi, $query_penjualan);

                // if (!$result_penjualan) {
                //     die("Error Query Penjualan: " . mysqli_error($koneksi));
                // }

                // if (mysqli_num_rows($result_penjualan) > 0) {
                //     $row_penjualan = mysqli_fetch_assoc($result_penjualan);
                //     $jumlah_terjual = $row_penjualan['banyak_terjual'];

                //     // Pastikan jumlah retur tidak melebihi jumlah terjual
                //     if ($jumlah_terjual >= $jumlah_retur) {
                //         $jumlah_sisa = $jumlah_terjual - $jumlah_retur;
                //         $harga_update = $jumlah_sisa * $harga;

                //         // Update jumlah barang dalam tabel penjualan
                //         $query_update_penjualan = "UPDATE jualdetil SET banyak = '$jumlah_sisa',jumlah='$harga_update' WHERE faktur = '$faktur' AND kd_cus='$kd_cus' AND kd_brg = '$kd_brg'";
                //         $result_update_penjualan = mysqli_query($koneksi, $query_update_penjualan);

                //         if (!$result_update_penjualan) {
                //             die("Error Update Penjualan: " . mysqli_error($koneksi));
                //         }

                //         // echo "Jumlah barang di penjualan dikurangi: kd_brg: $kd_brg, faktur: $faktur,  jumlah baru: $jumlah_sisa\n";
                //     } else {
                //         // echo "Jumlah retur lebih besar dari jumlah terjual! Retur dibatalkan untuk kd_brg: $kd_brg.\n";
                //     }
                // } else {
                //     // echo "Data penjualan tidak ditemukan untuk kd_brg: $kd_brg, faktur: $faktur, urut: $no_urut.\n";
                // }
            }
        }

        // echo "Retur berhasil diproses oleh $username! Kode Retur: $kd_retur\n";
        // echo "</pre>";
        echo "<script>alert('Retur berhasil diproses oleh $username! Kode Retur: $kd_retur');</script>";
        echo "<script>window.location='../../main.php?route=penjualan_retur_detail&act&id=$kd_retur'</script>";
    } else {
        echo "<script>alert('Tidak ada barang yang dipilih untuk diretur!'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Akses tidak diizinkan!'); window.history.back();</script>";
}
