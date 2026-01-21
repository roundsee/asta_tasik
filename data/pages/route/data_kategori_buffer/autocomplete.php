<?php
$dir = '../../../../';
session_start();

include $dir . 'config/koneksi.php';
include $dir . 'config/library.php';



$judulform = "Daftar Kategori Buffer";

$data = 'data_kategori_buffer';
$rute = 'kategori_buffer';
$aksi = 'aksi_kategori_buffer';

$tabel = 'kategori_buffer';

$f1 = 'kd_kat';
$f2 = 'nilai';


$j1 = 'Kode Kategori';
$j2 = 'Nilai';


include '../header.php';

$asal = $_GET['asal'];
?>

<table class="table-responsive">
  <form method="post" enctype="multipart/form-data" action="<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=input&asal=<?php echo $_GET['asal']; ?>">

    <div class="form-group">
      <label><?php echo $j1; ?></label>
      <input type="text" name="<?php echo $f1; ?>" class="form-control" placeholder="Masukan <?php echo $j1; ?> ..." required="required" />
    </div>

    <div class="form-group">
      <label><?php echo $j2; ?></label>
      <input type="text" name="<?php echo $f2; ?>" class="form-control" placeholder="Masukan <?php echo $j2; ?> ...." required="required" />
    </div>

    <div class="form-group">
      <hr />
      <input type="submit" class="btn btn-primary elevation-2" style="opacity: .7" value="Simpan" />
    </div>


  </form>
  <a href="../../main.php?route=<?php echo $rute; ?>&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=<?php echo $rute; ?>"><button class="btn btn-primary btn-sm elevation-1" style="opacity: .7">Back</button></a>

</table>

<?php include '../footer.php'; ?>