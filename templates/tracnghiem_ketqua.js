 
var mangsp = new Array() ;
var mangsp1 = new Array() ;
var mangtam = new Array() ;

var x,khachduatien ;
 //=======================================================
function setlailuu(v)
{ 	
	
    document.getElementById('luu').disabled= "";
	document.getElementById('khoa').disabled= "";
	 
 } 
 
 function xuly5()
{
	
	 tam=document.getElementById('ketqualuu').innerHTML ;
	 var  n=tam.split("*loi#"); 
         if (n[1]!="" && n.length>1 ){
         	alert(n[1]); return; 
         }
	 
	document.getElementById('luu').disabled= false; 
	document.getElementById('khoa').disabled= false; 	
	document.getElementById('huyphieu').disabled= false; 	
	document.getElementById('phuchoi').disabled= true;
	document.getElementById('inan').disabled= ""; 	
	document.getElementById('timk').click() ; 
	document.getElementById('nhac').play();
	$('#error_phuchoi').stop().fadeIn(200).delay(2000).fadeOut(200); //fade out after 2 seconds
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
 
  poststr="DATA="+ encodeURIComponent(sp)+ "*@!"+ encodeURIComponent("nx")+ "*@!"+ encodeURIComponent(tt)+ "*@!"+ encodeURIComponent(n);
  loadtrang('ketqualuu',"sx_dathang_phuchoi", poststr,"xuly5") ;		
  
 }
	 
 } 
 
function xulychung()
{
 	 tam=document.getElementById('ketqualuu').innerHTML
	 var  n=tam.split("**#"); 
	 
     if (n[1]=="") {alert('cố lỗi xảy ra hoặc đường truyền bị gián đoạn cần đăng nhập lại !'); return; }
	 document.getElementById('idgoi').value= n[1] ;	 
	  if (n[2]!='')  document.getElementById('sochungtu').value =n[2];
	// document.getElementById('ketqualuu').innerHTML=""; 
	 var timet
	
	 document.getElementById('luu').value= "Cập Nhật ";
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
   ngaydathang = document.getElementById('ngaydathang').value ;
   ngaycamket = document.getElementById('ngaycamket').value ;
   ngaythucte = document.getElementById('ngaythucte').value ;
    //alert(1);
    //return;
   idgoi= document.getElementById('idgoi').value ; 
  
 	if(kiemtraphieu()==true)
 	{
 	//alert(3);
    //return;
		  document.getElementById('luu').disabled= true;
	 	 poststr= "DATA="+idgoi+"*@!"+ encodeURIComponent(mangthanhchuoi(mangsp))+"*@!"  + encodeURIComponent(sochungtu) ; 
		 poststr += "*@!"+ encodeURIComponent(idnhan)+  "*@!"+ encodeURIComponent(idxuat)+  "*@!"+ encodeURIComponent(lydo) ; 
		 poststr += "*@!"+ encodeURIComponent('')+  "*@!"+ encodeURIComponent(idxuat)+  "*@!"+ encodeURIComponent(ghichu) ; 
		 poststr += "*@!"+ encodeURIComponent(vat)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(tenkhachhang) ; 
		 poststr += "*@!"+ encodeURIComponent('diachi')+  "*@!"+ encodeURIComponent(0) +  "*@!"+ encodeURIComponent(khachdua)  ; 
		 poststr += "*@!"+ encodeURIComponent(ngaydathang)+ "*@!"+ encodeURIComponent(ngaycamket)+ "*@!"+ encodeURIComponent(ngaythucte) ;
   		 loadtrang('ketqualuu', "sx_dathang_luutong", poststr,"xuly") ;
   		 if(idgoi==""){
   		 	$('#error_luu').stop().fadeIn(200).delay(2000).fadeOut(200); //fade out after 2 seconds
   		 }
   		 else{
   		 	$('#error_capnhat').stop().fadeIn(200).delay(2000).fadeOut(200); //fade out after 2 seconds
   		 }
   		 
   		 document.getElementById('inan').disabled= "";
   		 
 	}

	return false;
}


function kiemtraphieu()
{  
	//return true;
	//alert('2');
	if(document.getElementById('khonhan').value==0)
	{
		$('#error_khonhan').stop().fadeIn(200).delay(2000).fadeOut(200); //fade out after 2 seconds
		document.getElementById('nhacbaoloi').play();
		//alert('Xin vui lòng chọn: Nơi nhận!');
		document.getElementById('khonhan').focus();
		return false;
	}
	if(document.getElementById('ngaydathang').value==0)
	{
		$('#error_ngaydathang').stop().fadeIn(200).delay(2000).fadeOut(200); //fade out after 2 seconds
		document.getElementById('nhacbaoloi').play();
		//alert('Xin vui lòng chọn: Ngày Xuất bán!');
		document.getElementById('ngaydathang').focus();
		return false;
	}
	if(document.getElementById('ngaycamket').value==0)
	{
		$('#error_ngaycamket').stop().fadeIn(200).delay(2000).fadeOut(200); //fade out after 2 seconds
		document.getElementById('nhacbaoloi').play();
		//alert('Xin vui lòng chọn: Ngày Xuất bán!');
		document.getElementById('ngaycamket').focus();
		return false;
	}
  	if(mangsp.length==0)
	{
		document.getElementById('nhacbaoloi').play();
		$('#error_hanghoacanxuat').stop().fadeIn(400).delay(2000).fadeOut(400); //fade out after 3 seconds
		//alert('Xin vui lòng chọn: Hàng hóa cần xuất!');
		document.getElementById('codeprotk').focus();
		return false;
	} 
 //  	if(document.getElementById('khochuyen').value==document.getElementById('khonhan').value)
	// {
	// 	alert('Nơi chuyển và Nơi nhận Không được trùng nhau !');
	// 	document.getElementById('khonhan').focus();
	// 	return false;
	// } 	
 //    if(document.getElementById('lydo').value==0)
	// {
	// 	alert('Xin vui lòng chọn: Lý do!');
	// 	document.getElementById('lydo').focus();
	// 	return false;
	// }
	document.getElementById('nhac').play();
	return true;
}
//=======================================================
  

 
function setsanpham(id,ten,ma,gia,dvt,giagia,baohanh,sl,DV) // baohanh => giachan
{ 
   if (sl>0)
   {
  	document.getElementById('idsp').value= id; 
	document.getElementById('tensp').value= ten; 
	document.getElementById('masp').value= ma; 
	document.getElementById('dongia').value = gia;
  	document.getElementById('giachan').value = baohanh ;
 	document.getElementById('sl').value = sl; 
 	document.getElementById('DV').value = DV;	
	document.getElementById('soluong').value = 1;
	// document.getElementById('sanpham').innerHTML = "" ; 
	document.getElementById('soluong').select() ; 
	//document.getElementById('codeprotk').select() ; 
	// document.getElementById('cl').style.display = '' ; 
	//document.getElementById('spdachon').style.background = 'rgba(255, 249, 0, 0.52)'; 
	document.getElementById('spdachon').style.color = '#0000FF'; 
	document.getElementById('spdachon_img').style.display = '';
	document.getElementById('thongbaodieuchinh').style.display = '';
	
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
	// document.getElementById('sanpham').innerHTML = "" ; 
	document.getElementById('soluong').select() ; 
	document.getElementById('codeprotk').select() ;
	// document.getElementById('cl').style.display = '' ; 
	//document.getElementById('spdachon').style.background = 'rgba(255, 249, 0, 0.52)' ; 
	document.getElementById('spdachon').style.color = '#0000FF';
	document.getElementById('spdachon_img').style.display = '';
	document.getElementById('thongbaodieuchinh').style.display = '';
}  
 
function timtheomacode(v)
{ 	
	 
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
 //  alert(tam)
  var  n=tam.split("##"); 
 
  if(n[8] <=0) { alert("Không thể xuất khi số lượng nhỏ hoặc bằng 0."); return ;}
  
  if (n[1]=="") return;
  //  document.getElementById("sound_element").innerHTML= "<embed src='images/ding.wav' hidden=true autostart=true loop=false>";
	document.getElementById('nhac').play();
   n[8] = 1+ parseFloat(layvesoluong(n[3])) ;
 
 
   thaydoisoluong( n[3],n[8]) ;
    
   //alert(n[6])
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
	document.getElementById('nhac').play();
	$('#error_khoaphieu').stop().fadeIn(400).delay(2000).fadeOut(400); //fade out after 3 seconds
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

function khoaphieu(){
	document.getElementById('nhacbaoloi').play();
	var tt=0 ;
 	var cf = " Bạn có chắc chắn muốn khóa phiếu này hay không ? " ;
 	if(thongbao(cf) == true)
 	{	 
		sp = document.getElementById('idgoi').value  ;
		poststr="DATA="+   encodeURIComponent(sp)+  "*@!"+ encodeURIComponent("nx")+  "*@!"+ encodeURIComponent(tt)+  "*@!"+ encodeURIComponent(0);
		loadtrang('ketqualuu',"sx_dathang_khoaphieu", poststr,"xuly6") ;		
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
	// document.getElementById('themmoi').click();
	var count = 3;
	// var redirect = "https://google.com";
	document.getElementById('nhac').play();
	$('#error_huyphieu').stop().fadeIn(200).delay(2000).fadeOut(200); //fade out after 2 seconds
	setTimeout(function(){ window.open('default.php?act=sx_dathang','_self'); }, 2400);
}
 
function  goihuyphieu(t1,t2)
{
	document.getElementById('nhacbaoloi').play();
	var cf = " Bạn có chắc chắn muốn Hủy phiếu này hay không ? " ;
	var n = confirm(cf);
 	if(n == true)
	{
		document.getElementById('luu').disabled= true; 
		document.getElementById('khoa').disabled= true;
		document.getElementById('inan').disabled= true;
		document.getElementById('huyphieu').disabled= true; 
    	poststr="DATA="+    encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0); 
    	loadtrang('ketqualuu',"sx_dathang_huyphieu", poststr,"xuly7") ;
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

 

function timsanpham(t1,t2,t3,t4,t5,t6){
	document.getElementById('spdachon').style.background = '' ; 
	document.getElementById('spdachon').style.color = '';
	document.getElementById('spdachon_img').style.display = 'none';
	document.getElementById('thongbaodieuchinh').style.display = 'none';
	document.getElementById('thongbaodieuchinhlai').style.display = 'none';
	poststr="DATA="+encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(t3)+  "*@!"+ encodeURIComponent(t4);
	poststr= poststr +  "*@!"+ encodeURIComponent(t5)+  "*@!"+ encodeURIComponent(t6)+  "*@!"+ encodeURIComponent(0);
	loadtrang('sanpham', "sx_dathang_timsp", poststr,"xuly10") ;
  
 } 
  

 function xuly10()
{
	document.getElementById('cl').style.display = '' ;  
}
  
//=======================================================
 
function clearchon() 
 {
 
	document.getElementById('NameTK').value= '' ;		
	document.getElementById('codeprotk').value= '' ;		
	document.getElementById('code').value= '' ;		
	document.getElementById('IDGrouptk').value = '0' ;		
 	document.getElementById('sanpham').innerHTML = document.getElementById('luutimsp').innerHTML ;
 	document.getElementById('cl').style.display = 'none' ; 
 }


function timdstraloi(t0)
{
  poststr="DATA="+encodeURIComponent(t0)+"*@!"+encodeURIComponent(0);
  loadtrang('httimxuat', "tracnghiem_ketqua_timtong", poststr,"");
}   
function timdsphieuxuat(t0,t1,t2,t3,t4,t5,t6,t7,t8)
{
  poststr="DATA="+encodeURIComponent(t0)+"*@!"+encodeURIComponent(t1)+"*@!"+ encodeURIComponent(t2)+"*@!"+ encodeURIComponent(t3)+"*@!"+ encodeURIComponent(t4);
  poststr= poststr +  "*@!"+ encodeURIComponent(t5)+  "*@!"+ encodeURIComponent(t6)+  "*@!"+ encodeURIComponent(t7)+  "*@!"+ encodeURIComponent(t8);
  loadtrang('httimxuat', "tracnghiem_ketqua_timtong", poststr,"");
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
	 document.getElementById('ngaynhap').value = m[32]; 
	 document.getElementById('ngaydathang').value = m[35];
	 document.getElementById('ngaycamket').value = m[36];
	 document.getElementById('ngaythucte').value = m[37];
	document.getElementById('luu').value = "Cập nhật ";

  // document.getElementById('VAT').value = m[11]; 
    var msp =  ma[1].split('@$&');
   var mang = new Array() ;
   var mgt =  new Array() ;
   	mangsp = mang ;
	for (x in msp)
	{ // alert(msp[x]);
	    mgt = msp[x].split('@$@') ;
		mangsp[mgt[2]] = new Array(mgt[3],mgt[7],(mgt[4]),mgt[5],mgt[12],mgt[6],mgt[10], mgt[13]);	
		//                   Array(code  ,ten   ,soluong,        dongia , chietkhau ,loaitien,ghichu);	  
	}
	xuatsp() ;
	timphieu() ;
 }
 
function setlaiphieuxuat(t1,t2)
{
	document.getElementById('nhac').play();
	poststr="DATA="+ "0*@!" +  encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0);
	loadtrang('khonghienthi', "sx_dathang_goitong", poststr,"xuly4") ;		
	
 	poststr="DATA="+ "0*@!" +  encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0);
	 
 //	  loadtrang('httimlai', "xuatkhoht", poststr,"") ;		
 	if (t2 == "0")
		{	
			document.getElementById('luu').disabled= false;	
			document.getElementById('khoa').disabled= false;	
			document.getElementById('copy').disabled= false;
			document.getElementById('huyphieu').disabled= false; 
			document.getElementById('phuchoi').disabled= true; 	
		}
		else
		{	
			document.getElementById('luu').disabled= true; 
			document.getElementById('khoa').disabled= true; 
			document.getElementById('copy').disabled= false; 
			document.getElementById('huyphieu').disabled= true; 
			document.getElementById('phuchoi').disabled= false; 	
		}	
	document.getElementById('inan').disabled= ""; 
}
 

function timphieu()
{
 
	
    if (document.getElementById('hienthongbao').style.display =="")
	{
		document.getElementById('nenmo').style.display = "none";
		document.getElementById('hienthongbao').style.display = "none";
		document.getElementById('timkhachhanght').style.display = '' ;	
		document.getElementById('timphieuxuat').style.display = 'none' ;	
 	}else
	{
		timdsphieuxuat();
		document.getElementById('nenmo').style.display = "";
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
 
 
 
function addpro(idsp,ten,code,dongia,loaitien,soluong,chietkhau,ghichu,giachan,DV){ 
	document.getElementById('spdachon').style.background = '' ; 
	document.getElementById('spdachon').style.color = '';
	document.getElementById('spdachon_img').style.display = 'none';
	document.getElementById('thongbaodieuchinh').style.display = 'none';
	document.getElementById('thongbaodieuchinhlai').style.display = 'none';
	// document.getElementById('sanpham').innerHTML = "" ;
	document.getElementById('codeprotk').focus();
	//////////////////////////////////////////
	// document.getElementById('idsp').value= ''; 
	// document.getElementById('tensp').value= ''; 
	// document.getElementById('masp').value= ''; 
	// document.getElementById('dongia').value = '';
  	//document.getElementById('giachan').value = baohanh ;
 	// document.getElementById('sl').value = ''; 
 	// document.getElementById('DV').value = '';	
	// document.getElementById('soluong').value = '';
	// document.getElementById('sanpham').innerHTML = "" ; 
	//document.getElementById('soluong').select() ; 
	//document.getElementById('codeprotk').select() ; 
	// document.getElementById('cl').style.display = 'none' ; 

	if 	(idsp == '')
	{
		document.getElementById('nhacbaoloi').play();
		$('#error_idsp').stop().fadeIn(200).delay(2000).fadeOut(200); //fade out after 2 seconds
      	// alert('Bạn chưa chọn Hàng hóa!!!');
      	document.getElementById('codeprotk').focus(); 
      	return;	
	}
	var dg =dongia ;
	dg =dg.replace(',','');
	dg =dg.replace(',','');
 	if 	(trim(soluong) == '' || laso(soluong) == 0)
	{
		document.getElementById('nhacbaoloi').play();
      	$('#error_soluong').stop().fadeIn(200).delay(2000).fadeOut(200); //fade out after 2 seconds
      	// alert('Bạn chưa nhập Số lượng!!!');
      	document.getElementById('soluong').focus(); 
      	return;	
	}
	if (laso(dongia) == 0)
	{
		document.getElementById('nhacbaoloi').play();
		// $('#error_dongia').stop().fadeIn(200).delay(2000).fadeOut(200); //fade out after 2 seconds
		var cf = "Bạn chưa nhập Đơn giá!!!\nBạn có muốn Nhập hay không ?" ;
		var n = confirm(cf);
		if(n == true)
 		{
 			document.getElementById('nhacbaoloi').play();
 			$('#error_dongia').stop().fadeIn(200).delay(2000).fadeOut(200); //fade out after 2 seconds
			document.getElementById('dongia').focus() ; 
			return false;	
	    }	
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
       mangsp[idsp] = new Array(code,ten,soluong,dongia,chietkhau,loaitien,ghichu,DV);	   
	   document.getElementById('codeprotk').value='' ;
  	   xuatsp() ; // xử lý dữ liệu
	   document.getElementById('nhac').play();
	if(document.getElementById('tenform').innerHTML== "xuatkho" )	{ capxuatgia(idsp,dongia) ;}  
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
 } 

function setthongtin(id)
{
	 
 	document.getElementById('idsp').value= id; 
	document.getElementById('masp').value= mangsp[id][0]; 
	document.getElementById('tensp').value= mangsp[id][1];  	
	document.getElementById('soluong').value= mangsp[id][2]; 
	document.getElementById('dongia').value= mangsp[id][3]; 
 	//document.getElementById('chietkhau').value= mangsp[id][4];
 	document.getElementById('DV').value = mangsp[id][7];
	document.getElementById('loaitien').value= mangsp[id][5]; 
  	document.getElementById('ghichu').value= mangsp[id][6]; 
 	document.getElementById('soluong').focus(); 
 	//document.getElementById('thongbaodieuchinh').style.display = '';
 	document.getElementById('thongbaodieuchinhlai').style.display = '';
 	//document.getElementById('spdachon').style.background = 'rgba(255, 249, 0, 0.52)'; 
	document.getElementById('spdachon').style.color = '#0000FF'; 

}
 
function xuatsp()
{   
	var x,stt,str ="" ;	stt= 0 ;
	var thanhtien,tong ,tongsl ;
	thanhtien = 0 ; tong = 0 ;tongsl = 0 ;
	   str = ' <table width="100%" border="0" cellpadding="0" cellspacing="0">' ;
	   str += ' <tr style="background: rgba(207, 227, 244, 0.88);">';
	   str += ' <td width="5%"  align="center" class="cothienthi" height="23"><b>STT</b></td> ';
	   str += ' <td width="10%" align="center" class="cothienthi"><strong>Mã Hàng Hóa </strong></td> ';
	   str += ' <td width="25%" align="center" class="cothienthi"><strong>Tên Hàng Hóa</strong></td> ';
	   str += ' <td width="5%"  align="center" class="cothienthi"><strong>SL</strong></td> ';
	   str += ' <td width="5%"  align="center" class="cothienthi"><strong>Đvt</strong></td> ';
	   str += ' <td width="15%" align="center" class="cothienthi"><strong>Đơn Giá </strong></td> ';
	   str += ' <td width="15%" align="center" class="cothienthi"><strong>Thành Tiền </strong></td> ';
	   str += ' <td width="20%" align="center" class="cothienthi"><strong>Ghi Chú </strong></td> ';
 	   str += ' <td width="5%"  align="center" class="cothienthi"><strong>X&#243;a</strong></td> ';
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
 	str +='<tr onMouseOver="this.className=\''+ hl2+'\'" onMouseOut="this.className=\''+h1+'\'" bgcolor="'+mau+'" style="cursor:pointer" onclick="setthongtin(\''+ x + '\')">';
	str += ' <td class="cothienthi"  align="center" height="23">'+ stt +'</td>';	
	str += ' <td class="cothienthi"  align=""  >&nbsp;' + mangsp[x][0] +'</td>';
	str += ' <td class="cothienthi"  align=""  >&nbsp;<b>' + mangsp[x][1] +'</b></td>';
	str += ' <td class="cothienthi"  align="center"  >&nbsp;' + mangsp[x][2] +'</td>';
	str += ' <td class="cothienthi"  align="center"  >&nbsp;' + mangsp[x][7] +'</td>';
	str += ' <td class="cothienthi"  align="right"  >&nbsp;' + txtFormatj(mangsp[x][3]) +'</td>';
	str += ' <td class="cothienthi"  align="right"  >&nbsp;' + txtFormatj(thanhtien) +'&nbsp;</td>';
	str += ' <td class="cothienthi"  align=""  >&nbsp;' + mangsp[x][6] +'</td>';
 	str += ' <td class="cothienthi"  align="center"  ><img onclick="xoapt(\''+ x + '\')" title=\"Xóa Mục\"  src="images/delete.gif" border="0"></td>';
 	str += ' </tr>';		
		
	}
	str += '<tr class="cothienthi">'
	str += ' <td  class="cothienthi" colspan="3" align="center" ><b>Tổng cộng</b></td>';
	str += '<td  class="cothienthi" align="center" ><b>'+ tongsl + '</b> </td>';
	str += '<td  class="cothienthi" colspan="2" align="right"><b>'+ txtFormatj(tong) +'</b>&nbsp;</td>';
	str += '<td  class="cothienthi" colspan="2"></td>';		
	str += ' </tr>';		
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
	st = "sx_dathang_in.php?id=" + so  ;
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
 
 
 