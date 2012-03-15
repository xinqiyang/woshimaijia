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

/**
 * 
 * @author meiyitian
 *
 */
public class RequestParameter  implements java.io.Serializable, Comparable {

	private static final long serialVersionUID = 1274906854152052510L;

	private String name;
	public String getName() {
		return name;
	}

	public void setName(String name) {
		this.name = name;
	}

	public String getValue() {
		return value;
	}

	public void setValue(String value) {
		this.value = value;
	}

	private String value;
	
	public RequestParameter(String name,String value){
		this.name = name;
		this.value = value;
	}
	
	@Override
	public boolean equals(Object o) {
		if(null == o){
			return false;
		}
		
		if(this == o){
			return true;
		}
		
		if(o instanceof  RequestParameter){
			RequestParameter parameter = (RequestParameter)o;
			return name.equals(parameter.name)&&value.equals(parameter.value);
		}
		
		return false;
	}
	
	@Override
	public int compareTo(Object another) {
		int compared;
		/**
		 * 值比较
		 */
		RequestParameter parameter = (RequestParameter)another;
		compared = name.compareTo(parameter.name);
		if(compared == 0){
			compared = value.compareTo(parameter.value);
		}
		return compared;
	}
}
