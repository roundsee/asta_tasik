<?php
$dir = '../../../../';
session_start();

include $dir . 'config/koneksi.php';
include $dir . 'config/library.php';
$judulform = "Daftar Sales";

$data = 'data_sales';
$rute = 'sales';
$aksi = 'aksi_sales';

$tabel = 'sales';
$f1 = 'id_sales';
$f2 = 'nama';
$f3 = 'alamat';

$j1 = "ID Sales";
$j2 = 'Nama Sales';
$j3 = 'Alamat Sales';


include '../header.php';

$asal = $_GET['asal'];
?>

<table class="table-responsive">
  <form method="post" enctype="multipart/form-data" action="<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=input&asal=<?php echo $_GET['asal']; ?>">

    <div class="form-group">
      <label><?php echo $j2; ?></label>
      <input type="text" name="<?php echo $f2; ?>" class="form-control" placeholder="Masukan <?php echo $j2; ?> ...." required="required" />
    </div>
    <div class="form-group">
      <label><?php echo $j3; ?></label>
      <input type="text" name="<?php echo $f3; ?>" class="form-control" placeholder="Masukan <?php echo $j3; ?> ...." required="required" />
    </div>

    <div class="form-group">
      <hr />
      <input type="submit" class="btn btn-primary elevation-2" style="opacity: .7" value="Simpan" />
    </div>


  </form>
  <a href="../../main.php?route=<?php echo $rute; ?>&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=<?php echo $rute; ?>"><button class="btn btn-primary btn-sm elevation-1" style="opacity: .7">Back</button></a>

</table>

<?php include '../footer.php'; ?>