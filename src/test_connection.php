<?php
try {
    $host = 'yamabiko.proxy.rlwy.net';
    $dbname = 'railway';
    $user = 'root';
    $password = 'GMnExWwRKkXhUcodjLInPtoQKwdkkyNN';
    $port = 18491;

    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connection successful!";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>