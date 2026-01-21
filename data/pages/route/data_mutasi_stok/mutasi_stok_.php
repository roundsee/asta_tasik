<?php

$judulform = "Mutasi Stok";

$data = "data_mutasi_stok";
$rute = "mutasi_stok";
$aksi = "aksi_mutasi_stok";

$tabel = "mutasi_stok";
$f1 = 'tgl';
$f2 = 'kd_brg';
$f3 = 'satuan';
$f4 = 'qty_awal';
$f5 = 'harga_awal';
$f6 = 'nilai_awal';
$f7 = 'qty_beli';
$f8 = 'harga_beli';
$f9 = 'nilai_beli';
$f10 = 'qty_beli_retur';
$f11 = 'harga_beli_retur';
$f12 = 'nilai_beli_retur';
$f13 = 'harga_rata';
$f14 = 'qty_jual';
$f15 = 'harga_jual';
$f16 = 'nilai_jual';
$f17 = 'qty_jual_retur';
$f18 = 'harga_jual_retur';
$f19 = 'nilai_jual_retur';
$f20 = 'qty_akhir';
$f21 = 'harga_akhir';
$f22 = 'nilai_akhir';
$f23 = 'stok_opname';
$f24 = 'nilai_opname';

$j1 = 'Tanggal';
$j2 = 'Kode Barang';
$j3 = 'Satuan';
$j4 = 'Qty Awal';
$j5 = 'Harga Awal';
$j6 = 'Nilai Awal';
$j7 = 'Qty Beli';
$j8 = 'Harga Beli';
$j9 = 'Nilai Beli';
$j10 = 'Qty Beli Retur';
$j11 = 'Harga Beli Retur';
$j12 = 'Nilai Beli Retur';
$j13 = 'Harga Rata-Rata';
$j14 = 'Qty Jual';
$j15 = 'Harga Jual';
$j16 = 'Nilai Jual';
$j17 = 'Qty Jual Retur';
$j18 = 'Harga Jual Retur';
$j19 = 'Nilai Jual Retur';
$j20 = 'Qty Akhir';
$j21 = 'Harga Akhir';
$j22 = 'Nilai Akhir';
$j23 = 'Stok Opname';
$j24 = 'Nilai Opname';


$tabel2 = 'jenis_transaksi';
$ff1 = 'kd_jenis';


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
                                                    <?php if ($login_hash != 15): ?>
                                                        <button class="btn btn-primary btn-sm elevation-2 " style="opacity: .7;" onclick="window.location='route/<?php echo $data; ?>/autocomplete.php'"><i class="fa fa-plus" ;></i> Tambah</button>
                                                    <?php endif; ?>
                                                    <div style="margin:10px"></div>

                                                    <table id="example1" class="table table-bordered table-striped">
                                                        <thead style="background-color: lightgray;" class="elevation-2">
                                                            <tr>
                                                                <th>No.</th>
                                                                <th><?php echo $j1; ?></th>
                                                                <th><?php echo $j2; ?></th>
                                                                <th><?php echo $j3; ?></th>
                                                                <th><?php echo $j4; ?></th>
                                                                <th><?php echo $j5; ?></th>
                                                                <th><?php echo $j6; ?></th>
                                                                <th><?php echo $j7; ?></th>
                                                                <th><?php echo $j8; ?></th>
                                                                <th><?php echo $j9; ?></th>
                                                                <th><?php echo $j10; ?></th>
                                                                <th><?php echo $j11; ?></th>
                                                                <th><?php echo $j12; ?></th>
                                                                <th><?php echo $j13; ?></th>
                                                                <th><?php echo $j14; ?></th>
                                                                <th><?php echo $j15; ?></th>
                                                                <th><?php echo $j16; ?></th>
                                                                <th><?php echo $j17; ?></th>
                                                                <th><?php echo $j18; ?></th>
                                                                <th><?php echo $j19; ?></th>
                                                                <th><?php echo $j20; ?></th>
                                                                <th><?php echo $j21; ?></th>
                                                                <th><?php echo $j22; ?></th>
                                                                <th><?php echo $j23; ?></th>
                                                                <th><?php echo $j24; ?></th>
                                                                <?php if ($login_hash != 15): ?>
                                                                    <th width="140px">Aksi</th>
                                                                <?php endif; ?>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $sql1 = mysqli_query($koneksi, "SELECT * FROM $tabel ORDER BY $f1 ASC");
                                                            $no = 1;

                                                            while ($s1 = mysqli_fetch_array($sql1)) {
                                                            ?>
                                                                <tr align="left">
                                                                    <td><?php echo $no; ?></td>
                                                                    <td><?php echo $s1[$f1]; ?></td>
                                                                    <td><?php echo $s1[$f2]; ?></td>
                                                                    <td><?php echo $s1[$f3]; ?></td>
                                                                    <td><?php echo $s1[$f4]; ?></td>
                                                                    <!-- Format rupiah untuk harga dan nilai -->
                                                                    <td><?php echo  number_format($s1[$f5], 2, ',', '.'); ?></td>
                                                                    <td><?php echo  number_format($s1[$f6], 2, ',', '.'); ?></td>
                                                                    <td><?php echo $s1[$f7]; ?></td>
                                                                    <td><?php echo  number_format($s1[$f8], 2, ',', '.'); ?></td>
                                                                    <td><?php echo  number_format($s1[$f9], 2, ',', '.'); ?></td>
                                                                    <td><?php echo $s1[$f10]; ?></td>
                                                                    <td><?php echo  number_format($s1[$f11], 2, ',', '.'); ?></td>
                                                                    <td><?php echo  number_format($s1[$f12], 2, ',', '.'); ?></td>
                                                                    <td><?php echo  number_format($s1[$f13], 2, ',', '.'); ?></td>
                                                                    <td><?php echo $s1[$f14]; ?></td>
                                                                    <td><?php echo  number_format($s1[$f15], 2, ',', '.'); ?></td>
                                                                    <td><?php echo  number_format($s1[$f16], 2, ',', '.'); ?></td>
                                                                    <td><?php echo $s1[$f17]; ?></td>
                                                                    <td><?php echo  number_format($s1[$f18], 2, ',', '.'); ?></td>
                                                                    <td><?php echo  number_format($s1[$f19], 2, ',', '.'); ?></td>
                                                                    <td><?php echo $s1[$f20]; ?></td>
                                                                    <td><?php echo  number_format($s1[$f21], 2, ',', '.'); ?></td>
                                                                    <td><?php echo  number_format($s1[$f22], 2, ',', '.'); ?></td>
                                                                    <td><?php echo  number_format($s1[$f23], 2, ',', '.'); ?></td>
                                                                    <td><?php echo  number_format($s1[$f24], 2, ',', '.'); ?></td>
                                                                    <?php if ($login_hash != 15): ?>
                                                                        <td>
                                                                            <a href="main.php?route=<?php echo $rute; ?>&act=edit&id=<?php echo $s1[$f1]; ?>" title="Edit">
                                                                                <button class="btn btn-primary btn-sm elevation-2" style="opacity: .7; width:80px"><i class="fa fa-edit"></i> Edit</button>
                                                                            </a>
                                                                            <a href="route/<?php echo $data; ?>/<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=hapus&id=<?php echo $s1[$f1]; ?>" title="Hapus" onclick="return confirm('Apakah anda yakin ingin menghapus ini?')">
                                                                                <button class="btn btn-danger btn-sm elevation-2" style="opacity: .7; width:80px"><i class="fa fa-trash"></i> Hapus</button>
                                                                            </a>
                                                                        </td>
                                                                    <?php endif; ?>
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
        <?php
            break;

            //Form Edit
        case "edit":
            $edit = mysqli_query($koneksi, "SELECT * from $tabel where $f1='$_GET[id]'");
            $e = mysqli_fetch_array($edit);

            $sql = mysqli_query($koneksi, "SELECT * from $tabel2 where $ff1='$e[$f7]'");
            $s1 = mysqli_fetch_array($sql);

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

                                                <form method="POST" action="route/<?php echo $data; ?>/<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=edit&id=<?php echo $e[$f1]; ?>" enctype="multipart/form-data">

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
                                                                    <input type="text" name="<?php echo $f2; ?>" class="form-control" value="<?php echo $e[$f2]; ?>" autofocus="" required="" />
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <label><?php echo $j3; ?></label>
                                                                    <input type="text" name="<?php echo $f3; ?>" class="form-control" value="<?php echo $e[$f3]; ?>" maxlength="1" autofocus="" required="" />
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-5">
                                                                <div class="form-group">
                                                                    <label><?php echo $j4; ?></label>
                                                                    <input type="text" name="<?php echo $f4; ?>" class="form-control" value="<?php echo $e[$f4]; ?>" maxlength="1" autofocus="" required="" />
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <label><?php echo $j5; ?></label>
                                                                    <input type="text" name="<?php echo $f5; ?>" class="form-control" value="<?php echo $e[$f5]; ?>" maxlength="1" autofocus="" required="" />
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <label><?php echo $j6; ?></label>
                                                                    <input type="text" name="<?php echo $f6; ?>" class="form-control" value="<?php echo $e[$f6]; ?>" maxlength="1" autofocus="" required="" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <label><?php echo $j7; ?></label>
                                                                    <select name="<?php echo $f7; ?>" class="form-control" style="width:200px;height: 40px;">
                                                                        <option value="<?php echo $e[$f7]; ?>"><?php echo $e[$f7] . ' ' . $s1['nama']; ?></option>
                                                                        <?php

                                                                        $produk = mysqli_query($koneksi, "SELECT * from $tabel2 order by $ff1 asc");
                                                                        while ($pro = mysqli_fetch_array($produk)) {
                                                                            echo "<option value='$pro[$ff1]'>$pro[$ff1] - $pro[nama]</option>";
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>

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