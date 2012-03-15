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
 * Online user count stat
 * @author xinqiyang
 *
 */
class OnlineService {

    /**
     * count web project's online user count
     * per 30 second run ,aget all online users data
     * @param unknown_type $key
     * @param unknown_type $sessionPrefix
     */
    public static function online($key = 'PHPREDIS_SESSION:*', $sessionPrefix = 'uinfo', $node = '') {
        $return = array();
        $redis = MRedis::instance($node);
        $keys = $redis->keys($key);
        $count = 0;
        foreach ($keys as $val) {
            $value = $redis->get($val);
            if ($value) {
                if (is_int(strpos($value, $sessionPrefix))) {
                    $count++;
                }
            }
        }
        //get all usersession count
        $return['userSession'] = count($keys);
        $return['userOnline'] = $count;
        return $return;
    }

    /**
     * do all user logout 
     * @param mixed $keys
     * @param string $node
     */
    public static function logoutAll($keys, $node = '') {
        return self::redisDeleteKeys($keys, $node);
    }

}