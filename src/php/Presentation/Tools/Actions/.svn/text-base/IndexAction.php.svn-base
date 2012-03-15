<?php

class IndexAction extends Action {

    //初始化载入函数
    protected $config;

    protected function _initialize() {

        $model = MMysql::instance(DEFAULTTABLE);
        $table_arr = array();
        $tables = $model->query('SHOW TABLES');
        $this->config = C('mysql.mysql');
        $dbname = $this->config['database'];

        foreach ($tables as $value) {
            $table = $value['Tables_in_' . $dbname];
            array_push($table_arr, $table);
        }

        $this->assign('dbtable', $table_arr);
    }

    /**
     * function return action
     *
     * @package index
     * @access private
     */
    function returna() {
        $model = trim($_REQUEST["dbtable"]);
        $code = '';
        if (!empty($model)) {
            $m = MMysql::instance($model);
            $field = $m->query("SHOW FULL FIELDS FROM " . $model);
        }

        foreach ($field as $value) {
            $code .= $value['Field'] . ',';
        }
        $code .="\n\n\n";
        foreach ($field as $value) {
            $code .= '$' . $value['Field'] . ',';
        }
        $code = rtrim($code, ',');
        $code .= "\n\n";
        foreach ($field as $value) {
            $code .= '$' . $value['Field'] . '=\'\';';
        }
        $code = rtrim($code, ',');

        $code .="\n\n\n\$array = array();\n";

        foreach ($field as $value) {
            $code .="\$array['" . $value['Field'] . "']=$" . $value['Field'] . ";\n";
        }

        $code .="\n\n\n";
        foreach ($field as $value) {
            $code .="\$_POST['" . $value['Field'] . "']='';\n";
        }

        $code .= "\n\n";
        foreach ($field as $value) {

            $code .="\$data['" . $value['Field'] . "']='';\n";
        }

        echo htmlentities($code, ENT_NOQUOTES, 'utf-8');
    }

    //返回模型信息
    //TODO:解决管理查询问题
    function returnm() {
        $code = '';
        if (isset($_REQUEST["dbtable"]) && isset($_REQUEST["orp"])) {
            $model = trim($_REQUEST["dbtable"]);

            $orp = $_REQUEST["orp"];
            $tname = explode("_", $model);
            if (!empty($model)) {
                $m = MMysql::instance($tname[1]);
                $field = $m->query("SHOW FULL FIELDS FROM " . $model);
            }
            $code .= "'" . $tname[1] . "'=>array(\n\n";
            $code .= "'object'=>'$tname[1]',\n";
            $code .= "'fields'=>array(";
            $fields = '';
            foreach ($field as $value) {
                $fields .= "'{$value['Field']}'=>'{$value['Field']}',";
            }
            $code .= $fields . "),\n";
            $code .= "'method'=>'post',\n";
            $action = ($orp == '1') ? 'add' : 'update';
            $code .= "'api'=>'&res=$tname[1]&method={$action}" . ucwords($tname[1]) . "&type=Logic',\n";
            $code .= "'ajax'=>'1',\n";
            $code .= "'return'=>'json',\n";
            //add form to deal
            $code .= "'next'=>'index/home',\n";
            //输出自动验证信息
            if (isset($field) && count($field)) {
                $code .= "\n'check'=>array(\n";
                foreach ($field as $value) {
                    $f = $value['Field'];
                    if ($_POST["c$f"] == 'validate' || $_POST["c$f"] == 'input') {
                        $code .="	'" . $value['Field'] . "'=>" . "array ('" . $orp . "','require','" . $value['Comment'] . "不能为空'),\n";
                    }
                }
                //设置默认填充的内容
                $itauto = '';
                $code .= "),\n\n'value'=>array(\n   ),\n 'auto'=>array(\n";
                //输出自动完成信息
                foreach ($field as $value) {
                    $f = $value['Field'];
                    if ($_POST["c$f"] == 'auto') {
                        $itauto = $this->itauto($f);
                        $code .= "  '" . $value['Field'] . "'=>'$itauto',\n";
                    }
                }
                $code .= "),\n),\n";
            }
        }
        echo htmlentities($code, ENT_NOQUOTES, 'utf-8');
    }

    //返回表单信息
    function returnr() {
        $model = trim($_REQUEST["dbtable"]);
        $tname = explode("_", $model);
        if (!empty($model)) {
            $m = MMysql::instance($tname[1]);
            $field = $m->query("SHOW FULL FIELDS FROM " . $model);
        }
        //初始化
        $code = '';
        //表单生成，获取表单类型
        $tt = empty($_POST['tt']) ? '' : $_POST['tt'];
        if (!empty($tt)) {
            switch ($tt) {
                case 'list':
                    //需要配置表头和表尾信息
                    if ($_POST['adminc'] == 'on') {
                        $code .= '<div class="leftspace">
					<form id="form1" action="" method="post">
					';
                    } else {
                        $code.='front list';
                    }
                    //输出列表头部信息
                    foreach ($field as $key => $value) {
                        $f = $value['Field'];
                        if ($_POST["c$f"] == 'show') {
                            if ($_POST['adminc']) {
                                $code .= '<th>';
                                $code .=$value['Comment'];
                                $code .= '</th>';
                            } else {
                                $code.='fronts';
                            }
                        }
                    }
                    //输出列表行
                    $code .='列表行头部';
                    foreach ($field as $key => $value) {
                        $f = $value['Field'];
                        if ($_POST["c$f"] == 'show') {
                            if ($_POST['adminc']) {
                                //显示后台
                                $code .= '<td>';
                                $code .='{$vo.' . $value['Field'] . '}';
                                $code .= '</td>';
                            } else {
                                //TODO:显示前台
                                $code .= 'front';
                            }
                        }
                    }
                    if ($_POST['adminc'] == 'on') {
                        $code .= '<td><a href="__URL__/edi_' . $tname[1] . '/id/{$le.id}">编辑</a></td></tr></iterate></table>';
                    }
                    $code .='
					</form>
					</div>';
                    break;

                case 'add':
                    if (isset($_POST['adminc']) && $_POST['adminc'] == 'on') {
                        $code .= '<include file="Public:header" />
<div class="mainarea">
<div class="maininner">
<form id="form1" action="/deal" method="post">
<div class="body_content">
<div class="top_action"><a href="__URL__">返回</a> | <a href="__URL__/do">变更</a></div>
<table cellspacing="0" cellpadding="0" id="maintable" class="formtable">
					';
                    } else {
                        $code .='<form id="form1" action="/deal" method="post">' . "\n <table>\n";
                    }

                    foreach ($field as $key => $value) {
                        $f = $value['Field'];
                        //输出控件类型
                        if (isset($_POST['adminc']) && $_POST['adminc'] == 'on') {
                            if ($_POST["c$f"] == 'input') {
                                $code .='<tr><td>' . $value['Comment'] . '</td><td>    <input name="' . $value['Field'] . '" value="" type="text" datatype="require" require="true"  msg="' . $value['Comment'] . '" /> </td></tr>';
                            } else if ($_POST["c$f"] == 'select') {
                                $code .='<tr><td>' . $value['Comment'] . '</td><td>    <select name="' . $value['Field'] . '"' . ' class="w-100"><option value="0">系统根ID</option><volist name="list" id="svo"><option value="{$svo.id}" >{$svo.fulltitle}</option></volist></select></td></tr>';
                            } else if ($_POST["c$f"] == 'radio') {
                                $code .='<tr><td>' . $value['Comment'] . '</td><td>    <input type="radio" name="' . $value['Field'] . '" value="1" />有 <input type="radio" name="' . $value['Field'] . '" value="2" />无</td></tr>';
                            } else if ($_POST["c$f"] == 'textarea') {
                                $code .='<tr><td>' . $value['Comment'] . '</td><td>   <textarea id="' . $value['Field'] . '" rows="10" cols="40" name="' . $value['Field'] . '"></textarea></td></tr>';
                            }
                        } else {
                            //TODO: show front
                            if ($_POST["c$f"] == 'input') {
                                $code .='<span>' . $value['Comment'] . '</span>    <input name="' . $value['Field'] . '" value="" type="text" datatype="require" require="true"  msg="' . $value['Comment'] . '" /> <br />' . "\n";
                            } else if ($_POST["c$f"] == 'select') {
                                $code .='<span>' . $value['Comment'] . '</span>    <select name="' . $value['Field'] . '"' . '><option value="test">test</option>' . '</select>' . "\n";
                            } else if ($_POST["c$f"] == 'radio') {
                                $code .='<span>' . $value['Comment'] . '</span>    <input type="radio" name="' . $value['Field'] . '" value="1" />有 <input type="radio" name="' . $value['Field'] . '" value="2" />无' . "\n";
                            } else if ($_POST["c$f"] == 'textarea') {
                                $code .='<span>' . $value['Comment'] . '</span>    <textarea id="' . $value['Field'] . '" rows="10" cols="40" name="' . $value['Field'] . '"></textarea>' . "\n";
                            }
                        }
                    }
                    if (isset($_POST['adminc']) && $_POST['adminc'] == 'on') {
                        $code .= '
						</tbody>
					</table>
	</div>
	<div class="foot_action">
		<input type="hidden" name="actmodel" value="' . $tname[1] . '" />
		<input type="submit" name="submit" value="提交录入" class="submit">
        <input type="reset" name="button" id="button" value="还原重填" class="submit"/>
	</div>
	</form>
</div>
</div>

<div class="side">
<include file="Public:sider" />
</div>
<include file="Public:footer" />';
                    } else {

                        //do add form
                        $code .="<input type='hidden' name='form' value='$tname[1]'>\n</table>\n</form>";
                    }

                    break;
                case 'edit':
                    if (isset($_POST['adminc']) && $_POST['adminc'] == 'on') {
                        $code .= '
<include file="Public:header" />
<div class="mainarea">
<div class="maininner">
	<div class="body_content">
		<div class="top_action"><a href="__URL__">返回</a> | <a href="__URL__/do">变更</a></div>
		<form id="form1" action="__URL__/deal" method="post">		   
		<table cellspacing="0" cellpadding="0" id="maintable" class="formtable">
					';

                        foreach ($field as $key => $value) {

                            $f = $value['Field'];
                            if ($_POST['adminc'] == 'on') {
                                if ($_POST["c$f"] == 'input') {
                                    if ($value['Field'] == 'id') {
                                        $code .='<tr><td>' . $value['Comment'] . '</td><td>    <input name="' . $value['Field'] . '" value="{$vo.' . $value['Field'] . '}" readonly type="text"  /> </td></tr>';
                                    } else {
                                        $code .='<tr><th style="width:12em;">' . $value['Comment'] . '</th><td>    <input name="' . $value['Field'] . '" value="{$vo.' . $value['Field'] . '}" type="text"  /> </td></tr>';
                                    }
                                } else if ($_POST["c$f"] == 'select') {
                                    $code .='<tr><td>' . $value['Comment'] . '</td> <td>   <select name="' . $value['Field'] . '"' . ' class="w-100"><option value="0">系统根ID</option><volist name="list" id="svo"><option value="{$svo.id}"  <eq name="svo.id" value="$vo[\'parentid\']"> selected </eq> >{$svo.title}</option></volist></select></td></tr>';
                                } else if ($_POST["c$f"] == 'radio') {
                                    $code .='<tr><td>' . $value['Comment'] . '</td> <td>  <input type="radio" name="' . $value['Field'] . '" value="1" />有 <input type="radio" name="' . $value['Field'] . '" value="2" />无';
                                } else if ($_POST["c$f"] == 'textarea') {
                                    $code .='<tr><td>' . $value['Comment'] . '</td> <td>    <textarea id="' . $value['Field'] . '" rows="8" cols="70" name="' . $value['Field'] . '">{$vo.' . $value['Field'] . '}</textarea></td></tr>';
                                }
                            }
                        }

                        $code .= '
						</tbody>
					</table>
	</div>
	<div class="foot_action">
		<input type="hidden" name="actm" value="' . $tname[1] . '" />
		<input type="hidden" name="id" value="{$vo.id}"/>
		<input type="submit" name="submit" value="提交录入" class="submit">
        <input type="reset" name="button" id="button" value="还原重填" class="submit"/>
	</div>
	</form>
</div>
</div>

<div class="side">
<include file="Public:sider" />
</div>
<include file="Public:footer" />';
                    } else {
                        $code = '<form id="form1" action="/input/deal" method="post" enctype="multipart/form-data">		   
<table style="clear:both;width:100%">
<tbody>';

                        foreach ($field as $key => $value) {

                            $f = $value['Field'];

                            if ($_POST["c$f"] == 'input') {
                                if ($value['Field'] == 'id') {
                                    $code .='<tr><td>' . $value['Comment'] . '</td><td>   "{$page.data.' . $value['Field'] . '}"</td></tr>';
                                } else {
                                    $code .='<tr><td>' . $value['Comment'] . '</td><td>    <input size="40" name="' . $value['Field'] . '" value="{$page.data.' . $value['Field'] . '}" type="text" datatype="require" require="true"  msg="' . $value['Comment'] . '"  /> </td></tr>';
                                }
                            } else if ($_POST["c$f"] == 'select') {
                                $code .='<tr><td>' . $value['Comment'] . '</td> <td>   <select name="' . $value['Field'] . '"' . ' class="w-100"><volist name="list" id="svo"><option value="{$svo.id}"  <eq name="svo.id" value="$page.data[\'parentid\']"> selected </eq> >{$svo.title}</option></volist></select></td></tr>';
                            } else if ($_POST["c$f"] == 'radio') {
                                $code .='<tr><td>' . $value['Comment'] . '</td> <td> {$page.data.' . $value['Field'] . '} </td></tr>';
                            } else if ($_POST["c$f"] == 'textarea') {
                                $code .='<tr><td>' . $value['Comment'] . '</td> <td>    <textarea id="' . $value['Field'] . '" rows="8" cols="70" name="' . $value['Field'] . '">{$page.data.' . $value['Field'] . '}</textarea></td></tr>';
                            }
                            $code .='
							';
                        }

                        $code .= '
						<tr>
						<td><input type="hidden" name="form" value="xxxx" id="form"/><input type="hidden" name="id" value="{$page.data.id}" id="id"/></td>
						<td>
						
		<input type="submit" name="submit" value="提交" class="btn-submit">
        </td>
						</tr>
						</tbody>
</table>
</form>';
                    }
            }
        }
        echo htmlentities($code, ENT_NOQUOTES, 'utf-8');
    }

    public function index() {
        $model = '';
        $field = '';
        //获取默认生成代码类型
        $acname = ''; // Cookie::get('gnaction');
        //获取数据库表
        if (!empty($_REQUEST["mn"])) {
            $model = trim($_REQUEST["mn"]);
        }

        if (!empty($model)) {
            $m = MMysql::instance(DEFAULTTABLE);
            ;
            $field = $m->query("SHOW FULL FIELDS FROM " . $model);
        }
        $this->assign('dbname', $model);
        $this->assign('var', $field);

        $this->display();
    }

    /**
     * 自动填充相应的函数
     */
    public function itauto($field) {
        $r = '';
        switch ($field) {
            case 'id':
                $r = 'objid';
                break;
            case 'createtime':
                $r = 'time';
                break;
            case 'services_id':
                $r = 'ServicesID';
                break;
            case 'user_id':
                $r = 'userid';
                break;
            case 'ip':
            case 'registerip':
                $r = 'getip';
                break;
            case 'status':
                $r = 'getstatus';
                break;
        }
        return $r;
    }

}