/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50714
Source Host           : 127.0.0.1:3306
Source Database       : goods_crm_wap

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2018-11-16 18:11:30
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for syc_auth_group
-- ----------------------------
DROP TABLE IF EXISTS `syc_auth_group`;
CREATE TABLE `syc_auth_group` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL DEFAULT '',
  `status` tinyint(1) unsigned DEFAULT '1',
  `time` int(10) unsigned DEFAULT '0',
  `rule_pids` varchar(500) DEFAULT '',
  `rules` varchar(3000) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of syc_auth_group
-- ----------------------------
INSERT INTO `syc_auth_group` VALUES ('16', '超级管理员', '1', '1501687648', '177,205,215,218,221,226,229,232,235,244', '164,180,181,182,183,184,185,186,187,246,247,188,189,190,191,192,193,194,195,196,197,198,199,200,201,202,203,204,206,207,208,209,210,211,254,255,294,212,213,242,248,249,250,214,251,252,253,216,217,258,259,260,261,292,219,220,256,257,296,297,298,299,222,223,262,263,264,265,266,267,268,224,225,227,228,269,270,271,293,300,230,231,272,273,274,275,276,233,277,278,234,279,236,237,280,281,282,283,284,285,286,238,239,287,288,289,290,291,240,241,245');
INSERT INTO `syc_auth_group` VALUES ('14', '普通管理员', '1', '1501686282', '177,205,215,218,221,226,229,232,235,244', '164,180,181,182,183,184,185,186,187,246,247,188,189,190,191,192,193,194,195,196,197,198,199,200,201,202,203,204,206,207,208,209,210,211,254,255,294,212,213,242,248,249,250,214,251,252,253,216,217,258,259,260,261,292,219,220,256,257,296,297,298,299,222,223,262,263,264,265,266,267,268,224,225,227,228,269,270,271,293,230,231,272,273,274,275,276,233,277,278,234,279,236,237,280,281,282,283,284,285,286,238,239,287,288,289,290,291,240,241,245');
INSERT INTO `syc_auth_group` VALUES ('15', '商品发布专员', '1', '1501687218', '0', '');
INSERT INTO `syc_auth_group` VALUES ('17', '订单处理专员', '1', '1501687779', '123,125', '124,134');
INSERT INTO `syc_auth_group` VALUES ('19', '订单处理专员6ddd', '1', '1501687843', '164,138,113,168,123,125', '126,131,133,165,166,167,139,141,142,114,173,172,174,171,170,169,124,135,136,137,143,134');
INSERT INTO `syc_auth_group` VALUES ('23', '测试角色', '1', '0', '', '');

-- ----------------------------
-- Table structure for syc_auth_group_access
-- ----------------------------
DROP TABLE IF EXISTS `syc_auth_group_access`;
CREATE TABLE `syc_auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of syc_auth_group_access
-- ----------------------------
INSERT INTO `syc_auth_group_access` VALUES ('2', '16');
INSERT INTO `syc_auth_group_access` VALUES ('3', '14');
INSERT INTO `syc_auth_group_access` VALUES ('4', '16');
INSERT INTO `syc_auth_group_access` VALUES ('5', '16');
INSERT INTO `syc_auth_group_access` VALUES ('7', '17');

-- ----------------------------
-- Table structure for syc_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `syc_auth_rule`;
CREATE TABLE `syc_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `parentid` smallint(6) unsigned DEFAULT '0',
  `name` varchar(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `level` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `css` varchar(50) DEFAULT '',
  `sort` smallint(6) unsigned DEFAULT '0',
  `ismenu` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否显示左侧菜单',
  `condition` char(100) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=305 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of syc_auth_rule
-- ----------------------------
INSERT INTO `syc_auth_rule` VALUES ('177', '0', 'admin/system', '系统管理', '1', '1', '1', '', '2', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('164', '177', 'admin/config/index', '基本配置', '2', '1', '1', 'icon-ecs', '2', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('180', '177', 'admin/role/index', '角色管理', '2', '1', '1', 'icon-ecs', '31', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('181', '180', 'admin/role/add', '新增角色', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('182', '180', 'admin/role/edit', '修改角色', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('183', '180', 'admin/role/deleterole', '删除角色', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('184', '177', 'admin/users/index', '用户管理', '2', '1', '1', 'icon-ecs', '41', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('185', '184', 'admin/users/add', '新增用户', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('186', '184', 'admin/users/edit', '修改用户', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('187', '184', 'admin/users/delete', '删除用户', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('188', '177', 'admin/auth/index', '权限管理', '2', '1', '1', 'icon-ecs', '21', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('189', '188', 'admin/auth/rule_add', '添加节点', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('190', '188', 'admin/auth/node_status', '节点状态', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('191', '188', 'admin/auth/edit_node', '修改节点', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('192', '188', 'admin/auth/deletenode', '删除节点', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('193', '188', 'admin/auth/nodesort', '节点排序', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('194', '177', 'admin/goods/goods_type', '商品类型管理', '2', '1', '1', 'icon-ecs', '42', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('195', '194', 'admin/goods/add_type', '新增类型', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('196', '194', 'admin/goods/typeparams', '属性列表', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('197', '194', 'admin/goods/edit_attr', '修改属性', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('198', '194', 'admin/goods/deleteattr', '删除属性', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('199', '194', 'admin/goods/add_attr', '新增属性', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('200', '194', 'admin/goods/deletetype', '删除类型', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('201', '194', 'admin/goods/updatetypename', '编辑类型名称', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('202', '177', 'admin/params/index', '系统参数管理', '2', '1', '1', 'icon-ecs', '50', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('203', '202', 'admin/params/add', '新增参数', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('204', '202', 'admin/params/edit', '修改参数', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('205', '0', 'supplier/index', '供应商管理', '1', '1', '1', 'icon-ecs', '3', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('206', '205', 'admin/supplier/index', '供应商列表', '2', '1', '1', 'icon-ecs', '50', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('207', '206', 'admin/supplier/add', '新增供应商', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('208', '206', 'admin/supplier/view', '供应商详情', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('209', '206', 'admin/supplier/product', '产品列表', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('210', '206', 'admin/supplier/edit', '修改供应商', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('211', '206', 'admin/supplier/delete', '删除供应商', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('212', '205', 'admin/goods/index', '商品维护', '2', '1', '1', 'icon-ecs', '50', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('213', '212', 'admin/goods/index', '商品列表', '3', '1', '1', 'icon-ecs', '50', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('214', '212', 'admin/goods/category', '商品分类', '3', '1', '1', 'icon-ecs', '50', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('215', '0', 'admin/baojia', '报价管理', '1', '1', '1', 'icon-ecs', '5', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('216', '215', 'admin/baojia/index', '报价列表', '2', '1', '1', 'icon-ecs', '50', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('217', '216', 'admin/baojia/add', '新增报价单', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('218', '0', 'admin/cus', '客户管理', '1', '1', '1', 'icon-ecs', '4', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('219', '218', 'admin/customers/index', '客户信息', '2', '1', '1', 'icon-ecs', '50', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('220', '219', 'admin/customers/add', '新增客户', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('221', '0', 'admin/order', '订单管理', '1', '1', '1', 'icon-ecs', '6', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('222', '221', 'admin/order/index', '订单列表', '2', '1', '1', 'icon-ecs', '61', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('223', '222', 'admin/order/add', '新增订单', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('224', '221', 'admin/order/nodeliery', '未交货订单', '2', '1', '1', 'icon-ecs', '62', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('225', '221', 'admin/order/finish', '完成订单', '2', '1', '1', 'icon-ecs', '63', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('226', '0', 'admin/purchase', '采购管理', '1', '1', '1', 'icon-ecs', '7', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('227', '226', 'admin/purchase/index', '采购单', '2', '1', '1', 'icon-ecs', '50', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('228', '227', 'admin/purchase/add', '新增采购单', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('229', '0', 'admin/delivery', '送货管理', '1', '1', '1', 'icon-ecs', '8', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('230', '229', 'admin/delivery/index', '送货单', '2', '1', '1', 'icon-ecs', '50', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('231', '230', 'admin/delivery/add', '新增送货单', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('232', '0', 'admin/store', '库存管理', '1', '1', '1', 'icon-ecs', '9', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('233', '232', 'admin/store/relation', '商品库存', '2', '1', '1', 'icon-ecs', '50', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('234', '232', 'admin/store/index', '库存盘点', '2', '1', '1', 'icon-ecs', '50', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('235', '0', 'admin/account', '账务管理', '1', '1', '1', 'icon-ecs', '10', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('236', '235', 'admin/account/index', '应收账款', '2', '1', '1', 'icon-ecs', '50', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('237', '236', 'admin/account/newcreate', '新建应收账款', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('238', '235', 'admin/account/payment', '应付账款', '2', '1', '1', 'icon-ecs', '50', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('239', '238', 'admin/account/payment', '应付账款列表', '3', '1', '1', 'icon-ecs', '50', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('240', '238', 'admin/account/wait', '采购发票待处理', '3', '1', '1', 'icon-ecs', '50', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('241', '238', 'admin/account/create_payment', '创建对账单', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('242', '213', 'admin/goods/add', '新增商品', '4', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('244', '0', 'admin/index', '后台管理', '1', '1', '1', 'icon-ecs', '0', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('245', '244', 'admin/index/index', '后台首页', '2', '1', '1', 'icon-ecs', '1', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('246', '184', 'admin/users/user_do', '新增提交', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('247', '184', 'admin/users/update', '修改提交', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('248', '213', 'admin/goods/goodsinfo', '商品详情', '4', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('249', '213', 'admin/goods/goods_edit', '修改商品', '4', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('250', '213', 'admin/goods/goodsdel', '删除商品', '4', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('251', '214', 'admin/goods/addcategory', '新增分类', '4', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('252', '214', 'admin/goods/updatecategory', '修改分类', '4', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('253', '214', 'admin/goods/deletecategory', '删除分类', '4', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('254', '206', 'admin/supplier/add_contacts', '添加联系人', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('255', '206', 'admin/supplier/delete', '删除供应商', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('256', '219', 'admin/customers/view', '客户详情', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('257', '219', 'admin/customers/edit', '修改客户信息', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('258', '216', 'admin/baojia/info', '报价单详情', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('259', '216', 'admin/baojia/send', '发送邮件', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('260', '216', 'admin/baojia/edit', '修改报价单', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('261', '216', 'admin/baojia/delete', '删除报价单', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('262', '222', 'admin/order/info', '订单详情', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('263', '222', 'admin/order/cancel', '取消订单', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('264', '222', 'admin/order/confirm', '确认订单', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('265', '222', 'admin/order/setfinish', '设置完成订单', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('266', '222', 'admin/order/create', '订单创建采购单', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('267', '222', 'admin/order/edit', '修改订单', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('268', '222', 'admin/order/delete', '删除订单', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('269', '227', 'admin/purchase/info', '采购单详情', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('270', '227', 'admin/purchase/record', '采购记录', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('271', '227', 'admin/purchase/confirm', '确认采购并发送邮件', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('272', '230', 'admin/delivery/info', '送货单详情', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('273', '230', 'admin/delivery/confirm', '确认送货单', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('274', '230', 'admin/delivery/prints', '打印送货单', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('275', '230', 'admin/delivery/edit', '修改送货单', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('276', '230', 'admin/delivery/delete', '删除送货单', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('277', '233', 'admin/store/log', '查看记录', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('278', '233', 'admin/store/cancel', '取消关联', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('279', '234', 'admin/store/update_store', '修改库存', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('280', '236', 'admin/account/create', '新建应收账款', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('281', '236', 'admin/account/info', '应收账款详情', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('282', '236', 'admin/account/edit', '修改账款', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('283', '236', 'admin/account/open', '已开票', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('284', '236', 'admin/account/status', '已核销', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('285', '236', 'admin/account/close', '已关闭', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('286', '236', 'admin/account/delete', '删除账款', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('287', '239', 'admin/account/payment_info', '账款详情', '4', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('288', '239', 'admin/account/payment_edit', '修改账款', '4', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('289', '239', 'admin/account/payment_open', '已开票', '4', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('290', '239', 'admin/account/payment_status', '已对账', '4', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('291', '239', 'admin/account/payment_delete', '删除账款', '4', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('292', '216', 'admin/baojia/pdf', '查看pdf', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('293', '227', 'admin/purchase/edit', '修改采购单', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('294', '206', 'admin/supplier/edit_contacts', '修改联系人', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('296', '219', 'admin/contacts/add', '新增联系人', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('297', '219', 'admin/customers/adduser', '设置默认联系人', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('298', '219', 'admin/contacts/edit', '修改联系人', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('299', '219', 'admin/contacts/deluser', '删除联系人', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('300', '227', 'admin/purchase/view', '查看文件', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('301', '226', 'admin/purchase/query', '查询采购单', '2', '1', '1', 'icon-ecs', '50', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('302', '232', 'admin/store/purchase', '采购入库', '2', '1', '1', 'icon-ecs', '50', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('303', '302', 'admin/store/add', '新增入库', '3', '1', '1', 'icon-ecs', '50', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('304', '236', 'admin/account/ticketrecrod', '发票记录', '3', '1', '1', 'icon-ecs', '50', '1', null);

-- ----------------------------
-- Table structure for syc_bancai
-- ----------------------------
DROP TABLE IF EXISTS `syc_bancai`;
CREATE TABLE `syc_bancai` (
  `bid` int(16) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `bpcid` int(10) NOT NULL COMMENT '产品颜色ID',
  `bplid` int(10) NOT NULL COMMENT '板材ID',
  `bquantity` int(6) NOT NULL DEFAULT '0' COMMENT '数量',
  `create_time` int(16) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(16) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`bid`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COMMENT='板材库存表';

-- ----------------------------
-- Records of syc_bancai
-- ----------------------------
INSERT INTO `syc_bancai` VALUES ('20', '24', '7', '0', '1512126578', '1512126578', '1');
INSERT INTO `syc_bancai` VALUES ('21', '23', '7', '0', '1512126578', '1512214528', '1');
INSERT INTO `syc_bancai` VALUES ('22', '22', '7', '0', '1512126578', '1512214528', '1');
INSERT INTO `syc_bancai` VALUES ('23', '25', '7', '0', '1512126578', '1512126578', '1');
INSERT INTO `syc_bancai` VALUES ('24', '24', '8', '0', '1512213006', '1512213006', '1');
INSERT INTO `syc_bancai` VALUES ('25', '23', '8', '0', '1512213006', '1512213006', '1');
INSERT INTO `syc_bancai` VALUES ('26', '22', '8', '0', '1512213006', '1512213006', '1');
INSERT INTO `syc_bancai` VALUES ('27', '25', '8', '0', '1512213006', '1512213006', '1');

-- ----------------------------
-- Table structure for syc_bancai_list
-- ----------------------------
DROP TABLE IF EXISTS `syc_bancai_list`;
CREATE TABLE `syc_bancai_list` (
  `blid` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `blname` char(50) NOT NULL DEFAULT '' COMMENT '板材名称',
  `blpinpai` char(50) NOT NULL DEFAULT '' COMMENT '料型品牌',
  `bguige` char(50) NOT NULL COMMENT '规格',
  `blimg` varchar(250) NOT NULL DEFAULT '' COMMENT '图片',
  `bldescription` varchar(255) NOT NULL DEFAULT '' COMMENT '简述',
  `bl_uid` int(10) NOT NULL COMMENT '添加员',
  `blgl` char(255) NOT NULL DEFAULT '' COMMENT '关联料型',
  `create_time` int(16) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(16) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`blid`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='板材名称表';

-- ----------------------------
-- Records of syc_bancai_list
-- ----------------------------
INSERT INTO `syc_bancai_list` VALUES ('7', '801', '', '860*2150', '', '', '1', '', '1512126578', '1512212987', '1');
INSERT INTO `syc_bancai_list` VALUES ('8', '802', '', '860*2050', '', '', '1', '', '1512213006', '1512213006', '1');

-- ----------------------------
-- Table structure for syc_baojia
-- ----------------------------
DROP TABLE IF EXISTS `syc_baojia`;
CREATE TABLE `syc_baojia` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `create_uid` int(10) unsigned NOT NULL DEFAULT '0',
  `cus_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '客户id',
  `order_sn` varchar(50) NOT NULL DEFAULT '' COMMENT '报价单号',
  `order_handle` varchar(50) NOT NULL DEFAULT '',
  `company_name` varchar(255) NOT NULL DEFAULT '',
  `company_short` varchar(255) NOT NULL DEFAULT '',
  `contacts` varchar(50) NOT NULL DEFAULT '',
  `fax` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL DEFAULT '',
  `order_remark` text,
  `status` tinyint(2) NOT NULL DEFAULT '0',
  `send_email_time` int(10) unsigned NOT NULL DEFAULT '0',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `order_sn` (`order_sn`,`company_name`,`company_short`,`status`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of syc_baojia
-- ----------------------------
INSERT INTO `syc_baojia` VALUES ('13', '2', '1688', 'CS-Q-10/01182013131013', '彭立新', '惠州市利贞电子有限公司', '惠州利贞', '叶秋兰', '0752-6687598', '354575573@qq.com', '1、以上订单请开给：四川众山化有限公司\n联系人：华南办事处 范小姐13927377526\n电话傎真：0752-3775246  邮箱：SC_CSUN@163.COM\n2、以上报价含16%增值税\n3、付款条件月结60天，如2018年8月货款，请于2018年11月15日前电汇付款。若买方逾期付款，卖方有权要求买方：按逾期货款每天万分之五的比例支付拖欠买方货款赔偿。\n', '0', '0', '1538389239', '1540606136');
INSERT INTO `syc_baojia` VALUES ('14', '2', '1689', 'CS-Q-11/03213902021102', '彭立新', '清远市富盈电子有限公司', '清远富盈', '张玉玲', '0763-3697998', '1040312149@QQ.COM', '1、以上订单请开给：四川众山化有限公司\n联系人：华南办事处 范小姐13927377526\n电话傎真：0752-3775246  邮箱：SC_CSUN@163.COM\n2、以上报价含16%增值税\n3、付款条件月结60天，如2018年8月货款，请于2018年11月15日前电汇付款。若买方逾期付款，卖方有权要求买方：按逾期货款每天万分之五的比例支付拖欠买方货款赔偿。\n', '0', '0', '1541252365', '1541252365');
INSERT INTO `syc_baojia` VALUES ('15', '2', '1690', 'CS-Q-11/06230523231123', '范丽湘', '惠州市纬德电路有限公司', '惠州纬德', '张文圣', '0752-5710768', '1040312149@qq.com', null, '0', '0', '1541516774', '1541731321');

-- ----------------------------
-- Table structure for syc_baojia_goods
-- ----------------------------
DROP TABLE IF EXISTS `syc_baojia_goods`;
CREATE TABLE `syc_baojia_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `baojia_id` int(10) unsigned NOT NULL DEFAULT '0',
  `goods_id` int(10) unsigned NOT NULL DEFAULT '0',
  `goods_name` varchar(255) NOT NULL DEFAULT '',
  `unit` varchar(50) NOT NULL DEFAULT '',
  `goods_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `remark` varchar(255) NOT NULL DEFAULT '',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `baojia_id` (`baojia_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of syc_baojia_goods
-- ----------------------------
INSERT INTO `syc_baojia_goods` VALUES ('30', '13', '8', 'FR-4 CTI≥600 1.1MM H/H 41\"*49\" 含铜 黄料 无水印', '张', '103.00', '', '1538389239');
INSERT INTO `syc_baojia_goods` VALUES ('31', '13', '9', 'FR-4 TG140 1.4MM H/H 37\"*49\" 含铜 黄料 无水印', '张', '113.00', '', '1538389239');
INSERT INTO `syc_baojia_goods` VALUES ('32', '14', '26', '长春干膜 FF-9040S 12.000 *600FT *2卷', '箱', '100.00', '', '1541252365');
INSERT INTO `syc_baojia_goods` VALUES ('33', '15', '25', '长春干膜 FF-9040S 11.000 *600FT *2卷', '箱', '98.88', '测试商品q', '1541516774');

-- ----------------------------
-- Table structure for syc_config
-- ----------------------------
DROP TABLE IF EXISTS `syc_config`;
CREATE TABLE `syc_config` (
  `id` int(6) NOT NULL AUTO_INCREMENT COMMENT '配置ID',
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '配置名称',
  `info` varchar(100) NOT NULL DEFAULT '' COMMENT '配置说明',
  `type` varchar(10) NOT NULL DEFAULT 'string' COMMENT '配置类型1',
  `value` text COMMENT '配置值',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='基本配置表';

-- ----------------------------
-- Records of syc_config
-- ----------------------------
INSERT INTO `syc_config` VALUES ('1', 'syc_basehost', 'CRM站点', 'string', 'http://erp.szstarriver.com');
INSERT INTO `syc_config` VALUES ('2', 'syc_webname', '企业名称', 'string', '四川众山化工有限公司');
INSERT INTO `syc_config` VALUES ('3', 'syc_webtel', '电话', 'string', '13927377526');
INSERT INTO `syc_config` VALUES ('4', 'syc_webfax', '传真', 'string', '0825-2240185');
INSERT INTO `syc_config` VALUES ('5', 'syc_contacts', '联系人', 'string', '范小姐');
INSERT INTO `syc_config` VALUES ('6', 'syc_webemail', '邮件', 'string', 'sc_csun@163.com');
INSERT INTO `syc_config` VALUES ('7', 'syc_email_pwd', '验证密码', 'string', '13829927299');
INSERT INTO `syc_config` VALUES ('8', 'syc_port', 'SMTP端口', 'string', '465');
INSERT INTO `syc_config` VALUES ('10', 'syc_email_smtp', 'SMTP服务器', 'string', 'smtp.163.com');
INSERT INTO `syc_config` VALUES ('11', 'syc_powerby', '版权信息', 'bstring', 'Copyright © 2010-2017 <a href=\"http://erp.szstarriver.com\">广东省广州市天河区</a> 版权所有');
INSERT INTO `syc_config` VALUES ('12', 'syc_beian', '备案信息', 'string', '');
INSERT INTO `syc_config` VALUES ('13', 'syc_tousu', '投诉电话', 'string', '0825-2240185');
INSERT INTO `syc_config` VALUES ('14', 'syc_address', '地址', 'string', '广东省广州市天河区');
INSERT INTO `syc_config` VALUES ('15', 'syc_webqq', 'QQ', 'string', '316262448');
INSERT INTO `syc_config` VALUES ('16', 'syc_keywords', '关键词', 'bstring', '广东省广州市天河区');
INSERT INTO `syc_config` VALUES ('17', 'syc_description', '描述', 'bstring', '四川众山化工有限公司');

-- ----------------------------
-- Table structure for syc_customers
-- ----------------------------
DROP TABLE IF EXISTS `syc_customers`;
CREATE TABLE `syc_customers` (
  `cus_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `cus_con_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '默认联系人ID',
  `cus_name` varchar(255) NOT NULL DEFAULT '' COMMENT '企业名称',
  `cus_short` varchar(255) NOT NULL DEFAULT '' COMMENT '简称',
  `cus_duty` char(20) NOT NULL DEFAULT '' COMMENT '责任人',
  `cus_phome` char(20) NOT NULL COMMENT '座机',
  `cus_fax` char(20) NOT NULL COMMENT '传真',
  `cus_mobile` char(20) NOT NULL DEFAULT '' COMMENT '手机号',
  `cus_email` char(20) NOT NULL COMMENT '邮箱',
  `cus_business` varchar(255) NOT NULL DEFAULT '' COMMENT '业务经理',
  `cus_order_ren` varchar(255) NOT NULL DEFAULT '' COMMENT '跟单员',
  `cus_post` varchar(255) NOT NULL DEFAULT '',
  `cus_prov` varchar(100) NOT NULL DEFAULT '' COMMENT '省份',
  `cus_city` varchar(100) NOT NULL DEFAULT '' COMMENT '城市',
  `cus_dist` varchar(100) NOT NULL DEFAULT '' COMMENT '县区',
  `cus_section` varchar(255) NOT NULL DEFAULT '',
  `cus_sex` tinyint(2) NOT NULL DEFAULT '0',
  `cus_qq` varchar(255) NOT NULL DEFAULT '',
  `cus_street` varchar(100) NOT NULL DEFAULT '' COMMENT '街道信息',
  `create_time` int(16) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(16) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`cus_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1692 DEFAULT CHARSET=utf8 COMMENT='客户信息表';

-- ----------------------------
-- Records of syc_customers
-- ----------------------------
INSERT INTO `syc_customers` VALUES ('1686', '5', '广州市进销传系统有限公司', '进销传系统', 'nice172', '020-89898989', '020-89898989', '13800138000', '354575573@qq.com', '彭立新', '跟单员2', 'PHP', '广东省', '广州市', '天河区', '工作部', '0', '354575573', '中山大道西1025号', '1533614328', '1533614328', '-1');
INSERT INTO `syc_customers` VALUES ('1687', '0', 'fdsafff', 'fsafafafd', '', 'fdsfsaffa', '', '', '', '0', '', '', '北京市', '东城区', '', '0', '-1', '', '', '1535615508', '1535615508', '-1');
INSERT INTO `syc_customers` VALUES ('1688', '0', '惠州市利贞电子有限公司', '惠州利贞', '叶秋兰', '0752-6687010', '0752-6687598', '13686294290', '1040312149@QQ.COM', '彭立新', '范丽湘', '采购', '广东省', '惠州市', '博罗县', '采购部', '0', '415059967', '龙溪镇埔上村建时工业园内', '1536052471', '1536052471', '1');
INSERT INTO `syc_customers` VALUES ('1689', '12', '清远市富盈电子有限公司', '清远富盈', '张玉玲', '0763-3697026', '0763-3697998', '15816247536', '1040312149@QQ.COM', '彭立新', '范丽湘', '采购', '广东省', '清远市', '清城区', '采购部', '0', '1005083376', '嘉福工业园C区', '1536052722', '1536052722', '1');
INSERT INTO `syc_customers` VALUES ('1690', '11', '惠州市纬德电路有限公司', '惠州纬德', '张文圣', '0752-5710689-815', '0752-5710768', '13530252252', '1040312149@qq.com', '彭立新', '范丽湘', '采购', '广东省', '惠州市', '博罗县', '采购部', '1', '', '麻陂镇 伟德线路板有限公司', '1536054853', '1536054853', '1');
INSERT INTO `syc_customers` VALUES ('1691', '0', '珠海精毅电路有限公司', '珠海精毅', '付立元', '0756-6293518', '0756-6210202', '13928025290', '1040312149@QQ.COM', '彭立新', '范丽湘', '采购', '广东省', '珠海市', '斗门区', '采购部', '0', '', '斗门镇 凯德斯工业园D栋', '1539054358', '1539054358', '1');

-- ----------------------------
-- Table structure for syc_customers_contact
-- ----------------------------
DROP TABLE IF EXISTS `syc_customers_contact`;
CREATE TABLE `syc_customers_contact` (
  `con_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '自增',
  `con_cus_id` int(10) NOT NULL COMMENT '客户ID',
  `con_name` char(16) NOT NULL COMMENT '姓名',
  `con_sex` tinyint(2) DEFAULT '1' COMMENT '性别1男0女',
  `con_post` char(20) NOT NULL DEFAULT '' COMMENT '职位',
  `con_section` varchar(255) NOT NULL DEFAULT '' COMMENT '部门',
  `con_mobile` char(20) NOT NULL DEFAULT '' COMMENT '手机号',
  `con_qq` char(20) NOT NULL DEFAULT '' COMMENT 'QQ',
  `con_email` char(30) NOT NULL DEFAULT '' COMMENT '邮箱',
  `con_address` varchar(50) NOT NULL DEFAULT '' COMMENT '详细地址',
  `con_description` varchar(200) NOT NULL DEFAULT '' COMMENT '备注信息',
  `create_time` int(16) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(16) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`con_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='客户联系人表';

-- ----------------------------
-- Records of syc_customers_contact
-- ----------------------------
INSERT INTO `syc_customers_contact` VALUES ('5', '1686', 'nice172', '1', '开发者', '销售部', '13800138000', '354575573', '354575573@qq.com', '广东省广州市天河区中山大道西1025号', '客户备注内容', '1533614328', '1533614328', '1');
INSERT INTO `syc_customers_contact` VALUES ('6', '1686', '蜡笔小新', '1', '仓管', '仓储物流部', '13800138001', '354575575', '354575575@qq.com', '广州市天河区中山大道西1025号', '备注蜡笔小新', '1533622131', '1533622131', '1');
INSERT INTO `syc_customers_contact` VALUES ('7', '1686', 'fdsafa', '1', 'fdsafsaf', '采购部', '13800138000', 'fsafdsadf', 'fsdafa', 'fdsafsa', 'fsadf', '1533623950', '1533624036', '-1');
INSERT INTO `syc_customers_contact` VALUES ('8', '1687', '', '-1', '', '0', '', '', '', '北京市东城区', '', '1535615508', '1535615524', '-1');
INSERT INTO `syc_customers_contact` VALUES ('9', '1688', '叶秋兰', '0', '采购', '采购部', '13686294290', '415059967', 'hzlzpcbctt@163.com', '广东省惠州市博罗县龙溪镇埔上村建时工业园内', '', '1536052471', '1536052471', '1');
INSERT INTO `syc_customers_contact` VALUES ('10', '1689', '张玉玲', '1', '采购', '采购部', '15816247536', '1005083376', '1040312149@QQ.COM', '广东省清远市清城区嘉福工业园C区写字楼', '', '1536052722', '1538296821', '1');
INSERT INTO `syc_customers_contact` VALUES ('11', '1690', '张文圣', '1', '采购', '采购部', '13530252252', '', '1040312149@qq.com', '广东省惠州市博罗县麻陂镇 伟德线路板有限公司', '', '1536054853', '1536163986', '1');
INSERT INTO `syc_customers_contact` VALUES ('12', '1689', '王平', '1', '主管', '仓储物流部', '13729678720', '', '1040312149@QQ.COM', '广东省清远市清城区嘉福工业园C区仓库', '', '1538117778', '1538296828', '1');
INSERT INTO `syc_customers_contact` VALUES ('13', '1691', '付立元', '0', '采购', '采购部', '13928025290', '', '1040312149@QQ.COM', '广东省珠海市斗门区斗门镇 凯德斯工业园D栋', '', '1539054358', '1539054358', '1');

-- ----------------------------
-- Table structure for syc_customers_evaluate
-- ----------------------------
DROP TABLE IF EXISTS `syc_customers_evaluate`;
CREATE TABLE `syc_customers_evaluate` (
  `eva_id` int(6) NOT NULL AUTO_INCREMENT COMMENT '自增',
  `eva_name` char(20) NOT NULL DEFAULT '' COMMENT '评估名称',
  `eva_text` char(100) NOT NULL COMMENT '说明',
  PRIMARY KEY (`eva_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='客户评估等级表';

-- ----------------------------
-- Records of syc_customers_evaluate
-- ----------------------------
INSERT INTO `syc_customers_evaluate` VALUES ('1', '优秀级', '（AAA）90分及以上。企业各项经济指标很好，经营管理状况好，经济效益很好，有很强的清偿与支付能力，市场竞争力强，企业信誉度高。');
INSERT INTO `syc_customers_evaluate` VALUES ('2', '良好级', '（AA）80-89分。企业各项经济指标良好，经营管理状况较好，经济效益良好，有较强的清偿与支付能力，企业信誉度良好。');
INSERT INTO `syc_customers_evaluate` VALUES ('3', '较好级', '（A）70-79分。企业有一定的经济实力，经营管理状况尚可，经济效益稳定，有一定的清偿与支付能力，企业信誉度尚可。');
INSERT INTO `syc_customers_evaluate` VALUES ('4', '一般级', '（BBB）60-69分。企业各项经济指标一般，经营管理状况一般，清偿与支付有一定难度，存在风险。');
INSERT INTO `syc_customers_evaluate` VALUES ('5', '较差级', '（BB）50-59分。企业各项经济指标较差，经营管理状况较差，清偿与支付有较大难度，存在较高风险。');
INSERT INTO `syc_customers_evaluate` VALUES ('6', '差级', '（B）49分及以下。企业各项经济指标差，经营管理状况差，清偿与支付有很大难度，存在高风险。');

-- ----------------------------
-- Table structure for syc_customers_message
-- ----------------------------
DROP TABLE IF EXISTS `syc_customers_message`;
CREATE TABLE `syc_customers_message` (
  `msg_cus_id` int(10) NOT NULL COMMENT '客户ID',
  `msg_content` text COMMENT '备注内容',
  PRIMARY KEY (`msg_cus_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='客户备注信息';

-- ----------------------------
-- Records of syc_customers_message
-- ----------------------------
INSERT INTO `syc_customers_message` VALUES ('1686', '客户备注内容');
INSERT INTO `syc_customers_message` VALUES ('1687', '');
INSERT INTO `syc_customers_message` VALUES ('1688', '');
INSERT INTO `syc_customers_message` VALUES ('1689', '');
INSERT INTO `syc_customers_message` VALUES ('1690', '');
INSERT INTO `syc_customers_message` VALUES ('1691', '');

-- ----------------------------
-- Table structure for syc_customers_premises
-- ----------------------------
DROP TABLE IF EXISTS `syc_customers_premises`;
CREATE TABLE `syc_customers_premises` (
  `pre_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '自增',
  `pre_cus_id` int(10) NOT NULL DEFAULT '0' COMMENT '客户ID',
  `pre_log_id` int(10) NOT NULL DEFAULT '0' COMMENT '物流ID',
  `pre_name` char(20) NOT NULL DEFAULT '' COMMENT '收货人',
  `pre_phone` char(20) NOT NULL DEFAULT '' COMMENT '联系电话',
  `pre_prov` char(10) NOT NULL DEFAULT '' COMMENT '省份',
  `pre_city` char(10) NOT NULL DEFAULT '' COMMENT '城市',
  `pre_dist` char(10) NOT NULL DEFAULT '' COMMENT '县区',
  `pre_street` varchar(100) NOT NULL COMMENT '街道信息',
  `pre_description` varchar(255) NOT NULL DEFAULT '' COMMENT '备注信息',
  PRIMARY KEY (`pre_id`),
  UNIQUE KEY `pre_cus_id` (`pre_cus_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='客户收货信息';

-- ----------------------------
-- Records of syc_customers_premises
-- ----------------------------

-- ----------------------------
-- Table structure for syc_customers_type
-- ----------------------------
DROP TABLE IF EXISTS `syc_customers_type`;
CREATE TABLE `syc_customers_type` (
  `ty_id` int(6) NOT NULL AUTO_INCREMENT COMMENT '自增',
  `ty_name` char(16) NOT NULL COMMENT '名称',
  PRIMARY KEY (`ty_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='客户类型表';

-- ----------------------------
-- Records of syc_customers_type
-- ----------------------------
INSERT INTO `syc_customers_type` VALUES ('1', '零售业');
INSERT INTO `syc_customers_type` VALUES ('2', '经销商');
INSERT INTO `syc_customers_type` VALUES ('3', '专卖店');
INSERT INTO `syc_customers_type` VALUES ('4', '企业型');

-- ----------------------------
-- Table structure for syc_delivery_goods
-- ----------------------------
DROP TABLE IF EXISTS `syc_delivery_goods`;
CREATE TABLE `syc_delivery_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `delivery_id` int(10) unsigned NOT NULL DEFAULT '0',
  `goods_id` int(10) unsigned NOT NULL DEFAULT '0',
  `goods_name` varchar(255) NOT NULL DEFAULT '',
  `goods_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `unit` varchar(100) NOT NULL DEFAULT '',
  `goods_attr` text,
  `current_send_number` int(10) unsigned NOT NULL DEFAULT '0',
  `add_number` int(10) unsigned NOT NULL DEFAULT '0',
  `remark` text,
  PRIMARY KEY (`id`),
  KEY `delivery_id` (`delivery_id`,`goods_id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of syc_delivery_goods
-- ----------------------------
INSERT INTO `syc_delivery_goods` VALUES ('55', '39', '8', 'FR-4 CTI≥600 1.1MM H/H 41\"*49\" 含铜 黄料 无水印', '104.00', '张', '[{\"goods_attr_id\":12,\"attr_name\":\"\\u7c7b\\u578b\",\"attr_value\":\"FR-4\"},{\"goods_attr_id\":22,\"attr_name\":\"\\u80f6\\u7cfb\",\"attr_value\":\"CTI\\u2265600\"},{\"goods_attr_id\":14,\"attr_name\":\"\\u677f\\u539a\",\"attr_value\":\"1.10MM\"},{\"goods_attr_id\":16,\"attr_name\":\"\\u94dc\\u539a\",\"attr_value\":\"H\\/H\"},{\"goods_attr_id\":19,\"attr_name\":\"\\u5c3a\\u5bf8\",\"attr_value\":\"41\\u201d*49\\u201c\"},{\"goods_attr_id\":21,\"attr_name\":\"\\u662f\\u5426\\u542b\\u94dc\",\"attr_value\":\"\\u542b\\u94dc\\u539a\"},{\"goods_attr_id\":20,\"attr_name\":\"\\u8272\\u7cfb\",\"attr_value\":\"\\u9ec4\\u6599\"},{\"goods_attr_id\":23,\"attr_name\":\"\\u6709\\u65e0\\u6c34\\u5370\",\"attr_value\":\"\\u65e0\\u6c34\\u5370\"},{\"goods_attr_id\":13,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u5fb7\\u51ef\"}]', '42', '0', '');
INSERT INTO `syc_delivery_goods` VALUES ('56', '39', '9', 'FR-4 TG140 1.4MM H/H 37\"*49\" 含铜 黄料 无水印', '114.00', '张', '[{\"goods_attr_id\":12,\"attr_name\":\"\\u7c7b\\u578b\",\"attr_value\":\"FR-4\"},{\"goods_attr_id\":22,\"attr_name\":\"\\u80f6\\u7cfb\",\"attr_value\":\"TG135\"},{\"goods_attr_id\":14,\"attr_name\":\"\\u677f\\u539a\",\"attr_value\":\"1.00MM\"},{\"goods_attr_id\":16,\"attr_name\":\"\\u94dc\\u539a\",\"attr_value\":\"H\\/H\"},{\"goods_attr_id\":19,\"attr_name\":\"\\u5c3a\\u5bf8\",\"attr_value\":\"37\\u201c*49\\u201d\"},{\"goods_attr_id\":21,\"attr_name\":\"\\u662f\\u5426\\u542b\\u94dc\",\"attr_value\":\"\\u542b\\u94dc\\u539a\"},{\"goods_attr_id\":20,\"attr_name\":\"\\u8272\\u7cfb\",\"attr_value\":\"\\u9ec4\\u6599\"},{\"goods_attr_id\":23,\"attr_name\":\"\\u6709\\u65e0\\u6c34\\u5370\",\"attr_value\":\"\\u65e0\\u6c34\\u5370\"},{\"goods_attr_id\":13,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u5fb7\\u51ef\"}]', '32', '0', '');
INSERT INTO `syc_delivery_goods` VALUES ('57', '40', '31', '长春干膜 FF-9040S 15.500 *600FT *2卷', '722.30', '箱', '[]', '1', '0', '');
INSERT INTO `syc_delivery_goods` VALUES ('58', '40', '39', '长春干膜 FF-9040S 20.000 *600FT *2卷', '932.00', '箱', '[]', '3', '0', '');
INSERT INTO `syc_delivery_goods` VALUES ('59', '40', '41', '长春干膜 FF-9040S 20.500 *600FT *2卷', '955.30', '箱', '[]', '3', '0', '');
INSERT INTO `syc_delivery_goods` VALUES ('60', '41', '53', '长春干膜 FF-9040S 14.000 *600FT *2卷', '652.40', '箱', '[]', '1', '0', '');
INSERT INTO `syc_delivery_goods` VALUES ('61', '41', '54', '长春干膜 FF-9040S 18.500 *600FT *2卷', '862.10', '箱', '[]', '1', '0', '');
INSERT INTO `syc_delivery_goods` VALUES ('62', '41', '39', '长春干膜 FF-9040S 20.000 *600FT *2卷', '932.00', '箱', '[]', '1', '0', '');

-- ----------------------------
-- Table structure for syc_delivery_order
-- ----------------------------
DROP TABLE IF EXISTS `syc_delivery_order`;
CREATE TABLE `syc_delivery_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin_uid` int(10) unsigned NOT NULL DEFAULT '0',
  `purchase_id` int(10) unsigned NOT NULL DEFAULT '0',
  `order_dn` varchar(255) NOT NULL DEFAULT '',
  `po_sn` varchar(255) NOT NULL,
  `delivery_date` varchar(50) NOT NULL DEFAULT '',
  `purchase_date` varchar(50) NOT NULL DEFAULT '',
  `purchase_money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `order_id` int(10) unsigned NOT NULL DEFAULT '0',
  `order_sn` varchar(255) NOT NULL DEFAULT '',
  `cus_name` varchar(255) NOT NULL DEFAULT '',
  `cus_id` int(10) unsigned NOT NULL DEFAULT '0',
  `contacts` varchar(50) NOT NULL DEFAULT '',
  `contacts_tel` varchar(50) NOT NULL DEFAULT '',
  `delivery_address` varchar(255) NOT NULL DEFAULT '',
  `delivery_sn` varchar(100) NOT NULL DEFAULT '',
  `delivery_way` varchar(100) NOT NULL DEFAULT '',
  `delivery_driver` varchar(50) NOT NULL DEFAULT '',
  `driver_tel` varchar(50) NOT NULL DEFAULT '',
  `relation_type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0采购单关联订单，1随意送货订单',
  `status` tinyint(2) NOT NULL DEFAULT '0',
  `is_confirm` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1确认',
  `is_print` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1已打印',
  `is_invoice` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1已开票',
  `is_payment` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1已创建应付账款',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `purchase_id` (`purchase_id`,`order_id`,`cus_id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of syc_delivery_order
-- ----------------------------
INSERT INTO `syc_delivery_order` VALUES ('39', '2', '39', 'DN201810014614141014', 'PO201810014139391039', '2018-10-03', '2018-10-01', '8016.00', '47', 'SO201810014048481048', '清远市富盈电子有限公司', '1689', '王平', '13729678720', '广东省清远市清城区嘉福工业园C区仓库', '302240204000112', '货拉拉', '张司机', '13640734742', '1', '0', '1', '1', '1', '0', '1538390819', '1538390819');
INSERT INTO `syc_delivery_order` VALUES ('40', '4', '40', 'DN201810071258581058', 'PO201810070208081008', '2018-10-10', '2018-10-07', '6384.20', '48', 'SO201810075835351035', '惠州市利贞电子有限公司', '1688', '梁小姐', '13544889992', '广东省惠州市博罗县龙溪镇埔上村建时工业园内', '45678999999', '货运', '周', '15948867000', '1', '0', '1', '1', '1', '0', '1538925366', '1538925366');
INSERT INTO `syc_delivery_order` VALUES ('41', '4', '41', 'DN201810080153531053', 'PO201810083404041004', '2018-10-10', '2018-10-08', '2446.50', '49', 'SO201810083141411041', '惠州市利贞电子有限公司', '1688', '叶秋兰', '1234566778', '广东省惠州市博罗县龙溪镇埔上村建时工业园内', '123455666', '货运', '周1254666', '134886446633', '1', '0', '1', '1', '1', '0', '1539011056', '1539011056');

-- ----------------------------
-- Table structure for syc_finance
-- ----------------------------
DROP TABLE IF EXISTS `syc_finance`;
CREATE TABLE `syc_finance` (
  `fid` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `fpnumber` char(20) NOT NULL COMMENT '订单号',
  `fcus_id` int(10) NOT NULL COMMENT '企业ID',
  `fcus_name` char(50) NOT NULL COMMENT '客户名称',
  `sort` tinyint(2) NOT NULL DEFAULT '1' COMMENT '收款类:1为订金2为余款3为其他',
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '金额',
  `fuid` int(10) NOT NULL DEFAULT '0' COMMENT '收款人',
  `shoukuan_time` int(16) NOT NULL DEFAULT '0' COMMENT '收款时间',
  `create_time` int(16) NOT NULL DEFAULT '0' COMMENT '注册时间',
  `update_time` int(16) NOT NULL DEFAULT '0' COMMENT '登录时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`fid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='收款表';

-- ----------------------------
-- Records of syc_finance
-- ----------------------------

-- ----------------------------
-- Table structure for syc_finance_schedule
-- ----------------------------
DROP TABLE IF EXISTS `syc_finance_schedule`;
CREATE TABLE `syc_finance_schedule` (
  `fsid` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `fs_fid` int(10) NOT NULL DEFAULT '0' COMMENT '收款ID',
  `fs_img` varchar(250) NOT NULL DEFAULT '' COMMENT '图片',
  `fs_remark` varchar(255) NOT NULL DEFAULT '' COMMENT '内容',
  PRIMARY KEY (`fsid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='收款附表';

-- ----------------------------
-- Records of syc_finance_schedule
-- ----------------------------

-- ----------------------------
-- Table structure for syc_finance_sort
-- ----------------------------
DROP TABLE IF EXISTS `syc_finance_sort`;
CREATE TABLE `syc_finance_sort` (
  `sid` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `sname` char(20) NOT NULL DEFAULT '' COMMENT '订单号',
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='收款附表项目类型';

-- ----------------------------
-- Records of syc_finance_sort
-- ----------------------------
INSERT INTO `syc_finance_sort` VALUES ('1', '订单订金');
INSERT INTO `syc_finance_sort` VALUES ('2', '订单尾款');
INSERT INTO `syc_finance_sort` VALUES ('3', '订单全款');
INSERT INTO `syc_finance_sort` VALUES ('4', '其他款项');

-- ----------------------------
-- Table structure for syc_fittings_lock
-- ----------------------------
DROP TABLE IF EXISTS `syc_fittings_lock`;
CREATE TABLE `syc_fittings_lock` (
  `lid` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `lname` char(16) NOT NULL COMMENT '名称',
  `lprice` decimal(6,2) NOT NULL DEFAULT '0.00' COMMENT '价格',
  `luser_nick` char(20) NOT NULL COMMENT '添加者',
  `laddress` varchar(100) NOT NULL DEFAULT '' COMMENT '产地',
  `limg` varchar(250) NOT NULL DEFAULT '' COMMENT '图片',
  `ldescription` varchar(255) NOT NULL DEFAULT '' COMMENT '简述',
  `create_time` int(16) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(16) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(5) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`lid`),
  UNIQUE KEY `lname` (`lname`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='锁具配件表';

-- ----------------------------
-- Records of syc_fittings_lock
-- ----------------------------
INSERT INTO `syc_fittings_lock` VALUES ('1', '白至尊', '55.00', '1', '', '', '', '1507531190', '1507535077', '1');
INSERT INTO `syc_fittings_lock` VALUES ('2', '至尊锁', '60.00', '1', '', '', '', '1511074473', '1511074473', '1');

-- ----------------------------
-- Table structure for syc_goods
-- ----------------------------
DROP TABLE IF EXISTS `syc_goods`;
CREATE TABLE `syc_goods` (
  `goods_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品id',
  `goods_name` varchar(255) NOT NULL DEFAULT '' COMMENT '商品名称',
  `category_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品分类',
  `goods_type_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品类型',
  `brand_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '品牌',
  `supplier_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属供应商',
  `unit` varchar(20) NOT NULL DEFAULT '' COMMENT '商品单位',
  `market_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '销售价格',
  `shop_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '采购价',
  `remark` text COMMENT '备注',
  `goods_attr` text COMMENT '商品属性',
  `goods_weight` varchar(50) NOT NULL DEFAULT '' COMMENT '商品重量',
  `store_number` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品库存',
  `store_attr` varchar(255) NOT NULL DEFAULT '' COMMENT '库存属性',
  `copyright` varchar(255) NOT NULL DEFAULT '' COMMENT '所有权',
  `address` varchar(255) NOT NULL DEFAULT '' COMMENT '具体位置',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0禁售，-1删除',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`goods_id`),
  KEY `supplier_id` (`supplier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of syc_goods
-- ----------------------------
INSERT INTO `syc_goods` VALUES ('1', '测试商品', '3', '1', '2', '1', '台', '3399.00', '2999.00', '测试商品备注', '[{\"goods_attr_id\":12,\"attr_name\":\"\\u989c\\u8272\",\"attr_value\":\"\\u767d\\u8272\"},{\"goods_attr_id\":13,\"attr_name\":\"\\u7f51\\u7edc\\u5236\\u5f0f\",\"attr_value\":\"\\u79fb\\u52a84G\\/\\u8054\\u901a4G\\/\\u7535\\u4fe14G\"},{\"goods_attr_id\":14,\"attr_name\":\"\\u5957\\u9910\",\"attr_value\":\"\\u5957\\u9910\\u4e8c\"},{\"goods_attr_id\":16,\"attr_name\":\"ab\",\"attr_value\":\"php\"}]', '0.23KG', '1000', '库存属性', '', '具体位置具体位置具体位置具体位置具体位置', '-1', '1533893242', '1535614840');
INSERT INTO `syc_goods` VALUES ('2', 'fsafsa', '1', '2', '2', '1', '件', '12112.00', '12.00', '23132', null, '31233', '1000', '313131', '321313', '具体位置具体位置具体位置具体位置具体位置', '-1', '1533893431', '1535080253');
INSERT INTO `syc_goods` VALUES ('4', '小米手机iPhone6s 32G', '3', '1', '2', '1', '台', '2199.00', '1999.00', '小米手机iPhone6s 32G备注', '[{\"goods_attr_id\":12,\"attr_name\":\"\\u989c\\u8272\",\"attr_value\":\"\\u767d\\u8272\"},{\"goods_attr_id\":13,\"attr_name\":\"\\u7f51\\u7edc\\u5236\\u5f0f\",\"attr_value\":\"\\u79fb\\u52a84G\\/\\u8054\\u901a4G\\/\\u7535\\u4fe14G\"},{\"goods_attr_id\":14,\"attr_name\":\"\\u5957\\u9910\",\"attr_value\":\"\\u5957\\u9910\\u4e8c\"},{\"goods_attr_id\":16,\"attr_name\":\"ab\",\"attr_value\":\"php\"}]', '0.23KG', '1000', '小米广州仓库', '小米科技', '广州81号仓库', '-1', '1533972542', '1535080261');
INSERT INTO `syc_goods` VALUES ('5', 'gasafsdf', '3', '2', '1', '1', '台', '3123.00', '12.00', '3122313', '', '231', '1000', '3213', '3213', '31223', '-1', '1533974547', '1535080267');
INSERT INTO `syc_goods` VALUES ('6', '测试商品2', '7', '1', '1', '1', '台', '3999.00', '3899.00', '备注备注备注备注备注备注备注备注', '[{\"goods_attr_id\":12,\"attr_name\":\"\\u989c\\u8272\",\"attr_value\":\"\\u767d\\u8272\"},{\"goods_attr_id\":13,\"attr_name\":\"\\u7f51\\u7edc\\u5236\\u5f0f\",\"attr_value\":\"\\u79fb\\u52a84G+\"},{\"goods_attr_id\":14,\"attr_name\":\"\\u5957\\u9910\",\"attr_value\":\"\\u5957\\u9910\\u4e8c\"},{\"goods_attr_id\":16,\"attr_name\":\"ab\",\"attr_value\":\"java\"}]', '5.23KG', '1000', '华为广州仓库', '华为科技', '广东省广州市天河区', '-1', '1533975224', '1535080272');
INSERT INTO `syc_goods` VALUES ('7', 'fdsaff', '3', '1', '2', '1', '件', '55.00', '12.00', 'fsdffa', '[{\"goods_attr_id\":12,\"attr_name\":\"\\u989c\\u8272\",\"attr_value\":\"\\u9ed1\\u8272\"},{\"goods_attr_id\":13,\"attr_name\":\"\\u7f51\\u7edc\\u5236\\u5f0f\",\"attr_value\":\"\\u53cc\\u5361\\u53554G\"},{\"goods_attr_id\":14,\"attr_name\":\"\\u5957\\u9910\",\"attr_value\":\"\\u5957\\u9910\\u4e09\"},{\"goods_attr_id\":16,\"attr_name\":\"ab\",\"attr_value\":\"php\"}]', '22', '1000', '55', '66', '88', '-1', '1534404872', '1535080279');
INSERT INTO `syc_goods` VALUES ('8', 'FR-4 CTI≥600 1.1MM H/H 41\"*49\" 含铜 黄料 无水印', '1', '1', '2', '2', '张', '103.00', '98.00', '', '[{\"goods_attr_id\":12,\"attr_name\":\"\\u7c7b\\u578b\",\"attr_value\":\"FR-4\"},{\"goods_attr_id\":22,\"attr_name\":\"\\u80f6\\u7cfb\",\"attr_value\":\"CTI\\u2265600\"},{\"goods_attr_id\":14,\"attr_name\":\"\\u677f\\u539a\",\"attr_value\":\"1.10MM\"},{\"goods_attr_id\":16,\"attr_name\":\"\\u94dc\\u539a\",\"attr_value\":\"H\\/H\"},{\"goods_attr_id\":19,\"attr_name\":\"\\u5c3a\\u5bf8\",\"attr_value\":\"41\\u201d*49\\u201c\"},{\"goods_attr_id\":21,\"attr_name\":\"\\u662f\\u5426\\u542b\\u94dc\",\"attr_value\":\"\\u542b\\u94dc\\u539a\"},{\"goods_attr_id\":20,\"attr_name\":\"\\u8272\\u7cfb\",\"attr_value\":\"\\u9ec4\\u6599\"},{\"goods_attr_id\":23,\"attr_name\":\"\\u6709\\u65e0\\u6c34\\u5370\",\"attr_value\":\"\\u65e0\\u6c34\\u5370\"},{\"goods_attr_id\":13,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u5fb7\\u51ef\"}]', '', '0', '', '', '', '-1', '1535094209', '1536071255');
INSERT INTO `syc_goods` VALUES ('9', 'FR-4 TG140 1.4MM H/H 37\"*49\" 含铜 黄料 无水印', '1', '1', '2', '2', '张', '113.00', '100.00', '', '[{\"goods_attr_id\":12,\"attr_name\":\"\\u7c7b\\u578b\",\"attr_value\":\"FR-4\"},{\"goods_attr_id\":22,\"attr_name\":\"\\u80f6\\u7cfb\",\"attr_value\":\"TG135\"},{\"goods_attr_id\":14,\"attr_name\":\"\\u677f\\u539a\",\"attr_value\":\"1.00MM\"},{\"goods_attr_id\":16,\"attr_name\":\"\\u94dc\\u539a\",\"attr_value\":\"H\\/H\"},{\"goods_attr_id\":19,\"attr_name\":\"\\u5c3a\\u5bf8\",\"attr_value\":\"37\\u201c*49\\u201d\"},{\"goods_attr_id\":21,\"attr_name\":\"\\u662f\\u5426\\u542b\\u94dc\",\"attr_value\":\"\\u542b\\u94dc\\u539a\"},{\"goods_attr_id\":20,\"attr_name\":\"\\u8272\\u7cfb\",\"attr_value\":\"\\u9ec4\\u6599\"},{\"goods_attr_id\":23,\"attr_name\":\"\\u6709\\u65e0\\u6c34\\u5370\",\"attr_value\":\"\\u65e0\\u6c34\\u5370\"},{\"goods_attr_id\":13,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u5fb7\\u51ef\"}]', '', '0', '', '', '', '-1', '1535094595', '1536057258');
INSERT INTO `syc_goods` VALUES ('10', 'fsadffdf', '3', '1', '0', '1', '件', '23123.00', '12.00', '412fds', '[{\"goods_attr_id\":12,\"attr_name\":\"\\u989c\\u8272\",\"attr_value\":\"\\u767d\\u8272\"},{\"goods_attr_id\":13,\"attr_name\":\"\\u7f51\\u7edc\\u5236\\u5f0f\",\"attr_value\":\"\\u79fb\\u52a84G\\/\\u8054\\u901a4G\\/\\u7535\\u4fe14G\"},{\"goods_attr_id\":14,\"attr_name\":\"\\u5957\\u9910\",\"attr_value\":\"\\u5957\\u9910\\u4e00\"},{\"goods_attr_id\":16,\"attr_name\":\"ab\",\"attr_value\":\"ab\"}]', '3213', '3211', '3213', '31231', '32131', '-1', '1535445430', '1535445445');
INSERT INTO `syc_goods` VALUES ('11', 'FF-9040S 20.250”*600FT*2卷', '5', '4', '0', '3', '箱', '926.00', '858.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"20.250\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"300\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"2\"}]', '', '0', '', '', '', '-1', '1536058072', '1536165743');
INSERT INTO `syc_goods` VALUES ('12', 'FF-9040S 22.000\"*600FT*2卷', '5', '4', '0', '3', '箱', '1210.00', '1100.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"22.000\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"2\"}]', '', '0', '', '', '', '-1', '1536058202', '1536058258');
INSERT INTO `syc_goods` VALUES ('13', 'FF-9050S  16.000\"*500FT*2卷', '5', '4', '0', '3', '箱', '1050.00', '969.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9050S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"16.000\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"500FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"2\"}]', '', '0', '', '', '', '-1', '1536058414', '1536058414');
INSERT INTO `syc_goods` VALUES ('14', 'FR-4 TG140 CTI≥600 1.00MM H/H 41”*49“ 含铜厚 黄料 无水印', '1', '1', '0', '2', '张', '118.00', '116.00', '', '[{\"goods_attr_id\":12,\"attr_name\":\"\\u7c7b\\u578b\",\"attr_value\":\"FR-4\"},{\"goods_attr_id\":22,\"attr_name\":\"\\u80f6\\u7cfb\",\"attr_value\":\"TG140 CTI\\u2265600\"},{\"goods_attr_id\":14,\"attr_name\":\"\\u677f\\u539a\",\"attr_value\":\"1.00MM\"},{\"goods_attr_id\":16,\"attr_name\":\"\\u94dc\\u539a\",\"attr_value\":\"H\\/H\"},{\"goods_attr_id\":19,\"attr_name\":\"\\u5c3a\\u5bf8\",\"attr_value\":\"41\\u201d*49\\u201c\"},{\"goods_attr_id\":21,\"attr_name\":\"\\u662f\\u5426\\u542b\\u94dc\",\"attr_value\":\"\\u542b\\u94dc\\u539a\"},{\"goods_attr_id\":20,\"attr_name\":\"\\u8272\\u7cfb\",\"attr_value\":\"\\u9ec4\\u6599\"},{\"goods_attr_id\":23,\"attr_name\":\"\\u6709\\u65e0\\u6c34\\u5370\",\"attr_value\":\"\\u65e0\\u6c34\\u5370\"}]', '2.1', '0', '', '', '', '-1', '1536204547', '1536204547');
INSERT INTO `syc_goods` VALUES ('15', 'FR-4 TG135 1.50MM 2/0 41”*49“ 含铜厚 黄料 无水印', '1', '1', '0', '2', '张', '202.00', '190.00', '', '[{\"goods_attr_id\":12,\"attr_name\":\"\\u7c7b\\u578b\",\"attr_value\":\"FR-4\"},{\"goods_attr_id\":22,\"attr_name\":\"\\u80f6\\u7cfb\",\"attr_value\":\"TG135\"},{\"goods_attr_id\":14,\"attr_name\":\"\\u677f\\u539a\",\"attr_value\":\"1.50MM\"},{\"goods_attr_id\":16,\"attr_name\":\"\\u94dc\\u539a\",\"attr_value\":\"2\\/0\"},{\"goods_attr_id\":19,\"attr_name\":\"\\u5c3a\\u5bf8\",\"attr_value\":\"41\\u201d*49\\u201c\"},{\"goods_attr_id\":21,\"attr_name\":\"\\u662f\\u5426\\u542b\\u94dc\",\"attr_value\":\"\\u542b\\u94dc\\u539a\"},{\"goods_attr_id\":20,\"attr_name\":\"\\u8272\\u7cfb\",\"attr_value\":\"\\u9ec4\\u6599\"},{\"goods_attr_id\":23,\"attr_name\":\"\\u6709\\u65e0\\u6c34\\u5370\",\"attr_value\":\"\\u65e0\\u6c34\\u5370\"}]', '', '0', '', '', '', '-1', '1536216750', '1536216750');
INSERT INTO `syc_goods` VALUES ('16', '长春 FF-9040S 20.125 600 2', '5', '4', '0', '3', '箱', '902.00', '886.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"20.125\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"600\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"2\"}]', '', '0', '', '', '', '-1', '1536216917', '1536216917');
INSERT INTO `syc_goods` VALUES ('17', '长春 FF-9040S 18.000 *600FT 2', '5', '4', '0', '3', '箱', '1002.00', '926.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"18.000\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"2\"}]', '', '0', '', '', '', '-1', '1536217145', '1536217145');
INSERT INTO `syc_goods` VALUES ('18', '长春 FF-9040S 24.500 *600FT *1卷', '5', '4', '0', '3', '卷', '1309.00', '1252.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"24.500\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*1\\u5377\"}]', '', '0', '', '', '', '-1', '1536217274', '1536217274');
INSERT INTO `syc_goods` VALUES ('19', 'TG170 PP1080 R/C:68% 49.5“*300M 黄料 无水印', '11', '22', '0', '2', '卷', '4200.00', '4000.00', '', '[{\"goods_attr_id\":30,\"attr_name\":\"\\u80f6\\u7cfb\",\"attr_value\":\"TG170\"},{\"goods_attr_id\":29,\"attr_name\":\"\\u5e03\\u79cd\",\"attr_value\":\"PP1080\"},{\"goods_attr_id\":31,\"attr_name\":\"\\u542b\\u80f6\\u91cf\",\"attr_value\":\"R\\/C:68%\"},{\"goods_attr_id\":32,\"attr_name\":\"\\u5e45\\u5bbd*\\u5377\\u957f\",\"attr_value\":\"49.5\\u201c*300M\"},{\"goods_attr_id\":33,\"attr_name\":\"\\u8272\\u7cfb\",\"attr_value\":\"\\u9ec4\\u6599\"},{\"goods_attr_id\":35,\"attr_name\":\"\\u6709\\u65e0\\u6c34\\u5370\",\"attr_value\":\"\\u65e0\\u6c34\\u5370\"}]', '', '0', '', '', '', '-1', '1536217440', '1536217440');
INSERT INTO `syc_goods` VALUES ('20', '长春干膜 FF-9040S 幅宽” *600FT *2卷', '5', '4', '0', '3', 'SQFT', '0.50', '0.47', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"\\u5e45\\u5bbd\\u201d\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*2\\u5377\"}]', '', '0', '', '', '', '-1', '1537100952', '1537100952');
INSERT INTO `syc_goods` VALUES ('21', '长春干膜 FF-9040S 23.250“ *600FT *1卷', '5', '4', '0', '3', '卷', '581.25', '541.73', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"23.250\\u201c\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*1\\u5377\"}]', '', '0', '', '', '', '-1', '1537102448', '1537102448');
INSERT INTO `syc_goods` VALUES ('22', '长春干膜 FF-9040S 23.500” *600FT *1卷', '5', '4', '0', '3', '卷', '587.50', '547.55', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"23.500\\u201d\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*1\\u5377\"}]', '', '0', '', '', '', '-1', '1537102529', '1537102529');
INSERT INTO `syc_goods` VALUES ('23', '长春干膜 FF-9040S 24.000 *600FT *1卷', '5', '4', '0', '3', '卷', '600.00', '559.20', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"24.000\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*1\\u5377\"}]', '', '0', '', '', '', '-1', '1537102587', '1537102587');
INSERT INTO `syc_goods` VALUES ('24', '长春干膜 FF-9040S 24.250“ *600FT *1卷', '5', '4', '0', '3', '卷', '606.25', '565.03', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"24.250\\u201c\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*1\\u5377\"}]', '', '0', '', '', '', '-1', '1537102643', '1537102643');
INSERT INTO `syc_goods` VALUES ('25', '长春干膜 FF-9040S 11.000 *600FT *2卷', '5', '4', '0', '3', '箱', '0.00', '0.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"11.000\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*2\\u5377\"}]', '', '0', '', '', '', '1', '1538921911', '1538921911');
INSERT INTO `syc_goods` VALUES ('26', '长春干膜 FF-9040S 12.000 *600FT *2卷', '5', '4', '0', '3', '箱', '0.00', '0.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"12.000\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*2\\u5377\"}]', '', '0', '', '', '', '1', '1538922191', '1538922191');
INSERT INTO `syc_goods` VALUES ('27', '长春干膜 FF-9040S 12.500 *600FT *2卷', '5', '4', '0', '3', '箱', '0.00', '0.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"12.500\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*2\\u5377\"}]', '', '0', '', '', '', '1', '1538922371', '1538922371');
INSERT INTO `syc_goods` VALUES ('28', '长春干膜 FF-9040S 14.500 *600FT *2卷', '5', '4', '0', '3', '箱', '0.00', '0.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"14.500\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*2\\u5377\"}]', '', '0', '', '', '', '1', '1538922414', '1538922414');
INSERT INTO `syc_goods` VALUES ('29', '长春干膜 FF-9040S 14.750 *600FT *2卷', '5', '4', '0', '3', '箱', '0.00', '0.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"14.750\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*2\\u5377\"}]', '', '0', '', '', '', '1', '1538922542', '1538922542');
INSERT INTO `syc_goods` VALUES ('30', '长春干膜 FF-9040S 15.000 *600FT *2卷', '5', '4', '0', '3', '箱', '0.00', '0.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"15.000\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*2\\u5377\"}]', '', '0', '', '', '', '1', '1538922571', '1538922571');
INSERT INTO `syc_goods` VALUES ('31', '长春干膜 FF-9040S 15.500 *600FT *2卷', '5', '4', '0', '3', '箱', '0.00', '0.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"15.500\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*2\\u5377\"}]', '', '0', '', '', '', '1', '1538922610', '1538922610');
INSERT INTO `syc_goods` VALUES ('32', '长春干膜 FF-9040S 16.250 *600FT *2卷', '5', '4', '0', '3', '箱', '0.00', '0.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"16.250\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*2\\u5377\"}]', '', '0', '', '', '', '1', '1538922644', '1538922644');
INSERT INTO `syc_goods` VALUES ('33', '长春干膜 FF-9040S 17.250 *600FT *2卷', '5', '4', '0', '3', '箱', '0.00', '0.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"17.250\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*2\\u5377\"}]', '', '0', '', '', '', '1', '1538922676', '1538922676');
INSERT INTO `syc_goods` VALUES ('34', '长春干膜 FF-9040S 18.250 *600FT *2卷', '5', '4', '0', '3', '箱', '0.00', '0.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"18.250\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*2\\u5377\"}]', '', '0', '', '', '', '1', '1538922704', '1538922704');
INSERT INTO `syc_goods` VALUES ('35', '长春干膜 FF-9040S 19.000 *600FT *2卷', '5', '4', '0', '3', '箱', '0.00', '0.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"19.000\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*2\\u5377\"}]', '', '0', '', '', '', '1', '1538922739', '1538922739');
INSERT INTO `syc_goods` VALUES ('36', '长春干膜 FF-9040S 19.250 *600FT *2卷', '5', '4', '0', '3', '箱', '0.00', '0.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"19.250\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*2\\u5377\"}]', '', '0', '', '', '', '1', '1538922890', '1538922890');
INSERT INTO `syc_goods` VALUES ('37', '长春干膜 FF-9040S 19.500 *600FT *2卷', '5', '4', '0', '3', '箱', '0.00', '0.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"19.500\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*2\\u5377\"}]', '', '0', '', '', '', '1', '1538922923', '1538922923');
INSERT INTO `syc_goods` VALUES ('38', '长春干膜 FF-9040S 19.750 *600FT *2卷', '5', '4', '0', '3', '箱', '0.00', '0.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"19.750\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*2\\u5377\"}]', '', '0', '', '', '', '1', '1538922949', '1538922949');
INSERT INTO `syc_goods` VALUES ('39', '长春干膜 FF-9040S 20.000 *600FT *2卷', '5', '4', '0', '3', '箱', '0.00', '0.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"20.000\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*2\\u5377\"}]', '', '0', '', '', '', '1', '1538922977', '1538922977');
INSERT INTO `syc_goods` VALUES ('40', '长春干膜 FF-9040S 20.250 *600FT *2卷', '5', '4', '0', '3', '箱', '0.00', '0.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"20.250\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*2\\u5377\"}]', '', '0', '', '', '', '1', '1538923007', '1538923007');
INSERT INTO `syc_goods` VALUES ('41', '长春干膜 FF-9040S 20.500 *600FT *2卷', '5', '4', '0', '3', '箱', '0.00', '0.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"20.500\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*2\\u5377\"}]', '', '0', '', '', '', '1', '1538923039', '1538923039');
INSERT INTO `syc_goods` VALUES ('42', 'FR-4 TG170 1.40MM 1/1 41”*49“ 含铜厚 黄料 无水印', '1', '1', '0', '2', '张', '0.00', '0.00', '', '[{\"goods_attr_id\":12,\"attr_name\":\"\\u7c7b\\u578b\",\"attr_value\":\"FR-4\"},{\"goods_attr_id\":22,\"attr_name\":\"\\u80f6\\u7cfb\",\"attr_value\":\"TG170\"},{\"goods_attr_id\":14,\"attr_name\":\"\\u677f\\u539a\",\"attr_value\":\"1.40MM\"},{\"goods_attr_id\":16,\"attr_name\":\"\\u94dc\\u539a\",\"attr_value\":\"1\\/1\"},{\"goods_attr_id\":19,\"attr_name\":\"\\u5c3a\\u5bf8\",\"attr_value\":\"41\\u201d*49\\u201c\"},{\"goods_attr_id\":21,\"attr_name\":\"\\u662f\\u5426\\u542b\\u94dc\",\"attr_value\":\"\\u542b\\u94dc\\u539a\"},{\"goods_attr_id\":20,\"attr_name\":\"\\u8272\\u7cfb\",\"attr_value\":\"\\u9ec4\\u6599\"},{\"goods_attr_id\":23,\"attr_name\":\"\\u6709\\u65e0\\u6c34\\u5370\",\"attr_value\":\"\\u65e0\\u6c34\\u5370\"}]', '', '0', '', '', '', '1', '1538923410', '1538923410');
INSERT INTO `syc_goods` VALUES ('43', 'FR-4 TG140 1.10MM H/H 43“*49” 含铜厚 黄料 无水印', '1', '1', '0', '2', '张', '0.00', '0.00', '', '[{\"goods_attr_id\":12,\"attr_name\":\"\\u7c7b\\u578b\",\"attr_value\":\"FR-4\"},{\"goods_attr_id\":22,\"attr_name\":\"\\u80f6\\u7cfb\",\"attr_value\":\"TG140\"},{\"goods_attr_id\":14,\"attr_name\":\"\\u677f\\u539a\",\"attr_value\":\"1.10MM\"},{\"goods_attr_id\":16,\"attr_name\":\"\\u94dc\\u539a\",\"attr_value\":\"H\\/H\"},{\"goods_attr_id\":19,\"attr_name\":\"\\u5c3a\\u5bf8\",\"attr_value\":\"43\\u201c*49\\u201d\"},{\"goods_attr_id\":21,\"attr_name\":\"\\u662f\\u5426\\u542b\\u94dc\",\"attr_value\":\"\\u542b\\u94dc\\u539a\"},{\"goods_attr_id\":20,\"attr_name\":\"\\u8272\\u7cfb\",\"attr_value\":\"\\u9ec4\\u6599\"},{\"goods_attr_id\":23,\"attr_name\":\"\\u6709\\u65e0\\u6c34\\u5370\",\"attr_value\":\"\\u65e0\\u6c34\\u5370\"}]', '', '0', '', '', '', '1', '1538923508', '1538923508');
INSERT INTO `syc_goods` VALUES ('44', 'FR-4 TG140 CTI≥600 1.10MM H/H 43“*49” 含铜厚 黄料 无水印', '1', '1', '0', '2', '张', '0.00', '0.00', '', '[{\"goods_attr_id\":12,\"attr_name\":\"\\u7c7b\\u578b\",\"attr_value\":\"FR-4\"},{\"goods_attr_id\":22,\"attr_name\":\"\\u80f6\\u7cfb\",\"attr_value\":\"TG140 CTI\\u2265600\"},{\"goods_attr_id\":14,\"attr_name\":\"\\u677f\\u539a\",\"attr_value\":\"1.10MM\"},{\"goods_attr_id\":16,\"attr_name\":\"\\u94dc\\u539a\",\"attr_value\":\"H\\/H\"},{\"goods_attr_id\":19,\"attr_name\":\"\\u5c3a\\u5bf8\",\"attr_value\":\"43\\u201c*49\\u201d\"},{\"goods_attr_id\":21,\"attr_name\":\"\\u662f\\u5426\\u542b\\u94dc\",\"attr_value\":\"\\u542b\\u94dc\\u539a\"},{\"goods_attr_id\":20,\"attr_name\":\"\\u8272\\u7cfb\",\"attr_value\":\"\\u9ec4\\u6599\"},{\"goods_attr_id\":23,\"attr_name\":\"\\u6709\\u65e0\\u6c34\\u5370\",\"attr_value\":\"\\u65e0\\u6c34\\u5370\"}]', '', '0', '', '', '', '1', '1538923567', '1538923567');
INSERT INTO `syc_goods` VALUES ('45', 'FR-4 TG150 1.40MM H/H 41”*49“ 含铜厚 黄料 无水印', '1', '1', '0', '2', '张', '0.00', '0.00', '', '[{\"goods_attr_id\":12,\"attr_name\":\"\\u7c7b\\u578b\",\"attr_value\":\"FR-4\"},{\"goods_attr_id\":22,\"attr_name\":\"\\u80f6\\u7cfb\",\"attr_value\":\"TG150\"},{\"goods_attr_id\":14,\"attr_name\":\"\\u677f\\u539a\",\"attr_value\":\"1.40MM\"},{\"goods_attr_id\":16,\"attr_name\":\"\\u94dc\\u539a\",\"attr_value\":\"H\\/H\"},{\"goods_attr_id\":19,\"attr_name\":\"\\u5c3a\\u5bf8\",\"attr_value\":\"41\\u201d*49\\u201c\"},{\"goods_attr_id\":21,\"attr_name\":\"\\u662f\\u5426\\u542b\\u94dc\",\"attr_value\":\"\\u542b\\u94dc\\u539a\"},{\"goods_attr_id\":20,\"attr_name\":\"\\u8272\\u7cfb\",\"attr_value\":\"\\u9ec4\\u6599\"},{\"goods_attr_id\":23,\"attr_name\":\"\\u6709\\u65e0\\u6c34\\u5370\",\"attr_value\":\"\\u65e0\\u6c34\\u5370\"}]', '', '0', '', '', '', '1', '1538923611', '1538923611');
INSERT INTO `syc_goods` VALUES ('46', 'FR-4 TG170 1.40MM H/H 41”*49“ 含铜厚 黄料 无水印', '1', '1', '0', '2', '张', '0.00', '0.00', '', '[{\"goods_attr_id\":12,\"attr_name\":\"\\u7c7b\\u578b\",\"attr_value\":\"FR-4\"},{\"goods_attr_id\":22,\"attr_name\":\"\\u80f6\\u7cfb\",\"attr_value\":\"TG170\"},{\"goods_attr_id\":14,\"attr_name\":\"\\u677f\\u539a\",\"attr_value\":\"1.40MM\"},{\"goods_attr_id\":16,\"attr_name\":\"\\u94dc\\u539a\",\"attr_value\":\"H\\/H\"},{\"goods_attr_id\":19,\"attr_name\":\"\\u5c3a\\u5bf8\",\"attr_value\":\"41\\u201d*49\\u201c\"},{\"goods_attr_id\":21,\"attr_name\":\"\\u662f\\u5426\\u542b\\u94dc\",\"attr_value\":\"\\u542b\\u94dc\\u539a\"},{\"goods_attr_id\":20,\"attr_name\":\"\\u8272\\u7cfb\",\"attr_value\":\"\\u9ec4\\u6599\"},{\"goods_attr_id\":23,\"attr_name\":\"\\u6709\\u65e0\\u6c34\\u5370\",\"attr_value\":\"\\u65e0\\u6c34\\u5370\"}]', '', '0', '', '', '', '1', '1538923785', '1538923785');
INSERT INTO `syc_goods` VALUES ('47', 'FR-4 TG140 1.40MM H/H 37“*49” 含铜厚 黄料 无水印', '1', '1', '0', '2', '张', '0.00', '0.00', '', '[{\"goods_attr_id\":12,\"attr_name\":\"\\u7c7b\\u578b\",\"attr_value\":\"FR-4\"},{\"goods_attr_id\":22,\"attr_name\":\"\\u80f6\\u7cfb\",\"attr_value\":\"TG140\"},{\"goods_attr_id\":14,\"attr_name\":\"\\u677f\\u539a\",\"attr_value\":\"1.40MM\"},{\"goods_attr_id\":16,\"attr_name\":\"\\u94dc\\u539a\",\"attr_value\":\"H\\/H\"},{\"goods_attr_id\":19,\"attr_name\":\"\\u5c3a\\u5bf8\",\"attr_value\":\"37\\u201c*49\\u201d\"},{\"goods_attr_id\":21,\"attr_name\":\"\\u662f\\u5426\\u542b\\u94dc\",\"attr_value\":\"\\u542b\\u94dc\\u539a\"},{\"goods_attr_id\":20,\"attr_name\":\"\\u8272\\u7cfb\",\"attr_value\":\"\\u9ec4\\u6599\"},{\"goods_attr_id\":23,\"attr_name\":\"\\u6709\\u65e0\\u6c34\\u5370\",\"attr_value\":\"\\u65e0\\u6c34\\u5370\"}]', '', '0', '', '', '', '1', '1538923820', '1538923820');
INSERT INTO `syc_goods` VALUES ('48', 'FR-4 TG140 CTI≥600 1.40MM H/H 43“*49” 含铜厚 黄料 无水印', '1', '1', '0', '2', '张', '0.00', '0.00', '', '[{\"goods_attr_id\":12,\"attr_name\":\"\\u7c7b\\u578b\",\"attr_value\":\"FR-4\"},{\"goods_attr_id\":22,\"attr_name\":\"\\u80f6\\u7cfb\",\"attr_value\":\"TG140 CTI\\u2265600\"},{\"goods_attr_id\":14,\"attr_name\":\"\\u677f\\u539a\",\"attr_value\":\"1.40MM\"},{\"goods_attr_id\":16,\"attr_name\":\"\\u94dc\\u539a\",\"attr_value\":\"H\\/H\"},{\"goods_attr_id\":19,\"attr_name\":\"\\u5c3a\\u5bf8\",\"attr_value\":\"43\\u201c*49\\u201d\"},{\"goods_attr_id\":21,\"attr_name\":\"\\u662f\\u5426\\u542b\\u94dc\",\"attr_value\":\"\\u542b\\u94dc\\u539a\"},{\"goods_attr_id\":20,\"attr_name\":\"\\u8272\\u7cfb\",\"attr_value\":\"\\u9ec4\\u6599\"},{\"goods_attr_id\":23,\"attr_name\":\"\\u6709\\u65e0\\u6c34\\u5370\",\"attr_value\":\"\\u65e0\\u6c34\\u5370\"}]', '', '0', '', '', '', '1', '1538923915', '1538923915');
INSERT INTO `syc_goods` VALUES ('49', 'FR-4 TG140 1.50MM 1/0 41”*49“ 含铜厚 黄料 无水印', '1', '1', '0', '2', '张', '0.00', '0.00', '', '[{\"goods_attr_id\":12,\"attr_name\":\"\\u7c7b\\u578b\",\"attr_value\":\"FR-4\"},{\"goods_attr_id\":22,\"attr_name\":\"\\u80f6\\u7cfb\",\"attr_value\":\"TG140\"},{\"goods_attr_id\":14,\"attr_name\":\"\\u677f\\u539a\",\"attr_value\":\"1.50MM\"},{\"goods_attr_id\":16,\"attr_name\":\"\\u94dc\\u539a\",\"attr_value\":\"1\\/0\"},{\"goods_attr_id\":19,\"attr_name\":\"\\u5c3a\\u5bf8\",\"attr_value\":\"41\\u201d*49\\u201c\"},{\"goods_attr_id\":21,\"attr_name\":\"\\u662f\\u5426\\u542b\\u94dc\",\"attr_value\":\"\\u542b\\u94dc\\u539a\"},{\"goods_attr_id\":20,\"attr_name\":\"\\u8272\\u7cfb\",\"attr_value\":\"\\u9ec4\\u6599\"},{\"goods_attr_id\":23,\"attr_name\":\"\\u6709\\u65e0\\u6c34\\u5370\",\"attr_value\":\"\\u65e0\\u6c34\\u5370\"}]', '', '0', '', '', '', '1', '1538923958', '1538923958');
INSERT INTO `syc_goods` VALUES ('50', 'FR-4 TG170 1.40MM 1/1 41”*49“ 含铜厚 黄料 无水印', '1', '1', '0', '2', '张', '0.00', '0.00', '', '[{\"goods_attr_id\":12,\"attr_name\":\"\\u7c7b\\u578b\",\"attr_value\":\"FR-4\"},{\"goods_attr_id\":22,\"attr_name\":\"\\u80f6\\u7cfb\",\"attr_value\":\"TG170\"},{\"goods_attr_id\":14,\"attr_name\":\"\\u677f\\u539a\",\"attr_value\":\"1.40MM\"},{\"goods_attr_id\":16,\"attr_name\":\"\\u94dc\\u539a\",\"attr_value\":\"1\\/1\"},{\"goods_attr_id\":19,\"attr_name\":\"\\u5c3a\\u5bf8\",\"attr_value\":\"41\\u201d*49\\u201c\"},{\"goods_attr_id\":21,\"attr_name\":\"\\u662f\\u5426\\u542b\\u94dc\",\"attr_value\":\"\\u542b\\u94dc\\u539a\"},{\"goods_attr_id\":20,\"attr_name\":\"\\u8272\\u7cfb\",\"attr_value\":\"\\u9ec4\\u6599\"},{\"goods_attr_id\":23,\"attr_name\":\"\\u6709\\u65e0\\u6c34\\u5370\",\"attr_value\":\"\\u65e0\\u6c34\\u5370\"}]', '', '0', '', '', '', '1', '1538924003', '1538924003');
INSERT INTO `syc_goods` VALUES ('51', 'TG150 PP7628 R/C:50% 49.5“*150M 黄料 无水印', '1', '22', '0', '2', '卷', '0.00', '0.00', '', '[{\"goods_attr_id\":30,\"attr_name\":\"\\u80f6\\u7cfb\",\"attr_value\":\"TG150\"},{\"goods_attr_id\":29,\"attr_name\":\"\\u5e03\\u79cd\",\"attr_value\":\"PP7628\"},{\"goods_attr_id\":31,\"attr_name\":\"\\u542b\\u80f6\\u91cf\",\"attr_value\":\"R\\/C:50%\"},{\"goods_attr_id\":32,\"attr_name\":\"\\u5e45\\u5bbd*\\u5377\\u957f\",\"attr_value\":\"49.5\\u201c*150M\"},{\"goods_attr_id\":33,\"attr_name\":\"\\u8272\\u7cfb\",\"attr_value\":\"\\u9ec4\\u6599\"},{\"goods_attr_id\":35,\"attr_name\":\"\\u6709\\u65e0\\u6c34\\u5370\",\"attr_value\":\"\\u65e0\\u6c34\\u5370\"}]', '', '0', '', '', '', '1', '1538924103', '1539019044');
INSERT INTO `syc_goods` VALUES ('52', 'TG140 PP1080 R/C:68% 49.5“*300M 黄料 无水印', '11', '22', '0', '2', '卷', '0.00', '0.00', '', '[{\"goods_attr_id\":30,\"attr_name\":\"\\u80f6\\u7cfb\",\"attr_value\":\"TG140\"},{\"goods_attr_id\":29,\"attr_name\":\"\\u5e03\\u79cd\",\"attr_value\":\"PP1080\"},{\"goods_attr_id\":31,\"attr_name\":\"\\u542b\\u80f6\\u91cf\",\"attr_value\":\"R\\/C:68%\"},{\"goods_attr_id\":32,\"attr_name\":\"\\u5e45\\u5bbd*\\u5377\\u957f\",\"attr_value\":\"49.5\\u201c*300M\"},{\"goods_attr_id\":33,\"attr_name\":\"\\u8272\\u7cfb\",\"attr_value\":\"\\u9ec4\\u6599\"},{\"goods_attr_id\":35,\"attr_name\":\"\\u6709\\u65e0\\u6c34\\u5370\",\"attr_value\":\"\\u65e0\\u6c34\\u5370\"}]', '', '0', '', '', '', '1', '1538924147', '1538924147');
INSERT INTO `syc_goods` VALUES ('53', '长春干膜 FF-9040S 14.000 *600FT *2卷', '5', '4', '0', '3', '箱', '0.00', '0.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"14.000\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*2\\u5377\"}]', '', '0', '', '', '', '1', '1539009021', '1539009021');
INSERT INTO `syc_goods` VALUES ('54', '长春干膜 FF-9040S 18.500 *600FT *2卷', '5', '4', '0', '3', '箱', '0.00', '0.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"18.500\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*2\\u5377\"}]', '2', '0', '寄存', '四川众山', '惠阳仓库', '1', '1539009049', '1539052770');
INSERT INTO `syc_goods` VALUES ('55', '长春干膜 FF-9040S 21.000 *600FT *2卷', '5', '4', '0', '3', '箱', '0.00', '0.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"21.000\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*2\\u5377\"}]', '', '0', '', '', '', '1', '1539049530', '1539049530');
INSERT INTO `syc_goods` VALUES ('56', '长春干膜 FF-9040S 21.250 *600FT *2卷', '5', '4', '0', '3', '箱', '0.00', '0.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"21.250\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*2\\u5377\"}]', '', '0', '', '', '', '1', '1539049577', '1539049577');
INSERT INTO `syc_goods` VALUES ('57', '长春干膜 FF-9040S 21.500 *600FT *2卷', '5', '4', '0', '3', '箱', '0.00', '0.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"21.500\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*2\\u5377\"}]', '', '0', '', '', '', '1', '1539049613', '1539049613');
INSERT INTO `syc_goods` VALUES ('58', '长春干膜 FF-9040S 21.750 *600FT *2卷', '5', '4', '0', '3', '箱', '0.00', '0.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"21.750\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*2\\u5377\"}]', '', '0', '', '', '', '1', '1539049654', '1539049654');
INSERT INTO `syc_goods` VALUES ('59', '长春干膜 FF-9040S 22.000 *600FT *2卷', '5', '4', '0', '3', '箱', '0.00', '0.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"22.000\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*2\\u5377\"}]', '', '0', '', '', '', '1', '1539049707', '1539049707');
INSERT INTO `syc_goods` VALUES ('60', '长春干膜 FF-9040S 22.250 *600FT *2卷', '5', '4', '0', '3', '箱', '0.00', '0.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"22.250\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*2\\u5377\"}]', '', '0', '', '', '', '1', '1539049767', '1539049767');
INSERT INTO `syc_goods` VALUES ('61', '长春干膜 FF-9040S 22.500 *600FT *2卷', '5', '4', '0', '3', '箱', '0.00', '0.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"22.500\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*2\\u5377\"}]', '', '0', '', '', '', '1', '1539049819', '1539049819');
INSERT INTO `syc_goods` VALUES ('62', '长春干膜 FF-9040S 22.750 *600FT *2卷', '5', '4', '0', '3', '箱', '0.00', '0.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"22.750\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*2\\u5377\"}]', '', '0', '', '', '', '1', '1539049845', '1539049845');
INSERT INTO `syc_goods` VALUES ('63', '长春干膜 FF-9040S 23.000 *600FT *2卷', '5', '4', '0', '3', '箱', '0.00', '0.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"23.000\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*2\\u5377\"}]', '', '0', '', '', '', '1', '1539049869', '1539049869');
INSERT INTO `syc_goods` VALUES ('64', '长春干膜 FF-9040S 23.250 *600FT *2卷', '5', '4', '0', '3', '箱', '0.00', '0.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"23.250\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*2\\u5377\"}]', '', '0', '', '', '', '1', '1539049963', '1539049963');
INSERT INTO `syc_goods` VALUES ('65', '长春干膜 FF-9040S 23.500 *600FT *2卷', '5', '4', '0', '3', '箱', '0.00', '0.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"23.500\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*2\\u5377\"}]', '', '0', '', '', '', '1', '1539049988', '1539049988');
INSERT INTO `syc_goods` VALUES ('66', '长春干膜 FF-9040S 23.750 *600FT *2卷', '5', '4', '0', '3', '箱', '0.00', '0.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"23.750\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*2\\u5377\"}]', '', '0', '', '', '', '1', '1539050016', '1539050016');
INSERT INTO `syc_goods` VALUES ('67', '长春干膜 FF-9040S 24.000 *600FT *2卷', '5', '4', '0', '3', '箱', '0.00', '0.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"24.000\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*2\\u5377\"}]', '', '0', '', '', '', '1', '1539050037', '1539050037');
INSERT INTO `syc_goods` VALUES ('68', '长春干膜 FF-9040S 24.250 *600FT *2卷', '5', '4', '0', '3', '箱', '0.00', '0.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"24.250\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*2\\u5377\"}]', '', '0', '', '', '', '1', '1539050060', '1539050060');
INSERT INTO `syc_goods` VALUES ('69', '长春干膜 FF-9040S 24.500 *600FT *2卷', '5', '4', '0', '3', '箱', '0.00', '0.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"24.500\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*2\\u5377\"}]', '', '0', '', '', '', '1', '1539050091', '1539050091');
INSERT INTO `syc_goods` VALUES ('70', '长春干膜 FF-9040S 24.750 *600FT *2卷', '5', '4', '0', '3', '箱', '0.00', '0.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"24.750\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*2\\u5377\"}]', '', '0', '', '', '', '1', '1539050115', '1539050115');
INSERT INTO `syc_goods` VALUES ('71', '长春干膜 FF-9040S 25.000 *600FT *2卷', '5', '4', '0', '3', '箱', '0.00', '0.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"25.000\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*2\\u5377\"}]', '', '0', '', '', '', '1', '1539050161', '1539050161');
INSERT INTO `syc_goods` VALUES ('72', '长春干膜 FF-9040S 15.250 *600FT *1卷', '5', '4', '0', '3', '卷', '0.00', '0.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"15.250\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*1\\u5377\"}]', '', '0', '', '', '', '1', '1539053130', '1539053130');
INSERT INTO `syc_goods` VALUES ('73', '长春干膜 FF-9040S 18.000 *600FT *1卷', '5', '4', '0', '3', '卷', '0.00', '0.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"18.000\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*1\\u5377\"}]', '', '0', '', '', '', '1', '1539053154', '1539055350');
INSERT INTO `syc_goods` VALUES ('74', '长春干膜 FF-9040S 19.250 *600FT *1卷', '5', '4', '0', '3', '卷', '0.00', '0.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"19.250\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*1\\u5377\"}]', '', '0', '', '', '', '1', '1539053186', '1539053186');
INSERT INTO `syc_goods` VALUES ('75', '长春干膜 FF-9040S 20.000 *600FT *1卷', '5', '4', '0', '3', '卷', '0.00', '0.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"20.000\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*1\\u5377\"}]', '', '0', '', '', '', '1', '1539053246', '1539053246');
INSERT INTO `syc_goods` VALUES ('76', '长春干膜 FF-9040S 20.250 *600FT *1卷', '5', '4', '0', '3', '卷', '0.00', '0.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"20.250\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*1\\u5377\"}]', '', '0', '', '', '', '1', '1539053272', '1539053272');
INSERT INTO `syc_goods` VALUES ('77', '长春干膜 FF-9040S 21.500 *600FT *1卷', '5', '4', '0', '3', '卷', '0.00', '0.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"21.500\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*1\\u5377\"}]', '', '0', '', '', '', '1', '1539053294', '1539053294');
INSERT INTO `syc_goods` VALUES ('78', '长春干膜 FF-9040S 22.000 *600FT *1卷', '5', '4', '0', '3', '卷', '0.00', '0.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"22.000\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*1\\u5377\"}]', '', '0', '', '', '', '1', '1539053319', '1539053319');
INSERT INTO `syc_goods` VALUES ('79', '长春干膜 FF-9040S 22.250 *600FT *1卷', '5', '4', '0', '3', '卷', '0.00', '0.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"22.250\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*1\\u5377\"}]', '', '0', '', '', '', '1', '1539053342', '1539053342');
INSERT INTO `syc_goods` VALUES ('80', '长春干膜 FF-9040S 22.500 *600FT *1卷', '5', '4', '0', '3', '卷', '0.00', '0.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"22.500\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*1\\u5377\"}]', '', '0', '', '', '', '1', '1539053396', '1539053396');
INSERT INTO `syc_goods` VALUES ('81', '长春干膜 FF-9040S 23.000 *600FT *1卷', '5', '4', '0', '3', '卷', '0.00', '0.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"23.000\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*1\\u5377\"}]', '', '0', '', '', '', '1', '1539053422', '1539053422');
INSERT INTO `syc_goods` VALUES ('82', '长春干膜 FF-9040S 23.250 *600FT *1卷', '5', '4', '0', '3', '卷', '0.00', '0.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"23.250\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*1\\u5377\"}]', '', '0', '', '', '', '1', '1539053448', '1539053448');
INSERT INTO `syc_goods` VALUES ('83', '长春干膜 FF-9040S 23.500 *600FT *1卷', '5', '4', '0', '3', '卷', '0.00', '0.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"23.500\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*1\\u5377\"}]', '', '0', '', '', '', '1', '1539053472', '1539053472');
INSERT INTO `syc_goods` VALUES ('84', '长春干膜 FF-9040S 24.250 *600FT *1卷', '5', '4', '0', '3', '卷', '0.00', '0.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"24.250\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*1\\u5377\"}]', '', '0', '', '', '', '1', '1539053707', '1539053707');
INSERT INTO `syc_goods` VALUES ('85', '长春干膜 FF-9040S 24.500 *600FT *1卷', '5', '4', '0', '3', '卷', '0.00', '0.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"24.500\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*1\\u5377\"}]', '', '0', '', '', '', '1', '1539053745', '1539053745');
INSERT INTO `syc_goods` VALUES ('86', '长春干膜 FF-9050S 22.250 *500FT *2卷', '5', '4', '0', '3', '箱', '0.00', '0.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9050S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"22.250\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*500FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*2\\u5377\"}]', '', '0', '', '', '', '1', '1539053872', '1539053872');
INSERT INTO `syc_goods` VALUES ('87', '长春干膜 FF-9050S 23.750 *500FT *2卷', '5', '4', '0', '3', '箱', '0.00', '0.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9050S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"23.750\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*500FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*2\\u5377\"}]', '', '0', '', '', '', '1', '1539053907', '1539053907');
INSERT INTO `syc_goods` VALUES ('88', '长春干膜 FF-9050S 21.250 *500FT *2卷', '5', '4', '0', '3', '卷', '0.00', '0.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9050S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"21.250\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*500FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*2\\u5377\"}]', '', '0', '', '', '', '1', '1539053942', '1539053942');
INSERT INTO `syc_goods` VALUES ('89', '长春干膜 FF-9050S 23.000 *500FT *2卷', '5', '4', '0', '3', '箱', '0.00', '0.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9050S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"23.000\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*500FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*2\\u5377\"}]', '', '0', '', '', '', '1', '1539053965', '1539053965');
INSERT INTO `syc_goods` VALUES ('90', '长春干膜 FF-9050S 17.250 *500FT *2卷', '5', '4', '0', '3', '箱', '0.00', '0.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9050S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"17.250\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*500FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*2\\u5377\"}]', '', '0', '', '', '', '1', '1539054004', '1539054082');
INSERT INTO `syc_goods` VALUES ('91', '长春干膜 FF-9050S 22.750 *500FT *2卷', '5', '4', '0', '3', '箱', '0.00', '0.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9050S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"22.750\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*500FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*2\\u5377\"}]', '', '0', '', '', '', '1', '1539054035', '1539054035');
INSERT INTO `syc_goods` VALUES ('92', '长春干膜 FF-9040S 24.000 *600FT *1卷', '5', '4', '0', '3', '卷', '0.00', '0.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"24.000\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*1\\u5377\"}]', '', '0', '', '', '', '1', '1539054145', '1539054145');
INSERT INTO `syc_goods` VALUES ('93', '长春干膜 FF-9040S 21.000 *600FT *1卷', '5', '4', '0', '3', '卷', '0.00', '0.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"21.000\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*1\\u5377\"}]', '', '0', '', '', '', '1', '1539058468', '1539058468');
INSERT INTO `syc_goods` VALUES ('94', '长春干膜 FF-9040S 21.250 *600FT *1卷', '5', '4', '0', '3', '卷', '0.00', '0.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"21.250\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*1\\u5377\"}]', '', '0', '', '', '', '1', '1539058491', '1539058491');
INSERT INTO `syc_goods` VALUES ('95', '长春干膜 FF-9040S 16.750 *600FT *1卷', '5', '4', '0', '3', '卷', '0.00', '0.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"16.750\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*1\\u5377\"}]', '', '0', '', '', '', '1', '1539058562', '1539058562');
INSERT INTO `syc_goods` VALUES ('96', '长春干膜 FF-9040S 18.250 *600FT *1卷', '5', '4', '0', '3', '卷', '0.00', '0.00', '', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"18.250\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*1\\u5377\"}]', '', '0', '', '', '', '1', '1539058843', '1539058843');

-- ----------------------------
-- Table structure for syc_goods_attr
-- ----------------------------
DROP TABLE IF EXISTS `syc_goods_attr`;
CREATE TABLE `syc_goods_attr` (
  `goods_attr_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `attr_name` varchar(100) DEFAULT NULL,
  `attr_value` text,
  `attr_type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0参数，1规格',
  `sort` smallint(6) unsigned DEFAULT '0',
  `goods_type_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品类型ID',
  PRIMARY KEY (`goods_attr_id`),
  KEY `goods_type_id` (`goods_type_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of syc_goods_attr
-- ----------------------------
INSERT INTO `syc_goods_attr` VALUES ('1', '操作系统', '安卓（Android）\r\n苹果（IOS）\n微软（WindowsPhone）\n基础功能机系统\r\n其他', '0', '1', '1');
INSERT INTO `syc_goods_attr` VALUES ('2', '屏幕尺寸', '5.6英寸及以上\n5.5-5.1英寸\n5.0-4.6英寸\n4.5-3.1英寸\n3.0英寸及以下', '0', '50', '1');
INSERT INTO `syc_goods_attr` VALUES ('3', 'CPU核数', '十核\n八核\n双四核\n四核\n双核\n单核\n功能机\n其他', '0', '50', '1');
INSERT INTO `syc_goods_attr` VALUES ('4', '手机价格', '500元以下\n500-1000元\n1000-1500元\n1500-2000元\n2000-2500元\n2500-3000元\n3000-3500元\n3500-4000元\n4500-5000元\n5000元以上', '0', '50', '1');
INSERT INTO `syc_goods_attr` VALUES ('5', '网络类型', '移动4G/联通4G/电信4G\n移动4G+\n移动4G\n联通4G\n电信4G\n双卡单4G\n双卡双4G\n双卡2G网络', '0', '50', '1');
INSERT INTO `syc_goods_attr` VALUES ('6', '机身内存', '256GB\n128GB\n64GB\n32GB\n16GB\n8GB\n8GB以下\n支持内存卡', '0', '50', '1');
INSERT INTO `syc_goods_attr` VALUES ('7', '运行内存', '8GB\n6GB\n4GB\n3GB\n2GB\n2GB以下', '0', '50', '1');
INSERT INTO `syc_goods_attr` VALUES ('8', '电池容量', '1200mAh以下\n1200mAh-1999mAh\n2000mAh-2999mAh\n3000mAh-3999mAh\n4000mAh-5999mAh\n6000mAh及以上', '0', '50', '1');
INSERT INTO `syc_goods_attr` VALUES ('9', '前置摄像头像素', '1600万及以上\n800万-1599万\n500万-799万\n200万-499万\n120万-199万\n120万以下无', '0', '50', '1');
INSERT INTO `syc_goods_attr` VALUES ('10', '后置摄像头像素', '后置双摄像头\n2000万及以上\n1200万-1999万\n500万-1199万\n500万以下无', '0', '50', '1');
INSERT INTO `syc_goods_attr` VALUES ('11', '机身颜色', '白色\n黑色\n灰色\n金色\n银色\n红色\n蓝色\n粉色\n黄色\n绿色\n紫色', '0', '50', '1');
INSERT INTO `syc_goods_attr` VALUES ('12', '类型', 'FR-4\nFR-1\nCEM-1\nCEM-3', '1', '1', '1');
INSERT INTO `syc_goods_attr` VALUES ('20', '色系', '黄料\n白料', '1', '7', '1');
INSERT INTO `syc_goods_attr` VALUES ('29', '布种', 'PP7628\nPP2116\nPP1080', '1', '2', '22');
INSERT INTO `syc_goods_attr` VALUES ('19', '尺寸', '37“*49”\n41”*49“\n43“*49”\n37“*49.5”\n41“*49.5”\n43“*49.5”\n\n', '1', '5', '1');
INSERT INTO `syc_goods_attr` VALUES ('14', '板厚', '0.50MM\n0.60MM\n0.70MM\n0.80MM\n0.90MM\n1.00MM\n1.10MM\n1.20MM\n1.30MM\n1.40MM\n1.50MM\n1.60MM\n2.00MM', '1', '3', '1');
INSERT INTO `syc_goods_attr` VALUES ('16', '铜厚', 'H/H\n1/1\n2/2\n3/3\n0/0\nH/0\n1/0\n2/0\n', '1', '4', '1');
INSERT INTO `syc_goods_attr` VALUES ('24', '品牌', '长春干膜\n长兴干膜\n', '1', '1', '4');
INSERT INTO `syc_goods_attr` VALUES ('21', '是否含铜', '含铜厚\n不含铜厚', '1', '6', '1');
INSERT INTO `syc_goods_attr` VALUES ('22', '胶系', 'TG135\nTG140\nTG150\nTG170\n无卤素\nCTI≥600\nTG140 CTI≥600\n', '1', '2', '1');
INSERT INTO `syc_goods_attr` VALUES ('23', '有无水印', '无水印\n有水印\n', '1', '8', '1');
INSERT INTO `syc_goods_attr` VALUES ('25', '型号', 'FF-9040S\nFF-9050S\nFF-5040\nFF-9020', '1', '2', '4');
INSERT INTO `syc_goods_attr` VALUES ('26', '幅宽', '11.000\"\n11.500\"\n12.000\"\n12.500\"\n13.000\"\n13.500\"\n14.000\"\n14.250\"\n14.500\"\n14.750\"\n15.000\"\n15.250\"\n15.500\"\n16.000\"\n16.250\"\n16.500\"\n16.750\"\n17.000\"\n17.250\"\n17.500\"\n18.000\"\n18.250\"\n18.500\"\n19.000\"\n19.250\"\n19.500\"\n19.750\"\n20.000\"\n20.250\"\n20.125\"\n20.250\"\n20.500\"\n20.750\"\n21.000\"\n21.250\"\n21.500\"\n21.750\"\n22.000\"\n22.250\"\n22.500\"\n22.750\"\n23.000\"\n23.250\"\n23.500\"\n23.750\"\n24.000\"\n24.250\"\n24.500\"\n24.750\"\n25.000\"', '1', '3', '4');
INSERT INTO `syc_goods_attr` VALUES ('27', '卷长', '*300FT\n*328FT\n*500FT\n*600FT\n*656FT', '1', '4', '4');
INSERT INTO `syc_goods_attr` VALUES ('28', '卷/箱', '*2卷\n*1卷', '1', '5', '4');
INSERT INTO `syc_goods_attr` VALUES ('30', '胶系', 'TG135\nTG140\nTG150\nTG170\n无卤素\nCTI≥600\n', '1', '1', '22');
INSERT INTO `syc_goods_attr` VALUES ('31', '含胶量', 'R/C:43%\nR/C:45%\nR/C:48%\nR/C:50%\nR/C:53%\nR/C:55%\nR/C:58%\nR/C:63%\nR/C:65%\nR/C:68%', '1', '3', '22');
INSERT INTO `syc_goods_attr` VALUES ('32', '幅宽*卷长', '49.5“*150M\n49.5“*300M', '1', '4', '22');
INSERT INTO `syc_goods_attr` VALUES ('33', '色系', '黄料\n白料', '1', '5', '22');
INSERT INTO `syc_goods_attr` VALUES ('35', '有无水印', '无水印\n有水印', '1', '6', '22');

-- ----------------------------
-- Table structure for syc_goods_attr_val
-- ----------------------------
DROP TABLE IF EXISTS `syc_goods_attr_val`;
CREATE TABLE `syc_goods_attr_val` (
  `goods_id` int(10) unsigned NOT NULL DEFAULT '0',
  `goods_attr_id` int(10) unsigned NOT NULL DEFAULT '0',
  `attr_name` varchar(255) NOT NULL DEFAULT '',
  `attr_value` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of syc_goods_attr_val
-- ----------------------------
INSERT INTO `syc_goods_attr_val` VALUES ('4', '12', '颜色', '白色');
INSERT INTO `syc_goods_attr_val` VALUES ('4', '13', '网络制式', '移动4G/联通4G/电信4G');
INSERT INTO `syc_goods_attr_val` VALUES ('4', '14', '套餐', '套餐二');
INSERT INTO `syc_goods_attr_val` VALUES ('4', '16', 'ab', 'php');
INSERT INTO `syc_goods_attr_val` VALUES ('7', '12', '颜色', '黑色');
INSERT INTO `syc_goods_attr_val` VALUES ('7', '13', '网络制式', '双卡单4G');
INSERT INTO `syc_goods_attr_val` VALUES ('7', '14', '套餐', '套餐三');
INSERT INTO `syc_goods_attr_val` VALUES ('7', '16', 'ab', 'php');
INSERT INTO `syc_goods_attr_val` VALUES ('10', '12', '颜色', '白色');
INSERT INTO `syc_goods_attr_val` VALUES ('10', '13', '网络制式', '移动4G/联通4G/电信4G');
INSERT INTO `syc_goods_attr_val` VALUES ('10', '14', '套餐', '套餐一');
INSERT INTO `syc_goods_attr_val` VALUES ('10', '16', 'ab', 'ab');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '12', '颜色', '白色');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '13', '网络制式', '移动4G/联通4G/电信4G');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '14', '套餐', '套餐二');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '16', 'ab', 'php');
INSERT INTO `syc_goods_attr_val` VALUES ('9', '12', '类型', 'FR-4');
INSERT INTO `syc_goods_attr_val` VALUES ('9', '22', '胶系', 'TG135');
INSERT INTO `syc_goods_attr_val` VALUES ('9', '14', '板厚', '1.00MM');
INSERT INTO `syc_goods_attr_val` VALUES ('9', '16', '铜厚', 'H/H');
INSERT INTO `syc_goods_attr_val` VALUES ('9', '19', '尺寸', '37“*49”');
INSERT INTO `syc_goods_attr_val` VALUES ('9', '21', '是否含铜', '含铜厚');
INSERT INTO `syc_goods_attr_val` VALUES ('9', '20', '色系', '黄料');
INSERT INTO `syc_goods_attr_val` VALUES ('9', '23', '有无水印', '无水印');
INSERT INTO `syc_goods_attr_val` VALUES ('9', '13', '品牌', '德凯');
INSERT INTO `syc_goods_attr_val` VALUES ('8', '12', '类型', 'FR-4');
INSERT INTO `syc_goods_attr_val` VALUES ('8', '22', '胶系', 'CTI≥600');
INSERT INTO `syc_goods_attr_val` VALUES ('8', '14', '板厚', '1.10MM');
INSERT INTO `syc_goods_attr_val` VALUES ('8', '16', '铜厚', 'H/H');
INSERT INTO `syc_goods_attr_val` VALUES ('8', '19', '尺寸', '41”*49“');
INSERT INTO `syc_goods_attr_val` VALUES ('8', '21', '是否含铜', '含铜厚');
INSERT INTO `syc_goods_attr_val` VALUES ('8', '20', '色系', '黄料');
INSERT INTO `syc_goods_attr_val` VALUES ('8', '23', '有无水印', '无水印');
INSERT INTO `syc_goods_attr_val` VALUES ('8', '13', '品牌', '德凯');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '22.000');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '2');
INSERT INTO `syc_goods_attr_val` VALUES ('12', '24', '品牌', '长春');
INSERT INTO `syc_goods_attr_val` VALUES ('12', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('12', '26', '幅宽', '22.000');
INSERT INTO `syc_goods_attr_val` VALUES ('12', '27', '卷长', '600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('12', '28', '卷/箱', '2');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9050S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '16.000');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '500FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '2');
INSERT INTO `syc_goods_attr_val` VALUES ('11', '24', '品牌', '长春');
INSERT INTO `syc_goods_attr_val` VALUES ('11', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('11', '26', '幅宽', '20.250');
INSERT INTO `syc_goods_attr_val` VALUES ('11', '27', '卷长', '300');
INSERT INTO `syc_goods_attr_val` VALUES ('11', '28', '卷/箱', '2');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '12', '类型', 'FR-4');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '22', '胶系', 'TG140 CTI≥600');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '14', '板厚', '1.00MM');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '16', '铜厚', 'H/H');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '19', '尺寸', '41”*49“');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '21', '是否含铜', '含铜厚');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '20', '色系', '黄料');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '23', '有无水印', '无水印');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '12', '类型', 'FR-4');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '22', '胶系', 'TG135');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '14', '板厚', '1.50MM');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '16', '铜厚', '2/0');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '19', '尺寸', '41”*49“');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '21', '是否含铜', '含铜厚');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '20', '色系', '黄料');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '23', '有无水印', '无水印');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '20.125');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '600');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '2');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '18.000');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '2');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '24.500');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*1卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '30', '胶系', 'TG170');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '29', '布种', 'PP1080');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '31', '含胶量', 'R/C:68%');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '32', '幅宽*卷长', '49.5“*300M');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '33', '色系', '黄料');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '35', '有无水印', '无水印');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '幅宽”');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*2卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '23.250“');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*1卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '23.500”');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*1卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '24.000');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*1卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '24.250“');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*1卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '11.000');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*2卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '12.000');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*2卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '12.500');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*2卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '14.500');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*2卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '14.750');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*2卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '15.000');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*2卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '15.500');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*2卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '16.250');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*2卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '17.250');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*2卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '18.250');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*2卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '19.000');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*2卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '19.250');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*2卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '19.500');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*2卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '19.750');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*2卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '20.000');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*2卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '20.250');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*2卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '20.500');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*2卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '12', '类型', 'FR-4');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '22', '胶系', 'TG170');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '14', '板厚', '1.40MM');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '16', '铜厚', '1/1');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '19', '尺寸', '41”*49“');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '21', '是否含铜', '含铜厚');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '20', '色系', '黄料');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '23', '有无水印', '无水印');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '12', '类型', 'FR-4');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '22', '胶系', 'TG140');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '14', '板厚', '1.10MM');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '16', '铜厚', 'H/H');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '19', '尺寸', '43“*49”');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '21', '是否含铜', '含铜厚');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '20', '色系', '黄料');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '23', '有无水印', '无水印');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '12', '类型', 'FR-4');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '22', '胶系', 'TG140 CTI≥600');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '14', '板厚', '1.10MM');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '16', '铜厚', 'H/H');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '19', '尺寸', '43“*49”');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '21', '是否含铜', '含铜厚');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '20', '色系', '黄料');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '23', '有无水印', '无水印');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '12', '类型', 'FR-4');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '22', '胶系', 'TG150');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '14', '板厚', '1.40MM');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '16', '铜厚', 'H/H');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '19', '尺寸', '41”*49“');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '21', '是否含铜', '含铜厚');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '20', '色系', '黄料');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '23', '有无水印', '无水印');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '12', '类型', 'FR-4');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '22', '胶系', 'TG170');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '14', '板厚', '1.40MM');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '16', '铜厚', 'H/H');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '19', '尺寸', '41”*49“');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '21', '是否含铜', '含铜厚');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '20', '色系', '黄料');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '23', '有无水印', '无水印');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '12', '类型', 'FR-4');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '22', '胶系', 'TG140');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '14', '板厚', '1.40MM');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '16', '铜厚', 'H/H');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '19', '尺寸', '37“*49”');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '21', '是否含铜', '含铜厚');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '20', '色系', '黄料');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '23', '有无水印', '无水印');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '12', '类型', 'FR-4');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '22', '胶系', 'TG140 CTI≥600');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '14', '板厚', '1.40MM');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '16', '铜厚', 'H/H');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '19', '尺寸', '43“*49”');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '21', '是否含铜', '含铜厚');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '20', '色系', '黄料');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '23', '有无水印', '无水印');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '12', '类型', 'FR-4');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '22', '胶系', 'TG140');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '14', '板厚', '1.50MM');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '16', '铜厚', '1/0');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '19', '尺寸', '41”*49“');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '21', '是否含铜', '含铜厚');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '20', '色系', '黄料');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '23', '有无水印', '无水印');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '12', '类型', 'FR-4');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '22', '胶系', 'TG170');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '14', '板厚', '1.40MM');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '16', '铜厚', '1/1');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '19', '尺寸', '41”*49“');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '21', '是否含铜', '含铜厚');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '20', '色系', '黄料');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '23', '有无水印', '无水印');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '30', '胶系', 'TG150');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '29', '布种', 'PP7628');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '31', '含胶量', 'R/C:50%');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '32', '幅宽*卷长', '49.5“*150M');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '33', '色系', '黄料');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '35', '有无水印', '无水印');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '30', '胶系', 'TG140');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '29', '布种', 'PP1080');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '31', '含胶量', 'R/C:68%');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '32', '幅宽*卷长', '49.5“*300M');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '33', '色系', '黄料');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '35', '有无水印', '无水印');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '14.000');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*2卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '18.500');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*2卷');
INSERT INTO `syc_goods_attr_val` VALUES ('51', '30', '胶系', 'TG150');
INSERT INTO `syc_goods_attr_val` VALUES ('51', '29', '布种', 'PP7628');
INSERT INTO `syc_goods_attr_val` VALUES ('51', '31', '含胶量', 'R/C:50%');
INSERT INTO `syc_goods_attr_val` VALUES ('51', '32', '幅宽*卷长', '49.5“*150M');
INSERT INTO `syc_goods_attr_val` VALUES ('51', '33', '色系', '黄料');
INSERT INTO `syc_goods_attr_val` VALUES ('51', '35', '有无水印', '无水印');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '21.000');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*2卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '21.250');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*2卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '21.500');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*2卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '21.750');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*2卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '22.000');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*2卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '22.250');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*2卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '22.500');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*2卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '22.750');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*2卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '23.000');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*2卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '23.250');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*2卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '23.500');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*2卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '23.750');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*2卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '24.000');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*2卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '24.250');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*2卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '24.500');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*2卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '24.750');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*2卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '25.000');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*2卷');
INSERT INTO `syc_goods_attr_val` VALUES ('54', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('54', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('54', '26', '幅宽', '18.500');
INSERT INTO `syc_goods_attr_val` VALUES ('54', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('54', '28', '卷/箱', '*2卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '15.250');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*1卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '18.000');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*1卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '19.250');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*1卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '20.000');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*1卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '20.250');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*1卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '21.500');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*1卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '22.000');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*1卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '22.250');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*1卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '22.500');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*1卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '23.000');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*1卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '23.250');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*1卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '23.500');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*1卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '24.250');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*1卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '24.500');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*1卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9050S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '22.250');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*500FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*2卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9050S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '23.750');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*500FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*2卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9050S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '21.250');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*500FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*2卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9050S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '23.000');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*500FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*2卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9050S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '17.250');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*1卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9050S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '22.750');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*500FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*2卷');
INSERT INTO `syc_goods_attr_val` VALUES ('90', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('90', '25', '型号', 'FF-9050S');
INSERT INTO `syc_goods_attr_val` VALUES ('90', '26', '幅宽', '17.250');
INSERT INTO `syc_goods_attr_val` VALUES ('90', '27', '卷长', '*500FT');
INSERT INTO `syc_goods_attr_val` VALUES ('90', '28', '卷/箱', '*2卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '24.000');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*1卷');
INSERT INTO `syc_goods_attr_val` VALUES ('73', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('73', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('73', '26', '幅宽', '18.000');
INSERT INTO `syc_goods_attr_val` VALUES ('73', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('73', '28', '卷/箱', '*1卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '21.000');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*1卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '21.250');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*1卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '16.750');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*1卷');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '24', '品牌', '长春干膜');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '25', '型号', 'FF-9040S');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '26', '幅宽', '18.250');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '27', '卷长', '*600FT');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '28', '卷/箱', '*1卷');

-- ----------------------------
-- Table structure for syc_goods_brand
-- ----------------------------
DROP TABLE IF EXISTS `syc_goods_brand`;
CREATE TABLE `syc_goods_brand` (
  `brand_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(100) NOT NULL DEFAULT '',
  `brand_name_en` varchar(100) NOT NULL DEFAULT '',
  `description` varchar(200) DEFAULT '',
  `brand_logo` varchar(255) DEFAULT '',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `website` varchar(255) DEFAULT '',
  `sort` smallint(6) unsigned NOT NULL DEFAULT '0',
  `cloud_upload` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1是云上传',
  PRIMARY KEY (`brand_id`),
  KEY `brand_name` (`brand_name`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of syc_goods_brand
-- ----------------------------
INSERT INTO `syc_goods_brand` VALUES ('1', '华为', 'HUAWEI', '华为手机', 'VElN5oiq5Zu+MjAxNzExMjUxNzM1NDYucG5n.png', '1', '', '50', '1');
INSERT INTO `syc_goods_brand` VALUES ('2', '小米', 'MI', '小米手机', '/uploads/brand/20171125/c532c05db25afbb09eb11238c5ce4f63.png', '1', 'https://mi.jd.com', '50', '0');
INSERT INTO `syc_goods_brand` VALUES ('3', '测试品牌', 'testa', '测试品牌', '', '1', 'https://mi.jd.com', '50', '0');

-- ----------------------------
-- Table structure for syc_goods_category
-- ----------------------------
DROP TABLE IF EXISTS `syc_goods_category`;
CREATE TABLE `syc_goods_category` (
  `category_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(50) NOT NULL DEFAULT '',
  `keywords` varchar(200) DEFAULT '',
  `description` varchar(255) DEFAULT '',
  `pid` int(10) unsigned NOT NULL DEFAULT '0',
  `is_nav` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `sort` smallint(6) unsigned NOT NULL DEFAULT '0',
  `filter_attr` varchar(100) NOT NULL DEFAULT '',
  `path` varchar(100) NOT NULL DEFAULT '',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `goods_type_id` int(10) unsigned NOT NULL DEFAULT '0',
  `price_nums` tinyint(6) unsigned NOT NULL DEFAULT '5',
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of syc_goods_category
-- ----------------------------
INSERT INTO `syc_goods_category` VALUES ('1', '覆铜板', '', '', '0', '0', '2', '', '0', '1', '0', '5');
INSERT INTO `syc_goods_category` VALUES ('5', '干膜', '', '', '0', '0', '50', '', '0', '1', '0', '5');
INSERT INTO `syc_goods_category` VALUES ('11', '半固化片', '', '', '0', '0', '50', '', '0', '1', '0', '5');

-- ----------------------------
-- Table structure for syc_goods_type
-- ----------------------------
DROP TABLE IF EXISTS `syc_goods_type`;
CREATE TABLE `syc_goods_type` (
  `goods_type_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_name` varchar(20) NOT NULL DEFAULT '' COMMENT '商品类型名称',
  PRIMARY KEY (`goods_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of syc_goods_type
-- ----------------------------
INSERT INTO `syc_goods_type` VALUES ('1', '覆铜板');
INSERT INTO `syc_goods_type` VALUES ('4', '干膜');
INSERT INTO `syc_goods_type` VALUES ('22', '半固化片');

-- ----------------------------
-- Table structure for syc_input_goods
-- ----------------------------
DROP TABLE IF EXISTS `syc_input_goods`;
CREATE TABLE `syc_input_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `input_id` int(10) unsigned NOT NULL DEFAULT '0',
  `goods_id` int(10) unsigned NOT NULL DEFAULT '0',
  `goods_name` varchar(255) NOT NULL DEFAULT '',
  `unit` varchar(50) NOT NULL DEFAULT '',
  `goods_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `goods_number` int(10) unsigned NOT NULL DEFAULT '0',
  `remark` varchar(255) NOT NULL DEFAULT '',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `input_id` (`input_id`,`goods_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='入库商品表';

-- ----------------------------
-- Records of syc_input_goods
-- ----------------------------

-- ----------------------------
-- Table structure for syc_input_store
-- ----------------------------
DROP TABLE IF EXISTS `syc_input_store`;
CREATE TABLE `syc_input_store` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin_uid` int(10) unsigned NOT NULL DEFAULT '0',
  `store_sn` varchar(100) NOT NULL DEFAULT '',
  `po_id` int(10) unsigned NOT NULL DEFAULT '0',
  `po_sn` varchar(100) NOT NULL DEFAULT '',
  `cus_name` varchar(255) NOT NULL DEFAULT '',
  `supplier_id` int(10) unsigned NOT NULL DEFAULT '0',
  `remark` varchar(255) NOT NULL DEFAULT '',
  `purchase_date` varchar(50) NOT NULL DEFAULT '',
  `is_cancel` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1取消',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `store_sn` (`store_sn`,`po_sn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='入库表';

-- ----------------------------
-- Records of syc_input_store
-- ----------------------------

-- ----------------------------
-- Table structure for syc_logistics
-- ----------------------------
DROP TABLE IF EXISTS `syc_logistics`;
CREATE TABLE `syc_logistics` (
  `log_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '自增',
  `log_name` char(20) NOT NULL DEFAULT '' COMMENT '名称',
  `log_phone` char(20) NOT NULL DEFAULT '' COMMENT '电话',
  `log_fax` char(20) NOT NULL DEFAULT '' COMMENT '传真',
  `log_address` varchar(50) NOT NULL DEFAULT '' COMMENT '详细地址',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`log_id`),
  UNIQUE KEY `log_name` (`log_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='物流信息表';

-- ----------------------------
-- Records of syc_logistics
-- ----------------------------

-- ----------------------------
-- Table structure for syc_material_att
-- ----------------------------
DROP TABLE IF EXISTS `syc_material_att`;
CREATE TABLE `syc_material_att` (
  `maid` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `ma_name` char(30) NOT NULL COMMENT '属性名称',
  PRIMARY KEY (`maid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='原料属性';

-- ----------------------------
-- Records of syc_material_att
-- ----------------------------
INSERT INTO `syc_material_att` VALUES ('1', 'Y');
INSERT INTO `syc_material_att` VALUES ('2', 'P');
INSERT INTO `syc_material_att` VALUES ('3', 'A');
INSERT INTO `syc_material_att` VALUES ('4', 'B');

-- ----------------------------
-- Table structure for syc_material_set
-- ----------------------------
DROP TABLE IF EXISTS `syc_material_set`;
CREATE TABLE `syc_material_set` (
  `msid` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `ms_pnid` char(30) NOT NULL COMMENT '产品系列',
  `ms_blname` char(30) NOT NULL COMMENT '板材名称',
  `ms_maname` char(30) NOT NULL COMMENT '材料属性',
  `ms_baobian` char(30) NOT NULL COMMENT '包边线',
  `ms_gl` char(255) NOT NULL COMMENT '关联料型',
  `ms_uid` int(10) NOT NULL COMMENT '添加员',
  `create_time` int(16) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(16) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`msid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='原料设定表';

-- ----------------------------
-- Records of syc_material_set
-- ----------------------------
INSERT INTO `syc_material_set` VALUES ('3', 'P', '801', 'Y', '双包边', '18:0.5,19:1.5,20:2,21:2.5,22:3,23:1,24:1', '1', '1512127148', '1512127148', '1');
INSERT INTO `syc_material_set` VALUES ('4', 'P', '801', 'Y', '单包边', '18:0.5,19:1.5,20:2', '1', '1512128732', '1512128732', '1');

-- ----------------------------
-- Table structure for syc_order
-- ----------------------------
DROP TABLE IF EXISTS `syc_order`;
CREATE TABLE `syc_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `create_uid` int(10) unsigned NOT NULL DEFAULT '0',
  `con_id` int(10) unsigned NOT NULL DEFAULT '0',
  `cus_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '客户id',
  `order_sn` varchar(50) NOT NULL DEFAULT '' COMMENT '报价单号',
  `cus_order_sn` varchar(255) NOT NULL DEFAULT '' COMMENT '客户订单号',
  `company_name` varchar(255) NOT NULL DEFAULT '',
  `company_short` varchar(255) NOT NULL DEFAULT '',
  `contacts` varchar(50) NOT NULL DEFAULT '',
  `fax` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL DEFAULT '',
  `order_remark` text,
  `attachment` text COMMENT '附件',
  `status` tinyint(1) NOT NULL DEFAULT '2' COMMENT '-1已删除，0未确认，1已确认，2已送货，3已完成，4已取消，5已创建采购单，6部分已送货',
  `is_create` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1已创建采购单',
  `require_time` int(10) unsigned NOT NULL DEFAULT '0',
  `deliver_time` int(10) unsigned NOT NULL DEFAULT '0',
  `total_money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `order_sn` (`order_sn`,`company_name`,`company_short`,`status`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of syc_order
-- ----------------------------
INSERT INTO `syc_order` VALUES ('47', '2', '12', '1689', 'SO201810014048481048', 'FY20181001001', '清远市富盈电子有限公司', '清远富盈', '王平', '0763-3697998', '1040312149@QQ.COM', 'ttest', '[]', '2', '1', '1538496000', '1538496000', '8016.00', '1538390491', '1538390830');
INSERT INTO `syc_order` VALUES ('48', '4', '0', '1688', 'SO201810075835351035', '180828-003', '惠州市利贞电子有限公司', '惠州利贞', '叶秋兰', '0752-6687598', '1040312149@QQ.COM', '', '[{\"ext\":\"pdf\",\"path\":\"\\/uploads\\/20181007\\/a0ec2e36142ebc607a3033894c48daa1.pdf\",\"oldfilename\":\"PO1810005.pdf\",\"filename\":\"a0ec2e36142ebc607a3033894c48daa1.pdf\"},{\"ext\":\"pdf\",\"path\":\"\\/uploads\\/20181007\\/87a92d4d7beb487ac75b1600295fa389.pdf\",\"oldfilename\":\"PO1810009\\u8865.pdf\",\"filename\":\"87a92d4d7beb487ac75b1600295fa389.pdf\"}]', '2', '1', '1539100800', '1539100800', '7261.00', '1538924513', '1538925414');
INSERT INTO `syc_order` VALUES ('49', '4', '0', '1688', 'SO201810083141411041', '180917-001', '惠州市利贞电子有限公司', '惠州利贞', '叶秋兰', '0752-6687598', '1040312149@QQ.COM', '', '[{\"ext\":\"pdf\",\"path\":\"\\/uploads\\/20181008\\/7749031ed8f7a6f5cf5d12b9b0cf43c2.pdf\",\"oldfilename\":\"PO1810009\\u8865.pdf\",\"filename\":\"7749031ed8f7a6f5cf5d12b9b0cf43c2.pdf\"},{\"ext\":\"pdf\",\"path\":\"\\/uploads\\/20181008\\/8adaabe43ec39f7eee33175d313bd0a5.pdf\",\"oldfilename\":\"PO1810011.pdf\",\"filename\":\"8adaabe43ec39f7eee33175d313bd0a5.pdf\"}]', '6', '1', '1539532800', '1539100800', '6625.00', '1539009192', '1539011119');
INSERT INTO `syc_order` VALUES ('50', '2', '12', '1689', 'SO201810094608081008', 'FY20181009001', '清远市富盈电子有限公司', '清远富盈', '张玉玲', '0763-3697998', '1040312149@QQ.COM', 'test', '[{\"ext\":\"pdf\",\"path\":\"\\/uploads\\/20181009\\/4e5adc2942eda850b5c79265fc0af118.pdf\",\"oldfilename\":\"1.\\u7b80\\u4ecb.pdf\",\"filename\":\"4e5adc2942eda850b5c79265fc0af118.pdf\"}]', '5', '1', '1539273600', '0', '19748.00', '1539053360', '1539053360');
INSERT INTO `syc_order` VALUES ('51', '4', '12', '1689', 'SO201810090809091009', 'POFY1809000206', '清远市富盈电子有限公司', '清远富盈', '张玉玲', '0763-3697998', '1040312149@QQ.COM', '', '[{\"ext\":\"pdf\",\"path\":\"\\/uploads\\/20181009\\/1f73fde395879cbb61ef1b3066eca17f.pdf\",\"oldfilename\":\"PO1810012.pdf\",\"filename\":\"1f73fde395879cbb61ef1b3066eca17f.pdf\"},{\"ext\":\"pdf\",\"path\":\"\\/uploads\\/20181009\\/9ece2e20016f36d8d710cde23ca6b66e.pdf\",\"oldfilename\":\"PO1810013.pdf\",\"filename\":\"9ece2e20016f36d8d710cde23ca6b66e.pdf\"}]', '5', '1', '1539619200', '0', '135475.00', '1539055161', '1539055161');
INSERT INTO `syc_order` VALUES ('52', '4', '12', '1689', 'SO201810092137371037', 'POFY1808000565', '清远市富盈电子有限公司', '清远富盈', '张玉玲', '0763-3697998', '1040312149@QQ.COM', '', '[{\"ext\":\"pdf\",\"path\":\"\\/uploads\\/20181009\\/1a65ae0762e0323972c4643f8d8bd921.pdf\",\"oldfilename\":\"PO1810013.pdf\",\"filename\":\"1a65ae0762e0323972c4643f8d8bd921.pdf\"},{\"ext\":\"pdf\",\"path\":\"\\/uploads\\/20181009\\/ea7ef344dcebd5d0ecae5cf60316baa8.pdf\",\"oldfilename\":\"PO1810014.pdf\",\"filename\":\"ea7ef344dcebd5d0ecae5cf60316baa8.pdf\"}]', '1', '0', '1539705600', '0', '151762.50', '1539059203', '1539059203');
INSERT INTO `syc_order` VALUES ('53', '2', '12', '1689', 'SO201810172222221022', 'weitest20181010002', '清远市富盈电子有限公司', '清远富盈', '张玉玲', '0763-3697998', '1040312149@QQ.COM', 'test', '[{\"ext\":\"docx\",\"path\":\"\\/uploads\\/20181017\\/27fdda47433da356725b9bac418c9fb9.docx\",\"oldfilename\":\"\\u6613\\u5408\\u6536\\u94f6\\u7cfb\\u7edf-\\u7b80\\u8981\\u8bf4\\u660e.docx\",\"filename\":\"27fdda47433da356725b9bac418c9fb9.docx\"}]', '1', '0', '1539878400', '0', '3206.00', '1539757455', '1539757455');
INSERT INTO `syc_order` VALUES ('54', '2', '0', '1688', 'SO201811134106061106', 'weitest20181010003', '惠州市利贞电子有限公司', '惠州利贞', '叶秋兰', '0752-6687598', '1040312149@QQ.COM', null, '[]', '-1', '0', '0', '0', '10116615.50', '1542077162', '1542077162');
INSERT INTO `syc_order` VALUES ('55', '2', '0', '1688', 'SO201811135117171117', 'weitest20181010005', '惠州市利贞电子有限公司', '惠州利贞', '叶秋兰', '0752-6687598', '1040312149@QQ.COM', null, '[]', '-1', '0', '1542470400', '0', '12.00', '1542077613', '1542077613');
INSERT INTO `syc_order` VALUES ('56', '2', '0', '1688', 'SO201811131222221122', 'AD89480f1002123', '惠州市利贞电子有限公司', '惠州利贞', '叶秋兰', '0752-6687598', '1040312149@QQ.COM', null, '[{\"ext\":\"png\",\"oldfilename\":\"IM\\u8bbe\\u8ba1.png\",\"path\":\"\\/uploads\\/20181113\\/fb9a8df00daac5a0262e62709d88d131.png\"}]', '0', '0', '1542297600', '0', '500.00', '1542096800', '1542103772');
INSERT INTO `syc_order` VALUES ('57', '2', '12', '1689', 'SO201811133959591159', 'gdsafsafsa', '清远市富盈电子有限公司', '清远富盈', '张玉玲', '0763-3697998', '1040312149@QQ.COM', 'fsafsfa', '[]', '5', '1', '1542211200', '0', '12.00', '1542102116', '1542102116');

-- ----------------------------
-- Table structure for syc_order_goods
-- ----------------------------
DROP TABLE IF EXISTS `syc_order_goods`;
CREATE TABLE `syc_order_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned NOT NULL DEFAULT '0',
  `goods_id` int(10) unsigned NOT NULL DEFAULT '0',
  `goods_name` varchar(255) NOT NULL DEFAULT '',
  `unit` varchar(50) NOT NULL DEFAULT '',
  `goods_number` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '下单数量',
  `send_num` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '已送数量',
  `goods_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '实际单价',
  `market_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '标准单价',
  `goods_attr` text,
  `remark` varchar(255) NOT NULL DEFAULT '',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=148 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of syc_order_goods
-- ----------------------------
INSERT INTO `syc_order_goods` VALUES ('98', '47', '8', 'FR-4 CTI≥600 1.1MM H/H 41\"*49\" 含铜 黄料 无水印', '张', '42', '42', '104.00', '103.00', '[{\"goods_attr_id\":12,\"attr_name\":\"\\u7c7b\\u578b\",\"attr_value\":\"FR-4\"},{\"goods_attr_id\":22,\"attr_name\":\"\\u80f6\\u7cfb\",\"attr_value\":\"CTI\\u2265600\"},{\"goods_attr_id\":14,\"attr_name\":\"\\u677f\\u539a\",\"attr_value\":\"1.10MM\"},{\"goods_attr_id\":16,\"attr_name\":\"\\u94dc\\u539a\",\"attr_value\":\"H\\/H\"},{\"goods_attr_id\":19,\"attr_name\":\"\\u5c3a\\u5bf8\",\"attr_value\":\"41\\u201d*49\\u201c\"},{\"goods_attr_id\":21,\"attr_name\":\"\\u662f\\u5426\\u542b\\u94dc\",\"attr_value\":\"\\u542b\\u94dc\\u539a\"},{\"goods_attr_id\":20,\"attr_name\":\"\\u8272\\u7cfb\",\"attr_value\":\"\\u9ec4\\u6599\"},{\"goods_attr_id\":23,\"attr_name\":\"\\u6709\\u65e0\\u6c34\\u5370\",\"attr_value\":\"\\u65e0\\u6c34\\u5370\"},{\"goods_attr_id\":13,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u5fb7\\u51ef\"}]', '', '1538390491');
INSERT INTO `syc_order_goods` VALUES ('99', '47', '9', 'FR-4 TG140 1.4MM H/H 37\"*49\" 含铜 黄料 无水印', '张', '32', '32', '114.00', '113.00', '[{\"goods_attr_id\":12,\"attr_name\":\"\\u7c7b\\u578b\",\"attr_value\":\"FR-4\"},{\"goods_attr_id\":22,\"attr_name\":\"\\u80f6\\u7cfb\",\"attr_value\":\"TG135\"},{\"goods_attr_id\":14,\"attr_name\":\"\\u677f\\u539a\",\"attr_value\":\"1.00MM\"},{\"goods_attr_id\":16,\"attr_name\":\"\\u94dc\\u539a\",\"attr_value\":\"H\\/H\"},{\"goods_attr_id\":19,\"attr_name\":\"\\u5c3a\\u5bf8\",\"attr_value\":\"37\\u201c*49\\u201d\"},{\"goods_attr_id\":21,\"attr_name\":\"\\u662f\\u5426\\u542b\\u94dc\",\"attr_value\":\"\\u542b\\u94dc\\u539a\"},{\"goods_attr_id\":20,\"attr_name\":\"\\u8272\\u7cfb\",\"attr_value\":\"\\u9ec4\\u6599\"},{\"goods_attr_id\":23,\"attr_name\":\"\\u6709\\u65e0\\u6c34\\u5370\",\"attr_value\":\"\\u65e0\\u6c34\\u5370\"},{\"goods_attr_id\":13,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u5fb7\\u51ef\"}]', '', '1538390491');
INSERT INTO `syc_order_goods` VALUES ('100', '48', '31', '长春干膜 FF-9040S 15.500 *600FT *2卷', '箱', '1', '1', '821.50', '0.00', '[]', '', '1538924513');
INSERT INTO `syc_order_goods` VALUES ('101', '48', '39', '长春干膜 FF-9040S 20.000 *600FT *2卷', '箱', '3', '3', '1060.00', '0.00', '[]', '', '1538924513');
INSERT INTO `syc_order_goods` VALUES ('102', '48', '41', '长春干膜 FF-9040S 20.500 *600FT *2卷', '箱', '3', '3', '1086.50', '0.00', '[]', '', '1538924513');
INSERT INTO `syc_order_goods` VALUES ('103', '49', '53', '长春干膜 FF-9040S 14.000 *600FT *2卷', '箱', '2', '1', '742.00', '0.00', '[]', '', '1539009192');
INSERT INTO `syc_order_goods` VALUES ('104', '49', '54', '长春干膜 FF-9040S 18.500 *600FT *2卷', '箱', '2', '1', '980.50', '0.00', '[]', '', '1539009192');
INSERT INTO `syc_order_goods` VALUES ('105', '49', '39', '长春干膜 FF-9040S 20.000 *600FT *2卷', '箱', '3', '1', '1060.00', '0.00', '[]', '', '1539009192');
INSERT INTO `syc_order_goods` VALUES ('106', '50', '28', '长春干膜 FF-9040S 14.500 *600FT *2卷', '箱', '12', '0', '651.00', '0.00', '[]', '', '1539053360');
INSERT INTO `syc_order_goods` VALUES ('107', '50', '30', '长春干膜 FF-9040S 15.000 *600FT *2卷', '箱', '4', '0', '654.00', '0.00', '[]', '', '1539053360');
INSERT INTO `syc_order_goods` VALUES ('108', '50', '33', '长春干膜 FF-9040S 17.250 *600FT *2卷', '箱', '6', '0', '660.00', '0.00', '[]', '', '1539053360');
INSERT INTO `syc_order_goods` VALUES ('109', '50', '42', 'FR-4 TG170 1.40MM 1/1 41”*49“ 含铜厚 黄料 无水印', '张', '8', '0', '670.00', '0.00', '[]', '', '1539053360');
INSERT INTO `syc_order_goods` VALUES ('110', '51', '72', '长春干膜 FF-9040S 15.250 *600FT *1卷', '卷', '2', '0', '381.25', '0.00', '[]', '', '1539055161');
INSERT INTO `syc_order_goods` VALUES ('111', '51', '73', '长春干膜 FF-9040S 18.000 *600FT *1卷', '箱', '4', '0', '450.00', '0.00', '[]', '', '1539055161');
INSERT INTO `syc_order_goods` VALUES ('112', '51', '74', '长春干膜 FF-9040S 19.250 *600FT *1卷', '卷', '4', '0', '481.25', '0.00', '[]', '', '1539055161');
INSERT INTO `syc_order_goods` VALUES ('113', '51', '75', '长春干膜 FF-9040S 20.000 *600FT *1卷', '卷', '10', '0', '500.00', '0.00', '[]', '', '1539055161');
INSERT INTO `syc_order_goods` VALUES ('114', '51', '76', '长春干膜 FF-9040S 20.250 *600FT *1卷', '卷', '4', '0', '506.25', '0.00', '[]', '', '1539055161');
INSERT INTO `syc_order_goods` VALUES ('115', '51', '77', '长春干膜 FF-9040S 21.500 *600FT *1卷', '卷', '4', '0', '537.50', '0.00', '[]', '', '1539055161');
INSERT INTO `syc_order_goods` VALUES ('116', '51', '78', '长春干膜 FF-9040S 22.000 *600FT *1卷', '卷', '4', '0', '550.00', '0.00', '[]', '', '1539055161');
INSERT INTO `syc_order_goods` VALUES ('117', '51', '79', '长春干膜 FF-9040S 22.250 *600FT *1卷', '卷', '4', '0', '556.25', '0.00', '[]', '', '1539055161');
INSERT INTO `syc_order_goods` VALUES ('118', '51', '80', '长春干膜 FF-9040S 22.500 *600FT *1卷', '卷', '10', '0', '562.50', '0.00', '[]', '', '1539055161');
INSERT INTO `syc_order_goods` VALUES ('119', '51', '81', '长春干膜 FF-9040S 23.000 *600FT *1卷', '卷', '10', '0', '575.00', '0.00', '[]', '', '1539055161');
INSERT INTO `syc_order_goods` VALUES ('120', '51', '82', '长春干膜 FF-9040S 23.250 *600FT *1卷', '卷', '10', '0', '581.25', '0.00', '[]', '', '1539055161');
INSERT INTO `syc_order_goods` VALUES ('121', '51', '83', '长春干膜 FF-9040S 23.500 *600FT *1卷', '卷', '4', '0', '587.50', '0.00', '[]', '', '1539055161');
INSERT INTO `syc_order_goods` VALUES ('122', '51', '92', '长春干膜 FF-9040S 24.000 *600FT *1卷', '卷', '70', '0', '600.00', '0.00', '[]', '', '1539055161');
INSERT INTO `syc_order_goods` VALUES ('123', '51', '84', '长春干膜 FF-9040S 24.250 *600FT *1卷', '卷', '80', '0', '606.25', '0.00', '[]', '', '1539055161');
INSERT INTO `syc_order_goods` VALUES ('124', '51', '85', '长春干膜 FF-9040S 24.500 *600FT *1卷', '卷', '12', '0', '612.50', '0.00', '[]', '', '1539055161');
INSERT INTO `syc_order_goods` VALUES ('125', '52', '73', '长春干膜 FF-9040S 18.000 *600FT *1卷', '卷', '6', '0', '450.00', '0.00', '[{\"goods_attr_id\":24,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u957f\\u6625\\u5e72\\u819c\"},{\"goods_attr_id\":25,\"attr_name\":\"\\u578b\\u53f7\",\"attr_value\":\"FF-9040S\"},{\"goods_attr_id\":26,\"attr_name\":\"\\u5e45\\u5bbd\",\"attr_value\":\"18.000\"},{\"goods_attr_id\":27,\"attr_name\":\"\\u5377\\u957f\",\"attr_value\":\"*600FT\"},{\"goods_attr_id\":28,\"attr_name\":\"\\u5377\\/\\u7bb1\",\"attr_value\":\"*1\\u5377\"}]', '', '1539059203');
INSERT INTO `syc_order_goods` VALUES ('126', '52', '96', '长春干膜 FF-9040S 18.250 *600FT *1卷', '卷', '4', '0', '456.25', '0.00', '[]', '', '1539059203');
INSERT INTO `syc_order_goods` VALUES ('127', '52', '74', '长春干膜 FF-9040S 19.250 *600FT *1卷', '卷', '6', '0', '481.25', '0.00', '[]', '', '1539059203');
INSERT INTO `syc_order_goods` VALUES ('128', '52', '75', '长春干膜 FF-9040S 20.000 *600FT *1卷', '卷', '4', '0', '500.00', '0.00', '[]', '', '1539059203');
INSERT INTO `syc_order_goods` VALUES ('129', '52', '76', '长春干膜 FF-9040S 20.250 *600FT *1卷', '卷', '4', '0', '506.25', '0.00', '[]', '', '1539059203');
INSERT INTO `syc_order_goods` VALUES ('130', '52', '93', '长春干膜 FF-9040S 21.000 *600FT *1卷', '卷', '24', '0', '525.00', '0.00', '[]', '', '1539059203');
INSERT INTO `syc_order_goods` VALUES ('131', '52', '94', '长春干膜 FF-9040S 21.250 *600FT *1卷', '卷', '2', '0', '531.25', '0.00', '[]', '', '1539059203');
INSERT INTO `syc_order_goods` VALUES ('132', '52', '78', '长春干膜 FF-9040S 22.000 *600FT *1卷', '卷', '4', '0', '550.00', '0.00', '[]', '', '1539059203');
INSERT INTO `syc_order_goods` VALUES ('133', '52', '81', '长春干膜 FF-9040S 23.000 *600FT *1卷', '卷', '4', '0', '575.00', '0.00', '[]', '', '1539059203');
INSERT INTO `syc_order_goods` VALUES ('134', '52', '83', '长春干膜 FF-9040S 23.500 *600FT *1卷', '卷', '10', '0', '587.50', '0.00', '[]', '', '1539059203');
INSERT INTO `syc_order_goods` VALUES ('135', '52', '92', '长春干膜 FF-9040S 24.000 *600FT *1卷', '卷', '40', '0', '600.00', '0.00', '[]', '', '1539059203');
INSERT INTO `syc_order_goods` VALUES ('136', '52', '84', '长春干膜 FF-9040S 24.250 *600FT *1卷', '卷', '140', '0', '606.25', '0.00', '[]', '', '1539059203');
INSERT INTO `syc_order_goods` VALUES ('137', '52', '85', '长春干膜 FF-9040S 24.500 *600FT *1卷', '卷', '8', '0', '612.50', '0.00', '[]', '', '1539059203');
INSERT INTO `syc_order_goods` VALUES ('138', '52', '95', '长春干膜 FF-9040S 16.750 *600FT *1卷', '卷', '6', '0', '418.75', '0.00', '[]', '', '1539059203');
INSERT INTO `syc_order_goods` VALUES ('139', '53', '44', 'FR-4 TG140 CTI≥600 1.10MM H/H 43“*49” 含铜厚 黄料 无水印', '张', '5', '0', '135.00', '0.00', '[]', '', '1539757455');
INSERT INTO `syc_order_goods` VALUES ('140', '53', '47', 'FR-4 TG140 1.40MM H/H 37“*49” 含铜厚 黄料 无水印', '张', '7', '0', '165.00', '0.00', '[]', '', '1539757455');
INSERT INTO `syc_order_goods` VALUES ('141', '53', '46', 'FR-4 TG170 1.40MM H/H 41”*49“ 含铜厚 黄料 无水印', '张', '8', '0', '172.00', '0.00', '[]', '', '1539757455');
INSERT INTO `syc_order_goods` VALUES ('142', '54', '26', '长春干膜 FF-9040S 12.000 *600FT *2卷', '箱', '12', '0', '123.00', '0.00', '[]', '32142131334123131', '1542077162');
INSERT INTO `syc_order_goods` VALUES ('143', '54', '31', '长春干膜 FF-9040S 15.500 *600FT *2卷', '箱', '12313', '0', '821.50', '0.00', '[]', '31223', '1542077162');
INSERT INTO `syc_order_goods` VALUES ('144', '54', '29', '长春干膜 FF-9040S 14.750 *600FT *2卷', '箱', '10', '0', '1.00', '0.00', '[]', '', '1542077162');
INSERT INTO `syc_order_goods` VALUES ('145', '55', '26', '长春干膜 FF-9040S 12.000 *600FT *2卷', '箱', '1', '0', '12.00', '0.00', '[]', '', '1542077613');
INSERT INTO `syc_order_goods` VALUES ('146', '56', '26', '长春干膜 FF-9040S 12.000 *600FT *2卷', '箱', '5', '0', '100.00', '0.00', '[]', '手机端测试', '1542096800');
INSERT INTO `syc_order_goods` VALUES ('147', '57', '27', '长春干膜 FF-9040S 12.500 *600FT *2卷', '箱', '1', '0', '12.00', '0.00', '[]', '21', '1542102116');

-- ----------------------------
-- Table structure for syc_others_baobian
-- ----------------------------
DROP TABLE IF EXISTS `syc_others_baobian`;
CREATE TABLE `syc_others_baobian` (
  `bid` int(6) NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `bname` char(16) NOT NULL DEFAULT '' COMMENT '分类',
  `bval` char(16) NOT NULL COMMENT '单边',
  `bamo` decimal(5,0) NOT NULL DEFAULT '0' COMMENT '单边线金额',
  `qhjc` char(16) NOT NULL DEFAULT '0' COMMENT '墙厚基础',
  `qhdz` char(16) NOT NULL DEFAULT '0' COMMENT '递增墙厚',
  `qhdzamo` decimal(5,0) NOT NULL DEFAULT '0' COMMENT '递增金额',
  `bremark` char(100) NOT NULL DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`bid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='其他属性-包边线设置';

-- ----------------------------
-- Records of syc_others_baobian
-- ----------------------------
INSERT INTO `syc_others_baobian` VALUES ('1', '包边A类', '单包边', '0', '0', '0', '0', '');
INSERT INTO `syc_others_baobian` VALUES ('2', '包边A类', '双包边', '200', '180', '100', '66', '');
INSERT INTO `syc_others_baobian` VALUES ('3', '包边B类', '单包边', '0', '150', '60', '30', '');
INSERT INTO `syc_others_baobian` VALUES ('4', '包边B类', '双包边', '30', '150', '60', '30', '');

-- ----------------------------
-- Table structure for syc_others_thick
-- ----------------------------
DROP TABLE IF EXISTS `syc_others_thick`;
CREATE TABLE `syc_others_thick` (
  `otid` int(6) NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `otname` char(16) NOT NULL DEFAULT '' COMMENT '属性',
  `otgu` decimal(5,0) NOT NULL DEFAULT '0' COMMENT '固额',
  `otval` char(16) NOT NULL DEFAULT '' COMMENT '间值',
  `otamo` decimal(5,0) NOT NULL DEFAULT '0' COMMENT '金额',
  `otremark` char(100) NOT NULL DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`otid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='其他属性-厚度单价';

-- ----------------------------
-- Records of syc_others_thick
-- ----------------------------
INSERT INTO `syc_others_thick` VALUES ('1', '150', '30', '60', '30', '');
INSERT INTO `syc_others_thick` VALUES ('2', '180', '200', '100', '66', '');

-- ----------------------------
-- Table structure for syc_params
-- ----------------------------
DROP TABLE IF EXISTS `syc_params`;
CREATE TABLE `syc_params` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `desc` text,
  `sort` smallint(6) unsigned NOT NULL DEFAULT '0',
  `params_value` text,
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1文本显示',
  `file` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of syc_params
-- ----------------------------
INSERT INTO `syc_params` VALUES ('1', '付款方式', '付款方式', '10', '现金交易\n月结30天\n月结60天\n月结90天\n月结120天', '0', '');
INSERT INTO `syc_params` VALUES ('5', '交易类别', '交易类别', '50', '内销\n外销', '0', '');
INSERT INTO `syc_params` VALUES ('7', '部门', '部门', '50', '销售部\n采购部\n工程部\n生产部\n仓储物流部', '0', '');
INSERT INTO `syc_params` VALUES ('8', '业务经理', '业务经理', '50', '彭立新', '0', '');
INSERT INTO `syc_params` VALUES ('9', '单位', '单位', '50', '张\n箱\n卷\n包\n只\n台\nSQFT', '0', '');
INSERT INTO `syc_params` VALUES ('10', '跟单员', '跟单员', '50', '彭立新\n范丽湘\n唐小平', '0', '');
INSERT INTO `syc_params` VALUES ('11', '审核印章', '审核印章', '50', '审核印章', '2', '/uploads/20180905/699a65184686e220c0bf545cc440126e.jpg');
INSERT INTO `syc_params` VALUES ('12', 'PDF文件LOGO', 'PDF文件LOGO', '50', 'PDF文件LOGO', '2', '/uploads/20180814/512a803c3fca5bfe1928fb39d9f7746f.png');
INSERT INTO `syc_params` VALUES ('13', '报价单备注', '报价单备注', '50', '1、以上订单请开给：四川众山化有限公司\n联系人：华南办事处 范小姐13927377526\n电话傎真：0752-3775246  邮箱：SC_CSUN@163.COM\n2、以上报价含16%增值税\n3、付款条件月结60天，如2018年8月货款，请于2018年11月15日前电汇付款。若买方逾期付款，卖方有权要求买方：按逾期货款每天万分之五的比例支付拖欠买方货款赔偿。\n', '1', '');
INSERT INTO `syc_params` VALUES ('14', 'PDF文件标题', 'PDF文件标题', '50', '四川众山化工有限公司', '1', '');
INSERT INTO `syc_params` VALUES ('15', 'PDF文件英文标题', 'PDF文件英文标题', '50', 'CSUN(SICHUAN) CHEMICAL CO.,LTD', '1', '');
INSERT INTO `syc_params` VALUES ('16', '交货方式', '交货方式', '50', '货运\n快递', '0', '');
INSERT INTO `syc_params` VALUES ('17', '税率', '税率', '50', '0%\n16%', '0', '');
INSERT INTO `syc_params` VALUES ('18', '采购单备注', '采购单备注', '50', '1、交货方式：冷藏货运，\n2、品质：A 供货方随货提供品质检验报告，到货七日内检出品质异常或数量短少，供货方应负责更换或退货或补货，退换补货费用由供货方承担。B 货物于使用过程中出现品质异常，不超过到货3个月期限的，由此异常造成之一切损失，由供货方承担。C 如需技术支持，由供货方提供。\n3、A 请依本采购单所列数量交货，若超交以馈赠论。B 针对市场变化，可协商本采购单之交期。C 客户签收之送货单据原件，需返回我方，作为供销双方对账的依据。', '1', '');
INSERT INTO `syc_params` VALUES ('19', '订单查询参数', '订单查询参数', '50', '品牌\nTG值\n尺寸\n铜厚\n板厚\n幅宽\n客户', '0', '');
INSERT INTO `syc_params` VALUES ('20', '仓库盖章', '仓库盖章', '50', '仓库盖章', '2', '/uploads/20180905/16d0f14ef937df7dce1c05087a62365b.jpg');

-- ----------------------------
-- Table structure for syc_payment_goods
-- ----------------------------
DROP TABLE IF EXISTS `syc_payment_goods`;
CREATE TABLE `syc_payment_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `payment_order_id` int(10) unsigned NOT NULL DEFAULT '0',
  `purchase_id` int(10) unsigned NOT NULL DEFAULT '0',
  `po_sn` varchar(100) NOT NULL DEFAULT '',
  `order_id` int(10) unsigned NOT NULL DEFAULT '0',
  `order_sn` varchar(100) NOT NULL DEFAULT '',
  `delivery_date` varchar(50) NOT NULL DEFAULT '',
  `delivery_dn` varchar(100) NOT NULL DEFAULT '',
  `goods_id` int(10) unsigned NOT NULL DEFAULT '0',
  `goods_name` varchar(255) NOT NULL DEFAULT '',
  `unit` varchar(50) NOT NULL DEFAULT '',
  `goods_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `rec_number` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '收货数量',
  `open_number` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '开票数量',
  `count_money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `is_delete` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1已删除',
  PRIMARY KEY (`id`),
  KEY `payment_order_id` (`payment_order_id`,`order_id`,`goods_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of syc_payment_goods
-- ----------------------------

-- ----------------------------
-- Table structure for syc_payment_order
-- ----------------------------
DROP TABLE IF EXISTS `syc_payment_order`;
CREATE TABLE `syc_payment_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin_uid` int(10) unsigned NOT NULL DEFAULT '0',
  `supplier_id` int(10) unsigned NOT NULL DEFAULT '0',
  `supplier_name` varchar(255) NOT NULL DEFAULT '',
  `delivery_ids` varchar(255) NOT NULL DEFAULT '',
  `invoice_sn` varchar(100) NOT NULL DEFAULT '',
  `invoice_date` varchar(50) NOT NULL DEFAULT '',
  `total_money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `pay_money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `diff_money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `is_open` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1已开票',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '0已关闭，1未对账，2已对账',
  `payment_date` varchar(100) NOT NULL DEFAULT '' COMMENT '付款期',
  `last_date` varchar(100) NOT NULL DEFAULT '' COMMENT '到期日期',
  `is_delete` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1已删除',
  `update_time` int(10) NOT NULL,
  `create_time` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cus_id` (`supplier_id`,`invoice_sn`,`invoice_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of syc_payment_order
-- ----------------------------

-- ----------------------------
-- Table structure for syc_product_color
-- ----------------------------
DROP TABLE IF EXISTS `syc_product_color`;
CREATE TABLE `syc_product_color` (
  `pc_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `pc_name` char(16) NOT NULL COMMENT '名称',
  `pc_user_nick` char(20) NOT NULL COMMENT '添加者',
  `pc_address` varchar(100) NOT NULL DEFAULT '' COMMENT '颜色产地',
  `pc_img` varchar(250) NOT NULL DEFAULT '' COMMENT '图片',
  `pc_description` varchar(255) NOT NULL DEFAULT '' COMMENT '简述',
  `create_time` int(16) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(16) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(5) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`pc_id`),
  UNIQUE KEY `pc_name` (`pc_name`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COMMENT='产品颜色表';

-- ----------------------------
-- Records of syc_product_color
-- ----------------------------
INSERT INTO `syc_product_color` VALUES ('22', '黄花梨', '1', '', '', '', '1509442079', '1509442079', '1');
INSERT INTO `syc_product_color` VALUES ('23', '金橡木', '1', '', '', '', '1509442092', '1509442092', '1');
INSERT INTO `syc_product_color` VALUES ('24', '红木', '1', '', '', '', '1509442570', '1509442570', '1');
INSERT INTO `syc_product_color` VALUES ('25', '黄花梨3', '1', '', '', '', '1510159234', '1510159234', '1');

-- ----------------------------
-- Table structure for syc_product_number
-- ----------------------------
DROP TABLE IF EXISTS `syc_product_number`;
CREATE TABLE `syc_product_number` (
  `pn_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `pn_name` char(16) NOT NULL COMMENT '编号',
  `pn_price` decimal(5,2) NOT NULL DEFAULT '0.00' COMMENT '价格',
  `pn_baobian` char(16) NOT NULL COMMENT '包边线分类',
  `pn_user_nick` char(20) NOT NULL COMMENT '添加者',
  `pn_address` varchar(100) NOT NULL DEFAULT '' COMMENT '颜色产地',
  `pn_img` varchar(250) NOT NULL DEFAULT '' COMMENT '图片',
  `pn_description` varchar(255) NOT NULL DEFAULT '' COMMENT '简述',
  `create_time` int(16) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(16) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(5) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`pn_id`),
  UNIQUE KEY `pn_name` (`pn_name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='产品系列表';

-- ----------------------------
-- Records of syc_product_number
-- ----------------------------
INSERT INTO `syc_product_number` VALUES ('1', 'P', '780.00', '包边B类', '1', '', '/uploads/images/20170914/3242614c7efdfcd1f122cf32202115a2.jpg', '编号简述', '1505318622', '1508216195', '1');
INSERT INTO `syc_product_number` VALUES ('2', 'P10', '750.00', '包边B类', '1', '', '', '', '1505319213', '1508216183', '1');
INSERT INTO `syc_product_number` VALUES ('3', 'P20', '500.00', '包边A类', '1', '', '', '编号简述', '1505929197', '1508216189', '1');
INSERT INTO `syc_product_number` VALUES ('4', 'Y', '380.00', '包边A类', '1', '', '', '', '1508061095', '1508216176', '1');
INSERT INTO `syc_product_number` VALUES ('5', 's', '380.00', '包边A类', '1', '', '', '', '1508216262', '1508216262', '1');

-- ----------------------------
-- Table structure for syc_purchase
-- ----------------------------
DROP TABLE IF EXISTS `syc_purchase`;
CREATE TABLE `syc_purchase` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin_uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '管理员ID',
  `order_id` int(10) unsigned NOT NULL DEFAULT '0',
  `order_sn` varchar(100) NOT NULL DEFAULT '',
  `cus_order_sn` varchar(255) NOT NULL DEFAULT '' COMMENT '客户订单号',
  `cus_id` int(10) unsigned NOT NULL DEFAULT '0',
  `po_sn` varchar(100) NOT NULL DEFAULT '',
  `supplier_id` int(10) unsigned NOT NULL DEFAULT '0',
  `cus_phome` varchar(50) NOT NULL DEFAULT '',
  `transaction_type` varchar(100) NOT NULL DEFAULT '',
  `payment` varchar(100) NOT NULL DEFAULT '',
  `delivery_type` varchar(100) NOT NULL DEFAULT '',
  `delivery_company` varchar(255) NOT NULL DEFAULT '',
  `tax` varchar(20) NOT NULL DEFAULT '',
  `delivery_address` varchar(255) NOT NULL DEFAULT '',
  `fax` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL DEFAULT '',
  `contacts` varchar(50) NOT NULL DEFAULT '',
  `receiver` varchar(50) NOT NULL COMMENT '收货联系人',
  `receivernum` varchar(50) NOT NULL COMMENT '收货联系人电话',
  `total_money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '-1已删除，0保存，1已确认，2确认已发送',
  `is_cancel` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1已取消关联订单',
  `is_finish` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1送货完成',
  `remark` text,
  `create_type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1直接新建',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`,`order_sn`,`po_sn`,`supplier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of syc_purchase
-- ----------------------------
INSERT INTO `syc_purchase` VALUES ('39', '2', '47', 'SO201810014048481048', 'FY20181001001', '1689', 'PO201810014139391039', '2', '13642982303', '内销', '月结60天', '货运', '清远市富盈电子有限公司', '16%', '广东省清远市清城区嘉福工业园C区仓库', '0752-3532028', 'sc_csun@163.com', '小赖', '王平', '13729678720', '8016.00', '1', '0', '0', '1、交货方式：冷藏货运，\n2、品质：A 供货方随货提供品质检验报告，到货七日内检出品质异常或数量短少，供货方应负责更换或退货或补货，退换补货费用由供货方承担。B 货物于使用过程中出现品质异常，不超过到货3个月期限的，由此异常造成之一切损失，由供货方承担。C 如需技术支持，由供货方提供。\n3、A 请依本采购单所列数量交货，若超交以馈赠论。B 针对市场变化，可协商本采购单之交期。C 客户签收之送货单据原件，需返回我方，作为供销双方对账的依据。', '0', '1538390523', '1538390523');
INSERT INTO `syc_purchase` VALUES ('40', '4', '48', 'SO201810075835351035', '180828-003', '1688', 'PO201810070208081008', '3', '0769-8339544', '内销', '月结60天', '货运', '惠州市利贞电子有限公司', '16%', '广东省惠州市博罗县龙溪镇埔上村建时工业园内', '0769-83395442', '1040312149@qq.com', '戴剑梅', '', '', '6384.20', '2', '0', '0', '1、交货方式：冷藏货运，\n2、品质：A 供货方随货提供品质检验报告，到货七日内检出品质异常或数量短少，供货方应负责更换或退货或补货，退换补货费用由供货方承担。B 货物于使用过程中出现品质异常，不超过到货3个月期限的，由此异常造成之一切损失，由供货方承担。C 如需技术支持，由供货方提供。\n3、A 请依本采购单所列数量交货，若超交以馈赠论。B 针对市场变化，可协商本采购单之交期。C 客户签收之送货单据原件，需返回我方，作为供销双方对账的依据。', '0', '1538924687', '1538924687');
INSERT INTO `syc_purchase` VALUES ('41', '4', '49', 'SO201810083141411041', '180917-001', '1688', 'PO201810083404041004', '3', '0752-6687010', '内销', '月结60天', '货运', '惠州市利贞电子有限公司', '16%', '广东省惠州市博罗县龙溪镇埔上村建时工业园内', '0769-83395442', '1040312149@qq.com', '戴剑梅', '叶秋兰', '1234566778', '2446.50', '1', '0', '0', '1、交货方式：冷藏货运，\n2、品质：A 供货方随货提供品质检验报告，到货七日内检出品质异常或数量短少，供货方应负责更换或退货或补货，退换补货费用由供货方承担。B 货物于使用过程中出现品质异常，不超过到货3个月期限的，由此异常造成之一切损失，由供货方承担。C 如需技术支持，由供货方提供。\n3、A 请依本采购单所列数量交货，若超交以馈赠论。B 针对市场变化，可协商本采购单之交期。C 客户签收之送货单据原件，需返回我方，作为供销双方对账的依据。', '0', '1539009383', '1539009686');
INSERT INTO `syc_purchase` VALUES ('42', '2', '50', 'SO201810094608081008', 'FY20181009001', '1689', 'PO201810094933331033', '3', '0763-3697026', '内销', '月结60天', '货运', '清远市富盈电子有限公司', '16%', '广东省清远市清城区嘉福工业园C区仓库', '0769-83395442', '1040312149@qq.com', '戴剑梅', '王平', '13729678720', '18446.00', '1', '0', '0', '1、交货方式：冷藏货运，\n2、品质：A 供货方随货提供品质检验报告，到货七日内检出品质异常或数量短少，供货方应负责更换或退货或补货，退换补货费用由供货方承担。B 货物于使用过程中出现品质异常，不超过到货3个月期限的，由此异常造成之一切损失，由供货方承担。C 如需技术支持，由供货方提供。\n3、A 请依本采购单所列数量交货，若超交以馈赠论。B 针对市场变化，可协商本采购单之交期。C 客户签收之送货单据原件，需返回我方，作为供销双方对账的依据。', '0', '1539053420', '1539054519');
INSERT INTO `syc_purchase` VALUES ('43', '4', '51', 'SO201810090809091009', 'POFY1809000206', '1689', 'PO201810092927271027', '3', '0769-8339544', '内销', '月结60天', '货运', '清远市富盈电子有限公司', '16%', '广东省清远市清城区嘉福工业园C区仓库', '0769-83395442', '1040312149@qq.com', '戴剑梅', '', '', '135475.00', '1', '0', '0', '1、交货方式：冷藏货运，\n2、品质：A 供货方随货提供品质检验报告，到货七日内检出品质异常或数量短少，供货方应负责更换或退货或补货，退换补货费用由供货方承担。B 货物于使用过程中出现品质异常，不超过到货3个月期限的，由此异常造成之一切损失，由供货方承担。C 如需技术支持，由供货方提供。\n3、A 请依本采购单所列数量交货，若超交以馈赠论。B 针对市场变化，可协商本采购单之交期。C 客户签收之送货单据原件，需返回我方，作为供销双方对账的依据。', '0', '1539055810', '1539055810');
INSERT INTO `syc_purchase` VALUES ('44', '2', '0', '', 'weitest20181009', '0', 'PO201810171628281028', '2', '13642982303', '内销', '月结60天', '货运', '', '16%', '', '0752-3532028', 'sc_csun@163.com', '赖小行', '', '', '3378.00', '0', '0', '0', '1、交货方式：冷藏货运，\n2、品质：A 供货方随货提供品质检验报告，到货七日内检出品质异常或数量短少，供货方应负责更换或退货或补货，退换补货费用由供货方承担。B 货物于使用过程中出现品质异常，不超过到货3个月期限的，由此异常造成之一切损失，由供货方承担。C 如需技术支持，由供货方提供。\n3、A 请依本采购单所列数量交货，若超交以馈赠论。B 针对市场变化，可协商本采购单之交期。C 客户签收之送货单据原件，需返回我方，作为供销双方对账的依据。', '1', '1539757073', '1539757073');
INSERT INTO `syc_purchase` VALUES ('45', '2', '57', 'SO201811133959591159', 'gdsafsafsa', '1689', 'PO201811140645451145', '2', '0763-3697026', '内销', '现金交易', '货运', '清远市富盈电子有限公司', '16%', '广东省清远市清城区嘉福工业园C区写字楼', '0752-3532028', 'sc_csun@163.com', '赖小行', '张玉玲', '15816247536', '12.00', '0', '0', '0', 'test', '0', '1542181431', '1542361675');

-- ----------------------------
-- Table structure for syc_purchase_affirm
-- ----------------------------
DROP TABLE IF EXISTS `syc_purchase_affirm`;
CREATE TABLE `syc_purchase_affirm` (
  `aid` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `a_pnumber` char(20) NOT NULL DEFAULT '' COMMENT '订单号',
  `a_affirm` tinyint(2) NOT NULL DEFAULT '1' COMMENT '确认1为确认',
  `a_img` varchar(250) NOT NULL DEFAULT '' COMMENT '图片',
  `a_remark` char(200) NOT NULL DEFAULT '' COMMENT '备注',
  `create_time` int(16) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(16) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `create_ip` char(16) NOT NULL DEFAULT '' COMMENT '添加IP',
  `update_ip` char(16) NOT NULL DEFAULT '' COMMENT '更新IP',
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单确认附表内容图片';

-- ----------------------------
-- Records of syc_purchase_affirm
-- ----------------------------

-- ----------------------------
-- Table structure for syc_purchase_bak
-- ----------------------------
DROP TABLE IF EXISTS `syc_purchase_bak`;
CREATE TABLE `syc_purchase_bak` (
  `pid` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `pnumber` char(20) NOT NULL COMMENT '订单号',
  `pcus_id` int(12) NOT NULL COMMENT '企业ID',
  `pbname` char(80) NOT NULL COMMENT '企业名称',
  `pcsname` char(20) NOT NULL COMMENT '客户名称',
  `pyouhui` tinyint(4) NOT NULL DEFAULT '100' COMMENT '订单优惠',
  `pamount` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '订单金额',
  `pcount` tinyint(4) NOT NULL DEFAULT '0' COMMENT '订单数量',
  `pstart_date` date NOT NULL COMMENT '销售日期',
  `pend_date` date NOT NULL COMMENT '发货日期',
  `create_time` int(16) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(16) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `affirm` tinyint(4) NOT NULL DEFAULT '0' COMMENT '确认1为确认',
  `pshengcwc` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1生产完成',
  `pshoudj` tinyint(4) NOT NULL DEFAULT '0' COMMENT '定金1为定金',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`pid`),
  UNIQUE KEY `pnumber` (`pnumber`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='销售订单表';

-- ----------------------------
-- Records of syc_purchase_bak
-- ----------------------------

-- ----------------------------
-- Table structure for syc_purchase_goods
-- ----------------------------
DROP TABLE IF EXISTS `syc_purchase_goods`;
CREATE TABLE `syc_purchase_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `purchase_id` int(10) unsigned NOT NULL DEFAULT '0',
  `goods_id` int(10) unsigned NOT NULL DEFAULT '0',
  `goods_name` varchar(255) NOT NULL DEFAULT '',
  `unit` varchar(50) NOT NULL DEFAULT '',
  `goods_number` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '采购数量',
  `input_store` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '已入库数量',
  `send_num` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '送货数量',
  `goods_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '实际单价',
  `count_money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `goods_attr` text,
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `purchase_id` (`purchase_id`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of syc_purchase_goods
-- ----------------------------
INSERT INTO `syc_purchase_goods` VALUES ('82', '39', '8', 'FR-4 CTI≥600 1.1MM H/H 41\"*49\" 含铜 黄料 无水印', '张', '42', '0', '42', '104.00', '4368.00', '[{\"goods_attr_id\":12,\"attr_name\":\"\\u7c7b\\u578b\",\"attr_value\":\"FR-4\"},{\"goods_attr_id\":22,\"attr_name\":\"\\u80f6\\u7cfb\",\"attr_value\":\"CTI\\u2265600\"},{\"goods_attr_id\":14,\"attr_name\":\"\\u677f\\u539a\",\"attr_value\":\"1.10MM\"},{\"goods_attr_id\":16,\"attr_name\":\"\\u94dc\\u539a\",\"attr_value\":\"H\\/H\"},{\"goods_attr_id\":19,\"attr_name\":\"\\u5c3a\\u5bf8\",\"attr_value\":\"41\\u201d*49\\u201c\"},{\"goods_attr_id\":21,\"attr_name\":\"\\u662f\\u5426\\u542b\\u94dc\",\"attr_value\":\"\\u542b\\u94dc\\u539a\"},{\"goods_attr_id\":20,\"attr_name\":\"\\u8272\\u7cfb\",\"attr_value\":\"\\u9ec4\\u6599\"},{\"goods_attr_id\":23,\"attr_name\":\"\\u6709\\u65e0\\u6c34\\u5370\",\"attr_value\":\"\\u65e0\\u6c34\\u5370\"},{\"goods_attr_id\":13,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u5fb7\\u51ef\"}]', '1538390523');
INSERT INTO `syc_purchase_goods` VALUES ('83', '39', '9', 'FR-4 TG140 1.4MM H/H 37\"*49\" 含铜 黄料 无水印', '张', '32', '0', '32', '114.00', '3648.00', '[{\"goods_attr_id\":12,\"attr_name\":\"\\u7c7b\\u578b\",\"attr_value\":\"FR-4\"},{\"goods_attr_id\":22,\"attr_name\":\"\\u80f6\\u7cfb\",\"attr_value\":\"TG135\"},{\"goods_attr_id\":14,\"attr_name\":\"\\u677f\\u539a\",\"attr_value\":\"1.00MM\"},{\"goods_attr_id\":16,\"attr_name\":\"\\u94dc\\u539a\",\"attr_value\":\"H\\/H\"},{\"goods_attr_id\":19,\"attr_name\":\"\\u5c3a\\u5bf8\",\"attr_value\":\"37\\u201c*49\\u201d\"},{\"goods_attr_id\":21,\"attr_name\":\"\\u662f\\u5426\\u542b\\u94dc\",\"attr_value\":\"\\u542b\\u94dc\\u539a\"},{\"goods_attr_id\":20,\"attr_name\":\"\\u8272\\u7cfb\",\"attr_value\":\"\\u9ec4\\u6599\"},{\"goods_attr_id\":23,\"attr_name\":\"\\u6709\\u65e0\\u6c34\\u5370\",\"attr_value\":\"\\u65e0\\u6c34\\u5370\"},{\"goods_attr_id\":13,\"attr_name\":\"\\u54c1\\u724c\",\"attr_value\":\"\\u5fb7\\u51ef\"}]', '1538390523');
INSERT INTO `syc_purchase_goods` VALUES ('84', '40', '31', '长春干膜 FF-9040S 15.500 *600FT *2卷', '箱', '1', '0', '1', '722.30', '722.30', '[]', '1538924687');
INSERT INTO `syc_purchase_goods` VALUES ('85', '40', '39', '长春干膜 FF-9040S 20.000 *600FT *2卷', '箱', '3', '0', '3', '932.00', '2796.00', '[]', '1538924687');
INSERT INTO `syc_purchase_goods` VALUES ('86', '40', '41', '长春干膜 FF-9040S 20.500 *600FT *2卷', '箱', '3', '0', '3', '955.30', '2865.90', '[]', '1538924687');
INSERT INTO `syc_purchase_goods` VALUES ('87', '41', '53', '长春干膜 FF-9040S 14.000 *600FT *2卷', '箱', '1', '0', '1', '652.40', '652.40', '[]', '1539009383');
INSERT INTO `syc_purchase_goods` VALUES ('88', '41', '54', '长春干膜 FF-9040S 18.500 *600FT *2卷', '箱', '1', '0', '1', '862.10', '862.10', '[]', '1539009383');
INSERT INTO `syc_purchase_goods` VALUES ('89', '41', '39', '长春干膜 FF-9040S 20.000 *600FT *2卷', '箱', '1', '0', '1', '932.00', '932.00', '[]', '1539009383');
INSERT INTO `syc_purchase_goods` VALUES ('90', '42', '28', '长春干膜 FF-9040S 14.500 *600FT *2卷', '箱', '10', '0', '0', '651.00', '6510.00', '[]', '1539053420');
INSERT INTO `syc_purchase_goods` VALUES ('91', '42', '30', '长春干膜 FF-9040S 15.000 *600FT *2卷', '箱', '4', '0', '0', '654.00', '2616.00', '[]', '1539053420');
INSERT INTO `syc_purchase_goods` VALUES ('92', '42', '33', '长春干膜 FF-9040S 17.250 *600FT *2卷', '箱', '6', '0', '0', '660.00', '3960.00', '[]', '1539053420');
INSERT INTO `syc_purchase_goods` VALUES ('93', '42', '42', 'FR-4 TG170 1.40MM 1/1 41”*49“ 含铜厚 黄料 无水印', '张', '8', '0', '0', '670.00', '5360.00', '[]', '1539053420');
INSERT INTO `syc_purchase_goods` VALUES ('94', '43', '72', '长春干膜 FF-9040S 15.250 *600FT *1卷', '卷', '2', '0', '0', '381.25', '762.50', '[]', '1539055810');
INSERT INTO `syc_purchase_goods` VALUES ('95', '43', '73', '长春干膜 FF-9040S 18.000 *600FT *1卷', '箱', '4', '0', '0', '450.00', '1800.00', '[]', '1539055810');
INSERT INTO `syc_purchase_goods` VALUES ('96', '43', '74', '长春干膜 FF-9040S 19.250 *600FT *1卷', '卷', '4', '0', '0', '481.25', '1925.00', '[]', '1539055810');
INSERT INTO `syc_purchase_goods` VALUES ('97', '43', '75', '长春干膜 FF-9040S 20.000 *600FT *1卷', '卷', '10', '0', '0', '500.00', '5000.00', '[]', '1539055810');
INSERT INTO `syc_purchase_goods` VALUES ('98', '43', '76', '长春干膜 FF-9040S 20.250 *600FT *1卷', '卷', '4', '0', '0', '506.25', '2025.00', '[]', '1539055810');
INSERT INTO `syc_purchase_goods` VALUES ('99', '43', '77', '长春干膜 FF-9040S 21.500 *600FT *1卷', '卷', '4', '0', '0', '537.50', '2150.00', '[]', '1539055810');
INSERT INTO `syc_purchase_goods` VALUES ('100', '43', '78', '长春干膜 FF-9040S 22.000 *600FT *1卷', '卷', '4', '0', '0', '550.00', '2200.00', '[]', '1539055810');
INSERT INTO `syc_purchase_goods` VALUES ('101', '43', '79', '长春干膜 FF-9040S 22.250 *600FT *1卷', '卷', '4', '0', '0', '556.25', '2225.00', '[]', '1539055810');
INSERT INTO `syc_purchase_goods` VALUES ('102', '43', '80', '长春干膜 FF-9040S 22.500 *600FT *1卷', '卷', '10', '0', '0', '562.50', '5625.00', '[]', '1539055810');
INSERT INTO `syc_purchase_goods` VALUES ('103', '43', '81', '长春干膜 FF-9040S 23.000 *600FT *1卷', '卷', '10', '0', '0', '575.00', '5750.00', '[]', '1539055810');
INSERT INTO `syc_purchase_goods` VALUES ('104', '43', '82', '长春干膜 FF-9040S 23.250 *600FT *1卷', '卷', '10', '0', '0', '581.25', '5812.50', '[]', '1539055810');
INSERT INTO `syc_purchase_goods` VALUES ('105', '43', '83', '长春干膜 FF-9040S 23.500 *600FT *1卷', '卷', '4', '0', '0', '587.50', '2350.00', '[]', '1539055810');
INSERT INTO `syc_purchase_goods` VALUES ('106', '43', '92', '长春干膜 FF-9040S 24.000 *600FT *1卷', '卷', '70', '0', '0', '600.00', '42000.00', '[]', '1539055810');
INSERT INTO `syc_purchase_goods` VALUES ('107', '43', '84', '长春干膜 FF-9040S 24.250 *600FT *1卷', '卷', '80', '0', '0', '606.25', '48500.00', '[]', '1539055810');
INSERT INTO `syc_purchase_goods` VALUES ('108', '43', '85', '长春干膜 FF-9040S 24.500 *600FT *1卷', '卷', '12', '0', '0', '612.50', '7350.00', '[]', '1539055810');
INSERT INTO `syc_purchase_goods` VALUES ('109', '44', '44', 'FR-4 TG140 CTI≥600 1.10MM H/H 43“*49” 含铜厚 黄料 无水印', '张', '10', '0', '0', '132.00', '1320.00', '[{\"goods_attr_id\":12,\"attr_name\":\"\\u7c7b\\u578b\",\"attr_value\":\"FR-4\"},{\"goods_attr_id\":22,\"attr_name\":\"\\u80f6\\u7cfb\",\"attr_value\":\"TG140 CTI\\u2265600\"},{\"goods_attr_id\":14,\"attr_name\":\"\\u677f\\u539a\",\"attr_value\":\"1.10MM\"},{\"goods_attr_id\":16,\"attr_name\":\"\\u94dc\\u539a\",\"attr_value\":\"H\\/H\"},{\"goods_attr_id\":19,\"attr_name\":\"\\u5c3a\\u5bf8\",\"attr_value\":\"43\\u201c*49\\u201d\"},{\"goods_attr_id\":21,\"attr_name\":\"\\u662f\\u5426\\u542b\\u94dc\",\"attr_value\":\"\\u542b\\u94dc\\u539a\"},{\"goods_attr_id\":20,\"attr_name\":\"\\u8272\\u7cfb\",\"attr_value\":\"\\u9ec4\\u6599\"},{\"goods_attr_id\":23,\"attr_name\":\"\\u6709\\u65e0\\u6c34\\u5370\",\"attr_value\":\"\\u65e0\\u6c34\\u5370\"}]', '1539757073');
INSERT INTO `syc_purchase_goods` VALUES ('110', '44', '47', 'FR-4 TG140 1.40MM H/H 37“*49” 含铜厚 黄料 无水印', '张', '9', '0', '0', '134.00', '1206.00', '[{\"goods_attr_id\":12,\"attr_name\":\"\\u7c7b\\u578b\",\"attr_value\":\"FR-4\"},{\"goods_attr_id\":22,\"attr_name\":\"\\u80f6\\u7cfb\",\"attr_value\":\"TG140\"},{\"goods_attr_id\":14,\"attr_name\":\"\\u677f\\u539a\",\"attr_value\":\"1.40MM\"},{\"goods_attr_id\":16,\"attr_name\":\"\\u94dc\\u539a\",\"attr_value\":\"H\\/H\"},{\"goods_attr_id\":19,\"attr_name\":\"\\u5c3a\\u5bf8\",\"attr_value\":\"37\\u201c*49\\u201d\"},{\"goods_attr_id\":21,\"attr_name\":\"\\u662f\\u5426\\u542b\\u94dc\",\"attr_value\":\"\\u542b\\u94dc\\u539a\"},{\"goods_attr_id\":20,\"attr_name\":\"\\u8272\\u7cfb\",\"attr_value\":\"\\u9ec4\\u6599\"},{\"goods_attr_id\":23,\"attr_name\":\"\\u6709\\u65e0\\u6c34\\u5370\",\"attr_value\":\"\\u65e0\\u6c34\\u5370\"}]', '1539757073');
INSERT INTO `syc_purchase_goods` VALUES ('111', '44', '49', 'FR-4 TG140 1.50MM 1/0 41”*49“ 含铜厚 黄料 无水印', '张', '6', '0', '0', '142.00', '852.00', '[{\"goods_attr_id\":12,\"attr_name\":\"\\u7c7b\\u578b\",\"attr_value\":\"FR-4\"},{\"goods_attr_id\":22,\"attr_name\":\"\\u80f6\\u7cfb\",\"attr_value\":\"TG140\"},{\"goods_attr_id\":14,\"attr_name\":\"\\u677f\\u539a\",\"attr_value\":\"1.50MM\"},{\"goods_attr_id\":16,\"attr_name\":\"\\u94dc\\u539a\",\"attr_value\":\"1\\/0\"},{\"goods_attr_id\":19,\"attr_name\":\"\\u5c3a\\u5bf8\",\"attr_value\":\"41\\u201d*49\\u201c\"},{\"goods_attr_id\":21,\"attr_name\":\"\\u662f\\u5426\\u542b\\u94dc\",\"attr_value\":\"\\u542b\\u94dc\\u539a\"},{\"goods_attr_id\":20,\"attr_name\":\"\\u8272\\u7cfb\",\"attr_value\":\"\\u9ec4\\u6599\"},{\"goods_attr_id\":23,\"attr_name\":\"\\u6709\\u65e0\\u6c34\\u5370\",\"attr_value\":\"\\u65e0\\u6c34\\u5370\"}]', '1539757073');
INSERT INTO `syc_purchase_goods` VALUES ('112', '45', '27', '长春干膜 FF-9040S 12.500 *600FT *2卷', '箱', '1', '0', '0', '12.00', '12.00', '[]', '1542181431');

-- ----------------------------
-- Table structure for syc_purchase_orders
-- ----------------------------
DROP TABLE IF EXISTS `syc_purchase_orders`;
CREATE TABLE `syc_purchase_orders` (
  `oid` int(16) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `xuhao` tinyint(4) NOT NULL DEFAULT '0' COMMENT '序号',
  `ord_pnumber` char(20) NOT NULL DEFAULT '' COMMENT '订单号',
  `yanse` char(10) NOT NULL DEFAULT '' COMMENT '产品颜色',
  `products` char(10) NOT NULL DEFAULT '' COMMENT '编号系列',
  `chanph` char(20) NOT NULL DEFAULT '0' COMMENT '编号数字',
  `breadth` char(20) NOT NULL DEFAULT '' COMMENT '规格-宽',
  `heiget` char(10) NOT NULL DEFAULT '' COMMENT '规格-高',
  `mianji` decimal(6,2) NOT NULL DEFAULT '0.00' COMMENT '计算面积',
  `thick` char(10) NOT NULL DEFAULT '' COMMENT '规格-厚',
  `diaojiao` char(50) NOT NULL DEFAULT '' COMMENT '吊脚高度',
  `attribute` char(50) NOT NULL DEFAULT '' COMMENT '包边线属性',
  `baobian` char(100) NOT NULL DEFAULT '' COMMENT '包边线名称',
  `suoxiang` char(100) NOT NULL DEFAULT '' COMMENT '锁向',
  `fittings` char(100) NOT NULL DEFAULT '' COMMENT '锁具',
  `quantity` char(100) NOT NULL DEFAULT '' COMMENT '数量',
  `unitPrice` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '单价',
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '金额',
  `remark` char(100) NOT NULL DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`oid`)
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8 COMMENT='销售订单_产品附表';

-- ----------------------------
-- Records of syc_purchase_orders
-- ----------------------------
INSERT INTO `syc_purchase_orders` VALUES ('64', '1', '10364079354', '黄花梨', 'P10', '36', '800', '1900', '1.80', '200', '20', '', '单包边', '左锁外开', '白至尊', '2', '1685.00', '3370.00', '备注1');
INSERT INTO `syc_purchase_orders` VALUES ('65', '2', '10364079354', '红木3', 'P10', '20', '850', '2000', '1.80', '250', '25', '', '双包边', '左锁外开', '白至尊', '3', '1735.00', '1735.00', '212');
INSERT INTO `syc_purchase_orders` VALUES ('67', '1', '10364078967', '黄花梨', 'P', '36', '100', '1900', '1.80', '200', '20', '', '单包边', '左锁外开', '至尊锁', '1', '1724.00', '1724.00', '');
INSERT INTO `syc_purchase_orders` VALUES ('68', '1', '10364076395', '红木', 'P10', '36', '850', '1980', '1.80', '220', '20', '', '单包边', '左锁外开', '白至尊', '5', '1685.00', '8425.00', '');
INSERT INTO `syc_purchase_orders` VALUES ('69', '1', '10364099578', '黄花梨', 'P', '20', '800', '1900', '1.80', '200', '20', '', '单包边', '左锁内开', '白至尊', '1', '1659.00', '1659.00', '');
INSERT INTO `syc_purchase_orders` VALUES ('70', '1', '20171102762', '黄花梨', 'P', '20', '880', '1980', '1.80', '200', '20', '', '单包边', '左锁外开', '白至尊', '1', '1492.12', '1492.12', '');
INSERT INTO `syc_purchase_orders` VALUES ('71', '1', '20171102946', '金橡木', 'P10', '20', '880', '1900', '1.80', '200', '20', '', '双包边', '右锁内开', '白至尊', '1', '1468.00', '1468.00', '');
INSERT INTO `syc_purchase_orders` VALUES ('72', '1', '20171102456', '红木', 's', '20', '880', '1900', '1.80', '200', '20', '', '双包边', '右锁内开', '白至尊', '1', '1006.52', '1006.52', '');
INSERT INTO `syc_purchase_orders` VALUES ('73', '1', '20171108247', '黄花梨', 'P10', '10', '800', '1900', '1.80', '200', '20', '', '单包边', '左锁外开', '白至尊', '1', '1438.00', '1438.00', '');
INSERT INTO `syc_purchase_orders` VALUES ('74', '1', '20171120210', '黄花梨', 'P', '801', '880', '2000', '1.80', '200', '20', '', '双包边', '左锁外开', '白至尊', '1', '1522.12', '1522.12', '');
INSERT INTO `syc_purchase_orders` VALUES ('75', '2', '20171120210', '红木', 'P20', '902', '900', '2050', '1.85', '200', '20', '', '单包边', '左锁内开', '至尊锁', '1', '982.50', '982.50', '');
INSERT INTO `syc_purchase_orders` VALUES ('77', '1', '20171120179', '黄花梨', 'P', '801', '800', '1980', '1.80', '200', '20', '', '单包边', '左锁内开', '白至尊', '1', '1492.12', '1492.12', '001');
INSERT INTO `syc_purchase_orders` VALUES ('78', '1', '20171122139', '黄花梨', 'P20', '902', '880', '1999', '1.80', '200', '20', '', '双包边', '左锁内开', '白至尊', '1', '1223.00', '1223.00', '');
INSERT INTO `syc_purchase_orders` VALUES ('79', '1', '20171124237', '金橡木', 'Y', '801', '800', '1900', '1.80', '200', '20', '', '单包边', '左锁外开', '白至尊', '1', '740.52', '740.52', '');
INSERT INTO `syc_purchase_orders` VALUES ('80', '1', '20171124168', '金橡木', 'P', '801D', '800', '1900', '1.80', '200', '20', '', '单包边', '左锁内开', '白至尊', '1', '1492.12', '1492.12', '');
INSERT INTO `syc_purchase_orders` VALUES ('81', '2', '20171124168', '金橡木', 'P', '801d', '800', '1900', '1.80', '200', '20', '', '双包边', '左锁外开', '至尊锁', '1', '1527.12', '1527.12', '');
INSERT INTO `syc_purchase_orders` VALUES ('87', '1', '20171201520', '黄花梨', 'P', '801', '800', '1900', '1.80', '200', '20', 'Y', '双包边', '左锁内开', '白至尊', '1', '1519.00', '1519.00', '');
INSERT INTO `syc_purchase_orders` VALUES ('88', '1', '20171202965', '金橡木', 'P', '801', '800', '1990', '1.80', '200', '20', 'Y', '单包边', '左锁外开', '至尊锁', '1', '1497.12', '1497.12', '');
INSERT INTO `syc_purchase_orders` VALUES ('110', '1', '20180109670', '黄花梨', 'P', '801', '800', '1900', '1.80', '200', '-', '-', '-', '-', '-', '1', '1407.12', '1407.12', '备注2备注2备注2备注2备注2');
INSERT INTO `syc_purchase_orders` VALUES ('111', '2', '20180109670', '金橡木', 'P', '801', '810', '1950', '1.80', '200', '-', '-', '-', '-', '-', '1', '1407.12', '1407.12', '备注2');
INSERT INTO `syc_purchase_orders` VALUES ('112', '3', '20180109670', '红木', 'P', '801', '820', '1960', '1.80', '200', '-', '-', '-', '-', '-', '1', '1407.12', '1407.12', '备注3');
INSERT INTO `syc_purchase_orders` VALUES ('113', '4', '20180109670', '黄花梨3', 'P', '801', '850', '2000', '1.80', '200', '-', '-', '-', '-', '-', '1', '1407.12', '1407.12', '备注4');

-- ----------------------------
-- Table structure for syc_receivables
-- ----------------------------
DROP TABLE IF EXISTS `syc_receivables`;
CREATE TABLE `syc_receivables` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin_uid` int(10) unsigned NOT NULL DEFAULT '0',
  `cus_id` int(10) unsigned NOT NULL DEFAULT '0',
  `cus_name` varchar(255) NOT NULL DEFAULT '',
  `delivery_ids` varchar(255) NOT NULL DEFAULT '',
  `invoice_sn` varchar(100) NOT NULL DEFAULT '',
  `invoice_date` varchar(50) NOT NULL DEFAULT '',
  `total_money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `confirm_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '确认金额',
  `pay_money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `diff_money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `is_open` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1已开票',
  `files` varchar(255) NOT NULL DEFAULT '' COMMENT '附件',
  `is_confirm` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否确认',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '0已关闭，1待核销，2已核销',
  `is_delete` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1已删除',
  `update_time` int(10) NOT NULL,
  `create_time` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cus_id` (`cus_id`,`invoice_sn`,`invoice_date`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of syc_receivables
-- ----------------------------
INSERT INTO `syc_receivables` VALUES ('5', '2', '1689', '清远市富盈电子有限公司', '39', 'DZ20181001001', '2018-10-01', '8016.00', '0.00', '0.00', '0.00', '1', '', '1', '0', '0', '1538391038', '1538391038');
INSERT INTO `syc_receivables` VALUES ('6', '4', '1688', '惠州市利贞电子有限公司', '41', '1584334AAA', '2018-10-31', '2446.50', '0.00', '0.00', '0.00', '1', '', '1', '0', '0', '1539012450', '1539011357');
INSERT INTO `syc_receivables` VALUES ('8', '2', '1688', '惠州市利贞电子有限公司', '41', 'AR201810164983254', '2018-10-27', '2446.50', '2333.00', '0.00', '0.00', '0', '', '1', '1', '1', '1540624127', '1540624127');
INSERT INTO `syc_receivables` VALUES ('9', '2', '1688', '惠州市利贞电子有限公司', '41', 'AR201810165192786', '2018-10-27', '2446.50', '2333.00', '0.00', '0.00', '0', '/uploads/20181027/f22ad948b4004ad64a14a8e2f2384a6a.png', '0', '1', '1', '1540625211', '1540625211');
INSERT INTO `syc_receivables` VALUES ('10', '2', '1688', '惠州市利贞电子有限公司', '41', 'AR201810165241399', '2018-10-27', '2446.50', '2333.00', '0.00', '0.00', '0', '{\"path\":\"\\/uploads\\/20181027\\/8a41093c76f0f2991c9e7b92e940b7ea.png\",\"name\":\"1\\u5173\\u4e8e\\u6b63\\u8679.png\"}', '1', '1', '0', '1540625783', '1540625783');

-- ----------------------------
-- Table structure for syc_receivable_ticket
-- ----------------------------
DROP TABLE IF EXISTS `syc_receivable_ticket`;
CREATE TABLE `syc_receivable_ticket` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin_uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '管理员uid',
  `rec_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '对账单id',
  `ticket_date` varchar(100) NOT NULL DEFAULT '' COMMENT '开票日期',
  `ticket_sn` varchar(100) NOT NULL DEFAULT '' COMMENT '发票号码',
  `money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `remark` text COMMENT '备注',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='应收账款发票表';

-- ----------------------------
-- Records of syc_receivable_ticket
-- ----------------------------
INSERT INTO `syc_receivable_ticket` VALUES ('1', '2', '10', '2018-10-27', '201810165019199', '100.00', '备注备注备注备注备注备注备注备注备注备注备注备注备注', '1540648375');
INSERT INTO `syc_receivable_ticket` VALUES ('2', '2', '10', '2018-10-27', '201810165019199', '100.00', '备注备注备注备注备注备注备注备注备注备注备注备注备注', '1540648483');
INSERT INTO `syc_receivable_ticket` VALUES ('3', '2', '10', '2018-10-27', '201810164806510', '100.00', 'gdsfaffsafsafa', '1540648853');
INSERT INTO `syc_receivable_ticket` VALUES ('4', '2', '10', '2018-10-27', '201810165199253', '0.00', '', '1540654506');
INSERT INTO `syc_receivable_ticket` VALUES ('5', '2', '10', '2018-10-27', '201810164685660', '0.00', '', '1540654588');
INSERT INTO `syc_receivable_ticket` VALUES ('6', '2', '10', '2018-10-27', '201810164518681', '0.00', '', '1540654863');

-- ----------------------------
-- Table structure for syc_statistics
-- ----------------------------
DROP TABLE IF EXISTS `syc_statistics`;
CREATE TABLE `syc_statistics` (
  `pay_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `pay_cus_id` int(10) NOT NULL COMMENT '企业ID',
  `pay_pbname` char(50) NOT NULL COMMENT '企业名称',
  `pay_pnumber` char(20) NOT NULL DEFAULT '' COMMENT '订单号',
  `pay_pcount` tinyint(4) NOT NULL DEFAULT '0' COMMENT '订数量',
  `pay_pyouhui` tinyint(4) NOT NULL DEFAULT '100' COMMENT '订单优惠',
  `pay_shijine` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '实际金额',
  `pay_ddanjine` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '订单金额',
  `pay_yhuijine` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '优惠金额',
  `pay_sshoujine` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '实收金额',
  `pay_wshoujine` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '未收金额',
  `pay_jueklv` decimal(4,2) NOT NULL DEFAULT '0.00' COMMENT '结款率',
  `pay_pstart_date` date NOT NULL COMMENT '销售日期',
  `pay_pend_date` date NOT NULL COMMENT '发货日期',
  `create_time` int(16) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(16) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`pay_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='完成订单统计';

-- ----------------------------
-- Records of syc_statistics
-- ----------------------------

-- ----------------------------
-- Table structure for syc_stockpile
-- ----------------------------
DROP TABLE IF EXISTS `syc_stockpile`;
CREATE TABLE `syc_stockpile` (
  `sp_id` int(16) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `sp_pcid` int(10) NOT NULL DEFAULT '0' COMMENT '产品颜色ID',
  `sp_lxid` int(10) NOT NULL DEFAULT '0' COMMENT '料型ID',
  `sp_quantity` char(10) NOT NULL DEFAULT '0' COMMENT '数量',
  `create_time` int(16) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(16) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`sp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 COMMENT='库存数量表';

-- ----------------------------
-- Records of syc_stockpile
-- ----------------------------
INSERT INTO `syc_stockpile` VALUES ('26', '24', '18', '0', '1512126620', '1512126620', '1');
INSERT INTO `syc_stockpile` VALUES ('27', '23', '18', '-0.5', '1512126620', '1512126620', '1');
INSERT INTO `syc_stockpile` VALUES ('28', '22', '18', '-0.5', '1512126620', '1512128864', '1');
INSERT INTO `syc_stockpile` VALUES ('29', '25', '18', '0', '1512126620', '1512126620', '1');
INSERT INTO `syc_stockpile` VALUES ('30', '24', '19', '0', '1512126678', '1512126678', '1');
INSERT INTO `syc_stockpile` VALUES ('31', '23', '19', '-1.5', '1512126678', '1512126678', '1');
INSERT INTO `syc_stockpile` VALUES ('32', '22', '19', '-1.5', '1512126678', '1512128864', '1');
INSERT INTO `syc_stockpile` VALUES ('33', '25', '19', '0', '1512126678', '1512126678', '1');
INSERT INTO `syc_stockpile` VALUES ('34', '24', '20', '0', '1512126714', '1512126714', '1');
INSERT INTO `syc_stockpile` VALUES ('35', '23', '20', '-2', '1512126714', '1512126714', '1');
INSERT INTO `syc_stockpile` VALUES ('36', '22', '20', '-2', '1512126714', '1512128864', '1');
INSERT INTO `syc_stockpile` VALUES ('37', '25', '20', '0', '1512126714', '1512126714', '1');
INSERT INTO `syc_stockpile` VALUES ('38', '24', '21', '0', '1512126926', '1512126926', '1');
INSERT INTO `syc_stockpile` VALUES ('39', '23', '21', '0', '1512126926', '1512126926', '1');
INSERT INTO `syc_stockpile` VALUES ('40', '22', '21', '-2.5', '1512126926', '1512128864', '1');
INSERT INTO `syc_stockpile` VALUES ('41', '25', '21', '0', '1512126926', '1512126926', '1');
INSERT INTO `syc_stockpile` VALUES ('42', '24', '22', '0', '1512126956', '1512126956', '1');
INSERT INTO `syc_stockpile` VALUES ('43', '23', '22', '0', '1512126956', '1512126956', '1');
INSERT INTO `syc_stockpile` VALUES ('44', '22', '22', '-3', '1512126956', '1512128864', '1');
INSERT INTO `syc_stockpile` VALUES ('45', '25', '22', '0', '1512126956', '1512126956', '1');
INSERT INTO `syc_stockpile` VALUES ('46', '24', '23', '0', '1512126984', '1512126984', '1');
INSERT INTO `syc_stockpile` VALUES ('47', '23', '23', '0', '1512126984', '1512126984', '1');
INSERT INTO `syc_stockpile` VALUES ('48', '22', '23', '-1', '1512126984', '1512128864', '1');
INSERT INTO `syc_stockpile` VALUES ('49', '25', '23', '0', '1512126984', '1512126984', '1');
INSERT INTO `syc_stockpile` VALUES ('50', '24', '24', '0', '1512127012', '1512127012', '1');
INSERT INTO `syc_stockpile` VALUES ('51', '23', '24', '0', '1512127012', '1512127012', '1');
INSERT INTO `syc_stockpile` VALUES ('52', '22', '24', '-1', '1512127012', '1512128864', '1');
INSERT INTO `syc_stockpile` VALUES ('53', '25', '24', '0', '1512127012', '1512127012', '1');

-- ----------------------------
-- Table structure for syc_stockpile_lock
-- ----------------------------
DROP TABLE IF EXISTS `syc_stockpile_lock`;
CREATE TABLE `syc_stockpile_lock` (
  `stid` int(16) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `st_lid` int(10) NOT NULL COMMENT '锁具',
  `st_quantity` int(6) NOT NULL DEFAULT '0' COMMENT '数量',
  `create_time` int(16) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(16) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`stid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='配件锁具库存表';

-- ----------------------------
-- Records of syc_stockpile_lock
-- ----------------------------
INSERT INTO `syc_stockpile_lock` VALUES ('1', '1', '-1', '1507531190', '1512128850', '1');
INSERT INTO `syc_stockpile_lock` VALUES ('2', '2', '-1', '1511074473', '1512126762', '1');

-- ----------------------------
-- Table structure for syc_storage_charge
-- ----------------------------
DROP TABLE IF EXISTS `syc_storage_charge`;
CREATE TABLE `syc_storage_charge` (
  `lxid` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `lxxhao` char(20) NOT NULL COMMENT '料型型号',
  `lxname` char(30) NOT NULL COMMENT '料型名称',
  `lxkg` char(20) NOT NULL DEFAULT '0' COMMENT 'KG/M',
  `lxzhic` char(20) NOT NULL DEFAULT '0' COMMENT '支长/M',
  `lximg` varchar(250) NOT NULL DEFAULT '' COMMENT '图片',
  `lx_uid` int(10) NOT NULL COMMENT '添加员',
  `create_time` int(16) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(16) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`lxid`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COMMENT='料型名称表';

-- ----------------------------
-- Records of syc_storage_charge
-- ----------------------------
INSERT INTO `syc_storage_charge` VALUES ('18', 'H-02', '反包边', '1.085', '5.3', '', '1', '1512126620', '1512126620', '1');
INSERT INTO `syc_storage_charge` VALUES ('19', 'H-07', '扇光企', '0.889', '5.9', '', '1', '1512126678', '1512126678', '1');
INSERT INTO `syc_storage_charge` VALUES ('20', 'H-05', '门芯框', '0.663', '6', '', '1', '1512126714', '1512126714', '1');
INSERT INTO `syc_storage_charge` VALUES ('21', 'H-09', '光企盖', '0.14', '5.9', '', '1', '1512126926', '1512126926', '1');
INSERT INTO `syc_storage_charge` VALUES ('22', 'H-10', '墙扣板', '0.58', '5', '', '1', '1512126956', '1512126956', '1');
INSERT INTO `syc_storage_charge` VALUES ('23', 'H-08', '扣板槽', '0.16', '5', '', '1', '1512126984', '1512126984', '1');
INSERT INTO `syc_storage_charge` VALUES ('24', 'H-06', '包边座', '0.45', '5.4', '', '1', '1512127012', '1512127012', '1');

-- ----------------------------
-- Table structure for syc_store_log
-- ----------------------------
DROP TABLE IF EXISTS `syc_store_log`;
CREATE TABLE `syc_store_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `input_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '采购入库id',
  `delivery_id` int(10) unsigned NOT NULL DEFAULT '0',
  `order_id` int(10) unsigned NOT NULL DEFAULT '0',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1入库，2出库，3报溢，4报损，5采购入库',
  `goods_id` int(10) unsigned NOT NULL DEFAULT '0',
  `goods_name` varchar(255) NOT NULL DEFAULT '',
  `number` int(10) unsigned NOT NULL DEFAULT '0',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `delivery_id` (`delivery_id`,`goods_id`)
) ENGINE=InnoDB AUTO_INCREMENT=119 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of syc_store_log
-- ----------------------------
INSERT INTO `syc_store_log` VALUES ('55', '0', '27', '26', '2', '9', 'FR4 1.4MM H/H 37\"*49\" 含铜 黄料', '5', '1535815507');
INSERT INTO `syc_store_log` VALUES ('56', '0', '27', '26', '1', '9', 'FR4 1.4MM H/H 37\"*49\" 含铜 黄料', '0', '1535815507');
INSERT INTO `syc_store_log` VALUES ('57', '0', '28', '26', '2', '9', 'FR4 1.4MM H/H 37\"*49\" 含铜 黄料', '5', '1535815744');
INSERT INTO `syc_store_log` VALUES ('58', '0', '28', '26', '1', '9', 'FR4 1.4MM H/H 37\"*49\" 含铜 黄料', '0', '1535815744');
INSERT INTO `syc_store_log` VALUES ('59', '0', '29', '27', '2', '9', 'FR4 1.4MM H/H 37\"*49\" 含铜 黄料', '5', '1535815842');
INSERT INTO `syc_store_log` VALUES ('60', '0', '29', '27', '1', '9', 'FR4 1.4MM H/H 37\"*49\" 含铜 黄料', '0', '1535815842');
INSERT INTO `syc_store_log` VALUES ('61', '0', '30', '30', '2', '11', 'FF-9040S 20.250”*600FT*2卷', '10', '1536067579');
INSERT INTO `syc_store_log` VALUES ('62', '0', '30', '30', '1', '11', 'FF-9040S 20.250”*600FT*2卷', '0', '1536067579');
INSERT INTO `syc_store_log` VALUES ('63', '0', '30', '30', '2', '12', 'FF-9040S 22.000\"*600FT*2卷', '5', '1536067579');
INSERT INTO `syc_store_log` VALUES ('64', '0', '30', '30', '1', '12', 'FF-9040S 22.000\"*600FT*2卷', '0', '1536067579');
INSERT INTO `syc_store_log` VALUES ('65', '0', '30', '30', '2', '13', 'FF-9050S  16.000\"*500FT*2卷', '2', '1536067579');
INSERT INTO `syc_store_log` VALUES ('66', '0', '30', '30', '1', '13', 'FF-9050S  16.000\"*500FT*2卷', '0', '1536067579');
INSERT INTO `syc_store_log` VALUES ('67', '0', '31', '32', '2', '11', 'FF-9040S 20.250”*600FT*2卷', '40', '1536157333');
INSERT INTO `syc_store_log` VALUES ('68', '0', '31', '32', '1', '11', 'FF-9040S 20.250”*600FT*2卷', '0', '1536157333');
INSERT INTO `syc_store_log` VALUES ('69', '0', '32', '33', '2', '8', 'FR-4 CTI≥600 1.1MM H/H 41\"*49\" 含铜 黄料 无水印', '50', '1536214273');
INSERT INTO `syc_store_log` VALUES ('70', '0', '32', '33', '1', '8', 'FR-4 CTI≥600 1.1MM H/H 41\"*49\" 含铜 黄料 无水印', '0', '1536214273');
INSERT INTO `syc_store_log` VALUES ('71', '0', '32', '33', '2', '9', 'FR-4 TG140 1.4MM H/H 37\"*49\" 含铜 黄料 无水印', '42', '1536214273');
INSERT INTO `syc_store_log` VALUES ('72', '0', '32', '33', '1', '9', 'FR-4 TG140 1.4MM H/H 37\"*49\" 含铜 黄料 无水印', '0', '1536214273');
INSERT INTO `syc_store_log` VALUES ('73', '0', '33', '34', '2', '8', 'FR-4 CTI≥600 1.1MM H/H 41\"*49\" 含铜 黄料 无水印', '200', '1536219231');
INSERT INTO `syc_store_log` VALUES ('74', '0', '33', '34', '1', '8', 'FR-4 CTI≥600 1.1MM H/H 41\"*49\" 含铜 黄料 无水印', '0', '1536219231');
INSERT INTO `syc_store_log` VALUES ('75', '0', '33', '34', '2', '9', 'FR-4 TG140 1.4MM H/H 37\"*49\" 含铜 黄料 无水印', '1000', '1536219231');
INSERT INTO `syc_store_log` VALUES ('76', '0', '33', '34', '1', '9', 'FR-4 TG140 1.4MM H/H 37\"*49\" 含铜 黄料 无水印', '0', '1536219231');
INSERT INTO `syc_store_log` VALUES ('77', '0', '34', '37', '2', '21', '长春干膜 FF-9040S 23.250“ *600FT *1卷', '10', '1537104795');
INSERT INTO `syc_store_log` VALUES ('78', '0', '34', '37', '1', '21', '长春干膜 FF-9040S 23.250“ *600FT *1卷', '0', '1537104795');
INSERT INTO `syc_store_log` VALUES ('79', '0', '34', '37', '2', '22', '长春干膜 FF-9040S 23.500” *600FT *1卷', '10', '1537104795');
INSERT INTO `syc_store_log` VALUES ('80', '0', '34', '37', '1', '22', '长春干膜 FF-9040S 23.500” *600FT *1卷', '0', '1537104795');
INSERT INTO `syc_store_log` VALUES ('81', '0', '34', '37', '2', '23', '长春干膜 FF-9040S 24.000 *600FT *1卷', '30', '1537104795');
INSERT INTO `syc_store_log` VALUES ('82', '0', '34', '37', '1', '23', '长春干膜 FF-9040S 24.000 *600FT *1卷', '0', '1537104795');
INSERT INTO `syc_store_log` VALUES ('83', '0', '34', '37', '2', '24', '长春干膜 FF-9040S 24.250“ *600FT *1卷', '20', '1537104795');
INSERT INTO `syc_store_log` VALUES ('84', '0', '34', '37', '1', '24', '长春干膜 FF-9040S 24.250“ *600FT *1卷', '0', '1537104795');
INSERT INTO `syc_store_log` VALUES ('85', '0', '35', '41', '2', '11', 'FF-9040S 20.250”*600FT*2卷', '10', '1538116716');
INSERT INTO `syc_store_log` VALUES ('86', '0', '35', '41', '1', '11', 'FF-9040S 20.250”*600FT*2卷', '0', '1538116716');
INSERT INTO `syc_store_log` VALUES ('87', '0', '35', '41', '2', '22', '长春干膜 FF-9040S 23.500” *600FT *1卷', '10', '1538116716');
INSERT INTO `syc_store_log` VALUES ('88', '0', '35', '41', '1', '22', '长春干膜 FF-9040S 23.500” *600FT *1卷', '0', '1538116716');
INSERT INTO `syc_store_log` VALUES ('89', '0', '35', '41', '2', '24', '长春干膜 FF-9040S 24.250“ *600FT *1卷', '10', '1538116716');
INSERT INTO `syc_store_log` VALUES ('90', '0', '35', '41', '1', '24', '长春干膜 FF-9040S 24.250“ *600FT *1卷', '0', '1538116716');
INSERT INTO `syc_store_log` VALUES ('91', '0', '36', '41', '2', '11', 'FF-9040S 20.250”*600FT*2卷', '10', '1538116911');
INSERT INTO `syc_store_log` VALUES ('92', '0', '36', '41', '1', '11', 'FF-9040S 20.250”*600FT*2卷', '0', '1538116911');
INSERT INTO `syc_store_log` VALUES ('93', '0', '36', '41', '2', '22', '长春干膜 FF-9040S 23.500” *600FT *1卷', '10', '1538116911');
INSERT INTO `syc_store_log` VALUES ('94', '0', '36', '41', '1', '22', '长春干膜 FF-9040S 23.500” *600FT *1卷', '0', '1538116911');
INSERT INTO `syc_store_log` VALUES ('95', '0', '37', '44', '2', '8', 'FR-4 CTI≥600 1.1MM H/H 41\"*49\" 含铜 黄料 无水印', '45', '1538386709');
INSERT INTO `syc_store_log` VALUES ('96', '0', '37', '44', '1', '8', 'FR-4 CTI≥600 1.1MM H/H 41\"*49\" 含铜 黄料 无水印', '0', '1538386709');
INSERT INTO `syc_store_log` VALUES ('97', '0', '37', '44', '2', '9', 'FR-4 TG140 1.4MM H/H 37\"*49\" 含铜 黄料 无水印', '12', '1538386709');
INSERT INTO `syc_store_log` VALUES ('98', '0', '37', '44', '1', '9', 'FR-4 TG140 1.4MM H/H 37\"*49\" 含铜 黄料 无水印', '0', '1538386709');
INSERT INTO `syc_store_log` VALUES ('99', '0', '38', '45', '2', '14', 'FR-4 TG140 CTI≥600 1.00MM H/H 41”*49“ 含铜厚 黄料 无水印', '10', '1538387064');
INSERT INTO `syc_store_log` VALUES ('100', '0', '38', '45', '1', '14', 'FR-4 TG140 CTI≥600 1.00MM H/H 41”*49“ 含铜厚 黄料 无水印', '0', '1538387064');
INSERT INTO `syc_store_log` VALUES ('101', '0', '38', '45', '2', '15', 'FR-4 TG135 1.50MM 2/0 41”*49“ 含铜厚 黄料 无水印', '12', '1538387064');
INSERT INTO `syc_store_log` VALUES ('102', '0', '38', '45', '1', '15', 'FR-4 TG135 1.50MM 2/0 41”*49“ 含铜厚 黄料 无水印', '0', '1538387064');
INSERT INTO `syc_store_log` VALUES ('103', '0', '39', '47', '2', '8', 'FR-4 CTI≥600 1.1MM H/H 41\"*49\" 含铜 黄料 无水印', '42', '1538390830');
INSERT INTO `syc_store_log` VALUES ('104', '0', '39', '47', '1', '8', 'FR-4 CTI≥600 1.1MM H/H 41\"*49\" 含铜 黄料 无水印', '0', '1538390830');
INSERT INTO `syc_store_log` VALUES ('105', '0', '39', '47', '2', '9', 'FR-4 TG140 1.4MM H/H 37\"*49\" 含铜 黄料 无水印', '32', '1538390830');
INSERT INTO `syc_store_log` VALUES ('106', '0', '39', '47', '1', '9', 'FR-4 TG140 1.4MM H/H 37\"*49\" 含铜 黄料 无水印', '0', '1538390830');
INSERT INTO `syc_store_log` VALUES ('107', '0', '40', '48', '2', '31', '长春干膜 FF-9040S 15.500 *600FT *2卷', '1', '1538925414');
INSERT INTO `syc_store_log` VALUES ('108', '0', '40', '48', '1', '31', '长春干膜 FF-9040S 15.500 *600FT *2卷', '0', '1538925414');
INSERT INTO `syc_store_log` VALUES ('109', '0', '40', '48', '2', '39', '长春干膜 FF-9040S 20.000 *600FT *2卷', '3', '1538925414');
INSERT INTO `syc_store_log` VALUES ('110', '0', '40', '48', '1', '39', '长春干膜 FF-9040S 20.000 *600FT *2卷', '0', '1538925414');
INSERT INTO `syc_store_log` VALUES ('111', '0', '40', '48', '2', '41', '长春干膜 FF-9040S 20.500 *600FT *2卷', '3', '1538925414');
INSERT INTO `syc_store_log` VALUES ('112', '0', '40', '48', '1', '41', '长春干膜 FF-9040S 20.500 *600FT *2卷', '0', '1538925414');
INSERT INTO `syc_store_log` VALUES ('113', '0', '41', '49', '2', '39', '长春干膜 FF-9040S 20.000 *600FT *2卷', '1', '1539011119');
INSERT INTO `syc_store_log` VALUES ('114', '0', '41', '49', '1', '39', '长春干膜 FF-9040S 20.000 *600FT *2卷', '0', '1539011119');
INSERT INTO `syc_store_log` VALUES ('115', '0', '41', '49', '2', '53', '长春干膜 FF-9040S 14.000 *600FT *2卷', '1', '1539011119');
INSERT INTO `syc_store_log` VALUES ('116', '0', '41', '49', '1', '53', '长春干膜 FF-9040S 14.000 *600FT *2卷', '0', '1539011119');
INSERT INTO `syc_store_log` VALUES ('117', '0', '41', '49', '2', '54', '长春干膜 FF-9040S 18.500 *600FT *2卷', '1', '1539011119');
INSERT INTO `syc_store_log` VALUES ('118', '0', '41', '49', '1', '54', '长春干膜 FF-9040S 18.500 *600FT *2卷', '0', '1539011119');

-- ----------------------------
-- Table structure for syc_supplier
-- ----------------------------
DROP TABLE IF EXISTS `syc_supplier`;
CREATE TABLE `syc_supplier` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `default_con_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '默认联系人',
  `supplier_name` varchar(255) NOT NULL DEFAULT '',
  `supplier_short` varchar(255) NOT NULL DEFAULT '',
  `supplier_mobile` char(12) NOT NULL DEFAULT '',
  `supplier_contacts` varchar(50) NOT NULL DEFAULT '',
  `supplier_email` varchar(50) NOT NULL DEFAULT '',
  `supplier_fax` varchar(50) NOT NULL DEFAULT '',
  `supplier_post` varchar(100) NOT NULL DEFAULT '',
  `supplier_status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '0禁用',
  `supplier_qq` varchar(12) NOT NULL DEFAULT '',
  `supplier_like` varchar(255) NOT NULL DEFAULT '',
  `supplier_payment` varchar(100) NOT NULL DEFAULT '',
  `supplier_province` varchar(50) NOT NULL DEFAULT '',
  `supplier_city` varchar(50) NOT NULL DEFAULT '',
  `supplier_area` varchar(50) NOT NULL DEFAULT '',
  `supplier_address` varchar(255) NOT NULL DEFAULT '',
  `supplier_remark` text,
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  `add_uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加UID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of syc_supplier
-- ----------------------------
INSERT INTO `syc_supplier` VALUES ('1', '0', '供应商名称', '简称', '13800138000', '联系人', '353575573@qq.com', '020-12345678', '部门职务', '-1', '353575573', 'php', '现金交易', '广东省', '广州市', '天河区', '详细地址1', '备注内容备注内容备注内容', '1533632664', '1535596064', '2');
INSERT INTO `syc_supplier` VALUES ('2', '0', '重庆德凯实业股份有限公司', '重庆德凯', '13642982303', '赖小行', 'sc_csun@163.com', '0752-3532028', '业务', '1', '2161889756', '0752-3532018', '月结60天', '重庆市', '开县', '', '白鹤工业园区', '', '1536051669', '1538921458', '2');
INSERT INTO `syc_supplier` VALUES ('3', '0', '东莞卓越光像薄膜有限公司', '卓越光像', '0769-8339544', '戴剑梅', '1040312149@qq.com', '0769-83395442', '业务', '1', '', '0769-83395888', '月结60天', '广东省', '东莞市', '', '常平镇 土塘工业区王氏港建大道33号王氏港建科技园', '', '1536052017', '1538921178', '2');

-- ----------------------------
-- Table structure for syc_supplier_contacts
-- ----------------------------
DROP TABLE IF EXISTS `syc_supplier_contacts`;
CREATE TABLE `syc_supplier_contacts` (
  `con_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '自增',
  `supplier_id` int(10) NOT NULL COMMENT '客户ID',
  `con_name` char(16) NOT NULL COMMENT '姓名',
  `con_sex` tinyint(2) DEFAULT '1' COMMENT '性别1男0女',
  `con_post` char(20) NOT NULL DEFAULT '' COMMENT '职位',
  `con_section` varchar(255) NOT NULL DEFAULT '' COMMENT '部门',
  `con_mobile` char(20) NOT NULL DEFAULT '' COMMENT '手机号',
  `con_qq` char(20) NOT NULL DEFAULT '' COMMENT 'QQ',
  `con_email` char(30) NOT NULL DEFAULT '' COMMENT '邮箱',
  `con_address` varchar(50) NOT NULL DEFAULT '' COMMENT '详细地址',
  `con_description` varchar(200) NOT NULL DEFAULT '' COMMENT '备注信息',
  `create_time` int(16) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(16) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`con_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='客户联系人表';

-- ----------------------------
-- Records of syc_supplier_contacts
-- ----------------------------
INSERT INTO `syc_supplier_contacts` VALUES ('5', '1', 'nice172', '1', '开发者', '销售部', '13800138000', '354575573', '354575573@qq.com', '广东省广州市天河区中山大道西1025号', '客户备注内容', '1533614328', '1533614328', '1');
INSERT INTO `syc_supplier_contacts` VALUES ('6', '1', '蜡笔小新', '1', '仓管', '仓储物流部', '13800138001', '354575575', '354575573@qq.com', '广州市天河区中山大道西1025号', '备注蜡笔小新', '1533622131', '1533622131', '1');
INSERT INTO `syc_supplier_contacts` VALUES ('7', '2', '王力', '1', '惠州办仓管', '仓储物流部', '18028478389', '', 'tompeng@163.com', '广东省 惠州市 惠阳区 新圩镇 长布村', '', '1536066747', '1537099989', '1');

-- ----------------------------
-- Table structure for syc_users
-- ----------------------------
DROP TABLE IF EXISTS `syc_users`;
CREATE TABLE `syc_users` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `user_name` char(16) NOT NULL COMMENT '名称',
  `user_password` char(255) NOT NULL COMMENT '密码',
  `user_nick` char(20) NOT NULL COMMENT '别名',
  `user_sex` tinyint(2) DEFAULT '1' COMMENT '性别1男0女',
  `user_email` char(50) NOT NULL COMMENT '邮件',
  `user_img` varchar(250) NOT NULL DEFAULT '' COMMENT '头像',
  `entry_time` char(10) DEFAULT NULL COMMENT '入职时间',
  `user_count` int(6) NOT NULL DEFAULT '0' COMMENT '登录次数',
  `create_time` int(16) NOT NULL DEFAULT '0' COMMENT '注册时间',
  `update_time` int(16) NOT NULL DEFAULT '0' COMMENT '登录时间',
  `create_ip` char(16) NOT NULL DEFAULT '' COMMENT '注册IP',
  `update_ip` char(16) NOT NULL DEFAULT '' COMMENT '登录IP',
  `group_id` smallint(6) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(5) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_name` (`user_name`),
  UNIQUE KEY `user_nick` (`user_nick`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='用户信息表';

-- ----------------------------
-- Records of syc_users
-- ----------------------------
INSERT INTO `syc_users` VALUES ('1', 'asdasd', 'sha256:1000:X2vbzkCcKSScvZZ5ZUDs7DvTmergIc5u:fQt8UQynrp5psap5MoOq4scNMLNhcjIl', '开发者', '1', '354575573@qq.com', '/uploads/avatar/582d3a26a3369.jpg', '2017-01-01', '180', '1451577600', '1538191190', '127.0.0.1', '127.0.0.1', '16', '1');
INSERT INTO `syc_users` VALUES ('2', 'admin', 'sha256:1000:bb+qr8kui4m4JriYM/aLnznOODBwZfbi:30utxhFU7cxebnazg8Xh5TEkAmzR6ymJ', '管理员', '1', 'nice172@126.com', '', '2018-08-05', '84', '1533480247', '1542359090', '192.168.1.225', '', '16', '1');
INSERT INTO `syc_users` VALUES ('3', 'nice172', 'sha256:1000:GM0kcPbE+QNRSpmsG58qckJUkekhvpwi:XwmDtVMPAfE8DDYUdVW5DF5AOLljRm8q', '测试号', '1', 'nice172@163.com', '', '2018-08-06', '9', '1533526543', '1536806739', '10.10.0.99', '', '14', '1');
INSERT INTO `syc_users` VALUES ('4', 'tom', 'sha256:1000:VqFfxce0SSP92ZahxbPXg7BTznRFzDk9:o/oG8udat6G/OTMVUaxT+UXp+QaGoU1p', '彭立新', '1', 'tompeng@qq.com', '', '2015-09-01', '24', '1536054353', '1539048764', '183.4.133.164', '', '16', '1');
INSERT INTO `syc_users` VALUES ('5', 'wzc1997', 'sha256:1000:+78wHUCJ2i0Pqv/BtFpJNezAZSrysrl3:2M4x66/txhRftgPkD+Zzjvvux4k69OG4', '韦宗超', '1', '11418212@qq.com', '', '2018-09-01', '2', '1536058218', '1536216215', '183.4.133.164', '', '16', '1');
