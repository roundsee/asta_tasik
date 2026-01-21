<?php
$dir = "../../../../";
?>
<!-- Main Footer -->
<footer class="main-footer bg_primary_1" style="padding:.3rem;font-size:.75rem">
  <!-- To the right -->
  <div class="float-right d-none d-sm-inline">
    <b>Version</b> <?php echo $ver; ?>
  </div>
  <!-- Default to the left -->
  <strong>Copyright &copy; 2020-<?php echo $thn_sekarang . " " . $perusahaan; ?>.</strong> by Develop. All rights Reserved.
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
<script src="<?php echo $dir; ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?php echo $dir; ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo $dir; ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo $dir; ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo $dir; ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo $dir; ?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo $dir; ?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo $dir; ?>plugins/jszip/jszip.min.js"></script>
<script src="<?php echo $dir; ?>plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo $dir; ?>plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo $dir; ?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo $dir; ?>plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo $dir; ?>plugins/datatables-buttons/js/buttons.colVis.min.js"></script>


<!-- AdminLTE App -->
<script src="../../../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../../../dist/js/demo.js"></script>
<!-- Page specific script -->


<script>
  $(document).ready(function() {
    $('#example').DataTable({
      "lengthChange": true,
      dom: 'Bfrtip',
      buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
      ]
    });
  });

  $('#example2323').DataTable({
    dom: 'Bfrtip',
    buttons: [{
        extend: 'excelHtml5',
        text: 'Export to Excel',
        customize: function(xlsx) {
          var sheet = xlsx.xl.worksheets['sheet1.xml'];
          $('row c', sheet).each(function() {
            var cellValue = $(this).text();
            // Set all values to string
            $(this).attr('t', 'inlineStr'); // Set the cell type to inline string
            $(this).find('v').replaceWith('<is><t>' + cellValue + '</t></is>'); // Properly wrap the value
          });
        }
      },
      'copy', 'csv', 'pdf', 'print'
    ]
  });



  $(function() {
    $("#example1").DataTable({
      lengthMenu: [
        [10, 50, 100, -1],
        [10, 50, 100, 'All'],
      ],
      "responsive": true,
      "lengthChange": true,
      "autoWidth": true,
      "searching": true,
      "buttons": ["copy", "csv", "excel", "pdf", "print"],
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });

    $("#example3").DataTable({
      lengthMenu: [
        [100, 500, 1000, -1],
        [100, 500, 1000, 'All'],
      ],
      "responsive": true,
      "lengthChange": true,
      "autoWidth": true,
      "searching": true,
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

  });
</script>
</body>

</html>


<!--   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</body>
</html> -->