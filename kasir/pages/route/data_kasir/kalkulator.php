<style>
  body

  /*  {    
    background-color: green;    
  }*/
  .box {
    background-color: #3d4543;
    height: 230px;
    width: 190px;
    border-radius: 5px;
    position: absolute;
    /*top: 80px;    
    left: 40%;*/
  }

  .display {
    background-color: #222;
    width: 165px;
    position: relative;
    left: 15px;
    top: 10px;
    height: 40px;
  }

  .display input {
    position: relative;
    left: 2px;
    top: 2px;
    height: 35px;
    color: black;
    background-color: #bccd95;
    font-size: 18px;
    text-align: right;
    width: 160px;
  }

  .keys {
    position: relative;
    top: 5px;
  }

  .button {
    width: 40px;
    height: 30px;
    border: none;
    border-radius: 8px;
    margin-left: 17px;
    cursor: pointer;
    border-top: 2px solid transparent;
  }

  .button.gray {
    color: black;
    background-color: #6f6f6f;
    border-bottom: black 2px solid;
    border-top: 2px #6f6f6f solid;
  }

  .title:hover {
    color: #fff;
  }

  .title {
    margin-bottom: 10px;
    margin-top: 30px;
    padding: 5px 0;
    font-size: 40px;
    font-weight: bold;
    text-align: center;
    color: black;
    font-family: 'Cookie', cursive;
  }

  .button.pink {
    color: black;
    background-color: #ff4561;
    border-bottom: black 2px solid;
  }

  .button.black {
    color: black;
    background-color: 303030;
    border-bottom: black 2px solid;
    border-top: 2px 303030 solid;
    font-weight: bold;
  }

  .button.white {
    color: lightgray;
    background-color: 303030;
    border-bottom: black 2px solid;
    border-top: 2px 303030 solid;
    font-weight: bold;
  }

  .button.orange {
    color: black;
    background-color: FF9933;
    border-bottom: black 2px solid;
    border-top: 2px FF9933 solid;
    width: 55px;
    margin-left: 10px;
  }

  .gray:active {
    border-top: black 2px solid;
    border-bottom: 2px #6f6f6f solid;
  }

  .pink:active {
    border-top: black 2px solid;
    border-bottom: #ff4561 2px solid;
  }

  .black:active {
    border-top: black 2px solid;
    border-bottom: #303030 2px solid;
  }

  .orange:active {
    border-top: black 2px solid;
    border-bottom: FF9933 2px solid;
  }

  p {
    line-height: 10px;
  }

  .box-poly-up-calc {
    border-radius: 18px;
    background: linear-gradient(145deg, #ffffff, #e5e6e6);
    box-shadow: 5px 5px 10px #c1c2c2,
      -5px -5px 10px #ffffff;
    height: 220px;
    margin-left: 10px;
    width: 200px;
  }
</style>

<div class="box-poly-up-calc" id="kalkulator" style="display:none">
  <div class="display">
    <input type="text" readonly size="18" id="d">
  </div>
  <div class="keys">
    <p></p>

    <p> <input type="button" class="button white" value="7" onclick='v("7")'>
      <input type="button" class="button white" value="8" onclick='v("8")'>
      <input type="button" class="button white" value="9" onclick='v("9")'>
    </p>
    <p> <input type="button" class="button white" value="4" onclick='v("4")'>
      <input type="button" class="button white" value="5" onclick='v("5")'>
      <input type="button" class="button white" value="6" onclick='v("6")'>
    </p>
    <p> <input type="button" class="button white" value="1" onclick='v("1")'>
      <input type="button" class="button white" value="2" onclick='v("2")'>
      <input type="button" class="button white" value="3" onclick='v("3")'>
    </p>
    <p> <input type="button" class="button white" value="0" onclick='v("0")'>
      <input type="button" class="button white" value="C" onclick='c("")'>
      <!-- <input type="button" class="button orange" value="Enter" onclick='e()'>  -->
      <input type="button" class="button orange" value="UPDATE" id="tombol-update">
    </p>
  </div>
</div>
<script>
  function c(val) {
    document.getElementById("d").value = val;
  }

  function v(val) {
    document.getElementById("d").value += val;
    document.getElementById("tambahkan_jumlah").value = document.getElementById("d").value;

    var jumlah = $("#tambahkan_jumlah").val();
    var harga = $("#tambahkan_harga").val();
    var total = harga * jumlah;
    $("#tambahkan_total").val(total);
    var diskon = $("#tambahkan_diskon").val();
    var total_diskon = diskon * jumlah;
    $("#tambahkan_total_diskon").val(total_diskon);
  }

  function e() {
    try {
      c(eval(document.getElementById("d").value))

      $(".pembelian_jumlah").attr("id", value)
      $(".pembelian_jumlah").attr("id", jumlahkan_jumlah)

    } catch (e) {
      c('Error')
    }
  }
</script>