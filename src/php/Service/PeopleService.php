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

class PeopleService {

    //$array['enname'] == account
    public static function dataSpace($array) {
        $arr = array();
        if (!empty($array['enname'])) {
            extract($array);
            $arr['account'] = PeopleLogic::getPeopleByEnname($enname);
            $user_id = $arr['account']['id'];

            $likeids = BaseLogic::redisGetKeyValues( KeysService::$ulist, KeysService::$keyLike,$user_id, 0, 4);
            $ownids = BaseLogic::redisGetKeyValues( KeysService::$ulist, KeysService::$keyOwn,$user_id, 0, 4);
            $willbuyids = BaseLogic::redisGetKeyValues(KeysService::$ulist, KeysService::$keyWillBuy,$user_id,  0, 4);
            $likeids = empty($likeids) ? '' : '(' . rtrim(implode($likeids, ','), ',') . ')';

            if ($likeids) {
                //var_dump($likeids);
                $arr['like'] = ProductLogic::getsProduct($likeids);
            }

            $ownids = empty($ownids) ? '' : '(' . rtrim(implode($ownids, ','), ',') . ')';
            if ($ownids) {
                $arr['own'] = ProductLogic::getsProduct($ownids);
            }
            $willbuyids = empty($willbuyids) ? '' : '(' . rtrim(implode($willbuyids, ','), ',') . ')';
            if ($willbuyids) {
                $arr['willbuy'] = ProductLogic::getsProduct($willbuyids);
            }

            //获取数字
            $arr['likenum'] = BaseLogic::redisGetKeyValues(KeysService::$size, KeysService::getKey(KeysService::$ulist, KeysService::$keyLike, $user_id));
            $arr['ownnum'] = BaseLogic::redisGetKeyValues( KeysService::$size, KeysService::getKey(KeysService::$ulist, KeysService::$keyOwn, $user_id));
            $arr['willbuynum'] = BaseLogic::redisGetKeyValues(KeysService::$size, KeysService::getKey(KeysService::$ulist, KeysService::$keyWillBuy, $user_id));


            $p = isset($p) && $p >= 1 ? $p : 1;
            $pageSize = 10;
            $inboxList = BaseLogic::redisGetKeyValues($user_id, KeysService::$list, KeysService::$keyOutbox, $p, $pageSize);
            $ids = empty($inboxList) ? '' : '(' . rtrim(implode($inboxList, ','), ',') . ')';
            //取得结果
            $arr['count'] = BaseLogic::redisGetKeyValues(KeysService::$size, KeysService::getKey(KeysService::$list, KeysService::$keyOutbox, $user_id));
            //var_dump($r['count']);
            $arr['size'] = $pageSize;
            $arr['post'] = StreamLogic::getStreams($ids);
            $arr['user'] = AccountLogic::getAccounts();
        }
        return $arr;
    }

}