<?php
include '../../../../config/koneksi.php';

$sqlmanual = mysqli_query($koneksi, "SELECT `kd_brg`, `nama`, `ktg_retail`, `ktg_grosir`, `ktg_online`, `ktg_ms`, `ktg_mg`, `ktg_mp` 
FROM `barang` 
WHERE (`ktg_retail`= 'manual' 
   OR `ktg_grosir`= 'manual' 
   OR `ktg_online`= 'manual' 
   OR `ktg_ms`= 'manual' 
   OR `ktg_mg`= 'manual' 
   OR `ktg_mp`= 'manual') AND `kd_subgrup` IS NULL");

$j31 = "Kategori Retail";
$j32 = "Kategori Grosir";
$j33 = "Kategori Online";
$j34 = "Kategori MS";
$j35 = "Kategori MG";
$j36 = "Kategori MP";
$f31 = "ktg_retail";
$f32 = "ktg_grosir";
$f33 = "ktg_online";
$f34 = "ktg_ms";
$f35 = "ktg_mg";
$f36 = "ktg_mp";

echo '<table id="exportTable">';
echo '<thead>
        <tr>
          <th>Kode Barang</th>
          <th>Nama Barang</th>
          <th>' . $j31 . '</th>
          <th>' . $j32 . '</th>
          <th>' . $j33 . '</th>
          <th>' . $j34 . '</th>
          <th>' . $j35 . '</th>
          <th>' . $j36 . '</th>
        </tr>
      </thead>';
echo '<tbody>';

while ($s1manual = mysqli_fetch_array($sqlmanual)) {
  echo '<tr align="left">
            <td>' . $s1manual['kd_brg'] . '</td>
            <td>' . $s1manual['nama'] . '</td>
            <td>' . ($s1manual[$f31] == "manual" ? "Tanpa Kategori" : $s1manual[$f31]) . '</td>
            <td>' . ($s1manual[$f32] == "manual" ? "Tanpa Kategori" : $s1manual[$f32]) . '</td>
            <td>' . ($s1manual[$f33] == "manual" ? "Tanpa Kategori" : $s1manual[$f33]) . '</td>
            <td>' . ($s1manual[$f34] == "manual" ? "Tanpa Kategori" : $s1manual[$f34]) . '</td>
            <td>' . ($s1manual[$f35] == "manual" ? "Tanpa Kategori" : $s1manual[$f35]) . '</td>
            <td>' . ($s1manual[$f36] == "manual" ? "Tanpa Kategori" : $s1manual[$f36]) . '</td>
          </tr>';
}
echo '</tbody>';
echo '</table>';
