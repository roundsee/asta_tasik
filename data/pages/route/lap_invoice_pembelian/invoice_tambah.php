<?php

$judulform = 'Invoice Tambah';

$data = 'lap_invoice_pembelian';
$aksi = 'aksi_invoice_pembelian';
$rute = 'invoice_pembelian';

$tabel = 'pembelian_invoice';
$f1 = 'no_invoice';
$f2 = 'tanggal_invoice';
$f3 = 'kd_po';
$f4 = 'kd_supp';
$f5 = 'status_payment';
$f6 = 'status_print';
$f7 = 'status_invoice';

$j1 = 'No Invoice';
$j2 = 'Tanggal Invoice';
$j3 = 'KD Po';
$j4 = 'KD Supp';
$j5 = 'Status Payment';
$j6 = 'Status Print';
$j7 = 'Status Invoice';

$tabel_detail = 'pembelian_invoice_detail';
$ff1 = 'no_invoice';
$ff2 = 'kd_po';
$ff3 = 'kd_brg';
$ff4 = 'nilai';
$ff5 = 'disc';
$ff6 = 'jml_pcs';

$jj1 = 'No Invoice';
$jj2 = 'KD Po';
$jj3 = 'KD Barang';
$jj4 = 'Nilai';
$jj5 = 'Disc';
$jj6 = 'Jumlah Pcs';
?>
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
                    <section>
                        <div class="box">
                            <div class="box-body">
                                <form method="post" enctype="multipart/form-data" action="route/<?php echo $data; ?>/<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=input">
                                    <div class="wrapper">
                                        <div class="row">
                                            <!-- Kolom Pertama -->
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label><?php echo $j1; ?></label>
                                                    <input type="text" name="<?php echo $f1; ?>" class="form-control" placeholder="Masukan <?php echo $j1; ?> ..." required="required" readonly />
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label><?php echo $j2; ?></label>
                                                    <input type="text" name="<?php echo $f2; ?>" class="form-control" placeholder="Masukan <?php echo $j2; ?> ..." required="required" readonly />
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Pembelian</label>
                                                    <select name="id_kategori" class="form-control select2">
                                                        <option></option>
                                                        <?php

                                                        $query = mysqli_query($koneksi, "SELECT * from pembelian order by kd_beli asc");
                                                        while ($x = mysqli_fetch_array($query)) {
                                                            echo "<option value='$x[kd_po]- $x[kd_supp]'>$x[kd_po]</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- Kolom Kedua -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label><?php echo $j4; ?></label>
                                                    <input type="text" name="<?php echo $f4; ?>" class="form-control" placeholder="Masukan <?php echo $j4; ?> ..." required="required" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>
                                    <input type="submit" class="btn btn-primary btn-sm elevation-2" style="opacity: .7" value="Simpan" />
                                    <a href="main.php?route=<?php echo $rute; ?>&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=<?php echo $rute; ?>">
                                        <button type="button" class="btn btn-primary btn-sm elevation-2" style="opacity: .7">Back</button>
                                    </a>
                                </form>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
</div>