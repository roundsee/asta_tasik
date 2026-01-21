<?php
$dir = '../../../../';
session_start();

include $dir . 'config/koneksi.php';
include $dir . 'config/library.php';
$judulform = "Biaya";

$data = 'data_biaya';
$rute = 'biaya';
$aksi = 'aksi_biaya';
$view = 'beli_view';

$rute_detail = 'beli_detail';

$tabel = 'biaya';

$f1 = 'no_account';
$f2 = 'nomor_bukti';
$f3 = 'tanggal';
$f4 = 'nama_biaya';
$f5 = 'keterangan';
$f6 = 'jumlah';


$j1 = 'Nomor Account';
$j2 = 'Nomor Bukti';
$j3 = 'Tanggal Bayar';
$j4 = 'Keterangan Biaya';
$j5 = 'Nama / Keterangan';
$j6 = 'Jumlah';


include '../header.php';
?>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<div class="table-responsive">
  <form id="biayaForm" method="post" enctype="multipart/form-data" action="<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=input-baru">
    <div class="form-group">
      <label>Pilih Jenis Biaya</label>
      <select id="jenis_biaya" name="jenis_biaya" class="form-control" required>
        <option value="">Pilih Jenis Biaya</option>
        <option value="gaji_karyawan">Gaji Karyawan</option>
        <option value="listrik">Listrik</option>
        <option value="telephone">Telephone</option>
        <option value="pdam">PDAM</option>
        <option value="atk">ATK</option>
        <option value="bensin_parkir">Bensin Parkir</option>
        <option value="pembungkus">Pembungkus</option>
        <option value="iuran_sumbangan">Iuran dan Sumbangan</option>
        <option value="pemeliharaan_gedung">Pemeliharaan Gedung</option>
        <option value="biaya_lain">Biaya Lain-lain</option>
      </select>
    </div>

    <!-- Shared Fields -->
    <div class="form-group">
      <label>No Account</label>
      <select name="no_account" class="form-control">
        <?php
        $query = mysqli_query($koneksi, "SELECT * FROM account");
        while ($x = mysqli_fetch_array($query)) {
          echo "<option value='$x[no_account]'>$x[deskripsi]</option>";
        }
        ?>
      </select>
    </div>

    <div class="form-group">
      <label>Tanggal</label>
      <input type="date" name="tanggal" class="form-control" value="<?php echo date('Y-m-d'); ?>">
    </div>

    <div id="nama_biaya_section" class="form-group" style="display: none;">
      <label>Nama Biaya</label>
      <input type="text" id="nama_biaya" name="nama_biaya" class="form-control" readonly>
    </div>

    <div id="keterangan_section" class="form-group" style="display: none;">
      <label>Keterangan</label>
      <textarea name="keterangan" class="form-control" rows="3" placeholder="Masukan Keterangan"></textarea>
    </div>

    <div class="form-group">
      <label>Jumlah</label>
      <input type="text" name="jumlah" class="form-control" id="jumlah" placeholder="Masukan Jumlah">
    </div>

    <input type="submit" class="btn btn-primary" value="Simpan">
  </form>

  <script>
    document.getElementById('biayaForm').addEventListener('submit', function(e) {
      var jumlah = document.getElementById('jumlah');
      if (jumlah) {
        jumlah.value = jumlah.value.replace(/[^0-9]/g, '');
      }
    });

    document.getElementById('jenis_biaya').addEventListener('change', function() {
      var selectedValue = this.value;
      var namaBiayaField = document.getElementById('nama_biaya');
      var namaBiayaSection = document.getElementById('nama_biaya_section');
      var keteranganSection = document.getElementById('keterangan_section');

      // Default visibility and values
      namaBiayaSection.style.display = 'block';
      keteranganSection.style.display = 'none';

      switch (selectedValue) {
        case 'gaji_karyawan':
          namaBiayaField.value = 'Gaji Karyawan';
          keteranganSection.style.display = 'block';
          break;
        case 'listrik':
          namaBiayaField.value = 'Listrik';
          break;
        case 'telephone':
          namaBiayaField.value = 'Telephone';
          break;
        case 'pdam':
          namaBiayaField.value = 'PDAM';
          break;
        case 'atk':
          namaBiayaField.value = 'ATK';
          keteranganSection.style.display = 'block';
          break;
        case 'bensin_parkir':
          namaBiayaField.value = 'Bensin Parkir';
          keteranganSection.style.display = 'block';
          break;
        case 'pembungkus':
          namaBiayaField.value = 'Pembungkus';
          break;
        case 'iuran_sumbangan':
          namaBiayaField.value = 'Iuran dan Sumbangan';
          keteranganSection.style.display = 'block';
          break;
        case 'pemeliharaan_gedung':
          namaBiayaField.value = 'Pemeliharaan Gedung';
          keteranganSection.style.display = 'block';
          break;
        case 'biaya_lain':
          namaBiayaField.value = 'Biaya Lain-lain';
          keteranganSection.style.display = 'block';
          break;
        default:
          namaBiayaField.value = '';
          namaBiayaSection.style.display = 'none';
      }
    });

    function formatRupiah(angka, prefix) {
      var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

      if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
      }

      rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
      return prefix === undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

    document.getElementById('jumlah').addEventListener('keyup', function(e) {
      this.value = formatRupiah(this.value, 'Rp. ');
    });
  </script>



  <a href="../../main.php?route=<?php echo $rute; ?>&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=<?php echo $rute; ?>">
    <button class="btn btn-primary btn-sm elevation-1 mt-2" style="opacity: .7">Back</button>
  </a>
</div>
<hr>





<?php
include '../footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script type="text/javascript">
  window.onload = function() {
    if (!window.location.hash) {
      window.location = window.location + '#loaded';
      window.location.reload();
    }
  }
</script>