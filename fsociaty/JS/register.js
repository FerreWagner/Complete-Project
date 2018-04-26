/**
 * 等在网页加载完毕再执行
 */

 window.onlond = function(){
 	var faceimg = document.getElementById('faceimg');
 	var code = document.getElementById('code');
 	faceimg.onclick = function(){
 		window.open('face.php','face','scrollbars=1');
 	}
 	code.onclick = function(){
 		this.src='code.php?tm='+Math.random();
 	};
 	
 	//表单验证
 	var fm = document.getElementsByTagName('form')[0];
 	
 };