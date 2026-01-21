
<?php 

session_start();
$dir='../../';
include_once '../../../../config/koneksi.php'; 
include '../../../../config/fungsi_rupiah.php';

// $tgl=date("Y-m-d");
// $tgl=date("2022-04-16");
$tgl=date('Y-m-d');

$kd_aplikasi=$_POST['kd_aplikasi'];
$_SESSION['kd_aplikasi']=$kd_aplikasi;
$kd_aplikasi=$_SESSION['kd_aplikasi'];
$kd_kota=$_SESSION['kd_kota'];
$kd_cus=$_SESSION['kd_cus'];

// print_r($_SESSION);
// echo $kd_aplikasi;

?>

<style type="text/css">
  .col-sm-2{
    width: 19%;
  }
</style>

<input type="hidden" name="kd_aplikasi" value="<?php echo $kd_aplikasi;?>">
<div class="filter-container p-0 row" style="height:186px!important;">

  <?php

  if(!empty($_POST["kd_aplikasi"]))
  { 
    ?>
    <div id="makanan">

      <?php

      $data = mysqli_query($koneksi,"SELECT bk.kd_brg,bk.kd_kota,bk.harga,bk.kd_aplikasi,b.nama,b.kd_subgrup,b.kd_grup,b.photo FROM barang_kota as bk RIGHT JOIN barang as b ON bk.kd_brg=b.kd_brg WHERE 
        bk.kd_kota='$kd_kota'  AND 
        bk.kd_aplikasi='$kd_aplikasi'  AND b.kd_grup='01-01' AND 
        b.nama!=''  
        ORDER BY b.nama ");

  // $d = mysqli_fetch_array($data);
  // print_r($d);

      while($d = mysqli_fetch_array($data)){

        $data1=mysqli_query($koneksi,"SELECT * FROM tarif_diskon
          WHERE
          tgl_awal<= '$tgl' AND
          tgl_akhir>= '$tgl' AND
          kd_jenis = '$kd_aplikasi' AND
          (cakupan = 'Nasional' OR kd_kota = '$kd_kota' OR kd_cus = '$kd_cus' ) AND
          (kd_brg = 'Semua' OR kd_brg = '$d[kd_brg]' ) 
          ORDER BY diskon ");


        $d1 = mysqli_fetch_array($data1);

    // print_r($d1);

        if ($d1==null){
          $disc=0;
          $kd_promo='';
        }else{
          if($d1['ket']=='Persen'){
            $disc=($d1['diskon']/100)*$d['harga'];
            $kd_promo=$d1['kd_promo'];
          }else{
            $disc=$d1['diskon'];
            $kd_promo=$d1['kd_promo'];
          }
        }

        ?>
        <div class="filtr-item col-sm-2" style="padding-left: 15px;padding-right: 1px;padding-top: 1px;" >    
          <div class="menupilihan">
            <input type="hidden" id="kode_<?php echo $d['kd_brg']; ?>" value="<?php echo $d['kd_brg']; ?>">
            <input type="hidden" id="nama_<?php echo $d['kd_brg']; ?>" value="<?php echo $d['nama']; ?>">
            <input type="hidden" id="harga_<?php echo $d['kd_brg']; ?>" value="<?php echo $d['harga']; ?>">
            <input type="hidden" id="diskon_<?php echo $d['kd_brg']; ?>" value="<?php echo $disc; ?>">
            <input type="hidden" id="kd_promo_<?php echo $d['kd_brg']; ?>" value="<?php echo $kd_promo; ?>">
            <input type="hidden" id="ket_<?php echo $d['kd_brg']; ?>" value="">

            <a class="modal-pilih-produk" id="<?php echo $d['kd_brg']; ?>" data-dismiss="modal"><img src="<?php echo $dir;?>images/menu/<?php echo $d['photo'];?>" class="img-fluid mb-2" alt="upload picture"  style="width: 80px;" id="tombol-tambahkan"/>
              <div class="menunama ">
                <?php echo $d['nama'];?>
              </div>
              <p class="menuharga_1">
                Rp. <?php echo format_rupiah($d['harga']);?>
              </p>

              <?php
              ?>

            </a>
          </div>
        </div>
        <?php 

      } // END WHILE


      ?>
    </div>
    <?php


    ?>
    <div id="minuman">

      <?php

      $data = mysqli_query($koneksi,"SELECT bk.kd_brg,bk.kd_kota,bk.harga,bk.kd_aplikasi,b.nama,b.kd_subgrup,b.kd_grup,b.photo FROM barang_kota as bk RIGHT JOIN barang as b ON bk.kd_brg=b.kd_brg WHERE 
        bk.kd_kota='$kd_kota'  AND 
        bk.kd_aplikasi='$kd_aplikasi'   AND b.kd_grup='01-02' AND 
        b.nama!='' 
        ORDER BY b.nama ");

  // $d = mysqli_fetch_array($data);
  // print_r($d);

      while($d = mysqli_fetch_array($data)){

        $data1=mysqli_query($koneksi,"SELECT * FROM tarif_diskon
          WHERE
          tgl_awal<= '$tgl' AND
          tgl_akhir>= '$tgl' AND
          kd_jenis = '$kd_aplikasi' AND
          (cakupan = 'Nasional' OR kd_kota = '$kd_kota' OR kd_cus = '$kd_cus' ) AND
          (kd_brg = 'Semua' OR kd_brg = '$d[kd_brg]' ) 
          ORDER BY diskon ");


        $d1 = mysqli_fetch_array($data1);

    // print_r($d1);

        if ($d1==null){
          $disc=0;
          $kd_promo='';
        }else{
          if($d1['ket']=='Persen'){
            $disc=($d1['diskon']/100)*$d['harga'];
            $kd_promo=$d1['kd_promo'];
          }else{
            $disc=$d1['diskon'];
            $kd_promo=$d1['kd_promo'];
          }
        }

        ?>
        <div class="filtr-item col-sm-2" style="padding-left: 15px;padding-right: 1px;padding-top: 1px;" >    
          <div class="menupilihan">
            <input type="hidden" id="kode_<?php echo $d['kd_brg']; ?>" value="<?php echo $d['kd_brg']; ?>">
            <input type="hidden" id="nama_<?php echo $d['kd_brg']; ?>" value="<?php echo $d['nama']; ?>">
            <input type="hidden" id="harga_<?php echo $d['kd_brg']; ?>" value="<?php echo $d['harga']; ?>">
            <input type="hidden" id="diskon_<?php echo $d['kd_brg']; ?>" value="<?php echo $disc; ?>">
            <input type="hidden" id="kd_promo_<?php echo $d['kd_brg']; ?>" value="<?php echo $kd_promo; ?>">
            <input type="hidden" id="ket_<?php echo $d['kd_brg']; ?>" value="">

            <a class="modal-pilih-produk" id="<?php echo $d['kd_brg']; ?>" data-dismiss="modal"><img src="<?php echo $dir;?>images/menu/<?php echo $d['photo'];?>" class="img-fluid mb-2" alt="upload picture"  style="width: 80px;" id="tombol-tambahkan"/>
              <div class="menunama ">
                <?php echo $d['nama'];?>
              </div>
              <p class="menuharga_1">
                Rp. <?php echo format_rupiah($d['harga']);?>
              </p>

              <?php
              ?>

            </a>
          </div>
        </div>

        <?php 

      } // END WHILE

      ?>
    </div>
    <?php


    ?>
    <div id="paket">

      <?php

      $data = mysqli_query($koneksi,"SELECT bk.kd_brg,bk.kd_kota,bk.harga,bk.kd_aplikasi,b.nama,b.kd_subgrup,b.kd_grup,b.photo FROM barang_kota as bk RIGHT JOIN barang as b ON bk.kd_brg=b.kd_brg WHERE 
        bk.kd_kota='$kd_kota'  AND 
        bk.kd_aplikasi='$kd_aplikasi'  AND b.kd_grup='01-03' AND 
        b.nama!='' 
        ORDER BY b.nama ");

  // $d = mysqli_fetch_array($data);
  // print_r($d);

      while($d = mysqli_fetch_array($data)){

        $data1=mysqli_query($koneksi,"SELECT * FROM tarif_diskon
          WHERE
          tgl_awal<= '$tgl' AND
          tgl_akhir>= '$tgl' AND
          kd_jenis = '$kd_aplikasi' AND
          (cakupan = 'Nasional' OR kd_kota = '$kd_kota' OR kd_cus = '$kd_cus' ) AND
          (kd_brg = 'Semua' OR kd_brg = '$d[kd_brg]' ) 
          ORDER BY diskon ");


        $d1 = mysqli_fetch_array($data1);

    // print_r($d1);

        if ($d1==null){
          $disc=0;
          $kd_promo='';
        }else{
          if($d1['ket']=='Persen'){
            $disc=($d1['diskon']/100)*$d['harga'];
            $kd_promo=$d1['kd_promo'];
          }else{
            $disc=$d1['diskon'];
            $kd_promo=$d1['kd_promo'];
          }
        }

        ?>
        <div class="filtr-item col-sm-2" style="padding-left: 15px;padding-right: 1px;padding-top: 1px;" >    
          <div class="menupilihan">
            <input type="hidden" id="kode_<?php echo $d['kd_brg']; ?>" value="<?php echo $d['kd_brg']; ?>">
            <input type="hidden" id="nama_<?php echo $d['kd_brg']; ?>" value="<?php echo $d['nama']; ?>">
            <input type="hidden" id="harga_<?php echo $d['kd_brg']; ?>" value="<?php echo $d['harga']; ?>">
            <input type="hidden" id="diskon_<?php echo $d['kd_brg']; ?>" value="<?php echo $disc; ?>">
            <input type="hidden" id="kd_promo_<?php echo $d['kd_brg']; ?>" value="<?php echo $kd_promo; ?>">
            <input type="hidden" id="ket_<?php echo $d['kd_brg']; ?>" value="">

            <a class="modal-pilih-produk" id="<?php echo $d['kd_brg']; ?>" data-dismiss="modal"><img src="<?php echo $dir;?>images/menu/<?php echo $d['photo'];?>" class="img-fluid mb-2" alt="upload picture"  style="width: 80px;" id="tombol-tambahkan"/>
              <div class="menunama ">
                <?php echo $d['nama'];?>
              </div>
              <p class="menuharga_1">
                Rp. <?php echo format_rupiah($d['harga']);?>
              </p>

              <?php
              ?>

            </a>
          </div>
        </div>

        <?php 

      } // END WHILE

      ?>
    </div>
    <?php


    ?>
    <div id="tambahan">

      <?php

      $data = mysqli_query($koneksi,"SELECT bk.kd_brg,bk.kd_kota,bk.harga,bk.kd_aplikasi,b.nama,b.kd_subgrup,b.kd_grup,b.photo FROM barang_kota as bk RIGHT JOIN barang as b ON bk.kd_brg=b.kd_brg WHERE 
        bk.kd_kota='$kd_kota'  AND 
        bk.kd_aplikasi='$kd_aplikasi' AND b.kd_grup='01-04' AND 
        b.nama!='' 
        ORDER BY b.nama ");

  // $d = mysqli_fetch_array($data);
  // print_r($d);

      while($d = mysqli_fetch_array($data)){

        $data1=mysqli_query($koneksi,"SELECT * FROM tarif_diskon
          WHERE
          tgl_awal<= '$tgl' AND
          tgl_akhir>= '$tgl' AND
          kd_jenis = '$kd_aplikasi' AND
          (cakupan = 'Nasional' OR kd_kota = '$kd_kota' OR kd_cus = '$kd_cus' ) AND
          (kd_brg = 'Semua' OR kd_brg = '$d[kd_brg]' ) 
          ORDER BY diskon ");


        $d1 = mysqli_fetch_array($data1);

    // print_r($d1);

        if ($d1==null){
          $disc=0;
          $kd_promo='';
        }else{
          if($d1['ket']=='Persen'){
            $disc=($d1['diskon']/100)*$d['harga'];
            $kd_promo=$d1['kd_promo'];
          }else{
            $disc=$d1['diskon'];
            $kd_promo=$d1['kd_promo'];
          }
        }

        ?>
        <div class="filtr-item col-sm-2" style="padding-left: 15px;padding-right: 1px;padding-top: 1px;" >    
          <div class="menupilihan">
            <input type="hidden" id="kode_<?php echo $d['kd_brg']; ?>" value="<?php echo $d['kd_brg']; ?>">
            <input type="hidden" id="nama_<?php echo $d['kd_brg']; ?>" value="<?php echo $d['nama']; ?>">
            <input type="hidden" id="harga_<?php echo $d['kd_brg']; ?>" value="<?php echo $d['harga']; ?>">
            <input type="hidden" id="diskon_<?php echo $d['kd_brg']; ?>" value="<?php echo $disc; ?>">
            <input type="hidden" id="kd_promo_<?php echo $d['kd_brg']; ?>" value="<?php echo $kd_promo; ?>">
            <input type="hidden" id="ket_<?php echo $d['kd_brg']; ?>" value="">

            <a class="modal-pilih-produk" id="<?php echo $d['kd_brg']; ?>" data-dismiss="modal"><img src="<?php echo $dir;?>images/menu/<?php echo $d['photo'];?>" class="img-fluid mb-2" alt="upload picture"  style="width: 80px;" id="tombol-tambahkan"/>
              <div class="menunama ">
                <?php echo $d['nama'];?>
              </div>
              <p class="menuharga_1">
                Rp. <?php echo format_rupiah($d['harga']);?>
              </p>

              <?php
              ?>

            </a>
          </div>
        </div>

        <?php 

      } // END WHILE

      ?>
    </div>
    <?php


  }else{ 
        // echo '<option value="">Grup not available</option>'; 
  } 
  ?>

  <!-- <input type="hidden" name="kd_promo" value="<?php echo $kd_promo;?>"> -->
