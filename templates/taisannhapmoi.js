
var mangsp = new Array();
var mangsp1 = new Array();
var mangtam = new Array();

var x, chay;

function timphieu(t0, t1, t2, t3, t4, t5, t6, t7, t8) {  //tungay,denngay,luachon,nhomtk,taikhoan2,lydo2,tr
	poststr = "DATA=" + encodeURIComponent(t0) + "*@!" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(t2) + "*@!" + encodeURIComponent(t3);
	poststr = poststr + "*@!" + encodeURIComponent(t4) + "*@!" + encodeURIComponent(t5) + "*@!" + encodeURIComponent(t6) + "*@!" + encodeURIComponent(t7) + "*@!" + encodeURIComponent(t8);
	loadtrang('hienthitim', "thuchichtim", poststr, "");
}

function sapxep(t0) {
	poststr = "SX=" + t0;
	loadtrang('hienthitim', "thuchichtim", poststr, "");
}
function kttrung(kt) {
	kiemtratrung(document.getElementById('ID').value, 'tbthuchitk', 'sochungtu', kt, 'Trùng số chứng từ !!!', 'Có lỗi trên đường truyền !!!', "sochungtu");
}

function xuly1() {

	//return ;


	var n = ketqua.split("###");
	if (n[1] != 'undefined')
		document.getElementById('sochungtu').value = n[1];
	document.getElementById('ID').value = n[2];

	document.getElementById('search2').click();
}
function xuly3() {

	var n = ketqua.split("###");
	if (n[1] != 'undefined')
		document.getElementById('sochungtu').value = n[1];
	document.getElementById('ID').value = n[2];
}

function luutaisan() {
	var t1, t2, t3, t4, t5, t6, t7, t8, t9, t10, t11, t12, t13, t14, nhom;
	t0 = (document.getElementById('ma').value);
	t1 = (document.getElementById('Name').value);
	t2 = (document.getElementById('type').value);
	t3 = (document.getElementById('soluong').value);
	t4 = (document.getElementById('gia').value);
	t5 = (document.getElementById('donvitinh').value);
	t6 = (document.getElementById('nguoinhants').value);
	t7 = (document.getElementById('ngaybatdau').value);
	t8 = (document.getElementById('ngayketthuc').value);
	t9 = (document.getElementById('note2').value);
	t10 = (document.getElementById('baohanh').value);
	t11 = (document.getElementById('idts').value);
	t12 = (document.getElementById('ghichuluu').value);
	t13 = (document.getElementById('mota').value);
	t14 = document.getElementById('ngay').value;
	nhom = (document.getElementById('nhomtaisan').value);


	if (t1 == '') { alert('bạn chưa nhập tên tài sản !!!'); return; }
	//	if (t2=='' )	{	alert('bạn chưa nhập tên tài sản !!!'); document.getElementById('Name').focus(); return ;	}
	if (t3 == '0' || t3 == '') { alert('bạn chưa nhập số lượng !!!'); document.getElementById('soluong').focus(); return; }
	if (t4 == '0' || t4 == '') { alert('bạn chưa nhập đơn giá !!!'); document.getElementById('gia').focus(); return; }
	if (t5 == '0') { alert('bạn chưa chọn ĐVT !!!'); document.getElementById('donvitinh').focus(); return; }
	if ((t7) == '') { alert('bạn chưa nhập ngày mua !!!'); document.getElementById('ngaybatdau').focus(); return; }
	if (t9 == t12) { alert('bạn chưa nhập ghi chú !!!'); document.getElementById('note2').focus(); return; }
 
 poststr = "DATA=" + encodeURIComponent(t0) + "*@!" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(t2) + "*@!" + encodeURIComponent(t3);
	poststr = poststr + "*@!" + encodeURIComponent(t4) + "*@!" + encodeURIComponent(t5) + "*@!" + encodeURIComponent(t6) + "*@!" + encodeURIComponent(t7);
	poststr = poststr + "*@!" + encodeURIComponent(t8) + "*@!" + encodeURIComponent(t9) + "*@!" + encodeURIComponent(t10) + "*@!" + encodeURIComponent(t11);
	poststr = poststr + "*@!" + encodeURIComponent(t12) + "*@!" + encodeURIComponent(nhom) + "*@!" + encodeURIComponent(t13) + "*@!" + encodeURIComponent(t14);
	loadtrang('ketqualuu', "taisannhapmoi_luutaisan", poststr, "xuly2");
}

function xuly2() {
	var tam = document.getElementById('ketqualuu').innerHTML;
	var n = tam.split("**#"); //alert(ketqua);
	document.getElementById('idts').value = n[1];
	document.getElementById('ma').value = n[2];
	alert(n[3]);
	document.getElementById('ketqualuu').innerHTML = '';
	document.location.href = "?act=taisannhapmoi";
}

function hienthinhapts(v) {
	if (v == 1) {
		document.getElementById('hiennhaptaisan').style.display = "";
		// document.getElementById('gia').value=document.getElementById('sotien').value ;
		document.getElementById('ma').value = document.getElementById('sochungtu').value;
		document.getElementById('luu').style.display = "none";

		// document.getElementById('soluong').value=document.getElementById('soluong').value ;

	} else if (v == 2) {
		document.getElementById('hiennhaptaisan').style.display = "none";
		document.getElementById('luu').style.display = "";

	}
}


function goiluu() {
	var t1, t2, t3, t4, t5, t6, t7, t8, t9, t10, t11, t12, t13, t14;


	t0 = (document.getElementById('loainhom').value);
	t1 = (document.getElementById('ngay').value);
	t2 = (document.getElementById('sochungtu').value);
	t3 = (document.getElementById('sotien').value);
	t4 = (document.getElementById('lydo').value);
	t5 = (document.getElementById('nguoinhan').value);
	t6 = (document.getElementById('nguoichi').value);
	t7 = (document.getElementById('cuahang').value);
	t8 = (document.getElementById('donvi').value);
	if (t0 == '-1') t8 = document.getElementById('nhacungcap').value;
	t9 = (document.getElementById('note').value);
	t10 = (document.getElementById('ID').value);
	t11 = document.getElementById('luachon').value;
	t12 = document.getElementById('loaitaikhoan').value;
	t13 = document.getElementById('nganhang').value;
	t14 = document.getElementById('loaitaisan').value;



	//	if (t11==''){	alert('bạn chưa chọn loại thu chi mua bán !!!'); document.getElementById('luachon').focus(); return ;	}
	if (t1 == '') { alert('bạn chưa chọn ngày chứng từ !!!'); document.getElementById('ngay').focus(); return; }
	if (t12 == '1' && t13 == '') { alert('bạn chưa chọn ngân hàng !!!'); document.getElementById('nganhang').focus(); return; }
	if (t13 != '' && t12 == '0' && t0 != '1') { alert('bạn phải chọn loại tài khoản là tiền mặt nếu ô này có chọn tài khoản ngân hàng !!!'); document.getElementById('loaitaikhoan').focus(); return; }

	if (t2 == '') { alert('bạn chưa nhập số chứng từ !!!'); document.getElementById('sochungtu').focus(); return; }
	if (t0 == '') { alert('bạn chưa chọn nhóm thu chi mua bán !!!'); document.getElementById('loainhom').focus(); return; }
	if (t7 == '0') { alert('bạn chưa chọn cửa hàng !!!'); document.getElementById('cuahang').focus(); return; }
	if (t0 == '-1' && t8 == '0') { alert('bạn chưa chọn nhà cung cấp !!!'); document.getElementById('nhacungcap').focus(); return; }
	if (t4 == '') { alert('bạn chưa nhập lý do !!!'); document.getElementById('lydo').focus(); return; }
	if (t3 == '') { alert('bạn chưa nhập số tiền !!!'); document.getElementById('sotien').focus(); return; }
	if (t13 == '' && t12 == '0' && t0 == '1') { alert('bạn phải chọn  tài khoản ngân hàng !!!'); document.getElementById('nganhang').focus(); return; }
	if (t14 == '0') { alert('bạn phải chọn tài sản là CÓ hoặc KHÔNG  !'); document.getElementById('loaitaisan').focus(); return; }

	if (chay == 0) return;
	poststr = "DATA=" + encodeURIComponent(t0) + "*@!" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(t2) + "*@!" + encodeURIComponent(t3);
	poststr = poststr + "*@!" + encodeURIComponent(t4) + "*@!" + encodeURIComponent(t5) + "*@!" + encodeURIComponent(t6) + "*@!" + encodeURIComponent(t7);
	poststr = poststr + "*@!" + encodeURIComponent(t8) + "*@!" + encodeURIComponent(t9) + "*@!" + encodeURIComponent(t10) + "*@!" + encodeURIComponent(t11);
	poststr = poststr + "*@!" + encodeURIComponent(t12) + "*@!" + encodeURIComponent(t13) + "*@!" + encodeURIComponent(t14) + "*@!" + encodeURIComponent(0);


	loadtrang('ketqualuu', "thuchichluu", poststr, "xuly1");
	//		alert('hihihhi');

}

function xoatc(tc) {  //tungay,denngay,luachon,nhomtk,taikhoan2,lydo2,tr
	var cf = " Bạn có chắc chắn muốn xóa phiếu này hay không ? ";
	if (thongbao(cf) == false) { return }
	poststr = "DATAD=" + encodeURIComponent(tc) + "*@!" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0);
	loadtrang('ketqualuu', "thuchichluu", poststr, "xuly1");
}


function setphieu(t0, t1, t2, t3, t4, t5, t6, t7, t8, t9, t10, t11, t12, t13, t14) {

	document.getElementById('ID').value = t0;
	document.getElementById('loainhom').value = t1;
	document.getElementById('ngay').value = t2;
	document.getElementById('sochungtu').value = t3;
	document.getElementById('sotien').value = t4;
	document.getElementById('lydo').value = t5;
	document.getElementById('nguoinhan').value = t6;
	document.getElementById('nguoichi').value = t7;
	document.getElementById('cuahang').value = t8;
	document.getElementById('donvi').value = t9;
	document.getElementById('loaitaisan').value = t14;
	if (t1 == '-1') {
		document.getElementById('donvi').style.display = "none";
		document.getElementById('dncc').style.display = "";
		document.getElementById('nhacungcap').value = t9;
		document.getElementById('manhacungcap').innerHTML = "Mã nhà cung cấp: " + t9;
		document.getElementById('select2-nhacungcap-container').innerHTML = t9;
	} else {
		document.getElementById('donvi').style.display = "";
		document.getElementById('dncc').style.display = "none";

	}
	document.getElementById('note').value = t10;
	document.getElementById('luachon').value = t11;
	document.getElementById('loaitaikhoan').value = t12;
	document.getElementById('nganhang').value = t13;

	if (t11 == 0) document.getElementById('luachon').value = '';
	document.getElementById('luu').value = 'Cập nhập';
	document.getElementById('ngay').focus();

}

function setmoi() {
	chay = 1;
	document.getElementById('ID').value = '';
	document.getElementById('ngay').value = '';

	document.getElementById('sotien').value = '';
	document.getElementById('lydo').value = '';
	document.getElementById('nguoinhan').value = '';
	document.getElementById('nguoichi').value = '';

	document.getElementById('donvi').value = '';
	document.getElementById('note').value = '';
	document.getElementById('loainhom').value = '';
	document.getElementById('luu').value = 'Lưu';
	document.getElementById('ngay').value = document.getElementById('ngayhn').value;
	document.getElementById('loaitaikhoan').value = '';
	document.getElementById('nganhang').value = '';
	//	document.getElementById('sochungtu').value=  '' ; 




	poststr = "DATA=" + encodeURIComponent(0) + "*@!" + encodeURIComponent(document.getElementById('luachon').value) + "*@!" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0);
	loadtrang('ketqualuu', "taosochungtu", poststr, "xuly8");


	document.getElementById('ngay').focus();

}

function xuly8() {

	var tam = document.getElementById('ketqualuu').innerHTML;
	var n = tam.split("###");
	document.getElementById('sochungtu').value = n[1];
	sdocument.getElementById('ketqualuu').innerHTML = '';
}
function setcongno(t0) {
	if (t0 == -2) {
		luuc = document.getElementById('cuahang').innerHTML;
		var second = document.getElementById('nhacungcap');
		document.getElementById('cuahang').innerHTML = second.innerHTML;
	}
	else {
		if (luuc != '') { document.getElementById('cuahang').innerHTML = luuc; luuc = ''; }

	}

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



function xuattimsanpham(t1, t2, t3, t4, t5, t6) {

	poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(t2) + "*@!" + encodeURIComponent(t3) + "*@!" + encodeURIComponent(t4);
	poststr = poststr + "*@!" + encodeURIComponent(t5) + "*@!" + encodeURIComponent(t6);
	loadtrang('sanpham', "xuatkhotimsp", poststr, "");

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
	document.getElementById('diachi').value = diachi;

	document.getElementById('timkhachhang').style.display = "none";
	document.getElementById('codechinh').style.display = "";
	document.getElementById('note').focus();

}
var idxe = '';

function xuly5() {
	document.getElementById('khachhang').value = idxe;
	//document.getElementById('IDXe').value= idxe;
}

function xesetkhachhang(soxe) {
	var idxe = '';
	idxe = setidxetuso(mangj, soxe);
	//	alert(soxe);
	document.getElementById('khachhang').value = idxe;
	timdiachi((idxe));

	if (idxe == '' && soxe != '') {
		alert('Không có só xe "' + soxe + '" này, Bạn hãy bấm nút "Tìm" để tìm chính xác hơn hoặc tạo mới khách hàng  !!!');
		document.getElementById('xe').value = "";
		document.getElementById('xe').focus();
	}
}
function sethtkhachhang(loai, id, diachi, soxe) {
	idxe = id;
	document.getElementById('khachhang').value = id;
	// document.getElementById('IDXe').value= id;
	document.getElementById('diachi').value = diachi;
	//	 document.getElementById('xe').value= soxe;

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
	if ((document.getElementById('ngaynhap').value) == '') {
		alert('Xin vui lòng nhập vào ngày nhập!');
		document.getElementById('ngaynhap').focus();
		return false;
	}
	if ((document.getElementById('sochungtu').value) == '') {
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


function xulychung() {
	document.getElementById('luu').disabled = true;
}


function xuly9() {
	document.getElementById('sochungtu').value = (ketqua);
}
function setsoct(t0) {
	poststr = "DATA=" + t0 + "*@!" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0);
	loadtrang('', "setsoct", poststr, "xuly9");
}
function copi(t) {
	document.getElementById('luu').disabled = false;
	document.getElementById('copy').disabled = true;
	document.getElementById('idgoi').value = '';
	setsoct(t);

}

function setlaiphieu(t1, t2) {
	poststr = "DATA=" + "0*@!" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(t2) + "*@!" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0);
	loadtrang('', "nhapkhogoi", poststr, "xuly4");

	//	  poststr="DATA="+ "0*@!" +  encodeURIComponent(t1)+  "*@!"+ encodeURIComponent(t2)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0);
	//	  loadtrang('httimlai', "nhapkhoht", poststr,"") ;		

	if (t2 == "0") {
		document.getElementById('luu').disabled = false;
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


function capnhapgia(idsp, dongia) {
	poststr = "DATA=" + encodeURIComponent(idsp) + "*@!" + encodeURIComponent(dongia) + "*@!" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0);
	loadtrang('ketqualuu', "capnhapgia", poststr, "");
}

function addpro(idsp, ten, code, dongia, loaitien, soluong, thue, ghichu) {
	if (idsp == '') {
		alert('Bạn Chưa chọn hàng hóa!!!'); document.getElementById('NameTK').focus(); return;
	}
	if (laso(dongia) == 0) {
		var cf = "Bạn chưa nhập đơn giá!!! \n\nBạn có muốn nhập hay không ?";
		var n = confirm(cf);
		if (n == true) {
			document.getElementById('dongia').focus();
			return false;
		}
	}
	if ((soluong) == '' || laso(soluong) == 0) {
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
	document.getElementById('dongia').focus();

}

function xuatsp() {
	var x, stt, str = ""; stt = 0;
	var thanhtien, tong;
	thanhtien = 0; tong = 0;
	str = ' <table width="100%" border="0" cellpadding="0" cellspacing="0">';
	str += '    <tr bgcolor="#F8E4CB"> ';
	str += ' <td width="29"  align="center" class="cothienthi" height="23"><b>STT</b></td> ';
	str += ' <td width="115" align="center" class="cothienthi"><strong>Mã hàng hóa </strong></td> ';
	str += ' <td width="350" align="center" class="cothienthi"><strong>Tên hàng hóa</strong></td> ';
	str += ' <td width="45"  align="center" class="cothienthi"><strong>SL</strong></td> ';
	str += ' <td width="105" align="center" class="cothienthi"><strong>Đơn Giá </strong></td> ';
	str += ' <td width="51"  align="center" class="cothienthi"><strong>Thuế</strong></td> ';
	str += ' <td width="100" align="center" class="cothienthi"><strong>Thành Tiền </strong></td> ';
	str += ' <td width="300" align="center" class="cothienthi"><strong>Ghi Chú </strong></td> ';
	str += ' <td width="30"  align="center" class="cothienthi"><strong>X&#243;a</strong></td> ';
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
		stt = stt + 1;
		str += '<TR onMouseOver="this.className=\'' + hl2 + '\'" onMouseOut="this.className=\'' + h1 + '\'" bgcolor="' + mau + '" style="cursor:pointer" onclick="setthongtin(\'' + x + '\')">';
		str += ' <td class="cothienthi"  align="Right" height="23">' + stt + '</td>';
		str += ' <td class="cothienthi"  align="center"  >&nbsp;' + mangsp[x][0] + '</td>';
		str += ' <td class="cothienthi"  align="center"  >&nbsp;' + mangsp[x][1] + '</td>';
		str += ' <td class="cothienthi"  align="center"  >&nbsp;' + mangsp[x][2] + '</td>';
		str += ' <td class="cothienthi"  align="center"  >&nbsp;' + txtFormatj(mangsp[x][3]) + '</td>';
		str += ' <td class="cothienthi"  align="center"  >&nbsp;' + mangsp[x][4] + '%</td>';
		str += ' <td class="cothienthi"  align="right"  >&nbsp;' + txtFormatj(thanhtien) + '&nbsp;</td>';
		str += ' <td class="cothienthi"  align="center"  >&nbsp;' + mangsp[x][6] + '</td>';
		str += ' <td class="cothienthi"  align="center"  ><img onclick="xoapt(\'' + x + '\')" title=\"Xóa Mục\"  src="images/delete.gif" border="0"></td>';

		str += ' </Tr>';

	}
	str += ' <Tr class="cothienthi"><td colspan="6" align="right" ><b>Tổng cộng</b> </td><td  align="right"><b>' + txtFormatj(tong) + '</b>&nbsp;</td><td></td>';
	str += ' </Tr>';
	str += '</table>';
	document.getElementById('sanphamnhap').innerHTML = str;



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
	var so = document.getElementById('ID').value;
	var st;
	st = "thuchichinphieu.php?id=" + so;
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

 
 