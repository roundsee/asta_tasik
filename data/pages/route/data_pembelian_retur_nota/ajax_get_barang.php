<?php
include '../../../../config/koneksi.php'; // Sesuaikan dengan koneksi database Anda

if (isset($_POST['lokasi']) && !empty($_POST['lokasi'])) {
    $lokasi = mysqli_real_escape_string($koneksi, $_POST['lokasi']);

    $query = "
        SELECT barang.kd_brg, barang.hrg_pcs,
               barang.qty_satuan1, barang.qty_satuan2,
               barang.qty_satuan3, barang.qty_satuan4,
               barang.qty_satuan5, barang.Box, barang.Dus,
               barang.nama, inventory.stok
        FROM barang
        JOIN inventory ON inventory.kd_brg = barang.kd_brg
        WHERE barang.kd_subgrup IS NULL AND inventory.kd_cus = '$lokasi'
        ORDER BY barang.nama ASC
    ";

    $produk = mysqli_query($koneksi, $query);
    $options = '';

    if ($produk && mysqli_num_rows($produk) > 0) {
        while ($pro = mysqli_fetch_array($produk)) {
            $options .= "
                <option value='{$pro['kd_brg']}'
                data-harga='{$pro['hrg_pcs']}'
                data-pcs='{$pro['qty_satuan1']}'
                data-renteng='{$pro['qty_satuan2']}'
                data-pak='{$pro['qty_satuan3']}'
                data-ikat='{$pro['qty_satuan4']}'
                data-ball='{$pro['qty_satuan5']}'
                data-box='{$pro['Box']}'
                data-dus='{$pro['Dus']}'
                data-stok='{$pro['stok']}'>
                {$pro['kd_brg']} - {$pro['nama']} (Stok: {$pro['stok']})
                </option>";
        }
    } else {
        $options = '<option value="">No products found for this location</option>';
    }

    echo $options;
} else {
    echo '<option value="">Invalid location</option>';
}
