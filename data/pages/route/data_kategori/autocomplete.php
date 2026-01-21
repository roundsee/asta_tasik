<?php
$dir = '../../../../';
session_start();

include $dir . 'config/koneksi.php';
include $dir . 'config/library.php';

$judulform = "Daftar Kategori";

$data = 'data_kategori';
$rute = 'kategori';
$aksi = 'aksi_kategori';

$tabel = 'kategori';


$f1 = 'Nama_kategoriNilai';
$f2 = 'layer1';
$f31 = 'layer21';
$f32 = 'layer22';

$f41 = 'layer31';
$f42 = 'layer32';
$f43 = 'layer33';

$f51 = 'layer41';
$f52 = 'layer42';
$f53 = 'layer43';
$f54 = 'layer44';

$f61 = 'layer51';
$f62 = 'layer52';
$f63 = 'layer53';
$f64 = 'layer54';
$f65 = 'layer55';

$f7 = 'id_kat';


$j1 = 'Nama Kategori';
$j2 = '1 layer';
$j3 = '2 layer';
$j4 = '3 layer';
$j5 = '4 layer';
$j6 = '5 layer';
$j7 = 'Jenis Kategori';


include '../header.php';

$asal = $_GET['asal'];
?>

<table class="table-responsive">
  <form method="post" enctype="multipart/form-data" action="<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=input&asal=<?php echo $_GET['asal']; ?>" id="formTambahKategori" onsubmit="return validateForm()">

    <div class="form-group">
      <label>Kategori</label>
      <input type="text" id="Namakategori" name="<?php echo $f1; ?>" class="form-control" placeholder="Masukan <?php echo $j1; ?> ..." style="text-transform: uppercase;" required />
    </div>

    <div class="form-group">
      <label><?php echo $j2; ?> </label>
      <input type="text" name="<?php echo $f2; ?>" class="form-control" placeholder="Masukan <?php echo $j2; ?> ..." />
    </div>

    <label>2 layer</label>
    <div class="row">
      <div class="col-sm-2">
        <div class="form-group">
          <input type="text" name="<?php echo $f31; ?>" class="form-control" placeholder="Masukan Nilai ..." />
        </div>
      </div>
      <div class="col-sm-2">
        <div class="form-group">
          <input type="text" name="<?php echo $f32; ?>" class="form-control" placeholder="Masukan Nilai ..." />
        </div>
      </div>
    </div>

    <label>3 layer</label>
    <div class="row">
      <div class="col-sm-2">
        <div class="form-group">
          <input type="text" name="<?php echo $f41; ?>" class="form-control" placeholder="Masukan Nilai ..." />
        </div>
      </div>
      <div class="col-sm-2">
        <div class="form-group">
          <input type="text" name="<?php echo $f42; ?>" class="form-control" placeholder="Masukan Nilai ..." />
        </div>
      </div>
      <div class="col-sm-2">
        <div class="form-group">
          <input type="text" name="<?php echo $f43; ?>" class="form-control" placeholder="Masukan Nilai ..." />
        </div>
      </div>
    </div>

    <label>4 layer</label>
    <div class="row">
      <div class="col-2">
        <div class="form-group">
          <input type="text" name="<?php echo $f51; ?>" class="form-control" placeholder="Masukan Nilai ..." />
        </div>
      </div>
      <div class="col-2">
        <div class="form-group">
          <input type="text" name="<?php echo $f52; ?>" class="form-control" placeholder="Masukan Nilai ..." />
        </div>
      </div>
      <div class="col-2">
        <div class="form-group">
          <input type="text" name="<?php echo $f53; ?>" class="form-control" placeholder="Masukan Nilai ..." />
        </div>
      </div>
      <div class="col-2">
        <div class="form-group">
          <input type="text" name="<?php echo $f54; ?>" class="form-control" placeholder="Masukan Nilai ..." />
        </div>
      </div>
    </div>

    <label>5 layer</label>
    <div class="row">
      <div class="col-2">
        <div class="form-group">
          <input type="text" name="<?php echo $f61; ?>" class="form-control" placeholder="Masukan Nilai ..." />
        </div>
      </div>
      <div class="col-2">
        <div class="form-group">
          <input type="text" name="<?php echo $f62; ?>" class="form-control" placeholder="Masukan Nilai ..." />
        </div>
      </div>
      <div class="col-2">
        <div class="form-group">
          <input type="text" name="<?php echo $f63; ?>" class="form-control" placeholder="Masukan Nilai ..." />
        </div>
      </div>
      <div class="col-2">
        <div class="form-group">
          <input type="text" name="<?php echo $f64; ?>" class="form-control" placeholder="Masukan Nilai ..." />
        </div>
      </div>
      <div class="col-2">
        <div class="form-group">
          <input type="text" name="<?php echo $f65; ?>" class="form-control" placeholder="Masukan Nilai ..." />
        </div>
      </div>
    </div>

    <div class="form-group">
      <label for="<?php echo $f7; ?>"><?php echo $j7; ?> </label>
      <select id="<?php echo $f7; ?>" name="<?php echo $f7; ?>" class="form-control">
        <option value="1">Retail</option>
        <option value="2">Grosir</option>
        <option value="3">Online</option>
        <option value="4">Member 1</option>
        <option value="5">Member 2</option>
        <option value="6">Member 3</option>
      </select>
    </div>

    <div class="form-group">
      <hr />
      <input type="submit" class="btn btn-primary elevation-2" style="opacity: .7" value="Simpan" />
    </div>


  </form>
  <a href="../../main.php?route=<?php echo $rute; ?>&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=<?php echo $rute; ?>"><button class="btn btn-primary btn-sm elevation-1" style="opacity: .7">Back</button></a>

</table>
<script>
  function validateForm() {
    const namaKategoricari = document.getElementById('Namakategori').value.toUpperCase();
    const idkategoricari = document.getElementById('id_kat').value;

    $.ajax({
      type: 'GET',
      url: 'carikategori.php?value=' + namaKategoricari + '&valuesID=' + idkategoricari,
      dataType: 'json',
      success: function(response) {
        if (response === "ada") {
          if (confirm("Nama sudah digunakan, ingin dilakukan update?")) {
            document.getElementById('formTambahKategori').submit();
          } else {
            alert("Update canceled.");
          }
        } else {
          document.getElementById('formTambahKategori').submit();
        }
      },
      error: function(xhr, status, error) {
        console.log(xhr.responseText);
      }
    });
    return false;
  }
</script>
<?php include '../footer.php'; ?>