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
                        <h5 class="fw-bold mb-0">Rp 25.000.000</h5>
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
                        <h5 class="fw-bold mb-0">12 Produk</h5>
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
                        <h5 class="fw-bold mb-0">3 Promo</h5>
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

                    <h5 class="fw-bold mb-3">Pesanan Terbaru</h5>

                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
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
