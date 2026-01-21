<?php 
$dir = "../../";
include $dir."../../config/koneksi.php";
include $dir."../../config/fungsi_rupiah.php";
?>
<div class="wrapper" style="padding-right:10;height:300px;max-height:300px;" id="showAlatbayar">
  <!-- <div class="row"> -->
    <div class="row"  style="padding-right: 10px;">
      <?php

      $data = mysqli_query($koneksi,"SELECT kd_alat,nama,photo,kd_aplikasi FROM alat_bayar WHERE kd_alat!='100' ORDER BY kd_alat ");

      while($d = mysqli_fetch_array($data)){
        ?>

        <div class="filtr-item col-sm-4" data-sort="white sample" style="padding-left: 15px;padding-right: 1px;padding-top: 5px;" >    
          <div class="menupilihan_alatbayar">
            <input type="hidden" id="alatbayar_kode_<?php echo $d['kd_alat']; ?>" value="<?php echo $d['kd_alat']; ?>">
            <input type="hidden" id="alatbayar_nama_<?php echo $d['kd_alat']; ?>" value="<?php echo $d['nama']; ?>">
            <input type="hidden" id="alatbayar_kdaplikasi_<?php echo $d['kd_aplikasi']; ?>" value="">

            <a class="pilih-alatbayar" id="<?php echo $d['kd_alat']; ?>" data-dismiss="modal"><img src="<?php echo $dir;?>images/alat_bayar/<?php echo $d['photo'];?>" class="img-fluid mb-2" alt="white sample"  style="width: 80px;border-radius: 10px;" id="tombol-tambahkan1" />
              <div class="menunama_alatbayar ">
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

  <!-- </div> -->
</div>

<button type="button" class="btn-sm tombol1" onclick="clear_alatbayar()" style="font-weight:600"> Clear non Tunai</button>

<!-- <div class="form-group">
<button type="button" class="btn-sm" onclick="clear_alatbayar()"> Clear non Tunai</button>
</div> -->
