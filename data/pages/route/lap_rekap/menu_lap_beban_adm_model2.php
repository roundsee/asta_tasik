<?php

$judulform="Laporan Beban Adm ";

$data='lap_rekap';
$rute='beban_adm';
$aksi='aksi_beban_adm';

$tabel="penjualan";
$f1='faktur';
$f2='tanggal';
$f3='kd_cus';
$f4='kd_aplikasi';
$f5='no_meja';
$f6='oleh';
$f7='subjumlah';
$f8='ppn';
$f9='jumlah';
$f10='byr_pocer';
$f11='byr_tunai';
$f12='byr_non_tunai';
$f13='kd_alatbayar';
$f14='no_urut';
$f15='tahun';
$f16='bulan';
$f17='jam';
$f18='kdsub_alatbayar';
$f19='subjumlah_offline';
$f20='ket_aplikasi';
$f21='dasar_fee';
$f22='acuan_fee';
$f23='tarif_fee';
$f24='b_packing';
$f25='no_online';
$f26='no_ofline';
$f27='tarif_pb1';
$f28='faktur_refund';
$f29='dasar_faktur';

$j1='Faktur';
$j2='Tanggal';
$j3='Kode Outlet';
$j4='kd_aplikasi';
$j5='no_meja';
$j6='oleh';
$j7='Sub jumlah';
$j8='PB1';
$j9='Jumlah';
$j10='byr_pocer';
$j11='byr_tunai';
$j12='byr_non_tunai';
$j13='kd_alatbayar';
$j14='no_urut';
$j15='tahun';
$j16='bulan';
$j17='jam';
$j18='kdsub_alatbayar';
$j19='subjumlah_offline';
$j20='ket_aplikasi';
$j21='dasar_fee';
$j22='acuan_fee';
$j23='tarif_fee';
$j24='b_packing';
$j25='no_online';
$j26='no_ofline';
$j27='tarif_pb1';
$j28='faktur_refund';
$j29='dasar_faktur';


$tabel2='kotabaru';
$ff1='kode';
$tabel3='pelanggan';
$gg1='kd_cus';

//session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
  <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

  switch($_GET['act']){

	//Tampil Data 
    default:
    echo $tujuan=$_GET['tujuan'];
    ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper"style="background-color: ghostwhite;">
      <!-- Content Header (Page header) -->
      <section class="content-header  wow fadeInDown" data-wow-duration=".3s" data-wow-delay=".3s" >
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="list-gds">
                <b><?php echo $judulform.$tujuan ;?></b> <small style="font-weight: 100;">report</small>
              </h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="main.php?route=home">Beranda</a></li>
                <li class="breadcrumb-item active">Laporan</li>
                <li class="breadcrumb-item active"><?php echo $judulform ;?></li>
              </ol>
            </div>
          </div> 
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <!-- <section class="content wow fadeInUp" data-wow-duration=".2s" data-wow-delay=".1s" > -->
        <section class="content wow " >
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
                        <form role="form" action="route/<?php echo $data;?>/<?php echo $aksi;?>.php?route=<?php echo $rute;?>&act=lap_beban_adm_model2&tujuan=<?php echo $tujuan;?>" method="post">
                          <div class="row">
                            <!-- Batas -------------- -->

                            <div class="col-lg-2">

                              <div class="form-group">
                                <label>Tanggal Awal</label>
                                <input type="date" class="form-control" name="tgl_awal" onclick="displayHasil(this.value)"  placeholder="Masukkan Tanggal Awal .. (Wajib)" value="<?php echo date('Y-m-d') ?>"  required="required">
                              </div>

                              <div class="form-group">
                                <label>Tanggal Akhir</label>
                                <input type="date" class="form-control" name="tgl_akhir" onclick="displayHasil(this.value)"  placeholder="Masukkan Tanggal Akhir .. (Wajib)" value="<?php echo date('Y-m-d') ?>"  required="required">
                              </div>
                            </div>

                            <!-- Filter -->
                            <div class="col-lg-2">
                              <!-- <div class="col-lg-12"> -->
                                <div class="form-group">
                                  <label>Filter             
                                  </label>
                                  <div>
                                    <input type="radio" name="cakup" onclick="displayResult(this.value)" value="Semua"> Semua
                                  </div>
                                  <div>
                                    <input type="radio" name="cakup" onclick="displayResult(this.value)" value="Kota"> Kota
                                  </div>
                                  <div>
                                    <input type="radio" name="cakup" onclick="displayResult(this.value)" value="Outlet"> Outlet
                                  </div>
                                  <div>
                                    <input type="radio" name="cakup" onclick="displayResult(this.value)" value="Area"> Area
                                  </div>


                                  <div class="form-group">
                                    <!-- <label>Cakupan terpilih : </label> -->
                                    <input type="text" id="result" required readonly style="width:100;font-size:120%;font-weight:600">
                                  </div>

                                </div>
                                <!-- </div> -->
                              </div>
                              <!-- Filter -->


                              <!-- Filter Isian-------------- -->

                              <div class="col-lg-3">
                                <div class="row">

                                  <div id="isian0">
                                    <div class="row" style="height:133px">
                                      <div class="col-lg-7">
                                        <div class="form-group">
                                          <form method="post" action="simpan_index.php?act=proses2"  >
                                          </form>
                                        </div>
                                      </div>

                                    </div>
                                  </div>

                                  <!-- Show Utk Kota -->
                                  <div  id="isian1">
                                    <div class="row">
                                      <div class="col-lg-10">
                                        <div class="form-group">
                                          <form method="post" action="simpan_index.php"  >
                                            <div class="row">
                                              <div class="col-lg-7">

                                                <label>Kode Kota</label>
                                                <!-- <input type="hidden" class="form-control" name="kota" required="required" id="tampil_kota_id"> -->
                                                <input type="text" class="form-control" required="required" id="tampil_kota_kode" placeholder="Isi Kode Kota">
                                              </div>
                                              <div class="col-lg-5">
                                                <button style="margin-top: 27px" type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#cariKota">
                                                  <i class="fa fa-search"></i> Cari Kota
                                                </button>
                                              </div>
                                            </div>

                                            <label>Kota <span id="status_kota"></span></label>
                                            <input type="text" class="form-control" name="kota"  value="" required="required" placeholder="Nama Kota .." id="tampil_kota_nama" readonly>

                                      <!-- <div class="form-group">
                                        <hr />
                                        <input type="submit" class="btn btn-primary elevation-2" style="opacity: .7" value="Add Kota" disabled />
                                      </div> -->
                                    </form>
                                  </div>  
                                </div>

                                <div class="col-lg-5">
                                  <div class="form-group">
                                    <!-- <button style="margin-top: 27px" type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#cariKota">
                                      <i class="fa fa-search"></i> Cari Kota
                                    </button> -->

                                    <!-- Modal KOTA-->
                                    <div class="modal fade" id="cariKota" tabindex="-1" role="dialog" aria-labelledby="cariKotaLabel" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            Data KOTA
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;&nbsp; Close</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">

                                            <div class="table-responsive">
                                              <table class="table table-bordered table-striped table-hover" id="table-datatable-kota">
                                                <thead>
                                                  <tr>
                                                    <th class="text-center">NO</th>
                                                    <th>KODE KOTA</th>
                                                    <th>NAMA KOTA</th>
                                                    <th>KD AREA</th>
                                                    <th></th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                  <?php 
                                                  $no=1;
                                                  $data = mysqli_query($koneksi,"SELECT * FROM kotabaru ORDER BY kode ASC");
                                                  while($d = mysqli_fetch_array($data)){
                                                    ?>
                                                    <tr>
                                                      <td width="1%" class="text-center"><?php echo $no++; ?></td>
                                                      <td width="3%"><?php echo $d['kode']; ?></td>
                                                      <td><?php echo $d['nama']; ?></td>
                                                      <td width="1%" class="text-center"><?php echo $d['kd_area']; ?></td>
                                                      <td width="1%">              
                                                        <button type="button" class="btn btn-success btn-sm modal-pilih-kota" id="<?php echo $d['kode']; ?>" kode="<?php echo $d['kode']; ?>" nama="<?php echo $d['nama']; ?>" data-dismiss="modal">Pilih</button>
                                                      </td>
                                                    </tr>
                                                    <?php 
                                                  }
                                                  ?>
                                                </tbody>
                                              </table>
                                            </div>

                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <!-- Modal KOTA End-->

                                  </div>  
                                </div>
                              </div>
                            </div>
                            <!-- Show Utk Kota End-->

                            <!-- Show utk Outlet -->
                            <div  id="isian2">
                              <div class="row">
                                <div class="col-lg-10">
                                  <div class="form-group">
                                    <form method="post" action="simpan_index.php"  > 
                                      <div class="row">
                                        <div class="col-lg-7">

                                          <label>Kode Outlet</label>
                                          <!-- <input type="hidden" class="form-control" name="outlet" required="required" id="tampil_outlet_id"> -->
                                          <input type="text" class="form-control" name="kd_outlet" required="required" id="tampil_outlet_kode" placeholder="Isi Kode Outlet">
                                        </div>
                                        <div class="col-lg-5">
                                          <button style="margin-top: 27px" type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#cariOutlet">
                                            <i class="fa fa-search"></i> Cari Outlet
                                          </button>
                                        </div>
                                      </div>

                                      <label>Outlet <span id="status_outlet"></span></label>
                                      <input type="text" class="form-control" nama="outlet" value="" required="required" placeholder="Nama Outlet .." id="tampil_outlet_nama" readonly>

                                      <!-- <div class="form-group">
                                        <hr />
                                        <input type="submit" class="btn btn-primary elevation-2" style="opacity: .7" value="Add Outlet" disabled />
                                      </div> -->
                                    </form>
                                  </div>  
                                </div>

                                <div class="col-lg-5">
                                  <div class="form-group">
                                    <!-- <button style="margin-top: 27px" type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#cariOutlet">
                                      <i class="fa fa-search"></i> Cari Outlet
                                    </button> -->

                                    <!-- Modal OUTLET-->
                                    <div class="modal fade" id="cariOutlet" tabindex="-1" role="dialog" aria-labelledby="cariOutletLabel" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            Data OUTLET
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;&nbsp; Close</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">

                                            <div class="table-responsive">
                                              <table class="table table-bordered table-striped table-hover" id="table-datatable-outlet">
                                                <thead>
                                                  <tr>
                                                    <th class="text-center">NO</th>
                                                    <th>KODE OUTLET</th>
                                                    <th>NAMA OUTLET</th>
                                                    <th>KD AREA</th>
                                                    <th></th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                  <?php 
                                                  $no=1;
                                                  $data = mysqli_query($koneksi,"SELECT * FROM pelanggan ORDER BY kd_cus ASC");
                                                  while($d = mysqli_fetch_array($data)){
                                                    ?>
                                                    <tr>
                                                      <td width="1%" class="text-center"><?php echo $no++; ?></td>
                                                      <td width="3%"><?php echo $d['kd_cus']; ?></td>
                                                      <td><?php echo $d['nama']; ?></td>
                                                      <td width="1%" class="text-center"><?php echo $d['kd_area']; ?></td>
                                                      <td width="1%">              
                                                        <button type="button" class="btn btn-success btn-sm modal-pilih-outlet" id="<?php echo $d['kd_cus']; ?>" kode="<?php echo $d['kd_cus']; ?>" nama="<?php echo $d['nama']; ?>" data-dismiss="modal">Pilih</button>
                                                      </td>
                                                    </tr>
                                                    <?php 
                                                  }
                                                  ?>
                                                </tbody>
                                              </table>
                                            </div>

                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <!-- Modal OUTLET End-->

                                  </div>  
                                </div>
                              </div>
                            </div>
                            <!-- Show utk Outlet End -->

                            <!-- Show utk Area -->
                            <div  id="isian3">
                              <div class="row">
                                <div class="col-lg-10">
                                  <div class="form-group">
                                    <form method="post" action="simpan_index.php"  > 

                                      <div class="row">
                                        <div class="col-lg-7">
                                          <label>Kode Area</label>
                                          <!-- <input type="hidden" class="form-control" name="area" required="required" id="tampil_area_id"> -->
                                          <input type="text" class="form-control" required="required" id="tampil_area_kode" placeholder="Isi Kode area">
                                        </div>
                                        <div class="col-lg-5">

                                          <button style="margin-top: 27px" type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#cariArea">
                                            <i class="fa fa-search"></i> Cari Area
                                          </button>
                                        </div>
                                      </div>

                                      <label>Area <span id="status_area"></span></label>
                                      <input type="text" class="form-control" nama="area" value="" required="required" placeholder="Nama Area .." id="tampil_area_nama" readonly>

                                      <!-- <div class="form-group">
                                        <hr />
                                        <input type="submit" class="btn btn-primary elevation-2" style="opacity: .7" value="Add Outlet" disabled />
                                      </div> -->
                                    </form>
                                  </div>  
                                </div>

                                <div class="col-lg-5">
                                  <div class="form-group">
                                    <!-- <button style="margin-top: 27px" type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#cariArea">
                                      <i class="fa fa-search"></i> Cari Area
                                    </button> -->

                                    <!-- Modal Area-->
                                    <div class="modal fade" id="cariArea" tabindex="-1" role="dialog" aria-labelledby="cariAreaLabel" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            Data AREA
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;&nbsp; CLose</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">

                                            <div class="table-responsive">
                                              <table class="table table-bordered table-striped table-hover" id="table-datatable-area">
                                                <thead>
                                                  <tr>
                                                    <th class="text-center">NO</th>
                                                    <th>KODE AREA</th>
                                                    <th>NAMA AREA</th>
                                                    <th></th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                  <?php 
                                                  $no=1;
                                                  $data = mysqli_query($koneksi,"SELECT * FROM area ORDER BY kode ASC");
                                                  while($d = mysqli_fetch_array($data)){
                                                    ?>
                                                    <tr>
                                                      <td width="1%" class="text-center"><?php echo $no++; ?></td>
                                                      <td width="3%"><?php echo $d['kode']; ?></td>
                                                      <td><?php echo $d['nama']; ?></td>
                                                      <td width="1%">              
                                                        <button type="button" class="btn btn-success btn-sm modal-pilih-area" id="<?php echo $d['kode']; ?>" kode="<?php echo $d['kode']; ?>" nama="<?php echo $d['nama']; ?>" data-dismiss="modal">Pilih</button>
                                                      </td>
                                                    </tr>
                                                    <?php 
                                                  }
                                                  ?>
                                                </tbody>
                                              </table>
                                            </div>

                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <!-- Modal Area End-->

                                  </div>  
                                </div>
                              </div>
                            </div>
                            <!-- Show utk Area End -->


                          </div>

                            <!-- <div class="row">
                              <div class="col-lg-12">
                                <div class="form-group">
                                  <label>Keterangan</label>
                                  <textarea type="text" class="form-control" name="keterangan" onclick="displayHasil(this.value)"  placeholder="Keterangan"></textarea>
                                </div>  
                              </div>
                            </div> -->
                          </div>

                          <!-- Filter Isian -->



                          <!-- Generate -->
                          <div class="col-lg-3">

                            <div class="row">
                              <div class="col-lg-12">
                                <!-- <div class="form-group">
                                  <label>Jumlah Voucher</label>
                                  <input type="text" class="form-control" name="jmlvoucher" placeholder="jumlah voucher" required="required">
                                </div>  -->
                                <input type="hidden" name="kota" id="tampil_kota_id">
                                <input type="hidden" name="outlet" id="tampil_outlet_id">
                                <input type="hidden" name="area" id="tampil_area_id">

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

                    <hr/>

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
      function displayHasil(tgl_awal){ 
        document.getElementById("tgl_awalHasil").value=tgl_awal; 
      };

    </script>

    <script type="text/javascript">
      jQuery(document).ready(function(event) {
        var x0 = document.getElementById("isian0");
        var x1 = document.getElementById("isian1");
        var x2 = document.getElementById("isian2");
        var x3 = document.getElementById("isian3");

        x0.style.display = "none";
        x1.style.display = "none";
        x2.style.display = "none";
        x3.style.display = "none";

      });

    </script>

    <!-- Cakupan ========== -->
    <script>
      function displayResult(cakup){ 
        document.getElementById("result").value=cakup;
        var x=document.getElementById("result").value;  
        var x0 = document.getElementById("isian0");
        var x1 = document.getElementById("isian1");
        var x2 = document.getElementById("isian2");
        var x3 = document.getElementById("isian3");
        if (x=="Semua"){
          x0.style.display = "block";
          x1.style.display = "none";
          x2.style.display = "none";
          x3.style.display = "none";
            // alert(x + " adalah Filter 2");
          }else if(x=="Kota"){
            x0.style.display = "none";
            x1.style.display = "block";
            x2.style.display = "none";
            x3.style.display = "none";
            // alert(x + " adalah Filter 3");
          }
          else if(x=="Outlet"){
            x0.style.display = "none";
            x1.style.display = "none";
            x2.style.display = "block";
            x3.style.display = "none";
            // alert(x + " adalah Filter 4");
          }
          else if(x=="Area"){
            x0.style.display = "none";
            x1.style.display = "none";
            x2.style.display = "none";
            x3.style.display = "block";
            // alert(x + " adalah Filter 4");
          }
        }

      </script>
      <!-- Cakupan ========== -->

      <script type="text/javascript">
        <?php 
        if(isset($_GET['alert'])){
          if($_GET['alert'] == "gagal"){
            echo "<div class='alert alert-danger'>File yang diperbolehkan hanya file gambar!</div>";
          }elseif($_GET['alert'] == "duplikat"){
            echo "<div class='alert alert-danger'><b>Kode Barang</b> sudah pernah digunakan!</div>";
          }
        }
        ?>
      </script>

      <?php 
      break;

      case "report";


      $tgl_awal=$_GET['tgl_awal'];
      $tgl_akhir=$_GET['tgl_akhir'];
      $filter=$_GET['filter'];
      $nilai=$_GET['nilai'];

        // echo "<br/>".$tgl_awal;
        // echo "<br/>".$tgl_akhir;
        // echo "<br/>".$filter;
        // echo "<br/>".$nilai;

      if($filter=='kota'){
        $kondisi="AND pelanggan.kd_kota='$nilai'";
        $query=mysqli_query($koneksi,"SELECT * FROM kotabaru WHERE kode='$nilai' ");
        $q1=mysqli_fetch_array($query);
        $judul_nilai= $q1['nama'];
      }elseif($filter=='outlet'){
        $kondisi="AND penjualan.kd_cus='$nilai'";
        $query=mysqli_query($koneksi,"SELECT * FROM pelanggan WHERE kd_cus='$nilai' ");
        $q1=mysqli_fetch_array($query);
        $judul_nilai= $q1['nama'];
      }elseif($filter=='area'){
        $kondisi="AND kotabaru.kd_area='$nilai'";
        $query=mysqli_query($koneksi,"SELECT * FROM area WHERE kode='$nilai' ");
        $q1=mysqli_fetch_array($query);
        $judul_nilai= $q1['nama'];
      }else{
        $kondisi="";
        $judul_nilai='';
      }

      ?>

      <link rel="stylesheet"  href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link rel="stylesheet"  href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">

      
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper" style="background-color: beige; max-height: 1400px!important;">
        <!-- <div style="padding:2px"></div> -->
        <!-- Content Header (Page header) -->
        <section class="content-header  wow fadeInDown" data-wow-duration=".3s" data-wow-delay=".3s" >
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="list-gds">
                  <b><?php echo $judulform ;?></b> <small style="font-weight: 100;">report</small>

                </h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="main.php?route=home">Beranda</a></li>
                  <li class="breadcrumb-item active">Laporan</li>
                  <li class="breadcrumb-item active"><?php echo $judulform ;?></li>
                </ol>
              </div>

            </div>
            <button class="btn btn-primary btn-sm elevation-2 " style="opacity: .7;" onclick="window.location='route/<?php echo $data;?>/cetak.php?tgl_awal=<?php echo $tgl_awal;?>&tgl_akhir=<?php echo $tgl_akhir;?>&filter=<?php echo $filter;?>&nilai=<?php echo $nilai;?>'"><i class="fa fa-plus";></i> Cetak PB1</button>

            <br><center><h4>Laporan Omset dan PB1
              <br><?php echo $filter." : ".$judul_nilai;?>
              <!-- <br><?php echo $q1['nama'];?> -->
              <br/>Periode : <?php echo $tgl_awal." s/d ".$tgl_akhir;?></h4></center> 
            </div><!-- /.container-fluid -->
          </section>

          <!-- Main content -->
          <section class="content wow fadeInUp" data-wow-duration=".2s" data-wow-delay=".1s" >
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

                            <div style="margin:10px"></div>

                            <table id="example" class="table table-bordered table-striped">
                              <thead style="background-color:  lightgray;" class="elevation-2">
                                <tr>
                                  <th>No.</th>
                                  <th><?php echo $j3; ?></th>
                                  <th>Nama Outlet</th>
                                  <th>Kode Kota</th>
                                  <th>Nama Kota</th>
                                  <th><?php echo $j2; ?></th>
                                  <th><?php echo $j1; ?></th>
                                  <th>Ket Aplikasi</th>
                                  <th>Kode Aplikasi</th>
                                  <th>Nama Aplikasi</th>
                                  <th><?php echo $j7; ?></th>
                                  <th><?php echo $j8; ?></th>
                                  <th><?php echo $j9; ?></th>
                                </tr>
                              </thead>
                              <tbody>
                               <?php

                            //  if($filter=='kota'){
                            //   $kondisi="AND pelanggan.kd_kota='$nilai'";
                            // }elseif($filter=='outlet'){
                            //   $kondisi="AND penjualan.kd_cus='$nilai'";
                            // }elseif($filter=='area'){
                            //   $kondisi="AND kotabaru.kd_area='$nilai'";
                            // }else{
                            //   $kondisi="";
                            // }

                               $query="SELECT * , pelanggan.nama as p_nama,kotabaru.nama as kb_nama ,jenis_transaksi.nama as jt_nama
                               FROM penjualan 
                               join pelanggan on pelanggan.kd_cus=penjualan.kd_cus
                               join kotabaru on kotabaru.kode=pelanggan.kd_kota
                               join jenis_transaksi on jenis_transaksi.kd_jenis=penjualan.kd_aplikasi
                               WHERE tanggal>='$tgl_awal' AND tanggal <= '$tgl_akhir' $kondisi ";



                               $sql1=mysqli_query($koneksi,$query);
                               $no=1;

                               $tot_subjumlah=0;
                               $tot_ppn=0;
                               $tot_jumlah=0;

                               $tot_11=0;
                               $tot_22=0;
                               $tot_33=0;
                               $tot_44=0;

                               $tot_ofline=0;
                               $tot_online=0;


                               while($s1=mysqli_fetch_array($sql1))
                               {
                                ?>
                                <tr align="left">
                                  <td><?php echo $no; ?></td>
                                  <td><?php echo $s1[$f3]; ?></td>
                                  <td><?php echo $s1['p_nama']; ?></td>
                                  <td><?php echo $s1['kd_kota']; ?></td>
                                  <td><?php echo $s1['kb_nama']; ?></td>
                                  <td><?php echo $s1[$f2]; ?></td>
                                  <td><?php echo $s1[$f1]; ?></td>
                                  <td><?php echo $s1[$f20]; ?></td>
                                  <td style="text-align: center;"><?php echo $s1[$f4]; ?></td>
                                  <td><?php echo $s1['jt_nama']; ?></td>
                                  <td style="text-align: right;"><?php echo number_format($s1[$f7]);?></td>
                                  <td style="text-align: right;"><?php echo number_format($s1[$f8]);?></td>
                                  <td style="text-align: right;"><?php echo number_format($s1[$f9]);?></td>

                                </tr>
                                <?php
                                $no++;
                                $tot_subjumlah=$tot_subjumlah+$s1[$f7];
                                $tot_ppn=$tot_ppn+$s1[$f8];
                                $tot_jumlah=$tot_jumlah+$s1[$f9];

                                if($s1[$f4]=='11'){
                                  $tot_11++;
                                }
                                if($s1[$f4]=='22'){
                                  $tot_22++;
                                }
                                if($s1[$f4]=='33'){
                                  $tot_33++;
                                }
                                if($s1[$f4]=='44'){
                                  $tot_44++;
                                }

                                $tot_online=$tot_22+$tot_33+$tot_44;
                                $tot_ofline=$tot_11;

                              }
                              ?>
                            </tbody>
                            <tfoot>
                              <tr style="font-weight:800">
                                <td colspan="10" style="text-align:right;"> Total :</td>
                                <td><?php echo number_format($tot_subjumlah);?></td>
                                <td><?php echo number_format($tot_ppn);?></td>
                                <td><?php echo number_format($tot_jumlah);?></td>
                              </tr>
                            </tfoot>

                          </table>
                          <hr>
                          <div>
                            SUMMARY REPORT
                          </div>
                          <table style="background-color:beige;font-weight:700">
                            <tr>
                              <td style="width:200px"> Total</td>
                              <td style="width:30px">:</td>
                              <td style="text-align:right;"><?php echo number_format($tot_subjumlah);?></td>
                            </tr>
                            <tr>
                              <td> Total PB1</td>
                              <td>:</td>
                              <td style="text-align:right;"><?php echo number_format($tot_ppn);?></td>
                            </tr>

                            <tr>
                              <td> Total setelah Pajak</td>
                              <td>:</td>
                              <td style="text-align:right;"><?php echo number_format($tot_jumlah);?></td>
                            </tr>

                            <tr>
                              <td>.</td>
                            </tr>

                            <tr>
                              <td>Total OFF Line </td>
                              <td>:</td>
                              <td><?php echo $tot_ofline;?></td>
                            </tr>
                            <tr>
                              <td>Total ON Line </td>
                              <td>:</td>
                              <td><?php echo $tot_online;?></td>
                            </tr>
                            <tr>
                              <td>.</td>
                            </tr>
                            <tr>
                              <td>Total Dine In</td>
                              <td>:</td>
                              <td><?php echo $tot_11;?></td>
                            </tr>
                            <tr>
                              <td>Total Aplikasi Shoppe</td>
                              <td>:</td>
                              <td><?php echo $tot_22;?></td>
                            </tr>
                            <tr>
                              <td>Total Aplikasi Grab</td>
                              <td>:</td>
                              <td><?php echo $tot_33;?></td>
                            </tr>
                            <tr>
                              <td>Total Aplikasi GoJek</td>
                              <td>:</td>
                              <td><?php echo $tot_44;?></td>
                            </tr>

                            
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


    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
 
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>

    
  

    <script> 
        $(document).ready(function() {
            $('#example').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            } );
        } );
    </script>



      <script>
        function isi_otomatis(){
          var <?php echo $f1;?> = $("#<?php echo $f1;?>").val();
          $.ajax({
            url: 'ajax.php',
            data:"<?php echo $f1;?>="+<?php echo $f1;?> ,
          }).success(function (data) {
            var json = data,
            obj = JSON.parse(json);
            $('#<?php echo $f2;?>').val(obj.<?php echo $f2;?>);

          });
        }
      </script>

      <script>

        function konfirmasi(){
          konfirmasi=confirm("Apakah anda yakin ingin menghapus gambar ini?")
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


<?php
break;

}
}
?>