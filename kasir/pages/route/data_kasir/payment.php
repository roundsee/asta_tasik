<?php
$dir = "../../";
include $dir . "../../config/koneksi.php";
include $dir . "../../config/fungsi_rupiah.php";
?>

<div class="wrapper box-poly-up" style="padding:15px;min-height:630px;" id="form_pembayaran">
  <div class="row">
    <div class="col-lg-4 box-poly">
      <div class="form-group row">
        <legend class="col-sm-6 col-form-label" style="margin-bottom:1px">Total
        </legend>

        <input type="hidden" name="total" class="total_form col-sm-6" value="0" style="width:100px;">
        <legend class="total_pembelian col-sm-6 pull-right" id="payment_total_pembelian" style="text-align: right; margin-bottom:1px">0</legend>

        <!-- </div> -->
      </div>
      <h3 class="card-title">Payment</h3>
      <!-- </div> -->

      <div class="card-body">

        <div class="form-group row" id="form_voucher">
          <label class="col-sm-4 col-form-label" style="padding: 1px;"><button type="button" class="tombol1" onclick="open_voucher()" style="padding: 1 5 1 5"> Voucher</button></label>

          <div class="col-sm-8">
            <input type="text" class="payment_voucher_total form-control" id="payment_nilai_voucher" name="byr_pocer" value="0" style="text-align:right" readonly>
          </div>

        </div>

        <div class="form-group row">

          <label class="col-sm-4 col-form-label" style="text-align:right">
            <!-- <button type="button" class="tombol1"  onclick="open_sub_alatbayar()"  style="padding: 1 5 1 5">Non Tunai</button> -->
            Nama :
          </label>
          <div class="col-sm-8">
            <input type="text" class="form-control" id="payment_alatbayar_nama" disabled>
          </div>

          <label class="col-sm-4 col-form-label" style="text-align:right">No ref :</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" id="tampil_alatbayar_pin" name="no_ref" onchange="paymenttotalkembali(this.value)" style="text-align:right" disabled>
          </div>

          <label class="col-sm-4 col-form-label" style="text-align:right">Sebesar :</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" id="payment_nilai_non_tunai" name="byr_non_tunai" value="0" onkeyup="paymenttotalkembali(this.value)" style="text-align:right" disabled>
          </div>

          <input type="hidden" name="kdsub_alatbayar" value="0" id="payment_sub_alatbayar">
          <input type="hidden" name="kdsub_awal_alatbayar" value="0" id="payment_awal_sub_alatbayar">


        </div>

      </div>
      <div class="form-group row">
        <label class="col-sm-4 col-form-label" style="text-align:right">Tunai :</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="payment_nilai_tunai" name="byr_tunai" value="" onkeyup="paymenttotalkembali(this.value)" style="text-align:right;font-weight: 800;">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-4 col-form-label" style="text-align:right">Ongkir :</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="ongkos_kirim" name="ongkos_kirim" value="" onkeyup="paymenttotalkembali(this.value)" style="text-align:right;font-weight: 800;">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-4 col-form-label" style="text-align:right">Voucher :</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="voucher_nilai_diskon" name="voucher_nilai_diskon" value="" onkeyup="paymenttotalkembali(this.value)" style="text-align:right;font-weight: 800;">
        </div>
      </div>

      <div class="form-group row">
        <label class="col-sm-4 col-form-label" id="lbl_status_payment" style="padding:1px;text-align:right;font-weight:700;font-size: 110%;">Belum bayar :</label>
        <div class="col-sm-8">
          <legend id="paymentKembali" style="text-align:right;">0</legend>
        </div>
      </div>
    </div>

    <div class="col-lg-8">

      <input type="hidden" name="subjumlah_offline" value="0">
      <input type="hidden" name="faktur_refund" value="belum">
      <input type="hidden" name="dasar_faktur" value="belum">
    </div>
  </div>

  <div>

    <div style="height:50px">
      <div class="row btn-payment">
        <div class="col-sm-5">
          <!--<button type="button" class="btn btn-primary" onclick="document.getElementById('payment_nilai_tunai').value = '50.000'; paymenttotalkembali();">Rp. 50.000</button>
          <button type="button" class="btn btn-primary" onclick="document.getElementById('payment_nilai_tunai').value = '100.000'; paymenttotalkembali();">Rp. 100.000</button>
          -->
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-1">
        <button type="button" class="btn-sm btn-danger tombol1" id="tombol_clear" onclick="clear_form_bayar()" style="font-size:110%;font-weight:600;"> Clear</button>
      </div>
      <div class="col-sm-1">
        <button type="button" class="btn-default btn tombol1 tombol-simpan" id="tombol-simpan2"><i class="fa fa-save"></i> Process</button>
      </div>

      <div class="col-sm-3">
        <button type="button" class="btn-sm tombol1" id="tombol_payment_close" onclick="close_pembayaran()" style="font-size:110%;font-weight:600"> Payment close</button>
      </div>
    </div>

    <label id="pesan_no_ref" style="padding:10px;color:red"></label>

    <!-- <label id="pesan_no_ref">Pesan no _ref</label> -->
  </div>
</div>


<script type="text/javascript">
  var rupiah = document.getElementById('payment_nilai_tunai');
  var rupiah2 = document.getElementById('payment_nilai_non_tunai');
  var rupiah3 = document.getElementById('ongkos_kirim');
  var rupiah4 = document.getElementById('voucher_nilai_diskon');



  $("#payment_nilai_non_tunai").keyup(function(event) {
    if (event.keyCode === 13) {
      console.log("berhasil enter")
      close_pembayaran()
    }
  });

  $("#payment_nilai_tunai").keyup(function(event) {
    if (event.keyCode === 13) {
      console.log("berhasil enter")
      close_pembayaran()
    }
  });

  $("#tombol-simpan2").click(function() {
    if ($('#isSubmitting').val() === 'true') {
      console.log('Already submitting, ignoring click');
      return false;
    }
    $('#isSubmitting').val('true');
    $(".tombol-simpan, #tombol-simpan2").prop('disabled', true);
    const kd_alatbayar = document.getElementById('payment_sub_alatbayar').value.slice(0, 3);

    function validateStockWithServer() {
      const inputIds = document.getElementsByName('transaksi_produk[]');
      const inputQty = document.getElementsByName('transaksi_jumlah[]');
      const inputSatuan = document.getElementsByName('transaksi_satuan_qty[]');
      const inputNama = document.getElementsByName('transaksi_nama[]');
      const inputSwalayan = document.getElementsByName('kategorilockswalayan[]');
      const inputGudang = document.getElementsByName('kategorilockgudang[]');

      let itemMap = {};

      for (let i = 0; i < inputIds.length; i++) {
        const id = inputIds[i].value;
        const nama = inputNama[i].value;
        const jumlah = parseFloat(inputQty[i].value) * parseFloat(inputSatuan[i].value);
        const lockSwalayan = inputSwalayan[i].value;
        const lockGudang = inputGudang[i].value;

        if (!itemMap[id]) {
          itemMap[id] = {
            id: id,
            nama: nama,
            jumlah: 0,
            lock_swalayan: lockSwalayan,
            lock_gudang: lockGudang
          };
        }

        itemMap[id].jumlah += jumlah;
      }

      const items = Object.values(itemMap);
      const hargaKategori = document.getElementById('kd_kategori_harga_online').value;

      let isValid = false;

      $.ajax({
        url: './route/data_kasir/ajax_pengecekan_stok.php',
        type: 'POST',
        contentType: 'application/json',
        dataType: 'json',
        async: false, // make it synchronous
        data: JSON.stringify({
          harga_kategori: hargaKategori,
          items: items
        }),
        success: function(result) {
          if (!result.success) {
            alert(result.message || "Stock validation failed on server.");
            $('#isSubmitting').val('false');
            isValid = false;
          } else {
            isValid = true;
          }
        },
        error: function(xhr, status, error) {
          console.error(error);
          alert("Error connecting to stock validation server.");
          $('#isSubmitting').val('false');
          isValid = false;
        }
      });

      return isValid;
    }

    // let input1 = document.getElementsByName('stockunit[]');
    // let input2 = document.getElementsByName('transaksi_satuan_qty[]');
    // let input3 = document.getElementsByName('transaksi_jumlah[]');
    // let input4 = document.getElementsByName('transaksi_nama[]');
    // let input5 = document.getElementsByName('kategorilockswalayan[]');
    // let input6 = document.getElementsByName('kategorilockgudang[]');


    // function validateStock(currentStockInputs, buyingStockInputs, buyingStockSatuanInputs, namabarang, lockswalayan, lockgudang) {
    //   for (let i = 0; i < currentStockInputs.length; i++) {
    //     let currentStock = currentStockInputs[i].value;
    //     let buyingStock = buyingStockInputs[i].value;
    //     let satuan = buyingStockSatuanInputs[i].value;
    //     let pembelian = buyingStock * satuan;
    //     let nama = namabarang[i].value;
    //     let kategorilockswalayan = lockswalayan[i].value;
    //     let kategorilockgudang = lockgudang[i].value;

    //     if (document.getElementById('kd_kategori_harga_online').value == 1) {
    //       if (kategorilockswalayan !== null && kategorilockswalayan !== '' && kategorilockswalayan !== '0' && kategorilockswalayan !== 0) {
    //         if (currentStock < 0) {
    //           alert(`Stock error at ${nama}: Stok terkini (${currentStock}) is negative.`);
    //           return false;
    //         }
    //         if (pembelian < 0) {
    //           alert(`Stock error at ${nama}: Stok pembelian yang di input (${pembelian}) is negative.`);
    //           return false;
    //         }
    //         if (pembelian > currentStock) {
    //           alert(`Stock error at ${nama}: Stok pembelian yang di input (${pembelian}) > Stok terkini (${currentStock})`);
    //           return false;
    //         }
    //       }
    //     } else {
    //       if (kategorilockgudang !== null && kategorilockgudang !== '' && kategorilockgudang !== '0' && kategorilockgudang !== 0) {
    //         if (currentStock < 0) {
    //           alert(`Stock error at ${nama}: Stok terkini (${currentStock}) is negative.`);
    //           return false;
    //         }
    //         if (pembelian < 0) {
    //           alert(`Stock error at ${nama}: Stok pembelian yang di input (${pembelian}) is negative.`);
    //           return false;
    //         }
    //         if (pembelian > currentStock) {
    //           alert(`Stock error at ${nama}: Stok pembelian yang di input (${pembelian}) > Stok terkini (${currentStock})`);
    //           return false;
    //         }
    //       }
    //     }

    //     // if (currentStock < 0) {
    //     //   alert(`Stock error at ${nama}: Stok terkini (${currentStock}) is negative.`);
    //     //   return false;
    //     // }
    //     // if (pembelian < 0) {
    //     //   alert(`Stock error at ${nama}: Stok pembelian yang di input (${pembelian}) is negative.`);
    //     //   return false;
    //     // }
    //     // if (pembelian > currentStock) {
    //     //   alert(`Stock error at ${nama}: Stok pembelian yang di input (${pembelian}) > Stok terkini (${currentStock})`);
    //     //   return false;
    //     // }ini diubah
    //   }
    //   return true;
    // }
    if (kd_alatbayar == 214 && document.getElementById("tampil_aplikasi_keterangan").value == 0 || document.getElementById("tampil_aplikasi_keterangan").value == "") {
      alert("Transaksi Paylater Harus Memasukan Member");
      $('#isSubmitting').val('false');
      return false;
    } else {

      // if (!validateStock(input1, input2, input3, input4, input5, input6)) {
      //   alert('Stock validation failed.');
      //   $('#isSubmitting').val('false');
      //   return false;
      // }
      if (!validateStockWithServer()) {
        alert('Stock validation failed.');
        return false;
      }
      close_pembayaran();
      $("#resetTransaction").attr('disabled', 'disabled');
      $("#tombolPayment").attr('disabled', 'disabled');
      // $("#tombol-simpan").attr('disabled', 'disabled');
      // $("#tombol-simpan2").attr('disabled', 'disabled');
      var x10 = document.getElementById("state");
      x10.style.display = "none";
      $("#tombol-simpan").prop('disabled', true);
      $("#tombol-simpan2").prop('disabled', true);

      var data = $('.form-user').serialize();
      $.ajax({
        type: 'POST',
        url: "route/data_kasir/aksi_2.php",
        data: data,
        success: function(response) {
          const jsonMatch = JSON.parse(response);

          window.location.href = "route/data_kasir/cetak_nota.php?id=" + jsonMatch.no_invoice;
          // var x11 = document.getElementById("print");
          // x11.style.display = "block";
          // $('#print').load("route/data_kasir/cetak.php");
          // console.log(data);
        },
        error: function(jqXHR, textStatus, errorThrown) {
          // $('button').prop('disabled', false);
          alert('Message: ' + textStatus + ' , HTTP: ' + errorThrown);
        },
        // complete:function(data){
        // 	var json = data
        // 	console.log('ini data kedua = '+val(data));
        // }
      });
    }
  });
  /*
  function handleKeyPress(event) {
    if (event.keyCode === 13) {
      close_pembayaran()
    }
  }
  document.addEventListener('keypress', handleKeyPress);
  */
  rupiah.addEventListener('keyup', function(e) {
    // tambahkan 'Rp.' pada saat form di ketik
    // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
    /*
    if ($("#payment_sub_alatbayar").val() != 0) {
      var asd = 0;
      var total_pembelian = $(".total_form").val();
      var total_payment = parseInt(total_pembelian);
      var tes = document.getElementById('payment_nilai_tunai');
      var tesv = tes.value.replace(/\./g, "");
      var total_payment123 = parseInt(tesv);
      var nilai_voucher = document.getElementById("payment_nilai_voucher").value;
      var nilai_voucher2 = parseInt(nilai_voucher);
      if (total_payment > (total_payment123 + nilai_voucher2)) {
        asd = total_payment - total_payment123 - nilai_voucher2;
      }
      rupiah2.value = asd;
      rupiah2.value = formatRupiah(rupiah2.value);
      sisa_kembali = 0
      console.log("total payment  = " + total_payment + "   tesv =  " + total_payment123 + "   rujpiah =  " + rupiah2.value + asd)

    }
    rupiah.value = formatRupiah(this.value);
    paymenttotalkembali()
    */
    rupiah.value = formatRupiah(this.value);


  });
  rupiah2.addEventListener('keyup', function(e) {
    // tambahkan 'Rp.' pada saat form di ketik
    // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
    rupiah2.value = formatRupiah(this.value);
  });

  rupiah3.addEventListener('keyup', function(e) {
    rupiah3.value = formatRupiah(this.value);
  });

  rupiah4.addEventListener('keyup', function(e) {
    rupiah4.value = formatRupiah(this.value);
  });

  /* Fungsi formatRupiah */
  function formatRupiah(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
      split = number_string.split(','),
      sisa = split[0].length % 3,
      rupiah = split[0].substr(0, sisa),
      ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if (ribuan) {
      separator = sisa ? '.' : '';
      rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
  }
</script>