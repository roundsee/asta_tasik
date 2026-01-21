
<!-- Modal -->
<div class="modal fade" id="searchMenu" tabindex="-1" role="dialog" aria-labelledby="cariMenuLabel" aria-hidden="true">
  <div class="modal-dialog modal-default" role="document" >
    <div class="modal-content">
      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        Searching Menu
      </div>
      <div class="modal-body" >
        <scirpt>
        </scirpt>

        <?php 
        

        // $tgl=date("Y-m-d");
        $tgl=date("2022-04-16");
        $kd_aplikasi='11';

// $kd_aplikasi=$_POST['kd_aplikasi'];
// $_SESSION['kd_aplikasi']=$kd_aplikasi;
// $kd_aplikasi=$_SESSION['kd_aplikasi'];
echo $kd_aplikasi;
// print_r($_SESSION);
        echo $kd_kota=$_SESSION['kd_kota'];
        echo $kd_cus=$_SESSION['kd_cus'];
        
        // $kd_kota='MDN';
        // $kd_cus='2105';

        ?>

        <div class="table-responsive"  style="height:500px">
          <table class="table table-bordered table-striped table-hover" id="table-datatable2">
            <thead>
              <tr>
                <th class="text-center">NO</th>
                <th>KODE</th>
                <th>PRODUK</th>
                <th class="text-center">HARGA</th>
                <th class="text-center">DISKON</th>
                <th>AKSI</th>
              </tr>
            </thead>
            <tbody style="height: 300px;">
              <!-- <tr>
                <td><?php echo $kd_aplikasi;?></td>
                <td><?php echo $kd_kota;?></td>
                <td><?php echo $kd_cus;?></td>
                <td><?php echo $tgl;?></td>
              </tr> -->
              <?php 
              $disc1=0;
              $no=0;
              

              $data = mysqli_query($koneksi,"SELECT bk.kd_brg,bk.kd_kota,bk.harga,bk.kd_aplikasi,b.nama,b.kd_subgrup,b.kd_grup,b.photo FROM barang_kota as bk RIGHT JOIN barang as b ON bk.kd_brg=b.kd_brg WHERE 
                bk.kd_kota='$kd_kota'  AND 
                bk.kd_aplikasi='$kd_aplikasi' AND 
                b.nama!='' 
                ORDER BY bk.kd_brg ");

              while($d = mysqli_fetch_array($data)){

                $data1=mysqli_query($koneksi,"SELECT * FROM tarif_diskon
                  WHERE
                  tgl_awal<= '$tgl' AND
                  tgl_akhir>= '$tgl' AND
                  kd_jenis = '$kd_aplikasi' AND
                  (cakupan = 'Nasional' OR kd_kota = '$kd_kota' OR kd_cus = '$kd_cus' ) AND
                  (kd_brg = 'Semua' OR kd_brg = '$d[kd_brg]' ) 
                  ORDER BY diskon ");

                $d1 = mysqli_fetch_array($data1);

                if ($d1==null){
                  $disc=0;
                }else{
                  $disc=$d1['diskon'];
                }

                ?>
                <tr>
                  <td width="1%" class="text-center"><?php echo $no++; ?></td>
                  <td width="1%"><?php echo $d['kd_brg']; ?></td>
                  <td><?php echo $d['nama']; ?></td>
                  <td width="20%" class="text-right"><?php echo number_format($d['harga']); ?></td>
                  <td width="10%" class="text-right"><?php echo number_format($disc); ?></td>
                  <td>      
                    <input type="hidden" id="kode_<?php echo $d['kd_brg']; ?>" value="<?php echo $d['kd_brg']; ?>">
                    <input type="hidden" id="nama_<?php echo $d['kd_brg']; ?>" value="<?php echo $d['nama']; ?>">
                    <input type="hidden" id="harga_<?php echo $d['kd_brg']; ?>" value="<?php echo $d['harga']; ?>">
                    <input type="hidden" id="diskon_<?php echo $d['kd_brg']; ?>" value="<?php echo $disc; ?>">
                    <button type="button" class="btn btn-warning btn-sm modal-pilih-produk" id="<?php echo $d['kd_brg']; ?>" data-dismiss="modal">Pilih</button>
                  </td>
                </tr>
                <?php 
              }

              ?>

            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>
</div>
<script>
          $(document).ready(function(){
            location.reload();
          }

            </script>