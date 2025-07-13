<?php

if (!function_exists('generate_meta_tags')) {
    /**
     * Generate meta tags for SEO
     */
    function generate_meta_tags($title, $description, $keywords = '', $image = '', $url = '') {
        $config = config('App');
        $baseURL = $config->baseURL;
        
        if (empty($url)) {
            $url = current_url();
        }
        
        if (empty($image)) {
            $image = $baseURL . '/assets/images/og-default.jpg';
        }
        
        $html = "\n";
        $html .= "<title>" . esc($title) . "</title>\n";
        $html .= "<meta name=\"description\" content=\"" . esc($description) . "\">\n";
        
        if (!empty($keywords)) {
            $html .= "<meta name=\"keywords\" content=\"" . esc($keywords) . "\">\n";
        }
        
        // Open Graph tags
        $html .= "<meta property=\"og:title\" content=\"" . esc($title) . "\">\n";
        $html .= "<meta property=\"og:description\" content=\"" . esc($description) . "\">\n";
        $html .= "<meta property=\"og:image\" content=\"" . esc($image) . "\">\n";
        $html .= "<meta property=\"og:url\" content=\"" . esc($url) . "\">\n";
        $html .= "<meta property=\"og:type\" content=\"website\">\n";
        $html .= "<meta property=\"og:site_name\" content=\"R-CAT Rajasthan\">\n";
        
        // Twitter Card tags
        $html .= "<meta name=\"twitter:card\" content=\"summary_large_image\">\n";
        $html .= "<meta name=\"twitter:title\" content=\"" . esc($title) . "\">\n";
        $html .= "<meta name=\"twitter:description\" content=\"" . esc($description) . "\">\n";
        $html .= "<meta name=\"twitter:image\" content=\"" . esc($image) . "\">\n";
        
        return $html;
    }
}

if (!function_exists('generate_course_schema')) {
    /**
     * Generate Course schema markup for SEO
     */
    function generate_course_schema($course) {
        $schema = [
            "@context" => "https://schema.org",
            "@type" => "Course",
            "name" => $course['title'],
            "description" => $course['description'],
            "provider" => [
                "@type" => "Organization",
                "name" => "R-CAT Rajasthan",
                "url" => base_url()
            ],
            "offers" => [
                "@type" => "Offer",
                "price" => str_replace('₹', '', $course['fee']),
                "priceCurrency" => "INR",
                "category" => "Educational"
            ],
            "educationalLevel" => $course['level'],
            "timeRequired" => $course['duration'],
            "inLanguage" => "en-IN",
            "availableLanguage" => ["Hindi", "English"],
            "teaches" => json_decode($course['curriculum'] ?? '[]', true),
            "coursePrerequisites" => json_decode($course['eligibility'] ?? '[]', true),
            "occupationalCredentialAwarded" => $course['certification']
        ];
        
        if (!empty($course['image_url'])) {
            $schema['image'] = base_url($course['image_url']);
        }
        
        return '<script type="application/ld+json">' . json_encode($schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . '</script>';
    }
}

if (!function_exists('generate_organization_schema')) {
    /**
     * Generate Organization schema markup
     */
    function generate_organization_schema() {
        $schema = [
            "@context" => "https://schema.org",
            "@type" => "EducationalOrganization",
            "name" => "R-CAT Rajasthan",
            "alternateName" => "Rajiv Gandhi Centre of Advanced Technology",
            "description" => "Leading technology training institute in Rajasthan offering courses in Cloud Computing, AI/ML, Cybersecurity, and more.",
            "url" => base_url(),
            "logo" => base_url('/assets/images/logo.png'),
            "address" => [
                "@type" => "PostalAddress",
                "addressLocality" => "Jaipur",
                "addressRegion" => "Rajasthan",
                "addressCountry" => "IN"
            ],
            "contactPoint" => [
                "@type" => "ContactPoint",
                "telephone" => "+91-98765-43210",
                "contactType" => "customer service",
                "areaServed" => "IN",
                "availableLanguage" => ["English", "Hindi"]
            ],
            "sameAs" => [
                "https://www.facebook.com/rcatrajasthan",
                "https://www.twitter.com/rcatrajasthan",
                "https://www.linkedin.com/company/rcat-rajasthan"
            ],
            "offers" => [
                "@type" => "Service",
                "serviceType" => "Technology Training",
                "areaServed" => "Rajasthan, India"
            ]
        ];
        
        return '<script type="application/ld+json">' . json_encode($schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . '</script>';
    }
}

if (!function_exists('generate_breadcrumb_schema')) {
    /**
     * Generate Breadcrumb schema markup
     */
    function generate_breadcrumb_schema($breadcrumbs) {
        $items = [];
        $position = 1;
        
        foreach ($breadcrumbs as $crumb) {
            $items[] = [
                "@type" => "ListItem",
                "position" => $position,
                "name" => $crumb['name'],
                "item" => $crumb['url']
            ];
            $position++;
        }
        
        $schema = [
            "@context" => "https://schema.org",
            "@type" => "BreadcrumbList",
            "itemListElement" => $items
        ];
        
        return '<script type="application/ld+json">' . json_encode($schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . '</script>';
    }
}

if (!function_exists('generate_faq_schema')) {
    /**
     * Generate FAQ schema markup
     */
    function generate_faq_schema($faqs) {
        $questions = [];
        
        foreach ($faqs as $faq) {
            $questions[] = [
                "@type" => "Question",
                "name" => $faq['question'],
                "acceptedAnswer" => [
                    "@type" => "Answer",
                    "text" => $faq['answer']
                ]
            ];
        }
        
        $schema = [
            "@context" => "https://schema.org",
            "@type" => "FAQPage",
            "mainEntity" => $questions
        ];
        
        return '<script type="application/ld+json">' . json_encode($schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . '</script>';
    }
}

if (!function_exists('generate_sitemap_xml')) {
    /**
     * Generate sitemap XML
     */
    function generate_sitemap_xml() {
        $db = \Config\Database::connect();
        
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        
        // Static pages
        $static_pages = [
            ['url' => '', 'priority' => '1.0', 'changefreq' => 'daily'],
            ['url' => 'about', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => 'courses', 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['url' => 'admission', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => 'blog', 'priority' => '0.7', 'changefreq' => 'daily']
        ];
        
        foreach ($static_pages as $page) {
            $xml .= "  <url>\n";
            $xml .= "    <loc>" . base_url($page['url']) . "</loc>\n";
            $xml .= "    <lastmod>" . date('Y-m-d') . "</lastmod>\n";
            $xml .= "    <changefreq>" . $page['changefreq'] . "</changefreq>\n";
            $xml .= "    <priority>" . $page['priority'] . "</priority>\n";
            $xml .= "  </url>\n";
        }
        
        // Course pages
        $courses = $db->query("SELECT slug, updated_at FROM courses WHERE is_active = 1")->getResultArray();
        foreach ($courses as $course) {
            $xml .= "  <url>\n";
            $xml .= "    <loc>" . base_url("courses/{$course['slug']}") . "</loc>\n";
            $xml .= "    <lastmod>" . date('Y-m-d', strtotime($course['updated_at'])) . "</lastmod>\n";
            $xml .= "    <changefreq>monthly</changefreq>\n";
            $xml .= "    <priority>0.8</priority>\n";
            $xml .= "  </url>\n";
        }
        
        // Blog posts
        $posts = $db->query("SELECT slug, updated_at FROM blog_posts WHERE status = 'published'")->getResultArray();
        foreach ($posts as $post) {
            $xml .= "  <url>\n";
            $xml .= "    <loc>" . base_url("blog/{$post['slug']}") . "</loc>\n";
            $xml .= "    <lastmod>" . date('Y-m-d', strtotime($post['updated_at'])) . "</lastmod>\n";
            $xml .= "    <changefreq>monthly</changefreq>\n";
            $xml .= "    <priority>0.6</priority>\n";
            $xml .= "  </url>\n";
        }
        
        $xml .= '</urlset>';
        
        return $xml;
    }
}

if (!function_exists('generate_robots_txt')) {
    /**
     * Generate robots.txt content
     */
    function generate_robots_txt() {
        $content = "User-agent: *\n";
        $content .= "Allow: /\n";
        $content .= "Disallow: /admin/\n";
        $content .= "Disallow: /app/\n";
        $content .= "Disallow: /system/\n";
        $content .= "Disallow: /writable/\n";
        $content .= "\n";
        $content .= "Sitemap: " . base_url('sitemap.xml') . "\n";
        
        return $content;
    }
}
