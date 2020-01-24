/*
Navicat MySQL Data Transfer

Source Server         : mysql
Source Server Version : 50505
Source Host           : 127.0.0.1:3306
Source Database       : db_uid

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2020-01-24 09:06:06
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tb1_admin
-- ----------------------------
DROP TABLE IF EXISTS `tb1_admin`;
CREATE TABLE `tb1_admin` (
  `kd_admin` int(6) NOT NULL AUTO_INCREMENT,
  `nama` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `gambar` varchar(225) DEFAULT NULL,
  `lvl_user` int(11) NOT NULL,
  PRIMARY KEY (`kd_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tb1_admin
-- ----------------------------
INSERT INTO `tb1_admin` VALUES ('6', 'Admin', 'admin', 'adminx', 'EOD BARU.png', '0');
INSERT INTO `tb1_admin` VALUES ('7', 'Rizal Bustani S.kom', 'operator', 'operator', 'il_340x270.1381893948_7ngw.png', '1');

-- ----------------------------
-- Table structure for tb1_agama
-- ----------------------------
DROP TABLE IF EXISTS `tb1_agama`;
CREATE TABLE `tb1_agama` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `kode_agama` varchar(55) NOT NULL,
  `nama_agama` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `kode_agama` (`kode_agama`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tb1_agama
-- ----------------------------
INSERT INTO `tb1_agama` VALUES ('4', '01', 'ISLAM', '2019-05-30 13:46:48', '6');

-- ----------------------------
-- Table structure for tb1_bulan
-- ----------------------------
DROP TABLE IF EXISTS `tb1_bulan`;
CREATE TABLE `tb1_bulan` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `bulan` varchar(22) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tb1_bulan
-- ----------------------------
INSERT INTO `tb1_bulan` VALUES ('1', 'Januari');
INSERT INTO `tb1_bulan` VALUES ('2', 'Februari');
INSERT INTO `tb1_bulan` VALUES ('3', 'Maret');
INSERT INTO `tb1_bulan` VALUES ('4', 'April');
INSERT INTO `tb1_bulan` VALUES ('5', 'Mei');
INSERT INTO `tb1_bulan` VALUES ('6', 'Juni');
INSERT INTO `tb1_bulan` VALUES ('7', 'Juli');
INSERT INTO `tb1_bulan` VALUES ('8', 'Agustus');
INSERT INTO `tb1_bulan` VALUES ('9', 'September');
INSERT INTO `tb1_bulan` VALUES ('10', 'Oktober');
INSERT INTO `tb1_bulan` VALUES ('11', 'Nopember');
INSERT INTO `tb1_bulan` VALUES ('12', 'Desember');

-- ----------------------------
-- Table structure for tb1_data
-- ----------------------------
DROP TABLE IF EXISTS `tb1_data`;
CREATE TABLE `tb1_data` (
  `no` int(255) NOT NULL AUTO_INCREMENT,
  `nama` text NOT NULL,
  `jabatan` text NOT NULL,
  `tanggal` text NOT NULL,
  `jam` text NOT NULL,
  `keterangan` text NOT NULL,
  `telat` text NOT NULL,
  `persen` text NOT NULL,
  `token` text NOT NULL,
  `tap` text NOT NULL,
  `tag` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `image` text DEFAULT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB AUTO_INCREMENT=128 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tb1_data
-- ----------------------------
INSERT INTO `tb1_data` VALUES ('41', 'Ajang Rahmat', '', '01-06-2019', '08:30:36', 'Masuk', '30', '0.25', 'Masuk01-06-2019', 'Manual', '123321', '2019-06-01 12:47:36', null);
INSERT INTO `tb1_data` VALUES ('43', 'Wahyudi', '', '01-06-2019', '13:15:50', 'Masuk', '315', '2.5', 'Masuk01-06-20196979114118', 'Otomatis', '6979114118', '2019-06-01 13:15:50', null);
INSERT INTO `tb1_data` VALUES ('44', 'Yuwono', '', '01-06-2019', '13:15:52', 'Masuk', '315', '2.5', 'Masuk01-06-2019134103224115', 'Otomatis', '134103224115', '2019-06-01 13:15:52', null);
INSERT INTO `tb1_data` VALUES ('45', 'Alit Catur', '', '01-06-2019', '15:56:35', 'Masuk', '0', '0', 'Masuk01-06-20198666223115', 'Otomatis', '8666223115', '2019-06-01 15:56:35', null);
INSERT INTO `tb1_data` VALUES ('46', 'Asfiatul Hanifah', '', '01-06-2019', '16:17:48', 'Keluar', '13', '0.25', 'Keluar01-06-20198919414280', 'Otomatis', '8919414280', '2019-06-01 16:17:48', null);
INSERT INTO `tb1_data` VALUES ('47', 'Wahyudi', '', '01-06-2019', '16:17:59', 'Keluar', '13', '0.25', 'Keluar01-06-20196979114118', 'Otomatis', '6979114118', '2019-06-01 16:17:59', null);
INSERT INTO `tb1_data` VALUES ('53', 'Alit Catur', '', '02-06-2019', '16:37:10', 'Masuk', '0', '0', 'Masuk02-06-20198666223115', 'Manual', '8666223115', '2019-06-02 16:37:10', null);
INSERT INTO `tb1_data` VALUES ('54', 'Asfiatul Hanifah', '', '03-06-2019', '09:29:15', 'Masuk', '89', '2.5', 'Masuk03-06-20198919414280', 'Otomatis', '8919414280', '2019-06-03 09:29:15', null);
INSERT INTO `tb1_data` VALUES ('55', 'Yuwono', '', '03-06-2019', '09:29:31', 'Masuk', '89', '2.5', 'Masuk03-06-2019134103224115', 'Otomatis', '134103224115', '2019-06-03 09:29:31', null);
INSERT INTO `tb1_data` VALUES ('56', 'Wahyudi', '', '03-06-2019', '09:29:33', 'Masuk', '89', '2.5', 'Masuk03-06-20196979114118', 'Otomatis', '6979114118', '2019-06-03 09:29:33', null);
INSERT INTO `tb1_data` VALUES ('57', 'Asfiatul Hanifah', '', '10-06-2019', '12:12:10', 'Masuk', '252', '2.5', 'Masuk10-06-20198919414280', 'Otomatis', '8919414280', '2019-06-10 12:12:10', null);
INSERT INTO `tb1_data` VALUES ('58', 'Wahyudi', '', '10-06-2019', '12:12:23', 'Masuk', '252', '2.5', 'Masuk10-06-20196979114118', 'Otomatis', '6979114118', '2019-06-10 12:12:23', null);
INSERT INTO `tb1_data` VALUES ('59', 'Yuwono', '', '10-06-2019', '12:12:25', 'Masuk', '252', '2.5', 'Masuk10-06-2019134103224115', 'Otomatis', '134103224115', '2019-06-10 12:12:25', null);
INSERT INTO `tb1_data` VALUES ('60', 'Asfiatul Hanifah', '', '10-06-2019', '16:42:08', 'Keluar', '0', '0', 'Keluar10-06-20198919414280', 'Otomatis', '8919414280', '2019-06-10 16:42:08', null);
INSERT INTO `tb1_data` VALUES ('61', 'Wahyudi', '', '10-06-2019', '16:42:15', 'Keluar', '0', '0', 'Keluar10-06-20196979114118', 'Otomatis', '6979114118', '2019-06-10 16:42:15', null);
INSERT INTO `tb1_data` VALUES ('62', 'Yuwono', '', '10-06-2019', '16:42:18', 'Keluar', '0', '0', 'Keluar10-06-2019134103224115', 'Otomatis', '134103224115', '2019-06-10 16:42:18', null);
INSERT INTO `tb1_data` VALUES ('63', 'Asfiatul Hanifah', '', '11-06-2019', '09:04:44', 'Masuk', '64', '2.5', 'Masuk11-06-20198919414280', 'Otomatis', '8919414280', '2019-06-11 09:04:44', null);
INSERT INTO `tb1_data` VALUES ('64', 'Yuwono', '', '11-06-2019', '09:04:53', 'Masuk', '64', '2.5', 'Masuk11-06-2019134103224115', 'Otomatis', '134103224115', '2019-06-11 09:04:53', null);
INSERT INTO `tb1_data` VALUES ('65', 'Wahyudi', '', '11-06-2019', '08:04:56', 'Masuk', '4', '0', 'Masuk11-06-20196979114118', 'Otomatis', '6979114118', '2019-06-11 09:04:56', null);
INSERT INTO `tb1_data` VALUES ('66', 'Asfiatul Hanifah', '', '11-06-2019', '16:28:27', 'Keluar', '2', '0', 'Keluar11-06-20198919414280', 'Otomatis', '8919414280', '2019-06-11 16:28:27', null);
INSERT INTO `tb1_data` VALUES ('67', 'Yuwono', '', '11-06-2019', '16:28:33', 'Keluar', '2', '0', 'Keluar11-06-2019134103224115', 'Otomatis', '134103224115', '2019-06-11 16:28:33', null);
INSERT INTO `tb1_data` VALUES ('68', 'Wahyudi', '', '11-06-2019', '16:28:35', 'Keluar', '2', '0', 'Keluar11-06-20196979114118', 'Otomatis', '6979114118', '2019-06-11 16:28:35', null);
INSERT INTO `tb1_data` VALUES ('69', 'Alit Catur', '', '11-06-2019', '16:28:42', 'Masuk', '0', '0', 'Masuk11-06-20198666223115', 'Otomatis', '8666223115', '2019-06-11 16:28:42', null);
INSERT INTO `tb1_data` VALUES ('70', 'Asfiatul Hanifah', '', '12-06-2019', '09:12:53', 'Masuk', '72', '2.5', 'Masuk12-06-20198919414280', 'Otomatis', '8919414280', '2019-06-12 09:12:53', null);
INSERT INTO `tb1_data` VALUES ('71', 'Yuwono', '', '12-06-2019', '09:13:00', 'Masuk', '73', '2.5', 'Masuk12-06-2019134103224115', 'Otomatis', '134103224115', '2019-06-12 09:13:00', null);
INSERT INTO `tb1_data` VALUES ('72', 'Wahyudi', '', '12-06-2019', '09:13:02', 'Masuk', '73', '2.5', 'Masuk12-06-20196979114118', 'Otomatis', '6979114118', '2019-06-12 09:13:02', null);
INSERT INTO `tb1_data` VALUES ('73', 'Asfiatul Hanifah', '', '14-06-2019', '12:27:21', 'Masuk', '267', '2.5', 'Masuk14-06-20198919414280', 'Otomatis', '8919414280', '2019-06-14 12:27:21', null);
INSERT INTO `tb1_data` VALUES ('74', 'Yuwono', '', '14-06-2019', '12:27:24', 'Masuk', '267', '2.5', 'Masuk14-06-2019134103224115', 'Otomatis', '134103224115', '2019-06-14 12:27:24', null);
INSERT INTO `tb1_data` VALUES ('75', 'Wahyudi', '', '14-06-2019', '12:27:26', 'Masuk', '267', '2.5', 'Masuk14-06-20196979114118', 'Otomatis', '6979114118', '2019-06-14 12:27:26', null);
INSERT INTO `tb1_data` VALUES ('76', 'Asfiatul Hanifah', '', '14-06-2019', '16:35:33', 'Keluar', '0', '0', 'Keluar14-06-20198919414280', 'Otomatis', '8919414280', '2019-06-14 16:35:33', null);
INSERT INTO `tb1_data` VALUES ('77', 'Yuwono', '', '14-06-2019', '16:35:40', 'Keluar', '0', '0', 'Keluar14-06-2019134103224115', 'Otomatis', '134103224115', '2019-06-14 16:35:40', null);
INSERT INTO `tb1_data` VALUES ('78', 'Wahyudi', '', '14-06-2019', '16:35:42', 'Keluar', '0', '0', 'Keluar14-06-20196979114118', 'Otomatis', '6979114118', '2019-06-14 16:35:42', null);
INSERT INTO `tb1_data` VALUES ('79', 'Alit Catur', '', '14-06-2019', '16:39:20', 'Masuk', '0', '0', 'Masuk14-06-20198666223115', 'Otomatis', '8666223115', '2019-06-14 16:39:20', null);
INSERT INTO `tb1_data` VALUES ('80', 'Alit Catur', '', '17-06-2019', '19:39:20', 'Masuk', '99', '2.5', 'Masuk17-06-20198666223115', 'Otomatis', '8666223115', '2019-06-17 19:39:20', null);
INSERT INTO `tb1_data` VALUES ('81', 'Yuwono', '', '17-06-2019', '19:39:25', 'Keluar', '0', '0', 'Keluar17-06-2019134103224115', 'Otomatis', '134103224115', '2019-06-17 19:39:25', null);
INSERT INTO `tb1_data` VALUES ('82', 'Wahyudi', '', '17-06-2019', '19:39:27', 'Keluar', '0', '0', 'Keluar17-06-20196979114118', 'Otomatis', '6979114118', '2019-06-17 19:39:27', null);
INSERT INTO `tb1_data` VALUES ('83', 'Alit Catur', '', '19-06-2019', '21:26:06', 'Masuk', '206', '2.5', 'Masuk19-06-20198666223115', 'Otomatis', '8666223115', '2019-06-19 21:26:06', null);
INSERT INTO `tb1_data` VALUES ('84', 'Asfiatul Hanifah', '', '20-06-2019', '16:30:18', 'Keluar', '0', '0', 'Keluar20-06-20198919414280', 'Otomatis', '8919414280', '2019-06-20 16:30:18', null);
INSERT INTO `tb1_data` VALUES ('85', 'Yuwono', '', '20-06-2019', '16:30:25', 'Keluar', '0', '0', 'Keluar20-06-2019134103224115', 'Otomatis', '134103224115', '2019-06-20 16:30:25', null);
INSERT INTO `tb1_data` VALUES ('86', 'Wahyudi', '', '20-06-2019', '16:30:27', 'Keluar', '0', '0', 'Keluar20-06-20196979114118', 'Otomatis', '6979114118', '2019-06-20 16:30:27', null);
INSERT INTO `tb1_data` VALUES ('87', 'Alit Catur', '', '20-06-2019', '16:38:32', 'Masuk', '0', '0', 'Masuk20-06-20198666223115', 'Otomatis', '8666223115', '2019-06-20 16:38:32', null);
INSERT INTO `tb1_data` VALUES ('88', 'Asfiatul Hanifah', '', '21-06-2019', '10:00:31', 'Masuk', '120', '2.5', 'Masuk21-06-20198919414280', 'Otomatis', '8919414280', '2019-06-21 10:00:31', null);
INSERT INTO `tb1_data` VALUES ('89', 'Yuwono', '', '21-06-2019', '10:00:35', 'Masuk', '120', '2.5', 'Masuk21-06-2019134103224115', 'Otomatis', '134103224115', '2019-06-21 10:00:35', null);
INSERT INTO `tb1_data` VALUES ('90', 'Wahyudi', '', '21-06-2019', '10:00:36', 'Masuk', '120', '2.5', 'Masuk21-06-20196979114118', 'Otomatis', '6979114118', '2019-06-21 10:00:36', null);
INSERT INTO `tb1_data` VALUES ('91', 'Asfiatul Hanifah', '', '21-06-2019', '17:00:29', 'Keluar', '0', '0', 'Keluar21-06-20198919414280', 'Otomatis', '8919414280', '2019-06-21 17:00:29', null);
INSERT INTO `tb1_data` VALUES ('92', 'Yuwono', '', '21-06-2019', '17:00:35', 'Keluar', '0', '0', 'Keluar21-06-2019134103224115', 'Otomatis', '134103224115', '2019-06-21 17:00:35', null);
INSERT INTO `tb1_data` VALUES ('93', 'Wahyudi', '', '21-06-2019', '17:00:38', 'Keluar', '0', '0', 'Keluar21-06-20196979114118', 'Otomatis', '6979114118', '2019-06-21 17:00:38', null);
INSERT INTO `tb1_data` VALUES ('94', 'Alit Catur', '', '21-06-2019', '17:32:41', 'Masuk', '0', '0', 'Masuk21-06-20198666223115', 'Otomatis', '8666223115', '2019-06-21 17:32:41', null);
INSERT INTO `tb1_data` VALUES ('95', 'Asfiatul Hanifah', '', '25-06-2019', '09:25:12', 'Masuk', '85', '2.5', 'Masuk25-06-20198919414280', 'Otomatis', '8919414280', '2019-06-25 09:25:12', null);
INSERT INTO `tb1_data` VALUES ('96', 'Yuwono', '', '25-06-2019', '09:25:17', 'Masuk', '85', '2.5', 'Masuk25-06-2019134103224115', 'Otomatis', '134103224115', '2019-06-25 09:25:17', null);
INSERT INTO `tb1_data` VALUES ('97', 'Wahyudi', '', '25-06-2019', '09:25:19', 'Masuk', '85', '2.5', 'Masuk25-06-20196979114118', 'Otomatis', '6979114118', '2019-06-25 09:25:19', null);
INSERT INTO `tb1_data` VALUES ('98', 'Wahyudi', '', '25-06-2019', '18:22:58', 'Keluar', '0', '0', 'Keluar25-06-20196979114118', 'Otomatis', '6979114118', '2019-06-25 18:22:58', null);
INSERT INTO `tb1_data` VALUES ('99', 'Yuwono', '', '25-06-2019', '18:23:00', 'Keluar', '0', '0', 'Keluar25-06-2019134103224115', 'Otomatis', '134103224115', '2019-06-25 18:23:00', null);
INSERT INTO `tb1_data` VALUES ('100', 'Alit Catur', '', '25-06-2019', '18:23:01', 'Masuk', '23', '0.25', 'Masuk25-06-20198666223115', 'Otomatis', '8666223115', '2019-06-25 18:23:01', null);
INSERT INTO `tb1_data` VALUES ('101', 'Asfiatul Hanifah', '', '25-06-2019', '18:23:05', 'Keluar', '0', '0', 'Keluar25-06-20198919414280', 'Otomatis', '8919414280', '2019-06-25 18:23:05', null);
INSERT INTO `tb1_data` VALUES ('102', 'Asfiatul Hanifah', '', '26-06-2019', '09:08:49', 'Masuk', '68', '2.5', 'Masuk26-06-20198919414280', 'Otomatis', '8919414280', '2019-06-26 09:08:49', null);
INSERT INTO `tb1_data` VALUES ('103', 'Yuwono', '', '26-06-2019', '09:08:54', 'Masuk', '68', '2.5', 'Masuk26-06-2019134103224115', 'Otomatis', '134103224115', '2019-06-26 09:08:54', null);
INSERT INTO `tb1_data` VALUES ('104', 'Wahyudi', '', '26-06-2019', '09:08:56', 'Masuk', '68', '2.5', 'Masuk26-06-20196979114118', 'Otomatis', '6979114118', '2019-06-26 09:08:56', null);
INSERT INTO `tb1_data` VALUES ('105', 'Asfiatul Hanifah', '', '26-06-2019', '16:30:13', 'Keluar', '0', '0', 'Keluar26-06-20198919414280', 'Otomatis', '8919414280', '2019-06-26 16:30:13', null);
INSERT INTO `tb1_data` VALUES ('106', 'Wahyudi', '', '26-06-2019', '16:30:29', 'Keluar', '0', '0', 'Keluar26-06-20196979114118', 'Otomatis', '6979114118', '2019-06-26 16:30:29', null);
INSERT INTO `tb1_data` VALUES ('107', 'Yuwono', '', '26-06-2019', '16:30:31', 'Keluar', '0', '0', 'Keluar26-06-2019134103224115', 'Otomatis', '134103224115', '2019-06-26 16:30:31', null);
INSERT INTO `tb1_data` VALUES ('108', 'Alit Catur', '', '26-06-2019', '17:33:35', 'Masuk', '0', '0', 'Masuk26-06-20198666223115', 'Otomatis', '8666223115', '2019-06-26 17:33:35', null);
INSERT INTO `tb1_data` VALUES ('109', 'Asfiatul Hanifah', '', '27-06-2019', '18:01:40', 'Keluar', '0', '0', 'Keluar27-06-20198919414280', 'Otomatis', '8919414280', '2019-06-27 18:01:41', null);
INSERT INTO `tb1_data` VALUES ('110', 'Wahyudi', '', '27-06-2019', '18:01:56', 'Keluar', '0', '0', 'Keluar27-06-20196979114118', 'Otomatis', '6979114118', '2019-06-27 18:01:56', null);
INSERT INTO `tb1_data` VALUES ('111', 'Yuwono', '', '27-06-2019', '18:01:58', 'Keluar', '0', '0', 'Keluar27-06-2019134103224115', 'Otomatis', '134103224115', '2019-06-27 18:01:58', null);
INSERT INTO `tb1_data` VALUES ('112', 'Alit Catur', '', '27-06-2019', '18:02:02', 'Masuk', '2', '0', 'Masuk27-06-20198666223115', 'Otomatis', '8666223115', '2019-06-27 18:02:02', null);
INSERT INTO `tb1_data` VALUES ('113', 'Asfiatul Hanifah', '', '28-06-2019', '11:24:49', 'Masuk', '204', '2.5', 'Masuk28-06-20198919414280', 'Otomatis', '8919414280', '2019-06-28 11:24:49', null);
INSERT INTO `tb1_data` VALUES ('114', 'Yuwono', '', '28-06-2019', '11:24:56', 'Masuk', '204', '2.5', 'Masuk28-06-2019134103224115', 'Otomatis', '134103224115', '2019-06-28 11:24:56', null);
INSERT INTO `tb1_data` VALUES ('115', 'Wahyudi', '', '28-06-2019', '11:24:57', 'Masuk', '204', '2.5', 'Masuk28-06-20196979114118', 'Otomatis', '6979114118', '2019-06-28 11:24:57', null);
INSERT INTO `tb1_data` VALUES ('116', 'Asfiatul Hanifah', '', '28-06-2019', '18:19:37', 'Keluar', '0', '0', 'Keluar28-06-20198919414280', 'Otomatis', '8919414280', '2019-06-28 18:19:37', null);
INSERT INTO `tb1_data` VALUES ('117', 'Alit Catur', '', '28-06-2019', '18:19:41', 'Masuk', '19', '0.25', 'Masuk28-06-20198666223115', 'Otomatis', '8666223115', '2019-06-28 18:19:41', null);
INSERT INTO `tb1_data` VALUES ('118', 'Yuwono', '', '28-06-2019', '18:19:43', 'Keluar', '0', '0', 'Keluar28-06-2019134103224115', 'Otomatis', '134103224115', '2019-06-28 18:19:43', null);
INSERT INTO `tb1_data` VALUES ('119', 'Wahyudi', '', '28-06-2019', '18:19:44', 'Keluar', '0', '0', 'Keluar28-06-20196979114118', 'Otomatis', '6979114118', '2019-06-28 18:19:44', null);
INSERT INTO `tb1_data` VALUES ('120', 'Asfiatul Hanifah', '', '03-07-2019', '18:01:19', 'Keluar', '0', '0', 'Keluar03-07-20198919414280', 'Otomatis', '8919414280', '2019-07-03 18:01:19', null);
INSERT INTO `tb1_data` VALUES ('121', 'Wahyudi', '', '03-07-2019', '18:01:25', 'Keluar', '0', '0', 'Keluar03-07-20196979114118', 'Otomatis', '6979114118', '2019-07-03 18:01:25', null);
INSERT INTO `tb1_data` VALUES ('122', 'Yuwono', '', '03-07-2019', '18:01:27', 'Keluar', '0', '0', 'Keluar03-07-2019134103224115', 'Otomatis', '134103224115', '2019-07-03 18:01:27', null);
INSERT INTO `tb1_data` VALUES ('123', 'Alit Catur', '', '03-07-2019', '18:01:28', 'Masuk', '1', '0', 'Masuk03-07-20198666223115', 'Otomatis', '8666223115', '2019-07-03 18:01:28', null);
INSERT INTO `tb1_data` VALUES ('124', 'Asfiatul Hanifah', '', '19-07-2019', '09:43:00', 'Masuk', '103', '2.5', 'Masuk19-07-20198919414280', 'Otomatis', '8919414280', '2019-07-19 09:43:00', null);
INSERT INTO `tb1_data` VALUES ('125', 'Wahyudi', '', '19-07-2019', '09:43:04', 'Masuk', '103', '2.5', 'Masuk19-07-20196979114118', 'Otomatis', '6979114118', '2019-07-19 09:43:04', null);
INSERT INTO `tb1_data` VALUES ('126', 'Yuwono', '', '19-07-2019', '09:43:05', 'Masuk', '103', '2.5', 'Masuk19-07-2019134103224115', 'Otomatis', '134103224115', '2019-07-19 09:43:05', null);
INSERT INTO `tb1_data` VALUES ('127', 'Alit Catur', '', '19-07-2019', '10:30:47', 'Masuk', '0', '0', 'Masuk19-07-20198666223115', 'Otomatis', '8666223115', '2019-07-19 10:30:47', '1563507047.jpg');

-- ----------------------------
-- Table structure for tb1_divisi
-- ----------------------------
DROP TABLE IF EXISTS `tb1_divisi`;
CREATE TABLE `tb1_divisi` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `kode_divisi` varchar(22) NOT NULL,
  `nama_divisi` varchar(66) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`ID`),
  UNIQUE KEY `kode_divisi` (`kode_divisi`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tb1_divisi
-- ----------------------------
INSERT INTO `tb1_divisi` VALUES ('2', '01', 'Keuangan', '2019-05-27 12:13:04');
INSERT INTO `tb1_divisi` VALUES ('4', '02', 'Humas', '2019-05-30 08:17:33');
INSERT INTO `tb1_divisi` VALUES ('5', '03', 'Kebersihan', '2019-05-30 16:12:23');
INSERT INTO `tb1_divisi` VALUES ('6', '04', 'Pasukan', '2019-05-31 11:33:40');

-- ----------------------------
-- Table structure for tb1_hari_kerja
-- ----------------------------
DROP TABLE IF EXISTS `tb1_hari_kerja`;
CREATE TABLE `tb1_hari_kerja` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `bulan` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `hari_kerja` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tb1_hari_kerja
-- ----------------------------
INSERT INTO `tb1_hari_kerja` VALUES ('2', '1', '2019', '29', '6');
INSERT INTO `tb1_hari_kerja` VALUES ('3', '3', '2019', '22', '6');
INSERT INTO `tb1_hari_kerja` VALUES ('4', '6', '2019', '24', '6');

-- ----------------------------
-- Table structure for tb1_hari_libur
-- ----------------------------
DROP TABLE IF EXISTS `tb1_hari_libur`;
CREATE TABLE `tb1_hari_libur` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tb1_hari_libur
-- ----------------------------
INSERT INTO `tb1_hari_libur` VALUES ('1', '2019-05-10', 'Libur lebaran bos', '2019-05-30 07:48:25', '6');

-- ----------------------------
-- Table structure for tb1_jabatan
-- ----------------------------
DROP TABLE IF EXISTS `tb1_jabatan`;
CREATE TABLE `tb1_jabatan` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `kode_jabatan` varchar(5) NOT NULL,
  `nama_jabatan` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `kode_jabatan` (`kode_jabatan`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tb1_jabatan
-- ----------------------------
INSERT INTO `tb1_jabatan` VALUES ('17', '01', 'Eselon III', '2019-05-30 07:28:20', '0');
INSERT INTO `tb1_jabatan` VALUES ('18', '02', 'Eselon VI', '2019-05-30 07:28:30', '0');
INSERT INTO `tb1_jabatan` VALUES ('19', '03', 'Eselon V', '2019-05-30 07:34:01', '6');

-- ----------------------------
-- Table structure for tb1_karyawan
-- ----------------------------
DROP TABLE IF EXISTS `tb1_karyawan`;
CREATE TABLE `tb1_karyawan` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `tag` text NOT NULL,
  `nama` text NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `jenis_kelamin` int(11) NOT NULL,
  `no_induk` varchar(222) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `no_hp` varchar(22) NOT NULL,
  `alamat` text NOT NULL,
  `kota` varchar(222) NOT NULL,
  `provinsi` varchar(111) NOT NULL,
  `kode_pos` varchar(11) NOT NULL,
  `email` text NOT NULL,
  `goldar` varchar(2) NOT NULL,
  `id_agama` int(11) NOT NULL,
  `id_status_kawin` varchar(11) NOT NULL,
  `id_divisi` int(11) NOT NULL,
  `pendidikan` text NOT NULL,
  `gelar` varchar(22) NOT NULL,
  `no_sk` text NOT NULL,
  `nip` text NOT NULL,
  `id_kategori_karyawan` int(11) NOT NULL,
  `npwp` text NOT NULL,
  `norek` text NOT NULL,
  `status` varchar(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tb1_karyawan
-- ----------------------------
INSERT INTO `tb1_karyawan` VALUES ('4', '123321', 'Ajang Rahmat', '0', '1', '', '2019-05-10', '', '', '', '', '', '', 'B', '0', '', '26', '', '', '', '666666', '0', '', '', '', '2019-05-28 21:09:14', '0');
INSERT INTO `tb1_karyawan` VALUES ('5', '124421', 'Ade Rahayu', '0', '2', '', '2019-05-10', '083483923829', 'Surabaya', '', '', '', '', '', '0', '', '23', '', '', '', '88888', '0', '', '', '', '2019-05-28 21:09:14', '0');
INSERT INTO `tb1_karyawan` VALUES ('6', '1872141250', 'Asep Wanda Komara', '0', '1', '', '0000-00-00', '', '', '', '', '', '', '', '0', '', '24', '', '', '', '999999', '0', '', '', '1', '2019-05-28 21:09:14', '0');
INSERT INTO `tb1_karyawan` VALUES ('7', '345375112', 'Farhad Rifaldi', '0', '1', '', '0000-00-00', '', '', '', '', '', '', '', '0', '', '24', '', '', '', '11111', '0', '', '', '1', '2019-05-28 21:09:14', '0');
INSERT INTO `tb1_karyawan` VALUES ('13', '82419897', 'Ruslan Wahyudi', '0', '1', '', '2019-05-04', '08673617317', 'Pamekasan', 'Pamekasan', 'Jatim', '69032', 'ruslanwahyudi1@gmail.commmmmmmmmm', 'B', '8', '', '23', 'S1', 'S.kom', '128941429148', '8983913839', '0', '124421125125', '1248921491', '', '0000-00-00 00:00:00', '0');
INSERT INTO `tb1_karyawan` VALUES ('14', '8919414280', 'Asfiatul Hanifah', '0', '2', '', '0000-00-00', '', '', '', '', '', '', '', '0', '', '23', '', '', '', '7777777', '0', '', '', '', '0000-00-00 00:00:00', '0');
INSERT INTO `tb1_karyawan` VALUES ('15', '134103224115', 'Yuwono', '0', '1', '', '0000-00-00', '', '', '', '', '', '', '', '0', '', '26', '', '', '', '5555555', '0', '', '', '', '0000-00-00 00:00:00', '0');
INSERT INTO `tb1_karyawan` VALUES ('16', '6979114118', 'Wahyudi', '0', '1', '', '0000-00-00', '', '', '', '', '', '', '', '0', '', '23', '', '', '', '4444444', '0', '', '', '', '0000-00-00 00:00:00', '0');
INSERT INTO `tb1_karyawan` VALUES ('17', '8666223115', 'Japri sunandar', '0', '1', '', '0000-00-00', '', '', '', '', '', '', '', '0', '', '25', '', '', '', '33333333', '0', '', '', '', '0000-00-00 00:00:00', '0');
INSERT INTO `tb1_karyawan` VALUES ('20', '212448', 'bejo sugiantro x', '20', '1', '', '2500-01-15', '08569999977', 'jl hiu ganas 9977', 'london77', 'hawai timur7', '9876', 'anu@anu.com7', '', '12', '15', '23', '', '', '', '123457', '41', '6543277', '', '1', '2020-01-11 04:20:27', '0');
INSERT INTO `tb1_karyawan` VALUES ('21', '8666223115', 'bagus hadi', '0', '1', '', '0000-00-00', '', '', '', '', '', '', '', '0', '', '23', '', '', '', '222222', '0', '', '', '', '0000-00-00 00:00:00', '0');
INSERT INTO `tb1_karyawan` VALUES ('23', '8666223115', 'gede catur', '0', '1', '', '0000-00-00', '', '', '', '', '', '', '', '9', '16', '24', '', '', '', '112233445566', '40', '', '', '', '0000-00-00 00:00:00', '0');
INSERT INTO `tb1_karyawan` VALUES ('24', '8666223115', 'gede catur', '0', '1', '', '0000-00-00', '', '', '', '', '', '', '', '9', '16', '24', '', '', '', '112233445566', '40', '', '', '', '0000-00-00 00:00:00', '0');
INSERT INTO `tb1_karyawan` VALUES ('25', '8666223115', 'gede catur', '0', '1', '', '0000-00-00', '', '', '', '', '', '', '', '9', '16', '24', '', '', '', '112233445566', '40', '', '', '', '0000-00-00 00:00:00', '0');
INSERT INTO `tb1_karyawan` VALUES ('26', '8666223115', 'gede catur', '0', '1', '', '0000-00-00', '', '', '', '', '', '', '', '9', '16', '24', '', '', '', '112233445566', '40', '', '', '', '0000-00-00 00:00:00', '0');
INSERT INTO `tb1_karyawan` VALUES ('27', '8666223115', 'gede catur', '0', '1', '', '0000-00-00', '', '', '', '', '', '', '', '9', '16', '24', '', '', '', '112233445566', '40', '', '', '', '0000-00-00 00:00:00', '0');
INSERT INTO `tb1_karyawan` VALUES ('28', '8666223115', 'gede catur', '0', '1', '', '0000-00-00', '', '', '', '', '', '', '', '9', '16', '24', '', '', '', '112233445566', '40', '', '', '', '0000-00-00 00:00:00', '0');
INSERT INTO `tb1_karyawan` VALUES ('29', '8666223115', 'gede catur', '0', '1', '', '0000-00-00', '', '', '', '', '', '', '', '9', '16', '24', '', '', '', '112233445566', '40', '', '', '', '0000-00-00 00:00:00', '0');
INSERT INTO `tb1_karyawan` VALUES ('30', '8666223115', 'gede catur', '0', '1', '', '0000-00-00', '', '', '', '', '', '', '', '9', '16', '24', '', '', '', '112233445566', '40', '', '', '', '0000-00-00 00:00:00', '0');
INSERT INTO `tb1_karyawan` VALUES ('31', '8666223115', 'gede catur', '0', '1', '', '0000-00-00', '', '', '', '', '', '', '', '9', '16', '24', '', '', '', '112233445566', '40', '', '', '', '0000-00-00 00:00:00', '0');
INSERT INTO `tb1_karyawan` VALUES ('32', '8666223115', 'gede catur', '0', '1', '', '0000-00-00', '', '', '', '', '', '', '', '9', '16', '24', '', '', '', '112233445566', '40', '', '', '', '0000-00-00 00:00:00', '0');
INSERT INTO `tb1_karyawan` VALUES ('33', '8666223115', 'gede catur', '0', '1', '', '0000-00-00', '', '', '', '', '', '', '', '9', '16', '24', '', '', '', '112233445566', '40', '', '', '', '0000-00-00 00:00:00', '0');
INSERT INTO `tb1_karyawan` VALUES ('34', '8666223115', 'gede catur', '0', '1', '', '0000-00-00', '', '', '', '', '', '', '', '9', '16', '24', '', '', '', '112233445566', '40', '', '', '', '0000-00-00 00:00:00', '0');
INSERT INTO `tb1_karyawan` VALUES ('35', '8666223115', 'gede catur', '0', '1', '', '0000-00-00', '', '', '', '', '', '', '', '9', '16', '24', '', '', '', '112233445566', '40', '', '', '', '0000-00-00 00:00:00', '0');
INSERT INTO `tb1_karyawan` VALUES ('36', '8666223115', 'gede catur', '0', '1', '', '0000-00-00', '', '', '', '', '', '', '', '9', '16', '24', '', '', '', '112233445566', '40', '', '', '', '0000-00-00 00:00:00', '0');

-- ----------------------------
-- Table structure for tb1_kategori_karyawan
-- ----------------------------
DROP TABLE IF EXISTS `tb1_kategori_karyawan`;
CREATE TABLE `tb1_kategori_karyawan` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `kode_katkaryawan` varchar(22) NOT NULL,
  `nama_katkaryawan` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `kode_katkaryawan` (`kode_katkaryawan`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tb1_kategori_karyawan
-- ----------------------------
INSERT INTO `tb1_kategori_karyawan` VALUES ('1', '01', 'karyawan tetap', '2019-05-30 14:43:06', '6');
INSERT INTO `tb1_kategori_karyawan` VALUES ('2', '02', 'Karyawan Tidak Tetap', '2019-05-31 04:54:48', '6');

-- ----------------------------
-- Table structure for tb1_kelamin
-- ----------------------------
DROP TABLE IF EXISTS `tb1_kelamin`;
CREATE TABLE `tb1_kelamin` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kelamin` varchar(22) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tb1_kelamin
-- ----------------------------
INSERT INTO `tb1_kelamin` VALUES ('1', 'Laki-Laki');
INSERT INTO `tb1_kelamin` VALUES ('2', 'Perempuan');

-- ----------------------------
-- Table structure for tb1_pangkat
-- ----------------------------
DROP TABLE IF EXISTS `tb1_pangkat`;
CREATE TABLE `tb1_pangkat` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `kode_pangkat` varchar(22) NOT NULL,
  `nama_pangkat` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `kode_pangkat` (`kode_pangkat`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tb1_pangkat
-- ----------------------------
INSERT INTO `tb1_pangkat` VALUES ('1', 'komandan', 'komandan', '2019-05-30 14:02:46', '6');

-- ----------------------------
-- Table structure for tb1_setting
-- ----------------------------
DROP TABLE IF EXISTS `tb1_setting`;
CREATE TABLE `tb1_setting` (
  `no` int(255) NOT NULL AUTO_INCREMENT,
  `jam` text NOT NULL,
  `menit` text NOT NULL,
  `telat1a` text NOT NULL,
  `telat1b` text NOT NULL,
  `telat2a` text NOT NULL,
  `telat2b` text NOT NULL,
  `telat3a` text NOT NULL,
  `telat3b` text NOT NULL,
  `persen1` text NOT NULL,
  `persen2` text NOT NULL,
  `persen3` text NOT NULL,
  `persen4` text NOT NULL,
  `batas1` text NOT NULL,
  `batas2` text NOT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tb1_setting
-- ----------------------------
INSERT INTO `tb1_setting` VALUES ('1', '08', '0', '5', '30', '31', '60', '61', '120', '0.25', '1', '2', '2.5', '08', '10');
INSERT INTO `tb1_setting` VALUES ('2', '16', '30', '5', '30', '31', '60', '61', '120', '0.25', '1', '2', '2.5', '15', '20');

-- ----------------------------
-- Table structure for tb1_setting2
-- ----------------------------
DROP TABLE IF EXISTS `tb1_setting2`;
CREATE TABLE `tb1_setting2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no` int(255) NOT NULL,
  `jam` text NOT NULL,
  `menit` text NOT NULL,
  `telat1a` text NOT NULL,
  `telat1b` text NOT NULL,
  `telat2a` text NOT NULL,
  `telat2b` text NOT NULL,
  `telat3a` text NOT NULL,
  `telat3b` text NOT NULL,
  `persen1` text NOT NULL,
  `persen2` text NOT NULL,
  `persen3` text NOT NULL,
  `persen4` text NOT NULL,
  `batas1` text NOT NULL,
  `batas2` text NOT NULL,
  `tag` text NOT NULL,
  `id_divisi` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `isActive` int(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tb1_setting2
-- ----------------------------
INSERT INTO `tb1_setting2` VALUES ('1', '1', '08', '00', '5', '30', '31', '60', '61', '120', '0.25', '1', '2.5', '2.5', '06', '15', '01', '23', '0000-00-00 00:00:00', '1');
INSERT INTO `tb1_setting2` VALUES ('2', '2', '16', '30', '5', '30', '31', '60', '61', '120', '0.25', '1', '2.5', '2.5', '16', '18', '01', '23', '0000-00-00 00:00:00', '1');
INSERT INTO `tb1_setting2` VALUES ('3', '1', '08', '00', '5', '30', '31', '60', '61', '120', '0.25', '1', '2.5', '2.5', '06', '16', '03', '25', '0000-00-00 00:00:00', '1');
INSERT INTO `tb1_setting2` VALUES ('15', '2', '17', '00', '5', '30', '31', '60', '61', '120', '0.25', '1', '2', '0', '15', '19', '03', '25', '0000-00-00 00:00:00', '1');
INSERT INTO `tb1_setting2` VALUES ('16', '1', '08', '00', '5', '30', '31', '60', '61', '120', '0.25', '1', '2.5', '2.5', '08', '15', '02', '24', '0000-00-00 00:00:00', '1');
INSERT INTO `tb1_setting2` VALUES ('17', '1', '18', '00', '5', '30', '31', '60', '61', '120', '0.25', '1', '2.5', '2.5', '08', '21', '04', '26', '0000-00-00 00:00:00', '1');
INSERT INTO `tb1_setting2` VALUES ('18', '2', '16', '30', '5', '30', '31', '60', '61', '120', '0.25', '1', '2.5', '0', '15', '19', '02', '24', '0000-00-00 00:00:00', '1');
INSERT INTO `tb1_setting2` VALUES ('19', '2', '01', '30', '5', '30', '31', '60', '61', '120', '0.25', '1', '2.5', '0', '23', '03', '04', '26', '0000-00-00 00:00:00', '1');
INSERT INTO `tb1_setting2` VALUES ('31', '1', '22', '22', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '', '24', '2020-01-22 07:34:32', '1');

-- ----------------------------
-- Table structure for tb1_status_pernikahan
-- ----------------------------
DROP TABLE IF EXISTS `tb1_status_pernikahan`;
CREATE TABLE `tb1_status_pernikahan` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `kode_nikah` varchar(22) NOT NULL,
  `keterangan` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `kode_nikah` (`kode_nikah`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tb1_status_pernikahan
-- ----------------------------
INSERT INTO `tb1_status_pernikahan` VALUES ('2', '01', 'Lajang', '2019-05-30 13:55:48', '6');
INSERT INTO `tb1_status_pernikahan` VALUES ('3', '02', 'Kawin', '2019-05-31 05:48:50', '6');
INSERT INTO `tb1_status_pernikahan` VALUES ('4', '03', 'Janda/Duda', '2019-05-31 05:48:58', '6');

-- ----------------------------
-- Table structure for tb1_tag
-- ----------------------------
DROP TABLE IF EXISTS `tb1_tag`;
CREATE TABLE `tb1_tag` (
  `no` int(255) NOT NULL AUTO_INCREMENT,
  `tag` text NOT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tb1_tag
-- ----------------------------
INSERT INTO `tb1_tag` VALUES ('1', '23047223115');
INSERT INTO `tb1_tag` VALUES ('2', '19838233115');

-- ----------------------------
-- Table structure for tb2_setting
-- ----------------------------
DROP TABLE IF EXISTS `tb2_setting`;
CREATE TABLE `tb2_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `param` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `note` text DEFAULT NULL,
  `id_parent` int(11) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `isActive` int(11) DEFAULT 1,
  `isFixed` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tb2_setting
-- ----------------------------
INSERT INTO `tb2_setting` VALUES ('1', 'agama', 'Agama', 'Opsi agama', null, null, '1', '0');
INSERT INTO `tb2_setting` VALUES ('8', '01', 'Islam', null, '1', null, '1', '0');
INSERT INTO `tb2_setting` VALUES ('9', '02', 'Protestan', null, '1', null, '1', '0');
INSERT INTO `tb2_setting` VALUES ('10', '03', 'Katholik', null, '1', null, '1', '0');
INSERT INTO `tb2_setting` VALUES ('11', '04', 'Hindu', null, '1', null, '1', '0');
INSERT INTO `tb2_setting` VALUES ('12', '05', 'Budha', null, '1', null, '1', '0');
INSERT INTO `tb2_setting` VALUES ('13', '06', 'Konghuchu', null, '1', null, '1', '0');
INSERT INTO `tb2_setting` VALUES ('14', 'status_pernikahan', 'Status Nikah', 'Parameter status nikah karyawan', null, null, '1', '0');
INSERT INTO `tb2_setting` VALUES ('15', '01', 'Lajang', null, '14', null, '1', '0');
INSERT INTO `tb2_setting` VALUES ('16', '02', 'Kawin', null, '14', null, '1', '0');
INSERT INTO `tb2_setting` VALUES ('17', '03', 'Janda/Duda', null, '14', null, '1', '0');
INSERT INTO `tb2_setting` VALUES ('18', 'jabatan', 'Jabatan', 'Parameter jabatan karyawan', null, null, '1', '0');
INSERT INTO `tb2_setting` VALUES ('19', '01', 'Eselon III', null, '18', null, '1', '0');
INSERT INTO `tb2_setting` VALUES ('20', '02', 'Eselon IV', null, '18', null, '1', '0');
INSERT INTO `tb2_setting` VALUES ('21', '03', 'Eselon V', null, '18', null, '1', '0');
INSERT INTO `tb2_setting` VALUES ('22', 'divisi', 'Divisi', 'Parameter divisi dari karyawan', null, null, '1', '0');
INSERT INTO `tb2_setting` VALUES ('23', '01', 'Keuangan', null, '22', null, '1', '0');
INSERT INTO `tb2_setting` VALUES ('24', '02', 'Humas', null, '22', null, '1', '0');
INSERT INTO `tb2_setting` VALUES ('25', '03', 'Kebersihan', null, '22', null, '1', '0');
INSERT INTO `tb2_setting` VALUES ('26', '04', 'Pasukan', null, '22', null, '1', '0');
INSERT INTO `tb2_setting` VALUES ('27', 'hari_libur', 'Hari Libur', 'List Hari libur (tanggal merah/hari besar)', null, null, '1', '0');
INSERT INTO `tb2_setting` VALUES ('28', '2019-01-22', 'Ultah Bos', null, '27', null, '1', '0');
INSERT INTO `tb2_setting` VALUES ('39', 'kategori_karyawan', 'Kategori Karyawan', 'Parameter kategori karyawan tetap/tidak tetap', null, null, '1', '0');
INSERT INTO `tb2_setting` VALUES ('40', '01', 'karyawan tetap', null, '39', null, '1', '0');
INSERT INTO `tb2_setting` VALUES ('41', '02', 'karyawan tidak tetap', null, '39', null, '1', '0');
INSERT INTO `tb2_setting` VALUES ('46', 'tipe_presensi', 'Tipe Presensi', 'Parameter untuk karyawan melakukan presensi harian atau lainnya', null, null, '1', '1');
INSERT INTO `tb2_setting` VALUES ('47', 'harian', 'Presensi Harian', null, '46', null, '1', '0');
INSERT INTO `tb2_setting` VALUES ('48', 'diklat', 'DIKLAT', null, '46', null, '1', '0');
INSERT INTO `tb2_setting` VALUES ('49', 'skj', 'SKJ', null, '46', null, '1', '0');
INSERT INTO `tb2_setting` VALUES ('50', 'dispensasi', 'Dispensasi', null, '46', null, '1', '0');
INSERT INTO `tb2_setting` VALUES ('71', '2020-01-25', 'imlek', null, '27', null, '1', '0');
INSERT INTO `tb2_setting` VALUES ('72', '2020-03-22', 'isra mi\'raj', null, '27', null, '1', '0');
INSERT INTO `tb2_setting` VALUES ('73', '2020-03-25', 'Nyepi', null, '27', null, '1', '0');
INSERT INTO `tb2_setting` VALUES ('74', '2020-05-01', 'Hari Buruh', null, '27', null, '1', '0');
INSERT INTO `tb2_setting` VALUES ('75', 'hari_libur_2', 'Libur Weekend', 'Parameter hari libur akhir pekan karyawan berdasarkan divisinya', null, null, '1', '0');
INSERT INTO `tb2_setting` VALUES ('76', '23', 'sabtu', null, '75', null, '1', '0');
INSERT INTO `tb2_setting` VALUES ('77', '23', 'minggu', null, '75', null, '1', '0');
INSERT INTO `tb2_setting` VALUES ('78', '25', 'sabtu', null, '75', null, '1', '0');
INSERT INTO `tb2_setting` VALUES ('79', '26', 'kamis', null, '75', null, '1', '0');
INSERT INTO `tb2_setting` VALUES ('80', '26', 'sabtu', null, '75', null, '1', '0');
INSERT INTO `tb2_setting` VALUES ('81', '26', 'minggu', null, '75', null, '1', '0');
INSERT INTO `tb2_setting` VALUES ('82', '26', 'senin', null, '75', null, '1', '0');

-- ----------------------------
-- Table structure for tb_absen
-- ----------------------------
DROP TABLE IF EXISTS `tb_absen`;
CREATE TABLE `tb_absen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_karyawan` int(11) NOT NULL,
  `masuk` varchar(5) NOT NULL,
  `keluar` varchar(5) NOT NULL,
  `masuk_minus` int(11) NOT NULL,
  `keluar_minus` int(11) NOT NULL,
  `kat_terlambat_masuk` int(11) NOT NULL,
  `kat_terlambat_keluar` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(10) NOT NULL,
  `capture` text DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `terlambat` int(11) NOT NULL,
  `potongan_keluar` float(11,2) NOT NULL,
  `potongan_masuk` float(11,2) NOT NULL,
  `potongan` float(11,2) NOT NULL,
  `mode` enum('auto','manual') DEFAULT 'auto',
  `id_tipe_presensi` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tb_absen
-- ----------------------------
INSERT INTO `tb_absen` VALUES ('71', '20', '08:35', '15:00', '35', '90', '2', '3', '2020-01-16', 'H', null, '', '125', '2.50', '1.00', '3.50', 'manual', '47');
INSERT INTO `tb_absen` VALUES ('72', '20', '08:35', '18:00', '35', '0', '2', '0', '2020-01-17', 'H', null, '', '35', '0.00', '1.00', '1.00', 'manual', '47');
INSERT INTO `tb_absen` VALUES ('73', '20', '07:07', '18:00', '0', '0', '0', '0', '2020-01-15', 'H', null, '', '0', '0.00', '0.00', '0.00', 'manual', '47');
INSERT INTO `tb_absen` VALUES ('74', '20', '08:06', '16:07', '6', '23', '1', '1', '2020-01-13', 'H', null, '', '29', '0.25', '0.25', '0.50', 'manual', '47');
INSERT INTO `tb_absen` VALUES ('75', '20', '10:00', '15:30', '120', '60', '3', '2', '2020-01-10', 'H', null, '', '180', '1.00', '2.50', '3.50', 'manual', '47');
INSERT INTO `tb_absen` VALUES ('76', '20', '11:11', '14:00', '191', '150', '4', '4', '2020-01-09', 'H', null, '', '341', '2.50', '2.50', '5.00', 'manual', '47');
INSERT INTO `tb_absen` VALUES ('77', '20', '11:11', '16:10', '191', '20', '4', '1', '2020-01-08', 'H', null, '', '211', '0.25', '2.50', '2.75', 'manual', '47');
INSERT INTO `tb_absen` VALUES ('78', '20', '10:58', '16:30', '178', '0', '4', '0', '2020-01-07', 'H', null, '', '178', '0.00', '2.50', '2.50', 'manual', '47');
INSERT INTO `tb_absen` VALUES ('79', '5', '10:58', '16:30', '178', '0', '4', '0', '2020-01-07', 'H', null, '', '178', '0.00', '2.50', '2.50', 'manual', '47');
INSERT INTO `tb_absen` VALUES ('80', '5', '08:20', '16:30', '20', '0', '1', '0', '2020-01-16', 'H', null, '', '20', '0.00', '0.25', '0.25', 'manual', '47');
INSERT INTO `tb_absen` VALUES ('81', '5', '08:20', '15:55', '20', '35', '1', '2', '2020-01-14', 'H', null, '', '55', '1.00', '0.25', '1.25', 'manual', '47');
INSERT INTO `tb_absen` VALUES ('82', '5', '08:20', '15:55', '0', '0', '0', '0', '2020-01-15', 'A', null, '', '0', '0.00', '0.00', '2.00', 'manual', '47');
INSERT INTO `tb_absen` VALUES ('83', '17', '08:25', '16:55', '25', '5', '1', '1', '2020-01-16', 'H', null, '', '30', '0.25', '0.25', '0.50', 'manual', '47');
INSERT INTO `tb_absen` VALUES ('84', '20', '', '', '0', '0', '0', '0', '2020-01-03', 'A', null, '', '0', '0.00', '0.00', '2.00', 'manual', '47');
INSERT INTO `tb_absen` VALUES ('85', '20', '', '', '0', '0', '0', '0', '2020-01-16', 'I', null, '', '0', '0.00', '0.00', '2.00', 'manual', '48');
INSERT INTO `tb_absen` VALUES ('86', '20', '', '', '0', '0', '0', '0', '2020-01-24', 'A', null, '', '0', '0.00', '0.00', '2.00', 'manual', '47');
INSERT INTO `tb_absen` VALUES ('87', '20', '', '', '0', '0', '0', '0', '2020-01-24', 'H', null, '', '0', '0.00', '0.00', '2.00', 'manual', '48');
INSERT INTO `tb_absen` VALUES ('88', '20', '', '', '0', '0', '0', '0', '2020-01-10', 'A', null, '', '0', '0.00', '0.00', '2.00', 'manual', '48');
INSERT INTO `tb_absen` VALUES ('89', '20', '', '', '0', '0', '0', '0', '2020-01-17', 'D', null, '', '0', '0.00', '0.00', '2.00', 'manual', '49');
INSERT INTO `tb_absen` VALUES ('90', '20', '', '', '0', '0', '0', '0', '2020-01-20', 'D', null, '', '0', '0.00', '0.00', '2.00', 'manual', '49');
INSERT INTO `tb_absen` VALUES ('91', '20', '', '', '0', '0', '0', '0', '2020-01-20', 'I', null, 'liburan', '0', '0.00', '0.00', '3.00', 'manual', '50');
INSERT INTO `tb_absen` VALUES ('92', '20', '', '', '0', '0', '0', '0', '2020-01-21', 'I', null, 'liburan', '0', '0.00', '0.00', '3.00', 'manual', '50');
INSERT INTO `tb_absen` VALUES ('93', '20', '', '', '0', '0', '0', '0', '2020-01-22', 'I', null, 'liburan', '0', '0.00', '0.00', '3.00', 'manual', '50');
INSERT INTO `tb_absen` VALUES ('94', '0', '', '', '0', '0', '0', '0', '0000-00-00', '', null, '', '0', '0.00', '0.00', '0.00', 'manual', '0');
INSERT INTO `tb_absen` VALUES ('95', '0', '', '', '0', '0', '0', '0', '0000-00-00', '', null, '', '0', '0.00', '0.00', '0.00', 'manual', '0');
INSERT INTO `tb_absen` VALUES ('96', '0', '', '', '0', '0', '0', '0', '0000-00-00', '', null, '', '0', '0.00', '0.00', '0.00', 'manual', '0');
INSERT INTO `tb_absen` VALUES ('97', '0', '', '', '0', '0', '0', '0', '0000-00-00', '', null, '', '0', '0.00', '0.00', '0.00', 'manual', '0');
INSERT INTO `tb_absen` VALUES ('98', '0', '', '', '0', '0', '0', '0', '0000-00-00', '', null, '', '0', '0.00', '0.00', '0.00', 'manual', '0');
INSERT INTO `tb_absen` VALUES ('99', '5', '08:15', '16:30', '15', '0', '1', '0', '2020-01-21', 'H', null, '', '15', '0.00', '0.25', '0.25', 'manual', '47');

-- ----------------------------
-- Table structure for tb_id
-- ----------------------------
DROP TABLE IF EXISTS `tb_id`;
CREATE TABLE `tb_id` (
  `id` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `notifikasi` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tb_id
-- ----------------------------

-- ----------------------------
-- Table structure for tb_pengguna
-- ----------------------------
DROP TABLE IF EXISTS `tb_pengguna`;
CREATE TABLE `tb_pengguna` (
  `no` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(22) NOT NULL,
  `password` varchar(22) NOT NULL,
  `level` int(1) NOT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tb_pengguna
-- ----------------------------
INSERT INTO `tb_pengguna` VALUES ('2', 'dio', '123', '0');
INSERT INTO `tb_pengguna` VALUES ('6', 'admin', 'admin', '0');
INSERT INTO `tb_pengguna` VALUES ('8', 'operator', 'operator', '0');
INSERT INTO `tb_pengguna` VALUES ('9', 'adminz', 'adminz', '0');

-- ----------------------------
-- Table structure for tb_rfid
-- ----------------------------
DROP TABLE IF EXISTS `tb_rfid`;
CREATE TABLE `tb_rfid` (
  `id` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tb_rfid
-- ----------------------------

-- ----------------------------
-- Table structure for tb_settings
-- ----------------------------
DROP TABLE IF EXISTS `tb_settings`;
CREATE TABLE `tb_settings` (
  `masuk_mulai` time NOT NULL,
  `masuk_akhir` time NOT NULL,
  `keluar_mulai` time NOT NULL,
  `keluar_akhir` time NOT NULL,
  `libur1` varchar(10) NOT NULL,
  `libur2` varchar(10) NOT NULL,
  `timezone` varchar(22) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pwdemail` varchar(50) NOT NULL,
  `admin_uid` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tb_settings
-- ----------------------------
INSERT INTO `tb_settings` VALUES ('00:00:00', '08:15:00', '16:00:00', '20:30:00', 'Sabtu', 'Minggu', 'Asia/Jakarta', 'emailpresensi@gmail.com', 'dtproduction', '1749B411');

-- ----------------------------
-- View structure for vw_agama
-- ----------------------------
DROP VIEW IF EXISTS `vw_agama`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `vw_agama` AS SELECT
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
	) ;

-- ----------------------------
-- View structure for vw_divisi
-- ----------------------------
DROP VIEW IF EXISTS `vw_divisi`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `vw_divisi` AS SELECT
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
	) ;

-- ----------------------------
-- View structure for vw_hari_libur
-- ----------------------------
DROP VIEW IF EXISTS `vw_hari_libur`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `vw_hari_libur` AS SELECT
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
	) ;

-- ----------------------------
-- View structure for vw_hari_libur_2
-- ----------------------------
DROP VIEW IF EXISTS `vw_hari_libur_2`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `vw_hari_libur_2` AS SELECT
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
	) ;

-- ----------------------------
-- View structure for vw_jabatan
-- ----------------------------
DROP VIEW IF EXISTS `vw_jabatan`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `vw_jabatan` AS SELECT
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
	) ;

-- ----------------------------
-- View structure for vw_katkaryawan
-- ----------------------------
DROP VIEW IF EXISTS `vw_katkaryawan`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `vw_katkaryawan` AS SELECT
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
	) ;

-- ----------------------------
-- View structure for vw_statuspernikahan
-- ----------------------------
DROP VIEW IF EXISTS `vw_statuspernikahan`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `vw_statuspernikahan` AS SELECT
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
	) ;

-- ----------------------------
-- View structure for vw_tipepresensi
-- ----------------------------
DROP VIEW IF EXISTS `vw_tipepresensi`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `vw_tipepresensi` AS SELECT
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
	) ;
