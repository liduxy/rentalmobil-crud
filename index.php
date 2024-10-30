<?php
include 'db.php';

$result = mysqli_query($koneksi, "
    SELECT peminjaman.id_pinjam, peminjaman.tgl_pinjam, peminjaman.tgl_kembali,
           mobil.nopol, mobil.merk, pelanggan.nama_pemilik
    FROM peminjaman
    JOIN mobil ON peminjaman.nopol = mobil.nopol
    JOIN pelanggan ON peminjaman.kode_pelanggan = pelanggan.kode_pelanggan
");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Peminjaman Mobil</title>
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

        /* Link Styling */
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
    <a href="admin.php">ADMIN</a>
    <h1>Daftar Peminjaman Mobil</h1>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No Polisi</th>
            <th>Merk Mobil</th>
            <th>Nama Pelanggan</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <tr>
            <td><?= $row['nopol']; ?></td>
            <td><?= $row['merk']; ?></td>
            <td><?= $row['nama_pemilik']; ?></td>
            <td><?= $row['tgl_pinjam']; ?></td>
            <td><?= $row['tgl_kembali']; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
