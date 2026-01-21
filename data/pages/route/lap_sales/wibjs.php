<script>
  $(document).ready(function() {


    function formatNumber(num) {
      return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    }

    // pilih pelanggan
    $(document).on("click", ".modal-pilih-pelanggan", function() {

      var id = $(this).attr('id');
      var kode = $(this).attr('kode');
      var nama = $(this).attr('nama');

      $("#tampil_pelanggan_id").val(id);
      $("#tampil_pelanggan_kode").val(kode);
      $("#tampil_pelanggan_kode2").val(kode);
      $("#tampil_pelanggan_nama").val(nama);

      $("#status_pelanggan").html("<small style='color:green;font-style:italic'>Pelanggan ditemukan</small>");
    });


    // pilih kota
    $(document).on("click", ".modal-pilih-kota", function() {

      var id = $(this).attr('id');
      var kode = $(this).attr('kode');
      var nama = $(this).attr('nama');

      $("#tampil_kota_id").val(id);
      $("#tampil_kota_kode").val(kode);
      $("#tampil_kota_kode2").val(kode);
      $("#tampil_kota_nama").val(nama);

      $("#tampil_outlet_id").val("");
      $("#tampil_area_id").val("");
      $('#id_generate').removeAttr('disabled');

      $("#status_kota").html("<small style='color:green;font-style:italic'>ditemukan</small>");
    });


    // pilih outlet
    $(document).on("click", ".modal-pilih-outlet", function() {

      var id = $(this).attr('id');
      var kode = $(this).attr('kode');
      var nama = $(this).attr('nama');

      $("#tampil_outlet_id").val(id);
      $("#tampil_outlet_kode").val(kode);
      $("#tampil_outlet_kode2").val(kode);
      $("#tampil_outlet_nama").val(nama);

      $("#tampil_kota_id").val("");
      $("#tampil_area_id").val("");
      $('#id_generate').removeAttr('disabled');

      $("#status_outlet").html("<small style='color:green;font-style:italic'>Outlet ditemukan</small>");
    });

    // pilih area
    $(document).on("click", ".modal-pilih-area", function() {

      var id = $(this).attr('id');
      var kode = $(this).attr('kode');
      var nama = $(this).attr('nama');

      $("#tampil_area_id").val(id);
      $("#tampil_area_kode").val(kode);
      $("#tampil_area_kode2").val(kode);
      $("#tampil_area_nama").val(nama);

      $("#tampil_kota_id").val("");
      $("#tampil_outlet_id").val("");
      $('#id_generate').removeAttr('disabled');

      $("#status_area").html("<small style='color:green;font-style:italic'>Kasir ditemukan</small>");
    });


    // ========= KeyUP PELANGGAN
    $("body").on("keyup", "#tampil_pelanggan_kode", function() {
      var kode = $(this).val();
      var data = "kode=" + kode;
      $.ajax({
        type: "POST",
        url: "pelanggan_cari_ajax.php",
        data: data,
        dataType: 'JSON',
        success: function(html) {
          if (html[0].id == "") {
            $("#tampil_pelanggan_id").val("");

            $("#tampil_pelanggan_nama").val("Pelanggan \"" + kode + "\" tidak ditemukan.");

            $("#status_pelanggan").html("<small style='color:red;font-style:italic'>Pelanggan tidak ditemukan</small>");
          } else {
            $("#tampil_pelanggan_id").val(html[0].id);

            $("#tampil_pelanggan_kode").val(html[0].kode);
            $("#tampil_pelanggan_nama").val(html[0].nama);

            $("#status_pelanggan").html("<small style='color:green;font-style:italic'>Pelanggan ditemukan</small>");
          }
        }
      });
    });


    // ========= KeyUP KOTA
    $("body").on("keyup", "#tampil_kota_kode", function() {
      var kode = $(this).val();
      var data = "kode=" + kode;
      $.ajax({
        type: "POST",
        url: "kota_cari_ajax.php",
        data: data,
        dataType: 'JSON',
        success: function(html) {
          if (html[0].id == "") {
            $("#tampil_kota_id").val("");

            $("#tampil_kota_nama").val("Kota \"" + kode + "\" tidak ditemukan.");

            $("#status_kota").html("<small style='color:red;font-style:italic'>Kota tidak ditemukan</small>");
          } else {
            $("#tampil_kota_id").val(html[0].id);

            $("#tampil_kota_kode").val(html[0].kode);
            $("#tampil_kota_nama").val(html[0].nama);

            $("#status_kota").html("<small style='color:green;font-style:italic'>Kota ditemukan</small>");
          }
        }
      });
    });


    // =========

    // ========= KeyUP OUTLET
    $("body").on("keyup", "#tampil_outlet_kode", function() {
      var kode = $(this).val();
      var data = "kode=" + kode;
      $.ajax({
        type: "POST",
        url: "outlet_cari_ajax.php",
        data: data,
        dataType: 'JSON',
        success: function(html) {
          if (html[0].id == "") {
            $("#tampil_outlet_id").val("");

            $("#tampil_outlet_nama").val("Outlet \"" + kode + "\" tidak ditemukan.");

            $("#status_outlet").html("<small style='color:red;font-style:italic'>Outlet tidak ditemukan</small>");
          } else {
            $("#tampil_outlet_id").val(html[0].id);

            $("#tampil_outlet_kode").val(html[0].kode);
            $("#tampil_outlet_nama").val(html[0].nama);

            $("#status_outlet").html("<small style='color:green;font-style:italic'>Outlet ditemukan</small>");
          }
        }
      });
    });


    // =========


    // disable auto complete
    $("input[type='text']").attr("autocomplete", "off");

    // disable form submit dengan enter
    $("form").keypress(function(e) {
      //Enter key
      if (e.which == 13) {
        return false;
      }
    });


  });
</script>

</body>

</html>