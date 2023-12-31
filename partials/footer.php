</div>

<!-- /.content-wrapper -->
<footer class="main-footer">
    <strong>Copyright &copy; <a href="https://adminlte.io">DP3K</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>

<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<script defer>
    $(function() {
      $("#tabel1").DataTable({
        "responsive": true,
        "autoWidth": false,
      });

      $(".custom-table").DataTable({
        "responsive": true,
        "autoWidth": false,
        "paging": true,
      });

      $('#tabel-print').DataTable({
        "lengthChange": false,
        "responsive": true,
        "autoWidth": false,
        "paging": true,
        "info": true,
        dom: 'Bfrtip',
        buttons: [{
            extend: 'print',
            text: 'Cetak / Print',
            title: 'Laporan Dana Masuk',
          },
          {
            extend: 'excel',
            text: 'Export Excel',
            messageTop: 'The information in this table is copyright to Sirius Cybernetics Corp.'
          },
        ]
      });

      $('#tabel-print-2').DataTable({
        "lengthChange": false,
        "responsive": true,
        "autoWidth": false,
        "paging": true,
        "info": true,
        dom: 'Bfrtip',
        buttons: [{
            extend: 'print',
            text: 'Cetak / Print',
            title: 'Laporan Dana Keluar',
          },
          {
            extend: 'excel',
            text: 'Export Excel',
            messageTop: 'The information in this table is copyright to Sirius Cybernetics Corp.'
          },
        ]
      });

      $('#tabel2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
</script>

</body>
</html>
