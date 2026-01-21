<?php
$dir = '../../../../';
session_start();

include $dir . 'config/koneksi.php';
include $dir . 'config/library.php';

$judulform = "Daftar Menu";

$data = 'data_barang';
$rute = 'barang';
$aksi = 'aksi_barang';

$tabel = 'barang';

$f1 = 'kd_brg';
$f2 = 'nama';
$f3 = 'harga';
$f4 = 'satuan';
$f5 = 'kd_subgrup';
$f6 = 'kd_grup';
$f7 = 'photo';
$f8 = 'rating';
$f9 = 'Quantity';
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
$f31 = 'id_kat';
$f32 = 'id_kat_satuan';


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
$j31 = 'ID kategori filter';
$j32 = 'ID Kategori Satuan';


include '../header.php';
?>

<table class="table-responsive">
  <form method="post" enctype="multipart/form-data" action="<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=input">

    <div class="form-group">
      <label><?php echo $j5; ?></label>
      <select name="<?php echo $f5; ?>" class="form-control" style="width:400px;height: 40px;">
        <option></option>
        <?php

        $produk = mysqli_query($koneksi, "SELECT * from barang_subgrup order by kd_subgrup asc");
        while ($pro = mysqli_fetch_array($produk)) {
          echo "<option value='$pro[kd_subgrup]'>$pro[kd_subgrup] - $pro[nama]</option>";
        }
        ?>
      </select>
    </div>

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

    <div class="row">
      <div class="col-sm-5">
        <div class="form-group">
          <div id="msg"></div>
          <input type="file" name="photo" class="file">
          <div class="input-group my-3">
            <input type="text" class="form-control" disabled placeholder="Upload Gambar" id="file">
            <div class="input-group-append">
              <button type="button" id="pilih_gambar" class="browse btn btn-dark elevation-3">Pilih Gambar</button>
            </div>
          </div>

          <img src="../../../../images/images.jpeg" id="preview" class="img-thumbnail elevation-3">
        </div>
      </div>
    </div>

    <div class="form-group">
      <hr />
      <input type="submit" class="btn btn-primary elevation-2" style="opacity: .7" value="Simpan" />
    </div>

  </form>

  <a href="../../main.php?route=<?php echo $rute; ?>&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=<?php echo $rute; ?>"><button class="btn btn-primary btn-sm elevation-1" style="opacity: .7">Back</button></a>


</table>
<?php include '../footer.php'; ?>