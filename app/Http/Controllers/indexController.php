<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class indexController extends Controller
{
    public function index(Request $request)
    {
    	$http =new \swoole_http_server();

    	$http->on('request',function($request){

    	});

    	$http->start();

        return view('welcome');
    }
}
