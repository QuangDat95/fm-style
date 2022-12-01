 
<div class="top_space"></div>
<div class="nenbao">
<div style="padding:1px">  
<fieldset  class="nencon">
	<legend> <a style="cursor:pointer"  >
	<label style="Color:#FF3300;Font-Weight:Bold;Font-size:15pt;" >Tải dữ liệu từ Excel</label></a></legend><div    > 
 
<form name="frmcongnoncc" method="post" enctype="multipart/form-data"/>

<div style="padding-bottom:10px;padding-left:15px ">   
 <div >	 [<a href="default.php?act=md">Đóng Lại</a>]&nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;           
  <input id="luachon" name="luachon" value="2" type="hidden"  /> 

 
 </div>
 
 </div>
 <fieldset  class="nencon">
	<legend>
	<label style="Color:#FF3300;Font-Weight:Bold;Font-size:9pt;" ></label>
    </legend>
<table width="950px"   cellpadding="2" cellspacing="2" style="" class="tbthu">

 

<!--<tr>
	
	<td width="100"> Chọn file excel 1</td>
	<td>
           <input type="file"  accept=".xlsx"  name="file" id="file"> </td>  
    <td><input type="submit" name="Submit" value="Gởi lên"  /> &nbsp; &nbsp;  
<input type="submit" name="luulai1" value="Lưu lại" onclick="return kiemtra()" /></td>
</tr> -->
<tr>
	
	<td width="100"> Chọn file excel 2</td>
	<td>
           <input type="file"  accept=".xlsx"  name="file" id="file"> </td>  
    <td><input type="submit" name="Submit" value="Gởi lên"  /> &nbsp; &nbsp;  
<input type="submit" name="luulai" value="Lưu lại" onclick="return kiemtra()" /></td>
</tr>
 
	
</table>
 
 <div align="center">
  Từ dòng  <input type="number" name="dong" id="dong" value="{dong}" style="width:50px"> 
  tới dòng  <input type="number" name="toi" id="toi" value="{toi}" style="width:50px">
     
     
	</div>
<div style="color:#F00;font-size:34px" align="center">{daluu}</div>
<p></p>	
 <div style="width:990px;height:300px;overflow:scroll ">
 <table border="1" cellpadding="0" cellspacing="0" class="tbchuan" bgcolor="#FFFFFF" width="950px">
 	
           <tr height="60" style="background-color:#CCC">
            <!--<td height="60" width="35">Cột</td>-->
            <td>t1</td>
            <td>t2</td>
            <td>t3</td>
            <td>t4</td>
            <td>t5</td>
            <td>t6</td>
            <td>t7</td>
            <td>t8</td>
            <td>t9</td>
            <td>t10</td>
            <td>t11</td>
			<td>t12</td>
            <td>t13</td>
            <td>t14</td>
            <td>t15</td>
            <td>t16</td>
            <td>t17</td>
            <td>t18</td>
            <td>t19</td>
            <td>t20</td>
            <td>t21</td>
            <td>t22</td>
			<td>t23</td>
            </tr>
	
   
	<!-- BEGIN: block_fileht -->		
      <!--<tr style="color:{mau}"><td>{j}</td>--> 
        <td>{t1}&nbsp;</td> 
		 <td>{t2}&nbsp;</td> 
		  <td>{t3}&nbsp;</td> 
		   <td>{t4}&nbsp;</td> 
		    <td>{t5}&nbsp;</td> 
			 <td>{t6}&nbsp;</td> 
			  <td>{t7}&nbsp;</td> 
			  <td>{t8}&nbsp;</td> 
			  <td>{t9}&nbsp;</td> 
			  <td>{t10}&nbsp;</td> 
			  <td>{t11}&nbsp;</td> 
			  <td>{t12}&nbsp;</td> 		 
		  <td>{t13}&nbsp;</td> 
		   <td>{t14}&nbsp;</td> 
		    <td>{t15}&nbsp;</td> 
			 <td>{t16}&nbsp;</td> 
			  <td>{t17}&nbsp;</td> 
			  <td>{t18}&nbsp;</td> 
			  <td>{t19}&nbsp;</td> 
			  <td>{t20}&nbsp;</td> 
			  <td>{t21}&nbsp;</td>
			  <td>{t22}&nbsp;</td> 
			  <td>{t23}&nbsp;</td>
			  
      </tr>
	  <!-- END: block_fileht -->	
  </table>
  </div>
 
 </fieldset>


	
</form>
  



  
</div></fieldset></div>
<div id="ketqualuu" style="display:"></div>
</div>
  
 
<script language="javascript" type="text/javascript" >
function kiemtra()
{
	if (document.getElementById('loaitaikhoan').value==0 )
	{ 	
	 
		 
	}
	//var ob = document.getElementById('nhacungcap') ;
	// var ten =ob.options[ob.selectedIndex].text ;
	// var n = confirm("Bạn có muốn xóa hết dữ liệu cũ của " + ten + " để lấy dữ liệu mới không ?");
    //  if (n == false) return ;
}
 </script>
