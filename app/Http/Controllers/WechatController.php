<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use EasyWeChat\Message\Voice;
use EasyWeChat\Message\Image;
use App\Http\Requests;
use App\Http\Model\Message;

class WechatController extends Controller
{
    public function serve()
    {
        $wechat = app('wechat');
        $wechat->server->setMessageHandler(function($message) use ($wechat){

                switch ($message->MsgType) {
                	/*
		        case 'event':
		            switch ($message->Event) {
		            	case 'subscribe':
		            		return '你好,欢迎关注公众号!';
		            		break;
		            	case 'CLICK':
		            		if( $message->EventKey == 'BIN_TEST' )
		            			return '彬彬测试Ok';
		            		if( $message->EventKey == 'BIN_VOTED' )
		            			return '彬彬谢谢你的赞.';
		            		break;
		            	default:
		            		# code...
		            		break;
		            }
		            break;
		            */

		            
		        case 'text':
		        	  $content = $message->Content;
		        	  return $this->ask($content);
		        	  //return redirect('ask/'.$content); // 失败
		            //return '你好'.$userApi->get($message->FromUserName)->nickname; // 昵称
		            break;
		            

		            /*
		        case 'image':
		        	  $mediaId = '1T6WX9vGjCR9eyyvkEz1XblHSZ7pm9v5oFC4YSci9mA';
		        	  $image = new Image(['media_id'=>$mediaId]);
		        	  $wechat->staff->message($image)->to($message->FromUserName)->send();
		        	  return 'enjoy image';
		            break;
		            */

		            /*
		        case 'voice':
		        	  $mediaId = '1T6WX9vGjCR9eyyvkEz1XY4aAfG9Xk5AOSgSZPRc58w';
		        	  $voice = new Voice(['media_id'=>$mediaId]);
		        	  $wechat->staff->message($voice)->to($message->FromUserName)->send();
		        	  return 'enjoy music';
		            break;
		            */

		        case 'video':
		            # 视频消息...
		            break;

		        case 'location':
		            # 坐标消息...
		            break;

		        case 'link':
		            # 链接消息...
		            break;

		        // ... 其它消息
		        default:
		            # code...
		            break;
		    }
        });

        return $wechat->server->serve();
    }

    // 华商Gis超星网络课
    public function ask($content)
    {
    		/* $content 要求 带@  使用explode切除@  */
        	$content = explode('@',$content)[1];
        	if($content == '')
            	return;
       	if(iconv_strlen($content) < 5){  // strlen 中一个汉子 三个字节, 字符数字 1个字节
       		return "题目过短，请补充完整!";
       	}
       	$content = str_replace("（）","()",$content);
    		$msg = Message::where('question','like','%'.$content.'%')->take(5)->get();	
    		if($msg->count()){
    			$i = 2;
			$message = '';
    			foreach($msg  as $k=>$v){
    				if($k == 0)
    					$message .= "1: ".$msg[$k]->question." 答: ".$msg[$k]->answer;
    				else{
    					$message .= "\r\n".$i.": ".$msg[$k]->question." 答: ".$msg[$k]->answer;
    					$i++;
    				}
    			}
           	 //echo "<br>".$msg[$k]->answer;
    			$message .= "\r\n\r\n没有找到题目? 试试把题目输入详细点!";
    		}else {
    			$message = "没有找到题目? 试试把题目输入详细点!";
    		}
    		
    		return $message;
    }

}
