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

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.ViewGroup.LayoutParams;
import android.widget.Button;
import android.widget.LinearLayout;
/**
 * 
 * @author meiyitian
 *
 */
public class Test extends Activity {
	
	/* (non-Javadoc)
	 * @see android.app.Activity#onCreate(android.os.Bundle)
	 */
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		
		LinearLayout root = new LinearLayout(this);
		root.setOrientation(LinearLayout.VERTICAL);
		LinearLayout.LayoutParams rootparams = new LinearLayout.LayoutParams(-1,-1);
		LinearLayout.LayoutParams childparams = new LinearLayout.LayoutParams(-1,-2);
		root.setLayoutParams(rootparams);
		
		Button btnSimple = new Button(this);
		btnSimple.setText("简单测试");
		btnSimple.setOnClickListener(new OnClickListener(){

			@Override
			public void onClick(View v) {
				 Intent inent = new Intent();
				 inent.setClass(Test.this, SimpleExampleActivity.class);
				 Test.this.startActivity(inent);
				
			}
		});
		btnSimple.setLayoutParams(childparams);
		root.addView(btnSimple);
		
		
		Button btnHttpGet = new Button(this);
		btnHttpGet.setText("测试HttpGet");
		btnHttpGet.setOnClickListener(new OnClickListener(){

			@Override
			public void onClick(View v) {
				 Intent inent = new Intent();
				 inent.setClass(Test.this, HttpGetExample.class);
				 Test.this.startActivity(inent);
				
			}
		});
		btnHttpGet.setLayoutParams(childparams);
		root.addView(btnHttpGet);
		
		
		
		Button btnPost = new Button(this);
		btnPost.setText("测试HttpPost");
		btnPost.setOnClickListener(new OnClickListener(){

			@Override
			public void onClick(View v) {
				 Intent inent = new Intent();
				 inent.setClass(Test.this, HttpPostExample.class);
				 Test.this.startActivity(inent);
				
			}
		});
		btnPost.setLayoutParams(childparams);
		root.addView(btnPost);
		
		
		this.setContentView(root);
		
	}
}

