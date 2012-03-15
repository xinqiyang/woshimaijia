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

class PubService {

    public static function dataIndex($array) {
        $code = Error::PARAM_ERROR;
        extract($array);
        $p = isset($p) && $p >= 1 ? $p : 1;
        $pageSize = 10;
        $pubUserList = BaseLogic::redisGetKeyValues(KeysService::$ulist, KeysService::$keyPub, $p, $pageSize);
        $idList = BaseLogic::redisGetKeyValues($pubUserList, KeysService::$string, KeysService::$keyLastPost);
        $r['count'] = BaseLogic::redisCount(KeysService::$ulist, KeysService::$keyPub);
        $r['size'] = $pageSize;
        $r['stream'] = StreamLogic::getByIds($ids);
        $r['user'] = AccountLogic::getUsers($r['post'], 'user_id');
        return array('code'=>$code,'data'=>$return);
    }

}