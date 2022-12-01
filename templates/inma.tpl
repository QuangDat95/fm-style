<div class="top_space"></div>
<div class="nenbao"> 
<div style="padding:1px">
<fieldset  class="nencon">
	<legend> <a style="cursor:pointer"  >
	<label style="Color:#FF3300;Font-Weight:Bold;Font-size:13pt;" >In mã vạch</label>
	</a> </legend>
    <form name="frmnhap" id="frmnhap"  method="get" >
 <div style="display:none" id="hthuongdan"> </div>
<div id="timkhachhang" style="display:none">
	<fieldset style="border-color:#336600;padding:5px;">
	<legend> <a style="cursor:pointer" onClick="anhienform('hosot')">
	<label style="Color:#5BB6E6;Font-Weight:Bold;Font-size:14pt;cursor:pointer"  onclick="timkiemnhacc()">Tìm Nhà cung cấp </label>
	</a> </legend>
	<div><br />
	  <span class="chu">Loại KH
      <select name="loaikh" id="loaikh" style="width:80px"    onkeypress="return chuyentiep(event,'ten')" >
        <option value="1">Công ty</option>
        <option value="2">Cá nhân</option>
      </select>
&nbsp;
Tên
<input type="text" name="ten" id="ten" class="inpl"  style="width:110px" onkeypress="return chuyentiep(event,'diachitim')"   value="" />
Địa chỉ
<input type="text" name="diachitim"  id="diachitim" class="inpl"  style="width:110px" onkeypress="return chuyentieps(event,'kv')"   value="" />
khu vực &nbsp;
 <select class="compo"  name="kv" id="kv"  onkeypress="return chuyentieps(event,'search2')"  style="width:130px"  >
  <option value="0"></option>
    {khuvuc}
  </select>
      </span> <span style="padding-bottom:10px">
      <input type="button"   onfocus="setrong()" onclick="timkiemncc(loaikh.value, ten.value,diachitim.value,kv.value)"   name="search2"  id="search2" value="Tìm" />
      </span><span style="padding-bottom:10px">
      <input type="button" style="display:{q_themc}"  onclick="themnhacc(loaikh.value, ten.value,diachitim.value,kv.value)"   name="search22"  id="search22" value="Thêm" />
      </span><span style="padding-top:2px">
      <input type="button" value="Quay lại"  id="timnhacc2" name="timnhacc2"  style="width:70px" onclick="timkiemnhacc()">
      </span></div>
	  
	<div id="hienthinhacc" >
       <table width="100%" border="0" cellpadding="0" cellspacing="0">		
 		<tr bgcolor="#F8E4CB">
		  <td align="center" class="cothienthi" height="23" width="33"><b>STT</b></td>
		  <td width="345" align="center" class="cothienthi" ><strong>Tên Nhà Cung Cấp </strong></td>  
		  <td width="362" align="center" class="cothienthi"><strong><strong><strong>Địa chỉ </strong></strong></strong> </td> 	   
		  <td width="160" align="center" class="cothienthi"><strong>Điện Thoại </strong></td>
		  <td width="178" align="center" class="cothienthi"><strong><strong>Email</strong> </strong></td>	    	      
		   	 
		</tr>
			
 	 	  <tr  >
		  		<td class="cothienthi">&nbsp;</td>				
				<td class="cothienthi">&nbsp;</td>
				<td class="cothienthi">&nbsp;</td>
				<td class="cothienthi">&nbsp;</td>
				<td class="cothienthi">&nbsp;</td>
				 
   </tr>
			
	</table>



	</div>


</fieldset>
</div>

 <div style="display:" id="timphieunhap">
 <fieldset >
	<legend align="center"><label style="Color:#5BB6E6;Font-Weight:Bold;Font-size:14pt;cursor:pointer" onclick="anhien2f('ankhachhang','khachangchitiet')" >Tìm phiếu nhập </label>
	 </legend>
 

   <div style="padding-bottom:5px"><br />

<select name="khoaphieut" id="khoaphieut" style="width:80px"    onkeypress="return chuyentiep(event,'sophieut')" >
  <option value="0">Chưa khóa</option>
  <option value="1">Đã Khóa</option>
  <option value="">Tất Cả</option>
</select>
Số phiếu
       <input type="text" name="sophieut" id="sophieut" class="inpl" ondblclick="this.value=''"  style="width:70px" onkeypress="return chuyentiep(event,'sohoadon')"   value="" />
Số HĐơn
       <input type="text" name="sohoadon" id="sohoadon" class="inpl" ondblclick="this.value=''" style="width:70px" onkeypress="return chuyentiep(event,'nhacct')"   value="" />
    Nhà cung cấp
  <input type="text" name="nhacct" id="nhacct" class="inpl"  style="width:90px" onkeypress="return chuyentiep(event,'tungay')"   value="" />
  &nbsp;	  Ngày
  <input onkeypress="return chuyentiep(event,'denngay')" type="text" name="tungay"   id="tungay" class="text" style="width:65px"  value="{tungay}" />
  <img src="images/img.gif" id="Lichtungaytao" style="cursor: pointer; border: 0px solid red;" title="Date selector"  onclick="displayCalendar(frmnhap.tungay,'dd/mm/yyyy',this)" />&nbsp;đến
  <input onkeypress="return chuyentiep(event,'timk')" type="text" name="denngay"  id="denngay" class="text" style="width:65px" value="{denngay}" />
  <img src="images/img.gif" id="Lichtungaytao" style="cursor: pointer; border: 0px solid red;" title="Date selector"  onclick="displayCalendar(frmnhap.denngay,'dd/mm/yyyy',this)" />&nbsp; 
       
     &nbsp;<input type="button"   onclick="timdsphieunhap(0,sophieut.value, nhacct.value,tungay.value,denngay.value,khoaphieut.value,0,sohoadon.value)"   style="width:68px"   name="timk"  id="timk" value="Tìm kiếm" />
      
     <input type="button" name="timnhap2" id="timnhap2" style="width:65px"  onclick="timphieu()" value="Quay Lại" />
      </div>
   <div id="httimnhap" >
     <table width="100%" border="0" cellpadding="0" cellspacing="0">
 		<tr bgcolor="#F8E4CB">
		  <td align="center" class="cothienthi" height="23" width="111"><b>Số Phiếu </b></td>
		  <td width="79" align="center" class="cothienthi" ><strong>Ngày nhập </strong></td>  
		 	   
		  <td width="296" align="center" class="cothienthi"><strong>Lý Do </strong> </td> 
		  <td width="185" align="center" class="cothienthi"><strong>Người giao hàng </strong></td>
		   <td width="398" align="center" class="cothienthi"><strong>Nhà cung cấp </strong></td>
		    <td width="162" align="center" class="cothienthi"><strong>Người Tạo</strong></td>
 		</tr>
     </table>
   </div>
   <div id="httimlai"></div>


   </fieldset>
 </div>

 <div id="codechinh">

 
<!-- BEGIN: block_nhaptt --> 


  
<div id="khachangchitiet">
 <div style="float:left ;display:none; width:270px;padding-right:4px">
<fieldset style="height:130px">
	<legend>  
	<label style="Color:#5BB6E6;Font-Weight:Bold;Font-size:12pt;" >Thông Tin Phiếu Nhập </label>
	 </legend>
	
	 
	<table   width="98%" border="0" cellpadding="1" cellspacing="0" style="padding-top:0px">		
		 <tr  >
			<td width="36%" valign="middle">Lập phiếu </td>
			<td>{ten}</td>
		  </tr>

		<tr  >
			<td   valign="middle" colspan="2">Ngày CT  
		    <input type="text" name="ngaynhap" id="ngaynhap" class="inpl" readonly="" onkeyup="return chuyentiep(event,'sochungtu')"  style="width:32px" value="{ngaynhap}" />
		    <img  src="images/img.gif" id="Lichtungaytao" style="display:none;cursor: pointer; border: 0px solid red;" title="Date selector"  onclick="displayCalendar(frmnhap.ngaynhap,'dd/mm/yyyy',this)"     />
		    <input name="idgoi" id="idgoi" type="hidden"  value="" />  Số CT:<input type="text" name="sochungtu"  class="inpl" id="sochungtu" readonly="" onkeyup="return chuyentieps(event,'kho')"  style="width:100px" value="{sochungtu}" onblur="kttrung(this.value)" /></td>
		</tr>
 		<tr>
			<td height="20px" colspan="2" >Nhập vào:  {tenkho}
		  <input type="hidden" name="kho" id="kho"  value="1"  >
		  <input type="hidden" name="TiGia" id="TiGia"   value="{TiGia}"  /><input type="text" name="VAT" id="VAT"   style="display:none"  >		  </td>
		</tr>
		<tr>
			<td >NV giao hàng</td>
			<td ><span style="padding-top:2px">
			  <input type="text" name="nguoigiao" class="inpl" id="nguoigiao"  onkeypress="return chuyentieps(event,'hoadongoc')"  style="width:153px" value="{nguoigiao}" />
			</span>			  </td>
		</tr>
        <tr>
			<td >Số H.đơn gốc:</td>
			<td ><span style="padding-top:2px">
			  <input type="text" name="hoadongoc" class="inpl" id="hoadongoc"  onkeypress="return chuyentieps(event,'khachhang')"  style="width:153px" value="{hoadongoc}" />
			</span>			  </td>
		</tr>
  </table>
</fieldset>
</div>

 
 <div style="float:none;display:none"> 
<fieldset style="height:130px;margin:0">
	<legend> <a style="cursor:pointer" onClick=" anhienform('obj') ">
	<label style="Color:#5BB6E6;Font-Weight:Bold;Font-size:12pt">Nhà cung cấp </label>
	</a>  </legend>
	
<div style="padding-top:2px">
<div style="float:left;width:80px"> Lý Do Nhập</div>
     <select name="lydo" id="lydo"  style="width:170px" onkeypress="return chuyentiep(event,'nguoigiao')" >
       <option value="0"> </option> 
 			  {lydo}
      </select>
  	 
Nhà Cung Cấp
<select name="khachhang" id="khachhang" style="width:280px" onchange="timdiachicc(this.value)"  onkeypress="return chuyentiep(event,'note')" >
    <option value="0">Chọn nhà cung cấp</option>
 			  {nhacungcap}
     </select>
     <input type="button" value="Tìm"  id="timnhacc" name="timnhacc"  style="width:40px" onclick="timkiemnhacc()"  />

<div style="float:none"></div>
</div>
 
<div style="padding-top:2px">
  <div style="float:left;width:80px;padding-top:4px" >Địa chỉ </div>
 <samp id="diachicc"> <input type="text" name="diachi"  id="diachi" readonly=""   style="width:539px" value="{diachi}" /></samp>
   <div style="float:none"></div>
</div>

<div style="padding-top:2px">
 		<div style="float:left;padding-top:10px;width:80px" >  Ghi  Chú</div>
		 <textarea id="note" name="note" class="texta" style='width:539px;height:42px;overflow:auto'>{note}</textarea>
		 <div style="float:none"></div>
</div>
	
 

	 </fieldset>
</div>
 <div style="clear:left"></div>
</div>





<div>
 <fieldset style="display:none">
	<legend> 
	<label style="Color:#5BB6E6;Font-Weight:Bold;Font-size:14pt">Thông Tin kế Toán </label>
	 </legend>
		<div>&nbsp;</div>
	<div>
	Tài khoản ghi nợ: <select name="taikhoanno"  style="z-index:100" >
				  <option> &nbsp;&nbsp;Mã &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Tên TK</option>
					{taikhoanno}
			      </select>
	Tài khoản ghi có: 
				<select name="taikhoanco" >
				  <option>&nbsp;&nbsp;Mã &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Tên TK</option>
					{taikhoanco}
			      </select>
	</div>
	<div style="padding-top:10px;vertical-align:text-top"  ></div>	
	
	
 </fieldset>
	 
</div>

  
 <div >
  <fieldset style="padding-top:5px">
	<legend> <a style="cursor:pointer" onClick="anhienform('chon')">
	<label style="Color:#5BB6E6;Font-Weight:Bold;Font-size:12pt">Chọn hàng hóa cần in mã vạch</label>
	</a> </legend>
<div id="chon" style="float:left">
<div  style="float:left;"> 
  <input onkeypress="return chuyentiep(event,'IDGrouptk')" type="hidden" name="code"  id="code"   onkeyup="goispg(this.value)"  class="text" size="9" value=""  ondblclick="this.value=''"/> 
Mã
<input onkeypress="return chuyentiep(event,'IDGrouptk')" type="text" name="codeprotk"  id="codeprotk"   onkeyup="goisp(this.value)"  class="text" size="9" value=""  ondblclick="this.value=''"/>  &nbsp;Tên
    SP
    <input onkeypress="return chuyentiep(event,'search')" type="text" name="NameTK"  id="NameTK" class="text" size="10" value="" />
    &nbsp; 

  

 Nhóm
<select onkeypress="return chuyentiep(event,'search')" name="IDGrouptk"  id="IDGrouptk" style="width:100px">
  <option value="0" ></option>
 	{cay}
 </select>
&nbsp; 
<input type="button" style="width:40px"  onclick="timsanpham(NameTK.value,codeprotk.value,code.value,IDGrouptk.value,'',kho.value)"   name="search"  id="search" value="Tìm" />
</span>
  
	   <input type="hidden" name="soluongcon"  value="" />
	   
	   <input type="button" name="cl" style="width:40px" onclick="clearchon()" value="clear" /></div> 
<input type="button" name="tm" style="width:100px;display:{q_themp}"    value="Nhập từ Excel" onclick="nhapexcel1()" />
<div style="height:5px"  id="cho" >    </div>
	   <div style="clear:left"></div>
	   <div id="sanpham" style="padding-top:2px">
  
	  </div>
</div></fieldset>

<div style="padding-bottom:5px">  
   <fieldset style="display:">
	<legend> 
	<label style="Color:#5BB6E6;Font-Weight:Bold;Font-size:12pt">Hàng Hóa Nhập Kho </label>
	 </legend>	

 
	<div >Tên SP:  
	  <input type="text" name="tensp" id="tensp" class="inpl"  style="width:280px" readonly=""  value="" />
	  &nbsp;&nbsp;Mã SP: &nbsp;
	<input type="text" name="masp"  id="masp" class="inpl"  style="width:80px" readonly=""   value="" /> 
 	<input type="hidden" name="idsp"  id="idsp"    value="" />
	 <input type="hidden" name="sl"  id="sl"    value="" />
	 Giá Bán <input type="text" name="giaban" id="giaban" maxlength="12"  style="width:70px;" value="0"  class="inpl"  disabled="disabled" />    
	  
 	 <input type="hidden" name="ngoaite" id="ngoaite" maxlength="12" class="text" style="width:50px;" value="0"   onkeydown="return chuyentiep(event,'dongia')"   onblur="tinhgia(this.value) ; " ondblclick="this.value=''"/>  
     <input type="hidden"  style="width:80px;" readonly="readonly"  name="tigia" id="tigia" ondblclick="goitigia()" on value="{tigia}" />	
    
     Giá bán 
     <input type="text" name="dongia" id="dongia" maxlength="12" class="text" style="width:70px;" value="0"  onkeyup="formatchuan(this)"  onkeydown="return chuyentiep(event,'soluong')"   onblur="txtFormat(this)" ondblclick="this.value=''"/> 
	  <select name="loaitien" id="loaitien"  onkeyup ="return chuyentiep(event,'soluong')" style="display:none">
        <option value="VND">VND</option>
        <option value="USD">USD</option>		
      </select>
	  Số lượng 
	<input type="text" name="soluong" id="soluong"  onkeyup ="return chuyentieps(event,'add')"  class="text" style="width:40px" value="1" />
	<input  type="hidden"   name="thue"  id="thue"   value="" />
	    
	  
	  <input type="hidden" name="ghichu"  id="ghichu"    value="" />
     <input type="button" name="add"  id="add" style="width:50px" onclick="addpro(idsp.value,tensp.value,masp.value,dongia.value,giaban.value,soluong.value,thue.value,ghichu.value,'')" value="ADD"   onkeyup ="return chuyentiep(event,'NameTK')"  /> 
</div>
 </fieldset>
  </div>
  <!-- END: block_nhaptt -->
 <div id="sanphamnhap" style="height:350px;overflow:scroll;" >
   <table width="100%" border="0" cellpadding="0" cellspacing="0">
     <tr bgcolor="#F8E4CB">
       <td width="29"  align="center" class="cothienthi" height="23"><b>STT</b></td>
       <td width="115" align="center" class="cothienthi"><strong>Mã Hàng Hóa </strong></td>
       <td width="310" align="center" class="cothienthi"><strong>Tên Hàng Hóa</strong></td>
       <td width="48"  align="center" class="cothienthi"><strong>SL</strong></td>
       <td width="152" align="center" class="cothienthi"><strong>Đơn Giá </strong></td>
 
       <td width="164" align="center" class="cothienthi"><strong>Thành Tiền </strong></td>
 
        <td width="45"  align="center" class="cothienthi"><strong>X&#243;a</strong></td>
     </tr>
 
    
       <tr bgcolor="{color}">
         <td  class="cothienthi" >&nbsp;</td>
         <td  class="cothienthi" >&nbsp;</td>
         <td  class="cothienthi" >&nbsp;</td>
         <td  class="cothienthi" >&nbsp;</td> 
         <td  class="cothienthi" >&nbsp;</td>
         <td  class="cothienthi" >&nbsp;</td>
         <td  class="cothienthi" >&nbsp;</td>
 
       </tr>
    
   </table>

 
</div> 

 
<div  style="padding-top:9px"><span class="cungdong1">
  <input type="button" name="themmoi"  id="themmoi" style="width:70px;display:{q_them}"  onclick="window.open('default.php?act=inma','_self')" value="Thêm Mới" />
    &nbsp;  &nbsp; <input type="button" name="copy" id="copy"  onclick="copyp()"  disabled="disabled" value="Copy" style="display:none;width:70px" />
       
	 &nbsp;
	 <input type="button" name="inma2"  id="inma2" style=" width:170px;font-size:20px"  onclick="goiinma3()" value="In Mã Vạch 3 tem" /> 
	 &nbsp;  <input type="button" name="timnhap" id="timnhap" style=" width:170px;font-size:20px"   onclick="timphieu()" value="Tìm Phiếu Nhập" />
	  &nbsp; &nbsp;  <input type="button" name="timnhap32" id="timnhap32"  style="display:none;width:80px"  onclick="huongdan()" value="Hướng Dẫn" />
	  <input type="button" name="timnhap3" id="timnhap3" style="width:80px"  onclick="matdinh()" value="Đóng lại" />
&nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;  &nbsp;
 
 </span>  </div>

 
  <div id="ketqualuu" style="width:800"></div>
  <div id="luutimsp" style="display:none"></div>
  <div id= "luubd"  style="display:none"></div>
 <!-- =================================KT 33333====================================== -->
 <div style="clear:left;display:none" id="khonghienthi"></div>
 </div>
 
   </form>
</fieldset> 

<div id="hiennhapexcel"  style="display:none ; overflow:hidden; position:absolute;   top: 90px;left:0;width:100%; " align="center" >
  <div  style=" width:900px; min-height:510px;border:1px #999 solid; background-color:#FFF; opacity: 0.98;font-size:15px; 
  font-weight:bold; padding:5px; color:#F00;" >

<div align="right"><b style="color:#00F;cursor:pointer" onclick="goidongid('hiennhapexcel')">( X Đóng lại )</b></div>
 
 <div   id="timexxcel" style="padding:10px">
 
 
<input id="mangfilean" type="hidden"  size="25" name="mangfilean" value="" />
    <label>File nhập kho từ Excel *.xlsx</label>
<input id="fileToUpload" type="file" accept=".xlsx"   size="35" name="fileToUpload" class="input" style="height:22px" />
<button class="button" id="buttonUpload" onclick="return ajaxFileUpload();" style="height:22px">Tải lên</button>&nbsp;  

 <div id="hienthiexcel" style="padding:5px">
 <table id="tbex" width="100%" border="0" cellpadding="0" cellspacing="0" style="background:#FFF;" class="tbchuan">		
 		<tr bgcolor="#F8E4CB">
		  <td align="center" class="cothienthi" height="23" width="32"><b>STT</b></td>
       
		  <td width="75" align="center" class="cothienthi" ><strong>Mã Hàng Hóa</strong></td>  
		 	   
		  <td width="360" align="center" class="cothienthi"><strong>Tên Hàng Hóa</strong> </td> 
          <td width="39" align="center" class="cothienthi"><strong>Số lượng</strong></td>
          <td width="40" align="center" class="cothienthi"><strong>Đơn giá</strong> </td> 
 		   <td width="312" align="center" class="cothienthi"><strong>Ghi chú</strong></td>
		    
 		</tr>
        	<tr bgcolor="" style="color:#000">
		  <td align="center" class="cothienthi" height="23" width="32">5</td>
       
		  <td width="75" align="center" class="cothienthi" >Mẫu tải</td>  
		 	   
		  <td width="360" align="center" class="cothienthi">Tên hàng hóa không bắt buộc lấy từ dòng 2 nhé</td> 
          <td width="39" align="center" class="cothienthi">9</td> 
		  <td width="40" align="center" class="cothienthi">99000</td>
       
		   <td width="312" align="center" class="cothienthi">Trong file dòng nào cũng có mã nhé</td>
		    
 		</tr>
        </table>
 
 
 </div> 
 
</div>
</div>


 
  
 

</div> 


 
  </div>
</div>  
<script language="JavaScript">
var mangsp = new Array() ;
var mangsp1 = new Array() ;
var mangtam = new Array() ;

var x ;
 var timer;
document.getElementById('timphieunhap').style.display = 'none' ;
function setthongtin(id)
{
	 
 	document.getElementById('idsp').value= id; 
	document.getElementById('masp').value= mangsp[id][0]; 
	document.getElementById('tensp').value= mangsp[id][1];  	
	document.getElementById('soluong').value= mangsp[id][2]; 
	document.getElementById('dongia').value= mangsp[id][3]; 
 	document.getElementById('thue').value= mangsp[id][4];
	document.getElementById('loaitien').value= mangsp[id][5]; 
   	document.getElementById('giaban').value= mangsp[id][5]; 
  	document.getElementById('dongia').focus(); 

}
 function timtheomacode(v)
{ 	
	 
    poststr="DATA="+    encodeURIComponent(v)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0) ;
    loadtrang('khonghienthi', "nhapkhotimtheoma", poststr,"xuly9") ;
 } 
 
 
function xuly9()
{ 

  var tam =  document.getElementById('khonghienthi').innerHTML ;  
  var  n=tam.split("##"); 
  if (n[1]=="") return;
 
   setsanpham(n[1],n[2],n[3],n[10],n[5],n[9],n[7],n[8]);
     document.getElementById('code').value="";
	 document.getElementById('codeprotk').value="";
	 
 }
 function  goisp(v)
  {
     clearTimeout(timer);
   timer=setTimeout( function validate() { timtheomacode(v) },500);
  }
 function  goispg(v)
  {
     clearTimeout(timer);
   timer=setTimeout( function validate() { timtheomacodegoc(v) },500);
  }
  
  
function timdsphieunhap(t0,t1,t2,t3,t4,t5,t6,t7)
{
  poststr="DATA="+encodeURIComponent(t0)+"*@!"+encodeURIComponent(t1)+"*@!"+ encodeURIComponent(t2)+"*@!"+ encodeURIComponent(t3)+"*@!"+ encodeURIComponent(t4);
  poststr= poststr +  "*@!"+ encodeURIComponent(t5)+  "*@!"+ encodeURIComponent(t6)+  "*@!"+ encodeURIComponent(t7);
  loadtrang('httimnhap', "nhapkhotim", poststr,"") ;	
}

function xuly6()
{
   var so = document.getElementById('sochungtu').value ;
	var st ;
	st = "inma3tem.php?id="    ;
	window.open(st,'popup','toolbar=no,status=no,scrollbars=yes,location=no,menubar=no,directories=no,width=720,height=600,titlebar=no') ;

	}
 
 
function xuly5()
{
   var so = document.getElementById('sochungtu').value ;
	var st ;
	st = "inma2tem.php?id="    ;
	window.open(st,'popup','toolbar=no,status=no,scrollbars=yes,location=no,menubar=no,directories=no,width=720,height=600,titlebar=no') ;

	}
function goiinma2()
{ 	
  poststr="DATA="+ encodeURIComponent(mangthanhchuoi(mangsp)) ;
  loadtrang('khonghienthi', "inmataobien", poststr,"xuly5") ;	
  	
}
 
 function goiinma3()
{ 	

	
  poststr="DATA="+ encodeURIComponent(mangthanhchuoi(mangsp)) ;
  loadtrang('khonghienthi', "inmataobien", poststr,"xuly6") ;	
  	
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
 
function xuly4()
{
	 //alert( ketqua)
   var ma = ketqua.split('&$&');
   var m = ma[0].split('@$@');

 
   var msp =  ma[1].split('@$&');
   var mang = new Array() ;
   var mgt =  new Array() ;
   	mangsp = mang ;
	for (x in msp)
	{ //alert(msp[x]);
	    mgt = msp[x].split('@$@') ;
 	    mangsp[mgt[2]] = new Array(mgt[3],mgt[7],Math.abs(mgt[4]),mgt[6],mgt[8],mgt[6],mgt[10]);	
 	}
	 
//	alert( ketqua)
	 xuatsp() ; 
	timphieu() ;
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
  //=======================================================

 function setlaiphieunhap(t1,t2)
{
	  poststr="DATA="+ "0*@!" +  encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0);
	  loadtrang('khonghienthi', "nhapkhogoi", poststr,"xuly4") ;		
}

function timphieu()
{
	if ( document.getElementById('timphieunhap').style.display != "")
	{
	document.getElementById('timphieunhap').style.display = '' ;
	document.getElementById('codechinh').style.display = 'none' ;
	//document.getElementById('timk').click() ; 
	}
	else
	{
	document.getElementById('timphieunhap').style.display = 'none' ;
	document.getElementById('codechinh').style.display = '' ;
	}
	
}

function addpro(idsp,ten,code,dongia,loaitien,soluong,thue,ghichu){ 
	if 	(idsp == '')
	{
      alert('Bạn Chưa chọn hàng hóa!!!');document.getElementById('NameTK').focus(); return;	
	}
	if (laso(dongia) == 0)
	{
		 var cf = "Bạn chưa nhập giá  !!! \n\nBạn có muốn nhập hay không ?" ;
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
	 
	 
       mangsp[idsp] = new Array(code,ten,soluong,dongia,thue,loaitien,ghichu);	   
  	   xuatsp() ;
	   document.getElementById('nhac').play();
	   
} 

function xuatsp()
{
	var x,stt,tongsl,str ="" ;	stt= 0 ; 
	var thanhtien  ;
	thanhtien = 0 ; tong = 0 ; tongsl =0;
	   str = ' <table width="100%" border="0" cellpadding="0" cellspacing="0">' ;
	   str += '    <tr bgcolor="#F8E4CB"> ';
	   str += ' <td width="29"  align="center" class="cothienthi" height="23"><b>STT</b></td> ';
	   str += ' <td width="115" align="center" class="cothienthi"><strong>Mã Hàng Hóa </strong></td> ';
	   str += ' <td width="350" align="center" class="cothienthi"><strong>Tên Hàng Hóa</strong></td> ';
	   str += ' <td width="45"  align="center" class="cothienthi"><strong>SL</strong></td> ';
	   str += ' <td width="105" align="center" class="cothienthi"><strong>Đơn Giá </strong></td> ';
 	   str += ' <td width="100" align="center" class="cothienthi"><strong>Thành Tiền </strong></td> ';
  	   str += ' <td width="30"  align="center" class="cothienthi"><strong>Xóa</strong></td> ';
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
	thanhtien  = thanhtien + thanhtien * mangsp[x][4]/100 ;
	tong = tong + thanhtien ;	
	tongsl = 1*tongsl + 1*mangsp[x][2] ;
    stt = stt + 1;
 	str +='<TR onMouseOver="this.className=\''+ hl2+'\'" onMouseOut="this.className=\''+h1+'\'" bgcolor="'+mau+'" style="cursor:pointer" onclick="setthongtin(\''+ x + '\')">';
	str += ' <td class="cothienthi"  align="Right" height="23">'+ stt +'</td>';	
	str += ' <td class="cothienthi"  align=""  >&nbsp;' + mangsp[x][0] +'</td>';
	str += ' <td class="cothienthi"  align=""  >&nbsp;' + mangsp[x][1] +'</td>';
	str += ' <td class="cothienthi"  align="right"  >&nbsp;' + mangsp[x][2] +'</td>';
	str += ' <td class="cothienthi"  align="right"  >&nbsp;' + txtFormatj(mangsp[x][3]) +'</td>';
 
	str += ' <td class="cothienthi"  align="right"  >&nbsp;' + txtFormatj(thanhtien) +'&nbsp;</td>';
 
 	str += ' <td class="cothienthi"  align="center"  ><img onclick="xoapt(\''+ x + '\')" title=\"Xóa Mục\"  src="images/delete.gif" border="0"></td>';
 	str += ' </Tr>';		
		
	}
	str += ' <Tr class="cothienthi"><td colspan="3" align="right" ><b>Tổng cộng</b> </td><td align="right"><b>'+ txtFormatj(tongsl) +'&nbsp;</b></td> <td></td><td  align="right"><b>'+ txtFormatj(tong) +'</b>&nbsp;</td>';		
	str += ' </Tr>';		
  str +='</table>';
	document.getElementById('sanphamnhap').innerHTML = str ;
 
  
   }
function timsanpham(t1,t2,t3,t4,t5,t6){
	
  poststr="DATA="+encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(t3)+  "*@!"+ encodeURIComponent(t4);
  poststr= poststr +  "*@!"+ encodeURIComponent(t5)+  "*@!"+ encodeURIComponent(t6)+  "*@!"+ encodeURIComponent(0);
  loadtrang('sanpham', "nhapkhotimsp", poststr,"") ;
  
 } 
 function timtheomacode(v)
{ 	
	 
    poststr="DATA="+    encodeURIComponent(v)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0) ;
    loadtrang('khonghienthi', "nhapkhotimtheoma", poststr,"xuly9") ;
} 
 
  function setsanpham(id,ten,ma,gia,dvt,giaban,baohanh,sl)
{ 
   
 	document.getElementById('idsp').value= id; 
	document.getElementById('tensp').value= ten; 
	document.getElementById('masp').value= ma; 
	document.getElementById('dongia').value = giaban;
	document.getElementById('giaban').value = giaban;
 	 
	document.getElementById('sl').value = sl; 	
	document.getElementById('soluong').value = 1;
	document.getElementById('sanpham').innerHTML = "" ; 
	document.getElementById('soluong').select() ; 
	document.getElementById('soluong').focus(); 
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

function xuly2()
{ 
	alert('Đã lấy dữ liệu xong !!!');
	goidongid('hiennhapexcel');
}
function laydulieue()
{ 
 	 
	 var table = document.getElementById("tbex"); 
	 var totalRows = document.getElementById("tbex").rows.length;
 	var totalCol = 5; // enter the number of columns in the table minus 1 (first column is 0 not 1)
	  var tam;
	for (var x = 1; x <  totalRows; x++)
	  {
	 
		 
		   tam =table.rows[x] ;
		  addpro(tam.cells[1].innerHTML,tam.cells[3].innerHTML,tam.cells[2].innerHTML,tam.cells[6].innerHTML,tam.cells[6].innerHTML,tam.cells[4].innerHTML,0,0,'');
				
	  }
//To display a single cell value enter in the row number and column number under rows and cells below:
  xuatsp() ;
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
	
function hienthidulieu()
{ 
	   var t1 ;
	 //  t1=document.getElementById('idchuyen').value;
	   poststr ="DATA="+encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(0) ;
 	   loadtrang('hienthiexcel', "nhapkhoexcelht", poststr,"") ;		
 
}
</script>
 	<script type="text/javascript" src="templates/jquery.js"></script>
	<script type="text/javascript" src="templates/ajaxfileupload.js"></script>
