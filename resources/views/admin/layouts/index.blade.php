@extends('admin.layouts.index')

@section('title', 'Manage Products')

@section('content')
<div class="container-fluid py-4">
    
    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">Manage Products</h2>
            <p class="text-muted mb-0">Kelola semua produk di sini</p>
        </div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
            <i class="fas fa-plus me-2"></i>Add Product
        </button>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Products Table --}}
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="80">Image</th>
                            <th>Name</th>
                            <th>SKU</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th width="100">Stock</th>
                            <th width="100">Status</th>
                            <th width="150" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                        <tr>
                            <td>
                                @if($product->image)
                                    <img src="{{ asset($product->image) }}" 
                                         class="rounded"
                                         style="width: 60px; height: 60px; object-fit: cover;">
                                @else
                                    <div class="bg-secondary bg-opacity-10 rounded d-flex align-items-center justify-content-center" 
                                         style="width: 60px; height: 60px;">
                                        <i class="fas fa-image text-muted"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <strong>{{ $product->name }}</strong>
                                @if($product->is_featured)
                                    <br><span class="badge bg-warning text-dark"><i class="fas fa-star"></i> Featured</span>
                                @endif
                            </td>
                            <td><code>{{ $product->sku }}</code></td>
                            <td>
                                @if($product->category)
                                    <span class="badge bg-info">{{ $product->category->name }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if($product->discount_price)
                                    <span class="text-muted text-decoration-line-through small d-block">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </span>
                                    <strong class="text-danger">
                                        Rp {{ number_format($product->discount_price, 0, ',', '.') }}
                                    </strong>
                                @else
                                    <strong>Rp {{ number_format($product->price, 0, ',', '.') }}</strong>
                                @endif
                            </td>
                            <td>
                                @if($product->stock == 0)
                                    <span class="badge bg-danger">{{ $product->stock }}</span>
                                @elseif($product->stock <= 10)
                                    <span class="badge bg-warning text-dark">{{ $product->stock }}</span>
                                @else
                                    <span class="badge bg-success">{{ $product->stock }}</span>
                                @endif
                            </td>
                            <td>
                                @if($product->status == 'active')
                                    <span class="badge bg-success">Active</span>
                                @elseif($product->status == 'inactive')
                                    <span class="badge bg-secondary">Inactive</span>
                                @else
                                    <span class="badge bg-danger">Out of Stock</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-warning me-1" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editProductModal{{ $product->id }}"
                                        title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-danger" 
                                        onclick="confirmDelete({{ $product->id }})"
                                        title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                                
                                <form id="delete-form-{{ $product->id }}" 
                                      action="{{ route('admin.products.destroy', $product->id) }}" 
                                      method="POST" 
                                      class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>

                        {{-- Edit Modal --}}
                        <div class="modal fade" id="editProductModal{{ $product->id }}" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header bg-warning">
                                            <h5 class="modal-title"><i class="fas fa-edit"></i> Edit Product</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Product Name <span class="text-danger">*</span></label>
                                                    <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">SKU</label>
                                                    <input type="text" name="sku" class="form-control" value="{{ $product->sku }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Category</label>
                                                    <select name="category_id" class="form-select">
                                                        <option value="">Select Category</option>
                                                        @foreach($categories as $category)
                                                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                                                {{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Status <span class="text-danger">*</span></label>
                                                    <select name="status" class="form-select" required>
                                                        <option value="active" {{ $product->status == 'active' ? 'selected' : '' }}>Active</option>
                                                        <option value="inactive" {{ $product->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                                        <option value="out_of_stock" {{ $product->status == 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label">Price <span class="text-danger">*</span></label>
                                                    <input type="number" name="price" class="form-control" value="{{ $product->price }}" required>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label">Discount Price</label>
                                                    <input type="number" name="discount_price" class="form-control" value="{{ $product->discount_price }}">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label">Stock <span class="text-danger">*</span></label>
                                                    <input type="number" name="stock" class="form-control" value="{{ $product->stock }}" required>
                                                </div>
                                                <div class="col-12 mb-3">
                                                    <label class="form-label">Description</label>
                                                    <textarea name="description" class="form-control" rows="3">{{ $product->description }}</textarea>
                                                </div>
                                                <div class="col-12 mb-3">
                                                    <label class="form-label">Product Image</label>
                                                    @if($product->image)
                                                        <div class="mb-2">
                                                            <img src="{{ asset($product->image) }}" style="width: 100px; height: 100px; object-fit: cover;" class="rounded">
                                                        </div>
                                                    @endif
                                                    <input type="file" name="image" class="form-control" accept="image/*">
                                                    <small class="text-muted">Leave empty to keep current image</small>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-check">
                                                        <input type="checkbox" name="is_featured" value="1" class="form-check-input" {{ $product->is_featured ? 'checked' : '' }}>
                                                        <label class="form-check-label">Featured Product</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-warning">
                                                <i class="fas fa-save"></i> Update Product
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                                <p class="text-muted">No products found</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white">
            {{ $products->links() }}
        </div>
    </div>

</div>

{{-- Add Product Modal --}}
<div class="modal fade" id="addProductModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="fas fa-plus-circle"></i> Add New Product</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Product Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">SKU</label>
                            <input type="text" name="sku" class="form-control" placeholder="Auto-generated">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Category</label>
                            <select name="category_id" class="form-select">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-select" required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="out_of_stock">Out of Stock</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Price <span class="text-danger">*</span></label>
                            <input type="number" name="price" class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Discount Price</label>
                            <input type="number" name="discount_price" class="form-control">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Stock <span class="text-danger">*</span></label>
                            <input type="number" name="stock" class="form-control" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Product Image</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input type="checkbox" name="is_featured" value="1" class="form-check-input">
                                <label class="form-check-label">Featured Product</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function confirmDelete(id) {
        if (confirm('Are you sure you want to delete this product?')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }
</script>
@endpush