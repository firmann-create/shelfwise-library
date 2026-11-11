<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($username) || empty($password)) {
        setFlash('error', 'Username dan password wajib diisi.');
        redirect('/login.php');
    }

    // Cari user berdasarkan username
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Cek password (bisa hash maupun teks biasa)
    if ($user) {
        $isPasswordValid = password_verify($password, $user['password']) || ($password === $user['password']);

        if ($isPasswordValid) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'] ?? 'user';

            setFlash('success', 'Berhasil login!');
            redirect('/index.php');
        }
    }

    setFlash('error', 'Username atau password salah.');
    redirect('/login.php');
} else {
    redirect('/login.php');
}