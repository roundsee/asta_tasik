<?php

$dir = "../../../../";
include $dir . "config/koneksi.php";
include $dir . "config/library.php";

session_start();
$faktur = isset($_GET['nomorfaktur']) ? $_GET['nomorfaktur'] : '';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Cetak Struk</title>
</head>

<body style='font-family:tahoma; font-size:9pt;' onload="printOut()">

    <?php

    $query = mysqli_query($koneksi, "SELECT pesan1,perusahaan,telp,web,alamat FROM setup  ");
    $stp = mysqli_fetch_array($query);

    $f1 = $stp['pesan1'];
    $j1 = $stp['perusahaan'];
    $j2 = $stp['alamat'];
    $j4 = $stp['telp'];
    $j5 = $stp['web'];

    $querypenjualan = mysqli_query($koneksi, "SELECT oleh,no_meja,tanggal,dibayar,jumlah,tarif_pb1,byr_pocer,byr_non_tunai,ongkir,voucher_nilai_diskon,
                                                COALESCE(
                                                    (SELECT member.nama
                                                    FROM member 
                                                    WHERE penjualan.no_meja = member.kd_member LIMIT 1), 
                                                    '-'
                                                ) AS namamember,
                                            dibayar,kd_alatbayar,subalat_bayar.nama as nama_sub_alat_bayar, jam FROM penjualan 
                                            JOIN subalat_bayar ON subalat_bayar.kdsub_alat = penjualan.kdsub_alatbayar WHERE faktur='$faktur' ");
    $stppenjualan = mysqli_fetch_array($querypenjualan);

    $tanggal = $stppenjualan['tanggal'];
    $oleh = $stppenjualan['oleh'];
    $tarif_pb1 = $stppenjualan['tarif_pb1'];
    $byr_pocer = $stppenjualan['byr_pocer'];
    $byr_non_tunai = $stppenjualan['byr_non_tunai'];
    $dibayar = $stppenjualan['dibayar'];
    $kd_alatbayar =  $stppenjualan['kd_alatbayar'];
    $nama_sub_alat_bayar =  $stppenjualan['nama_sub_alat_bayar'];
    $pesan_jam = $stppenjualan['jam'];
    $ongkos_kirim = $stppenjualan['ongkir'];
    $voucher_nilai_diskon = $stppenjualan['voucher_nilai_diskon'];


    $nama_member = $stppenjualan['namamember'];
    ?>

    <table>
        <tr>
            <center>
                <img src="../../../../images/logo1.png" height="60px" style="vertical-align:middle;">
                <?php
                echo '<br>' . $j1;
                echo '<br>' . $j2;
                echo '<br>' . $j4;
                echo '<br>';
                echo '<br>';

                ?>
            </center>
        </tr>
        <tr style="text-align:left;font-size:9pt;">
            <td style="width:55pt">No Invoice
                <br>Tanggal
                <br>Kasir
                <br>Member
                <!-- <br>Jenis -->
            </td>
            <td>:<br>:<br>:<br>:</td>
            <td><?php echo $faktur; ?>
                <br><?php echo $tanggal; ?>
                <br><?php echo $oleh; ?>
                <br><span style="font-weight: bold; font-size: 12px;"><?php echo $nama_member; ?></span>
                <!-- <br><span style="font-weight: bold; font-size: 12px;"><?php echo $nama_transaksi; ?></span> -->
            </td>
        </tr>
    </table>
    <hr>


    <table>
        <tbody>
            <?php
            $no = 1;

            $total_diskon = 0;
            $tot_sel_harga = 0;
            $grand_disc = 0;

            $tot_sel_diskon = 0;
            $querysql1 = mysqli_query($koneksi, "SELECT jualdetil.banyak,jualdetil.jumlah,
            jualdetil.diskon,jualdetil.harga,jualdetil.penyajian,barang.nama,jualdetil.satuan,jualdetil.qty_satuan
             FROM jualdetil JOIN barang on barang.kd_brg=jualdetil.kd_brg
            WHERE faktur='$faktur'");
            while ($s1 = mysqli_fetch_array($querysql1)) {

                $t_jumlah = $s1['banyak'];
                $t_total = $s1['jumlah']; // ini udh harga di kali quantity dan satuan dan dikurangi diskon
                $t_diskon = $s1['diskon'];
                $t_harga = $s1['harga'];
                $t_ket = $s1['penyajian'];
                $t_nama = $s1['nama'];
                $t_satuan = $s1['satuan'];
                $t_satuan_qty = $s1['qty_satuan'];

                $t_total_diskon = $s1['diskon'];
                $total_diskon = $total_diskon + $t_diskon;
                $tot_harga = $t_total;
                $tot_sel_harga = $tot_sel_harga + $tot_harga;
                // $tot_sel_harga = $tot_sel_harga + $t_total;
                $tot_sel_diskon = $tot_sel_diskon + $t_total_diskon;

            ?>

                <tr style="font-size:9pt;">
                    <td style="width:6pt;"><?php echo $no++; ?>.</td>
                    <td style="width:150pt; text-align:left;"><?php echo $t_nama; ?></td>
                    <td style="width:30pt; text-align:right;"><?php echo '(' . $t_jumlah . ')'; ?></td>
                    <td style="width:30pt; text-align:right;"><?php echo $t_satuan; ?></td>
                    <td style="width:50pt; text-align:right;"><?php echo '(' . number_format($t_harga, 0, ',', '.') . ')'; ?></td>
                    <td style="width:10pt; text-align:center;">:</td>
                    <td style="width:50pt; text-align:right;"><?php echo number_format($t_total + $t_diskon, 0, ',', '.'); ?></td>
                </tr>

                <?php if ($t_diskon > 0) {
                    $sub_tot_disc = $t_diskon;
                    $grand_disc = $grand_disc + $sub_tot_disc;
                ?>
                    <tr style="font-size:9pt;">
                        <td style="text-align:left;" colspan="6">- Diskon ( <?php echo $t_ket; ?> )</td>
                        <td style="text-align:right;">-<?php echo number_format($sub_tot_disc); ?></td>
                    </tr>
                <?php } ?>


            <?php

            }

            // $sub_total = $tot_sel_harga - $grand_disc;
            $sub_total = $tot_sel_harga;
            $pb1 = round(($tarif_pb1 / 100) * $sub_total);

            $total_stlh_pajak = ($sub_total) + ($pb1);

            $total_bayar = $byr_pocer + $byr_non_tunai + $dibayar;
            $kembalian = $total_bayar - $total_stlh_pajak;

            if ($total_stlh_pajak <= $byr_pocer) {
                $kembalian = 0;
            }

            ?>
            <tr>
                <td colspan="7">
                    <hr>
                </td>
            </tr>

        </tbody>

        <tfoot>
            <tr style="text-align:right;font-size:9pt">
                <td colspan="6" style="text-align:right;font-size:9pt">Sub Total :
                    <!-- <br>Tax 10% :
        <br>Total : -->
                </td>
                <td style="font-weight:bold;"><?php echo number_format($sub_total)
                                                    // "<br>".number_format($pb1).
                                                    // "<br>".number_format($total_stlh_pajak)
                                                ; ?>
                </td>

            </tr>
            <!-- <tr style="text-align:right;font-size:9pt">
                <td colspan="6" style="text-align:right;font-size:9pt">Sub Total :
                </td>
                <td style="font-weight:bold;"><?php echo number_format($sub_total); ?>
                </td>

            </tr>
            <tr style="text-align:left;font-size:9pt">
                <td colspan="6" style="text-align:right;font-size:9pt">Total Diskon :
                </td>
                <td style="font-weight:bold;text-align:right;"><?php echo number_format($tot_sel_diskon); ?>
                </td>
            </tr> -->
            <tr style="text-align:right;font-size:9pt">
                <td colspan="6" style="text-align:right;font-size:9pt">Ongkir :
                    <!-- <br>Tax 10% :
        <br>Total : -->
                </td>
                <td style="font-weight:bold;"><?php echo number_format($ongkos_kirim)
                                                    // "<br>".number_format($pb1).
                                                    // "<br>".number_format($total_stlh_pajak)
                                                ; ?>
                </td>

            </tr>
            <tr style="text-align:right;font-size:9pt">
                <td colspan="6" style="text-align:right;font-size:9pt">Voucher :
                    <!-- <br>Tax 10% :
        <br>Total : -->
                </td>
                <td style="font-weight:bold;"><?php echo number_format($voucher_nilai_diskon + $byr_pocer)
                                                    // "<br>".number_format($pb1).
                                                    // "<br>".number_format($total_stlh_pajak)
                                                ; ?>
                </td>

            </tr>
            <tr style="text-align:right;font-size:9pt">
                <td colspan="6" style="text-align:right;font-size:9pt">Total :
                    <!-- <br>Tax 10% :
        <br>Total : -->
                </td>
                <td style="font-weight:bold;"><?php echo number_format($sub_total + $ongkos_kirim - $voucher_nilai_diskon - $byr_pocer)
                                                    // "<br>".number_format($pb1).
                                                    // "<br>".number_format($total_stlh_pajak)
                                                ; ?>
                </td>

            </tr>
            <!-- <tr style="text-align:right;font-size:9pt">
                <td colspan="6">Voucher :
                    <br>non Tunai :
                    <?php if ($kd_alatbayar != 100) { ?>
                        <br>(<i><?php echo $nama_sub_alat_bayar; ?></i>)&emsp;
                    <?php } ?>
                    <br>Tunai :
                    <br>
                    <br>Kembali :
                </td>

                <td><span style="font-weight: bold;"><?php echo number_format($byr_pocer); ?></span>
                    <br><span style="font-weight: bold;"><?php echo number_format($byr_non_tunai); ?></span>
                    <?php if ($kd_alatbayar != 100) { ?>
                        <br>
                    <?php }; ?>
                    <br><span style="font-weight: bold;"><?php echo number_format($dibayar); ?></span>
                    <br>
                    <br><span style="font-weight: bold;"><?php echo number_format($kembalian); ?></span>
                </td>
            </tr> -->
            <tr style="text-align:right;font-size:9pt">
                <td colspan="6"> <!-- Voucher :-->
                    <br>non Tunai :
                    <?php if ($kd_alatbayar != 100) { ?>
                        <br>(<i><?php echo $nama_sub_alat_bayar; ?></i>)&emsp;
                    <?php } ?>
                    <br>Tunai :
                    <br>
                    <br>Kembali :
                </td>

                <td><!--<span style="font-weight: bold;"><?php echo number_format($byr_pocer); ?></span>-->
                    <br><span style="font-weight: bold;"><?php echo number_format($byr_non_tunai); ?></span>
                    <?php if ($kd_alatbayar != 100) { ?>
                        <br>
                    <?php }; ?>
                    <br><span style="font-weight: bold;"><?php echo number_format($dibayar); ?></span>
                    <br>
                    <br><span style="font-weight: bold;"><?php echo number_format($kembalian - $ongkos_kirim + $voucher_nilai_diskon); ?></span>
                </td>
            </tr>


        </tfoot>
    </table>
    </div>

    <script>
        var lama = 100;
        t = null;

        function printOut() {
            window.print();
            t = setTimeout("history.back();", lama);
        }
    </script>

</body>

</html>