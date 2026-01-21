<?php
$dir = '../../../../';
session_start();

include $dir . 'config/koneksi.php';
include $dir . 'config/library.php';


$judulform = "Daftar Pembelian";

$data = 'data_beli';
$rute = 'beli';
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
$j4 = 'Ket';
$j5 = 'Status';
$j6 = 'Jenis';
$j7 = 'Ppn';

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
$ff10 = 'jumlah_pcs';


$jj1 = 'Kode Beli';
$jj2 = 'Kode Barang';
$jj3 = 'Jumlah';
$jj4 = 'Price';
$jj5 = 'Currency';
$jj6 = 'Kurs';
$jj7 = 'Discount';
$jj8 = 'urut';
$jj9 = 'Satuan';
$jj10 = 'Jumlah Pcs';

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
<div class="table-responsive">
  <form method="post" enctype="multipart/form-data" action="<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=input-baru">

    <div class="row">
      <!-- kiri -->
      <div class="col-lg-7">

        <div class="row">
          <div class="col-lg-3">
            <div class="form-group">
              <label>Tgl Pembelian</label>
              <input type="date" class="form-control" name="<?php echo $f2; ?>" placeholder="Masukan <?php echo $j2; ?> (Wajib)" value="<?php echo date('Y-m-d') ?>" readonly>
            </div>
          </div>

          <div class="col-lg-5">
            <div class="form-group">
              <label><?php echo $j3; ?></label>
              <select name="<?php echo $f3; ?>" id="supplier_select" class="form-control">
                <option></option>
                <?php
                $query = mysqli_query($koneksi, "SELECT * from supplier");
                while ($x = mysqli_fetch_array($query)) {
                  echo "<option value='$x[kd_supp]'>$x[kd_supp] - $x[nama] - $x[term]</option>";
                }
                ?>
              </select>
            </div>
          </div>
          <div class="col-lg-2">
            <div class="form-group">
              <label>PPn</label>
              <select name="<?php echo $f7; ?>" id="pilihan" class="form-control">
                <option value=0>Non PPN</option>
                <option value=1>PPN</option>
              </select>
            </div>
          </div>
        </div>
      </div>

      <!-- kanan -->
      <div class="col-lg-5">
        <div class="form-group">
          <label><?php echo $j4; ?></label>
          <textarea name="<?php echo $f4; ?>" id="ket" class="form-control" placeholder="Masukan <?php echo $j4; ?> ..." rows="3" cols="5" required="required"></textarea>
        </div>
      </div>
    </div>

    <div class="content-wrapper" style="min-height: 10%; padding-bottom: 1px;">
      <div class="form-group">
        <h5>Data Details</h5>
      </div>
      <div class="row">
        <!-- Detail Barang -->
        <div class="col-lg-3">
          <div class="form-group">
            <label>Kode Barang</label>
            <select name="<?php echo $ff2; ?>" id="kd_acc" class="form-control select2" style="width:100%;">
              <!-- Barang akan diisi secara dinamis melalui JavaScript -->
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
            <select name="<?php echo $ff9; ?>" id="satuan" class="form-control">
              <option value="">Pilih Satuan</option>
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

        <div class="col-lg-2">
          <div class="form-group">
            <label>Isi </label>
            <input type="text" id="total_pcs" class="form-control" readonly>
          </div>
        </div>

        <div class="col-lg-2">
          <div class="form-group">
            <label><?php echo $jj3; ?></label>
            <input type="text" name="<?php echo $ff3; ?>" id="jumlah" class="form-control" placeholder="Masukan <?php echo $jj3; ?>">
          </div>
        </div>

        <div class="col-lg-2">
          <div class="form-group">
            <label>Jumlah Total</label>
            <input type="text" name="<?php echo $ff10; ?>" id="hasil_perkalian" class="form-control" readonly>
          </div>
        </div>

        <div class="col-lg-2">
          <div class="form-group">
            <label><?php echo $jj4; ?></label>
            <input type="text" name="<?php echo $ff4; ?>" id="harga" class="form-control" placeholder="Masukan <?php echo $jj4; ?>">
          </div>
        </div>
      </div>

      <div class="form-group">
        <hr />
        <input type="hidden" name="<?php echo $f5; ?>" value="">
        <input type="hidden" name="<?php echo $f6; ?>" value="">

        <input type="hidden" name="<?php echo $ff5; ?>" value="">
        <input type="hidden" name="<?php echo $ff6; ?>" value=0>

        <div id="formControls">
          <p>Silakan tambahkan barang yang belum terdaftar pada supplier. Saat Anda menyimpan, sistem akan otomatis memproses pembelian barang tersebut.</p>
        </div>
        <button id="addFormButton" type="button" class="btn btn-primary btn-sm elevation-2" style="opacity: .7;">
          <i class="fa fa-plus"></i> Tambah Barang
        </button>
      </div>
      <div id="newFormContainer"></div>
      <div id="formFooter" style="display:none;">
      </div>

      <input type="submit" class="btn btn-primary elevation-2" style="opacity: .7" value="Simpan">
    </div>
  </form>

  <a href="../../main.php?route=<?php echo $rute; ?>&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=<?php echo $rute; ?>">
    <button class="btn btn-primary btn-sm elevation-1 mt-2" style="opacity: .7">Back</button>
  </a>
</div>
<hr>

<!-- <form id="inputDetailForm" method="post" enctype="multipart/form-data" action="<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=input-detail-supllier-barang"> -->
<script>
  document.getElementById('addFormButton').addEventListener('click', function() {
    var formFooter = document.getElementById('formFooter');
    var newFormContainer = document.getElementById('newFormContainer');

    var newFormFieldsHtml = `
      <div class="row">
        <div class="col-12">
            <div class="form-group">
                <h5>Data Detail</h5>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label for="">Barang</label>
                <select name="kd_acc2[]" class="form-control select2" style="width:100%;" required>
                    <option></option>
                    <?php
                    $produk = mysqli_query($koneksi, "SELECT * FROM barang");
                    while ($pro = mysqli_fetch_array($produk)) {
                      // echo "<option value='{$pro['kd_brg']}'>{$pro['kd_brg']} - {$pro['nama']}</option>";
                      echo  "
<option value='{$pro['kd_brg']}'
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
                <label>Kode Barang</label>
                <input type="text" class="form-control kode_account" name="kd_acc[]" placeholder="Autofill by Account" readonly>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label>Nama Barang</label>
                <input type="text" class="form-control nama_account" name="uraian[]" placeholder="Autofill by Account" readonly>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="form-group">
                <label>Satuan</label>
                <select name="satuan[]" class="form-control">
                    <option>Pilih Satuan </option>
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
        <div class="col-lg-2">
            <div class="form-group">
                <label>Isi</label>
                <input type="text" class="form-control" name="total_pcs[]" readonly>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="form-group">
                <label>Jumlah</label>
                <input type="text" class="form-control" name="jumlah[]" placeholder="Masukan Jumlah" required>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="form-group">
                <label>Jumlah Total</label>
                <input type="text" class="form-control" name="hasil_perkalian[]" readonly>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="form-group">
                <label>Harga</label>
                <input type="text" class="form-control" name="price[]" placeholder="Masukan  Harga" required>
            </div>
        </div>
        <div class="col-lg-1 d-flex align-items-center">
            <button type="button" class="btn btn-danger btn-sm remove-form">Hapus</button>
        </div>
      </div>
      <hr>
    `;


    var newFormElement = document.createElement('div');
    newFormElement.innerHTML = newFormFieldsHtml;
    newFormContainer.appendChild(newFormElement);

    if (!formFooter.classList.contains('initialized')) {
      formFooter.style.display = 'block';
      formFooter.classList.add('initialized');
    }

    $(newFormElement).find('.select2').select2({
      theme: 'bootstrap4'
    });

    $(newFormElement).find('select[name="kd_acc2[]"]').on('change', function() {
      var selectedOption = $(this).find('option:selected');
      var kdBrg = selectedOption.val().trim();
      console.log('kode barangnya adalah ' + kdBrg);
      var namaBrg = selectedOption.text().split(' - ')[1].trim();

      $(this).closest('.row').find('.kode_account').val(kdBrg);
      $(this).closest('.row').find('.nama_account').val(namaBrg);
    });

    $(newFormElement).find('.remove-form').on('click', function() {
      $(this).closest('.row').remove();
      if (newFormContainer.children.length === 0) {
        formFooter.style.display = 'none';
      }
    });

    $(newFormElement).find('select[name="satuan[]"]').on('change', function() {
      updateTotalPcs($(this).closest('.row'));
    });

    $(newFormElement).find('input[name="jumlah[]"]').on('input', function() {
      updateHasilPerkalian($(this).closest('.row'));
    });

    function updateTotalPcs(row) {
      var selectedOption = row.find('select[name="kd_acc2[]"]').find('option:selected');
      var satuan = row.find('select[name="satuan[]"]').val();
      var totalPcs = selectedOption.data(satuan) || 0;

      row.find('input[name="total_pcs[]"]').val(totalPcs + ' Pcs');
      updateHasilPerkalian(row);
    }

    function updateHasilPerkalian(row) {
      var totalPcs = parseFloat(row.find('input[name="total_pcs[]"]').val()) || 0;
      var jumlah = parseFloat(row.find('input[name="jumlah[]"]').val()) || 0;

      var hasilPerkalian = totalPcs * jumlah;
      row.find('input[name="hasil_perkalian[]"]').val(hasilPerkalian + ' Pcs');
    }
  });
</script>





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

<script type="text/javascript">
  document.getElementById('harga').addEventListener('input', function(e) {
    // Mengambil nilai input tanpa karakter non-digit
    var input = e.target.value.replace(/[^,\d]/g, '');

    // Memisahkan nilai menjadi ribuan
    var formattedInput = new Intl.NumberFormat('id-ID', {
      style: 'currency',
      currency: 'IDR',
      minimumFractionDigits: 0
    }).format(input);

    // Mengupdate nilai input dengan format rupiah
    e.target.value = formattedInput.replace('Rp', '').trim(); // Menghilangkan "Rp" dari tampilan jika diperlukan
  });

  $(document).ready(function() {
    // $('.select2').select2({
    //   theme: 'bootstrap4'
    // });

    // Inisialisasi Select2 dengan tema Bootstrap 4 dan placeholder
    $('#supplier_select').select2({
      theme: 'bootstrap4',
      placeholder: 'Pilih Supplier',
      allowClear: true
    });
    // Inisialisasi Select2 dengan tema Bootstrap 4 dan placeholder
    $('#supplier_select2').select2({
      theme: 'bootstrap4',
      placeholder: 'Pilih Supplier',
      allowClear: true
    });

    $('#kd_acc').select2({
      theme: 'bootstrap4',
      placeholder: 'Pilih Kode Barang',
      allowClear: true
    });


    $('#supplier_select').on('change', function() {
      var selectedOption = $(this).find('option:selected');
      var kdSupp = $(this).val();
      var term = selectedOption.text().split(' - ')[2]; // Ambil nilai 'term' dari teks opsi

      // Log untuk memastikan bahwa kd_supp dipilih dengan benar
      console.log('kd_supp yang dipilih:', kdSupp);
      console.log('Term:', term);

      // Isi kolom 'ket' dengan nilai 'term'
      $('#ket').val(term);

      $.ajax({
        url: 'get_barang.php',
        type: 'POST',
        data: {
          kd_supp: kdSupp
        },
        success: function(data) {
          console.log('Response dari server:', data);
          $('#kd_acc').html(data);
          $('#nama_account').val('');
          $('#total_pcs').val('');
          $('#harga_pcs').val('');
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.error('AJAX Error:', textStatus, errorThrown);
        }
      });
    });

    $('#kd_acc').on('change', function() {
      var selectedOption = $(this).find('option:selected');
      var selectedOptionText = selectedOption.text();
      var parts = selectedOptionText.split(' - ');

      // Isi nama barang
      $('#nama_account').val(parts[1]);

      // Isi harga per pcs
      $('#harga_pcs').val(selectedOption.data('harga'));
      // $('#total_pcs').val(selectedOption.data('dus'));
      // Menentukan total pcs berdasarkan satuan yang dipilih
      updateTotalPcs();

      // Logging untuk debugging
      console.log('Selected Kode Barang:', selectedOption.val());
      console.log('Harga per pcs:', selectedOption.data('harga'));
      // console.log('Total pcs:', selectedOption.data('dus'));
    });

    $('#satuan').on('change', function() {
      // Update total pcs setiap kali satuan berubah
      updateTotalPcs();

      // Menampilkan alert dengan nilai yang dipilih
      const selectedValue = $(this).val();
      // alert('Anda memilih: ' + selectedValue);
    });

    $('#jumlah').on('input', function() {
      // Update hasil perkalian setiap kali nilai jumlah berubah
      updateHasilPerkalian();
    });


    function updateTotalPcs() {
      var selectedOption = $('#kd_acc').find('option:selected');
      var satuan = $('#satuan').val();
      var totalPcs = selectedOption.data(satuan);

      // Mengisi nilai total pcs sesuai satuan yang dipilih
      $('#total_pcs').val(totalPcs + ' Pcs');
      // Perbarui hasil perkalian jika jumlah sudah diisi
      updateHasilPerkalian();
    }

    function updateHasilPerkalian() {
      var totalPcs = $('#total_pcs').val();
      var jumlah = $('#jumlah').val();

      // Pastikan totalPcs dan jumlah adalah angka
      var hasilPerkalian = (parseFloat(totalPcs) || 0) * (parseFloat(jumlah) || 0);

      // Mengisi hasil perkalian ke form group baru
      $('#hasil_perkalian').val(hasilPerkalian + ' Pcs');
    }

  });
</script>


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