<?php include ('config.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        h1{
            margin: 20px;
        }
        table {
        margin: 20px;
        border-collapse: collapse;
    }

    .judul{
        background: blueviolet;
    }

    tr,
    td,
    th {
        border: 1px solid black;

    }

    td,
    th{
        padding: 15px;
    }

    button {
        padding: 10px;
        margin: 3px;
    }
    .tambah{
        border: none;
        background: none;
        text-align: right;
    }
    .tambah td {
        border: none;
        background: none;
    }
    button{
        border-radius: 4px;
    }
    #b1{
        background-color: green;
        color:white;
    }
    #b2{
        background-color: orange;
        color:white;
    }
    #b3{
        background-color: red;
        color:white;
    }

    </style>
</head>
<?php require 'navbar.html' ?>
<h1>
    Data Master Supplier
</h1>
<div id="tambah">
    <table>
        <thead>
            <tr class="tambah">
                <td colspan="5">
                    <a href="tambah.php"><button type="button" id='b1'>tambah data</button></a>
                </td>
            </tr>
            <tr class="judul">
                <th>No</th>
                <th>Nama</th>
                <th>telepon</th>
                <th>alamat</th>
                <th>tindakan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT id,nama,telp,alamat FROM supplier;";
            $query= mysqli_query($conn, $sql);
            $no=1;
            while ($toko = mysqli_fetch_array($query) ) {
            echo '<tr>';
            echo '<td>' . $no++ . '</td>';
            echo '<td>' . $toko['nama'] . '</td>';
            echo '<td>' . $toko['telp'] . '</td>';
            echo '<td>' . $toko['alamat'] . '</td>';

           echo '<td>';
                    echo "<a href='edit.php?id=" . $toko['id'] . "'><button type='button' id='b2'>Edit</button></a> ";
                    echo "<a href='hapus.php?id=" . $toko['id'] . "' onclick=\"return confirm('Anda yakin akan menghapus supplier ini?');\">
                    <button type='button' id='b3'>Hapus</button></a>";
                    echo '</td>';
            echo '</tr>';
            }
             ?>
        </tbody>
    </table>

    <body>
    </body>

</html>