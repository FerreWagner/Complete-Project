<?php 
    //管理员实体类
    class ManageModel extends Model{    //这个类是数据实现类
        private $admin_user;
        private $admin_pass;
        private $id;
        private $level;
        private $last_ip;
        private $limit;
        
        //拦截器(__set)
        public function __set($_key,$_value){
            $this->$_key = Tool::mysqlString($_value); //$name里存的是字符串,是属性的名字,$this->$_key才是表示 对象的属性
            
            #倘若你的对象变量赋值是这样写的p1->name="OK";通过__set 函数处理之后$_key的值就等于‘name’，所以$this->$_key 这句代码就等同于$this->name.
        
            #__get()方法：这个方法用来获取私有成员属性值的,有一个参数，参数传入你要获取的成员属性的名称，返回获取的属性值，这个方法不用我们手工的去调用，因为我们也可以把这个方法做成私有的方法，是在直接获取私有属性的时候对象自动调用的。因为私有属性已经被封装上了，是不能直接获取值的（比如：“echo $p1->name”这样直接获取是错误的），但是如果你在类里面加上了这个方法，在使用“echo $p1->name”这样的语句直接获取值的时候就会自动调用__get($property_name)方法，将属性name传给参数$property_name，通过这个方法的内部执行，返回我们传入的私有属性的值。如果成员属性不封装成私有的，对象本身就不会去自动调用这个方法。
            #__set()方法：这个方法用来为私有成员属性设置值的，有两个参数，第一个参数为你要为设置值的属性名，第二个参数是要给属性设置的值，没有返回值。这个方法同样不用我们手工去调用，它也可以做成私有的，是在直接设置私有属性值的时候自动调用的，同样属性私有的已经被封装上
            #了，如果没有__set()这个方法，是不允许的，比如：$this->name=‘zhangsan’,这样会出错，但是如果你在类里面加上了__set($property_name, $value)这个方法，在直接给私有属性赋值的时候，就会自动调用它，把属性比如name传给$property_name,把要赋的值“zhangsan”传给$value，通过这个方法的执行，达到赋值的目的。如果成员属性不封装成私有的，对象本身就不会去自动调用这个方法。为了不传入非法的值，还可以在这个方法给做一下判断。
        }
        
        //拦截器
        public function __get($_key){
            return $this->$_key;
        }
        
        //查询所有的等级,已删除,levelmodel中有该方法
        
        
        
        //设置管理员的登录统计:次数、IP、时间等等
        public function setLoginCount(){
            $_sql = "update cms_manage set login_count=login_count+1,last_ip='$this->last_ip',last_time=NOW() where admin_user='$this->admin_user' limit 1";
            return parent::aud($_sql);
        }
        
        
        //获取管理员总记录
        public function getManageTotal(){
            $_sql = "select count(*) from cms_manage";
            return parent::total($_sql);
        }
        
        //查询登录管理员
        public function getLoginManage(){
            $_sql = "select m.admin_user,l.level_name from cms_manage m,cms_level l where m.admin_user='$this->admin_user' and m.admin_pass='$this->admin_pass' and m.level=l.id limit 1";
            return parent::one($_sql);
        }
        
        //查询单个管理员
        public function getOneManage(){
            $_sql = "select id,admin_user,admin_pass,level from cms_manage where id='$this->id' or admin_user='$this->admin_user' or level='$this->level' limit 1";
            return parent::one($_sql);
        }
        
        //查询所有管理员
        public function getAllManage(){
            //sql
            $_sql = "select m.id,m.admin_user,m.login_count,m.last_ip,m.last_time,m.reg_time,l.level_name from cms_manage m,cms_level l where l.id=m.level order by m.id desc $this->limit";
            return parent::all($_sql);
        }
        
        //新增管理员
        public function addManage(){
            $_sql = "insert into cms_manage(admin_user,admin_pass,level,reg_time) values('$this->admin_user','$this->admin_pass','$this->level',NOW())";
            return parent::aud($_sql);
        }
        
        //修改管理员
        public function updateManage(){
            $_sql = "update cms_manage set admin_pass='$this->admin_pass',level='$this->level' where id='$this->id' limit 1";
            return parent::aud($_sql);
        }
        
        //删除管理员
        public function deleteManage(){
            $_sql = "delete from cms_manage where id='$this->id' limit 1";
            return parent::aud($_sql);
        }
    }
?>