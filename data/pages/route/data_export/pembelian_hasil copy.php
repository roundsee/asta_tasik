<table id="example" class="table table-bordered table-striped">
    <thead style="background-color:  lightgray;font-size: 90%;" class="elevation-2">
        <tr>
            <th>No.</th>
            <th ><?php echo $jj2; ?></th>
            <th >QTY</th>
            <th >Nilai</th>
        </tr>
    </thead>
    <tbody>
    <?php

$sql1 = mysqli_query($koneksi, "SELECT * from $tabel WHERE tgl_beli = '$tgl_awal' AND status_pembelian >=2 ");
$no = 1;
$nilai_pjk = 0;
$subtotal = 0;

if (!$sql1) {
    die("erroy" . mysqli_error($koneksi));
}

// Array untuk menyimpan hasil barang yang sudah dihitung
$data_barang = [];

while ($s1 = mysqli_fetch_array($sql1)) {
    // Query untuk mendapatkan semua barang terkait kd_beli dari pembelian_detail
    $sql2 = mysqli_query($koneksi, "SELECT kd_brg, jml, price, disc 
                                     FROM $tabel2 
                                     WHERE kd_beli='$s1[kd_beli]'");
    while ($s2 = mysqli_fetch_array($sql2)) {
        $jumlah_barang = $s2['jml']; // jumlah barang
        $harga_barang = $s2['price']; // harga barang
        $diskon = $s2['disc']; // diskon per barang

        // Hitung grand total per barang
        $total_sebelum_pjk = ($jumlah_barang * $harga_barang) - $diskon;

        // Cek apakah PPN (pajak) berlaku
        if ($s1[$f7] == 1) {
            $nilai_pjk = $total_sebelum_pjk * $s1['tarif_ppn'] / 100;
        } else {
            $nilai_pjk = 0;
        }

        $total_per_barang = $total_sebelum_pjk + $nilai_pjk; // total setelah ditambah PPN

        // Gabungkan barang dengan kd_brg yang sama ke dalam array
        $kd_brg = $s2['kd_brg'];
        if (isset($data_barang[$kd_brg])) {
            // Jika sudah ada barang dengan kd_brg ini, tambahkan qty dan totalnya
            $data_barang[$kd_brg]['total_qty'] += $jumlah_barang;
            $data_barang[$kd_brg]['total_nilai'] += $total_per_barang;
        } else {
            // Jika belum ada, buat entry baru di array
            $data_barang[$kd_brg] = [
                'kd_brg' => $kd_brg,
                'total_qty' => $jumlah_barang,
                'total_nilai' => $total_per_barang
            ];
        }
    }
}

// Tampilkan hasil penggabungan barang dengan kd_brg yang sama
foreach ($data_barang as $barang) {
    ?>
    <tr align="left">
        <td><?php echo $no; ?></td>
        <td><?php echo $barang['kd_brg'];?></td>
        <td><?php echo $barang['total_qty']; ?></td>
        <td><?php echo ($barang['total_nilai']); ?></td>
    </tr>
    <?php
    $no++;
}
?>


    </tbody>
   

</table>


<br>
<br>