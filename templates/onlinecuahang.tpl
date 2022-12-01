 
<div class="top_space"></div>
<div class="nenbao" style="min-height:700px">
<fieldset  class="nencon">
	<legend> <a style="cursor:pointer"  >
	<label style="Color:#FF3300;Font-Weight:Bold;Font-size:9pt;" >Các Phiếu online</label></a></legend>
 

 <form name="frmonline1" method="post" action="default.php?act=online" enctype="multipart/form-data">
<div style="padding-bottom:10px; ">&nbsp;<span style="padding-bottom:10px">
<input placeholder="Mã Sp" onkeypress="return chuyentiep(event,'IDGrouptk')"   type="text" name="masp"  ondblclick="this.value=''" id="masp" class="text" value=""  style="width:70px" />
<input placeholder=" Mã VĐ"  style="width:90px"  ondblclick="this.value=''" onkeypress="return chuyentiep(event,'codeprotk')" type="text" name="mavd"  id="mavd" class="text"   value=""  />
<input  placeholder="khách hàng"    style="width:80px" onkeypress="return chuyentiep(event,'IDGrouptk')" type="text" name="ten"  ondblclick="this.value=''" id="ten" class="text"   value="" />
<input placeholder="Điện thoại"  onkeypress="return chuyentiep(event,'IDGrouptk')" type="text" name="tel"  ondblclick="this.value=''" id="tel" class="text"   style="width:80px" value=""   />
<input  type="hidden" name="tinhtrang"  id="tinhtrang" class="text"   value="0"  />
<input    type="hidden" name="tinhtranghang"  id="tinhtranghang" class="text"   value="0"  />
<select onkeypress="return chuyentiep(event,'search')" name="nguoitao"   class="js-nguoitao"  id="nguoitao" style="width:210px;">
  <option value="0" >Nhân viên online</option>
  
 	{nguoitao}
     
</select>
Từ
<input onkeypress="return chuyentiep(event,'denngay')" type="text" ondblclick="this.value=''"  name="tungay"   id="tungay" class="text" style="width:65px"  value="{tungay}" />
<img src="images/img.gif" id="Lichtungaytao" style="cursor: pointer; border: 0px solid red;" title="Date selector"  onclick="displayCalendar(frmttk.tungay,'dd/mm/yyyy',this)" />&nbsp;đến
<input onkeypress="return chuyentiep(event,'htchitiet')" type="text" ondblclick="this.value=''"  name="denngay"  id="denngay" class="text" style="width:65px" value="{denngay}" />
<img src="images/img.gif" id="Lichtungaytao" style="cursor: pointer; border: 0px solid red;" title="Date selector"  onclick="displayCalendar(frmttk.denngay,'dd/mm/yyyy',this)" />&nbsp;
<input type="button"    onclick="return submittk(masp.value,mavd.value,ten.value,tel.value,tinhtrang.value,tinhtranghang.value,tungay.value,denngay.value,nguoitao.value,0)"   name="search" style="width:38px" id="search" value="Xem" />
<input type="button" style="font-size: 12px; width: 40px;" id="xuat" value="Excel" name="xuat" onclick="xuatkq()" />
</span></div>


<div style="position:relative">
<div id="hienthongbao"  style="display:none; padding-top: 10px;  overflow: hidden; position: absolute; left: 168px; top: 38px;" align="center" >
  <div  style="width:600px; min-height:400px;border:1px #999 solid; background-color:#FFF; opacity: 0.98;font-size:15px; font-weight:bold; padding:5px; color:#000;" >

<div align="right"><b style="color:#00F;cursor:pointer" onclick="goidong()">( X Đóng lại )</b></div>
<div style="font-size:12px;font-weight:100">
 <table width="98%"><tr><td><strong>Hình Ảnh</strong></td><td><strong>Ghi Chú:</strong></td></tr>
 <tr><td width="360px"><img  id="hinhanh" style="border:1px solid #F60" src="images/sanpham/demo.jpg" width="350px"  /></td><td valign="top"><div id="thongtinspt"></div> </td></tr>
 </table>
</div>
</div>  </div>
<div id="htkq">

 	 
 
</div>
</div>
	<input type="hidden" name="currentPage"/>
</form>
<div style="height:10px"></div>
<script language="javascript">
document.getElementById('NameTK').focus();
</script>
 

 

 	<script type="text/javascript" src="templates/jquery.js"></script>
	<script type="text/javascript" src="templates/ajaxfileupload.js"></script>
     <script language="javascript" src="templates/onlinecuahang.js" > </script>
<script src="js/jquery-1.7.2.min.js"></script>
    <script src="js/select2.min.js"></script>
    <link rel="stylesheet" media="screen" href="js/select2.min.css">
    
 
<form name="xuatketqua" id="xuatketqua" action="xuatkhoinmavach.php" method="post" target="_blank" >
  <input name= "noidung" id="noidung" type="hidden" value="Chưa chọn dữ liệu">
  <input name= "tenfile" id="tenfile" type="hidden" value="inmavach.xls">
  <input name= "loaifile" id="loaifile" type="hidden" value="application/vnd.ms-excel">
</form>

 

</fieldset></div>
<div id="ketqualuu"  style="display:none"></div>
<div id="capnhapghichu"  class="thongbaott"   style="display:  ;overflow:hidden; position:fixed;    bottom: 10px;left:-10px;width:100%; " align="right" >
<div   style=" width:316px; border-radius: 6px 6px 6px 6px;  height:340px;border:1px #999 solid; background-color:#FFF; opacity: 1;font-size:15px; font-weight:bold; padding:3px; color:#F00;" >
        <div style="color:#F00"  align="left">Đơn: <span style="color:#00F" id="donhang"></span></div>
  <div style="padding:4px " >
        <textarea name="chitiet" id="chitiet" style="width:300px;height:26px;font-size:11px;overflow:hidden;line-height:11px;color:#00F"></textarea>
    </div>
     <input name="idspghi" id="idspghi" type="hidden"     value=""   />
       <div name="ghichu2" id="ghichu2" style="overflow:scroll;width:310px;height:210px;border:1px solid #333;font-size:12px;text-align:left;padding:2px ;color:#000;"  ></div>
    <div style="padding-top:5px"><input name="noidungchat" id="noidungchat" type="text"  onkeypress=" return anenter(event)"   style="width:310px;"  value=""   /></div>
 
         <p>
           <input name="luughichu" id="luughichu" type="button"  onclick="luuchat(idspghi.value,noidungchat.value)" class="thanhtoan" value="Gởi tin" />
         &nbsp; &nbsp; &nbsp; &nbsp;
         <input name="boqua" id="boqua" type="button"  onclick="dongchat('capnhapghichu');" class="thanhtoan" value="Ẩn Chat" />
         </p>
      </div>
      
 </div> 


<div id="hiennhapexcel"  style="display:none ; overflow:hidden; position:absolute;   top: 90px;left:0;width:100%; " align="center" >
<div id="khonghienthi" ></div>

	
 
<script language="javascript">
   $(document).ready(function() {
	    $('.js-nvdonggoi').select2();
		 $('.js-nvban').select2();
	 
	});
    
 {chaymasp}
  anhienform('capnhapghichu');
  var chay =0 ;
  var donggoi=0;
 function dongchat(id)
{     chay=0 ;
 	   anhienform('capnhapghichu');
	    document.getElementById('ghichu2').innerHTML  ='';
	    
 } 
 
 
 var timebh
 
  function  chatgoi(v)
  {
       clearTimeout(timebh);
       timebh=setTimeout( function validate4() { goilaict4(v) },1200);
	 
   }
 function  xulytn()
  {
	   
       document.getElementById('ghichu2').innerHTML=ketqua ;
   }
  
function goilaict4(v)
{ 	
	if(chay==0)return;
	  
	//  document.getElementById('ketquatv').innerHTML='';
  	  poststr="DATA="+ encodeURIComponent(document.getElementById('idspghi').value)+"*@!"+encodeURIComponent(0)+"*@!"+ encodeURIComponent(0) ;
	  loadtrang('khonghienthi', "onlinechatlaynoidung", poststr,"xulytn") ;
 		 chatgoi(1);  
 }  


 
 function htchatch(id)
{     chay=1 ;
   	  document.getElementById('idspghi').value=id;  
	  chatgoi(1);
 	  document.getElementById('donhang').innerHTML  = document.getElementById('dong_'+id).cells[3].innerHTML;
	  document.getElementById('chitiet').innerHTML= document.getElementById('dong_'+id).cells[6].innerHTML;
  	  //document.getElementById('monht').innerHTML=ten;
	//  document.getElementById('ghichu2').value= document.getElementById('ghichu_'+id).innerHTML   ;  
	   anhienform('capnhapghichu');
	    
	 
}

 

function anenter(event)
{
//	alert(event.keyCode )
	
	 if (event.keyCode == 13) { document.getElementById('luughichu').click();
	  event.keyCode = '' ;
	  event.returnValue = false 
	 }
}
function xuly3()
{
   document.getElementById('noidungchat').value='' ;
  document.getElementById('ghichu2').innerHTML=ketqua ;
   document.getElementById('ghichu2').scrollTop =910;
  
}
 function luuchat(idsp,ghichu){ 
  if(trim(ghichu)=='') return ;
  ///document.getElementById('ghichu_'+idsp).innerHTML=ghichu ;
     poststr="DATA="+ encodeURIComponent(idsp)+  "*@!"+ encodeURIComponent(ghichu)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0);
    loadtrang('ketqualuu',"onlinechluuchat", poststr,"xuly3") ;
  } 
  
function submittk(t1,t2,t3,t4,t5,t6,t7,t8,t9,t10)
{
 
  poststr="DATA="+    encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(t3)+  "*@!"+ encodeURIComponent(t4); 
  poststr= poststr +  "*@!"+ encodeURIComponent(t5)+  "*@!"+ encodeURIComponent(t6)+  "*@!"+ encodeURIComponent(t7) + "*@!"+ encodeURIComponent(t8) + "*@!"+ encodeURIComponent(t9)+ "*@!"+ encodeURIComponent(t10) ;
  loadtrang('htkq', "onlinecuahangtim", poststr,"") ;

} 
function xulynhandon()
{  // alert(ketqua);
	if  (ketqua=="###1###")
	{
		document.getElementById('dong_'+donggoi).cells[11].innerHTML="Đã nhận";
		alert('Bạn đã nhận được đơn này !');
 	}
	else if  (ketqua=="***1***")
	{ 
		document.getElementById('dong_'+donggoi).cells[11].innerHTML="Đã hủy nhận";
		  alert('Bạn đã hủy nhận đơn thành công !');
	}
	else if (ketqua=="###0###")
	{ alert('Đơn này đã có người nhận!');   }
	else if  (ketqua=="***0***")
	{  alert('Bạn không thể hủy nhận đơn này!'); }
}

function cuahangnhandon(t1,t2)
{
   donggoi=t1 ;
   poststr="DATA="+    encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0); 
   loadtrang('khonghienthi', "onlinecuahangnhandon", poststr,"xulynhandon") ;

} 

   </script>
    