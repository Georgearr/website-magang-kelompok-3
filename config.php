<?php
// Database configuration for MySQL
// Please update these settings according to your MySQL database

$servername = "localhost";
$username = "root";        // Your MySQL username
$password = "";            // Your MySQL password
$dbname = "malam_keakraban"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set charset to utf8 for Indonesian characters
$conn->set_charset("utf8");

// Create table if not exists
$create_table_sql = "CREATE TABLE IF NOT EXISTS registrations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    class VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    email VARCHAR(255),
    team_name VARCHAR(255),
    team_members TEXT,
    competition VARCHAR(255) NOT NULL,
    registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($create_table_sql) === FALSE) {
    // Table creation failed, but continue - user might need to create database first
    error_log("Error creating table: " . $conn->error);
}
?>