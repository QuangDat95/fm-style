
var mangsp = new Array();

function timtheomacode(v)
{
	document.getElementById('loadingtim').style.display = "flex";
	console.log(v);
	poststr = "DATA=" + encodeURIComponent(v) + "*@!" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0);
	loadtrang('reshidden', "xuattimtheoma", poststr, "xuly4");
}

function layvesoluong(macode)
{
	for (x in mangsp) {
		if (mangsp[x][0] == macode) return mangsp[x][2];
	}
	return 0;
}



function xuly9()
{
	document.getElementById('loadingtim').style.display = "none";
	var tam = document.getElementById('reshidden').innerHTML;
	console.log(tam);
	//alert(tam)
	var n = tam.split("##");

	if (n[1] == "") return;
	n[8] = 1 + parseFloat(layvesoluong(n[3]));
	thaydoisoluong(n[3], n[8]);
	//  document.getElementById("sound_element").innerHTML= "<embed src='images/ding.wav' hidden=true autostart=true loop=false>"; 
	//document.getElementById('nhac').play();
	//alert(n[6])
	var dg = n[4];
	dg = dg.replace(',', ''); dg = dg.replace(',', '');
	var giagiam = Math.round(parseFloat(dg) - parseFloat(dg) * n[6] / 100);
	setsanpham(n[1], n[2], n[3], n[4], n[5], n[6], n[9], n[8], n[11], giagiam, n[13]);
	// document.getElementById('soluong').value = n[8];
	//document.getElementById('codeprotk').value ='';

	if (n[8] == 1) document.getElementById('add').click();


}



function xuatsp()
{
	var mau, h1, h12;
	tongsl = 0;
	var str = '';
	var tong = 0;
	var stt = 0;
	console.log(mangsp)
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
		thanhtien = thanhtien - thanhtien * mangsp[x][4] / 100;
		thanhtien = Math.round(thanhtien, 0);
		tong = tong + thanhtien;
		tongsl = 1 * tongsl + 1 * mangsp[x][2];
		stt = stt + 1;
		str += '<div class="itempr boder_" id="itempr1" data-id="' + x + '">';
		str += '<div class="left" id="itemprleft' + x + '" data-id="' + x + '">';
		str += '<div class="name" data-id="' + x + '">' + mangsp[x][0] + ' ' + mangsp[x][7] + '</div>';
		str += '<div class="price" data-id="' + x + '">';
		str += '<span data-id="' + x + '">' + mangsp[x][3] + '</span>';
		str += '<span data-id="' + x + '" style="color:green;margin-left:0.5em">x</span><span class="sltanggiam' + x + '">' + mangsp[x][2] + '</span>';
		str += '</div></div>';

		str += '<div class="right" id="itemprright' + x + '" data-id="' + x + '">';
		str += '<div class="price " data-id="' + x + '">';
		str += '<div class="slthaydoi" id="slthaydoi" data-id="' + x + '"><span class="sltanggiam' + x + '">' + mangsp[x][2] + '</span></div>';
		str += '<button class="btn tanggiam" id="giamsl' + x + '" data-id="' + x + '" value="' + mangsp[x][2] + '" onclick="tanggiamsoluong(event,' + x + ',1)">-</button>';
		str += '<button class="btn tanggiam" id="tangsl' + x + '" data-id="' + x + '" value="' + mangsp[x][2] + '" onclick="tanggiamsoluong(event,' + x + ',2)">+</button>';
		str += '</div></div>';
		str += '<button class="delete_hidden " id="delete_hidden' + x + '"><img onclick="xoapt(\'' + x + '\')" title=\"Xóa Mục\"  src="images/delete.gif" border="0"></button></div>';

		// str += '<tr>';
		// str += '<td align="center">' + stt + '</td>';
		// str += ' <td class="delete_hidden" id="delete_hidden' + x + '"><img onclick="xoapt(\'' + x + '\')" title=\"Xóa Mục\"  src="images/delete.gif" border="0"></td>'
		// str += ' <td onClick="showDelete(\'' + x + '\')">' + mangsp[x][0] + '</td>';
		// str += ' <td onClick="showDelete(\'' + x + '\')">' + mangsp[x][0] + ' ' + mangsp[x][7] + '</td>';
		// str += ' <td onClick="showDelete(\'' + x + '\')"><input type="text" style="width: 30px;" id="sl" name="sl" value="' + mangsp[x][2] + '" /> <div style="display: inline-flex;"><button>+</button><button>+</button></div></td>';
		// str += '<td onClick="showDelete(\'' + x + '\')">' + txtFormatj(mangsp[x][3]) + '</td>';
		// str += ' <td onClick="showDelete(\'' + x + '\')">' + mangsp[x][4] + '</td>';
		// str += ' <td onClick="showDelete(\'' + x + '\')">' + txtFormatj(thanhtien) + '</td>';
		// str += ' <td onClick="showDelete(\'' + x + '\')">' + mangsp[x][6] + '</td>';
		// str += ' <td><img onclick="xoapt(\'' + x + '\')" title=\"Xóa Mục\"  src="images/delete.gif" border="0"></td>';

	}
	var strtong = '<span>Tổng tiền:</span><span class="price"><span>' + txtFormatj(tongsl) + '</span><span>' + txtFormatj(tong) + '</span></span>';
	// var strtong = '<td align="center" style="border: none;" colspan="4" class="fixed_left">                        <div><span style="width: 40%;"><strong>Tổng:</strong><span><strong>' + txtFormatj(tongsl) + '</strong></span></span> <span>' + txtFormatj(tong) + '</span>                                </div> </td><td style="border: none;"></td> <td style="border: none;"></td> <td style="border: none;"></td>   <td style="border: none;"></td><td style="border: none;"></td>';
	document.getElementById('showsp').innerHTML = str;

	document.getElementById('tongtienhd').innerHTML = strtong;
	document.getElementById('masp').value = '';
	// eval(document.getElementById('showsp'));
	$("#showsp .itempr").each((index, el) =>
	{
		el.addEventListener('touchstart', handleTouchStart, false);
		el.addEventListener('touchmove', handleTouchMove, false);
	});
}
function xuly4()
{
	document.getElementById('loadingtim').style.display = "none";
	var ketqua = document.getElementById('reshidden').innerHTML;
	console.log(ketqua);
	var msp = ketqua.split('##');
	if (msp[1] == '-1') {
		alert(msp[2]);
		return;
	}
	//var mang = new Array() ;
	if (mangsp[msp[1]]) {
		var sltam = mangsp[msp[1]][2];
		sltam++;
		mangsp[msp[1]][2] = sltam;

	}
	else {

		//  (code, ten,soluong,dongia, thue,loaitien,ghichu,  mt,    giagiam);     9  
		mangsp[msp[1]] = new Array(msp[3], msp[2], 1, msp[4], '0', 'VND', msp[7], msp[3], msp[6], '');

	}
	xuatsp();
	//timphieu() ;
}

function tanggiamsoluong(e, id, loai)
{
	var target = e.target;

	var value = target.value;
	if (loai == 1) {
		if (value == 1) {
			return;
		}
		value--;
	}
	else if (loai == 2) {
		value++;
	}
	console.log(value);
	// $('#tangsl' + id).val(value);
	// $('#giamsl' + id).val(value);
	// $('.sltanggiam' + id).html(value);
	thaydoisoluong(id, value);
}
function thaydoisoluong(id, soluong)
{

	mangsp[id][2] = soluong;
	xuatsp();

}
function xoapt(id)
{

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



function luuphieuxuat()
{
	// if (document.getElementById('luu').disabled) return;

	// if (document.getElementById('online').value == "0") {
	// 	alert("Bạn chưa chọn nhân viên tư vấn");
	// 	document.getElementById('online').focus();
	// 	return;
	// }
	var cf = " Bạn có chắc chắn muốn khóa phiếu này hay không ? ";
	if (confirm(cf)) {
		var idluu, ngayxuatkho, sochungtu, xuatkho, tigia, lydo, khachhang, ghichu, tenkhachhang, tenlydo, idgoi, khachdua, qua, diem, ido, idch;
		sochungtu = document.getElementById('sochungtu').value;
		tigia = document.getElementById('TiGia').value;
		lydo = document.getElementById('lydo').value;
		khachhang = document.getElementById('idkh').value;
		ghichu = document.getElementById('note').value;
		vat = document.getElementById('VAT').value;
		ghichu = document.getElementById('note').value;
		khachdua = document.getElementById('khachdua').value;
		tienbot = document.getElementById('bot').value;
		qua = document.getElementById('chonnhanqua').checked;
		diem = document.getElementById('diem').value;
		makm = document.getElementById('makm').value;
		ido = document.getElementById('online').value;
		//  alert(idgoi)
		idgoi = document.getElementById('idgoi').value;
		idch = document.getElementById('cuahang').value;
		if (kiemtraphieu() == true) {
			if (lydo != 5) idch = 0;

			document.getElementById('luu').disabled = true;
			poststr = "DATA=" + idgoi + "*@!" + encodeURIComponent(mangthanhchuoi(mangsp)) + "*@!" + encodeURIComponent(sochungtu);
			poststr += "*@!" + encodeURIComponent(xuatkho) + "*@!" + encodeURIComponent(tienbot) + "*@!" + encodeURIComponent(lydo);
			poststr += "*@!" + encodeURIComponent(ido) + "*@!" + encodeURIComponent(khachhang) + "*@!" + encodeURIComponent(ghichu);
			poststr += "*@!" + encodeURIComponent(vat) + "*@!" + encodeURIComponent(0) + "*@!" + encodeURIComponent(tenkhachhang);
			poststr += "*@!" + encodeURIComponent('diachi') + "*@!" + encodeURIComponent(0) + "*@!" + encodeURIComponent(khachdua);
			poststr += "*@!" + encodeURIComponent(qua) + "*@!" + encodeURIComponent(diem) + "*@!" + encodeURIComponent(makm) + "*@!" + encodeURIComponent(idch);
			loadtrang('ketqualuu', "xuatkholuu", poststr, "xuly");
		}
		return false;
	}
}