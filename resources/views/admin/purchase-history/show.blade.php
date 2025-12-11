<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pembelian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Detail Pembelian #{{ $purchase->order_number }}</h2>
                    <a href="{{ route('admin.purchase-history.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="row">
                    <!-- Order Information -->
                    <div class="col-md-8">
                        <div class="card mb-4">
                            <div class="card-header bg-white">
                                <h5 class="mb-0">Informasi Pesanan</h5>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <strong>Nomor Pesanan:</strong><br>
                                        {{ $purchase->order_number }}
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Tanggal:</strong><br>
                                        {{ $purchase->created_at->format('d M Y, H:i') }}
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <strong>Status Pesanan:</strong><br>
                                        @if($purchase->status == 'completed')
                                            <span class="badge bg-success">Selesai</span>
                                        @elseif($purchase->status == 'pending')
                                            <span class="badge bg-warning">Tertunda</span>
                                        @elseif($purchase->status == 'processing')
                                            <span class="badge bg-info">Diproses</span>
                                        @else
                                            <span class="badge bg-danger">Dibatalkan</span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Metode Pembayaran:</strong><br>
                                        {{ ucfirst($purchase->payment_method) }}
                                    </div>
                                </div>

                                <!-- Update Status Form -->
                                <form action="{{ route('admin.purchase-history.update-status', $purchase->id) }}" method="POST" class="mt-3">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-8">
                                            <select name="status" class="form-select">
                                                <option value="pending" {{ $purchase->status == 'pending' ? 'selected' : '' }}>Tertunda</option>
                                                <option value="processing" {{ $purchase->status == 'processing' ? 'selected' : '' }}>Diproses</option>
                                                <option value="completed" {{ $purchase->status == 'completed' ? 'selected' : '' }}>Selesai</option>
                                                <option value="cancelled" {{ $purchase->status == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-primary w-100">Update Status</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Order Items -->
                        <div class="card">
                            <div class="card-header bg-white">
                                <h5 class="mb-0">Item Pesanan</h5>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Produk</th>
                                            <th>Harga</th>
                                            <th>Jumlah</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($purchase->orderDetails as $detail)
                                        <tr>
                                            <td>{{ $detail->product_name }}</td>
                                            <td>Rp {{ number_format($detail->price, 0, ',', '.') }}</td>
                                            <td>{{ $detail->quantity }}</td>
                                            <td>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3" class="text-end">Total:</th>
                                            <th>Rp {{ number_format($purchase->total_amount, 0, ',', '.') }}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Customer Information -->
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <div class="card-header bg-white">
                                <h5 class="mb-0">Informasi Pelanggan</h5>
                            </div>
                            <div class="card-body">
                                <p><strong>Nama:</strong><br>{{ $purchase->customer_name ?? 'Guest' }}</p>
                                <p><strong>Email:</strong><br>{{ $purchase->customer_email ?? '-' }}</p>
                                <p><strong>Telepon:</strong><br>{{ $purchase->customer_phone ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header bg-white">
                                <h5 class="mb-0">Alamat Pengiriman</h5>
                            </div>
                            <div class="card-body">
                                <p>{{ $purchase->shipping_address ?? 'Tidak ada alamat' }}</p>
                            </div>
                        </div>

                        @if($purchase->notes)
                        <div class="card mt-4">
                            <div class="card-header bg-white">
                                <h5 class="mb-0">Catatan</h5>
                            </div>
                            <div class="card-body">
                                <p>{{ $purchase->notes }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>