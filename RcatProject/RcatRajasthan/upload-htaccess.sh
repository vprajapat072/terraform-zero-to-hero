#!/bin/bash

# Upload missing .htaccess file specifically
echo "🔧 Uploading missing .htaccess file..."

# Upload .htaccess file specifically (hidden files often get missed)
scp -P 65002 .htaccess u473874865@178.16.136.106:/home/u473874865/domains/rcatrajasthan.com/public_html/

echo "✅ .htaccess file uploaded"

# Verify upload
echo "🔍 Verifying .htaccess upload..."
ssh -p 65002 u473874865@178.16.136.106 "ls -la /home/u473874865/domains/rcatrajasthan.com/public_html/ | grep htaccess"

echo "🔧 Setting proper permissions..."
ssh -p 65002 u473874865@178.16.136.106 "chmod 644 /home/u473874865/domains/rcatrajasthan.com/public_html/.htaccess"

echo "✅ Upload complete! Test the URLs now."
