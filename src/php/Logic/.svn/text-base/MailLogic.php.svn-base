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

class MailLogic extends BaseLogic {

    public static function setMail($account_id, $to_id, $title, $content,$status=2,$source = 'web') {
        $code = Error::PARAM_ERROR;
        $data = '';
        $array = array();
        $array['id'] = objid();
        $array['account_id'] = $account_id;
        $array['to_id'] = $to_id;
        $array['title'] = $title;
        $array['status'] = $status;
        $array['content'] = $content;
        $array['source'] = $source;
        if (self::add('mail', $array)) {
            $code = Error::SUCCESS;
            $data = $array['id'];
        }else{
            $code = Error::BUSY;
        }
        return array('data'=>$data,'code'=>$code);
    }

    //状态 2 未读， 0 已读 1 删除
    public static function setRead($id) {
        $code = Error::BUSY;
        $array = array(
            'id' => $id,
            'status' => 0,
        );
        if(self::saveClean('mail', $array))
        {
            $code = Error::SUCCESS;
        }
        return array('data'=>'','code'=>$code);
    }
    
    public static function getMails($ids)
    {
        $ids = is_array($ids) && count($ids) ? strin($ids) : $ids;
        $where = "id in $ids and status<>1";
        return self::gets('mail', $where);
    }

}