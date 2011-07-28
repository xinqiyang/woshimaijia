<?php
/**
 * DEMO:
 * $res = TEncrypt::encryptInt(100);
 TEncrypt::decryptInt($res,&$out);
 echo $out; //解密出来100
  
 * @author liubaikui
 *
 */
class TEncrypt
{
	private static $key = '6sEnegAL96986bArGe6?378#1eRv18evolve0monaSteRy9EmbelLIsHriCardO6';
	
	/**
	 * 加密方法(把两个整数加密成一个字符串)
	 * @param $int_1
	 * @param $int_2
	 * @return unknown_type
	 */
	public static function encryptKey($int_1,$int_2)
	{
		if(is_numeric($int_1) && is_numeric($int_2))
		{
			$ObjCFcrypt = new CFcryptUtil('talking');
			//数字加密串
            return $ObjCFcrypt -> getEncodeStrByPicId($int_1,$int_2);
		}
		return false;
	}
	/**
	 * 解密出来第一个整数
	 * @param $str
	 * @return unknown_type
	 */
	public static function decryptKey($str)
	{
		$out = false;
		$ObjCFcrypt = new CFcryptUtil('talking');
		//数字加密串
        $ObjCFcrypt -> getPicIdByEncodeStr($str,& $out);
        return $out;
	}
	/**
	 * 加密数字
	 * @param int $int
	 * @return string
	 */
	public static function encryptInt($int)
	{
		if(is_numeric($int))
		{
				
			$ObjCFcrypt = new CFcryptUtil('talking');
			//数字加密串
            return $ObjCFcrypt -> getEncodeStrById($int);
		}
		return false;

	}
	/**
	 * 将加密串转变成数字
	 * @param string $str 加密的字符串
	 * @param int &$out 结果数字
	 */
	public static function decryptInt($str)
	{
		$out = 0;
		$ObjCFcrypt = new CFcryptUtil('talking');
		//$des 为解密出来的数字
		$ObjCFcrypt -> getIdByEncodeStr($str,&$out);
		return $out;
	}
	
	
	/**
	 * Passport 加密函数
	 *
	 * @param                string                等待加密的原字串
	 * @param                string                私有密匙(用于解密和加密)
	 *
	 * @return        string                原字串经过私有密匙加密后的结果
	 */
	public static function encrypt($txt)
	{
		// 使用随机数发生器产生 0~32000 的值并 MD5()
		//srand((double)microtime() * 1000000);
		//$encrypt_key = md5(rand(0, 32000));
		$encrypt_key = md5(self::$key);
		// 变量初始化
		$ctr = 0;
		$tmp = '';
		// for 循环，$i 为从 0 开始，到小于 $txt 字串长度的整数
		for($i = 0; $i < strlen($txt); $i++)
		{
			// 如果 $ctr = $encrypt_key 的长度，则 $ctr 清零
			$ctr = $ctr == strlen($encrypt_key) ? 0 : $ctr;
			// $tmp 字串在末尾增加两位，其第一位内容为 $encrypt_key 的第 $ctr 位，
			// 第二位内容为 $txt 的第 $i 位与 $encrypt_key 的 $ctr 位取异或。然后 $ctr = $ctr + 1
			$tmp .= $encrypt_key[$ctr].($txt[$i] ^ $encrypt_key[$ctr++]);
		}
		// 返回结果，结果为 passport_key() 函数返回值的 base64 编码结果
		return base64_encode(self::passport_key($tmp, self::$key));
	}

	/**
	 * Passport 解密函数
	 *
	 * @param                string                加密后的字串
	 * @param                string                私有密匙(用于解密和加密)
	 *
	 * @return        string                字串经过私有密匙解密后的结果
	 */
	public static function decrypt($txt)
	{
		// $txt 的结果为加密后的字串经过 base64 解码，然后与私有密匙一起，
		// 经过 passport_key() 函数处理后的返回值
		$txt = self::passport_key(base64_decode($txt), self::$key);
		// 变量初始化
		//var_dump($txt);
		$tmp = '';
		// for 循环，$i 为从 0 开始，到小于 $txt 字串长度的整数
		for ($i = 0; $i < strlen($txt); $i++)
		{
			// $tmp 字串在末尾增加一位，其内容为 $txt 的第 $i 位，
			// 与 $txt 的第 $i + 1 位取异或。然后 $i = $i + 1
			//var_dump(++$i);
			//var_dump(strlen($txt));
			/*if (++$i>strlen($txt))
			{
				return false;
			}*/
			$tmp .= $txt[$i] ^ $txt[++$i];
		}
		// 返回 $tmp 的值作为结果
		return $tmp;
	}

	/**
	 * Passport 密匙处理函数
	 *
	 * @param                string                待加密或待解密的字串
	 * @param                string                私有密匙(用于解密和加密)
	 *
	 * @return        string                处理后的密匙
	 */
	public static function passport_key($txt, $encrypt_key)
	{
		// 将 $encrypt_key 赋为 $encrypt_key 经 md5() 后的值
		$encrypt_key = md5($encrypt_key);
		// 变量初始化
		$ctr = 0;
		$tmp = '';
		// for 循环，$i 为从 0 开始，到小于 $txt 字串长度的整数
		for($i = 0; $i < strlen($txt); $i++)
		{
			// 如果 $ctr = $encrypt_key 的长度，则 $ctr 清零
			$ctr = $ctr == strlen($encrypt_key) ? 0 : $ctr;
			// $tmp 字串在末尾增加一位，其内容为 $txt 的第 $i 位，
			// 与 $encrypt_key 的第 $ctr + 1 位取异或。然后 $ctr = $ctr + 1
			$tmp .= $txt[$i] ^ $encrypt_key[$ctr++];
		}
		// 返回 $tmp 的值作为结果
		return $tmp;
	}
}
