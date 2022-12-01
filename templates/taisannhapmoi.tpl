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
				Mã NV
				<input type="text" name="manv" id="manv" class="inpl" ondblclick="this.value=''" style="width:110px"
					onkeypress="return chuyentiep(event,'nhacct')" value="{manv}" />
				Cửa hàng
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
				</select>
				Ngày {tungay}
				<input title="Click đôi để xoá trắng" ondblclick="xoatrang(this)" type="text" name="tungay" id="tungay" class="text" style="width:67px" value="{tungay}" />
				<img src="images/img.gif" id="Lichtungaytao1" style="cursor: pointer; border: 0px solid red;"
					title="Date selector" onclick="displayCalendar(frmProduct1.tungay,'dd/mm/yyyy',this)" />
				đến
				<input title="Click đôi để xoá trắng" ondblclick="xoatrang(this)" type="text" name="denngay" id="denngay" class="text" style="width:67px" value="{denngay}" />
				<img src="images/img.gif" id="Lichtungaytao2" style="cursor: pointer; border: 0px solid red;" title="Date selector" onclick="displayCalendar(frmProduct1.denngay,'dd/mm/yyyy',this)" />
				<input type="submit" onfocus="setrong()" name="search" id="search" value="Tìm kiếm" />
			</div>

			<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbchuan">

				<tr bgcolor="#F8E4CB">
					<td align="center" height="23" width="38"><b>STT</b></td>
					<td width="75" align="center"><strong>Ngày Tạo</strong></td>
					<td width="80" align="center"><strong>Ngày Duyệt</strong></td>
					<td width="154" align="center"><strong>Tên Của Hàng</strong></td>
					<td width="80" align="center"><strong>Mã NV </strong></td>
					<td width="114" align="center"><strong>Tên NV </strong></td>
					<td align="center" height="23" width="38"><b>Tên tài sản</b></td>
					<td align="center" height="23" width="38"><b>Mã tài sản</b></td>
					<td width="136" align="center"><strong>Thông tin tài sản</strong></td>
					<td width="82" align="center"><strong>Tình trạng</strong></td>
					<td width="150" align="center"><strong>Lý do</strong></td>
					<td width="36" align="center"><strong>Cập nhập </strong></td>
					<td width="39" align="center"><strong>Xóa</strong></td>
				</tr>
				<!-- END: block_cusht1 -->
				<!-- BEGIN: block_cusht -->
				<tr bgcolor="{color}">
					<td align="right">{stt}</td>
					<td>{ngaytao} </td>
					<td>{ngaykhoa} </td>
					<td>{tencuahang} </td>
					<td>{MaNV}</td>
					<td><strong>{tennhanvien}</strong></td>
					<td>{tentaisan} </td>
					<td>{mataisan} </td>
					<td>Số lượng: {soluong} -- Giá cả: {gia} <br /> Người gửi: {nguoichi} -- Người nhận: {nguoinhan}
					</td>
					<td>{tinhtrang}</td>
					<td>{lydo}</td>
					<td align="center"> <a href="?act=taisannhapmoi&id={ID}"><img src="images/book_addressHS.png"
								border="0"></a> </td>
					<td align="center"> <a onclick='return ask()' {disable_button} href="?act=taisannhapmoi&Del={XOA}"><img
								src="images/delete.gif" border="0"></a></td>
				</tr>
				<!-- End: block_cusht -->

				<!-- BEGIN: block_cusht2 -->
			</table>
			<input type="hidden" name="currentPage" />
			<!-- End: block_cusht2 -->


			<!-- BEGIN: block_cus -->

			<table width="" cellpadding="2" cellspacing="2" class="tbthu">
				<tr>
					<h3 style="text-align: center; color: red; font-weight: bold;">{t-c}</h3>
				</tr>
				<tr>
					<td>Ngày chứng từ </td>
					<td>
						<input onkeyup="return chuyentiep(event,'sochungtu')" type="text" name="ngay" id="ngay"
							class="text" style="width:68px" value="{ngaychungtu}" />
						<img src="images/img.gif" alt="" id="Lichtungaytao"
							style="cursor: pointer; border: 0px solid red;" title="Date selector"
							onclick="displayCalendar(frmTaiSan.ngay,'dd/mm/yyyy',this)" /><span
							style="color:#FF0000">*</span>
						<select onkeypress="return chuyentieps(event,'ngay')" name="cuahang" id="cuahang"
							style="width:160px">

							{cuahang}
							{tatca}

						</select>
					</td>

				</tr>

				<tr>
					<td width="14%">
						Mã tài sản</td>
					<td width="86%">
						<input type="Text" onkeypress="return chuyentiep(event,'IDNhomcc')" readonly="readonly"
							name="ma" id="ma" class="text" size="20" value="{ma}">
						<input id="idts" name="idts" value="{idts}" type="hidden" />
						<input id="ghichuluu" name="ghichuluu" value="{note2}" type="hidden" />
						Sẽ tự nhảy
						<input id="idgoi" name="idgoi" value="{idgoi}" type="hidden" />
					</td>
				</tr>
				<tr>
					<td width="14%">
						Tên tài sản </td>
					<td width="86%">
						<input type="Text" onkeypress="return chuyentiep(event,'IDNhomcc')" name="Name" id="Name"
							class="text" size="70" value="{Name}">
						<strong style="color:#F00">*</strong>
					</td>
				</tr>
				<tr>
					<td width="14%">Lý do </td>
					<td width="86%">
						<input type="Text" onkeypress="return chuyentiep(event,'IDNhomcc')" name="mota" id="mota"
							class="text" size="70" value="{mota}">
						<strong style="color:#F00">*</strong>
					</td>
				</tr>
				<tr>
					<td width="14%"> Loại Tài sản </td>
					<td width="86%">
						<select name="type" id="type" onkeypress="return chuyentiep(event,'Rank')" style="width:200px">
							<option value="1" {type1}>TSCD</option>
							<option value="2" {type2}>TTNH </option>
							<option value="3" {type3}>Tài sản TTDH</option>
							<option value="4" {type4}>Tài sản khác</option>
						</select>
						Nhóm Tài sản <select name="nhomtaisan" id="nhomtaisan" style="display:"
							onkeypress="return chuyentiep(event,'Rank')">
							<option value="0">Nhóm ngành Gốc</option>
							{cay}
						</select>
					</td>
				</tr>

				<tr style="display:none">
					<td>Mô tả sản phẩm</td>
					<td><input type="text" onkeypress="return chuyentiep(event,'IDNhomcc')" name="mota" id="mota"
							class="text" style="width:497px" value="{mota}" /></td>
				</tr>
				<tr>
					<td width="14%">Số lượng</td>
					<td width="86%"><input type="number" onkeypress="return chuyentiep(event,'IDNhomcc')" name="soluong"
							id="soluong" class="text" size="4" value="{soluong}" style="width:60px" /> <strong
							style="color:#F00">*</strong>&nbsp; Đơn Giá :

						<input type="text" name="gia" id="gia" maxlength="12" style="width:80px;"
							onkeyup="formatchuan(this)" onblur="txtFormat(this)"
							onkeydown="return chuyentiep(event,'donvitinh')" value="{gia}" />
						<strong style="color:#F00">* </strong>( Giá của một sản phẩm )
					</td>
				</tr>
				<tr>
					<td width="14%">Đơn vị tính</td>
					<td width="86%"><select name="donvitinh" id="donvitinh" onkeypress="return chuyentiep(event,'Rank')"
							style="width:200px">
							<option value="0">Vui lòng chọn </option>
							<option {donvi1} value="1">Test </option>
							<option {donvi3} value="3">Cái</option>
							<option {donvi2} value="2">Bộ </option>
							<option {donvi4} value="4">Mảnh </option>
							{donvitinh}


						</select>
						<strong style="color:#F00">*</strong>
					</td>
				</tr>
				<tr style="display:none">
					<td width="14%">Người nhận TS</td>
					<td width="86%">
						<select name="nguoinhants" id="nguoinhants" class="js-khachhang"
							onkeypress="return chuyentiep(event,'Rank')" style="width:300px">
							<option value="0">Vui lòng chọn </option>
							{nguoinhants}
						</select>
						<strong style="color:#F00">*</strong>
						<input type="text" onkeypress="return chuyentiep(event,'IDNhomcc')" name="nguoigiao"
							id="nguoigiao" class="text" style="width:197px;display:none" value="{nguoigiao}" />
					</td>
				</tr>
				<tr>
					<td width="14%">Ngày mua TS</td>
					<td width="86%"><input type="text" onkeypress="return chuyentiep(event,'IDNhomcc')"
							name="ngaybatdau" id="ngaybatdau" class="text" style="width:80px" value="{ngaybatdau}" />
						<span style="padding-bottom:10px"><img src="images/img.gif" id="Lichtungaytao"
								style="cursor: pointer; border: 0px solid red;" title="Date selector"
								onclick="displayCalendar(frmTaiSan.ngaybatdau,'dd/mm/yyyy',this)" /></span>&nbsp;<strong
							style="color:#F00">*</strong> Ngày kết thúc
						<input type="text" onkeypress="return chuyentiep(event,'IDNhomcc')" name="ngayketthuc"
							id="ngayketthuc" class="text" style="width:80px" value="{ngayketthuc}" />
						<span style="padding-bottom:10px"><img src="images/img.gif" id="Lichtungaytao2"
								style="cursor: pointer; border: 0px solid red;" title="Date selector"
								onclick="displayCalendar(frmTaiSan.ngayketthuc,'dd/mm/yyyy',this)" /></span>
					</td>
				</tr>

				<tr style="display:none">
					<td width="14%">Thời gian bảo hành</td>
					<td width="86%"><input type="number" onkeypress="return chuyentiep(event,'IDNhomcc')" name="baohanh"
							style="width:50px" id="baohanh" class="number" size="2" value="{baohanh}" />
						( Tính theo tháng - Ngoại lệ nhập ghi chú) </td>
				</tr>

				<tr>
					<td>Diễn giải </td>
					<td><textarea id="note2" name="note2" class="texta"
							style='width:550px;height:115px'>{note2}</textarea>
						<strong>* Tình trạng:  (Mới 100% / Đã qua sử dụng)</strong>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td height="26" colspan="2">
						<input type="button" onfocus="setrong()" onclick="luutaisan()" {disable_button} class="text" name="btnUpdate"
							id="btnUpdate" value="Lưu Phiếu">
						&nbsp; <input type="submit" class="text" name="cancel" id="cancel" value="Làm lại" />
						&nbsp;<input type="button" name="inan2" id="inan2" onclick="window.close()" value="Đóng Lại"
							style="width:80px;display:{donglai}" />
						<b style="display:{q_them}"> [<a href="?act=taisannhapmoi">quay lại</a>]</b>
					</td>
				</tr>
			</table>


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