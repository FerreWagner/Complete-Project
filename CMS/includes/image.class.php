<?php 
    //图像处理类
    class Image{
        private $file;          //图片地址
        private $width;         //图片长度
        private $height;        //图片高度
        private $type;          //图片类型
        private $img;           //原图的资源句柄
        private $new;           //新图的资源句柄
        
        //构造方法,初始化
        public function __construct($_file){
            $this->file = $_SERVER["DOCUMENT_ROOT"].$_file;
            list($this->width,$this->height,$this->type) = getimagesize($this->file);   //getimagesize取得图像大小;list：把数组中的值赋给一些变量
            $this->img = $this->getFromImg($this->file, $this->type);
            
        }
        
        //缩略图(百分比)
//         public function thumb($_per){
//             $new_width = $this->width * ($_per / 100);
//             $new_height = $this->height * ($_per /100);
            
//             $this->new = imagecreatetruecolor($new_width, $new_height);
//             imagecopyresampled($this->new, $this->img, 0, 0, 0, 0, $new_width, $new_height, $this->width, $this->height);
//         }

        //等比缩略图
//         public function thumb($new_width,$new_height){
            
//             if($this->width < $this->height){
//                 $new_width = ($new_height / $this->height) * $this->width;
//             }else{
//                 $new_height = ($new_width / $this->width) * $this->height;
//             }
            
//             echo $new_width;
//             echo '<br>'.$new_height;
//             $this->new = imagecreatetruecolor($new_width, $new_height);
//             imagecopyresampled($this->new, $this->img, 0, 0, 0, 0, $new_width, $new_height, $this->width, $this->height);
//         }

        //cke专用图像处理
        public function ckeImg($new_width = 0,$new_height = 0){ //初始化这两个参数
            list($_water_width,$_water_height,$_water_type) = getimagesize(MARK);
            $_water = $this->getFromImg(MARK, $_water_type);
            
            if(empty($new_width) && empty($new_height)){    //判断没传参数，就是原长度
                $new_width = $this->width;
                $new_height = $this->height;
            }
            if(!is_numeric($new_width) || !is_numeric($new_height)){    //判断不是数字，就是原长度
                $new_width = $this->width;
                $new_height = $this->height;
            }
            
            if($this->width > $new_width){  //通过指定长度获取等比例的高度
                $new_height = ($new_width / $this->width) * $this->height;
            }else{  //如果上传的图片长高都比规定的190、/10小，那么就放上原图的长高
                $new_width = $this->width;
                $new_height = $this->height;
            }
            if($this->height > $new_height){    //通过指定高度获取等比例的长度
                $new_width = ($new_height / $this->height) * $this->width;
            }else{  //如果上传的图片长高都比规定的190、/10小，那么就放上原图的长高
                $new_width = $this->width;
                $new_height = $this->height;
            }
            
            $_water_x = $new_width - $_water_width - 5;     //坐标点x
            $_water_y = $new_height - $_water_height - 5;   //坐标点y
            
            $this->new = imagecreatetruecolor($new_width, $new_height);
            imagecopyresampled($this->new, $this->img, 0, 0, 0, 0, $new_width, $new_height, $this->width, $this->height);
            if($new_width > $_water_width && $new_height > $_water_height){ //当图片不是很小的时候，才加上水印
                imagecopy($this->new, $_water, $_water_x, $_water_y, 0, 0, $_water_width, $_water_height);
            }
            imagedestroy($_water);
        }

        //固定长高容器缩略图；图像等比例；扩容填充；裁剪;固定了大小，不失真不变形
        public function thumb($new_width = 0,$new_height = 0){
            
            if(empty($new_width) && empty($new_height)){    //判断没传参数，就是原长度
                $new_width = $this->width;
                $new_height = $this->height;
            }
            
            if(!is_numeric($new_width) || !is_numeric($new_height)){    //判断不是数字，就是原长度
                $new_width = $this->width;
                $new_height = $this->height;
            }
            
            //创建一个容器
            $_n_w = $new_width;
            $_n_h = $new_height;
            
            //创建裁剪点
            $_cut_width = 0;
            $_cut_height = 0;
            
            if($this->width < $this->height){
                $new_width = ($new_height / $this->height) * $this->width;
            }else{
                $new_height = ($new_width / $this->width) * $this->height;
            }
            
            if ($new_width < $_n_w) { //如果新高度小于新容器高度
                $r = $_n_w / $new_width; //按长度求出等比例因子
                $new_width *= $r; //扩展填充后的长度
                $new_height *= $r; //扩展填充后的高度
                $_cut_height = ($new_height - $_n_h) / 2; //求出裁剪点的高度
            }
            
            if ($new_height < $_n_h) { //如果新高度小于容器高度
                $r = $_n_h / $new_height; //按高度求出等比例因子
                $new_width *= $r; //扩展填充后的长度
                $new_height *= $r; //扩展填充后的高度
                $_cut_width = ($new_width - $_n_w) / 2; //求出裁剪点的长度
            }
                      
            $this->new = imagecreatetruecolor($_n_w, $_n_h);
            imagecopyresampled($this->new, $this->img, 0, 0, $_cut_width, $_cut_height, $new_width, $new_height, $this->width, $this->height);
        }
        
        
        //加载各种类型图片；并返回图片的资源句柄
        private function getFromImg($_file,$_type){
            switch ($_type){
                case 1:
                    $img = imagecreatefromgif($_file);
                    break;
                case 2:
                    $img = imagecreatefromjpeg($_file);
                    break;
                case 3:
                    $img = imagecreatefrompng($_file);
                    break;
                default:
                    Tool::alertBack('本系统不支持此图片类型');
                    break;
            }
            return $img;
        }
        
        //图像输出
        public function out(){
            imagepng($this->new,$this->file);
            imagedestroy($this->img);
            imagedestroy($this->new);
        }
    }
?>