<style>
	.wrapper {
		width: 100%;
		height: 140vh;
	}

	.header {
		width: 100%;
	}

	#poupduyet {
		display: none;
		width: 100%;
		height: 120vh;
		position: fixed;
		left: 0;
		top: 0;
		align-items: center;
		justify-content: center;
		z-index: 100;
		background-color: #00000045;
	}
</style>
<div class="top_space"></div>
<div class="nenbao">
	<div style="padding:1px">
		<fieldset class="nencon">
			<legend> <a style="cursor:pointer">
					<label style="Color:#FF3300;Font-Weight:Bold;Font-size:15pt;">Báo Cáo Khách Hàng</label>
				</a></legend>
			<div>


				<form name="frmProduct2" id="frmProduct2" method="post">

					<div id="khonghienthi" style="display:none"></div>
					<div>

						<div style="padding:5px">


							<input type="text" name="ma" onkeyup="goikh(this.value)" placeholder="Mã KH "
								ondblclick="this.value=''" id="ma" class="inpl" style="width:55px"
								onkeypress="return chuyentieps(event,'kv')" value="" />
							&nbsp;
							<input type="text" name="ten" id="ten" ondblclick="this.value=''" placeholder="Tên KH"
								class="inpl" style="width:65px" onkeypress="return chuyentiep(event,'diachitim')"
								value="" />
							Tel
							<input type="text" name="dt" ondblclick="this.value=''" id="dt" class="inpl"
								style="width:66px" onkeypress="return chuyentieps(event,'cmnd')" value="" />

							<input type="text" name="trendiem" title="Khách có điểm tích lũy từ ...nhập ô tên để chặn"
								placeholder="Điểm" ondblclick="this.value=''" id="trendiem" class="inpl"
								style="width:50px" onkeypress="return chuyentieps(event,'cmnd')" value="" />
							<input type="hidden" name="mc" ondblclick="this.value=''" id="cm" class="inpl"
								style="width:80px" onkeypress="return chuyentieps(event,'kv')" value="" />



							<select onkeypress="return chuyentiep(event,'idnhan')" class="js-ch" name="cuahang"
								id="cuahang" style="width:180px" title="cửa hàng">
								{tatca}
								{cuahangnhan}
							</select>
							<select onkeypress="return chuyentiep(event,'idnhan')" name="tinh" id="tinh"
								style="width:98px">
								<option value="">Nhóm KH</option>
								<option value="-1">Zalo</option>
								{nhomkh}
							</select>

							<select onkeypress="return chuyentiep(event,'idnhan')" name="gioitinh" id="gioitinh"
								style="width:70px">
								<option value="">Giới tính</option>
								<option value="1">Nam</option>
								<option value="2">Nữ</option>

							</select>
							Ngày
							<input onkeypress="return chuyentiep(event,'denngay')" title="Click đôi để xoá trắng"
								ondblclick="xoatrang(this)" type="text" name="tungay" id="tungay" class="text"
								style="width:65px" value="{tungay}" />
							<img src="images/img.gif" id="Lichtungaytao2"
								style="cursor: pointer; border: 0px solid red;" title="Date selector"
								onclick="displayCalendar(frmProduct2.tungay,'dd/mm/yyyy',this)" />đến<input
								onkeypress="return chuyentiep(event,'denngay')" title="Click đôi để xoá trắng"
								ondblclick="xoatrang(this)" type="text" name="denngay" id="denngay" class="text"
								style="width:65px" value="{denngay}" /><img src="images/img.gif" id="Lichtungaytao2"
								style="cursor: pointer; border: 0px solid red;" title="Date selector"
								onclick="displayCalendar(frmProduct2.denngay,'dd/mm/yyyy',this)" />&nbsp;

							<select class="compo" name="sapxep" id="sapxep" style="width:80px;">

								<option {sapxepngaytao} value="ngaytao">Xếp Ngày Tạo </option>
								<option {sapxepmakh} value="makh">Sắp Xếp Mã</option>
								<option {sapxepdiemtichluy} value="diemtichluy">Điểm tích lũy</option>
								<option {sapxepIDCuaHang} value="IDCuaHang">Theo Cửa Hàng</option>
								<option {sapxeptimngaytao} value="timngaytao">Tìm theo Ngày Tạo </option>
								<option {sapxepcaonhat} value="caonhat">Khách có điểm cao nhất trong khoản thời gian
								</option>

							</select>
							<span style="padding-top:10px;padding-bottom:5px">
								<input type="button" style="  width: 60px;" id="xuat2"
									title="tải lên danh sách điện thoại khách hàng để so sánh" value="Tải File"
									name="xuat2" onclick="nhapexcel1()" /> &nbsp;
							</span><span style="padding-top:10px;padding-bottom:5px">
								<input type="button" style="  width: 40px;" id="xuat" value="Excel" name="xuat"
									onclick="xuatkq()" />
							</span><br />
							<div align="center" style="padding-top:10px;padding-bottom:5px"><input type="button"
									style="width:37px"
									onclick="timkiemkh(ten.value,dt.value,ma.value,cuahang.value,cm.value,'',sapxep.value ,tungay.value,denngay.value,tinh.value,trendiem.value,gioitinh.value)"
									name="search5" id="search5" value="Tìm" /> &nbsp;

								<input type="button" style="width:30px"
									onclick="timthongke(ten.value,dt.value,ma.value,cuahang.value,cm.value,'',sapxep.value ,tungay.value,denngay.value,tinh.value,trendiem.value,gioitinh.value)"
									name="search2" id="search2" value="TK"
									title="Thống kê số lượng khách theo cửa hàng" />
								&nbsp;
								<input type="button" style="width:30px"
									onclick="thongkebill(ten.value,dt.value,ma.value,cuahang.value,cm.value,'',sapxep.value ,tungay.value,denngay.value,tinh.value,trendiem.value,gioitinh.value)"
									name="search22" id="search22" value="Bill"
									title="Thống kê số bill từ cao tới thấp" />
								&nbsp; <input type="button" style="width:56px"
									onclick="timthongkediem(ten.value,dt.value,ma.value,cuahang.value,cm.value,'',sapxep.value ,tungay.value,denngay.value,tinh.value,trendiem.value,gioitinh.value)"
									name="search" id="search" value="TK điểm" />
								<input type="button" style="width:56px"
									onclick="timthongketuoi(ten.value,dt.value,ma.value,cuahang.value,cm.value,'',sapxep.value ,tungay.value,denngay.value,tinh.value,trendiem.value,gioitinh.value,1)"
									name="search" id="search" value="TK Tuổi" />
								<input type="button" style="width:56px"
									title="là thống kê đơn theo khách hàng mua ở độ tuổi nào group theo khách hàng"
									onclick="timthongketuoi(ten.value,dt.value,ma.value,cuahang.value,cm.value,'',sapxep.value ,tungay.value,denngay.value,tinh.value,trendiem.value,gioitinh.value,2)"
									name="search9" id="search9" value="TK Đơn" />
								<input type="button" title="Thống kê sản phẩm theo độ tuổi ( nhập mã mô tả vào ô Tel )"
									style="width:50px"
									onclick="timthongkesp(ten.value,dt.value,ma.value,cuahang.value,cm.value,'',sapxep.value ,tungay.value,denngay.value,tinh.value,trendiem.value,gioitinh.value)"
									name="search8" id="search8" value="TK SP" />

								&nbsp;
								<input type="button" style="width:64px"
									onclick="xephang(ten.value,dt.value,ma.value,cuahang.value,cm.value,'',sapxep.value ,tungay.value,denngay.value,tinh.value)"
									name="search3" id="search3" value="Xếp Hạng" />
								&nbsp;<input type="button" style="width:72px"
									onclick="khachmua(ten.value,dt.value,ma.value,cuahang.value,cm.value,'',sapxep.value ,tungay.value,denngay.value,tinh.value,trendiem.value)"
									name="search4" id="search4" value="Khách mua" />
								&nbsp;<input type="button" style="width:75px"
									onclick="nguonkhach(ten.value,dt.value,ma.value,cuahang.value,cm.value,'',sapxep.value ,tungay.value,denngay.value,tinh.value,trendiem.value,0)"
									name="search6" id="search6" value="Khách Tổng" />
								&nbsp;
								<input type="button" style="width:67px"
									onclick="nguonkhach(ten.value,dt.value,ma.value,cuahang.value,cm.value,'',sapxep.value ,tungay.value,denngay.value,tinh.value,trendiem.value,1)"
									name="search7" id="search7" value="Khách CH" />
								<input type="button" style="width:105px"
									onclick="nguonkhach(ten.value,dt.value,ma.value,cuahang.value,cm.value,'',sapxep.value ,tungay.value,denngay.value,tinh.value,trendiem.value,2)"
									name="search62" id="search62" value="khách theo ngày" />
								<input type="button" style="width:85px"
									onclick="nguonkhach(ten.value,dt.value,ma.value,cuahang.value,cm.value,'',sapxep.value ,tungay.value,denngay.value,tinh.value,trendiem.value,3)"
									name="search622" id="search622" value="Khách Online" />
								<input type="button" style="width:85px"
									onclick="nguonkhach(ten.value,dt.value,ma.value,cuahang.value,cm.value,'',sapxep.value ,tungay.value,denngay.value,tinh.value,trendiem.value,4)"
									name="search6222" id="search6222" value="Nguồn tải lên" />
								<input type="button" style="width:85px"
									onclick="tonghopkhachhang(ten.value,dt.value,ma.value,cuahang.value,cm.value,'',sapxep.value ,tungay.value,denngay.value,tinh.value,trendiem.value,3)"
									name="search6223" id="search6223" value="Tổng hợp KH" />
								<input type="button" style="width:65px"
									onclick="khachquantam(ten.value,dt.value,ma.value,cuahang.value,cm.value,'',sapxep.value ,tungay.value,denngay.value,tinh.value,trendiem.value,3)"
									name="search622321" title="khách quan tâm Zalo" id="search622322"
									value="Khách QT" />
								<input type="button" style="width:67px"
									onclick="khachquantamchitiet(ten.value,dt.value,ma.value,cuahang.value,cm.value,'',sapxep.value ,tungay.value,denngay.value,tinh.value,trendiem.value,3)"
									name="qtct" title="khách quan tâm Zalo" id="qtct" value="QT Chi tiết" />
								<input type="button" style="width:67px"
									onclick="tilekhachonline(ten.value,dt.value,ma.value,cuahang.value,cm.value,'',sapxep.value ,tungay.value,denngay.value,tinh.value,trendiem.value,3)"
									name="qtct2" title="Tỉ lệ đăng ký khách hàng Online" id="qtct2" value="Tỉ lệ OL" />
							</div>
						</div>
					</div>
					<div id="hienthinhacc"> </div>
				</form>


				<form name="xuatketqua" id="xuatketqua" action="xuatfile.php" method="post" target="_blank">
					<input name="noidung" id="noidung" type="hidden" value="Chưa chọn dữ liệu">
					<input name="tenfile" id="tenfile" type="hidden" value="thongtinkhachhang.xls">
					<input name="loaifile" id="loaifile" type="hidden" value="application/vnd.ms-excel">
				</form>


				<div id="hiennhapexcel"
					style="display:none ; overflow:hidden; position:absolute;   top: 90px;left:0;width:100%; "
					align="center">
					<div style=" width:900px; min-height:510px;border:1px #999 solid; background-color:#FFF; opacity: 0.98;font-size:15px; 
  font-weight:bold; padding:5px; color:#F00;">

						<div align="right"><b style="color:#00F;cursor:pointer" onclick="goidongid('hiennhapexcel')">( X
								Đóng lại )</b></div>

						<div id="timexxcel" style="padding:10px">


							<input id="mangfilean" type="hidden" size="25" name="mangfilean" value="" />
							<label>File khách hàng Excel *.xlsx</label>
							<input id="fileToUpload" type="file" accept=".xlsx" size="35" name="fileToUpload"
								class="input" style="height:22px" />
							<button class="button" id="buttonUpload" onclick="return ajaxFileUpload();"
								style="height:22px">Tải lên</button> 
							 
							<button class="button" id="buttonUpload1" onclick="return hienthidulieu();"
								style="height:22px">Hiển thị dữ liệu Excel trước</button> 
							<div id="hienthiexcel" style="padding:5px">
								<table id="tbex" width="100%" border="0" cellpadding="0" cellspacing="0"
									style="background:#FFF;" class="tbchuan">
									<tr bgcolor="#F8E4CB">
										<td align="center" class="cothienthi" height="23" width="32"><b>STT</b></td>

										<td width="75" align="center" class="cothienthi"><strong>Mã Thành Viên</strong>
										</td>
										<td width="360" align="center" class="cothienthi"><strong>Tên</strong> </td>
										<td width="39" align="center" class="cothienthi"><strong>Điện thoại</strong>
										</td>
										<td width="40" align="center" class="cothienthi"><strong>Ngày Sinh</strong>
										</td>


									</tr>
									<tr bgcolor="" style="color:#000">
										<td align="center" class="cothienthi" height="23" width="32">5</td>

										<td width="75" align="center" class="cothienthi">2805210001</td>
										<td width="360" align="center" class="cothienthi">Nguyễn Văn A</td>
										<td width="39" align="center" class="cothienthi">0987654321</td>
										<td width="40" align="center" class="cothienthi">01/01/2000</td>



									</tr>
								</table>


							</div>

						</div>
					</div>
				</div>


				<div id="hiethithongbao"
					style="display:none; overflow:hidden; position:absolute;   top: 90px;left:0;width:100%; "
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


				<div id="khonghienthiapp"></div>

				<script src="js/jquery-1.7.2.min.js"></script>
				<script src="js/select2.min.js"></script>
				<link rel="stylesheet" media="screen" href="js/select2.min.css">
				<script type="text/javascript" src="templates/ajaxfileupload.js"></script>
				<script language="JavaScript">

					$(document).ready(function () {
						$('.js-ch').select2();

					});



					function ajaxFileUpload() {
						var tt = id_user;


						var nn = new Date().getTime();;
						$("#loading")
							.ajaxStart(function () {
								$(this).show();
							})
							.ajaxComplete(function () {
								$(this).hide();
							});
						$.ajaxFileUpload
							(

								{
									url: 'fileuploaddata.php?us=khachhang&loai=1',
									secureuri: false,
									fileElementId: 'fileToUpload',
									dataType: 'json',
									success: function (data, status) {
										if (typeof (data.error) != 'undefined') {
											if (data.error != '') {
												alert(data.error);
												return false;
											} else {
												kq = data.msg;

												mkq = kq.split('*');

												hienthidulieu();

											}
										}
									},
									error: function (data, status, e) {
										if (data.e == 'vuotdungluong') {
											alert("Vượt dung lượng cho phép 8M !!!");
										}
									}
								}
							)

						return false;

					}
					function xuly5() {
						document.getElementById("hiethithongbao").style.display = '';
					}

					function goidongthe() {
						document.getElementById("hiethithongbao").style.display = 'none';
					}


					function xulychung() {
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

					function thongkebill(t1, t2, t3, t4, t5, t6, t7, t8, t9, t10, t11) {
						poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(t2) + "*@!" + encodeURIComponent(t3) + "*@!" + encodeURIComponent(t4);
						poststr = poststr + "*@!" + encodeURIComponent(t5) + "*@!" + encodeURIComponent(t6) + "*@!" + encodeURIComponent(t7) + "*@!" + encodeURIComponent(t8) + "*@!" + encodeURIComponent(t9) + "*@!" + encodeURIComponent(t10) + "*@!" + encodeURIComponent(t11);
						loadtrang('hienthinhacc', "khachhangthongkebill", poststr, "");
					}

					function timthongketuoi(t1, t2, t3, t4, t5, t6, t7, t8, t9, t10, t11, t12, t13) {
						poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(t2) + "*@!" + encodeURIComponent(t3) + "*@!" + encodeURIComponent(t4);
						poststr = poststr + "*@!" + encodeURIComponent(t5) + "*@!" + encodeURIComponent(t6) + "*@!" + encodeURIComponent(t7) + "*@!" + encodeURIComponent(t8) + "*@!" + encodeURIComponent(t9) + "*@!" + encodeURIComponent(t10) + "*@!" + encodeURIComponent(t11) + "*@!" + encodeURIComponent(t12) + "*@!" + encodeURIComponent(t13);
						loadtrang('hienthinhacc', "khachhangthongketuoi", poststr, "");
						//alert('Luu xong !!!');
					}
					function timthongkesp(t1, t2, t3, t4, t5, t6, t7, t8, t9, t10, t11) {
						poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(t2) + "*@!" + encodeURIComponent(t3) + "*@!" + encodeURIComponent(t4);
						poststr = poststr + "*@!" + encodeURIComponent(t5) + "*@!" + encodeURIComponent(t6) + "*@!" + encodeURIComponent(t7) + "*@!" + encodeURIComponent(t8) + "*@!" + encodeURIComponent(t9) + "*@!" + encodeURIComponent(t10) + "*@!" + encodeURIComponent(t11);
						loadtrang('hienthinhacc', "khachhangthongkesp", poststr, "");
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


					function khachquantam(t1, t2, t3, t4, t5, t6, t7, t8, t9, t10, t11, t12) {
						poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(t2) + "*@!" + encodeURIComponent(t3) + "*@!" + encodeURIComponent(t4);
						poststr = poststr + "*@!" + encodeURIComponent(t5) + "*@!" + encodeURIComponent(t6) + "*@!" + encodeURIComponent(t7) + "*@!" + encodeURIComponent(t8) + "*@!" + encodeURIComponent(t9) + "*@!" + encodeURIComponent(t10) + "*@!" + encodeURIComponent(t11) + "*@!" + encodeURIComponent(t12);
						loadtrang('hienthinhacc', "khachhangthongkequantam", poststr, "");

					}
					function khachquantamchitiet(t1, t2, t3, t4, t5, t6, t7, t8, t9, t10, t11, t12) {

						poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(t2) + "*@!" + encodeURIComponent(t3) + "*@!" + encodeURIComponent(t4);
						poststr = poststr + "*@!" + encodeURIComponent(t5) + "*@!" + encodeURIComponent(t6) + "*@!" + encodeURIComponent(t7) + "*@!" + encodeURIComponent(t8) + "*@!" + encodeURIComponent(t9) + "*@!" + encodeURIComponent(t10) + "*@!" + encodeURIComponent(t11) + "*@!" + encodeURIComponent(t12);
						loadtrang('hienthinhacc', "khachhangquantamchitiet", poststr, "");

					}

					function tonghopkhachhang(t1, t2, t3, t4, t5, t6, t7, t8, t9, t10, t11, t12) {
						poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(t2) + "*@!" + encodeURIComponent(t3) + "*@!" + encodeURIComponent(t4);
						poststr = poststr + "*@!" + encodeURIComponent(t5) + "*@!" + encodeURIComponent(t6) + "*@!" + encodeURIComponent(t7) + "*@!" + encodeURIComponent(t8) + "*@!" + encodeURIComponent(t9) + "*@!" + encodeURIComponent(t10) + "*@!" + encodeURIComponent(t11) + "*@!" + encodeURIComponent(t12);
						loadtrang('hienthinhacc', "khachhangbaocaotonghop", poststr, "");

					}

					function tilekhachonline(t1, t2, t3, t4, t5, t6, t7, t8, t9, t10, t11, t12) {
						poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(t2) + "*@!" + encodeURIComponent(t3) + "*@!" + encodeURIComponent(t4);
						poststr = poststr + "*@!" + encodeURIComponent(t5) + "*@!" + encodeURIComponent(t6) + "*@!" + encodeURIComponent(t7) + "*@!" + encodeURIComponent(t8) + "*@!" + encodeURIComponent(t9) + "*@!" + encodeURIComponent(t10) + "*@!" + encodeURIComponent(t11) + "*@!" + encodeURIComponent(t12);
						loadtrang('hienthinhacc', "khachhangbaocaotileonline", poststr, "");

					}

					function xuatkq() {

						document.getElementById("noidung").value = ' <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><html><body>' + document.getElementById("hienthinhacc").innerHTML + "</body></html>";
						// alert( document.getElementById("ketqua").value);
						document.getElementById("xuatketqua").submit();
					}
					function nguonkhach(t1, t2, t3, t4, t5, t6, t7, t8, t9, t10, t11, t12) {
						poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(t2) + "*@!" + encodeURIComponent(t3) + "*@!" + encodeURIComponent(t4);
						poststr = poststr + "*@!" + encodeURIComponent(t5) + "*@!" + encodeURIComponent(t6) + "*@!" + encodeURIComponent(t7) + "*@!" + encodeURIComponent(t8) + "*@!" + encodeURIComponent(t9) + "*@!" + encodeURIComponent(t10) + "*@!" + encodeURIComponent(t11) + "*@!" + encodeURIComponent(t12);
						if (t12 == 3) { loadtrang('hienthinhacc', "khachhangbaocaooltim", poststr, ""); }
						else if (t12 == 4) { loadtrang('hienthinhacc', "khachhangbaocaotailen", poststr, ""); }
						else {
							loadtrang('hienthinhacc', "khachhangbaocaotim", poststr, "");
						}
						//alert('Luu xong !!!');
					}

					function xephang(t1, t2, t3, t4, t5, t6, t7, t8, t9, t10, t11) {
						poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(t2) + "*@!" + encodeURIComponent(t3) + "*@!" + encodeURIComponent(t4);
						poststr = poststr + "*@!" + encodeURIComponent(t5) + "*@!" + encodeURIComponent(t6) + "*@!" + encodeURIComponent(t7) + "*@!" + encodeURIComponent(t8) + "*@!" + encodeURIComponent(t9) + "*@!" + encodeURIComponent(t10);
						loadtrang('hienthinhacc', "khachhangxephang", poststr, "");
						//alert('Luu xong !!!');
					}



					function goidongthe() {
						document.getElementById("hiethithongbao").style.display = 'none';
					}


					function nhapexcel1() {
						if (document.getElementById('hiennhapexcel').style.display == "") {
							document.getElementById('hiennhapexcel').style.display = "none";
							document.getElementById('timkhachhanght').style.display = '';
							document.getElementById('timphieuxuat').style.display = 'none';
						}
						else {
							document.getElementById('hiennhapexcel').style.display = "";
							document.getElementById('timkhachhanght').style.display = 'none';
							document.getElementById('timphieuxuat').style.display = '';
						}


					}



					function goikhach(t1) {
						poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0);
						loadtrang('hienthihoso', "thongtinkhachhangmua", poststr, "xuly5");
					}

					function laydulieue() {
						poststr = "DATA=" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0);
						loadtrang('hienthiexcel', "khachhangbaocaohte", poststr, "");
					}

					function hienthidulieu() {
						var t1;
						//  t1=document.getElementById('idchuyen').value;
						poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(1);
						loadtrang('hienthiexcel', "khachhangbaocaohte", poststr, "");

					}

				</script>
			</div>
		</fieldset>
	</div>
	<div style="height:1500px"> </div>
</div>