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

class TagsLogic extends BaseLogic {

    public static function setTag($tag, $status = 3) {
        $code = Error::PARAM_ERROR;
        $data = '';
        $tag = trim($tag);
        $objTag = self::isExist('tag', 'tag', $tag);
        if (!$objTag) {
            $array = array();
            $array['id'] = objid();
            $array['tag'] = $tag;
            $array['status'] = $status;
            if (self::add('tag', $array)) {
                $data = $array['id'];
                $code = Error::SUCCESS;
            } else {
                $code = Error::BUSY;
            }
        } else {
            $data = $objTag['id'];
            $code = Error::SUCCESS;
        }
        return array('code' => $code, 'data' => $data);
    }

    public static function setObjectAndTag($tag, $id, $account_id) {
        $code = Error::PARAM_ERROR;
        $data = '';
        $tagid = self::isExist('tag', 'tag', $tag);
        if ($tagid && $id) {
            if (ModelandmodelLogic::setModelandmodel($id, $tagid, $account_id, 'tag')) {
                $code = Error::SUCCESS;
                $data = $tagid;
            } else {
                $code = Error::BUSY;
            }
        } else {
            //写入临时的TAG表
            $tagid = self::setTag($tag);
            if ($tagid) {
                $code = Error::SUCCESS;
                $data = $tagid;
            } else {
                $code = Error::BUSY;
            }
        }
        return array('data' => $data, 'code' => $code);
    }

    public static function deltag($id) {
        $sql = "DELETE FROM __TABLE__ where id = $id";
        return MMysql::instance('tag')->execute($sql);
    }
    
    public static function savetag($id)
    {
        $code = Error::PARAM_ERROR;
        if($id>0){
            $arr['id'] = $id;
            $arr['status'] = 0;
            if(self::saveClean('tag', $arr))
            {
                $code = Error::SUCCESS;
            }
        }
        return array('data'=>'','code'=>$code);
    }

    /**
     * 获取全局的行动TAG
     * 包括TAG的点击次数
     * 假设都从redis中获取
     * @param type $ids 
     */
    public static function getActions($ids) {
        $return = array();
        if (!empty($ids) && is_array($ids)) {
            foreach ($ids as $key => $val) {
                $tag[$key] = KeysService::getKey(KeysService::$string, KeysService::$keyTag, $val);
                $count[$key] = KeysService::getKey(KeysService::$string, KeysService::$keyCountTag, $val);
            }

            $redis = MRedis::instance();
            $tags = $redis->mGet($tag);
            $tagscount = $redis->mGet($count);

            foreach ($ids as $key => $val) {
                $return[$val]['tag'] = $tags[$key];
                $return[$val]['count'] = $tagscount[$key];
            }
        }
        return $return;
    }
    
    

    /**
     * 设置global的action
     * @param bigint $user_id 用户ID
     * @param bigint $tag_id  TAGID
     * @return array 
     */
    public static function setActions($user_id, $tag_id) {
        $code = Error::PARAM_ERROR;
        if ($user_id && $tag_id) {
            $tag = BaseLogic::redisGetKeyValues(KeysService::$string, KeysService::$keyTag, $tag_id);
            if ($tag) {
                if (false !== BaseLogic::redisSetKeyValues(KeysService::$ulist, KeysService::$keyGo, $user_id, $tag_id)) {
                    //设置访问次数＋1
                    if (false !== BaseLogic::redisSetKeyValues(KeysService::$count, KeysService::$keyCountTag, 1, $tag_id)) {
                        $code = Error::SUCCESS;
                    } else {
                        Error::REDIS_COUNTSET_ERROR;
                    }
                } else {
                    $code = Error::REDIS_OBJECTSET_ERROR;
                }
            } else {
                $code = Error::TAG_NOT_FIND;
            }
        }
        return array('code' => $code, 'data' => '');
    }
    
    
    /**
     * getwords from the content of
     * type menu = defaultdic brand tags feeling
     * @param unknown_type $content
     */
    public static function getWords($content, $type = 'tags') {
        if (function_exists('scws_open')) {
            $cws = scws_open();
            scws_set_charset($cws, 'utf8');
            //add dict to the new
            $dictionary = C('dictionay');
            if (in_array($type, array_keys($dictionary))) {
                $path = $dictionary[$type];
            } else {
                $path = $dictionary['defaultdic'];
            }
            $rulepath = dirname($path) . DIRECTORY_SEPARATOR . 'rules.utf8.ini';
            scws_set_dict($cws, $path, SCWS_XDICT_TXT);
            scws_set_rule($cws, $rulepath);
            scws_send_text($cws, $content);
            $top = scws_get_tops($cws, 10);
            $return = array();
            if ($top) {
                foreach ($top as $one) {
                    if (mb_strlen($one['word']) >= 2) {
                        $return[] = $one['word'];
                    }
                }
                $return = array_unique($return);
            }
            return $return;
        }
        return array();
    }

}