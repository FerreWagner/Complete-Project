/**
 * 
 */
 
 window.onload = function(){
 	var ubb = document.getElementById('ubb');
 	var ubbimg = ubb.getElementsByTagName('img');
 	var fm = document.getElementsByTagName('form')[0];
 	var font = document.getElementById('font');
 	var html = document.getElementsByTagName('html')[0];
 	var q = document.getElementById('q');
 	var qa = q.getElementsByTagName('a');
 	
 	fm.onsubmit = function(){
 		//验证码验证
 		if(fm.code.value.length != 4){
 			alert("验证码必须为4位");
 			fm.code.value = '';	//清空
 			fm.code.focus();	//将焦点移至表单字段
 			return false;
 		}
 		
 		return true;
 	};
 	
 	qa[0].onclick = function(){
 		window.open('q.php?num=19&pic/images/tableft','q','width=400,height=400');
 	};
 	
 	
 	html.onmouseup = function(){
 		font.style.display = 'none';
 	};
 	
 	ubbimg[0].onclick = function(){
 		font.style.display = 'block';
 	};
 	ubbimg[1].onclick = function(){
 		alert('TIPS : 在所需文本前后键入[b][/b]来加粗字体');
 	};
 	
 	ubbimg[2].onclick = function(){
 		alert('TIPS : 在所需文本前后键入[i][/i]来定义斜体字体');
 	};
 	ubbimg[3].onclick = function(){
 		alert('TIPS : 在所需文本前后键入[u][/u]来定义下划线');
 	};
 	ubbimg[4].onclick = function(){
 		alert('TIPS : 在所需文本前后键入[s][/s]来定义删除线');
 	};
 	ubbimg[5].onclick = function(){
 		alert('TIPS : 在所需文本前后键入[color=#xxxxxx][/color]来定义颜色');
 	};
 	ubbimg[6].onclick = function(){
 		//var url = prompt('请输入网址','http://');
 		alert('TIPS : 在所需文本前后键入[url][/url]来定义超链接')
 	};
 	ubbimg[7].onclick = function(){
 		alert('TIPS : 在所需文本前后键入[email][/email]来定义超链接')
 	};
 	ubbimg[8].onclick = function(){
 		alert('TIPS : 在所需图片文件前后键入[img][/img]来写入图片')
 	};
 	ubbimg[9].onclick = function(){
 		alert('TIPS : 在视频链接前后键入[flash][/flash]来定义视频文件')
 	};
 	ubbimg[14].onclick = function(){
 		alert('+');
 		fm.content.rows += 2;
 	};
 	ubbimg[15].onclick = function(){
 		alert('-');
 		fm.content.rows -= 2;
 	};
 	ubbimg[16].onclick = function(){
 		alert('部分功能还未开发，请等待');
 	};
 	
 	function content(string){
 		fm.content.value += string;
 	}
 		
 };
 
  	function font(size){
 		document.getElementsByTagName('form')[0].content.value += '[size='+size+'][/size]';
 	};