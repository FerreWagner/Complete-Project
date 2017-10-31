<?php 
    
    //模板类
    class Templates{
        //我想通过一个字段来接受变量，但是又不知道有多少个变量要接受，所以我们要动态的接受变量
        //因此可以通过数组来实现这个功能
        
        private $_vars = array();
        //保存系统变量
        private $_config = array();
        
        
        //创建一个构造方法,来验证各个目录是否存在
        public function __construct(){
            if(!is_dir(TPL_DIR) || !is_dir(TPL_C_DIR) || !is_dir(CACHE)){
                exit('ERROR,模板目录或编译目录或缓存目录不存在,请手工添加');
            }
            
            
            
            //保存系统变量
            $_sxe = simplexml_load_file(ROOT_PATH.'/config/profile.xml');
            $_tagLib = $_sxe->xpath('/root/taglib');
            
            foreach ($_tagLib as $_tag){
                $this->_config["$_tag->name"] = $_tag->value;
            }
            
        }
        
        //assign()方法用于注入变量
        public function assign($_var,$_value){
            //$_var用于同步模板里的变量名,例如index.php是name,那么index.tpl就是{name}
            //$_value值表示的是index.php里的值，就是'Ferre'
            if(isset($_var) && !empty($_var)){
                //$this->_vars['name']
                $this->_vars[$_var] = $_value;
            }else{
                exit('ERROR: 请设置模板变量');
            }
        }
        
        //缓存方法,跳转到缓存文件，不执行php，不连接数据库
        public function cache($_file){
            //设置模板的路径
            $_tplFile = TPL_DIR.$_file;
            //判断模板是否存在
            if(!file_exists($_tplFile)){
                exit('ERROR,模板文件不存在');
            }
            //是否加入参数
            if(!empty($_SERVER["QUERY_STRING"])){
                $_file .= $_SERVER["QUERY_STRING"];
            }
            //生成编译文件
            $_parFile = TPL_C_DIR.md5($_file).$_file.'.php';
            //缓存文件
            $_cacheFile = CACHE.md5($_file).$_file.'.html';
            
            //当第二次运行相同文件的时候,直接载入缓存文件,避开编译
            if(IS_CACHE){
                //缓存文件和编译文件都要存在
                if(file_exists($_cacheFile) && file_exists($_parFile)){
                    //判断模板文件是否修改过,判断编译文件是否修改过
                    if(filemtime($_parFile) >= filemtime($_tplFile) && filemtime($_cacheFile) >= filemtime($_parFile)){
                        //echo '直接执行了缓存文件';
                        //载入缓存文件
                        include $_cacheFile;
                        exit(); //不能return，那样就继续执行后面的php代码了
                    }
                }
            }
        }
        
        //display()方法,这里的$_file参数从index.php的display方法调用传过来,就一目了然了
        public function display($_file){
            //给include进来的tpl传一个模板操作的对象
            $_tpl = $this;
            
            //设置模板的路径
            $_tplFile = TPL_DIR.$_file;
            //判断模板是否存在
            if(!file_exists($_tplFile)){
                exit('ERROR,模板文件不存在');
            }
            //是否加入参数
            if(!empty($_SERVER["QUERY_STRING"])){
                $_file .= $_SERVER["QUERY_STRING"];
            }
            
            //生成编译文件
            $_parFile = TPL_C_DIR.md5($_file).$_file.'.php';
            
            //缓存文件
            $_cacheFile = CACHE.md5($_file).$_file.'.html';
            
//             //当第二次运行相同文件的时候,直接载入缓存文件,避开编译
//             if(FRONT_CACHE){
//                 //缓存文件和编译文件都要存在
//                 if(file_exists($_cacheFile) && file_exists($_parFile)){
//                     //判断模板文件是否修改过,判断编译文件是否修改过
//                     if(filemtime($_parFile) >= filemtime($_tplFile) && filemtime($_cacheFile) >= filemtime($_parFile)){
//                     //echo '直接执行了缓存文件';
//                     //载入缓存文件
//                     include $_cacheFile;
//                     return;
//                     }
//                 }
//             }
            
            //为了第二次打开网页不再重新生成文件
            if(!file_exists($_parFile) || filemtime($_parFile) < filemtime($_tplFile)){ //当文件没有被生成(第一次运行)或模板文件生成时间小于改变时间(修改过),那么重新生成
                //引入模板解析类
                require_once ROOT_PATH.'/includes/Parser.class.php';
                //实例化模板解析类
               $_parser = new Parser($_tplFile); //模板文件
               $_parser->compile($_parFile);    //编译文件
            }
            //为什么可以在这里打印?因为已经保存到了private私有定义的字段里了
            //print_r($this->_vars);
            //载入编译文件
            //print_r($this->_vars['name']);
            include $_parFile;
            if(IS_CACHE){
            
                //获取缓冲区内的数据,并且创建缓存文件
                file_put_contents($_cacheFile, ob_get_contents());
                
                //清除缓冲区(即清除编译文件加载的内容)
                ob_end_clean();
                //载入缓冲文件
                include $_cacheFile;
            }
        }
        
        
        
        
        //创建create方法,用于header和footer这种模块解析使用,而不需要生成缓存文件
        public function create($_file){
            //设置模板的路径
            $_tplFile = TPL_DIR.$_file;
            //判断模板是否存在
            if(!file_exists($_tplFile)){
                exit('ERROR,模板文件不存在');
            }
            //生成编译文件
            $_parFile = TPL_C_DIR.md5($_file).$_file.'.php';
            
            //为了第二次打开网页不再重新生成文件
            if(!file_exists($_parFile) || filemtime($_parFile) < filemtime($_tplFile)){ //当文件没有被生成(第一次运行)或模板文件生成时间小于改变时间(修改过),那么重新生成
                //引入模板解析类
                require_once ROOT_PATH.'/includes/Parser.class.php';
                //实例化模板解析类
                $_parser = new Parser($_tplFile); //模板文件
                $_parser->compile($_parFile); 
            }
            //载入编译文件
            include $_parFile;//编译文件
        }
    }
?>