<style>
	.loaicapnhathidden {
		display: none !important;
	}

	.loaicapnhatshow {
		display: table-row !important;
	}
</style>

<form name="frmProduct1" id="frmProduct1" method="post">
	<div class="nenbao">
		<fieldset class="nencon">
			<legend> <a style="cursor:pointer">
					<label style="Color:#FF3300;Font-Weight:Bold;Font-size:9pt;">Phiếu đề xuất xử lý</label></a>
			</legend>
			<!-- BEGIN: block_cusht1 -->
			<b style="display:{q_them}"> [<a href="default.php?act=yeucaucapnhat&id=-1">Thêm
					Mới</a>]</b>&nbsp;&nbsp;&nbsp;[<a href="default.php?act=md">Đóng Lại</a>] &nbsp;
			<div style="padding:5px">&nbsp; Số phiếu
				<input type="text" name="sophieut" id="sophieut" class="inpl" ondblclick="this.value=''"
					style="width:90px" onkeypress="return chuyentiep(event,'sohoadon')" value="" />
				NV tư vấn
				<input type="text" name="tuvan" id="tuvan" class="inpl" ondblclick="this.value=''" style="width:110px"
					onkeypress="return chuyentiep(event,'nhacct')" value="" />
				Cửa hàng
				<select onkeypress="return chuyentiep(event,'idnhan')" name="cuahangtim" id="cuahangtim"
					style="width:190px" title="cửa hàng">
					{tatca}
					{kho}
				</select>
				<select onkeypress="return chuyentiep(event,'idnhan')" name="cuahangtim2" id="cuahangtim2"
					style="width:90px" title="cửa hàng">
					<option value=""></option>
					<option value="0">Chưa duyệt</option>
					<option value="1">Đã duyệt</option>
				</select> Ngày
				<input onkeypress="return chuyentiep(event,'denngay')" title="Click đôi để xoá trắng"
					ondblclick="xoatrang(this)" type="text" name="tungay" id="tungay" class="text" style="width:65px"
					value="{tungay}" />
				<img src="images/img.gif" id="Lichtungaytao2" style="cursor: pointer; border: 0px solid red;"
					title="Date selector" onclick="displayCalendar(frmProduct1.tungay,'dd/mm/yyyy',this)" />đến<input
					onkeypress="return chuyentiep(event,'denngay')" title="Click đôi để xoá trắng"
					ondblclick="xoatrang(this)" type="text" name="denngay" id="denngay" class="text" style="width:65px"
					value="{denngay}" /><img src="images/img.gif" id="Lichtungaytao2"
					style="cursor: pointer; border: 0px solid red;" title="Date selector"
					onclick="displayCalendar(frmProduct1.denngay,'dd/mm/yyyy',this)" />
				<input type="submit" onfocus="setrong()" name="search" id="search" value="Tìm kiếm" />
			</div>

			<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbchuan">

				<tr bgcolor="#F8E4CB">
					<td align="center" height="23" width="45"><b>STT</b></td>
					<td width="81" align="center"><strong>Ngày Tạo</strong></td>
					<td width="81" align="center"><strong>Ngày Duyệt</strong></td>
					<td width="79" align="center"><strong>Số Phiếu </strong></td>
					<td width="199" align="center"><strong>Tên Của Hàng</strong></td>
					<td width="134" align="center"><strong>Thông tin cần đổi</strong></td>
					<td width="131" align="center"><strong>Thông tin đúng</strong></td>
					<td width="217" align="center"><strong>Lý do</strong></td>
					<td width="91" align="center"><strong>Tình trạng</strong></td>
					<td width="37" align="center"><strong>Cập nhập </strong></td>
					<td width="34" align="center"><strong>Xóa</strong></td>
				</tr>
				<!-- End: block_cusht1 -->
				<!-- BEGIN: block_cusht -->
				<tr bgcolor="{color}">
					<td align="right">{stt}</td>
					<td>{ngaytao} </td>
					<td>{ngayduyet} </td>
					<td>{sochungtu} </td>
					<td>{tencuahang} </td>
					<td>{tuvansai} </td>
					<td>{tuvandung} </td>

					<td>{lydo} </td>
					<td>{tinhtrang} </td>
					<td align="center"> <a href="default.php?act=yeucaucapnhat&id={ID}"><img
								src="images/book_addressHS.png" border="0"></a> </td>

					<td align="center"
						style="border:solid windowtext 1.0pt;display:{q_xoa}; mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">
						<a onclick='return ask()' href="default.php?act=yeucaucapnhat&Del={XOA}"><img
								src="images/delete.gif" border="0"></a></td>
				</tr>
				<!-- End: block_cusht -->

				<!-- BEGIN: block_cusht2 -->
				<tr style="padding-top:10">
					<td align="right" colspan="10"> {list_page}</td>
				</tr>
			</table>
			<input type="hidden" name="currentPage" />
			<!-- End: block_cusht2 -->


			<!-- BEGIN: block_cus -->

			<table width="100%" border="0" cellpadding="5">
				<tr>
					<td colspan="2" align="center" style="color:#FF6600;padding-bottom:10px">
						<h3>{t-c}</h3><input name="id" id="id" type="hidden" value="{idgoi}" />
					</td>
				</tr>

				<tr>
					<td width="14%">
						Loại cập nhật </td>
					<td width="86%">
						<strong>{tencuahang} </strong>
						<select onkeypress="return chuyentiep(event,'search')" name="loaicapnhat" class="js-loaicapnhat"
							id="loaicapnhat" style="width:360px" onchange="chonloaicapnhat(event)">
							<option value="">Chọn loại</option>
							<option value="20" {loaidse20}>Phục hồi phiếu tăng ca</option>
							<option value="21" {loaidse21}>Phục hồi phiếu bù giờ</option>
							<option value="22" {loaidse22}>Hủy giờ quét đi làm sai</option>
							<option value="23" {loaidse23}>Hủy giờ quét tăng ca sai</option>
						</select>
					</td>
				</tr>
				<tr>
					<td width="14%">
						Tên của hhàng </td>
					<td width="86%">
						<strong>{tencuahang} </strong> <!-- BEGIN: block_admin -->
						<select onkeypress="return chuyentiep(event,'search')" name="cuahang" id="cuahang" class="js-ch"
							style="width:360px">
							<option value="">Chọn cửa hàng</option>
							{kho}
						</select>
						<!-- END: block_admin -->

						<!-- BEGIN: block_cuahang -->
						<input id="cuahang" name="cuahang" type="hidden" value="{cuahang}" />
						<!-- END: block_cuahang -->
					</td>
				</tr>


				<tr class=" " id="loaicapnhat5">
					<td width="14%" id="capnhatphieu">Số phiếu </td>
					<td width="86%"><input type="Text" onkeypress="return chuyentiep(event,'IDTinh')" name="sochungtu"
							id="sochungtu" onblur="kiemtraphieuthuchi(this.value,loaicapnhat.value)" class="text"
							size="15" {capnhapct} value="{sochungtu}" /> &nbsp; &nbsp; <span id="thongtinthuchi"></span>
						<input type="hidden" onkeypress="return chuyentiep(event,'IDTinh')" name="ngaytaophieu"
							id="ngaytaophieu" onblur="" class="text" size="15" {capnhapct} value="{ngaytaophieu}" />
					</td>
				</tr>


				<tr class="loaicapnhat loaicapnhathidden {loaisai2}" id="loaicapnhat2">
					<td width="14%">Chọn tư vấn đúng</td>
					<td width="86%">

						<select onkeypress="return chuyentiep(event,'search')" class="js-nv js-loaicapnhatinput"
							name="tuvandung" id="tuvandung" style="width:360px">
							<option value="">Chọn tư vấn đúng</option>
							<option value="-2">Trả lại</option>
							{nhanvienonline}

						</select>
						<input id="tuvansai" name="tuvansai" type="hidden" value="0" />
						<input id="chonggoilai" name="chonggoilai" type="hidden" value="{chonggoilai}" />
						<input id="idcuahang" name="idcuahang" type="hidden" value="{idcuahang}" />
					</td>
				</tr>

				<tr class="loaicapnhat loaicapnhathidden {loaisai17}" id="loaicapnhat17">
					<td width="14%">Chọn khách hàng</td>
					<td width="86%">
						<input id="tel" name="tel" type="text" value="{tel}"
							onblur="kiemtraphieuthuchi(this.value,loaicapnhat.value)" placeholder="Điện thoại đúng" />
						&nbsp; <span id="tenkhachhang"></span>
					</td>
					<input id="khachhangdung" name="khachhangdung" type="hidden" value="{khachhangdung}" />
					<input id="khachhangsai" name="khachhangsai" type="hidden" value="" />
					<input id="chonggoilai" name="chonggoilai" type="hidden" value="{chonggoilai}" />
					<input id="idcuahang" name="idcuahang" type="hidden" value="{idcuahang}" /></td>
				</tr>
				<tr class="loaicapnhat loaicapnhathidden {loaisai3}" id="loaicapnhat3">
					<td width="14%">Chọn lý do</td>
					<td width="86%">

						<select onkeypress="return chuyentiep(event,'search')" class="js-lydo js-loaicapnhatinput"
							name="lydodung" id="lydodung" style="width:360px">
							<option value="">Chọn lý do</option>

							{lydocp}

						</select>
						<input id="lydosai" name="lydosai" type="hidden" value="0" />
					</td>
				</tr>

				<tr class="loaicapnhat loaicapnhathidden {loaisai1}" id="loaicapnhat1">
					<td width="14%">Chọn target</td>
					<td width="86%">

						<select onkeypress="return chuyentiep(event,'search')" class="js-target js-loaicapnhatinput"
							name="targetdung" id="targetdung" style="width:360px">
							<option value="">Chọn target</option>
							<option value="0">Không có taget</option>
							{nhanvienhethong}
						</select>
						<input id="targetsai" name="targetsai" type="hidden" value="0" />
					</td>
				</tr>

				<tr class="loaicapnhat loaicapnhathidden {loaisai4}" id="loaicapnhat4">
					<td width="14%">Ghi chú</td>
					<td width="86%">

						<textarea name="ghichu" id="ghichu" class="loaicapnhatinput">{ghichu}</textarea>
						<input id="ghichusai" name="ghichusai" type="hidden" value="0" />
					</td>
				</tr>
				<!--<tr class="loaicapnhat loaicapnhathidden {loaisai5}" id="loaicapnhat5">
	<td width="14%" id="loaicapnhat5text" >Nhập phiếu thu chi cửa hàng</td>
	<td width="86%"> 
	   
	 <input type="Text" onkeypress="return chuyentiep(event,'IDTinh')"name="phieuthuchi"  id="phieuthuchi" onblur="kiemtraphieuthuchi(this.value,1)" class="text" size="10"  value="{phieuthuchi}" /> &nbsp;  <span id="thongtinthuchi" ></span> 
	   <input type="hidden" onkeypress="return chuyentiep(event,'IDTinh')"name="ngaytaophieu"  id="ngaytaophieu" onblur="" class="text" size="10" {capnhapct}  value="{ngaytaophieu}" />
	 </td>
</tr>-->


				<tr>
					<td>Lý Do</td>
					<td><textarea id="lydo" name="lydo" class="texta" style='width:650px;height:70px'>{lydo}</textarea>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td height="26" colspan="2">
						<input type="Submit" onfocus="setrong()" onclick="return kiemtra()" class="text"
							name="btnUpdate" id="btnUpdate" value="Cập nhập"> <input type="submit" class="text"
							name="cancel" id="cancel" value="Quay Lại" />
						<input type="button" name="inan2" id="inan2" onclick="window.close()" value="Đóng Lại"
							style="width:80px;display:{donglai}" />
					</td>
				</tr>
			</table>

		</fieldset>
	</div>
</form>

<script language="javascript">
	document.getElementById('type1').focus();
</script>
<!-- END: block_cus -->

<div id="khonghienthi" style="display:none"></div>


<!-- BEGIN: block_cusupdate -->
<script language="JavaScript">
	alert('Cập nhập của hàng thành công');
	location.replace("default.php?act=yeucaucapnhat");
</script>
<!-- END: block_cusupdate -->

<!-- BEGIN: block_khongxoa -->
<script language="JavaScript">
	alert('Bạn không thể xóa cửa hàng này do đã có thông tin liên quan đến cửa hàng này!!! ');
</script>
<!-- END: block_khongxoa -->


<script src="js/jquery-1.7.2.min.js"></script>
<script src="js/select2.min.js"></script>
<link rel="stylesheet" media="screen" href="js/select2.min.css">
<script language="JavaScript">

	$(document).ready(function () {
		$('.js-nv').select2();
		$('.js-target').select2();
		$('.js-lydo').select2();
		$('.js-ch').select2();
		$('.js-kh').select2();
		$('.js-loaicapnhat').select2();

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
		if (document.getElementById('loaicapnhat').value != 5 && document.getElementById('loaicapnhat').value != 6 && document.getElementById('loaicapnhat').value != 7 && document.getElementById('loaicapnhat').value != 8 && document.getElementById('loaicapnhat').value != 9) {
			//   if (capnhap != '') { return false ;}
			if (document.getElementById('sochungtu').value == "") {
				alert('Bạn chưa nhập số hóa đơn');
				document.getElementById('sochungtu').focus();
				return false;
			}

		}
		if (document.getElementById('tuvandung').value == "0") {
			alert('Bạn chưa nhập tư vấn đúng');
			document.getElementById('tuvandung').focus();
			return false;
		}


		return true;
	}

	function xuly1() {
		var tam = document.getElementById('khonghienthi').innerHTML;
		var n = tam.split("###");
		console.log(n);
		if (n[1] == "-1") {
			alert(n[2]); document.getElementById('thongtin').innerHTML = ''; document.getElementById('tuvansai').value = 0;
			document.getElementById('sochungtu').value = ''; return;
		}
		document.getElementById('thongtin').innerHTML = n[11];
		document.getElementById('idcuahang').value = n[6];
		document.getElementById('tuvansai').value = n[5];
		document.getElementById('khachhangsai').value = n[5];
		document.getElementById('lydosai').value = n[8];
		document.getElementById('targetsai').value = n[7];
		document.getElementById('ghichusai').value = n[9];


	}
	function kiemtraphieu(t1) {
		if (t1 == '') return;
		poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0);
		loadtrang('khonghienthi', "kiemtracobill", poststr, "xuly1");
	}
	var loaitam = '';

	function chonloaicapnhat(e) {
		var target = e.target;
		value = target.value;
		//console.log(value);
		loaitam = value;
		var text = target.options[target.selectedIndex].text;

		var id = 'loaicapnhat' + value;

		//if(value==5 || value==6 || value==7 || value==8){
		document.getElementById('btnUpdate').disabled = true;
		document.getElementById('sochungtu').value = '';
		document.getElementById('capnhatphieu').innerHTML = text + " Nhập số phiếu";

		var loaicapnhat = document.getElementsByClassName('loaicapnhat');
		for (var i = 0; i < loaicapnhat.length; i++) {
			var el = loaicapnhat[i];
			if (!el.classList.contains('loaicapnhathidden')) {
				el.classList.add('loaicapnhathidden');
			} if (el.classList.contains('loaicapnhatshow')) {
				el.classList.remove('loaicapnhatshow');

			}
		}

		$(".js-loaicapnhatinput").each((index, item) => {
			$(item).val('').trigger('change');;
			//console.log($(item).val());
		});

		$("#ghichu").val("");
		//el.getElementsByClassName('loaicapnhatinput').value='';

		document.getElementById(id).classList.remove('loaicapnhathidden');

	}

	function kiemtraphieuthuchi(t1, t2) {

		if (t1 == '' && t2 == 17) { document.getElementById('thongtinthuchi').value = ''; document.getElementById('tenkhachhang').innerHTML = ''; return; }
		if (t1 == '') return;
		poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(loaitam) + "*@!" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0);

		loadtrang('khonghienthi', "yeucaucapnhatkiemtra", poststr, "xuly2");
	}

	function xuly2() {
		var tam = document.getElementById('khonghienthi').innerHTML;

		var n = tam.split("###");
		//if(loaitam==5 || loaitam==6 || loaitam==7 || loaitam==8){
		if (n[1] == 2) { document.getElementById('khachhangdung').value = n[2]; document.getElementById('tenkhachhang').innerHTML = n[3]; return; }

		if (n[1] == "-1" || n[1] == "-2") {
			alert(n[2]); document.getElementById('thongtinthuchi').innerHTML = '';
			document.getElementById('phieuthuchi').value = '';
			document.getElementById('thongtinthuchi').value = ''; return;
		}

		document.getElementById('btnUpdate').disabled = false;
		if (loaitam == 5 || loaitam == 6 || loaitam == 7 || loaitam == 8 || loaitam == 9 || loaitam == 10 || loaitam == 11 || loaitam == 12 || loaitam == 13 || loaitam == 14 || loaitam == 15 || loaitam == 16) {
			document.getElementById('thongtinthuchi').innerHTML = n[7];
		}

		else if (loaitam == 1 || loaitam == 2 || loaitam == 3 || loaitam == 4 || loaitam == 17) {
			document.getElementById('thongtinthuchi').innerHTML = n[11];
			document.getElementById('idcuahang').value = n[6];
			document.getElementById('tuvansai').value = n[5];
			document.getElementById('khachhangsai').value = n[5];

			document.getElementById('lydosai').value = n[8];
			document.getElementById('targetsai').value = n[7];
			document.getElementById('ghichusai').value = n[9];
			document.getElementById('thongtinthuchi').innerHTML = n[11];


		}
		//document.getElementById('ngaytaophieu').value= n[6]; 





	}
	function kiemtrahuyphieu() {
		var today = new Date();
		today = today.toISOString().split('T')[0];

		var ngaytaophieu = document.getElementById("ngaytaophieu").value;
		var loaicapnhat = document.getElementById("loaicapnhat").value;
		console.log(ngaytaophieu);
		console.log(today);
		if (ngaytaophieu && loaicapnhat == 5) {
			if (!kiemtrangay(ngaytaophieu, today)) {
				alert("phiếu quá thời hạn");
				document.getElementById("ngaytaophieu").value = '';
				document.getElementById('thongtinthuchi').innerHTML = '';
				document.getElementById("phieuthuchi").value = '';

			}
		}

	}
	function kiemtrangay(ngay1, ngay2, ngaysosanh) {
		// đưa ngay về dạng Y-m-d
		var ngay1tam = ngay1.split("-");
		var ngay2tam = ngay2.split("-");
		if (ngay1tam[0] == ngay2tam[0] && ngay1tam[1] == ngay2tam[1]) {
			if ((ngay1tam[2] + (ngaysosanh - 1)) <= ngay2tam[2]) {
				return true;
			}
			else {

				return false;
			}
		}
		else {
			return false;
		}

	}
</script>