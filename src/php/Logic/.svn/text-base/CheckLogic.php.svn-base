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

class CheckLogic extends BaseLogic {

    public static function check($func, $value) {
        $strError = '';
        switch ($func) {
            case 'signUpCheckAccount':
                $strError = Error::ACCOUNT_NAME_DUP;
                $object = 'account';
                $field = 'account';
                break;
            case 'signUpCheckEmail':
                $strError = Error::ACCOUNT_EMAIL_DUP;
                $object = 'account';
                $field = 'email';
                break;
            case 'checkSpam':
                $strError = Error::INCLUDE_DANGER_WORDS;
                $r = SpamService::wordFilter($value);
                if (!$r) {
                    return 'success';
                }
                return $strError;
                break;
            case 'checkBrandName':
                $strError = Error::BRAND_NAME_DUMP;
                $object = 'brand';
                $field = 'title';
                break;
            case 'checkBrandEnname':
                $strError = Error::BRAND_ENNAME_DUMP;
                $object = 'brand';
                $field = 'enname';
                break;
            case 'checkProductName':
                $strError = '这个组名已被使用';
                $object = 'product';
                $field = 'title';
                break;
            default:
                return 'undefine error';
        }
        $result = self::isExist($object, $field, $value);
        if ($result) {
            return $strError;
        } elseif ($func !== 'checkSpam') {
            $strError = Error::INCLUDE_DANGER_WORDS;
            $r = SpamService::wordFilter($value);
            if (!$r) {
                return 'success';
            }
            return $strError;
        }
        return 'success';
    }

}