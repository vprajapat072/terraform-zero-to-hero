<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Manage Categories</h3>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#categoryModal">
        <i class="bi bi-plus-circle"></i> Add Category
    </button>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Blog Categories</h5>
    </div>
    <div class="card-body p-0">
        <?php if (!empty($categories)): ?>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Sort Order</th>
                            <th>Posts Count</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categories as $category): ?>
                            <tr>
                                <td>
                                    <strong><?= esc($category['name']) ?></strong>
                                </td>
                                <td>
                                    <code><?= esc($category['slug']) ?></code>
                                </td>
                                <td>
                                    <?= esc($category['description']) ?>
                                </td>
                                <td>
                                    <span class="badge <?= $category['is_active'] ? 'bg-success' : 'bg-secondary' ?>">
                                        <?= $category['is_active'] ? 'Active' : 'Inactive' ?>
                                    </span>
                                </td>
                                <td>
                                    <?= $category['sort_order'] ?>
                                </td>
                                <td>
                                    <span class="badge bg-info">
                                        <?= $category['posts_count'] ?? 0 ?> posts
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <button type="button" class="btn btn-outline-primary" 
                                                onclick="editCategory(<?= htmlspecialchars(json_encode($category)) ?>)" 
                                                title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <a href="/blog?category=<?= $category['slug'] ?>" target="_blank" 
                                           class="btn btn-outline-success" title="View Posts">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="text-center py-5">
                <i class="bi bi-tags" style="font-size: 3rem; color: #6c757d;"></i>
                <h5 class="mt-3">No categories found</h5>
                <p class="text-muted">Create your first blog category to organize posts.</p>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#categoryModal">
                    <i class="bi bi-plus-circle"></i> Add Category
                </button>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Category Modal -->
<div class="modal fade" id="categoryModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="categoryModalTitle">Add Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="categoryForm" method="POST" action="/admin/blog/categories/save">
                <div class="modal-body">
                    <input type="hidden" id="category_id" name="id">
                    
                    <div class="mb-3">
                        <label for="category_name" class="form-label">Name *</label>
                        <input type="text" class="form-control" id="category_name" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="category_slug" class="form-label">Slug</label>
                        <input type="text" class="form-control" id="category_slug" name="slug" 
                               placeholder="Auto-generated from name">
                        <div class="form-text">Leave blank to auto-generate from name</div>
                    </div>

                    <div class="mb-3">
                        <label for="category_description" class="form-label">Description</label>
                        <textarea class="form-control" id="category_description" name="description" rows="3" 
                                  placeholder="Brief description of this category..."></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="sort_order" class="form-label">Sort Order</label>
                                <input type="number" class="form-control" id="sort_order" name="sort_order" 
                                       value="0" min="0">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" 
                                           value="1" checked>
                                    <label class="form-check-label" for="is_active">
                                        Active
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="categorySaveBtn">Save Category</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
// Auto-generate slug from name
document.getElementById('category_name').addEventListener('input', function() {
    const name = this.value;
    const slugField = document.getElementById('category_slug');
    
    if (!slugField.value || slugField.dataset.autoGenerated === 'true') {
        const slug = name.toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-')
            .trim('-');
        slugField.value = slug;
        slugField.dataset.autoGenerated = 'true';
    }
});

document.getElementById('category_slug').addEventListener('input', function() {
    this.dataset.autoGenerated = 'false';
});

function editCategory(category) {
    document.getElementById('categoryModalTitle').textContent = 'Edit Category';
    document.getElementById('categorySaveBtn').textContent = 'Update Category';
    document.getElementById('categoryForm').action = '/admin/blog/categories/update';
    
    document.getElementById('category_id').value = category.id;
    document.getElementById('category_name').value = category.name;
    document.getElementById('category_slug').value = category.slug;
    document.getElementById('category_description').value = category.description || '';
    document.getElementById('sort_order').value = category.sort_order || 0;
    document.getElementById('is_active').checked = category.is_active == 1;
    
    new bootstrap.Modal(document.getElementById('categoryModal')).show();
}

// Reset form when modal is closed
document.getElementById('categoryModal').addEventListener('hidden.bs.modal', function() {
    document.getElementById('categoryModalTitle').textContent = 'Add Category';
    document.getElementById('categorySaveBtn').textContent = 'Save Category';
    document.getElementById('categoryForm').action = '/admin/blog/categories/save';
    document.getElementById('categoryForm').reset();
    document.getElementById('category_id').value = '';
    document.getElementById('is_active').checked = true;
});
</script>
<?= $this->endSection() ?>
