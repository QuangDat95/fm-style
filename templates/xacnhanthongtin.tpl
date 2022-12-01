<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<div class="nenbao">
	<div style="padding:1px">
		<fieldset class="nencon">
			<legend> <a style="cursor:pointer">
					<label style="Color:#FF3300;Font-Weight:Bold;Font-size:15pt;">Danh Sách Thông Tin CT Sinh Viên</label>
				</a></legend>
			<div>

				<!-- BEGIN: block_cusht1 -->

				<!-- <form name="xuatketqua" id="xuatketqua" action="xuatfile.php" method="post" target="_blank">
					<input name="noidung" id="noidung" type="hidden" value="Chưa chọn dữ liệu">
					<input name="tenfile" id="tenfile" type="hidden" value="thongtinkhachhang.xls">
					<input name="loaifile" id="loaifile" type="hidden" value="application/vnd.ms-excel">
				</form> -->

				<form name="frmProduct1" method="post">

					<div>
						<b style="display:{q_them}"> [ <a href="default.php?act=customer&id=-1">Thêm
								Mới</a>]&nbsp;&nbsp;</b>[<a href="default.php?act=md">Đóng Lại</a>]&nbsp;
						<div style="padding:5px">


							<input type="text" name="soct" placeholder="Số Chứng Từ" ondblclick="this.value=''" id="soct" class="inpl" style="width:200px" value="" />
							&nbsp;
							<select onkeypress="return chuyentiep(event,'idnhan')" class="js-ch" name="cuahang"
								id="cuahang" style="width:120px" title="cửa hàng">
								{tatca}
								{cuahangnhan}
							</select>
							
							<input type="button" style="width:37px"
								onclick="timkiemkh(ten.value,dt.value,ma.value,cuahang.value,cm.value,'',sapxep.value ,tungay.value,denngay.value,tinh.value,trendiem.value)"
								name="search5" id="search5" value="Tìm" />

							<!-- <input type="button" style="width:30px"
								onclick="timthongke(ten.value,dt.value,ma.value,cuahang.value,cm.value,'',sapxep.value ,tungay.value,denngay.value,tinh.value)"
								name="search2" id="search2" value="TK" title="Thống kê số lượng khách theo cửa hàng" />
							&nbsp;
							<input type="button" style="width:56px"
								onclick="timthongkediem(ten.value,dt.value,ma.value,cuahang.value,cm.value,'',sapxep.value ,tungay.value,denngay.value,tinh.value,trendiem.value)"
								name="search" id="search" value="TK điểm" />

							<input type="button" style="  width: 40px;" id="xuat" value="Excel" name="xuat"
								onclick="xuatkq()" /> -->
						</div>
					</div>
					<div id="hienthinhacc">

						<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr bgcolor="#F8E4CB">
								<td align="center" class="cothienthi" height="23" width="33"><b>STT</b></td>
								<td width="345" align="center" class="cothienthi"><strong>Tên khách khàng </strong></td>
								<td width="362" align="center" class="cothienthi"><strong><strong><strong>Địa chỉ
											</strong></strong></strong> </td>
								<td width="153" align="center" class="cothienthi"><strong><strong>Số
											xe</strong></strong></td>
								<td width="160" align="center" class="cothienthi"><strong>Điện Thoại </strong></td>
								<td width="178" align="center" class="cothienthi"><strong><strong>Email</strong>
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
				</form>
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
										document.title = "Thêm Khách Hàng";
									}
									setTimeout('doititle()', 500);
								}
							}
						</script>

						<input name="dachon" type="hidden" id="dachon" value="{type}" /> <input name="id" id="id"
							type="hidden" value="{ID}" />

						<table width="100%" border="0">




							<tr>
								<td width="17%">Nguồn khách hàng</td>
								<td>


									<select onkeypress="return chuyentieps(event,'Name')" name="nhomkh" id="nhomkh">
										<option value="0">Chưa xác định</option>
										{nhomkh}
									</select>
								</td>
								<td align="right">Mã KH </td>
								<td><input type="Text" name="makh" id="makh" class="text" size="8" value="{makh}"
										autocomplete="off" onkeypress="return chuyentiep(event,'Name')" /></td>
							</tr>
							<tr>
								<td width="17%">
									Tên Khách </td>
								<td colspan="3"><input type="Text" name="Name" id="Name" class="text"
										style="width:415px" value="{Name}"
										onkeypress="return chuyentiep(event,'ngaysinh')" />
									<span style="color:#FF0000">*</span>
								</td>
							</tr>
							<tr>
								<td width="17%">Ngày Sinh </td>
								<td><input type="text" name="ngaysinh" id="ngaysinh" onblur="checkDate(this.value)"
										class="text" size="12" value="{ngaysinh}"
										onkeypress="return chuyentiep(event,'xungho')" />
									<img src="images/img.gif" id="Lichtungaytao"
										style="cursor: pointer; border: 0px solid red;" title="Date selector"
										onclick="displayCalendar(frmProduct2.ngaysinh,'dd/mm/yyyy',this)" /><span
										style="color:#FF0000">*</span>
								</td>
								<td width="11%" align="right">&nbsp; </td>
								<td>&nbsp;</td>
							</tr>

							<tr>
								<td width="17%">Giới tính</td>
								<td width="44%"><span style="padding-bottom:10px">
										<select onkeypress="return chuyentiep(event,'tel')" name="xungho" id="xungho">
											<option value="0">Chưa xác định</option>
											<option {xungho1} value="1">Nam</option>
											<option {xungho2} value="2">Nữ</option>
										</select>
										<span style="color:#FF0000">*</span></span></td>

								<td width="11%" align="right">&nbsp; </td>
								<td width="28%">&nbsp; </td>
							</tr>

							<tr>
								<td width="17%">Số ĐT</td>
								<td width="44%"><input type="Text" name="tel" id="tel" autocomplete="off" class="text"
										size="20" value="{tel}" onblur="kiemtradung(this.value)"
										onkeydown="onlyintc(this)" onkeypress="return chuyentiep(event,'IDKhuVuc')" />
									<span style="color:#FF0000">*</span>
								</td>

								<td width="11%" align="right">&nbsp;</td>
								<td width="28%">&nbsp;</td>
							</tr>
							<tr>
								<td width="17%">Địa chỉ </td>
								<td width="44%"><span style="padding-bottom:10px">
										<input type="text" id="address" name="address" class="text" style="width:515px"
											value="{address}" onkeypress="return chuyentiep(event,'tel')" />
										<span style="color:#FF0000"> </span></span></td>

								<td width="11%" align="right">&nbsp; </td>
								<td width="28%">&nbsp; </td>
							</tr>
							<tr>
								<td width="17%">Tỉnh Thành</td>
								<td width="44%">

									<select class="js-tinh" id="IDKhuVuc" name="IDKhuVuc" style="width:200px">
										<option value="">vui lòng chọn tỉnh</option>
										{tinh}

									</select>
									<span style="color:#FF0000">*</span> Quận/Huyện
									<select class="js-quan" name="quan" id="quan" disabled="disabled"
										style="width:200px">
										{quan}
									</select>
								</td>

								<td width="11%" align="right">&nbsp; </td>
								<td width="28%">&nbsp; </td>
							</tr>
							<tr>
								<td width="17%">Phường xã </td>
								<td width="44%"><select class="js-phuong" name="phuong" id="phuong" disabled="disabled"
										style="width:200px">

										{phuong}

									</select> </td>

								<td width="11%" align="right">&nbsp; </td>
								<td width="28%">&nbsp; </td>
							</tr>

							<tr>
								<td width="17%">&nbsp;</td>
								<td>&nbsp;</td>
								<td width="11%" align="right">&nbsp; </td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td>Điểm Tích lũy </td>
								<td><input type="text" name="diemtichluy" id="diemtichluy" class="text" size="10"
										value="{diemtichluy}" onkeypress="return chuyentiep(event,'nganhang')" /></td>
								<td align="right">Số tiền đã mua </td>
								<td><input type="text" name="sotiendamua" id="sotiendamua" readonly="" class="text"
										size="15" value="{sotiendamua}"
										onkeypress="return chuyentiep(event,'nganhang')" /></td>
							</tr>


							<tr>
								<td>Chi chú </td>
								<td colspan="3"><textarea id="note" name="note" class="texta"
										style='width:650px;height:70px'>{note}</textarea></td>
							</tr>
						</table>
						<br />


						<div style="padding-left:105px;padding-bottom:8px">
							<input type="Submit" onfocus="setrong()" onclick="return kiemtra()" class="text"
								id="btnUpdate" name="btnUpdate" value="Cập nhập" />
							<input type="button" onclick="quaylai()" name="cancel2" style="width:200px"
								value="Quay lại danh sách khách hàng" />


							<input type="button" name="inan2" id="inan2" onclick="window.close()" value="Đóng Lại"
								style="width:80px;display:{donglai}" />
						</div>
					</fieldset>



				</form>
				<div id="khonghienthi" style="display:none"></div>

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
					alert('Cập nhập khách hàng thành công');
					location.replace("default.php?act=customer");
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
							/* console.log('Selecting: ' , e.params.args.data.id);
							 return;*/
							tinh = e.params.args.data.id;
							var poststr = "TINH=" + encodeURIComponent(e.params.args.data.id) + "*@!";

							loadtrang('khonghienthi', "ajaxtinhthanh", poststr, "xuly9");
						});

						$('.js-quan').on('select2:selecting', function (e) {
							var poststr = "THANH=" + encodeURIComponent(tinh) + "*@!" + encodeURIComponent(e.params.args.data.id);
							loadtrang('khonghienthi', "ajaxtinhthanh", poststr, "xuly8");
						});
					});
					function xuly9() {

						var tam = document.getElementById('khonghienthi').innerHTML;
						//console.log(tam);

						var quan = document.getElementById("quan");

						if (tam != "") {

							quan.innerHTML = tam;
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
						location.replace("default.php?act=customer");
					}
					//=======================
					function settype(valu) {
						document.getElementById('dachon').value = valu;

					}
					function kiemtra() {
						// if (capnhap != '') { return false ;}

						if (document.getElementById('nhomkh').value == "0") {
							alert('Bạn chưa chọn nhóm khách hàng');
							document.getElementById('nhomkh').focus();
							return false;
						}

						if (document.getElementById('Name').value == "") {
							alert('Bạn chưa nhập tên khách hàng');
							document.getElementById('Name').focus();
							return false;
						}
						if (document.getElementById('makh').value == "") {
							alert('Bạn chưa nhập mã khách hàng');
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
							alert('Bạn chưa nhập ngày sinh khách hàng');
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
					alert('Bạn không thể xóa khách hàng này do đã có nơi sử dụng  rồi !!! ');
				</script>
				<!-- END: block_khongxoa -->
			</div>
		</fieldset>
	</div>
</div>
