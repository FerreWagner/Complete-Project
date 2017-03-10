<?php 
    //控制器基类
    class Action{
        protected $_tpl;
        protected $_model;
    
        protected function __construct(&$_tpl,&$_model = null){ //&$_model设置为可选参数
            $this->_tpl = $_tpl;
            $this->_model = $_model;
        }
        
        protected function page($_total,$_pagesize = PAGE_SIZE){    //设置默认值，可以传选择哪个分页设置
            $_page = new Page($_total,$_pagesize); //获取总记录
            //echo $_page->total;
            $this->_model->limit = $_page->limit;
            $this->_tpl->assign('page',$_page->showpage());
            $this->_tpl->assign('num',($_page->page-1)*$_pagesize);
        }
    }

?>