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
										<!-- <option value="IDKhuVuc">vui lòng chọn tỉnh</option> -->
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
							<input type="button" onclick="quaylai()" name="cancel2" style="width:200px"
									value="Quay lại danh sách mã vận đơn" style="display:none"/>


							<input type="button" name="inan2" id="inan2" onclick="window.close()" value="Đóng Lại"
								style="width:80px;display:{donglai}" />
						</div>
					</fieldset>



				</form>
				<div id="khonghienthi" style="display:none"></div>
				
				<script>

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

				<script language="JavaScript">
					document.getElementById("type0").focus();
					document.getElementById('dachon').value = '0'
					var kh = "";
					var tm = "1";
					{ makh }
					var tieptuc = "";
					function setlai() {
						tieptuc = '';
					}
					function tamdung() {

						tieptuc = 'dung';
						var mTimer = setTimeout('setlai()', 2000);
					}
					function goithem() {
						if (document.getElementById('themmoi').value == "Thêm mới") {
							document.getElementById('soxe').value = "";
							document.getElementById('nhomxe').value = "";
							document.getElementById('model').value = "";
							document.getElementById('taixe').value = "";
							document.getElementById('diachit').value = "";
							document.getElementById('dienthoait').value = "";
							document.getElementById('sokhung').value = "";
							document.getElementById('somay').value = "";
							document.getElementById('mauson').value = "";
							document.getElementById('ghichuxe').value = "";
							nochange(false);
							document.getElementById('themmoi').value = "Lưu";
							return;
						}
						if (document.getElementById('themmoi').value == "Lưu") {
							luuxe()
							return;
						}
						if (document.getElementById('themmoi').value == "Cập nhập") {
							tm = '0';
							luuxe()
							return;
						}


					}

					function chuyen(event, tieptheo, th) {
						capnhap = tieptheo;

						if (event.keyCode == 13 && document.getElementById('dachon').value == '0') {
							document.getElementById(tieptheo).focus();
							capnhap = tieptheo;

						} else {
							document.getElementById(th).focus();
							capnhap = th;
						}
						event.keyCode = '';
					}

				</script>
				<!-- END: block_cus -->
				<!-- BEGIN: block_cusupdate -->
				<script language="JavaScript">
					alert('Cập nhập mã vận đơn thành công');
					location.replace("default.php?act=updatemavandon");
				</script>
				<!-- END: block_cusupdate -->

				<script src="js/jquery-1.7.2.min.js"></script>
				<script src="js/select2.min.js"></script>
				<link rel="stylesheet" media="screen" href="js/select2.min.css">

				<script language="javascript">
					var tinh = '';
					var thanhpho = '';

					$(document).ready(function () {
						$('.js-tinh').select2();
						$('.js-ch').select2();
						$('.js-quan').select2();
						$('.js-phuong').select2();
						$('.js-tinh').on('select2:selecting', function (e) {
							
							tinh = e.params.args.data.id;
							var poststr = "TINH=" + encodeURIComponent(e.params.args.data.id) + "*@!";

							loadtrang('khonghienthi', "ajaxtinhthanh", poststr, "xuly9");
							
						});

						$('.js-tinh').on('change', function (e) {
							
							var target =e.target;
							if(target.options[target.selectedIndex]){
								var text=target.options[target.selectedIndex].text;
								document.getElementById('tinhsl').value = text;
							}
							// console.log(text);
							
						});

						$('.js-quan').on('change', function (e) {
							
							var target =e.target;
							if(target.options[target.selectedIndex]){
								var text=target.options[target.selectedIndex].text;
								document.getElementById('quansl').value = text;
							}
							
						});

						$('.js-quan').on('select2:selecting', function (e) {
							var poststr = "THANH=" + encodeURIComponent(tinh) + "*@!" + encodeURIComponent(e.params.args.data.id);

							var target =e.target;
							var text=target.options[target.selectedIndex].text;
							document.getElementById('quansl').value = text;
							loadtrang('khonghienthi', "ajaxtinhthanh", poststr, "xuly8");

						});


						$('.js-phuong').on('change', function (e) {
							
							var target =e.target;
							if(target.options[target.selectedIndex]){
								var text=target.options[target.selectedIndex].text;
								document.getElementById('phuongsl').value = text;
							}
							
						});

						$('.text-sct').on('blur', function (e) {
							
							var target =e.target;
							var text=target.value;
							checkid = document.getElementById('checkid').value = text;

							
						});
					});
					function xuly9() {

						var tam = document.getElementById('khonghienthi').innerHTML;
						

						var quan = document.getElementById("quan");

						if (tam != "") {
						 	
							quan.innerHTML = tam;
							// console.log(quan);
							quan.disabled = false;

						}


					}

					function xuly8() {

						var tam = document.getElementById('khonghienthi').innerHTML;
						var phuong = document.getElementById("phuong");

						if (tam != "") {
							
							phuong.innerHTML = tam;
							phuong.disabled = false;

						}


					}

					//============================================================
					function ask() {
						var n = confirm("Bạn có muốn xóa không");
						if (n == false) {
							return false;

						}
					}
					function quaylai() {
						location.replace("default.php?act=updatemavandon");
					}
					//=======================
					function settype(valu) {
						document.getElementById('dachon').value = valu;

					}
					function kiemtra() {
						// if (capnhap != '') { return false ;}

						if (document.getElementById('nhomkh').value == "0") {
							alert('Bạn chưa chọn nhóm mã vận đơn');
							document.getElementById('nhomkh').focus();
							return false;
						}

						if (document.getElementById('Name').value == "") {
							alert('Bạn chưa nhập tên mã vận đơn');
							document.getElementById('Name').focus();
							return false;
						}
						if (document.getElementById('makh').value == "") {
							alert('Bạn chưa nhập mã mã vận đơn');
							document.getElementById('Name').focus();
							return false;
						}

						if (document.getElementById('IDKhuVuc').value == "0") {
							alert('Bạn chưa nhập tỉnh thành');
							document.getElementById('IDKhuVuc').focus();
							return false;
						}
						if (document.getElementById('tel').value == "") {
							alert('Bạn chưa nhập số điện thoại');
							document.getElementById('tel').focus();
							return false;
						}
						if (document.getElementById('xungho').value == "0") {
							alert('Bạn vui lòng chọn cách xưng hô!');
							document.getElementById('xungho').focus();
							return false;
						}


						if (document.getElementById('ngaysinh').value == "") {
							alert('Bạn chưa nhập ngày sinh mã vận đơn');
							document.getElementById('Name').focus();
							return false;
						}
						return true;
					}


					function xuly5() {
						document.getElementById("hiethithongbao").style.display = '';
					}
					function goidongthe() {
						document.getElementById("hiethithongbao").style.display = 'none';
					}



					function goikhach(t1) {
						poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0);
						loadtrang('hienthihoso', "thongtinkhachhangmua", poststr, "xuly5");
					}

					function timkiemkh(t1, t2, t3, t4, t5, t6, t7, t8, t9, t10, t11) {
						poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(t2) + "*@!" + encodeURIComponent(t3) + "*@!" + encodeURIComponent(t4);
						poststr = poststr + "*@!" + encodeURIComponent(t5) + "*@!" + encodeURIComponent(t6) + "*@!" + encodeURIComponent(t7) + "*@!" + encodeURIComponent(t8) + "*@!" + encodeURIComponent(t9) + "*@!" + encodeURIComponent(t10) + "*@!" + encodeURIComponent(t11);
						loadtrang('hienthinhacc', "khachhangtim", poststr, "");
						//alert('Luu xong !!!');
					}
					function timthongke(t1, t2, t3, t4, t5, t6, t7, t8, t9, t10, t11) {
						poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(t2) + "*@!" + encodeURIComponent(t3) + "*@!" + encodeURIComponent(t4);
						poststr = poststr + "*@!" + encodeURIComponent(t5) + "*@!" + encodeURIComponent(t6) + "*@!" + encodeURIComponent(t7) + "*@!" + encodeURIComponent(t8) + "*@!" + encodeURIComponent(t9) + "*@!" + encodeURIComponent(t10) + "*@!" + encodeURIComponent(t11);
						loadtrang('hienthinhacc', "khachhangthongke", poststr, "");
						//alert('Luu xong !!!');
					}
					function timthongkediem(t1, t2, t3, t4, t5, t6, t7, t8, t9, t10, t11) {
						poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(t2) + "*@!" + encodeURIComponent(t3) + "*@!" + encodeURIComponent(t4);
						poststr = poststr + "*@!" + encodeURIComponent(t5) + "*@!" + encodeURIComponent(t6) + "*@!" + encodeURIComponent(t7) + "*@!" + encodeURIComponent(t8) + "*@!" + encodeURIComponent(t9) + "*@!" + encodeURIComponent(t10) + "*@!" + encodeURIComponent(t11);
						loadtrang('hienthinhacc', "khachhangthongkediem", poststr, "");
						//alert('Luu xong !!!');
					}
					function khachmua(t1, t2, t3, t4, t5, t6, t7, t8, t9, t10, t11) {
						poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(t2) + "*@!" + encodeURIComponent(t3) + "*@!" + encodeURIComponent(t4);
						poststr = poststr + "*@!" + encodeURIComponent(t5) + "*@!" + encodeURIComponent(t6) + "*@!" + encodeURIComponent(t7) + "*@!" + encodeURIComponent(t8) + "*@!" + encodeURIComponent(t9) + "*@!" + encodeURIComponent(t10) + "*@!" + encodeURIComponent(t11);
						loadtrang('hienthinhacc', "khachhangthongkemua", poststr, "");
						//alert('Luu xong !!!');
					}

					function xephang(t1, t2, t3, t4, t5, t6, t7, t8, t9, t10, t11) {
						poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(t2) + "*@!" + encodeURIComponent(t3) + "*@!" + encodeURIComponent(t4);
						poststr = poststr + "*@!" + encodeURIComponent(t5) + "*@!" + encodeURIComponent(t6) + "*@!" + encodeURIComponent(t7) + "*@!" + encodeURIComponent(t8) + "*@!" + encodeURIComponent(t9) + "*@!" + encodeURIComponent(t10);
						loadtrang('hienthinhacc', "khachhangxephang", poststr, "");
						//alert('Luu xong !!!');
					}


					function xuatkq() {

						document.getElementById("noidung").value = ' <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><html><body>' + document.getElementById("hienthinhacc").innerHTML + "</body></html>";
						// alert( document.getElementById("ketqua").value);
						document.getElementById("xuatketqua").submit();
					}

					function checkDate(strDate) {
						if (strDate == "") return;

						var comp = strDate.split('/')
						var d = parseInt(comp[0], 10)
						var m = parseInt(comp[1], 10)
						if (comp[2] != null) { if (comp[2].length == 2) comp[2] = parseInt("19" + comp[2]); }
						var y = parseInt(comp[2], 10)

						if (d > 31) alert('sai định dạng !')

						var date = new Date(y, m - 1, d);

						if (date.getFullYear() == y && date.getMonth() + 1 == m && date.getDate() == d) {
							return true
						}

						alert('Bạn nhập sai chuẩn ngày sinh 01/01/1999 !');
						document.getElementById("ngaysinh").focus();
						return false
					}


					function kiemtradung(v) {
						var l;
						l = v.length;
						if (l == 0) return;

						if (v[0] != 0) {
							thongbaomoi(' Bạn nhập không đúng chuẩn điện thoại di động bắt đầu bằng số 0!', "Thông báo !", 2); document.getElementById("tel").focus(); return false;
						}

						if (l != 10) {
							thongbaomoi('Bạn nhập dư hoặc thiếu   số kiểm tra lại nhé !', "Thông báo !", 2);
							document.getElementById("tel").focus();
							return;
						}
						document.getElementById('makh').value = v;
					}

					function timkhmacode(v) {
						document.getElementById('search2').click();
						//   poststr="DATA="+    encodeURIComponent(v)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0) ;
						//    loadtrang('khonghienthi', "khachhangtimtheoma", poststr,"xuly9") ;
					}
					var timer;
					function goikh(v) {
						clearTimeout(timer);
						timer = setTimeout(function validate() { timkhmacode(v) }, 500);
					}

					function setkh(t1, t2, t3) {
						return false;
					}
					document.getElementById("Name").focus(); 
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