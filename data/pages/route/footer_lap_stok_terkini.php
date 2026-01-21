<?php 
$dir="../../../../";
?>
    <!-- Main Footer -->
    <footer class="main-footer bg_primary_1"  style="padding:.3rem;font-size:.75rem">
      <!-- To the right -->
      <div class="float-right d-none d-sm-inline">
        <b>Version</b> <?php echo $ver;?>
    </div>
      <!-- Default to the left -->
      <strong>Copyright &copy; 2020-<?php echo $thn_sekarang." ".$perusahaan;?>.</strong>  by SAGE. All rights Reserved.
    </footer>
  </div>


<!-- jQuery -->
<script src="../../../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<!-- <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script> -->
<!-- DataTables  & Plugins -->
<!-- <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plugins/jszip/jszip.min.js"></script>
<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script> -->

<!-- Bootstrap 4 -->
<script src="<?php echo $dir;?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?php echo $dir;?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo $dir;?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo $dir;?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo $dir;?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo $dir;?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo $dir;?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo $dir;?>plugins/jszip/jszip.min.js"></script>
<script src="<?php echo $dir;?>plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo $dir;?>plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo $dir;?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo $dir;?>plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo $dir;?>plugins/datatables-buttons/js/buttons.colVis.min.js"></script>


<!-- AdminLTE App -->
<script src="../../../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../../../dist/js/demo.js"></script>
<!-- Page specific script -->


<script> 
      $(document).ready(function() {
        $('#example').DataTable( {
          "lengthChange":true,
          dom: 'Bfrtip',
          buttons: [
          'copy', 'csv', 'excel', 'pdf', 'print'
          ]
        } );
      } );

  $(function () {

    $('#example4').DataTable({
      lengthMenu: [
            [50, 500, 1000, -1],
            [50, 500, 1000, 'All'],
        ],
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": false,
      "scrollX": true,"buttons": ["copy", "csv", "excel", "pdf", "print"],
    }).buttons().container().appendTo('#example4_wrapper .col-md-6:eq(0)');

  });
</script>

</body>
</html>

  
<!--   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</body>
</html> -->
