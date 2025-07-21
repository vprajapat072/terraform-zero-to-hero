-- Blog Management Database Schema
-- R-CAT Rajasthan Dynamic Blog System

-- Blog categories table
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
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_slug (slug),
    INDEX idx_active (is_active),
    INDEX idx_sort (sort_order)
);

-- Blog posts table
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
    FOREIGN KEY (category_id) REFERENCES blog_categories(id) ON DELETE SET NULL,
    INDEX idx_status (status),
    INDEX idx_published_at (published_at),
    INDEX idx_category (category_id),
    INDEX idx_featured (is_featured),
    INDEX idx_slug (slug),
    INDEX idx_views (view_count)
);

-- Blog tags table
CREATE TABLE IF NOT EXISTS blog_tags (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    slug VARCHAR(50) UNIQUE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_slug (slug)
);

-- Post-tag relationship table
CREATE TABLE IF NOT EXISTS post_tags (
    post_id INT,
    tag_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (post_id, tag_id),
    FOREIGN KEY (post_id) REFERENCES blog_posts(id) ON DELETE CASCADE,
    FOREIGN KEY (tag_id) REFERENCES blog_tags(id) ON DELETE CASCADE
);

-- Insert default categories
INSERT INTO blog_categories (name, slug, description, meta_title, meta_description, icon, sort_order) VALUES
('Career Guidance', 'career-guidance', 'Professional development tips and career advice for tech professionals', 'Career Guidance - R-CAT Rajasthan', 'Expert career guidance and professional development tips for technology careers in Rajasthan', 'bi-compass', 1),
('Industry Trends', 'industry-trends', 'Latest trends and insights from the technology industry', 'Industry Trends - R-CAT Rajasthan', 'Stay updated with the latest technology industry trends and market insights', 'bi-graph-up', 2),
('Success Stories', 'success-stories', 'Inspiring stories from our successful alumni and students', 'Success Stories - R-CAT Rajasthan', 'Read inspiring success stories and career transformation journeys from R-CAT alumni', 'bi-trophy', 3),
('Course Updates', 'course-updates', 'Latest updates and announcements about our training programs', 'Course Updates - R-CAT Rajasthan', 'Get the latest updates about R-CAT courses, new programs, and announcements', 'bi-book', 4);

-- Insert sample blog posts
INSERT INTO blog_posts (title, slug, excerpt, content, category_id, meta_title, meta_description, meta_keywords, is_featured, published_at) VALUES
(
    'Top 10 Highest Paying Tech Jobs in Rajasthan 2025',
    'top-paying-tech-jobs-rajasthan-2025',
    'Discover the most lucrative technology careers available in Rajasthan and how R-CAT courses can help you achieve them.',
    '<h2>Introduction</h2><p>The technology sector in Rajasthan has experienced unprecedented growth over the past few years, transforming the state into one of India''s most promising tech destinations.</p><h2>Top 10 High-Paying Positions</h2><h3>1. Cloud Solutions Architect - ₹15-28 LPA</h3><p>Cloud architects are among the highest-paid tech professionals in Rajasthan, designing and implementing cloud infrastructure for organizations.</p><h3>2. Data Science Manager - ₹18-32 LPA</h3><p>Data science managers who can lead analytics teams and drive business insights command premium salaries.</p><h3>3. Cybersecurity Architect - ₹16-30 LPA</h3><p>As cyber threats increase, organizations invest heavily in cybersecurity professionals who can design comprehensive security frameworks.</p><p>Continue reading for complete details on all 10 positions, required skills, and career paths...</p>',
    1,
    'Top 10 Highest Paying Tech Jobs in Rajasthan 2025',
    'Discover the highest paying technology careers in Rajasthan with salary ranges, required skills, and how R-CAT training can help you land these lucrative positions.',
    'highest paying tech jobs rajasthan, IT careers jaipur, cloud computing salary, data science jobs, cybersecurity careers',
    1,
    '2025-07-20 10:00:00'
),
(
    'Cloud Computing Career Path: From Beginner to Expert',
    'cloud-computing-career-path',
    'Complete roadmap for building a successful career in cloud computing with AWS, Azure, and Google Cloud certifications.',
    '<h2>Getting Started in Cloud Computing</h2><p>Cloud computing has revolutionized the IT industry, creating numerous high-paying career opportunities.</p><h2>Learning Path</h2><h3>Phase 1: Fundamentals</h3><ul><li>Understanding cloud concepts</li><li>Basic networking and security</li><li>Linux fundamentals</li></ul><h3>Phase 2: Platform Specialization</h3><ul><li>AWS Solutions Architect</li><li>Microsoft Azure Administrator</li><li>Google Cloud Professional</li></ul><h2>Career Opportunities in Rajasthan</h2><p>Rajasthan offers excellent opportunities for cloud professionals with companies like Infosys, Tech Mahindra, and various startups actively hiring.</p>',
    1,
    'Cloud Computing Career Path: Complete Roadmap 2025',
    'Learn the complete cloud computing career roadmap from beginner to expert. Includes AWS, Azure, Google Cloud certifications and job opportunities in Rajasthan.',
    'cloud computing career, aws training, azure certification, google cloud, career roadmap',
    1,
    '2025-07-18 14:30:00'
),
(
    'Why Rajasthan is Becoming India''s Next Tech Hub',
    'rajasthan-emerging-tech-hub',
    'Explore how Rajasthan is transforming into a major technology destination and the opportunities it creates for IT professionals.',
    '<h2>Rajasthan''s Tech Transformation</h2><p>Rajasthan is rapidly emerging as one of India''s most promising technology destinations, driven by government initiatives and private investments.</p><h2>Government Support</h2><ul><li>Rajasthan IT Policy 2022-2027</li><li>Investment incentives for tech companies</li><li>Startup incubation programs</li><li>Skill development initiatives</li></ul><h2>Major Tech Investments</h2><p>Leading companies are establishing significant operations in Jaipur, Udaipur, and other cities, creating thousands of job opportunities.</p><h2>Growing Ecosystem</h2><p>The state now hosts over 300 IT companies and continues to attract both domestic and international investments.</p>',
    2,
    'Rajasthan: India''s Emerging Tech Hub - Complete Analysis',
    'Discover why Rajasthan is becoming a major technology destination in India. Learn about government initiatives, investments, and career opportunities.',
    'rajasthan tech hub, IT industry rajasthan, technology investment, jaipur tech companies',
    1,
    '2025-07-15 09:15:00'
),
(
    'Success Story: From Graduate to AWS Solutions Architect',
    'success-story-aws-architect',
    'Read how Priya Sharma transformed her career from a recent graduate to a certified AWS Solutions Architect earning ₹12 LPA.',
    '<h2>Student Background</h2><p>Priya Sharma, a Computer Science graduate from Rajasthan University, joined R-CAT''s AWS Solutions Architect program in January 2024.</p><h2>The Journey</h2><h3>Initial Challenges</h3><ul><li>Limited practical experience</li><li>Confusion about cloud technologies</li><li>Lack of industry connections</li></ul><h3>R-CAT Training Experience</h3><p>The 6-month intensive program provided hands-on experience with real-world projects, industry mentorship, and comprehensive certification preparation.</p><h2>Career Transformation</h2><p>Within 3 months of completing the program, Priya secured a position as AWS Solutions Architect at a leading Jaipur-based company with a starting salary of ₹12 LPA.</p><h2>Key Success Factors</h2><ul><li>Dedicated study schedule</li><li>Hands-on project experience</li><li>Industry networking</li><li>Continuous learning mindset</li></ul>',
    3,
    'Success Story: Graduate to AWS Solutions Architect',
    'Inspiring success story of career transformation from graduate to AWS Solutions Architect through R-CAT training program.',
    'aws success story, career transformation, r-cat alumni, cloud computing career',
    0,
    '2025-07-12 11:45:00'
),
(
    'New Batch Starting: Ethical Hacking & Cybersecurity',
    'new-batch-ethical-hacking',
    'Join our comprehensive 8-month Ethical Hacking and Cybersecurity program starting August 2025. Limited seats available.',
    '<h2>Program Overview</h2><p>Our comprehensive Ethical Hacking & Cybersecurity program is designed to prepare you for a successful career in information security.</p><h2>Course Curriculum</h2><h3>Module 1: Security Fundamentals</h3><ul><li>Network security basics</li><li>Security frameworks and standards</li><li>Risk assessment methodologies</li></ul><h3>Module 2: Penetration Testing</h3><ul><li>Vulnerability assessment tools</li><li>Manual testing techniques</li><li>Automated security testing</li></ul><h2>New Batch Details</h2><ul><li><strong>Start Date:</strong> August 1, 2025</li><li><strong>Duration:</strong> 8 months</li><li><strong>Batch Size:</strong> Limited to 25 students</li><li><strong>Schedule:</strong> Weekend batches available</li></ul><h2>Certification & Placement</h2><p>The program includes CEH certification preparation and has a 94% placement rate with leading cybersecurity companies.</p>',
    4,
    'Ethical Hacking & Cybersecurity Course - New Batch',
    'Join R-CAT''s comprehensive Ethical Hacking & Cybersecurity program. 8-month intensive training with CEH certification and 94% placement rate.',
    'ethical hacking course, cybersecurity training, penetration testing, CEH certification',
    0,
    '2025-07-10 16:20:00'
),
(
    'AI and Machine Learning Trends in 2025',
    'ai-ml-trends-2025',
    'Discover the latest trends in artificial intelligence and machine learning that will shape the technology landscape in 2025.',
    '<h2>AI/ML Landscape in 2025</h2><p>Artificial Intelligence and Machine Learning continue to drive innovation across industries, creating new opportunities and transforming existing processes.</p><h2>Key Trends Shaping 2025</h2><h3>1. Generative AI Maturation</h3><p>Large Language Models (LLMs) and generative AI tools are becoming more sophisticated and integrated into business workflows.</p><h3>2. Edge AI Deployment</h3><p>AI processing is moving closer to data sources, reducing latency and improving real-time decision making.</p><h3>3. AI Ethics and Governance</h3><p>Organizations are implementing stronger AI governance frameworks and ethical guidelines.</p><h2>Opportunities in Rajasthan</h2><p>Rajasthan''s growing tech ecosystem offers excellent opportunities for AI/ML professionals, particularly in:</p><ul><li>Agricultural AI solutions</li><li>Healthcare technology</li><li>Financial services</li><li>Smart city initiatives</li></ul>',
    2,
    'AI and Machine Learning Trends 2025 - Complete Guide',
    'Explore the latest AI and ML trends for 2025. Learn about generative AI, edge computing, and career opportunities in Rajasthan.',
    'AI trends 2025, machine learning career, artificial intelligence jobs, AI opportunities rajasthan',
    0,
    '2025-07-08 13:10:00'
);

-- Insert sample tags
INSERT INTO blog_tags (name, slug) VALUES
('Cloud Computing', 'cloud-computing'),
('Career Development', 'career-development'),
('AWS', 'aws'),
('Azure', 'azure'),
('Google Cloud', 'google-cloud'),
('Cybersecurity', 'cybersecurity'),
('Data Science', 'data-science'),
('Machine Learning', 'machine-learning'),
('Artificial Intelligence', 'ai'),
('Job Market', 'job-market'),
('Salary Guide', 'salary-guide'),
('Success Stories', 'success-stories'),
('Tech Industry', 'tech-industry'),
('Rajasthan', 'rajasthan'),
('Course Updates', 'course-updates');

-- Link posts with tags
INSERT INTO post_tags (post_id, tag_id) VALUES
(1, 7), (1, 10), (1, 11), (1, 14), -- Top paying jobs: career-development, job-market, salary-guide, rajasthan
(2, 1), (2, 3), (2, 4), (2, 5), -- Cloud career: cloud-computing, aws, azure, google-cloud
(3, 13), (3, 14), (3, 10), -- Tech hub: tech-industry, rajasthan, job-market
(4, 3), (4, 12), (4, 7), -- Success story: aws, success-stories, career-development
(5, 6), (5, 15), -- Ethical hacking: cybersecurity, course-updates
(6, 8), (6, 9), (6, 13); -- AI trends: machine-learning, ai, tech-industry
