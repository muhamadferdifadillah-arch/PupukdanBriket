@extends('layouts.produsen')

@section('title', 'Rekapan Pesanan')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2>Rekapan Pesanan Per Bulan</h2>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h6 class="text-muted">Total Produk</h6>
                    <h2 class="text-primary">{{ $totalProducts }}</h2>
                    <small class="text-muted">Produk Aktif</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h6 class="text-muted">Pesanan Bulan Ini</h6>
                    <h2 class="text-warning">{{ $ordersThisMonth }}</h2>
                    <small class="text-muted">Total Order</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h6 class="text-muted">Pendapatan Bulan Ini</h6>
                    <h2 class="text-success">Rp {{ number_format($revenueThisMonth, 0, ',', '.') }}</h2>
                    <small class="text-muted">{{ date('F Y') }}</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h6 class="text-muted">Total Pendapatan</h6>
                    <h2 class="text-info">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h2>
                    <small class="text-muted">Semua Waktu</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Sales Chart -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Grafik Penjualan Per Bulan ({{ date('Y') }})</h5>
                    <div id="salesChart"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Monthly Report Table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Rincian Pesanan Per Bulan</h5>
                    
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Bulan</th>
                                    <th>Jumlah Pesanan</th>
                                    <th>Produk Terjual</th>
                                    <th>Total Pendapatan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($monthlyData as $month => $data)
                                <tr>
                                    <td><strong>{{ $data['month_name'] }}</strong></td>
                                    <td>{{ $data['orders'] }} pesanan</td>
                                    <td>{{ $data['items'] }} item</td>
                                    <td class="text-success fw-bold">Rp {{ number_format($data['revenue'], 0, ',', '.') }}</td>
                                    <td>
                                        @if($data['orders'] > 0)
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-secondary">Tidak Ada</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="table-light">
                                <tr>
                                    <td><strong>TOTAL</strong></td>
                                    <td><strong>{{ $totalOrders }} pesanan</strong></td>
                                    <td><strong>{{ $totalItems }} item</strong></td>
                                    <td class="text-success"><strong>Rp {{ number_format($totalRevenue, 0, ',', '.') }}</strong></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<style>
    .card {
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        margin-bottom: 20px;
        border: none;
    }
    .card-body h6 {
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .table th {
        font-weight: 600;
        font-size: 14px;
    }
</style>
@endpush

@push('js')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    var options = {
        chart: {
            type: 'area',
            height: 350,
            toolbar: {
                show: true
            }
        },
        series: [{
            name: 'Pendapatan (Rp)',
            data: {!! json_encode(array_values($chartData)) !!}
        }],
        xaxis: {
            categories: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des']
        },
        colors: ['#00a651'],
        fill: {
            type: 'gradient',
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.7,
                opacityTo: 0.3,
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth',
            width: 3
        },
        yaxis: {
            labels: {
                formatter: function (val) {
                    return "Rp " + val.toLocaleString('id-ID');
                }
            }
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return "Rp " + val.toLocaleString('id-ID');
                }
            }
        }
    };

    var chart = new ApexCharts(
        document.querySelector("#salesChart"),
        options
    );

    chart.render();
</script>
@endpush