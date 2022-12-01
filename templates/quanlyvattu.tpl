<form name="frmvattu" id="frmProduct1" method="post">
	<div class="nenbao">
		<fieldset class="nencon">
			<legend> <a style="cursor:pointer">
					<label style="Color:#FF3300;Font-Weight:Bold;Font-size:14px;">Quản Lý Tài Sản</label></a>
			</legend>
			<!-- BEGIN: block_cusht1 -->

			<b style="display:{q_them}"> [<a href="?act=taisannhapmoi&id=-1">Thêm Mới</a>]</b>&nbsp;&nbsp;&nbsp;[<a
				href="?act=md">Đóng Lại</a>] &nbsp;
			<div style="padding:5px">&nbsp;
				Số phiếu
				<input type="text" name="manv" id="manv" class="inpl" ondblclick="this.value=''" style="width:110px"
					onkeypress="return chuyentiep(event,'nhacct')" value="{manv}" />
				<!-- Cửa hàng
				<select onkeypress="return chuyentiep(event,'idnhan')" name="cuahangtim" id="cuahangtim"
					style="width:190px" title="cửa hàng">
					{tatca}
					{kho}
				</select>
				<select onkeypress="return chuyentiep(event,'idnhan')" name="tinhtrang" id="tinhtrang"
					style="width:90px" title="cửa hàng">
					<option value="">Tình trạng</option>
					<option {tinhtrang6} value="6">Mới tạo</option>
					<option {tinhtrang7} value="7">Xác nhận tài sản</option>
					<option {tinhtrang4} value="4">Kế toán xác nhận</option>
				</select> -->
				Ngày {tungay}
				<input title="Click đôi để xoá trắng" ondblclick="xoatrang(this)" type="text" name="tungay" id="tungay"
					class="text" style="width:67px" value="{tungay}" />
				<img src="images/img.gif" id="Lichtungaytao1" style="cursor: pointer; border: 0px solid red;"
					title="Date selector" onclick="displayCalendar(frmProduct1.tungay,'dd/mm/yyyy',this)" />
				đến
				<input title="Click đôi để xoá trắng" ondblclick="xoatrang(this)" type="text" name="denngay"
					id="denngay" class="text" style="width:67px" value="{denngay}" />
				<img src="images/img.gif" id="Lichtungaytao2" style="cursor: pointer; border: 0px solid red;"
					title="Date selector" onclick="displayCalendar(frmProduct1.denngay,'dd/mm/yyyy',this)" />
				<input type="submit" onfocus="setrong()" name="search" id="search" value="Tìm kiếm" />
			</div>

			<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbchuan">

				<tr bgcolor="#F8E4CB">
					<td align="center" height="23" width="38"><b>STT</b></td>
					<td width="75" align="center"><strong>Ngày Tạo</strong></td>
					<td width="80" align="center"><strong>Mã</strong></td>
					<td width="114" align="center"><strong>Tên</strong></td>
					<td align="center" height="23" width="38"><b>Nhóm vật tư</b></td>
					<td align="center" height="23" width="38"><b>Mã tài sản</b></td>
					<td width="136" align="center"><strong>Thông tin vật tư</strong></td>
					<td width="82" align="center"><strong>Ghi chú</strong></td>
					<td width="150" align="center"><strong>Mô tả</strong></td>
					<td width="36" align="center"><strong>Cập nhập </strong></td>
					<td width="39" align="center"><strong>Xóa</strong></td>
				</tr>
				<!-- END: block_cusht1 -->
				<!-- BEGIN: block_cusht -->
				<tr bgcolor="{color}">
					<td align="right">{stt}</td>
					<td>{ngaytao} </td>
					<td>{ma} </td>
					<td>{ten}</td>
					<td><strong>{nhomvattu}</strong></td>
					<td>{tentaisan} </td>
					<td>{mataisan} </td>
					<td>{ghichu}</td>
					<td>{mota}</td>
					<td align="center"> <a href="?act=taisannhapmoi&id={ID}"><img src="images/book_addressHS.png"
								border="0"></a> </td>
					<td align="center"> <a onclick='return ask()' {disable_button}
							href="?act=taisannhapmoi&Del={XOA}"><img src="images/delete.gif" border="0"></a></td>
				</tr>
				<!-- End: block_cusht -->

				<!-- BEGIN: block_cusht2 -->
			</table>
			<input type="hidden" name="currentPage" />
			<!-- End: block_cusht2 -->


			<!-- BEGIN: block_cus -->
			<div>
				<h3 style="text-align: center; color: red; font-weight: bold;">{t-c}</h3>
			</div>


			<div style="display: flex; justify-content: center;">
				<div style="width: 50%;">
					<div style="display: flex;  padding-bottom: 7px;">
						<div style="width: 100px;display: flex;align-items: center;">Mã phiếu</div>
						<div><input type="Text" onkeypress="return chuyentiep(event,'IDNhomcc')" readonly="readonly" name="ma" id="ma" class="text" size="20" value="{ma}" style="width: 384px;"></div>
					</div>
					<div>
						<div style="display: flex; padding-bottom: 7px;">
							<div style="width: 100px;display: flex;align-items: center;">
						Tên phiếu tài sản</div>
						<div><input type="Text" onkeypress="return chuyentiep(event,'IDNhomcc')" name="Name" id="Name" class="text" value="{Name}" style="width: 384px;">
						<strong style="color:#F00">*</strong></div>
						</div>
					</div>
					<div>
						<div style="display: flex;  padding-bottom: 7px;">
							<div style="width: 100px;display: flex;align-items: center;">Nhóm tài sản</div>
							<div><select name="nhomtaisan" id="nhomtaisan" onkeypress="return chuyentiep(event,'Rank')" style="width: 384px;">
								<option value="0">Nhóm ngành Gốc</option>
								{cay}</select></div>
						</div>
					</div>
					<div>
						<div style="display: flex;  padding-bottom: 7px;">
							<div style="width: 100px;display: flex;align-items: center;">Mô tả</div>
							<div><textarea id="mota" name="mota" class="texta" rows="3" cols="60">{mota}</textarea>
							<strong style="color:#F00">*</strong></div>
						</div>
					</div>
					<div>
						<div style="display: flex;  padding-bottom: 7px;">
							<div style="width: 100px;display: flex;align-items: center;">Ghi chú</div>
							<div><textarea id="mota" name="mota" class="texta" rows="3" cols="60">{mota}</textarea>
							<strong style="color:#F00">*</strong></div>
						</div>
					</div>
				</div>
				<div style="width: 50%;">
					<div>
						Hình ảnh
						<input type="file" name="hinhanh" id="hinhanh">
					</div>
				</div>
			</div>
			<div style="border-top: 1px solid black; padding-top: 10px;">
				<div>
					<td style="padding-left:5px" valign="top">
						<!-- chọn hàng hóa -->
						<div style="height:450px; margin-top:5px;">
							<fieldset style="padding-top:5px">
								<legend> 
									<a style="cursor:pointer" onClick="anhienform('chon')"><label style="Color:#5BB6E6;Font-Weight:Bold;Font-size:12pt">Chọn vật tư</label></a> 
								</legend>

							<div id="chon" style="line-height:28px"> <input onkeypress="return chuyentiep(event,'khachdua')" placeholder="Mã SP"
										autocomplete="off" type="text" name="codeprotk" id="codeprotk"
										onkeyup="goisp(this.value)" class="text" size="7" value=""
										ondblclick="this.value=''" />
									<input onkeypress="return chuyentiep(event,'codeprotk')"
										ondblclick="this.value=''" placeholder=" Tên SP " type="text" name="NameTK"
										id="NameTK" class="text" size="7" value="" />
									<input type="hidden" name="code" id="code" class="text" size="10" value="" />

									&nbsp;
									<input type="button" style="width:43px"
										onclick="timsanpham(NameTK.value,codeprotk.value,code.value,IDGrouptk.value,'',kho.value,mota.value)"
										name="search" id="search" value="Tìm" /> 
									
							</div>
							<div style="height:0px" id="cho"> </div>


								<div id="sanpham" style="padding-top:4px"> </div>
							</fieldset>


							<div style="padding-bottom:5px">
								<fieldset style="display:">
									<legend>
										<label style="Color:#5BB6E6;Font-Weight:Bold;Font-size:12pt">Vật tư đã chọn</label>
									</legend>
									<div>Tên VT:
										<input type="text" name="tensp" id="tensp" class="inpl" style="width:290px"
											readonly="" value="" />&nbsp;&nbsp;
										Mã VT: <input type="text" name="masp" id="masp" class="inpl"style="width:100px" readonly="" value="" /> 
										
										<input type="hidden" name="idsp" id="idsp" value="" />
										<input type="hidden" name="sl" id="sl" value="" />
										<input type="hidden" name="giachan" id="giachan" value="0" />
										<input type="hidden" name="giagiam" readonly="" id="giagiam" value="0" />
										<input type="hidden" name="giamgop" readonly="" id="giamgop" value="0" />
									</div>
									Giá <input type="text" name="dongia" id="dongia" maxlength="12" class="text"
										style="width:75px;" value="0" {giahienthi} onkeydow=" onlyinta(this)"
										onkeyup="return chuyentiep(event,'soluong')" onkeypress="txtFormata(this)"
										onblur="txtFormat(this)" />&nbsp;
									
									Số lượng <input type="text" name="soluong" id="soluong" onkeyup="return chuyentieps(event,'chietkhau')" class="text" style="width:35px" value="1" />
								
									<b ondblclick="setchietkhauchung(chietkhau.value)">Chiết khấu</b>
									<input name="chietkhau" ondblclick="this.value=0" id="chietkhau" value=""
										type="text" style="width: 40px;" />
									&nbsp;

									Ghi chú:
									<input type="text" autocapitalize="none" autocomplete="off" autocorrect="off" required="" name="ghichu" id="ghichu"  style="width:200px" value="" />
									<input type="button" name="add" id="add" style="width:50px"
										onclick="addpro(idsp.value,tensp.value,masp.value,dongia.value,loaitien.value,soluong.value,chietkhau.value,ghichu.value,giachan.value,mt.value,giagiam.value,giamgop.value,sl.value)"
										value="Chọn" onkeyup="return chuyentiep(event,'NameTK')" />
								</fieldset>
							</div>
							<div style=" max-height:350px;overflow:scroll">

								<div id="sanphamxuat">
									<table width="100%" border="0" cellpadding="0" cellspacing="0">
										<tr bgcolor="#F8E4CB">
											<td width="29" align="center"  height="23"><b>STT</b>												</td>
											<td width="115" align="center" ><strong>Mã vật tư
												</strong></td>
											<td width="310" align="center" ><strong>Tên vật tư</strong></td>
											<td width="48" align="center" ><strong>Số lượng</strong></td>
											<td width="152" align="center" ><strong>Giá</strong></td>
											<td width="51" align="center" ><strong>CK</strong></td>
											<td width="164" align="center" ><strong>Thành Tiền
												</strong></td>
											<td width="250" align="center" ><strong>Ngày mua</strong></td>
											<td width="250" align="center" ><strong>Ngày hết hạn</strong></td>
											<td width="250" align="center" ><strong>Ghi Chú</strong></td>
											<td width="45" align="center" ><strong>X&#243;a</strong></td>
										</tr>
										<tr bgcolor="{color}">
											<td >&nbsp;</td>
											<td >&nbsp;</td>
											<td >&nbsp;</td>
											<td >&nbsp;</td>
											<td >&nbsp;</td>
											<td >&nbsp;</td>
											<td >&nbsp;</td>
											<td >&nbsp;</td>
											<td >&nbsp;</td>
										</tr>
									</table>
								</div>
							</div>
						</div>						</td>
				</div>
				<div>
					<input type="button" onfocus="setrong()" onclick="luutaisan()" {disable_button} class="text"
						name="btnUpdate" id="btnUpdate" value="Lưu Phiếu">
					&nbsp; <input type="submit" class="text" name="cancel" id="cancel" value="Làm lại" />
					&nbsp;<input type="button" name="inan2" id="inan2" onclick="window.close()" value="Đóng Lại"
						style="width:80px;display:{donglai}" />
					<b style="display:{q_them}"> [<a href="?act=taisannhapmoi">quay lại</a>]</b>
				</div>
			</div>


		</fieldset>
	</div>

	<div id="ketqualuu"> </div>
</form>

<script language="javascript">
	document.getElementById('type1').focus();
</script>
<!-- END: block_cus -->

<div id="khonghienthi" style="display:none"></div>


<!-- BEGIN: block_cusupdate -->
<script language="JavaScript">
	alert('Cập nhập thành công');
	location.replace("?act=taisannhapmoi");
</script>
<!-- END: block_cusupdate -->

<!-- BEGIN: block_delsuccess -->
<script language="JavaScript">
	alert('Đã xoá thành công');
</script>
<!-- END: block_delsuccess -->

<!-- BEGIN: block_khongxoa -->
<script language="JavaScript">
	alert('Bạn không thể xóa cửa hàng này do đã có thông tin liên quan đến cửa hàng này!!! ');
</script>
<!-- END: block_khongxoa -->


<script src="js/jquery-1.7.2.min.js"></script>
<script src="js/select2.min.js"></script>
<script src="templates/taisannhapmoi.js"></script>
<link rel="stylesheet" media="screen" href="js/select2.min.css">

<script language="JavaScript">

	$(document).ready(function () {
		$('.js-nv').select2();

	});
	//============================================================

	var capnhap = '';


	function ask() {
		var n = confirm("Bạn có muốn xóa không");
		if (n == false) {
			return false;

		}
	}
	//=======================



	function timkiem() {
		document.getElementById('search').value = "search";
		document.forms.frmProduct1.submit();
	}
	function settype(valu) {
		document.getElementById('dachon').value = valu;
	}


	function kiemtra() {
		//   if (capnhap != '') { return false ;}
		if (document.getElementById('nhanvien').value == "") {
			alert('Bạn chưa chọn nhân viên');
			document.getElementById('nhanvien').focus();
			return false;
		}
		if (document.getElementById('thoigianbatdau').value == "") {
			alert('Bạn chưa nhập thời gian bắt đầu !');
			document.getElementById('thoigianbatdau').focus();
			return false;
		}
		if (document.getElementById('thoigianketthuc').value == "") {
			alert('Bạn chưa nhập thời gian kết thúc !');
			document.getElementById('thoigianketthuc').focus();
			return false;
		}

		if (document.getElementById('lydo').value == "") {
			alert('Bạn chưa nhập lý do !');
			document.getElementById('lydo').focus();
			return false;
		}

		return true;
	}

</script>