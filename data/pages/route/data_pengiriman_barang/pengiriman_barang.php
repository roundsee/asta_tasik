<?php

$judulform = "Pengiriman Barang";

$data = 'data_pengiriman_barang';
$rute = 'pengiriman_barang';
$aksi = 'aksi_pengiriman_barang';
$view = 'pengiriman_barang_view';
$view2 = 'permintaan_barang_view_detail';

$rute_detail = 'pengiriman_barang_detail';

$tabel = 'permintaan_barang';

// Variabel untuk nama kolom tabel permintaan_barang
$f1 = 'kode_permintaan';
$f2 = 'kd_cus_peminta';
$f3 = 'kd_cus_pengirim';
$f4 = 'tanggal_permintaan';
$f5 = 'status_permintaan';
$f6 = 'keterangan';

// Variabel untuk label kolom
$j1 = 'Kode Permintaan';
$j2 = 'Penerima';
$j3 = 'Pengirim';
$j4 = 'Tanggal Permintaan';
$j5 = 'Status Permintaan';
$j6 = 'Keterangan';

$tabel2 = "permintaan_barang_detail";

// Variabel untuk nama kolom tabel permintaan_barang_detail
$ff1 = 'id_detail';
$ff2 = 'kode_permintaan';
$ff3 = 'kd_cus_peminta';
$ff4 = 'kd_barang';
$ff5 = 'nama_barang';
$ff6 = 'qty_diajukan';
$ff7 = 'qty_terkirim';
$ff8 = 'qty_diterima';
$ff9 = 'qty_satuan';
$ff10 = 'satuan';
$ff11 = 'harga';
$ff12 = 'urut';
$ff13 = 'status_item';

// Variabel untuk label kolom
$jj1 = 'ID Detail';
$jj2 = 'Kode Permintaan';
$jj3 = 'Kode Customer Peminta';
$jj4 = 'Kode Barang';
$jj5 = 'Nama Barang';
$jj6 = 'Quantity Permintaan';
$jj7 = 'Quantity Terkirim';
$jj8 = 'Quantity Diterima';
$jj9 = 'Quantity Satuan';
$jj10 = 'Satuan';
$jj11 = 'Harga';
$jj12 = 'Urut';
$jj13 = 'Status Item';


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


$query_kdcus = mysqli_query($koneksi, "SELECT kd_cus FROM user_login where employee_number = '$en'");
$q1 = mysqli_fetch_assoc($query_kdcus);
$kd_cus = $q1['kd_cus'];

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
                                                    <div style="margin:10px"></div>
                                                    <table id="example1" class="table table-bordered table-striped">
                                                        <thead style="background-color: lightgray;" class="elevation-2">
                                                            <tr>
                                                                <th>No.</th>
                                                                <th><?php echo $j1; ?></th>
                                                                <th><?php echo $j2; ?></th>
                                                                <th><?php echo $j3; ?></th>
                                                                <th><?php echo $j4; ?></th>
                                                                <th width="340px">Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $sql1 = mysqli_query($koneksi, "
                                                                SELECT $tabel.*, pd.$ff5 AS nama_barang, pd.$ff4 AS kd_barang, SUM(pd.$ff6) AS qty_diajukan,
                                                                 peminta.nama AS nama_pelanggan_peminta, 
                                                                pengirim.nama AS nama_pelanggan_pengirim 
                                                                FROM $tabel
                                                                JOIN $tabel2 pd ON pd.$ff2 = $tabel.$f1
                                                                 JOIN pelanggan AS peminta ON peminta.kd_cus = $tabel.kd_cus_peminta
                                                                JOIN pelanggan AS pengirim ON pengirim.kd_cus = $tabel.kd_cus_pengirim
                                                                WHERE $tabel.kd_cus_pengirim = '$kd_cus' and status_permintaan <= 1
                                                                GROUP BY $f1
                                                            ");

                                                            $no = 1;

                                                            if (!$sql1) {
                                                                die('Query error: ' . mysqli_error($koneksi));
                                                            }

                                                            while ($s1 = mysqli_fetch_array($sql1)) {
                                                                $sql2 = mysqli_query($koneksi, "
                                                                SELECT SUM($ff6) AS total_qty, SUM($ff11 * $ff6) AS total_price 
                                                                FROM $tabel2 
                                                                WHERE $ff2 = '{$s1[$f1]}'
                                                            ");
                                                                $s2 = mysqli_fetch_array($sql2);

                                                                $total_qty = $s2['total_qty'] ?? 0;
                                                                $total_price = $s2['total_price'] ?? 0;

                                                            ?>
                                                                <tr align="left">
                                                                    <td><?php echo $no; ?></td>
                                                                    <td>
                                                                        <a href="main.php?route=<?php echo $view; ?>&act&id=<?php echo $s1[$f1]; ?>&asal=<?php echo $rute; ?>" title="Detail">
                                                                            <?php echo $s1[$f1]; ?>
                                                                        </a>
                                                                    </td>
                                                                    <td><?php echo $s1[$f2]; ?></td>
                                                                    <td><?php echo $s1[$f3]; ?></td>
                                                                    <td><?php echo $s1[$f4]; ?></td>
                                                                    <td>
                                                                        <?php if ($s1[$f5] <= 1) { ?>
                                                                            <button class="btn btn-success btn-sm elevation-2 btn-terima-barang"
                                                                                data-kode_permintaan="<?php echo $s1[$f1]; ?>"
                                                                                data-kd_barang="<?php echo $s1['kd_barang']; ?>"
                                                                                data-nama_barang="<?php echo $s1['nama_barang']; ?>"
                                                                                data-qty_diajukan="<?php echo $s1['qty_diajukan']; ?>"
                                                                                data-kd_cus_pengirim="<?php echo $s1['kd_cus_pengirim']; ?>"
                                                                                type="button" style="opacity: .7;">
                                                                                <i class="fa fa-check-circle"></i> Proses
                                                                            </button>
                                                                        <?php } elseif ($s1[$f5] == 2) { ?>
                                                                            <button class="btn btn-success btn-sm" disabled><i class="fa fa-thumbs-up"></i> Selesai</button>
                                                                        <?php } else { ?>
                                                                            <button class="btn btn-secondary btn-sm elevation-2" disabled type="button" style="opacity: .7;">
                                                                                <i class="fa fa-times-circle"></i> Belum Diproses
                                                                            </button>
                                                                        <?php } ?>
                                                                        <a href="main.php?route=<?php echo $view2; ?>&act&id=<?php echo $s1[$f1]; ?>&asal=<?php echo $rute; ?>"
                                                                            title="Detail"
                                                                            class="btn btn-info btn-sm">
                                                                            DETAIL PERMINTAAN
                                                                        </a>

                                                                        <a href="route/<?php echo $data; ?>/cetak_pengiriman_barang.php?kode_permintaan=<?php echo $s1['kode_permintaan']; ?>">
                                                                            <button class="btn btn-warning btn-sm elevation-2" type="button" style="opacity: .7;">
                                                                                <i class="fa fa-print"></i> Cetak Bukti
                                                                            </button>
                                                                        </a>



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

            <!-- Modal Surat Jalan -->
            <div class="modal fade" id="modalSuratJalan" tabindex="-1" role="dialog" aria-labelledby="modalSuratJalanLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content" style="border-radius: 10px; box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);">
                        <form id="formSuratJalan" action="route/<?php echo $data ?>/aksi_pengiriman_barang.php" method="POST">
                            <div class="modal-header" style="background-color: #007bff; color: white; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                                <h5 class="modal-title" id="modalSuratJalanLabel" style="font-family: 'Montserrat', sans-serif; font-size: 1.25rem; font-weight: 600;">KODE PERMINTAAN : <span id="title"></span> </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" style="padding: 1.5rem;">
                                <input type="hidden" name="kode_permintaan" id="kode_permintaan">
                                <input type="hidden" id="isSubmitting" name='isSubmitting' value="false">
                                <input type="hidden" name="kd_cus_pengirim" id="kd_cus_pengirim">

                                <!-- Input Tanggal -->
                                <div class="form-group">
                                    <label for="tanggal" style="font-weight: bold;">Tanggal Penerimaan</label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal" required value="<?php echo date('Y-m-d'); ?>" style="border-radius: 30px; border: 1px solid #007bff; padding: 0.75rem;" readonly>
                                </div>

                                <!-- Checkbox Surat Jalan Otomatis -->
                                <!-- <div class="form-group">
                                    <input type="checkbox" id="autoSuratJalan" name="autoSuratJalan">
                                    <label for="autoSuratJalan" style="font-weight: bold; margin-left: 5px;">Generate Surat Jalan Secara Otomatis</label>
                                </div> -->

                                <!-- Input Nomor Surat Jalan -->
                                <!-- <div class="form-group" id="suratJalanGroup">
                                    <label for="surat_jalan" style="font-weight: bold;">Nomor Surat Jalan</label>
                                    <input type="text" class="form-control" id="surat_jalan" name="surat_jalan" required style="border-radius: 30px; border: 1px solid #007bff; padding: 0.75rem;">
                                </div> -->

                                <!-- Tabel Kode Barang -->
                                <div class="table-responsive">
                                    <table id="modalTable" class="table table-bordered table-striped">
                                        <thead style="background-color: lightgray;">
                                            <tr>
                                                <th style="width: 300px;">Kode Barang</th>
                                                <th style="width: 450px;">Nama Barang</th>
                                                <th style="width: 200px;">Qty Diajukan</th>
                                                <th style="width: 200px;">Qty Terkirim</th>
                                                <th style="width: 200px;">Qty DiTerima</th>
                                                <th style="width: 200px;">Satuan</th>
                                                <th style="width: 200px;">Qty Kirim</th>
                                                <th style="width: 250px;">Status Barang</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Baris data akan ditambahkan di sini -->
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div class="modal-footer" style="border-top: none;">
                                <button type="button" id="qty_value" class="btn btn-primary" style="border-radius: 30px; padding: 0.5rem 1.5rem;">Proses Qty Kirim</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 30px; padding: 0.5rem 1.5rem;">Tutup</button>
                                <button type="submit" id="submitBtn" class="btn btn-success" style="border-radius: 30px; padding: 0.5rem 1.5rem;">Proses Pengiriman</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <script>
                $(document).ready(function() {
                    $('#formSuratJalan').on('submit', function(e) {
                        if ($('#isSubmitting').val() === 'true') {
                            // Block if already submitting
                            e.preventDefault();
                            return;
                        }

                        const currentStockInputs = document.getElementsByName('stok_barang1[]');
                        const buyingStockInputs = document.getElementsByName('qty_kirim[]');
                        const buyingStockSatuanInputs = document.getElementsByName('qty_satuan[]');
                        const namabarang = document.getElementsByName('nama_barang1[]');

                        const isValid = validateStock(currentStockInputs, buyingStockInputs, buyingStockSatuanInputs, namabarang);
                        if (!isValid) {
                            e.preventDefault(); // Cancel form submit if validation fails
                            return;
                        }

                        // Set flag and proceed
                        $('#isSubmitting').val('true');
                        $('#submitBtn').prop('disabled', true).text('Please wait...');
                        // Form will now submit normally
                    });
                });

                // Your stock validation function
                function validateStock(currentStockInputs, buyingStockInputs, buyingStockSatuanInputs, namabarang) {
                    for (let i = 0; i < currentStockInputs.length; i++) {
                        let currentStock = parseFloat(currentStockInputs[i].value);
                        let buyingStock = parseFloat(buyingStockInputs[i].value);
                        let satuan = parseFloat(buyingStockSatuanInputs[i].value);
                        let pembelian = buyingStock * satuan;
                        let nama = namabarang[i].value;
                        if (currentStock < 0) {
                            alert(`Stock error at ${nama}: Stok terkini (${currentStock}) is negative.`);
                            return false;
                        }
                        if (pembelian < 0) {
                            alert(`Stock error at ${nama}: Stok kirim yang di input (${pembelian}) is negative.`);
                            return false;
                        }
                        if (pembelian > currentStock) {
                            alert(`Stock error at ${nama}: Stok kirim yang di input (${pembelian}) > Stok terkini (${currentStock})`);
                            return false;
                        }
                    }
                    return true; // All stock validations passed
                }

                // Tampilkan atau sembunyikan input Surat Jalan berdasarkan checkbox
                $('#autoSuratJalan').on('change', function() {
                    if ($(this).is(':checked')) {
                        $('#suratJalanGroup').hide(); // Sembunyikan input surat jalan
                        $('#surat_jalan').prop('required', false); // Hilangkan required
                    } else {
                        $('#suratJalanGroup').show(); // Tampilkan input surat jalan
                        $('#surat_jalan').prop('required', true); // Tambahkan required
                    }
                });

                // Set kondisi awal ketika halaman dimuat
                $(document).ready(function() {
                    if ($('#autoSuratJalan').is(':checked')) {
                        $('#suratJalanGroup').hide();
                        $('#surat_jalan').prop('required', false);
                    }
                });
            </script>


            <script>
                $(document).on('click', '.btn-terima-barang', function() {
                    var kode_permintaan = $(this).data('kode_permintaan');
                    var kd_barang = $(this).data('kd_barang');
                    var nama_barang = $(this).data('nama_barang');
                    var qty_diajukan = $(this).data('qty_diajukan');
                    var kd_cus_pengirim = $(this).data('kd_cus_pengirim')

                    $('#kode_permintaan').val(kode_permintaan); // Set nilai ke input hidden modal
                    $('#kd_cus_pengirim').val(kd_cus_pengirim); // Set judul modal
                    $('#title').text(kode_permintaan); // Set judul modal

                    // Kosongkan tabel sebelum menambahkan data baru
                    $('#modalTable tbody').empty();

                    // Ajax untuk mengambil data barang berdasarkan kode permintaan
                    $.ajax({
                        url: 'route/<?php echo $data ?>/get_barang_by_kode_permintaan.php', // Ganti dengan path yang sesuai
                        type: 'POST',
                        data: {
                            kode_permintaan: kode_permintaan
                        },
                        dataType: 'json',
                        success: function(response) {
                            $.each(response, function(index, item) {
                                // Format qty PO menjadi angka bulat
                                var qty_diajukan = Math.round(item.qty_diajukan);
                                var qty_diterima = Math.round(item.qty_diterima);
                                var qty_terkirim = Math.round(item.qty_terkirim);
                                var qty_satuan = Math.round(item.qty_satuan);

                                $('#modalTable tbody').append(
                                    '<tr>' +
                                    '<td><input type="text" class="form-control" value="' + item.kd_barang + '" readonly></td>' +
                                    '<td><input type="text" class="form-control" value="' + item.nama_barang + '" readonly></td>' +
                                    '<td><input type="text" class="form-control qty-diajukan" value="' + formatRupiah(qty_diajukan) + '" readonly data-qty="' + qty_diajukan + '"></td>' +
                                    '<td><input type="text" class="form-control qty-terkirim" value="' + formatRupiah(qty_terkirim) + '" readonly data-qty="' + qty_terkirim + '"></td>' +
                                    '<td><input type="text" class="form-control qty-diterima" value="' + formatRupiah(qty_diterima) + '" readonly data-qty="' + qty_diterima + '"></td>' +
                                    '<input type="hidden" name="jml[]" value="' + qty_terkirim + '">' +
                                    '<input type="hidden" name="qty_satuan[]" value="' + qty_satuan + '">' +
                                    '<input type="hidden" name="nama_barang1[]" value="' + item.nama_barang + '">' +
                                    '<input type="hidden" name="stok_barang1[]" value="' + item.stockbarang + '">' +
                                    '<td><input type="text" name="satuan[]" class="form-control" value="' + item.satuan + '" readonly></td>' +
                                    '<td><input type="hidden" name="kd_barang[]" value="' + item.kd_barang + '">' +
                                    '<input type="text" class="form-control qty-kirim" name="qty_kirim[]" placeholder="Masukkan Qty Kirim" required value="0" onfocus="if(this.value === \'0\') this.value = \'\';" onblur="if(this.value === \'\') this.value = \'0\';"></td>' +
                                    '<td><input type="text" class="form-control status-barang" name="status_barang[]" readonly></td>' +
                                    '</tr>'
                                );


                                // $('#modalTable tbody').append(
                                //     '<tr>' +
                                //     '<td><input type="text" class="form-control" value="' + item.kd_barang + '" readonly></td>' +
                                //     '<td><input type="text" class="form-control" value="' + item.nama_barang + '" readonly></td>' +
                                //     '<td><input type="text" class="form-control qty-diajukan" value="' + formatRupiah(qty_diajukan) + '" readonly data-qty="' + qty_diajukan + '"></td>' +
                                //     '<td><input type="text" class="form-control qty-diterima" value="' + formatRupiah(qty_diterima) + '" readonly data-qty="' + qty_diterima + '"></td>' +
                                //     '<td><input type="text" class="form-control qty-terkirim" value="' + formatRupiah(qty_terkirim) + '" readonly data-qty="' + qty_terkirim + '"></td>' +
                                //     '<input type="hidden" name="jml[]" value="' + qty_terkirim + '">' +
                                //     '<input type="hidden" name="qty_satuan[]" value="' + qty_satuan + '">' +
                                //     '<td><input type="text" name="satuan[]" class="form-control" value="' + item.satuan + '" readonly></td>' +
                                //     '<td><input type="hidden" name="kd_barang[]" value="' + item.kd_barang + '">' +
                                //     '<input type="text" class="form-control qty-kirim" name="qty_kirim[]" placeholder="Masukkan Qty Kirim" required value = "0" onfocus="if(this.value == '0') this.value = '';" onblur="if(this.value == '') this.value = '0';" ></td>' +
                                //     // '<input type="text" class="form-control qty-kirim" name="qty_kirim[]" placeholder="Masukkan Qty Kirim" required value = "0"  ></td>' +
                                //     '<td><input type="text" class="form-control status-barang" name="status_barang[]" readonly></td>' +
                                //     '</tr>'
                                // );
                            });


                            // Panggil fungsi untuk mengatur readonly setelah data dimuat
                            setInitialReadonlyStatus();


                            $('#modalSuratJalan').modal('show'); // Tampilkan modal
                            $('#qty_value').prop('disabled', false);
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', error); // Log error jika terjadi
                        }
                    });
                });

                // Fungsi untuk format angka ke format ribuan (pemisah titik)
                function formatRupiah(angka) {
                    return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."); // Format ribuan
                }

                // Fungsi untuk mengatur readonly status pada qty_kirim saat pertama kali
                function setInitialReadonlyStatus() {
                    $('#modalTable tbody tr').each(function() {
                        var row = $(this); // Referensi baris saat ini
                        var qty_diajukan = parseFloat(row.find('.qty-diajukan').data('qty')) || 0;
                        var qty_diterima = parseFloat(row.find('.qty-diterima').data('qty')) || 0;
                        var qty_terkirim = parseFloat(row.find('.qty-terkirim').data('qty')) || 0;

                        // Log nilai-nilai yang digunakan untuk debugging
                        console.log("Qty Diajukan:", qty_diajukan);
                        console.log("Qty Diterima:", qty_diterima);
                        console.log("Qty Terkirim:", qty_terkirim);

                        // Tentukan status barang berdasarkan kondisi
                        var status_barang = (qty_diterima >= qty_diajukan) ? 'Selesai' : 'Belum Selesai';

                        // Log status barang untuk memverifikasi status
                        console.log("Status Barang:", status_barang);

                        // Jika qty_diterima sama dengan qty_diajukan
                        if (qty_diterima === qty_diajukan || qty_terkirim >= qty_diajukan) {
                            console.log("Setting qty-kirim to readonly with value 0");
                            // Set qty_kirim menjadi readonly dan set nilainya ke 0
                            row.find('.qty-kirim').prop('readonly', true).val(0);
                        } else {
                            console.log("Qty tidak sama, qty-kirim tetap editable");
                        }

                        // Perbarui kolom status barang
                        row.find('.status-barang').val(status_barang);
                    });
                }




                // Validasi input qty kirim dan update status barang
                $(document).on('input', '.qty-kirim', function() {
                    var qtyKirimInput = $(this);
                    var qty_diajukan = parseFloat(qtyKirimInput.closest('tr').find('.qty-diajukan').data('qty')); // Ambil qty PO asli
                    var qty_terkirim = parseFloat(qtyKirimInput.closest('tr').find('.qty-terkirim').data('qty')); // Ambil qty terkirim
                    var qty_diterima = parseFloat(qtyKirimInput.closest('tr').find('.qty-diterima').data('qty')); // Ambil qty diterima
                    var qtyKirim = parseFloat(qtyKirimInput.val().replace(/\./g, '').replace(',', '.')) || 0; // Konversi ke angka
                    var qty_total_terkirim = qty_diterima + qtyKirim;
                    var status_barang = (qty_diterima >= qty_diajukan) ? 'Selesai' : 'Belum Selesai';
                    var qty_terkirim_total = qty_diajukan - qty_diterima;

                    // Validasi jika qty kirim melebihi qty PO
                    if (qty_total_terkirim > qty_diajukan) {
                        // alert('Qty Kirim melebihi Qty Diajukan');
                        // qtyKirimInput.val(formatRupiah(qty_terkirim_total)); // Set qty kirim maksimal sesuai qty PO
                    } else {
                        // qtyKirimInput.val(formatRupiah(qtyKirim)); // Format qty kirim untuk tampilan
                    }

                    // Jika qty terkirim sudah sama dengan qty diajukan, set input qty kirim menjadi readonly dan nilainya 0

                    // Update status barang berdasarkan qty terkirim + qty kirim
                    qtyKirimInput.closest('tr').find('.status-barang').val(status_barang); // Mengisi status barang
                });
                $(document).ready(function() {
                    $('#qty_value').on('click', function() {
                        $('#modalTable tbody tr').each(function() { // Loop through all rows
                            var row = $(this);
                            var qtyKirimInput = row.find('.qty-kirim');
                            var qtyDiajukan = parseFloat(row.find('.qty-diajukan').data('qty'));
                            var qty_terkirim = parseFloat(row.find('.qty-terkirim').data('qty'));
                            if (qty_terkirim < qtyDiajukan) {
                                qtyKirimInput.val(formatRupiah(qtyDiajukan - qty_terkirim));
                                row.find('.status-barang').val('Selesai');
                            }
                        });
                        $('#qty_value').prop('disabled', true);
                    });
                });

                // Sebelum form disubmit, ubah nilai qty kirim ke format numerik
                $(document).on('submit', 'form', function(event) {
                    // Loop melalui semua input qty-kirim untuk menghapus format ribuan
                    $('.qty-kirim').each(function() {
                        var qtyKirimInput = $(this);
                        var qtyKirim = parseFloat(qtyKirimInput.val().replace(/\./g, '').replace(',', '.')) || 0; // Ambil nilai numerik
                        qtyKirimInput.val(qtyKirim); // Set nilai tanpa pemisah ribuan
                    });
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