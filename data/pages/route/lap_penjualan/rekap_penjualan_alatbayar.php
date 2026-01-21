<?php
$login_hash=$_SESSION['login_hash'];
$namauser=$_SESSION['namauser'];

$tujuan=$_GET['tujuan'];

$judulform="Rekap Penjualan Khusus ";

$data='lap_penjualan';
$rute='rekap_penjualan_sage';
$aksi='aksi_rekap_penjualan_sage';

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

    <?php
    include 'wibjs.php';
    ?>

    <?php 
    break;

    case "report";

    $judul=$judulform.$kondisi2;
    $judul2="judul";
    $judul3='Periode : ';


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
                              <th style="width:40px;">No</th>
                              <th style="width:200px;">Outlet</th>
                              <th style="width:200px;">Nama</th>
                              <th style="width: 200px;">Pembayaran</th>


                            </tr>
                          </thead>
                          <tbody>
                           <?php
                           $no=0;

                           // Loop PERTAMA
                           $loop1="SELECT p_nama, sum(rekap_tunai) as total_tunai , sum(rekap_pocer) as total_pocer FROM `penjualan_alatbayar` group by p_nama";
                           $l1=mysqli_query($koneksi,$loop1);
                           // $ll1=mysqli_fetch_array($l1);

                           $loop1_nama=[];
                          $loop1_tunai=[];
                          $loop1_voucher=[];

                          $x=0;
                           while($ll1=mysqli_fetch_array($l1))
                           {
                             $loop1_nama[]=$ll1['p_nama'];
                             $loop1_tunai[]=$ll1['total_tunai'];
                             $loop1_voucher[]=$ll1['total_pocer'];

                             echo $loop1_nama[$x];
                             echo $loop1_tunai[$x];
                             echo $loop1_voucher[$x];
                             $x++;
                           }
                           
                           $array_length = count($loop1_nama);
                          
                           for ($x=0; $x < $array_length ; $x++) { 
                             // code...
                           

                             $query="SELECT * FROM penjualan_alatbayar WHERE p_nama='$loop1_nama[$x]' AND sab_nama!='TUNAI' order by p_nama asc" ;

                             $sql1=mysqli_query($koneksi,$query);
                             // $no=1;
                             ?>

                             <tr align="left">
                              <td><?php echo $no++; ?></td>
                              <td><?php echo $loop1_nama[$x]; ?></td>
                              <td>Kas Outlet</td>
                              <td style="text-align:right;"><?php echo number_format($loop1_tunai[$x]); ?></td>
                            </tr>
                            <tr align="left">
                              <td><?php echo $no++; ?></td>
                              <td><?php echo $loop1_nama[$x]; ?></td>
                              <td>Voucher</td>
                              <td style="text-align:right;"><?php echo number_format($loop1_voucher[$x]); ?></td>
                            </tr>

                            <?php


                            while($s1=mysqli_fetch_array($sql1))
                            {


                              ?>
                              <tr align="left">
                                <td><?php echo $no; ?></td>
                                <td><?php echo $s1['p_nama']; ?></td>
                                <td><?php echo $s1['sab_nama']; ?></td>
                                <!-- <td style="text-align:right;"><?php echo format_rupiah($s1['rekap_tunai']); ?></td> -->
                                <td style="text-align:right;"><?php echo format_rupiah($s1['rekap_non_tunai']); ?></td>
                                <!-- <td style="text-align:right;"><?php echo format_rupiah($s1['rekap_pocer']); ?></td> -->
                              </tr>
                              <?php
                              $no++;

                            }
                          }

                          
                          ?>
                        </tbody>


                      </table>
                      <hr>
                      <?php
                      mysqli_query($koneksi,"DELETE FROM penjualan_alatbayar ");
                      ?>


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