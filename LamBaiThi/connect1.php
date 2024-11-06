<?php
$dsn = 'pgsql:host=c8m0261h0c7idk.cluster-czrs8kj4isg7.us-east-1.rds.amazonaws.com;port=5432;dbname=d5f124ds8nupst';
$username = 'u52h1nab8sl1lm';
$password = 'p8951bf1798016e4a70831b39351baec318413962252ab9417c83b4d74ac0d6d7';

try {
    $conn = new PDO($dsn, $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>