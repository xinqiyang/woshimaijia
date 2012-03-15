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
 * Account Service
 * do all logic here
 * all the logic of the system,it include  3 table's in the db and many keys  in the redis
 * @author xinqiyang
 *
 */
class AccountService {

    /**
     * 注册用户
     * 注册完成后返回用户id
     * @param unknown_type $array
     */
    public static function actSignUp($params) {
        $code = Error::PARAM_ERROR;
        $data = '';
        if (!empty($params['account'])) {
            extract($params);
            $screenname = $account;
            $email = !empty($email) ? $email : '';
            $image_id = !empty($image_id) ? $image_id : 0;
            $mobile = !empty($mobile) ? $mobile : '';
            $fromsite = !empty($fromsite) ? $fromsite : 'wsmj';
            $ip= !empty($ip) ? $ip : getip();
            $source = !empty($source) ? $source : 'web';
            $type= 1; //默认类型
            $say= !empty($say) ? $say : '';
            $userlocation_id = !empty($userlocation_id) ? $userlocation_id : '';
            $outerid = !empty($outerid) ? $outerid : '';
            $password = !empty($password) ? $password : '';
            $return = AccountLogic::setAccount($account, $password, $screenname, $email, $image_id, $mobile, $fromsite, $ip, $source,$type,$say,$userlocation_id,$outerid);
            if($return['code'] == Error::SUCCESS)
            {
                //var_dump($return['data']);die;
                AccountLogic::setSession($return['data']);
                $data = $return['data'];
            }else{
                $code = $return['code'];
            }
        }
        return array('data'=>$data,'code'=>$code);
    }
    
    
    public static function actEndSession($id)
    {
        $code = Error::PARAM_ERROR;
        if($id)
        {
            AccountLogic::setEndSession($id);
            $code = Error::SUCCESS;   
        }
        return array('data'=>'',$code=>$code);
    }
    

    /**
     * 更新信息
     * 更新用户信息的数组
     * array('id'=>'','field'=>'');
     * @param array $array
     */
    public static function actSave($params) {
        $code = Error::PARAM_ERROR;
        $data = '';
        if (!empty($params['id'])) {
            $r = AccountLogic::setSaveAccount($params);
            if ($r['code'] === Error::SUCCESS) {
                AccountLogic::setSession($params['id']);
                $code = Error::SUCCESS;
                $data = $params;
            } else {
                $code = Error::BUSY;
            }
        }
        return array('code' => $code,'data'=>$data);
    }
    
    

    public static function actEmailSave($params) {
        $code = Error::PARAM_ERROR;
        $data = '';
        if (!empty($params['id']) && !empty($params['email']) && !empty($params['password'])) {
            $params['password'] = md5($params['password']);
            $r = AccountLogic::setSaveAccount($params);
            if ($r['code'] === Error::SUCCESS) {
                AccountLogic::setSession($params['id']);
                $code = Error::SUCCESS;
                $data = $params;
            } else {
                $code = Error::BUSY;
            }
        }
        return array('code' => $code,'data'=>$data);
    }
    
    /*
    public static function actPassword($params) {
        return AccountLogic::setPassword($params);
    }
    */
    

    /**
     * 列出新来的各位
     * @param int $count
     */
    public static function dataNewAccounts($params) {
        $code = Error::PARAM_ERROR;
        $data = array();
        if(!empty($params['count']))
        {
            return; AccountLogic::getNewAccounts($params['count']);
        }
        return array('code'=>$code,'data'=>$data);
    }
    
    
    public static function dataSetting($params)
    {
        $code = Error::PARAM_ERROR;
        $data = '';
        if(!empty($params['uid']))
        {
            $data = AccountLogic::getAccount($params['uid']);
            //var_dump($params,$data);die;
            if(!empty($data) && is_array($data)){
                $code = Error::SUCCESS;
            }else{
                $code = Error::BUSY;
            }
        }
        return array('code'=>$code,'data'=>$data);
    }
    
    
    
}