@extends('layouts.produsen')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Tambah Promo Baru</h5>
            <a href="{{ route('produsen.promo.index') }}" class="btn btn-secondary btn-sm">
                <i class="ti ti-arrow-left"></i> Kembali
            </a>
        </div>
        <div class="card-body">
            <form action="{{ route('produsen.promo.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-3">
                    <label for="nama_promo" class="form-label">Nama Promo <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('nama_promo') is-invalid @enderror" 
                           id="nama_promo" name="nama_promo" value="{{ old('nama_promo') }}" required>
                    @error('nama_promo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                              id="deskripsi" name="deskripsi" rows="4">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="diskon_persen" class="form-label">Diskon (%) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('diskon_persen') is-invalid @enderror" 
                                   id="diskon_persen" name="diskon_persen" min="0" max="100" 
                                   value="{{ old('diskon_persen') }}" required>
                            @error('diskon_persen')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="max_diskon" class="form-label">Maksimal Diskon (Rp)</label>
                            <input type="number" class="form-control @error('max_diskon') is-invalid @enderror" 
                                   id="max_diskon" name="max_diskon" min="0" 
                                   value="{{ old('max_diskon') }}">
                            @error('max_diskon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="tanggal_mulai" class="form-label">Tanggal Mulai <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('tanggal_mulai') is-invalid @enderror" 
                                   id="tanggal_mulai" name="tanggal_mulai" 
                                   value="{{ old('tanggal_mulai') }}" required>
                            @error('tanggal_mulai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="tanggal_selesai" class="form-label">Tanggal Selesai <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('tanggal_selesai') is-invalid @enderror" 
                                   id="tanggal_selesai" name="tanggal_selesai" 
                                   value="{{ old('tanggal_selesai') }}" required>
                            @error('tanggal_selesai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select @error('status') is-invalid @enderror" 
                            id="status" name="status">
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('produsen.promo.index') }}" class="btn btn-secondary">
                        <i class="ti ti-x"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-check"></i> Simpan Promo
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection