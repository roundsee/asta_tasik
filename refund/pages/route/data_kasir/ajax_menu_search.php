
<?php 

session_start();
$dir='../../';
include_once '../../../../config/koneksi.php'; 
include '../../../../config/fungsi_rupiah.php';

// $tgl=date("Y-m-d");
// $tgl=date("2022-04-16");
$tgl=date('Y-m-d');

// $kd_aplikasi=$_POST['kd_aplikasi'];
// $_SESSION['kd_aplikasi']=$kd_aplikasi;
$kd_aplikasi=$_SESSION['kd_aplikasi'];
$kd_kota=$_SESSION['kd_kota'];
$kd_cus=$_SESSION['kd_cus'];

// print_r($_SESSION);

?>

<input type="hidden" name="kd_aplikasi" value="<?php echo $kd_aplikasi;?>">
<!-- <div class="filter-container p-0 row" style="height:186px!important;"> -->

  <?php
  $keyword="";
  if (isset($_POST['search'])) {
    $keyword = $_POST['search'];
  }

  if(empty($_POST["kd_aplikasi"]))
  { 
    ?>
    <div id="show_search">
      <br>
      <!-- <table class="table-responsive example1"  style="height:286px"> -->
        <div class="wrapper bg-white box-poly-up" style="padding: 5px 25px 5px 20px;min-height: 280px!important ;">
          <div class="row table-container">
            <div  style="height:340px;background-color: beige;width: 630px;">
              <table class="table table-bordered table-striped " style="height:340px;">
                <thead>
                  <th width="30px" >No.</th>
                  <th width="130px">Nama Produk</th>
                  <th width="60px">Jml</th>
                  <th width="60px" style="text-align: right;"  >Harga</th>
                  <th width="100px" style="text-align: right;" >Total Harga</th>
                  <th width="60px" style="text-align: right;" >Diskon</th>
                  <th width="90px" style="text-align: right;" >Total Diskon</th>

                </thead>
                <tbody>
                  <?php

                  $data =  mysqli_query($koneksi,"SELECT *,
                    p.faktur as p_faktur,
                    p.tarif_pb1 as p_tarif_pb1,
                    jd.kd_brg as kd_kd_brg,
                    jd.banyak as jd_banyak,
                    jd.harga as jd_harga,
                    jd.diskon as jd_diskon,
                    jd.jumlah as jd_jumlah, 
                    b.nama as b_nama 
                    FROM penjualan p
                    JOIN jualdetil jd ON jd.faktur=p.faktur 
                    JOIN barang b ON b.kd_brg=jd.kd_brg
                    WHERE p.faktur LIKE '%".$keyword."%' ");

                  $no=1;
                  $tot_item=0;
                  $tot_jumlah=0;
                  $tot_diskon=0;
                  $pb1=0;
                  $tot_penjualan=0;
                  $tarif_pb1=0;

                  while($d = mysqli_fetch_array($data)){
                    $tot_item=$tot_item+$d['jd_banyak'];
                    $tot_jumlah=$tot_jumlah+$d['jd_banyak']*$d['jd_harga'];
                    $tot_diskon=$tot_diskon+$d['jd_banyak']*$d['jd_diskon'];

                  $tarif_pb1=$d['p_tarif_pb1'];
                    ?>
                    <tr style="height:20px;">
                      <td><?php echo $no;?></td>
                      <td><?php echo $d['b_nama'];?></td>
                      <td align="center"><?php echo $d['jd_banyak'];?></td>
                      <td align="right"><?php echo format_rupiah($d['jd_harga']);?></td>
                      <td align="right"><?php echo format_rupiah($d['jd_banyak']*$d['jd_harga']);?></td>
                      <td align="right"><?php echo format_rupiah($d['jd_diskon']);?></td>
                      <td align="right"><?php echo format_rupiah($d['jd_banyak']*$d['jd_diskon']);?></td>

                    </tr>
                    <?php 
                    $no++;
                  } ?>
                </tbody>
              </table>
            </div>
          </div>
          <br>

          <?php

          $tot_penjualan=$tot_jumlah-ceil($tot_diskon);
          
          $pb1=$tot_penjualan*($tarif_pb1/100);
          $tot_sel=ceil($tot_penjualan+$pb1);

          ?>
          <div class="col-lg-7 box-poly pull-right"  style="padding:14 10 5 14">
            <table class="table table-striped" style="padding-bottom: 1px;padding-bottom: 1px;" >

              <tr>
                <td>Jumlah Item</td>
                <td align="right"><?php echo $tot_item;?></td>
              </tr>

              <tr>
                <td>Sub Total</td>
                <td align="right"><?php echo format_rupiah($tot_jumlah);?></td>
              </tr>
              <tr>
                <td>Total Diskon</td>
                <td align="right"><?php echo format_rupiah($tot_diskon);?></td></td>
              </tr>

              <tr>
                <td>PB1</td>
                <td align="right"><?php echo format_rupiah($pb1);?></td>
              </tr>

              <tr style="font-size:120%;font-weight: 900;color: black;">
                <td>Total</td>
                <td align="right"><?php echo format_rupiah($tot_sel);?></td>
              </tr>
            </table>


          </div>
        </div>

        <!-- </div> -->
        <?php


      }else{ 
        // echo '<option value="">Grup not available</option>'; 
      } 
      ?>

      <input type="hidden" name="kd_promo" value="<?php echo $kd_promo;?>">
