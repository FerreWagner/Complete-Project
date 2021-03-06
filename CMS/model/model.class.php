<?php 
    //模型基类
    class Model{    //进行数据库原始操作的基类
        
    //执行多条SQL语句
		public function multi($_sql) {
			$_db = DB::getDB();
			$_db->multi_query($_sql);
			DB::unDB($_result = null, $_db);
			return true;
		}
        
        //获取下一个增值id模型
        public function nextid($_table){
            $_sql = "show table status like '$_table'";
            $_object = $this->one($_sql);
            return $_object->Auto_increment;
        }
        
        //查找总记录模型
        protected function total($_sql){
            $_db = DB::getDB();
            $_result = $_db->query($_sql);
            $_total = $_result->fetch_row();
            DB::unDB($_result, $_db);
            return $_total[0];
        }
        
        //查找单个数据模型
        protected function one($_sql){
            $_db = DB::getDB();
            //获取结果集
            $_result = $_db->query($_sql);
            $_objects = $_result->fetch_object();
            DB::unDB($_result, $_db);
            return Tool::htmlString($_objects);
        }
        
        //查找多个数据模型
        protected function all($_sql){
            $_db = DB::getDB();
            //获取结果集
            $_result = $_db->query($_sql);
            $_html = array();
            while(!!$_objects = $_result->fetch_object()){
                $_html[] = $_objects;
            }
            DB::unDB($_result, $_db);
            return Tool::htmlString($_html);
        }
        
        //增删修模型
        protected function aud($_sql){
            $_db = DB::getDB();
            $_db->query($_sql);
            $_affected_rows = $_db->affected_rows;
            DB::unDB($_result = null, $_db);
            return $_affected_rows;
        }
    }

?>