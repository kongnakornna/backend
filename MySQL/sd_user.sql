/*
Navicat MySQL Data Transfer

Source Server         : 3306
Source Server Version : 50625
Source Host           : localhost:3306
Source Database       : democi_db

Target Server Type    : MYSQL
Target Server Version : 50625
File Encoding         : 65001

Date: 2016-02-28 21:59:20
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `sd_user`
-- ----------------------------
DROP TABLE IF EXISTS `sd_user`;
CREATE TABLE `sd_user` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id2` int(10) DEFAULT NULL,
  `user_type_id` int(10) DEFAULT '0',
  `user_team_id` int(10) DEFAULT NULL,
  `user_username` varchar(50) DEFAULT NULL,
  `user_password` varchar(50) DEFAULT NULL,
  `user_avatar` varchar(50) DEFAULT NULL,
  `user_name` varchar(150) DEFAULT NULL,
  `user_lastname` varchar(150) DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `department` varchar(150) DEFAULT NULL,
  `address` text,
  `create_date` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `create_by` int(10) DEFAULT '0',
  `lastupdate_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `lastupdate_by` int(10) DEFAULT '0',
  `lastlogin` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `lang` char(5) DEFAULT 'en',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sd_user
-- ----------------------------
INSERT INTO `sd_user` VALUES ('1', '1', '1', '1', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'tmon.gif', 'Administrator', 'Monitor', 'kongnakornna@gmail.com', '0857365371', '(085) 736-5371', 'Administrator', 'Egits', '2015-09-29 19:43:00', '0', '2015-05-01 11:16:58', '0', '2016-02-27 21:04:54', '1', 'en');
INSERT INTO `sd_user` VALUES ('2', '2', '2', '6', 'system', 'f0a212f54836d3db9ec06b95e03d4a76', 'tmon2.jpg', 'System', 'Dev', 'tmonsa@gmail.com', '(08) 573-6537', '(085) 736-5371', 'Administrator', '20 ชอยสกุลชา  ถ.ประดิษฐ์มนูธรรม แยก 15 แขวง ลาดพร้าว เขต ลาดพร้าว กทม  10230', '2015-05-01 11:18:48', '0', '2015-05-01 11:17:51', '0', '2015-09-30 03:44:28', '1', 'en');
INSERT INTO `sd_user` VALUES ('3', '3', '3', '1', 'subporttmon', 'bf747e6b35fccde85ec6a42abd0ab117', 'admin_201510260119193.gif', 'Subport', 'Dev', 'supoorttmon@gmail.com', '(08) 573-7537', '(085) 736-5371', 'IT', 'EGITS Enterprise Co.,Ltd ', '2015-05-01 11:47:36', '0', '2015-05-01 11:47:36', '0', '2015-10-01 21:21:11', '1', 'en');
INSERT INTO `sd_user` VALUES ('4', '4', '4', '1', 'somprom', 'a23b5ae79db95e0838d376ce60b59124', 'admin_201510060003103.jpg', 'Somprom', 'Dev', 'somprom@gmail.com', '(09) 882-8288', '(029) 292-9999', 'IT', 'somprom', '2015-05-01 01:26:31', '0', '2015-05-01 13:26:31', '0', '2015-10-01 21:28:06', '0', 'en');
INSERT INTO `sd_user` VALUES ('5', '5', '4', '1', 'nakorn', '9b85b931f09add7ef44d0b5771b35a47', 'admin_201510060004179.jpg', 'คงนคร', 'จันทะคุณ', 'kongnakornna2@gmail.com', '(08) 587-6568', '(085) 736-5371', 'IT', '<p>20 ชอยสกุลชา ถ.ประดิษฐ์มนูธรรม แยก 15 แขวง ลาดพร้าว เขต ลาดพร้าว กทม 10230</p>\r\n', '2015-05-03 04:13:26', '0', '2015-05-03 04:13:26', '0', '2016-02-28 16:18:39', '1', 'en');
INSERT INTO `sd_user` VALUES ('6', '6', '2', '1', 'adminna', '76ae58d7cafdffc8e33cca03ff3c945e', 'admin_201510060005723.jpg', 'Administrator', 'Na', 'admin@gmail.com', '0986775456', '(085) 736-5371', 'MA', '<p>20 ชอยสกุลชา&nbsp; ถ.ประดิษฐ์มนูธรรม แยก 15 แขวง ลาดพร้าว เขต ลาดพร้าว กทม&nbsp; 10230</p>\r\n', '2015-09-27 09:18:13', '0', '2015-09-28 03:18:14', '0', '2016-02-27 20:57:54', '0', 'en');
INSERT INTO `sd_user` VALUES ('7', '1', '1', '1', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'tmon.gif', 'Administrator', 'Monitor', 'kongnakornna@gmail.com', '0857365371', '(085) 736-5371', 'Administrator', 'Egits', '2015-09-29 19:43:00', '0', '2015-05-01 11:16:58', '0', '2016-02-27 21:04:54', '1', 'th');
INSERT INTO `sd_user` VALUES ('8', '2', '2', '6', 'system', 'f0a212f54836d3db9ec06b95e03d4a76', 'tmon2.jpg', 'System', 'Dev', 'tmonsa@gmail.com', '(08) 573-6537', '(085) 736-5371', 'Administrator', '20 ชอยสกุลชา  ถ.ประดิษฐ์มนูธรรม แยก 15 แขวง ลาดพร้าว เขต ลาดพร้าว กทม  10230', '2015-05-01 11:18:48', '0', '2015-05-01 11:17:51', '0', '2015-09-30 03:44:28', '1', 'th');
INSERT INTO `sd_user` VALUES ('9', '3', '3', '1', 'subporttmon', 'bf747e6b35fccde85ec6a42abd0ab117', 'admin_201510260119193.gif', 'Subport', 'Dev', 'supoorttmon@gmail.com', '(08) 573-7537', '(085) 736-5371', 'IT', 'EGITS Enterprise Co.,Ltd ', '2015-05-01 11:47:36', '0', '2015-05-01 11:47:36', '0', '2015-10-01 21:21:11', '1', 'th');
INSERT INTO `sd_user` VALUES ('10', '4', '4', '1', 'somprom', 'a23b5ae79db95e0838d376ce60b59124', 'admin_201510060003103.jpg', 'Somprom', 'Dev', 'somprom@gmail.com', '(09) 882-8288', '(029) 292-9999', 'IT', 'somprom', '2015-05-01 01:26:31', '0', '2015-05-01 13:26:31', '0', '2015-10-01 21:28:06', '0', 'th');
INSERT INTO `sd_user` VALUES ('11', '4', '4', '1', 'nakorn', '9b85b931f09add7ef44d0b5771b35a47', 'admin_201510060004179.jpg', 'คงนคร', 'จันทะคุณ', 'kongnakornna2@gmail.com', '(08) 587-6568', '(085) 736-5371', 'IT', '<p>20 ชอยสกุลชา ถ.ประดิษฐ์มนูธรรม แยก 15 แขวง ลาดพร้าว เขต ลาดพร้าว กทม 10230</p>', '0000-00-00 00:00:00', '0', '2016-02-28 21:55:35', '0', null, '0', 'th');
INSERT INTO `sd_user` VALUES ('12', '1', '2', '1', 'adminna', '76ae58d7cafdffc8e33cca03ff3c945e', 'admin_201510060005723.jpg', 'Administrator', 'Monitor', 'kongnakornna@gmail.com', '0857365371', '(085) 736-5371', 'Administrator', 'Egits', '2015-09-29 19:43:00', '0', '2015-05-01 11:16:58', '0', '2016-02-27 21:04:54', '1', 'th');
