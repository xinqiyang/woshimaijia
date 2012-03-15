<?php

class LoginAction extends AppBaseAction {

    public function index() {
        $this->t();
    }

    public function image() {
        $img = new Captcha();
        $img->generate();
    }

    public function logout() {
        //do logout
        $id = $this->uid;
        AccountService::actEndSession($id);
        //清除cookie
        Cookie::setnull('uinfo');
        //jump to the page
        $this->redirect('login/index', array('code' => 0));
    }

    //微博登陆
    public function weibo() {
        if (!$this->uid) {
            $c = C('outlogin.weibo');
            $o = new SaeTOAuthV2($c['akey'], $c['skey']);
            $code_url = $o->getAuthorizeURL($c['callbackurl']);
            jump($code_url);
        }else{
            jump(U('home/index'));
        }
    }

    //callback
    public function weibocallback() {
        if (!empty($_REQUEST['code'])) {
            $c = C('outlogin.weibo');
            if (!empty($c['akey']) && !empty($c['skey'])) {
                $o = new SaeTOAuthV2($c['akey'], $c['skey']);
                if (isset($_REQUEST['code'])) {
                    $keys = array();
                    $keys['code'] = $_REQUEST['code'];
                    $keys['redirect_uri'] = $c['callbackurl'];
                    try {
                        $token = $o->getAccessToken('code', $keys);
                    } catch (OAuthException $e) {
                        logNotice("WEIBO OAUTH EXCEPTION:" . $e->__toString());
                    }
                }

                if (!empty($token)) {
                    $_SESSION['token'] = $token;
                    setcookie('weibojs_' . $o->client_id, http_build_query($token));
                    //进行跳转
                    $this->redirect('signup/guide?outer=weibo');
                } else {
                    //
                    echo "AUTH ERROR";
                }
            }
        } else {
            //跳转到错误页面
            jump('Public/error');
        }
    }

    public function qq() {
        $config = C('outlogin.qq');
        $app_id = $config['akey'];
        $app_secret = $config['skey'];
        $my_url = $config['callbackurl'];
        $code = !empty($_REQUEST["code"]) ? $_REQUEST["code"] : 0;
        if (empty($code)) {
            //state参数用于防止CSRF攻击，成功授权后回调时会原样带回
            $_SESSION['state'] = md5(uniqid(rand(), TRUE));
            //拼接URL
            $dialog_url = "https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id="
                    . $app_id . "&redirect_uri=" . urlencode($my_url) . "&state="
                    . $_SESSION['state'];
            echo("<script> top.location.href='" . $dialog_url . "'</script>");
        }

        //Step2：通过Authorization Code获取Access Token
        if ($_REQUEST['state'] == $_SESSION['state']) {
            //拼接URL
            $token_url = "https://graph.qq.com/oauth2.0/token?grant_type=authorization_code&"
                    . "client_id=" . $app_id . "&redirect_uri=" . urlencode($my_url)
                    . "&client_secret=" . $app_secret . "&code=" . $code;
            $response = file_get_contents($token_url);
            var_dump($response);
            die;
            if (strpos($response, "callback") !== false) {
                $lpos = strpos($response, "(");
                $rpos = strrpos($response, ")");
                $response = substr($response, $lpos + 1, $rpos - $lpos - 1);
                $msg = json_decode($response);
                if (isset($msg->error)) {
                    echo "<h3>error:</h3>" . $msg->error;
                    echo "<h3>msg  :</h3>" . $msg->error_description;
                    exit;
                }
            }

            //Step3：使用Access Token来获取用户的OpenID
            $params = array();
            parse_str($response, $params);
            $graph_url = "https://graph.qq.com/oauth2.0/me?access_token=" . $params['access_token'];
            $str = file_get_contents($graph_url);
            if (strpos($str, "callback") !== false) {
                $lpos = strpos($str, "(");
                $rpos = strrpos($str, ")");
                $str = substr($str, $lpos + 1, $rpos - $lpos - 1);
            }
            $user = json_decode($str);
            if (isset($user->error)) {
                echo "<h3>error:</h3>" . $user->error;
                echo "<h3>msg  :</h3>" . $user->error_description;
                exit;
            }
            echo("Hello " . $user->openid);
        } else {
            echo("The state does not match. You may be a victim of CSRF.");
        }
    }

    public function taobao() {
        
    }

    public function qqt() {
        $this->qq();
    }

    public function wy() {
        
    }

    public function renren() {
        $code = !empty($_REQUEST["code"]) ? $_REQUEST["code"] : '';
        if (empty($code)) {
            $config = C('outlogin.renren');
            $_SESSION['state'] = md5(uniqid(rand(), TRUE)); //CSRF protection
            $dialog_url = "http://graph.renren.com/oauth/authorize?client_id="
                    . $config['akey'] . "&redirect_uri=" . urlencode($config['callbackurl']) . "&state="
                    . $_SESSION['state'];
            echo("<script> top.location.href='" . $dialog_url . "'</script>");
        }
    }

    public function qqcallback() {
        
    }

    public function renrencallback() {
        if (!empty($_REQUEST['error'])) {
            //捕获到错误
            $errorDescription = $_REQUEST['error_description'];
            logNotice("RENREN AUTH ERROR:" . $errorDescription);
            //跳转到首页去
            jump('/public/404');
        } elseif (!empty($_REQUEST['code']) && $_REQUEST['code'] == 'A_CODE_GENERATED_BY_SERVER') {
            $config = C('outlogin.renren');
            //调用人人的API获取
            if ($_REQUEST['state'] == $_SESSION['state']) {
                $token_url = "https://graph.renren.com/oauth/token?"
                        . "client_id=" . $config['akey'] . "&redirect_uri=" . urlencode($config['callbackurl'])
                        . "&client_secret=" . $config['skey'] . "&code=" . $_REQUEST['code'];

                $response = @file_get_contents($token_url);
                $params = null;
                parse_str($response, $params);

                $graph_url = "https://api.renren.com/v2/user?access_token="
                        . $params['access_token'];

                $user = json_decode(file_get_contents($graph_url));
                echo("Hello " . $user->name);
                die;
            } else {
                echo("The state does not match. You may be a victim of CSRF.");
            }
        }
    }

}