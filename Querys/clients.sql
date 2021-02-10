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

 Date: 09/02/2021 19:39:53
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for clients
-- ----------------------------
DROP TABLE IF EXISTS `clients`;
CREATE TABLE `clients`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `identification` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `name` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone1` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone2` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'A',
  `type_identification_cod` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `clients_identification_unique`(`identification`) USING BTREE,
  INDEX `clients_type_identification_cod_foreign`(`type_identification_cod`) USING BTREE,
  CONSTRAINT `clients_type_identification_cod_foreign` FOREIGN KEY (`type_identification_cod`) REFERENCES `type_identifications` (`codigo`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 101 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of clients
-- ----------------------------
INSERT INTO `clients` VALUES (1, '151852489', 'ABARCA INGRIDÿ', 'HERRERA SERGIOÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114019', '42198437', 'iabarcae@yahoo.es', 'A', '05', '2021-02-06 19:47:02', '2021-02-06 19:47:02');
INSERT INTO `clients` VALUES (2, '161852490', 'ABARCA MARITZAÿ', 'IBARRA ISABELÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114020', '42198437', 'maeillanes@hotmail.com', 'A', '05', '2021-02-06 19:47:02', '2021-02-06 19:47:02');
INSERT INTO `clients` VALUES (3, '173852388', 'ABARCA OSVALDOÿ', 'IBARRA IVANÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114021', '42198437', 'osabarca@hotmail.com', 'A', '05', '2021-02-06 19:47:02', '2021-02-06 19:47:02');
INSERT INTO `clients` VALUES (4, '178852389', 'ABRIGO CAMILAÿ', 'IDALSOAGA IGNACIOÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114022', '42198437', 'cabrigo@garmendia.cl', 'A', '05', '2021-02-06 19:47:02', '2021-02-06 19:47:02');
INSERT INTO `clients` VALUES (5, '171852390', 'ABRIGO IGNACIOÿ', 'ITURRI SERGIOÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114023', '42198437', 'Sb.nashxo.sk8@hotmail.com', 'A', '05', '2021-02-06 19:47:02', '2021-02-06 19:47:02');
INSERT INTO `clients` VALUES (6, '171852391', 'ABUMOHOR FRANCISCAÿ', 'JABALQUINTO ARTURO', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114024', '42198437', 'fran.afull@live.cl', 'A', '05', '2021-02-06 19:47:02', '2021-02-06 19:47:02');
INSERT INTO `clients` VALUES (7, '171852392', 'AGUILERA CARLOSÿ', 'JARA GALOÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114025', '42198437', 'carlosaguileram@hotmail.com', 'A', '05', '2021-02-06 19:47:02', '2021-02-06 19:47:02');
INSERT INTO `clients` VALUES (8, '171852393', 'AGUILERA CATALINAÿ', 'JARA MAURICIOÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114026', '42198437', 'ikis_rojo@hotmail.com', 'A', '05', '2021-02-06 19:47:02', '2021-02-06 19:47:02');
INSERT INTO `clients` VALUES (9, '171852394', 'AGUILERA DANIELAÿ', 'JIMENEZ CLAUDIOÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114027', '42198437', 'daniela_aguilera_m500@hotmail.com', 'A', '05', '2021-02-06 19:47:02', '2021-02-06 19:47:02');
INSERT INTO `clients` VALUES (10, '171852395', 'AGUILERA FRANCISCAÿ', 'JIMENEZ EXEQUIELÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114028', '42198437', 'vizkala@hotmail.com', 'A', '05', '2021-02-06 19:47:03', '2021-02-06 19:47:03');
INSERT INTO `clients` VALUES (11, '171852396', 'AGUILERA FRANCISCOÿ', 'JORQUERA SUSANAÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114029', '42198437', 'alexus3@hotmail.com', 'A', '05', '2021-02-06 19:47:03', '2021-02-06 19:47:03');
INSERT INTO `clients` VALUES (12, '171852397', 'AGUILERA LUISÿ', 'KATALINIC VERONICA', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114030', '42198437', 'capitanaguilera@hotmail.com', 'A', '05', '2021-02-06 19:47:03', '2021-02-06 19:47:03');
INSERT INTO `clients` VALUES (13, '171852398', 'ALAMOS ANDREAÿ', 'KELLER CHRISTOPHERÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114031', '42198437', 'apalamosg@hotmail.com', 'A', '05', '2021-02-06 19:47:03', '2021-02-06 19:47:03');
INSERT INTO `clients` VALUES (14, '171852399', 'ANDRADE LUCILAÿ', 'KELLER MICHAELÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114032', '42198437', 'luuuuuuci@hotmail.com', 'A', '05', '2021-02-06 19:47:03', '2021-02-06 19:47:03');
INSERT INTO `clients` VALUES (15, '171852400', 'ANGULO CRISTIANÿ', 'KUNSTMANN VICKYÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114033', '42198437', 'kristian_siempre_azul@hotmail.com', 'A', '05', '2021-02-06 19:47:03', '2021-02-06 19:47:03');
INSERT INTO `clients` VALUES (16, '171852401', 'ANTILEO ALIHUENÿ', 'LABARCA ROSA MARIAÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114034', '42198437', 'mapuchin@hotmail.com', 'A', '05', '2021-02-06 19:47:03', '2021-02-06 19:47:03');
INSERT INTO `clients` VALUES (17, '171852402', 'ARAHUETES MARÖA DEL MARÿ', 'LABBE CARMEN LUZÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114035', '42198437', 'arahuetes@manquehue.net', 'A', '05', '2021-02-06 19:47:03', '2021-02-06 19:47:03');
INSERT INTO `clients` VALUES (18, '171852403', 'ARANCIBIA EDUARDOÿ', 'LABBE VICTORÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114036', '42198437', 'eduardo.arancibia@grange.cl', 'A', '05', '2021-02-06 19:47:03', '2021-02-06 19:47:03');
INSERT INTO `clients` VALUES (19, '171852404', 'ARANCIBIA MARTAÿ', 'LAGOS MIGUELÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114037', '42198437', 'martacam2002@yahoo.com', 'A', '05', '2021-02-06 19:47:03', '2021-02-06 19:47:03');
INSERT INTO `clients` VALUES (20, '171852405', 'ARAVENA ANDREAÿ', 'LANCELOTTI JOSE MIGUELÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114038', '42198437', 'andrea.geoplanet@gmail.com', 'A', '05', '2021-02-06 19:47:03', '2021-02-06 19:47:03');
INSERT INTO `clients` VALUES (21, '171852406', 'ARAYA FRANCISCOÿ', 'LAZO GONZALOÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114039', '42198437', 'faraya@sprint.cl', 'A', '05', '2021-02-06 19:47:03', '2021-02-06 19:47:03');
INSERT INTO `clients` VALUES (22, '171852407', 'ARAYA LEONORÿ', 'LAZO LAUTAROÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114040', '42198437', 'leonor.araya@gmail.com', 'A', '05', '2021-02-06 19:47:03', '2021-02-06 19:47:03');
INSERT INTO `clients` VALUES (23, '171852408', 'ARAYA PAULAÿ', 'LETELIER ANA MARIAÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114041', '42198437', 'paulifran@hotmail.com', 'A', '05', '2021-02-06 19:47:03', '2021-02-06 19:47:03');
INSERT INTO `clients` VALUES (24, '171852409', 'ARELLANO JOSEFINAÿ', 'LILLO RICARDOÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114042', '42198437', 'bad.girl.-@hotmail.es', 'A', '05', '2021-02-06 19:47:03', '2021-02-06 19:47:03');
INSERT INTO `clients` VALUES (25, '171852410', 'ARGOMEDO JORGEÿ', 'LINEROS DORITAÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114043', '42198437', 'aargomedo@hecsa.cl', 'A', '05', '2021-02-06 19:47:03', '2021-02-06 19:47:03');
INSERT INTO `clients` VALUES (26, '171852411', 'ARGOMEDO MARILYÿ', 'LINEROS MONICAÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114044', '42198437', 'aargomedo@hecsa.cl', 'A', '05', '2021-02-06 19:47:03', '2021-02-06 19:47:03');
INSERT INTO `clients` VALUES (27, '171852412', 'ARMSTRONG ELIZABETH', 'LIZAMA PATRICIO', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114045', '42198437', 'elizabetharmstrong39@gmail.com', 'A', '05', '2021-02-06 19:47:03', '2021-02-06 19:47:03');
INSERT INTO `clients` VALUES (28, '171852413', 'ARNES CAROLINAÿ', 'LJUBETIC KRESIMIR', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114046', '42198437', 'c_arnes@hotmail.com', 'A', '05', '2021-02-06 19:47:03', '2021-02-06 19:47:03');
INSERT INTO `clients` VALUES (29, '171852414', 'ARRIAGADA ALEJANDROÿ', 'LOBATO FELIPEÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114047', '42198437', 'aarriagada@petrok.cl', 'A', '05', '2021-02-06 19:47:03', '2021-02-06 19:47:03');
INSERT INTO `clients` VALUES (30, '171852415', 'ARRIAZA JOHANNAÿ', 'LOISELLE HUMBERTOÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114048', '42198437', 'joy_pao_@hotmail.com', 'A', '05', '2021-02-06 19:47:03', '2021-02-06 19:47:03');
INSERT INTO `clients` VALUES (31, '171852416', 'ARTEAGA GERARDOÿ', 'LOISELLE PEDROÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114049', '42198437', 'carlosarteaga.pef@gmail.com', 'A', '05', '2021-02-06 19:47:03', '2021-02-06 19:47:03');
INSERT INTO `clients` VALUES (32, '171852417', 'ASENJO JORGEÿ', 'LOPEZ CRISTIANÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114050', '42198437', 'arquitectoasenjo@gmail.com', 'A', '05', '2021-02-06 19:47:03', '2021-02-06 19:47:03');
INSERT INTO `clients` VALUES (33, '171852418', 'ASENJO MARCELOÿ', 'LOPEZ JAVIER', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114051', '42198437', 'masenjog@gmail.com', 'A', '05', '2021-02-06 19:47:03', '2021-02-06 19:47:03');
INSERT INTO `clients` VALUES (34, '171852419', 'ASPEE CONSUELO', 'LUPPICHINI LOREDANAÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114052', '42198437', 'caspe@canal13.cl', 'A', '05', '2021-02-06 19:47:03', '2021-02-06 19:47:03');
INSERT INTO `clients` VALUES (35, '171852420', 'BANTO LUISÿ', 'MACERATTA PATRICIOÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114053', '42198437', 'bantomaui@gmail.com', 'A', '05', '2021-02-06 19:47:03', '2021-02-06 19:47:03');
INSERT INTO `clients` VALUES (36, '171852421', 'BANTO MARCELOÿ', 'MANDAKOVIC CARLOSÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114054', '42198437', 'mfbanto@gmail.com', 'A', '05', '2021-02-06 19:47:03', '2021-02-06 19:47:03');
INSERT INTO `clients` VALUES (37, '171852422', 'BANTO RODRIGOÿ', 'MARAMBIO CRISTINAÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114055', '42198437', 'Rodrigo.banto@Uvavins.ch', 'A', '05', '2021-02-06 19:47:03', '2021-02-06 19:47:03');
INSERT INTO `clients` VALUES (38, '171852423', 'BARRERA JORGEÿ', 'MARFIL ENRIQUEÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114056', '42198437', 'jbarrera05@hotmail.com', 'A', '05', '2021-02-06 19:47:03', '2021-02-06 19:47:03');
INSERT INTO `clients` VALUES (39, '171852424', 'BERGEZ CLAUDIA', 'MARTINA CARMENÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114057', '42198437', 'claudiabergez@gmail.com', 'A', '05', '2021-02-06 19:47:03', '2021-02-06 19:47:03');
INSERT INTO `clients` VALUES (40, '171852425', 'BERGEZ MICHELLE', 'MARTINEZ JAVIERÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114058', '42198437', 'michelebk@hotmail.com', 'A', '05', '2021-02-06 19:47:03', '2021-02-06 19:47:03');
INSERT INTO `clients` VALUES (41, '171852426', 'BERGUEZ MARIA ANGELICAÿ', 'MARTINEZ PAMELAÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114059', '42198437', 'angelicabergez@gmail.com', 'A', '05', '2021-02-06 19:47:03', '2021-02-06 19:47:03');
INSERT INTO `clients` VALUES (42, '171852427', 'BERGUEZ SOLEDADÿ', 'MELIS ANDREAÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114060', '42198437', 'solbk26@hotmail.com', 'A', '05', '2021-02-06 19:47:04', '2021-02-06 19:47:04');
INSERT INTO `clients` VALUES (43, '171852428', 'BRAVO CARLOSÿ', 'MENA AYLINÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114061', '42198437', 'cibravohuerta@yahoo.com', 'A', '05', '2021-02-06 19:47:04', '2021-02-06 19:47:04');
INSERT INTO `clients` VALUES (44, '171852429', 'BRAVO FOLLERTÿ', 'MENA DANIELAÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114062', '42198437', 'sebastianatila@hotmail.com', 'A', '05', '2021-02-06 19:47:04', '2021-02-06 19:47:04');
INSERT INTO `clients` VALUES (45, '171852430', 'BRAVO JAVIERÿ', 'MENESES LUISÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114063', '42198437', 'jabravot@yahoo.es', 'A', '05', '2021-02-06 19:47:04', '2021-02-06 19:47:04');
INSERT INTO `clients` VALUES (46, '171852431', 'BRAVO PAULINAÿ', 'MERINO CAROLINAÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114064', '42198437', 'pbg@endesa.cl', 'A', '05', '2021-02-06 19:47:04', '2021-02-06 19:47:04');
INSERT INTO `clients` VALUES (47, '171852432', 'BRITO OSCARÿ', 'MERINO CLAUDIAÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114065', '42198437', 'oscar.brito@gmail.com', 'A', '05', '2021-02-06 19:47:04', '2021-02-06 19:47:04');
INSERT INTO `clients` VALUES (48, '171852433', 'CABBADA ANIBALÿ', 'MERINO VICTORIAÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114066', '42198437', 'anibalito___@hotmail.com', 'A', '05', '2021-02-06 19:47:04', '2021-02-06 19:47:04');
INSERT INTO `clients` VALUES (49, '171852434', 'CABBADA DAVIDÿ', 'MESIAS IVAN', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114067', '42198437', 'rcabbada@vtr.net', 'A', '05', '2021-02-06 19:47:04', '2021-02-06 19:47:04');
INSERT INTO `clients` VALUES (50, '171852435', 'CABBADA JUAN PABLOÿ', 'MIMICA NADIAÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114068', '42198437', 'superjp_coco@hotmail.com', 'A', '05', '2021-02-06 19:47:04', '2021-02-06 19:47:04');
INSERT INTO `clients` VALUES (51, '171852436', 'CABBADA NICOLASÿ', 'MOLIN MARRIETTA', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114069', '42198437', 'cabbada@gmail.com', 'A', '05', '2021-02-06 19:47:04', '2021-02-06 19:47:04');
INSERT INTO `clients` VALUES (52, '171852437', 'CABBADA REGINAÿ', 'MOLINA GERARDOÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114070', '42198437', 'nina_cabbada@hotmail.com', 'A', '05', '2021-02-06 19:47:04', '2021-02-06 19:47:04');
INSERT INTO `clients` VALUES (53, '171852438', 'CABBADA YASMINÿ', 'MOLINA RODRIGOÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114071', '42198437', 'yaz_antu@yahoo.com', 'A', '05', '2021-02-06 19:47:04', '2021-02-06 19:47:04');
INSERT INTO `clients` VALUES (54, '171852439', 'CACERES M.CONSUELOÿ', 'MONDACA EMMAÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114072', '42198437', 'consuelo_caceres@hotmail.com', 'A', '05', '2021-02-06 19:47:04', '2021-02-06 19:47:04');
INSERT INTO `clients` VALUES (55, '171852440', 'CALCAGNO DANTEÿ', 'MORALES SUSANAÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114073', '42198437', 'dantekol@hotmail.com', 'A', '05', '2021-02-06 19:47:04', '2021-02-06 19:47:04');
INSERT INTO `clients` VALUES (56, '171852441', 'CALCAGNO GIANCARLOÿ', 'MOREIRA DARIOÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114074', '42198437', 'lukalcagno@gmail.com', 'A', '05', '2021-02-06 19:47:04', '2021-02-06 19:47:04');
INSERT INTO `clients` VALUES (57, '171852442', 'CALCAGNO GIANFRANCOÿ', 'MOREN GERMAN', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114075', '42198437', 'ruliandro@hotmail.com', 'A', '05', '2021-02-06 19:47:04', '2021-02-06 19:47:04');
INSERT INTO `clients` VALUES (58, '171852443', 'CALDERON IVAN', 'MOREN LUIS', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114076', '42198437', 'icalderon@tecval.cl', 'A', '05', '2021-02-06 19:47:04', '2021-02-06 19:47:04');
INSERT INTO `clients` VALUES (59, '171852444', 'CALDERON PABLO', 'MU¥OZ NYDIAÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114077', '42198437', 'pablo.calderon.cadiz@gmail.com', 'A', '05', '2021-02-06 19:47:04', '2021-02-06 19:47:04');
INSERT INTO `clients` VALUES (60, '171852445', 'CAMPOS ALICIAÿ', 'NAVARRETE LUISÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114078', '42198437', 'allicamposv@hotmail.com', 'A', '05', '2021-02-06 19:47:04', '2021-02-06 19:47:04');
INSERT INTO `clients` VALUES (61, '171852446', 'CAMPOS GERMANÿ', 'NEIRA CAROLINAÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114079', '42198437', 'campos.onfray@gmail.com', 'A', '05', '2021-02-06 19:47:04', '2021-02-06 19:47:04');
INSERT INTO `clients` VALUES (62, '171852447', 'CAMPOS JORGE', 'NEIRA KARINAÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114080', '42198437', 'jorge.campos@impromac.cl', 'A', '05', '2021-02-06 19:47:04', '2021-02-06 19:47:04');
INSERT INTO `clients` VALUES (63, '171852448', 'CA¥AS RAUL', 'NEIRA PATRICIAÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114081', '42198437', 'raulcd02ster@gmail.com', 'A', '05', '2021-02-06 19:47:04', '2021-02-06 19:47:04');
INSERT INTO `clients` VALUES (64, '171852449', 'CARMONA JAIME', 'NEUBURG MIGUELÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114082', '42198437', 'jaime.carmona@gendarmeria.clÿ', 'A', '05', '2021-02-06 19:47:04', '2021-02-06 19:47:04');
INSERT INTO `clients` VALUES (65, '171852450', 'CASAJUANA CLAUDIAÿ', 'NIETO JORGEÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114083', '42198437', 'tantitamivida@gmail.com', 'A', '05', '2021-02-06 19:47:04', '2021-02-06 19:47:04');
INSERT INTO `clients` VALUES (66, '171852451', 'CASAJUANA FELIPEÿ', 'OGINO GIANNAÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114084', '42198437', 'f.casajuan@gmail.com', 'A', '05', '2021-02-06 19:47:04', '2021-02-06 19:47:04');
INSERT INTO `clients` VALUES (67, '171852452', 'CASAJUANA JAIMEÿ', 'OJEDA FRANCISCOÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114085', '42198437', 'jaimecasajuana@gmail.com', 'A', '05', '2021-02-06 19:47:04', '2021-02-06 19:47:04');
INSERT INTO `clients` VALUES (68, '171852453', 'CASAJUANA JAVIERAÿ', 'OJEDA ISABELÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114086', '42198437', 'javi_javis_3@hotmail.com', 'A', '05', '2021-02-06 19:47:04', '2021-02-06 19:47:04');
INSERT INTO `clients` VALUES (69, '171852454', 'CASAJUANA JORGEÿ', 'OJEDA PIAÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114087', '42198437', 'casajuana_@hotmail.com', 'A', '05', '2021-02-06 19:47:04', '2021-02-06 19:47:04');
INSERT INTO `clients` VALUES (70, '171852455', 'CASTA¥EDA HUGOÿ', 'OLIVA CECILIAÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114088', '42198437', 'hugocastanedav@hotmail.com', 'A', '05', '2021-02-06 19:47:04', '2021-02-06 19:47:04');
INSERT INTO `clients` VALUES (71, '171852456', 'CASTA¥ON ALEJANDRAÿ', 'OPAZO EDUARDOÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114089', '42198437', 'acastanon@vectorchile.cl', 'A', '05', '2021-02-06 19:47:04', '2021-02-06 19:47:04');
INSERT INTO `clients` VALUES (72, '171852457', 'CASTA¥ON ALVARO', 'OPAZO GLORIAÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114090', '42198437', 'claudiocastanonmigeot@gmail.com', 'A', '05', '2021-02-06 19:47:04', '2021-02-06 19:47:04');
INSERT INTO `clients` VALUES (73, '171852458', 'CASTA¥ON ANA LUZÿ', 'ORTIZ CRIPUSCULOÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114091', '42198437', 'c.analuz@yahoo.es', 'A', '05', '2021-02-06 19:47:04', '2021-02-06 19:47:04');
INSERT INTO `clients` VALUES (74, '171852459', 'CASTA¥ON CLAUDIO', 'OSSES CRISTINAÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114092', '42198437', 'claudiocastanonmigeot@gmail.com', 'A', '05', '2021-02-06 19:47:05', '2021-02-06 19:47:05');
INSERT INTO `clients` VALUES (75, '171852460', 'CASTRO JORGEÿ', 'OSSES JORGEÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114093', '42198437', 'tango_negro@hotmail.com', 'A', '05', '2021-02-06 19:47:05', '2021-02-06 19:47:05');
INSERT INTO `clients` VALUES (76, '171852461', 'CASTRO PATRICIOÿ', 'OSSES RODRIGOÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114094', '42198437', 'pato_one@hotmail.com', 'A', '05', '2021-02-06 19:47:05', '2021-02-06 19:47:05');
INSERT INTO `clients` VALUES (77, '171852462', 'CORDEROÿÿJOAQUINÿ', 'OVALLE CECILIAÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114095', '42198437', 'joacocordero@gmail.com', 'A', '05', '2021-02-06 19:47:05', '2021-02-06 19:47:05');
INSERT INTO `clients` VALUES (78, '171852463', 'CORDERO MARIA PAZÿ', 'OVALLE LORETOÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114096', '42198437', 'pepacordero@gmail.com', 'A', '05', '2021-02-06 19:47:05', '2021-02-06 19:47:05');
INSERT INTO `clients` VALUES (79, '171852464', 'CORDOVA VALENTINAÿ', 'PADRE IGNACIOÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114097', '42198437', 'laah.valehh@hotmail.com', 'A', '05', '2021-02-06 19:47:05', '2021-02-06 19:47:05');
INSERT INTO `clients` VALUES (80, '171852465', 'CORTES ANA MARIA', 'PALOMAS ANTONIAÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114098', '42198437', 'annabeck_@hotmail.com', 'A', '05', '2021-02-06 19:47:05', '2021-02-06 19:47:05');
INSERT INTO `clients` VALUES (81, '171852466', 'CORTES JAIMEÿ', 'PALOMAS JORGEÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114099', '42198437', 'japacortes@yahoo.com', 'A', '05', '2021-02-06 19:47:05', '2021-02-06 19:47:05');
INSERT INTO `clients` VALUES (82, '171852467', 'CORTES JUANÿ', 'PALOMAS JUAN LUISÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114100', '42198437', 'juanocortes@hotmail.com', 'A', '05', '2021-02-06 19:47:05', '2021-02-06 19:47:05');
INSERT INTO `clients` VALUES (83, '171852468', 'CUMPLIDO MARCELOÿ', 'PASTENES ELIZABETHÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114101', '42198437', 'tallerlaquilla@gmail.com', 'A', '05', '2021-02-06 19:47:05', '2021-02-06 19:47:05');
INSERT INTO `clients` VALUES (84, '171852469', 'DE LA CARRERA ANAÿ', 'PASTORE ALDOÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114102', '42198437', 'anamariadelacarrera@gmail.com', 'A', '05', '2021-02-06 19:47:05', '2021-02-06 19:47:05');
INSERT INTO `clients` VALUES (85, '171852470', 'DE LA CARRERA PAULINAÿ', 'PATI¥O PIAÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114103', '42198437', 'paulinadelacarrera@gmail.com', 'A', '05', '2021-02-06 19:47:05', '2021-02-06 19:47:05');
INSERT INTO `clients` VALUES (86, '171852471', 'DE LAS HERAS FRANCISCOÿ', 'PEREZ CRISTIANÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114104', '42198437', 'fgregoriog@vtr.net', 'A', '05', '2021-02-06 19:47:05', '2021-02-06 19:47:05');
INSERT INTO `clients` VALUES (87, '171852472', 'DE MARCHI ANTONELLAÿ', 'POBLETE ANAÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114105', '42198437', 'anto_demarchi@hotmail.com', 'A', '05', '2021-02-06 19:47:05', '2021-02-06 19:47:05');
INSERT INTO `clients` VALUES (88, '171852473', 'DIAZ CAROLINAÿ', 'POLITIS VERONICAÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114106', '42198437', 'Karito_1404@hotmail.com', 'A', '05', '2021-02-06 19:47:05', '2021-02-06 19:47:05');
INSERT INTO `clients` VALUES (89, '171852474', 'DIAZ LORETOÿ', 'PRADENAS CRISTINA', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114107', '42198437', 'loredicat@hotmail.com', 'A', '05', '2021-02-06 19:47:05', '2021-02-06 19:47:05');
INSERT INTO `clients` VALUES (90, '171852475', 'DIAZ MARIA JOSE', 'PRAT JUAN PABLOÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114108', '42198437', 'diazma@tiscali.it', 'A', '05', '2021-02-06 19:47:05', '2021-02-06 19:47:05');
INSERT INTO `clients` VALUES (91, '171852476', 'DUBO PABLO', 'QUINTANILLA GONZALOÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114109', '42198437', 'pablodubof@gmail.com', 'A', '05', '2021-02-06 19:47:05', '2021-02-06 19:47:05');
INSERT INTO `clients` VALUES (92, '171852477', 'ECHIBURU PABLOÿ', 'QUINTERO MARIELAÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114110', '42198437', 'pecmor63@gmail.com', 'A', '05', '2021-02-06 19:47:06', '2021-02-06 19:47:06');
INSERT INTO `clients` VALUES (93, '171852478', 'ESCOTE JORGEÿ', 'RAMIREZÿÿPAULETTEÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114111', '42198437', 'jlescote@gasco.cl', 'A', '05', '2021-02-06 19:47:06', '2021-02-06 19:47:06');
INSERT INTO `clients` VALUES (94, '171852479', 'ESPINOZA ANDREAÿ', 'RAMOS CARLAÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114112', '42198437', 'aespinz@hotmail.com', 'A', '05', '2021-02-06 19:47:06', '2021-02-06 19:47:06');
INSERT INTO `clients` VALUES (95, '171852480', 'ESPINOZA FRANCISCOÿ', 'RAYO ASTRID', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114113', '42198437', 'fespinosacl@yahoo.com', 'A', '05', '2021-02-06 19:47:06', '2021-02-06 19:47:06');
INSERT INTO `clients` VALUES (96, '171852481', 'ESPINOZA RICARDOÿ', 'RETAMAL BRUNOÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114114', '42198437', 'ricardo.espinosa.z@hotmail.com', 'A', '05', '2021-02-06 19:47:06', '2021-02-06 19:47:06');
INSERT INTO `clients` VALUES (97, '171852482', 'ESPOZ ALVAROÿ', 'RETAMAL JUANÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114115', '42198437', 'alvaro.espoz@gmail.com', 'A', '05', '2021-02-06 19:47:06', '2021-02-06 19:47:06');
INSERT INTO `clients` VALUES (98, '171852483', 'EYSAGUIRRE PATRICIOÿ', 'REVECO CAROLAÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114116', '42198437', 'patorfebre@hotmail.com', 'A', '05', '2021-02-06 19:47:06', '2021-02-06 19:47:06');
INSERT INTO `clients` VALUES (99, '171852484', 'FERNANDEZ CLAUDIOÿ', 'REVECO MAURICIOÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114117', '42198437', 'cfernandez@isa.cl', 'A', '05', '2021-02-06 19:47:06', '2021-02-06 19:47:06');
INSERT INTO `clients` VALUES (100, '171852485', 'FERREIRO FRANCIS', 'REVECO MONICAÿ', 'Duran,cdl las peregirnas av los rosales por quinta etapa', '968114118', '42198437', 'francis_nexos@hotmail.com', 'A', '05', '2021-02-06 19:47:06', '2021-02-06 19:47:06');

SET FOREIGN_KEY_CHECKS = 1;
