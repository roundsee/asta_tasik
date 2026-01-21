<table id="example" class="table table-bordered table-striped">
    <thead style="background-color: lightgray;font-size: 90%;" class="elevation-2">
        <tr>
            <th>No.</th>
            <th><?php echo $jj2; ?></th>
            <th>QTY</th>
            <th>Nilai</th>
        </tr>
    </thead>
    <tbody>
    <?php

    $sql1 = mysqli_query($koneksi, "SELECT * FROM $tabel WHERE tgl_beli = '$tgl_awal'");
    $no = 1;
    $nilai_pjk = 0;
    $subtotal = 0;

    if (!$sql1) {
        die("Error: " . mysqli_error($koneksi));
    }

    $data_barang = [];

    while ($s1 = mysqli_fetch_array($sql1)) {
        $kd_cus = $s1['kd_cus']; // Ambil kd_cus dari tabel pembelian

        $sql2 = mysqli_query($koneksi, "SELECT kd_brg, jumlah_datang 
                                        FROM penerimaan_barang 
                                        WHERE kd_po='$s1[kd_po]'");

        if (!$sql2) {
            die("Error: " . mysqli_error($koneksi));
        }

        // Loop untuk data dari tabel penerimaan_barang
        while ($s2 = mysqli_fetch_array($sql2)) {
            $jumlah_barang = $s2['jumlah_datang']; // Ambil jumlah datang dari tabel penerimaan_barang
            $kd_brg = $s2['kd_brg'];

            // Ambil data harga dan diskon dari tabel pembelian_detail
            $sql3 = mysqli_query($koneksi, "SELECT price, disc 
                                            FROM $tabel2 
                                            WHERE kd_beli='$s1[kd_beli]' 
                                            AND kd_brg='$kd_brg'");

            $s3 = mysqli_fetch_array($sql3);
            $harga_barang = $s3['price']; // harga barang
            $diskon = $s3['disc']; // diskon per barang

            // Hitung total sebelum pajak
            $total_sebelum_pjk = ($jumlah_barang * $harga_barang) - $diskon;

            // Cek apakah PPN (pajak) berlaku
            if ($s1['ppn'] == 1) {
                $nilai_pjk = $total_sebelum_pjk * $s1['tarif_ppn'] / 100;
            } else {
                $nilai_pjk = 0;
            }

            // Total per barang setelah pajak
            $total_per_barang = $total_sebelum_pjk + $nilai_pjk;

            // Gabungkan barang dengan kd_brg dan kd_cus yang sama ke dalam array
            $key_barang = $kd_cus . '-' . $kd_brg; // Gabungkan kd_cus dan kd_brg untuk menjadi kunci unik

            if (isset($data_barang[$key_barang])) {
                // Jika sudah ada barang dengan kd_brg dan kd_cus ini, tambahkan qty dan totalnya
                $data_barang[$key_barang]['total_qty'] += $jumlah_barang;
                $data_barang[$key_barang]['total_nilai'] += $total_per_barang;
            } else {
                // Jika belum ada, buat entry baru di array
                $data_barang[$key_barang] = [
                    'kd_brg' => $kd_brg,
                    'kd_cus' => $kd_cus,
                    'total_qty' => $jumlah_barang,
                    'total_nilai' => $total_per_barang
                ];
            }
        }
    }

    // Tampilkan hasil penggabungan barang dengan kd_brg dan kd_cus yang sama
    foreach ($data_barang as $barang) {
        ?>
        <tr align="left">
            <td><?php echo $no; ?></td>
            <td><?php echo $barang['kd_brg']; ?></td>
            <td><?php echo $barang['total_qty']; ?></td>
            <td><?php echo $barang['total_nilai']; ?></td>
        </tr>
        <?php
        $no++;
    }
    ?>
    </tbody>
</table>

<br><br>
