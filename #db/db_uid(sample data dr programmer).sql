/*
 Navicat Premium Data Transfer

 Source Server         : locahost/mysql
 Source Server Type    : MySQL
 Source Server Version : 100411
 Source Host           : 127.0.0.1:3306
 Source Schema         : db_uid

 Target Server Type    : MySQL
 Target Server Version : 100411
 File Encoding         : 65001

 Date: 21/03/2020 13:52:06
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tb1_admin
-- ----------------------------
DROP TABLE IF EXISTS `tb1_admin`;
CREATE TABLE `tb1_admin`  (
  `kd_admin` int(6) NOT NULL AUTO_INCREMENT,
  `nama` varchar(60) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(60) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(60) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `gambar` varchar(225) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `lvl_user` int(11) NOT NULL,
  PRIMARY KEY (`kd_admin`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb1_admin
-- ----------------------------
INSERT INTO `tb1_admin` VALUES (6, 'Admin', 'admin', 'adminx', 'EOD BARU.png', 0);
INSERT INTO `tb1_admin` VALUES (7, 'Rizal Bustani S.kom', 'operator', 'operator', 'il_340x270.1381893948_7ngw.png', 1);

-- ----------------------------
-- Table structure for tb1_agama
-- ----------------------------
DROP TABLE IF EXISTS `tb1_agama`;
CREATE TABLE `tb1_agama`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `kode_agama` varchar(55) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_agama` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE,
  UNIQUE INDEX `kode_agama`(`kode_agama`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb1_agama
-- ----------------------------
INSERT INTO `tb1_agama` VALUES (4, '01', 'ISLAM', '2019-05-30 20:46:48', 6);

-- ----------------------------
-- Table structure for tb1_bulan
-- ----------------------------
DROP TABLE IF EXISTS `tb1_bulan`;
CREATE TABLE `tb1_bulan`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `bulan` varchar(22) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb1_bulan
-- ----------------------------
INSERT INTO `tb1_bulan` VALUES (1, 'Januari');
INSERT INTO `tb1_bulan` VALUES (2, 'Februari');
INSERT INTO `tb1_bulan` VALUES (3, 'Maret');
INSERT INTO `tb1_bulan` VALUES (4, 'April');
INSERT INTO `tb1_bulan` VALUES (5, 'Mei');
INSERT INTO `tb1_bulan` VALUES (6, 'Juni');
INSERT INTO `tb1_bulan` VALUES (7, 'Juli');
INSERT INTO `tb1_bulan` VALUES (8, 'Agustus');
INSERT INTO `tb1_bulan` VALUES (9, 'September');
INSERT INTO `tb1_bulan` VALUES (10, 'Oktober');
INSERT INTO `tb1_bulan` VALUES (11, 'Nopember');
INSERT INTO `tb1_bulan` VALUES (12, 'Desember');

-- ----------------------------
-- Table structure for tb1_data
-- ----------------------------
DROP TABLE IF EXISTS `tb1_data`;
CREATE TABLE `tb1_data`  (
  `no` int(255) NOT NULL AUTO_INCREMENT,
  `nama` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jabatan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tanggal` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jam` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `keterangan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `telat` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `persen` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `token` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tap` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tag` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  `image` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`no`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 128 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb1_data
-- ----------------------------
INSERT INTO `tb1_data` VALUES (41, 'Ajang Rahmat', '', '01-06-2019', '08:30:36', 'Masuk', '30', '0.25', 'Masuk01-06-2019', 'Manual', '123321', '2019-06-01 19:47:36', NULL);
INSERT INTO `tb1_data` VALUES (43, 'Wahyudi', '', '01-06-2019', '13:15:50', 'Masuk', '315', '2.5', 'Masuk01-06-20196979114118', 'Otomatis', '6979114118', '2019-06-01 20:15:50', NULL);
INSERT INTO `tb1_data` VALUES (44, 'Yuwono', '', '01-06-2019', '13:15:52', 'Masuk', '315', '2.5', 'Masuk01-06-2019134103224115', 'Otomatis', '134103224115', '2019-06-01 20:15:52', NULL);
INSERT INTO `tb1_data` VALUES (45, 'Alit Catur', '', '01-06-2019', '15:56:35', 'Masuk', '0', '0', 'Masuk01-06-20198666223115', 'Otomatis', '8666223115', '2019-06-01 22:56:35', NULL);
INSERT INTO `tb1_data` VALUES (46, 'Asfiatul Hanifah', '', '01-06-2019', '16:17:48', 'Keluar', '13', '0.25', 'Keluar01-06-20198919414280', 'Otomatis', '8919414280', '2019-06-01 23:17:48', NULL);
INSERT INTO `tb1_data` VALUES (47, 'Wahyudi', '', '01-06-2019', '16:17:59', 'Keluar', '13', '0.25', 'Keluar01-06-20196979114118', 'Otomatis', '6979114118', '2019-06-01 23:17:59', NULL);
INSERT INTO `tb1_data` VALUES (53, 'Alit Catur', '', '02-06-2019', '16:37:10', 'Masuk', '0', '0', 'Masuk02-06-20198666223115', 'Manual', '8666223115', '2019-06-02 23:37:10', NULL);
INSERT INTO `tb1_data` VALUES (54, 'Asfiatul Hanifah', '', '03-06-2019', '09:29:15', 'Masuk', '89', '2.5', 'Masuk03-06-20198919414280', 'Otomatis', '8919414280', '2019-06-03 16:29:15', NULL);
INSERT INTO `tb1_data` VALUES (55, 'Yuwono', '', '03-06-2019', '09:29:31', 'Masuk', '89', '2.5', 'Masuk03-06-2019134103224115', 'Otomatis', '134103224115', '2019-06-03 16:29:31', NULL);
INSERT INTO `tb1_data` VALUES (56, 'Wahyudi', '', '03-06-2019', '09:29:33', 'Masuk', '89', '2.5', 'Masuk03-06-20196979114118', 'Otomatis', '6979114118', '2019-06-03 16:29:33', NULL);
INSERT INTO `tb1_data` VALUES (57, 'Asfiatul Hanifah', '', '10-06-2019', '12:12:10', 'Masuk', '252', '2.5', 'Masuk10-06-20198919414280', 'Otomatis', '8919414280', '2019-06-10 19:12:10', NULL);
INSERT INTO `tb1_data` VALUES (58, 'Wahyudi', '', '10-06-2019', '12:12:23', 'Masuk', '252', '2.5', 'Masuk10-06-20196979114118', 'Otomatis', '6979114118', '2019-06-10 19:12:23', NULL);
INSERT INTO `tb1_data` VALUES (59, 'Yuwono', '', '10-06-2019', '12:12:25', 'Masuk', '252', '2.5', 'Masuk10-06-2019134103224115', 'Otomatis', '134103224115', '2019-06-10 19:12:25', NULL);
INSERT INTO `tb1_data` VALUES (60, 'Asfiatul Hanifah', '', '10-06-2019', '16:42:08', 'Keluar', '0', '0', 'Keluar10-06-20198919414280', 'Otomatis', '8919414280', '2019-06-10 23:42:08', NULL);
INSERT INTO `tb1_data` VALUES (61, 'Wahyudi', '', '10-06-2019', '16:42:15', 'Keluar', '0', '0', 'Keluar10-06-20196979114118', 'Otomatis', '6979114118', '2019-06-10 23:42:15', NULL);
INSERT INTO `tb1_data` VALUES (62, 'Yuwono', '', '10-06-2019', '16:42:18', 'Keluar', '0', '0', 'Keluar10-06-2019134103224115', 'Otomatis', '134103224115', '2019-06-10 23:42:18', NULL);
INSERT INTO `tb1_data` VALUES (63, 'Asfiatul Hanifah', '', '11-06-2019', '09:04:44', 'Masuk', '64', '2.5', 'Masuk11-06-20198919414280', 'Otomatis', '8919414280', '2019-06-11 16:04:44', NULL);
INSERT INTO `tb1_data` VALUES (64, 'Yuwono', '', '11-06-2019', '09:04:53', 'Masuk', '64', '2.5', 'Masuk11-06-2019134103224115', 'Otomatis', '134103224115', '2019-06-11 16:04:53', NULL);
INSERT INTO `tb1_data` VALUES (65, 'Wahyudi', '', '11-06-2019', '08:04:56', 'Masuk', '4', '0', 'Masuk11-06-20196979114118', 'Otomatis', '6979114118', '2019-06-11 16:04:56', NULL);
INSERT INTO `tb1_data` VALUES (66, 'Asfiatul Hanifah', '', '11-06-2019', '16:28:27', 'Keluar', '2', '0', 'Keluar11-06-20198919414280', 'Otomatis', '8919414280', '2019-06-11 23:28:27', NULL);
INSERT INTO `tb1_data` VALUES (67, 'Yuwono', '', '11-06-2019', '16:28:33', 'Keluar', '2', '0', 'Keluar11-06-2019134103224115', 'Otomatis', '134103224115', '2019-06-11 23:28:33', NULL);
INSERT INTO `tb1_data` VALUES (68, 'Wahyudi', '', '11-06-2019', '16:28:35', 'Keluar', '2', '0', 'Keluar11-06-20196979114118', 'Otomatis', '6979114118', '2019-06-11 23:28:35', NULL);
INSERT INTO `tb1_data` VALUES (69, 'Alit Catur', '', '11-06-2019', '16:28:42', 'Masuk', '0', '0', 'Masuk11-06-20198666223115', 'Otomatis', '8666223115', '2019-06-11 23:28:42', NULL);
INSERT INTO `tb1_data` VALUES (70, 'Asfiatul Hanifah', '', '12-06-2019', '09:12:53', 'Masuk', '72', '2.5', 'Masuk12-06-20198919414280', 'Otomatis', '8919414280', '2019-06-12 16:12:53', NULL);
INSERT INTO `tb1_data` VALUES (71, 'Yuwono', '', '12-06-2019', '09:13:00', 'Masuk', '73', '2.5', 'Masuk12-06-2019134103224115', 'Otomatis', '134103224115', '2019-06-12 16:13:00', NULL);
INSERT INTO `tb1_data` VALUES (72, 'Wahyudi', '', '12-06-2019', '09:13:02', 'Masuk', '73', '2.5', 'Masuk12-06-20196979114118', 'Otomatis', '6979114118', '2019-06-12 16:13:02', NULL);
INSERT INTO `tb1_data` VALUES (73, 'Asfiatul Hanifah', '', '14-06-2019', '12:27:21', 'Masuk', '267', '2.5', 'Masuk14-06-20198919414280', 'Otomatis', '8919414280', '2019-06-14 19:27:21', NULL);
INSERT INTO `tb1_data` VALUES (74, 'Yuwono', '', '14-06-2019', '12:27:24', 'Masuk', '267', '2.5', 'Masuk14-06-2019134103224115', 'Otomatis', '134103224115', '2019-06-14 19:27:24', NULL);
INSERT INTO `tb1_data` VALUES (75, 'Wahyudi', '', '14-06-2019', '12:27:26', 'Masuk', '267', '2.5', 'Masuk14-06-20196979114118', 'Otomatis', '6979114118', '2019-06-14 19:27:26', NULL);
INSERT INTO `tb1_data` VALUES (76, 'Asfiatul Hanifah', '', '14-06-2019', '16:35:33', 'Keluar', '0', '0', 'Keluar14-06-20198919414280', 'Otomatis', '8919414280', '2019-06-14 23:35:33', NULL);
INSERT INTO `tb1_data` VALUES (77, 'Yuwono', '', '14-06-2019', '16:35:40', 'Keluar', '0', '0', 'Keluar14-06-2019134103224115', 'Otomatis', '134103224115', '2019-06-14 23:35:40', NULL);
INSERT INTO `tb1_data` VALUES (78, 'Wahyudi', '', '14-06-2019', '16:35:42', 'Keluar', '0', '0', 'Keluar14-06-20196979114118', 'Otomatis', '6979114118', '2019-06-14 23:35:42', NULL);
INSERT INTO `tb1_data` VALUES (79, 'Alit Catur', '', '14-06-2019', '16:39:20', 'Masuk', '0', '0', 'Masuk14-06-20198666223115', 'Otomatis', '8666223115', '2019-06-14 23:39:20', NULL);
INSERT INTO `tb1_data` VALUES (80, 'Alit Catur', '', '17-06-2019', '19:39:20', 'Masuk', '99', '2.5', 'Masuk17-06-20198666223115', 'Otomatis', '8666223115', '2019-06-18 02:39:20', NULL);
INSERT INTO `tb1_data` VALUES (81, 'Yuwono', '', '17-06-2019', '19:39:25', 'Keluar', '0', '0', 'Keluar17-06-2019134103224115', 'Otomatis', '134103224115', '2019-06-18 02:39:25', NULL);
INSERT INTO `tb1_data` VALUES (82, 'Wahyudi', '', '17-06-2019', '19:39:27', 'Keluar', '0', '0', 'Keluar17-06-20196979114118', 'Otomatis', '6979114118', '2019-06-18 02:39:27', NULL);
INSERT INTO `tb1_data` VALUES (83, 'Alit Catur', '', '19-06-2019', '21:26:06', 'Masuk', '206', '2.5', 'Masuk19-06-20198666223115', 'Otomatis', '8666223115', '2019-06-20 04:26:06', NULL);
INSERT INTO `tb1_data` VALUES (84, 'Asfiatul Hanifah', '', '20-06-2019', '16:30:18', 'Keluar', '0', '0', 'Keluar20-06-20198919414280', 'Otomatis', '8919414280', '2019-06-20 23:30:18', NULL);
INSERT INTO `tb1_data` VALUES (85, 'Yuwono', '', '20-06-2019', '16:30:25', 'Keluar', '0', '0', 'Keluar20-06-2019134103224115', 'Otomatis', '134103224115', '2019-06-20 23:30:25', NULL);
INSERT INTO `tb1_data` VALUES (86, 'Wahyudi', '', '20-06-2019', '16:30:27', 'Keluar', '0', '0', 'Keluar20-06-20196979114118', 'Otomatis', '6979114118', '2019-06-20 23:30:27', NULL);
INSERT INTO `tb1_data` VALUES (87, 'Alit Catur', '', '20-06-2019', '16:38:32', 'Masuk', '0', '0', 'Masuk20-06-20198666223115', 'Otomatis', '8666223115', '2019-06-20 23:38:32', NULL);
INSERT INTO `tb1_data` VALUES (88, 'Asfiatul Hanifah', '', '21-06-2019', '10:00:31', 'Masuk', '120', '2.5', 'Masuk21-06-20198919414280', 'Otomatis', '8919414280', '2019-06-21 17:00:31', NULL);
INSERT INTO `tb1_data` VALUES (89, 'Yuwono', '', '21-06-2019', '10:00:35', 'Masuk', '120', '2.5', 'Masuk21-06-2019134103224115', 'Otomatis', '134103224115', '2019-06-21 17:00:35', NULL);
INSERT INTO `tb1_data` VALUES (90, 'Wahyudi', '', '21-06-2019', '10:00:36', 'Masuk', '120', '2.5', 'Masuk21-06-20196979114118', 'Otomatis', '6979114118', '2019-06-21 17:00:36', NULL);
INSERT INTO `tb1_data` VALUES (91, 'Asfiatul Hanifah', '', '21-06-2019', '17:00:29', 'Keluar', '0', '0', 'Keluar21-06-20198919414280', 'Otomatis', '8919414280', '2019-06-22 00:00:29', NULL);
INSERT INTO `tb1_data` VALUES (92, 'Yuwono', '', '21-06-2019', '17:00:35', 'Keluar', '0', '0', 'Keluar21-06-2019134103224115', 'Otomatis', '134103224115', '2019-06-22 00:00:35', NULL);
INSERT INTO `tb1_data` VALUES (93, 'Wahyudi', '', '21-06-2019', '17:00:38', 'Keluar', '0', '0', 'Keluar21-06-20196979114118', 'Otomatis', '6979114118', '2019-06-22 00:00:38', NULL);
INSERT INTO `tb1_data` VALUES (94, 'Alit Catur', '', '21-06-2019', '17:32:41', 'Masuk', '0', '0', 'Masuk21-06-20198666223115', 'Otomatis', '8666223115', '2019-06-22 00:32:41', NULL);
INSERT INTO `tb1_data` VALUES (95, 'Asfiatul Hanifah', '', '25-06-2019', '09:25:12', 'Masuk', '85', '2.5', 'Masuk25-06-20198919414280', 'Otomatis', '8919414280', '2019-06-25 16:25:12', NULL);
INSERT INTO `tb1_data` VALUES (96, 'Yuwono', '', '25-06-2019', '09:25:17', 'Masuk', '85', '2.5', 'Masuk25-06-2019134103224115', 'Otomatis', '134103224115', '2019-06-25 16:25:17', NULL);
INSERT INTO `tb1_data` VALUES (97, 'Wahyudi', '', '25-06-2019', '09:25:19', 'Masuk', '85', '2.5', 'Masuk25-06-20196979114118', 'Otomatis', '6979114118', '2019-06-25 16:25:19', NULL);
INSERT INTO `tb1_data` VALUES (98, 'Wahyudi', '', '25-06-2019', '18:22:58', 'Keluar', '0', '0', 'Keluar25-06-20196979114118', 'Otomatis', '6979114118', '2019-06-26 01:22:58', NULL);
INSERT INTO `tb1_data` VALUES (99, 'Yuwono', '', '25-06-2019', '18:23:00', 'Keluar', '0', '0', 'Keluar25-06-2019134103224115', 'Otomatis', '134103224115', '2019-06-26 01:23:00', NULL);
INSERT INTO `tb1_data` VALUES (100, 'Alit Catur', '', '25-06-2019', '18:23:01', 'Masuk', '23', '0.25', 'Masuk25-06-20198666223115', 'Otomatis', '8666223115', '2019-06-26 01:23:01', NULL);
INSERT INTO `tb1_data` VALUES (101, 'Asfiatul Hanifah', '', '25-06-2019', '18:23:05', 'Keluar', '0', '0', 'Keluar25-06-20198919414280', 'Otomatis', '8919414280', '2019-06-26 01:23:05', NULL);
INSERT INTO `tb1_data` VALUES (102, 'Asfiatul Hanifah', '', '26-06-2019', '09:08:49', 'Masuk', '68', '2.5', 'Masuk26-06-20198919414280', 'Otomatis', '8919414280', '2019-06-26 16:08:49', NULL);
INSERT INTO `tb1_data` VALUES (103, 'Yuwono', '', '26-06-2019', '09:08:54', 'Masuk', '68', '2.5', 'Masuk26-06-2019134103224115', 'Otomatis', '134103224115', '2019-06-26 16:08:54', NULL);
INSERT INTO `tb1_data` VALUES (104, 'Wahyudi', '', '26-06-2019', '09:08:56', 'Masuk', '68', '2.5', 'Masuk26-06-20196979114118', 'Otomatis', '6979114118', '2019-06-26 16:08:56', NULL);
INSERT INTO `tb1_data` VALUES (105, 'Asfiatul Hanifah', '', '26-06-2019', '16:30:13', 'Keluar', '0', '0', 'Keluar26-06-20198919414280', 'Otomatis', '8919414280', '2019-06-26 23:30:13', NULL);
INSERT INTO `tb1_data` VALUES (106, 'Wahyudi', '', '26-06-2019', '16:30:29', 'Keluar', '0', '0', 'Keluar26-06-20196979114118', 'Otomatis', '6979114118', '2019-06-26 23:30:29', NULL);
INSERT INTO `tb1_data` VALUES (107, 'Yuwono', '', '26-06-2019', '16:30:31', 'Keluar', '0', '0', 'Keluar26-06-2019134103224115', 'Otomatis', '134103224115', '2019-06-26 23:30:31', NULL);
INSERT INTO `tb1_data` VALUES (108, 'Alit Catur', '', '26-06-2019', '17:33:35', 'Masuk', '0', '0', 'Masuk26-06-20198666223115', 'Otomatis', '8666223115', '2019-06-27 00:33:35', NULL);
INSERT INTO `tb1_data` VALUES (109, 'Asfiatul Hanifah', '', '27-06-2019', '18:01:40', 'Keluar', '0', '0', 'Keluar27-06-20198919414280', 'Otomatis', '8919414280', '2019-06-28 01:01:41', NULL);
INSERT INTO `tb1_data` VALUES (110, 'Wahyudi', '', '27-06-2019', '18:01:56', 'Keluar', '0', '0', 'Keluar27-06-20196979114118', 'Otomatis', '6979114118', '2019-06-28 01:01:56', NULL);
INSERT INTO `tb1_data` VALUES (111, 'Yuwono', '', '27-06-2019', '18:01:58', 'Keluar', '0', '0', 'Keluar27-06-2019134103224115', 'Otomatis', '134103224115', '2019-06-28 01:01:58', NULL);
INSERT INTO `tb1_data` VALUES (112, 'Alit Catur', '', '27-06-2019', '18:02:02', 'Masuk', '2', '0', 'Masuk27-06-20198666223115', 'Otomatis', '8666223115', '2019-06-28 01:02:02', NULL);
INSERT INTO `tb1_data` VALUES (113, 'Asfiatul Hanifah', '', '28-06-2019', '11:24:49', 'Masuk', '204', '2.5', 'Masuk28-06-20198919414280', 'Otomatis', '8919414280', '2019-06-28 18:24:49', NULL);
INSERT INTO `tb1_data` VALUES (114, 'Yuwono', '', '28-06-2019', '11:24:56', 'Masuk', '204', '2.5', 'Masuk28-06-2019134103224115', 'Otomatis', '134103224115', '2019-06-28 18:24:56', NULL);
INSERT INTO `tb1_data` VALUES (115, 'Wahyudi', '', '28-06-2019', '11:24:57', 'Masuk', '204', '2.5', 'Masuk28-06-20196979114118', 'Otomatis', '6979114118', '2019-06-28 18:24:57', NULL);
INSERT INTO `tb1_data` VALUES (116, 'Asfiatul Hanifah', '', '28-06-2019', '18:19:37', 'Keluar', '0', '0', 'Keluar28-06-20198919414280', 'Otomatis', '8919414280', '2019-06-29 01:19:37', NULL);
INSERT INTO `tb1_data` VALUES (117, 'Alit Catur', '', '28-06-2019', '18:19:41', 'Masuk', '19', '0.25', 'Masuk28-06-20198666223115', 'Otomatis', '8666223115', '2019-06-29 01:19:41', NULL);
INSERT INTO `tb1_data` VALUES (118, 'Yuwono', '', '28-06-2019', '18:19:43', 'Keluar', '0', '0', 'Keluar28-06-2019134103224115', 'Otomatis', '134103224115', '2019-06-29 01:19:43', NULL);
INSERT INTO `tb1_data` VALUES (119, 'Wahyudi', '', '28-06-2019', '18:19:44', 'Keluar', '0', '0', 'Keluar28-06-20196979114118', 'Otomatis', '6979114118', '2019-06-29 01:19:44', NULL);
INSERT INTO `tb1_data` VALUES (120, 'Asfiatul Hanifah', '', '03-07-2019', '18:01:19', 'Keluar', '0', '0', 'Keluar03-07-20198919414280', 'Otomatis', '8919414280', '2019-07-04 01:01:19', NULL);
INSERT INTO `tb1_data` VALUES (121, 'Wahyudi', '', '03-07-2019', '18:01:25', 'Keluar', '0', '0', 'Keluar03-07-20196979114118', 'Otomatis', '6979114118', '2019-07-04 01:01:25', NULL);
INSERT INTO `tb1_data` VALUES (122, 'Yuwono', '', '03-07-2019', '18:01:27', 'Keluar', '0', '0', 'Keluar03-07-2019134103224115', 'Otomatis', '134103224115', '2019-07-04 01:01:27', NULL);
INSERT INTO `tb1_data` VALUES (123, 'Alit Catur', '', '03-07-2019', '18:01:28', 'Masuk', '1', '0', 'Masuk03-07-20198666223115', 'Otomatis', '8666223115', '2019-07-04 01:01:28', NULL);
INSERT INTO `tb1_data` VALUES (124, 'Asfiatul Hanifah', '', '19-07-2019', '09:43:00', 'Masuk', '103', '2.5', 'Masuk19-07-20198919414280', 'Otomatis', '8919414280', '2019-07-19 16:43:00', NULL);
INSERT INTO `tb1_data` VALUES (125, 'Wahyudi', '', '19-07-2019', '09:43:04', 'Masuk', '103', '2.5', 'Masuk19-07-20196979114118', 'Otomatis', '6979114118', '2019-07-19 16:43:04', NULL);
INSERT INTO `tb1_data` VALUES (126, 'Yuwono', '', '19-07-2019', '09:43:05', 'Masuk', '103', '2.5', 'Masuk19-07-2019134103224115', 'Otomatis', '134103224115', '2019-07-19 16:43:05', NULL);
INSERT INTO `tb1_data` VALUES (127, 'Alit Catur', '', '19-07-2019', '10:30:47', 'Masuk', '0', '0', 'Masuk19-07-20198666223115', 'Otomatis', '8666223115', '2019-07-19 17:30:47', '1563507047.jpg');

-- ----------------------------
-- Table structure for tb1_divisi
-- ----------------------------
DROP TABLE IF EXISTS `tb1_divisi`;
CREATE TABLE `tb1_divisi`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `kode_divisi` varchar(22) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_divisi` varchar(66) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  PRIMARY KEY (`ID`) USING BTREE,
  UNIQUE INDEX `kode_divisi`(`kode_divisi`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb1_divisi
-- ----------------------------
INSERT INTO `tb1_divisi` VALUES (2, '01', 'Keuangan', '2019-05-27 19:13:04');
INSERT INTO `tb1_divisi` VALUES (4, '02', 'Humas', '2019-05-30 15:17:33');
INSERT INTO `tb1_divisi` VALUES (5, '03', 'Kebersihan', '2019-05-30 23:12:23');
INSERT INTO `tb1_divisi` VALUES (6, '04', 'Pasukan', '2019-05-31 18:33:40');

-- ----------------------------
-- Table structure for tb1_hari_kerja
-- ----------------------------
DROP TABLE IF EXISTS `tb1_hari_kerja`;
CREATE TABLE `tb1_hari_kerja`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `bulan` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `hari_kerja` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb1_hari_kerja
-- ----------------------------
INSERT INTO `tb1_hari_kerja` VALUES (2, 1, 2019, 29, 6);
INSERT INTO `tb1_hari_kerja` VALUES (3, 3, 2019, 22, 6);
INSERT INTO `tb1_hari_kerja` VALUES (4, 6, 2019, 24, 6);

-- ----------------------------
-- Table structure for tb1_hari_libur
-- ----------------------------
DROP TABLE IF EXISTS `tb1_hari_libur`;
CREATE TABLE `tb1_hari_libur`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `keterangan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb1_hari_libur
-- ----------------------------
INSERT INTO `tb1_hari_libur` VALUES (1, '2019-05-10', 'Libur lebaran bos', '2019-05-30 14:48:25', 6);

-- ----------------------------
-- Table structure for tb1_jabatan
-- ----------------------------
DROP TABLE IF EXISTS `tb1_jabatan`;
CREATE TABLE `tb1_jabatan`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `kode_jabatan` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_jabatan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE,
  UNIQUE INDEX `kode_jabatan`(`kode_jabatan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb1_jabatan
-- ----------------------------
INSERT INTO `tb1_jabatan` VALUES (17, '01', 'Eselon III', '2019-05-30 14:28:20', 0);
INSERT INTO `tb1_jabatan` VALUES (18, '02', 'Eselon VI', '2019-05-30 14:28:30', 0);
INSERT INTO `tb1_jabatan` VALUES (19, '03', 'Eselon V', '2019-05-30 14:34:01', 6);

-- ----------------------------
-- Table structure for tb1_karyawan
-- ----------------------------
DROP TABLE IF EXISTS `tb1_karyawan`;
CREATE TABLE `tb1_karyawan`  (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `tag` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `jenis_kelamin` int(11) NOT NULL,
  `no_induk` varchar(222) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `no_hp` varchar(22) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `alamat` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kota` varchar(222) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `provinsi` varchar(111) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kode_pos` varchar(11) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `goldar` varchar(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_agama` int(11) NOT NULL,
  `id_status_kawin` varchar(11) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_divisi` int(11) NOT NULL,
  `pendidikan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `gelar` varchar(22) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `no_sk` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nip` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_kategori_karyawan` int(11) NOT NULL,
  `npwp` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `norek` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status` varchar(11) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '1',
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 37 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb1_karyawan
-- ----------------------------

-- ----------------------------
-- Table structure for tb1_kategori_karyawan
-- ----------------------------
DROP TABLE IF EXISTS `tb1_kategori_karyawan`;
CREATE TABLE `tb1_kategori_karyawan`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `kode_katkaryawan` varchar(22) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_katkaryawan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT current_timestamp(0),
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE,
  UNIQUE INDEX `kode_katkaryawan`(`kode_katkaryawan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb1_kategori_karyawan
-- ----------------------------
INSERT INTO `tb1_kategori_karyawan` VALUES (1, '01', 'karyawan tetap', '2019-05-30 21:43:06', 6);
INSERT INTO `tb1_kategori_karyawan` VALUES (2, '02', 'Karyawan Tidak Tetap', '2019-05-31 11:54:48', 6);

-- ----------------------------
-- Table structure for tb1_kelamin
-- ----------------------------
DROP TABLE IF EXISTS `tb1_kelamin`;
CREATE TABLE `tb1_kelamin`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kelamin` varchar(22) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb1_kelamin
-- ----------------------------
INSERT INTO `tb1_kelamin` VALUES (1, 'Laki-Laki');
INSERT INTO `tb1_kelamin` VALUES (2, 'Perempuan');

-- ----------------------------
-- Table structure for tb1_pangkat
-- ----------------------------
DROP TABLE IF EXISTS `tb1_pangkat`;
CREATE TABLE `tb1_pangkat`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `kode_pangkat` varchar(22) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_pangkat` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE,
  UNIQUE INDEX `kode_pangkat`(`kode_pangkat`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb1_pangkat
-- ----------------------------
INSERT INTO `tb1_pangkat` VALUES (1, 'komandan', 'komandan', '2019-05-30 21:02:46', 6);

-- ----------------------------
-- Table structure for tb1_setting
-- ----------------------------
DROP TABLE IF EXISTS `tb1_setting`;
CREATE TABLE `tb1_setting`  (
  `no` int(255) NOT NULL AUTO_INCREMENT,
  `jam` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `menit` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `telat1a` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `telat1b` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `telat2a` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `telat2b` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `telat3a` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `telat3b` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `persen1` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `persen2` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `persen3` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `persen4` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `batas1` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `batas2` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`no`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb1_setting
-- ----------------------------
INSERT INTO `tb1_setting` VALUES (1, '08', '0', '5', '30', '31', '60', '61', '120', '0.25', '1', '2', '2.5', '08', '10');
INSERT INTO `tb1_setting` VALUES (2, '16', '30', '5', '30', '31', '60', '61', '120', '0.25', '1', '2', '2.5', '15', '20');

-- ----------------------------
-- Table structure for tb1_setting2
-- ----------------------------
DROP TABLE IF EXISTS `tb1_setting2`;
CREATE TABLE `tb1_setting2`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no` int(255) NOT NULL,
  `jam` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `menit` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `telat1a` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `telat1b` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `telat2a` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `telat2b` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `telat3a` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `telat3b` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `persen1` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `persen2` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `persen3` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `persen4` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `batas1` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `batas2` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tag` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_divisi` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  `isActive` int(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 53 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb1_setting2
-- ----------------------------
INSERT INTO `tb1_setting2` VALUES (1, 1, '08', '00', '5', '30', '31', '60', '61', '120', '0.25', '1', '2.5', '2.5', '06', '15', '01', 23, '0000-00-00 00:00:00', 1);
INSERT INTO `tb1_setting2` VALUES (2, 2, '16', '30', '5', '30', '31', '60', '61', '120', '0.25', '1', '2.5', '2.5', '16', '18', '01', 23, '0000-00-00 00:00:00', 1);
INSERT INTO `tb1_setting2` VALUES (3, 1, '08', '00', '5', '30', '31', '60', '61', '120', '0.25', '1', '2.5', '2.5', '06', '16', '03', 25, '0000-00-00 00:00:00', 1);
INSERT INTO `tb1_setting2` VALUES (15, 2, '17', '00', '5', '30', '31', '60', '61', '120', '0.25', '1', '2', '0', '15', '19', '03', 25, '0000-00-00 00:00:00', 1);
INSERT INTO `tb1_setting2` VALUES (16, 1, '08', '00', '5', '30', '31', '60', '61', '120', '0.25', '1', '2.5', '2.5', '08', '15', '02', 24, '0000-00-00 00:00:00', 1);
INSERT INTO `tb1_setting2` VALUES (17, 1, '18', '00', '5', '30', '31', '60', '61', '120', '0.25', '1', '2.5', '2.5', '08', '21', '04', 26, '0000-00-00 00:00:00', 1);
INSERT INTO `tb1_setting2` VALUES (18, 2, '16', '30', '5', '30', '31', '60', '61', '120', '0.25', '1', '2.5', '0', '15', '19', '02', 24, '0000-00-00 00:00:00', 1);
INSERT INTO `tb1_setting2` VALUES (19, 2, '01', '30', '5', '30', '31', '60', '61', '120', '0.25', '1', '2.5', '0', '23', '0003', '04', 26, '0000-00-00 00:00:00', 1);

-- ----------------------------
-- Table structure for tb1_status_pernikahan
-- ----------------------------
DROP TABLE IF EXISTS `tb1_status_pernikahan`;
CREATE TABLE `tb1_status_pernikahan`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `kode_nikah` varchar(22) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `keterangan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE,
  UNIQUE INDEX `kode_nikah`(`kode_nikah`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb1_status_pernikahan
-- ----------------------------
INSERT INTO `tb1_status_pernikahan` VALUES (2, '01', 'Lajang', '2019-05-30 20:55:48', 6);
INSERT INTO `tb1_status_pernikahan` VALUES (3, '02', 'Kawin', '2019-05-31 12:48:50', 6);
INSERT INTO `tb1_status_pernikahan` VALUES (4, '03', 'Janda/Duda', '2019-05-31 12:48:58', 6);

-- ----------------------------
-- Table structure for tb1_tag
-- ----------------------------
DROP TABLE IF EXISTS `tb1_tag`;
CREATE TABLE `tb1_tag`  (
  `no` int(255) NOT NULL AUTO_INCREMENT,
  `tag` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`no`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb1_tag
-- ----------------------------
INSERT INTO `tb1_tag` VALUES (1, '23047223115');
INSERT INTO `tb1_tag` VALUES (2, '19838233115');

-- ----------------------------
-- Table structure for tb2_setting
-- ----------------------------
DROP TABLE IF EXISTS `tb2_setting`;
CREATE TABLE `tb2_setting`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `param` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `id_parent` int(11) NULL DEFAULT NULL,
  `order` int(11) NULL DEFAULT NULL,
  `isActive` int(11) NULL DEFAULT 1,
  `isFixed` int(11) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 163 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb2_setting
-- ----------------------------
INSERT INTO `tb2_setting` VALUES (1, 'agama', 'Agama', 'Opsi agama', NULL, NULL, 1, 0);
INSERT INTO `tb2_setting` VALUES (8, '01', 'Islam', NULL, 1, NULL, 1, 0);
INSERT INTO `tb2_setting` VALUES (9, '02', 'Protestan', NULL, 1, NULL, 1, 0);
INSERT INTO `tb2_setting` VALUES (10, '03', 'Katholik', NULL, 1, NULL, 1, 0);
INSERT INTO `tb2_setting` VALUES (11, '04', 'Hindu', NULL, 1, NULL, 1, 0);
INSERT INTO `tb2_setting` VALUES (12, '05', 'Budha', NULL, 1, NULL, 1, 0);
INSERT INTO `tb2_setting` VALUES (13, '06', 'Konghuchu', NULL, 1, NULL, 1, 0);
INSERT INTO `tb2_setting` VALUES (14, 'status_pernikahan', 'Status Nikah', 'Parameter status nikah karyawan', NULL, NULL, 1, 0);
INSERT INTO `tb2_setting` VALUES (15, '01', 'Lajang', NULL, 14, NULL, 1, 0);
INSERT INTO `tb2_setting` VALUES (16, '02', 'Kawin', NULL, 14, NULL, 1, 0);
INSERT INTO `tb2_setting` VALUES (17, '03', 'Janda/Duda', NULL, 14, NULL, 1, 0);
INSERT INTO `tb2_setting` VALUES (18, 'jabatan', 'Jabatan', 'Parameter jabatan karyawan', NULL, NULL, 1, 0);
INSERT INTO `tb2_setting` VALUES (19, '01', 'Eselon III', NULL, 18, NULL, 1, 0);
INSERT INTO `tb2_setting` VALUES (20, '02', 'Eselon IV', NULL, 18, NULL, 1, 0);
INSERT INTO `tb2_setting` VALUES (21, '03', 'Eselon V', NULL, 18, NULL, 1, 0);
INSERT INTO `tb2_setting` VALUES (22, 'divisi', 'Divisi', 'Parameter divisi dari karyawan', NULL, NULL, 1, 0);
INSERT INTO `tb2_setting` VALUES (23, '01', 'Keuangan', NULL, 22, NULL, 1, 0);
INSERT INTO `tb2_setting` VALUES (24, '02', 'Humas', NULL, 22, NULL, 1, 0);
INSERT INTO `tb2_setting` VALUES (25, '03', 'Kebersihan', NULL, 22, NULL, 1, 0);
INSERT INTO `tb2_setting` VALUES (26, '04', 'Pasukan', NULL, 22, NULL, 1, 0);
INSERT INTO `tb2_setting` VALUES (27, 'hari_libur', 'Libur Tgl Merah', 'List Hari libur (tanggal merah/hari besar)', NULL, NULL, 1, 0);
INSERT INTO `tb2_setting` VALUES (28, '2019-01-22', 'Ultah Bos', NULL, 27, NULL, 1, 0);
INSERT INTO `tb2_setting` VALUES (39, 'kategori_karyawan', 'Kategori Karyawan', 'Parameter kategori karyawan tetap/tidak tetap', NULL, NULL, 1, 0);
INSERT INTO `tb2_setting` VALUES (40, '01', 'karyawan tetap', NULL, 39, NULL, 1, 0);
INSERT INTO `tb2_setting` VALUES (41, '02', 'karyawan tidak tetap', NULL, 39, NULL, 1, 0);
INSERT INTO `tb2_setting` VALUES (46, 'tipe_presensi', 'Tipe Presensi', 'Parameter untuk karyawan melakukan presensi harian atau lainnya', NULL, NULL, 1, 1);
INSERT INTO `tb2_setting` VALUES (47, 'harian', 'Presensi Harian', NULL, 46, NULL, 1, 0);
INSERT INTO `tb2_setting` VALUES (48, 'diklat', 'DIKLAT', NULL, 46, NULL, 1, 0);
INSERT INTO `tb2_setting` VALUES (49, 'skj', 'SKJ', NULL, 46, NULL, 1, 0);
INSERT INTO `tb2_setting` VALUES (50, 'dispensasi', 'Dispensasi', NULL, 46, NULL, 1, 0);
INSERT INTO `tb2_setting` VALUES (71, '2020-01-25', 'imlek', NULL, 27, NULL, 1, 0);
INSERT INTO `tb2_setting` VALUES (72, '2020-03-25', 'isra mi\'raj', NULL, 27, NULL, 1, 0);
INSERT INTO `tb2_setting` VALUES (73, '2020-03-22', 'Nyepi', NULL, 27, NULL, 1, 0);
INSERT INTO `tb2_setting` VALUES (74, '2020-05-01', 'Hari Buruh', NULL, 27, NULL, 1, 0);
INSERT INTO `tb2_setting` VALUES (75, 'hari_libur_2', 'Libur Weekend', 'Parameter hari libur akhir pekan karyawan berdasarkan divisinya', NULL, NULL, 1, 0);
INSERT INTO `tb2_setting` VALUES (88, '2020-02-05', 'ultah adiknya bos x', NULL, 27, NULL, 1, 0);
INSERT INTO `tb2_setting` VALUES (94, '1', '1', NULL, 1, NULL, 0, 0);
INSERT INTO `tb2_setting` VALUES (134, '2020-02-06', 'Nyepi', NULL, 27, NULL, 1, 0);
INSERT INTO `tb2_setting` VALUES (143, '24', 'minggu', NULL, 75, NULL, 1, 0);
INSERT INTO `tb2_setting` VALUES (154, '2020-02-15', 'fogging kantor', NULL, 27, NULL, 1, 0);
INSERT INTO `tb2_setting` VALUES (155, '25', 'minggu', NULL, 75, NULL, 1, 0);
INSERT INTO `tb2_setting` VALUES (159, '26', 'jumat', NULL, 75, NULL, 1, 0);
INSERT INTO `tb2_setting` VALUES (160, '26', 'sabtu', NULL, 75, NULL, 1, 0);
INSERT INTO `tb2_setting` VALUES (161, '26', 'minggu', NULL, 75, NULL, 1, 0);
INSERT INTO `tb2_setting` VALUES (162, '23', 'minggu', NULL, 75, NULL, 1, 0);

-- ----------------------------
-- Table structure for tb_absen
-- ----------------------------
DROP TABLE IF EXISTS `tb_absen`;
CREATE TABLE `tb_absen`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_karyawan` int(11) NOT NULL,
  `masuk` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `keluar` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `masuk_minus` int(11) NOT NULL,
  `keluar_minus` int(11) NOT NULL,
  `kat_terlambat_masuk` int(11) NOT NULL,
  `kat_terlambat_keluar` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `capture` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `keterangan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `terlambat` int(11) NOT NULL,
  `potongan_keluar` float(11, 2) NOT NULL,
  `potongan_masuk` float(11, 2) NOT NULL,
  `potongan` float(11, 2) NOT NULL,
  `mode` enum('otomatis','manual') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_tipe_presensi` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 224 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_absen
-- ----------------------------
INSERT INTO `tb_absen` VALUES (197, 48, '18:33', '01:35', 33, 0, 2, 0, '2020-03-12', 'H', NULL, '', 33, 0.00, 1.00, 1.00, 'manual', 47);
INSERT INTO `tb_absen` VALUES (199, 48, '18:45', '01:35', 45, 0, 2, 0, '2020-03-10', 'H', NULL, '', 45, 0.00, 1.00, 1.00, 'manual', 47);
INSERT INTO `tb_absen` VALUES (200, 48, '18:00', '', 0, 0, 0, 0, '2020-03-09', 'H', NULL, '', 0, 0.00, 0.00, 0.00, 'manual', 47);
INSERT INTO `tb_absen` VALUES (201, 48, '18:00', '01:00', 0, 30, 0, 1, '2020-03-05', 'H', NULL, '', 30, 0.25, 0.00, 0.25, 'manual', 47);
INSERT INTO `tb_absen` VALUES (202, 48, '18:00', '01:35', 0, 0, 0, 0, '2020-03-04', 'H', NULL, '', 0, 0.00, 0.00, 0.00, 'manual', 47);
INSERT INTO `tb_absen` VALUES (203, 48, '18:00', '01:35', 0, 0, 0, 0, '2020-03-03', 'H', NULL, '', 0, 0.00, 0.00, 0.00, 'manual', 47);
INSERT INTO `tb_absen` VALUES (204, 48, '18:00', '01:35', 0, 0, 0, 0, '2020-03-02', 'H', NULL, '', 0, 0.00, 0.00, 0.00, 'manual', 47);
INSERT INTO `tb_absen` VALUES (215, 13, '08:00', '16:05', 0, 25, 0, 1, '2020-03-20', 'H', NULL, '', 25, 0.25, 0.00, 0.25, 'manual', 47);
INSERT INTO `tb_absen` VALUES (216, 13, '', '16:00', 0, 30, 0, 1, '2020-03-19', 'H', NULL, '', 30, 0.25, 0.00, 0.25, 'manual', 47);
INSERT INTO `tb_absen` VALUES (217, 48, '', '', 0, 0, 0, 0, '2020-03-18', 'I', NULL, '', 0, 0.00, 0.00, 4.00, 'manual', 47);
INSERT INTO `tb_absen` VALUES (218, 48, '', '', 0, 0, 0, 0, '2020-03-17', 'A', NULL, '', 0, 0.00, 0.00, 4.00, 'manual', 47);
INSERT INTO `tb_absen` VALUES (221, 48, '', '01:33', 0, 0, 0, 0, '2020-03-16', 'H', NULL, '', 0, 0.00, 0.00, 0.00, 'manual', 47);
INSERT INTO `tb_absen` VALUES (222, 48, '18:00', '01:05', 0, 25, 0, 1, '2020-03-11', 'H', NULL, '', 25, 0.25, 0.00, 0.25, 'manual', 47);
INSERT INTO `tb_absen` VALUES (223, 48, '', '', 0, 0, 0, 0, '2020-03-19', 'D', NULL, '', 0, 0.00, 0.00, 0.00, 'manual', 47);

-- ----------------------------
-- Table structure for tb_id
-- ----------------------------
DROP TABLE IF EXISTS `tb_id`;
CREATE TABLE `tb_id`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nama` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `notifikasi` int(11) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `jenis_kelamin` int(11) NOT NULL,
  `no_induk` varchar(222) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `no_hp` varchar(22) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `alamat` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kota` varchar(222) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `provinsi` varchar(111) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kode_pos` varchar(11) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `goldar` varchar(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_agama` int(11) NOT NULL,
  `id_status_kawin` varchar(11) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_divisi` int(11) NULL DEFAULT NULL,
  `pendidikan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `gelar` varchar(22) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `no_sk` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nip` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_kategori_karyawan` int(11) NOT NULL,
  `npwp` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `norek` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status` varchar(11) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 109 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_id
-- ----------------------------
INSERT INTO `tb_id` VALUES (11, 'B9381D74', 'Drs. Yany Setyawan', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 11:11:40');
INSERT INTO `tb_id` VALUES (12, '6925F973', 'Khoirul Arif Iswanto', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 11:14:54');
INSERT INTO `tb_id` VALUES (13, '99D7F873', 'Asfiatul Hanifah', '', 0, 0, 2, '', '0000-00-00', '', '', '', '', '', '', 0, '', 23, '', '', '', '', 0, '', '', '1', 0, '2020-03-20 02:13:36');
INSERT INTO `tb_id` VALUES (14, '49AC1D74', 'Kardianto, SH', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 11:15:37');
INSERT INTO `tb_id` VALUES (15, '19281574', 'Moh. Slamet', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 11:16:20');
INSERT INTO `tb_id` VALUES (16, 'C98E2674', 'Mochamad Dambiril', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 11:17:43');
INSERT INTO `tb_id` VALUES (17, 'B9231574', 'Gatot Hindarko', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 11:18:29');
INSERT INTO `tb_id` VALUES (18, '09392774', 'Anas Ali Akbar, S.Stp', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 11:19:20');
INSERT INTO `tb_id` VALUES (19, '99BF1F74', 'M. Khoirul Rijal', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 11:20:05');
INSERT INTO `tb_id` VALUES (20, '4917F273', 'Ishari', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 11:20:44');
INSERT INTO `tb_id` VALUES (21, '2982FD73', 'Luki Rahmat Dianto', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 11:21:25');
INSERT INTO `tb_id` VALUES (22, '59961774', 'Sugeng Aris Wiyono', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 11:22:12');
INSERT INTO `tb_id` VALUES (23, 'A9DDEC73', 'M. Zaini', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 11:24:29');
INSERT INTO `tb_id` VALUES (24, '7909F473', 'Mulyadi', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 11:25:08');
INSERT INTO `tb_id` VALUES (25, '29152674', 'Akh. Eris Susanto', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 11:25:52');
INSERT INTO `tb_id` VALUES (26, '498D1F74', 'Mujiono (TIBUM)', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 11:26:39');
INSERT INTO `tb_id` VALUES (27, 'C961F473', 'Suud Guntoro', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 11:27:25');
INSERT INTO `tb_id` VALUES (28, 'C99A1474', 'Fandi Lugianto, SH', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 11:28:11');
INSERT INTO `tb_id` VALUES (29, '094B1D74', 'Puguh Kariyanto, SH', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 11:28:57');
INSERT INTO `tb_id` VALUES (30, 'C9C62174', 'R. Erik Hidayat', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 11:29:44');
INSERT INTO `tb_id` VALUES (31, 'F9C21474', 'Andina Chrisnawati, SH', '', 0, 0, 2, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 11:30:34');
INSERT INTO `tb_id` VALUES (32, '29D51674', 'Suliono', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 11:31:18');
INSERT INTO `tb_id` VALUES (33, '292B2274', 'Joko Sutopo', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 11:31:58');
INSERT INTO `tb_id` VALUES (34, '79C82274', 'Purwanto', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 11:33:38');
INSERT INTO `tb_id` VALUES (35, 'F9982274', 'M. Nur Aris', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 11:34:27');
INSERT INTO `tb_id` VALUES (36, 'D9901F74', 'Ismail', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 11:36:23');
INSERT INTO `tb_id` VALUES (37, '09262374', 'Moch. Maskur', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 11:37:08');
INSERT INTO `tb_id` VALUES (38, '99F02374', 'Riyadi', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 11:38:47');
INSERT INTO `tb_id` VALUES (39, '69312574', 'Slamet Abidin', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 11:39:32');
INSERT INTO `tb_id` VALUES (40, 'C9472574', 'Muhammad Kurnain', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 11:40:16');
INSERT INTO `tb_id` VALUES (41, '89621674', 'Sunadi', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 11:40:58');
INSERT INTO `tb_id` VALUES (42, '495A2374', 'Zaiful Rochman', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 11:41:42');
INSERT INTO `tb_id` VALUES (43, 'D91E1874', 'Bambang Supriyono', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 11:42:28');
INSERT INTO `tb_id` VALUES (44, '095B1D74', 'B. Sugeng Santosa', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 11:43:10');
INSERT INTO `tb_id` VALUES (45, 'B9591F74', 'Handoko', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 11:43:54');
INSERT INTO `tb_id` VALUES (46, '09812674', 'I Gede Widiasa', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 11:44:39');
INSERT INTO `tb_id` VALUES (47, '599A1F74', 'Suyatno', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 11:45:21');
INSERT INTO `tb_id` VALUES (48, '99082274', 'Khozinatul Asror', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 26, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 11:46:11');
INSERT INTO `tb_id` VALUES (49, '39622174', 'Bekti Sulistiyono', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 11:47:04');
INSERT INTO `tb_id` VALUES (50, '99042074', 'Sugianto', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 11:47:50');
INSERT INTO `tb_id` VALUES (51, '0930FE73', 'Drs. Udin Samsul Hari', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 11:48:40');
INSERT INTO `tb_id` VALUES (52, '798FF073', 'Karyono', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 11:49:26');
INSERT INTO `tb_id` VALUES (53, '0998F073', 'Agus Budi Santoso', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 11:50:14');
INSERT INTO `tb_id` VALUES (54, 'D930F573', 'Sugeng Yuliono', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 11:51:04');
INSERT INTO `tb_id` VALUES (55, 'D943F873', 'M. Sulton Hasan, SH', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 11:51:57');
INSERT INTO `tb_id` VALUES (56, 'D91FEF73', 'Eko Sulistiyanto', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 11:53:08');
INSERT INTO `tb_id` VALUES (57, '49FAFE73', 'Zainul Bahri', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 11:53:54');
INSERT INTO `tb_id` VALUES (58, '7962F773', 'Agus Setiyo Bakti', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 11:54:44');
INSERT INTO `tb_id` VALUES (59, '9978F773', 'Moh. Kurniawan Akbar', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 11:55:38');
INSERT INTO `tb_id` VALUES (60, '0928FB73', 'Johni Alexander, S.Sos', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 11:56:32');
INSERT INTO `tb_id` VALUES (61, '495CFB73', 'Joko Cucuk Handriyo', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 11:58:22');
INSERT INTO `tb_id` VALUES (62, 'C90AEC73', 'Arif Sudiono', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 11:59:01');
INSERT INTO `tb_id` VALUES (63, '0960EC73', 'Diat Rudianto, SH', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 11:59:29');
INSERT INTO `tb_id` VALUES (64, '29F6FC73', 'Abdul Manab', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 11:59:52');
INSERT INTO `tb_id` VALUES (65, '0912F273', 'Wurjanto, SH', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 12:00:15');
INSERT INTO `tb_id` VALUES (66, '4973F973', 'Wahyudi, S.Sos', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 12:05:17');
INSERT INTO `tb_id` VALUES (67, 'B922F673', 'Purwahyudi Zaini', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 12:05:47');
INSERT INTO `tb_id` VALUES (68, 'C9EEEC73', 'Sriwanti, SE, MM', '', 0, 0, 2, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 12:06:18');
INSERT INTO `tb_id` VALUES (69, '59A5F373', 'Yuwono Kurnia W, S.Kom', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 12:06:48');
INSERT INTO `tb_id` VALUES (70, 'A9A11F74', 'Yarman Andriono', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 12:07:15');
INSERT INTO `tb_id` VALUES (72, '396D2474', 'Drs. Mujib Jamil', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 12:08:06');
INSERT INTO `tb_id` VALUES (73, '296C1874', 'R. Dimas Widodo F', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 12:08:29');
INSERT INTO `tb_id` VALUES (74, 'C9551D74', 'Abdul Kodir', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 12:08:50');
INSERT INTO `tb_id` VALUES (75, 'E98F2074', 'Sulistianawati Y, S.Sos', '', 0, 0, 2, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 12:09:20');
INSERT INTO `tb_id` VALUES (76, 'F96D2574', 'Sutisno', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 12:09:44');
INSERT INTO `tb_id` VALUES (77, '99551974', 'Yudi Santoso', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 12:10:07');
INSERT INTO `tb_id` VALUES (78, 'C93DF573', 'Sugiono', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 12:10:30');
INSERT INTO `tb_id` VALUES (80, '2972FD73', 'Samian', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 12:11:30');
INSERT INTO `tb_id` VALUES (81, 'E92AFB73', 'M. Riduwan', '', 0, 0, 1, '', '0000-00-00', '', '', '', '', '', '', 0, '', 163, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 12:12:03');
INSERT INTO `tb_id` VALUES (82, '991F1574', '', '', 0, 0, 0, '', '0000-00-00', '', '', '', '', '', '', 0, '', NULL, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 12:17:13');
INSERT INTO `tb_id` VALUES (83, '49B31E74', '', '', 0, 0, 0, '', '0000-00-00', '', '', '', '', '', '', 0, '', NULL, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 12:17:13');
INSERT INTO `tb_id` VALUES (84, '59971574', '', '', 0, 0, 0, '', '0000-00-00', '', '', '', '', '', '', 0, '', NULL, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 12:17:13');
INSERT INTO `tb_id` VALUES (85, '19CC1974', '', '', 0, 0, 0, '', '0000-00-00', '', '', '', '', '', '', 0, '', NULL, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 12:17:13');
INSERT INTO `tb_id` VALUES (86, '29B31574', '', '', 0, 0, 0, '', '0000-00-00', '', '', '', '', '', '', 0, '', NULL, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 12:17:13');
INSERT INTO `tb_id` VALUES (87, '19641E74', '', '', 0, 0, 0, '', '0000-00-00', '', '', '', '', '', '', 0, '', NULL, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 12:17:13');
INSERT INTO `tb_id` VALUES (88, 'A9732474', '', '', 0, 0, 0, '', '0000-00-00', '', '', '', '', '', '', 0, '', NULL, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 12:17:13');
INSERT INTO `tb_id` VALUES (89, 'B9421674', '', '', 0, 0, 0, '', '0000-00-00', '', '', '', '', '', '', 0, '', NULL, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 12:17:13');
INSERT INTO `tb_id` VALUES (90, '79771674', '', '', 0, 0, 0, '', '0000-00-00', '', '', '', '', '', '', 0, '', NULL, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 12:17:13');
INSERT INTO `tb_id` VALUES (91, '89371B74', '', '', 0, 0, 0, '', '0000-00-00', '', '', '', '', '', '', 0, '', NULL, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 12:17:13');
INSERT INTO `tb_id` VALUES (92, 'C9292574', '', '', 0, 0, 0, '', '0000-00-00', '', '', '', '', '', '', 0, '', NULL, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 12:17:13');
INSERT INTO `tb_id` VALUES (93, 'F9082074', '', '', 0, 0, 0, '', '0000-00-00', '', '', '', '', '', '', 0, '', NULL, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 12:17:13');
INSERT INTO `tb_id` VALUES (94, '896D1674', '', '', 0, 0, 0, '', '0000-00-00', '', '', '', '', '', '', 0, '', NULL, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 12:17:13');
INSERT INTO `tb_id` VALUES (95, '79E1EC73', '', '', 0, 0, 0, '', '0000-00-00', '', '', '', '', '', '', 0, '', NULL, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 12:17:13');
INSERT INTO `tb_id` VALUES (96, '1974F273', '', '', 0, 0, 0, '', '0000-00-00', '', '', '', '', '', '', 0, '', NULL, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 12:17:13');
INSERT INTO `tb_id` VALUES (97, '79CCFF73', '', '', 0, 0, 0, '', '0000-00-00', '', '', '', '', '', '', 0, '', NULL, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 12:17:13');
INSERT INTO `tb_id` VALUES (98, 'B921F673', '', '', 0, 0, 0, '', '0000-00-00', '', '', '', '', '', '', 0, '', NULL, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 12:17:13');
INSERT INTO `tb_id` VALUES (99, 'E9171B74', '', '', 0, 0, 0, '', '0000-00-00', '', '', '', '', '', '', 0, '', NULL, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 12:17:13');
INSERT INTO `tb_id` VALUES (100, '897D1C74', '', '', 0, 0, 0, '', '0000-00-00', '', '', '', '', '', '', 0, '', NULL, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 12:17:13');
INSERT INTO `tb_id` VALUES (101, 'A9F61A74', '', '', 0, 0, 0, '', '0000-00-00', '', '', '', '', '', '', 0, '', NULL, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 12:17:13');
INSERT INTO `tb_id` VALUES (102, '59B01874', '', '', 0, 0, 0, '', '0000-00-00', '', '', '', '', '', '', 0, '', NULL, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 12:17:13');
INSERT INTO `tb_id` VALUES (103, '09BA1774', '', '', 0, 0, 0, '', '0000-00-00', '', '', '', '', '', '', 0, '', NULL, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 12:17:13');
INSERT INTO `tb_id` VALUES (104, 'D92AF773', '', '', 0, 0, 0, '', '0000-00-00', '', '', '', '', '', '', 0, '', NULL, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 12:17:13');
INSERT INTO `tb_id` VALUES (105, 'B9B7EE73', '', '', 0, 0, 0, '', '0000-00-00', '', '', '', '', '', '', 0, '', NULL, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 12:17:13');
INSERT INTO `tb_id` VALUES (106, 'F97AF873', '', '', 0, 0, 0, '', '0000-00-00', '', '', '', '', '', '', 0, '', NULL, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 12:17:13');
INSERT INTO `tb_id` VALUES (107, '79AE1774', '', '', 0, 0, 0, '', '0000-00-00', '', '', '', '', '', '', 0, '', NULL, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 12:17:13');
INSERT INTO `tb_id` VALUES (108, '39E7F673', '', '', 0, 0, 0, '', '0000-00-00', '', '', '', '', '', '', 0, '', NULL, '', '', '', '', 0, '', '', '1', 0, '2020-03-10 12:17:13');

-- ----------------------------
-- Table structure for tb_pengguna
-- ----------------------------
DROP TABLE IF EXISTS `tb_pengguna`;
CREATE TABLE `tb_pengguna`  (
  `no` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(22) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(22) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `level` int(1) NOT NULL,
  `id_karyawan` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`no`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 25 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_pengguna
-- ----------------------------
INSERT INTO `tb_pengguna` VALUES (2, 'dio', '123', 0, NULL);
INSERT INTO `tb_pengguna` VALUES (6, 'admin', 'admin', 0, NULL);
INSERT INTO `tb_pengguna` VALUES (21, 'alit', 'alit', 1, 7);
INSERT INTO `tb_pengguna` VALUES (22, 'asfiatul', 'asfiatul', 1, 6);
INSERT INTO `tb_pengguna` VALUES (23, 'wahyudi', 'wahyudi', 1, 5);
INSERT INTO `tb_pengguna` VALUES (24, 'yuwono', 'yuwono', 1, 3);

-- ----------------------------
-- Table structure for tb_rfid
-- ----------------------------
DROP TABLE IF EXISTS `tb_rfid`;
CREATE TABLE `tb_rfid`  (
  `id` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `date` date NOT NULL,
  `time` time(0) NOT NULL,
  `status` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_rfid
-- ----------------------------

-- ----------------------------
-- Table structure for tb_settings
-- ----------------------------
DROP TABLE IF EXISTS `tb_settings`;
CREATE TABLE `tb_settings`  (
  `masuk_mulai` time(0) NOT NULL,
  `masuk_akhir` time(0) NOT NULL,
  `keluar_mulai` time(0) NOT NULL,
  `keluar_akhir` time(0) NOT NULL,
  `libur1` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `libur2` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `timezone` varchar(22) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `pwdemail` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `admin_uid` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_settings
-- ----------------------------
INSERT INTO `tb_settings` VALUES ('00:00:00', '00:00:00', '16:00:00', '00:00:59', 'Sabtu', 'Minggu', 'Asia/Jakarta', 'emailpresensi@gmail.com', 'dtproduction', '59C28E50');

-- ----------------------------
-- View structure for vw_agama
-- ----------------------------
DROP VIEW IF EXISTS `vw_agama`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_agama` AS SELECT
	s2.id as id_agama,
	s2.param as kode_agama,
	s2.value as nama_agama,
	s2.isActive,
	s2.isFixed
FROM
	tb2_setting s2
WHERE
	s2.id_parent = (
		SELECT
			id
		FROM
			tb2_setting
		WHERE
			param = 'agama'
	) ; ;

-- ----------------------------
-- View structure for vw_divisi
-- ----------------------------
DROP VIEW IF EXISTS `vw_divisi`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_divisi` AS SELECT
	s2.id AS id_divisi,
	s2.param AS kode_divisi,
	s2.value 	AS nama_divisi,
	s2.isActive,
s2.isFixed
FROM
	tb2_setting s2
WHERE
	s2.id_parent = (
		SELECT
			id
		FROM
			tb2_setting
		WHERE
			param = 'divisi'
	) ; ;

-- ----------------------------
-- View structure for vw_hari_libur
-- ----------------------------
DROP VIEW IF EXISTS `vw_hari_libur`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_hari_libur` AS SELECT
	s2.id as id_hari_libur,
	s2.param as kode_hari_libur,
	s2.value as nama_hari_libur,
	s2.isActive 
,s2.isFixed FROM
	tb2_setting s2
WHERE
	s2.id_parent = (
		SELECT
			id
		FROM
			tb2_setting
		WHERE
			param = 'hari_libur'
	) ; ;

-- ----------------------------
-- View structure for vw_hari_libur_2
-- ----------------------------
DROP VIEW IF EXISTS `vw_hari_libur_2`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_hari_libur_2` AS SELECT
	s2.id as id_hari_libur,
	s2.param as id_divisi,
	s2.value as hari,
	s2.isActive 
,s2.isFixed FROM
	tb2_setting s2
WHERE
	s2.id_parent = (
		SELECT
			id
		FROM
			tb2_setting
		WHERE
			param = 'hari_libur_2'
	) ; ;

-- ----------------------------
-- View structure for vw_jabatan
-- ----------------------------
DROP VIEW IF EXISTS `vw_jabatan`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_jabatan` AS SELECT
	s2.id as id_jabatan,
	s2.param as kode_jabatan,
	s2.value as nama_jabatan,
	s2.isActive 
,s2.isFixed
FROM
	tb2_setting s2
WHERE
	s2.id_parent = (
		SELECT
			id
		FROM
			tb2_setting
		WHERE
			param = 'jabatan'
	) ; ;

-- ----------------------------
-- View structure for vw_katkaryawan
-- ----------------------------
DROP VIEW IF EXISTS `vw_katkaryawan`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_katkaryawan` AS SELECT
	s2.id as id_katkaryawan,
	s2.param as kode_katkaryawan,
	s2.value as nama_katkaryawan,
	s2.isActive
,s2.isFixed
 FROM
	tb2_setting s2
WHERE
	s2.id_parent = (
		SELECT
			id
		FROM
			tb2_setting
		WHERE
			param = 'kategori_karyawan'
	) ; ;

-- ----------------------------
-- View structure for vw_statuspernikahan
-- ----------------------------
DROP VIEW IF EXISTS `vw_statuspernikahan`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_statuspernikahan` AS SELECT
	s2.id as id_statuspernikahan,
	s2.param as kode_statuspernikahan,
	s2.value as nama_statuspernikahan,
	s2.isActive
,s2.isFixed
FROM
	tb2_setting s2
WHERE
	s2.id_parent = (
		SELECT
			id
		FROM
			tb2_setting
		WHERE
			param = 'status_pernikahan'
	) ; ;

-- ----------------------------
-- View structure for vw_tipepresensi
-- ----------------------------
DROP VIEW IF EXISTS `vw_tipepresensi`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_tipepresensi` AS SELECT
	s2.id as id_tipepresensi,
	s2.param as kode_tipepresensi,
	s2.value as nama_tipepresensi,
	s2.isActive
,s2.isFixed
FROM
	tb2_setting s2
WHERE
	s2.id_parent = (
		SELECT
			id
		FROM
			tb2_setting
		WHERE
			param = 'tipe_presensi'
	) ; ;

SET FOREIGN_KEY_CHECKS = 1;
