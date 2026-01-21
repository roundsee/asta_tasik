<?php
session_start();

$dir = "../../../../";
$login_hash = $_SESSION['login_hash'];
$en = $_SESSION['employee_number'];
$to = $_SESSION['to'];
$area_e = $_SESSION['area_e'];
$area_nama = $_SESSION['area_nama'];
$namauser = $_SESSION['namauser'];
$jabatan = $_SESSION['jabatan'];
$pelanggan_nama = $_SESSION['pelanggan_nama'];

if (empty($_SESSION['namauser']) and empty($_SESSION['passuser'])) {
    echo "<link href='../../../../dist/style.css' rel='stylesheet' type='text/css'>
    <center>Untuk mengakses modul, Anda harus login <br>";
    echo "<div class='wrapper'><a href=../../../../index.php><b>LOGIN</b></a></div></center>";
} else {
    include $dir . "config/koneksi.php";
    include $dir . "config/fungsi_kode_otomatis.php";
    include $dir . "config/fungsi_rupiah.php";
    include $dir . "config/fungsi_indotgl.php";
    include $dir . "config/library.php";
    // ADD THESE NEW INCLUDES
    include 'loading_functions.php';  // Helper functions

    // Initialize loading screen
    initLoadingScreen();

    // Show loading screen immediately
    showLoadingScreen();

    // Start processing data with status updates
    updateLoadingStatus("Database...");

    // Get current month data
    $currentMonth = date('Y-m');
    $currentYear = date('Y');
    $currentMonthNum = date('n');
    $daysInCurrentMonth = date('t');

    // Query for Hutang pembelian satu tahun
    $pembelian_hutang_tahun_ini = "
    SELECT          
        SUM(((pd.nilai * pd.jml) - pd.disc) + 
            (pembelian.ppn * (((pd.nilai * pd.jml) - pd.disc) * pembelian.tarif_ppn / 100 ))) + 
            pembelian_invoice.ongkir AS hargatotal,
        (SELECT IFNULL(SUM(jumlah_payment), 0) 
        FROM payment 
        WHERE payment.no_invoice = pembelian_invoice.no_invoice AND payment.tanggal_payment < CURDATE()) AS jumlah_payment
    FROM pembelian_invoice_detail pd
    JOIN pembelian ON pembelian.kd_po = pd.kd_po
    JOIN pembelian_invoice ON pembelian_invoice.no_invoice = pd.no_invoice
    WHERE pembelian_invoice.status_payment <= 1 AND pembelian_invoice.tanggal_invoice < CURDATE();
    ";
    $pembelian_hutang_tahun_ini_hasil = mysqli_query($koneksi, $pembelian_hutang_tahun_ini);
    $pembelian_hutang_tahun_ini_jumlah = 0;
    $pembelian_hutang_tahun_ini_dibayar = 0;
    $pembelian_hutang_tahun_ini_sisa = 0;


    if (mysqli_num_rows($pembelian_hutang_tahun_ini_hasil) > 0) {
        while ($row = mysqli_fetch_assoc($pembelian_hutang_tahun_ini_hasil)) {
            $pembelian_hutang_tahun_ini_jumlah = $row['hargatotal'];
            $pembelian_hutang_tahun_ini_dibayar = $row['jumlah_payment'];
            $pembelian_hutang_tahun_ini_sisa = $pembelian_hutang_tahun_ini_jumlah - $pembelian_hutang_tahun_ini_dibayar;
        }
    }

    updateLoadingStatus("Hutang...");


    // Query for Hutang pembelian hari ini
    $pembelian_hutang_hari_ini = "
    SELECT          
        SUM(((pd.nilai * pd.jml) - pd.disc) + 
            (pembelian.ppn * (((pd.nilai * pd.jml) - pd.disc) * pembelian.tarif_ppn / 100 ))) + 
            pembelian_invoice.ongkir AS hargatotal,
        (SELECT IFNULL(SUM(jumlah_payment), 0) 
        FROM payment 
        WHERE payment.no_invoice = pembelian_invoice.no_invoice AND payment.tanggal_payment = CURDATE()) AS jumlah_payment
    FROM pembelian_invoice_detail pd
    JOIN pembelian ON pembelian.kd_po = pd.kd_po
    JOIN pembelian_invoice ON pembelian_invoice.no_invoice = pd.no_invoice
    WHERE pembelian_invoice.status_payment <= 1 AND pembelian_invoice.tanggal_invoice = CURDATE();
    ";
    $pembelian_hutang_hari_ini_hasil = mysqli_query($koneksi, $pembelian_hutang_hari_ini);
    $pembelian_hutang_hari_ini_jumlah = 0;
    $pembelian_hutang_hari_ini_dibayar = 0;
    $pembelian_hutang_hari_ini_sisa = 0;


    if (mysqli_num_rows($pembelian_hutang_hari_ini_hasil) > 0) {
        while ($row = mysqli_fetch_assoc($pembelian_hutang_hari_ini_hasil)) {
            $pembelian_hutang_hari_ini_jumlah = $row['hargatotal'];
            $pembelian_hutang_hari_ini_dibayar = $row['jumlah_payment'];
            $pembelian_hutang_hari_ini_sisa = $pembelian_hutang_hari_ini_jumlah - $pembelian_hutang_hari_ini_dibayar;
        }
    }

    // Query for pihutang penjualan satu tahun
    $pihutang_penjualan_tahun_ini = "
    SELECT 
        SUM(sub.hargatotal) AS total_hargatotal,
        SUM(sub.jumlah_payment) AS total_jumlah_payment
    FROM (
        SELECT 
            penjualan.faktur,
            (penjualan.jumlah + penjualan.ongkir - penjualan.voucher_nilai_diskon - penjualan.byr_pocer) AS hargatotal,
            IFNULL(SUM(paylater.jumlah_payment), 0) AS jumlah_payment
        FROM penjualan
        LEFT JOIN paylater 
            ON paylater.faktur = penjualan.faktur 
            AND paylater.tanggal_payment < CURDATE()
        WHERE 
            penjualan.kd_alatbayar = 214
            AND DATE(penjualan.tanggal) < CURDATE()
        GROUP BY penjualan.faktur
        HAVING jumlah_payment < hargatotal
    ) AS sub;
    ";
    $pihutang_penjualan_tahun_ini_hasil = mysqli_query($koneksi, $pihutang_penjualan_tahun_ini);
    $pihutang_penjualan_tahun_ini_jumlah = 0;
    $pihutang_penjualan_tahun_ini_dibayar = 0;
    $pihutang_penjualan_tahun_ini_sisa = 0;


    if (mysqli_num_rows($pihutang_penjualan_tahun_ini_hasil) > 0) {
        while ($row = mysqli_fetch_assoc($pihutang_penjualan_tahun_ini_hasil)) {
            $pihutang_penjualan_tahun_ini_jumlah = $row['total_hargatotal'];
            $pihutang_penjualan_tahun_ini_dibayar = $row['total_jumlah_payment'];
            $pihutang_penjualan_tahun_ini_sisa = $pihutang_penjualan_tahun_ini_jumlah - $pihutang_penjualan_tahun_ini_dibayar;
        }
    }

    updateLoadingStatus("Piutang...");

    // Query for pihutang penjualan satu hari
    $pihutang_penjualan_hari_ini = "
    SELECT 
        SUM(sub.hargatotal) AS total_hargatotal,
        SUM(sub.jumlah_payment) AS total_jumlah_payment
    FROM (
        SELECT 
            penjualan.faktur,
            (penjualan.jumlah + penjualan.ongkir - penjualan.voucher_nilai_diskon - penjualan.byr_pocer) AS hargatotal,
            IFNULL(SUM(paylater.jumlah_payment), 0) AS jumlah_payment
        FROM penjualan
        LEFT JOIN paylater 
            ON paylater.faktur = penjualan.faktur 
            AND paylater.tanggal_payment = CURDATE()
        WHERE 
            penjualan.kd_alatbayar = 214
            AND DATE(penjualan.tanggal) = CURDATE()
        GROUP BY penjualan.faktur
        HAVING jumlah_payment < hargatotal
    ) AS sub;
    ";
    $pihutang_penjualan_hari_ini_hasil = mysqli_query($koneksi, $pihutang_penjualan_hari_ini);
    $pihutang_penjualan_hari_ini_jumlah = 0;
    $pihutang_penjualan_hari_ini_dibayar = 0;
    $pihutang_penjualan_hari_ini_sisa = 0;


    if (mysqli_num_rows($pihutang_penjualan_hari_ini_hasil) > 0) {
        while ($row = mysqli_fetch_assoc($pihutang_penjualan_hari_ini_hasil)) {
            $pihutang_penjualan_hari_ini_jumlah = $row['total_hargatotal'];
            $pihutang_penjualan_hari_ini_dibayar = $row['total_jumlah_payment'];
            $pihutang_penjualan_hari_ini_sisa = $pihutang_penjualan_hari_ini_jumlah - $pihutang_penjualan_hari_ini_dibayar;
        }
    }


    // Query for penjualan tahun ini retail
    $penjualantahuniniretail = "
    SELECT 
        SUM(jualdetil.jumlah) AS total_cost, 
        SUM(
            COALESCE((
                SELECT harga_rata 
                FROM mutasi_stok 
                WHERE 
                    kd_brg = jualdetil.kd_brg 
                    AND tgl = DATE(penjualan.tanggal) 
                    AND kd_cus = 1316 
                LIMIT 1
            ), 1) * jualdetil.banyak * jualdetil.qty_satuan
        ) AS COGS
    FROM penjualan
    JOIN jualdetil ON jualdetil.faktur = penjualan.faktur
    WHERE 
        penjualan.tanggal >= DATE_FORMAT(CURDATE(), '%Y-01-01') 
        AND penjualan.tanggal < CURDATE()
        AND penjualan.b_paking = 1
        AND jualdetil.qty_satuan > 0
        AND jualdetil.banyak > 0;
    ";
    $penjualantahuniniretailhasil = mysqli_query($koneksi, $penjualantahuniniretail);
    $penjualantahuniniretailtotal = 0;
    $penjualantahuniniretailcogs = 0;
    $penjualantahuniniretaillaba = 0;

    if (mysqli_num_rows($penjualantahuniniretailhasil) > 0) {
        while ($row = mysqli_fetch_assoc($penjualantahuniniretailhasil)) {
            $penjualantahuniniretailtotal = $row['total_cost'];
            $penjualantahuniniretailcogs = $row['COGS'];
            $penjualantahuniniretaillaba = $penjualantahuniniretailtotal - $penjualantahuniniretailcogs;
        }
    }

    updateLoadingStatus("Retail...");


    // Query for penjualan hari ini retail
    $penjualanhariniretail = "
    SELECT 
        SUM(jualdetil.jumlah) AS total_cost, 
        SUM(
            COALESCE((
                SELECT harga_rata 
                FROM mutasi_stok 
                WHERE 
                    kd_brg = jualdetil.kd_brg 
                    AND tgl = DATE(penjualan.tanggal) 
                    AND kd_cus = 1316 
                LIMIT 1
            ), 1) * jualdetil.banyak * jualdetil.qty_satuan
        ) AS COGS
    FROM penjualan
    JOIN jualdetil ON jualdetil.faktur = penjualan.faktur
    WHERE 
        penjualan.tanggal >= CURDATE()
        AND penjualan.tanggal < CURDATE() + INTERVAL 1 DAY
        AND penjualan.b_paking = 1
        AND jualdetil.qty_satuan > 0
        AND jualdetil.banyak > 0;
    ";
    $penjualanhariniretailhasil = mysqli_query($koneksi, $penjualanhariniretail);
    $penjualanhariniretailtotal = 0;
    $penjualanhariniretailcogs = 0;
    $penjualanhariniretaillaba = 0;

    if (mysqli_num_rows($penjualanhariniretailhasil) > 0) {
        while ($row = mysqli_fetch_assoc($penjualanhariniretailhasil)) {
            $penjualanhariniretailtotal = $row['total_cost'];
            $penjualanhariniretailcogs = $row['COGS'];
            $penjualanhariniretaillaba = $penjualanhariniretailtotal - $penjualanhariniretailcogs;
        }
    }

    // Query for penjualan tahun ini grosir
    $penjualantahuninigrosir = "
    SELECT 
        SUM(jualdetil.jumlah) AS total_cost, 
        SUM(
            COALESCE((
                SELECT harga_rata 
                FROM mutasi_stok 
                WHERE 
                    kd_brg = jualdetil.kd_brg 
                    AND tgl = DATE(penjualan.tanggal) 
                    AND kd_cus = 8001 
                LIMIT 1
            ), 1) * jualdetil.banyak * jualdetil.qty_satuan
        ) AS COGS
    FROM penjualan
    JOIN jualdetil ON jualdetil.faktur = penjualan.faktur
    WHERE 
        penjualan.tanggal >= DATE_FORMAT(CURDATE(), '%Y-01-01') 
        AND penjualan.tanggal < CURDATE()
        AND penjualan.b_paking != 1
        AND jualdetil.qty_satuan > 0
        AND jualdetil.banyak > 0;
    ";
    $penjualantahuninigrosirhasil = mysqli_query($koneksi, $penjualantahuninigrosir);
    $penjualantahuninigrosirtotal = 0;
    $penjualantahuninigrosircogs = 0;
    $penjualantahuninigrosirlaba = 0;

    if (mysqli_num_rows($penjualantahuninigrosirhasil) > 0) {
        while ($row = mysqli_fetch_assoc($penjualantahuninigrosirhasil)) {
            $penjualantahuninigrosirtotal = $row['total_cost'];
            $penjualantahuninigrosircogs = $row['COGS'];
            $penjualantahuninigrosirlaba = $penjualantahuninigrosirtotal - $penjualantahuninigrosircogs;
        }
    }

    updateLoadingStatus("Grosir...");

    // Query for penjualan hari ini grosir
    $penjualanharinigrosir = "
    SELECT 
        SUM(jualdetil.jumlah) AS total_cost, 
        SUM(
            COALESCE((
                SELECT harga_rata 
                FROM mutasi_stok 
                WHERE 
                    kd_brg = jualdetil.kd_brg 
                    AND tgl = DATE(penjualan.tanggal) 
                    AND kd_cus = 8001 
                LIMIT 1
            ), 1) * jualdetil.banyak * jualdetil.qty_satuan
        ) AS COGS
    FROM penjualan
    JOIN jualdetil ON jualdetil.faktur = penjualan.faktur
    WHERE 
        penjualan.tanggal >= CURDATE()
        AND penjualan.tanggal < CURDATE() + INTERVAL 1 DAY
        AND penjualan.b_paking != 1
        AND jualdetil.qty_satuan > 0
        AND jualdetil.banyak > 0;
    ";
    $penjualanharinigrosirhasil = mysqli_query($koneksi, $penjualanharinigrosir);
    $penjualanharinigrosirtotal = 0;
    $penjualanharinigrosircogs = 0;
    $penjualanharinigrosirlaba = 0;

    if (mysqli_num_rows($penjualanharinigrosirhasil) > 0) {
        while ($row = mysqli_fetch_assoc($penjualanharinigrosirhasil)) {
            $penjualanharinigrosirtotal = $row['total_cost'];
            $penjualanharinigrosircogs = $row['COGS'];
            $penjualanharinigrosirlaba = $penjualanharinigrosirtotal - $penjualanharinigrosircogs;
        }
    }
    updateLoadingStatus("Grafik...");


    // Query for current month daily sales (adjust table/column names as needed)
    $currentMonthQuery = "
    SELECT 
        DAY(penjualan.tanggal) as hari,
        SUM(penjualan.jumlah+penjualan.ongkir-penjualan.voucher_nilai_diskon - penjualan.byr_pocer) as total_harian
    FROM penjualan 
    WHERE YEAR(tanggal) = YEAR(CURDATE()) 
    AND MONTH(tanggal) = MONTH(CURDATE())
    GROUP BY DAY(tanggal)
    ORDER BY hari
    ";
    $currentMonthResult = mysqli_query($koneksi, $currentMonthQuery);
    $currentMonthData = [];

    if (mysqli_num_rows($currentMonthResult) > 0) {
        while ($row = mysqli_fetch_assoc($currentMonthResult)) {
            $currentMonthData[$row['hari']] = (int)$row['total_harian'];
        }
    }
    // Get previous month average
    $previousMonth = date('Y-m', strtotime('-1 month'));
    $previousMonthQuery = "
    SELECT AVG(total_harian) as rata_rata_bulan_lalu
    FROM (
        SELECT 
            DAY(penjualan.tanggal) as hari,
            SUM(penjualan.jumlah+penjualan.ongkir-penjualan.voucher_nilai_diskon - penjualan.byr_pocer) as total_harian
        FROM penjualan 
        WHERE YEAR(tanggal) = YEAR(DATE_SUB(CURDATE(), INTERVAL 1 MONTH))
        AND MONTH(tanggal) = MONTH(DATE_SUB(CURDATE(), INTERVAL 1 MONTH))
        GROUP BY DAY(tanggal)
    ) as daily_sales
    ";
    $previousMonthResult = mysqli_query($koneksi, $previousMonthQuery);
    $previousMonthAverage = 0;

    if (mysqli_num_rows($previousMonthResult) > 0) {
        $row = mysqli_fetch_assoc($previousMonthResult);
        $previousMonthAverage = (int)$row['rata_rata_bulan_lalu'];
    }

    // Prepare data for JavaScript - handle missing days
    $thisMonthSalesJS = [];
    $currentDay = (int)date('j'); // Current day of month

    for ($day = 1; $day <= $currentDay; $day++) {
        if (isset($currentMonthData[$day])) {
            $thisMonthSalesJS[] = $currentMonthData[$day];
        } else {
            // No sales data for this day (holiday/closed) - set to 0
            $thisMonthSalesJS[] = 0;
        }
    }

    // Only show data up to current day, not future days
    $actualDaysToShow = count($thisMonthSalesJS);
    updateLoadingStatus("Dashboard...");

?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Dashboard <?php echo $perusahaan; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="../../../../images/favicon.ico">
        <link rel="stylesheet" href="../../../../dist/css/adminlte.min.css">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../../../../dist/wib.css">
        <link rel="stylesheet" type="text/css" href="../../../../dist/anima.css" media="all">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <link rel="stylesheet" href="../../../../assets/fontawesome-free-6.3.0-web/css/all.min.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>

        <style>
            :root {
                --primary-gradient: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
                --success-gradient: linear-gradient(135deg, #56ab2f 0%, #a8e6cf 100%);
                --warning-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
                --info-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
                --dark-gradient: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
                --swalayan-bg: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
                --grosir-bg: linear-gradient(135deg, #f1f8e9 0%, #c8e6c9 100%);
            }

            body {
                background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                min-height: 100vh;
            }

            .bg_primary_2 {
                background: var(--primary-gradient) !important;
                box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
            }

            .bg_primary_1 {
                background: var(--dark-gradient) !important;
            }

            .navbar-brand {
                transition: all 0.3s ease;
            }

            .navbar-brand:hover {
                transform: translateX(-5px);
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            }

            .company-header {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(10px);
                border-radius: 20px;
                margin: 20px;
                padding: 30px;
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
                border: 1px solid rgba(255, 255, 255, 0.2);
                text-align: center;
            }

            .company-header h1 {
                background: var(--primary-gradient);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                font-weight: 800;
                font-size: 2.5rem;
                margin-bottom: 10px;
            }

            .company-header h5 {
                color: #6c757d;
                font-weight: 400;
                opacity: 0.8;
            }

            .card {
                border: none;
                border-radius: 20px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
                transition: all 0.3s ease;
                overflow: hidden;
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(10px);
            }

            .card:hover {
                transform: translateY(-8px);
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            }

            .table-header {
                background: var(--primary-gradient);
                color: white;
                padding: 20px;
                position: relative;
                overflow: hidden;
            }

            .table-header::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
                transition: left 0.5s;
            }

            .card:hover .table-header::before {
                left: 100%;
            }

            .table-header h4,
            .table-header h5 {
                margin: 0;
                font-weight: 600;
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
            }

            .table {
                margin: 0;
                border-radius: 0 0 20px 20px;
            }

            .table thead th {
                background: var(--dark-gradient);
                color: white;
                border: none;
                padding: 15px;
                font-weight: 600;
                text-transform: uppercase;
                font-size: 0.85rem;
                letter-spacing: 1px;
            }

            .table tbody td {
                padding: 15px;
                border-color: rgba(0, 0, 0, 0.05);
                vertical-align: middle;
                transition: all 0.2s ease;
            }

            .table tbody tr:hover td {
                background-color: rgba(102, 126, 234, 0.05);
                transform: scale(1.01);
            }

            .location-swalayan {
                background: var(--swalayan-bg);
                border-left: 5px solid #2196f3;
            }

            .location-grosir {
                background: var(--grosir-bg);
                border-left: 5px solid #4caf50;
            }

            .amount-today {
                font-weight: 700;
                color: #1976d2;
                text-shadow: 1px 1px 2px rgba(25, 118, 210, 0.2);
                position: relative;
            }

            .amount-total {
                font-weight: 700;
                color: #388e3c;
                text-shadow: 1px 1px 2px rgba(56, 142, 60, 0.2);
            }

            .amount-debt {
                font-weight: 700;
                color: #d32f2f;
                text-shadow: 1px 1px 2px rgba(211, 47, 47, 0.2);
            }

            .amount-payment {
                font-weight: 700;
                color: #7b1fa2;
                text-shadow: 1px 1px 2px rgba(123, 31, 162, 0.2);
            }

            .table-success {
                background: linear-gradient(135deg, #e8f5e8 0%, #c8e6c9 100%);
                border-left: 5px solid #4caf50;
            }

            .table-info {
                background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
                border-left: 5px solid #2196f3;
            }

            .table-warning {
                background: linear-gradient(135deg, #fff3e0 0%, #ffcc02 100%);
                border-left: 5px solid #ff9800;
            }

            .row {
                margin: 0 20px;
            }

            .container-fluid {
                padding: 0;
            }

            footer {
                background: var(--dark-gradient) !important;
                box-shadow: 0 -4px 15px rgba(0, 0, 0, 0.2);
                margin-top: 40px;
            }

            /* Animasi untuk angka */
            .amount-today,
            .amount-total,
            .amount-debt,
            .amount-payment {
                position: relative;
                overflow: hidden;
            }

            .amount-today::before,
            .amount-total::before,
            .amount-debt::before,
            .amount-payment::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
                transition: left 0.6s;
            }

            tr:hover .amount-today::before,
            tr:hover .amount-total::before,
            tr:hover .amount-debt::before,
            tr:hover .amount-payment::before {
                left: 100%;
            }

            /* Chart container styling */
            .chart-container {
                position: relative;
                height: 300px;
                padding: 20px;
            }

            /* Loading animation */
            @keyframes pulse {
                0% {
                    opacity: 1;
                }

                50% {
                    opacity: 0.5;
                }

                100% {
                    opacity: 1;
                }
            }

            .loading {
                animation: pulse 1.5s infinite;
            }

            /* Responsive adjustments */
            @media (max-width: 768px) {
                .company-header {
                    margin: 10px;
                    padding: 20px;
                }

                .company-header h1 {
                    font-size: 2rem;
                }

                .row {
                    margin: 0 10px;
                }

                .table thead th {
                    font-size: 0.75rem;
                    padding: 10px;
                }

                .table tbody td {
                    padding: 10px;
                    font-size: 0.85rem;
                }
            }

            /* Smooth scroll */
            html {
                scroll-behavior: smooth;
            }

            /* Custom scrollbar */
            ::-webkit-scrollbar {
                width: 8px;
            }

            ::-webkit-scrollbar-track {
                background: #f1f1f1;
            }

            ::-webkit-scrollbar-thumb {
                background: var(--primary-gradient);
                border-radius: 4px;
            }

            ::-webkit-scrollbar-thumb:hover {
                background: var(--dark-gradient);
            }
        </style>
    </head>
    <div class="dashboard-content" id="dashboardContent">

        <body class="skin-green layout-top-nav control-sidebar-slide-open layout-navbar-fixed layout-footer-fixed text-sm d-flex flex-column min-vh-100" style="height: auto;">
            <div>
                <ul class="circles">
                    <li style="background-color:lightgray;"></li>
                    <li style="background-color:gray;"></li>
                    <li style="background-color:lightgray;"></li>
                    <li style="background-color:lightgray;"></li>
                    <li style="background-color:gray;"></li>
                    <li style="background-color:lightgray;"></li>
                    <li style="background-color:lightgray;"></li>
                    <li style="background-color:gray;"></li>
                    <li style="background-color:lightgray;"></li>
                    <li style="background-color:lightgray;"></li>
                    <li style="background-color:gray;"></li>
                </ul>
                <nav class="navbar navbar-expand-lg navbar-light bg_primary_2 shadow-sm px-4">
                    <div class="container-fluid">
                        <span class="navbar-brand fw-bold text-white" style="cursor: pointer;" onclick="goBackHome()">
                            <i class="fa-solid fa-rotate-left me-2"></i> Back
                        </span>
                    </div>
                </nav>

                <div class="company-header">
                    <h1><?php echo $perusahaan ?></h1>
                    <h5><?php echo $q['alamat'] ?></h5>
                    <div class="mt-3">
                        <small class="text-muted">
                            <i class="far fa-calendar-alt me-1"></i>
                            <span id="currentDate"></span>
                        </small>
                    </div>
                </div>
            </div>

            <!-- Baris 1 -->
            <div class="row mb-4">
                <div class="col-lg-6 mb-4">
                    <div class="card">
                        <div class="card-header table-header">
                            <h4 class="mb-0">
                                <i class="fas fa-store me-2"></i>
                                SWALAYAN - Penjualan & HPP
                            </h4>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-bordered mb-0">
                                <thead class="table-dark">
                                    <tr>
                                        <th><i class="fas fa-list me-1"></i> Keterangan</th>
                                        <th><i class="fas fa-calendar-day me-1"></i> Hari Ini</th>
                                        <th><i class="fas fa-calendar-alt me-1"></i> Total Setahun Ini</th>
                                    </tr>
                                </thead>
                                <tbody class="location-swalayan">
                                    <tr>
                                        <td><strong><i class="fas fa-shopping-cart me-2"></i>Penjualan</strong></td>
                                        <td class="amount-today">Rp <?php echo number_format($penjualanhariniretailtotal) ?></td>
                                        <td class="amount-total">Rp <?php echo number_format($penjualantahuniniretailtotal) ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong><i class="fas fa-calculator me-2"></i>HPP</strong></td>
                                        <td class="amount-debt">Rp <?php echo number_format($penjualanhariniretailcogs) ?></td>
                                        <td class="amount-payment">Rp <?php echo number_format($penjualantahuniniretailcogs) ?></td>
                                    </tr>
                                    <tr class="table-success">
                                        <td><strong><i class="fas fa-chart-line me-2"></i>Laba Kotor</strong></td>
                                        <td class="amount-total"><strong>Rp <?php echo number_format($penjualanhariniretaillaba) ?></strong></td>
                                        <td class="amount-total"><strong>Rp <?php echo number_format($penjualantahuniniretaillaba) ?></strong></td>
                                    </tr>
                                    <tr class="table-info">
                                        <td><strong><i class="fas fa-percentage me-2"></i>Margin (%)</strong></td>
                                        <td><strong><?php echo number_format($penjualanhariniretailtotal > 0
                                                        ? ($penjualanhariniretaillaba / $penjualanhariniretailtotal * 100)
                                                        : 0) ?> %</strong></td>
                                        <td><strong><?php echo number_format($penjualantahuniniretailtotal > 0
                                                        ? ($penjualantahuniniretaillaba / $penjualantahuniniretailtotal * 100)
                                                        : 0) ?> %</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card">
                        <div class="card-header table-header">
                            <h4 class="mb-0">
                                <i class="fas fa-file-invoice-dollar me-2"></i>
                                Hutang Pembelian
                            </h4>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-bordered mb-0">
                                <thead class="table-dark">
                                    <tr>
                                        <th><i class="fas fa-info-circle me-1"></i> Keterangan</th>
                                        <th><i class="fas fa-money-bill-wave me-1"></i> Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><i class="fas fa-plus-circle text-danger me-2"></i>Hutang Pembelian Hari Ini</td>
                                        <td class="amount-debt">Rp <?php echo number_format($pembelian_hutang_hari_ini_jumlah) ?></td>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-history text-warning me-2"></i>Total Hutang Pembelian Lainnya</td>
                                        <td class="amount-debt">Rp <?php echo number_format($pembelian_hutang_tahun_ini_sisa) ?></td>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-credit-card text-success me-2"></i>Pembayaran Hutang Hari Ini</td>
                                        <td class="amount-payment">Rp <?php echo number_format($pembelian_hutang_hari_ini_dibayar) ?></td>
                                    </tr>
                                    <tr class="table-info">
                                        <td><strong><i class="fas fa-balance-scale me-2"></i>Sisa Hutang</strong></td>
                                        <td class="amount-debt"><strong>Rp <?php echo number_format($pembelian_hutang_hari_ini_sisa + $pembelian_hutang_tahun_ini_sisa) ?></strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Baris 2 -->
            <div class="row mb-4">
                <div class="col-lg-6 mb-4">
                    <div class="card">
                        <div class="card-header table-header">
                            <h4 class="mb-0">
                                <i class="fas fa-warehouse me-2"></i>
                                GROSIR - Penjualan & HPP
                            </h4>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-bordered mb-0">
                                <thead class="table-dark">
                                    <tr>
                                        <th><i class="fas fa-list me-1"></i> Keterangan</th>
                                        <th><i class="fas fa-calendar-day me-1"></i> Hari Ini</th>
                                        <th><i class="fas fa-calendar-alt me-1"></i> Total Setahun Ini</th>
                                    </tr>
                                </thead>
                                <tbody class="location-grosir">
                                    <tr>
                                        <td><strong><i class="fas fa-shopping-cart me-2"></i>Penjualan</strong></td>
                                        <td class="amount-today">Rp <?php echo number_format($penjualanharinigrosirtotal) ?></td>
                                        <td class="amount-total">Rp <?php echo number_format($penjualantahuninigrosirtotal) ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong><i class="fas fa-calculator me-2"></i>HPP</strong></td>
                                        <td class="amount-debt">Rp <?php echo number_format($penjualanharinigrosircogs) ?></td>
                                        <td class="amount-payment">Rp <?php echo number_format($penjualantahuninigrosircogs) ?></td>
                                    </tr>
                                    <tr class="table-success">
                                        <td><strong><i class="fas fa-chart-line me-2"></i>Laba Kotor</strong></td>
                                        <td class="amount-total"><strong>Rp <?php echo number_format($penjualanharinigrosirlaba) ?></strong></td>
                                        <td class="amount-total"><strong>Rp <?php echo number_format($penjualantahuninigrosirlaba) ?></strong></td>
                                    </tr>
                                    <tr class="table-info">
                                        <td><strong><i class="fas fa-percentage me-2"></i>Margin (%)</strong></td>
                                        <td><strong><?php echo number_format($penjualanharinigrosirtotal > 0
                                                        ? ($penjualanharinigrosirlaba / $penjualanharinigrosirtotal * 100)
                                                        : 0) ?> %</strong></td>
                                        <td><strong><?php echo number_format($penjualantahuninigrosirtotal > 0
                                                        ? ($penjualantahuninigrosirlaba / $penjualantahuninigrosirtotal * 100)
                                                        : 0) ?> %</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card">
                        <div class="card-header table-header">
                            <h4 class="mb-0">
                                <i class="fas fa-credit-card me-2"></i>
                                Piutang Penjualan (PayLater)
                            </h4>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-bordered mb-0">
                                <thead class="table-dark">
                                    <tr>
                                        <th><i class="fas fa-info-circle me-1"></i> Keterangan</th>
                                        <th><i class="fas fa-money-bill-wave me-1"></i> Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><i class="fas fa-clock text-primary me-2"></i>Piutang PayLater Hari Ini</td>
                                        <td class="amount-today">Rp <?php echo number_format($pihutang_penjualan_hari_ini_jumlah) ?></td>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-history text-info me-2"></i>Total Piutang PayLater Lainnya</td>
                                        <td class="amount-today">Rp <?php echo number_format($pihutang_penjualan_tahun_ini_sisa) ?></td>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-hand-holding-usd text-success me-2"></i>Pembayaran Piutang Hari Ini</td>
                                        <td class="amount-payment">Rp <?php echo number_format($pihutang_penjualan_hari_ini_dibayar) ?></td>
                                    </tr>
                                    <tr class="table-success">
                                        <td><strong><i class="fas fa-calculator me-2"></i>Sisa Piutang</strong></td>
                                        <td class="amount-today"><strong>Rp <?php echo number_format($pihutang_penjualan_tahun_ini_sisa + $pihutang_penjualan_hari_ini_sisa) ?></strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel Ringkasan Total Kedua Lokasi -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header table-header">
                            <h4 class="mb-0">
                                <i class="fas fa-chart-pie me-2"></i>
                                Ringkasan Total Kedua Lokasi
                            </h4>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-bordered mb-0">
                                <thead class="table-dark">
                                    <tr>
                                        <th><i class="fas fa-tags me-1"></i> Kategori</th>
                                        <th><i class="fas fa-calendar-day me-1"></i> Hari Ini</th>
                                        <th><i class="fas fa-calendar-alt me-1"></i> Total Setahun Ini</th>
                                        <th><i class="fas fa-trophy me-1"></i> Grand Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong><i class="fas fa-shopping-bag me-2"></i>Total Penjualan</strong></td>
                                        <td class="amount-today">Rp <?php echo number_format($penjualanharinigrosirtotal + $penjualanhariniretailtotal) ?></td>
                                        <td class="amount-total">Rp <?php echo number_format($penjualantahuninigrosirtotal + $penjualantahuniniretailtotal) ?></td>
                                        <td class="amount-today"><strong>Rp <?php echo number_format($penjualanharinigrosirtotal + $penjualanhariniretailtotal + $penjualantahuninigrosirtotal + $penjualantahuniniretailtotal) ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td><strong><i class="fas fa-calculator me-2"></i>Total HPP</strong></td>
                                        <td class="amount-debt">Rp <?php echo number_format($penjualanharinigrosircogs + $penjualanhariniretailcogs) ?></td>
                                        <td class="amount-payment">Rp <?php echo number_format($penjualantahuninigrosircogs + $penjualantahuniniretailcogs) ?></td>
                                        <td class="amount-debt"><strong>Rp <?php echo number_format($penjualanharinigrosircogs + $penjualanhariniretailcogs + $penjualantahuninigrosircogs + $penjualantahuniniretailcogs) ?></strong></td>
                                    </tr>
                                    <tr class="table-warning">
                                        <td><strong><i class="fas fa-chart-line me-2"></i>Total Laba Kotor</strong></td>
                                        <td class="amount-total">Rp <?php echo number_format($penjualanharinigrosirlaba + $penjualanhariniretaillaba) ?></td>
                                        <td class="amount-total">Rp <?php echo number_format($penjualantahuninigrosirlaba + $penjualantahuniniretaillaba) ?></td>
                                        <td class="amount-total"><strong>Rp <?php echo number_format($penjualanharinigrosirlaba + $penjualanhariniretaillaba + $penjualantahuninigrosirlaba + $penjualantahuniniretaillaba) ?></strong></td>
                                    </tr>
                                    <tr class="table-info">
                                        <td><strong><i class="fas fa-percentage me-2"></i>Margin Rata-rata</strong></td>
                                        <td><strong><?php echo number_format(($penjualanharinigrosirtotal + $penjualanhariniretailtotal) > 0
                                                        ? (($penjualanharinigrosirlaba + $penjualanhariniretaillaba) / ($penjualanharinigrosirtotal + $penjualanhariniretailtotal) * 100)
                                                        : 0) ?> %</strong></td>
                                        <td><strong><?php echo number_format(($penjualantahuninigrosirtotal + $penjualantahuniniretailtotal) > 0
                                                        ? (($penjualantahuninigrosirlaba + $penjualantahuniniretaillaba) / ($penjualantahuninigrosirtotal + $penjualantahuniniretailtotal) * 100)
                                                        : 0) ?> %</strong></td>
                                        <td><strong><?php echo number_format(($penjualanharinigrosirtotal + $penjualanhariniretailtotal + $penjualantahuninigrosirtotal + $penjualantahuniniretailtotal) > 0
                                                        ? (($penjualanharinigrosirlaba + $penjualanhariniretaillaba + $penjualantahuninigrosirlaba + $penjualantahuniniretaillaba) / ($penjualanharinigrosirtotal + $penjualanhariniretailtotal + $penjualantahuninigrosirtotal + $penjualantahuniniretailtotal) * 100)
                                                        : 0) ?> %</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <!-- <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="card">
                    <div class="card-header table-header">
                        <h5 class="mb-0">
                            <i class="fas fa-chart-bar me-2"></i>
                            Penjualan & HPP (7 Hari Terakhir)
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="salesChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="card">
                    <div class="card-header table-header">
                        <h5 class="mb-0">
                            <i class="fas fa-chart-line me-2"></i>
                            Hutang & Piutang (7 Hari Terakhir)
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="debtChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="card">
                    <div class="card-header table-header">
                        <h5 class="mb-0">
                            <i class="fas fa-chart-pie me-2"></i>
                            Distribusi Penjualan per Lokasi
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="locationChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="card">
                    <div class="card-header table-header">
                        <h5 class="mb-0">
                            <i class="fas fa-chart-area me-2"></i>
                            Tren Pembayaran (7 Hari Terakhir)
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="paymentChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

            <!-- Add this new chart row after your existing charts -->
            <div class="row">
                <div class="col-lg-12 mb-4">
                    <div class="card">
                        <div class="card-header table-header">
                            <h5 class="mb-0">
                                <i class="fas fa-chart-line me-2"></i>
                                Perbandingan Penjualan Bulanan
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="monthlyComparisonChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="bg_primary_1 text-white mt-auto" style="padding: 0.75rem 1rem; font-size: 0.8rem; z-index: 10; position: relative;">
                <div class="container-fluid d-flex justify-content-between align-items-center">
                    <div>
                        <strong>&copy; <?php echo $thn_sekarang . " " . $perusahaan; ?></strong> by Developer. All rights reserved.
                    </div>
                    <div class="d-none d-sm-inline">
                        <b>Version</b> <?php echo $ver; ?>
                    </div>
                </div>
            </footer>
        </body>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Set current date
        document.getElementById('currentDate').textContent = new Date().toLocaleDateString('id-ID', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });

        // Function untuk kembali ke home (sesuaikan dengan kebutuhan)
        function goBackHome() {
            window.location.href = "../../main.php?route=home";
        }

        // Chart configurations
        // const chartOptions = {
        //     responsive: true,
        //     maintainAspectRatio: false,
        //     plugins: {
        //         legend: {
        //             position: 'top',
        //             labels: {
        //                 usePointStyle: true,
        //                 padding: 20
        //             }
        //         }
        //     },
        //     scales: {
        //         y: {
        //             beginAtZero: true,
        //             ticks: {
        //                 callback: function(value) {
        //                     return 'Rp ' + (value / 1000000).toFixed(1) + 'M';
        //                 }
        //             },
        //             grid: {
        //                 color: 'rgba(0,0,0,0.1)'
        //             }
        //         },
        //         x: {
        //             grid: {
        //                 color: 'rgba(0,0,0,0.1)'
        //             }
        //         }
        //     }
        // };

        // Sales & HPP Chart
        // const salesCtx = document.getElementById('salesChart').getContext('2d');
        // new Chart(salesCtx, {
        //     type: 'bar',
        //     data: {
        //         labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
        //         datasets: [{
        //             label: 'Penjualan Swalayan',
        //             data: [11500000, 13200000, 12800000, 14100000, 15600000, 13900000, 12500000],
        //             backgroundColor: 'rgba(25, 118, 210, 0.8)',
        //             borderColor: 'rgba(25, 118, 210, 1)',
        //             borderWidth: 2,
        //             borderRadius: 4
        //         }, {
        //             label: 'Penjualan Grosir',
        //             data: [26800000, 29500000, 31200000, 27900000, 32100000, 30500000, 28750000],
        //             backgroundColor: 'rgba(56, 142, 60, 0.8)',
        //             borderColor: 'rgba(56, 142, 60, 1)',
        //             borderWidth: 2,
        //             borderRadius: 4
        //         }, {
        //             label: 'HPP Swalayan',
        //             data: [8050000, 9240000, 8960000, 9870000, 10920000, 9730000, 8750000],
        //             backgroundColor: 'rgba(211, 47, 47, 0.6)',
        //             borderColor: 'rgba(211, 47, 47, 1)',
        //             borderWidth: 2,
        //             borderRadius: 4
        //         }, {
        //             label: 'HPP Grosir',
        //             data: [20060000, 22050000, 23340000, 20865000, 24015000, 22825000, 22100000],
        //             backgroundColor: 'rgba(123, 31, 162, 0.6)',
        //             borderColor: 'rgba(123, 31, 162, 1)',
        //             borderWidth: 2,
        //             borderRadius: 4
        //         }]
        //     },
        //     options: chartOptions
        // });

        // Debt Chart
        // const debtCtx = document.getElementById('debtChart').getContext('2d');
        // new Chart(debtCtx, {
        //     type: 'line',
        //     data: {
        //         labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
        //         datasets: [{
        //             label: 'Hutang Pembelian',
        //             data: [12500000, 14200000, 13800000, 16100000, 14600000, 13900000, 15250000],
        //             borderColor: 'rgba(211, 47, 47, 1)',
        //             backgroundColor: 'rgba(211, 47, 47, 0.1)',
        //             tension: 0.4,
        //             fill: true,
        //             borderWidth: 3,
        //             pointBackgroundColor: 'rgba(211, 47, 47, 1)',
        //             pointBorderColor: '#fff',
        //             pointBorderWidth: 2,
        //             pointRadius: 6,
        //             pointHoverRadius: 8
        //         }, {
        //             label: 'Piutang PayLater',
        //             data: [5200000, 6800000, 7200000, 5900000, 6500000, 7100000, 6750000],
        //             borderColor: 'rgba(25, 118, 210, 1)',
        //             backgroundColor: 'rgba(25, 118, 210, 0.1)',
        //             tension: 0.4,
        //             fill: true,
        //             borderWidth: 3,
        //             pointBackgroundColor: 'rgba(25, 118, 210, 1)',
        //             pointBorderColor: '#fff',
        //             pointBorderWidth: 2,
        //             pointRadius: 6,
        //             pointHoverRadius: 8
        //         }]
        //     },
        //     options: chartOptions
        // });

        // Location Distribution Chart
        // const locationCtx = document.getElementById('locationChart').getContext('2d');
        // new Chart(locationCtx, {
        //     type: 'doughnut',
        //     data: {
        //         labels: ['Swalayan', 'Grosir'],
        //         datasets: [{
        //             data: [12500000, 28750000],
        //             backgroundColor: [
        //                 'rgba(25, 118, 210, 0.8)',
        //                 'rgba(56, 142, 60, 0.8)'
        //             ],
        //             borderColor: [
        //                 'rgba(25, 118, 210, 1)',
        //                 'rgba(56, 142, 60, 1)'
        //             ],
        //             borderWidth: 3,
        //             hoverOffset: 10
        //         }]
        //     },
        //     options: {
        //         responsive: true,
        //         maintainAspectRatio: false,
        //         plugins: {
        //             legend: {
        //                 position: 'bottom',
        //                 labels: {
        //                     usePointStyle: true,
        //                     padding: 20,
        //                     font: {
        //                         size: 14,
        //                         weight: 'bold'
        //                     }
        //                 }
        //             },
        //             tooltip: {
        //                 callbacks: {
        //                     label: function(context) {
        //                         const value = context.parsed;
        //                         const total = context.dataset.data.reduce((a, b) => a + b, 0);
        //                         const percentage = ((value / total) * 100).toFixed(1);
        //                         return context.label + ': Rp ' + (value / 1000000).toFixed(1) + 'M (' + percentage + '%)';
        //                     }
        //                 },
        //                 backgroundColor: 'rgba(0,0,0,0.8)',
        //                 titleColor: '#fff',
        //                 bodyColor: '#fff',
        //                 borderColor: 'rgba(255,255,255,0.2)',
        //                 borderWidth: 1
        //             }
        //         },
        //         cutout: '60%'
        //     }
        // });

        // Payment Trend Chart
        // const paymentCtx = document.getElementById('paymentChart').getContext('2d');
        // new Chart(paymentCtx, {
        //     type: 'line',
        //     data: {
        //         labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
        //         datasets: [{
        //             label: 'Pembayaran Hutang',
        //             data: [7200000, 8500000, 6800000, 9200000, 7800000, 8100000, 8500000],
        //             borderColor: 'rgba(56, 142, 60, 1)',
        //             backgroundColor: 'rgba(56, 142, 60, 0.1)',
        //             tension: 0.4,
        //             fill: true,
        //             borderWidth: 3,
        //             pointBackgroundColor: 'rgba(56, 142, 60, 1)',
        //             pointBorderColor: '#fff',
        //             pointBorderWidth: 2,
        //             pointRadius: 6,
        //             pointHoverRadius: 8
        //         }, {
        //             label: 'Pembayaran Piutang',
        //             data: [3200000, 4100000, 3800000, 4500000, 3600000, 4200000, 3850000],
        //             borderColor: 'rgba(123, 31, 162, 1)',
        //             backgroundColor: 'rgba(123, 31, 162, 0.1)',
        //             tension: 0.4,
        //             fill: true,
        //             borderWidth: 3,
        //             pointBackgroundColor: 'rgba(123, 31, 162, 1)',
        //             pointBorderColor: '#fff',
        //             pointBorderWidth: 2,
        //             pointRadius: 6,
        //             pointHoverRadius: 8
        //         }]
        //     },
        //     options: chartOptions
        // });

        // Monthly Comparison Chart
        const monthlyCtx = document.getElementById('monthlyComparisonChart').getContext('2d');

        // Get data from PHP
        const thisMonthDailySales = <?php echo json_encode($thisMonthSalesJS); ?>;
        const previousMonthAverage = <?php echo $previousMonthAverage; ?>;
        const totalDaysInMonth = <?php echo $daysInCurrentMonth; ?>;
        const actualDaysToShow = <?php echo $actualDaysToShow; ?>;

        // Create labels for days shown (only up to current day)
        const monthlyLabels = Array.from({
            length: actualDaysToShow
        }, (_, index) => `${index + 1}`);

        // Create previous month average line (only for days shown)
        const previousMonthAverageLine = new Array(actualDaysToShow).fill(previousMonthAverage);

        // No need to extend data since we only show actual days
        const extendedThisMonthSales = thisMonthDailySales;

        new Chart(monthlyCtx, {
            type: 'line',
            data: {
                labels: monthlyLabels,
                datasets: [{
                    label: 'Penjualan Harian Bulan Ini',
                    data: extendedThisMonthSales,
                    borderColor: 'rgba(25, 118, 210, 1)',
                    backgroundColor: 'rgba(25, 118, 210, 0.1)',
                    tension: 0.4,
                    fill: false,
                    borderWidth: 2,
                    pointBackgroundColor: 'rgba(25, 118, 210, 1)',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    spanGaps: false
                }, {
                    label: 'Rata-rata Bulan Lalu',
                    data: previousMonthAverageLine,
                    borderColor: 'rgba(211, 47, 47, 1)',
                    backgroundColor: 'transparent',
                    borderWidth: 3,
                    pointRadius: 0,
                    pointHoverRadius: 0,
                    borderDash: [10, 5],
                    fill: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            padding: 20
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const value = context.parsed.y;
                                const label = context.dataset.label;
                                if (value === 0 && context.datasetIndex === 0) {
                                    return label + ': Libur/Tutup';
                                }
                                return label + ': Rp ' + (value / 1000000).toFixed(1) + ' Juta';
                            }
                        },
                        backgroundColor: 'rgba(0,0,0,0.8)',
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        borderColor: 'rgba(255,255,255,0.2)',
                        borderWidth: 1
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + (value / 1000000).toFixed(1) + ' Juta';
                            }
                        },
                        grid: {
                            color: 'rgba(0,0,0,0.1)'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Hari ke-'
                        },
                        grid: {
                            color: 'rgba(0,0,0,0.1)'
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                }
            }
        });

        // Add loading animation
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.card');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                setTimeout(() => {
                    card.style.transition = 'all 0.6s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, (index + 1) * 100); // Changed index * 100 to (index + 1) * 100
            });
        });

        // Add number counter animation
        function animateNumbers() {
            const numberElements = document.querySelectorAll('.amount-today, .amount-total, .amount-debt, .amount-payment');

            numberElements.forEach(element => {
                const text = element.textContent;
                const number = parseFloat(text.replace(/[^\d.-]/g, ''));

                if (!isNaN(number)) {
                    let currentNumber = 0;
                    const increment = number / 100;
                    const timer = setInterval(() => {
                        currentNumber += increment;
                        if (currentNumber >= number) {
                            clearInterval(timer);
                            currentNumber = number;
                        }

                        // Format number back to currency
                        const formattedNumber = 'Rp ' + Math.floor(currentNumber).toLocaleString('id-ID');
                        element.textContent = formattedNumber;
                    }, 20);
                }
            });
        }

        // Start number animation when page loads
        setTimeout(animateNumbers, 500);
    </script>

    </html>
<?php } ?>