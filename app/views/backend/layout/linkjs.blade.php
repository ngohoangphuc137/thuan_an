<!-- jQuery -->
<!-- jQuery UI 1.11.4 -->
<script src="{{ BASE_URL . 'public/js/jquery/jquery-ui.min.js'}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!-- Bootstrap 4 -->
<script src="{{ BASE_URL . 'public/js/bootstrapJS/bootstrap.bundle.min.js'}}"></script>
<!-- ChartJS -->
<script src="{{ BASE_URL . 'public/js/chartjs/Chart.min.js'}}"></script>
<!-- Sparkline -->
<script src="{{ BASE_URL . 'public/js/sparklines/sparkline.js'}}"></script>
<!-- JQVMap -->
<script src="{{ BASE_URL . 'public/js/jquery/jqueryVmap.js'}}"></script>
<script src="{{ BASE_URL . 'public/js/jquery/jquery.vmap.usa.js'}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ BASE_URL . 'public/js/jquery/jquery.knob.min.js'}}"></script>
<!-- daterangepicker -->
<script src="{{ BASE_URL . 'public/js/daterangepicker/moment.min.js'}}"></script>
<script src="{{ BASE_URL . 'public/js/daterangepicker/daterangepicker.js'}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ BASE_URL . 'public/js/bootstrapJS/tempusdominus-bootstrap-4.min.js'}}"></script>
<!-- Summernote -->
<script src="{{ BASE_URL . 'public/summernote/summernote-bs4.min.js'}}"></script>

<!-- overlayScrollbars -->
<script src="{{ BASE_URL . 'public/js/Scrollbars/jquery.overlayScrollbars.min.js'}}"></script>

<!-- AdminLTE App -->
<script src="{{ BASE_URL . 'public/js/adminlte/adminlte.js'}}"></script>


<script src="{{ BASE_URL . 'public/js/adminlte/dashboard.js'}}"></script>

<!-- dataTable -->

<!-- DataTables  & Plugins -->
<script src="{{ BASE_URL . 'public/js/datatables/jquery.dataTables.min.js'}}"></script>
<script src="{{ BASE_URL . 'public/js/datatables-bs4/js/dataTables.bootstrap4.min.js'}}"></script>
<script src="{{ BASE_URL . 'public/js/datatables-responsive/js/dataTables.responsive.min.js'}}"></script>
<script src="{{ BASE_URL . 'public/js/datatables-responsive/js/responsive.bootstrap4.min.js'}}"></script>
<script src="{{ BASE_URL . 'public/js/datatables-buttons/js/dataTables.buttons.min.js'}}"></script>
<script src="{{ BASE_URL . 'public/js/datatables-buttons/js/dataTables.buttons.min.js'}}"></script>
<script src="{{ BASE_URL . 'public/js/datatables-buttons/js/buttons.Bootstrap4.min.js'}}"></script>

<script src="{{ BASE_URL . 'public/js/jszip/jszip.min.js'}}"></script>
<script src="{{ BASE_URL . 'public/js/pdfmake/pdfmake.min.js'}}"></script>
<script src="{{ BASE_URL . 'public/js/pdfmake/vfs_fonts.js'}}"></script>
<script src="{{ BASE_URL .'public/js/datatables-buttons/js/buttons.html5.min.js'}}"></script>
<script src="{{ BASE_URL .'public/js/datatables-buttons/js/buttons.print.min.js'}}"></script>
<script src="{{ BASE_URL .'public/js/datatables-buttons/js/buttons.colVis.min.js'}}"></script>


<!-- Jquery validation -->

<script src="{{ BASE_URL .'public/js/sweetalert2/sweetalert2.min.js'}}"></script>

<script src="{{ BASE_URL .'public/js/detail/fotorama.js'}}"></script>
<script src="{{BASE_URL.'public/js/jquery/jquery.magnific-popup.js'}}"></script>
<script src="{{BASE_URL.'public/js/detail/owl.carousel.min.js'}}"></script>
<script src="{{BASE_URL.'public/js/detail/custom.js'}}"></script>
<script src="{{BASE_URL.'public/js/bs-custom-file-input/bs-custom-file-input.min.js'}}"></script>
<script>
$.widget.bridge('uibutton', $.ui.button)
</script>
<script>
$(function() {
    bsCustomFileInput.init();

    $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        // "buttons": ["excel", "pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
 
    $("#example4").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        // "buttons": ["excel", "pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $("#example5").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        // "buttons": ["excel", "pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
});
</script>