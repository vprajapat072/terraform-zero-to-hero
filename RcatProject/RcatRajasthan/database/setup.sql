-- R-CAT Rajasthan Database Setup Script
-- This script creates all necessary tables and inserts initial data

-- Create database (if running locally)
-- CREATE DATABASE IF NOT EXISTS rcat_rajasthan CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
-- USE rcat_rajasthan;

---- Insert admin users (password: admin123)
INSERT INTO admin_users (username, email, password_hash, full_name, role, is_active) VALUES 
('admin', 'admin@rcatrajasthan.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'R-CAT Administrator', 'super_admin', TRUE),
('instructor', 'instructor@rcatrajasthan.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Course Instructor', 'instructor', TRUE);

-- Insert blog posts
INSERT INTO blog_posts (title, slug, excerpt, content, author, category, tags, featured_image, is_published, is_featured) VALUES 
(
    'Cloud Computing Trends in 2024: What Professionals Need to Know',
    'cloud-computing-trends-2024',
    'Discover the latest cloud computing trends that are shaping the industry in 2024. From serverless computing to edge computing, learn what skills you need to stay ahead.',
    '<p>Cloud computing continues to evolve rapidly, and 2024 brings exciting new trends that professionals must understand to remain competitive. At R-CAT Rajasthan, we stay ahead of these trends to ensure our students are prepared for the future of technology.</p>

<h3>1. Serverless Computing Revolution</h3>
<p>Serverless computing is becoming mainstream, allowing developers to focus on code without managing infrastructure. AWS Lambda, Azure Functions, and Google Cloud Functions are leading this transformation.</p>

<h3>2. Edge Computing Integration</h3>
<p>With the rise of IoT devices and 5G networks, edge computing is bringing processing power closer to data sources, reducing latency and improving performance.</p>

<h3>3. AI-Powered Cloud Services</h3>
<p>Cloud providers are integrating AI and machine learning capabilities directly into their platforms, making advanced AI accessible to all organizations.</p>

<h3>4. Multi-Cloud and Hybrid Strategies</h3>
<p>Organizations are adopting multi-cloud approaches to avoid vendor lock-in and optimize costs across different cloud providers.</p>

<h3>5. Enhanced Security Focus</h3>
<p>Zero-trust security models and advanced threat detection are becoming standard in cloud environments.</p>

<p>Ready to master these cloud computing trends? Join our comprehensive Cloud Computing & DevOps Certification program and stay ahead of the curve.</p>',
    'R-CAT Team',
    'Technology',
    'cloud computing, trends, 2024, serverless, edge computing, AI, multi-cloud',
    '/assets/images/blog/cloud-trends-2024.jpg',
    'published',
    TRUE
),
(
    'Why Artificial Intelligence is the Career of the Future',
    'ai-career-future',
    'Explore why AI is considered the career of the future and how you can prepare yourself for lucrative opportunities in this rapidly growing field.',
    '<p>Artificial Intelligence is no longer a concept of the future – it is the present reality that is transforming every industry. From healthcare to finance, education to entertainment, AI is creating unprecedented opportunities for skilled professionals.</p>

<h3>The AI Job Market Explosion</h3>
<p>According to recent industry reports, AI-related jobs are growing at an unprecedented rate. Companies are desperately seeking skilled AI professionals, with salaries reaching new heights.</p>

<h3>Key AI Career Paths</h3>
<ul>
<li><strong>Machine Learning Engineer:</strong> Design and implement ML algorithms and systems</li>
<li><strong>Data Scientist:</strong> Extract insights from complex datasets using AI techniques</li>
<li><strong>AI Research Scientist:</strong> Develop new AI methodologies and technologies</li>
<li><strong>Computer Vision Engineer:</strong> Create systems that can interpret visual information</li>
<li><strong>NLP Engineer:</strong> Build systems that understand and process human language</li>
</ul>

<h3>Skills in High Demand</h3>
<p>The most sought-after AI skills include Python programming, machine learning frameworks like TensorFlow and PyTorch, deep learning, and statistical analysis.</p>

<h3>Getting Started with AI</h3>
<p>The best way to enter the AI field is through structured learning and hands-on practice. Our AI & Machine Learning Certification program provides the perfect foundation for your AI career.</p>

<p>Do not miss out on the AI revolution. Start your journey with R-CAT Rajasthan today!</p>',
    'Dr. Rajesh Sharma',
    'Career Guidance',
    'artificial intelligence, AI career, machine learning, data science, future jobs',
    '/assets/images/blog/ai-career-future.jpg',
    'published',
    TRUE
),
(
    'Cybersecurity Threats in 2024: How to Protect Your Organization',
    'cybersecurity-threats-2024',
    'Learn about the latest cybersecurity threats emerging in 2024 and discover effective strategies to protect your organization from cyber attacks.',
    '<p>The cybersecurity landscape is constantly evolving, with new threats emerging daily. In 2024, organizations face more sophisticated attacks than ever before. Understanding these threats and implementing proper security measures is crucial for business survival.</p>

<h3>Top Cybersecurity Threats in 2024</h3>

<h4>1. AI-Powered Attacks</h4>
<p>Cybercriminals are leveraging artificial intelligence to create more sophisticated and targeted attacks, including deepfake scams and AI-generated phishing emails.</p>

<h4>2. Ransomware Evolution</h4>
<p>Ransomware attacks have become more targeted and destructive, with attackers focusing on critical infrastructure and high-value targets.</p>

<h4>3. Supply Chain Attacks</h4>
<p>Attackers are targeting software supply chains to compromise multiple organizations through a single point of entry.</p>

<h4>4. Cloud Security Challenges</h4>
<p>As organizations migrate to cloud environments, misconfigurations and inadequate security controls create new vulnerabilities.</p>

<h3>Protection Strategies</h3>
<ul>
<li>Implement Zero Trust Architecture</li>
<li>Regular security training for employees</li>
<li>Advanced threat detection and response systems</li>
<li>Regular security audits and penetration testing</li>
<li>Robust backup and disaster recovery plans</li>
</ul>

<h3>Building Security Skills</h3>
<p>To effectively combat these threats, organizations need skilled cybersecurity professionals. Our Cybersecurity & Ethical Hacking certification program prepares you to defend against modern cyber threats.</p>

<p>Protect your career and your organization. Enroll in our cybersecurity program today!</p>',
    'Cyber Security Expert',
    'Security',
    'cybersecurity, threats, 2024, ransomware, security, protection, ethical hacking',
    '/assets/images/blog/cybersecurity-threats-2024.jpg',
    'published',
    FALSE
),
(
    'Digital Marketing Success Stories: How R-CAT Students Are Thriving',
    'digital-marketing-success-stories',
    'Read inspiring success stories of R-CAT students who have transformed their careers through our digital marketing program.',
    '<p>At R-CAT Rajasthan, we take pride in the success of our students. Our Digital Marketing & SEO program has helped numerous professionals and entrepreneurs achieve their career goals. Here are some inspiring success stories from our alumni.</p>

<h3>Priya Sharma - From Homemaker to Digital Marketing Entrepreneur</h3>
<p>Priya joined our digital marketing program with no prior experience. Today, she runs her own digital marketing agency with 15+ clients across Rajasthan. Her journey from homemaker to successful entrepreneur is truly inspiring.</p>

<blockquote>
<p>"R-CAT not only taught me digital marketing skills but also gave me the confidence to start my own business. The practical training and industry connections made all the difference."</p>
<cite>- Priya Sharma, Digital Marketing Entrepreneur</cite>
</blockquote>

<h3>Rajesh Kumar - Career Transformation at 35</h3>
<p>Rajesh was working in a traditional sales role when he decided to upskill. After completing our digital marketing program, he landed a Digital Marketing Manager position at a leading e-commerce company with a 150% salary increase.</p>

<h3>Neha Gupta - Freelancing Success</h3>
<p>Neha wanted flexible work options while raising her children. Our digital marketing program equipped her with skills to become a successful freelancer, earning ₹50,000+ per month working from home.</p>

<h3>Success Factors</h3>
<ul>
<li>Hands-on practical training with real campaigns</li>
<li>Industry-relevant curriculum updated regularly</li>
<li>Dedicated placement assistance</li>
<li>Continuous mentorship and support</li>
<li>Strong industry connections</li>
</ul>

<h3>Your Success Story Awaits</h3>
<p>These success stories could be yours. Our Digital Marketing & SEO program is designed to provide you with the skills and support needed to thrive in the digital marketing industry.</p>

<p>Ready to write your own success story? Join R-CAT Rajasthan today!</p>',
    'Career Counselor',
    'Success Stories',
    'digital marketing, success stories, career transformation, R-CAT alumni, SEO',
    '/assets/images/blog/success-stories.jpg',
    'published',
    FALSE
);

-- Insert some sample admissions/inquiries
INSERT INTO admissions (name, email, phone, course_interested, qualification, experience, message, status) VALUES 
('Priya Sharma', 'priya.sharma@email.com', '+91 98765 43210', 'Digital Marketing & SEO', 'Graduate', '2 years', 'Interested in digital marketing course. Please provide more details.', 'pending'),
('Rajesh Kumar', 'rajesh.kumar@email.com', '+91 87654 32109', 'Cloud Computing & DevOps', 'B.Tech', '3 years', 'Looking to upskill in cloud technologies. When is the next batch?', 'contacted'),
('Neha Gupta', 'neha.gupta@email.com', '+91 76543 21098', 'AI & Machine Learning', 'MCA', '1 year', 'Want to transition to AI field. Need career guidance.', 'pending'),
('Amit Singh', 'amit.singh@email.com', '+91 65432 10987', 'Cybersecurity & Ethical Hacking', 'BSc IT', '0 years', 'Fresh graduate interested in cybersecurity. Please call me.', 'pending'),
('Sunita Yadav', 'sunita.yadav@email.com', '+91 54321 09876', 'Data Science & Analytics', 'MBA', '5 years', 'Working professional looking for weekend batches.', 'contacted');

-- Insert newsletter subscribers
INSERT INTO newsletter_subscribers (email, name, status) VALUES 
('john@example.com', 'John Doe', 'active'),
('jane@example.com', 'Jane Smith', 'active'),
('priya@example.com', 'Priya Sharma', 'active'),
('rajesh@example.com', 'Rajesh Kumar', 'active'),
('neha@example.com', 'Neha Gupta', 'active'),le: users (Admin users)
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'editor', 'viewer') DEFAULT 'admin',
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    last_login TIMESTAMP NULL
);

-- Table: courses
CREATE TABLE IF NOT EXISTS courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    slug VARCHAR(200) UNIQUE NOT NULL,
    description TEXT,
    overview TEXT,
    duration VARCHAR(50),
    fee VARCHAR(50),
    level VARCHAR(50),
    certification VARCHAR(200),
    partner VARCHAR(100),
    image_url VARCHAR(500),
    curriculum JSON,
    features JSON,
    eligibility JSON,
    career_opportunities JSON,
    keywords VARCHAR(500),
    is_active BOOLEAN DEFAULT TRUE,
    is_featured BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_slug (slug),
    INDEX idx_active (is_active),
    INDEX idx_featured (is_featured)
);

-- Table: blog_posts
CREATE TABLE IF NOT EXISTS blog_posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    slug VARCHAR(200) UNIQUE NOT NULL,
    content TEXT,
    excerpt TEXT,
    author VARCHAR(100),
    category VARCHAR(100),
    tags VARCHAR(500),
    featured_image VARCHAR(500),
    status ENUM('draft', 'published', 'archived') DEFAULT 'draft',
    is_featured BOOLEAN DEFAULT FALSE,
    views INT DEFAULT 0,
    keywords VARCHAR(500),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_slug (slug),
    INDEX idx_status (status),
    INDEX idx_category (category),
    INDEX idx_featured (is_featured)
);

-- Table: newsletter_subscribers
CREATE TABLE IF NOT EXISTS newsletter_subscribers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) UNIQUE NOT NULL,
    name VARCHAR(100),
    status ENUM('active', 'inactive', 'unsubscribed') DEFAULT 'active',
    subscribed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    unsubscribed_at TIMESTAMP NULL,
    INDEX idx_email (email),
    INDEX idx_status (status)
);

-- Table: admissions
CREATE TABLE IF NOT EXISTS admissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    course_id INT,
    qualification VARCHAR(100),
    experience VARCHAR(100),
    message TEXT,
    status ENUM('pending', 'contacted', 'enrolled', 'rejected') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE SET NULL,
    INDEX idx_status (status),
    INDEX idx_course (course_id)
);

-- Table: site_settings
CREATE TABLE IF NOT EXISTS site_settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(100) UNIQUE NOT NULL,
    setting_value TEXT,
    setting_type ENUM('text', 'number', 'boolean', 'json') DEFAULT 'text',
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_key (setting_key)
);

-- Insert default admin user
INSERT INTO users (username, email, password, role) VALUES 
('admin', 'admin@rcatrajasthan.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin')
ON DUPLICATE KEY UPDATE username = username;

-- Insert comprehensive courses for R-CAT Rajasthan
INSERT INTO courses (title, slug, description, overview, duration, fee, level, certification, partner, image_url, curriculum, features, eligibility, career_opportunities, keywords, is_active, is_featured) VALUES 
(
    'Cloud Computing & DevOps Certification',
    'cloud-computing-devops',
    'Master cloud technologies with AWS, Azure, and Google Cloud Platform. Learn DevOps practices, containerization, and modern deployment strategies.',
    'This comprehensive cloud computing and DevOps certification program is designed to meet the growing industry demand for cloud professionals. You will gain hands-on experience with major cloud platforms, learn to implement CI/CD pipelines, and master containerization technologies like Docker and Kubernetes. The program covers infrastructure as code, monitoring, and security best practices.',
    '6 months',
    '₹35,000',
    'Beginner to Advanced',
    'R-CAT Certified Cloud & DevOps Professional',
    'Amazon Web Services & Microsoft Azure',
    '/assets/images/courses/cloud-computing.jpg',
    '["Cloud Computing Fundamentals", "Amazon Web Services (AWS)", "Microsoft Azure Platform", "Google Cloud Platform", "DevOps Methodology", "Docker & Containerization", "Kubernetes Orchestration", "CI/CD Pipelines", "Infrastructure as Code", "Cloud Security & Compliance", "Monitoring & Logging", "Cost Optimization"]',
    '["Live cloud lab environment access", "Industry-recognized certifications", "Real-world project assignments", "Expert instructors from top companies", "Job placement assistance", "Lifetime access to learning resources", "Monthly industry webinars", "Peer networking opportunities"]',
    '["Graduate in Engineering/Science/IT", "Basic understanding of Linux/Windows", "Networking fundamentals knowledge", "Passion for technology and learning"]',
    '["Cloud Solutions Architect", "DevOps Engineer", "Cloud Engineer", "Site Reliability Engineer", "Infrastructure Engineer", "Cloud Security Specialist", "Platform Engineer", "Cloud Consultant"]',
    'cloud computing, AWS, Azure, DevOps, Docker, Kubernetes, R-CAT Rajasthan',
    TRUE,
    TRUE
),
(
    'Artificial Intelligence & Machine Learning',
    'ai-machine-learning',
    'Comprehensive AI/ML program covering deep learning, neural networks, computer vision, and NLP. Build intelligent systems and predictive models.',
    'This cutting-edge AI and Machine Learning program prepares you for the future of technology. Learn from industry experts and work on real-world projects involving predictive analytics, computer vision, natural language processing, and deep learning. The course includes hands-on experience with TensorFlow, PyTorch, and cloud-based ML platforms.',
    '8 months',
    '₹45,000',
    'Intermediate to Advanced',
    'R-CAT Certified AI/ML Professional',
    'Google AI & NVIDIA',
    '/assets/images/courses/ai-ml.jpg',
    '["Introduction to AI & ML", "Python for Data Science", "Statistics & Probability", "Machine Learning Algorithms", "Deep Learning & Neural Networks", "Computer Vision", "Natural Language Processing", "Reinforcement Learning", "MLOps & Model Deployment", "AI Ethics & Responsible AI", "Industry Applications", "Capstone Project"]',
    '["Access to GPU-powered cloud platforms", "Real-world industry projects", "Mentorship from AI professionals", "Portfolio development guidance", "Research paper writing support", "Industry collaboration opportunities", "Job placement assistance", "Continuous learning resources"]',
    '["Bachelor\'s degree in Engineering/Science/Mathematics", "Programming experience in Python", "Strong mathematical and statistical foundation", "Analytical thinking and problem-solving skills"]',
    '["Machine Learning Engineer", "Data Scientist", "AI Research Scientist", "Deep Learning Engineer", "Computer Vision Engineer", "NLP Engineer", "AI Product Manager", "Data Engineer"]',
    'artificial intelligence, machine learning, deep learning, neural networks, Python, TensorFlow, PyTorch, R-CAT',
    TRUE,
    TRUE
),
(
    'Cybersecurity & Ethical Hacking',
    'cybersecurity-ethical-hacking',
    'Advanced cybersecurity program covering ethical hacking, penetration testing, network security, and incident response. Protect organizations from cyber threats.',
    'This comprehensive cybersecurity program addresses the critical need for skilled security professionals. Learn ethical hacking techniques, penetration testing methodologies, and security frameworks. Gain hands-on experience with security tools and learn to protect organizations from evolving cyber threats.',
    '7 months',
    '₹40,000',
    'Beginner to Advanced',
    'R-CAT Certified Cybersecurity Professional',
    'EC-Council & CompTIA',
    '/assets/images/courses/cybersecurity.jpg',
    '["Information Security Fundamentals", "Network Security", "Ethical Hacking Techniques", "Penetration Testing", "Web Application Security", "Mobile Security", "Cloud Security", "Incident Response", "Digital Forensics", "Security Compliance", "Risk Management", "Security Operations Center"]',
    '["Virtual penetration testing labs", "Industry-standard security tools", "Hands-on ethical hacking exercises", "Real-world security scenarios", "Certification exam preparation", "Career guidance and mentorship", "Industry networking events", "Job placement support"]',
    '["Graduate in any discipline", "Basic understanding of networking", "Interest in security and technology", "Analytical and problem-solving mindset"]',
    '["Cybersecurity Analyst", "Ethical Hacker", "Penetration Tester", "Security Consultant", "Incident Response Specialist", "Security Architect", "CISO", "Security Engineer"]',
    'cybersecurity, ethical hacking, penetration testing, network security, information security, R-CAT',
    TRUE,
    TRUE
),
(
    'Data Science & Analytics',
    'data-science-analytics',
    'Master data science techniques, statistical analysis, and business intelligence. Transform raw data into actionable insights using Python, R, and modern analytics tools.',
    'This comprehensive data science program equips you with the skills to extract meaningful insights from complex datasets. Learn statistical analysis, data visualization, and predictive modeling techniques. Work with real-world datasets and build a strong foundation in data-driven decision making.',
    '6 months',
    '₹38,000',
    'Beginner to Intermediate',
    'R-CAT Certified Data Science Professional',
    'IBM & Tableau',
    '/assets/images/courses/data-science.jpg',
    '["Data Science Fundamentals", "Python/R Programming", "Statistics & Probability", "Data Wrangling & Cleaning", "Exploratory Data Analysis", "Data Visualization", "Machine Learning for Data Science", "Big Data Technologies", "Business Intelligence", "SQL & Database Management", "Statistical Modeling", "Capstone Project"]',
    '["Access to enterprise analytics tools", "Real business case studies", "Industry mentor guidance", "Portfolio project development", "Internship opportunities", "Job placement assistance", "Certification preparation", "Continuous skill updates"]',
    '["Graduate in any discipline", "Basic mathematics and statistics", "Analytical thinking ability", "Interest in data and technology"]',
    '["Data Scientist", "Data Analyst", "Business Intelligence Analyst", "Research Analyst", "Data Engineer", "Analytics Consultant", "Product Analyst", "Market Research Analyst"]',
    'data science, analytics, Python, R, statistics, machine learning, business intelligence, R-CAT',
    TRUE,
    TRUE
),
(
    'Full Stack Web Development',
    'full-stack-web-development',
    'Complete web development program covering frontend, backend, and database technologies. Build modern web applications using React, Node.js, and cloud deployment.',
    'This full-stack web development program provides comprehensive training in modern web technologies. Learn to build responsive frontend interfaces, develop robust backend APIs, and deploy scalable web applications. Gain expertise in React, Node.js, databases, and cloud deployment strategies.',
    '7 months',
    '₹32,000',
    'Beginner to Intermediate',
    'R-CAT Certified Full Stack Developer',
    'Meta & Google',
    '/assets/images/courses/web-development.jpg',
    '["HTML5, CSS3 & JavaScript", "React.js & Frontend Frameworks", "Node.js & Express.js", "Database Design & Management", "RESTful API Development", "MongoDB & SQL Databases", "Authentication & Security", "Version Control with Git", "Cloud Deployment", "DevOps for Developers", "Testing & Debugging", "Portfolio Development"]',
    '["Live coding sessions", "Real-world project development", "Industry standard development tools", "Code review and feedback", "Portfolio website creation", "Internship opportunities", "Job placement support", "Continuous learning resources"]',
    '["12th pass or equivalent", "Basic computer knowledge", "Logical thinking ability", "Passion for web development"]',
    '["Full Stack Developer", "Frontend Developer", "Backend Developer", "Web Developer", "JavaScript Developer", "React Developer", "Node.js Developer", "Software Engineer"]',
    'full stack development, React, Node.js, JavaScript, web development, frontend, backend, R-CAT',
    TRUE,
    TRUE
),
(
    'Digital Marketing & SEO',
    'digital-marketing-seo',
    'Comprehensive digital marketing course covering SEO, social media marketing, content marketing, and paid advertising. Build your digital marketing expertise.',
    'Master the art of digital marketing with this comprehensive program. Learn search engine optimization, social media marketing strategies, content creation, and paid advertising techniques. Develop skills to drive online growth and build successful digital marketing campaigns.',
    '4 months',
    '₹25,000',
    'Beginner to Intermediate',
    'R-CAT Certified Digital Marketing Professional',
    'Google & Facebook',
    '/assets/images/courses/digital-marketing.jpg',
    '["Digital Marketing Fundamentals", "Search Engine Optimization (SEO)", "Google Ads & PPC", "Social Media Marketing", "Content Marketing", "Email Marketing", "Analytics & Reporting", "Affiliate Marketing", "E-commerce Marketing", "Mobile Marketing", "Marketing Automation", "Brand Management"]',
    '["Live campaign management", "Real client projects", "Industry tool access", "Certification preparation", "Portfolio development", "Freelancing guidance", "Job placement assistance", "Continuous market updates"]',
    '["Graduate in any discipline", "Basic computer and internet knowledge", "Creative thinking ability", "Interest in marketing and branding"]',
    '["Digital Marketing Manager", "SEO Specialist", "Social Media Manager", "Content Marketing Manager", "PPC Specialist", "Marketing Analyst", "Brand Manager", "Digital Marketing Consultant"]',
    'digital marketing, SEO, social media marketing, Google Ads, content marketing, online marketing, R-CAT',
    TRUE,
    TRUE
)
ON DUPLICATE KEY UPDATE slug = slug;

-- Insert sample blog posts
INSERT INTO blog_posts (title, slug, content, excerpt, author, category, tags, status, is_featured, keywords) VALUES 
(
    'Top 5 Highest Paying Tech Skills in 2025',
    'top-5-highest-paying-tech-skills-2025',
    'The technology landscape is evolving rapidly, and certain skills command premium salaries...',
    'Discover the most lucrative technology skills that are in high demand in 2025.',
    'R-CAT Team',
    'Career Guidance',
    'technology, careers, skills, salary, 2025',
    'published',
    TRUE,
    'tech skills, high paying jobs, technology careers, 2025'
),
(
    'Why Choose R-CAT for Your Career Growth',
    'why-choose-rcat-career-growth',
    'R-CAT Rajasthan has been at the forefront of technology education...',
    'Learn why R-CAT is the best choice for advancing your technology career.',
    'R-CAT Team',
    'About R-CAT',
    'R-CAT, career growth, technology education',
    'published',
    FALSE,
    'R-CAT, career growth, technology education, Rajasthan'
),
(
    'Cloud Computing Trends to Watch in 2025',
    'cloud-computing-trends-2025',
    'Cloud computing continues to revolutionize how businesses operate...',
    'Stay ahead of the curve with these emerging cloud computing trends.',
    'R-CAT Team',
    'Industry Trends',
    'cloud computing, trends, 2025, technology',
    'published',
    FALSE,
    'cloud computing, trends, 2025, AWS, Azure, technology'
)
ON DUPLICATE KEY UPDATE slug = slug;

-- Insert sample newsletter subscribers
INSERT INTO newsletter_subscribers (email, name, status) VALUES 
('john@example.com', 'John Doe', 'active'),
('jane@example.com', 'Jane Smith', 'active'),
('bob@example.com', 'Bob Johnson', 'active')
ON DUPLICATE KEY UPDATE email = email;

-- Insert site settings
INSERT INTO site_settings (setting_key, setting_value, setting_type, description) VALUES 
('site_name', 'R-CAT Rajasthan', 'text', 'Website name'),
('site_description', 'Fast & Easy Guide to R-CAT Rajasthan Courses', 'text', 'Website description'),
('contact_email', 'info@rcatrajasthan.com', 'text', 'Contact email address'),
('contact_phone', '+91 98765 43210', 'text', 'Contact phone number'),
('google_analytics_id', 'G-XXXXXXXXXX', 'text', 'Google Analytics tracking ID'),
('maintenance_mode', 'false', 'boolean', 'Enable maintenance mode')
ON DUPLICATE KEY UPDATE setting_key = setting_key;

-- Create indexes for performance
CREATE INDEX IF NOT EXISTS idx_courses_active_featured ON courses(is_active, is_featured);
CREATE INDEX IF NOT EXISTS idx_blog_posts_status_featured ON blog_posts(status, is_featured);
CREATE INDEX IF NOT EXISTS idx_admissions_status_created ON admissions(status, created_at);

-- Display success message
SELECT 'Database setup completed successfully!' AS message;
