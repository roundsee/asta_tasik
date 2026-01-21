<?php
$judulform = 'Build from Item Assembly';

$data = 'data_build';
$aksi = 'aksi_assembly';
$rute = 'assembly';
$query_kdcus = mysqli_query($koneksi, "SELECT user_login.kd_cus,pelanggan.nama,employee.name_e FROM user_login 
JOIN pelanggan on user_login.kd_cus = pelanggan.kd_cus 
JOIN employee on user_login.employee_number = employee.employee_number 
where user_login.employee_number = '$_SESSION[employee_number]'");
$q1 = mysqli_fetch_assoc($query_kdcus);

$kd_cus = $q1['kd_cus'];
$nama_cus = $q1['nama'];
$nama_userbuild = $q1['name_e'];

//session_start();
if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
    echo "<link href='style.css' rel='stylesheet' type='text/css'>
    <center>Untuk mengakses modul, Anda harus login <br>";
    echo "<a href=../../index.php><b>LOGIN</b></a></center>";
} else {

    switch ($_GET['act']) {
        //Tampil Data 
        default:
?>

            <div class="content-wrapper" style="background-color: ghostwhite;">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="list-gds">
                                    <b><?php echo $judulform; ?></b> <small style="font-weight: 100;"></small>
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
                    </div><!-- /.container-fluid -->
                </section>
                <div class="modal fade" id="cariKomponen" tabindex="-1" role="dialog" aria-labelledby="cariKomponenLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                Data Komponen
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closemodalkomponen">
                                    <span aria-hidden="true">&times;&nbsp; Close</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="d-flex align-items-center">
                                    <label for="cariKomponenmodalManual" class="form-label" style="font-weight: bold; font-size: 15px;">Cari Barang:<span style="margin-left: 5px;"></span></label>
                                    <input type="text" name="cariKomponenmodalManual" class="form-control" id="cariKomponenmodalManual" style="width: auto; height: 30px;  border: 1px solid #ced4da; border-radius: 4px;" placeholder="Masukkan nama barang..." />
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover" id="table-datatable-barangAssembly">
                                        <thead>
                                            <tr>
                                                <th class="text-center">NO</th>
                                                <th>KODE BARANG</th>
                                                <th>NAMA BARANG</th>
                                                <th>STOCK</th>
                                                <th>PILIH</th>
                                            </tr>
                                        </thead>
                                        <tbody id="data-table-komponen">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="cariBarang" tabindex="-1" role="dialog" aria-labelledby="cariBarangLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                Data Barang
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closemodalbarang">
                                    <span aria-hidden="true">&times;&nbsp; Close</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="d-flex align-items-center">
                                    <label for="cariBarangmodalManual" class="form-label mb-1" style="font-weight: bold; font-size: 15px;">Cari Barang:<span style="margin-left: 5px;"></span></label>
                                    <input type="text" name="cariBarangmodalManual" class="form-control" id="cariBarangmodalManual" style="width: auto; height: 30px; padding: 5px; border: 1px solid #ced4da; border-radius: 4px; margin-top: 5px;" placeholder="Masukkan nama barang..." />
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover" id="table-datatable-barangAssembly">
                                        <thead>
                                            <tr>
                                                <th class="text-center">NO</th>
                                                <th>KODE BARANG</th>
                                                <th>NAMA BARANG</th>
                                                <th>STOCK</th>
                                                <th>PILIH</th>
                                            </tr>
                                        </thead>
                                        <tbody id="data-table-barang">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Main content -->
                <section class="content" style="height:90%">
                    <div class="container-fluid table-responsive card card-default card-body">
                        <form method="POST" action="route/<?php echo $data; ?>/<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=submit" onsubmit="return validateForm()">
                            <div class="row" style="margin-bottom: 0;">
                                <div class="col-sm-4">
                                    <div class="form-group" style="display: flex; align-items: center; justify-content: flex-end; gap: 8px; margin-bottom: 0;">
                                        <label for="sumber" style="margin: 0;width:96px;">Source:</label>
                                        <input type="text" name="sumber" class="form-control" style="height: 30px;" />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group" style="margin-bottom: 0;">
                                        <h6 style="margin: 0; font-size: 25px;">
                                            <span style="display: inline-block;"><b>At Location:</span>
                                            <?php echo $kd_cus . ' - ' . $nama_cus; ?></b>
                                        </h6>
                                        <input type="hidden" name="lokasi" class="form-control" required id="lokasi" value="<?php echo $kd_cus; ?>" />
                                        <input type="hidden" name="nama_user" class="form-control" required id="nama_user" value="<?php echo $nama_userbuild; ?>" />

                                    </div>
                                </div>
                                <!-- Tanggal Section -->
                                <div class="col-sm-2 text-right">
                                    <div class="form-group" style="display: flex; align-items: center; justify-content: flex-end; gap: 8px; margin-bottom: 0;">
                                        <label for="tanggal" style="margin: 0;">Date:</label>
                                        <input type="date" name="tanggal" class="form-control" required id="tanggal" value="<?php echo date('Y-m-d'); ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 0; margin-bottom: 0;">
                                <div class="col-md-12">
                                    <div class="form-group" style="display: flex; align-items: center; justify-content: flex-end; gap: 8px; margin-bottom: 0;">
                                        <label for="keterangan" style="margin: 0;width:85px;">Comment:</label>
                                        <input type="text" name="keterangan" class="form-control" style="height: 28px;" />
                                    </div>
                                </div>
                            </div>
                            <div class="section">
                                <hr style="height: 0px;margin:5px;padding:0;">
                                <h5><b>Assembly Components</b></h5>
                                <div class="toolbar">
                                    <button type="button" class="btn btn-secondary btn-sm elevation-2" id="cariTableKomponen" data-toggle="modal" data-target="#cariKomponen" style="width: 170px;opacity: .7;">
                                        <i class="fa fa-search"></i> Add Component
                                    </button>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover" id="table-komponen">
                                        <thead style="background-color: silver;">
                                            <tr>
                                                <th style="width: 5px;line-height: 1em;text-align: center;">Aksi</th>
                                                <th style="width: 300px;line-height: 1em;">Nama Produk</th>
                                                <th style="width: 10px;text-align: center;line-height: 1em;">Jml</th>
                                                <th style="width: 70px;text-align: center;line-height: 1em;">Harga</th>
                                                <th style="width: 10px;text-align: center;line-height: 1em;">Satuan</th>
                                                <th style="width: 10px;text-align: center;line-height: 1em;">Isi</th>
                                                <th style="width: 70px;text-align: center;line-height: 1em">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="section" style="margin: 0; padding: 0;">
                                <div class="row" style="margin: 0;">
                                    <div class="col-sm-2 ml-auto">
                                        <div class="form-group" style="display: flex; align-items: center; justify-content: flex-end; gap: 8px; margin: 0;">
                                            <label for="additionalcosts" style="margin: 0; white-space: nowrap; display: inline-block; width: 200px; text-align: right;">Additional Costs:</label>
                                            <input type="text" name="additionalcosts_display" id="additionalcosts_display" value="0" class="form-control" style="height: 30px; padding: 2px 5px;" />
                                            <input type="hidden" name="additionalcosts" id="additionalcosts" value="0" class="form-control" style="height: 30px; padding: 2px 5px;" />

                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="margin: 0;">
                                    <div class="col-sm-2">
                                        <h5 style="margin: 0; padding: 0;"><b>Assembled Items</b></h5>
                                    </div>
                                    <div class="col-sm-2 ml-auto">
                                        <div class="form-group" style="display: flex; align-items: center; justify-content: flex-end; gap: 8px; margin: 0;">
                                            <label for="totalkomponen" style="margin: 0; white-space: nowrap; display: inline-block; width: 200px; text-align: right;">Total:</label>
                                            <input type="text" name="totalkomponen" id="totalkomponen" class="form-control" style="height: 30px; padding: 2px 5px;" readonly />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="section" style="margin: 0; padding: 0;">
                                <button type="button" class="btn btn-secondary btn-sm elevation-2" id="cariTableBarang" data-toggle="modal" data-target="#cariBarang" style="width: 170px; margin: 0;opacity: .7;">
                                    <i class="fa fa-search"></i> Add Item
                                </button>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover" id="table-barangjadi">
                                        <thead style="background-color: silver;">
                                            <tr>
                                                <th style="width: 5px;line-height: 1em;text-align: center;">Aksi</th>
                                                <th style="width: 300px;line-height: 1em;">Nama Produk</th>
                                                <th style="width: 10px;text-align: center;line-height: 1em;">Jml</th>
                                                <th style="width: 70px;text-align: center;line-height: 1em;">Harga</th>
                                                <th style="width: 10px;text-align: center;line-height: 1em;">Satuan</th>
                                                <th style="width: 10px;text-align: center;line-height: 1em;">Isi</th>
                                                <th style="width: 70px;text-align: center;line-height: 1em">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="section">
                                <div class="row" style="margin-top: 0;">
                                    <div class="col-sm-2 ml-auto">
                                        <div class="form-group" style="display: flex; align-items: center; justify-content: flex-end; gap: 8px; margin-top: 0;">
                                            <label for="totalbarang" style="margin: 0; white-space: nowrap;display: inline-block; width: 200px;text-align:right">Total:</label>
                                            <input type="text" name="totalbarang" id="totalbarang" class="form-control" style="height: 30px; padding: 2px 5px;" readonly />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <medium>*Harga yang ada pada assembled items akan update ke harga jual dan beli barang</medium>
                            <div class="form-group mb-0 text-right">
                                <button type="submit" class="btn btn-secondary elevation-2" style="opacity: .7; height: 40px;">Process</button>
                            </div>

                        </form>
                        <hr>
                </section>
            </div>

            <script>
                function validateStock(currentStockInputs, buyingStockInputs, buyingStockSatuanInputs, namabarang) {
                    for (let i = 0; i < namabarang.length; i++) {
                        let currentStock = parseFloat(currentStockInputs[i].value);
                        let buyingStock = parseFloat(buyingStockInputs[i].value);
                        let satuan = parseFloat(buyingStockSatuanInputs[i].value);
                        let pembelian = buyingStock * satuan;
                        let nama = namabarang[i].value;
                        if (currentStock < 0) {
                            alert(`Stock error at ${nama}: Stok terkini (${currentStock}) is negative.`);
                            return false;
                        }
                        if (pembelian < 0) {
                            alert(`Stock error at ${nama}: Stok yang di input (${pembelian}) is negative.`);
                            return false;
                        }
                        if (pembelian > currentStock) {
                            alert(`Stock error at ${nama}: Stok yang di input (${pembelian}) > Stok terkini (${currentStock})`);
                            return false;
                        }
                    }
                    return true; // All stock validations passed
                }

                function validateForm() {
                    var value = document.getElementById('additionalcosts_display').value;
                    var rawValue = value.replace(/[^\d]/g, '');
                    document.getElementById('additionalcosts_display').value = rawValue;

                    var value2 = document.getElementById('totalkomponen').value;
                    var rawValue2 = value2.replace(/[^\d]/g, '');
                    document.getElementById('totalkomponen').value = rawValue2;

                    var value3 = document.getElementById('totalbarang').value;
                    var rawValue3 = value3.replace(/[^\d]/g, '');
                    document.getElementById('totalbarang').value = rawValue3;

                    let inputs = document.getElementsByName('totalhargasmuakomponen[]');
                    let input2 = document.getElementsByName('totalbarangjadi[]');
                    let input3 = document.getElementsByName('hargabarangjadi[]');

                    inputs.forEach(input => {
                        let value = input.value;
                        let rawValue = value.replace(/[^\d]/g, '');
                        input.value = rawValue;
                    });
                    input2.forEach(input => {
                        let value = input.value;
                        let rawValue = value.replace(/[^\d]/g, '');
                        input.value = rawValue;
                    });
                    input3.forEach(input => {
                        let value = input.value;
                        let rawValue = value.replace(/[^\d]/g, '');
                        input.value = rawValue;
                    });
                    if (document.getElementById('totalbarang').value == "" || document.getElementById('totalkomponen').value == "" || document.getElementById('totalbarang').value == 0 || document.getElementById('totalkomponen').value == 0) {
                        alert("Belum Memilih Barang");
                        return false;
                    }
                    if (document.getElementById('totalbarang').value != document.getElementById('totalkomponen').value) {
                        alert("Total Belum Sesuai");
                        return false;
                    }
                    const currentStockInputs = document.getElementsByName('quantitykomponen123[]');
                    const buyingStockInputs = document.getElementsByName('jml[]');
                    const buyingStockSatuanInputs = document.getElementsByName('isikomponen[]');
                    const namabarang = document.getElementsByName('namakomponen[]');

                    const isValid = validateStock(currentStockInputs, buyingStockInputs, buyingStockSatuanInputs, namabarang);
                    if (!isValid) {
                        return false;
                    }
                    return true;
                }

                function deleteRow(button, documentharga) {
                    var row = $(button).closest('tr');
                    var hargaawal = parseInt(row.find('.totalhargakomponen').val().replace(/[^\d]/g, '')) || 0;
                    const currentValue = parseInt(document.getElementById(documentharga).value.replace(/[^\d]/g, '')) || 0;
                    const newValue = currentValue - hargaawal;
                    document.getElementById(documentharga).value = formatNumber(newValue);

                    $(button).closest('tr').remove();
                }

                function scrollToBottom() {
                    const lastRow = $("#table-komponen tbody tr:last");
                    if (lastRow.length) {
                        lastRow[0].scrollIntoView({
                            behavior: "smooth"
                        });
                    }
                }

                function scrollToBottom2() {
                    const lastRow = $("#table-barangjadi tbody tr:last");
                    if (lastRow.length) {
                        lastRow[0].scrollIntoView({
                            behavior: "smooth"
                        });
                    }
                }

                function formatNumber(num) {
                    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
                }

                function updateTotal(inputElement, documentharga) {
                    var row = $(inputElement).closest('tr');
                    var jml = parseInt(row.find('.jml-class').val()) || 0;
                    var harga = parseInt(row.find('.harga-class').val().replace(/[^\d]/g, '')) || 0;
                    var isi = parseInt(row.find('.isikomponen').val()) || 0;
                    var hargaawal = parseInt(row.find('.totalhargakomponen').val().replace(/[^\d]/g, '')) || 0;
                    const currentValue = parseInt(document.getElementById(documentharga).value.replace(/[^\d]/g, '')) || 0;
                    const newValue = currentValue - hargaawal;
                    var total = jml * harga * isi;

                    // row.find('td:eq(6)').html(formatNumber(total));
                    // row.find('.totalhargakomponen').val(total);
                    if (documentharga == 'totalkomponen') {
                        row.find('td:eq(6)').contents().first()[0].textContent = formatNumber(total);
                    }
                    if (documentharga == 'totalbarang') {
                        row.find('.totalhargakomponenawal').val(formatNumber(total));
                    }
                    row.find('.totalhargakomponen').val(formatNumber(total));
                    document.getElementById(documentharga).value = formatNumber(newValue + total);

                }

                function updatehargatotal(inputElement, documentharga) {
                    var row = $(inputElement).closest('tr');
                    var jml = parseInt(row.find('.jml-class').val()) || 0;
                    var harga = parseInt(row.find('.harga-class').val().replace(/[^\d]/g, '')) || 0;
                    var isi = parseInt(row.find('.isikomponen').val()) || 0;
                    var hargaawal = parseInt(row.find('.totalhargakomponenawal').val().replace(/[^\d]/g, '')) || 0;
                    const currentValue = parseInt(document.getElementById(documentharga).value.replace(/[^\d]/g, '')) || 0;
                    const newValue = currentValue - hargaawal;
                    var total = parseInt(row.find('.totalhargakomponen').val().replace(/[^\d]/g, '')) || 0;
                    // var hargabaru = total / (isi * jml);
                    var hargabaru = Math.round(total / (isi * jml));
                    row.find('.harga-class').val(formatNumber(hargabaru));
                    document.getElementById(documentharga).value = formatNumber(newValue + total);
                    row.find('.totalhargakomponenawal').val(formatNumber(total));
                    row.find('.totalhargakomponen').val(formatNumber(total));

                }

                function checkEnter(event, inputElement, totalHargaId) {
                    if (event.key === "Enter") {
                        event.preventDefault(); // Prevent form submission or other default actions
                        updatehargatotal(inputElement, totalHargaId);
                    }
                }


                function pilih_satuan(id, value, satuan_awal, triggeringElement, documentharga) {
                    var row = $(triggeringElement).closest('tr');

                    $.get("route/data_build/ajax_cariIsiSatuan.php?kode=" + id + "&satuan=" + value, function(response) {
                        if (response.status === 1) {
                            var qty = parseInt(response.data[0]['satuan_qty'], 10);
                            row.find('td:eq(5)').contents().first()[0].textContent = qty;
                            row.find('.isikomponen').val(qty);

                            var jml = parseFloat(row.find('.jml-class').val()) || 0;
                            var harga = parseFloat(row.find('.harga-class').val().replace(/[^\d]/g, '')) || 0;
                            var hargaawal = parseInt(row.find('.totalhargakomponen').val().replace(/[^\d]/g, '')) || 0;
                            const currentValue = parseInt(document.getElementById(documentharga).value.replace(/[^\d]/g, '')) || 0;
                            const newValue = currentValue - hargaawal;

                            var total = jml * harga * qty;
                            if (documentharga == 'totalkomponen') {
                                row.find('td:eq(6)').contents().first()[0].textContent = formatNumber(total);
                            }
                            if (documentharga == 'totalbarang') {
                                row.find('.totalhargakomponenawal').val(formatNumber(total));
                            }
                            row.find('.totalhargakomponen').val(formatNumber(total));
                            document.getElementById(documentharga).value = formatNumber(newValue + total);
                        } else {
                            console.error("Error in response:", response);
                        }
                    });
                }



                $(document).ready(function() {
                    $('#table-datatable-barangAssembly').DataTable({
                        'paging': false,
                        'scrollCollapse': true,
                        'lengthChange': false,
                        'searching': false,
                        'ordering': false,
                        'info': true,
                        'autoWidth': true,
                        "pageLength": 50
                    });
                    $(document).on("click", "#cariTableKomponen", function() {
                        document.getElementById('cariKomponenmodalManual').value = '';
                        const value = document.getElementById('lokasi').value;
                        $.ajax({
                            type: 'GET',
                            url: 'route/data_build/ajax_cariBarang.php?value=' + value,
                            dataType: 'json',
                            success: function(response) {
                                const tableBody = $('#data-table-komponen');
                                tableBody.empty();

                                if (response.length === 0) {
                                    tableBody.append('<tr><td colspan="5" class="text-center">Tidak ada data barang</td></tr>');
                                } else {
                                    response.forEach(function(item) {
                                        const row = `
                                    <tr>
                                        <td class="text-center">${item.no}</td>
                                        <td class="text-center">${item.kode_barang}</td>
                                        <td>${item.nama}</td>
                                        <td>${item.quantity}</td>
                                        <td>
                                           <span class="btn btn-success btn-sm modal-pilih-komponen" 
                                                data-kodebarang="${item.kode_barang}" 
                                                data-nama="${item.nama}" 
                                                data-quantity="${item.quantity}" 
                                                data-satuan="${item.satuan}" 
                                                data-isi="${item.isi}" 
                                                data-harga="${item.harga}">
                                                Pilih
                                            </span>
                                        </td>
                                    </tr>
                                    `;
                                        tableBody.append(row);
                                    });
                                }
                            },
                            error: function(xhr, status, error) {
                                console.log(xhr.responseText);
                                alert("Failed to fetch data. Please try again later.");
                            }
                        });
                    });
                    $(document).on("click", "#cariTableBarang", function() {
                        document.getElementById('cariBarangmodalManual').value = '';
                        const value = document.getElementById('lokasi').value;
                        $.ajax({
                            type: 'GET',
                            url: 'route/data_build/ajax_cariBarang.php?value=' + value,
                            dataType: 'json',
                            success: function(response) {
                                const tableBody = $('#data-table-barang');
                                tableBody.empty();

                                if (response.length === 0) {
                                    tableBody.append('<tr><td colspan="5" class="text-center">Tidak ada data barang</td></tr>');
                                } else {
                                    response.forEach(function(item) {
                                        const row = `
                                    <tr>
                                        <td class="text-center">${item.no}</td>
                                        <td class="text-center">${item.kode_barang}</td>
                                        <td>${item.nama}</td>
                                        <td>${item.quantity}</td>
                                        <td>
                                           <span class="btn btn-success btn-sm modal-pilih-barang" 
                                                data-kodebarang="${item.kode_barang}" 
                                                data-nama="${item.nama}" 
                                                data-quantity="${item.quantity}" 
                                                data-satuan="${item.satuan}" 
                                                data-isi="${item.isi}" 
                                                data-harga="${item.harga}">
                                                Pilih
                                            </span>
                                        </td>
                                    </tr>
                                    `;
                                        tableBody.append(row);
                                    });
                                }
                            },
                            error: function(xhr, status, error) {
                                console.log(xhr.responseText);
                                alert("Failed to fetch data. Please try again later.");
                            }
                        });
                    });
                });
                $(document).on("click", ".modal-pilih-komponen", function() {
                    const id = $(this).attr('data-kodebarang');
                    const nama = $(this).attr('data-nama');
                    const harga = $(this).attr('data-harga');
                    const satuan = $(this).attr('data-satuan');
                    const isi = $(this).attr('data-isi');
                    const kodebarang = $(this).attr('data-kodebarang');
                    const quantity123 = $(this).attr('data-quantity');
                    const total = harga * isi;
                    const totalhargadocument = 'totalkomponen';
                    const currentValue = parseInt(document.getElementById(totalhargadocument).value.replace(/[^\d]/g, '')) || 0;
                    const newvalue = currentValue + total;
                    document.getElementById(totalhargadocument).value = formatNumber(newvalue);
                    let kategori = "Komponen";
                    let index = 1;
                    let uniqueId = `${kategori}-${id}-${index}`;
                    while ($(`tr[data-id="${uniqueId}"]`).length > 0) {
                        index++;
                        uniqueId = `${kategori}-${id}-${index}`;
                    }
                    let options = "";

                    $.ajax({
                        url: 'route/data_build/ajax_cariSatuan.php?id=' + id,
                        type: "GET",
                        dataType: "json",
                        async: false,
                        success: function(response) {
                            // Check if response is not empty
                            if (response.length > 0) {
                                response.forEach((element, i) => {
                                    if (i === 0) {
                                        options += `<option selected>${element}</option>`;
                                    } else {
                                        options += `<option>${element}</option>`;
                                    }
                                });
                            } else {
                                options = "<option>No units available</option>"; // Fallback if no units found
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.error(textStatus, errorThrown);
                        }
                    });

                    let select = `
                    <select class="form-control" name="satuan[]" style="line-height: 1em; height: auto; margin: 0;" 
                            onchange="pilih_satuan('${id}', this.value, '${satuan}', this, '${totalhargadocument}')">
                        ${options}
                    </select>`;

                    const table_componen = `
                     <tr style="line-height: 1em;" data-id="komponen_${uniqueId}">
                        <td align="center" style="line-height: 1em; vertical-align: middle; padding: 5px; width: 5px; max-width: 5px; overflow: hidden;">
                            <span class="btn btn-danger btn-sm delete-row" onclick="deleteRow(this, '${totalhargadocument}')">
                                <i class="fa fa-trash mr-2"></i>Delete
                            </span>
                        </td>
                        <td align="left" style="line-height: 1em; vertical-align: middle; padding: 5px; width: 300px; max-width: 300px; overflow: hidden;">
                            ${nama}
                            <input type="hidden" name="namakomponen[]" value="${nama}" class="form-control">
                            <input type="hidden" name="kodekomponen[]" value="${kodebarang}" class="form-control">
                            <input type="hidden" name="quantitykomponen123[]" value="${quantity123}" class="form-control">

                        </td>
                        <td style="line-height: 1em; vertical-align: middle; padding: 5px; width: 10px; max-width: 10px; overflow: hidden;">
                            <input type="number" name="jml[]" class="form-control jml-input jml-class" value="1" min="1" oninput="updateTotal(this, '${totalhargadocument}')" style="line-height: 1em; height: auto; margin: 0;">
                        </td>
                        <td align="left" style="line-height: 1em; vertical-align: middle; padding: 5px; width: 70px; max-width: 70px; overflow: hidden;">
                            ${formatNumber(harga)}
                            <input type="hidden" name="hargakomponen[]" value="${harga}" class="form-control harga-class">
                        </td>
                       <td style="line-height: 1em; vertical-align: middle; padding: 5px; width: 10px; max-width: 10px; overflow: hidden;">
                            ${select}
                        </td>
                        <td style="line-height: 1em; vertical-align: middle; padding: 5px; width: 10px; max-width: 10px; overflow: hidden;">
                            ${isi}
                            <input type="hidden" class="isikomponen" name="isikomponen[]" value="${isi}" class="form-control" value="1" min="1" style="line-height: 1em; height: auto; margin: 0;">
                        </td>
                        <td align="left" style="line-height: 1em; vertical-align: middle; padding: 5px; width: 70px; max-width: 70px; overflow: hidden;">
                            ${formatNumber(total)}
                            <input type="hidden" class="totalhargakomponen" name="totalhargasmuakomponen[]" value="${total}" class="form-control">
                        </td>
                    </tr>`;

                    $("#table-komponen tbody").append(table_componen);
                    // scrollToBottom();
                    $('#closemodalkomponen').click();

                });
                $(document).on("click", ".modal-pilih-barang", function() {
                    const id = $(this).attr('data-kodebarang');
                    const nama = $(this).attr('data-nama');
                    const harga = $(this).attr('data-harga');
                    const hargaawal = $(this).attr('data-harga');
                    const satuan = $(this).attr('data-satuan');
                    const isi = $(this).attr('data-isi');
                    const kodebarang = $(this).attr('data-kodebarang');
                    const total = harga * isi;
                    const totalhargadocument = 'totalbarang';
                    const currentValue = parseInt(document.getElementById(totalhargadocument).value.replace(/[^\d]/g, '')) || 0;
                    const newvalue = currentValue + total;
                    document.getElementById(totalhargadocument).value = formatNumber(newvalue);
                    let kategori = "barangjadi";
                    let index = 1;
                    let uniqueId = `${kategori}-${id}-${index}`;
                    while ($(`tr[data-id="${uniqueId}"]`).length > 0) {
                        index++;
                        uniqueId = `${kategori}-${id}-${index}`;
                    }

                    let options = ""; // Change 'const' to 'let'

                    $.ajax({
                        url: 'route/data_build/ajax_cariSatuan.php?id=' + id,
                        type: "GET",
                        dataType: "json",
                        async: false,
                        success: function(response) {
                            // Check if response is not empty
                            if (response.length > 0) {
                                response.forEach((element, i) => {
                                    if (i === 0) {
                                        options += `<option selected>${element}</option>`;
                                    } else {
                                        options += `<option>${element}</option>`;
                                    }
                                });
                            } else {
                                options = "<option>No units available</option>"; // Fallback if no units found
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.error(textStatus, errorThrown);
                        }
                    });

                    let select = `
                    <select class="form-control" name="satuanbarangjadi[]" style="line-height: 1em; height: auto; margin: 0;" 
                            onchange="pilih_satuan('${id}', this.value, '${satuan}', this, '${totalhargadocument}')">
                        ${options}
                    </select>`;

                    const table_componen = `
                     <tr style="line-height: 1em;" data-id="barangjadi_${uniqueId}">
                        <td align="center" style="line-height: 1em; vertical-align: middle; padding: 5px; width: 5px; max-width: 5px; overflow: hidden;">
                            <span class="btn btn-danger btn-sm delete-row" onclick="deleteRow(this, '${totalhargadocument}')">
                                <i class="fa fa-trash mr-2"></i>Delete
                            </span>
                        </td>
                        <td align="left" style="line-height: 1em; vertical-align: middle; padding: 5px; width: 300px; max-width: 300px; overflow: hidden;">
                            ${nama}
                            <input type="hidden" name="namabarangjadi[]" value="${nama}" class="form-control">
                            <input type="hidden" name="kodebarangjadi[]" value="${kodebarang}" class="form-control">
                            <input type="hidden" name="hargaawal[]" value="${hargaawal}" class="form-control">
                        </td>
                        <td style="line-height: 1em; vertical-align: middle; padding: 5px; width: 10px; max-width: 10px; overflow: hidden;">
                            <input type="number" name="jmlbarangjadi[]" class="form-control jml-input jml-class" value="1" min="1" oninput="updateTotal(this, '${totalhargadocument}')" style="line-height: 1em; height: auto; margin: 0;">
                        </td>
                         <td style="line-height: 1em; vertical-align: middle; padding: 5px; width: 10px; max-width: 10px; overflow: hidden;">
                            <input type="text" name="hargabarangjadi[]" value="${formatNumber(harga)}" class="form-control harga-class" oninput="updateTotal(this, '${totalhargadocument}')" style="line-height: 1em; height: auto; margin: 0;">
                        </td>
                       <td style="line-height: 1em; vertical-align: middle; padding: 5px; width: 10px; max-width: 10px; overflow: hidden;">
                            ${select}
                        </td>
                        <td style="line-height: 1em; vertical-align: middle; padding: 5px; width: 10px; max-width: 10px; overflow: hidden;">
                            ${isi}
                            <input type="hidden" class="isikomponen" name="isibarangjadi[]" value="${isi}" class="form-control" value="1" min="1" style="line-height: 1em; height: auto; margin: 0;">
                        </td>
                        <td align="left" style="line-height: 1em; vertical-align: middle; padding: 5px; width: 70px; max-width: 70px; overflow: hidden;">
                            <input type="text" name="totalbarangjadi[]" value="${formatNumber(total)}" class="form-control totalhargakomponen" onchange="updatehargatotal(this, '${totalhargadocument}')" onkeydown="checkEnter(event, this, '${totalhargadocument}')" style="line-height: 1em; height: auto; margin: 0;">
                            <input type="hidden" name="totalbarangjadiawal[]" value="${formatNumber(total)}" class="form-control totalhargakomponenawal">
                        </td>
                    </tr>`;

                    $("#table-barangjadi tbody").append(table_componen);
                    // scrollToBottom2();
                    $('#closemodalbarang').click();

                });
                $(document).on("input", "#cariKomponenmodalManual", function() {
                    const value = document.getElementById('lokasi').value;
                    var searchValue = $(this).val();
                    $.ajax({
                        type: 'GET',
                        url: 'route/data_build/ajax_cariBarang.php?value=' + value + '&valuesUM=' + searchValue,
                        dataType: 'json',
                        success: function(response) {
                            const tableBody = $('#data-table-komponen');
                            tableBody.empty();

                            if (response.length === 0) {
                                tableBody.append('<tr><td colspan="5" class="text-center">Tidak ada data barang</td></tr>');
                            } else {
                                response.forEach(function(item) {
                                    const row = `
                                    <tr>
                                        <td class="text-center">${item.no}</td>
                                        <td class="text-center">${item.kode_barang}</td>
                                        <td>${item.nama}</td>
                                        <td>${item.quantity}</td>
                                        <td>
                                            <span class="btn btn-success btn-sm modal-pilih-komponen" 
                                                data-kodebarang="${item.kode_barang}" 
                                                data-nama="${item.nama}" 
                                                data-quantity="${item.quantity}" 
                                                data-satuan="${item.satuan}" 
                                                data-isi="${item.isi}" 
                                                data-harga="${item.harga}">
                                                Pilih
                                            </span>
                                        </td>
                                    </tr>
                                    `;
                                    tableBody.append(row);
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                        }
                    });
                });
                $(document).on("input", "#cariBarangmodalManual", function() {
                    const value = document.getElementById('lokasi').value;
                    var searchValue = $(this).val();
                    $.ajax({
                        type: 'GET',
                        url: 'route/data_build/ajax_cariBarang.php?value=' + value + '&valuesUM=' + searchValue,
                        dataType: 'json',
                        success: function(response) {
                            const tableBody = $('#data-table-barang');
                            tableBody.empty();

                            if (response.length === 0) {
                                tableBody.append('<tr><td colspan="5" class="text-center">Tidak ada data barang</td></tr>');
                            } else {
                                response.forEach(function(item) {
                                    const row = `
                                    <tr>
                                        <td class="text-center">${item.no}</td>
                                        <td class="text-center">${item.kode_barang}</td>
                                        <td>${item.nama}</td>
                                        <td>${item.quantity}</td>
                                        <td>
                                            <span class="btn btn-success btn-sm modal-pilih-barang" 
                                                data-kodebarang="${item.kode_barang}" 
                                                data-nama="${item.nama}" 
                                                data-quantity="${item.quantity}" 
                                                data-satuan="${item.satuan}" 
                                                data-isi="${item.isi}" 
                                                data-harga="${item.harga}">
                                                Pilih
                                            </span>
                                        </td>
                                    </tr>
                                    `;
                                    tableBody.append(row);
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                        }
                    });
                });
                $(document).on("change", "#additionalcosts_display", function() {
                    let rawValue = $(this).val().replace(/[^\d]/g, '');
                    const lastvalue = parseInt(document.getElementById('additionalcosts').value.replace(/[^\d]/g, '')) || 0;
                    const totalhargadocument = 'totalkomponen';
                    const currentValue = parseInt(document.getElementById(totalhargadocument).value.replace(/[^\d]/g, '')) || 0;
                    const newvalue = currentValue + parseInt(rawValue) - lastvalue;
                    document.getElementById(totalhargadocument).value = formatNumber(newvalue);
                    let formattedValue = formatNumber(rawValue);
                    $(this).val(formattedValue);
                    document.getElementById('additionalcosts').value = rawValue;

                });
            </script>
<?php
            break;
    }
}
?>