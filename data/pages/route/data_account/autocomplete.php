<?php
$dir = '../../../../';
session_start();

include $dir . 'config/koneksi.php';
include $dir . 'config/library.php';

$judulform = "Daftar Account";

$data = "data_account";
$rute = "account";
$aksi = "aksi_account";

$tabel = "account";
$f1 = 'no_account';
$f2 = 'deskripsi';
$f3 = 'kasbank';
$f4 = 'pph';
$f5 = 'penampung';
$f6 = 'filter';
$f7 = 'kd_jenis';

$j1 = "No Account";
$j2 = "Deskripsi";
$j3 = "KasBank";
$j4 = "Pph";
$j5 = "Penampung";
$j6 = "Filter";
$j7 = 'Pembayaran';

include
       '../header.php';
?>
<table class="table-responsive">
       <form method="post" enctype="multipart/form-data" action="<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=input">

              <div class="form-group">
                     <label><?php echo $j1; ?></label>
                     <input type="text" name="<?php echo $f1; ?>" class="form-control" placeholder="Masukan <?php echo $j1; ?> ..." maxlength="8" required="required" />
              </div>

              <div class="form-group">
                     <label><?php echo $j2; ?></label>
                     <input type="text" name="<?php echo $f2; ?>" class="form-control" placeholder="Masukan <?php echo $j2; ?> ..." required="required" />
              </div>
              <!-- <div class="form-group">
                     <label><?php echo $j3; ?></label>
                     <input type="text" name="<?php echo $f3; ?>" class="form-control" placeholder="Masukan <?php echo $j3; ?> ..." maxlength="1" required="required" />
              </div>
              <div class="form-group">
                     <label><?php echo $j4; ?></label>
                     <input type="text" name="<?php echo $f4; ?>" class="form-control" placeholder="Masukan <?php echo $j4; ?> ..." maxlength="1" required="required" />
              </div>
              <div class="form-group">
                     <label><?php echo $j5; ?></label>
                     <input type="text" name="<?php echo $f5; ?>" class="form-control" placeholder="Masukan <?php echo $j5; ?> ..." maxlength="1" required="required" />
              </div>
              <div class="form-group">
                     <label><?php echo $j6; ?></label>
                     <input type="text" name="<?php echo $f6; ?>" class="form-control" placeholder="Masukan <?php echo $j6; ?> ..." maxlength="1" required="required" />
              </div> -->
              <div class="form-group">
                     <label><?php echo $j7; ?></label>
                     <select name="<?php echo $f7; ?>" class="form-control" style="width:200px;height: 40px;">
                            <?php

                            $produk = mysqli_query($koneksi, "SELECT * from jenis_transaksi order by kd_jenis asc");
                            while ($pro = mysqli_fetch_array($produk)) {
                                   echo "<option value='$pro[kd_jenis]'>$pro[kd_jenis] - $pro[nama]</option>";
                            }
                            ?>
                     </select>
              </div>
              <div class="form-group">
                     <hr />
                     <input type="submit" class="btn btn-primary elevation-2" style="opacity:.7" value="Simpan" />
              </div>


       </form>
       <a href="../../main.php?route=<?php echo $rute; ?>&act&ide=<?php echo $_SESSION['namauser']; ?>&asal=<?php echo $rute; ?>"><button class="btn btn-primary btn-sm elevation-1" style="opacity:.7">Back</button></a>

</table>

<?php
include '../footer.php';
?>