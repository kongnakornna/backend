/*
Navicat MySQL Data Transfer

Source Server         : DB
Source Server Version : 50620
Source Host           : 192.168.10.135:3306
Source Database       : trueplookpanya

Target Server Type    : MYSQL
Target Server Version : 50620
File Encoding         : 65001

Date: 2016-11-17 10:35:35
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `keys`
-- ----------------------------
DROP TABLE IF EXISTS `keys`;
CREATE TABLE `keys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of keys
-- ----------------------------
INSERT INTO `keys` VALUES ('1', '123456', '1', '0', '20160909');
