<?php
define("TOKEN", "bbo_big_sister_head");
date_default_timezone_set('PRC'); 
function __autoload($_className){   //自动加载
    $_filePath = './response/'.strtolower($_className).'.php';
    if (file_exists($_filePath)){
        include_once $_filePath;
    }else {
        echo $_className.'类未找到';
    }
}

$wechatObj = new wechatCallbackapiTest();

if (!isset($_GET['echostr'])) {
    $wechatObj->responseMsg();
}else{
    $wechatObj->valid();
}

class wechatCallbackapiTest
{
    //验证消息
    public function valid()
    {
        $echoStr = $_GET["echostr"];
        if($this->checkSignature()){
            echo $echoStr;
            exit;
        }
    }

    //检查签名
    private function checkSignature()
    {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);

        if($tmpStr == $signature){
            return true;
        }else{
            return false;
        }
    }

    //响应消息
    public function responseMsg()
    {
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];//获取微信端发送的xml数据
        if (!empty($postStr)){
            //将$postStr变量进行解析，并赋予$postObj
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $RX_TYPE = trim($postObj->MsgType);

            switch ($RX_TYPE)
            {
                case "event":
                    $result = $this->receiveEvent($postObj);
                    break;
                case "text":
                    $result = $this->receiveText($postObj);
                    break;
                case "image":
                    $result = $this->receiveImage($postObj);
                    break;
                case "location":
                    $result = $this->receiveLocation($postObj);
                    break;
                case "voice":
                    $result = $this->receiveVoice($postObj);
                    break;
                case "video":
                    $result = $this->receiveVideo($postObj);
                    break;
                case "link":
                    $result = $this->receiveLink($postObj);
                    break;
                default:
                    $result = "unknown msg type: ".$RX_TYPE;
                    break;
            }
            echo $result;
        }else {
            echo "";
            exit;
        }
    }

    //接收事件消息（6个）
    private function receiveEvent($object)//这里的$object来自$postObj————解析了微信消息的对象
    {
        $_transmit = new transmit();
        $content = "";
        switch ($object->Event)
        {
            case "subscribe":
                $_obj = new require_text();
                $content = $_obj->_subscribe_response();
                $content .= (!empty($object->EventKey))?("\n来自二维码场景 ".str_replace("qrscene_","",$object->EventKey)):"";
                break;
            case "unsubscribe":
                $content = "取消关注";
                break;
            case "SCAN":
                $content = "扫描场景 ".$object->EventKey;
                break;
            case "CLICK"://TODO 自定义菜单
                switch ($object->EventKey)
                {

                	case "weizhi":
                		$content = "点击菜单：".$object->EventKey;
                		break;
                    default:
                        $content = "点击菜单：".$object->EventKey;
                        break;
                }
                break;
            case "LOCATION":
                //$content = "上传位置：纬度 ".$object->Latitude.";经度 ".$object->Longitude;
                break;
            case "VIEW":
                $content = "跳转链接 ".$object->EventKey;
                break;
            default:
                $content = "receive a new event: ".$object->Event;
                break;
        }
        if(is_array($content)){
            if (isset($content[0]['PicUrl'])){
                $result = $_transmit->transmitNews($object, $content);
            }else if (isset($content['MusicUrl'])){
                $result = $_transmit->transmitMusic($object, $content);
            }
        }else{
            $result = $_transmit->transmitText($object, $content);
        }
        return $result;
    }

    //接收文本消息
    private function receiveText($object)
    {
        $_transmit = new transmit();
        if (isset($object->Recognition) && !empty($object->Recognition))
    	{
    		$keyword = $object->Recognition;//语音识别
    	}else{
    		$keyword = trim($object->Content);
    	}
    	
        $_obj    = new require_text();
    	$content = $_obj->_text_response($keyword);
        
    	
        if(is_array($content)){
            if (isset($content[0]['PicUrl'])){
                $result = $_transmit->transmitNews($object, $content);
            }else if (isset($content['MusicUrl'])){
                $result = $_transmit->transmitMusic($object, $content);
            }
        }else{
            $result = $_transmit->transmitText($object, $content);
        }
        
        //TODO 获取openID来调用用户信息
        $start = strpos($result, 'FromUserName') + 22;
        $last  = strripos($result, 'FromUserName') - $start - 5;
        $userId = substr($result, $start, $last);
        //TODO 数据写入数据库
        require_once 'response/conn.php';
        $_sql = 'INSERT INTO loveyobbo (userid, message, timer) VALUES ("'.$userId.'", "'.$keyword.'", NOW());';
        $_mysqli->query($_sql);
        
        return $result;
    }

    //接收图片消息
    private function receiveImage($object)
    {
        $_transmit = new transmit();
        $content = array("MediaId"=>$object->MediaId);
        $result = $_transmit->transmitImage($object, $content);
        return $result;
    }

    //接收位置消息
    private function receiveLocation($object)
    {
        $_transmit = new transmit();
        $content = "你发送的是位置，纬度为：\n".$object->Location_X."；\n经度为：\n".$object->Location_Y."；\n缩放级别为：\n".$object->Scale."；\n位置为：\n".$object->Label;
        $result = $_transmit->transmitText($object, $content);
        return $result;
    }

    //接收语音消息
    private function receiveVoice($object)
    {
        $_transmit = new transmit();
        if (isset($object->Recognition) && !empty($object->Recognition)){
            $content = "你刚才说的是：".$object->Recognition;
            $result = $_transmit->transmitText($object, $content);
        }else{
            $content = array("MediaId"=>$object->MediaId);
            $result = $_transmit->transmitVoice($object, $content);
        }

        return $result;
    }

    //接收视频消息
    private function receiveVideo($object)
    {
        $_transmit = new transmit();
        $content = array("MediaId"=>$object->MediaId, "ThumbMediaId"=>$object->ThumbMediaId, "Title"=>"", "Description"=>"");
        $result = $_transmit->transmitVideo($object, $content);
        return $result;
    }

    //接收链接消息
    private function receiveLink($object)
    {
        $_transmit = new transmit();
        $content = "你发送的是链接，标题为：".$object->Title."；内容为：".$object->Description."；链接地址为：".$object->Url;
        $result = $_transmit->transmitText($object, $content);
        return $result;
    }

    
}
?>