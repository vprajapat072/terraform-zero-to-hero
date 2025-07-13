-- R-CAT Rajasthan Website Database Schema
-- This file contains the database structure for the website

-- Create database (run this first)
CREATE DATABASE IF NOT EXISTS rcat_rajasthan CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE rcat_rajasthan;

-- Users table for admin authentication
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'editor') DEFAULT 'editor',
    is_active BOOLEAN DEFAULT TRUE,
    last_login TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Course categories table
CREATE TABLE course_categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) UNIQUE NOT NULL,
    description TEXT,
    icon VARCHAR(50),
    sort_order INT DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Courses table
CREATE TABLE courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT,
    name VARCHAR(200) NOT NULL,
    slug VARCHAR(200) UNIQUE NOT NULL,
    short_description TEXT,
    description LONGTEXT,
    duration VARCHAR(50),
    fee VARCHAR(20),
    eligibility TEXT,
    curriculum LONGTEXT,
    partnership_details TEXT,
    image VARCHAR(255),
    is_featured BOOLEAN DEFAULT FALSE,
    is_active BOOLEAN DEFAULT TRUE,
    views INT DEFAULT 0,
    sort_order INT DEFAULT 0,
    meta_title VARCHAR(255),
    meta_description TEXT,
    meta_keywords TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES course_categories(id) ON DELETE SET NULL,
    INDEX idx_slug (slug),
    INDEX idx_category (category_id),
    INDEX idx_featured (is_featured),
    INDEX idx_active (is_active)
);

-- Pages table for static content management
CREATE TABLE pages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    slug VARCHAR(200) UNIQUE NOT NULL,
    content LONGTEXT,
    is_active BOOLEAN DEFAULT TRUE,
    meta_title VARCHAR(255),
    meta_description TEXT,
    meta_keywords TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_slug (slug),
    INDEX idx_active (is_active)
);

-- Blog categories table
CREATE TABLE blog_categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) UNIQUE NOT NULL,
    description TEXT,
    sort_order INT DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Blog posts table
CREATE TABLE blog_posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    excerpt TEXT,
    content LONGTEXT,
    image VARCHAR(255),
    author_id INT,
    status ENUM('draft', 'published', 'archived') DEFAULT 'draft',
    published_at TIMESTAMP NULL,
    views INT DEFAULT 0,
    meta_title VARCHAR(255),
    meta_description TEXT,
    meta_keywords TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES blog_categories(id) ON DELETE SET NULL,
    FOREIGN KEY (author_id) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_slug (slug),
    INDEX idx_category (category_id),
    INDEX idx_status (status),
    INDEX idx_published (published_at)
);

-- Blog tags table
CREATE TABLE blog_tags (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) UNIQUE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Blog post tags relationship table
CREATE TABLE blog_post_tags (
    post_id INT,
    tag_id INT,
    PRIMARY KEY (post_id, tag_id),
    FOREIGN KEY (post_id) REFERENCES blog_posts(id) ON DELETE CASCADE,
    FOREIGN KEY (tag_id) REFERENCES blog_tags(id) ON DELETE CASCADE
);

-- Settings table for site configuration
CREATE TABLE settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(100) UNIQUE NOT NULL,
    setting_value LONGTEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Newsletter subscribers table
CREATE TABLE newsletter_subscribers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) UNIQUE NOT NULL,
    status ENUM('active', 'inactive', 'unsubscribed') DEFAULT 'active',
    subscribed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    unsubscribed_at TIMESTAMP NULL,
    INDEX idx_email (email),
    INDEX idx_status (status)
);

-- Contact form submissions table
CREATE TABLE contact_submissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL,
    subject VARCHAR(255),
    message TEXT,
    status ENUM('new', 'read', 'responded') DEFAULT 'new',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_status (status),
    INDEX idx_created (created_at)
);

-- Site analytics table
CREATE TABLE site_analytics (
    id INT AUTO_INCREMENT PRIMARY KEY,
    page_url VARCHAR(255) NOT NULL,
    page_title VARCHAR(255),
    visitor_ip VARCHAR(45),
    user_agent TEXT,
    referrer VARCHAR(255),
    visit_date DATE,
    visit_time TIME,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_page (page_url),
    INDEX idx_date (visit_date),
    INDEX idx_ip (visitor_ip)
);

-- Insert default data
INSERT INTO course_categories (name, slug, description, icon, sort_order) VALUES
('Technology', 'technology', 'Cutting-edge technology courses', 'bi-cpu', 1),
('Security', 'security', 'Cybersecurity and information security courses', 'bi-shield-check', 2),
('Data Science', 'data-science', 'Data analytics and machine learning courses', 'bi-bar-chart', 3),
('Cloud Computing', 'cloud-computing', 'Cloud platforms and services', 'bi-cloud', 4),
('Web Development', 'web-development', 'Web design and development courses', 'bi-code-slash', 5);

INSERT INTO blog_categories (name, slug, description, sort_order) VALUES
('Career Guidance', 'career-guidance', 'Career tips and guidance for students', 1),
('Industry Trends', 'industry-trends', 'Latest trends in technology and industry', 2),
('Success Stories', 'success-stories', 'Alumni success stories and achievements', 3),
('Course Updates', 'course-updates', 'Updates and announcements about courses', 4),
('Technology News', 'technology-news', 'Latest technology news and updates', 5);

INSERT INTO pages (title, slug, content, meta_title, meta_description) VALUES
('About Us', 'about', '<h1>About R-CAT Rajasthan</h1><p>Content will be added here...</p>', 'About R-CAT Rajasthan', 'Learn about R-CAT Rajasthan, its mission, vision, and commitment to quality education.'),
('Admission Process', 'admission', '<h1>Admission Process</h1><p>Content will be added here...</p>', 'Admission Process - R-CAT Rajasthan', 'Complete guide to R-CAT admission process, requirements, and deadlines.'),
('Contact Us', 'contact', '<h1>Contact Us</h1><p>Content will be added here...</p>', 'Contact R-CAT Rajasthan', 'Get in touch with R-CAT Rajasthan for inquiries and support.');

INSERT INTO settings (setting_key, setting_value) VALUES
('site_title', 'R-CAT Rajasthan'),
('site_description', 'Fast & Easy Guide to R-CAT Rajasthan Courses'),
('site_keywords', 'R-CAT Rajasthan, RCAT courses, Rajasthan government courses, skill development'),
('contact_email', 'info@rcatrajasthan.com'),
('contact_phone', '+91-1234567890'),
('google_analytics_id', 'G-XXXXXXXXXX'),
('facebook_url', 'https://facebook.com/rcatrajasthan'),
('twitter_url', 'https://twitter.com/rcatrajasthan'),
('instagram_url', 'https://instagram.com/rcatrajasthan'),
('linkedin_url', 'https://linkedin.com/company/rcatrajasthan');

-- Create default admin user (password: admin123)
INSERT INTO users (username, email, password, role) VALUES
('admin', 'admin@rcatrajasthan.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');

-- Sample courses data
INSERT INTO courses (category_id, name, slug, short_description, description, duration, fee, eligibility, curriculum, partnership_details, is_featured, meta_title, meta_description, sort_order) VALUES
(1, 'Cloud Computing', 'cloud-computing', 'Master AWS, Azure, and Google Cloud platforms', 'Comprehensive cloud computing course covering major platforms...', '6 months', '₹25,000', 'Graduate in any discipline', 'Module 1: Cloud Fundamentals...', 'In collaboration with AWS and Microsoft', TRUE, 'Cloud Computing Course - R-CAT Rajasthan', 'Learn cloud computing with AWS, Azure, and Google Cloud at R-CAT Rajasthan.', 1),
(1, 'Artificial Intelligence & Machine Learning', 'artificial-intelligence', 'Learn AI/ML concepts and build real-world applications', 'Advanced AI/ML course with hands-on projects...', '8 months', '₹30,000', 'Graduate with Mathematics background', 'Module 1: Python Programming...', 'In collaboration with Google and IBM', TRUE, 'AI/ML Course - R-CAT Rajasthan', 'Master artificial intelligence and machine learning at R-CAT Rajasthan.', 2),
(2, 'Cybersecurity', 'cybersecurity', 'Become a cybersecurity expert with ethical hacking training', 'Complete cybersecurity course with practical training...', '5 months', '₹20,000', 'Graduate in Computer Science or related field', 'Module 1: Network Security...', 'In collaboration with EC-Council', TRUE, 'Cybersecurity Course - R-CAT Rajasthan', 'Learn cybersecurity and ethical hacking at R-CAT Rajasthan.', 3);

-- Sample blog posts
INSERT INTO blog_posts (category_id, title, slug, excerpt, content, author_id, status, published_at, meta_title, meta_description) VALUES
(1, 'Top 5 Highest Paying Tech Skills in 2025', 'highest-paying-tech-skills-2025', 'Discover the most in-demand technical skills that offer the highest salary packages.', '<p>Full blog content here...</p>', 1, 'published', NOW(), 'Top 5 Highest Paying Tech Skills in 2025', 'Learn about the highest paying tech skills in 2025 and how to acquire them.'),
(1, 'Why Choose R-CAT for Your Career Growth', 'why-choose-rcat-career-growth', 'Learn about the unique advantages of R-CAT programs.', '<p>Full blog content here...</p>', 1, 'published', NOW(), 'Why Choose R-CAT for Career Growth', 'Discover the advantages of choosing R-CAT for your career development.');

-- Create indexes for better performance
CREATE INDEX idx_courses_featured_active ON courses(is_featured, is_active);
CREATE INDEX idx_blog_posts_status_published ON blog_posts(status, published_at);
CREATE INDEX idx_site_analytics_date_url ON site_analytics(visit_date, page_url);

-- Create full-text search indexes
ALTER TABLE courses ADD FULLTEXT(name, short_description, description);
ALTER TABLE blog_posts ADD FULLTEXT(title, excerpt, content);
ALTER TABLE pages ADD FULLTEXT(title, content);
