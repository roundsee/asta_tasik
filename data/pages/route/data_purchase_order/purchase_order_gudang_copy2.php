<?php

$judulform = "Purchase Order Gudang";

$data = 'data_purchase_order';
$rute = 'purchase_order_gudang';
$aksi = 'aksi_purchase_order';

$rute_detail = 'purchase_order_view';
$rute_detail2 = 'invoice_tambah_po';

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


$j1 = 'Kode PO';
$j2 = 'Tanggal';
$j3 = 'Kode Supplier';
$j4 = 'Ket Payment';
$j5 = 'Status';
$j6 = 'Jenis';
$j7 = 'Ppn';
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
                                                        <form action="route/<?php echo $data ?>/generate_purchase.php" method="post">
                                                            <button type="submit" class="btn btn-success mb-3"><i class="fas fa-save"></i> Rilis Po</button>
                                                        <?php }  ?>
                                                        <table id="example1" class="table table-bordered table-striped">
                                                            <thead style="background-color:  lightgray;" class="elevation-2">
                                                                <tr>
                                                                    <?php if ($login_hash  != 21) { ?>
                                                                        <th><input type="checkbox" id="select-all" onclick="toggle(this);"></th>
                                                                    <?php } ?>
                                                                    <th>No.</th>
                                                                    <th><?php echo $j1; ?></th>
                                                                    <!-- <th>Status</th> -->
                                                                    <th><?php echo $j9; ?></th>
                                                                    <th><?php echo $j3; ?></th>
                                                                    <th>Nama Supplier</th>
                                                                    <!-- <th>Total QTY</th>
                                                                    <th>Satuan</th> -->
                                                                    <th width="340px">Aksi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                // $sql = mysqli_query($koneksi, "
                                                                //     SELECT 
                                                                //         t.ppn,
                                                                //         t.tarif_ppn,
                                                                //         t.status_pembelian,
                                                                //         t.kd_beli,
                                                                //         t.kd_po,
                                                                //         t.tgl_po,
                                                                //         t.kd_supp,
                                                                //         b.nama AS nama_barang,
                                                                //         pd.kd_brg AS kd_brg,
                                                                //         pd.jumlah_pcs AS jumlah_pcs,
                                                                //         supplier.nama AS nama_supplier,
                                                                //         agg.tot_disc,
                                                                //         agg.tot_price,
                                                                //         agg.jumlah_pcs
                                                                //     FROM $tabel t
                                                                //     JOIN pembelian_detail pd ON pd.kd_beli = t.kd_beli
                                                                //     JOIN barang b ON b.kd_brg = pd.kd_brg
                                                                //     JOIN supplier ON supplier.kd_supp = t.kd_supp
                                                                //     LEFT JOIN (
                                                                //         SELECT 
                                                                //             kd_beli,
                                                                //             SUM(disc) AS tot_disc, 
                                                                //             SUM(jml * price) AS tot_price,
                                                                //             SUM(jml * jumlah_pcs) AS jumlah_pcs
                                                                //         FROM $tabel2
                                                                //         GROUP BY kd_beli
                                                                //     ) agg ON agg.kd_beli = t.kd_beli
                                                                //     WHERE t.status_pembelian BETWEEN 1 AND 3
                                                                //     GROUP BY t.kd_po
                                                                // ");


                                                                $sql1 = mysqli_query($koneksi, "SELECT $tabel.ppn , $tabel.tarif_ppn ,$tabel.status_pembelian ,$tabel.kd_beli ,$tabel.kd_po,
                                                                $tabel.tgl_po ,$tabel.kd_supp, b.nama AS nama_barang , b.nama AS nama_barang , pd.kd_brg as kd_brg , pd.jumlah_pcs as jumlah_pcs, supplier.nama as nama_supplier
                                                                from $tabel
                                                                JOIN pembelian_detail pd ON pd.kd_beli = $tabel.kd_beli
                                                                JOIN barang b ON b.kd_brg = pd.kd_brg
                                                                JOIN supplier on supplier.kd_supp = $tabel.kd_supp 
                                                                 WHERE status_pembelian >= 1 AND status_pembelian <=3
                                                                 GROUP BY kd_po
                                                                 ");

                                                                $no = 1;
                                                                $nilai_pjk = 0;
                                                                $subtotal = 0;
                                                                $jumlah_pcs = 0;

                                                                if (!$sql1) {
                                                                    die('query error' . mysqli_error($koneksi));
                                                                }

                                                                while ($s1 = mysqli_fetch_array($sql1)) {
                                                                    $sql2 = mysqli_query($koneksi, "SELECT sum(disc) as tot_disc, sum(jml*price) as tot_price , sum(jml*jumlah_pcs) as jumlah_pcs  from $tabel2 WHERE kd_beli='$s1[kd_beli]' ");
                                                                    $s2 = mysqli_fetch_array($sql2);

                                                                    $grand_total = $s2['tot_price'] - $s2['tot_disc'];

                                                                    if ($s1[$f7] == 1) {
                                                                        $nilai_pjk = $grand_total * 11 / 100;
                                                                    } else {
                                                                        $nilai_pjk = 0;
                                                                    }
                                                                    $subtotal = $grand_total + $nilai_pjk;
                                                                    $jumlah_pcs = $s2['jumlah_pcs'];

                                                                    // if ($s1[$f7] == 1) {
                                                                    //     $nilai_pjk = $s2['tot_price'] * 11 / 100;
                                                                    // } else {
                                                                    //     $nilai_pjk = 0;
                                                                    // }
                                                                    // $subtotal = $s2['tot_price'] + $nilai_pjk;

                                                                ?>
                                                                    <tr align="left">

                                                                        <?php if ($login_hash  != 21) { ?>
                                                                            <?php if ($s1[$f8] == 1) { ?>
                                                                                <td><input type="checkbox" name="selected_items[]" value="<?php echo $s1['kd_beli']  . '|' . $s1['kd_po'] . '|' . $s1['kd_supp']; ?>" class="largeCheckbox"></td>
                                                                            <?php } else { ?>
                                                                                <td></td>
                                                                            <?php } ?>
                                                                        <?php } ?>



                                                                        <td><?php echo $no; ?></td>

                                                                        <td><?php echo $s1['kd_po']; ?></td>

                                                                        <td><?php echo $s1[$f9]; ?></td>

                                                                        <td><?php echo $s1[$f3]; ?></td>
                                                                        <td><?php echo $s1['nama_supplier']; ?></td>

                                                                        <?php if ($login_hash != 21) { ?>
                                                                            <td>
                                                                                <?php if ($s1[$f8] == 1) { ?>
                                                                                <?php } elseif ($s1[$f8] == 2) { ?>
                                                                                    <a href="route/<?php echo $data; ?>/cetak.php?kd_beli=<?php echo $s1['kd_beli']; ?>" target="_blank">
                                                                                        <button class="btn btn-warning btn-sm elevation-2" type="button" style="opacity: .7;">
                                                                                            <i class="fa fa-print"></i> Cetak
                                                                                        </button>
                                                                                    </a>
                                                                                <?php } elseif ($s1[$f8] == 3) { ?>
                                                                                    <button class="btn btn-primary btn-sm elevation-2" disabled type="button" style="opacity: .7;">
                                                                                        <i class="fa fa-print"></i> Sudah Cetak
                                                                                        </a>
                                                                                    <?php } else { ?>
                                                                                        <a href="" title="Hapus">
                                                                                            <button class="btn btn-secondary btn-sm elevation-2" disabled type="button" style="opacity: .7;">
                                                                                                <i class="fa fa-times-circle"></i> Terima Barang
                                                                                            </button>
                                                                                        </a>

                                                                                    <?php } ?>
                                                                            </td>
                                                                        <?php  } else { ?>
                                                                            <?php if ($s1['status_pembelian'] == 3 or $s1['status_pembelian'] == 2) { ?>
                                                                                <td>
                                                                                    <button class="btn btn-success btn-sm elevation-2 btn-terima-barang"
                                                                                        data-kd_beli="<?php echo $s1['kd_beli']; ?>"
                                                                                        data-kd_po="<?php echo $s1['kd_po']; ?>"
                                                                                        data-tujuan_kirim="<?php echo $s1['tujuan_kirim']; ?>"
                                                                                        data-kd_brg="<?php echo $s1['kd_brg']; ?>"
                                                                                        data-nama_barang="<?php echo $s1['nama_barang']; ?>"
                                                                                        data-jumlah_pcs="<?php echo $s1['jumlah_pcs']; ?>"
                                                                                        type="button" style="opacity: .7;">
                                                                                        <i class="fa fa-times-circle"></i> Terima Barang
                                                                                    </button>
                                                                                    <a href="route/<?php echo $data; ?>/cetak_bongkar.php?kd_beli=<?php echo $s1['kd_beli']; ?>" target="_blank">
                                                                                        <button class="btn btn-warning btn-sm elevation-2" type="button" style="opacity: .7;">
                                                                                            <i class="fa fa-print"></i> Cetak
                                                                                        </button>
                                                                                    </a>
                                                                                </td>
                                                                            <?php } elseif ($s1['status_pembelian'] == 4) { ?>
                                                                                <td>
                                                                                    <a href="route/<?php echo $data; ?>/generate_terima_barang.php?kd_beli=<?php echo $s1['kd_beli']; ?>">
                                                                                        <button class="btn btn-secondary btn-sm elevation-2" disabled type="button" style="opacity: .7;">
                                                                                            <i class="fa fa-times-circle"></i> Barang Diterima
                                                                                        </button>
                                                                                    </a>
                                                                                </td>
                                                                            <?php } else { ?>
                                                                                <td>
                                                                                    <button class="btn btn-secondary btn-sm elevation-2" disabled type="button" style="opacity: .7;">
                                                                                        <i class="fa fa-times-circle"></i> Belum Rilis PO
                                                                                    </button>
                                                                                </td>

                                                                            <?php } ?>

                                                                        <?php } ?>
                                                                    </tr>
                                                                <?php
                                                                    $no++;
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

            <div class="modal fade" id="modalSuratJalan" tabindex="-1" role="dialog" aria-labelledby="modalSuratJalanLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xxl" role="document">
                    <div class="modal-content" style="border-radius: 10px; box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);">
                        <form id="formSuratJalan" action="route/<?php echo $data ?>/generate_terima_barang.php" method="POST">
                            <div class="modal-header" style="background-color: #007bff; color: white; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                                <h5 class="modal-title" id="modalSuratJalanLabel" style="font-family: 'Montserrat', sans-serif; font-size: 1.25rem; font-weight: 600;">KODE PURCHASE ORDER : <span id="title"></span> </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" style="padding: 1.5rem;">
                                <input type="hidden" name="kd_beli" id="modalKdBeli">

                                <input type="hidden" name="tujuan_kirim" id="tujuanKirim">

                                <!-- Input Tanggal -->
                                <div class="form-group">
                                    <label for="tanggal" style="font-weight: bold;">Tanggal Penerimaan</label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal" required value="<?php echo date('Y-m-d'); ?>" style="border-radius: 30px; border: 1px solid #007bff; padding: 0.75rem;" readonly>
                                </div>

                                <!-- Checkbox Surat Jalan Otomatis -->
                                <div class="form-group">
                                    <input type="checkbox" id="autoSuratJalan" name="autoSuratJalan">
                                    <label for="autoSuratJalan" style="font-weight: bold; margin-left: 5px;">Generate Surat Jalan Secara Otomatis</label>
                                </div>

                                <!-- Input Nomor Surat Jalan -->
                                <div class="form-group" id="suratJalanGroup">
                                    <label for="surat_jalan" style="font-weight: bold;">Nomor Surat Jalan</label>
                                    <input type="text" class="form-control" id="surat_jalan" name="surat_jalan" required style="border-radius: 30px; border: 1px solid #007bff; padding: 0.75rem;">
                                </div>

                                <!-- Tabel Kode Barang -->
                                <div class="table-responsive">
                                    <table id="modalTable" class="table table-bordered table-striped">
                                        <thead style="background-color: lightgray;">
                                            <tr>
                                                <th>Kode Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Qty Berdasarkan PO</th>
                                                <th>Satuan</th>
                                                <th>Qty Terima</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Baris data akan ditambahkan di sini -->
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                            <div class="modal-footer" style="border-top: none;">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 30px; padding: 0.5rem 1.5rem;">Tutup</button>
                                <button type="submit" class="btn btn-success" style="border-radius: 30px; padding: 0.5rem 1.5rem;">Proses Penerimaan</button>
                            </div>
                        </form>
                        <form id="inputDetailForm" method="post">
                            <div id="formControls">
                                <input type="hidden" name="kd_beli_detail" id="kd_beli_detail">
                                <input type="hidden" name="kd_po_detail" id="kd_po_detail">
                                <div style="display: flex; align-items: center; gap: 1rem;">
                                    <button id="addFormButton" type="button" class="btn btn-primary btn-sm elevation-2" style="opacity: .7;">
                                        <i class="fa fa-plus"></i> Tambah Barang Bonus
                                    </button>
                                    <h1 style="margin: 0; font-size: 1.5rem; color: red; font-weight: bold;">
                                        JANGAN LUPA SAVE BARANG BONUS
                                    </h1>
                                </div>

                            </div>
                            <div id="newFormContainer"></div>
                            <div id="formFooter" style="display:none;">
                                <br>
                                <button type="submit" id="submitButton" class="btn btn-success btn-xs pull-right elevation-1" style="opacity: .7;">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <script>
                $("#data-details, #row-details").hide();
                document.getElementById('addFormButton').addEventListener('click', function() {
                    $("#data-details, #row-details").hide();
                    $("#row-details input[required], #row-details select[required]").each(function() {
                        $(this).removeAttr('required');
                    });
                    var formFooter = document.getElementById('formFooter');
                    var newFormContainer = document.getElementById('newFormContainer');

                    var newFormFieldsHtml = `
                    <div class="row mb-2 mt-3" style="border-bottom: 1px solid #ccc; padding-bottom: 10px; margin-bottom: 10px;">
                        <div class="col-lg-3" >
                            <div class="form-group">
                                <label for="">Barang</label>
                                <select name="kd_acc2[]" class="form-control select2" style="width:100%;"  required>
                                    <option></option>
                                    <?php
                                    $produk = mysqli_query($koneksi, "SELECT * FROM barang WHERE kd_subgrup is null ");
                                    while ($pro = mysqli_fetch_array($produk)) {
                                        // echo "<option value='{$pro['kd_brg']}'>{$pro['kd_brg']} - {$pro['nama']}</option>";
                                        echo  "
                                    <option value='{$pro['kd_brg']}'
                                    data-harga='{$pro['hrg_pcs']}'
                                    data-pcs='{$pro['qty_satuan1']}'
                                    data-renteng='{$pro['qty_satuan2']}'
                                    data-pak='{$pro['qty_satuan3']}'
                                    data-ikat='{$pro['qty_satuan4']}'
                                    data-ball='{$pro['qty_satuan5']}'
                                    data-box='{$pro['Box']}'
                                    data-dus='{$pro['Dus']}'>
                                    {$pro['kd_brg']} - {$pro['nama']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3" style = "display : none" >
                            <div class="form-group">
                                <label>Kode Barang</label>
                                <input type="text" class="form-control kode_account" name="kd_acc[]" placeholder="Autofill by Account" readonly>
                            </div>
                        </div>
                        <div class="col-lg-3" style = "display : none">
                            <div class="form-group">
                                <label>Nama Barang</label>
                                <input type="text" class="form-control nama_account" name="uraian[]" placeholder="Autofill by Account" readonly>
                            </div>
                        </div>
                        <div class="col-lg-2" style="max-width: 150px;">
                            <div class="form-group">
                                <label>Satuan</label>
                                <select name="satuan[]" class="form-control" >
                                    <option>Pilih Satuan </option>
                                    <option value="pcs">Pcs</option>
                                    <option value="renteng">Renteng</option>
                                    <option value="pak">Pak</option>
                                    <option value="ikat">Ikat</option>
                                    <option value="ball">Ball</option>
                                    <option value="box">Box</option>
                                    <option value="dus">Dus</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2" style="max-width: 150px;">
                            <div class="form-group">
                                <label>Isi</label>
                                <input type="text" class="form-control" data-format="currency" name="total_pcs[]" readonly>
                            </div>
                        </div>
                        <div class="col-lg-2" style="max-width: 150px;">
                            <div class="form-group">
                                <label>Quantity</label>
                                <input type="text" class="form-control" data-format="currency"  name="jumlah[]" placeholder="Masukan QTY" required>
                            </div>
                        </div>
                        <div class="col-lg-2" style="max-width: 350px;">
                            <div class="form-group">
                                <label>Quantity Total (Satuan Terkecil)</label>
                                <input type="text" class="form-control" name="hasil_perkalian[]" readonly>
                            </div>
                        </div>
                
                        <div class="col-lg-1 d-flex align-items-center">
                            <button type="button" class="btn btn-danger btn-sm remove-form">Hapus</button>
                        </div>
                    </div>
                    `;


                    var newFormElement = document.createElement('div');
                    newFormElement.innerHTML = newFormFieldsHtml;
                    newFormContainer.appendChild(newFormElement);

                    if (!formFooter.classList.contains('initialized')) {
                        formFooter.style.display = 'block';
                        formFooter.classList.add('initialized');
                    }

                    $(newFormElement).find('.select2').select2({
                        theme: 'bootstrap4'
                    });



                    var hargaDasarGlobal = 0;

                    $(newFormElement).find('select[name="kd_acc2[]"]').on('change', function() {
                        var $row = $(this).closest('.row'); // Mendefinisikan row dengan benar
                        var selectedOption = $(this).find('option:selected');
                        var selectedAcc = selectedOption.val(); // Get the selected value directly
                        var totalPcsValue = $('input[name="total_pcs[]"]').val().trim();
                        var $priceInput = $(this).closest('.row').find('input[name="price[]"]'); // Price input field
                        var $totalPcsInput = $row.find('input[name="total_pcs[]"]'); // Total PCS input field
                        var $jumlahInput = $row.find('input[name="jumlah[]"]'); // Jumlah input field
                        var $quantityTotal = $row.find('input[name="hasil_perkalian[]"]'); // Jumlah input field


                        var kdBrg = selectedOption.val().trim();
                        console.log('Kode barangnya adalah ' + kdBrg);

                        // Reset jumlah dan total_pcs hanya pada baris yang sama
                        $totalPcsInput.val(0); // Reset nilai total_pcs ke 0
                        $jumlahInput.val(0); // Reset nilai jumlah ke 0
                        $quantityTotal.val(0); // Reset nilai jumlah ke 0

                        // Find the satuan select within the same row as the changed kd_acc2
                        var $satuanSelect = $(this).closest('.row').find('select[name="satuan[]"]');
                        if (totalPcsValue != null) {
                            $.ajax({
                                url: './route/data_beli/get_satuan.php',
                                type: 'POST',
                                data: {
                                    id: selectedAcc
                                },
                                success: function(data) {
                                    console.log('Raw response:', data); // Log the raw response

                                    try {
                                        // Assuming `data` is a valid JSON array
                                        var options = data; // Parse the JSON response
                                        $satuanSelect.empty(); // Clear existing options
                                        $satuanSelect.append('<option value="">Pilih Satuan</option>'); // Add placeholder option

                                        // Loop through the options returned from the server and add them to the 'satuan[]' select element
                                        for (var i = 0; i < options.length; i++) {
                                            $satuanSelect.append('<option value="' + options[i].value + '">' + options[i].text + '</option>');
                                        }
                                    } catch (e) {
                                        console.error('Parsing error:', e); // Handle JSON parsing errors
                                        alert('Error parsing response data. Check console for details.');
                                    }
                                },
                                error: function() {
                                    alert('Error retrieving data.'); // Handle AJAX request errors
                                }
                            });
                        }

                        var namaBrg = selectedOption.text().split(' - ')[1].trim();

                        // Set the values for kode_account and nama_account in the same row
                        $(this).closest('.row').find('.kode_account').val(kdBrg);
                        $(this).closest('.row').find('.nama_account').val(namaBrg);
                        // AJAX request to get the price of the selected item


                    });



                    $(newFormElement).find('.remove-form').on('click', function() {
                        $(this).closest('.row').remove();
                        console.log('Element removed. Remaining rows:', $('#newFormContainer .row').length);

                        if ($('#newFormContainer .row').length === 0) {
                            console.log('No more rows, showing #data-details and #row-details');
                            $('#data-details, #row-details').show();
                            $('#formFooter').hide();
                        }
                    });


                    $(newFormElement).find('select[name="satuan[]"]').on('change', function() {
                        updateTotalPcs($(this).closest('.row'));
                    });

                    $(newFormElement).find('input[name="jumlah[]"]').on('input', function() {
                        updateJumlahTotal($(this).closest('.row'));
                    });


                    function updateTotalPcs(row) {
                        var selectedOption = row.find('select[name="kd_acc2[]"]').find('option:selected');
                        var satuan = row.find('select[name="satuan[]"]').val();
                        var totalPcs = selectedOption.data(satuan) || 0;

                        row.find('input[name="total_pcs[]"]').val(totalPcs);

                        // Pastikan menggunakan harga awal dari variabel global (hargaDasarGlobal)
                        console.log("Harga awal (dasar):", hargaDasarGlobal);

                        // Hitung harga setelah dikalikan dengan total pcs
                        var hargaXIsi = hargaDasarGlobal * (parseFloat(totalPcs) || 0);

                        // Update input harga dengan nilai hasil perkalian
                        row.find('input[name="price[]"]').val(new Intl.NumberFormat('id-ID', {
                            minimumFractionDigits: 0
                        }).format(hargaXIsi));

                        updateJumlahTotal(row);
                    }

                    function updateJumlahTotal(row) {
                        var totalPcs = parseFloat(row.find('input[name="total_pcs[]"]').val()) || 0;

                        // Ambil nilai jumlah dan hapus format rupiah (titik atau koma)
                        var jumlah = row.find('input[name="jumlah[]"]').val();
                        jumlah = jumlah.replace(/[.,]/g, ''); // Menghilangkan titik dan koma

                        // Konversi jumlah menjadi angka desimal
                        jumlah = parseFloat(jumlah) || 0;

                        var hasilPerkalian = totalPcs * jumlah;
                        console.log("hasil perkalian nyaa/ jumlah totalnya ", hasilPerkalian);
                        row.find('input[name="hasil_perkalian[]"]').val(hasilPerkalian);
                    }


                    // Tambahkan event untuk submit data

                });
                document.getElementById('submitButton').addEventListener('click', function(event) {
                    event.preventDefault();

                    // Ambil nilai dari hidden input
                    var kd_beli_detail = $('#kd_beli_detail').val();
                    var kd_po_detail = $('#kd_po_detail').val();

                    console.log('kd_beli_detail:', kd_beli_detail);
                    console.log('kd_po_detail:', kd_po_detail);

                    // Kumpulkan semua data dari form
                    var formData = [];
                    $('#newFormContainer .row').each(function() {
                        var row = $(this);
                        var rowData = {
                            kd_acc2: row.find('select[name="kd_acc2[]"]').val() || '',
                            kd_acc: row.find('input[name="kd_acc[]"]').val() || '',
                            uraian: row.find('input[name="uraian[]"]').val() || '',
                            satuan: row.find('select[name="satuan[]"]').val() || '',
                            total_pcs: row.find('input[name="total_pcs[]"]').val() || 0,
                            jumlah: row.find('input[name="jumlah[]"]').val() || 0,
                            hasil_perkalian: row.find('input[name="hasil_perkalian[]"]').val() || 0
                        };
                        formData.push(rowData);
                    });

                    console.log('Data yang dikirim:', JSON.stringify(formData));

                    // Kirim data dengan AJAX
                    $.ajax({
                        url: './route/data_purchase_order/aksi_tambah_barang_bonus.php',
                        type: 'POST',
                        data: {
                            kd_beli_detail: kd_beli_detail,
                            kd_po_detail: kd_po_detail,
                            formData: JSON.stringify(formData) // Pastikan formData diubah menjadi string JSON
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 'success') {
                                alert('Data berhasil disimpan!');
                                $('#formFooter').hide();

                                // Menginisialisasi select2 untuk elemen baru yang ditambahkan
                                $('#newFormContainer').find('.select2').select2({
                                    theme: 'bootstrap4'
                                });

                                // Menghapus elemen baru yang telah ditambahkan
                                var newFormContainer = document.getElementById('newFormContainer');
                                if (newFormContainer) {
                                    newFormContainer.innerHTML = ''; // Menghapus semua elemen dalam kontainer
                                }

                                // Menyembunyikan formFooter setelah data berhasil disimpan
                                var formFooter = document.getElementById('formFooter');
                                if (formFooter) {
                                    formFooter.style.display = 'none';
                                    formFooter.classList.remove('initialized'); // Menghapus class initialized jika diperlukan
                                }

                                // Refresh data modal setelah berhasil menyimpan
                                var kd_beli = $('#modalKdBeli').val(); // Ambil nilai kd_beli yang sudah ada di modal
                                var tujuan_kirim = $('#tujuanKirim').val(); // Ambil tujuan_kirim yang sudah ada di modal

                                // Kosongkan tabel sebelum menambahkan data baru
                                $('#modalTable tbody').empty();

                                // Panggil ulang AJAX untuk memuat data terbaru
                                $.ajax({
                                    url: 'route/<?php echo $data ?>/get_barang_by_kd_beli.php', // Path sesuai
                                    type: 'POST',
                                    data: {
                                        kd_beli: kd_beli,
                                        tujuan_kirim: tujuan_kirim
                                    },
                                    dataType: 'json',
                                    success: function(response) {
                                        // Tambahkan data ke tabel modal
                                        $.each(response, function(index, item) {
                                            // Tentukan nilai Qty PO dan Qty Terima
                                            var qtyPO = item.status_barang == 1 ? 0 : Math.round(item.jumlah_pcs); // Qty PO diatur 0 jika status_barang = 1
                                            var qtyTerima = item.status_barang == 1 ? Math.round(item.jumlah_pcs) : ''; // Qty Terima diambil dari jumlah_pcs jika status_barang = 1

                                            // Tentukan atribut tambahan untuk baris dan inputan
                                            var rowClass = item.status_barang == 1 ? 'style="background-color: #add8e6;"' : ''; // Warna biru muda jika status_barang = 1
                                            var qtyTerimaAttr = item.status_barang == 1 ? 'value="' + qtyTerima + '" readonly' : 'placeholder="Masukan Qty Terima"'; // Qty Terima readonly jika status_barang = 1

                                            // Tambahkan baris ke tabel
                                            $('#modalTable tbody').append(
                                                '<tr ' + rowClass + '>' +
                                                '<td><input type="text" class="form-control" value="' + item.kd_brg + '" readonly></td>' +
                                                '<td><input type="text" class="form-control" value="' + item.nama_barang + '" readonly></td>' +
                                                '<td><input type="text" class="form-control qty-po" value="' + formatRupiah(qtyPO) + '" readonly data-qty="' + qtyPO + '"></td>' +
                                                '<input type="hidden" name="jml[]" value="' + qtyPO + '">' +
                                                '<td><input type="text" name="satuan[]" class="form-control" value="' + item.satuan + '" readonly></td>' +
                                                '<input type="hidden" name="urut[]" value="' + item.urut + '">' +
                                                '<td><input type="hidden" name="kd_brg[]" value="' + item.kd_brg + '">' +
                                                '<input type="text" class="form-control qty-terima" name="qty_terima[]" ' + qtyTerimaAttr + ' required></td>' +
                                                '</tr>'
                                            );
                                        });
                                    },
                                    error: function(xhr, status, error) {
                                        console.log('Gagal memuat ulang data modal:', error);
                                    }
                                });

                                // $.ajax({
                                //     url: 'route/<?php echo $data ?>/get_barang_by_kd_beli.php', // Path sesuai
                                //     type: 'POST',
                                //     data: {
                                //         kd_beli: kd_beli,
                                //         tujuan_kirim: tujuan_kirim
                                //     },
                                //     dataType: 'json',
                                //     success: function(response) {
                                //         // Tambahkan data ke tabel modal
                                //         $.each(response, function(index, item) {
                                //             var qtyPO = Math.round(item.jumlah_pcs);

                                //             $('#modalTable tbody').append(
                                //                 '<tr>' +
                                //                 '<td><input type="text" class="form-control" value="' + item.kd_brg + '" readonly></td>' +
                                //                 '<td><input type="text" class="form-control" value="' + item.nama_barang + '" readonly></td>' +
                                //                 '<td><input type="text" class="form-control qty-po" value="' + formatRupiah(qtyPO) + '" readonly data-qty="' + qtyPO + '"></td>' +
                                //                 '<input type="hidden" name="jml[]" value="' + qtyPO + '">' +
                                //                 '<td><input type="text" name="satuan[]" class="form-control" value="' + item.satuan + '" readonly></td>' +
                                //                 '<input type="hidden" name="urut[]" value="' + item.urut + '">' +
                                //                 '<td><input type="hidden" name="kd_brg[]" value="' + item.kd_brg + '">' +
                                //                 '<input type="text" class="form-control qty-terima" name="qty_terima[]" placeholder="Masukan Qty Terima" required></td>' +
                                //                 '</tr>'
                                //             );
                                //         });
                                //     },
                                //     error: function(xhr, status, error) {
                                //         console.log('Gagal memuat ulang data modal:', error);
                                //     }
                                // });

                            } else {
                                alert('Terjadi kesalahan: ' + response.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            alert('Error: ' + error);
                        }
                    });
                });
                document.addEventListener('input', function(event) {
                    const row = event.target.closest('.row'); // Cari baris terkait
                    if (!row) return; // Jika tidak dalam konteks row, hentikan

                    // Ambil elemen input terkait
                    const jumlahInput = row.querySelector('input[name="jumlah[]"]');
                    const hargaSatuanInput = row.querySelector('input[name="price[]"]');
                    const hargaTotalInput = row.querySelector('input[name="hargaTotal[]"]');

                    // Fungsi untuk parsing dan formatting currency
                    const parseCurrency = (value) => parseFloat(value.replace(/[.,]/g, '') || 0);
                    const formatCurrency = (value) =>
                        new Intl.NumberFormat('id-ID', {
                            minimumFractionDigits: 0,
                            maximumFractionDigits: 0,
                        }).format(value);

                    // Jika input yang berubah adalah Harga Satuan atau Jumlah
                    if (event.target === hargaSatuanInput || event.target === jumlahInput) {
                        const jumlah = parseCurrency(jumlahInput.value);
                        const hargaSatuan = parseCurrency(hargaSatuanInput.value);

                        // Hitung Harga Total
                        const hargaTotal = jumlah * hargaSatuan;
                        hargaTotalInput.value = formatCurrency(hargaTotal);
                    }

                    // Jika input yang berubah adalah Harga Total
                    if (event.target === hargaTotalInput) {
                        const jumlah = parseCurrency(jumlahInput.value);
                        const hargaTotal = parseCurrency(hargaTotalInput.value);

                        // Hitung Harga Satuan
                        const hargaSatuan = jumlah > 0 ? hargaTotal / jumlah : 0;
                        hargaSatuanInput.value = formatCurrency(hargaSatuan);
                    }
                });
                // Fungsi untuk memformat input menjadi format ribuan tanpa "Rp"
                function formatCurrency(inputElement) {
                    let input = inputElement.value.replace(/[^,\d]/g, ''); // Menghapus karakter non-digit
                    let formattedInput = new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 0
                    }).format(input);

                    // Mengupdate nilai input dengan format rupiah tanpa "Rp"
                    inputElement.value = formattedInput.replace('Rp', '').trim();
                }

                // Event delegation untuk elemen dengan atribut data-format="currency"
                document.addEventListener('input', function(e) {
                    if (e.target.matches('[data-format="currency"]')) {
                        formatCurrency(e.target);
                    }
                });

                // Menghapus format saat submit form
                document.querySelector('#inputDetailForm').addEventListener('submit', function(e) {
                    const diskonInputs = document.querySelectorAll('.diskon');

                    diskonInputs.forEach((input) => {
                        input.value = input.value.replace(/\./g, ''); // Hapus titik sebelum submit
                    });

                    console.log(diskonInputs);
                });

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
                $(document).on('click', '.btn-terima-barang', function() {
                    var kd_beli = $(this).data('kd_beli');
                    var kd_po = $(this).data('kd_po');
                    var tujuan_kirim = $(this).data('tujuan_kirim');
                    $('#autoSuratJalan').on('change', function() {
                        if ($(this).is(':checked')) {
                            $('#suratJalanGroup').hide(); // Sembunyikan input surat jalan
                            $('#surat_jalan').prop('required', false); // Hilangkan required
                        } else {
                            $('#suratJalanGroup').show(); // Tampilkan input surat jalan
                            $('#surat_jalan').val("").prop('required', true);
                        }
                    });
                    $('#autoSuratJalan').prop('checked', false).trigger('change');


                    $('#modalKdBeli').val(kd_beli); // Set nilai kd_beli di modal
                    $('#waduh').val(kd_beli); // Set nilai kd_beli di modal
                    $('#title').text(kd_po); // Set judul di modal
                    $('#tujuanKirim').val(tujuan_kirim)

                    // Set nilai ke form detail
                    $('#kd_beli_detail').val(kd_beli);
                    $('#kd_po_detail').val(kd_po);


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
                            $.each(response, function(index, item) {
                                // Jika status_barang = 1, Qty PO = 0, Qty Terima = jumlah_pcs
                                var qtyPO = item.status_barang == 1 ? 0 : Math.round(item.jumlah_pcs);
                                var qtyTerima = item.status_barang == 1 ? Math.round(item.jumlah_pcs) : '';

                                // Tentukan warna latar untuk status_barang = 1
                                var rowClass = item.status_barang == 1 ? 'style="background-color: #add8e6;"' : '';

                                // Tentukan atribut untuk Qty Terima (readonly jika status_barang = 1)
                                var qtyTerimaAttr = item.status_barang == 1 ? 'value="' + qtyTerima + '" readonly' : 'placeholder="Masukan Qty Terima"';

                                // Tambahkan baris ke tabel
                                $('#modalTable tbody').append(
                                    '<tr ' + rowClass + '>' +
                                    '<td><input type="text" class="form-control" value="' + item.kd_brg + '" readonly></td>' +
                                    '<td><input type="text" class="form-control" value="' + item.nama_barang + '" readonly></td>' +
                                    '<td><input type="text" class="form-control qty-po" value="' + formatRupiah(qtyPO) + '" readonly data-qty="' + qtyPO + '"></td>' +
                                    '<input type="hidden" name="jml[]" value="' + qtyPO + '">' +
                                    '<td><input type="text" name="satuan[]" class="form-control" value="' + item.satuan + '" readonly></td>' +
                                    '<input type="hidden" name="urut[]" value="' + item.urut + '">' +
                                    '<td><input type="hidden" name="kd_brg[]" value="' + item.kd_brg + '">' +
                                    '<input type="text" class="form-control qty-terima" name="qty_terima[]" ' + qtyTerimaAttr + ' required></td>' +
                                    '</tr>'
                                );
                            });

                            $('#modalSuratJalan').modal('show'); // Tampilkan modal
                        },
                        error: function(xhr, status, error) {
                            console.log(error); // Tampilkan error jika terjadi
                        }
                    });

                });

                // Fungsi untuk format angka ke format ribuan
                function formatRupiah(angka) {
                    return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."); // Menambahkan pemisah ribuan
                }

                // Event input untuk qty terima
                $(document).on('input', '.qty-terima', function() {
                    var qtyTerimaInput = $(this);
                    var qtyPO = parseFloat(qtyTerimaInput.closest('tr').find('.qty-po').data('qty')); // Ambil qty PO asli
                    var qtyTerima = parseFloat(qtyTerimaInput.val().replace(/\./g, '').replace(',', '.')) || 0; // Konversi ke angka

                    // Jika qty terima melebihi qty PO, tampilkan peringatan
                    if (qtyTerima > qtyPO) {
                        alert('Qty Terima melebihi Qty Berdasarkan PO');
                        qtyTerimaInput.val(formatRupiah(qtyPO)); // Set qty terima maksimal sesuai qty PO
                    } else {
                        qtyTerimaInput.val(formatRupiah(qtyTerima)); // Set format ribuan untuk tampilan
                    }
                });

                // Sebelum form disubmit, pastikan untuk mengubah nilai qty terima ke format numerik
                $(document).on('submit', 'form', function(event) {
                    // Pastikan untuk mengambil semua qty terima
                    $('.qty-terima').each(function() {
                        var qtyTerimaInput = $(this);
                        var qtyTerima = parseFloat(qtyTerimaInput.val().replace(/\./g, '').replace(',', '.')) || 0; // Ambil nilai numerik
                        qtyTerimaInput.val(qtyTerima); // Set nilai kembali tanpa pemisah ribuan
                    });
                });

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
    }
}
?>