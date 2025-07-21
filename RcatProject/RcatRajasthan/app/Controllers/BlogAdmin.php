<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class BlogAdmin extends Controller
{
    protected $db;
    protected $session;
    
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->session = \Config\Services::session();
    }
    
    public function index()
    {
        // Check if user is logged in
        if (!$this->isLoggedIn()) {
            return redirect()->to('/admin/login');
        }
        
        return $this->posts();
    }
    
    public function posts()
    {
        // Check if user is logged in
        if (!$this->isLoggedIn()) {
            return redirect()->to('/admin/login');
        }
        
        $page = $this->request->getGet('page') ?? 1;
        $search = $this->request->getGet('search');
        $status = $this->request->getGet('status');
        $category = $this->request->getGet('category');
        $limit = 10;
        $offset = ($page - 1) * $limit;
        
        // Build query conditions
        $whereConditions = ['1=1'];
        $params = [];
        
        if ($search) {
            $whereConditions[] = '(bp.title LIKE ? OR bp.content LIKE ?)';
            $searchTerm = '%' . $search . '%';
            $params[] = $searchTerm;
            $params[] = $searchTerm;
        }
        
        if ($status) {
            $whereConditions[] = 'bp.status = ?';
            $params[] = $status;
        }
        
        if ($category) {
            $whereConditions[] = 'bp.category_id = ?';
            $params[] = $category;
        }
        
        $whereClause = implode(' AND ', $whereConditions);
        
        // Get blog posts
        $query = "SELECT bp.*, bc.name as category_name 
                  FROM blog_posts bp 
                  LEFT JOIN blog_categories bc ON bp.category_id = bc.id 
                  WHERE {$whereClause} 
                  ORDER BY bp.created_at DESC 
                  LIMIT {$limit} OFFSET {$offset}";
        $posts = $this->db->query($query, $params)->getResultArray();
        
        // Get total count for pagination
        $countQuery = "SELECT COUNT(*) as total FROM blog_posts bp WHERE {$whereClause}";
        $totalPosts = $this->db->query($countQuery, $params)->getRow()->total;
        
        // Get categories for filter
        $categories = $this->db->query('SELECT id, name FROM blog_categories WHERE is_active = 1 ORDER BY name')->getResultArray();
        
        $data = [
            'pageTitle' => 'Manage Blog Posts - Admin',
            'posts' => $posts,
            'categories' => $categories,
            'current_page' => $page,
            'total_pages' => ceil($totalPosts / $limit),
            'total_posts' => $totalPosts,
            'search' => $search,
            'status_filter' => $status,
            'category_filter' => $category
        ];
        
        return view('admin/blog/posts', $data);
    }
    
    public function create()
    {
        // Check if user is logged in
        if (!$this->isLoggedIn()) {
            return redirect()->to('/admin/login');
        }
        
        $data = [
            'pageTitle' => 'Create New Post - Admin',
            'categories' => $this->getCategories(),
            'post' => null,
            'errors' => []
        ];
        
        if ($this->request->getMethod() === 'POST') {
            $postData = $this->request->getPost();
            $validation = $this->validatePost($postData);
            
            if ($validation['valid']) {
                $postId = $this->savePost($postData);
                if ($postId) {
                    return redirect()->to('/admin/blog/edit/' . $postId)->with('success', 'Post created successfully!');
                } else {
                    $data['errors'][] = 'Failed to create post. Please try again.';
                }
            } else {
                $data['errors'] = $validation['errors'];
                $data['post'] = $postData;
            }
        }
        
        return view('admin/blog/create', $data);
    }
    
    public function edit($id)
    {
        // Check if user is logged in
        if (!$this->isLoggedIn()) {
            return redirect()->to('/admin/login');
        }
        
        $post = $this->getPost($id);
        if (!$post) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        
        $data = [
            'pageTitle' => 'Edit Post - Admin',
            'categories' => $this->getCategories(),
            'post' => $post,
            'errors' => []
        ];
        
        if ($this->request->getMethod() === 'POST') {
            $postData = $this->request->getPost();
            $postData['id'] = $id;
            $validation = $this->validatePost($postData, true);
            
            if ($validation['valid']) {
                if ($this->updatePost($id, $postData)) {
                    return redirect()->to('/admin/blog/edit/' . $id)->with('success', 'Post updated successfully!');
                } else {
                    $data['errors'][] = 'Failed to update post. Please try again.';
                }
            } else {
                $data['errors'] = $validation['errors'];
                $data['post'] = array_merge($post, $postData);
            }
        }
        
        return view('admin/blog/edit', $data);
    }
    
    public function delete($id)
    {
        // Check if user is logged in
        if (!$this->isLoggedIn()) {
            return redirect()->to('/admin/login');
        }
        
        if ($this->request->getMethod() === 'POST') {
            if ($this->deletePost($id)) {
                return redirect()->to('/admin/blog/posts')->with('success', 'Post deleted successfully!');
            } else {
                return redirect()->to('/admin/blog/posts')->with('error', 'Failed to delete post.');
            }
        }
        
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }
    
    public function categories()
    {
        // Check if user is logged in
        if (!$this->isLoggedIn()) {
            return redirect()->to('/admin/login');
        }
        
        $categories = $this->db->query('SELECT * FROM blog_categories ORDER BY sort_order, name')->getResultArray();
        
        $data = [
            'pageTitle' => 'Manage Categories - Admin',
            'categories' => $categories
        ];
        
        return view('admin/blog/categories', $data);
    }
    
    private function isLoggedIn()
    {
        return $this->session->get('admin_logged_in') === true;
    }
    
    private function getCategories()
    {
        return $this->db->query('SELECT id, name FROM blog_categories WHERE is_active = 1 ORDER BY name')->getResultArray();
    }
    
    private function getPost($id)
    {
        return $this->db->query('SELECT * FROM blog_posts WHERE id = ?', [$id])->getRowArray();
    }
    
    private function validatePost($data, $isUpdate = false)
    {
        $errors = [];
        
        if (empty($data['title'])) {
            $errors[] = 'Title is required';
        }
        
        if (empty($data['content'])) {
            $errors[] = 'Content is required';
        }
        
        if (empty($data['excerpt'])) {
            $errors[] = 'Excerpt is required';
        }
        
        if (empty($data['category_id'])) {
            $errors[] = 'Category is required';
        }
        
        // Check if slug is unique
        if (!empty($data['slug'])) {
            $existingSlug = $this->db->query(
                'SELECT id FROM blog_posts WHERE slug = ?' . ($isUpdate ? ' AND id != ?' : ''),
                $isUpdate ? [$data['slug'], $data['id']] : [$data['slug']]
            )->getRow();
            
            if ($existingSlug) {
                $errors[] = 'Slug must be unique';
            }
        }
        
        return [
            'valid' => empty($errors),
            'errors' => $errors
        ];
    }
    
    private function savePost($data)
    {
        // Generate slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = $this->generateSlug($data['title']);
        }
        
        // Set default values
        $data['author'] = $data['author'] ?? 'R-CAT Team';
        $data['status'] = $data['status'] ?? 'draft';
        $data['published_at'] = ($data['status'] === 'published') ? date('Y-m-d H:i:s') : null;
        
        $query = "INSERT INTO blog_posts (title, slug, excerpt, content, category_id, author, status, meta_title, meta_description, meta_keywords, published_at) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $params = [
            $data['title'],
            $data['slug'],
            $data['excerpt'],
            $data['content'],
            $data['category_id'],
            $data['author'],
            $data['status'],
            $data['meta_title'] ?? '',
            $data['meta_description'] ?? '',
            $data['meta_keywords'] ?? '',
            $data['published_at']
        ];
        
        if ($this->db->query($query, $params)) {
            return $this->db->insertID();
        }
        
        return false;
    }
    
    private function updatePost($id, $data)
    {
        // Generate slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = $this->generateSlug($data['title']);
        }
        
        // Update published_at if status changes to published
        if ($data['status'] === 'published') {
            $existingPost = $this->getPost($id);
            if ($existingPost['status'] !== 'published') {
                $data['published_at'] = date('Y-m-d H:i:s');
            }
        }
        
        $query = "UPDATE blog_posts 
                  SET title = ?, slug = ?, excerpt = ?, content = ?, category_id = ?, author = ?, 
                      status = ?, meta_title = ?, meta_description = ?, meta_keywords = ?, 
                      published_at = ?, updated_at = CURRENT_TIMESTAMP 
                  WHERE id = ?";
        
        $params = [
            $data['title'],
            $data['slug'],
            $data['excerpt'],
            $data['content'],
            $data['category_id'],
            $data['author'] ?? 'R-CAT Team',
            $data['status'],
            $data['meta_title'] ?? '',
            $data['meta_description'] ?? '',
            $data['meta_keywords'] ?? '',
            $data['published_at'] ?? null,
            $id
        ];
        
        return $this->db->query($query, $params);
    }
    
    private function deletePost($id)
    {
        return $this->db->query('DELETE FROM blog_posts WHERE id = ?', [$id]);
    }
    
    private function generateSlug($title)
    {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title), '-'));
        
        // Ensure uniqueness
        $originalSlug = $slug;
        $counter = 1;
        
        while ($this->db->query('SELECT id FROM blog_posts WHERE slug = ?', [$slug])->getRow()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }
        
        return $slug;
    }
}
