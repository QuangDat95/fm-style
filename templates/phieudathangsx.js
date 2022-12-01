 
 window.onload=function(){
 document.body.onkeydown = function(e){
	 // alert(e.keyCode);	 
	  if (e.keyCode==27    )    {document.getElementById('themmoi').click();    return;    }
  
  };
}


var mangsp = new Array() ;
var mangsp1 = new Array() ;
var mangtam = new Array() ;
var dakhoa =false ;
var x,khachduatien,tongsl,km ;
 km=0;
 //=======================================================
  function doinhac(n)
 {
	document.getElementById('nhac').src="images/tb"+n +".wav" ;
	document.getElementById('nhac').play();
	 }
function setlailuu(v)
{ 	
	
    document.getElementById('luu').disabled= "";
	document.getElementById('khoa').disabled= "";
	 
 } 
  
 
 
 
function xuly3()
{
 	 tam=document.getElementById('ketqualuu').innerHTML
	 
	  km =0;
	  var  n=tam.split("**#"); 
 	 if (n[1]=='-1') {alert('Không tìm thấy mã khuyến mãi này trong hệ thống !') ; document.getElementById('bot').value =0;}
	 else if (n[1]=='-2') {alert('Mã khuyến mãi này đã sử dụng vào ngày ' + n[2] ) ; document.getElementById('bot').value =0;}
	 else if (n[1]=='-3') {alert('Mã Số không hợp lệ. Mã số này chỉ được áp dụng tại ' + n[2] ) ; document.getElementById('bot').value =0;}
	 else 
	 {
		 if (n[1]>100) document.getElementById('bot').value =n[1] ;
		 else 
		 { alert('mã thẻ này được giảm giá ' + n[1] + '% trên tổng hóa đơn !') ;
		   document.getElementById('bot').value =0; 
		   km =n[1] ;
		 }
	 }
}


function setchietkhau(ck)
{ 
	document.getElementById('chietkhau').value = ck ;
}
function xulychung()
{
 	 tam=document.getElementById('ketqualuu').innerHTML
	 var  n=tam.split("**#"); 
	 
     if (n[1]=="")  { alert('cố lỗi xảy ra hoặc đường truyền bị gián đoạn cần đăng nhập lại !'); return; }
	
	 if (n[1]=="8") { alert( n[2] );document.getElementById('luu').disabled= false;  return; }
	// document.getElementById('ketqualuu').innerHTML=""; 
	 document.getElementById('idgoi').value= n[1] ;	 
 	 if (n[2]!=''){ document.getElementById('sochungtu').value =n[2]; luuanh() };
	
	 var timet
	
	 document.getElementById('luu').value= "Cập Nhập";
     clearTimeout(timet);
	// document.getElementById('khoa').click() ;
	 dakhoa =true ;
	// khoaphieu() ;
	// timet=setTimeout( function daluuxong() { setlailuu('1') },900);
	
}
function xuly8()
{  tam =document.getElementById('ketqualuu').innerHTML ;
	var  n=tam.split("*tb#"); 
 	 alert(n[1]) ; 
	document.getElementById('ketqualuu').innerHTML= "" ;
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
  loadtrang('ketqualuu',"phieudathangsxphuchoi", poststr,"xuly5") ;		
  
 }
	 
 } 
 
function xoaphieux(sophieu)
{ 		
    var cf = " Bạn có chắc chắn muốn xóa phiếu "+sophieu+" này hay không ? " ;
 var n = confirm(cf);
 if(n == true)
	{
      poststr="DATA="+    encodeURIComponent(sophieu)+  "*@!"+ encodeURIComponent(sophieu)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0); 
     loadtrang('ketqualuu',"xuatkhoxoa", poststr,"xuly8") ;
	}
}
function luuphieuxuat()
{ 

	
  if (document.getElementById('luu').disabled) return ;
  		
  var cf = " Bạn có chắc chắn muốn khóa phiếu này hay không ? " ;
  if(thongbao(cf) == true)
  {	 
  var idluu,ngayxuatkho,sochungtu,xuatkho,nhacc,datthang,khachhang,ghichu,tenkhachhang,tenlydo,idgoi,qua,diem,ngaygiaohang,nhanviendat;
 
   sochungtu= document.getElementById('sochungtu').value ;
   
   datthang= document.getElementById('datthang').value ;
   nhacc= document.getElementById('nhacc').value ;
   nhanviendat= document.getElementById('nhanviendat').value ;
   
   ghichu = document.getElementById('note').value ; 
   vat = document.getElementById('VAT').value ; 
   ghichu = document.getElementById('note').value ; 
   ghichuch = document.getElementById('ghichu').value ; 
   ngaygiaohang = document.getElementById('ngaygiaohang').value ; 
   qua = document.getElementById('chonnhanqua').checked ;
   diem = document.getElementById('diem').value ;
   makm = document.getElementById('makm').value ;
   
   //  alert(idgoi)
   idgoi= document.getElementById('idgoi').value ; 
  var chuoianhluu='';
    
  if(mangtam){
	
 
	  mangtam={ ...mangtam };
		chuoianhluu=JSON.stringify(mangtam);
  }

 	if(kiemtraphieu()==true)
 	{
		
		
		  document.getElementById('luu').disabled= true;
	 	 poststr= "DATA="+idgoi+"*@!"+ encodeURIComponent(mangthanhchuoi(mangsp))+"*@!"  + encodeURIComponent(sochungtu) ; 
		 poststr += "*@!"+ encodeURIComponent(xuatkho)+  "*@!"+ encodeURIComponent(datthang)+  "*@!"+ encodeURIComponent(nhacc) ; 
		 poststr += "*@!"+ encodeURIComponent('')+  "*@!"+ encodeURIComponent(nhacc)+  "*@!"+ encodeURIComponent(ghichu) ; 
		 poststr += "*@!"+ encodeURIComponent(vat)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(tenkhachhang) ; 
		 poststr += "*@!"+ encodeURIComponent(ghichuch)+  "*@!"+ encodeURIComponent(nhanviendat) +  "*@!"+ encodeURIComponent(''); 
		 poststr += "*@!"+ encodeURIComponent(ngaygiaohang) +  "*@!"+ encodeURIComponent(diem)+  "*@!"+ encodeURIComponent(makm)+  "*@!"+ encodeURIComponent(chuoianhluu); 
   		 loadtrang('ketqualuu', "phieudathangsxluu", poststr,"xuly") ;
 	}
	return false;
 }
}


//=======================================================
  

 
function setsanpham(id,ten,ma,gia,dvt,giagia,baohanh,sl,mt) // baohanh => giachan
{   if (giagia<km) giagia =km;
 
  	document.getElementById('idsp').value= id; 
	document.getElementById('tensp').value= ten; 
	document.getElementById('masp').value= ma; 
	document.getElementById('mt').value= mt; 
	document.getElementById('dongia').value = gia;
  	document.getElementById('giachan').value = baohanh ;
 	document.getElementById('sl').value = sl; 	
	document.getElementById('soluong').value = 1;
	document.getElementById('sanpham').innerHTML = "" ; 
	document.getElementById('soluong').select() ; 
	//document.getElementById('chietkhau').value = giagia;
	
	//document.getElementById('chietkhauc').value = giagia;
	document.getElementById('codeprotk').select() ;
}  
 
function timtheomacode(v)
{ 	
	v= document.getElementById('codeprotk').value ;
    poststr="DATA="+    encodeURIComponent(v)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0) ;
    loadtrang('khonghienthi', "xuattimtheoma", poststr,"xuly9") ;
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



function xuly9()
{ 

  var tam =  document.getElementById('khonghienthi').innerHTML ;
 // alert(tam)
  var  n=tam.split("##"); 
  
   if (n[1]=="") return;
   n[8] = 1+ parseFloat(layvesoluong(n[3])) ;
   thaydoisoluong( n[3],n[8]) ;
   //  document.getElementById("sound_element").innerHTML= "<embed src='images/ding.wav' hidden=true autostart=true loop=false>"; 
	 document.getElementById('nhac').play();
   //alert(n[6])
   setsanpham(n[1],n[2],n[3],n[4],n[5],n[6],n[9],n[8],n[11]);
   
   document.getElementById('soluong').value = n[8];
   document.getElementById('codeprotk').value ='';
   
   if (n[8]==1)   document.getElementById('add').click();
   
    
 }
var timer;
  function  goisp(v)
  {
     clearTimeout(timer);
   timer=setTimeout( function validate() { timtheomacode(v) },500);
  }
 
 
function xuly2()
{
 	 document.getElementById('search2').click();	 
	 
}

 function khachhangtimtheomacode(v)
{ 	
	  document.getElementById('search2').click();	 
  //  poststr="DATA="+    encodeURIComponent(v)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0) ;
  //  loadtrang('khonghienthi', "khachhangtimtheoma", poststr,"xuly2") ;
} 
  
  function  goikh(v)
  {
     clearTimeout(timer);
    timer=setTimeout( function validate() { khachhangtimtheomacode(v) },500);
  }


 function  timdiachicc(id)
 {
    poststr="DATA="+    encodeURIComponent(id)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0); 
   loadtrang('diachicc', "timdiachicc", poststr,"") ;
 }
 


function timbaogiachuyen(t1)
{
	baogiachuyen(t1) ;
	timphieu() ;
}
 
 
function xuly6()
{
 	 tam=document.getElementById('ketqualuu').innerHTML ;
	 var  n=tam.split("*loi#"); 
     if (n[1]!="" && n.length>1 ) {alert(n[1]); return; }
	document.getElementById('luu').disabled= true; 
	document.getElementById('khoa').disabled= true; 	
	document.getElementById('huyphieu').disabled= false; 	
	document.getElementById('inan').disabled= ""; 	
	document.getElementById('timk').click() ; 
	//goiin() ;
}

function khoaphieu()
{var tt=0 ;
  
 var cf = " Bạn có chắc chắn muốn khóa phiếu này hay không ? " ;
 if (dakhoa==true)
 {
	 sp = document.getElementById('idgoi').value  ;
	 poststr="DATA="+   encodeURIComponent(sp)+  "*@!"+ encodeURIComponent("nx")+  "*@!"+ encodeURIComponent(tt)+  "*@!"+ encodeURIComponent(document.getElementById('chonnhanqua').checked);
     loadtrang('ketqualuu',"phieudathangsxkhoaphieu", poststr,"xuly6") ;	 
	 dakhoa =false ;
 }else
 
 if(thongbao(cf) == true)
 {	 
   sp = document.getElementById('idgoi').value  ;
   poststr="DATA="+   encodeURIComponent(sp)+  "*@!"+ encodeURIComponent("nx")+  "*@!"+ encodeURIComponent(tt)+  "*@!"+ encodeURIComponent(0);
   loadtrang('ketqualuu',"phieudathangsxkhoaphieu", poststr,"xuly6") ;		
   dakhoa =false ;
  }
}


function timkiemncc(t1,t2,t3,t4,t5)
{ 
  poststr="DATA="+    encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(t3)+  "*@!"+ encodeURIComponent(t4);
  poststr= poststr +  "*@!"+ encodeURIComponent(t5)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0);
  loadtrang('hienthinhacc', "xuattimkh", poststr,"") ;
  
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
{  // alert(ketqua)
	if  (ketqua=="***1***")
	{
		alert(' Bạn đã hủy phiếu thành công !');
 		document.getElementById('themmoi').click();		
 	} else 
	{
		alert(' Bạn không thể hủy phiếu này !');
	}
	
	
 
}
function  goihuyphieu(t1,t2)
{
 var cf = " Bạn có chắc chắn muốn hủy phiếu này hay không ? " ;
 var n = confirm(cf);
 if(n == true)
	{ 
      poststr="DATA="+    encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0); 
      loadtrang('ketqualuu',"phieudathangsxhuyphieu", poststr,"xuly7") ;
	}
	
 }


 

function xuattimsanpham(t1,t2,t3,t4,t5,t6){
	
  poststr ="DATA="+encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(t3)+  "*@!"+ encodeURIComponent(t4);
  poststr = poststr +  "*@!"+ encodeURIComponent(t5)+  "*@!"+ encodeURIComponent(t6);
  loadtrang('sanpham', "phieudathangsxtimsp", poststr,"") ;
  
 } 
 
function setkh(t1,t2,t3,t4,t5,t6)
{
	//	document.getElementById('tenkh').innerHTML = t2
	//	document.getElementById('dckh').innerHTML = t3
//		document.getElementById('nhacc').value = t1
		km=t6;
		document.getElementById('tt').innerHTML = t4 + " CK: " + t6 + "%"
		if (t5!='')
		{
			document.getElementById('nhanqua').style.display = '' ;
			t6=t4.lastIndexOf('-');
			document.getElementById('diem').value =t4.substring(t6+1) ;
		}
		else
		{
		//	document.getElementById('nhanqua').style.display = 'none' ;
		 	document.getElementById('diem').value = 0 ;
		}
		
		document.getElementById('hienthongbao').style.display = "none";
		
	    goidong()
}

function timkiemkh(t1,t2,t3,t4,t5,t6,t7,t8)
{ 	
	
    poststr="DATA="+    encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(t3)+  "*@!"+ encodeURIComponent(t4);
    poststr= poststr +  "*@!"+ encodeURIComponent(t5)+  "*@!"+ encodeURIComponent(t6)+  "*@!"+ encodeURIComponent(t7)+  "*@!"+ encodeURIComponent(t8);
    loadtrang('hienthikh', "xuatkhokhachhangtim", poststr,"") ;
	//alert('Luu xong !!!');
} 


function timsanpham(t1,t2,t3,t4,t5,t6,t7){
	
  poststr="DATA="+encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(t3)+  "*@!"+ encodeURIComponent(t4);
  poststr= poststr +  "*@!"+ encodeURIComponent(t5)+  "*@!"+ encodeURIComponent(t6)+  "*@!"+ encodeURIComponent(t7);
  loadtrang('sanpham', "phieudathangsxtimsp", poststr,"") ;
  
 } 
 

//=======================================================
function xuatsetkhachhang(id)
 {
  poststr="DATA="+    encodeURIComponent(id)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0); 
  loadtrang('tenkhachhang', "xuattimkhachhang", poststr,"") ;
 }
function setkhachhang(id)
 {
  poststr="DATA="+    encodeURIComponent(id)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0); 
  loadtrang('tenkhachhang', "timkhachhang", poststr,"") ;
 }
 

function setnhacungcap(loai,id,diachi)
 {
	 
	document.getElementById('khachhang').value= id;
	 
 	document.getElementById('timkhachhang').style.display = "none";
	document.getElementById('codechinh').style.display = "";
	document.getElementById('note').focus() ;

 }
var idxe= '' ;

 

 
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
    if(document.getElementById('makm').value!='' && document.getElementById('nhacc').value==1) {alert('Bạn phải chọn khách hàng khi dùng mã khuyến mãi !');timkhachhang(); return false ;}
 	if(document.getElementById('datthang').value==0)
	{
		alert('Xin vui lòng chọn ly lo!');
		document.getElementById('datthang').focus();
		return false;
	}
	if(document.getElementById('nhacc').value==0)
	{
		alert('Xin vui lòng chọn khách hàng!');
		document.getElementById('khachhang').focus();
		return false;
	}
  	if(mangsp.length==0)
	{
		alert('Xin vui lòng chọn sản phẩm đã bán!');
		document.getElementById('codeprotk').focus();
		return false;
	} 	
	return true;
}


function timkhachhang()
{
	if (document.getElementById('hienthongbao').style.display =="")
	{
	document.getElementById('hienthongbao').style.display = "none";
		document.getElementById('timkhachhanght').style.display = '' ;	
	document.getElementById('timphieuxuat').style.display = 'none' ;
	
	 
	}else
	{
	document.getElementById('hienthongbao').style.display = "";
	 	document.getElementById('timkhachhanght').style.display = '' ;	
	document.getElementById('timphieuxuat').style.display = 'none' ;
	document.getElementById('ma').focus() ; 
	}
	
	
}

function timkiemnhacc()
{
	if (document.getElementById('timkhachhang').style.display =="")
	{
	document.getElementById('timkhachhang').style.display = "none";
	document.getElementById('codechinh').style.display = "";
	}else
	{
	document.getElementById('timkhachhang').style.display = "";
	document.getElementById('codechinh').style.display = "none";	}
 	
}
 
//=======================================================

//===============================================
 
 
 
function timdsphieuxuat(t0,t1,t2,t3,t4,t5,t6)
{
  poststr="DATA="+encodeURIComponent(t0)+"*@!"+encodeURIComponent(t1)+"*@!"+ encodeURIComponent(t2)+"*@!"+ encodeURIComponent(t3)+"*@!"+ encodeURIComponent(t4);
  poststr= poststr +  "*@!"+ encodeURIComponent(t5)+  "*@!"+ encodeURIComponent(t6)+  "*@!"+ encodeURIComponent(0);
  
  loadtrang('httimxuat', "phieudathangsxtim", poststr,"") ;	
  
	
}

 

function xuly4()
{
	 //alert( ketqua)
   var ma = ketqua.split('&$&');
   var m = ma[0].split('@$@');
  // alert( m[29])
  //0     1   2       3       4     5    6    7         8      9    10    11   12    13       14     15      16   17   18     19     20      21   22      23   24
 //ID,IDKho,IDNhaCC,IDNhap,NgayNh,SoCT,datthang,SoNgayNo,IDTKNo,IDTKCo,datthang,VAT,GhiChu,NgayTao,IDTao,NguoiGiao,Loai,ten,diachi,tenkho,tenlydo,tenN,diachiN,dakhoa,soxe

 
   document.getElementById('sochungtu').value = m[5];  
   document.getElementById('kho').value = m[8];
    //document.getElementById('bot').value = m[10];
   document.getElementById('datthang').value = m[10];
  
   document.getElementById('nhacc').value = m[2];
     document.getElementById('nhanviendat').value = m[22];
    //  document.getElementById('dckh').innerHTML = m[18];
    // document.getElementById('tenkh').innerHTML = m[17];
    document.getElementById('idgoi').value = m[0] ;
    document.getElementById('note').value = m[12]; 
	
    document.getElementById('ngaygiaohang').value = m[7]; 
	document.getElementById('ngaynhap').value = m[30]; 
	document.getElementById('textarea').value = m[19]; 
	document.getElementById('ghichu').value = m[18]; 
	  var hinh='';
		mangtam=[];
	 if(m[21]){
		 h=m[21].split("###");
		 for(var i=0;i<h.length;i++){
			 	if(h[i]){
						mangtam[h[i]]='';
				}
		 }
	 }
	  
	  showhinhUpdate(mangtam);
	  console.log(m);
	 $('.js-nhacc').select2(); 
	 
  // document.getElementById('VAT').value = m[11]; 
    var msp =  ma[1].split('@$&');
   var mang = new Array() ;
   var mgt =  new Array() ;
   	mangsp = mang ;
	for (x in msp)
	{ // alert(msp[x]);
	    mgt = msp[x].split('@$@') ;
		mangsp[mgt[2]] = new Array(mgt[3],mgt[7],(mgt[4]),mgt[5],mgt[12],mgt[6],mgt[10],mgt[13]);	
	//	mangsp[mgt[2]] = new Array(mgt[3],mgt[7],Math.abs(mgt[4]),mgt[5],mgt[12],mgt[6],mgt[10]);	
		
		//                   Array(code  ,ten   ,soluong,        dongia , chietkhau ,loaitien,ghichu);	  
	}
	xuatsp() ;
	timphieu() ;
 }
 
function setlaiphieuxuat(t1,t2)
{
	  poststr="DATA="+ "0*@!" +  encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0);
	  loadtrang('khonghienthi', "phieudathangsxgoi", poststr,"xuly4") ;		
	
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
	 	document.getElementById('huyphieu').disabled= false; 	
		}	
	 document.getElementById('inan').disabled= ""; 
}

function themnhacc(t1,t2,t3,t4)
{
 	var st ;
	st = "default.php?act=nhacungcap&id=-1&t1=" + t1 + '&t2=' + t2 + '&t3=' +t3 + '&t4=' +t4  ;
	window.open(st,'popup','toolbar=no,status=no,scrollbars=yes,location=no,menubar=no,directories=no,width=1000,height=700,titlebar=no') ;

}

function themkhachhang(t1,t2,t3,t4,t5)
{
 	var st ;
	st = "default.php?act=customer&id=-1&t1=" + t1 + '&t2=' + t2 + '&t3=' +t3 + '&t4=' +t4  + '&t5=' + t5 ;
	window.open(st,'popup','toolbar=no,status=no,scrollbars=yes,location=no,menubar=no,directories=no,width=1000,height=700,titlebar=no') ;
}

  function xemthe(id,xuatxuat,kho,tu,den)
   {
 	var st ;
	st = "thekhoxem.php?t1=" +id + "&t2=" + xuatxuat + '&t3=' + kho + '&t4=' +tu + '&t5=' +den  ;
	window.open(st,'popup','toolbar=no,status=no,scrollbars=yes,location=no,menubar=no,directories=no,width=1000,height=700,titlebar=no') ;
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
 

function taomoi()
{
	document.forms['frmxuat'].reset() ; 
	document.getElementById('sanphamxuat').innerHTML = document.getElementById('luubd').innerHTML ; 
	document.getElementById('luu').disabled= '';	
	document.getElementById('khoa').disabled= true ;	
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
 	document.getElementById('chietkhau').value= chietkhau; 
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

//for (x in mangsp)
//	{
//		t =tam.length-1 ;
//		alert(t)
//		tam2 = tam.pop() ;
//		t =tam.length-1 ;
//		alert(t)
		
		//alert(tam2[0]+'---'+tam2[1]+'---'+tam2[2]);
//	}
	//mangsp = tam ;
 }
 
 
function goidongthe()
{
    document.getElementById("hiethithongbao").style.display = 'none' ;
}

function capxuatgia(idsp,dongia)
{
  poststr="DATA="+encodeURIComponent(idsp)+"*@!"+encodeURIComponent(dongia)+"*@!"+ encodeURIComponent(0)+"*@!"+ encodeURIComponent(0)+"*@!"+ encodeURIComponent(0);
   loadtrang('ketqualuu', "capxuatgia", poststr,"") ;			
}
 
function addpro(idsp,ten,code,dongia,loaitien,soluong,chietkhau,ghichu,giachan,mt){ 
 
if(chietkhau>0  && (code[code.length-1] =='Z'||code[code.length-1] =='z')) { alert('Mã Z này khuyến cáo không được chiết khấu !!!');}
	if 	(idsp == '')
	{
      alert('Bạn Chưa chọn hàng hóa!!!');document.getElementById('NameTK').focus(); return;	
	}
	var dg =dongia ;
	dg =dg.replace(',','');
	dg =dg.replace(',','');
	 
	// if (chietkhau<km) chietkhau =km ;
	 
	if (laso(giachan)>  ( parseFloat(dg) -   parseFloat(dg) * chietkhau/100 )  )
	{	
  	//  alert('Giảm giá không được vượt '+ txtFormatj(giachan)+' !!!');document.getElementById('chietkhau').focus(); return false;	
	}
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
	
	if 	(  laso(soluong) < 0)
	{
      alert('Bạn không được nhập số Âm !!!');document.getElementById('soluong').focus(); return;	
	}
	//alert(document.getElementById('sl').value > soluong);
	var sl = laso(document.getElementById('sl').value) ;
	//alert(sl < soluong) ;
//	if(document.getElementById('tenform').innerHTML== "xuatkho" && parseFloat(sl) < parseFloat(soluong) )
//	{
//		alert('Trong kho chỉ còn "' + sl + '" sản phẩm, vui lòng nhập thêm vào kho hoặc xuất ít hơn ' + sl +  ' !!!');
//		document.getElementById('soluong').focus() ;
//		document.getElementById('soluong').select() ;
//		return ;
//	}
       mangsp[idsp] = new Array(code,ten,soluong,dongia,chietkhau,loaitien,ghichu,mt);	   
	   document.getElementById('codeprotk').value='' ;
  	   xuatsp() ;
	   document.getElementById('nhac').play();
//	if(document.getElementById('tenform').innerHTML== "xuatkho" )	{ capxuatgia(idsp,dongia) ;}  
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
 	document.getElementById('chietkhau').value=''; 
	document.getElementById('loaitien').value='';  
  	document.getElementById('ghichu').value='';
	document.getElementById('mt').value='';  
 
 	 
 } 

function setthongtin(id)
{
	 
 	document.getElementById('idsp').value= id; 
	document.getElementById('masp').value= mangsp[id][0]; 
	document.getElementById('tensp').value= mangsp[id][1];  	
	document.getElementById('soluong').value= mangsp[id][2]; 
	document.getElementById('dongia').value= mangsp[id][3]; 
 	document.getElementById('chietkhau').value= mangsp[id][4];
	document.getElementById('loaitien').value= mangsp[id][5]; 
  	document.getElementById('ghichu').value= mangsp[id][6]; 
	document.getElementById('mt').value= mangsp[id][7]; 
 	document.getElementById('dongia').focus(); 

}
 
function xuatsp()
{   
	var x,stt,str ="" ;	stt= 0 ;
	var thanhtien,tong  ;
	thanhtien = 0 ; tong = 0 ;
	   str = ' <table width="100%" border="0" cellpadding="0" cellspacing="0">' ;
	   str += '    <tr bgcolor="#F8E4CB" > ';
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
	tongsl = 0 ;
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
	thanhtien  = thanhtien - thanhtien *  mangsp[x][4]/100   ;
	thanhtien  =   Math.round(thanhtien,0) ; 
	tong = tong + thanhtien ;		
		tongsl = 1*tongsl + 1*mangsp[x][2] ;
    stt = stt + 1;
 	str +='<TR onMouseOver="this.className=\''+ hl2+'\'"   onMouseOut="this.className=\''+h1+'\'" bgcolor="'+mau+'" style="cursor:pointer" onclick="setthongtin(\''+ x + '\')">';
	str += ' <td class="cothienthi"  align="Right" height="23">'+ stt +'</td>';	
	str += ' <td class="cothienthi"  align=""  >&nbsp;' + mangsp[x][0] + ' ' +mangsp[x][7]+'</td>';
	str += ' <td class="cothienthi"  align=""  >&nbsp;' + mangsp[x][1] +'</td>';
	str += ' <td class="cothienthi"  align="right"  >&nbsp;' + mangsp[x][2] +'</td>';
	str += ' <td class="cothienthi"  align="right"  >&nbsp;' + txtFormatj(mangsp[x][3]) +'</td>';
 
	str += ' <td class="cothienthi"  align="right"  >&nbsp;' + txtFormatj(thanhtien) +'&nbsp;</td>';
	str += ' <td class="cothienthi"  align=""  >&nbsp;' + mangsp[x][6] +'</td>';
 	str += ' <td class="cothienthi"  align="center"  ><img onclick="xoapt(\''+ x + '\')" title=\"Xóa Mục\"  src="images/delete.gif" border="0"></td>';
 	str += ' </Tr>';		
		
	}
str += ' <Tr class="cothienthi"><td colspan="3" align="right" ><b>Tổng cộng &nbsp; </b></td><td align="right"  class="chulon" ><b>'+ txtFormatj(tongsl) +'&nbsp;</b></td><td></td><td></td><td  align="right"   class="chulon" ><b>'+ txtFormatj(tong) +'</b>&nbsp;</td><td></td>';		
	str += ' </Tr>';		
  str +='</table>';
	document.getElementById('sanphamxuat').innerHTML = str ;
    document.getElementById('tongtien').innerHTML =   txtFormatj(tong);
 	 
 
}
//===================================================================================== 
var tongtienhang    ;
function tinhtien(giatri)
{ 	 
    giatri =  giatri.replace(',','');
	giatri =  giatri.replace(',','');
	giatri =  giatri.replace(',','');
    tongtienhang = document.getElementById('tongtien').innerHTML  ;
	tongtienhang =  tongtienhang.replace(',','');
	tongtienhang =  tongtienhang.replace(',','');
	tongtienhang =  tongtienhang.replace(',','');
	tienbot = document.getElementById('bot').value  ;
	tienbot =  tienbot.replace(',','');	 tienbot =  tienbot.replace(',','');	tienbot =  tienbot.replace(',','');	
	tongtienhang = tongtienhang*1 -tienbot ;
	 
    document.getElementById('tralai').innerHTML =   txtFormatj(parseFloat(giatri)-parseFloat(tongtienhang) );	
    document.getElementById('tralai').innerHTML =  document.getElementById('tralai').innerHTML.replace('-,','-');
}
 
function xulyod()
{ 
   innoidung(ketqua)	;
   innoidung(ketqua)	;
}
function goiin()
{ 		
	var so = document.getElementById('sochungtu').value ;
	var st ;
//	st = "xuatkhoin.php?id=" + so  ;
	//window.open(st,'popup','toolbar=no,status=no,scrollbars=yes,location=no,menubar=no,directories=no,height=300px,titlebar=no') ;

  
   poststr= "DATA="+ encodeURIComponent(so)+"*@!"  + encodeURIComponent(0) ; 
   
   loadtrang('khonghienthi',"xuatkhoinmoi", poststr,"xulyod") ;		
  


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
 
function tinhgiamgia1(tongcong,giatri,loaitien)
{
}
function tinhgiamgia2(tongcong,giatri,loaitien)
{
		var tienchuagiam ;
 	    document.getElementById('thanhtien').innerHTML = parseFloat(tienchuagiam) - parseFloat(document.getElementById('giamphamtram').innerHTML) - parseFloat(tongcong) ; 		
}
 