<?php 
class require_text{
    
    public function __construct($_key = ''){
        if (!empty($_key)){
            $this->_text_response($_key);
        }
    }
    //订阅事件触发,回复消息
    public function _subscribe_response(){
        $content = "
                                                【BBO星人的远征】是一个致力于传递、推送丰富的金属乐相关内容的公众号。BBO星人们在创始人loveyobbo的带领下，多年来一贯坚持信息资源共享、平等友爱、热爱音乐三大核心意志，欢迎各路音乐爱好者来进入我们的小乐园。\n\n
                                                 现阶段，受制于关注数量以及开启时间的限制，很多界面和功能都无法实现。\n
                                                我们会尽快完善哒~\n\n
                BBO�星港坐标\n
                                                微博：www.weibo.com/bboism\n
                                                贴吧：tieba.baidu.com/loveyobbo\n
                                                 网易云：music.163.com/#/user/home?id=440225096\n
                QQ群：55355604\n\n
                2017年5月8日\n
            ";
//         $content .= "哈哈哈哈哈哈~\n欢迎关注BBO微信公众号";
//         $content .= "阅读近期乐队访谈请回复'访谈'\n";
//         $content .= "阅读精品译文请回复'译文'\n";
//         $content .= "了解演出动态请回复'演出'\n";
//         $content .= "进入BBO星请回复'BBO'\n";
//         $content .= "查看小雪美照请回复'小雪'\n";
//         $content .= "使用其他功能请回复'其它'\n";
        return $content;
    }
    //接收文本消息
    public function _text_response($_key){
        if(substr($_key, 0,6) == '天气'){
            $_key1 = $_key;
            $_key = '天气';
        }
        switch ($_key)//TODO 关键字回复
            {
            	case "faith":
            	    $content = '<a href="https://www.baidu.com">百度测试</a>';
            	    break;
            	case strtolower('BBO'):
            	    $content = '<a href="http://weibo.com/bboism?from=profile&wvr=6&is_hot=1">BBO微博</a>'."\n";
            	    $content .= '<a href="http://tieba.baidu.com/f?kw=loveyobbo">BBO贴吧</a>'."\n";
            	    $content .= '<a href="http://music.163.com/#/user/home?id=440225096">BBO网易云</a>'."\n";
            	    $content .= '或者直接于以上平台搜索BBO星关键字。';
            	    break;
            	case "微博":
            	    $content = '<a href="http://weibo.com/bboism?from=profile&wvr=6&is_hot=1">BBO微博</a>';
            	    break;
            	case "贴吧":
            	    $content = '<a href="http://tieba.baidu.com/f?kw=loveyobbo">BBO贴吧</a>';
            	    break;
            	case "网易云音乐":
            	    $content = '<a href="http://music.163.com/#/user/home?id=440225096">BBO网易云</a>';
            	    break;
            	case "起源":
            	    $content = '';
            	    break;
            	case "小雪":
            	    $content = '小雪图片还未上传';
            	    break;
            	case '天气':
            	    $content = array();
            	    $content = $this->getWeatherInfo($_key1);
            	    break;
        	   case "news":                      //单图文消息
        	        $content = array();
        	        $content[] = array("Title"=>'多图文',  "Description"=>'你好', "PicUrl"=>'http://avatar.csdn.net/C/C/0/1_afanxingzhou.jpg', "Url" =>'http://www.baidu.com');
        	        break;
    	       case "dnews": 
                    $content = array(); 
                    $content[] = array("Title"=>"多图文1标题", "Description"=>"", "PicUrl"=>"http://discuz.comli.com/weixin/weather/icon/cartoon.jpg", "Url" =>"http://m.cnblogs.com/?u=txw1958"); 
                    $content[] = array("Title"=>"多图文2标题", "Description"=>"", "PicUrl"=>"http://d.hiphotos.bdimg.com/wisegame/pic/item/f3529822720e0cf3ac9f1ada0846f21fbe09aaa3.jpg", "Url" =>"http://m.cnblogs.com/?u=txw1958"); 
                    $content[] = array("Title"=>"多图文3标题", "Description"=>"", "PicUrl"=>"http://g.hiphotos.bdimg.com/wisegame/pic/item/18cb0a46f21fbe090d338acc6a600c338644adfd.jpg", "Url" =>"http://m.cnblogs.com/?u=txw1958"); 
                    break;   
            default:
                    $content = "暂未收录该关键词哦。\n".date("Y-m-d H:i:s",time());
                    break;
            }
            return $content;
    }
    
    
    public function getWeatherInfo($cityName)
    {
        if ($cityName == "" || (strstr($cityName, "+"))){
            return "发送天气+城市，例如'天气深圳'";
        }
        $url = "http://api.map.baidu.com/telematics/v3/weather?location=".urlencode($cityName)."&output=json&ak=ECe3698802b9bf4457f0e01b544eb6aa";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($output, true);
        if ($result["error"] != 0){
            return $result["status"];
        }
        $curHour = (int)date('H',time());
        $weather = $result["results"][0];
        $weatherArray[] = array("Title" =>$weather['currentCity']."天气预报", "Description" =>"", "PicUrl" =>"", "Url" =>"");
        for ($i = 0; $i < count($weather["weather_data"]); $i++) {
            $weatherArray[] = array("Title"=>
                $weather["weather_data"][$i]["date"]."\n".
                $weather["weather_data"][$i]["weather"]." ".
                $weather["weather_data"][$i]["wind"]." ".
                $weather["weather_data"][$i]["temperature"],
            "Description"=>"", 
            "PicUrl"=>(($curHour >= 6) && ($curHour < 18))?$weather["weather_data"][$i]["dayPictureUrl"]:$weather["weather_data"][$i]["nightPictureUrl"], "Url"=>"");
        }
        return $weatherArray;
    }


    
}













?>