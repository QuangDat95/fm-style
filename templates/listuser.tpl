<br />  <style > .tbchuan input { cursor:pointer;} </style>

<!--popup sưa du lieu -->
<style>
#poup_sua_du_lieu{
	  position: fixed;
    /* background-color: #ffffff; */
    width: 100%;
    height: 100vh;
    display: none;
	left:0;
	top:0;
    justify-content: center;
    align-items: center;
	z-index:1;
}
#poup_sua_du_lieu .select2-container{
	width:50% !important;
}	
#poup_sua_du_lieu .form{
	
	background-color: #ffffff;
    width: 39%;
    height: 300px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
	border:1px solid;
}
#poup_sua_du_lieu .form #closepop{
	    display: flex;
    justify-content: flex-end;
    width: 90%;
	
}
#poup_sua_du_lieu .form form{
    display: flex;
    width: 90%;
    height: 90%;
}
#poup_sua_du_lieu form >div{
    height: 100%;
    width: 100%;
    display: flex;
    justify-content: space-around;
    flex-direction: column;
}
#poup_sua_du_lieu .form label{
	width:30%;
}
#poup_sua_du_lieu input{
	cursor:pointer;
}
#poup_sua_du_lieu .btn-quyenchon span{
	    font-size: 16px;
    width: 20%;
	z-index:0;

}
#poup_sua_du_lieu .btn-quyenchon span:hover{
	color:#FF0000;
}
#quyenchon{
	display:flex;
	flex-wrap: wrap;
}  
#poup_sua_du_lieu .btn-quyenchon{
	background-color: cadetblue;
    color: #ffffff;
    border: none;
    padding: 0.5em;
    min-width: 80px;
	max-height:40px;
	margin-right:0.3em;
    display: flex;
    justify-content: space-between;
}
#poup_sua_du_lieu .form_quyen{
	display:flex;
}
#poup_sua_du_lieu .form_quyen >div{
	width:50%;
}
#poup_sua_du_lieu .form_quyen .form_{
	width:100%;
}
#poup_sua_du_lieu .form_quyen .form_ label{
	width:70%;
}
#poup_sua_du_lieu .form_quyen .form_ >div{
	width:100%;
	display:flex;
	    justify-content: space-between;
		padding:0.2em 0.5em;
}
</style>
<div id="poup_sua_du_lieu" style="">
<div class="form"><div id="closepop"><button  onclick="closepoup()">x</button></div>
<form name="" action="" method="post" onsubmit="GetCondition(event)">
<div>
	<div>Phân quyền theo chức năng cho nhiều người!</div>
	<!--<div>
	<div id="reskhonghienthi"></div>
		<label id="chuoigoc" style="width:100%;color:red"></label>
	</div>-->
	<div >
	
		<label for="quyenall">Chức năng:</label>
		<select  class="js-quyenall" id="quyen_a" disabled="disabled"> 
		
		<!-- BEGIN: block_PhanQuyen_comp -->
			<option value="{ID}">{Name}</option>
			<!-- END: block_PhanQuyen_comp -->
		</select>
		<input type="hidden" name="quyenall" id="quyenall"/>
		<input type="hidden" name="cond" id="cond"/>
	</div>
	<div class="form_quyen">
	<div  class="form_">
	
	<div>
		<label for="xem">Xem:</label>
		<input type="checkbox" name="xem" id="xem" value="1" class="check_phanquyen" title="Xem"/>
		
	</div>
	<div>
		<label for="tao">Tạo mới:</label>
		<input type="checkbox" name="tao" id="tao" value="2" class="check_phanquyen" title="Tạo"/>
		
	</div>
	
	<div>
		<label for="khoa">Khóa:</label>
		<input type="checkbox" name="khoa" id="khoa" value="3" class="check_phanquyen" title="Khóa"/>
		
	</div>
	<div>
		<label for="huy">Hủy:</label>
		<input type="checkbox" name="huy" id="huy" value="4" class="check_phanquyen" title="Hủy"/>
		
	</div>
	<div>
		<label for="xoa">Xóa:</label>
		<input type="checkbox" name="xoa" id="xoa" value="5" class="check_phanquyen" title="Xóa"/>
		
	</div>
	<div>
		<label for="tatcach">Tất cả cửa hàng:</label>
		<input type="checkbox" name="tatcach" id="tatcach" value="6" class="check_phanquyen" title="Tất cả cửa hàng"/>
		
	</div>
	</div>
	<div id="quyenchon" style="display:none">
		
	</div>
	</div>
	<div>
		
		<button type="submit" name="nhieuquyen" id="btn_sua_dulieu" onclick="">Lưu</button>
	</div>
</form>

</div>
</div>
</div>

 <div class="nenbao">
<fieldset  class="nencon">
	<legend> <a style="cursor:pointer"  >
	<label style="Color:#FF3300;Font-Weight:Bold;Font-size:9pt;" >  Quản Lý User  </label>
	</a></legend>
  
 


  <fieldset id="frmcapnhap" style="display:{hienthi}" >
  <!-- BEGIN: block_user -->
  <legend> 
	<label style="Color:#5BB6E6;Font-Weight:Bold;Font-size:14pt" onclick="anhienform('thongtinus')">Thông tin User </label>
  </legend>
  <form name="edituser" method="post" action="?act=listuser">
	<div  id="thongtinus" >
     <input name="id" type="hidden" value="{IDCall}" />
<table width="100%" border="0" class="timkiem">
        <tr >
          <td width="18%" > Tên Nhân Viên</td>
          <td width="35%"><input type="text"   style="width:250px;" name="Ten" id ="Ten" value="{user}"/></td>    
	      <td width="11%">Phòng</td>
	      <td width="36%"><select class="compo"  name="IDPhong" ID="IDPhong"  style="width:300px;"  >
              	{phong}
            </select></td>
		        <td width="0%"></td>
        </tr>
 
        <tr>
          <td >Tên Đăng Nhập </td>
          <td><input type="Text" onblur="kiemtrauser(this.value)"  name="UserName" id="UserName" style="width:250px;" value="{UserName}" /></td>
          <td height="29" >Mật khẩu </td>
          <td height="29"><input type="text"   name="Password" size="30" value="" /></td>
        </tr>
              <tr>
          <td >Mã Nhân Viên </td>
          <td><input type="text"   name="MaNV" id="MaNV" style="width:65px;" value="{MaNV}" />
          Tính Lương
          <select    name="tinhluong"  style="width:115px;"  >
            <option value="1" {tinhluong1}>Tính lương</option>
            <option value="0" {tinhluong0}>Không tính lương</option>
          </select></td>
          <td height="29" >Lương Cơ bản</td>
          <td height="29"><input type="text"   name="LuongCoBan" size="10" value="{LuongCoBan}"  onkeypress ="txtFormata(this)" onblur="txtFormat(this)"/></td>
        </tr>
     
         <tr>
          <td >Giới tính</td>
          <td><select    name="gioitinh"  style="width:55px;"  >
              <option value="1" {gioitinh1}>Nam</option>
              <option value="0" {gioitinh0}>Nữ</option>
            </select> Ngày Sinh
            <input type="text"    name="NgaySinh" id="NgaySinh" size="6" value="{NgaySinh}" />
            <img src="images/img.gif" alt="" id="Lichtungaytao2" style="cursor: pointer; border: 0px solid red;" title="Date selector"  onclick="displayCalendar(frmProduct1.NgaySinh,'dd/mm/yyyy',this)"
      onmouseover="this.style.background='red';" onmouseout="this.style.background=''" />
	  </td>
         <td   height="29">Nơi Sinh</td>
           <td height="29"><input type="Text"   name="DiaChi" style="width:150px;" value="{DiaChi}" /></td>
        </tr>
    
 
	    
		  
	      <tr>
           <td >Tình trạng hôn nhân</td>
          <td><select class="compo"  name="honnhan"  style="width:160px;" onchange="kiemtravung(this.value)" >
            <option value="0" {honnhan0}>Độc thân</option>
            <option value="1" {honnhan1}>Đã có gia đình</option>
            <option value="1" {honnhan2}>Đã từng có hôn nhân</option>
          </select></td>  
          <td   height="29">Dân tộc </td>
          <td height="29"><input type="text"   name="DanToc" id="DanToc" style="width:65px;" value="{DanToc}" /></td>
        </tr>
		
			  
         <tr>
          <td >Hộ khẩu thường trú</td>
          <td><input type="text"   name="hokhau"   id="hokhau" style="width:350px;" value="{hokhau}" /></td>
          <td   height="29">Quê quán</td>
          <td height="29"><input type="text"   name="quequan" style="width:350px;" value="{quequan}" /></td>
        </tr>
         
         
        
        <tr>
          <td >CMND / Ngày cấp / Nơi cấp </td>
          <td colspan="3"><input type="text"   name="cmnd"  id="cmnd" style="width:480px;" value="{cmnd}" />
            <strong>(ví dụ 205060708 - 01/01/2021 - C.A Đà Nẵng cấp) </strong></td>
        </tr>
		
	    
         
        
        <tr>
          <td >TK.NH</td>
          <td colspan="3"><input type="text"   name="nganhang" style="width:360px;" value="{nganhang}" /> 
         <b style="color:#F90" >Ghi cả tên ngân hàng người thụ hưởng (  ngân hàng viết trước )</b></td>
        </tr>	
           <tr>
          <td >Facabook</td>
          <td><input type="Text"   name="facebook" style="width:250px;" value="{facebook}" /></td>
          <td height="29" >Bằng cấp </td>
          <td height="29"><input type="text"   name="BangCap"  id="BangCap" style="width:350px;" value="{BangCap}" /></td>
        </tr>
     <tr>
          <td >Email</td>
          <td><input type="Text"   name="Email" style="width:250px;" value="{Email}" /></td>
          <td height="29" >Số Điện Thoại </td>
          <td height="29"><input type="Text"   name="SoDienThoai" size="30" value="{SoDienThoai}" /></td>
        </tr>
    <tr>
          <td >Số con </td>
          <td colspan="3"><input type="number"   name="socon" id="socon" style="width:50px;" value="{socon}" /></td>
        </tr>		
     <tr>
          <td >Ca làm việc</td>
          <td><select class="compo"  name="calamviec"  style="width:260px;"  >
            {calamviec}
          </select></td>
          <td height="29" >Hệ Số Lương</td>
          <td height="29"><input type="text"   name="hesoluong" style="width:30px;" value="{hesoluong}" />
Hệ Số Vùng
  <input type="text"   name="hesovung"  id="hesovung" style="width:30px;" value="{hesovung}" /></td>
        </tr>                
         <tr> <td height="29" >Ngày Vào làm</td>
          <td height="29"><input type="text"    name="NgayVaoLam" id="NgayVaoLam" size="9" value="{NgayVaoLam}" />
            <img src="images/img.gif" alt="" id="Lichtungaytao2" style="cursor: pointer; border: 0px solid red;" title="Date selector"  onclick="displayCalendar(frmProduct1.NgayVaoLam,'dd/mm/yyyy',this)"
      onmouseover="this.style.background='red';" onmouseout="this.style.background=''" /> </td>
          <td >Giờ làm theo ngày</td>
          <td><input type="text"   name="giolamtheongay" style="width:30px;" value="{giolamtheongay}" />
          Tháng nghỉ
          <input type="text"   name="thangnghi" style="width:30px;" value="{thangnghi}" />
          Ngày</td>
        </tr>
	 
        <tr>
          <td >Loại User </td>
          <td><select class="compo"  name="Loai"  style="width:160px;" onchange="kiemtravung(this.value)" >            
		        <option value="10" {loai10}>Nhân Viên Bán Hàng</option>
              	<option value="5" {loai5}>Nhân Viên Thu Ngân</option>
				<option value="4" {loai4}>Cửa Hàng Trưởng</option>
				<option value="3" {loai3}>Quản Lý Công Ty</option>
				<option value="2" {loai2}>Khách Hàng</option>
				<option value="6" {loai6}>Kế Toán</option>
				<option value="7" {loai7}>kiểm kho</option>
				<option value="8" {loai8}>Nhân Viên Kho</option>
				<option value="9" {loai9}>Nhân Viên Văn Phòng</option>
				<option value="11" {loai11}>Nhân Viên bảo vệ</option>
				<option value="12" {loai12}>Nhân Viên Thời Vụ</option>
				<option value="13" {loai13}>Nhân Viên Loại Khác</option>
                <option value="14" {loai14}>Nhân Viên nhân sự</option>
                <option value="15" {loai15}>Bộ phận mẫu</option>
                <option value="16" {loai16}>Quản lý vùng</option>
                <option value="17" {loai17}>Online</option>
          </select>          </td>
          <td   height="29">Chức Vụ</td>
          <td height="29"><select class="compo"  name="ChucVu" id="ChucVu"  style="width:200px;"  >
            <option value="0" {loai0}> Chọn chức vụ</option>
                	{chucvu}
           </select></td>
        </tr>
    
        <tr>
          <td style="display:none" >Loại đăng nhập </td>
          <td style="display:none" ><select    name="LoaiDN" ID="LoaiDN"  style="width:160px;" onchange="kiemtradn(this.value)"  >
            <option value="1" {LoaiDN1}>Đăng nhập Tự do</option>
            <option value="2" {LoaiDN2}>Đăng nhập nội bộ</option>
            <option value="3" {LoaiDN3}>Đăng nhập bên ngoài</option>
			<option value="4" {LoaiDN4}>Đăng nhập IP Cố Định</option>
           </select>
           <input type="text" style="display:{IPdangnhapht}" name="IPdangnhap" id="IPdangnhap" size="11" value="{IPdangnhap}" /></td>
          <td   height="29"  >&nbsp;</td>
          <td height="29"   >&nbsp;</td>
        </tr>	  
        <tr  >
       <td></td><td></td>
          <td   height="29"   >Của hàng</td>
          <td height="29"   ><div id="choncuahang"><select class="compo"  onchange="cuahang.value=this.value" name="cuahanght" id="cuahanght"  style="width:200px;"  >
               	{cuahang}
           </select></div>
           <div id="chonvung"><select class="compo" onchange="cuahang.value=this.value" name="vung" id="vung"  style="width:200px;"  >
               	{khuvuc}
           </select></div><input type="hidden"  name="cuahang" id="cuahang" value="{idcuahang}"  /> </td>
        </tr>  
          <tr  >
          <td >Ghi chú</td>
          <td colspan="3"><input type="text"   name="ghichu" id="ghichu" style="width:550px;" value="{ghichu}" /></td>
    
        </tr>	 			
  </table><br />
	<span style="padding:20px">
	<input type="submit" name="btnUpdate" value="Cập nhập" onclick="return kiemtraus()" class="text"/>
	</span>
    <span style="padding:20px">
    <input type="button" name="btnUpdate2" value="Ẩn hiện phân quyền" onclick="anhienform('phanquyentb')" class="text"/>
    </span><br /><br />
  <!-- END: block_user -->
  
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbchuan" id="phanquyentb" style="display:{hienthiphanquyen}" >		
     
	 	
		 		
		<tr bgcolor="#F8E4CB">
		  <td align="center"  height="23" width="7"><b>STT</b></td>
 
	  <td width="417" align="center" ><strong onclick="setfull()">Tên Quyền </strong> &nbsp; &nbsp; &nbsp; Set theo :<span style="display:none">
	    <select    name="LoaiDN2" id="LoaiDN2"  style="width:160px;" onchange="kiemtradn(this.value)"  >
	      <option value="1" {LoaiDN1}>Đăng nhập Tự do</option>
	      <option value="2" {LoaiDN2}>Đăng nhập nội bộ</option>
	      <option value="3" {LoaiDN3}>Đăng nhập bên ngoài</option>
	      <option value="4" {LoaiDN4}>Đăng nhập IP Cố Định</option>
	    </select>
	  </span>
	    <select    name="khachhang" id="khachhang" style="width:160px;" class="js-khachhang"  onchange="goisetquyen(this.value)"  >
	      <option value="0" > </option>
	     		 {nhanviencopy}
	      </select>
		  	<button type="submit" name="nhieuquyentheouser" onclick="setnhieuquyenus(event)">Thêm quyền nhiều</button>
		  </td>  
      <td width="115" align="center"  ><strong onclick="settatca(1,0)">Xem</strong></td>
      <td width="80" align="center" ><strong onclick="settatca(2,0)">Tạo mới</strong></td>
          <td width="80" align="center" ><strong onclick="settatca(3,0)">Khóa</strong></td>
              <td width="80" align="center" ><strong onclick="settatca(4,0)">Hủy</strong></td>
                  <td width="80" align="center" ><strong onclick="settatca(5,0)">Xóa</strong></td>   
                  <td width="80" align="center" ><strong onclick="settatca(6,0)">Tất cả cửa hàng</strong></td>
		</tr>	
 
<!-- BEGIN: block_PhanQuyen -->	
				<tr bgcolor="{color}"  onmouseover="this.className='{hl2}'" onmouseout="this.className='{hl}'">
				<td  align="left">{stt}</td>
 				<td  >
				<b onclick="settatca(0,{ID})">{icon} {Name}</b> </td>
                <td align="center"><input type="checkbox" name='q{ID}_1' id='q{ID}_1' value="1"  {cq_1} title="Xem" /></td>
                <td align="center"><input type="checkbox" name='q{ID}_2' id='q{ID}_2' value="2"  {cq_2} title="Tạo mới"/></td>
                <td align="center"><input type="checkbox" name='q{ID}_3' id='q{ID}_3' value="3"  {cq_3} title="Khóa" /></td>
                <td align="center"><input type="checkbox" name='q{ID}_4' id='q{ID}_4' value="4"  {cq_4} title="Hủy" /></td>
                <td align="center"><input type="checkbox" name='q{ID}_5' id='q{ID}_5' value="5"  {cq_5} title="Xóa" /></td>
				<td align="center"><input type="checkbox" name='q{ID}_6' id='q{ID}_6' value="6"  {cq_6} title="Tất cả cửa hàng" /></td>
 							
				</tr>
<!-- End: block_PhanQuyen -->	

 
	</table>
  	
</div> 
		 
           

  <div style="padding:10px" >
 	<input type="Submit" name="btnUpdate" value="Cập nhập" onclick="return kiemtraus()" class="text"/> 
    <input type="button" onclick="javascript:frmTMP.submit();" class="text" name="btnCancel" value="Làm lại" />
 </div>   		
 </form></fieldset>
 
 
<form name="edituser" id="form_condition" method="post"  action="?act=listuser" style="margin-bottom:0;margin-top:0"  v >
<div align="center">
  <h3><font color="#FF6600">Danh Sách User </font>  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a style="cursor:pointer" target="_blank" href="xuatexcel.php" >Xuất Excel</a>
  
  </h3>
  
</div>

<div  style="text-align: right;padding: 0.5em;width: 96%;">
<button type="button" onclick="showpoup()">Phân quyền nhiều</button></div>

[ <a href="default.php?act=listuser&id=-1">Thêm Mới</a> ]
 

<input  style="width:100px"   placeholder=" Tên " name="tentim" type="text" value="{tentim}" />
&nbsp;   <input name="usertim"  placeholder=" User "   type="text" value="{usertim}" style="width:90px"  />  
 
<input name="matim"  placeholder=" Mã NV "  type="text" style="width:70px" value="{matim}" />
 
<select name="timloai" id="timloai" class="style1" style="width:120px" >
  <option value= ""  >Tất cả thành viên</option>
    <option value="10" {loai10}>Nhân Viên Bán Hàng</option>
              	<option value="5" {loai5}>Nhân Viên Thu Ngân</option>
				<option value="4" {loai4}>Cửa Hàng Trưởng</option>
				<option value="3" {loai3}>Quản Lý Công Ty</option>
				<option value="2" {loai2}>Khách Hàng</option>
				<option value="6" {loai6}>Kế Toán</option>
				<option value="7" {loai7}>kiểm kho</option>
				<option value="8" {loai8}>Nhân Viên Kho</option>
				<option value="9" {loai9}>Nhân Viên Văn Phòng</option>
				<option value="11" {loai11}>Nhân Viên bảo vệ</option>
				<option value="12" {loai12}>Nhân Viên Thời Vụ</option>
				<option value="13" {loai13}>Nhân Viên Loại Khác</option>
                <option value="14" {loai14}>Nhân Viên nhân sự</option>
                <option value="15" {loai15}>Bộ phận mẫu</option>
                <option value="16" {loai16}>Quản lý vùng</option>
                <option value="17" {loai17}>Online</option>
        </select>


<select class="compo"  name="tinhluongtk" id="tinhluongtk"  style="width:100px;"  >
  <option value="" >Tất cả </option>
   <option value="1" {tinhluongtk1} >Tính lương</option>
    <option value="0"  {tinhluongtk0}>Không tính lương</option>
 
</select>

<select class="compo"  name="chucvut" id="chucvut"  style="width:100px;"  >
  <option value="" >Chức Vụ</option>
  {chucvu}
 </select>
<select class="compo"  name="quyenso" id="quyenso"  style="width:60px;"  >
  <option value="0" >Xem</option>

  <option value="1" >Xem</option>
  <option value="2" >Tạo mới</option>
  <option value="3" >Khóa</option>
  <option value="4" >Hủy</option>
  <option value="5" >Xóa</option>
  <option value="6" >Tất cả</option>
  
</select>
<select   name="cuahangtk" id="cuahangtk"  style="width:120px;"  class="js-khachhang"  >
  <option value="" >Tất cả cửa hàng</option>
                 	{cuahangtk}
 </select>

<select   name="quyentk" id="quyentk"  style="width:120px;"  class="js-chucnang" onchange="getchucnang(this.value)" >
  <option value="" >Chức năng</option>
   {quyentk}
</select>

 <input name="sm" type="submit" value="Tìm" />
</form>

 
  <table width="100%" bgcolor="#ffffff" cellpadding="0" border="0" cellspacing="0"   class="tbchuan"  >
    <tr bgcolor="#6BAAF5">
      <td align="center"  height="23" width="44"><b>STT</b></td>
      <td align="center"  height="23" width="196"><b>Tên user </b></td>
      <td width="202" align="center"><strong>Tên đăng nhập </strong></td>
      <td width="285" align="center"><strong>Của Hàng</strong></td>	  
      <td width="293" align="center"><strong>Ca làm việc</strong></td>	  	   
      <td width="93" align="center"><strong>Mã NV</strong></td>	
      <td width="93" align="center"><strong>Hệ Số</strong></td>	    	  
      <td width="53" align="center"><strong>Vị trí</strong></td>
	  <td width="92" align="center"><strong>C&#7853;p nh&#7853;p</strong></td>
      <td width="47" align="center"><strong>X&#243;a</strong></td>
    </tr>
 
 <!-- BEGIN: block_us -->
  	<tr bgcolor="{color}"  onmouseover="this.className='{hl2}'" onmouseout="this.className='{hl}'" > 
		<td  align="left">&nbsp;{stt}</td>
		<td valign="middle"   >{Ten} </td>
		<td >{UserName}</td>				
		<td >{cuahang}</td>
		<td >{Email}</td>								
		<td align="left">{MaNV}  </td>
	    <td align="left"> {hesoluong}  </td> 
	    <td align="center">{vitri}</td>
        <td align="center"><a href = "default.php?act=listuser&id={ID}"> <img src = "images/book_addressHS.png" border = "0" ></a></td>
		<td><b onclick="htcapnhapghichu('{ID}','{Ten} - {MaNV}')"  ><img src="images/delete.gif" border = "0"></b></td>								
	 </tr>  
  <!-- END: block_us -->
  
  </table> 
   
 </fieldset></div>





<div id="capnhapghichu"  class="thongbaott"   style="display:none  ;overflow:hidden; position:fixed;    top: 30px;left:200px;width:100%; " align="center" >
      <div   style=" width:550px; border-radius: 6px 6px 6px 6px;  height:299px;border:1px #999 solid; background-color:#FFF; opacity: 1;font-size:15px; font-weight:bold; padding:3px; color:#F00;" >
        <h2 style="color:#F00">Nhân viên nghỉ </h2>
        <h3 style="color:#00F" id="tennv"></h3>
         <p align="left"><input name="IDDEL" id="IDDEL" type="hidden"     value=""   />
          Lý do nghỉ <br />
<input name="lydo" id="lydo" type="text"     value="" style="width:540px;height:30px;font-size:18px" /></p>
       <p align="left">
   Đánh giá
     <textarea id="danhgia" name="danhgia" class="texta" style='width:540px;height:70px'>{danhgia}</textarea>
        </p>
         <p>
           <input name="luughichu" id="luughichu" type="button"  onclick="capnhapghichumoi(IDDEL.value,lydo.value,danhgia.value)" class="thanhtoan" value="Lưu thông tin" />
         &nbsp; &nbsp; &nbsp; &nbsp;
         <input name="boqua" id="boqua" type="button"  onclick="anhienform('capnhapghichu');" class="thanhtoan" value="Bỏ Qua" />
         </p>
      </div>
      
 </div> 
 <!-- BEGIN: block_themquyenfail -->
 	<script>
		{thogbao}
		window.location='default.php?act=listuser';
	</script>
 
 <!-- END: block_themquyenfail -->
 
  <!-- BEGIN: block_themquyensuccess -->
 	<script>
		{thogbao}
		window.location='default.php?act=listuser';
	</script>
 
 <!-- END: block_themquyensuccess -->
 
 
 
<div id="khonghienthi" style="display:none"></div>
<script src="js/jquery-1.7.2.min.js"></script>
<script src="js/select2.min.js"></script>
<link rel="stylesheet" media="screen" href="js/select2.min.css">
<script>
var tokenSeparators=[];
$(document).ready(function() {
	    $('.js-quyenall').select2();
			$('.js-quyenall').on('select2:selecting', function(e) {
		
			
			var val=e.params.args.data.id;
			var text=e.params.args.data.text;
				var btnq=createButtonq(val,text);
				$("#quyenchon").append(btnq);
			if(!tokenSeparators.includes(val)){
				tokenSeparators.push(val);
			}
			
			getquyenall();
		});
	 
	});
	
	function getquyenall(){
		var chuoi=tokenSeparators.join();
		
		$("#quyenall").val(chuoi);
	}
	
	function createButtonq(val,text){
		
		var span=document.createElement("span");
		span.innerHTML="x";
		var butonq=document.createElement("button");
		butonq.value=val;
		butonq.setAttribute("type","button");
		butonq.setAttribute("class","btn-quyenchon");
		butonq.innerHTML=text;
		butonq.append(span);	
		butonq.setAttribute("onclick",'deletequyenchon(event)');
		return butonq;
	}
	function showpoup(){
		
		$("#poup_sua_du_lieu").css("display","flex");
	}
	
 	function closepoup(){
		$("#poup_sua_du_lieu").css("display","none");
	}
	function GetCondition(e){
		
		var check=true;
		var formData=getFormObj('form_condition');
		/*if(!formData.chuvut){
			alert("Chức vụ chưa chọn!");
			check=false;
			e.preventDefault();
			return;
		}*/
		
		if(!formData.cuahangtk){
			if(xacnhan("Cửa hàng chưa chọn!\nBạn muốn tiếp tục?")){
			
			}
			else{
				check=false;
			
				e.preventDefault();
				return;
			}
			
		}
		if(!formData.quyentk){
			alert("Chức năng chưa chọn!");
			check=false;
			e.preventDefault();
			return;
		}
		if(!formData.timloai){
			alert("Loại chưa chọn!");
			check=false;
			e.preventDefault();
			return;
		}
		if(!check){
			e.preventDefault();
			return;
		}
		else{
			var chucnang=$('#quyentk option:selected').text();
			var thongbao=" Chức năng: "+chucnang+"\n";
			 thongbao+='Thêm các quyền '+getquyendachon();
			 thongbao+='Cho user thuộc '+getcond(formData);
			if(xacnhan(thongbao)){
				$("#cond").val(JSON.stringify(formData));
			}	
			else{
				e.preventDefault();
			}
			
		}
	
		return;
	}
	
	function setnhieuquyenus(e){
		var kh= document.getElementById("khachhang").options[document.getElementById("khachhang").selectedIndex].text;
		var loai= document.getElementsByName("Loai")[0].options[document.getElementsByName("Loai")[0].selectedIndex].text;
		if(!kh){
			alert('Chưa chọn nhân viên mẫu!');
				e.preventDefault();
				return;
		}
		//.options[document.getElementsByName("Loai")[0].selectedIndex].text;
		
		if(!xacnhan('Coppy tất cả quyên của '+kh+" cho tất cả nhân viên thuộc "+loai)){
			e.preventDefault();
		}
		
		
	}
	
	function getcond(obj){
		//delete object.quyenso;
		var chuoiquyen='';
		var keys=Object.keys(obj);
		var values=Object.values(obj);
		for(var i=0;i<values.length;i++){
			var el=values[i];
			if(el!=''){
				var key=keys[i];
				if( key!='quyentk' && key!='quyenso'){
					var vl=$('#'+key+' option:selected').text();
					chuoiquyen+=vl+"-";
				}
			}
		}
		return chuoiquyen;
	}
	function getquyendachon(){
		var chuoiquyen='';
		$(".check_phanquyen").each((index,item)=>{
			if(item.checked){
				var ten=item.getAttribute("title");
				
				chuoiquyen+=ten+'-';
			}
		});
		return chuoiquyen;
	
	}
	function getFormObj(formId) {
		var formObj = {};
		var inputs = $('#'+formId).serializeArray();
		$.each(inputs, function (i, input) {
			formObj[input.name] = input.value;
		});
		return formObj;
	}
	
	function xacnhan(str){
		return confirm(str);
	}
	
 
	function deletequyenchon(e){
		var target=e.target;
		var val=target.value;
		
			if(tokenSeparators.includes(val)){
				
				 const filteredItems = tokenSeparators.filter(item => item !== val)
				tokenSeparators=filteredItems;
				target.remove();
				getquyenall();
			}
	}
	
	function getchucnang(value){
		
		$("#quyen_a").select2().val(value).trigger("change");
	}
	
	//quyen_a
	//quyentk
</script>


<script language="JavaScript">
 
 	$(document).ready(function() {
	    $('.js-khachhang').select2();
	 
	});
		$(document).ready(function() {
	    $('.js-chucnang').select2();
	 
	});
 
function ask()
{
	var n = confirm("Bạn có muốn xóa không");
	if(n == false)
	{
		return false;
			
	}
}
function kiemtraus()
{
	if (trim(document.getElementById('Ten').value)=='' )
	{
		alert('Bạn Chưa Tên người dùng ') ;
		document.getElementById('Ten').focus() ;
		return false ;		
	}
	if (trim(document.getElementById('UserName').value)=='' )
	{
		alert('Bạn Chưa nhập tên user để đăng nhập') ;
		document.getElementById('UserName').focus() ;
		return false ;		
	}
	if (trim(document.getElementById('MaNV').value)=='' )
	{
		alert('Bạn Chưa nhập Mã nhân viên') ;
		document.getElementById('MaNV').focus() ;
		return false ;		
	}	
//	if (trim(document.getElementById('NgaySinh').value)=='' )
//	{
//		alert('Bạn Chưa nhập ngày sinh của người dùng ') ;
//		document.getElementById('NgaySinh').focus() ;
//		return false ;		
//	}	
	return true ;
}
function xuly1()
{
	var tam=document.getElementById('khonghienthi').innerHTML ;
 //alert(tam);
   	var  n=tam.split("###"); 
	
   	if (n[1]=='1' ) {alert("Đã thực hiện thành công"); document.getElementById('dong_'+n[2]).style.color="red";     }
   	else if (n[1]=='0' ) { alert(n[2]);   }
	anhienform('capnhapghichu');
    
}
function capnhapghichumoi(ID,lydo,danhgia)
{ 
if(trim(lydo)==''||trim(danhgia)=='') { alert('Bạn chưa nhập thông tin nhân viên nghỉ'); return ;}
    poststr="DATA="+ encodeURIComponent(ID)+  "*@!"+ encodeURIComponent(lydo)+  "*@!"+ encodeURIComponent(danhgia)+  "*@!"+ encodeURIComponent(0);
    loadtrang('khonghienthi',"ns_nvnghi", poststr,"xuly1") ;
  } 

function htcapnhapghichu(id,ten)
{ 
 	  document.getElementById('IDDEL').value=id;  
 	  document.getElementById('tennv').innerHTML=ten;
	  document.getElementById('lydo').value='';  
	  document.getElementById('danhgia').value='';  
	  anhienform('capnhapghichu');
	   document.getElementById('lydo').focus() ;  

}
function toanbo()
{
	
	var quyen;
	for(var i=1;i<=14;i++)
	{
		quyen = 'quyen' + i ;		 
	//	document.getElementById(quyen).selectedIndex =1  ;
		document.getElementById(quyen).value = 7  ;
	}
}
function anhien(ht)
{
 	if( document.getElementById(ht).style.display == '')
	{
		document.getElementById(ht).style.display ='none';
		document.getElementById(ht).style.display ='';
 	}
	else
	{
		document.getElementById(ht).style.display ='';
		document.getElementById(ht).style.display ='none';
 	}
			

}
function matdinh()
{
	var quyen;
	for(var i=1;i<=14;i++)
	{
		quyen = 'quyen' + i ;
		  document.getElementById(quyen).selectedIndex =0  ;
	}
 }

</script>

 <!-- BEGIN: block_trunguser -->
 	  <script language="JavaScript">
			alert("Bạn đã nhập trùng User hoặc mã thành viên !!!");
		 	document.getElementById(UserName).focus() ; 
	  </script>
 	 
 <!-- END: block_trunguser -->
  <!-- BEGIN: block_themmoi-->
 	  <script language="JavaScript">
			
			 document.getElementById('frmcapnhap').style.display='none';	 	 
			 alert("Thêm mới người dùng  thành công !!!");	
	  </script>
 	 
 <!-- END: block_themmoi -->
   <!-- BEGIN: block_capnhap-->
 	  <script language="JavaScript">
			alert("Cập nhập thành công !!!");
		 	 
	  </script>
 	 
 <!-- END: block_capnhap -->
 
 
<script language="JavaScript">
<!-- BEGIN: block_mang -->
	{mangtm} 
 
	
<!-- END: block_trunguser -->
 

var mangmenu= "{mangid}";
var giatridoc=true,giatringang=true;
function setfull()
{  var luu =giatridoc ;
	settatca(1,0);giatridoc=luu;settatca(2,0);giatridoc=luu;settatca(3,0);giatridoc=luu;settatca(4,0);giatridoc=luu;settatca(5,0);giatridoc=luu;settatca(6,0);
}
function settatca(ngang,doc)
{   var tam ;
	if(doc>0)
	{
		 for (var i=1;i<=6;i++) {tam = "q"+doc+"_"+i ;  	document.getElementById(tam).checked = giatridoc ; }
		  giatridoc=!giatridoc;
			return ;
	}
	
	var mid=mangmenu.split(","); 
	for (x in mid)
	{
		 if(mid[x]>0) {  tam = "q"+mid[x]+"_"+ngang ;  document.getElementById(tam).checked = giatridoc ; }
 	}
	 giatridoc=!giatridoc;
}
  var mangcopy=  Array() ;
 
function xuly6()
{  
	 var i=1,id,c="";
 	 var  chan = ketqua.split(',');
	 mangcopy	=  Array() ;
	 
	for(x in chan)
	{ 	 
		if(i==1)
		{  id=chan[x];  i=2;  //alert(id+'='+ mangcopy.length);	
		}
		else 
		{  
		if(chan[x] != null){ mangcopy[id]=chan[x];    }
		
		i=1;
		}
	}
	
	if(mangcopy.length==0) { alert("Tài khoản này chưa phân quyền !");	return;  }
	
	var luu =0 ;giatridoc=0;
	settatca(1,0);giatridoc=0;settatca(2,0);giatridoc=0;settatca(3,0);giatridoc=0;settatca(4,0);giatridoc=0;settatca(5,0);giatridoc=0;settatca(6,0);



   for(x in mangcopy)
	{  
		 for (var i=1;i<=6;i++) 
		 {tam = "q"+x+"_"+i ; 
			 if(mangcopy[x][i-1] >0)	document.getElementById(tam).checked = true ;
			 else document.getElementById(tam).checked = false ;
		 }  
	}
}
function goisetquyen(id)
{ 
	  poststr="DATA="+   encodeURIComponent(id)+  "*@!"+ encodeURIComponent("0")+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0);
     loadtrang('khonghienthi',"listquyen", poststr,"xuly6") ;	
}
function kiemtradn(loai)
{
	if (loai == '4')
	{
		document.getElementById('IPdangnhap').style.display = '' ;
	} else
	{
		document.getElementById('IPdangnhap').style.display = 'none' ;
	}
}

 
    function kiemtrauser(user,taomoi)
   {
   
		if ( taomoi == "true" ) 
		{
			
			loadtrang('hta', "kiemtrauser", poststr,"luuthongbao") ;
		}
		
   }
 

  </script>

  </fieldset></div>
 <script src="js/jquery-1.7.2.min.js"></script>
<script src="js/select2.min.js"></script>
<link rel="stylesheet" media="screen" href="js/select2.min.css"> 
    <script language="JavaScript"> 
	
function kiemtravung(v)
{
	if(v==16){document.getElementById('choncuahang').style.display='none'; document.getElementById('chonvung').style.display=''; }
	else  {document.getElementById('chonvung').style.display='none'; document.getElementById('choncuahang').style.display=''; }
}
function fixDate(dateStr)
{
	
	var tam = dateStr.value;
	var sResult = "";
	var mang = tam.split("/");
	if(mang.length == 3)
	{
		if(mang[0].length == 1)
		{
			sResult += "0" + mang[0] + "/";
		}
		else
		{
			sResult += mang[0] + "/";
		}
		if(mang[1].length == 1)
		{
			sResult += "0" + mang[1] + "/";
		}
		else
		{
			sResult += mang[1] + "/";
		}
		if(mang[2].length == 2)
		{
			sResult += "20" + mang[2];
		}
		else
		{
			sResult += mang[2];
		}
		dateStr.value = sResult;
	}
}
function isDate(dateStr) 
{
var tam = dateStr;

var datePat = /^(\d{1,2})(\/|-)(\d{1,2})(\/|-)(\d{4})$/;
var matchArray = dateStr.match(datePat); // is the format ok?

if (matchArray == null) {
alert("Vui lòng nhập ngày theo định dạng ngày/tháng/năm");
return false;
}

day = matchArray[1]; // p@rse date into variables
month = matchArray[3];
year = matchArray[5];

if (month < 1 || month > 12) { // check month range
alert("Tháng chỉ từ 1 đến 12.");
return false;
}

if (day < 1 || day > 31) {
alert("Ngày chỉ từ 1 đến 31.");
return false;
}

if ((month==4 || month==6 || month==9 || month==11) && day==31) {
alert("Tháng "+month+" không có 31 ngày!")
return false;
}

if (month == 2) { // check for february 29th
var isleap = (year % 4 == 0 && (year % 100 != 0 || year % 300 == 0));
if (day > 29 || (day==29 && !isleap)) {
alert("Tháng 2 năm " + year + " không có " + day + " ngày!");
return false;
}
}
return true; // date is valid
}

	$(document).ready(function() {
	    $('.js-khachhang').select2();
	 
	});
kiemtravung("{loaiuser}");
</script>
 

 
