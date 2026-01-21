<?php

$judulform = 'Purchase Order ';

$data = 'data_purchase_order';
$rute = 'purchase_order';
$aksi = 'generate_invoice';

$rute_detail = 'purchase_order_view';

$rute_detail2 = 'invoice_tambah_po';



$tabel = 'pembelian';

$f1 = 'kd_beli';
$f2 = 'tgl_beli';
$f3 = 'kd_supp';
$f4 = 'ket_payment';
$f5 = 'status_payment';
$f6 = 'jenis_po';
$f7 = 'ppn';
$f8 = 'status_pembelian';
$f9 = 'kd_po';
$f10 = 'tgl_po';
$f11 = 'tgl_rilis';
$f12 = 'durasi_kirim';
$f13 = 'term_payment';
$f14 = 'user_input';
$f15 = 'tujuan_kirim';
$f16 = 'statuts_invoice';
$f17 = 'tenggat_waktu';


$j1 = 'Kode Purchase Request';
$j2 = 'Tanggal';
$j3 = 'Kode Supplier';
$j4 = 'Ket Payment';
$j5 = 'Status';
$j6 = 'Jenis';
$j7 = 'PB1';
$j8 = 'Status Pembelian';
$j9 = 'Kode Purchase Order';
$J10 = 'Tgl Po';
$j11 = 'Tgl Rilis';
$j12 = 'Durasi Kirim';
$j13 = 'Term Of Payment';
$j14 = 'User Input';
$j15 = 'Tujuan Kirim';
$j16 = 'Status Invoice';
$j17 = 'Tenggat Waktu';

$tabel2 = 'pembelian_detail';
$ff1 = 'kd_beli';
$ff2 = 'kd_brg';
$ff3 = 'jml';
$ff4 = 'price';
$ff5 = 'currency';
$ff6 = 'kurs';
$ff7 = 'disc';
$ff8 = 'urut';
$ff9 = 'satuan';
$ff10 = 'jumlah_pcs';
$ff11 = 'kd_po';
$ff12 = 'status_terima';


$jj1 = 'Kd Beli';
$jj2 = 'kd Barang';
$jj3 = 'Jumlah';
$jj4 = 'Price';
$jj5 = 'Currency';
$jj6 = 'Kurs';
$jj7 = 'Disc';
$jj8 = 'Urut';
$jj9 = 'Satuan';
$jj10 = 'Jumlah Pcs';
$jj11 = 'Kd Po';
$jj12 = 'Status Terima';

//session_start();
if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
    echo "<link href='style.css' rel='stylesheet' type='text/css'>
	<center>Untuk mengakses modul, Anda harus login <br>";
    echo "<a href=../../index.php><b>LOGIN</b></a></center>";
} else {

    switch ($_GET['act']) {
        default:


            $id = $_GET['id'];

            $query = mysqli_query($koneksi, "SELECT $tabel.* , supplier.nama from $tabel JOIN supplier ON supplier.kd_supp = $tabel.kd_supp where $f1='$_GET[id]'");
            // 	if (!$query) {
            // 		$error_message = mysqli_error($koneksi);
            // 		echo "<script>alert('Query gagal: " . addslashes($error_message) . "');</script>";
            // }

            if (!$query) {
                $querry_message = mysqli_error($koneksi);
                echo "<script>alert('Querry gagal '.$querry_message )</script>";
            }

            $q1 = mysqli_fetch_array($query);
            $kdSupp = $q1['kd_supp'];
            $namaSupp = $q1['nama'];
            $kd_po = $q1['kd_po'];

            $query2 = mysqli_query($koneksi, "SELECT * from $tabel2 where $ff1='$_GET[id]' ");
            $q2 = mysqli_fetch_array($query2);

            if ($q1['ppn'] == 1) {
                $ppn = 'PPN';
            } else {
                $ppn = 'Non PPN';
            }
            $input_oleh = $q1['user_input'];
            $sql3 = "SELECT name_e FROM employee WHERE employee_number = '$input_oleh' ";
            $result3 = mysqli_query($koneksi, $sql3);

            if ($s3 = mysqli_fetch_array($result3)) {
                $nama_karyawan = $s3['name_e'];
            } else {
                $nama_karyawan = '-';
            }

            $sql4 = "SELECT no_invoice FROM pembelian_invoice WHERE kd_po ='$kd_po'";
            $result4 = mysqli_query($koneksi, $sql4);
            if ($s4 = mysqli_fetch_array($result4)) {
                $no_invoice = $s4['no_invoice'];
            } else {
                $no_invoice = '-';
            }

            // Query untuk mendapatkan kd_cus dan nama_pelanggan berdasarkan tujuan_kirim
            $query = "SELECT pelanggan.kd_cus, pelanggan.nama AS nama_pelanggan 
            FROM pelanggan 
            WHERE pelanggan.kd_cus = '" . $q1['tujuan_kirim'] . "'";
            $result = mysqli_query($koneksi, $query);

            // Tambahkan pengecekan error pada query
            if (!$result) {
                die("Query Error: " . mysqli_error($koneksi));
            }

            // Cek apakah ada hasil
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $kd_cus = $row['kd_cus'];
                $nama_cus = $row['nama_pelanggan'];
                echo "kd_cus untuk tujuan kirim {$q1['tujuan_kirim']} adalah: $kd_cus, Nama Pelanggan: $nama_cus";
            } else {
                echo "Data tidak ditemukan untuk tujuan kirim {$q1['tujuan_kirim']}";
            }

            $dir = '../../';
?>

            <style>
                /* *{
        display: none;
    } */
                #hide {
                    display: none;
                }
            </style>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper" style="height:70%">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="list-gds wow slideInUp" data-wow-duration=".5s" data-wow-delay=".1s">
                                    <b><?php echo $judulform; ?></b> <small>view</small>
                                </h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="main.php?route=home">Beranda</a></li>
                                    <li class="breadcrumb-item active"><a href="main.php?route=<?php echo $rute; ?>&act"><?php echo $judulform; ?></a></li>
                                    <li class="breadcrumb-item active"> view</li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>

                <!-- Main content -->
                <section class="content" style="height:90%">
                    <div class="container-fluid table-responsive" style="height:100%">
                        <div class="card card-default">
                            <!-- /.card-header -->
                            <div class="card-body" style="height:70%">
                                <div class="row">
                                    <!-- right column -->
                                    <div class="col-md-12">
                                        <!-- general form elements disabled -->
                                        <div class="box box-warning">
                                            <div class="box-body">
                                                <div class="row" style="background-color:ghostwhite;">
                                                    <!-- baris 1 -->
                                                    <form method="POST" action="route/<?php echo $data; ?>/<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=edit&id=<?php echo $q1[$f1]; ?>">

                                                        <div class="row">
                                                            <!-- Kiri - Informasi Utama -->
                                                            <div class="col-lg-8">
                                                                <div class="row">
                                                                    <!-- Nomor Invoice -->
                                                                    <div class="col-md-6 col-lg-4 mb-3">
                                                                        <div class="form-group">
                                                                            <label>Nomor Invoice</label>
                                                                            <input type="text" name="no_invoice" class="form-control" value="<?php echo $no_invoice; ?>" readonly />
                                                                        </div>
                                                                    </div>

                                                                    <!-- ID -->
                                                                    <div class="col-md-6 col-lg-4 mb-3">
                                                                        <div class="form-group">
                                                                            <label><?php echo $j9; ?></label>
                                                                            <input type="text" name="<?php echo $f1; ?>" class="form-control" value="<?php echo $kd_po; ?>" readonly />
                                                                        </div>
                                                                    </div>

                                                                    <!-- Kode Supplier -->
                                                                    <div class="col-md-6 col-lg-4 mb-3">
                                                                        <div class="form-group">
                                                                            <label><?php echo $j3; ?></label>
                                                                            <input type="text" name="<?php echo $f3; ?>" class="form-control" value="<?php echo $kdSupp; ?>" readonly />
                                                                        </div>
                                                                    </div>

                                                                    <!-- Nama Supplier -->
                                                                    <div class="col-md-6 col-lg-4 mb-3">
                                                                        <div class="form-group">
                                                                            <label>Nama Supplier</label>
                                                                            <input type="text" name="nama_supplier" class="form-control" value="<?php echo $namaSupp; ?>" readonly />
                                                                        </div>
                                                                    </div>

                                                                    <!-- Diinput Oleh -->
                                                                    <div class="col-md-6 col-lg-4 mb-3">
                                                                        <div class="form-group">
                                                                            <label>Diinput Oleh</label>
                                                                            <input type="text" name="<?php echo $f14; ?>" class="form-control" value="<?php echo $nama_karyawan; ?>" readonly />
                                                                        </div>
                                                                    </div>

                                                                    <!-- Tanggal Purchase Order -->
                                                                    <div class="col-md-6 col-lg-4 mb-3">
                                                                        <div class="form-group">
                                                                            <label><?php echo $j2; ?> Purchase Order</label>
                                                                            <input type="date" class="form-control" name="<?php echo $f2; ?>" value="<?php echo $q1['tgl_rilis'] ?>" readonly />
                                                                        </div>
                                                                    </div>

                                                                    <!-- PPN -->
                                                                    <div class="col-md-6 col-lg-4 mb-3">
                                                                        <div class="form-group">
                                                                            <label>PPN</label>
                                                                            <input type="text" class="form-control" value="<?php echo ($q1['ppn'] == 1) ? 'PPN' : 'Non PPN'; ?>" readonly />
                                                                            <input type="hidden" name="ppn" value="<?php echo $q1['ppn']; ?>" />
                                                                        </div>
                                                                    </div>

                                                                    <!-- Tarif PPN -->
                                                                    <?php if ($q1['ppn'] == 1): ?>
                                                                        <div class="col-md-6 col-lg-4 mb-3">
                                                                            <div class="form-group">
                                                                                <label>Tarif PPN</label>
                                                                                <input type="text" class="form-control" name="tarif_ppn" value="<?php echo $q1['tarif_ppn']; ?> %" readonly />
                                                                            </div>
                                                                        </div>
                                                                    <?php endif; ?>

                                                                    <!-- Tujuan Kirim -->
                                                                    <div class="col-md-6 col-lg-4 mb-3">
                                                                        <div class="form-group">
                                                                            <label>Tujuan Kirim</label>
                                                                            <input type="text" class="form-control" value="<?php echo $q1['tujuan_kirim']; ?> - <?php echo $nama_cus; ?> " readonly />
                                                                            <input type="hidden" name="<?= $f15; ?>" class="form-control" value="<?php echo $q1['tujuan_kirim']; ?>" readonly />
                                                                        </div>
                                                                    </div>
                                                                </div> <!-- row -->
                                                            </div> <!-- col-lg-8 -->

                                                            <!-- Kanan - Tanggal dan Detail Tagihan -->
                                                            <div class="col-lg-4">
                                                                <div class="row">
                                                                    <!-- Tanggal di ujung kanan -->
                                                                    <div class="col-12 mb-3">
                                                                        <div class="form-group">
                                                                            <label><?php echo $j2; ?> Purchase Order</label>
                                                                            <input type="date" class="form-control" name="<?php echo $f2; ?>" value="<?php echo $q1['tgl_rilis'] ?>" readonly />
                                                                        </div>
                                                                    </div>

                                                                    <!-- Sub Total, Ongkir, dan Total Tagihan dalam satu baris -->
                                                                    <div class="col-4 mb-3">
                                                                        <div class="form-group">
                                                                            <label>Sub Total</label>
                                                                            <input type="text" id="ttg" class="form-control" value="<?php echo $stotal; ?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-4 mb-3">
                                                                        <div class="form-group">
                                                                            <label>Selisih</label>
                                                                            <input type="text" id="ongkir" class="form-control" value="<?php echo $ongkir; ?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-4 mb-3">
                                                                        <div class="form-group">
                                                                            <label>Total Tagihan</label>
                                                                            <input type="text" id="totalTagihan" class="form-control" value="" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div> <!-- row -->
                                                            </div> <!-- col-lg-4 -->
                                                        </div> <!-- row -->



                                                        <hr>

                                                        <table id="example1" width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-bordered table-striped">
                                                            <thead style="background-color: #ddd;">
                                                                <tr style="font-weight:600">
                                                                    <td align="center" width="40px">No</td>
                                                                    <td align="left" width="120px"><?php echo $jj2; ?></td>
                                                                    <td align="left" width="240px">Nama Barang</td>
                                                                    <td align="left">QTY Barang datang</td>
                                                                    <td align="left">QTY Berdasarkan PO</td>
                                                                    <td align="left" width="50px">Satuan</td>
                                                                    <td align="left" width="240px"><?php echo $jj4; ?></td>
                                                                    <td align="left" width="240px">SubTotal</td>
                                                                    <td align="right" width="100px">Diskon</td>
                                                                    <td align="right" width="100px">PPN</td>
                                                                    <td align="right" width="100px">Total</td>
                                                                    <!-- <td align="center" style="min-width:60px;width: 80px;">Aksi</td> -->
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $no = 1;
                                                                $subtotal = 0;
                                                                $stotal = 0;
                                                                $sql1 = mysqli_query($koneksi, "SELECT pd.*, pembelian.ppn, barang.nama, pembelian.tarif_ppn,pembelian_invoice.ongkir,
                                                                (SELECT pb.jumlah_datang
                                                                    FROM penerimaan_barang pb
                                                                    WHERE pb.kd_po = pd.kd_po AND pb.kd_brg = pd.kd_brg AND  pd.urut = pb.urut
                                                                    LIMIT 1) as jumlah_datang
                                                                FROM $tabel2 pd
                                                                JOIN barang ON barang.kd_brg = pd.kd_brg
                                                                JOIN pembelian ON pembelian.kd_beli = pd.kd_beli
                                                                LEFT JOIN penerimaan_barang pb ON pb.kd_po = pd.kd_po AND pb.kd_brg = pd.kd_brg
                                                                LEFT JOIN pembelian_invoice ON pembelian_invoice.kd_po = pd.kd_po
                                                                WHERE pd.kd_beli = '$_GET[id]'
                                                                GROUP BY pd.urut
                                                                ORDER BY pd.urut ASC
                                                                
                                                                ");
                                                                if (!$sql1) {
                                                                    die("Query Error" . mysqli_error($koneksi));
                                                                }
                                                                // $sql1=mysqli_query($koneksi,$query);
                                                                $no = 1;
                                                                while ($s1 = mysqli_fetch_array($sql1)) {
                                                                    $sql2 = mysqli_query($koneksi, "SELECT kd_po, kd_brg, SUM(disc) as tot_disc, SUM(price) as tot_price  FROM pembelian_detail WHERE kd_po='$s1[kd_po]' GROUP BY kd_brg");
                                                                    if (!$sql2) {
                                                                        die('Query error: ' . mysqli_error($koneksi));
                                                                    }
                                                                    $s2 = mysqli_fetch_array($sql2);

                                                                    $total_harga = $s1['jumlah_datang'] * $s1['price'];
                                                                    $grand_total = $total_harga - $s1['disc']; // Inisialisasi grand_total untuk akumulasi

                                                                    // Jika grand_total diubah, pastikan diskon juga dihitung
                                                                    // echo $s1['ppn'] ."<br>";

                                                                    if ($s1['ppn'] == 1) {
                                                                        $nilai_pjk = $grand_total * $s1['tarif_ppn'] / 100;
                                                                    } else {
                                                                        $nilai_pjk = 0;
                                                                    }

                                                                    $ongkir = $s1['ongkir'] ?? 0;
                                                                    $subtotal = $grand_total + $nilai_pjk;
                                                                    $stotal += $subtotal;
                                                                    // Tampilkan subtotal
                                                                    // echo $subtotal;
                                                                    $row_style = ($s1['status_barang'] == 1) ? 'background-color: #ADD8E6;' : ''; // Warna biru muda
                                                                    $is_disabled = ($s1['status_barang'] == 1) ? 'disabled' : ''; // Disable input dan tombol jika status_barang = 2


                                                                ?>
                                                                    <tr style="<?php echo $row_style; ?>">
                                                                        <td align="right">
                                                                            <?php echo $no; ?>
                                                                            <input type="hidden" name="id[<?php echo $no; ?>]" value="<?php echo $s1[$ff1]; ?>">
                                                                        </td>
                                                                        <td align="right">
                                                                            <input type="text" name="kd_brg[<?php echo $no; ?>]" value="<?php echo $s1[$ff2]; ?>" class="form-control"
                                                                                style="border: none; background-color: transparent; padding: 0; text-align: left;" readonly>
                                                                        </td>
                                                                        <td align="left"><?php echo $s1['nama']; ?></td>
                                                                        <td align="right    "><?php echo $s1['jumlah_datang']; ?></td>
                                                                        <td align="right">
                                                                            <input type="text" name="jumlah[<?php echo $no; ?>]" value="<?php echo $s1['jml']; ?>" class="form-control"
                                                                                style="border: none; background-color: transparent; padding: 0; text-align: right;" readonly>
                                                                        </td>
                                                                        <td align="center"><?php echo $s1['satuan'] ?></td>
                                                                        <td align="right">
                                                                            <input type="text" name="harga[<?php echo $no; ?>]" value="<?php echo number_format($s1[$ff4]); ?>" class="form-control"
                                                                                style="border: none; background-color: transparent; padding: 0; text-align: right;" readonly>
                                                                        </td>
                                                                        <td align="right">
                                                                            <input type="text" name="subTotal[<?php echo $no; ?>]" value="<?php echo number_format($total_harga); ?>" class="form-control"
                                                                                style="border: none; background-color: transparent; padding: 0; text-align: right;" readonly>
                                                                        </td>
                                                                        <td align="right">
                                                                            <input type="text" name="diskon[<?php echo $no; ?>]" value="<?php echo number_format($s1[$ff7]); ?>" class="form-control"
                                                                                style="border: none; background-color: transparent; padding: 0; text-align: right;" readonly>
                                                                        </td>
                                                                        <td align="right">
                                                                            <input type="text" name="" value="<?php echo number_format($nilai_pjk); ?>" class="form-control"
                                                                                style="border: none; background-color: transparent; padding: 0; text-align: right;" readonly>
                                                                        </td>
                                                                        <td align="right">
                                                                            <input type="text" name="subtotal[<?php echo $no; ?>]" value="<?php echo number_format($subtotal); ?>" class="form-control"
                                                                                style="border: none; background-color: transparent; padding: 0; text-align: right;" readonly>
                                                                        </td>
                                                                        <!-- <td align="center">
                                                                            <a href="main.php?route=<?php echo $rute_detail; ?>&act=edit-detail&id=<?php echo $s1[$ff1]; ?>&id2=<?php echo $s1[$ff2]; ?>&id3=<?php echo $s1[$ff8]; ?>" title="edit">
                                                                                <button class="btn btn-xs btn-primary elevation-1" style="opacity: .7"><i class="fa fa-edit"></i></button>
                                                                            </a>
                                                                            <a href="route/<?php echo $data; ?>/<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=hapus-detail&id=<?php echo $s1[$ff1]; ?>&id2=<?php echo $s1[$ff2]; ?>" title="Hapus Data Ini" onclick="return confirm('Anda yakin akan menghapus data ini?')">
                                                                                <button class="btn btn-xs btn-danger elevation-1" style="opacity: .7"><i class="fa fa-trash"></i></button>
                                                                            </a>
                                                                        </td> -->
                                                                    </tr>
                                                                <?php
                                                                    $no++;
                                                                }
                                                                ?>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr style="font-weight:600">
                                                                    <td colspan="10" align="right">Total</td>
                                                                    <td align="right" id="stotal"><?php echo number_format($stotal); ?> </td>
                                                                    <td align="right" style="display: none;" id="ongkir2"><?php echo number_format($ongkir); ?> </td>

                                                                    <td></td>
                                                                </tr>
                                                            </tfoot>
                                                        </table>

                                                    </form>


                                                    <!-- end tambah keterngan utk Proses .....-->

                                                    <!-- <a href="main.php?route=<?php echo $rute; ?>&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=<?php echo $rute; ?>"><button class="btn btn-primary btn-sm elevation-1" style="opacity: .7">Back</button></a> -->

                                                    <a onclick="history.go(-1)"><button class="btn btn-primary btn-sm elevation-1" style="opacity: .7">Back</button></a>


                                                </div>
                                                <hr>
                                                <!-- <script>
                                                    // Mengecek jika ada status   <script>
                                                    document.addEventListener('DOMContentLoaded', function() {
                                                        // Hapus status setelah halaman dimuat
                                                        localStorage.removeItem('invoiceReady');

                                                        // Simulasikan tombol submit saat halaman dimuat
                                                        document.getElementById('submitButton').click();
                                                    });
                                                </script> -->


                                            </div><!-- /.box-body -->
                                        </div>
                                        <!-- /.box -->

                                    </div><!--/.col (right) -->
                                </div> <!-- /.row -->
                            </div>

                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->'<script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Ambil nilai dari elemen dengan id 'stotal' dan 'ongkir2'
                    let subtotalText = document.getElementById('stotal').textContent.trim();
                    let ongkirText = document.getElementById('ongkir2').textContent.trim();

                    // Hilangkan koma (,) dari format number_format PHP dan konversi ke angka
                    let subtotalValue = parseFloat(subtotalText.replace(/,/g, ''));
                    let ongkirValue = parseFloat(ongkirText.replace(/,/g, ''));

                    // Tambahkan subtotal dan ongkir
                    let totalValue = subtotalValue + ongkirValue;

                    // Debug untuk memastikan nilai yang diambil benar
                    console.log('Total Subtotal:', subtotalValue);
                    console.log('Total Ongkir:', ongkirValue);
                    console.log('Total Keseluruhan:', totalValue);

                    // Fungsi untuk format angka ke format Rupiah
                    function formatRupiah(angka) {
                        // Pastikan angka diubah ke format dengan 2 desimal terlebih dahulu
                        let formatted = angka.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                        return formatted;
                    }

                    // Set nilai total ke input dengan format Rupiah
                    document.getElementById('ttg').value = formatRupiah(subtotalValue);
                    document.getElementById('ongkir').value = formatRupiah(ongkirValue);
                    document.getElementById('totalTagihan').value = formatRupiah(totalValue);
                });
            </script>
        <?php
            break;

        //Form Edit detail 
        case "edit-detail":

            // echo '<br>'.$_GET['id'];
            // echo '<br>'.$_GET['idp'];
            // echo '<br>'.$_GET['idb'];

            $edit = mysqli_query($koneksi, "SELECT * from $tabel where $f1='$_GET[id]'");
            $e = mysqli_fetch_array($edit);

            $sql = mysqli_query($koneksi, "SELECT * from $tabel2 
						where $ff1='$_GET[id]' AND $ff2='$_GET[id2]'  ");
            $s1 = mysqli_fetch_array($sql);

        ?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper" style="background-color: ghostwhite;">
                <!-- Content Header (Page header) -->
                <section class="content-header ">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <div style="margin:10px;"></div>
                                <h1 class="list-gds animated tdFadeInDown">
                                    <b><?php echo $judulform; ?></b> <small> Detail edit</small>
                                </h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="main.php?route=home">Beranda</a></li>

                                    <li class="breadcrumb-item active"><a href="main.php?route=<?php echo $rute; ?>&act"><?php echo $judulform; ?></a></li>
                                    <li class="breadcrumb-item active">edit detail</li>
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
                            <div class="card-body animated tdFadeIn">
                                <div class="row">
                                    <!-- right column -->
                                    <div class="col-md-12">
                                        <!-- general form elements disabled -->
                                        <div class="box box-warning">
                                            <div class="box-body">

                                                <form method="POST" action="route/<?php echo $data; ?>/<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=edit-detail&id=<?php echo $s1[$ff1]; ?>&id2=<?php echo $s1[$ff2]; ?>&id3=<?php echo $s1[$ff8]; ?>" enctype="multipart/form-data">

                                                    <section class="base">
                                                        <div class="row">

                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <label><?php echo $jj2; ?></label>
                                                                    <input type="text" name="<?php echo $ff2; ?>" class="form-control" value="<?php echo $s1[$ff2]; ?>" readonly />
                                                                </div>

                                                            </div>


                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <label><?php echo $jj3; ?></label>
                                                                    <input type="text" name="<?php echo $ff3; ?>" class="form-control" value="<?php echo $s1[$ff3]; ?>" readonly />
                                                                </div>

                                                            </div>

                                                            <div class="col-lg-4">
                                                                <div class="form-group">
                                                                    <label><?php echo $jj3; ?></label>
                                                                    <input type="text" name="<?php echo $ff3; ?>" class="form-control" value="<?php echo $s1[$ff3]; ?>" autofocus="" />
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <label><?php echo $jj4; ?></label>
                                                                    <input type="text" name="<?php echo $ff4; ?>" class="form-control" value="<?php echo $s1[$ff4]; ?>" autofocus="" />
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <label><?php echo $jj7; ?></label>
                                                                    <input type="text" name="<?php echo $ff7; ?>" class="form-control" value="<?php echo $s1[$ff7]; ?>" autofocus="" />
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <hr />

                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-primary elevation-2" style="opacity: .7">Simpan Perubahan</button>
                                                        </div>

                                                    </section>
                                                </form>
                                                <a href="main.php?route=<?php echo $rute_detail; ?>&act&id=<?php echo $s1[$f1]; ?>&asal=<?php echo $rute; ?>"><button class="btn btn-primary btn-sm elevation-1" style="opacity: .7">Back</button></a>

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