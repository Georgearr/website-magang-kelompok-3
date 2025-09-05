<?php
// Database configuration - Using SQLite for Replit environment
// SQLite is simpler to set up and perfect for this application

$database_file = __DIR__ . '/memoria_aeterna.db';

try {
    // Create PDO connection to SQLite
    $conn = new PDO("sqlite:$database_file");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create table if not exists (SQLite syntax)
    $create_table_sql = "CREATE TABLE IF NOT EXISTS registrations (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT NOT NULL,
        class TEXT NOT NULL,
        phone TEXT NOT NULL,
        email TEXT,
        team_name TEXT,
        team_members TEXT,
        competition TEXT NOT NULL,
        registration_date DATETIME DEFAULT CURRENT_TIMESTAMP
    )";
    
    $conn->exec($create_table_sql);
    
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>