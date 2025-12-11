@extends('layouts.admin')

@section('title', 'Manage Products')

@section('content')
<div class="container-fluid" style="padding-top: 30px;">
    
    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1"><i class="fas fa-box me-2"></i>Manage Products</h2>
            <p class="text-muted mb-0">Kelola semua produk Anda di sini</p>
        </div>
        <button class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#addProductModal">
            <i class="fas fa-plus me-2"></i>Add Product
        </button>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Products Table --}}
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead style="background: #f8f9fa;">
                        <tr>
                            <th style="padding: 15px;">Image</th>
                            <th>Name</th>
                            <th>SKU</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th class="text-center" style="width: 200px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                        <tr>
                            <td style="padding: 15px;">
                                @if($product->image)
                                    <img src="{{ asset($product->image) }}" 
                                         class="rounded shadow-sm"
                                         style="width: 60px; height: 60px; object-fit: cover;">
                                @else
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                         style="width: 60px; height: 60px;">
                                        <i class="fas fa-image text-muted"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <strong class="d-block">{{ $product->name }}</strong>
                                @if($product->is_featured)
                                    <span class="badge bg-warning text-dark">
                                        <i class="fas fa-star"></i> Featured
                                    </span>
                                @endif
                            </td>
                            <td><code class="text-primary">{{ $product->sku }}</code></td>
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
                                    <span class="badge bg-success">
                                        <i class="fas fa-check-circle"></i> Active
                                    </span>
                                @elseif($product->status == 'inactive')
                                    <span class="badge bg-secondary">
                                        <i class="fas fa-pause-circle"></i> Inactive
                                    </span>
                                @else
                                    <span class="badge bg-danger">
                                        <i class="fas fa-times-circle"></i> Out of Stock
                                    </span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <button class="btn btn-sm btn-warning" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editModal{{ $product->id }}"
                                            title="Edit Product">
                                        <i class="fas fa-edit me-1"></i>Edit
                                    </button>
                                    <button class="btn btn-sm btn-danger" 
                                            onclick="confirmDelete({{ $product->id }})"
                                            title="Delete Product">
                                        <i class="fas fa-trash me-1"></i>Delete
                                    </button>
                                </div>
                                
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
                        <div class="modal fade" id="editModal{{ $product->id }}" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <form action="{{ route('admin.products.update', $product->id) }}" 
                                          method="POST" 
                                          enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header bg-warning">
                                            <h5 class="modal-title">
                                                <i class="fas fa-edit"></i> Edit Product
                                            </h5>
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
                                                        @foreach($categories as $cat)
                                                            <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                                                                {{ $cat->name }}
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
                                                            <img src="{{ asset($product->image) }}" 
                                                                 style="width: 100px; height: 100px; object-fit: cover;" 
                                                                 class="rounded">
                                                        </div>
                                                    @endif
                                                    <input type="file" name="image" class="form-control" accept="image/*">
                                                    <small class="text-muted">Leave empty to keep current image</small>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-check">
                                                        <input type="checkbox" name="is_featured" value="1" 
                                                               class="form-check-input" {{ $product->is_featured ? 'checked' : '' }}>
                                                        <label class="form-check-label">
                                                            <i class="fas fa-star text-warning"></i> Featured Product
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                <i class="fas fa-times"></i> Cancel
                                            </button>
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
                                <i class="fas fa-box-open fa-3x text-muted mb-3 d-block"></i>
                                <p class="text-muted mb-0">No products found</p>
                                <small class="text-muted">Click "Add Product" button to create your first product</small>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white py-3">
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
                    <h5 class="modal-title">
                        <i class="fas fa-plus-circle"></i> Add New Product
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Product Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" placeholder="Enter product name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">SKU</label>
                            <input type="text" name="sku" class="form-control" placeholder="Auto-generated if empty">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Category</label>
                            <select name="category_id" class="form-select">
                                <option value="">Select Category</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
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
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="price" class="form-control" placeholder="0" required>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Discount Price</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="discount_price" class="form-control" placeholder="0">
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Stock <span class="text-danger">*</span></label>
                            <input type="number" name="stock" class="form-control" placeholder="0" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="3" placeholder="Enter product description..."></textarea>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Product Image</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                            <small class="text-muted">Max 2MB (JPG, PNG, GIF)</small>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input type="checkbox" name="is_featured" value="1" class="form-check-input">
                                <label class="form-check-label">
                                    <i class="fas fa-star text-warning"></i> Mark as Featured Product
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function confirmDelete(id) {
        if (confirm('Are you sure you want to delete this product? This action cannot be undone.')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }
</script>

@endsection