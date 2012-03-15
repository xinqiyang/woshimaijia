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

import java.util.ArrayList;
import java.util.HashMap;

import android.content.Context;
import android.os.Bundle;
import android.os.Handler;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ListView;
import android.widget.RelativeLayout;
import android.widget.TextView;
import cn.edu.fzxy.zxy.netlib.examples.R;
import cn.edu.fzxy.zxy.niceday.AsyncHttpGet;
import cn.edu.fzxy.zxy.niceday.DefaultThreadPool;
import cn.edu.fzxy.zxy.niceday.RequestResultCallback;
/**
 * 
 * @author meiyitian
 *
 */
public class SimpleExampleActivity extends BaseActivity {
	AsyncHttpGet httpget1 = null;
	ListView list = null;
	 ArrayList<HashMap<String, Integer>> listData = null;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.main);
		list = (ListView)findViewById(R.id.list);
		/**
		 * 开始请求网络  http://files.cnblogs.com/meiyitianabc/netlib.css
		 */
		httpget1 = new AsyncHttpGet(new DefaultParseHandler(), "http://files.cnblogs.com/meiyitian/netlib.css", 
				null,
				new RequestResultCallback(){
			
			@SuppressWarnings("unchecked")
			@Override
			public void onSuccess(Object o) {
				try{
				   SimpleExampleActivity.this.listData = (ArrayList<HashMap<String, Integer>>)o;  
				   SimpleExampleActivity.this.mHandler.sendEmptyMessage(0);
				   Log.d(SimpleExampleActivity.class.getName(), "MainActivity  onSuccess");
				}catch(Exception e){
					Log.d(SimpleExampleActivity.class.getName(), "MainActivity   onSuccess Exception ,"+e.getMessage());
					e.printStackTrace();
				}
			}
			@Override
			public void onFail(Exception e) {
				// TODO Auto-generated method stub
				
			}
		});
		Log.i(SimpleExampleActivity.class.getName(), "MainActivity");
		DefaultThreadPool.getInstance().execute(httpget1);
		this.requestList.add(httpget1);
	}
	
 
	private class ListAdapter extends BaseAdapter{

		/* (non-Javadoc)
		 * @see android.widget.Adapter#getCount()
		 */
		@Override
		public int getCount() {
			 
			return listData.size();
		}

		/* (non-Javadoc)
		 * @see android.widget.Adapter#getItem(int)
		 */
		@Override
		public Object getItem(int position) {
			
			return listData.get(position);
		}

		/* (non-Javadoc)
		 * @see android.widget.Adapter#getItemId(int)
		 */
		@Override
		public long getItemId(int position) {
			// TODO Auto-generated method stub
			return position;
		}

		/* (non-Javadoc)
		 * @see android.widget.Adapter#getView(int, android.view.View, android.view.ViewGroup)
		 */
		@Override
		public View getView(int position, View convertView, ViewGroup parent) {
		    TextView tvName = new TextView(SimpleExampleActivity.this);
			tvName.setText("code : "+listData.get(position).get("code"));
			return tvName;
		}
	}
	
	private Handler mHandler = new Handler(){
		public void handleMessage(android.os.Message msg) {
			switch(msg.what){
			case 0:
				list.setAdapter(new ListAdapter());
			}
		};
	};
}
