<?php
/**
 * ApiError Class
 * define all api status
 * @author xinqiyang
 *
 */
class ApiError
{
	//
	
    static $BadRequest      = array(400,    '请求数据不合法，或者超过请求频率限制');
    static $UserNotExists   = array(50009,  '用户不存在');
    static $UserBaned       = array(50008,  '用户被封禁了');
    static $UserLogoff      = array(50010,  '用户注销了');
    static $BaiduIdGetError = array(80001,  '获取失败');
    
    
}