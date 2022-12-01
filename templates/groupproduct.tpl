<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<br />

<div class="nenbao">
<fieldset  class="nencon">
	<legend> <a style="cursor:pointer"  >
	<label style="Color:#FF3300;Font-Weight:Bold;Font-size:9pt;" > Nhóm  hàng hóa </label>
	</a></legend>
<script language="Javascript1.2"><!-- // load htmlarea
_editor_url = "htmlarea1/";                     // URL to htmlarea files
var win_ie_ver = parseFloat(navigator.appVersion.split("MSIE")[1]);
if (navigator.userAgent.indexOf('Mac')        >= 0) { win_ie_ver = 0; }
if (navigator.userAgent.indexOf('Windows CE') >= 0) { win_ie_ver = 0; }
if (navigator.userAgent.indexOf('Opera')      >= 0) { win_ie_ver = 0; }
if (win_ie_ver >= 5.0) {
  document.write('<scr' + 'ipt src="' +_editor_url+ 'editor.js"');
  document.write(' language="Javascript1.2"></scr' + 'ipt>');  
} 
else 
{ document.write('<scr'+'ipt>function editor_generate() { return false; }</scr'+'ipt>'); }
// --></script>

<!-- BEGIN: block_grpht1 -->
<form name="frmProduct1" method="post">
<div style="padding:5px"> 
				<b style="display:{q_them}">[ <a href="default.php?act=groupproduct&id=-1">Thêm Mới</a>]</b>
[<a href="default.php?act=md">Đóng Lại</a>]</div>

	<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">		
		<tr bgcolor="#F8E4CB">
			<td align="center" style='border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 0.4pt 0in 0.4pt' height="23" width="31"><b>STT</b></td>
 <td width="66" align="center"style='border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 0.4pt 0in 0.4pt'><strong>Mã </strong></td>
      <td width="1027" align="center"style='border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><strong>Tên nhóm ngành </strong></td>	  
      	  	  
      <td width="39" align="center" style='border:solid windowtext 1.0pt;display:{q_capnhap}; mso-border-alt:solid windowtext .5pt;padding:0in 0.4pt 0in 0.4pt' ><strong>C&#7853;p nh&#7853;p</strong></td>
      <td width="37" align="center" style='border:solid windowtext 1.0pt;display:{q_xoa}; mso-border-alt:solid windowtext .5pt;padding:0in 0.4pt 0in 0.4pt'><strong>X&#243;a</strong></td>
		</tr>	
<!-- End: block_grpht1 -->	
<!-- BEGIN: block_caymenu -->
 
	{caymenuedit}
 
<!-- END: block_caymenu -->
 		
<!-- BEGIN: block_grpht2 -->
	</table>
	<input type="hidden" name="currentPage"/>
</form>
<script language="JavaScript">
function ask()
{
	var n = confirm("Bạn có muốn xóa không");
	if(n == false)
	{
		return false;
			
	}
}
</script>

<!-- End: block_grpht2 -->


<!-- BEGIN: block_grp -->
<form name="frmProduct2" method="post">
<input name="loai" id="loai" type="hidden" value="{loai}" />
<table width="100%" border="0">
<tr>
	<td colspan="2" align="center" style="color:#FF6600;padding-bottom:10px" ><h2>{t-c}</h2></td>
</tr>
<tr>
	<td width="14%">Nhóm Cha </td>
	<td width="86%">
	<select name="IDGroup" id="IDGroup"  onkeypress="return chuyentiep(event,'Rank')" > 
	<option value="0" >Nhóm ngành Gốc</option>
 
	{cay}
	</select>
	<input name="id" type="hidden" value="{idgoi}" />		 Vị Trí &nbsp;&nbsp;
         <input type="Text" onkeypress="return chuyentiep(event,'Name')"  name="Rank"  id="Rank" class="text" size="3" value="{Rank}" onkeyup="" />
		 &nbsp;
		 <select name="IDnhom" id="IDnhom"  onkeypress="return chuyentiep(event,'Name')" >
           <option value="0" >Chủng loại</option>
 				{nhomhang}
          </select>
		 <select name="NameN" id="NameN"  onkeypress="return chuyentiep(event,'Name')" >
		     <option value="0" >Chọn Giới Tính</option>
  			 <option value="1" {NameN1}>Nam</option>
             <option value="2" {NameN2}>Nữ</option>
             <option value="3" {NameN3}>Trẻ Em</option>
             <option value="4" {NameN4}>Cặp</option>
             <option value="5" {NameN5}>Unisex</option>
            
             
 		   </select></td>
</tr>
<tr>
	<td>
		Tên Nhóm	</td>
	<td>
		<input type="Text" onkeypress="return chuyentiep(event,'ma')"  name="Name"  id="Name" class="text" size="70" value="{Name}">
		&nbsp;* &nbsp;&nbsp;Mã&nbsp;
		<input  name="ma" type="text" class="text" id="ma" onblur="kttrung(this.value)" onkeypress="return chuyentiep(event,'note')" onkeyup="" value="{ma}" size="6" maxlength="6" /> 
		* </td>
</tr>
 
<tr>
	<td  > 
 		Ghi Chú	</td>
 
 
 
	<td colspan="2" ><textarea id="note" name="note" style='width:550px; height:100px'>{note}</textarea> 	</td>
</tr>
 






 
<tr>
	<td colspan="2">
		<input type="Submit" class="text" onfocus="setrong()" onclick="return kiemtra()" name="btnUpdate" id="btnUpdate" value="Cập nhập"> <input type="submit" class="text" name="cancel" value="Quay Lại" />	</td>
</tr>
</table>	
</form>

<!-- END: block_grp -->

<script language="javascript">
capnhap = '' ;
function kiemtra()
{
 //  if (capnhap != '') { return false ;}
 	if(document.getElementById('Name').value == "")
	{
		alert('Bạn chưa nhập tên !!!') ;
		document.getElementById('Name').focus() ;
		return false;			
	}

 	if(document.getElementById('ma').value == "")
	{
		alert('Bạn chưa chọn nhập mã !!!') ;
		document.getElementById('ma').focus() ;
		return false;			
	}
	return true;
}
function kttrung(kt){
   
     kiemtratrung(document.getElementById('loai').value,'tbgroupproducttk','ma',kt,'Trùng mã nhóm Phụ tùng !!!','Có lỗi trên đường truyền !!!',"ma");
      
  }

</script>

<!-- BEGIN: block_khongxoa -->
<script language="JavaScript">
alert('Bạn không thể xóa nhóm phụ tùng này do đã có phụ tùng sử dụng nhóm này rồi !!! ');
 </script>
<!-- END: block_khongxoa -->


<!-- BEGIN: block_grpupdate -->
<script language="JavaScript">
alert('Cập nhập nhóm thành công');
</script>
<!-- END: block_grpupdate -->
<!-- BEGIN: block_canhbao -->
<script language="JavaScript">
alert('Bạn phải xóa các nhóm con trước khi xóa nhóm này !!!');
</script>
<!-- END: block_canhbao -->
</fieldset></div>