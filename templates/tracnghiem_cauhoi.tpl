<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<br />



<div align="center" class="nenbao"  style="min-height:500px">

<fieldset   class="nencon" style="width: 99%;">

	<legend align="center" style="Color: rgba(250, 250, 250, 0.94);background: rgba(8, 115, 191, 0.88);padding: 3px 7px 4px 7px; border-radius: 5px;"> 
		<a style="cursor:pointer"  >

		<label style="color:#ffffff; "  class="fieldset_name" > Danh sách câu hỏi </label>

		</a>
	</legend>

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

	<div style="padding:6px"> 

		<span style="display: none;"><b style="display:{q_them}">[ <a href="default.php?act=tracnghiem_cauhoi&id=-1">Thêm Mới</a>]</b>
		[<a href="default.php?act=md">Đóng Lại</a>]</span>
		<input class="button_chucnang button_chucnangthemmoi" type="button" name="themmoi" id="themmoi" style=" display:{q_them}; " onclick="kiemtrathemmoi()" value="Thêm Mới">
		<br>
		<!-- <span style="font-style: italic; color: red; font-weight: bold">Lưu ý: Các nhóm mới, phải là con của 4 nhóm: Vải, Phụ liệu, Tài sản và Công cụ - Dụng cụ!</span> -->
	</div>



		<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000"  class="tbchuan">		

		<tr bgcolor="#F8E4CB">
			<td align="center" style='border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 0.4pt 0in 0.4pt' height="23" width="5%"><b>STT</b></td>
			<!-- <td width="25%" align="center"style='border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 0.4pt 0in 0.4pt'><strong>Mã </strong></td> -->
			<td width="35%" align="center"style='border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><strong>Câu hỏi </strong></td>
			<td width="20%" align="center"style='border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><strong>Đáp án </strong></td>
			<td width="5%" align="center"style='border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><strong>Đáp án đúng</strong></td>
			<td width="20%" align="center"style='border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><strong>Thông tin </strong></td>
			<td width="5%" align="center" style='border:solid windowtext 1.0pt;display:{q_capnhap}; mso-border-alt:solid windowtext .5pt;padding:0in 0.4pt 0in 0.4pt' ><strong>Cập nhật</strong></td>
			<td width="5%" align="center" style='border:solid windowtext 1.0pt;display:{q_xoa}; mso-border-alt:solid windowtext .5pt;padding:0in 0.4pt 0in 0.4pt'><strong>Xóa</strong></td>
		</tr>	

<!-- End: block_grpht1 -->	

<!-- BEGIN: block_caymenu -->
 		<tr  onmouseover="this.className='Highlight5'" onmouseout="this.className='Normal5'" bgcolor="{color}" title="{note}">
			<td align="center" style='width: 5%' height="23" width="31">{stt}</td> 
			<td align="left"style='width: 20%'><strong>&nbsp;{Name}</strong></td>
			<td align="left" style=''>{danhsachdapan}</td>
			<td align="center"style='' ><strong>{dapandung}</strong></td> 
			<td align="left"style='' >{thongtin}</td>
			<td  align='center' style='display:$q_cn'>
				<a href='default.php?act=tracnghiem_cauhoi&id={ID}'><img title='Cập nhập' src="images/edit.gif" border='0'></a>
			</td>
			<td style='display:$q_xoa' align='center'>
				<a href="default.php?act=tracnghiem_cauhoi&Del={ID}" onclick="return ask()"><img title="Xóa Mục"  src="images/delete.gif" border="0"></a>
			</td>
		</tr>

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

	<td colspan="2" align="center" style="color:#FF6600;padding-bottom:10px" >
		<!-- <h2>{t-c}</h2> -->
		<br>
		<!-- <span style="font-style: italic; color: red; font-weight: bold">Lưu ý: Các nhóm mới, phải là con của 4 nhóm: Vải, Phụ liệu, Tài sản và Công cụ - Dụng cụ!</span> -->
	</td>

</tr>

<tr style="display: none">

	<td width="14%">Nhóm Cha </td>

	<td width="86%">

	<select name="IDGroup" id="IDGroup" class="js-example-basic-single-1" onkeypress="return chuyentiep(event,'Rank')" > 

		<option value="0" >Nhóm ngành Gốc</option>
		{cay}
	</select>
	<script type="text/javascript">
		// In your Javascript (external .js resource or <script> tag)
		$(document).ready(function() {
		    $('.js-example-basic-single-1').select2();
		});
	</script>

	<input name="id" type="hidden" value="{idgoi}" />		 Vị Trí &nbsp;&nbsp;

         <input type="Text" onkeypress="return chuyentiep(event,'Name')"  name="Rank"  id="Rank" class="text" size="3" value="{Rank}" onkeyup="" />

		 &nbsp;

		 <select name="IDloai" id="IDloai"  onkeypress="return chuyentiep(event,'Name')" >

           <option value="0" >Chọn Nhóm hàng</option>

 				{loaihang}

          </select></td>

</tr>

<tr>

	<td>

		Nội dung Câu hỏi	</td>

	<td>

		<textarea type="Text" onkeypress="return chuyentiep(event,'ma')"  name="Name"  id="Name" class="text" style='width:550px; height:70px' >{Name}</textarea>

		<!-- &nbsp;* &nbsp;&nbsp;Mã&nbsp;

		<input  name="ma" type="text" class="text" id="ma" onblur="kttrung(this.value)" onkeypress="return chuyentiep(event,'note')" onkeyup="" value="{ma}" size="18" maxlength="20" /> 

		* </td> -->

</tr>

<tr>
	<td>
		Đáp án A:
	</td>
	<td>
		<input type="Text" onkeypress="return chuyentiep(event,'ma')"  name="dapana"  id="dapana" class="text" style='width:450px; ' value="{dapana}" /> 
		<label><input  name="dapandung" type="radio" class="text" id="dapandung"  onkeyup="" value="A" {dapandunga} /> Đáp án Đúng</label>
	</td> 
</tr>
<tr>
	<td>
		Đáp án B:
	</td>
	<td>
		<input type="Text" onkeypress="return chuyentiep(event,'ma')"  name="dapanb"  id="dapanb" class="text" style='width:450px; ' value="{dapanb}" /> 
		<label><input  name="dapandung" type="radio" class="text" id="dapandung"  onkeyup="" value="B" {dapandungb} /> Đáp án Đúng</label>
	</td> 
</tr>
<tr>
	<td>
		Đáp án C:
	</td>
	<td>
		<input type="Text" onkeypress="return chuyentiep(event,'ma')"  name="dapanc"  id="dapanc" class="text" style='width:450px; ' value="{dapanc}" /> 
		<label><input  name="dapandung" type="radio" class="text" id="dapandung"  onkeyup="" value="C" {dapandungc} /> Đáp án Đúng</label>
	</td> 
</tr>
<tr>
	<td>
		Đáp án D:
	</td>
	<td>
		<input type="Text" onkeypress="return chuyentiep(event,'ma')"  name="dapand"  id="dapand" class="text" style='width:450px; ' value="{dapand}" /> 
		<label><input  name="dapandung" type="radio" class="text" id="dapandung"  onkeyup="" value="D" {dapandungd} /> Đáp án Đúng</label>
	</td> 
</tr>
 

<tr>
	<td > 
 		Ghi Chú	
 	</td>
	<td colspan="2" ><textarea id="note" name="note" style='width:550px; height:50px'>{note}</textarea> 	</td>
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

 	if(document.getElementById('dapana').value == "")
	{
		alert('Bạn chưa nhập đáp án A!') ;
		document.getElementById('dapana').focus() ;
		return false;			
	}
	if(document.getElementById('dapanb').value == "")
	{
		alert('Bạn chưa nhập đáp án B!') ;
		document.getElementById('dapanb').focus() ;
		return false;			
	}
	if(document.getElementById('dapanc').value == "")
	{
		alert('Bạn chưa nhập đáp án C!') ;
		document.getElementById('dapanc').focus() ;
		return false;			
	}


 // 	if(document.getElementById('ma').value == "")

	// {

	// 	alert('Bạn chưa chọn nhập mã !!!') ;

	// 	document.getElementById('ma').focus() ;

	// 	return false;			

	// }

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

 <script>
function kiemtrathemmoi() {
	document.getElementById('nhacbaoloi').play();
    var txt;
    window.open('default.php?act=tracnghiem_cauhoi&id=-1','_self');
    // var r = confirm("Chọn OK - Nếu bạn muốn Thêm mới!\nChọn Cancel - Sẽ không mất dữ liệu hiện tại! \n ???");
    // if (r == true) {
    //     window.open('default.php?act=tp_kho&id=-1','_self');
    // } else {
        
    // }
    // document.getElementById("demo").innerHTML = txt;
}
</script>

</fieldset></div>