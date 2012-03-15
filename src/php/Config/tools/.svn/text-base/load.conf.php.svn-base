<?php
/**
 * 配置文件加载入口
 * 
 * 需要如何减少文件的IO呢？ 这块对所有的配置文件进行一次合并后缓存起来即可
 * @var unknown_type
 */
$global = include CONF_PATH.DIRECTORY_SEPARATOR.'global.conf.php';
$config = include CONF_PATH.DIRECTORY_SEPARATOR.'resource.conf.php';
return array_merge($config,$global);