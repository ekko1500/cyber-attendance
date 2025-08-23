<?php
try {
    // Database connection details from your InfinityFree panel
    $host = 'sql211.infinityfree.com';
    $dbname = 'if0_39772271_cyber';
    $user = 'if0_39772271';
    $password = 'rLZqIHnrV7ArLt'; // Replace with your actual vPanel password

    // Connect to the database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // echo "OK"; // This is for testing, you can remove it later
}
catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>