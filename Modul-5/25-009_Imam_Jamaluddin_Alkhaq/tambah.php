<?php include ('config.php');
if (isset($_POST['simpan'])) {
	$nama = $_POST['nama'];
	$telp = $_POST['telp'];
    $alamat = $_POST['alamat'];
    $sql = "INSERT INTO supplier (nama, telp, alamat) VALUE ('$nama', '$telp', '$alamat')";
    $query = mysqli_query($conn, $sql);
     if ($query) {
            header('Location: index.php?status=sukses');
        } else {
            header('Location: index.php?status=gagal');
    }

}
?>
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
        form {
        	padding: 30px;
            max-width: 400px;
            margin: 20px auto;
            font-family: sans-serif;
        }
        form p {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        form label {
            width: 80px;
            font-weight: bold;
        }
        form input {
            flex: 1;
            padding: 8px;
            border-radius: 4px;
            box-sizing: border-box;
        }
         button {
            padding: 8px 15px;
            border-radius: 4px;
            margin: 3px;
        }
        #b1{
        	background-color: green;
        	color:white;
        }
        #b2{
        	background-color: red;
        	color:white;
        }

    </style>
</head>

<body>
    <?php require 'navbar.html' ?>
    <h1>Tambah Data Master Supplier Baru</h1>
    <form method="POST">
        <p>
            <label class="input" for="nama">Nama: </label>
            <input type="text" name="nama" placeholder="nama supplier" required />
        </p>
        <p>
            <label for="telp">Telp: </label>
            <input type="tel" name="telp" placeholder="nomor telepon" required />
        </p>
        <p>
            <label for="alamat">alamat: </label>
            <input type="text" name="alamat" placeholder="alamat" required />
        </p>
        <p>
            <button id="b1" type="submit" name="simpan">Simpan</button>
            <a href="index.php"><button id="b2" type="button">batal</button></a>
        </p>
    </form>
</body>

</html>