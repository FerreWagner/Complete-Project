<?php 

    function arr_unique($_arr2D){   //传递二维数组
        //二维数组去重
        
        //降维，foreach
        foreach ($_arr2D as $_k){
            $_k = join(',', $_k); //根据逗号分割成一维数组
            $_temp[] = $_k;       //得到一维数组,存在重复
            
        }
        
        $_temp = array_unique($_temp);  //去除重复,一维数组，逗号相隔
        
        //再拼接成二维数组，便于后方处理
        foreach ($_temp as $_k => $_v){
            $_temp[$_k] = explode(',', $_v);    //将一维数组拼接成二维数组
        }
        return $_temp;
    }


?>