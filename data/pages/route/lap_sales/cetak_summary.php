<?php

include '../../../../config/koneksi.php';
include '../../../../config/fungsi_rupiah.php';
include '../../../../config/library.php';

session_start();

$login_hash = $_SESSION['login_hash'];
$en = $_SESSION['employee_number'];
$namauser = $_SESSION['namauser'];

$judulform = "Sales Report ";

$data = 'lap_sales';
$rute = 'rekap_sales_report';
$aksi = 'aksi_rekap_sales_report';

$tabel = "penjualan";
$f1 = 'faktur';
$f2 = 'tanggal';
$f3 = 'kd_cus';
$f4 = 'kd_aplikasi';
$f5 = 'no_meja';
$f6 = 'oleh';
$f7 = 'subjumlah';
$f8 = 'ppn';
$f9 = 'jumlah';
$f10 = 'byr_pocer';
$f11 = 'byr_tunai';
$f12 = 'byr_non_tunai';
$f13 = 'kd_alatbayar';
$f14 = 'no_urut';
$f15 = 'tahun';
$f16 = 'bulan';
$f17 = 'jam';
$f18 = 'kdsub_alatbayar';
$f19 = 'subjumlah_offline';
$f20 = 'ket_aplikasi';
$f21 = 'dasar_fee';
$f22 = 'acuan_fee';
$f23 = 'tarif_fee';
$f24 = 'b_packing';
$f25 = 'no_online';
$f26 = 'no_ofline';
$f27 = 'tarif_pb1';
$f28 = 'faktur_refund';
$f29 = 'dasar_faktur';

$j1 = 'Faktur';
$j2 = 'Tanggal';
$j3 = 'Kode Outlet';
$j4 = 'kd_aplikasi';
$j5 = 'no_meja';
$j6 = 'oleh';
$j7 = 'Sub jumlah';
$j8 = 'PPn';
$j9 = 'Jumlah';
$j10 = 'byr_pocer';
$j11 = 'byr_tunai';
$j12 = 'byr_non_tunai';
$j13 = 'kd_alatbayar';
$j14 = 'no_urut';
$j15 = 'tahun';
$j16 = 'bulan';
$j17 = 'jam';
$j18 = 'kdsub_alatbayar';
$j19 = 'subjumlah_offline';
$j20 = 'ket_aplikasi';
$j21 = 'dasar_fee';
$j22 = 'acuan_fee';
$j23 = 'tarif_fee';
$j24 = 'b_packing';
$j25 = 'no_online';
$j26 = 'no_ofline';
$j27 = 'tarif_pb1';
$j28 = 'faktur_refund';
$j29 = 'dasar_faktur';


$tabel2 = 'kotabaru';
$ff1 = 'kode';
$tabel3 = 'pelanggan';
$gg1 = 'kd_cus';


?>

<html>

<head>
    <title><?php echo $judulform; ?></title>

    <!-- <link rel="stylesheet" type="text/css" href="../style_cetak.css"> -->
    <style type="text/css">
        table {
            border-collapse: collapse;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
        }

        td {
            font-size: 11px;
        }

        table,
        td,
        th {
            border: 1px solid gray;
            padding: 1px;
        }

        th {
            padding-top: 10px;
            padding-bottom: 10px;
            border: 1px solid gray;
        }
    </style>

</head>

<body style='font-family:Arial;background-color: ghostwhite;font-size: 8pt;' onload="printOut()">
    <?php

    $tgl_awal = $_GET['tgl_awal'];
    $tgl_akhir = $_GET['tgl_akhir'];
    $filter = $_GET['filter'];
    $nilai = $_GET['nilai'];
    $tes = $_GET['tes'];
    $kategori_retail_grosir = $_GET['kategori_retail_grosir'];
    $kategori_sub_alat_bayar = $_GET['kategori_sub_alat_bayar'];


    // echo "<br/>".$tgl_awal;
    // echo "<br/>".$tgl_akhir;
    // echo "<br/>".$filter;
    // echo "<br/>".$nilai;

    if ($filter == 'kota') {
        $kondisi = "AND pelanggan.kd_kota='$nilai'";
        $query = mysqli_query($koneksi, "SELECT * FROM kotabaru WHERE kode='$nilai' ");
        $q1 = mysqli_fetch_array($query);
        $judul_nilai = $q1['nama'];
    } elseif ($filter == 'outlet') {
        $kondisi = "AND penjualan.kd_cus='$nilai'";
        $query = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE kd_cus='$nilai' ");
        $q1 = mysqli_fetch_array($query);
        $judul_nilai = $q1['nama'];
    } elseif ($filter == 'area') {
        $kondisi = "AND kotabaru.kd_area='$nilai'";
        $query = mysqli_query($koneksi, "SELECT * FROM area WHERE kode='$nilai' ");
        $q1 = mysqli_fetch_array($query);
        $judul_nilai = $q1['nama'];
    } else {
        $kondisi = "";
        $judul_nilai = '';
    }

    if ($login_hash == '6' or $login_hash == '7' or $login_hash == '2') {
        $kondisiJoin = "";
        if ($kategori_retail_grosir == "Retail") {
            $kondisiJoin = " AND b_paking <= 1";
        } else if ($kategori_retail_grosir == "Grosir") {
            $kondisiJoin = " AND b_paking >= 2";
        }
        $query = mysqli_query($koneksi, "SELECT cabang_e,name_e FROM employee WHERE employee_number='$en' ");
        $q1 = mysqli_fetch_array($query);
        $nilai = $q1['cabang_e'];
        if ($login_hash == '2') {
            $nilai = 1316;
        }
        $kondisi = "";
        if ($login_hash == '7') {
            $tes = $q1['name_e'];
            $kondisi = "AND oleh='$tes'";
        }
        if ($filter == 'area') {
            $kondisi = "AND oleh='$tes'";
        }
        if ($kategori_sub_alat_bayar != "Semua") {
            $kondisi .= " AND kdsub_alatbayar  = '$kategori_sub_alat_bayar'";
        }
        $query = mysqli_query($koneksi, "SELECT nama FROM pelanggan WHERE kd_cus='$nilai' ");
        $q1 = mysqli_fetch_array($query);
        $judul_nilai = $q1['nama'];
        // $tgl_akhir=$tgl_awal;
        // $filter = 'Outlet';
    }

    $judul = 'Laporan ' . $judulform;
    $judul2 = $filter . " : " . $judul_nilai;
    $judul3 = 'Date : ' . $tgl_awal . " s/d " . $tgl_akhir;

    ?>

    <div class="row">
        <strong>
            <h2><?php echo $judulform; ?></h2>
        </strong>
        <br>
        <?php echo $judul2; ?>
        <br>
        <?php echo $judul3; ?>
        <br>
        Kasir : <?php echo $tes; ?>
        <br>
        By : <?php echo $namauser; ?>
    </div>
    <div class="box">

        <?php if ($filter == 'outlet' or $login_hash == '6' or $login_hash == '7' or $login_hash == '2') { ?>

            <div class="box-body">
                <div class="table-responsive">

                    <div style="margin:10px"></div>

                    <table id="example" class="table table-bordered table-striped">

                        <thead style="background-color:  lightgray;" class="elevation-2">
                            <!-- <tr>
                                <th style="text-align:center;width: 30px;">No.</th>
                                <th style="width: 200px;">Menu Code</th>
                                <th style="text-align:right ;width:40px;">Qty</th>
                                <th style="text-align: right;width: 80px;">Payment</th>
                            </tr> -->
                        </thead>
                        <tbody>
                            <?php


                            // UTK GRAND TOTAL

                            //                 $query = "SELECT 
                            //   sum(penjualan.jumlah) as rekap_jumlah,oleh,
                            // 	sum(penjualan.ongkir) as rekap_ongkir,
                            // 	sum(penjualan.voucher_nilai_diskon+ penjualan.byr_pocer) as rekap_voucher_nilai_diskon,
                            // 	sum(penjualan.jumlah+penjualan.ongkir-penjualan.voucher_nilai_diskon- penjualan.byr_pocer) as rekap_semua_total
                            //   FROM penjualan 
                            // --   join jenis_transaksi on jenis_transaksi.kd_jenis=penjualan.kd_aplikasi 
                            //   join alat_bayar on alat_bayar.kd_alat=penjualan.kd_alatbayar 
                            //   WHERE penjualan.faktur_void IS NULL AND penjualan.tanggal>='$tgl_awal' AND penjualan.tanggal <= '$tgl_akhir' +interval 1 day $kondisi $kondisiJoin
                            //   ";

                            //                 $sql = mysqli_query($koneksi, $query);
                            //                 $s1 = mysqli_fetch_array($sql);

                            //                 $grand_penjualan = $s1['rekap_jumlah'];
                            //                 $grand_ongkir = $s1['rekap_ongkir'];
                            //                 $grand_voucher_nilai_diskon = $s1['rekap_voucher_nilai_diskon'];
                            //                 $grand_semua_total = $s1['rekap_semua_total']; 
                            ?>
                        </tbody>
                        <tfoot align="right">
                            <!-- <tr>
                                <td colspan="4">Total Harga </td>
                                <td colspan="2" align="right" style="font-size:105%;font-weight:600"><?php echo number_format($grand_penjualan); ?></td>
                            </tr>

                            <tr>
                                <td colspan="4">Total Ongkir </td>
                                <td colspan="2" align="right"><?php echo number_format($grand_ongkir); ?></td>
                            </tr>
                            <tr>
                                <td colspan="4">Total Voucher </td>
                                <td colspan="2" align="right"><?php echo number_format($grand_voucher_nilai_diskon); ?></td>
                            </tr>
                            <tr>
                                <td colspan="4">Total Semua </td>
                                <td colspan="2" align="right"><?php echo number_format($grand_semua_total); ?></td>
                            </tr>
                            <br> -->
                            <?php


                            $query2 = "SELECT 
				sum(penjualan.byr_tunai) as rekap_tunai
				FROM penjualan 
				WHERE penjualan.faktur_void IS NULL AND penjualan.tanggal>='$tgl_awal' AND penjualan.tanggal <= '$tgl_akhir' +interval 1 day $kondisi $kondisiJoin ";

                            $sql2 = mysqli_fetch_array(mysqli_query($koneksi, $query2));

                            $nilai_tunai_khusus = $sql2['rekap_tunai'] ?? 0;
                            ?>
                            <tr>
                                <td colspan="4">TUNAI</td>
                                <td colspan="2" align="right"><?php echo number_format($nilai_tunai_khusus); ?></td>
                            </tr>
                            <?php

                            $nilai_non_tunai_khusus = 0;

                            $query1 = "SELECT  
				alat_bayar.nama as ab_nama,
				penjualan.kd_alatbayar as p_alat_bayar, 
				sum(penjualan.byr_tunai) as rekap_tunai,
				sum(penjualan.byr_non_tunai) as rekap_non_tunai
				FROM penjualan
				join alat_bayar on alat_bayar.kd_alat=penjualan.kd_alatbayar 
				WHERE penjualan.faktur_void IS NULL AND penjualan.tanggal>='$tgl_awal' AND penjualan.tanggal <= '$tgl_akhir' +interval 1 day $kondisi $kondisiJoin 
				GROUP By p_alat_bayar
				";

                            $sql = mysqli_query($koneksi, $query1);


                            $jumlah_tunai = 0;
                            $jumlah_edc_bca = 0;
                            $jumlah_edc_mandiri = 0;

                            while ($qq1 = mysqli_fetch_array($sql)) {
                                if ($qq1['ab_nama'] == 'TUNAI') {
                                } else {
                                    $nilai_non_tunai_khusus += $qq1['rekap_non_tunai'];
                            ?>
                                    <tr>
                                        <td colspan="4"><?php echo $qq1['ab_nama']; ?></td>
                                        <td colspan="2" align="right"><?php echo number_format($qq1['rekap_non_tunai']); ?></td>
                                    </tr>

                            <?php
                                }
                            }

                            ?>
                            <tr style="font-weight:600;font-size:110%">
                                <td colspan="4">Total</td>
                                <td colspan="2" align="right"><?php echo number_format($nilai_non_tunai_khusus + $nilai_tunai_khusus); ?></td>
                            </tr>

                            <!-- <tr>
                                <td colspan="2">Total Voucher </td>
                                <td colspan="2" align="right"><?php echo number_format($grand_pocer); ?></td>
                            </tr>

                            <tr>
                                <td colspan="2">Total Jumlah </td>
                                <td colspan="2" align="right" style="font-size:105%;font-weight:600"><?php echo number_format($grand_penjualan); ?></td>
                            </tr>
                            <tr>
                                <td colspan="2">Total Pajak </td>
                                <td colspan="2" align="right"><?php echo number_format($grand_ppn); ?></td>

                            </tr> -->

                        </tfoot>

                    </table>

                    <!-- <table id="example" class="table table-bordered table-striped">

                        <thead style="background-color:  lightgray;" class="elevation-2">

                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>

                            <tr>
                                <td colspan="2">Total Voucher </td>
                                <td colspan="2" align="right"><?php echo number_format($grand_pocer); ?></td>
                            </tr>

                            <tr>
                                <td colspan="2">Total Jumlah </td>
                                <td colspan="2" align="right" style="font-size:105%;font-weight:600"><?php echo number_format($grand_penjualan); ?></td>
                            </tr>
                            <tr>
                                <td colspan="2">Total Pajak </td>
                                <td colspan="2" align="right"><?php echo number_format($grand_ppn); ?></td>
                            </tr>
                        </tfoot>
                    </table> -->
                </div><!-- /.box-body -->

            </div><!-- /.box -->

        <?php
        } ?>
    </div>

    <br />

    <div class="row" style="font-size:80%">
        <footer class="main-footer bg_primary_1" style="padding:.3rem;">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                <b>Version</b> <?php echo $ver; ?>
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2020-<?php echo $thn_sekarang . " " . $perusahaan; ?>.</strong> by Develop. All rights Reserved.
        </footer>
    </div>
    <br />

</body>
<script>
    var lama = 2000;
    t = null;

    function printOut() {
        window.print();
        t = setTimeout("history.go(-1)", lama);
    }
</script>

</html>