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

/**
 * tag services
 * add /get /destroy tags
 * @author xinqiyang
 *
 */
class TagService {

    /**
     * add id or ids
     * @param array $array
     */
    public static function actAddTag($array) {
        $code = Error::PARAM_ERROR;
        $objTag = '';
        $data = '';
        if (!empty($array['tag'])) {
            extract($array);
            $objTag = TagsLogic::setTag($tag);
            if ($objTag['code'] === Error::SUCCESS ) {
                //标注tag的属性,建立tag的缓存
                $code = Error::SUCCESS;
                $data = $objTag['data'];
            } else {
                $code = Error::BUSY;
            }
        }
        return array('code' => $code, 'data' => $data);
    }
    
    public static function actCheckTags($array)
    {
        
    }

    /**
     * get tags by tagid or ids
     * @param $tags
     */
    public static function getTagsByIds($array) {
        if (!empty($array)) {
            return self::gets('tags', 'id in ' . strin($array));
        }
        return array();
    }

    public static function getHotTags() {
        //@TODO:这里需要读取后台数据
        $array = array(13273980290596430, 13273980341244550, 13273980564072250);
        $re = self::getTagsByIds($array);
        return $re;
    }

    /**
     * delete tags by array id or id
     * @param $array mixed string/array
     */
    public static function tagDestory($array) {
        return self::destory('tags', $array);
    }

    

    public static function dataTag($array) {
        $r = array();
        if (!empty($array['id'])) {
            extract($array);
            $r['title'] = "标签：" . self::queryField('tags', "id=$id", 'tag');
            $p = isset($p) && $p >= 1 ? $p : 1;
            $pageSize = 10;
            $idList = self::redisGetKeyValues($id, KeysService::$ulist, KeysService::$keyTags, $p, $pageSize);
            $ids = empty($idList) ? '' : (is_array($idList) && !empty($idList)) ? '(' . rtrim(implode($idList, ','), ',') . ')' : "($idList)";
            //取得结果
            $r['count'] = self::redisGetKeyValues('', KeysService::$size, KeysService::getKey(KeysService::$ulist, KeysService::$keyTags, $id));

            $r['size'] = $pageSize;
            $r['post'] = PostLogic::getPostByIds($ids);
            $r['user'] = AccountLogic::getUsers($r['post'], 'user_id');
        }
        return $r;
    }

}