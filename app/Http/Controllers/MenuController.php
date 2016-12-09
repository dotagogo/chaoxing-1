<?php

namespace App\Http\Controllers;

use EasyWeChat\Foundation\Application;
use Illuminate\Http\Request;

use App\Http\Requests;

class MenuController extends Controller
{
    public $menu;

    public function __construct(Application $app)
    {
    		$this->menu = $app->menu;
    }

    // 创建自定义菜单
    public function menu()
    {
	    $buttons = [
		    [
		        "type" => "click",
		        "name" => "彬彬测试",
		        "key"  => "BIN_TEST"
		    ],
		    [
		        "name"       => "测试菜单",
		        "sub_button" => [
		            [
		                "type" => "view",
		                "name" => "彬彬博客",
		                "url"  => "http://www.zz-bin.cn/blog"
		            ],
		            [
		                "type" => "click",
		                "name" => "赞一下彬彬",
		                "key" => "BIN_VOTED"
		            ],
		        ],
		    ],
		];
		$this->menu->add($buttons);
		return 'ok';
    }

    public function menuAll()
    {
    	//return $this->menu->all();
    	return $this->menu->current();
    }
}
