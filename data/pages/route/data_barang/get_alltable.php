<?php
include '../../../../config/koneksi.php';

$sqlmanual = mysqli_query($koneksi, "
    SELECT 
        `kd_brg`, `nama`, `harga`, 
        `Satuan1`, `Satuan2`, `Satuan3`, `Satuan4`, `Satuan5`, 
        `qty_satuan1`, `qty_satuan2`, `qty_satuan3`, `qty_satuan4`, `qty_satuan5`, `hrg_satuan1`, `hrg_satuan2`, `hrg_satuan3`, `hrg_satuan4`, `hrg_satuan5`,
        `ktg_retail`, `ktg_buffer`,
        IFNULL((SELECT stok FROM inventory WHERE inventory.kd_brg = barang.kd_brg AND kd_cus = 1316), 0) AS stockswalayan,
        IFNULL((SELECT stok FROM inventory WHERE inventory.kd_brg = barang.kd_brg AND kd_cus = 8001), 0) AS stockgudang
    FROM `barang` where `kd_subgrup` IS NULL
");

echo '<table id="exportTable2">';
echo '<thead>
        <tr>
          <th>Kode Barang</th>
          <th>Nama</th>
          <th>Harga</th>
          <th>Harga jual 1</th>
          <th>Harga jual 2</th>
          <th>Harga jual 3</th>
          <th>Harga jual 4</th>
          <th>Harga jual 5</th>
          <th>Satuan 1</th>
          <th>Satuan 2</th>
          <th>Satuan 3</th>
          <th>Satuan 4</th>
          <th>Satuan 5</th>
          <th>Quantity 1</th>
          <th>Quantity 2</th>
          <th>Quantity 3</th>
          <th>Quantity 4</th>
          <th>Quantity 5</th>
          <th>ID Kategori Harga</th>
          <th>ID Kategori Buffer</th>
          <th>Stock Swalayan</th>
          <th>Stock Gudang</th>
        </tr>
      </thead>';
echo '<tbody>';

while ($s1manual = mysqli_fetch_array($sqlmanual)) {
  echo '<tr>
            <td>' . htmlspecialchars($s1manual['kd_brg']) . '</td>
            <td>' . htmlspecialchars($s1manual['nama']) . '</td>
            <td>' . (int)$s1manual['harga'] . '</td>
            <td>' . (int)$s1manual['hrg_satuan1'] . '</td>
            <td>' . (int)$s1manual['hrg_satuan2'] . '</td>
            <td>' . (int)$s1manual['hrg_satuan3'] . '</td>
            <td>' . (int)$s1manual['hrg_satuan4'] . '</td>
            <td>' . (int)$s1manual['hrg_satuan5'] . '</td>
            <td>' . htmlspecialchars($s1manual['Satuan1']) . '</td>
            <td>' . htmlspecialchars($s1manual['Satuan2']) . '</td>
            <td>' . htmlspecialchars($s1manual['Satuan3']) . '</td>
            <td>' . htmlspecialchars($s1manual['Satuan4']) . '</td>
            <td>' . htmlspecialchars($s1manual['Satuan5']) . '</td>
            <td>' . (int)$s1manual['qty_satuan1'] . '</td>
            <td>' . (int)$s1manual['qty_satuan2'] . '</td>
            <td>' . (int)$s1manual['qty_satuan3'] . '</td>
            <td>' . (int)$s1manual['qty_satuan4'] . '</td>
            <td>' . (int)$s1manual['qty_satuan5'] . '</td>
            <td>' . htmlspecialchars($s1manual['ktg_retail'] === "manual" ? "Tanpa Kategori" : $s1manual['ktg_retail']) . '</td>
            <td>' . htmlspecialchars($s1manual['ktg_buffer']) . '</td>
            <td>' . (int)$s1manual['stockswalayan'] . '</td>
            <td>' . (int)$s1manual['stockgudang'] . '</td>
          </tr>';
}
echo '</tbody>';
echo '</table>';
