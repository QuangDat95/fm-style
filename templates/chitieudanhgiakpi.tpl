<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<br />

<div class="nenbao">
	<fieldset class="nencon">
		<legend> <a style="cursor:pointer">
				<label style="Color:#FF3300;Font-Weight:Bold;Font-size:9pt;">Chỉ tiêu đánh giá KPI</label>
			</a></legend>
		<script language="Javascript1.2">
				_editor_url = "htmlarea1/";                     // URL to htmlarea files
			var win_ie_ver = parseFloat(navigator.appVersion.split("MSIE")[1]);
			if (navigator.userAgent.indexOf('Mac') >= 0) { win_ie_ver = 0; }
			if (navigator.userAgent.indexOf('Windows CE') >= 0) { win_ie_ver = 0; }
			if (navigator.userAgent.indexOf('Opera') >= 0) { win_ie_ver = 0; }
			if (win_ie_ver >= 5.0) {
				document.write('<scr' + 'ipt src="' + _editor_url + 'editor.js"');
				document.write(' language="Javascript1.2"></scr' + 'ipt>');
			}
			else { document.write('<scr' + 'ipt>function editor_generate() { return false; }</scr' + 'ipt>'); }
// --></script>

		<!-- BEGIN: block_grpht1 -->
		<form name="frmProduct1" method="post">
			<div style="padding:5px">
				<b style="display:{q_them}">[ <a href="default.php?act=chitieudanhgiakpi&id=-1">Thêm Mới</a>]</b>
				[<a href="default.php?act=md">Đóng Lại</a>]
				<select name="chucvu" id="chucvu" style="height:30px" class="js-cvtim">
					<option value="">Chức vụ</option>
					{kh_chucvu}
				</select>
				<select name="phongban" id="phongban" style="height:30px" class="js-phongbantim">
					<option value="">Phòng ban</option>
					{rooms}
				</select>
				<input type="submit" name="cvim" value="Tìm kiếm" />
			</div>

			<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
				<tr bgcolor="#F8E4CB">
					<td align="center"
						style='border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 0.4pt 0in 0.4pt'
						height="23" width="32"><b>STT</b></td>
					<td width="170" align="center"
						style='border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 0.4pt 0in 0.4pt'>
						<strong>Phòng ban</strong></td>
					<td width="899" align="center"
						style='border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
						<strong>Chỉ tiêu đánh giá KPI </strong></td>

					<td width="38" align="center"
						style='border:solid windowtext 1.0pt;display:{q_capnhap}; mso-border-alt:solid windowtext .5pt;padding:0in 0.4pt 0in 0.4pt'>
						<strong>C&#7853;p nh&#7853;p</strong></td>
					<td width="39" align="center"
						style='border:solid windowtext 1.0pt;display:{q_xoa}; mso-border-alt:solid windowtext .5pt;padding:0in 0.4pt 0in 0.4pt'>
						<strong>X&#243;a</strong></td>
				</tr>
				<!-- End: block_grpht1 -->
				<!-- BEGIN: block_caymenu -->

				{caymenuedit}

				<!-- END: block_caymenu -->

				<!-- BEGIN: block_grpht2 -->
			</table>
			<input type="hidden" name="currentPage" />
		</form>
		<script language="JavaScript">
			function ask() {
				var n = confirm("Bạn có muốn xóa không");
				if (n == false) {
					return false;
				}
			}
		</script>
		<!-- End: block_grpht2 -->

		<!-- BEGIN: block_grp -->
		<form name="frmProduct2" method="post" id="formaction" onsubmit="updatedata(event)">
			<input name="loai" id="loai" type="hidden" value="{loai}" />
			<table width="100%" border="0">
				<tr>
					<td colspan="2" align="center" style="color:#FF6600;padding-bottom:10px">
						<h2>{t-c}</h2>
					</td>
				</tr>
				<tr>
					<td width="14%"> Phòng ban</td>
					<td width="">

						<select name="phongban" id="phongban" onchange=""
							class="js-phongban">
							<option value="">phòng ban</option>
							{rooms}
						</select>
 
					</td>
				</tr>
				<tr>
					<td width="14%">Nhóm Cha </td>
					<td>
						<select class="js-caykpi" name="IDcha" id="IDcha"  value="IDcha">
							<option value="">Nhóm ngành gốc</option>
							{cay}
						</select>
						<!-- <input name="IDcha" class="ipgroup" type="hidden" id="ipgroup" value="" /> -->
					</td>
					
				</tr>
				<tr>
					<td width="14%"> Chức vụ </td>
					<td width="">
						<select name="chucvu" id="chucvu" onkeypress="return chuyentiep(event,'Name')"
							class="js-chucvu">
							<option value="">Chức vụ</option>
							{kh_chucvu}
						</select>
						Kpi đề xuất 
						<input type="Text" onkeypress="return chuyentiep(event,'ma')" name="kpi_dexuat" id="kpi_dexuat"
							class="text" size="19" value="{kpi_dexuat}">
					</td>
				</tr>
				<tr>
					<td>
						Tên Nhóm </td>
					<td>
						<input type="Text" onkeypress="return chuyentiep(event,'ma')" name="ten" id="ten" class="text"
							size="70" value="{ten}">
					</td>
				</tr>
				<tr>
					<td>
						Ghi Chú </td>

					<td colspan="2"><textarea id="ghichu" name="ghichu"
							style='width:550px; height:100px'>{ghichu}</textarea> </td>
				</tr>

				<tr>
					<td colspan="2">
						<!--return kiemtra()-->
						<input type="Submit" class="text" onfocus="setrong()" onclick="" name="btnUpdate" id="btnUpdate"
							value="Cập nhập"> <input type="button" class="text" name="cancel" value="Quay Lại"
							onclick="return window.location='?act=chitieudanhgiakpi'" />
						<div id="loadings" style="display:none"><img src="images/loading.gif"/>loading...</div>
					</td>
				</tr>
			</table>
		</form>

		<!-- END: block_grp -->
		<script src="js/select2.min.js"></script>
		<link rel="stylesheet" media="screen" href="js/select2.min.css">
		<script language="javascript">

			var Phongban = '';
function isloading(type,id){
	 document.getElementById(id).style.display=type?'inline-block':"none";
}	

			$(document).ready(function () {
				$('.js-caykpi').select2();
				$('.js-chucvu').select2();
				$('.js-phongban').select2();
				$('.js-phongbantim').select2();
				$('.js-cvtim').select2();

				$('.js-phongban').on('select2:selecting', function (e) {			
					Phongban = e.params.args.data.id;
					isloading(true,"loadings");
					var poststr = "LOADCHITIEU=" + encodeURIComponent(e.params.args.data.id) + "*@!";
					loadtrang('IDcha', "kpichitieudanhgialuu", poststr, "xuly3");
					// console.log(poststr);
				});

			});
			
			function xuly3() {

				var tam = document.getElementById('IDcha').innerHTML;
				// console.log(tam);
				isloading(false,"loadings");
				/*	var IDcha = document.getElementById("IDcha");
				if (tam != "") {

					IDcha.innerHTML = tam;
					console.log(tam);
					// IDcha.disabled = false;
					// console.log(tam);
					document.getElementById('ipgroup').type = 'hidden';
					document.getElementById('IDcha').style.display = 'block';

				}
				if(tam == '<option value=" "></option>'){
					document.getElementById('ipgroup').type = 'text';
					document.getElementById('IDcha').style.display = 'none';
				}*/
			}

			capnhap = '';
			function kiemtra() {
				//  if (capnhap != '') { return false ;}
				if (document.getElementById('ten').value == "") {
					alert('Bạn chưa nhập tên !!!');
					document.getElementById('ten').focus();
					return false;
				}


				if (document.getElementById('chucvu').value == "0") {
					alert('Bạn chưa chọn nhập chức vụ !!!');
					document.getElementById('chucvu').focus();
					return false;
				}
				return true;
			}
			function kttrung(kt) {

				kiemtratrung(document.getElementById('loai').value, 'tbchitieudanhgiakpitk', 'ma', kt, 'Trùng mã nhóm Phụ tùng !!!', 'Có lỗi trên đường truyền !!!', "ma");

			}

		</script>

		<!-- BEGIN: block_khongxoa -->
		<script language="JavaScript">
			alert('Bạn không thể xóa nhóm phụ tùng này do đã có phụ tùng sử dụng nhóm này rồi !!! ');
		</script>
		<!-- END: block_khongxoa -->


		<!-- BEGIN: block_grpupdate -->
		<script language="JavaScript">
			alert('Cập nhập nhóm thành công');
		</script>
		<!-- END: block_grpupdate -->
		<!-- BEGIN: block_canhbao -->
		<script language="JavaScript">
			alert('Bạn phải xóa các nhóm con trước khi xóa nhóm này !!!');
		</script>
		<!-- END: block_canhbao -->
	</fieldset>
</div>

<script>

	function updatedata(e) {
		e.preventDefault();
		var target = e.target;

		var ID = target["loai"].value;
		var IDcha = target["IDcha"].value;
		var ten = target["ten"].value;
		var ghichu = target["ghichu"].value;
		var chucvu = target["chucvu"].value;

		var kpi_dexuat = target["kpi_dexuat"].value;
		var rank = '';
		var idphongb = target["phongban"].value;
		if (!idphongb) {
			alert("Vui lòng chọn phòng ban!");
			return;
		}
		if (!chucvu) {
			alert("Vui lòng chọn chức vụ!");
			return;
		}
		if (!ten) {
			alert("Vui lòng nhập tên!");
			return;
		}
		if (!idphongb || !chucvu || !ten || !kpi_dexuat) {
			alert("Vui lòng chọn phòng ban!");
			return;
		}
		if (!kpi_dexuat) {
			alert("Vui lòng nhập kpi!");
			return;
		}
	isloading(true,"loadings");
		var loai = '';
		// console.log(chucvu);

		poststr = "DATA=" + encodeURIComponent(ID) + "*@!" + encodeURIComponent(IDcha) + "*@!" + encodeURIComponent(ten) + "*@!" + encodeURIComponent(ghichu) + "*@!" + encodeURIComponent(chucvu) + "*@!" + encodeURIComponent(kpi_dexuat) + "*@!" + encodeURIComponent(rank) + "*@!" + encodeURIComponent(idphongb) + "*@!" + encodeURIComponent(loai);
		loadtrang('loadings', "kpichitieudanhgialuu", poststr, "xuly1");
	}

	function xuly1() {
	
		var tam = document.getElementById("loadings").innerHTML;
		if(tam){
			tam=tam.split("###");
			alert(tam[2]);
		}
		isloading(false,"loadings");
		// console.log(tam);
	}
</script>