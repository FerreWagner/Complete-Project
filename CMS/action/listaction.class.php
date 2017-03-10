<?php 

    class ListAction extends Action{   //这个类是等级执行类
        
        //构造方法初始化
        public function __construct(&$_tpl){
            parent::__construct($_tpl);   //这里很重要，在自动调用创建的对象后,覆盖了一层这样的语句,并重新创建levelmodel对象，使用他的id
        }
        
        //执行
        public function _action(){
            $this->getNav();
            $this->getListContent();
        }
        
        //获取前台列表显示
        private function getListContent(){
            if(isset($_GET['id'])){
                parent::__construct($this->_tpl,new ContentModel());
                
                $_nav = new NavModel();
                $_nav->id = $_GET['id'];    //将get到的值交与私有字段id
                $_navid = $_nav->getNavChildId();   
                
                if($_navid){    //如果通过getNavChildId查找到的pid=GET到的id值(即查询到所有该GET下的子类)
                    $this->_model->nav = Tool::objArrOfStr($_navid, 'id');  //那么将其navid值分割交给nav，然互交给getListContent方法执行in操作,在下面
                }else{
                    $this->_model->nav = $_nav->id; //无值(即根本没有子类)，即将get到的一个id值赋给nav
                }
                
                parent::page($this->_model->getListContentTotal(),ARTICLE_SIZE);
                
                $_object = $this->_model->getListContent();
                $_object = Tool::subStr($_object, 'info', 110, 'utf-8');
                $_object = Tool::subStr($_object, 'title', 33, 'utf-8');
                if(IS_CACHE){    //判断前台缓存是否打开，打开了，就运用静态方法同步显示
                    if($_object){   //判断是否存在,以免前台数据没有发生错误
                        foreach ($_object as $_value){
                            $_value->count = "<script type='text/javascript'>getContentCount();</script>";
                        }
                    }
                }
                $this->_tpl->assign('AllListContent',$_object);
            }else{
                Tool::alertBack('非法操作');
            }
        }
        
        //获取前台显示的导航
        private function getNav(){
            if(isset($_GET['id'])){
                $_nav = new NavModel();
                $_nav->id = $_GET['id'];    //这里将获取到的id交给NavModel里定义的id,从而进行使用,从而交给getOneNav方法使用;TIPS:对象可以使用类的私有成员
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
            }else{
                Tool::alertBack('非法操作');
            }
        }
       
    }
?>