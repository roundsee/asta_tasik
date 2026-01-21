<?php

$judulform = 'Payment Belum Lunas';
$login_hash = $_SESSION['login_hash'];

$view = "payment_view_detail";

$data = 'lap_payment_invoice';
$rute = 'payment_invoice';
$aksi = 'aksi_invoicing';

$tabel = 'payment_detail';
$f1 = 'no_payment';
$f2 = 'tanggal_payment';
$f3 = 'kd_brg';
$f4 = 'jumlah';
$f5 = 'jumlah_datang';
$f6 = 'harga';


$j1 = 'no_payment';
$j2 = 'tanggal_payment';
$j3 = 'kd_brg';
$j4 = 'jumlah';
$j5 = 'jumlah_datang';
$j6 = 'total harga';



if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
    echo "<link href='style.css' rel='stylesheet' type='text/css'>
    <center>Untuk mengakses modul, Anda harus login <br>";
    echo "<a href=../../index.php><b>LOGIN</b></a></center>";
} else {

    switch ($_GET['act']) {
            //Tampil Data 
        default:
?>
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

                                                    <!-- <button class="btn btn-primary btn-sm elevation-2 " style="opacity: .7;" onclick="window.location='route/<?php echo $data; ?>/autocomplete.php'"><i class="fa fa-plus" ;></i> Tambah</button> -->
                                                    <div style="margin:10px"></div>
                                                    <table id="example1" class="table table-bordered table-striped">
                                                        <thead style="background-color: lightgray;" class="elevation-2">
                                                            <tr>
                                                                <th>No.</th>
                                                                <th><?php echo $j1; ?></th>
                                                                <th><?php echo $j2; ?></th>
                                                                <th><?php echo $j5; ?></th>
                                                                <th>Total Tagihan</th>
                                                                <th>Jumlah Sudah Dibayar</th>
                                                                <th>Sisa</th>
                                                                <th>Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $no = 1;


                                                            $sql1 = mysqli_query($koneksi, "SELECT 
                                                                pyd.$f1, 
                                                                pyd.$f2, 
                                                              SUM(DISTINCT pyd.$f5) as total_jumlah_datang,
                                                                SUM(DISTINCT pyd.$f5 * pyd.$f6 - pd.disc)  AS total_harga,
                                                                p.jumlah_payment as jumlah_payment,
                                                                p.no_invoice as no_invoice,
                                                                pembelian.ppn as ppn

                                                            FROM $tabel pyd
                                                            LEFT JOIN payment p ON p.no_payment = pyd.no_payment
                                                            LEFT JOIN alat_bayar ab ON ab.kd_alat = p.metode_payment
                                                            LEFT JOIN pembelian_detail pd ON pd.kd_po = p.no_invoice
                                                            LEFT JOIN pembelian  ON pembelian.kd_po = pd.kd_po 
                                                            LEFT JOIN barang b ON b.kd_brg = pd.kd_brg
                                                            WHERE status  < 2
                                                            GROUP BY pyd.no_payment, pyd.$f2");

                                                            if (!$sql1) {
                                                                die('error' . mysqli_error($koneksi));
                                                            }

                                                            while ($s1 = mysqli_fetch_array($sql1)) {

                                                                $total_harga = $s1['total_harga'];
                                                                // $grand_total = $s2['tot_price'] - $s2['tot_disc'];

                                                                if ($s1['ppn'] == 1) {
                                                                    $nilai_pjk = $total_harga * 11 / 100;
                                                                } else {
                                                                    $nilai_pjk = 0;
                                                                }
                                                                $total_tagihan = $total_harga + $nilai_pjk;
                                                                // $subtotal = $grand_total + $nilai_pjk;

                                                                $sisa_bayar = $total_tagihan - $s1['jumlah_payment'];
                                                            ?>
                                                                <tr>
                                                                    <td><?php echo $no; ?></td>
                                                                    <td><a href="main.php?route=<?php echo $view; ?>&act&id=<?php echo $s1[$f1]; ?>&asal=<?php echo $rute; ?>" title="Detail"><?php echo $s1[$f1]; ?></a></td>

                                                                    <!-- <td><?php echo $s1[$f1];
                                                                                ?></td> -->
                                                                    <td><?php echo $s1[$f2];
                                                                        ?></td>
                                                                    <td><?php echo $s1['total_jumlah_datang'];
                                                                        ?></td>
                                                                    <td><?php echo "Rp " . number_format($total_tagihan, 0, ',', '.'); // Total tagihan 
                                                                        ?></td>
                                                                    <td><?php echo "Rp " . number_format($s1['jumlah_payment'], 0, ',', '.'); ?></td>
                                                                    <td><?php echo "Rp " . number_format($sisa_bayar, 0, ',', '.'); ?></td>
                                                                    <td>
                                                                        <button class="btn btn-success btn-sm elevation-2 btn-terima-barang"
                                                                            data-kd_beli="<?php echo $s1['no_invoice']; ?>"
                                                                            data-kd_po="<?php echo $s1['no_payment']; ?>"
                                                                            data-harga="<?php echo $s1['total_tagihan']; ?>"
                                                                            type="button">
                                                                            <i class="fa fa-check"></i> Bayar
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                            <?php
                                                                $no++;
                                                            }
                                                            ?>
                                                        </tbody>

                                                    </table>


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
            <div class="modal fade" id="modalPembayaran" tabindex="-1" role="dialog" aria-labelledby="modalPembayaranLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                    <div class="modal-content" style="border-radius: 10px; box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);">
                        <form id="formPembayaran" action="route/<?php echo $data ?>/generate_pembayaran.php" method="POST">
                            <div class="modal-header" style="background-color: #007bff; color: white; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                                <h5 class="modal-title" id="modalPembayaranLabel" style="font-family: 'Montserrat', sans-serif; font-size: 1.25rem; font-weight: 600;">INFORMASI PEMBAYARAN : <span id="title"></span></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" style="padding: 2rem;">
                                <input type="hidden" name="kd_beli" id="modalKdBeli">

                                <!-- Grid Layout -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kd_po" style="font-weight: bold;">Kode Po</label>
                                            <input type="hidden" class="form-control" id="nomor_payment" name="no_payment" readonly style="border-radius: 5px; border: 1px solid #007bff;">
                                            <input type="text" class="form-control" id="no_payment" name="kd_po" readonly style="border-radius: 5px; border: 1px solid #007bff;">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tanggal_payment" style="font-weight: bold;">Tanggal Pembayaran</label>
                                            <input type="date" class="form-control" id="tanggal_payment" name="tanggal_payment" required style="border-radius: 5px; border: 1px solid #007bff;">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="metode_payment" style="font-weight: bold;">Jenis Transaksi</label>
                                            <select class="form-control" id="metode_payment" name="metode_payment" required style="border-radius: 5px; border: 1px solid #007bff;">
                                                <option value="">Pilih Jenis Transaksi</option>
                                                <?php
                                                // Ambil data dari tabel jenis_transaksi
                                                $query = mysqli_query($koneksi, "SELECT * FROM jenis_transaksi");
                                                while ($x = mysqli_fetch_array($query)) {
                                                    echo "<option value='$x[kd_jenis]'>$x[kd_jenis] - $x[nama]</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="akun" style="font-weight: bold;">Akun</label>
                                            <select class="form-control" id="akun" name="akun" required style="border-radius: 5px; border: 1px solid #007bff;">
                                                <option value="">Pilih Akun</option>
                                                <!-- Options akan diisi melalui AJAX -->
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="reff" style="font-weight: bold;">Referensi <sup style="color: red;">* Selain pembayaran Tunai (Wajib Diisi !)</sup></label>
                                            <input type="text" class="form-control" id="reff" name="reff" style="border-radius: 5px; border: 1px solid #007bff;">
                                        </div>
                                    </div>
                                </div>

                                <!-- Tabel untuk kd_po, kd_brg, dan input kosong -->
                                <div class="table-responsive">
                                    <table id="modalTable" class="table table-bordered table-striped">
                                        <thead style="background-color: lightgray;">
                                            <tr>
                                                <th>Kode Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Qty Berdasarkan PO</th>
                                                <th>Qty Terima</th>
                                                <th>Harga</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Baris data akan ditambahkan di sini -->
                                        </tbody>
                                    </table>
                                </div>

                                <div class="row">
                                    <!-- Informasi Tagihan -->
                                    <div class="col-md-4">
                                        <div class="form-group mt-4">
                                            <label for="total_tagihan" style="font-weight: bold;">Total Tagihan</label>
                                            <input type="text" class="form-control" id="total_tagihan" name="total_tagihan" readonly style="border-radius: 5px; border: 1px solid #007bff;">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group mt-4">
                                            <label for="sudah_dibayar" style="font-weight: bold;">Sudah dibayar</label>
                                            <input type="text" class="form-control" id="sudah_dibayar" name="sudah_dibayar" readonly style="border-radius: 5px; border: 1px solid #007bff;">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group mt-4">
                                            <label for="sisa_tagihan" style="font-weight: bold;">Sisa Tagihan</label>
                                            <input type="text" class="form-control" id="sisa_tagihan" name="sisa_tagihan" readonly style="border-radius: 5px; border: 1px solid #007bff;">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mt-4">
                                            <label for="tagihan_yang_harus_dibayar" style="font-weight: bold;">Tagihan yang harus dibayar</label>
                                            <input type="text" class="form-control" id="tagihan_yang_harus_dibayar" name="tagihan_yang_harus_dibayar" readonly style="border-radius: 5px; border: 1px solid #007bff;">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mt-4">
                                            <label for="jumlah_payment" style="font-weight: bold;">Jumlah Pembayaran</label>
                                            <input type="number" class="form-control" id="jumlah_payment" name="jumlah_payment" required style="border-radius: 5px; border: 1px solid #007bff;">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mt-3">
                                    <label for="nilai_sisa" style="font-weight: bold;">Nilai Sisa</label>
                                    <input type="text" class="form-control" id="nilai_sisa" name="nilai_sisa" readonly style="border-radius: 5px; border: 1px solid #007bff;">
                                </div>

                                <div class="form-group mt-3">
                                    <label for="status_pembayaran" style="font-weight: bold;">Status Pembayaran</label>
                                    <input type="text" class="form-control" id="status_pembayaran" name="status_pembayaran" readonly style="border-radius: 5px; border: 1px solid #007bff;">
                                </div>

                            </div>
                            <div class="modal-footer" style="border-top: none;">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 5px; padding: 0.5rem 1.5rem;">Tutup</button>
                                <button type="submit" class="btn btn-success" style="border-radius: 5px; padding: 0.5rem 1.5rem;">Proses Pembayaran</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- <script>
                $(document).on('click', '.btn-terima-barang', function() {
                    var kd_beli = $(this).data('kd_beli');
                    var kd_po = $(this).data('kd_po');

                    $('#no_payment').val(kd_beli);
                    $('#nomor_payment').val(kd_po);
                    $('#modalKdBeli').val(kd_beli); // Set nilai kd_beli di modal
                    $('#title').text(kd_po); // Set judul di modal

                    // Kosongkan tabel sebelum menambahkan data baru
                    $('#modalTable tbody').empty();

                    $.ajax({
                        url: 'route/<?php echo $data ?>/get_barang_by_kd_beli.php', // Ganti dengan path yang sesuai
                        type: 'POST',
                        data: {
                            kd_beli: kd_beli
                        },
                        dataType: 'json',
                        success: function(response) {
                            let totalTagihan = 0;
                            let sudahDibayar = 0;
                            $.each(response, function(index, item) {
                                var qtyTerima = item.jumlah_datang;
                                var harga = item.harga;
                                sudahDibayar = item.jumlah_payment || 0; // Ambil nilai sudah dibayar

                                $('#modalTable tbody').append(
                                    '<tr>' +
                                    '<td><input type="text" class="form-control" value="' + item.kd_brg + '" readonly></td>' +
                                    '<td><input type="text" class="form-control" value="' + item.nama_barang + '" readonly></td>' +
                                    '<td><input type="text" class="form-control" value="' + item.jumlah + '" readonly></td>' +
                                    '<td><input type="number" class="form-control" name="qty_terima[]" value="' + qtyTerima + '" readonly></td>' +
                                    '<td><input type="text" class="form-control" value="' + harga + '" readonly></td>' +
                                    '</tr>'
                                );

                                totalTagihan += qtyTerima * harga;
                            });

                            $('#total_tagihan').val(totalTagihan.toFixed(2)); // Total tagihan
                            $('#sudah_dibayar').val(sudahDibayar); // Sudah dibayar
                            var sisaTagihan = totalTagihan - sudahDibayar; // Hitung sisa tagihan
                            $('#sisa_tagihan').val(sisaTagihan.toFixed(2));
                            $('#tagihan_yang_harus_dibayar').val(sisaTagihan.toFixed(2)); // Tagihan yang harus dibayar
                            $('#jumlah_payment').val(''); // Bersihkan input pembayaran
                            $('#nilai_sisa').val(sisaTagihan.toFixed(2)); // Nilai sisa
                            $('#status_pembayaran').val(sisaTagihan <= 0 ? 'Lunas' : 'Belum Lunas'); // Set status pembayaran
                        }
                    });

                    $('#modalPembayaran').modal('show');
                });

                // Function to calculate remaining value and update payment status
                function calculateRemaining() {
                    var totalTagihan = parseFloat($('#total_tagihan').val()) || 0;
                    var sudahDibayar = parseFloat($('#sudah_dibayar').val()) || 0;
                    var sisaTagihan = totalTagihan - sudahDibayar;
                    var jumlahPembayaran = parseFloat($('#jumlah_payment').val()) || 0;

                    // Validasi jika jumlah pembayaran melebihi sisa tagihan
                    if (jumlahPembayaran > sisaTagihan) {
                        $('#jumlah_payment').css('border', '2px solid red'); // Beri tanda merah
                        alert('Jumlah terlalu banyak'); // Berikan alert atau gantikan dengan teks berwarna merah
                    } else {
                        $('#jumlah_payment').css('border', '1px solid #007bff'); // Reset border
                    }

                    var nilaiSisa = sisaTagihan - jumlahPembayaran;
                    $('#nilai_sisa').val(nilaiSisa.toFixed(2));
                    $('#status_pembayaran').val(nilaiSisa <= 0 ? 'Lunas' : 'Belum Lunas');
                }

                // Call calculateRemaining function on input change
                $('#jumlah_payment').on('input', calculateRemaining);
            </script> -->

            <script>
                $(document).on('click', '.btn-terima-barang', function() {
                    var kd_beli = $(this).data('kd_beli');
                    var kd_po = $(this).data('kd_po');
                    console.log(kd_po);

                    $('#no_payment').val(kd_beli);
                    $('#nomor_payment').val(kd_po);
                    $('#modalKdBeli').val(kd_beli); // Set nilai kd_beli di modal
                    $('#title').text(kd_po); // Set judul di modal

                    // Kosongkan tabel sebelum menambahkan data baru
                    $('#modalTable tbody').empty();

                    $.ajax({
                        url: 'route/<?php echo $data ?>/get_barang_by_kd_beli.php', // Ganti dengan path yang sesuai
                        type: 'POST',
                        data: {
                            kd_po: kd_po
                        },
                        dataType: 'json',
                        success: function(response) {
                            console.log(response);
                            let perhitunganTagihan = 0;
                            let totalTagihan = 0;
                            let sudahDibayar = 0;
                            // $.each(response, function(index, item) {
                            //     var qtyTerima = item.jumlah_datang;
                            //     var harga = item.harga;
                            //     var disc = item.disc;
                            //     var ppn = item.ppn;
                            //     sudahDibayar = item.jumlah_payment || 0; // Ambil nilai sudah dibayar

                            //     $('#modalTable tbody').append(
                            //         '<tr>' +
                            //         '<td><input type="text" class="form-control" value="' + item.kd_brg + '" readonly></td>' +
                            //         '<td><input type="text" class="form-control" value="' + item.nama_barang + '" readonly></td>' +
                            //         '<td><input type="text" class="form-control" value="' + item.jumlah + '" readonly></td>' +
                            //         '<td><input type="number" class="form-control" name="qty_terima[]" value="' + qtyTerima + '" readonly></td>' +
                            //         '<td><input type="text" class="form-control" value="' + harga + '" readonly></td>' +
                            //         '</tr>'
                            //     );


                            //     perhitunganTagihan += (qtyTerima * harga) - disc;
                            //     console.log("ini perhitungan tagihan tanpa ppn : " + perhitunganTagihan  )

                            //     if(ppn == 0 ){
                            //         perhitunganPpn = perhitunganTagihan * 11 / 100;
                            //     }else{
                            //         perhitunganPpn = 0;
                            //     }
                            //     totalTagihan = perhitunganTagihan + perhitunganPpn;
                            //     console.log("ini perhitungan total tagihan : " + totalTagihan  )
                            // });


                            $.each(response, function(index, item) {
                                var qtyTerima = item.jumlah_datang;
                                var harga = item.harga;
                                var disc = item.disc;
                                var ppn = item.ppn;
                                sudahDibayar = item.jumlah_payment || 0; // Ambil nilai sudah dibayar

                                $('#modalTable tbody').append(
                                    '<tr>' +
                                    '<td><input type="text" class="form-control" value="' + item.kd_brg + '" readonly></td>' +
                                    '<td><input type="text" class="form-control" value="' + item.nama_barang + '" readonly></td>' +
                                    '<td><input type="text" class="form-control" value="' + item.jumlah + '" readonly></td>' +
                                    '<td><input type="number" class="form-control" name="qty_terima[]" value="' + qtyTerima + '" readonly></td>' +
                                    '<td><input type="text" class="form-control" value="' + harga + '" readonly></td>' +
                                    '</tr>'
                                );

                                var itemTagihan = (qtyTerima * harga) - disc; // Hitung tagihan per item
                                console.log("tagihan per item " + itemTagihan);
                                perhitunganTagihan += itemTagihan; // Tambah ke total tagihan

                                // Hitung PPN untuk setiap item
                                var perhitunganPpn = (ppn === 0) ? (itemTagihan * 0.11) : 0;
                                totalTagihan += itemTagihan + perhitunganPpn; // Total tagihan
                            });

                            $('#total_tagihan').val(totalTagihan.toFixed(2)); // Total tagihan
                            $('#sudah_dibayar').val(sudahDibayar); // Sudah dibayar
                            var sisaTagihan = totalTagihan - sudahDibayar; // Hitung sisa tagihan
                            $('#sisa_tagihan').val(sisaTagihan.toFixed(2));
                            $('#tagihan_yang_harus_dibayar').val(sisaTagihan.toFixed(2)); // Tagihan yang harus dibayar
                            $('#jumlah_payment').val(''); // Bersihkan input pembayaran
                            $('#nilai_sisa').val(sisaTagihan.toFixed(2)); // Nilai sisa
                            $('#status_pembayaran').val(sisaTagihan <= 0 ? 'Lunas' : 'Belum Lunas'); // Set status pembayaran
                        }
                    });

                    $('#modalPembayaran').modal('show');
                });

                // Function to calculate remaining value and update payment status
                function calculateRemaining() {
                    var totalTagihan = parseFloat($('#total_tagihan').val()) || 0;
                    var sudahDibayar = parseFloat($('#sudah_dibayar').val()) || 0;
                    var sisaTagihan = totalTagihan - sudahDibayar;
                    var jumlahPembayaran = parseFloat($('#jumlah_payment').val()) || 0;

                    // Validasi jika jumlah pembayaran melebihi sisa tagihan
                    if (jumlahPembayaran > sisaTagihan) {
                        $('#jumlah_payment').css('border', '2px solid red'); // Beri tanda merah
                        alert('Jumlah terlalu banyak'); // Berikan alert atau gantikan dengan teks berwarna merah
                    } else {
                        $('#jumlah_payment').css('border', '1px solid #007bff'); // Reset border
                    }

                    var nilaiSisa = sisaTagihan - jumlahPembayaran;
                    $('#nilai_sisa').val(nilaiSisa.toFixed(2));
                    $('#status_pembayaran').val(nilaiSisa <= 0 ? 'Lunas' : 'Belum Lunas');
                }

                // Call calculateRemaining function on input change
                $('#jumlah_payment').on('input', calculateRemaining);

                // Event listener untuk dropdown 'metode_payment'
                $('#metode_payment').on('change', function() {
                    var kd_jenis = $(this).val(); // Ambil nilai kd_jenis dari dropdown

                    if (kd_jenis !== '') {
                        $.ajax({
                            url: 'route/<?php echo $data ?>/get_account_by_transaction.php', // Path ke file PHP yang menangani request akun
                            type: 'POST',
                            data: {
                                kd_jenis: kd_jenis
                            },
                            success: function(response) {
                                console.log(response);
                                // Update isi dropdown 'akun' dengan data yang dikembalikan dari server
                                $('#akun').html(response);
                            }
                        });
                    }
                });
            </script>



            <style>
                .invoice {
                    width: 100%;
                    margin: 0 auto;
                    padding: 20px;
                    font-family: Arial, sans-serif;
                    border: 1px solid #ddd;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
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


                .invoice h2 {
                    text-align: center;
                    margin-bottom: 20px;
                    font-size: 24px;
                }

                .invoice .information {
                    margin-bottom: 20px;
                }

                .invoice .information div {
                    margin-bottom: 5px;
                }

                .invoice table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-top: 20px;
                }

                .invoice table,
                .invoice th,
                .invoice td {
                    border: 1px solid #ddd;
                }

                .invoice th,
                .invoice td {
                    padding: 12px;
                    text-align: left;
                }

                .invoice .total {
                    text-align: right;
                    font-weight: bold;
                }

                .invoice .heading {
                    background-color: #f2f2f2;
                }

                .modal-dialog-scrollable {
                    max-height: 90vh;
                    overflow-y: auto;
                }

                .modal-header {
                    background-color: #f8f9fa;
                    border-bottom: 1px solid #dee2e6;
                }

                .modal-content {
                    position: relative;
                    background-clip: padding-box;
                    border: 1px solid rgba(0, 0, 0, .2);
                    border-radius: .3rem;
                    box-shadow: 0 3px 9px rgba(0, 0, 0, .5);
                }

                .modal-body {
                    padding: 1.5rem;
                }

                .modal-title {
                    font-size: 1.25rem;
                }

                .modal-xl {
                    max-width: 95%;
                }
            </style>
            <script>
                $(document).ready(function() {
                    $('#checkAll').click(function() {
                        $('input:checkbox').not(this).prop('checked', this.checked);
                    });
                });
            </script>

<?php
            break;
    }
}
