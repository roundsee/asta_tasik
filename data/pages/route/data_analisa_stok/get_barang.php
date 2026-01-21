<?php
include '../../../../config/koneksi.php';

// Aktifkan error reporting untuk debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if(isset($_POST['kd_supp'])){
  $kd_supp = $_POST['kd_supp'];
  echo "kd_supp received via POST: $kd_supp<br>";

  $result = mysqli_query($koneksi, "SELECT b.kd_brg, b.nama, b.hrg_pcs, b.Pcs, b.Renteng, b.Pak, b.ikat, b.Ball, b.Box, b.Dus 
                                    FROM barang b 
                                    INNER JOIN supplier_barang sb ON b.kd_brg = sb.kd_brg 
                                    WHERE sb.kd_supp = '$kd_supp'");

  $num_rows = mysqli_num_rows($result);
  echo "Query executed successfully. Number of rows: $num_rows<br>";

  echo "<option value=''>Pilih Barang</option>"; // Opsi kosong untuk default
  while($pro = mysqli_fetch_array($result)){
      echo "
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
} else {
  echo "<option value=''>Pilih Barang</option>"; // Tampilkan opsi kosong jika kd_supp belum dipilih
}
?>
