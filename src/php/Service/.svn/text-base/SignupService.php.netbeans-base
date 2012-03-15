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

class SignupService {

    public static function actGuide($param) {
        if (!empty($_GET['outer'])) {
            if ($_GET['outer'] == 'weibo') {
                require_cache(BUDDY_PATH . DIRECTORY_SEPARATOR . 'Vender' . DIRECTORY_SEPARATOR . 'SaeTOAuthV2.php');
                $config = C('outlogin.weibo');
                $c = new SaeTClientV2($config['akey'], $config['skey'], $_SESSION['token']['access_token']);
                $uid_get = $c->get_uid();
                if (!empty($uid_get['uid'])) {
                    $uid = $uid_get['uid'];
                    $account = AccountLogic::get('account','','id,userlocation_id', "outerid=$uid and fromsite='weibo' and status=0");
                    if (empty($account['id'])) {
                        $user_message = $c->show_user_by_id($uid); //根据ID获取用户等基本信息
                        //拼接用户基本信息并走注册流程写入数据库并生成session后跳转
                        $arr['screenname'] = $user_message['screen_name'];
                        $arr['account'] = $user_message['name'];
                        //$arr['location'] = $user_message['location'];
                        $arr['say'] = $user_message['description'];
                        $arr['email'] = $user_message['name'] . '@woshimaijia.com';
                        //上传头像
                        $arr['fromsite'] = $_GET['outer'];
                        $arr['image_id'] = ImageService::actSave($user_message['avatar_large']);
                        $arr['outerid'] = $uid;
                        $arr['ip'] = getip();
                        $arrGeso = UserlocationLogic::setLocation($arr['ip']);
                        if($arrGeso['code'] === Error::SUCCESS)
                        {
                            $arr['userlocation_id'] = $arrGeso['data']['id'];
                        }
                        $r = AccountService::actSignUp($arr);
                        //跳转到首页
                        if ($r['code'] == Error::SUCCESS) {
                            AccountLogic::setSession($r['data']);
                            if(!AccountLogic::getShowSignupPage($r['data'])){
                                jump(U('home/index'));
                            }
                        }else{
                            jump(U('public/error?code='.$r['code']));
                        }
                    } else {
                        //每次登录则更新新的IP地址信息
                        $arrGeso = UserlocationLogic::setLocation(getip());
                        if($arrGeso['code'] === Error::SUCCESS && !empty($arrGeso['data']['id']) && $arrGeso['data']['id'] !== $account['id'])
                        {
                            AccountLogic::setAccountLocation($account['id'], $arrGeso['data']['id']);
                        }
                        AccountLogic::setSession($account['id']);
                        if(!AccountLogic::getShowSignupPage($account['id'])){
                            jump(U('home/index'));
                        }
                    }
                }else{
                    jump(U('public/error',array('code'=>Error::BUSY)));
                }
            } elseif ($_GET['outer'] == 'qq') {
                /*
                $config = C('outlogin.qq');
                extract($config);
                $sdk = new OpenApiV3($akey, $skey);
                $sdk->setServerName($servername);
                $openid = '';
                $openkey = '';
                $ret = get_user_info($sdk, $openid, $openkey, $platform);
                var_dump($ret);
                 * 
                 */
            }
        }
    }

}