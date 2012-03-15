SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `wsmj` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `wsmj` ;

-- -----------------------------------------------------
-- Table `wsmj`.`sz_tree`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `wsmj`.`sz_tree` (
  `id` BIGINT NOT NULL COMMENT 'ID' ,
  `title` VARCHAR(255) NOT NULL COMMENT '标题' ,
  `tags` VARCHAR(255) NOT NULL COMMENT '关键字' ,
  `desc` VARCHAR(255) NOT NULL COMMENT '描述' ,
  `parentid` BIGINT NOT NULL COMMENT '父ID' ,
  `module` VARCHAR(255) NOT NULL COMMENT '模块' ,
  `action` VARCHAR(255) NOT NULL COMMENT '操作' ,
  `parameters` VARCHAR(255) NOT NULL COMMENT '参数' ,
  `value` TEXT NULL COMMENT '存储值' ,
  `status` TINYINT NOT NULL DEFAULT '0' COMMENT '状态' ,
  `level` TINYINT NOT NULL COMMENT '层级' ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci, 
COMMENT = '系统树' ;


-- -----------------------------------------------------
-- Table `wsmj`.`sz_actionandmodel`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `wsmj`.`sz_actionandmodel` (
  `id` BIGINT UNSIGNED NOT NULL COMMENT 'ID' ,
  `module` VARCHAR(20) NOT NULL COMMENT '模块' ,
  `action` VARCHAR(20) NOT NULL COMMENT '操作' ,
  `status` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '状态' ,
  `result` VARCHAR(255) NOT NULL COMMENT '序列化' ,
  `user_id` BIGINT(20) NOT NULL COMMENT '用户ID' ,
  PRIMARY KEY (`id`) ,
  INDEX `status` (`module` ASC, `action` ASC, `status` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci, 
COMMENT = '操作模型数据关联表' ;


-- -----------------------------------------------------
-- Table `wsmj`.`sz_ad`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `wsmj`.`sz_ad` (
  `id` BIGINT UNSIGNED NOT NULL COMMENT '广告ID' ,
  `module` VARCHAR(255) NOT NULL COMMENT '模块名称' ,
  `action` VARCHAR(255) NOT NULL COMMENT '操作名称' ,
  `adcode` TEXT NOT NULL COMMENT '广告代码' ,
  `createtime` INT(10) NOT NULL COMMENT '添加时间' ,
  `adbegin` INT(10) NOT NULL COMMENT '开始时间' ,
  `adend` INT(10) NOT NULL COMMENT '结束时间' ,
  `status` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '状态' ,
  `services_id` BIGINT UNSIGNED NOT NULL COMMENT '管理员ID' ,
  `position` VARCHAR(45) NOT NULL COMMENT '位置' ,
  PRIMARY KEY (`id`) ,
  INDEX `status` (`status` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 10
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci, 
COMMENT = '广告表' ;


-- -----------------------------------------------------
-- Table `wsmj`.`sz_brand`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `wsmj`.`sz_brand` (
  `id` BIGINT UNSIGNED NOT NULL COMMENT '品牌ID' ,
  `title` VARCHAR(255) NOT NULL COMMENT '品牌名称' ,
  `titleextend` VARCHAR(255) NOT NULL COMMENT '英文名称' ,
  `desc` TEXT NOT NULL COMMENT '描述' ,
  `siteurl` VARCHAR(255) NOT NULL COMMENT '网址' ,
  `status` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '状态' ,
  `tags` VARCHAR(255) NOT NULL COMMENT '标签' ,
  `image` VARCHAR(255) NOT NULL COMMENT '图片ID' ,
  `user_id` BIGINT NOT NULL COMMENT '用户ID' ,
  PRIMARY KEY (`id`) ,
  INDEX `status` (`status` ASC) ,
  INDEX `fk_sz_brand_sz_user1` (`user_id` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 14
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci, 
COMMENT = '品牌表' ;


-- -----------------------------------------------------
-- Table `wsmj`.`sz_communicate`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `wsmj`.`sz_communicate` (
  `id` BIGINT UNSIGNED NOT NULL COMMENT 'ID' ,
  `title` VARCHAR(255) NOT NULL COMMENT '名称' ,
  `groupno` VARCHAR(255) NOT NULL COMMENT '群号' ,
  `status` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '状态' ,
  `createtime` INT(10) NOT NULL COMMENT '时间' ,
  `category_id` BIGINT NOT NULL COMMENT '分类ID' ,
  `user_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '创建者ID' ,
  PRIMARY KEY (`id`) ,
  INDEX `status` (`status` ASC, `category_id` ASC) ,
  INDEX `userid` (`user_id` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci, 
COMMENT = '交流组表' ;


-- -----------------------------------------------------
-- Table `wsmj`.`sz_compaign`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `wsmj`.`sz_compaign` (
  `id` BIGINT NOT NULL ,
  `title` VARCHAR(65) NOT NULL COMMENT '名称' ,
  `createtime` INT(10) NOT NULL COMMENT '创建时间' ,
  `starttime` INT(10) NOT NULL COMMENT '开始时间' ,
  `endtime` INT(10) NOT NULL COMMENT '结束时间' ,
  `expiration` INT(10) NOT NULL COMMENT '报名截至时间' ,
  `tags` VARCHAR(45) NOT NULL COMMENT '标签' ,
  `desc` TEXT NOT NULL COMMENT '内容' ,
  `status` TINYINT(1) NOT NULL COMMENT '状态' ,
  `user_id` MEDIUMINT(8) UNSIGNED NOT NULL COMMENT '用户ID' ,
  PRIMARY KEY (`id`) ,
  INDEX `status` (`expiration` ASC, `endtime` ASC, `status` ASC) ,
  INDEX `fk_sz_compaign_sz_user1` (`user_id` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci, 
COMMENT = '活动表' ;


-- -----------------------------------------------------
-- Table `wsmj`.`sz_content`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `wsmj`.`sz_content` (
  `id` BIGINT UNSIGNED NOT NULL COMMENT '信息ID' ,
  `module` VARCHAR(255) NOT NULL COMMENT '模块' ,
  `action` VARCHAR(255) NOT NULL COMMENT '操作' ,
  `title` VARCHAR(255) NOT NULL COMMENT '标题' ,
  `tags` VARCHAR(255) NOT NULL COMMENT '关键字' ,
  `desc` VARCHAR(255) NOT NULL COMMENT '提示信息' ,
  `status` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '状态' ,
  `content` TEXT NOT NULL COMMENT '内容' ,
  `services_id` BIGINT UNSIGNED NOT NULL COMMENT '用户ID' ,
  PRIMARY KEY (`id`) ,
  INDEX `status` (`status` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 10
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci, 
COMMENT = '信息表' ;


-- -----------------------------------------------------
-- Table `wsmj`.`sz_district`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `wsmj`.`sz_district` (
  `id` MEDIUMINT(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID' ,
  `name` CHAR(40) NOT NULL COMMENT '名称' ,
  `level` TINYINT(4) UNSIGNED NOT NULL COMMENT '级别' ,
  `upid` MEDIUMINT(8) NOT NULL COMMENT '父ID' ,
  `enname` VARCHAR(60) NOT NULL COMMENT '区域拼音' ,
  `sequence` TINYINT(4) NOT NULL COMMENT '排序' ,
  PRIMARY KEY (`id`) ,
  INDEX `enname` (`enname` ASC, `sequence` ASC) ,
  INDEX `upid` (`level` ASC, `upid` ASC, `sequence` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 45052
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci, 
COMMENT = '地区信息表' ;


-- -----------------------------------------------------
-- Table `wsmj`.`sz_product`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `wsmj`.`sz_product` (
  `id` BIGINT UNSIGNED NOT NULL COMMENT 'ID' ,
  `title` VARCHAR(255) NOT NULL COMMENT '名称' ,
  `titleextend` VARCHAR(255) NOT NULL COMMENT '标题扩展' ,
  `tags` VARCHAR(50) NOT NULL COMMENT '关键字' ,
  `desc` TEXT NOT NULL COMMENT '商品描述' ,
  `status` TINYINT(1) UNSIGNED NOT NULL COMMENT '状态' ,
  `createtime` INT(10) UNSIGNED NOT NULL COMMENT '创建时间' ,
  `location` VARCHAR(50) NOT NULL COMMENT '地区' ,
  `image` VARCHAR(255) NOT NULL COMMENT '图片' ,
  `fromurl` VARCHAR(225) NOT NULL COMMENT '来源' ,
  `user_id` BIGINT UNSIGNED NOT NULL COMMENT '用户ID' ,
  `brand_id` BIGINT NOT NULL COMMENT '品牌ID' ,
  `price` VARCHAR(45) NOT NULL COMMENT '原价格' ,
  `newprice` VARCHAR(45) NOT NULL COMMENT '新价格' ,
  `showtype` TINYINT(1) NOT NULL COMMENT '显示类型' ,
  `url_id` BIGINT NOT NULL COMMENT '来源网站ID' ,
  `imageids` VARCHAR(200) NOT NULL COMMENT '图片IDS' ,
  `starttime` INT NOT NULL COMMENT '开始时间' ,
  `endtime` INT NOT NULL COMMENT '结束时间' ,
  `locationid` BIGINT NOT NULL COMMENT '地区ID' ,
  `extension` TEXT NULL COMMENT '扩展' ,
  `website` VARCHAR(45) NOT NULL COMMENT '网站名称' ,
  `cate` VARCHAR(45) NOT NULL COMMENT '分类' ,
  `rebate` VARCHAR(45) NOT NULL COMMENT '折扣' ,
  `shops` TEXT NULL COMMENT '店铺' ,
  PRIMARY KEY (`id`) ,
  INDEX `locationid` (`title` ASC, `location` ASC) ,
  INDEX `fk_sz_goods_sz_user1` (`user_id` ASC) ,
  INDEX `status` (`status` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 446
DEFAULT CHARACTER SET = utf8, 
COMMENT = 'product' ;


-- -----------------------------------------------------
-- Table `wsmj`.`sz_group`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `wsmj`.`sz_group` (
  `id` BIGINT UNSIGNED NOT NULL COMMENT 'ID' ,
  `title` VARCHAR(255) NOT NULL COMMENT '组名' ,
  `tags` VARCHAR(255) NOT NULL COMMENT '关键字' ,
  `desc` TEXT NOT NULL COMMENT '简介' ,
  `image_id` BIGINT NOT NULL COMMENT 'LOGO' ,
  `membercount` BIGINT NOT NULL COMMENT '成员数' ,
  `topiccount` BIGINT NOT NULL COMMENT '主题数' ,
  `createtime` INT(10) NOT NULL COMMENT '创建时间' ,
  `enname` VARCHAR(255) NOT NULL COMMENT '英文名' ,
  `status` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '状态' ,
  `user_id` BIGINT UNSIGNED NOT NULL COMMENT '用户ID' ,
  `adminids` VARCHAR(255) NOT NULL COMMENT '管理员ID' ,
  PRIMARY KEY (`id`) ,
  INDEX `status` (`status` ASC) ,
  INDEX `enname` (`enname` ASC) ,
  INDEX `fk_sz_group_sz_user1` (`user_id` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 13
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci, 
COMMENT = '群组表' ;


-- -----------------------------------------------------
-- Table `wsmj`.`sz_image`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `wsmj`.`sz_image` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '图片ID' ,
  `filename` VARCHAR(255) NOT NULL COMMENT '图片名' ,
  `desc` VARCHAR(255) NOT NULL COMMENT '图片描述' ,
  `createtime` INT(10) NOT NULL COMMENT '创建时间' ,
  `status` TINYINT NOT NULL DEFAULT '0' COMMENT '状态' ,
  `remoteurl` VARCHAR(255) NOT NULL COMMENT '远程地址' ,
  `url` VARCHAR(255) NOT NULL COMMENT 'URL' ,
  `model` VARCHAR(255) NOT NULL COMMENT '模块' ,
  `user_id` BIGINT UNSIGNED NOT NULL COMMENT '用户ID' ,
  PRIMARY KEY (`id`) ,
  INDEX `status` (`status` ASC) ,
  INDEX `userid` (`user_id` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 282
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci, 
COMMENT = '图片表' ;


-- -----------------------------------------------------
-- Table `wsmj`.`sz_mail`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `wsmj`.`sz_mail` (
  `id` BIGINT UNSIGNED NOT NULL COMMENT '短消息ID' ,
  `fromuid` BIGINT NOT NULL COMMENT '发信人ID' ,
  `touid` BIGINT NOT NULL COMMENT '收信人ID' ,
  `title` VARCHAR(255) NOT NULL COMMENT '标题' ,
  `content` VARCHAR(255) NOT NULL COMMENT '消息内容' ,
  `createtime` INT(10) NOT NULL COMMENT '发送时间' ,
  `replyid` BIGINT NOT NULL COMMENT '回复ID' ,
  `status` TINYINT(1) NOT NULL COMMENT '状态' ,
  PRIMARY KEY (`id`) ,
  INDEX `status` (`status` ASC, `fromuid` ASC, `touid` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 13
DEFAULT CHARACTER SET = utf8, 
COMMENT = '短消息表' ;


-- -----------------------------------------------------
-- Table `wsmj`.`sz_modelandmodel`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `wsmj`.`sz_modelandmodel` (
  `id` BIGINT UNSIGNED NOT NULL COMMENT 'ID' ,
  `status` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '状态' ,
  `modela_id` BIGINT NOT NULL COMMENT '模型A' ,
  `modelb_id` BIGINT NOT NULL COMMENT '模型B' ,
  `createtime` INT(10) NOT NULL COMMENT '创建时间' ,
  `user_id` BIGINT NOT NULL COMMENT '用户ID' ,
  `type` VARCHAR(45) NOT NULL COMMENT '关联类型' ,
  `locationid` VARCHAR(45) NOT NULL COMMENT '地区ID' ,
  `extension` VARCHAR(45) NOT NULL COMMENT '扩展' ,
  PRIMARY KEY (`id`) ,
  INDEX `status` (`status` ASC, `modela_id` ASC, `modelb_id` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 137
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci, 
COMMENT = '实体实体关联表' ;


-- -----------------------------------------------------
-- Table `wsmj`.`sz_post`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `wsmj`.`sz_post` (
  `id` BIGINT UNSIGNED NOT NULL COMMENT '内容ID' ,
  `content` TEXT NOT NULL COMMENT '内容' ,
  `istopic` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '是否是主题' ,
  `createtime` INT(10) NOT NULL COMMENT '创建时间' ,
  `status` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '状态' ,
  `topic_id` BIGINT UNSIGNED NOT NULL COMMENT '主题ID' ,
  `user_id` BIGINT UNSIGNED NOT NULL COMMENT '用户ID' ,
  `object` VARCHAR(45) NOT NULL COMMENT '对象' ,
  `istop` TINYINT NOT NULL COMMENT '置顶' ,
  `reply` INT NOT NULL DEFAULT '0' COMMENT '回复数' ,
  `source` VARCHAR(45) NOT NULL COMMENT '来源' ,
  `forword` INT NOT NULL DEFAULT '0' COMMENT '转发数' ,
  `imageids` BIGINT NOT NULL COMMENT '图片IDs' ,
  PRIMARY KEY (`id`) ,
  INDEX `status` (`status` ASC, `istopic` ASC) ,
  INDEX `topic` (`topic_id` ASC) ,
  INDEX `userid` (`user_id` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 168
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci, 
COMMENT = '群组信息表' ;


-- -----------------------------------------------------
-- Table `wsmj`.`sz_report`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `wsmj`.`sz_report` (
  `id` BIGINT UNSIGNED NOT NULL COMMENT 'ID' ,
  `uid` BIGINT NOT NULL COMMENT '用户ID' ,
  `uname` VARCHAR(255) NOT NULL COMMENT '名称' ,
  `ip` VARCHAR(255) NOT NULL COMMENT '客户IP' ,
  `typename` BIGINT NOT NULL COMMENT '类型名称' ,
  `url` VARCHAR(255) NOT NULL COMMENT 'URL' ,
  `reason` VARCHAR(255) NOT NULL COMMENT '原因' ,
  `createtime` INT(10) NOT NULL COMMENT '创建时间' ,
  `status` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '是否处理' ,
  `dealtime` INT(10) NOT NULL COMMENT '处理时间' ,
  `service_id` BIGINT NOT NULL COMMENT '处理者ID' ,
  PRIMARY KEY (`id`) ,
  INDEX `isdeal` (`status` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci, 
COMMENT = '报告信息表' ;


-- -----------------------------------------------------
-- Table `wsmj`.`sz_services`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `wsmj`.`sz_services` (
  `id` BIGINT UNSIGNED NOT NULL COMMENT '帐户ID' ,
  `account` VARCHAR(255) NOT NULL COMMENT '帐户' ,
  `password` CHAR(32) NOT NULL COMMENT '密码' ,
  `lastlogintime` INT(10) NOT NULL COMMENT '最后登录时间' ,
  `createtime` INT(10) NOT NULL COMMENT '创建时间' ,
  `status` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '状态' ,
  `groupid` BIGINT NOT NULL COMMENT '级别ID' ,
  PRIMARY KEY (`id`) ,
  INDEX `status` (`status` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci, 
COMMENT = '客户服务人员帐户表' ;


-- -----------------------------------------------------
-- Table `wsmj`.`sz_tags`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `wsmj`.`sz_tags` (
  `id` BIGINT UNSIGNED NOT NULL COMMENT 'ID' ,
  `tag` VARCHAR(20) NOT NULL COMMENT 'TAG' ,
  `tagtheme` VARCHAR(245) NOT NULL COMMENT 'tag个性化' ,
  `tagcount` BIGINT NOT NULL COMMENT '个数' ,
  `status` TINYINT NOT NULL COMMENT '状态' ,
  PRIMARY KEY (`id`) ,
  INDEX `tags` (`tag` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 121
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci, 
COMMENT = 'TAGS' ;


-- -----------------------------------------------------
-- Table `wsmj`.`sz_topic`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `wsmj`.`sz_topic` (
  `id` BIGINT UNSIGNED NOT NULL COMMENT '话题ID' ,
  `title` VARCHAR(255) NOT NULL COMMENT '标题' ,
  `postcount` INT NOT NULL COMMENT '回复数目' ,
  `createtime` INT(10) NOT NULL COMMENT '创建时间' ,
  `lastreplytime` INT(10) NOT NULL COMMENT '最后回复时间' ,
  `group_id` BIGINT UNSIGNED NOT NULL COMMENT '组ID' ,
  `user_id` BIGINT UNSIGNED NOT NULL COMMENT '用户ID' ,
  `status` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '状态' ,
  `tags` VARCHAR(255) NOT NULL COMMENT '标签' ,
  `desc` VARCHAR(255) NOT NULL COMMENT '描述' ,
  `istop` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '置顶' ,
  `islock` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '锁定' ,
  PRIMARY KEY (`id`) ,
  INDEX `group` (`group_id` ASC) ,
  INDEX `userid` (`user_id` ASC) ,
  INDEX `status` (`status` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 35
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci, 
COMMENT = '话题表' ;


-- -----------------------------------------------------
-- Table `wsmj`.`sz_url`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `wsmj`.`sz_url` (
  `id` BIGINT NOT NULL COMMENT 'ID' ,
  `title` VARCHAR(255) NOT NULL COMMENT '名称' ,
  `tags` VARCHAR(255) NOT NULL COMMENT '标签' ,
  `desc` TEXT NULL COMMENT '描述' ,
  `image` VARCHAR(255) NOT NULL COMMENT '图标' ,
  `status` TINYINT(1) NOT NULL COMMENT '状态' ,
  `domain` VARCHAR(245) NOT NULL COMMENT '域名' ,
  `user_id` BIGINT NOT NULL COMMENT '用户ID' ,
  `category_id` BIGINT NOT NULL COMMENT '链接类型' ,
  `createtime` INT(10) NOT NULL COMMENT '创建时间' ,
  `openapi` VARCHAR(255) NOT NULL COMMENT 'API地址' ,
  `cityurl` VARCHAR(255) NOT NULL ,
  `citylist` TEXT NULL COMMENT '城市列表' ,
  `fetchrule` TEXT NULL COMMENT '抓取规则' ,
  PRIMARY KEY (`id`) ,
  INDEX `status` (`status` ASC, `domain` ASC) ,
  INDEX `user` (`user_id` ASC) ,
  INDEX `cat` (`category_id` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 88
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci, 
COMMENT = '网址' ;


-- -----------------------------------------------------
-- Table `wsmj`.`sz_userinfo`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `wsmj`.`sz_userinfo` (
  `id` BIGINT UNSIGNED NOT NULL COMMENT 'ID' ,
  `sex` TINYINT(1) UNSIGNED NOT NULL COMMENT '性别' ,
  `birthday` DATE NOT NULL DEFAULT '1980-01-01' COMMENT '生日' ,
  `createtime` INT(10) NOT NULL COMMENT '创建时间' ,
  `score` INT(11) UNSIGNED NOT NULL COMMENT '积分' ,
  `money` FLOAT UNSIGNED NOT NULL COMMENT '买家币' ,
  `lastlogintime` INT(10) NOT NULL COMMENT '最后登录' ,
  `lastloginip` VARCHAR(255) NOT NULL COMMENT '最后登录IP' ,
  `refereeid` BIGINT NOT NULL COMMENT '推荐人ID' ,
  `blogurl` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '博客地址' ,
  `usertxt` TEXT NOT NULL COMMENT '自我说明' ,
  `havemail` TINYINT(4) NOT NULL COMMENT '消息' ,
  `checkcode` CHAR(32) NOT NULL COMMENT '注册确认码' ,
  `locationid` MEDIUMINT(8) NOT NULL COMMENT '地区ID' ,
  `microblog` VARCHAR(250) NOT NULL COMMENT '微博' ,
  `qq` CHAR(15) NOT NULL COMMENT 'QQ' ,
  `msn` VARCHAR(50) NOT NULL COMMENT 'MSN' ,
  `wangwang` VARCHAR(20) NOT NULL COMMENT '旺旺' ,
  `mobile` CHAR(20) NOT NULL COMMENT '手机' ,
  `city` VARCHAR(45) NOT NULL COMMENT '城市名称' ,
  PRIMARY KEY (`id`) ,
  INDEX `sex` (`sex` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 246
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci, 
COMMENT = '用户表' ;


-- -----------------------------------------------------
-- Table `wsmj`.`sz_userandmodel`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `wsmj`.`sz_userandmodel` (
  `id` BIGINT UNSIGNED NOT NULL COMMENT 'ID' ,
  `linktype` VARCHAR(20) NOT NULL COMMENT '关联类型' ,
  `status` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '状态' ,
  `createtime` INT(10) NOT NULL COMMENT '时间' ,
  `user_id` BIGINT UNSIGNED NOT NULL ,
  `model` VARCHAR(255) NOT NULL COMMENT '模型' ,
  `model_id` BIGINT NOT NULL COMMENT '模型ID' ,
  `locationid` BIGINT NOT NULL COMMENT '地区ID' ,
  `updatetime` INT(10) NOT NULL COMMENT '更新时间' ,
  `extension` VARCHAR(255) NULL COMMENT '扩展' ,
  PRIMARY KEY (`id`) ,
  INDEX `status` (`linktype` ASC, `status` ASC, `model` ASC, `model_id` ASC, `user_id` ASC) ,
  INDEX `fk_sz_userandbrand_sz_user1` (`user_id` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 329
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci, 
COMMENT = '用户及实体关联表' ;


-- -----------------------------------------------------
-- Table `wsmj`.`sz_account`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `wsmj`.`sz_account` (
  `id` BIGINT UNSIGNED NOT NULL COMMENT 'ID' ,
  `account` VARCHAR(255) NOT NULL COMMENT '帐号' ,
  `password` CHAR(32) NOT NULL COMMENT '密码' ,
  `email` VARCHAR(255) NOT NULL COMMENT '邮箱' ,
  `mobile` VARCHAR(255) NOT NULL COMMENT '手机' ,
  `type` TINYINT NOT NULL DEFAULT 1 COMMENT '类型' ,
  `status` TINYINT NOT NULL DEFAULT 0 COMMENT '状态' ,
  `ip` VARCHAR(45) NOT NULL COMMENT 'IP' ,
  `image_id` VARCHAR(45) NOT NULL COMMENT '头像' ,
  `screenname` VARCHAR(100) NOT NULL COMMENT '显示名' ,
  `city` VARCHAR(40) NOT NULL COMMENT '城市' ,
  PRIMARY KEY (`id`) ,
  INDEX `account` (`account` ASC, `status` ASC) ,
  INDEX `email` (`email` ASC, `status` ASC) ,
  INDEX `mobile` (`mobile` ASC, `status` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci, 
COMMENT = '账户表' ;


-- -----------------------------------------------------
-- Table `wsmj`.`sz_object`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `wsmj`.`sz_object` (
  `id` BIGINT UNSIGNED NOT NULL COMMENT 'ID' ,
  `object` VARCHAR(45) NOT NULL COMMENT '对象' ,
  PRIMARY KEY (`id`) ,
  INDEX `object` (`object` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci, 
COMMENT = 'object' ;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
