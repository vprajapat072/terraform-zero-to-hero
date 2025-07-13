<!-- Dashboard Stats -->
<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stats-card">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <h2 class="mb-0"><?php echo $stats['total_courses']; ?></h2>
                    <p class="mb-0">Total Courses</p>
                </div>
                <div class="fs-2 opacity-75">
                    <i class="fas fa-book"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stats-card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <h2 class="mb-0"><?php echo $stats['total_blog_posts']; ?></h2>
                    <p class="mb-0">Blog Posts</p>
                </div>
                <div class="fs-2 opacity-75">
                    <i class="fas fa-blog"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stats-card" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <h2 class="mb-0"><?php echo $stats['total_users']; ?></h2>
                    <p class="mb-0">Total Users</p>
                </div>
                <div class="fs-2 opacity-75">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stats-card" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <h2 class="mb-0"><?php echo $stats['total_subscribers']; ?></h2>
                    <p class="mb-0">Subscribers</p>
                </div>
                <div class="fs-2 opacity-75">
                    <i class="fas fa-envelope"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-rocket me-2"></i>
                    Quick Actions
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <a href="/admin/courses/new" class="btn btn-primary w-100">
                            <i class="fas fa-plus me-2"></i>
                            Add New Course
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="/admin/blog/new" class="btn btn-success w-100">
                            <i class="fas fa-edit me-2"></i>
                            Write Blog Post
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="/admin/users/new" class="btn btn-info w-100">
                            <i class="fas fa-user-plus me-2"></i>
                            Add User
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="/admin/settings" class="btn btn-warning w-100">
                            <i class="fas fa-cog me-2"></i>
                            Settings
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity -->
<div class="row">
    <div class="col-xl-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-clock me-2"></i>
                    Recent Blog Posts
                </h5>
                <a href="/admin/blog" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body">
                <?php if (empty($stats['recent_posts'])): ?>
                    <div class="text-center py-4">
                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                        <p class="text-muted">No recent blog posts</p>
                        <a href="/admin/blog/new" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>
                            Create First Post
                        </a>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($stats['recent_posts'] as $post): ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                                    <i class="fas fa-file-alt text-primary"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0"><?php echo htmlspecialchars($post['title']); ?></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="text-muted">
                                                <?php echo date('M d, Y', strtotime($post['created_at'])); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <a href="/admin/blog/edit/<?php echo $post['id'] ?? 1; ?>" 
                                               class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <div class="col-xl-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-users me-2"></i>
                    Recent Subscribers
                </h5>
                <a href="/admin/subscribers" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body">
                <?php if (empty($stats['recent_subscribers'])): ?>
                    <div class="text-center py-4">
                        <i class="fas fa-user-plus fa-2x text-muted mb-3"></i>
                        <p class="text-muted">No subscribers yet</p>
                    </div>
                <?php else: ?>
                    <div class="list-group list-group-flush">
                        <?php foreach ($stats['recent_subscribers'] as $subscriber): ?>
                            <div class="list-group-item px-0 border-0">
                                <div class="d-flex align-items-center">
                                    <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
                                        <i class="fas fa-envelope text-success"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0"><?php echo htmlspecialchars($subscriber['email']); ?></h6>
                                        <small class="text-muted">
                                            <?php echo date('M d, Y', strtotime($subscriber['subscribed_at'])); ?>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- System Info -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-info-circle me-2"></i>
                    System Information
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="text-center">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-3 mb-3 d-inline-block">
                                <i class="fas fa-server fa-2x text-primary"></i>
                            </div>
                            <h6>Server Status</h6>
                            <span class="badge bg-success">Online</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-center">
                            <div class="bg-info bg-opacity-10 rounded-circle p-3 mb-3 d-inline-block">
                                <i class="fas fa-database fa-2x text-info"></i>
                            </div>
                            <h6>Database</h6>
                            <span class="badge <?php echo isDbConnected() ? 'bg-success' : 'bg-warning'; ?>">
                                <?php echo isDbConnected() ? 'Connected' : 'Demo Mode'; ?>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-center">
                            <div class="bg-warning bg-opacity-10 rounded-circle p-3 mb-3 d-inline-block">
                                <i class="fas fa-code fa-2x text-warning"></i>
                            </div>
                            <h6>PHP Version</h6>
                            <span class="badge bg-info"><?php echo phpversion(); ?></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-center">
                            <div class="bg-success bg-opacity-10 rounded-circle p-3 mb-3 d-inline-block">
                                <i class="fas fa-shield-alt fa-2x text-success"></i>
                            </div>
                            <h6>Security</h6>
                            <span class="badge bg-success">Secure</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Auto-refresh stats every 5 minutes
setInterval(() => {
    window.location.reload();
}, 300000);

// Add animation to stats cards
document.addEventListener('DOMContentLoaded', function() {
    const statsCards = document.querySelectorAll('.stats-card');
    
    statsCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            card.style.transition = 'all 0.5s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });
});
</script>
