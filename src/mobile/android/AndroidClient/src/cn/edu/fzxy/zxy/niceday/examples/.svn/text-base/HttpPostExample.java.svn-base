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
package cn.edu.fzxy.zxy.niceday.examples;

import java.util.ArrayList;
import java.util.List;

import android.os.Bundle;
import android.util.Log;
import cn.edu.fzxy.zxy.niceday.AsyncHttpPost;
import cn.edu.fzxy.zxy.niceday.DefaultThreadPool;
import cn.edu.fzxy.zxy.niceday.RequestResultCallback;
import cn.edu.fzxy.zxy.niceday.exception.RequestException;
import cn.edu.fzxy.zxy.niceday.utils.RequestParameter;
/**
 * 
 * @author meiyitian
 *
 */
public class HttpPostExample extends BaseActivity{

	/* (non-Javadoc)
	 * @see cn.edu.fzxy.zxy.netlib.examples.BaseActivity#onCreate(android.os.Bundle)
	 */
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		testHttpPost();
	}
	
	
	private void testHttpPost(){
		List<RequestParameter> parameterList = new ArrayList<RequestParameter>();
		parameterList.add(new RequestParameter("bs","meiyitian"));
		parameterList.add(new RequestParameter("wd","给力编程"));
		AsyncHttpPost httpost = new AsyncHttpPost(null,"http://www.baidu.com",parameterList,
				new RequestResultCallback(){

					@Override
					public void onSuccess(Object o) {
						Log.i("HttpPostExample", "HttpPostExample  request  onSuccess result :"+((String)o).toString());
					}
					
					@Override
					public void onFail(Exception e) {
						Log.i("HttpPostExample", "HttpPostExample  request   onFail :"+((RequestException)e).getMessage());
					}
			
		});
		
		DefaultThreadPool.getInstance().execute(httpost);
	 
		this.requestList.add(httpost);
	}
}

