<?php 
    class ManageAction extends Action{  //这个类是执行类
        
        //构造方法初始化
        public function __construct(&$_tpl){
            parent::__construct($_tpl, new ManageModel());
        }
        
        //业务流程控制器
        public function _action(){
            switch ($_GET['action']){
                case 'show':
                    $this->show();
                    break;
                case 'add':
                    $this->add();
                    break;
                case 'update':
                    $this->update();
                    break;
                case 'delete':
                    $this->delete();
                    break;
                default:
                    Tool::alertBack('非法操作');
            }
            
        }
        
        
        
        //show
        private function show(){
            parent::page($this->_model->getManageTotal());
            $this->_tpl->assign('show', true);
            $this->_tpl->assign('title', '管理员列表');
            $this->_tpl->assign('AllManage', $this->_model->getAllManage());
        }
        
        
        //add
        private function add(){
            if(isset($_POST['send'])){
                if(Validate::checkNull($_POST['admin_user'])) Tool::alertBack('用户名不得为空');
                if(Validate::checkLength($_POST['admin_user'], 2,'min')) Tool::alertBack('用户名不得小于两位');
                if(Validate::checkLength($_POST['admin_user'], 20,'max')) Tool::alertBack('用户名不得大于20位');
                if(Validate::checkNull($_POST['admin_pass'])) Tool::alertBack('密码不得为空');
                if(Validate::checkLength($_POST['admin_pass'], 2,'min')) Tool::alertBack('密码不得小于两位');
                if(Validate::checkEquals($_POST['admin_pass'], $_POST['admin_notpass'])) Tool::alertBack('密码确认不一致');
                $this->_model->admin_user = $_POST['admin_user'];
                if($this->_model->getOneManage()) Tool::alertBack('此用户已被占用');   //做相同用户处理
                $this->_model->admin_pass = sha1($_POST['admin_pass']);
                $this->_model->level = $_POST['level'];
                $this->_model->addManage() ? Tool::alertLocation('新增成功', 'manage.php?action=show') : Tool::alertBack('新增管理员失败');
            }
            $this->_tpl->assign('add', true);
            $this->_tpl->assign('title', '新增管理员');
            $this->_tpl->assign('prev_url',PREV_URL);
            $_level = new LevelModel();
            $this->_tpl->assign('AllLevel',$_level->getAllLevel());
        }
        
        //update
        private function update() {
            if(isset($_POST['send'])){
                $this->_model->id = $_POST['id'];
                if(trim($_POST['admin_pass']) == ''){
                    $this->_model->admin_pass = $_POST['pass'];
                }else{
                    if(Validate::checkLength($_POST['admin_pass'], 4, 'min')) Tool::alertBack('密码不得小于四位');
                    $this->_model->admin_pass = sha1($_POST['admin_pass']);
                }
                $this->_model->level = $_POST['level'];
                $this->_model->updateManage() ? Tool::alertLocation('修改管理员成功', $_POST['prev_url']) : Tool::alertBack('修改管理员失败');
            }
            if(isset($_GET['id'])){
                $this->_model->id = $_GET['id'];
                $_manage = $this->_model->getOneManage();   //一个简单的替代，代码更简洁
                is_object($_manage) ? true : Tool::alertBack('传值的管理员ID有误');
                $this->_tpl->assign('id',$_manage->id);
                $this->_tpl->assign('level',$_manage->level);
                $this->_tpl->assign('admin_user',$_manage->admin_user);
                $this->_tpl->assign('admin_pass',$_manage->admin_pass);
                $this->_tpl->assign('update', true);
                $this->_tpl->assign('title','修改管理员');
                $this->_tpl->assign('prev_url',PREV_URL);
                $_level = new LevelModel();
                $this->_tpl->assign('AllLevel',$_level->getAllLevel());
            }else{
                Tool::alertBack('非法操作');
            }
        }
        
        //delete
        private function delete(){
            if(isset($_GET['id'])){
                $this->_model->id = $_GET['id'];
                $this->_model->deleteManage() ? Tool::alertLocation('删除管理员成功',PREV_URL) : Tool::alertBack('删除失败');
            }else{
                Tool::alertBack('非法操作');
            }
        }
    }
?>