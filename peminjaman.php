<?php
include 'db.php'; 

// Tambah Peminjaman
if (isset($_POST['tambah'])) {
    $kode_pelanggan = $_POST['kode_pelanggan'];
    $nopol = $_POST['nopol'];
    $tgl_pinjam = $_POST['tgl_pinjam'];
    $tgl_kembali = $_POST['tgl_kembali'];

    $query = "INSERT INTO peminjaman (kode_pelanggan, nopol, tgl_pinjam, tgl_kembali) 
              VALUES ('$kode_pelanggan', '$nopol', '$tgl_pinjam', '$tgl_kembali')";

    if (mysqli_query($koneksi, $query)) {
        echo "Peminjaman berhasil ditambahkan!";
    } else {
        echo "Gagal menambahkan peminjaman: " . mysqli_error($koneksi);
    }
    header("Location: peminjaman.php");
    exit;
}

// Update Peminjaman
if (isset($_POST['update'])) {
    $id_pinjam = $_POST['id_pinjam'];
    $kode_pelanggan = $_POST['kode_pelanggan'];
    $nopol = $_POST['nopol'];
    $tgl_pinjam = $_POST['tgl_pinjam'];
    $tgl_kembali = $_POST['tgl_kembali'];

    $query = "UPDATE peminjaman SET 
              kode_pelanggan='$kode_pelanggan', 
              nopol='$nopol', 
              tgl_pinjam='$tgl_pinjam', 
              tgl_kembali='$tgl_kembali' 
              WHERE id_pinjam='$id_pinjam'";

    if (mysqli_query($koneksi, $query)) {
        echo "Data peminjaman berhasil diperbarui!";
    } else {
        echo "Gagal memperbarui data: " . mysqli_error($koneksi);
    }
    header("Location: peminjaman.php");
    exit;
}

// Hapus Peminjaman
if (isset($_GET['hapus'])) {
    $id_pinjam = $_GET['hapus'];
    $query = "DELETE FROM peminjaman WHERE id_pinjam = '$id_pinjam'";

    if (mysqli_query($koneksi, $query)) {
        echo "Data peminjaman berhasil dihapus!";
    } else {
        echo "Gagal menghapus data: " . mysqli_error($koneksi);
    }
    header("Location: peminjaman.php");
    exit;
}

$mobil = mysqli_query($koneksi, "SELECT nopol, merk FROM mobil");
$pelanggan = mysqli_query($koneksi, "SELECT kode_pelanggan, nama_pemilik FROM pelanggan");

if (isset($_GET['edit'])) {
    $id_pinjam = $_GET['edit'];
    $edit_result = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE id_pinjam = '$id_pinjam'");
    $edit_data = mysqli_fetch_assoc($edit_result);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CRUD Peminjaman</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        h1 {
            color: #333;
            margin-bottom: 20px;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            width: 300px;
            margin-bottom: 30px;
        }
        form label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
            color: #555;
        }
        form input[type="date"], form select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        form button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        form button:hover {
            background-color: #0056b3;
        }
        table {
            width: 80%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        table th {
            background-color: #007bff;
            color: white;
        }
        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        table tr:hover {
            background-color: #e0e0e0;
        }
        a {
            color: #d9534f;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>CRUD Peminjaman</h1>

    <!-- Form Tambah / Edit Peminjaman -->
    <form method="POST">
        <input type="hidden" name="id_pinjam" value="<?= isset($edit_data) ? $edit_data['id_pinjam'] : ''; ?>">
        
        <label>Kode Pelanggan:</label><br>
        <select name="kode_pelanggan" required>
            <option value="">Pilih Pelanggan</option>
            <?php while ($row = mysqli_fetch_assoc($pelanggan)) : ?>
                <option value="<?= $row['kode_pelanggan']; ?>" 
                    <?= isset($edit_data) && $edit_data['kode_pelanggan'] == $row['kode_pelanggan'] ? 'selected' : ''; ?>>
                    <?= $row['nama_pemilik']; ?>
                </option>
            <?php endwhile; ?>
        </select><br>

        <label>Nomer Polisi:</label><br>
        <select name="nopol" required>
            <option value="">Pilih Mobil</option>
            <?php while ($row = mysqli_fetch_assoc($mobil)) : ?>
                <option value="<?= $row['nopol']; ?>" 
                    <?= isset($edit_data) && $edit_data['nopol'] == $row['nopol'] ? 'selected' : ''; ?>>
                    <?= $row['nopol']; ?> - <?= $row['merk']; ?>
                </option>
            <?php endwhile; ?>
        </select><br>

        <label>Tanggal Pinjam:</label><br>
        <input type="date" name="tgl_pinjam" required value="<?= isset($edit_data) ? $edit_data['tgl_pinjam'] : ''; ?>"><br>

        <label>Tanggal Kembali:</label><br>
        <input type="date" name="tgl_kembali" required value="<?= isset($edit_data) ? $edit_data['tgl_kembali'] : ''; ?>"><br><br>

        <button type="submit" name="<?= isset($edit_data) ? 'update' : 'tambah'; ?>">
            <?= isset($edit_data) ? 'Update Peminjaman' : 'Tambah Peminjaman'; ?>
        </button>
    </form>

    <hr>

    <!-- Tabel Daftar Peminjaman -->
    <h2>Daftar Peminjaman</h2>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>ID Peminjaman</th>
            <th>Kode Pelanggan</th>
            <th>Nomer Polisi</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Aksi</th>
        </tr>

        <?php
        $result = mysqli_query($koneksi, "SELECT * FROM peminjaman");
        while ($row = mysqli_fetch_assoc($result)) :
        ?>
        <tr>
            <td><?= $row['id_pinjam']; ?></td>
            <td><?= $row['kode_pelanggan']; ?></td>
            <td><?= $row['nopol']; ?></td>
            <td><?= $row['tgl_pinjam']; ?></td>
            <td><?= $row['tgl_kembali']; ?></td>
            <td>
                <a href="peminjaman.php?edit=<?= $row['id_pinjam']; ?>">Edit</a> |
                <a href="peminjaman.php?hapus=<?= $row['id_pinjam']; ?>" 
                   onclick="return confirm('Yakin ingin menghapus peminjaman ini?');">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
