var mangfileycnv=new Array(); 
var mangfile=new Array();
var mangfilettn=new Array();

function taifilesyc(ten)
{
	var  tt = id_user;
	var  nn = document.forms['frmbaocaocv'].ngayso.value;

		tt = tt + "syc"  ;
	
		
	var nf = "taifile.php?us=" +  tt + '_' + nn +  '-' + ten ;  
	window.open(nf,"newss","");	
}
//==============================================

function addtenycnv(mangf,ten)
{
	if 	(ten != '')
	{
		mangfileycnv[ten] = ten ;
	}
	 
}
function taifileycnv(ten)
{
	var  tt = id_user;
	var  nn = document.forms['frmbaocaocv'].ngayso.value;

		tt = tt + "ycnv"  ;
	
		
	var nf = "taifile.php?us=" +  tt + '_' + nn +  '-' + ten ;  
	window.open(nf,"newss","");	
}

function xoatenycnv(ten)
{
	var n = confirm("Bạn có muốn xóa file: "+ten+" này không ? ");
	if(n == false)
	{ 
		return false;
	}
	var  tt = id_user;
	var  nn = document.forms['frmbaocaocv'].ngayso.value;
 
		tt = tt + "ycnv"  ;
	 
	var mtam=new Array();
	var x,str = "";	
	 
	for (x in mangfileycnv)
	{
		 
 		if (ten != x )
		{
			mtam[x]	= x ;
			//alert(ten);
		}
	}
	mangfileycnv = mtam ;
	
	xuattenfileycnv(mangfileycnv)
	poststr="us="+    encodeURIComponent(tt+ '_'+ nn +  '-'+ten);  
 
    postData("delfileupload", poststr) ;	
 }
 
 function xuattenfileycnv(mangf)
{

	var x,str ="" ;	
	str ="File đính kèm<br>" ;
	for (x in mangf)
	{
		//document.write(mycars[x] + "<br />");
		//alert(mangf[x]) ;
		str = str + " <a  style=\"cursor:pointer\" onclick=\"taifileycnv('"+ mangf[x]  +"')\">" +  mangf[x] + "</a> &nbsp;<img src='images/icon_delete.gif'  style='cursor:pointer;padding-top:7px' onclick=\"xoatenycnv('"+ mangf[x]  +"')\"  width='12' /><br>";
	}
  
	document.getElementById('cacfileycnv').innerHTML = str ;
  
	
} 

 function taomangycnv()
 {
  
	var t1 = Array();
   if ( document.getElementById('mangfileanycnv').value != "" )
	{
		var tam = document.getElementById('mangfileanycnv').value.split("@#@") ;
		for (x in tam)
		{
				t1[tam[x]]	= tam[x] ;
		}
	}
	mangfileycnv = t1 ;

		 
 }

	function ajaxFileUploadycnv()
{
 
	var  tt = id_user;
	var  nn = document.forms['frmbaocaocv'].ngayso.value;
//	var ht = nn.split("_" );
// 	ngay = ht[0] ;
//	if (ngay.length == 1 ) { ngay = '0' + ngay ; }
//	thang = ht[1] ;
//	if (thang.length == 1 ) { thang = '0' + thang ; }
//	nam = ht[2] ;
//	nn = document.forms['frmbaocaocv'].ngayth.value ;
// 	nn = ngay + '_' + thang + '_' + nam ;
 
	//		alert(navigator.appName );
 
		tt = tt + "ycnv"  ;
 
 	   
	
 		$("#loading")
		.ajaxStart(function(){
			$(this).show();
		})
		.ajaxComplete(function(){
			$(this).hide();
		});

		$.ajaxFileUpload
		(
			 
			{
				url:'fileuploadycnv.php?us=' + tt + '_'+ nn,
				secureuri:false,
				fileElementId:'fileToUploadycnv',
				dataType: 'json',
				success: function (data, status)
				{
					if(typeof(data.error) != 'undefined')
					{
						if(data.error != '')
						{							
							alert(data.error);	
							return false ;
						}else
						{					
							// alert(data.msg); 
							
						    addtenycnv(mangfileycnv,data.msg);	
							
 							xuattenfileycnv(mangfileycnv)
							  
						}
					}
				},
				error: function (data, status, e)
				{		
					if ( data.e == 'vuotdungluong' )
					{
						alert("Vượt dung lượng cho phép 2M !!!");				 
					}
				}
			}
		)
		
		return false;

	}

//============================================================
//============================================================
//============================================================
//============================================================

function addten(mangf,ten)
{
	if 	(ten != '')
	{
		mangfile[ten] = ten ;
	}
	
}
function addtenttn(mangf,ten)
{
	if 	(ten != '')
	{
		mangfilettn[ten] = ten ;
	}
	
}

function taifile(ten)
{
	var  tt = id_user;
	var  nn = document.forms['frmbaocaocv'].ngayso.value;
	if (document.forms['frmbaocaocv'].chucnang.value == '5' )
	{
		tt = tt + "n"  ;
		nn = document.forms['frmbaocaocv'].ngayth.value ;
	}	
	var nf = "taifile.php?us=" +  tt + '_' + nn +  '-' + ten ;  
	window.open(nf,"newss","");	
}
function taifileld(ten)
{
	var nf = "taifile.php?us=" +  id_user + 's_' + document.forms['frmbaocaocv'].ngayth.value +  '-' + ten ;  
	window.open(nf,"newss","");	
}
function taifilettn(ten)
{
	var  tt = id_user;
	var nn = document.forms['frmbaocaocv'].ngayth.value ; 
		tt = tt + "ttn"  ;
	var nf = "taifile.php?us=" +  tt + '_' + nn +  '-' + ten ;  
	window.open(nf,"newss","");	
}

function taifilemt(ten)
{
	
	var  tt = id_user ;
	 
	var  nn = document.forms['frmbaocaocv'].ngayso.value;
	///alert(document.forms['frmbaocaocv'].ngayso.value) ;
		tt = tt + "smt"  ;
		//nn = document.forms['frmbaocaocv'].ngayth.value ;
	
	
	var nf = "taifile.php?us=" +  tt + '_' + nn +  '-' + ten ;  
	window.open(nf,"newss","");	
}


function xoaten(ten)
{
	var n = confirm("Bạn có muốn xóa file: "+ten+" này không ? ");
	if(n == false)
	{ 
		return false;
	}
	var  tt = id_user;
	var  nn = document.forms['frmbaocaocv'].ngayso.value;
	if (document.forms['frmbaocaocv'].chucnang.value == '5' )
	{
		tt = tt + "n"  ;
		nn = document.forms['frmbaocaocv'].ngayth.value ;
	}	
	var mtam=new Array();
	var x,str = "";	
	for (x in mangfile)
	{
 		if (ten != x )
		{
			mtam[x]	= x ;
			//alert(ten);
		}
	}
	mangfile = mtam ;
	xuattenfile(mangfile)
	poststr="us="+    encodeURIComponent(tt+ '_'+ nn +  '-'+ten);  
//	alert(poststr);
    postData("delfileupload", poststr) ;	
 }
 
function xoatenttn(ten)
{
	var n = confirm("Bạn có muốn xóa file: "+ten+" này không ? ");
	if(n == false)
	{ 
		return false;
	}
	var  tt = id_user;
	var  nn = document.forms['frmbaocaocv'].ngayth.value ; 	
	tt = tt + "ttn"  ;
 	
	var mtam=new Array();
	var x,str = "";	
	for (x in mangfilettn)
	{
 		if (ten != x )
		{
			mtam[x]	= x ;
			//alert(ten);
		}
	}
	mangfilettn = mtam ;
	xuattenfilettn(mangfilettn)
	poststr="us="+    encodeURIComponent(tt+ '_'+ nn +  '-'+ten);  
//	alert(poststr);
    postData("delfileupload", poststr) ;	
 }
 function taomang()
 {
	var t1 = Array();
    if ( document.getElementById('mangfilean').value != "" )
	{
		var tam = document.getElementById('mangfilean').value.split("@#@") ;
		for (x in tam)
		{
				t1[tam[x]]	= tam[x] ;
		}
	}
	mangfile = t1 ;

		 
 }
 function taomangttn()
 {
	var t1 = Array();
    if ( document.getElementById('mangfileanttn').value != "" )
	{
		var tam = document.getElementById('mangfileanttn').value.split("@#@") ;
		for (x in tam)
		{
				t1[tam[x]]	= tam[x] ;
		}
	}
	mangfilettn = t1 ;

		 
 }
function goiclick()
{
   //	document.getElementById('fileToUpload').click();
}

function xuattenfile(mangf)
{

	var x,str ="" ;	
	str = "File đính kèm<br>" ;
	for (x in mangf)
	{
		//document.write(mycars[x] + "<br />");
		//alert(mangf[x]) ;
		str = str + " <a  style=\"cursor:pointer\" onclick=\"taifile('"+ mangf[x]  +"')\">" +  mangf[x] + "</a> &nbsp;<img src='images/icon_delete.gif'  style='cursor:pointer;padding-top:7px' onclick=\"xoaten('"+ mangf[x]  +"')\"  width='12' /><br>";
	}
  
	document.getElementById('cacfile').innerHTML = str ;
   
	
}
function xuattenfilettn(mangf)
{

	var x,str ="" ;	
	str = "File đính kèm<br>" ;
	for (x in mangf)
	{
		//document.write(mycars[x] + "<br />");
		//alert(mangf[x]) ;
		str = str + " <a  style=\"cursor:pointer\" onclick=\"taifilettn('"+ mangf[x]  +"')\">" +  mangf[x] + "</a> &nbsp;<img src='images/icon_delete.gif'  style='cursor:pointer;padding-top:7px' onclick=\"xoatenttn('"+ mangf[x]  +"')\"  width='12' /><br>";
	}  
	
	document.getElementById('cacfilettn').innerHTML = str ;   
	
}

function ajaxFileUpload2()
	{
//	 var objSize = new ActiveXObject("Scripting.FileSystemObject");
// 		var strFileName = objSize.getFile(document.forms['frmbaocaocv'].fileToUpload.value );
// 		var SizeOfFile = strFileName.size;
//	 	alert(SizeOfFile + " bytes");
	
        var objFSO ;
  
         objFSO = new ActiveXObject('Scripting.FileSystemObject');
 
         var file;
         var path = document.forms['frmbaocaocv'].fileToUpload.value ;
         file = objFSO.getFile(path);
         var size;
         size = file.size ;  
         alert('File Size is : ' + file.size /1024 +' KB');
 		
	}
 
	
function ajaxFileUpload()
{

	var  tt = id_user;
	
	var  nn = document.forms['frmbaocaocv'].ngayso.value;
	//		alert(navigator.appName );
	if (document.forms['frmbaocaocv'].chucnang.value == '5' )
	{
		tt = tt + "n"  ;
		nn = document.forms['frmbaocaocv'].ngayth.value ;
	}
	//alert('fileupload.php?us=' + tt + '_'+ nn);
 		$("#loading")
		.ajaxStart(function(){
			$(this).show();
		})
		.ajaxComplete(function(){
			$(this).hide();
		});

		$.ajaxFileUpload
		(
			{
				url:'fileupload.php?us=' + tt + '_'+ nn,
				secureuri:false,
				fileElementId:'fileToUpload',
				dataType: 'json',
				success: function (data, status)
				{
					if(typeof(data.error) != 'undefined')
					{
						if(data.error != '')
						{							
							alert(data.error);	
							return false ;
						}else
						{					
							//alert(data.msg);
						     addten(mangfile,data.msg);	
 							xuattenfile(mangfile)
							 
						}
					}
				},
				error: function (data, status, e)
				{		
					if ( data.e == 'vuotdungluong' )
					{
						alert("Vượt dung lượng cho phép 2M !!!");				 
					}
				}
			}
		)
		
		return false;

	}

function ajaxFileUploadttn()
{

	var  tt = id_user;
 
		tt = tt + "ttn"  ;
		nn = document.forms['frmbaocaocv'].ngayth.value ;
	 
	//alert('fileupload.php?us=' + tt + '_'+ nn);
 		$("#loading")
		.ajaxStart(function(){
			$(this).show();
		})
		.ajaxComplete(function(){
			$(this).hide();
		});

		$.ajaxFileUpload
		(
			{
				url:'fileuploadttn.php?us=' + tt + '_'+ nn,
				secureuri:false,
				fileElementId:'fileToUploadttn',
				dataType: 'json',
				success: function (data, status)
				{
					if(typeof(data.error) != 'undefined')
					{
						if(data.error != '')
						{							
							alert(data.error);	
							return false ;
						}else
						{					
							//alert(data.msg);
						    addtenttn(mangfilettn,data.msg);	
 							xuattenfilettn(mangfilettn)
							 
						}
					}
				},
				error: function (data, status, e)
				{		
					if ( data.e == 'vuotdungluong' )
					{
						alert("Vượt dung lượng cho phép 2M !!!");				 
					}
				}
			}
		)
		
		return false;

	}


 

function bcsetmuc(id)
{
	var maucn = '#CBE4CF';
 	if (id == '1')
	 { 
	 	document.getElementById('muctieu1').style.background = maucn;
		document.getElementById('muctieu2').style.background ='#eef2fb';
		document.getElementById('muctieu5').style.background ='#eef2fb';
		document.getElementById('muctieu').style.display ='';
		document.getElementById('noidung').style.display ='none';
		document.getElementById('dgmuctieu').style.display ='none';
		document.getElementById('ht_baihoc').style.display ='none';
		document.getElementById('ht_bctonghop').style.display ='none';
		document.forms['frmbaocaocv'].chucnang.value = '1' ;
		
	}	else if (id == '2')
	{
		document.getElementById('muctieu2').style.background =maucn;
		document.getElementById('muctieu1').style.background ='#eef2fb';
		document.getElementById('muctieu5').style.background ='#eef2fb';
		document.getElementById('noidung').style.display ='';
		document.getElementById('muctieu').style.display ='none';
		document.getElementById('dgmuctieu').style.display ='none';
		document.getElementById('ht_baihoc').style.display ='none';
		document.getElementById('ht_bctonghop').style.display ='none';
		document.forms['frmbaocaocv'].chucnang.value = '2' ;
	}		else if (id == '4')	{
		document.getElementById('muctieu2').style.background =maucn;
		document.getElementById('muctieu1').style.background ='#eef2fb';
		document.getElementById('muctieu5').style.background ='#eef2fb';	
		document.getElementById('noidung').style.display ='none';
		document.getElementById('muctieu').style.display ='none';
		document.getElementById('dgmuctieu').style.display ='none';
		document.getElementById('ht_baihoc').style.display ='';
		document.getElementById('ht_bctonghop').style.display ='none';
		document.forms['frmbaocaocv'].chucnang.value = '4' ;
	}		else if (id == '5')
	{
		document.getElementById('muctieu2').style.background ='#eef2fb';
		document.getElementById('muctieu1').style.background ='#eef2fb';
		document.getElementById('muctieu5').style.background =maucn;	
		
		
		document.getElementById('noidung').style.display ='none';
		document.getElementById('muctieu').style.display ='none';
		document.getElementById('dgmuctieu').style.display ='none';
		document.getElementById('ht_baihoc').style.display ='none';
		document.getElementById('ht_bctonghop').style.display ='';
		document.forms['frmbaocaocv'].chucnang.value = '5' ;
	} else
		{
	 poststr="DATA="+ encodeURIComponent(document.forms['frmbaocaocv'].ngaybaocao.value)+"*@!"+ encodeURIComponent(id_user); 
     loadtrang('dgmuctieungay', "finddgmuctieu", poststr,"") ;
 	 poststr="DATA="+ encodeURIComponent(document.forms['frmbaocaocv'].ngaybaocao.value)+"*@!"+ encodeURIComponent(id_user);  
     loadtrang('ht_dgmts', "finddgmuctieus", poststr,"") ;	
	 
			document.getElementById('muctieu2').style.background ='#eef2fb';
			document.getElementById('muctieu1').style.background ='#eef2fb';
			document.getElementById('muctieu5').style.background ='#eef2fb';
			document.getElementById('noidung').style.display ='none';
			document.getElementById('muctieu').style.display ='none';
			document.getElementById('dgmuctieu').style.display ='';
			document.getElementById('ht_baihoc').style.display ='none';
			document.getElementById('ht_bctonghop').style.display ='none';
			document.forms['frmbaocaocv'].chucnang.value = '3' ;
     	}
 
}

  
	function getTime() {
		var now = new Date()
		var hour = now.getHours()
		var minute = now.getMinutes()
		now = null
		var ampm = "" 
		if (hour >= 12) {
		hour -= 12 
		ampm = "CH"
		} else
		ampm = "SA"
		hour = (hour == 0) ? 12 : hour
		if (minute < 10)
		minute = "0" + minute 
		return hour + ":" + minute + " " + ampm
	}
	function leapYear(year) {
		if (year % 4 == 0) 
		return true 
	}
	function getDays(month, year) {
		var ar = new Array(12)
		ar[0] = 31
		ar[1] = (leapYear(year)) ? 29 : 28 
		ar[2] = 31 
		ar[3] = 30 
		ar[4] = 31 
		ar[5] = 30 
		ar[6] = 31 
		ar[7] = 31 
		ar[8] = 30 
		ar[9] = 31 
		ar[10] = 30 
		ar[11] = 31 
		return ar[month]
	}
	function getMonthName(month) 
	{
		var ar = new Array(12)
		ar[0] = "Tháng Một"
		ar[1] = "Tháng Hai"
		ar[2] = "Tháng Ba"
		ar[3] = "Tháng Tư"
		ar[4] = "Tháng Năm"
		ar[5] = "Tháng Sáu"
		ar[6] = "Tháng Bảy"
		ar[7] = "Tháng Tám"
		ar[8] = "Tháng Chín"
		ar[9] = "Tháng Mười"
		ar[10] = "Tháng Mười Một"
		ar[11] = "Tháng Mười Hai"
		return ar[month]
	}
	function gettuan(nam,thang,ngay) 
	{

	 	month = thang -1 ;
		year =  nam;
  	var firstDayInstance = new Date(year, month, 1)
	var	firstDay = firstDayInstance.getDay() +1 ;	
	var	lastDate = getDays(month, year);
		date =  ngay ;
	var	monthName = getMonthName(month)
		var digit = 1
		var curCell = 1
		for (var row = 1; row <= Math.ceil((lastDate + firstDay - 1) / 7); ++row)
		{	


			for (var col = 1; col <= 7; ++col)
			{
				if (digit > lastDate)
				break
				if (curCell < firstDay) 
				{

					curCell++
				} else 
				{
					if (digit == date) 
					{ 
					
						return row ;
					} 
					digit++
	    	    }
			}
		}
	}
	

 	function kehoachnam(kh) 
	{
		 document.getElementById('thongtincv').innerHTML = '' ;	
 		 document.getElementById('Ngaybccv').innerHTML = "Kế hoạch năm: "+ kh ;
//	 poststr="DATA="+ encodeURIComponent(document.forms['frmbaocaocv'].ngaybaocao.value)+"*@!"+ encodeURIComponent(id_user); 
//	 poststr= poststr + "*@!" + "3" + "*@!" + "9" + "*@!" + "9" + "*@!" + kh  ; 
//   loadtrang('ht_bctonghop', "findbctonghop", poststr,"taomang") ;
	 
		poststr="DATA="+ '' +  "*@!"+ ''+  "*@!"+ '' +  "*@!"+ '' +  "*@!"+ ''+  "*@!"+ '' +  "*@!"+ encodeURIComponent(document.forms['frmbaocaocv'].ngaybaocao.value)+  "*@!"+ encodeURIComponent(id_user); 
	  poststr= poststr + "*@!" + '3' + "*@!" + '9' + "*@!" + '9' + "*@!" + kh  ; 	  
	  //alert(poststr);
	  loadtrang('ht_bctonghop', "addbctonghop", poststr,"taomangttn") ;
	 
	 bcsetmuc(5);

	}
 	function kehoachthang(kh) 
	{
		 document.getElementById('thongtincv').innerHTML = '' ;
	     var n1  = document.forms['frmbaocaocv'].nam.value ;
		 document.getElementById('Ngaybccv').innerHTML = "Kế hoạch tháng: " + kh + " năm " + n1 ;
 
//	 poststr="DATA="+ encodeURIComponent(document.forms['frmbaocaocv'].ngaybaocao.value)+"*@!"+ encodeURIComponent(id_user); 
//	 poststr= poststr + "*@!" + "2" + "*@!" + "9" + "*@!" + kh + "*@!" + n1  ; 	 
//    loadtrang('ht_bctonghop', "findbctonghop", poststr,"taomang") ;	
 		poststr="DATA="+ '' +  "*@!"+ ''+  "*@!"+ '' +  "*@!"+ '' +  "*@!"+ ''+  "*@!"+ '' +  "*@!"+ encodeURIComponent(document.forms['frmbaocaocv'].ngaybaocao.value)+  "*@!"+ encodeURIComponent(id_user); 
	  poststr= poststr + "*@!" + '2' + "*@!" + '9' + "*@!" + kh + "*@!" + n1  ; 	  
 	  loadtrang('ht_bctonghop', "addbctonghop", poststr,"taomangttn") ;

 	 bcsetmuc(5);
	 }
	 
 	function kehoachtuan(kh) 
	{
		 document.getElementById('thongtincv').innerHTML = '' ;		
	     var n1  = document.forms['frmbaocaocv'].nam.value ;
         var t1 = document.forms['frmbaocaocv'].thang.value ;
		 document.getElementById('Ngaybccv').innerHTML = "Kế hoạch tuần: " + kh + " tháng " + t1 + " năm " + n1 ;
 		 
//	    poststr="DATA="+ encodeURIComponent(document.forms['frmbaocaocv'].ngaybaocao.value)+"*@!"+ encodeURIComponent(id_user); 
 //   	poststr= poststr + "*@!" + "1" + "*@!" + kh + "*@!" + t1 + "*@!" + n1  ; 		
 //     loadtrang('ht_bctonghop', "findbctonghop", poststr,"taomang") ;	 
 		poststr="DATA="+ '' +  "*@!"+ ''+  "*@!"+ '' +  "*@!"+ '' +  "*@!"+ ''+  "*@!"+ '' +  "*@!"+ encodeURIComponent(document.forms['frmbaocaocv'].ngaybaocao.value)+  "*@!"+ encodeURIComponent(id_user); 
	  poststr= poststr + "*@!" + '1' + "*@!" + kh + "*@!" + t1 + "*@!" + n1  ; 	  
 	  loadtrang('ht_bctonghop', "addbctonghop", poststr,"taomangttn") ; 
 		bcsetmuc(5);
	}
	
	
function settuant(year1,month1,tuan) 
	{
		 document.getElementById('thongtincv').innerHTML = '' ;
	     var year2  = document.forms['frmbaocaocv'].nam.value ;
         var month2 = document.forms['frmbaocaocv'].thang.value ;
		 document.forms['frmbaocaocv'].in_tuan.value = tuan ;
		 
 		 settuan(year2,month2,tuan) 
	}
 	function settuan(year,month,tuan) 
	{
	document.forms['frmbaocaocv'].in_tuan.value = tuan ;
	var homnay ='F8E4CB';	
  	var now = new Date()	;
	var m1 = month -1 ;
	 	month = month ;
		
	//	year = 2008 ;
  	var firstDayInstance = new Date(year, m1, 1)
	var	firstDay = firstDayInstance.getDay() +1 ;	
	var	lastDate = getDays(m1, year);
		date =  now.getDate() ;
	var	thangnay =  now.getMonth() ;
	var	monthName = getMonthName(m1-1)

		var tam ='' ;	
		tam = '<table border="1" cellpadding="0" cellspacing="0">' ;
		var weekDay = new Array(7)
		weekDay[0] = "Chủ Nhật"
		weekDay[1] = "Thứ Hai"
		weekDay[2] = "Thứ Ba"
		weekDay[3] = "Thứ Tư"
		weekDay[4] = "Thứ Năm"
		weekDay[5] = "Thứ Sáu"
		weekDay[6] = "Thứ Bảy"
		var digit = 1
		var curCell = 1
		for (var row = 1; row <= Math.ceil((lastDate + firstDay - 1) / 7); ++row)
		{	
			for (var col = 1; col <= 7; ++col)
			{
				if (digit > lastDate)
				break
				if (curCell < firstDay) 
				{
					curCell++
				} else 
				{
					if (digit == date && tuan == row ) 
					{ 
						if 	(digit == date && m1 == thangnay 	) { homnay = "FFFFFF"; }
						tam +='<TR onmouseover="this.className=\'Highlight1\'" onmouseout="this.className=\'Normal1\'" id="ngay'  + digit + '"  bgcolor="#' + homnay  +'"  style="cursor:pointer" class="doimau"  onclick="setthongtin('+digit+','+month+','+year+',\''+ weekDay[col-1] + '\');doimau(' + digit + ')"><td colspan="2" align="left" height="23" width="70">'+ weekDay[col-1] +'</td>';	
						tam += '<td width="85" colspan="4" align="center"  >&nbsp;' + digit+'/'+ month + '/'+ year +'</td></Tr>';

					} else
					if (row == tuan   ) 	
					{
				 
					tam +='<TR onmouseover="this.className=\'Highlight1\'" onmouseout="this.className=\'Normal1\'" id="ngay'  + digit + '"  bgcolor="#F8E4CB"  style="cursor:pointer" class="doimau"  onclick="setthongtin('+digit+','+month+','+year+',\''+ weekDay[col-1] + '\');doimau(' + digit + ')"><td colspan="2" align="left" height="23" width="70" >'+ weekDay[col-1] +'</td>';	
					tam += '<td width="85" colspan="4" align="center"  >&nbsp;' + digit+'/'+ month + '/'+ year +'</td></Tr>';

					}
					digit++
	    	    }
			}
		}
	
//	document.write(text) 
	tam += '</table>' ;
	document.getElementById('hienthilich').innerHTML = tam ;
	ocu = '' ;
	var t  ; 
	for (var k = 1; k <= 5; ++k)
	{
		 t = 't' + k ;	
		document.getElementById(t).style.color = '' ;	
	}	
	t= 't' + tuan ;	
	document.getElementById(t).style.color = '#FF0000'; 
 	//document.forms['frmbaocaocv'].hienthilich.innerHTML =tam;	 

}

var nam = document.forms['frmbaocaocv'].nam.value ;
var thang = document.forms['frmbaocaocv'].thang.value ;
var ngay = document.forms['frmbaocaocv'].ngay.value ;
 settuan(nam,thang,gettuan(nam,thang,ngay))  ;

 
  
//===================================================================================== 

 function setCheckedValue(radioObj, newValue) {
	if(!radioObj)
	return;
	var radioLength = radioObj.length;
	if(radioLength == undefined) {
		radioObj.checked = (radioObj.value == newValue.toString());
		return;
	}
	for(var i = 0; i < radioLength; i++) {
		radioObj[i].checked = false;
		if(radioObj[i].value == newValue.toString()) {
			radioObj[i].checked = true;
		}
	}
}

function ask()
{
	var n = confirm("Bạn có muốn xóa không");
	if(n == false)
	{
		return false;
			
	}
}

 
//===================================
function goitenan(id)
{
	if (id == '-1')	
	{
		document.getElementById('tenan').style.display = ''; 
	} else
	{
		document.getElementById('tenan').style.display = 'none'; 
	}

}

function trim(str)
{
	ch = '';
	for(i=0;i<str.length;i++)
	{
		cha = str.charAt(i);
		if(cha != ' ')
		{
			ch = ch + cha;
		}
	}
	return ch;
}

  function themmuctieu(idmt,tu,toi,congviec,ngaytao)
  { 
 	if  (trim(congviec) =='' && idmt == '' )
		{
			alert('Bạn chưa nhập công việc!!!');			 
			return false ;
		}
		
 	if (ngaytao == '')
	{
		alert('Bạn chưa Chọn ngày !!!');
		return false;			
	}

 	poststr="DATA="+    encodeURIComponent(idmt) +  "*@!"+ encodeURIComponent(tu)+  "*@!"+ encodeURIComponent(toi)+  "*@!"+ encodeURIComponent(congviec)+  "*@!"+ encodeURIComponent('')+  "*@!"+ encodeURIComponent('')+  "*@!"+ encodeURIComponent(ngaytao)+  "*@!"+ encodeURIComponent(id_user); 
  	  loadtrang('muctieungay', "addmuctieu", poststr,"") ;
    
   }
  function themdgmuctieusx(idmt,tu,toi,congviec,hoanthanh,ngaytao)
  { 
 
  	if (ngaytao == '')
	{
		alert('Bạn chưa Chọn ngày !!!');
		return false;			
	}

 	poststr="DATA="+    encodeURIComponent(idmt) +  "*@!"+ encodeURIComponent(tu)+  "*@!"+ encodeURIComponent(toi)+  "*@!"+ encodeURIComponent(congviec)+  "*@!"+ encodeURIComponent(hoanthanh)+  "*@!"+ encodeURIComponent('')+  "*@!"+ encodeURIComponent(ngaytao)+  "*@!"+ encodeURIComponent(id_user);  
	
  	  loadtrang('ht_dgmts', "adddgmuctieusx", poststr,"") ;
    
   }
   
  function themdgmuctieu(idmt,tu,toi,congviec,hoanthanh,ngaytao)
  { 
   
 	if  (trim(congviec) =='' && idmt == '' )
		{
			alert('Bạn chưa nhập công việc!!!');			 
			return false ;
		}
		
 	if (ngaytao == '')
	{
		alert('Bạn chưa Chọn ngày !!!');
		return false;			
	}

 	poststr="DATA="+    encodeURIComponent(idmt) +  "*@!"+ encodeURIComponent(tu)+  "*@!"+ encodeURIComponent(toi)+  "*@!"+ encodeURIComponent(congviec)+  "*@!"+ encodeURIComponent(hoanthanh)+  "*@!"+ encodeURIComponent('')+  "*@!"+ encodeURIComponent(ngaytao)+  "*@!"+ encodeURIComponent(id_user);  
 
 	  loadtrang('dgmuctieungay', "adddgmuctieu", poststr,"") ;
    
   }
   
  function themyeucau(idmt,congviec,traloi,ngaytao)
  { 
   
 	if  (trim(congviec) =='' && idmt == '' )
		{
			alert('Bạn chưa nhập công việc!!!');			 
			return false ;
		}
		
 	if (ngaytao == '')
	{
		alert('Bạn chưa Chọn ngày !!!');
		return false;			
	}

 	poststr="DATA="+    encodeURIComponent(idmt) +  "*@!"+ '' +  "*@!"+ '' +  "*@!" + encodeURIComponent(congviec) +  "*@!"+ encodeURIComponent(traloi)+  "*@!"+ encodeURIComponent('')+  "*@!"+ encodeURIComponent(ngaytao)+  "*@!"+ encodeURIComponent(id_user); 

 	  loadtrang('HT_yeucau', "addyeucau", poststr,"") ;
    
    
   }
   

  function xoayeucau(idmt,ngaytao)
  { 
 		
  	poststr="del="+  encodeURIComponent(idmt) +  "*@!"+ encodeURIComponent(ngaytao)+  "*@!"+ encodeURIComponent(id_user); 
    loadtrang('HT_yeucau', "addyeucau", poststr,"") ;
    
   }
   
  function xoamuctieu(idmt,ngaytao)
  { 
 		
  	poststr="del="+  encodeURIComponent(idmt) +  "*@!"+ encodeURIComponent(ngaytao)+  "*@!"+ encodeURIComponent(id_user); 
    loadtrang('muctieungay', "addmuctieu", poststr,"") ;
    
   }
 


function kiemtrabcth(idcv,tu,toi,congviec,danhgia,note,ngaytao,del)
{ 
  
	if  (trim(congviec) =='')
		{
			alert('Bạn chưa nhập công việc!!!');
			document.forms['frmbaocaocv'].cvbcth.focus() ;
			return false ;
		}
  	addbcth(idcv,tu,toi,congviec,danhgia,note,ngaytao,del) ;
  }
  
    function kiemtracv(idcv,tu,toi,congviec,danhgia,note,ngaytao,del)
  { 
  
	if  (trim(congviec) =='')
		{
			alert('Bạn chưa nhập công việc!!!');
			document.forms['frmbaocaocv'].cv.focus() ;
			return false ;
		}
  	addcv(idcv,tu,toi,congviec,danhgia,note,ngaytao,del) ;
}
  
  function editcv(idcv,tu,toi,congviec,danhgia,note,ngaytao,del)
  {  
   
	addcv(idcv,tu,toi,congviec,danhgia,note,ngaytao,del) ;
	
 
		document.getElementById('luubaocaocv').disabled =  'disabled' ;
  }
  function editbcthdg(idcv,tu,toi,congviec,danhgia,note,ngaytao,del)
  {  
   	addbcthdg(idcv,tu,toi,congviec,danhgia,note,ngaytao,del) ;
	//document.getElementById('luubaocaocv').disabled =  'disabled' ;
  }  
function editbcth(idcv,tu,toi,congviec,danhgia,note,ngaytao,del)
  {  
   	addbcth(idcv,tu,toi,congviec,danhgia,note,ngaytao,del) ;
	//document.getElementById('luubaocaocv').disabled =  'disabled' ;
  }  

  function savecv(idcv,tu,toi,congviec,danhgia,note,ngaytao,del)
  { 
	if  (trim(congviec) =='')
		{
			alert('Bạn chưa nhập công việc!!!');
			document.forms['frmbaocaocv'].cv.focus() ;
			return false ;
		}

	addcv(idcv,tu,toi,congviec,danhgia,note,ngaytao,del) ;
   document.getElementById('luubaocaocv').disabled =  '' ;
	
  } 
  
 function savebcth(idcv,tu,toi,congviec,danhgia,note,ngaytao,del)
  { 
	if  (trim(congviec) =='')
		{
			alert('Bạn chưa nhập công việc!!!');
			document.forms['frmbaocaocv'].cv.focus() ;
			return false ;
		}

	addbcth(idcv,tu,toi,congviec,danhgia,note,ngaytao,del) ;
  // document.getElementById('luubaocaocv').disabled =  '' ;
	
  } 
 function savebcthdg(idcv,tu,toi,congviec,danhgia,note,ngaytao,del)
  { 
	if  (trim(congviec) =='')
		{
			alert('Bạn chưa nhập công việc!!!');
			document.forms['frmbaocaocv'].cv.focus() ;
			return false ;
		}

	addbcthdg(idcv,tu,toi,congviec,danhgia,note,ngaytao,del) ;
  // document.getElementById('luubaocaocv').disabled =  '' ;
	
  }   
  
function luumuctieu(ngaybaocao)
{
 	if (ngaybaocao == '')
	{
		alert('Bạn chưa Chọn ngày !!!');
		return false;			
	}
 	
	//poststr="DATA=" +  encodeURIComponent(ngaybaocao) +  "*@!"+ encodeURIComponent(id_user); 
	//loadtrang('htmt', "savemuctieu", poststr,"luumt") ;
	poststr="DATA="+    encodeURIComponent(document.forms['frmbaocaocv'].ngaybaocao.value)+  "*@!"+ encodeURIComponent(id_user); 
    oadtrang('dgmuctieungay', "finddgmuctieu", poststr,"") ;
 	poststr="DATA="+    encodeURIComponent(document.forms['frmbaocaocv'].ngaybaocao.value)+  "*@!"+ encodeURIComponent(id_user);  
    loadtrang('HT_yeucau', "findyeucau", poststr,"taomangycnv") ;
 	poststr="DATA="+    encodeURIComponent(document.forms['frmbaocaocv'].ngaybaocao.value)+  "*@!"+ encodeURIComponent(id_user);  
    loadtrang('ht_dgmts', "finddgmuctieus", poststr,"") ;	
	 
	 
 } 

function luuyeucau(ngaybaocao)
{
 	if (ngaybaocao == '')
	{
		alert('Bạn chưa Chọn ngày !!!');
		return false;			
	}
 
	
	poststr="DATA="+    encodeURIComponent(ngaybaocao) +  "*@!"+ encodeURIComponent(id_user); 
	 
	 loadtrang('htmt', "saveyeucau", poststr,"luumt") ;
	 
 	 
  } 

  function thongbaoth()
  {
	alert('Đã lưu xong !!!');  
   }
  function savegcbcth(ngaybaocao,loai,ghichu)
  {
	  
	poststr="DATA="+ ngaybaocao  +  "*@!" + loai +  "*@!" + encodeURIComponent(id_user ) + "*@!"+ encodeURIComponent(ghichu);  
    loadtrang('ht_ndghichu', "savechung", poststr,"thongbaoth")  ;
  }
  
  function savebaocaocv(ngaybaocao,dachon,ghichu)
  {
 
	if(document.forms['frmbaocaocv'].luuok.value==0)
	{
		alert('Bạn chưa nhập vào danh sách công việc!');
		return false;
	}
	if(document.forms['frmbaocaocv'].dachon.value=='')
	{
		alert('Bạn chưa chọn đánh giá!');
		return false;
	}
	
	poststr="DATA="+    encodeURIComponent(ngaybaocao)+ "*@!" + encodeURIComponent(dachon)+ "*@!" + encodeURIComponent(ghichu)+  "*@!"+ encodeURIComponent(id_user); 

	 loadtrang("ht_danhgia", "savebaocaocv", poststr,"") ;
	document.forms['frmbaocaocv'].ngayluu.value='';	
	document.forms['frmbaocaocv'].ghichu_bc.value='';	
//	poststr="DATA="+    encodeURIComponent(document.forms['frmbaocaocv'].ngaybaocao.value)+  "*@!"+ encodeURIComponent(id_user);  
//  loadtrang('thongtincv', "findbaocaonv", poststr,"") ;
	alert('Đã lưu xong!');
  } 


function addcv(idcv,tu,toi,congviec,danhgia,note,ngaytao,del)
{ 
	if (ngaytao == '')
	{
		alert('Bạn chưa Chọn ngày !!!');
		return false;			
	}
	if (del != '')
	{
		var n = confirm("Bạn có muốn xóa không");
		if(n == false)
		{
			return false;			
		}
		poststr="del="+	 encodeURIComponent(del)+  "*@!"+ encodeURIComponent(ngaytao) +  "*@!"+ encodeURIComponent(id_user); 
        loadtrang('thongtincv', "addcv", poststr,"") ;
	
 
		
		return false;
	}
	
	poststr="DATA="+    encodeURIComponent(idcv) +  "*@!"+ encodeURIComponent(tu)+  "*@!"+ encodeURIComponent(toi)+  "*@!"+ encodeURIComponent(congviec)+  "*@!"+ encodeURIComponent(danhgia)+  "*@!"+ encodeURIComponent(note)+  "*@!"+ encodeURIComponent(ngaytao)+  "*@!"+ encodeURIComponent(id_user); 
	
      loadtrang('thongtincv', "addcv", poststr,"") ;
   	    document.forms['frmbaocaocv'].ngayluu.value = 'chualuu';
	
  
}

 

function addbcth(idcv,tu,toi,congviec,danhgia,note,ngaytao,del)
{ 

	var loai = document.forms['frmbaocaocv'].bcth_loaibc.value ;
	var tuan = document.forms['frmbaocaocv'].bcth_tuan.value ;
	var thang = document.forms['frmbaocaocv'].bcth_thang.value ;
	var nam = document.forms['frmbaocaocv'].bcth_nam.value ;

	if (del != '')
	{
		var n = confirm("Bạn có muốn xóa không");
		if(n == false)
		{
			return false;			
		}

		poststr="del="+	 encodeURIComponent(del)+  "*@!"+ encodeURIComponent(ngaytao) +  "*@!"+ encodeURIComponent(id_user); 
    	poststr= poststr + "*@!" + loai + "*@!" + tuan + "*@!" + thang + "*@!" + nam  ; 	
	 
        loadtrang('ht_bctonghop', "addbctonghop", poststr,"taomangttn") ;
			 
		return false;
	}

		poststr="DATA="+    encodeURIComponent(idcv) +  "*@!"+ encodeURIComponent(tu)+  "*@!"+ encodeURIComponent(toi)+  "*@!"+ encodeURIComponent(congviec)+  "*@!"+ encodeURIComponent(danhgia)+  "*@!"+ encodeURIComponent(note)+  "*@!"+ encodeURIComponent(ngaytao)+  "*@!"+ encodeURIComponent(id_user); 
	  poststr= poststr + "*@!" + loai + "*@!" + tuan + "*@!" + thang + "*@!" + nam  ; 	  
      loadtrang('ht_bctonghop', "addbctonghop", poststr,"taomangttn") ;
  //   document.forms['frmbaocaocv'].ngayluu.value = 'chualuu';
	
  
}


function timbcthdg(loai,tuan,thang,nam)
{
		poststr="DATA="+ '' +  "*@!"+ ''+  "*@!"+ '' +  "*@!"+ '' +  "*@!"+ ''+  "*@!"+ '' +  "*@!"+ encodeURIComponent(document.forms['frmbaocaocv'].ngaybaocao.value)+  "*@!"+ encodeURIComponent(id_user); 
	  poststr= poststr + "*@!" + loai + "*@!" + tuan + "*@!" + thang + "*@!" + nam  ; 	  
	  //alert(poststr);
	  loadtrang('ht_bctonghop', "addbctonghopdg", poststr,"") ;
}
function addbcthdg(idcv,tu,toi,congviec,danhgia,note,ngaytao,del)
{ 

	var loai = document.forms['frmbaocaocv'].bcth_loaibc.value ;
	var tuan = document.forms['frmbaocaocv'].bcth_tuan.value ;
	var thang = document.forms['frmbaocaocv'].bcth_thang.value ;
	var nam = document.forms['frmbaocaocv'].bcth_nam.value ;

	if (del != '')
	{
		var n = confirm("Bạn có muốn xóa không");
		if(n == false)
		{
			return false;			
		}

		poststr="del="+	 encodeURIComponent(del)+  "*@!"+ encodeURIComponent(ngaytao) +  "*@!"+ encodeURIComponent(id_user); 
    	poststr= poststr + "*@!" + loai + "*@!" + tuan + "*@!" + thang + "*@!" + nam  ; 	
	   
        loadtrang('ht_bctonghop', "addbctonghopdg", poststr,"") ;
			 
		return false;
	}

		poststr="DATA="+    encodeURIComponent(idcv) +  "*@!"+ encodeURIComponent(tu)+  "*@!"+ encodeURIComponent(toi)+  "*@!"+ encodeURIComponent(congviec)+  "*@!"+ encodeURIComponent(danhgia)+  "*@!"+ encodeURIComponent(note)+  "*@!"+ encodeURIComponent(ngaytao)+  "*@!"+ encodeURIComponent(id_user); 
	  poststr= poststr + "*@!" + loai + "*@!" + tuan + "*@!" + thang + "*@!" + nam  ;
	 //  alert(poststr);
      loadtrang('ht_bctonghop', "addbctonghopdg", poststr,"") ;
  //   document.forms['frmbaocaocv'].ngayluu.value = 'chualuu';
	
  
}

function xembh(id)
{
	   poststr="DATA="+    encodeURIComponent(id) +   "*@!"+ encodeURIComponent(id_user); 
       loadtrang('ht_baihoc', "xemhoctap", poststr,"");
 	   bcsetmuc('4');
}
function xemtt(id)
{
	   xemtintuc(id,'ht_baihoc')	
//	   poststr="DATA="+    encodeURIComponent(id) +   "*@!"+ encodeURIComponent(id_user); 
 //      loadtrang('ht_baihoc', "xemtintuc", poststr,"");
	   bcsetmuc('4');
}
function savettbc()
{
}
function setthongtin(ngay,thang,nam,thu)
{
   
	document.getElementById('Ngaybccv').innerHTML =  thu + ' : ' + ngay + '/'+thang+'/'+nam  ;			 
	
// 	if (document.forms['frmbaocaocv'].ngayluu.value != "" )
//	{
 //  	   var n = confirm("Bạn chưa lưu thông tin báo cáo, bạn có muốn lưu hay không ???");
//		if(n == true)
//		{
//			document.forms['frmbaocaocv'].ngayluu.value =  '' ;
//			savebaocaocv(document.forms['frmbaocaocv'].ngaybaocao.value) ;
//		}
//	}
	document.forms['frmbaocaocv'].ngaybaocao.value = ngay + '/'+thang+'/'+nam ;	
	document.forms['frmbaocaocv'].ngayso.value = ngay + '_'+thang+'_'+nam;	

	
	document.getElementById('ngaybc').innerHTML =  thu + ' ' + ngay + '/'+thang+'/'+nam  ;
	 
	poststr="DATA="+    encodeURIComponent(document.forms['frmbaocaocv'].ngaybaocao.value)+  "*@!"+ encodeURIComponent(id_user);  
    loadtrang('thongtincv', "findbaocaonv", poststr,"taomang") ;
	
 	poststr="DATA="+    encodeURIComponent(document.forms['frmbaocaocv'].ngaybaocao.value)+  "*@!"+ encodeURIComponent(id_user);  
    loadtrang('muctieungay', "findmuctieu", poststr,"") ;

	poststr="DATA="+    encodeURIComponent(document.forms['frmbaocaocv'].ngaybaocao.value)+  "*@!"+ encodeURIComponent(id_user); 
	
    loadtrang('dgmuctieungay', "finddgmuctieu", poststr,"") ;

	poststr="DATA="+    encodeURIComponent(document.forms['frmbaocaocv'].ngaybaocao.value)+  "*@!"+ encodeURIComponent(id_user);  
	
    loadtrang('HT_yeucau', "findyeucau", poststr,"taomangycnv") ;
 
	poststr="DATA="+    encodeURIComponent(document.forms['frmbaocaocv'].ngaybaocao.value)+  "*@!"+ encodeURIComponent(id_user);  
	
    loadtrang('ht_dgmts', "finddgmuctieus", poststr,"") ;	
	if (document.forms['frmbaocaocv'].chucnang.value == '5' )
	{
		 	
		bcsetmuc(2);
   	  document.getElementById('ht_bctonghop').innerHTML = "<div align='center' style='color:#FF00FF;padding:20px;font-size:16px'><br /><br /><br /><br /><strong> Chọn \"Tuần\" hoặc \"Tháng\" hay \"Năm\" để xem kế hoạch .</strong></div>" ;	
	}
	


}



function settypebc(valu)
{
	document.getElementById('dachon').value =  valu ;
}

  function editbcthsnv(idcv,tu,toi,congviec,danhgia,note,ngaytao,del)
  {  

   	addbckhsnv(idcv,tu,toi,congviec,danhgia,note,ngaytao,del) ;
  }
  
   function savebcthsnv(idcv,tu,toi,congviec,danhgia,note,ngaytao,del)
  { 
  
	if  (trim(congviec) =='')
		{
			alert('Bạn chưa nhập công việc!!!');
			document.forms['frmbaocaocv'].cv.focus() ;
			return false ;
		}
 
	addbckhsnv(idcv,tu,toi,congviec,danhgia,note,ngaytao,del) ;
  // document.getElementById('luubaocaocv').disabled =  '' ;
	
  }
   function addbckhsnv(idcv,tu,toi,congviec,danhgia,note,ngaytao,del)
  { 
 	var loai =  document.forms['frmbaocaocv'].bcth_loaibc.value ;
	var tuan =  document.forms['frmbaocaocv'].bcth_tuan.value ;
	var thang=  document.forms['frmbaocaocv'].bcth_thang.value ;
	var nam  =  document.forms['frmbaocaocv'].bcth_nam.value ;
  
	if (del != '')
	{
		var n = confirm("Bạn có muốn xóa không");
		if(n == false)
		{
			return false;			
		}

		poststr="del="+	 encodeURIComponent(del)+  "*@!"+ encodeURIComponent(ngaytao) +  "*@!"+ encodeURIComponent(document.forms['frmbaocaocv'].nhanvien.value); 
    	poststr= poststr + "*@!" + loai + "*@!" + tuan + "*@!" + thang + "*@!" + nam  ; 	
 
        loadtrang('ht_kehoachs', "addbctonghopsnv", poststr,"") ;
			 
		return false;
	}

		poststr="DATA="+    encodeURIComponent(idcv) +  "*@!"+ encodeURIComponent(tu)+  "*@!"+ encodeURIComponent(toi)+  "*@!"+ encodeURIComponent(congviec)+  "*@!"+ encodeURIComponent(danhgia)+  "*@!"+ encodeURIComponent(note)+  "*@!"+ encodeURIComponent(ngaytao)+  "*@!"+ encodeURIComponent(id_user); 
	  poststr= poststr + "*@!" + loai + "*@!" + tuan + "*@!" + thang + "*@!" + nam  ; 	
	   
      loadtrang('ht_kehoachs', "addbctonghopsnv", poststr,"") ;
}
 