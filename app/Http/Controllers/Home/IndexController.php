<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Message;
use Illuminate\Http\Request;

use App\Http\Requests;

class IndexController extends CommonController
{
    public function index()
    {
        echo "hello,i am bin";
    }

    public function ask($content)
    {
        /*
        //$meg= Message::all();
        $msg = Message::where('question','like','%'.$question.'%')->get();
        //dd($msg);
        foreach($msg  as $k=>$v){
            echo "<br>".$msg[$k]->answer;
        }
        */
            $msg = Message::where('question','like','%'.$content.'%')->get();   
            //dd($msg);
            //dd(strstr($content,"（）"));
                //dd(str_replace("（）","()",$content));
            //dd($content);
            if($msg->count()){
            $message = '';
                foreach($msg  as $k=>$v){
                    if($k == 0)
                        $message .= $msg[$k]->answer;
                    else
                        $message .= "</br>".$msg[$k]->question.$msg[$k]->answer;
                }
             //echo "<br>".$msg[$k]->answer;
            }else {
                $message = "数据库没有收录这条题目哦!";
            }
            
            return $message;
    }

}
