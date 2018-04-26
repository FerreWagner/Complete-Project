/**
 * 
 */
 window.onload = function(){
 	var up = document.getElementById('up');
 	up.onclick = function(){
 		centerWindow('upimg.php?dir='+this.title,'up','400','600');
 	};
 	var fm = document.getElementsByTagName('form')[0];
 	fm.onsubmit = function(){
 	
 		
 		if(fm.name.value.length < 2 || fm.name.value.length > 40){
 			alert('图片名称不得小于2位或大于20位');
 			fm.title.value = '';//清空
 			fm.title.focus();//将焦点移至表单字段
 			return false;
 		}
 		
 			if(fm.url.value == ''){
 			alert('地址不得为空');
 			fm.url.focus();//将焦点移至表单字段
 			return false;
 		}
 		
 		
 		
 		return true;
 	};
 };
 
 function centerWindow(url,name,height,width){
 	var left = (screen.width - width)/2;
 	var top = (screen.height - height)/2;
 	window.open(url,name,'height='+height+',width='+width+',top='+top+',left='+left);
 }