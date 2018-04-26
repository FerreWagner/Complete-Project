/**
 * 
 */
 
 window.onlond = function(){
 	code();
 	var fm = document.getElementsByTagName('form')[0];
 	fm.onsubmit = function(){
 		//验证码验证
 		if(fm.code.value.length != 4){
 			alert('验证码验证必须为四位');
 			fm.code.focus();//将焦点移植表单字段
 			return false;
 		}
 	};
 };
 
 if(fm.content.value.length < 10 || fm.content.value.length > 800){
 	alert('消息内容不得小于两字大于800字');
 	fm.content.focus();//将焦点移至表单
 	//return false;
 }