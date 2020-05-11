/*

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 50724
 Source Host           : localhost:3306
 Source Schema         : tinyshop

 Target Server Type    : MySQL
 Target Server Version : 50724
 File Encoding         : 65001

 Date: 11/05/2020 18:21:48
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `lastname` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES (1, 'john', 'doe', 'johndoe@somecomp.com', '21232f297a57a5a743894a0e4a801fc3');

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES (1, 'Mobiles');
INSERT INTO `category` VALUES (2, 'Cameras');
INSERT INTO `category` VALUES (3, 'Books');

-- ----------------------------
-- Table structure for config
-- ----------------------------
DROP TABLE IF EXISTS `config`;
CREATE TABLE `config`  (
  `company` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `firstname` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `lastname` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `address1` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `address2` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `city` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `state` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `country` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `zip` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `vat` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `shipping` decimal(10, 2) NULL DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of config
-- ----------------------------
INSERT INTO `config` VALUES ('my comp inc', 'john', 'doe', 'road map1', NULL, 'Tiruchirappalli', 'India', '', '12122', '', '3333', 10.00);

-- ----------------------------
-- Table structure for orderitems
-- ----------------------------
DROP TABLE IF EXISTS `orderitems`;
CREATE TABLE `orderitems`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `pquantity` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `orderid` int(11) NOT NULL,
  `productprice` decimal(10, 2) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of orderitems
-- ----------------------------
INSERT INTO `orderitems` VALUES (1, 19, '5', 1, 16.00);
INSERT INTO `orderitems` VALUES (2, 19, '5', 2, 16.00);
INSERT INTO `orderitems` VALUES (3, 1, '2', 2, 20990.00);
INSERT INTO `orderitems` VALUES (4, 1, '1', 3, 20990.00);
INSERT INTO `orderitems` VALUES (5, 20, '10', 3, 99.00);
INSERT INTO `orderitems` VALUES (6, 18, '1', 4, 12890.00);
INSERT INTO `orderitems` VALUES (7, 21, '1', 4, 75.00);
INSERT INTO `orderitems` VALUES (8, 2, '1', 5, 7590.00);
INSERT INTO `orderitems` VALUES (9, 19, '10', 5, 16.00);
INSERT INTO `orderitems` VALUES (10, 18, '1', 6, 12890.00);
INSERT INTO `orderitems` VALUES (11, 1, '1', 8, 20990.34);
INSERT INTO `orderitems` VALUES (12, 1, '1', 9, 20990.34);
INSERT INTO `orderitems` VALUES (13, 1, '1', 10, 20990.34);
INSERT INTO `orderitems` VALUES (14, 2, '1', 11, 7590.00);
INSERT INTO `orderitems` VALUES (15, 1, '1', 11, 20990.34);

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `totalprice` decimal(10, 2) NOT NULL,
  `orderstatus` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `paymentmode` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `timestamp` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of orders
-- ----------------------------
INSERT INTO `orders` VALUES (1, 2, 80.00, 'Order Placed', 'cod', '2017-10-28 12:22:36');
INSERT INTO `orders` VALUES (2, 2, 42060.00, 'Order Placed', 'cod', '2017-10-28 12:27:16');
INSERT INTO `orders` VALUES (3, 6, 21980.00, 'Cancelled', 'cod', '2017-10-28 14:25:23');
INSERT INTO `orders` VALUES (4, 6, 12965.00, 'In Progress', 'cod', '2017-10-28 14:28:29');
INSERT INTO `orders` VALUES (5, 6, 7750.00, 'In Progress', 'cod', '2017-11-06 19:40:34');
INSERT INTO `orders` VALUES (6, 7, 12890.00, 'In Progress', 'cod', '2020-05-08 12:16:14');
INSERT INTO `orders` VALUES (7, 34, 0.00, 'Order Placed', '', '2020-05-11 11:17:01');
INSERT INTO `orders` VALUES (8, 34, 20990.34, 'Cancelled', '', '2020-05-11 11:26:14');
INSERT INTO `orders` VALUES (9, 34, 20990.34, 'Order Placed', '', '2020-05-11 11:38:04');
INSERT INTO `orders` VALUES (10, 34, 20990.34, 'Order Placed', 'cod', '2020-05-11 11:58:21');
INSERT INTO `orders` VALUES (11, 34, 28580.34, 'Order Placed', 'cod', '2020-05-11 17:17:37');

-- ----------------------------
-- Table structure for ordertracking
-- ----------------------------
DROP TABLE IF EXISTS `ordertracking`;
CREATE TABLE `ordertracking`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderid` int(11) NOT NULL,
  `status` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `message` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `timestamp` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ordertracking
-- ----------------------------
INSERT INTO `ordertracking` VALUES (3, 3, 'Cancelled', ' I don&#39;t want this item now.', '2017-10-28 17:54:18');
INSERT INTO `ordertracking` VALUES (5, 4, 'In Progress', ' Order is in Progress', '2017-10-30 13:31:08');
INSERT INTO `ordertracking` VALUES (6, 5, 'In Progress', ' Order is in Progress', '2017-11-06 19:45:11');
INSERT INTO `ordertracking` VALUES (7, 6, 'In Progress', ' ', '2020-05-09 17:07:21');
INSERT INTO `ordertracking` VALUES (8, 6, 'Delivered', ' ', '2020-05-09 17:07:32');
INSERT INTO `ordertracking` VALUES (9, 6, 'In Progress', ' ', '2020-05-10 15:33:08');
INSERT INTO `ordertracking` VALUES (10, 6, 'Dispatched', ' ', '2020-05-10 15:33:17');
INSERT INTO `ordertracking` VALUES (11, 6, 'In Progress', ' ', '2020-05-10 15:52:32');
INSERT INTO `ordertracking` VALUES (12, 8, 'Cancelled', ' ', '2020-05-11 11:26:31');

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `catid` int(11) NOT NULL,
  `price` decimal(10, 2) NOT NULL,
  `thumb` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `description` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 22 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES (1, 'Canon EOS 1300D 18MP Digital SLR Camera (Black) with 18-55mm ISII Lens, 16GB Card and Carry Case', 2, 20990.34, 'uploads/Canon EOS 200D 24 2MP.jpg', 'The EOS 1300D packs in all the fun of photography, which is why we recommend it to users looking for their very first EOS DSLR camera. It uses an 18-megapixel APS-C size sensor and the DIGIC 4+ image processor');
INSERT INTO `products` VALUES (2, 'Sony DSC W830 Cyber-shot 20.1 MP Point and Shoot Camera (Black) with 8x Optical Zoom, Memory Card and Camera Case', 2, 7590.00, 'uploads/Sony Alpha a6000 Mirrorless Digital.jpg', 'The Sony DSC W830 Cyber-shot 20.1 MP Point and Shoot Camera (Black) with 8x Optical Zoom is a powerful camera full of features that put it at par with any professional DSLR. It is packed with a super HAD CCD sensor that comes with 20.1 effective megapixel');
INSERT INTO `products` VALUES (18, 'Sony Cyber-shot DSC-H300/BC E32 point & Shoot Digital camera ', 2, 12890.00, 'uploads/Sony Alpha ILCA-77M2Q 24 3MP.jpg', 'The High zoom camera Sony Cyber-shot H300, with a powerful 35x optical zoom, brings your subject to you for beautiful, precise pictures. A 20.1MP sensor, HD video and creative features, let you capture detailed images and movies with ease. A DSLR-style bo');
INSERT INTO `products` VALUES (19, 'General Knowledge 2018', 3, 16.00, 'uploads/General Knowledge 2018.jpg', 'An editorial team of highly skilled professionals at Arihant, works hand in glove to ensure that the students receive the best and accurate content through our books. From inception till the book comes out from print, the whole team comprising of authors,');
INSERT INTO `products` VALUES (20, 'The Power of your Subconscious Mind', 3, 99.00, 'uploads/The Power of your Subconscious Mind.jpg', 'It\'s a very good n very useful book n it should be read by each n every one ...to knw the things that are not aware and know about the mind power .. Super duper book --ByAmazon Customeron 19 March 2017');
INSERT INTO `products` VALUES (21, 'Think and Grow Rich', 3, 75.00, 'uploads/Think and Grow Rich.jpg', 'An American journalist, lecturer and author, Napoleon Hill is one of the earliest producers of \'personal-success literature . As an author of self-help books, Hill has always abided by and promoted principle of intense and burning passion being the sole k');

-- ----------------------------
-- Table structure for reviews
-- ----------------------------
DROP TABLE IF EXISTS `reviews`;
CREATE TABLE `reviews`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `review` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `timestamp` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of reviews
-- ----------------------------
INSERT INTO `reviews` VALUES (1, 1, 6, 'It&#39;s an awesome Product...', '2017-10-30 15:18:42');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `timestamp` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `email`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 35 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'sunny@somecomp.com', '21232f297a57a5a743894a0e4a801fc3', '2017-10-27 12:05:10');
INSERT INTO `users` VALUES (2, 'mary@somecomp.com', '$2y$10$cMzHNUFGKma96MywHmVMbekuJZb1tSNLsevHzLnSRbcRicQVhEC6a', '2017-10-27 12:24:25');
INSERT INTO `users` VALUES (6, 'frank@somecomp.com', '$2y$10$apI7l.1wAS5pgbG4YfMrN.jNd5T3XmhecFuSV2M6UNdoUHImPXNxm', '2017-10-27 12:28:20');

-- ----------------------------
-- Table structure for usersmeta
-- ----------------------------
DROP TABLE IF EXISTS `usersmeta`;
CREATE TABLE `usersmeta`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `firstname` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `lastname` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `company` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `address1` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `address2` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `city` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `state` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `country` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `zip` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of usersmeta
-- ----------------------------
INSERT INTO `usersmeta` VALUES (1, 2, 'Mary', 'Mary', 'some comp', 'main street 2', '', 'tiruchirappalli', 'India', 'India', '234521', '');
INSERT INTO `usersmeta` VALUES (2, 6, 'Frank', 'Frank', 'some comp', 'main street 3', '', 'tiruchirappalli', 'India', 'India', '234521', '9876543211');
INSERT INTO `usersmeta` VALUES (3, 1, 'Sunny', 'Sunny', 'some comp', 'main street 1', '', 'tiruchirappalli', 'India', 'India', '234521', '');

-- ----------------------------
-- Table structure for wishlist
-- ----------------------------
DROP TABLE IF EXISTS `wishlist`;
CREATE TABLE `wishlist`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `timestamp` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
