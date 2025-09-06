<?php
require_once 'config.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit();
}

try {
    // Get form data
    $name = $_POST['name'] ?? '';
    $class = $_POST['class'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $email = $_POST['email'] ?? '';
    $team_name = $_POST['team_name'] ?? '';
    $team_members = $_POST['team_members'] ?? '';
    $competition = $_POST['competition'] ?? '';
    
    // Validate required fields
    if (empty($name) || empty($class) || empty($phone) || empty($competition)) {
        throw new Exception('Required fields missing');
    }
    
    // Insert into database
    $stmt = $conn->prepare("INSERT INTO registrations (name, class, phone, email, team_name, team_members, competition) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$name, $class, $phone, $email, $team_name, $team_members, $competition]);
    
    echo json_encode(['success' => true, 'message' => 'Registration saved successfully']);
    
} catch(Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
?>