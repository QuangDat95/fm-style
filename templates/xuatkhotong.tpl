<style>

	.modal-confirm {
		display: none;
		position: fixed;
		z-index: 8;
		left: 0;
		top: 0;
		width: 100%;
		height: 100%;
		overflow: auto;
		background-color: rgb(0, 0, 0);
		background-color: rgba(0, 0, 0, 0.4);
	}

	.modal-content {
		margin: 50px auto;
		border: 1px solid #999;
		width: 30%;
	}

	.title-modal {
		margin: 10px 20px 20px;
		font-weight: 400;
		color: black;
	}

	.title-input {
		color: black;
		display: block;
		padding: 0 0 5px;
		font-size: 15px;
	}

	#form-confirm {
		padding: 15px 25px 25px 25px;
	}

	.input-type {
		width: 100%;
		padding: 10px;
		border: 1px solid #1c87c9;
		outline: none;
		border-radius: 5px;
		line-height: 20px !important;
		font-size: 13px !important;
	}

	.div-input {
		margin-bottom: 20px;
	}

	.contact-form button {
		width: 100%;
		padding: 10px;
		border: none;
		background: #1c87c9;
		font-size: 16px;
		font-weight: 400;
		color: #fff;
	}

	button:hover {
		background: #2371a0;
	}

	.close {
		color: #aaa;
		float: right;
		font-size: 40px;
		font-weight: bold;
		padding: 3px 7px;
	}

	.close:hover,
	.close:focus {
		color: black;
		text-decoration: none;
		cursor: pointer;
	}

	.header-modal {
		display: flex;
		justify-content: space-between;
	}
	
</style>
<form name="frmxuat" id="frmxuat" method="get">
	<div class="nenbao">
		<div style="padding:0px">
			<fieldset class="nencon">
				<legend>
					<a style="cursor:pointer">
						<label style="Color:#FF3300;Font-Weight:Bold;Font-size:11pt;">Phiếu Xuất Hàng </label>
					</a>
				</legend>

				<table border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td valign="top">
							<div style=" height:500px;width:270px">
								<div style="margin-top:5px;margin-bottom:10px">
									<fieldset style="height:140px;width:250px">
										<legend>
											<label style="Color:#5BB6E6;Font-Weight:Bold;Font-size:12pt;">Thông Tin
												Phiếu Xuất </label>
										</legend>


										<table width="100%" border="0" cellpadding="1" cellspacing="5"
											style="padding-top:0px">
											<tr>
												<td width="33%" valign="middle">Người Lập </td>
												<td>:
													<input type="text" name="nguoilap" class="inpl" id="nguoilap"
														readonly="readonly" style="width:140px" value="{ten}" />
												</td>
											</tr>

											<tr>
												<td width="33%" valign="middle">Ngày Lập </td>
												<td width="67%">:
													<input type="text" name="ngaynhap" id="ngaynhap" class="inpl"
														readonly="" onkeyup="return chuyentiep(event,'sochungtu')"
														style="width:70px" value="{ngaynhap}" />
													<img src="images/img.gif" id="Lichtungaytao"
														style="display:none;cursor: pointer; border: 0px solid red;"
														title="Date selector"
														onclick="displayCalendar(frmnhap.ngaynhap,'dd/mm/yyyy',this)" />
													<input name="idgoi" id="idgoi" type="hidden" value="" />
												</td>
											</tr>
											<tr>
												<td>Số C.Từ</td>
												<td>:
													<input type="text" name="sochungtu" class="inpl" id="sochungtu"
														readonly="" onkeyup="return chuyentieps(event,'kho')"
														style="width:100px" value="{sochungtu}"
														onblur="kttrung(this.value)" />
												</td>
											</tr>
											<tr>
												<td height="20px" valign="top">Chi Nhánh
													<input type="hidden" name="kho" id="kho" value="{idkho}">
													<input type="hidden" name="TiGia" id="TiGia"
														value="{TiGia}" /><input type="text" name="VAT" id="VAT"
														style="display:none">
												</td>
												<td valign="top"><textarea id="textarea" name="textarea"
														readonly="readonly"
														style='width:150px;height:30px;overflow:auto;background-image: url("../images/dot_xanh.gif");border:0px; font-family: verdana; font-size: 1.1em; color:#0000FF'>:{tencuahang}</textarea>

												</td>
											</tr>
										</table>
									</fieldset>
								</div>


								<fieldset style="height:310px;width:250px;margin:0">
									<legend> <a style="cursor:pointer" onClick=" anhienform('obj') ">
											<label style="Color:#5BB6E6;Font-Weight:Bold;Font-size:12pt">Thông tin nơi
												nhận </label>
										</a></legend>
									<div style="padding-bottom:5px">Nơi xuất hàng</div>
									<div style="margin-bottom:5px; "> <select name="khochuyen" id="khochuyen"
											style="width:245px" onchange="settt(this)" class="js-khodi">
											{cuahangkiem}
										</select>
									</div>

									<div style="padding-bottom:5px;padding-top:10px">Nơi nhận hàng</div>
									<div style="margin-bottom:5px; "> <select name="khonhan" id="khonhan"
											class="js-khachhang" style="width:245px" onchange="settt(this)"
											onkeypress="return chuyentiep(event,'lydo')">
											<option value="0">Chọn kho Nhận</option>
											{cuahangkiemnhan}
										</select>
									</div>
									<div style="padding-bottom:5px">Lý Do Xuất </div>
									<div style="margin-bottom:5px; "> <select name="lydo" id="lydo" style="width:245px"
											onkeypress="return chuyentiep(event,'nguoigiao')">
											<option value="1">Xuất hàng</option>
											<option value="2">Điều hàng</option>

										</select>
									</div>
									<div style="padding-bottom:5px">Ghi chú &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
										&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
										<select name="chonnhac" id="chonnhac" style="width:95px"
											onchange="doinhac(this.value)">
											<option value="0">TB mặc định</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
											<option value="6">6</option>
											<option value="7">7</option>
											<option value="8">8</option>
											<option value="9">9</option>
										</select>
									</div>
									<textarea id="note" name="note" class="texta"
										style='width:242px;height:90px;overflow:auto'></textarea>
									<div style="font-size:16px">
										<div style="padding-top:9px;padding-bottom:5px">Tổng Tiền: <strong><span
													id="tongtien"></span></strong> </div>

									</div>
								</fieldset>
							</div>
						</td>



						<td style="padding-left:5px" valign="top">
							<!-- chọn hàng hóa -->
							<div style=" height:430px;width:700px; margin-top:5px;">
								<fieldset style="padding-top:5px">
									<legend> <a style="cursor:pointer" onClick="anhienform('chon')">
											<label style="Color:#5BB6E6;Font-Weight:Bold;Font-size:12pt">Chọn Hàng Hóa
												Cần Xuất Kho </label>
										</a> </legend>

									<div id="chon">
										Mã
										<input onkeypress="return chuyentiep(event,'IDGrouptk')" type="text"
											name="codeprotk" autocomplete="off" id="codeprotk"
											onkeyup="goisp(this.value)" class="text" size="9" value=""
											ondblclick="this.value=''" /> Tên SP
										<input onkeypress="return chuyentiep(event,'codeprotk')" type="text"
											name="NameTK" id="NameTK" class="text" size="9" value="" />
										<input type="hidden" name="code" id="code" class="text" size="10" value="" />
										Nhóm
										<select onkeypress="return chuyentiep(event,'search')" name="IDGrouptk"
											id="IDGrouptk" style="width:180px">
											<option value="0"></option>
											{cay}
										</select>
										&nbsp;
										<input type="button" style="width:37px"
											onclick="timsanpham(NameTK.value,codeprotk.value,code.value,IDGrouptk.value,'',kho.value)"
											name="search" id="search" value="Tìm" />
										<input type="hidden" name="soluongcon" value="" />
										<input type="button" name="cl" style="width:38px" onclick="clearchon()"
											value="clear" />
									</div> 


									<div style="height:16px" id="cho"> </div>


									<div id="sanpham" style="padding-top:4px"> </div>
								</fieldset>


								<div style="padding-bottom:5px">
									<fieldset style="display:">
										<legend>
											<label style="Color:#5BB6E6;Font-Weight:Bold;Font-size:12pt">Hàng Hóa Xuất
												Kho</label>
										</legend>


										<div>Tên SP:
											<input type="text" name="tensp" id="tensp" class="inpl" style="width:340px"
												readonly="" value="" />
											&nbsp;&nbsp;Mã SP: &nbsp;
											<input type="text" name="masp" id="masp" class="inpl" style="width:150px"
												readonly="" value="" />
											<input type="hidden" name="idsp" id="idsp" value="" />
											<input type="hidden" name="sl" id="sl" value="" />
											<input type="hidden" name="giachan" id="giachan" value="0" />
										</div>
										Giá
										<input type="text" name="dongia" id="dongia" maxlength="12" class="text"
											style="width:75px;" value="0" onkeydow=" onlyinta(this)"
											onkeyup="return chuyentiep(event,'soluong')" onkeypress="txtFormata(this)"
											onblur="txtFormat(this)" />
										<select name="loaitien" id="loaitien"
											onkeyup="return chuyentiep(event,'soluong')" style="display:none">
											<option value="VND">VND</option>
											<option value="USD">USD</option>
										</select>
										SL
										<input type="text" name="soluong" id="soluong"
											onkeyup="return chuyentieps(event,'chietkhau')" class="text"
											style="width:35px" value="1" />


										&nbsp;

										Ghi chú:
										<input type="text" name="ghichu" id="ghichu"
											onkeyup="return chuyentiep(event,'add')" style="width:190px" value="" />
										<input type="button" name="add" id="add" style="width:50px"
											onclick="addpro(idsp.value,tensp.value,masp.value,dongia.value,loaitien.value,soluong.value,0,ghichu.value,giachan.value)"
											value="ADD" onkeyup="return chuyentiep(event,'NameTK')" />

										<input type="button" name="tm" style="width:100px;display:{q_themp}"
											value="Nhập từ Excel" onclick="nhapexcel1()" />

									</fieldset>
								</div>
								<div style=" max-height:340px;overflow:scroll">

									<div id="sanphamxuat">
										<table width="100%" border="0" cellpadding="0" cellspacing="0">
											<tr bgcolor="#F8E4CB">
												<td width="29" align="center" class="cothienthi" height="23"><b>STT</b>
												</td>
												<td width="115" align="center" class="cothienthi"><strong>Mã Hàng Hóa
													</strong></td>
												<td width="310" align="center" class="cothienthi"><strong>Tên Hàng
														Hóa</strong></td>
												<td width="48" align="center" class="cothienthi"><strong>SL</strong>
												</td>
												<td width="152" align="center" class="cothienthi"><strong>Đơn Giá
													</strong></td>
												<td width="51" align="center" class="cothienthi"><strong>CK</strong>
												</td>
												<td width="164" align="center" class="cothienthi"><strong>Thành Tiền
													</strong></td>
												<td width="250" align="center" class="cothienthi"><strong>Ghi Chú
													</strong></td>
												<td width="45" align="center" class="cothienthi">
													<strong>X&#243;a</strong>
												</td>
											</tr>
											<tr bgcolor="{color}">
												<td class="cothienthi">&nbsp;</td>
												<td class="cothienthi">&nbsp;</td>
												<td class="cothienthi">&nbsp;</td>
												<td class="cothienthi">&nbsp;</td>
												<td class="cothienthi">&nbsp;</td>
												<td class="cothienthi">&nbsp;</td>
												<td class="cothienthi">&nbsp;</td>
												<td class="cothienthi">&nbsp;</td>
												<td class="cothienthi">&nbsp;</td>
											</tr>
										</table>
									</div>
								</div>
							</div>
						</td>
					</tr>
				</table>

				<div style="padding-top:4px">
					<input type="button" name="luu" id="luu" style="width:70px;display:{q_luu}"
						onclick="return  luuphieuxuat()" value="Lưu" {} />
					<input type="button" name="themmoi" id="themmoi" style="width:70px;display:{q_them}"
						onclick="window.open('default.php?act=xuatkhotong','_self')" value="Thêm Mới" />
					<input type="button" name="copy" id="copy" onclick="copyp()" disabled="disabled" value="Copy"
						style="display:none;width:70px" />
					<input type="button" name="khoa" id="khoa" disabled="disabled" style="width:80px;display:{q_khoa}"
						onclick="khoaphieu()" value="Khóa Phiếu" />
					<input type="button" name="inan" id="inan" style=" width:100px;display:{q_in}" disabled="disabled"
						onclick="goiin()" value="Xem Phiếu" />
					<input type="button" name="timxuat" id="timxuat" style="width:105px;display:{q_tim}"
						onclick="timphieu()" value="Tìm Phiếu " />
					<input type="button" name="timxuat32" id="timxuat32" style="display:none;width:80px"
						onclick="huongdan()" value="Hướng Dẫn" />
					<input type="button" name="timxuat3" id="timxuat3" style="width:80px" onclick="matdinh()"
						value="Đóng lại" />
					<input type="button" name="tongsl" id="tongsl" style="width:80px" value="Tổng SL" />
					&nbsp; &nbsp; &nbsp;
					<input type="button" name="huyphieu" id="huyphieu" disabled="disabled"
						style="width:80px;display:{q_huy}" onclick="goihuyphieu(idgoi.value,'nk')" value="Hủy Phiếu" />
					&nbsp; &nbsp; &nbsp; &nbsp;

					<!-- BEGIN: block_admin2 -->
					<input type="button" name="phuchoi" id="phuchoi" style="width:80px"
						onclick="goiphuchoi(idgoi.value,note.value)" value="Phục hồi" />
					<!-- END: block_admin2-->
				</div>


				<div id="ketqualuu" style="width:800"></div>
				<div id="luutimsp" style="display:none"></div>
				<div id="luubd" style="display:none"></div>
				<div id="tenform" style="display:none">xuatkho</div>
				<!-- =================================KT 33333====================================== -->
				<div style="clear:left;display:none" id="khonghienthi"></div>

			</fieldset>
		</div>
	</div>
	<div id="modalOne" class="modal-confirm">
		<div class="modal-content">
			<div class="contact-form">
				<div class="header-modal">
					<h3 class="title-modal">Xác nhận thông tin</h3>
					<a class="close" onclick="closepopup()">&times;</a>
				</div>
				<div id="form-confirm" action="" method="">
					<span class="title-input">Ngày gửi</span>
					<div class="div-input">
						<input class="input-type" id="ngaygui" onchange="dategreater(ngaygui.value)" type="date" name="ngaygui"/>
						<span id="warningtext" class="text-danger">Ngày gửi không được lớn hơn ngày hiện tại</span>
					</div>
					<span class="title-input">Ghi chú</span>
					<div class="div-input">
						<textarea class="input-type" name="ghichu" rows="4"></textarea>
					</div>
					<button type="button" class="btn btn-primary">Xác nhận</button>
				</div>
			</div>
		</div>
	</div>

	<div id="hienthongbao" style="display:none; overflow:hidden; position:absolute;   top: 50px;left:0;width:100%; "
		align="center">
		<div
			style=" width:1100px; min-height:530px;border:1px #999 solid; background-color:#FFF; opacity: 0.98;font-size:15px; font-weight:bold; padding:5px; color:#F00;">

			<div align="right"><b style="color:#00F;cursor:pointer" onclick="goidong()">( X Đóng lại )</b></div>

			<div id="timphieuxuat">
				<fieldset>
					<legend align="center"><label style="Color:#5BB6E6;Font-Weight:Bold;Font-size:14pt;cursor:pointer"
							onclick="anhien2f('ankhachhang','khachangchitiet')">Tìm phiếu xuất </label>
					</legend>


					<div style="padding-bottom:5px"><br />
						<input type="text" name="ghichut" id="ghichut" placeholder="Ghi chú " class="inpl"
							style="width:100px" onkeypress="return chuyentiep(event,'tungay')" value="" />
						<select name="khoaphieut" id="khoaphieut" style="width:89px"
							onkeypress="return chuyentiep(event,'sophieut')">

							<option value="0">Chưa khóa</option>
							<option value="1">Đã Khóa</option>
							<option value="">Tất Cả</option>
						</select>
						<select name="cuahangf" id="cuahangf" style="width:70px">
							<option value="0">Tất cả</option>
							{cuahangkiem}
						</select>
						<select name="cuahangn" id="cuahangn" style="width:80px">
							<option value="0">CH Nhận</option>
							{cuahangkiemnhan}
						</select>

						<select name="lydot" id="lydot" style="width:80px">
							<option value="0">Lý do xuất</option>
							<option value="1">Xuất hàng</option>
							<option value="2">Điều hàng</option>

						</select>

						<input type="text" name="sophieut" id="sophieut" placeholder="Số phiếu " class="inpl"
							style="width:90px" onkeypress="return chuyentiep(event,'tungay')" value="" />
						Từ
						<input onkeypress="return chuyentiep(event,'denngay')" ondblclick="this.value=''" type="text"
							name="tungay" id="tungay" class="text" style="width:68px" value="{tungay}" />
						<img src="images/img.gif" id="Lichtungaytao" style="cursor: pointer; border: 0px solid red;"
							title="Date selector" onclick="displayCalendar(frmxuat.tungay,'dd/mm/yyyy',this)" />&nbsp;
						<input onkeypress="return chuyentiep(event,'timk')" type="text" ondblclick="this.value=''"
							name="denngay" id="denngay" class="text" style="width:68px" value="{denngay}" />
						<img src="images/img.gif" id="Lichtungaytao" style="cursor: pointer; border: 0px solid red;"
							title="Date selector" onclick="displayCalendar(frmxuat.denngay,'dd/mm/yyyy',this)" />&nbsp;

						<input type="button"
							onclick="timdsphieuxuat(0,sophieut.value,cuahangn.value,tungay.value,denngay.value,khoaphieut.value,0,cuahangf.value,ghichut.value,lydot.value)"
							style="width:65px" name="timk" id="timk" value="Tìm kiếm" />
						<input type="button"
							onclick="timdsphieuxuat(2,sophieut.value,cuahangn.value,tungay.value,denngay.value,khoaphieut.value,0,cuahangf.value,ghichut.value,lydot.value)"
							style="width:65px" name="timk" id="timk" value="Chi tiết" />

						<input type="button" name="timk" id="timk" style="width:60px"
							onclick="timdsphieuxuat(1,sophieut.value,cuahangn.value,tungay.value,denngay.value,khoaphieut.value,0,cuahangf.value,ghichut.value,lydot.value)"
							value="Quá hạn" />
						<input type="button" name="timk" id="timk" style="width:45px" onclick="xuatkq()"
							value="Excel" />
					</div>
					<div id="httimxuat" style="color:#000000">
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr bgcolor="#F8E4CB">
								<td align="center" class="cothienthi" height="23" width="111"><b>Số Phiếu </b></td>
								<td width="79" align="center" class="cothienthi"><strong>Ngày nhập </strong></td>

								<td width="296" align="center" class="cothienthi"><strong>Lý Do </strong> </td>
								<td width="185" align="center" class="cothienthi"><strong>Người giao hàng </strong></td>
								<td width="398" align="center" class="cothienthi"><strong>Nhà cung cấp </strong></td>
								<td width="162" align="center" class="cothienthi"><strong>Người Tạo</strong></td>
							</tr>
						</table>
					</div>
					<div id="httimlai"></div>


				</fieldset>
			</div>


			<div id="timkhachhanght">
				Tên
				<input type="text" name="ten" id="ten" ondblclick="this.value=''" class="inpl" style="width:90px"
					onkeypress="return chuyentiep(event,'diachitim')" value="" />
				Địa chỉ
				<input type="text" name="diachitim" ondblclick="this.value=''" id="diachitim" class="inpl"
					style="width:100px" onkeypress="return chuyentieps(event,'kv')" value="" />
				khu vực
				<select class="compo" name="kv" id="kv" onkeypress="return chuyentieps(event,'nhom')"
					style="width:110px;">
					<option value="">Tất Cả</option>
					{khuvuc}

				</select>
				Nhóm KH
				<select class="compo" name="nhom" id="nhom" onkeypress="return chuyentieps(event,'search2')"
					style="width:150px;">
					<option value="">Tất cả</option>
					<option value="0">Nhóm mặc định</option>
					{nhomkh}
				</select>

				<input type="button" style="width:70px"
					onclick="timkiemkh(ten.value,diachitim.value,kv.value,'',nhom.value)" name="search2" id="search2"
					value="Tìm Kiếm" />

				<div id="hienthikh" style="padding-top:5px;color:#333">

				</div>
			</div>
		</div>
	</div>
</form>

<form name="xuatketqua" id="xuatketqua" action="xuatfile.php" method="post" target="_blank">
	<input name="noidung" id="noidung" type="hidden" value="Chưa chọn dữ liệu">
	<input name="tenfile" id="tenfile" type="hidden" value="phieuxuatkho.xls">
	<input name="loaifile" id="loaifile" type="hidden" value="application/vnd.ms-excel">
</form>




<div id="hiennhapexcel" style="display:none ; overflow:hidden; position:absolute;   top: 90px;left:0;width:100%; "
	align="center">
	<div style=" width:900px; min-height:510px;border:1px #999 solid; background-color:#FFF; opacity: 0.98;font-size:15px; 
  font-weight:bold; padding:5px; color:#F00;">

		<div align="right"><b style="color:#00F;cursor:pointer" onclick="goidongid('hiennhapexcel')">( X Đóng lại )</b>
		</div>

		<div id="timexxcel" style="padding:10px">


			<input id="mangfilean" type="hidden" size="25" name="mangfilean" value="" />
			<label>File nhập kho từ Excel *.xlsx</label>
			<input id="fileToUpload" type="file" accept=".xlsx" size="35" name="fileToUpload" class="input"
				style="height:22px" />
			<button class="button" id="buttonUpload" onclick="return ajaxFileUpload();" style="height:22px">Tải
				lên</button>&nbsp;

			<div id="hienthiexcel" style="padding:5px">
				<table id="tbex" width="100%" border="0" cellpadding="0" cellspacing="0" style="background:#FFF;"
					class="tbchuan">
					<tr bgcolor="#F8E4CB">
						<td align="center" class="cothienthi" height="23" width="32"><b>STT</b></td>

						<td width="75" align="center" class="cothienthi"><strong>Mã Hàng Hóa</strong></td>

						<td width="360" align="center" class="cothienthi"><strong>Tên Hàng Hóa</strong> </td>
						<td width="39" align="center" class="cothienthi"><strong>Số lượng</strong></td>
						<td width="40" align="center" class="cothienthi"><strong>Đơn giá</strong> </td>
						<td width="312" align="center" class="cothienthi"><strong>Ghi chú</strong></td>

					</tr>
					<tr bgcolor="" style="color:#000">
						<td align="center" class="cothienthi" height="23" width="32">5</td>

						<td width="75" align="center" class="cothienthi" style="color:#F00">Mã hàng bắt buộc</td>

						<td width="360" align="center" class="cothienthi">Tên hàng hóa không bắt buộc lấy từ dòng 2 nhé
						</td>
						<td width="39" align="center" class="cothienthi" style="color:#F00">9 số lượng bắt buộc</td>
						<td width="40" align="center" class="cothienthi">99000</td>

						<td width="312" align="center" class="cothienthi">Trong file dòng nào cũng có mã nhé</td>

					</tr>
				</table>


			</div>

		</div>
	</div>
</div>
<script src="js/jquery-1.7.2.min.js"></script>
<script src="js/select2.min.js"></script>
<link rel="stylesheet" media="screen" href="js/select2.min.css">
<script language="JavaScript">
	
	$(document).ready(function () {
		$('.js-khachhang').select2();
		$('.js-khodi').select2();
		$('#warningtext').css("display","none");
	});
	var confirm_value = true;
	function dategreater(date_now) {
		var ngaygui = new Date(date_now);
		var hientai = new Date();
		if(ngaygui >= hientai) {
			$('#warningtext').css("display","block");
			confirm_value = false;
		} else {
			$('#warningtext').css("display","none");
			confirm_value = true;
		}
	}

	///====== Chức năng của Hải =======/////
	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function (event) {
		let modal = document.getElementById('modalOne');
		if (event.target == modal) {
			closepopup();
		}
	}

	function openpopup(value) {
		document.getElementById("modalOne").style.display = "block";
	}

	function closepopup() {
		document.getElementById("modalOne").style.display = "none";
	}
	///====== Chức năng của Hải =======/////

	function nhapexcel1() {


		if (document.getElementById('hiennhapexcel').style.display == "") {
			document.getElementById('hiennhapexcel').style.display = "none";
			document.getElementById('timkhachhanght').style.display = '';
			document.getElementById('timphieuxuat').style.display = 'none';
		} else {
			document.getElementById('hiennhapexcel').style.display = "";
			document.getElementById('timkhachhanght').style.display = 'none';
			document.getElementById('timphieuxuat').style.display = '';
		}


	}

	var tt = prompt("Please enter your name", "Harry Potter");
	function xuatkq() {

		document.getElementById("noidung").value = ' <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><html><body>' + document.getElementById("httimxuat").innerHTML + "</body></html>";
		// alert( document.getElementById("ketqua").value);
		document.getElementById("xuatketqua").submit();
	}
	document.getElementById('sochungtu').focus();
	document.getElementById('luubd').innerHTML = document.getElementById('sanphamxuat').innerHTML;
	document.getElementById('luutimsp').innerHTML = document.getElementById('sanpham').innerHTML;
	document.getElementById('timphieuxuat').style.display = 'none';
	document.getElementById('hienthongbao').style.display = 'none';
	document.getElementById('codeprotk').select();
</script>
<script language="javascript" src="templates/xuatkhotong.js"> </script>

<script type="text/javascript" src="templates/ajaxfileupload.js"></script>