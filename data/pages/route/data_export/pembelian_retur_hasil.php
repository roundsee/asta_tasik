<table id="example" class="table table-bordered table-striped">
    <thead style="background-color: lightgray;font-size: 90%;" class="elevation-2">
        <tr>
            <th>No.</th>
            <th>Tanggal</th>
            <th>Kode Customer</th>
            <th><?php echo $jj2; ?></th>
            <th>QTY</th>
            <th>Nilai</th>
        </tr>
    </thead>
    <tbody>
        <?php
        echo "<script>console.log('Debug Objects: " . $tgl_awal . "' );</script>";

        $sql1 = mysqli_query($koneksi, "SELECT kd_cus,kode_barang, sum(total) as total_nilai ,sum(jumlah) as total_qty FROM pembelian_retur WHERE tgl = '$tgl_awal'
        				GROUP By kode_barang, kd_cus");
        $no = 1;

        if (!$sql1) {
            die("Error: " . mysqli_error($koneksi));
        }

        while ($s1 = mysqli_fetch_array($sql1)) {
        ?>
            <tr align="left">
                <td><?php echo $no; ?></td>
                <td><?php echo $tgl_awal; ?></td>
                <td><?php echo $s1['kd_cus']; ?></td>
                <td><?php echo $s1['kode_barang']; ?></td>
                <td><?php echo $s1['total_qty']; ?></td>
                <td><?php echo $s1['total_nilai']; ?></td>
            </tr>
        <?php
            $no++;
        }
        ?>
    </tbody>
</table>
<!-- <button id="toExcel">Convert to Excel table 2</button>  -->
<script>
    let button = document.querySelector('#toExcel');

    button.addEventListener('click', e => {
        let table = document.querySelector('#example');
        TableToExcel.convert(table);
    });
</script>

<br><br>