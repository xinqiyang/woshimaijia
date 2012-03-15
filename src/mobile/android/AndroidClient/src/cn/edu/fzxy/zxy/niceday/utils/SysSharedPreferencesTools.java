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
import android.content.Context;
/**
 * 配置信息工具类
 * @author meiyitian
 *
 */
public class SysSharedPreferencesTools {
	static SysSharedPreferencesTools instance = null;
	public SysSharedPreferencesTools(){
		
	}
	
	public static  SysSharedPreferencesTools getInstance(){
		if(instance == null){
			return new SysSharedPreferencesTools();
		}
		return new SysSharedPreferencesTools();
	}
	
	public void putBoolean(String fileName,String key,boolean value,Context context){
		 context.getSharedPreferences(fileName, Context.MODE_PRIVATE).edit().putBoolean(key, value).commit();
	}
	
	public boolean getBoolean(String fileName,String key,Context context){
		return context.getSharedPreferences(fileName, Context.MODE_PRIVATE).getBoolean(key, false);
	}
	
	public void putString(String fileName,String key,String value,Context context){
		 context.getSharedPreferences(fileName, Context.MODE_PRIVATE).edit().putString(key, value).commit();
	}
	
	public String getString(String fileName,String key,Context context){
		return context.getSharedPreferences(fileName, Context.MODE_PRIVATE).getString(key, "");
	}
	
	
	public void putInt(String fileName,String key,int value,Context context){
		 context.getSharedPreferences(fileName, Context.MODE_PRIVATE).edit().putInt(key, value).commit();
	}
	
	public int getInt(String fileName,String key,Context context){
		return context.getSharedPreferences(fileName, Context.MODE_PRIVATE).getInt(key,-1);
	}
	
	/**
	 *  清除
	 * @param flieName
	 * @param context
	 */
	public void clear(String flieName,Context context){
		context.getSharedPreferences(flieName,Context.MODE_PRIVATE).edit().clear().commit();
	}
	
	/**
	 * 移除
	 * @param fileName
	 * @param context
	 * @param key
	 */
	public  void remove(String fileName,Context context,String key){
		context.getSharedPreferences(fileName, Context.MODE_PRIVATE).edit().remove(key).commit();
	}
}
