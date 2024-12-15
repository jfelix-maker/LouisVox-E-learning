<?php
session_start();
require_once "config.php";

// Jika pengguna sudah login, arahkan ke halaman sesuai level
if (isset($_SESSION['user'])) {
    if ($_SESSION['level'] == 1) {
        header("Location: admin/index.php");
    } elseif ($_SESSION['level'] == 2) {
        header("Location: guru/index.php");
    } elseif ($_SESSION['level'] == 3) {
        header("Location: siswa/index.php");
    }
    exit;
}

// Proses login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cEmail']) && isset($_POST['cPassword'])) {
    $cemail = htmlspecialchars(trim($_POST["cEmail"])); // Trim white space from email string and convert chars into html entities
    $cpassword = htmlspecialchars(trim($_POST["cPassword"])); // Do the same with password
    
    // Menggunakan prepared statement untuk keamanan dari SQL Injection
    $stmt = $conn->prepare("SELECT * FROM tbuser WHERE email = ? AND password = ?;");
    $stmt->bind_param("ss", $cemail, $cpassword);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if returned data row is above 0
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['user'] = $row['email'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['level'] = $row['level'];
        $_SESSION['uid'] = $row['uid'];

        // Arahkan ke halaman sesuai level
        if ($_SESSION['level'] == 1) { // Admin
            header("Location: /sekolah/admin/index.php");
        } elseif ($_SESSION['level'] == 2) { // Guru
            header("Location: /sekolah/guru/index.php");
        } elseif ($_SESSION['level'] == 3) { // Siswa
            header("Location: /sekolah/siswa/index.php");
        }
        exit;
    } else {
        $error_message = 'Email atau password salah';
    }

    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="./assets/img/sekolah/favicon_web.ico" type="image/x-icon"/>
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .login-container {
            max-width: 400px;
            margin: 80px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        .login-title {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }
        .login-form .form-control {
            border-radius: 30px;
            padding: 10px 20px;
        }
        .login-form .btn {
            border-radius: 30px;
            padding: 10px 20px;
            font-size: 16px;
        }
        .alert {
            margin-top: 15px;
            font-size: 14px;
        }
        .login-footer {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
        }
        .login-footer a {
            color: #007bff;
            text-decoration: none;
        }
        .login-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2 class="login-title">Login</h2>
        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger" role="alert">
                <?= htmlspecialchars($error_message); ?>
            </div>
        <?php endif; ?>
        <form class="login-form" action="" method="POST">
            <div class="mb-3">
                <input type="text" name="cEmail" class="form-control" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <input type="password" name="cPassword" class="form-control" placeholder="Password" required>
            </div>
            <div class="mb-3" style="text-align: center;">
                <a href="forgot-password.php">Lupa kata sandi</a>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>
        <div class="login-footer">
            Belum punya akun? Silahkan Hubungi <a href="https://api.whatsapp.com/send?phone=6281297006284">Admin</a> Database Sekolah! 
        </div>
       
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
