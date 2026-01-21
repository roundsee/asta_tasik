<table id="example4" width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-bordered table-striped">
    <thead style="background-color: #ddd;">
        <tr style="font-weight: 600">
            <th align="center" width="40px">No</th>
            <th>Tanggal</th>
            <th>kode lokasi</th>
            <th>Kode Barang</th>
            <th align="left">Qty</th>
            <th align="left" width="140px">nilai</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $subtotal_supplier = 0;
        $grand_total_all_suppliers = 0;
        $current_supplier = "";

        $sql1 = mysqli_query($koneksi, "
            SELECT 
                pd.*, 
                barang.nama, 
                SUM(pd.disc) AS tot_disc, 
                pd.jml,
                pembelian.ppn, 
                pd.jml AS jumlah_barang_datang, 
                pembelian.tarif_ppn, 
                supplier.nama AS nama_supp, 
                supplier.kd_supp,
                pembelian_invoice.tanggal_invoice,
                pembelian.tujuan_kirim
            FROM pembelian_invoice_detail pd
            JOIN barang ON barang.kd_brg = pd.kd_brg
            JOIN pembelian ON pembelian.kd_po = pd.kd_po
            JOIN supplier ON supplier.kd_supp = pembelian.kd_supp
            JOIN pembelian_invoice ON pembelian_invoice.no_invoice = pd.no_invoice
            WHERE pembelian_invoice.tanggal_invoice = '$tgl_awal' 
            GROUP BY pd.kd_po, pd.kd_brg, pd.urut
            ORDER BY kd_supp, tanggal_invoice, kd_po ASC;
        ");

        if (!$sql1) {
            die("Query error: " . mysqli_error($koneksi));
        }

        while ($s1 = mysqli_fetch_array($sql1)) {
            // Jika supplier berubah, cetak subtotal supplier sebelumnya (jika ada)
            if ($current_supplier != $s1['kd_supp']) {
                if ($current_supplier != "") {
                    // Tampilkan subtotal untuk supplier sebelumnya
                    ?>
                    <!-- <tr>
                        <td colspan="9" align="right">Subtotal</td>
                        <td align="right"><?php echo number_format($subtotal_supplier); ?></td>
                    </tr> -->
                    <?php
                }
                // Reset subtotal untuk supplier baru
                $subtotal_supplier = 0;
                $current_supplier = $s1['kd_supp'];
            }

            // Hitung total harga dan pajak
            $total_price = $s1['jumlah_barang_datang'] * $s1['nilai'];
            $grand_total = $total_price - $s1['tot_disc'];
            $nilai_pjk = ($s1['ppn'] == 1) ? $grand_total * $s1['tarif_ppn'] / 100 : 0;
            $subtotal = $grand_total + $nilai_pjk;
            $subtotal_supplier += $subtotal; // Tambahkan ke subtotal supplier
            // $grand_total_all_suppliers += $subtotal; // Tambahkan ke total keseluruhan
            $harga_perbarang = (($s1['nilai'] * $s1['jumlah_barang_datang']) / ($s1['jumlah_barang_datang'] * $s1['jml_pcs']));
            $grand_total_all_suppliers += $harga_perbarang * ($s1['jumlah_barang_datang'] * $s1['jml_pcs']); // Tambahkan ke total keseluruhan
        ?>
        <tr>
            <td align="right"><?php echo $no; ?></td>
            <td align="left"><?php echo $s1['tanggal_invoice']; ?></td>
            <td align="left"><?php echo $s1['tujuan_kirim']; ?></td>
            <td align="left"><?php echo $s1['kd_brg']; ?></td>
            <td align="right"><?php echo  $s1['jumlah_barang_datang'] * $s1['jml_pcs']; ?></td>
            <td align="right"><?php echo  $harga_perbarang * ($s1['jumlah_barang_datang'] * $s1['jml_pcs']); ?></td>
        </tr>
        <?php
            $no++;
        }

        // Tampilkan subtotal terakhir setelah loop
        if ($current_supplier != "") {
        ?>
        <!-- <tr>
            <td colspan="9" align="right">Subtotal</td>
            <td align="right"><?php echo $subtotal_supplier; ?></td>
        </tr> -->
        <?php } ?>
    </tbody>
    <tfoot>
        <tr style="font-weight: 600">
            <td colspan="5" align="right">Grand Total Keseluruhan</td>
            <td align="right"><?php echo $grand_total_all_suppliers; ?></td>
        </tr>
    </tfoot>
</table>
