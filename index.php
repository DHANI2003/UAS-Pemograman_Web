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
        } else {
            include 'home.php'; 
        }
        ?>
    </main>
    <footer>
        <p>&copy; 2025 RM Dhani. All rightas reserved.</p>
    </footer>
</body>
</html>
