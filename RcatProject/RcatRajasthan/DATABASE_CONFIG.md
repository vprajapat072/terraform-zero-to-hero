# Database Configuration Guide

## 🔧 **Quick Configuration Steps**

### 1. **Get Your Hostinger Database Details**

After creating your database in Hostinger, you'll have:
- **Database Host:** Usually `mysql.hostinger.com` or similar
- **Database Name:** Your chosen database name
- **Username:** Your database username
- **Password:** Your database password
- **Port:** Usually `3306`

### 2. **Update Configuration**

Edit the file: `app/Config.php`

Find these lines (around line 8-12):
```php
private $host = 'mysql.hostinger.com'; // Replace with your Hostinger MySQL host
private $dbname = 'rcat_rajasthan'; // Replace with your database name
private $username = 'your_username'; // Replace with your database username
private $password = 'your_password'; // Replace with your database password
```

Replace with your actual credentials:
```php
private $host = 'mysql.hostinger.com'; // Your actual host
private $dbname = 'u123456789_rcat'; // Your actual database name
private $username = 'u123456789_user'; // Your actual username
private $password = 'YourActualPassword'; // Your actual password
```

### 3. **Test Database Connection**

1. Save the changes
2. Open: `http://your-codespaces-url/test-database.php`
3. Check if connection is successful

### 4. **Setup Database Tables**

1. Open: `http://your-codespaces-url/setup-database.php`
2. Click "Check Current Status"
3. Click "Setup Database"
4. Wait for completion

### 5. **Verify Everything Works**

1. Go to your main website
2. Check if "Demo Mode" warning is gone
3. Test admin panel at `/admin`
4. Verify real data is being used

## 📋 **Common Hostinger Database Settings**

### Typical Configuration:
```php
private $host = 'mysql.hostinger.com';
private $dbname = 'u123456789_yourdb';
private $username = 'u123456789_user';
private $password = 'your_secure_password';
private $port = 3306;
```

### Alternative Hostinger Hosts:
- `mysql.hostinger.com`
- `mysql.hostinger.co.uk`
- `mysql.hostinger.in`
- Check your Hostinger panel for exact host

## 🔐 **Security Tips**

1. **Use Strong Passwords:** Generate a secure password for your database
2. **Limit IP Access:** Only allow necessary IPs in Remote MySQL
3. **Regular Backups:** Set up automatic database backups
4. **Monitor Access:** Check database logs regularly

## 🐛 **Troubleshooting**

### Connection Failed?
1. Double-check all credentials
2. Ensure Remote MySQL is enabled
3. Add your IP to whitelist
4. Try different host names

### Tables Not Created?
1. Check if database exists in Hostinger
2. Verify user has CREATE privileges
3. Run setup script again
4. Check error logs

### Still in Demo Mode?
1. Clear browser cache
2. Restart PHP server
3. Check Config.php changes saved
4. Verify database connection test passes

## 📞 **Need Help?**

If you encounter issues:
1. Check the test-database.php results
2. Look at browser console for errors
3. Verify Hostinger panel settings
4. Contact support if needed

---

**Next:** Once configured, your website will automatically use real database data instead of demo data!
