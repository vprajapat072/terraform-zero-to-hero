<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Manage Blog Posts</h3>
    <a href="/admin/blog/create" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Create New Post
    </a>
</div>

<!-- Filters -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" class="row g-3">
            <div class="col-md-4">
                <label for="search" class="form-label">Search</label>
                <input type="text" class="form-control" id="search" name="search" 
                       value="<?= esc($search ?? '') ?>" placeholder="Search title or content...">
            </div>
            <div class="col-md-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status">
                    <option value="">All Statuses</option>
                    <option value="published" <?= ($status_filter === 'published') ? 'selected' : '' ?>>Published</option>
                    <option value="draft" <?= ($status_filter === 'draft') ? 'selected' : '' ?>>Draft</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-select" id="category" name="category">
                    <option value="">All Categories</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['id'] ?>" 
                                <?= ($category_filter == $category['id']) ? 'selected' : '' ?>>
                            <?= esc($category['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">&nbsp;</label>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Posts Table -->
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Blog Posts (<?= $total_posts ?> total)</h5>
    </div>
    <div class="card-body p-0">
        <?php if (!empty($posts)): ?>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Author</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($posts as $post): ?>
                            <tr>
                                <td>
                                    <strong><?= esc($post['title']) ?></strong>
                                    <?php if (!empty($post['excerpt'])): ?>
                                        <br><small class="text-muted"><?= esc(substr($post['excerpt'], 0, 80)) ?>...</small>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if (!empty($post['category_name'])): ?>
                                        <span class="badge bg-info"><?= esc($post['category_name']) ?></span>
                                    <?php else: ?>
                                        <span class="text-muted">Uncategorized</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="badge <?= $post['status'] === 'published' ? 'bg-success' : 'bg-warning' ?>">
                                        <?= ucfirst($post['status']) ?>
                                    </span>
                                </td>
                                <td><?= esc($post['author']) ?></td>
                                <td>
                                    <small><?= date('M j, Y', strtotime($post['created_at'])) ?></small>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <?php if ($post['status'] === 'published'): ?>
                                            <a href="/blog/<?= $post['slug'] ?>" target="_blank" 
                                               class="btn btn-outline-success" title="View Post">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        <?php endif; ?>
                                        <a href="/admin/blog/edit/<?= $post['id'] ?>" 
                                           class="btn btn-outline-primary" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <button type="button" class="btn btn-outline-danger" 
                                                onclick="confirmDelete(<?= $post['id'] ?>, '<?= esc($post['title']) ?>')" 
                                                title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <?php if ($total_pages > 1): ?>
                <div class="card-footer">
                    <nav aria-label="Blog posts pagination">
                        <ul class="pagination mb-0 justify-content-center">
                            <?php
                            $queryParams = [];
                            if ($search) $queryParams['search'] = $search;
                            if ($status_filter) $queryParams['status'] = $status_filter;
                            if ($category_filter) $queryParams['category'] = $category_filter;
                            $queryString = !empty($queryParams) ? '&' . http_build_query($queryParams) : '';
                            ?>
                            
                            <?php if ($current_page > 1): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?= $current_page - 1 ?><?= $queryString ?>">Previous</a>
                                </li>
                            <?php endif; ?>

                            <?php for ($i = max(1, $current_page - 2); $i <= min($total_pages, $current_page + 2); $i++): ?>
                                <li class="page-item <?= $i === $current_page ? 'active' : '' ?>">
                                    <a class="page-link" href="?page=<?= $i ?><?= $queryString ?>"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>

                            <?php if ($current_page < $total_pages): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?= $current_page + 1 ?><?= $queryString ?>">Next</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <div class="text-center py-5">
                <i class="bi bi-journal-x" style="font-size: 3rem; color: #6c757d;"></i>
                <h5 class="mt-3">No blog posts found</h5>
                <p class="text-muted">Start by creating your first blog post.</p>
                <a href="/admin/blog/create" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Create New Post
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete the post "<strong id="deleteTitle"></strong>"?</p>
                <p class="text-danger"><small>This action cannot be undone.</small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    <button type="submit" class="btn btn-danger">Delete Post</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
function confirmDelete(postId, title) {
    document.getElementById('deleteTitle').textContent = title;
    document.getElementById('deleteForm').action = '/admin/blog/delete/' + postId;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>
<?= $this->endSection() ?>
