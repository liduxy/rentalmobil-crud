<?php
include 'db.php';

// Tambah Pelanggan
if (isset($_POST['tambah'])) {
    var_dump($_POST);
    $kode_pelanggan = mysqli_real_escape_string($koneksi, $_POST['kode_pelanggan']);
    $nama_pemilik = mysqli_real_escape_string($koneksi, $_POST['nama_pemilik']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $telp = mysqli_real_escape_string($koneksi, $_POST['telp']);

    $query = "INSERT INTO pelanggan (kode_pelanggan, nama_pemilik, alamat, telp) 
              VALUES ('$kode_pelanggan', '$nama_pemilik', '$alamat', '$telp')";

    if (mysqli_query($koneksi, $query)) {
        echo "Pelanggan berhasil ditambahkan!";
    } else {
        echo "Gagal menambahkan pelanggan: " . mysqli_error($koneksi);
    }
    header("Location: pelanggan.php");
    exit;
}

// Edit Pelanggan
if (isset($_POST['update'])) {
    $kode_pelanggan = mysqli_real_escape_string($koneksi, $_POST['kode_pelanggan']);
    $nama_pemilik = mysqli_real_escape_string($koneksi, $_POST['nama_pemilik']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $telp = mysqli_real_escape_string($koneksi, $_POST['telp']);

    $query = "UPDATE pelanggan SET 
              nama_pemilik = '$nama_pemilik', alamat = '$alamat', telp = '$telp'
              WHERE kode_pelanggan = '$kode_pelanggan'";

    if (mysqli_query($koneksi, $query)) {
        echo "Data pelanggan berhasil diupdate!";
    } else {
        echo "Gagal mengupdate data: " . mysqli_error($koneksi);
    }
    header("Location: pelanggan.php");
    exit;
}

// Hapus Pelanggan
if (isset($_GET['hapus'])) {
    $kode_pelanggan = mysqli_real_escape_string($koneksi, $_GET['hapus']);
    $query = "DELETE FROM pelanggan WHERE kode_pelanggan = '$kode_pelanggan'";

    if (mysqli_query($koneksi, $query)) {
        echo "Data pelanggan berhasil dihapus!";
    } else {
        echo "Gagal menghapus data: " . mysqli_error($koneksi);
    }
    header("Location: pelanggan.php");
    exit;
}

$edit = false;
if (isset($_GET['edit'])) {
    $kode_pelanggan = mysqli_real_escape_string($koneksi, $_GET['edit']);
    $result = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE kode_pelanggan = '$kode_pelanggan'");
    $data = mysqli_fetch_assoc($result);
    $edit = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CRUD Pelanggan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0;
            padding: 20px;
        }

        h1, h2 {
            color: #333;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            margin-bottom: 30px;
        }

        form label {
            font-weight: bold;
            color: #555;
            margin-top: 10px;
            display: block;
        }

        form input[type="text"],
        form textarea,
        form button {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        form textarea {
            resize: vertical;
        }

        form button {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }

        form button:hover {
            background-color: #0056b3;
        }

        table {
            width: 90%;
            max-width: 800px;
            margin: 20px 0;
            border-collapse: collapse;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        table th, table td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        a {
            color: #d9534f;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>CRUD Pelanggan</h1>

    <form method="POST">
        <label>Kode Pelanggan:</label><br>
        <input type="text" name="kode_pelanggan" 
               value="<?= $edit ? $data['kode_pelanggan'] : ''; ?>" 
               <?= $edit ? 'readonly' : ''; ?> required><br>

        <label>Nama Pemilik:</label><br>
        <input type="text" name="nama_pemilik" 
               value="<?= $edit ? $data['nama_pemilik'] : ''; ?>" required><br>

        <label>Alamat:</label><br>
        <textarea name="alamat" required><?= $edit ? $data['alamat'] : ''; ?></textarea><br>

        <label>No. Telepon:</label><br>
        <input type="text" name="telp" 
       value="<?= $edit ? $data['telp'] : ''; ?>" 
       required pattern="\d+" maxlength="15"><br><br>

        <?php if ($edit): ?>
            <button type="submit" name="update">Update Pelanggan</button>
        <?php else: ?>
            <button type="submit" name="tambah">Tambah Pelanggan</button>
        <?php endif; ?>
    </form>

    <h2>Daftar Pelanggan</h2>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>Kode Pelanggan</th>
            <th>Nama Pemilik</th>
            <th>Alamat</th>
            <th>No. Telepon</th>
            <th>Aksi</th>
        </tr>

        <?php
        $result = mysqli_query($koneksi, "SELECT * FROM pelanggan");
        while ($row = mysqli_fetch_assoc($result)) :
        ?>
        <tr>
            <td><?= $row['kode_pelanggan']; ?></td>
            <td><?= $row['nama_pemilik']; ?></td>
            <td><?= $row['alamat']; ?></td>
            <td><?= $row['telp']; ?></td>
            <td>
                <a href="pelanggan.php?edit=<?= $row['kode_pelanggan']; ?>">Edit</a> |
                <a href="pelanggan.php?hapus=<?= $row['kode_pelanggan']; ?>" 
                   onclick="return confirm('Yakin ingin menghapus?');">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
