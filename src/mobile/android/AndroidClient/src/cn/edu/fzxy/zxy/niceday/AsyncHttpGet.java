
/*
 * Copyright 2011 meiyitian
 * Blog  :http://www.cnblogs.com/meiyitian
 * Email :haoqqemail@qq.com
 * Client for http://code.google.com/p/woshimaijia/
 * Client for http://woshimaijia.com/
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

package cn.edu.fzxy.zxy.niceday;

import java.io.ByteArrayOutputStream;
import java.io.IOException;
import java.io.UnsupportedEncodingException;
import java.util.List;

import org.apache.http.HttpResponse;
import org.apache.http.HttpStatus;
import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.impl.client.DefaultHttpClient;

import android.util.Log;
import cn.edu.fzxy.zxy.niceday.exception.RequestException;
import cn.edu.fzxy.zxy.niceday.utils.RequestParameter;
import cn.edu.fzxy.zxy.niceday.utils.Utils;

/**
 *
 * 
 * @author meiyitian
 *
 */
public class AsyncHttpGet extends BaseRequest{
	private static final long serialVersionUID = 2L;
	DefaultHttpClient httpClient;
	List<RequestParameter> parameter;

	public AsyncHttpGet(ParseHandler handler,String url,List<RequestParameter> parameter,RequestResultCallback requestCallback){
		this.handler = handler;
		this.url = url;
		this.parameter = parameter;
		this.requestCallback = requestCallback;

		if(httpClient == null)
			httpClient = new DefaultHttpClient();
	}

	@Override
	public void run() {
		try{
			if(parameter!=null&&parameter.size()>0){
				StringBuilder bulider  = new StringBuilder();
				for(RequestParameter p:parameter){
					if(bulider.length()!=0){
						bulider.append("&");
					}

					bulider.append(Utils.encode(p.getName()));
					bulider.append("=");
					bulider.append(Utils.encode(p.getValue()));
				} 
				url += "?"+bulider.toString();
			}
			Log.d(AsyncHttpGet.class.getName(),
					"AsyncHttpGet  request to url :" + url);
			request = new HttpGet(url);
			HttpResponse response = httpClient.execute(request);
			int statusCode = response.getStatusLine().getStatusCode();
			if (statusCode == HttpStatus.SC_OK) {
				ByteArrayOutputStream content = new ByteArrayOutputStream();
				response.getEntity().writeTo(content);
				String ret = new String(content.toByteArray()).trim();
				content.close();
				Object Object = null;
				if(AsyncHttpGet.this.handler !=null){
					Object = AsyncHttpGet.this.handler.handle(ret);
					if( AsyncHttpGet.this.requestCallback != null&&Object !=null){
						AsyncHttpGet.this.requestCallback.onSuccess(Object);
						return ;
					}
					if(Object == null||"".equals(Object.toString())){
						RequestException exception = new RequestException(RequestException.IO_EXCEPTION,"Exception Return Emtpy,Please check!");
						AsyncHttpGet.this.requestCallback.onFail(exception);
					}
				}else{
					AsyncHttpGet.this.requestCallback.onSuccess(ret);
				}
			}else{
				RequestException exception = new RequestException(RequestException.IO_EXCEPTION,"Exception");
				AsyncHttpGet.this.requestCallback.onFail(exception);
			}
			Log.d(AsyncHttpGet.class.getName(), "AsyncHttpGet  request to url :"+url+"  finished !");
		}catch(java.lang.IllegalArgumentException e){
			RequestException exception = new RequestException(
					RequestException.IO_EXCEPTION, "Exception");
			AsyncHttpGet.this.requestCallback.onFail(exception);
			Log.d(AsyncHttpGet.class.getName(),
					"AsyncHttpGet  request to url :" + url + "  onFail  "
					+ e.getMessage());
		}  catch (org.apache.http.conn.ConnectTimeoutException e) {
			RequestException exception = new RequestException(
					RequestException.SOCKET_TIMEOUT_EXCEPTION, "Connect timeout");
			AsyncHttpGet.this.requestCallback.onFail(exception);
			Log.d(AsyncHttpGet.class.getName(),
					"AsyncHttpGet  request to url :" + url + "  onFail  "
					+ e.getMessage());
		} catch (java.net.SocketTimeoutException e) {
			RequestException exception = new RequestException(
					RequestException.SOCKET_TIMEOUT_EXCEPTION, "Socket Connect timeout");
			AsyncHttpGet.this.requestCallback.onFail(exception);
			Log.d(AsyncHttpGet.class.getName(),
					"AsyncHttpGet  request to url :" + url + "  onFail  "
					+ e.getMessage());
		} catch (UnsupportedEncodingException e) {
			RequestException exception = new RequestException(
					RequestException.UNSUPPORTED_ENCODEING_EXCEPTION, "Unsupported exception");
			AsyncHttpGet.this.requestCallback.onFail(exception);
			Log.d(AsyncHttpGet.class.getName(),
					"AsyncHttpGet  request to url :" + url + "  UnsupportedEncodingException  "
					+ e.getMessage());
		} catch (org.apache.http.conn.HttpHostConnectException e) {
			RequestException exception = new RequestException(
					RequestException.CONNECT_EXCEPTION, "connect exception");
			AsyncHttpGet.this.requestCallback.onFail(exception);
			Log.d(AsyncHttpGet.class.getName(),
					"AsyncHttpGet  request to url :" + url + "  HttpHostConnectException  "
					+ e.getMessage());
		} catch (ClientProtocolException e) {
			RequestException exception = new RequestException(
					RequestException.CLIENT_PROTOL_EXCEPTION, "protecol exception");
			AsyncHttpGet.this.requestCallback.onFail(exception);
			e.printStackTrace();
			Log.d(AsyncHttpGet.class.getName(),
					"AsyncHttpGet  request to url :" + url + "  ClientProtocolException "
					+ e.getMessage());
		} catch (IOException e) {
			RequestException exception = new RequestException(
					RequestException.IO_EXCEPTION, "io exception");
			AsyncHttpGet.this.requestCallback.onFail(exception);
			e.printStackTrace();
			Log.d(AsyncHttpGet.class.getName(),
					"AsyncHttpGet  request to url :" + url + "  IOException  "
					+ e.getMessage());
		} finally {
			//request.
		}
		super.run();
	}
}
