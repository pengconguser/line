<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class indexController extends Controller
{
    public function index(Request $request)
    {
    	$content=date('Y-m-d H:i:s');

    	//
 		$http=new swoole_http_server('0.0.0.0',8001);

		$http->on('request',function($request,$response){
				//获取redis某个key值 输出到客户端
				$redis=new Swoole\Coroutine\Redis();

				$redis->connect('127.0.0.1',6379);
				$value=$redis->get($request->get['a']);

				//设置响应头,推送数据到客户端
				$response->header("Content-Type","text/plain");
				$response->end($value);
		});

		$http->start();

		return "reading";
    }
}
