<?php
include '../../../../config/koneksi.php'; // Sesuaikan dengan file koneksi Anda
session_start();

if (!isset($_SESSION['login_hash'])) {
    die("Session tidak disetel.");
}

$login_hash = $_SESSION['login_hash'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && ($login_hash == 5 || $login_hash == 2)) {
    $tanggal_sekarang = date('Y-m-d');

    // Ambil no_invoice dan kode_perusahaan dari POST
    $no_invoice = isset($_POST['no_invoice']) ? $_POST['no_invoice'] : '';
    $kode_perusahaan = isset($_POST['kode_perusahaan']) ? $_POST['kode_perusahaan'] : '';

    // Simpan URL halaman view
    $redirect_url = 'main.php?route=invoicing_perusahaan_gelondongan'; // URL halaman yang ingin dituju

    // Variabel untuk mengumpulkan pesan
    $payment_success = false; // Tambahkan variabel untuk melacak kesuksesan pembayaran

    // Fungsi untuk mendapatkan nomor pembayaran berikutnya
    function getNextPaymentNumber($koneksi)
    {
        $today_date = date('Ymd');
        $query = "SELECT no_payment FROM payment WHERE no_payment LIKE 'PAY-$today_date-%' ORDER BY no_payment DESC LIMIT 1";
        $result = mysqli_query($koneksi, $query);
        $last_number = 0;

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $last_no_payment = $row['no_payment'];
            $last_number = (int)substr($last_no_payment, -4);
        }

        $next_number = str_pad($last_number + 1, 4, '0', STR_PAD_LEFT);
        return "PAY-$today_date-$next_number";
    }

    // Loop melalui setiap item yang dikirimkan
    foreach ($_POST['payment'] as $kode_pasien => $payments_by_date) {
        foreach ($payments_by_date as $tanggal => $jumlah_payment) {
            if (!empty($jumlah_payment)) {
                // Konversi format jumlah_payment dari 1.000,50 ke 1000.50
                $jumlah_payment = str_replace('.', '', $jumlah_payment); // Hapus titik
                $jumlah_payment = str_replace(',', '.', $jumlah_payment); // Ganti koma dengan titik

                // var_dump($kode_pasien);
                $tanggal = $_POST['tanggal'][$kode_pasien][$tanggal];
                // var_dump("Tanggal: $tanggal");
                // Buat no_payment secara otomatis
                $no_payment = getNextPaymentNumber($koneksi);

                // Insert data ke tabel payment
                $insert_payment = "INSERT INTO payment (no_payment, tanggal_payment, no_invoice, jumlah_payment, kode_pasien, insert_oleh,tanggal) VALUES ('$no_payment', '$tanggal_sekarang', '$no_invoice', '$jumlah_payment', '$kode_pasien', '$login_hash','$tanggal')";
                if (!mysqli_query($koneksi, $insert_payment)) {
                    die("Error on insert_payment: " . mysqli_error($koneksi));
                }

                // Insert data ke tabel payment_detail
                $insert_payment_detail = "INSERT INTO payment_detail (no_payment, tanggal_payment, kode_pasien, jumlah, insert_oleh) VALUES ('$no_payment', '$tanggal_sekarang', '$kode_pasien', '$jumlah_payment', '$login_hash')";
                if (!mysqli_query($koneksi, $insert_payment_detail)) {
                    die("Error on insert_payment_detail: " . mysqli_error($koneksi));
                }

                $payment_success = true; // Tandai pembayaran sebagai sukses

                // Hitung total pembayaran untuk invoice ini
                $total_payment_query = "SELECT SUM(jumlah_payment) as total_payment FROM payment WHERE no_invoice = '$no_invoice'";
                $total_payment_result = mysqli_query($koneksi, $total_payment_query);
                if ($total_payment_result && mysqli_num_rows($total_payment_result) > 0) {
                    $total_payment_row = mysqli_fetch_assoc($total_payment_result);
                    $total_payment = $total_payment_row['total_payment'];
                    // var_dump("Total Payment: $total_payment"); // Debug total payment
                } else {
                    continue; // Lanjut ke pasien berikutnya jika gagal
                }

                // Dapatkan total nilai dari invoice_perusahaan_detail
                $invoice_total_query = "SELECT SUM(nilai) as total_nilai, SUM(diskon) as total_diskon FROM invoice_perusahaan_detail WHERE no_invoice = '$no_invoice'";
                $invoice_total_result = mysqli_query($koneksi, $invoice_total_query);
                if ($invoice_total_result && mysqli_num_rows($invoice_total_result) > 0) {
                    $invoice_total_row = mysqli_fetch_assoc($invoice_total_result);
                    $invoice_total = $invoice_total_row['total_nilai'];
                    $total_diskon = $invoice_total_row['total_diskon'];
                    // var_dump("Invoice Total: $invoice_total"); // Debug invoice total
                    // var_dump("Total Diskon: $total_diskon"); // Debug total discount
                } else {
                    continue; // Lanjut ke pasien berikutnya jika gagal
                }

                // Kurangkan total nilai yang sudah dibayar dan diskon
                $kasir_total_query = "SELECT SUM(bayar_kasir) as total_dibayar_kasir FROM transaksi WHERE no_invoice = '$no_invoice'";
                $kasir_total_result = mysqli_query($koneksi, $kasir_total_query);
                if ($kasir_total_result && mysqli_num_rows($kasir_total_result) > 0) {
                    $kasir_total_row = mysqli_fetch_assoc($kasir_total_result);
                    $total_dibayar_kasir = $kasir_total_row['total_dibayar_kasir'];
                    // var_dump("Total Dibayar Kasir: $total_dibayar_kasir"); // Debug total paid by cashier
                } else {
                    continue; // Lanjut ke pasien berikutnya jika gagal
                }

                $total_nilai = $invoice_total - $total_dibayar_kasir - $total_diskon;
                // var_dump("Total Nilai (dikurangi dibayar_kasir dan diskon): $total_nilai"); // Debug total value

                // Tentukan status_payment
                if ($total_payment == 0) {
                    $status_payment = 0; // Belum dibayar
                } elseif ($total_payment < $total_nilai) {
                    $status_payment = 1; // Belum lunas
                } else {
                    $status_payment = 2; // Sudah lunas
                }

                // var_dump("Status Payment: $status_payment"); // Debug payment status

                // Update status_payment di tabel invoice_perusahaan
                $update_status = "UPDATE invoice_perusahaan SET status_payment = $status_payment WHERE no_invoice = '$no_invoice'";
                if (!mysqli_query($koneksi, $update_status)) {
                    die("Error on update_status: " . mysqli_error($koneksi));
                }
            }
        }
    }

    // Tampilkan pesan keberhasilan jika ada pembayaran yang berhasil
    echo "<script>";
    if ($payment_success) {
        echo "alert('Pembayaran berhasil disimpan.');";
    }
    echo "history.go(-1);</script>";
} else {
    die("Metode permintaan tidak valid atau izin tidak mencukupi.");
}
