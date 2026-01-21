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
<!-- <script src="<?php echo $dir;?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script> -->
<script src="<?php echo $dir;?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="<?php echo $dir;?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo $dir;?>assets/bower_components/fastclick/lib/fastclick.js"></script>
<script src="<?php echo $dir;?>assets/dist/js/adminlte.min.js"></script>
<!-- <script src="<?php echo $dir;?>assets/dist/js/pages/dashboard.js"></script> -->
<script src="<?php echo $dir;?>assets/dist/js/demo.js"></script>
<script src="<?php echo $dir;?>assets/bower_components/ckeditor/ckeditor.js"></script>
<script src="<?php echo $dir;?>assets/bower_components/chart.js/Chart.min.js"></script>
<!-- <script src="../../plugins/ekko-lightbox/ekko-lightbox.min.js"></script> -->
<!-- <script src="../../plugins/filterizr/jquery.filterizr.min.js"></script> -->

<!-- Page specific script -->

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
