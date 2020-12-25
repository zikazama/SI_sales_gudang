/*
 Navicat Premium Data Transfer

 Source Server         : xampp mysql
 Source Server Type    : MySQL
 Source Server Version : 100417
 Source Host           : localhost:3306
 Source Schema         : sisagu

 Target Server Type    : MySQL
 Target Server Version : 100417
 File Encoding         : 65001

 Date: 26/12/2020 00:45:10
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin`  (
  `id_admin` int NOT NULL AUTO_INCREMENT,
  `email` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `foto` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_admin` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id_admin`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES (1, 'fauzi190198@gmail.com', '123456', 'f74b1f6b4c38c0784c22a244ae5211d8.jpg', 'Fauzi', '2020-06-15 09:59:07');

-- ----------------------------
-- Table structure for akses_toko
-- ----------------------------
DROP TABLE IF EXISTS `akses_toko`;
CREATE TABLE `akses_toko`  (
  `id_akses_toko` int NOT NULL AUTO_INCREMENT,
  `id_toko` int NOT NULL,
  `id_sales` int NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id_akses_toko`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of akses_toko
-- ----------------------------
INSERT INTO `akses_toko` VALUES (2, 1, 1, '2020-12-19 21:19:19');
INSERT INTO `akses_toko` VALUES (3, 2, 1, '2020-12-24 13:04:25');

-- ----------------------------
-- Table structure for barang
-- ----------------------------
DROP TABLE IF EXISTS `barang`;
CREATE TABLE `barang`  (
  `id_barang` int NOT NULL AUTO_INCREMENT,
  `nama_barang` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `merek` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `harga` int NOT NULL,
  `harga_perbox` int NOT NULL,
  `stok` int NOT NULL,
  `stok_perbox` int NOT NULL,
  `diskon` int NOT NULL,
  `diskon_perbox` int NOT NULL,
  `minimal_kuantitas_diskon` int NOT NULL,
  `minimal_kuantitas_diskon_perbox` int NOT NULL,
  `isi_pcs_perbox` int NOT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id_barang`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of barang
-- ----------------------------
INSERT INTO `barang` VALUES (2, 'Tas', 'gucci', 300000, 600000, 86, 1, 10000, 5000, 5, 3, 0, 'fe390655d9710d87ecf83207e4d3c924.jpg', '2020-12-21 16:52:36');
INSERT INTO `barang` VALUES (3, 'Bahan', 'LG', 40000, 150000, 172, 48, 20000, 10000, 50, 10, 0, '2f5b1b913b2f3a286062c24d838717fa.jpg', '2020-12-21 16:52:36');
INSERT INTO `barang` VALUES (4, 'Ayam Goreng', 'geprek', 15000, 50000, 10, 15, 2000, 3000, 5, 5, 10, '3479a78a9bbc3f47aa57091affab097e.jpg', '2020-11-06 19:31:58');
INSERT INTO `barang` VALUES (5, 'Cumi', 'Mantap', 20000, 70000, 2, 14, 1000, 2000, 5, 5, 0, 'de98593bf1a324c4406077308d43bb3a.jpg', '2020-12-19 00:31:48');
INSERT INTO `barang` VALUES (6, 'Lele', 'Pecel', 10000, 50000, 5, 20, 5000, 3000, 5, 5, 0, '01d24f080df6a12e0d16dada29b346e7.jpg', '2020-11-02 13:14:18');
INSERT INTO `barang` VALUES (7, 'Vape', 'bagus', 100000, 500000, 4, 14, 50000, 100000, 5, 5, 0, '2d688a4a13230596fba407b793f1a91f.jpg', '2020-11-02 13:14:18');
INSERT INTO `barang` VALUES (8, 'BBQ', 'top', 30000, 200000, 23, 20, 500, 0, 10, 10, 0, 'eadbdcc64304f899e0a75f0cef9156ee.jpg', '2020-11-02 13:14:19');
INSERT INTO `barang` VALUES (9, 'sate', 'padang', 20000, 30000, 30, 12, 500, 2000, 5, 10, 0, '2eda22fc3f72d95868c1acd95287fe73.jpg', '2020-11-02 13:14:19');
INSERT INTO `barang` VALUES (10, 'chicken', 'ss', 21000, 50000, 41, 20, 1000, 2000, 5, 10, 0, '454f097fc32f4fbb53a0203681bf1d56.jpg', '2020-11-02 13:14:19');
INSERT INTO `barang` VALUES (11, 'jasuke', 'top', 5000, 20000, 40, 20, 500, 1000, 5, 15, 0, 'd9b97b2ea06b82bc8b8b68db7f8b85a9.jpg', '2020-11-02 13:14:19');

-- ----------------------------
-- Table structure for driver
-- ----------------------------
DROP TABLE IF EXISTS `driver`;
CREATE TABLE `driver`  (
  `id_driver` int NOT NULL AUTO_INCREMENT,
  `nik` int NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `foto` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_driver` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id_driver`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of driver
-- ----------------------------
INSERT INTO `driver` VALUES (1, 19, 'zi@gmail.com', '010101', '4229831bdacdcc7dd2e9197dc20bd12e.jpg', 'Zi', '2020-12-15 20:39:13');

-- ----------------------------
-- Table structure for group_rkab
-- ----------------------------
DROP TABLE IF EXISTS `group_rkab`;
CREATE TABLE `group_rkab`  (
  `id_group_rkab` int NOT NULL AUTO_INCREMENT,
  `tanggal` date NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `status_group` int NOT NULL,
  PRIMARY KEY (`id_group_rkab`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of group_rkab
-- ----------------------------
INSERT INTO `group_rkab` VALUES (1, '2020-12-25', NULL, 0);

-- ----------------------------
-- Table structure for item_transaksi
-- ----------------------------
DROP TABLE IF EXISTS `item_transaksi`;
CREATE TABLE `item_transaksi`  (
  `id_item_transaksi` int NOT NULL AUTO_INCREMENT,
  `id_transaksi_sales` int NOT NULL,
  `id_barang` int NOT NULL,
  `kuantitas` int NOT NULL,
  `kuantitas_perbox` int NOT NULL,
  `harga_fix_pcs` int NOT NULL,
  `harga_fix_box` int NOT NULL,
  `subtotal` int NOT NULL,
  `subdiskon` int NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id_item_transaksi`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 67 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of item_transaksi
-- ----------------------------
INSERT INTO `item_transaksi` VALUES (8, 9, 2, 2, 0, 0, 0, 600000, 0, '2020-06-15 01:37:50');
INSERT INTO `item_transaksi` VALUES (9, 10, 2, 5, 0, 0, 0, 1500000, 10000, '2020-06-15 11:17:12');
INSERT INTO `item_transaksi` VALUES (10, 11, 2, 3, 0, 0, 0, 900000, 0, '2020-06-25 17:45:55');
INSERT INTO `item_transaksi` VALUES (11, 12, 2, 3, 0, 0, 0, 900000, 0, '2020-06-26 17:48:22');
INSERT INTO `item_transaksi` VALUES (12, 13, 3, 10, 0, 0, 0, 300000, 6000, '2020-07-04 16:02:37');
INSERT INTO `item_transaksi` VALUES (13, 14, 3, 2, 0, 0, 0, 60000, 0, '2020-07-04 16:05:05');
INSERT INTO `item_transaksi` VALUES (14, 15, 3, 5, 0, 0, 0, 150000, 0, '2020-07-10 23:31:42');
INSERT INTO `item_transaksi` VALUES (15, 16, 2, 1, 0, 0, 0, 300000, 0, '2020-07-22 18:06:18');
INSERT INTO `item_transaksi` VALUES (16, 17, 2, 1, 0, 0, 0, 300000, 0, '2020-07-22 18:13:19');
INSERT INTO `item_transaksi` VALUES (17, 18, 2, 20, 4, 0, 0, 21600000, 45000, '2020-09-03 20:12:21');
INSERT INTO `item_transaksi` VALUES (18, 19, 2, 20, 10, 0, 0, 12000000, 250000, '2020-10-13 08:59:09');
INSERT INTO `item_transaksi` VALUES (19, 20, 2, 15, 0, 0, 0, 4500000, 150000, '2020-10-13 09:12:20');
INSERT INTO `item_transaksi` VALUES (20, 21, 2, 15, 0, 0, 0, 4500000, 150000, '2020-10-13 09:12:48');
INSERT INTO `item_transaksi` VALUES (21, 22, 2, 10, 5, 0, 0, 6000000, 125000, '2020-10-13 09:31:06');
INSERT INTO `item_transaksi` VALUES (22, 23, 2, 5, 0, 0, 0, 1500000, 50000, '2020-10-13 09:33:40');
INSERT INTO `item_transaksi` VALUES (23, 23, 3, 5, 0, 0, 0, 200000, 0, '2020-10-13 09:33:40');
INSERT INTO `item_transaksi` VALUES (24, 24, 2, 5, 0, 0, 0, 1500000, 50000, '2020-10-26 13:12:50');
INSERT INTO `item_transaksi` VALUES (25, 24, 3, 2, 0, 0, 0, 80000, 0, '2020-10-26 13:12:50');
INSERT INTO `item_transaksi` VALUES (26, 24, 4, 3, 0, 0, 0, 45000, 0, '2020-10-26 13:12:50');
INSERT INTO `item_transaksi` VALUES (27, 24, 5, 4, 0, 0, 0, 80000, 0, '2020-10-26 13:12:50');
INSERT INTO `item_transaksi` VALUES (28, 24, 6, 5, 0, 0, 0, 50000, 25000, '2020-10-26 13:12:51');
INSERT INTO `item_transaksi` VALUES (29, 25, 2, 1, 0, 0, 0, 300000, 0, '2020-10-26 13:14:18');
INSERT INTO `item_transaksi` VALUES (30, 25, 3, 2, 0, 0, 0, 80000, 0, '2020-10-26 13:14:19');
INSERT INTO `item_transaksi` VALUES (31, 25, 4, 3, 0, 0, 0, 45000, 0, '2020-10-26 13:14:19');
INSERT INTO `item_transaksi` VALUES (32, 25, 5, 4, 0, 0, 0, 80000, 0, '2020-10-26 13:14:19');
INSERT INTO `item_transaksi` VALUES (33, 25, 6, 5, 0, 0, 0, 50000, 25000, '2020-10-26 13:14:19');
INSERT INTO `item_transaksi` VALUES (34, 25, 7, 6, 0, 0, 0, 600000, 300000, '2020-10-26 13:14:19');
INSERT INTO `item_transaksi` VALUES (35, 26, 2, 1, 0, 0, 0, 300000, 0, '2020-10-27 01:55:10');
INSERT INTO `item_transaksi` VALUES (36, 27, 2, 1, 0, 0, 0, 300000, 0, '2020-11-02 13:14:18');
INSERT INTO `item_transaksi` VALUES (37, 27, 3, 0, 2, 0, 0, 300000, 0, '2020-11-02 13:14:18');
INSERT INTO `item_transaksi` VALUES (38, 27, 4, 3, 0, 0, 0, 45000, 0, '2020-11-02 13:14:18');
INSERT INTO `item_transaksi` VALUES (39, 27, 5, 0, 4, 0, 0, 280000, 0, '2020-11-02 13:14:18');
INSERT INTO `item_transaksi` VALUES (40, 27, 6, 5, 0, 0, 0, 50000, 25000, '2020-11-02 13:14:18');
INSERT INTO `item_transaksi` VALUES (41, 27, 7, 0, 6, 0, 0, 3000000, 600000, '2020-11-02 13:14:18');
INSERT INTO `item_transaksi` VALUES (42, 27, 8, 7, 0, 0, 0, 210000, 0, '2020-11-02 13:14:18');
INSERT INTO `item_transaksi` VALUES (43, 27, 9, 0, 8, 0, 0, 240000, 0, '2020-11-02 13:14:19');
INSERT INTO `item_transaksi` VALUES (44, 27, 10, 9, 0, 0, 0, 189000, 9000, '2020-11-02 13:14:19');
INSERT INTO `item_transaksi` VALUES (45, 27, 11, 10, 0, 0, 0, 50000, 5000, '2020-11-02 13:14:19');
INSERT INTO `item_transaksi` VALUES (46, 28, 2, 2, 0, 0, 0, 500000, 0, '2020-11-02 15:01:51');
INSERT INTO `item_transaksi` VALUES (47, 29, 3, 2, 0, 0, 0, 60000, 0, '2020-11-02 15:05:01');
INSERT INTO `item_transaksi` VALUES (48, 30, 3, 2, 0, 0, 0, 40000, 0, '2020-11-02 15:06:54');
INSERT INTO `item_transaksi` VALUES (49, 31, 2, 2, 0, 0, 0, 400000, 0, '2020-11-02 15:14:33');
INSERT INTO `item_transaksi` VALUES (51, 33, 3, 2, 0, 10000, 150000, 20000, 0, '2020-11-03 12:51:19');
INSERT INTO `item_transaksi` VALUES (52, 34, 2, 2, 0, 300000, 600000, 600000, 0, '2020-12-13 22:38:23');
INSERT INTO `item_transaksi` VALUES (53, 35, 2, 3, 0, 300000, 600000, 900000, 0, '2020-12-15 21:31:41');
INSERT INTO `item_transaksi` VALUES (65, 36, 3, 1, 0, 40000, 150000, 40000, 0, '2020-12-21 16:52:36');
INSERT INTO `item_transaksi` VALUES (66, 36, 2, 3, 0, 300000, 600000, 900000, 0, '2020-12-21 16:52:36');

-- ----------------------------
-- Table structure for pembayaran
-- ----------------------------
DROP TABLE IF EXISTS `pembayaran`;
CREATE TABLE `pembayaran`  (
  `id_pembayaran` int NOT NULL AUTO_INCREMENT,
  `id_transaksi_sales` int NOT NULL,
  `jumlah_pembayaran` int NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id_pembayaran`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 41 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pembayaran
-- ----------------------------
INSERT INTO `pembayaran` VALUES (1, 12, 800000, '2020-06-26 19:10:56');
INSERT INTO `pembayaran` VALUES (3, 13, 0, '2020-07-04 16:02:37');
INSERT INTO `pembayaran` VALUES (4, 14, 0, '2020-07-04 16:05:05');
INSERT INTO `pembayaran` VALUES (5, 15, 0, '2020-07-10 23:31:42');
INSERT INTO `pembayaran` VALUES (6, 15, 150000, '2020-07-16 12:03:43');
INSERT INTO `pembayaran` VALUES (7, 15, 150000, '2020-07-16 12:07:19');
INSERT INTO `pembayaran` VALUES (12, 14, 60000, '2020-07-16 12:24:59');
INSERT INTO `pembayaran` VALUES (13, 16, 0, '2020-07-22 18:06:19');
INSERT INTO `pembayaran` VALUES (14, 17, 100000, '2020-07-22 18:13:19');
INSERT INTO `pembayaran` VALUES (15, 18, 18000000, '2020-09-03 20:12:21');
INSERT INTO `pembayaran` VALUES (16, 19, 5000000, '2020-10-13 08:59:10');
INSERT INTO `pembayaran` VALUES (17, 20, 2000000, '2020-10-13 09:12:20');
INSERT INTO `pembayaran` VALUES (18, 21, 2000000, '2020-10-13 09:12:48');
INSERT INTO `pembayaran` VALUES (19, 21, 2350000, '2020-10-13 09:18:45');
INSERT INTO `pembayaran` VALUES (20, 22, 200000, '2020-10-13 09:31:06');
INSERT INTO `pembayaran` VALUES (21, 23, 1000000, '2020-10-13 09:33:40');
INSERT INTO `pembayaran` VALUES (22, 24, 500000, '2020-10-26 13:12:51');
INSERT INTO `pembayaran` VALUES (23, 25, 300000, '2020-10-26 13:14:19');
INSERT INTO `pembayaran` VALUES (28, 25, 100000, '2020-10-27 01:46:16');
INSERT INTO `pembayaran` VALUES (29, 25, 430000, '2020-10-27 01:48:24');
INSERT INTO `pembayaran` VALUES (30, 26, 300000, '2020-10-27 01:55:10');
INSERT INTO `pembayaran` VALUES (31, 27, 2000000, '2020-11-02 13:14:19');
INSERT INTO `pembayaran` VALUES (32, 28, 0, '2020-11-02 15:01:52');
INSERT INTO `pembayaran` VALUES (33, 29, 0, '2020-11-02 15:05:01');
INSERT INTO `pembayaran` VALUES (34, 30, 0, '2020-11-02 15:06:54');
INSERT INTO `pembayaran` VALUES (35, 31, 0, '2020-11-02 15:14:33');
INSERT INTO `pembayaran` VALUES (36, 32, 0, '2020-11-03 12:36:23');
INSERT INTO `pembayaran` VALUES (37, 33, 0, '2020-11-03 12:51:20');
INSERT INTO `pembayaran` VALUES (38, 34, 300000, '2020-12-13 22:38:23');
INSERT INTO `pembayaran` VALUES (39, 35, 200000, '2020-12-15 21:31:41');
INSERT INTO `pembayaran` VALUES (40, 36, 20000, '2020-12-15 21:33:09');

-- ----------------------------
-- Table structure for rkab
-- ----------------------------
DROP TABLE IF EXISTS `rkab`;
CREATE TABLE `rkab`  (
  `id_rkab` int NOT NULL AUTO_INCREMENT,
  `id_transaksi_sales` int NOT NULL,
  `status_proses` int NOT NULL DEFAULT 0,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `id_group_rkab` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_rkab`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of rkab
-- ----------------------------
INSERT INTO `rkab` VALUES (1, 30, 1, '2020-12-25 23:54:10', 1);
INSERT INTO `rkab` VALUES (2, 1, 0, '2020-12-25 22:15:10', NULL);
INSERT INTO `rkab` VALUES (4, 35, 2, '2020-12-25 22:15:14', NULL);

-- ----------------------------
-- Table structure for rkab_item
-- ----------------------------
DROP TABLE IF EXISTS `rkab_item`;
CREATE TABLE `rkab_item`  (
  `id_rkab_item` int NOT NULL AUTO_INCREMENT,
  `id_rkab` int NOT NULL,
  `id_driver` int NOT NULL,
  `id_item_transaksi` int NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id_rkab_item`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of rkab_item
-- ----------------------------
INSERT INTO `rkab_item` VALUES (5, 1, 1, 48, '2020-12-24 09:35:28');
INSERT INTO `rkab_item` VALUES (6, 4, 1, 53, '2020-12-24 13:12:18');

-- ----------------------------
-- Table structure for sales
-- ----------------------------
DROP TABLE IF EXISTS `sales`;
CREATE TABLE `sales`  (
  `id_sales` int NOT NULL AUTO_INCREMENT,
  `nik` int NOT NULL,
  `email` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `foto` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_sales` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id_sales`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sales
-- ----------------------------
INSERT INTO `sales` VALUES (1, 3030, 'jovan@gmail.com', '123456', 'dbb111e624dfc0c066d5f43d3fc7d735.jpg', 'Jovan', '2020-06-15 09:52:32');
INSERT INTO `sales` VALUES (3, 200, 'eren@gmail.com', '123456', 'c02da80f039219c3f28db3f646b26d86.jpeg', 'eren', '2020-06-15 08:56:56');

-- ----------------------------
-- Table structure for toko
-- ----------------------------
DROP TABLE IF EXISTS `toko`;
CREATE TABLE `toko`  (
  `id_toko` int NOT NULL AUTO_INCREMENT,
  `kode_toko` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_toko` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id_toko`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of toko
-- ----------------------------
INSERT INTO `toko` VALUES (1, '645333', 'Dadang', 'Subang', -6.9337088, 107.60683519999999, '2020-12-19 21:51:38');
INSERT INTO `toko` VALUES (2, '32442', 'Gio', 'ogi', -6.8886223, 107.58353079999999, '2020-12-24 13:05:11');

-- ----------------------------
-- Table structure for transaksi_admin
-- ----------------------------
DROP TABLE IF EXISTS `transaksi_admin`;
CREATE TABLE `transaksi_admin`  (
  `id_transaksi_admin` int NOT NULL AUTO_INCREMENT,
  `id_admin` int NOT NULL,
  `id_barang` int NOT NULL,
  `nama_barang` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `transaksi` enum('create','update','delete') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id_transaksi_admin`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of transaksi_admin
-- ----------------------------

-- ----------------------------
-- Table structure for transaksi_sales
-- ----------------------------
DROP TABLE IF EXISTS `transaksi_sales`;
CREATE TABLE `transaksi_sales`  (
  `id_transaksi_sales` int NOT NULL AUTO_INCREMENT,
  `id_sales` int NOT NULL,
  `id_toko` int NOT NULL,
  `total` int NOT NULL,
  `diskon` int NOT NULL,
  `is_lunas` tinyint(1) NOT NULL DEFAULT 0,
  `status` enum('diterima','pending','ditolak') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'diterima',
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id_transaksi_sales`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 37 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of transaksi_sales
-- ----------------------------
INSERT INTO `transaksi_sales` VALUES (10, 1, 1, 1500000, 10000, 0, 'diterima', '2020-07-04 14:02:58');
INSERT INTO `transaksi_sales` VALUES (11, 1, 1, 900000, 0, 0, 'diterima', '2020-07-04 14:03:00');
INSERT INTO `transaksi_sales` VALUES (12, 1, 1, 900000, 0, 0, 'diterima', '2020-07-04 14:03:03');
INSERT INTO `transaksi_sales` VALUES (13, 1, 1, 300000, 6000, 0, 'diterima', '2020-07-04 16:02:37');
INSERT INTO `transaksi_sales` VALUES (14, 1, 1, 60000, 0, 1, 'diterima', '2020-07-16 12:24:59');
INSERT INTO `transaksi_sales` VALUES (15, 1, 1, 150000, 0, 0, 'diterima', '2020-07-10 23:31:42');
INSERT INTO `transaksi_sales` VALUES (16, 1, 1, 300000, 0, 0, 'diterima', '2020-07-22 18:06:18');
INSERT INTO `transaksi_sales` VALUES (17, 1, 1, 300000, 0, 0, 'diterima', '2020-07-22 18:13:19');
INSERT INTO `transaksi_sales` VALUES (18, 1, 1, 21600000, 45000, 0, 'diterima', '2020-09-03 20:12:21');
INSERT INTO `transaksi_sales` VALUES (19, 1, 1, 27000000, 250000, 0, 'diterima', '2020-10-13 08:59:09');
INSERT INTO `transaksi_sales` VALUES (20, 1, 2, 4350000, 150000, 0, 'diterima', '2020-10-13 09:12:20');
INSERT INTO `transaksi_sales` VALUES (21, 1, 2, 4350000, 150000, 1, 'diterima', '2020-10-13 09:18:45');
INSERT INTO `transaksi_sales` VALUES (22, 1, 1, 5875000, 125000, 0, 'diterima', '2020-10-13 09:31:06');
INSERT INTO `transaksi_sales` VALUES (23, 1, 2, 1650000, 50000, 0, 'diterima', '2020-10-13 09:33:40');
INSERT INTO `transaksi_sales` VALUES (24, 1, 1, 1680000, 75000, 0, 'diterima', '2020-10-26 13:12:50');
INSERT INTO `transaksi_sales` VALUES (25, 1, 1, 830000, 325000, 1, 'diterima', '2020-10-27 01:48:24');
INSERT INTO `transaksi_sales` VALUES (26, 1, 2, 300000, 0, 1, 'diterima', '2020-10-27 01:55:10');
INSERT INTO `transaksi_sales` VALUES (27, 1, 1, 4025000, 639000, 0, 'diterima', '2020-11-02 13:14:18');
INSERT INTO `transaksi_sales` VALUES (28, 1, 1, 500000, 0, 0, 'diterima', '2020-11-02 15:01:51');
INSERT INTO `transaksi_sales` VALUES (29, 1, 2, 60000, 0, 0, 'diterima', '2020-11-02 15:05:01');
INSERT INTO `transaksi_sales` VALUES (30, 1, 2, 40000, 0, 0, 'diterima', '2020-11-02 15:06:54');
INSERT INTO `transaksi_sales` VALUES (31, 1, 1, 400000, 0, 0, 'diterima', '2020-11-03 08:42:19');
INSERT INTO `transaksi_sales` VALUES (32, 1, 1, 200000, 0, 0, 'diterima', '2020-11-03 12:48:07');
INSERT INTO `transaksi_sales` VALUES (33, 1, 2, 20000, 0, 0, 'ditolak', '2020-11-03 13:08:26');
INSERT INTO `transaksi_sales` VALUES (34, 1, 1, 600000, 0, 0, 'diterima', '2020-12-13 22:38:23');
INSERT INTO `transaksi_sales` VALUES (35, 1, 1, 900000, 0, 0, 'diterima', '2020-12-15 21:31:40');
INSERT INTO `transaksi_sales` VALUES (36, 1, 1, 940000, 0, 0, 'pending', '2020-12-19 11:09:34');

SET FOREIGN_KEY_CHECKS = 1;
