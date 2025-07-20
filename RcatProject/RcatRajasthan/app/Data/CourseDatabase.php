<?php
/**
 * R-CAT Rajasthan Course Database
 * Comprehensive course information for content population
 */

class CourseDatabase {
    
    public static function getAllCourses() {
        return [
            // Cloud Computing Courses
            'aws-solutions-architect' => [
                'id' => 1,
                'title' => 'AWS Solutions Architect Professional',
                'slug' => 'aws-solutions-architect',
                'category' => 'Cloud Computing',
                'category_slug' => 'cloud-computing',
                'short_description' => 'Master Amazon Web Services and become a certified AWS Solutions Architect with hands-on experience in cloud infrastructure design.',
                'duration' => '6 months',
                'fees' => '₹85,000',
                'batch_timing' => 'Morning (9 AM - 12 PM) | Evening (6 PM - 9 PM)',
                'partnership' => 'Amazon Web Services (AWS)',
                'certification' => 'AWS Solutions Architect - Professional',
                'career_prospects' => '₹8-15 LPA starting salary',
                'eligibility' => 'Basic computer knowledge, Any graduation background',
                'image' => '/assets/images/courses/aws-solutions-architect.jpg',
                'featured' => true,
                'curriculum' => [
                    'Module 1: AWS Fundamentals' => [
                        'Introduction to Cloud Computing',
                        'AWS Global Infrastructure',
                        'AWS Management Console',
                        'AWS CLI and SDK Setup',
                        'Identity and Access Management (IAM)'
                    ],
                    'Module 2: Core AWS Services' => [
                        'Amazon EC2 - Elastic Compute Cloud',
                        'Amazon S3 - Simple Storage Service',
                        'Amazon VPC - Virtual Private Cloud',
                        'Amazon RDS - Relational Database Service',
                        'Amazon Route 53 - DNS Service'
                    ],
                    'Module 3: Advanced Services' => [
                        'AWS Lambda - Serverless Computing',
                        'Amazon CloudFront - CDN',
                        'AWS CloudFormation - Infrastructure as Code',
                        'Amazon ECS/EKS - Container Services',
                        'AWS API Gateway'
                    ],
                    'Module 4: Security & Monitoring' => [
                        'AWS CloudWatch - Monitoring',
                        'AWS CloudTrail - Auditing',
                        'AWS Security Best Practices',
                        'AWS Config - Compliance',
                        'AWS Systems Manager'
                    ],
                    'Module 5: Architecture Design' => [
                        'Well-Architected Framework',
                        'High Availability and Fault Tolerance',
                        'Disaster Recovery Strategies',
                        'Cost Optimization Techniques',
                        'Performance Optimization'
                    ],
                    'Module 6: Hands-on Projects' => [
                        'Build a 3-Tier Web Application',
                        'Implement Auto Scaling Solutions',
                        'Design Multi-Region Architecture',
                        'Create CI/CD Pipeline with AWS',
                        'Capstone Project - Real-world Scenario'
                    ]
                ],
                'projects' => [
                    'E-commerce Website on AWS with Auto Scaling',
                    'Data Analytics Pipeline using AWS Services',
                    'Serverless Blog Application with Lambda',
                    'Multi-Region Disaster Recovery Setup',
                    'Enterprise Security Implementation'
                ],
                'placement_stats' => [
                    'placement_rate' => '92%',
                    'average_salary' => '₹12 LPA',
                    'top_companies' => ['TCS', 'Infosys', 'Wipro', 'Accenture', 'Cognizant', 'HCL']
                ],
                'testimonials' => [
                    [
                        'name' => 'Priya Sharma',
                        'position' => 'Cloud Engineer at TCS',
                        'image' => '/assets/images/testimonials/priya-sharma.jpg',
                        'text' => 'The AWS course at R-CAT changed my career completely. From a non-tech background to landing a ₹14 LPA job in just 8 months!'
                    ],
                    [
                        'name' => 'Rahul Agarwal',
                        'position' => 'Solutions Architect at Infosys',
                        'image' => '/assets/images/testimonials/rahul-agarwal.jpg',
                        'text' => 'Excellent hands-on training with real-world projects. The instructors are industry experts who provide practical knowledge.'
                    ]
                ]
            ],
            
            'google-cloud-professional' => [
                'id' => 2,
                'title' => 'Google Cloud Professional Architect',
                'slug' => 'google-cloud-professional',
                'category' => 'Cloud Computing',
                'category_slug' => 'cloud-computing',
                'short_description' => 'Become a Google Cloud Professional with comprehensive training in GCP services, architecture design, and cloud migration strategies.',
                'duration' => '4 months',
                'fees' => '₹75,000',
                'batch_timing' => 'Morning (10 AM - 1 PM) | Evening (7 PM - 10 PM)',
                'partnership' => 'Google Cloud Platform',
                'certification' => 'Google Cloud Professional Cloud Architect',
                'career_prospects' => '₹10-18 LPA starting salary',
                'eligibility' => 'Basic programming knowledge, Any graduation',
                'image' => '/assets/images/courses/google-cloud-professional.jpg',
                'featured' => true,
                'curriculum' => [
                    'Module 1: GCP Fundamentals' => [
                        'Google Cloud Platform Overview',
                        'GCP Console and gcloud CLI',
                        'Identity and Access Management',
                        'Resource Hierarchy and Organization',
                        'Billing and Cost Management'
                    ],
                    'Module 2: Compute Services' => [
                        'Compute Engine - Virtual Machines',
                        'App Engine - Platform as a Service',
                        'Google Kubernetes Engine (GKE)',
                        'Cloud Functions - Serverless',
                        'Cloud Run - Containerized Applications'
                    ],
                    'Module 3: Storage and Database' => [
                        'Cloud Storage - Object Storage',
                        'Cloud SQL - Relational Database',
                        'Cloud Spanner - Global Database',
                        'Firestore - NoSQL Database',
                        'BigQuery - Data Warehouse'
                    ],
                    'Module 4: Networking and Security' => [
                        'Virtual Private Cloud (VPC)',
                        'Cloud Load Balancing',
                        'Cloud CDN and DNS',
                        'Cloud Security Best Practices',
                        'Cloud IAM Advanced Features'
                    ]
                ],
                'projects' => [
                    'Microservices Application on GKE',
                    'Real-time Data Processing with BigQuery',
                    'Serverless Web Application',
                    'Multi-Region Deployment Strategy'
                ],
                'placement_stats' => [
                    'placement_rate' => '89%',
                    'average_salary' => '₹14 LPA',
                    'top_companies' => ['Google', 'Wipro', 'Tech Mahindra', 'Capgemini', 'LTI']
                ]
            ],
            
            'microsoft-azure-fundamentals' => [
                'id' => 3,
                'title' => 'Microsoft Azure Solutions Architect',
                'slug' => 'microsoft-azure-fundamentals',
                'category' => 'Cloud Computing',
                'category_slug' => 'cloud-computing',
                'short_description' => 'Master Microsoft Azure cloud platform with comprehensive training in Azure services, architecture, and enterprise solutions.',
                'duration' => '5 months',
                'fees' => '₹80,000',
                'batch_timing' => 'Morning (9 AM - 12 PM) | Weekend (Sat-Sun 9 AM - 5 PM)',
                'partnership' => 'Microsoft Azure',
                'certification' => 'Azure Solutions Architect Expert',
                'career_prospects' => '₹9-16 LPA starting salary',
                'eligibility' => 'Basic IT knowledge, Any graduation background',
                'image' => '/assets/images/courses/microsoft-azure.jpg',
                'featured' => true,
                'curriculum' => [
                    'Module 1: Azure Fundamentals' => [
                        'Microsoft Azure Overview',
                        'Azure Portal and PowerShell',
                        'Azure Active Directory',
                        'Resource Groups and Management',
                        'Azure Subscription Management'
                    ],
                    'Module 2: Compute and Storage' => [
                        'Azure Virtual Machines',
                        'Azure App Service',
                        'Azure Container Instances',
                        'Azure Storage Accounts',
                        'Azure Blob Storage'
                    ],
                    'Module 3: Networking and Database' => [
                        'Azure Virtual Networks',
                        'Azure Load Balancer',
                        'Azure SQL Database',
                        'Azure Cosmos DB',
                        'Azure Traffic Manager'
                    ],
                    'Module 4: Advanced Services' => [
                        'Azure Functions',
                        'Azure Logic Apps',
                        'Azure DevOps Services',
                        'Azure Monitor and Security',
                        'Azure Backup and Recovery'
                    ]
                ],
                'projects' => [
                    'Enterprise Web Application on Azure',
                    'Azure DevOps CI/CD Pipeline',
                    'Hybrid Cloud Implementation',
                    'Azure Security Center Configuration'
                ],
                'placement_stats' => [
                    'placement_rate' => '87%',
                    'average_salary' => '₹13 LPA',
                    'top_companies' => ['Microsoft', 'Accenture', 'Deloitte', 'IBM', 'Cognizant']
                ]
            ],
            
            // Cybersecurity Courses
            'ethical-hacking-penetration-testing' => [
                'id' => 4,
                'title' => 'Ethical Hacking & Penetration Testing',
                'slug' => 'ethical-hacking-penetration-testing',
                'category' => 'Cybersecurity',
                'category_slug' => 'cybersecurity',
                'short_description' => 'Become a certified ethical hacker with comprehensive training in penetration testing, vulnerability assessment, and cybersecurity.',
                'duration' => '8 months',
                'fees' => '₹95,000',
                'batch_timing' => 'Evening (6 PM - 9 PM) | Weekend (Sat-Sun 9 AM - 6 PM)',
                'partnership' => 'EC-Council',
                'certification' => 'CEH (Certified Ethical Hacker)',
                'career_prospects' => '₹12-20 LPA starting salary',
                'eligibility' => 'Basic networking knowledge, Any IT background',
                'image' => '/assets/images/courses/ethical-hacking.jpg',
                'featured' => true,
                'curriculum' => [
                    'Module 1: Cybersecurity Fundamentals' => [
                        'Introduction to Ethical Hacking',
                        'Information Security Overview',
                        'Legal and Ethical Aspects',
                        'Cybersecurity Frameworks',
                        'Risk Assessment Methodologies'
                    ],
                    'Module 2: Reconnaissance and Scanning' => [
                        'Footprinting and Reconnaissance',
                        'Network Scanning Techniques',
                        'Vulnerability Assessment',
                        'Social Engineering Attacks',
                        'OSINT (Open Source Intelligence)'
                    ],
                    'Module 3: System Hacking' => [
                        'Password Attacks',
                        'Privilege Escalation',
                        'Malware and Trojans',
                        'Backdoors and Rootkits',
                        'Buffer Overflow Attacks'
                    ],
                    'Module 4: Network Security' => [
                        'Sniffing and Spoofing',
                        'Session Hijacking',
                        'Denial of Service Attacks',
                        'Firewall and IDS Evasion',
                        'Wireless Network Security'
                    ],
                    'Module 5: Web Application Security' => [
                        'Web Application Vulnerabilities',
                        'SQL Injection Attacks',
                        'Cross-Site Scripting (XSS)',
                        'OWASP Top 10 Vulnerabilities',
                        'Web Application Testing Tools'
                    ],
                    'Module 6: Advanced Topics' => [
                        'Mobile Platform Security',
                        'Cloud Security Assessment',
                        'Incident Response and Forensics',
                        'Security Report Writing',
                        'Compliance and Audit'
                    ]
                ],
                'projects' => [
                    'Complete Penetration Testing of Web Application',
                    'Network Security Assessment Project',
                    'Mobile Application Security Testing',
                    'Incident Response Simulation',
                    'Vulnerability Assessment Report'
                ],
                'placement_stats' => [
                    'placement_rate' => '94%',
                    'average_salary' => '₹16 LPA',
                    'top_companies' => ['Cyberark', 'Quick Heal', 'Wipro Cybersecurity', 'IBM Security', 'Deloitte Cyber']
                ]
            ],
            
            // Data Science & AI/ML Courses
            'python-data-science' => [
                'id' => 5,
                'title' => 'Python for Data Science & Machine Learning',
                'slug' => 'python-data-science',
                'category' => 'Data Science',
                'category_slug' => 'data-science',
                'short_description' => 'Master Python programming for data science with hands-on experience in machine learning, data analysis, and AI applications.',
                'duration' => '7 months',
                'fees' => '₹90,000',
                'batch_timing' => 'Morning (9 AM - 12 PM) | Evening (6 PM - 9 PM)',
                'partnership' => 'IBM Data Science',
                'certification' => 'IBM Data Science Professional Certificate',
                'career_prospects' => '₹10-18 LPA starting salary',
                'eligibility' => 'Basic mathematics, Any graduation background',
                'image' => '/assets/images/courses/python-data-science.jpg',
                'featured' => true,
                'curriculum' => [
                    'Module 1: Python Programming Fundamentals' => [
                        'Python Syntax and Data Types',
                        'Control Structures and Functions',
                        'Object-Oriented Programming',
                        'File Handling and Exception Management',
                        'Python Libraries Overview'
                    ],
                    'Module 2: Data Manipulation and Analysis' => [
                        'NumPy for Numerical Computing',
                        'Pandas for Data Manipulation',
                        'Data Cleaning and Preprocessing',
                        'Exploratory Data Analysis (EDA)',
                        'Statistical Analysis with Python'
                    ],
                    'Module 3: Data Visualization' => [
                        'Matplotlib for Basic Plotting',
                        'Seaborn for Statistical Visualization',
                        'Plotly for Interactive Dashboards',
                        'Advanced Visualization Techniques',
                        'Dashboard Creation with Streamlit'
                    ],
                    'Module 4: Machine Learning' => [
                        'Introduction to Machine Learning',
                        'Supervised Learning Algorithms',
                        'Unsupervised Learning Techniques',
                        'Model Evaluation and Selection',
                        'Scikit-learn Library Mastery'
                    ],
                    'Module 5: Advanced Machine Learning' => [
                        'Deep Learning with TensorFlow',
                        'Neural Networks and CNN',
                        'Natural Language Processing',
                        'Time Series Analysis',
                        'Model Deployment Strategies'
                    ],
                    'Module 6: Real-world Projects' => [
                        'End-to-End Data Science Projects',
                        'Industry Case Studies',
                        'Portfolio Development',
                        'Capstone Project Presentation',
                        'Interview Preparation'
                    ]
                ],
                'projects' => [
                    'Customer Churn Prediction Model',
                    'Stock Price Prediction using Time Series',
                    'Sentiment Analysis of Social Media Data',
                    'Recommendation System Development',
                    'Computer Vision Application'
                ],
                'placement_stats' => [
                    'placement_rate' => '91%',
                    'average_salary' => '₹14 LPA',
                    'top_companies' => ['Amazon', 'Flipkart', 'Paytm', 'Ola', 'Zomato', 'TCS Innovation Labs']
                ]
            ],
            
            // Software Development Courses
            'full-stack-web-development' => [
                'id' => 6,
                'title' => 'Full Stack Web Development (MERN/MEAN)',
                'slug' => 'full-stack-web-development',
                'category' => 'Software Development',
                'category_slug' => 'software-development',
                'short_description' => 'Become a full stack developer with comprehensive training in modern web technologies including React, Node.js, and database management.',
                'duration' => '8 months',
                'fees' => '₹85,000',
                'batch_timing' => 'Morning (9 AM - 1 PM) | Evening (5 PM - 9 PM)',
                'partnership' => 'Industry Certificate Program',
                'certification' => 'Full Stack Developer Certificate',
                'career_prospects' => '₹8-15 LPA starting salary',
                'eligibility' => 'Basic computer knowledge, Any graduation',
                'image' => '/assets/images/courses/full-stack-development.jpg',
                'featured' => true,
                'curriculum' => [
                    'Module 1: Frontend Fundamentals' => [
                        'HTML5 and Semantic Markup',
                        'CSS3 and Responsive Design',
                        'JavaScript ES6+ Features',
                        'DOM Manipulation and Events',
                        'Version Control with Git/GitHub'
                    ],
                    'Module 2: Frontend Frameworks' => [
                        'React.js Fundamentals',
                        'Component-Based Architecture',
                        'State Management with Redux',
                        'React Router for SPA',
                        'Material-UI and Bootstrap Integration'
                    ],
                    'Module 3: Backend Development' => [
                        'Node.js and NPM Ecosystem',
                        'Express.js Framework',
                        'RESTful API Development',
                        'Authentication and Authorization',
                        'File Upload and Email Integration'
                    ],
                    'Module 4: Database Management' => [
                        'MongoDB Database Design',
                        'Mongoose ODM',
                        'SQL vs NoSQL Databases',
                        'Database Optimization',
                        'Data Modeling Best Practices'
                    ],
                    'Module 5: Advanced Topics' => [
                        'Real-time Applications with Socket.io',
                        'Payment Gateway Integration',
                        'Cloud Deployment (AWS/Heroku)',
                        'Testing and Debugging',
                        'Performance Optimization'
                    ],
                    'Module 6: Industry Projects' => [
                        'E-commerce Website Development',
                        'Social Media Application',
                        'Real-time Chat Application',
                        'Portfolio Website Creation',
                        'Deployment and Production Setup'
                    ]
                ],
                'projects' => [
                    'Full-featured E-commerce Platform',
                    'Social Media Dashboard',
                    'Real-time Collaboration Tool',
                    'Personal Portfolio Website',
                    'Task Management Application'
                ],
                'placement_stats' => [
                    'placement_rate' => '88%',
                    'average_salary' => '₹12 LPA',
                    'top_companies' => ['Infosys', 'TCS Digital', 'Mindtree', 'Nagarro', 'Publicis Sapient']
                ]
            ]
        ];
    }
    
    public static function getCourseBySlug($slug) {
        $courses = self::getAllCourses();
        return isset($courses[$slug]) ? $courses[$slug] : null;
    }
    
    public static function getCoursesByCategory($category_slug) {
        $courses = self::getAllCourses();
        return array_filter($courses, function($course) use ($category_slug) {
            return $course['category_slug'] === $category_slug;
        });
    }
    
    public static function getFeaturedCourses() {
        $courses = self::getAllCourses();
        return array_filter($courses, function($course) {
            return isset($course['featured']) && $course['featured'] === true;
        });
    }
    
    public static function getCourseCategories() {
        return [
            'cloud-computing' => [
                'name' => 'Cloud Computing',
                'slug' => 'cloud-computing',
                'description' => 'Master cloud platforms like AWS, Google Cloud, and Microsoft Azure',
                'icon' => 'bi-cloud',
                'color' => '#007bff'
            ],
            'cybersecurity' => [
                'name' => 'Cybersecurity',
                'slug' => 'cybersecurity', 
                'description' => 'Learn ethical hacking, penetration testing, and security analysis',
                'icon' => 'bi-shield-check',
                'color' => '#dc3545'
            ],
            'data-science' => [
                'name' => 'Data Science',
                'slug' => 'data-science',
                'description' => 'Python, machine learning, AI, and data analytics',
                'icon' => 'bi-graph-up',
                'color' => '#28a745'
            ],
            'software-development' => [
                'name' => 'Software Development',
                'slug' => 'software-development',
                'description' => 'Full stack web development and mobile app development',
                'icon' => 'bi-code-slash',
                'color' => '#17a2b8'
            ]
        ];
    }
}
?>
