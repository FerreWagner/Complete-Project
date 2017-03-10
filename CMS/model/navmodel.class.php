<?php 
    //导航实体类
    class NavModel extends Model{ //这个类是等级数据实现类
        private $id;
        private $nav_name;
        private $nav_info;
        private $pid;
        private $sort;
        private $limit;
        
        //拦截器(__set)
        public function __set($_key,$_value){
            if(!is_array($_value)){
                $this->$_key = Tool::mysqlString($_value); //$name里存的是字符串,是属性的名字,$this->$_key才是表示 对象的属性
            }else{
                $this->$_key = $_value;
            }
        }
        
        //拦截器(__get)
        public function __get($_key){
            return $this->$_key;
        }
        
        //获取所有非主类的id
        public function getAllNavChildId(){
            $_sql = "select id from cms_nav where pid!=0";
            return parent::all($_sql);
        }
        
        //获取主类下的子类的ID
        public function getNavChildId(){
            $_sql = "select id from cms_nav where pid='$this->id'";
            return parent::all($_sql);
        }
        
        //导航排序
		public function setNavSort() {
			foreach ($this->sort as $_ke=>$_value) {
				if (!is_numeric($_value)) continue;
				$_sql .= "UPDATE cms_nav SET sort='$_value' WHERE id='$_ke';";
			}
			return parent::multi($_sql);
		}
        
        //前台显示指定的主导航
        public function getFrontNav(){
            $_sql = "select id,nav_name from cms_nav where pid=0 order by sort asc limit 0,".NAV_SIZE;
            return parent::all($_sql);
        }
        
        
        //查询单个导航
        public function getOneNav(){
            $_sql = "select n1.id,n1.nav_name,n1.nav_info,n2.id iid,n2.nav_name nnav_name from cms_nav n1 left join cms_nav n2 on n1.pid=n2.id where n1.id='$this->id' or n1.nav_name='$this->nav_name' limit 1";
            return parent::one($_sql);
        }
        
        //获取主导航总记录
        public function getNavTotal(){
            $_sql = "select count(*) from cms_nav where pid=0";
            return parent::total($_sql);
        }
        
        //获取子导航总记录
        public function getNavChildTotal(){
            $_sql = "select count(*) from cms_nav where pid=$this->id";
            return parent::total($_sql);
        }
        
        
        //查询所有主导航,带limit
        public function getAllNav(){
            $_sql = "select id,nav_name,nav_info,sort from cms_nav where pid=0 order by sort asc $this->limit";
            return parent::all($_sql);
        }
        
        //查询所有主导航,不带limit
        public function getAllFrontNav(){
            $_sql = "select id,nav_name,nav_info,sort from cms_nav where pid=0 order by sort asc";
            return parent::all($_sql);
        }
        
        //查询所有子导航,带limit
        public function getAllChildNav(){
            $_sql = "select id,nav_name,nav_info,sort from cms_nav where pid=$this->id order by sort asc $this->limit";
            return parent::all($_sql);
        }
        
        //查询所有子导航,不带limit
        public function getAllChildFrontNav(){
            $_sql = "select id,nav_name,nav_info,sort from cms_nav where pid=$this->id order by sort asc";
            return parent::all($_sql);
        }
        
        //新增
        public function addNav(){
            $_sql = "insert into cms_nav(nav_name,nav_info,pid,sort) values('$this->nav_name','$this->nav_info','$this->pid',".parent::nextid('cms_nav').")";
            return parent::aud($_sql);
        }
        
        //修改
        public function updateNav(){
            $_sql = "update cms_nav set nav_name='$this->nav_name',nav_info='$this->nav_info' where id='$this->id' limit 1";
            return parent::aud($_sql);
        }
        
        //删除
        public function deleteNav(){
            $_sql = "delete from cms_nav where id='$this->id' limit 1";
            return parent::aud($_sql);
        }
        
    }
?>