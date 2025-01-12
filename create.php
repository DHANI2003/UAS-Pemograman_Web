<?php
require 'db.php'; // Koneksi ke database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $image = $_POST['image'];

    if (!empty($name) && !empty($image)) {
        $stmt = $pdo->prepare("INSERT INTO dishes (name, image) VALUES (:name, :image)");
        $stmt->execute(['name' => $name, 'image' => $image]);
        header('Location: index.php?page=menu'); // Redirect ke halaman menu
        exit;
    } else {
        $error = "Semua bidang harus diisi!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Menu</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Tambah Menu Baru</h2>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    <form method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Nama Menu</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">URL Gambar</label>
            <input type="text" class="form-control" id="image" name="image" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="index.php?page=menu" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>
