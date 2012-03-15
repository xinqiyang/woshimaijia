package cn.edu.fzxy.zxy.niceday.utils;

/*
 * Copyright 2011 meiyitian
 * Blog  :http://www.cnblogs.com/meiyitian
 * Email :haoqqemail@qq.com
 * Client for 我是买家Project ：http://code.google.com/p/woshimaijia/
 * Client for 我是买家Website ：http://woshimaijia.com/
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * 
 *    http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
*/
import android.util.Log;
/**
 * 
 * @author meiyitian
 *
 */
public class Debug {
	public static boolean DEBUG = false;
	public static boolean isOnLine = true;
	
	public static void debug(String msg) {
		if (DEBUG) {
			Log.d("woshimaijia", msg);
		}
	}
	
	public static void trace(String msg) {
		if (DEBUG) {
			Log.v("woshimaijia", msg);
		}
	}
	
	public static void warn(String msg) {
		if (DEBUG) {
			Log.w("woshimaijia", "Warning: " + msg);
		}
	}
	
	public static void error(String msg) {
		if (DEBUG) {
			Log.e("woshimaijia", msg);
		}
	}
	
	public static void info(String msg) {
		if (DEBUG) {
			Log.i("woshimaijia", msg);
		}
	}
}
