  <style >
  .tieudesp { color:#F90 ; font-weight:bold;}
 </style>

<div class="nenbao">
<div style="padding:1px">
<fieldset  class="nencon">
	<legend> <a style="cursor:pointer"  >
	<label style="Color:#FF3300;Font-Weight:Bold;Font-size:15pt;" >Giảm giá riêng từng cửa hàng</label>
	</a></legend>
  <form name="frmnhap" action="" method="get" id="frmnhap" >
 
 
 
 
 
  <fieldset style="padding-top:5px">
	<legend> <a style="cursor:pointer" onClick="anhienform('chon')">
		<label style="Color:#5BB6E6;Font-Weight:Bold;Font-size:14pt">Chọn Hàng Hóa giảm giá riêng</label>
	</a></legend>
<div id="chon" style="float:left">
<div  style="float:left;"> 
  Mã <input onkeypress="return chuyentieps(event,'IDGrouptk')" type="text" name="codeprotk" onkeyup="goisp(this.value)"  id="codeprotk" class="text" style="width:90px" value=""   ondblclick="this.value=''"/> 
Tên hàng  
    <input onkeypress="return chuyentiep(event,'codeprotk')" type="text" name="NameTK"  id="NameTK" class="text" size="11" value="" ondblclick="this.value=''"/>
&nbsp;
<input onkeypress="return chuyentieps(event,'IDGrouptk')" type="hidden" name="code"  id="code" class="text" size="10" value="" />
 &nbsp; Nhóm hàng
 <select onkeypress="return chuyentiep(event,'search')" name="IDGrouptk"  id="IDGrouptk" style="width:120px" >
  <option value="0" ></option>
 	{cay}
 </select>
&nbsp;&nbsp;
<input type="button" onclick="xuattimsanpham(NameTK.value,codeprotk.value,code.value,IDGrouptk.value,'0',idchuyen.value )" name="search" style="width:65px"  id="search" value="Tìm kiếm" />
 	   <input type="hidden" name="soluongcon"  value="" />
	   
	   <input type="button" name="cl" style="width:40px" onclick="clearchon()" value="clear" /> &nbsp;  Ngày tạo  <input type="text" name="ngaynhap" id="ngaynhap"  disabled="disabled" onkeyup="return chuyentiep(event,'sochungtu')"  style="width:68px" value="{ngaynhap}" onchange="setngay(this.value)" /> <img src="images/img.gif" id="Lichtungaytao" style="cursor: pointer; border: 0px solid red;" title="Date selector"  onclick="displayCalendar(frmnhap.ngaynhap,'dd/mm/yyyy',this)"> &nbsp; 
	    <input name="idgoi" id="idgoi" type="hidden"  value="" /> <img src="images/18_testimonial.gif" /> <strong>{ten}</strong>			 
	 
	   </div> <div style="height:16px"  id="cho" >  
	     </div>
	   <div style="clear:left;display:none" id="khonghienthi"></div>
	   <div id="sanpham" style="padding-top:4px">
 	<table width="100%" border="0" cellpadding="0" cellspacing="0">		
 		<tr bgcolor="#F8E4CB">
		  <td align="center" class="cothienthi" height="23" width="50"><b>STT</b></td>
		  <td width="348" align="center" class="cothienthi" ><strong>Tên Vật Tư </strong></td>  
		  <td width="388" align="center" class="cothienthi"><strong><strong>Tên Tiếng Anh </strong></strong> </td> 	   
		  <td width="101" align="center" class="cothienthi"><strong>Mã VT </strong> </td> 
		  <td width="123" align="center" class="cothienthi"><strong>Mã Chuẩn </strong></td>
		  <td width="56" align="center" class="cothienthi"><strong><strong>Giá </strong> </strong></td>
		  <td width="36" align="center" class="cothienthi"><strong><strong>Giảm</strong> </strong></td>	    	      
		  <td width="48" align="center"  class="cothienthi"> <strong>SL </strong></td>	 
		  <td width="56" align="center"  class="cothienthi"> <strong>Thẻ</strong></td>	 
	 </tr>

 		<tr bgcolor="#FFFFFF" >
			<td class="cothienthi">&nbsp;</td><td class="cothienthi">&nbsp;</td><td class="cothienthi">&nbsp;</td><td class="cothienthi">&nbsp;</td>
			<td class="cothienthi">&nbsp;</td><td class="cothienthi">&nbsp;</td><td class="cothienthi">&nbsp;</td><td class="cothienthi">&nbsp;</td>
			<td class="cothienthi">&nbsp;</td>		
		 </tr>		
	</table>
	  </div>
</div>
</fieldset>



 
 
   <div style="padding-top:5px" >
 
   <fieldset style="display:">
	<legend> 
	<label style="Color:#5BB6E6;Font-Weight:Bold;Font-size:12pt">Hàng Hóa đã chọn</label>
	 </legend>	

  <div  style="color:#FF6600;padding:10px">User thực hiện : <strong>{ten}</strong> &nbsp;
   <select  name="idchuyen"  id="idchuyen"  style="width:180px" onchange="goilai(this.value)">
   <option value="0" >Vui lòng chọn Cửa hàng cần giảm giá riêng</option>
   		{cuahangchuyen}
   </select>
   <span style="padding-top:4px">
   <span style="padding-bottom:5px">Ngày
<input onkeypress="return chuyentiep(event,'denngay')" title="Click đôi để xoá trắng"  ondblclick="xoatrang(this)" type="text" name="tungay"   id="tungay" class="text" style="width:65px"  value="{tungay}" />
<img src="images/img.gif" id="Lichtungaytao2" style="cursor: pointer; border: 0px solid red;" title="Date selector"  onclick="displayCalendar(frmnhap.tungay,'dd/mm/yyyy',this)" />&nbsp;đến
<input onkeypress="return chuyentieps(event,'luachon')" type="text" name="denngay"  id="denngay" title="Click đôi để xoá trắng" ondblclick="xoatrang(this)" class="text" style="width:65px" value="{denngay}" />
<img src="images/img.gif" id="Lichtungaytao3" style="cursor: pointer; border: 0px solid red;" title="Date selector"  onclick="displayCalendar(frmnhap.denngay,'dd/mm/yyyy',this)" /></span><strong>  
<input type="button" name="nhapexcel" id="nhapexcel"   style="width:80px"  onclick="nhapexcel1()" value="Nhập Excel" />
   </strong>   </span></div>
	<div >Tên SP:  
	  <input type="text" name="tensp" id="tensp" class="inpl"  style="width:140px" readonly=""  value="" />
	  &nbsp;Mã:  
	<input type="text" name="masp"  id="masp" class="inpl"  style="width:60px" readonly=""   value="" />
 	<input type="hidden" name="idsp"  id="idsp"    value="" /><input type="hidden" name="idg"  id="idg"    value="" />
	 
	 giá:  <input type="text" name="dongia" id="dongia"  class="inpl"   style="width:60px;" value="0" disabled="disabled"/>
	  giá chặn:  <input type="text" name="giachan" id="giachan"  class="inpl"   style="width:60px;" value="0" disabled="disabled"/>
    <select name="loaitien" id="loaitien"  onkeyup ="return chuyentiep(event,'soluong')" style="display:none">
      <option value="VND">VND</option>
      <option value="USD">USD</option>
    </select>
    Giảm: 
    <input type="text" name="giamrieng" id="giamrieng" class="inpl"  onchange="setgiam(dongia.value,this.value,giadagiam)"   style="width:40px" value="" />
      
%
Giá Giảm <input type="text" name="giadagiam" id="giadagiam" class="inpl"  onchange="setgiampt(dongia.value,this.value,giamrieng)"  onkeypress="formatchuan(this)"   style="width:60px" value="" />
 Ghi chú 
	  <input type="text" name="ghichu"  id="ghichu"   onkeyup ="return chuyentiep(event,'add')"     style="width:100px"  value="" />
     <input type="button" name="add"  id="add" style="width:40px" onclick="addpro(idg.value,idsp.value,giamrieng.value ,ghichu.value,idchuyen.value,tungay.value,denngay.value,0  )" value="ADD"   onkeyup ="return chuyentiep(event,'NameTK')"  /> 
	</div>  
 		 
	
	 

 </fieldset>
  </div>
  <!-- END: block_nhaptt -->
  <div id="divluanchuyen" style="padding-top:4px">
   
 
 
  </div> 
  <div><strong>
    <input type="button" name="nhapexcel2" id="nhapexcel2"   style="width:260px"  onclick="xoatatca(idchuyen.value)" value="Xoá tất cả hàng giảm giá trong cửa hàng" />
  </strong></div>
</form></fieldset></div></div>



<div id="hiennhapexcel"  style="display:none ; overflow:hidden; position:absolute;   top: 90px;left:0;width:100%; " align="center" >
  <div  style=" width:900px; min-height:510px;border:1px #999 solid; background-color:#FFF; opacity: 0.98;font-size:15px; 
  font-weight:bold; padding:5px; color:#F00;" >

<div align="right"><b style="color:#00F;cursor:pointer" onclick="goidongid('hiennhapexcel')">( X Đóng lại )</b></div>
 
 <div   id="timexxcel" style="padding:10px">
 
 
<input id="mangfilean" type="hidden"  size="25" name="mangfilean" value="" />
    <label>File giảm giá riêng cho cửa hàng
<input id="fileToUpload"  type="file" accept=".xlsx"   size="35" name="fileToUpload" class="input" style="height:22px" />
<button class="button" id="buttonUpload" onclick="return ajaxFileUpload();" style="height:22px">Tải lên</button>&nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  
  <button class="button" id="buttonUpload" onclick="return xuatkq();" style="height:22px">Xuất Excel</button>

 <div id="hienthiexcel" style="padding:5px">
 <table id="tbex" width="100%" border="0" cellpadding="0" cellspacing="0" style="background:#FFF;" class="tbchuan">		
 		<tr bgcolor="#F8E4CB">
		  <td align="center" class="cothienthi" height="23" width="35"><b>STT</b></td>
       
		  <td width="98" align="center" class="cothienthi" ><strong>Mã Hàng Hóa</strong></td>  
		 	   
		  <td width="383" align="center" class="cothienthi"><strong>Tên Hàng Hóa</strong> </td> 
          <td width="163" align="center" class="cothienthi"><strong>Đơn giá</strong> </td> 
		  <td width="72" align="center" class="cothienthi"><strong>Giá giảm</strong></td>
       
		   <td width="427" align="center" class="cothienthi"><strong>Ghi chú</strong></td>
           <td width="427" align="center" class="cothienthi"><strong> Mã cửa hàng</strong></td>
           <td width="427" align="center" class="cothienthi"><strong>Từ ngày</strong></td>
           <td width="427" align="center" class="cothienthi"><strong>Tới ngày</strong></td>
          		

		    
 		</tr>
		        	<tr bgcolor="" style="color:#000">
		  <td align="center" class="cothienthi" height="23" width="35">5</td>
       
		  <td width="98" align="center" class="cothienthi" >Mã cửa hàng</td>  
		 	   
		  <td width="383" align="center" class="cothienthi">Hàng giảm bắt đầu từ dòng 5 nhé</td> 
          <td width="163" align="center" class="cothienthi">50000</td> 
		  <td width="72" align="center" class="cothienthi">40000</td>
       
		   <td width="427" align="center" class="cothienthi">Trong file dòng nào cũng có mã nhé</td>
            <td width=" 27" align="center" class="cothienthi">TK</td>
          <td width=" 27" align="center" class="cothienthi">2020-07-22 10:00
</td>
          <td width=" 27" align="center" class="cothienthi">2020-07-22 16:00
</td>
		    
 		</tr>
        	<tr bgcolor="" style="color:#000">
		  <td align="center" class="cothienthi" height="23" width="35">5</td>
       
		  <td width="98" align="center" class="cothienthi" >all</td>  
		 	   
		  <td width="383" align="center" class="cothienthi">mã cửa hàng=all cho tất cả CH</td> 
          <td width="163" align="center" class="cothienthi">50000</td> 
		  <td width="72" align="center" class="cothienthi">40000</td>
       
		   <td width="427" align="center" class="cothienthi">Trong file dòng nào cũng có mã nhé</td>
            <td width=" 27" align="center" class="cothienthi">TK</td>
          <td width=" 27" align="center" class="cothienthi">2020-07-22 10:00
</td>
          <td width=" 27" align="center" class="cothienthi">2020-07-22 16:00
</td>
		    
 		</tr>
        </table>
 
 
 </div> 
</label>
<br />
 </div>
 </div>
</div>

<form name="xuatketqua" id="xuatketqua" action="xuatfile.php" method="post" target="_blank" >
  <input name= "noidung" id="noidung" type="hidden" value="Chưa chọn dữ liệu">
  <input name= "tenfile" id="tenfile" type="hidden" value="giamgiacuahang.xlsx">
  <input name= "loaifile" id="loaifile" type="hidden" value="application/vnd.ms-excel">
</form>
<script language="JavaScript">

function xoatatca(ch)
{
	if (ch==0) { alert('Bạn vui lòng chọn cửa hàng cần xóa tất cả !');return ;}
	poststr="DATA="+    encodeURIComponent(ch)+  "*@!"+  encodeURIComponent('del')+  "*@!"  + encodeURIComponent(0);
    poststr= poststr +"*@!"+encodeURIComponent(0)+"*@!"+ encodeURIComponent(0)+"*@!" + encodeURIComponent(0)+"*@!"+encodeURIComponent(0);
	 
     loadtrang('divluanchuyen', "giamgiacuahangluu", poststr,"xuly2") ;
}

function setgiam(dongia,phantram,giagiam)
{
	
	dongia =dongia.replace(',','');
	dongia =dongia.replace(',','');
	dongia =dongia.replace(',','');
	
	giagiam.value = txtFormatj(dongia - dongia*phantram/100) ;
		
}
function setgiampt(dongia,giagiam,phantram)
{
	
	dongia =dongia.replace(',','');
	dongia =dongia.replace(',','');
	dongia =dongia.replace(',','');
	
	giagiam =giagiam.replace(',','');
	giagiam =giagiam.replace(',','');
	giagiam =giagiam.replace(',','');	 
 
	
	phantram.value = txtFormatj( (dongia-giagiam)*100/dongia ) ;
		
}
function xuly2()
{
       goilai() ;
    document.getElementById('idsp').value= "" ; 
	document.getElementById('masp').value= "" ; 
	document.getElementById('tensp').value= "" ; 
	document.getElementById('giamrieng').value= "" ; 
	document.getElementById('dongia').value= "" ; 
  	document.getElementById('giachan').value= "" ; 
   	document.getElementById('ghichu').value= "" ; 
	document.getElementById('idg').value= "" ; 
 }
function addpro(idg,idsp,giamrieng, ghichu ,idchuyen,tu ,den,giamchonloc  ){ //  idg.value,idsp.value,giamrieng.value ,ghichu.value
    
	if 	(idsp == '')
	{
      alert('Bạn Chưa chọn hàng hóa cần giảm giá riêng !!!'); document.getElementById('codeprotk').focus(); return;	
	}
	if (laso(idchuyen) == 0)
	{
 	  alert('Bạn Chưa chọn cửa hàng giảm giá riêng!!!'); document.getElementById('idchuyen').focus();   return false;	
 	}	 
	if (laso(giamrieng) == 0)
	{
 	  alert('Bạn Chưa nhập % giảm giá riêng!!!'); document.getElementById('giamrieng').focus();   return false;	
 	}
 
		
	//var sl = laso(document.getElementById('sl').value) ;
	//if ( (laso(sl) == 0 || parseFloat(sl) < parseFloat(soluong) ) && trim(document.getElementById('sl').value) !='' )
	 
	
    poststr="DATA="+    encodeURIComponent(idg)+  "*@!"+  encodeURIComponent(idsp)+  "*@!"  + encodeURIComponent(giamrieng);
    poststr= poststr +"*@!"+encodeURIComponent(ghichu)+"*@!"+ encodeURIComponent(idchuyen)+"*@!" + encodeURIComponent(tu)+"*@!"+encodeURIComponent(den)+"*@!"+encodeURIComponent(giamchonloc)+"*@!"+encodeURIComponent(0)+"*@!"+encodeURIComponent(0);
     loadtrang('divluanchuyen', "giamgiacuahangluu", poststr,"xuly2") ;
 } 
 

function xoanhap(id)
{
     var cf = "Bạn Có muốn xóa không!!! \n\nBấm OK để xóa ?" ;
	 var n = confirm(cf);
	 if(n == false)		{		return false;	   }	
     poststr="DATA="+    encodeURIComponent(id)+  "*@!"+  encodeURIComponent("xoa") + "*@!"+  encodeURIComponent(0) ;
     loadtrang('divluanchuyen', "giamgiacuahangluu", poststr,"xuly2") ;	  
} 

function setthongtin(idg,idch,IDSP,GhiChu,tensp,masp ,gia,giachan, giamgia,IDnhan,sophieu )
  {     
       document.getElementById('idg').value= idg;
 	  document.getElementById('idsp').value= IDSP;
	  document.getElementById('tensp').value= tensp;
	    document.getElementById('dongia').value= gia;
	 	 document.getElementById('masp').value= masp;	   
 			  document.getElementById('giachan').value= giachan;
  				  document.getElementById('ghichu').value= GhiChu;
				    document.getElementById('giamrieng').value= giamgia;
				  document.getElementById('idchuyen').value= idch;
				//   document.getElementById('sophieu').value= sophieu;
  	 
 }


function goilai(ch)
 { var t1='',t2='',t3='',t4='',t5='',t6='',t7=''
   
    poststr="DATA="+    encodeURIComponent(ch)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(t3)+  "*@!"+ encodeURIComponent(t4);
    poststr= poststr +  "*@!"+ encodeURIComponent(t5)+  "*@!"+ encodeURIComponent(t6)+  "*@!"+ encodeURIComponent(t7) ;
    loadtrang('divluanchuyen', "giamgiacuahanght", poststr,"xuly8") ;
 
 	 
 }
 goilai(0);
 
 function xuly3()
 {
 		goilai(document.getElementById('idchuyen').value);
 }
  function xuly8()
 {
 alert(123)
 }

 function setsanpham(id,ten,ma,gia,dvt,giagia,giachan,soluong)
{ 
   
 	document.getElementById('idsp').value= id; 
	document.getElementById('tensp').value= ten; 
	document.getElementById('masp').value= ma; 
	document.getElementById('dongia').value = gia; 	
	document.getElementById('giachan').value = giachan; 	
	
	document.getElementById('giamrieng').value = giagia; 		
	document.getElementById('sanpham').innerHTML = "" ; 
	document.getElementById('giamrieng').focus(); 
	
}
function xuly5()
{ 
   var tam =  document.getElementById('khonghienthi').innerHTML ;
  var  n=tam.split("##"); 
  if (n[1]=="") return;
   setsanpham(n[1],n[2],n[3],n[4],n[5],n[6],n[7],n[8]);
    
 }
function timtheomacode(v)
{ 	
     poststr="DATA="+    encodeURIComponent(v)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0) ;
    loadtrang('khonghienthi', "xuattimtheoma", poststr,"xuly5") ;
} 

var mangsp = new Array() ;
var mangsp1 = new Array() ;
var mangtam = new Array() ;
 var x ;

var timer;
  function  goisp(v)
  {
     clearTimeout(timer);
    timer=setTimeout( function validate() { timtheomacode(v) },500);
  }
  

 
// document.getElementById('luubd').innerHTML = document.getElementById('divluanchuyen').innerHTML ; 
 //document.getElementById('luutimsp').innerHTML = document.getElementById('sanpham').innerHTML ;
  
 
   
 
  
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
		mangsp[mgt[1]] = new Array(mgt[1],mgt[3],Math.abs(mgt[2]),mgt[4],mgt[7],mgt[6],mgt[9]);	   
	}

	xuatsp() ;
	document.getElementById('luu').disabled= false; 
	document.getElementById('khoa').disabled= true; 	
	document.getElementById('huyphieu').disabled= true; 	
}
 
 
 function xuly3()
 {
	 var mang = ketqua.split('@$@');
	 document.getElementById('diachi').value = mang[0]; 
  }
 
 

 function xuattimsanpham(t1,t2,t3,t4,t5,t6){
	
  poststr ="DATA="+encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(t3)+  "*@!"+ encodeURIComponent(t4);
  poststr = poststr +  "*@!"+ encodeURIComponent(t5)+  "*@!"+ encodeURIComponent(t6);
  loadtrang('sanpham', "giamgiacuahangtimsp", poststr,"") ;
  
 } 
  
//=======================================================
  
 
function clearchon() 
 {
 
	document.getElementById('NameTK').value= '' ;		
	document.getElementById('codeprotk').value= '' ;		
	document.getElementById('code').value= '' ;		
	document.getElementById('IDGrouptk').value = '0' ;		
 	document.getElementById('sanpham').innerHTML ="" ;
 }
//=======================================================
 
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
function goiin()
{ 		
	var so = document.getElementById('sochungtu').value ;
	var st ;
	st = "nhapkhoin.php?id=" + so  ;
	window.open(st,'popup','toolbar=no,status=no,scrollbars=yes,location=no,menubar=no,directories=no,width=1000,height=600,titlebar=no') ;
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
	document.forms['nhapsp'].btnUpdate.disabled = '' ;
}
 
function tinhgiamgia2(tongcong,giatri,loaitien)
{
		var tienchuagiam ;

	    document.getElementById('thanhtien').innerHTML = parseFloat(tienchuagiam) - parseFloat(document.getElementById('giamphamtram').innerHTML) - parseFloat(tongcong) ; 		
}

 
function nhapexcel1()
{
 
 	 
    if (document.getElementById('hiennhapexcel').style.display =="")
	{
		document.getElementById('hiennhapexcel').style.display = "none";
		document.getElementById('timkhachhanght').style.display = '' ;	
		document.getElementById('timphieuxuat').style.display = 'none' ;	
 	}else
	{
		document.getElementById('hiennhapexcel').style.display = "";
		document.getElementById('timkhachhanght').style.display = 'none' ;	
		document.getElementById('timphieuxuat').style.display = '' ;	
	}

	
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
function xuatkq()
{
	 
	 document.getElementById("noidung").value = ' <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><html><body>'+ document.getElementById("hienthitim").innerHTML+"</body></html>"; 
	 // alert( document.getElementById("ketqua").value);
	 document.getElementById("xuatketqua").submit();
}	
function xuly4()
{ 
	alert('Đã lấy dữ liệu xong !!!');
	goidongid('hiennhapexcel');
}
function laydulieue()
{
	var t1,t2,t3 ,t4 ;
	t1 =document.getElementById('idchuyen').value;
    t2= document.getElementById('tungay').value;
	t3= document.getElementById('denngay').value;
	 
	
   poststr ="DATA="+encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(t3)+  "*@!"+ encodeURIComponent(0);
   loadtrang('divluanchuyen', "giamgiacuahangluuex", poststr,"xuly4") ;		
}
function xuatbaoloi(l,d)
{
	alert(' có lỗi trong file tải lên, kiểm tra dòng màu đỏ ' + d);
}
function hienthidulieu()
{
	var t1 ;
	t1=document.getElementById('idchuyen').value;
	   poststr ="DATA="+encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(0) ;
 	  loadtrang('hienthiexcel', "giamgiacuahanghtex", poststr,"") ;		
 
}
</script>
 
  	<script type="text/javascript" src="templates/jquery.js"></script>
	<script type="text/javascript" src="templates/ajaxfileupload.js"></script>

