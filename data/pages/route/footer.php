
                    </div>
                  </div>
                </section>
              </div>
            </div>
          </div>
        </div>
      </section>

    </div>




    <!-- Main Footer -->
    <footer class="main-footer bg_primary_1"  style="padding:.3rem;font-size:.75rem">
      <!-- To the right -->
      <div class="float-right d-none d-sm-inline">
        <b>Version</b> <?php echo $ver;?>
      </div>
      <!-- Default to the left -->
      <strong>Copyright &copy; <?php echo $thn_sekarang." ".$perusahaan;?>.</strong>  by Develop. All rights Reserved.
    </footer>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</body>
</html>

<script type="text/javascript">
  function isi_otomatis(){
    var <?php echo $f1;?> = $("#<?php echo $f1;?>").val();
    $.ajax({
      url: 'ajax.php',
      data:"<?php echo $f1;?>="+<?php echo $f1;?> ,
    }).success(function (data) {
      var json = data,
      obj = JSON.parse(json);
      $('#<?php echo $f2;?>').val(obj.<?php echo $f2;?>);
    });
  }
</script>

<script>
  $(document).ready(function(){
    $('#country').on('change', function(){
      var countryID = $(this).val();
      if(countryID){
        $.ajax({
          type:'POST',
          url:'ajax2.php',
          data:'kd_jenis='+countryID,
          success:function(html){
            $('#state').html(html);
            $('#city').html('<option value="">Select state first</option>'); 
          }
        }); 
      }else{
        $('#state').html('<option value="">Select country first</option>');
        $('#city').html('<option value="">Select state first</option>'); 
      }
    });

    $('#state').on('change', function(){
      var stateID = $(this).val();
      if(stateID){
        $.ajax({
          type:'POST',
          url:'ajax2.php',
          data:'state_id='+stateID,
          success:function(html){
            $('#city').html(html);
          }
        }); 
      }else{
        $('#city').html('<option value="">Select state first</option>'); 
      }
    });
  });
</script>

<script type="text/javascript">
  $("body").on("keyup", "#tampil_pelanggan_kode", function() {
    var kode = $(this).val();
    var data = "kode=" + kode;
    var x1 = document.getElementById("isian1");
    $.ajax({
      type: "POST",
      url: "ajax_cari.php",
      data: data,
      dataType: 'JSON',
      success: function(html) {
        if(html[0].id == ""){
          $("#tampil_pelanggan_id").val("");

            // $("#tampil_pelanggan_nama").val("Outlet \""+kode+"\" tidak ditemukan.");
            $("#tampil_pelanggan_nama").val("Lanjutkan Pengisian.");
            
            $("#status_pelanggan").html("<small style='color:gree;font-style:italic'>Outlet tidak ditemukan, Bisa di lanjutkan</small>");
            x1.style.display = "block";
          }else{
            $("#tampil_pelanggan_id").val(html[0].id);

            $("#tampil_pelanggan_kode").val(html[0].kode);
            $("#tampil_pelanggan_nama").val(html[0].nama);

            $("#status_pelanggan").html("<a style='color:red;font-style:italic'>Outlet ditemukan, Ganti kode lain</a>");
            x1.style.display = "none";
          }
        }
      });
  });
</script>

<style>
  .file {
    visibility: hidden;
    position: absolute;
  }
</style>

<script>

  function konfirmasi(){
    konfirmasi=confirm("Apakah anda yakin ingin menghapus gambar ini?")
    document.writeln(konfirmasi)
  }

  $(document).on("click", "#pilih_gambar", function() {
    var file = $(this).parents().find(".file");
    file.trigger("click");
  });

  $('input[type="file"]').change(function(e) {
    var fileName = e.target.files[0].name;
    $("#file").val(fileName);

    var reader = new FileReader();
    reader.onload = function(e) {
        // get loaded data and render thumbnail.
        document.getElementById("preview").src = e.target.result;
      };
    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
  });
</script>