<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>
    {{-- {{ config('app.name') }} --}}

      | @yield('title')

  </title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('AdminLte/plugins/fontawesome-free/css/all.min.css') }}">

  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('AdminLte/dist/css/adminlte.min.css') }}">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('AdminLte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('AdminLte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('AdminLte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

  {{-- Toastr --}}
  <link rel="stylesheet" href="{{ asset('AdminLte/plugins/toastr/toastr.min.css') }}">
  <link rel="stylesheet" href="{{ asset('AdminLte/plugins/toastr/toastr.css') }}">

  {{-- Select2 --}}
  <link rel="stylesheet" href="{{ asset('AdminLte/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('AdminLte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  @include('Layout.navbar')

  @include('Layout.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @include('Layout.header')

    @yield('content')
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('AdminLte/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('AdminLte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE -->
<script src="{{ asset('AdminLte/dist/js/adminlte.js') }}"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="{{ asset('AdminLte/plugins/chart.js/Chart.min.js') }}"></script>

<script src="{{ asset('AdminLte/dist/js/pages/dashboard3.js') }}"></script>


<!-- DataTables  & Plugins -->
<script src="{{ asset('AdminLte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('AdminLte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('AdminLte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('AdminLte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('AdminLte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('AdminLte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('AdminLte/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('AdminLte/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('AdminLte/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('AdminLte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('AdminLte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('AdminLte/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>


<script>
  $(function () {
    $("#tabel-data").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      buttons: [
        'pageLength', "colvis",
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                },
                customize: function ( win ) {
                    $(win.document.body)
                        .css( 'font-size', '10pt' )

                    $(win.document.body).find( 'table' )
                        .addClass( 'compact' )
                        .css( 'font-size', 'inherit' );
                },
                messageTop: 'This print was produced using the Print button for DataTables'
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: "copy",
                exportOptions: {
                    columns: ':visible'
                }
            },

        ],
        lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10 rows', '25 rows', '50 rows', 'Show all' ]
        ],
        columnDefs: [{
               'targets': -1, // column index (start from 0)
               'orderable': false, // set orderable false for selected columns
         }],
    }).buttons().container().appendTo('#tabel-produk_wrapper .col-md-6:eq(0)');

  });
</script>

<script src="{{ asset('AdminLte/plugins/toastr/toastr.min.js') }}"></script>

<script>
  $(function() {
    $('.toastrDefaultSuccess').click(function() {
      toastr.success('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
    $('.toastrDefaultInfo').click(function() {
      toastr.info('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
    $('.toastrDefaultError').click(function() {
      toastr.error('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
    $('.toastrDefaultWarning').click(function() {
      toastr.warning('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
  });
</script>


@if (Session::has('failed'))
<script>

  toastr.error("{{ Session::get('failed') }}","gagal brow!")
</script>
@endif


@if (Session::has('message'))
<script>
  toastr.success("{{ Session::get('message') }}","Success!")
</script>
@endif

@if (Session::has('error'))
<script>
    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
            toastr.error("{{ $error }}");
        @endforeach
    @endif

</script>
@endif

{{-- select2 --}}
<script src="{{ asset('AdminLte/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  });
</script>


<script>

  $(document).ready(function() {
    // Inisialisasi select2 di dalam <select>
    $('.select2bs4').select2({
        theme: 'bootstrap4',
    });

    // Event click ketika tombol "Pilih produk" di dalam modal ditekan
    $(".select-product").click(function() {
        var id = $(this).data("id");

        // Pilih opsi dengan nilai yang sesuai dengan id
        $('.produk-pilihan').val(id).trigger('change');

        // Tutup modal setelah memilih produk
        $('#modal-produk-data').modal('hide');
    });

    $(".select-supplier").click(function() {
        var id = $(this).data("id");

        // Pilih opsi dengan nilai yang sesuai dengan id
        $('.supplier-pilihan').val(id).trigger('change');

        // Tutup modal setelah memilih produk
        $('#modal-supplier-data').modal('hide');
    });
  });
  </script>

@stack('script')

</body>
</html>
