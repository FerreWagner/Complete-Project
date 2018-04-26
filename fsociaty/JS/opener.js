/**
 * 
 */

window.onload = function(){
	var img = document.getElementsByTagName('img');
	for(i=0;i<img.length;i++){
		img[i].onclick = function(){
			_opener(this.src);
		};
	}
};
function _opener(src){
	//opener表示父窗口， .document表示文档
	var faceimg = opener.document.getElementByld('faceimg');
	faceimg.src = src;
	
}