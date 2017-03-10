<?php 
    //等级实体类
    class LevelModel extends Model{ //这个类是等级数据实现类
        private $id;
        private $level_name;
        private $level_info;
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
        
        //获取等级总记录
        public function getLevelTotal(){
            $_sql = "select count(*) from cms_level";
            return parent::total($_sql);
        }
        
        
        //查询单个
        public function getOneLevel(){
            $_sql = "select id,level_name,level_info from cms_level where id='$this->id' or level_name='$this->level_name' limit 1";
            return parent::one($_sql);
        }
        
        //查询所有等级，不带limit
        public function getAllLevel(){
            //sql
            $_sql = "select id,level_name,level_info from cms_level order by id desc";
            return parent::all($_sql);
        }
        
        //查询所有等级,带limit
        public function getAllLimitLevel(){
            $_sql = "select id,level_name,level_info from cms_level order by id desc $this->limit";
            return parent::all($_sql);
        }
        
        //新增
        public function addLevel(){
            $_sql = "insert into cms_level(level_name,level_info) values('$this->level_name','$this->level_info')";
            return parent::aud($_sql);
        }
        
        //修改
        public function updateLevel(){
            $_sql = "update cms_level set level_name='$this->level_name',level_info='$this->level_info' where id='$this->id' limit 1";
            return parent::aud($_sql);
        }
        
        //删除管理员
        public function deleteLevel(){
            $_sql = "delete from cms_level where id='$this->id' limit 1";
            return parent::aud($_sql);
        }
    }
?>