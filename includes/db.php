
<?php
// AirAsia Rewards - SQLite Database Connection

$databasePath = __DIR__ . '/../database/rewards.db';

try {
    $pdo = new PDO('sqlite:' . $databasePath);

    $pdo->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

    $pdo->setAttribute(
        PDO::ATTR_DEFAULT_FETCH_MODE,
        PDO::FETCH_ASSOC
    );

} catch (PDOException $e) {
    error_log($e->getMessage());
    http_response_code(500);
    exit('Database connection failed.');
}
