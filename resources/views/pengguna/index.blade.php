@extends('layouts.app')
@section('title', 'Pengguna')

@section('content')
<div class="max-w-6xl mx-auto mt-10 px-4">
    <!-- Judul halaman + tombol tambah pengguna -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Daftar Pengguna</h1>
        <a href="{{ route('pengguna.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition duration-200">
            <i class="fas fa-plus mr-1"></i> Tambah Pengguna
        </a>
    </div>

    <!-- Notifikasi sukses -->
    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded mb-4 flex items-center">
        <i class="fas fa-check-circle mr-2"></i>
        {{ session('success') }}
    </div>
    @endif

    <!-- Notifikasi error -->
    @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-800 px-4 py-3 rounded mb-4 flex items-center">
        <i class="fas fa-exclamation-circle mr-2"></i>
        {{ session('error') }}
    </div>
    @endif

    <!-- Tabel pengguna -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-4">
            <table id="penggunaTable" class="min-w-full text-sm">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-3 text-left">Nama</th>
                        <th class="px-4 py-3 text-left">Username</th>
                        <th class="px-4 py-3 text-left">Email</th>
                        <th class="px-4 py-3 text-left">Role</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($penggunas as $pengguna)
                    <tr class="border-b hover:bg-gray-50 transition duration-150">
                        <td class="px-4 py-3">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center text-white mr-2">
                                    {{ strtoupper(substr($pengguna->name, 0, 1)) }}
                                </div>
                                {{ $pengguna->name }}
                            </div>
                        </td>
                        <td class="px-4 py-3">{{ $pengguna->username ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $pengguna->email }}</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 rounded text-xs font-semibold
                                @if($pengguna->role == 'admin') bg-purple-100 text-purple-800
                                @elseif($pengguna->role == 'user') bg-blue-100 text-blue-800
                                @else bg-gray-100 text-gray-800
                                @endif">
                                {{ ucfirst($pengguna->role ?? 'user') }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            @if($pengguna->is_active ?? true)
                                <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs font-semibold">
                                    <i class="fas fa-check-circle"></i> Aktif
                                </span>
                            @else
                                <span class="px-2 py-1 bg-red-100 text-red-800 rounded text-xs font-semibold">
                                    <i class="fas fa-times-circle"></i> Nonaktif
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-center">
                            <div class="flex justify-center space-x-2">
                                <!-- Link detail -->
                                <a href="{{ route('pengguna.show', $pengguna->id) }}"
                                   class="text-blue-600 hover:text-blue-800 transition"
                                   title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <!-- Link edit -->
                                <a href="{{ route('pengguna.edit', $pengguna->id) }}"
                                   class="text-yellow-600 hover:text-yellow-800 transition"
                                   title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <!-- Form hapus -->
                                <form action="{{ route('pengguna.destroy', $pengguna->id) }}"
                                      method="POST" 
                                      class="inline"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-600 hover:text-red-800 transition"
                                            title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr class="dt-empty">
                        <td colspan="6" class="px-4 py-8 text-center text-gray-500">
                            <i class="fas fa-users text-4xl mb-2 text-gray-300"></i>
                            <p>Belum ada data pengguna</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.tailwindcss.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    /* Custom DataTables styling */
    #penggunaTable_wrapper .dataTables_filter input {
        @apply border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500;
    }
    
    #penggunaTable_wrapper .dataTables_length select {
        @apply border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500;
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        @apply px-3 py-1 mx-1 rounded;
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        @apply bg-blue-600 text-white;
    }
</style>
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/2.3.4/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.3.4/js/dataTables.tailwindcss.min.js"></script>

<script>
    $.fn.dataTable.ext.errMode = 'none';
    
    $(function () {
        $('#penggunaTable').DataTable({
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data per halaman",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                infoEmpty: "Tidak ada data",
                infoFiltered: "(difilter dari _MAX_ total data)",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "Selanjutnya",
                    previous: "Sebelumnya"
                },
                zeroRecords: "Tidak ada data yang cocok"
            },
            pageLength: 10,
            order: [[0, 'asc']],
            initComplete: function () {
                // Hapus class dark dari elemen-elemen input/dropdown
                $('select, input[type="search"], .pagination a').each(function () {
                    this.className = this.className
                        .split(' ')
                        .filter(cls => !cls.startsWith('dark:'))
                        .join(' ');
                });
            }
        });
    });
</script>
@endpush