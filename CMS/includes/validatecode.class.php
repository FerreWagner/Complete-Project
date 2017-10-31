<?php 
    //验证码类
    class Validatecode{
        private $charset = 'qwertyupasdfghkzxcvbnmQWERTYUIPASDFGHJKLZXCVBNM023456789';
        private $code;              //保存验证码
        private $codelen = 4;       //验证码长度
        private $width = 130;       //宽度
        private $height = 50;       //高度
        private $img;               //图形资源句柄
        private $font;              //指定字体
        private $fontsize = 20;     //指定的字体大小
        private $fontcolor;         //指定字体颜色
        
        //构造方法初始化
        public function __construct(){
            $this->font = ROOT_PATH.'/font/elephant.ttf';
        }
        
        //生成随机码
        private function createCode(){
            $_len = strlen($this->charset) - 1;
            for($i=0;$i<$this->codelen;$i++){
                $this->code .= $this->charset[mt_rand(0, $_len)];   //将长度作为随机数来,再作为charset的下标,取出随机数
            }
        }
        
        //生成背景
        private function createBg(){
            $this->img = imagecreatetruecolor($this->width, $this->height);                 //生成画布
            $color = imagecolorallocate($this->img, mt_rand(157, 255), mt_rand(157, 255), mt_rand(157, 255));                               //生成颜色
            imagefilledrectangle($this->img, 0, $this->height, $this->width, 0, $color);    //生成位置(坐标)
        }
        
        //生成四个文字,各占1/4,高度居中.采用指定的字体,随机颜色,随机倾斜度等等
        //生成文字
        private function createFont(){
            $_x  = $this->width / $this->codelen;  //长度除以4,可以均匀分配
            for($i=0;$i<$this->codelen;$i++){
                $this->fontcolor = imagecolorallocate($this->img, mt_rand(0, 156), mt_rand(0, 156), mt_rand(0, 156));   //字体颜色初始化
                imagettftext($this->img, $this->fontsize, mt_rand(-30, 30), $_x*$i+mt_rand(4, 8),$this->height/1.4, $this->fontcolor, $this->font, $this->code[$i]);
                //这个函数的参数分别是：资源句柄img;字体大小;字体倾斜度;字体坐标$i*$_x依次变宽;还有长度;字体颜色;字体;字符
            }
        }
        
        //生成线条雪花
        private function createLine(){
            for($i=0;$i<6;$i++){
                $color = imagecolorallocate($this->img, mt_rand(0, 156), mt_rand(0, 156), mt_rand(0, 156));
                imageline($this->img, mt_rand(0, $this->width), mt_rand(0, $this->height), mt_rand(0, $this->width), mt_rand(0, $this->height), $color);
            }
            for($i=0;$i<10;$i++){
                $color = imagecolorallocate($this->img, mt_rand(200, 255), mt_rand(200, 255), mt_rand(200, 255));
                imagestring($this->img, mt_rand(1,5), mt_rand(0, $this->width), mt_rand(0, $this->height), '*', $color);
            }
        }
        
        //输出图形
        private function outPut(){
            header('Content-type:image/png');       //指定HTTP发送的标头
            imagepng($this->img);                   //已png格式将图片输出至浏览器或文件
            imagedestroy($this->img);               //销毁资源句柄
        }
        
        
        //对外生成
        public function doimg(){
            $this->createBg();
            $this->createCode();
            $this->createFont();
            $this->createLine();
            $this->outPut();
        }
        
        //获取验证码
        public function getCode(){
            return strtolower($this->code);
        }
        
    }

?>