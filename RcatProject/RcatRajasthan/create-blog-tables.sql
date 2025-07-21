-- Simple SQL script to create blog tables and sample data
-- Execute this in your database to enable dynamic blog management

USE rcatrajasthan_db;

-- Create blog_categories table
CREATE TABLE IF NOT EXISTS blog_categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) UNIQUE NOT NULL,
    description TEXT,
    meta_title VARCHAR(60),
    meta_description VARCHAR(160),
    icon VARCHAR(50) DEFAULT 'bi-tag',
    sort_order INT DEFAULT 0,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Create blog_posts table
CREATE TABLE IF NOT EXISTS blog_posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    excerpt TEXT,
    content LONGTEXT NOT NULL,
    featured_image VARCHAR(255),
    meta_title VARCHAR(60),
    meta_description VARCHAR(160),
    meta_keywords TEXT,
    category_id INT,
    author VARCHAR(100) DEFAULT 'R-CAT Team',
    status ENUM('draft', 'published', 'scheduled') DEFAULT 'published',
    is_featured TINYINT(1) DEFAULT 0,
    view_count INT DEFAULT 0,
    published_at DATETIME,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES blog_categories(id) ON DELETE SET NULL
);

-- Insert default categories
INSERT INTO blog_categories (name, slug, description, meta_title, meta_description, icon, sort_order) VALUES
('Career Guidance', 'career-guidance', 'Professional development tips and career advice', 'Career Guidance - R-CAT', 'Expert career guidance for tech professionals', 'bi-compass', 1),
('Industry Trends', 'industry-trends', 'Latest trends from the technology industry', 'Industry Trends - R-CAT', 'Latest technology industry trends and insights', 'bi-graph-up', 2),
('Success Stories', 'success-stories', 'Inspiring stories from our alumni', 'Success Stories - R-CAT', 'Success stories from R-CAT alumni', 'bi-trophy', 3),
('Course Updates', 'course-updates', 'Latest updates about our programs', 'Course Updates - R-CAT', 'Latest course updates and announcements', 'bi-book', 4);

-- Insert sample blog posts
INSERT INTO blog_posts (title, slug, excerpt, content, category_id, meta_title, meta_description, meta_keywords, is_featured, published_at) VALUES
(
    'Top 10 Highest Paying Tech Jobs in Rajasthan 2025',
    'top-paying-tech-jobs-rajasthan-2025',
    'Discover the most lucrative technology careers available in Rajasthan and how R-CAT courses can help you achieve them.',
    '<h2>The Tech Revolution in Rajasthan</h2><p>The technology sector in Rajasthan has experienced unprecedented growth, creating high-paying opportunities for skilled professionals.</p><h3>1. Cloud Solutions Architect - ₹15-28 LPA</h3><p>Cloud architects design and implement scalable cloud infrastructure solutions for enterprises.</p><h3>2. Data Science Manager - ₹18-32 LPA</h3><p>Lead analytics teams and drive business insights through data science.</p><h3>How R-CAT Helps</h3><p>Our comprehensive training programs prepare you for these high-paying roles with industry partnerships and hands-on projects.</p>',
    1,
    'Top 10 Highest Paying Tech Jobs in Rajasthan 2025',
    'Discover lucrative tech careers in Rajasthan and how R-CAT training can help you achieve them',
    'tech jobs rajasthan, highest paying careers, cloud computing, data science',
    1,
    '2025-07-10 10:00:00'
),
(
    'Cloud Computing Career Path: From Beginner to Expert',
    'cloud-computing-career-path',
    'Complete roadmap for building a successful career in cloud computing with AWS, Azure, and Google Cloud certifications.',
    '<h2>Your Journey to Cloud Computing Mastery</h2><p>Cloud computing offers excellent career opportunities with high salaries and job security.</p><h3>Learning Path</h3><p>Phase 1: Foundation concepts<br>Phase 2: Platform specialization<br>Phase 3: Advanced skills</p><h3>R-CAT Cloud Program</h3><p>Our AWS Solutions Architect course takes you from beginner to industry-ready in 6 months.</p>',
    1,
    'Cloud Computing Career Path Guide 2025',
    'Complete roadmap for cloud computing career with AWS, Azure, Google Cloud certifications',
    'cloud computing career, aws training, azure certification, google cloud',
    1,
    '2025-07-08 14:30:00'
),
(
    'Why Rajasthan is Becoming India''s Next Tech Hub',
    'rajasthan-emerging-tech-hub',
    'Explore how Rajasthan is transforming into a major technology destination and the opportunities it creates.',
    '<h2>The Rise of Rajasthan as a Tech Powerhouse</h2><p>Government initiatives and corporate investments are making Rajasthan a prime tech destination.</p><h3>Government Support</h3><p>IT Policy 2022-2027 targets ₹75,000 crores investment and 500,000 new jobs.</p><h3>Growing Opportunities</h3><p>Major companies like Infosys, Tech Mahindra establishing operations in Jaipur and other cities.</p>',
    2,
    'Rajasthan Tech Hub - Industry Growth and Opportunities',
    'How Rajasthan is becoming India''s next major technology destination with new opportunities',
    'rajasthan tech hub, IT industry growth, technology jobs rajasthan',
    1,
    '2025-07-05 16:45:00'
);

SELECT 'Dynamic blog tables created successfully!' as message;
