// JavaScript Document by Richbox
function initTree(t) {
	var tree=document.getElementById(t);
	var lis=tree.getElementsByTagName("li");
	//alert(lis.length);
	for(var i=0;i<lis.length;i++) {
		lis[i].nu=i;
		lis[i].onclick=function() {
			for(var j=0;j<lis.length;j++) {
				if(j==this.nu) {
					this.className="select";
					document.body.focus();
				} else {
					lis[j].className="";
				}
			}
		}
	}
}
function openTag(a,t) {
	if(t.style.display=="block") {
		t.style.display="none";
		a.className="folder";
	} else {
		t.style.display="block";
		a.className="";
	}
}
window.onload=function() {
	initTree("globalNav");
}