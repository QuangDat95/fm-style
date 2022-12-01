<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- BEGIN: block_thuchich -->
<div class="top_space"></div>
<div class="nenbao">
<div style="padding:1px">
<fieldset  class="nencon">
	<legend> <a style="cursor:pointer"  >
	<label style="Color:#FF3300;Font-Weight:Bold;Font-size:15pt;" >Thu Chi Cửa Hàng Báo Cáo</label></a>
   </legend><div    > 
 

 <form name="frmthuchich" method="post">

   <div style="position:absolute; left: 1012px; top: 62px; width:200px" >[<a href="default.php?act=md">Đóng Lại</a>]&nbsp;<span style="padding-bottom:5px;padding-top:5px;">
     <input type="button" style="font-size: 12px; width: 50px;" id="xuat" value="Excel" name="xuat" onclick="xuatkq()" />
   </span><span style="padding-bottom:5px;padding-top:5px;">
   <input type="button" style="font-size: 12px; width: 30px;" id="inan" value="IN" name="inan" onclick="goiin()" />
   </span></div>
 

                
	    <div style="padding-bottom:5px;padding-top:5px;">
<span style="padding-bottom:5px">Ngày
<input onkeypress="return chuyentiep(event,'denngay')" title="Click đôi để xoá trắng"  ondblclick="xoatrang(this)" type="text" name="tungay"   id="tungay" class="text" style="width:65px"  value="{tungay}" />
<img src="images/img.gif" id="Lichtungaytao2" style="cursor: pointer; border: 0px solid red;" title="Date selector"  onclick="displayCalendar(frmthuchich.tungay,'dd/mm/yyyy',this)" />&nbsp;đến
<input onkeypress="return chuyentieps(event,'luachon')" type="text" name="denngay"  id="denngay" title="Click đôi để xoá trắng" ondblclick="xoatrang(this)" class="text" style="width:65px" value="{denngay}" />
<img src="images/img.gif" id="Lichtungaytao2" style="cursor: pointer; border: 0px solid red;" title="Date selector"  onclick="displayCalendar(frmthuchich.denngay,'dd/mm/yyyy',this)" /></span>
<select onkeypress="return chuyentieps(event,'nhomtk')" name="luachon2"  id="luachon2"  style="width:80px" >
   <option value="5" >Tổng hợp </option>
  <option value="1" >khoản thu</option>
  <option value="2" >khoản chi</option>
</select>
<select onkeypress="return chuyentieps(event,'loaitk2')" name="nhomtk"  id="nhomtk"  style="width:80px" >
  <option value="" >All nhóm</option>
  
  
  			{loainhom} 		    

  <option value="-1" >Chi cho nhà cung cấp</option>
</select>
<select  name="tinhtrang"  id="tinhtrang"  style="width:80px" >
    					<option value="1" >Đã khóa</option>
                        <option value="0" >Chưa khóa</option>
  						<option value="" >Tất cả</option>
  </select>
   <input name="taikhoan2"  id="taikhoan2"  style="width:70px" type="hidden" >
    
   Lý do
   <input type="text" title="Click đôi để xoá trắng" name="lydo2" id="lydo2"  class="text" size="8" value=""  onkeypress="return chuyentiep(event,'loaitk')" ondblclick="xoatrang(this)"/>
CT
<input type="text" title="Click đôi để xoá trắng" name="sochungtutim" id="sochungtutim"  class="text" size="7" value=""  onkeypress="return chuyentiep(event,'loaitk')" ondblclick="xoatrang(this)"/>
<select  name="cuahang"  id="cuahang"  style="width:180px" class="js-ch"  >
  
  {tatca}
   			{cuahang} 		    
  
</select>
<input type="button"   style="width:50px;height:26px"  onclick="timphieu(tungay.value,denngay.value,luachon2.value,nhomtk.value,cuahang.value,lydo2.value,0,tinhtrang.value,sochungtutim.value)"  name="search2"  id="search2" value="Tìm" />
<input type="button"   style="width:80px;height:26px"  onclick="timphieunhom(tungay.value,denngay.value,luachon2.value,nhomtk.value,cuahang.value,lydo2.value,0,tinhtrang.value)"  name="search"  id="search" value="Tìm nhóm" />
	    </div>
	  <div id="hienthitim"  align="center" >
				  
	    <table width="100%" border="0" cellpadding="0" cellspacing="0">		
				    <tr bgcolor="#F8E4CB">
				      <td align="center" class="cothienthi" height="23" width="32"><b>STT</b></td>
				      <td width="131" align="center" class="cothienthi" title="Ngày chứng từ"><strong>Ngày CT</strong></td>  
				      <td width="150" align="center" class="cothienthi"><strong>Số chứng từ</strong> </td> 	   
				      <td width="140" align="center" class="cothienthi"><strong>Số tiền</strong></td> 
				      <td width="489" align="center" class="cothienthi"><strong>Lý do</strong></td>
				      <td width="164" align="center" class="cothienthi"><strong>Người lập phiếu</strong></td>	    	      
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
  

<form name="xuatketqua" id="xuatketqua" action="xuatfile.php" method="post" target="_blank" >
  <input name= "noidung" id="noidung" type="hidden" value="Chưa chọn dữ liệu">
  <input name= "tenfile" id="tenfile" type="hidden" value="thuchichbaocao.xls">
  <input name= "loaifile" id="loaifile" type="hidden" value="application/vnd.ms-excel">
</form>


  
</div></fieldset></div>
<div id="ketqualuu" style="display:"></div>
</div>

<!-- END: block_thuchich -->
<script src="js/jquery-1.7.2.min.js"></script>
<script src="js/select2.min.js"></script>
<link rel="stylesheet" media="screen" href="js/select2.min.css">
   <script language="javascript">
   	$(document).ready(function() {
	    $('.js-ch').select2();
	 
	});
function xuatkq()
{
	 
	 document.getElementById("noidung").value = ' <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><html><body>'+ document.getElementById("hienthitim").innerHTML+"</body></html>"; 
	 // alert( document.getElementById("ketqua").value);
	 document.getElementById("xuatketqua").submit();
}
var mangsp = new Array() ;
var mangsp1 = new Array() ;
var mangtam = new Array() ;

var x ,h0,h1,h2,h3,h4,h5;
 
 function sapxep(t0)
{   
    poststr="SX="+   t0 ;
    loadtrang('hienthitim', "thuchichbaocaotim", poststr,"") ;
}
function xuatexcel()
{
	var st ;
	st = "thuchichexcel.php?h0=" + h0 + '&h1=' + h1+ '&h2=' + h2+ '&h3=' + h3+ '&h4=' + h4+ '&h5=' + encodeURIComponent(h5) ;
 	window.open(st,'popup','toolbar=no,status=no,scrollbars=yes,location=no,menubar=no,directories=no,width=1000,height=600,titlebar=no') ;

}
function xuatexcelquy()
{
	var st ;
	st = "thuchichexcelquy.php?h0=" + h0 + '&h1=' + h1+ '&h2=' + h2+ '&h3=' + h3+ '&h4=' + h4+ '&h5=' + encodeURIComponent(h5) ;
 	window.open(st,'popup','toolbar=no,status=no,scrollbars=yes,location=no,menubar=no,directories=no,width=1000,height=600,titlebar=no') ;

}
function goiin()
{ 		
	var st ;
	st = "thuchichin.php?t0=" + h0 + '&h1=' + h1+ '&h2=' + h2+ '&h3=' + h3+ '&h4=' + h4+ '&h5=' + encodeURIComponent(h5) ;
	window.open(st,'popup','toolbar=no,status=no,scrollbars=yes,location=no,menubar=no,directories=no,width=1000,height=600,titlebar=no') ;
}

function xuly1()
{
		document.getElementById('search2').click() ;
}
function xuly2()
{
//	alert(ketqua);
	  	document.getElementById('search2').click() ;
}
 
function xoatc(tc)
{  //tungay,denngay,luachon,nhomtk,taikhoan2,lydo2,tr
 var cf = " Bạn có chắc chắn muốn xóa phiếu này hay không ? " ;
 if(thongbao(cf) == false) { return }	 
    poststr="DATAD="+   encodeURIComponent(tc)+  "*@!"+encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0);
    loadtrang('ketqualuu',"thuchichluu",poststr,"xuly1") ;		
}

function timphieu(t0,t1,t2,t3,t4,t5,t6,t7,t8)
{  //tungay,denngay,luachon,nhomtk,cuahang,lydo2,tr
    h0=t0; h1 = t1 ; h2 = t2 ; h3 = t3 ; h4 = t4 ; h5 = t5 ;    
	 
    poststr="DATA="+   encodeURIComponent(t0)+  "*@!"+encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(t3);
	poststr= poststr + "*@!"+encodeURIComponent(t4)+"*@!"+encodeURIComponent(t5)+"*@!"+encodeURIComponent(t6)+"*@!"+encodeURIComponent(t7)+"*@!"+ encodeURIComponent(t8);
    loadtrang('hienthitim',"thuchiktbaocaotim", poststr,"") ;		
}
   
   
function huythuchi(t0)
{ 
	 poststr="DATA="+   encodeURIComponent(t0)+  "*@!"+encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0);
     loadtrang('hienthitim',"thuchichbaocaohuy", poststr,"") ;	
}

function goikhoach(id)
{   
 
   if(thongbao("Bạn có muốn khóa phiếu này không") == true)
   {
  
    poststr="DATA="+   encodeURIComponent(id)+  "*@!"+encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0) ;
	
      loadtrang('hienthitim',"thuchichkhoa", poststr,"xuly2") ;
	 
   }
   		
}
  function timphieunhom(t0,t1,t2,t3,t4,t5,t6,t7)
{  //tungay,denngay,luachon,nhomtk,cuahang,lydo2,tr
    h0=t0; h1 = t1 ; h2 = t2 ; h3 = t3 ; h4 = t4 ; h5 = t5 ;    
	 
    poststr="DATA="+   encodeURIComponent(t0)+  "*@!"+encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(t3);
	poststr= poststr + "*@!"+encodeURIComponent(t4)+  "*@!" + encodeURIComponent(t5)+  "*@!"+ encodeURIComponent(t6)+  "*@!"+ encodeURIComponent(t7);
    loadtrang('hienthitim',"thuchichbaocaonhomtim", poststr,"") ;		
}

document.getElementById('search2').click() ;
 </script>
