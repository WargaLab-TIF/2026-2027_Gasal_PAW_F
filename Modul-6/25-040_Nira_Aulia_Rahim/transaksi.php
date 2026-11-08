<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Transaksi Penjualan</title>
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
            max-width: 1050px; 
            margin: 0 auto; 
            background: var(--card-bg); 
            padding: 35px; 
            border-radius: 16px; 
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -4px rgba(0, 0, 0, 0.05); 
        }
        .top-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }
        .nav-links {
            display: flex;
            gap: 10px;
        }
        .nav-links a { 
            text-decoration: none; 
            padding: 8px 16px; 
            background: #e0e7ff; 
            color: var(--primary); 
            border-radius: 8px; 
            font-weight: 600; 
            font-size: 14px; 
            transition: background 0.2s;
        }
        .nav-links a:hover, .nav-links a.active { 
            background: var(--primary); 
            color: #fff; 
        }
        .header-title { 
            border-bottom: 2px solid var(--border); 
            padding-bottom: 15px; 
            margin-bottom: 25px; 
        }
        .header-title h2 {
            margin: 0;
            font-size: 22px;
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
        .badge-trx {
            background: #f1f5f9;
            color: #334155;
            padding: 4px 8px;
            border-radius: 6px;
            font-family: monospace;
            font-weight: 600;
        }
        .btn-detail {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            font-size: 13px;
            background: #e0e7ff;
            padding: 6px 12px;
            border-radius: 6px;
            transition: background 0.2s;
        }
        .btn-detail:hover {
            background: #c7d2fe;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="top-nav">
        <div class="nav-links">
            <a href="transaksi.php" class="active">Data Transaksi</a>
            <a href="barang.php">Data Barang</a>
        </div>
    </div>

    <div class="header-title">
        <h2>🛒 Daftar Transaksi Penjualan</h2>
    </div>

    <table>
        <thead>
            <tr>
                <th width="50">No</th>
                <th width="120">ID Transaksi</th>
                <th>Waktu Transaksi</th>
                <th>Pelanggan</th>
                <th>Keterangan</th>
                <th>Total</th>
                <th width="100" style="text-align: center;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $query = mysqli_query($koneksi, "SELECT transaksi.*, pelanggan.nama as nama_pelanggan FROM transaksi LEFT JOIN pelanggan ON transaksi.pelanggan_id = pelanggan.id ORDER BY transaksi.id DESC");
            
            while ($row = mysqli_fetch_assoc($query)) {
                $id_formatted = "TRX-" . str_pad($row['id'], 3, "0", STR_PAD_LEFT);
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><span class="badge-trx"><?= $id_formatted; ?></span></td>
                <td><?= $row['waktu_transaksi']; ?> 00:00</td>
                <td><?= htmlspecialchars($row['nama_pelanggan'] ? $row['nama_pelanggan'] : $row['pelanggan_id']); ?></td>
                <td><?= htmlspecialchars($row['keterangan']); ?></td>
                <td><strong>Rp <?= number_format($row['total'], 0, ',', '.'); ?></strong></td>
                <td style="text-align: center;">
                    <a href="tambahTransaksi.php?id=<?= $row['id']; ?>" class="btn-detail">👁️ Detail</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>