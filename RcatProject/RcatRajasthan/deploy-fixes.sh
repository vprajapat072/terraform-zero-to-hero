#!/bin/bash

# R-CAT Rajasthan Production Fix Deployment Script
# This script helps you re-upload only the fixed files

echo "🔧 R-CAT Rajasthan Production Fixes Deployment"
echo "=============================================="

# List of files that need to be re-uploaded
echo "📁 Files that need re-uploading:"
echo "1. app/database.config.php (Fixed database username)"
echo "2. index.php (Added config loading and contact route)"
echo "3. assets/uploads/.gitkeep (New directory)"
echo "4. logs/.gitkeep (New directory)"
echo ""

# SCP commands for re-uploading specific files
echo "🚀 SCP Commands to run:"
echo ""

echo "# Upload fixed database config"
echo "scp app/database.config.php your_user@your_server:/path/to/website/app/"
echo ""

echo "# Upload fixed index.php"
echo "scp index.php your_user@your_server:/path/to/website/"
echo ""

echo "# Upload new directories (create first)"
echo "ssh your_user@your_server 'mkdir -p /path/to/website/assets/uploads'"
echo "ssh your_user@your_server 'mkdir -p /path/to/website/logs'"
echo "scp assets/uploads/.gitkeep your_user@your_server:/path/to/website/assets/uploads/"
echo "scp logs/.gitkeep your_user@your_server:/path/to/website/logs/"
echo ""

echo "# Set proper permissions"
echo "ssh your_user@your_server 'chmod 755 /path/to/website/assets/uploads'"
echo "ssh your_user@your_server 'chmod 755 /path/to/website/logs'"
echo ""

echo "⚡ Quick Test Commands:"
echo "curl -I https://rcatrajasthan.com/ # Test homepage"
echo "curl -I https://rcatrajasthan.com/about # Test about page"
echo "curl -I https://rcatrajasthan.com/contact # Test contact page"
echo ""

echo "🔍 Verification:"
echo "Visit: https://rcatrajasthan.com/verify-deployment.php"
echo ""

echo "✅ After successful deployment, delete the verification file:"
echo "ssh your_user@your_server 'rm /path/to/website/verify-deployment.php'"
