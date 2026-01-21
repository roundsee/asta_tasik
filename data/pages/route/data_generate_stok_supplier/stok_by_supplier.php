<?php

$judulform = "Generate Stok By Supplier";

$data = 'data_generate_stok_supplier';
$rute = 'generate_stok_supplier';
$aksi = 'aksi_stok_supplier';

$rute_detail = 'purchase_order_view';

$view = 'purchase_order_view';

$tabel = 'pembelian';

$f1 = 'kd_beli';
$f2 = 'tgl_beli';
$f3 = 'kd_supp';
$f4 = 'ket_payment';
$f5 = 'status_payment';
$f6 = 'jenis_po';
$f7 = 'ppn';
$f8 = 'status_pembelian';
$f9 = 'tgl_po';
$f10 = 'tgl_rilis';


$j1 = 'Kode Pembelian';
$j2 = 'Tanggal';
$j3 = 'Kode Supplier';
$j4 = 'Ket Payment';
$j5 = 'Status';
$j6 = 'Jenis';
$j7 = 'PB1';
$j8 = 'Status Pembelian';
$j9 = 'Tanggal PO';
$j10 = 'Tangagl Rilis';

$tabel2 = 'pembelian_detail';

$ff1 = 'kd_beli';
$ff2 = 'kd_brg';
$ff3 = 'jml';
$ff4 = 'price';
$ff5 = 'currency';
$ff6 = 'kurs';
$ff7 = 'disc';
$ff8 = 'urut';


$jj1 = 'Kode Beli';
$jj2 = 'Kode Barang';
$jj3 = 'Jumlah';
$jj4 = 'Price';
$jj5 = 'Currency';
$jj6 = 'Kurs';
$jj7 = 'Discount';
$jj8 = 'urut';


$pengaju = 'pengaju';

$p1 = 'brand';
$p2 = 'direktur';
$p3 = 'direktorat';
$p4 = 'manager';
$p5 = 'unitkerja';
$p6 = 'kode_pengaju';
$p7 = 'no_rek';
$p8 = 'employee_no';
$p9 = 'nama';
$p10 = 'nama_unit';

$rek_tujuan = 'rek_tujuan';
$r1 = 'no_rek';
$r2 = 'nama_bank';
$r3 = 'atas_nama';
$r4 = 'cat1';

$jr1 = 'No Rekening';
$jr2 = 'Nama Bank';
$jr3 = 'Atas Nama';
$jr4 = 'Cat 1';

$cabang_e = $_SESSION['cabang_e'];
$area_e = $_SESSION['area_e'];
$en = $_SESSION['employee_number'];

// echo '<br><br><br>';

// echo '<br> '.$en;

// echo '<br><br><br><br>'.$kode_pengaju;
//   $kode_manajer = $q['manager'];

//session_start();
if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
    echo "<link href='style.css' rel='stylesheet' type='text/css'>
  <center>Untuk mengakses modul, Anda harus login <br>";
    echo "<a href=../../index.php><b>LOGIN</b></a></center>";
} else {

    switch ($_GET['act']) {
        //Tampil Data 
        default:
?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper" style="background-color: ghostwhite;">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="list-gds">
                                    <b><?php echo $judulform; ?></b> <small style="font-weight: 100;"></small>
                                </h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="main.php?route=home">Beranda</a></li>
                                    <li class="breadcrumb-item active">Data</li>
                                    <li class="breadcrumb-item active"><?php echo $judulform; ?></li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="card card-default">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <!-- Main row -->
                                <div class="row">
                                    <!-- Left col -->
                                    <section class="col-lg-12 connectedSortable">
                                        <!-- Custom tabs (Charts with tabs)-->
                                        <div class="box">
                                            <div class="box-body">
                                                <div class="table-responsive">

                                                    <!-- <button class="btn btn-primary btn-sm elevation-2 " style="opacity: .7;" onclick="window.location='route/<?php echo $data; ?>/beli_tambah.php'"><i class="fa fa-plus" ;></i> Tambah</button> -->

                                                    <div style="margin:10px"></div>
                                                    <?php if ($login_hash != 21) { ?>
                                                        <form action="route/<?php echo $data ?>/generate_stok_supplier.php" method="post">
                                                            <div class="d-flex">
                                                                <div class="p-2">
                                                                    <button type="submit" disabled class="btn btn-secondary">
                                                                        <i class="fas fa-calendar-day"></i> <?php echo $hari_ini ?>
                                                                    </button>
                                                                </div>
                                                                <div class="p-2" style="font-size: 18px; margin-top:4px">
                                                                    <label for="departmentFilter" class="form-label fw-bold text-secondary">Filter Supplier:</label>
                                                                    <select id="departmentFilter" class="form-select form-select-lg">
                                                                        <option value="all">Semua</option>
                                                                    </select>
                                                                </div>
                                                                <div id="rowCount" class="p-2" style="font-size: 18px; margin-top:8px">
                                                                </div>
                                                                <div class="ml-auto p-2">
                                                                    <button type="submit" class="btn btn-success">
                                                                        <i class="fas fa-save"></i> Generate Purchase Request
                                                                    </button>
                                                                </div>
                                                            </div>

                                                        <?php }  ?>
                                                        <table id="example4" class="table table-bordered table-striped">
                                                            <thead style="background-color: lightgray;" class="elevation-2">
                                                                <tr style="text-align: center;">
                                                                    <th rowspan="2">No.</th>
                                                                    <th rowspan="2">Supplier</th>
                                                                    <th rowspan="2">Kode Barang</th>
                                                                    <th rowspan="2">Nama Barang</th>
                                                                    <th rowspan="2">Buffer</th>
                                                                    <th rowspan="2">nilai buffer</th>
                                                                    <th rowspan="2">Stok Akhir</th>
                                                                    <th rowspan="2">Perhitungan Stok Akhir</th>
                                                                    <!-- <th style="text-align: center; background-color:#8EACCD;" colspan="4">Total</th> -->

                                                                    <th style="text-align: center; background-color:#B0BEC5;" colspan="4">Rata-rata penjualan perhari dalam 7 hari</th>
                                                                    <!-- <th style="text-align: center; background-color:#B3E5FC;" colspan="4">Tertinggi Perminggu</th> -->
                                                                    <th rowspan="2">Rata-rata penjualan perminggu dalam 4 minggu</th>
                                                                    <th rowspan="2">Tertinggi Penjualan per minggu dalam 4 minggu</th>
                                                                    <th rowspan="2">Waktu Kirim</th>
                                                                    <th rowspan="2">Waktu Kirim berdasarkan barang</th>
                                                                    <th rowspan="2">Current Order Rata-rata</th>
                                                                    <th rowspan="2">Current Order Tertinggi</th>
                                                                    <th rowspan="2">Minimum Order</th>
                                                                    <th rowspan="2">Barang yang harus dipesan tidak sesuai jadwal</th>
                                                                    <!-- <th rowspan="2">Estimasi Aman 1 Minggu ke Depan</th> -->
                                                                    <!-- <th rowspan="2">Status</th> -->
                                                                    <!-- <th rowspan="2">Status Tertinggi</th> -->
                                                                </tr>
                                                                <tr style="text-align: center;">
                                                                    <!-- Untuk Total -->
                                                                    <!-- <th style="background-color: #D2E0FB;">I</th>
                                                                        <th style="background-color: #D2E0FB;">II</th>
                                                                        <th style="background-color: #D2E0FB;">III</th>
                                                                        <th style="background-color: #D2E0FB;">IV</th> -->
                                                                    <!-- Untuk Rata Rata -->
                                                                    <th style="background-color: #CFD8DC;">I</th>
                                                                    <th style="background-color: #CFD8DC;">II</th>
                                                                    <th style="background-color: #CFD8DC;">III</th>
                                                                    <th style="background-color: #CFD8DC;">IV</th>

                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                function convertDayToIndonesian($hari_english)
                                                                {
                                                                    $hari_mapping = array(
                                                                        'Monday'    => 'Senin',
                                                                        'Tuesday'   => 'Selasa',
                                                                        'Wednesday' => 'Rabu',
                                                                        'Thursday'  => 'Kamis',
                                                                        'Friday'    => 'Jumat',
                                                                        'Saturday'  => 'Sabtu',
                                                                        'Sunday'    => 'Minggu'
                                                                    );

                                                                    // Mengonversi hari dalam Bahasa Inggris ke Bahasa Indonesia
                                                                    return isset($hari_mapping[$hari_english]) ? $hari_mapping[$hari_english] : $hari_english;
                                                                }

                                                                // Mendapatkan nama hari ini dalam Bahasa Inggris
                                                                $hari_ini_english = date('l');

                                                                // Mengonversi hari ini ke Bahasa Indonesia menggunakan fungsi
                                                                $hari_ini = convertDayToIndonesian($hari_ini_english);
                                                                // echo $hari_ini;
                                                                // Query untuk mengambil kd_brg berdasarkan hari_pengiriman
                                                                $query_kd_brg = "
                                                                    SELECT DISTINCT barang.kd_brg
                                                                    FROM barang 
                                                                    JOIN supplier_barang ON supplier_barang.kd_brg = barang.kd_brg
                                                                    JOIN supplier ON supplier.kd_supp = supplier_barang.kd_supp
                                                                    WHERE supplier.hari_pengiriman = '$hari_ini'
                                                                ";

                                                                $result_kd_brg = mysqli_query($koneksi, $query_kd_brg);
                                                                // echo $query_kd_brg;

                                                                if ($result_kd_brg && mysqli_num_rows($result_kd_brg) > 0) {
                                                                    $no = 1;
                                                                    while ($row_kd_brg = mysqli_fetch_assoc($result_kd_brg)) {
                                                                        $kd_brg = $row_kd_brg['kd_brg'];

                                                                        // Menentukan tanggal awal dan akhir minggu
                                                                        $start_date = date('Y-m-d', strtotime('Monday this week')); // 9 September 2024 jatuh di hari Senin, jadi ini 9 September 2024
                                                                        $start_date = date('Y-m-d', strtotime('last Monday', strtotime($start_date))); // Mengubah ke Senin minggu sebelumnya

                                                                        // Menghitung tanggal untuk setiap minggu
                                                                        $week1_start = date('Y-m-d', strtotime($start_date . ' - 21 days')); // 12 Agustus 2024
                                                                        $week1_end = date('Y-m-d', strtotime($start_date . ' - 15 days')); // 18 Agustus 2024
                                                                        $week2_start = date('Y-m-d', strtotime($start_date . ' - 14 days')); // 19 Agustus 2024
                                                                        $week2_end = date('Y-m-d', strtotime($start_date . ' - 8 days')); // 25 Agustus 2024
                                                                        $week3_start = date('Y-m-d', strtotime($start_date . ' - 7 days')); // 26 Agustus 2024
                                                                        $week3_end = date('Y-m-d', strtotime($start_date . ' - 1 days')); // 1 September 2024
                                                                        $week4_start = $start_date; // 2 September 2024
                                                                        $week4_end = date('Y-m-d', strtotime($start_date . ' + 6 days')); // 8 September 2024
                                                                        $end_date = $week4_end;
                                                                        // Debugging: Print tanggal minggu
                                                                        // echo '<pre>';
                                                                        // echo 'Tanggal Minggu I: Dari ' . $week1_start . ' sampai ' . $week1_end . PHP_EOL;
                                                                        // echo 'Tanggal Minggu II: Dari ' . $week2_start . ' sampai ' . $week2_end . PHP_EOL;
                                                                        // echo 'Tanggal Minggu III: Dari ' . $week3_start . ' sampai ' . $week3_end . PHP_EOL;
                                                                        // echo 'Tanggal Minggu IV: Dari ' . $week4_start . ' sampai ' . $week4_end . PHP_EOL;
                                                                        // echo '</pre>';

                                                                        // Query untuk menghitung total, rata-rata, dan tertinggi per minggu
                                                                        $query_per_minggu = "
                                                                            SELECT 
                                                                               SUM(CASE WHEN tanggal BETWEEN '$week1_start' AND '$week1_end' THEN banyak * qty_satuan ELSE 0 END) AS total_minggu_I,
                                                                                    SUM(CASE WHEN tanggal BETWEEN '$week2_start' AND '$week2_end' THEN banyak * qty_satuan  ELSE 0 END) AS total_minggu_II,
                                                                                    SUM(CASE WHEN tanggal BETWEEN '$week3_start' AND '$week3_end' THEN banyak * qty_satuan ELSE 0 END) AS total_minggu_III,
                                                                                    SUM(CASE WHEN tanggal BETWEEN '$week4_start' AND '$week4_end' THEN banyak * qty_satuan ELSE 0 END) AS total_minggu_IV
                                                                            FROM 
                                                                                jualdetil
                                                                            WHERE 
                                                                                kd_brg = '$kd_brg'
                                                                                AND tanggal BETWEEN '$week1_start' AND '$end_date'
                                                                            ";

                                                                        $result_per_minggu = mysqli_query($koneksi, $query_per_minggu);

                                                                        // Debugging: Check if query was successful
                                                                        if (!$result_per_minggu) {
                                                                            die('Query error: ' . mysqli_error($koneksi));
                                                                        }

                                                                        // Fetch the result
                                                                        $row_per_minggu = mysqli_fetch_assoc($result_per_minggu);

                                                                        // Debugging: Print the raw result from the query
                                                                        // echo '<pre>';
                                                                        // print_r($row_per_minggu);
                                                                        // echo '</pre>';

                                                                        // Extract values from the query
                                                                        $total_minggu_I = isset($row_per_minggu['total_minggu_I']) ? $row_per_minggu['total_minggu_I'] : 0;
                                                                        $total_minggu_II = isset($row_per_minggu['total_minggu_II']) ? $row_per_minggu['total_minggu_II'] : 0;
                                                                        $total_minggu_III = isset($row_per_minggu['total_minggu_III']) ? $row_per_minggu['total_minggu_III'] : 0;
                                                                        $total_minggu_IV = isset($row_per_minggu['total_minggu_IV']) ? $row_per_minggu['total_minggu_IV'] : 0;

                                                                        // $rata_minggu_I = isset($row_per_minggu['rata_minggu_I']) ? $row_per_minggu['rata_minggu_I'] : 0;
                                                                        // $rata_minggu_II = isset($row_per_minggu['rata_minggu_II']) ? $row_per_minggu['rata_minggu_II'] : 0;
                                                                        // $rata_minggu_III = isset($row_per_minggu['rata_minggu_III']) ? $row_per_minggu['rata_minggu_III'] : 0;
                                                                        // $rata_minggu_IV = isset($row_per_minggu['rata_minggu_IV']) ? $row_per_minggu['rata_minggu_IV'] : 0;
                                                                        // Calculate average per week
                                                                        $rata_minggu_I = round($total_minggu_I / 7);
                                                                        $rata_minggu_II = round($total_minggu_II / 7);
                                                                        $rata_minggu_III = round($total_minggu_III / 7);
                                                                        $rata_minggu_IV = round($total_minggu_IV / 7);


                                                                        // $max_rata_per_minggu = max($rata_minggu_I, $rata_minggu_II, $rata_minggu_III, $rata_minggu_III);
                                                                        $max_rata_per_minggu = ($rata_minggu_I + $rata_minggu_II + $rata_minggu_III + $rata_minggu_IV) / 4;

                                                                        $tertinggi_minggu_I = isset($row_per_minggu['tertinggi_minggu_I']) ? $row_per_minggu['tertinggi_minggu_I'] : 0;
                                                                        $tertinggi_minggu_II = isset($row_per_minggu['tertinggi_minggu_II']) ? $row_per_minggu['tertinggi_minggu_II'] : 0;
                                                                        $tertinggi_minggu_III = isset($row_per_minggu['tertinggi_minggu_III']) ? $row_per_minggu['tertinggi_minggu_III'] : 0;
                                                                        $tertinggi_minggu_IV = isset($row_per_minggu['tertinggi_minggu_IV']) ? $row_per_minggu['tertinggi_minggu_IV'] : 0;

                                                                        $max_tertinggi_perminggu = max($rata_minggu_I, $rata_minggu_II, $rata_minggu_III, $rata_minggu_IV);

                                                                        // $max_tertinggi_perminggu = max($tertinggi_minggu_I, $tertinggi_minggu_II, $tertinggi_minggu_III, $tertinggi_minggu_IV);

                                                                        // // Tanggal Minggu
                                                                        // $mulai_minggu_I = isset($row_per_minggu['mulai_minggu_I']) ? $row_per_minggu['mulai_minggu_I'] : 'N/A';
                                                                        // $akhir_minggu_I = isset($row_per_minggu['akhir_minggu_I']) ? $row_per_minggu['akhir_minggu_I'] : 'N/A';
                                                                        // $mulai_minggu_II = isset($row_per_minggu['mulai_minggu_II']) ? $row_per_minggu['mulai_minggu_II'] : 'N/A';
                                                                        // $akhir_minggu_II = isset($row_per_minggu['akhir_minggu_II']) ? $row_per_minggu['akhir_minggu_II'] : 'N/A';
                                                                        // $mulai_minggu_III = isset($row_per_minggu['mulai_minggu_III']) ? $row_per_minggu['mulai_minggu_III'] : 'N/A';
                                                                        // $akhir_minggu_III = isset($row_per_minggu['akhir_minggu_III']) ? $row_per_minggu['akhir_minggu_III'] : 'N/A';
                                                                        // $mulai_minggu_IV = isset($row_per_minggu['mulai_minggu_IV']) ? $row_per_minggu['mulai_minggu_IV'] : 'N/A';
                                                                        // $akhir_minggu_IV = isset($row_per_minggu['akhir_minggu_IV']) ? $row_per_minggu['akhir_minggu_IV'] : 'N/A';
                                                                        // // Query untuk menghitung rata-rata per hari untuk setiap minggu

                                                                        // // Debugging: Print tanggal minggu
                                                                        // echo '<pre>';
                                                                        // echo 'Tanggal Minggu I: Dari ' . $mulai_minggu_I . ' sampai ' . $akhir_minggu_I . PHP_EOL;
                                                                        // echo 'Tanggal Minggu II: Dari ' . $mulai_minggu_II . ' sampai ' . $akhir_minggu_II . PHP_EOL;
                                                                        // echo 'Tanggal Minggu III: Dari ' . $mulai_minggu_III . ' sampai ' . $akhir_minggu_III . PHP_EOL;
                                                                        // echo 'Tanggal Minggu IV: Dari ' . $mulai_minggu_IV . ' sampai ' . $akhir_minggu_IV . PHP_EOL;
                                                                        // echo '</pre>';

                                                                        // Query untuk mencari kd_supp di tabel supplier_barang berdasarkan kd_brg
                                                                        $query_kd_supp = "SELECT supplier_barang.kd_supp , supplier_barang.durasi_kirim , supplier_barang.minimum_order,
                                                                        supplier.nama
                                                                         FROM supplier_barang 
                                                                        JOIN supplier ON supplier.kd_supp = supplier_barang.kd_supp
                                                                        WHERE kd_brg = '$kd_brg' AND supplier.hari_pengiriman = '$hari_ini'";
                                                                        $result_kd_supp = mysqli_query($koneksi, $query_kd_supp);
                                                                        $row_kd_supp = $result_kd_supp ? mysqli_fetch_assoc($result_kd_supp) : [];
                                                                        $kd_supp = isset($row_kd_supp['kd_supp']) ? $row_kd_supp['kd_supp'] : '';
                                                                        $namaSupplierBarang = isset($row_kd_supp['nama']) ? $row_kd_supp['nama'] : '';
                                                                        $namaSupplierBarangbaru = $namaSupplierBarang . ' (' . $kd_supp . ')';
                                                                        $waktu_kirim_barang = isset($row_kd_supp['durasi_kirim']) ? $row_kd_supp['durasi_kirim'] : 0;
                                                                        $minimum_order = isset($row_kd_supp['minimum_order']) ? $row_kd_supp['minimum_order'] : 0;

                                                                        // Query untuk mencari durasi_waktu di tabel supplier berdasarkan kd_supp
                                                                        $query_durasi_waktu = "SELECT term FROM supplier WHERE kd_supp = '$kd_supp'";
                                                                        $result_durasi_waktu = mysqli_query($koneksi, $query_durasi_waktu);
                                                                        $row_durasi_waktu = $result_durasi_waktu ? mysqli_fetch_assoc($result_durasi_waktu) : [];
                                                                        $waktu_kirim_supplier = isset($row_durasi_waktu['term']) ? $row_durasi_waktu['term'] : 0;

                                                                        // Hitung Qty Order dan Qty Order Max Jual
                                                                        // $qty_order = $max_rata_per_minggu * $waktu_kirim_supplier;
                                                                        // $qty_order_max_jual = $max_tertinggi_perminggu * $waktu_kirim_supplier;

                                                                        // hitung stok aman satu minggu kedepan
                                                                        $estimasi = $max_rata_per_minggu * 7;

                                                                        // Ambil stok akhir dari tabel barang
                                                                        $query_stok_akhir = "SELECT sum(inventory.stok)as Quantity , barang.nama , barang.ktg_buffer FROM barang join inventory on inventory.kd_brg = barang.kd_brg WHERE barang.kd_brg = '$kd_brg'";
                                                                        $result_stok_akhir = mysqli_query($koneksi, $query_stok_akhir);
                                                                        $row_stok_akhir = $result_stok_akhir ? mysqli_fetch_assoc($result_stok_akhir) : [];
                                                                        $perhitungan_stok_akhir = isset($row_stok_akhir['Quantity']) ? $row_stok_akhir['Quantity'] : 0;
                                                                        $nama_barang = $row_stok_akhir['nama'];
                                                                        $ktg_buffer = $row_stok_akhir['ktg_buffer'];

                                                                        // Mengecek jumlah kategorinya ada berapa
                                                                        $query_cek_buffer = "SELECT nilai FROM kategori_buffer WHERE kd_kat = '$ktg_buffer'";
                                                                        $result_cek_buffer = mysqli_query($koneksi, $query_cek_buffer);

                                                                        if ($result_cek_buffer && mysqli_num_rows($result_cek_buffer) > 0) {
                                                                            $row_nilai_buffer = mysqli_fetch_assoc($result_cek_buffer);
                                                                            $nilai_buffer = $row_nilai_buffer['nilai'];
                                                                        } else {
                                                                            $nilai_buffer = 0;
                                                                        }


                                                                        // Hitung Qty Order dan Qty Order Max Jual
                                                                        // $qty_order = $max_rata_per_minggu * $waktu_kirim_supplier;
                                                                        $qty_order = ((7 * $max_rata_per_minggu) + ($waktu_kirim_barang * $max_rata_per_minggu)) - $perhitungan_stok_akhir;
                                                                        $qty_order_max_jual = ((7 * $max_tertinggi_perminggu) + ($waktu_kirim_barang * $max_tertinggi_perminggu)) - $perhitungan_stok_akhir;

                                                                        $buffer = round($qty_order * ($nilai_buffer / 100));
                                                                        $stok_akhir = $perhitungan_stok_akhir + $buffer;


                                                                        $estimasi_tidak_aman = ($max_rata_per_minggu * $waktu_kirim_barang) - $perhitungan_stok_akhir;


                                                                        // Tentukan status rata rata
                                                                        // if ($stok_akhir < $qty_order) {
                                                                        //     $status_rata = '<span class="badge bg-danger" style="padding: 8px 16px; font-size: 14px; border-radius: 8px; cursor: not-allowed;">Pesan</span>';
                                                                        // } else {
                                                                        //     $status_rata = '<span class="badge bg-success" style="padding: 8px 16px; font-size: 14px; border-radius: 8px; cursor: not-allowed;">Aman</span>';
                                                                        // }                                                                            // Tentukan Status Tertinggi
                                                                        // if ($stok_akhir < $qty_order_max_jual) {
                                                                        //     $status = '<span class="badge bg-danger" style="padding: 8px 16px; font-size: 14px; border-radius: 8px; cursor: not-allowed;">Pesan</span>';
                                                                        // } else {
                                                                        //     $status = '<span class="badge bg-success" style="padding: 8px 16px; font-size: 14px; border-radius: 8px; cursor: not-allowed;">Aman</span>';
                                                                        // }
                                                                        if ($buffer >= 1) {
                                                                            if ($estimasi_tidak_aman < 0) {
                                                                                $status = '<span class="badge bg-danger" style="padding: 8px 16px; font-size: 14px; border-radius: 8px; cursor: not-allowed;">Pesan</span>';
                                                                            } else {
                                                                                $status = '<span class="badge bg-success" style="padding: 8px 16px; font-size: 14px; border-radius: 8px; cursor: not-allowed;">Aman</span>';
                                                                            }

                                                                ?>
                                                                            <tr align="left">
                                                                                <td><?php echo $no; ?></td>
                                                                                <td><?php echo $namaSupplierBarangbaru; ?></td>
                                                                                <td><?php echo $kd_brg; ?></td>
                                                                                <td><?php echo $nama_barang; ?></td>
                                                                                <td style="text-align:right;"><?php echo number_format($buffer); ?></td>
                                                                                <td style="text-align:right;"><?php echo number_format($nilai_buffer); ?> %</td>
                                                                                <td style="text-align:right;"><?php echo number_format($stok_akhir); ?></td>
                                                                                <td style="text-align:right;"><?php echo number_format($perhitungan_stok_akhir); ?></td>
                                                                                <td style="background-color: rgba(207, 216, 220, 0.6); text-align:right;"><?php echo number_format($rata_minggu_I); ?></td>
                                                                                <td style="background-color: rgba(207, 216, 220, 0.6); text-align:right;"><?php echo number_format($rata_minggu_II); ?></td>
                                                                                <td style="background-color: rgba(207, 216, 220, 0.6); text-align:right;"><?php echo number_format($rata_minggu_III); ?></td>
                                                                                <td style="background-color: rgba(207, 216, 220, 0.6); text-align:right;"><?php echo number_format($rata_minggu_IV); ?></td>
                                                                                <td style="text-align:right;"><?php echo number_format($max_rata_per_minggu); ?></td>
                                                                                <td style="text-align:right;"><?php echo number_format($max_tertinggi_perminggu); ?></td>
                                                                                <td style="text-align:right;"><?php echo $waktu_kirim_supplier . " Hari"; ?></td>
                                                                                <td style="text-align:right;"><?php echo $waktu_kirim_barang . " Hari"; ?></td>
                                                                                <td style="text-align:right;">
                                                                                    <input type="radio" name="selection_<?php echo $kd_brg; ?>" value="qty_order_rata_<?php echo $kd_brg; ?>" class="largeRadio">
                                                                                    <?php echo number_format($qty_order); ?>
                                                                                    <input type="hidden" name="qty_order_<?php echo $kd_brg; ?>" value="<?php echo $qty_order; ?>">

                                                                                    <input type="hidden" name="kd_brg_<?php echo $kd_brg; ?>" value="<?php echo $kd_brg; ?>">
                                                                                    <input type="hidden" name="nama_barang_<?php echo $kd_brg; ?>" value="<?php echo $nama_barang; ?>">
                                                                                    <input type="hidden" name="buffer_<?php echo $kd_brg; ?>" value="<?php echo $buffer; ?>">
                                                                                    <input type="hidden" name="stok_akhir_<?php echo $kd_brg; ?>" value="<?php echo $stok_akhir; ?>">
                                                                                    <input type="hidden" name="perhitungan_stok_akhir_<?php echo $kd_brg; ?>" value="<?php echo $perhitungan_stok_akhir; ?>">
                                                                                    <input type="hidden" name="rata_minggu_I_<?php echo $kd_brg; ?>" value="<?php echo $rata_minggu_I; ?>">
                                                                                    <input type="hidden" name="rata_minggu_II_<?php echo $kd_brg; ?>" value="<?php echo $rata_minggu_II; ?>">
                                                                                    <input type="hidden" name="rata_minggu_III_<?php echo $kd_brg; ?>" value="<?php echo $rata_minggu_III; ?>">
                                                                                    <input type="hidden" name="rata_minggu_IV_<?php echo $kd_brg; ?>" value="<?php echo $rata_minggu_IV; ?>">
                                                                                    <input type="hidden" name="max_rata_per_minggu_<?php echo $kd_brg; ?>" value="<?php echo $max_rata_per_minggu; ?>">
                                                                                    <input type="hidden" name="max_tertinggi_perminggu_<?php echo $kd_brg; ?>" value="<?php echo $max_tertinggi_perminggu; ?>">
                                                                                    <input type="hidden" name="waktu_kirim_supplier_<?php echo $kd_brg; ?>" value="<?php echo $waktu_kirim_supplier; ?>">
                                                                                    <input type="hidden" name="waktu_kirim_barang_<?php echo $kd_brg; ?>" value="<?php echo $waktu_kirim_barang; ?>">
                                                                                    <input type="hidden" name="kd_supp_<?php echo $kd_brg; ?>" value="<?php echo $kd_supp; ?>">
                                                                                </td>
                                                                                <td style="text-align:right;">
                                                                                    <input type="radio" name="selection_<?php echo $kd_brg; ?>" value="qty_order_tertinggi_<?php echo $kd_brg; ?>" class="largeRadio">
                                                                                    <?php echo number_format($qty_order_max_jual); ?>
                                                                                    <input type="hidden" name="qty_order_max_<?php echo $kd_brg; ?>" value="<?php echo $qty_order_max_jual; ?>">
                                                                                </td>
                                                                                <td style="text-align:right;">
                                                                                    <input type="radio" name="selection_<?php echo $kd_brg; ?>" value="minimum_order_<?php echo $kd_brg; ?>" class="largeRadio">
                                                                                    <?php echo $minimum_order; ?>
                                                                                    <input type="hidden" name="minimum_order_<?php echo $kd_brg; ?>" value="<?php echo $minimum_order; ?>">
                                                                                </td>
                                                                                <?php if ($estimasi_tidak_aman < 0) { ?>
                                                                                    <td style="text-align:right;"><?php echo number_format($estimasi_tidak_aman); ?></td>
                                                                                <?php } else { ?>
                                                                                    <td></td>
                                                                                <?php } ?>
                                                                            </tr><?php
                                                                                    $no++;
                                                                                }
                                                                            }
                                                                        } else {
                                                                            echo "<tr><td colspan='21' align='center'>Data tidak ditemukan</td></tr>";
                                                                        }
                                                                                    ?>
                                                            </tbody>
                                                        </table>

                                                        </form>


                                                </div>
                                            </div><!-- /.box-body -->
                                        </div><!-- /.box -->
                                    </section><!-- /.Left col -->
                                </div><!-- /.row (main row) -->
                            </div>
                        </div>
                    </div>
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->

            <!-- Modal Surat Jalan -->
            <div class="modal fade" id="modalSuratJalan" tabindex="-1" role="dialog" aria-labelledby="modalSuratJalanLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content" style="border-radius: 10px; box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);">
                        <form id="formSuratJalan" action="route/<?php echo $data ?>/generate_terima_barang.php" method="POST">
                            <div class="modal-header" style="background-color: #007bff; color: white; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                                <h5 class="modal-title" id="modalSuratJalanLabel" style="font-family: 'Montserrat', sans-serif; font-size: 1.25rem; font-weight: 600;">Isi Surat Jalan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" style="padding: 1.5rem;">
                                <input type="hidden" name="kd_beli" id="modalKdBeli">
                                <div class="form-group">
                                    <label for="surat_jalan" style="font-weight: bold;">Nomor Surat Jalan</label>
                                    <input type="text" class="form-control" id="surat_jalan" name="surat_jalan" required style="border-radius: 30px; border: 1px solid #007bff; padding: 0.75rem;">
                                </div>
                            </div>
                            <div class="modal-footer" style="border-top: none;">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 30px; padding: 0.5rem 1.5rem;">Tutup</button>
                                <button type="submit" class="btn btn-success" style="border-radius: 30px; padding: 0.5rem 1.5rem;">Proses Penerimaan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div id="noResults" class="alert alert-info mt-3 text-center" style="display: none;">
                <i class="bi bi-info-circle"></i> No employees found in selected department.
            </div>

            <script>
                // Script untuk menangkap event klik tombol "Terima Barang" dan menampilkan modal
                $(document).on('click', '.btn-terima-barang', function() {
                    var kd_beli = $(this).data('kd_beli');
                    $('#modalKdBeli').val(kd_beli); // Set nilai kd_beli di modal
                    $('#modalSuratJalan').modal('show'); // Tampilkan modal
                    console.log(kd_beli); // Tambahkan ini untuk melihat output di console
                });
                const filterSelect = document.getElementById('departmentFilter');
                const table = document.getElementById('example4');
                const tableBody = table.getElementsByTagName('tbody')[0];
                const noResultsDiv = document.getElementById('noResults');
                const rowCountSpan = document.getElementById('rowCount');

                // Store original rows
                const originalRows = Array.from(tableBody.rows);

                // Get unique departments and populate dropdown
                function populateDropdown() {
                    const departments = new Set();

                    originalRows.forEach(row => {
                        const departmentCell = row.cells[1]; // Department column (index 2)
                        const department = departmentCell.textContent.replace(/\s+/g, '');
                        departments.add(department);
                    });

                    // Sort departments alphabetically
                    const sortedDepartments = Array.from(departments).sort();

                    // Add options to dropdown
                    sortedDepartments.forEach(department => {
                        const option = document.createElement('option');
                        option.value = department;
                        option.textContent = department;
                        filterSelect.appendChild(option);
                    });
                }

                // Filter function
                function filterTable() {
                    const selectedDepartment = filterSelect.value;
                    let visibleRowCount = 0;

                    originalRows.forEach(row => {
                        const departmentCell = row.cells[1]; // Department column (index 2)
                        const departmentText = departmentCell.textContent.replace(/\s+/g, '');

                        // Remove previous department class
                        row.className = row.className.replace(/department-\w+/g, '');

                        if (selectedDepartment === 'all' || departmentText === selectedDepartment) {
                            row.style.display = '';
                            // Add department-specific styling
                            const departmentClass = 'department-' + departmentText.toLowerCase();
                            row.classList.add(departmentClass);
                            visibleRowCount++;
                        } else {
                            row.style.display = 'none';
                        }
                    });

                    // Update row count with Bootstrap badge
                    if (selectedDepartment === 'all') {
                        rowCountSpan.innerHTML = `<span class="badge bg-secondary">${visibleRowCount} total barang</span>`;
                    } else {
                        rowCountSpan.innerHTML = `<span class="badge bg-primary">${visibleRowCount} barang di ${selectedDepartment}</span>`;
                    }

                    // Show/hide no results message
                    if (visibleRowCount === 0) {
                        noResultsDiv.style.display = 'block';
                        table.closest('.card').style.display = 'none';
                    } else {
                        noResultsDiv.style.display = 'none';
                        table.closest('.card').style.display = 'block';
                    }
                }

                // Event listener for dropdown change
                filterSelect.addEventListener('change', filterTable);

                // Initialize on page load
                window.addEventListener('load', () => {
                    populateDropdown();
                    filterTable(); // Initial count display
                });
            </script>



            <!-- Modal PUrchase detail -->
            <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="viewModalLabel">Purchase Order Detail</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Detail invoice akan dimuat di sini melalui Ajax -->
                        </div>
                    </div>
                </div>
            </div>

            <script>
                $(document).ready(function() {
                    $('#viewModal').on('show.bs.modal', function(event) {
                        var button = $(event.relatedTarget); // Button yang memicu modal
                        var kd_po = button.data('kd_po'); // Ambil data-kd_po

                        $.ajax({
                            url: 'route/data_purchase_order/detail_purchase_order.php', // Ubah dengan path yang sesuai
                            type: 'GET',
                            data: {
                                kd_po: kd_po
                            },
                            success: function(response) {
                                $('#viewModal .modal-body').html(response);
                            },
                            error: function() {
                                alert('Gagal memuat data.');
                            }
                        });
                    });
                });
            </script>

            <style>
                /* Mengubah ukuran radio button */
                input[type="radio"].largeRadio {
                    width: 20px;
                    height: 20px;
                    accent-color: #4CAF50;
                    /* Warna untuk radio button */
                    cursor: pointer;
                    /* Mengubah kursor menjadi pointer saat hover */
                }

                /* Mengatur margin agar lebih rapi */
                input[type="radio"].largeRadio+span {
                    margin-left: 10px;
                    font-size: 16px;
                    vertical-align: middle;
                    /* Menyelaraskan teks dengan radio button */
                }

                .modal-backdrop {
                    z-index: 1040 !important;
                }

                .modal {
                    z-index: 1050 !important;
                }

                .modal-dialog {
                    max-width: 90%;
                    margin: 1.75rem auto;
                }

                .modal-content {
                    max-height: 90vh;
                    overflow-y: auto;
                }
            </style>

            <script>
                // Fungsi untuk mengatur checkbox "Select All"
                function toggle(source) {
                    checkboxes = document.getElementsByName('selected_items[]');
                    for (var i = 0; i < checkboxes.length; i++) {
                        checkboxes[i].checked = source.checked;
                    }
                }

                // Fungsi untuk menghapus centangan pada saat halaman dimuat
                window.onload = function() {
                    document.getElementById('select-all').checked = false;
                    checkboxes = document.getElementsByName('selected_items[]');
                    for (var i = 0; i < checkboxes.length; i++) {
                        checkboxes[i].checked = false;
                    }
                };
            </script>


            <style>
                .modal-dialog {
                    max-width: 90%;
                    margin: 1.75rem auto;
                }

                .modal-content {
                    overflow-y: auto;
                    max-height: 90vh;
                }

                .modal-body {
                    max-height: calc(100vh - 200px);
                    overflow-y: auto;
                }

                .largeCheckbox {
                    width: 20px;
                    height: 20px;
                    text-align: center;
                    vertical-align: middle;
                }

                .centerCheckbox {
                    text-align: center;
                    vertical-align: middle;
                }

                .modal {
                    display: none;
                    position: fixed;
                    z-index: 1;
                    left: 0;
                    top: 0;
                    width: 100%;
                    height: 100%;
                    overflow: auto;
                    background-color: rgb(0, 0, 0);
                    background-color: rgba(0, 0, 0, 0.4);
                    padding-top: 60px;
                }

                .modal-content {
                    background-color: #fefefe;
                    margin: 5% auto;
                    padding: 20px;
                    border: 1px solid #888;
                    width: 80%;
                }

                .close {
                    color: #aaa;
                    float: right;
                    font-size: 28px;
                    font-weight: bold;
                }

                .close:hover,
                .close:focus {
                    color: black;
                    text-decoration: none;
                    cursor: pointer;
                }

                /* Styling tabel untuk cetakan */
                table {
                    width: 100%;
                    border-collapse: collapse;
                }

                table,
                th,
                td {
                    border: 1px solid black;
                }

                th,
                td {
                    padding: 8px;
                    text-align: left;
                }
            </style>



        <?php
            break;

        //Form Tambah area
        case "tambah":

        ?>

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="list-gds wow slideInUp" data-wow-duration=".5s" data-wow-delay="1.1s">
                                    <b><?php echo $judulform; ?> <small style="font-weight: 100;">tambah</small></b>
                                </h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="main.php?route=home">Beranda</a></li>
                                    <li class="breadcrumb-item active">Data</li>
                                    <li class="breadcrumb-item active"><?php echo $judulform; ?></li>
                                    <li class="breadcrumb-item active">tambah</li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="card card-default">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <!-- right column -->
                                    <div class="col-md-12">
                                        <!-- general form elements disabled -->
                                        <div class="box box-warning">
                                            <div class="box-body">
                                                <form method="POST" action="route/data_alat_bayar/aksi_alat_bayar.php?route=alat_bayar&act=input" enctype="multipart/form-data">

                                                    <!-- <form method="post" enctype="multipart/form-data" action="<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=input"> -->

                                                    <div class="form-group">
                                                        <label><?php echo $j1; ?></label>
                                                        <input type="text" onkeyup="isi_otomatis()" name="<?php echo $f1; ?>" id="<?php echo $f1; ?>" required="required" class="form-control" style="width: 100px;" />
                                                        <input type="text" id="<?php echo $f2; ?>" class="form-control" style="width: 300px;" disabled />
                                                        <input type="text" id="nama" class="form-control" style="width: 300px;" />

                                                    </div>

                                                    <div class="form-group">
                                                        <label><?php echo $j2; ?></label>
                                                        <input type="text" name="<?php echo $f2; ?>" class="form-control" placeholder="Masukan <?php echo $j2; ?> ..." required="required" />
                                                    </div>

                                                    <div class="form-group">
                                                        <label><?php echo $j4; ?></label>
                                                        <select name="<?php echo $f4; ?>" class="form-control" style="width:200px;height: 40px;">
                                                            <option value="Non Tunai">Non Tunai</option>
                                                            <option value="Tunai">Tunaii</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label><?php echo $j5; ?></label>
                                                        <select name="<?php echo $f5; ?>" class="form-control" style="width:200px;height: 40px;">
                                                            <option></option>
                                                            <?php

                                                            $produk = mysqli_query($koneksi, "SELECT * from jenis_transaksi order by kd_jenis asc");
                                                            while ($pro = mysqli_fetch_array($produk)) {
                                                                echo "<option value='$pro[kd_jenis]'>$pro[kd_jenis] - $pro[nama]</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <div id="msg"></div>
                                                                <input type="file" name="photo" class="file">
                                                                <div class="input-group my-3">
                                                                    <input type="text" class="form-control" disabled placeholder="Upload Gambar" id="file">
                                                                    <div class="input-group-append">
                                                                        <button type="button" id="pilih_gambar" class="browse btn btn-dark">Pilih Gambar</button>
                                                                    </div>
                                                                </div>

                                                                <img src="route/data_alat_bayar/gambar/images.jpeg" id="preview" class="img-thumbnail">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <hr />
                                                        <input type="submit" class="btn btn-primary" value="Simpan" />
                                                    </div>

                                                </form>
                                            </div><!-- /.box-body -->
                                        </div><!-- /.box -->
                                    </div><!--/.col (right) -->
                                </div> <!-- /.row -->
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->


            <style>
                .file {
                    visibility: hidden;
                    position: absolute;
                }
            </style>
            <script>
                function isi_otomatis() {
                    var <?php echo $f1; ?> = $("#<?php echo $f1; ?>").val();
                    $.ajax({
                        url: 'route/data_alat_bayar/ajax.php',
                        data: "<?php echo $f1; ?>=" + <?php echo $f1; ?>,
                    }).success(function(data) {
                        var json = data,
                            obj = JSON.parse(json);
                        $('#<?php echo $f2; ?>').val(obj.<?php echo $f2; ?>);

                    });
                }
            </script>

            <script>
                function konfirmasi() {
                    konfirmasi = confirm("Apakah anda yakin ingin menghapus gambar ini?")
                    document.writeln(konfirmasi)
                }

                $(document).on("click", "#pilih_gambar", function() {
                    var file = $(this).parents().find(".file");
                    file.trigger("click");
                });

                $('input[type="file"]').change(function(e) {
                    var fileName = e.target.files[0].name;
                    $("#file").val(fileName);

                    var reader = new FileReader();
                    reader.onload = function(e) {
                        // get loaded data and render thumbnail.
                        document.getElementById("preview").src = e.target.result;
                    };
                    // read the image file as a data URL.
                    reader.readAsDataURL(this.files[0]);
                });
            </script>



            <!-- Page script -->
            <script type="text/javascript">
                $(function() {
                    //Datemask dd/mm/yyyy
                    $("#datemask").inputmask("dd/mm/yyyy", {
                        "placeholder": "dd/mm/yyyy"
                    });
                    //Datemask2 mm/dd/yyyy
                    $("#datemask2").inputmask("mm/dd/yyyy", {
                        "placeholder": "mm/dd/yyyy"
                    });
                    //Money Euro
                    $("[data-mask]").inputmask();

                    //Date range picker
                    $('#reservation').daterangepicker();
                    //Date range picker with time picker
                    $('#reservationtime').daterangepicker({
                        timePicker: true,
                        timePickerIncrement: 30,
                        format: 'MM/DD/YYYY h:mm A'
                    });
                    //Date range as a button
                    $('#daterange-btn').daterangepicker({
                            ranges: {
                                'Today': [moment(), moment()],
                                'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                                'Last 7 Days': [moment().subtract('days', 6), moment()],
                                'Last 30 Days': [moment().subtract('days', 29), moment()],
                                'This Month': [moment().startOf('month'), moment().endOf('month')],
                                'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                            },
                            startDate: moment().subtract('days', 29),
                            endDate: moment()
                        },
                        function(start, end) {
                            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                        }
                    );

                    //iCheck for checkbox and radio inputs
                    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                        checkboxClass: 'icheckbox_minimal-blue',
                        radioClass: 'iradio_minimal-blue'
                    });
                    //Red color scheme for iCheck
                    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
                        checkboxClass: 'icheckbox_minimal-red',
                        radioClass: 'iradio_minimal-red'
                    });
                    //Flat red color scheme for iCheck
                    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                        checkboxClass: 'icheckbox_flat-green',
                        radioClass: 'iradio_flat-green'
                    });

                    //Colorpicker
                    $(".my-colorpicker1").colorpicker();
                    //color picker with addon
                    $(".my-colorpicker2").colorpicker();

                    //Timepicker
                    $(".timepicker").timepicker({
                        showInputs: false
                    });
                });
            </script>

            <script>
                $(function() {
                    var dt = '';
                    $('#d1').datepicker();


                    $('#d2').datepicker({
                        changeMonth: true,
                        dateFormat: 'yy-mm-dd',
                        changeYear: true,
                    });

                    $('#d3').datepicker({
                        changeMonth: true,
                        dateFormat: 'yy-mm-dd',
                        changeYear: true,
                        onClose: function(date) {
                            dt = date;
                            $("#d4").datepicker("destroy");
                            showdate();

                        }
                    });

                    $('#d5').datepicker({
                        changeYear: true,
                    });

                    $("#d6").datepicker();
                    $("#hFormat").change(function() {
                        $("#d6").datepicker("option", "dateFormat", $(this).val());
                    });



                    function showdate() {
                        $('#d4').datepicker({
                            changeMonth: true,
                            dateFormat: 'yy-mm-dd',
                            changeYear: true,
                            minDate: new Date(dt),
                            hideIfNoPrevNext: true
                        });
                    }

                });
            </script>
        <?php
            break;

        //Form Edit
        case "edit":
            $edit = mysqli_query($koneksi, "SELECT * from $tabel where $f1='$_GET[id]'");
            $e = mysqli_fetch_array($edit);

        ?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper" style="background-color: ghostwhite;">
                <!-- Content Header (Page header) -->
                <section class="content-header  wow fadeInDown" data-wow-duration=".3s" data-wow-delay=".3s">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="list-gds">
                                    <b><?php echo $judulform; ?></b> <small style="font-weight: 100;">edit</small>
                                </h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="main.php?route=home">Beranda</a></li>
                                    <li class="breadcrumb-item active">Data</li>
                                    <li class="breadcrumb-item active"><?php echo $judulform; ?></li>
                                    <li class="breadcrumb-item active">edit</li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>

                <!-- Main content -->
                <section class="content wow fadeInUp" data-wow-duration=".2s" data-wow-delay=".1s">
                    <div class="container-fluid">
                        <div class="card card-default">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <!-- right column -->
                                    <div class="col-md-12">
                                        <!-- general form elements disabled -->
                                        <div class="box box-warning">
                                            <div class="box-body">

                                                <form method="POST" action="route/<?php echo $data; ?>/<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=edit&id=<?php echo $e['$f1']; ?>" enctype="multipart/form-data">

                                                    <section class="base">
                                                        <div class="row">

                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label><?php echo $j1; ?></label>
                                                                    <input type="text" name="<?php echo $f1; ?>" class="form-control" value="<?php echo $e[$f1]; ?>" readonly />
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <label><?php echo $j2; ?></label>
                                                                    <input type="text" name="<?php echo $f2; ?>" class="form-control" value="<?php echo $e[$f2]; ?>" autofocus="" readonly />
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <label><?php echo $j9; ?></label>
                                                                    <input type="text" name="<?php echo $f9; ?>" class="form-control" value="<?php echo $e[$f9]; ?>" autofocus="" readonly />
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-5">
                                                                <div class="form-group">
                                                                    <label><?php echo $j3; ?></label>
                                                                    <input type="text" name="<?php echo $f3; ?>" class="form-control" value="<?php echo $e[$f3]; ?>" autofocus="" readonly />
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <label><?php echo $j4; ?></label>
                                                                    <input type="text" name="<?php echo $f4; ?>" class="form-control" value="<?php echo $e[$f4]; ?>" autofocus="" required="" />
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label><?php echo $j5; ?></label>
                                                                    <input type="text" name="<?php echo $f5; ?>" class="form-control" value="<?php echo $e[$f5]; ?>" autofocus="" required="" />
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label><?php echo $j6; ?></label>
                                                                    <input type="text" name="<?php echo $f6; ?>" class="form-control" value="<?php echo $e[$f6]; ?>" autofocus="" required="" />
                                                                </div>
                                                            </div>

                                                            <!-- <div class="col-lg-2">
                                          <div class="form-group">
                                            <label><?php echo $j7; ?></label>
                                            <input type="text" name="<?php echo $f7; ?>" class="form-control" value="<?php echo $e[$f7]; ?>" autofocus="" required="" />
                                          </div>
                                        </div>

                                        <div class="col-lg-2">
                                          <div class="form-group">
                                            <label><?php echo $j8; ?></label>
                                            <input type="text" name="<?php echo $f8; ?>" class="form-control" value="<?php echo $e[$f8]; ?>" autofocus="" required="" />
                                          </div>
                                        </div> -->

                                                        </div>

                                                        <hr />

                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-primary elevation-2" style="opacity: .7">Simpan Perubahan</button>
                                                        </div>

                                                    </section>
                                                </form>
                                                <a href="main.php?route=<?php echo $rute; ?>&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=<?php echo $rute; ?>"><button class="btn btn-primary btn-sm elevation-1" style="opacity: .7">Back</button></a>
                                            </div><!-- /.box-body -->
                                        </div><!-- /.box -->
                                    </div><!--/.col (right) -->
                                </div> <!-- /.row -->
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->

            <style>
                .file {
                    visibility: hidden;
                    position: absolute;
                }
            </style>

            <script>
                function konfirmasi() {
                    konfirmasi = confirm("Apakah anda yakin ingin menghapus gambar ini?")
                    document.writeln(konfirmasi)
                }

                $(document).on("click", "#pilih_gambar", function() {
                    var file = $(this).parents().find(".file");
                    file.trigger("click");
                });

                $('input[type="file"]').change(function(e) {
                    var fileName = e.target.files[0].name;
                    $("#file").val(fileName);

                    var reader = new FileReader();
                    reader.onload = function(e) {
                        // get loaded data and render thumbnail.
                        document.getElementById("preview").src = e.target.result;
                    };
                    // read the image file as a data URL.
                    reader.readAsDataURL(this.files[0]);
                });
            </script>

            <!-- Page script -->
            <script type="text/javascript">
                $(function() {
                    //Datemask dd/mm/yyyy
                    $("#datemask").inputmask("dd/mm/yyyy", {
                        "placeholder": "dd/mm/yyyy"
                    });
                    //Datemask2 mm/dd/yyyy
                    $("#datemask2").inputmask("mm/dd/yyyy", {
                        "placeholder": "mm/dd/yyyy"
                    });
                    //Money Euro
                    $("[data-mask]").inputmask();

                    //Date range picker
                    $('#reservation').daterangepicker();
                    //Date range picker with time picker
                    $('#reservationtime').daterangepicker({
                        timePicker: true,
                        timePickerIncrement: 30,
                        format: 'MM/DD/YYYY h:mm A'
                    });
                    //Date range as a button
                    $('#daterange-btn').daterangepicker({
                            ranges: {
                                'Today': [moment(), moment()],
                                'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                                'Last 7 Days': [moment().subtract('days', 6), moment()],
                                'Last 30 Days': [moment().subtract('days', 29), moment()],
                                'This Month': [moment().startOf('month'), moment().endOf('month')],
                                'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                            },
                            startDate: moment().subtract('days', 29),
                            endDate: moment()
                        },
                        function(start, end) {
                            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                        }
                    );

                    //iCheck for checkbox and radio inputs
                    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                        checkboxClass: 'icheckbox_minimal-blue',
                        radioClass: 'iradio_minimal-blue'
                    });
                    //Red color scheme for iCheck
                    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
                        checkboxClass: 'icheckbox_minimal-red',
                        radioClass: 'iradio_minimal-red'
                    });
                    //Flat red color scheme for iCheck
                    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                        checkboxClass: 'icheckbox_flat-green',
                        radioClass: 'iradio_flat-green'
                    });

                    //Colorpicker
                    $(".my-colorpicker1").colorpicker();
                    //color picker with addon
                    $(".my-colorpicker2").colorpicker();

                    //Timepicker
                    $(".timepicker").timepicker({
                        showInputs: false
                    });
                });
            </script>

            <script>
                $(function() {
                    var dt = '';
                    $('#d1').datepicker();


                    $('#d2').datepicker({
                        changeMonth: true,
                        dateFormat: 'yy-mm-dd',
                        changeYear: true,
                    });

                    $('#d3').datepicker({
                        changeMonth: true,
                        dateFormat: 'yy-mm-dd',
                        changeYear: true,
                        onClose: function(date) {
                            dt = date;
                            $("#d4").datepicker("destroy");
                            showdate();

                        }
                    });

                    $('#d5').datepicker({
                        changeYear: true,
                    });

                    $("#d6").datepicker();
                    $("#hFormat").change(function() {
                        $("#d6").datepicker("option", "dateFormat", $(this).val());
                    });



                    function showdate() {
                        $('#d4').datepicker({
                            changeMonth: true,
                            dateFormat: 'yy-mm-dd',
                            changeYear: true,
                            minDate: new Date(dt),
                            hideIfNoPrevNext: true
                        });
                    }

                });
            </script>
<?php
            break;
    }
}
?>