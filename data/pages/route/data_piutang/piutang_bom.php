<?php
$judulform = 'Build of Bill of Materials';

$data = 'data_piutang';
$aksi = 'aksi_piutang';
$rute = 'piutang';
$query_kdcus = mysqli_query($koneksi, "SELECT user_login.kd_cus,pelanggan.nama FROM user_login JOIN pelanggan on user_login.kd_cus = pelanggan.kd_cus where employee_number = '$_SESSION[employee_number]'");
$q1 = mysqli_fetch_assoc($query_kdcus);

$kd_cus = $q1['kd_cus'];
$nama_cus = $q1['nama'];

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

                <!-- Main content -->
                <section class="content" style="height:90%">
                    <div class="container-fluid table-responsive card card-default card-body">
                        <!-- baris 1 -->
                        <form method="POST" action="route/<?php echo $data; ?>/<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=submit" onsubmit="return validateForm()">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Tanggal</label>
                                        <input type="date" name="tanggal" class="form-control" required="required" id="tanggalbukti" />
                                    </div>
                                </div>
                                <div class="col-md-3 ml-auto">
                                    <div class="form-group">
                                        <label>Lokasi</label>
                                        <input type="text" name="kode" class="form-control" required="required" id="tampil_pelanggan_kode" placeholder="<?php echo $kd_cus . "  -  " . $nama_cus; ?>" readonly>
                                    </div>
                                </div>
                                <!-- <div class="col-lg-1">
                                    <hr style="border: none; height: 0.5px;" />
                                    <button type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#cariPelanggan">
                                        <i class="fa fa-search"></i> Lokasi
                                    </button>
                                </div> -->
                            </div>

                            <div class="row">

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Nomor Build</label>
                                        <input type="text" name="bukti" required="required" class="form-control" id="bukti" />
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <hr style="border: none; height: 0.5px;" />
                                    <button type="button" class="btn btn-success btn-sm cekBukti">
                                        <i class="fa fa-search"></i> Cek Nomor
                                    </button><span id="status_bukti" style="padding-left: 5px; font-weight: bold;"></span>
                                </div>
                                <!-- <div class="col-md-3 ml-auto">
                                    <div class="form-group">
                                        <label>Lokasi<span id="status_pelanggan"></span></label>
                                        <input type="text" class="form-control" name="supplier" value="" required="required" placeholder="Lokasi .." id="tampil_pelanggan_nama" readonly>
                                    </div>
                                </div> -->
                                <div class="col-lg-1">
                                </div>

                            </div>
                            <hr>

                            <div class="modal fade" id="cariFaktur" tabindex="-1" role="dialog" aria-labelledby="cariFakturLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            DATA BARANG
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closemodalfaktur">
                                                <span aria-hidden="true">&times;&nbsp; Close</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped table-hover" id="table-datatable-outlet">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Kode Barang</th>
                                                            <th>Nama Barang</th>
                                                            <!-- <th>FAKTUR</th> -->
                                                            <th>Satuan</th>
                                                            <th>Harga</th>
                                                            <th>PILIH</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="data-table-faktur">

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-faktur-tab" data-toggle="pill" href="#pills-faktur" role="tab" aria-controls="pills-faktur" aria-selected="false">Bill Of Materials</a>
                                </li>
                            </ul>

                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane  fade show active" id="pills-faktur" role="tabpanel" aria-labelledby="pills-faktur-tab">
                                    <div class="mb-5">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <h1 style="font-weight: bold;">Produksi</h1>
                                                <div class="form-row">
                                                    <div class="form-group col-md-8">
                                                        <label for="nomorfaktur">Kode Barang</label>
                                                        <input type="text" name="nomorfaktur" class="form-control" id="nomorfaktur">
                                                    </div>
                                                    <div class="form-group col-md-4" style="margin-top: 30px;">
                                                        <button type="button" class="btn btn-primary btn-block" id="cariTableFaktur" data-toggle="modal" data-target="#cariFaktur">
                                                            <i class="fa fa-search"></i> Barang
                                                        </button>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="tanggalfaktur">NAMA BARANG</label>
                                                    <input type="text" name="tanggalfaktur" class="form-control" id="tanggalfaktur" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="nilaiFaktur">Harga</label>
                                                    <input type="text" name="nilaiFaktur" class="form-control" id="nilaiFaktur" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="fakturSudahDibayar">Satuan</label>
                                                    <input type="text" name="fakturSudahDibayar" class="form-control" id="fakturSudahDibayar" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="fakturDibayar">Quantity</label>
                                                    <input type="text" name="fakturDibayar" class="form-control" id="fakturDibayar">
                                                </div>
                                                <div class="form-group">
                                                    <label for="fakturSisa" style="display: none;">Nilai</label>
                                                    <input type="hidden" name="fakturSisa" class="form-control" id="fakturSisa" readonly>
                                                </div>
                                                <div>
                                                    <span class="btn btn-success" onclick="AddData()" id="fakturcatat" style="cursor: pointer;">Catat</span>
                                                    <span class="btn btn-success" onclick="editData()" id="fakturupdate" style="cursor: pointer;display: none;">Update</span>
                                                </div>
                                                <hr>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <a onclick="location.reload()">
                                                        <button class="btn btn-danger btn-sm elevation-1" style="opacity: .7; height: 40px;">Batal</button>
                                                    </a>
                                                    <div class="form-group mb-0">
                                                        <button type="submit" onclick="submitData();" class="btn btn-success elevation-2" style="opacity: .7; height: 40px;">Simpan Perubahan</button>
                                                    </div>
                                                </div>
                                                <div id="hiddenInputs"></div>

                                            </div>
                                            <div class="col-md-8" style="margin-left: 90px;">
                                                <table class="table table-bordered" id="tableFaktur">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>Kode Barang</th>
                                                            <th>Nama Barang</th>
                                                            <th>Harga</th>
                                                            <th>Satuan</th>
                                                            <th>Quantity</th>
                                                            <th>Aksi</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="4" style="text-align: right;font-weight: bold;">Jumlah</td>
                                                            <td id="jumlahfakturtable">0</td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <hr>
                </section>
            </div>
            <script>
                const today = new Date();
                const formattedDate = today.toISOString().split('T')[0];
                document.getElementById('tanggalbukti').value = formattedDate;
                let currentRowIndex = null;
                let currentUMRowIndex = null;

                function AddData() {
                    const sisavalidation = parseFloat($('#fakturSisa').val().replace(/\./g, '').replace(/,/g, '.')) || 0;
                    const fakturtes = document.getElementById("nomorfaktur").value;
                    if (fakturtes == "") {
                        alert("Harap isi faktur");
                    } else if (sisavalidation < 0) {
                        alert("Sisa Tidak boleh kurang dari 0");
                    } else {
                        const AddRown = document.getElementById('tableFaktur');
                        const NewRow = AddRown.insertRow(AddRown.rows.length - 1);

                        const faktur = document.getElementById("nomorfaktur").value;
                        const tanggaltes = document.getElementById("tanggalfaktur").value;

                        const [year, month, day] = tanggaltes.split("-");
                        const tanggal = document.getElementById("tanggalfaktur").value;
                        const nilaiFaktur = document.getElementById("nilaiFaktur").value;
                        const sudahDibayar = document.getElementById("fakturSudahDibayar").value;
                        const dibayar = document.getElementById("fakturDibayar").value;

                        const jumlahFakturElement = document.getElementById("jumlahfakturtable");
                        const currentValue = parseFloat(jumlahFakturElement.innerHTML.replace(/\./g, '').replace(/,/g, '.')) || 0;
                        const fakturDibayarValue = parseFloat($('#fakturDibayar').val().replace(/\./g, '').replace(/,/g, '.')) || 0;
                        const newValue = currentValue + fakturDibayarValue;
                        jumlahFakturElement.innerHTML = newValue.toLocaleString('de-DE');

                        const values = [faktur, tanggal, nilaiFaktur, sudahDibayar, dibayar];

                        values.forEach((value) => {
                            NewRow.insertCell().innerHTML = value;
                        });

                        const actionCell = NewRow.insertCell();
                        actionCell.innerHTML = `
                        <span class="action-link btn btn-secondary" onclick="updateRow(this)">Update</span>
                        <span class="action-link btn btn-danger" onclick="deleteRow(this)">Delete</span>
                    `;

                        clearInputFields();
                    }
                }

                function clearInputFields() {
                    document.getElementById("nomorfaktur").value = "";
                    document.getElementById("tanggalfaktur").value = "";
                    document.getElementById("nilaiFaktur").value = "";
                    document.getElementById("fakturSudahDibayar").value = "";
                    document.getElementById("fakturDibayar").value = "";
                    document.getElementById("fakturSisa").value = ""
                }

                function updateRow(element) {
                    const row = element.parentElement.parentElement;
                    const cells = row.getElementsByTagName("td");

                    if (cells.length >= 5) {
                        document.getElementById("nomorfaktur").value = cells[0].innerHTML;
                        const [day, month, year] = cells[1].innerHTML.split("/");
                        tanggaltes = `${year}-${month}-${day}`;
                        document.getElementById("tanggalfaktur").value = tanggaltes;
                        document.getElementById("nilaiFaktur").value = cells[2].innerHTML;
                        document.getElementById("fakturSudahDibayar").value = cells[3].innerHTML;
                        const fakturDibayarInput = document.getElementById("fakturDibayar");
                        fakturDibayarInput.value = cells[4].innerHTML;

                        const event = new Event('input', {
                            bubbles: true,
                            cancelable: true
                        });
                        fakturDibayarInput.dispatchEvent(event);
                        currentRowIndex = row.rowIndex;

                        const jumlahFakturElement = document.getElementById("jumlahfakturtable");
                        const currentValue = parseFloat(jumlahFakturElement.innerHTML.replace(/\./g, '').replace(/,/g, '.')) || 0;
                        const fakturDibayarValue = parseFloat($('#fakturDibayar').val().replace(/\./g, '').replace(/,/g, '.')) || 0;
                        const newValue = currentValue - fakturDibayarValue;
                        jumlahFakturElement.innerHTML = newValue.toLocaleString('de-DE');

                        $("#fakturcatat").hide();
                        $("#fakturupdate").show();
                    } else {
                        console.error("Row does not have enough cells");
                    }
                }

                function editData() {
                    const row = document.getElementById('tableFaktur').rows[currentRowIndex];

                    if (row) {
                        const cells = row.getElementsByTagName("td");
                        if (cells.length >= 5) {

                            cells[0].innerHTML = document.getElementById("nomorfaktur").value;
                            const [year, month, day] = document.getElementById("tanggalfaktur").value.split("-");
                            const tanggal = `${day}/${month}/${year}`;
                            cells[1].innerHTML = tanggal;
                            cells[2].innerHTML = document.getElementById("nilaiFaktur").value;
                            cells[3].innerHTML = document.getElementById("fakturSudahDibayar").value;
                            cells[4].innerHTML = document.getElementById("fakturDibayar").value;

                            const jumlahFakturElement = document.getElementById("jumlahfakturtable");
                            const currentValue = parseFloat(jumlahFakturElement.innerHTML.replace(/\./g, '').replace(/,/g, '.')) || 0;
                            const fakturDibayarValue = parseFloat($('#fakturDibayar').val().replace(/\./g, '').replace(/,/g, '.')) || 0;
                            const newValue = currentValue + fakturDibayarValue;
                            jumlahFakturElement.innerHTML = newValue.toLocaleString('de-DE');

                            clearInputFields();
                            $("#fakturupdate").hide();
                            $("#fakturcatat").show();

                            currentRowIndex = null;
                        }
                    }
                }

                function deleteRow(element) {
                    const row = element.parentElement.parentElement;
                    const cells = row.getElementsByTagName("td");
                    const jumlahFakturElement = document.getElementById("jumlahfakturtable");
                    const currentValue = parseFloat(jumlahFakturElement.innerHTML.replace(/\./g, '').replace(/,/g, '.')) || 0;
                    const fakturDibayarValue = parseFloat(cells[4].innerHTML.replace(/\./g, '').replace(/,/g, '.')) || 0;
                    const newValue = currentValue - fakturDibayarValue;
                    jumlahFakturElement.innerHTML = newValue.toLocaleString('de-DE');

                    row.parentNode.removeChild(row);
                    if (row.rowIndex === currentRowIndex) {
                        clearInputFields();
                        $("#fakturupdate").hide();
                        $("#fakturcatat").show();
                        currentRowIndex = null;
                    }
                }

                function AddUMData() {
                    const sisavalidation = parseFloat($('#UMSisa').val().replace(/\./g, '').replace(/,/g, '.')) || 0;
                    const buktites = document.getElementById("nomorbukti").value;
                    if (buktites == "") {
                        alert("Harap isi bukti");
                    } else if (sisavalidation < 0) {
                        alert("Sisa Tidak boleh kurang dari 0");
                    } else {
                        const AddRown = document.getElementById('tableUangMuaka');
                        const NewRow = AddRown.insertRow(AddRown.rows.length - 1);

                        const bukti = document.getElementById("nomorbukti").value;
                        const tanggaltes = document.getElementById("tanggalUangMuka").value;

                        const [year, month, day] = tanggaltes.split("-");
                        const tanggalbukti = `${day}/${month}/${year}`;

                        const nilaibukti = document.getElementById("nilaiterima").value;
                        const buktisudahDibayar = document.getElementById("UMSudahDibayar").value;
                        const buktidibayar = document.getElementById("UMDibayar").value;

                        const jumlahUMElement = document.getElementById("jumlahUMtable");
                        const currentValue = parseFloat(jumlahUMElement.innerHTML.replace(/\./g, '').replace(/,/g, '.')) || 0;
                        const UMDibayarValue = parseFloat($('#UMDibayar').val().replace(/\./g, '').replace(/,/g, '.')) || 0;
                        const newValue = currentValue + UMDibayarValue;
                        jumlahUMElement.innerHTML = newValue.toLocaleString('de-DE');

                        const values = [bukti, tanggalbukti, nilaibukti, buktisudahDibayar, buktidibayar];

                        values.forEach((value) => {
                            NewRow.insertCell().innerHTML = value;
                        });

                        const actionCell = NewRow.insertCell();
                        actionCell.innerHTML = `
                        <span class="action-link btn btn-secondary" onclick="updateRowUM(this)">Update</span>
                        <span class="action-link btn btn-danger" onclick="deleteRowUM(this)">Delete</span>
                    `;

                        clearInputFieldsUM();
                    }
                }

                function clearInputFieldsUM() {
                    document.getElementById("nomorbukti").value = "";
                    document.getElementById("tanggalUangMuka").value = "";
                    document.getElementById("nilaiterima").value = "";
                    document.getElementById("UMSudahDibayar").value = "";
                    document.getElementById("UMDibayar").value = "";
                    document.getElementById("UMSisa").value = ""
                }

                function updateRowUM(element) {
                    const row = element.parentElement.parentElement;
                    const cells = row.getElementsByTagName("td");

                    if (cells.length >= 5) {
                        document.getElementById("nomorbukti").value = cells[0].innerHTML;
                        const [day, month, year] = cells[1].innerHTML.split("/");
                        tanggaltes = `${year}-${month}-${day}`;
                        document.getElementById("tanggalUangMuka").value = tanggaltes;
                        document.getElementById("nilaiterima").value = cells[2].innerHTML;
                        document.getElementById("UMSudahDibayar").value = cells[3].innerHTML;
                        const UMDibayarInput = document.getElementById("UMDibayar");
                        UMDibayarInput.value = cells[4].innerHTML;

                        const event = new Event('input', {
                            bubbles: true,
                            cancelable: true
                        });
                        UMDibayarInput.dispatchEvent(event);
                        currentUMRowIndex = row.rowIndex;

                        const jumlahUMElement = document.getElementById("jumlahUMtable");
                        const currentValue = parseFloat(jumlahUMElement.innerHTML.replace(/\./g, '').replace(/,/g, '.')) || 0;
                        const UMdibayarvalue = parseFloat($('#UMDibayar').val().replace(/\./g, '').replace(/,/g, '.')) || 0;
                        const newValue = currentValue - UMdibayarvalue;
                        jumlahUMElement.innerHTML = newValue.toLocaleString('de-DE');

                        $("#UMcatat").hide();
                        $("#UMupdate").show();
                    } else {
                        console.error("Row does not have enough cells");
                    }
                }

                function editUMData() {
                    const row = document.getElementById('tableUangMuaka').rows[currentUMRowIndex];

                    if (row) {
                        const cells = row.getElementsByTagName("td");
                        if (cells.length >= 5) {
                            cells[0].innerHTML = document.getElementById("nomorbukti").value;
                            const [year, month, day] = document.getElementById("tanggalUangMuka").value.split("-");
                            const tanggal = `${day}/${month}/${year}`;
                            cells[1].innerHTML = tanggal;
                            cells[2].innerHTML = document.getElementById("nilaiterima").value;
                            cells[3].innerHTML = document.getElementById("UMSudahDibayar").value;
                            cells[4].innerHTML = document.getElementById("UMDibayar").value;

                            const jumlahUMElement = document.getElementById("jumlahUMtable");
                            const currentValue = parseFloat(jumlahUMElement.innerHTML.replace(/\./g, '').replace(/,/g, '.')) || 0;
                            const UMdibayarvalue = parseFloat($('#UMDibayar').val().replace(/\./g, '').replace(/,/g, '.')) || 0;
                            const newValue = currentValue + UMdibayarvalue;
                            jumlahUMElement.innerHTML = newValue.toLocaleString('de-DE');

                            clearInputFieldsUM();
                            $("#UMupdate").hide();
                            $("#UMcatat").show();

                            currentUMRowIndex = null;
                        }
                    }
                }

                function deleteRowUM(element) {
                    const row = element.parentElement.parentElement;
                    const cells = row.getElementsByTagName("td");
                    const jumlahUMElement = document.getElementById("jumlahUMtable");
                    const currentValue = parseFloat(jumlahUMElement.innerHTML.replace(/\./g, '').replace(/,/g, '.')) || 0;
                    const UMdibayarvalue = parseFloat(cells[4].innerHTML.replace(/\./g, '').replace(/,/g, '.')) || 0;
                    const newValue = currentValue - UMdibayarvalue;
                    jumlahUMElement.innerHTML = newValue.toLocaleString('de-DE');
                    row.parentNode.removeChild(row);

                    if (row.rowIndex === currentUMRowIndex) {
                        clearInputFieldsUM();
                        $("#UMupdate").hide();
                        $("#UMcatat").show();
                        currentUMRowIndex = null;
                    }
                }

                function submitData() {
                    const hiddenInputsContainer = document.getElementById("hiddenInputs");
                    hiddenInputsContainer.innerHTML = "";
                    const hiddenUMInputsContainer = document.getElementById("hiddenUMInputs");
                    hiddenUMInputsContainer.innerHTML = "";

                    const table = document.getElementById("tableFaktur");
                    const rowCount = table.rows.length - 1;
                    for (let i = 0; i < rowCount; i++) {
                        const cells = table.rows[i].cells;
                        const values = [];

                        for (let j = 0; j < cells.length - 1; j++) {
                            values.push(cells[j].innerHTML);

                            // if (j == 1) {
                            //     const [day, month, year] = cells[j].innerHTML.split("/");
                            //     tanggal = `${year}-${month}-${day}`;
                            //     values.push(tanggal);
                            // } else if (j != 0) {
                            //     const dibayarfakturpost = parseFloat(cells[j].innerHTML.replace(/\./g, '').replace(/,/g, '.'));
                            //     values.push(dibayarfakturpost);
                            // } else {
                            //     values.push(cells[j].innerHTML);
                            // }
                        }

                        const hiddenNames = ["nomorfaktur", "tanggalfaktur", "nilaiFaktur", "fakturSudahDibayar", "fakturDibayar"];
                        hiddenNames.forEach((name, index) => {
                            hiddenInputsContainer.insertAdjacentHTML(
                                'beforeend',
                                `<input type="hidden" name="${name}[]" value="${values[index]}">`
                            );
                        });
                    }
                    const tableUM = document.getElementById("tableUangMuaka");
                    const rowCountUM = tableUM.rows.length - 1;
                    for (let i = 0; i < rowCountUM; i++) {
                        const cellsUM = tableUM.rows[i].cells;
                        const valuesUM = [];

                        for (let j = 0; j < cellsUM.length - 1; j++) {
                            valuesUM.push(cellsUM[j].innerHTML);

                            // if (j == 1) {
                            //     const [day, month, year] = cellsUM[j].innerHTML.split("/");
                            //     tanggalUM = `${year}-${month}-${day}`;
                            //     valuesUM.push(tanggalUM);
                            // } else if (j != 0) {
                            //     const dibayarUMpost = parseFloat(cellsUM[j].innerHTML.replace(/\./g, '').replace(/,/g, '.'));
                            //     valuesUM.push(dibayarUMpost);
                            // } else {
                            //     valuesUM.push(cellsUM[j].innerHTML);
                            // }
                        }
                        const hiddenUMNames = ["nomorbukti", "tanggalbukti", "nilaibukti", "buktisudahDibayar", "buktidibayar"];
                        hiddenUMNames.forEach((name, index) => {
                            hiddenUMInputsContainer.insertAdjacentHTML(
                                'beforeend',
                                `<input type="hidden" name="${name}[]" value="${valuesUM[index]}">`
                            );
                        });
                    }
                }

                function validateForm() {
                    const jumlahselisihsimpan = document.getElementById("jumlahselisihsimpan");
                    const currentValue = parseFloat(jumlahselisihsimpan.innerHTML.replace(/\./g, '').replace(/,/g, '.')) || 0;

                    if (currentValue != 0) {
                        alert("Selisih Belum mencapai 0");
                        return false;
                    }
                    if ($("#status_bukti").html() === "") {
                        alert("Belum dilakukan cek bukti");
                        return false;
                    }
                    if ($("#status_bukti").html() === "sudah terpakai!!") {
                        alert("Nomor bukti sudah terpakai, ubah nomor bukti");
                        return false;
                    }
                    return true;
                }

                document.addEventListener("DOMContentLoaded", function() {
                    const tabLinks = document.querySelectorAll('#pills-tab .nav-link');
                    const tabContents = document.querySelectorAll('.tab-pane');

                    tabLinks.forEach(link => {
                        link.addEventListener('click', function(e) {
                            e.preventDefault();
                            tabLinks.forEach(link => link.classList.remove('active'));
                            tabContents.forEach(content => content.classList.remove('show', 'active'));
                            this.classList.add('active');
                            const target = document.querySelector(this.getAttribute('href'));
                            target.classList.add('show', 'active');
                            scrollToPosition(this.id);
                        });
                    });

                    function scrollToPosition(tabId) {
                        const scrollPosition = tabId === 'pills-simpan-tab' ? 0 : document.documentElement.scrollHeight * 0.24;
                        window.scrollTo({
                            top: scrollPosition,
                            behavior: 'smooth'
                        });
                    }
                });

                $(document).on("click", "#pills-simpan-tab", function() {

                    const jumlah1 = document.getElementById("jumlahfakturtable").innerHTML;
                    const jumlah2 = document.getElementById("jumlahUMtable").innerHTML;

                    document.getElementById("jumlahfakturdibayarsimpan").innerHTML = jumlah1;
                    document.getElementById("jumlahuangmukadibayarsimpan").innerHTML = jumlah2;
                    // document.getElementById("jumlahreturdibayarsimpan").innerHTML = jumlah3;
                    // document.getElementById("jumlahpembayarandiskon").innerHTML = jumlah4;


                    const value1 = parseFloat(jumlah1.replace(/\./g, '').replace(/,/g, '.')) || 0;
                    const value2 = parseFloat(jumlah2.replace(/\./g, '').replace(/,/g, '.')) || 0;
                    // const value3 = parseFloat(jumlah3.replace(/\./g, '').replace(/,/g, '.')) || 0;
                    // const value4 = parseFloat(jumlah4.replace(/\./g, '').replace(/,/g, '.')) || 0;

                    const newValue = value1 - value2;

                    document.getElementById("jumlahselisihsimpan").innerHTML = newValue.toLocaleString('de-DE');
                });
                $(document).on("click", ".cekBukti", function() {
                    const value = document.getElementById('bukti').value;
                    if (value != "") {
                        $.ajax({
                            type: 'GET',
                            url: 'route/data_piutang/ajax_cekBukti.php?value=' + value,
                            dataType: 'json',
                            success: function(response) {
                                if (response != "") {
                                    alert("Nomor Bukti = " + response + " sudah di gunakan");
                                    $("#status_bukti").html("sudah terpakai!!");
                                } else {
                                    $("#status_bukti").html("bisa di gunakan");
                                }
                            },
                            error: function(xhr, status, error) {
                                console.log(xhr.responseText);
                            }
                        });
                    } else {
                        alert("Nomor Bukti masih kosong, Silahkan Isi");
                        $("#status_bukti").html("Silahkan Isi");
                    }
                });
                $(document).on("input", "#bukti", function() {
                    $("#status_bukti").html("");
                });
                $(document).on("input", "#fakturDibayar", function() {
                    const value = $(this).val().replace(/\./g, "");
                    const formattedValue = value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                    const nilaifaktur = parseFloat($('#nilaiFaktur').val().replace(/\./g, '').replace(/,/g, '.'));
                    const fakturdibayar = parseFloat($('#fakturSudahDibayar').val().replace(/\./g, '').replace(/,/g, '.'));

                    $(this).val(formattedValue);

                    const fakturDibayarNumeric = parseInt(value, 10) || 0;
                    const fakturSisa = nilaifaktur - fakturdibayar - fakturDibayarNumeric;
                    $('#fakturSisa').val(parseFloat(fakturSisa).toLocaleString('de-DE'));
                });
                $(document).on("input", "#UMDibayar", function() {
                    const value = $(this).val().replace(/\./g, "");
                    const formattedValue = value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                    const nilaiterima = parseFloat($('#nilaiterima').val().replace(/\./g, '').replace(/,/g, '.'));
                    const UMSudahDibayar = parseFloat($('#UMSudahDibayar').val().replace(/\./g, '').replace(/,/g, '.'));

                    $(this).val(formattedValue);

                    const UMDibayarNumeric = parseInt(value, 10) || 0;
                    const UMsisa = nilaiterima - UMSudahDibayar - UMDibayarNumeric;
                    $('#UMSisa').val(parseFloat(UMsisa).toLocaleString('de-DE'));
                });
                $(document).on("input", "#tampil_pelanggan_kode", function() {
                    const value = $(this).val();
                    $("#tampil_pelanggan_nama").val("");
                    $("#status_pelanggan").html("");

                    if (value.length >= 6) {
                        $.ajax({
                            type: 'GET',
                            url: 'route/data_piutang/ajax_kdpelanggan.php?value=' + value,
                            dataType: 'json',
                            success: function(response) {
                                if (response != "tidak ditemukan") {
                                    $("#tampil_pelanggan_kode").val(response[0]);
                                    $("#tampil_pelanggan_nama").val(response[1]);

                                    $("#status_pelanggan").html("<small style='color:green;font-style:italic'>ditemukan</small>");
                                }

                            },
                            error: function(xhr, status, error) {
                                console.log(xhr.responseText);
                            }
                        });
                    }
                });
                $(document).on("click", ".modal-pilih-pelanggan", function() {

                    const id = $(this).attr('id');
                    const kode = $(this).attr('kode');
                    const nama = $(this).attr('nama');

                    $("#tampil_pelanggan_kode").val(kode);
                    $("#tampil_pelanggan_nama").val(nama);

                    $("#status_pelanggan").html("<small style='color:green;font-style:italic'>ditemukan</small>");
                });
                $(document).on("click", ".modal-pilih-uangMuka", function() {
                    const bukti_kas = $(this).attr('response-bukti_kas');
                    const tanggal = $(this).attr('response-tanggal');
                    const nilai_faktur = $(this).attr('response-nilai');
                    const fakturSudahDibayar = $(this).attr('response-dibayar');

                    $("#tanggalUangMuka").val(tanggal);
                    $("#UMDibayar").val(0);

                    $("#nomorbukti").val(bukti_kas);
                    $("#nilaiterima").val(parseFloat(nilai_faktur).toLocaleString('de-DE'));
                    $("#UMSudahDibayar").val(parseFloat(fakturSudahDibayar).toLocaleString('de-DE'));
                    const fakturSisa = nilai_faktur - fakturSudahDibayar;
                    $('#UMSisa').val(parseFloat(fakturSisa).toLocaleString('de-DE'));

                    $('#closemodalUangMuka').click();
                });
                $(document).on("click", ".modal-pilih-faktur", function() {
                    const faktur = $(this).attr('response-faktur');
                    const tanggal = $(this).attr('response-tanggal');
                    const nilai_faktur = $(this).attr('response-nilai');
                    const fakturSudahDibayar = $(this).attr('response-dibayar');

                    $("#tanggalfaktur").val(tanggal);
                    $("#fakturDibayar").val(0);

                    $("#nomorfaktur").val(faktur);
                    $("#nilaiFaktur").val(nilai_faktur);
                    $("#fakturSudahDibayar").val(fakturSudahDibayar);
                    const fakturSisa = nilai_faktur - fakturSudahDibayar;
                    $('#fakturSisa').val(fakturSisa);

                    $('#closemodalfaktur').click();
                });
                $(document).on("click", "#cariTableUangMuka", function() {

                    const value = document.getElementById('tampil_pelanggan_kode').value;
                    const tableUM = document.getElementById("tableUangMuaka");
                    const rowCountUM = tableUM.rows.length - 1;
                    const valuesUM = [];
                    for (let i = 1; i < rowCountUM; i++) {
                        const cellsUM = tableUM.rows[i].cells;
                        valuesUM.push(cellsUM[0].innerHTML);
                    }

                    $.ajax({
                        type: 'GET',
                        url: 'route/data_piutang/ajax_cariUangMuka.php?value=' + value + '&valuesUM=' + valuesUM,
                        dataType: 'json',
                        success: function(response) {

                            const tableBody = $('#data-table-UangMuka');
                            tableBody.empty();
                            response.forEach(function(item) {
                                const row = `
                                    <tr>
                                        <td class="text-center">${item.no}</td>
                                        <td class="text-center" style="width: 20%;">${item.formatetanggal}</td>
                                        <td>${item.bukti_kas}</td>
                                        <td>${item.kd_cus}</td>
                                        <td>${item.nilai_fakturformat}</td>
                                        <td>
                                            <span class="btn btn-success btn-sm modal-pilih-uangMuka" 
                                                response-bukti_kas="${item.bukti_kas}" 
                                                response-tanggal="${item.tanggal}" 
                                                response-nilai="${item.nilai_faktur}"
                                                response-dibayar="${item.bayar_lalu}">
                                                Pilih
                                            </span>
                                        </td>
                                    </tr>
                                `;
                                tableBody.append(row);
                            });

                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                        }
                    });
                });
                $(document).on("click", "#cariTableFaktur", function() {

                    const value = document.getElementById('tampil_pelanggan_kode').value;
                    const tablefakturtes = document.getElementById("tableFaktur");
                    const rowtablefakturtes = tablefakturtes.rows.length - 1;
                    const valuesfakturtes = [];

                    for (let i = 1; i < rowtablefakturtes; i++) {
                        const cellsUMfakctor = tablefakturtes.rows[i].cells;
                        valuesfakturtes.push(cellsUMfakctor[0].innerHTML);
                    }
                    console.log(valuesfakturtes);

                    $.ajax({
                        type: 'GET',
                        url: 'route/data_piutang/ajax_cariFaktur.php?value=' + value + '&valuesUM=' + valuesfakturtes,
                        dataType: 'json',
                        success: function(response) {
                            const tableBody = $('#data-table-faktur');
                            tableBody.empty();
                            response.forEach(function(item) {
                                const row = `
                                    <tr>
                                        <td class="text-center">${item.no}</td>
                                        <td class="text-center" style="width: 20%;">${item.formatetanggal}</td>
                                        <td>${item.kd_cus}</td>
                                        <td>${item.nilai_fakturformat}</td>
                                        <td>
                                            <span class="btn btn-success btn-sm modal-pilih-faktur" 
                                                response-faktur="${item.faktur}" 
                                                response-tanggal="${item.tanggal}" 
                                                response-nilai="${item.nilai_fakturformat}"
                                                response-dibayar="${item.kd_cus}">
                                                Pilih
                                            </span>
                                        </td>
                                    </tr>
                                `;
                                tableBody.append(row);
                            });

                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                        }
                    });
                });
            </script>
<?php
            break;
    }
}
?>