<div class="top_space"></div>
<div class="nenbao">
	<div style="padding:1px">
		<fieldset class="nencon">
			<legend> <a style="cursor:pointer">
					<label style="Color:#FF3300;Font-Weight:Bold;Font-size:13pt;">Phiếu nhập kho </label>
				</a> </legend>
			<form name="frmnhap" id="frmnhap" method="get">


				<div id="timmuahang" style="">
					<fieldset style="border-color:#336600;padding:5px;">
						<legend> <a style="cursor:pointer" onClick="anhienform('hosot')">
								<label style="Color:#5BB6E6;Font-Weight:Bold;Font-size:14pt;cursor:pointer"
									onclick="timkiemnhacc()">Tìm phiếu mua hàng </label>
							</a> </legend>
						<div><br />
							<span style="padding:5px">Số Phiếu
								<input type="text" name="ma" onkeyup="goikh(this.value)" ondblclick="this.value=''"
									id="sophieutim" class="inpl" style="width:60px"
									onkeypress="return chuyentieps(event,'ghichutim')" value="" />
								Người mua
								<input type="text" name="nguoikhuitim" ondblclick="this.value=''" id="nguoikhuitim"
									class="inpl" style="width:60px" onkeypress="return chuyentieps(event,'chitim')"
									value="" />
								ghi chú
								<input type="text" name="ghichutim" ondblclick="this.value=''" id="ghichutim"
									class="inpl" style="width:80px" onkeypress="return chuyentieps(event,'tu')"
									value="" />

								<select name="IDNCC2" id="IDNCC2" class="js-khachhang" style="width:140px"
									onkeypress="return chuyentiep(event,'ngay')">
									<option value="0">Chọn nhà cung cấp</option>


									{nhacungcap}


								</select>

								<input name="tinhtrang" id="tinhtrang" value="1" type="hidden">

								Ngày
								<input onkeypress="return chuyentiep(event,'denngay')" title="Click đôi để xoá trắng"
									ondblclick="xoatrang(this)" type="text" name="tungay2" id="tungay2" class="text"
									style="width:65px" value="" />
								<img src="images/img.gif" id="Lichtungaytao2"
									style="cursor: pointer; border: 0px solid red;" title="Date selector"
									onclick="displayCalendar(frmnhap.tungay2,'dd/mm/yyyy',this)" />&nbsp;đến
								<input onkeypress="return chuyentieps(event,'luachon')" type="text" name="denngay2"
									id="denngay2" title="Click đôi để xoá trắng" ondblclick="xoatrang(this)"
									class="text" style="width:65px" value="{denngay}" />
								<img src="images/img.gif" id="Lichtungaytao2"
									style="cursor: pointer; border: 0px solid red;" title="Date selector"
									onclick="displayCalendar(frmnhap.denngay2,'dd/mm/yyyy',this)" />
								<input type="button" style="width:65px"
									onclick="timkiemmh(sophieutim.value,IDNCC2.value,ghichutim.value, nguoikhuitim.value,tungay2.value,denngay2.value,tinhtrang.value,0)"
									name="tim" id="tim" value="Tìm Kiếm" />
								<input type="button" value="Quay lại" id="timnhacc2" name="timnhacc2" style="width:70px"
									onclick="timkiemmuahang()"></span>
						</div>

						<div id="hienthimh">


						</div>

					</fieldset>
				</div>


				<div id="timdathang" style="display:none  ">
					<fieldset style="border-color:#336600;padding:5px;">
						<legend> <a style="cursor:pointer" onClick="anhienform('hosot')">
								<label style="Color:#5BB6E6;Font-Weight:Bold;Font-size:14pt;cursor:pointer"
									onclick="timkiemnhacc()">Tìm phiếu đặt hàng </label>
							</a> </legend>
						<div><br />
							<span style="padding:5px">Số Phiếu
								<input type="text" name="ma" onkeyup="goikh(this.value)" ondblclick="this.value=''"
									id="sophieutim" class="inpl" style="width:60px"
									onkeypress="return chuyentieps(event,'ghichutim')" value="" />
								Người mua
								<input type="text" name="nguoikhuitim" ondblclick="this.value=''" id="nguoikhuitim"
									class="inpl" style="width:60px" onkeypress="return chuyentieps(event,'chitim')"
									value="" />
								ghi chú
								<input type="text" name="ghichutim" ondblclick="this.value=''" id="ghichutim"
									class="inpl" style="width:80px" onkeypress="return chuyentieps(event,'tu')"
									value="" />

								<select name="IDNCC2" id="IDNCC2" class="js-khachhang" style="width:140px"
									onkeypress="return chuyentiep(event,'ngay')">
									<option value="0">Chọn nhà cung cấp</option>


									{nhacungcap}


								</select>

								<input name="tinhtrang" id="tinhtrang" value="1" type="hidden">

								Ngày
								<input onkeypress="return chuyentiep(event,'denngay')" title="Click đôi để xoá trắng"
									ondblclick="xoatrang(this)" type="text" name="tungay2" id="tungay2" class="text"
									style="width:65px" value="" />
								<img src="images/img.gif" id="Lichtungaytao2"
									style="cursor: pointer; border: 0px solid red;" title="Date selector"
									onclick="displayCalendar(frmnhap.tungay2,'dd/mm/yyyy',this)" />&nbsp;đến
								<input onkeypress="return chuyentieps(event,'luachon')" type="text" name="denngay2"
									id="denngay2" title="Click đôi để xoá trắng" ondblclick="xoatrang(this)"
									class="text" style="width:65px" value="{denngay}" />
								<img src="images/img.gif" id="Lichtungaytao2"
									style="cursor: pointer; border: 0px solid red;" title="Date selector"
									onclick="displayCalendar(frmnhap.denngay2,'dd/mm/yyyy',this)" />
								<input type="button" style="width:65px"
									onclick="timkiemdh(sophieutim.value,IDNCC2.value,ghichutim.value, nguoikhuitim.value,tungay2.value,denngay2.value,tinhtrang.value,0)"
									name="tim" id="tim" value="Tìm Kiếm" />
								<input type="button" value="Quay lại" id="timnhacc2" name="timnhacc2" style="width:70px"
									onclick="timkiemdathang()"></span>
						</div>

						<div id="hienthidh">


						</div>

					</fieldset>
				</div>



				<div style="display:" id="timphieunhap">
					<fieldset>
						<legend align="center"><label
								style="Color:#5BB6E6;Font-Weight:Bold;Font-size:14pt;cursor:pointer"
								onclick="anhien2f('ankhachhang','khachangchitiet')">Tìm phiếu nhập </label>
						</legend>
						<div style="padding-bottom:5px">

							<select name="khoaphieut" id="khoaphieut" style="width:80px"
								onkeypress="return chuyentiep(event,'sophieut')">
								<option value="0">Chưa khóa</option>
								<option value="1">Đã Khóa</option>
								<option value="">Tất Cả</option>
							</select>
							Số phiếu
							<input type="text" name="sophieu" id="sophieut" class="inpl" ondblclick="this.value=''"
								style="width:70px" onkeypress="return chuyentiep(event,'sohoadon')" value="" />
							Số HĐơn
							<input type="text" name="sohoadon" id="sohoadon" class="inpl" ondblclick="this.value=''"
								style="width:70px" onkeypress="return chuyentiep(event,'nhacct')" value="" />
							Nhà cung cấp
							<input type="text" name="nhacct" id="nhacct" class="inpl" style="width:90px"
								onkeypress="return chuyentiep(event,'tungay')" value="" />
							&nbsp; Ngày
							<input onkeypress="return chuyentiep(event,'denngay')" type="text" name="tungay" id="tungay"
								class="text" style="width:65px" value="{tungay}" />
							<img src="images/img.gif" id="Lichtungaytao" style="cursor: pointer; border: 0px solid red;"
								title="Date selector"
								onclick="displayCalendar(frmnhap.tungay,'dd/mm/yyyy',this)" />&nbsp;đến
							<input onkeypress="return chuyentiep(event,'timk')" type="text" name="denngay" id="denngay"
								class="text" style="width:65px" value="{denngay}" />
							<img src="images/img.gif" id="Lichtungaytao" style="cursor: pointer; border: 0px solid red;"
								title="Date selector"
								onclick="displayCalendar(frmnhap.denngay,'dd/mm/yyyy',this)" />&nbsp;

							&nbsp;<input type="button"
								onclick="timdsphieunhap(0,sophieut.value, nhacct.value,tungay.value,denngay.value,khoaphieut.value,0,sohoadon.value)"
								style="width:68px" name="timk" id="timk" value="Tìm kiếm" />

							<input type="button" name="timnhap2" id="timnhap2" style="width:65px" onclick="timphieu()"
								value="Quay Lại" />
						</div>

						<div id="httimnhap">
							<table width="100%" border="0" cellpadding="0" cellspacing="0">
								<tr bgcolor="#F8E4CB">
									<td align="center" class="cothienthi" height="23" width="111"><b>Số Phiếu </b></td>
									<td width="79" align="center" class="cothienthi"><strong>Ngày nhập </strong></td>

									<td width="296" align="center" class="cothienthi"><strong>Lý Do </strong> </td>
									<td width="185" align="center" class="cothienthi"><strong>Người giao hàng </strong>
									</td>
									<td width="398" align="center" class="cothienthi"><strong>Nhà cung cấp </strong>
									</td>
									<td width="162" align="center" class="cothienthi"><strong>Người Tạo</strong></td>
								</tr>
							</table>
						</div>
						<div id="httimlai"></div>


					</fieldset>
				</div>





				<div style="display:none" id="timphieuinma">
					<fieldset>
						<legend align="center"><label
								style="Color:#5BB6E6;Font-Weight:Bold;Font-size:14pt;cursor:pointer"
								onclick="anhien2f('ankhachhang','khachangchitiet')">Tìm phiếu in mã </label>
						</legend>
						<div style="padding-bottom:5px">

							<select name="khoaphieut" id="khoaphieut" style="width:80px;display:none"
								onkeypress="return chuyentiep(event,'sophieut')">
								<option value="0">Chưa khóa</option>
								<option value="1">Đã Khóa</option>
								<option value="">Tất Cả</option>
							</select>

							<input type="hidden" name="sophieut" id="sophieuin" class="inpl" ondblclick="this.value=''"
								style="width:70px" onkeypress="return chuyentiep(event,'sohoadon')" value="" />
							Tên sản phẩm
							<input type="text" name="sohoadon" id="sohoadon" class="inpl" ondblclick="this.value=''"
								style="width:70px" onkeypress="return chuyentiep(event,'nhacct')" value="" />
							Mã mô tả
							<input type="text" name="nhacct" id="nhacct" class="inpl" style="width:90px"
								onkeypress="return chuyentiep(event,'tungay')" value="" />
							&nbsp; Ngày
							<input onkeypress="return chuyentiep(event,'denngay')" type="text" name="tungay" id="tungay"
								class="text" style="width:65px" value="{tungay}" />
							<img src="images/img.gif" id="Lichtungaytao" style="cursor: pointer; border: 0px solid red;"
								title="Date selector"
								onclick="displayCalendar(frmnhap.tungay,'dd/mm/yyyy',this)" />&nbsp;đến
							<input onkeypress="return chuyentiep(event,'timk')" type="text" name="denngay" id="denngay"
								class="text" style="width:65px" value="{denngay}" />
							<img src="images/img.gif" id="Lichtungaytao" style="cursor: pointer; border: 0px solid red;"
								title="Date selector"
								onclick="displayCalendar(frmnhap.denngay,'dd/mm/yyyy',this)" />&nbsp;

							&nbsp;<input type="button"
								onclick="timdsphieuinma(0,sophieuin.value, nhacct.value,tungay.value,denngay.value,khoaphieut.value,0,sohoadon.value)"
								style="width:68px" name="timk" id="timk" value="Tìm kiếm" />

							<input type="button" name="timnhap2" id="timnhap2" style="width:65px" onclick="nhapinma()"
								value="Quay Lại" />
						</div>

						<div id="httiminma">
							<table width="100%" border="0" cellpadding="0" cellspacing="0">
								<tr bgcolor="#F8E4CB">
									<td align="center" class="cothienthi" height="23" width="111"><b>Số Phiếu </b></td>
									<td width="79" align="center" class="cothienthi"><strong>Ngày nhập </strong></td>
									<td width="296" align="center" class="cothienthi"><strong>Lý Do </strong> </td>
									<td width="185" align="center" class="cothienthi"><strong>Người giao hàng </strong>
									</td>
									<td width="398" align="center" class="cothienthi"><strong>Nhà cung cấp </strong>
									</td>
									<td width="162" align="center" class="cothienthi"><strong>Người Tạo</strong></td>
								</tr>
							</table>
						</div>



					</fieldset>
				</div>






				<div id="codechinh">



					<div id="khachangchitiet">
						<div style="float:left ;width:280px;padding-right:4px">
							<fieldset style="height:135px">
								<legend>
									<label style="Color:#5BB6E6;Font-Weight:Bold;Font-size:12pt;">Thông Tin Phiếu Nhập
									</label>
								</legend>


								<table width="98%" border="0" cellpadding="1" cellspacing="0" style="padding-top:0px">
									<tr style="height:11px">
										<td colspan="2">
											<div style="height:15px;width:155px;overflow:hidden">Lập phiếu:{ten} &nbsp;
												Kho:{tenkho} </div>
										</td>
									</tr>

									<tr>
										<td valign="middle" colspan="2">Ngày CT
											<input type="text" name="ngaynhap" id="ngaynhap" class="inpl" readonly=""
												onkeyup="return chuyentiep(event,'sochungtu')" style="width:34px"
												value="{ngaynhap}" />
											<img src="images/img.gif" id="Lichtungaytao"
												style="display:none;cursor: pointer; border: 0px solid red;"
												title="Date selector"
												onclick="displayCalendar(frmnhap.ngaynhap,'dd/mm/yyyy',this)" />
											<input name="idgoi" id="idgoi" type="hidden" value="" /> Số CT:<input
												type="text" name="sochungtu" class="inpl" id="sochungtu" readonly=""
												onkeyup="return chuyentieps(event,'kho')" style="width:110px"
												value="{sochungtu}" onblur="kttrung(this.value)" />
										</td>
									</tr>

									<tr>
										<td>Số H.đơn gốc:</td>
										<td><span style="padding-top:2px">
												<input type="text" name="hoadongoc" class="inpl" id="hoadongoc"
													onkeypress="return chuyentieps(event,'khachhang')"
													style="width:108px" value="{hoadongoc}" />
											</span><span style="padding-top:2px">
												<input type="button" value="Tìm" id="timnhacc3" name="timnhacc3"
													style="width:40px" onclick="timkiemmuahang()" />
											</span></td>
									</tr>
									<tr>
										<td>NV giao hàng <input type="hidden" name="kho" id="kho" value="1">
											<input type="hidden" name="TiGia" id="TiGia" value="{TiGia}" /><input
												type="text" name="VAT" id="VAT" style="display:none">
										</td>
										<td><span style="padding-top:2px">
												<input type="text" name="nguoigiao" class="inpl" id="nguoigiao"
													onkeypress="return chuyentieps(event,'hoadongoc')"
													style="width:153px" value="{nguoigiao}" />
											</span> </td>
									</tr>
									<tr>
										<td>Phiếu đặt hàng:</td>
										<td><span style="padding-top:2px">
												<input type="text" name="phieudathang" class="inpl" id="phieudathang"
													onkeypress="return chuyentieps(event,'khachhang')"
													style="width:108px" value="{phieudathang}" />
											</span><span style="padding-top:2px">
												<input type="button" value="Tìm" id="timnhacc3" name="timnhacc3"
													style="width:40px" onclick="timkiemdathang()" />
											</span></td>
									</tr>
									<tr>
										<td height="20px" colspan="2">
										</td>
									</tr>
								</table>
							</fieldset>
						</div>


						<div style="float:none">
							<fieldset style="height:135px;margin:0">
								<legend> <a style="cursor:pointer" onClick=" anhienform('obj') ">
										<label style="Color:#5BB6E6;Font-Weight:Bold;Font-size:12pt">Nhà cung cấp
										</label>
									</a> </legend>

								<div style="padding-top:2px">
									<div style="float:left;width:80px"> Lý Do Nhập</div>
									<select name="lydo" id="lydo" style="width:170px"
										onkeypress="return chuyentiep(event,'nguoigiao')">
										{lydo}
									</select>

									Nhà Cung Cấp
									<select name="khachhang" id="khachhang" class="js-khachhang" style="width:280px"
										onchange="timdiachicc(this.value)" onkeypress="return chuyentiep(event,'note')">
										<option value="0">Chọn nhà cung cấp</option>
										{nhacungcap}
									</select>
									<div style="float:none"></div>
								</div>

								<div style="padding-top:2px">
									<div style="float:left;width:80px;padding-top:4px">Địa chỉ </div>
									<samp id="diachicc"> <input type="text" name="diachi" id="diachi" readonly=""
											style="width:539px" value="{diachi}" /></samp>
									<div style="float:none"></div>
								</div>

								<div style="padding-top:2px">
									<div style="float:left;padding-top:10px;width:80px"> Ghi Chú</div>
									<textarea id="note" name="note" class="texta"
										style='width:539px;height:42px;overflow:auto'>{note}</textarea>
									<div style="float:none"></div>
								</div>



							</fieldset>
						</div>
						<div style="clear:left"></div>
					</div>







					<div>
						<fieldset style="padding-top:5px">
							<legend> <a style="cursor:pointer" onClick="anhienform('chon')">
									<label style="Color:#5BB6E6;Font-Weight:Bold;Font-size:12pt">Chọn Hàng Hóa Nhập
										Kho</label>
								</a> </legend>
							<div id="chon" style="float:left">
								<div style="float:left;">
									Mã Nhà SX <input onkeypress="return chuyentiep(event,'IDGrouptk')" type="text"
										name="code" id="code" onkeyup="goispg(this.value)" class="text" size="9"
										value="" ondblclick="this.value=''" />
									Mã
									<input onkeypress="return chuyentiep(event,'IDGrouptk')" type="text"
										name="codeprotk" id="codeprotk" onkeyup="goisp(this.value)" class="text"
										size="9" value="" ondblclick="this.value=''" /> &nbsp;Tên
									SP
									<input onkeypress="return chuyentiep(event,'codeprotk')" type="text" name="NameTK"
										id="NameTK" class="text" size="10" value="" />
									&nbsp;



									Nhóm
									<select onkeypress="return chuyentiep(event,'search')" name="IDGrouptk"
										id="IDGrouptk" style="width:100px">
										<option value="0"></option>
										{cay}
									</select>
									&nbsp;
									<input type="button" style="width:40px"
										onclick="timsanpham(NameTK.value,codeprotk.value,code.value,IDGrouptk.value,'',kho.value)"
										name="search" id="search" value="Tìm" />
									</span>

									<input type="hidden" name="soluongcon" value="" />

									<input type="button" name="cl" style="width:40px" onclick="clearchon()"
										value="clear" />
									<input type="button" name="tm" style="width:110px;display:{q_themp}"
										onclick="thempt(NameTK.value,codeprotk.value,code.value,IDGrouptk.value)"
										value="Thêm Danh mục" />
								</div> 
								<input type="button" name="tm" style="width:100px;display:{q_themp}"
									value="Nhập từ Excel" onclick="nhapexcel1()" />
								<input type="button" name="tm2" style="width:100px;display:{q_themp}"
									value="Nhập từ In Mã" onclick="nhapinma()" />
								<div style="height:5px" id="cho"> </div>
								<div style="clear:left"></div>
								<div id="sanpham" style="padding-top:2px">

								</div>
							</div>
						</fieldset>

						<div style="padding-bottom:5px">
							<fieldset style="display:">
								<legend>
									<label style="Color:#5BB6E6;Font-Weight:Bold;Font-size:12pt">Hàng Hóa Nhập Kho
									</label>
								</legend>


								<div>Tên SP:
									<input type="text" name="tensp" id="tensp" class="inpl" style="width:340px"
										readonly="" value="" />
									&nbsp;&nbsp;Mã SP: &nbsp;
									<input type="text" name="masp" id="masp" class="inpl" style="width:150px"
										readonly="" value="" />
									<input type="hidden" name="idsp" id="idsp" value="" />
									<input type="hidden" name="sl" id="sl" value="" />
									Giá Bán <input type="text" name="giaban" id="giaban" maxlength="12"
										style="width:80px;" value="0" class="inpl" disabled="disabled" />
								</div>
								Ngoại tệ <input type="text" name="ngoaite" id="ngoaite" maxlength="12" class="text"
									style="width:50px;" value="0" onkeydown="return chuyentiep(event,'dongia')"
									onblur="tinhgia(this.value) ; " ondblclick="this.value=''" /> Tỉ giá:
								<input type="text" style="width:80px;" readonly="readonly" name="tigia" id="tigia"
									ondblclick="goitigia()" on value="{tigia}" />

								Giá nhập <input type="text" name="dongia" id="dongia" maxlength="12" class="text"
									style="width:80px;" value="0" onkeyup="formatchuan(this)"
									onkeydown="return chuyentiep(event,'soluong')" onblur="txtFormat(this)"
									ondblclick="this.value=''" />
								<select name="loaitien" id="loaitien" onkeyup="return chuyentiep(event,'soluong')"
									style="display:none">
									<option value="VND">VND</option>
									<option value="USD">USD</option>
								</select>
								Số lượng
								<input type="text" name="soluong" id="soluong"
									onkeyup="return chuyentieps(event,'thue')" class="text" style="width:40px"
									value="1" />
								Thuế
								<select onkeyup="return chuyentiep(event,'ghichu')" name="thue" id="thue"
									style="width:58px">
									<option value="0">--</option>
									<option value="5">5%</option>
									<option value="10">10%</option>
									<option value="15">15%</option>
									<option value="20">20%</option>
									<option value="30">30%</option>
									<option value="40">40%</option>
									<option value="50">50%</option>
									<option value="100">100%</option>

								</select>
								&nbsp;

								Ghi chú:
								<input type="text" name="ghichu" id="ghichu" onkeyup="return chuyentiep(event,'add')"
									style="width:200px" value="" />
								<input type="button" name="add" id="add" style="width:50px"
									onclick="addpro(idsp.value,tensp.value,masp.value,dongia.value,giaban.value,soluong.value,thue.value,ghichu.value,'')"
									value="ADD" onkeyup="return chuyentiep(event,'NameTK')" />

							</fieldset>
						</div>

						<div id="sanphamnhap" style="height:200px;overflow:scroll;">
							<table width="100%" border="0" cellpadding="0" cellspacing="0">
								<tr bgcolor="#F8E4CB">
									<td width="29" align="center" class="cothienthi" height="23"><b>STT</b></td>
									<td width="115" align="center" class="cothienthi"><strong>Mã Hàng Hóa </strong></td>
									<td width="310" align="center" class="cothienthi"><strong>Tên Hàng Hóa</strong></td>
									<td width="48" align="center" class="cothienthi"><strong>SL</strong></td>
									<td width="152" align="center" class="cothienthi"><strong>Đơn Giá </strong></td>
									<td width="51" align="center" class="cothienthi"><strong>Thuế</strong></td>
									<td width="164" align="center" class="cothienthi"><strong>Thành Tiền </strong></td>
									<td width="250" align="center" class="cothienthi"><strong>Ghi Chú </strong></td>
									<td width="45" align="center" class="cothienthi"><strong>X&#243;a</strong></td>
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

						<!-- ==================================BD 333 3===================================== -->
						<div style="padding-top:3px;font-size:14px;">Tiền hàng
							<input type="text" name="tienhang" id="tienhang" maxlength="14" class="text"
								style="width:100px;font-size: 16px;text-align:right" value="0" readonly="" />
							&nbsp; Tổng chiết khấu
							<input type="text" name="tongchietkhau" id="tongchietkhau" maxlength="14" class="text"
								style="width:90px;font-size: 16px;text-align:right" value="0" readonly="" /> &nbsp; Tổng
							tiền
							<input type="text" name="tongtienhang" id="tongtienhang" maxlength="14" class="text"
								style="width:100px;font-size: 16px;text-align:right" value="0" readonly="" /> &nbsp; Đã
							trả
							<input type="text" name="datratien" onblur="tinhlai(this.value)" onkeyup="formatchuan(this)"
								id="datratien" maxlength="14" class="text"
								style="width:100px;font-size: 16px;text-align:right" value="0" />
							&nbsp; Còn nợ
							<input type="text" name="conno" id="conno" maxlength="14" class="text"
								style="width:100px;font-size: 15px;text-align:right" value="0" readonly="" />
						</div>

						<div style="padding-top:9px; "><span class="cungdong1">
								<input type="button" name="luu" id="luu" style="width:70px;display:{q_luu}"
									onclick="return  luuphieunhap()" value="Lưu" {} />
								<input type="button" name="themmoi" id="themmoi" style="width:70px;display:{q_them}"
									onclick="window.open('default.php?act=nhapkho','_self')" value="Thêm Mới" />
								<input type="button" name="copy" id="copy" onclick="copyp()" disabled="disabled"
									value="Copy" style="display:none;width:70px" />
								<input type="button" name="khoa" id="khoa" disabled="disabled"
									style="width:80px;display:{q_khoa}" onclick="khoaphieu()" value="Khóa Phiếu" />

								<input type="button" name="inan" id="inan" style="display:;width:100px;display:{q_in}"
									onclick="goiin()" value="In Phiếu Nhập" />
								<input type="button" name="timnhap" id="timnhap" style="width:105px;display:{q_tim}"
									onclick="timphieu()" value="Tìm Phiếu Nhập" />
								<input type="button" name="timnhap32" id="timnhap32" style="display:none;width:80px"
									onclick="huongdan()" value="Hướng Dẫn" />
								<input type="button" name="timnhap3" id="timnhap3" style="width:80px"
									onclick="matdinh()" value="Đóng lại" />
								&nbsp;&nbsp; &nbsp; &nbsp;
								<input type="button" name="huyphieu" id="huyphieu" disabled="disabled"
									style="width:80px;display:{q_huy}" onclick="goihuyphieu(idgoi.value,'nk')"
									value="Hủy Phiếu" />
								&nbsp; &nbsp; &nbsp; &nbsp;
								<!-- BEGIN: block_admin1 -->
								<input type="button" name="phuchoi" id="phuchoi" style="width:80px"
									onclick="goiphuchoi(idgoi.value,note.value)" value="Phục hồi" />
								<!-- END: block_admin1 -->
							</span> </div>


						<div id="ketqualuu" style="width:800"></div>
						<div id="luutimsp" style="display:none"></div>
						<div id="luubd" style="display:none"></div>
						<div id="tenform" style="display:none">nhapkho</div>
						<!-- =================================KT 33333====================================== -->


						<div style="clear:left;display:none" id="khonghienthi"></div>
					</div>

			</form>

		</fieldset>

		<div id="hienthianh"
			style="display:none ;z-index:99999; overflow:hidden; position:absolute;   top: 90px;left:0;width:100%; "
			align="center">
			<div style=" width:900px; min-height:510px;border:1px #999 solid; background-color:#FFF; opacity: 0.98;font-size:15px; 
  font-weight:bold; padding:5px; color:#F00;">
				<div align="right"><b style="color:#00F;cursor:pointer" onclick="goidongid('hienthianh')">( X Đóng lại
						)</b></div>
				<div id="htanh">

				</div>
			</div>

		</div>




		<div id="hiennhapexcel"
			style="display:none; overflow:hidden; position:absolute;   top: 90px;left:0;width:100%; " align="center">
			<div style=" width:900px; min-height:510px;border:1px #999 solid; background-color:#FFF; opacity: 0.98;font-size:15px; 
  font-weight:bold; padding:5px; color:#F00;">

				<div align="right"><b style="color:#00F;cursor:pointer" onclick="goidongid('hiennhapexcel')">( X Đóng
						lại )</b></div>

				<div id="timexxcel" style="padding:10px">


					<input id="mangfilean" type="hidden" size="25" name="mangfilean" value="" />
					<label>File nhập kho từ Excel *.xlsx</label>
					<input id="fileToUpload" type="file" accept=".xlsx" size="35" name="fileToUpload" class="input"
						style="height:22px" />
					<button class="button" id="buttonUpload" onclick="return ajaxFileUpload();" style="height:22px">Tải
						lên</button>&nbsp;

					<div id="hienthiexcel" style="padding:5px">
						<table id="tbex" width="100%" border="0" cellpadding="0" cellspacing="0"
							style="background:#FFF;" class="tbchuan">
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

								<td width="75" align="center" class="cothienthi">Mẫu tải</td>

								<td width="360" align="center" class="cothienthi">Tên hàng hóa không bắt buộc lấy từ
									dòng 2 nhé</td>
								<td width="39" align="center" class="cothienthi">9</td>
								<td width="40" align="center" class="cothienthi">99000</td>

								<td width="312" align="center" class="cothienthi">Trong file dòng nào cũng có mã nhé
								</td>

							</tr>
						</table>


					</div>

				</div>
			</div>






		</div>




		<div id="hienthitigia"
			style="display:none; overflow:hidden; position:absolute;   top: 201px;left:-220px;width:100%; "
			align="center">
			<div
				style=" width:200px; min-height:110px;border:1px #999 solid; background-color:#FFF; opacity: 0.98;font-size:15px; font-weight:bold; padding:5px; color:#F00;">
				<div style="padding-bottom:5px"> Tỉ giá mới</div><input type="text" id="tigiamoi" name="tigiamoi"
					value="{tigia}" onkeyup="formatchuan(this)" style="width:100px" /> <br /> <br /><input id="luutg"
					name="luutg" value="Lưu tỉ giá" onclick="luutigia(tigiamoi.value)" type="button" />


				<input id="boqua" name="boqua" value="Bỏ qua" onclick="donglai('hienthitigia')" type="button" />
			</div>
		</div>
	</div>




	<div id="hienthianh" style="display:none;width:90%;text-align:center  ">
		<div id="htanh">


		</div>

	</div>
	<script src="js/jquery-1.7.2.min.js"></script>
	<script src="js/select2.min.js"></script>
	<link rel="stylesheet" media="screen" href="js/select2.min.css">
	<script language="JavaScript">
		document.getElementById('sochungtu').focus();
		document.getElementById('luubd').innerHTML = document.getElementById('sanphamnhap').innerHTML;
		document.getElementById('luutimsp').innerHTML = document.getElementById('sanpham').innerHTML;
		document.getElementById('timphieunhap').style.display = 'none';
		document.getElementById('hiennhapexcel').style.display = 'none';
		document.getElementById('timmuahang').style.display = 'none';
		document.getElementById('timdathang').style.display = 'none';


		$(document).ready(function () {
			$('.js-khachhang').select2();

		});
	</script>
	<script language="javascript" src="templates/nhapkho.js"> </script>

	<script type="text/javascript" src="templates/ajaxfileupload.js"></script>