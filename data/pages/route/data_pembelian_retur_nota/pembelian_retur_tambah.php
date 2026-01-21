<?php
// include 'header.php';
include '../../config/koneksi.php';

$judulform = 'Retur Pembelian';
$data = 'data_pembelian_retur_nota';
$aksi = 'aksi_pembelian_retur';
$rute = 'pembelian_retur_nota';

$tabel = 'retur_pembelian';
$f1 = 'tanggal_retur';
$f2 = 'kd_retur';
$f3 = 'faktur';
$f4 = 'kd_brg';
$f5 = 'harga';
$f6 = 'banyak';
$f7 = 'satuan';
$f8 = 'subtotal';
$f9 = 'total_retur';
$f10 = 'login_hash';


$j1 = 'Tanggal Retur';
$j2 = 'Kode Retur';
$j3 = 'Faktur';
$j4 = 'Kode Barang';
$j5 = 'Harga';
$j6 = 'Banyak';
$j7 = 'satuan';
$j8 = 'subtotal';
$j9 = 'Total Retur';
$j10 = 'Login Hash';
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
                    <div class="box">
                        <div class="box-body">
                            <form method="post" enctype="multipart/form-data"
                                action="route/<?php echo $data; ?>/<?php echo $aksi; ?>.php">

                                <div class="container-fluid"">
                                    <div class=" row">
                                    <!-- Kolom Pertama -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Tanggal</label>
                                            <input type="date" class="form-control" name="tanggal_retur" value="<?php echo date('Y-m-d'); ?>" style="width: 40vh;" readonly />
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Keterangan Retur Pembelian</label>
                                            <input type="text" class="form-control" name="keterangan" style="width: 40vh;" require />
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group" style="display: flex; align-items: center;">
                                            <label for="lokasi" style="margin-right: 27px; margin-bottom: 0;"> Lokasi :</label>
                                            <select id="lokasi" name="lokasi" class="select2" style="width: 310px;" <?php echo ($login_hash == 22 || $login_hash == 21) ? 'disabled' : ''; ?> required>
                                                <option value="">-- Pilih Lokasi --</option>
                                                <option value="1316" <?php echo ($login_hash == 22) ? 'selected' : ''; ?>>Swalayan</option>
                                                <option value="8001" <?php echo ($login_hash == 21) ? 'selected' : ''; ?>>Gudang</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group" style="display: flex; align-items: center;">
                                            <label for="supplier" style="margin-right: 15px; margin-bottom: 0;"> Supplier :</label>
                                            <select id="supplier" name="supplier" class="select2" style="width: 310px;" <?php echo ($login_hash == 22 || $login_hash == 21) ? 'disabled' : ''; ?> required>
                                                <option value="">-- Pilih Supplier --</option>
                                                <?php
                                                $query = mysqli_query($koneksi, "SELECT kd_supp,nama FROM supplier");
                                                while ($j = mysqli_fetch_array($query)) {
                                                ?>
                                                    <option value="<?php echo $j["kd_supp"]; ?>"><?php echo $j["kd_supp"] . ' - ' . $j["nama"]; ?></option>
                                                <?php } ?>
                                            </select>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button id="addFormButton" type="button" class="btn btn-primary btn-sm elevation-2" style="opacity: .7;">
                                                <i class="fa fa-plus"></i> Tambah Barang
                                            </button>
                                        </div>
                                    </div>
                                    <div id="newFormContainer"></div>
                                    <div id="formFooter" style="display:none;">
                                    </div>
                                    <hr>
                                </div>
                                <div class="form-group text-left">
                                    <input type="submit" class="btn btn-primary btn-sm elevation-2" id="simpanpermintaanbarang"
                                        style="opacity: .7" value="Simpan" />

                                    <a href="main.php?route=<?php echo $rute; ?>&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=data-pembelian-retur"
                                        class="btn btn-primary btn-sm elevation-2" style="opacity: .7">
                                        Back
                                    </a>
                                </div>
                        </div>

                        </form>
                    </div>
                </div>
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


<script>
    $("#simpanpermintaanbarang").click(function() {
        let input1 = document.getElementsByName('kd_acc[]');
        let input2 = document.getElementsByName('jumlah[]');
        let input3 = document.getElementsByName('uraian[]');
        let input4 = document.getElementsByName('total_pcs[]');
        let input5 = document.getElementsByName('kd_acc2[]');



        function validateStock(codeitems, quantity, nameitem, totalpcs, neww) {
            let seenCodes = {};

            for (let i = 0; i < codeitems.length; i++) {
                let code = codeitems[i].value.trim(); // <select name="kd_acc[]">
                let qty = quantity[i].value.trim(); // <input name="jumlah[]">
                let pcs = totalpcs[i].value.trim(); // <input name="total_pcs[]">
                let name = nameitem[i].value.trim(); // <input name="uraian[]">
                let detailSelect = neww[i]; // <select name="kd_acc2[]">

                // Get data-stok from kd_acc2[] option
                let selectedOption = detailSelect.options[detailSelect.selectedIndex];
                let stok = parseFloat(selectedOption.getAttribute('data-stok') || '0');

                if (seenCodes[code]) {
                    alert(`Duplicate item detected: ${name} (code: ${code})`);
                    return false;
                } else {
                    seenCodes[code] = true;
                }

                if (qty === '' || isNaN(qty) || parseFloat(qty) <= 0) {
                    alert(`Quantity error at item: ${name}`);
                    return false;
                }

                if (pcs === '' || isNaN(pcs) || parseFloat(pcs) <= 0) {
                    alert(`Satuan error at item: ${name}`);
                    return false;
                }

                // Check if pcs > stok from kd_acc2[]
                if (parseFloat(pcs * qty) > stok) {
                    alert(`Stok tidak cukup untuk item: ${name} (Diminta: ${pcs*qty}, Tersedia: ${stok})`);
                    return false;
                }
            }

            document.getElementById('lokasi').disabled = false;
            return true;
        }

        if (!validateStock(input1, input2, input3, input4, input5)) {
            return false;
        }
    });

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
    $("#data-details, #row-details").hide();

    function loadProducts(selectElement, lokasi, callback) {
        $.ajax({
            url: 'route/data_pembelian_retur_nota/ajax_get_barang.php',
            method: 'POST',
            data: {
                lokasi: lokasi
            },
            success: function(response) {
                selectElement.innerHTML = '<option value="">-- Pilih Barang --</option>' + response;
                if (callback && typeof callback === 'function') {
                    callback();
                }
            },
            error: function() {
                selectElement.innerHTML = '<option value="">Error loading products</option>';
                if (callback && typeof callback === 'function') {
                    callback();
                }
            }
        });
    }

    function checkUnlockLocation() {
        var existingProducts = document.querySelectorAll('.barang-select');
        if (existingProducts.length === 0) {
            var lokasiSelect = document.getElementById('lokasi');
            lokasiSelect.disabled = false;

            var note = document.getElementById('lokasi-locked-note');
            if (note) {
                note.remove();
            }
        }
    }

    $(document).on('click', '.remove-form', function() {
        $(this).closest('.row').next('hr').remove();
        $(this).closest('.row').remove();
        checkUnlockLocation(); // Check if we should unlock location
    });

    document.getElementById('addFormButton').addEventListener('click', function() {
        $("#data-details, #row-details").hide();
        $("#row-details input[required], #row-details select[required]").each(function() {
            $(this).removeAttr('required');
        });

        var lokasi = document.getElementById('lokasi').value;

        if (!lokasi) {
            alert('Harus Pilih Lokasi Barang!');
            return;
        }

        // Lock the location dropdown after first product is added
        var lokasiSelect = document.getElementById('lokasi');
        lokasiSelect.disabled = true;

        // Add a note to show location is locked
        if (!document.getElementById('lokasi-locked-note')) {
            var note = document.createElement('medium');
            note.id = 'lokasi-locked-note';
            note.className = 'text-muted';
            note.style.marginLeft = '27px'; // Match your label margin
            note.innerHTML = '<br><i class="fa fa-lock"></i> Lokasi terkunci - hapus semua barang jika ingin ganti';
            lokasiSelect.parentNode.appendChild(note);
        }

        var formFooter = document.getElementById('formFooter');
        var newFormContainer = document.getElementById('newFormContainer');

        var newFormFieldsHtml = `
      <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label for="">Barang</label>
                <select name="kd_acc2[]" class="form-control select2 barang-select" data-lokasi="${lokasi}">
                <option value="">Tunggu...</option>
                </select>
            </div>
        </div>
        <div class="col-lg-3" style = "display : none" >
            <div class="form-group">
                <label>Kode Barang</label>
                <input type="text" class="form-control kode_account" name="kd_acc[]" placeholder="Autofill by Account" readonly>
            </div>
        </div>
        <div class="col-lg-3" style = "display : none">
            <div class="form-group">
                <label>Nama Barang</label>
                <input type="text" class="form-control nama_account" name="uraian[]" placeholder="Autofill by Account" readonly>
            </div>
        </div>
        <div class="col-lg-1">
            <div class="form-group">
                <label>Satuan</label>
                <select name="satuan[]" class="form-control" required >
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
        <div class="col-lg-1">
            <div class="form-group">
                <label>Isi satuan</label>
                <input type="text" class="form-control" data-format="currency" name="total_pcs[]" readonly>
            </div>
        </div>
        <div class="col-lg-1">
            <div class="form-group">
                <label>Quantity</label>
                <input type="text" class="form-control" data-format="currency" name="jumlah[]" placeholder="Masukan Jumlah" required>
            </div>
        </div>
        <div class="col-lg-1">
            <div class="form-group">
                <label>Quantity Total</label>
                <input type="text" class="form-control" name="hasil_perkalian[]" readonly>
            </div>
        </div>
        <div class="col-lg-1">
            <div class="form-group">
                <label>Harga Satuan</label>
                <input type="text" class="form-control price"  data-format="currency"  name="price[]" placeholder="Masukan  Harga" required value= 0 >
            </div>
        </div>
            <div class="form-group">
                <input type="hidden" class="form-control price" data-format="currency"  name="tambahan_harga[]" placeholder="Masukan  Harga" required value= 0>
            </div>
        <div class="col-lg-1">
            <div class="form-group">
                <label>Harga Total</label>
                <input type="text" class="form-control price" data-format="currency"  name="hargaTotal[]" placeholder="Masukan  Harga" required value= 0 readonly>
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

        var newSelect = newFormElement.querySelector('.barang-select');
        loadProducts(newSelect, lokasi, function() {
            $(newFormElement).find('.select2').select2({
                theme: 'bootstrap4'
            });
        });

        var hargaDasarGlobal = 0;

        $(newFormElement).find('select[name="kd_acc2[]"]').on('change', function() {
            var $row = $(this).closest('.row'); // Mendefinisikan row dengan benar
            var selectedOption = $(this).find('option:selected');
            var selectedAcc = selectedOption.val(); // Get the selected value directly
            var totalPcsValue = $('input[name="total_pcs[]"]').val().trim();
            var $priceInput = $(this).closest('.row').find('input[name="price[]"]'); // Price input field
            var $totalPcsInput = $row.find('input[name="total_pcs[]"]'); // Total PCS input field
            var $jumlahInput = $row.find('input[name="jumlah[]"]'); // Jumlah input field
            var $quantityTotal = $row.find('input[name="hasil_perkalian[]"]'); // Jumlah input field
            var $hargaTotal = $row.find('input[name="hargaTotal[]"]');



            var kdBrg = selectedOption.val().trim();
            console.log('Kode barangnya adalah ' + kdBrg);

            // Reset jumlah dan total_pcs hanya pada baris yang sama
            $totalPcsInput.val(0);
            $jumlahInput.val(0);
            $quantityTotal.val(0);
            $hargaTotal.val(0);

            // Find the satuan select within the same row as the changed kd_acc2
            var $satuanSelect = $(this).closest('.row').find('select[name="satuan[]"]');
            if (totalPcsValue != null) {
                $.ajax({
                    url: 'route/data_pembelian_retur_nota/get_satuan.php',
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
            // AJAX request to get the price of the selected item
            $.ajax({
                url: 'route/data_pembelian_retur_nota/get_harga_barang.php', // Pastikan ini sesuai dengan nama file Anda
                type: 'POST',
                data: {
                    kode_barang: selectedAcc
                },
                success: function(response) {
                    console.log('Harga barang dari server:', response); // Log harga dari server untuk debugging

                    try {
                        // Parsing respons sebagai integer tanpa desimal
                        var harga = parseInt(response, 10) || 0;

                        // Simpan harga ke variabel global
                        hargaDasarGlobal = harga;

                        // Set harga di input tanpa formatting terlebih dahulu
                        $priceInput.val(harga);

                        // Format harga ke Rupiah
                        formatCurrency($priceInput[0]); // Memanggil fungsi formatCurrency untuk format Rupiah
                    } catch (e) {
                        console.error('Parsing error:', e);
                        alert('Error parsing price data.');
                    }
                },
                error: function() {
                    alert('Error retrieving price data.');
                }
            });
        });



        $(newFormElement).find('.remove-form').on('click', function() {
            $(this).closest('.row').remove();
            console.log('Element removed. Remaining rows:', $('#newFormContainer .row').length);

            if ($('#newFormContainer .row').length === 0) {
                console.log('No more rows, showing #data-details and #row-details');
                $('#data-details, #row-details').show();
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

            // Pastikan menggunakan harga awal dari variabel global (hargaDasarGlobal)
            console.log("Harga awal (dasar):", hargaDasarGlobal);

            // Hitung harga setelah dikalikan dengan total pcs
            var hargaXIsi = hargaDasarGlobal * (parseFloat(totalPcs) || 0);

            // Update input harga dengan nilai hasil perkalian
            row.find('input[name="price[]"]').val(new Intl.NumberFormat('id-ID', {
                minimumFractionDigits: 0
            }).format(hargaXIsi));

            // Tambahan untuk langsung mengupdate harga total
            var jumlah = parseFloat(row.find('input[name="jumlah[]"]').val().replace(/[.,]/g, '')) || 0;
            var hargaTotal = jumlah * hargaXIsi;

            row.find('input[name="hargaTotal[]"]').val(new Intl.NumberFormat('id-ID', {
                minimumFractionDigits: 0
            }).format(hargaTotal));


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
        const tambahan_harga = row.querySelector('input[name="tambahan_harga[]"]');

        // Fungsi untuk parsing dan formatting currency
        const parseCurrency = (value) => parseFloat(value.replace(/[.,]/g, '') || 0);
        const formatCurrency = (value) =>
            new Intl.NumberFormat('id-ID', {
                minimumFractionDigits: 0,
                maximumFractionDigits: 0,
            }).format(value);

        // Jika input yang berubah adalah Harga Satuan atau Jumlah
        if (event.target === hargaSatuanInput || event.target === jumlahInput || event.target === tambahan_harga) {
            const jumlah = parseCurrency(jumlahInput.value);
            const hargaSatuan = parseCurrency(hargaSatuanInput.value);
            const tambah_harga = parseCurrency(tambahan_harga.value);

            // Hitung Harga Total
            const hargaTotal = jumlah * hargaSatuan + tambah_harga;
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