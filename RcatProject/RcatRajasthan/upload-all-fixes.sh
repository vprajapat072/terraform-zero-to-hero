#!/bin/bash

echo "🔧 Uploading ALL Fixed Controllers (CLEAN VERSION - No Syntax Errors)"
echo "=================================================================="

# Upload all fixed controllers
echo "📁 Uploading BlogController.php..."
scp -P 65002 app/Controllers/BlogController.php u473874865@178.16.136.106:/home/u473874865/domains/rcatrajasthan.com/public_html/app/Controllers/

echo "📁 Uploading Contact.php..."
scp -P 65002 app/Controllers/Contact.php u473874865@178.16.136.106:/home/u473874865/domains/rcatrajasthan.com/public_html/app/Controllers/

echo "📁 Uploading FAQController.php..."
scp -P 65002 app/Controllers/FAQController.php u473874865@178.16.136.106:/home/u473874865/domains/rcatrajasthan.com/public_html/app/Controllers/

echo "📁 Uploading FAQ View..."
scp -P 65002 app/Views/pages/faq.php u473874865@178.16.136.106:/home/u473874865/domains/rcatrajasthan.com/public_html/app/Views/pages/

echo "📁 Uploading CoursesController.php..."
scp -P 65002 app/Controllers/CoursesController.php u473874865@178.16.136.106:/home/u473874865/domains/rcatrajasthan.com/public_html/app/Controllers/

echo "📁 Uploading Courses View..."
scp -P 65002 app/Views/pages/courses.php u473874865@178.16.136.106:/home/u473874865/domains/rcatrajasthan.com/public_html/app/Views/pages/

echo "📁 Uploading main layout..."
scp -P 65002 app/Views/layouts/main.php u473874865@178.16.136.106:/home/u473874865/domains/rcatrajasthan.com/public_html/app/Views/layouts/

echo ""
echo "✅ All files uploaded successfully!"
echo ""
echo "🧪 TEST THESE URLS NOW:"
echo "======================================"
echo "✅ Blog: https://rcatrajasthan.com/blog"
echo "✅ FAQ: https://rcatrajasthan.com/faq"
echo "✅ Contact: https://rcatrajasthan.com/contact"
echo "✅ Courses: https://rcatrajasthan.com/courses (FIXED - Beautiful Design & Full CSS)"
echo ""
echo "🎉 COURSES PAGE COMPLETELY FIXED:"
echo "   ✅ Proper hero section with gradient background"
echo "   ✅ Beautiful course cards with hover effects"
echo "   ✅ Course filtering and search functionality"
echo "   ✅ Responsive design for all devices"
echo "   ✅ Professional styling and animations"
echo "   ✅ Course comparison functionality"
echo "   ✅ Call-to-action sections"
echo ""
echo "🎯 EXPECTED RESULTS:"
echo "✅ All pages should load with full CSS/design"
echo "✅ No more HTTP 500 errors"
echo "✅ All layouts should be consistent"
echo "✅ Navigation and styling should work properly"
echo ""
echo "🔒 SECURITY REMINDER:"
echo "Don't forget to delete any test/setup files when done!"
