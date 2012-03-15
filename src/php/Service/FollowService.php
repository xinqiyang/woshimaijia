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

class FollowService {

    public static function actFollow($array) {
        $r = '';
        $code = Error::PARAM_ERROR;
        if (!empty($array['id']) && !empty($array['uid']) && !empty($array['type'])) {
            extract($array);
            //$behavior = C('behavior');
            if ($id == $uid) {
                //提示不能对自己操作
                return array('code' => Error::NOT_ACTION_MYSELF, 'data' => $r);
            }
            $modela_id = $uid;
            $modelb_id = $id;
            $ra = '';
            $rb = '';
            if ($type == 'follow') {
                //加入了我follow某人
                $ra = BaseLogic::redisSetKeyValues(KeysService::$ulist, KeysService::$keyFollow, $modelb_id, $modela_id);
                //某人的befollow加入我的ID
                $rb = BaseLogic::redisSetKeyValues(KeysService::$ulist, KeysService::$keyBeFollow, $modela_id, $modelb_id);

                //TODO：给某人发一条关注的消息通知
                //@TODO：将用户ID写入到队列中进行消息的推送
                $r = 1;
            } elseif ($type == 'unfollow') {
                $ra = BaseLogic::redisSetKeyValues(KeysService::$remove, KeysService::getKey(KeysService::$ulist, KeysService::$keyFollow, $modela_id), $modelb_id);
                //某人的befollow加入我的ID
                $rb = BaseLogic::redisSetKeyValues(KeysService::$remove, KeysService::getKey(KeysService::$ulist, KeysService::$keyBeFollow, $modelb_id), $modela_id);
                $r = 2;
            }
            if (!$ra || !$rb) {
                logNotice(__CLASS__ . '/' . __FUNCTION__ . " add to follow and befollow cache error %s %s", $ra, $rb);
                $code = Error::BUSY;
            }
            $code = Error::SUCCESS;
        }
        return array('code' => $code, 'data' => $r);
    }

    public static function dataFollow($array) {
        $code = Error::PARAM_ERROR;
        $return = array();
        if (!empty($array['uid'])) {
            extract($array);
            $ids = BaseLogic::redisGetKeyValues(KeysService::$ulist, KeysService::$keyFollow,$uid,0,20);
            $code = Error::SUCCESS;
            $return = AccountLogic::getAccounts($ids);
        }
        return array('code'=>$code,'data'=>$return);
    }
    
    public static function dataBeFollow($array) {
        $code = Error::PARAM_ERROR;
        $return = array();
        if (!empty($array['uid'])) {
            extract($array);
            $ids = BaseLogic::redisGetKeyValues(KeysService::$ulist, KeysService::$keyBeFollow,$uid,0,20);
            $code = Error::SUCCESS;
            $return = AccountLogic::getAccounts($ids);
        }
        return array('code'=>$code,'data'=>$return);
    }

    /**
     * 验证2个客户的认证的状态
     * @param unknown_type $array
     */
    public static function dataUser2Follow($array) {
        $data = 0;
        $code = Error::PARAM_ERROR;
        if (!empty($array['user_id']) && !empty($array['id'])) {
            extract($array);
            if ($user_id == $id) {
                $data = 1; //不显示
            } else {
                $follow = BaseLogic::redisGetKeyValues(KeysService::$ulist, KeysService::$keyFollow, $user_id);
                if (in_array($id, $follow)) {
                    $data = 2; //显示取消
                } else {
                    $data = 3; //显示
                }
            }
            $code = Error::SUCCESS;
        }
        return array('code' => $code, 'data' => $data);
    }

}