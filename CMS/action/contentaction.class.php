<?php 
    class ContentAction extends Action{   //这个类是等级执行类
        
        
        //构造方法初始化
        public function __construct(&$_tpl){
            parent::__construct($_tpl, new ContentModel());   //这里很重要，在自动调用创建的对象后,覆盖了一层这样的语句,并重新创建levelmodel对象，使用他的id
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
            $this->_tpl->assign('show', true);
            $this->_tpl->assign('title', '文档列表');
            $this->nav();   //调用option方法，使之有下拉菜单
            
            $_nav = new NavModel();
            
            if(empty($_GET['nav'])){
                $_id = $_nav->getAllNavChildId();   //获取所有非主类的id
                $this->_model->nav = Tool::objArrOfStr($_id, 'id');
            }else{
                $_nav->id = $_GET['nav'];
                if(!$_nav->getOneNav()) Tool::alertBack('类别参数传输错误');    //找不到url里get的数据，就肯定没有，提示传输错误；以免报错
                $this->_model->nav = $_nav->id;
            }
            
            parent::page($this->_model->getListContentTotal());     //按照getlist...方法查出来的数据，进行分页
            
            $_object = $this->_model->getListContent(); //简化代码
            $_object = Tool::subStr($_object, 'title', 20, 'utf-8');
            
            $this->_tpl->assign('SearchContent',$_object);
        }
        
        //button可以实现局部提交、刷新;而submit只能提交表单
        
        //add
        private function add(){
            if(isset($_POST['send'])){
                
                $this->getPost();   //拿到数据的方法
                
                $this->_model->addContent() ? Tool::alertLocation('文档发布成功', '?action=show') : Tool::alertBack('文档发布失败');
            }
            $this->_tpl->assign('add', true);
            $this->_tpl->assign('title', '新增文档');
            
            $this->nav();   //访问nav方法，用来操作复选框
            
            $this->_tpl->assign('author',$_SESSION['admin']['admin_user']);
        }
        
        //update
        private function update() {
            if(isset($_POST['send'])){
                $this->_model->id = $_POST['id'];   //拿到在模板里隐藏字段的id
                $this->getPost();   //拿到取数据的方法
                //执行修改
                $this->_model->updateContent() ? Tool::alertLocation('文档修改成功', $_POST['prev_url']) : Tool::alertBack('文档修改失败');
            }
            if(isset($_GET['id'])){
                $this->_tpl->assign('update', true);
                $this->_tpl->assign('title', '修改文档');
                $this->_model->id = $_GET['id'];
                $_content = $this->_model->getOneContent();
                if($_content){
                    $this->_tpl->assign('id',$_content->id);    //注入id值，以免发生不存在错误
                    $this->_tpl->assign('titlec',$_content->title); //注入这些变量，在tpl模板中显示
                    $this->_tpl->assign('tag',$_content->tag);
                    $this->_tpl->assign('keyword',$_content->keyword);
                    $this->_tpl->assign('thumbnail',$_content->thumbnail);
                    $this->_tpl->assign('source',$_content->source);
                    $this->_tpl->assign('author',$_content->author);
                    $this->_tpl->assign('content',$_content->content);
                    $this->_tpl->assign('info',$_content->info);
                    $this->_tpl->assign('count',$_content->count);
                    $this->_tpl->assign('gold',$_content->gold);
                    $this->_tpl->assign('prev_url',PREV_URL);   //设置一个前一页的前一页的参数(在模板文件中注入)，为用户修改后返回到前一界面，更友好
                    $this->nav($_content->nav);
                    $this->attr($_content->attr);
                    $this->color($_content->color);
                    $this->sort($_content->sort);
                    $this->readlimit($_content->readlimit);
                    $this->commend($_content->commend);
                }else{
                    Tool::alertBack('不存在此文档');  //用getonecontent拿不到数据，就不存在}
                }
            }else{
                Tool::alertBack('非法操作');
            }
        }
        
        //delete
        private function delete(){
            if(isset($_GET['id'])){
               $this->_model->id = $_GET['id']; 
               $this->_model->deleteContent() ? Tool::alertLocation('文档删除成功', PREV_URL) : Tool::alertBack('文档删除失败');
            }else{
                Tool::alertBack('非法操作');
            }
        }
        
        //getcontent提交数据方法,为了减少代码量
        private function getPost(){
            if(Validate::checkNull($_POST['title'])) Tool::alertBack('标题不得为空');
            if(Validate::checkLength($_POST['title'], 2, 'min')) Tool::alertBack('标题长度不得小于两位');
            if(Validate::checkLength($_POST['title'], 50, 'max')) Tool::alertBack('标题长度不得大于50位');
            if(Validate::checkNull($_POST['nav'])) Tool::alertBack('请选择栏目');
            if(Validate::checkLength($_POST['tag'], 30, 'max')) Tool::alertBack('TAG标签长度不得大于30位');
            if(Validate::checkLength($_POST['keyword'], 30, 'max')) Tool::alertBack('关键字长度不得大于30位');
            if(Validate::checkLength($_POST['source'], 20, 'max')) Tool::alertBack('文章来源长度不得大于20位');
            if(Validate::checkLength($_POST['author'], 10, 'max')) Tool::alertBack('作者长度不得大于10位');
            if(Validate::checkLength($_POST['info'], 200, 'max')) Tool::alertBack('内容摘要不得大于200位');
            if(Validate::checkNull($_POST['content'])) Tool::alertBack('详细内容不得为空');
            if(Validate::checkNum($_POST['count'])) Tool::alertBack('浏览次数必须为数字');
            if(Validate::checkNum($_POST['gold'])) Tool::alertBack('消费金币必须为数字');
            
            if(isset($_POST['attr'])){
                $this->_model->attr = implode(',', $_POST['attr']);
            }else{
                $this->_model->attr = '无';
            }
            $this->_model->title = $_POST['title'];
            $this->_model->nav = $_POST['nav'];
            $this->_model->info = $_POST['info'];
            $this->_model->source = $_POST['source'];
            $this->_model->keyword = $_POST['keyword'];
            $this->_model->thumbnail = $_POST['thumbnail'];
            $this->_model->author = $_POST['author'];
            $this->_model->tag = $_POST['tag'];
            $this->_model->content = $_POST['content'];
            $this->_model->commend = $_POST['commend'];
            $this->_model->count = $_POST['count'];
            $this->_model->gold = $_POST['gold'];
            $this->_model->color = $_POST['color'];
            $this->_model->sort = $_POST['sort'];
            $this->_model->readlimit = $_POST['readlimit'];
        }
        
        //commend方法
        private function commend($_commend){
            $_commendArr = array(0=>'禁止评论',1=>'允许评论');
            foreach ($_commendArr as $_key=>$_value){
                if($_key == $_commend) $_checked='checked=checked';    //当取到值，即red=red后，将其选定
                @$_html .= '<input type="radio" '.$_checked.' name="commend" value="'.$_key.'" />'.$_value;
                $_checked = '';
            }
            $this->_tpl->assign('commend',$_html);
        }
        
        //sort方法
        private function sort($_sort){
            $_sortArr = array(0=>'默认排序',1=>'置顶一天',2=>'置顶一周',3=>'置顶一个月',4=>'置顶一年');
            foreach ($_sortArr as $_key=>$_value){
                if($_key == $_sort) $_selected='selected=selected';    //当取到值，即red=red后，将其选定
                @$_html .= '<option '.$_selected.' value="'.$_key.'" style="color: '.$_key.'">'.$_value.'</option>';
                $_selected = '';    //循环后要清空，不然会出错;其他时候就不选定
            }
            $this->_tpl->assign('sort',$_html);
        }
        
        //readlimit方法
        private function readlimit($_readlimit){
            $_readlimitArr = array(0=>'开放浏览',1=>'初级会员',2=>'中级会员',3=>'高级会员',4=>'VIP会员');
            foreach ($_readlimitArr as $_key=>$_value){
                if($_key == $_readlimit) $_selected='selected=selected';    //当取到值，即red=red后，将其选定
                @$_html .= '<option '.$_selected.' value="'.$_key.'">'.$_value.'</option>';
                $_selected = '';    //循环后要清空，不然会出错;其他时候就不选定
            }
            $this->_tpl->assign('readlimit',$_html);
        }
        
        //color方法
        private function color($_color){
            $_colorArr = array(''=>'默认颜色','red'=>'红色','blue'=>'蓝色','orange'=>'橙色');
            foreach ($_colorArr as $_key=>$_value){
                if($_key == $_color) $_selected='selected=selected';    //当取到值，即red=red后，将其选定
                @$_html .= '<option '.$_selected.' value="'.$_key.'" style="color: '.$_key.'">'.$_value.'</option>';
                $_selected = '';    //循环后要清空，不然会出错;其他时候就不选定
            }
            $this->_tpl->assign('color',$_html);
        }
        
        //attr方法
        private function attr($_attr){
            $_attrArr = array('头条','推荐','加粗','跳转');
            $_attrS = explode(',', $_attr);             //用逗号切割成数组
            $_attrNo = array_diff($_attrArr, $_attrS);  //做一个数组的差集,除了在$_attrArr里拥有的所有字符
            if($_attrS[0] != '无'){
                foreach($_attrS as $_value){
                    @$_html .= '<input type="checkbox" checked="checked" name="attr[]" value="'.$_value.'" />'.$_value;
                }
            }
            foreach ($_attrNo as $_value){
                @$_html .= '<input type="checkbox" name="attr[]" value="'.$_value.'" />'.$_value;
            }
            $this->_tpl->assign('attr',$_html); //将拿到的属注入到tpl模板中
        }
        
        //nav
        private function nav($_n = 0){  //参数n用来传固定的id值，如上面要用的指定子类id
            $_nav = new NavModel();
            foreach ($_nav->getAllFrontNav() as $_object){
                @$_html .= '<optgroup label="'.$_object->nav_name.'">'."\r\n";
                $_nav->id = $_object->id;
                if(!!$_childnav = $_nav->getAllChildFrontNav()){    //赋值简化代码,也更安全
                    foreach ($_childnav as $_object){
                        if($_n == $_object->id) $_selected = 'selected="selected"'; //当传的值等于子类的id时,将seleted默认赋给该值
                            $_html .= '<option '.@$_selected.' value="'.$_object->id.'">'.$_object->nav_name.'</option>'."\r\n";
                            $_selected = '';
                    }
                }
                $_html .= '</optgroup>';
            }
            $this->_tpl->assign('nav',$_html);
        }
        
    }
?>