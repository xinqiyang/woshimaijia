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

class MailService {

    public static function dataSelectTo($array) {
        $r = array();
        if (!empty($array['user_id'])) {
            extract($array);
            $follows = self::redisGetKeyValues($user_id, KeysService::$ulist, KeysService::$keyFollow);
            $befollows = self::redisGetKeyValues($user_id, KeysService::$ulist, KeysService::$keyBeFollow);
            $follows = array_merge($follows, $befollows);
            $r['users'] = AccountLogic::getUsers($follows);
            return $r;
        }
    }

    public static function dataWrite($array) {
        if (!empty($array['id'])) {
            return AccountLogic::getAccount($array['id']);
        }
        return false;
    }

    public static function dataIndex($array) {
        return array('data'=>'','code'=>'');
        if (!empty($array['user_id'])) {
            extract($array);
            $arr['list'] = MailLogic::getMail($array['user_id']);
            $userlist = array();
            $fromlist = arrToOne($arr['list'], 'from_id');
            $tolist = arrToOne($arr['list'], 'to_id');
            $userlist = array_merge($fromlist, $tolist);
            //var_dump($userlist);die;
            $arr['user'] = AccountLogic::getUsers($userlist, '', 'id,account,screenname');
            return $arr;
        }
        return false;
    }

    public static function dataMail($array) {
        if (!empty($array['id'])) {
            extract($array);
            //get key
            $key = KeysService::getKey(KeysService::$list, KeysService::$keyMail, $id);

            $array['mail'] = MailLogic::getMailBody($array['id']);
            $array['user'] = AccountLogic::getUsers($array['mail'], 'from_id', 'id,account,screenname,image_id');
            //标志为已读状态
            if ($array['mail']['status'] == 1 && $array['mail']['to_id'] == $user_id) {
                $r = MailLogic::setRead($array['mail']['id']);
            }
            return $array;
        }
        return false;
    }

    public static function actAddMail($array) {
        $code = Error::PARAM_ERROR;
        if (isset($array['from_id']) && isset($array['to_id']) && isset($array['title']) && isset($array['content'])) {
            extract($array);
            //给关注我的人发消息
            $follows = self::redisGetKeyValues($from_id, KeysService::$ulist, KeysService::$keyFollow);
            $befollows = self::redisGetKeyValues($from_id, KeysService::$ulist, KeysService::$keyBeFollow);
            $follows = array_merge($follows, $befollows);
            if (is_array($follows) && in_array($to_id, $follows)) {
                $r = MailLogic::addMail($from_id, $to_id, $title, $content);
                if ($r) {
                    //@TODO:提示收件人有新消息

                    $code = Error::SUCCESS;
                }
            } else {
                $code = Error::NotBeFollow;
            }
            return array('code' => $code);
        }
        return false;
    }

}