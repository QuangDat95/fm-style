 
var mangsp = new Array() ;
var mangsp1 = new Array() ;
var mangtam = new Array() ;

var x,khachduatien ;
 //=======================================================
 function doinhac(n)
 {
	document.getElementById('nhac').src="images/tb"+n +".wav" ;
	document.getElementById('nhac').play();
 }
function addex(idsp,ten,code,dongia,loaitien,soluong,chietkhau,ghichu,giachan){ 
 
	var dg =dongia ;
	dg =dg.replace(',','');
	dg =dg.replace(',','');
  
	if 	(trim(soluong) == '' || laso(soluong) == 0)
	{
      alert('Bạn chưa nhập số lượng!!!');document.getElementById('soluong').focus(); return;	
	}
	//alert(document.getElementById('sl').value > soluong);
 
       mangsp[idsp] = new Array(code,ten,soluong,dongia,chietkhau,loaitien,ghichu);	   
 	
	//if(document.getElementById('tenform').innerHTML== "xuatkho" )	{ capxuatgia(idsp,dongia) ;}  
 
} 

function laydulieue()
{ 
 	 
	 var table = document.getElementById("tbex"); 
	 var totalRows = document.getElementById("tbex").rows.length;
 	var totalCol = 5; // enter the number of columns in the table minus 1 (first column is 0 not 1)
	 
	for (var x = 1; x <   totalRows ; x++)
	  {
	 // for (var y = 1; y <= totalCol; y++)
	//	{
	//	   alert(table.rows[x].cells[y].innerHTML);
	//	}
		// addpro(idsp,ten,code,dongia,loaitien,soluong,thue,ghichu)
	 
		  addex(table.rows[x].cells[1].innerHTML,table.rows[x].cells[3].innerHTML,
		        table.rows[x].cells[2].innerHTML ,table.rows[x].cells[5].innerHTML,
				 "",table.rows[x].cells[4].innerHTML,0,"") ;
				
	  }
	  xuatsp();
	     document.getElementById('nhac').play();
//To display a single cell value enter in the row number and column number under rows and cells below:
    goidongid('hiennhapexcel') ;
}

	
function ajaxFileUpload()
{
	var  tt = id_user;
	
 
	var  nn =   new Date().getTime(); ;
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
				url:'fileuploadgg.php?us=' + tt + '_'+ nn,
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
							 kq =data.msg ;
							 
							 mkq = kq.split('*') ;

						    hienthidulieu();
							 
						}
					}
				},
				error: function (data, status, e)
				{		
					if ( data.e == 'vuotdungluong' )
					{
						alert("Vượt dung lượng cho phép 8M !!!");				 
					}
				}
			}
		)
		
		return false;

	}
 function xuatbaoloi(tb)
 { 
    alert(tb) ; 
 }
 	
function hienthidulieu()
{ 
	   var t1 ;
	 //  t1=document.getElementById('idchuyen').value;
	   poststr ="DATA="+encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(0) ;
 	   loadtrang('hienthiexcel', "xuatkhoexcelht", poststr,"") ;		
 
}
	
function setlailuu(v)
{ 	
	
    document.getElementById('luu').disabled= "";
	document.getElementById('khoa').disabled= "";
	 
 } 
 
 function xuly5()
{
	
	 tam=document.getElementById('ketqualuu').innerHTML ;
	 var  n=tam.split("*loi#"); 
         if (n[1]!="" && n.length>1 ) {alert(n[1]); return; }

	 
	document.getElementById('luu').disabled= false; 
	document.getElementById('khoa').disabled= false; 	
	document.getElementById('huyphieu').disabled= false; 	
	document.getElementById('inan').disabled= ""; 	
	document.getElementById('timk').click() ; 
}

 function goiphuchoi(p,n)
{ 	
 sp = document.getElementById('idgoi').value  ;	
 if ( n.length <30 ){alert('Bạn chưa ghi chú cụ thể vui lòng ghi rỏ lý do phục hồi vào phần ghi chú ! ');return;}
 if (sp!=p) return ;
 var tt=0 ;
 var cf = " Bạn có chắc chắn muốn phục hồi phiếu này hay không ? " ;
 if(thongbao(cf) == true)
 {	 
 
  poststr="DATA="+   encodeURIComponent(sp)+  "*@!"+ encodeURIComponent("nx")+  "*@!"+ encodeURIComponent(tt)+  "*@!"+ encodeURIComponent(n);
  loadtrang('ketqualuu',"xuatkhotongphuchoi", poststr,"xuly5") ;		
  
 }
	 
 } 
 
function xulychung()
{
 	 tam=document.getElementById('ketqualuu').innerHTML
	// alert (tam)
	 var  n=tam.split("**#"); 
	 
     if (n[1]=="") {alert('cố lỗi xảy ra hoặc đường truyền bị gián đoạn cần đăng nhập lại !'); return; }
	 document.getElementById('idgoi').value= n[1] ;	 
	  if (n[2]!='')  document.getElementById('sochungtu').value =n[2];
	  
	    if (n[3]!='') {alert(n[3]);  }
	// document.getElementById('ketqualuu').innerHTML=""; 
	 var timet
	
	 document.getElementById('luu').value= "Cập Nhập";
     clearTimeout(timet);
	 timet=setTimeout( function daluuxong() { setlailuu('1') },900);
	
}

function luuphieuxuat()
{ 		
  
   var idluu,ngayxuatkho,sochungtu,xuatkho,tigia,lydo,khachhang,ghichu,tenkhachhang,tenlydo,idgoi,khachdua,idnhan,idxuat;
 
   sochungtu= document.getElementById('sochungtu').value ;
   tigia= document.getElementById('TiGia').value ;
   lydo= document.getElementById('lydo').value ;
   idnhan= document.getElementById('khonhan').value ;
   idxuat= document.getElementById('khochuyen').value ;
   ghichu = document.getElementById('note').value ; 
   vat = document.getElementById('VAT').value ; 
   ghichu = document.getElementById('note').value ; 
   //  alert(idgoi)
   idgoi= document.getElementById('idgoi').value ; 
  
 	if(kiemtraphieu()==true)
 	{
		 document.getElementById('luu').disabled= true;
	 	 poststr= "DATA="+idgoi+"*@!"+ encodeURIComponent(mangthanhchuoi(mangsp))+"*@!"  + encodeURIComponent(sochungtu) ; 
		 poststr += "*@!"+ encodeURIComponent(idnhan)+  "*@!"+ encodeURIComponent(idxuat)+  "*@!"+ encodeURIComponent(lydo) ; 
		 poststr += "*@!"+ encodeURIComponent('')+  "*@!"+ encodeURIComponent(idxuat)+  "*@!"+ encodeURIComponent(ghichu) ; 
		 poststr += "*@!"+ encodeURIComponent(vat)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(tenkhachhang) ; 
		 poststr += "*@!"+ encodeURIComponent('diachi')+  "*@!"+ encodeURIComponent(0) +  "*@!"+ encodeURIComponent(khachdua)  ; 
   		 loadtrang('ketqualuu', "xuatkholuutong", poststr,"xuly") ;
 	}
	return false;
}
//=======================================================
  

 
function setsanpham(id,ten,ma,gia,dvt,giagia,baohanh,sl) // baohanh => giachan
{ 
   if (sl>0)
   {
  	document.getElementById('idsp').value= id; 
	document.getElementById('tensp').value= ten; 
	document.getElementById('masp').value= ma; 
	document.getElementById('dongia').value = gia;
  	document.getElementById('giachan').value = baohanh ;
 	document.getElementById('sl').value = sl; 	
	document.getElementById('soluong').value = 1;
	document.getElementById('sanpham').innerHTML = "" ; 
	document.getElementById('soluong').select() ; 
	document.getElementById('codeprotk').select() ; 
	return ;
   }
   else
    alert('cảnh báo Số lượng nhỏ hoặc bằng 0 không thể xuất. ');
   	document.getElementById('idsp').value= id; 
	document.getElementById('tensp').value= ten; 
	document.getElementById('masp').value= ma; 
	document.getElementById('dongia').value = gia;
  	document.getElementById('giachan').value = baohanh ;
 	document.getElementById('sl').value = sl; 	
	document.getElementById('soluong').value = 1;
	document.getElementById('sanpham').innerHTML = "" ; 
	document.getElementById('soluong').select() ; 
	document.getElementById('codeprotk').select() ;
}  
 
function timtheomacode(v)
{ 	
	if(v.length<3) return ; 
    poststr="DATA="+    encodeURIComponent(v)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0) ;
    loadtrang('khonghienthi', "xuatkhotimtheoma", poststr,"xuly9") ;
} 

function layvesoluong(macode)
{ 
 	for (x in mangsp)
	{  
	  if ( mangsp[x][0]==macode ) return  mangsp[x][2] ;
 	}
	return  0 ;
}


function thaydoisoluong(macode,soluong)
{ 
 	for (x in mangsp)
	{  
	    if ( mangsp[x][0]==macode )    mangsp[x][2] =soluong  ;
 	}
	xuatsp() ;
	 
}

var soluongcon =0;

function xuly9()
{ 

  var tam =  document.getElementById('khonghienthi').innerHTML ;
  
  var  n=tam.split("##"); 
 
 // if(n[8] <=0) { alert("Không thể xuất khi số lượng nhỏ hoặc bằng 0."); return ;}
  
  if (n[1]=="") return;
  //  document.getElementById("sound_element").innerHTML= "<embed src='images/ding.wav' hidden=true autostart=true loop=false>";
	document.getElementById('nhac').play();
	soluongcon=parseFloat(n[8]);
	if(parseFloat(n[8])<=0 && (document.getElementById('kho').value==1 || document.getElementById('kho').value==1136 ) ){alert("số lượng phải dương mới được xuất !"); return ; }
   n[8] = 1+ parseFloat(layvesoluong(n[3])) ;
 
 
   thaydoisoluong( n[3],n[8]) ;
    
   
   setsanpham(n[1],n[2],n[3],n[4],n[5],n[6],n[9],n[8]);
   
   document.getElementById('soluong').value = n[8];
   document.getElementById('codeprotk').value ='';
   
   if (n[8]==1)   document.getElementById('add').click();
   
    
 }
var timer;
  function  goisp(v)
  {
     clearTimeout(timer);
   timer=setTimeout( function validate() { timtheomacode(v) },1100);
  }
 
 function  timdiachicc(id)
 {
    poststr="DATA="+    encodeURIComponent(id)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0); 
   loadtrang('diachicc', "timdiachicc", poststr,"") ;
 }
 
function xuly6()
{
	  
	document.getElementById('luu').disabled= true; 
	document.getElementById('khoa').disabled= true; 	
	document.getElementById('huyphieu').disabled= true; 	
	document.getElementById('inan').disabled= ""; 	
	document.getElementById('timk').click() ; 
}


function timbaogiachuyen(t1)
{
	baogiachuyen(t1) ;
	timphieu() ;
}
function xuly8()
{

 var mskh =  document.getElementById('dkh').innerHTML.split('@#@');	
 
 document.getElementById('khachhang').value =  mskh[1] ;
  
   document.getElementById('diachi').value =  mskh[3] ;
 
 var msp =  document.getElementById('dbg').innerHTML.split('@$&');
   var mang = new Array() ;
   var mgt =  new Array() ;
   	mangsp = mang ;
	for (x in msp)
	{//	alert(msp[x]);
	    mgt = msp[x].split('@$@') ;
		mangsp[mgt[1]] = new Array(mgt[1],mgt[3],(mgt[2]),mgt[4],mgt[7],mgt[6],mgt[9]);	   
	}

	xuatsp() ;
		document.getElementById('nhac').play();
	document.getElementById('luu').disabled= false; 
	document.getElementById('khoa').disabled= true; 	
	document.getElementById('huyphieu').disabled= true; 
	
}

function baogiachuyen(t1)
{
  poststr="DATA="+   encodeURIComponent(t1)+  "*@!"+ encodeURIComponent("bg")+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0);
  loadtrang('ketqualuu',"xuattubaogia", poststr,"xuly8") ;	
}

function khoaphieu()
{var tt=0 ;
 var cf = " Bạn có chắc chắn muốn khóa phiếu này hay không ? " ;
 if(thongbao(cf) == true)
 {	 
 
  sp = document.getElementById('idgoi').value  ;
  poststr="DATA="+   encodeURIComponent(sp)+  "*@!"+ encodeURIComponent("nx")+  "*@!"+ encodeURIComponent(tt)+  "*@!"+ encodeURIComponent(0);
  loadtrang('ketqualuu',"xuatkhotongkhoaphieu", poststr,"xuly6") ;		
  
 }
}



function timkiemncc(t1,t2,t3,t4,t5)
{ 
  poststr="DATA="+    encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(t3)+  "*@!"+ encodeURIComponent(t4);
  poststr= poststr +  "*@!"+ encodeURIComponent(t5)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0);
  loadtrang('hienthinhacc', "xuattimkh", poststr,"") ;
  
}
 function xuly3()
 {
	 var mang = ketqua.split('@$@');
	 document.getElementById('diachi').value = mang[0]; 
  }
 function kiemtraid(tenselec,id)
 { var t =0 ;
   var a ;
	for (x in tenselec.options)
	{
	  a= tenselec.options[x].value ;
	//  alert(x);
   	  if ( laso(a) == laso(id)) return id ;
  	  
	}
	return "" ;
 }


function  xuly7()
{
 document.getElementById('themmoi').click();		
}
function  goihuyphieu(t1,t2)
{
 var cf = " Bạn có chắc chắn muốn hủy phiếu này hay không ? " ;
 var n = confirm(cf);
 if(n == true)
	{
      poststr="DATA="+    encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0); 
     loadtrang('ketqualuu',"xuatkhohuyphieu", poststr,"xuly7") ;
	}
	
 }


 

function xuattimsanpham(t1,t2,t3,t4,t5,t6){
	
  poststr ="DATA="+encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(t3)+  "*@!"+ encodeURIComponent(t4);
  poststr = poststr +  "*@!"+ encodeURIComponent(t5)+  "*@!"+ encodeURIComponent(t6);
  loadtrang('sanpham', "xuatkhotimsp", poststr,"") ;
  
 } 
 
function setkh(t1,t2,t3)
{
		document.getElementById('tenkh').innerHTML = t2
		document.getElementById('dckh').innerHTML = t3
		document.getElementById('idkh').value = t1
		document.getElementById('hienthongbao').style.display = "none";
	    goidong()
}

 

function timsanpham(t1,t2,t3,t4,t5,t6,t7){
	
  poststr="DATA="+encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(t3)+  "*@!"+ encodeURIComponent(t4);
  poststr= poststr +  "*@!"+ encodeURIComponent(t5)+  "*@!"+ encodeURIComponent(t6)+  "*@!"+ encodeURIComponent(t7);
  loadtrang('sanpham', "xuatkhotongtimsp", poststr,"") ;
  
 } 
 
  
//=======================================================
 
function clearchon() 
 {
 
	document.getElementById('NameTK').value= '' ;		
	document.getElementById('codeprotk').value= '' ;		
	document.getElementById('code').value= '' ;		
	document.getElementById('IDGrouptk').value = '0' ;		
 	document.getElementById('sanpham').innerHTML = document.getElementById('luutimsp').innerHTML ;
 }
function kiemtraphieu()
{  

	if(document.getElementById('khochuyen').value==0)
	{
		alert('Xin vui lòng chọn nơi xuất!');
		document.getElementById('khochuyen').focus();
		return false;
	}
	if(document.getElementById('khonhan').value==0)
	{
		alert('Xin vui lòng chọn nơi nhận!');
		document.getElementById('khonhan').focus();
		return false;
	}
	
  	if(mangsp.length==0)
	{
		alert('Xin vui lòng chọn sản cần xuất!');
		document.getElementById('codeprotk').focus();
		return false;
	} 
  	if(document.getElementById('khochuyen').value==document.getElementById('khonhan').value)
	{
		alert('Nơi chuyển và nơi nhận không được trùng nhau !');
		document.getElementById('khonhan').focus();
		return false;
	} 	
    if(document.getElementById('lydo').value==0)
	{
		alert('Xin vui lòng chọn ly lo!');
		document.getElementById('lydo').focus();
		return false;
	}
	return true;
}

   
function timdsphieuxuat(t0,t1,t2,t3,t4,t5,t6,t7,t8,t9,t10)
{
  poststr="DATA="+encodeURIComponent(t0)+"*@!"+encodeURIComponent(t1)+"*@!"+ encodeURIComponent(t2)+"*@!"+ encodeURIComponent(t3)+"*@!"+ encodeURIComponent(t4);
  poststr= poststr +  "*@!"+ encodeURIComponent(t5)+  "*@!"+ encodeURIComponent(t6)+  "*@!"+ encodeURIComponent(t7)+  "*@!"+ encodeURIComponent(t8)+  "*@!"+ encodeURIComponent(t9)+  "*@!"+ encodeURIComponent(t10) ;
  if(t0==2)  loadtrang('httimxuat', "xuatkhotongtimchitiet", poststr,"") ; else  loadtrang('httimxuat', "xuatkhotimtong", poststr,"") ;	
  
	
}
 
function xuly4()
{
	//  alert( ketqua)
   var ma = ketqua.split('&$&');
   var m = ma[0].split('@$@');
  // alert( m[29])
  //0     1   2       3       4     5    6    7         8      9    10    11   12    13       14     15      16   17   18     19     20      21   22      23   24
 //ID,IDKho,IDNhaCC,IDNhap,NgayNh,SoCT,LyDo,SoNgayNo,IDTKNo,IDTKCo,TiGia,VAT,GhiChu,NgayTao,IDTao,NguoiGiao,Loai,ten,diachi,tenkho,tenlydo,tenN,diachiN,dakhoa,soxe

   document.getElementById('nguoilap').value =  m[24] ;
   document.getElementById('sochungtu').value = m[5];  
   document.getElementById('kho').value = m[8];
   document.getElementById('TiGia').value = m[10];
   document.getElementById('lydo').value = m[6];
 
   document.getElementById('khonhan').value = m[8];
   document.getElementById('khochuyen').value = m[9];
  // document.getElementById('tenkh').innerHTML = m[17];
   document.getElementById('idgoi').value = m[0] ;
    document.getElementById('note').value = m[12]; 
	//document.getElementById('khachdua').value = m[29]; 
	 document.getElementById('ngaynhap').value = m[30]; 
  // document.getElementById('VAT').value = m[11]; 
    var msp =  ma[1].split('@$&');
   var mang = new Array() ;
   var mgt =  new Array() ;
   	mangsp = mang ;
	for (x in msp)
	{ // alert(msp[x]);
	    mgt = msp[x].split('@$@') ;
		mangsp[mgt[2]] = new Array(mgt[3],mgt[7],(mgt[4]),mgt[5],mgt[12],mgt[6],mgt[10]);	
		//                   Array(code  ,ten   ,soluong,        dongia , chietkhau ,loaitien,ghichu);	  
	}
	xuatsp() ;
	timphieu() ;
	  $('.js-khachhang').select2();
 }
 
function setlaiphieuxuat(t1,t2)
{
	  poststr="DATA="+ "0*@!" +  encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0);
	  loadtrang('khonghienthi', "xuatkhogoitong", poststr,"xuly4") ;		
	
 	  poststr="DATA="+ "0*@!" +  encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0);
	 
 //	  loadtrang('httimlai', "xuatkhoht", poststr,"") ;		
 	 if (t2 == "0")
		{	
		document.getElementById('luu').disabled= false;	
		document.getElementById('khoa').disabled= false;	
		document.getElementById('copy').disabled= false;
			document.getElementById('huyphieu').disabled= false; 	
		}
		else
		{	
		document.getElementById('luu').disabled= true; 
		document.getElementById('khoa').disabled= true; 
		document.getElementById('copy').disabled= false; 
		document.getElementById('huyphieu').disabled= true; 	
		}	
	 document.getElementById('inan').disabled= ""; 
}
 

function timphieu()
{
 
	
    if (document.getElementById('hienthongbao').style.display =="")
	{
		document.getElementById('hienthongbao').style.display = "none";
		document.getElementById('timkhachhanght').style.display = '' ;	
		document.getElementById('timphieuxuat').style.display = 'none' ;	
 	}else
	{
		document.getElementById('hienthongbao').style.display = "";
		document.getElementById('timkhachhanght').style.display = 'none' ;	
		document.getElementById('timphieuxuat').style.display = '' ;	
	}
	
}
   

function setnguoc(id,ten,ma,sl,gia,lt,chietkhau,note)
{ 
	document.getElementById('idsp').value= id; 
	document.getElementById('ten').value= ten; 
	document.getElementById('ma').value= ma; 
	
	document.getElementById('tensp').value= ten; 
	document.getElementById('masp').value= ma; 
	
	document.getElementById('soluong').value= txtFormatj(sl); 
	document.getElementById('dongia').value= txtFormatj(gia); 
//	document.getElementById('giamgia').value= '0'; 
	document.getElementById('loaitien').value= lt; 
 //	document.getElementById('chietkhau').value= chietkhau; 
 	document.getElementById('ghichu').value= note;  
	
	document.getElementById('dongia').focus(); 
}

 //===================================================================================== 
function kiemtrachuyen(idsp)
{ 
	if (idsp == '')
	{
		alert('Bạn chưa chọn sản phẩm !!!')
		document.getElementById('ten').focus() ; 
		return false;
	}
	if (document.getElementById('dongia').value == '')
	{
		alert('Bạn chưa nhập đơn giá!!!');	
		document.getElementById('dongia').focus() ; 
		return false;
	}
	return true;
}

function copymang(mangvao,mangra)
{
	for (x in mangvao)
	{
		mangra[x] =	mangvao[x] ;
	}
}

 
 


function sapnguoc()
{  
    var x,t,tam = new Array() ;
    var tam2 = new Array() ;    	
	 
	copymang(mangsp,tam) ;

	 
	var index = tam.indexOf(element) ;
	while (index != -1)
	{
	  tam1.push(index);
	  index = array.indexOf(element, ++index);
	  alert(index);
	}	

  }
 
 
 
function addpro(idsp,ten,code,dongia,loaitien,soluong,chietkhau,ghichu,giachan){ 
	if 	(idsp == '')
	{
      alert('Bạn Chưa chọn hàng hóa!!!');document.getElementById('NameTK').focus(); return;	
	}
	var dg =dongia ;
	dg =dg.replace(',','');
	dg =dg.replace(',','');
 
	if (laso(dongia) == 0)
	{
		 var cf = "Bạn chưa nhập đơn giá!!! \n\nBạn có muốn nhập hay không ?" ;
		var n = confirm(cf);
		if(n == true)
 		{
			document.getElementById('dongia').focus() ; 
			return false;	
	    }	
	}
	if 	(trim(soluong) == '' || laso(soluong) == 0)
	{
      alert('Bạn chưa nhập số lượng!!!');document.getElementById('soluong').focus(); return;	
	}
	//alert(document.getElementById('sl').value > soluong);
	var sl = laso(document.getElementById('sl').value) ;
//	alert( sl + '=='+   soluong + ' ' + soluongcon ) ;
	if(parseFloat(soluongcon) < parseFloat(soluong) )
	{
		if( document.getElementById('kho').value==1 || document.getElementById('kho').value==1136 ) 
		{
			alert('Trong kho chỉ còn "' + sl + '" sản phẩm, vui lòng nhập thêm vào kho hoặc xuất ít hơn ' + sl +  ' !!!');
			document.getElementById('soluong').focus() ;
			document.getElementById('soluong').select() ;
			return ;
		}
	}
       mangsp[idsp] = new Array(code,ten,soluong,dongia,chietkhau,loaitien,ghichu);	   
	   document.getElementById('codeprotk').value='' ;
  	   xuatsp() ;
	   document.getElementById('nhac').play();
	//if(document.getElementById('tenform').innerHTML== "xuatkho" )	{ capxuatgia(idsp,dongia) ;}  
	document.getElementById('codeprotk').select() ;
} 


function xoapt(id)
{ 
   
  var mt = new Array() ;
	if 	(id!= '')
	{
		for (x in mangsp)
		{
			if (x != id)
			{				
				mt[x] =	mangsp[x] ;
			}
		}
		mangsp = mt ;	
        xuatsp() ;
    }
	 document.getElementById('idsp').value=''; 
	document.getElementById('masp').value=''; 
	document.getElementById('tensp').value=''; 	
	document.getElementById('soluong').value=''; 
	document.getElementById('dongia').value=''; 
// 	document.getElementById('chietkhau').value=''; 
	document.getElementById('loaitien').value='';  
  	document.getElementById('ghichu').value=''; 
 } 

function setthongtin(id)
{
	 
 	document.getElementById('idsp').value= id; 
	document.getElementById('masp').value= mangsp[id][0]; 
	document.getElementById('tensp').value= mangsp[id][1];  	
	document.getElementById('soluong').value= mangsp[id][2]; 
	document.getElementById('dongia').value= mangsp[id][3]; 
 	//document.getElementById('chietkhau').value= mangsp[id][4];
	document.getElementById('loaitien').value= mangsp[id][5]; 
  	document.getElementById('ghichu').value= mangsp[id][6]; 
 	document.getElementById('dongia').focus(); 

}
 
function xuatsp()
{   
	var x,stt,str ="" ;	stt= 0 ;
	var thanhtien,tong ,tongsl ;
	thanhtien = 0 ; tong = 0 ;tongsl = 0 ;
	   str = ' <table width="100%" border="0" cellpadding="0" cellspacing="0">' ;
	   str += '    <tr bgcolor="#F8E4CB"> ';
	   str += ' <td width="29"  align="center" class="cothienthi" height="23"><b>STT</b></td> ';
	   str += ' <td width="115" align="center" class="cothienthi"><strong>Mã Hàng Hóa </strong></td> ';
	   str += ' <td width="350" align="center" class="cothienthi"><strong>Tên Hàng Hóa</strong></td> ';
	   str += ' <td width="45"  align="center" class="cothienthi"><strong>SL</strong></td> ';
	   str += ' <td width="105" align="center" class="cothienthi"><strong>Đơn Giá </strong></td> ';
	 
	   str += ' <td width="100" align="center" class="cothienthi"><strong>Thành Tiền </strong></td> ';
	   str += ' <td width="300" align="center" class="cothienthi"><strong>Ghi Chú </strong></td> ';
 	   str += ' <td width="30"  align="center" class="cothienthi"><strong>X&#243;a</strong></td> ';
	   str += ' </tr>';
	var mau,h1,h12 ;
	for (x in mangsp)
	{  
		
		 if(mau == "white")
		{	{
			 mau = "#EEEEEE";
			 hl = "Normal4" ;
			 hl2 = "Highlight4";
			}
			 hl = "Normal4" ;
			 hl2 = "Highlight4"; 
		}else { 
		mau = "white";
		hl = "Normal5" ;
		hl2 = "Highlight5";
		} 
	thanhtien =  doiso(mangsp[x][3]) *  doiso(mangsp[x][2])    ;	
	thanhtien  = thanhtien - thanhtien * mangsp[x][4]/100 ;
	tong = tong + thanhtien *1  ;		
	tongsl = 1*tongsl + mangsp[x][2]*1 ;
    stt = stt + 1;
 	str +='<TR onMouseOver="this.className=\''+ hl2+'\'" onMouseOut="this.className=\''+h1+'\'" bgcolor="'+mau+'" style="cursor:pointer" onclick="setthongtin(\''+ x + '\')">';
	str += ' <td class="cothienthi"  align="Right" height="23">'+ stt +'</td>';	
	str += ' <td class="cothienthi"  align=""  >&nbsp;' + mangsp[x][0] +'</td>';
	str += ' <td class="cothienthi"  align=""  >&nbsp;' + mangsp[x][1] +'</td>';
	str += ' <td class="cothienthi"  align="right"  >&nbsp;' + mangsp[x][2] +'</td>';
	str += ' <td class="cothienthi"  align="right"  >&nbsp;' + txtFormatj(mangsp[x][3]) +'</td>';
	 
	str += ' <td class="cothienthi"  align="right"  >&nbsp;' + txtFormatj(thanhtien) +'&nbsp;</td>';
	str += ' <td class="cothienthi"  align=""  >&nbsp;' + mangsp[x][6] +'</td>';
 	str += ' <td class="cothienthi"  align="center"  ><img onclick="xoapt(\''+ x + '\')" title=\"Xóa Mục\"  src="images/delete.gif" border="0"></td>';
 	str += ' </Tr>';		
		
	}
	str += ' <Tr class="cothienthi"><td colspan="6" align="right" ><b>Tổng cộng</b> </td><td  align="right"><b>'+ txtFormatj(tong) +'</b>&nbsp;</td><td></td>';		
	str += ' </Tr>';		
  str +='</table>';
     document.getElementById('tongsl').value = tongsl ;
	document.getElementById('sanphamxuat').innerHTML = str ;
    document.getElementById('tongtien').innerHTML =   txtFormatj(tong);
	 
	 
 
	//  document.getElementById('tralai').innerHTML =  document.getElementById('tralai').innerHTML.replace('-,','-');
}
//===================================================================================== 
var tongtienhang ;
function tinhtien(giatri)
{ 	 
    giatri =  giatri.replace(',','');
	giatri =  giatri.replace(',','');
	giatri =  giatri.replace(',','');
    tongtienhang = document.getElementById('tongtien').innerHTML  ;
	tongtienhang =  tongtienhang.replace(',','');
	tongtienhang =  tongtienhang.replace(',','');
	tongtienhang =  tongtienhang.replace(',','');
	 
    document.getElementById('tralai').innerHTML =   txtFormatj(parseFloat(giatri)-parseFloat(tongtienhang) );	
    document.getElementById('tralai').innerHTML =  document.getElementById('tralai').innerHTML.replace('-,','-');
}


function goiin()
{ 		
	var so = document.getElementById('sochungtu').value ;
	var st ;
	st = "xuatkhotongin.php?id=" + so  ;
	window.open(st,'popup','toolbar=no,status=no,scrollbars=yes,location=no,menubar=no,directories=no, titlebar=no') ;
}
function goiinxuat()
{ 		
	var so = document.getElementById('sochungtu').value ;
	var st ;
	st = "xuatkhoin.php?id=" + so  ;
	window.open(st,'popup','toolbar=no,status=no,scrollbars=yes,location=no,menubar=no,directories=no,width=1000,height=600,titlebar=no') ;
}
function lamlai()
{
	document.forms['xuatsp'].btnUpdate.disabled = '' ;
}
 


 