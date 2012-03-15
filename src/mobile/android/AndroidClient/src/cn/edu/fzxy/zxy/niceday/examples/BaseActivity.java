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

import android.app.Activity;
import android.os.Bundle;
import android.util.Log;
import cn.edu.fzxy.zxy.niceday.BaseRequest;
/**
 * 
 * @author meiyitian
 *
 */
public class BaseActivity extends Activity {

	/**
	 * 当前activity所持有的所有请求
	 */
	List<BaseRequest> requestList = null;

	/*
	 * (non-Javadoc)
	 * 
	 * @see android.app.Activity#onCreate(android.os.Bundle)
	 */
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		requestList = new ArrayList<BaseRequest>();
		super.onCreate(savedInstanceState);
	}

	/*
	 * (non-Javadoc)
	 * 
	 * @see android.app.Activity#onPause()
	 */
	@Override
	protected void onPause() {
		/**
		 * 在activity销毁的时候同时设置停止请求，停止线程请求回调
		 */
		cancelRequest();
		super.onPause();
	}

	/*
	 * (non-Javadoc)
	 * 
	 * @see android.app.Activity#onDestroy()
	 */
	@Override
	protected void onDestroy() {
		/**
		 * 在activity销毁的时候同时设置停止请求，停止线程请求回调
		 */
		cancelRequest();
		super.onDestroy();
	}

	private void cancelRequest() {
		if (requestList != null && requestList.size() > 0) {
			for (BaseRequest request : requestList) {
				if (request.getRequest() != null) {
					try {
						request.getRequest().abort();
						requestList.remove(request.getRequest());
						Log.d("netlib", "netlib ,onDestroy request to  "
								+ request.getRequest().getURI()
								+ "  is removed");
					} catch (UnsupportedOperationException e) {
						//do nothing .
					}
				}
			}
		}
	}
}
