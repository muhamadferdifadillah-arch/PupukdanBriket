@extends('layouts.produsen')

@section('title', 'Dashboard Produsen')

@section('content')
<div class="container-fluid">

    {{-- HEADER --}}
    <div class="mb-4">
        <h4 class="fw-bold mb-1">Dashboard Produsen</h4>
        <small class="text-muted">Ringkasan aktivitas tokomu</small>
    </div>

    {{-- STAT CARDS --}}
    <div class="row">

        {{-- Total Penjualan --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <span class="rounded-circle bg-success text-white d-inline-flex align-items-center justify-content-center"
                          style="width:48px;height:48px;">
                        <i class="ti ti-currency-dollar fs-5"></i>
                    </span>
                    <div class="ms-3">
                        <h6 class="mb-1 text-muted">Total Penjualan</h6>
                        <h5 class="fw-bold mb-0">Rp {{ number_format($stats['total_sales'], 0, ',', '.') }}</h5>
                        <span class="badge bg-{{ $stats['sales_growth'] >= 0 ? 'success' : 'danger' }}-subtle text-{{ $stats['sales_growth'] >= 0 ? 'success' : 'danger' }} mt-1">
                            {{ $stats['sales_growth'] >= 0 ? '+' : '' }}{{ $stats['sales_growth'] }}%
                        </span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Produk --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <span class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center"
                          style="width:48px;height:48px;">
                        <i class="ti ti-package fs-5"></i>
                    </span>
                    <div class="ms-3">
                        <h6 class="mb-1 text-muted">Total Produk</h6>
                        <h5 class="fw-bold mb-0">{{ $stats['total_products'] }} Produk</h5>
                        <span class="badge bg-{{ $stats['products_growth'] >= 0 ? 'success' : 'danger' }}-subtle text-{{ $stats['products_growth'] >= 0 ? 'success' : 'danger' }} mt-1">
                            {{ $stats['products_growth'] >= 0 ? '+' : '' }}{{ $stats['products_growth'] }}%
                        </span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Promo Aktif --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <span class="rounded-circle bg-warning text-white d-inline-flex align-items-center justify-content-center"
                          style="width:48px;height:48px;">
                        <i class="ti ti-discount-2 fs-5"></i>
                    </span>
                    <div class="ms-3">
                        <h6 class="mb-1 text-muted">Promo Aktif</h6>
                        <h5 class="fw-bold mb-0">{{ $stats['active_promos'] }} Promo</h5>
                        <span class="badge bg-{{ $stats['promos_growth'] >= 0 ? 'success' : 'danger' }}-subtle text-{{ $stats['promos_growth'] >= 0 ? 'success' : 'danger' }} mt-1">
                            {{ $stats['promos_growth'] >= 0 ? '+' : '' }}{{ $stats['promos_growth'] }}%
                        </span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Pembeli --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <span class="rounded-circle bg-info text-white d-inline-flex align-items-center justify-content-center"
                          style="width:48px;height:48px;">
                        <i class="ti ti-users fs-5"></i>
                    </span>
                    <div class="ms-3">
                        <h6 class="mb-1 text-muted">Total Pembeli</h6>
                        <h5 class="fw-bold mb-0">{{ $stats['total_buyers'] }} Orang</h5>
                        <span class="badge bg-{{ $stats['buyers_growth'] >= 0 ? 'success' : 'danger' }}-subtle text-{{ $stats['buyers_growth'] >= 0 ? 'success' : 'danger' }} mt-1">
                            {{ $stats['buyers_growth'] >= 0 ? '+' : '' }}{{ $stats['buyers_growth'] }}%
                        </span>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- CHART & TOP PRODUCTS --}}
    <div class="row mb-4">
        {{-- Sales Chart --}}
        <div class="col-lg-8 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Grafik Penjualan (12 Bulan Terakhir)</h5>
                    <div id="salesChart" style="height: 300px;"></div>
                </div>
            </div>
        </div>

        {{-- Top Products --}}
        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Produk Terlaris</h5>
                    
                    @forelse($topProducts as $index => $product)
                    <div class="d-flex align-items-center mb-3 pb-3 {{ !$loop->last ? 'border-bottom' : '' }}">
                        <div class="badge bg-primary rounded-circle d-flex align-items-center justify-content-center" 
                             style="width: 32px; height: 32px;">
                            {{ $index + 1 }}
                        </div>
                        <div class="ms-3 flex-grow-1">
                            <h6 class="mb-0">{{ $product['name'] }}</h6>
                            <small class="text-muted">{{ $product['total_sold'] }} terjual</small>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-4">
                        <i class="ti ti-package-off fs-3 text-muted"></i>
                        <p class="text-muted mb-0">Belum ada penjualan</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    {{-- TABEL PESANAN --}}
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold mb-0">Pesanan Terbaru</h5>
                        @if($stats['pending_orders'] > 0)
                        <span class="badge bg-warning text-dark">
                            {{ $stats['pending_orders'] }} Pending
                        </span>
                        @endif
                    </div>

                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Order #</th>
                                    <th>Produk</th>
                                    <th>Pelanggan</th>
                                    <th>Jumlah</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentOrders as $order)
                                <tr>
                                    <td><small class="text-muted">#{{ $order['order_number'] }}</small></td>
                                    <td>{{ $order['product_name'] }}</td>
                                    <td>{{ $order['customer_name'] }}</td>
                                    <td>{{ $order['quantity'] }}</td>
                                    <td>
                                        @if($order['status'] == 'completed')
                                            <span class="badge bg-success">Selesai</span>
                                        @elseif($order['status'] == 'pending')
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @elseif($order['status'] == 'processing')
                                            <span class="badge bg-info">Diproses</span>
                                        @elseif($order['status'] == 'cancelled')
                                            <span class="badge bg-danger">Dibatalkan</span>
                                        @else
                                            <span class="badge bg-secondary">{{ ucfirst($order['status']) }}</span>
                                        @endif
                                    </td>
                                    <td>Rp {{ number_format($order['total'], 0, ',', '.') }}</td>
                                    <td>
                                        <small class="text-muted">{{ $order['created_at']->format('d M Y') }}</small>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        <i class="ti ti-shopping-cart-off fs-3 text-muted"></i>
                                        <p class="text-muted mb-0">Belum ada pesanan</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Sales Chart Data
    const salesChart = @json($salesChart);
    
    const options = {
        series: [{
            name: 'Penjualan',
            data: salesChart.data
        }],
        chart: {
            type: 'area',
            height: 300,
            toolbar: {
                show: false
            }
        },
        colors: ['#5D87FF'],
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth',
            width: 2
        },
        fill: {
            type: 'gradient',
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.4,
                opacityTo: 0.1,
            }
        },
        xaxis: {
            categories: salesChart.months
        },
        yaxis: {
            labels: {
                formatter: function(value) {
                    return 'Rp ' + (value / 1000000).toFixed(1) + 'M';
                }
            }
        },
        tooltip: {
            y: {
                formatter: function(value) {
                    return 'Rp ' + value.toLocaleString('id-ID');
                }
            }
        },
        grid: {
            borderColor: '#e7e7e7',
            strokeDashArray: 3
        }
    };

    const chart = new ApexCharts(document.querySelector("#salesChart"), options);
    chart.render();
});
</script>
@endpush