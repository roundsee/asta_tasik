<?php
$dir = '../../../../';
session_start();

include $dir . 'config/koneksi.php';
include $dir . 'config/library.php';

$judulform = "Daftar SUPPLIER";

$data = 'data_supplier';
$rute = 'supplier';
$aksi = 'aksi_supplier';

$tabel = "supplier";
$f1 = 'kd_supp';
$f2 = 'nama';
$f3 = 'alamat';
$f4 = 'telp';
$f5 = 'id_sales';
$f6 = 'area';
$f7 = 'term';
$f8 = 'kd_kota';
$f9 = 'kd_area';
$f10 = 'kd_dispenda';
$f11 = 'id_kat';
$f12 = 'hari_pengiriman';
$f13 = 'term_of_payment';

$j1 = 'Kode Supplier';
$j2 = 'Nama Supplier';
$j3 = 'Alamat';
$j4 = 'Telepon';
$j5 = 'ID Sales';
$j6 = 'Area';
$j7 = 'Durasi Kirim';
$j8 = 'Kode Kota';
$j9 = 'Kode Area';
$j10 = 'Kode dispenda';
$j11 = 'Id Kategori';
$j12 = 'Hari Pengiriman';
$j13 = 'Term Of payment';


$tabel2 = 'kotabaru';
$ff1 = 'kode';
$tabel3 = 'area';
$gg1 = 'kode';

include '../header.php';
?>

<table class="table-responsive">
  <form method="post" enctype="multipart/form-data" action="<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=input">


    <div class="form-group" id="isian1">

      <div class="form-group">
        <label><?php echo $j2; ?></label>
        <input type="text" name="<?php echo $f2; ?>" class="form-control" placeholder="Masukan <?php echo $j2; ?> ..." required="required" />
      </div>


      <div class="form-group">
        <label><?php echo $j3; ?></label>
        <input type="text" name="<?php echo $f3; ?>" class="form-control" placeholder="Masukan <?php echo $j3; ?> ..." required="required" />
      </div>
      <div class="form-group">
        <label><?php echo $j4; ?></label>
        <input type="text" name="<?php echo $f4; ?>" class="form-control" placeholder="Masukan <?php echo $j4; ?> ..." required="required" />
      </div>
      <div class="form-group">
        <label><?php echo $j5; ?></label>
        <select name="<?php  echo $f5?>" id=""  class="form-control">
          <option value="">Pilih Sales</option>
          <?php 
            $query = mysqli_query($koneksi , "SELECT * FROM sales");
            while($x = mysqli_fetch_array($query)){
              echo "<option value= '$x[id_sales]'>$x[id_sales] - $x[nama] - $x[alamat]</option>";
            }

          ?>
        </select>
        <!-- <input type="text" name="<?php echo $f5; ?>" class="form-control" placeholder="Masukan <?php echo $j5; ?> ..." required="required" /> -->
      </div>
      <!-- <div class="form-group">
        <label><?php echo $j6; ?></label>
        <input type="text" name="<?php echo $f6; ?>" class="form-control" placeholder="Masukan <?php echo $j6; ?> ..." required="required" />
      </div> -->
      
      <div class="form-group">
        <label><?php echo $j7; ?></label>
        <input type="text" name="<?php echo $f7; ?>" class="form-control" placeholder="Masukan <?php echo $j7; ?> ..." required="required" />
      </div>
      <div class="form-group">
        <label><?php echo $j13; ?></label>
        <input type="text" name="<?php echo $f13; ?>" class="form-control" placeholder="Masukan <?php echo $j13; ?> ..." required="required" />
      </div>
    


      <div class="form_group mb-2" >
        <label for=""> <?php echo $f12?></label>
        <select name="<?php echo $f12?>" id="" class="form-control" style="width: 300px; height:40px;" >
          <option value=""> PIlih hari pengiriman</option>
          <option value="Senin">Senin</option>
          <option value="Selasa">Selasa</option>
          <option value="Rabu">Rabu</option>
          <option value="Kamis">Kamis</option>
          <option value="Jumat">Jumat</option>
          <option value="Sabtu">Sabtu</option>
          <option value="Minggu">Minggu</option>
        </select>
      </div>
    
    
      <div class="form-group">
        <label><?php echo $j8; ?></label>
        <select name="<?php echo $f8; ?>" class="form-control" style="width:300px;height: 40px;">
          <?php

          $produk = mysqli_query($koneksi, "SELECT * from $tabel2 order by $ff1 asc");
          while ($pro = mysqli_fetch_array($produk)) {
            echo "<option value='$pro[$ff1]'>$pro[$ff1] - $pro[nama]</option>";
          }
          ?>
        </select>
      </div>

      <div class="form-group">
        <label><?php echo $j9; ?></label>
        <select name="<?php echo $f9; ?>" class="form-control" style="width:300px;height: 40px;">
          <?php

          $produk2 = mysqli_query($koneksi, "SELECT * from $tabel3 order by $gg1 asc");
          while ($pro2 = mysqli_fetch_array($produk2)) {
            echo "<option value='$pro2[$gg1]'>$pro2[$gg1] - $pro2[nama]</option>";
          }
          ?>
        </select>
      </div>

      <!-- <div class="form-group">
        <label><?php echo $j11; ?></label>
        <select name="<?php echo $f11; ?>" class="form-control" style="width:300px;height: 40px;">
          <?php

          $produk2 = mysqli_query($koneksi, "SELECT * from kategori_outlet order by id_kat asc");
          while ($pro2 = mysqli_fetch_array($produk2)) {
            echo "<option value='$pro2[id_kat]'>$pro2[id_kat] - $pro2[nama_kategori]</option>";
          }
          ?>
        </select>
      </div> -->

   
      <div class="form-group">
        <hr />
        <input type="submit" class="btn btn-primary elevation-2" style="opacity: .7" value="Simpan" />
      </div>
    </div>

  </form>
  <a href="../../main.php?route=<?php echo $rute; ?>&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=<?php echo $rute; ?>"><button class="btn btn-primary btn-sm elevation-1" style="opacity: .7">Back</button></a>

</table>
<?php include '../footer.php';
