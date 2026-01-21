<?php
$dir = '../../../../';
session_start();

include $dir . 'config/koneksi.php';
include $dir . 'config/library.php';

$judulform = "Daftar Mmember";

$data = 'data_member';
$rute = 'member';
$aksi = 'aksi_member';

$tabel = 'member';

$f1 = 'id';
$f2 = 'kd_member';
$f3 = 'nama';
$f4 = 'telp';
$f5 = 'alamat';
$f6 = 'kelurahan';
$f7 = 'kecamatan';
$f8 = 'kabupaten';
$f9 = 'provinsi';


$j1 = 'ID';
$j2 = 'No HP';
$j3 = 'Nama';
$j4 = 'Telp';
$j5 = 'Alamat';
$j6 = 'Kelurahan';
$j7 = 'Kecamatan';
$j8 = 'Kabupaten';
$j9 = 'Provinsi';

include '../header.php';

$asal = $_GET['asal'];
?>

<table class="table-responsive">
  <form method="post" enctype="multipart/form-data" action="<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=input&asal=<?php echo $_GET['asal']; ?>">

    <div class="form-group">
      <label><?php echo $j2; ?></label>
      <input type="text" name="<?php echo $f2; ?>" class="form-control" placeholder="Masukan <?php echo $j2; ?> ..." />
    </div>

    <div class="form-group">
      <label><?php echo $j3; ?></label>
      <input type="text" name="<?php echo $f3; ?>" class="form-control" placeholder="Masukan <?php echo $j3; ?> ..." />
    </div>

    <div class="form-group">
      <label><?php echo $j4; ?></label>
      <input type="text" name="<?php echo $f4; ?>" class="form-control" placeholder="Masukan <?php echo $j4; ?> ..." />
    </div>

    <div class="form-group">
      <label><?php echo $j5; ?></label>
      <input type="text" name="<?php echo $f5; ?>" class="form-control" placeholder="Masukan <?php echo $j5; ?> ..." />
    </div>

    <div class="form-group">
      <label><?php echo $j6; ?></label>
      <input type="text" name="<?php echo $f6; ?>" class="form-control" placeholder="Masukan <?php echo $j6; ?> ..." />
    </div>

    <div class="form-group">
      <label><?php echo $j7; ?></label>
      <input type="text" name="<?php echo $f7; ?>" class="form-control" placeholder="Masukan <?php echo $j7; ?> ..." />
    </div>

    <div class="form-group">
      <label><?php echo $j8; ?></label>
      <input type="text" name="<?php echo $f8; ?>" class="form-control" placeholder="Masukan <?php echo $j8; ?> ..." />
    </div>

    <div class="form-group">
      <label><?php echo $j9; ?></label>
      <input type="text" name="<?php echo $f9; ?>" class="form-control" placeholder="Masukan <?php echo $j9; ?> ..." />
    </div>


    <div class="form-group">
      <hr />
      <input type="submit" class="btn btn-primary elevation-2" style="opacity: .7" value="Simpan" />
    </div>


  </form>
  <a href="../../main.php?route=<?php echo $rute; ?>&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=<?php echo $rute; ?>"><button class="btn btn-primary btn-sm elevation-1" style="opacity: .7">Back</button></a>

</table>

<?php include '../footer.php'; ?>