<?php
$dir = "../../";
$judulform = "Daftar Kategori";

$data = 'data_kategori';
$rute = 'kategori';
$aksi = 'aksi_kategori';

$tabel = 'kategori';

$f1 = 'Nama_kategoriNilai';
$f2 = 'layer1';
$f31 = 'layer21';
$f32 = 'layer22';

$f41 = 'layer31';
$f42 = 'layer32';
$f43 = 'layer33';

$f51 = 'layer41';
$f52 = 'layer42';
$f53 = 'layer43';
$f54 = 'layer44';

$f61 = 'layer51';
$f62 = 'layer52';
$f63 = 'layer53';
$f64 = 'layer54';
$f65 = 'layer55';

$f7 = 'id_kat';


$j1 = 'Nama Kategori';
$j2 = '1 layer';
$j3 = '2 layer';
$j4 = '3 layer';
$j5 = '4 layer';
$j6 = '5 layer';
$j7 = 'Jenis Kategori';



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
                <!-- <div style="margin:10px;"></div> -->
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
                          <button class="btn btn-primary btn-sm elevation-2 " style="opacity: .7;" onclick="window.location='route/<?php echo $data; ?>/autocomplete.php?asal=<?php echo $_GET['asal']; ?>'"><i class="fa fa-plus" ;></i> Tambah</button>
                          <div style="margin:10px"></div>

                          <table id="example1" class="table table-bordered table-striped">
                            <thead style="background-color:  lightgray;" class="elevation-2">
                              <tr align="middle">
                                <th>Kategori </th>

                                <?php $query = "SELECT * FROM kategori";
                                $result = mysqli_query($koneksi, $query);
                                while ($row = mysqli_fetch_assoc($result)) { ?>
                                  <th><?php echo $row["nama_kat"] ?></th>

                                <?php } ?>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              $space = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                              $query = mysqli_query($koneksi, "SELECT Nama_kategoriNilai FROM kategori_nilai GROUP BY Nama_kategoriNilai ");
                              while ($j = mysqli_fetch_array($query)) {
                                $kategorigroip = $j["Nama_kategoriNilai"];
                              ?>
                                <tr align="middle">
                                  <td><b><?php echo $kategorigroip; ?></b></td>
                                  <?php
                                  $row1 = mysqli_query($koneksi, "SELECT 
                                  IFNULL(layer1,0) AS layer11,
                                  IFNULL(SUBSTRING_INDEX(layer2, '|', 1),0) AS layer21, 
                                  IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer2, '|', 2), '|', -1),0) AS layer22,
                                  IFNULL(SUBSTRING_INDEX(layer3, '|', 1),0) AS layer31,  
                                  IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer3, '|', 2), '|', -1),0) AS layer32,  
                                  IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer3, '|', 3), '|', -1),0) AS layer33, 
                                  IFNULL(SUBSTRING_INDEX(layer4, '|', 1),0) AS layer41, 
                                  IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer4, '|', 2), '|', -1),0) AS layer42, 
                                  IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer4, '|', 3), '|', -1),0) AS layer43, 
                                  IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer4, '|', 4), '|', -1),0) AS layer44,  
                                  IFNULL(SUBSTRING_INDEX(layer5, '|', 1),0) AS layer51,  
                                  IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 2), '|', -1),0) AS layer52, 
                                  IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 3), '|', -1),0) AS layer53,  
                                  IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 4), '|', -1),0) AS layer54,  
                                  IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 5), '|', -1),0) AS layer55,id_kat,Nama_kategoriNilai
                                   FROM kategori_nilai WHERE Nama_kategoriNilai = '$kategorigroip' AND id_kat =  1");
                                  if (mysqli_num_rows($row1) === 0) {
                                  ?>
                                    <td> </td>
                                    <?php
                                  } else {
                                    while ($r1 = mysqli_fetch_array($row1)) {
                                    ?>
                                      <td> layer 1 : <?php echo $r1["layer11"]; ?> % <br> <br>
                                        layer 2 : <?php echo $r1["layer21"]; ?> % <br> <?php echo $space, $r1["layer22"]; ?> % <br><br>
                                        layer 3 : <?php echo $r1["layer31"]; ?> % <br> <?php echo $space, $r1["layer32"]; ?> % <br><?php echo $space, $r1["layer33"]; ?> % <br><br>
                                        layer 4 : <?php echo $r1["layer41"]; ?> % <br> <?php echo $space, $r1["layer42"]; ?> % <br><?php echo $space, $r1["layer43"]; ?> % <br> <?php echo $space, $r1["layer44"]; ?> % <br><br>
                                        layer 5 : <?php echo $r1["layer51"]; ?> % <br> <?php echo $space, $r1["layer52"]; ?> % <br><?php echo $space, $r1["layer53"]; ?> % <br> <?php echo $space, $r1["layer54"]; ?> % <br><?php echo $space, $r1["layer55"]; ?> % <br><br>
                                        <a href="main.php?route=kategori&act=edit&ids=<?php echo $j["Nama_kategoriNilai"]; ?>&ids2=<?php echo $r1["id_kat"]; ?>&asal=<?php echo $_GET['asal']; ?>" title="Edit Data"><button class="btn btn-primary btn-sm elevation-2" style="opacity: .7;width:80px"><i class="fa fa-edit"></i> Edit</button></a>

                                        <a href="route/data_kategori/aksi_kategori.php?route=kategori&act=hapus&id=<?php echo $j["Nama_kategoriNilai"]; ?>&ids2=<?php echo $r1["id_kat"]; ?>" title="Hapus Data" onclick="return confirm('Apakah anda yakin ingin menghapus ini ?')"><button class="btn btn-danger btn-sm elevation-2" style="opacity: .7;width:80px"><i class="fa fa-trash"></i> Hapus</button></a>
                                      </td>
                                  <?php }
                                  } ?>
                                  <?php
                                  $row1 = mysqli_query($koneksi, "SELECT IFNULL(layer1,0) AS layer11,IFNULL(SUBSTRING_INDEX(layer2, '|', 1),0) AS layer21, IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer2, '|', 2), '|', -1),0) AS layer22,IFNULL(SUBSTRING_INDEX(layer3, '|', 1),0) AS layer31,  IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer3, '|', 2), '|', -1),0) AS layer32,  IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer3, '|', 3), '|', -1),0) AS layer33, IFNULL(SUBSTRING_INDEX(layer4, '|', 1),0) AS layer41, IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer4, '|', 2), '|', -1),0) AS layer42, IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer4, '|', 3), '|', -1),0) AS layer43, IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer4, '|', 4), '|', -1),0) AS layer44,  IFNULL(SUBSTRING_INDEX(layer5, '|', 1),0) AS layer51,  IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 2), '|', -1),0) AS layer52, IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 3), '|', -1),0) AS layer53,  IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 4), '|', -1),0) AS layer54,  IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 5), '|', -1),0) AS layer55,id_kat,Nama_kategoriNilai
                                   FROM kategori_nilai WHERE Nama_kategoriNilai = '$kategorigroip' AND id_kat =  2");
                                  if (mysqli_num_rows($row1) === 0) {
                                  ?>
                                    <td> </td>
                                    <?php
                                  } else {
                                    while ($r1 = mysqli_fetch_array($row1)) {
                                    ?>
                                      <td> layer 1 : <?php echo $r1["layer11"]; ?> % <br> <br>
                                        layer 2 : <?php echo $r1["layer21"]; ?> % <br> <?php echo $space, $r1["layer22"]; ?> % <br><br>
                                        layer 3 : <?php echo $r1["layer31"]; ?> % <br> <?php echo $space, $r1["layer32"]; ?> % <br><?php echo $space, $r1["layer33"]; ?> % <br><br>
                                        layer 4 : <?php echo $r1["layer41"]; ?> % <br> <?php echo $space, $r1["layer42"]; ?> % <br><?php echo $space, $r1["layer43"]; ?> % <br> <?php echo $space, $r1["layer44"]; ?> % <br><br>
                                        layer 5 : <?php echo $r1["layer51"]; ?> % <br> <?php echo $space, $r1["layer52"]; ?> % <br><?php echo $space, $r1["layer53"]; ?> % <br> <?php echo $space, $r1["layer54"]; ?> % <br><?php echo $space, $r1["layer55"]; ?> % <br><br>
                                        <a href="main.php?route=kategori&act=edit&ids=<?php echo $j["Nama_kategoriNilai"]; ?>&ids2=<?php echo $r1["id_kat"]; ?>&asal=<?php echo $_GET['asal']; ?>" title="Edit Data"><button class="btn btn-primary btn-sm elevation-2" style="opacity: .7;width:80px"><i class="fa fa-edit"></i> Edit</button></a>

                                        <a href="route/data_kategori/aksi_kategori.php?route=kategori&act=hapus&id=<?php echo $j["Nama_kategoriNilai"]; ?>&ids2=<?php echo $r1["id_kat"]; ?>" title="Hapus Data" onclick="return confirm('Apakah anda yakin ingin menghapus ini ?')"><button class="btn btn-danger btn-sm elevation-2" style="opacity: .7;width:80px"><i class="fa fa-trash"></i> Hapus</button></a>
                                      </td>
                                  <?php }
                                  } ?>
                                  <?php
                                  $row1 = mysqli_query($koneksi, "SELECT IFNULL(layer1,0) AS layer11,IFNULL(SUBSTRING_INDEX(layer2, '|', 1),0) AS layer21, IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer2, '|', 2), '|', -1),0) AS layer22,IFNULL(SUBSTRING_INDEX(layer3, '|', 1),0) AS layer31,  IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer3, '|', 2), '|', -1),0) AS layer32,  IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer3, '|', 3), '|', -1),0) AS layer33, IFNULL(SUBSTRING_INDEX(layer4, '|', 1),0) AS layer41, IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer4, '|', 2), '|', -1),0) AS layer42, IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer4, '|', 3), '|', -1),0) AS layer43, IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer4, '|', 4), '|', -1),0) AS layer44,  IFNULL(SUBSTRING_INDEX(layer5, '|', 1),0) AS layer51,  IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 2), '|', -1),0) AS layer52, IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 3), '|', -1),0) AS layer53,  IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 4), '|', -1),0) AS layer54,  IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 5), '|', -1),0) AS layer55,id_kat,Nama_kategoriNilai
                                   FROM kategori_nilai WHERE Nama_kategoriNilai = '$kategorigroip' AND id_kat =  3");
                                  if (mysqli_num_rows($row1) === 0) {
                                  ?>
                                    <td> </td>
                                    <?php
                                  } else {
                                    while ($r1 = mysqli_fetch_array($row1)) {
                                    ?>
                                      <td> layer 1 : <?php echo $r1["layer11"]; ?> % <br> <br>
                                        layer 2 : <?php echo $r1["layer21"]; ?> % <br> <?php echo $space, $r1["layer22"]; ?> % <br><br>
                                        layer 3 : <?php echo $r1["layer31"]; ?> % <br> <?php echo $space, $r1["layer32"]; ?> % <br><?php echo $space, $r1["layer33"]; ?> % <br><br>
                                        layer 4 : <?php echo $r1["layer41"]; ?> % <br> <?php echo $space, $r1["layer42"]; ?> % <br><?php echo $space, $r1["layer43"]; ?> % <br> <?php echo $space, $r1["layer44"]; ?> % <br><br>
                                        layer 5 : <?php echo $r1["layer51"]; ?> % <br> <?php echo $space, $r1["layer52"]; ?> % <br><?php echo $space, $r1["layer53"]; ?> % <br> <?php echo $space, $r1["layer54"]; ?> % <br><?php echo $space, $r1["layer55"]; ?> % <br><br>
                                        <a href="main.php?route=kategori&act=edit&ids=<?php echo $j["Nama_kategoriNilai"]; ?>&ids2=<?php echo $r1["id_kat"]; ?>&asal=<?php echo $_GET['asal']; ?>" title="Edit Data"><button class="btn btn-primary btn-sm elevation-2" style="opacity: .7;width:80px"><i class="fa fa-edit"></i> Edit</button></a>

                                        <a href="route/data_kategori/aksi_kategori.php?route=kategori&act=hapus&id=<?php echo $j["Nama_kategoriNilai"]; ?>&ids2=<?php echo $r1["id_kat"]; ?>" title="Hapus Data" onclick="return confirm('Apakah anda yakin ingin menghapus ini ?')"><button class="btn btn-danger btn-sm elevation-2" style="opacity: .7;width:80px"><i class="fa fa-trash"></i> Hapus</button></a>
                                      </td>
                                  <?php }
                                  } ?>
                                  <?php
                                  $row1 = mysqli_query($koneksi, "SELECT IFNULL(layer1,0) AS layer11,IFNULL(SUBSTRING_INDEX(layer2, '|', 1),0) AS layer21, IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer2, '|', 2), '|', -1),0) AS layer22,IFNULL(SUBSTRING_INDEX(layer3, '|', 1),0) AS layer31,  IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer3, '|', 2), '|', -1),0) AS layer32,  IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer3, '|', 3), '|', -1),0) AS layer33, IFNULL(SUBSTRING_INDEX(layer4, '|', 1),0) AS layer41, IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer4, '|', 2), '|', -1),0) AS layer42, IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer4, '|', 3), '|', -1),0) AS layer43, IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer4, '|', 4), '|', -1),0) AS layer44,  IFNULL(SUBSTRING_INDEX(layer5, '|', 1),0) AS layer51,  IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 2), '|', -1),0) AS layer52, IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 3), '|', -1),0) AS layer53,  IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 4), '|', -1),0) AS layer54,  IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 5), '|', -1),0) AS layer55,id_kat,Nama_kategoriNilai
                                   FROM kategori_nilai WHERE Nama_kategoriNilai = '$kategorigroip' AND id_kat =  4");
                                  if (mysqli_num_rows($row1) === 0) {
                                  ?>
                                    <td> </td>
                                    <?php
                                  } else {
                                    while ($r1 = mysqli_fetch_array($row1)) {
                                    ?>
                                      <td> layer 1 : <?php echo $r1["layer11"]; ?> % <br> <br>
                                        layer 2 : <?php echo $r1["layer21"]; ?> % <br> <?php echo $space, $r1["layer22"]; ?> % <br><br>
                                        layer 3 : <?php echo $r1["layer31"]; ?> % <br> <?php echo $space, $r1["layer32"]; ?> % <br><?php echo $space, $r1["layer33"]; ?> % <br><br>
                                        layer 4 : <?php echo $r1["layer41"]; ?> % <br> <?php echo $space, $r1["layer42"]; ?> % <br><?php echo $space, $r1["layer43"]; ?> % <br> <?php echo $space, $r1["layer44"]; ?> % <br><br>
                                        layer 5 : <?php echo $r1["layer51"]; ?> % <br> <?php echo $space, $r1["layer52"]; ?> % <br><?php echo $space, $r1["layer53"]; ?> % <br> <?php echo $space, $r1["layer54"]; ?> % <br><?php echo $space, $r1["layer55"]; ?> % <br><br>
                                        <a href="main.php?route=kategori&act=edit&ids=<?php echo $j["Nama_kategoriNilai"]; ?>&ids2=<?php echo $r1["id_kat"]; ?>&asal=<?php echo $_GET['asal']; ?>" title="Edit Data"><button class="btn btn-primary btn-sm elevation-2" style="opacity: .7;width:80px"><i class="fa fa-edit"></i> Edit</button></a>

                                        <a href="route/data_kategori/aksi_kategori.php?route=kategori&act=hapus&id=<?php echo $j["Nama_kategoriNilai"]; ?>&ids2=<?php echo $r1["id_kat"]; ?>" title="Hapus Data" onclick="return confirm('Apakah anda yakin ingin menghapus ini ?')"><button class="btn btn-danger btn-sm elevation-2" style="opacity: .7;width:80px"><i class="fa fa-trash"></i> Hapus</button></a>
                                      </td>
                                  <?php }
                                  } ?>
                                  <?php
                                  $row1 = mysqli_query($koneksi, "SELECT IFNULL(layer1,0) AS layer11,IFNULL(SUBSTRING_INDEX(layer2, '|', 1),0) AS layer21, IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer2, '|', 2), '|', -1),0) AS layer22,IFNULL(SUBSTRING_INDEX(layer3, '|', 1),0) AS layer31,  IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer3, '|', 2), '|', -1),0) AS layer32,  IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer3, '|', 3), '|', -1),0) AS layer33, IFNULL(SUBSTRING_INDEX(layer4, '|', 1),0) AS layer41, IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer4, '|', 2), '|', -1),0) AS layer42, IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer4, '|', 3), '|', -1),0) AS layer43, IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer4, '|', 4), '|', -1),0) AS layer44,  IFNULL(SUBSTRING_INDEX(layer5, '|', 1),0) AS layer51,  IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 2), '|', -1),0) AS layer52, IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 3), '|', -1),0) AS layer53,  IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 4), '|', -1),0) AS layer54,  IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 5), '|', -1),0) AS layer55,id_kat,Nama_kategoriNilai
                                   FROM kategori_nilai WHERE Nama_kategoriNilai = '$kategorigroip' AND id_kat =  5");
                                  if (mysqli_num_rows($row1) === 0) {
                                  ?>
                                    <td> </td>
                                    <?php
                                  } else {
                                    while ($r1 = mysqli_fetch_array($row1)) {
                                    ?>
                                      <td> layer 1 : <?php echo $r1["layer11"]; ?> % <br> <br>
                                        layer 2 : <?php echo $r1["layer21"]; ?> % <br> <?php echo $space, $r1["layer22"]; ?> % <br><br>
                                        layer 3 : <?php echo $r1["layer31"]; ?> % <br> <?php echo $space, $r1["layer32"]; ?> % <br><?php echo $space, $r1["layer33"]; ?> % <br><br>
                                        layer 4 : <?php echo $r1["layer41"]; ?> % <br> <?php echo $space, $r1["layer42"]; ?> % <br><?php echo $space, $r1["layer43"]; ?> % <br> <?php echo $space, $r1["layer44"]; ?> % <br><br>
                                        layer 5 : <?php echo $r1["layer51"]; ?> % <br> <?php echo $space, $r1["layer52"]; ?> % <br><?php echo $space, $r1["layer53"]; ?> % <br> <?php echo $space, $r1["layer54"]; ?> % <br><?php echo $space, $r1["layer55"]; ?> % <br><br>
                                        <a href="main.php?route=kategori&act=edit&ids=<?php echo $j["Nama_kategoriNilai"]; ?>&ids2=<?php echo $r1["id_kat"]; ?>&asal=<?php echo $_GET['asal']; ?>" title="Edit Data"><button class="btn btn-primary btn-sm elevation-2" style="opacity: .7;width:80px"><i class="fa fa-edit"></i> Edit</button></a>

                                        <a href="route/data_kategori/aksi_kategori.php?route=kategori&act=hapus&id=<?php echo $j["Nama_kategoriNilai"]; ?>&ids2=<?php echo $r1["id_kat"]; ?>" title="Hapus Data" onclick="return confirm('Apakah anda yakin ingin menghapus ini ?')"><button class="btn btn-danger btn-sm elevation-2" style="opacity: .7;width:80px"><i class="fa fa-trash"></i> Hapus</button></a>
                                      </td>
                                  <?php }
                                  } ?>
                                  <?php
                                  $row1 = mysqli_query($koneksi, "SELECT IFNULL(layer1,0) AS layer11,IFNULL(SUBSTRING_INDEX(layer2, '|', 1),0) AS layer21, IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer2, '|', 2), '|', -1),0) AS layer22,IFNULL(SUBSTRING_INDEX(layer3, '|', 1),0) AS layer31,  IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer3, '|', 2), '|', -1),0) AS layer32,  IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer3, '|', 3), '|', -1),0) AS layer33, IFNULL(SUBSTRING_INDEX(layer4, '|', 1),0) AS layer41, IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer4, '|', 2), '|', -1),0) AS layer42, IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer4, '|', 3), '|', -1),0) AS layer43, IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer4, '|', 4), '|', -1),0) AS layer44,  IFNULL(SUBSTRING_INDEX(layer5, '|', 1),0) AS layer51,  IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 2), '|', -1),0) AS layer52, IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 3), '|', -1),0) AS layer53,  IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 4), '|', -1),0) AS layer54,  IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 5), '|', -1),0) AS layer55,id_kat,Nama_kategoriNilai
                                   FROM kategori_nilai WHERE Nama_kategoriNilai = '$kategorigroip' AND id_kat =  6");
                                  if (mysqli_num_rows($row1) === 0) {
                                  ?>
                                    <td> </td>
                                    <?php
                                  } else {
                                    while ($r1 = mysqli_fetch_array($row1)) {
                                    ?>
                                      <td> layer 1 : <?php echo $r1["layer11"]; ?> % <br> <br>
                                        layer 2 : <?php echo $r1["layer21"]; ?> % <br> <?php echo $space, $r1["layer22"]; ?> % <br><br>
                                        layer 3 : <?php echo $r1["layer31"]; ?> % <br> <?php echo $space, $r1["layer32"]; ?> % <br><?php echo $space, $r1["layer33"]; ?> % <br><br>
                                        layer 4 : <?php echo $r1["layer41"]; ?> % <br> <?php echo $space, $r1["layer42"]; ?> % <br><?php echo $space, $r1["layer43"]; ?> % <br> <?php echo $space, $r1["layer44"]; ?> % <br><br>
                                        layer 5 : <?php echo $r1["layer51"]; ?> % <br> <?php echo $space, $r1["layer52"]; ?> % <br><?php echo $space, $r1["layer53"]; ?> % <br> <?php echo $space, $r1["layer54"]; ?> % <br><?php echo $space, $r1["layer55"]; ?> % <br><br>
                                        <a href="main.php?route=kategori&act=edit&ids=<?php echo $j["Nama_kategoriNilai"]; ?>&ids2=<?php echo $r1["id_kat"]; ?>&asal=<?php echo $_GET['asal']; ?>" title="Edit Data"><button class="btn btn-primary btn-sm elevation-2" style="opacity: .7;width:80px"><i class="fa fa-edit"></i> Edit</button></a>

                                        <a href="route/data_kategori/aksi_kategori.php?route=kategori&act=hapus&id=<?php echo $j["Nama_kategoriNilai"]; ?>&ids2=<?php echo $r1["id_kat"]; ?>" title="Hapus Data" onclick="return confirm('Apakah anda yakin ingin menghapus ini ?')"><button class="btn btn-danger btn-sm elevation-2" style="opacity: .7;width:80px"><i class="fa fa-trash"></i> Hapus</button></a>
                                      </td>
                                  <?php }
                                  } ?>
                                  <!--<td><a href="main.php?route=kategori&act=edit&ids=<?php echo $j["Nama_kategoriNilai"]; ?>&ids2=<?php echo $r1["id_kat"]; ?>&asal=<?php echo $_GET['asal']; ?>" title="Edit Data"><button class="btn btn-primary btn-sm elevation-2" style="opacity: .7;width:80px"><i class="fa fa-edit"></i> Edit</button></a>

                                    <a href="route/data_kategori/aksi_kategori.php?route=kategori&act=hapus&id=<?php echo $j["Nama_kategoriNilai"]; ?>&ids2=<?php echo $r1["id_kat"]; ?>" title="Hapus Data" onclick="return confirm('Apakah anda yakin ingin menghapus ini ?')"><button class="btn btn-danger btn-sm elevation-2" style="opacity: .7;width:80px"><i class="fa fa-trash"></i> Hapus</button></a>
                                  </td>-->
                                </tr>
                              <?php
                              }
                              ?>
                            </tbody>
                          </table>
                        </div><!-- /.box-body -->
                      </div><!-- /.box -->
                    </div>
                  </section><!-- /.Left col -->
                </div>
              </div>
            </div>
          </div><!-- /.row (main row) -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

    <?php
      break;

      //Form Edit 
    case "edit":

      //edit
      $ubah = mysqli_query($koneksi, "SELECT IFNULL(layer1,0) AS layer11,IFNULL(SUBSTRING_INDEX(layer2, '|', 1),0) AS layer21, IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer2, '|', 2), '|', -1),0) AS layer22,IFNULL(SUBSTRING_INDEX(layer3, '|', 1),0) AS layer31,  IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer3, '|', 2), '|', -1),0) AS layer32,  IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer3, '|', 3), '|', -1),0) AS layer33, IFNULL(SUBSTRING_INDEX(layer4, '|', 1),0) AS layer41, IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer4, '|', 2), '|', -1),0) AS layer42, IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer4, '|', 3), '|', -1),0) AS layer43, IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer4, '|', 4), '|', -1),0) AS layer44,  IFNULL(SUBSTRING_INDEX(layer5, '|', 1),0) AS layer51,  IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 2), '|', -1),0) AS layer52, IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 3), '|', -1),0) AS layer53,  IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 4), '|', -1),0) AS layer54,  IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 5), '|', -1),0) AS layer55,kategori_nilai.id_kat,Nama_kategoriNilai, kategori.nama_kat AS nama
                                   FROM kategori_nilai JOIN kategori ON kategori_nilai.id_kat = kategori.id_kat  WHERE Nama_kategoriNilai = '$_GET[ids]' && kategori_nilai.id_kat = '$_GET[ids2]'  ");
      $u = mysqli_fetch_array($ubah);
    ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="list-gds wow slideInUp" data-wow-duration=".5s" data-wow-delay="1.1s">
                  kategori <small>update</small>
                </h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                  <li class="breadcrumb-item active">Edit kategori</li>
                </ol>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">

              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <!-- right column -->
                  <div class="col-md-12">
                    <!-- general form elements disabled -->
                    <div class="box box-warning">
                      <div class="box-body">

                        <form method="POST" action="route/<?php echo $data; ?>/<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=edit&ids=<?php echo $u["Nama_kategoriNilai"]; ?>" enctype="multipart/form-data">
                          <!-- text input -->
                          <!-- <div class="form-group">
                            <label>ID User</label>
                            <input type="text" name="id" class="form-control" value="<?php echo $u[$f1]; ?>" readonly="readonly" />
                          </div> -->

                          <div class="form-group">
                            <label>Kategori</label>
                            <input type="text" name="<?php echo $f1; ?>" class="form-control" value="<?php echo $u["Nama_kategoriNilai"]; ?>" readonly=" readonly" />
                          </div>

                          <div class=" form-group">
                            <label><?php echo $j2; ?> </label>
                            <input type="text" name="<?php echo $f2; ?>" class="form-control" value="<?php echo $u["layer11"]; ?>" />
                          </div>

                          <label>2 layer</label>
                          <div class="row">
                            <div class="col-sm-2">
                              <div class="form-group">
                                <input type="text" name="<?php echo $f31; ?>" class="form-control" value="<?php echo $u["layer21"]; ?>" />
                              </div>
                            </div>
                            <div class="col-sm-2">
                              <div class="form-group">
                                <input type="text" name="<?php echo $f32; ?>" class="form-control" value="<?php echo $u["layer22"]; ?>" />
                              </div>
                            </div>
                          </div>

                          <label>3 layer</label>
                          <div class="row">
                            <div class="col-sm-2">
                              <div class="form-group">
                                <input type="text" name="<?php echo $f41; ?>" class="form-control" value="<?php echo $u["layer31"]; ?>" />
                              </div>
                            </div>
                            <div class="col-sm-2">
                              <div class="form-group">
                                <input type="text" name="<?php echo $f42; ?>" class="form-control" value="<?php echo $u["layer32"]; ?>" />
                              </div>
                            </div>
                            <div class="col-sm-2">
                              <div class="form-group">
                                <input type="text" name="<?php echo $f43; ?>" class="form-control" value="<?php echo $u["layer33"]; ?>" />
                              </div>
                            </div>
                          </div>

                          <label>4 layer</label>
                          <div class="row">
                            <div class="col-2">
                              <div class="form-group">
                                <input type="text" name="<?php echo $f51; ?>" class="form-control" value="<?php echo $u["layer41"]; ?>" />
                              </div>
                            </div>
                            <div class="col-2">
                              <div class="form-group">
                                <input type="text" name="<?php echo $f52; ?>" class="form-control" value="<?php echo $u["layer42"]; ?>" />
                              </div>
                            </div>
                            <div class="col-2">
                              <div class="form-group">
                                <input type="text" name="<?php echo $f53; ?>" class="form-control" value="<?php echo $u["layer43"]; ?>" />
                              </div>
                            </div>
                            <div class="col-2">
                              <div class="form-group">
                                <input type="text" name="<?php echo $f54; ?>" class="form-control" value="<?php echo $u["layer44"]; ?>" />
                              </div>
                            </div>
                          </div>

                          <label>5 layer</label>
                          <div class="row">
                            <div class="col-2">
                              <div class="form-group">
                                <input type="text" name="<?php echo $f61; ?>" class="form-control" value="<?php echo $u["layer51"]; ?>" />
                              </div>
                            </div>
                            <div class="col-2">
                              <div class="form-group">
                                <input type="text" name="<?php echo $f62; ?>" class="form-control" value="<?php echo $u["layer52"]; ?>" />
                              </div>
                            </div>
                            <div class="col-2">
                              <div class="form-group">
                                <input type="text" name="<?php echo $f63; ?>" class="form-control" value="<?php echo $u["layer53"]; ?>" />
                              </div>
                            </div>
                            <div class="col-2">
                              <div class="form-group">
                                <input type="text" name="<?php echo $f64; ?>" class="form-control" value="<?php echo $u["layer54"]; ?>" />
                              </div>
                            </div>
                            <div class="col-2">
                              <div class="form-group">
                                <input type="text" name="<?php echo $f65; ?>" class="form-control" value="<?php echo $u["layer55"]; ?>" />
                              </div>
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="<?php echo $f7; ?>"><?php echo $j7; ?> </label>
                            <select id="<?php echo $f7; ?>" name="<?php echo $f7; ?>" class="form-control" style="pointer-events: none; background-color: #e9ecef;">
                              <option value="<?php echo $u["id_kat"]; ?>"><?php echo $u["nama"]; ?></option>
                              <option value="1">Retail</option>
                              <option value="2">Grosir</option>
                              <option value="3">Online</option>
                              <option value="4">Member 1</option>
                              <option value="5">Member 2</option>
                              <option value="6">Member 3</option>
                            </select>
                          </div>

                          <div class="form-group">
                            <hr />
                            <input type="submit" class="btn btn-primary elevation-2" style="opacity: .7" value="Update" />
                          </div>
                        </form>
                        <a href="main.php?route=<?php echo $rute; ?>&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=<?php echo $rute; ?>"><button class="btn btn-primary btn-sm elevation-1" style="opacity: .7">Back</button></a>
                      </div><!-- /.box-body -->
                    </div><!-- /.box -->
                  </div><!--/.col (right) -->
                </div> <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->


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