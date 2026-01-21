<?php
echo "Hallo ini mutasi Stok<br>";
// Misalnya, $employee harus diisi dengan nilai
$employee = "WG0214";
echo $employee . "<br>";

// Loop untuk memasukkan data ke dalam tabel penerimaan_barang
foreach ($kd_brg as $index => $kode_barang) {
    if ($kode_barang == $kd_brg_query) {
        $qty_terima_value = isset($qty_terima[$index]) ? $qty_terima[$index] : 0;
        // Ambil data terakhir dari mutasi_stok
        $query_get_last_data = "SELECT qty_akhir, harga_akhir, nilai_akhir, qty_beli_retur, harga_beli_retur, nilai_beli_retur, stok_opname, nilai_opname
                        FROM mutasi_stok 
                        WHERE kd_brg = '$kode_barang' 
                        ORDER BY tgl DESC 
                        LIMIT 1";

        $result_last_data = mysqli_query($koneksi, $query_get_last_data);

        if ($result_last_data && mysqli_num_rows($result_last_data) > 0) {
            $row_last_data = mysqli_fetch_assoc($result_last_data);

            // Cek apakah stok_opname dan nilai_opname 0 atau null
            if (!empty($row_last_data['stok_opname']) && $row_last_data['stok_opname'] != 0) {
                $qty_awal = $row_last_data['stok_opname'];  // Gunakan stok_opname jika tidak 0 atau null
            } else {
                $qty_awal = $row_last_data['qty_akhir'];  // Gunakan qty_akhir jika stok_opname 0 atau null
            }

            if (!empty($row_last_data['nilai_opname']) && $row_last_data['nilai_opname'] != 0) {
                $nilai_awal = $row_last_data['nilai_opname'];  // Gunakan nilai_opname jika tidak 0 atau null
            } else {
                $nilai_awal = $row_last_data['nilai_akhir'];  // Gunakan nilai_akhir jika nilai_opname 0 atau null
            }

            $harga_awal = $row_last_data['harga_akhir'];
            $qty_beli_retur = intval($row_last_data['qty_beli_retur']);
            $harga_beli_retur = intval($row_last_data['harga_beli_retur']);
            $nilai_beli_retur = intval($row_last_data['nilai_beli_retur']);

            // Menampilkan data dari mutasi_stok
            echo "Data dari mutasi_stok:<br>";
            echo "qty_awal: " . $qty_awal . "<br>";
            echo "harga_awal: " . $harga_awal . "<br>";
            echo "nilai_awal: " . $nilai_awal . "<br>";
        } else {
            // Jika tidak ada data di mutasi_stok
            $qty_awal = 0;
            $harga_awal = 0;
            $nilai_awal = 0;
            $qty_beli_retur = 0;
            $harga_beli_retur = 0;
            $nilai_beli_retur = 0;
            echo "Tidak ada data dari mutasi_stok untuk kd_brg: " . $kode_barang . "<br>";
        }

        // Query untuk mengambil price dan disc dari pembelian_detail berdasarkan kd_brg dan tanggal terbaru
        $query_get_pembelian_detail = "SELECT price, disc, kd_po 
                                       FROM pembelian_detail 
                                       WHERE kd_po = '$kd_po' 
                                      ";

        $result_pembelian_detail = mysqli_query($koneksi, $query_get_pembelian_detail);

        if ($result_pembelian_detail && mysqli_num_rows($result_pembelian_detail) > 0) {
            $row_pembelian_detail = mysqli_fetch_assoc($result_pembelian_detail);
            $price = intval($row_pembelian_detail['price']);
            $disc = intval($row_pembelian_detail['disc']);
            $kd_po = $row_pembelian_detail['kd_po'];

            // Menampilkan data dari pembelian_detail
            echo "<br>Data dari pembelian_detail:<br>";
            echo "price: " . $price . "<br>";
            echo "disc: " . $disc . "<br>";
            echo "kd_po: " . $kd_po . "<br>";

            // Query untuk mengambil tarif_ppn dari pembelian berdasarkan kd_po
            $query_get_pembelian = "SELECT tarif_ppn 
                                    FROM pembelian 
                                    WHERE kd_po = '$kd_po'";

            $result_pembelian = mysqli_query($koneksi, $query_get_pembelian);

            if ($result_pembelian && mysqli_num_rows($result_pembelian) > 0) {
                $row_pembelian = mysqli_fetch_assoc($result_pembelian);
                $tarif_ppn = intval($row_pembelian['tarif_ppn']);
                echo "<br>Data dari pembelian:<br>";
                echo "tarif_ppn: " . $tarif_ppn . "%<br>";
            } else {
                $tarif_ppn = 0; // Default jika tidak ada data
                echo "<br>Tidak ada data tarif_ppn untuk kd_po: " . $kd_po . "<br>";
            }
        } else {
            $price = 0;
            $disc = 0;
            $tarif_ppn = 0;
            echo "<br>Tidak ada data dari pembelian_detail untuk kd_brg: " . $kode_barang . "<br>";
        }


        $harga_beli = ($qty_terima_value * $price) * $tarif_ppn / 100;
        $nilai_beli = $price * $qty_terima_value;
        $harga_rata = ($nilai_awal + $nilai_beli + $nilai_beli_retur) / ($qty_awal + $qty_terima_value + $qty_beli_retur);
        $qty_akhir = $qty_awal + $qty_terima_value;
        $nilai_akhir = $harga_rata * $qty_akhir;
        $harga_akhir = $nilai_akhir / $qty_akhir;

        // Masukkan data ke dalam mutasi_stok
        $query_insert_penerimaan_barang = "INSERT INTO mutasi_stok (tgl, kd_brg, satuan, qty_awal, harga_awal, nilai_awal, qty_beli, harga_beli, nilai_beli, harga_rata, qty_akhir, harga_akhir, nilai_akhir) 
                                           VALUES ('$tanggal_sekarang', '$kode_barang', 'Pcs', '$qty_awal', '$harga_awal', '$nilai_awal', '$qty_terima_value', '$price', '$nilai_beli', '$harga_rata', '$qty_akhir', '$harga_akhir', '$nilai_akhir')";

        var_dump($query_insert_penerimaan_barang);
        // Eksekusi query insert
        $sql1 = mysqli_query($koneksi, $query_insert_penerimaan_barang);

        if ($sql1) {
            echo "<br>Data berhasil dimasukkan ke mutasi_stok untuk kd_brg: " . $kode_barang . "<br>";
        } else {
            echo "<br>Gagal memasukkan data ke mutasi_stok untuk kd_brg: " . $kode_barang . "<br>";
        }

        // Update quantity ke master barang (hapus comment jika ingin menggunakan ini)
        // $query_update_barang = "UPDATE barang SET Quantity = Quantity + '$qty_terima_value' WHERE kd_brg = '$kode_barang'";
        // $result_query_update_barang = mysqli_query($koneksi, $query_update_barang);
    }
}
