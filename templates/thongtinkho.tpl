<style> .wrapper{ 	width:100%; 	height:140vh; } .header { width:100%; }</style>
<div class="top_space"></div>
<div class="nenbao">
<fieldset  class="nencon">
	<legend> <a style="cursor:pointer"  >
	<label style="Color:#FF3300;Font-Weight:Bold;Font-size:9pt;" >Báo cáo hàng các cửa hàng</label> 
	</a></legend>
 
<form name="frmttk" method="post">
<div style="display:none" id="hthuongdan"> </div>
<div id="codechinh">
<!-- BEGIN: block_proht1 -->


<div style="padding-bottom:10px">
  <input type="checkbox" id='nangcao'  name='nangcao'  title="Tìm nâng cao từ trái sang phải" checked="checked" value="1"/>
  
<input onkeypress="return chuyentieps(event,'IDNV')"  placeholder="Mã SP" type="text" name="codeprotk"  id="codeprotk" ondblclick="this.value=''" size="5" value="{codeprotk}" /> 
 
<input onkeypress="return chuyentieps(event,'IDNV')" type="text"   placeholder="mô tả SP" name="mota"  id="mota" ondblclick="this.value=''" size="5" value="{mota}" />
<input onkeypress="return chuyentiep(event,'codeprotk')" type="text"   placeholder="Tên SP" name="NameTK"  id="NameTK" ondblclick="this.value=''" size="7" value="{NameTK}" />
<input onkeypress="return chuyentiep(event,'codeprotk')" type="text"   placeholder="Ghi chú" name="ghichu"  id="ghichu" ondblclick="this.value=''" size="8" value="{ghichu}" />
&nbsp;  
<input onkeypress="return chuyentiep(event,'IDGrouptk')" type="text"  placeholder="IDNV"  name="IDNV"  id="IDNV"  style="width:45px" value="{IDNV}" ondblclick="this.value=''"/>&nbsp;
<input onkeypress="return chuyentiep(event,'IDGrouptk')" type="text"  placeholder="Mã NV"  name="manv"  id="manv"  style="width:55px" value="{manv}" ondblclick="this.value=''"/>
<input onkeypress="return chuyentiep(event,'IDGrouptk')" type="text"  placeholder="CK%"  name="CK"  id="CK"  style="width:35px" value="{CK}" ondblclick="this.value=''"/>
<select onkeypress="return chuyentieps(event,'kho')" name="IDGrouptk"  id="IDGrouptk" style="width:119px"  class="js-nhom">
  <option value="" >Nhóm SP</option>
  
			{cay}
			
</select>
&nbsp;
<select onkeypress="return chuyentieps(event,'kho')" name="nganh"  id="nganh" style="width:60px" >
  <option value="" >Ngành hàng</option>
 			{nganhhang}
			

</select>
 
<select onkeypress="return chuyentiep(event,'search')" name="kho"  id="kho" style="width:135px" class="js-ch" >
  {tatca}
 	{kho}
	
 </select>
 
 <select onkeypress="return chuyentiep(event,'search')" name="luachon"  id="luachon" style="width:70px">
  <option value="" >Tất cả</option>
  <option value="1" >Có giảm giá</option>
  <option value="-8" >BC Taget</option>
  <option value="2" >không giảm giá</option>
  <option value="3" >Voucher</option>
  <option value="4" >Thành Viên</option>
  <option value="-5" >Khách lẻ</option>
  <option value="-6" >Thương mại điện tử</option>
  <option value="-4" >Bill đổi hàng </option>
  <option value="-3" >Bill trả lại</option>
  <option value="-9" >Phiếu online</option>
  <option value="-10" >Phiếu trả online</option>
  {lydo}
 </select>
Từ 
<input onkeypress="return chuyentiep(event,'denngay')" type="text" name="tungay"   id="tungay" class="text" style="width:65px"  value="{tungay}" />
<img src="images/img.gif" id="Lichtungaytao" style="cursor: pointer; border: 0px solid red;" title="Date selector"  onclick="displayCalendar(frmttk.tungay,'dd/mm/yyyy',this)" />&nbsp;đến
<input onkeypress="return chuyentiep(event,'htchitiet')" type="text" name="denngay"  id="denngay" class="text" style="width:65px" value="{denngay}" />
<img src="images/img.gif" id="Lichtungaytao" style="cursor: pointer; border: 0px solid red;" title="Date selector"  onclick="displayCalendar(frmttk.denngay,'dd/mm/yyyy',this)" />&nbsp;<br />
<div style="text-align:center; padding-top:5px">
<input type="button"    onclick="return submittk(NameTK.value,codeprotk.value,IDGrouptk.value,kho.value,tungay.value,denngay.value,IDNV.value,0,luachon.value,nangcao.checked,mota.value,'0',nganh.value,0,ghichu.value,manv.value,CK.value)"   name="search" style="width:118px" id="search" value="Xem báo cáo" /> &nbsp;
<input type="button"    onclick="return submittk(NameTK.value,codeprotk.value,IDGrouptk.value,kho.value,tungay.value,denngay.value,IDNV.value,0,luachon.value,nangcao.checked,mota.value,'1',nganh.value,0,ghichu.value,manv.value,CK.value)"  title="Khi gộp số tiền có thể không chính xác do cùng 1 sản phẩm có thể giá bán khác nhau !" name="search2" style="width:140px" id="search2" value="Báo Cáo Gộp theo mã" />
 
 &nbsp;
 <input type="button"    onclick="return submittk(NameTK.value,codeprotk.value,IDGrouptk.value,kho.value,tungay.value,denngay.value,IDNV.value,0,luachon.value,nangcao.checked,mota.value,'3',nganh.value,0,ghichu.value,manv.value,CK.value)"   name="search32" style="width:126px" id="search32" value="BC Gộp đơn Chi Tiết" />  &nbsp;
 <input type="button"    onclick="return submittk(NameTK.value,codeprotk.value,IDGrouptk.value,kho.value,tungay.value,denngay.value,IDNV.value,0,luachon.value,nangcao.checked,mota.value,'2',nganh.value,0,ghichu.value,manv.value,CK.value)"   name="search3" style="width:96px" id="search3" value="BC Chi Tiết" />  &nbsp;</div>
</div>
<div id="httim" >
  
</div>
<div   style="padding:10px">
  <input type="button" name="timnhap3" id="timnhap3" style="width:90px"  onclick="matdinh()" value="Đóng lại" />
  <span style="padding-bottom:10px">
  <input type="button" style="font-size: 12px; width: 40px;" id="xuat" value="Excel" name="xuat" onclick="xuatkq()" />
  </span></div>
</div>	
</form>

<form name="xuatketqua" id="xuatketqua" action="xuatfile.php" method="post" target="_blank" >
  <input name= "noidung" id="noidung" type="hidden" value="Chưa chọn dữ liệu">
  <input name= "tenfile" id="tenfile" type="hidden" value="baocaocuahang.xls">
  <input name= "loaifile" id="loaifile" type="hidden" value="application/vnd.ms-excel">
</form>



 
<script language="javascript">
document.getElementById('NameTK').focus();
</script>
<!-- End: block_proht1 -->
 

<script src="js/jquery-1.7.2.min.js"></script>
<script src="js/select2.min.js"></script>
<link rel="stylesheet" media="screen" href="js/select2.min.css">

<script language="javascript">
 
 	$(document).ready(function() {
	    $('.js-ch').select2();
		 $('.js-nhom').select2();
	 
	});
function xuatkq()
{
	 
	 document.getElementById("noidung").value = ' <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><html><body>'+ document.getElementById("httim").innerHTML+"</body></html>"; 
	 // alert( document.getElementById("ketqua").value);
	 document.getElementById("xuatketqua").submit();
}

function submittk(t1,t2,t3,t4,t5,t6,t7,tr,t9,t10,t11,t12,t13,t14,t15,t16,t17)
{
   poststr="DATA="+    encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(t3)+  "*@!"+ encodeURIComponent(t4) +  "*@!"+ encodeURIComponent(t5); 
  poststr= poststr+  "*@!"+ encodeURIComponent(t6)+  "*@!"+ encodeURIComponent(t7) + "*@!"+ encodeURIComponent(tr) + "*@!"+ encodeURIComponent(t9) +  "*@!"+ encodeURIComponent(t10)+  "*@!"+ encodeURIComponent(t11) +  "*@!"+ encodeURIComponent(t12)+  "*@!"+ encodeURIComponent(t13)+  "*@!"+ encodeURIComponent(t14)+  "*@!"+ encodeURIComponent(t15)+  "*@!"+ encodeURIComponent(t16) +  "*@!"+ encodeURIComponent(t17) ; 
  
  if(t12==2) loadtrang('httim', "thongtinkhochitiettim", poststr,"") ; 
  else if(t12==3) loadtrang('httim', "thongtinkhogopchitiettim", poststr,"") ; 
   else    loadtrang('httim', "thongtinkhotim", poststr,"") ;
}
 

function xemchitiet(id,tu,den,k)
{
 	var st ;
	st = "thontinkhochitiet.php?id=" + id + '&tu=' + tu + '&den=' + den + '&k=' + k;
	window.open(st,'popup','toolbar=no,status=no,scrollbars=yes,location=no,menubar=no,directories=no,width=840,titlebar=no') ;

}
loadhuongdan('thongtinkho');
</script>
 
</fieldset></div>
