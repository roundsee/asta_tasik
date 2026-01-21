<?php
// Pastikan halaman ini hanya diakses setelah pengiriman form dari halaman sebelumnya
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sertakan file koneksi
    include '../../../../config/koneksi.php';

    // Fungsi untuk menghasilkan nomor invoice dengan format yang diinginkan
    function generateInvoiceNumber($koneksi)
    {
        date_default_timezone_set('Asia/Jakarta');
        $tahun_sekarang = date('Y');
        $bulan_romawi = convertToRoman(date('n'));

        // Ambil nomor urut terakhir dari database
        $query_get_last_invoice = "SELECT no_invoice FROM invoice WHERE no_invoice LIKE '%/DIR/INV/RSUSMC/$bulan_romawi/$tahun_sekarang%' ORDER BY no_invoice DESC LIMIT 1";
        $result_last_invoice = mysqli_query($koneksi, $query_get_last_invoice);

        if ($result_last_invoice && mysqli_num_rows($result_last_invoice) > 0) {
            $row_last_invoice = mysqli_fetch_assoc($result_last_invoice);
            $last_invoice = $row_last_invoice['no_invoice'];

            // Ambil nomor urut dari string
            $parts = explode('/', $last_invoice);
            $last_sequence = (int)$parts[0]; // Mengambil bagian pertama dari string sebagai nomor urut
        } else {
            $last_sequence = 0;
        }

        // Generate nomor urut baru
        $nomor_urut = str_pad($last_sequence + 1, 4, '0', STR_PAD_LEFT);

        return "$nomor_urut/DIR/INV/RSUSMC/$bulan_romawi/$tahun_sekarang";
    }

    function convertToRoman($month)
    {
        $map = [
            1 => 'I',
            2 => 'II',
            3 => 'III',
            4 => 'IV',
            5 => 'V',
            6 => 'VI',
            7 => 'VII',
            8 => 'VIII',
            9 => 'IX',
            10 => 'X',
            11 => 'XI',
            12 => 'XII'
        ];

        return $map[$month];
    }

    // Tangkap data yang dikirimkan dari form
    if (isset($_POST['selected_patient']) && !empty($_POST['selected_patient'])) {
        // Escape data untuk mencegah SQL injection
        $selected_patients = $_POST['selected_patient'];

        // Tanggal invoice
        $tanggal_invoice = date('Y-m-d');

        // Variabel untuk tgl_awal, tgl_akhir, dan filter
        $tgl_awal = mysqli_real_escape_string($koneksi, $_GET['tgl_awal']);
        $tgl_akhir = mysqli_real_escape_string($koneksi, $_GET['tgl_akhir']);
        $filter = mysqli_real_escape_string($koneksi, $_GET['filter']);

        foreach ($selected_patients as $selected) {
            // Generate nomor invoice untuk setiap pasien
            $no_invoice = generateInvoiceNumber($koneksi);

            list($kode_pasien, $tanggal) = explode('|', $selected);
            $kode_pasien = mysqli_real_escape_string($koneksi, $kode_pasien);
            $tanggal = mysqli_real_escape_string($koneksi, $tanggal);

            // Query untuk mendapatkan kode perusahaan berdasarkan kode pasien dan tanggal
            $query_get_kode_perusahaan = "SELECT DISTINCT kode_asuransi, kode_pasien, no_card 
                                          FROM transaksi 
                                          WHERE kode_pasien = '$kode_pasien' 
                                          AND tanggal = '$tanggal'";

            $result_kode_perusahaan = mysqli_query($koneksi, $query_get_kode_perusahaan);

            // Debugging: Periksa apakah query berhasil dan apakah ada data yang ditemukan
            if ($result_kode_perusahaan && mysqli_num_rows($result_kode_perusahaan) > 0) {
                $row_kode_perusahaan = mysqli_fetch_assoc($result_kode_perusahaan);
                $kode_perusahaan = $row_kode_perusahaan['kode_asuransi'];
                $no_card = $row_kode_perusahaan['no_card'];
                $no_pasien = $row_kode_perusahaan['kode_pasien'];

                // Masukkan entri ke tabel invoice (satu kali)
                $query_insert_invoice = "INSERT INTO invoice (no_invoice, tanggal_invoice, kode_perusahaan, kode_pasien) 
                                         VALUES ('$no_invoice', '$tanggal_invoice', '$kode_perusahaan', '$kode_pasien')";
                if (mysqli_query($koneksi, $query_insert_invoice)) {
                    // Debugging
                    // echo "Kode Perusahaan: $kode_perusahaan<br>";
                    // echo "No Card: $no_card<br>";
                    // echo "No Pasien: $no_pasien<br>";

                    // Lakukan INSERT INTO ke tabel invoice_detail
                    $query_detail = "SELECT `group`, nilai, tindakan
                                        FROM transaksi_detail 
                                        WHERE kode_pasien = '$kode_pasien' 
                                        AND tanggal = '$tanggal'";

                    $result_detail = mysqli_query($koneksi, $query_detail);
                    if ($result_detail) {
                        while ($row = mysqli_fetch_assoc($result_detail)) {
                            $group = $row['group'];
                            $nilai_item = $row['nilai'];
                            $tindakan = $row['tindakan'];

                            // Insert into invoice_detail
                            $query_insert_detail = "INSERT INTO invoice_detail (no_invoice, item, nilai, tanggal, no_card, tindakan) 
                                                    VALUES ('$no_invoice', '$group', '$nilai_item', '$tanggal', '$no_card', '$tindakan')";
                            if (!mysqli_query($koneksi, $query_insert_detail)) {
                                echo "Error: " . $query_insert_detail . "<br>" . mysqli_error($koneksi);
                            }
                        }

                        // Setelah berhasil INSERT INTO ke invoice_detail, lakukan UPDATE ke tabel transaksi
                        $query_update = "UPDATE transaksi 
                                        SET no_invoice = '$no_invoice', tanggal_invoice = '$tanggal_invoice', status_print = 1
                                        WHERE kode_pasien = '$kode_pasien' 
                                        AND tanggal = '$tanggal'
                                        AND kode_asuransi = '$kode_perusahaan'"; // Update berdasarkan kode_asuransi yang didapatkan

                        if (!mysqli_query($koneksi, $query_update)) {
                            echo "Error: " . $query_update . "<br>" . mysqli_error($koneksi);
                        }
                    } else {
                        echo "Error: " . $query_detail . "<br>" . mysqli_error($koneksi);
                    }
                } else {
                    echo "Error: " . $query_insert_invoice . "<br>" . mysqli_error($koneksi);
                }
            } else {
                // Debugging: Tambahkan pesan jika data tidak ditemukan
                echo "Error: Data tidak ditemukan atau query gagal.<br>";
                echo "Query: " . $query_get_kode_perusahaan . "<br>";
                echo "Error: " . mysqli_error($koneksi);
            }
        }

        echo "<script>alert('Data berhasil disimpan dan diupdate.');</script>";
        echo "<script>history.go(-1)</script>";

        // Tutup koneksi database
        mysqli_close($koneksi);
    } else {
        // Jika tidak ada pasien yang dipilih, tampilkan pesan peringatan
        echo "<script>alert('Tidak ada pasien yang dipilih');</script>";
        echo "<script>history.go(-1)</script>";
    }
}
