<style> .wrapper{ 	width:1200px; 	height:140vh; min-width:1000px } .header { width:1200px; }</style>
<form name="frmxuat" id="frmxuat" method="get">
	<div class="nenbao">
		<div style="padding:0px">
			<fieldset class="nencon">
				<legend> <a style="cursor:pointer">
						<label style="Color:#FF3300;Font-Weight:Bold;Font-size:11pt;">Phiếu Bán Hàng </label>
					</a> </legend>


				<table border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td valign="top">
							<div style=" height:511px;width:280px">
								<div style="margin-top:5px;margin-bottom:5px">
									<fieldset style="height:151px;width:280px">
										<legend>
											<label style="Color:#5BB6E6;Font-Weight:Bold;Font-size:12pt;" > Ngày Bán:</label><label style="Color:#5BB6E6;Font-Weight:Bold;Font-size:12pt;" id="thongtinphieu"> {ngaynhap}</label>
										</legend>
										<table width="100%" border="0" cellpadding="1" cellspacing="2"
											style="padding-top:0px">


											<tr>
												 <td><b onclick="doithungan()" style="cursor:pointer">Thu ngân</b></td>
												<td  > 
													 
													<img src="images/img.gif" id="Lichtungaytao"
														style="display:none;cursor: pointer; border: 0px solid red;"
														title="Date selector"
														onclick="displayCalendar(frmnhap.ngaynhap,'dd/mm/yyyy',this)" />
													<input name="nguoitao123" id="nguoitao123" type="text" value="{ten}" 	style="border:0px;width:185px" />
														 <input name="idgoi" id="idgoi" type="hidden" value="" />
														 <input name="idthungan" id="idthungan" type="hidden" value="{idthungan}" />												</td>
											</tr>
											<tr>
												<td width="28%" valign="middle">Taget BHNV</td>
												<td><select class="js-nvht"
														onkeypress="return chuyentiep(event,'search')"
														name="idgioithieu" id="idgioithieu" style="width:160px">
														<option value="0"></option>
														<option value="-1">Khách online lấy hàng trực tiếp</option>
														{nhanvienhethong}
													</select></td>
											</tr>
											<tr>
												<td>Số C.Từ</td>
												<td>:<input type="text" name="sochungtu" class="inpl" id="sochungtu"
														readonly="" onkeyup="return chuyentieps(event,'kho')"
														style="width:139px" value="{sochungtu}"
														onblur="kttrung(this.value)" /></td>
											</tr>
											<tr>
												<td height="20px" valign="top">Chi Nhánh
													<input type="hidden" name="idkho" id="idkho" value="{idkho}"><input type="hidden" name="kho" id="kho" value="1"><input
														type="hidden" name="ol" id="ol" value="{ol}">
													<input type="hidden" name="TiGia" id="TiGia"
														value="{TiGia}" /><input type="text" name="VAT" id="VAT"
														style="display:none">												</td>
												<td valign="top"><textarea id="textarea" name="textarea"
														readonly="readonly"
														style='width:160px;height:20px;overflow:auto;background-image: url("../images/dot_xanh.gif");border:0px; font-family: verdana; font-size: 1.1em; color:#0000FF'>:{tencuahang}</textarea>												</td>
											</tr>
											<tr>
												<td height="20px" valign="top">NV Bán												</td>
												<td valign="top"><select class="js-nv"
														onkeypress="return chuyentiep(event,'search')" name="online"
														id="online" style="width:160px">
														<option value="0"></option>
														<option value="">Khách tự mua</option>
														{nhanvienonline}
													</select></td>
											</tr>
										</table>
									</fieldset>
								</div>


								<fieldset style="height:378px;width:280px;margin:0">
									<legend> <a style="cursor:pointer" onClick=" anhienform('obj') ">
											<label style="Color:#5BB6E6;Font-Weight:Bold;Font-size:12pt;cursor:pointer"
												onclick="goikhach()">Thông tin khách hàng </label>
										</a></legend>



									<div style="margin-bottom:10px;padding-top:0px">
										<div onclick="timkhachhang()">
											<div style="padding-top:2px"><strong>Tên KH</strong>:<span id="tenkh"
													class="tieudesp">Khách mua lẻ</span> </div>
											<div style="padding-top:5px;height:21px;overflow:hidden;display:none">
												<strong>Địa chỉ</strong>:<span id="dckh" class="tieudesp">Khách mua	lẻ</span></div>
											 <input type="hidden" name="idkh" id="idkh" value="1" />
										</div>

									 
									 
									<div style="padding-bottom:0px;padding-top:5px; line-height:21px;">

										Lý Do &nbsp; &nbsp;
										<select name="lydo" id="lydo" style="width:185px"
											onkeypress="return chuyentiep(event,'nguoigiao')"
											onchange="kiemtrach(this.value)">
											{lydo}
										</select>
										<br />Lý do trả	<select name="lydotra" id="lydotra" style="width:183px;display: "
											onkeypress="return chuyentiep(event,'nguoigiao')"
											onchange="kiemtrach(this.value)">
											<option value="0"> </option>
											{lydotra}
										</select>
								<br />
										
										
											Loại thanh toán 
										    <select name="loaithanhtoan" id="loaithanhtoan" style="width:147px"  >
											 <option value="0">Tiền mặt</option>
											  <option value="1">Chuyển khoản</option>
											  <option value="2">Vnpay pos</option>
											  <option value="3">Vietinbankpos</option>
											  <option value="4">Công nợ nhà vc ( GHTK, ninja, viettelpos)</option>
										</select>
									</div>
										<div style="padding-bottom:0px; padding-top:0px;display:none;" id="passdon">
											<input type="text" name="mavandon" id="mavandon" placeholder="Nhập ID Chat"
												style="font-size:16px;background: url(../images/nenbh.jpg);width:105px;height:29px;color:#FF0000"
												ondblclick="this.value=''" maxlength="50" value="">

											<select class="js-ol" onkeypress="return chuyentiep(event,'search')"
												name="nvonline" id="nvonline" style="width:135px">
												<option value="">Chọn nv pass đơn</option>
												<option value="-1">Không có</option>
												{nhanvienonline}
											</select>
										</div>
									</div>

									

									<div style="padding-bottom:1px; display:none" id="cuahangdiv">
										Cửa hàng <select class="js-ch" onkeypress="return chuyentiep(event,'search')"
											name="cuahang" id="cuahang" style="width:190px">
											<option value="0">Chọn cửa hàng</option>
											{cuahang}
										</select>
									</div>
									<span style="display:none"><b id="nhanqua" style="display: ;color:red; ">
											<input type="hidden" id="chonnhanqua" name="chonnhanqua"
												style="cursor:pointer;display:none ;" value="1" />
											<input type="hidden" id="diem" name="diem" disabled="disabled" size="6"
												value="" /></b></span>
								 
									<div style="padding-bottom:5px">Ghi chú: <span id="tt"></span>   </div>
									<textarea id="note" name="note" class="texta"
										style='width:242px;height:30px;overflow:auto'></textarea>
									<div style="font-size:16px">
										<div style="padding-top:4px"> &nbsp;Mã giảm giá:
											<input type="text" name="makm" id="makm"
												style="font-size:16px;background: url(../images/nenbh.jpg);width:140px;color:#FF0000"
												onblur="kiemtrama(this.value)" ondblclick="this.value=''" maxlength="25"
												onkeypress="return chuyentiep(event,'luu')" value="" />
										</div>
										<div class="tinhtien"> &nbsp;Tổng Tiền: <strong><span id="tongtien"
													style="font-size:20px;color:#FF0000"></span></strong> </div>
										<div class="tinhtien"> &nbsp;
											Khách đưa: <input type="text"
												style="font-size:20px;background: url(../images/nenbh.jpg);width:120px;color:#FF0000"
												ondblclick="this.value=''" name="khachdua" id="khachdua" maxlength="12"
												onkeypress="return chuyentiep(event,'luu')" value=""
												onkeyup="txtFormat(this);tinhtien(this.value);"
												onblur="txtFormat(this)" />
										</div>
										<div class="tinhtien" align="right" style="padding-right:19px">Voucher: <input
												type="text"
												style="font-size:20px;background: url(../images/nenbh.jpg);width:120px;color:#FF0000"
												ondblclick="this.value=''" name="bot" id="bot" maxlength="12"
												onkeypress="return chuyentiep(event,'luu')" value=""
												onkeyup="txtFormat(this);tinhtienbot(this.value);"
												onblur="txtFormat(this);kiemtradongthoi(this.value);" /> </div>

										<div class="tinhtien"> &nbsp;Trả lại: <strong><span id="tralai"
													style="color:#FF0000;font-size:20px"></span></strong> </div>
									</div>
								</fieldset>
							</div>						</td>



						<td style="padding-left:5px" valign="top">
							<!-- chọn hàng hóa -->
							<div style=" height:450px;width:800px; margin-top:5px;">
								<fieldset style="padding-top:5px">
									<legend> <a style="cursor:pointer" onClick="anhienform('chon')">
											<label style="Color:#5BB6E6;Font-Weight:Bold;Font-size:12pt">Chọn Hàng Hóa
												Bán Hàng </label>
										</a> </legend>

								<div id="chon" style="line-height:28px"> <input onkeypress="return chuyentiep(event,'khachdua')" placeholder="Mã SP"
											autocomplete="off" type="text" name="codeprotk" id="codeprotk"
											onkeyup="goisp(this.value)" class="text" size="7" value=""
											ondblclick="this.value=''" />
										<input onkeypress="return chuyentiep(event,'codeprotk')"
											ondblclick="this.value=''" placeholder=" Tên SP " type="text" name="NameTK"
											id="NameTK" class="text" size="7" value="" />
										<input onkeypress="return chuyentiep(event,'codeprotk')"
											ondblclick="this.value=''" placeholder="Mô tả" type="text" name="mota"
											id="mota" class="text" size="8" value="" />
										<input type="hidden" name="code" id="code" class="text" size="10" value="" />


										<select onkeypress="return chuyentiep(event,'search')" name="IDGrouptk"
											id="IDGrouptk" style="width:140px;display:none">
											<option value="0">Nhóm sản phẩm</option>
											{cay}
										</select>

										&nbsp;
										<input type="button" style="width:43px"
											onclick="timsanpham(NameTK.value,codeprotk.value,code.value,IDGrouptk.value,'',kho.value,mota.value)"
											name="search" id="search" value="Tìm" /> 
										<input type="hidden" name="soluongcon" value="" />
										<input type="button" name="cl22" style="width:80px;display:none"
											onclick="setmua2tang1()" value="Mua 2 tặng 1" />
										<input type="button" name="cl223" style="width:62px;display:none"
											title="mua 2 giảm 70% sản phẩm thứ 3" onclick="setmua2giam70()"
											value="2 giảm 70" />
										<input type="button" name="cl223" style="width:40px;"
											title="mua 3 giảm 30%, 4 giảm 50%, mua 5 giảm 70% sản phẩm giá thấp nhất trong 5 sản phẩm từ ngày 1-9->4-9"
											onclick="setkhuyenmai('345','30','50','70')" value="345" />
										<input type="button" name="cl2232" style="width:46px"  onclick="setmuantang1(4)"
											title="mua 3 tặng 1 sản phẩm giá thấp nhất trong 4 sản phẩm"
											value="3tặng1" />
						<input type="button" name="cl22322" style="width:46px" onclick="setmuantang1(5)"
											title="mua 4 tặng 1 sản phẩm giá thấp nhất trong 5 sản phẩm"
											value="4tặng1" />

										<input type="button" name="cl222" style="width:80px;display:none"
											onclick="phuchoibandau()" value="Phục hồi" /> 

										<input type="button" name="cl23" style="width:46px;display:none"
											onclick="setmuaNgiamM(2,50)" value="M2G50"
											title="Chương trình cho nhân viên thời vụ , giảm 50% sản phẩm thứ 2 nhỏ nhất (  chỉ giảm 1 sản phẩm trong đơn)" />

										<input type="button" name="cl23" style="width:55px"
											onclick="setkhuyenmai('234','0','50','70')" value="M34G57"
											title="Mua 4 SP , giảm 70% sản phẩm thứ 4 nhỏ nhất" />
										
										<input type="button" name="cl233" style="width:51px"
											onclick="setmuaNgiamMn(3,50)" value="M3G50" style="display:none"
											title="Mua 4 SP , giảm 70% sản phẩm thứ 4 nhỏ nhất" />
										<input type="button" name="cl24" style="width:40px" 
											onclick="setcungluc('123','0','10','20')" value="GC23"
											title="giảm cùng lúc khi Mua sp 2 giảm 10%, sp 3 giảm 20% sản phẩm nhỏ nhất" />
										<input type="button" name="cl24" style="width:40px;display:none" onclick="set24giam34()"
											value="GC24"
											title="giảm cùng lúc khi Mua sp 2 giảm 20%, sp 4 giảm 40% sản phẩm nhỏ nhất" />
										<input type="button" name="cl24" style="width:41px ;display:none "
											onclick="setcungluc('234','20','0','40')" value="GC34"
											title="giảm cùng lúc khi Mua 4sp,sp 3 giảm 20%, sp 4 giảm 40% sản phẩm nhỏ nhất" />
										<input type="button" name="cl24" style="width:41px"
											onclick="setcungluc('345','20','40','0')" value="5SP"
											title="Giảm cùng lúc khi Mua 5sp,sp 3 giảm 20%, sp 4 giảm 40% sản phẩm nhỏ nhất" />
										<input type="button" name="cl24" style="width:40px"
											onclick="setkhuyenmai('234','20','30','80')" value="K234"
											title="Mua 2 giảm 20, 3 giảm 30, 4 giảm 80 sản phẩm nhỏ nhất" />
										<input type="button" name="cl232" style="width:52px;display:none"
											onclick="setmuaNgiamSP(3,66000)" value="M3C66"
											title="Mua 3 SP , giảm 66k sản phẩm thứ 3 nhỏ nhất" />
										<input type="button" name="dsd2" style="width:42px; "
											onclick="setmuaNgiamMn(3,50)" value="3G50"
											title="Mua 3 giảm 50% sản phẩm nhỏ nhất" />
										<input type="button" name="cl242" style="width:40px"
											onclick="setkhuyenmai('234','20','50','80')" value="G234"
											title="Mua 2 giảm 20, 3 giảm 50, 4 giảm 80 sản phẩm nhỏ nhất" />
								          &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;    &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; 
								      &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;   <input type="button" name="cl2422" style="width:40px"
											onclick="setcungluc('123','0','10','30')" value="D23"
											title="Mua 2 giảm 10, Mua 3 sản phẩm  sp 2 giảm 10% và sp 3 giảm 30% sản phẩm nhỏ nhất" /> 
								      <input type="button" name="cl2233" style="width:50px;"
											title="Từ 8-11 tháng 9    mua 2 giảm 30%, mua 4 giảm 80% sản phẩm  giá thấp nhất nguyên giá"
											onclick="setgiammn('2','4','30','80')" value="G24" />  
								      &nbsp;
								      <input type="button" name="cl24222" style="width:45px"
											onclick="setcungluc('123','10','10','10')" value="G10%"
											title="Giảm 10 % tất cả mặt hàng" />
								      <input type="button" name="cl22332" style="width:99px;"
											title="Từ 27-31 mua 2 sản phẩm trở lên giảm tất cả 10%, từ 5 sản phẩm giảm 15%, hoặc 2 sp và là thành viên bạc trở lên "
											onclick="set25giam1015('2','5','10','15')" value="M25G10%-15%" />
								        <input type="button" name="dsd" style="width:58px; "
											onclick="ctrinh4_20k()" value="345U99"
											title="Mua 3 giảm 50%, 4 giảm 70%, 5 giảm 99% sản phẩm nhỏ nhất từ 27-31 tháng 8"  />
								        <input type="button" name="cl" style="width:36px" onclick="clearchon()" value="clear" />
								</div>
								<div style="height:0px" id="cho"> </div>


									<div id="sanpham" style="padding-top:4px"> </div>
								</fieldset>


								<div style="padding-bottom:5px">
									<fieldset style="display:">
										<legend>
											<label style="Color:#5BB6E6;Font-Weight:Bold;Font-size:12pt">Hàng Hóa Khách
												Mua</label>
										</legend>


										<div>Tên SP:
											<input type="text" name="tensp" id="tensp" class="inpl" style="width:290px"
												readonly="" value="" />
											&nbsp;&nbsp;Mã SP: <input type="text" name="masp" id="masp" class="inpl"
												style="width:100px" readonly="" value="" /> Mô tả <input type="text"
												name="mt" id="mt" class="inpl" style="width:100px" readonly=""
												value="" />
											<input type="hidden" name="idsp" id="idsp" value="" />
											<input type="hidden" name="sl" id="sl" value="" />
											<input type="hidden" name="giachan" id="giachan" value="0" />
											<input type="hidden" name="giagiam" readonly="" id="giagiam" value="0" />
											<input type="hidden" name="giamgop" readonly="" id="giamgop" value="0" />
										</div>
										Giá
										<input type="text" name="dongia" id="dongia" maxlength="12" class="text"
											style="width:75px;" value="0" {giahienthi} onkeydow=" onlyinta(this)"
											onkeyup="return chuyentiep(event,'soluong')" onkeypress="txtFormata(this)"
											onblur="txtFormat(this)" />
										<select name="loaitien" id="loaitien"
											onkeyup="return chuyentiep(event,'soluong')" style="display:none">
											<option value="VND">VND</option>
											<option value="USD">USD</option>
										</select>
									SL <input type="text" name="soluong" id="soluong" onkeyup="return chuyentieps(event,'chietkhau')" class="text" style="width:35px" value="1" />
									Giá 2 <input type="text" name="dongia2" id="dongia2" maxlength="12" class="text" style="width:70px;" value="" onkeydow=" onlyinta(this)" onkeyup="return chuyentiep(event,'soluong')" onkeypress="txtFormata(this)" onblur="txtFormat(this)" />
									
										<b ondblclick="setchietkhauchung(chietkhau.value)">Chiết khấu</b>
										<input name="chietkhau" ondblclick="this.value=0" id="chietkhau" value=""
											type="text" style="width:33px" />
										<select onkeyup="return chuyentiep(event,'ghichu')" name="chietkhauc"
											id="chietkhauc" style="width:58px" onchange="setchietkhau(this.value)">
											<option value="0">--</option>
											<option value="2">2%</option>
											<option value="3">3%</option>
											<option value="4">4%</option>
											<option value="5">5%</option>
											<option value="6">6%</option>
											<option value="7">7%</option>
											<option value="8">8%</option>
											<option value="9">9%</option>
											<option value="10">10%</option>
											<option value="15">15%</option>
											<option value="16">16%</option>
											<option value="17">17%</option>
											<option value="18">18%</option>
											<option value="19">19%</option>

											<option value="20">20%</option>
											<option value="21">21%</option>
											<option value="22">22%</option>
											<option value="23">23%</option>
											<option value="24">24%</option>
											<option value="25">25%</option>
											<option value="26">26%</option>
											<option value="27">27%</option>
											<option value="28">28%</option>
											<option value="29">29%</option>
											<option value="30">30%</option>
											<option value="35">35%</option>
											<option value="40">40%</option>
										</select>
										&nbsp;

										Ghi chú:
										<input type="text" autocapitalize="none" autocomplete="off" autocorrect="off" required="" name="ghichu" id="ghichu"  style="width:200px" value="" />
										<input type="button" name="add" id="add" style="width:50px"
											onclick="addpro(idsp.value,tensp.value,masp.value,dongia.value,loaitien.value,soluong.value,chietkhau.value,ghichu.value,giachan.value,mt.value,giagiam.value,giamgop.value,sl.value)"
											value="ADD" onkeyup="return chuyentiep(event,'NameTK')" />
									</fieldset>
								</div>
								<div style=" max-height:350px;overflow:scroll">

									<div id="sanphamxuat">
										<table width="100%" border="0" cellpadding="0" cellspacing="0">
											<tr bgcolor="#F8E4CB">
												<td width="29" align="center"  height="23"><b>STT</b>												</td>
												<td width="115" align="center" ><strong>Mã Hàng Hóa
													</strong></td>
												<td width="310" align="center" ><strong>Tên Hàng Hóa</strong></td>
												<td width="48" align="center" ><strong>SL</strong></td>
												<td width="152" align="center" ><strong>Đơn Giá</strong></td>
												<td width="51" align="center" ><strong>CK</strong></td>
												<td width="164" align="center" ><strong>Thành Tiền
													</strong></td>
												<td width="250" align="center" ><strong>Ghi Chú
													</strong></td>
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
					</tr>
				</table>

				<div style="padding-top:24px;font-size:16px;padding-bottom:10px">
					<input class="chucnang" type="button" name="luu" id="luu" style="width:70px;display:{q_luu}"
						onclick="return  luuphieuxuat()" value="Lưu" {} />
					<input class="chucnang" type="button" name="themmoi" id="themmoi"
						style="width:75px;display:{q_them}" onclick="window.open('default.php?act=xuatkho','_self')"
						value="Thêm Mới" />
					<input class="chucnang" type="button" name="copy" id="copy" onclick="copyp()" disabled="disabled"
						value="Copy" style="display:none;width:70px" />
					<input type="chucnang" name="khoa" id="khoa" disabled="disabled" style="width:80px;display:{q_khoa}"
						onclick="khoaphieu()" value="Khóa Phiếu" />
					<input type="button" class="chucnang" name="inan" id="inan" style=" width:100px;display:{q_in}"
						disabled="disabled" onclick="goiin()" value="In Phiếu" />
					<input type="button" class="chucnang" name="huyphieu" id="huyphieu" disabled="disabled"
						style="width:80px;display:{q_huy}" onclick="goihuyphieu(idgoi.value,'nk')" value="Hủy Phiếu" />
					<input type="button" class="chucnang" name="timxuat" id="timxuat"
						style="width:105px;display:{q_tim}" onclick="timphieu()" value="Tìm Phiếu " />
					<input type="button" class="chucnang" name="timxuat32" id="timxuat32"
						style="display:none;width:80px" onclick="huongdan()" value="Hướng Dẫn" />
					<input type="button" class="chucnang" name="timxuat3" id="timxuat3" style="width:80px"
						onclick="matdinh()" value="Đóng lại" /> <!-- BEGIN: block_admin1 -->
					<input type="button" class="chucnang" name="phuchoi" id="phuchoi" style="width:80px"
						onclick="goiphuchoi(idgoi.value,note.value)" value="Phục hồi" />

					<input type="button" class="chucnang" disabled="disabled" name="xoaphieu" id="xoaphieu"
						style=" width:90px;display:none" onclick="xoaphieux(sochungtu.value)" value="Xóa phiếu" />
					<!-- END: block_admin1 -->
					<input type="button" class="chucnang" name="thongtin" id="thongtin"
						style="display:{q_tim}" onclick="nhapthongtin()" value="Xác nhận thông tin" />

					&nbsp; <select name="chonnhac" id="chonnhac" style="width:95px" onchange="doinhac(this.value)">
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
					&nbsp;
					<input type="button" onclick="resetpromo()" name="reset" id="resetpromotion"
						value="Phục hồi lần trước đó">
					<input type="button" name="cttuancuoithang" onclick="giamtructiep()" value="CT Nam-Ngọc"
						title="Từ 29-9 -> 2-10 HĐ từ 300K giảm 30K, HĐ từ 500k giảm 60K, HĐ từ 1.000K giảm 150K" />
					<input type="button" name="ctsinhvien" onclick="ctrinh_sinhvien()" value="CT Sinh Viên"
						title="Giảm 15% vào ngày thứ 4 hằng tuần. Áp dụng cho sinh viên" />
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


	<div id="hienthongbao" style="display:none; overflow:hidden; position:absolute;   top: 90px;left:0;width:100%; "
		align="center">
		<div
			style=" width:950px; min-height:510px;border:1px #999 solid; background-color:#FFF; opacity: 0.98;font-size:15px; font-weight:bold; padding:5px; color:#F00;">

			<div align="right"><b style="color:#00F;cursor:pointer" onclick="goidong()">( X Đóng lại )</b></div>

			<div id="timphieuxuat">
				<fieldset>
					<legend align="center"><label style="Color:#5BB6E6;Font-Weight:Bold;Font-size:14pt;cursor:pointer"
							onclick="anhien2f('ankhachhang','khachangchitiet')">Tìm phiếu xuất </label>
					</legend>


					<div style="padding-bottom:5px"><br />

						<select name="khoaphieut" id="khoaphieut" style="width:89px"
							onkeypress="return chuyentiep(event,'sophieut')">
							<option value="1">Đã Khóa</option>
							<option value="0">Chưa khóa</option>
							<option value="">Tất Cả</option>
						</select>
						<select name="nc" id="nc" style="width:110px" onkeypress="return chuyentiep(event,'sophieut')">
							<option value="0">Tìm chính xác số phiếu</option>
							<option value="1">Tìm từ trái qua phải</option>
							<option value="2">Tìm phải qua trái</option>
							<option value="3">Tìm ngẫu nhiên</option>
							<option value="4">Tìm Phiếu lưu</option>
						</select>


						<input type="text" name="sophieut" id="sophieut" placeholder="Số phiếu" class="inpl"
							style="width:100px" onkeypress="return chuyentiep(event,'tungay')" value="" />
						&nbsp;
						<input type="text" name="sotien" id="sotien" placeholder="Số tiền" class="inpl"
							style="width:65px" onkeypress="return chuyentiep(event,'tungay')" value="" />
						Từ ngày
						<input onkeypress="return chuyentiep(event,'denngay')" type="text" name="tungay" id="tungay"
							class="text" style="width:68px" value="{tungay}" />
						<img src="images/img.gif" id="Lichtungaytao" style="cursor: pointer; border: 0px solid red;"
							title="Date selector"
							onclick="displayCalendar(frmxuat.tungay,'dd/mm/yyyy',this)" />&nbsp;đến ngày
						<input onkeypress="return chuyentiep(event,'timk')" type="text" name="denngay" id="denngay"
							class="text" style="width:68px" value="{denngay}" />
						<img src="images/img.gif" id="Lichtungaytao" style="cursor: pointer; border: 0px solid red;"
							title="Date selector" onclick="displayCalendar(frmxuat.denngay,'dd/mm/yyyy',this)" />&nbsp;

						<input type="button"
							onclick="timdsphieuxuat(0,sophieut.value,'',tungay.value,denngay.value,khoaphieut.value,0,sotien.value,nc.value)"
							style="width:60px" name="timk" id="timk" value="Tìm kiếm" />

						<input type="button" name="timxuat2" id="timxuat2" style="width:68px" onclick="timphieu()"
							value="Quay Lại" />
					</div>
					<div id="httimxuat" style="color:#000000">
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr bgcolor="#F8E4CB">
								<td align="center"  height="23" width="111"><b>Số Phiếu </b></td>
								<td width="79" align="center" ><strong>Ngày nhập </strong></td>

								<td width="296" align="center" ><strong>Lý Do </strong> </td>
								<td width="185" align="center" ><strong>Người giao hàng </strong></td>
								<td width="398" align="center" ><strong>Nhà cung cấp </strong></td>
								<td width="162" align="center" ><strong>Người Tạo</strong></td>
							</tr>
						</table>
					</div>
					<div id="httimlai"></div>


				</fieldset>
			</div>


			<div id="timkhachhanght">
				Mã KH
				<input type="text" name="ma" ondblclick="this.value=''" id="ma" onkeyup="goikh(this.value)" class="inpl"
					style="width:80px" onkeypress="return chuyentieps(event,'kv')" value="" />

				Tên
				<input type="text" name="ten" id="ten" ondblclick="this.value=''" class="inpl" style="width:80px"
					onkeypress="return chuyentiep(event,'diachitim')" value="" />
				Số ĐT
				<input type="text" name="dt" ondblclick="this.value=''" id="dt" class="inpl" style="width:80px"
					onkeypress="return chuyentieps(event,'cmnd')" value="" />
				CMND
				<input type="text" name="mc" ondblclick="this.value=''" id="cm" class="inpl" style="width:80px"
					onkeypress="return chuyentieps(event,'kv')" value="" />


				<select class="compo" name="nhom" id="nhom" onkeypress="return chuyentieps(event,'search2')"
					style="width:100px;">
					<option value="">Nhóm KH</option>
					<option value="0">Nhóm mặc định</option>
					{nhomkh}
				</select>
				</span> <span style="padding-bottom:10px">
					<input type="button" style="width:40px"
						onclick="timkiemkh(ten.value,dt.value,ma.value,'',nhom.value,cm.value)" name="search2"
						id="search2" value="Tìm" />
					&nbsp; <input type="button" style="width:70px"
						onclick="timkiemkh(ten.value,dt.value,ma.value,'',nhom.value,cm.value,1)" name="search2"
						id="search2" value="Tìm Lưu" />

					<div id="hienthikh" style="padding-top:5px;color:#333">

					</div>

			</div>
		</div>
	</div>

	<div id="xacnhanthongtin" style="display:none; overflow:hidden; position:absolute;   top: 90px;left:0;width:100%; "
		align="center">
		<div style=" width:950px; min-height:380px;border:1px #999 solid; background-color:#FFF; opacity: 0.98;font-size:15px; font-weight:bold; padding:5px; color:#F00;">

			<div align="right"><b style="color:#00F;cursor:pointer" onclick="goidong()">( X Đóng lại )</b></div>

			<div id="timphieuxuat">
				<fieldset >
					<legend align="center">
						<label style="Color:#5BB6E6;Font-Weight:Bold;Font-size:14pt;cursor:pointer">Xác nhận thông tin sinh viên </label>
					</legend>
					<span style="padding-bottom: 10px;">Ghi chú: Chọn hình ảnh CCCD/CMND của học sinh/sinh viên</span>
					<div style="">
						<div style="padding-top: 10px;">
							Mặt trước
							<input type="file" name="anhmattruoc" id="anhmattruoc" onchange="previewimage(this,'anhmattruoc')">

							<div id="hinhanhtruoc">

							</div>
						</div>
					</div>
					
					<div style="padding-top: 10px;">
						<input type="button" onclick="luuanhxacminh(sochungtu.value)" value="Lưu">
					</div>
				</fieldset>
			</div>
		</div>
	</div>

	<div id="hiethithongbao" style="display:none; overflow:hidden; position:absolute;   top: 90px;left:0;width:100%; "
		align="center">
		<div
			style=" width:950px; min-height:110px;border:1px #999 solid; background-color:#FFF; opacity: 1;font-size:15px; font-weight:bold; padding:5px; color:#F00;">
			<div>
				<fieldset>
					<legend align="center"> <b style="color:#FF0000;cursor:pointer;font-size:18px"
							onclick="goidongthe()">&nbsp; Thông tin mua hàng &nbsp; ( X )</b> </legend><br />

					<div style="padding:2px" id="hienthihoso"> </div>
				</fieldset>
			</div>
		</div>
	</div>



	<div id="hiethithanhtoan"
		style="display:none; overflow:hidden; position:absolute;   top: 30px;left:550px;width:100%; " align="center">
		<div
			style=" width:290px; min-height:390px;border:1px #999 solid; background-color:#FFF; opacity: 1;font-size:15px; font-weight:bold; padding:5px; color:#F00;">
			<div>
				<fieldset>
					<legend align="center"> <b style="color:#FF0000;cursor:pointer;font-size:18px"
							onclick="document.getElementById('hiethithanhtoan').style.display='none'">&nbsp; Thông tin
							chuyển khoản ngân hàng &nbsp; ( X )</b> </legend><br />

					<div style="padding:2px" id="hienthiqrchuyenkhoan"><img src="" style="max-width:200px"
							id="anhqrc" /></div>
					<div align="center" style="color:#0000FF;line-height:25px" id="sotienchuyen">Số tiền:</div>
					<div align="center" style="color:#0000FF;line-height:25px" id="noidungchuyen">Nội dung:</div>
					<div align="center" style="color:#66CC66;line-height:22px;padding-top:2px">STK: 109872963606<br />
						Chủ tài khoản: Huỳnh Hồng Như<br />
						Ngân hàng Vietinbank</div>
				</fieldset>
			</div>
		</div>
	</div>


<div id="hiethidoithungan" style="display:none; overflow:hidden; position:absolute;   top: 90px;left:0;width:100%; "
		align="center">
		<div
			style=" width:420px; min-height:110px;border:1px #999 solid; background-color:#FFF; opacity: 1;font-size:15px; font-weight:bold; padding:5px; color:#F00;">
			<div>
				<fieldset>
					<legend align="center"> <b style="color:#FF0000;cursor:pointer;font-size:18px"
							onclick="goidongid('hiethidoithungan')"> Thay đổi thông tin nhân viên thu ngân &nbsp; ( X )</b> </legend><br />
							<div style="text-align:left;color:#000000;line-height:40px">
 					        <div style="padding:2px" id="hienthithungan">{thunganthongtin}</div>
							<div>
						  Chọn nhân viên thu ngân: <br /> <select class="js-nvtn"  name="nhanvienthungan" id="nhanvienthungan" style="width:360px">
														<option value="0"></option>
 														{nhanvienonline}
													</select> <br /> 
													 
												<div style="padding-top:10px; " >Mật khẩu: <input id="mk"  name="mk" autocapitalize="none" autocomplete="off" autocorrect="off" required=""  type="password" aria-label="Password" value="" style="width:150px"  />	<input id="xn"  onclick="goidoithungan(nhanvienthungan.value,mk.value)" type="button" value="Xác nhận đổi"  /></div>
						 </div>
						   </div>
						  
				</fieldset>
			</div>
		</div>
	</div>
	
	

	<div id="hiengoick" style="display:none; overflow:hidden; position:absolute;   top: 201px;left:-10px;width:100%; "
		align="center">
		<div
			style=" width:200px; min-height:110px;border:1px #999 solid; background-color:#FFF; opacity: 0.98;font-size:15px; font-weight:bold; padding:5px; color:#F00;">
			<div style="padding-bottom:5px"> Giảm giá mới</div><input type="text" id="ckmoi" name="ckmoi"
				value="{chietkhaugiam}" onkeyup="formatchuan(this)" style="width:100px" /> <br /> <br /><input
				id="luutg" name="luutg" value="Lưu chiết khấu" onclick="luuck(ckmoi.value)" type="button" />


			<input id="boqua" name="boqua" value="Bỏ qua" onclick="anhienform('hiengoick')" type="button" />
		</div>
	</div>
</form>


<div style="display:none" id="khonghienthiketqua"></div>


<script src="js/jquery-1.7.2.min.js"></script>

<script src="js/select2.min.js"></script>

<link rel="stylesheet" media="screen" href="js/select2.min.css">
<script language="JavaScript">




	var ck = "{chietkhaugiam}";


	$(document).ready(function () {
		$('.js-ch').select2();
		$('.js-ol').select2();
		$('.js-nv').select2();
		$('.js-nvtn').select2();
		$('.js-nvht').select2();
		$('.js-nvht').select2();
	});

	function donglai() {
		document.getElementById('hiengoick').style.display = "none";
	}
	function xuly3() {
		var tam = document.getElementById('ketqualuu').innerHTML;
		var n = tam.split("##");
		if (n[1] == "1") ck = formatso(n[2]); else alert('Lưu chiết khấu không thành công !');
		document.getElementById('hiengoick').style.display = "none";

	}

	function kiemtrach(ld) {
		if (ld > 45) {
			document.getElementById('passdon').style.display = '';
		}
		else
			if (ld == 69) { document.getElementById('cuahangdiv').style.display = ''; }
			else {
				document.getElementById('cuahangdiv').style.display = 'none';
				document.getElementById('cuahang').value = 0;
				document.getElementById('passdon').style.display = 'none';
			}

	}

	function setchietkhaugiam() {
		document.getElementById('chietkhau').value = ck;
		document.getElementById('add').click();

	}
	function luuck(d) {
		poststr = "DATA=" + encodeURIComponent(d) + "*@!" + encodeURIComponent("0");
		loadtrang('ketqualuu', "chietkhauluu", poststr, "xuly3");

	}
	function goick() {
		document.getElementById('hiengoick').style.display = "";
		document.getElementById('ckmoi').focus();
	}
	document.getElementById('sochungtu').focus();
	document.getElementById('luubd').innerHTML = document.getElementById('sanphamxuat').innerHTML;
	document.getElementById('luutimsp').innerHTML = document.getElementById('sanpham').innerHTML;
	document.getElementById('timphieuxuat').style.display = 'none';
	document.getElementById('hienthongbao').style.display = 'none';
	document.getElementById('codeprotk').select();
	 
</script>
<script language="javascript" src="templates/xuatkho.js"> </script>
<script language="JavaScript">
	{goithungan}
	 
	 
</script>