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

class HomeService {

    public static function dataIndex($array) {
        $code = Error::PARAM_ERROR;
        $return = array();
        if(!empty($array['uid'])) {
            extract($array);
            $postIds = BaseLogic::redisGetKeyValues(KeysService::$list, KeysService::$keyOutbox,$uid);
            $return['stream'] = StreamLogic::getStreams($postIds);
            $userids = datasetToArray($return['stream'],'account_id');
            $return['user'] = AccountLogic::getAccounts($userids);
            $return['count'] = StreamLogic::redisCount(KeysService::$list,  KeysService::$keyOutbox,$uid);
            $return['size'] = 20;
            $followReturn = FollowService::dataFollow($array);
            if($followReturn['code'] === Error::SUCCESS)
            {
                $return['accounts'] = $followReturn['data'];
            }
            //var_dump($return);die;
        }
        return array('data'=>$return,'code'=>$code);
    }

}