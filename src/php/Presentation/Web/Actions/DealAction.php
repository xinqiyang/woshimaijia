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
 * DataOperation Action for all dataoperation
 * @author xinqiyang
 * @date   2010-4-8
 *
 */
class DealAction extends AppBaseAction {



	/**
	 * 发布成功显示
	 */
	public function published()
	{
		$this->t();
	}


	/**
	 * 关系处理函数
	 * 对用户的操作进行处理
	 * TODO:需要防止用户恶意操作
	 */
	public function relmodel()
	{
		if($this->getuid())
		{
			$id = (int)$_POST['id'];
			$type = $_POST['action'];
			$model = substr($_POST['module'],4);
			$modelarr = array('url','goods','brand','user');
			$typearr = array('supportnum','buynum','gonum','goodnum','likenum','wantnum','ownernum','focus');
			$info = "系统异常^#^";
			$flag = '';
			//判断在模块组里面里面,则进行操作
			if(in_array($model,$modelarr) && in_array($type,$typearr))
			{
				$d = D('userandmodel');
				$data['linktype']=$type;

				$data['user_id']=$this->getuid();
				$data['model']=$model;
				$data['model_id']=$id;

				if(($id ==(int)$this->getuid()) && $type == 'focus')
				{
					$this->ajaxReturn('不能关注自己');
				}

				if($d->where($data)->find())
				{
					$info = "已操作过^-^";
				}else{
					$data['status']='1';
					$data['sequence']='3';
					$data['createtime']=time();
					if($d->add($data))
					{
						//指数加一去
						D($model)->setInc($type,"id=$id");
						D($model)->rm($id);
						if($type=='buynum')
						{
							$info ='<a href="'.__APP__.'/show/goods">去晒晒吧^-^</a>';
						}elseif($type=='focus')
						{
							$info = "关注成功^-^";
						}
						else{
							$info = "操作成功^-^";
						}
						$flag = '1';
					}
				}
			}else{
				$info = "NO IN ^-^";
			}
			//dump($d->getlastSQL());
			$this->ajaxReturn($info,$flag);
		}else{
			$this->ajaxReturn('请先<a href="'.__APP__.'/login">登陆</a>^-^');
		}
	}


	function focus()
	{
		if($this->getuid())
		{
			$id = (int)$_POST['id'];


		}else{
			$this->ajaxReturn('请先<a href="'.__APP__.'/login">登陆</a>^-^');
		}
	}

	/**
	 * 记录点击操作的方法
	 */
	public function clickaction()
	{
			$_POST['sid'] = (int)$_POST['id'];
			unset($_POST['id']);
			$_POST['model'] = substr($_POST['module'],4);
			$_POST['user_id'] = userID();
			
			//操作click模块
			$d = D('click');
			//关闭表单提交
			C('TOKEN_ON',false);
			if($d->create())
			{
				if($d->add())
				{
					//开启表单提交
					C('TOKEN_ON',true);
					$this->ajaxReturn('1');
				}
			}
		
	}
	
	

}
?>