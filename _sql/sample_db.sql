/*
Navicat MySQL Data Transfer

Source Server         : MariaDB@3307
Source Server Version : 50505
Source Host           : localhost:3307
Source Database       : sample_db

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-07-06 22:01:03
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `lib_status`
-- ----------------------------
DROP TABLE IF EXISTS `lib_status`;
CREATE TABLE `lib_status` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `status_desc` varchar(25) DEFAULT NULL,
  `lock_record` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of lib_status
-- ----------------------------
INSERT INTO `lib_status` VALUES ('1', 'New', '0');
INSERT INTO `lib_status` VALUES ('2', 'On-going', '0');
INSERT INTO `lib_status` VALUES ('3', 'Done', '1');

-- ----------------------------
-- Table structure for `lib_user_roles`
-- ----------------------------
DROP TABLE IF EXISTS `lib_user_roles`;
CREATE TABLE `lib_user_roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(55) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `can_add` tinyint(1) NOT NULL DEFAULT 0,
  `can_edit` tinyint(1) NOT NULL DEFAULT 0,
  `can_delete` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of lib_user_roles
-- ----------------------------
INSERT INTO `lib_user_roles` VALUES ('1', 'Admin', '1', '1', '1', '1');
INSERT INTO `lib_user_roles` VALUES ('2', 'Encoder', '0', '1', '0', '0');

-- ----------------------------
-- Table structure for `tbl_offices`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_offices`;
CREATE TABLE `tbl_offices` (
  `office_id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) DEFAULT NULL,
  `short_name` varchar(15) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`office_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tbl_offices
-- ----------------------------
INSERT INTO `tbl_offices` VALUES ('1', 'Office of the Regional Director', 'ORDx', null, '1');
INSERT INTO `tbl_offices` VALUES ('2', 'Office of the Assistant Regional Director for Administration', 'ARDA', '1', '1');
INSERT INTO `tbl_offices` VALUES ('3', 'Office of the Assistant Regional Director for Operations', 'ARDO', '1', '1');
INSERT INTO `tbl_offices` VALUES ('4', 'Protective Services Division', 'PrSD', '3', '1');
INSERT INTO `tbl_offices` VALUES ('5', 'Promotive Services Division', 'PmSD', '3', '1');
INSERT INTO `tbl_offices` VALUES ('6', 'Disaster Response Division', 'DRD', '3', '1');
INSERT INTO `tbl_offices` VALUES ('7', 'Capacity Building Section', 'CBS', '4', '1');
INSERT INTO `tbl_offices` VALUES ('8', 'Center- Based Section', 'Center-Based', '4', '1');
INSERT INTO `tbl_offices` VALUES ('9', 'Crisis Intervention Unit', 'CIU', '4', '1');
INSERT INTO `tbl_offices` VALUES ('10', 'Home for Girls', 'HFG', '8', '1');
INSERT INTO `tbl_offices` VALUES ('11', 'Regional Rehabilitation Center for Youth', 'RRCY', '8', '1');
INSERT INTO `tbl_offices` VALUES ('12', 'Community-Based Section', 'Comm-based', '4', '1');
INSERT INTO `tbl_offices` VALUES ('13', 'Supplementary Feeding Program', 'SFP', '12', '1');
INSERT INTO `tbl_offices` VALUES ('14', 'Social Pension for Indigent Senior Citizens', 'SocPen', '12', '1');
INSERT INTO `tbl_offices` VALUES ('15', 'Adoption Referral & Resource Section', 'ARRS', '12', '1');
INSERT INTO `tbl_offices` VALUES ('16', 'MTA', 'MTA', '12', '1');
INSERT INTO `tbl_offices` VALUES ('17', 'Sustainable Livelihood Program', 'SLP', '5', '1');
INSERT INTO `tbl_offices` VALUES ('18', 'KALAHI-CIDDS', 'KC', '5', '1');
INSERT INTO `tbl_offices` VALUES ('19', 'Pantawid Pamilya', 'PP', '5', '1');
INSERT INTO `tbl_offices` VALUES ('20', 'Disaster Reponse & Rehabilitation Section', 'DRRS', '6', '1');
INSERT INTO `tbl_offices` VALUES ('21', 'Disaster Response Information Management Section', 'DRIMS', '6', '1');
INSERT INTO `tbl_offices` VALUES ('22', 'Regional Resource Operation Section', 'RROC', '6', '1');
INSERT INTO `tbl_offices` VALUES ('23', 'Warehouse Unit', 'Warehouse', '22', '1');
INSERT INTO `tbl_offices` VALUES ('24', 'Donation Unit', 'Donation', '22', '1');
INSERT INTO `tbl_offices` VALUES ('25', 'Internal Audit Service', 'IAS', '1', '1');
INSERT INTO `tbl_offices` VALUES ('26', 'Social Marketing Unit', 'SMU', '1', '1');
INSERT INTO `tbl_offices` VALUES ('27', 'Legal Unit', 'Legal', '1', '1');
INSERT INTO `tbl_offices` VALUES ('28', 'Policy and Plans Division', 'PPD', '1', '1');
INSERT INTO `tbl_offices` VALUES ('29', 'Policy Development annd Planning Section', 'PDPS', '28', '1');
INSERT INTO `tbl_offices` VALUES ('30', 'Information and Communications Management Section', 'ICTMS', '28', '1');
INSERT INTO `tbl_offices` VALUES ('31', 'National Household Targeting Section', 'Listahanan', '28', '1');
INSERT INTO `tbl_offices` VALUES ('32', 'Standards Section', 'Standards', '28', '1');

-- ----------------------------
-- Table structure for `tbl_sample`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_sample`;
CREATE TABLE `tbl_sample` (
  `request_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `destination` varchar(255) DEFAULT NULL,
  `travel_date` datetime DEFAULT NULL,
  `req_status` tinyint(4) DEFAULT NULL,
  `encoded_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`request_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tbl_sample
-- ----------------------------
INSERT INTO `tbl_sample` VALUES ('2', 'test', '2018-07-31 12:00:00', '1', '1');
INSERT INTO `tbl_sample` VALUES ('4', 'test 123123123', '2018-07-19 04:00:00', '1', '2');

-- ----------------------------
-- Table structure for `tbl_users`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employeeid` varchar(20) COLLATE utf8_unicode_ci DEFAULT '',
  `office_id` int(11) DEFAULT NULL,
  `username` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci DEFAULT '',
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `user_role` int(11) DEFAULT NULL,
  `last_login` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`) USING BTREE,
  KEY `fk_office_id` (`office_id`),
  KEY `fk_role_id` (`user_role`),
  CONSTRAINT `tbl_users_ibfk_1` FOREIGN KEY (`office_id`) REFERENCES `tbl_offices` (`office_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbl_users_ibfk_2` FOREIGN KEY (`user_role`) REFERENCES `lib_user_roles` (`role_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_users
-- ----------------------------
INSERT INTO `tbl_users` VALUES ('1', '16-08510', '30', 'jaleonardo', '$2y$10$yqEJJjtTRK3bWK8c3jhG8eYvawmU9RSq2jykaBrxgCGjaRmQ5zMrm', 'John', 'Leonardo', 'Computer Programmer I', '1', '1', '2018-07-06 21:14:28');
INSERT INTO `tbl_users` VALUES ('2', '16-99999', '9', 'test_user', '$2y$10$ICubAb0DL20vsjL2iPStZuG1KVHKL.NWTD5tQqX/L9CJQa9kduIZy', 'Test', 'User', 'Test User for AD + PHP login', '1', '2', '2018-07-06 21:13:01');

-- ----------------------------
-- Table structure for `tbl_user_roles`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user_roles`;
CREATE TABLE `tbl_user_roles` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  KEY `user_id` (`user_id`) USING BTREE,
  KEY `role_id` (`role_id`) USING BTREE,
  CONSTRAINT `tbl_user_roles_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `lib_user_roles` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_user_roles_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_user_roles
-- ----------------------------
