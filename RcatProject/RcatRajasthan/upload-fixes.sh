#!/bin/bash

echo "🔧 Uploading Fixed Controllers..."

# Upload fixed controllers
scp -P 65002 app/Controllers/BlogController.php u473874865@178.16.136.106:/home/u473874865/domains/rcatrajasthan.com/public_html/app/Controllers/
scp -P 65002 app/Controllers/Contact.php u473874865@178.16.136.106:/home/u473874865/domains/rcatrajasthan.com/public_html/app/Controllers/
scp -P 65002 app/Controllers/FAQController.php u473874865@178.16.136.106:/home/u473874865/domains/rcatrajasthan.com/public_html/app/Controllers/

# Upload fixed layout
scp -P 65002 app/Views/layouts/main.php u473874865@178.16.136.106:/home/u473874865/domains/rcatrajasthan.com/public_html/app/Views/layouts/

echo "✅ Files uploaded!"
echo ""
echo "🧪 Test these URLs now:"
echo "https://rcatrajasthan.com/blog"
echo "https://rcatrajasthan.com/faq"
echo "https://rcatrajasthan.com/contact"
echo "https://rcatrajasthan.com/courses"
echo ""
echo "If courses still shows no CSS, we need to update the controller to use layout properly."
