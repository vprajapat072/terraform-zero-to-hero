<?php

if (!function_exists('optimize_image')) {
    /**
     * Generate optimized image URLs with WebP support
     */
    function optimize_image($imagePath, $width = null, $height = null, $quality = 85) {
        $baseUrl = base_url();
        
        // Check if WebP is supported by the browser
        $supportsWebP = false;
        if (isset($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'image/webp') !== false) {
            $supportsWebP = true;
        }
        
        // Generate different sizes for responsive images
        if ($width || $height) {
            $params = array_filter([
                'w' => $width,
                'h' => $height,
                'q' => $quality,
                'f' => $supportsWebP ? 'webp' : 'auto'
            ]);
            
            return $baseUrl . $imagePath . '?' . http_build_query($params);
        }
        
        return $baseUrl . $imagePath;
    }
}

if (!function_exists('generate_responsive_image')) {
    /**
     * Generate responsive image with srcset
     */
    function generate_responsive_image($imagePath, $alt, $sizes = null, $lazy = true) {
        $baseUrl = base_url();
        
        // Default sizes for responsive design
        $defaultSizes = [
            ['width' => 320, 'descriptor' => '320w'],
            ['width' => 768, 'descriptor' => '768w'],
            ['width' => 1024, 'descriptor' => '1024w'],
            ['width' => 1400, 'descriptor' => '1400w']
        ];
        
        $srcset = [];
        foreach ($defaultSizes as $size) {
            $srcset[] = optimize_image($imagePath, $size['width']) . ' ' . $size['descriptor'];
        }
        
        $sizesAttr = $sizes ?: '(max-width: 768px) 100vw, (max-width: 1024px) 50vw, 33vw';
        $loadingAttr = $lazy ? 'loading="lazy"' : '';
        
        return sprintf(
            '<img src="%s" srcset="%s" sizes="%s" alt="%s" %s class="img-responsive">',
            optimize_image($imagePath, 768), // fallback
            implode(', ', $srcset),
            $sizesAttr,
            esc($alt),
            $loadingAttr
        );
    }
}

if (!function_exists('generate_picture_element')) {
    /**
     * Generate picture element with WebP support
     */
    function generate_picture_element($imagePath, $alt, $lazy = true) {
        $webpPath = str_replace(['.jpg', '.jpeg', '.png'], '.webp', $imagePath);
        $loadingAttr = $lazy ? 'loading="lazy"' : '';
        
        return sprintf('
            <picture>
                <source srcset="%s" type="image/webp">
                <source srcset="%s" type="image/jpeg">
                <img src="%s" alt="%s" %s class="img-fluid">
            </picture>',
            base_url($webpPath),
            base_url($imagePath),
            base_url($imagePath),
            esc($alt),
            $loadingAttr
        );
    }
}

if (!function_exists('preload_critical_resources')) {
    /**
     * Generate preload links for critical resources
     */
    function preload_critical_resources() {
        $resources = [
            [
                'href' => '/assets/css/style.css',
                'as' => 'style',
                'type' => 'text/css'
            ],
            [
                'href' => 'https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap',
                'as' => 'style',
                'crossorigin' => 'anonymous'
            ],
            [
                'href' => '/assets/js/main.js',
                'as' => 'script',
                'type' => 'text/javascript'
            ]
        ];
        
        $output = '';
        foreach ($resources as $resource) {
            $attributes = [];
            foreach ($resource as $key => $value) {
                $attributes[] = sprintf('%s="%s"', $key, esc($value));
            }
            $output .= sprintf('<link rel="preload" %s>' . "\n", implode(' ', $attributes));
        }
        
        return $output;
    }
}

if (!function_calls('defer_non_critical_css')) {
    /**
     * Load non-critical CSS asynchronously
     */
    function defer_non_critical_css($cssFiles) {
        $output = '';
        foreach ($cssFiles as $file) {
            $output .= sprintf(
                '<link rel="preload" href="%s" as="style" onload="this.onload=null;this.rel=\'stylesheet\'">
                <noscript><link rel="stylesheet" href="%s"></noscript>' . "\n",
                $file,
                $file
            );
        }
        return $output;
    }
}

if (!function_exists('generate_service_worker')) {
    /**
     * Generate service worker for PWA caching
     */
    function generate_service_worker() {
        return "
const CACHE_NAME = 'rcat-rajasthan-v1';
const urlsToCache = [
    '/',
    '/assets/css/style.css',
    '/assets/js/main.js',
    '/assets/images/logo.png'
];

self.addEventListener('install', function(event) {
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then(function(cache) {
                return cache.addAll(urlsToCache);
            })
    );
});

self.addEventListener('fetch', function(event) {
    event.respondWith(
        caches.match(event.request)
            .then(function(response) {
                if (response) {
                    return response;
                }
                return fetch(event.request);
            }
        )
    );
});
        ";
    }
}
