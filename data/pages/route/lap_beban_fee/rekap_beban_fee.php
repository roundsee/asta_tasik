<?php
$login_hash=$_SESSION['login_hash'];
$namauser=$_SESSION['namauser'];

$tujuan=$_GET['tujuan'];

$judulform="Beban Fee";

$data='lap_beban_fee';
$rute='rekap_beban_fee';
$aksi='aksi_beban_fee';

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
                            <div  id="isian2"  style="display: none;">
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
                            <div  id="isian3"  style="display: none;">
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

        // echo "<br/>".$tgl_awal;
        // echo "<br/>".$tgl_akhir;
        // echo "<br/>".$filter;
        // echo "<br/>".$nilai;

    if ($tujuan=='aplikasi') {
      $kondisi2='Aplikasi';
    }elseif($tujuan=='carabayar'){
      $kondisi2='Cara Bayar';
    }elseif($tujuan=='kasir'){
      $kondisi2='Kasir';
    }else{
      $kondisi2='';

    }

if($filter=='kota'){
  $kondisi="AND pelanggan.kd_kota='$nilai' ";
  $kondisi_order=" ORDER BY pelanggan.kd_kota ,  tanggal desc";
  $query=mysqli_query($koneksi,"SELECT nama FROM kotabaru WHERE kode='$nilai' ");
  $q1=mysqli_fetch_array($query);
  $judul_nilai= $q1['nama'];
}elseif($filter=='outlet'){
  $kondisi="AND penjualan.kd_cus='$nilai' ";
  $kondisi_order=" ORDER BY penjualan.kd_cus, tanggal desc";
  $query=mysqli_query($koneksi,"SELECT nama FROM pelanggan WHERE kd_cus='$nilai' ");
  $q1=mysqli_fetch_array($query);
  $judul_nilai= $q1['nama'];
}elseif($filter=='area'){
  $kondisi="AND kotabaru.kd_area='$nilai' ";
  $kondisi_order="ORDER BY kotabaru.kd_area , tanggal desc";
  $query=mysqli_query($koneksi,"SELECT nama FROM area WHERE kode='$nilai' ");
  $q1=mysqli_fetch_array($query);
  $judul_nilai= $q1['nama'];
}else{
  $kondisi='';
  $kondisi_order="ORDER BY tanggal desc";
  $judul_nilai='';
}

    $judul='Rekap '.$judulform.$kondisi2;
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
          <button class="btn btn-primary btn-sm elevation-2 " style="opacity: .7;" onclick="window.location='route/<?php echo $data;?>/cetak_rekap.php?tgl_awal=<?php echo $tgl_awal;?>&tgl_akhir=<?php echo $tgl_akhir;?>&filter=<?php echo $filter;?>&nilai=<?php echo $nilai;?>&judul=<?php echo $judul;?>&tujuan=<?php echo $judul;?>'"><img src="../../assets/icons/print.png" width="20px"> print </button>

          <button class="btn btn-primary btn-sm elevation-2 " style="opacity: .7;" onclick="window.location='route/<?php echo $data;?>/rekap_beban_fee_excel.php?tgl_awal=<?php echo $tgl_awal;?>&tgl_akhir=<?php echo $tgl_akhir;?>&filter=<?php echo $filter;?>&nilai=<?php echo $nilai;?>&judul=<?php echo $judul;?>'"><img src="../../assets/icons/excel2.png" width="20px"> export </button>

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
                              <th style="width:20px;padding-bottom:1px;">No</th>
                              <th style="width:60px;padding-bottom:1px;">Kota</th>
                              <th style="width:160px;padding-bottom:1px;">Outlet</th>
                              <th style="padding-bottom:1px;">Alat Bayar</th>
                              <th style="padding-bottom:1px;">Kode Sub Alat bayar</th>
                              <th style="padding-bottom:1px;">Aplikasi</th>
                              <th style="padding-bottom:1px;">Penjualan<br>+ PB1</th>
                              <th style="padding-bottom:1px;">Penjualan</th>
                              <th style="width:60px ;padding-bottom:1px;">Acuan<br>Fee</th>
                              <th style="padding-bottom:1px;">Tarif<br>Fee (%)</th>
                              <th style="padding-bottom:1px;">Nilai<br>Fee (Rp.)</th>
                            </tr>
                          </thead>
                          <tbody>
                           <?php

                           $query="SELECT penjualan.faktur,penjualan.tanggal,penjualan.subjumlah,penjualan.jumlah,penjualan.byr_tunai,penjualan.byr_non_tunai,penjualan.tarif_fee,penjualan.dasar_fee,penjualan.acuan_fee, 
                           pelanggan.nama as pelanggan_nama ,
                           subalat_bayar.nama as subalatbayar_nama,
                           kotabaru.nama as kotabaru_nama, 
                           alat_bayar.nama as alatbayar_nama,
                           jenis_transaksi.nama as jt_nama,
                           sum(penjualan.jumlah) as rekap_jumlah , 
                           sum(penjualan.subjumlah) as rekap_subjumlah,
                           sum(penjualan.dasar_fee) as rekap_dasar_fee
                           FROM penjualan
                           Join pelanggan ON pelanggan.kd_cus=penjualan.kd_cus
                           Join kotabaru ON kotabaru.kode=pelanggan.kd_kota
                           Join area ON area.kode=kotabaru.kd_area
                           Join alat_bayar ON alat_bayar.kd_alat=penjualan.kd_alatbayar
                           Join subalat_bayar ON subalat_bayar.kdsub_alat=penjualan.kdsub_alatbayar
                           Join jenis_transaksi ON jenis_transaksi.kd_jenis=penjualan.kd_aplikasi
                           WHERE tanggal>='$tgl_awal' AND tanggal <= '$tgl_akhir' +interval 1 day AND 
                           penjualan.no_online=1  $kondisi 
                           Group by pelanggan.kd_kota , penjualan.kdsub_alatbayar ,penjualan.kd_aplikasi
                           ";

                           $sql1=mysqli_query($koneksi,$query);
                           $no=1;
                           $tot_rekap_dasar_fee=0;

                           while($s1=mysqli_fetch_array($sql1))
                           {
                            if ($s1['alatbayar_nama']!='TUNAI'){

                            $rekap_dasar_fee=$s1['rekap_dasar_fee'];
                            $tot_rekap_dasar_fee=$tot_rekap_dasar_fee+round($rekap_dasar_fee,2);
                            ?>
                            <tr align="left">
                              <td><?php echo $no; ?></td>
                              <td><?php echo $s1['kotabaru_nama']; ?></td>
                              <td><?php echo $s1['pelanggan_nama']; ?></td>
                              <td><?php echo $s1['alatbayar_nama']; ?></td>
                              <td><?php echo $s1['subalatbayar_nama']; ?></td>
                              <td><?php echo $s1['jt_nama']; ?></td>
                              <td align="right"><?php echo number_format($s1['rekap_jumlah']); ?></td>
                              <td align="right"><?php echo number_format($s1['rekap_subjumlah']); ?></td>
                              <td align="right"><?php echo $s1['acuan_fee']; ?></td>
                              <td align="right"><?php echo number_format($s1['tarif_fee'],2); ?></td>
                              <td align="right"><?php echo number_format($s1['rekap_dasar_fee']); ?></td>
                              
                            </tr>
                            <?php
                            $no++;

                          }
                        }
                          ?>
                        </tbody>
                        <tfoot>
                          <td colspan="10" align="right">TOTAL</td>
                          <td style="text-align: right;"><?php echo number_format($tot_rekap_dasar_fee);?></td>

                        </tfoot>

                      </table>
                      <hr>

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
          [100, 500, 1000, -1],
          [100, 500, 1000, 'All'],
          ],

      } );
    } );
  </script>


  <?php
  break;

}
}
?>