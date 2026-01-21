<?php
// include 'header.php';
include '../../config/koneksi.php';

$judulform = "Payment Tambah";


$data = 'lap_payment_invoice';
$rute = 'payment_invoice';
$aksi = 'aksi_payment';

$tabel = 'payment';
$f1 = 'id_payment';
$f2 = 'no_invoice';
$f3 = 'jumlah_payment';
$f4 = 'no_payment';
$f5 = 'tanggal_payment';
$f6 = 'insert_oleh';
$f7 = 'tanggal';
$f8 = 'metode_payment';

$j1 = 'id_payment';
$j2 = 'no_invoice';
$j3 = 'jumlah_payment';
$j4 = 'no_payment';
$j5 = 'tanggal_payment';
$j6 = 'insert_oleh';
$j7 = 'tanggal';
$j8 = 'Metode Payment'

?>

<!-- Include jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Include Select2 CSS dan JS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color: ghostwhite;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <div style="margin:10px;"></div>
          <h1 class="list-gds">
            <b><?php echo $judulform; ?></b>
            <small style="font-weight: 100;">tambah</small>
          </h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="main.php?route=home">Beranda</a></li>
            <li class="breadcrumb-item active">Data</li>
            <li class="breadcrumb-item active"><?php echo $judulform; ?></li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="card card-default">
      <div class="card-body">
        <div class="row">
          <section>
            <div class="box">
              <div class="box-body">
                <form method="post" enctype="multipart/form-data" action="route/<?php echo $data; ?>/<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=input">
                  <div class="container">
                    <div class="row">

                      <!-- Kolom ID Transaksi -->
                      <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                          <label><?php echo "Nomor PO"; ?></label>
                          <select id="id_transaksi" name="<?php echo $f2; ?>" class="form-control select2" required="required">
                            <option value="">Pilih Kode PO</option>
                            <?php
                            $query = mysqli_query($koneksi, "SELECT kd_po FROM pembelian");
                            while ($row = mysqli_fetch_assoc($query)) {
                              echo "<option value='" . $row['kd_po'] . "'>" . $row['kd_po'] . "</option>";
                            }
                            ?>
                          </select>
                        </div>
                      </div>

                      <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                          <label><?php echo $j3; ?></label>
                          <input type="text" name="<?php echo $f3; ?>" id="no_bukti" class="form-control" placeholder="Masukan <?php echo $j3; ?> ..." required="required" / >
                        </div>
                      </div>

                      <!-- Kolom Pertama -->
                      <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                          <label><?php echo $j5; ?></label>
                          <input type="date" name="<?php echo $f5; ?>" id="tgl" readonly class="form-control" placeholder="Masukan <?php echo $j5; ?> ..." required="required" value="<?php echo date('Y-m-d');  ?>" />
                        </div>
                      </div>

                    

     

                   
                      <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                          <label><?php echo $j8; ?></label>
                          <select name="<?php echo $f8; ?>" id="metode_pembayaran" class="form-control select2" required="required">
                            <option value="">Pilih Metode Pembayaran</option>
                            <option value="Tunai">Tunai</option>
                            <option value="Kredit">Kredit</option>
                          </select>
                        </div>
                      </div>
                    </div>
                   
                    <hr>
                    <div class="form-group text-right">
                      <input type="submit" class="btn btn-primary btn-sm elevation-2" style="opacity: .7" value="Simpan" />
                      <a href="main.php?route=<?php echo $rute; ?>&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=<?php echo $rute; ?>">
                        <button type="button" class="btn btn-primary btn-sm elevation-2" style="opacity: .7">Back</button>
                      </a>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </section>
</div>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- Include jQuery dan Select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    // Event listener saat ID Transaksi dipilih
    $('#id_transaksi').change(function() {
        var id_transaksi = $(this).val();
        if (id_transaksi) {
            $.ajax({
                url: 'route/data_pembelian_retur/get_pembelian_data.php',
                type: 'POST',
                data: { id_transaksi: id_transaksi },
                dataType: 'json',
                success: function(data) {
                    if (data) {
                        $('#tgl').val(data.tgl);
                        $('#no_bukti').val(data.no_bukti);
                        $('#kd_supp').val(data.vendor).trigger('change');
                        $('#kode_barang').val(data.kode_barang).trigger('change');
                        $('#nama_barang').val(data.nama_barang);
                        $('#satuan').val(data.satuan);
                        $('#akun_persediaan').val(data.akun_persediaan).trigger('change');
                        $('#jumlah').val(data.jumlah);
                        $('#harga').val(data.harga);
                        $('#sub_total').val(data.sub_total);
                        $('#ppn').val(data.ppn);
                        $('#akun_ppn').val(data.akun_ppn).trigger('change');
                        $('#total').val(data.total);
                        $('#metode_pembayaran').val(data.metode_pembayaran).trigger('change');
                        $('#akun').val(data.akun).trigger('change');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                    console.error('Response:', xhr.responseText);
                }
            });
        }
    });

    // Inisialisasi Select2
    $('.select2').select2();
});
</script>
</script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Ambil elemen input
    var jumlahInput = document.getElementById('jumlah');
    var hargaInput = document.getElementById('harga');
    var subTotalInput = document.getElementById('sub_total');
    var ppnInput = document.getElementById('ppn');
    var totalInput = document.getElementById('total');

    // Fungsi untuk menghitung subtotal
    function calculateSubtotal() {
      var jumlah = parseFloat(jumlahInput.value) || 0;
      var harga = parseFloat(hargaInput.value) || 0;
      var subtotal = jumlah * harga;

      // Format subtotal dalam format Rupiah
      var formattedSubtotal = subtotal.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
      subTotalInput.value = formattedSubtotal;

      calculateTotal(); // Hitung total setelah subtotal dihitung
    }

    // Fungsi untuk menghitung total
    function calculateTotal() {
      // Ambil subtotal tanpa format mata uang
      var subtotal = parseFloat(subTotalInput.value.replace(/[^0-9,-]+/g, "").replace(",", ".")) || 0;
      var ppn = parseFloat(ppnInput.value) || 0;

      // Hitung PPN
      var ppnAmount = subtotal * (ppn / 100);

      // Hitung total
      var total = subtotal + ppn;

      // Format total dalam format Rupiah
      var formattedTotal = total.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
      totalInput.value = formattedTotal;
    }

    // Tambahkan event listener untuk perubahan pada jumlah, harga, dan PPN
    jumlahInput.addEventListener('input', calculateSubtotal);
    hargaInput.addEventListener('input', calculateSubtotal);
    ppnInput.addEventListener('input', calculateTotal);

    // Fungsi untuk menghapus format mata uang sebelum form disubmit
    document.querySelector('form').addEventListener('submit', function() {
      subTotalInput.value = parseFloat(subTotalInput.value.replace(/[^0-9,-]+/g, "").replace(",", ".")) || 0;
      totalInput.value = parseFloat(totalInput.value.replace(/[^0-9,-]+/g, "").replace(",", ".")) || 0;
    });
  });
</script>




<script>
  $(document).ready(function() {
    $('.select2').select2();

    $('#kode_barang').change(function() {
      var selectedOption = $(this).find('option:selected');
      var namaBarang = selectedOption.data('nama');
      $('#nama_barang').val(namaBarang);
    });
  });
</script>




<?php
include 'wibjs.php';
?>

<script>
  function displayHasil(tgl_awal) {
    document.getElementById("tgl_awalHasil").value = tgl_awal;
  };
</script>

<script type="text/javascript">
  jQuery(document).ready(function(event) {
    var x0 = document.getElementById("isian0");
    var x1 = document.getElementById("isian1");
    var x2 = document.getElementById("isian2");

    x1.style.display = "none";
    x2.style.display = "none";

  });
</script>

<!-- Cakupan ========== -->
<script>
  function displayResult(cakup) {
    document.getElementById("result").value = cakup;
    var x = document.getElementById("result").value;
    var x0 = document.getElementById("isian0");
    var x1 = document.getElementById("isian1");
    var x2 = document.getElementById("isian2");
    if (x == "Nasional") {
      x0.style.display = "block";
      x1.style.display = "none";
      x2.style.display = "none";
      // alert(x + " adalah Cakupan 2");
    } else if (x == "Kota") {
      x0.style.display = "none";
      x1.style.display = "block";
      x2.style.display = "none";
      // alert(x + " adalah Cakupan 3");
    } else if (x == "Outlet") {

      x0.style.display = "none";
      x1.style.display = "none";
      x2.style.display = "block";
      // alert(x + " adalah Cakupan 4");
    }
  }
</script>
<!-- Cakupan ========== -->

<script type="text/javascript">
  <?php
  if (isset($_GET['alert'])) {
    if ($_GET['alert'] == "gagal") {
      echo "<div class='alert alert-danger'>File yang diperbolehkan hanya file gambar!</div>";
    } elseif ($_GET['alert'] == "duplikat") {
      echo "<div class='alert alert-danger'><b>Kode Barang</b> sudah pernah digunakan!</div>";
    }
  }
  ?>
</script>

<style>
  .file {
    visibility: hidden;
    position: absolute;
  }
</style>

<script>
  function konfirmasi() {
    konfirmasi = confirm("Apakah anda yakin ingin menghapus gambar ini?")
    document.writeln(konfirmasi)
  }

  $(document).on("click", "#pilih_gambar", function() {
    var file = $(this).parents().find(".file");
    file.trigger("click");
  });

  $('input[type="file"]').change(function(e) {
    var fileName = e.target.files[0].name;
    $("#file").val(fileName);

    var reader = new FileReader();
    reader.onload = function(e) {
      // get loaded data and render thumbnail.
      document.getElementById("preview").src = e.target.result;
    };
    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
  });
</script>