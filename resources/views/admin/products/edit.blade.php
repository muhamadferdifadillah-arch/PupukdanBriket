<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h2>Edit Product</h2>
                
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="card">
                        <div class="card-body">
                            <!-- Product Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Product Name *</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name) }}" required>
                            </div>

                            <!-- Description -->
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="4">{{ old('description', $product->description) }}</textarea>
                            </div>

                            <div class="row">
                                <!-- Price -->
                                <div class="col-md-6 mb-3">
                                    <label for="price" class="form-label">Price *</label>
                                    <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}" step="0.01" required>
                                </div>

                                <!-- Discount Price -->
                                <div class="col-md-6 mb-3">
                                    <label for="discount_price" class="form-label">Discount Price</label>
                                    <input type="number" class="form-control" id="discount_price" name="discount_price" value="{{ old('discount_price', $product->discount_price) }}" step="0.01">
                                </div>
                            </div>

                            <div class="row">
                                <!-- Stock -->
                                <div class="col-md-6 mb-3">
                                    <label for="stock" class="form-label">Stock *</label>
                                    <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock', $product->stock) }}" required>
                                </div>

                                <!-- SKU -->
                                <div class="col-md-6 mb-3">
                                    <label for="sku" class="form-label">SKU</label>
                                    <input type="text" class="form-control" id="sku" name="sku" value="{{ old('sku', $product->sku) }}">
                                </div>
                            </div>

                            <div class="row">
                                <!-- Category -->
                                <div class="col-md-6 mb-3">
                                    <label for="category_id" class="form-label">Category</label>
                                    <select class="form-control" id="category_id" name="category_id">
                                        <option value="">-- Select Category --</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Status -->
                                <div class="col-md-6 mb-3">
                                    <label for="status" class="form-label">Status *</label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="active" {{ old('status', $product->status) == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ old('status', $product->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                        <option value="out_of_stock" {{ old('status', $product->status) == 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Current Image -->
                            @if($product->image)
                            <div class="mb-3">
                                <label class="form-label">Current Image</label><br>
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" width="150" height="150" style="object-fit: cover;">
                            </div>
                            @endif

                            <!-- Product Image -->
                            <div class="mb-3">
                                <label for="image" class="form-label">Change Product Image</label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                <small class="text-muted">Max size: 2MB (jpeg, png, jpg, gif). Leave empty to keep current image.</small>
                            </div>

                            <!-- Is Featured -->
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="is_featured" name="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_featured">
                                    Featured Product
                                </label>
                            </div>

                            <!-- Meta Title -->
                            <div class="mb-3">
                                <label for="meta_title" class="form-label">Meta Title (SEO)</label>
                                <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ old('meta_title', $product->meta_title) }}">
                            </div>

                            <!-- Meta Description -->
                            <div class="mb-3">
                                <label for="meta_description" class="form-label">Meta Description (SEO)</label>
                                <textarea class="form-control" id="meta_description" name="meta_description" rows="2">{{ old('meta_description', $product->meta_description) }}</textarea>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Update Product</button>
                            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>