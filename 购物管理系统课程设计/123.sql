/*
 Navicat Premium Data Transfer

 Source Server         : bthost
 Source Server Type    : MySQL
 Source Server Version : 50726 (5.7.26)
 Source Host           : localhost:3306
 Source Schema         : 123

 Target Server Type    : MySQL
 Target Server Version : 50726 (5.7.26)
 File Encoding         : 65001

 Date: 06/07/2023 12:18:51
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for cart
-- ----------------------------
DROP TABLE IF EXISTS `cart`;
CREATE TABLE `cart`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `username`(`username`) USING BTREE,
  INDEX `product_id`(`product_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 65 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cart
-- ----------------------------

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 21 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES (1, '服装', '2023-07-04 19:42:10', '2023-07-04 19:42:10');
INSERT INTO `categories` VALUES (2, '鞋类', '2023-07-04 19:42:10', '2023-07-04 19:42:10');
INSERT INTO `categories` VALUES (3, '配饰', '2023-07-04 19:42:10', '2023-07-04 19:42:10');
INSERT INTO `categories` VALUES (4, '美妆', '2023-07-04 19:42:10', '2023-07-04 19:42:10');
INSERT INTO `categories` VALUES (5, '家居用品', '2023-07-04 19:42:10', '2023-07-04 19:42:10');
INSERT INTO `categories` VALUES (6, '家具', '2023-07-04 19:42:10', '2023-07-04 19:42:10');
INSERT INTO `categories` VALUES (7, '电子产品', '2023-07-04 19:42:10', '2023-07-04 19:42:10');
INSERT INTO `categories` VALUES (8, '图书', '2023-07-04 19:42:10', '2023-07-04 19:42:10');
INSERT INTO `categories` VALUES (9, '玩具', '2023-07-04 19:42:10', '2023-07-04 19:42:10');
INSERT INTO `categories` VALUES (10, '运动用品', '2023-07-04 19:42:10', '2023-07-04 19:42:10');
INSERT INTO `categories` VALUES (11, '宠物用品', '2023-07-04 19:42:10', '2023-07-04 19:42:10');
INSERT INTO `categories` VALUES (12, '食品与饮料', '2023-07-04 19:42:10', '2023-07-04 19:42:10');
INSERT INTO `categories` VALUES (13, '健康与保健品', '2023-07-04 19:42:10', '2023-07-04 19:42:10');
INSERT INTO `categories` VALUES (14, '家用电器', '2023-07-04 19:42:10', '2023-07-04 19:42:10');
INSERT INTO `categories` VALUES (15, '珠宝与手表', '2023-07-04 19:42:10', '2023-07-04 19:42:10');
INSERT INTO `categories` VALUES (16, '汽车及配件', '2023-07-04 19:42:10', '2023-07-04 19:42:10');
INSERT INTO `categories` VALUES (17, '手工艺品', '2023-07-04 19:42:10', '2023-07-04 19:42:10');
INSERT INTO `categories` VALUES (18, '礼品与节庆用品', '2023-07-04 19:42:10', '2023-07-04 19:42:10');
INSERT INTO `categories` VALUES (19, '照相机与摄影设备', '2023-07-04 19:42:10', '2023-07-04 19:42:10');
INSERT INTO `categories` VALUES (20, '孕婴童用品', '2023-07-04 19:42:10', '2023-07-04 19:42:10');

-- ----------------------------
-- Table structure for order_details
-- ----------------------------
DROP TABLE IF EXISTS `order_details`;
CREATE TABLE `order_details`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NULL DEFAULT NULL,
  `product_id` int(11) NULL DEFAULT NULL,
  `product_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `price` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `quantity` int(11) NULL DEFAULT NULL,
  `Cancelled` int(11) NULL DEFAULT 0,
  `Checked` int(11) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `order_id`(`order_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 18 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of order_details
-- ----------------------------
INSERT INTO `order_details` VALUES (1, 2, 41, '益智拼图', '29.99', 1, 1, 0);
INSERT INTO `order_details` VALUES (2, 2, 13, '手链', '79.99', 1, 1, 1);
INSERT INTO `order_details` VALUES (3, 2, 15, '帽子', '39.99', 1, 1, 0);
INSERT INTO `order_details` VALUES (4, 2, 62, '保健茶', '29.99', 1, 1, 0);
INSERT INTO `order_details` VALUES (5, 4, 16, '口红', '89.99', 1, 1, 0);
INSERT INTO `order_details` VALUES (6, 4, 11, '手表', '299.99', 1, 1, 0);
INSERT INTO `order_details` VALUES (7, 4, 9, '靴子', '179.99', 1, 0, 1);
INSERT INTO `order_details` VALUES (8, 6, 13, '手链', '79.99', 1, 1, 1);
INSERT INTO `order_details` VALUES (9, 8, 17, '粉底液', '119.99', 1, 1, 1);
INSERT INTO `order_details` VALUES (10, 10, 28, '床', '1499.99', 1, 0, 1);
INSERT INTO `order_details` VALUES (11, 12, 31, '手机', '1999.99', 1, 1, 0);
INSERT INTO `order_details` VALUES (12, 14, 30, '电视柜', '599.99', 1, 1, 0);
INSERT INTO `order_details` VALUES (13, 16, 20, '腮红', '39.99', 1, 1, 0);
INSERT INTO `order_details` VALUES (14, 18, 27, '餐桌椅套装', '699.99', 1, 1, 0);
INSERT INTO `order_details` VALUES (15, 20, 14, '耳环', '59.99', 1, 1, 0);
INSERT INTO `order_details` VALUES (16, 20, 12, '项链', '129.99', 1, 0, 1);
INSERT INTO `order_details` VALUES (17, 24, 28, '床', '1499.99', 1, 0, 2);

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `order_date` datetime NULL DEFAULT CURRENT_TIMESTAMP,
  `order_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `username`(`username`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 25 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of orders
-- ----------------------------
INSERT INTO `orders` VALUES (1, 'zczxcasd', '2023-07-06 02:25:12', NULL);
INSERT INTO `orders` VALUES (2, 'zczxcasd', '2023-07-06 02:25:12', 2);
INSERT INTO `orders` VALUES (3, 'zczxcasd', '2023-07-06 10:45:28', NULL);
INSERT INTO `orders` VALUES (4, 'zczxcasd', '2023-07-06 10:45:28', 4);
INSERT INTO `orders` VALUES (5, 'zczxcasd', '2023-07-06 10:47:06', NULL);
INSERT INTO `orders` VALUES (6, 'zczxcasd', '2023-07-06 10:47:06', 6);
INSERT INTO `orders` VALUES (7, 'zczxcasd', '2023-07-06 10:48:04', NULL);
INSERT INTO `orders` VALUES (8, 'zczxcasd', '2023-07-06 10:48:04', 8);
INSERT INTO `orders` VALUES (9, 'zczxcasd', '2023-07-06 10:49:02', NULL);
INSERT INTO `orders` VALUES (10, 'zczxcasd', '2023-07-06 10:49:02', 10);
INSERT INTO `orders` VALUES (11, 'zczxcasd', '2023-07-06 10:49:21', NULL);
INSERT INTO `orders` VALUES (12, 'zczxcasd', '2023-07-06 10:49:21', 12);
INSERT INTO `orders` VALUES (13, 'zczxcasd', '2023-07-06 10:49:34', NULL);
INSERT INTO `orders` VALUES (14, 'zczxcasd', '2023-07-06 10:49:34', 14);
INSERT INTO `orders` VALUES (15, 'zczxcasd', '2023-07-06 10:50:29', NULL);
INSERT INTO `orders` VALUES (16, 'zczxcasd', '2023-07-06 10:50:29', 16);
INSERT INTO `orders` VALUES (17, 'zczxcasd', '2023-07-06 10:50:55', NULL);
INSERT INTO `orders` VALUES (18, 'zczxcasd', '2023-07-06 10:50:55', 18);
INSERT INTO `orders` VALUES (19, 'test1234', '2023-07-06 11:49:44', NULL);
INSERT INTO `orders` VALUES (20, 'test1234', '2023-07-06 11:49:44', 20);
INSERT INTO `orders` VALUES (21, 'test1234', '2023-07-06 11:49:52', NULL);
INSERT INTO `orders` VALUES (23, 'test1234', '2023-07-06 11:56:02', NULL);
INSERT INTO `orders` VALUES (24, 'test1234', '2023-07-06 11:56:02', 24);

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `price` float NOT NULL,
  `category_id` int(11) NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `category_id`(`category_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 101 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES (1, '时尚T恤', '舒适时尚的短袖T恤', 44, 1, '2023-07-04 22:34:55', '2023-07-06 12:01:12');
INSERT INTO `products` VALUES (2, '牛仔裤', '经典款式的牛仔裤', 79.99, 1, '2023-07-04 22:34:55', '2023-07-04 22:34:55');
INSERT INTO `products` VALUES (3, '连衣裙', '优雅迷人的连衣裙', 123.99, 1, '2023-07-04 22:34:55', '2023-07-06 12:12:12');
INSERT INTO `products` VALUES (4, '夹克外套', '时尚保暖的夹克外套', 99.99, 1, '2023-07-04 22:34:55', '2023-07-04 22:34:55');
INSERT INTO `products` VALUES (5, '运动鞋', '舒适耐穿的运动鞋', 149.99, 1, '2023-07-04 22:34:55', '2023-07-04 22:34:55');
INSERT INTO `products` VALUES (6, '运动鞋', '适合运动和休闲的鞋子', 199.99, 2, '2023-07-04 22:34:55', '2023-07-04 22:34:55');
INSERT INTO `products` VALUES (7, '高跟鞋', '优雅迷人的高跟鞋', 159.99, 2, '2023-07-04 22:34:55', '2023-07-04 22:34:55');
INSERT INTO `products` VALUES (8, '凉鞋', '夏季清凉的凉鞋', 89.99, 2, '2023-07-04 22:34:55', '2023-07-04 22:34:55');
INSERT INTO `products` VALUES (9, '靴子', '时尚实用的靴子', 179.99, 2, '2023-07-04 22:34:55', '2023-07-04 22:34:55');
INSERT INTO `products` VALUES (10, '帆布鞋', '休闲潮流的帆布鞋', 69.99, 2, '2023-07-04 22:34:55', '2023-07-04 22:34:55');
INSERT INTO `products` VALUES (11, '手表', '精美时尚的手表', 299.99, 3, '2023-07-04 22:34:55', '2023-07-04 22:34:55');
INSERT INTO `products` VALUES (12, '项链', '亮丽夺目的项链', 129.99, 3, '2023-07-04 22:34:55', '2023-07-04 22:34:55');
INSERT INTO `products` VALUES (13, '手链', '个性时尚的手链', 79.99, 3, '2023-07-04 22:34:55', '2023-07-04 22:34:55');
INSERT INTO `products` VALUES (14, '耳环', '华丽迷人的耳环', 59.99, 3, '2023-07-04 22:34:55', '2023-07-04 22:34:55');
INSERT INTO `products` VALUES (15, '帽子', '时尚百搭的帽子', 39.99, 3, '2023-07-04 22:34:55', '2023-07-04 22:34:55');
INSERT INTO `products` VALUES (16, '口红', '色彩鲜艳的口红', 89.99, 4, '2023-07-04 22:34:55', '2023-07-04 22:34:55');
INSERT INTO `products` VALUES (17, '粉底液', '自然遮瑕的粉底液', 119.99, 4, '2023-07-04 22:34:55', '2023-07-04 22:34:55');
INSERT INTO `products` VALUES (18, '眼影盘', '多色可选的眼影盘', 69.99, 4, '2023-07-04 22:34:55', '2023-07-04 22:34:55');
INSERT INTO `products` VALUES (19, '睫毛膏', '浓密卷翘的睫毛膏', 49.99, 4, '2023-07-04 22:34:55', '2023-07-04 22:34:55');
INSERT INTO `products` VALUES (20, '腮红', '提亮修饰的腮红', 39.99, 4, '2023-07-04 22:34:55', '2023-07-04 22:34:55');
INSERT INTO `products` VALUES (21, '床上四件套', '舒适柔软的床上用品', 199.99, 5, '2023-07-04 22:35:09', '2023-07-04 22:35:09');
INSERT INTO `products` VALUES (22, '抱枕', '可爱温馨的抱枕', 39.99, 5, '2023-07-04 22:35:09', '2023-07-04 22:35:09');
INSERT INTO `products` VALUES (23, '毛毯', '保暖柔软的毛毯', 79.99, 5, '2023-07-04 22:35:09', '2023-07-04 22:35:09');
INSERT INTO `products` VALUES (24, '浴室用品套装', '实用美观的浴室用品套装', 129.99, 5, '2023-07-04 22:35:09', '2023-07-04 22:35:09');
INSERT INTO `products` VALUES (25, '装饰画', '独特艺术的装饰画', 59.99, 5, '2023-07-04 22:35:09', '2023-07-04 22:35:09');
INSERT INTO `products` VALUES (26, '沙发', '舒适时尚的沙发', 999.99, 6, '2023-07-04 22:35:09', '2023-07-04 22:35:09');
INSERT INTO `products` VALUES (27, '餐桌椅套装', '实用美观的餐桌椅套装', 699.99, 6, '2023-07-04 22:35:09', '2023-07-04 22:35:09');
INSERT INTO `products` VALUES (28, '床', '舒适实用的床', 1499.99, 6, '2023-07-04 22:35:09', '2023-07-04 22:35:09');
INSERT INTO `products` VALUES (29, '书架', '简约实用的书架', 399.99, 6, '2023-07-04 22:35:09', '2023-07-04 22:35:09');
INSERT INTO `products` VALUES (30, '电视柜', '现代风格的电视柜', 599.99, 6, '2023-07-04 22:35:09', '2023-07-04 22:35:09');
INSERT INTO `products` VALUES (31, '手机', '功能强大的智能手机', 1999.99, 7, '2023-07-04 22:35:09', '2023-07-04 22:35:09');
INSERT INTO `products` VALUES (32, '笔记本电脑', '高性能的笔记本电脑', 2999.99, 7, '2023-07-04 22:35:09', '2023-07-04 22:35:09');
INSERT INTO `products` VALUES (33, '平板电脑', '轻便便携的平板电脑', 1499.99, 7, '2023-07-04 22:35:09', '2023-07-04 22:35:09');
INSERT INTO `products` VALUES (34, '耳机', '高品质的音质耳机', 199.99, 7, '2023-07-04 22:35:09', '2023-07-04 22:35:09');
INSERT INTO `products` VALUES (35, '智能手表', '多功能的智能手表', 599.99, 7, '2023-07-04 22:35:09', '2023-07-04 22:35:09');
INSERT INTO `products` VALUES (36, '小说', '畅销好书的小说类别', 59.99, 8, '2023-07-04 22:35:09', '2023-07-04 22:35:09');
INSERT INTO `products` VALUES (37, '科普读物', '有趣的科普读物', 79.99, 8, '2023-07-04 22:35:09', '2023-07-04 22:35:09');
INSERT INTO `products` VALUES (38, '教育书籍', '提升知识的教育书籍', 89.99, 8, '2023-07-04 22:35:09', '2023-07-04 22:35:09');
INSERT INTO `products` VALUES (39, '历史书籍', '了解历史的历史书籍', 69.99, 8, '2023-07-04 22:35:09', '2023-07-04 22:35:09');
INSERT INTO `products` VALUES (40, '杂志', '丰富多彩的杂志期刊', 29.99, 8, '2023-07-04 22:35:09', '2023-07-04 22:35:09');
INSERT INTO `products` VALUES (41, '益智拼图', '培养思维能力的益智拼图', 29.99, 9, '2023-07-04 22:35:14', '2023-07-04 22:35:14');
INSERT INTO `products` VALUES (42, '遥控车', '远距离遥控的小车', 59.99, 9, '2023-07-04 22:35:14', '2023-07-04 22:35:14');
INSERT INTO `products` VALUES (43, '积木', '创意组合的积木玩具', 19.99, 9, '2023-07-04 22:35:14', '2023-07-04 22:35:14');
INSERT INTO `products` VALUES (44, '娃娃', '可爱逗趣的娃娃', 39.99, 9, '2023-07-04 22:35:14', '2023-07-04 22:35:14');
INSERT INTO `products` VALUES (45, '玩具枪', '模拟战斗的玩具枪', 49.99, 9, '2023-07-04 22:35:14', '2023-07-04 22:35:14');
INSERT INTO `products` VALUES (46, '篮球', '耐用的篮球', 29.99, 10, '2023-07-04 22:35:14', '2023-07-04 22:35:14');
INSERT INTO `products` VALUES (47, '跑步鞋', '舒适透气的跑步鞋', 79.99, 10, '2023-07-04 22:35:14', '2023-07-04 22:35:14');
INSERT INTO `products` VALUES (48, '瑜伽垫', '舒适防滑的瑜伽垫', 49.99, 10, '2023-07-04 22:35:14', '2023-07-04 22:35:14');
INSERT INTO `products` VALUES (49, '健身器材套装', '全面锻炼的健身器材套装', 199.99, 10, '2023-07-04 22:35:14', '2023-07-04 22:35:14');
INSERT INTO `products` VALUES (50, '自行车', '轻便实用的自行车', 399.99, 10, '2023-07-04 22:35:14', '2023-07-04 22:35:14');
INSERT INTO `products` VALUES (51, '宠物食品', '营养均衡的宠物食品', 19.99, 11, '2023-07-04 22:35:14', '2023-07-04 22:35:14');
INSERT INTO `products` VALUES (52, '宠物窝', '舒适温暖的宠物窝', 39.99, 11, '2023-07-04 22:35:14', '2023-07-04 22:35:14');
INSERT INTO `products` VALUES (53, '狗狗项圈', '时尚可爱的狗狗项圈', 9.99, 11, '2023-07-04 22:35:14', '2023-07-04 22:35:14');
INSERT INTO `products` VALUES (54, '猫砂盆', '方便清洁的猫砂盆', 29.99, 11, '2023-07-04 22:35:14', '2023-07-04 22:35:14');
INSERT INTO `products` VALUES (55, '宠物玩具', '娱乐消遣的宠物玩具', 14.99, 11, '2023-07-04 22:35:14', '2023-07-04 22:35:14');
INSERT INTO `products` VALUES (56, '巧克力', '口感浓郁的巧克力', 9.99, 12, '2023-07-04 22:35:14', '2023-07-04 22:35:14');
INSERT INTO `products` VALUES (57, '咖啡', '香醇浓郁的咖啡', 19.99, 12, '2023-07-04 22:35:14', '2023-07-04 22:35:14');
INSERT INTO `products` VALUES (58, '红酒', '优质红酒', 49.99, 12, '2023-07-04 22:35:14', '2023-07-04 22:35:14');
INSERT INTO `products` VALUES (59, '茶叶', '清香醇厚的茶叶', 29.99, 12, '2023-07-04 22:35:14', '2023-07-04 22:35:14');
INSERT INTO `products` VALUES (60, '饼干', '美味可口的饼干', 14.99, 12, '2023-07-04 22:35:14', '2023-07-04 22:35:14');
INSERT INTO `products` VALUES (61, '维生素片', '补充营养的维生素片', 19.99, 13, '2023-07-04 22:38:17', '2023-07-04 22:38:17');
INSERT INTO `products` VALUES (62, '保健茶', '滋补养生的保健茶', 29.99, 13, '2023-07-04 22:38:17', '2023-07-04 22:38:17');
INSERT INTO `products` VALUES (63, '蛋白粉', '增肌健身的蛋白粉', 39.99, 13, '2023-07-04 22:38:17', '2023-07-04 22:38:17');
INSERT INTO `products` VALUES (64, '减肥瘦身产品', '帮助减肥瘦身的产品', 49.99, 13, '2023-07-04 22:38:17', '2023-07-04 22:38:17');
INSERT INTO `products` VALUES (65, '保健食品套装', '全面调理身体的保健食品套装', 99.99, 13, '2023-07-04 22:38:17', '2023-07-04 22:38:17');
INSERT INTO `products` VALUES (66, '洗衣机', '高效洗涤的洗衣机', 999.99, 14, '2023-07-04 22:38:17', '2023-07-04 22:38:17');
INSERT INTO `products` VALUES (67, '冰箱', '保鲜储存的冰箱', 1499.99, 14, '2023-07-04 22:38:17', '2023-07-04 22:38:17');
INSERT INTO `products` VALUES (68, '电视', '高清晰画质的电视', 799.99, 14, '2023-07-04 22:38:17', '2023-07-04 22:38:17');
INSERT INTO `products` VALUES (69, '空调', '舒适温度的空调', 1999.99, 14, '2023-07-04 22:38:17', '2023-07-04 22:38:17');
INSERT INTO `products` VALUES (70, '电风扇', '清凉舒爽的电风扇', 59.99, 14, '2023-07-04 22:38:17', '2023-07-04 22:38:17');
INSERT INTO `products` VALUES (71, '钻石项链', '豪华典雅的钻石项链', 9999.99, 15, '2023-07-04 22:38:17', '2023-07-04 22:38:17');
INSERT INTO `products` VALUES (72, '黄金手镯', '高质量的黄金手镯', 3999.99, 15, '2023-07-04 22:38:17', '2023-07-04 22:38:17');
INSERT INTO `products` VALUES (73, '银饰耳环', '精致别致的银饰耳环', 299.99, 15, '2023-07-04 22:38:17', '2023-07-04 22:38:17');
INSERT INTO `products` VALUES (74, '石英手表', '精准时尚的石英手表', 199.99, 15, '2023-07-04 22:38:17', '2023-07-04 22:38:17');
INSERT INTO `products` VALUES (75, '珍珠项链', '优雅精致的珍珠项链', 699.99, 15, '2023-07-04 22:38:17', '2023-07-04 22:38:17');
INSERT INTO `products` VALUES (76, '轿车', '豪华品牌的轿车', 20000, 16, '2023-07-04 22:38:17', '2023-07-04 22:38:17');
INSERT INTO `products` VALUES (77, '汽车轮胎', '耐磨耐用的汽车轮胎', 199.99, 16, '2023-07-04 22:38:17', '2023-07-04 22:38:17');
INSERT INTO `products` VALUES (78, '汽车脚垫', '舒适防滑的汽车脚垫', 59.99, 16, '2023-07-04 22:38:17', '2023-07-04 22:38:17');
INSERT INTO `products` VALUES (79, '车载导航仪', '实用便捷的车载导航仪', 399.99, 16, '2023-07-04 22:38:17', '2023-07-04 22:38:17');
INSERT INTO `products` VALUES (80, '汽车坐垫', '舒适美观的汽车坐垫', 99.99, 16, '2023-07-04 22:38:17', '2023-07-04 22:38:17');
INSERT INTO `products` VALUES (81, '陶瓷花瓶', '精美细腻的陶瓷花瓶', 59.99, 17, '2023-07-04 22:38:17', '2023-07-04 22:38:17');
INSERT INTO `products` VALUES (82, '手工绣品', '精致独特的手工绣品', 39.99, 17, '2023-07-04 22:38:17', '2023-07-04 22:38:17');
INSERT INTO `products` VALUES (83, '木质摆件', '自然环保的木质摆件', 29.99, 17, '2023-07-04 22:38:17', '2023-07-04 22:38:17');
INSERT INTO `products` VALUES (84, '刺绣画', '细腻精美的刺绣画', 49.99, 17, '2023-07-04 22:38:17', '2023-07-04 22:38:17');
INSERT INTO `products` VALUES (85, '漆器饰品', '典雅华丽的漆器饰品', 79.99, 17, '2023-07-04 22:38:17', '2023-07-04 22:38:17');
INSERT INTO `products` VALUES (86, '生日礼物', '温馨贴心的生日礼物', 19.99, 18, '2023-07-04 22:38:17', '2023-07-04 22:38:17');
INSERT INTO `products` VALUES (87, '节日装饰', '热闹喜庆的节日装饰', 29.99, 18, '2023-07-04 22:38:17', '2023-07-04 22:38:17');
INSERT INTO `products` VALUES (88, '派对用品', '欢乐活泼的派对用品', 39.99, 18, '2023-07-04 22:38:17', '2023-07-04 22:38:17');
INSERT INTO `products` VALUES (89, '结婚礼品', '浪漫精美的结婚礼品', 49.99, 18, '2023-07-04 22:38:17', '2023-07-04 22:38:17');
INSERT INTO `products` VALUES (90, '纪念品', '珍贵回忆的纪念品', 9.99, 18, '2023-07-04 22:38:17', '2023-07-04 22:38:17');
INSERT INTO `products` VALUES (91, '数码相机', '高清晰度的数码相机', 699.99, 19, '2023-07-04 22:38:17', '2023-07-04 22:38:17');
INSERT INTO `products` VALUES (92, '摄影镜头', '清晰锐利的摄影镜头', 499.99, 19, '2023-07-04 22:38:17', '2023-07-04 22:38:17');
INSERT INTO `products` VALUES (93, '三脚架', '稳定支撑的摄影三脚架', 99.99, 19, '2023-07-04 22:38:17', '2023-07-04 22:38:17');
INSERT INTO `products` VALUES (94, '相机包', '防震防水的相机包', 59.99, 19, '2023-07-04 22:38:17', '2023-07-04 22:38:17');
INSERT INTO `products` VALUES (95, '摄影灯光', '明亮柔和的摄影灯光', 199.99, 19, '2023-07-04 22:38:17', '2023-07-04 22:38:17');
INSERT INTO `products` VALUES (96, '婴儿床', '舒适安全的婴儿床', 399.99, 20, '2023-07-04 22:38:17', '2023-07-04 22:38:17');
INSERT INTO `products` VALUES (97, '婴儿推车', '便捷轻巧的婴儿推车', 299.99, 20, '2023-07-04 22:38:17', '2023-07-04 22:38:17');
INSERT INTO `products` VALUES (98, '婴儿尿布', '柔软舒适的婴儿尿布', 19.99, 20, '2023-07-04 22:38:17', '2023-07-04 22:38:17');
INSERT INTO `products` VALUES (99, '儿童玩具', '寓教于乐的儿童玩具', 39.99, 20, '2023-07-04 22:38:17', '2023-07-04 22:38:17');
INSERT INTO `products` VALUES (100, '时尚T恤', '舒适时尚的短袖T恤', 59, 20, '2023-07-04 22:38:17', '2023-07-05 00:22:22');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 14 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (4, 'root', '$2y$10$tE9X8PhLopeVQnxFa0CYheFfaC8v7MBO3QYSF3QnHofZ76YxlPySu', '2023-07-04 22:25:57', '2023-07-04 22:25:57');
INSERT INTO `users` VALUES (2, 'asdf', '$2y$10$BFxEdySM9pweSoWB8blLSeDtpx3CASbjqzVXbwDA15vP0mL6Dcpem', '2023-07-04 22:24:30', '2023-07-05 11:42:54');
INSERT INTO `users` VALUES (3, 'qwe', '$2y$10$QMo30xvj3c2lN.jf7iPeM.cZWCowA0Xll7o4do9TQxKYw4PgqD8pW', '2023-07-04 22:25:25', '2023-07-05 12:04:29');
INSERT INTO `users` VALUES (5, 'admin', '$2y$10$EXopgwCsM.3sNCC.Fz9Pcu5IUS1U2BGbO7yKlAjIplS.avTu14cbC', '2023-07-04 22:26:04', '2023-07-04 22:26:04');
INSERT INTO `users` VALUES (6, '123', '$2y$10$GzYzv8ycAgSYSUebI1c5X.DAn8Zv9qOhJLX2IHlvWtmgwfijqx96S', '2023-07-05 20:59:43', '2023-07-05 20:59:43');
INSERT INTO `users` VALUES (7, 'qweqwe123', '$2y$10$UmwR4FcniZCB/pc3/L4yPenG4npAZhw/CSBX1gqQOTJLYyW8hRMdu', '2023-07-05 21:03:13', '2023-07-05 21:03:13');
INSERT INTO `users` VALUES (8, 'qwerasdf', '$2y$10$zEZRb502RtddauLPCwW2yuce3o8qIItaPSgvX02AfK45ettfvAE9W', '2023-07-05 21:37:23', '2023-07-06 12:13:25');
INSERT INTO `users` VALUES (9, 'qewrasdf', '$2y$10$s7DmK0UvP7xdgicvGqBo3.Aprery6IPVqgbZRZ8Mlm/Gf82AYUB8e', '2023-07-05 22:14:36', '2023-07-05 22:14:36');
INSERT INTO `users` VALUES (10, 'qweasd', '$2y$10$n.VZX95Aub4Ycbh1HuVZLuSaJ7BmzYYFMLzUDQevRdSnUg5ijSi9C', '2023-07-05 22:15:28', '2023-07-05 22:15:28');
INSERT INTO `users` VALUES (11, 'asdzxcvasdf', '$2y$10$g0EWLkNcpAQgKszaz2Y9bOEY6MKDg/Cdr5XVxYMSJRI33naKhYCzO', '2023-07-05 22:17:29', '2023-07-05 22:17:29');
INSERT INTO `users` VALUES (12, 'zczxcasd', '$2y$10$RD5GZOEwaSbZO3rFTTusCOdhsYMLs3Qs.D51HgzVrzx6Gpl/v.vkS', '2023-07-05 22:18:38', '2023-07-05 22:18:38');
INSERT INTO `users` VALUES (13, 'test1234', '$2y$10$Z2PMTD9S9lBxsbA/h0W81.hzKueBqbjEJdNKh491H/J53aOFym1uu', '2023-07-06 11:48:21', '2023-07-06 11:48:21');

SET FOREIGN_KEY_CHECKS = 1;
