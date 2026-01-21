<?php
$dir = "../../";
include $dir . "../../config/koneksi.php";
include $dir . "../../config/fungsi_rupiah.php";
?>
<div class="wrapper box-poly-up" style="padding:10 25;height:390px" id="showVoucher">
  <div class="row">
    <div class="row" style="height:160px">

      <a class="btn box-poly-kotak2" style="padding: 5 10 15 15;"><input type="text" class="form-control" id="input_voucher" name="input_voucher" style="width:390px;border-style:none;height: 20px;" placeholder="Cari voucher & tekan ENTER...">
      </a>

      <div class="row" id="tempat_voucher" style="padding:10 25;">

      </div>
      <div class="row" id="pesan_voucher" style="text-align: center; font-size: x-large; font-weight: 600;color:red">

      </div>
    </div>

    <div class="row table-container">

      <div class="table-responsive" style="height: 150px;background-color: whitesmoke;">
        <table class="table table-bordered table-striped table-hover" id="table-voucher">
          <thead style="background-color:lightgray;color:dodgerblue;font-size: 90%;">
            <tr>
              <th style="width:100px">No Seri</th>
              <th style="text-align: center;width:50px;">Nilai</th>
              <!-- <th style="text-align: center;width:60px;">Jumlah</th> -->
            </tr>
          </thead>


          <tbody style="font-size: 90%!important;">
          </tbody>
          <tfoot>
            <tr class="bg-info">
              <td><b>Total</b></td>
              <td style="text-align: right;"><span class="voucher_nilai" id="0">0</span></td>
              <!-- <td style="text-align: center;"><span class="voucher_jumlah" id="0">0</span></td> -->
            </tr>
          </tfoot>
        </table>
      </div>
    </div>

  </div>
  <button type="button" class="btn-sm tombol1 pull-right" onclick="close_voucher()" style="font-size:110%;font-weight:600"> Voucher close</button>
</div>


<script>
  $("#input_voucher").on('keyup', function(event) {
    if (event.keyCode === 13) {
      console.log("Enter key pressed!!!!!");
      var input_voucher = $("#input_voucher").val();
      console.log(input_voucher);
      load_voucher_search(input_voucher);
    }
  });

  function load_voucher_search(search) {
    console.log('masuk ke Load data voucher')
    $.ajax({
      url: "route/data_kasir/voucher_search.php",
      method: "POST",
      data: {
        search: search
      },
      success: function(data) {
        $('#pesan_voucher').html("");
        $('#tempat_voucher').html(data);
      }
    });
  }

  function clear_form_voucher_search() {
    var input_voucher = document.getElementById('input_voucher');
    input_voucher.value = '';

    $('#tempat_voucher').html('');

  }
</script>