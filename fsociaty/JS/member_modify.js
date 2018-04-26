window.onlond = function(){
	code();
	//表单验证
	var fm = document.getElementsByTagName('form')[0];
	fm.onsubmit = function(){
		alert('验证错误');
	};
};