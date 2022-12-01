var  keyCode ;
var ff = navigator.appName == "Netscape"; 
window.onload = function() 
{ 

 
 
 document.onkeydown = function(event) 
{ 
 
	if(ff)
	{
 
		  keyCode = event.keyCode; 
	}
  
   
    
      
    }; 
}; 
function goidongid(id)
{
	document.getElementById(id).style.display ="none"; 
}
function formatchuan(obj) {
 	var strvalue;
 	if (eval(obj))
 	    strvalue = eval(obj).value;
	else
 	    strvalue = obj;
 	var num;
 	    num = strvalue.toString().replace(/\$|\,/g,'');
 	 
 	    if(isNaN(num))
 	    num = "";
 	    sign = (num == (num = Math.abs(num)));
 	    num = Math.floor(num*100+0.50000000001);
 	    num = Math.floor(num/100).toString();
 	    for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
 	    num = num.substring(0,num.length-(4*i+3))+','+
 	    num.substring(num.length-(4*i+3));
 	    //return (((sign)?'':'-') + num);
 	    eval(obj).value = (((sign)?'':'-') + num);
	}
	
function formatso(value) {
 	var strvalue;
  
 	    strvalue = value;
 
 	var num;
 	    num = strvalue.toString().replace(/\$|\,/g,'');
 	 
 	    if(isNaN(num))
 	    num = "";
 	    sign = (num == (num = Math.abs(num)));
 	    num = Math.floor(num*100+0.50000000001);
 	    num = Math.floor(num/100).toString();
 	    for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
 	    num = num.substring(0,num.length-(4*i+3))+','+
 	    num.substring(num.length-(4*i+3));
 	    //return (((sign)?'':'-') + num);
 	    return (((sign)?'':'-') + num);
	}
	
function goidong()
{
	document.getElementById("hienthongbao").style.display ="none"; 
}
	
function xoatrang(ob)
{
	ob.value='';
}
var ocu='',maucu ;


function doimau(tb)
{
	 
	tb= "ngay" + tb ;
	if (ocu =='')
	{ 
		ocu = tb ;
		maucu = document.getElementById(ocu).bgColor ;
	}
	else
	{
	document.getElementById(ocu).bgColor = maucu ;	
	ocu = tb ;
	maucu = document.getElementById(tb).bgColor ;
	}
	
	document.getElementById(tb).bgColor = "#FFCCFF" ;
	
}
function anhien2f(f1,f2)
 {
	if (document.getElementById(f1).style.display == '' ) 
	{
		document.getElementById(f1).style.display = 'none'
		document.getElementById(f2).style.display = ''
	}
	else
	{
		document.getElementById(f1).style.display = ''
		document.getElementById(f2).style.display = 'none'
	}
}
 function anhienform(ten)
 {
	if (document.getElementById(ten).style.display == '' ) 
	{
		document.getElementById(ten).style.display = 'none'
	}
	else
	{
		document.getElementById(ten).style.display = ''
	}
}
 function doiso(txt)
{

	if (txt== null ) return 0 ;
 	var str = "",s="";
	str= txt;
	for(var i=0;i < str.length;i++)
	{
		str = str.replace(",","");
	}
	if (str == '')
	{ 
		str = 0 ;	
	} 
	return str
}
function onlyinthc(txt){ 
		var str = "" ;
		str= txt.value;
   if(event.keyCode==0x08){ 
        event.returnValue = true; 
    } 
    else if(event.keyCode==0x09){ 
        event.returnValue = true; 
    }     
 
    else if(!(event.keyCode>=0x30 && event.keyCode <=0x39)){ 
                event.returnValue = false; 
    }     
} 

 
	function onlyinta(txt){ 
		
		var str = "" ;
 		str= txt.value;	
	if (event.keyCode==0x2E && str.indexOf('.') != -1 )
		{ 	
			event.returnValue = false; 
		} 
	
    else if(event.keyCode==0x08){ 
        event.returnValue = true; 
    } 
    else if(event.keyCode==0x09){ 
        event.returnValue = true; 
    }     
    else if(event.keyCode==0x2E){   //  ky tu .   thap phan la 46    hex la 2E
        event.returnvalue=true; 
    } 
    else if(!(event.keyCode>=0x30 && event.keyCode <=0x39)){ 
                event.returnValue = false; 
    }

} 
 //=================================================================
 function txtFormat3(txt)
{
 
	var m=1,vt = 0;
	var str = "",s="",s1="",s2="";
	str= txt ;
	for(var i=0;i < str.length;i++)
	{
			str = str.replace(",","");	
	}
	for(var i=str.length-1;i>=0;i--)
	{
		if(m%3 == 0 && i != 0)
			s += str.substring(i,i+1) + ",";
		else
			s += str.substring(i,i+1);
		m++;
	}
	str = "";
	for(var i=s.length-1;i>=0;i--)
	{
		str += s.substring(i,i+1);
	}
	return str;
}
//=========================================================
function txtFormata(txt)
{
	

 	var m=1,vt = 0;
	var str = "",s="",s1="",s2="";
	str= txt.value;
	str= str.replace(' ','') ;
	 
	 
	 if (!ff)   keyCode =  window.event.keyCode
     if  (keyCode== 32) { txt.value = str; return ;}
	
	if ( keyCode==0x2E && str.indexOf('.') != -1 )
		{ 	
			txt.event.returnValue = false; 
		} 
	
    else if(keyCode==0x08){ 
        txt.event.returnValue = true; 
    } 
    else if(keyCode==0x09){ 
        txt.event.returnValue = true; 
    }     
    else if(keyCode==0x2E){   //  ky tu .   thap phan la 46    hex la 2E
        txt.event.returnvalue=true; 
    } 
    else if(!(keyCode>=0x30 && keyCode <=0x39)){ 
                txt.event.returnValue = false; 
    }	
	
	
	
	
	if (str.substring(0,1) == '0'  &&  str.length >1) 
	{ 
		str = str.substring(1,str.length) ;
	}	
	vt = str.indexOf('.')
	if (vt == -1){ vt = str.length}
	s1 = str.substring(0,vt) ;
	
	if (vt != -1) { s2 = str.substring(vt,str.length) }
	
	if (s2 != '') {str = s1 }
	for(var i=0;i < str.length;i++)
	{
			str = str.replace(",","");	
	}
	for(var i=str.length;i>=0;i--)
	{
		if(m%3 == 0 && i != 0)
			s += str.substring(i,i+1) + ",";
		else
			s += str.substring(i,i+1);
		m++;
	}
	str = "";
	for(var i=s.length-1;i>=0;i--)
	{
		str += s.substring(i,i+1);
	}
	if (s2 != ""){str +=s2 }	
	txt.value = str;
}
//=========================================================
function txtFormat(txt)
{ 
 	var m=1,vt = 0;
	var str = "",s="",s1="",s2="";
	str= txt.value;
	if (str.substring(0,1) == '0'  &&  str.length >1) 
	{ 
		str = str.substring(1,str.length) ;
	}	
	vt = str.indexOf('.')
	if (vt == -1){ vt = str.length}
	s1 = str.substring(0,vt) ;
	
	if (vt != -1) { s2 = str.substring(vt,str.length) }
	
	if (s2 != '') {str = s1 }
	for(var i=0;i < str.length;i++)
	{
			str = str.replace(",","");	
	}
	for(var i=str.length-1;i>=0;i--)
	{
		if(m%3 == 0 && i != 0)
			s += str.substring(i,i+1) + ",";
		else
			s += str.substring(i,i+1);
		m++;
	}
	str = "";
	for(var i=s.length-1;i>=0;i--)
	{
		str += s.substring(i,i+1);
	}
	if (s2 != ""){str +=s2 }	
	txt.value = str;
}
function txtFormatj(txt)
{
 	var m=1,vt = 0;
	var str = "",s="",s1="",s2="";
	str= txt+'';
	
	if (str.length == 0 ) {return 0 ;}
	if (str.substring(0,1) == '0' &&  str.length >1) 
	{ 
		str = str.substring(1,str.length) ;
	}	
	vt = str.indexOf('.')
	if (vt == -1){ vt = str.length}
	s1 = str.substring(0,vt) ;
	
	if (vt != -1) { s2 = str.substring(vt,str.length) }
	
	if (s2 != '') {str = s1 }
	for(var i=0;i < str.length;i++)
	{
			str = str.replace(",","");	
	}
	for(var i=str.length-1;i>=0;i--)
	{
		if(m%3 == 0 && i != 0)
			s += str.substring(i,i+1) + ",";
		else
			s += str.substring(i,i+1);
		m++;
	}
	str = "";
	for(var i=s.length-1;i>=0;i--)
	{
		str += s.substring(i,i+1);
	}
	if (s2 != ""){str +=s2 }
	  
	return  str.replace("-,", "-");;
}

//=========================================================
function txtkiemtra(txt)
{   var kt = "";  
	var str =""
	str = txt.value ;
 
	kt = str.substring(str.length-1,str.length)	
	if (kt == '.')
	 {
	 	txt.value =txtFormat3(str.substring(0,str.length-1));		 
  	 }
 
	
}
//=========================================================
function trim(str,chars) {
	chars = chars || "\\s";
	return ltrim(rtrim(str, chars), chars);
}
 
function ltrim(str, chars) {
	chars = chars || "\\s";
	return str.replace(new RegExp("^[" + chars + "]+", "g"), "");
}
 
function rtrim(str, chars) {
	chars = chars || "\\s";
	return str.replace(new RegExp("[" + chars + "]+$", "g"), "");
}
function trimall(txt)
{
ch = '';
 
for(i=0;i<txt.length;i++)
{
	cha = txt.charAt(i);
	if(cha != ' ')
	{
		ch = ch + cha;
	}
}
return ch;
}
 //=================================================================
function stringFormat3(txt)
{
	var m=1;
	var str = "",s="";
	str= txt;
	for(var i=0;i < str.length;i++)
	{
		str = str.replace(",","");
	}
	for(var i=str.length-1;i>=0;i--)
	{
		if(m%3 == 0 && i != 0)
			s += str.substring(i,i+1) + ",";
		else
			s += str.substring(i,i+1);
		m++;
	}
	str = "";
	for(var i=s.length-1;i>=0;i--)
	{
		str += s.substring(i,i+1);
	}
	return str;
}
 //=================================================================
function laso(txt)
{
	str = txt +'';
	for(var i=0;i < str.length;i++)
	{
			str = str.replace(",","");			
	}
	str = str.replace(",","");
	return str ;
}


function txtFormatt(txt)
{
	var m=1;
	var str = "",s="";
	str= txt.value;
	if (str.substring(0,1) == '0') 
	{ 
		str = str.substring(1,str.length) ;
	}
 
	for(var i=0;i < str.length;i++)
	{

			str = str.replace(",","");			
	
	}
	for(var i=str.length-1;i>=0;i--)
	{
		if(m%3 == 0 && i != 0)
			s += str.substring(i,i+1) + ",";
		else
			s += str.substring(i,i+1);
		m++;
	}
	str = "";
	for(var i=s.length-1;i>=0;i--)
	{
		str += s.substring(i,i+1);
	}
	txt.value = str;

}
function txtFormatcu(txt)
{
	var m=1;
	var s="";
 	str = txt + '' ;
	if (str =='' ) { str = "0" };

 
	for(var i=0;i < str.length;i++)
	{

			str = str.replace(",","");			
	
	}
	for(var i=str.length-1;i>=0;i--)
	{
		if(m%3 == 0 && i != 0)
			s += str.substring(i,i+1) + ",";
		else
			s += str.substring(i,i+1);
		m++;
	}
	str = "";
	for(var i=s.length-1;i>=0;i--)
	{
		str += s.substring(i,i+1);
	}
	return  str;

}

//=================================================================
function onlyintcu(){ 
    if(event.keyCode==0x08){ 
        event.returnValue = true; 
    } 
	
	
    else if(event.keyCode==0x09){ 
        event.returnValue = true; 
    } 
    
    else if(event.keyCode==45){ 
        event.returnvalue=true; 
    } 
    else if(!(event.keyCode>=0x30 && event.keyCode <=0x39)){ 
                event.returnValue = false; 
    }     
} 

 //=================================================================

 
 function kiemtragio(txt){ 
  
  var str = trim(txt.value) ;
	if (str.length == 1 &&  txt.value > '2') {txt.value = '' ; return false ; }   

	if (str.length == 2 && str.substring(1,2) == ':'){txt.value = '0'+ str.substring(0,1)+ ':' ; return  false;	}
	if (str.length == 2 && str.substring(0,1) > '2' ){txt.value = '' ; 							 return  false;	}
	if (str.length == 2 && str.substring(0,1) > '2' ){txt.value = ''; return  ;	}
	if (str.length == 2 && str.substring(1,2) > '3' && str.substring(0,1) == '2'  ){txt.value = ''; return  false;	}

	if (str.length == 2 							){txt.value = str.substring(0,2)+ ':' ; 	 return  false;	}	
	if (str.length == 2 && str.substring(1,2) > '3' ){txt.value = '' ; 	 						 return  false;	}
 	if (str.length == 4 && str.substring(3,4) > '5' ){txt.value = str.substring(0,2)+ ':0'+str.substring(3,4) ;	 return  false;	}
	 
}

 function kiemtragiora(txt){ 
 
 		var t = txt ;
 		
		if  (trim(t.value).length == 5 && t.value.indexOf(':') == -1 )
		{    
			txt.value = '' ; 
 			txt.focus() ;
			return ; 
		}
		if  (trim(t.value).length < 5 && trim(t.value).length > 0)
			{
				txt.focus() ;
				return ; 	
			}
			
	    if (kiemtragio(txt) == false)
		{
		 	txt.value = '' ; 
 			txt.focus() ;
			return ; 
	
		}
 }