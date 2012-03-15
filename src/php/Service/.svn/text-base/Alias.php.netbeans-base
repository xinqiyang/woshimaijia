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


//------------------------NEED REMOVE---------------------------------------------

/**
 * return userId
 * session key is uid
 */
function userID()
{
	$uid = Session::get('uid');
        //var_dump($uid);die;
	return isset($uid) ? $uid : 0;
}

/**
 * get /set the traceid to trace
 * you should change the name of cookie 
 */
function traceID($name = 'engcookie')
{
	$value = cookie($name);
	$value = empty($value) ? $value = objid(3) : $value;
	cookie($name, $value,array('expire'=>7776000));
	return $value;
}



/**
 * friendly time show 
 * return the friendly time 
 * @param mixed $time string or int 
 */
function aliasTime($time)
{
	return Time::timeAgo($time);
}


/**
 * add page function
 * @param string $total count of array
 */
function page($total,$pageSize=40)
{
	if($total < $pageSize)
	{
		return '';
	}
	$p = new Page($total,$pageSize);
	return $p->show();
}



/**
 * content has user in
 * include <code>@username</code> in the user post
 * @param string $content user post
 * @param bigint $user_id userid
 */
function hasUser($content, $user_id)
{
        $pattern = '/@([\x{4e00}-\x{9fa5}\w\(\)]+)/u';
		preg_match_all($pattern,$content,$out,PREG_PATTERN_ORDER);
		foreach ($out[0] as $key=>$value) {
            $prof = AccountLogic::queryField('user', "id={$out[1][$key]} and status=0",'id');
			if(is_array($prof))
			{
				if($prof['id'] == $user_id)
				{
					return true;
				}
			}
		}
		return false;
}






/**
 * replace @url from user post
 * @param string $content
 */
function replaceAtUrl($content)
{
		$pattern = '/@([\x{4e00}-\x{9fa5}\w\(\)]+)/u';
		return preg_replace_callback(
            $pattern,
            create_function(
                '$match',
                'return \'<a href="/u/\' . urlencode($match[1]) . \'">@\' . $match[1] . \'</a>\';'
            ),
            $content);
}

/**
 * check at username
 * speak content of user post include at lable 
 * @param string $content user post
 * @param array $out_user_ids user ids
 */
function checkAtName($content, &$out_user_ids=array())
{
        $mention_users = array();
        $pattern = '/@([\x{4e00}-\x{9fa5}\w\(\)]+)/u';
        preg_match_all($pattern, $content, $out, PREG_PATTERN_ORDER);
        $mentions = array();
        foreach ($out[0] as $key => $value)
        {
            $prof = AccountLogic::queryField('user', "id={$out[1][$key]} and status=0",'id');
            if (!is_array($prof))
            {
                continue;
            }
            if (!in_array($prof['id'], $mentions))
            {
                $mentions[] = $prof['id'];
            }
        }
        $out_user_ids = $mentions;
        return $content;
}

/**
 * replace to private url
 * @param string $content
 */
function replaceToPrivateUrl($content)
{
		//@TODO need to be change to
		$prefix = C('site.url');
		$len    = strlen($prefix);
		$start = strpos($content, $prefix);
		if (false === $start)
		{
			return $content;
		}
		$rest = substr($content, ($start + $len));
		$temp = substr($content, 0, $start);
		if (preg_match('/^[a-z0-9\/]+/', $rest, $matches))
		{
			$url  = $prefix . $matches[0];
			$rest = substr($content, ($start + strlen($url)));
			return "{$temp}<a href=\"{$url}\" target=\"_blank\">{$url}</a>{$rest}";
		}
		else
		{
			return $content;
		}
		return $content;
}


 
 
 /**
 * set Session Server 
 * to store session info to server
 * default use redis to store
 * @param string $appName  Web/Wap/Api
 */
function sessionServer($appName)
{
	$config = C('session.'.$appName);
	if (!empty($config)) {
		ini_set('session.save_handler', $config['handler']);
		ini_set('session.save_path', $config['path']);
	}
	return ;
}


/**
 * set default user info
 * @TODO:需要移出的部分
 */
function defaultUser() {
    $uinfo = array('uid' => 0, 'screenname' => '', 'icon' => C('site.defaultIcon'), 'image_id' => 0);
    $uinfo['ip'] = getip();
    $uinfo['sessionid'] = session_id();
    return $uinfo;
}

/**
 * set default status
 */
function getstatus() {
    return '0';
}

function getBrandNum($id) {
    return BrandLogic::getLikeNum($id);
}

function getProductNum($id) {
    return ProductLogic::getLikeNum($id);
}

/*
 * 获取新的个人头像信息
 */

function getNewImage($image_id, $icon = 'a') {
    return ImageService::dataNewImages($image_id, $icon);
}

/**
 * 获取用户信息的
 * @param bigint $id
 * @throws Exception
 */
function getUser($id = '') {
    return empty($id) ? '' : AccountService::funcUser($id);
}

function getUserScreenname($id) {
    if (!empty($id)) {
        $user = AccountLogic::getAccount($id);
        return !empty($user) ? $user['screenname'] : '';
    }
    return '';
}

function getCity($enname) {
    return DistrictLogic::getCity($enname);
}

function getGroupUsers($id) {
    return GroupLogic::getGroupUsers($id);
}

function getTopicPostCount($id) {
    return TopicLogic::getTopicPostCount($id);
}

function setSession($id) {
    return AccountLogic::setSession($id);
}

function userCopy($id) {
    return PostLogic::getUserCopy($id);
}