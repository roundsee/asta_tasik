<?php
// include 'header.php';
include '../../config/koneksi.php';

$judulform = 'Retur Penjualan Tambah';
$data = 'data_penjualan_retur';
$aksi = 'aksi_penjualan_retur';
$rute = 'penjualan_retur';

$tabel = 'retur_penjualan';
$f1 = 'tanggal_retur';
$f2 = 'kd_retur';
$f3 = 'faktur';
$f4 = 'kd_brg';
$f5 = 'harga';
$f6 = 'banyak';
$f7 = 'satuan';
$f8 = 'subtotal';
$f9 = 'total_retur';
$f10 = 'login_hash';


$j1 = 'Tanggal Retur';
$j2 = 'Kode Retur';
$j3 = 'Faktur';
$j4 = 'Kode Barang';
$j5 = 'Harga';
$j6 = 'Banyak';
$j7 = 'satuan';
$j8 = 'subtotal';
$j9 = 'Total Retur';
$j10 = 'Login Hash';
?>

<!-- Include jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Include Select2 CSS dan JS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color: ghostwhite;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <div style="margin:10px;"></div>
                    <h1 class="list-gds">
                        <b><?php echo $judulform; ?></b>
                        <small style="font-weight: 100;">tambah</small>
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
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card card-default">
            <div class="card-body">
                <div class="row">
                    <div class="box">
                        <div class="box-body">
                            <form method="post" enctype="multipart/form-data"
                                action="route/<?php echo $data; ?>/<?php echo $aksi; ?>.php">

                                <div class="container">
                                    <div class="row">
                                        <!-- Kolom Pertama -->
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label>Tanggal Retur</label>
                                                <input type="date" class="form-control" name="tanggal_retur" value="<?php echo date('Y-m-d'); ?>" readonly />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label>Tanggal Penjualan</label>
                                                <input type="date" name="tanggal_penjualan" id="tanggal_penjualan"
                                                    class="form-control" required value="<?php echo date('Y-m-d'); ?>" />
                                                <small class="text-danger">Pilih tanggal terlebih dahulu!</small>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Faktur</label>
                                                <select name="faktur" id="faktur" class="form-control select2">
                                                    <option value="">Pilih Faktur</option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-md-12">
                                            <div id="barang_container" class="row">
                                                <!-- Data barang akan muncul di sini -->
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="form-group text-right">
                                        <input type="submit" class="btn btn-primary btn-sm elevation-2"
                                            style="opacity: .7" value="Simpan" />

                                        <a href="main.php?route=<?php echo $rute; ?>&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=<?php echo $rute; ?>"
                                            class="btn btn-primary btn-sm elevation-2" style="opacity: .7">
                                            Back
                                        </a>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- Include jQuery dan Select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />


<script>
    $(document).ready(function() {
        // Ambil faktur berdasarkan tanggal
        // $("#tanggal_penjualan").change(function() {
        //     var tanggal = $(this).val();
        //     $("#faktur").html('<option value="">Pilih Faktur</option>'); // Reset faktur saat tanggal berubah
        //     $("#barang_container").html(""); // Kosongkan barang saat tanggal berubah

        //     if (tanggal) {
        //         $.ajax({
        //             url: "route/data_penjualan_retur/get_penjualan.php",
        //             type: "POST",
        //             data: {
        //                 tanggal: tanggal
        //             },
        //             dataType: "json",
        //             success: function(response) {
        //                 console.log("Faktur dari server:", response);
        //                 $.each(response, function(index, faktur) {
        //                     $("#faktur").append('<option value="' + faktur.faktur + '">' + faktur.faktur + '</option>');
        //                 });
        //             },
        //             error: function(xhr, status, error) {
        //                 console.log("AJAX Error: " + status + " - " + error);
        //             }
        //         });
        //     }
        // });

        function loadFaktur() {
            var tanggal = $("#tanggal_penjualan").val();
            $("#faktur").html('<option value="">Pilih Faktur</option>'); // Reset faktur
            $("#barang_container").html(""); // Kosongkan barang

            if (tanggal) {
                $.ajax({
                    url: "route/data_penjualan_retur/get_penjualan.php",
                    type: "POST",
                    data: {
                        tanggal: tanggal
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log("Faktur dari server:", response);
                        $.each(response, function(index, faktur) {
                            $("#faktur").append('<option value="' + faktur.faktur + '">' + faktur.faktur + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log("AJAX Error: " + status + " - " + error);
                    }
                });
            }
        }

        // Load faktur on page load
        loadFaktur();

        // Reload faktur when tanggal_penjualan changes
        $("#tanggal_penjualan").change(loadFaktur);

        // Ambil barang berdasarkan faktur
        $("#faktur").change(function() {
            var faktur = $(this).val();
            $("#barang_container").html(""); // Kosongkan barang saat faktur berubah

            if (faktur) {
                $.ajax({
                    url: "route/data_penjualan_retur/get_barang.php",
                    type: "POST",
                    data: {
                        faktur: faktur
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log("Barang dari server:", response);
                        $.each(response, function(index, barang) {
                            var row = `
                        <div class="col-md-12">
                            <div class="card mb-2">
                                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                    <strong>Kode Barang: ${barang.kd_brg}</strong>
                                    <button type="button" class="btn btn-danger btn-sm btn-hapus-barang" data-kd="${barang.kd_brg}">Hapus</button>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Nama Barang</label>
                                                <input type="text" class="form-control" name="nama_barang[]" value="${barang.nama_barang}" readonly>
                                                <input type="hidden" class="form-control" name="kd_brg[]" value="${barang.kd_brg}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Banyak</label>
                                                <input type="text" class="form-control" name="banyak[]" value="${barang.banyak - barang.total_retur}" readonly>
                                                <input type="hidden" class="form-control" name="banyak_awal_faktur[]" value="${barang.banyak}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Harga</label>
                                                <input type="text" class="form-control text-right" name="harga[]" 
                                                    value="${new Intl.NumberFormat('id-ID').format(barang.harga)}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Jumlah</label>
                                                <input type="text" name="jumlah[]" class="form-control text-right" value="${new Intl.NumberFormat('id-ID').format(barang.jumlah)}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Satuan</label>
                                                <input type="text" name="satuan[]" class="form-control" value="${barang.satuan}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Qty Satuan</label>
                                                <input type="text" name="qty_satuan[]" class="form-control" value="${barang.qty_satuan}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Nama Lokasi</label>
                                                <input type="text" class="form-control" value="${barang.b_paking == 1 ? 'Swalayan' : 'GUDANG'}"  readonly>
                                                <input type="hidden" class="form-control" name="kd_cus[]" value="${barang.b_paking == 1 ? '1316' : '8001'}"  readonly>
                                            </div>
                                        </div>
                                          <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Nama Kasir</label>
                                                <input type="text" class="form-control" value="${barang.oleh}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Jumlah Retur</label>
                                                <input type="number" class="form-control jumlah_retur" name="jumlah_retur[]" max="${barang.banyak  - barang.total_retur}" data-max="${barang.banyak  - barang.total_retur}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                            $("#barang_container").append(row);
                        });

                        // Tambahkan event listener ke input jumlah retur setelah elemen ditambahkan
                        $(".jumlah_retur").on("input", function() {
                            var maxVal = parseInt($(this).data("max"));
                            var inputVal = parseInt($(this).val());

                            if (inputVal > maxVal) {
                                alert("Jumlah retur tidak boleh melebihi jumlah barang yang tersedia!");
                                $(this).val(maxVal);
                            }
                            if (inputVal < 0) {
                                alert("Jumlah retur tidak boleh bernilai negative !");
                                $(this).val(0);
                            }
                        });

                        // Tambahkan event listener untuk tombol hapus barang
                        $(document).on("click", ".btn-hapus-barang", function() {
                            $(this).closest(".col-md-12").remove();
                        });

                    },
                    error: function(xhr, status, error) {
                        console.log("AJAX Error: " + status + " - " + error);
                    }
                });
            } else {
                $("#barang_container").html(""); // Kosongkan jika faktur kosong
            }
        });
    });
</script>