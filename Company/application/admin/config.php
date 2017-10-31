<?php 
    return [
        // +----------------------------------------------------------------------
        // | 模板设置
        // +----------------------------------------------------------------------
        
        'template'               => [
            // 模板后缀
            'view_suffix'  => 'htm',
        ],
        
        'view_replace_str' =>[
            '__PUBLIC__'   => '/public/',
            '__ROOT__'     => '/',
            '__ADMIN__'    => '/ZEND/Company/public/static/admin',  //样式文件的路径(这里为相对路径)；绝对路径在主机为PC机时：http://localhost/ZEND/Company/public/static/admin
        ],
        
    ]


?>