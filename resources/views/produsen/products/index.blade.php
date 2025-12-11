@extends('layouts.produsen')

@section('content')
<h3 class="mb-3">Produk yang Saya Pasok</h3>

<table class="table table-bordered align-middle">
    <thead class="table-light">
        <tr>
            <th>Foto</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($produk as $item)
            <tr>
                {{-- FOTO --}}
                <td>
                    @if ($item->image)
                        <img src="{{ asset($item->image) }}"
                             alt="{{ $item->name }}"
                             width="70">
                    @else
                        <span>-</span>
                    @endif
                </td>

                {{-- NAMA --}}
                <td>{{ $item->name }}</td>

                {{-- HARGA --}}
                <td>Rp {{ number_format($item->price) }}</td>

                {{-- STOK --}}
                <td>{{ $item->stock }}</td>

                {{-- STATUS --}}
                <td>
                    <span class="badge bg-{{ $item->status === 'active' ? 'success' : 'secondary' }}">
                        {{ ucfirst($item->status) }}
                    </span>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center text-muted">
                    Belum ada produk.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection
