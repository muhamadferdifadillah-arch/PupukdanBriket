@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4">Riwayat Pembelian (Admin)</h1>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No. Order</th>
                        <th>Pelanggan</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->order_number }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $order->created_at->format('d/m/Y') }}</td>
                        <td>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                        <td>
                            <span class="badge badge-{{ $order->status_color }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.purchase-detail', $order->id) }}" 
                               class="btn btn-sm btn-info">
                                Detail
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $orders->links() }}
        </div>
    </div>
</div>
@endsection