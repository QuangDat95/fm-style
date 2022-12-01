if (window.screen.availWidth > 1088) {
if (!document.layers)
document.write('<div id="divStayTopLeft" style="position:absolute" width=110>');

document.write('<layer id="divStayTopLeft"><a href="http://google.com.vn" target=_blank><img src="images/giaodien/banner_omiya.gif" border=0 width="110" height="240"></a></layer>');

if (!document.layers)
document.write('</div>');
document.write('<div id="divStayTopLeft2" style="position:absolute" width=110>');
document.write('<layer id="divStayTopLeft2"><a href="http://google.com.vn" target=_blank><img src="images/giaodien/9080.gif" border=0 width="110" height="220"></a></layer>');
if (!document.layers)
document.write('</div>'); }

function FloatTopDiv()
{  
	startX = (window.screen.availWidth-1040)/2+1024,
	startY = 1;
	var ns = (navigator.appName.indexOf("Netscape") != -1);
	var d = document;

	function ml(id)
	{
		var el=d.getElementById?d.getElementById(id):d.all?d.all[id]:d.layers[id];
		if(d.layers)el.style=el;
		el.sP=function(x,y){this.style.left=x;this.style.top=y;};
		el.x = startX;
		el.y = startY;
		return el;
	}
	window.stayTopLeft=function()
	{
		
if (document.documentElement && document.documentElement.scrollTop)
	var pY = ns ? pageYOffset : document.documentElement.scrollTop;
else if (document.body)
	var pY = ns ? pageYOffset : document.body.scrollTop;

		
		ftlObj.y += (pY + startY - ftlObj.y)/8;
		
		ftlObj.sP(ftlObj.x, ftlObj.y);
		setTimeout("stayTopLeft()", 1);
	}
	ftlObj = ml("divStayTopLeft");
	stayTopLeft();
}

function FloatTopDiv2()
{
 
	startX2 = 1,
	startY2 = 65;
	var ns = (navigator.appName.indexOf("Netscape") != -1);
	var d2 = document;

	function ml2(id)
	{
		var el=d2.getElementById?d2.getElementById(id):d2.all?d2.all[id]:d2.layers[id];
		if(d2.layers)el.style=el;
		el.sP=function(x,y){this.style.left=x;this.style.top=y;};
		el.x = startX2;
		el.y = startY2;
		
		return el;
	}
	window.stayTopLeft2=function()
	{
		
if (document.documentElement && document.documentElement.scrollTop)
	var pY2 = ns ? pageYOffset : document.documentElement.scrollTop;
else if (document.body)
	var pY2 = ns ? pageYOffset : document.body.scrollTop;

		
		ftlObj2.y += (pY2 + startY2 - ftlObj2.y)/8;
		ftlObj2.sP(ftlObj2.x, ftlObj2.y);
		
		setTimeout("stayTopLeft2()", 1);
	}
	ftlObj2 = ml2("divStayTopLeft2");
	stayTopLeft2();
}

if (window.screen.availWidth > 1024) {
FloatTopDiv();
FloatTopDiv2();
}
