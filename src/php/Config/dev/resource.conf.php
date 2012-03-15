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
    //user behavior @todo could extend ,add the user behavior here
    'behavior' => array('view', 'post', 'like', 'buy', 'collect', 'go', 'follow', 'nofollow', 'send', 'chat', 'own', 'scoring', 'belong', 'mail'),
    //REDIS NODE
    //MAIN STORE ENGIN
    'redis' => array(
        //redis master
        'redis' => array(
            'host' => '127.0.0.1',
            'port' => 6379,
            'slaves' => array(
                array(
                    'host' => '127.0.0.1',
                    'port' => 6380,
                ),
            ),
        ),
        'stat' => array(
            'host' => '127.0.0.1',
            'port' => 6379,
            'slaves' => array(
                array(
                    'host' => '127.0.0.1',
                    'port' => 6380,
                ),
            ),
        ),
        //online setting
        'online' => array(
            'host' => '127.0.0.1',
            'port' => 6379,
            'slaves' => array(
                array(
                    'host' => '127.0.0.1',
                    'port' => 6380,
                ),
            ),
        ),
    ),
    //mongodb node
    'mongo' => array(
        'mongo' => array(
            'instances' => '127.0.0.1:27017',
            'autobalance' => true,
            'connect' => true,
            'database' => 'mongo',
        ),
        'mongoread' => array(
            'instances' => array(
                '127.0.0.1:27017',
                '127.0.0.1:27017',
            ),
            'autobalance' => true,
            'connect' => true,
            'database' => 'mongo',
        ),
        'stat' => array(
            'instances' => array(
                '127.0.0.1:27017',
            ),
            'autobalance' => true,
            'connect' => true,
            'database' => 'stat',
        ),
    ),
    'mysql' => array(
        //db configuration
        'mysql' => array(
            'dbms' => 'mysql',
            'username' => 'woshimaijia_test',
            'password' => 'woshimaijia_test',
            'hostname' => '127.0.0.1',
            'hostport' => '3306',
            'database' => 'bd_main',
            'db_prefix' => '',
            'fields_cache' => false, //if set false then no flush table info
            'fields_cache_path' => '/Wsmjdev/tmp/', //  
            'use_slaves' => TRUE, //use slaves  true/false
            'slaves' => array(
                array('username' => 'woshimaijia_test',
                    'password' => 'woshimaijia_test',
                    'hostname' => '127.0.0.1',
                    'hostport' => '3306'),
            )
        ),
        'blog' => array(
            'dbms' => 'mysql',
            'username' => 'blog',
            'password' => 'NcM5eTbNTuUtb2CQ',
            'hostname' => '127.0.0.1',
            'hostport' => '3306',
            'database' => 'blog',
            'db_prefix' => '',
            'fields_cache' => TRUE, //if set false then no flush table info
            'fields_cache_path' => '/Wsmjdev/tmp/', //  
            'use_slaves' => TRUE, //use slaves  true/false
            'slaves' => array(
                array('username' => 'woshimaijia_test',
                    'password' => 'woshimaijia_test',
                    'hostname' => '127.0.0.1',
                    'hostport' => '3306'),
            )
        ),
        'mis' => array(
            'dbms' => 'mysql',
            'username' => 'woshimaijia_test',
            'password' => 'woshimaijia_test',
            'hostname' => '127.0.0.1',
            'hostport' => '3306',
            'database' => 'mis',
            'db_prefix' => '',
            'fields_cache' => TRUE, //if set false then no flush table info
            'fields_cache_path' => '/Wsmjdev/tmp/', //  
            'use_slaves' => TRUE, //use slaves  true/false
            'slaves' => array(
                array('username' => 'woshimaijia_test',
                    'password' => 'woshimaijia_test',
                    'hostname' => '127.0.0.1',
                    'hostport' => '3306'),
            )
        ),
        'promo' => array(
            'dbms' => 'mysql',
            'username' => 'woshimaijia_test',
            'password' => 'woshimaijia_test',
            'hostname' => '127.0.0.1',
            'hostport' => '3306',
            'database' => 'mis',
            'db_prefix' => '',
            'fields_cache' => TRUE, //if set false then no flush table info
            'fields_cache_path' => '/Wsmjdev/tmp/', //  
            'use_slaves' => TRUE, //use slaves  true/false
            'slaves' => array(
                array('username' => 'woshimaijia_test',
                    'password' => 'woshimaijia_test',
                    'hostname' => '127.0.0.1',
                    'hostport' => '3306'),
            )
        ),
        //专门用来做查询的
        'search' => array(
            'dbms' => 'mysql',
            'username' => 'woshimaijia_test',
            'password' => 'woshimaijia_test',
            'hostname' => '127.0.0.1',
            'hostport' => '3306',
            'database' => 'search',
            'db_prefix' => '',
            'fields_cache' => TRUE, //if set false then no flush table info
            'fields_cache_path' => '/Wsmjdev/tmp/', //  
            'use_slaves' => TRUE, //use slaves  true/false
            'slaves' => array(
                array('username' => 'woshimaijia_test',
                    'password' => 'woshimaijia_test',
                    'hostname' => '127.0.0.1',
                    'hostport' => '3306'),
            )
        ),
    ),
    //使用mysqli节点做为主要的db节点
    'mysqlidb' => array(
        'mysqli' => array(
            'master' => array(
                'username' => 'woshimaijia_test',
                'password' => 'woshimaijia_test',
                'hostname' => '127.0.0.1',
                'database' => 'bd_main',
                'hostport' => '3306',
                'charset' => 'utf8',
                'profiler' => false,
            ),
            'near' => array(
                array(
                    'username' => 'woshimaijia_test',
                    'password' => 'woshimaijia_test',
                    'hostname' => '127.0.0.1',
                    'database' => 'bd_main',
                    'hostport' => '3306',
                    'charset' => 'utf8',
                    'profiler' => false,
                ),
                array(
                    'username' => 'woshimaijia_test',
                    'password' => 'woshimaijia_test',
                    'hostname' => '127.0.0.1',
                    'database' => 'bd_main',
                    'hostport' => '3306',
                    'charset' => 'utf8',
                    'profiler' => false,
                )
            ),
            'backup' => array(
                array(
                    'username' => 'woshimaijia_test',
                    'password' => 'woshimaijia_test',
                    'hostname' => '127.0.0.1',
                    'database' => 'bd_main',
                    'hostport' => '3306',
                    'charset' => 'utf8',
                    'profiler' => false,
                ),
                array(
                    'username' => 'woshimaijia_test',
                    'password' => 'woshimaijia_test',
                    'hostname' => '127.0.0.1',
                    'database' => 'bd_main',
                    'hostport' => '3306',
                    'charset' => 'utf8',
                    'profiler' => false,
                )
            ),
        ),
    ),
    //QUEUE
    'queue' => array(
        //set the main queue
        'queue' => array('host' => '127.0.0.1', 'port' => '55555'),
        //set the main queue
        'resys' => array('host' => '127.0.0.1', 'port' => '55555'),
    ),
    //Log Node
    'log' => array(
        'Web' => array(
            'dir' => '/Wsmjdev/Wwwlogs',
            'file' => 'logall',
            'level' => 16,
            'info' => array('uid' => '', 'ip' => '', 'traceid' => ''),
            'flush' => false,
        ),
        'Wap' => array(
            'dir' => '/Wsmjdev/Wwwlogs',
            'file' => 'logall',
            'level' => 16,
            'info' => array('uid' => '', 'ip' => '', 'traceid' => ''),
            'flush' => false,
        ),
        'Mis' => array(
            'dir' => '/Wsmjdev/Wwwlogs',
            'file' => 'logall',
            'level' => 16,
            'info' => array('uid' => '', 'ip' => '', 'traceid' => ''),
            'flush' => false,
        ),
        'Api' => array(
            'dir' => '/Wsmjdev/Wwwlogs',
            'file' => 'logall',
            'level' => 16,
            'info' => array('uid' => '', 'ip' => '', 'traceid' => ''),
            'flush' => false,
        ),
        'BackEnd' => array(
            'dir' => '/Wsmjdev/Wwwlogs',
            'file' => 'logall',
            'level' => 16,
            'info' => array('uid' => '', 'ip' => '', 'traceid' => ''),
            'flush' => false,
        ),
    ),
    //使用了又拍云了，这个只是作为一个本地的备份来用
    //Image resource node
    'image' => array(
        'image' => array(
            's' => array(160, 100, 48, 32),
            'b' => array(500),
            'path' => '/Wsmjdev/woshimaijia/src/php/Presentation/Images/images/',
        ),
    ),
    //Memcache Node
    'cache' => array(
        'memcached' => array(
            'type' => 'memcached',
            'machines' => array(
                array('127.0.0.1', '12000', '90'),
                array('127.0.0.1', '12000', '10'),
            )
        ),
        'memcache' => array(
            'type' => 'memcache',
            'machines' => array(
                array('127.0.0.1', '12000', '90'),
                array('127.0.0.1', '12000', '10'),
            )
        ),
    ),
    //Session Server node
    //本次项目开发过程中使用了redis来存放
    'session' => array(
        //store session info to redis
        'Web' => array('handler' => 'redis', 'path' => 'tcp://127.0.0.1:6379'),
        'Wap' => array('handler' => 'redis', 'path' => 'tcp://127.0.0.1:6379'),
        //SET OPEN API
        'Api' => array('handler' => 'redis', 'path' => 'tcp://127.0.0.1:6379'),
    ),
    //搜索使用coreseek
    'search' => array(
        'search' => array(
            'host' => '127.0.0.1',
            'port' => '9313',
            'timeout' => 3,
        ),
        'group' => array(
            'host' => '127.0.0.1',
            'port' => '9312',
            'timeout' => 3,
        ),
    ),
    //
    //dictionay.defaultdic
    'dictionay' => array(
        'defaultdic' => CONF_PATH . DIRECTORY_SEPARATOR . 'dictionary/dict.utf8.xdb',
        'defaultrule' => CONF_PATH . DIRECTORY_SEPARATOR . 'dictionary/rules_cht.utf8.ini',
        'brand' => CONF_PATH . DIRECTORY_SEPARATOR . 'dictionary/brand.txt', //brand 
        'tags' => CONF_PATH . DIRECTORY_SEPARATOR . 'dictionary/tags.txt', //all tags of sys
        'feeling' => CONF_PATH . DIRECTORY_SEPARATOR . 'dictionary/feeling.txt', //all actions of human 
    ),
    //短信设置
    //mobile sp groups
    'mobile_sp_group' => array(
        'china_unicom' => array(130, 131, 132, 152, 155, 156, 185, 186),
        'china_mobile' => array(134, 135, 136, 137, 138, 139, 147, 150, 151, 157, 158, 159, 182, 187, 188),
        'china_telecom' => array(133, 153, 180, 189)
    ),
    //SMS setting
    'smsRateLimit' => array(
        'reg' => array(
            array('interval' => 10 * 60, 'limit' => 3)
        ),
        'promo' => array(
            array('interval' => 10 * 60, 'limit' => 30000)
        ),
        'getpassword' => array(
            array('interval' => 10 * 60, 'limit' => 3)
        ),
    ),
    'sms' => array(
        '12114' => array('code' => '', 'url' => 'http://www.bizsms.cn/InterFace/InterFace.php', 'user' => '', 'pass' => ''),
    ),
    //邮件设置
    'mail' => array(
        'qq' => array('host' => 'smtp.qq.com', 'user' => '1106137593@qq.com', 'pass' => 'heihei', 'port' => '25'),
        'mine' => array('host' => 'smtp.qq.com', 'user' => '1106137593@qq.com', 'pass' => 'heihei', 'port' => '25'),
    ),
    //又拍云存储的配置
    //image upload use upaiyun.com  image service 
    'imageservice' => array(
        'api' => 'http://v0.api.upyun.com',
        'url' => 'http://img001.img.woshimaijia.com',
        'bucketname' => 'woshimaijia',
        'username' => 'woshimaijia',
        'userpass' => '123456',
    ),
    //淘宝商品配置
    'goods' => array(
        'taobaoGoods' => array(
            'appkey' => '12001294', // '12246069', 
            'secretKey' => '16a1997bca97ab3308ee4e474766515a', // 'd851ce819e88729a0c6420d4c7be4a19',
            'pid' => '14884963', //mm_14884963_0_0 //26961453
        ), // 12038739  a736284e86fa87c3dc8d23dc88f1a7d0
    ),
    //外部系统连接配置
    'outlogin' => array(
        'weibo' => array(
            'akey' => '3610158076',
            'skey' => 'e409a614763927d228d198d34d448a63',
            'callbackurl' => 'http://web.dev.woshimaijia.com/login/weibocallback',
        ),
        //qzone：空间；pengyou：朋友；qplus：Q+；tapp：微博；qqgame：QQGame；3366：3366。
        //后缀加上_m代表来自手机，如：pengyou_m：手机朋友。
        'qq' => array(
            'akey' => '36018',
            'skey' => 'df454fe74d2e9ad5c61979dbaf03bdf2',
            'servername' => '119.147.19.43',
            'platform' => 'tapp',
            'callbackurl' => 'http://web.dev.woshimaijia.com/login/qqcallback',
        ),
        'renren' => array(
            'apiurl' => 'http://api.renren.com/restserver.do',
            'akey' => '24243753e6984be88a59db608219d472',
            'skey' => '07dba0a4838d47dc971c0316a654f0e8',
            'apiversion' => '1.0',
            'decodeformat' => 'json',
            'callbackurl' => 'http://web.dev.woshimaijia.com/login/renrencallback',
        ),
    ),
);
