<?php

namespace App\Http\Controllers;

use EasyWeChat\Foundation\Application;
use Illuminate\Http\Request;

use App\Http\Requests;

class MaterialController extends Controller
{
    public $material;
    public $broadcast;
    public $notice;

    public function __construct(Application $app)
    {
        $this->material = $app->material;
        $this->broadcast = $app->broadcast;
        $this->notice = $app->notice;
    }

    // 图片上传
    public function image()
    {
        $image = $this->material->uploadImage( public_path().'/bin.jpg');
        return $image;
    }

    // 音频上传
    public function voice()
    {
        $voice = $this->material->uploadVoice( public_path().'/1.mp3');
        return $voice;
    }

    // 获取上传图片的列表
    public function images()
    {
        // lists( $type )
        $images = $this->material->lists('image');
        return $images;
    }

    // 获取上传音频的列表
    public function voices()
    {
        // lists( $type )
        $voices = $this->material->lists('voice');
        return $voices;
    }

    // 获得上传后的永久素材
    public function media($mediaId)
    {
        //$mediaId = '1T6WX9vGjCR9eyyvkEz1XblHSZ7pm9v5oFC4YSci9mA';
        $media = $this->material->get($mediaId);
        // 将二进制图片流文件写入文件, linux需要给Public目录权限
        file_put_contents(public_path().'/1.jpg',$media);
        return $media;
    }

    // 群发信息
    public function message()
    {
        // 群发给所有用户
        //$mediaId = '1T6WX9vGjCR9eyyvkEz1XY4aAfG9Xk5AOSgSZPRc58w';
        //$this->broadcast->sendVoice($mediaId);
        $this->broadcast->sendText('大家好!!');

        // 群发给指定用户id
        // send( $type,  $media_id ,[$user_id,$user_id')
        /*$mediaId = '1T6WX9vGjCR9eyyvkEz1XY4aAfG9Xk5AOSgSZPRc58w';
        $this->broadcast->send('voice',$mediaId,[
            // 大于等于2
            'id',
            'id'
        ]);*/
        return 'ok';
    }

    // 模板信息
    public function notice()
    {
        $messageId = $this->notice->send([
            'touser' => 'user-openid',
            'template_id' => 'template-id',
            'url' => 'xxxxx',
            'topcolor' => '#f7f7f7',
            'data' => [
                //...
            ],
        ]);
    }
}
