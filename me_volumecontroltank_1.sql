/*
 Navicat Premium Data Transfer

 Source Server         : Xampp
 Source Server Type    : MySQL
 Source Server Version : 100424
 Source Host           : localhost:3306
 Source Schema         : me_volumecontroltank

 Target Server Type    : MySQL
 Target Server Version : 100424
 File Encoding         : 65001

 Date: 01/11/2022 14:21:14
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for data_tangki
-- ----------------------------
DROP TABLE IF EXISTS `data_tangki`;
CREATE TABLE `data_tangki`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `sisa_bahan_bakar` int NULL DEFAULT NULL COMMENT 'satuan = liter',
  `kapasitas_bahan_bakar` int NULL DEFAULT NULL COMMENT 'satuan = liter',
  `id_gedung` int NULL DEFAULT NULL,
  `created` datetime NULL DEFAULT NULL,
  `updated` datetime NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of data_tangki
-- ----------------------------
INSERT INTO `data_tangki` VALUES (1, NULL, 2000, 4, '2022-09-11 23:51:07', '2022-09-26 13:52:49');
INSERT INTO `data_tangki` VALUES (3, NULL, 1000, 2, '2022-09-15 17:19:35', '2022-09-15 17:19:35');
INSERT INTO `data_tangki` VALUES (4, NULL, 900, 6, '2022-09-15 17:20:18', '2022-09-26 08:50:55');

-- ----------------------------
-- Table structure for facility_management
-- ----------------------------
DROP TABLE IF EXISTS `facility_management`;
CREATE TABLE `facility_management`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `facility_management` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created` datetime NULL DEFAULT NULL,
  `updated` datetime NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of facility_management
-- ----------------------------
INSERT INTO `facility_management` VALUES (1, 'Facility Management 1', '2022-09-11 18:43:40', '2022-09-11 18:43:40');
INSERT INTO `facility_management` VALUES (3, 'Facility Management 2', '2022-09-11 18:44:04', '2022-09-11 18:44:04');
INSERT INTO `facility_management` VALUES (4, 'Facility Management 3', '2022-09-11 18:52:26', '2022-09-11 18:52:26');
INSERT INTO `facility_management` VALUES (5, 'Facility Management 4', '2022-09-15 16:41:14', '2022-09-15 16:41:14');

-- ----------------------------
-- Table structure for gedung
-- ----------------------------
DROP TABLE IF EXISTS `gedung`;
CREATE TABLE `gedung`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_facility_management` int NULL DEFAULT NULL,
  `code_sensor` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `gedung` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `lokasi` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `jenis_tangki` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `panjang` int NULL DEFAULT NULL,
  `lebar` int NULL DEFAULT NULL,
  `created` datetime NULL DEFAULT NULL,
  `updated` datetime NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of gedung
-- ----------------------------
INSERT INTO `gedung` VALUES (2, 1, '01', 'Gedung 3', 'lokasi 3', 'Jenis Tangki 33', 20, 10, '2022-09-11 11:31:30', '2022-09-16 01:00:39');
INSERT INTO `gedung` VALUES (4, 4, NULL, 'Gedung 4', 'lokasi 4', 'Jenis Tangki 31', 30, 10, '2022-09-11 19:07:42', '2022-09-16 01:00:43');
INSERT INTO `gedung` VALUES (6, 5, '03', 'gedung5', 'lokasi 5', 'Jenis Tangki 31', 100, 50, '2022-09-15 17:17:53', '2022-09-26 08:53:35');

-- ----------------------------
-- Table structure for jenis_tangki
-- ----------------------------
DROP TABLE IF EXISTS `jenis_tangki`;
CREATE TABLE `jenis_tangki`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `jenis_tangki` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `panjang` int NULL DEFAULT NULL,
  `lebar` int NULL DEFAULT NULL,
  `created` datetime NULL DEFAULT NULL,
  `updated` datetime NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 56 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of jenis_tangki
-- ----------------------------
INSERT INTO `jenis_tangki` VALUES (1, 'persegi', NULL, NULL, NULL, NULL);
INSERT INTO `jenis_tangki` VALUES (2, 'd', NULL, NULL, '2022-09-10 19:42:17', '2022-09-10 19:42:17');
INSERT INTO `jenis_tangki` VALUES (3, 'e', NULL, NULL, '2022-09-10 19:48:50', '2022-09-10 19:48:50');
INSERT INTO `jenis_tangki` VALUES (4, 'cc', NULL, NULL, '2022-09-10 19:49:11', '2022-09-10 19:49:11');
INSERT INTO `jenis_tangki` VALUES (5, 'tes1', NULL, NULL, '2022-09-10 19:49:30', '2022-09-10 19:49:30');
INSERT INTO `jenis_tangki` VALUES (6, 'tes2', NULL, NULL, '2022-09-10 19:56:05', '2022-09-10 19:56:05');
INSERT INTO `jenis_tangki` VALUES (7, 'tes3', NULL, NULL, '2022-09-10 19:57:48', '2022-09-10 19:57:48');
INSERT INTO `jenis_tangki` VALUES (8, 'tes4', NULL, NULL, '2022-09-10 19:59:38', '2022-09-10 19:59:38');
INSERT INTO `jenis_tangki` VALUES (9, 'tes5', NULL, NULL, '2022-09-10 20:07:35', '2022-09-10 20:07:35');
INSERT INTO `jenis_tangki` VALUES (10, 'tes6', NULL, NULL, '2022-09-10 20:09:06', '2022-09-10 20:09:06');
INSERT INTO `jenis_tangki` VALUES (11, 'tes7', NULL, NULL, '2022-09-10 20:09:50', '2022-09-10 20:09:50');
INSERT INTO `jenis_tangki` VALUES (12, 'tes8', NULL, NULL, '2022-09-10 20:18:29', '2022-09-10 20:18:29');
INSERT INTO `jenis_tangki` VALUES (13, 'tes9', NULL, NULL, '2022-09-10 20:19:07', '2022-09-10 20:19:07');
INSERT INTO `jenis_tangki` VALUES (14, 'tes10', NULL, NULL, '2022-09-10 20:22:47', '2022-09-10 20:22:47');
INSERT INTO `jenis_tangki` VALUES (15, 'tes11', NULL, NULL, '2022-09-10 20:23:22', '2022-09-10 20:23:22');
INSERT INTO `jenis_tangki` VALUES (16, 'tes12', NULL, NULL, '2022-09-10 20:32:44', '2022-09-10 20:32:44');
INSERT INTO `jenis_tangki` VALUES (17, 'tes13', NULL, NULL, '2022-09-10 20:34:36', '2022-09-10 20:34:36');
INSERT INTO `jenis_tangki` VALUES (18, 'tes14', NULL, NULL, '2022-09-10 20:37:00', '2022-09-10 20:37:00');
INSERT INTO `jenis_tangki` VALUES (19, 'tes15', NULL, NULL, '2022-09-10 20:37:12', '2022-09-10 20:37:12');
INSERT INTO `jenis_tangki` VALUES (20, 'jenis tangki 0', NULL, NULL, '2022-09-10 20:39:17', '2022-09-10 20:39:17');
INSERT INTO `jenis_tangki` VALUES (21, 'Jenis Tangki 1', NULL, NULL, '2022-09-10 20:40:06', '2022-09-10 20:40:06');
INSERT INTO `jenis_tangki` VALUES (22, 'Jenis Tangki 2', NULL, NULL, '2022-09-10 20:40:27', '2022-09-10 20:40:27');
INSERT INTO `jenis_tangki` VALUES (23, 'Jenis Tangki 3', NULL, NULL, '2022-09-10 20:40:58', '2022-09-10 20:40:58');
INSERT INTO `jenis_tangki` VALUES (24, 'Jenis Tangki 4', NULL, NULL, '2022-09-10 20:42:00', '2022-09-10 20:42:00');
INSERT INTO `jenis_tangki` VALUES (25, 'Jenis Tangki 5', NULL, NULL, '2022-09-10 20:43:17', '2022-09-10 20:43:17');
INSERT INTO `jenis_tangki` VALUES (26, 'Jenis Tangki 6', NULL, NULL, '2022-09-10 20:43:42', '2022-09-10 20:43:42');
INSERT INTO `jenis_tangki` VALUES (27, 'Jenis Tangki 7', NULL, NULL, '2022-09-10 20:44:28', '2022-09-10 20:44:28');
INSERT INTO `jenis_tangki` VALUES (28, 'Jenis Tangki 8', NULL, NULL, '2022-09-10 20:44:59', '2022-09-10 20:44:59');
INSERT INTO `jenis_tangki` VALUES (29, 'Jenis Tangki 9', NULL, NULL, '2022-09-10 20:52:58', '2022-09-10 20:52:58');
INSERT INTO `jenis_tangki` VALUES (30, 'Jenis Tangki 10', NULL, NULL, '2022-09-10 20:53:30', '2022-09-10 20:53:30');
INSERT INTO `jenis_tangki` VALUES (31, 'Jenis Tangki 11', NULL, NULL, '2022-09-10 20:54:02', '2022-09-10 20:54:02');
INSERT INTO `jenis_tangki` VALUES (32, 'Jenis Tangki 12', NULL, NULL, '2022-09-10 20:54:24', '2022-09-10 20:54:24');
INSERT INTO `jenis_tangki` VALUES (33, 'Jenis Tangki 13', NULL, NULL, '2022-09-10 20:54:35', '2022-09-10 20:54:35');
INSERT INTO `jenis_tangki` VALUES (34, 'Jenis Tangki 14', NULL, NULL, '2022-09-10 20:54:50', '2022-09-10 20:54:50');
INSERT INTO `jenis_tangki` VALUES (35, 'Jenis Tangki 15', NULL, NULL, '2022-09-10 20:55:03', '2022-09-10 20:55:03');
INSERT INTO `jenis_tangki` VALUES (36, 'Jenis Tangki 16', NULL, NULL, '2022-09-10 20:55:23', '2022-09-10 20:55:23');
INSERT INTO `jenis_tangki` VALUES (37, 'Jenis Tangki 17', NULL, NULL, '2022-09-10 20:55:33', '2022-09-10 20:55:33');
INSERT INTO `jenis_tangki` VALUES (38, 'Jenis Tangki 18', NULL, NULL, '2022-09-10 20:55:43', '2022-09-10 20:55:43');
INSERT INTO `jenis_tangki` VALUES (39, 'Jenis Tangki 19', NULL, NULL, '2022-09-10 20:56:00', '2022-09-10 20:56:00');
INSERT INTO `jenis_tangki` VALUES (40, 'Jenis Tangki 20', NULL, NULL, '2022-09-10 20:56:56', '2022-09-10 20:56:56');
INSERT INTO `jenis_tangki` VALUES (41, 'Jenis Tangki 21', NULL, NULL, '2022-09-10 20:57:21', '2022-09-10 20:57:21');
INSERT INTO `jenis_tangki` VALUES (43, 'Jenis Tangki 23', NULL, NULL, '2022-09-10 21:01:44', '2022-09-10 21:01:44');
INSERT INTO `jenis_tangki` VALUES (44, 'Jenis Tangki 24', NULL, NULL, '2022-09-10 21:10:51', '2022-09-10 21:10:51');
INSERT INTO `jenis_tangki` VALUES (45, 'Jenis Tangki 25', NULL, NULL, '2022-09-10 21:11:07', '2022-09-10 21:11:07');
INSERT INTO `jenis_tangki` VALUES (46, 'Jenis Tangki 26', NULL, NULL, '2022-09-10 21:11:21', '2022-09-10 21:11:21');
INSERT INTO `jenis_tangki` VALUES (47, 'Jenis Tangki 27', NULL, NULL, '2022-09-10 21:12:03', '2022-09-10 21:12:03');
INSERT INTO `jenis_tangki` VALUES (48, 'Jenis Tangki 28', 11, 9, '2022-09-10 21:13:13', '2022-09-15 16:46:41');
INSERT INTO `jenis_tangki` VALUES (53, 'Jenis Tangki 31', 50, 10, '2022-09-11 07:26:29', '2022-09-26 08:49:22');
INSERT INTO `jenis_tangki` VALUES (54, 'Jenis Tangki 33', 11, 6, '2022-09-11 07:27:04', '2022-09-15 16:35:51');
INSERT INTO `jenis_tangki` VALUES (55, 'Jenis Tangki 34', 14, 6, '2022-09-15 16:35:16', '2022-09-15 16:46:31');

-- ----------------------------
-- Table structure for monitoring
-- ----------------------------
DROP TABLE IF EXISTS `monitoring`;
CREATE TABLE `monitoring`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `code_sensor` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tinggi` int NULL DEFAULT NULL,
  `created` datetime NULL DEFAULT NULL,
  `updated` datetime NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of monitoring
-- ----------------------------
INSERT INTO `monitoring` VALUES (2, '01', 100, '2022-09-11 11:31:30', '2022-09-15 22:18:22');
INSERT INTO `monitoring` VALUES (4, '02', 10, '2022-09-11 19:07:42', '2022-09-16 01:01:13');
INSERT INTO `monitoring` VALUES (5, '03', 50, '2022-09-15 16:47:08', '2022-09-26 08:50:13');

-- ----------------------------
-- Table structure for request_data_tangki
-- ----------------------------
DROP TABLE IF EXISTS `request_data_tangki`;
CREATE TABLE `request_data_tangki`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_data_tangki` int NULL DEFAULT NULL,
  `jumlah_request` int NULL DEFAULT NULL COMMENT 'satuan = liter',
  `status` int NULL DEFAULT NULL,
  `request` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `requet_datetime` datetime NULL DEFAULT NULL,
  `approver` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `approver_datetime` datetime NULL DEFAULT NULL,
  `approver_noted` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created` datetime NULL DEFAULT NULL,
  `updated` datetime NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of request_data_tangki
-- ----------------------------
INSERT INTO `request_data_tangki` VALUES (18, 3, 10, 1, 'ADMIN', '2022-10-12 04:48:19', NULL, NULL, NULL, '2022-10-12 04:48:19', '2022-10-12 04:48:19');

-- ----------------------------
-- Table structure for status
-- ----------------------------
DROP TABLE IF EXISTS `status`;
CREATE TABLE `status`  (
  `kode_status` int NOT NULL AUTO_INCREMENT,
  `nama_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`kode_status`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of status
-- ----------------------------
INSERT INTO `status` VALUES (1, 'Pending Request');
INSERT INTO `status` VALUES (2, 'Request Ditolak');
INSERT INTO `status` VALUES (3, 'Request Selesai');

-- ----------------------------
-- Table structure for user_application
-- ----------------------------
DROP TABLE IF EXISTS `user_application`;
CREATE TABLE `user_application`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nik` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nama` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `level_id` tinyint NULL DEFAULT NULL,
  `id_gedung` int NULL DEFAULT NULL,
  `foto` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `created` datetime NULL DEFAULT NULL,
  `updated` datetime NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of user_application
-- ----------------------------
INSERT INTO `user_application` VALUES (5, 'nik2', 'nama', 3, 4, NULL, '2022-09-12 11:53:32', '2022-09-12 11:53:32');
INSERT INTO `user_application` VALUES (6, 'nik2', 'nama2', 2, 0, 'uploads/foto//nik2_20220915120155000000.jpg', '2022-09-15 12:01:55', '2022-09-15 12:01:55');
INSERT INTO `user_application` VALUES (7, 'nik4', 'nama3', 3, 4, 'uploads/foto/nik3_20220915120322000000.jpg', '2022-09-15 12:03:22', '2022-09-15 12:22:52');

-- ----------------------------
-- Table structure for user_roles
-- ----------------------------
DROP TABLE IF EXISTS `user_roles`;
CREATE TABLE `user_roles`  (
  `level_id` tinyint NOT NULL AUTO_INCREMENT,
  `role_desc` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`level_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of user_roles
-- ----------------------------
INSERT INTO `user_roles` VALUES (1, 'SuperAdmin');
INSERT INTO `user_roles` VALUES (2, 'Admin');
INSERT INTO `user_roles` VALUES (3, 'Teknisi');

SET FOREIGN_KEY_CHECKS = 1;
