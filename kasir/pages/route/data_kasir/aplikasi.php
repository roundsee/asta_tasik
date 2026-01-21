<?php 
$dir = "../../";
include $dir."../../config/koneksi.php";
include $dir."../../config/fungsi_rupiah.php";
?>
<div class="wrapper box-poly-up" style="padding:25px;height:fit-content ;max-height:800px ; " id="showAplikasi">
  <div class="row">
    
    <div class="row"  style="padding-right: 10px;">
      <?php

      $data = mysqli_query($koneksi,"SELECT * FROM jenis_transaksi ORDER BY kd_jenis ");

      while($d = mysqli_fetch_array($data)){
        ?>

        <div class="filtr-item col-sm-3" data-sort="white sample" style="padding-left: 15px;padding-right: 1px;padding-top: 5px;" >    
          <div class="menupilihan_aplikasi">
            <input type="hidden" id="aplikasi_kode_<?php echo $d['kd_jenis']; ?>" value="<?php echo $d['kd_jenis']; ?>">
            <input type="hidden" id="aplikasi_nama_<?php echo $d['kd_jenis']; ?>" value="<?php echo $d['nama']; ?>">
            <input type="hidden" id="aplikasi_photo_<?php echo $d['kd_jenis']; ?>" value="<?php echo $d['photo']; ?>">
            <input type="hidden" id="aplikasi_ket_<?php echo $d['kd_jenis']; ?>" value="">

            <a class="pilih-aplikasi" id="<?php echo $d['kd_jenis']; ?>" data-dismiss="modal"><img src="<?php echo $dir;?>images/jenis_transaksi/<?php echo $d['photo'];?>" class="img-fluid mb-2" alt="white sample"  style="width: 80px;" id="tombol-tambahkan1"/>
              <div class="menunama_aplikasi " style="font-weight: 300;">
                <?php echo $d['nama'];?>
              </div>
              <?php
              ?>

            </a>
          </div>
        </div>
        <?php 

      }
      ?>
    </div>

      <!-- </div>
      <button type="button" class="btn-lg pull-right" onclick="close_aplikasi()"> Aplikasi close</button>
    </div> -->