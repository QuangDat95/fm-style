<br />
<style>
	.tbchuan input {
		cursor: pointer;
	}
</style>

<!--popup sưa du lieu -->
<style>
	#poup_sua_du_lieu {
		position: fixed;
		/* background-color: #ffffff; */
		width: 100%;
		height: 100vh;
		display: none;
		left: 0;
		top: 0;
		justify-content: center;
		align-items: center;
		z-index: 1;
	}

	#poup_sua_du_lieu .select2-container {
		width: 50% !important;
	}

	#poup_sua_du_lieu .form {

		background-color: #ffffff;
		width: 39%;
		height: 300px;
		display: flex;
		flex-direction: column;
		align-items: center;
		justify-content: center;
		border: 1px solid;
	}

	#poup_sua_du_lieu .form #closepop {
		display: flex;
		justify-content: flex-end;
		width: 90%;

	}

	#poup_sua_du_lieu .form form {
		display: flex;
		width: 90%;
		height: 90%;
	}

	#poup_sua_du_lieu form>div {
		height: 100%;
		width: 100%;
		display: flex;
		justify-content: space-around;
		flex-direction: column;
	}

	#poup_sua_du_lieu .form label {
		width: 30%;
	}

	#poup_sua_du_lieu input {
		cursor: pointer;
	}

	#poup_sua_du_lieu .btn-quyenchon span {
		font-size: 16px;
		width: 20%;
		z-index: 0;

	}

	#poup_sua_du_lieu .btn-quyenchon span:hover {
		color: #FF0000;
	}

	#quyenchon {
		display: flex;
		flex-wrap: wrap;
	}

	#poup_sua_du_lieu .btn-quyenchon {
		background-color: cadetblue;
		color: #ffffff;
		border: none;
		padding: 0.5em;
		min-width: 80px;
		max-height: 40px;
		margin-right: 0.3em;
		display: flex;
		justify-content: space-between;
	}

	#poup_sua_du_lieu .form_quyen {
		display: flex;
	}

	#poup_sua_du_lieu .form_quyen>div {
		width: 50%;
	}

	#poup_sua_du_lieu .form_quyen .form_ {
		width: 100%;
	}

	#poup_sua_du_lieu .form_quyen .form_ label {
		width: 70%;
	}

	#poup_sua_du_lieu .form_quyen .form_>div {
		width: 100%;
		display: flex;
		justify-content: space-between;
		padding: 0.2em 0.5em;
	}
</style>
<div id="poup_sua_du_lieu" style="">
	<div class="form">
		<div id="closepop"><button onclick="closepoup()">x</button></div>
		<form name="" action="" method="post" onsubmit="GetCondition(event)">
			<div>
				<div>Phân quyền theo chức năng cho nhiều người!</div>
				<!--<div>
	<div id="reskhonghienthi"></div>
		<label id="chuoigoc" style="width:100%;color:red"></label>
	</div>-->
				<div>

					<label for="quyenall">Chức năng:</label>
					<select class="js-quyenall" id="quyen_a" disabled="disabled">

						<!-- BEGIN: block_PhanQuyen_comp -->
						<option value="{ID}">{Name}</option>
						<!-- END: block_PhanQuyen_comp -->
					</select>
					<input type="hidden" name="quyenall" id="quyenall" />
					<input type="hidden" name="cond" id="cond" />
				</div>
				<div class="form_quyen">
					<div class="form_">

						<div>
							<label for="xem">Xem:</label>
							<input type="checkbox" name="xem" id="xem" value="1" class="check_phanquyen" title="Xem" />

						</div>
						<div>
							<label for="tao">Tạo mới:</label>
							<input type="checkbox" name="tao" id="tao" value="2" class="check_phanquyen" title="Tạo" />

						</div>

						<div>
							<label for="khoa">Khóa:</label>
							<input type="checkbox" name="khoa" id="khoa" value="3" class="check_phanquyen"
								title="Khóa" />

						</div>
						<div>
							<label for="huy">Hủy:</label>
							<input type="checkbox" name="huy" id="huy" value="4" class="check_phanquyen" title="Hủy" />

						</div>
						<div>
							<label for="xoa">Xóa:</label>
							<input type="checkbox" name="xoa" id="xoa" value="5" class="check_phanquyen" title="Xóa" />

						</div>
						<div>
							<label for="tatcach">Tất cả cửa hàng:</label>
							<input type="checkbox" name="tatcach" id="tatcach" value="6" class="check_phanquyen"
								title="Tất cả cửa hàng" />

						</div>
					</div>
					<div id="quyenchon" style="display:none">

					</div>
				</div>
				<div>

					<button type="submit" name="nhieuquyen" id="btn_sua_dulieu" onclick="">Lưu</button>
				</div>
		</form>

	</div>
</div>
</div>







<div id="capnhapghichu" class="thongbaott"
	style="display:none  ;overflow:hidden; position:fixed;    top: 30px;left:200px;width:100%; " align="center">
	<div
		style=" width:550px; border-radius: 6px 6px 6px 6px;  height:299px;border:1px #999 solid; background-color:#FFF; opacity: 1;font-size:15px; font-weight:bold; padding:3px; color:#F00;">
		<h2 style="color:#F00">Nhân viên nghỉ </h2>
		<h3 style="color:#00F" id="tennv"></h3>
		<p align="left"><input name="IDDEL" id="IDDEL" type="hidden" value="" />
			Lý do nghỉ <br />
			<input name="lydo" id="lydo" type="text" value="" style="width:540px;height:30px;font-size:18px" />
		</p>
		<p align="left">
			Đánh giá
			<textarea id="danhgia" name="danhgia" class="texta" style='width:540px;height:70px'>{danhgia}</textarea>
		</p>
		<p>
			<input name="luughichu" id="luughichu" type="button"
				onclick="capnhapghichumoi(IDDEL.value,lydo.value,danhgia.value)" class="thanhtoan"
				value="Lưu thông tin" />
			&nbsp; &nbsp; &nbsp; &nbsp;
			<input name="boqua" id="boqua" type="button" onclick="anhienform('capnhapghichu');" class="thanhtoan"
				value="Bỏ Qua" />
		</p>
	</div>

</div>

<div id="khonghienthi" style="display:none"></div>
<script src="js/jquery-1.7.2.min.js"></script>
<script src="js/select2.min.js"></script>
<link rel="stylesheet" media="screen" href="js/select2.min.css">

