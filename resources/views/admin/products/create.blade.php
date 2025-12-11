@extends('layouts.admin')

@section('title', 'Home')

@section('content')

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h2>Add New Product</h2>
                
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="card">
                        <div class="card-body">
                            <!-- Product Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Product Name *</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                            </div>

                            <!-- Description -->
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="4">{{ old('description') }}</textarea>
                            </div>

                            <div class="row">
                                <!-- Price -->
                                <div class="col-md-6 mb-3">
                                    <label for="price" class="form-label">Price *</label>
                                    <input type="number" class="form-control" id="price" name="price" value="{{ old('price') }}" step="0.01" required>
                                </div>

                                <!-- Discount Price -->
                                <div class="col-md-6 mb-3">
                                    <label for="discount_price" class="form-label">Discount Price</label>
                                    <input type="number" class="form-control" id="discount_price" name="discount_price" value="{{ old('discount_price') }}" step="0.01">
                                </div>
                            </div>

                            <div class="row">
                                <!-- Stock -->
                                <div class="col-md-6 mb-3">
                                    <label for="stock" class="form-label">Stock *</label>
                                    <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock', 0) }}" required>
                                </div>

                                <!-- SKU -->
                                <div class="col-md-6 mb-3">
                                    <label for="sku" class="form-label">SKU (Auto-generated if empty)</label>
                                    <input type="text" class="form-control" id="sku" name="sku" value="{{ old('sku') }}">
                                </div>
                            </div>

                            <div class="row">
                                <!-- Category -->
                                <div class="col-md-6 mb-3">
                                    <label for="category_id" class="form-label">Category</label>
                                    <select class="form-control" id="category_id" name="category_id">
                                        <option value="">-- Select Category --</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Status -->
                                <div class="col-md-6 mb-3">
                                    <label for="status" class="form-label">Status *</label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                        <option value="out_of_stock" {{ old('status') == 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Product Image -->
                            <div class="mb-3">
                                <label for="image" class="form-label">Product Image</label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                <small class="text-muted">Max size: 2MB (jpeg, png, jpg, gif)</small>
                            </div>

                            <!-- Is Featured -->
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="is_featured" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_featured">
                                    Featured Product
                                </label>
                            </div>

                            <!-- Meta Title -->
                            <div class="mb-3">
                                <label for="meta_title" class="form-label">Meta Title (SEO)</label>
                                <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ old('meta_title') }}">
                            </div>

                            <!-- Meta Description -->
                            <div class="mb-3">
                                <label for="meta_description" class="form-label">Meta Description (SEO)</label>
                                <textarea class="form-control" id="meta_description" name="meta_description" rows="2">{{ old('meta_description') }}</textarea>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Save Product</button>
                            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@push('css')

@endpush
@push('js')

@endpush