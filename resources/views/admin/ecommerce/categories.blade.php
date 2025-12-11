@extends('layouts.admin')

@section('title', 'Manage Categories')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Manage Categories</h1>
            <p class="text-muted">Kelola kategori produk Anda</p>
        </div>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#categoryModal" onclick="resetForm()">
            <i class="fas fa-plus me-2"></i>Add Category
        </button>
    </div>

    <!-- Search Bar -->
    <div class="card mb-4">
        <div class="card-body">
            <input type="text" id="searchInput" class="form-control" placeholder="Cari kategori...">
        </div>
    </div>

    <!-- Categories Table -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="categoriesTable">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Description</th>
                            <th>Products</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td><strong>{{ $category->name }}</strong></td>
                            <td><code>{{ $category->slug }}</code></td>
                            <td>{{ Str::limit($category->description, 50) }}</td>
                            <td>{{ $category->products_count ?? 0 }}</td>
                            <td>
                                @if($category->status == 'active')
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-sm btn-info" onclick="editCategory({{ $category->id }})" data-bs-toggle="modal" data-bs-target="#categoryModal">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-danger" onclick="deleteCategory({{ $category->id }})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                Tidak ada kategori ditemukan
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Form -->
<div class="modal fade" id="categoryModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Add New Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="categoryId">
                
                <div class="mb-3">
                    <label class="form-label">Category Name</label>
                    <input type="text" class="form-control" id="name" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Slug</label>
                    <input type="text" class="form-control" id="slug" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" id="description" rows="3"></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select class="form-select" id="status">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="saveCategory()">Save</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Auto generate slug
document.getElementById('name').addEventListener('input', function(e) {
    const slug = e.target.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '');
    document.getElementById('slug').value = slug;
});

// Search
document.getElementById('searchInput').addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const rows = document.querySelectorAll('#categoriesTable tbody tr');
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(searchTerm) ? '' : 'none';
    });
});

// Reset form
function resetForm() {
    document.getElementById('categoryId').value = '';
    document.getElementById('name').value = '';
    document.getElementById('slug').value = '';
    document.getElementById('description').value = '';
    document.getElementById('status').value = 'active';
    document.getElementById('modalTitle').textContent = 'Add New Category';
}

// Edit category
function editCategory(id) {
    fetch(`/admin/ecommerce/categories/${id}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('categoryId').value = data.id;
            document.getElementById('name').value = data.name;
            document.getElementById('slug').value = data.slug;
            document.getElementById('description').value = data.description;
            document.getElementById('status').value = data.status;
            document.getElementById('modalTitle').textContent = 'Edit Category';
        });
}

// Save category
function saveCategory() {
    const id = document.getElementById('categoryId').value;
    const url = id ? `/admin/ecommerce/categories/${id}` : '/admin/ecommerce/categories';
    const method = id ? 'PUT' : 'POST';
    
    const data = {
        name: document.getElementById('name').value,
        slug: document.getElementById('slug').value,
        description: document.getElementById('description').value,
        status: document.getElementById('status').value
    };
    
    fetch(url, {
        method: method,
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            location.reload();
        } else {
            alert('Error: ' + data.message);
        }
    });
}

// Delete category
function deleteCategory(id) {
    if(confirm('Apakah Anda yakin ingin menghapus kategori ini?')) {
        fetch(`/admin/ecommerce/categories/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                location.reload();
            } else {
                alert('Error: ' + data.message);
            }
        });
    }
}
</script>
@endpush