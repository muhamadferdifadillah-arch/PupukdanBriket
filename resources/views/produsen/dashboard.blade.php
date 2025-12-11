@extends('layouts.produsen')

@section('title', 'Dashboard Produsen')

@section('content')
<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-0">Dashboard Produsen</h4>
            <small class="text-muted">Ringkasan aktivitas tokomu</small>
        </div>
    </div>

    {{-- STAT CARDS --}}
    <div class="row mb-4">

        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body d-flex align-items-center">
                    <div class="bg-success text-white rounded-circle p-3">
                        <i class="ti ti-currency-dollar"></i>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">Total Penjualan</h6>
                        <h5 class="fw-bold mb-0">Rp 25.000.000</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body d-flex align-items-center">
                    <div class="bg-primary text-white rounded-circle p-3">
                        <i class="ti ti-package"></i>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">Total Produk</h6>
                        <h5 class="fw-bold mb-0">12 Produk</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body d-flex align-items-center">
                    <div class="bg-warning text-white rounded-circle p-3">
                        <i class="ti ti-discount-2"></i>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">Promo Aktif</h6>
                        <h5 class="fw-bold mb-0">3 Promo</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body d-flex align-items-center">
                    <div class="bg-info text-white rounded-circle p-3">
                        <i class="ti ti-users"></i>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">Total Pembeli</h6>
                        <h5 class="fw-bold mb-0">148 Orang</h5>
                    </div>
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
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Produk</th>
                                    <th>Jumlah</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                    <th class="text-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Kopi Arabica</td>
                                    <td>2</td>
                                    <td>
                                        <span class="badge bg-warning">Diproses</span>
                                    </td>
                                    <td>Rp 120.000</td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-primary">Detail</a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Teh Herbal</td>
                                    <td>1</td>
                                    <td>
                                        <span class="badge bg-success">Selesai</span>
                                    </td>
                                    <td>Rp 45.000</td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-primary">Detail</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection
