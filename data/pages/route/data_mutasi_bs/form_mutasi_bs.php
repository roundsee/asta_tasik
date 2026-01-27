<!DOCTYPE html>
<html>
<head>
    <title>Input Mutasi Barang BS</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ccc; padding: 6px; }
        button { padding: 5px 10px; }
    </style>
</head>
<body>

<h3>Mutasi Barang BS</h3>

<form method="post">

    <label>Kode Mutasi</label><br>
    <input type="text" name="kode_mutasi_bs" required><br><br>

    <label>Kode Customer</label><br>
    <input type="text" name="kd_cus"><br><br>

    <label>Tanggal</label><br>
    <input type="datetime-local" name="tanggal" value="<?= date('Y-m-d\TH:i') ?>"><br><br>

    <label>Keterangan</label><br>
    <input type="text" name="keterangan"><br><br>

    <hr>

    <h4>Detail Barang</h4>

    <table id="tableDetail">
        <thead>
            <tr>
                <th>Kode Barang</th>
                <th>Jumlah</th>
                <th>Satuan</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    <br>
    <button type="button" onclick="addItem()">+ Add Item</button>

    <br><br>
    <button type="submit">💾 Simpan</button>

</form>

<script>
function addItem() {
    let table = document.getElementById('tableDetail').getElementsByTagName('tbody')[0];
    let row = table.insertRow();

    row.innerHTML = `
        <td><input type="text" name="kd_brg[]" required></td>
        <td><input type="number" name="jumlah[]" step="any" required></td>
        <td><input type="text" name="satuan[]" required></td>
        <td><button type="button" onclick="hapusRow(this)">Hapus</button></td>
    `;
}

function hapusRow(btn) {
    let row = btn.parentNode.parentNode;
    row.parentNode.removeChild(row);
}
</script>

</body>
</html>
