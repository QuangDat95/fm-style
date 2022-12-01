var ketqua ='' ;
var ilan = 0;
var capnhap = '' ; 

function huongdan() 
{
 if ( document.getElementById('hthuongdan').style.display == '' )
 {
    document.getElementById('hthuongdan').style.display = 'none' ;
	document.getElementById('codechinh').style.display = '' ;		
 } 
    else 
 {
    document.getElementById('hthuongdan').style.display = '' ;
	document.getElementById('codechinh').style.display = 'none' ;		
 }
 
}

function dong() 
{
        window.close();
}
function matdinh() 
{
    window.open('default.php?act=md',"_self")
}
function thongbao(tb) 
{
 
 var n = confirm(tb);
 return n ;
}
function xulyxong(xuly) 
{
 	if (xuly == 'xuly')	{  xulychung() ;  return ;	} 	
	var tam ; tam=xuly+'();';
	eval(tam); return ;
 }
 
function loadhuongdan(ten) 
{
  
  poststr="DATA="+   encodeURIComponent(ten)+  "*@!"+ encodeURIComponent("0")+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0);
  loadtrang('hthuongdan',"huongdan", poststr,"") ;	
}
//===========di chuyem form==========================
 var cursor = {x:0, y:0};
 var  dragobj=null, h1, i1, oLeft, oTop;
function rel(ob){if(ob){return document.getElementById(ob)}else{return null}}

function gTxt(ob,txt){rel(ob).innerHTML=txt;}

function dinhdangngay(ngayvao,kieu)
 {
	 var tam = ngayvao.split('-') ;
	 if (kieu == 'dmy')  return tam[2] + '/' + tam[1] + '/' + tam[0] ;
	 if (kieu == 'ymd')  return tam[0] + '/' + tam[1] + '/' + tam[2] ;
 }

function makeObjectToDrag(obj){
 
obj = document.getElementById(obj) ;
   if(obj){
	  
  dragobj = rel(obj.id);


  document.onmousedown=startMove;
  document.onmouseup = drop;
  document.onmousemove = moving;

 }
}
function startMove(e){
  if(dragobj){
	getCursorPos(e);
//	dragobj.className="moving";
    i1=cursor.x- dragobj.offsetLeft;
	h1=cursor.y- dragobj.offsetTop ;
 
  }
}
function drop(){
  if(dragobj){
	dragobj.className="move";
    dragobj = null;
  }
}
function getCursorPos(e) {
    e = e || window.event;
    if (e.pageX || e.pageY) {
        cursor.x = e.pageX;
        cursor.y = e.pageY;
    } 
    else {
        var de = document.documentElement;
        var db = document.body;
        cursor.x = e.clientX + 
            (de.scrollLeft || db.scrollLeft) - (de.clientLeft || 0);
        cursor.y = e.clientY + 
            (de.scrollTop || db.scrollTop) - (de.clientTop || 0);
    }
	return cursor;
}
function moving(e){
	getCursorPos(e);
	if(dragobj){
		oLeft=cursor.x-i1;
		oTop=cursor.y-h1;
	dragobj.style.left = oLeft + 'px';
    dragobj.style.top  = oTop + 'px';
	}
}
 

//======================================
function submittk()
{
   if (capnhap != '') { return false ;}
  }
function setrong()
{ 
capnhap = ''
}
function al(event)
{
	alert(event.keyCode );
}
function doiphim(event,tieptheo,ketruoc)
{ 

}
function chuyentieps(event,tieptheo)
{ 
  capnhap = tieptheo ;
   if (  event.keyCode == 38)
   {

   }
    else if  (  event.keyCode == 40) 
   {
	    event.keyCode = 9 ;
   }
   else if (  event.keyCode == 13) 
  { 
       	document.getElementById(tieptheo).focus();
		 event.keyCode = '' ;
		 event.returnValue = false 
   } 
}

function chuyentiepo(event,tieptheo)
{ 
  capnhap = tieptheo ;
   if (  event.keyCode == 38)
   {

   }
    else if  (  event.keyCode == 40) 
   {
	    event.keyCode = 9 ;
   }
   else if (  event.keyCode == 13) 
  { 
       	document.getElementById(tieptheo).focus();
		 event.keyCode = '' ;
   } 
}

function timtrongmang(mang,giatri)
 {
   var t =0 ;
   var a,b ;
   	b= giatri.toLowerCase();
	for (x in mang)
	{
	a= 	trim(mang[x].toLowerCase());
	 if (a == b ) return x ;
	}
	return "" ;	 
 }
 
  function setidxetuso(tenselec,text)
 { var t =0 ;
   var a,b ;
   b= trim(text.toLowerCase());
	for (x in tenselec)
	{
	a= 	trim(x.toLowerCase());	
	 if (a == b ) return tenselec[x] ;
	}
	return "" ;
 }
function kiemtraxe(ob)
{
	// co mangj[id] = "soxe" 
	
	var k = ob.value.toLowerCase() ;	// k so xe nhap vao
    var ch,cl,n ;
	var l = k.length ;
//	k= "12345678";	
//	alert(k.substring(2,k.length));

	for (x in mangj)  //  x so xe trong data
	{
		//ch =mangj[x].toLowerCase() ;
		ch = x.toLowerCase() ;	 
		if (ch.indexOf(k) == 0)
		{   
 		//  alert(mangj[x]);
		   n =  x.substring(0,l) ;
		   cl =  x.substring(l,(x.length)) ;
		   ob.value = n + cl ;
		//  boiden(ob,l,mangj[x].length);
		if (ob.setSelectionRange) {
			ob.setSelectionRange(l,x.length) ;
		}else boiden(ob,l,x.length);		  
		 //  alert(mangj[x]);
			return ;
		}
	}
}

function boiden(input,selectionStart, selectionEnd)
 {
	 
 	if (input.setSelectionRange) {
	input.focus();
	input.setSelectionRange(selectionStart, selectionStart);
	
	}
	else if (input.createTextRange) {
	var range = input.createTextRange();
	range.collapse(true);
	range.moveEnd('character', selectionEnd);
	range.moveStart('character', selectionStart);
	range.select();
	}
}


function chuyentiep(event,tieptheo)
{ // alert(event.keyCode);
  capnhap = tieptheo ;
   if (  event.keyCode == 13) 
  { 
  
	    document.getElementById(tieptheo).select() ;
     	document.getElementById(tieptheo).focus();
		 event.keyCode = '' ;
   } 
}
function kiemtratrung(id,t1,t2,t3,tb1,tb2,ob)
{
	   if ( trim(t3)== '')  { return  ;} ;  
 	  var t =  new Date().getTime(); 
 	   poststr="DATA="+   encodeURIComponent(t1) +   "*@!"+ encodeURIComponent(t2)+   "*@!"+ encodeURIComponent(t3) + "*@!"+ id + "*@!"+ t; 
 
   	var xmlHttp = GetXmlHttpObject();
	xmlHttp.onreadystatechange = function() {
		if (xmlHttp.readyState==4) 
		{ 
			if ( xmlHttp.status==200) 
			{
 			ketqua = xmlHttp.responseText+"" ;
            
			
			if  (parseFloat(ketqua) == 1 )
			    {	
						alert(tb1) ; if (ob != '') { document.getElementById(ob).focus(); return ; }; 	
				}
	 
 			ilan = 0 ;
			xmlHttp=null;
		    }
			else 
			{     
			     
			      ilan = ilan +1 ;
				  if (ilan <= 3) {  kiemtratrung(id,t1,t2,t3,tb1,tb2,ob) ;} else 
				   {// alert(tb2) ;
				      ilan = 0 ; if (ob != '') { document.getElementById(ob).focus() };  return ;}
			}
		}
		else {  
			// document.getElementById(divNeed).innerHTML="<img name='loading' src='images/loading.gif' />Loading ......";
		}
	};
	
	xmlHttp.open('POST', "kiemtratrung"+".php", true);
 	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", poststr.length);
	xmlHttp.setRequestHeader("Connection", "close");
	xmlHttp.send(poststr);
	   
}
function xemtintuc(id,hienthi)
{
	   poststr="DATA="+    encodeURIComponent(id) +   "*@!"+ encodeURIComponent(id_user); 
       loadtrang(hienthi, "xemtintuc", poststr,"");
	   
}

function duadulieuvaoif(ifr,data)
{
	var editor = document.getElementById(ifr).contentWindow. document;
	editor.designMode='On';
	editor.open();
	editor.write(data);
	editor.close(); 
}
function mangthanhchuoi(mang) 
{
   var x,t,k,ch = '';
   for (x in mang)
	{
	  if (ch != '')	  {ch = ch  + "|@|" ;}
	   t = 0 ;
	   ch = ch + x+ "|*|" ;
	   for ( k in mang[x] )
	   { 	
	     if (t==0) {ch = ch  + mang[x][k] ;t=1;   }else { ch = ch +'|*|' + mang[x][k] ; }
	   }
  	}
	return(ch);
}


function GetXmlHttpObject() {
	var xmlHttp=null;
	try {
	xmlHttp=new XMLHttpRequest();
	} catch (e) {
		try {
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
	}
	return (xmlHttp);
}
 function loaddong(divNeed, url, parameters,xuly) {
	var luucu = document.getElementById(divNeed).innerHTML ;

	var xmlHttp = GetXmlHttpObject();
	xmlHttp.onreadystatechange = function() {
		if (xmlHttp.readyState==4) 
		{ 
			if ( xmlHttp.status==200) 
			{
		  	document.getElementById(divNeed).innerHTML=xmlHttp.responseText;
			xulyxong(xuly);
			xmlHttp=null;
			 return ;
		    }
			else 
			{  
			 //     alert('vui long lam lai.'); 
				//  document.getElementById(divNeed).innerHTML= luucu ;
				 
				  ilan = ilan +1 ;
				  if (ilan <= 3) {  loaddong(divNeed, url, parameters,xuly);} else {
					  //alert('Co loi tren duong truyen !!!') ;
					  ilan = 0 ;    return ;}
			}
		}
		else {
			 
		}
	};
	xmlHttp.open('POST', url+".php", true);
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", parameters.length);
	xmlHttp.setRequestHeader("Connection", "close");
	xmlHttp.send(parameters);
}

function submittrang(divNeed, url,xuly) {
	var luucu = document.getElementById(divNeed).innerHTML ;
	var xmlHttp = GetXmlHttpObject();
	xmlHttp.onreadystatechange = function() {
		if (xmlHttp.readyState==4) 
		{ 
			if ( xmlHttp.status==200) 
			{
		  	 if ( divNeed != '') { document.getElementById(divNeed).innerHTML=xmlHttp.responseText;}
			ketqua = xmlHttp.responseText ;
			xulyxong(xuly);
			xmlHttp=null;
			 return ;
		    }
			else 
			{  
  	        	  ilan = ilan +1 ;
				  if (ilan <= 3) {  submittrang(divNeed, url,xuly) ; } else {
 					  ilan = 0 ;    return ;}				  
			}
		}
		else {
			  if ( divNeed != '') {document.getElementById(divNeed).innerHTML="<img name='loading' src='images/loading.gif' />Loading ......";}
		}
	};
 
	xmlHttp.open('POST', document.forms[url].submit(), true);
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");	
	xmlHttp.setRequestHeader("Connection", "close");	
	xmlHttp.send(null);

 

}
var requests = [];
function loadtrang(divNeed, url, parameters,xuly) {
	if (trim(divNeed) == "") { divNeed = "not" ; }
	var luucu = document.getElementById(divNeed).innerHTML ;

	var xmlHttp = GetXmlHttpObject();
	requests.push(xmlHttp);
	xmlHttp.onreadystatechange = function() {
		if (xmlHttp.readyState==4) 
		{ 
			if ( xmlHttp.status==200) 
			{
		  	 if ( divNeed != '') { document.getElementById(divNeed).innerHTML=xmlHttp.responseText;}   
			ketqua = xmlHttp.responseText ;
			xulyxong(xuly);
			xmlHttp=null;
			 return ;
		    }
			else 
			{  
 			     // alert('vui long lam lai.'); 
				 // document.getElementById(divNeed).innerHTML= luucu ;
 	        	 // ilan = ilan +1 ;
				  //if (ilan <= 3) {  loadtrang(divNeed, url, parameters,xuly) ; } else {
					//  alert('Co loi tren duong truyen !!!') ;
					//  ilan = 0 ;    return ;}				  
			}
		}
		else {
			  if ( divNeed != '') {document.getElementById(divNeed).innerHTML="<div align ='center'><img name='loading' src='images/loading.gif' />Loading ......</div>";}
		}
	};
	
	xmlHttp.open('POST', url+".php", true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", parameters.length);
	xmlHttp.setRequestHeader("Connection", "close");
	xmlHttp.send(parameters);
}
 
function loadtrang1(divNeed, url, parameters,xuly) {
	
	var luucu = document.getElementById(divNeed).innerHTML ;

	var xmlHttp = GetXmlHttpObject();
	xmlHttp.onreadystatechange = function() {
		if (xmlHttp.readyState==4) 
		{ 
			if ( xmlHttp.status==200) 
			{
		  	//document.getElementById(divNeed).innerHTML=xmlHttp.responseText;
			ketqua = xmlHttp.responseText ;
			xulyxong(xuly);
			xmlHttp=null;
		    }
			else 
			{  
			
 	        	  ilan = ilan +1 ;
				  if (ilan <= 3) {  loadtrang1(divNeed, url, parameters,xuly) ; } else {
					//  alert('Co loi tren duong truyen !!!') ; 
					  ilan = 0 ;    return ;}				  
 			}
		}
		else {
			document.getElementById(divNeed).innerHTML="<img name='loading' src='images/loading.gif' />Loading ......";
		}
	};
	
	xmlHttp.open('POST', url+".php", true);
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", parameters.length);
	xmlHttp.setRequestHeader("Connection", "close");
	xmlHttp.send(parameters);
}
  
function makePOSTRequest(divNeed, url, parameters) {
	var xmlHttp = GetXmlHttpObject();
	xmlHttp.onreadystatechange = function() {
		if (xmlHttp.readyState==4&&xmlHttp.status==200) {
			document.getElementById(divNeed).innerHTML=xmlHttp.responseText;
			xmlHttp=null;
			return ;
		} else {
			document.getElementById(divNeed).innerHTML="<img name='loading' src='images/loading.gif' />Loading ......";
		}
	};
	xmlHttp.open('POST', url+".php", true);
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", parameters.length);
	xmlHttp.setRequestHeader("Connection", "close");
	xmlHttp.send(parameters);
}

function makePOSTNoPage(url, parameters) {
	var xmlHttp = GetXmlHttpObject();
	xmlHttp.onreadystatechange = function() {
		if (xmlHttp.readyState==4&&xmlHttp.status==200) {
			eval(xmlHttp.responseText);
			xmlHttp=null;
			return ;
		}
	};
	xmlHttp.open('POST', url, true);
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", parameters.length);
	xmlHttp.setRequestHeader("Connection", "close");
	xmlHttp.send(parameters);
}

function stateChanged() {
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete") {
		document.getElementById(divShow).innerHTML=xmlHttp.responseText;
	} else {
		document.getElementById(divShow).innerHTML = "<img name='loading' src='images/loading.gif' />Loading ......";
	}	
}

function load_module(divNeed,url,id,page) {
	var xmlHttp=GetXmlHttpObject();
	//alert(url);
	if(!id) { id = 1; }
	if(!page) { page = 1; }
	xmlHttp.open('GET',url+".php?id="+encodeURIComponent(id)+"&page="+page,true);
	xmlHttp.onreadystatechange = function() {
		if (xmlHttp.readyState==4&&xmlHttp.status==200) {
			document.getElementById(divNeed).innerHTML=xmlHttp.responseText;
			xmlHttp=null;
			return ;
		} else {
			document.getElementById(divNeed).innerHTML="<div align='center'><img name='loading' src='images/ajax-loader.gif' align='absmiddle' /></div>";
		}
	};
	xmlHttp.send(null);
}

function load_content(divNeed,url) {
	var xmlHttp=GetXmlHttpObject();
	xmlHttp.open('GET',url+".php",true);
	xmlHttp.onreadystatechange = function() {
		if (xmlHttp.readyState==4&&xmlHttp.status==200) {
			document.getElementById(divNeed).innerHTML=xmlHttp.responseText;
			xmlHttp=null;
		} else {
			document.getElementById(divNeed).innerHTML="<div align='center'><img name='loading' src='images/ajax-loader.gif' align='absmiddle' /></div>";
		}
	};
	xmlHttp.send(null);
}

function load_mod_load(divNeed,url) {
	var xmlHttp=GetXmlHttpObject();
	//alert(url);
	xmlHttp.open('GET',url,true);
	xmlHttp.onreadystatechange = function() {
		if (xmlHttp.readyState==4&&xmlHttp.status==200) {
			document.getElementById(divNeed).innerHTML=xmlHttp.responseText;
			xmlHttp=null;
		} else {
			document.getElementById(divNeed).innerHTML="<img name='loading' src='images/loading.gif' align='absmiddle' /> Loading ......";
		}
	};
	xmlHttp.send(null);
}

function load_content_related(divNeed,url,id) {
	var xmlHttp=GetXmlHttpObject();
	xmlHttp.open('GET',url+".php?id="+id,true);
	xmlHttp.onreadystatechange = function() {
		if (xmlHttp.readyState==4&&xmlHttp.status==200) {
			document.getElementById(divNeed).innerHTML=xmlHttp.responseText;
			xmlHttp=null;
		} else {
			document.getElementById(divNeed).innerHTML="<div align='center'><img name='loading' src='images/ajax-loader.gif' align='absmiddle' border='0' /></div>";
		}
	};
	xmlHttp.send(null);
}

function postData(url, parameters) {
	xmlHttp = GetXmlHttpObject();
	xmlHttp.open('POST', url+".php", true);
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", parameters.length);
	xmlHttp.setRequestHeader("Connection", "close");
	xmlHttp.send(parameters);
}

function loadPage(links){
	var url = links.href;
	var index = url.indexOf("#");
	//hide all popup
	var n = 'menu2f3d';
	if(m=stgMe(n)){
		for (i=1;i<=6;i++) {
			var p=m.aPopups[i];p.fbHide();
		}
	}
	//
	if(index == -1) {
		load_module("divContent", "home");
	}
	else {
		var mod = url.substring(index+1);
		var params = mod.split("/", 3);
		if(!params[0]) {
			params[0] = "home";
		}
		location.href = url;
		if(params[0] != "home") {
			resetChange();
		}
		load_module("divContent", params[0], params[1], params[2]);
	}
	scrollTop();
}

function loadPage2(url){
	var index = url.indexOf("#");
	if(index == -1) {
		load_module("divContent", "home");
	}
	else {
		var mod = url.substring(index+1);
		var params = mod.split("/", 3);
		if(!params[0]) {
			params[0] = "home";
		}
		location.href = url;
		if(params[0] != "home") {
			resetChange();
		}
		load_module("divContent", params[0], params[1], params[2]);
	}
	scrollTop();
}

function loadRelatedContent(links){
	var url = links.href;
	var index = url.indexOf("#");
	if(index == -1) {
		load_module("divContent", "home");
	}
	else {
		var mod = url.substring(index+1);
		var params = mod.split("/", 3);
		if(!params[0]) {
			params[0] = "home";
		}
		location.href = url;
		if(params[0] != "home") {
			resetChange();
		}
		load_module("divContent", params[0], params[1], params[2]);
	}
}

function alerter(message) {
	alert(message);
}

function showBranch(val) {
	load_mod_load('div_branch_system', 'branch_system_ex.php?branch='+val);
}

function checkLogin() {
	if(trim(document.frmLogin.txtUsername.value)==""){
		alert(login_alert1);
		document.frmLogin.txtUsername.focus();
		return false;
	} else if(trim(document.frmLogin.txtPassword.value)==""){
		alert(login_alert2);
		document.frmLogin.txtPassword.focus();
		return false;
	} else {
		var param = "txtUsername="+document.frmLogin.txtUsername.value;
		param = param + "&txtPassword="+document.frmLogin.txtPassword.value;
		makePOSTNoPage("checklogin.php", param);
	}
}

  
 
function loadAdvModule(divNeed,url,id,tbID,page) {
	var xmlHttp=GetXmlHttpObject();
	//alert(url);
	if(!id) { id = 1; }
	if(!page) { page = 1; }
	xmlHttp.open('GET',url+".php?id="+encodeURIComponent(id)+"&tbID="+tbID+"&page="+page,true);
	xmlHttp.onreadystatechange = function() {
		if (xmlHttp.readyState==4&&xmlHttp.status==200) {
			document.getElementById(divNeed).innerHTML=xmlHttp.responseText;
			xmlHttp=null;
		} else {
			document.getElementById(divNeed).innerHTML="<div align='center'><img name='loading' src='images/ajax-loader.gif' align='absmiddle' /></div>";
		}
	};
	xmlHttp.send(null);
}
function loadAdvPage(url){
	var index = url.indexOf("#");
	if(index == -1) {
		loadAdvModule("divContent", "home");
	}
	else {
		var mod = url.substring(index+1);
		var params = mod.split("/", 4);
		if(!params[0]) {
			params[0] = "home";
		}
		location.href = url;
		if(params[0] != "home") {
			resetChange();
		}
		loadAdvModule("divContent", params[0], params[1], params[2], params[3]);
	}
	scrollTop();
}
  


function loadtrangdl(divNeed, url, parameters,xulygoi) {
	var xmlHttp = GetXmlHttpObject();
	xmlHttp.onreadystatechange = function() {
		if (xmlHttp.readyState==4&&xmlHttp.status==200) {
			//document.getElementById(divNeed).innerHTML=xmlHttp.responseText;
			 if (xulygoi != '') { xulyxong(xulygoi) ; }
			 xmlHttp=null;
		} else {
			//document.getElementById(divNeed).innerHTML="<img name='loading' src='images/loading.gif' />Loading ......";
		}
	};
	xmlHttp.open('POST', url, true);
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", parameters.length);
	xmlHttp.setRequestHeader("Connection", "close");
	xmlHttp.send(parameters);
}


 <!-- pppppppppppppppppppppp toontip ppppppppppppp-->
 
 
 
    