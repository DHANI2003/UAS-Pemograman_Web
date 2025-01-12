<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RM Dhani</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="top-bar"></div>
        <div class="logo">
            <h1><span class="brand-highlight">Dhani</span> Kuliner</h1>
        </div>
        <nav>
            <ul>
                <li><a href="index.php?page=home" class="<?= isset($_GET['page']) && $_GET['page'] == 'home' ? 'active' : '' ?>">Home</a></li>
                <li><a href="index.php?page=about" class="<?= isset($_GET['page']) && $_GET['page'] == 'about' ? 'active' : '' ?>">About Us</a></li>
                <li><a href="index.php?page=menu" class="<?= isset($_GET['page']) && $_GET['page'] == 'menu' ? 'active' : '' ?>">Menu</a></li>
                <li><a href="index.php?page=contact" class="<?= isset($_GET['page']) && $_GET['page'] == 'contact' ? 'active' : '' ?>">Contact</a></li>
                <li><a href="index.php?page=update" class="<?= isset($_GET['page']) && $_GET['page'] == 'update' ? 'active' : '' ?>">UPDATE</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <?php
        // Load halaman berdasarkan parameter URL "page"
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
            switch ($page) {
                case 'home':
                    include 'home.php';
                    break;
                case 'about':
                    include 'about.php';
                    break;
                case 'menu':
                    include 'menu.php';
                    break;
                case 'contact':
                    include 'contact.php';
                    break;
                case 'update':
                    include 'update.php';
                    break;
                default:
                    echo "<h2>Halaman tidak ditemukan.</h2>";
            }
        } 
        ?>
    </main>
    

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Makanan</title>
    <!-- Menggunakan font dari Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0; 
            background-color: #f9f9f9;
            color: #333;
        }

        .details-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 80vh;
            padding: 20px;
        }

        .details-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 500px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .details-card:hover {
            transform: translateY(-10px); /* Menambahkan efek hover */
        }

        .details-image {
            max-width: 100%;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .details-title {
            font-size: 30px;
            font-weight: 600;
            margin-bottom: 15px;
            color: #222;
            text-transform: uppercase;
        }

        .details-description {
            font-size: 18px;
            color: #555;
            line-height: 1.6;
            margin-bottom: 25px;
        }

        .details-buttons {
            display: flex;
            justify-content: space-evenly;
        }

        .btn {
            padding: 12px 30px;
            text-decoration: none;
            font-size: 16px;
            font-weight: 600;
            border-radius: 30px;
            text-transform: uppercase;
            transition: all 0.3s ease;
        }

        .btn-edit {
            background-color: #007bff;
            color: white;
        }

        .btn-edit:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        .btn-delete {
            background-color: #ff4d4d;
            color: white;
        }

        .btn-delete:hover {
            background-color: #e60000;
            transform: scale(1.05);
        }
    </style>
</head>
<body>

<?php
$dishes = [
    "Nasi Goreng Spesial" => ["image" => "image/1.jpeg", "description" => "Nasi goreng lezat dengan topping istimewa."],
    "Spaghetti Carbonara" => ["image" => "image/3.jpeg", "description" => "Spaghetti creamy dengan daging asap."],
    "Salad Buah Segar" => ["image" => "image/4.jpeg", "description" => "Campuran buah segar dengan saus krim manis yang menyegarkan."],
    "Bakso Kuah Lezat" => ["image" => "image/5.jpeg", "description" => "Bakso daging sapi kenyal disajikan dengan kuah kaldu gurih, tahu, dan bihun."],
    "Soto Ayam" => ["image" => "image/6.jpeg", "description" => "Sup ayam tradisional dengan kuah kaya rempah, bihun, dan telur rebus."],
    "Es Teh Manis" => ["image" => "image/7.jpeg", "description" => "Teh hitam manis yang disajikan dingin dengan es batu, cocok untuk cuaca panas."],
    "Boba Milk Tea" => ["image" => "image/8.jpeg", "description" => "Teh susu dengan bola tapioka kenyal yang manis dan creamy."],
    "Lemon Tea" => ["image" => "image/9.jpeg", "description" => "Teh hitam dengan perasan lemon segar yang manis dan asam."],
    "Matcha Latte" => ["image" => "image/10.jpeg", "description" => "Teh hijau matcha yang dicampur dengan susu hangat, memiliki aroma khas dan kaya rasa."],
    // Tambahkan data lainnya...
];

// Ambil nama makanan dari parameter URL
$name = $_GET['name'] ?? null;

if ($name && isset($dishes[$name])) {
    $dish = $dishes[$name];
    echo "<div class='details-container'>";
    echo "<div class='details-card'>";
    echo "<div class='details-title'>{$name}</div>";
    echo "<img class='details-image' src='{$dish['image']}' alt='{$name}'>";
    echo "<div class='details-description'>{$dish['description']}</div>";
   
}
?>

</body>
</html>