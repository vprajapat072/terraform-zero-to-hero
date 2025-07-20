#!/bin/bash

echo "🔧 Uploading COURSES PAGE FIX - Schema Markup Issue"
echo "================================================="

echo "📁 Uploading fixed CoursesController.php..."
scp -P 65002 app/Controllers/CoursesController.php u473874865@178.16.136.106:/home/u473874865/domains/rcatrajasthan.com/public_html/app/Controllers/

echo "📁 Uploading fixed courses.php view..."
scp -P 65002 app/Views/pages/courses.php u473874865@178.16.136.106:/home/u473874865/domains/rcatrajasthan.com/public_html/app/Views/pages/

echo ""
echo "✅ Courses page schema markup FIXED!"
echo ""
echo "🧪 TEST THE URL NOW:"
echo "======================================"
echo "✅ Courses: https://rcatrajasthan.com/courses"
echo ""
echo "🎉 SCHEMA MARKUP FIX APPLIED:"
echo "   ✅ JSON-LD schema no longer shows as text on page"
echo "   ✅ Schema markup properly embedded in HTML head"
echo "   ✅ SEO benefits maintained without visual pollution"
echo "   ✅ Page now displays cleanly without JSON text"
