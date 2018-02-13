#生活服务分类表
CREATE TABLE IF NOT EXISTS `o2o_category`(
	`id` int(11) unsigned NOT NULL auto_increment,
	`name` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '姓名',
	`parent_id` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '父类ID',
	`listorder` int(8) unsigned NOT NULL DEFAULT 0 COMMENT '排序',
	`status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '状态',
	`create_time` int(11) unsigned NOT NULL DEFAULT 0,
	`update_time` int(11) unsigned NOT NULL DEFAULT 0,
	PRIMARY KEY (`id`),
	KEY parent_id(`parent_id`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


#城市表
CREATE TABLE IF NOT EXISTS `o2o_city`(
	`id` int(11) unsigned NOT NULL auto_increment,
	`name` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '城市',
	`uname` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '城市英文',
	`parent_id` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '父类ID',
	`listorder` int(8) unsigned NOT NULL DEFAULT 0 COMMENT '排序',
	`status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '状态',
	`create_time` int(11) unsigned NOT NULL DEFAULT 0,
	`update_time` int(11) unsigned NOT NULL DEFAULT 0,
	PRIMARY KEY (`id`),
	KEY parent_id(`parent_id`),
	UNIQUE KEY uname(`uname`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

#商圈表
CREATE TABLE IF NOT EXISTS `o2o_area`(
	`id` int(11) unsigned NOT NULL auto_increment,
	`name` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '名称',
	`city_id` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '城市ID',
	`parent_id` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '父类ID',
	`listorder` int(8) unsigned NOT NULL DEFAULT 0 COMMENT '排序',
	`status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '状态',
	`create_time` int(11) unsigned NOT NULL DEFAULT 0,
	`update_time` int(11) unsigned NOT NULL DEFAULT 0,
	PRIMARY KEY (`id`),
	KEY parent_id(`parent_id`),
	KEY city_id(`city_id`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

#商户表
CREATE TABLE IF NOT EXISTS `o2o_bis`(
	`id` int(11) unsigned NOT NULL auto_increment,
	`name` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '名称',
	`email` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '邮箱',
	`logo` VARCHAR(255) NOT NULL DEFAULT '' COMMENT 'logo',
	`lecence_logo` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '营业执照',
	`description` TEXT NOT NULL  COMMENT '描述',
	`city_id` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '城市ID',
	`city_path` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '城市路径',
	`bank_info` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '银行信息',
	`money` DECIMAL(20,2) NOT NULL DEFAULT '0.00' COMMENT '金额',
	`bank_name` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '银行名称',
	`bank_user` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '银行开户人',
	`faren` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '法人代表',
	`faren_tel` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '法人联系方式',
	`listorder` int(8) unsigned NOT NULL DEFAULT 0 COMMENT '排序',
	`status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '状态',
	`create_time` int(11) unsigned NOT NULL DEFAULT 0,
	`update_time` int(11) unsigned NOT NULL DEFAULT 0,
	PRIMARY KEY (`id`),
	KEY city_id(`city_id`),
	KEY name(`name`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


#商户帐号表
CREATE TABLE IF NOT EXISTS `o2o_bis_account`(
	`id` int(11) unsigned NOT NULL auto_increment,
	`username` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '名称',
	`password` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '密码',
	`code` VARCHAR(10) NOT NULL DEFAULT '' COMMENT '识别码',
	`bis_id` int(11) unsigned NOT NULL COMMENT '商户表ID',
	`last_login_ip` VARCHAR(20) NOT NULL DEFAULT '' COMMENT '最后登录IP',
	`last_login_time` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '最后登录时间',
	`is_main` tinyint(1) unsigned NOT NULL DEFAULT 0 COMMENT '是否是主账户',
	`listorder` int(8) unsigned NOT NULL DEFAULT 0 COMMENT '排序',
	`status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '状态',
	`create_time` int(11) unsigned NOT NULL DEFAULT 0,
	`update_time` int(11) unsigned NOT NULL DEFAULT 0,
	PRIMARY KEY (`id`),
	KEY bis_id(`bis_id`),
	KEY username(`username`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


#商户门店表
CREATE TABLE IF NOT EXISTS `o2o_bis_location`(
	`id` int(11) unsigned NOT NULL auto_increment,
	`name` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '名称',
	`logo` VARCHAR(255) NOT NULL DEFAULT '' COMMENT 'logo',
	`address` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '地址',
	`tel` VARCHAR(20) NOT NULL DEFAULT '' COMMENT '电话',
	`contact` VARCHAR(20) NOT NULL DEFAULT '' COMMENT '联系人',
	`xpoint` VARCHAR(20) NOT NULL DEFAULT '' COMMENT '经度',
	`ypoint` VARCHAR(20) NOT NULL DEFAULT '' COMMENT '纬度',
	`bis_id` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '商户表ID',
	`open_time` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '开门时间',
	`close_time` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '关门时间',
	`content` text NOT NULL COMMENT '详情',
	`is_main` tinyint(1) unsigned NOT NULL DEFAULT 0 COMMENT '是否是总店',
	`api_address` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '地址',
	`city_id` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '城市ID',
	`city_path` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '城市路径',
	`category_id` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '分类ID',
	`category_path` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '分类路径',
	`bank_info` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '银行信息',
	`listorder` int(8) unsigned NOT NULL DEFAULT 0 COMMENT '排序',
	`status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '状态',
	`create_time` int(11) unsigned NOT NULL DEFAULT 0,
	`update_time` int(11) unsigned NOT NULL DEFAULT 0,
	PRIMARY KEY (`id`),
	KEY city_id(`city_id`),
	KEY bis_id(`bis_id`),
	KEY category_id(`category_id`),
	KEY name(`name`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;



#团购商品表
CREATE TABLE IF NOT EXISTS `o2o_deal`(
	`id` int(11) unsigned NOT NULL auto_increment,
	`name` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '名称',
	`category_id` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '分类ID',
	`se_category_id` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '二级分类ID',
	`bis_id` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '商户表ID',
	`location_ids` VARCHAR(100) NOT NULL DEFAULT '' COMMENT '分店表ID',
	`image` VARCHAR(200) NOT NULL DEFAULT '' COMMENT '图片',
	`description` text NOT NULL,
	`start_time` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '开始时间',
	`end_time` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '结束时间',
	`origin_price` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '原价',
	`curarent_price` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '售价',
	`city_id` int(11) unsigned NOT NULL DEFAULT 0,
	`buy_count` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '购买数量',
	`total_count` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '总数',
	`coupons_begin_time` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '消费券开始时间',
	`coupons_end_time` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '消费券结束时间',
	`xpoint` VARCHAR(20) NOT NULL DEFAULT '' COMMENT '经度',
	`ypoint` VARCHAR(20) NOT NULL DEFAULT '' COMMENT '纬度',
	`bis_account_id` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '账户ID',
	`balance_price` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '结算价格',
	`notes` text NOT NULL COMMENT '提示',
	`listorder` int(8) unsigned NOT NULL DEFAULT 0 COMMENT '排序',
	`status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '状态',
	`create_time` int(11) unsigned NOT NULL DEFAULT 0,
	`update_time` int(11) unsigned NOT NULL DEFAULT 0,
	PRIMARY KEY (`id`),
	KEY category_id(`category_id`),
	KEY se_category_id(`se_category_id`),
	KEY city_id(`city_id`),
	KEY start_time(`start_time`),
	KEY end_time(`end_time`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

#会员表
CREATE TABLE IF NOT EXISTS `o2o_user`(
	`id` int(11) unsigned NOT NULL auto_increment,
	`username` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '名称',
	`password` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '密码',
	`code` VARCHAR(10) NOT NULL DEFAULT '' COMMENT '识别码',
	`email` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '邮箱',
	`mobile` VARCHAR(20) NOT NULL DEFAULT '' COMMENT '手机号码',
	`last_login_ip` VARCHAR(20) NOT NULL DEFAULT '' COMMENT '最后登录IP',
	`last_login_time` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '最后登录时间',
	`listorder` int(8) unsigned NOT NULL DEFAULT 0 COMMENT '排序',
	`status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '状态',
	`create_time` int(11) unsigned NOT NULL DEFAULT 0,
	`update_time` int(11) unsigned NOT NULL DEFAULT 0,
	PRIMARY KEY (`id`),
	UNIQUE KEY username(`username`),
	UNIQUE KEY email(`email`),
	UNIQUE KEY mobile(`mobile`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


#推荐位表表
CREATE TABLE IF NOT EXISTS `o2o_featured`(
	`id` int(11) unsigned NOT NULL auto_increment,
	`type` tinyint(1) NOT NULL DEFAULT 0 COMMENT '分类',
	`title` varchar(30) NOT NULL DEFAULT '' COMMENT '标题',
	`image` varchar(255) NOT NULL DEFAULT '' COMMENT '图片',
	`url` varchar(255) NOT NULL DEFAULT '' COMMENT '地址',
	`description` text NOT NULL COMMENT '描述',
	`listorder` int(8) unsigned NOT NULL DEFAULT 0 COMMENT '排序',
	`status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '状态',
	`create_time` int(11) unsigned NOT NULL DEFAULT 0,
	`update_time` int(11) unsigned NOT NULL DEFAULT 0,
	PRIMARY KEY (`id`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


#订单表
CREATE TABLE IF NOT EXISTS `o2o_order`(
	`id` int(11) unsigned NOT NULL auto_increment,
	`out_trade_no` varchar(100) NOT NULL DEFAULT '' COMMENT '订单编号',
	`transaction_id` varchar(100) NOT NULL DEFAULT '' COMMENT '微信订单编号',
	`user_id` int(11) NOT NULL DEFAULT 0 COMMENT '用户编号',
	`username` VARCHAR(50)	NOT NULL DEFAULT '' COMMENT '用户姓名',
	`pay_time`	VARCHAR(20)	NOT NULL DEFAULT '' COMMENT '付款时间',
	`payment_id` tinyint(1) NOT NULL DEFAULT 1 COMMENT '支付方式',
	`deal_id` int(11) NOT NULL DEFAULT 0 COMMENT '商品ID',
	`deal_count` int(11) NOT NULL DEFAULT 0 COMMENT '商品数量',
	`pay_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '支付状态0:未支付,1:支付成功,2:支付失败',
	`total_price` DECIMAL(20,2) NOT NULL DEFAULT '0.00' COMMENT '总价',
	`pay_amount` DECIMAL(20,2) NOT NULL DEFAULT '0.00' COMMENT '微信支付金额',
	`status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '状态',
	`referer` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '来源',
	`create_time` int(11) unsigned NOT NULL DEFAULT 0,
	`update_time` int(11) unsigned NOT NULL DEFAULT 0,
	PRIMARY KEY (`id`),
	UNIQUE `out_trade_no`(`out_trade_no`),
  KEY user_id(`user_id`),
  KEY pay_time(`pay_time`),
  KEY deal_id(`deal_id`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
