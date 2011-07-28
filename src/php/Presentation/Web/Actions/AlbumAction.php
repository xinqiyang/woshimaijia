<?php
// +----------------------------------------------------------------------
// | WoShiMaiJia Projcet
// +----------------------------------------------------------------------
// | Copyright (c) 2010 http://woshimaijia.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: xinqiyang <517577550@qq.com>
// +----------------------------------------------------------------------
/**
 * 相册模块
 * @author xinqiyang
 * @date   2010-7-7
 *
 */
class AlbumAction extends AppBaseAction
{
	function _af_deal($param)
	{
		switch ($param)
		{
			case 'album':
				$this->redirect('album/uploadmyimg',array(''=>''));
				break;
		}
	}
	

	public function index()
	{
		$a = D('album');
		$ids = $a->field('id')->where('user_id='.$this->getuid())->select();
		//显示
		//dump($a->getAlbums(strin($ids)));
		//dump($a->getLastSql());
		$this->assign('album',$a->getAlbums(strin($ids)));
		$this->page = array('title'=>'相册','tags'=>'相册,相册,我是买家相册','desc'=>'我是买家相册');
		$this->t();
	}

	/**
	 * 显示相册内容
	 */
	public function albumshow()
	{
		$id = (int)$_GET['id'];
		if($id)
		{
			$a = D('album');
			$album = $a->find($id);
			$this->assign('album',$album);
			//加载照片
			$this->page = $album;
			$this->t();
		}
	}
	
	public function uploadmyimg()
	{
		$this->page=array('title'=>'上传我的照片','tags'=>'上传照片','desc'=>'上传我的照片');
		$this->t();
	}
	
	public function cuticon()
	{
		//传入参数,加载图片,然后处理

		$this->assign('image_id',$_GET['image_id']);
		// 284  266    284 = pointx*2 + cutx , 266 = pointy*2 +cuty , zoom = cutx / cuty
		//规格 zoom = 2  
		//		$array = array(
		//			'cutx'=>'210', //宽度
		//			'cuty'=>'70', //高度
		//		    'zoom'=>'3', //缩放比例
		//			'pointx'=>'37', //点宽
		//			'pointy'=>'83', //点高
		//		);
		//
		//		$this->assign('p',$array);
		$this->t();
	}

	function setavatar()
	{
		if(!empty($_REQUEST['cut_pos']))
		{
			import('ORG.Util.ImageResize');

			$imgresize = new ImageResize();
			$imgresize->load(getUImage($_REQUEST['image_id'],'',false)); //载入原始图片

			$posary=explode(',', $_REQUEST['cut_pos']);
			foreach($posary as $k=>$v) $posary[$k]=intval($v); //获得缩放比例和裁剪位置

			if($posary[2]>0 && $posary[3]>0) $imgresize->resize($posary[2], $posary[3]); //图片缩放

			$uico = D('image')->find($_REQUEST['image_id']);
			//dump($uico);exit;

			//设置3个默认值
			$whl = 120;
			$whn = 100;
			$whs = 48;
			switch($_POST['model'])
			{
				case 'group':
					$whl = 120;
					$whn = 100;
					break;
				case 'url':
					$whl = 300;
					$whn = 120;
					break;
				case 'goods':
					$whl = 300;
					$whn = 120;
					break;
				case 'brand':
					$whl = 300;
					$whn = 120;
					break;

			}
			//保存160*160的大图
			$imgresize->cut(300, 300, intval($posary[0]), intval($posary[1]));
			$imgresize->resize($whl, $whl);
			$large = 'l_'.$uico['filename'];

			//$imgresize->display();exit;
			$imgresize->save($uico['url'].'/'.$uico['model'].'/spic/'.$large);
			//dump($r);
			//exit;
			//保存中图
			$imgresize->resize($whn, $whn);
			$normal = $uico['filename'];
			$imgresize->save($uico['url'].'/'.$uico['model'].'/spic/'.$normal);
			//保存48*48的小图
			$imgresize->resize($whs, $whs);
			$meduim = 'm_'.$uico['filename'];
			$imgresize->save($uico['url'].'/'.$uico['model'].'/spic/'.$meduim,true);

			$module ='';
			$goto = '';
			switch($_POST['model'])
			{
				case 'group':
					$goto = "group/showgroup/id/".$_POST['goto'];
					$this->redirect($goto);
					break;
				case 'url':
					$module ='gogo';
					break;
				case 'goods':
					if($_POST['showtype'] == '2')
					{
						//去 上传其他的图片的了
						$this->redirect('album/uploadimg',array('goto'=>$_POST['goto']));
					}
					$module ='show';
					break;
				case 'brand':
					$module ='show';
					break;
			}
			//dump(urlencode($goto));exit;
			$this->redirect('deal/published',array('module'=>$module,'action'=>'show'.$_POST['model'],'id'=>$_POST['goto']));
		} else {
			//报告错误
			//跳到头像上传那去
			$this->error('cut image error');
		}

	}


	function uploadimg()
	{
		//这里怎么防止多次上传啦
		$this->page = array('title'=>'晒晒的图片上传','tags'=>'上传图片,我是买家','desc'=>'上传图片,我是买家');
		$this->t();
	}

	/**
	 * 上传晒晒相册图片
	 */
	function douploadimg()
	{
		$imageids = $this->upload(ucwords('goods'),true,120,120);
		//dump($imageids);exit;
		if($imageids)
		{
		    //更新图片表
			D('goods')->setField('imageids',$imageids,"id='".$_POST['id']."' and user_id=".$this->getuid());
		}
		//显示信息
		$this->redirect('deal/published',array('module'=>'show','action'=>'showgoods','id'=>$_POST['id']));

	}


}

?>