<?php
/**
 * Caculate files  class
 *
 * @author xiaoxiao <x_824@sina.com> 2011-1-12
 * @link http://xiaoyaoxia.cnblogs.com/
 * 
 */
/*
 * do the demo use for the class
$arr = array(
    "/home/xinqiyang/wwwroot/web/dataaccess",
    "/home/xinqiyang/wwwroot/web/logic",
    "/home/xinqiyang/wwwroot/web/config",
    "/home/xinqiyang/wwwroot/web/components",
    "/home/xinqiyang/wwwroot/web/web/protected/controllers",
    "/home/xinqiyang/wwwroot/web/web/protected/dataaccess",
    "/home/xinqiyang/wwwroot/web/wap/protected/dataaccess",
);

$document = "/home/xinqiyang/wwwroot/web/dataaccess";
$obj = new CaculateFiles();

$obj->setShowFlag(false);

$obj->setFileSkip(array('All'));
foreach($arr as $one)
{
    if(is_dir($one))
    {
        $obj->run($one);
    }
}


$obj->setFileSkip(array());
$obj->run("D:\PHPAPP\php");

$obj->setShowFlag(true);

$obj->setFileSkip(array('I', 'A'));
$obj->run("D:\PHPAPP\php");
*/

/**
 * caculate files in dir
 *
 * 1.sikp file
 * match filename in the roles sets,match role in the header
 * 2.skip commonents line
 * match role from the header of line when // * and /* is in the head.
 * 3.documents filter
 *  documents filter from the document name
 */
class CaculateFiles {

    /**
     * file extension
     */
    private $ext = ".php";
    /**
     * show every file path lable
     */
    private $showEveryFile = true;
    /**
     * file skip roles set
     */
    private $fileSkip = array();
    /**
     * stat skip line roles set
     */
    private $lineSkip = array("*", "/*", "//", "#");
    /**
     * stat skip roles set
     */
    private $dirSkip = array(".", "..", '.svn');

    public function __construct($ext = '', $dir = '', $showEveryFile = true, $dirSkip = array(), $lineSkip = array(), $fileSkip = array()) {
        $this->setExt($ext);
        $this->setDirSkip($dirSkip);
        $this->setFileSkip($fileSkip);
        $this->setLineSkip($lineSkip);
        $this->setShowFlag($showEveryFile);
        $this->run($dir);
    }

    public function setExt($ext) {
        trim($ext) && $this->ext = strtolower(trim($ext));
    }

    public function setShowFlag($flag = true) {
        $this->showEveryFile = $flag;
    }

    public function setDirSkip($dirSkip) {
        $dirSkip && is_array($dirSkip) && $this->dirSkip = $dirSkip;
    }

    public function setFileSkip($fileSkip) {
        $this->fileSkip = $fileSkip;
    }

    public function setLineSkip($lineSkip) {
        $lineSkip && is_array($lineSkip) && $this->lineSkip = array_merge($this->lineSkip, $lineSkip);
    }

    /**
     * do stat action
     * @param string $dir stat dir
     */
    public function run($dir = '') {
        if ($dir == '')
            return;
        if (!is_dir($dir))
            exit('Path error!');
        $this->dump($dir, $this->readDir($dir));
    }

    /**
     * show result
     * @param string $dir dir
     * @param array $result stat result (include totalline,availide line and total files)
     */
    private function dump($dir, $result) {
        $totalLine = $result['totalLine'];
        $lineNum = $result['lineNum'];
        $fileNum = $result['fileNum'];
        echo "*************************************************************\r\n<br/>";
        echo $dir . ":\r\n<br/>";
        echo "TotalLine: " . $totalLine . "\r\n<br/>";
        echo "TotalLine with no comment and empty: " . $lineNum . "\r\n<br/>";
        echo 'TotalFiles:' . $fileNum . "\r\n<br/>";
    }

    /**
     * load dir files
     * @param string $dir dir path
     */
    private function readDir($dir) {
        $num = array('totalLine' => 0, 'lineNum' => 0, 'fileNum' => 0);
        if ($dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {
                if ($this->skipDir($file))
                    continue;
                if (is_dir($dir . '/' . $file)) {
                    $result = $this->readDir($dir . '/' . $file);
                    $num['totalLine'] += $result['totalLine'];
                    $num['lineNum'] += $result['lineNum'];
                    $num['fileNum'] += $result['fileNum'];
                } else {
                    if ($this->skipFile($file))
                        continue;
                    list($num1, $num2) = $this->readfiles($dir . '/' . $file);
                    $num['totalLine'] += $num1;
                    $num['lineNum'] += $num2;
                    $num['fileNum']++;
                }
            }
            closedir($dh);
        } else {
            echo 'open dir <' . $dir . '> error!' . "\r";
        }
        return $num;
    }

    /**
     * read file
     * @param string $file filepath
     */
    private function readfiles($file) {
        $str = file($file);
        $linenum = 0;
        foreach ($str as $value) {
            if ($this->skipLine(trim($value)))
                continue;
            $linenum++;
        }
        //count file
        $totalnum = count(file($file));
        if (!$this->showEveryFile)
            return array($totalnum, $linenum);
        echo $file . "\r\n";
        echo 'TotalLine in the file:' . $totalnum . "\r\n";
        echo 'TotalLine with no comment and empty in the file:' . $linenum . "\r\n";
        return array($totalnum, $linenum);
    }

    /**
     * do skipDir roles
     * @param string $dir documentname
     */
    private function skipDir($dir) {
        if (in_array($dir, $this->dirSkip))
            return true;
        return false;
    }

    /**
     * do skipFile roles
     * @param string $file filename
     */
    private function skipFile($file) {
        if (strtolower(strrchr($file, '.')) != $this->ext)
            return true;
        if (!$this->fileSkip)
            return false;
        foreach ($this->fileSkip as $skip) {
            if (strpos($file, $skip) === 0)
                return true;
        }
        return false;
    }

    /**
     * do skipLine roles in file
     * @param string $string line content
     */
    private function skipLine($string) {
        if ($string == '')
            return true;
        foreach ($this->lineSkip as $tag) {
            if (strpos($string, $tag) === 0)
                return true;
        }
        return false;
    }

}
