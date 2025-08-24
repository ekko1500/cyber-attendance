<?php
try {
    // Database connection details from your InfinityFree panel
    $host = 'yamabiko.proxy.rlwy.net';
    $dbname = 'railway';
    $user = 'root';
    $password = 'GMnExWwRKkXhUcodjLInPtoQKwdkkyNN';
    $port = 18491;

    // Connect to the database
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $user, $password);
    
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // echo "OK"; // This is for testing, you can remove it later
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}
?>