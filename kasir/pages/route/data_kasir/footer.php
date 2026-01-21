<?php
$dir = '../../';

?>

<footer class="footer bg_primary_1" style="padding: 0 10 0 10;bottom: 0;position: absolute;width: 100%;height: 35px;position: sticky;">
  <div class="row">

  </div>
  <div class="pull-right hidden-xs">
    <b>Version</b> <?php echo $ver; ?>
  </div>
  <strong>Copyright &copy; <?php echo date('Y'); ?> <?php echo $perusahaan; ?></strong> - System.
</footer>

<!-- </div> -->

<script src="<?php echo $dir; ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo $dir; ?>assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="<?php echo $dir; ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script src="<?php echo $dir; ?>assets/dist/js/adminlte.min.js"></script>


<style type="text/css">
  .table>tbody>tr>td {
    vertical-align: middle;
    /* font-size: large; */
  }

  .table tbody tr td input {
    /* font-size: large !important; */
    /* Or specify an exact size */
    vertical-align: middle;
  }

  a.disabled {
    pointer-events: none;
    cursor: default;
  }
</style>


<!-- Page specific script -->
<script src="<?php echo $dir; ?>plugins/sweetalert2/sweetalert2.all.js"></script>
<script src="<?php echo $dir; ?>plugins/pdfjs/jspdf.umd.min.js"></script>
<script>
  function pilih_satuan(id, value, satuan_awal) {
    function number_format23(number) {
      return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function formatNumber(num) {
      return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    }
    let newRow = $(`#table-pembelian tr#tr_${id}_${value}`);
    let row = `#table-pembelian tr#tr_${id}_${satuan_awal}`;
    if (newRow.length > 0) {
      var jumlRow = parseInt($(row).find('.transaksi_jumlah').val());
      var diskonlama = parseInt($(row).find('.transaksi_diskon').val());

      $(row).remove();
      var existingRow = newRow;
      var harga_dasar = parseInt(existingRow.find('.transaksi_harga').val());
      var diskon = parseInt(existingRow.find('.transaksi_diskon').val());
      var existingJumlah = parseInt(existingRow.find('.transaksi_jumlah').val());
      var existingHargaTotal = parseInt(existingRow.find('.transaksi_total').val());
      var existingDiskon = parseInt(existingRow.find('.transaksi_total_diskon').val());
      var existingSatuanQty = parseFloat(existingRow.find('.transaksi_satuan_qty').val());

      var newJumlah = existingJumlah + jumlRow;
      var newTotal = newJumlah * harga_dasar;
      var kategorihargamanual = existingRow.find('.kategorihargamanual').val();
      // if (kategorihargamanual != "manual") {
      //   newTotal = Math.ceil(newTotal / 100) * 100;
      // }

      var newDiskon = diskon + diskonlama;
      existingRow.find('.transaksi_jumlah').val(newJumlah);
      existingRow.find('.transaksi_total').val(newTotal);
      existingRow.find('.transaksi_total_diskon').val(newDiskon);

      existingRow.find('.tombol-hapus-penjualan').attr("jumlah", newJumlah);
      existingRow.find('.tombol-hapus-penjualan').attr("total", newTotal);
      existingRow.find('.tombol-hapus-penjualan').attr("total_diskon", newDiskon);

      existingRow.find('td:eq(2) input').val(newJumlah);
      existingRow.find('td:eq(6)').html(number_format23(newTotal));
      console.log("Ddddddddd" + newTotal);
      existingRow.find('td:eq(7) input').val(newDiskon);
      existingRow.find('td:eq(8)').html(number_format23(newTotal - newDiskon));


      // update total pembelian
      var tabel_pembelian = $("#table-pembelian tbody tr");
      var jumlahkan_jumlah = 0;
      var jumlahkan_harga = harga_dasar;
      var jumlahkan_total = 0;
      var jumlahkan_diskon = diskon;
      var jumlahkan_total_diskon = 0;
      // Jumlahkan jumlah : 1, jumlahkan_harga : NaN, jumlahkan_total : 13200, jumlahkan_diskon : NaN, jumlahkan_total_diskon : 1000
      tabel_pembelian.each(function(i, el) {
        let jumlah_row = $(el).find('.transaksi_jumlah').val();
        let total_row = $(el).find('.transaksi_total').val();
        let diskon_total_row = $(el).find('.transaksi_total_diskon').val();
        jumlah_row = jumlah_row.replace(/,/g, '');
        total_row = total_row.replace(/,/g, '');
        diskon_total_row = diskon_total_row.replace(/,/g, '');
        jumlahkan_jumlah += parseInt(jumlah_row);
        jumlahkan_total += parseInt(total_row);
        jumlahkan_total_diskon += parseInt(diskon_total_row);
      });

      // jumlahkan pembelian
      // isi di table penjualan
      $(".pembelian_jumlah").attr("id", jumlahkan_jumlah);
      $(".pembelian_harga").attr("id", jumlahkan_harga);
      $(".pembelian_total").attr("id", jumlahkan_total);
      $(".pembelian_diskon").attr("id", jumlahkan_diskon);
      $(".pembelian_total_diskon").attr("id", jumlahkan_total_diskon);
      // $(".pembelian_ket").attr("id", jumlahkan_ket);
      // $(".pembelian_kd_promo").attr("id", jumlahkan_kd_promo);
      // $(".pembelian_harga_dasar").attr("id", jumlahkan_harga_dasar);

      // tulis di table penjualan
      $(".pembelian_jumlah").text(formatNumber(jumlahkan_jumlah));
      // $(".pembelian_harga").text(formatNumber(jumlahkan_harga) + ",-");
      $(".pembelian_total").text("Rp." + formatNumber(jumlahkan_total));
      // $(".pembelian_diskon").text(formatNumber(jumlahkan_diskon) + ",-");
      $(".pembelian_total_diskon").text("Rp." + formatNumber(jumlahkan_total_diskon.toFixed(0)));

      // total
      $(".jumlah_total_pembelian").text(formatNumber(jumlahkan_jumlah));
      $(".sub_total_pembelian").text("Rp." + formatNumber(jumlahkan_total) + "");

      var tax = $(".total_tax").val();
      var subjumlah = Math.round(jumlahkan_total - jumlahkan_total_diskon);
      var g_total = Math.round(((jumlahkan_total - jumlahkan_total_diskon) + (jumlahkan_total - jumlahkan_total_diskon) * tax / 100));
      $(".total_pembelian").text("Rp." + formatNumber(g_total.toFixed(0)) + "");

      $(".total_pembelian").attr("id", g_total);
      $(".sub_total_pembelian").attr("id", jumlahkan_total);

      $(".total_form").val(g_total);
      $(".sub_total_form").val(jumlahkan_total);

      // total_diskon
      $(".total_diskon_pembelian").text("Rp." + formatNumber(jumlahkan_total_diskon.toFixed(0)) + ",-");
      $(".sub_total_diskon_pembelian").text("Rp." + formatNumber(jumlahkan_total_diskon.toFixed(0)) + "");
      $(".total_diskon_pembelian").attr("id", jumlahkan_total_diskon);
      $(".sub_total_diskon_pembelian").attr("id", jumlahkan_total_diskon);

      $(".total_diskon_form").val(jumlahkan_total_diskon);
      $(".sub_total_diskon_form").val(jumlahkan_total_diskon);
      $(".subjumlah_form").val(subjumlah);

      // kosongkan
      // isi di table penjualan
      $(".pembelian_jumlah").attr("id", jumlahkan_jumlah);
      $(".pembelian_harga").attr("id", jumlahkan_harga);
      $(".pembelian_total").attr("id", jumlahkan_total);
      $(".pembelian_diskon").attr("id", jumlahkan_diskon);
      $(".pembelian_total_diskon").attr("id", jumlahkan_total_diskon);
      // $(".pembelian_ket").attr("id", jumlahkan_ket);
      // $(".pembelian_kd_promo").attr("id", jumlahkan_kd_promo);
      // $(".pembelian_harga_dasar").attr("id", jumlahkan_harga_dasar);

      // tulis di table penjualan
      $(".pembelian_jumlah").text(formatNumber(jumlahkan_jumlah));
      // $(".pembelian_harga").text(formatNumber(jumlahkan_harga) + ",-");
      $(".pembelian_total").text("Rp." + formatNumber(jumlahkan_total));
      // $(".pembelian_diskon").text(formatNumber(jumlahkan_diskon) + ",-");
      //  $(".pembelian_total_diskon").text("Rp." + formatNumber(jumlahkan_total_diskon.toFixed(0)));
      $(".pembelian_total_diskon").text("Rp." + formatNumber(g_total.toFixed(0)) + "");

      // update Tax
      var tax = $(".total_tax").val();
      if (tax.length != 0 && tax != "") {

        var sub_total = $(".sub_total_pembelian").attr("id");

        var total_diskon = $(".sub_total_diskon_pembelian").attr("id");

        var hasil_tax = Math.round((sub_total - total_diskon) * (tax / 100));

        $(".hasil_tax").text("Rp." + formatNumber(hasil_tax.toFixed(0)) + "");
        $(".hasil_tax_form").val(hasil_tax.toFixed(0));
      } else {
        var sub_total_pembelian = $(".sub_total_pembelian").attr("id");

        $(".total_pembelian").attr("id", sub_total_pembelian);
        $(".total_pembelian").text("Rp." + formatNumber(sub_total_pembelian) + ",-");
      }
      $(".tombol-edit-penjualan").click();

      $('#tombolAplikasi').attr('disabled', 'disabled');
      $('#tombol-simpan').attr('disabled', 'disabled');
      $('#tombol-simpan2').attr('disabled', 'disabled');
      // $('#tombolPayment').show();
      // $('#tombolPayment').removeAttr('disabled');
      paymenttotalkembali();
    } else {
      $.get("./route/data_kasir/ajax_satuan_harga.php?kode=" + id + "&satuan=" + value, function(response) {
        var existingRow = $(row);
        var satuan_awal = $(existingRow).find('.transaksi_satuan_awal').val();
        var existingJumlah = parseInt(existingRow.find('.transaksi_jumlah').val());
        var harga_dasar = parseInt(response.data[0].harga);
        var harga_dasar_format = response.data[0].harga_dasar;
        var qty = parseInt(response.data[0]['satuan_qty']);
        var diskon = parseInt(existingRow.find('.transaksi_diskon').val());
        var existing_harga_total = existingJumlah * harga_dasar;
        var kategorihargamanual = existingRow.find('.kategorihargamanual').val();
        // if (kategorihargamanual != "manual") {
        //   existing_harga_total = Math.ceil(existing_harga_total / 100) * 100;
        // }
        var harga_jumlah = existingJumlah * harga_dasar;
        // var existing_diskon_total = existingJumlah * qty * diskon;
        var existing_diskon_total = diskon;

        // update juga harga dan satuan qty pada menu sesuai id
        // $('.menupilihan input#harga_'+id).val(harga_dasar);
        // $('.menupilihan input#satuan_qty_'+id).val(qty);
        // $('.menupilihan #'+id+' .menunama2').html(`Rp. <b>${harga_dasar_format}</b>`);
        // Update the row with the new values and other data
        existingRow.find('.transaksi_jumlah').val(existingJumlah);
        existingRow.find('.transaksi_total').val(existing_harga_total);
        existingRow.find('.transaksi_total_diskon').val(existing_diskon_total);
        existingRow.find('.transaksi_harga').val(harga_dasar);
        existingRow.find('.transaksi_satuan_qty').val(qty);
        existingRow.find('.tombol-hapus-penjualan').attr("jumlah", existingJumlah);
        existingRow.find('.tombol-hapus-penjualan').attr("total", existing_harga_total);
        existingRow.find('.tombol-hapus-penjualan').attr("total_diskon", existing_diskon_total);
        existingRow.find('.tombol-hapus-penjualan').attr("harga", harga_dasar);
        existingRow.find('td:eq(2) input').val(existingJumlah);
        existingRow.find('td:eq(3) input').val(harga_dasar);
        existingRow.find('td:eq(5)').html(number_format23(qty));
        existingRow.find('td:eq(6)').html(number_format23(existing_harga_total));
        // existingRow.find('td:eq(8)').html(number_format23(existing_diskon_total));
        existingRow.find('td:eq(8)').html(number_format23(existing_harga_total - existing_diskon_total));
        existingRow.attr('id', 'tr_' + id + '_' + value);
        existingRow.find('.transaksi_satuan_awal').val(value);
        existingRow.find('td select').removeAttr('onchange');
        existingRow.find('td select').off('change');
        existingRow.find('td select').on('change', function() {
          pilih_satuan(id, $(this).val(), value);
        });

        existingRow.find('td .jumlah_transaksi_input').removeAttr('onchange');
        existingRow.find('td .jumlah_transaksi_input').off('change');
        existingRow.find('td .jumlah_transaksi_input').on('change', function() {
          ubah_jumlah(id, $(this).val(), value);
        });

        existingRow.find('td .jumlah_transaksi_input').removeAttr('onclick');
        existingRow.find('td .jumlah_transaksi_input').off('click');
        existingRow.find('td .jumlah_transaksi_input').on('click', function() {
          focus_input(id, value);
        });


        existingRow.find('td .jumlah_diskon_input').removeAttr('onchange');
        existingRow.find('td .jumlah_diskon_input').off('change');
        existingRow.find('td .jumlah_diskon_input').on('change', function() {
          ubah_diskon(id, $(this).val(), value);
        });

        existingRow.find('td .jumlah_diskon_input').removeAttr('onclick');
        existingRow.find('td .jumlah_diskon_input').off('click');
        existingRow.find('td .jumlah_diskon_input').on('click', function() {
          focus_input(id, value);
        });

        existingRow.find('td .keterangan_input').removeAttr('onchange');
        existingRow.find('td .keterangan_input').off('change');
        existingRow.find('td .keterangan_input').on('change', function() {
          tambah_keterangan(id, $(this).val(), value);
        });

        existingRow.find('td .keterangan_input').removeAttr('onclick');
        existingRow.find('td .keterangan_input').off('click');
        existingRow.find('td .keterangan_input').on('click', function() {
          focus_input(id, value);
        });
        // update total pembelian
        var tabel_pembelian = $("#table-pembelian tbody tr");
        var jumlahkan_jumlah = 0;
        var jumlahkan_harga = harga_dasar;
        var jumlahkan_total = 0;
        var jumlahkan_diskon = diskon;
        var jumlahkan_total_diskon = 0;
        // Jumlahkan jumlah : 1, jumlahkan_harga : NaN, jumlahkan_total : 13200, jumlahkan_diskon : NaN, jumlahkan_total_diskon : 1000
        tabel_pembelian.each(function(i, el) {
          let jumlah_row = $(el).find('.transaksi_jumlah').val();
          let total_row = $(el).find('.transaksi_total').val();
          let diskon_total_row = $(el).find('.transaksi_total_diskon').val();
          jumlah_row = jumlah_row.replace(/,/g, '');
          total_row = total_row.replace(/,/g, '');
          diskon_total_row = diskon_total_row.replace(/,/g, '');
          jumlahkan_jumlah += parseInt(jumlah_row);
          jumlahkan_total += parseInt(total_row);
          jumlahkan_total_diskon += parseInt(diskon_total_row);
        });

        // jumlahkan pembelian
        // isi di table penjualan
        $(".pembelian_jumlah").attr("id", jumlahkan_jumlah);
        $(".pembelian_harga").attr("id", jumlahkan_harga);
        $(".pembelian_total").attr("id", jumlahkan_total);
        $(".pembelian_diskon").attr("id", jumlahkan_diskon);
        $(".pembelian_total_diskon").attr("id", jumlahkan_total_diskon);
        // $(".pembelian_ket").attr("id", jumlahkan_ket);
        // $(".pembelian_kd_promo").attr("id", jumlahkan_kd_promo);
        // $(".pembelian_harga_dasar").attr("id", jumlahkan_harga_dasar);

        // tulis di table penjualan
        $(".pembelian_jumlah").text(formatNumber(jumlahkan_jumlah));
        // $(".pembelian_harga").text(formatNumber(jumlahkan_harga) + ",-");
        $(".pembelian_total").text("Rp." + formatNumber(jumlahkan_total));
        // $(".pembelian_diskon").text(formatNumber(jumlahkan_diskon) + ",-");
        $(".pembelian_total_diskon").text("Rp." + formatNumber(jumlahkan_total_diskon.toFixed(0)));

        // total
        $(".jumlah_total_pembelian").text(formatNumber(jumlahkan_jumlah));
        $(".sub_total_pembelian").text("Rp." + formatNumber(jumlahkan_total) + "");

        var tax = $(".total_tax").val();
        var subjumlah = Math.round(jumlahkan_total - jumlahkan_total_diskon);
        var g_total = Math.round(((jumlahkan_total - jumlahkan_total_diskon) + (jumlahkan_total - jumlahkan_total_diskon) * tax / 100));
        $(".total_pembelian").text("Rp." + formatNumber(g_total.toFixed(0)) + "");

        $(".total_pembelian").attr("id", g_total);
        $(".sub_total_pembelian").attr("id", jumlahkan_total);

        $(".total_form").val(g_total);
        $(".sub_total_form").val(jumlahkan_total);

        // total_diskon
        $(".total_diskon_pembelian").text("Rp." + formatNumber(jumlahkan_total_diskon.toFixed(0)) + ",-");
        $(".sub_total_diskon_pembelian").text("Rp." + formatNumber(jumlahkan_total_diskon.toFixed(0)) + "");
        $(".total_diskon_pembelian").attr("id", jumlahkan_total_diskon);
        $(".sub_total_diskon_pembelian").attr("id", jumlahkan_total_diskon);

        $(".total_diskon_form").val(jumlahkan_total_diskon);
        $(".sub_total_diskon_form").val(jumlahkan_total_diskon);
        $(".subjumlah_form").val(subjumlah);

        // kosongkan
        // isi di table penjualan
        $(".pembelian_jumlah").attr("id", jumlahkan_jumlah);
        $(".pembelian_harga").attr("id", jumlahkan_harga);
        $(".pembelian_total").attr("id", jumlahkan_total);
        $(".pembelian_diskon").attr("id", jumlahkan_diskon);
        $(".pembelian_total_diskon").attr("id", jumlahkan_total_diskon);
        // $(".pembelian_ket").attr("id", jumlahkan_ket);
        // $(".pembelian_kd_promo").attr("id", jumlahkan_kd_promo);
        // $(".pembelian_harga_dasar").attr("id", jumlahkan_harga_dasar);

        // tulis di table penjualan
        $(".pembelian_jumlah").text(formatNumber(jumlahkan_jumlah));
        // $(".pembelian_harga").text(formatNumber(jumlahkan_harga) + ",-");
        $(".pembelian_total").text("Rp." + formatNumber(jumlahkan_total));
        // $(".pembelian_diskon").text(formatNumber(jumlahkan_diskon) + ",-");
        // $(".pembelian_total_diskon").text("Rp." + formatNumber(jumlahkan_total_diskon.toFixed(0)));
        $(".pembelian_total_diskon").text("Rp." + formatNumber(g_total.toFixed(0)) + "");



        // update Tax
        var tax = $(".total_tax").val();
        if (tax.length != 0 && tax != "") {

          var sub_total = $(".sub_total_pembelian").attr("id");

          var total_diskon = $(".sub_total_diskon_pembelian").attr("id");

          var hasil_tax = Math.round((sub_total - total_diskon) * (tax / 100));

          $(".hasil_tax").text("Rp." + formatNumber(hasil_tax.toFixed(0)) + "");
          $(".hasil_tax_form").val(hasil_tax.toFixed(0));
        } else {
          var sub_total_pembelian = $(".sub_total_pembelian").attr("id");

          $(".total_pembelian").attr("id", sub_total_pembelian);
          $(".total_pembelian").text("Rp." + formatNumber(sub_total_pembelian) + ",-");
        }
        $(".tombol-edit-penjualan").click();

        $('#tombolAplikasi').attr('disabled', 'disabled');
        $('#tombol-simpan').attr('disabled', 'disabled');
        $('#tombol-simpan2').attr('disabled', 'disabled');
        // $('#tombolPayment').show();
        // $('#tombolPayment').removeAttr('disabled');
        paymenttotalkembali();
      });
    }
  }

  function tambah_barang_tabel(kode_barang) {
    var value = kode_barang;

    function scrollToBottom() {
      var div = $(".table-scroll");
      div.scrollTop(div[0].scrollHeight);
    }

    $.ajax({
      type: "GET",
      url: "route/data_kasir/barcode_aksi.php?kode=" + value,
      dataType: 'json',
      success: function(response) {
        if (response.status == 1) {
          var data = response.data[0];
          var id = data.kd_brg;
          var kode = data.kd_brg;
          var nama = data.nama;
          var harga = data.harga;
          var diskon = data.diskon;

          var ket = "";
          var kd_promo = data.kd_promo;
          var harga_dasar = data.harga_dasar;
          var tax = $(".total_tax").val();
          var satuan = data.Satuan1.trim();
          var satuan_awal = data.Satuan1.trim();
          var satuan_qty = data.qty_satuan1;
          var stockunit = data.stock;
          var kategorilockswalayan = data.Pcs;
          var kategorilockgudang = data.Renteng;
          var kategorihargamanual = data.kategorihargamanual;


          $("#tambahkan_id").val(id);
          $("#tambahkan_kode").val(kode);
          $("#tambahkan_nama").val(nama);
          $("#tambahkan_harga").val(harga);
          $("#tambahkan_jumlah").val(1);
          $("#tambahkan_total").val(harga * satuan_qty);
          $("#tambahkan_diskon").val(diskon);
          $("#tambahkan_total_diskon").val(diskon);
          $("#tambahkan_ket").val(ket);
          $("#tambahkan_satuan").val(satuan);
          // $("#tambahkan_kd_promo").val(kd_promo);

          var id = $("#tambahkan_id").val();
          var kode = $("#tambahkan_kode").val();
          var nama = $("#tambahkan_nama").val();
          var harga = $("#tambahkan_harga").val();
          var jumlah = $("#tambahkan_jumlah").val();
          var total = $("#tambahkan_total").val();
          var diskon = $("#tambahkan_diskon").val();
          var total_diskon = total;
          var ket = $("#tambahkan_ket").val();
          var satuan = $("#tambahkan_satuan").val();
          var options = "";
          var newJumlah = jumlah;

          $.ajax({
            "url": "./route/data_kasir/ajax_satuan_option.php?id=" + id,
            "type": "GET",
            "dataType": "json",
            "async": false,
            "success": function(response) {
              response.forEach((element, i) => {
                if (i == 0) {
                  options += `<option selected>${element}</option>`
                } else {
                  options += `<option>${element}</option>`
                }
              });
            },
            "error": function(jqXHR, textStatus, errorThrown) {
              console.log(textStatus, errorThrown);
            }
          });

          let select = `<select class="form-control" id="transaksi_satuan_${id}" name="transaksi_satuan[]" style='width:120px ;border-style: none;font-size: 14px; color: black !important;' onchange="pilih_satuan('${id}', this.value, '${satuan}')">${options}</select>`;

          function doesIdExistInTable(id, satuan) {
            return $("#table-pembelian").find("tr[id='tr_" + id + "_" + satuan + "']").length > 0;
          }

          function number_format23(number) {
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
          }

          if (doesIdExistInTable(id, satuan)) {
            console.log("adddddddddddddd");
            var existingRow = $("#table-pembelian").find("tr[id='tr_" + id + "_" + satuan + "']");
            var existingJumlah = parseInt(existingRow.find('.transaksi_jumlah').val());
            var existingHargaTotal = parseInt(existingRow.find('.transaksi_total').val());
            var existingDiskon = parseInt(existingRow.find('.transaksi_total_diskon').val());
            var existingSatuanQty = parseFloat(existingRow.find('.transaksi_satuan_qty').val());
            var newJumlah = existingJumlah + parseInt(jumlah);
            var newTotal = existingHargaTotal + parseInt(total);
            var newDiskon = parseInt(diskon);

            // Update the row with the new values and other data
            existingRow.find('.transaksi_jumlah').val(newJumlah);
            existingRow.find('.transaksi_total').val(newTotal);
            existingRow.find('.transaksi_total_diskon').val(newDiskon);
            existingRow.find('.tombol-hapus-penjualan').attr("jumlah", newJumlah);
            existingRow.find('.tombol-hapus-penjualan').attr("total", newTotal);
            existingRow.find('.tombol-hapus-penjualan').attr("total_diskon", newDiskon);

            existingRow.find('td:eq(2) input').val(newJumlah);
            existingRow.find('td:eq(6)').html(number_format23(newTotal));
            existingRow.find('td:eq(8)').html(number_format23(newTotal - newDiskon));


          } else {
            const temporary_filehargaonline = document.getElementById('kd_kategori_harga_online').value;
            if (temporary_filehargaonline == 2) {
              var table_pembelian = "<tr id='tr_" + id + "_" + satuan + "'>" +
                "<td align='left' width='30px'> <span class='btn btn-sm btn-danger tombol-hapus-penjualan' jumlah='" + jumlah + "' harga='" + harga + "' total='" + total + "' diskon='" + diskon + "' total_diskon='" + total_diskon + "' ket='" + ket + "' kd_promo='" + kd_promo + "'id='" + id + "'><i class='fa fa-close'></i></span></td>" +

                "<td> <input type='hidden' class='transaksi_nama' name='transaksi_nama[]' value='" + nama + "'> <input type='hidden' class='transaksi_produk' name='transaksi_produk[]' value='" + id + "'> <input type='hidden' class='transaksi_jumlah' name='transaksi_jumlah[]' value='" + jumlah + "'> <input type='hidden' class='transaksi_harga' name='transaksi_harga[]' value='" + harga + "'> <input type='hidden' class='transaksi_total' name='transaksi_total[]' value='" + total + "'> <input type='hidden' class='transaksi_diskon' name='transaksi_diskon[]' value='" + diskon + "'> <input type='hidden' class='transaksi_total_diskon' name='transaksi_total_diskon[]' value='" + total_diskon + "'> <input type='hidden' class='transaksi_ket' name='transaksi_ket[]' value='" + ket + "'> <input type='hidden' class='transaksi_kd_promo' name='transaksi_kd_promo[]' value='" + kd_promo + "'> <input type='hidden' class='transaksi_harga_dasar' name='transaksi_harga_dasar[]' value='" + harga_dasar + "'> <input type='hidden' class='transaksi_satuan_qty' name='transaksi_satuan_qty[]' value='" + satuan_qty + "'> <input type='hidden' class='transaksi_satuan_awal' name='transaksi_satuan_awal[]' value='" + satuan_awal + "'> <input type='hidden' class='stockunit' name='stockunit[]' value='" + stockunit + "'> <input type='hidden' class='kategorihargamanual' name='kategorihargamanual[]' value='" + kategorihargamanual + "'> <input type='hidden' class='kategorilockswalayan' name='kategorilockswalayan[]' value='" + kategorilockswalayan + "'> <input type='hidden' class='kategorilockgudang' name='kategorilockgudang[]' value='" + kategorilockgudang + "'> <span class='transaksi_kode'>" +

                "<span class='transaksi_nama tombol-edit-penjualan' style='line-height:1.1em'  jumlah='" + jumlah + "' harga='" + harga + "' total='" + total + "' diskon='" + diskon + "' total_diskon='" + total_diskon + "' id='" + id + "'>" + nama + "</span></td>" +
                "<td align='center'><input type='text' class='jumlah_transaksi_input' value='" + jumlah + "' style='width:100% ;border-style: none;font-size: 12px; color: black !important; text-align: center' onchange='ubah_jumlah(\"" + id + "\",this.value, \"" + satuan + "\")' onclick='focus_input(\"" + id + "\", \"" + satuan + "\")'></td>" +
                // "<td align='right'>" + formatNumber(harga) + "</td>" +
                "<td align='center'><input type='text' class='jumlah_harga_online_input' value='" + harga + "' style='width:100% ;border-style: none;font-size: 12px; color: black !important; text-align: center' onchange='ubah_harga_online(\"" + id + "\",this.value, \"" + satuan + "\")' onclick='focus_input(\"" + id + "\", \"" + satuan + "\")'readonly disabled></td>" +
                "<td align='center'>" + select + "</td>" +
                "<td align='center'>" + satuan_qty + "</td>" +
                "<td align='right'>" + formatNumber(total) + "</td>" +
                "<td align='center'><input type='text' class='jumlah_diskon_input' value='" + diskon + "' style='width:100% ;border-style: none;font-size: 12px; color: black !important; text-align: center' onchange='ubah_diskon(\"" + id + "\",this.value, \"" + satuan + "\")' onclick='focus_input(\"" + id + "\", \"" + satuan + "\")'></td>" +
                "<td align='right'>" + formatNumber(total - diskon) + "</td>" +
                "<td align='center'><input type='text' class='keterangan_input' value='" + ket + "' style='width:100% ;border-style: none;font-size: 12px; color: black !important; text-align: center' onchange='tambah_keterangan(\"" + id + "\",this.value, \"" + satuan + "\")' onclick='focus_input(\"" + id + "\", \"" + satuan + "\")'></td>" +
                // "<td align='left'><span class='transaksi_kd_promo' style='line-height:1.1em'>" + kd_promo + "</span></td>" +
                "</tr>";

              $("#table-pembelian tbody").append(table_pembelian);
              scrollToBottom();
            } else if (temporary_filehargaonline == 3) {
              var table_pembelian = "<tr id='tr_" + id + "_" + satuan + "'>" +
                "<td align='left' width='30px'> <span class='btn btn-sm btn-danger tombol-hapus-penjualan' jumlah='" + jumlah + "' harga='" + harga + "' total='" + total + "' diskon='" + diskon + "' total_diskon='" + total_diskon + "' ket='" + ket + "' kd_promo='" + kd_promo + "'id='" + id + "'><i class='fa fa-close'></i></span></td>" +

                "<td> <input type='hidden' class='transaksi_nama' name='transaksi_nama[]' value='" + nama + "'> <input type='hidden' class='transaksi_produk' name='transaksi_produk[]' value='" + id + "'> <input type='hidden' class='transaksi_jumlah' name='transaksi_jumlah[]' value='" + jumlah + "'> <input type='hidden' class='transaksi_harga' name='transaksi_harga[]' value='" + harga + "'> <input type='hidden' class='transaksi_total' name='transaksi_total[]' value='" + total + "'> <input type='hidden' class='transaksi_diskon' name='transaksi_diskon[]' value='" + diskon + "'> <input type='hidden' class='transaksi_total_diskon' name='transaksi_total_diskon[]' value='" + total_diskon + "'> <input type='hidden' class='transaksi_ket' name='transaksi_ket[]' value='" + ket + "'> <input type='hidden' class='transaksi_kd_promo' name='transaksi_kd_promo[]' value='" + kd_promo + "'> <input type='hidden' class='transaksi_harga_dasar' name='transaksi_harga_dasar[]' value='" + harga_dasar + "'> <input type='hidden' class='transaksi_satuan_qty' name='transaksi_satuan_qty[]' value='" + satuan_qty + "'> <input type='hidden' class='transaksi_satuan_awal' name='transaksi_satuan_awal[]' value='" + satuan_awal + "'> <input type='hidden' class='stockunit' name='stockunit[]' value='" + stockunit + "'> <input type='hidden' class='kategorihargamanual' name='kategorihargamanual[]' value='" + kategorihargamanual + "'> <input type='hidden' class='kategorilockswalayan' name='kategorilockswalayan[]' value='" + kategorilockswalayan + "'> <input type='hidden' class='kategorilockgudang' name='kategorilockgudang[]' value='" + kategorilockgudang + "'> <span class='transaksi_kode'>" +

                "<span class='transaksi_nama tombol-edit-penjualan' style='line-height:1.1em'  jumlah='" + jumlah + "' harga='" + harga + "' total='" + total + "' diskon='" + diskon + "' total_diskon='" + total_diskon + "' id='" + id + "'>" + nama + "</span></td>" +
                "<td align='center'><input type='text' class='jumlah_transaksi_input' value='" + jumlah + "' style='width:100% ;border-style: none;font-size: 12px; color: black !important; text-align: center' onchange='ubah_jumlah(\"" + id + "\",this.value, \"" + satuan + "\")' onclick='focus_input(\"" + id + "\", \"" + satuan + "\")'></td>" +
                // "<td align='right'>" + formatNumber(harga) + "</td>" +
                "<td align='center'><input type='text' class='jumlah_harga_online_input' value='" + harga + "' style='width:100% ;border-style: none;font-size: 12px; color: black !important; text-align: center' onchange='ubah_harga_online(\"" + id + "\",this.value, \"" + satuan + "\")' onclick='focus_input(\"" + id + "\", \"" + satuan + "\")'></td>" +
                "<td align='center'>" + select + "</td>" +
                "<td align='center'>" + satuan_qty + "</td>" +
                "<td align='right'>" + formatNumber(total) + "</td>" +
                "<td align='center'><input type='text' class='jumlah_diskon_input' value='" + diskon + "' style='width:100% ;border-style: none;font-size: 12px; color: black !important; text-align: center' onchange='ubah_diskon(\"" + id + "\",this.value, \"" + satuan + "\")' onclick='focus_input(\"" + id + "\", \"" + satuan + "\")'</td>" +
                "<td align='right'>" + formatNumber(total - diskon) + "</td>" +
                "<td align='center'><input type='text' class='keterangan_input' value='" + ket + "' style='width:100% ;border-style: none;font-size: 12px; color: black !important; text-align: center' onchange='tambah_keterangan(\"" + id + "\",this.value, \"" + satuan + "\")' onclick='focus_input(\"" + id + "\", \"" + satuan + "\")'</td>" +
                // "<td align='left'><span class='transaksi_kd_promo' style='line-height:1.1em'>" + kd_promo + "</span></td>" +
                "</tr>";

              $("#table-pembelian tbody").append(table_pembelian);
              scrollToBottom();
            } else {
              var table_pembelian = "<tr id='tr_" + id + "_" + satuan + "'>" +
                "<td align='left' width='30px'> <span class='btn btn-sm btn-danger tombol-hapus-penjualan' jumlah='" + jumlah + "' harga='" + harga + "' total='" + total + "' diskon='" + diskon + "' total_diskon='" + total_diskon + "' ket='" + ket + "' kd_promo='" + kd_promo + "'id='" + id + "'><i class='fa fa-close'></i></span></td>" +

                "<td> <input type='hidden' class='transaksi_nama' name='transaksi_nama[]' value='" + nama + "'> <input type='hidden' class='transaksi_produk' name='transaksi_produk[]' value='" + id + "'> <input type='hidden' class='transaksi_jumlah' name='transaksi_jumlah[]' value='" + jumlah + "'> <input type='hidden' class='transaksi_harga' name='transaksi_harga[]' value='" + harga + "'> <input type='hidden' class='transaksi_total' name='transaksi_total[]' value='" + total + "'> <input type='hidden' class='transaksi_diskon' name='transaksi_diskon[]' value='" + diskon + "'> <input type='hidden' class='transaksi_total_diskon' name='transaksi_total_diskon[]' value='" + total_diskon + "'> <input type='hidden' class='transaksi_ket' name='transaksi_ket[]' value='" + ket + "'> <input type='hidden' class='transaksi_kd_promo' name='transaksi_kd_promo[]' value='" + kd_promo + "'> <input type='hidden' class='transaksi_harga_dasar' name='transaksi_harga_dasar[]' value='" + harga_dasar + "'> <input type='hidden' class='transaksi_satuan_qty' name='transaksi_satuan_qty[]' value='" + satuan_qty + "'> <input type='hidden' class='transaksi_satuan_awal' name='transaksi_satuan_awal[]' value='" + satuan_awal + "'> <input type='hidden' class='stockunit' name='stockunit[]' value='" + stockunit + "'> <input type='hidden' class='kategorihargamanual' name='kategorihargamanual[]' value='" + kategorihargamanual + "'> <input type='hidden' class='kategorilockswalayan' name='kategorilockswalayan[]' value='" + kategorilockswalayan + "'> <input type='hidden' class='kategorilockgudang' name='kategorilockgudang[]' value='" + kategorilockgudang + "'> <span class='transaksi_kode'>" +

                "<span class='transaksi_nama tombol-edit-penjualan' style='line-height:1.1em'  jumlah='" + jumlah + "' harga='" + harga + "' total='" + total + "' diskon='" + diskon + "' total_diskon='" + total_diskon + "' id='" + id + "'>" + nama + "</span></td>" +
                "<td align='center'><input type='text' class='jumlah_transaksi_input' value='" + jumlah + "' style='width:100% ;border-style: none;font-size: 12px; color: black !important; text-align: center' onchange='ubah_jumlah(\"" + id + "\",this.value, \"" + satuan + "\")' onclick='focus_input(\"" + id + "\", \"" + satuan + "\")'></td>" +
                // "<td align='right'>" + formatNumber(harga) + "</td>" +
                "<td align='center'><input type='text' class='jumlah_harga_online_input' value='" + harga + "' style='width:100% ;border-style: none;font-size: 12px; color: black !important; text-align: center' onchange='ubah_harga_online(\"" + id + "\",this.value, \"" + satuan + "\")' onclick='focus_input(\"" + id + "\", \"" + satuan + "\")'readonly disabled></td>" +
                "<td align='center'>" + select + "</td>" +
                "<td align='center'>" + satuan_qty + "</td>" +
                "<td align='right'>" + formatNumber(total) + "</td>" +
                "<td align='center'><input type='text' class='jumlah_diskon_input' value='" + diskon + "' style='width:100% ;border-style: none;font-size: 12px; color: black !important; text-align: center' onchange='ubah_diskon(\"" + id + "\",this.value, \"" + satuan + "\")' onclick='focus_input(\"" + id + "\", \"" + satuan + "\")'readonly disabled></td>" +
                "<td align='right'>" + formatNumber(total - diskon) + "</td>" +
                "<td align='center'><input type='text' class='keterangan_input' value='" + ket + "' style='width:100% ;border-style: none;font-size: 12px; color: black !important; text-align: center' onchange='tambah_keterangan(\"" + id + "\",this.value, \"" + satuan + "\")' onclick='focus_input(\"" + id + "\", \"" + satuan + "\")'readonly disabled></td>" +
                // "<td align='left'><span class='transaksi_kd_promo' style='line-height:1.1em'>" + kd_promo + "</span></td>" +
                "</tr>";

              $("#table-pembelian tbody").append(table_pembelian);
              scrollToBottom();
            }


          }
          // update total pembelian
          var pembelian_jumlah = $(".pembelian_jumlah").attr("id");
          var pembelian_harga = $(".pembelian_harga").attr("id");
          var pembelian_total = $(".pembelian_total").attr("id");
          var pembelian_diskon = $(".pembelian_diskon").attr("id");
          var pembelian_total_diskon = $(".pembelian_total_diskon").attr("id");
          var pembelian_ket = $(".pembelian_ket").attr("id");
          var pembelian_kd_promo = $(".pembelian_kd_promo").attr("id");
          var pembelian_harga_dasar = $(".pembelian_harga_dasar").attr("id");
          var jumlahkan_jumlah = eval(pembelian_jumlah) + eval(jumlah);
          var jumlahkan_harga = eval(pembelian_harga) + eval(harga);
          var jumlahkan_total = eval(pembelian_total) + eval(total);

          var jumlahkan_diskon = eval(pembelian_diskon) + eval(diskon);
          var jumlahkan_total_diskon = eval(pembelian_total_diskon);
          $(".pembelian_jumlah").attr("id", jumlahkan_jumlah);
          $(".pembelian_harga").attr("id", jumlahkan_harga);
          $(".pembelian_total").attr("id", jumlahkan_total);
          $(".pembelian_diskon").attr("id", jumlahkan_diskon);
          $(".pembelian_total_diskon").attr("id", jumlahkan_total_diskon);

          $(".pembelian_jumlah").text(formatNumber(jumlahkan_jumlah));
          $(".pembelian_total").text("Rp." + formatNumber(jumlahkan_total));
          $(".pembelian_total_diskon").text("Rp." + formatNumber(jumlahkan_total_diskon.toFixed(0)));


          $(".jumlah_total_pembelian").text(formatNumber(jumlahkan_jumlah));
          $(".sub_total_pembelian").text("Rp." + formatNumber(jumlahkan_total) + "");

          var subjumlah = Math.round(jumlahkan_total - jumlahkan_total_diskon);
          var g_total = Math.round(((jumlahkan_total - jumlahkan_total_diskon) + (jumlahkan_total - jumlahkan_total_diskon) * tax / 100));
          $(".total_pembelian").text("Rp." + formatNumber(g_total.toFixed(0)) + "");

          $(".total_pembelian").attr("id", g_total);
          $(".sub_total_pembelian").attr("id", jumlahkan_total);

          $(".total_form").val(g_total);
          $(".sub_total_form").val(jumlahkan_total);



          $(".total_diskon_pembelian").text("Rp." + formatNumber(jumlahkan_total_diskon.toFixed(0)) + ",-");
          $(".sub_total_diskon_pembelian").text("Rp." + formatNumber(jumlahkan_total_diskon.toFixed(0)) + "");
          $(".total_diskon_pembelian").attr("id", jumlahkan_total_diskon);
          $(".sub_total_diskon_pembelian").attr("id", jumlahkan_total_diskon);

          $(".total_diskon_form").val(jumlahkan_total_diskon);
          $(".sub_total_diskon_form").val(jumlahkan_total_diskon);
          $(".subjumlah_form").val(subjumlah);

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
          $("#tambahkan_harga_dasar").val("");

          $(".pembelian_total_diskon").text("Rp." + formatNumber(g_total.toFixed(0)) + "");
          // update Tax
          var tax = $(".total_tax").val();
          if (tax.length != 0 && tax != "") {

            var sub_total = $(".sub_total_pembelian").attr("id");

            var total_diskon = $(".sub_total_diskon_pembelian").attr("id");

            var hasil_tax = Math.round((sub_total - total_diskon) * (tax / 100));

            $(".hasil_tax").text("Rp." + formatNumber(hasil_tax.toFixed(0)) + "");
            $(".hasil_tax_form").val(hasil_tax.toFixed(0));
          } else {
            var sub_total_pembelian = $(".sub_total_pembelian").attr("id");

            $(".total_pembelian").attr("id", sub_total_pembelian);
            $(".total_pembelian").text("Rp." + formatNumber(sub_total_pembelian) + ",-");
          }
          $(".tombol-edit-penjualan").click();

          $('#tombolAplikasi').attr('disabled', 'disabled');
          $('#tombol-simpan').attr('disabled', 'disabled');
          $('#tombol-simpan2').attr('disabled', 'disabled');
          // $('#tombolPayment').show();
          // $('#tombolPayment').removeAttr('disabled');
          paymenttotalkembali()
        }
      },
      error: function(xhr, ajaxOptions, thrownError) {
        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
      }
    });
  }

  function ubah_jumlah_async(id, value, satuan_awal) {
    const temporary_filehargaonline = document.getElementById('kd_kategori_harga_online').value;
    document.getElementById('kd_kategori_harga_online').value = 2;
    return new Promise((resolve) => {
      ubah_jumlah(id, value, satuan_awal);
      document.getElementById('kd_kategori_harga_online').value = temporary_filehargaonline
      // Delay to ensure ubah_jumlah() updates DOM/UI/data
      setTimeout(() => resolve(), 100); // Adjust timing if needed
    });
  }

  function ubah_jumlah(id, value, satuan_awal) {
    // var satuan_awal = $(existingRow).find('.transaksi_satuan_awal').val();
    // let satuantes123 = $(`#table-pembelian tbody tr`)
    //   .find(`select#transaksi_satuan_${id}`)
    //   .val();
    let satuantes123 = $(`#table-pembelian tbody tr#tr_${id}_${satuan_awal}`)
      .find(`select#transaksi_satuan_${id}`)
      .val();

    var existingJumlah = value;
    if (value <= 0) {
      alert("Tidak dapat menerima input 0 atau kurang dari 0")
      existingJumlah = 1;
    }
    const temporary_filehargaonline = document.getElementById('kd_kategori_harga_online').value;
    if (temporary_filehargaonline != 3 && temporary_filehargaonline != 2) {
      $.get("./route/data_kasir/ajax_penyesuain_satuan.php?kode=" + id + "&satuan=" + satuantes123 + "&existingJumlah=" + existingJumlah, function(response) {
        var quantitynew = response.data[0]['existingJumlahNew'];
        var sisa_quantitynew = response.data[0]['sisa'];
        var nama_satuan_quantitynew = response.data[0]['nama_satuan'];

        (async () => {
          if (existingJumlah != quantitynew) {
            await ubah_jumlah_async(id, quantitynew, satuan_awal);

            const $select = $(`#table-pembelian tbody tr#tr_${id}_${satuan_awal}`)
              .find(`select#transaksi_satuan_${id}`);

            await new Promise((resolve) => {
              $select.one('change', () => {
                setTimeout(resolve, 150); // 100ms delay after change
              });

              $select.val(nama_satuan_quantitynew).trigger('change');
            });


            if (sisa_quantitynew > 0) {
              await new Promise((resolve) => {
                tambah_barang_tabel(id);
                setTimeout(resolve, 100);
              });

              ubah_jumlah(id, sisa_quantitynew, satuan_awal);
            }
          }
        })();
      });
    }

    $.get("./route/data_kasir/ajax_satuan_harga.php?kode=" + id + "&satuan=" + satuantes123, function(response) {
      function number_format23(number) {
        return Math.floor(number).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      }

      function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
      }
      var existingRow = $("#table-pembelian").find("tr[id='tr_" + id + "_" + satuan_awal + "']");
      console.log("Row found:", existingRow);
      console.log("Row found:", existingRow.find('.transaksi_total').length); // Check if .transaksi_total exists

      var harga_dasarlopp = parseInt(response.data[0].harga);
      var qtylopp = parseInt(response.data[0]['satuan_qty']);
      var harga_dasar = harga_dasarlopp;
      var diskon = parseInt(existingRow.find('.transaksi_diskon').val());
      var qty = qtylopp;
      var harga_jumlah = harga_dasar * existingJumlah;
      var existing_harga_total = existingJumlah * harga_dasar;
      var kategorihargamanual = existingRow.find('.kategorihargamanual').val();
      // if (kategorihargamanual != "manual") {
      //   existing_harga_total = Math.ceil(existing_harga_total / 100) * 100;
      // }
      console.log(existing_harga_total + "22222");
      console.log(existingRow.find('.transaksi_total').length); // Check if .transaksi_total exists
      console.log(existingRow);
      //var existing_diskon_total = existingJumlah * qty * diskon;
      var existing_diskon_total = diskon;

      // Update the row with the new values and other data
      existingRow.find('.transaksi_jumlah').val(existingJumlah);
      existingRow.find('.transaksi_total').val(existing_harga_total);
      existingRow.find('.transaksi_satuan_qty').val(qty);
      var currentValuasdadadae = existingRow.find('.transaksi_total').val();
      console.log(currentValuasdadadae);
      console.log(existing_harga_total + "asdasd");

      existingRow.find('.transaksi_total_diskon').val(existing_diskon_total);
      existingRow.find('.transaksi_harga').val(harga_dasar);
      existingRow.find('.tombol-hapus-penjualan').attr("jumlah", existingJumlah);
      existingRow.find('.tombol-hapus-penjualan').attr("total", existing_harga_total);
      existingRow.find('.tombol-hapus-penjualan').attr("total_diskon", existing_diskon_total);
      existingRow.find('.tombol-hapus-penjualan').attr("harga", harga_dasar);
      existingRow.find('td:eq(2) input').val(existingJumlah);
      existingRow.find('td:eq(3) input').val(harga_dasar);
      // existingRow.find('td:eq(5)').html(number_format23(qty));
      existingRow.find('td:eq(6)').html(number_format23(existing_harga_total));
      // existingRow.find('td:eq(8)').html(number_format23(existing_diskon_total));
      existingRow.find('td:eq(8)').html(number_format23(existing_harga_total - existing_diskon_total));

      // update total pembelian
      var tabel_pembelian = $("#table-pembelian tbody tr");
      var jumlahkan_jumlah = 0;
      var jumlahkan_harga = harga_dasar;
      var jumlahkan_total = 0;
      var jumlahkan_diskon = diskon;
      var jumlahkan_total_diskon = 0;
      // Jumlahkan jumlah : 1, jumlahkan_harga : NaN, jumlahkan_total : 13200, jumlahkan_diskon : NaN, jumlahkan_total_diskon : 1000
      tabel_pembelian.each(function(i, el) {
        jumlahkan_jumlah += parseFloat($(el).find('.transaksi_jumlah').val());
        jumlahkan_total += parseInt($(el).find('.transaksi_total').val());
        jumlahkan_total_diskon += parseInt($(el).find('.transaksi_diskon').val());

        //jumlahkan_total_diskon += parseInt($(el).find('.transaksi_total_diskon').val());
      });
      // jumlahkan pembelian
      // isi di table penjualan
      $(".pembelian_jumlah").attr("id", jumlahkan_jumlah);
      $(".pembelian_harga").attr("id", jumlahkan_harga);
      $(".pembelian_total").attr("id", jumlahkan_total);
      $(".pembelian_diskon").attr("id", jumlahkan_diskon);
      $(".pembelian_total_diskon").attr("id", jumlahkan_total_diskon);
      // tulis di table penjualan
      $(".pembelian_jumlah").text(formatNumber(jumlahkan_jumlah));
      $(".pembelian_total").text("Rp." + formatNumber(jumlahkan_total));
      $(".pembelian_total_diskon").text("Rp." + formatNumber(jumlahkan_total_diskon.toFixed(0)));
      // total
      $(".jumlah_total_pembelian").text(formatNumber(jumlahkan_jumlah));
      $(".sub_total_pembelian").text("Rp." + formatNumber(jumlahkan_total) + "");
      var tax = $(".total_tax").val();
      var subjumlah = Math.round(jumlahkan_total - jumlahkan_total_diskon);
      var g_total = Math.round(((jumlahkan_total - jumlahkan_total_diskon) + (jumlahkan_total - jumlahkan_total_diskon) * tax / 100));
      $(".total_pembelian").text("Rp." + formatNumber(g_total.toFixed(0)) + "");
      $(".total_pembelian").attr("id", g_total);
      $(".sub_total_pembelian").attr("id", jumlahkan_total);
      $(".total_form").val(g_total);
      $(".sub_total_form").val(jumlahkan_total);
      // total_diskon
      $(".total_diskon_pembelian").text("Rp." + formatNumber(jumlahkan_total_diskon.toFixed(0)) + ",-");
      $(".sub_total_diskon_pembelian").text("Rp." + formatNumber(jumlahkan_total_diskon.toFixed(0)) + "");
      $(".total_diskon_pembelian").attr("id", jumlahkan_total_diskon);
      $(".sub_total_diskon_pembelian").attr("id", jumlahkan_total_diskon);
      $(".total_diskon_form").val(jumlahkan_total_diskon);
      $(".sub_total_diskon_form").val(jumlahkan_total_diskon);
      $(".subjumlah_form").val(subjumlah);
      // kosongkan
      // isi di table penjualan
      $(".pembelian_jumlah").attr("id", jumlahkan_jumlah);
      $(".pembelian_harga").attr("id", jumlahkan_harga);
      $(".pembelian_total").attr("id", jumlahkan_total);
      $(".pembelian_diskon").attr("id", jumlahkan_diskon);
      $(".pembelian_total_diskon").attr("id", jumlahkan_total_diskon);
      // tulis di table penjualan
      $(".pembelian_jumlah").text(formatNumber(jumlahkan_jumlah));
      $(".pembelian_total").text("Rp." + formatNumber(jumlahkan_total));
      //$(".pembelian_total_diskon").text("Rp." + formatNumber(jumlahkan_total_diskon.toFixed(0)));
      $(".pembelian_total_diskon").text("Rp." + formatNumber(g_total.toFixed(0)) + "");
      // update Tax
      var tax = $(".total_tax").val();
      if (tax.length != 0 && tax != "") {
        var sub_total = $(".sub_total_pembelian").attr("id");
        var total_diskon = $(".sub_total_diskon_pembelian").attr("id");
        var hasil_tax = Math.round((sub_total - total_diskon) * (tax / 100));
        $(".hasil_tax").text("Rp." + formatNumber(hasil_tax.toFixed(0)) + "");
        $(".hasil_tax_form").val(hasil_tax.toFixed(0));
      } else {
        var sub_total_pembelian = $(".sub_total_pembelian").attr("id");
        $(".total_pembelian").attr("id", sub_total_pembelian);
        $(".total_pembelian").text("Rp." + formatNumber(sub_total_pembelian) + ",-");
      }
      $(".tombol-edit-penjualan").click();
      $('#tombolAplikasi').attr('disabled', 'disabled');
      $('#tombol-simpan').attr('disabled', 'disabled');
      $('#tombol-simpan2').attr('disabled', 'disabled');
      // $('#tombolPayment').removeAttr('disabled');
      $("#table-pembelian tr").removeClass('bg-yellow');
      paymenttotalkembali();
      $("#tombol-simpan").prop("disabled", true);
    });

  }

  function ubah_diskon(id, value, satuan_awal) {

    function number_format23(number) {
      return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function formatNumber(num) {
      return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    }
    var existingRow = $("#table-pembelian").find("tr[id='tr_" + id + "_" + satuan_awal + "']");
    var satuan_awal = $(existingRow).find('.transaksi_satuan_awal').val();
    var existingJumlah = parseInt(existingRow.find('.transaksi_jumlah').val());
    var harga_dasar = parseInt($(existingRow).find('.transaksi_harga').val());
    var diskon = value;
    $(existingRow).find('.transaksi_diskon').val(diskon);

    var qty = parseInt(existingRow.find('.transaksi_satuan_qty').val());
    var harga_jumlah = harga_dasar * existingJumlah;
    var existing_harga_total = existingJumlah * harga_dasar;

    //var existing_diskon_total = existingJumlah * qty * diskon;
    var existing_diskon_total = diskon;

    // Update the row with the new values and other data
    existingRow.find('.transaksi_jumlah').val(existingJumlah);
    existingRow.find('.transaksi_total').val(existing_harga_total);
    existingRow.find('.transaksi_total_diskon').val(existing_diskon_total);
    existingRow.find('.transaksi_harga').val(harga_dasar);
    existingRow.find('.tombol-hapus-penjualan').attr("jumlah", existingJumlah);
    existingRow.find('.tombol-hapus-penjualan').attr("total", existing_harga_total);
    existingRow.find('.tombol-hapus-penjualan').attr("total_diskon", existing_diskon_total);
    existingRow.find('.tombol-hapus-penjualan').attr("harga", harga_dasar);
    existingRow.find('td:eq(2) input').val(existingJumlah);
    existingRow.find('td:eq(3) input').val(harga_dasar);
    // existingRow.find('td:eq(5)').html(number_format23(qty));
    existingRow.find('td:eq(6)').html(number_format23(existing_harga_total));
    // existingRow.find('td:eq(8)').html(number_format23(existing_diskon_total));
    existingRow.find('td:eq(8)').html(number_format23(existing_harga_total - existing_diskon_total));
    // update total pembelian
    var tabel_pembelian = $("#table-pembelian tbody tr");
    var jumlahkan_jumlah = 0;
    var jumlahkan_harga = harga_dasar;
    var jumlahkan_total = 0;
    var jumlahkan_diskon = diskon;
    var jumlahkan_total_diskon = 0;
    // Jumlahkan jumlah : 1, jumlahkan_harga : NaN, jumlahkan_total : 13200, jumlahkan_diskon : NaN, jumlahkan_total_diskon : 1000
    tabel_pembelian.each(function(i, el) {
      jumlahkan_jumlah += parseInt($(el).find('.transaksi_jumlah').val());
      jumlahkan_total += parseInt($(el).find('.transaksi_total').val());
      //jumlahkan_total_diskon += parseInt($(el).find('.transaksi_total_diskon').val());

      jumlahkan_total_diskon += parseInt($(el).find('.transaksi_diskon').val());
    });
    // jumlahkan pembelian
    // isi di table penjualan
    $(".pembelian_jumlah").attr("id", jumlahkan_jumlah);
    $(".pembelian_harga").attr("id", jumlahkan_harga);
    $(".pembelian_total").attr("id", jumlahkan_total);
    $(".pembelian_diskon").attr("id", jumlahkan_diskon);
    $(".pembelian_total_diskon").attr("id", jumlahkan_total_diskon);
    // tulis di table penjualan
    $(".pembelian_jumlah").text(formatNumber(jumlahkan_jumlah));
    $(".pembelian_total").text("Rp." + formatNumber(jumlahkan_total));
    $(".pembelian_total_diskon").text("Rp." + formatNumber(jumlahkan_total_diskon.toFixed(0)));
    // total
    $(".jumlah_total_pembelian").text(formatNumber(jumlahkan_jumlah));
    $(".sub_total_pembelian").text("Rp." + formatNumber(jumlahkan_total) + "");
    var tax = $(".total_tax").val();
    var subjumlah = Math.round(jumlahkan_total - jumlahkan_total_diskon);
    var g_total = Math.round(((jumlahkan_total - jumlahkan_total_diskon) + (jumlahkan_total - jumlahkan_total_diskon) * tax / 100));
    $(".total_pembelian").text("Rp." + formatNumber(g_total.toFixed(0)) + "");
    $(".total_pembelian").attr("id", g_total);
    $(".sub_total_pembelian").attr("id", jumlahkan_total);
    $(".total_form").val(g_total);
    $(".sub_total_form").val(jumlahkan_total);
    // total_diskon
    $(".total_diskon_pembelian").text("Rp." + formatNumber(jumlahkan_total_diskon.toFixed(0)) + ",-");
    $(".sub_total_diskon_pembelian").text("Rp." + formatNumber(jumlahkan_total_diskon.toFixed(0)) + "");
    $(".total_diskon_pembelian").attr("id", jumlahkan_total_diskon);
    $(".sub_total_diskon_pembelian").attr("id", jumlahkan_total_diskon);
    $(".total_diskon_form").val(jumlahkan_total_diskon);
    $(".sub_total_diskon_form").val(jumlahkan_total_diskon);
    $(".subjumlah_form").val(subjumlah);
    // kosongkan
    // isi di table penjualan
    $(".pembelian_jumlah").attr("id", jumlahkan_jumlah);
    $(".pembelian_harga").attr("id", jumlahkan_harga);
    $(".pembelian_total").attr("id", jumlahkan_total);
    $(".pembelian_diskon").attr("id", jumlahkan_diskon);
    $(".pembelian_total_diskon").attr("id", jumlahkan_total_diskon);
    // tulis di table penjualan
    $(".pembelian_jumlah").text(formatNumber(jumlahkan_jumlah));
    $(".pembelian_total").text("Rp." + formatNumber(jumlahkan_total));

    //$(".pembelian_total_diskon").text("Rp." + formatNumber(jumlahkan_total_diskon.toFixed(0)));
    $(".pembelian_total_diskon").text("Rp." + formatNumber(g_total.toFixed(0)) + "");

    // update Tax
    var tax = $(".total_tax").val();
    if (tax.length != 0 && tax != "") {
      var sub_total = $(".sub_total_pembelian").attr("id");
      var total_diskon = $(".sub_total_diskon_pembelian").attr("id");
      var hasil_tax = Math.round((sub_total - total_diskon) * (tax / 100));
      $(".hasil_tax").text("Rp." + formatNumber(hasil_tax.toFixed(0)) + "");
      $(".hasil_tax_form").val(hasil_tax.toFixed(0));
    } else {
      var sub_total_pembelian = $(".sub_total_pembelian").attr("id");
      $(".total_pembelian").attr("id", sub_total_pembelian);
      $(".total_pembelian").text("Rp." + formatNumber(sub_total_pembelian) + ",-");
    }
    $(".tombol-edit-penjualan").click();
    $('#tombolAplikasi').attr('disabled', 'disabled');
    $('#tombol-simpan').attr('disabled', 'disabled');
    $('#tombol-simpan2').attr('disabled', 'disabled');
    // $('#tombolPayment').removeAttr('disabled');
    $("#table-pembelian tr").removeClass('bg-yellow');
    paymenttotalkembali();
  }

  function ubah_harga_online(id, value, satuan_awal) {

    function number_format23(number) {
      return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function formatNumber(num) {
      return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    }
    var existingRow = $("#table-pembelian").find("tr[id='tr_" + id + "_" + satuan_awal + "']");
    var satuan_awal = $(existingRow).find('.transaksi_satuan_awal').val();
    var existingJumlah = parseInt(existingRow.find('.transaksi_jumlah').val());
    var harga_dasar = value;

    var diskon = parseInt($(existingRow).find('.transaksi_diskon').val());
    $(existingRow).find('.transaksi_harga').val(harga_dasar);

    var qty = parseInt(existingRow.find('.transaksi_satuan_qty').val());
    var harga_jumlah = harga_dasar * existingJumlah;
    var existing_harga_total = existingJumlah * harga_dasar;

    //var existing_diskon_total = existingJumlah * qty * diskon;
    var existing_diskon_total = diskon;

    // Update the row with the new values and other data
    existingRow.find('.transaksi_jumlah').val(existingJumlah);
    existingRow.find('.transaksi_total').val(existing_harga_total);
    existingRow.find('.transaksi_total_diskon').val(existing_diskon_total);
    existingRow.find('.transaksi_harga').val(harga_dasar);
    existingRow.find('.tombol-hapus-penjualan').attr("jumlah", existingJumlah);
    existingRow.find('.tombol-hapus-penjualan').attr("total", existing_harga_total);
    existingRow.find('.tombol-hapus-penjualan').attr("total_diskon", existing_diskon_total);
    existingRow.find('.tombol-hapus-penjualan').attr("harga", harga_dasar);
    existingRow.find('td:eq(2) input').val(existingJumlah);
    existingRow.find('td:eq(3) input').val(harga_dasar);
    // existingRow.find('td:eq(5)').html(number_format23(qty));
    existingRow.find('td:eq(6)').html(number_format23(existing_harga_total));
    // existingRow.find('td:eq(8)').html(number_format23(existing_diskon_total));
    existingRow.find('td:eq(8)').html(number_format23(existing_harga_total - existing_diskon_total));
    // update total pembelian
    var tabel_pembelian = $("#table-pembelian tbody tr");
    var jumlahkan_jumlah = 0;
    var jumlahkan_harga = harga_dasar;
    var jumlahkan_total = 0;
    var jumlahkan_diskon = diskon;
    var jumlahkan_total_diskon = 0;
    // Jumlahkan jumlah : 1, jumlahkan_harga : NaN, jumlahkan_total : 13200, jumlahkan_diskon : NaN, jumlahkan_total_diskon : 1000
    tabel_pembelian.each(function(i, el) {
      jumlahkan_jumlah += parseInt($(el).find('.transaksi_jumlah').val());
      jumlahkan_total += parseInt($(el).find('.transaksi_total').val());
      //jumlahkan_total_diskon += parseInt($(el).find('.transaksi_total_diskon').val());

      jumlahkan_total_diskon += parseInt($(el).find('.transaksi_diskon').val());
    });
    // jumlahkan pembelian
    // isi di table penjualan
    $(".pembelian_jumlah").attr("id", jumlahkan_jumlah);
    $(".pembelian_harga").attr("id", jumlahkan_harga);
    $(".pembelian_total").attr("id", jumlahkan_total);
    $(".pembelian_diskon").attr("id", jumlahkan_diskon);
    $(".pembelian_total_diskon").attr("id", jumlahkan_total_diskon);
    // tulis di table penjualan
    $(".pembelian_jumlah").text(formatNumber(jumlahkan_jumlah));
    $(".pembelian_total").text("Rp." + formatNumber(jumlahkan_total));
    $(".pembelian_total_diskon").text("Rp." + formatNumber(jumlahkan_total_diskon.toFixed(0)));
    // total
    $(".jumlah_total_pembelian").text(formatNumber(jumlahkan_jumlah));
    $(".sub_total_pembelian").text("Rp." + formatNumber(jumlahkan_total) + "");
    var tax = $(".total_tax").val();
    var subjumlah = Math.round(jumlahkan_total - jumlahkan_total_diskon);
    var g_total = Math.round(((jumlahkan_total - jumlahkan_total_diskon) + (jumlahkan_total - jumlahkan_total_diskon) * tax / 100));
    $(".total_pembelian").text("Rp." + formatNumber(g_total.toFixed(0)) + "");
    $(".total_pembelian").attr("id", g_total);
    $(".sub_total_pembelian").attr("id", jumlahkan_total);
    $(".total_form").val(g_total);
    $(".sub_total_form").val(jumlahkan_total);
    // total_diskon
    $(".total_diskon_pembelian").text("Rp." + formatNumber(jumlahkan_total_diskon.toFixed(0)) + ",-");
    $(".sub_total_diskon_pembelian").text("Rp." + formatNumber(jumlahkan_total_diskon.toFixed(0)) + "");
    $(".total_diskon_pembelian").attr("id", jumlahkan_total_diskon);
    $(".sub_total_diskon_pembelian").attr("id", jumlahkan_total_diskon);
    $(".total_diskon_form").val(jumlahkan_total_diskon);
    $(".sub_total_diskon_form").val(jumlahkan_total_diskon);
    $(".subjumlah_form").val(subjumlah);
    // kosongkan
    // isi di table penjualan
    $(".pembelian_jumlah").attr("id", jumlahkan_jumlah);
    $(".pembelian_harga").attr("id", jumlahkan_harga);
    $(".pembelian_total").attr("id", jumlahkan_total);
    $(".pembelian_diskon").attr("id", jumlahkan_diskon);
    $(".pembelian_total_diskon").attr("id", jumlahkan_total_diskon);
    // tulis di table penjualan
    $(".pembelian_jumlah").text(formatNumber(jumlahkan_jumlah));
    $(".pembelian_total").text("Rp." + formatNumber(jumlahkan_total));

    //$(".pembelian_total_diskon").text("Rp." + formatNumber(jumlahkan_total_diskon.toFixed(0)));
    $(".pembelian_total_diskon").text("Rp." + formatNumber(g_total.toFixed(0)) + "");

    // update Tax
    var tax = $(".total_tax").val();
    if (tax.length != 0 && tax != "") {
      var sub_total = $(".sub_total_pembelian").attr("id");
      var total_diskon = $(".sub_total_diskon_pembelian").attr("id");
      var hasil_tax = Math.round((sub_total - total_diskon) * (tax / 100));
      $(".hasil_tax").text("Rp." + formatNumber(hasil_tax.toFixed(0)) + "");
      $(".hasil_tax_form").val(hasil_tax.toFixed(0));
    } else {
      var sub_total_pembelian = $(".sub_total_pembelian").attr("id");
      $(".total_pembelian").attr("id", sub_total_pembelian);
      $(".total_pembelian").text("Rp." + formatNumber(sub_total_pembelian) + ",-");
    }
    $(".tombol-edit-penjualan").click();
    $('#tombolAplikasi').attr('disabled', 'disabled');
    $('#tombol-simpan').attr('disabled', 'disabled');
    $('#tombol-simpan2').attr('disabled', 'disabled');
    // $('#tombolPayment').removeAttr('disabled');
    $("#table-pembelian tr").removeClass('bg-yellow');
    paymenttotalkembali();
  }

  function tambah_keterangan(id, value, satuan_awal) {

    function number_format23(number) {
      return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function formatNumber(num) {
      return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    }
    var existingRow = $("#table-pembelian").find("tr[id='tr_" + id + "_" + satuan_awal + "']");
    var satuan_awal = $(existingRow).find('.transaksi_satuan_awal').val();
    var existingJumlah = parseInt(existingRow.find('.transaksi_jumlah').val());
    var harga_dasar = parseInt($(existingRow).find('.transaksi_harga').val());
    var diskon = parseInt(existingRow.find('.transaksi_diskon').val());
    $(existingRow).find('.transaksi_diskon').val(diskon);
    var keterangan = value;


    var qty = parseInt(existingRow.find('.transaksi_satuan_qty').val());
    var harga_jumlah = harga_dasar * existingJumlah;
    var existing_harga_total = existingJumlah * harga_dasar;

    //var existing_diskon_total = existingJumlah * qty * diskon;
    var existing_diskon_total = diskon;

    // Update the row with the new values and other data
    existingRow.find('.transaksi_ket').val(keterangan);
    existingRow.find('.transaksi_jumlah').val(existingJumlah);
    existingRow.find('.transaksi_total').val(existing_harga_total);
    existingRow.find('.transaksi_total_diskon').val(existing_diskon_total);
    existingRow.find('.transaksi_harga').val(harga_dasar);
    existingRow.find('.tombol-hapus-penjualan').attr("jumlah", existingJumlah);
    existingRow.find('.tombol-hapus-penjualan').attr("total", existing_harga_total);
    existingRow.find('.tombol-hapus-penjualan').attr("total_diskon", existing_diskon_total);
    existingRow.find('.tombol-hapus-penjualan').attr("harga", harga_dasar);
    existingRow.find('td:eq(2) input').val(existingJumlah);
    existingRow.find('td:eq(3) input').val(harga_dasar);
    // existingRow.find('td:eq(3)').html(number_format23(harga_dasar)); // benerin sama existingRow.find('td:eq(3)').html(number_format23(harga_jumlah));
    // existingRow.find('td:eq(5)').html(number_format23(qty));
    existingRow.find('td:eq(6)').html(number_format23(existing_harga_total));
    // existingRow.find('td:eq(8)').html(number_format23(existing_diskon_total));
    existingRow.find('td:eq(8)').html(number_format23(existing_harga_total - existing_diskon_total));
    // update total pembelian
    var tabel_pembelian = $("#table-pembelian tbody tr");
    var jumlahkan_jumlah = 0;
    var jumlahkan_harga = harga_dasar;
    var jumlahkan_total = 0;
    var jumlahkan_diskon = diskon;
    var jumlahkan_total_diskon = 0;
    // Jumlahkan jumlah : 1, jumlahkan_harga : NaN, jumlahkan_total : 13200, jumlahkan_diskon : NaN, jumlahkan_total_diskon : 1000
    tabel_pembelian.each(function(i, el) {
      jumlahkan_jumlah += parseInt($(el).find('.transaksi_jumlah').val());
      jumlahkan_total += parseInt($(el).find('.transaksi_total').val());
      //jumlahkan_total_diskon += parseInt($(el).find('.transaksi_total_diskon').val());

      jumlahkan_total_diskon += parseInt($(el).find('.transaksi_diskon').val());
    });
    // jumlahkan pembelian
    // isi di table penjualan
    $(".pembelian_jumlah").attr("id", jumlahkan_jumlah);
    $(".pembelian_harga").attr("id", jumlahkan_harga);
    $(".pembelian_total").attr("id", jumlahkan_total);
    $(".pembelian_diskon").attr("id", jumlahkan_diskon);
    $(".pembelian_total_diskon").attr("id", jumlahkan_total_diskon);
    // tulis di table penjualan
    $(".pembelian_jumlah").text(formatNumber(jumlahkan_jumlah));
    $(".pembelian_total").text("Rp." + formatNumber(jumlahkan_total));
    $(".pembelian_total_diskon").text("Rp." + formatNumber(jumlahkan_total_diskon.toFixed(0)));
    // total
    $(".jumlah_total_pembelian").text(formatNumber(jumlahkan_jumlah));
    $(".sub_total_pembelian").text("Rp." + formatNumber(jumlahkan_total) + "");
    var tax = $(".total_tax").val();
    var subjumlah = Math.round(jumlahkan_total - jumlahkan_total_diskon);
    var g_total = Math.round(((jumlahkan_total - jumlahkan_total_diskon) + (jumlahkan_total - jumlahkan_total_diskon) * tax / 100));
    $(".total_pembelian").text("Rp." + formatNumber(g_total.toFixed(0)) + "");
    $(".total_pembelian").attr("id", g_total);
    $(".sub_total_pembelian").attr("id", jumlahkan_total);
    $(".total_form").val(g_total);
    $(".sub_total_form").val(jumlahkan_total);
    // total_diskon
    $(".total_diskon_pembelian").text("Rp." + formatNumber(jumlahkan_total_diskon.toFixed(0)) + ",-");
    $(".sub_total_diskon_pembelian").text("Rp." + formatNumber(jumlahkan_total_diskon.toFixed(0)) + "");
    $(".total_diskon_pembelian").attr("id", jumlahkan_total_diskon);
    $(".sub_total_diskon_pembelian").attr("id", jumlahkan_total_diskon);
    $(".total_diskon_form").val(jumlahkan_total_diskon);
    $(".sub_total_diskon_form").val(jumlahkan_total_diskon);
    $(".subjumlah_form").val(subjumlah);
    // kosongkan
    // isi di table penjualan
    $(".pembelian_jumlah").attr("id", jumlahkan_jumlah);
    $(".pembelian_harga").attr("id", jumlahkan_harga);
    $(".pembelian_total").attr("id", jumlahkan_total);
    $(".pembelian_diskon").attr("id", jumlahkan_diskon);
    $(".pembelian_total_diskon").attr("id", jumlahkan_total_diskon);
    // tulis di table penjualan
    $(".pembelian_jumlah").text(formatNumber(jumlahkan_jumlah));
    $(".pembelian_total").text("Rp." + formatNumber(jumlahkan_total));

    //$(".pembelian_total_diskon").text("Rp." + formatNumber(jumlahkan_total_diskon.toFixed(0)));
    $(".pembelian_total_diskon").text("Rp." + formatNumber(g_total.toFixed(0)) + "");

    // update Tax
    var tax = $(".total_tax").val();
    if (tax.length != 0 && tax != "") {
      var sub_total = $(".sub_total_pembelian").attr("id");
      var total_diskon = $(".sub_total_diskon_pembelian").attr("id");
      var hasil_tax = Math.round((sub_total - total_diskon) * (tax / 100));
      $(".hasil_tax").text("Rp." + formatNumber(hasil_tax.toFixed(0)) + "");
      $(".hasil_tax_form").val(hasil_tax.toFixed(0));
    } else {
      var sub_total_pembelian = $(".sub_total_pembelian").attr("id");
      $(".total_pembelian").attr("id", sub_total_pembelian);
      $(".total_pembelian").text("Rp." + formatNumber(sub_total_pembelian) + ",-");
    }
    $(".tombol-edit-penjualan").click();
    $('#tombolAplikasi').attr('disabled', 'disabled');
    $('#tombol-simpan').attr('disabled', 'disabled');
    $('#tombol-simpan2').attr('disabled', 'disabled');
    // $('#tombolPayment').removeAttr('disabled');
    $("#table-pembelian tr").removeClass('bg-yellow');
    paymenttotalkembali();
  }

  function focus_input(id, satuan) {
    $("#table-pembelian tr#tr_" + id + "_" + satuan).removeClass('bg-yellow');
    $("#table-pembelian").find("tr[id='tr_" + id + "_" + satuan + "']").addClass('bg-yellow');
  }

  function initializeTabelMember(params = '') {
    let tabel_member = $('.tabel-member tbody');
    tabel_member.empty();
    $.get('route/data_kasir/ajax_member.php?action=getall&search=' + params, function(response) {
      if (response.status) {
        let data = response.data;
        data.forEach((member, i) => {
          // buat button untuk edit dan hapus berdasarkan id
          let act = `<button class="btn btn-sm btn-success mr-2" type="button" onclick="pilihMember('${member.nama}', '${member.kd_member}')"><i class="fa fa-check mr-2"></i></button><button class="btn btn-primary btn-sm mr-2" type="button" onclick="editMember('${member.kd_member}')"><i class="fa fa-edit mr-2"></i></button><button class="btn btn-danger btn-sm" type="button" onclick="deleteMember('${member.kd_member}')"><i class="fa fa-trash mr-2"></i></button>`;
          let button_pilih = ``
          tabel_member.append(`
                              <tr>
                                <td>${i+1}</td>
                                <td>${member.kd_member}</td>
                                <td>${member.nama}</td>
                                <td>${member.telp}</td>
                                <td>${member.alamat}</td>
                                <td>${member.nama_kat}</td>
                                <td class="text-left">${act}</td>
                                `);
        });
      } else {
        tabel_member.append(`<tr>
                                <td colspan="6" class="text-center">Data member tidak ditemukan</td>
                              </tr>`);
      }
    });
  }

  function deleteMember(params) {
    Swal.fire({
      title: "Yakin ingin menghapus member " + params + " ?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya",
      cancelButtonText: "Tidak"
    }).then((result) => {
      if (result.value) {
        let kode_member = params;
        $.ajax({
          type: 'POST',
          url: "route/data_kasir/ajax_member.php?action=delete",
          data: {
            "kode_member": kode_member
          },
          success: function(res) {
            console.log(res);
            if (res.status) {
              initializeTabelMember();
              Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Member berhasil dihapus',
                showConfirmButton: false,
                timer: 1500
              });
            } else {
              console.log(res);
            }
          },
          error: function(xhr, ajaxOptions, thrownError) {
            console.log(xhr.responseText);
          }
        });
      }
    });
  }

  function editMember(params) {
    $.get('route/data_kasir/ajax_member.php?action=get&kode=' + params, function(response) {
      let data = response.data;

      $('#modal-member').data('id', data.id);
      $('#modal-member #kode_member').val(data.kd_member);
      $('#modal-member #kode_member').prop('readonly', true);

      $('#modal-member #nama').val(data.nama);
      $('#modal-member #telepon').val(data.telp);
      $('#modal-member #alamat').val(data.alamat);
      $('#modal-member #kelurahan').val(data.kelurahan);
      $('#modal-member #kecamatan').val(data.kecamatan);
      $('#modal-member #kabupaten').val(data.kabupaten);
      $('#modal-member #provinsi').val(data.provinsi);
      $('#modal-member #keterangan').val(data.member_ket);
      $('.form-member').show();
      $('#btn-batal-member').hide();
      $('#btn-daftar-member').hide();
      $('#btn-save-member').hide();
      $('.data-tabel-member').hide();
      $('#btn-kembali-member').hide();
      $('#btn-update-member').show();
    });
  }

  function pilihMember(nama, telp) {
    console.log(nama);

    $('input#nama_member').val(nama);
    $('input#tampil_aplikasi_keterangan').val(telp).trigger('input');
    // tutup modal
    $('#modal-member').modal('hide');
  }
  //kategori
  function initializeTabelKategori(params = '') {
    let tabel_kategori = $('.tabel-kategori tbody');
    tabel_kategori.empty();
    $.get('route/data_kasir/ajax_kategori.php?action=getall&search=' + params, function(response) {
      if (response.status) {
        let data = response.data;
        data.forEach((kategori, i) => {
          // buat button untuk edit dan hapus berdasarkan id
          let act = `<button class="btn btn-sm btn-success mr-2" type="button" onclick="editKategori('${kategori.id_kat}')"><i class="fa fa-edit mr-2"></i></button><button class="btn btn-danger btn-sm" type="button" onclick="deleteKategori('${kategori.id_kat}')"><i class="fa fa-trash mr-2"></i></button>`;
          let button_pilih = ``
          tabel_kategori.append(`
                              <tr>
                                <td>${kategori.id_kat}</td>
                                <td>${kategori.Retail} %</td>
                                <td>${kategori.Grosir} %</td>
                                <td>${kategori.Online} %</td>
                                <td>${kategori.MR} %</td>
                                <td>${kategori.MG} %</td>
                                <td>${act}</td>
                                `);
        });
      } else {
        tabel_kategori.append(`<tr>
                                <td colspan="6" class="text-center">Data kategori tidak ditemukan</td>
                              </tr>`);
      }
    });
  }

  function deleteKategori(params) {
    Swal.fire({
      title: "Yakin ingin menghapus kategori " + params + " ?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya",
      cancelButtonText: "Tidak"
    }).then((result) => {
      if (result.value) {
        let id_kat = params;
        $.ajax({
          type: 'POST',
          url: "route/data_kasir/ajax_kategori.php?action=delete",
          data: {
            "id_kat": id_kat
          },
          success: function(res) {
            console.log(res);
            if (res.status) {
              initializeTabelKategori();
              Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'kategori berhasil dihapus',
                showConfirmButton: false,
                timer: 1500
              });
            } else {
              console.log(res);
            }
          },
          error: function(xhr, ajaxOptions, thrownError) {
            console.log(xhr.responseText);
          }
        });
      }
    });
  }

  function editKategori(params) {
    $.get('route/data_kasir/ajax_kategori.php?action=get&kode=' + params, function(response) {
      let data = response.data;

      $('#modal-kategori #id_kat').val(data.id_kat);
      $('#modal-kategori #Retail').val(data.Retail);
      $('#modal-kategori #Grosir').val(data.Grosir);
      $('#modal-kategori #Online').val(data.Online);
      $('#modal-kategori #MR').val(data.MR);
      $('#modal-kategori #MG').val(data.MG);
      $('.form-kategori').show();
      $('#btn-batal-kategori').hide();
      $('#btn-daftar-kategori').hide();
      $('#btn-save-kategori').hide();
      $('.data-tabel-kategori').hide();
      $('#btn-kembali-kategori').hide();
      $('#btn-update-kategori').show();
    });
  }
  //kategori
  $(document).ready(function() {
    $("#tombol-update").hide();
    $("#kalkulator").hide();
    // $("#form_voucher").hide();
    $('#cari_member').keyup(function() {
      let value = $(this).val();
      //if (value.length > 3) {
      initializeTabelMember(value);
    });

    $("#tambahkan_jumlah").keyup(function(event) {
      if (event.keyCode === 13) {
        console.log("berhasil enter")
        $("#tombol-update").click();
      }
    });

    $("#tambahkan_ket").keyup(function(event) {
      if (event.keyCode === 13) {
        console.log("berhasil enter")
        $("#tombol-update").click();
      }
    });

    // modal crud member
    $('#btn-tambah-member').on('click', function() {
      initializeTabelMember();
      $('.form-member').show();
      $('#btn-batal-member').show();
      $('#btn-daftar-member').show();
      $('#btn-save-member').show();
      $('.data-tabel-member').hide();
      $('#btn-kembali-member').hide();
      $('#btn-update-member').hide();
    });

    $('#btn-daftar-member').on('click', function() {
      $('.form-member').hide();
      $('#btn-batal-member').hide();
      $('#btn-daftar-member').hide();
      $('#btn-save-member').hide();
      $('.data-tabel-member').show();
      $('#btn-kembali-member').show();
      $('#btn-update-member').hide();
    });
    $('#btn-batal-member').on('click', function() {
      $('#modal-member #kode_member').prop('readonly', false);
      $('.form-member').show();
      $('#btn-batal-member').show();
      $('#btn-daftar-member').show();
      $('#btn-save-member').show();
      $('.data-tabel-member').hide();
      $('#btn-kembali-member').hide();
      $('#btn-update-member').hide();
      $('#modal-member #kode_member').val("");
      $('#modal-member #nama').val("");
      $('#modal-member #telepon').val("");
      $('#modal-member #alamat').val("");
      $('#modal-member #kelurahan').val("");
      $('#modal-member #kecamatan').val("");
      $('#modal-member #kabupaten').val("");
      $('#modal-member #provinsi').val("");
    });
    $('#button-close').on('click', function() {
      $('#modal-member #kode_member').prop('readonly', false);
      $('.form-member').show();
      $('#btn-batal-member').show();
      $('#btn-daftar-member').show();
      $('#btn-save-member').show();
      $('.data-tabel-member').hide();
      $('#btn-kembali-member').hide();
      $('#btn-update-member').hide();
      $('#modal-member #kode_member').val("");
      $('#modal-member #nama').val("");
      $('#modal-member #telepon').val("");
      $('#modal-member #alamat').val("");
      $('#modal-member #kelurahan').val("");
      $('#modal-member #kecamatan').val("");
      $('#modal-member #kabupaten').val("");
      $('#modal-member #provinsi').val("");
    });

    $('#btn-kembali-member').on('click', function() {
      $('#modal-member #kode_member').prop('readonly', false);
      $('.form-member').show();
      $('#btn-batal-member').show();
      $('#btn-daftar-member').show();
      $('#btn-save-member').show();
      $('.data-tabel-member').hide();
      $('#btn-kembali-member').hide();
      $('#btn-update-member').hide();
      $('#modal-member #kode_member').val("");
      $('#modal-member #nama').val("");
      $('#modal-member #telepon').val("");
      $('#modal-member #alamat').val("");
      $('#modal-member #kelurahan').val("");
      $('#modal-member #kecamatan').val("");
      $('#modal-member #kabupaten').val("");
      $('#modal-member #provinsi').val("");
    });

    $('#btn-update-member').on('click', function() {
      let kode_member = $('#modal-member #kode_member').val();
      let nama = $('#modal-member #nama').val();
      let telepon = $('#modal-member #telepon').val();
      let alamat = $('#modal-member #alamat').val();
      let kelurahan = $('#modal-member #kelurahan').val();
      let kecamatan = $('#modal-member #kecamatan').val();
      let kabupaten = $('#modal-member #kabupaten').val();
      let provinsi = $('#modal-member #provinsi').val();
      let member_ket = $('#modal-member #keterangan').val();
      let id = $('#modal-member').data('id');

      // cek kode dan nama tidak boleh kosong
      if (kode_member == '' || nama == '') {
        alert('Kode Member dan Nama harus diisi');
        return false;
      } else {
        $.ajax({
          type: 'POST',
          url: "route/data_kasir/ajax_member.php?action=update",
          data: {
            "kode_member": kode_member,
            "nama": nama,
            "telepon": telepon,
            "alamat": alamat,
            "kelurahan": kelurahan,
            "kecamatan": kecamatan,
            "kabupaten": kabupaten,
            "provinsi": provinsi,
            "member_ket": member_ket,
            "id": id
          },
          success: function(res) {
            if (res.status) {
              $('#modal-member #kode_member').val("");
              $('#modal-member #nama').val("");
              $('#modal-member #telepon').val("");
              $('#modal-member #alamat').val("");
              $('#modal-member #kelurahan').val("");
              $('#modal-member #kecamatan').val("");
              $('#modal-member #kabupaten').val("");
              $('#modal-member #provinsi').val("");
              $('.form-member').hide();
              $('#btn-batal-member').show();
              $('#btn-daftar-member').hide();
              $('#btn-save-member').hide();
              $('.data-tabel-member').show();
              $('#btn-kembali-member').show();
              $('#btn-update-member').hide();
              initializeTabelMember();
              Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Member berhasil diedit',
                showConfirmButton: false,
                timer: 1500
              });
            } else {
              console.log(res);
            }
          },
          error: function(xhr, ajaxOptions, thrownError) {
            console.log(xhr.responseText);
          }
        });
      }
    });

    $('#btn-save-member').on('click', function() {
      let kode_member = $('#modal-member #kode_member').val();
      let nama = $('#modal-member #nama').val();
      let telepon = $('#modal-member #telepon').val();
      let alamat = $('#modal-member #alamat').val();
      let kelurahan = $('#modal-member #kelurahan').val();
      let kecamatan = $('#modal-member #kecamatan').val();
      let kabupaten = $('#modal-member #kabupaten').val();
      let provinsi = $('#modal-member #provinsi').val();
      let member_ket = $('#modal-member #keterangan').val();

      let kodeteleponmember = true;
      <?php
      $query = mysqli_query($koneksi, "SELECT kd_member FROM member");
      while ($j = mysqli_fetch_array($query)) { ?>
        if (kode_member == "<?php echo $j['kd_member'] ?>") {
          kodeteleponmember = false;
        }
      <?php
      } ?>
      // cek kode dan nama tidak boleh kosong
      if (kode_member == '' || nama == '') {
        alert('Kode Member dan Nama harus diisi');
        return false;
      } else if (!kodeteleponmember) {
        alert('Nomor handphone sudah terdaftar menjadi member');
        return false;
      } else {
        $.ajax({
          type: 'POST',
          url: "route/data_kasir/ajax_member.php?action=save",
          data: {
            "kode_member": kode_member,
            "nama": nama,
            "telepon": telepon,
            "alamat": alamat,
            "kelurahan": kelurahan,
            "kecamatan": kecamatan,
            "kabupaten": kabupaten,
            "provinsi": provinsi,
            "member_ket": member_ket

          },
          success: function(res) {
            if (res.status) {
              $('#modal-member').modal('hide');
              $('#modal-member #kode_member').val("");
              $('#modal-member #nama').val("");
              $('#modal-member #telepon').val("");
              $('#modal-member #alamat').val("");
              $('#modal-member #kelurahan').val("");
              $('#modal-member #kecamatan').val("");
              $('#modal-member #kabupaten').val("");
              $('#modal-member #provinsi').val("");
              Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Member berhasil ditambahkan',
                showConfirmButton: false,
                timer: 1500
              }).then(() => {
                location.reload(); // Refresh the page after alert closes
              });
            } else {
              console.log(res);
            }
          },
          error: function(xhr, ajaxOptions, thrownError) {
            console.log(xhr.responseText);
          }
        });
      }
    });

    //crud kategori
    $('#btn-tambah-kategori').on('click', function() {
      initializeTabelKategori();
      $('.form-kategori').show();
      $('#btn-batal-kategori').show();
      $('#btn-daftar-kategori').show();
      $('#btn-save-kategori').show();
      $('.data-tabel-kategori').hide();
      $('#btn-kembali-kategori').hide();
      $('#btn-update-kategori').hide();
    });

    $('#btn-daftar-kategori').on('click', function() {
      $('.form-kategori').hide();
      $('#btn-batal-kategori').hide();
      $('#btn-daftar-kategori').hide();
      $('#btn-save-kategori').hide();
      $('.data-tabel-kategori').show();
      $('#btn-kembali-kategori').show();
      $('#btn-update-kategori').hide();
    });

    $('#btn-kembali-kategori').on('click', function() {
      $('.form-kategori').show();
      $('#btn-batal-kategori').show();
      $('#btn-daftar-kategori').show();
      $('#btn-save-kategori').show();
      $('.data-tabel-kategori').hide();
      $('#btn-kembali-kategori').hide();
      $('#btn-update-kategori').hide();
      $('#modal-kategori #id_kat').val("");
      $('#modal-kategori #Retail').val("");
      $('#modal-kategori #Grosir').val("");
      $('#modal-kategori #Online').val("");
      $('#modal-kategori #MR').val("");
      $('#modal-kategori #MG').val("");
    });

    $('#btn-update-kategori').on('click', function() {
      let id_kat = $('#modal-kategori #id_kat').val();
      let Retail = $('#modal-kategori #Retail').val();
      let Grosir = $('#modal-kategori #Grosir').val();
      let Online = $('#modal-kategori #Online').val();
      let MR = $('#modal-kategori #MR').val();
      let MG = $('#modal-kategori #MG').val();

      if (id_kat == '') {
        alert('Kode kategori harus diisi');
        return false;
      } else {
        $.ajax({
          type: 'POST',
          url: "route/data_kasir/ajax_kategori.php?action=update",
          data: {
            "Retail": Retail,
            "Grosir": Grosir,
            "Online": Online,
            "MR": MR,
            "MG": MG,
            "id_kat": id_kat
          },
          success: function(res) {
            if (res.status) {
              $('#modal-kategori #id_kat').val("");
              $('#modal-kategori #Retail').val("");
              $('#modal-kategori #Grosir').val("");
              $('#modal-kategori #Online').val("");
              $('#modal-kategori #MR').val("");
              $('#modal-kategori #MG').val("");
              $('.form-kategori').hide();
              $('#btn-batal-kategori').show();
              $('#btn-daftar-kategori').hide();
              $('#btn-save-kategori').hide();
              $('.data-tabel-kategori').show();
              $('#btn-kembali-kategori').show();
              $('#btn-update-kategori').hide();
              initializeTabelKategori();
              Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Member berhasil diedit',
                showConfirmButton: false,
                timer: 1500
              });
            } else {
              console.log(res);
            }
          },
          error: function(xhr, ajaxOptions, thrownError) {
            console.log(xhr.responseText);
          }
        });
      }
    });

    $('#btn-save-kategori').on('click', function() {
      let id_kat = $('#modal-kategori #id_kat').val();
      let Retail = $('#modal-kategori #Retail').val();
      let Grosir = $('#modal-kategori #Grosir').val();
      let Online = $('#modal-kategori #Online').val();
      let MR = $('#modal-kategori #MR').val();
      let MG = $('#modal-kategori #MG').val();

      if (id_kat == '') {
        alert('Kode kategori kosong');
        return false;
      } else {
        $.ajax({
          type: 'POST',
          url: "route/data_kasir/ajax_kategori.php?action=save",
          data: {
            "id_kat": id_kat,
            "Retail": Retail,
            "Grosir": Grosir,
            "Online": Online,
            "MR": MR,
            "MG": MG
          },
          success: function(res) {
            if (res.status) {
              $('#modal-kategori').modal('hide');
              $('#modal-kategori #id_kat').val("");
              $('#modal-kategori #Retail').val("");
              $('#modal-kategori #Grosir').val("");
              $('#modal-kategori #Online').val("");
              $('#modal-kategori #MR').val("");
              $('#modal-kategori #MG').val("");

              Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'kategori berhasil ditambahkan',
                showConfirmButton: false,
                timer: 1500
              });
            } else {
              console.log(res);
            }
          },
          error: function(xhr, ajaxOptions, thrownError) {
            console.log(xhr.responseText);
          }
        });
      }
    });

    function handleKeyPress(event) {
      if (event.keyCode === 13 && document.getElementById("lbl_status_pembayaran").innerHTML !== "L U N A S") {
        $("#tombol-update").click();
      } else if (event.keyCode === 13 && $("#layerpayment").is(":visible") && document.getElementById("lbl_status_pembayaran").innerHTML === "L U N A S") {
        close_pembayaran()
      }
    }
    document.addEventListener('keypress', handleKeyPress);

    function formatNumber(num) {
      num = Number(num);
      if (Number.isInteger(num)) {
        return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      } else {
        num = num.toFixed(2);
        let parts = num.split(".");
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        return parts.join(".");
      }
      // benerin return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    }

    $('#tampil_aplikasi_keterangan').on('input', function() {
      let value = $(this).val();
      $.get('route/data_kasir/ajax_member.php?action=get&kode=' + value, function(response) {
        // nama_member
        if (response.status) {
          $('#nama_member').val(response['nama']);
          if (response['member_ket'] == 4) {
            document.getElementById("member_kategori").innerHTML = "Member Silver";
            MS();
          } else if (response['member_ket'] == 5) {
            document.getElementById("member_kategori").innerHTML = "Member Gold";
            MG();
          } else if (response['member_ket'] == 6) {
            document.getElementById("member_kategori").innerHTML = "Member Platinum";
            MP();
          }
          // let row = $(`#table-pembelian tbody tr`);
          // if (row.length > 0) {
          //   let jumlahkan_total_diskon = 0;

          //   function number_format23(number) {
          //     return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
          //   }

          //   row.each(function(i, el) {
          //     let kd_brg = $(el).find('.transaksi_produk').val();
          //     let satuan = $(el).find('select#transaksi_satuan_' + kd_brg).val();
          //     //new
          //     let status_member = response['member_ket'];
          //     let kd_value = $(el).find('.transaksi_jumlah').val();
          //     let kd_satuan = $(el).find('.transaksi_satuan_awal').val();
          //     let kd_valuesatuan = $(el).find('.transaksi_satuan_qty').val();

          //     //
          //     let diskon_total = parseInt($(el).find('.transaksi_diskon').val());
          //     $.ajax({
          //       type: 'GET',
          //       // sebelumnya  url: 'route/data_kasir/ajax_diskon.php?kode=' + kd_brg + '&satuan=' + satuan,
          //       url: 'route/data_kasir/ajax_diskon.php?kode=' + kd_brg + '&satuan=' + satuan + '&status_member=' + status_member,
          //       dataType: 'json',
          //       async: false,
          //       success: function(response) {
          //         harga_member = response['harga'];
          //       },
          //       error: function(xhr, status, error) {
          //         console.log(xhr.responseText);
          //       }
          //     });
          //     //new
          //     $(el).find('.transaksi_harga').val(harga_member);
          //     $(el).find('td:eq(3) input').val(harga_member);

          //     //$(el).find('td:eq(3)').html(number_format23(harga_member));
          //     ubah_jumlah(kd_brg, kd_value, kd_satuan);
          //     //
          //     jumlahkan_total_diskon += diskon_total;

          //     $(el).find('.transaksi_total_diskon').val(diskon_total);
          //     $(el).find('.tombol-hapus-penjualan').attr("total_diskon", diskon_total);

          //   });

          //   $(".pembelian_total_diskon").attr("id", jumlahkan_total_diskon);
          //   let jumlahkan_total = $(".pembelian_total").attr("id");
          //   var tax = $(".total_tax").val();
          //   $(".pembelian_total_diskon").text("Rp." + formatNumber(jumlahkan_total_diskon.toFixed(0)));
          //   $(".sub_total_pembelian").text("Rp." + formatNumber(jumlahkan_total) + "");

          //   var subjumlah = Math.round(jumlahkan_total - jumlahkan_total_diskon);
          //   var g_total = Math.round(((jumlahkan_total - jumlahkan_total_diskon) + (jumlahkan_total - jumlahkan_total_diskon) * tax / 100));
          //   $(".total_pembelian").text("Rp." + formatNumber(g_total.toFixed(0)) + "");

          //   $(".total_pembelian").attr("id", g_total);
          //   $(".sub_total_pembelian").attr("id", jumlahkan_total);

          //   $(".total_form").val(g_total);
          //   $(".sub_total_form").val(jumlahkan_total);

          //   // total_diskon
          //   $(".total_diskon_pembelian").text("Rp." + formatNumber(jumlahkan_total_diskon.toFixed(0)) + ",-");
          //   $(".sub_total_diskon_pembelian").text("Rp." + formatNumber(jumlahkan_total_diskon.toFixed(0)) + "");
          //   $(".total_diskon_pembelian").attr("id", jumlahkan_total_diskon);
          //   $(".sub_total_diskon_pembelian").attr("id", jumlahkan_total_diskon);

          //   $(".total_diskon_form").val(jumlahkan_total_diskon);
          //   $(".sub_total_diskon_form").val(jumlahkan_total_diskon);
          //   $(".subjumlah_form").val(subjumlah);

          //   // kosongkan
          //   $("#tambahkan_id").val("");
          //   $("#tambahkan_kode").val("");
          //   $("#tambahkan_nama").val("");
          //   $("#tambahkan_jumlah").val("");
          //   $("#tambahkan_harga").val("");
          //   $("#tambahkan_total").val("");
          //   $("#tambahkan_diskon").val("");
          //   $("#tambahkan_total_diskon").val("");
          //   $("#tambahkan_ket").val("");
          //   $("#tambahkan_kd_promo").val("");
          //   $("#tambahkan_harga_dasar").val("");
          //   //$(".pembelian_total_diskon").text("Rp." + formatNumber(jumlahkan_total_diskon.toFixed(0)));
          //   $(".pembelian_total_diskon").text("Rp." + formatNumber(g_total.toFixed(0)) + "");

          //   // update Tax
          //   var tax = $(".total_tax").val();
          //   if (tax.length != 0 && tax != "") {

          //     var sub_total = $(".sub_total_pembelian").attr("id");

          //     var total_diskon = $(".sub_total_diskon_pembelian").attr("id");

          //     var hasil_tax = Math.round((sub_total - total_diskon) * (tax / 100));

          //     $(".hasil_tax").text("Rp." + formatNumber(hasil_tax.toFixed(0)) + "");
          //     $(".hasil_tax_form").val(hasil_tax.toFixed(0));
          //   } else {
          //     var sub_total_pembelian = $(".sub_total_pembelian").attr("id");

          //     $(".total_pembelian").attr("id", sub_total_pembelian);
          //     $(".total_pembelian").text("Rp." + formatNumber(sub_total_pembelian) + ",-");
          //   }
          //   $(".tombol-edit-penjualan").click();

          //   $('#tombolAplikasi').attr('disabled', 'disabled');
          //   $('#tombol-simpan').attr('disabled', 'disabled');
          //   $('#tombol-simpan2').attr('disabled', 'disabled');
          //   // $('#tombolPayment').show();
          //   $('#tombolPayment').removeAttr('disabled');
          //   paymenttotalkembali();
          // }
        } else {
          // Retail();
          console.log('<?php echo $kategori_kasir_harga; ?>' + " asdadasdsdaads");
          <?php if ($kategori_kasir_harga == 2) { ?>
            Grosir();
          <?php } else if ($kategori_kasir_harga == 3) { ?>
            Online();
          <?php } else { ?>
            Retail();
          <?php } ?>
        }
      });
    });

    // pilih produk
    $(document).on("click", ".modal-pilih-produk", function() {
      function scrollToBottom() {
        var div = $(".table-scroll");
        div.scrollTop(div[0].scrollHeight);
      }
      var id = $(this).attr('id');
      var kode = $("#kode_" + id).val();
      var nama = $("#nama_" + id).val();
      var harga = $("#harga_" + id).val();
      console.log(harga);
      var diskon = $("#diskon_" + id).val();

      var ket = $("#ket_" + id).val();
      var kd_promo = $("#kd_promo_" + id).val();
      var harga_dasar = $("#harga_dasar_" + id).val();
      var satuan = $("#satuan_" + id).val();
      var satuan_qty = $("#satuan_qty_" + id).val();
      var satuan_awal = $("#satuan_awal_" + id).val();
      var stockunit = $("#stockunit_" + id).val();
      var kategorilockswalayan = $("#kategorilockswalayan_" + id).val();
      var kategorilockgudang = $("#kategorilockgudang_" + id).val();
      var kategorihargamanual = $("#kategorihargamanual_" + id).val();

      var tax = $(".total_tax").val();
      // console.log(tax);

      $("#tambahkan_id").val(id);
      $("#tambahkan_kode").val(kode);
      $("#tambahkan_nama").val(nama);
      $("#tambahkan_harga").val(harga);
      $("#tambahkan_jumlah").val(1);
      $("#tambahkan_total").val(harga * satuan_qty);
      $("#tambahkan_diskon").val(diskon);
      $("#tambahkan_total_diskon").val(diskon);
      $("#tambahkan_ket").val(ket);
      $("#tambahkan_satuan").val(satuan);
      // $("#tambahkan_kd_promo").val(kd_promo);

      var id = $("#tambahkan_id").val();
      var kode = $("#tambahkan_kode").val();
      var nama = $("#tambahkan_nama").val();
      var harga = $("#tambahkan_harga").val();
      var jumlah = $("#tambahkan_jumlah").val();
      var total = $("#tambahkan_total").val();
      var diskon = $("#tambahkan_diskon").val();
      var total_diskon = diskon;
      var ket = $("#tambahkan_ket").val();
      var satuan = $("#tambahkan_satuan").val();
      var options = "";
      var newJumlah = jumlah;


      $.ajax({
        "url": "./route/data_kasir/ajax_satuan_option.php?id=" + id,
        "type": "GET",
        "dataType": "json",
        "async": false,
        "success": function(response) {
          response.forEach((element, i) => {
            if (i == 0) {
              options += `<option selected>${element}</option>`
            } else {
              options += `<option>${element}</option>`
            }
          });
        },
        "error": function(jqXHR, textStatus, errorThrown) {
          console.log(textStatus, errorThrown);
        }
      });

      let select = `<select class="form-control" id="transaksi_satuan_${id}" name="transaksi_satuan[]" style='width:120px ;border-style: none;font-size: 14px; color: black !important;' onchange="pilih_satuan('${id}', this.value, '${satuan}')">${options}</select>`;

      function doesIdExistInTable(id, satuan) {
        return $("#table-pembelian").find("tr[id='tr_" + id + "_" + satuan + "']").length > 0;
      }

      // function doesSatuanExistInTabel(id, satuan) {
      //   let satuanTr = $(`#table-pembelian tr#tr_${id} td #transaksi_satuan_${id}`).val();
      //   if (satuanTr == satuan) {
      //     return true;
      //   }else{
      //     return false;
      //   }
      // }

      function doesIdTakeAwayexist(id, satuan) {
        var takeaway = $("#table-pembelian").find("tr[id='tr_15-01-09-0001']")
        return takeaway.nextAll("tr[id='tr_" + id + "_" + satuan + "']").length > 0;
      }

      function number_format23(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      }

      if (!doesIdExistInTable('15-01-09-0001') && doesIdExistInTable(id, satuan)) {
        console.log("adddddddddddddd");
        var existingRow = $("#table-pembelian").find("tr[id='tr_" + id + "_" + satuan + "']");
        var existingJumlah = parseInt(existingRow.find('.transaksi_jumlah').val());
        var existingHargaTotal = parseInt(existingRow.find('.transaksi_total').val());
        var existingDiskon = parseInt(existingRow.find('.transaksi_total_diskon').val());
        var existingSatuanQty = parseFloat(existingRow.find('.transaksi_satuan_qty').val());
        var newJumlah = existingJumlah + parseInt(jumlah);
        var newTotal = existingHargaTotal + parseInt(total);
        var newDiskon = parseInt(diskon);

        // Update the row with the new values and other data
        existingRow.find('.transaksi_jumlah').val(newJumlah);
        existingRow.find('.transaksi_total').val(newTotal);
        existingRow.find('.transaksi_total_diskon').val(newDiskon);
        existingRow.find('.tombol-hapus-penjualan').attr("jumlah", newJumlah);
        existingRow.find('.tombol-hapus-penjualan').attr("total", newTotal);
        existingRow.find('.tombol-hapus-penjualan').attr("total_diskon", newDiskon);

        existingRow.find('td:eq(2) input').val(newJumlah);
        existingRow.find('td:eq(6)').html(number_format23(newTotal));
        existingRow.find('td:eq(8)').html(number_format23(newTotal - newDiskon));


      } else if (doesIdExistInTable('15-01-09-0001') && doesIdTakeAwayexist(id, satuan)) {
        var takeaway = $("#table-pembelian").find("tr[id='tr_15-01-09-0001']")
        var existingRow = takeaway.nextAll("tr[id='tr_" + id + "_" + satuan + "']");
        var existingJumlah = parseInt(existingRow.find('.transaksi_jumlah').val());
        var existingHargaTotal = parseInt(existingRow.find('.transaksi_total').val());
        var newJumlah = existingJumlah + parseInt(jumlah);

        var newTotal = existingHargaTotal + parseInt(total);


        // Update the row with the new values and other data
        existingRow.find('.transaksi_jumlah').val(newJumlah);
        existingRow.find('.transaksi_total').val(newTotal);
        existingRow.find('.tombol-hapus-penjualan').attr("jumlah", newJumlah);
        existingRow.find('.tombol-hapus-penjualan').attr("total", newTotal);


        existingRow.find('td:eq(2) input').val(newJumlah);
        existingRow.find('td:eq(5)').html(number_format23(newTotal));


      } else if (doesIdExistInTable('15-01-09-0001') && id == '15-01-09-0001_' + satuan) {
        var existingRow = $("#table-pembelian").find("tr[id='tr_" + id + "']");
        var existingJumlah = parseInt(existingRow.find('.transaksi_jumlah').val());
        var existingHargaTotal = parseInt(existingRow.find('.transaksi_total').val());

        var newJumlah = existingJumlah + parseInt(jumlah);
        var newTotal = existingHargaTotal + parseInt(total);

        // Update the row with the new values and other data
        existingRow.find('.transaksi_jumlah').val(newJumlah);
        existingRow.find('.transaksi_total').val(newTotal);
        existingRow.find('.tombol-hapus-penjualan').attr("jumlah", newJumlah);
        existingRow.find('.tombol-hapus-penjualan').attr("total", newTotal);


        existingRow.find('td:eq(2) input').val(newJumlah);
        existingRow.find('td:eq(5)').html(number_format23(newTotal));


      } else {
        const temporary_filehargaonline = document.getElementById('kd_kategori_harga_online').value;
        if (temporary_filehargaonline == 2) {

          var table_pembelian = "<tr id='tr_" + id + "_" + satuan + "'>" +
            "<td align='left' width='30px'> <span class='btn btn-sm btn-danger tombol-hapus-penjualan' jumlah='" + jumlah + "' harga='" + harga + "' total='" + total + "' diskon='" + diskon + "' total_diskon='" + total_diskon + "' ket='" + ket + "' kd_promo='" + kd_promo + "'id='" + id + "'><i class='fa fa-close'></i></span></td>" +

            "<td> <input type='hidden' class='transaksi_nama' name='transaksi_nama[]' value='" + nama + "'> <input type='hidden' class='transaksi_produk' name='transaksi_produk[]' value='" + id + "'> <input type='hidden' class='transaksi_jumlah' name='transaksi_jumlah[]' value='" + jumlah + "'> <input type='hidden' class='transaksi_harga' name='transaksi_harga[]' value='" + harga + "'> <input type='hidden' class='transaksi_total' name='transaksi_total[]' value='" + total + "'> <input type='hidden' class='transaksi_diskon' name='transaksi_diskon[]' value='" + diskon + "'> <input type='hidden' class='transaksi_total_diskon' name='transaksi_total_diskon[]' value='" + total_diskon + "'> <input type='hidden' class='transaksi_ket' name='transaksi_ket[]' value='" + ket + "'> <input type='hidden' class='transaksi_kd_promo' name='transaksi_kd_promo[]' value='" + kd_promo + "'> <input type='hidden' class='transaksi_harga_dasar' name='transaksi_harga_dasar[]' value='" + harga_dasar + "'> <input type='hidden' class='transaksi_satuan_qty' name='transaksi_satuan_qty[]' value='" + satuan_qty + "'> <input type='hidden' class='transaksi_satuan_awal' name='transaksi_satuan_awal[]' value='" + satuan_awal + "'> <input type='hidden' class='stockunit' name='stockunit[]' value='" + stockunit + "'> <input type='hidden' class='kategorihargamanual' name='kategorihargamanual[]' value='" + kategorihargamanual + "'> <input type='hidden' class='kategorilockswalayan' name='kategorilockswalayan[]' value='" + kategorilockswalayan + "'> <input type='hidden' class='kategorilockgudang' name='kategorilockgudang[]' value='" + kategorilockgudang + "'> <span class='transaksi_kode'>" +

            "<span class='transaksi_nama tombol-edit-penjualan' style='line-height:1.1em'  jumlah='" + jumlah + "' harga='" + harga + "' total='" + total + "' diskon='" + diskon + "' total_diskon='" + total_diskon + "' id='" + id + "'>" + nama + "</span></td>" +
            "<td align='center'><input type='text' class='jumlah_transaksi_input' value='" + jumlah + "' style='width:100% ;border-style: none;font-size: 12px; color: black !important; text-align: center' onchange='ubah_jumlah(\"" + id + "\",this.value, \"" + satuan + "\")' onclick='focus_input(\"" + id + "\", \"" + satuan + "\")'></td>" +
            // "<td align='right'>" + formatNumber(harga) + "</td>" +
            "<td align='center'><input type='text' class='jumlah_harga_online_input' value='" + harga + "' style='width:100% ;border-style: none;font-size: 12px; color: black !important; text-align: center' onchange='ubah_harga_online(\"" + id + "\",this.value, \"" + satuan + "\")' onclick='focus_input(\"" + id + "\", \"" + satuan + "\")'readonly disabled></td>" +
            "<td align='center'>" + select + "</td>" +
            "<td align='center'>" + satuan_qty + "</td>" +
            "<td align='right'>" + formatNumber(total) + "</td>" +
            "<td align='center'><input type='text' class='jumlah_diskon_input' value='" + diskon + "' style='width:100% ;border-style: none;font-size: 12px; color: black !important; text-align: center' onchange='ubah_diskon(\"" + id + "\",this.value, \"" + satuan + "\")' onclick='focus_input(\"" + id + "\", \"" + satuan + "\")'></td>" +
            "<td align='right'>" + formatNumber(total - diskon) + "</td>" +
            "<td align='center'><input type='text' class='keterangan_input' value='" + ket + "' style='width:100% ;border-style: none;font-size: 12px; color: black !important; text-align: center' onchange='tambah_keterangan(\"" + id + "\",this.value, \"" + satuan + "\")' onclick='focus_input(\"" + id + "\", \"" + satuan + "\")'></td>" +
            // "<td align='left'><span class='transaksi_kd_promo' style='line-height:1.1em'>" + kd_promo + "</span></td>" +
            "</tr>";

          $("#table-pembelian tbody").append(table_pembelian);
          scrollToBottom();
        } else if (temporary_filehargaonline == 3) {
          var table_pembelian = "<tr id='tr_" + id + "_" + satuan + "'>" +
            "<td align='left' width='30px'> <span class='btn btn-sm btn-danger tombol-hapus-penjualan' jumlah='" + jumlah + "' harga='" + harga + "' total='" + total + "' diskon='" + diskon + "' total_diskon='" + total_diskon + "' ket='" + ket + "' kd_promo='" + kd_promo + "'id='" + id + "'><i class='fa fa-close'></i></span></td>" +

            "<td> <input type='hidden' class='transaksi_nama' name='transaksi_nama[]' value='" + nama + "'> <input type='hidden' class='transaksi_produk' name='transaksi_produk[]' value='" + id + "'> <input type='hidden' class='transaksi_jumlah' name='transaksi_jumlah[]' value='" + jumlah + "'> <input type='hidden' class='transaksi_harga' name='transaksi_harga[]' value='" + harga + "'> <input type='hidden' class='transaksi_total' name='transaksi_total[]' value='" + total + "'> <input type='hidden' class='transaksi_diskon' name='transaksi_diskon[]' value='" + diskon + "'> <input type='hidden' class='transaksi_total_diskon' name='transaksi_total_diskon[]' value='" + total_diskon + "'> <input type='hidden' class='transaksi_ket' name='transaksi_ket[]' value='" + ket + "'> <input type='hidden' class='transaksi_kd_promo' name='transaksi_kd_promo[]' value='" + kd_promo + "'> <input type='hidden' class='transaksi_harga_dasar' name='transaksi_harga_dasar[]' value='" + harga_dasar + "'> <input type='hidden' class='transaksi_satuan_qty' name='transaksi_satuan_qty[]' value='" + satuan_qty + "'> <input type='hidden' class='transaksi_satuan_awal' name='transaksi_satuan_awal[]' value='" + satuan_awal + "'> <input type='hidden' class='stockunit' name='stockunit[]' value='" + stockunit + "'> <input type='hidden' class='kategorihargamanual' name='kategorihargamanual[]' value='" + kategorihargamanual + "'> <input type='hidden' class='kategorilockswalayan' name='kategorilockswalayan[]' value='" + kategorilockswalayan + "'> <input type='hidden' class='kategorilockgudang' name='kategorilockgudang[]' value='" + kategorilockgudang + "'> <span class='transaksi_kode'>" +

            "<span class='transaksi_nama tombol-edit-penjualan' style='line-height:1.1em'  jumlah='" + jumlah + "' harga='" + harga + "' total='" + total + "' diskon='" + diskon + "' total_diskon='" + total_diskon + "' id='" + id + "'>" + nama + "</span></td>" +
            "<td align='center'><input type='text' class='jumlah_transaksi_input' value='" + jumlah + "' style='width:100% ;border-style: none;font-size: 12px; color: black !important; text-align: center' onchange='ubah_jumlah(\"" + id + "\",this.value, \"" + satuan + "\")' onclick='focus_input(\"" + id + "\", \"" + satuan + "\")'></td>" +
            // "<td align='right'>" + formatNumber(harga) + "</td>" +
            "<td align='center'><input type='text' class='jumlah_harga_online_input' value='" + harga + "' style='width:100% ;border-style: none;font-size: 12px; color: black !important; text-align: center' onchange='ubah_harga_online(\"" + id + "\",this.value, \"" + satuan + "\")' onclick='focus_input(\"" + id + "\", \"" + satuan + "\")'></td>" +
            "<td align='center'>" + select + "</td>" +
            "<td align='center'>" + satuan_qty + "</td>" +
            "<td align='right'>" + formatNumber(total) + "</td>" +
            "<td align='center'><input type='text' class='jumlah_diskon_input' value='" + diskon + "' style='width:100% ;border-style: none;font-size: 12px; color: black !important; text-align: center' onchange='ubah_diskon(\"" + id + "\",this.value, \"" + satuan + "\")' onclick='focus_input(\"" + id + "\", \"" + satuan + "\")'></td>" +
            "<td align='right'>" + formatNumber(total - diskon) + "</td>" +
            "<td align='center'><input type='text' class='keterangan_input' value='" + ket + "' style='width:100% ;border-style: none;font-size: 12px; color: black !important; text-align: center' onchange='tambah_keterangan(\"" + id + "\",this.value, \"" + satuan + "\")' onclick='focus_input(\"" + id + "\", \"" + satuan + "\")'></td>" +
            // "<td align='left'><span class='transaksi_kd_promo' style='line-height:1.1em'>" + kd_promo + "</span></td>" +
            "</tr>";

          $("#table-pembelian tbody").append(table_pembelian);
          scrollToBottom();
        } else {
          var table_pembelian = "<tr id='tr_" + id + "_" + satuan + "'>" +
            "<td align='left' width='30px'> <span class='btn btn-sm btn-danger tombol-hapus-penjualan' jumlah='" + jumlah + "' harga='" + harga + "' total='" + total + "' diskon='" + diskon + "' total_diskon='" + total_diskon + "' ket='" + ket + "' kd_promo='" + kd_promo + "'id='" + id + "'><i class='fa fa-close'></i></span></td>" +

            "<td> <input type='hidden' class='transaksi_nama' name='transaksi_nama[]' value='" + nama + "'> <input type='hidden' class='transaksi_produk' name='transaksi_produk[]' value='" + id + "'> <input type='hidden' class='transaksi_jumlah' name='transaksi_jumlah[]' value='" + jumlah + "'> <input type='hidden' class='transaksi_harga' name='transaksi_harga[]' value='" + harga + "'> <input type='hidden' class='transaksi_total' name='transaksi_total[]' value='" + total + "'> <input type='hidden' class='transaksi_diskon' name='transaksi_diskon[]' value='" + diskon + "'> <input type='hidden' class='transaksi_total_diskon' name='transaksi_total_diskon[]' value='" + total_diskon + "'> <input type='hidden' class='transaksi_ket' name='transaksi_ket[]' value='" + ket + "'> <input type='hidden' class='transaksi_kd_promo' name='transaksi_kd_promo[]' value='" + kd_promo + "'> <input type='hidden' class='transaksi_harga_dasar' name='transaksi_harga_dasar[]' value='" + harga_dasar + "'> <input type='hidden' class='transaksi_satuan_qty' name='transaksi_satuan_qty[]' value='" + satuan_qty + "'> <input type='hidden' class='transaksi_satuan_awal' name='transaksi_satuan_awal[]' value='" + satuan_awal + "'> <input type='hidden' class='stockunit' name='stockunit[]' value='" + stockunit + "'> <input type='hidden' class='kategorihargamanual' name='kategorihargamanual[]' value='" + kategorihargamanual + "'> <input type='hidden' class='kategorilockswalayan' name='kategorilockswalayan[]' value='" + kategorilockswalayan + "'> <input type='hidden' class='kategorilockgudang' name='kategorilockgudang[]' value='" + kategorilockgudang + "'> <span class='transaksi_kode'>" +

            "<span class='transaksi_nama tombol-edit-penjualan' style='line-height:1.1em'  jumlah='" + jumlah + "' harga='" + harga + "' total='" + total + "' diskon='" + diskon + "' total_diskon='" + total_diskon + "' id='" + id + "'>" + nama + "</span></td>" +
            "<td align='center'><input type='text' class='jumlah_transaksi_input' value='" + jumlah + "' style='width:100% ;border-style: none;font-size: 12px; color: black !important; text-align: center' onchange='ubah_jumlah(\"" + id + "\",this.value, \"" + satuan + "\")' onclick='focus_input(\"" + id + "\", \"" + satuan + "\")'></td>" +
            // "<td align='right'>" + formatNumber(harga) + "</td>" +
            "<td align='center'><input type='text' class='jumlah_harga_online_input' value='" + harga + "' style='width:100% ;border-style: none;font-size: 12px; color: black !important; text-align: center' onchange='ubah_harga_online(\"" + id + "\",this.value, \"" + satuan + "\")' onclick='focus_input(\"" + id + "\", \"" + satuan + "\")'readonly disabled></td>" +
            "<td align='center'>" + select + "</td>" +
            "<td align='center'>" + satuan_qty + "</td>" +
            "<td align='right'>" + formatNumber(total) + "</td>" +
            "<td align='center'><input type='text' class='jumlah_diskon_input' value='" + diskon + "' style='width:100% ;border-style: none;font-size: 12px; color: black !important; text-align: center' onchange='ubah_diskon(\"" + id + "\",this.value, \"" + satuan + "\")' onclick='focus_input(\"" + id + "\", \"" + satuan + "\")'readonly disabled></td>" +
            "<td align='right'>" + formatNumber(total - diskon) + "</td>" +
            "<td align='center'><input type='text' class='keterangan_input' value='" + ket + "' style='width:100% ;border-style: none;font-size: 12px; color: black !important; text-align: center' onchange='tambah_keterangan(\"" + id + "\",this.value, \"" + satuan + "\")' onclick='focus_input(\"" + id + "\", \"" + satuan + "\")'readonly disabled></td>" +
            // "<td align='left'><span class='transaksi_kd_promo' style='line-height:1.1em'>" + kd_promo + "</span></td>" +
            "</tr>";

          $("#table-pembelian tbody").append(table_pembelian);
          scrollToBottom();
        }

      }
      // update total pembelian
      var pembelian_jumlah = $(".pembelian_jumlah").attr("id");
      var pembelian_harga = $(".pembelian_harga").attr("id");
      var pembelian_total = $(".pembelian_total").attr("id");
      var pembelian_diskon = $(".pembelian_diskon").attr("id");
      var pembelian_total_diskon = $(".pembelian_total_diskon").attr("id");
      var pembelian_ket = $(".pembelian_ket").attr("id");
      var pembelian_kd_promo = $(".pembelian_kd_promo").attr("id");
      var pembelian_harga_dasar = $(".pembelian_harga_dasar").attr("id");
      // console.log("ini update total pembelian " + pembelian_jumlah);
      // jumlahkan pembelian
      var jumlahkan_jumlah = eval(pembelian_jumlah) + eval(jumlah);
      var jumlahkan_harga = eval(pembelian_harga) + eval(harga);
      var jumlahkan_total = eval(pembelian_total) + eval(total);

      var jumlahkan_diskon = eval(pembelian_diskon) + eval(diskon);
      var jumlahkan_total_diskon = eval(pembelian_total_diskon);
      // var jumlahkan_ket = eval(pembelian_ket) + eval(ket);
      // var jumlahkan_kd_promo = eval(pembelian_kd_promo) + eval(ket);
      // var jumlahkan_harga_dasar = eval(pembelian_harga_dasar) + eval(ket);
      // isi di table penjualan
      $(".pembelian_jumlah").attr("id", jumlahkan_jumlah);
      $(".pembelian_harga").attr("id", jumlahkan_harga);
      $(".pembelian_total").attr("id", jumlahkan_total);
      $(".pembelian_diskon").attr("id", jumlahkan_diskon);
      $(".pembelian_total_diskon").attr("id", jumlahkan_total_diskon);
      // $(".pembelian_ket").attr("id", jumlahkan_ket);
      // $(".pembelian_kd_promo").attr("id", jumlahkan_kd_promo);
      // $(".pembelian_harga_dasar").attr("id", jumlahkan_harga_dasar);

      // tulis di table penjualan
      $(".pembelian_jumlah").text(formatNumber(jumlahkan_jumlah));
      // $(".pembelian_harga").text(formatNumber(jumlahkan_harga) + ",-");
      $(".pembelian_total").text("Rp." + formatNumber(jumlahkan_total));
      // $(".pembelian_diskon").text(formatNumber(jumlahkan_diskon) + ",-");
      $(".pembelian_total_diskon").text("Rp." + formatNumber(jumlahkan_total_diskon.toFixed(0)));


      // total
      $(".jumlah_total_pembelian").text(formatNumber(jumlahkan_jumlah));
      $(".sub_total_pembelian").text("Rp." + formatNumber(jumlahkan_total) + "");

      var subjumlah = Math.round(jumlahkan_total - jumlahkan_total_diskon);
      var g_total = Math.round(((jumlahkan_total - jumlahkan_total_diskon) + (jumlahkan_total - jumlahkan_total_diskon) * tax / 100));
      $(".total_pembelian").text("Rp." + formatNumber(g_total.toFixed(0)) + "");

      $(".total_pembelian").attr("id", g_total);
      $(".sub_total_pembelian").attr("id", jumlahkan_total);

      $(".total_form").val(g_total);
      $(".sub_total_form").val(jumlahkan_total);



      // total_diskon
      $(".total_diskon_pembelian").text("Rp." + formatNumber(jumlahkan_total_diskon.toFixed(0)) + ",-");
      $(".sub_total_diskon_pembelian").text("Rp." + formatNumber(jumlahkan_total_diskon.toFixed(0)) + "");
      $(".total_diskon_pembelian").attr("id", jumlahkan_total_diskon);
      $(".sub_total_diskon_pembelian").attr("id", jumlahkan_total_diskon);

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
      $("#tambahkan_harga_dasar").val("");

      //$(".pembelian_total_diskon").text("Rp." + formatNumber(jumlahkan_total_diskon.toFixed(0)));
      $(".pembelian_total_diskon").text("Rp." + formatNumber(g_total.toFixed(0)) + "");
      // update Tax
      var tax = $(".total_tax").val();
      if (tax.length != 0 && tax != "") {

        var sub_total = $(".sub_total_pembelian").attr("id");

        var total_diskon = $(".sub_total_diskon_pembelian").attr("id");

        var hasil_tax = Math.round((sub_total - total_diskon) * (tax / 100));

        $(".hasil_tax").text("Rp." + formatNumber(hasil_tax.toFixed(0)) + "");
        $(".hasil_tax_form").val(hasil_tax.toFixed(0));
      } else {
        var sub_total_pembelian = $(".sub_total_pembelian").attr("id");

        $(".total_pembelian").attr("id", sub_total_pembelian);
        $(".total_pembelian").text("Rp." + formatNumber(sub_total_pembelian) + ",-");
      }
      $(".tombol-edit-penjualan").click();

      $('#tombolAplikasi').attr('disabled', 'disabled');
      $('#tombol-simpan').attr('disabled', 'disabled');
      $('#tombol-simpan2').attr('disabled', 'disabled');
      // $('#tombolPayment').show();
      $('#tombolPayment').removeAttr('disabled');
      paymenttotalkembali()
      ubah_jumlah(id, newJumlah, satuan_awal);


      //  $("#tombol-tambahkan").hide();
      // $("#tombol-update").show();

    });

    // pilih produk barcode
    $('#cari_kode').focus();
    $(document).on("input", "#cari_kode", function(event) {
      var value = $(this).val();
      if (value.length > 3) {
        function scrollToBottom() {
          var div = $(".table-scroll");
          div.scrollTop(div[0].scrollHeight);
        }

        function doesIdExistInTable(id, satuan) {
          return $("#table-pembelian").find("tr[id='tr_" + id + "_" + satuan + "']").length > 0;
        }

        function doesIdTakeAwayexist(id, satuan) {
          var takeaway = $("#table-pembelian").find("tr[id='tr_15-01-09-0001']")
          return takeaway.nextAll("tr[id='tr_" + id + "_" + satuan + "']").length > 0;
        }

        function number_format23(number) {
          return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        $.ajax({
          type: "GET",
          url: "route/data_kasir/barcode_aksi.php?kode=" + value,
          dataType: 'json',
          success: function(response) {
            if (response.status == 1) {
              // kosongkan input
              $('#cari_kode').val("");
              var data = response.data[0];
              var id = data.kd_brg;
              var kode = data.kd_brg;
              var nama = data.nama;
              var harga = data.harga;
              var diskon = data.diskon;

              var ket = "";
              var kd_promo = data.kd_promo;
              var harga_dasar = data.harga_dasar;
              var tax = $(".total_tax").val();
              var satuan = data.Satuan1.trim();
              var satuan_awal = data.Satuan1.trim();
              var satuan_qty = data.qty_satuan1;
              var stockunit = data.stock;
              var kategorilockswalayan = data.Pcs;
              var kategorilockgudang = data.Renteng;
              var kategorihargamanual = data.kategorihargamanual;


              $("#tambahkan_id").val(id);
              $("#tambahkan_kode").val(kode);
              $("#tambahkan_nama").val(nama);
              $("#tambahkan_harga").val(harga);
              $("#tambahkan_jumlah").val(1);
              $("#tambahkan_total").val(harga * satuan_qty);
              $("#tambahkan_diskon").val(diskon);
              $("#tambahkan_total_diskon").val(diskon);
              $("#tambahkan_ket").val(ket);
              $("#tambahkan_satuan").val(satuan);
              // $("#tambahkan_kd_promo").val(kd_promo);

              var id = $("#tambahkan_id").val();
              var kode = $("#tambahkan_kode").val();
              var nama = $("#tambahkan_nama").val();
              var harga = $("#tambahkan_harga").val();
              var jumlah = $("#tambahkan_jumlah").val();
              var total = $("#tambahkan_total").val();
              var diskon = $("#tambahkan_diskon").val();
              var total_diskon = total;
              var ket = $("#tambahkan_ket").val();
              var satuan = $("#tambahkan_satuan").val();
              var options = "";
              var newJumlah = jumlah;

              $.ajax({
                "url": "./route/data_kasir/ajax_satuan_option.php?id=" + id,
                "type": "GET",
                "dataType": "json",
                "async": false,
                "success": function(response) {
                  response.forEach((element, i) => {
                    if (i == 0) {
                      options += `<option selected>${element}</option>`
                    } else {
                      options += `<option>${element}</option>`
                    }
                  });
                },
                "error": function(jqXHR, textStatus, errorThrown) {
                  console.log(textStatus, errorThrown);
                }
              });

              let select = `<select class="form-control" id="transaksi_satuan_${id}" name="transaksi_satuan[]" style='width:120px ;border-style: none;font-size: 14px; color: black !important;' onchange="pilih_satuan('${id}', this.value, '${satuan}')">${options}</select>`;

              function doesIdExistInTable(id, satuan) {
                return $("#table-pembelian").find("tr[id='tr_" + id + "_" + satuan + "']").length > 0;
              }

              // function doesSatuanExistInTabel(id, satuan) {
              //   let satuanTr = $(`#table-pembelian tr#tr_${id} td #transaksi_satuan_${id}`).val();
              //   if (satuanTr == satuan) {
              //     return true;
              //   }else{
              //     return false;
              //   }
              // }

              function doesIdTakeAwayexist(id, satuan) {
                var takeaway = $("#table-pembelian").find("tr[id='tr_15-01-09-0001']")
                return takeaway.nextAll("tr[id='tr_" + id + "_" + satuan + "']").length > 0;
              }

              function number_format23(number) {
                return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
              }

              if (!doesIdExistInTable('15-01-09-0001') && doesIdExistInTable(id, satuan)) {
                console.log("adddddddddddddd");
                var existingRow = $("#table-pembelian").find("tr[id='tr_" + id + "_" + satuan + "']");
                var existingJumlah = parseInt(existingRow.find('.transaksi_jumlah').val());
                var existingHargaTotal = parseInt(existingRow.find('.transaksi_total').val());
                var existingDiskon = parseInt(existingRow.find('.transaksi_total_diskon').val());
                var existingSatuanQty = parseFloat(existingRow.find('.transaksi_satuan_qty').val());
                var newJumlah = existingJumlah + parseInt(jumlah);
                var newTotal = existingHargaTotal + parseInt(total);
                var newDiskon = parseInt(diskon);

                // Update the row with the new values and other data
                existingRow.find('.transaksi_jumlah').val(newJumlah);
                existingRow.find('.transaksi_total').val(newTotal);
                existingRow.find('.transaksi_total_diskon').val(newDiskon);
                existingRow.find('.tombol-hapus-penjualan').attr("jumlah", newJumlah);
                existingRow.find('.tombol-hapus-penjualan').attr("total", newTotal);
                existingRow.find('.tombol-hapus-penjualan').attr("total_diskon", newDiskon);

                existingRow.find('td:eq(2) input').val(newJumlah);
                existingRow.find('td:eq(6)').html(number_format23(newTotal));
                existingRow.find('td:eq(8)').html(number_format23(newTotal - newDiskon));


              } else if (doesIdExistInTable('15-01-09-0001') && doesIdTakeAwayexist(id, satuan)) {
                var takeaway = $("#table-pembelian").find("tr[id='tr_15-01-09-0001']")
                var existingRow = takeaway.nextAll("tr[id='tr_" + id + "_" + satuan + "']");
                var existingJumlah = parseInt(existingRow.find('.transaksi_jumlah').val());
                var existingHargaTotal = parseInt(existingRow.find('.transaksi_total').val());
                var newJumlah = existingJumlah + parseInt(jumlah);

                var newTotal = existingHargaTotal + parseInt(total);


                // Update the row with the new values and other data
                existingRow.find('.transaksi_jumlah').val(newJumlah);
                existingRow.find('.transaksi_total').val(newTotal);
                existingRow.find('.tombol-hapus-penjualan').attr("jumlah", newJumlah);
                existingRow.find('.tombol-hapus-penjualan').attr("total", newTotal);


                existingRow.find('td:eq(2) input').val(newJumlah);
                existingRow.find('td:eq(5)').html(number_format23(newTotal));


              } else if (doesIdExistInTable('15-01-09-0001') && id == '15-01-09-0001_' + satuan) {
                var existingRow = $("#table-pembelian").find("tr[id='tr_" + id + "']");
                var existingJumlah = parseInt(existingRow.find('.transaksi_jumlah').val());
                var existingHargaTotal = parseInt(existingRow.find('.transaksi_total').val());

                var newJumlah = existingJumlah + parseInt(jumlah);
                var newTotal = existingHargaTotal + parseInt(total);

                // Update the row with the new values and other data
                existingRow.find('.transaksi_jumlah').val(newJumlah);
                existingRow.find('.transaksi_total').val(newTotal);
                existingRow.find('.tombol-hapus-penjualan').attr("jumlah", newJumlah);
                existingRow.find('.tombol-hapus-penjualan').attr("total", newTotal);


                existingRow.find('td:eq(2) input').val(newJumlah);
                existingRow.find('td:eq(5)').html(number_format23(newTotal));


              } else {
                const temporary_filehargaonline = document.getElementById('kd_kategori_harga_online').value;
                if (temporary_filehargaonline == 2) {
                  var table_pembelian = "<tr id='tr_" + id + "_" + satuan + "'>" +
                    "<td align='left' width='30px'> <span class='btn btn-sm btn-danger tombol-hapus-penjualan' jumlah='" + jumlah + "' harga='" + harga + "' total='" + total + "' diskon='" + diskon + "' total_diskon='" + total_diskon + "' ket='" + ket + "' kd_promo='" + kd_promo + "'id='" + id + "'><i class='fa fa-close'></i></span></td>" +

                    "<td> <input type='hidden' class='transaksi_nama' name='transaksi_nama[]' value='" + nama + "'> <input type='hidden' class='transaksi_produk' name='transaksi_produk[]' value='" + id + "'> <input type='hidden' class='transaksi_jumlah' name='transaksi_jumlah[]' value='" + jumlah + "'> <input type='hidden' class='transaksi_harga' name='transaksi_harga[]' value='" + harga + "'> <input type='hidden' class='transaksi_total' name='transaksi_total[]' value='" + total + "'> <input type='hidden' class='transaksi_diskon' name='transaksi_diskon[]' value='" + diskon + "'> <input type='hidden' class='transaksi_total_diskon' name='transaksi_total_diskon[]' value='" + total_diskon + "'> <input type='hidden' class='transaksi_ket' name='transaksi_ket[]' value='" + ket + "'> <input type='hidden' class='transaksi_kd_promo' name='transaksi_kd_promo[]' value='" + kd_promo + "'> <input type='hidden' class='transaksi_harga_dasar' name='transaksi_harga_dasar[]' value='" + harga_dasar + "'> <input type='hidden' class='transaksi_satuan_qty' name='transaksi_satuan_qty[]' value='" + satuan_qty + "'> <input type='hidden' class='transaksi_satuan_awal' name='transaksi_satuan_awal[]' value='" + satuan_awal + "'> <input type='hidden' class='stockunit' name='stockunit[]' value='" + stockunit + "'> <input type='hidden' class='kategorihargamanual' name='kategorihargamanual[]' value='" + kategorihargamanual + "'> <input type='hidden' class='kategorilockswalayan' name='kategorilockswalayan[]' value='" + kategorilockswalayan + "'> <input type='hidden' class='kategorilockgudang' name='kategorilockgudang[]' value='" + kategorilockgudang + "'> <span class='transaksi_kode'>" +

                    "<span class='transaksi_nama tombol-edit-penjualan' style='line-height:1.1em'  jumlah='" + jumlah + "' harga='" + harga + "' total='" + total + "' diskon='" + diskon + "' total_diskon='" + total_diskon + "' id='" + id + "'>" + nama + "</span></td>" +
                    "<td align='center'><input type='text' class='jumlah_transaksi_input' value='" + jumlah + "' style='width:100% ;border-style: none;font-size: 12px; color: black !important; text-align: center' onchange='ubah_jumlah(\"" + id + "\",this.value, \"" + satuan + "\")' onclick='focus_input(\"" + id + "\", \"" + satuan + "\")'></td>" +
                    // "<td align='right'>" + formatNumber(harga) + "</td>" +
                    "<td align='center'><input type='text' class='jumlah_harga_online_input' value='" + harga + "' style='width:100% ;border-style: none;font-size: 12px; color: black !important; text-align: center' onchange='ubah_harga_online(\"" + id + "\",this.value, \"" + satuan + "\")' onclick='focus_input(\"" + id + "\", \"" + satuan + "\")'readonly disabled></td>" +
                    "<td align='center'>" + select + "</td>" +
                    "<td align='center'>" + satuan_qty + "</td>" +
                    "<td align='right'>" + formatNumber(total) + "</td>" +
                    "<td align='center'><input type='text' class='jumlah_diskon_input' value='" + diskon + "' style='width:100% ;border-style: none;font-size: 12px; color: black !important; text-align: center' onchange='ubah_diskon(\"" + id + "\",this.value, \"" + satuan + "\")' onclick='focus_input(\"" + id + "\", \"" + satuan + "\")'></td>" +
                    "<td align='right'>" + formatNumber(total - diskon) + "</td>" +
                    "<td align='center'><input type='text' class='keterangan_input' value='" + ket + "' style='width:100% ;border-style: none;font-size: 12px; color: black !important; text-align: center' onchange='tambah_keterangan(\"" + id + "\",this.value, \"" + satuan + "\")' onclick='focus_input(\"" + id + "\", \"" + satuan + "\")'></td>" +
                    // "<td align='left'><span class='transaksi_kd_promo' style='line-height:1.1em'>" + kd_promo + "</span></td>" +
                    "</tr>";

                  $("#table-pembelian tbody").append(table_pembelian);
                  scrollToBottom();
                } else if (temporary_filehargaonline == 3) {
                  var table_pembelian = "<tr id='tr_" + id + "_" + satuan + "'>" +
                    "<td align='left' width='30px'> <span class='btn btn-sm btn-danger tombol-hapus-penjualan' jumlah='" + jumlah + "' harga='" + harga + "' total='" + total + "' diskon='" + diskon + "' total_diskon='" + total_diskon + "' ket='" + ket + "' kd_promo='" + kd_promo + "'id='" + id + "'><i class='fa fa-close'></i></span></td>" +

                    "<td> <input type='hidden' class='transaksi_nama' name='transaksi_nama[]' value='" + nama + "'> <input type='hidden' class='transaksi_produk' name='transaksi_produk[]' value='" + id + "'> <input type='hidden' class='transaksi_jumlah' name='transaksi_jumlah[]' value='" + jumlah + "'> <input type='hidden' class='transaksi_harga' name='transaksi_harga[]' value='" + harga + "'> <input type='hidden' class='transaksi_total' name='transaksi_total[]' value='" + total + "'> <input type='hidden' class='transaksi_diskon' name='transaksi_diskon[]' value='" + diskon + "'> <input type='hidden' class='transaksi_total_diskon' name='transaksi_total_diskon[]' value='" + total_diskon + "'> <input type='hidden' class='transaksi_ket' name='transaksi_ket[]' value='" + ket + "'> <input type='hidden' class='transaksi_kd_promo' name='transaksi_kd_promo[]' value='" + kd_promo + "'> <input type='hidden' class='transaksi_harga_dasar' name='transaksi_harga_dasar[]' value='" + harga_dasar + "'> <input type='hidden' class='transaksi_satuan_qty' name='transaksi_satuan_qty[]' value='" + satuan_qty + "'> <input type='hidden' class='transaksi_satuan_awal' name='transaksi_satuan_awal[]' value='" + satuan_awal + "'> <input type='hidden' class='stockunit' name='stockunit[]' value='" + stockunit + "'> <input type='hidden' class='kategorihargamanual' name='kategorihargamanual[]' value='" + kategorihargamanual + "'> <input type='hidden' class='kategorilockswalayan' name='kategorilockswalayan[]' value='" + kategorilockswalayan + "'> <input type='hidden' class='kategorilockgudang' name='kategorilockgudang[]' value='" + kategorilockgudang + "'> <span class='transaksi_kode'>" +

                    "<span class='transaksi_nama tombol-edit-penjualan' style='line-height:1.1em'  jumlah='" + jumlah + "' harga='" + harga + "' total='" + total + "' diskon='" + diskon + "' total_diskon='" + total_diskon + "' id='" + id + "'>" + nama + "</span></td>" +
                    "<td align='center'><input type='text' class='jumlah_transaksi_input' value='" + jumlah + "' style='width:100% ;border-style: none;font-size: 12px; color: black !important; text-align: center' onchange='ubah_jumlah(\"" + id + "\",this.value, \"" + satuan + "\")' onclick='focus_input(\"" + id + "\", \"" + satuan + "\")'></td>" +
                    // "<td align='right'>" + formatNumber(harga) + "</td>" +
                    "<td align='center'><input type='text' class='jumlah_harga_online_input' value='" + harga + "' style='width:100% ;border-style: none;font-size: 12px; color: black !important; text-align: center' onchange='ubah_harga_online(\"" + id + "\",this.value, \"" + satuan + "\")' onclick='focus_input(\"" + id + "\", \"" + satuan + "\")'></td>" +
                    "<td align='center'>" + select + "</td>" +
                    "<td align='center'>" + satuan_qty + "</td>" +
                    "<td align='right'>" + formatNumber(total) + "</td>" +
                    "<td align='center'><input type='text' class='jumlah_diskon_input' value='" + diskon + "' style='width:100% ;border-style: none;font-size: 12px; color: black !important; text-align: center' onchange='ubah_diskon(\"" + id + "\",this.value, \"" + satuan + "\")' onclick='focus_input(\"" + id + "\", \"" + satuan + "\")'</td>" +
                    "<td align='right'>" + formatNumber(total - diskon) + "</td>" +
                    "<td align='center'><input type='text' class='keterangan_input' value='" + ket + "' style='width:100% ;border-style: none;font-size: 12px; color: black !important; text-align: center' onchange='tambah_keterangan(\"" + id + "\",this.value, \"" + satuan + "\")' onclick='focus_input(\"" + id + "\", \"" + satuan + "\")'</td>" +
                    // "<td align='left'><span class='transaksi_kd_promo' style='line-height:1.1em'>" + kd_promo + "</span></td>" +
                    "</tr>";

                  $("#table-pembelian tbody").append(table_pembelian);
                  scrollToBottom();
                } else {
                  var table_pembelian = "<tr id='tr_" + id + "_" + satuan + "'>" +
                    "<td align='left' width='30px'> <span class='btn btn-sm btn-danger tombol-hapus-penjualan' jumlah='" + jumlah + "' harga='" + harga + "' total='" + total + "' diskon='" + diskon + "' total_diskon='" + total_diskon + "' ket='" + ket + "' kd_promo='" + kd_promo + "'id='" + id + "'><i class='fa fa-close'></i></span></td>" +

                    "<td> <input type='hidden' class='transaksi_nama' name='transaksi_nama[]' value='" + nama + "'> <input type='hidden' class='transaksi_produk' name='transaksi_produk[]' value='" + id + "'> <input type='hidden' class='transaksi_jumlah' name='transaksi_jumlah[]' value='" + jumlah + "'> <input type='hidden' class='transaksi_harga' name='transaksi_harga[]' value='" + harga + "'> <input type='hidden' class='transaksi_total' name='transaksi_total[]' value='" + total + "'> <input type='hidden' class='transaksi_diskon' name='transaksi_diskon[]' value='" + diskon + "'> <input type='hidden' class='transaksi_total_diskon' name='transaksi_total_diskon[]' value='" + total_diskon + "'> <input type='hidden' class='transaksi_ket' name='transaksi_ket[]' value='" + ket + "'> <input type='hidden' class='transaksi_kd_promo' name='transaksi_kd_promo[]' value='" + kd_promo + "'> <input type='hidden' class='transaksi_harga_dasar' name='transaksi_harga_dasar[]' value='" + harga_dasar + "'> <input type='hidden' class='transaksi_satuan_qty' name='transaksi_satuan_qty[]' value='" + satuan_qty + "'> <input type='hidden' class='transaksi_satuan_awal' name='transaksi_satuan_awal[]' value='" + satuan_awal + "'> <input type='hidden' class='stockunit' name='stockunit[]' value='" + stockunit + "'> <input type='hidden' class='kategorihargamanual' name='kategorihargamanual[]' value='" + kategorihargamanual + "'> <input type='hidden' class='kategorilockswalayan' name='kategorilockswalayan[]' value='" + kategorilockswalayan + "'> <input type='hidden' class='kategorilockgudang' name='kategorilockgudang[]' value='" + kategorilockgudang + "'> <span class='transaksi_kode'>" +

                    "<span class='transaksi_nama tombol-edit-penjualan' style='line-height:1.1em'  jumlah='" + jumlah + "' harga='" + harga + "' total='" + total + "' diskon='" + diskon + "' total_diskon='" + total_diskon + "' id='" + id + "'>" + nama + "</span></td>" +
                    "<td align='center'><input type='text' class='jumlah_transaksi_input' value='" + jumlah + "' style='width:100% ;border-style: none;font-size: 12px; color: black !important; text-align: center' onchange='ubah_jumlah(\"" + id + "\",this.value, \"" + satuan + "\")' onclick='focus_input(\"" + id + "\", \"" + satuan + "\")'></td>" +
                    // "<td align='right'>" + formatNumber(harga) + "</td>" +
                    "<td align='center'><input type='text' class='jumlah_harga_online_input' value='" + harga + "' style='width:100% ;border-style: none;font-size: 12px; color: black !important; text-align: center' onchange='ubah_harga_online(\"" + id + "\",this.value, \"" + satuan + "\")' onclick='focus_input(\"" + id + "\", \"" + satuan + "\")'readonly disabled></td>" +
                    "<td align='center'>" + select + "</td>" +
                    "<td align='center'>" + satuan_qty + "</td>" +
                    "<td align='right'>" + formatNumber(total) + "</td>" +
                    "<td align='center'><input type='text' class='jumlah_diskon_input' value='" + diskon + "' style='width:100% ;border-style: none;font-size: 12px; color: black !important; text-align: center' onchange='ubah_diskon(\"" + id + "\",this.value, \"" + satuan + "\")' onclick='focus_input(\"" + id + "\", \"" + satuan + "\")'readonly disabled></td>" +
                    "<td align='right'>" + formatNumber(total - diskon) + "</td>" +
                    "<td align='center'><input type='text' class='keterangan_input' value='" + ket + "' style='width:100% ;border-style: none;font-size: 12px; color: black !important; text-align: center' onchange='tambah_keterangan(\"" + id + "\",this.value, \"" + satuan + "\")' onclick='focus_input(\"" + id + "\", \"" + satuan + "\")'readonly disabled></td>" +
                    // "<td align='left'><span class='transaksi_kd_promo' style='line-height:1.1em'>" + kd_promo + "</span></td>" +
                    "</tr>";

                  $("#table-pembelian tbody").append(table_pembelian);
                  scrollToBottom();
                }


              }
              // update total pembelian
              var pembelian_jumlah = $(".pembelian_jumlah").attr("id");
              var pembelian_harga = $(".pembelian_harga").attr("id");
              var pembelian_total = $(".pembelian_total").attr("id");
              var pembelian_diskon = $(".pembelian_diskon").attr("id");
              var pembelian_total_diskon = $(".pembelian_total_diskon").attr("id");
              var pembelian_ket = $(".pembelian_ket").attr("id");
              var pembelian_kd_promo = $(".pembelian_kd_promo").attr("id");
              var pembelian_harga_dasar = $(".pembelian_harga_dasar").attr("id");
              // console.log("ini update total pembelian " + pembelian_jumlah);
              // jumlahkan pembelian
              var jumlahkan_jumlah = eval(pembelian_jumlah) + eval(jumlah);
              var jumlahkan_harga = eval(pembelian_harga) + eval(harga);
              var jumlahkan_total = eval(pembelian_total) + eval(total);

              var jumlahkan_diskon = eval(pembelian_diskon) + eval(diskon);
              var jumlahkan_total_diskon = eval(pembelian_total_diskon);
              // var jumlahkan_ket = eval(pembelian_ket) + eval(ket);
              // var jumlahkan_kd_promo = eval(pembelian_kd_promo) + eval(ket);
              // var jumlahkan_harga_dasar = eval(pembelian_harga_dasar) + eval(ket);
              // isi di table penjualan
              $(".pembelian_jumlah").attr("id", jumlahkan_jumlah);
              $(".pembelian_harga").attr("id", jumlahkan_harga);
              $(".pembelian_total").attr("id", jumlahkan_total);
              $(".pembelian_diskon").attr("id", jumlahkan_diskon);
              $(".pembelian_total_diskon").attr("id", jumlahkan_total_diskon);
              // $(".pembelian_ket").attr("id", jumlahkan_ket);
              // $(".pembelian_kd_promo").attr("id", jumlahkan_kd_promo);
              // $(".pembelian_harga_dasar").attr("id", jumlahkan_harga_dasar);

              // tulis di table penjualan
              $(".pembelian_jumlah").text(formatNumber(jumlahkan_jumlah));
              // $(".pembelian_harga").text(formatNumber(jumlahkan_harga) + ",-");
              $(".pembelian_total").text("Rp." + formatNumber(jumlahkan_total));
              // $(".pembelian_diskon").text(formatNumber(jumlahkan_diskon) + ",-");
              $(".pembelian_total_diskon").text("Rp." + formatNumber(jumlahkan_total_diskon.toFixed(0)));


              // total
              $(".jumlah_total_pembelian").text(formatNumber(jumlahkan_jumlah));
              $(".sub_total_pembelian").text("Rp." + formatNumber(jumlahkan_total) + "");

              var subjumlah = Math.round(jumlahkan_total - jumlahkan_total_diskon);
              var g_total = Math.round(((jumlahkan_total - jumlahkan_total_diskon) + (jumlahkan_total - jumlahkan_total_diskon) * tax / 100));
              $(".total_pembelian").text("Rp." + formatNumber(g_total.toFixed(0)) + "");

              $(".total_pembelian").attr("id", g_total);
              $(".sub_total_pembelian").attr("id", jumlahkan_total);

              $(".total_form").val(g_total);
              $(".sub_total_form").val(jumlahkan_total);



              // total_diskon
              $(".total_diskon_pembelian").text("Rp." + formatNumber(jumlahkan_total_diskon.toFixed(0)) + ",-");
              $(".sub_total_diskon_pembelian").text("Rp." + formatNumber(jumlahkan_total_diskon.toFixed(0)) + "");
              $(".total_diskon_pembelian").attr("id", jumlahkan_total_diskon);
              $(".sub_total_diskon_pembelian").attr("id", jumlahkan_total_diskon);

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
              $("#tambahkan_harga_dasar").val("");

              //$(".pembelian_total_diskon").text("Rp." + formatNumber(jumlahkan_total_diskon.toFixed(0)));
              $(".pembelian_total_diskon").text("Rp." + formatNumber(g_total.toFixed(0)) + "");
              // update Tax
              var tax = $(".total_tax").val();
              if (tax.length != 0 && tax != "") {

                var sub_total = $(".sub_total_pembelian").attr("id");

                var total_diskon = $(".sub_total_diskon_pembelian").attr("id");

                var hasil_tax = Math.round((sub_total - total_diskon) * (tax / 100));

                $(".hasil_tax").text("Rp." + formatNumber(hasil_tax.toFixed(0)) + "");
                $(".hasil_tax_form").val(hasil_tax.toFixed(0));
              } else {
                var sub_total_pembelian = $(".sub_total_pembelian").attr("id");

                $(".total_pembelian").attr("id", sub_total_pembelian);
                $(".total_pembelian").text("Rp." + formatNumber(sub_total_pembelian) + ",-");
              }
              $(".tombol-edit-penjualan").click();

              $('#tombolAplikasi').attr('disabled', 'disabled');
              $('#tombol-simpan').attr('disabled', 'disabled');
              $('#tombol-simpan2').attr('disabled', 'disabled');
              // $('#tombolPayment').show();
              $('#tombolPayment').removeAttr('disabled');
              paymenttotalkembali()
              ubah_jumlah(id, newJumlah, satuan_awal);

            } else {
              $('#cari_kode').val("");
              console.log(response.msg);
            }
          },
          error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
          }
        });
      }
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
      $("#kalkulator").fadeIn(300);
      $("#form_jml").show(100);
      $("#form_ket").show(100);

      var produk = $(this).closest('tr').find('.transaksi_produk').val();
      var kode = $(this).closest('tr').find('.transaksi_kode').text();
      var nama = $(this).closest('tr').find('.transaksi_nama').text();
      var jumlah = $(this).closest('tr').find('.transaksi_jumlah').val();
      var harga = $(this).closest('tr').find('.transaksi_harga').val();
      var total = $(this).closest('tr').find('.transaksi_total').val();

      var diskon = $(this).closest('tr').find('.transaksi_diskon').val();
      var total_diskon = $(this).closest('tr').find('.transaksi_total_diskon').val();
      var jml = $(this).closest('tr').find('.transaksi_jumlah').text();
      var ket = $(this).closest('tr').find('.transaksi_ket').text();
      var kd_promo = $(this).closest('tr').find('.transaksi_kd_promo').text();
      var harga_dasar = $(this).closest('tr').find('.transaksi_harga_dasar').text();

      var tax = $(".total_tax").val();

      $("#d").val(""); // kalkulator isi data nya
      $("#jml").val(jml); // edit_jml isi data nya
      $("#ket").val(ket); // edit_ket isi data nya

      $("#tombol-update").attr("produk", produk);

      $("#tambahkan_id").val(produk);

      $("#tambahkan_kode").val(kode);
      $("#tambahkan_nama").val(nama);
      $("#tambahkan_jumlah").val(jumlah);
      $("#tambahkan_harga").val(harga);
      $("#tambahkan_total").val(total);

      $("#tambahkan_diskon").val(diskon);
      $("#tambahkan_total_diskon").val(diskon);
      $("#tambahkan_ket").val(ket);
      $("#tambahkan_kd_promo").val(kd_promo);
      $("#tambahkan_harga_dasar").val(harga_dasar);

      // $("#tombol-tambahkan").hide();
      $("#tombol-update").fadeIn(100);
      $("#tombol-update-cancel").show();

      $("#table-pembelian tr").removeClass('bg-yellow');
      $(this).closest('tr').addClass('bg-yellow');

    });

    // Tombol Kurang
    $(document).on("click", ".tombol-kurang-penjualan", function() {
      // $("#kalkulator").show(100);
      // $("#form_ket").show(100);


      var produk = $(this).closest('tr').find('.transaksi_produk').val();
      var kode = $(this).closest('tr').find('.transaksi_kode').text();
      var nama = $(this).closest('tr').find('.transaksi_nama').text();
      var jumlah = $(this).closest('tr').find('.transaksi_jumlah').val();
      var harga = $(this).closest('tr').find('.transaksi_harga').val();
      var total = $(this).closest('tr').find('.transaksi_total').val();

      var diskon = $(this).closest('tr').find('.transaksi_diskon').val();
      var total_diskon = $(this).closest('tr').find('.transaksi_total_diskon').val();
      var ket = $(this).closest('tr').find('.transaksi_ket').text();
      var kd_promo = $(this).closest('tr').find('.transaksi_kd_promo').text();
      var harga_dasar = $(this).closest('tr').find('.transaksi_harga_dasar').text();

      var tax = $(".total_tax").val();

      $("#d").val(""); // kalkulator isi data nya
      $("#ket").val(ket); // edit_ket isi data nya

      $("#tombol-update").attr("produk", produk);

      $("#tambahkan_id").val(produk);

      $("#tambahkan_kode").val(kode);
      $("#tambahkan_nama").val(nama);
      $("#tambahkan_jumlah").val(jumlah);
      $("#tambahkan_harga").val(harga);
      $("#tambahkan_total").val(total);

      $("#tambahkan_diskon").val(diskon);
      $("#tambahkan_total_diskon").val(diskon);
      $("#tambahkan_ket").val(ket);
      $("#tambahkan_kd_promo").val(kd_promo);
      $("#tambahkan_harga_dasar").val(harga_dasar);

      // $("#tombol-tambahkan").hide();
      $("#tombol-update").fadeIn(100);
      $("#tombol-update-cancel").show();

      $("#table-pembelian tr").removeClass('bg-yellow');
      $(this).closest('tr').addClass('bg-yellow');



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
      var harga_dasar = $("#tambahkan_harga_dasar").val();

      var tax = $(".total_tax").val();

      var id_produk = $("#tombol-update").attr("produk");

      var id = $(".bg-yellow#tr_" + id_produk + " .tombol-edit-penjualan").attr("id");
      var jumlah = $(".bg-yellow#tr_" + id_produk + " .tombol-edit-penjualan").attr("jumlah");
      var harga = $(".bg-yellow#tr_" + id_produk + " .tombol-edit-penjualan").attr("harga");
      var total = $(".bg-yellow#tr_" + id_produk + " .tombol-edit-penjualan").attr("total");
      var diskon = $(".bg-yellow#tr_" + id_produk + " .tombol-edit-penjualan").attr("diskon");
      var total_diskon = $(".bg-yellow#tr_" + id_produk + " .tombol-edit-penjualan").attr("total_diskon");
      var ket = $(".bg-yellow#tr_" + id_produk + " .tombol-edit-penjualan").attr("ket");
      var kd_promo = $(".bg-yellow#tr_" + id_produk + " .tombol-edit-penjualan").attr("kd_promo");
      var harga_dasar = $(".bg-yellow#tr_" + id_produk + " .tombol-edit-penjualan").attr("harga_dasar");


      // update total pembelian
      var pembelian_jumlah = $(".pembelian_jumlah").attr("id");
      var pembelian_harga = $(".pembelian_harga").attr("id");
      var pembelian_total = $(".pembelian_total").attr("id");

      var pembelian_diskon = $(".pembelian_diskon").attr("id");
      var pembelian_total_diskon = $(".pembelian_total_diskon").attr("id");
      var pembelian_ket = $(".pembelian_ket").attr("id");
      var pembelian_kd_promo = $(".pembelian_kd_promo").attr("id");
      var pembelian_harga_dasar = $(".pembelian_harga_dasar").attr("id");

      // jumlahkan pembelian
      var kurangi_jumlah = eval(pembelian_jumlah) - eval(jumlah);
      var kurangi_harga = eval(pembelian_harga) - eval(harga);
      var kurangi_total = eval(pembelian_total) - eval(total);

      var kurangi_diskon = eval(pembelian_diskon) - eval(diskon);
      var kurangi_total_diskon = eval(pembelian_total_diskon) - eval(total_diskon);
      // var kurangi_ket = eval(pembelian_ket) - eval(ket);
      // var kurangi_kd_promo = eval(pembelian_kd_promo) - eval(kd_promo);
      // var kurangi_harga_dasar = eval(pembelian_harga_dasar) - eval(harga_dasar);

      // isi di table penjualan
      $(".pembelian_jumlah").attr("id", kurangi_jumlah);
      $(".pembelian_harga").attr("id", kurangi_harga);
      $(".pembelian_total").attr("id", kurangi_total);
      $(".pembelian_diskon").attr("id", kurangi_diskon);
      $(".pembelian_total_diskon").attr("id", kurangi_total_diskon);
      // $(".pembelian_ket").attr("id", kurangi_ket);
      // $(".pembelian_kd_promo").attr("id", kurangi_kd_promo);
      // $(".pembelian_harga_dasar").attr("id", kurangi_harga_dasar);

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
      $(".total_pembelian").attr("id", kurangi_total);
      $(".sub_total_pembelian").attr("id", kurangi_total);

      $(".total_form").val(kurangi_total);
      $(".sub_total_form").val(kurangi_total);

      // total Diskon
      $(".total_diskon_pembelian").text("Rp." + formatNumber(kurangi_total_diskon.toFixed(0)) + ",-");
      $(".sub_total_diskon_pembelian").text("Rp." + formatNumber(kurangi_total_diskon.toFixed(0)) + ",-");
      $(".total_diskon_pembelian").attr("id", kurangi_total_diskon);
      $(".sub_total_diskon_pembelian").attr("id", kurangi_total_diskon);

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
      var harga_dasar = $("#tambahkan_harga_dasar").val();

      if (jumlah != 1) {
        var jumlah = eval(jumlah) - 1;
      }
      var total_diskon = eval(jumlah) * eval(diskon)
      var total = eval(jumlah) * eval(harga)
      console.log('jumlah = ' + jumlah)

      var table_pembelian = "<tr id='tr_" + id_produk + "'>" +
        "<td align='left' width='30px'><span class='btn btn-sm btn-danger tombol-hapus-penjualan' jumlah='" + jumlah + "' harga='" + harga + "' total='" + total + "' diskon='" + diskon + "' total_diskon='" + total_diskon + "' ket='" + ket + "' kd_promo='" + kd_promo + "' id='" + id + "'><i class='fa fa-close'></i></span></td>" +
        "<td> <input type='hidden' class='transaksi_nama' name='transaksi_nama[]' value='" + nama + "'> <input type='hidden' class='transaksi_produk' name='transaksi_produk[]' value='" + id_produk + "'> <input type='hidden' class='transaksi_jumlah' name='transaksi_jumlah[]' value='" + jumlah + "'> <input type='hidden' class='transaksi_harga' name='transaksi_harga[]' value='" + harga + "'> <input type='hidden' class='transaksi_total' name='transaksi_total[]' value='" + total + "'> <input type='hidden' class='transaksi_diskon' name='transaksi_diskon[]' value='" + diskon + "'> <input type='hidden' class='transaksi_total_diskon' name='transaksi_total_diskon[]' value='" + total_diskon + "'> <input type='hidden' class='transaksi_ket' name='transaksi_ket[]' value='" + ket + "'> <input type='hidden' class='transaksi_kd_promo' name='transaksi_kd_promo[]' value='" + kd_promo + "'> <input type='hidden' class='transaksi_harga_dasar' name='transaksi_harga_dasar[]' value='" + harga_dasar + "'><span class='transaksi_kode'>" +

        "<span class='transaksi_nama tombol-edit-penjualan' style='line-height:1.1em'  jumlah='" + jumlah + "' harga='" + harga + "' total='" + total + "' diskon='" + diskon + "' total_diskon='" + total_diskon + "' id='" + id + "'>" + nama + "</span></td>" +
        "<td align='center'>" + formatNumber(jumlah) + "</td>" +
        "<td align='right'>" + formatNumber(harga) + "</td>" +
        "<td align='right'>" + formatNumber(total) + "</td>" +
        "<td align='right'>" + formatNumber(diskon) + "</td>" +
        "<td align='right'>" + formatNumber(total_diskon) + "</td>" +
        "<td align='left'><span class='transaksi_ket' style='line-height:1.1em'>" + ket + "</td>" +
        // "<td align='left'><span class='transaksi_kd_promo' style='line-height:1.1em'>" + kd_promo + "</span></td>" +

        "</tr>";

      $("#tr_" + id_produk + ".bg-yellow").replaceWith(table_pembelian);
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
      // $(".pembelian_harga").text(formatNumber(jumlahkan_harga));
      $(".pembelian_total").text("Rp." + formatNumber(jumlahkan_total));
      // $(".pembelian_diskon").text("Rp." + formatNumber(jumlahkan_diskon) + ",-");
      $(".pembelian_total_diskon").text("Rp." + formatNumber(jumlahkan_total_diskon.toFixed(0)));

      console.log("jumlahkan_jumlah = " + jumlahkan_jumlah)
      console.log("jumlahkan_harga = " + jumlahkan_harga)
      console.log("jumlahkan_total = " + jumlahkan_total)


      // var  jumlahkan_total = eval(jumlahkan_jumlah) * eval(jumlahkan_harga) ;



      // total
      // $(".total_pembelian").text("Rp." + formatNumber(jumlahkan_total) + ",-");
      console.log("Tax tombol update");
      console.log("jumlah = " + jumlah);
      console.log('jumlahkan_total = ' + jumlahkan_total);
      console.log('jumlahkan_total_diskon = ' + jumlahkan_total_diskon);
      console.log('tax = ' + tax);

      $(".jumlah_total_pembelian").text(formatNumber(jumlahkan_jumlah));

      var subjumlah = Math.round(jumlahkan_total - jumlahkan_total_diskon);
      var g_total = Math.round(subjumlah + (subjumlah * tax / 100));
      // var g_total = Math.ceil(((jumlahkan_total-jumlahkan_total_diskon)+(jumlahkan_total+jumlahkan_total_diskon)*tax/100)) ;

      console.log('subjumlah = ' + subjumlah)
      console.log('g_total = ' + g_total)
      $(".total_pembelian").text("Rp." + formatNumber(g_total.toFixed(0)) + ",-");
      $(".total_pembelian").attr("id", jumlahkan_total);
      $(".sub_total_pembelian").text("Rp." + formatNumber(jumlahkan_total) + ",-");
      $(".sub_total_pembelian").attr("id", jumlahkan_total);

      $(".total_form").val(g_total);
      $(".sub_total_form").val(jumlahkan_total);

      // total Diskon
      $(".total_diskon_pembelian").text("Rp." + formatNumber(jumlahkan_total_diskon.toFixed(0)) + ",-");
      $(".total_diskon_pembelian").attr("id", jumlahkan_total_diskon);
      $(".sub_total_diskon_pembelian").text("Rp." + formatNumber(jumlahkan_total_diskon.toFixed(0)) + ",-");
      $(".sub_total_diskon_pembelian").attr("id", jumlahkan_total_diskon);

      $(".total_diskon_form").val(jumlahkan_total_diskon);
      $(".sub_total_diskon_form").val(jumlahkan_total_diskon);

      $(".subjumlah_form").val(subjumlah);
      console.log('subjumlah = ' + subjumlah)

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
      $("#tambahkan_harga_dasar").val("");


      $("#tombol-tambahkan").show();
      $("#tombol-update").hide();
      $("#tombol-update-cancel").hide();

      $("#table-pembelian tr").removeClass('bg-yellow');


      // update Tax
      var tax = $(".total_tax").val();
      if (tax.length != 0 && tax != "") {
        console.log("masuk masih di posisi update tax");
        console.log('tax = ' + tax);

        var sub_total = $(".sub_total_pembelian").attr("id");
        console.log('sub_total = ' + sub_total);
        var total_diskon = $(".sub_total_diskon_pembelian").attr("id");
        console.log('total_diskon = ' + total_diskon);

        var hasil_tax = Math.round((sub_total - total_diskon) * (tax / 100));
        console.log('hasil_tax = ' + hasil_tax);
        $(".hasil_tax").text("Rp." + formatNumber(hasil_tax.toFixed(0)) + ",-");
        $(".hasil_tax_form").val(hasil_tax.toFixed(0));
      } else {
        var sub_total_pembelian = $(".sub_total_pembelian").attr("id");

        $(".total_pembelian").attr("id", sub_total_pembelian);
        $(".total_pembelian").text("Rp." + formatNumber(sub_total_pembelian) + ",-");
      }
      $("#kalkulator").fadeOut(300);
      $("#form_ket").hide(100);
      paymenttotalkembali();

    });


    // Tombol Tambah
    $(document).on("click", ".tombol-tambah-penjualan", function() {
      // $("#kalkulator").show(100);
      // $("#form_ket").show(100);


      var produk = $(this).closest('tr').find('.transaksi_produk').val();
      var kode = $(this).closest('tr').find('.transaksi_kode').text();
      var nama = $(this).closest('tr').find('.transaksi_nama').text();
      var jumlah = $(this).closest('tr').find('.transaksi_jumlah').val();
      var harga = $(this).closest('tr').find('.transaksi_harga').val();
      var total = $(this).closest('tr').find('.transaksi_total').val();

      var diskon = $(this).closest('tr').find('.transaksi_diskon').val();
      var total_diskon = $(this).closest('tr').find('.transaksi_total_diskon').val();
      var ket = $(this).closest('tr').find('.transaksi_ket').text();
      var kd_promo = $(this).closest('tr').find('.transaksi_kd_promo').text();
      var harga_dasar = $(this).closest('tr').find('.transaksi_harga_dasar').text();

      var tax = $(".total_tax").val();

      $("#d").val(""); // kalkulator isi data nya
      $("#ket").val(ket); // edit_ket isi data nya

      $("#tombol-update").attr("produk", produk);

      $("#tambahkan_id").val(produk);

      $("#tambahkan_kode").val(kode);
      $("#tambahkan_nama").val(nama);
      $("#tambahkan_jumlah").val(jumlah);
      $("#tambahkan_harga").val(harga);
      $("#tambahkan_total").val(total);

      $("#tambahkan_diskon").val(diskon);
      $("#tambahkan_total_diskon").val(diskon);
      $("#tambahkan_ket").val(ket);
      $("#tambahkan_kd_promo").val(kd_promo);
      $("#tambahkan_harga_dasar").val(harga_dasar);

      // $("#tombol-tambahkan").hide();
      $("#tombol-update").fadeIn(100);
      $("#tombol-update-cancel").show();

      $("#table-pembelian tr").removeClass('bg-yellow');
      $(this).closest('tr').addClass('bg-yellow');



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
      var harga_dasar = $("#tambahkan_harga_dasar").val();

      var tax = $(".total_tax").val();

      var id_produk = $("#tombol-update").attr("produk");

      var id = $(".bg-yellow#tr_" + id_produk + " .tombol-edit-penjualan").attr("id");
      var jumlah = $(".bg-yellow#tr_" + id_produk + " .tombol-edit-penjualan").attr("jumlah");
      var harga = $(".bg-yellow#tr_" + id_produk + " .tombol-edit-penjualan").attr("harga");
      var total = $(".bg-yellow#tr_" + id_produk + " .tombol-edit-penjualan").attr("total");
      var diskon = $(".bg-yellow#tr_" + id_produk + " .tombol-edit-penjualan").attr("diskon");
      var total_diskon = $(".bg-yellow#tr_" + id_produk + " .tombol-edit-penjualan").attr("total_diskon");
      var ket = $(".bg-yellow#tr_" + id_produk + " .tombol-edit-penjualan").attr("ket");
      var kd_promo = $(".bg-yellow#tr_" + id_produk + " .tombol-edit-penjualan").attr("kd_promo");
      var harga_dasar = $(".bg-yellow#tr_" + id_produk + " .tombol-edit-penjualan").attr("harga_dasar");


      // update total pembelian
      var pembelian_jumlah = $(".pembelian_jumlah").attr("id");
      var pembelian_harga = $(".pembelian_harga").attr("id");
      var pembelian_total = $(".pembelian_total").attr("id");

      var pembelian_diskon = $(".pembelian_diskon").attr("id");
      var pembelian_total_diskon = $(".pembelian_total_diskon").attr("id");
      var pembelian_ket = $(".pembelian_ket").attr("id");
      var pembelian_kd_promo = $(".pembelian_kd_promo").attr("id");
      var pembelian_harga_dasar = $(".pembelian_harga_dasar").attr("id");

      // jumlahkan pembelian
      var kurangi_jumlah = eval(pembelian_jumlah) - eval(jumlah);
      var kurangi_harga = eval(pembelian_harga) - eval(harga);
      var kurangi_total = eval(pembelian_total) - eval(total);
      var kurangi_diskon = eval(pembelian_diskon) - eval(diskon);
      var kurangi_total_diskon = eval(pembelian_total_diskon) - eval(total_diskon);
      // var kurangi_ket = eval(pembelian_ket) - eval(ket);
      // var kurangi_kd_promo = eval(pembelian_kd_promo) - eval(kd_promo);
      // var kurangi_harga_dasar = eval(pembelian_kd_promo) - eval(harga_dasar);

      // isi di table penjualan
      $(".pembelian_jumlah").attr("id", kurangi_jumlah);
      $(".pembelian_harga").attr("id", kurangi_harga);
      $(".pembelian_total").attr("id", kurangi_total);
      $(".pembelian_diskon").attr("id", kurangi_diskon);
      $(".pembelian_total_diskon").attr("id", kurangi_total_diskon);
      // $(".pembelian_ket").attr("id", kurangi_ket);
      // $(".pembelian_kd_promo").attr("id", kurangi_kd_promo);
      // $(".pembelian_harga_dasar").attr("id", kurangi_harga_dasar);

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
      $(".total_pembelian").attr("id", kurangi_total);
      $(".sub_total_pembelian").attr("id", kurangi_total);

      $(".total_form").val(kurangi_total);
      $(".sub_total_form").val(kurangi_total);

      // total Diskon
      $(".total_diskon_pembelian").text("Rp." + formatNumber(kurangi_total_diskon.toFixed(0)) + ",-");
      $(".sub_total_diskon_pembelian").text("Rp." + formatNumber(kurangi_total_diskon.toFixed(0)) + ",-");
      $(".total_diskon_pembelian").attr("id", kurangi_total_diskon);
      $(".sub_total_diskon_pembelian").attr("id", kurangi_total_diskon);

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
      var harga_dasar = $("#tambahkan_harga_dasar").val();

      var jumlah = eval(jumlah) + 1;
      var total = eval(jumlah) * eval(harga)
      var total_diskon = eval(jumlah) * eval(diskon)
      console.log('jumlah = ' + jumlah)

      var table_pembelian = "<tr id='tr_" + id_produk + "'>" +
        "<td align='left' width='30px'><span class='btn btn-sm btn-danger tombol-hapus-penjualan' jumlah='" + jumlah + "' harga='" + harga + "' total='" + total + "' diskon='" + diskon + "' total_diskon='" + total_diskon + "' ket='" + ket + "' kd_promo='" + kd_promo + "' id='" + id + "'><i class='fa fa-close'></i></span></td>" +
        "<td> <input type='hidden' class='transaksi_nama' name='transaksi_nama[]' value='" + nama + "'> <input type='hidden' class='transaksi_produk' name='transaksi_produk[]' value='" + id_produk + "'> <input type='hidden' class='transaksi_jumlah' name='transaksi_jumlah[]' value='" + jumlah + "'> <input type='hidden' class='transaksi_harga' name='transaksi_harga[]' value='" + harga + "'> <input type='hidden' class='transaksi_total' name='transaksi_total[]' value='" + total + "'> <input type='hidden' class='transaksi_diskon' name='transaksi_diskon[]' value='" + diskon + "'> <input type='hidden' class='transaksi_total_diskon' name='transaksi_total_diskon[]' value='" + total_diskon + "'> <input type='hidden' class='transaksi_ket' name='transaksi_ket[]' value='" + ket + "'> <input type='hidden' class='transaksi_kd_promo' name='transaksi_kd_promo[]' value='" + kd_promo + "'> <input type='hidden' class='transaksi_harga_dasar' name='transaksi_harga_dasar[]' value='" + harga_dasar + "'><span class='transaksi_kode'>" +
        "<span class='transaksi_nama tombol-edit-penjualan' style='line-height:1.1em'  jumlah='" + jumlah + "' harga='" + harga + "' total='" + total + "' diskon='" + diskon + "' total_diskon='" + total_diskon + "' id='" + id + "'>" + nama + "</span></td>" +
        "<td align='center'>" + formatNumber(jumlah) + "</td>" +
        "<td align='right'>" + formatNumber(harga) + "</td>" +
        "<td align='right'>" + formatNumber(total) + "</td>" +
        "<td align='right'>" + formatNumber(diskon) + "</td>" +
        "<td align='right'>" + formatNumber(total_diskon) + "</td>" +
        "<td align='left'><span class='transaksi_ket' style='line-height:1.1em'>" + ket + "</td>" +
        // "<td align='left'><span class='transaksi_kd_promo' style='line-height:1.1em'>" + kd_promo + "</span></td>" +
        "</tr>";

      $("#tr_" + id_produk + ".bg-yellow").replaceWith(table_pembelian);
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
      // $(".pembelian_harga").text(formatNumber(jumlahkan_harga));
      $(".pembelian_total").text("Rp." + formatNumber(jumlahkan_total));
      // $(".pembelian_diskon").text("Rp." + formatNumber(jumlahkan_diskon) + ",-");
      $(".pembelian_total_diskon").text("Rp." + formatNumber(jumlahkan_total_diskon.toFixed(0)));

      console.log("jumlahkan_jumlah = " + jumlahkan_jumlah)
      console.log("jumlahkan_harga = " + jumlahkan_harga)
      console.log("jumlahkan_total = " + jumlahkan_total)


      // total
      // $(".total_pembelian").text("Rp." + formatNumber(jumlahkan_total) + ",-");
      console.log("Tax tombol update");
      console.log("jumlah = " + jumlah);
      console.log('jumlahkan_total = ' + jumlahkan_total);
      console.log('jumlahkan_total_diskon = ' + jumlahkan_total_diskon);
      console.log('tax = ' + tax);

      $(".jumlah_total_pembelian").text(formatNumber(jumlahkan_jumlah));

      var subjumlah = Math.round(jumlahkan_total - jumlahkan_total_diskon);
      var g_total = Math.round(subjumlah + (subjumlah * tax / 100));
      // var g_total = Math.ceil(((jumlahkan_total+jumlahkan_total_diskon)+(jumlahkan_total+jumlahkan_total_diskon)*tax/100)) ;

      console.log('subjumlah = ' + subjumlah)
      console.log('g_total = ' + g_total)
      $(".total_pembelian").text("Rp." + formatNumber(g_total.toFixed(0)) + ",-");
      $(".total_pembelian").attr("id", jumlahkan_total);
      $(".sub_total_pembelian").text("Rp." + formatNumber(jumlahkan_total) + ",-");
      $(".sub_total_pembelian").attr("id", jumlahkan_total);

      $(".total_form").val(g_total);
      $(".sub_total_form").val(jumlahkan_total);

      // total Diskon
      $(".total_diskon_pembelian").text("Rp." + formatNumber(jumlahkan_total_diskon.toFixed(0)) + ",-");
      $(".total_diskon_pembelian").attr("id", jumlahkan_total_diskon);
      $(".sub_total_diskon_pembelian").text("Rp." + formatNumber(jumlahkan_total_diskon.toFixed(0)) + ",-");
      $(".sub_total_diskon_pembelian").attr("id", jumlahkan_total_diskon);

      $(".total_diskon_form").val(jumlahkan_total_diskon);
      $(".sub_total_diskon_form").val(jumlahkan_total_diskon);

      $(".subjumlah_form").val(subjumlah);
      console.log('subjumlah = ' + subjumlah)

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
      $("#tambahkan_harga_dasar").val("");


      $("#tombol-tambahkan").show();
      $("#tombol-update").hide();
      $("#tombol-update-cancel").hide();

      $("#table-pembelian tr").removeClass('bg-yellow');


      // update Tax
      var tax = $(".total_tax").val();
      if (tax.length != 0 && tax != "") {
        console.log("masuk masih di posisi update tax");
        console.log('tax = ' + tax);

        var sub_total = $(".sub_total_pembelian").attr("id");
        console.log('sub_total = ' + sub_total);
        var total_diskon = $(".sub_total_diskon_pembelian").attr("id");
        console.log('total_diskon = ' + total_diskon);

        var hasil_tax = Math.round((sub_total - total_diskon) * (tax / 100));
        console.log('hasil_tax = ' + hasil_tax);
        $(".hasil_tax").text("Rp." + formatNumber(hasil_tax.toFixed(0)) + ",-");
        $(".hasil_tax_form").val(hasil_tax.toFixed(0));
      } else {
        var sub_total_pembelian = $(".sub_total_pembelian").attr("id");

        $(".total_pembelian").attr("id", sub_total_pembelian);
        $(".total_pembelian").text("Rp." + formatNumber(sub_total_pembelian) + ",-");
      }
      $("#kalkulator").hide(100);
      $("#form_ket").hide(100);

      paymenttotalkembali();

    });

    // tombol update produk
    $("body").on("click", "#tombol-update", function() {
      // console.log('Masuk tombol-update');
      var rowTabel = $("#table-pembelian tbody tr");
      // cek apakah ada jumlah baru yang kurang dari sebelumnya
      var cek_jumlah_kurang = false;

      function number_format23(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      }

      function filterAndConvertToInt(value) {
        // Menghapus semua karakter selain angka menggunakan regex
        var filteredValue = value.replace(/\D/g, '');

        // Mengubah nilai yang difilter menjadi integer
        var intValue = parseInt(filteredValue, 10);

        // Mengembalikan nilai integer, atau 0 jika nilainya tidak valid
        return isNaN(intValue) ? 0 : intValue;
      }
      // rowTabel.each(function(i, el) {
      //   var jumlah = $(el).find('input.transaksi_jumlah').val();
      //   var jumlah_baru = $(el).find('input.jumlah_transaksi_input').val();
      //   if (parseInt(jumlah_baru) < parseInt(jumlah)) {
      //     cek_jumlah_kurang = true;
      //     return false;
      //   }
      // });
      // // jika jumlah ada yang dikurangi
      // if(cek_jumlah_kurang){
      //   Swal.fire({
      //     title: "Masukan Kode Authentifikasi Atasan sebelum melakukan pengurangan!",
      //     input: "text",
      //     inputAttributes: {
      //       autocapitalize: "off"
      //     },
      //     showCancelButton: true,
      //     confirmButtonText: "Submit",
      //     showLoaderOnConfirm: true,
      //     preConfirm: async (authCode) => {
      //       try {
      //         const response = await fetch('route/data_kasir/ajax_authentifikasi.php', {
      //           method: 'POST',
      //           headers: {
      //             'Content-Type': 'application/json'
      //           },
      //           body: JSON.stringify({ authCode })
      //         });
      //         if (!response.ok) {
      //           throw new Error(await response.text());
      //         }
      //         const result = await response.json();
      //         if (!result.status) {
      //           Swal.showValidationMessage(result.message);
      //         }
      //         return result;
      //       } catch (error) {
      //         Swal.showValidationMessage(`Request failed: ${error}`);
      //       }
      //     },
      //     allowOutsideClick: () => !Swal.isLoading()
      //   }).then((result) => {
      //     // jika authentifikasi benar
      //     if(result.value.status){
      //       // jumlahkan pembelian
      //       var jumlahkan_jumlah = 0;
      //       var jumlahkan_harga = 0;
      //       var jumlahkan_total = 0;
      //       var jumlahkan_diskon = 0;
      //       var jumlahkan_total_diskon = 0;
      //       var tax = $(".total_tax").val();
      //       var ket_baru = $("#tambahkan_ket").val();
      //       rowTabel.each(function(i, el) {
      //         var kode = $(el).find('input.transaksi_produk').val();
      //         var nama = $(el).find('input.transaksi_nama').val();
      //         var harga = $(el).find('input.transaksi_harga').val();
      //         var diskon = $(el).find('input.transaksi_diskon').val();
      //         var ket = $(el).find('input.transaksi_ket').val();
      //         var kd_promo = $(el).find('input.transaksi_kd_promo').val();
      //         var harga_dasar = $(el).find('input.transaksi_harga_dasar').val();
      //         var jumlah = $(el).find('input.transaksi_jumlah').val();
      //         var total = $(el).find('input.transaksi_total').val();
      //         var total_diskon = $(el).find('input.transaksi_total_diskon').val();
      //         var jumlah_baru = $(el).find('input.jumlah_transaksi_input').val();
      //         jumlah_baru = filterAndConvertToInt(jumlah_baru);

      //         var harga_total_baru = parseInt(harga) * jumlah_baru;
      //         var diskon_total_baru = parseInt(diskon) * jumlah_baru;

      //         // update jumlah dan totalharga
      //         $(el).find('input.transaksi_jumlah').val(jumlah_baru);
      //         $(el).find('input.transaksi_total').val(harga_total_baru);
      //         $(el).find('input.transaksi_ket').val(ket_baru);
      //         // update tombol hapus
      //         $(el).find('.tombol-hapus-penjualan').attr("jumlah", jumlah_baru);
      //         $(el).find('.tombol-hapus-penjualan').attr("total", harga_total_baru);
      //         $(el).find('.tombol-hapus-penjualan').attr("total_diskon", diskon_total_baru);

      //         $(el).find('td:eq(2) input').val(jumlah_baru);
      //         $(el).find('td:eq(5)').html(number_format23(harga_total_baru));
      //         $(el).find('td:eq(7)').html(number_format23(diskon_total_baru));

      //         // sum jumlah, harga total, diskon total
      //         jumlahkan_jumlah += jumlah_baru;
      //         jumlahkan_total += parseInt(harga_total_baru);
      //         jumlahkan_diskon += parseInt(diskon_total_baru);
      //       });
      //       // update total pembelian
      //       // isi di table penjualan
      //       $(".pembelian_jumlah").attr("id", jumlahkan_jumlah);
      //       $(".pembelian_total").attr("id", jumlahkan_total);
      //       $(".pembelian_total_diskon").attr("id", jumlahkan_total_diskon);
      //       // tulis di table penjualan
      //       $(".pembelian_jumlah").text(formatNumber(jumlahkan_jumlah));
      //       $(".pembelian_total").text("Rp." + formatNumber(jumlahkan_total));
      //       $(".pembelian_total_diskon").text("Rp." + formatNumber(jumlahkan_total_diskon.toFixed(0)));
      //       // total
      //       $(".jumlah_total_pembelian").text(formatNumber(jumlahkan_jumlah));
      //       var subjumlah = Math.round(jumlahkan_total - jumlahkan_total_diskon);
      //       var g_total = Math.round(((jumlahkan_total - jumlahkan_total_diskon) + (jumlahkan_total - jumlahkan_total_diskon) * tax / 100));
      //       $(".total_pembelian").text("Rp." + formatNumber(g_total.toFixed(0)) + "");
      //       $(".total_pembelian").attr("id", jumlahkan_total);
      //       $(".sub_total_pembelian").text("Rp." + formatNumber(jumlahkan_total) + "");
      //       $(".sub_total_pembelian").attr("id", jumlahkan_total);
      //       $(".total_form").val(g_total);
      //       $(".sub_total_form").val(jumlahkan_total);
      //       // total Diskon
      //       $(".total_diskon_pembelian").text("Rp." + formatNumber(jumlahkan_total_diskon.toFixed(0)) + ",-");
      //       $(".total_diskon_pembelian").attr("id", jumlahkan_total_diskon);
      //       $(".sub_total_diskon_pembelian").text("Rp." + formatNumber(jumlahkan_total_diskon.toFixed(0)) + "");
      //       $(".sub_total_diskon_pembelian").attr("id", jumlahkan_total_diskon);
      //       $(".total_diskon_form").val(jumlahkan_total_diskon);
      //       $(".sub_total_diskon_form").val(jumlahkan_total_diskon);
      //       $(".subjumlah_form").val(subjumlah);
      //       // hide tombol
      //       $("#tombol-tambahkan").show();
      //       $("#tombol-update").hide();
      //       $("#tombol-update-cancel").hide();
      //       $("#table-pembelian tr").removeClass('bg-yellow');
      //       // update Tax
      //       var tax = $(".total_tax").val();
      //       if (tax.length != 0 && tax != "") {
      //         // console.log("masuk masih di posisi update tax");
      //         // console.log('tax = ' + tax);
      //         var sub_total = $(".sub_total_pembelian").attr("id");
      //         // console.log('sub_total = ' + sub_total);
      //         var total_diskon = $(".sub_total_diskon_pembelian").attr("id");
      //         // console.log('total_diskon = ' + total_diskon);
      //         var hasil_tax = Math.round((sub_total - total_diskon) * (tax / 100));
      //         // console.log('hasil_tax = ' + hasil_tax);
      //         $(".hasil_tax").text("Rp." + formatNumber(hasil_tax.toFixed(0)) + "");
      //         $(".hasil_tax_form").val(hasil_tax.toFixed(0));
      //       } else {
      //         var sub_total_pembelian = $(".sub_total_pembelian").attr("id");
      //         $(".total_pembelian").attr("id", sub_total_pembelian);
      //         $(".total_pembelian").text("Rp." + formatNumber(sub_total_pembelian) + ",-");
      //       }
      //       $("#kalkulator").hide(100);
      //       $("#form_jml").hide(100);
      //       $("#form_ket").hide(100);
      //       paymenttotalkembali();
      //     }
      //   });

      // } else {
      // jumlahkan pembelian
      var jumlahkan_jumlah = 0;
      var jumlahkan_harga = 0;
      var jumlahkan_total = 0;
      var jumlahkan_diskon = 0;
      var jumlahkan_total_diskon = 0;
      var tax = $(".total_tax").val();
      var ket_baru = $("#tambahkan_ket").val();
      rowTabel.each(function(i, el) {
        // ambil data
        // var kode = $(el).find('input.transaksi_produk').val();
        // var nama = $(el).find('input.transaksi_nama').val();
        // var harga = $(el).find('input.transaksi_harga').val();
        // var diskon = $(el).find('input.transaksi_diskon').val();
        // var ket = $(el).find('input.transaksi_ket').val();
        // var kd_promo = $(el).find('input.transaksi_kd_promo').val();
        // var harga_dasar = $(el).find('input.transaksi_harga_dasar').val();
        // var jumlah = $(el).find('input.transaksi_jumlah').val();
        // var total = $(el).find('input.transaksi_total').val();
        // var total_diskon = $(el).find('input.transaksi_total_diskon').val();
        // var jumlah_baru = $(el).find('input.jumlah_transaksi_input').val();
        // jumlah_baru = filterAndConvertToInt(jumlah_baru);
        // // kalkulasikan data
        // var harga_total_baru = parseInt(harga) * jumlah_baru;
        // var diskon_total_baru = parseInt(diskon) * jumlah_baru;
        // console.log("Total Diskon: "+diskon_total_baru);
        // // update jumlah dan totalharga
        // $(el).find('input.transaksi_jumlah').val(jumlah_baru);
        // $(el).find('input.transaksi_total').val(harga_total_baru);
        $(el).find('input.transaksi_ket').val(ket_baru);
        // update tombol hapus
        // $(el).find('.tombol-hapus-penjualan').attr("jumlah", jumlah_baru);
        // $(el).find('.tombol-hapus-penjualan').attr("total", harga_total_baru);
        // $(el).find('.tombol-hapus-penjualan').attr("total_diskon", diskon_total_baru);

        // $(el).find('td:eq(2) input').val(jumlah_baru);
        // $(el).find('td:eq(5)').html(number_format23(harga_total_baru));
        // $(el).find('td:eq(7)').html(number_format23(diskon_total_baru));

        // // sum jumlah, harga total, diskon total
        // jumlahkan_jumlah += jumlah_baru;
        // jumlahkan_total += parseInt(harga_total_baru);
        // jumlahkan_diskon += parseInt(diskon_total_baru);
      });
      // update total pembelian
      // isi di table penjualan
      // $(".pembelian_jumlah").attr("id", jumlahkan_jumlah);
      // $(".pembelian_total").attr("id", jumlahkan_total);
      // $(".pembelian_total_diskon").attr("id", jumlahkan_total_diskon);
      // // tulis di table penjualan
      // $(".pembelian_jumlah").text(formatNumber(jumlahkan_jumlah));
      // $(".pembelian_total").text("Rp." + formatNumber(jumlahkan_total));
      // $(".pembelian_total_diskon").text("Rp." + formatNumber(jumlahkan_total_diskon.toFixed(0)));
      // // total
      // $(".jumlah_total_pembelian").text(formatNumber(jumlahkan_jumlah));
      // var subjumlah = Math.round(jumlahkan_total - jumlahkan_total_diskon);
      // var g_total = Math.round(((jumlahkan_total - jumlahkan_total_diskon) + (jumlahkan_total - jumlahkan_total_diskon) * tax / 100));
      // $(".total_pembelian").text("Rp." + formatNumber(g_total.toFixed(0)) + "");
      // $(".total_pembelian").attr("id", jumlahkan_total);
      // $(".sub_total_pembelian").text("Rp." + formatNumber(jumlahkan_total) + "");
      // $(".sub_total_pembelian").attr("id", jumlahkan_total);
      // $(".total_form").val(g_total);
      // $(".sub_total_form").val(jumlahkan_total);
      // // total Diskon
      // $(".total_diskon_pembelian").text("Rp." + formatNumber(jumlahkan_total_diskon.toFixed(0)) + ",-");
      // $(".total_diskon_pembelian").attr("id", jumlahkan_total_diskon);
      // $(".sub_total_diskon_pembelian").text("Rp." + formatNumber(jumlahkan_total_diskon.toFixed(0)) + "");
      // $(".sub_total_diskon_pembelian").attr("id", jumlahkan_total_diskon);
      // $(".total_diskon_form").val(jumlahkan_total_diskon);
      // $(".sub_total_diskon_form").val(jumlahkan_total_diskon);
      // $(".subjumlah_form").val(subjumlah);
      // hide tombol
      $("#tombol-tambahkan").show();
      $("#tombol-update").hide();
      $("#tombol-update-cancel").hide();
      $("#table-pembelian tr").removeClass('bg-yellow');
      // // update Tax
      // var tax = $(".total_tax").val();
      // if (tax.length != 0 && tax != "") {
      //   // console.log("masuk masih di posisi update tax");
      //   // console.log('tax = ' + tax);
      //   var sub_total = $(".sub_total_pembelian").attr("id");
      //   // console.log('sub_total = ' + sub_total);
      //   var total_diskon = $(".sub_total_diskon_pembelian").attr("id");
      //   // console.log('total_diskon = ' + total_diskon);
      //   var hasil_tax = Math.round((sub_total - total_diskon) * (tax / 100));
      //   // console.log('hasil_tax = ' + hasil_tax);
      //   $(".hasil_tax").text("Rp." + formatNumber(hasil_tax.toFixed(0)) + "");
      //   $(".hasil_tax_form").val(hasil_tax.toFixed(0));
      // } else {
      //   var sub_total_pembelian = $(".sub_total_pembelian").attr("id");
      //   $(".total_pembelian").attr("id", sub_total_pembelian);
      //   $(".total_pembelian").text("Rp." + formatNumber(sub_total_pembelian) + ",-");
      // }
      $("#kalkulator").hide(100);
      $("#form_jml").hide(100);
      $("#form_ket").hide(100);
      // paymenttotalkembali();
      // }

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


    // tombol tambah penjualan
    $("body").on("click", ".tombol-tambah_2-penjualan", function() {

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
      var tambahin_jumlah = eval(pembelian_jumlah) + eval(jumlah);
      var tambahin_harga = eval(pembelian_harga) + eval(harga);
      var tambahin_total = eval(pembelian_total) + eval(total);
      var tambahin_diskon = eval(pembelian_diskon) + eval(diskon);
      var tambahin_total_diskon = eval(pembelian_total_diskon) + eval(total_diskon);

      // isi di table penjualan
      $(".pembelian_jumlah").attr("id", tambahin_jumlah);
      $(".pembelian_harga").attr("id", tambahin_harga);
      $(".pembelian_total").attr("id", tambahin_total);
      $(".pembelian_diskon").attr("id", tambahin_diskon);
      $(".pembelian_total_diskon").attr("id", tambahin_total_diskon);

      // tulis di table penjualan
      $(".pembelian_jumlah").text(formatNumber(tambahin_jumlah));
      // $(".pembelian_harga").text(formatNumber(tambahin_harga) + ",-");
      $(".pembelian_total").text("Rp." + formatNumber(tambahin_total));
      // $(".pembelian_diskon").text(formatNumber(tambahin_diskon) + ",-");
      $(".pembelian_total_diskon").text("Rp." + formatNumber(tambahin_total_diskon.toFixed(0)));

      // total
      $(".jumlah_total_pembelian").text(formatNumber(tambahin_jumlah));
      console.log("Tax tambah");
      console.log(tambahin_total);
      console.log(tambahin_total_diskon);
      console.log(tax);
      $(".sub_total_pembelian").text("Rp." + formatNumber(tambahin_total) + ",-");
      // $(".total_pembelian").text("Rp." + formatNumber(tambahin_total-tambahin_total_diskon) + ",-");
      var subjumlah = Math.round(tambahin_total - tambahin_total_diskon);
      var g_total = Math.round(((tambahin_total - tambahin_total_diskon) + (tambahin_total - tambahin_total_diskon) * tax / 100));
      $(".total_pembelian").text("Rp." + formatNumber(g_total.toFixed(0)) + ",-");
      $(".total_pembelian").attr("id", tambahin_total);
      $(".sub_total_pembelian").attr("id", tambahin_total);

      $(".total_form").val(g_total);
      $(".sub_total_form").val(tambahin_total);

      // total Diskon text("Rp."+formatNumber(hasil_tax.toFixed(0))+",-");
      $(".total_diskon_pembelian").text("Rp." + formatNumber(tambahin_total_diskon.toFixed(0)) + ",-");
      $(".sub_total_diskon_pembelian").text("Rp." + formatNumber(tambahin_total_diskon.toFixed(0)) + ",-");
      $(".total_diskon_pembelian").attr("id", tambahin_total_diskon);
      $(".sub_total_diskon_pembelian").attr("id", tambahin_total_diskon);

      $(".total_diskon_form").val(tambahin_total_diskon);
      $(".sub_total_diskon_form").val(tambahin_total_diskon);
      $(".subjumlah_form").val(subjumlah);

      // ini.closest("tr").remove();

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

      // $("#table-pembelian tr").removeClass('bg-yellow');


      // update Tax
      var tax = $(".total_tax").val();
      if (tax.length != 0 && tax != "") {
        console.log(tax);
        console.log("masuk hapus 1");

        var sub_total = $(".sub_total_pembelian").attr("id");
        console.log("sub total = " + sub_total);
        var total_diskon = $(".sub_total_diskon_pembelian").attr("id");
        console.log("total diskon = " + total_diskon);

        var hasil_tax = Math.round((sub_total - total_diskon) * (tax / 100));
        console.log("tax = " + hasil_tax);
        $(".hasil_tax").text("Rp." + formatNumber(hasil_tax.toFixed(0)) + ",-");
        $(".hasil_tax_form").val(hasil_tax.toFixed(0));
      } else {
        var sub_total_pembelian = $(".sub_total_pembelian").attr("id");

        $(".total_pembelian").attr("id", sub_total_pembelian);
        $(".total_pembelian").text("Rp." + formatNumber(sub_total_pembelian) + ",-");
      }

      paymenttotalkembali()

    });

    // tombol hapus penjualan
    $("body").on("click", ".tombol-hapus-penjualan", function() {
      // Swal.fire({
      //   title: "Masukan Kode Authentifikasi Atasan sebelum melakukan pengurangan!",
      //   input: "text",
      //   inputAttributes: {
      //     autocapitalize: "off"
      //   },
      //   showCancelButton: true,
      //   confirmButtonText: "Submit",
      //   showLoaderOnConfirm: true,
      //   preConfirm: async (authCode) => {
      //     try {
      //       const response = await fetch('route/data_kasir/ajax_authentifikasi.php', {
      //         method: 'POST',
      //         headers: {
      //           'Content-Type': 'application/json'
      //         },
      //         body: JSON.stringify({ authCode })
      //       });
      //       if (!response.ok) {
      //         throw new Error(await response.text());
      //       }
      //       const result = await response.json();
      //       if (!result.status) {
      //         Swal.showValidationMessage(result.message);
      //       }
      //       return result;
      //     } catch (error) {
      //       Swal.showValidationMessage(`Request failed: ${error}`);
      //     }
      //   },
      //   allowOutsideClick: () => !Swal.isLoading()
      // }).then((result) => {
      //   // jika authentifikasi benar
      //   if(result.value.status){
      var ini = $(this);
      var id = $(this).attr("id");
      var jumlah = $(this).attr("jumlah");
      var harga = $(this).attr("harga");
      var total = $(this).attr("total");
      var diskon = $(this).attr("diskon");
      var total_diskon = $(this).attr("total_diskon");

      var tax = $(".total_tax").val();
      var sumjumlah = 0;
      var sumtotal = 0;

      $(this).closest("tr").nextAll("tr").each(function() {
        var jumlahnext = parseFloat($(this).find(".transaksi_jumlah").val());
        var totalnext = parseFloat($(this).find(".transaksi_total").val());
        sumtotal += totalnext;
        sumjumlah += jumlahnext;
      });

      if (id == "15-01-09-0001") {
        var existingRow = $("#table-pembelian").find("tr[id='tr_15-01-09-0001']");
        var existingJumlah = parseInt(existingRow.find('.transaksi_jumlah').val());
        var existingHargaTotal = parseInt(existingRow.find('.transaksi_total').val());
        jumlah = sumjumlah + existingJumlah;
        total = sumtotal + existingHargaTotal;
        ini.closest("tr").nextAll("tr").remove();
        $("#table-pembelian tr").nextAll().removeClass('bg-yellow');
      }


      // update total pembelian
      var pembelian_jumlah = $(".pembelian_jumlah").attr("id");
      var pembelian_harga = $(".pembelian_harga").attr("id");
      var pembelian_total = $(".pembelian_total").attr("id");
      var pembelian_diskon = $(".pembelian_diskon").attr("id");
      var pembelian_total_diskon = $(".pembelian_total_diskon").attr("id");

      console.log("jumlah === " + pembelian_jumlah)

      console.log("beli === " + pembelian_harga)
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
      // console.log("Tax hapus");
      // console.log(kurangi_total);
      // console.log(kurangi_total_diskon);
      // console.log(tax);
      $(".sub_total_pembelian").text("Rp." + formatNumber(kurangi_total) + ",-");
      // $(".total_pembelian").text("Rp." + formatNumber(kurangi_total-kurangi_total_diskon) + ",-");
      var subjumlah = Math.round(kurangi_total - kurangi_total_diskon);
      var g_total = Math.round(((kurangi_total - kurangi_total_diskon) + (kurangi_total - kurangi_total_diskon) * tax / 100));
      $(".total_pembelian").text("Rp." + formatNumber(g_total.toFixed(0)) + ",-");
      $(".total_pembelian").attr("id", kurangi_total);
      $(".sub_total_pembelian").attr("id", kurangi_total);

      $(".total_form").val(g_total);
      $(".sub_total_form").val(kurangi_total);

      // total Diskon text("Rp."+formatNumber(hasil_tax.toFixed(0))+",-");
      $(".total_diskon_pembelian").text("Rp." + formatNumber(kurangi_total_diskon.toFixed(0)) + ",-");
      $(".sub_total_diskon_pembelian").text("Rp." + formatNumber(kurangi_total_diskon.toFixed(0)) + ",-");
      $(".total_diskon_pembelian").attr("id", kurangi_total_diskon);
      $(".sub_total_diskon_pembelian").attr("id", kurangi_total_diskon);

      $(".total_diskon_form").val(kurangi_total_diskon);
      $(".sub_total_diskon_form").val(kurangi_total_diskon);
      $(".subjumlah_form").val(subjumlah);
      $(".pembelian_total_diskon").text("Rp." + formatNumber(g_total.toFixed(0)) + "");

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
      if (tax.length != 0 && tax != "") {
        console.log(tax);
        console.log("masuk hapus 1");

        var sub_total = $(".sub_total_pembelian").attr("id");
        console.log("sub total = " + sub_total);
        var total_diskon = $(".sub_total_diskon_pembelian").attr("id");
        console.log("total diskon = " + total_diskon);

        var hasil_tax = Math.round((sub_total - total_diskon) * (tax / 100));
        console.log("tax = " + hasil_tax);
        $(".hasil_tax").text("Rp." + formatNumber(hasil_tax.toFixed(0)) + ",-");
        $(".hasil_tax_form").val(hasil_tax.toFixed(0));
      } else {
        var sub_total_pembelian = $(".sub_total_pembelian").attr("id");

        $(".total_pembelian").attr("id", sub_total_pembelian);
        $(".total_pembelian").text("Rp." + formatNumber(sub_total_pembelian) + ",-");
      }

      paymenttotalkembali();
      $("#tombol-simpan").prop("disabled", true);
      //   }
      // });
    });



    // diskon
    $("body").on("keyup change", ".total_diskon", function() {
      var diskon = $(this).val();

      if (diskon.length != 0 && diskon != "") {

        var sub_total = $(".sub_total_pembelian").attr("id");
        var total = $(".total_pembelian").attr("id");

        var hasil_diskon = sub_total * diskon / 100;
        var hasil2 = sub_total - hasil_diskon;
        $(".total_pembelian").text("Rp." + formatNumber(hasil2) + ",-");
        $(".total_form").val(hasil2);

      } else {

        var sub_total_pembelian = $(".sub_total_pembelian").attr("id");
        var sub_total_diskon_pembelian = $(".sub_total_diskon_pembelian").attr("id");
        var sub_total_pembelian = sub_total_pembelian - sub_total_diskon_pembelian;
        $(".total_pembelian").attr("id", sub_total_pembelian);
        $(".total_pembelian").text("Rp." + formatNumber(sub_total_pembelian) + ",-");
      }
    });

  });

  var kode_seri = [];

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

      // "<td align='center'> <span class='btn btn-sm btn-danger tombol-hapus-voucher' total='" + total + "' jumlah='" + jumlah + "' nilai='" + nilai + "' harga='" + harga + "' terbit='" + terbit + "' daluarsa='" + daluarsa + "' id='" + id + "'><i class='fa fa-trash'></i> Batal</span></td>" +

      "</tr>";
    console.log('id = ' + id)
    console.log('kode =' + kode)

    hasil_kode_seri = kode_seri.indexOf(kode)
    console.log('hasil_kode_seri =' + hasil_kode_seri)
    console.log('kode_seri =' + kode_seri)

    $('#pesan_voucher').html("");

    if (hasil_kode_seri != -1) {
      console.log("masuk ke data no seri ditemukan")
      // document.writeln("sudah ada");
      $('#tempat_voucher').html("");
      $('#pesan_voucher').html("Sudah dipakai");
    } else {

      kode_seri.push(kode)

      $("#table-voucher tbody").append(table_voucher);

      // update total voucher
      var voucher_harga = $(".voucher_harga").attr("id");
      var voucher_jumlah = $(".voucher_jumlah").attr("id");
      var voucher_total = $(".voucher_total").attr("id");
      var voucher_nilai = $(".voucher_nilai").attr("id");

      console.log('total Voucher =' + voucher_total)

      // jumlahkan voucher
      var jumlahkan_harga = eval(voucher_harga) + eval(harga);
      var jumlahkan_jumlah = eval(voucher_jumlah) + eval(jumlah);
      var jumlahkan_total = eval(voucher_total) + eval(total);
      var jumlahkan_nilai = eval(voucher_nilai) + eval(nilai);

      console.log('harga =' + jumlahkan_harga)
      console.log('jml =' + jumlahkan_jumlah)
      console.log('nilai =' + jumlahkan_nilai)
      console.log('total =' + jumlahkan_total)

      // isi di table voucher
      $(".voucher_harga").attr("id", jumlahkan_harga);
      $(".voucher_jumlah").attr("id", jumlahkan_jumlah);
      $(".voucher_total").attr("id", jumlahkan_total);
      $(".voucher_nilai").attr("id", jumlahkan_nilai);

      // tulis di table voucher
      $(".voucher_harga").text(jumlahkan_harga);
      $(".voucher_jumlah").text(jumlahkan_jumlah);
      $(".voucher_total").text(jumlahkan_total);
      $(".voucher_nilai").text(jumlahkan_nilai);


      $(".payment_voucher_total").val(jumlahkan_total);
      // document.getElementById("payment_nilai_voucher").innerHTML = "Rp. <b> "+jumlahkan_total+"</b>";

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
    }

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
    $(".total_voucher").attr("id", kurangi_total);

    // $(".total_form").val(kurangi_total);
    // $(".total_form").val(kurangi_total);
    kode_seri.splice(id, 1);
    $("#tr_" + id).remove();

    $(".payment_voucher_total").val(kurangi_total);
    paymenttotalkembali();

  });



  function cek() {
    var total = $(".total_pembelian").attr("id");
    if (total > 0) {
      return confirm('Apakah anda yakin ingin memproses transaksi?');
      // return true;
    } else {
      alert("Pembelian Masih Kosong");
      return false;
    }
  }


  (function($) {
    $.fn.inputFilter = function(callback, errMsg) {
      return this.on("input keydown keyup mousedown mouseup select contextmenu drop focusout", function(e) {
        if (callback(this.value)) {
          // Accepted value
          if (["keydown", "mousedown", "focusout"].indexOf(e.type) >= 0) {
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
    return /^\d*$/.test(value) && (value === "" || parseInt(value) <= 100);
  }, "Must be between 0 and 100");
</script>



<!-- <script>
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
</script> -->



<script>
  // pilih alatbayar TIDAK DIPAKAI
  // $(document).on("click", ".modal-pilih-alatbayar", function() {

  //   var id = $(this).attr('id');
  //   var kode = $("#alatbayar_kode_" + id).val();
  //   var nama = $("#alatbayar_nama_" + id).val();
  //     // var harga = $("#alatbayar_harga_" + id).val();

  //   $("#tampil_alatbayar_id").val(id);
  //   $("#tampil_alatbayar_kode").val(kode);
  //   $("#tampil_alatbayar_nama").val(nama);
  //   $("#payment_alatbayar_nama").val(nama);

  //   $("#status_alatbayar").html("<small style='color:green;font-style:italic'>Alatbayar ditemukan</small>");
  // });


  // pilih alatbayar (TIDAK DI PAKAI)
  // $(document).on("click", ".payment-pilih-alatbayar", function() {

  //   var id = $(this).attr('id');
  //   var kode = $("#alatbayar_kode_" + id).val();
  //   var nama = $("#alatbayar_nama_" + id).val();

  //   console.log("masuk payment pilih alatbayar")

  //   close_alatbayar()
  //   open_sub_alatbayar()

  // });

  // pilih Aplikasi
  $(document).on("click", ".pilih-alatbayar", function() {
    console.log('pilih alat bayar /footer')

    var id = $(this).attr('id');
    var kode = $("#alatbayar_kode_" + id).val();
    var nama = $("#alatbayar_nama_" + id).val();
    // var kdaplikasi = $("#alatbayar_kdaplikasi_" + id).val();

    console.log('kode = ' + kode);
    console.log(nama);
    menupilihan_alatbayar(kode);
    // var btn = document.getElementById("tombolAplikasi");
    // btn.innerHTML=nama;
    // close_alatbayar();

  });



  // INI YG di pakai utk ALAT BAYAR
  function menupilihan_alatbayar(countryID) {
    // var countryID = $(this).val();
    console.log("Masuk menupilihan_alatbayar /footer")
    open_sub_alatbayar();

    if (countryID) {
      var dt = {};
      dt.kd_alatbayar = countryID;
      // dt.kd_kota = '<?php echo $kd_kota; ?>';
      // console.log(masuk)
      console.log(dt.kd_alatbayar)

      var kd_alatbayar = dt.kd_alatbayar;
      console.log(kd_alatbayar);

      $.ajax({
        type: 'POST',
        url: 'route/data_kasir/ajax_alatbayar.php',
        data: dt,
        success: function(html) {
          // console.log(res);
          $('#sub_alat_bayar').html(html);
        }
      });

    } else {
      $('#state').html('<option value="">Select country first</option>');
      $('#city').html('<option value="">Select state first</option>');
    }

  };




  // pilih sub alatbayar
  $(document).on("click", ".payment-pilih-sub-alatbayar", function() {
    console.log(".")
    console.log('menu pilih sub alat bayar /footer')

    var id = $(this).attr('id');
    var kode = $("#alatbayar_kode_" + id).val();
    var nama = $("#alatbayar_nama_" + id).val();
    // var tarif = $("#alatbayar_tarif_" + id).val();
    console.log(kode)

    var total_pembelian = $(".total_form").val();
    var total_payment = parseInt(total_pembelian);

    var payment_nilai_voucher = $(".payment_voucher_total").val();
    var payment_nilai_tunai = $("#payment_nilai_tunai").val();

    var payment_nilai_non_tunai = 0;


    if (payment_nilai_tunai == "") {
      console.log('payment_nilai_tunai kosong')
      payment_nilai_tunai = '0';
      console.log('payment_nilai_tunai : ' + payment_nilai_tunai)
    }

    let nilai_tunai_desimal = payment_nilai_tunai.replace(/\./g, "");
    var jumlah = parseInt(payment_nilai_voucher) + parseInt(nilai_tunai_desimal);

    console.log('payment_nilai_voucher : ' + payment_nilai_voucher)
    console.log('nilai_tunai_desimal : ' + nilai_tunai_desimal)

    var jumlahparse = parseInt(jumlah);

    if (payment_nilai_tunai == "") {
      console.log('tunai kosong')
      payment_nilai_tunai = "0";
      console.log('tunai : ' + payment_nilai_tunai)
    }

    console.log('total_payment : ' + total_payment)
    console.log('jumlahparse : ' + jumlahparse)




    if (total_payment > jumlahparse) {
      payment_nilai_non_tunai = total_payment - payment_nilai_voucher - nilai_tunai_desimal;
    }

    console.log('total : ' + total_pembelian)
    console.log('vouvher : ' + payment_nilai_voucher)
    console.log('tunai : ' + payment_nilai_tunai)
    console.log('non tunai : ' + payment_nilai_non_tunai)


    $("#payment_alatbayar_nama").val(nama);
    $("#payment_sub_alatbayar").val(kode);
    $("#payment_nilai_non_tunai").val(payment_nilai_non_tunai);
    $("#payment_awal_sub_alatbayar").val(payment_nilai_non_tunai);

    var rupiah3 = document.getElementById('payment_nilai_non_tunai');

    rupiah3.value = formatRupiah(rupiah3.value);
    close_alatbayar();
    // close_sub_alatbayar();
    paymenttotalkembali();

    $('#tampil_alatbayar_pin').removeAttr('disabled');
    $('#payment_nilai_non_tunai').removeAttr('disabled');

    // $("#status_alatbayar").html("<small style='color:green;font-style:italic'>Alatbayar ditemukan</small>");

  });


  function paymenttotalkembali() {
    // console.log(".")
    // console.log("masuk payment total kembali");

    var total_pembelian = $(".total_form").val();
    // var total_pembelian = $(".total_pembelian").val();
    // var total_pembelian = document.getElementById("payment_total_pembelian").value;
    var nilai_voucher = document.getElementById("payment_nilai_voucher").value;
    var nilai_non_tunai = document.getElementById("payment_nilai_non_tunai").value;
    var nilai_awal_non_tunai = document.getElementById("payment_awal_sub_alatbayar").value;
    var nilai_tunai = document.getElementById("payment_nilai_tunai").value;
    var ongkos_kirim = document.getElementById("ongkos_kirim").value;
    var kode_alat_bayar = document.getElementById("payment_sub_alatbayar").value;
    var voucher_nilai_diskon = document.getElementById("voucher_nilai_diskon").value;


    // var nilai_no_ref =document.getElementById("tampil_alatbayar_pin").value;

    if (nilai_tunai == "") {
      // console.log('tunai kosong')
      nilai_tunai = '0';
      // console.log('tunai : '+nilai_tunai)
    }
    if (ongkos_kirim == "") {
      ongkos_kirim = '0';
    }
    if (voucher_nilai_diskon == "") {
      voucher_nilai_diskon = '0';
    }




    let nilai_tunai_desimal = nilai_tunai.replace(/\./g, "");
    let nilai_non_tunai_desimal = nilai_non_tunai.replace(/\./g, "");
    let ongkos_kirim_desimal = ongkos_kirim.replace(/\./g, "");
    let voucher_nilai_diskon_desimal = voucher_nilai_diskon.replace(/\./g, "");

    if (kode_alat_bayar != 0) {
      nilai_non_tunai_desimal = parseInt(nilai_awal_non_tunai) + parseInt(ongkos_kirim_desimal) - parseInt(voucher_nilai_diskon_desimal);
      $("#payment_nilai_non_tunai").val(nilai_non_tunai_desimal);
      var rupiah3 = document.getElementById('payment_nilai_non_tunai');
      rupiah3.value = formatRupiah(rupiah3.value);
    }

    var total_pembelian3 = parseInt(total_pembelian) + parseInt(ongkos_kirim_desimal) - parseInt(voucher_nilai_diskon_desimal);

    // console.log('tunai des : '+nilai_tunai_desimal)

    document.cookie = "nilai_tunai=" + nilai_tunai_desimal;
    document.cookie = "nilai_non_tunai=" + nilai_non_tunai_desimal;
    document.cookie = "ongkos_kirim=" + ongkos_kirim_desimal;
    document.cookie = "voucher_nilai_diskon=" + voucher_nilai_diskon_desimal;




    // console.log('Payment ');
    // console.log('total pembelian : ' + total_pembelian);
    // console.log('nilai voucher : ' + nilai_voucher)
    // console.log('nilai non tunai : ' + nilai_non_tunai);
    // console.log('nilai tunai : ' + nilai_tunai);
    // console.log('nilai No ref : '+nilai_no_ref);

    var sisa_kembali = total_pembelian3 - nilai_voucher - nilai_non_tunai_desimal - nilai_tunai_desimal;

    if (sisa_kembali < 0) {
      document.getElementById("lbl_status_pembayaran").innerHTML = "L U N A S";
      document.getElementById("lbl_status_payment").innerHTML = "Kembalian :";
      document.getElementById("paymentKembali").innerHTML = "Rp&emsp; <b> " + rubah(sisa_kembali) + ",-</b><input type='hidden' id='payment_kembali_hidden' name='payment_kembali' value='" + sisa_kembali + "'>";
      $('#tombol-simpan').removeAttr('disabled');
      $('#tombol-simpan2').removeAttr('disabled');
    } else if (sisa_kembali == 0) {
      document.getElementById("lbl_status_pembayaran").innerHTML = "L U N A S";
      document.getElementById("lbl_status_payment").innerHTML = "L U N A S :";
      document.getElementById("paymentKembali").innerHTML = "Rp&emsp; <b style='color:grey;'> " + rubah(sisa_kembali) + ",-</b><input type='hidden' id='payment_kembali_hidden' name='payment_kembali' value='" + sisa_kembali + "'>";
      $('#tombol-simpan').removeAttr('disabled');
      $('#tombol-simpan2').removeAttr('disabled');
    } else {
      document.getElementById("lbl_status_pembayaran").innerHTML = "Belum Lunas";
      document.getElementById("lbl_status_payment").innerHTML = "Kurang Bayar :";
      document.getElementById("paymentKembali").innerHTML = "Rp&emsp; <b style='color:red;'> " + rubah(sisa_kembali) + ",-</b><input type='hidden' id='payment_kembali_hidden' name='payment_kembali' value='" + sisa_kembali + "'>";
      $('#tombol-simpan').attr('disabled', 'disabled');
      $('#tombol-simpan2').attr('disabled', 'disabled');
    }

    // hitung digit angka
    let pembulatan = 100000;

    let pembulatan2 = 50000;

    total_pembelian = Math.ceil(total_pembelian / pembulatan) * pembulatan;
    total_pembelian2 = total_pembelian - 50000;
    let nilaiif = $(".total_form").val() - total_pembelian2;
    $('.btn-payment .col-sm-5 .btn-relative').remove();

    if (nilaiif < 0) {
      $('.btn-payment .col-sm-5 .btn-relative1').remove();
      $('.btn-payment .col-sm-5').append('<button style="margin-right: 10px; type="button" class="btn btn-primary btn-relative1">Rp. ' + rubah(total_pembelian2) + '</button>');
      $('.btn-payment .col-sm-5 .btn-relative1').on('click', function() {
        $('#payment_nilai_tunai').val(rubah(total_pembelian2));
        paymenttotalkembali();
      });
    } else {
      $('.btn-payment .col-sm-5 .btn-relative1').remove();

    }


    $('.btn-payment .col-sm-5').append('<button type="button" class="btn btn-primary btn-relative">Rp. ' + rubah(total_pembelian) + '</button>');
    $('.btn-payment .col-sm-5 .btn-relative').on('click', function() {
      $('#payment_nilai_tunai').val(rubah(total_pembelian));
      paymenttotalkembali();
    });
  }

  function rubah(angka) {
    var reverse = angka.toString().split('').reverse().join(''),
      ribuan = reverse.match(/\d{1,3}/g);
    ribuan = ribuan.join('.').split('').reverse().join('');
    return ribuan;
  }
</script>

<script type="text/javascript">
  $(document).ready(function() {
    load_menu_search();

    function load_menu_search(search) {
      console.log('masuk ke Load data')
      $.ajax({
        url: "route/data_kasir/ajax_menu_search.php",
        method: "POST",
        data: {
          search: search
        },
        success: function(data) {
          $('#tempat_search').html(data);
        }
      });
    }
    $('#search_menu').keyup(function() {
      console.log('Masuk ke search menu');
      var search_menu = $("#search_menu").val();
      clear_form_kanan();
      var tempat_search = document.getElementById('tempat_search');
      tempat_search.style.display = 'block';

      load_menu_search(search_menu);
    });



    function load_voucher_search(search) {
      console.log('masuk ke Load data voucher')
      $.ajax({
        url: "route/data_kasir/ajax_voucher_search.php",
        method: "POST",
        data: {
          search: search
        },
        success: function(data) {
          $('#tempat_voucher').html(data);
        }
      });
    }


  });
</script>

</body>

</html>