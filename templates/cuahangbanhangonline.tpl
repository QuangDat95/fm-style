<form name="frmxuat" id="frmxuat"  method="get" >
<div class="nenbao">
<div style="padding:0px">
<fieldset  class="nencon">
	<legend> <a style="cursor:pointer"  >
	<label style="Color:#FF3300;Font-Weight:Bold;Font-size:11pt;" >Cửa hàng bán hàng ONLINE</label>
	</a> </legend>
   
	
<table border="0" cellpadding="0" cellspacing="0">
<tr>
<td valign="top">
	<div style="height:610px;width:270px" id="left_bar">
		<div style="margin-top:5px;margin-bottom:5px">
	 <fieldset style="height:210px;width:270px" id="left_bar_fieldset">
	<legend>  
	<label style="Color:#5BB6E6;Font-Weight:Bold;Font-size:12pt;" >Thông Tin Phiếu Xuất</label>
	 </legend>
 	<table   width="100%" border="0" cellpadding="1" cellspacing="2" style="padding-top:0px">		
		

		<tr  >
			<td width="28%" valign="middle">Ngày Bán </td>
		    <td width="72%">:
		      <input type="text" name="ngaynhap" id="ngaynhap" class="inpl" readonly="" onkeyup="return chuyentiep(event,'sochungtu')"  style="width:70px" value="{ngaynhap}" />
		    <img  src="images/img.gif" id="Lichtungaytao" style="display:none;cursor: pointer; border: 0px solid red;" title="Date selector"  onclick="displayCalendar(frmnhap.ngaynhap,'dd/mm/yyyy',this)"     />
		    <input name="idgoi" id="idgoi" type="hidden"  value="" />
		    <input name="nguoitao123" id="nguoitao123" type="text"  value="{ten}" style="border:0px;width:90px" /></td>
		</tr>
		 
		<tr><td>Số C.Từ</td>
		<td>:<input type="text" name="sochungtu"  class="inpl" id="sochungtu" readonly="" onkeyup="return chuyentieps(event,'kho')"  style="width:139px" value="{sochungtu}" onblur="kttrung(this.value)" /></td>
		</tr>
 		<tr>
			<td height="20px" valign="top"  >Chi Nhánh 
		  <input type="hidden" name="kho" id="kho"  value="1"  ><input type="hidden" name="ol" id="ol"  value="{ol}"  >
		  <input type="hidden" name="TiGia" id="TiGia"   value="{TiGia}"  /><input type="text" name="VAT" id="VAT"   style="display:none"  >		 </td><td valign="top" ><textarea id="textarea" name="textarea" readonly="readonly"  style='width:160px;height:20px;overflow:auto;background-image: url("../images/dot_xanh.gif");border:0px; font-family: verdana; font-size: 1.1em; color:#0000FF'>:{tencuahang}</textarea>
	
		 </td>
		</tr>
         <tr>
			<td height="20px" valign="top"  >NV Pass 		  		 </td><td valign="top" ><select class="js-nv"   name="online"  id="online" style="width:160px">
                   <option value="0" ></option>
		  		   <option value="">Khách tự mua</option>
				   <option value="-2">Trả toàn bill</option>
                     {nhanvienonline}
 		  		   </select></td>
		  </tr>
		  <tr>
		  	<td height="20px" valign="top"  >
				Phí V/C thu khách			</td>
			<td valign="top" >
				<input type="text" width="160px" class="phivcthukhach" id="phivcthukhach" onkeyup ="formatchuan(this)" onchange="formatso(event)" onblur="txtFormat(this)" />			</td>
		  </tr>
		   <tr>
		  	<td height="20px" valign="top"  >
				Phí V/C DVVC thu			</td>
			<td valign="top" >
				<input type="text" width="160px" class="phivcdvvc" id="phivcdvvc" disabled="disabled" onkeyup ="formatchuan(this)" onchange="formatso(event)" onblur="txtFormat(this)"/>			</td>
		  </tr>
		    <tr>
		  	<td height="20px" valign="top"  >
				PTTT			</td>
			<td valign="top" >
				<select id="pttt" name="pttt" style="width:160px" onchange="checkpttt(this.value)">
				
					<option value="TM">Tiền mặt</option>
					<option value="CK">Chuyển khoản</option>
					<option value="COD">COD</option>
				</select>
		
				<div id="showaddstk" style="display:none;margin-top:0.5em">
				  <select id="tknh" name="tknh"  class="js-tknh" style="width:160px;" onchange="">
                    <option value="">Tài khoản ngân hàng</option>
                    {taikhoannganhang}
                  </select>
				 <!-- <input  type="text" id="stk" style="width:160px;margin-top:0.5em" name="stk" placeholder="số tài khoản" />-->
				   <input  type="text" id="sotienchuyen" style="width:160px;margin-top:0.5em" name="sotienchuyen" placeholder="số tiền"  onkeyup ="formatchuan(this)" onchange="formatso(event)" onblur="txtFormat(this)"/>
				</div>				</td>
		  </tr>
  </table>
</fieldset>
</div> 
 

<fieldset style="height:378px;width:270px;margin:0">
	<legend> <a style="cursor:pointer" onClick=" anhienform('obj') ">
	<label style="Color:#5BB6E6;Font-Weight:Bold;Font-size:12pt;cursor:pointer" onclick="goikhach()">Thông tin khách hàng </label>
	</a></legend>
	
	
	
	 <div style="margin-bottom:10px;padding-top:0px">
		<div onclick="timkhachhang()">
		<div style="padding-top:2px"><strong>Tên KH</strong>:<span id="tenkh" class="tieudesp">Khách  mua lẻ</span>  
		  <div style="padding-top:5px;height:21px;overflow:hidden" ><strong>Địa chỉ</strong>:<span id="dckh" class="tieudesp">Khách mua lẻ</span></div>
		</div>
		<input type="hidden" name="idkh"  id="idkh"    value="1" />		
		<input type="hidden" name="idban"  id="idban"    value="{idban}" />		
		</div> 
	 </div>
	 
	 <div style="padding-bottom:2px">Lý Do &nbsp; &nbsp;  
       <select name="lydo" id="lydo"  style="width:185px"  onchange="kiemtrach(this.value)" >
  			  {lydo} 
       </select>
       </div>
	    <div style="padding-bottom:1px; display:none" id="cuahangdiv">
	  Cửa hàng <select class="js-ch"  onkeypress="return chuyentiep(event,'search')" name="cuahang"  id="cuahang" style="width:190px">
                   <option value="0" >Chọn cửa hàng</option>
                      {cuahang}
 		  		   </select>
      </div>
	   <span style="display:"><b id="nhanqua" style="display: none ;color:red; "> Nhận quà
      <input type="hidden" id="chonnhanqua" name="chonnhanqua"    style="cursor:pointer;display:none ;"   value="1" />
       Điểm   <input type="text" id="diem" name="diem" disabled="disabled" size="6"    value="" /></b></span>
	<div style="margin-bottom:5px; "></div>
	 <div style="padding-bottom:2px">Ghi chú: <span id="tt"></span>  </div>
		<textarea id="note" name="note" class="texta" style='width:242px;height:30px;overflow:auto'></textarea>
	<div style="font-size:16px">
	<div style="padding-top:4px"> &nbsp;Mã giảm giá:   
	  <input type="text"  name="makm" id="makm"   style="font-size:16px;background: url(../images/nenbh.jpg);width:120px;color:#FF0000" onblur="kiemtrama(this.value)" ondblclick="this.value=''" maxlength="19"  onkeypress="return chuyentiep(event,'luu')"   value=""     />
	 </div>	
	<div class="tinhtien"> &nbsp;Tổng Tiền: <strong><span id="tongtien" style="font-size:20px;color:#FF0000"></span></strong> </div>	
	<div class="tinhtien"> &nbsp;
	Khách đưa:  <input type="text"   style="font-size:20px;background: url(../images/nenbh.jpg);width:120px;color:#FF0000" ondblclick="this.value=''" name="khachdua" id="khachdua" maxlength="12"  onkeypress="return chuyentiep(event,'luu')"   value=""    onkeyup ="txtFormat(this);tinhtien(this.value);"    onblur="txtFormat(this)"/>
	</div>	
         <div class="tinhtien" align="right" style="padding-right:4px">Voucher: <input type="text"   style="font-size:20px;background: url(../images/nenbh.jpg);width:120px;color:#FF0000" ondblclick="this.value=''" name="bot" id="bot" maxlength="12"  onkeypress="return chuyentiep(event,'luu')"   value=""    onkeyup ="txtFormat(this);tinhtienbot(this.value);"      onblur="txtFormat(this);kiemtradongthoi(this.value);"/> </div>

	<div class="tinhtien"> &nbsp;Trả lại: <strong><span id="tralai" style="color:#FF0000;font-size:20px"></span></strong> </div>	
	 </div>
</fieldset>	
	</div> </td>



<td style="padding-left:5px" valign="top">  <!-- chọn hàng hóa -->
	<div style=" height:450px;width:800px; margin-top:5px;">
 	<fieldset style="padding-top:5px">
	<legend> <a style="cursor:pointer" onClick="anhienform('chon')">
	<label style="Color:#5BB6E6;Font-Weight:Bold;Font-size:12pt">Chọn Hàng Hóa Bán Hàng </label>
	</a> </legend>
	
<div id="chon" >
  

<input onkeypress="return chuyentiep(event,'khachdua')"   placeholder="Mã SP" autocomplete="off" type="text" name="codeprotk"  id="codeprotk"   onkeyup="goisp(this.value)"  class="text" size="9" value=""  ondblclick="this.value=''"/>   
     <input onkeypress="return chuyentiep(event,'codeprotk')"  ondblclick="this.value=''"  placeholder=" Tên SP " type="text" name="NameTK"  id="NameTK" class="text" size="9" value="" />
      <input onkeypress="return chuyentiep(event,'codeprotk')"  ondblclick="this.value=''" placeholder="Mô tả" type="text" name="mota"  id="mota" class="text" size="9" value="" />
    <input   type="hidden" name="code"  id="code" class="text" size="10" value=""  />

  
<select onkeypress="return chuyentiep(event,'search')" name="IDGrouptk"  id="IDGrouptk" style="width:150px">
  <option value="0" >Nhóm sản phẩm</option>
 	{cay}
 </select>
&nbsp;
<input type="button"  style="width:45px"   onclick="timsanpham(NameTK.value,codeprotk.value,code.value,IDGrouptk.value,'',kho.value,mota.value)"   name="search"  id="search" value="Tìm" /> &nbsp; 
<input type="hidden" name="soluongcon"  value="" />
	   
	   <input type="button" name="cl" style="width:38px" onclick="clearchon()" value="clear" />
	  &nbsp;  <input type="button" name="cl2" style="width:48px" onclick="setkhuyenmai()" value="KM 234" /> 
	  <input type="button" name="cl22" style="width:80px;display:none"  onclick="setmua2tang1()" value="Mua 2 tặng 1" />
	  &nbsp; <input type="button" name="cl223" style="width:62px" title="mua 2 giảm 70% sản phẩm thứ 3" onclick="setmua2giam70()" value="2 giảm 70" />
	   &nbsp;
	    <input type="button" name="cl2232" style="width:53px" onclick="setmua3tang1()"  title="mua 3 tặng 1 sản phẩm giá thấp nhất trong 4 sản phẩm" value="3 tặng 1" />
		
	  <input type="button" name="cl222" style="width:80px;display:none" onclick="phuchoibandau()" value="Phục hồi" />&nbsp;
	
      <input type="button" name="cl23" style="width:42px" onclick="set12k()" value="12K" />
</div> 
	   

 <div style="height:16px"  id="cho" ></div>
	 

	   <div id="sanpham" style="padding-top:4px">	  </div> 
 </fieldset>
 
 
 <div style="padding-bottom:5px">  
   <fieldset style="display:">
	<legend> 
	<label style="Color:#5BB6E6;Font-Weight:Bold;Font-size:12pt">Hàng Hóa Khách Mua</label>
	</legend>	

 
	<div >Tên SP:  
	  <input type="text" name="tensp" id="tensp" class="inpl"  style="width:290px" readonly=""  value="" />
	  &nbsp;&nbsp;Mã SP:  	<input type="text" name="masp"  id="masp"class="inpl"  style="width:100px" readonly=""   value="" /> Mô tả <input type="text" name="mt"  id="mt" class="inpl"  style="width:100px" readonly=""   value="" />
 	 <input type="hidden" name="idsp"  id="idsp"    value="" />
	 <input type="hidden" name="sl"  id="sl"    value="" />
	 <input type="hidden" name="giachan"  id="giachan"    value="0" />
	 <input type="hidden" name="giagiam" readonly="" id="giagiam"    value="0" />
	 <input type="hidden" name="giamgop" readonly="" id="giamgop"    value="0" />
   </div>  
 		 Giá  
 		 <input type="text" name="dongia" id="dongia"  maxlength="12" class="text" style="width:75px;" value="0" {giahienthi} onkeydow=" onlyinta(this)"  onkeyup ="return chuyentiep(event,'soluong')"   onkeypress ="txtFormata(this)" onblur="txtFormat(this)"/> 
	  <select name="loaitien" id="loaitien"  onkeyup ="return chuyentiep(event,'soluong')" style="display:none">
        <option value="VND">VND</option>
        <option value="USD">USD</option>		
      </select>
	  SL 
	<input type="text" name="soluong" id="soluong"  onkeyup ="return chuyentieps(event,'chietkhau')"  class="text" style="width:35px" value="1" />
	giá 2<input type="text" name="dongia2" id="dongia2"  maxlength="12" class="text" style="width:70px;" value=""  onkeydow=" onlyinta(this)"  onkeyup ="return chuyentiep(event,'soluong')"   onkeypress ="txtFormata(this)" onblur="txtFormat(this)"/>
	<b ondblclick="setchietkhauchung(chietkhau.value)">Chiết khấu</b>
	<input  name="chietkhau" ondblclick="this.value=0" id="chietkhau"  value="" type="text" style="width:33px"   />
 	 <select   onkeyup ="return chuyentiep(event,'ghichu')" name="chietkhauc"  id="chietkhauc" style="width:58px" onchange="setchietkhau(this.value)">
	   <option value="0" >--</option> 	
	    <option value="2" >2%</option>
 	    <option value="3" >3%</option>
 	    <option value="4" >4%</option>
       <option value="5" >5%</option>
	   <option value="6" >6%</option> 
	   <option value="7" >7%</option> 
	   <option value="8" >8%</option> 
	   <option value="9" >9%</option> 
	   <option value="10" >10%</option> 
	   <option value="15" >15%</option> 	   
	   <option value="16" >16%</option> 	
	   <option value="17" >17%</option> 	
	   <option value="18" >18%</option> 	
	   <option value="19" >19%</option> 	
	    	
	   <option value="20" >20%</option>
	   <option value="21" >21%</option> 	
	   <option value="22" >22%</option> 	
	   <option value="23" >23%</option> 	
	   <option value="24" >24%</option> 	 	   	   
	   <option value="25" >25%</option>
	   <option value="26" >26%</option>
	   <option value="27" >27%</option>
	   <option value="28" >28%</option>
	   <option value="29" >29%</option> 
	   <option value="30" >30%</option> 
	   <option value="35" >35%</option> 
	   <option value="40" >40%</option> 
      </select>
	 &nbsp;
	
	  Ghi chú:  
	  <input type="text" name="ghichu"  id="ghichu"   onkeyup ="return chuyentiep(event,'add')"     style="width:200px"  value="" />
     <input type="button" name="add"  id="add" style="width:50px" onclick="addpro(idsp.value,tensp.value,masp.value,dongia.value,loaitien.value,soluong.value,chietkhau.value,ghichu.value,giachan.value,mt.value,giagiam.value,giamgop.value)" value="ADD"   onkeyup ="return chuyentiep(event,'NameTK')"  /> 
 </fieldset>
  </div>
<div style=" max-height:350px;overflow:scroll">

 <div id="sanphamxuat" > 
   <table width="100%" border="0" cellpadding="0" cellspacing="0">
     <tr bgcolor="#F8E4CB">
       <td width="29"  align="center" class="cothienthi" height="23"><b>STT</b></td>
       <td width="115" align="center" class="cothienthi"><strong>Mã Hàng Hóa </strong></td>
       <td width="310" align="center" class="cothienthi"><strong>Tên Hàng Hóa</strong></td>
       <td width="48"  align="center" class="cothienthi"><strong>SL</strong></td>
       <td width="152" align="center" class="cothienthi"><strong>Đơn Giá </strong></td>
       <td width="51"  align="center" class="cothienthi"><strong>CK</strong></td>
       <td width="164" align="center" class="cothienthi"><strong>Thành Tiền </strong></td>
       <td width="250" align="center" class="cothienthi"><strong>Ghi Chú </strong></td>
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
         <td  class="cothienthi" >&nbsp;</td>
         <td  class="cothienthi" >&nbsp;</td>
       </tr>
   </table>
 </div> 
</div>
    </div></td>
</tr></table> 

<div style="padding-top:24px;font-size:16px;padding-bottom:10px" > 
	  <input class="chucnang" type="button" name="luu" id="luu" style="width:70px;display:{q_luu}"  onclick="return  luuphieuxuat()" value="Lưu" {}  />
      <input class="chucnang" type="button" name="themmoi"  id="themmoi" style="width:75px;display:{q_them}"  onclick="window.open('default.php?act=cuahangbanhangonline','_self')" value="Thêm Mới" />
      <input class="chucnang" type="button" name="copy" id="copy"  onclick="copyp()"  disabled="disabled" value="Copy" style="display:none;width:70px" />
      <input type="chucnang" name="khoa" id="khoa" disabled="disabled" style="width:80px;display:{q_khoa}"  onclick="khoaphieu()" value="Khóa Phiếu" />
	  <input type="button" class="chucnang" name="inan"  id="inan" style=" width:100px;display:{q_in}" disabled="disabled"  onclick="goiin()" value="In Phiếu" />
	  <input type="button" class="chucnang" name="huyphieu" id="huyphieu" disabled="disabled" style="width:80px;display:{q_huy}"  onclick="goihuyphieu(idgoi.value,'nk')" value="Hủy Phiếu" />
	  <input type="button" class="chucnang" name="timxuat" id="timxuat" style="width:105px;display:{q_tim}"  onclick="timphieu()" value="Tìm Phiếu " />
	  <input type="button" class="chucnang" name="timxuat32" id="timxuat32"  style="display:none;width:80px"  onclick="huongdan()" value="Hướng Dẫn" />
	  <input type="button" class="chucnang" name="timxuat3" id="timxuat3" style="width:80px"  onclick="matdinh()" value="Đóng lại" /> <!-- BEGIN: block_admin1 -->
      <input type="button" class="chucnang" name="phuchoi" id="phuchoi"   style="width:80px"  onclick="goiphuchoi(idgoi.value,note.value)" value="Phục hồi" />
     
      <input type="button" class="chucnang" disabled="disabled"  name="xoaphieu" id="xoaphieu"  style=" width:90px;display:none"  onclick="xoaphieux(sochungtu.value)" value="Xóa phiếu" /><!-- END: block_admin1 -->
      &nbsp; 
	<select   name="chonnhac"  id="chonnhac" style="width:95px" onchange="doinhac(this.value)">
        <option value="0" >TB mặc định</option>
        <option value="1" >1</option>
        <option value="2" >2</option>
        <option value="3" >3</option>
        <option value="4" >4</option>
        <option value="5" >5</option>
        <option value="6" >6</option>
        <option value="7" >7</option>
        <option value="8" >8</option>
        <option value="9" >9</option>
      </select>
</div>

 
  <div id="ketqualuu" style="width:800"></div>
  <div id="luutimsp" style="display:none"></div>
  <div id= "luubd"  style="display:none"></div>
  <div id= "tenform"  style="display:none">xuatkho</div>
<!-- =================================KT 33333====================================== -->
 <div style="clear:left;display:none" id="khonghienthi"></div>
 
</fieldset></div></div>  
 

<div id="hienthongbao"  style="display:none; overflow:hidden; position:absolute;   top: 90px;left:0;width:100%; " align="center" >
  <div  style=" width:950px; min-height:510px;border:1px #999 solid; background-color:#FFF; opacity: 0.98;font-size:15px; font-weight:bold; padding:5px; color:#F00;" >

<div align="right"><b style="color:#00F;cursor:pointer" onclick="goidong()">( X Đóng lại )</b></div>
 
 <div   id="timphieuxuat">
 <fieldset >
	<legend align="center"><label style="Color:#5BB6E6;Font-Weight:Bold;Font-size:14pt;cursor:pointer" onclick="anhien2f('ankhachhang','khachangchitiet')" >Tìm phiếu xuất </label>
	 </legend>
 

   <div style="padding-bottom:5px"><br />

<select name="khoaphieut" id="khoaphieut" style="width:89px"    onkeypress="return chuyentiep(event,'sophieut')" >
  
 <option value="0">Chưa khóa</option>
  <option value="1">Đã Khóa</option>
  <option value="">Tất Cả</option>
</select>
<select name="nc" id="nc" style="width:110px"    onkeypress="return chuyentiep(event,'sophieut')" >
   <option value="0">Tìm chính xác số phiếu</option>
   <option value="1">Tìm từ trái qua phải</option>
   <option value="2">Tìm phải qua trái</option>
   <option value="3">Tìm ngẫu nhiên</option>
</select>

       
  <input type="text" name="sophieut" id="sophieut"  placeholder="Số phiếu"  class="inpl"  style="width:100px" onkeypress="return chuyentiep(event,'tungay')"   value="" />
 &nbsp; 	 
   <input type="text" name="sotien" id="sotien"  placeholder="Số tiền"  class="inpl"  style="width:65px" onkeypress="return chuyentiep(event,'tungay')"   value="" />
   Từ ngày
  <input onkeypress="return chuyentiep(event,'denngay')" type="text" name="tungay"   id="tungay" class="text" style="width:68px"  value="{tungay}" />
  <img src="images/img.gif" id="Lichtungaytao" style="cursor: pointer; border: 0px solid red;" title="Date selector"  onclick="displayCalendar(frmxuat.tungay,'dd/mm/yyyy',this)" />&nbsp;đến ngày
  <input onkeypress="return chuyentiep(event,'timk')" type="text" name="denngay"  id="denngay" class="text" style="width:68px" value="{denngay}" />
  <img src="images/img.gif" id="Lichtungaytao" style="cursor: pointer; border: 0px solid red;" title="Date selector"  onclick="displayCalendar(frmxuat.denngay,'dd/mm/yyyy',this)" />&nbsp; 
       
   <input type="button"   onclick="timdsphieuxuat(0,sophieut.value,'',tungay.value,denngay.value,khoaphieut.value,0,sotien.value,nc.value)"   style="width:60px"   name="timk"  id="timk" value="Tìm kiếm" />
      
     <input type="button" name="timxuat2" id="timxuat2" style="width:68px"  onclick="timphieu()" value="Quay Lại" />
      </div>
   <div id="httimxuat" style="color:#000000" >
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


<div id="timkhachhanght">
Mã KH 
  <input type="text" name="ma" ondblclick="this.value=''" id="ma" onkeyup="goikh(this.value)"  class="inpl"  style="width:80px" onkeypress="return chuyentieps(event,'kv')"   value="" />

Tên
<input type="text" name="ten" id="ten" ondblclick="this.value=''" class="inpl"  style="width:80px" onkeypress="return chuyentiep(event,'diachitim')"   value="" />
Số ĐT
<input type="text" name="dt" ondblclick="this.value=''" id="dt" class="inpl"  style="width:80px" onkeypress="return chuyentieps(event,'cmnd')"   value="" />
CMND
<input type="text" name="mc" ondblclick="this.value=''" id="cm" class="inpl"  style="width:80px" onkeypress="return chuyentieps(event,'kv')"   value="" />
 
 
<select class="compo"  name="nhom" id="nhom"  onkeypress="return chuyentieps(event,'search2')"  style="width:100px;"  >
    <option value="" >Nhóm KH</option>
	<option value="0" >Nhóm mặc định</option>
  	  {nhomkh}
 </select>
                </span> <span style="padding-bottom:10px">
                <input type="button"   style="width:40px"  onclick="timkiemkh(ten.value,dt.value,ma.value,'',nhom.value,cm.value)"   name="search2"  id="search2" value="Tìm" />
             &nbsp;   <input type="button"   style="width:70px"  onclick="timkiemkh(ten.value,dt.value,ma.value,'',nhom.value,cm.value,1)"   name="search2"  id="search2" value="Tìm Lưu" />
               
 <div id="hienthikh" style="padding-top:5px;color:#333">
 
 </div>
 </div>   
 </div>
</div> 
 
	
<div id="hiethithongbao"    style="display:none; overflow:hidden; position:absolute;   top: 90px;left:0;width:100%; " align="center" >
      <div   style=" width:850px; min-height:110px;border:1px #999 solid; background-color:#FFF; opacity: 1;font-size:15px; font-weight:bold; padding:5px; color:#F00;" >
       <div  >
     <fieldset >
        <legend align="center">   <b style="color:#FF0000;cursor:pointer;font-size:18px" onclick="goidongthe()">&nbsp; Thông tin mua hàng &nbsp;   ( X )</b> 	 </legend><br />
    
     <div  style="padding:2px" id="hienthihoso"> </div>
      </fieldset>    
     </div></div>
</div> 


 
 
<div id="hiengoick"    style="display:none; overflow:hidden; position:absolute;   top: 201px;left:-10px;width:100%; " align="center" >
  <div   style=" width:200px; min-height:110px;border:1px #999 solid; background-color:#FFF; opacity: 0.98;font-size:15px; font-weight:bold; padding:5px; color:#F00;" >
  	<div style="padding-bottom:5px"> Giảm giá mới</div><input type="text" id="ckmoi" name="ckmoi" value="{chietkhaugiam}"  onkeyup="formatchuan(this)" style="width:100px" /> <br /> <br /><input id="luutg" name="luutg" value="Lưu chiết khấu" onclick="luuck(ckmoi.value)" type="button" /> 
      
 
<input id="boqua" name="boqua" value="Bỏ qua" onclick="anhienform('hiengoick')"  type="button" /> 
  </div>
 </div>
</form>

<script src="js/jquery-1.7.2.min.js"></script>

<script src="js/select2.min.js"></script>

<link rel="stylesheet" media="screen" href="js/select2.min.css">
<script language="JavaScript">
var checkpt=false;
 function checkpttt(value){
 var leftbarfield=document.getElementById("left_bar_fieldset");
 var leftbar=document.getElementById("left_bar");
 var heightleftbar=leftbar.offsetHeight;
 var heightleftbarfield=leftbarfield.offsetHeight;
 
 	if(value=='CK'){
		document.getElementById("showaddstk").style.display="block";
		heightleftbar+=90;
		heightleftbarfield+=90;
		
		checkpt=true;
	}
	else{
		document.getElementById("showaddstk").style.display="none";
		if(checkpt){
		heightleftbar-=90;
		heightleftbarfield-=90;
		}
		document.getElementById("tknh").value='';
		document.getElementById("sotienchuyen").value='';
		
	}
 		leftbarfield.style.height=heightleftbarfield+"px";
		leftbar.style.height=heightleftbar+"px";
 }
 function formatso(e){
 var target=e.target;
 var value=target.value;
 
 	
	target.value=txtFormat3(value);
	
 }
 
/* function getphianchuyen(){
		var data={
		  "pick_province": "Đà nẵng",
		  "pick_district": "Quận cẩm lệ",
		  "province": "Đồng nai",
		  "district":"TP Biên hòa",
		  "address":"323 kp 4, phường thống nhất",
		  "weight":  1000,
		  "value": 300000,
		  "transport": "road"
		}
 }*/
 //document.getElementById('lydo').value = get_cookie('member_team') ;
 

var  ck = "{chietkhaugiam}" ;
	$(document).ready(function() {
	    $('.js-nvht').select2();
 	});
	$(document).ready(function() {
	    $('.js-nv').select2();
 	});	
	$(document).ready(function() {
	    $('.js-ch').select2();
 	});
	$(document).ready(function() {
	    $('.js-tknh').select2();
 	});
	
function donglai()
 {
	  document.getElementById('hiengoick').style.display = "none";
 }
function xuly3()
 {
	  var tam =  document.getElementById('ketqualuu').innerHTML ;  
      var  n=tam.split("##");
       if (n[1]=="1")   ck = formatso(n[2]) ; else alert('Lưu chiết khấu không thành công !');
 	  document.getElementById('hiengoick').style.display = "none";
	  
 }

 function setchietkhaugiam()
{
	document.getElementById('chietkhau').value = ck ;
	 document.getElementById('add').click() ;
	
}
 function luuck(d)
 {
 	   poststr="DATA="+   encodeURIComponent(d)+  "*@!"+ encodeURIComponent("0") ;
	    loadtrang('ketqualuu',"chietkhauluu", poststr,"xuly3") ;	
		 
 } 
 function goick()
 {
     document.getElementById('hiengoick').style.display = ""; 
	 document.getElementById('ckmoi').focus() ;
 }
 document.getElementById('sochungtu').focus() ;
 document.getElementById('luubd').innerHTML = document.getElementById('sanphamxuat').innerHTML ; 
 document.getElementById('luutimsp').innerHTML = document.getElementById('sanpham').innerHTML ;
 document.getElementById('timphieuxuat').style.display = 'none' ;
  document.getElementById('hienthongbao').style.display = 'none' ;
 document.getElementById('codeprotk').select() ;
 
 document.getElementById('timkhachhanght').style.display = '' ;	
 
 
 </script>
<script language="javascript" src="templates/cuahangbanhangonline.js" > </script>