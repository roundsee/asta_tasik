<?php
$dir = '../../../../';
session_start();

include $dir . 'config/koneksi.php';
include $dir . 'config/library.php';

$judulform = "Jenis Transaksi";

$data = 'data_jenis_transaksi';
$rute = 'jenis_transaksi';
$aksi = 'aksi_jenis_transaksi';

$tabel = 'jenis_transaksi';
$f1 = 'kd_jenis';
$f2 = 'nama';
$f3 = 'photo';
$f4 = 'keterangan';


$j1 = 'Kode Aplikasi';
$j2 = 'Metode Pembayaran';
$j3 = 'Photo';
$j4 = 'Keterangan';


include '../header.php';
?>

<table class="table-responsive">
  <form method="post" enctype="multipart/form-data" action="<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=input">

    <div class="form-group">
      <label><?php echo $j1; ?></label>
      <input type="text" onkeyup="isi_otomatis()" name="<?php echo $f1; ?>" id="<?php echo $f1; ?>" required="required" class="form-control" style="width: 100px;" />
      <input type="text" id="<?php echo $f2; ?>" class="form-control" style="width: 300px;" disabled />

    </div>


    <div class="form-group">
      <label><?php echo $j2; ?></label>
      <input type="text" name="<?php echo $f2; ?>" class="form-control" placeholder="Masukan <?php echo $j2; ?> (seperti tunai / kredit )" required="required" />
    </div>

    <!-- <div class="form-group">
      <label>Pilih line</label>
      <select name="pilihan" class="form-control" style="width:200px;height: 40px;">
        <option value="0">TRANSFER</option>
        <option value="1">BANK</option>
      </select>
    </div> -->
    <div class="form-group">
      <label>Keterangan</label>
      <textarea name="pilihan" class="form-control" id=""></textarea>
        <!-- <select name="pilihan" class="form-control" style="width:200px;height: 40px;">
          <option value="0">TRANSFER</option>
          <option value="1">BANK</option>
        </select> -->
    </div>


    <!-- <div class="row">
      <div class="col-sm-6">
        <div class="form-group">
          <div id="msg"></div>
          <input type="file" name="photo" class="file">
          <div class="input-group my-3">
            <input type="text" class="form-control" disabled placeholder="Upload Gambar" id="file">
            <div class="input-group-append">
              <button type="button" id="pilih_gambar" class="browse btn btn-dark elevation-3">Pilih Gambar</button>
            </div>
          </div>

          <img src="../../../../images/<?php echo $rute; ?>/images.jpeg" id="preview" class="img-thumbnail elevation-2" style="opacity: .7">
        </div>
      </div>
    </div> -->

    <div class="form-group">
      <hr />
      <input type="submit" class="btn btn-primary elevation-2" style="opacity: .7" value="Simpan" />
    </div>

  </form>

  <a href="../../main.php?route=<?php echo $rute; ?>&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=<?php echo $rute; ?>"><button class="btn btn-primary btn-sm elevation-1" style="opacity: .7">Back</button></a>

</table>
<?php include '../footer.php'; ?>