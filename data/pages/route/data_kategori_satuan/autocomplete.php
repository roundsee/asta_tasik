<?php
$dir = '../../../../';
session_start();

include $dir . 'config/koneksi.php';
include $dir . 'config/library.php';

$judulform = "Daftar Kategori Satuan";

$data = 'data_kategori_satuan';
$rute = 'kategori_satuan';
$aksi = 'aksi_kategori_satuan';

$tabel = 'kategori_satuan';


$f1 = 'id_kat_satuan';
$f2 = 'Satuan_1';
$f3 = 'Satuan_2';
$f4 = 'Satuan_3';
$f5 = 'Satuan_4';
$f6 = 'Satuan_5';

$j1 = 'ID Satuan Kategori';
$j2 = 'Nama Satuan';
$j3 = 'Nama Satuan';
$j4 = 'Nama Satuan';
$j5 = 'Nama Satuan';
$j6 = 'Nama Satuan';

include '../header.php';

$asal = $_GET['asal'];
?>

<table class="table-responsive">
  <form method="post" enctype="multipart/form-data" action="<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=input&asal=<?php echo $_GET['asal']; ?>">

    <div class="form-group">
      <label>Kategori Satuan</label>
      <select id="<?php echo $f1; ?>" name="<?php echo $f1; ?>" class="form-control" value="<?php echo $u[$f1]; ?>" required>
        <option value=""></option>
        <?php
        $query = "SELECT * FROM kategori_nilai";
        $result = mysqli_query($koneksi, $query);
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
          <option value="<?php echo $row["id_kategoriNilai"] ?>"><?php echo $row["id_kategoriNilai"] ?> (<?php echo $row["nilai1"] ?>%, <?php echo $row["nilai2"] ?>%, <?php echo $row["nilai3"] ?>%, <?php echo $row["nilai4"] ?>%, <?php echo $row["nilai5"] ?>%)</option>

        <?php } ?>
      </select>
    </div>

    <div class="form-group">
      <label for="<?php echo $f2; ?>"><?php echo $j2; ?> </label>
      <select id="<?php echo $f2; ?>" name="<?php echo $f2; ?>" class="form-control" value="<?php echo $u[$f2]; ?>">
        <option value=""></option>
        <option value="hrg_pcs">Pcs</option>
        <option value="hrg_renteng">Renteng</option>
        <option value="hrg_pak">Pak</option>
        <option value="hrg_ikat">ikat</option>
        <option value="hrg_ball">Ball</option>
        <option value="hrg_box">Box</option>
        <option value="hrg_dus">Dus</option>
      </select>
    </div>
    <div class="form-group">
      <label for="<?php echo $f3; ?>"><?php echo $j3; ?> </label>
      <select id="<?php echo $f3; ?>" name="<?php echo $f3; ?>" class="form-control" value="<?php echo $u[$f3]; ?>">
        <option value=""></option>
        <option value="hrg_pcs">Pcs</option>
        <option value="hrg_renteng">Renteng</option>
        <option value="hrg_pak">Pak</option>
        <option value="hrg_ikat">ikat</option>
        <option value="hrg_ball">Ball</option>
        <option value="hrg_box">Box</option>
        <option value="hrg_dus">Dus</option>
      </select>
    </div>
    <div class="form-group">
      <label for="<?php echo $f4; ?>"><?php echo $j4; ?> </label>
      <select id="<?php echo $f4; ?>" name="<?php echo $f4; ?>" class="form-control" value="<?php echo $u[$f4]; ?>">
        <option value=""></option>
        <option value="hrg_pcs">Pcs</option>
        <option value="hrg_renteng">Renteng</option>
        <option value="hrg_pak">Pak</option>
        <option value="hrg_ikat">ikat</option>
        <option value="hrg_ball">Ball</option>
        <option value="hrg_box">Box</option>
        <option value="hrg_dus">Dus</option>
      </select>
    </div>
    <div class="form-group">
      <label for="<?php echo $f5; ?>"><?php echo $j5; ?> </label>
      <select id="<?php echo $f5; ?>" name="<?php echo $f5; ?>" class="form-control" value="<?php echo $u[$f5]; ?>">
        <option value=""></option>
        <option value="hrg_pcs">Pcs</option>
        <option value="hrg_renteng">Renteng</option>
        <option value="hrg_pak">Pak</option>
        <option value="hrg_ikat">ikat</option>
        <option value="hrg_ball">Ball</option>
        <option value="hrg_box">Box</option>
        <option value="hrg_dus">Dus</option>
      </select>
    </div>
    <div class="form-group">
      <label for="<?php echo $f6; ?>"><?php echo $j6; ?> </label>
      <select id="<?php echo $f6; ?>" name="<?php echo $f6; ?>" class="form-control" value="<?php echo $u[$f6]; ?>">
        <option value=""></option>
        <option value="hrg_pcs">Pcs</option>
        <option value="hrg_renteng">Renteng</option>
        <option value="hrg_pak">Pak</option>
        <option value="hrg_ikat">ikat</option>
        <option value="hrg_ball">Ball</option>
        <option value="hrg_box">Box</option>
        <option value="hrg_dus">Dus</option>
      </select>
    </div>
    <div class="form-group">
      <hr />
      <input type="submit" class="btn btn-primary elevation-2" style="opacity: .7" value="Simpan" />
    </div>


  </form>
  <a href="../../main.php?route=<?php echo $rute; ?>&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=<?php echo $rute; ?>"><button class="btn btn-primary btn-sm elevation-1" style="opacity: .7">Back</button></a>

</table>

<?php include '../footer.php'; ?>