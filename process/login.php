<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $ingat    = isset($_POST['ingat']);

    if (empty($username) || empty($password)) {
        setFlash('error', 'Username dan password wajib diisi.');
        redirect('/login.php');
    }

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    $isPasswordValid = false;
    if ($user) {
        $isPasswordValid = password_verify($password, $user['password']) || ($password === $user['password']);
    }

    if ($user && $isPasswordValid) {
        $_SESSION['user_id']   = $user['id'];
        $_SESSION['username']  = $user['username'];
        $_SESSION['role']      = $user['role'] ?? 'user';
        $_SESSION['nama']      = $user['nama'] ?? $user['username'];

        if ($ingat) {
            setcookie('ingat_username', $username, time() + (86400 * 30), "/");
        } else {
            setcookie('ingat_username', '', time() - 3600, "/");
        }

        setFlash('success', 'Berhasil masuk!');
        redirect('/index.php');
    } else {
        setFlash('error', 'Username atau password salah.');
        redirect('/login.php');
    }
} else {
    redirect('/login.php');
}