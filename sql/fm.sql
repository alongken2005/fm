/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50524
Source Host           : localhost:3306
Source Database       : fm

Target Server Type    : MYSQL
Target Server Version : 50524
File Encoding         : 65001

Date: 2013-03-01 19:57:52
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `fm_adminer`
-- ----------------------------
DROP TABLE IF EXISTS `fm_adminer`;
CREATE TABLE `fm_adminer` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL DEFAULT '',
  `password` char(32) NOT NULL DEFAULT '',
  `power` text NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ctime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fm_adminer
-- ----------------------------
INSERT INTO `fm_adminer` VALUES ('3', 'admin', '4297f44b13955235245b2497399d7a93', '', '0', '0');

-- ----------------------------
-- Table structure for `fm_mood`
-- ----------------------------
DROP TABLE IF EXISTS `fm_mood`;
CREATE TABLE `fm_mood` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `pic` varchar(100) NOT NULL COMMENT '图片',
  `mp3` varchar(100) NOT NULL COMMENT '音乐',
  `hits` int(10) NOT NULL,
  `sort` int(10) unsigned NOT NULL COMMENT '排序',
  `ctime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fm_mood
-- ----------------------------
