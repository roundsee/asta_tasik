<?php
$dir = '../../../../';
session_start();

include $dir . 'config/koneksi.php';
include $dir . 'config/library.php';


$judulform = "Daftar Pembelian";

$data = 'data_beli';
$rute = 'pembelian';
$aksi = 'aksi_beli';

$tabel = 'pembelian';

$f1 = 'kd_beli';
$f2 = 'tgl_beli';
$f3 = 'kd_supp';
$f4 = 'ket_payment';
$f5 = 'status_payment';
$f6 = 'jenis_po';
$f7 = 'ppn';



$j1 = 'Kode Pembelian';
$j2 = 'Tanggal';
$j3 = 'Kode Supplier';
$j4 = 'Keterangan';
$j5 = 'Status';
$j6 = 'Jenis';
$j7 = 'PB1';


$tabel2 = 'pembelian_detail';

$ff1 = 'kd_beli';
$ff2 = 'kd_brg';
$ff3 = 'jml';
$ff4 = 'price';
$ff5 = 'currency';
$ff6 = 'kurs';
$ff7 = 'disc';
$ff8 = 'urut';
$ff9 = 'satuan';


$jj1 = 'Kode Beli';
$jj2 = 'Kode Barang';
$jj3 = 'Jumlah';
$jj4 = 'Price';
$jj5 = 'Currency';
$jj6 = 'Kurs';
$jj7 = 'Discount';
$jj8 = 'urut';
$jj9 = 'Satuan';

$rek_tujuan = 'rek_tujuan';
$r1 = 'no_rek';
$r2 = 'nama_bank';
$r3 = 'atas_nama';
$r4 = 'cat1';

$jr1 = 'No Rekening';
$jr2 = 'Nama Bank';
$jr3 = 'Atas Nama';
$jr4 = 'Cat 1';

include '../header.php';
?>
<style>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</style>
<table class="table-responsive">
  <form method="post" enctype="multipart/form-data" action="<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=input-baru">

    <div class="row">
      <!-- kiri -->
      <div class="col-lg-7">

        <div class="row">
          <!-- <div class="col-lg-2">
            <div class="form-group">
              <label>ID User</label>
              <input type="text" name="<?php echo $f18; ?>" class="form-control" value="<?php echo $kode_pengaju; ?>" readonly />
            </div>
          </div> -->

          <div class="col-lg-3">
            <div class="form-group">
              <label>Tgl Pembelian</label>
              <input type="date" class="form-control" name="<?php echo $f2; ?>" onclick="displayHasil(this.value)" placeholder="Masukan <?php echo $j2; ?> (Wajib)" value="<?php echo date('Y-m-d') ?>" readonly>
            </div>
          </div>

          <!-- <div class="col-lg-3">
            <div class="form-group">
              <label>Tgl Pembelian</label>
              <input type="date" class="form-control" name="<?php echo $f2; ?>" onclick="displayHasil(this.value)" placeholder="Masukan <?php echo $j2; ?> (Wajib)" value="<?php echo date('Y-m-d') ?>" readonly>
            </div>
          </div> -->

          <!-- <div class="col-lg-3">
            <div class="form-group">
              <label><?php echo $j9; ?></label>
              <input type="date" class="form-control" name="<?php echo $f9; ?>" onclick="displayHasil(this.value)" placeholder="Masukan <?php echo $j9; ?> (Wajib)" value="<?php echo date('Y-m-d') ?>">
            </div>
          </div> -->

          <div class="col-lg-5">
            <div class="form-group">
              <label><?php echo $j3; ?></label>
              <select name="<?php echo $f3; ?>" class="form-control">
                <option></option>
                <?php

                $query = mysqli_query($koneksi, "SELECT * from supplier");
                while ($x = mysqli_fetch_array($query)) {
                  echo "<option value='$x[kd_supp]'>$x[kd_supp] - $x[nama]</option>";
                }
                ?>
              </select>

            </div>

          </div>
          <div class="col-lg-2">
            <div class="form-group">
              <label>PPn</label>
              <select name="<?php echo $f7; ?>" id="pilihan" class="form-control" />
              <option value=0>Non PPN</option>
              <option value=1>PPN</option>
              </select>
            </div>
          </div>



        </div>
        <!-- <div class="row">
          <label>Tambah No rekening Baru</label>
        </div> -->

        <!-- <div class="row">

         <div class="col-lg-2">
          <div class="form-group">
            <label><?php echo $j4; ?></label>
            <input type="text" name="<?php echo $f4; ?>" class="form-control"  placeholder="Masukan <?php echo $j4; ?> ..."/>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="form-group">
            <label><?php echo $j5; ?></label>
            <input type="text" name="<?php echo $f5; ?>" class="form-control"  placeholder="Masukan <?php echo $j5; ?> ..."/>
          </div>
        </div>

        <div class="col-lg-3">
          <div class="form-group">
            <label><?php echo $j6; ?></label>
            <input type="text" name="<?php echo $f6; ?>" class="form-control"  placeholder="Masukan <?php echo $j6; ?> ..."/>
          </div>
        </div>

      </div> -->

      </div>

      <!-- kanan -->
      <div class="col-lg-5">

        <div class="form-group">
          <label><?php echo $j4; ?></label>
          <textarea name="<?php echo $f4; ?>" class="form-control" placeholder="Masukan <?php echo $j4; ?> ..." rows="3" cols="5" required="required"></textarea>
        </div>
      </div>

    </div>


    <div class="content-wrapper" style="min-height: 10%; padding-bottom: 1px;">
      <div class="form-group">
        <h5>Data Details</h5>
      </div>

  

        <div class="row">
          <div class="col-lg-3">
            <div class="form-group">
              <label>Kode Barang</label>
              <select name="<?php echo $ff2; ?>" id="kd_acc" class="form-control select2" style="width:100%;" required>
                <option></option>
                <?php
                $produk = mysqli_query($koneksi, "SELECT * FROM barang");
                while ($pro = mysqli_fetch_array($produk)) {
                  echo "<option value='{$pro['kd_brg']}'
                  data-harga='{$pro['hrg_pcs']}'
                  data-pcs='{$pro['Pcs']}'
                  data-renteng='{$pro['Renteng']}'
                  data-pak='{$pro['Pak']}'
                  data-ikat='{$pro['ikat']}'
                  data-ball='{$pro['Ball']}'
                  data-box='{$pro['Box']}'
                  data-dus='{$pro['Dus']}'>
                  {$pro['kd_brg']} - {$pro['nama']}</option>";
                        }
                ?>
              </select>
            </div>
          </div>

          <div class="col-lg-3">
            <div class="form-group">
              <label>Nama Barang</label>
              <input type="text" class="form-control" id="nama_account" name="uraian" placeholder="Autofill by Account" readonly>
            </div>
          </div>

          <div class="col-lg-2">
            <div class="form-group">
              <label>Satuan</label>
              <select name="<?php echo $ff9; ?>" id="pilihan" class="form-control">
                <option value="pcs">Pcs</option>
                <option value="renteng">Renteng</option>
                <option value="pak">Pak</option>
                <option value="ikat">Ikat</option>
                <option value="ball">Ball</option>
                <option value="box">Box</option>
                <option value="dus">Dus</option>
              </select>
            </div>
          </div>



          <!-- <div class="col-lg-3">
            <div class="form-group">
              <label>Harga per pcs</label>
              <input type="text" id="harga_pcs" class="form-control" readonly>
            </div>
          </div> -->

          <!-- <div class="col-lg-2">
            <div class="form-group">
              <label>Total pcs</label>
              <input type="text" id="total_pcs" class="form-control" readonly>
            </div>
          </div> -->

        </div>
      </div>

      <div class="col-lg-2">
        <div class="form-group">
          <label><?php echo $jj3; ?></label>
          <input type="text" name="<?php echo $ff3; ?>" id="tanpa-rupiah" class="form-control" placeholder="Masukan <?php echo $jj3; ?>" required>
        </div>
      </div>


      <div class="col-lg-2">
        <div class="form-group">
          <label><?php echo $jj4; ?></label>
          <input type="text" name="<?php echo $ff4; ?>" id="tanpa-rupiah" class="form-control" placeholder="Masukan <?php echo $jj4; ?>" required>
        </div>
      </div>

    </div>

    <div class="form-group">
      <hr />
      <input type="hidden" name="<?php echo $f5; ?>" values="">
      <input type="hidden" name="<?php echo $f6; ?>" values="">

      <input type="hidden" name="<?php echo $ff5; ?>" values="">
      <input type="hidden" name="<?php echo $ff6; ?>" values=0>

      <input type="submit" class="btn btn-primary elevation-2" style="opacity: .7" value="Simpan">
    </div>
    </div>

  </form>

  <a href="../../main.php?route=<?php echo $rute; ?>&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=<?php echo $rute; ?>"><button class="btn btn-primary btn-sm elevation-1" style="opacity: .7">Back</button></a>

</table>

<?php
include '../footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>



<script type="text/javascript">
  $(function() {
    $('.select2').select2({
      theme: 'bootstrap4'
    });

    // Saat kode barang diubah
    $('#kd_acc').on('change', function() {
      var selectedOption = $(this).find('option:selected');
      var selectedOptionText = selectedOption.text();
      var parts = selectedOptionText.split(' - ');

      // Isi nama barang
      $('#nama_account').val(parts[1]);

      // Isi harga per pcs
      $('#harga_pcs').val(selectedOption.data('harga'));

      // Debugging: Menampilkan data dari opsi yang dipilih
      console.log('Data dari opsi barang:', selectedOption.data());

      // Perbarui total pcs sesuai satuan yang dipilih
      updateTotalPcs();
    });

    $('#pilihan').on('change', function() {
      // Perbarui total pcs ketika satuan diubah
      updateTotalPcs();
    });

    function updateTotalPcs() {
      var selectedOption = $('#kd_acc').find('option:selected');
      var satuan = $('#pilihan').val(); // Mengambil satuan yang dipilih

      // Debugging: Menampilkan pilihan satuan di konsol
      console.log('Satuan yang dipilih (dari dropdown):', satuan);

      // Ambil nilai sesuai dengan satuan yang dipilih
      var total = selectedOption.data(satuan); // Ambil data yang sesuai dengan satuan

      // Debugging: Memastikan bahwa total pcs terupdate
      console.log('Total pcs (dari data-satuan):', total);

      // Tampilkan nilai pada input total_pcs
      if (total !== undefined) {
        $('#total_pcs').val(total);
      } else {
        $('#total_pcs').val('0'); // Jika total tidak ditemukan, set ke 0
      }
    }
  });
</script>
<!-- 
<script type="text/javascript">
  $(document).ready(function() {
    function autosplitaccount() {
      var input = $('#kd_acc').val();
      var parts = input.split('-');
      $('#kode_account').val(parts[0]);
      $('#nama_account').val(parts[1]);
    }
    $('#kd_acc').on('change', autosplitaccount);
  });
</script> -->

<script type="text/javascript">
  $(document).ready(function() {
    $("#account").autocomplete({
      minLength: 2,
      source: 'get_account.php',
      select: function(event, ui) {
        $('#uraian').html(ui.item.uraian);
        $('#kasbank').html(ui.item.kasbank);
        $('#pph').html(ui.item.pph);
        $('#penampung').html(ui.item.penampung);
      }
    });
  });
</script>


<script type="text/javascript">
  $(document).ready(function() {
    $("#kodebrg").autocomplete({
      minLength: 2,
      source: 'get_product.php',
      select: function(event, ui) {
        $('#nama').html(ui.item.nama);
        $('#unit').html(ui.item.unit);
        $('#harga').html(ui.item.harga);
      }
    });
  });
</script>