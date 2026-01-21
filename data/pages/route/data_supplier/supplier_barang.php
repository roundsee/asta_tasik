<?php

$judulform = 'Supplier Barang';

$data = 'data_supplier';
$aksi = 'aksi_supplier';
$rute = 'supplier';

$rute_detail = 'supplier_barang';


$tabel = "supplier";
$f1 = 'kd_supp';
$f2 = 'nama';
$f3 = 'alamat';
$f4 = 'telp';
$f5 = 'id_sales';
$f6 = 'area';
$f7 = 'term';
$f8 = 'kd_kota';
$f9 = 'kd_area';
$f10 = 'kd_dispenda';
$f11 = 'id_kat';
$f12 = 'hari_pengiriman';
$f13 = 'term_of_payment';

$j1 = 'Kode Supplier';
$j2 = 'Nama Supplier';
$j3 = 'Alamat';
$j4 = 'Telepon';
$j5 = 'ID Sales';
$j6 = 'Area';
$j7 = 'Durasi Kirim';
$j8 = 'Kode Kota';
$j9 = 'Kode Area';
$j10 = 'Dispenda';
$j11 = 'Kode Kategori';
$j12 = 'Hari Pengiriman';
$j13 = 'Term Of payment';


$tabel_detail = 'supplier_barang';
$ff1 = 'kd_brg';
$ff2 = 'kd_supp';
$ff3 = 'durasi_kirim';
$ff4 = 'minimum_order';


$jj1 = 'Kode Barang';
$jj2 = 'Kode Supplier';
$jj3 = 'Durasi Kirim';
$jj4 = 'Minimum Order';



if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
    echo "<link href='style.css' rel='stylesheet' type='text/css'>
	<center>Untuk mengakses modul, Anda harus login <br>";
    echo "<a href=../../index.php><b>LOGIN</b></a></center>";
} else {

    switch ($_GET['act']) {
        default:

            $id = $_GET['id'];

            $query = mysqli_query($koneksi, "SELECT $tabel.* , area.nama as nama_area from $tabel JOIN area ON area.kode = $tabel.kd_area where $f1='$_GET[id]'");
            $q1 = mysqli_fetch_array($query);



            $dir = '../../';
?>
            <div class="content-wrapper" style="height:70%">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="list-gds wow slideInUp" data-wow-duration=".5s" data-wow-delay=".1s">
                                    <b><?php echo $judulform; ?></b> <small></small>
                                </h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="main.php?route=home">Beranda</a></li>
                                    <li class="breadcrumb-item active"><a href="main.php?route=<?php echo $rute; ?>&act"><?php echo $judulform; ?></a></li>
                                    <li class="breadcrumb-item active"> detail</li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>

                <!-- Main content -->
                <section class="content" style="height:90%">
                    <div class="container-fluid table-responsive" style="height:100%">
                        <div class="card card-default">
                            <!-- /.card-header -->
                            <div class="card-body" style="height:70%">
                                <div class="row">
                                    <!-- right column -->
                                    <div class="col-lg-12">
                                        <!-- general form elements disabled -->
                                        <div class="box box-warning">
                                            <div class="box-body">


                                                <div class="row">
                                                    <div class="col-lg-7" style="background-color:ghostwhite;">
                                                        <form id="" method="post" action="route/<?php echo $data; ?>/<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=edit&id=<?php echo $_GET['id']; ?>">

                                                            <!-- <form method="POST" action="route/<?php echo $data; ?>/<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=edit&id=<?php echo $q1['$f1']; ?>" enctype="multipart/form-data"> -->

                                                            <div class="row">

                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label><?php echo $j1; ?></label>
                                                                        <input type="text" name="<?php echo $f1; ?>" class="form-control" value="<?php echo $id; ?>" readonly />
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label><?php echo $j2; ?></label>
                                                                        <input type="text" name="<?php echo $f2; ?>" class="form-control" value="<?php echo $q1[$f2]; ?>" readonly />
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label><?php echo $j3; ?></label>
                                                                        <textarea name="<?php echo $f3; ?>" class="form-control" value="" id=""><?php echo $q1[$f3]; ?></textarea>
                                                                        <!-- <input type="text" name="<?php echo $f3; ?>" class="form-control" value="<?php echo $q1[$f3]; ?>"  /> -->
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label><?php echo $j4; ?></label>
                                                                        <input type="text" name="<?php echo $f4; ?>" class="form-control" value="<?php echo $q1[$f4]; ?>" />
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label><?php echo $j5; ?></label>
                                                                        <select name="<?php echo $f5; ?>" class="form-control">
                                                                            <?php
                                                                            $query = mysqli_query($koneksi, "SELECT id_sales, nama FROM sales"); // Asumsikan tabel 'sales' memiliki kolom 'id' dan 'name'
                                                                            while ($row = mysqli_fetch_assoc($query)) {
                                                                                echo '<option value="' . $row['id_sales'] . '" ' . ($row['id_sales'] == $q1[$f5] ? 'selected' : '') . '>' . $row['id_sales'] . ' - ' . $row['nama'] . '</option>';
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>


                                                                <!-- <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label><?php echo $j6; ?></label>
                                                                        <input type="text" name="<?php echo $f6; ?>" class="form-control" value="<?php echo $q1[$f6]; ?>" readonly />
                                                                    </div>
                                                                </div> -->
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label><?php echo $j7; ?></label>
                                                                        <input type="text" name="<?php echo $f7; ?>" class="form-control" value="<?php echo $q1[$f7]; ?>" />
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label><?php echo $j8; ?></label>
                                                                        <select name="<?php echo $f8; ?>" class="form-control">
                                                                            <?php
                                                                            $query = mysqli_query($koneksi, "SELECT * FROM kotabaru"); // Asumsikan tabel 'sales' memiliki kolom 'id' dan 'name'
                                                                            while ($row = mysqli_fetch_assoc($query)) {
                                                                                echo '<option value="' . $row['kode'] . '" ' . ($row['kode'] == $q1[$f5] ? 'selected' : '') . '>' . $row['kode'] . ' - ' . $row['nama'] . '</option>';
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label for=""><?php echo $j9; ?></label>
                                                                        <select name="<?php echo $f9 ?>" id="" class="form-control">
                                                                            <?php
                                                                            $query = mysqli_query($koneksi, "SELECT * FROM area");
                                                                            while ($row = mysqli_fetch_array($query)) {
                                                                                echo '<option value="' . $row['kode'] . '" ' . ($row['kode'] == $q1[$f5] ? 'selected' : '') . '>' . $row['kode'] . ' - ' . $row['nama'] . '</option>';
                                                                            }


                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>



                                                                <!-- <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label><?php echo $j8; ?></label>
                                                                        <input type="text" name="<?php echo $f8; ?>" class="form-control" value="<?php echo $q1[$f8]; ?>" readonly />
                                                                    </div>
                                                                </div> -->


                                                                <!-- <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label><?php echo $j9; ?></label>
                                                                        <input type="text" name="<?php echo $f9; ?>" class="form-control" value="<?php echo $q1[$f9] . ' - ' . $q1['nama_area']; ?>" readonly />
                                                                    </div>
                                                                </div> -->

                                                                <!-- <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label><?php echo $j10; ?></label>
                                                                        <input type="text" name="<?php echo $f10; ?>" class="form-control" value="<?php echo $q1[$f10]; ?>" readonly />
                                                                    </div>
                                                                </div> -->

                                                                <!-- <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label><?php echo $j11; ?></label>
                                                                        <input type="text" name="<?php echo $f11; ?>" class="form-control" value="<?php echo $q1[$f11]; ?>" readonly />
                                                                    </div>
                                                                </div> -->


                                                            </div> <!-- row -->
                                                    </div> <!-- col-lg-7 -->

                                                    <div class="col-lg-5" style="background-color:ghostwhite;">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label><?php echo $j12; ?></label>
                                                                <select name="<?php echo $f12; ?>" class="form-control">
                                                                    <?php
                                                                    // Buat array hari
                                                                    $hari_pengiriman = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

                                                                    // Ambil nilai dari database sebagai default value
                                                                    $nilai_terpilih = $q1[$f12]; // Nilai dari database yang harus menjadi default

                                                                    // Tampilkan opsi dropdown
                                                                    foreach ($hari_pengiriman as $hari) {
                                                                        // Cek apakah hari ini sama dengan nilai dari database, jika ya, tambahkan attribute 'selected'
                                                                        $selected = ($hari == $nilai_terpilih) ? 'selected' : '';
                                                                        echo "<option value='$hari' $selected>$hari</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label><?php echo $j13; ?></label>
                                                                <input type="text" name="<?php echo $f13; ?>" class="form-control" value="<?php echo $q1[$f13]; ?>" />
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <button type="submit" class="btn btn-primary elevation-2" style="opacity: .7">Simpan Perubahan</button>
                                                    </form>
                                                </div>

                                                <hr>

                                                <table id="example1" width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-bordered table-striped">
                                                    <thead style="background-color: #ddd;">
                                                        <tr style="font-weight:600">
                                                            <td align="center" width="40px">No</td>
                                                            <td align="center" width="120px"><?php echo $jj1; ?></td>
                                                            <td align="center" width="240px">Nama Barang</td>
                                                            <td align="center" width="240px"><?php echo $jj3; ?></td>
                                                            <td align="center" width="240px"><?php echo $jj4; ?></td>
                                                            <td align="center" style="min-width:60px;width: 80px;">Aksi</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $no = 1;
                                                        $subtotal = 0;
                                                        $stotal = 0;
                                                        $sql1 = mysqli_query($koneksi, "SELECT sd.* , barang.nama AS nama_barang from $tabel_detail sd
                                                        LEFT JOIN barang on barang.kd_brg = sd.kd_brg
									                            					JOIN supplier s ON s.kd_supp=sd.kd_supp
                                                        where sd.kd_supp='$_GET[id]'");

                                                        while ($s1 = mysqli_fetch_array($sql1)) {
                                                            // $subtotal = $s1[$ff3] * $s1[$ff4];
                                                            // $stotal = $stotal + $subtotal;

                                                        ?>
                                                            <tr>
                                                                <td align="center"><?php echo $no; ?></td>
                                                                <td align="center"><?php echo $s1[$ff1]; ?></td>
                                                                <td align="center"><?php echo $s1['nama_barang']; ?></td>
                                                                <td align="center"><?php echo $s1[$ff3]; ?></td>
                                                                <td align="center"><?php echo $s1[$ff4]; ?></td>

                                                                <td align="center">
                                                                    <?php
                                                                    if (1 == 1) { ?>

                                                                        <a href="main.php?route=<?php echo $rute_detail; ?>&act=edit-detail&id=<?php echo $s1[$ff1]; ?>&id2=<?php echo $s1[$ff2]; ?>" title="edit"><button class="btn btn-xs btn-primary elevation-1" style="opacity: .7"><i class="fa fa-edit"></i></button></a>

                                                                        <!-- <a href="main.php?route=<?php echo $rute_detail; ?>&act=nego-detail&id=<?php echo $s1[$ff1]; ?>&idp=<?php echo $s1[$ff3]; ?>" title="nego"><button class="btn btn-xs btn-primary elevation-1" style="opacity: .7" ><i class="fa fa-plus"></i></button></a> -->

                                                                        <a href="route/<?php echo $data; ?>/<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=hapus-detail&id=<?php echo $s1[$ff1]; ?>&id2=<?php echo $s1[$ff2]; ?>" title="Hapus Data Ini" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA PENTING INI ... ?')"><button class="btn btn-xs btn-danger elevation-1" style="opacity: .7"><i class="fa fa-trash"></i></button></a>

                                                                    <?php } ?>

                                                                </td>
                                                            </tr>

                                                        <?php
                                                            $no++;
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>

                                                <!-- tambah keterngan utk Proses .....-->
                                                <?php
                                                // if ($q1['submit'] <= 1) { 
                                                ?>

                                                <form id="inputDetailForm" method="post" action="route/<?php echo $data; ?>/<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=input-detail&id=<?php echo $_GET['id']; ?>">
                                                    <div id="formControls">
                                                        <button id="addFormButton" type="button" class="btn btn-primary btn-sm elevation-2" style="opacity: .7;">
                                                            <i class="fa fa-plus"></i> Tambah
                                                        </button>
                                                    </div>
                                                    <div id="newFormContainer"></div>
                                                    <div id="formFooter" style="display:none;">
                                                        <br>
                                                        <button type="submit" class="btn btn-success btn-xs pull-right elevation-1" style="opacity: .7">Save</button>
                                                    </div>
                                                </form>
                                                <div style="margin:10px"></div>
                                                <br><br>

                                                <script>
                                                    document.getElementById('addFormButton').addEventListener('click', function() {
                                                        var formFooter = document.getElementById('formFooter');
                                                        var newFormContainer = document.getElementById('newFormContainer');

                                                        var newFormFieldsHtml = `
            <div class="row">
                ${newFormContainer.children.length === 0 ? `
                <div class="col-12">
                    <div class="form-group">
                        <h5>Data Detail</h5>
                    </div>
                </div>` : ''
                }
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="">Barang</label>
                        <select name="kd_acc2[]" class="form-control select2" style="width:100%;" required>
                            <option></option>
                            <?php
                            $produk = mysqli_query($koneksi, "SELECT * FROM barang WHERE kd_subgrup is null ");
                            while ($pro = mysqli_fetch_array($produk)) {
                                echo "<option value='{$pro['kd_brg']}'
																									data-harga='{$pro['hrg_pcs']}'
																									data-pcs='{$pro['Pcs']}'
																									data-renteng='{$pro['Renteng']}'
																									data-pak='{$pro['Pak']}'
																									data-ikat='{$pro['ikat']}'
																									data-ball='{$pro['Ball']}'
																									data-box='{$pro['Box']}'
																									data-dus='{$pro['Dus']}'>
																									{$pro['kd_brg']} - {$pro['nama']}
																					</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <label>Kode Barang</label>
                        <input type="text" class="form-control kode_account" name="kd_acc[]" placeholder="Autofill by Account" readonly>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" class="form-control nama_account" name="uraian[]" placeholder="Autofill by Account" readonly>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="form-group">
                        <label>Durasi Kirim</label>
                        <input type="text" class="form-control durasi_kirim" name="durasi_kirim[]" placeholder="Masukkan Durasi Kirim" >
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="form-group">
                        <label>Minimum Order</label>
                        <input type="text" class="form-control minimum_order" name="minimum_order[]" placeholder="Masukkan Minimum Order">
                    </div>
                </div>
             
                <div class="col-lg-1 d-flex align-items-center">
                    <button type="button" class="btn btn-danger btn-sm remove-form">Hapus</button>
                </div>
            </div>
            <hr>
        `;

                                                        var newFormElement = document.createElement('div');
                                                        newFormElement.innerHTML = newFormFieldsHtml;
                                                        newFormContainer.appendChild(newFormElement);

                                                        if (!formFooter.classList.contains('initialized')) {
                                                            formFooter.style.display = 'block';
                                                            formFooter.classList.add('initialized');
                                                        }

                                                        $(newFormElement).find('.select2').select2({
                                                            theme: 'bootstrap4'
                                                        });

                                                        $(newFormElement).find('select[name="kd_acc2[]"]').on('change', function() {
                                                            var selectedOption = $(this).find('option:selected');
                                                            var kdBrg = selectedOption.val().trim();
                                                            var namaBrg = selectedOption.text().split(' - ')[1].trim();

                                                            $(this).closest('.row').find('.kode_account').val(kdBrg);
                                                            $(this).closest('.row').find('.nama_account').val(namaBrg);
                                                        });

                                                        $(newFormElement).find('.remove-form').on('click', function() {
                                                            $(this).closest('.row').remove();
                                                            if (newFormContainer.children.length === 0) {
                                                                formFooter.style.display = 'none';
                                                            }
                                                        });
                                                    });

                                                    $('#newFormContainer').on('change', '.satuan-select', function() {
                                                        updateTotalPcs($(this).closest('.row'));
                                                    });

                                                    $('#newFormContainer').on('input', '.jumlah-input', function() {
                                                        updateHasilPerkalian($(this).closest('.row'));
                                                    });

                                                    function updateTotalPcs(row) {
                                                        var satuan = row.find('.satuan-select').val();
                                                        console.log(satuan);
                                                        var totalPcs = row.find('select[name="kd_acc2[]"]').find('option:selected').data(satuan);
                                                        console.log(totalPcs);

                                                        row.find('.total_pcs').val(totalPcs + ' Pcs');
                                                        updateHasilPerkalian(row);
                                                    }

                                                    function updateHasilPerkalian(row) {
                                                        var totalPcs = parseFloat(row.find('.total_pcs').val()) || 0;
                                                        var jumlah = parseFloat(row.find('.jumlah-input').val()) || 0;
                                                        var hasilPerkalian = totalPcs * jumlah;
                                                        row.find('.hasil_perkalian').val(hasilPerkalian + ' Pcs');
                                                    }

                                                    $(function() {
                                                        $('.select2').select2({
                                                            theme: 'bootstrap4'
                                                        });
                                                    });
                                                </script>


                                                <!-- <a href="route/<?php echo $data; ?>/<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=proses-sph&id=<?php echo $_GET['id']; ?>"><button class="btn btn-success btn-xs pull-right  elevation-1" style="opacity: .7">Submit ...</button></a>
													<div style="margin:10px"></div>												
													<br><br> -->
                                                <?php

                                                ?>



                                                <!-- end tambah keterngan utk Proses .....-->
                                                <div class="row">
                                                    <div class="col-lg-6">

                                                        <button class="btn btn-primary btn-sm elevation-2 " style="opacity: .7;" onclick="window.location='main.php?route=<?php echo $rute; ?>&id=<?php echo $id; ?>&act='"> Back</button>

                                                    </div>
                                                    <div class="col-lg-6" style="text-align:right">


                                                    </div>
                                                </div>

                                            </div>
                                            <hr>


                                        </div><!-- /.box-body -->
                                        <!-- </div>  -->
                                        <!-- /.box -->

                                    </div><!--/.col (right) -->
                                </div> <!-- /.row -->
                            </div>

                </section><!-- /.content -->
            </div>
        <?php
            break;

        //Form Edit detail 
        case "edit-detail":

            // echo '<br>'.$_GET['id'];
            // echo '<br>'.$_GET['idp'];
            // echo '<br>'.$_GET['idb'];

            $edit = mysqli_query($koneksi, "SELECT * from $tabel where $f1='$_GET[id]'");
            $e = mysqli_fetch_array($edit);

            $sql = mysqli_query($koneksi, "SELECT * from $tabel_detail 
						where $ff1='$_GET[id]' AND $ff2='$_GET[id2]'  ");
            $s1 = mysqli_fetch_array($sql);

        ?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper" style="background-color: ghostwhite;">
                <!-- Content Header (Page header) -->
                <section class="content-header ">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <div style="margin:10px;"></div>
                                <h1 class="list-gds animated tdFadeInDown">
                                    <b><?php echo $judulform; ?></b> <small> Detail edit</small>
                                </h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="main.php?route=home">Beranda</a></li>

                                    <li class="breadcrumb-item active"><a href="main.php?route=<?php echo $rute; ?>&act"><?php echo $judulform; ?></a></li>
                                    <li class="breadcrumb-item active">edit detail</li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>

                <!-- Main content -->
                <section class="content wow fadeInUp" data-wow-duration=".2s" data-wow-delay=".1s">
                    <div class="container-fluid">
                        <div class="card card-default">
                            <!-- /.card-header -->
                            <div class="card-body animated tdFadeIn">
                                <div class="row">
                                    <!-- right column -->
                                    <div class="col-md-12">
                                        <!-- general form elements disabled -->
                                        <div class="box box-warning">
                                            <div class="box-body">

                                                <form method="POST" action="route/<?php echo $data; ?>/<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=edit-detail&id=<?php echo $s1[$ff1]; ?>&id2=<?php echo $s1[$ff2]; ?>" enctype="multipart/form-data">

                                                    <section class="base">
                                                        <div class="row">
                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <label><?php echo $jj1; ?></label>
                                                                    <input type="text" name="<?php echo $ff1; ?>" class="form-control" value="<?php echo $s1[$ff1]; ?>" readonly />
                                                                </div>

                                                            </div>


                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <label><?php echo $jj2; ?></label>
                                                                    <input type="text" name="<?php echo $ff2; ?>" class="form-control" value="<?php echo $s1[$ff2]; ?>" readonly />
                                                                </div>

                                                            </div>


                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <label><?php echo $jj3; ?></label>
                                                                    <input type="text" name="<?php echo $ff3; ?>" class="form-control" value="<?php echo $s1[$ff3]; ?>" />
                                                                </div>

                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <label><?php echo $jj4; ?></label>
                                                                    <input type="text" name="<?php echo $ff4; ?>" class="form-control" value="<?php echo $s1[$ff4]; ?>" autofocus="" />
                                                                </div>
                                                            </div>


                                                        </div>

                                                        <hr />

                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-primary elevation-2" style="opacity: .7">Simpan Perubahan</button>
                                                        </div>

                                                    </section>
                                                </form>
                                                <a href="main.php?route=<?php echo $rute_detail; ?>&act&id=<?php echo $s1[$f1]; ?>&asal=<?php echo $rute; ?>"><button class="btn btn-primary btn-sm elevation-1" style="opacity: .7">Back</button></a>

                                            </div><!-- /.box-body -->
                                        </div><!-- /.box -->
                                    </div><!--/.col (right) -->
                                </div> <!-- /.row -->
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->

            <style>
                .file {
                    visibility: hidden;
                    position: absolute;
                }
            </style>
<?php
            break;
    }
}
?>