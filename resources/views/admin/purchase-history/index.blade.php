@extends('layouts.admin')

@section('title', 'Riwayat Pembelian')

@section('content')

<h1 class="h3 mb-4 text-gray-800">Riwayat Pembelian</h1>

<!-- Stats Cards -->
<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2" style="border-left: 4px solid #4e73df;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Pesanan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalOrders ?? 0 }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                    </div>
                </div>
                <small class="text-muted">Semua pesanan</small>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2" style="border-left: 4px solid #1cc88a;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Pendapatan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
                <small class="text-muted">Dari pesanan selesai</small>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2" style="border-left: 4px solid #f6c23e;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pesanan Tertunda</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pendingOrders ?? 0 }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clock fa-2x text-gray-300"></i>
                    </div>
                </div>
                <small class="text-muted">Menunggu proses</small>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2" style="border-left: 4px solid #36b9cc;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pesanan Selesai</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $completedOrders ?? 0 }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                    </div>
                </div>
                <small class="text-muted">Berhasil diselesaikan</small>
            </div>
        </div>
    </div>
</div>

<!-- Transactions Table -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Transaksi Terkini</h6>
    </div>
    <div class="card-body">
        <p class="text-muted">Pesanan dan aktivitas terbaru</p>
        
        @if(isset($orders) && $orders->count() > 0)
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Customer</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>#{{ $order->id }}</td>
                        <td>{{ $order->customer_name ?? 'Guest' }}</td>
                        <td>{{ $order->created_at->format('d M Y') }}</td>
                        <td>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                        <td>
                            @if($order->status == 'pending')
                                <span class="badge bg-warning">Pending</span>
                            @elseif($order->status == 'completed')
                                <span class="badge bg-success">Completed</span>
                            @else
                                <span class="badge bg-danger">Cancelled</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.purchase-history.show', $order->id) }}" class="btn btn-sm btn-primary">Detail</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-center py-5">
            <p class="text-muted">Belum ada riwayat pembelian</p>
        </div>
        @endif
    </div>
</div>

@endsection