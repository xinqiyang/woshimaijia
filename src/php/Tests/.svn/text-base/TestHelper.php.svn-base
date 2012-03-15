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

/**
 * get all files of the dir
 * Enter description here ...
 * @param unknown_type $dir
 */
function getAllFiles($dir)
 {  
    $files=array();  
    if(is_file($dir))  
     {  
         return $dir;  
    }  
     $handle = opendir($dir);  
     if($handle) {  
         while(false !== ($file = readdir($handle))) {  
            if ($file != '.' && $file != '..') {  
                 $filename = $dir . "/"  . $file;  
                 if(is_file($filename)) {
                     $files[$file] = $filename;  
                }else {
                    $files = array_merge($files, allfile($filename));  
                 }  
             }  
         }   //  end while  
         closedir($handle);  
     }
    return $files;
 }  