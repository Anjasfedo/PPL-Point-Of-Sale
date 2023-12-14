@extends('Layout.main')
@section('title')
    Dashboard
@endsection
@section('header')
    <h1 class="m-0">Dashboard</h1>
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box shadow">
                        <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Kategori</span>
                            <span class="info-box-number">{{ $totalKategori }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box shadow">
                        <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Barang</span>
                            <span class="info-box-number">{{ $totalBarang }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box shadow">
                        <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Supplier</span>
                            <span class="info-box-number">{{ $totalSupplier }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box shadow">
                        <span class="info-box-icon bg-danger"><i class="far fa-star"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">User</span>
                            <span class="info-box-number">{{ $totalUser }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="box shadow p-2">
                            <div class="box-header with-border">
                                <h3 class="box-title">Grafik Pendapatan
                                    {{ tanggal_indonesia($tanggal_awal, false) }}
                                    s/d
                                    {{ tanggal_indonesia($tanggal_akhir, false) }}
                                </h3>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="chart">
                                            <canvas id="salesChart" style="height: 180px;"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="{{ asset('AdminLTE/chart.js/Chart.js') }}"></script>
    <script>
        $(function() {
            var salesChartCanvas = $('#salesChart').get(0).getContext('2d');
            var salesChart = new Chart(salesChartCanvas);
            var salesChartData = {
                labels: {{ json_encode($data_tanggal) }},
                datasets: [{
                    label: 'Pendapatan',
                    fillColor: 'rgba(60,141,188,0.9)',
                    strokeColor: 'rgba(60,141,188,0.8)',
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data: {{ json_encode($data_pendapatan) }}
                }]
            };
            var salesChartOptions = {
                pointDot: true,
                responsive: true
            };
            salesChart.Line(salesChartData, salesChartOptions);
        });
    </script>
@endpush
