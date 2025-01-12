<?php
require 'db.php'; // Koneksi ke database

if (!isset($_GET['id'])) {
    header('Location: index.php?page=menu');
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM dishes WHERE id = :id");
$stmt->execute(['id' => $id]);

header('Location: index.php?page=menu');
exit;
?>
