<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" media="screen" href="js/select2.min.css">
<script src="js/jquery-1.7.2.min.js"></script>
<script src="js/select2.min.js"></script>

<div class="top_space"></div>
<div class="nenbao">
	<div style="padding:1px">
		<!-- BEGIN: block_table_request -->
		<fieldset class="nencon">
			<legend>
				<a style="cursor:pointer">
					<label style="Color:#FF3300;Font-Weight:Bold;Font-size:15pt;">Danh Sách Phiếu Yêu Cầu</label>
				</a>
			</legend>
			<div style="margin: 10px 0px;"><a href="?act=taoyeucau&ID=0" style="text-decoration: underline;">[Thêm mới
					yêu cầu]</a></div>
			<div>
				<style>
					table {
						font-size: 13px;
					}
				</style>
				<form name="frmProduct2" id="frmProduct2" method="post">
					<fieldset class="nencon" id="khachhang">
						<table class="table table-bordered" width="100%" border="0">
							<thead>
								<tr>
									<th class="text-center">Ngày tạo</th>
									<th class="text-center">Yêu cầu</th>
									<th class="text-center">BP tiếp nhận</th>
									<th class="text-center">Ngày bắt đầu</th>
									<th class="text-center">Ngày kết thúc</th>
									<th class="text-center">Trưởng dự án</th>
									<th class="text-center">Tình trạng</th>
									<th class="text-center">Duyệt/Không duyệt</th>
								</tr>
							</thead>
							<tbody>
								<!-- BEGIN: request_row -->
								<tr>
									<td class="text-center">{ngaytao}</td>
									<td style="width: 200px;overflow: auto;text-overflow: ellipsis;">{yeucau}</td>
									<td>{bptiepnhan}</td>
									<td class="text-center">{ngaybatdau}</td>
									<td class="text-center">{ngayketthuc}</td>
									<td>{truongnhom}</td>
									<td style="width: 200px; overflow: auto; text-overflow: ellipsis;" id="tinhtrang{IDyeucau}">
										<!-- BEGIN: request_status -->
										{tinhtrang}
										<!-- END: request_status -->
									</td>
									<td class="text-center">
										<select name="duyet" {duyet} id="phieuduyet{IDyeucau}"
											onchange="duyetfunc(this.value, {IDyeucau})">
											<option value=""></option>
											<option {duyet1} value="1">Duyệt</option>
											<option {duyet0} value="0">Không duyệt</option>
										</select>
									</td>
									<td class="text-center">
										<a href="?act=taoyeucau&ID={IDyeucau}">Chi tiết</a>
									</td>
								</tr>
								<!-- END: request_row -->
							</tbody>
						</table>
					</fieldset>
				</form>
			</div>
		</fieldset>
		<!-- END: block_table_request -->
		<script type="text/javascript">
			function duyetfunc(value, id) {
				if (value == 0) {
					var lydo = prompt("Nhập lý do không duyệt");
				}
				kiemtraphieu(value, lydo, id);
			}

			function kiemtraphieu(t1, t2, t3) {
				// if (t1 == '') return;
				poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(t2) + "*@!" + encodeURIComponent(t3);
				loadtrang('invisible', "ajaxduyetphieuyeucau", poststr, "xuly1");
			}

			function xuly1() {
				var tam = document.getElementById('invisible').innerHTML;
				var n = tam.split("###");
				var nguoiduyet = n[1];
				var IDbaiviet = n[2];
				if (n != "") {
					alert("Thành công!");
					$("#phieuduyet" + IDbaiviet).attr("disabled", "disabled");
				}

				var tinhtrang = $("#tinhtrang" + IDbaiviet).html();
				tinhtrang += "<div><b>" + nguoiduyet + "</b></div>";

				$("#tinhtrang" + IDbaiviet).html(tinhtrang);
			}
		</script>
		<div id="invisible" style="display: none;"></div>
		<!-- BEGIN: block_form_request -->
		<fieldset class="nencon">
			<legend>
				<a style="cursor:pointer">
					<label style="Color:#FF3300;Font-Weight:Bold;Font-size:15pt;">Tạo Phiếu Yêu Cầu</label>
				</a>
			</legend>
			<div>
				<!-- BEGIN block_cus -->
				<style>
					.row {
						display: flex;
						flex-wrap: wrap;
						margin-right: 0;
						margin-left: 0;
					}

					.col-4 {
						flex: 0 0 33.333333%;
						max-width: 33.333333%;
						padding: 5px;
					}

					.col-12 {
						max-width: 100%;
						padding: 5px;
					}
				</style>
				<form name="formsubmitrequest" method="post" enctype="multipart/form-data">
					<fieldset class="nencon" id="khachhang2">
						<div class="row">
							<div class="col-4">
								<div class="form-group">
									<label for="">Yêu cầu</label>
									<input type="text" name="yeucau" {disableinput} value="{yeucau}" id="" class="form-control" placeholder="">
								</div>
								<div class="form-group">
									<label for="">Chi tiết yêu cầu</label>
									<textarea class="form-control" {disableinput} name="chitietyeucau" id="" rows="3">{chitietyeucau}</textarea>
								</div>
								<div class="form-group">
									<label for="">Ghi chú</label>
									<textarea class="form-control" name="ghichu" id="" rows="3">{ghichu}</textarea>
								</div>
								<div class="form-group">
									<label for="">File đính kèm</label>
									<input type="file" {disableinput} name="filedinhkem[]" id="" multiple>
									<div>
										<!-- BEGIN: edit_request -->
										{filedinhkem}
										<!-- END: edit_request -->
									</div>
								</div>
							</div>
							<div class="col-4">
								<div class="form-group">
									<label for="">Người duyệt</label>
									<select {disableinput} name="nguoiduyet[]" id="selectjs-nguoiduyet" class="form-control"
										multiple="multiple">
										{nguoiduyets}
									</select>
								</div>
								<div class="form-group">
									<label for="">Ngày bắt đầu</label>
									<input type="date" {disableinput} name="ngaybatdau" value="{ngaybatdau}" id="" class="form-control">
								</div>
								<div class="form-group">
									<label for="">Ngày kết thúc dự kiến</label>
									<input type="date" {disableinput} name="ngayketthuc" value="{ngayketthuc}" id="" class="form-control">
								</div>
								<div class="form-group">
									<label for="">Số giai đoạn dự án</label>
									<input type="number" {disableinput} name="sogiaidoan" value="{sogiaidoan}" id="sogiaidoan" onchange="createinput()"
										min="1" max="10" class="form-control">
								</div>
								<div id="cacgiaidoan"></div>
							</div>
							<div class="col-4">
								<div class="form-group">
									<label for="">Bộ phận tham gia</label>
									<select name="bpthamgia[]" {disableinput} id="selectjs-nguoithamgia" class="form-control"
										multiple="multiple">
										{bpthamgia}
									</select>
								</div>
								<div class="form-group">
									<label for="">Trưởng nhóm dự án</label>
									<select {disableinput} name="truongnhom" id="" class="form-control">
										{truongnhom}
									</select>
								</div>
								<div class="form-group">
									<label for="">Phó nhóm dự án</label>
									<select {disableinput} name="phonhom" id="" class="form-control">
										{phonhom}
										<!-- <optgroup label="BP IT phần mềm">
											<option value="">Đoàn Tấn Đạt - IT </option>
											<option value="">Nguyễn Tiến Thuận - IT </option>
										</optgroup>
										<optgroup label="Nhân Sự">
											<option value="">Jang Nguyễn - Nhân Sự</option>
										</optgroup> -->
									</select>
								</div>
								<div class="form-group">
									<label for="">Số người tham gia</label>
									<input type="number" {disableinput} name="songuoi" value="{songuoi}" id="" class="form-control">
								</div>
								<div class="form-group">
									<label for="">Tiến độ công việc</label>
									<input type="range" name="tiendo" value="{tiendo}" min="0" max="100" id="">
								</div>
								<div class="form-group">
									<label for="">Ngày gia hạn</label>
									<input type="date" name="ngaygiahan" value="{ngaygiahan}" id="" class="form-control">
								</div>
							</div>
							<div class="col-12">
								<button type="submit" name="taophieu" value="Tạo phiếu">Tạo phiếu</button>
								<button><a href="?act=taoyeucau" style="color: black;">Quay lại</a></button>
							</div>
						</div>
					</fieldset>
				</form>

				<!-- <script type="text/javascript" src="/templates/ajaxfileupload.js"></script> -->
				<script type="text/javascript">
					$(document).ready(function () {

						$('#selectjs-nguoiduyet').select2({
							placeholder: "Chọn người duyệt",
							allowClear: true
						});
						$('#selectjs-nguoithamgia').select2({
							placeholder: "Chọn bộ phận tham gia",
							allowClear: true
						});

						var mangduyet = "{nguoiduyet}";
						const nguoiduyet = mangduyet.split(",");
						$('#selectjs-nguoiduyet').val(nguoiduyet);
						$('#selectjs-nguoiduyet').trigger('change');

						
						var mangthamgia = "{nguoithamgia}";
						const nguoithamgia = mangthamgia.split(",");
						$('#selectjs-nguoithamgia').val(nguoithamgia);
						$('#selectjs-nguoithamgia').trigger('change');

						createinput();
					});

					var cacgiaidoan = '{cacgiaidoan}';

					function createinput() {
						var giaidoan = $("#sogiaidoan").val();
						var element = "";
						if(cacgiaidoan != "") {
							var giaidoans = JSON.parse(cacgiaidoan);
							for (let index = 0; index < giaidoan; index++) {
								element += '<div class="form-group"><label for="">Giai đoạn ' + (index + 1) + '</label><textarea disabled="disabled" class="form-control" name="giaidoan[]" id="" rows="2">'+giaidoans[index]+'</textarea></div>'
							}
						} else {
							for (let index = 0; index < giaidoan; index++) {
								element += '<div class="form-group"><label for="">Giai đoạn ' + (index + 1) + '</label><textarea class="form-control" name="giaidoan[]" id="" rows="2"></textarea></div>'
							}
						}
						
						$("#cacgiaidoan").html(element);
					}
				</script>


			</div>
		</fieldset>
		<!-- END: block_form_request -->
	</div>