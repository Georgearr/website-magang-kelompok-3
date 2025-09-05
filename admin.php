<?php
require_once 'config.php';

// Simple admin authentication (you can enhance this)
session_start();
$admin_password = "admin123"; // Change this password!

if (isset($_POST['login'])) {
    if ($_POST['password'] === $admin_password) {
        $_SESSION['admin'] = true;
    } else {
        $error = "Password salah!";
    }
}

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: admin.php');
    exit();
}

if (!isset($_SESSION['admin'])) {
    ?>
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Login - Malam Keakraban OSIS</title>
        <link rel="stylesheet" href="style.css">
        <style>
            .login-form {
                max-width: 400px;
                margin: 100px auto;
                padding: 40px;
                background: white;
                border-radius: 15px;
                box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            }
        </style>
    </head>
    <body>
        <div class="login-form">
            <h2>Admin Login</h2>
            <?php if (isset($error)): ?>
                <div class="alert alert-error"><?php echo $error; ?></div>
            <?php endif; ?>
            <form method="POST">
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" required>
                </div>
                <button type="submit" name="login" class="submit-btn">Login</button>
            </form>
        </div>
    </body>
    </html>
    <?php
    exit();
}

// Get registrations
$registrations = [];
try {
    if (isset($conn)) {
        $stmt = $conn->prepare("SELECT * FROM registrations ORDER BY registration_date DESC");
        $stmt->execute();
        $registrations = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
} catch(PDOException $e) {
    // Handle error silently for now
    error_log("Database error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Malam Keakraban OSIS</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .admin-header {
            background: #333;
            color: white;
            padding: 20px 0;
        }
        .admin-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .registrations-table {
            margin: 40px 0;
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background: #d32f2f;
            color: white;
        }
        tr:hover {
            background: #f8f9fa;
        }
    </style>
</head>
<body>
    <div class="admin-header">
        <div class="container">
            <div class="admin-nav">
                <h1>Admin Dashboard</h1>
                <div>
                    <a href="index.html" style="color: white; margin-right: 20px;">Lihat Website</a>
                    <a href="?logout=1" style="color: white;">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <main>
        <div class="container">
            <h2>Data Pendaftaran Lomba</h2>
            <div class="registrations-table">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>HP</th>
                            <th>Email</th>
                            <th>Tim</th>
                            <th>Anggota</th>
                            <th>Lomba</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($registrations) > 0) {
                            foreach($registrations as $row) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['class']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['team_name']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['team_members']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['competition']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['registration_date']) . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='9' style='text-align: center;'>Belum ada pendaftaran</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>