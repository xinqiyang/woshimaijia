<?php

// +----------------------------------------------------------------------
// | WoShiMaiJia Projcet 
// +----------------------------------------------------------------------
// | Copyright (c) 2010-2011 http://woshimaijia.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: xinqiyang <xinqiyang@gmail.com>
// +----------------------------------------------------------------------

return array(
    //site descript
    'site' => array(
        'title' => '我是买家',
        'url' => 'http://web.dev.woshimaijia.com',
        'keywords' => '我是买家,%s 买家 %s ',
        'desc' => '我是买家,买家分享社区',
        //set default user icon
        'defaultIcon' => 'http://res.dev.woshimaijia.com/images/default/userdefault.gif',
        'blog' => 'http://blog.woshimaijia.com',
    ),
    //@TODO:站点的rewrite设置这块可以考虑迁移到外部去使用nginx在做
    'web_route_rules' => array(
        array('/^tag\/(\d+)$/', 'Tag', 'tag', 'id'), //item show
        array('/^people\/(\w+)$/', 'People', 'space', 'enname'),
        array('/^group\/(\w+)$/', 'Group', 'group', 'enname'),
        array('/^brand\/(\w+)$/', 'Brand', 'brand', 'enname'),
        array('/^url\/(\d+)$/', 'Url', 'url', 'id'),
        array('/^product\/(\d+)$/', 'Product', 'product', 'id'),
        array('/^location\/(\w+)$/', 'Location', 'location', 'location'),
    ),
    'WEBURL' => 'http://web.dev.woshimaijia.com',
    //reservce proxy nginx server to deal the request
    'APIURL' => 'http://api.dev.woshimaijia.com',
    //wap Url
    'WAPURL' => 'http://wap.dev.woshimaijia.com',
    //resource url config,this is use the single site 
    'RESURL' => 'http://res.dev.woshimaijia.com',
    //IMAGE GET SERVER
    'IMGURL' => 'http://img.dev.woshimaijia.com',
    'ImgSingle' => true,
    //MIS URL
    'MISURL' => 'http://mis.dev.woshimaijia.com',
    //UPLOAD SERVER	
    'UPLOADSERVER' => 'http://img.dev.woshimaijia.com/upload/index',
    

    //DEV SITE 
    'devsite' => array(
        'title' => 'Woshimaijia Developers',
        'url' => 'http://dev.dev.woshimaijia.com',
        'keywords' => '我是买家 开发者',
        'description' => '我是买家开发者站点',
    ),
    
    //Mis system config
    'missite' => array(
        'title' => 'Woshimaijia Mis System',
        'url' => 'http://mis.dev.woshimaijia.com',
        'keywords' => '我是买家 Mis系统',
        'description' => '我是买家Mis系统',
        //set you group
        'groupid' => array('admin' => '5', 'manager' => '4', 'user' => '3'),
    ),
    //set site token
    'token' => array(
        'Web' => false, //check web
        'Wap' => false, //check web
        'Mis' => false, //check web
    ),
    
    //set device of input
    'Device' => array(
        'web' => '网页版',
        'wap' => '手机版',
        'android' => '安卓客户端',
        'androidplateform' => '安卓平板客户端',
        'iphone' => 'Iphone客户端',
        'ipad' => 'Ipad客户端',
        'symbian' => '塞班客户端',
        'kjava' => 'KJAVA',
        'blackberry' => '黑莓手机',
        'windowsphone' => 'WP客户端',
        'mtk' => 'MTK',
    ),
    
    //设置默认的站点用户
    'defaultuser' => '13252345755894991',
    
    //设置每人最多建的群数量
    'groupcount' => 4,
    
    
    
);