<?php 
    class LevelAction extends Action{   //这个类是等级执行类
        
        //构造方法初始化
        public function __construct(&$_tpl){
            parent::__construct($_tpl, new LevelModel());   //这里很重要，在自动调用创建的对象后,覆盖了一层这样的语句,并重新创建levelmodel对象，使用他的id
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
            parent::page($this->_model->getLevelTotal());
            $this->_tpl->assign('show', true);
            $this->_tpl->assign('title', '等级列表');
            $this->_tpl->assign('AllLevel', $this->_model->getAllLimitLevel());
        }
        
        
        //add
        private function add(){
            if(isset($_POST['send'])){
                if(Validate::checkNull($_POST['level_name'])) Tool::alertBack('等级名称不得为空');
                if(Validate::checkLength($_POST['level_name'], 2,'min')) Tool::alertBack('等级名称不得小于两位');
                if(Validate::checkLength($_POST['level_name'], 20,'max')) Tool::alertBack('等级名称不得大于20位');
                if(Validate::checkLength($_POST['level_info'], 200,'max')) Tool::alertBack('等级描述不得大于200位');
                $this->_model->level_name = $_POST['level_name'];
                if($this->_model->getOneLevel()) Tool::alertBack('此等级名已存在');
                $this->_model->level_info = ($_POST['level_info']);
                $this->_model->addLevel() ? Tool::alertLocation('新增成功', 'level.php?action=show') : Tool::alertBack('新增失败');
            }
            $this->_tpl->assign('add', true);
            $this->_tpl->assign('title', '新增等级');
            $this->_tpl->assign('prev_url',PREV_URL);
        }
        
        //update
        private function update() {
            if(isset($_POST['send'])){
                if(Validate::checkNull($_POST['level_name'])) Tool::alertBack('等级名称不得为空');
                if(Validate::checkLength($_POST['level_name'], 2,'min')) Tool::alertBack('等级名称不得小于两位');
                if(Validate::checkLength($_POST['level_name'], 20,'max')) Tool::alertBack('等级名称不得大于20位');
                if(Validate::checkLength($_POST['level_info'], 200,'max')) Tool::alertBack('等级描述不得大于200位');
                $this->_model->id = $_POST['id'];
                $this->_model->level_name = $_POST['level_name'];
                $this->_model->level_info = $_POST['level_info'];
                $this->_model->updateLevel() ? Tool::alertLocation('修改等级成功', $_POST['prev_url']) : Tool::alertBack('修改等级失败');
            }
            if(isset($_GET['id'])){
                $this->_model->id = $_GET['id'];
                $_level = $this->_model->getOneLevel(); //一个简单的替代，代码更简洁
                is_object($_level) ? true : Tool::alertBack('传值的等级ID有误');
                $this->_tpl->assign('id',$_level->id);
                $this->_tpl->assign('level_name',$_level->level_name);
                $this->_tpl->assign('level_info',$_level->level_info);
                $this->_tpl->assign('prev_url',PREV_URL);
                $this->_tpl->assign('update', true);
                $this->_tpl->assign('title', '修改等级');
            }else{
                Tool::alertBack('非法操作');
            }
        }
        
        //delete
        private function delete(){
            if(isset($_GET['id'])){
                $this->_model->id = $_GET['id'];
                $_manage = new ManageModel();
                $_manage->level = $this->_model->id;
                if($_manage->getOneManage()) Tool::alertBack('此等级存在管理员使用,请先删除相关用户');    //这三句作用：已经有用户占用等级，避免误删
                $this->_model->deleteLevel() ? Tool::alertLocation('删除等级成功',PREV_URL) : Tool::alertBack('删除失败');
            }else{
                Tool::alertBack('非法操作');
            }
        }
    }
?>