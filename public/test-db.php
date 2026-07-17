<?php

header('Content-Type: text/html; charset=utf-8');

echo "<h2>Database Connection Test Page</h2>";

// Print environment details
echo "<h4>Environment Variables:</h4>";
$dbUrl = getenv('DB_URL');
$dbConnection = getenv('DB_CONNECTION');
$dbHost = getenv('DB_HOST');
$dbPort = getenv('DB_PORT');
$dbDatabase = getenv('DB_DATABASE');
$dbUsername = getenv('DB_USERNAME');
$sessionDriver = getenv('SESSION_DRIVER');

echo "DB_CONNECTION: " . htmlspecialchars($dbConnection ?: 'not set') . "<br>";
echo "DB_URL: " . htmlspecialchars($dbUrl ? substr($dbUrl, 0, 30) . '...' : 'not set') . "<br>";
echo "DB_HOST: " . htmlspecialchars($dbHost ?: 'not set') . "<br>";
echo "DB_PORT: " . htmlspecialchars($dbPort ?: 'not set') . "<br>";
echo "DB_DATABASE: " . htmlspecialchars($dbDatabase ?: 'not set') . "<br>";
echo "DB_USERNAME: " . htmlspecialchars($dbUsername ?: 'not set') . "<br>";
echo "SESSION_DRIVER: " . htmlspecialchars($sessionDriver ?: 'not set') . "<br>";

echo "<h4>Attempting connection...</h4>";

try {
    $dsn = "";
    $user = "";
    $pass = "";

    if ($dbUrl) {
        $parsed = parse_url($dbUrl);
        if ($parsed) {
            $scheme = isset($parsed['scheme']) ? $parsed['scheme'] : 'pgsql';
            if ($scheme === 'postgresql') {
                $scheme = 'pgsql';
            }
            $host = isset($parsed['host']) ? $parsed['host'] : '';
            $port = isset($parsed['port']) ? $parsed['port'] : '5432';
            $dbName = isset($parsed['path']) ? ltrim($parsed['path'], '/') : '';
            $user = isset($parsed['user']) ? urldecode($parsed['user']) : '';
            $pass = isset($parsed['pass']) ? urldecode($parsed['pass']) : '';
            
            $query = [];
            if (isset($parsed['query'])) {
                parse_str($parsed['query'], $query);
            }
            
            $sslmode = isset($query['sslmode']) ? $query['sslmode'] : 'prefer';
            
            $dsn = "pgsql:host=$host;port=$port;dbname=$dbName;sslmode=$sslmode";
            echo "Constructed DSN from DB_URL: " . htmlspecialchars("pgsql:host=$host;port=$port;dbname=$dbName;sslmode=$sslmode") . "<br>";
        } else {
            throw new Exception("Failed to parse DB_URL");
        }
    } else {
        $host = $dbHost ?: '127.0.0.1';
        $port = $dbPort ?: '5432';
        $dbName = $dbDatabase ?: 'forge';
        $user = $dbUsername ?: 'forge';
        $pass = getenv('DB_PASSWORD') ?: '';
        $sslmode = getenv('DB_SSLMODE') ?: 'prefer';
        
        $dsn = "pgsql:host=$host;port=$port;dbname=$dbName;sslmode=$sslmode";
        echo "Constructed DSN from variables: " . htmlspecialchars($dsn) . "<br>";
    }

    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_TIMEOUT => 5
    ]);
    
    echo "<span style='color: green; font-weight: bold;'>✔ SUCCESS: Connected to PostgreSQL database!</span><br>";
    
    $stmt = $pdo->query("SELECT version()");
    $version = $stmt->fetchColumn();
    echo "PostgreSQL Version: " . htmlspecialchars($version) . "<br>";
    
} catch (PDOException $e) {
    echo "<span style='color: red; font-weight: bold;'>✘ CONNECTION FAILED (PDOException):</span><br>";
    echo "<pre>" . htmlspecialchars($e->getMessage()) . "</pre>";
} catch (Exception $e) {
    echo "<span style='color: red; font-weight: bold;'>✘ ERROR:</span><br>";
    echo "<pre>" . htmlspecialchars($e->getMessage()) . "</pre>";
}
