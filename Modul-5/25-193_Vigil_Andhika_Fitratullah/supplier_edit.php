<?php
include 'koneksi.php';
$id = (int)$_GET['id'];

if (isset($_POST['update'])) {
    $stmt = mysqli_prepare($conn, "UPDATE supplier SET nama=?, telp=?, alamat=? WHERE id=?");
    mysqli_stmt_bind_param($stmt, "sssi", $_POST['nama'], $_POST['telp'], $_POST['alamat'], $id);
    mysqli_stmt_execute($stmt);
    header("Location: supplier.php");
    exit;
}

$r = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM supplier WHERE id=$id"));
if (!$r) {
    header("Location: supplier.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Edit Supplier</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container">
  <h3 style="color:#337ab7">Edit Data Master Supplier</h3>
  <hr>
  <form method="post" class="form-horizontal">
    <div class="form-group">
      <label class="col-sm-3 control-label">Nama</label>
      <div class="col-sm-6">
        <input type="text" name="nama" class="form-control" maxlength="100" value="<?= htmlspecialchars($r['nama']) ?>" required>
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-3 control-label">Telp</label>
      <div class="col-sm-4">
        <input type="text" name="telp" class="form-control" maxlength="12" value="<?= htmlspecialchars($r['telp']) ?>" required>
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-3 control-label">Alamat</label>
      <div class="col-sm-4">
        <input type="text" name="alamat" class="form-control" value="<?= htmlspecialchars($r['alamat']) ?>" required>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-3 col-sm-6">
        <button type="submit" name="update" class="btn btn-success">Update</button>
        <a href="supplier.php" class="btn btn-danger">Batal</a>
      </div>
    </div>
  </form>
</div>
</body>
</html>