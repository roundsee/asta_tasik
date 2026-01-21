<?php
$sql_faktur = "SELECT faktur
               FROM paylater
               WHERE tanggal_payment BETWEEN '$tgl_awal' AND '$tgl_akhir'";

$result_faktur = mysqli_query($koneksi, $sql_faktur);

if (!$result_faktur) {
    die("Query error: " . mysqli_error($koneksi));
}

$faktur_list = [];
while ($row = mysqli_fetch_assoc($result_faktur)) {
    $faktur_list[] = "'" . $row['faktur'] . "'";
}

$faktur = "";
if (count($faktur_list) > 0) {
    $faktur = "(" . implode(",", $faktur_list) . ")";
}

$sql = "
    SELECT 
        p.faktur,
        DATE(p.tanggal) AS tanggal,
        (p.jumlah + p.ongkir - p.voucher_nilai_diskon - p.byr_pocer) as jumlah,
        m.nama AS nama_member,
        t.tanggal_payment,
        emp.name_e as insert_oleh,
        t.reff,
        jt.nama AS nama_metode,
        a.deskripsi AS nama_account,
        t.jumlah_payment
    FROM penjualan p
    LEFT JOIN member m ON p.no_meja = m.kd_member
    LEFT JOIN paylater t ON p.faktur = t.faktur
    LEFT JOIN jenis_transaksi jt ON jt.kd_jenis = t.metode_payment
    LEFT JOIN account a ON a.no_account = t.akun
    LEFT JOIN employee emp ON emp.employee_number = t.insert_oleh
    WHERE " .
    ($faktur !== "" ? "p.faktur IN $faktur OR " : "") .
    "(p.kd_alatbayar = 214 AND p.tanggal BETWEEN '$tgl_awal 00:00:00' AND '$tgl_akhir 23:59:59')
    ORDER BY p.tanggal, p.faktur
";

$result = mysqli_query($koneksi, $sql);

?>
<table id="example8" class="table table-bordered table-striped">
    <thead style="background-color: lightgray;font-size: 90%;" class="elevation-2">
        <tr>
            <th>No.</th>
            <th>Tanggal</th>
            <th>Faktur</th>
            <th>Nama Member</th>
            <th>Tanggal Payment</th>
            <th>Insert Oleh</th>
            <th>Reff</th>
            <th>Metode Payment</th>
            <th>Akun</th>
            <th>Jumlah Payment</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $currentFaktur = null;

        while ($row = mysqli_fetch_assoc($result)) {
            if ($currentFaktur !== $row['faktur']) {
                if ($currentFaktur !== null) { ?>
                    <tr>
                        <td colspan="10" style="background-color: #f2f2f2;"></td>
                        <td style="display: none;"></td>
                        <td style="display: none;"></td>
                        <td style="display: none;"></td>
                        <td style="display: none;"></td>
                        <td style="display: none;"></td>
                        <td style="display: none;"></td>
                        <td style="display: none;"></td>
                        <td style="display: none;"></td>
                        <td style="display: none;"></td>

                    </tr>
                <?php }
                $currentFaktur = $row['faktur']; ?>
                <tr align="left">
                    <td><?php echo $no++; ?></td>
                    <td><?php echo date('Y-m-d', strtotime($row['tanggal'])); ?></td>
                    <td><b><?php echo $row['faktur']; ?></b></td>
                    <td><b><?php echo $row['nama_member']; ?></b></td>
                    <td colspan="5"></td>
                    <td style="display: none;"></td>
                    <td style="display: none;"></td>
                    <td style="display: none;"></td>
                    <td style="display: none;"></td>

                    <td><?php echo $row['jumlah']; ?></td>
                </tr>
            <?php }
            if (!is_null($row['tanggal_payment'])) { ?>
                <tr align="left">
                    <td colspan="4"></td>
                    <td style="display: none;"></td>
                    <td style="display: none;"></td>
                    <td style="display: none;"></td>

                    <td><?php echo $row['tanggal_payment']; ?></td>
                    <td><?php echo $row['insert_oleh']; ?></td>
                    <td><?php echo $row['reff']; ?></td>
                    <td><?php echo $row['nama_metode']; ?></td>
                    <td><?php echo $row['nama_account']; ?></td>
                    <td>-<?php echo $row['jumlah_payment']; ?></td>
                </tr>
        <?php }
        }
        ?>
    </tbody>
</table>

<!-- 
<table id="example" class="table table-bordered table-striped">
    <thead style="background-color: lightgray;font-size: 90%;" class="elevation-2">
        <tr>
            <th>No.</th>
            <th>Tanggal</th>
            <th>Faktur</th>
            <th>Nama Member</th>
            <th>Tanggal Paymet</th>
            <th>Insert Oleh</th>
            <th>reff</th>
            <th>Metode Payment</th>
            <th>Akun</th>
            <th>Jumlah Payment</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "
            SELECT 
                penjualan.faktur,
                date(penjualan.tanggal) as tanggal,
                penjualan.jumlah,
                member.nama,
                COALESCE(
                    (SELECT SUM(paylater.jumlah_payment) 
                    FROM paylater 
                    WHERE paylater.faktur = penjualan.faktur), 
                    0
                ) AS sisa,
                COALESCE(
                    (SELECT SUM(paylater.status_payment) 
                    FROM paylater 
                    WHERE paylater.faktur = penjualan.faktur), 
                    0
                ) AS lunas
            FROM penjualan
            JOIN member 
                ON penjualan.no_meja = member.kd_member
            WHERE penjualan.kd_alatbayar = 214 AND DATE(penjualan.tanggal) = '$tgl_awal'
        ";

        $result = mysqli_query($koneksi, $sql);
        $no = 1;

        while ($row = mysqli_fetch_assoc($result)) {

        ?>
            <tr align="left">
                <td><?php echo $no++; ?></td>
                <td><?php echo date('Y-m-d', strtotime($row['tanggal'])); ?></td>
                <td><b><?php echo $row['faktur']; ?></b></td>
                <td><b><?php echo $row['nama']; ?></b></td>
                <td colspan="5"></td>
                <td><?php echo $row['jumlah']; ?></td>
            </tr>
            <?php $sq2323l =  "SELECT t.faktur, t.tanggal_payment,t.insert_oleh,t.reff, jt.nama as nama_metode, a.deskripsi as nama_account,t.faktur,t.jumlah_payment
                                                        FROM paylater t
                                                        JOIN jenis_transaksi jt ON jt.kd_jenis = t.metode_payment
                                                        JOIN account a ON a.no_account = t.akun
                                                        WHERE t.faktur = '$row[faktur]'";

            $resultasd = mysqli_query($koneksi, $sq2323l);
            while ($row123 = mysqli_fetch_assoc($resultasd)) { ?>
                <tr align="left">
                    <td colspan="4"></td>
                    <td><?php echo $row123['tanggal_payment']; ?></td>
                    <td><?php echo $row123['insert_oleh']; ?></td>
                    <td><?php echo $row123['reff']; ?></td>
                    <td><?php echo $row123['nama_metode']; ?></td>
                    <td><?php echo $row123['nama_account']; ?></td>
                    <td>-<?php echo $row123['jumlah_payment']; ?></td>
                </tr>
        <?php
            }
        }
        ?>
    </tbody>
</table> -->


<script>
    $(function() {

        $('#example8').DataTable({
            lengthMenu: [
                [50, 500, 1000, -1],
                [50, 500, 1000, 'All'],
            ],
            "paging": true,
            "lengthChange": true,
            "searching": true,
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
</script>

<br><br>