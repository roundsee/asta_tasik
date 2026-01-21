<?php
$dir = '../../../../';
session_start();

include $dir . 'config/koneksi.php';
include $dir . 'config/library.php';

$employee = $_SESSION['employee_number'];



// Query untuk mendapatkan kd_cus berdasarkan employee_number
$query = "SELECT user_login.kd_cus, pelanggan.nama AS nama_pelanggan 
          FROM user_login 
          JOIN pelanggan ON pelanggan.kd_cus = user_login.kd_cus 
          WHERE user_login.employee_number = '$employee'";
$result = mysqli_query($koneksi, $query);

// Tambahkan pengecekan error pada query
if (!$result) {
  die("Query Error: " . mysqli_error($koneksi));
}

// Cek apakah ada hasil
if (mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
  $kd_cus = $row['kd_cus'];
  $nama_cus = $row['nama_pelanggan'];
  echo "kd_cus untuk employee number $employee adalah: $kd_cus, Nama Pelanggan: $nama_cus";
} else {
  echo "Data tidak ditemukan untuk employee number $employee";
}




$judulform = "Transfer inventory";

$data = 'data_transfer_inventory';
$rute = 'transfer_inventory';
$aksi = 'aksi_transfer_inventory';
$view = 'transfer_inventory_view';

$rute_detail = 'transfer_inventory_detail';
$tabel = 'transfer_inventory';

// Variabel untuk nama kolom tabel transfer_inventory
$f1 = 'nomor_pengiriman';
$f2 = 'tgl_permintaan';
$f3 = 'tgl_dikirim';
$f4 = 'kd_pengirim';
$f5 = 'kd_penerima';
$f6 = 'status_transfer';

// Variabel untuk label kolom
$j1 = 'Nomor Pengiriman';
$j2 = 'Tanggal Permintaan';
$j3 = 'Tanggal Dikirim';
$j4 = 'Kode Pengirim';
$j5 = 'Kode Penerima';
$j6 = 'Status Transfer';

$tabel2 = 'transfer_inventory_detail';

// Variabel untuk nama kolom tabel transfer_inventory_detail
$ff1 = 'nomor_pengiriman';
$ff2 = 'kd_brg';
$ff3 = 'jml';
$ff4 = 'jumlah_pcs';
$ff5 = 'jumlah_datang';
$ff6 = 'harga';
$ff7 = 'disc';
$ff8 = 'satuan';
$ff9 = 'urut';

// Variabel untuk label kolom
$jj1 = 'Nomor Pengiriman';
$jj2 = 'Kode Barang';
$jj3 = 'Jumlah';
$jj4 = 'Jumlah PCS';
$jj5 = 'Jumlah Datang';
$jj6 = 'Harga';
$jj7 = 'Diskon';
$jj8 = 'Satuan';
$jj9 = 'Urut';




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

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<div class="table-responsive">
  <form method="post" enctype="multipart/form-data" action="<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=input-baru">

    <div class="row">
      <!-- kiri -->
      <div class="col-lg-7">

        <div class="row">
          <div class="col-lg-3">
            <div class="form-group">
              <label>Tanggal Permintaan Barang</label>
              <input type="date" class="form-control" name="<?php echo $f2; ?>" placeholder="Masukan <?php echo $j2; ?> (Wajib)" value="<?php echo date('Y-m-d') ?>">
            </div>
          </div>

          <!-- <div class="col-lg-5">
            <div class="form-group">
              <label><?php echo $j3; ?></label>
              <select name="<?php echo $f3; ?>" id="supplier_select" class="form-control" required>
                <option></option>
                <?php
                $query = mysqli_query($koneksi, "SELECT * from supplier");
                while ($x = mysqli_fetch_array($query)) {
                  echo "<option value='$x[kd_supp]'>$x[kd_supp] - $x[nama] - $x[term]</option>";
                }
                ?>
              </select>
            </div>
          </div> -->
          <!-- <div class="col-lg-2">
            <div class="form-group">
              <label>PPn</label>
              <select name="<?php echo $f7; ?>" id="pilihan" class="form-control">
                <option value=0>Non PPN</option>
                <option value=1>PPN</option>
              </select>
            </div>
          </div> -->
          <!-- <div class="col-lg-2" style="display: none;" id="ppn-options">
            <div class="form-group">
              <label for="">Tarif PPN</label>
              <select name="tarif_ppn" id="tarif_ppn" class="form-control">
                <option value="11">PPN 11%</option>
                <option value="12">PPN 12%</option>
              </select>
            </div>
          </div> -->
          <div class="col-lg-4">
            <label>Tujuan Kirim</label>
            <select class="form-control" name="<?php echo $f5; ?>" id="">
              <option value="">Tujuan Kirim</option>
              <?php
              // Ambil data pelanggan dari database untuk dropdown
              $query = mysqli_query($koneksi, "SELECT kd_cus, nama, alamat FROM pelanggan WHERE kd_cus != '0000'");
              while ($x = mysqli_fetch_assoc($query)) {
                // Tampilkan semua data pelanggan sebagai opsi dropdown
                echo "<option value='{$x['kd_cus']}'>{$x['kd_cus']} - {$x['nama']}</option>";
              }
              ?>
            </select>
          </div>
          <div class="col-lg-4">
            <label>Permintaan Kepada</label>
            <select class="form-control" name="<?= $f4; ?>" id="">
              <option value="">Permintaan Kepada</option>
              <?php
              // Ambil data pelanggan dari database untuk dropdown
              $query = mysqli_query($koneksi, "SELECT kd_cus, nama, alamat FROM pelanggan WHERE kd_cus != '0000'");
              while ($x = mysqli_fetch_assoc($query)) {
                // Tampilkan semua data pelanggan sebagai opsi dropdown
                echo "<option value='{$x['kd_cus']}'>{$x['kd_cus']} - {$x['nama']}</option>";
              }
              ?>
            </select>
          </div>

          <!-- <div class="col-lg-3">
            <div class="form-group">

              <label>Tujuan Kirim</label>
              <input type="text" class="form-control" value="<?php echo $kd_cus ?> - <?php echo $nama_cus ?>" readonly>
              <input type="hidden" class="form-control" value="<?php echo $kd_cus ?>" name="<?php echo $f15 ?>" readonly>
            </div>
          </div> -->
        </div>
      </div>

      <script>
        document.getElementById('pilihan').addEventListener('change', function() {
          var ppnValue = this.value;
          var ppnOptions = document.getElementById('ppn-options');

          if (ppnValue === '1') {
            ppnOptions.style.display = 'block';
          } else {
            ppnOptions.style.display = 'none';
          }
        })
      </script>


    </div>

    <div class="content-wrapper" style="min-height: 10%; padding-bottom: 1px;">
      <div class="form-group" id="data-details">
        <h5>Data Details</h5>
      </div>
      <div class="row" id="row-details">
        <!-- Detail Barang -->
        <div class="col-lg-3">
          <div class="form-group">
            <label>Kode Barang</label>
            <select name="<?php echo $ff2; ?>" id="kd_acc" class="form-control select2" style="width:100%;" name="kode_barang" required>
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
            <select name="<?php echo $ff9; ?>" id="satuan" class="form-control" required>
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
            <input type="text" name="<?php echo $ff10; ?>" id="total_pcs" class="form-control" readonly>
          </div>
        </div>


        <div class="col-lg-2">
          <div class="form-group">
            <label><?php echo $jj3; ?></label>
            <input type="text" name="<?php echo $ff3; ?>" id="jumlah" data-format="currency" class="form-control" placeholder="Masukan <?php echo $jj3; ?>" value="0" required>
          </div>
        </div>

        <div class="col-lg-2">
          <div class="form-group">
            <label>Banyak Total (PCS)</label>
            <input type="text" id="hasil_perkalian" class="form-control" readonly>
          </div>
        </div>


        <div class="col-lg-2">
          <div class="form-group">
            <label>Harga Satuan</label>
            <input type="text" name="<?php echo $ff4; ?>" id="harga" data-format="currency" class="form-control " placeholder="Masukan <?php echo $jj4; ?>" value="0" required>
          </div>
        </div>
        <div class="col-lg-2">
          <div class="form-group">
            <label>Harga Total</label>
            <input type="text" name="" id="harga_total" data-format="currency" class="form-control " placeholder="Masukan Total Seluruh Harga ?>" value="0" required>
          </div>
        </div>
        <div class="col-lg-2">
          <div class="form-group">
            <label><?php echo $jj7; ?></label>
            <input type="text" name="<?php echo $ff7; ?>" id="dc" data-format="currency" class="form-control " placeholder="Masukan <?php echo $jj7; ?>" value="0" required>
          </div>
        </div>

      </div>

      <script>
        // Ambil elemen input
        const jumlahInput = document.getElementById('jumlah');
        const hargaInput = document.getElementById('harga');
        const hargaTotalInput = document.getElementById('harga_total');
        // Fungsi untuk menghapus format ribuan
        function cleanCurrency(value) {
          return parseFloat(value.replace(/\./g, '').replace(',', '.')) || 0;
        }


        // Fungsi untuk menghitung harga total
        function hitungHargaTotal() {
          const jumlah = parseFloat(jumlahInput.value) || 0;
          const harga = cleanCurrency(hargaInput.value);
          hargaTotalInput.value = new Intl.NumberFormat('id-ID').format(jumlah * harga);
        }

        // Fungsi untuk menghitung harga satuan
        function hitungHargaSatuan() {
          const jumlah = parseFloat(jumlahInput.value) || 0;
          const hargaTotal = cleanCurrency(hargaTotalInput.value);
          if (jumlah > 0) {
            hargaInput.value = new Intl.NumberFormat('id-ID').format(hargaTotal / jumlah);
          }
        }

        // Tambahkan event listener untuk setiap input
        jumlahInput.addEventListener('input', () => {
          hitungHargaTotal();
          hitungHargaSatuan();
        });

        hargaInput.addEventListener('input', hitungHargaTotal);
        hargaTotalInput.addEventListener('input', hitungHargaSatuan);
      </script>


      <div class="form-group">
        <hr />
        <!-- <input type="hidden" name="<?php echo $f5; ?>" value=""> -->
        <input type="hidden" name="<?php echo $f6; ?>" value="">

        <input type="hidden" name="<?php echo $ff5; ?>" value="">
        <input type="hidden" name="<?php echo $ff6; ?>" value=0>

        <div id="formControls">
          <!-- <p>Silakan tambahkan barang yang belum terdaftar pada supplier. Saat Anda menyimpan, sistem akan otomatis memproses Purchase Request tersebut.</p> -->
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
  $("#data-details, #row-details").hide();

  document.getElementById('addFormButton').addEventListener('click', function() {
    $("#data-details, #row-details").hide();
    $("#row-details input[required], #row-details select[required]").each(function() {
      $(this).removeAttr('required');
    });
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
                <select name="kd_acc2[]" class="form-control select2" style="width:100%;" >
                    <option></option>
                    <?php
                    $produk = mysqli_query($koneksi, "SELECT * FROM barang");
                    while ($pro = mysqli_fetch_array($produk)) {
                      // echo "<option value='{$pro['kd_brg']}'>{$pro['kd_brg']} - {$pro['nama']}</option>";
                      echo  "
                      <option value='{$pro['kd_brg']}'
                      data-harga='{$pro['hrg_pcs']}'
                      data-pcs='{$pro['qty_satuan1']}'
                      data-renteng='{$pro['qty_satuan2']}'
                      data-pak='{$pro['qty_satuan3']}'
                      data-ikat='{$pro['qty_satuan4']}'
                      data-ball='{$pro['qty_satuan5']}'
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
                <select name="satuan[]" class="form-control" >
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
                <label>Isi (PCS)</label>
                <input type="text" class="form-control" data-format="currency" name="total_pcs[]" readonly>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="form-group">
                <label>Banyak</label>
                <input type="text" class="form-control" data-format="currency" name="jumlah[]" placeholder="Masukan Jumlah" required>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="form-group">
                <label>Banyak Total (PCS)</label>
                <input type="text" class="form-control" name="hasil_perkalian[]" readonly>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="form-group">
                <label>Harga Satuan</label>
                <input type="text" class="form-control price" data-format="currency"  name="price[]" placeholder="Masukan  Harga" required value= 0>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="form-group">
                <label>Harga Total</label>
                <input type="text" class="form-control price" data-format="currency"  name="hargaTotal[]" placeholder="Masukan  Harga" required value= 0>
            </div>
        </div>
         <div class="col-lg-2">
            <div class="form-group">
                <label>Diskon</label>
                <input type="text" class="form-control diskon" data-format="currency"  name="diskon[]" placeholder="Masukan  diskon" required value= 0>
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
      var selectedAcc = selectedOption.val(); // Get the selected value directly
      var totalPcsValue = $('input[name="total_pcs[]"]').val().trim();

      var kdBrg = selectedOption.val().trim();
      console.log('Kode barangnya adalah ' + kdBrg);

      // Find the satuan select within the same row as the changed kd_acc2
      var $satuanSelect = $(this).closest('.row').find('select[name="satuan[]"]');
      if (totalPcsValue != null) {
        $.ajax({
          url: 'get_satuan.php',
          type: 'POST',
          data: {
            id: selectedAcc
          },
          success: function(data) {
            console.log('Raw response:', data); // Log the raw response

            try {
              // Assuming `data` is a valid JSON array
              var options = data; // Parse the JSON response
              $satuanSelect.empty(); // Clear existing options
              $satuanSelect.append('<option value="">Pilih Satuan</option>'); // Add placeholder option

              // Loop through the options returned from the server and add them to the 'satuan[]' select element
              for (var i = 0; i < options.length; i++) {
                $satuanSelect.append('<option value="' + options[i].value + '">' + options[i].text + '</option>');
              }
            } catch (e) {
              console.error('Parsing error:', e); // Handle JSON parsing errors
              alert('Error parsing response data. Check console for details.');
            }
          },
          error: function() {
            alert('Error retrieving data.'); // Handle AJAX request errors
          }
        });
      }

      var namaBrg = selectedOption.text().split(' - ')[1].trim();

      // Set the values for kode_account and nama_account in the same row
      $(this).closest('.row').find('.kode_account').val(kdBrg);
      $(this).closest('.row').find('.nama_account').val(namaBrg);
    });

    $(newFormElement).find('.remove-form').on('click', function() {
      $(this).closest('.row').remove();
      console.log('Element removed. Remaining rows:', $('#newFormContainer .row').length);

      if ($('#newFormContainer .row').length === 0) {
        console.log('No more rows, showing #data-details and #row-details');
        $('#data-details, #row-details').hide();
        $('#formFooter').hide();
      }
    });


    $(newFormElement).find('select[name="satuan[]"]').on('change', function() {
      updateTotalPcs($(this).closest('.row'));
    });

    $(newFormElement).find('input[name="jumlah[]"]').on('input', function() {
      updateJumlahTotal($(this).closest('.row'));
    });


    function updateTotalPcs(row) {
      var selectedOption = row.find('select[name="kd_acc2[]"]').find('option:selected');
      var satuan = row.find('select[name="satuan[]"]').val();
      var totalPcs = selectedOption.data(satuan) || 0;

      row.find('input[name="total_pcs[]"]').val(totalPcs);
      updateJumlahTotal(row);
    }

    function updateJumlahTotal(row) {
      var totalPcs = parseFloat(row.find('input[name="total_pcs[]"]').val()) || 0;

      // Ambil nilai jumlah dan hapus format rupiah (titik atau koma)
      var jumlah = row.find('input[name="jumlah[]"]').val();
      jumlah = jumlah.replace(/[.,]/g, ''); // Menghilangkan titik dan koma

      // Konversi jumlah menjadi angka desimal
      jumlah = parseFloat(jumlah) || 0;

      var hasilPerkalian = totalPcs * jumlah;
      console.log("hasil perkalian nyaa/ jumlah totalnya ", hasilPerkalian);
      row.find('input[name="hasil_perkalian[]"]').val(hasilPerkalian);
    }


  });

  document.addEventListener('input', function(event) {
    const row = event.target.closest('.row'); // Cari baris terkait
    if (!row) return; // Jika tidak dalam konteks row, hentikan

    // Ambil elemen input terkait
    const jumlahInput = row.querySelector('input[name="jumlah[]"]');
    const hargaSatuanInput = row.querySelector('input[name="price[]"]');
    const hargaTotalInput = row.querySelector('input[name="hargaTotal[]"]');

    // Fungsi untuk parsing dan formatting currency
    const parseCurrency = (value) => parseFloat(value.replace(/[.,]/g, '') || 0);
    const formatCurrency = (value) =>
      new Intl.NumberFormat('id-ID', {
        minimumFractionDigits: 0,
        maximumFractionDigits: 0,
      }).format(value);

    // Jika input yang berubah adalah Harga Satuan atau Jumlah
    if (event.target === hargaSatuanInput || event.target === jumlahInput) {
      const jumlah = parseCurrency(jumlahInput.value);
      const hargaSatuan = parseCurrency(hargaSatuanInput.value);

      // Hitung Harga Total
      const hargaTotal = jumlah * hargaSatuan;
      hargaTotalInput.value = formatCurrency(hargaTotal);
    }

    // Jika input yang berubah adalah Harga Total
    if (event.target === hargaTotalInput) {
      const jumlah = parseCurrency(jumlahInput.value);
      const hargaTotal = parseCurrency(hargaTotalInput.value);

      // Hitung Harga Satuan
      const hargaSatuan = jumlah > 0 ? hargaTotal / jumlah : 0;
      hargaSatuanInput.value = formatCurrency(hargaSatuan);
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
  // Fungsi untuk memformat input menjadi format ribuan tanpa "Rp"
  function formatCurrency(inputElement) {
    let input = inputElement.value.replace(/[^,\d]/g, ''); // Menghapus karakter non-digit
    let formattedInput = new Intl.NumberFormat('id-ID', {
      style: 'currency',
      currency: 'IDR',
      minimumFractionDigits: 0
    }).format(input);

    // Mengupdate nilai input dengan format rupiah tanpa "Rp"
    inputElement.value = formattedInput.replace('Rp', '').trim();
  }

  // Event delegation untuk elemen dengan atribut data-format="currency"
  document.addEventListener('input', function(e) {
    if (e.target.matches('[data-format="currency"]')) {
      formatCurrency(e.target);
    }
  });

  document.querySelector('form').addEventListener('submit', function(e) {
    const input = document.querySelector('#dc');
    input.value = input.value.replace(/[^,\d]/g, ''); // Menghapus karakter non-digit sebelum menyimpan
  });
  document.querySelector('form').addEventListener('submit', function(e) {
    const input = document.querySelector('#jumlah');
    input.value = input.value.replace(/[^,\d]/g, ''); // Menghapus karakter non-digit sebelum menyimpan
  });

  document.querySelector('form').addEventListener('submit', function(e) {
    const inputs = document.querySelectorAll('.price');
    inputs.forEach(input => {
      input.value = input.value.replace(/[^,\d]/g, ''); // Menghapus karakter non-digit sebelum menyimpan
    });
  });

  document.querySelector('form').addEventListener('submit', function(e) {
    const inputs = document.querySelectorAll('.diskon');
    inputs.forEach(input => {
      input.value = input.value.replace(/[^,\d]/g, '');
    });
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
          $('#satuan').empty();
          $('#satuan').append('<option value="">Pilih Satuan</option>');


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


      $.ajax({
        url: 'get_satuan.php',
        type: 'POST',
        data: {
          id: selectedOption.val()
        },
        success: function(data) {
          console.log('Raw response:', data); // Log the raw response

          try {
            var options = data;
            $('#satuan').empty();
            $('#satuan').append('<option value="">Pilih Satuan</option>');
            for (var i = 0; i < options.length; i++) {
              $('#satuan').append('<option value="' + options[i].value + '">' + options[i].text + '</option>');
            }
          } catch (e) {
            console.error('Parsing error:', e);
            alert('Error parsing response data. Check console for details.');
          }
        },
        error: function() {
          alert('Error retrieving data.');
        }
      });


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
      $('#total_pcs').val(totalPcs);
      // Perbarui hasil perkalian jika jumlah sudah diisi
      updateHasilPerkalian();
    }

    function updateHasilPerkalian() {
      var totalPcs = $('#total_pcs').val();
      var jumlah = $('#jumlah').val();

      // Hapus semua karakter non-numerik dari jumlah, kecuali angka dan tanda desimal
      jumlah = jumlah.replace(/[^0-9,-]+/g, '');
      // Pastikan totalPcs dan jumlah adalah angka
      var hasilPerkalian = (parseFloat(totalPcs) || 0) * (parseFloat(jumlah) || 0);

      // Mengisi hasil perkalian ke form group baru
      $('#hasil_perkalian').val(hasilPerkalian);
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