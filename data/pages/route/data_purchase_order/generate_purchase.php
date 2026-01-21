<?php
session_start();
// Pastikan halaman ini hanya diakses setelah pengiriman form dari halaman sebelumnya
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sertakan file koneksi
    include '../../../../config/koneksi.php';
    $employee = $_SESSION['employee_number'];


    //     $selected_items = $_POST['selected_items'];
    //  echo "kode PURCHASE REQUEST YANG DIPILIH : ";
    //         print_r($selected_items);
    //         die();
    // Tangkap data yang dikirimkan dari form
    if (isset($_POST['selected_items']) && !empty($_POST['selected_items'])) {
        // Escape data untuk mencegah SQL injection
        $selected_items = $_POST['selected_items'];
        // echo "kode PURCHASE REQUEST YANG DIPILIH : ";
        // print_r($selected_items);
        // die();
        // Tanggal update
        $tanggal_update = date('Y-m-d');

        // Loop melalui item yang dipilih
        foreach ($selected_items as $selected) {
            list($kd_beli, $kd_po, $kd_supp) = explode('|', $selected);
            $kd_beli = mysqli_real_escape_string($koneksi, $kd_beli);
            $kd_po = mysqli_real_escape_string($koneksi, $kd_po);
            $kd_supp = mysqli_real_escape_string($koneksi, $kd_supp);
            // echo "kode PURCHASE REQUEST YANG DIPILIH : ";


            // print_r($kd_beli) ;
            // die();






            // Update status menjadi 1 di tabel stock_opname
            $query_update = "UPDATE pembelian 
                             SET status_pembelian = 2 , tgl_rilis = '$tanggal_update', user_input_rilis = '$employee'
                             WHERE kd_beli= '$kd_beli'";

            if (!mysqli_query($koneksi, $query_update)) {
                echo "Error: " . $query_update . "<br>" . mysqli_error($koneksi);
            }

            // Ambil tanggal hari ini dalam format Ymd
            $tanggal_hari_ini = date('Ymd');

            // Query untuk mengambil no_invoice terakhir yang di-generate pada hari ini
            $query_last_invoice = "
            SELECT no_invoice 
            FROM pembelian_invoice 
            WHERE no_invoice LIKE 'INV/$tanggal_hari_ini/%' 
            ORDER BY no_invoice DESC 
            LIMIT 1";

            $result_last_invoice = mysqli_query($koneksi, $query_last_invoice);
            if (!$result_last_invoice) {
                die("Query last invoice failed: " . mysqli_error($koneksi));
            }

            $row_last_invoice = $result_last_invoice ? mysqli_fetch_assoc($result_last_invoice) : [];

            if ($row_last_invoice) {
                // Ambil 4 digit terakhir dari no_invoice terakhir
                $last_invoice_number = (int)substr($row_last_invoice['no_invoice'], -4);
                // Tambahkan 1 ke nomor terakhir dan pad kiri dengan 0
                $new_invoice_number = str_pad($last_invoice_number + 1, 4, '0', STR_PAD_LEFT);
            } else {
                // Jika belum ada data untuk hari ini, mulai dari 0001
                $new_invoice_number = '0001';
            }

            // Bentuk no_invoice baru dengan format INV/tglhari_ini/000X
            $no_invoice = "INV/$tanggal_hari_ini/$new_invoice_number";
            // echo $query_update ;
            // die();

            // $query_insert_pembelian_invoice = "INSERT pembelian_invoice (no_invoice,tanggal_invoice,kd_po,kd_supp,status_payment,status_print,status_invoice)
            // VALUES ('$no_invoice', '$tanggal_update', '$kd_po', '$kd_supp' , 0,0,0 )";
            // if (!mysqli_query($koneksi, $query_insert_pembelian_invoice)) {
            //     echo "Error: " . $query_insert_pembelian_invoice . "<br>" . mysqli_error($koneksi);
            // }




            $query_select_pembelian_detail = "
            SELECT kd_brg, jml, price, disc, kd_po
            FROM pembelian_detail
            WHERE pembelian_detail.kd_beli = '$kd_beli'
        ";
            $result_pembelian_detail = mysqli_query($koneksi, $query_select_pembelian_detail);

            // Gunakan loop untuk mengambil semua baris hasil query
            while ($row_pembelian_detail = mysqli_fetch_assoc($result_pembelian_detail)) {
                // print_r($row_pembelian_detail); // Akan menampilkan setiap baris
                // Di sini, Anda bisa memasukkan logika insert invoice detail
                $kd_brg = $row_pembelian_detail['kd_brg'];
                $jml = $row_pembelian_detail['jml'];
                $price = $row_pembelian_detail['price'];
                $disc = $row_pembelian_detail['disc'];
                $nilai = $price * $jml; // Hitung nilai dari price * quantity

                // Query untuk memasukkan detail invoice
                //     $query_insert_pembelian_invoice_detail = "
                //     INSERT INTO pembelian_invoice_detail (no_invoice, kd_po, kd_brg, nilai, disc, jml_pcs)
                //     VALUES ('$no_invoice', '$kd_po', '$kd_brg', '$price', 0, '$jml')
                // ";

                //     if (!mysqli_query($koneksi, $query_insert_pembelian_invoice_detail)) {
                //         echo "Error: " . $query_insert_pembelian_invoice_detail . "<br>" . mysqli_error($koneksi);
                //     } 
            }
        }
        // die();


        echo "<script>
    alert('Data berhasil diupdate.');
    window.location = '../../main.php?route=po&act&ide={$_SESSION['employee_number']}';
    </script>";
    } else {
        echo "<script>alert('Tidak ada item yang dipilih.');</script>";
        echo "<script>history.go(-1)</script>";
    }

    // Tutup koneksi database (disediakan dalam koneksi.php)
    mysqli_close($koneksi);
} else {
    // Jika halaman diakses tanpa POST request, redirect atau tampilkan pesan kesalahan
    echo "<script>alert('Metode pengiriman tidak valid.');</script>";
    // echo "<script>history.go(-1)</script>";
}
