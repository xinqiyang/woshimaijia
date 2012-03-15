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

class ProductService {

    public static function actAddProduct($array) {
        $code = Error::PARAM_ERROR;
        $r = 0;
        $data = array();
        $url = '';
        if (!empty($array['title']) && !empty($array['account_id'])) {
            extract($array);
            $source = !empty($source) ? $source : 'web';
            if (!empty($url) && empty($url_id)) {
                $urlSetReturn = UrlLogic::setUrl($title, $url, $account_id, $source);
                $url_id = $urlSetReturn['data'];
            }
            $image_id = !empty($image_id) ? $image_id : 0;
            $brand_id = !empty($brand_id) ? $brand_id : 0;
            $titleextend = !empty($titleextend) ? $titleextend : '';
            $r = ProductLogic::setProduct($title, $account_id, $image_id, $brand_id, $url_id,$titleextend);
            $code = $r['code'];
            $data['id'] = $r['data'];
            $data['url_id'] = $url_id;
        }
        return array('code' => $code, 'data' => $data);
    }


    public static function getProductDesc($id) {
        return self::queryField('post', "object_id=$id and istop=1 order by id desc", 'content');
    }

    public static function dataProduct($array) {
        if (!empty($array['id'])) {
            extract($array);
            $r = ProductLogic::get('Product', $array['id']);
            if (!empty($r['id'])) {
                $p = isset($p) && $p >= 1 ? $p : 1;
                $pageSize = 10;
                $postList = self::redisGetKeyValues(KeysService::$list, KeysService::$keyPost, $id, $p, $pageSize);
                $ids = empty($postList) ? '' : '(' . rtrim(implode($postList, ','), ',') . ')';
                //取得结果
                $r['count'] = self::redisGetKeyValues(KeysService::$size, KeysService::getKey(KeysService::$list, KeysService::$keyPost, $id));
                //var_dump($r['count']);
                $r['size'] = $pageSize;
                $r['post'] = PostLogic::getPostByIds($ids);

                //获取买过的用户
                $r['likeids'] = self::redisGetKeyValues(KeysService::$ulist, KeysService::$keyLike, $id, 0, 5);
                //获取已买的用户
                $r['ownids'] = self::redisGetKeyValues(KeysService::$ulist, KeysService::$keyOwn, $id, 0, 5);
                //获取想买的
                $r['willbuyids'] = self::redisGetKeyValues(KeysService::$ulist, KeysService::$keyWillBuy, $id, 0, 4);

                //获取数字
                $r['likenum'] = self::redisGetKeyValues(KeysService::$size, KeysService::getKey(KeysService::$ulist, KeysService::$keyLike, $id));
                $r['ownnum'] = self::redisGetKeyValues(KeysService::$size, KeysService::getKey(KeysService::$ulist, KeysService::$keyOwn, $id));
                $r['willbuynum'] = self::redisGetKeyValues(KeysService::$size, KeysService::getKey(KeysService::$ulist, KeysService::$keyWillBuy, $id));
                //var_dump($r['likenum']);
                $r['topcomments'] = ProductLogic::getTopComments($r['id']);

                //获取所有的ID然后去取对象
                $ids = array_merge($r['ownids'], $r['likeids'], arrToOne($r['post'], 'user_id'), array($r['user_id']));
                $r['user'] = AccountLogic::getUsers($ids, 'user_id');
                return $r;
            } else {
                //跳转到错误页面
                jump('/public/404');
            }
        }
        return false;
    }

    public static function actAddProductPost($array) {
        $code = Error::PARAM_ERROR;
        $r = '';
        if (!empty($array['user_id']) && !empty($array['content']) && !empty($array['object_id'])) {
            extract($array);
            $r = ProductLogic::addProductPost($content, $user_id, $object_id);
            if ($r) {
                //add to redis
                $return = self::redisSetKeyValues(KeysService::$list, KeysService::$keyPost, $r, $object_id);
                $r = $object_id;
                $code = Error::SUCCESS;
            } else {
                $code = Error::BUSY;
            }
        }
        return array('code' => $code, 'id' => $r);
    }

}