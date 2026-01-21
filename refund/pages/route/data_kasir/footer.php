<?php
$dir='../../';

?>

<footer class="footer bg_primary_1" style="padding: 0 10 0 20;">
  <div class="pull-right hidden-xs">
    <b>Version</b> 1.0
  </div>
  <strong>Copyright &copy; <?php echo date('Y'); ?> <?php echo $perusahaan;?></strong> - System. 
</footer>

<!-- </div> -->

<script src="<?php echo $dir;?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo $dir;?>assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="<?php echo $dir;?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo $dir;?>assets/bower_components/raphael/raphael.min.js"></script>
<!-- <script src="<?php echo $dir;?>assets/bower_components/morris.js/morris.min.js"></script> -->
<script src="<?php echo $dir;?>assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<script src="<?php echo $dir;?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo $dir;?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo $dir;?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo $dir;?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="<?php echo $dir;?>assets/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<script src="<?php echo $dir;?>assets/bower_components/moment/min/moment.min.js"></script>
<script src="<?php echo $dir;?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="<?php echo $dir;?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo $dir;?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="<?php echo $dir;?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo $dir;?>assets/bower_components/fastclick/lib/fastclick.js"></script>
<script src="<?php echo $dir;?>assets/dist/js/adminlte.min.js"></script>
<!-- <script src="<?php echo $dir;?>assets/dist/js/pages/dashboard.js"></script> -->
<script src="<?php echo $dir;?>assets/dist/js/demo.js"></script>
<script src="<?php echo $dir;?>assets/bower_components/ckeditor/ckeditor.js"></script>
<script src="<?php echo $dir;?>assets/bower_components/chart.js/Chart.min.js"></script>
<script src="../../plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
<script src="../../plugins/filterizr/jquery.filterizr.min.js"></script>

<!-- Page specific script -->

<script>

  $(document).ready(function() {
    $("#tombol-update").hide();
    $("#kalkulator").hide();
    $("#form_voucher").hide();
    // $("#tombolBuatTransaksi").show();

    function formatNumber(num) {
      return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    }

    // pilih produk
    $(document).on("click", ".modal-pilih-produk", function() {

      var id = $(this).attr('id');
      var kode = $("#kode_" + id).val();
      var nama = $("#nama_" + id).val();
      var harga = $("#harga_" + id).val();
      var diskon = $("#diskon_" + id).val();

      var ket = $("#ket_" + id).val();
      var kd_promo = $("#kd_promo_" + id).val();

      var tax = $(".total_tax").val();
      // console.log(tax);

      $("#tambahkan_id").val(id);
      $("#tambahkan_kode").val(kode);
      $("#tambahkan_nama").val(nama);
      $("#tambahkan_harga").val(harga);
      $("#tambahkan_jumlah").val(1);
      $("#tambahkan_total").val(harga);
      $("#tambahkan_diskon").val(diskon);
      $("#tambahkan_total_diskon").val(diskon);
      $("#tambahkan_ket").val(ket);
      // $("#tambahkan_kd_promo").val(kd_promo);

      var id = $("#tambahkan_id").val();
      var kode = $("#tambahkan_kode").val();
      var nama = $("#tambahkan_nama").val();
      var harga = $("#tambahkan_harga").val();
      var jumlah = $("#tambahkan_jumlah").val();
      var total = $("#tambahkan_total").val();
      var diskon = $("#tambahkan_diskon").val();
      var total_diskon = $("#tambahkan_total_diskon").val();
      var ket = $("#tambahkan_ket").val();

      // var kd_promo = $("#tambahkan_kd_promo").val();


    //   if (id.length == 0) {
    //     alert("Produk belum dipilih");
    // } else if (kode.length == 0) {
    //     alert("Kode produk harus diisi");
    // } else if (jumlah == 0) {
    //     alert("Jumlah harus lebih besar dari 0");
    // } else {
      var table_pembelian = "<tr id='tr_" + id + "'>" +
      "<td align='center'> <span class='btn btn-sm btn-warning tombol-edit-penjualan' jumlah='" + jumlah + "' harga='" + harga + "' total='" + total + "' diskon='" + diskon + "' total_diskon='" + total_diskon + "' id='" + id + "'><i class='fa fa-wrench'></i></span> <span class='btn btn-sm btn-danger tombol-hapus-penjualan' jumlah='" + jumlah + "' harga='" + harga + "' total='" + total + "' diskon='" + diskon + "' total_diskon='" + total_diskon + "' ket='" + ket +"' kd_promo='" + kd_promo +"'id='" + id + "'><i class='fa fa-close'></i></span></td>" +
      "<td> <input type='hidden' class='transaksi_produk' name='transaksi_produk[]' value='" + id + "'> <input type='hidden' class='transaksi_jumlah' name='transaksi_jumlah[]' value='" + jumlah + "'> <input type='hidden' class='transaksi_harga' name='transaksi_harga[]' value='" + harga + "'> <input type='hidden' class='transaksi_total' name='transaksi_total[]' value='" + total + "'> <input type='hidden' class='transaksi_diskon' name='transaksi_diskon[]' value='" + diskon + "'> <input type='hidden' class='transaksi_total_diskon' name='transaksi_total_diskon[]' value='" + total_diskon + "'> <input type='hidden' class='transaksi_ket' name='transaksi_ket[]' value='" + ket + "'> <input type='hidden' class='transaksi_kd_promo' name='transaksi_kd_promo[]' value='" + kd_promo + "'> <span class='transaksi_kode'>" +

      "<span class='transaksi_nama' style='line-height:1.1em'>" + nama + "</span></td>" +
      "<td align='center'>" + formatNumber(jumlah) + "</td>" +
      "<td align='right'>" + formatNumber(harga) + "</td>" +
      "<td align='right'>" + formatNumber(total) + "</td>" +
      "<td align='right'>" + formatNumber(diskon) + "</td>" +
      "<td align='right'>" + formatNumber(total_diskon) + "</td>" +
      "<td align='right'><span class='transaksi_ket' style='line-height:1.1em'>" + ket + "</span></td>" +
      "<td align='right'><span class='transaksi_kd_promo' style='line-height:1.1em'>" + kd_promo + "</span></td>"+
      "</tr>";
      $("#table-pembelian tbody").append(table_pembelian);

            // update total pembelian
            var pembelian_jumlah = $(".pembelian_jumlah").attr("id");
            var pembelian_harga = $(".pembelian_harga").attr("id");
            var pembelian_total = $(".pembelian_total").attr("id");
            var pembelian_diskon = $(".pembelian_diskon").attr("id");
            var pembelian_total_diskon = $(".pembelian_total_diskon").attr("id");
            var pembelian_ket = $(".pembelian_ket").attr("id");
            var pembelian_kd_promo = $(".pembelian_kd_promo").attr("id");

            // jumlahkan pembelian
            var jumlahkan_jumlah = eval(pembelian_jumlah) + eval(jumlah);
            var jumlahkan_harga = eval(pembelian_harga) + eval(harga);
            var jumlahkan_total = eval(pembelian_total) + eval(total);

            var jumlahkan_diskon = eval(pembelian_diskon) + eval(diskon);
            var jumlahkan_total_diskon = eval(pembelian_total_diskon) + eval(total_diskon);
            var jumlahkan_ket = eval(pembelian_ket) + eval(ket);
            var jumlahkan_kd_promo = eval(pembelian_kd_promo) + eval(ket);

            // isi di table penjualan
            $(".pembelian_jumlah").attr("id", jumlahkan_jumlah);
            $(".pembelian_harga").attr("id", jumlahkan_harga);
            $(".pembelian_total").attr("id", jumlahkan_total);
            $(".pembelian_diskon").attr("id", jumlahkan_diskon);
            $(".pembelian_total_diskon").attr("id", jumlahkan_total_diskon);
            $(".pembelian_ket").attr("id", jumlahkan_ket);
            $(".pembelian_kd_promo").attr("id", jumlahkan_kd_promo);

            // tulis di table penjualan
            $(".pembelian_jumlah").text(formatNumber(jumlahkan_jumlah));
            // $(".pembelian_harga").text(formatNumber(jumlahkan_harga) + ",-");
            $(".pembelian_total").text("Rp." + formatNumber(jumlahkan_total));
            // $(".pembelian_diskon").text(formatNumber(jumlahkan_diskon) + ",-");
            $(".pembelian_total_diskon").text("Rp." + formatNumber(jumlahkan_total_diskon.toFixed(0)));

            // total
            $(".jumlah_total_pembelian").text(formatNumber(jumlahkan_jumlah));
            $(".sub_total_pembelian").text("Rp." + formatNumber(jumlahkan_total) + ",-");

            var subjumlah = Math.ceil(jumlahkan_total-jumlahkan_total_diskon) ;
            var g_total = Math.ceil(((jumlahkan_total-jumlahkan_total_diskon)+(jumlahkan_total-jumlahkan_total_diskon)*tax/100)) ;
            $(".total_pembelian").text("Rp." + formatNumber(g_total.toFixed(0)) + ",-");

            $(".total_pembelian").attr("id",g_total);
            $(".sub_total_pembelian").attr("id",jumlahkan_total);

            $(".total_form").val(g_total);
            $(".sub_total_form").val(jumlahkan_total);

            // total_diskon
            $(".total_diskon_pembelian").text("Rp." + formatNumber(jumlahkan_total_diskon.toFixed(0)) + ",-");
            $(".sub_total_diskon_pembelian").text("Rp." + formatNumber(jumlahkan_total_diskon.toFixed(0)) + ",-");
            $(".total_diskon_pembelian").attr("id",jumlahkan_total_diskon);
            $(".sub_total_diskon_pembelian").attr("id",jumlahkan_total_diskon);

            $(".total_diskon_form").val(jumlahkan_total_diskon);
            $(".sub_total_diskon_form").val(jumlahkan_total_diskon);
            $(".subjumlah_form").val(subjumlah);

            // kosongkan
            $("#tambahkan_id").val("");
            $("#tambahkan_kode").val("");
            $("#tambahkan_nama").val("");
            $("#tambahkan_jumlah").val("");
            $("#tambahkan_harga").val("");
            $("#tambahkan_total").val("");
            $("#tambahkan_diskon").val("");
            $("#tambahkan_total_diskon").val("");
            $("#tambahkan_ket").val("");
            $("#tambahkan_kd_promo").val("");


            // update Tax
            var tax = $(".total_tax").val();
            if(tax.length != 0 && tax != ""){

              var sub_total = $(".sub_total_pembelian").attr("id");

              var total_diskon = $(".sub_total_diskon_pembelian").attr("id");

              var hasil_tax = Math.ceil((sub_total-total_diskon)*(tax/100));

              $(".hasil_tax").text("Rp."+formatNumber(hasil_tax.toFixed(0))+",-");
              $(".hasil_tax_form").val(hasil_tax.toFixed(0));
            }else{
              var sub_total_pembelian = $(".sub_total_pembelian").attr("id");
              
              $(".total_pembelian").attr("id",sub_total_pembelian);
              $(".total_pembelian").text("Rp."+formatNumber(sub_total_pembelian)+",-");
            }

            // $("#country").hide();
            // $('#country').attr('disabled','disabled');
            $('#tombolAplikasi').attr('disabled','disabled');
            $('#tombolBuatTransaksi').attr('disabled','disabled');
            // $('#tombolPayment').show();
            $('#tombolPayment').removeAttr('disabled');
            paymenttotalkembali()
            

      //  $("#tombol-tambahkan").hide();
      // $("#tombol-update").show();

    });

    // ubah jumlah
    $(document).on("change keyup", "#tambahkan_jumlah", function() {

      var jumlah = $("#tambahkan_jumlah").val();
      var harga = $("#tambahkan_harga").val();
      var total = harga * jumlah;
      $("#tambahkan_total").val(total);
      var diskon = $("#tambahkan_diskon").val();
      var total_diskon = diskon * jumlah;
      $("#tambahkan_total_diskon").val(total_diskon);
    });

    // ubah jumlah
    $("body").on("keyup", "#tambahkan_kode", function() {
      var kode = $(this).val();
      var data = "kode=" + kode;
      $.ajax({
        type: "POST",
        url: "penjualan_cari_ajax.php",
        data: data,
        dataType: 'JSON',
        success: function(html) {
          $("#tambahkan_id").val(html[0].id);

          $("#tambahkan_nama").val(html[0].nama);
          $("#tambahkan_harga").val(html[0].harga);
          $("#tambahkan_jumlah").val(html[0].jumlah);
          $("#tambahkan_total").val(html[0].harga)

        }

      });
    });


    $(document).on("click", ".tombol-edit-penjualan", function() {
      $("#kalkulator").show(100);
      $("#form_ket").show(100);
      

      var produk = $(this).closest('tr').find('.transaksi_produk').val();
      var kode = $(this).closest('tr').find('.transaksi_kode').text();
      var nama = $(this).closest('tr').find('.transaksi_nama').text();
      var jumlah = $(this).closest('tr').find('.transaksi_jumlah').val();
      var harga = $(this).closest('tr').find('.transaksi_harga').val();
      var total = $(this).closest('tr').find('.transaksi_total').val();

      var diskon = $(this).closest('tr').find('.transaksi_diskon').val();
      var total_diskon = $(this).closest('tr').find('.transaksi_total_diskon').val();
      var ket = $(this).closest('tr').find('.transaksi_ket').text();
      // var kd_promo = $(this).closest('tr').find('.transaksi_kd_promo').text();

      var tax = $(".total_tax").val();

        $("#d").val(""); // kalkulator isi data nya
        $("#ket").val(ket); // edit_ket isi data nya

        $("#tombol-update").attr("produk",produk);

        $("#tambahkan_id").val(produk);

        $("#tambahkan_kode").val(kode);
        $("#tambahkan_nama").val(nama);
        $("#tambahkan_jumlah").val(jumlah);
        $("#tambahkan_harga").val(harga);
        $("#tambahkan_total").val(total);

        $("#tambahkan_diskon").val(diskon);
        $("#tambahkan_total_diskon").val(diskon);
        $("#tambahkan_ket").val(ket);
        // $("#tambahkan_kd_promo").val(kd_promo);

        $("#tombol-tambahkan").hide();
        $("#tombol-update").fadeIn(100);
        $("#tombol-update-cancel").show();

        $("#table-pembelian tr").removeClass('bg-yellow');
        $(this).closest('tr').addClass('bg-yellow');

      });

// tombol update produk
$("body").on("click", "#tombol-update", function() {
  console.log('Masuk tombol-update');

  var id = $("#tambahkan_id").val();
  var kode = $("#tambahkan_kode").val();
  var nama = $("#tambahkan_nama").val();
  var jumlah = $("#tambahkan_jumlah").val();
  var harga = $("#tambahkan_harga").val();
  var total = $("#tambahkan_total").val();
  var diskon = $("#tambahkan_diskon").val();
  var total_diskon = $("#tambahkan_total_diskon").val();
  var ket = $("#tambahkan_ket").val();
  // var kd_promo = $("#tambahkan_kd_promo").val();

  var tax = $(".total_tax").val();

  if (id.length == 0) {
    alert("Produk belum dipilih");
  } else if (kode.length == 0) {
    alert("Kode produk harus diisi");
  } else if (jumlah == 0) {
    alert("Jumlah harus lebih besar dari 0");
  } else {

    var id_produk = $("#tombol-update").attr("produk");

    var id = $(".bg-yellow#tr_"+id_produk+" .tombol-edit-penjualan").attr("id");
    var jumlah =$(".bg-yellow#tr_"+id_produk+" .tombol-edit-penjualan").attr("jumlah");
    var harga =$(".bg-yellow#tr_"+id_produk+" .tombol-edit-penjualan").attr("harga");
    var total =$(".bg-yellow#tr_"+id_produk+" .tombol-edit-penjualan").attr("total");
    var diskon =$(".bg-yellow#tr_"+id_produk+" .tombol-edit-penjualan").attr("diskon");
    var total_diskon =$(".bg-yellow#tr_"+id_produk+" .tombol-edit-penjualan").attr("total_diskon");
    var ket =$(".bg-yellow#tr_"+id_produk+" .tombol-edit-penjualan").attr("ket");
    var kd_promo =$(".bg-yellow#tr_"+id_produk+" .tombol-edit-penjualan").attr("kd_promo");


    // update total pembelian
    var pembelian_jumlah = $(".pembelian_jumlah").attr("id");
    var pembelian_harga = $(".pembelian_harga").attr("id");
    var pembelian_total = $(".pembelian_total").attr("id");

    var pembelian_diskon = $(".pembelian_diskon").attr("id");
    var pembelian_total_diskon = $(".pembelian_total_diskon").attr("id");
    var pembelian_ket = $(".pembelian_ket").attr("id");
    var pembelian_kd_promo = $(".pembelian_kd_promo").attr("id");

    // jumlahkan pembelian
    var kurangi_jumlah = eval(pembelian_jumlah) - eval(jumlah);
    var kurangi_harga = eval(pembelian_harga) - eval(harga);
    var kurangi_total = eval(pembelian_total) - eval(total);

    var kurangi_diskon = eval(pembelian_diskon) - eval(diskon);
    var kurangi_total_diskon = eval(pembelian_total_diskon) - eval(total_diskon);
    var kurangi_ket = eval(pembelian_ket) - eval(ket);
    var kurangi_kd_promo = eval(pembelian_kd_promo) - eval(kd_promo);

    // isi di table penjualan
    $(".pembelian_jumlah").attr("id", kurangi_jumlah);
    $(".pembelian_harga").attr("id", kurangi_harga);
    $(".pembelian_total").attr("id", kurangi_total);
    $(".pembelian_diskon").attr("id", kurangi_diskon);
    $(".pembelian_total_diskon").attr("id", kurangi_total_diskon);
    $(".pembelian_ket").attr("id", kurangi_ket);
    $(".pembelian_kd_promo").attr("id", kurangi_kd_promo);

    // tulis di table penjualan
    $(".pembelian_jumlah").text(formatNumber(kurangi_jumlah));
    // $(".pembelian_harga").text(formatNumber(kurangi_harga) + ",-");
    $(".pembelian_total").text("Rp." + formatNumber(kurangi_total));
    // $(".pembelian_diskon").text(formatNumber(kurangi_diskon) + ",-");
    $(".pembelian_total_diskon").text("Rp." + formatNumber(kurangi_total_diskon.toFixed(0)));

    // total
    $(".jumlah_total_pembelian").text(formatNumber(kurangi_jumlah));
    $(".total_pembelian").text("Rp." + formatNumber(kurangi_total));
    $(".sub_total_pembelian").text("Rp." + formatNumber(kurangi_total) + ",-");
    $(".total_pembelian").attr("id",kurangi_total);
    $(".sub_total_pembelian").attr("id",kurangi_total);

    $(".total_form").val(kurangi_total);
    $(".sub_total_form").val(kurangi_total);

    // total Diskon
    $(".total_diskon_pembelian").text("Rp." + formatNumber(kurangi_total_diskon.toFixed(0)) + ",-");
    $(".sub_total_diskon_pembelian").text("Rp." + formatNumber(kurangi_total_diskon.toFixed(0)) + ",-");
    $(".total_diskon_pembelian").attr("id",kurangi_total_diskon);
    $(".sub_total_diskon_pembelian").attr("id",kurangi_total_diskon);

    $(".total_diskon_form").val(kurangi_total_diskon);
    $(".sub_total_diskon_form").val(kurangi_total_diskon);


        // $("#tr_" + id_produk+".bg-yellow").remove();

    // tambahkan updatean

    var id = $("#tambahkan_id").val();
    var kode = $("#tambahkan_kode").val();
    var nama = $("#tambahkan_nama").val();
    var jumlah = $("#tambahkan_jumlah").val();
    var harga = $("#tambahkan_harga").val();
    var total = $("#tambahkan_total").val();

    var diskon = $("#tambahkan_diskon").val();
    var total_diskon = $("#tambahkan_total_diskon").val();
    var ket = $("#tambahkan_ket").val();
    var kd_promo = $("#tambahkan_kd_promo").val();

    var table_pembelian = "<tr id='tr_" + id_produk + "'>" +
    "<td align='center'> <span class='btn btn-sm btn-warning tombol-edit-penjualan' jumlah='" + jumlah + "' harga='" + harga + "' total='" + total + "' diskon='" + diskon + "' total_diskon='" + total_diskon + "' id='" + id + "'><i class='fa fa-wrench'></i></span> <span class='btn btn-sm btn-danger tombol-hapus-penjualan' jumlah='" + jumlah + "' harga='" + harga + "' total='" + total + "' diskon='" + diskon +"' total_diskon='" + total_diskon +"' ket='" + ket +"' kd_promo='" + kd_promo +"' id='" + id + "'><i class='fa fa-close'></i></span></td>" +
    "<td> <input type='hidden' class='transaksi_produk' name='transaksi_produk[]' value='" + id_produk + "'> <input type='hidden' class='transaksi_jumlah' name='transaksi_jumlah[]' value='" + jumlah + "'> <input type='hidden' class='transaksi_harga' name='transaksi_harga[]' value='" + harga + "'> <input type='hidden' class='transaksi_total' name='transaksi_total[]' value='" + total + "'> <input type='hidden' class='transaksi_diskon' name='transaksi_diskon[]' value='" + diskon + "'> <input type='hidden' class='transaksi_total_diskon' name='transaksi_total_diskon[]' value='" + total_diskon + "'> <input type='hidden' class='transaksi_ket' name='transaksi_ket[]' value='" + ket + "'> <input type='hidden' class='transaksi_kd_promo' name='transaksi_kd_promo[]' value='" + kd_promo + "'><span class='transaksi_kode'>" +

    "<span class='transaksi_nama' style='line-height:1.1em'>" + nama + "</span></td>" +
    "<td align='center'>" + formatNumber(jumlah) + "</td>" +
    "<td align='right'>" + formatNumber(harga) + "</td>" +
    "<td align='right'>" + formatNumber(total) + "</td>" +
    "<td align='right'>" + formatNumber(diskon) + "</td>" +
    "<td align='right'>" + formatNumber(total_diskon) + "</td>" +
    "<td align='center'><span class='transaksi_ket' style='line-height:1.1em'>" + ket +
    "<td align='center'><span class='transaksi_kd_promo' style='line-height:1.1em'>" + kd_promo + "</span></td>" +

    "</tr>";

    $("#tr_" + id_produk+".bg-yellow").replaceWith(table_pembelian);
        // $("#table-pembelian tbody").append(table_pembelian);


    // update total pembelian
    var pembelian_jumlah = $(".pembelian_jumlah").attr("id");
    var pembelian_harga = $(".pembelian_harga").attr("id");
    var pembelian_total = $(".pembelian_total").attr("id");
    var pembelian_diskon = $(".pembelian_diskon").attr("id"); 
    var pembelian_total_diskon = $(".pembelian_total_diskon").attr("id");

    // jumlahkan pembelian
    var jumlahkan_jumlah = eval(pembelian_jumlah) + eval(jumlah);
    var jumlahkan_harga = eval(pembelian_harga) + eval(harga);
    var jumlahkan_total = eval(pembelian_total) + eval(total);
    var jumlahkan_diskon = eval(pembelian_diskon) + eval(diskon);
    var jumlahkan_total_diskon = eval(pembelian_total_diskon) + eval(total_diskon);

    // isi di table penjualan
    $(".pembelian_jumlah").attr("id", jumlahkan_jumlah);
    $(".pembelian_harga").attr("id", jumlahkan_harga);
    $(".pembelian_total").attr("id", jumlahkan_total);
    $(".pembelian_diskon").attr("id", jumlahkan_diskon);
    $(".pembelian_total_diskon").attr("id", jumlahkan_total_diskon);

    // tulis di table penjualan

    $(".pembelian_jumlah").text(formatNumber(jumlahkan_jumlah));
        // $(".pembelian_harga").text(formatNumber(jumlahkan_harga) + ",-");
        $(".pembelian_total").text("Rp." + formatNumber(jumlahkan_total));
        // $(".pembelian_diskon").text("Rp." + formatNumber(jumlahkan_diskon) + ",-");
        $(".pembelian_total_diskon").text("Rp." + formatNumber(jumlahkan_total_diskon.toFixed(0)));

    // total
    // $(".total_pembelian").text("Rp." + formatNumber(jumlahkan_total) + ",-");
    console.log("Tax tombol update");
    console.log(jumlahkan_total);
    console.log(jumlahkan_total_diskon);
    console.log(tax);

    $(".jumlah_total_pembelian").text(formatNumber(jumlahkan_jumlah));

    var subjumlah = Math.ceil(jumlahkan_total-jumlahkan_total_diskon);
    var g_total = Math.ceil(((jumlahkan_total-jumlahkan_total_diskon)+(jumlahkan_total-jumlahkan_total_diskon)*tax/100)) ;
    $(".total_pembelian").text("Rp." + formatNumber(g_total.toFixed(0)) + ",-");
    $(".total_pembelian").attr("id",jumlahkan_total);
    $(".sub_total_pembelian").text("Rp." + formatNumber(jumlahkan_total) + ",-");
    $(".sub_total_pembelian").attr("id",jumlahkan_total);

    $(".total_form").val(g_total);
    $(".sub_total_form").val(jumlahkan_total);

    // total Diskon
    $(".total_diskon_pembelian").text("Rp." + formatNumber(jumlahkan_total_diskon.toFixed(0)) + ",-");
    $(".total_diskon_pembelian").attr("id",jumlahkan_total_diskon);
    $(".sub_total_diskon_pembelian").text("Rp." + formatNumber(jumlahkan_total_diskon.toFixed(0)) + ",-");
    $(".sub_total_diskon_pembelian").attr("id",jumlahkan_total_diskon);

    $(".total_diskon_form").val(jumlahkan_total_diskon);
    $(".sub_total_diskon_form").val(jumlahkan_total_diskon);

    $(".subjumlah_form").val(subjumlah);
    console.log('subjumlah :')
    console.log(subjumlah)

    // kosongkan
    $("#tambahkan_id").val("");
    $("#tambahkan_kode").val("");
    $("#tambahkan_nama").val("");
    $("#tambahkan_harga").val("");
    $("#tambahkan_jumlah").val("");
    $("#tambahkan_total").val("");
    $("#tambahkan_diskon").val("");
    $("#tambahkan_total_diskon").val("");
    $("#d").val(""); 
    $("#tambahkan_ket").val(""); 
    $("#tambahkan_kd_promo").val(""); 


    $("#tombol-tambahkan").show();
    $("#tombol-update").hide();
    $("#tombol-update-cancel").hide();

    $("#table-pembelian tr").removeClass('bg-yellow');


    // update Tax
    var tax = $(".total_tax").val();
    if(tax.length != 0 && tax != ""){
      console.log("masuk masih di posisi update tax");
      console.log(tax);

      var sub_total = $(".sub_total_pembelian").attr("id");
      console.log(sub_total);
      var total_diskon = $(".sub_total_diskon_pembelian").attr("id");
      console.log(total_diskon);

      var hasil_tax = Math.ceil((sub_total-total_diskon)*(tax/100));
      console.log(hasil_tax);
      $(".hasil_tax").text("Rp."+formatNumber(hasil_tax.toFixed(0))+",-");
      $(".hasil_tax_form").val(hasil_tax.toFixed(0));
    }else{
      var sub_total_pembelian = $(".sub_total_pembelian").attr("id");

      $(".total_pembelian").attr("id",sub_total_pembelian);
      $(".total_pembelian").text("Rp."+formatNumber(sub_total_pembelian)+",-");
    }
    $("#kalkulator").hide(100);
    $("#form_ket").hide(100);
    paymenttotalkembali()

  }

});


$("body").on("click", "#tombol-update-cancel", function() {

  $("#tambahkan_id").val("");
  $("#tambahkan_kode").val("");
  $("#tambahkan_nama").val("");
  $("#tambahkan_harga").val("");
  $("#tambahkan_jumlah").val("");
  $("#tambahkan_total").val("");

  $("#tombol-tambahkan").show();
  $("#tombol-update").hide();
  $("#tombol-update-cancel").hide();

  $("#table-pembelian tr").removeClass('bg-yellow');

});


    // tombol hapus penjualan
    $("body").on("click", ".tombol-hapus-penjualan", function() {

      var ini = $(this);
      var id = $(this).attr("id");
      var jumlah = $(this).attr("jumlah");
      var harga = $(this).attr("harga");
      var total = $(this).attr("total");
      var diskon = $(this).attr("diskon");
      var total_diskon = $(this).attr("total_diskon");

      var tax = $(".total_tax").val();

        // update total pembelian
        var pembelian_jumlah = $(".pembelian_jumlah").attr("id");
        var pembelian_harga = $(".pembelian_harga").attr("id");
        var pembelian_total = $(".pembelian_total").attr("id");
        var pembelian_diskon = $(".pembelian_diskon").attr("id");
        var pembelian_total_diskon = $(".pembelian_total_diskon").attr("id");

        // jumlahkan pembelian
        var kurangi_jumlah = eval(pembelian_jumlah) - eval(jumlah);
        var kurangi_harga = eval(pembelian_harga) - eval(harga);
        var kurangi_total = eval(pembelian_total) - eval(total);
        var kurangi_diskon = eval(pembelian_diskon) - eval(diskon);
        var kurangi_total_diskon = eval(pembelian_total_diskon) - eval(total_diskon);

        // isi di table penjualan
        $(".pembelian_jumlah").attr("id", kurangi_jumlah);
        $(".pembelian_harga").attr("id", kurangi_harga);
        $(".pembelian_total").attr("id", kurangi_total);
        $(".pembelian_diskon").attr("id", kurangi_diskon);
        $(".pembelian_total_diskon").attr("id", kurangi_total_diskon);

        // tulis di table penjualan
        $(".pembelian_jumlah").text(formatNumber(kurangi_jumlah));
        // $(".pembelian_harga").text(formatNumber(kurangi_harga) + ",-");
        $(".pembelian_total").text("Rp." + formatNumber(kurangi_total));
        // $(".pembelian_diskon").text(formatNumber(kurangi_diskon) + ",-");
        $(".pembelian_total_diskon").text("Rp." + formatNumber(kurangi_total_diskon.toFixed(0)));

        // total
        $(".jumlah_total_pembelian").text(formatNumber(kurangi_jumlah));
        console.log("Tax hapus");
        console.log(kurangi_total);
        console.log(kurangi_total_diskon);
        console.log(tax);
        $(".sub_total_pembelian").text("Rp." + formatNumber(kurangi_total) + ",-");
        // $(".total_pembelian").text("Rp." + formatNumber(kurangi_total-kurangi_total_diskon) + ",-");
        var subjumlah = Math.ceil(kurangi_total-kurangi_total_diskon);
        var g_total = Math.ceil(((kurangi_total-kurangi_total_diskon)+(kurangi_total-kurangi_total_diskon)*tax/100)) ;
        $(".total_pembelian").text("Rp." + formatNumber(g_total.toFixed(0)) + ",-");
        $(".total_pembelian").attr("id",kurangi_total);
        $(".sub_total_pembelian").attr("id",kurangi_total);

        $(".total_form").val(g_total);
        $(".sub_total_form").val(kurangi_total);

        // total Diskon text("Rp."+formatNumber(hasil_tax.toFixed(0))+",-");
        $(".total_diskon_pembelian").text("Rp." + formatNumber(kurangi_total_diskon.toFixed(0)) + ",-");
        $(".sub_total_diskon_pembelian").text("Rp." + formatNumber(kurangi_total_diskon.toFixed(0)) + ",-");
        $(".total_diskon_pembelian").attr("id",kurangi_total_diskon);
        $(".sub_total_diskon_pembelian").attr("id",kurangi_total_diskon);

        $(".total_diskon_form").val(kurangi_total_diskon);
        $(".sub_total_diskon_form").val(kurangi_total_diskon);
        $(".subjumlah_form").val(subjumlah);

        ini.closest("tr").remove();

        // kosongkan
        $("#tambahkan_id").val("");
        $("#tambahkan_kode").val("");
        $("#tambahkan_nama").val("");
        $("#tambahkan_jumlah").val("");
        $("#tambahkan_harga").val("");
        $("#tambahkan_total").val("");
        $("#tambahkan_diskon").val("");
        $("#tambahkan_total_diskon").val("");

        $("#tombol-tambahkan").show();
        $("#tombol-update").hide();
        $("#tombol-update-cancel").hide();

        $("#table-pembelian tr").removeClass('bg-yellow');


      // update Tax
      var tax = $(".total_tax").val();
      if(tax.length != 0 && tax != ""){
        console.log(tax);
        console.log("masuk hapus 1");

        var sub_total = $(".sub_total_pembelian").attr("id");
        console.log("sub total = "+sub_total);
        var total_diskon = $(".sub_total_diskon_pembelian").attr("id");
        console.log("total diskon = "+total_diskon);

        var hasil_tax = Math.ceil((sub_total-total_diskon)*(tax/100));
        console.log("tax = "+hasil_tax);
        $(".hasil_tax").text("Rp."+formatNumber(hasil_tax.toFixed(0))+",-");
        $(".hasil_tax_form").val(hasil_tax.toFixed(0));
      }else{
        var sub_total_pembelian = $(".sub_total_pembelian").attr("id");

        $(".total_pembelian").attr("id",sub_total_pembelian);
        $(".total_pembelian").text("Rp."+formatNumber(sub_total_pembelian)+",-");
      }

      paymenttotalkembali()

    });

    // diskon
    $("body").on("keyup change", ".total_diskon", function() {
      var diskon = $(this).val();

      if(diskon.length != 0 && diskon != ""){

        var sub_total = $(".sub_total_pembelian").attr("id");
        var total = $(".total_pembelian").attr("id");

        var hasil_diskon = sub_total*diskon/100;
        var hasil2 = sub_total-hasil_diskon;
        $(".total_pembelian").text("Rp."+formatNumber(hasil2)+",-");
        $(".total_form").val(hasil2);

      }else{

        var sub_total_pembelian = $(".sub_total_pembelian").attr("id");
        var sub_total_diskon_pembelian = $(".sub_total_diskon_pembelian").attr("id");
        var sub_total_pembelian = sub_total_pembelian-sub_total_diskon_pembelian;
        $(".total_pembelian").attr("id",sub_total_pembelian);
        $(".total_pembelian").text("Rp."+formatNumber(sub_total_pembelian)+",-");
      }
    });

  });

// pilih voucher
$(document).on("click", ".modal-pilih-voucher", function() {

  var id = $(this).attr('id');
  var kode = $("#kode_" + id).val();
  var noseri = $("#noseri_" + id).val();
  var nilai = $("#nilai_" + id).val();
  var harga = $("#harga_" + id).val();
  var terbit = $("#terbit_" + id).val();
  var daluarsa = $("#daluarsa_" + id).val();

  console.log('masuk ke pilih voucher');

  $("#tambahkan_id").val(id);
  $("#tambahkan_kode").val(kode);
  $("#tambahkan_noseri").val(noseri);
  $("#tambahkan_nilai").val(nilai);
  $("#tambahkan_harga").val(harga);
  $("#tambahkan_terbit").val(terbit);
  $("#tambahkan_daluarsa").val(daluarsa);
  $("#tambahkan_jumlah").val(1);
  $("#tambahkan_total").val(nilai);

    // });

    var id = $("#tambahkan_id").val();
    var kode = $("#tambahkan_kode").val();
    var noseri = $("#tambahkan_noseri").val();
    var nilai = $("#tambahkan_nilai").val();
    var harga = $("#tambahkan_harga").val();
    var terbit = $("#tambahkan_terbit").val();
    var daluarsa = $("#tambahkan_daluarsa").val();
    var jumlah = $("#tambahkan_jumlah").val();
    var total = $("#tambahkan_total").val();

    var table_voucher = "<tr id='tr_" + id + "'>" +
    "<td  style='width:100px;'> <input type='hidden' name='voucher_produk[]' value='" + id + "'> <input type='hidden' name='voucher_harga[]' value='" + harga + "'> <input type='hidden'  name='voucher_terbit[]' value='" + terbit + "'> <input type='hidden'  name='voucher_daluarsa[]' value='" + daluarsa + "'> <input type='hidden' name='voucher_nilai[]' value='" + nilai + "'> <input type='hidden' name='voucher_jumlah[]' value='" + jumlah + "'> <input type='hidden' name='voucher_total[]' value='" + total + "'>" +

    noseri + "</td>" +
    "<td align='right'>" + nilai + "</td>" +
    // "<td align='center'>" + harga + "</td>" +
    // "<td align='right'>" + terbit + "</td>" +
    // "<td align='right'>" + daluarsa + "</td>" +

    "<td align='center'> <span class='btn btn-sm btn-danger tombol-hapus-voucher' total='" + total + "' jumlah='" + jumlah + "' nilai='" + nilai + "' harga='" + harga + "' terbit='" + terbit + "' daluarsa='" + daluarsa + "' id='" + id + "'><i class='fa fa-trash'></i> Batal</span></td>" +

    "</tr>";
    $("#table-voucher tbody").append(table_voucher);

            // update total voucher
            var voucher_harga = $(".voucher_harga").attr("id");
            var voucher_jumlah = $(".voucher_jumlah").attr("id");
            var voucher_total = $(".voucher_total").attr("id");
            var voucher_nilai = $(".voucher_nilai").attr("id");

            console.log('posisi total Voucher =')
            console.log(voucher_total)

            // jumlahkan voucher
            var jumlahkan_harga = eval(voucher_harga) + eval(harga);
            var jumlahkan_jumlah = eval(voucher_jumlah) + eval(jumlah);
            var jumlahkan_total = eval(voucher_total) + eval(total);
            var jumlahkan_nilai = eval(voucher_nilai) + eval(nilai);


            console.log('harga =')
            console.log(jumlahkan_harga)
            console.log('jml =')
            console.log(jumlahkan_jumlah)
            console.log('nilai =')
            console.log(jumlahkan_nilai)
            console.log('total =')
            console.log(jumlahkan_total)

            // isi di table voucher
            $(".voucher_harga").attr("id", jumlahkan_harga);
            $(".voucher_jumlah").attr("id", jumlahkan_jumlah);
            $(".voucher_total").attr("id", jumlahkan_total);
            $(".voucher_nilai").attr("id", jumlahkan_nilai);

            // tulis di table voucher
            $(".voucher_harga").text(jumlahkan_harga );
            $(".voucher_jumlah").text(jumlahkan_jumlah);
            $(".voucher_total").text( jumlahkan_total);
            $(".voucher_nilai").text( jumlahkan_nilai );


            $(".payment_voucher_total").val(jumlahkan_total);
            // document.getElementById("payment_nilai_voucher").innerHTML = "Rp. <b> "+jumlahkan_total+"</b>";

            console.log(jumlahkan_total);
            paymenttotalkembali();
            clear_form_voucher_search();

            // total

            
            // $(".total_voucher").text(jumlahkan_total );
            // $(".total_voucher").attr("id",jumlahkan_total);


            // alert(total_nilai);
            // kosongkan
            $("#tambahkan_id").val("");
            $("#tambahkan_kode").val("");
            $("#tambahkan_noseri").val("");
            $("#tambahkan_nilai").val("");
            $("#tambahkan_harga").val("");
            $("#tambahkan_jumlah").val("");
            $("#tambahkan_total").val("");
            $("#tambahkan_terbit").val("");
            $("#tambahkan_daluarsa").val("");
          // }

        });


    // tombol hapus voucher
    $("body").on("click", ".tombol-hapus-voucher", function() {

      var id = $(this).attr("id");
      var nilai = $(this).attr("nilai");
      var harga = $(this).attr("harga");
      var jumlah = $(this).attr("jumlah");
      var total = $(this).attr("total");
      console.log("Masuk di hapus voucher")

        // update total voucher
        var voucher_nilai = $(".voucher_nilai").attr("id");
        var voucher_harga = $(".voucher_harga").attr("id");
        var voucher_jumlah = $(".voucher_jumlah").attr("id");
        var voucher_total = $(".voucher_total").attr("id");

        // jumlahkan voucher
        var kurangi_nilai = eval(voucher_nilai) - eval(nilai);
        var kurangi_harga = eval(voucher_harga) - eval(harga);
        var kurangi_jumlah = eval(voucher_jumlah) - eval(jumlah);
        var kurangi_total = eval(voucher_total) - eval(total);


        // var total_nilai = $(".total_nilai").val();
        

        // isi di table voucher
        $(".voucher_nilai").attr("id", kurangi_nilai);
        $(".voucher_harga").attr("id", kurangi_harga);
        $(".voucher_jumlah").attr("id", kurangi_jumlah);
        $(".voucher_total").attr("id", kurangi_total);

        // tulis di table voucher
        $(".voucher_nilai").text(kurangi_nilai);
        $(".voucher_harga").text(kurangi_harga);
        $(".voucher_jumlah").text(kurangi_jumlah);
        $(".voucher_total").text(kurangi_total);

        // total
        $(".total_voucher").text(kurangi_total);
        $(".total_voucher").attr("id",kurangi_total);

        // $(".total_form").val(kurangi_total);
        // $(".total_form").val(kurangi_total);

        $("#tr_" + id).remove();

        $(".payment_voucher_total").val(kurangi_total);
        paymenttotalkembali();

      });



  //   function cek()
  //   {
  //     var total = $(".total_pembelian").attr("id");
  //     if(total > 0){
  //       return confirm('Apakah anda yakin ingin memproses transaksi?');
  //     // return true;
  //   }else{
  //     alert("Pembelian Masih Kosong");
  //     return false;
  //   }
  // }



  (function($) {
    $.fn.inputFilter = function(callback, errMsg) {
      return this.on("input keydown keyup mousedown mouseup select contextmenu drop focusout", function(e) {
        if (callback(this.value)) {
        // Accepted value
        if (["keydown","mousedown","focusout"].indexOf(e.type) >= 0){
          $(this).removeClass("input-error");
          this.setCustomValidity("");
        }
        this.oldValue = this.value;
        this.oldSelectionStart = this.selectionStart;
        this.oldSelectionEnd = this.selectionEnd;
      } else if (this.hasOwnProperty("oldValue")) {
        // Rejected value - restore the previous one
        $(this).addClass("input-error");
        this.setCustomValidity(errMsg);
        this.reportValidity();
        this.value = this.oldValue;
        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
      } else {
        // Rejected value - nothing to restore
        this.value = "";
      }
    });
    };
  }(jQuery));


  $(".total_diskon").inputFilter(function(value) {
    return /^\d*$/.test(value) && (value === "" || parseInt(value) <= 100); }, "Must be between 0 and 100");

  </script>



  <script>
    $(function () {
      $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox({
          alwaysShowClose: true
        });
      });

      $('.filter-container').filterizr({gutterPixels: 3});
      $('.btn[data-filter]').on('click', function() {
        $('.btn[data-filter]').removeClass('active');
        $(this).addClass('active');
      });
    })
  </script>

  

  <script>
    // pilih alatbayar
    $(document).on("click", ".modal-pilih-alatbayar", function() {

      var id = $(this).attr('id');
      var kode = $("#alatbayar_kode_" + id).val();
      var nama = $("#alatbayar_nama_" + id).val();
      // var harga = $("#alatbayar_harga_" + id).val();

      $("#tampil_alatbayar_id").val(id);
      $("#tampil_alatbayar_kode").val(kode);
      $("#tampil_alatbayar_nama").val(nama);
      $("#payment_alatbayar_nama").val(nama);

      $("#status_alatbayar").html("<small style='color:green;font-style:italic'>Alatbayar ditemukan</small>");

    });

    


    // pilih alatbayar
    $(document).on("click", ".payment-pilih-alatbayar", function() {

      var id = $(this).attr('id');
      var kode = $("#alatbayar_kode_" + id).val();
      var nama = $("#alatbayar_nama_" + id).val();

      console.log("masuk payment pilih alatbayar")

      close_alatbayar()
      open_sub_alatbayar()

    });

  // pilih sub alatbayar
  $(document).on("click", ".payment-pilih-sub-alatbayar", function() {

    var id = $(this).attr('id');
    var kode = $("#alatbayar_kode_" + id).val();
    var nama = $("#alatbayar_nama_" + id).val();
    // var tarif = $("#alatbayar_tarif_" + id).val();
    console.log(kode)

    var total_pembelian = $(".total_form").val();
    var total_payment =  parseInt(total_pembelian) ;
    var payment_nilai_voucher = $(".payment_voucher_total").val();
    var payment_nilai_tunai = $("#payment_nilai_tunai").val();
    var payment_nilai_non_tunai = total_payment - payment_nilai_voucher - payment_nilai_tunai ;

    console.log('pos sub alatbayar = ')

    console.log(total_pembelian)
    console.log(payment_nilai_voucher)
    console.log(payment_nilai_tunai)
    console.log(payment_nilai_non_tunai)

      
      $("#payment_alatbayar_nama").val(nama);
      $("#payment_sub_alatbayar").val(kode);
      $("#payment_nilai_non_tunai").val(payment_nilai_non_tunai);

      close_sub_alatbayar();
      paymenttotalkembali();

      $('#tampil_alatbayar_pin').removeAttr('disabled');
      $('#payment_nilai_non_tunai').removeAttr('disabled');

      // $("#status_alatbayar").html("<small style='color:green;font-style:italic'>Alatbayar ditemukan</small>");

    });


  function paymenttotalkembali(){
    console.log("masuk payment total kembali");

    var total_pembelian = $(".total_form").val();
        // var total_pembelian = $(".total_pembelian").val();
        // var total_pembelian = document.getElementById("payment_total_pembelian").value;
        var nilai_voucher = document.getElementById("payment_nilai_voucher").value;
        var nilai_non_tunai = document.getElementById("payment_nilai_non_tunai").value;
        var nilai_tunai = document.getElementById("payment_nilai_tunai").value;
        // var nilai_tarif =document.getElementById("payment_alatbayar_tarif").value;

        console.log('Payment ');
        console.log('total pembelian : ');
        console.log(total_pembelian);
        console.log('nilai voucher : ')
        console.log(nilai_voucher);
        console.log('nilai non tunai : ');
        console.log(nilai_non_tunai);
        console.log('nilai tunai : ');
        console.log(nilai_tunai);

        var sisa_kembali = total_pembelian - nilai_voucher - nilai_non_tunai - nilai_tunai ;


        if(sisa_kembali<0){
          document.getElementById("lbl_status_pembayaran").innerHTML = "L U N A S";
          document.getElementById("lbl_status_payment").innerHTML = "Kembalian";
          document.getElementById("paymentKembali").innerHTML = "Rp. <b> "+sisa_kembali+"</b>";
          $('#tombolBuatTransaksi').removeAttr('disabled');
        }else if(sisa_kembali==0){
          document.getElementById("lbl_status_pembayaran").innerHTML = "L U N A S";
          document.getElementById("lbl_status_payment").innerHTML = "L U N A S";
          document.getElementById("paymentKembali").innerHTML = "Rp. <b style='color:grey;'> "+sisa_kembali+"</b>";
          $('#tombolBuatTransaksi').removeAttr('disabled');
        }else{
          document.getElementById("lbl_status_pembayaran").innerHTML = "Belum Lunas";
          document.getElementById("lbl_status_payment").innerHTML = "Kurang Bayar";
          document.getElementById("paymentKembali").innerHTML = "Rp. <b style='color:red;'> "+rubah(sisa_kembali)+"</b>";

          // $("#tombolBuatTransaksi").show();
          $('#tombolBuatTransaksi').attr('disabled','disabled');
        }

      }

      function rubah(angka){
       var reverse = angka.toString().split('').reverse().join(''),
       ribuan = reverse.match(/\d{1,3}/g);
       ribuan = ribuan.join('.').split('').reverse().join('');
       return ribuan;
     }


   </script>

   <script type="text/javascript">
    $(document).ready(function(){
      load_menu_search();

      function load_menu_search(search){
        console.log('masuk ke Load data')
        $.ajax({
          url:"route/data_kasir/ajax_menu_search.php",
          method:"POST",
          data: {
            search: search
          },
          success:function(data){
            $('#tempat_search').html(data);
          }
        });
      }

      function load_menu_search(search){
        console.log('masuk ke Load data')
        $.ajax({
          url:"route/data_kasir/ajax_data_refund.php",
          method:"POST",
          data: {
            search: search
          },
          success:function(data){
            $('#tempat_search').html(data);
          }
        });
      }
      $('#search_menu').keyup(function(){
        console.log('Masuk ke search menu');
        var search_menu = $("#search_menu").val();
        clear_form_kanan();
        var tempat_search = document.getElementById('tempat_search');
        tempat_search.style.display='block';

        load_menu_search(search_menu);
      });



      function load_voucher_search(search){
        console.log('masuk ke Load data voucher')
        $.ajax({
          url:"route/data_kasir/ajax_voucher_search.php",
          method:"POST",
          data: {
            search: search
          },
          success:function(data){
            $('#tempat_voucher').html(data);
          }
        });
      }


    });
  </script>   

</body>
</html>
