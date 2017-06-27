/*
Navicat MySQL Data Transfer

Source Server         : DB
Source Server Version : 50620
Source Host           : 192.168.10.135:3306
Source Database       : trueplookpanya

Target Server Type    : MYSQL
Target Server Version : 50620
File Encoding         : 65001

Date: 2016-11-17 10:37:27
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `access`
-- ----------------------------
DROP TABLE IF EXISTS `access`;
CREATE TABLE `access` (
  `id` int(11) unsigned NOT NULL,
  `key` varchar(40) NOT NULL DEFAULT '',
  `all_access` tinyint(1) NOT NULL DEFAULT '0',
  `controller` varchar(50) NOT NULL DEFAULT '',
  `date_created` datetime DEFAULT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of access
-- ----------------------------
