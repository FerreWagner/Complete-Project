<?php 
    class Page{
        private $total;         //总记录数据条数
        private $pagesize;      //每页显示多少条
        private $limit;         //limit
        private $page;          //当前页码
        private $pagenum;       //总页码
        private $url;           //地址
        private $bothnum;       //两边保持数字分页的量
        
        //构造方法,为了初始化
        public function __construct($_total,$_pagesize) {
            $this->total = $_total ? $_total : 1;   //判断是否为真(有没有值)，为真赋给他，没有则让他等于1;目的是为了不让page类出错
            $this->pagesize = $_pagesize;
            $this->pagenum = ceil($this->total / $this->pagesize);
            $this->page = $this->setPage();
            $this->limit = "limit ".($this->page-1)*$this->pagesize.",$this->pagesize";  //从0到xx条
            $this->url = $this->setUrl();
            $this->bothnum = 2; //初始化页码两边的量
        }
        
        //拦截器
        public function __get($_key){
            return $this->$_key;
        }
        
        //获取当前页码
        private function setPage(){
            if(!empty($_GET['page'])){
                if($_GET['page'] > 0){
                    if($_GET['page'] > $this->pagenum){
                        return $this->pagenum;
                    }else{
                        return $_GET['page'];
                    }
                }else{
                    return 1;
                }
            }else{
                return 1;
            }
        }
        
        //获取地址
        private function setUrl(){
            $_url = $_SERVER["REQUEST_URI"];
            $_par = parse_url($_url);   //parse_url()函数可以解析当前url
            if(isset($_par['query'])){  //query是该函数返回的数组中的一个,$_par['query']为action=show&page=xxx
                parse_str($_par['query'],$_query);  //把重复.=后的page放在了参数$_query里(这是该函数的用法)
                unset($_query['page']);             //销毁$_query里的page=xxx
                $_url = $_url = $_par['path'].'?'.http_build_query($_query);      //path也是该函数不带任何参数的返回值之一
                //每次这样把新生成的page=xxx销毁,在下面的方法中智慧申城一个新的page=xxx,避免的重复的page=xxx而导致page出错
                //http_build_query()：把['action']=>show变成action=show
            }
            return $_url;
        }
        
        
        //数字目录
        private function pageList(){
            for($i=$this->bothnum;$i>=1;$i--){
                $_page = $this->page-$i;
                if($_page < 1) continue;    //小于1就只退出当前循环
                $_pagelist .= '<a href="'.$this->url.'&page='.$_page.'">'.$_page.'</a>';
            }
            $_pagelist .= '<span class="me">'.$this->page.'</span>';
            for($i=1;$i<=$this->bothnum;$i++){
                $_page = $this->page+$i;
                if($_page > $this->pagenum) break;  //如果这是最后一页,停止循环
                $_pagelist .= '<a href="'.$this->url.'&page='.$_page.'">'.$_page.'</a>';
            }
            return $_pagelist;
        }
        
        //首页
        private function first(){   //当前页码数大于两边指定页码时,出现xx页码...
            if($this->page > $this->bothnum+1){
                return '<a href="'.$this->url.'">1</a>...';
        
            }
        }
        
        //上一页
        private function prev(){
            if($this->page == 1){
                return '<span class="disabled">上一页</span>';
            }
            return '<a href="'.$this->url.'&page='.($this->page-1).'">上一页</a>';
        }
        
        //下一页
        private function next(){
            if($this->page == $this->pagenum){
                return '<span class="disabled">下一页</span>';
            }
            return '<a href="'.$this->url.'&page='.($this->page+1).'">下一页</a>';
        }
        
        //尾页
        private function last(){
            if($this->pagenum - $this->page > $this->bothnum){  //当总页码-当前页码大于指定的相隔页码,则出现...xxx页码
                return '...<a href="'.$this->url.'&page='.$this->pagenum.'">'.$this->pagenum.'</a>';
            }
        }
        
        //分页信息
        public function showpage(){
            //不能用page作为方法名,看这个类名,懂了吧?那就会变成构造方法了page.class.php和page()？？？
            @$_page .= $this->first();
            @$_page .= $this->pageList();
            $_page .= $this->last();
            $_page .= $this->prev();
            $_page .= $this->next();
            return $_page;
        }
        
    }
?>