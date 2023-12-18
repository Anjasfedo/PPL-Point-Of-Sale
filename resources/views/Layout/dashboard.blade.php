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
            @hasrole('kasir')
                <div class="row justify-content-center align-items-center">
                    <div class="col-md-8 text-center">
                        <div class="mb-4">
                            <h1 class="display-4 mb-2">Selamat datang, {{ auth()->user()->name }}!</h1>
                            <p class="lead">Anda siap untuk memulai hari penjualan yang produktif.</p>
                        </div>
                        <div>
                            <a href="{{ route('penjualan.index') }}" class="btn btn-primary btn-lg">
                                <i class="fas fa-shopping-cart"></i> Penjualan Barang
                            </a>
                        </div>
                    </div>
                </div>
            @endhasrole
            @hasrole('admin')
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box shadow">
                            <span class="info-box-icon bg-info"><i class="fas fa-sitemap"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Kategori</span>
                                <span class="info-box-number">{{ $totalKategori }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box shadow">
                            <span class="info-box-icon bg-success"><i class="fas fa-boxes"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Barang</span>
                                <span class="info-box-number">{{ $totalBarang }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box shadow">
                            <span class="info-box-icon bg-warning"><i class="fas fa-people-carry"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Supplier</span>
                                <span class="info-box-number">{{ $totalSupplier }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box shadow">
                            <span class="info-box-icon bg-danger"><i class="fas fa-users"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Pengguna</span>
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
                                                <canvas id="pendapatanChart" style="height: 180px;"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row d-flex justify-content-center">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="box shadow p-2">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Grafik Penjualan
                                        {{ tanggal_indonesia($tanggal_awal, false) }}
                                        s/d
                                        {{ tanggal_indonesia($tanggal_akhir, false) }}
                                    </h3>
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="chart">
                                                <canvas id="penjualanChart" style="height: 180px;"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row d-flex justify-content-center">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="box shadow p-2">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Grafik Pembelian
                                        {{ tanggal_indonesia($tanggal_awal, false) }}
                                        s/d
                                        {{ tanggal_indonesia($tanggal_akhir, false) }}
                                    </h3>
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="chart">
                                                <canvas id="pembelianChart" style="height: 180px;"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endhasrole
        </div>
    </div>
@endsection
@push('script')
    <script src="{{ asset('AdminLTE/chart.js/Chart.js') }}"></script>
    <script>
        $(function() {
            var pendapatanChartCanvas = $('#pendapatanChart').get(0).getContext('2d');
            var pendapatanChart = new Chart(pendapatanChartCanvas);
            var pendapatanChartData = {
                labels: {{ json_encode($data_tanggal) }},
                datasets: [{
                    label: 'Pendapatan',
                    fillColor: 'rgba(0, 0, 255, 0.9)', // Blue
                    strokeColor: 'rgba(0, 0, 255, 0.8)',
                    pointColor: 'rgba(0, 0, 255, 1)',
                    pointStrokeColor: '#fff',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(0, 0, 255, 1)',
                    data: {{ json_encode($data_pendapatan) }}
                }]
            };
            var pendapatanChartOptions = {
                pointDot: true,
                responsive: true
            };
            pendapatanChart.Line(pendapatanChartData, pendapatanChartOptions);
        });
    </script>

    <script>
        $(function() {
            console.log('Data for penjualanChart:', {!! json_encode($data_penjualan) !!});
            var penjualanChartCanvas = $('#penjualanChart').get(0).getContext('2d');
            var penjualanChart = new Chart(penjualanChartCanvas);
            var penjualanChartData = {
                labels: {!! json_encode($data_tanggal) !!},
                datasets: [{
                    label: 'penjualan',
                    fillColor: 'rgba(255, 255, 0, 0.9)', // Yellow
                    strokeColor: 'rgba(255, 255, 0, 0.8)',
                    pointColor: 'rgba(255, 255, 0, 1)',
                    pointStrokeColor: '#fff',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(255, 255, 0, 1)',
                    data: {!! json_encode($data_penjualan) !!}
                }]
            };
            var penjualanChartOptions = {
                pointDot: true,
                responsive: true
            };
            penjualanChart.Line(penjualanChartData, penjualanChartOptions);
        });
    </script>

    <script>
        $(function() {
            console.log('Data for pembelianChart:', {!! json_encode($data_pembelian) !!});
            var pembelianChartCanvas = $('#pembelianChart').get(0).getContext('2d');
            var pembelianChart = new Chart(pembelianChartCanvas);
            var pembelianChartData = {
                labels: {!! json_encode($data_tanggal) !!},
                datasets: [{
                    label: 'pembelian',
                    fillColor: 'rgba(255, 0, 0, 0.9)', // Red
                    strokeColor: 'rgba(255, 0, 0, 0.8)',
                    pointColor: 'rgba(255, 0, 0, 1)',
                    pointStrokeColor: '#fff',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(255, 0, 0, 1)',
                    data: {!! json_encode($data_pembelian) !!}
                }]
            };
            var pembelianChartOptions = {
                pointDot: true,
                responsive: true
            };
            pembelianChart.Line(pembelianChartData, pembelianChartOptions);
        });
    </script>
@endpush
