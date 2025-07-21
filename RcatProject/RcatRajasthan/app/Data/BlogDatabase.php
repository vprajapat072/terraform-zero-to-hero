<?php

class BlogDatabase {
    private $pdo;
    
    public function __construct() {
        $this->connect();
    }
    
    private function connect() {
        try {
            // Database configuration - update with your actual credentials
            $host = 'localhost';
            $username = 'u169982873_rcatrajasthan';
            $password = 'Rcat@2024#DB';
            $database = 'u169982873_rcatrajasthan';
            
            $this->pdo = new PDO(
                "mysql:host=$host;dbname=$database;charset=utf8mb4", 
                $username, 
                $password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]
            );
        } catch (PDOException $e) {
            throw new Exception('Database connection failed: ' . $e->getMessage());
        }
    }
    
    // Blog Categories Methods
    public function getCategories($activeOnly = true) {
        $sql = "SELECT * FROM blog_categories";
        if ($activeOnly) {
            $sql .= " WHERE is_active = 1";
        }
        $sql .= " ORDER BY sort_order ASC, name ASC";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function getCategoryBySlug($slug) {
        $stmt = $this->pdo->prepare("SELECT * FROM blog_categories WHERE slug = ? AND is_active = 1");
        $stmt->execute([$slug]);
        return $stmt->fetch();
    }
    
    // Blog Posts Methods
    public function getPosts($filters = []) {
        $sql = "SELECT p.*, c.name as category_name, c.slug as category_slug, c.icon as category_icon 
                FROM blog_posts p 
                LEFT JOIN blog_categories c ON p.category_id = c.id 
                WHERE p.status = 'published' AND p.published_at <= NOW()";
        
        $params = [];
        
        // Filter by category
        if (!empty($filters['category_slug'])) {
            $sql .= " AND c.slug = ?";
            $params[] = $filters['category_slug'];
        }
        
        // Filter by featured
        if (isset($filters['featured'])) {
            $sql .= " AND p.is_featured = ?";
            $params[] = $filters['featured'] ? 1 : 0;
        }
        
        // Search in title and content
        if (!empty($filters['search'])) {
            $sql .= " AND (p.title LIKE ? OR p.excerpt LIKE ? OR p.content LIKE ?)";
            $searchTerm = '%' . $filters['search'] . '%';
            $params[] = $searchTerm;
            $params[] = $searchTerm;
            $params[] = $searchTerm;
        }
        
        // Limit
        $limit = $filters['limit'] ?? 10;
        $offset = $filters['offset'] ?? 0;
        
        $sql .= " ORDER BY p.is_featured DESC, p.published_at DESC LIMIT ? OFFSET ?";
        $params[] = $limit;
        $params[] = $offset;
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        $posts = $stmt->fetchAll();
        
        // Add tags to each post
        foreach ($posts as &$post) {
            $post['tags'] = $this->getPostTags($post['id']);
        }
        
        return $posts;
    }
    
    public function getPostBySlug($slug) {
        $sql = "SELECT p.*, c.name as category_name, c.slug as category_slug, c.icon as category_icon 
                FROM blog_posts p 
                LEFT JOIN blog_categories c ON p.category_id = c.id 
                WHERE p.slug = ? AND p.status = 'published' AND p.published_at <= NOW()";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$slug]);
        $post = $stmt->fetch();
        
        if ($post) {
            // Add tags
            $post['tags'] = $this->getPostTags($post['id']);
            
            // Increment view count
            $this->incrementViewCount($post['id']);
        }
        
        return $post;
    }
    
    public function getFeaturedPosts($limit = 3) {
        return $this->getPosts(['featured' => true, 'limit' => $limit]);
    }
    
    public function getRecentPosts($limit = 6, $excludeId = null) {
        $sql = "SELECT p.*, c.name as category_name, c.slug as category_slug, c.icon as category_icon 
                FROM blog_posts p 
                LEFT JOIN blog_categories c ON p.category_id = c.id 
                WHERE p.status = 'published' AND p.published_at <= NOW()";
        
        $params = [];
        
        if ($excludeId) {
            $sql .= " AND p.id != ?";
            $params[] = $excludeId;
        }
        
        $sql .= " ORDER BY p.published_at DESC LIMIT ?";
        $params[] = $limit;
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        $posts = $stmt->fetchAll();
        
        // Add tags to each post
        foreach ($posts as &$post) {
            $post['tags'] = $this->getPostTags($post['id']);
        }
        
        return $posts;
    }
    
    public function getPopularPosts($limit = 5) {
        $sql = "SELECT p.*, c.name as category_name, c.slug as category_slug, c.icon as category_icon 
                FROM blog_posts p 
                LEFT JOIN blog_categories c ON p.category_id = c.id 
                WHERE p.status = 'published' AND p.published_at <= NOW()
                ORDER BY p.view_count DESC, p.published_at DESC 
                LIMIT ?";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$limit]);
        $posts = $stmt->fetchAll();
        
        // Add tags to each post
        foreach ($posts as &$post) {
            $post['tags'] = $this->getPostTags($post['id']);
        }
        
        return $posts;
    }
    
    public function getRelatedPosts($postId, $categoryId, $limit = 3) {
        $sql = "SELECT p.*, c.name as category_name, c.slug as category_slug, c.icon as category_icon 
                FROM blog_posts p 
                LEFT JOIN blog_categories c ON p.category_id = c.id 
                WHERE p.id != ? AND p.category_id = ? AND p.status = 'published' AND p.published_at <= NOW()
                ORDER BY p.published_at DESC 
                LIMIT ?";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$postId, $categoryId, $limit]);
        $posts = $stmt->fetchAll();
        
        // Add tags to each post
        foreach ($posts as &$post) {
            $post['tags'] = $this->getPostTags($post['id']);
        }
        
        return $posts;
    }
    
    public function getPostsCount($filters = []) {
        $sql = "SELECT COUNT(*) FROM blog_posts p 
                LEFT JOIN blog_categories c ON p.category_id = c.id 
                WHERE p.status = 'published' AND p.published_at <= NOW()";
        
        $params = [];
        
        if (!empty($filters['category_slug'])) {
            $sql .= " AND c.slug = ?";
            $params[] = $filters['category_slug'];
        }
        
        if (!empty($filters['search'])) {
            $sql .= " AND (p.title LIKE ? OR p.excerpt LIKE ?)";
            $searchTerm = '%' . $filters['search'] . '%';
            $params[] = $searchTerm;
            $params[] = $searchTerm;
        }
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchColumn();
    }
    
    // Blog Tags Methods
    public function getPostTags($postId) {
        $sql = "SELECT t.* FROM blog_tags t 
                INNER JOIN post_tags pt ON t.id = pt.tag_id 
                WHERE pt.post_id = ? 
                ORDER BY t.name";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$postId]);
        return $stmt->fetchAll();
    }
    
    public function getAllTags() {
        $sql = "SELECT t.*, COUNT(pt.post_id) as post_count 
                FROM blog_tags t 
                LEFT JOIN post_tags pt ON t.id = pt.tag_id 
                GROUP BY t.id 
                ORDER BY post_count DESC, t.name ASC";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function getPopularTags($limit = 10) {
        $sql = "SELECT t.*, COUNT(pt.post_id) as post_count 
                FROM blog_tags t 
                INNER JOIN post_tags pt ON t.id = pt.tag_id 
                INNER JOIN blog_posts p ON pt.post_id = p.id 
                WHERE p.status = 'published' AND p.published_at <= NOW()
                GROUP BY t.id 
                HAVING post_count > 0
                ORDER BY post_count DESC, t.name ASC 
                LIMIT ?";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$limit]);
        return $stmt->fetchAll();
    }
    
    // Utility Methods
    public function incrementViewCount($postId) {
        $sql = "UPDATE blog_posts SET view_count = view_count + 1 WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$postId]);
    }
    
    public function searchPosts($query, $limit = 10) {
        $searchTerm = '%' . $query . '%';
        
        $sql = "SELECT p.*, c.name as category_name, c.slug as category_slug, c.icon as category_icon,
                MATCH(p.title, p.excerpt, p.content) AGAINST(? IN NATURAL LANGUAGE MODE) as relevance
                FROM blog_posts p 
                LEFT JOIN blog_categories c ON p.category_id = c.id 
                WHERE p.status = 'published' AND p.published_at <= NOW()
                AND (p.title LIKE ? OR p.excerpt LIKE ? OR p.content LIKE ?)
                ORDER BY relevance DESC, p.published_at DESC 
                LIMIT ?";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$query, $searchTerm, $searchTerm, $searchTerm, $limit]);
        $posts = $stmt->fetchAll();
        
        // Add tags to each post
        foreach ($posts as &$post) {
            $post['tags'] = $this->getPostTags($post['id']);
        }
        
        return $posts;
    }
    
    // Admin Methods (for future admin panel)
    public function createPost($data) {
        $sql = "INSERT INTO blog_posts (title, slug, excerpt, content, featured_image, meta_title, meta_description, meta_keywords, category_id, author, status, is_featured, published_at) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $data['title'],
            $data['slug'],
            $data['excerpt'],
            $data['content'],
            $data['featured_image'] ?? null,
            $data['meta_title'] ?? null,
            $data['meta_description'] ?? null,
            $data['meta_keywords'] ?? null,
            $data['category_id'] ?? null,
            $data['author'] ?? 'R-CAT Team',
            $data['status'] ?? 'published',
            $data['is_featured'] ?? 0,
            $data['published_at'] ?? date('Y-m-d H:i:s')
        ]);
    }
    
    public function updatePost($id, $data) {
        $sql = "UPDATE blog_posts SET title = ?, slug = ?, excerpt = ?, content = ?, featured_image = ?, meta_title = ?, meta_description = ?, meta_keywords = ?, category_id = ?, author = ?, status = ?, is_featured = ?, published_at = ?, updated_at = NOW() WHERE id = ?";
        
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $data['title'],
            $data['slug'],
            $data['excerpt'],
            $data['content'],
            $data['featured_image'] ?? null,
            $data['meta_title'] ?? null,
            $data['meta_description'] ?? null,
            $data['meta_keywords'] ?? null,
            $data['category_id'] ?? null,
            $data['author'] ?? 'R-CAT Team',
            $data['status'] ?? 'published',
            $data['is_featured'] ?? 0,
            $data['published_at'] ?? date('Y-m-d H:i:s'),
            $id
        ]);
    }
    
    public function deletePost($id) {
        // Delete post tags first
        $stmt = $this->pdo->prepare("DELETE FROM post_tags WHERE post_id = ?");
        $stmt->execute([$id]);
        
        // Delete post
        $stmt = $this->pdo->prepare("DELETE FROM blog_posts WHERE id = ?");
        return $stmt->execute([$id]);
    }
    
    // Statistics
    public function getBlogStats() {
        $stats = [];
        
        // Total posts
        $stmt = $this->pdo->query("SELECT COUNT(*) FROM blog_posts WHERE status = 'published'");
        $stats['total_posts'] = $stmt->fetchColumn();
        
        // Total categories
        $stmt = $this->pdo->query("SELECT COUNT(*) FROM blog_categories WHERE is_active = 1");
        $stats['total_categories'] = $stmt->fetchColumn();
        
        // Total views
        $stmt = $this->pdo->query("SELECT SUM(view_count) FROM blog_posts WHERE status = 'published'");
        $stats['total_views'] = $stmt->fetchColumn() ?? 0;
        
        // Most popular post
        $stmt = $this->pdo->query("SELECT title, view_count FROM blog_posts WHERE status = 'published' ORDER BY view_count DESC LIMIT 1");
        $popular = $stmt->fetch();
        $stats['most_popular_post'] = $popular['title'] ?? 'N/A';
        $stats['most_popular_views'] = $popular['view_count'] ?? 0;
        
        return $stats;
    }
}
?>
