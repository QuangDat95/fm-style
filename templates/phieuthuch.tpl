<style >
	.tbthu td { border-bottom:1px dashed #CCCCCC ;  }
</style>
<!-- BEGIN: block_thuchich -->
<div class="top_space"></div>
<div class="nenbao">
<div style="padding:1px">
<fieldset  class="nencon" style="padding:0px">
	<legend> <a style="cursor:pointer"  >
	<label style="Color:#FF3300;Font-Weight:Bold;Font-size:15pt;" >Quản lý Phiếu Thu Cửa Hàng</label></a></legend>
   <div    > 
 <br />
<form name="frmthuchich" method="post" style="float:left">

<div style="padding-bottom:10px;padding-left:15px ">   
 <div >	<b style="display:{q_them}"> [ <b style="cursor:pointer" onclick="setmoi()">Thêm Mới</b>]&nbsp;&nbsp;</b>[<a href="default.php?act=md">Đóng Lại</a>]&nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;           
  <input id="luachon" name="luachon" value="1" type="hidden"  /> 

 
 </div>
 
 </div>
 <fieldset  class="nencon" style="padding:1px">
	<legend>
	<label style="Color:#FF3300;Font-Weight:Bold;Font-size:9pt;" > Thông tin </label>
    </legend>
<table width="960px"   cellpadding="2" cellspacing="2" style="" class="tbthu">

<tr>
	<td width="95" >Ngày chứng từ </td><td width="160">
	 <input onkeyup="return chuyentiep(event,'sochungtu')" type="text" name="ngay"   id="ngay" class="text" style="width:68px"  value="{ngay}" />
	  <img src="images/img.gif" alt="" id="Lichtungaytao" style="cursor: pointer; border: 0px solid red;" title="Date selector"  onclick="displayCalendar(frmthuchich.ngay,'dd/mm/yyyy',this)" /><span style="color:#FF0000">*</span></td>
	  
      <td width="76" align="right">Số chứng từ</td> 
      <td colspan="3"><input type="text" name="sochungtu" id="sochungtu"  class="text"  size="14" value="{sochungtu}" onkeyup="return chuyentiep(event,'sotien')" onblur="kttrung(this.value)"/> 
        <span style="color:#FF0000">*</span> 
		
	 Nhóm thu 
	 <select onkeypress="return chuyentieps(event,'ngay')" name="loainhom"  id="loainhom" style="width:160px"  >
      <option value="" >Chọn nhóm</option>
	  	  	  
	  			{loainhom}
	  </select> 
	 Thu từ  
	 <select   name="cuahang"  id="cuahang" style="width:150px"  >
     {tatca}
  	  			{cuahang}
	  </select> </td>
</tr>
 
 

<tr>
	<td  >Lý do thu </td>
	<td   colspan="5"><input type="Text" id="lydo"  name="lydo" class="text" style="width:805px" value="{lydo}" onkeypress="return chuyentiep(event,'nguoinhan')"/>
	  <span style="color:#FF0000">*</span> </td>
</tr>
<tr>
	<td width="95"  >Loại tài khoản</td>
	<td   colspan="5"><select   name="loaitaikhoan"  id="loaitaikhoan" style="width:120px"  >
	  <option value="0" {loaitaikhoan0} >Tiền mặt</option>
	  <option value="1" {loaitaikhoan1}>Ngân hàng</option>
 	  </select> &nbsp; 	  Tài khoản ngân hàng	&nbsp; <select   name="nganhang"  id="nganhang" style="width:549px"  >
 	    <option value="" ></option>
 	    {nganhang}
 	    </select></td>
</tr>
<tr>
<td   >Số tiền</td><td  ><input type="Text" name="sotien" id="sotien"  class="text"  size="14" value="{sotien}"   onkeyup ="formatchuan(this)" onblur="txtFormat(this)"     onkeydow="return chuyentiep(event,'lydo')"/><span style="color:#FF0000">*</span>
            <input type="hidden" name="ID" id="ID"  class="text"  />
            <input type="hidden" name="ngayhn" id="ngayhn"  class="text"  value="{ngay}" />
			<input type="hidden" name="luachon" id="luachon"  class="text"  value="2" />
			
      </td>  
	<td  >Người chi </td>
	<td width="193" ><input type="Text" name="nguoichi" id="nguoichi"  class="text" size="16" value="{nguoichi}"  onkeypress="return chuyentieps(event,'taikhoan')"/>
	  <span style="color:#FF0000">*</span></td>
 
	<td width="143" colspan=""  align="right">Người nhận tiền</td>
	<td width="253"   >&nbsp;&nbsp; &nbsp;&nbsp;
	  <input type="Text" name="nguoinhan" id="nguoinhan"  class="text" size="19" value="{nguoinhan}" onkeypress="return chuyentiep(event,'nguoichi')"/>
	<span style="color:#FF0000">*</span></td>
</tr>
<tr>
	<td   >Nhận từ đơn vị </td>
	<td colspan="5" ><input type="Text" id="donvi"  name="donvi" class="text" style="width:606px" value="{donvi}" onkeypress="return chuyentiep(event,'note')"/>  </td>
</tr>
<tr>
	<td >Chi chú </td>
	<td colspan="4" valign="middle"><textarea id="note" name="note"   class="texta" style='width:606px;height:50px;z-index:19'>{note}</textarea>	 </td>
	<td colspan="1" align="center"><input type="button"  align="middle"  style="width:70px;height:40px;z-index:20"  onclick="goiluu()"   name="luu"  id="luu" value="Lưu" /> &nbsp;<input type="button"  align="middle"  style="width:70px;height:40px;z-index:20"  onclick="goiin()"   name="in"  id="in" value="IN Phiếu" /></td>
</tr>
</table>
</fieldset>

<div style="padding:5px">
<span style="padding-bottom:5px">Ngày
<input onkeypress="return chuyentiep(event,'denngay')" title="Click đôi để xoá trắng"  ondblclick="xoatrang(this)" type="text" name="tungay"   id="tungay" class="text" style="width:68px"  value="{tungay}" />
<img src="images/img.gif" id="Lichtungaytao2" style="cursor: pointer; border: 0px solid red;" title="Date selector"  onclick="displayCalendar(frmthuchich.tungay,'dd/mm/yyyy',this)" />&nbsp;đến 
<input onkeypress="return chuyentieps(event,'luachon')" type="text" name="denngay"  id="denngay" title="Click đôi để xoá trắng" ondblclick="xoatrang(this)" class="text" style="width:68px" value="{denngay}" />
<img src="images/img.gif" id="Lichtungaytao2" style="cursor: pointer; border: 0px solid red;" title="Date selector"  onclick="displayCalendar(frmthuchich.denngay,'dd/mm/yyyy',this)" /></span>
<input value="1" type="hidden"  name="luachon2"  id="luachon2"  style="width:147px"   >
   
<select onkeypress="return chuyentieps(event,'loaitk2')" name="nhomtk"  id="nhomtk"  style="width:180px" >
  <option value="" >Tất cả nhóm</option>
  
  
  			{loainhom} 		    


</select>

 
    <input type="hidden" name="taikhoan2"  id="taikhoan2"  >
     
    
    <select onkeypress="return chuyentieps(event,'loaitk2')" name="cuahangtk"  id="cuahangtk"  style="width:140px" >
 {tatca}
   			{cuahang} 		    
  </select>
     
    <select  name="tinhtrang"  id="tinhtrang"  style="width:80px" >
      <option value="" >Tất cả</option>
      <option value="1" >Đã khóa</option>
      <option value="0" >Chưa khóa</option>
      
    </select>
    Lý do
<input type="text" title="Click đôi để xoá trắng" name="lydo2" id="lydo2"  class="text" size="20" value=""  onkeypress="return chuyentiep(event,'loaitk')" ondblclick="xoatrang(this)"/>
   <input type="button"   style="width:50px"  onclick="timphieu(tungay.value,denngay.value,1,nhomtk.value,taikhoan2.value,lydo2.value,0,cuahangtk.value,tinhtrang.value)"  name="search2"  id="search2" value="Tìm" />
</div>
	  <div id="hienthitim" align="center">
 	    <table width="100%" border="0" cellpadding="0" cellspacing="0">		
				    <tr bgcolor="#F8E4CB">
				      <td align="center" class="cothienthi" height="23" width="32"><b>STT</b></td>
				      <td width="131" align="center" class="cothienthi" title="Ngày chứng từ"><strong>Ngày CT</strong></td>  
				      <td width="150" align="center" class="cothienthi"><strong><strong><strong>Số chứng từ</strong></strong></strong> </td> 	   
				      <td width="140" align="center" class="cothienthi"><strong><strong>Số tiền</strong></strong></td> 
				      <td width="489" align="center" class="cothienthi"><strong>Lý do</strong></td>
				      <td width="164" align="center" class="cothienthi"><strong><strong>Người lập phiếu</strong> </strong></td>	    	      
	      </tr>
				    <tr bgcolor="#FFFFFF">
				      <td class="cothienthi"    align="right">&nbsp;</td>				
				      <td class="cothienthi">&nbsp;</td>
				      <td class="cothienthi">&nbsp;</td>
				      <td class="cothienthi">&nbsp;</td>
				      <td class="cothienthi">&nbsp;</td>
				      <td class="cothienthi">&nbsp;</td>
	      </tr>
	    </table>
				  <div style="height:300px"></div>
	  </div>
	
</form>
  



  
</div></fieldset></div>
<div id="ketqualuu" style="display:"></div>
</div>

<!-- END: block_thuchich -->
<script language="javascript" src="templates/phieuthuch.js" > </script>
<script language="javascript"  >setmoi()</script>