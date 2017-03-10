<?php 
    //上传文件类
    class FileUpload{
        private $error;         //错误代码
        private $maxsize;       //表单最大值
        private $type;          //类型
        private $typeArr = array('image/jpeg','image/pjpeg','image/png','image/x-png','image/gif');		//类型合集
        private $path;          //目录路径
        private $today;         //当天的目录,时区设置在init文件
        private $name;          //文件名
        private $tmp;           //临时文件
        private $linkpath;      //链接路径
        private $linktotay;     //当天时间目录(相对路径)
        
        //构造方法初始化
        public function __construct($_file,$_maxsize){
            $this->error = $_FILES[$_file]['error'];
            $this->maxsize = $_maxsize / 1024;
            $this->type = $_FILES[$_file]['type'];  //type是文件中的MIME类型，为内置的东西
            $this->path = ROOT_PATH.UPDIR;
            $this->linktotay = date('Ymd').'/';     //当天时间的目录
            $this->today = $this->path.$this->linktotay;
            $this->name = $_FILES[$_file]['name'];
            $this->tmp = $_FILES[$_file]['tmp_name'];   //tmp_name也是内置名称
            $this->checkError();
            $this->checkType();
            $this->checkPath();
            $this->moveUpload();
        }
        
        
        //返回路径
        public function getPath(){
            $_path = $_SERVER["SCRIPT_NAME"];
            $_dir = dirname(dirname($_path));
            if($_dir == '\\') $_dir = '/';  //如果失主目录，就换成/;\\是\的转义
            $this->linkpath = $_dir.$this->linkpath;
            return $this->linkpath;     //$this->linkpath在设置新文件名里面赋值,通过moveupload访问setnewname，再从上至下通过$this->访问执行到
        }
        
        //移动文件
        private function moveUpload(){
            if(is_uploaded_file($this->tmp)){
                if(!move_uploaded_file($this->tmp, $this->setNewName())){
                    Tool::alertBack('上传失败');
                }
            }else{
                Tool::alertBack('临时文件不存在');
            }
        }
        
        //设置新文件名
        private function setNewName(){
            $_nameArr = explode('.',$this->name);
            $_postfix = $_nameArr[count($_nameArr)-1]; //取得最后一个点后面的字符，如png
            $_newname = date('YmdHis').mt_rand(100, 1000).'.'.$_postfix;
            $this->linkpath = UPDIR.$this->linktotay.$_newname;
            return $this->today.$_newname;
        }
        
        //验证目录
        private function checkPath(){
            //创建主目录
            if(!is_dir($this->path) || !is_writeable($this->path)){ //目录不存在或者不可写
                if(!mkdir($this->path,0777)){
                    Tool::alertBack('主目录创建失败');
                }
            }
            //创建子目录
            if(!is_dir($this->today) || !is_writeable($this->today)){ //目录不存在或者不可写
                if(!mkdir($this->today)){
                    Tool::alertBack('子目录创建失败');
                }
            }
        }
        
        //验证类型
        private function checkType(){
            if(!in_array($this->type, $this->typeArr)){  //第一个参数是要验证的类型，第二个参数是验证类型的集合
                Tool::alertBack('不合法的上传类型');
            }
        }
        
        //验证错误
        private function checkError(){
            if(!empty($this->error)){
                switch ($this->error){
                    case 1:
                        Tool::alertBack('上传值超过约定最大值');
                        break;
                    case 2:
                        Tool::alertBack('上传值超过'.$this->maxsize.'KB');
                        break;
                    case 3:
                        Tool::alertBack('只有部分文件被上传,请重新上传');
                        break;
                    case 4:
                        Tool::alertBack('没有任何文件被上传');
                        break;
                    default:
                        Tool::alertBack('未知错误,请联系管理员');
                }
            }
        }
        
        
    }
?>