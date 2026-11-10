<?php
const DB_HOST = 'localhost';
const DB_NAME = 'shelfwise-library';
const DB_USER = 'root';
const DB_PASS = '';
const BASE_URL = 'http://localhost/shelfwise-library';

try {
    $pdo = new PDO(
        'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4',
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
} catch (PDOException $e) {
    exit('Koneksi database gagal: ' . $e->getMessage());
}