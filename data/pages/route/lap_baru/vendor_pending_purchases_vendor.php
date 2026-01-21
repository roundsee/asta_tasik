<?php
$login_hash = $_SESSION['login_hash'];
$en = $_SESSION['employee_number'];
$to = $_SESSION['to'];

$judulform = "Pending Purchase Orders By Vendor";

$data = 'lap_baru';
$rute = 'list_lap_baru';
$aksi = 'aksi_list_lap_baru';


$tabel = 'mutasi_semua';
$f1 = 'tgl';
$f2 = 'regional';
$f3 = 'kd_unit';
$f4 = 'nama_outlet';
$f5 = 'kd_sage';
$f6 = 'nama_barang';
$f7 = 'satuan';
$f8 = 'qty_awal';
$f9 = 'nilai_awal';
$f10 = 'qty_beli';
$f11 = 'nilai_beli';
$f12 = 'qt_produksi';
$f13 = 'nilai_produksi';
$f14 = 'qt_terima_int';
$f15 = 'nilai_terima_int';
$f16 = 'qt_tersedia';
$f17 = 'nilai_tersedia';
$f18 = 'harga_rata';
$f19 = 'qt_kirim_int';
$f20 = 'nilai_kirim_int';
$f21 = 'qt_pake';
$f22 = 'nilai_pake';
$f23 = 'qt_jual';
$f24 = 'nilai_jual';
$f25 = 'hpp_jual';
$f26 = 'qt_akhir';
$f27 = 'nilai_akhir';


$j1 = 'Tanggal';
$j2 = 'Regional';
$j3 = 'Kd Cus';
$j4 = 'Nama Outlet';
$j5 = 'Kd Sage';
$j6 = 'Nama Barang';
$j7 = 'Satuan';
$j8 = 'Qty Awal';
$j9 = 'Nilai Awal';
$j10 = 'Qty Beli';
$j11 = 'Nilai Beli';
$j12 = 'Qty Produksi';
$j13 = 'Nilai Produksi';
$j14 = 'Qty Terima Int';
$j15 = 'Nilai Terima Int';
$j16 = 'Qty Tersedia';
$j17 = 'Nilai Tersedia';
$j18 = 'Harga Rata';
$j19 = 'Qty Kirim Int';
$j20 = 'Nilai Kirim Int';
$j21 = 'Qty Pakai';
$j22 = 'Nilai Pakai';
$j23 = 'Qty Jual';
$j24 = 'Nilai Jual';
$j25 = 'Hpp Jual';
$j26 = 'Qty Akhir';
$j27 = 'Nilai Akhir';

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
                <section class="content-header  wow fadeInDown" data-wow-duration=".3s" data-wow-delay=".3s">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="list-gds">
                                    <b><?php echo $judulform; ?></b> <small style="font-weight: 100;">report</small>
                                </h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="main.php?route=home">Beranda</a></li>
                                    <li class="breadcrumb-item active">Laporan</li>
                                    <li class="breadcrumb-item active"><?php echo $judulform; ?></li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>

                <!-- Main content -->
                <!-- <section class="content wow fadeInUp" data-wow-duration=".2s" data-wow-delay=".1s" > -->
                <section class="content wow ">
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

                                            <!-- Wrapper 1 -->
                                            <div class="wrapper" style="min-height:30%">
                                                <form role="form" action="route/<?php echo $data; ?>/<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=example_vendor_pending_vendor" method="post">
                                                    <div class="row">
                                                        <!-- Batas -------------- -->


                                                        <!-- <div class="col-lg-3">
                              <div class="form-group">
                                <label for="reportrange" class="form-label" style="margin-right: 17px; margin-bottom: 0;font-size: 18px;">Pilih Rentang Tanggal</label>

                                <div id="reportrange"
                                  class="form-control d-flex align-items-center"
                                  style="cursor: pointer; padding: 0.6rem 0.75rem; gap: 1rem;">
                                  <i class="fa fa-calendar text-secondary fs-5"></i>
                                  <span class="flex-grow-1 text-dark">Memuat...</span>
                                  <i class="fa fa-caret-down text-muted"></i>
                                </div>

                                <input type="hidden" name="tgl_awal" id="tgl_awal" value="<?php echo date('Y-m-d') ?>">
                                <input type="hidden" name="tgl_akhir" id="tgl_akhir" value="<?php echo date('Y-m-d') ?>">
                              </div>
                            </div> -->

                                                        <div class="col-lg-12"></div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label style="margin-right: 17px; margin-bottom: 0;font-size: 18px;">Supplier : </label>
                                                                <select data-placeholder="Pilih Supplier" multiple class="chosen-select" name="supplier[]" style="width: 270px;">
                                                                    <option value="__select_all__" selected>-- Pilih Semua --</option>
                                                                    <?php
                                                                    $query = mysqli_query($koneksi, "SELECT kd_supp,nama FROM supplier");
                                                                    while ($j = mysqli_fetch_array($query)) {
                                                                    ?>
                                                                        <option value="<?php echo $j["kd_supp"]; ?>"><?php echo $j["kd_supp"] . ' - ' . $j["nama"]; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>

                                                        </div>
                                                        <div class="col-lg-12"></div>
                                                        <div class="col-lg-2">

                                                            <div class="form-group">
                                                                <label style="margin-right: 17px; margin-bottom: 0;font-size: 18px;">Tanggal :</label>
                                                                <input type="date" class="form-control" name="tgl_awal" onclick="displayHasil(this.value)" placeholder="Masukkan Tanggal Awal .. (Wajib)" value="<?php echo date('Y-m-d') ?>" style="width: 300px;" readonly required="required">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12"></div>

                                                        <!-- Generate -->
                                                        <div class="col-lg-3">

                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <input type="hidden" name="kota" id="tampil_kota_id">
                                                                    <input type="hidden" name="outlet" id="tampil_outlet_id">
                                                                    <input type="hidden" name="area" id="tampil_area_id">
                                                                    <input type="hidden" name="divisi" id="tampil_divisi_id">
                                                                    <input type="hidden" name="unitkerja" id="tampil_unitkerja_id">

                                                                    <div class="form-group">
                                                                        <input type="submit" class="btn btn-primary elevation-2" style="opacity: .7" value="Generate Report" />
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Generate -->

                                                    </div>
                                                </form>
                                            </div>
                                            <!-- end Wrapper 1 -->

                                            <hr />

                                            <!-- <input style="width: 100px;"  value="RESET" onclick="window.location='main.php?route=pb1&act';" class="btn btn-sm btn-danger "> -->

                                            <!-- Wraper 3 -->
                                            <div class="wrapper" style="min-height:10">
                                                <div class="row">
                                                    <div class="col-lg-7">
                                                        <div class="form-group">
                                                            <a href="main.php?route=home" title="Batal"> <button class="btn btn-danger btn-sm elevation-2" style="opacity: .7;width:80px"><i class="fa fa-edit"></i> Batal</button></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end Wraper 3 -->

                                        </div><!-- /.box-body -->
                                    </div><!-- /.box -->
                                </section><!-- /.Left col -->
                            </div><!-- /.row (main row) -->
                        </div>
                    </div>
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->
            <script>
                const $select = $(".chosen-select");

                function updateMemberSelectBehavior() {
                    const selected = $select.val() || [];

                    if (selected.includes("__select_all__")) {
                        // Only keep 'Pilih Semua' selected, disable others
                        $select.find("option").each(function() {
                            if (this.value !== "__select_all__") {
                                $(this).prop("selected", false).prop("disabled", true);
                            } else {
                                $(this).prop("selected", true);
                            }
                        });
                    } else {
                        // Re-enable all options and respect current selections
                        $select.find("option").each(function() {
                            $(this).prop("disabled", false);
                        });
                    }

                    // Refresh Chosen
                    $select.trigger("chosen:updated");
                }

                // Initialize Chosen
                $select.chosen({
                    no_results_text: "Tidak Ada"
                });

                // Set initial state
                updateMemberSelectBehavior();

                // Bind event
                $select.on("change", function() {
                    updateMemberSelectBehavior();
                });
                // $(function() {
                //   var start = moment().subtract(29, 'days');
                //   var end = moment();

                //   function cb(start, end) {
                //     $('#reportrange span').html(start.format('D MMMM YYYY') + ' - ' + end.format('D MMMM YYYY'));
                //     $('#tgl_awal').val(start.format('YYYY-MM-DD'));
                //     $('#tgl_akhir').val(end.format('YYYY-MM-DD'));
                //   }

                //   $('#reportrange').daterangepicker({
                //     startDate: start,
                //     endDate: end,
                //     locale: {
                //       format: 'YYYY-MM-DD',
                //       separator: ' - ',
                //       applyLabel: 'Terapkan',
                //       cancelLabel: 'Batal',
                //       customRangeLabel: 'Pilih Sendiri',
                //       daysOfWeek: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
                //       monthNames: [
                //         'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                //         'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                //       ],
                //       firstDay: 1
                //     },
                //     ranges: {
                //       'Hari Ini': [moment(), moment()],
                //       'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                //       '7 Hari Terakhir': [moment().subtract(6, 'days'), moment()],
                //       '30 Hari Terakhir': [moment().subtract(29, 'days'), moment()],
                //       'Bulan Ini': [moment().startOf('month'), moment().endOf('month')],
                //       'Bulan Lalu': [
                //         moment().subtract(1, 'month').startOf('month'),
                //         moment().subtract(1, 'month').endOf('month')
                //       ]
                //     }
                //   }, cb);

                //   cb(start, end); // Initial display
                // });
            </script>

            <?php
            break;
            ?>
            <script>
                $(document).ready(function() {
                    $('#example').DataTable({
                        lengthMenu: [
                            [50, 100, 500, -1],
                            [50, 100, 500, 'All'],
                        ],

                    });
                });
            </script>


            <script>
                function isi_otomatis() {
                    var <?php echo $f1; ?> = $("#<?php echo $f1; ?>").val();
                    $.ajax({
                        url: 'ajax.php',
                        data: "<?php echo $f1; ?>=" + <?php echo $f1; ?>,
                    }).success(function(data) {
                        var json = data,
                            obj = JSON.parse(json);
                        $('#<?php echo $f2; ?>').val(obj.<?php echo $f2; ?>);

                    });
                }
            </script>

<?php
            break;
    }
}
?>