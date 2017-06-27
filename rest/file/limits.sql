/*
Navicat MySQL Data Transfer

Source Server         : DB
Source Server Version : 50620
Source Host           : 192.168.10.135:3306
Source Database       : trueplookpanya

Target Server Type    : MYSQL
Target Server Version : 50620
File Encoding         : 65001

Date: 2016-11-17 10:38:23
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `limits`
-- ----------------------------
DROP TABLE IF EXISTS `limits`;
CREATE TABLE `limits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uri` varchar(255) NOT NULL,
  `count` int(10) NOT NULL,
  `hour_started` int(11) NOT NULL,
  `api_key` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of limits
-- ----------------------------
