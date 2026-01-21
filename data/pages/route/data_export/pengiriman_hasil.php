<table id="example4" width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-bordered table-striped">
    <thead style="background-color: #ddd;">
        <tr style="font-weight: 600">
            <th align="center" width="40px">No</th>
            <th>Tanggal</th>
            <th>Dari</th>
            <th>Ke</th>
            <th>Kode Barang</th>
            <th align="left">Qty</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $total_kirim = 0;

        $sql1 = mysqli_query($koneksi, "
            SELECT 
                pd.*, 
                SUM(pd.qty_diterima * pd.qty_satuan) as total_qty,
                permintaan_barang.kd_cus_pengirim,
                permintaan_barang.kd_cus_peminta,
                permintaan_barang.tanggal_permintaan
            FROM permintaan_barang_detail pd
            JOIN permintaan_barang ON permintaan_barang.kode_permintaan = pd.kode_permintaan
            WHERE permintaan_barang.tanggal_permintaan = '$tgl_awal' AND pd.status_item = 1
            GROUP BY pd.kd_barang, kd_cus_pengirim
            ORDER BY  tanggal_permintaan, kode_permintaan ASC;
        ");

        if (!$sql1) {
            die("Query error: " . mysqli_error($koneksi));
        }

        while ($s1 = mysqli_fetch_array($sql1)) {
           $kirim = $s1['total_qty'] ;
            $total_kirim += $kirim;
        ?>
        <tr>
            <td align="right"><?php echo $no; ?></td>
            <td align="left"><?php echo $s1['tanggal_permintaan']; ?></td>
            <td align="left"><?php echo $s1['kd_cus_pengirim']; ?></td>
            <td align="left"><?php echo $s1['kd_cus_peminta']; ?></td>
            <td align="left"><?php echo $s1['kd_barang']; ?></td>
            <td align="right"><?php echo $s1['total_qty']; ?></td>
            <!-- <td align="right"><?php echo  $s1['qty_diterima'] * $s1['qty_satuan']?></td> -->
        </tr>
        <?php
            $no++;
        }

        ?>
    </tbody>
    <tfoot>
        <tr style="font-weight: 600">
            <td colspan="5" align="right">Grand Total Keseluruhan</td>
            <td align="right"><?php echo $total_kirim; ?></td>
        </tr>
    </tfoot>
</table>
