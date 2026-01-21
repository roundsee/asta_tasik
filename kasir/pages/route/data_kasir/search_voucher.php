
<!-- Modal -->
<div class="modal fade" id="searchVoucher" tabindex="-1" role="dialog" aria-labelledby="cariMenuLabel" aria-hidden="true">
  <div class="modal-dialog modal-default" role="document" >
    <div class="modal-content">
      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        Searching Voucher
      </div>
      <div class="modal-body" >
        <?php 
        $tgl1=date("Y-m-d");
        $tgl=date("2022-06-16");

        // $kd_aplikasi=$_POST['kd_aplikasi'];
        // $kd_kota=$_SESSION['kd_kota'];
        // $kd_cus=$_SESSION['kd_cus'];
// $kd_kota='MLG';
        $kd_cus='2401';
// echo $kd_kota;
// echo $kd_cus;

        ?>

        <div class="table-responsive"  style="height:500px">
          <table class="table table-bordered table-striped table-hover" id="table-datatable2">
            <thead>
              <tr>
                <th class="text-center">NO</th>
                <th>No Seri</th>
                <th>Nilai</th>
                <th class="text-center">Harga</th>
                <th class="text-center">Terbit</th>
                <th class="text-center">Daluarsa</th>
                <th>AKSI</th>
              </tr>
            </thead>
            <tbody style="height: 300px;">
              <?php 
              $disc1=0;
              $no=1;

              $data=mysqli_query($koneksi,"SELECT id_pocer,no_pocer,nilai,harga_jual,tgl_terbit,tgl_daluarsa FROM pocer WHERE tgl_terbit<= '$tgl' AND tgl_daluarsa>= '$tgl' 
              ORDER BY no_pocer ");

              
              while($d = mysqli_fetch_array($data)){
                
                ?>

                <tr>
                  <td width="1%" class="text-center"><?php echo $no++; ?></td>
                  <td width="1%"><?php echo $d['no_pocer']; ?></td>
                  <td width="20%" class="text-center"><?php echo number_format($d['nilai']); ?></td>
                  <td width="20%" class="text-center"><?php echo number_format($d['harga_jual']); ?></td>
                  <td><?php echo $d['tgl_terbit']; ?></td>
                  <td><?php echo $d['tgl_daluarsa']; ?></td>
                  <td>      
                    <input type="hidden" id="kode_<?php echo $d['no_pocer']; ?>" value="<?php echo $d['no_pocer']; ?>">
                    <input type="hidden" id="noseri_<?php echo $d['no_pocer']; ?>" value="<?php echo $d['no_pocer']; ?>">
                    <input type="hidden" id="nilai_<?php echo $d['no_pocer']; ?>" value="<?php echo $d['nilai']; ?>">
                    <input type="hidden" id="harga_<?php echo $d['no_pocer']; ?>" value="<?php echo $d['harga_jual']; ?>">
                    <input type="hidden" id="terbit_<?php echo $d['no_pocer']; ?>" value="<?php echo $d['tgl_terbit']; ?>">
                    <input type="hidden" id="daluarsa_<?php echo $d['no_pocer']; ?>" value="<?php echo $d['tgl_daluarsa']; ?>">
                    <button type="button" class="btn btn-success btn-sm modal-pilih-voucher" id="<?php echo $d['no_pocer']; ?>" data-dismiss="modal">Pilih</button>
                  </td>
                  <?php 

                } //end While
                ?>
              </tr>

            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>
</div>