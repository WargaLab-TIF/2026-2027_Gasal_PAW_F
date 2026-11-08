<?php
include 'koneksi.php';
$transaksi_id = isset($_GET['id']) ? intval($_GET['id']) : 1;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Detail Transaksi</title>
    <style>
        :root { 
            --primary: #4f46e5; 
            --primary-hover: #4338ca; 
            --bg: #f8fafc; 
            --card-bg: #ffffff; 
            --text: #1e293b; 
            --text-muted: #64748b; 
            --border: #e2e8f0; 
        }
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            background: var(--bg); 
            color: var(--text); 
            margin: 0; 
            padding: 30px; 
        }
        .container { 
            max-width: 950px; 
            margin: 0 auto; 
            background: var(--card-bg); 
            padding: 35px; 
            border-radius: 16px; 
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -4px rgba(0, 0, 0, 0.05); 
        }
        .nav { 
            margin-bottom: 25px; 
        }
        .nav a { 
            text-decoration: none; 
            padding: 8px 16px; 
            background: #e0e7ff; 
            color: var(--primary); 
            border-radius: 8px; 
            font-weight: 600; 
            font-size: 14px; 
            transition: all 0.2s;
        }
        .nav a:hover {
            background: #c7d2fe;
        }
        .header-title { 
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid var(--border); 
            padding-bottom: 15px; 
            margin-bottom: 25px; 
        }
        .header-title h2 {
            margin: 0;
            font-size: 22px;
            color: #0f172a;
        }
        .badge {
            background: #e0e7ff;
            color: var(--primary);
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
        }
        .form-card {
            background: #f8fafc;
            border: 1px solid var(--border);
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 30px;
        }
        .form-row {
            display: flex;
            gap: 15px;
            align-items: flex-end;
        }
        .form-group { 
            flex: 1;
            margin-bottom: 0; 
        }
        .form-group.small {
            flex: 0 0 130px;
        }
        label { 
            display: block; 
            margin-bottom: 8px; 
            font-weight: 600; 
            font-size: 13px; 
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        select, input { 
            width: 100%; 
            padding: 11px 14px; 
            border: 1px solid var(--border); 
            border-radius: 8px; 
            font-size: 14px; 
            box-sizing: border-box; 
            background: #fff;
            outline: none;
            transition: border-color 0.2s;
        }
        select:focus, input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }
        .btn { 
            background: var(--primary); 
            color: white; 
            border: none; 
            padding: 11px 20px; 
            border-radius: 8px; 
            cursor: pointer; 
            font-weight: 600; 
            font-size: 14px; 
            transition: background 0.2s;
            height: 43px;
        }
        .btn:hover { 
            background: var(--primary-hover); 
        }
        h3 { 
            font-size: 18px; 
            margin: 0 0 15px 0; 
            color: #0f172a;
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 10px; 
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid var(--border);
        }
        th, td { 
            padding: 12px 16px; 
            text-align: left; 
            font-size: 14px; 
        }
        th { 
            background: #f1f5f9; 
            font-weight: 600; 
            color: #475569;
            border-bottom: 1px solid var(--border);
        }
        td {
            border-bottom: 1px solid var(--border);
            color: #334155;
        }
        tr:last-child td {
            border-bottom: none;
        }
        tr:hover td { 
            background: #f8fafc; 
        }
        .total-box { 
            margin-top: 25px; 
            background: #eef2ff;
            border: 1px solid #c7d2fe;
            padding: 16px 20px;
            border-radius: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .total-box span:first-child {
            font-size: 15px;
            color: #4338ca;
            font-weight: 600;
        }
        .total-box span:last-child { 
            font-size: 20px; 
            font-weight: 700; 
            color: #312e81; 
        }
    </style>
</head>
<body>
<div class="container">
    <div class="nav">
        <a href="transaksi.php">&larr; Kembali ke Daftar Transaksi</a>
    </div>

    <div class="header-title">
        <h2>Form Input Detail Transaksi</h2>
        <span class="badge">Transaksi ID: #<?= $transaksi_id; ?></span>
    </div>

    <div class="form-card">
        <form method="POST" action="transaksiProses.php">
            <input type="hidden" name="transaksi_id" value="<?= $transaksi_id; ?>">
            
            <div class="form-row">
                <div class="form-group">
                    <label>Pilih Barang</label>
                    <select name="barang_id" required>
                        <option value="">-- Cari atau Pilih Barang --</option>
                        <?php
                        $q_barang = mysqli_query($koneksi, "SELECT * FROM barang");
                        while ($b = mysqli_fetch_assoc($q_barang)) {
                            $cek = mysqli_query($koneksi, "SELECT * FROM transaksi_detail WHERE transaksi_id='$transaksi_id' AND barang_id='{$b['id']}'");
                            $is_disabled = (mysqli_num_rows($cek) > 0) ? "disabled style='background: #f1f5f9; color: #94a3b8;'" : "";
                            $status_text = (mysqli_num_rows($cek) > 0) ? " (Sudah Dipilih)" : "";
                            
                            echo "<option value='{$b['id']}' $is_disabled>{$b['nama_barang']} — Rp " . number_format($b['harga'], 0, ',', '.') . "$status_text</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group small">
                    <label>Quantity</label>
                    <input type="number" name="qty" value="1" min="1" required>
                </div>

                <div>
                    <button type="submit" name="simpan_detail" class="btn">+ Tambah Item</button>
                </div>
            </div>
        </form>
    </div>

    <h3>Daftar Item pada Transaksi Ini</h3>
    <table>
        <thead>
            <tr>
                <th width="60">No</th>
                <th>Nama Barang</th>
                <th>Harga Satuan</th>
                <th width="80">Qty</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $grand_total = 0;
            $q_detail = mysqli_query($koneksi, "SELECT transaksi_detail.*, barang.nama_barang FROM transaksi_detail JOIN barang ON transaksi_detail.barang_id = barang.id WHERE transaksi_detail.transaksi_id = '$transaksi_id'");
            
            if (mysqli_num_rows($q_detail) > 0) {
                while ($d = mysqli_fetch_assoc($q_detail)) {
                    $subtotal = $d['harga'] * $d['qty'];
                    $grand_total += $subtotal;
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><strong><?= htmlspecialchars($d['nama_barang']); ?></strong></td>
                <td>Rp <?= number_format($d['harga'], 0, ',', '.'); ?></td>
                <td><?= $d['qty']; ?></td>
                <td><strong>Rp <?= number_format($subtotal, 0, ',', '.'); ?></strong></td>
            </tr>
            <?php 
                }
            } else {
                echo "<tr><td colspan='5' style='text-align: center; color: #64748b; padding: 20px;'>Belum ada item ditambahkan ke transaksi ini.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <div class="total-box">
        <span>TOTAL KESELURUHAN TRANSAKSI</span>
        <span>Rp <?= number_format($grand_total, 0, ',', '.'); ?></span>
    </div>
</div>
</body>
</html>