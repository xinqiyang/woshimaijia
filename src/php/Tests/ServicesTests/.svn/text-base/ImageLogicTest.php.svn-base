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
require_once dirname(dirname(__FILE__))."/TestConfiguration.php";

class ImageLogicTest extends PHPUnit_Framework_TestCase
{

	public function testgetimage()
	{
		//var_dump(ImageService::getImages(11,'m'));
		var_dump(getImage(11,'l'));
	}
	
	public function resize()
	{
		$img = '1.jpg';
		/*
		$objImage = new Image();
		$objImage->load($img);
		$objImage->resize(100,100);
		$objImage->save('./Upload/jj.jpg');
		*/
		//Image::resizeImg($img,120,0,'./Upload/oo1.jpg');
		//Image::resizeImg($img,0,80,'./Upload/oo2.jpg');
		Image::resizeImg($img,'default','aaaaa','b');
		//Image::resizeOnlineImg($img,'./Upload/ooonline.jpg',100,0,0.2);
		//Image::cutImg($img,'./Upload/ccc.jpg',100,100,505,105);
	}
	
}