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
 * Spam Service
 * wordfilter
 * @author xinqiyang
 *
 */
class SpamService {

    static $spamwords;

    /**
     * filter words
     * @param string $words
     */
    public static function wordFilter($words) {
        //get the words
        //@TODO LOAD SPAME WORDS
        $spamWords = array('胡锦涛', '温家宝', '赵紫阳', '六四事件', '法轮功', '法轮大法', '罢餐天安门');
        foreach ($spamWords as $one) {
            if (is_int(strpos($words, $one))) {
                return true;
            }
        }
        return false;
    }

    public static function countViewRate($objid) {
        
    }

}