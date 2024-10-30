<?php
include 'db.php';

$mobil = mysqli_query($koneksi, "SELECT nopol, nama_pemilik, merk, type, jenis, tahun_pembuatan, warna FROM mobil");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mobil</title>
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
    <h1>Daftar Mobil</h1>

    <!-- Tabel Menampilkan Data Mobil -->
    <table>
        <tr>
            <th>No. Polisi</th>
            <th>Nama Pemilik</th>
            <th>Merk</th>
            <th>Tipe</th>
            <th>Jenis</th>
            <th>Tahun Pembuatan</th>
            <th>Warna</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($mobil)) : ?>
        <tr>
            <td><?= htmlspecialchars($row['nopol']); ?></td>
            <td><?= htmlspecialchars($row['nama_pemilik']); ?></td>
            <td><?= htmlspecialchars($row['merk']); ?></td>
            <td><?= htmlspecialchars($row['type']); ?></td>
            <td><?= htmlspecialchars($row['jenis']); ?></td>
            <td><?= htmlspecialchars($row['tahun_pembuatan']); ?></td>
            <td><?= htmlspecialchars($row['warna']); ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
