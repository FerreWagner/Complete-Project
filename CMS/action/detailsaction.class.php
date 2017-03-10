<?php 

    class DetailsAction extends Action{   //这个类是等级执行类
        
        //构造方法初始化
        public function __construct(&$_tpl){
            parent::__construct($_tpl);   //这里很重要，在自动调用创建的对象后,覆盖了一层这样的语句,并重新创建levelmodel对象，使用他的id
        }
        
        //执行
        public function _action(){
            $this->getDetails();
        }
        
        //获取文档详细内容
        private function getDetails(){
            if(isset($_GET['id'])){
                parent::__construct($this->_tpl,new ContentModel());
                $this->_model->id = $_GET['id'];
                $_content = $this->_model->getOneContent();
                //if(!$_content) Tool::alertBack('不存在此文档');                         //通过判断数据是否存在，来判断是否存在文档
                if(!$this->_model->setContentCount()) Tool::alertBack('不存在此文档');   //做点击量处理,这样判断存在与否更方便,一举两得
                $this->_tpl->assign('id',$_content->id);
                $this->_tpl->assign('titlec',$_content->title);
                $this->_tpl->assign('date',$_content->date);
                $this->_tpl->assign('source',$_content->source);
                $this->_tpl->assign('author',$_content->author);
                $this->_tpl->assign('info',$_content->info);
                $this->_tpl->assign('tag',$_content->tag);
                $this->_tpl->assign('content',Tool::unHtml($_content->content));
                $this->getNav($_content->nav);
                if(IS_CACHE){    //判断缓存是否开启，对调试和运行两种状态的累积量分开，以免重复累积
                    $this->_tpl->assign('count','<script type="text/javascript">getContentCount();</script>');
                }else{
                    $this->_tpl->assign('count',$_content->count);
                }
            }else{
                Tool::alertBack('非法操作');
            }
        }
        
        //获取前台显示的导航
        private function getNav($_id){  //这个$_id获取nav的值
                $_nav = new NavModel();
                $_nav->id = $_id;       //把拿到的nav(就是这里得到的$_id)赋给$this->id(这个id在NavModel里)
                if($_nav->getOneNav()){
                    //主导航
                    if($_nav->getOneNav()->nnav_name) $_nav1 = '<a href="list.php?id='.$_nav->getOneNav()->iid.'">'.$_nav->getOneNav()->nnav_name.'</a> &gt ';
                    $_nav2 = '<a href="list.php?id='.$_nav->getOneNav()->id.'">'.$_nav->getOneNav()->nav_name.'</a>';   //赋值简化代码量
                    $this->_tpl->assign('nav',@$_nav1.$_nav2);
                    //子导航集
                    $this->_tpl->assign('childnav',$_nav->getAllChildFrontNav());
                }else{
                    Tool::alertBack('此导航不存在');
                }
        }
        
        
    }
?>