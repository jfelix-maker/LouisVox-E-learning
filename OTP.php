<?php
session_start();
require_once "config.php"; // Pastikan file config.php ada untuk koneksi database
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Pastikan PHPMailer sudah diinstal menggunakan Composer

$email = $_SESSION['email']; // Email yang dimasukkan oleh pengguna
$otp = $_SESSION['otp']; // OTP yang dimasukkan oleh pengguna

// Proses kirim OTP
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cEmail'])) {
	$cemail = htmlspecialchars(trim($_POST["cEmail"])); // Trim dan sanitasi input email

	// Periksa apakah email terdaftar di database
	$stmt = $conn->prepare("SELECT * FROM tbuser WHERE email = ?");
	$stmt->bind_param("s", $cemail);
	$stmt->execute();
	$result = $stmt->get_result();

	// Jika email ditemukan
	if ($result->num_rows > 0) {
		$current_time = time();
		$otp_expiry = 1000 * 60 * 10; // 10 menit dalam detik
		$row = $result->fetch_assoc();
		
		// Ambil OTP dari database
		$stmt = $conn->prepare("SELECT  otp, otp_expiration, status FROM tbuser WHERE email = ? AND status = 'unused'");
		$stmt->bind_param("s", $cemail);
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($otp, $otp_expiration, $status);
		$stmt->fetch();
		$stmt->close();
		
		// Check for OTP Code Expiration
		if (($current_time - $otp_time) > $otp_expiry) {
			echo "OTP has expired. Please request a new one.";
		}
		elseif ($entered_otp == $otp) {
			// OTP cocok dan belum kedaluwarsa
			echo "OTP verified successfully!";

			$update_stmt = $conn->prepare("UPDATE tbuser SET status = 'used' WHERE email = ?");
			$update_stmt->bind_param("s", $email);
			$update_stmt->execute();
			$update_stmt->close();
		}
		else {
			echo "Invalid OTP. Please try again.";
		}
	}
	// else echo "Invalid or expired OTP.";
//         // Kirim OTP ke email menggunakan PHPMailer
//     $mail = new PHPMailer(true);
//     try {
//         // Server settings
//         $mail->isSMTP();
//         $mail->Host = 'smtp.gmail.com';  // Set the SMTP server to Gmail
//         $mail->SMTPAuth = true;
//         $mail->Username = 'violetteror66@gmail.com'; // Ganti dengan email Anda
//         $mail->Password = 'ktlg cbam bhlt etno'; // Ganti dengan app password Anda
//         $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
//         $mail->Port = 587;
		
//         // Recipients
//         $mail->setFrom('violetteror66@gmail.com', 'No Reply');
//         $mail->addAddress($cemail); // Menambahkan penerima

//         // Content
//         $mail->isHTML(true);
//         $mail->Subject = 'Your OTP Code';
//         $mail->Body    = 'Your OTP code is: ' . $otp;

//         // Send email
//         $mail->send();

//         $success_message = "OTP telah dikirim ke email Anda. Silahkan cek inbox atau folder spam.";
//     }
//     catch (Exception $e) {
//         $error_message = "Gagal mengirim OTP ke email. Coba lagi nanti. Error: {$mail->ErrorInfo}";
//     }

//     // Tampilkan pesan sukses atau error
//     if (isset($success_message)) {
//         echo '<div class="alert alert-success" role="alert">' . htmlspecialchars($success_message) . '</div>';
//     }
//     else if (isset($error_message)) {
//         echo '<div class="alert alert-danger" role="alert">' . htmlspecialchars($error_message) . '</div>';
//     }
//     $stmt->close();
// }
// else {
//     $error_message = 'Email tidak ditemukan di sistem.';
// }
}
// Proses verifikasi OTP
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['otp'])) {
	$str_otp = htmlspecialchars(trim($_POST["otp"]));
	$inputOtp = settype($str_otp, "int"); // Trim dan sanitasi input OTP
	
	// Verifikasi OTP
	if ($inputOtp === $_SESSION['otp']) {
		// echo "<script>alert('Redirect!');</script>";
		// OTP valid, lanjut ke halaman perubahan password
		header("Location: change-pass.php");
		exit();
	} else {
		$error_message = 'OTP yang Anda masukkan salah. Silahkan coba lagi.';
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Input OTP</title>
	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container" style="max-width: 400px; margin-top: 100px; display: flex; flex-direction: column; gap: 8px;">
		<h2 class="text-center">Input OTP</h2>

		<!-- Menampilkan pesan error atau sukses -->
		<?php if (isset($error_message)): ?>
			<div class="alert alert-danger" role="alert">
				<?= htmlspecialchars($error_message); ?>
			</div>
		<?php endif; ?>
		<?php if (isset($success_message)): ?>
			<div class="alert alert-success" role="alert">
				<?= htmlspecialchars($success_message); ?>
			</div>
		<?php endif; ?>

		<!-- Form input OTP -->
		<form action="" method="POST">
		<!-- <?= $inputOtp ?> -->
		<?= $_SESSION['otp'] ?>
			<div class="mb-3">
				<input type="text" name="otp" class="form-control" placeholder="Masukkan kode OTP" required>
			</div>
			<button type="submit" class="btn btn-primary">Verifikasi</button>
		</form>
	</div>

	<!-- Bootstrap JS -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
