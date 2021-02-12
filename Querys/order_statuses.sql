/*
 Navicat Premium Data Transfer

 Source Server         : laragon
 Source Server Type    : MySQL
 Source Server Version : 50724
 Source Host           : localhost:3306
 Source Schema         : tarquistore

 Target Server Type    : MySQL
 Target Server Version : 50724
 File Encoding         : 65001

 Date: 12/02/2021 12:44:50
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for order_statuses
-- ----------------------------
DROP TABLE IF EXISTS `order_statuses`;
CREATE TABLE `order_statuses`  (
  `codigo` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`codigo`) USING BTREE,
  UNIQUE INDEX `order_statuses_codigo_unique`(`codigo`) USING BTREE,
  UNIQUE INDEX `order_statuses_name_unique`(`name`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of order_statuses
-- ----------------------------
INSERT INTO `order_statuses` VALUES ('OC', 'Cancelado', 'El pedido ha sido cancelado', '2021-02-11 03:56:58', '2021-02-11 03:56:58');
INSERT INTO `order_statuses` VALUES ('OE', 'Entregado', 'El pedido ha sido entregado', '2021-02-11 03:56:58', '2021-02-11 03:56:58');
INSERT INTO `order_statuses` VALUES ('OP', 'Pendiente', 'La orden ha sido ingresada', '2021-02-11 03:56:58', '2021-02-11 03:56:58');
INSERT INTO `order_statuses` VALUES ('OR', 'Reagendado', 'El pedido ha cambiado la fecha de entrega', '2021-02-11 03:56:58', '2021-02-11 03:56:58');

SET FOREIGN_KEY_CHECKS = 1;
