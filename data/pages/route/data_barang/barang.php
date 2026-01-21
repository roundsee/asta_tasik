<?php

$judulform = "Daftar Barang";

$data = 'data_barang';
$rute = 'barang';
$aksi = 'aksi_barang';

$tabel = 'barang';

$f1 = 'kd_brg';
$f2 = 'nama';
$f3 = 'harga';
$f_31 = 'hrg_satuan1';
$f_32 = 'hrg_satuan2';
$f_33 = 'hrg_satuan3';
$f_34 = 'hrg_satuan4';
$f_35 = 'hrg_satuan5';
$f_31gr = 'hrg_satuan1_grosir';
$f_32gr = 'hrg_satuan2_grosir';
$f_33gr = 'hrg_satuan3_grosir';
$f_34gr = 'hrg_satuan4_grosir';
$f_35gr = 'hrg_satuan5_grosir';
$f_31ol = 'hrg_satuan1_online';
$f_32ol = 'hrg_satuan2_online';
$f_33ol = 'hrg_satuan3_online';
$f_34ol = 'hrg_satuan4_online';
$f_35ol = 'hrg_satuan5_online';
$f_31ms = 'hrg_satuan1_ms';
$f_32ms = 'hrg_satuan2_ms';
$f_33ms = 'hrg_satuan3_ms';
$f_34ms = 'hrg_satuan4_ms';
$f_35ms = 'hrg_satuan5_ms';
$f_31mg = 'hrg_satuan1_mg';
$f_32mg = 'hrg_satuan2_mg';
$f_33mg = 'hrg_satuan3_mg';
$f_34mg = 'hrg_satuan4_mg';
$f_35mg = 'hrg_satuan5_mg';
$f_31mp = 'hrg_satuan1_mp';
$f_32mp = 'hrg_satuan2_mp';
$f_33mp = 'hrg_satuan3_mp';
$f_34mp = 'hrg_satuan4_mp';
$f_35mp = 'hrg_satuan5_mp';
$f4 = 'satuan';
$f_41 = 'Satuan1';
$f_42 = 'Satuan2';
$f_43 = 'Satuan3';
$f_44 = 'Satuan4';
$f_45 = 'Satuan5';
$f5 = 'kd_subgrup';
$f6 = 'kd_grup';
$f7 = 'photo';
$f8 = 'rating';
$f9 = 'Quantity';
$f_91 = 'qty_satuan1';
$f_92 = 'qty_satuan2';
$f_93 = 'qty_satuan3';
$f_94 = 'qty_satuan4';
$f_95 = 'qty_satuan5';
$f10 = 'Pcs';
$f11 = 'Renteng';
$f12 = 'Pak';
$f13 = 'ikat';
$f14 = 'Ball';
$f15 = 'Box';
$f16 = 'Dus';
$f17 = 'hrg_pcs';
$f18 = 'hrg_renteng';
$f19 = 'hrg_pak';
$f20 = 'hrg_ikat';
$f21 = 'hrg_ball';
$f22 = 'hrg_box';
$f23 = 'hrg_dus';
$f24 = 'disc_pcs';
$f25 = 'disc_renteng';
$f26 = 'disc_pak';
$f27 = 'disc_ikat';
$f28 = 'disc_ball';
$f29 = 'disc_box';
$f30 = 'disc_dus';
$f31 = 'ktg_retail';
$f32 = 'ktg_grosir';
$f33 = 'ktg_online';
$f34 = 'ktg_ms';
$f35 = 'ktg_mg';
$f36 = 'ktg_mp';
$f37 = 'ktg_buffer';




$j1 = 'Kode Barang';
$j2 = 'Nama';
$j3 = 'Harga';
$j4 = 'Satuan';
$j5 = 'kd_subgrup';
$j6 = 'kd_grup';
$j7 = 'photo';
$j8 = 'rating';
$j9 = 'Quantity';
$j10 = 'Pcs';
$j11 = 'Renteng';
$j12 = 'Pak';
$j13 = 'Ikat';
$j14 = 'Ball';
$j15 = 'Box';
$j16 = 'Dus';
$j17 = 'Harga Pcs';
$j18 = 'Harga Renteng';
$j19 = 'Harga Pak';
$j20 = 'Harga Ikat';
$j21 = 'Harga Ball';
$j22 = 'Harga Box';
$j23 = 'Harga Dus';
$j24 = 'Disc Pcs';
$j25 = 'Disc Renteng';
$j26 = 'Disc Pak';
$j27 = 'Disc Ikat';
$j28 = 'Disc Ball';
$j29 = 'Disc Box';
$j30 = 'Disc Dus';
$j31 = 'ID kategori Retail';
$j32 = 'ID Kategori Grosir';
$j33 = 'ID Kategori Online';
$j34 = 'ID Kategori Member Silver';
$j35 = 'ID Kategori Member Gold';
$j36 = 'ID Kategori Member Platinum';
$j37 = 'ID Kategori Buffer';
$j38 = 'Jumlah Stock';


$data2 = 'import_barang';

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
      <style>
        #loadingSpinner {
          position: fixed;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          background: rgba(255, 255, 255, 0.8);
          display: flex;
          justify-content: center;
          align-items: center;
          z-index: 9999;
        }

        .spinner {
          border: 8px solid rgba(255, 255, 255, 0.3);
          border-top: 8px solid #3498db;
          border-radius: 50%;
          width: 60px;
          height: 60px;
          animation: spin 1.5s linear infinite;
        }

        @keyframes spin {
          0% {
            transform: rotate(0deg);
          }

          100% {
            transform: rotate(360deg);
          }
        }
      </style>
      <div id="loadingSpinner" style="display:none;">
        <div class="spinner"></div>
      </div>
      <div class="modal fade" id="dynamicModal" tabindex="-1" role="dialog" aria-labelledby="dynamicModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document" style="max-width: 70%; max-height: 70%; margin: auto;">
          <div class="modal-content" style="height: 100%;">
            <div class="modal-header" style="font-size: 1.5rem;">
              <h5 class="modal-title" id="dynamicModalLabel" style="font-size: 2.5rem; font-weight: bold;"></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="font-size: 2rem; line-height: 1;">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="modalBody" style="font-size: 1.5rem;">
              <table id="searchhasil_barang" style="width: 100%;">
                <thead>
                  <tr style="font-size: 1.8rem;">
                    <th>Unit</th>
                    <th>Harga</th>
                  </tr>
                </thead>
                <tbody id="searchhasil_barang_barangTableBodysearch" style="font-size: 1.6rem;">
                  <!-- Rows will be dynamically added here -->
                </tbody>
              </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal" style="font-size: 1.5rem;">Close</button>
            </div>
          </div>
        </div>
      </div>




      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper" style="background-color: ghostwhite;">
        <!-- Content Header (Page header) -->
        <section class="content-header  wow fadeInDown" data-wow-duration=".3s" data-wow-delay=".3s">
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
        <section class="content wow fadeInUp" data-wow-duration=".2s" data-wow-delay=".1s">
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

                        <?php $sql123 = mysqli_query($koneksi, " SELECT COUNT(kd_brg) AS jumlah_data from $tabel");
                        while ($s123 = mysqli_fetch_array($sql123)) {
                        ?>
                          <p>Jumlah data sebanyak : <?php echo $s123["jumlah_data"]; ?></p>
                        <?php } ?>
                        <?php if ($login_hash != 22 && $login_hash != 21) { ?>

                          <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                              <button class="btn btn-primary btn-sm elevation-2" style="opacity: .7; margin-right: 10px;"
                                onclick="window.location='main.php?route=barang_tambah'">
                                <i class="fa fa-plus"></i> Tambah
                              </button>
                              <button class="btn btn-success btn-sm elevation-2" style="opacity: .7; margin-right: 10px;"
                                onclick="window.location='../../data/pages/main.php?route=<?php echo $data2; ?>'">
                                <i class="fa-solid fa-file-excel"></i> Import
                              </button>
                              <button class="btn btn-secondary btn-sm elevation-2" style="opacity: .7; margin-right: 10px;" id="barangtoExcel" type="button">
                                <i class="fa fa-print"></i> Export semua barang
                              </button>

                              <button class="btn btn-secondary btn-sm elevation-2" style="opacity: .7; margin-right: 10px;" id="toExcel">
                                <i class="fa fa-print"></i> Export barang tanpa kategori
                              </button>
                              <button type="button" class="btn btn-danger btn-sm elevation-2" id="cariTableKomponen" data-toggle="modal" data-target="#cariKomponen" style="width: 170px;opacity: .7;">
                                <i class="fa fa-search"></i> Undo Hide Barang
                              </button>
                              <!-- <button type="button" class="btn btn-warning btn-sm elevation-2" id="cariTableLockBarang" data-toggle="modal" data-target="#cariLock" style="width: 170px;opacity: .7;margin-left: 10px;">
                                <i class="fa fa-search"></i> Lihat Barang Lock
                              </button> -->
                              <button class="btn btn-secondary btn-sm elevation-2" style="opacity: .7; margin-left: 10px;" id="barangsage" type="button">
                                <i class="fa fa-print"></i> Export Data Sage Barang
                              </button>
                            </div>
                            <!-- <div class="d-flex align-items-center">
                            <label for="cariBarangManual" class="form-label mb-1" style="font-weight: bold; font-size: 15px;">Cari Barang:<span style="margin-left: 5px;"></span></label>
                            <input type="text" name="cariBarangManual" class="form-control" id="cariBarangManual" style="width: auto; height: 30px; padding: 5px; border: 1px solid #ced4da; border-radius: 4px; margin-top: 5px;" placeholder="Masukkan nama barang..." />
                            </div> -->
                            <div class="d-flex align-items-end">
                              <!-- <div class="d-flex align-items-end me-3">
                              <input type="text" name="cariBarangBarcode" class="form-control ms-2" id="cariBarangBarcode" style="width: auto; height: 30px; padding: 5px; border: 1px solid #ced4da; border-radius: 4px; margin-top: 5px;margin-right: 15px;" placeholder="Barcode..." />
                            </div> -->
                            <?php } ?>

                            <div class="d-flex align-items-end">
                              <input type="text" name="cariBarangManual" class="form-control" id="cariBarangManual" style="width: auto; height: 30px; padding: 5px; border: 1px solid #ced4da; border-radius: 4px; margin-top: 5px;" placeholder="Cari Barang..." />
                            </div>
                            </div>
                          </div>
                          <div class="table-responsive">

                            <!-- <button class="btn btn-primary btn-sm elevation-2 " style="opacity: .7;" onclick="window.location='route/<?php echo $data; ?>/index.php'"><i class="fa fa-plus";></i> Tambah</button> -->
                            <!--button sebelum tambah cari
                           <button class="btn btn-primary btn-sm elevation-2 " style="opacity: .7;" onclick="window.location='main.php?route=barang_tambah'"><i class="fa fa-plus" ;></i> Tambah</button>
                          <button class="btn btn-success btn-sm elevation-2 " style="opacity: .7;" onclick="window.location='../../data/pages/main.php?route=<?php echo $data2; ?>'"> <i class="fa-solid fa-file-excel"></i> Import</button> -->



                            <!--<a href="route/<?php echo $data; ?>/<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=tes">
                            <button class="btn btn-primary btn-sm elevation-2 float-right" style="opacity: .7;"><i class="fa-solid fa-gear""></i>  Generate Harga</button></a>
                            -->
                            <div style=" margin:10px">
                            </div>

                            <table id="examplebarang" class="table table-bordered table-striped">
                              <thead style="background-color:  lightgray;" class="elevation-2">
                                <tr>
                                  <th>No.</th>
                                  <th><?php echo $j1; ?></th>
                                  <th><?php echo $j2; ?></th>
                                  <?php if ($login_hash != 22 && $login_hash != 21) { ?>
                                    <th><?php echo $j3; ?></th>
                                  <?php } ?>
                                  <?php if ($login_hash != 21) { ?>

                                    <th><?php echo $j3; ?> Jual 1</th>
                                    <th><?php echo $j3; ?> Jual 2</th>
                                    <th><?php echo $j3; ?> Jual 3</th>
                                    <th><?php echo $j3; ?> Jual 4</th>
                                    <th><?php echo $j3; ?> Jual 5</th>
                                  <?php } ?>

                                  <th><?php echo $j4; ?> 1</th>
                                  <th><?php echo $j4; ?> 2</th>
                                  <th><?php echo $j4; ?> 3</th>
                                  <th><?php echo $j4; ?> 4</th>
                                  <th><?php echo $j4; ?> 5</th>
                                  <th><?php echo $j9; ?> 1</th>
                                  <th><?php echo $j9; ?> 2</th>
                                  <th><?php echo $j9; ?> 3</th>
                                  <th><?php echo $j9; ?> 4</th>
                                  <th><?php echo $j9; ?> 5</th>
                                  <!-- <th><?php echo $j3; ?> 1</th>
                                <th><?php echo $j3; ?> 2</th>
                                <th><?php echo $j3; ?> 3</th>
                                <th><?php echo $j3; ?> 4</th>
                                <th><?php echo $j3; ?> 5</th> -->
                                  <?php if ($login_hash != 22 && $login_hash != 21) { ?>
                                    <th>ID Kategori Nilai</th>
                                    <!-- <th><?php echo $j32; ?></th>
                                <th><?php echo $j33; ?></th>
                                <th><?php echo $j34; ?></th>
                                <th><?php echo $j35; ?></th>
                                <th><?php echo $j36; ?></th> -->
                                    <th><?php echo $j37; ?></th>
                                    <!-- <th>Photo</th> -->
                                    <th width="60px">Aksi</th>
                                  <?php } ?>

                                </tr>
                              </thead>
                              <tbody id="barangTableBodysearch">
                                <?php

                                $sql1 = mysqli_query($koneksi, "SELECT * from $tabel WHERE kd_subgrup is null order by $f1 asc ");

                                // $query="SELECT a.$f1,a.$f2,a.$f3,a.$f4,a.$f5,j.nama as nama_aplikasi
                                // from $tabel a
                                // join $tabel2 j on a.$f5=j.$ff1
                                // order by a.$f1 asc";

                                // $sql1=mysqli_query($koneksi,$query);
                                $no = 1;
                                while ($s1 = mysqli_fetch_array($sql1)) {
                                  // if ($s1[$f7] == "") {
                                  //   $datagambar = "images.jpeg";
                                  // } else {
                                  //   $datagambar = $s1[$f8];
                                  // }

                                ?>
                                  <tr align="left">
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $s1[$f1]; ?></td>
                                    <td><?php echo $s1[$f2]; ?></td>
                                    <?php if ($login_hash != 22 && $login_hash != 21) { ?>
                                      <td><?php echo format_rupiah($s1[$f3]); ?></td>
                                    <?php } ?>
                                    <?php if ($login_hash != 21) { ?>

                                      <td><?php echo format_rupiah($s1[$f_31]); ?></td>
                                      <td><?php echo format_rupiah($s1[$f_32]); ?></td>
                                      <td><?php echo format_rupiah($s1[$f_33]); ?></td>
                                      <td><?php echo format_rupiah($s1[$f_34]); ?></td>
                                      <td><?php echo format_rupiah($s1[$f_35]); ?></td>
                                    <?php } ?>

                                    <td><?php echo $s1[$f_41]; ?></td>
                                    <td><?php echo $s1[$f_42]; ?></td>
                                    <td><?php echo $s1[$f_43]; ?></td>
                                    <td><?php echo $s1[$f_44]; ?></td>
                                    <td><?php echo $s1[$f_45]; ?></td>
                                    <td><?php echo $s1[$f_91]; ?></td>
                                    <td><?php echo $s1[$f_92]; ?></td>
                                    <td><?php echo $s1[$f_93]; ?></td>
                                    <td><?php echo $s1[$f_94]; ?></td>
                                    <td><?php echo $s1[$f_95]; ?></td>
                                    <!-- <td style="text-align: right;"><?php echo format_rupiah($s1[$f_31]); ?></td>
                                  <td style="text-align: right;"><?php echo format_rupiah($s1[$f_32]); ?></td>
                                  <td style="text-align: right;"><?php echo format_rupiah($s1[$f_33]); ?></td>
                                  <td style="text-align: right;"><?php echo format_rupiah($s1[$f_34]); ?></td>
                                  <td style="text-align: right;"><?php echo format_rupiah($s1[$f_35]); ?></td> -->
                                    <?php if ($login_hash != 22 && $login_hash != 21) { ?>
                                      <td><?php echo ($s1[$f31] == "manual") ? "Tanpa Kategori" : $s1[$f31]; ?></td>
                                      <!-- <td><?php echo ($s1[$f32] == "manual") ? "Tanpa Kategori" : $s1[$f32]; ?></td>
                                  <td><?php echo ($s1[$f33] == "manual") ? "Tanpa Kategori" : $s1[$f33]; ?></td>
                                  <td><?php echo ($s1[$f34] == "manual") ? "Tanpa Kategori" : $s1[$f34]; ?></td>
                                  <td><?php echo ($s1[$f35] == "manual") ? "Tanpa Kategori" : $s1[$f35]; ?></td>
                                  <td><?php echo ($s1[$f36] == "manual") ? "Tanpa Kategori" : $s1[$f36]; ?></td> -->
                                      <td><?php echo $s1[$f37]; ?></td>



                                      <!-- <td style="text-align: center;"><img src="../../images/menu/<?php echo $datagambar; ?>" class="brand-image elevation-3" style="opacity: 1;width: 60px;"></td> -->

                                      <td style="display: flex; gap: 10px; align-items: center;">
                                        <a href=" main.php?route=<?php echo $rute; ?>&act=edit&id=<?php echo $s1[$f1]; ?>" title="Edit"> <button class="btn btn-primary btn-sm elevation-2" style="opacity: .7;width:80px"><i class="fa fa-edit"></i> Edit</button></a>
                                        <br />

                                        <!-- <a href="route/<?php echo $data; ?>/<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=hapus&id=<?php echo $s1[$f1]; ?>" title="Hapus" onclick="return confirm('Apakah anda yakin ingin menghapus ini ?')">
                                          <button class="btn btn-danger btn-sm elevation-2" style="opacity: .7;width:80px"><i class="fa fa-trash"></i> Hapus</button></a>
                                        <br /> -->
                                        <a href="route/<?php echo $data; ?>/<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=hide&id=<?php echo $s1[$f1]; ?>" title="Hide" onclick="return confirm('Barang yang di hide tidak dapat dilihat')">
                                          <button class="btn btn-danger btn-sm elevation-2" style="opacity: .7;width:80px"><i class="fa fa-trash"></i> Hide</button></a>
                                        <br />
                                        <button class="btn btn-secondary btn-sm elevation-2" style="opacity: .7; width: 80px;" onclick="printContent('<?php echo $s1[$f1]; ?>');">
                                          <i class="fa fa-print"></i> Print
                                        </button>
                                      <?php } ?>


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
      <div class="modal fade" id="cariKomponen" tabindex="-1" role="dialog" aria-labelledby="cariKomponenLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              Data Barang Hide
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closemodalkomponen">
                <span aria-hidden="true">&times;&nbsp; Close</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="d-flex align-items-center">
                <label for="cariKomponenmodalManual" class="form-label" style="font-weight: bold; font-size: 15px;">Cari Barang:<span style="margin-left: 5px;"></span></label>
                <input type="text" name="cariKomponenmodalManual" class="form-control" id="cariKomponenmodalManual" style="width: auto; height: 30px;  border: 1px solid #ced4da; border-radius: 4px;" placeholder="Masukkan nama barang..." />
              </div>
              <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" id="table-datatable-barangAssembly">
                  <thead>
                    <tr>
                      <th class="text-center">NO</th>
                      <th>KODE BARANG</th>
                      <th>NAMA BARANG</th>
                      <th>PILIH</th>
                    </tr>
                  </thead>
                  <tbody id="data-table-komponen">

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="cariLock" tabindex="-1" role="dialog" aria-labelledby="cariLockLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              Data Barang Lock
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closemodallockbarang">
                <span aria-hidden="true">&times;&nbsp; Close</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="d-flex align-items-center">
                <label for="cariLockmodalManual" class="form-label" style="font-weight: bold; font-size: 15px;">Cari Barang:<span style="margin-left: 5px;"></span></label>
                <input type="text" name="cariLockmodalManual" class="form-control" id="cariLockmodalManual" style="width: auto; height: 30px;  border: 1px solid #ced4da; border-radius: 4px;" placeholder="Masukkan nama barang..." />
              </div>
              <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" id="table-datatable-lockbarang">
                  <thead>
                    <tr>
                      <th class="text-center">NO</th>
                      <th>KODE BARANG</th>
                      <th>NAMA BARANG</th>
                      <th>LOKASI</th>
                    </tr>
                  </thead>
                  <tbody id="data-table-lock">

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> -->
      <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script> -->

      <script>
        $(document).on("input", "#cariKomponenmodalManual", function() {
          $.ajax({
            type: 'GET',
            url: 'route/data_barang/ajax_cariBarang.php?valuesUM=' + this.value,
            dataType: 'json',
            success: function(response) {
              const tableBody = $('#data-table-komponen');
              tableBody.empty();

              if (response.length === 0) {
                tableBody.append('<tr><td colspan="5" class="text-center">Tidak ADA DATA</td></tr>');
              } else {
                response.forEach(function(item) {
                  const row = `
                                    <tr>
                                        <td class="text-center">${item.no}</td>
                                        <td class="text-center">${item.kode_barang}</td>
                                        <td>${item.nama}</td>
                                        <td style="display: flex; gap: 10px; align-items: center;">
                                            <a href="route/data_barang/aksi_barang.php?route=barang&act=undo_hide&id=${item.kode_barang}" 
                                              title="Undo_Hide" 
                                              onclick="return confirm('Barang yang di undo hide akan dapat dilihat')">
                                                <button class="btn btn-danger btn-sm elevation-2" style="opacity: .7; width: 80px;">
                                                    <i class="fa fa-trash"></i> Undo Hide
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                    `;
                  tableBody.append(row);
                });
              }
            },
            error: function(xhr, status, error) {
              console.log(xhr.responseText);
            }
          });
        });
        $(document).on("click", "#cariTableKomponen", function() {
          document.getElementById('cariKomponenmodalManual').value = '';
          $.ajax({
            type: 'GET',
            url: 'route/data_barang/ajax_cariBarang.php?',
            dataType: 'json',
            success: function(response) {
              const tableBody = $('#data-table-komponen');
              tableBody.empty();

              if (response.length === 0) {
                tableBody.append('<tr><td colspan="5" class="text-center">Tidak ADA DATA</td></tr>');
              } else {
                response.forEach(function(item) {
                  const row = `
                                    <tr>
                                        <td class="text-center">${item.no}</td>
                                        <td class="text-center">${item.kode_barang}</td>
                                        <td>${item.nama}</td>
                                        <td style="display: flex; gap: 10px; align-items: center;">
                                            <a href="route/data_barang/aksi_barang.php?route=barang&act=undo_hide&id=${item.kode_barang}" 
                                              title="Undo_Hide" 
                                              onclick="return confirm('Barang yang di undo hide akan dapat dilihat')">
                                                <button class="btn btn-danger btn-sm elevation-2" style="opacity: .7; width: 80px;">
                                                    <i class="fa fa-trash"></i> Undo Hide
                                                </button>
                                            </a>
                                        </td>
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
        $(document).on("input", "#cariLockmodalManual", function() {
          $.ajax({
            type: 'GET',
            url: 'route/data_barang/ajax_cariBarang_lock.php?valuesUM=' + this.value,
            dataType: 'json',
            success: function(response) {
              const tableBody = $('#data-table-lock');
              tableBody.empty();

              if (response.length === 0) {
                tableBody.append('<tr><td colspan="5" class="text-center">Tidak ADA DATA</td></tr>');
              } else {
                response.forEach(function(item) {
                  const row = `
                                    <tr>
                                        <td class="text-center">${item.no}</td>
                                        <td class="text-center">${item.kode_barang}</td>
                                        <td>${item.nama}</td>
                                        <td class="text-center">${item.keterangan}</td>
                                    </tr>
                                    `;
                  tableBody.append(row);
                });
              }
            },
            error: function(xhr, status, error) {
              console.log(xhr.responseText);
            }
          });
        });
        $(document).on("click", "#cariTableLockBarang", function() {
          document.getElementById('cariLockmodalManual').value = '';
          $.ajax({
            type: 'GET',
            url: 'route/data_barang/ajax_cariBarang_lock.php?',
            dataType: 'json',
            success: function(response) {
              const tableBody = $('#data-table-lock');
              tableBody.empty();

              if (response.length === 0) {
                tableBody.append('<tr><td colspan="5" class="text-center">Tidak ADA DATA</td></tr>');
              } else {
                response.forEach(function(item) {
                  const row = `
                                    <tr>
                                        <td class="text-center">${item.no}</td>
                                        <td class="text-center">${item.kode_barang}</td>
                                        <td>${item.nama}</td>
                                        <td class="text-center">${item.keterangan}</td>
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
        $(document).on("input", "#cariBarangManual", function() {
          var searchValue = $(this).val();
          $.ajax({
            type: 'GET',
            url: 'route/data_barang/searchTableBarang.php',
            data: {
              value: searchValue
            }, // jQuery encodes & automatically
            dataType: 'json',
            success: function(response) {
              tablebaranguntuksearch.clear().draw();
              $("#barangTableBodysearch").empty();

              if (response.length > 0) {
                <?php if ($login_hash == 22) { ?>
                  if (response.length == 1) {
                    $('#dynamicModalLabel').text(response[0].f2);
                    $("#searchhasil_barang_barangTableBodysearch").empty();

                    const newRow1 = `
                    <tr>
                      <td>${response[0].f_91} (${response[0].f_41})</td>
                      <td>${response[0].f_31}</td>
                    </tr>
                    `;
                    $("#searchhasil_barang_barangTableBodysearch").append(newRow1);
                    if (response[0].f_42 !== undefined && response[0].f_42 !== null && response[0].f_42 !== '') {
                      const newRow2 = `
                    <tr>
                      <td>${response[0].f_92} (${response[0].f_42})</td>
                      <td>${response[0].f_32}</td>
                    </tr>
                    `;
                      $("#searchhasil_barang_barangTableBodysearch").append(newRow2);
                    }
                    if (response[0].f_43 !== undefined && response[0].f_43 !== null && response[0].f_43 !== '') {
                      const newRow3 = `
                    <tr>
                      <td>${response[0].f_93} (${response[0].f_43})</td>
                      <td>${response[0].f_33}</td>
                    </tr>
                    `;
                      $("#searchhasil_barang_barangTableBodysearch").append(newRow3);
                    }
                    if (response[0].f_44 !== undefined && response[0].f_44 !== null && response[0].f_44 !== '') {
                      const newRow4 = `
                    <tr>
                      <td>${response[0].f_94} (${response[0].f_44})</td>
                      <td>${response[0].f_34}</td>
                    </tr>
                    `;
                      $("#searchhasil_barang_barangTableBodysearch").append(newRow4);
                    }
                    if (response[0].f_45 !== undefined && response[0].f_45 !== null && response[0].f_45 !== '') {
                      const newRow5 = `
                    <tr>
                      <td>${response[0].f_95} (${response[0].f_45})</td>
                      <td>${response[0].f_35}</td>
                    </tr>
                    `;
                      $("#searchhasil_barang_barangTableBodysearch").append(newRow5);
                    }
                    $('#dynamicModal').modal('show');
                  }
                <?php } ?>
                $.each(response, function(index, item) {
                  // <div style="margin: 10px"></div>
                  // <a href="main.php?route=barang&act=edit&id=${item.f1}" title="Edit">
                  //                   <button class="btn btn-primary btn-sm elevation-2" style="opacity: .7;width:80px"><i class="fa fa-edit"></i> Edit</button>
                  //               </a>
                  //               <br />

                  //               <a href="route/data_barang/aksi_barang.php?route=barang&act=hapus&id=${item.f1}" title="Hapus" onclick="return confirm('Apakah anda yakin ingin menghapus ini ?')">
                  //                     <button class="btn btn-danger btn-sm elevation-2" style="opacity: .7;width:80px"><i class="fa fa-trash"></i> Hapus</button></a>
                  //               <br />
                  const newRow = `
                        <tr align="left">
                            <td>${index + 1}</td>
                            <td>${item.f1}</td>
                            <td>${item.f2}</td>
                            <?php if ($login_hash != 22 && $login_hash != 21) { ?>
                            <td>${item.f3}</td>
                            <?php } ?>
                            <?php if ($login_hash != 21) { ?>
                            <td>${item.f_31}</td>
                            <td>${item.f_32}</td>
                            <td>${item.f_33}</td>
                            <td>${item.f_34}</td>
                            <td>${item.f_35}</td>
                            <?php } ?>
                            <td>${item.f_41}</td>
                            <td>${item.f_42}</td>
                            <td>${item.f_43}</td>
                            <td>${item.f_44}</td>
                            <td>${item.f_45}</td>
                            <td>${item.f_91}</td>
                            <td>${item.f_92}</td>
                            <td>${item.f_93}</td>
                            <td>${item.f_94}</td>
                            <td>${item.f_95}</td>
                             <?php if ($login_hash != 22 && $login_hash != 21) { ?>
                            <td>${item.f31 === "manual" ? "Tanpa Kategori" : item.f31}</td>
                            <td>${item.f37}</td>
                            <td style="display: flex; gap: 10px; align-items: center;">
                                <a href="main.php?route=barang&act=edit&id=${item.f1}" title="Edit">
                                    <button class="btn btn-primary btn-sm elevation-2" style="opacity: .7;width:80px"><i class="fa fa-edit"></i> Edit</button>
                                </a>
                                <br />
                                <a href="route/data_barang/aksi_barang.php?route=barang&act=hide&id=${item.f1}" title="Hide" onclick="return confirm('Barang yang di hide tidak dapat dilihat')">
                                      <button class="btn btn-danger btn-sm elevation-2" style="opacity: .7;width:80px"><i class="fa fa-trash"></i> Hide</button></a>
                                <br />
                                <button class="btn btn-secondary btn-sm elevation-2" style="opacity: .7; width: 80px;" onclick="printContent('${item.f1}');">
                                      <i class="fa fa-print"></i> Print
                                </button>
                            </td>
                              <?php } ?>

                        </tr>
                    `;
                  $("#barangTableBodysearch").append(newRow);
                });
                // <a href="route/data_barang/aksi_barang.php?route=barang&act=hapus&id=${item.f1}" title="Hapus" onclick="return confirm('Apakah anda yakin ingin menghapus ini ?')">
                //                     <button class="btn btn-danger btn-sm elevation-2" style="opacity: .7;width:80px"><i class="fa fa-trash"></i> Hapus</button>
                //                 </a>
                //                 <br />

                // Add the new data to the DataTable
                tablebaranguntuksearch.rows.add($("#barangTableBodysearch tr")).draw();
              } else {
                // Optional: handle case when no results found
                const newRow = `
                        <tr align="middle">
                            <td colspan="40">"Tidak ada Data"</td>
                        </tr>
                    `;
                $("#barangTableBodysearch").append(newRow);
                tablebaranguntuksearch.rows.add($("#barangTableBodysearch tr")).draw();

              }
            },
            error: function(xhr, status, error) {
              console.log(xhr.responseText);
            }
          });
        });
        $(document).on("input", "#cariBarangBarcode", function() {
          var searchValue = $(this).val();


          $.ajax({
            type: 'GET',
            url: 'route/data_barang/searchTableBarangBarcode.php?value=' + searchValue,
            dataType: 'json',
            success: function(response) {
              tablebaranguntuksearch.clear().draw();
              $("#barangTableBodysearch").empty();

              if (response.length > 0) {
                $.each(response, function(index, item) {
                  const newRow = `
                        <tr align="left">
                            <td>${index + 1}</td>
                            <td>${item.f1}</td>
                            <td>${item.f2}</td>
                            <?php if ($login_hash != 22) { ?>
                            <td>${item.f3}</td>
                            <?php } ?>
                            <td>${item.f_31}</td>
                            <td>${item.f_32}</td>
                            <td>${item.f_33}</td>
                            <td>${item.f_34}</td>
                            <td>${item.f_35}</td>
                            <td>${item.f_41}</td>
                            <td>${item.f_42}</td>
                            <td>${item.f_43}</td>
                            <td>${item.f_44}</td>
                            <td>${item.f_45}</td>
                            <td>${item.f_91}</td>
                            <td>${item.f_92}</td>
                            <td>${item.f_93}</td>
                            <td>${item.f_94}</td>
                            <td>${item.f_95}</td>
                             <?php if ($login_hash != 22) { ?>
                            <td>${item.f31 === "manual" ? "Tanpa Kategori" : item.f31}</td>
                            <td>${item.f37}</td>
                            <td style="display: flex; gap: 10px; align-items: center;">
                                <div style="margin: 10px"></div>
                                <a href="main.php?route=barang&act=edit&id=${item.f1}" title="Edit">
                                    <button class="btn btn-primary btn-sm elevation-2" style="opacity: .7;width:80px"><i class="fa fa-edit"></i> Edit</button>
                                </a>
                                <br />
                                <button class="btn btn-secondary btn-sm elevation-2" style="opacity: .7; width: 80px;" onclick="printContent('${item.f1}');">
                                      <i class="fa fa-print"></i> Print
                                </button>
                            </td>
                              <?php } ?>

                        </tr>
                    `;
                  $("#barangTableBodysearch").append(newRow);
                });

                // Add the new data to the DataTable
                tablebaranguntuksearch.rows.add($("#barangTableBodysearch tr")).draw();
              } else {
                // Optional: handle case when no results found
                const newRow = `
                        <tr align="middle">
                            <td colspan="40">"Tidak ada Data"</td>
                        </tr>
                    `;
                $("#barangTableBodysearch").append(newRow);
                tablebaranguntuksearch.rows.add($("#barangTableBodysearch tr")).draw();

              }
            },
            error: function(xhr, status, error) {
              console.log(xhr.responseText);
            }
          });
        });
        document.querySelector('#toExcel').addEventListener('click', () => {
          fetch('route/data_barang/get_table.php')
            .then(response => response.text())
            .then(html => {
              let tempDiv = document.createElement('div');
              tempDiv.innerHTML = html;
              let table = tempDiv.querySelector('table');
              TableToExcel.convert(table, {
                name: "ExportedTable.xlsx",
                sheet: {
                  name: "Sheet1"
                }
              });
              tempDiv.remove();
            })
            .catch(error => {
              console.error('Error fetching table data:', error);
            });
        });
        document.querySelector('#barangtoExcel').addEventListener('click', () => {
          // Show full-page loading spinner
          document.querySelector('#loadingSpinner').style.display = 'flex';

          fetch('route/data_barang/get_alltable.php')
            .then(response => {
              if (!response.ok) throw new Error('Network response was not ok');
              return response.text();
            })
            .then(html => {
              let tempDiv = document.createElement('div');
              tempDiv.innerHTML = html;
              let table = tempDiv.querySelector('table');
              if (!table) {
                throw new Error('No table found in the response');
              }

              // Export table to Excel
              TableToExcel.convert(table, {
                name: "ExportedTable.xlsx",
                sheet: {
                  name: "Sheet1"
                }
              });

              // Remove the temporary div and hide the loading spinner
              tempDiv.remove();
              document.querySelector('#loadingSpinner').style.display = 'none';
            })
            .catch(error => {
              console.error('Error:', error);
              alert('Failed to export the table. Please try again.');

              // Hide loading spinner on error
              document.querySelector('#loadingSpinner').style.display = 'none';
            });
        });
        document.getElementById("barangsage").addEventListener("click", function() {
          // This will open the PHP file that generates the Excel file
          window.location.href = "route/data_barang/export_barang_sage.php";
        });


        function printContent(id) {
          if (confirm("Apakah Barang Mempunyai Exp Date ?")) {
            const keteranganDate = prompt("Masukan Exp Date");

            // Debug: Log what user entered
            console.log("User entered:", keteranganDate);
            console.log("Type:", typeof keteranganDate);
            console.log("Length:", keteranganDate ? keteranganDate.length : 0);

            if (keteranganDate !== null && keteranganDate.trim() !== "") {
              console.log("Validation passed, opening print window...");

              // Open a new window for the print page
              const encodedDate = encodeURIComponent(keteranganDate); // this will make 12-12-2025 → 12-12-2025 (hyphens are safe)
              const url = `main.php?route=<?php echo $rute; ?>&act=print&id=${id}&exp_date=${encodedDate}`;

              const printWindow = window.open(url, '_blank');

              printWindow.addEventListener('load', function() {
                printWindow.print();
                printWindow.onafterprint = function() {
                  printWindow.close();
                };
              });
            } else {
              console.log("Validation failed");
              alert("Exp Date Wajib Diisi.");
            }
          } else {
            // Open a new window for the print page
            const printWindow = window.open(`main.php?route=<?php echo $rute; ?>&act=print&id=${id}`, '_blank');

            // Wait for the new window to load fully before printing
            printWindow.addEventListener('load', function() {
              printWindow.print();
              printWindow.onafterprint = function() {
                printWindow.close(); // Close the print window after printing
              };
            });

          }

        }
      </script>
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

      // $sql=mysqli_query($koneksi,"SELECT * from $tabel2 where $ff1='$e[$f5]'");
      // $s1=mysqli_fetch_array($sql);

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

                        <form method="POST" action="route/<?php echo $data; ?>/<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=edit&id=<?php echo $e['kd_subgrup']; ?>" enctype="multipart/form-data">

                          <section class="base">

                            <div class="row">
                              <!-- Kolom Pertama -->
                              <div class="col-md-3">
                                <div class="form-group">
                                  <label><?php echo $j1; ?></label>
                                  <div class="input-group">
                                    <input type="text" name="<?php echo $f1; ?>" id="field_<?php echo $f1; ?>" class="form-control" value="<?php echo $e[$f1]; ?>" readonly />
                                    <div class="input-group-append">
                                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal_<?php echo $f1; ?>">
                                        <i class="fa fa-edit"></i> Edit
                                      </button>
                                    </div>
                                  </div>
                                </div>
                              </div>

                              <div class="col-md-3">
                                <div class="form-group">
                                  <label><?php echo $j2; ?></label>
                                  <input type="text" name="<?php echo $f2; ?>" class="form-control" value="<?php echo $e[$f2]; ?>" />
                                </div>
                              </div>

                              <div class="col-md-3">
                                <div class="form-group">
                                  <label><?php echo $j3; ?></label>
                                  <input type="text" name="<?php echo $f3; ?>" class="form-control" value="<?php echo $e[$f3]; ?>" />
                                </div>
                              </div>
                              <!-- Kolom Kedua -->
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label><?php echo $j4; ?></label>
                                  <input id="satuansemua1" type="text" name="<?php echo $f4; ?>" class="form-control" value="<?php echo $e[$f4]; ?>" readonly />
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label><?php echo $j9; ?></label>
                                  <input type="text" name="<?php echo $f_91; ?>" class="form-control" value="<?php echo $e[$f_91]; ?>" readonly />
                                </div>
                              </div>


                              <div class="col-md-6">
                                <div class="form-group">
                                  <label><?php echo $j4; ?></label>
                                  <input id="satuansemua2" type="text" name="<?php echo $f_42; ?>" class="form-control" value="<?php echo $e[$f_42]; ?>" <?php if (!empty($e[$f_42])) echo 'readonly'; ?> />
                                </div>
                              </div>

                              <div class="col-md-6">
                                <div class="form-group">
                                  <label><?php echo $j9; ?></label>
                                  <input type="text" name="<?php echo $f_92; ?>" class="form-control" value="<?php echo $e[$f_92]; ?>" <?php if (!empty($e[$f_92])) echo 'readonly'; ?> />
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label><?php echo $j4; ?></label>
                                  <input id="satuansemua3" type="text" name="<?php echo $f_43; ?>" class="form-control" value="<?php echo $e[$f_43]; ?>" <?php if (!empty($e[$f_43])) echo 'readonly'; ?> />
                                </div>
                              </div>

                              <div class="col-md-6">
                                <div class="form-group">
                                  <label><?php echo $j9; ?></label>
                                  <input type="text" name="<?php echo $f_93; ?>" class="form-control" value="<?php echo $e[$f_93]; ?>" <?php if (!empty($e[$f_93])) echo 'readonly'; ?> />
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label><?php echo $j4; ?></label>
                                  <input id="satuansemua4" type="text" name="<?php echo $f_44; ?>" class="form-control" value="<?php echo $e[$f_44]; ?>" <?php if (!empty($e[$f_44])) echo 'readonly'; ?> />
                                </div>
                              </div>

                              <div class="col-md-6">
                                <div class="form-group">
                                  <label><?php echo $j9; ?></label>
                                  <input type="text" name="<?php echo $f_94; ?>" class="form-control" value="<?php echo $e[$f_94]; ?>" <?php if (!empty($e[$f_94])) echo 'readonly'; ?> />
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label><?php echo $j4; ?></label>
                                  <input id="satuansemua5" type="text" name="<?php echo $f_45; ?>" class="form-control" value="<?php echo $e[$f_45]; ?>" <?php if (!empty($e[$f_45])) echo 'readonly'; ?> />
                                </div>
                              </div>

                              <div class="col-md-6">
                                <div class="form-group">
                                  <label><?php echo $j9; ?></label>
                                  <input type="text" name="<?php echo $f_95; ?>" class="form-control" value="<?php echo $e[$f_95]; ?>" <?php if (!empty($e[$f_95])) echo 'readonly'; ?> />
                                </div>
                              </div>
                              <?php
                              $values = [$e[$f31], $e[$f32], $e[$f33], $e[$f34], $e[$f35], $e[$f36]];
                              if (count(array_unique($values)) === 1 && $values[0] != "manual") {
                              ?>
                                <div class="col-md-2">
                                  <input type="radio" name="tab" value="lock" onclick="lock();" checked style="transform: scale(1.5); margin-right: 10px;" />
                                  <span style="font-weight: bold; font-size: 16px; margin-right: 20px;">Lock</span>
                                  <br>
                                  <input type="radio" name="tab" value="unlock" onclick="unlock();" style="transform: scale(1.5); margin-right: 10px;" />
                                  <span style="font-weight: bold; font-size: 16px;">Unlock</span>
                                </div>
                              <?php } else { ?>
                                <div class="col-md-2">
                                  <input type="radio" name="tab" value="lock" onclick="lock();" style="transform: scale(1.5); margin-right: 10px;" />
                                  <span style="font-weight: bold; font-size: 16px; margin-right: 20px;">Lock</span>
                                  <br>
                                  <input type="radio" name="tab" value="unlock" onclick="unlock();" checked style="transform: scale(1.5); margin-right: 10px;" />
                                  <span style="font-weight: bold; font-size: 16px;">Unlock</span>
                                </div>
                              <?php } ?>

                              <div class="col-md-5" id="kategoriharga">
                                <div class="form-group">
                                  <label for="ktg_harga">ID Kategori Harga</label>
                                  <select id="ktg_harga" name="ktg_harga" class="form-control">
                                    <option value="<?php echo $e[$f31]; ?>"> <?php echo ($e[$f31] == "manual") ? "Tanpa Kategori" : $e[$f31]; ?></option>
                                    <?php
                                    $query = mysqli_query($koneksi, "SELECT Nama_kategoriNilai FROM kategori_nilai WHERE id_kat = 1 GROUP BY Nama_kategoriNilai");
                                    while ($j = mysqli_fetch_array($query)) {
                                      $kategorigroip = $j["Nama_kategoriNilai"];

                                    ?>
                                      <option value="<?php echo $kategorigroip; ?>"><?php echo $kategorigroip; ?></option>
                                    <?php } ?>
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-4"></div>
                              <div id="divkategori" style="display: none;" class="col-md-12">
                                <hr>
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label for="<?php echo $f31; ?>"><?php echo $j31; ?> </label>
                                    <select id="<?php echo $f31; ?>" name="<?php echo $f31; ?>" class="form-control">
                                      <option value="<?php echo $e[$f31]; ?>"> <?php echo ($e[$f31] == "manual") ? "Tanpa Kategori" : $e[$f31]; ?></option>
                                      <?php
                                      $query = mysqli_query($koneksi, "SELECT Nama_kategoriNilai FROM kategori_nilai WHERE id_kat = 1 GROUP BY Nama_kategoriNilai ");
                                      while ($j = mysqli_fetch_array($query)) {
                                        $kategorigroip = $j["Nama_kategoriNilai"];
                                      ?>
                                        <option value="<?php echo $kategorigroip; ?>"><?php echo $kategorigroip; ?></option>
                                      <?php } ?>
                                      <option value="manual">Tanpa Kategori</option>
                                    </select>
                                  </div>
                                </div>
                                <div id="retailharga">
                                  <div class="col-md-3" style="float: left;">
                                    <div class="form-group">
                                      <label><?php echo $j4; ?></label>
                                      <input id="satuanretail1" type="text" name="satuanretail1" class="form-control" readonly />
                                    </div>
                                  </div>
                                  <div class="col-md-3" style="float: left;">
                                    <div class="form-group">
                                      <label><?php echo $j3; ?></label>
                                      <input type="text" name="<?php echo $f_31; ?>" class="form-control" value="<?php echo $e[$f_31]; ?>" />
                                    </div>
                                  </div>
                                  <div style="clear: both;"></div>

                                  <div class="col-md-3" style="float: left;">
                                    <div class="form-group">
                                      <label><?php echo $j4; ?></label>
                                      <input id="satuanretail2" type="text" name="satuanretail2" class="form-control" readonly />
                                    </div>
                                  </div>

                                  <div class="col-md-3" style="float: left;">
                                    <div class="form-group">
                                      <label><?php echo $j3; ?></label>
                                      <input type="text" name="<?php echo $f_32; ?>" class="form-control" value="<?php echo $e[$f_32]; ?>" />
                                    </div>
                                  </div>
                                  <div style="clear: both;"></div>

                                  <div class="col-md-3" style="float: left;">
                                    <div class="form-group">
                                      <label><?php echo $j4; ?></label>
                                      <input id="satuanretail3" type="text" name="satuanretail3" class="form-control" readonly />
                                    </div>
                                  </div>

                                  <div class="col-md-3" style="float: left;">
                                    <div class="form-group">
                                      <label><?php echo $j3; ?></label>
                                      <input type="text" name="<?php echo $f_33; ?>" class="form-control" value="<?php echo $e[$f_33]; ?>" />
                                    </div>
                                  </div>
                                  <div style="clear: both;"></div>

                                  <div class="col-md-3" style="float: left;">
                                    <div class="form-group">
                                      <label><?php echo $j4; ?></label>
                                      <input id="satuanretail4" type="text" name="satuanretail4" class="form-control" readonly />
                                    </div>
                                  </div>

                                  <div class="col-md-3" style="float: left;">
                                    <div class="form-group">
                                      <label><?php echo $j3; ?></label>
                                      <input type="text" name="<?php echo $f_34; ?>" class="form-control" value="<?php echo $e[$f_34]; ?>" />
                                    </div>
                                  </div>
                                  <div style="clear: both;"></div>

                                  <div class="col-md-3" style="float: left;">
                                    <div class="form-group">
                                      <label><?php echo $j4; ?></label>
                                      <input id="satuanretail5" type="text" name="satuanretail5" class="form-control" readonly />
                                    </div>
                                  </div>

                                  <div class="col-md-3" style="float: left;">
                                    <div class="form-group">
                                      <label><?php echo $j3; ?></label>
                                      <input type="text" name="<?php echo $f_35; ?>" class="form-control" value="<?php echo $e[$f_35]; ?>" />
                                    </div>
                                  </div>
                                </div>
                                <div style="clear: both;"></div>

                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label for="<?php echo $f32; ?>"><?php echo $j32; ?> </label>
                                    <select id="<?php echo $f32; ?>" name="<?php echo $f32; ?>" class="form-control">
                                      <option value="<?php echo $e[$f32]; ?>"><?php echo ($e[$f32] == "manual") ? "Tanpa Kategori" : $e[$f32]; ?></option>
                                      <?php
                                      $query = mysqli_query($koneksi, "SELECT Nama_kategoriNilai FROM kategori_nilai WHERE id_kat = 2 GROUP BY Nama_kategoriNilai ");
                                      while ($j = mysqli_fetch_array($query)) {
                                        $kategorigroip = $j["Nama_kategoriNilai"];
                                      ?>
                                        <option value="<?php echo $kategorigroip; ?>"><?php echo $kategorigroip; ?></option>
                                      <?php } ?>
                                      <option value="manual">Tanpa Kategori</option>
                                    </select>
                                  </div>
                                </div>
                                <div id="grosirharga">
                                  <div class="col-md-3" style="float: left;">
                                    <div class="form-group">
                                      <label><?php echo $j4; ?></label>
                                      <input id="satuangrosir1" type="text" name="satuangrosir1" class="form-control" readonly />
                                    </div>
                                  </div>
                                  <div class="col-md-3" style="float: left;">
                                    <div class="form-group">
                                      <label><?php echo $j3; ?></label>
                                      <input type="text" name="<?php echo $f_31gr; ?>" class="form-control" value="<?php echo $e[$f_31gr]; ?>" />
                                    </div>
                                  </div>
                                  <div style="clear: both;"></div>

                                  <div class="col-md-3" style="float: left;">
                                    <div class="form-group">
                                      <label><?php echo $j4; ?></label>
                                      <input id="satuangrosir2" type="text" name="satuangrosir2" class="form-control" readonly />
                                    </div>
                                  </div>

                                  <div class="col-md-3" style="float: left;">
                                    <div class="form-group">
                                      <label><?php echo $j3; ?></label>
                                      <input type="text" name="<?php echo $f_32gr; ?>" class="form-control" value="<?php echo $e[$f_32gr]; ?>" />
                                    </div>
                                  </div>
                                  <div style="clear: both;"></div>

                                  <div class="col-md-3" style="float: left;">
                                    <div class="form-group">
                                      <label><?php echo $j4; ?></label>
                                      <input id="satuangrosir3" type="text" name="satuangrosir3" class="form-control" readonly />
                                    </div>
                                  </div>

                                  <div class="col-md-3" style="float: left;">
                                    <div class="form-group">
                                      <label><?php echo $j3; ?></label>
                                      <input type="text" name="<?php echo $f_33gr; ?>" class="form-control" value="<?php echo $e[$f_33gr]; ?>" />
                                    </div>
                                  </div>
                                  <div style="clear: both;"></div>

                                  <div class="col-md-3" style="float: left;">
                                    <div class="form-group">
                                      <label><?php echo $j4; ?></label>
                                      <input id="satuangrosir4" type="text" name="satuangrosir4" class="form-control" readonly />
                                    </div>
                                  </div>

                                  <div class="col-md-3" style="float: left;">
                                    <div class="form-group">
                                      <label><?php echo $j3; ?></label>
                                      <input type="text" name="<?php echo $f_34gr; ?>" class="form-control" value="<?php echo $e[$f_34gr]; ?>" />
                                    </div>
                                  </div>
                                  <div style="clear: both;"></div>

                                  <div class="col-md-3" style="float: left;">
                                    <div class="form-group">
                                      <label><?php echo $j4; ?></label>
                                      <input id="satuangrosir5" type="text" name="satuangrosir5" class="form-control" readonly />
                                    </div>
                                  </div>

                                  <div class="col-md-3" style="float: left;">
                                    <div class="form-group">
                                      <label><?php echo $j3; ?></label>
                                      <input type="text" name="<?php echo $f_35gr; ?>" class="form-control" value="<?php echo $e[$f_35gr]; ?>" />
                                    </div>
                                  </div>
                                </div>
                                <div style="clear: both;"></div>

                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label for="<?php echo $f33; ?>"><?php echo $j33; ?> </label>
                                    <select id="<?php echo $f33; ?>" name="<?php echo $f33; ?>" class="form-control">
                                      <option value="<?php echo $e[$f33]; ?>"><?php echo ($e[$f33] == "manual") ? "Tanpa Kategori" : $e[$f33]; ?></option>
                                      <?php
                                      $query = mysqli_query($koneksi, "SELECT Nama_kategoriNilai FROM kategori_nilai WHERE id_kat = 3 GROUP BY Nama_kategoriNilai ");
                                      while ($j = mysqli_fetch_array($query)) {
                                        $kategorigroip = $j["Nama_kategoriNilai"];

                                      ?>
                                        <option value="<?php echo $kategorigroip; ?>"><?php echo $kategorigroip; ?></option>
                                      <?php } ?>
                                      <option value="manual">Tanpa Kategori</option>
                                    </select>
                                  </div>
                                </div>
                                <div id="onlineharga">
                                  <div class="col-md-3" style="float: left;">
                                    <div class="form-group">
                                      <label><?php echo $j4; ?></label>
                                      <input id="satuanonline1" type="text" name="satuanonline1" class="form-control" readonly />
                                    </div>
                                  </div>
                                  <div class="col-md-3" style="float: left;">
                                    <div class="form-group">
                                      <label><?php echo $j3; ?></label>
                                      <input type="text" name="<?php echo $f_31ol; ?>" class="form-control" value="<?php echo $e[$f_31ol]; ?>" />
                                    </div>
                                  </div>
                                  <div style="clear: both;"></div>

                                  <div class="col-md-3" style="float: left;">
                                    <div class="form-group">
                                      <label><?php echo $j4; ?></label>
                                      <input id="satuanonline2" type="text" name="satuanonline2" class="form-control" readonly />
                                    </div>
                                  </div>

                                  <div class="col-md-3" style="float: left;">
                                    <div class="form-group">
                                      <label><?php echo $j3; ?></label>
                                      <input type="text" name="<?php echo $f_32ol; ?>" class="form-control" value="<?php echo $e[$f_32ol]; ?>" />
                                    </div>
                                  </div>
                                  <div style="clear: both;"></div>

                                  <div class="col-md-3" style="float: left;">
                                    <div class="form-group">
                                      <label><?php echo $j4; ?></label>
                                      <input id="satuanonline3" type="text" name="satuanonline3" class="form-control" readonly />
                                    </div>
                                  </div>

                                  <div class="col-md-3" style="float: left;">
                                    <div class="form-group">
                                      <label><?php echo $j3; ?></label>
                                      <input type="text" name="<?php echo $f_33ol; ?>" class="form-control" value="<?php echo $e[$f_33ol]; ?>" />
                                    </div>
                                  </div>
                                  <div style="clear: both;"></div>

                                  <div class="col-md-3" style="float: left;">
                                    <div class="form-group">
                                      <label><?php echo $j4; ?></label>
                                      <input id="satuanonline4" type="text" name="satuanonline4" class="form-control" readonly />
                                    </div>
                                  </div>

                                  <div class="col-md-3" style="float: left;">
                                    <div class="form-group">
                                      <label><?php echo $j3; ?></label>
                                      <input type="text" name="<?php echo $f_34ol; ?>" class="form-control" value="<?php echo $e[$f_34ol]; ?>" />
                                    </div>
                                  </div>
                                  <div style="clear: both;"></div>

                                  <div class="col-md-3" style="float: left;">
                                    <div class="form-group">
                                      <label><?php echo $j4; ?></label>
                                      <input id="satuanonline5" type="text" name="satuanonline5" class="form-control" readonly />
                                    </div>
                                  </div>

                                  <div class="col-md-3" style="float: left;">
                                    <div class="form-group">
                                      <label><?php echo $j3; ?></label>
                                      <input type="text" name="<?php echo $f_35ol; ?>" class="form-control" value="<?php echo $e[$f_35ol]; ?>" />
                                    </div>
                                  </div>
                                </div>
                                <div style="clear: both;"></div>

                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label for="<?php echo $f34; ?>"><?php echo $j34; ?> </label>
                                    <select id="<?php echo $f34; ?>" name="<?php echo $f34; ?>" class="form-control">
                                      <option value="<?php echo $e[$f34]; ?>"><?php echo ($e[$f34] == "manual") ? "Tanpa Kategori" : $e[$f34]; ?></option>

                                      <?php
                                      $query = mysqli_query($koneksi, "SELECT Nama_kategoriNilai FROM kategori_nilai WHERE id_kat = 4 GROUP BY Nama_kategoriNilai ");
                                      while ($j = mysqli_fetch_array($query)) {
                                        $kategorigroip = $j["Nama_kategoriNilai"];

                                      ?>
                                        <option value="<?php echo $kategorigroip; ?>"><?php echo $kategorigroip; ?></option>
                                      <?php } ?>
                                      <option value="manual">Tanpa Kategori</option>
                                    </select>
                                  </div>
                                </div>
                                <div id="msharga">
                                  <div class="col-md-3" style="float: left;">
                                    <div class="form-group">
                                      <label><?php echo $j4; ?></label>
                                      <input id="satuanms1" type="text" name="satuanms1" class="form-control" readonly />
                                    </div>
                                  </div>
                                  <div class="col-md-3" style="float: left;">
                                    <div class="form-group">
                                      <label><?php echo $j3; ?></label>
                                      <input type="text" name="<?php echo $f_31ms; ?>" class="form-control" value="<?php echo $e[$f_31ms]; ?>" />
                                    </div>
                                  </div>
                                  <div style="clear: both;"></div>

                                  <div class="col-md-3" style="float: left;">
                                    <div class="form-group">
                                      <label><?php echo $j4; ?></label>
                                      <input id="satuanms2" type="text" name="satuanms2" class="form-control" readonly />
                                    </div>
                                  </div>

                                  <div class="col-md-3" style="float: left;">
                                    <div class="form-group">
                                      <label><?php echo $j3; ?></label>
                                      <input type="text" name="<?php echo $f_32ms; ?>" class="form-control" value="<?php echo $e[$f_32ms]; ?>" />
                                    </div>
                                  </div>
                                  <div style="clear: both;"></div>

                                  <div class="col-md-3" style="float: left;">
                                    <div class="form-group">
                                      <label><?php echo $j4; ?></label>
                                      <input id="satuanms3" type="text" name="satuanms3" class="form-control" readonly />
                                    </div>
                                  </div>

                                  <div class="col-md-3" style="float: left;">
                                    <div class="form-group">
                                      <label><?php echo $j3; ?></label>
                                      <input type="text" name="<?php echo $f_33ms; ?>" class="form-control" value="<?php echo $e[$f_33ms]; ?>" />
                                    </div>
                                  </div>
                                  <div style="clear: both;"></div>

                                  <div class="col-md-3" style="float: left;">
                                    <div class="form-group">
                                      <label><?php echo $j4; ?></label>
                                      <input id="satuanms4" type="text" name="satuanms4" class="form-control" readonly />
                                    </div>
                                  </div>

                                  <div class="col-md-3" style="float: left;">
                                    <div class="form-group">
                                      <label><?php echo $j3; ?></label>
                                      <input type="text" name="<?php echo $f_34ms; ?>" class="form-control" value="<?php echo $e[$f_34ms]; ?>" />
                                    </div>
                                  </div>
                                  <div style="clear: both;"></div>

                                  <div class="col-md-3" style="float: left;">
                                    <div class="form-group">
                                      <label><?php echo $j4; ?></label>
                                      <input id="satuanms5" type="text" name="satuanms5" class="form-control" readonly />
                                    </div>
                                  </div>

                                  <div class="col-md-3" style="float: left;">
                                    <div class="form-group">
                                      <label><?php echo $j3; ?></label>
                                      <input type="text" name="<?php echo $f_35ms; ?>" class="form-control" value="<?php echo $e[$f_35ms]; ?>" />
                                    </div>
                                  </div>
                                </div>
                                <div style="clear: both;"></div>

                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label for="<?php echo $f35; ?>"><?php echo $j35; ?> </label>
                                    <select id="<?php echo $f35; ?>" name="<?php echo $f35; ?>" class="form-control">
                                      <option value="<?php echo $e[$f35]; ?>"><?php echo ($e[$f35] == "manual") ? "Tanpa Kategori" : $e[$f35]; ?></option>

                                      <?php
                                      $query = mysqli_query($koneksi, "SELECT Nama_kategoriNilai FROM kategori_nilai WHERE id_kat = 5 GROUP BY Nama_kategoriNilai ");
                                      while ($j = mysqli_fetch_array($query)) {
                                        $kategorigroip = $j["Nama_kategoriNilai"];

                                      ?>
                                        <option value="<?php echo $kategorigroip; ?>"><?php echo $kategorigroip; ?></option>
                                      <?php } ?>
                                      <option value="manual">Tanpa Kategori</option>
                                    </select>
                                  </div>
                                </div>
                                <div id="mgharga">
                                  <div class="col-md-3" style="float: left;">
                                    <div class="form-group">
                                      <label><?php echo $j4; ?></label>
                                      <input id="satuanmg1" type="text" name="satuanmg1" class="form-control" readonly />
                                    </div>
                                  </div>
                                  <div class="col-md-3" style="float: left;">
                                    <div class="form-group">
                                      <label><?php echo $j3; ?></label>
                                      <input type="text" name="<?php echo $f_31mg; ?>" class="form-control" value="<?php echo $e[$f_31mg]; ?>" />
                                    </div>
                                  </div>
                                  <div style="clear: both;"></div>

                                  <div class="col-md-3" style="float: left;">
                                    <div class="form-group">
                                      <label><?php echo $j4; ?></label>
                                      <input id="satuanmg2" type="text" name="satuanmg2" class="form-control" readonly />
                                    </div>
                                  </div>

                                  <div class="col-md-3" style="float: left;">
                                    <div class="form-group">
                                      <label><?php echo $j3; ?></label>
                                      <input type="text" name="<?php echo $f_32mg; ?>" class="form-control" value="<?php echo $e[$f_32mg]; ?>" />
                                    </div>
                                  </div>
                                  <div style="clear: both;"></div>

                                  <div class="col-md-3" style="float: left;">
                                    <div class="form-group">
                                      <label><?php echo $j4; ?></label>
                                      <input id="satuanmg3" type="text" name="satuanmg3" class="form-control" readonly />
                                    </div>
                                  </div>

                                  <div class="col-md-3" style="float: left;">
                                    <div class="form-group">
                                      <label><?php echo $j3; ?></label>
                                      <input type="text" name="<?php echo $f_33mg; ?>" class="form-control" value="<?php echo $e[$f_33mg]; ?>" />
                                    </div>
                                  </div>
                                  <div style="clear: both;"></div>

                                  <div class="col-md-3" style="float: left;">
                                    <div class="form-group">
                                      <label><?php echo $j4; ?></label>
                                      <input id="satuanmg4" type="text" name="satuanmg4" class="form-control" readonly />
                                    </div>
                                  </div>

                                  <div class="col-md-3" style="float: left;">
                                    <div class="form-group">
                                      <label><?php echo $j3; ?></label>
                                      <input type="text" name="<?php echo $f_34mg; ?>" class="form-control" value="<?php echo $e[$f_34mg]; ?>" />
                                    </div>
                                  </div>
                                  <div style="clear: both;"></div>

                                  <div class="col-md-3" style="float: left;">
                                    <div class="form-group">
                                      <label><?php echo $j4; ?></label>
                                      <input id="satuanmg5" type="text" name="satuanmg5" class="form-control" readonly />
                                    </div>
                                  </div>

                                  <div class="col-md-3" style="float: left;">
                                    <div class="form-group">
                                      <label><?php echo $j3; ?></label>
                                      <input type="text" name="<?php echo $f_35mg; ?>" class="form-control" value="<?php echo $e[$f_35mg]; ?>" />
                                    </div>
                                  </div>
                                </div>
                                <div style="clear: both;"></div>

                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label for="<?php echo $f36; ?>"><?php echo $j36; ?> </label>
                                    <select id="<?php echo $f36; ?>" name="<?php echo $f36; ?>" class="form-control">
                                      <option value="<?php echo $e[$f36]; ?>"><?php echo ($e[$f36] == "manual") ? "Tanpa Kategori" : $e[$f36]; ?></option>

                                      <?php
                                      $query = mysqli_query($koneksi, "SELECT Nama_kategoriNilai FROM kategori_nilai WHERE id_kat = 6 GROUP BY Nama_kategoriNilai ");
                                      while ($j = mysqli_fetch_array($query)) {
                                        $kategorigroip = $j["Nama_kategoriNilai"];

                                      ?>
                                        <option value="<?php echo $kategorigroip; ?>"><?php echo $kategorigroip; ?></option>
                                      <?php } ?>
                                      <option value="manual">Tanpa Kategori</option>
                                    </select>
                                  </div>
                                </div>
                                <div id="mpharga">
                                  <div class="col-md-3" style="float: left;">
                                    <div class="form-group">
                                      <label><?php echo $j4; ?></label>
                                      <input id="satuanmp1" type="text" name="satuanmp1" class="form-control" readonly />
                                    </div>
                                  </div>
                                  <div class="col-md-3" style="float: left;">
                                    <div class="form-group">
                                      <label><?php echo $j3; ?></label>
                                      <input type="text" name="<?php echo $f_31mp; ?>" class="form-control" value="<?php echo $e[$f_31mp]; ?>" />
                                    </div>
                                  </div>
                                  <div style="clear: both;"></div>

                                  <div class="col-md-3" style="float: left;">
                                    <div class="form-group">
                                      <label><?php echo $j4; ?></label>
                                      <input id="satuanmp2" type="text" name="satuanmp2" class="form-control" readonly />
                                    </div>
                                  </div>

                                  <div class="col-md-3" style="float: left;">
                                    <div class="form-group">
                                      <label><?php echo $j3; ?></label>
                                      <input type="text" name="<?php echo $f_32mp; ?>" class="form-control" value="<?php echo $e[$f_32mp]; ?>" />
                                    </div>
                                  </div>
                                  <div style="clear: both;"></div>

                                  <div class="col-md-3" style="float: left;">
                                    <div class="form-group">
                                      <label><?php echo $j4; ?></label>
                                      <input id="satuanmp3" type="text" name="satuanmp3" class="form-control" readonly />
                                    </div>
                                  </div>

                                  <div class="col-md-3" style="float: left;">
                                    <div class="form-group">
                                      <label><?php echo $j3; ?></label>
                                      <input type="text" name="<?php echo $f_33mp; ?>" class="form-control" value="<?php echo $e[$f_33mp]; ?>" />
                                    </div>
                                  </div>
                                  <div style="clear: both;"></div>

                                  <div class="col-md-3" style="float: left;">
                                    <div class="form-group">
                                      <label><?php echo $j4; ?></label>
                                      <input id="satuanmp4" type="text" name="satuanmp4" class="form-control" readonly />
                                    </div>
                                  </div>

                                  <div class="col-md-3" style="float: left;">
                                    <div class="form-group">
                                      <label><?php echo $j3; ?></label>
                                      <input type="text" name="<?php echo $f_34mp; ?>" class="form-control" value="<?php echo $e[$f_34mp]; ?>" />
                                    </div>
                                  </div>
                                  <div style="clear: both;"></div>

                                  <div class="col-md-3" style="float: left;">
                                    <div class="form-group">
                                      <label><?php echo $j4; ?></label>
                                      <input id="satuanmp5" type="text" name="satuanmp5" class="form-control" readonly />
                                    </div>
                                  </div>

                                  <div class="col-md-3" style="float: left;">
                                    <div class="form-group">
                                      <label><?php echo $j3; ?></label>
                                      <input type="text" name="<?php echo $f_35mp; ?>" class="form-control" value="<?php echo $e[$f_35mp]; ?>" />
                                    </div>
                                  </div>
                                  <div style="clear: both;"></div>

                                </div>
                              </div>
                              <div class="col-md-12">
                                <hr>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label for="<?php echo $f37; ?>"><?php echo $j37; ?> </label>
                                  <select id="<?php echo $f37; ?>" name="<?php echo $f37; ?>" class="form-control">
                                    <option value="<?php echo $e[$f37]; ?>"><?php echo $e[$f37]; ?></option>

                                    <?php
                                    $query = mysqli_query($koneksi, "SELECT kd_kat FROM kategori_buffer ");
                                    while ($j = mysqli_fetch_array($query)) {
                                      $kategoribuffer = $j["kd_kat"];

                                    ?>
                                      <option value="<?php echo $kategoribuffer; ?>"><?php echo $kategoribuffer; ?></option>
                                    <?php } ?>
                                  </select>
                                </div>
                              </div>
                              <!-- <div class="col-md-6">
                                <div class="form-group">
                                  <label><?php echo $j38; ?></label>
                                  <input type="text" name="<?php echo $f9; ?>" class="form-control" value="<?php echo $e[$f9]; ?>" />
                                </div>
                              </div> -->
                            </div>

                            <!-- <div class="row">
                              <div class="col-sm-6">
                                <div class="form-group">
                                  <div id="msg"></div>
                                  <input type="file" name="photo" class="file">
                                  <div class="input-group my-3">
                                    <input type="text" class="form-control" disabled placeholder="Upload Gambar" id="file">
                                    <div class="input-group-append">
                                      <button type="button" id="pilih_gambar" class="browse btn btn-dark elevation-2">Pilih Gambar</button>
                                    </div>
                                  </div>
                                  <?php
                                  if ($e['photo'] == "") {
                                    $datagambar = "images.jpeg";
                                  } else {
                                    $datagambar = $e['photo'];
                                  } ?>

                                  <img src="../../images/menu/<?php echo $datagambar; ?>" id="preview" class="img-thumbnail elevation-3" style="width: 120px;float: left;margin-bottom: 5px;">
                                </div>
                              </div>
                            </div> -->
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
      <!-- Modal for editing $f1 field -->
      <div class="modal fade" id="editModal_<?php echo $f1; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel_<?php echo $f1; ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="editModalLabel_<?php echo $f1; ?>">Edit <?php echo $j1; ?></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id="editForm_<?php echo $f1; ?>" method="POST" action="route/<?php echo $data; ?>/<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=edit_idbarang&id=<?php echo $e['kd_subgrup']; ?>" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="form-group">
                  <label for="modal_<?php echo $f1; ?>"><?php echo $j1; ?></label>
                  <input type="text" name="<?php echo $f1; ?>" id="modal_<?php echo $f1; ?>" class="form-control" value="<?php echo $e[$f1]; ?>" required />
                  <input type="hidden" name="field_name" value="<?php echo $f1; ?>" />
                  <input type="hidden" name="old_value" value="<?php echo htmlspecialchars($e[$f1]); ?>" />
                </div>
                <div class="form-group">
                  <medium class="form-text text-muted">
                    Current value: <strong><?php echo htmlspecialchars($e[$f1]); ?></strong>
                  </medium>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <style>
        .file {
          visibility: hidden;
          position: absolute;
        }
      </style>

      <script>
        document.addEventListener("DOMContentLoaded", function() {
          const selectedValue = document.querySelector('input[name="tab"]:checked').value;
          if (selectedValue === "lock") {
            lock();
          } else if (selectedValue === "unlock") {
            unlock();
          }
          document.getElementById("retailharga").style.display = (document.getElementById("ktg_retail").value == "manual") ? 'block' : 'none';
          document.getElementById("grosirharga").style.display = (document.getElementById("ktg_grosir").value == "manual") ? 'block' : 'none';
          document.getElementById("onlineharga").style.display = (document.getElementById("ktg_online").value == "manual") ? 'block' : 'none';
          document.getElementById("msharga").style.display = (document.getElementById("ktg_ms").value == "manual") ? 'block' : 'none';
          document.getElementById("mgharga").style.display = (document.getElementById("ktg_mg").value == "manual") ? 'block' : 'none';
          document.getElementById("mpharga").style.display = (document.getElementById("ktg_mp").value == "manual") ? 'block' : 'none';

          document.getElementById("satuanretail1").value = document.getElementById("satuansemua1").value;
          document.getElementById("satuanretail2").value = document.getElementById("satuansemua2").value;
          document.getElementById("satuanretail3").value = document.getElementById("satuansemua3").value;
          document.getElementById("satuanretail4").value = document.getElementById("satuansemua4").value;
          document.getElementById("satuanretail5").value = document.getElementById("satuansemua5").value;

          document.getElementById("satuangrosir1").value = document.getElementById("satuansemua1").value;
          document.getElementById("satuangrosir2").value = document.getElementById("satuansemua2").value;
          document.getElementById("satuangrosir3").value = document.getElementById("satuansemua3").value;
          document.getElementById("satuangrosir4").value = document.getElementById("satuansemua4").value;
          document.getElementById("satuangrosir5").value = document.getElementById("satuansemua5").value;

          document.getElementById("satuanonline1").value = document.getElementById("satuansemua1").value;
          document.getElementById("satuanonline2").value = document.getElementById("satuansemua2").value;
          document.getElementById("satuanonline3").value = document.getElementById("satuansemua3").value;
          document.getElementById("satuanonline4").value = document.getElementById("satuansemua4").value;
          document.getElementById("satuanonline5").value = document.getElementById("satuansemua5").value;

          document.getElementById("satuanms1").value = document.getElementById("satuansemua1").value;
          document.getElementById("satuanms2").value = document.getElementById("satuansemua2").value;
          document.getElementById("satuanms3").value = document.getElementById("satuansemua3").value;
          document.getElementById("satuanms4").value = document.getElementById("satuansemua4").value;
          document.getElementById("satuanms5").value = document.getElementById("satuansemua5").value;

          document.getElementById("satuanmg1").value = document.getElementById("satuansemua1").value;
          document.getElementById("satuanmg2").value = document.getElementById("satuansemua2").value;
          document.getElementById("satuanmg3").value = document.getElementById("satuansemua3").value;
          document.getElementById("satuanmg4").value = document.getElementById("satuansemua4").value;
          document.getElementById("satuanmg5").value = document.getElementById("satuansemua5").value;

          document.getElementById("satuanmp1").value = document.getElementById("satuansemua1").value;
          document.getElementById("satuanmp2").value = document.getElementById("satuansemua2").value;
          document.getElementById("satuanmp3").value = document.getElementById("satuansemua3").value;
          document.getElementById("satuanmp4").value = document.getElementById("satuansemua4").value;
          document.getElementById("satuanmp5").value = document.getElementById("satuansemua5").value;


          document.getElementById("satuansemua1").addEventListener("input", function() {
            document.getElementById("satuanretail1").value = this.value;
            document.getElementById("satuangrosir1").value = this.value;
            document.getElementById("satuanonline1").value = this.value;
            document.getElementById("satuanms1").value = this.value;
            document.getElementById("satuanmg1").value = this.value;
            document.getElementById("satuanmp1").value = this.value;

          });
          document.getElementById("satuansemua2").addEventListener("input", function() {
            document.getElementById("satuanretail2").value = this.value;
            document.getElementById("satuangrosir2").value = this.value;
            document.getElementById("satuanonline2").value = this.value;
            document.getElementById("satuanms2").value = this.value;
            document.getElementById("satuanmg2").value = this.value;
            document.getElementById("satuanmp2").value = this.value;
          });
          document.getElementById("satuansemua3").addEventListener("input", function() {
            document.getElementById("satuanretail3").value = this.value;
            document.getElementById("satuangrosir3").value = this.value;
            document.getElementById("satuanonline3").value = this.value;
            document.getElementById("satuanms3").value = this.value;
            document.getElementById("satuanmg3").value = this.value;
            document.getElementById("satuanmp3").value = this.value;
          });
          document.getElementById("satuansemua4").addEventListener("input", function() {
            document.getElementById("satuanretail4").value = this.value;
            document.getElementById("satuangrosir4").value = this.value;
            document.getElementById("satuanonline4").value = this.value;
            document.getElementById("satuanms4").value = this.value;
            document.getElementById("satuanmg4").value = this.value;
            document.getElementById("satuanmp4").value = this.value;
          });
          document.getElementById("satuansemua5").addEventListener("input", function() {
            document.getElementById("satuanretail5").value = this.value;
            document.getElementById("satuangrosir5").value = this.value;
            document.getElementById("satuanonline5").value = this.value;
            document.getElementById("satuanms5").value = this.value;
            document.getElementById("satuanmg5").value = this.value;
            document.getElementById("satuanmp5").value = this.value;
          });

          document.getElementById("ktg_retail").addEventListener("change", function() {
            document.getElementById("retailharga").style.display = this.value === "manual" ? 'block' : 'none';
          });
          document.getElementById("ktg_grosir").addEventListener("change", function() {
            document.getElementById("grosirharga").style.display = this.value === "manual" ? 'block' : 'none';
          });
          document.getElementById("ktg_online").addEventListener("change", function() {
            document.getElementById("onlineharga").style.display = this.value === "manual" ? 'block' : 'none';
          });
          document.getElementById("ktg_ms").addEventListener("change", function() {
            document.getElementById("msharga").style.display = this.value === "manual" ? 'block' : 'none';
          });
          document.getElementById("ktg_mg").addEventListener("change", function() {
            document.getElementById("mgharga").style.display = this.value === "manual" ? 'block' : 'none';
          });
          document.getElementById("ktg_mp").addEventListener("change", function() {
            document.getElementById("mpharga").style.display = this.value === "manual" ? 'block' : 'none';
          });
        });

        function lock() {
          document.getElementById('divkategori').style.display = 'none';
          document.getElementById('kategoriharga').style.display = 'block';
          document.getElementById("retailharga").style.display = document.getElementById("retailharga").value === "manual" ? 'block' : 'none';
          document.getElementById("grosirharga").style.display = document.getElementById("grosirharga").value === "manual" ? 'block' : 'none';
          document.getElementById("onlineharga").style.display = document.getElementById("onlineharga").value === "manual" ? 'block' : 'none';
          document.getElementById("mgharga").style.display = document.getElementById("mgharga").value === "manual" ? 'block' : 'none';
          document.getElementById("msharga").style.display = document.getElementById("msharga").value === "manual" ? 'block' : 'none';
          document.getElementById("mpharga").style.display = document.getElementById("mpharga").value === "manual" ? 'block' : 'none';
        }

        function unlock() {
          document.getElementById('divkategori').style.display = 'block';
          document.getElementById('kategoriharga').style.display = 'none';
          document.getElementById("retailharga").style.display = document.getElementById("retailharga").value === "manual" ? 'block' : 'none';
          document.getElementById("grosirharga").style.display = document.getElementById("grosirharga").value === "manual" ? 'block' : 'none';
          document.getElementById("onlineharga").style.display = document.getElementById("onlineharga").value === "manual" ? 'block' : 'none';
          document.getElementById("mgharga").style.display = document.getElementById("mgharga").value === "manual" ? 'block' : 'none';
          document.getElementById("msharga").style.display = document.getElementById("msharga").value === "manual" ? 'block' : 'none';
          document.getElementById("mpharga").style.display = document.getElementById("mpharga").value === "manual" ? 'block' : 'none';
          document.getElementById("ktg_harga").value = "";
        }

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
    case "print":
    ?>
      <!DOCTYPE html>
      <html lang="id">

      <head>
        <meta charset="UTF-8">
        <title>Label Print - No. 108 Optimized</title>
        <style>
          html,
          body {
            width: 210mm;
            height: 297mm;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            position: relative;
          }

          .label-container {
            position: absolute;
            top: 6mm;
            /* Already tuned correctly */
            left: 2.2mm;
            /* Already tuned correctly */
            width: 200mm;
            height: 160mm;
            /* ✅ Use actual space needed by labels + gaps */
            display: grid;
            grid-template-columns: repeat(5, 38mm);
            grid-template-rows: repeat(8, 18mm);
            column-gap: 1.6mm;
            row-gap: 1.75mm;
            box-sizing: border-box;
          }

          .label {
            width: 38mm;
            height: 18mm;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            font-size: 8pt;
            text-align: center;
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            /* border: 0.1mm solid #999; */
            /* optional for alignment debugging */
          }

          .company-name {
            font-size: 7px;
            font-weight: bold;
            margin: 0;
            padding: 0;
            line-height: 1;
            display: block;
          }


          .barcode-container {
            max-width: 100%;
            height: auto;
            display: flex;
            justify-content: center;
            align-items: center;
          }

          .barcode-number {
            font-size: 6px;
            line-height: 1;
            margin-top: 0.2mm;
            font-weight: bold;
            font-family: 'Courier New', monospace;
          }

          .product-name {
            font-size: 10px;
            line-height: 1.1;
            margin-top: 0mm;
            margin-bottom: 0mm;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            line-clamp: 2;
            -webkit-box-orient: vertical;
            word-break: break-word;
            text-align: center;
            flex-grow: 1;
            max-height: 4mm;
          }

          .exp-date {
            margin-top: 0mm;
            margin-bottom: 0mm;
            font-size: 7px;
            font-weight: bold;
            color: #333;
          }

          /* Dynamic text sizing based on length */
          .long-text {
            font-size: 9px;
            line-height: 1.0;
          }

          .very-long-text {
            font-size: 7.5px;
            line-height: 0.9;
          }

          .long-code {
            font-size: 5px;
          }

          .very-long-code {
            font-size: 4px;
          }

          @page {
            size: A4;
            margin: 0;
          }

          @media print {
            .label {
              border: none;
              /* Remove border for actual printing */
            }

            body {
              -webkit-print-color-adjust: exact;
              print-color-adjust: exact;
            }
          }
        </style>
        <script src="https://cdn.jsdelivr.net/npm/jsbarcode/dist/JsBarcode.all.min.js"></script>
      </head>

      <body>
        <div class="label-container">
          <?php
          // Example query - replace with your actual database query
          $query = mysqli_query($koneksi, "SELECT $f1, $f2 FROM $tabel WHERE kd_brg='$_GET[id]'");
          $data = mysqli_fetch_array($query);

          $product = $data[$f2];
          $barcodeValue = $_GET['id'];
          $expDate = isset($_GET['exp_date']) ? $_GET['exp_date'] : null;
          $hasExpDate = !empty($expDate);
          // $hasCompany = isset($_GET['show_company']) ? $_GET['show_company'] : true; // Add this parameter to control company display

          for ($i = 1; $i <= 40; $i++) { // 5x8 = 40 labels
            $barcodeId = 'barcode_' . $i;

            $textLength = strlen($product);
            $textClass = '';
            if ($textLength > 40) {
              $textClass = 'very-long-text';
            } elseif ($textLength > 25) {
              $textClass = 'long-text';
            }

            $codeLength = strlen($barcodeValue);
            $codeClass = '';
            if ($codeLength > 15) {
              $codeClass = 'very-long-code';
            } elseif ($codeLength > 10) {
              $codeClass = 'long-code';
            }

            echo "<div class='label'>";
            echo "<div class='company-name'>Asta TBK</div>";
            // Show expiration date if available

            echo "<div class='barcode-container'>
              <svg id='$barcodeId'></svg>
            </div>
            <div class='barcode-number $codeClass'>$barcodeValue</div>
            <div class='product-name $textClass'>$product</div>";
            if ($hasExpDate) {
              echo "<div class='exp-date'>EXP $expDate</div>";
            }


            echo "</div>";
          }
          ?>
        </div>

        <script>
          const barcodeValue = "<?php echo $barcodeValue; ?>";
          const barcodeLength = barcodeValue.length;

          let barcodeWidth = 0.8; // Reduced from 1.2
          if (barcodeLength > 15) {
            barcodeWidth = 0.5; // Reduced from 0.7
          } else if (barcodeLength > 10) {
            barcodeWidth = 0.6; // Reduced from 0.9
          }

          for (let i = 1; i <= 40; i++) {
            JsBarcode(`#barcode_${i}`, barcodeValue, {
              height: 15, // Reduced from 20
              fontSize: 0,
              width: 1, // barcodeWidth Using the reduced width values
              margin: 0,
              displayValue: false,
              format: "CODE128"
            });
          }
        </script>
      </body>

      </html>
      <!-- <!DOCTYPE html>
      <html lang="id">

      <head>
        <meta charset="UTF-8">
        <title>Label Print - Tom and Jerry 108</title>
        <style>
          body {
            margin: 0;
            font-family: Arial, sans-serif;
          }

          .label-container {
            width: 210mm;
            height: 297mm;
            display: grid;
            grid-template-columns: repeat(5, 38mm);
            grid-template-rows: repeat(8, 19mm);
            gap: 2mm 2mm;
            padding: 12mm 8mm;
            box-sizing: border-box;
          }

          .label {
            width: 38mm;
            height: 19mm;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            overflow: hidden;
            box-sizing: border-box;
            text-align: center;
            padding: 1mm;
            border: 0.1mm solid #ddd;
            background-color: #f9f9f9;
          }

          .company-name {
            font-size: 8px;
            font-weight: bold;
            margin-bottom: 0.3mm;
            line-height: 1;
          }

          .barcode-container {
            height: 6mm;
            display: flex;
            justify-content: center;
            align-items: center;
          }

          .barcode-number {
            font-size: 7px;
            line-height: 1;
            margin: 0.2mm 0;
          }

          .product-name {
            font-size: 9px;
            font-weight: 600;
            line-height: 1.1;
            margin-top: 0.3mm;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            line-clamp: 2;
            -webkit-box-orient: vertical;
            word-break: break-word;
            text-align: center;
            flex: 1;
          }

          .product-name.long-text {
            font-size: 7px;
            line-height: 1.05;
            -webkit-line-clamp: 3;
            line-clamp: 3;
          }

          .product-name.very-long-text {
            font-size: 6px;
            line-height: 1;
            -webkit-line-clamp: 3;
            line-clamp: 3;
          }

          .exp-date {
            font-size: 6px;
            margin-top: 0.2mm;
            font-weight: bold;
          }

          .barcode-number.long-code {
            font-size: 6px;
          }

          .barcode-number.very-long-code {
            font-size: 5px;
          }

          @page {
            size: A4;
            margin: 0;
          }

          @media print {
            .label {
              border: none !important;
              background-color: transparent !important;
            }

            body {
              -webkit-print-color-adjust: exact;
              print-color-adjust: exact;
            }

            @page {
              size: A4;
              margin: 0;
            }
          }
        </style>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jsbarcode/3.11.5/JsBarcode.all.min.js"></script>
      </head>

      <body>
        <div class="label-container">
          <script>
            // Configuration - Change these values as needed
            const config = {
              companyName: "Asta TBK",
              barcodeValue: "1234567890123",
              productName: "Sample Product Name for Testing Long Text Display",
              hasExpDate: true, // Set to false to hide expiration date
              expDate: "2024-12-31" // Format: YYYY-MM-DD
            };

            // Determine text class based on product name length
            const textLength = config.productName.length;
            let textClass = '';
            if (textLength > 50) {
              textClass = 'very-long-text';
            } else if (textLength > 30) {
              textClass = 'long-text';
            }

            // Determine code class based on barcode length
            const codeLength = config.barcodeValue.length;
            let codeClass = '';
            if (codeLength > 15) {
              codeClass = 'very-long-code';
            } else if (codeLength > 10) {
              codeClass = 'long-code';
            }

            // Generate 40 labels (5x8 grid) for Tom and Jerry 108
            for (let i = 1; i <= 40; i++) {
              const barcodeId = 'barcode_' + i;

              if (config.hasExpDate && config.expDate) {
                // Format date for display
                const formattedDate = new Date(config.expDate).toLocaleDateString('id-ID');
                document.write(`
                        <div class="label">
                            <div class="company-name">${config.companyName}</div>
                            <div class="barcode-container">
                                <svg id="${barcodeId}"></svg>
                            </div>
                            <div class="barcode-number ${codeClass}">${config.barcodeValue}</div>
                            <div class="product-name ${textClass}">${config.productName}</div>
                            <div class="exp-date">EXP ${formattedDate}</div>
                        </div>
                    `);
              } else {
                document.write(`
                        <div class="label">
                            <div class="barcode-container">
                                <svg id="${barcodeId}"></svg>
                            </div>
                            <div class="barcode-number ${codeClass}">${config.barcodeValue}</div>
                            <div class="product-name ${textClass}">${config.productName}</div>
                        </div>
                    `);
              }
            }
          </script>
        </div>

        <script>
          // Generate barcodes after DOM is ready
          document.addEventListener('DOMContentLoaded', function() {
            const barcodeLength = config.barcodeValue.length;

            // Responsive barcode width based on length
            let barcodeWidth = 1.3;
            if (barcodeLength > 15) {
              barcodeWidth = 0.9;
            } else if (barcodeLength > 12) {
              barcodeWidth = 1.0;
            } else if (barcodeLength > 8) {
              barcodeWidth = 1.1;
            }

            // Generate barcodes for all 40 labels
            for (let i = 1; i <= 40; i++) {
              try {
                JsBarcode(`#barcode_${i}`, config.barcodeValue, {
                  height: 14,
                  fontSize: 0,
                  width: barcodeWidth,
                  margin: 0,
                  displayValue: false,
                  background: "transparent"
                });
              } catch (error) {
                console.error('Error generating barcode for label', i, error);
              }
            }
          });
        </script>
      </body>

      </html> -->
      <!-- <!DOCTYPE html>
      <html lang="id">

      <head>
        <meta charset="UTF-8">
        <title>Label Print - Koala 108</title>
        <style>
          body {
            margin: 0;
            font-family: Arial, sans-serif;
          }

          .label-container {
            width: 210mm;
            height: 297mm;
            display: grid;
            grid-template-columns: repeat(5, 38mm);
            grid-template-rows: repeat(8, 19mm);
            gap: 2mm 2mm;
            /* Gap antar label */
            padding: 12mm 8mm;
            /* Margin dari tepi */
            box-sizing: border-box;
          }

          .label {
            width: 38mm;
            height: 19mm;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            overflow: hidden;
            box-sizing: border-box;
            text-align: center;
          }

          .company-name {
            font-size: 6px;
            font-weight: bold;
            margin-bottom: 0.5mm;
          }

          .barcode-container {
            height: 6mm;
          }

          .barcode-number {
            font-size: 6px;
            line-height: 1;
          }

          .product-name {
            font-size: 5px;
            line-height: 1.1;
            margin-top: 0.5mm;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            line-clamp: 2;
            -webkit-box-orient: vertical;
            word-break: break-word;
          }

          .exp-date {
            font-size: 5px;
            margin-top: 0.3mm;
          }

          @page {
            size: A4;
            margin: 0;
          }

          @media print {
            .label {
              border: none;
            }
          }
        </style>
        <script src="https://cdn.jsdelivr.net/npm/jsbarcode/dist/JsBarcode.all.min.js"></script>
      </head>

      <body>
        <div class="label-container">
          <?php
          // Contoh query
          //   $query = mysqli_query($koneksi, "SELECT $f1, $f2 FROM $tabel WHERE kd_brg='$_GET[id]'");
          //   $data = mysqli_fetch_array($query);

          //   $product = $data[$f2];
          //   $barcodeValue = $_GET['id'];
          //   $expDate = isset($_GET['exp_date']) ? $_GET['exp_date'] : null;
          //   $hasExpDate = !empty($expDate);

          //   for ($i = 1; $i <= 40; $i++) { // 5x8 = 40 label
          //     $barcodeId = 'barcode_' . $i;

          //     $textLength = strlen($product);
          //     $textClass = '';
          //     if ($textLength > 40) {
          //       $textClass = 'very-long-text';
          //     } elseif ($textLength > 25) {
          //       $textClass = 'long-text';
          //     }

          //     $codeLength = strlen($barcodeValue);
          //     $codeClass = '';
          //     if ($codeLength > 15) {
          //       $codeClass = 'very-long-code';
          //     } elseif ($codeLength > 10) {
          //       $codeClass = 'long-code';
          //     }

          //     if ($hasExpDate) {
          //       echo "<div class='label'>
          //   <div class='company-name'>Asta TBK</div>
          //   <div class='barcode-container'>
          //     <svg id='$barcodeId'></svg>
          //   </div>
          //   <div class='barcode-number $codeClass'>$barcodeValue</div>
          //   <div class='product-name $textClass'>$product</div>
          //   <div class='exp-date'>EXP $expDate</div>
          // </div>";
          //     } else {
          //       echo "<div class='label'>
          //   <div class='barcode-container'>
          //     <svg id='$barcodeId'></svg>
          //   </div>
          //   <div class='barcode-number $codeClass'>$barcodeValue</div>
          //   <div class='product-name $textClass'>$product</div>
          // </div>";
          //     }
          //   }
          ?>
        </div>

        <script>
          const barcodeValue = "<?php echo $barcodeValue; ?>";
          const barcodeLength = barcodeValue.length;
          let barcodeWidth = 1.2;
          if (barcodeLength > 15) {
            barcodeWidth = 0.8;
          } else if (barcodeLength > 10) {
            barcodeWidth = 1.0;
          }
          for (let i = 1; i <= 40; i++) {
            JsBarcode(`#barcode_${i}`, barcodeValue, {
              height: 15,
              fontSize: 0,
              width: barcodeWidth,
              margin: 0,
              displayValue: false
            });
          }
        </script>
      </body>

      </html> -->

      <!-- <!DOCTYPE html>
      <html>

      <head>
        <style>
          body {
            margin: 0;
            font-family: Arial, sans-serif;
          }

          .label-container {
            width: 210mm;
            /* A4 paper width */
            height: 297mm;
            /* A4 paper height */
            display: grid;
            grid-template-columns: repeat(5, 38mm);
            /* 5 columns of 38mm each */
            grid-template-rows: repeat(14, 19mm);
            /* 14 rows of 19mm each */
            gap: 2.5mm 2mm;
            /* Row gap 2.5mm, Column gap 2mm */
            padding: 12mm 6mm;
            /* Top/bottom 12mm, Left/right 6mm */
            box-sizing: border-box;
          }

          .label {
            width: 38mm;
            height: 19mm;
            border: 1px solid #ddd;
            /* Optional: for alignment reference */
            text-align: center;
            padding: 0.8mm;
            box-sizing: border-box;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            background: white;
          }

          .label .company-name {
            font-size: 6px;
            font-weight: bold;
            line-height: 1;
            margin-bottom: 0.3mm;
            color: #000;
            font-family: Arial, sans-serif;
          }

          .label .exp-date {
            font-size: 6px;
            font-weight: normal;
            line-height: 1;
            margin-top: 0.3mm;
            color: #000;
            font-family: Arial, sans-serif;
          }

          .label.with-exp .barcode-container {
            height: 6mm;
            margin-bottom: 0.3mm;
          }

          .label.with-exp .barcode-number {
            font-size: 6px;
            margin-bottom: 0.3mm;
          }

          .label.with-exp .product-name {
            font-size: 5px;
            max-height: 4mm;
            -webkit-line-clamp: 2;
            line-clamp: 2;
          }

          .label.with-exp .product-name.long-text {
            font-size: 4px;
            -webkit-line-clamp: 2;
            line-clamp: 2;
          }

          .label.with-exp .product-name.very-long-text {
            font-size: 3px;
            -webkit-line-clamp: 2;
            line-clamp: 2;
            width: 100%;
            height: 8mm;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 0.5mm;
          }

          .label .barcode-container svg {
            max-width: 100%;
            max-height: 100%;
          }

          .label .barcode-number {
            font-size: 8px;
            font-weight: bold;
            line-height: 1;
            margin-bottom: 0.5mm;
            color: #000;
            font-family: Arial, sans-serif;
            word-wrap: break-word;
            overflow: hidden;
            max-height: 3mm;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            line-clamp: 2;
            -webkit-box-orient: vertical;
          }

          .label .barcode-number.long-code {
            font-size: 6px;
            line-height: 0.9;
            letter-spacing: 0px;
          }

          .label .barcode-number.very-long-code {
            font-size: 5px;
            line-height: 0.8;
            letter-spacing: -0.1px;
          }

          .label .product-name {
            font-size: 7px;
            font-weight: bold;
            line-height: 1.1;
            color: #000;
            text-align: center;
            font-family: Arial, sans-serif;
            text-transform: uppercase;
            letter-spacing: 0.2px;
            max-height: 6mm;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            line-clamp: 3;
            -webkit-box-orient: vertical;
            word-wrap: break-word;
            hyphens: auto;
          }

          .label .product-name.long-text {
            font-size: 5px;
            line-height: 1.0;
            letter-spacing: 0.1px;
            -webkit-line-clamp: 4;
            line-clamp: 4;
          }

          .label .product-name.very-long-text {
            font-size: 4px;
            line-height: 0.9;
            letter-spacing: 0px;
            -webkit-line-clamp: 4;
            line-clamp: 4;
          }

          @page {
            size: A4;
            margin: 0;
          }

          @media print {
            body {
              margin: 0;
            }

            .label-container {
              page-break-inside: avoid;
            }

            .label {
              border: none;
              /* Remove border when printing */
            }
          }
        </style>
        <script src="https://cdn.jsdelivr.net/npm/jsbarcode/dist/JsBarcode.all.min.js"></script>
      </head>

      <body onload="window.print();">
        <div class="label-container">
          <?php
          // $query = mysqli_query($koneksi, "SELECT $f1, $f2 FROM $tabel WHERE kd_brg='$_GET[id]'");
          // $data = mysqli_fetch_array($query);

          // $product = $data[$f2];
          // $barcodeValue = $_GET['id'];
          // $expDate = isset($_GET['exp_date']) ? $_GET['exp_date'] : null;
          // $hasExpDate = !empty($expDate);

          // for ($i = 1; $i <= 70; $i++) { // 70 labels per page (5x14 grid)
          //   $barcodeId = 'barcode_' . $i;

          //   // Determine text class based on product name length
          //   $textLength = strlen($product);
          //   $textClass = '';
          //   if ($textLength > 40) {
          //     $textClass = 'very-long-text';
          //   } elseif ($textLength > 25) {
          //     $textClass = 'long-text';
          //   }

          //   // Determine barcode number class based on code length
          //   $codeLength = strlen($barcodeValue);
          //   $codeClass = '';
          //   if ($codeLength > 15) {
          //     $codeClass = 'very-long-code';
          //   } elseif ($codeLength > 10) {
          //     $codeClass = 'long-code';
          //   }

          //   $labelClass = $hasExpDate ? 'with-exp' : '';

          //   if ($hasExpDate) {
          //     // Layout with expiration date (like your image)
          //     echo "
          //           <div class='label $labelClass'>
          //               <div class='company-name'>Asta TBK</div>
          //               <div class='barcode-container'>
          //                   <svg id='$barcodeId'></svg>
          //               </div>
          //               <div class='barcode-number $codeClass'>$barcodeValue</div>
          //               <div class='product-name $textClass'>$product</div>
          //               <div class='exp-date'>EXP $expDate</div>
          //           </div>
          //       ";
          //   } else {
          //     // Layout without expiration date (original)
          //     echo "
          //           <div class='label'>
          //               <div class='barcode-container'>
          //                   <svg id='$barcodeId'></svg>
          //               </div>
          //               <div class='barcode-number $codeClass'>$barcodeValue</div>
          //               <div class='product-name $textClass'>$product</div>
          //           </div>
          //       ";
          //   }
          // }
          ?>
        </div>

        <script>
          // PHP variables for JavaScript
          const barcodeValue = "<?php echo $barcodeValue; ?>";
          const hasExpDate = <?php echo $hasExpDate ? 'true' : 'false'; ?>;

          // Generate barcodes for all labels
          for (let i = 1; i <= 70; i++) {
            const currentBarcodeValue = barcodeValue;
            const barcodeLength = currentBarcodeValue.length;

            // Adjust barcode width based on length
            let barcodeWidth = 1.5;
            let barcodeHeight = 20;

            if (hasExpDate) {
              // Smaller barcode for layout with expiration date
              barcodeHeight = 15;
              if (barcodeLength > 15) {
                barcodeWidth = 0.8;
              } else if (barcodeLength > 10) {
                barcodeWidth = 1.0;
              } else {
                barcodeWidth = 1.2;
              }
            } else {
              // Original barcode sizing
              if (barcodeLength > 15) {
                barcodeWidth = 1.0;
              } else if (barcodeLength > 10) {
                barcodeWidth = 1.2;
              }
            }

            JsBarcode(`#barcode_${i}`, currentBarcodeValue, {
              height: barcodeHeight,
              fontSize: 0,
              width: barcodeWidth,
              margin: 0,
              displayValue: false,
              background: "#ffffff",
              lineColor: "#000000"
            });
          }
        </script>
      </body>

      </html> -->
      <!-- <!DOCTYPE html>
      <html>

      <head>
        <style>
          body {
            margin: 0;
            font-family: Arial, sans-serif;
          }

          .label-container {
            width: 210mm;
            /* A4 paper width */
            height: 297mm;
            /* A4 paper height */
            display: grid;
            grid-template-columns: repeat(5, 38mm);
            /* 5 columns of 38mm each */
            grid-template-rows: repeat(14, 19mm);
            /* 14 rows of 19mm each */
            gap: 2.5mm 2mm;
            /* Row gap 2.5mm, Column gap 2mm */
            padding: 12mm 6mm;
            /* Top/bottom 12mm, Left/right 6mm */
            box-sizing: border-box;
          }

          .label {
            width: 38mm;
            height: 19mm;
            border: 1px solid #ddd;
            /* Optional: for alignment reference */
            text-align: center;
            padding: 0.8mm;
            box-sizing: border-box;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            background: white;
          }

          .label .barcode-container {
            width: 100%;
            height: 8mm;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 0.5mm;
          }

          .label .barcode-container svg {
            max-width: 100%;
            max-height: 100%;
          }

          .label .barcode-number {
            font-size: 8px;
            font-weight: bold;
            line-height: 1;
            margin-bottom: 0.5mm;
            color: #000;
            font-family: Arial, sans-serif;
            word-wrap: break-word;
            overflow: hidden;
            max-height: 3mm;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            line-clamp: 2;
            -webkit-box-orient: vertical;
          }

          .label .barcode-number.long-code {
            font-size: 6px;
            line-height: 0.9;
            letter-spacing: 0px;
          }

          .label .barcode-number.very-long-code {
            font-size: 5px;
            line-height: 0.8;
            letter-spacing: -0.1px;
          }

          .label .product-name {
            font-size: 7px;
            font-weight: bold;
            line-height: 1.1;
            color: #000;
            text-align: center;
            font-family: Arial, sans-serif;
            text-transform: uppercase;
            letter-spacing: 0.2px;
            max-height: 6mm;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            line-clamp: 3;
            -webkit-box-orient: vertical;
            word-wrap: break-word;
            hyphens: auto;
          }

          .label .product-name.long-text {
            font-size: 5px;
            line-height: 1.0;
            letter-spacing: 0.1px;
            -webkit-line-clamp: 4;
            line-clamp: 4;
          }

          .label .product-name.very-long-text {
            font-size: 4px;
            line-height: 0.9;
            letter-spacing: 0px;
            -webkit-line-clamp: 4;
            line-clamp: 4;
          }

          @page {
            size: A4;
            margin: 0;
          }

          @media print {
            body {
              margin: 0;
            }

            .label-container {
              page-break-inside: avoid;
            }

            .label {
              border: none;
              /* Remove border when printing */
            }
          }
        </style>
        <script src="https://cdn.jsdelivr.net/npm/jsbarcode/dist/JsBarcode.all.min.js"></script>
      </head>

      <body onload="window.print();">
        <div class="label-container">
          <?php
          // $query = mysqli_query($koneksi, "SELECT $f1, $f2 FROM $tabel WHERE kd_brg='$_GET[id]'");
          // $data = mysqli_fetch_array($query);

          // $product = $data[$f2];
          // $barcodeValue = $_GET['id'];

          // for ($i = 1; $i <= 70; $i++) { // 70 labels per page (5x14 grid)
          //   $barcodeId = 'barcode_' . $i;

          //   // Determine text class based on product name length
          //   $textLength = strlen($product);
          //   $textClass = '';
          //   if ($textLength > 40) {
          //     $textClass = 'very-long-text';
          //   } elseif ($textLength > 25) {
          //     $textClass = 'long-text';
          //   }

          //   // Determine barcode number class based on code length
          //   $codeLength = strlen($barcodeValue);
          //   $codeClass = '';
          //   if ($codeLength > 15) {
          //     $codeClass = 'very-long-code';
          //   } elseif ($codeLength > 10) {
          //     $codeClass = 'long-code';
          //   }

          //   echo "
          //       <div class='label'>
          //           <div class='barcode-container'>
          //               <svg id='$barcodeId'></svg>
          //           </div>
          //           <div class='barcode-number $codeClass'>$barcodeValue</div>
          //           <div class='product-name $textClass'>$product</div>
          //       </div>
          //   ";
          // }
          // 
          ?>
        </div>

        <script>
          // PHP variables for JavaScript
          const barcodeValue = "<?php echo $barcodeValue; ?>";

          // Generate barcodes for all labels
          for (let i = 1; i <= 70; i++) {
            const currentBarcodeValue = barcodeValue;
            const barcodeLength = currentBarcodeValue.length;

            // Adjust barcode width based on length
            let barcodeWidth = 1.5;
            if (barcodeLength > 15) {
              barcodeWidth = 1.0;
            } else if (barcodeLength > 10) {
              barcodeWidth = 1.2;
            }

            JsBarcode(`#barcode_${i}`, currentBarcodeValue, {
              height: 20,
              fontSize: 0,
              width: barcodeWidth,
              margin: 0,
              displayValue: false,
              background: "#ffffff",
              lineColor: "#000000"
            });
          }
        </script>
      </body>

      </html> -->
      <!-- <html>

      <head>
        <style>
          body {
            margin: 0;
            font-family: Arial, sans-serif;
          }

          .label-container {
            width: 210mm;
            /* A4 paper width */
            height: 297mm;
            /* A4 paper height */
            display: grid;
            grid-template-columns: repeat(5, 38mm);
            grid-template-rows: repeat(8, 18mm);
            gap: 0.2cm;
            padding: 0.5cm 0.1cm;
            /* Top and bottom margins for the page */
            box-sizing: border-box;
          }

          .label {
            text-align: center;
            padding: 1mm;
            box-sizing: border-box;
            overflow: hidden;
          }

          .label span {
            display: block;
            font-size: 8px;
            line-height: 1.2;
            margin-bottom: 1mm;
          }

          @page {
            size: A4;
            margin: 0;
          }

          @media print {
            body {
              margin: 0;
            }

            .label-container {
              page-break-inside: avoid;
            }
          }
        </style>
        <script src="https://cdn.jsdelivr.net/npm/jsbarcode/dist/JsBarcode.all.min.js"></script>
      </head>

      <body onload="window.print();">
        <div class="label-container">
          <?php
          // $query = mysqli_query($koneksi, "SELECT $f1, $f2 FROM $tabel WHERE kd_brg='$_GET[id]'");
          // $data = mysqli_fetch_array($query);

          // $product = $data[$f2];
          // $barcodeValue = $_GET['id'];

          // for ($i = 1; $i <= 40; $i++) { // 40 labels per page
          //   $barcodeId = 'barcode_' . $i; // Unique ID for each barcode
          //   echo "
          //       <div class='label'>
          //           <span><b>Asta TBK</b></span>
          //           <svg id='$barcodeId'></svg>
          //           <span>$product</span>
          //       </div>
          //   ";
          //   echo "
          //       <script>
          //           JsBarcode('#$barcodeId', '$barcodeValue', {
          //               height: 12,
          //               fontSize: 8,
          //               width: 1,
          //               margin: 0
          //           });
          //       </script>
          //   ";
          // }
          ?>
        </div>
      </body>

      </html> -->

<?php break;
  }
}
?>