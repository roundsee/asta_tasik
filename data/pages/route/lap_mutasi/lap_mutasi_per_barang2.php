<?php
$login_hash = $_SESSION['login_hash'];
$en = $_SESSION['employee_number'];
$to = $_SESSION['to'];

$judulform = "Mutasi Per Barang";

$data = 'lap_mutasi';
$rute = 'list_mutasi';
$aksi = 'aksi_list_mutasi';


$tabel = 'mutasi_semua';
$f1 = 'tgl';
$f2 = 'regional';
$f3 = 'kd_unit';
$f4 = 'nama_outlet';
$f5 = 'kd_sage';
$f6 = 'nama_barang';
$f7 = 'satuan';
$f8 = 'qty_awal';
$f9 = 'nilai_awal';
$f10 = 'qty_beli';
$f11 = 'nilai_beli';
$f12 = 'qt_produksi';
$f13 = 'nilai_produksi';
$f14 = 'qt_terima_int';
$f15 = 'nilai_terima_int';
$f16 = 'qt_tersedia';
$f17 = 'nilai_tersedia';
$f18 = 'harga_rata';
$f19 = 'qt_kirim_int';
$f20 = 'nilai_kirim_int';
$f21 = 'qt_pake';
$f22 = 'nilai_pake';
$f23 = 'qt_jual';
$f24 = 'nilai_jual';
$f25 = 'hpp_jual';
$f26 = 'qt_akhir';
$f27 = 'nilai_akhir';


$j1 = 'Tanggal';
$j2 = 'Regional';
$j3 = 'Kd Cus';
$j4 = 'Nama Outlet';
$j5 = 'Kd Sage';
$j6 = 'Nama Barang';
$j7 = 'Satuan';
$j8 = 'Qty Awal';
$j9 = 'Nilai Awal';
$j10 = 'Qty Beli';
$j11 = 'Nilai Beli';
$j12 = 'Qty Produksi';
$j13 = 'Nilai Produksi';
$j14 = 'Qty Terima Int';
$j15 = 'Nilai Terima Int';
$j16 = 'Qty Tersedia';
$j17 = 'Nilai Tersedia';
$j18 = 'Harga Rata';
$j19 = 'Qty Kirim Int';
$j20 = 'Nilai Kirim Int';
$j21 = 'Qty Pakai';
$j22 = 'Nilai Pakai';
$j23 = 'Qty Jual';
$j24 = 'Nilai Jual';
$j25 = 'Hpp Jual';
$j26 = 'Qty Akhir';
$j27 = 'Nilai Akhir';

//session_start();
if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
  <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
} else {

  switch ($_GET['act']) {
    //Tampil Data 
    default:
?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper" style="background-color: ghostwhite;">
        <!-- Content Header (Page header) -->
        <section class="content-header  wow fadeInDown" data-wow-duration=".3s" data-wow-delay=".3s">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="list-gds">
                  <b><?php echo $judulform; ?></b> <small style="font-weight: 100;">report</small>
                </h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="main.php?route=home">Beranda</a></li>
                  <li class="breadcrumb-item active">Laporan</li>
                  <li class="breadcrumb-item active"><?php echo $judulform; ?></li>
                </ol>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <!-- <section class="content wow fadeInUp" data-wow-duration=".2s" data-wow-delay=".1s" > -->
        <section class="content wow ">
          <div class="card card-default">
            <!-- /.card-header -->
            <div class="card-body">
              <!-- Main row -->
              <div class="row">
                <!-- Left col -->
                <section class="col-lg-12 connectedSortable">
                  <!-- Custom tabs (Charts with tabs)-->
                  <div class="box">
                    <div class="box-body">

                      <!-- Wrapper 1 -->
                      <div class="wrapper" style="min-height:30%">
                        <form role="form" action="route/<?php echo $data; ?>/<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=report-per-barang2" method="post">
                          <div class="row">
                            <!-- Batas -------------- -->


                            <div class="col-lg-2">

                              <div class="form-group">
                                <label>Tanggal Awal</label>
                                <input type="date" class="form-control" name="tgl_awal" onclick="displayHasil(this.value)" placeholder="Masukkan Tanggal Awal .. (Wajib)" value="<?php echo date('Y-m-d') ?>" style="width: 300px;" required="required">
                              </div>

                              <div class="form-group">
                                <label>Tanggal Akhir</label>
                                <input type="date" class="form-control" name="tgl_akhir" onclick="displayHasil(this.value)" placeholder="Masukkan Tanggal Akhir .. (Wajib)" value="<?php echo date('Y-m-d') ?>" style="width: 300px;" required="required">
                              </div>
                            </div>
                            <div class="col-lg-12"></div>

                            <div class="col-lg-3">

                              <div class="form-group" style="display: flex; align-items: center;">
                                <label for="lokasi" style="margin-right: 17px; margin-bottom: 0;font-size: 18px;"> Lokasi :</label>
                                <select id="lokasi" name="lokasi" class="select2" style="width: 300px;" required>
                                  <option value="">-- Pilih Lokasi --</option>
                                  <option value="1316" <?php echo ($login_hash == 22) ? 'selected' : ''; ?>>Swalayan</option>
                                  <option value="8001" <?php echo ($login_hash == 21) ? 'selected' : ''; ?>>Gudang</option>
                                </select>
                              </div>
                              <div class="form-group" style="display: flex; align-items: center;">
                                <label for="barang" style="margin-right: 12px; margin-bottom: 0;font-size: 18px;">Barang :</label>
                                <select id="barang" name="barang" class="select2" style="width: 300px;" required>
                                  <option value="">-- Cari Barang --</option>
                                  <?php
                                  $sql = "SELECT kd_brg, nama FROM barang WHERE kd_subgrup is null";
                                  $result = $koneksi->query($sql);
                                  if ($result && $result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                      echo '<option value="' . htmlspecialchars($row['kd_brg']) . '">' . htmlspecialchars($row['kd_brg']) . ' - ' . htmlspecialchars($row['nama']) . '</option>';
                                    }
                                  } else {
                                    echo '<option disabled>No items found</option>';
                                  }
                                  ?>
                                </select>
                              </div>
                            </div>
                            <div class="col-lg-12"></div>

                            <!-- Generate -->
                            <div class="col-lg-3">

                              <div class="row">
                                <div class="col-lg-12">
                                  <input type="hidden" name="kota" id="tampil_kota_id">
                                  <input type="hidden" name="outlet" id="tampil_outlet_id">
                                  <input type="hidden" name="area" id="tampil_area_id">
                                  <input type="hidden" name="divisi" id="tampil_divisi_id">
                                  <input type="hidden" name="unitkerja" id="tampil_unitkerja_id">

                                  <div class="form-group">
                                    <input type="submit" class="btn btn-primary elevation-2" style="opacity: .7" value="Generate Report" />
                                  </div>

                                </div>
                              </div>
                            </div>
                            <!-- Generate -->

                          </div>
                        </form>
                      </div>
                      <!-- end Wrapper 1 -->

                      <hr />

                      <!-- <input style="width: 100px;"  value="RESET" onclick="window.location='main.php?route=pb1&act';" class="btn btn-sm btn-danger "> -->

                      <!-- Wraper 3 -->
                      <div class="wrapper" style="min-height:10">
                        <div class="row">
                          <div class="col-lg-7">
                            <div class="form-group">
                              <a href="main.php?route=home" title="Batal"> <button class="btn btn-danger btn-sm elevation-2" style="opacity: .7;width:80px"><i class="fa fa-edit"></i> Batal</button></a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- end Wraper 3 -->

                    </div><!-- /.box-body -->
                  </div><!-- /.box -->
                </section><!-- /.Left col -->
              </div><!-- /.row (main row) -->
            </div>
          </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->


      <?php
      include 'wibjs.php';
      ?>

      <script type="text/javascript">
        <?php
        if (isset($_GET['alert'])) {
          if ($_GET['alert'] == "gagal") {
            echo "<div class='alert alert-danger'>File yang diperbolehkan hanya file gambar!</div>";
          } elseif ($_GET['alert'] == "duplikat") {
            echo "<div class='alert alert-danger'><b>Kode Barang</b> sudah pernah digunakan!</div>";
          }
        }
        ?>
      </script>

      <?php
      break;
      ?>
      <script>
        $(document).ready(function() {
          $('#example').DataTable({
            lengthMenu: [
              [50, 100, 500, -1],
              [50, 100, 500, 'All'],
            ],

          });
        });
      </script>


      <script>
        function isi_otomatis() {
          var <?php echo $f1; ?> = $("#<?php echo $f1; ?>").val();
          $.ajax({
            url: 'ajax.php',
            data: "<?php echo $f1; ?>=" + <?php echo $f1; ?>,
          }).success(function(data) {
            var json = data,
              obj = JSON.parse(json);
            $('#<?php echo $f2; ?>').val(obj.<?php echo $f2; ?>);

          });
        }
      </script>

<?php
      break;
  }
}
?>