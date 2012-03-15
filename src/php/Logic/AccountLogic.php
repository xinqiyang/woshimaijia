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

class AccountLogic extends BaseLogic {

    public static function setAccount($account, $password, $screenname, $email, $image_id = 0, $mobile = '', $fromsite = 'wsmj', $ip = '', $source = 'web', $type = 0, $say = '', $userlocation_id = '', $outerid = '') {
        $code = Error::PARAM_ERROR;
        $data = '';
        $array = array();
        $array['id'] = objid();
        $array['account'] = $account;
        $array['password'] = $password;
        $array['email'] = $email;
        $array['mobile'] = $mobile;
        $array['type'] = $type;
        $array['status'] = 0;
        $array['ip'] = $ip;
        $array['image_id'] = $image_id;
        $array['screenname'] = $screenname;
        $array['source'] = $source;
        $array['fromsite'] = $fromsite;
        $array['say'] = $say;
        $array['userlocation_id'] = $userlocation_id;
        $array['outerid'] = $outerid;

        if (!empty($email) && self::isExist('account', 'email', $email)) {
            $code = Error::ACCOUNT_EMAIL_DUP;
        } elseif (!empty($account) && self::isExist('account', 'account', $account)) {
            $code = Error::ACCOUNT_NAME_DUP;
        } elseif (!empty($mobile) && self::isExist('account', 'mobile', $mobile)) {
            $code = Error::ACCOUNT_MOBILE_DUP;
        } elseif (self::add('account', $array)) {
            $data = $array['id'];
            $code = Error::SUCCESS;
        }
        return array('code' => $code, 'data' => $data);
    }

    /**
     * set user session info
     * 
     * @param array $array
     */
    public static function setSession($id = 0) {

        $fields = 'id,account,screenname,image_id,say,userlocation_id,fromsite';
        $defaultAccount = array('id' => 0, 'screenName' => '', 'icon' => C('site.defaultIcon'), 'image_id' => 0);
        $uinfo = $id > 0 ? self::getAccount($id, $fields) : $defaultAccount;
        $uinfo['sessionid'] = session_id();
        Session::set('uinfo', json_encode($uinfo));
        if ($id>0) {
            Session::set('uid', $id);
        }
        return array('data' => '', 'code' => Error::SUCCESS);
    }

    /**
     * set user cookie
     * account,password
     * @param unknown_type $array
     */
    public static function setCookie($array, $key = 'uinfo') {
        $code = Error::UNKWON_ERROR;
        if (Cookie::enset($key, $array)) {
            $code = Error::SUCCESS;
        }
        return array('data' => '', 'code' => $code);
    }

    /**
     * get all cookie from user
     * @param unknown_type $array
     */
    public static function getCookie($key = 'uinfo') {
        return Cookie::enget($key);
    }

    /**
     * end Session
     * end session and then set cookie null
     */
    public static function setEndSession($id) {
        //@TODO:set cookie set null
        $array['id'] = $id;
        $array['logoutTime'] = time();
        self::addToEventQueue($array, __CLASS__ . ':' . __METHOD__);
        Session::destroy();
        Cookie::setnull('autologin');
        Cookie::setnull('uinfo');
        return array('data' => '', 'code' => Error::SUCCESS);
    }

    /**
     * 设置登录后的操作
     * @param array $params
     */
    public static function setLogin($params) {
        $code = Error::PARAM_ERROR;
        if (isset($params['status']) && isset($params['autologin']) && $params['status'] === 0) {
            if ($params['autologin'] == 'on') {
                self::setCookie($params['account']);
            }
            self::setSession($params['account']['id']);
            $code = Error::SUCCESS;
        }
        return array('data' => '', 'code' => $code);
    }

    public static function setAutoLogin($id, $email, $password) {
        $code = Error::PARAM_ERROR;
        if ($id > 0) {
            $account = self::getAccount($id);
            if (!empty($account) && $account['status'] == 0 && $account['email'] == $email && $account['password'] == $password) {
                self::setSession($account['id']);
                $code = Error::SUCCESS;
            }
        }
        return array('data' => '', 'code' => $code);
    }

    public static function getUserinfo($id, $fields) {
        return self::get('userinfo', $id, $fields);
    }

    public static function getNewAccounts($n = 10, $field = 'id,account,screenname,image_id') {
        $ids = self::redisGetKeyValues(KeysService::$list, KeysService::$keySignupUsers, '', 0, $n);
        if (!empty($ids)) {
            $ids = strin($ids);
            return self::getAccounts($ids, $field);
        }
        return array();
    }

    public static function getAccount($id, $fields = 'id,account,email,status,screenname,source,fromsite,group_id,userlocation_id,image_id,say') {
        return self::get('account', $id, $fields, 'status=0');
    }

    public static function getAccountsWithID($ids = '', $selectfield = '*') {
        return !empty($ids) ? self::getsKeyID('account', "ID IN $ids AND status=0 ORDER BY id DESC", $selectfield) : array();
    }

    public static function getAccounts($ids = '', $selectfield = 'id,account,email,status,screenname,source,fromsite,group_id,userlocation_id,image_id') {
        if(!empty($ids) && is_array($ids))
        {
            $ids = strin($ids);
            return self::getsKeyID('account', "ID IN $ids AND status=0 ORDER BY id DESC", $selectfield);
        }
        return array();
    }

    public static function setCheckLogin($email, $password) {
        $data = array();
        $code = Error::PARAM_ERROR;
        $account = self::get('account', '', 'id,account,email,password,status', "email='$email'");
        if ($account) {
            if ($account['password'] == $password) {
                if ($account['status'] == 1) {
                    $code = Error::ACCOUNT_LOGIN_FORBIDEN;
                } elseif ($account['status'] == 0) {
                    $code = Error::SUCCESS;
                    $data['id'] = $account['id'];
                    $data['account'] = $account;
                }
            } else {
                //user or password error
                $code = Error::ACCOUNT_LOGIN_PASSERROR;
            }
        } else {
            $code = Error::ACCOUNT_LOGIN_PASSERROR;
        }
        return array('data' => $data, 'code' => $code);
    }

    public static function setSaveAccount($params) {
        $code = Error::PARAM_ERROR;
        if (is_array($params) && isset($params['id']) && $params['id'] > 0) {
            if (self::saveClean('account', $params)) {
                $code = Error::SUCCESS;
            } else {
                $code = Error::BUSY;
            }
        }
        return array('data' => $params, 'code' => $code);
    }

    public static function setSaveUserinfo($params) {
        $code = Error::PARAM_ERROR;
        if (is_array($params) && isset($params['id'])) {
            $r = self::saveClean('userinfo', $params);
            if ($r) {
                $code = Error::SUCCESS;
            }
        }
        return array('data' => '', 'code' => $code);
    }

    public static function getScreenname($id) {
        if (!empty($id)) {
            $user = self::get('account', '', "account,screenname", "id=$id and status=0");
            if ($user) {
                return "<a target='_blank' href='" . U('people/space', array('account' => $user['account'])) . "'>" . $user['screenname'] . "</a>";
            }
        }
        return '';
    }

    public static function setPassword($params) {
        $code = Error::PARAM_ERROR;
        $data = '';
        if (!empty($params['id']) && !empty($params['password']) && !empty($params['newpassword'])) {
            $account = self::getAccount($params['id']);
            if (!empty($account['password']) && $account['password'] == $params['password']) {
                $params['password'] = $params['newpassword'];
                unset($params['newpassword']);
                $r = self::saveClean('account', $params);
                if ($r) {
                    Cookie::setnull('uinfo');
                    $code = Error::SUCCESS;
                } else {
                    $code = Error::BUSY;
                }
            } else {
                $code = Error::ACCOUNT_PWD_CHG_OLDERROR;
            }
        }
        return array('code' => $code, 'data' => $data);
    }

    public static function setAccountLocation($account_id, $userlocation_id) {
        $arr = array();
        $code = Error::PARAM_ERROR;
        $data = '';
        if ($account_id && $userlocation_id) {
            $arr['id'] = $account_id;
            $arr['userlocation_id'] = $userlocation_id;
            if (self::saveClean('account', $arr)) {
                $code = Error::SUCCESS;
                $return = ModelandmodelLogic::setModelandmodel($account_id, $userlocation_id, $account_id, 'location');
                if ($return['code'] !== Error::SUCCESS) {
                    logFatal("ACCOUNT AND LOCATION RELATION ADD ERROR : ACCOUNT:%s,LOCATION:%s", $account_id, $userlocation_id);
                }
            }
        }
        return array('data' => $data, 'code' => $code);
    }
    
    
    public static function getShowSignupPage($user_id)
    {
        $user = self::get('account',$user_id,'email,password');
        if(empty($user['email']) || empty($user['password']))
        {
            return true;
        }
        return false;
    }

}