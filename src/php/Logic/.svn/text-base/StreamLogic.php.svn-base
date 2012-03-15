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
 * POST Logic 
 * NEED TO ADD CACHE LAYER
 * @author xinqiyang
 *
 */
class StreamLogic extends BaseLogic {

    public static function setStream($id, $content, $object_id, $account_id, $source,$userlocation_id=0, $istopic = 0, $istop = 0, $ispost = 0, $imageids = 0, $action = 'say', $notdeal = false, $isusercopy = 0) {
        $code = Error::PARAM_ERROR;
        $data = '';
        if (!$notdeal) {
            if (!empty($object_id)) {
                $dealid = $object_id;
            } else {
                $dealid = $id;
            }
            $postdeal = new StreamDealerLogic($content, $dealid, $account_id);
            try {
                $content = $postdeal->deal();
            } catch (Exception $e) {
                logNotice("POST DEAL EXCEPTION:" . $e->__toString());
            }
            $objid = $postdeal->getObject();
            if (!empty($objid) && empty($object_id)) {
                $object_id = $objid;
            }
            $objimageids = $postdeal->getImageids();
            if (!empty($objimageids) && empty($imageids)) {
                $imageids = $objimageids;
            }
        }
        $array = array(
            'id' => $id,
            'content' => $content,
            'istopic' => $istopic,
            'status' => 0,
            'object_id' => $object_id,
            'account_id' => $account_id,
            'istop' => $istop,
            'replay' => 0,
            'source' => $source,
            'image_id' => $imageids,
            'usercopy' => 0,
            'ispost' => $ispost,
            'action' => $action,
            'isusercopy' => $isusercopy,
            'userlocation_id'=>$userlocation_id,
        );
        if (self::add('stream', $array)) {
            $code = Error::SUCCESS;
            //处理关联操作
            if (!$notdeal) {
                $tagids = $postdeal->tagids();
            }
            if (!empty($tagids)) {
                foreach ($tagids as $one) {
                    //@todo 这里设置标签关联移除
                    $r = self::redisSetKeyValues(KeysService::$ulist, KeysService::$keyTags, $id, $one);
                    if (!$r) {
                        logNotice('SET REDIS ERROR %s', $one);
                    }
                }
            }
            $data = $id;
        }else{
            $code = Error::BUSY;
        }
        return array('data'=>$data,'code'=>$code);
    }

    
    public static function getByAction($action, $offset = 0, $number = 40) {
        $where = "action ='{$action}' and status=0 order by istopic desc,istop desc,id desc limit {$offset},{$number}";
        return self::gets('stream', $where);
    }

    /**
     * get post by userid
     * 
     * @param bigint $account_id
     * @param int $limit
     */
    public static function getByUserid($account_id, $offset,$pageSize=20) {
        $where = "account_id=$account_id and status=0";
        return self::getsByPage('stream', $where,$offset,$pageSize);
    }

    public static function getByIds($ids) {
        return is_array($ids) && count($ids) ? self::gets('stream', "ID IN ".strin($ids)." AND status=0 ORDER BY ID DESC") : self::get('stream',$ids,'*','status=0');
    }

    
    public static function getStreams($ids,$selectfields='id,content,istopic,istop,source,ispost,action,isusercopy,account_id,image_id,object_id,userlocation_id')
    {
        if(!empty($ids) && is_array($ids)){
            $ids = strin($ids);
            return self::gets('stream',"id in $ids and status=0 order by id desc",$selectfields);
        }
        return array();
    }

    
    public static function setUsercopy($object_id)
    {
        $code = Error::PARAM_ERROR;
        $data = '';
        if(!empty($object_id))
        {
            if(self::redisSetKeyValues(KeysService::$count, KeysService::$keyCountStreamCopy, 1,$object_id))
            {
                $code = Error::SUCCESS;
            }else{
                $code = Error::BUSY;
            }
        }
        return array('code'=>$code,'data'=>$data);
    }
}