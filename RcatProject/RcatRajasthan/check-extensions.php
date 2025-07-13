<?php
// PHP Extension Check
echo "<h2>PHP Extension Check</h2>";

echo "<h3>PDO Extensions:</h3>";
$pdo_extensions = ['pdo', 'pdo_mysql', 'pdo_sqlite', 'pdo_pgsql'];
foreach ($pdo_extensions as $ext) {
    $loaded = extension_loaded($ext);
    echo "<p>$ext: " . ($loaded ? "✅ LOADED" : "❌ NOT LOADED") . "</p>";
}

echo "<h3>MySQL Extensions:</h3>";
$mysql_extensions = ['mysql', 'mysqli', 'mysqlnd'];
foreach ($mysql_extensions as $ext) {
    $loaded = extension_loaded($ext);
    echo "<p>$ext: " . ($loaded ? "✅ LOADED" : "❌ NOT LOADED") . "</p>";
}

echo "<h3>All Loaded Extensions:</h3>";
$extensions = get_loaded_extensions();
sort($extensions);
echo "<pre>" . implode(", ", $extensions) . "</pre>";

echo "<h3>PDO Drivers:</h3>";
if (extension_loaded('pdo')) {
    $drivers = PDO::getAvailableDrivers();
    echo "<pre>" . implode(", ", $drivers) . "</pre>";
} else {
    echo "<p>PDO not available</p>";
}
?>
