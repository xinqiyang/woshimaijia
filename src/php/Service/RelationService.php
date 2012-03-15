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

class RelationService {

    //用户点击的操作
    public static function actUserDoAction($array) {
        //var_dump($array);
        $code = Error::PARAM_ERROR;
        $r = 0;
        if (!empty($array['user_id']) && !empty($array['id']) && !empty($array['type'])) {
            extract($array);
            switch ($type) {
                case 'willbuy':
                case 'like':
                case 'hate':
                case 'own':
                case 'unwillbuy':
                case 'unlike':
                case 'unhate':
                case 'unown':
                    //添加然后移除
                    if (substr($type, 0, 2) !== 'un') {
                        $r = self::redisSetKeyValues(KeysService::$ulist, $type, $user_id, $id);
                        //TODO 只添加个人相关的内容
                        if (self::queryField('object', "id=$id", 'object') == 'product') {
                            self::redisSetKeyValues(KeysService::$ulist, $type, $id, $user_id);
                        }
                        $r = 1;
                    } else {
                        //移除个人的
                        self::redisGetHashes(KeysService::$remove, KeysService::getKey(KeysService::$ulist, $type, $id), $user_id);
                        self::redisGetHashes(KeysService::$remove, KeysService::getKey(KeysService::$ulist, $type, $user_id), $id);
                        $r = 2;
                    }
                    break;
                case 'del':
                    //判断权限
                    $object = 'post';
                    $obj = self::get($object, '', 'user_id,object_id', "id=$id");
                    if ($user_id == $obj['user_id']) {
                        $r = self::destory($id, $object, $obj['object_id']);
                        //@todo 移除cache是麻烦的事情
                    }
                    break;
                case 'top':
                    //判断是不是群组权限
                    $object = 'post';
                    $obj = self::get($object, '', 'user_id,object_id', "id=$id");
                    if ($user_id == $obj['user_id'] && $object) {
                        $r = self::destory($id, $object, $obj['object_id']);
                    }
                    break;
                case 'lock':
                    //判断是不是作者或者是群主
                    $object = 'post';
                    $obj = self::get($object, '', 'user_id,object_id', "id=$id");
                    if ($user_id == $obj['user_id'] && $object) {
                        $r = self::destory($id, $object, $obj['object_id']);
                        //@todo 移除cache是麻烦的事情
                    }
                    break;
                case 'tdel':
                    //判断是不是群组权限
                    $object = 'topic';
                    $obj = self::get($object, '', 'user_id', "id=$id");
                    if (!empty($obj)) {
                        $arradminids = GroupService::isAdmin($id);
                        if (($user_id == $obj['user_id'] || in_array($user_id, $arradminids))) {
                            $r = self::destory($id, $object, '');
                        }
                    }
                    break;
                case 'tcdel':
                    $object = 'post';
                    $obj = self::get($object, '', 'user_id,object_id', "id=$id");
                    if (!empty($obj)) {
                        $arradminids = GroupService::isAdmin($id);
                        if (($user_id == $obj['user_id'] || in_array($user_id, $arradminids))) {
                            $r = self::destory($id, $object, $obj['object_id']);
                            //@TODO 需要做后续的处理，topic减少回复数
                        }
                    }
                    break;
            }
            $code = Error::SUCCESS;
        }
        return array('code' => $code, 'data' => $r);
    }

    public static function focus($uid, $id) {
        $where = "modela_id=$uid and modelb_id=$id";
        $r = self::get('modelandmodel', '', '', $where);
        if (!$r) {
            return self::relationAdd($uid, $id, $uid, 'focus');
        } elseif (isset($r['status']) && $r['status'] == 1) {
            $r['status'] = 0;
            return self::save('modelandmodel', $r);
        }
        //@TODO:LOG && RECORD TO EVENT
        return false;
    }

    public static function setUserRelation($array) {
        extract($array);
        $where = "modela_id=$uid and modelb_id=$id and type='$atype' and status=0";
        $r = self::get('modelandmodel', '', '', $where);
        if (!$r) {
            return self::relationAdd($uid, $id, $uid, $atype);
        } elseif (isset($r['status']) && $r['status'] == 1) {
            $r['status'] = 0;
            return self::save('modelandmodel', $r);
        }
        //@TODO:LOG && RECORD TO EVENT
        return false;
    }

    public static function unfocus($uid, $id) {
        $where = "modela_id=$uid and modelb_id=$id and status=0";
        $r = self::get('modelandmodel', '', '', $where);
        if ($r) {
            //save
            $r['status'] = 1;
            return self::save('modelandmodel', $r);
        }
        //@TODO:LOG && RECORD TO EVENT
        return false;
    }

    public static function getUserRelation($uid, $id, $type, $limit) {
        $where = "user_id=$uid and modela_id=$id and status=0 and type='$type'";
        $r = self::gets('modelandmodel', $where);
        if (!$r) {
            return false;
        }
        return $r;
    }

    public static function getRelation($id, $type, $limit) {
        $where = "modela_id=$id and status=0 and type='$type'";
        $r = self::gets('modelandmodel', $where);
        if (!$r) {
            return false;
        }
        return $r;
    }

    /**
     * add the relation id
     * Enter description here ...
     * @param unknown_type $modelaid
     * @param unknown_type $modelbid
     * @param unknown_type $userid
     * @param unknown_type $type
     * @param unknown_type $locationid
     * @param unknown_type $extention
     */
    private static function relationAdd($modelaid, $modelbid, $userid, $type, $locationid = '', $extention = '') {
        $behavior = C('behavior');
        if (in_array($type, $behavior)) {
            $data['id'] = objid();
            $data['status'] = '0';
            $data['modela_id'] = $modelaid;
            $data['modelb_id'] = $modelbid;
            $data['createtime'] = time();
            $data['user_id'] = $userid;
            $data['type'] = $type; // define type
            $data['locationid'] = $locationid;
            $data['extension'] = $extention;
            return self::add('modelandmodel', $data);
        }
        logWARNING(__CLASS__ . '/' . __FUNCTION__ . ":$userid post the undefined behavior");
        return false;
    }

}