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
   'redis'=>array(
	    //redis master
	    'redis'=>array(
	    	'host'=>'127.0.0.1',
	    	'port'=>6379,
	    	'slaves'=>array(
		    	array(
		    	'host'=>'127.0.0.1',
		    	'port'=>6380,
		    	),
	    	),
	    ),
    ),
    //no use
    //MetaData config
    'object_common_attribute'=>array('title','image','url','text'),
    'object_type'=>array(
    	'webpage'=>array('id','title','image','url'),
    	'product'=>array('id','brand','model','price','origin','category'),
    	'video'=>array('id','title','url','player_url'),
    	'movie'=>array('id','title','url','director','year'),
    	'song'=>array('id','title','url','artist','year','genre','album'),
    	'people'=>array('id','title','url','hometown','birthday'),
    	'user'=>array('id','email','password','screen_name','name','province','city','location','description','url','profile_image','domain','gender','followers_count','friends_count','statuses_count','favourites_count','created_at','following','verified'),
    	'place'=>array('id','title','url','street_address','locality','region','postal_code','contry_name','phone','latitude','longitude'),
    	'review'=>array('id','content','rating','url'),
    	'comment'=>array('id','text','source','favorited','truncated','created_at','user','status','reply_comment'),
    	'restaurant'=>array('id','cuisine','pricerange'),
    	'book'=>array('id','isbn','author','publisher','year'),
    	'stock'=>array('id','symbol','price'),
	    'event'=>array('id','location','start_date','end_date'),
	    'vote'=>array('id','option','count'),
	    'pay'=>array('id','seller','end_date','price','discount'),
	    'job'=>array('id','company','duties'),
	    'game'=>array('id','manufacture','plateform'),
	    'app'=>array('id','author','tags','category','rating'),
    	'message'=>array('id','text','source','favorited','truncated','in_reply_to_msg_id','in_reply_to_user_id','in_reply_to_screen_name','thumbnail_pic','bmiddle_pic','original_pic','user','retweeted_status'),
    	'directmessage'=>array('id','text','sender_id','recipient_id','created_at','sender_screen_name','recipient_screen_name','sender','recipient'),
    ),

    //redis key lable
    'keys'=>array('cat_l_','',''),

    //cache key config
    'redis_key'=>array(
    	'prefix'=>'bdk_',
    	'counttype'=>array('want','buy','love','see','own'), //need to count type
    	'inbox'=>'ib_', // 500
    	'onbox'=>'ob_', // 500
    	'feeds'=>'f_', // 500
    	'followed'=>'fd_', //
    	'following'=>'fi_', //set 
    	'object'=>'o_', //object sigle
    	'list'=>'l_', //
	    'msglist'=>'ml_', //message list set 500
	    'msgmylist'=>'mml_', //message list set 500
	    'objtypecount'=>'objc_', //
    ),
    
    
    'mysql'=>array(
    //db configuration
    'mysql'=>array(
	    'dbms' => 'mysql',
	    'username' => 'root',
	    'password' => '123456',
	    'hostname' => '127.0.0.1',
	    'hostport' => '3306',
	    'database' => 'buddy',
	    'db_prefix' => 'bd_',
	    'fields_cache'=>TRUE, //if set false then no flush table info
	    'fields_cache_path'=>'/home/xinqiyang/wwwlogs/',//  
		'use_slaves'=>TRUE, //use slaves  true/false
	    'slaves' => array(
	        array('username' => 'root',
	            'password' => '123456',
	            'hostname' => '127.0.0.1',
	            'hostport' => '3306'),
	        array('username' => 'root',
	            'password' => '123456',
	            'hostname' => '127.0.0.1',
	            'hostport' => '3306'),
	        array('username' => 'root',
	            'password' => '123456',
	            'hostname' => '127.0.0.1',
	            'hostport' => '3306'),
	        array('username' => 'root',
	            'password' => '123456',
	            'hostname' => '127.0.0.1',
	            'hostport' => '3306'),
	    	)
    	),
   
    
    
    'wsmj'=>array(
	    'dbms' => 'mysql',
	    'username' => 'root',
	    'password' => '123456',
	    'hostname' => '127.0.0.1',
	    'hostport' => '3306',
	    'database' => 'wsmj',
	    'db_prefix' => 'sz_',
	    'fields_cache'=>TRUE, //if set false then no flush table info
	    'fields_cache_path'=>'/home/xinqiyang/wwwlogs/',//  
		'use_slaves'=>TRUE, //use slaves  true/false
	    'slaves' => array(
	        array('username' => 'root',
	            'password' => '123456',
	            'hostname' => '127.0.0.1',
	            'hostport' => '3306'),
	        array('username' => 'root',
	            'password' => '123456',
	            'hostname' => '127.0.0.1',
	            'hostport' => '3306'),
	        array('username' => 'root',
	            'password' => '123456',
	            'hostname' => '127.0.0.1',
	            'hostport' => '3306'),
	        array('username' => 'root',
	            'password' => '123456',
	            'hostname' => '127.0.0.1',
	            'hostport' => '3306'),
	    	)
    ),
    ),
    //QUEUE
    'queue'=>array(
    	//set the main queue
    	'queue'=>array('host'=>'127.0.0.1','port'=>'55555'),
    ),
    
    //LOG SAVE PATH
    'logpath'=>'/home/xinqiyang/wwwlogs/logs/dev.woshimaijia.com/',
    
    
    );
