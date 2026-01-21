<?php

$judulform = "Data Barang";

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color: ghostwhite;">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="list-gds">
            <b><?php echo $judulform; ?></b> <small style="font-weight: 100;">import</small>
          </h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="main.php?route=home">Beranda</a></li>
            <li class="breadcrumb-item active">Data</li>
            <li class="breadcrumb-item active"><?php echo $judulform; ?></li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <div class="container">
    <h1>Excel Upload</h1>
    <form id="uploadForm" action="route/import_barang/import.php" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label>Upload Excel File</label>
        <input type="file" id="fileInput" name="file" accept=".xls,.xlsx" class="form-control">
      </div>
      <div class="form-group">
        <button type="submit" name="submit" class="btn btn-success">Upload</button>
      </div>
    </form>
    <a href="Book22.xlsx" download="mydata.xlsx">
      <button class="btn btn-primary">Download Format Excel</button>
    </a>
    <script>

    </script>
  </div>
</div>