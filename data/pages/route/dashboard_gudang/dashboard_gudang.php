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
    // include $dir . "config/fungsi_kode_otomatis.php";
    // include $dir . "config/fungsi_rupiah.php";
    // include $dir . "config/fungsi_indotgl.php";
    include $dir . "config/library.php";
?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo $perusahaan; ?> system</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="../../../../images/favicon.ico">
        <link rel="stylesheet" href="../../../../assets/fontawesome-free-6.3.0-web/css/all.min.css">
        <!-- Ionicons -->
        <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
        <!-- daterange picker -->
        <!-- <link rel="stylesheet" href="../../../../plugins/daterangepicker/daterangepicker.css"> -->
        <!-- DataTables -->
        <!-- <link rel="stylesheet" href="../../../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="../../../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css"> -->

        <!-- iCheck for checkboxes and radio inputs -->
        <!-- <link rel="stylesheet" href="../../../../plugins/icheck-bootstrap/icheck-bootstrap.min.css"> -->
        <!-- Bootstrap Color Picker -->
        <!-- <link rel="stylesheet" href="../../../../plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css"> -->
        <!-- Tempusdominus Bbootstrap 4 -->
        <!-- <link rel="stylesheet" href="../../../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css"> -->
        <!-- Select2 -->
        <!-- <link rel="stylesheet" href="../../../../plugins/select2/css/select2.min.css">
        <link rel="stylesheet" href="../../../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css"> -->
        <!-- Bootstrap4 Duallistbox -->
        <!-- <link rel="stylesheet" href="../../../../plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css"> -->
        <!-- Theme style -->
        <link rel="stylesheet" href="../../../../dist/css/adminlte.min.css">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

        <!-- tambahan DatePicker -->
        <!-- <link rel="stylesheet" href="../../../../dist/bootstrap-datepicker-1.9.0-dist/css/bootstrap-datepicker.min.css"> -->

        <!-- Tambahkan jqueryUI disini -->
        <!-- <script type="text/javascript" src="<?php echo $dir; ?>jquery-ui/js/jquery-1.10.2.js"></script>
        <script src="<?php echo $dir; ?>jquery-ui/js/tableToExcel.js" defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jsbarcode/3.11.3/JsBarcode.all.min.js"></script> -->


        <!-- <script type="text/javascript" src="<?php echo $dir; ?>jquery-ui/js/jquery-ui-1.10.4.custom.min.js"></script> -->
        <!-- <link type="text/css" rel="stylesheet" href="<?php echo $dir; ?>jquery-ui/css/smoothness/jquery-ui-1.10.4.custom.min.css" /> -->

        <!-- SweetAlert -->
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css"> -->
        <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous"> -->

        <!-- Style sendiri -->
        <link rel="stylesheet" type="text/css" href="../../../../dist/wib.css">

        <!-- Tuesday Demo Page -->
        <!-- <link rel="stylesheet" type="text/css" href="../../../../dist/animated_tuesday/build/tuesday.css" /> -->
        <!--animate-->
        <link rel="stylesheet" type="text/css" href="../../../../dist/anima.css" media="all">

        <!--test111-->
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
        <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet" /> -->
        <!-- <script src="<?php echo $dir; ?>dist/js/wow.min.js"></script> -->
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Popper and Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>

    </head>

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
                        <i class="fa-solid fa-rotate-left"></i> Back</span>
                    <div class="position-relative" id="notif-icon" style="cursor: pointer;">
                        <i class="fas fa-bell fa-xl text-warning"></i>
                        <span id="notif-count">0</span>
                    </div>
                </div>
            </nav>
            <div>
                <h1 style="font-weight: bold; text-align:center">Dashboard Gudang</h1>
                <h1 style="font-weight: bold; text-align:center"><?php echo $perusahaan ?></h1>
                <h5 style="text-align:center"><?php echo $q['alamat'] ?></h5>
            </div>
            <!-- Order Table -->
            <div class="container-fluid mt-4" style=" max-width: 90%;">
                <div class="card shadow-sm">
                    <div class="card-header bg-info text-white">
                        Order
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead class="table-light">
                                <tr>
                                    <th>Waktu</th>
                                    <th>Faktur</th>
                                    <th colspan="2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="order-table-body">
                                <!-- <tr>
                                    <td>ORD1023</td>
                                    <td>
                                        <a href="#" data-toggle="modal" data-target="#fakturModal" data-faktur="ORD1023">Open Modal</a>
                                    </td>
                                    <td align='center' width="100px;">
                                        <button type="button" onclick="Print(this)" class="btn btn-primary"><strong style="color: whitesmoke;">PRINT</strong></button>
                                    </td>
                                    <td align='center' width="100px;">
                                        <button type="button" onclick="Submit(this)" class="btn btn-success"><strong style="color: whitesmoke;">SUBMIT</strong></button>
                                    </td>
                                </tr> -->
                            </tbody>
                        </table>
                        <audio id="notif-sound" src="notification.mp3" preload="auto"></audio>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="fakturModal" tabindex="-1" role="dialog" aria-labelledby="fakturModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="fakturModalLabel">Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        Faktur Number: <span id="fakturText"></span>
                        <table class="table table-bordered table-striped">
                            <thead class="table-light">
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>Satuan</th>
                                    <th>Banyak</th>
                                </tr>
                            </thead>
                            <tbody id="data-table-komponen">
                            </tbody>
                        </table>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>
        <footer class="bg_primary_1 text-white mt-auto" style="padding: 0.5rem 1rem; font-size: 0.75rem; z-index: 10; position: relative;">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <div>
                    <strong>&copy; <?php echo $thn_sekarang . " " . $perusahaan; ?></strong> by Develop. All rights reserved.
                </div>
                <div class="d-none d-sm-inline">
                    <b>Version</b> <?php echo $ver; ?>
                </div>
            </div>
        </footer>

    </body>
    <script>
        let lastNotifCount = 0;
        let lastNotifCountTemporary = 9;


        function fetchNotifications() {
            fetch('notifications.php')
                .then(response => response.json())
                .then(data => {
                    const tbody = document.getElementById('order-table-body');
                    const notifCount = document.getElementById('notif-count');

                    // Clear existing rows
                    tbody.innerHTML = '';

                    // Insert new notifications into the table
                    data.forEach(notif => {
                        const row = document.createElement('tr');

                        row.innerHTML = `
                        <td>${notif.tanggal}</td>
                        <td>
                            <a href="#" data-toggle="modal" data-target="#fakturModal" data-faktur="${notif.faktur}">${notif.faktur}</a>
                        </td>
                        <td align="center" width="100px;">
                            <button type="button" onclick="Print(this)" class="btn btn-primary">
                            <strong style="color: whitesmoke;">PRINT</strong>
                            </button>
                        </td>
                        <td align="center" width="100px;">
                            <button type="button" onclick="Submit(this)" class="btn btn-success">
                            <strong style="color: whitesmoke;">KONFIRMASI</strong>
                            </button>
                        </td>
                        `;

                        tbody.appendChild(row);
                    });

                    notifCount.textContent = data.length;

                    if (data.length > lastNotifCount && lastNotifCountTemporary == 10) {
                        setTimeout(() => {
                            document.getElementById('notif-sound').play().catch(() => {});
                        }, 500);
                    }

                    lastNotifCount = data.length;
                    lastNotifCountTemporary = 10;
                });
        }

        setInterval(fetchNotifications, 5000);
        fetchNotifications();

        $('#fakturModal').on('show.bs.modal', function(event) {
            var link = $(event.relatedTarget);
            var faktur = link.data('faktur');
            var modal = $(this);
            modal.find('#fakturText').text(faktur);
            $.ajax({
                type: 'GET',
                url: 'ajax_cari_barang.php?value=' + faktur,
                dataType: 'json',
                success: function(response) {
                    const tableBody = $('#data-table-komponen');
                    tableBody.empty();

                    if (response.length === 0) {
                        tableBody.append('<tr><td colspan="3" class="text-center">Tidak ADA DATAfound</td></tr>');
                    } else {
                        response.forEach(function(item) {
                            const row = `
                                    <tr>
                                        <td class="text-center">${item.nama}</td>
                                        <td class="text-center">${item.satuan} ( isi : ${item.isi} )</td>
                                        <td>${item.banyak}</td>
                                    </tr>
                                    `;
                            tableBody.append(row);
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    alert("Failed to fetch data. Please try again later.");
                }
            });
        });

        function goBackHome() {
            window.location.href = "../../main.php?route=home";
        }

        function Submit(button) {
            var row = button.closest('tr');
            var tdValue = row.querySelector('td:nth-child(2)').textContent.trim();
            const konfirmasi_selesai = confirm("Konfirmasi Order");
            if (konfirmasi_selesai) {
                $.ajax({
                    type: 'GET',
                    url: 'ajax_confirm.php?nomorfaktur=' + tdValue,
                    dataType: 'json',
                    success: function(response) {
                        lastNotifCountTemporary--;
                        lastNotifCount--;
                        fetchNotifications();
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            }
        }

        function Print(button) {
            var row = button.closest('tr');
            var tdValue = row.querySelector('td:nth-child(2)').textContent.trim();
            window.location.href = 'ajax_print.php?nomorfaktur=' + tdValue;
        }
    </script>

    </html>
<?php } ?>