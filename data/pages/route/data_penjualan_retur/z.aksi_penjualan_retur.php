<?php
include '../../../../config/koneksi.php'; // Koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // echo "<pre>";

    $faktur = $_POST['faktur'];
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
    // echo "Generated kd_retur: $kd_retur\n";

    if (!empty($_POST['kd_brg']) && is_array($_POST['kd_brg'])) {
        $jumlah_data = count($_POST['kd_brg']);
        // echo "Jumlah Data: $jumlah_data\n";

        for ($i = 0; $i < $jumlah_data; $i++) {
            $kd_brg = $_POST['kd_brg'][$i];
            $nama_barang = $_POST['nama_barang'][$i];
            $jumlah_retur = $_POST['jumlah_retur'][$i];

            if ($jumlah_retur > 0) {
                $harga = str_replace(".", "", $_POST['harga'][$i]); // Hilangkan titik dari format harga
                $qty_satuan = $_POST['qty_satuan'][$i];
                $satuan = $_POST['satuan'][$i];
                $kd_cus = $_POST['kd_cus'][$i];
                $banyak = $_POST['banyak'][$i];
                $subtotal = $jumlah_retur * $qty_satuan; // Perbaikan perhitungan subtotal
                $banyak_update = $banyak - $jumlah_retur;

                // echo "Barang: $kd_brg - $nama_barang | Harga: $harga | Banyak: $banyak | Subtotal: $subtotal\n";

                // Simpan data retur ke tabel retur_penjualan
                $query = "INSERT INTO retur_penjualan (kd_retur, faktur, tanggal_retur, kd_brg, harga, banyak, satuan, subtotal, total_retur, kd_cus, login_hash)
                          VALUES ('$kd_retur', '$faktur', '$tanggal_retur', '$kd_brg', '$harga', '$banyak', '$satuan', '$subtotal', '$jumlah_retur', '$kd_cus', '$username')";

                // echo "Executing Query: $query\n"; // Debugging Query

                $result = mysqli_query($koneksi, $query);
                if (!$result) {
                    die("Error saat menyimpan retur: " . mysqli_error($koneksi));
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
                // **UPDATE PENJUALAN (Kurangi jumlah barang yang diretur)**
                $query_penjualan = "SELECT banyak AS banyak_terjual FROM jualdetil WHERE faktur = '$faktur' AND kd_brg = '$kd_brg' AND kd_cus='$kd_cus'";
                $result_penjualan = mysqli_query($koneksi, $query_penjualan);

                if (!$result_penjualan) {
                    die("Error Query Penjualan: " . mysqli_error($koneksi));
                }

                if (mysqli_num_rows($result_penjualan) > 0) {
                    $row_penjualan = mysqli_fetch_assoc($result_penjualan);
                    $jumlah_terjual = $row_penjualan['banyak_terjual'];

                    // Pastikan jumlah retur tidak melebihi jumlah terjual
                    if ($jumlah_terjual >= $jumlah_retur) {
                        $jumlah_sisa = $jumlah_terjual - $jumlah_retur;
                        $harga_update = $jumlah_sisa * $harga;

                        // Update jumlah barang dalam tabel penjualan
                        $query_update_penjualan = "UPDATE jualdetil SET banyak = '$jumlah_sisa',jumlah='$harga_update' WHERE faktur = '$faktur' AND kd_cus='$kd_cus' AND kd_brg = '$kd_brg'";
                        $result_update_penjualan = mysqli_query($koneksi, $query_update_penjualan);

                        if (!$result_update_penjualan) {
                            die("Error Update Penjualan: " . mysqli_error($koneksi));
                        }

                        // echo "Jumlah barang di penjualan dikurangi: kd_brg: $kd_brg, faktur: $faktur,  jumlah baru: $jumlah_sisa\n";
                    } else {
                        // echo "Jumlah retur lebih besar dari jumlah terjual! Retur dibatalkan untuk kd_brg: $kd_brg.\n";
                    }
                } else {
                    // echo "Data penjualan tidak ditemukan untuk kd_brg: $kd_brg, faktur: $faktur, urut: $no_urut.\n";
                }
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
