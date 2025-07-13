<?php
/**
 * Database Setup Controller
 * This script helps you set up the database structure and initial data
 */

// Only allow access from localhost or authorized IPs
$allowed_ips = ['127.0.0.1', '::1', 'localhost'];
$client_ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';

require_once 'app/Config.php';

class DatabaseSetup {
    private $pdo;
    private $connected = false;
    
    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
        $this->connected = isDbConnected();
    }
    
    public function setupDatabase() {
        if (!$this->connected) {
            return [
                'success' => false,
                'message' => 'Database connection is not available. Please check your configuration.'
            ];
        }
        
        try {
            // Read the SQL setup file
            $sql_file = __DIR__ . '/database/setup.sql';
            
            if (!file_exists($sql_file)) {
                return [
                    'success' => false,
                    'message' => 'Database setup file not found: ' . $sql_file
                ];
            }
            
            $sql_content = file_get_contents($sql_file);
            
            // Split SQL statements
            $statements = $this->splitSQLStatements($sql_content);
            
            $executed = 0;
            $errors = [];
            
            foreach ($statements as $statement) {
                $statement = trim($statement);
                
                if (empty($statement) || strpos($statement, '--') === 0) {
                    continue;
                }
                
                try {
                    $this->pdo->exec($statement);
                    $executed++;
                } catch (PDOException $e) {
                    $errors[] = "Error executing statement: " . $e->getMessage();
                }
            }
            
            if (empty($errors)) {
                return [
                    'success' => true,
                    'message' => "Database setup completed successfully! $executed statements executed.",
                    'statements_executed' => $executed
                ];
            } else {
                return [
                    'success' => false,
                    'message' => "Database setup completed with errors. $executed statements executed.",
                    'statements_executed' => $executed,
                    'errors' => $errors
                ];
            }
            
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => 'Database setup failed: ' . $e->getMessage()
            ];
        }
    }
    
    private function splitSQLStatements($sql) {
        // Simple SQL statement splitter
        $statements = [];
        $current_statement = '';
        $in_string = false;
        $string_char = '';
        
        $lines = explode("\n", $sql);
        
        foreach ($lines as $line) {
            $line = trim($line);
            
            // Skip comments and empty lines
            if (empty($line) || strpos($line, '--') === 0) {
                continue;
            }
            
            $current_statement .= $line . "\n";
            
            // Check if statement ends with semicolon
            if (substr(trim($line), -1) === ';') {
                $statements[] = $current_statement;
                $current_statement = '';
            }
        }
        
        // Add remaining statement if any
        if (!empty(trim($current_statement))) {
            $statements[] = $current_statement;
        }
        
        return $statements;
    }
    
    public function checkTables() {
        if (!$this->connected) {
            return ['success' => false, 'message' => 'Database not connected'];
        }
        
        $tables = ['users', 'courses', 'blog_posts', 'newsletter_subscribers', 'admissions', 'site_settings'];
        $table_status = [];
        
        foreach ($tables as $table) {
            try {
                $stmt = $this->pdo->query("SELECT COUNT(*) FROM $table");
                $count = $stmt->fetchColumn();
                $table_status[$table] = [
                    'exists' => true,
                    'count' => $count
                ];
            } catch (PDOException $e) {
                $table_status[$table] = [
                    'exists' => false,
                    'error' => $e->getMessage()
                ];
            }
        }
        
        return [
            'success' => true,
            'tables' => $table_status
        ];
    }
}

// Handle the setup request
$setup = new DatabaseSetup();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    header('Content-Type: application/json');
    
    switch ($_POST['action']) {
        case 'setup':
            echo json_encode($setup->setupDatabase());
            break;
            
        case 'check':
            echo json_encode($setup->checkTables());
            break;
            
        default:
            echo json_encode(['success' => false, 'message' => 'Invalid action']);
    }
    exit;
}

// Display the setup interface
$pageTitle = "Database Setup - R-CAT Rajasthan";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h2 class="mb-0">
                            <i class="fas fa-database me-2"></i>
                            Database Setup
                        </h2>
                    </div>
                    <div class="card-body">
                        <!-- Connection Status -->
                        <div class="alert <?php echo isDbConnected() ? 'alert-success' : 'alert-danger'; ?>">
                            <i class="fas <?php echo isDbConnected() ? 'fa-check-circle' : 'fa-times-circle'; ?> me-2"></i>
                            <strong>Database Connection:</strong> 
                            <?php echo isDbConnected() ? 'Connected' : 'Not Connected'; ?>
                        </div>
                        
                        <?php if (isDbConnected()): ?>
                        
                        <!-- Setup Instructions -->
                        <div class="mb-4">
                            <h4><i class="fas fa-info-circle me-2"></i>Setup Instructions</h4>
                            <ol>
                                <li>Click "Check Current Status" to see which tables exist</li>
                                <li>Click "Setup Database" to create all tables and insert sample data</li>
                                <li>Wait for the process to complete</li>
                                <li>Your website will then work with real database data</li>
                            </ol>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4">
                            <button type="button" class="btn btn-info" onclick="checkStatus()">
                                <i class="fas fa-search me-2"></i>Check Current Status
                            </button>
                            <button type="button" class="btn btn-success" onclick="setupDatabase()">
                                <i class="fas fa-cog me-2"></i>Setup Database
                            </button>
                        </div>
                        
                        <!-- Results Area -->
                        <div id="results" class="mt-4"></div>
                        
                        <?php else: ?>
                        
                        <div class="alert alert-warning">
                            <h4><i class="fas fa-exclamation-triangle me-2"></i>Database Connection Required</h4>
                            <p>Please configure your database connection in <code>app/Config.php</code> before proceeding.</p>
                            <p>You can test your connection using <a href="test-database.php" class="alert-link">test-database.php</a></p>
                        </div>
                        
                        <?php endif; ?>
                        
                        <!-- Back to Website -->
                        <div class="mt-4 pt-4 border-top">
                            <a href="/" class="btn btn-outline-primary">
                                <i class="fas fa-arrow-left me-2"></i>Back to Website
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function checkStatus() {
            showLoading('Checking database status...');
            
            fetch('', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'action=check'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showTableStatus(data.tables);
                } else {
                    showError(data.message);
                }
            })
            .catch(error => {
                showError('Error checking status: ' + error.message);
            });
        }
        
        function setupDatabase() {
            if (!confirm('This will create/update database tables and insert sample data. Continue?')) {
                return;
            }
            
            showLoading('Setting up database...');
            
            fetch('', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'action=setup'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showSuccess(data.message);
                    setTimeout(() => {
                        checkStatus();
                    }, 1000);
                } else {
                    showError(data.message);
                    if (data.errors) {
                        showErrors(data.errors);
                    }
                }
            })
            .catch(error => {
                showError('Error setting up database: ' + error.message);
            });
        }
        
        function showLoading(message) {
            document.getElementById('results').innerHTML = `
                <div class="alert alert-info">
                    <i class="fas fa-spinner fa-spin me-2"></i>${message}
                </div>
            `;
        }
        
        function showSuccess(message) {
            document.getElementById('results').innerHTML = `
                <div class="alert alert-success">
                    <i class="fas fa-check-circle me-2"></i>${message}
                </div>
            `;
        }
        
        function showError(message) {
            document.getElementById('results').innerHTML = `
                <div class="alert alert-danger">
                    <i class="fas fa-times-circle me-2"></i>${message}
                </div>
            `;
        }
        
        function showErrors(errors) {
            let errorList = '<ul>';
            errors.forEach(error => {
                errorList += `<li>${error}</li>`;
            });
            errorList += '</ul>';
            
            document.getElementById('results').innerHTML += `
                <div class="alert alert-warning">
                    <h5>Errors encountered:</h5>
                    ${errorList}
                </div>
            `;
        }
        
        function showTableStatus(tables) {
            let tableHtml = '<div class="alert alert-info"><h5>Database Tables Status:</h5><div class="table-responsive"><table class="table table-sm">';
            tableHtml += '<thead><tr><th>Table</th><th>Status</th><th>Records</th></tr></thead><tbody>';
            
            for (let table in tables) {
                let status = tables[table];
                let statusIcon = status.exists ? '<i class="fas fa-check-circle text-success"></i>' : '<i class="fas fa-times-circle text-danger"></i>';
                let statusText = status.exists ? 'Exists' : 'Missing';
                let recordCount = status.exists ? status.count : 'N/A';
                
                tableHtml += `<tr><td>${table}</td><td>${statusIcon} ${statusText}</td><td>${recordCount}</td></tr>`;
            }
            
            tableHtml += '</tbody></table></div></div>';
            document.getElementById('results').innerHTML = tableHtml;
        }
    </script>
</body>
</html>
