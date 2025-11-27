<!DOCTYPE html>
<html>
<head>
    <title>diary learning</title>
</head>
<body>

<h2>data modul</h2>

<table border="1" cellpadding="6">
    <tr>
        <th>entri ID</th>
        <th>pengguna ID</th>
        <th>tanggal entri</th>
        <th>konten teks</th>
        <th>jumlah kata</th>
        <th>waktu</th>
    <?php foreach ($data as $row): ?>
        <tr>
            <td><?= $row['entri_id'] ?></td>
            <td><?= $row['pengguna_id'] ?></td>
            <td><?= $row['tanggal_entri'] ?></td>
            <td><?= $row['konten_teks'] ?></td>
            <td><?= $row['jumlah_kata'] ?></td>
            <td><?= $row['waktu_dihabiskan_menit'] ?></td>
        </tr>
    <?php endforeach; ?>

</table>

</body>
</html>
