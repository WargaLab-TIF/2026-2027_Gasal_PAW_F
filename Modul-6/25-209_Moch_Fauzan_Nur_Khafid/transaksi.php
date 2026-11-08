<?php
include('koneksi.php');

//variabel awal
$id = null;
$master = null;
$hasild = null;
$hasilb = null;


//id transaksi
if(isset($_GET['id'])){
    $id = (int)$_GET['id'];
};

//tambah detail
if($id > 0 && isset($_GET['gas'])){
    $idb = (int)$_GET['idb'];
    $qty = (int)$_GET['qty'];

    if($idb > 0 && $qty > 0){
        $qh = mysqli_query($con,"select harga from barang where id = $idb");
        $rh = mysqli_fetch_assoc($qh);

        if($rh){
            $harga = $rh['harga'];
            $sqlt = "insert into transaksi_detail(transaksi_id,barang_id,harga,qty)
            values($id,$idb,$harga,$qty)";
            mysqli_query($con,$sqlt);

            //update total
            $sqlu = "update transaksi
            set total = (select sum(harga * qty) from transaksi_detail where transaksi_id = $id)
            where id = $id";
            mysqli_query($con,$sqlu);
        }
    }
}

if($id >0){
    //master
    $sqlm = "select * from transaksi where id = $id";
    $hasilm = mysqli_query($con,$sqlm);

    $master = mysqli_fetch_assoc($hasilm);

    //detail
    $sqld = "SELECT d.*,b.nama_barang from transaksi_detail d, barang b 
where transaksi_id = $id and id = barang_id";
    $hasild = mysqli_query($con,$sqld);

    //barang
    $sqlb = "select * from barang
             where id not in (select barang_id from transaksi_detail where transaksi_id = $id)";
    $hasilb = mysqli_query($con,$sqlb);
}


//daftar transaksi
$sql = "select * from transaksi";
$hasil = mysqli_query($con,$sql);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <style>

        body{
            background-color: #f3f5f7;
            color: white;
        }
        .master{
            background-color: #e3f0f5;
            width: 500px;
            margin-top: 50px;
            height: 200px;
            display: flex;
            justify-content: top;
            align-items: center;
            flex-direction: column;
            color: white;
        }

        .masterd{
            margin-top: 10px;
            background-color: cadetblue;
            color: red;
            
            width: 500px;
            height: 300px;
            display: flex;
            justify-content: top;
            align-items: center;
            flex-direction: column;
        }
    </style>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p style="color: black;">Tabel barang >  <a href="barang.php">barang</a></p>

    <div class="dropdown" style="color: #1f2933;">
        <form method="get" action="">
            <label>PILIH TRANSAKSI</label>

            <select name="id">
                <option value="">Pilih</option>
                <?php
                while($pilih = mysqli_fetch_assoc($hasil)){
                    echo '<option value="' . $pilih['id'] . '">';
                    echo "[ "."ID : ".$pilih['id'] ."] "." "." Waktu :" .$pilih['waktu_transaksi'];
                    echo "</option>";
                };
                ?>
            </select>
            <button type="submit">Load</button>
        </form>
    </div>

    <?php if(isset($master)){ ?>
        <!-- master -->
        <div class="master" style="background-color: #e3f0f5; color: #1f2933; border: 6px solid #2f7f8f; height: auto; padding: 8px 16px 20px 16px;">
            <h4 style="color: #2f7f8f;">Master data</h4>
            <table border="1px" cellpadding = 4 cellspacing=0 >
                <tr style="background-color: #2f7f8f; color: white;">
                    <th>id</th>
                    <th>waktu transaksi </th>
                    <th>keterangan</th>
                    <th>total</th>
                    <th>pelanggan id</th>
                </tr>
                <tr style="background-color: white; color: #1f2933;">
                    <td><?= $master['id'] ?></td>
                    <td><?= $master['waktu_transaksi'] ?></td>
                    <td><?= $master['keterangan'] ?></td>
                    <td><?= $master['total'] ?></td>
                    <td><?= $master['pelanggan_id'] ?></td>
                </tr>
            </table>
        </div>



        <!-- detail -->
        <div class="masterd" style="background-color: #fdf1e3; color: #1f2933; border: 6px solid #c96f1a; height: auto; padding: 8px 16px 20px 16px;">
            <h4 style="color: #c96f1a;">Detail</h4>
            <table border="1px" cellspacing=0 cellpadding= 4 >
                <tr style="background-color: #c96f1a; color: white;">
                    <th>ID Transaksi</th>
                    <th>ID Barang</th>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th>qty</th>
                </tr>

                <?php
                while($baris = mysqli_fetch_assoc($hasild)){
                    echo "<tr style='background-color: white; color: #1f2933;'>";

                    echo "<td>";
                    echo $baris['transaksi_id'];
                    echo "</td>";

                    echo "<td>";
                    echo $baris['barang_id'];
                    echo "</td>";

                    echo "<td>";
                    echo $baris['nama_barang'];
                    echo "</td>";

                    echo "<td>";
                    echo $baris['harga'];
                    echo "</td>";

                    echo "<td>";
                    echo $baris['qty'];
                    echo "</td>";

                    echo "</tr>";
                }
                ?>
            </table>



      
            <!-- form tambah detail -->
            <div class="tambah" style=" color:white; background-color: #2f7f8f; margin-top: 30px; width:270px; height: 300px;">
                <h3 style="text-align: center;">Tambah detail</h3>
                <form method="get" action="">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <label>Pilih barang :</label>
                    <select name="idb">
                        <option value="">Pilih</option>
                        <?php
                       while($barisb = mysqli_fetch_assoc($hasilb)){
                        echo '<option value="' . $barisb['id'] . '">'
                            . '[' . $barisb['id'] . '] ' . $barisb['nama_barang']
                            . '</option>';
                    }
                        ?>
                    </select>
                    <br><br>
                    <label>Jumlah : </label>
                    <input type="number" name="qty">
                    <br><br>
                    <button type="input" name="gas">Tambah</button>
                </form>
            </div>
        </div>
    <?php } ?>


</body>
</html>
