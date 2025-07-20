#!/bin/bash

echo "🚀 R-CAT Rajasthan Complete Fix Script"
echo "======================================"

# Step 1: Upload missing .htaccess file
echo "📁 Step 1: Uploading .htaccess file..."
scp -P 65002 .htaccess u473874865@178.16.136.106:/home/u473874865/domains/rcatrajasthan.com/public_html/

# Step 2: Set proper permissions
echo "🔧 Step 2: Setting file permissions..."
ssh -p 65002 u473874865@178.16.136.106 "chmod 644 /home/u473874865/domains/rcatrajasthan.com/public_html/.htaccess"
ssh -p 65002 u473874865@178.16.136.106 "chmod 755 /home/u473874865/domains/rcatrajasthan.com/public_html/assets/uploads"
ssh -p 65002 u473874865@178.16.136.106 "chmod 755 /home/u473874865/domains/rcatrajasthan.com/public_html/logs"

# Step 3: Upload database setup file
echo "🗄️ Step 3: Uploading database setup..."
scp -P 65002 setup-database.php u473874865@178.16.136.106:/home/u473874865/domains/rcatrajasthan.com/public_html/

echo "✅ Upload complete!"
echo ""
echo "🔄 Manual Steps Required:"
echo "1. Visit: https://rcatrajasthan.com/setup-database.php"
echo "2. Run database setup"
echo "3. Test URLs:"
echo "   - https://rcatrajasthan.com/"
echo "   - https://rcatrajasthan.com/about"
echo "   - https://rcatrajasthan.com/admin"
echo "4. Delete setup-database.php when done"
echo ""
echo "🔑 Admin Login: admin / admin123"
