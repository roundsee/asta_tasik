<?php
$login_hash=$_SESSION['login_hash'];
$namauser=$_SESSION['namauser'];

$tujuan=$_GET['tujuan'];

$judulform="Rekap Penjualan ";

$data='lap_penjualan';
$rute='rekap_penjualan';
$aksi='aksi_rekap_penjualan';

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

if ($tujuan=='aplikasi') {
      $kondisi2='Aplikasi';
      $kondisi_group=' ,penjualan.kd_aplikasi';
    }elseif($tujuan=='carabayar'){
      $kondisi2='Sub Alat Bayar';
      $kondisi_group=' ,penjualan.kdsub_alatbayar';
    }elseif($tujuan=='alatbayar'){
      $kondisi2='Alat Bayar';
      $kondisi_group=' ,penjualan.kd_alatbayar';
    }elseif($tujuan=='kasir'){
      $kondisi2='Kasir';
      $kondisi_group=' ,penjualan.oleh';
    }elseif($tujuan=='outlet'){
      $kondisi2='Outlet';
      $kondisi_group=' ,penjualan.kd_cus';
    }elseif($tujuan=='menu'){
      $kondisi2='Menu';
      $kondisi_group=' ,penjualan.kd_cus';
    }else{
      $kondisi2='';
      $kondisi_group='';
    }

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
    $tujuan=$_GET['tujuan'];
    ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper"style="background-color: ghostwhite;">
      <!-- Content Header (Page header) -->
      <section class="content-header  wow fadeInDown" data-wow-duration=".3s" data-wow-delay=".3s" >
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="list-gds">
                <b><?php echo $judulform.$kondisi2 ;?></b> <small>report</small>
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
                        <form role="form" action="route/<?php echo $data;?>/<?php echo $aksi;?>.php?route=<?php echo $rute;?>&act=report&tujuan=<?php echo $tujuan;?>" method="post">
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

                                  <div id="isian0" style="display: none;">
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
                                  <div  id="isian1" style="display: none;">
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
                                                  $data = mysqli_query($koneksi,"SELECT kode,nama,kd_area FROM kotabaru ORDER BY kode ASC");
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
                            <div  id="isian2" style="display: none;">
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
                                                  $data = mysqli_query($koneksi,"SELECT kd_cus,nama,kd_area FROM pelanggan ORDER BY kd_cus ASC");
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
                            <div  id="isian3" style="display: none;">
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
                                                  $data = mysqli_query($koneksi,"SELECT kode,nama FROM area ORDER BY kode ASC");
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

    if($filter=='kota'){
      $kondisi="AND pelanggan.kd_kota='$nilai'";
      $query=mysqli_query($koneksi,"SELECT nama FROM kotabaru WHERE kode='$nilai' ");
      $q1=mysqli_fetch_array($query);
      $judul_nilai= $q1['nama'];
    }elseif($filter=='outlet'){
      $kondisi="AND penjualan.kd_cus='$nilai'";
      $query=mysqli_query($koneksi,"SELECT nama FROM pelanggan WHERE kd_cus='$nilai' ");
      $q1=mysqli_fetch_array($query);
      $judul_nilai= $q1['nama'];
    }elseif($filter=='area'){
      $kondisi="AND kotabaru.kd_area='$nilai'";
      $query=mysqli_query($koneksi,"SELECT nama FROM area WHERE kode='$nilai' ");
      $q1=mysqli_fetch_array($query);
      $judul_nilai= $q1['nama'];
    }else{
      $kondisi="";
      $judul_nilai='';
    }

    $judul=$judulform.$kondisi2;
    $judul2=$filter." : ".$judul_nilai;
    $judul3='Periode : '.$tgl_awal." s/d ".$tgl_akhir;


    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="background-color: beige; max-height: 1400px!important;">
      <!-- <div style="padding:2px"></div> -->
      <!-- Content Header (Page header) -->
      <section class="content-header  wow fadeInDown" data-wow-duration=".3s" data-wow-delay=".3s" >
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="list-gds">
                <b><?php echo $judulform.$kondisi2 ;?></b> <small>report</small>

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
          <button class="btn btn-primary btn-sm elevation-2 " style="opacity: .7;" onclick="window.location='route/<?php echo $data;?>/cetak.php?tgl_awal=<?php echo $tgl_awal;?>&tgl_akhir=<?php echo $tgl_akhir;?>&filter=<?php echo $filter;?>&nilai=<?php echo $nilai;?>&judul=<?php echo $judul;?>&tujuan=<?php echo $tujuan;?>'"><img src="../../assets/icons/print.png" width="20px"> print </button>

          <button class="btn btn-primary btn-sm elevation-2 " style="opacity: .7;" onclick="window.location='route/<?php echo $data;?>/rekap_penjualan_excel.php?tgl_awal=<?php echo $tgl_awal;?>&tgl_akhir=<?php echo $tgl_akhir;?>&filter=<?php echo $filter;?>&nilai=<?php echo $nilai;?>&judul=<?php echo $judul;?>&tujuan=<?php echo $tujuan;?>'"><img src="../../assets/icons/excel2.png" width="20px"> export </button>

          <br><center><h4><?php echo $judul;?>
          <h5><?php echo $judul2;?></h5>
          <?php echo $judul3;?></h4></center> 
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
                              <th rowspan="2" style="text-align:center;vertical-align: middle;font-weight: 800;padding-top: 1px;width: 1%;">No.</th>
                              <th colspan="2" style="text-align:center;font-weight: 800;padding-top: 1px">Outlet</th>
                              <th colspan="2" style="text-align:center;font-weight: 800;padding-top: 1px">Kota</th>
                              <?php
                              if ($tujuan=='aplikasi') {
                                ?>
                                <th colspan="2" style="text-align:center;font-weight: 800;padding-top: 1px">Aplikasi</th>
                                <th rowspan="2" style="text-align:center;vertical-align: middle;font-weight: 800;padding-top: 1px">Penjualan</th>
                                <?php 
                              }elseif ($tujuan=='kasir') {
                                ?>
                                <th rowspan="2" style="text-align:center;vertical-align: middle;font-weight: 800;padding-top: 1px">Kasir</th>
                                <th rowspan="2" style="text-align:center;vertical-align: middle;font-weight: 800;padding-top: 1px">Penjualan</th>
                                <?php
                              }elseif($tujuan=='carabayar'){
                                ?>
                                <th colspan="2" style="text-align:center;font-weight: 800;padding-top: 1px">Sub Alat Bayar</th>
                                <?php
                              }elseif($tujuan=='alatbayar'){
                                ?>
                                <th colspan="2" style="text-align:center;font-weight: 800;padding-top: 1px">Alat Bayar</th>
                                <?php
                              }elseif ($tujuan=='outlet') {
                                ?>
                                <th rowspan="2" style="text-align:center;vertical-align: middle;font-weight: 800;padding-top: 1px">Outlet</th>
                                <th rowspan="2" style="text-align:center;vertical-align: middle;font-weight: 800;padding-top: 1px">Penjualan</th>
                                <?php
                              }
                              ?>

                              <th colspan="3" style="text-align:center;font-weight: 800;padding-top: 1px">Pembayaran</th>
                            </tr>

                            <tr>
                              <th style="width:1%;padding-bottom:1px;">Kode</th>
                              <th style="padding-bottom:1px;">Nama</th>
                              <th style="width:1%;padding-bottom:1px;">Kode</th>
                              <th style="padding-bottom:1px;">Nama</th>

                              <?php
                              if ($tujuan=='aplikasi') {
                                ?>
                                <th style="width:1%;padding-bottom:1px;">Kode</th>
                                <th style="padding-bottom:1px;">Nama</th>
                                <th style="padding-bottom:1px;">Tunai</th>
                                <th style="padding-bottom:1px;">Non Tunai</th>
                                <th style="padding-bottom:1px;">Voucher</th>
                                <?php 
                              }elseif ($tujuan=='kasir') {
                                ?>
                                <th style="padding-bottom:1px;">Tunai</th>
                                <th style="padding-bottom:1px;">Non Tunai</th>
                                <th style="padding-bottom:1px;">Voucher</th>
                                <?php
                              }elseif($tujuan=='carabayar'){
                                ?>
                                <th style="width:1%;padding-bottom:1px;">Kode</th>
                                <th style="padding-bottom:1px;">Nama</th>
                                <th style="padding-bottom:1px;text-align: right;">Tunai</th>
                                <th style="padding-bottom:1px;text-align: right;">Non Tunai</th>
                                <th style="padding-bottom:1px;">Voucher</th>
                                <?php
                              }elseif($tujuan=='alatbayar'){
                                ?>
                                <th style="width:1%;padding-bottom:1px;">Kode</th>
                                <th style="padding-bottom:1px;">Nama</th>
                                <th style="padding-bottom:1px;text-align: right;">Tunai</th>
                                <th style="padding-bottom:1px;text-align: right;">Non Tunai</th>
                                <th style="padding-bottom:1px;">Voucher</th>
                                <?php
                              }elseif ($tujuan=='outlet') {
                                ?>
                                <th style="padding-bottom:1px;">Tunai</th>
                                <th style="padding-bottom:1px;">Non Tunai</th>
                                <th style="padding-bottom:1px;">Voucher</th>
                                <?php
                              }
                              ?>

                            </tr>
                          </thead>
                          <tbody>
                           <?php

                           $query="SELECT penjualan.kd_cus,penjualan.kd_alatbayar ,penjualan.kdsub_alatbayar,penjualan.oleh,pelanggan.kd_kota, 
                           pelanggan.nama as p_nama,
                           kotabaru.nama as kb_nama ,
                           jenis_transaksi.nama as jt_nama,
                           alat_bayar.nama as ab_nama,
                           subalat_bayar.nama as sab_nama,
                           penjualan.kd_aplikasi as ka_kode,
                           sum(penjualan.jumlah) as rekap_jumlah,
                           sum(penjualan.byr_tunai) as rekap_tunai,
                           sum(penjualan.byr_non_tunai) as rekap_non_tunai,
                           sum(penjualan.byr_pocer) as rekap_pocer
                           FROM penjualan 
                           join pelanggan on pelanggan.kd_cus=penjualan.kd_cus
                           join kotabaru on kotabaru.kode=pelanggan.kd_kota
                           join jenis_transaksi on jenis_transaksi.kd_jenis=penjualan.kd_aplikasi
                           join alat_bayar on alat_bayar.kd_alat=penjualan.kd_alatbayar
                           join subalat_bayar on subalat_bayar.kdsub_alat=penjualan.kdsub_alatbayar
                           WHERE tanggal>='$tgl_awal' AND tanggal <= '$tgl_akhir' +interval 1 day $kondisi
                           GROUP By pelanggan.kd_kota,pelanggan.kd_cus $kondisi_group
                           ";

                           $sql1=mysqli_query($koneksi,$query);
                           $no=1;

                           $tot_subjumlah=0;
                           $tot_ppn=0;
                           $tot_jumlah=0;

                           $tot_penjualan=0;
                           $tot_byr_tunai=0;
                           $tot_byr_non_tunai=0;
                           $tot_pocer=0;

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
                              <td><?php echo $s1['kd_cus']; ?></td>
                              <td><?php echo $s1['p_nama']; ?></td>
                              <td><?php echo $s1['kd_kota']; ?></td>
                              <td><?php echo $s1['kb_nama']; ?></td>

                              <?php
                              if ($tujuan=='aplikasi') {
                                ?>
                                <td style="text-align: center;"><?php echo $s1['ka_kode']; ?></td>
                                <td><?php echo $s1['jt_nama']; ?></td>
                                <td style="text-align: right;"><?php echo format_rupiah($s1['rekap_jumlah']);?></td>
                                <td style="text-align: right;"><?php echo format_rupiah($s1['rekap_tunai']);?></td>
                                <td style="text-align: right;"><?php echo format_rupiah($s1['rekap_non_tunai']);?></td>
                                <td style="text-align: right;"><?php echo format_rupiah($s1['rekap_pocer']);?></td>
                                <?php 
                              }elseif ($tujuan=='kasir') {
                                ?>
                                <td><?php echo $s1['oleh']; ?></td>
                                <td style="text-align: right;"><?php echo format_rupiah($s1['rekap_jumlah']);?></td>
                                <td style="text-align: right;"><?php echo format_rupiah($s1['rekap_tunai']);?></td>
                                <td style="text-align: right;"><?php echo format_rupiah($s1['rekap_non_tunai']);?></td>
                                <td style="text-align: right;"><?php echo format_rupiah($s1['rekap_pocer']);?></td>
                                <?php
                              }elseif($tujuan=='carabayar'){
                                ?>
                                <td style="text-align: center;"><?php echo $s1['kdsub_alatbayar']; ?></td>
                                <td><?php echo $s1['sab_nama']; ?></td>
                                <td style="text-align: right;"><?php echo format_rupiah($s1['rekap_tunai']);?></td>
                                <td style="text-align: right;"><?php echo format_rupiah($s1['rekap_non_tunai']);?></td>
                                <td style="text-align: right;"><?php echo format_rupiah($s1['rekap_pocer']);?></td>
                                <?php
                              }elseif($tujuan=='alatbayar'){
                                ?>
                                <td style="text-align: center;"><?php echo $s1['kd_alatbayar']; ?></td>
                                <td><?php echo $s1['ab_nama']; ?></td>
                                <td style="text-align: right;"><?php echo format_rupiah($s1['rekap_tunai']);?></td>
                                <td style="text-align: right;"><?php echo format_rupiah($s1['rekap_non_tunai']);?></td>
                                <td style="text-align: right;"><?php echo format_rupiah($s1['rekap_pocer']);?></td>
                                <?php
                              }elseif ($tujuan=='outlet') {
                                ?>
                                <td><?php echo $s1['p_nama']; ?></td>
                                <td style="text-align: right;"><?php echo format_rupiah($s1['rekap_jumlah']);?></td>
                                <td style="text-align: right;"><?php echo format_rupiah($s1['rekap_tunai']);?></td>
                                <td style="text-align: right;"><?php echo format_rupiah($s1['rekap_non_tunai']);?></td>
                                <td style="text-align: right;"><?php echo format_rupiah($s1['rekap_pocer']);?></td>
                                <?php
                              }
                              ?>

                            </tr>
                            <?php
                            $no++;

                          }
                          ?>
                        </tbody>

                      </table>
                      <hr>

                      <?php 
                      if ($tujuan=='aplikasi'){ ?>
                    

                      <div style="font-weight:600;font-size:135%">
                        SUMMARY REPORT Per APLIKASI
                      </div>

                      <table id="example" class="table table-bordered table-striped" style="width:600px">
                        <thead style="background-color:  lightgray;" class="elevation-2">
                          <th>Uraian</th>
                          <th>Penjualan</th>
                          <th style="text-align:right;">Pembayaran Tunai</th>
                          <th style="text-align:right;">Pembayaran non Tunai</th>
                          <th style="text-align:right;">Pembayaran Voucher</th>
                        </thead>
                        <tbody>
                          <?php 
                          $query="SELECT pelanggan.nama as p_nama,kotabaru.nama as kb_nama ,jenis_transaksi.nama as jt_nama,alat_bayar.nama as ab_nama,subalat_bayar.nama as sab_nama,penjualan.kd_aplikasi as ka_kode,
                           sum(penjualan.jumlah) as rekap_jumlah,
                           sum(penjualan.byr_tunai) as rekap_tunai,
                           sum(penjualan.byr_non_tunai) as rekap_non_tunai,
                           sum(penjualan.byr_pocer) as rekap_pocer
                           FROM penjualan 
                           join pelanggan on pelanggan.kd_cus=penjualan.kd_cus
                           join kotabaru on kotabaru.kode=pelanggan.kd_kota
                           join jenis_transaksi on jenis_transaksi.kd_jenis=penjualan.kd_aplikasi
                           join alat_bayar on alat_bayar.kd_alat=penjualan.kd_alatbayar
                           join subalat_bayar on subalat_bayar.kdsub_alat=penjualan.kdsub_alatbayar
                           WHERE tanggal>='$tgl_awal' AND tanggal <= '$tgl_akhir' +interval 1 day $kondisi
                           GROUP By penjualan.kd_aplikasi
                           ";

                          $sql1=mysqli_query($koneksi,$query);

                          $tot_rekap_jumlah=0;
                          $tot_rekap_tunai=0;
                          $tot_rekap_non_tunai=0;
                          $tot_rekap_pocer=0;

                          while($s1=mysqli_fetch_array($sql1))
                          {
                          $tot_rekap_jumlah=$tot_rekap_jumlah+$s1['rekap_jumlah'];
                          $tot_rekap_tunai=$tot_rekap_tunai+$s1['rekap_tunai'];
                          $tot_rekap_non_tunai=$tot_rekap_non_tunai+$s1['rekap_non_tunai'];
                          $tot_rekap_pocer=$tot_rekap_pocer+$s1['rekap_pocer'];
                            ?>

                            <tr>
                              <td width="200px"><?php echo $s1['jt_nama'];?></td>
                              <td align="right"><?php echo format_rupiah($s1['rekap_jumlah']);?></td>
                              <td align="right"><?php echo format_rupiah($s1['rekap_tunai']);?></td>
                              <td align="right"><?php echo format_rupiah($s1['rekap_non_tunai']);?></td>
                              <td align="right"><?php echo format_rupiah($s1['rekap_pocer']);?></td>
                            </tr>

                            <?php

                          }

                          ?>
                        </tbody>
                        <tr style="font-weight:700">
                          <td width="200px" >Total Rekap </td>
                          <td align="right"><?php echo format_rupiah($tot_rekap_jumlah);?></td>
                              <td align="right"><?php echo format_rupiah($tot_rekap_tunai);?></td>
                              <td align="right"><?php echo format_rupiah($tot_rekap_non_tunai);?></td>
                              <td align="right"><?php echo format_rupiah($tot_rekap_pocer);?></td>
                        </tr>
                      </table>
                    <?php } ?>


                      <div style="font-weight:600;font-size:135%">
                        SUMMARY REPORT SUB ALAT BAYAR
                      </div>

                      <table id="example" class="table table-bordered table-striped" style="width:600px">
                        <thead style="background-color:  lightgray;" class="elevation-2">
                          <th>Uraian</th>
                          <th>Penjualan</th>
                          <th style="text-align:right;">Pembayaran Tunai</th>
                          <th style="text-align:right;">Pembayaran non Tunai</th>
                          <th style="text-align:right;">Pembayaran Voucher</th>
                        </thead>
                        <tbody>
                          <?php 
                          $query="SELECT pelanggan.nama as p_nama,kotabaru.nama as kb_nama ,jenis_transaksi.nama as jt_nama,alat_bayar.nama as ab_nama,subalat_bayar.nama as sab_nama,penjualan.kd_aplikasi as ka_kode,
                           sum(penjualan.jumlah) as rekap_jumlah,
                           sum(penjualan.byr_tunai) as rekap_tunai,
                           sum(penjualan.byr_non_tunai) as rekap_non_tunai,
                           sum(penjualan.byr_pocer) as rekap_pocer
                           FROM penjualan 
                           join pelanggan on pelanggan.kd_cus=penjualan.kd_cus
                           join kotabaru on kotabaru.kode=pelanggan.kd_kota
                           join jenis_transaksi on jenis_transaksi.kd_jenis=penjualan.kd_aplikasi
                           join alat_bayar on alat_bayar.kd_alat=penjualan.kd_alatbayar
                           join subalat_bayar on subalat_bayar.kdsub_alat=penjualan.kdsub_alatbayar
                           WHERE tanggal>='$tgl_awal' AND tanggal <= '$tgl_akhir' +interval 1 day $kondisi
                           GROUP By penjualan.kdsub_alatbayar
                           ";

                          $sql1=mysqli_query($koneksi,$query);

                          $tot_rekap_jumlah=0;
                          $tot_rekap_tunai=0;
                          $tot_rekap_non_tunai=0;
                          $tot_rekap_pocer=0;

                          while($s1=mysqli_fetch_array($sql1))
                          {
                          $tot_rekap_jumlah=$tot_rekap_jumlah+$s1['rekap_jumlah'];
                          $tot_rekap_tunai=$tot_rekap_tunai+$s1['rekap_tunai'];
                          $tot_rekap_non_tunai=$tot_rekap_non_tunai+$s1['rekap_non_tunai'];
                          $tot_rekap_pocer=$tot_rekap_pocer+$s1['rekap_pocer'];
                            ?>

                            <tr>
                              <td width="200px"><?php echo $s1['sab_nama'];?></td>
                              <td align="right"><?php echo format_rupiah($s1['rekap_jumlah']);?></td>
                              <td align="right"><?php echo format_rupiah($s1['rekap_tunai']);?></td>
                              <td align="right"><?php echo format_rupiah($s1['rekap_non_tunai']);?></td>
                              <td align="right"><?php echo format_rupiah($s1['rekap_pocer']);?></td>
                            </tr>

                            <?php

                          }

                          ?>
                        </tbody>
                        <tr style="font-weight:700">
                          <td width="200px" >Total Rekap </td>
                          <td align="right"><?php echo format_rupiah($tot_rekap_jumlah);?></td>
                              <td align="right"><?php echo format_rupiah($tot_rekap_tunai);?></td>
                              <td align="right"><?php echo format_rupiah($tot_rekap_non_tunai);?></td>
                              <td align="right"><?php echo format_rupiah($tot_rekap_pocer);?></td>
                        </tr>
                      </table>

                      <div style="font-weight:600;font-size:135%">
                        SUMMARY REPORT ALAT BAYAR
                      </div>

                      <table id="example" class="table table-bordered table-striped" style="width:600px">
                        <thead style="background-color:  lightgray;" class="elevation-2">
                          <th>Uraian</th>
                          <th>Penjualan</th>
                          <th style="text-align:right;">Pembayaran Tunai</th>
                          <th style="text-align:right;">Pembayaran non Tunai</th>
                          <th style="text-align:right;">Pembayaran Voucher</th>
                        </thead>
                        <tbody>
                          <?php 
                          $query="SELECT pelanggan.nama as p_nama,kotabaru.nama as kb_nama ,jenis_transaksi.nama as jt_nama,alat_bayar.nama as ab_nama,subalat_bayar.nama as sab_nama,penjualan.kd_aplikasi as ka_kode,
                           sum(penjualan.jumlah) as rekap_jumlah,
                           sum(penjualan.byr_tunai) as rekap_tunai,
                           sum(penjualan.byr_non_tunai) as rekap_non_tunai,
                           sum(penjualan.byr_pocer) as rekap_pocer
                           FROM penjualan 
                           join pelanggan on pelanggan.kd_cus=penjualan.kd_cus
                           join kotabaru on kotabaru.kode=pelanggan.kd_kota
                           join jenis_transaksi on jenis_transaksi.kd_jenis=penjualan.kd_aplikasi
                           join alat_bayar on alat_bayar.kd_alat=penjualan.kd_alatbayar
                           join subalat_bayar on subalat_bayar.kdsub_alat=penjualan.kdsub_alatbayar
                           WHERE tanggal>='$tgl_awal' AND tanggal <= '$tgl_akhir' +interval 1 day $kondisi
                           GROUP By penjualan.kd_alatbayar
                           ";

                          $sql1=mysqli_query($koneksi,$query);

                          $tot_rekap_jumlah=0;
                          $tot_rekap_tunai=0;
                          $tot_rekap_non_tunai=0;
                          $tot_rekap_pocer=0;

                          $sub_rekap_jumlah=0;
                          $tot_rekap_penjualan=0;

                          while($s1=mysqli_fetch_array($sql1))
                          {
                          $tot_rekap_jumlah=$tot_rekap_jumlah+$s1['rekap_jumlah'];
                          $tot_rekap_tunai=$tot_rekap_tunai+$s1['rekap_tunai'];
                          $tot_rekap_non_tunai=$tot_rekap_non_tunai+$s1['rekap_non_tunai'];
                          $tot_rekap_pocer=$tot_rekap_pocer+$s1['rekap_pocer'];
                          $sub_rekap_jumlah=$s1['rekap_tunai']+$s1['rekap_non_tunai']+$s1['rekap_pocer'];
                          $tot_rekap_penjualan=$tot_rekap_penjualan+$sub_rekap_jumlah;
                            ?>

                            <tr>
                              <td width="200px"><?php echo $s1['ab_nama'];?></td>
                              <!-- <td align="right"><?php echo format_rupiah($s1['rekap_jumlah']);?></td> -->
                              <td align="right"><?php echo format_rupiah($sub_rekap_jumlah);?></td>
                              <td align="right"><?php echo format_rupiah($s1['rekap_tunai']);?></td>
                              <td align="right"><?php echo format_rupiah($s1['rekap_non_tunai']);?></td>
                              <td align="right"><?php echo format_rupiah($s1['rekap_pocer']);?></td>
                            </tr>

                            <?php

                          }

                          ?>
                        </tbody>
                        <tr style="font-weight:700">
                          <td width="200px" >Total Rekap </td><!-- 
                          <td align="right"><?php echo format_rupiah($tot_rekap_jumlah);?></td> -->
                          
                          <td align="right"><?php echo format_rupiah($tot_rekap_penjualan);?></td>
                              <td align="right"><?php echo format_rupiah($tot_rekap_tunai);?></td>
                              <td align="right"><?php echo format_rupiah($tot_rekap_non_tunai);?></td>
                              <td align="right"><?php echo format_rupiah($tot_rekap_pocer);?></td>
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
    <br>
  </div><!-- /.content-wrapper -->
  

  <script> 
      $(document).ready(function() {
        $('#example').DataTable( {
          lengthMenu: [
            [50, 100, 500, -1],
            [50, 100, 500, 'All'],
            ],

        } );
      } );
    </script>


  <?php
  break;

}
}
?>