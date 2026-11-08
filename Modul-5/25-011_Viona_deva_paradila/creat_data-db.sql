USE toko_db

INSERT INTO pelanggan (id, nama, jenis_kelamin, telp, alamat) VALUES
(1, 'Ahmad Fauzi', 'L', '081234567801', 'Jl. Pemuda No. 10, Surabaya'),
(2, 'Siti Nurhaliza', 'P', '081234567802', 'Jl. Mawar No. 4, Bangkalan'),
(3, 'Budi Prasetyo', 'L', '081234567803', 'Jl. Pahlawan No. 25, Kamal'),
(4, 'Dewi Lestari', 'P', '081234567804', 'Jl. Diponegoro No. 8, Surabaya'),
(5, 'Eko Saputra', 'L', '081234567805', 'Jl. Melati No. 12, Sidoarjo'),
(6, 'Fitri Handayani', 'P', '081234567806', 'Jl. Kenanga No. 3, Bangkalan'),
(7, 'Gunawan Wibisono', 'L', '081234567807', 'Jl. Raya Telang No. 1, Kamal'),
(8, 'Hesti Purwanti', 'P', '081234567808', 'Jl. Basuki Rahmat No. 15, Surabaya'),
(9, 'Irwan Setiawan', 'L', '081234567809', 'Jl. Kartini No. 7, Gresik'),
(10, 'Julia Rahmawati', 'P', '081234567810', 'Jl. Kusuma Bangsa No. 22, Surabaya');

INSERT INTO supplier (id, nama, telp, alamat) VALUES
(3, 'PT Maju Bersama', '08123456', 'Surabaya'),
(4, 'PT. Senang Sekali', '081515563', 'Bangkalan'),
(5, 'PT. Segar Segar', '0845454663', 'Surabaya'),
(6, 'PT Maju Jaya Sentosa', '085558932', 'Jakarta'),
(7, 'PT Technova Solusi Digital', '087555-0199', 'Bandung'),
(8, 'PT Bumi Hijau Lestari', '08744447123', 'Bangkalan'),
(9, 'PT Angkasa Karya Konstruksi', '0823339081', 'Yogyakarta'),
(10, 'CV - Budi Santoso (Spesialis Administrasi)', '081255554321', 'Bandung'),
(11, 'CV - Rian Wijaya (Software Engineer)', '081955550011', 'Sukolilo'),
(12, 'CV - Hendra Setiawan (Sales Marketing)', '081355556622', 'Semarang');

INSERT INTO `user` (id_user, username, password, nama, alamat, hp, level) VALUES
(1, 'admin', 'admin123', 'Administrator Toko', 'Jl. Raya Kamal No. 15, Bangkalan', '085200000001', 'admin'),
(2, 'kasir1', 'kasir123', 'Siti Aminah', 'Jl. Sukolilo No. 3, Surabaya', '085200000002', 'kasir'),
(3, 'kasir2', 'kasir123', 'Rian Hidayat', 'Jl. Kusuma No. 9, Bangkalan', '085200000003', 'kasir'),
(4, 'gudang1', 'gudang123', 'Joko Susilo', 'Jl. Perak Barat No. 45, Surabaya', '085200000004', 'gudang'),
(5, 'supervisor', 'spv123', 'Maya Indah', 'Jl. Darmo No. 88, Surabaya', '085200000005', 'supervisor'),
(6, 'viona', 'viona123', 'Viona Deva Paradila', 'Jl. Graha Indah No. 11, Bangkalan', '085200000006', 'admin'),
(7, 'manajer', 'manajer123', 'Hendra Pratama', 'Jl. Manyar Kertoarjo No. 12, Surabaya', '085200000007', 'manajer'),
(8, 'accounting', 'acc123', 'Linda Wahyuni', 'Jl. Ahmad Yani No. 102, Sidoarjo', '085200000008', 'accounting'),
(9, 'operator1', 'op123', 'Rizky Kurniawan', 'Jl. Panglima Sudirman No. 30, Bangkalan', '085200000009', 'operator'),
(10, 'teknisi1', 'tek123', 'Toni Suhartono', 'Jl. Jemursari No. 18, Surabaya', '085200000010', 'teknisi');

INSERT INTO barang (id, kode_barang, nama_barang, harga, stok, supplier_id) VALUES
(1, 'BRG001', 'Beras Premium 5kg', 68000, 50, 3),
(2, 'BRG002', 'Minyak Goreng 2L', 34000, 45, 4),
(3, 'BRG003', 'Gula Pasir 1kg', 16000, 60, 5),
(4, 'BRG004', 'Tepung Terigu 1kg', 12000, 40, 6),
(5, 'BRG005', 'Kopi Bubuk Robusta 200g', 15000, 80, 7),
(6, 'BRG006', 'Susu Kental Manis 370g', 13000, 55, 8),
(7, 'BRG007', 'Mie Instan Goreng (Dus)', 115000, 30, 9),
(8, 'BRG008', 'Sabun Cuci Piring 750ml', 14000, 50, 10),
(9, 'BRG009', 'Deterjen Bubuk 1kg', 22000, 35, 11),
(10, 'BRG010', 'Teh Celup Kotak 25s', 8500, 70, 12);

INSERT INTO transaksi (id, waktu_transaksi, keterangan, total, pelanggan_id) VALUES
(1, '2026-10-01 09:15:00', 'Pembelian sembako rutin', 116000, 1),
(2, '2026-10-02 10:30:00', 'Belanja bulanan rumah tangga', 149000, 2),
(3, '2026-10-03 11:20:00', 'Pembelian mie instan kardus', 115000, 3),
(4, '2026-10-04 13:45:00', 'Belanja kebutuhan dapur', 62000, 4),
(5, '2026-10-05 14:10:00', 'Pembelian beras dan minyak', 102000, 5),
(6, '2026-10-06 15:25:00', 'Belanja sabun dan deterjen', 36000, 6),
(7, '2026-10-07 16:05:00', 'Pembelian persediaan toko kecil', 242000, 7),
(8, '2026-10-08 17:30:00', 'Belanja snack dan kopi', 43000, 8),
(9, '2026-10-09 18:15:00', 'Pembelian kebutuhan pokok', 130000, 9),
(10, '2026-10-10 19:40:00', 'Belanja akhir pekan', 84000, 10);

INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES
(1, 1, 68000, 1),
(1, 2, 34000, 1),
(1, 4, 12000, 1),
(2, 2, 34000, 2),
(2, 5, 15000, 1),
(3, 7, 115000, 1),
(4, 3, 16000, 2),
(4, 6, 13000, 2),
(5, 1, 68000, 1),
(5, 2, 34000, 1),
(6, 8, 14000, 1),
(6, 9, 22000, 1),
(7, 1, 68000, 2),
(7, 7, 115000, 1),
(8, 5, 15000, 2),
(8, 10, 8500, 1),
(9, 1, 68000, 1),
(9, 3, 16000, 2),
(10, 2, 34000, 2),
(10, 10, 8500, 2);

INSERT INTO pembayaran (id, waktu_bayar, total, metode, transaksi_id) VALUES
(1, '2026-10-01 09:20:00', 116000, 'Tunai', 1),
(2, '2026-10-02 10:35:00', 149000, 'transfer', 2),
(3, '2026-10-03 11:25:00', 115000, 'EDC', 3),
(4, '2026-10-04 13:50:00', 62000, 'Tunai', 4),
(5, '2026-10-05 14:15:00', 102000, 'transfer', 5),
(6, '2026-10-06 15:30:00', 36000, 'Tunai', 6),
(7, '2026-10-07 16:10:00', 242000, 'EDC', 7),
(8, '2026-10-08 17:35:00', 43000, 'transfer', 8),
(9, '2026-10-09 18:20:00', 130000, 'Tunai', 9),
(10, '2026-10-10 19:45:00', 84000, 'EDC', 10);