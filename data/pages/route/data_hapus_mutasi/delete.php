<?php

$judulform = "Hapus Data Mutasi";

$data = 'data_hapus_mutasi';
$rute = 'delete_mutasi';
$aksi = 'aksi_delete_mutasi';

$tabel = 'mutasi_stok';

if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
    echo "<link href='style.css' rel='stylesheet' type='text/css'>
  <center>Untuk mengakses modul, Anda harus login <br>";
    echo "<a href=../../index.php><b>LOGIN</b></a></center>";
} else {
    switch ($_GET['act']) {
        default:
?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper" style="background-color: #f8f9fa;">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="list-gds">
                                    <b><?php echo $judulform; ?></b>
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
                        <div class="card card-default shadow-lg">
                            <div class="card-header bg-danger text-white">
                                <h3 class="card-title">
                                    <i class="fas fa-exclamation-triangle"></i> 
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <!-- Main row -->
                                <div class="row">
                                    <section class="col-lg-12 connectedSortable">
                                        <div class="box">
                                            <div class="box-body">
                                                <div class="table-responsive">
                                                    <!-- Form Hapus Data Mutasi -->
                                                    <form id="deleteForm" action="route/<?php echo $data; ?>/<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=hapus" method="post">
                                                        <div class="form-group">
                                                            <label for="tanggal" class="font-weight-bold">Pilih Tanggal</label>
                                                            <select name="tanggal" id="tanggal" class="form-control custom-select" required>
                                                                <option value="">-- Pilih Tanggal --</option>
                                                                <?php
                                                                $query = mysqli_query($koneksi, "SELECT DISTINCT tgl FROM $tabel ORDER BY tgl DESC");
                                                                while ($row = mysqli_fetch_array($query)) {
                                                                    echo "<option value='" . $row['tgl'] . "'>" . $row['tgl'] . "</option>";
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <button type="button" class="btn btn-danger btn-sm elevation-2" onclick="confirmDelete()">Hapus</button>
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

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            function confirmDelete() {
                const tanggal = document.getElementById('tanggal').value;
                if (tanggal === '') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan',
                        text: 'Silakan pilih tanggal terlebih dahulu!',
                    });
                    return false;
                }

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: `Anda akan menghapus data pada tanggal ${tanggal}!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('deleteForm').submit();
                    }
                });
            }
        </script>

        <?php
            break;
    }
}
?>
