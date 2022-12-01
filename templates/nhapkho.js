timmuahang
var mangsp = new Array();
var mangsp1 = new Array();
var mangtam = new Array();

var x;



function xemanh(t1, t2) {

	document.getElementById('hienthianh').style.display = "";

	poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(t2) + "*@!" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0);
	loadtrang('htanh', "muahangxemanh", poststr, "");
}

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
function nhapinma() {
	if (document.getElementById('timphieuinma').style.display == "") {
		document.getElementById('timphieuinma').style.display = "none";
		document.getElementById('codechinh').style.display = '';
	}
	else {
		document.getElementById('timphieuinma').style.display = "";
		document.getElementById('codechinh').style.display = 'none';
	}

}


function xuly2() {
	alert('Đã lấy dữ liệu xong !!!');
	goidongid('hiennhapexcel');
}
function laydulieue() {

	var table = document.getElementById("tbex");
	var totalRows = document.getElementById("tbex").rows.length;
	var totalCol = 5; // enter the number of columns in the table minus 1 (first column is 0 not 1)

	for (var x = 1; x <= totalRows; x++) {
		// for (var y = 1; y <= totalCol; y++)
		//	{
		//	   alert(table.rows[x].cells[y].innerHTML);
		//	}
		// addpro(idsp,ten,code,dongia,loaitien,soluong,thue,ghichu)

		addpro(table.rows[x].cells[1].innerHTML, table.rows[x].cells[3].innerHTML,
			table.rows[x].cells[2].innerHTML, table.rows[x].cells[5].innerHTML,
			table.rows[x].cells[6].innerHTML, table.rows[x].cells[4].innerHTML, 0, table.rows[x].cells[7].innerHTML);

	}
	//To display a single cell value enter in the row number and column number under rows and cells below:
	goidongid('hiennhapexcel');
}

function ajaxFileUpload() {
	var tt = id_user;


	var nn = new Date().getTime();;
	$("#loading")
		.ajaxStart(function () {
			$(this).show();
		})
		.ajaxComplete(function () {
			$(this).hide();
		});
	$.ajaxFileUpload
		(

			{
				url: 'fileuploadgg.php?us=' + tt + '_' + nn,
				secureuri: false,
				fileElementId: 'fileToUpload',
				dataType: 'json',
				success: function (data, status) {
					if (typeof (data.error) != 'undefined') {
						if (data.error != '') {
							alert(data.error);
							return false;
						} else {
							kq = data.msg;

							mkq = kq.split('*');

							hienthidulieu();

						}
					}
				},
				error: function (data, status, e) {
					if (data.e == 'vuotdungluong') {
						alert("Vượt dung lượng cho phép 8M !!!");
					}
				}
			}
		)

	return false;

}

function hienthidulieu() {
	var t1;
	//  t1=document.getElementById('idchuyen').value;
	poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(0);
	loadtrang('hienthiexcel', "nhapkhoexcelht", poststr, "");

}

function xuly1() {
	var tam = document.getElementById('ketqualuu').innerHTML;
	var n = tam.split("##");

	if (n[1] == "1") document.getElementById('tigia').value = formatso(n[2]); else alert('Lưu tỉ giá không thành công !');

	document.getElementById('hienthitigia').style.display = "none";

}
function luutigia(d) {

	poststr = "DATA=" + encodeURIComponent(d) + "*@!" + encodeURIComponent("0");
	loadtrang('ketqualuu', "tigialuu", poststr, "xuly1");

}
function donglai(d) {
	document.getElementById(d).style.display = "none";
}
function goitigia() {

	document.getElementById('hienthitigia').style.display = "";
	document.getElementById('tigiamoi').focus();
}
function tinhgia(gia) {
	gia = gia.replace(',', '');
	gia = gia.replace(',', '');
	tigia = document.getElementById('tigia').value;
	tigia = tigia.replace(',', '');
	tigia = tigia.replace(',', '');
	if (tigia == '') tigia = 1;
	document.getElementById('dongia').value = formatso(gia * tigia);
}

function goiphuchoi(p, n) {
	sp = document.getElementById('idgoi').value;
	if (n.length < 30) { alert('Bạn chưa ghi chú cụ thể vui lòng ghi rỏ lý do phục hồi vào phần ghi chú ! '); return; }
	if (sp != p) return;
	var tt = 0;
	var cf = " Bạn có chắc chắn muốn phục hồi phiếu này hay không ? ";
	if (thongbao(cf) == true) {

		poststr = "DATA=" + encodeURIComponent(sp) + "*@!" + encodeURIComponent("nx") + "*@!" + encodeURIComponent(tt) + "*@!" + encodeURIComponent(n);
		loadtrang('ketqualuu', "nhapkhophuchoi", poststr, "xuly5");

	}

}
function setsanpham(id, ten, ma, gia, dvt, giaban, baohanh, sl) {

	document.getElementById('idsp').value = id;
	document.getElementById('tensp').value = ten;
	document.getElementById('masp').value = ma;
	document.getElementById('dongia').value = gia;
	document.getElementById('giaban').value = giaban;

	document.getElementById('sl').value = sl;
	document.getElementById('soluong').value = 1;
	document.getElementById('sanpham').innerHTML = "";
	document.getElementById('soluong').select();
	document.getElementById('soluong').focus();
}

function timtheomacode(v) {
	if (v.length < 3) return;
	poststr = "DATA=" + encodeURIComponent(v) + "*@!" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0);
	loadtrang('khonghienthi', "nhapkhotimtheoma", poststr, "xuly9");
}


function xuly9() {

	var tam = document.getElementById('khonghienthi').innerHTML;
	var n = tam.split("##");
	if (n[1] == "") return;

	setsanpham(n[1], n[2], n[3], n[10], n[5], n[9], n[7], n[8]);
	document.getElementById('code').value = "";
	document.getElementById('codeprotk').value = "";

}

var timer;

function goisp(v) {
	clearTimeout(timer);
	timer = setTimeout(function validate() { timtheomacode(v) }, 500);
}
function goispg(v) {
	clearTimeout(timer);
	timer = setTimeout(function validate() { timtheomacodegoc(v) }, 500);
}
function timdiachicc(id) {
	poststr = "DATA=" + encodeURIComponent(id) + "*@!" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0);
	loadtrang('diachicc', "timdiachicc", poststr, "");
}

function xuly6() {

	document.getElementById('luu').disabled = true;
	document.getElementById('khoa').disabled = true;
	document.getElementById('huyphieu').disabled = true;
	document.getElementById('timk').click();
}


function timbaogiachuyen(t1) {
	baogiachuyen(t1);
	timphieu();
}

function xuly8() {

	var mskh = document.getElementById('dkh').innerHTML.split('@#@');

	document.getElementById('khachhang').value = mskh[1];

	document.getElementById('diachi').value = mskh[3];

	var msp = document.getElementById('dbg').innerHTML.split('@$&');
	var mang = new Array();
	var mgt = new Array();
	mangsp = mang;
	for (x in msp) {//	alert(msp[x]);
		mgt = msp[x].split('@$@');
		mangsp[mgt[1]] = new Array(mgt[1], mgt[3], Math.abs(mgt[2]), mgt[4], mgt[7], mgt[6], mgt[9]);
	}

	xuatsp();
	document.getElementById('luu').disabled = false;
	document.getElementById('khoa').disabled = true;
	document.getElementById('huyphieu').disabled = true;
}

function baogiachuyen(t1) {
	poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent("bg") + "*@!" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0);
	loadtrang('ketqualuu', "xuattubaogia", poststr, "xuly8");
}

function khoaphieu() {
	var tt = 0;
	var cf = " Bạn có chắc chắn muốn khóa phiếu này hay không ? ";
	if (thongbao(cf) == true) {
		document.getElementById('luu').disabled = true;
		if (document.getElementById('tenform').innerHTML == "xuatkho") { tt = 1; }
		sp = document.getElementById('idgoi').value;
		poststr = "DATA=" + encodeURIComponent(sp) + "*@!" + encodeURIComponent("nx") + "*@!" + encodeURIComponent(tt) + "*@!" + encodeURIComponent(0);
		loadtrang('ketqualuu', "nhapkhokhoaphieu", poststr, "xuly6");

	}
}


function timkiemncc(t1, t2, t3, t4, t5) {
	poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(t2) + "*@!" + encodeURIComponent(t3) + "*@!" + encodeURIComponent(t4);
	poststr = poststr + "*@!" + encodeURIComponent(t5) + "*@!" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0);
	loadtrang('hienthinhacc', "nhaptimkh", poststr, "");

}
function xuly3() {
	var mang = ketqua.split('@$@');
	document.getElementById('diachi').value = mang[0];
}
function kiemtraid(tenselec, id) {
	var t = 0;
	var a;
	for (x in tenselec.options) {
		a = tenselec.options[x].value;
		//  alert(x);
		if (laso(a) == laso(id)) return id;

	}
	return "";
}


function xuly7() {
	document.getElementById('themmoi').click();
}
function goihuyphieu(t1, t2) {
	var cf = " Bạn có chắc chắn muốn hủy phiếu này hay không ? ";
	var n = confirm(cf);
	if (n == true) {
		poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(t2) + "*@!" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0);
		loadtrang('ketqualuu', "huyphieu", poststr, "xuly7");
	}

}
function setchungtumua(t1) {
	document.getElementById('hoadongoc').value = t1;
	timkiemmuahang();
}
function setphieudathang(t1) {
	document.getElementById('phieudathang').value = t1;

}

function timkiemmh(t1, t2, t3, t4, t5, t6, t7, t8, t9, t10) {
	poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(t2) + "*@!" + encodeURIComponent(t3) + "*@!" + encodeURIComponent(t4);
	poststr = poststr + "*@!" + encodeURIComponent(t5) + "*@!" + encodeURIComponent(t6) + "*@!" + encodeURIComponent(t7) + "*@!" + encodeURIComponent(t8) + "*@!" + encodeURIComponent(t9) + "*@!" + encodeURIComponent(t10);
	loadtrang('hienthimh', "muahangtim", poststr, "");
	//alert('Luu xong !!!');
}

function timkiemdh(t1, t2, t3, t4, t5, t6, t7, t8, t9, t10) {
	poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(t2) + "*@!" + encodeURIComponent(t3) + "*@!" + encodeURIComponent(t4);
	poststr = poststr + "*@!" + encodeURIComponent(t5) + "*@!" + encodeURIComponent(t6) + "*@!" + encodeURIComponent(t7) + "*@!" + encodeURIComponent(t8) + "*@!" + encodeURIComponent(t9) + "*@!" + encodeURIComponent(t10);
	loadtrang('hienthidh', "nhapkhodathangtim", poststr, "");
	//alert('Luu xong !!!');
}

function timkiemkh(t1, t2, t3, t4, t5, t6) {
	poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(t2) + "*@!" + encodeURIComponent(t3) + "*@!" + encodeURIComponent(t4);
	poststr = poststr + "*@!" + encodeURIComponent(t5) + "*@!" + encodeURIComponent(t6) + "*@!" + encodeURIComponent(0);
	loadtrang('hienthinhacc', "xuattimkh", poststr, "");
}
function timsanpham(t1, t2, t3, t4, t5, t6) {

	poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(t2) + "*@!" + encodeURIComponent(t3) + "*@!" + encodeURIComponent(t4);
	poststr = poststr + "*@!" + encodeURIComponent(t5) + "*@!" + encodeURIComponent(t6) + "*@!" + encodeURIComponent(0);
	loadtrang('sanpham', "nhapkhotimsp", poststr, "");

}


//=======================================================
function xuatsetkhachhang(id) {
	poststr = "DATA=" + encodeURIComponent(id) + "*@!" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0);
	loadtrang('tenkhachhang', "xuattimkhachhang", poststr, "");
}
function setkhachhang(id) {
	poststr = "DATA=" + encodeURIComponent(id) + "*@!" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0);
	loadtrang('tenkhachhang', "timkhachhang", poststr, "");
}


function setnhacungcap(loai, id, diachi) {

	document.getElementById('khachhang').value = id;

	document.getElementById('timkhachhang').style.display = "none";
	document.getElementById('codechinh').style.display = "";
	document.getElementById('note').focus();

}
var idxe = '';

function xuly5() {
	document.getElementById('khachhang').value = idxe;
	//document.getElementById('IDXe').value= idxe;
}


function sethtkhachhang(loai, id, diachi, soxe) {
	idxe = id;
	document.getElementById('khachhang').value = id;
	// document.getElementById('IDXe').value= id;
	document.getElementById('diachi').value = diachi;


	poststr = "DATA=" + encodeURIComponent(loai) + "*@!" + encodeURIComponent(id) + "*@!" + encodeURIComponent(0) + "*@!" + encodeURIComponent(soxe);
	loadtrang('tenkhachhang', "xuattimkhachhang", poststr, "xuly5");




	document.getElementById('timkhachhang').style.display = "none";
	document.getElementById('codechinh').style.display = "";
	document.getElementById('note').focus();

}

//=======================================================

function clearchon() {

	document.getElementById('NameTK').value = '';
	document.getElementById('codeprotk').value = '';
	document.getElementById('code').value = '';
	document.getElementById('IDGrouptk').value = '0';
	document.getElementById('sanpham').innerHTML = document.getElementById('luutimsp').innerHTML;
}
//=======================================================
function kiemtraphieu() {
	if (trim(document.getElementById('hoadongoc').value) == '') {
		alert('Xin vui lòng nhập số hóa đơn gốc nhà cung cấp !');
		document.getElementById('hoadongoc').focus();
		return false;
	}
	if (trim(document.getElementById('sochungtu').value) == '') {
		alert('Xin vui lòng nhập vào số chứng từ!');
		document.getElementById('sochungtu').focus();
		return false;
	}
	if (document.getElementById('lydo').value == 0) {
		alert('Xin vui lòng chọn ly lo!');
		document.getElementById('lydo').focus();
		return false;
	}
	if (document.getElementById('khachhang').value == 0) {
		alert('Xin vui lòng chọn nhà cung cấp!');
		document.getElementById('khachhang').focus();
		return false;
	}
	if (mangsp.length == 0) {
		alert('Xin vui lòng nhập hàng hóa nhập kho !');
		document.getElementById('NameTK').focus();
		return false;
	}
	return true;
}

function setlailuu(v) {

	document.getElementById('luu').disabled = "";
	document.getElementById('khoa').disabled = "";

}
function xulychung() {
	document.getElementById('luu').disabled = true;
	tam = document.getElementById('ketqualuu').innerHTML
	var n = tam.split("**#");
	if (n[1] == "") { return; }
	document.getElementById('idgoi').value = n[1];
	//  document.getElementById('ketqualuu').innerHTML=""; 
	var timet

	document.getElementById('luu').value = "Cập Nhập";
	clearTimeout(timet);
	timet = setTimeout(function daluuxong() { setlailuu('1') }, 2000);
}


function luuphieunhap() {
	document.getElementById('khoa').disabled = true;
	var idluu, ngaynhapkho, sochungtu, nhapkho, tigia, lydo, nguoigiao, khachhang, ghichu, tenkhachhang, tenlydo, idgoi, hoadongoc;
	ngaynhapkho = document.getElementById('ngaynhap').value;
	sochungtu = document.getElementById('sochungtu').value;
	nhapkho = document.getElementById('kho').value;
	tigia = document.getElementById('TiGia').value;
	lydo = document.getElementById('lydo').value;
	nguoigiao = document.getElementById('nguoigiao').value;
	khachhang = document.getElementById('khachhang').value;
	ghichu = document.getElementById('note').value;
	vat = document.getElementById('VAT').value;
	ghichu = document.getElementById('note').value;
	diachi = document.getElementById('diachi').value;
	tenkhachhang = document.getElementById('khachhang').options[document.getElementById('khachhang').selectedIndex].text;
	idgoi = document.getElementById('idgoi').value;
	datratien = document.getElementById('datratien').value;
	hoadongoc = document.getElementById('hoadongoc').value;

	//  alert(mangthanhchuoi(mangsp))
	if (kiemtraphieu() == true) {
		poststr = "DATA=" + encodeURIComponent(mangthanhchuoi(mangsp)) + "*@!" + encodeURIComponent(ngaynhapkho) + "*@!" + encodeURIComponent(sochungtu);
		poststr += "*@!" + encodeURIComponent(nhapkho) + "*@!" + encodeURIComponent(tigia) + "*@!" + encodeURIComponent(lydo);
		poststr += "*@!" + encodeURIComponent(nguoigiao) + "*@!" + encodeURIComponent(khachhang) + "*@!" + encodeURIComponent(ghichu);
		poststr += "*@!" + encodeURIComponent(vat) + "*@!" + encodeURIComponent(0) + "*@!" + encodeURIComponent(tenkhachhang);
		poststr += "*@!" + encodeURIComponent(diachi) + "*@!" + encodeURIComponent(datratien) + "*@!" + encodeURIComponent(idgoi);
		poststr += "*@!" + encodeURIComponent(hoadongoc) + "*@!" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0);
		loadtrang('ketqualuu', "luudata", poststr, "xuly");
	}
	return false;
}
//=======================================================

function luuphieuxuat() {
	var idluu, ngaynhapkho, sochungtu, nhapkho, tigia, lydo, nguoigiao, khachhang, ghichu, tenkhachhang, idgoi;
	ngaynhapkho = document.getElementById('ngaynhap').value; //1
	sochungtu = document.getElementById('sochungtu').value; //2
	nhapkho = document.getElementById('kho').value; //3
	tigia = document.getElementById('TiGia').value; //4
	lydo = document.getElementById('lydo').value; //5
	nguoigiao = document.getElementById('nguoigiao').value; //6
	khachhang = document.getElementById('khachhang').value; //7
	ghichu = document.getElementById('note').value;  //8
	vat = document.getElementById('VAT').value;  //9
	ghichu = document.getElementById('note').value;  //10
	diachi = document.getElementById('diachi').value;  //11
	tenkhachhang = document.getElementById('khachhang').options[document.getElementById('khachhang').selectedIndex].text;  //12
	// soxe = document.getElementById('IDXe').options[document.getElementById('IDXe').selectedIndex].text;

	idgoi = document.getElementById('idgoi').value;
	if (kiemtraphieu() == true) {
		poststr = "DATA=" + encodeURIComponent(mangthanhchuoi(mangsp)) + "*@!" + encodeURIComponent(ngaynhapkho) + "*@!" + encodeURIComponent(sochungtu);
		poststr += "*@!" + encodeURIComponent(nhapkho) + "*@!" + encodeURIComponent(tigia) + "*@!" + encodeURIComponent(lydo);
		poststr += "*@!" + encodeURIComponent(nguoigiao) + "*@!" + encodeURIComponent(khachhang) + "*@!" + encodeURIComponent(ghichu);
		poststr += "*@!" + encodeURIComponent(vat) + "*@!" + encodeURIComponent(1) + "*@!" + encodeURIComponent(tenkhachhang) + "*@!" + encodeURIComponent(diachi);
		poststr += "*@!" + encodeURIComponent(soxe) + "*@!" + encodeURIComponent(idgoi) + "*@!" + encodeURIComponent(15) + "*@!" + encodeURIComponent(16);
		loadtrang('ketqualuu', "luudata", poststr, "xuly");
	}
	return false;
}
//=======================================================
function timkiemmuahang() {
	if (document.getElementById('timmuahang').style.display == "") {
		document.getElementById('timmuahang').style.display = "none";
		document.getElementById('codechinh').style.display = "";
	} else {
		document.getElementById('timmuahang').style.display = "";
		document.getElementById('codechinh').style.display = "none";
	}

}

function timkiemdathang() {
	if (document.getElementById('timdathang').style.display == "") {
		document.getElementById('timdathang').style.display = "none";
		document.getElementById('codechinh').style.display = "";
	} else {
		document.getElementById('timdathang').style.display = "";
		document.getElementById('codechinh').style.display = "none";
	}

}

function timkiemnhacc() {
	if (document.getElementById('timkhachhang').style.display == "") {
		document.getElementById('timkhachhang').style.display = "none";
		document.getElementById('codechinh').style.display = "";
	} else {
		document.getElementById('timkhachhang').style.display = "";
		document.getElementById('codechinh').style.display = "none";
	}

}
function timkhachhang() {

	if (document.getElementById('timkhachhang').style.display == "") {
		document.getElementById('timkhachhang').style.display = "none";
		document.getElementById('codechinh').style.display = "";
	} else {
		document.getElementById('timkhachhang').style.display = "";
		document.getElementById('codechinh').style.display = "none";
	}


}
//=======================================================

//===============================================

function SetThongTinNhaCC(ID, Name) {
	document.forms['frmnhap'].khachhang.value = ID;
	document.forms['frmnhap'].khachhang.selected = Name;
	document.getElementById('timnhacungcap').style.display = 'none';
}

function timtrongbaogia(t0, t1, t2, t3, t4, t5, t6) {

	poststr = "DATA=" + encodeURIComponent(t0) + "*@!" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(t2) + "*@!" + encodeURIComponent(t3) + "*@!" + encodeURIComponent(t4);
	poststr = poststr + "*@!" + encodeURIComponent(t5) + "*@!" + encodeURIComponent(t6) + "*@!" + encodeURIComponent(0);
	loadtrang('httimnhapb', "xuattimbaogia", poststr, "");


}

function xulyhtinma() {
	var ma = ketqua.split('&$&');

	// alert( m[29])
	//0     1   2       3       4     5    6    7         8      9    10    11   12    13       14     15      16   17   18     19     20      21   22      23   24
	//ID,IDKho,IDNhaCC,IDNhap,NgayNh,SoCT,LyDo,SoNgayNo,IDTKNo,IDTKCo,TiGia,VAT,GhiChu,NgayTao,IDTao,NguoiGiao,Loai,ten,diachi,tenkho,tenlydo,tenN,diachiN,dakhoa,soxe

	//document.getElementById('ngaynhap').value = m[30];  

	//  document.getElementById('hoadongoc').value = m[19];


	// document.getElementById('idgoi').value = m[0] ;
	//  document.getElementById('note').value = m[12]; 



	var msp = ma[1].split('@$&');
	var mang = new Array();
	var mgt = new Array();
	mangsp = mang;
	for (x in msp) {//	alert(msp[x]);
		mgt = msp[x].split('@$@');
		mangsp[mgt[6]] = new Array(mgt[5], mgt[4] + ' - ' + mgt[7] + ' - ' + mgt[8] + ' - ' + mgt[6], Math.abs(mgt[3]), mgt[2], 0, 0, '');
		//                   Array(code  ,ten   ,soluong,        dongia , thue ,loaitien,ghichu);	

	}
	xuatsp();
	document.getElementById('timphieuinma').style.display = 'none';
	document.getElementById('timphieunhap').style.display = 'none';
	document.getElementById('codechinh').style.display = '';
	//timphieu() ;
	$('.js-khachhang').select2();
}
function laythongtinphieutaoma(t1, t2) {
	document.getElementById('hoadongoc').value = "Taomatudong_ID" + t1;
	document.getElementById('khachhang').value = t2;
	$('.js-khachhang').select2();
	poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(t2) + "*@!" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0);
	loadtrang('khonghienthi', "nhapkholayphieuinma", poststr, "xulyhtinma");
}
function timdsphieuinma(t0, t1, t2, t3, t4, t5, t6, t7) {
	poststr = "DATA=" + encodeURIComponent(t0) + "*@!" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(t2) + "*@!" + encodeURIComponent(t3) + "*@!" + encodeURIComponent(t4);
	poststr = poststr + "*@!" + encodeURIComponent(t5) + "*@!" + encodeURIComponent(t6) + "*@!" + encodeURIComponent(t7);
	loadtrang('httiminma', "nhapkhoinmatim", poststr, "");
}

function timdsphieunhap(t0, t1, t2, t3, t4, t5, t6, t7) {
	alert(t1 + "======" + t2);
	poststr = "DATA=" + encodeURIComponent(t0) + "*@!" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(t2) + "*@!" + encodeURIComponent(t3) + "*@!" + encodeURIComponent(t4);
	poststr = poststr + "*@!" + encodeURIComponent(t5) + "*@!" + encodeURIComponent(t6) + "*@!" + encodeURIComponent(t7);
	loadtrang('httimnhap', "nhapkhotim", poststr, "");


}

function setidxe(tenselec, text) {
	var t = 0;
	for (x in tenselec.options) {
		if (tenselec.options[x].text == text) return tenselec.options[x].value;
	}
	return "";
}

function xuly4() {
	//alert( ketqua)
	var ma = ketqua.split('&$&');
	var m = ma[0].split('@$@');
	// alert( m[29])
	//0     1   2       3       4     5    6    7         8      9    10    11   12    13       14     15      16   17   18     19     20      21   22      23   24
	//ID,IDKho,IDNhaCC,IDNhap,NgayNh,SoCT,LyDo,SoNgayNo,IDTKNo,IDTKCo,TiGia,VAT,GhiChu,NgayTao,IDTao,NguoiGiao,Loai,ten,diachi,tenkho,tenlydo,tenN,diachiN,dakhoa,soxe

	document.getElementById('ngaynhap').value = m[30];
	document.getElementById('sochungtu').value = m[5];
	document.getElementById('kho').value = m[8];
	document.getElementById('TiGia').value = m[10];
	//  if( m[10]!=3) document.getElementById('khoa').disabled= true; 
	document.getElementById('lydo').value = m[6];
	document.getElementById('nguoigiao').value = m[15];
	document.getElementById('khachhang').value = m[2];
	document.getElementById('diachi').value = m[18];
	document.getElementById('hoadongoc').value = m[19];
	document.getElementById('datratien').value = m[29];
	//   var tam = document.getElementById('IDXe') ;
	//  document.getElementById('IDXe').value = setidxe(tam, m[25]) ;


	document.getElementById('idgoi').value = m[0];
	document.getElementById('note').value = m[12];
	// document.getElementById('VAT').value = m[11]; 

	// alert(ketqua) ;
	var msp = ma[1].split('@$&');
	var mang = new Array();
	var mgt = new Array();
	mangsp = mang;
	for (x in msp) {//	alert(msp[x]);
		mgt = msp[x].split('@$@');
		mangsp[mgt[2]] = new Array(mgt[3], mgt[7], Math.abs(mgt[4]), mgt[5], mgt[8], mgt[6], mgt[10]);
		//                   Array(code  ,ten   ,soluong,        dongia , thue ,loaitien,ghichu);	  
	}
	xuatsp();
	timphieu();
	$('.js-khachhang').select2();
}
function copyp() {
	document.getElementById('luu').disabled = false;
	document.getElementById('copy').disabled = true;
	document.getElementById('idgoi').value = '';
	document.getElementById('sochungtu').value = '';
}
function setlaiphieunhap(t1, t2) {
	poststr = "DATA=" + "0*@!" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(t2) + "*@!" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0);
	loadtrang('khonghienthi', "nhapkhogoi", poststr, "xuly4");

	//	  poststr="DATA="+ "0*@!" +  encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0);
	//	  loadtrang('httimlai', "nhapkhoht", poststr,"") ;		

	if (t2 == "0") {
		document.getElementById('luu').disabled = false;
		//	document.getElementById('khoa').disabled= true;	
		document.getElementById('khoa').disabled = false;
		document.getElementById('copy').disabled = false;
		document.getElementById('huyphieu').disabled = false;
	}
	else {
		document.getElementById('luu').disabled = true;
		document.getElementById('khoa').disabled = true;
		document.getElementById('copy').disabled = false;
		document.getElementById('huyphieu').disabled = true;
	}
}

function themnhacc(t1, t2, t3, t4) {
	var st;
	st = "default.php?act=nhacungcap&id=-1&t1=" + t1 + '&t2=' + t2 + '&t3=' + t3 + '&t4=' + t4;
	window.open(st, 'popup', 'toolbar=no,status=no,scrollbars=yes,location=no,menubar=no,directories=no,width=1000,height=700,titlebar=no');

}

function themkhachhang(t1, t2, t3, t4, t5) {
	var st;
	st = "default.php?act=customer&id=-1&t1=" + t1 + '&t2=' + t2 + '&t3=' + t3 + '&t4=' + t4 + '&t5=' + t5;
	window.open(st, 'popup', 'toolbar=no,status=no,scrollbars=yes,location=no,menubar=no,directories=no,width=1000,height=700,titlebar=no');
}

function xemthe(id, xuatnhap, kho, tu, den) {
	var st;
	st = "thekhoxem.php?t1=" + id + "&t2=" + xuatnhap + '&t3=' + kho + '&t4=' + tu + '&t5=' + den;
	window.open(st, 'popup', 'toolbar=no,status=no,scrollbars=yes,location=no,menubar=no,directories=no,width=1000,height=700,titlebar=no');
}


function timphieu() {
	if (document.getElementById('timphieunhap').style.display != "") {
		document.getElementById('timphieunhap').style.display = '';
		document.getElementById('codechinh').style.display = 'none';
		//document.getElementById('timk').click() ; 
	}
	else {
		document.getElementById('timphieunhap').style.display = 'none';
		document.getElementById('codechinh').style.display = '';
	}

}
function thempt(t1, t2, t3, t4) {
	var sobaogia = document.getElementById('sochungtu').value;
	var st;
	st = "default.php?act=product&id=-1&t1=" + t1 + '&t2=' + t2 + '&t3=' + t3 + '&t4=' + t4;
	window.open(st, 'popup', 'toolbar=no,status=no,scrollbars=yes,location=no,menubar=no,directories=no,width=1000,height=600,titlebar=no');
}

function taomoi() {

	document.forms['frmnhap'].reset();
	document.getElementById('sanphamnhap').innerHTML = document.getElementById('luubd').innerHTML;
	document.getElementById('luu').disabled = '';
	document.getElementById('khoa').disabled = true;
}





function setnguoc(id, ten, ma, sl, gia, lt, thue, note) {
	document.getElementById('idsp').value = id;
	document.getElementById('ten').value = ten;
	document.getElementById('ma').value = ma;

	document.getElementById('tensp').value = ten;
	document.getElementById('masp').value = ma;

	document.getElementById('soluong').value = txtFormatj(sl);
	document.getElementById('dongia').value = txtFormatj(gia);
	//	document.getElementById('giamgia').value= '0'; 
	document.getElementById('loaitien').value = lt;
	document.getElementById('thue').value = thue;
	document.getElementById('ghichu').value = note;

	document.getElementById('dongia').focus();
}

//===================================================================================== 
function kiemtrachuyen(idsp) {
	if (idsp == '') {
		alert('Bạn chưa chọn sản phẩm !!!')
		document.getElementById('ten').focus();
		return false;
	}
	if (document.getElementById('dongia').value == '') {
		alert('Bạn chưa nhập đơn giá!!!');
		document.getElementById('dongia').focus();
		return false;
	}
	return true;
}

function copymang(mangvao, mangra) {
	for (x in mangvao) {
		mangra[x] = mangvao[x];
	}
}





function sapnguoc() {
	var x, t, tam = new Array();
	var tam2 = new Array();

	copymang(mangsp, tam);


	var index = tam.indexOf(element);
	while (index != -1) {
		tam1.push(index);
		index = array.indexOf(element, ++index);
		alert(index);
	}

	//for (x in mangsp)
	//	{
	//		t =tam.length-1 ;
	//		alert(t)
	//		tam2 = tam.pop() ;
	//		t =tam.length-1 ;
	//		alert(t)

	//alert(tam2[0]+'---'+tam2[1]+'---'+tam2[2]);
	//	}
	//mangsp = tam ;
}

function kttrung(kt) {

	var loai = 0;

	kiemtratrung(loai, 'tbphieunhaptk', 'SoCT', kt, 'Trùng số chứng từ !!!', 'Có lỗi trên đường truyền !!!', "sochungtu");


}

function capnhapgia(idsp, dongia) {
	poststr = "DATA=" + encodeURIComponent(idsp) + "*@!" + encodeURIComponent(dongia) + "*@!" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0);
	loadtrang('ketqualuu', "capnhapgia", poststr, "");
}

function addpro(idsp, ten, code, dongia, loaitien, soluong, thue, ghichu) {
	if (idsp == '') {
		alert('Bạn Chưa chọn hàng hóa!!!'); document.getElementById('NameTK').focus(); return;
	}
	if (soluong < 0 || dongia < 0) {
		alert('Không được nhập số Âm !!!'); return;
	}
	if (laso(dongia) == 0) {
		var cf = "Bạn chưa nhập đơn giá!!! \n\nBạn có muốn nhập hay không ?";
		var n = confirm(cf);
		if (n == true) {
			document.getElementById('dongia').focus();
			return false;
		}
	}
	if (trim(soluong) == '' || laso(soluong) == 0) {
		alert('Bạn chưa nhập số lượng!!!'); document.getElementById('soluong').focus(); return;
	}
	//alert(document.getElementById('sl').value > soluong);
	var sl = laso(document.getElementById('sl').value);
	//alert(sl < soluong) ;
	if (document.getElementById('tenform').innerHTML == "xuatkho" && parseFloat(sl) < parseFloat(soluong)) {
		alert('Trong kho chỉ còn "' + sl + '" hàng hóa, vui lòng nhập thêm vào kho hoặc xuất ít hơn ' + sl + ' !!!');
		document.getElementById('soluong').focus();
		document.getElementById('soluong').select();
		return;
	}

	mangsp[idsp] = new Array(code, ten, soluong, dongia, thue, loaitien, ghichu);
	xuatsp();
	document.getElementById('nhac').play();
	if (document.getElementById('tenform').innerHTML == "xuatkho") { capnhapgia(idsp, dongia); }
}


function xoapt(id) {

	var mt = new Array();
	if (id != '') {
		for (x in mangsp) {
			if (x != id) {
				mt[x] = mangsp[x];
			}
		}
		mangsp = mt;
		xuatsp();
	}
	document.getElementById('idsp').value = '';
	document.getElementById('masp').value = '';
	document.getElementById('tensp').value = '';
	document.getElementById('soluong').value = '';
	document.getElementById('dongia').value = '';
	// 	document.getElementById('chietkhau').value=''; 
	document.getElementById('loaitien').value = '';

}

function setthongtin(id) {

	document.getElementById('idsp').value = id;
	document.getElementById('masp').value = mangsp[id][0];
	document.getElementById('tensp').value = mangsp[id][1];
	document.getElementById('soluong').value = mangsp[id][2];
	document.getElementById('dongia').value = mangsp[id][3];
	document.getElementById('thue').value = mangsp[id][4];
	document.getElementById('loaitien').value = mangsp[id][5];
	document.getElementById('ghichu').value = mangsp[id][6];

	document.getElementById('giaban').value = mangsp[id][5];

	document.getElementById('dongia').focus();

}
var chietkhau, tong;
function xuatsp() {
	var x, stt, tongsl, str = ""; stt = 0;
	var thanhtien;
	thanhtien = 0; tong = 0; tongsl = 0;
	str = ' <table width="100%" border="0" cellpadding="0" cellspacing="0">';
	str += '    <tr bgcolor="#F8E4CB"> ';
	str += ' <td width="29"  align="center" class="cothienthi" height="23"><b>STT</b></td> ';
	str += ' <td width="115" align="center" class="cothienthi"><strong>Mã Hàng Hóa </strong></td> ';
	str += ' <td width="350" align="center" class="cothienthi"><strong>Tên Hàng Hóa</strong></td> ';
	str += ' <td width="45"  align="center" class="cothienthi"><strong>SL</strong></td> ';
	str += ' <td width="105" align="center" class="cothienthi"><strong>Đơn Giá </strong></td> ';
	str += ' <td width="105" align="center" class="cothienthi"><strong>Giá Bán </strong></td> ';
	str += ' <td width="51"  align="center" class="cothienthi"><strong>Thuế</strong></td> ';
	str += ' <td width="100" align="center" class="cothienthi"><strong>Thành Tiền </strong></td> ';
	str += ' <td width="300" align="center" class="cothienthi"><strong>Ghi Chú </strong></td> ';
	str += ' <td width="30"  align="center" class="cothienthi"><strong>Xóa</strong></td> ';
	str += ' </tr>';
	var mau, h1, h12;
	for (x in mangsp) {

		if (mau == "white") {
			{
				mau = "#EEEEEE";
				hl = "Normal4";
				hl2 = "Highlight4";
			}
			hl = "Normal4";
			hl2 = "Highlight4";
		} else {
			mau = "white";
			hl = "Normal5";
			hl2 = "Highlight5";
		}
		thanhtien = doiso(mangsp[x][3]) * doiso(mangsp[x][2]);
		thanhtien = thanhtien + thanhtien * mangsp[x][4] / 100;
		tong = tong + thanhtien;
		tongsl = 1 * tongsl + 1 * mangsp[x][2];
		stt = stt + 1;
		str += '<TR onMouseOver="this.className=\'' + hl2 + '\'" onMouseOut="this.className=\'' + h1 + '\'" bgcolor="' + mau + '" style="cursor:pointer" onclick="setthongtin(\'' + x + '\')">';
		str += ' <td class="cothienthi"  align="Right" height="23">' + stt + '</td>';
		str += ' <td class="cothienthi"  align=""  >&nbsp;' + mangsp[x][0] + '</td>';
		str += ' <td class="cothienthi"  align=""  >&nbsp;' + mangsp[x][1] + '</td>';
		str += ' <td class="cothienthi"  align="right"  >&nbsp;' + mangsp[x][2] + '</td>';
		str += ' <td class="cothienthi"  align="right"  >&nbsp;' + txtFormatj(mangsp[x][3]) + '</td>';
		str += ' <td class="cothienthi"  align="right"  >&nbsp;' + txtFormatj(mangsp[x][5]) + '</td>';
		str += ' <td class="cothienthi"  align="center"  >&nbsp;' + mangsp[x][4] + '%</td>';
		str += ' <td class="cothienthi"  align="right"  >&nbsp;' + txtFormatj(thanhtien) + '&nbsp;</td>';
		str += ' <td class="cothienthi"  align=""  >&nbsp;' + mangsp[x][6] + '</td>';
		str += ' <td class="cothienthi"  align="center"  ><img onclick="xoapt(\'' + x + '\')" title=\"Xóa Mục\"  src="images/delete.gif" border="0"></td>';
		str += ' </Tr>';

	}
	str += ' <Tr class="cothienthi"><td colspan="3" align="right" ><b>Tổng cộng</b> </td><td align="right"><b>' + txtFormatj(tongsl) + '&nbsp;</b></td><td>&nbsp;</td><td>&nbsp;</td><td  align="right"><b>' + txtFormatj(tong) + '</b>&nbsp;</td><td></td>';
	str += ' </Tr>';
	str += '</table>';
	document.getElementById('sanphamnhap').innerHTML = str;
	document.getElementById('tienhang').value = txtFormatj(tong);
	chietkhau = document.getElementById('tongchietkhau').value;
	datra = document.getElementById('datratien').value;
	datra = datra.replace(',', '');
	datra = datra.replace(',', '');
	datra = datra.replace(',', '');
	document.getElementById('tongtienhang').value = txtFormatj(tong - chietkhau);
	document.getElementById('conno').value = formatso(tong - chietkhau - datra);

	// document.getElementById('conno').value =formatchuan(document.getElementById('conno') ) ;



}
function tinhlai(datra) {
	datra = datra.replace(',', '');
	datra = datra.replace(',', '');
	datra = datra.replace(',', '');
	chietkhau = document.getElementById('tongchietkhau').value;
	document.getElementById('conno').value = formatso(tong - chietkhau - datra)

}
//===================================================================================== 

function setCheckedValue(radioObj, newValue) {
	if (!radioObj)
		return;
	var radioLength = radioObj.length;
	if (radioLength == undefined) {
		radioObj.checked = (radioObj.value == newValue.toString());
		return;
	}
	for (var i = 0; i < radioLength; i++) {
		radioObj[i].checked = false;
		if (radioObj[i].value == newValue.toString()) {
			radioObj[i].checked = true;
		}
	}
}


function ask() {
	var n = confirm("Bạn có muốn xóa không");
	if (n == false) {
		return false;

	}
}
function kiemtra() {
	if (document.forms['hoadongoc'].Name.value == "") {
		alert('Bạn chưa nhập số hóa đơn gốc để đối chiếu');
		document.forms['hoadongoc'].Name.focus();
		return false;
	}

	if (document.forms['nhapsp'].Name.value == "") {
		alert('Bạn chưa nhập tên khách hàng');
		document.forms['nhapsp'].Name.focus();
		return false;
	}

	if (document.forms['nhapsp'].dachon.value == "") {
		alert('Bạn chưa chọn Công Ty hay Cá Nhân');
		document.forms['nhapsp'].type.focus();
		return false;
	}
	return true;
}
//===================================
function goitenan(id) {
	if (id == '-1') {
		document.getElementById('tenan').style.display = '';
	} else {
		document.getElementById('tenan').style.display = 'none';
	}

}
function goiin() {
	var so = document.getElementById('sochungtu').value;
	var st;
	st = "nhapkhoin.php?id=" + so;
	window.open(st, 'popup', 'toolbar=no,status=no,scrollbars=yes,location=no,menubar=no,directories=no,width=1000,height=600,titlebar=no');
}
function goiinxuat() {
	var so = document.getElementById('sochungtu').value;
	var st;
	st = "xuatkhoin.php?id=" + so;
	window.open(st, 'popup', 'toolbar=no,status=no,scrollbars=yes,location=no,menubar=no,directories=no,width=1000,height=600,titlebar=no');
}
function lamlai() {
	document.forms['nhapsp'].btnUpdate.disabled = '';
}

function setsp(ten, ma) {
	alert('ten');
}
function tinhgiamgia1(tongcong, giatri, loaitien) {
}
function tinhgiamgia2(tongcong, giatri, loaitien) {
	var tienchuagiam;

	document.getElementById('thanhtien').innerHTML = parseFloat(tienchuagiam) - parseFloat(document.getElementById('giamphamtram').innerHTML) - parseFloat(tongcong);
}






