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



class SearchService {

    public static function dataGroup($param) {
        $code = Error::PARAM_ERROR;
        if (!empty($param['keyword'])) {
            extract($param);
            var_dump($keyword);
            $data = '';
        }
        return array('code' => $code,'data'=>$data);
    }

    public static function actStoreKeywords($words, $user_id = 0) {
        if (!empty($words)) {
            self::redisSetKeyValues(KeysService::$zset, KeysService::$keyUserSearchWords, $words);
            //如果存在用户，则将用户的搜索关键字记录下来
            if ($user_id) {
                self::redisSetKeyValues(KeysService::$list, KeysService::$keyUserSearchWords, $words, $user_id);
            }
        }
        return true;
    }

}