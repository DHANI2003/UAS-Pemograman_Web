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
$totalMakanan = $conn->query("SELECT COUNT(*) as total FROM makanan")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dhani Kuliner</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .details-card {
            border: 1px solid #17a2b8;
            border-radius: 10px;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .btn-tambah {
            background-color: #17a2b8;
            color: white;
        }
        .btn-tambah:hover {
            background-color: #138496;
        }
        .total-card {
            background-color: #ffc107;
            color: #fff;
            padding: 20px;
            border-radius: 10px;
            font-weight: bold;
            text-align: center;
        }
        .card-header {
            background-color: #343a40;
            color: white;
        }
        .badge {
            font-size: 1rem;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4 text-center text-primary fw-bold">Dhani Kuliner</h1>

    <!-- Add Data Form -->
    <div class="details-card mb-4">
        <h2 class="details-title text-info">Tambah Makanan</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="name" class="form-label fw-bold">Nama:</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama makanan" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label fw-bold">Deskripsi:</label>
                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Masukkan deskripsi makanan" required></textarea>
            </div>
            <button type="submit" name="add" class="btn btn-tambah btn-lg w-100">Tambah</button>
        </form>
    </div>

    <!-- Total Makanan -->
    <div class="total-card mb-4">
        Total List Makanan: <span class="badge bg-dark"><?= $totalMakanan ?> item</span>
    </div>

    <!-- Data Table -->
    <div class="card">
        <div class="card-header text-center">List of Makanan</div>
        <div class="card-body">
            <table class="table table-bordered table-striped text-center">
                <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= htmlspecialchars($row['name']) ?></td>
                        <td><?= htmlspecialchars($row['description']) ?></td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?= $row['id'] ?>">Edit</button>
                            <form method="POST" class="d-inline">
                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                <button type="submit" name="delete" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal<?= $row['id'] ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-warning text-white">
                                    <h5 class="modal-title" id="editModalLabel">Edit Makanan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST">
                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Nama:</label>
                                            <input type="text" class="form-control" name="name" value="<?= htmlspecialchars($row['name']) ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Deskripsi:</label>
                                            <textarea class="form-control" name="description" required><?= htmlspecialchars($row['description']) ?></textarea>
                                        </div>
                                        <button type="submit" name="update" class="btn btn-success w-100">Simpan Perubahan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
