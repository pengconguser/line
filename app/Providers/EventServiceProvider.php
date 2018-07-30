<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //// 修改`app/Providers/EventServiceProvider.php`, 添加下面监听代码到boot方法中
        // 如果变量$events不存在，你也可以通过Facade调用\Event::listen()。
        Event::listen('laravels.received_request', function (\Illuminate\Http\Request $req, $app) {
            //system dosomething
            $req->query->set('get_key', 'hhxsv5');// 修改querystring
            $req->request->set('post_key', 'hhxsv5'); // 修改post body
        });
    }
}
