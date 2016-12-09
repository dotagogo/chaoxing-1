<?php

namespace App\Http\Controllers;

use EasyWeChat\Foundation\Application;
use Illuminate\Http\Request;

use App\Http\Requests;

class UsersController extends Controller
{
    public $wechat;

    public function __construct(Application $wechat)
    {
        $this->wechat=$wechat;
    }

    // 获取全部关注了的用户openid
    public function users()
    {
        $users = $this->wechat->user->lists();
        return $users;
    }

    // 获取指定ipenId的用户信息
    public function user($openId)
    {
        $user = $this->wechat->user->get($openId);
        return $user;
    }

    // 修改用户备注
    public function remark()
    {
        $openId = 'oQiMWwNiOeFPZDVBessJ3xIzv6qQ';
        $this->wechat->user->remark($openId,'测试测试');
        return 'ok';
    }
}
