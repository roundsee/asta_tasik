<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$login_hash = $_SESSION['login_hash'];
$en = $_SESSION['employee_number'];
$to = $_SESSION['to'];

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
                                    <b>Stock Opname</b> <small style="font-weight: 100;">input</small>
                                </h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="main.php?route=home">Beranda</a></li>
                                    <li class="breadcrumb-item active">Laporan</li>
                                    <li class="breadcrumb-item active">Stock Opname</li>
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
                                                <form role="form" id="formopname" action="route/lap_mutasi/aksi_list_mutasi.php?route=list_mutasi&act=stock-opname-tambah" method="post">
                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="form-group" style="display: flex; align-items: center;">
                                                                        <label for="lokasi" style="margin-right: 16px; margin-bottom: 0;font-size: 18px;"> Lokasi :</label>
                                                                        <select id="lokasi" name="lokasi" class="select2" style="width: 370px;" <?php echo ($login_hash == 22 || $login_hash == 21) ? 'disabled' : ''; ?> required>
                                                                            <option value="">-- Pilih Lokasi --</option>
                                                                            <option value="1316" <?php echo ($login_hash == 22) ? 'selected' : ''; ?>>Swalayan</option>
                                                                            <option value="8001" <?php echo ($login_hash == 21) ? 'selected' : ''; ?>>Gudang</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group" style="display: flex; align-items: center;">
                                                                        <label for="barang" style="margin-right: 12px; margin-bottom: 0;font-size: 18px;">Barang :</label>
                                                                        <select id="barang" name="barang" class="select2" style="width: 370px;" <?php echo ($login_hash != 22 && $login_hash != 21) ? 'disabled' : ''; ?> required>
                                                                            <option value="">-- Cari Barang --</option>
                                                                            <!-- Options will be loaded here by JavaScript -->
                                                                        </select>
                                                                    </div>
                                                                    <small id="opnameHelp" class="form-text" style="font-weight: bold; font-size: 18px; margin-top: 8px;">Stock saat ini: 0</small>
                                                                    <div class="form-group" style="display: flex; flex-direction: column; align-items: flex-start;">
                                                                        <label for="opname" style="margin-bottom: 8px;margin-top: 8px;font-size: 18px;">Opname Stok (Stock Terbaru):</label>
                                                                        <input type="number" id="opname" name="opname" class="form-control" style="width: 370px;" required>
                                                                    </div>


                                                                    <div class="form-group">
                                                                        <h5 style="font-weight: bold; font-size: 18px; font-size: 16px;">Note:</h5>
                                                                        <p style="font-size: 16px;">
                                                                            Barang akan di lock setelah opname
                                                                        </p>
                                                                        <input id="submitBtn" type="submit" class="btn btn-primary elevation-2" style="opacity: .7" value="Generate Stock Opname" />
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- end Wrapper 1 -->

                                            <hr />
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


            <?php
            include 'wibjs.php';
            ?>
            <script>
                // document.getElementById('opname').addEventListener('input', function() {
                //     let currentValue = this.value;
                //     let note = "Stock saat ini: " + (currentValue ? currentValue : "0");
                //     document.getElementById('opnameHelp').textContent = note;
                // });
                $('#submitBtn').on('click', function(event) {
                    $('#lokasi').prop('disabled', false);
                    if ($('#lokasi').val() === "") {
                        alert("Pilih lokasi.");
                        return false;
                    }
                    const tes = document.getElementById('opnameHelp').textContent;
                    const lokasiText = $('#lokasi option:selected').text();
                    const barangText = $('#barang option:selected').text();

                    const opnameVal = $('#opname').val(); // Number input

                    if (!confirm("Yakin ingin submit untuk lokasi: " + lokasiText + " (Barang: " + barangText + "), Stock Terbaru: " + opnameVal + "?")) {
                        return false;
                    }
                    $('#formopname').submit();
                });
                $(document).ready(function() {
                    // $('#barang').prop('disabled', true);
                    $('#barang').select2({
                        placeholder: "Cari Barang",
                        allowClear: true
                    });

                    if (!$('#lokasi').data('select2')) {
                        $('#lokasi').select2({
                            placeholder: "Pilih Lokasi",
                            allowClear: true
                        });
                    }

                    function loadBarangData(lokasiValue = '') {
                        $.ajax({
                            url: 'route/lap_mutasi/get_barang.php?lokasi=' + lokasiValue,
                            method: 'GET',
                            dataType: 'json',
                            success: function(data) {
                                $('#barang').empty();
                                $('#barang').append(
                                    $('<option>', {
                                        value: "",
                                        text: "-- Cari Barang --"
                                    })
                                );
                                data.forEach(function(item) {
                                    $('#barang').append(
                                        $('<option>', {
                                            value: item.kd_brg,
                                            text: item.kd_brg + ' - ' + item.nama
                                        })
                                    );
                                });
                                $('#barang').prop('disabled', false);
                                $('#barang').val('').trigger('change');
                            },
                            error: function(xhr, status, error) {
                                console.error("Error loading barang data:", error);
                                console.log("Raw response:", xhr.responseText);
                            }
                        });
                    }

                    const lokasiVal = $('#lokasi').val();

                    if (lokasiVal) {
                        const lokasiData = $('#lokasi').select2('data')[0];
                        const lokasiValue = (lokasiData && lokasiData.id) ? lokasiData.id : '';
                        loadBarangData(lokasiValue);
                    } else {
                        loadBarangData();
                    }

                    $('#lokasi').on('select2:select', function(e) {
                        const lokasiData = $('#lokasi').select2('data')[0];
                        const lokasiValue = (lokasiData && lokasiData.id) ? lokasiData.id : '';

                        loadBarangData(lokasiValue);

                        let note = "Stock saat ini: 0";
                        document.getElementById('opnameHelp').textContent = note;
                    });

                    $('#barang').on('select2:select', function(e) {

                        const barangData = $('#barang').select2('data')[0];
                        const lokasiData = $('#lokasi').select2('data')[0];

                        // Use empty string if data is not defined or doesn't have an id or text
                        const barangValue = (barangData && barangData.id) ? barangData.id : '';
                        const lokasiValue = (lokasiData && lokasiData.id) ? lokasiData.id : '';

                        console.log('Current barang:', barangValue, '-', barangData ? barangData.text : '');
                        console.log('Current lokasi:', lokasiValue, '-', lokasiData ? lokasiData.text : '');

                        $.ajax({
                            url: 'route/lap_mutasi/search.php',
                            type: 'POST',
                            data: {
                                barang: barangValue,
                                lokasi: lokasiValue
                            },
                            success: function(response) {
                                const data = JSON.parse(response);
                                console.log('Result from database:', data);
                                let note = "Stock saat ini: " + (data.qt_akhir ? data.qt_akhir : "0") + " ( " + (data.kd_brg ? data.kd_brg : " ") + " - " + (data.kd_cus ? data.kd_cus : " ") + " )";
                                document.getElementById('opnameHelp').textContent = note;
                                // Example: data.kd_brg, data.nama
                            },
                            error: function(xhr, status, error) {
                                console.error('AJAX error:', error);
                            }
                        });
                    });

                });
            </script>

            <?php
            break;
            ?>

<?php
            break;
    }
}
?>