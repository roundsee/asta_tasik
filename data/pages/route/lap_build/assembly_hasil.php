<!-- <table id="example" class="table table-bordered table-striped">
    <thead style="background-color: lightgray;font-size: 90%;" class="elevation-2">
        <tr>
            <th>No.</th>
            <th>Tanggal</th>
            <th>Sumber</th>
            <th>Lokasi</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Jml</th>
            <th>Satuan</th>
            <th>Harga</th>
            <th>Total</th>

        </tr>
    </thead>
    <tbody>
        <?php
        echo "<script>console.log('Debug Objects: " . $tgl_awal . " ' );</script>";

        $sql1 = mysqli_query($koneksi, "SELECT assemblies.tanggal,assemblies.kd_cus,assemblies.sumber,assemblies.build,pelanggan.nama,assemblies.additional_costs FROM `assemblies` JOIN pelanggan on pelanggan.kd_cus =  assemblies.kd_cus WHERE DATE(tanggal) = '$tgl_awal';");
        $no = 1;

        if (!$sql1) {
            die("Error: " . mysqli_error($koneksi));
        }

        while ($s1 = mysqli_fetch_array($sql1)) {
        ?>
            <tr align="left">
                <td><?php echo $no; ?></td>
                <td><?php echo $tgl_awal; ?></td>
                <td><b><?php echo $s1['sumber']; ?></b></td>
                <td><b><?php echo $s1['nama']; ?></b></td>
                <td colspan="7"></td>

            </tr>
            <?php
            $sql2 = mysqli_query($koneksi, "SELECT kd_brg,nama_brg,banyak,satuan,harga,jumlah FROM `assembly_results` WHERE DATE(tanggal) = '$tgl_awal' AND build = '$s1[build]';");
            while ($s2 = mysqli_fetch_array($sql2)) {
                if (is_null($s2['kd_brg']) || is_null($s2['nama_brg'])) {
                    continue;
                }
            ?>
                <tr align="left">
                    <td colspan="4"></td>
                    <td><?php echo $s2['kd_brg']; ?></td>
                    <td><?php echo $s2['nama_brg']; ?></td>
                    <td><?php echo $s2['banyak']; ?></td>
                    <td><?php echo $s2['satuan']; ?></td>
                    <td><?php echo $s2['harga']; ?></td>
                    <td><?php echo $s2['jumlah']; ?></td>
                </tr>
            <?php } ?>
            <?php
            $sql3 = mysqli_query($koneksi, "SELECT kd_brg,nama_brg,banyak,satuan,harga,jumlah FROM `assembly_components` WHERE DATE(tanggal) = '$tgl_awal' AND build = '$s1[build]';");
            while ($s3 = mysqli_fetch_array($sql3)) {
                if (is_null($s3['kd_brg']) || is_null($s3['nama_brg'])) {
                    continue; // Skip to the next iteration
                }
            ?>
                <tr align="left">
                    <td colspan="4"></td>
                    <td><?php echo $s3['kd_brg']; ?></td>
                    <td><?php echo $s3['nama_brg']; ?></td>
                    <td>-<?php echo $s3['banyak']; ?></td>
                    <td><?php echo $s3['satuan']; ?></td>
                    <td><?php echo $s3['harga']; ?></td>
                    <td>-<?php echo $s3['jumlah']; ?></td>
                </tr>
            <?php } ?>

            <tr align="left">
                <td colspan="5"></td>
                <td>Additional Costs</td>
                <td colspan="3"></td>
                <td><?php echo $s1['additional_costs']; ?></td>
            </tr>
        <?php
            $no++;
        }
        ?>
    </tbody>
</table> -->
<?php
echo "<script>console.log('Debug Objects: " . $tgl_awal . " ' );</script>";
echo "<script>console.log('Debug Objects: " . $tgl_akhir . " ' );</script>";
$sql = "
    SELECT 
        a.tanggal, 
        a.sumber, 
        a.oleh,
        p.nama AS lokasi, 
        '' AS kd_brg, 
        '' AS nama_brg, 
        '' AS banyak, 
        '' AS satuan, 
        '' AS harga, 
        '' AS jumlah, 
        a.additional_costs AS additional_costs, 
        'assemblies' AS source_type,
        a.build AS assembly_id
    FROM assemblies a
    JOIN pelanggan p ON p.kd_cus = a.kd_cus
    WHERE a.tanggal BETWEEN '$tgl_awal 00:00:00' AND '$tgl_akhir 23:59:59' $where_lokasi AND a.user_void = 'belum_void'

    UNION ALL

    SELECT 
        a.tanggal, 
        '' AS sumber,
        '' AS oleh, 
        '' AS lokasi, 
        ar.kd_brg, 
        ar.nama_brg, 
        ar.banyak, 
        ar.satuan, 
        ar.harga, 
        ar.jumlah, 
        NULL AS additional_costs, 
        'assembly_results' AS source_type,
        ar.build AS assembly_id
    FROM assembly_results ar
    join assemblies a on a.build = ar.build
    WHERE a.tanggal BETWEEN '$tgl_awal 00:00:00' AND '$tgl_akhir 23:59:59' $where_lokasi AND a.user_void = 'belum_void'

    UNION ALL

    SELECT 
        a.tanggal, 
        '' AS sumber, 
        '' AS oleh, 
        '' AS lokasi, 
        ac.kd_brg, 
        ac.nama_brg, 
        -ac.banyak AS banyak, 
        ac.satuan, 
        ac.harga, 
        -ac.jumlah AS jumlah, 
        NULL AS additional_costs, 
        'assembly_components' AS source_type,
        ac.build AS assembly_id
    FROM assembly_components ac
    join assemblies a on a.build = ac.build
    WHERE a.tanggal BETWEEN '$tgl_awal 00:00:00' AND '$tgl_akhir 23:59:59' $where_lokasi AND a.user_void = 'belum_void'
    ORDER BY assembly_id, 
        CASE source_type 
            WHEN 'assemblies' THEN 1 
            WHEN 'assembly_results' THEN 2 
            WHEN 'assembly_components' THEN 3 
        END, tanggal;
";

$result = mysqli_query($koneksi, $sql);

if (!$result) {
    die("Error: " . mysqli_error($koneksi));
}
?>

<table id="example8" class="table table-bordered table-striped">
    <thead style="background-color: lightgray;font-size: 90%;" class="elevation-2">
        <tr>
            <?php if ($tgl_awal == date("Y-m-d")) { ?>
                <th class="text-center">Void</th>
            <?php } ?>
            <th>No.</th>
            <th>Tanggal</th>
            <th>Source</th>
            <th>Nama User</th>
            <th>Lokasi</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Jml</th>
            <th>Satuan</th>
            <th>Harga</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $currentAssemblyId = null;

        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['source_type'] === 'assemblies') {
                if ($currentAssemblyId !== null && !is_null($additionalCosts)) { ?>
                    <tr align="left">
                        <td colspan="6"></td>
                        <td style="display: none;"></td>
                        <td style="display: none;"></td>
                        <td style="display: none;"></td>
                        <td style="display: none;"></td>
                        <td style="display: none;"></td>

                        <td>Additional Costs</td>
                        <?php if ($tgl_awal == date("Y-m-d")) { ?>
                            <td colspan="4"></td>
                            <td style="display: none;"></td>
                            <td style="display: none;"></td>
                            <td style="display: none;"></td>

                        <?php } else { ?>
                            <td colspan="3"></td>
                            <td style="display: none;"></td>
                            <td style="display: none;"></td>

                        <?php } ?>
                        <td>-<?php echo number_format($additionalCosts); ?></td>
                    </tr>
                <?php
                }
                // Start new assembly
                $currentAssemblyId = $row['assembly_id'];
                $additionalCosts = $row['additional_costs'];
                ?>
                <tr align="left">
                    <?php if ($tgl_awal == date("Y-m-d")) { ?>
                        <td width="70px;!important">
                            <button type="button" onclick="navigateVoid('<?php echo $row['assembly_id']; ?>')" class="btn btn-danger"><i class="fa fa-close"></i><strong style="color: whitesmoke; opacity: .7;"> VOID</strong></button>
                        </td>
                    <?php } ?>
                    <td width="2px;!important"><?php echo $no++; ?></td>
                    <td width="75px;!important"><?php echo date('Y-m-d', strtotime($row['tanggal'])); ?></td>
                    <td width="300px;!important"><b><?php echo $row['sumber']; ?></b></td>
                    <td><b><?php echo $row['oleh']; ?></b></td>
                    <td><b><?php echo $row['lokasi']; ?></b></td>
                    <td colspan="6"></td>
                    <td style="display: none;"></td>
                    <td style="display: none;"></td>
                    <td style="display: none;"></td>
                    <td style="display: none;"></td>
                    <td style="display: none;"></td>

                </tr>
            <?php
            } else {
            ?>
                <tr align="left">
                    <?php if ($tgl_awal == date("Y-m-d")) { ?>
                        <td colspan="6"></td>
                        <td style="display: none;"></td>
                        <td style="display: none;"></td>
                        <td style="display: none;"></td>
                        <td style="display: none;"></td>
                        <td style="display: none;"></td>

                    <?php } else { ?>
                        <td colspan="5"></td>
                        <td style="display: none;"></td>
                        <td style="display: none;"></td>
                        <td style="display: none;"></td>
                        <td style="display: none;"></td>

                    <?php } ?> <td><?php echo $row['kd_brg']; ?></td>
                    <td><?php echo $row['nama_brg']; ?></td>
                    <td><?php echo number_format($row['banyak']); ?></td>
                    <td><?php echo $row['satuan']; ?></td>
                    <td><?php echo number_format($row['harga']); ?></td>
                    <td><?php echo number_format($row['jumlah']); ?></td>
                </tr>
            <?php
            }
        }
        if (!is_null($additionalCosts)) {
            ?>
            <tr align="left">
                <td colspan="6"></td>
                <td style="display: none;"></td>
                <td style="display: none;"></td>
                <td style="display: none;"></td>
                <td style="display: none;"></td>
                <td style="display: none;"></td>
                <td style="display: none;"></td>

                <td>Additional Costs</td>
                <?php if ($tgl_awal == date("Y-m-d")) { ?>
                    <td colspan="4"></td>
                    <td style="display: none;"></td>
                    <td style="display: none;"></td>
                    <td style="display: none;"></td>
                    <td style="display: none;"></td>

                <?php } else { ?>
                    <td colspan="3"></td>
                    <td style="display: none;"></td>
                    <td style="display: none;"></td>
                    <td style="display: none;"></td>

                <?php } ?>
                <td>-<?php echo number_format($additionalCosts); ?></td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>


<script>
    $(function() {

        $('#example8').DataTable({
            lengthMenu: false,
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": false,
            "info": true,
            "autoWidth": false,
            "responsive": false,
            "scrollX": true,
            "buttons": ["copy", "csv", "excel", "pdf", "print"],
        }).buttons().container().appendTo('#example8_wrapper .col-md-6:eq(0)');

    });
    let button = document.querySelector('#toExcel');

    button.addEventListener('click', e => {
        let table = document.querySelector('#example');
        TableToExcel.convert(table);
    });

    function navigateVoid(button) {
        const tdValue = button;
        const keteranganvoid = prompt("Masukan Keterangan VOID");
        const te1s = '<?php echo $en; ?>';

        if (keteranganvoid) {
            $.ajax({
                type: 'GET',
                url: 'route/lap_build/ajax_void_build.php?keteranganvoid=' + keteranganvoid + '&nomorfaktur=' + tdValue + '&emplyeenumber=' + te1s,
                dataType: 'json',
                success: function(response) {
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }
    }
</script>

<br><br>