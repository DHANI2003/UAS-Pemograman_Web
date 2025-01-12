<?php
$dishes = [
        ["image" => "image/1.jpeg", "name" => "Nasi Goreng Spesial"],
        ["image" => "image/3.jpeg", "name" => "Spaghetti Carbonara"],
        ["image" => "image/4.jpeg", "name" => "Salad Buah Segar"],
        ["image" => "image/5.jpeg", "name" => "Bakso Kuah Lezat"],
        ["image" => "image/6.jpeg", "name" => "Soto Ayam"],
        ["image" => "image/7.jpeg", "name" => "Es Teh Manis"],
        ["image" => "image/8.jpeg", "name" => "Boba Milk Tea"],
        ["image" => "image/9.jpeg", "name" => "Lemon Tea"],
        ["image" => "image/10.jpeg", "name" => "Matcha Latte"],
];
?>

<div class="menu-container">
    <h2>Menu</h2>
    <div class="menu-grid">
        <?php foreach ($dishes as $dish): ?>
        <div class="menu-item">
            <img src="<?= $dish['image'] ?>" alt="<?= $dish['name'] ?>">
            <p><?= $dish['name'] ?></p>
            <a href="details.php?name=<?= urlencode($dish['name']) ?>" class="btn">Detail</a>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<?php
$host = 'localhost';
$user = 'root';
$password = ''; // Ubah jika Anda menggunakan password
$dbname = 'makanan_db';

// Koneksi database
$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        $name = $conn->real_escape_string($_POST['name']);
        $description = $conn->real_escape_string($_POST['description']);
        $conn->query("INSERT INTO makanan (name, description) VALUES ('$name', '$description')");
    } elseif (isset($_POST['update'])) {
        $id = (int)$_POST['id'];
        $name = $conn->real_escape_string($_POST['name']);
        $description = $conn->real_escape_string($_POST['description']);
        $conn->query("UPDATE makanan SET name = '$name', description = '$description' WHERE id = $id");
    } elseif (isset($_POST['delete'])) {
        $id = (int)$_POST['id'];
        $conn->query("DELETE FROM makanan WHERE id = $id");
    }
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

// Fetch data
$result = $conn->query("SELECT * FROM makanan");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Makanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .details-card {
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 20px;
            max-width: 400px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin: auto;
        }
        .details-title {
            font-size: 24px;
            margin-bottom: 15px;
            font-weight: bold;
        }
        .details-description {
            margin-bottom: 15px;
            font-size: 16px;
        }
        .btn-tambah {
            background-color: #007bff;
            color: white;
        }
        footer {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4 text-center">Dhani Kuliner</h1>

   