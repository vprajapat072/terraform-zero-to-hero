<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3><?= isset($post['id']) ? 'Edit Post' : 'Create New Post' ?></h3>
    <a href="/admin/blog/posts" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Back to Posts
    </a>
</div>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <h6>Please fix the following errors:</h6>
        <ul class="mb-0">
            <?php foreach ($errors as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Post Content</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title *</label>
                        <input type="text" class="form-control" id="title" name="title" 
                               value="<?= esc($post['title'] ?? '') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug" 
                               value="<?= esc($post['slug'] ?? '') ?>" 
                               placeholder="Auto-generated from title">
                        <div class="form-text">Leave blank to auto-generate from title</div>
                    </div>

                    <div class="mb-3">
                        <label for="excerpt" class="form-label">Excerpt *</label>
                        <textarea class="form-control" id="excerpt" name="excerpt" rows="3" required 
                                  placeholder="Brief description for blog listing..."><?= esc($post['excerpt'] ?? '') ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Content *</label>
                        <textarea class="form-control" id="content" name="content" rows="15" required><?= esc($post['content'] ?? '') ?></textarea>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">SEO Settings</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="meta_title" class="form-label">Meta Title</label>
                        <input type="text" class="form-control" id="meta_title" name="meta_title" 
                               value="<?= esc($post['meta_title'] ?? '') ?>" 
                               placeholder="Leave blank to use post title">
                        <div class="form-text">Recommended: 50-60 characters</div>
                    </div>

                    <div class="mb-3">
                        <label for="meta_description" class="form-label">Meta Description</label>
                        <textarea class="form-control" id="meta_description" name="meta_description" rows="3" 
                                  placeholder="Brief description for search engines..."><?= esc($post['meta_description'] ?? '') ?></textarea>
                        <div class="form-text">Recommended: 150-160 characters</div>
                    </div>

                    <div class="mb-3">
                        <label for="meta_keywords" class="form-label">Meta Keywords</label>
                        <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" 
                               value="<?= esc($post['meta_keywords'] ?? '') ?>" 
                               placeholder="keyword1, keyword2, keyword3">
                        <div class="form-text">Separate with commas</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Publish Settings</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="draft" <?= ($post['status'] ?? 'draft') === 'draft' ? 'selected' : '' ?>>Draft</option>
                            <option value="published" <?= ($post['status'] ?? '') === 'published' ? 'selected' : '' ?>>Published</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category *</label>
                        <select class="form-select" id="category_id" name="category_id" required>
                            <option value="">Select Category</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['id'] ?>" 
                                        <?= ($post['category_id'] ?? '') == $category['id'] ? 'selected' : '' ?>>
                                    <?= esc($category['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="author" class="form-label">Author</label>
                        <input type="text" class="form-control" id="author" name="author" 
                               value="<?= esc($post['author'] ?? 'R-CAT Team') ?>">
                    </div>

                    <hr>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i> 
                            <?= isset($post['id']) ? 'Update Post' : 'Create Post' ?>
                        </button>
                        
                        <?php if (isset($post['id']) && $post['status'] === 'published'): ?>
                            <a href="/blog/<?= $post['slug'] ?>" target="_blank" class="btn btn-success">
                                <i class="bi bi-eye"></i> View Live Post
                            </a>
                        <?php endif; ?>
                        
                        <a href="/admin/blog/posts" class="btn btn-outline-secondary">
                            <i class="bi bi-x-circle"></i> Cancel
                        </a>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Tips</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled small text-muted mb-0">
                        <li><i class="bi bi-lightbulb text-warning"></i> Use clear, descriptive titles</li>
                        <li><i class="bi bi-lightbulb text-warning"></i> Write engaging excerpts to attract readers</li>
                        <li><i class="bi bi-lightbulb text-warning"></i> Add relevant keywords for better SEO</li>
                        <li><i class="bi bi-lightbulb text-warning"></i> Save as draft first, then publish when ready</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</form>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
// Auto-generate slug from title
document.getElementById('title').addEventListener('input', function() {
    const title = this.value;
    const slugField = document.getElementById('slug');
    
    if (!slugField.value) {
        const slug = title.toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-')
            .trim('-');
        slugField.value = slug;
    }
});

// Character count for meta fields
function addCharacterCount(fieldId, maxChars) {
    const field = document.getElementById(fieldId);
    const counter = document.createElement('div');
    counter.className = 'form-text';
    counter.id = fieldId + '_counter';
    
    function updateCount() {
        const length = field.value.length;
        counter.textContent = `${length}/${maxChars} characters`;
        counter.className = length > maxChars ? 'form-text text-danger' : 'form-text text-muted';
    }
    
    field.addEventListener('input', updateCount);
    field.parentNode.appendChild(counter);
    updateCount();
}

addCharacterCount('meta_title', 60);
addCharacterCount('meta_description', 160);
</script>
<?= $this->endSection() ?>
