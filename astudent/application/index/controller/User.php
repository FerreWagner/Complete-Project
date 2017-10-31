<?php
namespace app\index\controller;

use app\index\controller\Base;
class User extends Base
{
    public function login()
    {
        return $this->view->fetch();
    }
    
    public function checkLogin()
    {
        
    }
    
    public function logout()
    {
        
    }
    
}
