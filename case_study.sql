/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 80030
 Source Host           : localhost:3306
 Source Schema         : case_study

 Target Server Type    : MySQL
 Target Server Version : 80030
 File Encoding         : 65001

 Date: 29/03/2023 22:48:09
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for personprofile
-- ----------------------------
DROP TABLE IF EXISTS `personprofile`;
CREATE TABLE `personprofile`  (
  `profileid` int(0) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `lastname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `middlename` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `gender` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  PRIMARY KEY (`profileid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of personprofile
-- ----------------------------
INSERT INTO `personprofile` VALUES (2, 'ftest1', 'ltest1', 'mtest1', 'M', 'atest1');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `gender` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `age` int(0) NOT NULL,
  `mobile` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `temp` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `diag` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `enc` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `vac` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nat` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (2, 'Ryan Abcede', 'male', 30, '0906123456', '5', 'yes', 'yes', 'no', 'Filipino', '2023-03-27 20:38:19');

-- ----------------------------
-- Table structure for users_copy1
-- ----------------------------
DROP TABLE IF EXISTS `users_copy1`;
CREATE TABLE `users_copy1`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Gender` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Age` int(0) NOT NULL,
  `Mobile` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Temp` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Diag` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Encounter` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Vax` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Nationality` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users_copy1
-- ----------------------------
INSERT INTO `users_copy1` VALUES (2, 'Ryan Abcede', 'male', 30, '0906123456', '5', 'yes', 'yes', 'no', 'Filipino', '2023-03-27 20:38:19');

-- ----------------------------
-- Procedure structure for sp_delete
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_delete`;
delimiter ;;
CREATE PROCEDURE `sp_delete`(`rid` INT(5))
BEGIN
delete from users where id=rid;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for sp_insert
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_insert`;
delimiter ;;
CREATE PROCEDURE `sp_insert`(`name` varchar(255),`gender` varchar(255),`age` int(11),`mobile` varchar(255),`temp` varchar(255), `diag` varchar(255),`encounter` varchar(255),`vax` varchar(255),`nationality` varchar(255))
BEGIN
insert into users(Name,Gender,Age,Mobile,Temp,Diag,Encounter,Vax,Nationality) value(name,gender,age,mobile,temp,diag,encounter,vax,nationality);
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for sp_read
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_read`;
delimiter ;;
CREATE PROCEDURE `sp_read`()
BEGIN
select * from users;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for sp_readarow
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_readarow`;
delimiter ;;
CREATE PROCEDURE `sp_readarow`(IN `rid` INT(5))
BEGIN
select * from users where id=rid;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for sp_update
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_update`;
delimiter ;;
CREATE PROCEDURE `sp_update`(`name` varchar(255),`gender` varchar(255),`age` int(11),`mobile` varchar(255),`temp` varchar(255), `diag` varchar(255),`encounter` varchar(255),`vax` varchar(255),`nationality` varchar(255),`rid` int(5))
BEGIN
update users set Name=name,Gender=gender,Age=age,Mobile=mobile,Temp=temp,Diag=diag,Encounter=encounter,Vax=vax,Nationality=nationality where id=rid;
END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
