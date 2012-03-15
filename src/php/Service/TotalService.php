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

class TotalService {

    public static function dataIndex($param) {
        $r = array();
        if (!empty($param['type']) && !empty($param['id'])) {
            extract($param);
            $r['title'] = isset($type) ? self::funcType($type) : '';
            $p = isset($p) && $p >= 1 ? $p : 1;
            $pageSize = 20;
            $userList = self::redisGetKeyValues($id, KeysService::$ulist, $type, $p, $pageSize);
            //取得结果
            $r['count'] = self::redisGetKeyValues('', KeysService::$size, KeysService::getKey(KeysService::$ulist, $type, $id));
            $r['size'] = $pageSize;
            //获取用户列表
            $r['user'] = AccountLogic::getUsers($userList, 'user_id');
            $r['list'] = $userList;
            return $r;
        }
        return false;
    }

    public static function dataUserProduct($param) {
        $r = array();
        if (!empty($param['type']) && !empty($param['id'])) {
            extract($param);
            $r['title'] = isset($type) ? self::funcType($type) : '';
            $p = isset($p) && $p >= 1 ? $p : 1;
            $pageSize = 20;
            $idList = self::redisGetKeyValues($id, KeysService::$ulist, $type, $p, $pageSize);
            //取得结果
            $r['count'] = self::redisGetKeyValues('', KeysService::$size, KeysService::getKey(KeysService::$ulist, $type, $id));
            $r['size'] = $pageSize;
            $ids = empty($idList) ? '' : (is_array($idList) && !empty($idList)) ? '(' . rtrim(implode($idList, ','), ',') . ')' : "($idList)";
            $r['products'] = ProductLogic::getsProduct($ids);
            //var_dump($r['count']);
            return $r;
        }
        return false;
    }

    public static function funcType($type) {
        $r = '';
        switch ($type) {
            case 'follow':
                $r = '我关注的大家';
                break;
            case 'befollow':
                $r = '关注我的大家';
                break;
            case 'like':
                $r = '喜欢';
                break;
            case 'willbuy':
                $r = '想买';
                break;
            case 'own':
                $r = '拥有';
                break;
            default:
                $r = '';
        }
        return $r;
    }

    public static function dataProduct($param) {
        extract($param);
        $r = array();
        $p = isset($p) && $p >= 1 ? $p : 1;
        $pageSize = 16;
        $r['products'] = self::getsByPage('product', "status=0 order by id desc", $p, $pageSize);
        //取得结果
        $r['count'] = self::count('product');
        $r['size'] = $pageSize;
        return $r;
    }

    public static function dataBrand($param) {
        extract($param);
        $r = array();

        $p = isset($p) && $p >= 1 ? $p : 1;
        $pageSize = 24;
        $r['brands'] = self::getsByPage('brand', "status=0 order by id desc", $p, $pageSize);
        //取得结果
        $r['count'] = self::count('brand');
        $r['size'] = $pageSize;

        //var_dump($r);

        return $r;
    }

    public static function dataUsers($param) {
        $r = array();
        if (!empty($param['type']) && !empty($param['id'])) {
            extract($param);
            $p = isset($p) && $p >= 1 ? $p : 1;
            $pageSize = 20;
            $userList = self::redisGetKeyValues($id, KeysService::$ulist, $type, $p, $pageSize);
            //取得结果
            $r['count'] = self::redisGetKeyValues('', KeysService::$size, KeysService::getKey(KeysService::$ulist, $type, $id));
            $r['size'] = $pageSize;
            //获取用户列表
            $r['user'] = AccountLogic::getUsers($userList, 'user_id');
            $r['list'] = $userList;
            return $r;
        }
        return false;
    }

}