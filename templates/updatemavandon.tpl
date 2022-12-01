<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<style type="text/css">

</style>
<div class="top_space"></div>
<div class="nenbao">
	<div style="padding:1px">
		<fieldset class="nencon">
			<legend> <a style="cursor:pointer">
					<label style="Color:#FF3300;Font-Weight:Bold;Font-size:15pt;">Danh Sách mã vận đơn</label>
				</a></legend>
			<div>

				<!-- BEGIN: block_cusht1 -->

				<!-- <form name="xuatketqua" id="xuatketqua" action="xuatfile.php" method="post" target="_blank">
					<input name="noidung" id="noidung" type="hidden" value="Chưa chọn dữ liệu">
					<input name="tenfile" id="tenfile" type="hidden" value="thongtinkhachhang.xls">
					<input name="loaifile" id="loaifile" type="hidden" value="application/vnd.ms-excel">
				</form> -->

				<!-- <form name="frmProduct1" method="post">

					<div>
						<b style="display:{q_them}"> [ <a href="default.php?act=updatemavandon&id=-1">Thêm
								Mới</a>]&nbsp;&nbsp;</b>[<a href="default.php?act=md">Đóng Lại</a>]&nbsp;
						<div style="padding:5px">


							<input type="text" name="ma" onkeyup="goikh(this.value)" placeholder="Mã KH_"
								ondblclick="this.value=''" id="ma" class="inpl" style="width:55px"
								onkeypress="return chuyentieps(event,'kv')" value="" />
							&nbsp;
							<input type="text" name="ten" id="ten" ondblclick="this.value=''" placeholder="Tên KH"
								class="inpl" style="width:65px" onkeypress="return chuyentiep(event,'diachitim')"
								value="" />
							Tel
							<input type="text" name="dt" ondblclick="this.value=''" id="dt" class="inpl"
								style="width:66px" onkeypress="return chuyentieps(event,'cmnd')" value="" />

							<input type="text" name="trendiem" title="Khách có điểm tích lũy từ ..." placeholder="Điểm"
								ondblclick="this.value=''" id="trendiem" class="inpl" style="width:30px"
								onkeypress="return chuyentieps(event,'cmnd')" value="" />
							<input type="hidden" name="mc" ondblclick="this.value=''" id="cm" class="inpl"
								style="width:80px" onkeypress="return chuyentieps(event,'kv')" value="" />



							<select onkeypress="return chuyentiep(event,'idnhan')" class="js-ch" name="cuahang"
								id="cuahang" style="width:120px" title="cửa hàng">
								{tatca}
								{cuahangnhan}
							</select>
							<select onkeypress="return chuyentiep(event,'idnhan')" name="tinh" id="tinh"
								style="width:78px">
								<option value="">Nhóm KH</option>
								{nhomkh}
							</select>
							Ngày
							<input onkeypress="return chuyentiep(event,'denngay')" title="Click đôi để xoá trắng"
								ondblclick="xoatrang(this)" type="text" name="tungay" id="tungay" class="text"
								style="width:65px" value="{tungay}" />
							<img src="images/img.gif" id="Lichtungaytao2"
								style="cursor: pointer; border: 0px solid red;" title="Date selector"
								onclick="displayCalendar(frmProduct1.tungay,'dd/mm/yyyy',this)" />đến<input
								onkeypress="return chuyentiep(event,'denngay')" title="Click đôi để xoá trắng"
								ondblclick="xoatrang(this)" type="text" name="denngay" id="denngay" class="text"
								style="width:65px" value="{denngay}" /><img src="images/img.gif" id="Lichtungaytao2"
								style="cursor: pointer; border: 0px solid red;" title="Date selector"
								onclick="displayCalendar(frmProduct1.denngay,'dd/mm/yyyy',this)" />&nbsp;

							</span>
							<select class="compo" name="sapxep" id="sapxep" style="width:80px;">

								<option {sapxepngaytao} value="ngaytao">Xếp Ngày Tạo </option>
								<option {sapxepmakh} value="makh">Sắp Xếp Mã</option>
								<option {sapxepdiemtichluy} value="diemtichluy">Điểm tích lũy</option>
								<option {sapxepIDCuaHang} value="IDCuaHang">Theo Cửa Hàng</option>
								<option {sapxeptimngaytao} value="timngaytao">Tìm theo Ngày Tạo </option>


							</select> </span>
							<input type="button" style="width:37px"
								onclick="timkiemkh(ten.value,dt.value,ma.value,cuahang.value,cm.value,'',sapxep.value ,tungay.value,denngay.value,tinh.value,trendiem.value)"
								name="search5" id="search5" value="Tìm" />

							<input type="button" style="width:30px"
								onclick="timthongke(ten.value,dt.value,ma.value,cuahang.value,cm.value,'',sapxep.value ,tungay.value,denngay.value,tinh.value)"
								name="search2" id="search2" value="TK" title="Thống kê số lượng khách theo cửa hàng" />
							&nbsp;
							<input type="button" style="width:56px"
								onclick="timthongkediem(ten.value,dt.value,ma.value,cuahang.value,cm.value,'',sapxep.value ,tungay.value,denngay.value,tinh.value,trendiem.value)"
								name="search" id="search" value="TK điểm" />

							<input type="button" style="  width: 40px;" id="xuat" value="Excel" name="xuat"
								onclick="xuatkq()" />
						</div>
					</div>
					<div id="hienthinhacc">

						<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr bgcolor="#F8E4CB">
								<td align="center" class="cothienthi" height="23" width="33"><b>STT</b></td>
								<td width="345" align="center" class="cothienthi"><strong>Số chứng từ </strong></td>
								<td width="362" align="center" class="cothienthi"><strong><strong><strong>Mã vận đơn
											</strong></strong></strong> </td>
								<td width="153" align="center" class="cothienthi"><strong><strong>Địa chỉ giao hàng</strong></strong></td>
								<td width="160" align="center" class="cothienthi"><strong>Tỉnh / Thành phố </strong></td>
								<td width="160" align="center" class="cothienthi"><strong>Quận / Huyện </strong></td>
								<td width="160" align="center" class="cothienthi"><strong>Phường / Xã </strong></td>
								<td width="178" align="center" class="cothienthi"><strong><strong>Địa chỉ cửa hàng</strong>
									</strong></td>
							</tr>
							<tr bgcolor="#FFFFFF">
								<td class="cothienthi" align="right">&nbsp;</td>
								<td class="cothienthi">&nbsp;</td>
								<td class="cothienthi">&nbsp;</td>
								<td class="cothienthi">&nbsp;</td>
								<td class="cothienthi">&nbsp;</td>
								<td class="cothienthi">&nbsp;</td>
							</tr>
						</table>
						<div style="height:300px"></div>
					</div>


					<div id="hiethithongbao"
						style="display:none; overflow:hidden; position:absolute;top: 90px;left:0;width:100%; "
						align="center">
						<div
							style=" width:850px; min-height:110px;border:1px #999 solid; background-color:#FFF; opacity: 1;font-size:15px; font-weight:bold; padding:5px; color:#F00;">

							<div>
								<fieldset>
									<legend align="center"> <b style="color:#FF0000;cursor:pointer;font-size:18px"
											onclick="goidongthe()">&nbsp; Thông tin mua hàng &nbsp; ( X )</b> </legend>
									<br />

									<div style="padding:2px" id="hienthihoso"> </div>
								</fieldset>
							</div>
						</div>
					</div>
				</form> -->
				<!-- End: block_cusht2 -->


				<!-- BEGIN: block_cus -->
				<form name="frmProduct2" id="frmProduct2" method="post">

					<fieldset class="nencon" id="khachhang">
						<legend>
							<h3>{t-c}</h3>
						</legend>
						<script language="javascript">
							var t = 1;
							mTimer = setTimeout('doititle()', 1000);
							function doititle() {
								t = t + 1;

								if (t < 18) {
									if (document.title != '***') {
										document.title = "***";
									} else {
										document.title = "Thêm mã vận đơn";
									}
									setTimeout('doititle()', 500);
								}
							}
						</script>


						<table width="100%" border="0">
							<tr class="" id="showthongtinres" style="display:none;
    border-bottom: 1px solid;">
								<td width="24%" >								</td>
								<td width="63%" style="padding-bottom:1em">
									<div id="thongtinres" style="font-weight: bold;
    color: brown;
    font-style: italic;
    padding-bottom: 1em;">									</div>
									<!--<select id="nhavcv" name="nhavc" onchange="tracuuvch(nhapmavandon.value,this.value)">
										<option value="">Chọn nhà vận chyển</option>
										<option value="GHTK">Giao hàng tiết kiệm</option>
										<option value="VT">Viettel</option>
									</select>
									<input type="Text" onkeypress="return chuyentiep(event,'sochungtu')"
										name="nhapmavandon" id="nhapmavandon" onblur="tracuuvch(this.value,nhavcv.value)"
										class="text-sct" size="10"  value="" style="width:200px" />-->

																	</td>
										<td width="10%" >								</td>
							</tr>
							<tr class="" id="loaicapnhat5">
								<td width="24%" id="capnhatphieu" style="padding-top:1em">Số chứng từ: </td>
								<td width="63%" style="padding-top:1em">
								<input type="hidden"  name="id" id="id"/>
								<input type="hidden"  name="idbill" id="idbill"/>
									<input type="Text" onkeypress="return chuyentiep(event,'sochungtu')"
										name="sobill" id="sochungtu" onblur="kiemtraphieuvandon(this.value)"
										class="text-sct" size="10" {capnhapct} value="{sochungtu}" style="width:200px" required/>

										<div id="loadingtime" style="display:none"><img src="images/loading.gif"/>Loading...</div>								</td>
								<td width="10%" >								</td>
							</tr>

							<tr class="m-r-2">
								<td width="24%">
									Mã vận đơn: <span style="color:#FF0000">*</span>
									&nbsp;&nbsp;&nbsp;
									<select id="nhavcv" name="nhavc" onchange="tracuuvch(mavandon.value,this.value)">
										<option value="">Chọn nhà vận chyển</option>
										<option value="GHTK">Giao hàng tiết kiệm</option>
										<option value="VT">Viettel</option>
									</select>
									
									</td>
							  <td colspan="">		
							  					<input type="Text" name="mavd" id="mavandon" class="text"
										style="width:415px" value="{mavandon}" required onblur="tracuuvch(this.value,nhavcv.value)" /> 
										<div id="khonghienthi" style="display:none"></div>
										 <div id="loadingresvch" style="display:none" >
										
												<img src="images/loading.gif"/>Loading...
										</div>	</td>
								<td width="" >								</td>
							</tr>
					<tr class="m-r-2">
								<td width="24%">
									Mã đơn hàng</td>
							  <td colspan=""><input type="Text" name="madh" id="madh" class="text"
										style="width:415px" value="{madh}" required/></td>
							  <td width="10%" >								</td>
							</tr>
							<tr class="m-r-2">
								<td width="24%">
									Địa chỉ giao hàng(Chi tiết - đầy đủ)</td>
							  <td colspan=""><input type="Text" name="diachigiaohang" id="diachigiaohang" class="text"
										style="width:415px" value="{diachigiaohang}" required/></td>
							  <td width="10%" >								</td>
							</tr>

							<tr class="m-r-2">
								<td width="24%">
									<strong>Chọn địa chỉ:</strong>
									</td>
								<td width="63%" ></td>
								<td width="10%" >								</td>
							</tr>

							<!-- check value input id -->
							<input type="hidden" name="checkid" id="checkid" value=""/>

							<tr class="m-r-2">
								<td width="">
								<span style="color:#FF0000">*</span> Quận/Huyện
								Tỉnh Thành															</td>

								<td colspan="2">
									<select class="js-tinh" id="IDKhuVuc" name="khuvuc" style="width:200px" required>
										 <option value=""></option> 
										{khuvuc}
									</select>
									<input type="hidden" name="tinhsl" id="tinhsl" value="">	
									<span style="color:#FF0000">*</span> Quận/Huyện
								
									<select class="js-quan" name="quan" id="quan"  value="quan"
										style="width:200px" required>
									</select>
									<input type="hidden" name="quansl" id="quansl" value="">	
									Phường xã<select class="js-phuong" name="phuong" id="phuong"  value="phuong"
										style="width:200px" required>
										{phuong}
									</select>
									<input type="hidden" name="phuongsl" id="phuongsl" value="">								</td>

								
							</tr>

							<tr class="m-r-2">
								<td>
								 Phí ship:</td>
								<td colspan="2"><input type="Text" name="phiship" id="phiship" class="text"
										 style="width:415px" value="{phiship}" required/>
									<span style="color:#FF0000">*</span>								</td>
									
							</tr>
							<tr class="m-r-2">
								<td>
								Giá trị đơn:</td>
								<td colspan="2"><input type="Text" name="giatridon" id="giatridon" class="text"
										 style="width:415px" value="{giatridon}" required/>
									<span style="color:#FF0000">*</span>								</td>
									
							</tr>
						</table>
						<br />


					<div style="padding-left:105px;padding-bottom:8px">
							<input type="Submit" onfocus="setrong()" onclick="return kiemtra()" class="text"
								id="btnUpdate" name="btnUpdate" value="Cập nhập" />
								
							<!--<input type="button" onclick="quaylai()" name="cancel2" style="width:200px" 
									  value="Quay lại danh sách mã vận đơn" style="display:none" />-->


							<input type="button" name="inan2" id="inan2" onclick="window.close()" value="Đóng Lại"
								style="width:80px;display:{donglai}" />
								  <input type="button" name="tm" style="width:100px;display:{q_themp}"    value="Nhập từ Excel" onclick="nhapexcel1()" />
						</div>
					</fieldset>



				</form>
				
				
<div id="hiennhapexcel"  style="display:none ; overflow:hidden; position:absolute;   top: 90px;left:0;width:100%; " align="center" >
  <div  style=" width:900px;margin:0 auto; min-height:510px;border:1px #999 solid; background-color:#FFF; opacity: 0.98;font-size:15px; 
  font-weight:bold; padding:5px; color:#F00;" >

<div align="right"><b style="color:#00F;cursor:pointer" onclick="goidongid('hiennhapexcel')">( X Đóng lại )</b></div>
 
 <div   id="timexxcel" style="padding:10px">
 <div style="display: flex;
    flex-direction: row;    align-items: center;
    justify-content: center;padding-bottom:1em;">
	<!--<a href="data/maupancake.xlsx" style="margin-right:1em">File mẫu pancke</a>
<a href="data/mauthuongmaidientu.xlsx">File mẫu thương mại điện tử</a>-->
</div>
 <div>
<input id="mangfilean" type="hidden"  size="25" name="mangfilean" value="" />
<a href="data/updatevandon.xlsx" >File mẫu: updatevandon.xlsx</a>
    <label>File  Excel *.xlsx</label>
<input id="fileToUpload" type="file" accept=".xlsx"   size="35" name="fileToUpload" class="input" style="height:22px" />
<div><label style="color:#000066">Từ dòng:</label><input type="number" id="tudong" name="tudong" value="2"/>
<label style="color:#000066">Đến dòng:</label><input type="number" id="dendong" name="dendong"/></div>

</div>
<style>
   .chiao{     display: flex;
    flex-direction: column;
    width: 40%;
    min-height: 120px;
    padding: 0 1em;
    justify-content: space-between;
	    display: flex;
    flex-direction: column;
    width: 40%;
    min-height: 60px;
    padding: 0.5em 1em;
    justify-content: space-between;
  
    margin-right: 1em;
	}
</style>
<div style="margin: 0.5em;
    display: flex;
    justify-content: center;
    flex-direction: column;
    align-items: center;">
	<div class="chiao " style="  border: 1px solid red;">
		<p style="color:#FF0000;font-weight:bold">Tải lên phiếu thu chi</p>
		<button class="button" id="buttonUpload" onclick="return ajaxFileUpload('updatevd',1);" style="height:22px">Tải lên</button>
		<button class="button" id="buttonUpload" onclick="hienthidulieu()" style="height:22px">Hiển thị</button>
		
		<!-- <button class="button" id="buttonUploadmoi" onclick="return hienthidulieumoi();" style="height:22px">Hiển thị</button> -->
	</div>
<div id="resedit"></div>
	
</div>

<div id="resupdate"></div>
 <div id="hienthiexcel" style="padding:5px">
 
 <table id="tbex" width="100%" border="0" cellpadding="0" cellspacing="0" style="background:#FFF;" class="tbchuan">		
 		<tr bgcolor="#F8E4CB">
		  <td align="center" class="cothienthi" height="23" width="32"><b>STT</b></td>
       
		  <td width="75" align="center" class="cothienthi" ><strong>Mã Thành Viên</strong></td>  
 		  <td width="360" align="center" class="cothienthi"><strong>Tên</strong> </td> 
          <td width="39" align="center" class="cothienthi"><strong>Điện thoại</strong></td>
          <td width="40" align="center" class="cothienthi"><strong>Ngày Sinh</strong> </td> 
 		  
		    
 		</tr>
        	<tr bgcolor="" style="color:#000">
		  <td align="center" class="cothienthi" height="23" width="32">5</td>
       
		  <td width="75" align="center" class="cothienthi" >2805210001</td>  
 		  <td width="360" align="center" class="cothienthi">Nguyễn Văn A</td> 
          <td width="39" align="center" class="cothienthi">0987654321</td> 
		  <td width="40" align="center" class="cothienthi">01/01/2000</td>
       
		    
		    
 		</tr>
        </table>
 
 
 </div> 
 
</div>
</div>
</div>
 
 
  
<div id="khonghienthiapp"></div>
				<div id="khonghienthi" style="display:none"></div>
		 <script src="js/jquery-1.7.2.min.js"></script>
<script src="js/select2.min.js"></script>
<link rel="stylesheet" media="screen" href="js/select2.min.css">
<script type="text/javascript" src="templates/ajaxfileupload.js"></script>		
				<script>

function nhapexcel1()
{
    if (document.getElementById('hiennhapexcel').style.display =="")
	{
		document.getElementById('hiennhapexcel').style.display = "none";
		//document.getElementById('timkhachhanght').style.display = '' ;	
		//document.getElementById('timphieuxuat').style.display = 'none' ;	
 	} else
	{
		document.getElementById('hiennhapexcel').style.display = "";
		//document.getElementById('timkhachhanght').style.display = 'none' ;	
		//document.getElementById('timphieuxuat').style.display = '' ;	
	}

	
	
} 

function ajaxFileUpload(tenfile,loai)
{

	var  tt = id_user;
	
 	//$("#buttonUpload").val(loai);
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
				url:'fileuploadchung.php?us='+tenfile,
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

var index='';
function editRow(e,id,loai=''){
index=id;
	document.getElementById("resedit").display="block";
	var target=e.target;
	var value=target.value;
	var r1=document.getElementById("sobill"+id).value;
	var r2=document.getElementById("madh"+id).value;
	var r3=document.getElementById("mavd"+id).value;
	var r4=document.getElementById("trigiadon"+id).value;
	var r5=document.getElementById("tongtien"+id).value;
	var r6=document.getElementById("ship"+id).value;
	var r7=document.getElementById("donvivc"+id).value;
	var r8=document.getElementById("diachikh"+id).value;
	var r9=document.getElementById("tinh"+id).value;
	var r10=document.getElementById("quan"+id).value;
	var r11=document.getElementById("phuong"+id).value;
	var r12=document.getElementById("sobillcu"+id);
	var row=r1+"###"+r2+"###"+r3+"###"+r4+"###"+r5+"###"+r6+"###"+r7+"###"+r8+"###"+r9+"###"+r10+"###"+r11+"###"+r12;
	var poststr = "EDITEX=" + encodeURIComponent(id) + "*@!" + encodeURIComponent(row) + "*@!" + encodeURIComponent(loai);
	loadtrang('resedit', "updatevandontailenhienthi", poststr, "xuly7");
		
		
}
function xuly7(){
document.getElementById("resedit").display="none";
	var r1=document.getElementById("sobill"+index);
	var r2=document.getElementById("madh"+index);
	var r3=document.getElementById("mavd"+index);
	var r4=document.getElementById("trigiadon"+index);
	var r5=document.getElementById("tongtien"+index);
	var r6=document.getElementById("ship"+index);
	var r7=document.getElementById("donvivc"+index);
	var r8=document.getElementById("diachikh"+index);
	var r9=document.getElementById("tinh"+index);
	var r10=document.getElementById("quan"+index);
	var r11=document.getElementById("phuong"+index);
	
var tam= document.getElementById("resedit").innerHTML;
console.log(tam);
if(tam){
	tam=tam.split("@@@");
	document.getElementById("resedit").innerHTML=tam[2];
	if(tam[1]==-1){
		console.log(tam);
		return;
	}
	
	if(tam[1]==1){
		$(".input_tb"+index).css("color","green");
	}
	var row=tam[3];
	if(row){
		row=row.split("###");
		r1.value=row[0];r2.value=row[1];r3.value=row[2];r4.value=row[3];r5.value=row[4];r6.value=row[5];r7.value=row[6];r8.value=row[7];r9.value=row[8];r10.value=row[9];r11.value=row[10];
		document.getElementById("loi"+index).innerHTML='';
	}
	
	//document.getElementById("resedit").innerHTML=tam[2]
}

}
function xuatbaoloi(loi){
	alert(loi);
}
function laydulieuexel(){
	document.getElementById("dulieue").disabled=true;
	var tudong=document.getElementById("tudong").value;
var dendong=document.getElementById("dendong").value;
	var poststr = "DATA=" + encodeURIComponent(tudong) + "*@!" + encodeURIComponent(dendong);
	loadtrang('resupdate', "updatevandoncheckdata", poststr, "xuly2");

}

function xuly2(){
var tam=document.getElementByID("resupdate").innerHTML;
document.getElementById("dulieue").disabled=false;
	if(tam){
	
		alert(tam);
		
	}
}

function hienthidulieu()
{ 	
var tudong=document.getElementById("tudong").value;
var dendong=document.getElementById("dendong").value;
	   var t1 ;
	 //  t1=document.getElementById('idchuyen').value;
	   poststr ="DATA="+encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(tudong)+ "*@!"+ encodeURIComponent(dendong)+ "*@!"+ encodeURIComponent(0) ;
 	   loadtrang('hienthiexcel','updatevandontailenhienthi', poststr,"") ;		
 
}
function xuatbaoloi(str){
	alert(str);
}

$(document).ready(function() {
		
	   
		 $('.js-tinh').select2({
		 		 multiple: true,
				  placeholder: "chọn tỉnh",
				  
			});
			 $('.js-quan').select2({
		 		 multiple: true,
				  placeholder: "Chọn quận",
				  
			});
			 $('.js-phuong').select2({
		 		 multiple: true,
				  placeholder: "Chọn phường",
				  
			});
});
					// loading time

					function isloading(type,id){
						if(type){
							if(document.getElementById(id)){
								document.getElementById(id).style.display="inline-block";
							}
						}else{
							if(document.getElementById(id)){
								document.getElementById(id).style.display="none";
							}
						}
					}

					function kiemtraphieuvandon(t1, t2) {
						
						if (t1 == '') return;
						isloading(true,'loadingtime');
						poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(1);

						loadtrang('khonghienthi', "kiemtraupdatemavandon", poststr, "xuly2");
					}
					
					
					function xuly2() {
						var tam = document.getElementById('khonghienthi').innerHTML;
					//
						var n = tam.split("###");
						console.log(n); 
						document.getElementById('btnUpdate').disabled = false;
						if (n[1] == "1") {
							document.getElementById('id').value = n[11];
							document.getElementById('idbill').value = n[2];
							if(n[3]!=''){
								document.getElementById('mavandon').style.borderColor="unset"
								document.getElementById('mavandon').value = n[3];
							}
							else{	
								document.getElementById('mavandon').style.borderColor="red"
							}	
							if(n[4]!=''){
								document.getElementById('madh').style.borderColor="unset"
								document.getElementById('madh').value = n[4];
							}
							else{	
								document.getElementById('mavandon').style.borderColor="red"
							}	
							if(n[13]!=''){
								document.getElementById('giatridon').value = n[13];
								document.getElementById('giatridon').style.borderColor="unset"
							}
							else{	
								document.getElementById('giatridon').style.borderColor="red"
							}
							if(n[12]!=''){
								document.getElementById('phiship').value = n[12];
								document.getElementById('phiship').style.borderColor="unset"
							}
							else{	
								document.getElementById('phiship').style.borderColor="red"
							}
							if(n[6]!=''){
								document.getElementById('diachigiaohang').value = n[6];
								document.getElementById('diachigiaohang').style.borderColor="unset"
							}
							else{	
								document.getElementById('diachigiaohang').style.borderColor="red"
							}
							
							if(n[9]!=''){
								document.getElementById('phuong').style.borderColor="unset"
								document.getElementById("phuong").innerHTML=n[9];
							}
							else{	
								document.getElementById('phuong').style.borderColor="red"
							}
							if(n[8]!=''){
								document.getElementById('quan').style.borderColor="unset"
									document.getElementById("quan").innerHTML=n[8];
							}
							else{	
								document.getElementById('quan').style.borderColor="red"
							}
							if(n[7]!=''){
								document.getElementById('IDKhuVuc').style.borderColor="unset"
								$("#IDKhuVuc").val(n[7]);
								$("#IDKhuVuc").trigger("change");
							}
							else{	
								
								document.getElementById('IDKhuVuc').style.borderColor="red"
							}
								
								
							// selected option
							document.getElementById('showthongtinres').style.display='none';

							
						}else if(n[1]==-1){
							document.getElementById('idbill').value = n[3];
							//document.getElementById('sobill').value = n[4];
							document.getElementById('showthongtinres').style.display='table-row'	
							 document.getElementById('thongtinres').innerHTML = n[2];
							 document.getElementById('mavandon').style.borderColor="red"
							  document.getElementById('madh').style.borderColor="red"
							 document.getElementById('giatridon').style.borderColor="red"
							  document.getElementById('phiship').style.borderColor="red"
							 document.getElementById('diachigiaohang').style.borderColor="red"
							 document.getElementById('phuong').style.borderColor="red"
							 document.getElementById('quan').style.borderColor="red"
							  document.getElementById('IDKhuVuc').style.borderColor="red"
							 
							  
							 document.getElementById('mavandon').value=''
							  document.getElementById('madh').value=''
							 document.getElementById('giatridon').value=''
							  document.getElementById('phiship').value=''
							 document.getElementById('diachigiaohang').value=''
							 document.getElementById('phuong').value=''
							 document.getElementById('quan').value=''
							  document.getElementById('IDKhuVuc').value=''
						}
						isloading(false,'loadingtime');
					}

				function tracuuvch(t1,t2){
				
					if(!t1){
						return;
					}
					isloading(true,'loadingresvch');
						postr = "LOADVANCHUYEN=" + encodeURIComponent(t1) + "*@!" +encodeURIComponent(t2);

						loadtrang('khonghienthi', "kiemtraupdatemavandon", postr, "xuly4");
				}
				
				function xuly4(){
					var tam = document.getElementById('khonghienthi').innerHTML;
					//
						var n = tam.split("###");
						console.log(n);
								if (n[1] == "1") {
									if(n[8]!=''){
									document.getElementById('madh').style.borderColor="unset"
									document.getElementById('madh').value = n[8];
								}
								else{	
									document.getElementById('mavandon').style.borderColor="red"
								}
								if(n[5]!=''){
									document.getElementById('diachigiaohang').value = n[6];
									document.getElementById('diachigiaohang').style.borderColor="unset"
								}
								else{	
									document.getElementById('diachigiaohang').style.borderColor="red"
								}
								
								if(n[4]!=''){
									document.getElementById('phuong').style.borderColor="unset"
									document.getElementById("phuong").innerHTML=n[9];
								}
								else{	
									document.getElementById('phuong').style.borderColor="red"
								}
								if(n[3]!=''){
									document.getElementById('quan').style.borderColor="unset"
										document.getElementById("quan").innerHTML=n[8];
								}
								else{	
									document.getElementById('quan').style.borderColor="red"
								}
								
								if(n[7]!=''){
									document.getElementById('giatridon').value = n[7];
									document.getElementById('giatridon').style.borderColor="unset"
								}
								else{	
									document.getElementById('giatridon').style.borderColor="red"
								}
								
								if(n[6]!=''){
									document.getElementById('phiship').value = n[6];
									document.getElementById('phiship').style.borderColor="unset"
								}
								else{	
									document.getElementById('phiship').style.borderColor="red"
								}
								
								
								if(n[2]!=''){
									document.getElementById('IDKhuVuc').style.borderColor="unset"
									$("#IDKhuVuc").val(n[7]);
									$("#IDKhuVuc").trigger("change");
								}
								else{	
									
									document.getElementById('IDKhuVuc').style.borderColor="red"
								}
									
							}
							else{
							 document.getElementById('showthongtinres').style.display="table-row";	
							 document.getElementById('thongtinres').innerHTML=n[2];
								 document.getElementById('mavandon').style.borderColor="red";
								   document.getElementById('madh').style.borderColor="red";
							 document.getElementById('giatridon').style.borderColor="red";
							  document.getElementById('phiship').style.borderColor="red";
							 document.getElementById('diachigiaohang').style.borderColor="red";
							 document.getElementById('phuong').style.borderColor="red";
							 document.getElementById('quan').style.borderColor="red";
							  document.getElementById('IDKhuVuc').style.borderColor="red";
							}
					isloading(false,'loadingresvch');
				}
				
				
					//load hình thưc
					function chiendich1(e) {
						var id = e.target.value
						postr = "DATA=" + encodeURIComponent(id);

						loadtrang('loadchang1', "loadajax/chiendichload1", postr, "xuly3");

					}

					function xuly3() {
						var tam = document.getElementById("loadchang1").innerHTML;
						console.log(tam);

					}

				</script>

				<!-- BEGIN: block_khongxoa -->
				<script language="JavaScript">
					alert('Bạn không thể xóa mã vận đơn này do đã có nơi sử dụng  rồi !!! ');
				</script>
				<!-- END: block_khongxoa -->
				
				<!-- BEGIN: block_capnhatthanhcong -->
				<script>
						alert("cập nhật thành công");
						window.location='default.php?act=updatemavandon';
						
				</script>
				<!-- END: block_capnhatthanhcong -->
			</div>
		</fieldset>
	</div>