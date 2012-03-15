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
    ),
);
