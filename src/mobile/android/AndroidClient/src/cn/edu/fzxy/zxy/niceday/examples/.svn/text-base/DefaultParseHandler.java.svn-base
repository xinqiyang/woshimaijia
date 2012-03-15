package cn.edu.fzxy.zxy.niceday.examples;

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
/**
 * 
 * @author meiyitian
 *
 */
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;

import org.json.JSONArray;
import org.json.JSONObject;

import android.util.Log;

import cn.edu.fzxy.zxy.niceday.AsyncHttpGet;
import cn.edu.fzxy.zxy.niceday.ParseHandler;

public class DefaultParseHandler implements ParseHandler{

	@Override
	public Object handle(String str) {
		ArrayList<HashMap<String, Integer>> list = null;
		/*
		 *  here  we just  parse a json object .
		 */
		try{
			HashMap<String, Integer> m = null;
			JSONObject o = new JSONObject(str);
			Log.d(DefaultParseHandler.class.getName(), "DefaultParseHandler  handler string  :"+str+" !");
			if(o !=null){
				list = new ArrayList<HashMap<String,Integer>>();
				JSONArray  array = o.getJSONArray("items");
				int count = array.length();
				for(int i =0;i< count;i++){
					JSONObject item = array.getJSONObject(i);
					if(item!=null){
						m = new HashMap<String,Integer>();
						m.put("code", item.has("code")?item.getInt("code"):0);
						list.add(m);
					}
				}
			}
		}catch(Exception e){
			e.printStackTrace();
		}
		return list;
	}

}
