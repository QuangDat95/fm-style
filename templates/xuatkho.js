

window.onload = function () {

	document.body.onkeydown = function (e) {
		//  alert(e.keyCode); 
		//  if (e.keyCode==75 && event.ctrlKey && !document.getElementById('khoa').disabled)    {  khoaphieu();    return;    }\\
		if (e.keyCode == 27) { window.open('default.php?act=xuatkho', '_self'); return; }
		if (e.keyCode == 90 && event.altKey) { document.getElementById('soluong').focus(); document.getElementById('soluong').select(); }
		if (e.keyCode == 88 && event.altKey) { document.getElementById('codeprotk').focus(); document.getElementById('codeprotk').select(); }
		if (e.keyCode == 83 && event.altKey) { document.getElementById('luu').click(); }
	};
}


var phantramgiam = 0;
var maxgiamgia = 0;
var mangsp = new Array();
var mangph = new Array();
var mangsp1 = new Array();
var mangtam = new Array();
var dakhoa = false;
var kiemtra50 = false;
var thuhangkhach = 0;

var x, khachduatien, tongsl, km;
km = 0;
//=======================================================
function doinhac(n) {
	document.getElementById('nhac').src = "images/tb" + n + ".wav";
	document.getElementById('nhac').play();
}

function setlailuu(v) {

	document.getElementById('luu').disabled = "";
	document.getElementById('khoa').disabled = "";

}

function xuly1() {
	document.getElementById("hiethithongbao").style.display = '';
}
function goikhach() {
	var t1;
	t1 = document.getElementById('idkh').value;
	if (t1 == '' || t1 == 1) return;
	document.getElementById("hiethithongbao").style.display = '';
	poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0);
	loadtrang('hienthihoso', "thongtinkhachhangmua", poststr, "xuly1");

}

var phantramgiamgia = [];
var solancheck = 0;
function kiemtrama(t1) {

	if (t1 == '') { km = 0; document.getElementById('bot').value = 0; maxgiamgia = 0; phantramgiam = 0; xuatsp(); return; }
	t1 = t1.toLowerCase();
	if ((t1 == 'sv50' || t1 == 'sv15') && document.getElementById('idkh').value == 1) { alert('Vui lòng chọn khách hàng trước khi dùng mã !'); timkhachhang(); return; }

	poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(document.getElementById('idkh').value) + "*@!" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0);
	loadtrang('ketqualuu', "xuatkhokhuyenmaitim", poststr, "xuly3");

}

function xuly3() {
	tam = document.getElementById('ketqualuu').innerHTML
	//alert(tam)
	km = 0;
	var n = tam.split("**#");
	phantramgiamgia = n;
	maxgiamgia = 0; phantramgiam = 0;


	if (n[1] == '-1') { alert('Không tìm thấy mã khuyến mãi này trong hệ thống !'); document.getElementById('bot').value = 0; }
	else if (n[1] == '-2') { alert('Mã khuyến mãi này đã sử dụng vào ngày ' + n[2]); document.getElementById('bot').value = 0; }
	else if (n[1] == '-3') { alert('Mã Số không hợp lệ. Mã số này chỉ được áp dụng tại ' + n[2]); document.getElementById('bot').value = 0; }
	else if (n[1] == '-4') { alert(' ' + n[2]); document.getElementById('bot').value = 0; }
	else if (n[3].indexOf('DKG') > 0)   // co dieu kien  #DKG#SP2#G50#
	{
		var m = n[3].split("#");
		giamgiatudong(n[3]);
		alert(m[4])
		return;
	} else if (n[3].indexOf('GVC') > 0) {
		var m = n[3].split("#");
		giamgiatudong(n[3]);
		alert(m[7])
		return;
	} else if (n[3].indexOf('GPT') > 0) {
		var m = n[3].split("#");
		giamgiatudong(n[3]);
		alert(m[9])
		return;
	}
	else {
		if (n[4] > 1000) {
			alert(' Voucher giảm giá có điều kiện số tiền >= ' + formatso(n[4]));
		}

		if (n[2] < 0) {
			maxgiamgia = Math.abs(n[2]); phantramgiam = n[1]; alert('mã thẻ này được giảm giá ' + n[1] + '% trên tổng hóa đơn và không quá ' + formatso(maxgiamgia));
			xuatsp(); return;
		}

		if (n[1] > 100) document.getElementById('bot').value = n[1];
		else {
			if (n[2] > 1) alert(n[3]); else alert('mã thẻ này được giảm giá ' + n[1] + '% trên tổng hóa đơn !');
			document.getElementById('bot').value = 0;
			km = n[1]; kiemtra50 = false;
			if (n[2] == 1) { kiemtragiamgia50(2); km = 0; kiemtra50 = false; }
			if (n[2] == 2) { km = 0; kiemtra50 = false; }
		}
	}

}

function xuly33() {
	tam = document.getElementById('ketqualuu').innerHTML
	//alert(tam)
	km = 0;
	var n = tam.split("**#");
	phantramgiamgia = n;
	maxgiamgia = 0; phantramgiam = 0;


	if (n[1] == '-1') { alert('Không tìm thấy mã khuyến mãi này trong hệ thống !'); document.getElementById('bot').value = 0; }
	else if (n[1] == '-2') { alert('Mã khuyến mãi này đã sử dụng vào ngày ' + n[2]); document.getElementById('bot').value = 0; }
	else if (n[1] == '-3') { alert('Mã Số không hợp lệ. Mã số này chỉ được áp dụng tại ' + n[2]); document.getElementById('bot').value = 0; }
	// #GPT#15#DK#gia#>#1000#SL#2# thăng hạng Bạc  giảm  15 2 sản p
	else if (n[3].indexOf('GPT') > 0)   // co dieu kien  #DKG#SP2#G50#
	{
		var m = n[3].split("#");
		giamgiatudong(n[3]);
		alert(m[4])
		return;
	}
	else if (n[3].indexOf('DKG') > 0)   // co dieu kien  #DKG#SP2#G50#

	{
		var m = n[3].split("#");
		giamgiatudong(n[3]);
		alert(m[4])
		return;
	} else if (n[3].indexOf('GVC') > 0) {
		var m = n[3].split("#");
		giamgiatudong(n[3]);
		alert(m[7])
		return;
	}
	else {
		if (n[4] > 1000) {
			alert(' Voucher giảm giá có điều kiện số tiền >= ' + formatso(n[4]));
		}

		if (n[2] < 0) {
			maxgiamgia = Math.abs(n[2]); phantramgiam = n[1]; alert('mã thẻ này được giảm giá ' + n[1] + '% trên tổng hóa đơn và không quá ' + formatso(maxgiamgia));
			xuatsp(); return;
		}

		if (n[1] > 100) document.getElementById('bot').value = n[1];
		else {
			if (n[2] > 1) alert(n[3]); else alert('mã thẻ này được giảm giá ' + n[1] + '% trên tổng hóa đơn !');
			document.getElementById('bot').value = 0;
			km = n[1]; kiemtra50 = false;
			if (n[2] == 1) { kiemtragiamgia50(2); km = 0; kiemtra50 = false; }
			if (n[2] == 2) { km = 0; kiemtra50 = false; }
		}
	}

}

function kiemtragiamgia50(loai = 0) {

	if (kiemtra50 == false) return;
	//phantramgiamgia[1]=50;
	//phantramgiamgia[2]=1;
	var checkgiamgia = false;
	if (phantramgiamgia[1]) {

		checkgiamgia = true;
	} else {

		return;
	}
	if (phantramgiamgia[2] > 0) {
		checkgiamgia = true;
	}
	else {
		return;
	}

	if (checkgiamgia) {

		tinhgiamgia(phantramgiamgia[1], phantramgiamgia[2]);
		if (loai = 2) {
			solancheck = 1;
			xuatsp();

		}
	}
	else {
		return;
	}

}


function setgiammn(sl1, sl2, pt1, pt2) {
	var a = new Array();
	var tam = mangsp1;
	mangsp = mangsp1;
	for (x in tam) {
		for (i = 1; i <= tam[x][2]; i++) {
			so = 1 * tam[x][3];
			a.push([x, so]);
		}
	}
	//============ sap xep ====================================================	
	a.sort(sortFunction);
	function sortFunction(a, b) {
		if (a[1] == b[1]) {
			return 0;
		} else {
			return (a[1] > b[1]) ? -1 : 1;
		}
	}
	//=============tim vi tri set giam =======================================
	i = 0; var j = 0; var mang = new Array(); var macu = 0; var tongck = 0;
	for (t in a) {
		i++;
		if (i == parseInt(sl1)) {
			mang[j] = [a[t][0], parseInt(pt1)];
		} else if (i == parseInt(sl2)) {
			mang[j] = [a[t][0], parseInt(pt2)];
			i = 0;
			j++;
		}
	}
	console.log(mang);
	//==========================================================================
	for (t in mang) {
		if (mangsp[mang[t][0]][0] == macu) {
			tongck += mang[t][1];
		} else {
			tongck = mang[t][1]; macu = mangsp[mang[t][0]][0];
		}
		mangsp[mang[t][0]][4] = tongck / mangsp[mang[t][0]][2];
	}

	xuatsp();
}

function ctrinh4_20k() {
	var a = new Array();
	var tam = mangsp1;
	mangsp = mangsp1;
	for (x in tam) {
		for (i = 1; i <= tam[x][2]; i++) {
			so = 1 * tam[x][3];
			a.push([x, so]);
		}
	}
	//============ sap xep ====================================================	
	a.sort(sortFunction);
	function sortFunction(a, b) {
		if (a[1] == b[1]) {
			return 0;
		} else {
			return (a[1] > b[1]) ? -1 : 1;
		}
	}
	//=============tim vi tri set giam =======================================
	i = 0; var j = 0; var mang = new Array(); var macu = 0; var tongck = 0;
	for (t in a) {
		i++;
		if (i == 4) {
			var dis_per = (1-(20000/a[t][1]))*100; 
			mang[j] = [a[t][0], dis_per];
			j++; i = 0;
		} 
	}
	// console.log(mang);
	//==========================================================================
	for (t in mang) {
		if (mangsp[mang[t][0]][0] == macu) {
			tongck += mang[t][1];
		} else {
			tongck = mang[t][1]; macu = mangsp[mang[t][0]][0];
		}
		mangsp[mang[t][0]][4] = tongck / mangsp[mang[t][0]][2];
	}

	xuatsp();
}


var macutam = '';
function tinhgiamgia(tiengiamgia, dieukien) {
	//console.log(mangsp);
	var a = new Array();
	var tam = mangsp;
	var k = 0;
	for (x in tam) {
		for (i = 1; i <= tam[x][2]; i++) {
			so = 1 * tam[x][3];

			a.push([x, so]);
			k++;

		}
	}
	//============ sap xep ====================================================	
	a.sort(sortFunction);
	function sortFunction(a, b) {
		if (a[1] == b[1]) {
			return 0;
		}
		else {
			return (a[1] > b[1]) ? -1 : 1;
		}
	}
	console.log(a);
	//=============tim vi tri set giam =======================================
	i = 0; var j = 0; var macu = ''; var mang = new Array(); var tongtiengiam = 0; var tongtiengoc = 0; k = 0; var soluong = 0; var giasp = 0;
	for (t in a) {

		if (i == 0) {
			mang[j] = [a[t][0], km];
			if (macutam != '' && macutam != mangsp[a[t][0]][0] && mangsp[macutam]) {
				if (mangsp[macutam][4]) {
					mangsp[macutam][4] = 0;
				}
			}
			macutam = a[t][0];
			macu = mangsp[a[t][0]][0];
		}
		else {
			if (macu != mangsp[a[t][0]][0]) {
				mang[j] = [a[t][0], 0];
			}


		}
		j++;
		i++;


	}

	//console.log(macutam);

	//==========================================================================
	for (t in mang) {
		// alert( mangsp[mang[t][0]][3]) 
		// (k-tongtiengiam)/k*100 
		//  mangsp[mang[t][0]][4] =  mang[t][1] /   mangsp[mang[t][0]][2] ;
		mangsp[mang[t][0]][4] = mang[t][1] / mangsp[mang[t][0]][2];
	}
	//console.log(mangsp);
	//xuatsp() ;
}

function setchietkhau(ck) {
	document.getElementById('chietkhau').value = ck;
}

function setchietkhauchung(ck) {

	var mt = new Array();
	if (ck != '') {
		for (x in mangsp) {
			mt[x] = mangsp[x];
			mt[x][4] = ck;
		}
		//	alert('112')
		mangsp = mt;
		xuatsp();
	}
}


function xulychung() {
	tam = document.getElementById('ketqualuu').innerHTML;

	//  alert(tam) ;
	//return ;
	var n = tam.split("**#");

	if (n[1] == "") { alert('cố lỗi xảy ra hoặc đường truyền bị gián đoạn cần đăng nhập lại !'); return; }

	if (n[1] == "8") { alert(n[2]); document.getElementById('luu').disabled = false; return; }
	// document.getElementById('ketqualuu').innerHTML=""; 
	document.getElementById('idgoi').value = n[1];
	if (n[2] != '') document.getElementById('sochungtu').value = n[2];

	var timet

	document.getElementById('luu').value = "Cập Nhập";
	clearTimeout(timet);
	// document.getElementById('khoa').click() ;
	dakhoa = true;
	khoaphieu();
	// timet=setTimeout( function daluuxong() { setlailuu('1') },900);

}

function xuly8() {
	tam = document.getElementById('ketqualuu').innerHTML;
	var n = tam.split("*tb#");
	alert(n[1]);
	document.getElementById('ketqualuu').innerHTML = "";
}

function xuly5() {
	tam = document.getElementById('ketqualuu').innerHTML;
	var n = tam.split("*loi#");

	if (n[1] != "" && n.length > 1) { alert(n[1]); return; }

	document.getElementById('luu').disabled = false;
	document.getElementById('khoa').disabled = false;
	document.getElementById('huyphieu').disabled = false;
	document.getElementById('inan').disabled = "";
	document.getElementById('timk').click();
}

function goiphuchoi(p, n) {
	sp = document.getElementById('idgoi').value;
	if (n.length < 30) { alert('Bạn chưa ghi chú cụ thể vui lòng ghi rỏ lý do phục hồi vào phần ghi chú ! '); return; }
	if (sp != p) return;
	var tt = 0;
	var cf = " Bạn có chắc chắn muốn phục hồi phiếu này hay không ? ";
	if (thongbao(cf) == true) {

		poststr = "DATA=" + encodeURIComponent(sp) + "*@!" + encodeURIComponent("nx") + "*@!" + encodeURIComponent(tt) + "*@!" + encodeURIComponent(n);
		loadtrang('ketqualuu', "xuatkhophuchoi", poststr, "xuly5");

	}

}

function chuyenchuoithanhmang(chuoi) {
	var result = [];
	var tam = chuoi.split("|@|");
	for (var i = 0; i < tam.length; i++) {
		var el = tam[i];
		var tam2 = el.split("|*|");
		result.push(tam2.splice(1, tam2.length));
	}
	return result;

}
function phuchoibandau() {

	mangsp = chuyenchuoithanhmang(localStorage.getItem("mangbd"));
	xuatsp();
}

function setmua3tang1() {
	var tt = kiemtra50;

	kiemtra50 = false;

	// 	localStorage.setItem("mangbd", JSON.stringify(mangthanhchuoi(mangsp))); 
	var a = new Array();
	var tam = mangsp;
	var k = 0;

	for (x in tam) {
		for (i = 1; i <= tam[x][2]; i++) {
			so = 1 * tam[x][3];

			if (tam[x][4] * 1 == 0 && so >= 1000) {
				a.push([x, so]);
				k++;
			}
		}
	}
	//============ sap xep ====================================================	
	a.sort(sortFunction);
	function sortFunction(a, b) {
		if (a[1] == b[1]) {
			return 0;
		}
		else {
			return (a[1] > b[1]) ? -1 : 1;
		}
	}
	//=============tim vi tri set giam =======================================
	i = 0; var j = 0; var mang = new Array();
	var idtruoc = 0;
	for (t in a) {
		i++;

		if (i == 4) {
			if (a[t][0] == idtruoc) {
				for (key in mang) {
					if (mang[key][0] == idtruoc) {
						ck = mang[key][1] + 100;
						mang[key] = [a[t][0], ck]
					}
				}
			} else {
				mang[j] = [a[t][0], 100];
			}
			idtruoc = a[t][0];
			i = 0; j++;
		}
	}
	//==========================================================================
	for (t in mang) {
		// alert( mangsp[mang[t][0]][2] + '  ' + mang[t][1] );
		mangsp[mang[t][0]][4] = mang[t][1] / mangsp[mang[t][0]][2];
	}
	xuatsp();
	kiemtra50 = tt;
}

function set25giam1015() {

	// 	localStorage.setItem("mangbd", JSON.stringify(mangthanhchuoi(mangsp))); 
	var a = new Array();
	var tam = mangsp;
	var k = 0;

	for (x in tam) {
		for (i = 1; i <= tam[x][2]; i++) {
			so = 1 * tam[x][3];

			if (tam[x][4] * 1 == 0 && so >= 70000) {
				a.push([x, so]);
				k++;
			}
		}

	}
	//============ sap xep ====================================================	
	a.sort(sortFunction);
	function sortFunction(a, b) {
		if (a[1] == b[1]) {
			return 0;
		}
		else {
			return (a[1] > b[1]) ? -1 : 1;
		}
	}

	//============== Bốc tách điều kiện % giảm giá =============////
	if (Object.keys(a).length >= 2 && Object.keys(a).length < 5 && thuhangkhach != 1) {
		var phantramchietkhau = 10
	} else if (Object.keys(a).length >= 5 || (Object.keys(a).length >= 2 && thuhangkhach == 1)) {
		var phantramchietkhau = 15;
	}
	else { var phantramchietkhau = 0; }


	//=============tim vi tri set giam =======================================
	var j = 0; var mang = new Array(); var idtruoc = 0;
	for (t in a) {
		if (a[t][0] == idtruoc) {
			for (key in mang) {
				if (mang[key][0] == idtruoc) {
					ck = mang[key][1] + phantramchietkhau;
					mang[key] = [a[t][0], ck]
				}
			}
		} else {
			mang[j] = [a[t][0], phantramchietkhau];
		}
		idtruoc = a[t][0];
		j++;

	}
	//==========================================================================
	for (t in mang) {
		// alert( mangsp[mang[t][0]][2] + '  ' + mang[t][1] );
		mangsp[mang[t][0]][4] = mang[t][1] / mangsp[mang[t][0]][2];
	}
	xuatsp();
	kiemtra50 = tt;
}


function setmuantang1(n) {
	var tt = kiemtra50;

	kiemtra50 = false;

	// 	localStorage.setItem("mangbd", JSON.stringify(mangthanhchuoi(mangsp))); 
	var a = new Array();
	var tam = mangsp;
	var k = 0;

	for (x in tam) {
		for (i = 1; i <= tam[x][2]; i++) {
			so = 1 * tam[x][3];

			if (tam[x][4] * 1 == 0 && so >= 1000) {
				a.push([x, so]);
				k++;
			}
		}
	}
	//============ sap xep ====================================================	
	a.sort(sortFunction);
	function sortFunction(a, b) {
		if (a[1] == b[1]) {
			return 0;
		}
		else {
			return (a[1] > b[1]) ? -1 : 1;
		}
	}
	//=============tim vi tri set giam =======================================
	i = 0; var j = 0; var mang = new Array();
	var idtruoc = 0;
	for (t in a) {
		i++;

		if (i == n) {
			if (a[t][0] == idtruoc) {
				for (key in mang) {
					if (mang[key][0] == idtruoc) {
						ck = mang[key][1] + 100;
						mang[key] = [a[t][0], ck]
					}
				}
			} else {
				mang[j] = [a[t][0], 100];
			}
			idtruoc = a[t][0];
			i = 0; j++;
		}
	}
	//==========================================================================
	for (t in mang) {
		// alert( mangsp[mang[t][0]][2] + '  ' + mang[t][1] );
		mangsp[mang[t][0]][4] = mang[t][1] / mangsp[mang[t][0]][2];
	}
	xuatsp();
	kiemtra50 = tt;
}
//=================================================================================
function set12k() {
	// 	localStorage.setItem("mangbd", JSON.stringify(mangthanhchuoi(mangsp))); 
	var a = new Array();
	var tam = mangsp;
	var k = 0;
	for (x in tam) {
		for (i = 1; i <= tam[x][2]; i++) {
			so = 1 * tam[x][3];
			if (tam[x][9] == '12k') {
				a.push([x, so]);
				k++;
			}
		}
	}
	//============ sap xep ====================================================	
	a.sort(sortFunction);
	function sortFunction(a, b) {
		if (a[1] == b[1]) {
			return 0;
		}
		else {
			return (a[1] > b[1]) ? -1 : 1;
		}
	}
	//=============tim vi tri set giam =======================================
	i = 0; var j = 0; var macu = ''; var mang = new Array(); var tongtiengiam = 0; var tongtiengoc = 0; k = 0; var soluong = 0; var giasp = 0;
	for (t in a) {
		i++; //k=Math.floor(mangsp[a[t][0]][2]/2) ; alert(k) ; 
		if (macu != mangsp[a[t][0]][0]) {
			soluong = 1;  //alert('111')
			macu = mangsp[a[t][0]][0];
			if (i == 2) {   //    mang[j]=[a[t][0],((mangsp[a[t][0]][3]-12000)/mangsp[a[t][0]][3])*100];i=0; j++;   
				i = 0; j++;
				tongtiengiam = 12000; tongtiengoc = 0;
				k = (tongtiengoc - tongtiengiam) / tongtiengoc * 100;
				mang[j] = [a[t][0], k];
			}
			else {
				tongtiengiam = 0;
				tongtiengoc = mangsp[a[t][0]][3] * 1;;   //k =  (tongtiengoc-tongtiengiam)/tongtiengoc*100 ; // alert(tongtiengiam +'='+ k) ;
				// alert(1*mangsp[a[t][0]][3])
			}
		}
		else {
			soluong++;
			if (i == 2) {   //    mang[j]=[a[t][0],((mangsp[a[t][0]][3]-12000)/mangsp[a[t][0]][3])*100];i=0; j++;   
				i = 0;
				tongtiengiam += 12000;   // tongtiengoc += 1*mangsp[a[t][0]][3]  ;   
				k = (tongtiengoc - tongtiengiam) / tongtiengoc * 100;
				mang[j] = [a[t][0], k];
			}
			else {
				//	tongtiengiam +=  0 ;   

				tongtiengoc += 1 * mangsp[a[t][0]][3];
				//	k =  (tongtiengoc-tongtiengiam)/tongtiengoc*100 ;
			}
		}
		giasp = (1 * tongtiengoc + 1 * tongtiengiam) / soluong;
		k = (1 * mangsp[a[t][0]][3] - giasp) / mangsp[a[t][0]][3] * 100;


		// alert(tongtiengoc + "=" +tongtiengiam )
		mang[j] = [a[t][0], k]
		// alert(mang[j]);
		//  alert(tongtiengoc + "=" + tongtiengiam) ;   




	}


	//==========================================================================
	for (t in mang) {
		// alert( mangsp[mang[t][0]][3]) 
		// (k-tongtiengiam)/k*100 
		//  mangsp[mang[t][0]][4] =  mang[t][1] /   mangsp[mang[t][0]][2] ;
		mangsp[mang[t][0]][4] = mang[t][1];
	}
	xuatsp();

}

//==========================================================================
function giamgiatudong(dieukienvc) {
	var a = new Array();
	var macu = '';
	// var mavoucher = document.getElementById("makm").value;
	var prodarray = mangsp1;
	var dieukien = dieukienvc.split("#");
	if (dieukien[1] == "DKG") {
		//0   1   2   3
		//  #DKG#SP2#G50#
		var SLsanpham = parseInt(dieukien[2].slice(2, 3));
		var apdungcho = dieukien[2];
		var chietkhau = dieukien[3].slice(1, dieukien[3].length);
		if (apdungcho == "SP2" || apdungcho == "SP1") {
			//Điều kiện mảng sp phải >= 2
			// if (Object.keys(prodarray).length >= SLsanpham) {
			for (x in prodarray) {
				for (i = 1; i <= prodarray[x][2]; i++) {
					so = 1 * prodarray[x][3];

					if (prodarray[x][4] * 1 == 0 && so >= 70000) {
						a.push([x, so]);
					}
				}
			}
			//============ sap xep ====================================================	
			a.sort(sortFunction);
			function sortFunction(a, b) {
				if (a[1] == b[1]) {
					return 0;
				} else {
					return (a[1] > b[1]) ? -1 : 1;
				}
			}
			//=============tim vi tri set giam =======================================
			i = 1; var j = 0; var mang = new Array();
			for (t in a) {
				if (i == SLsanpham && Object.keys(a).length >= SLsanpham) {
					mang[j] = [a[t][0], parseInt(chietkhau)];
				} else {
					mang[j] = [a[t][0], 0];
				}
				i++; j++;
			}
			//==========================================================================
			//Tính lại % của sản phẩm được giảm giá
			for (t in mang) {
				if (mangsp[mang[t][0]][0] == macu) {
					mang[t][1] = parseInt(mang[t][1]) + parseInt(mang[t - 1][1]);
				} else {
					//mang[t][1] = mang[t][1]; 
					macu = mangsp[mang[t][0]][0];
				}
				mangsp[mang[t][0]][4] = mang[t][1] / mangsp[mang[t][0]][2];
			}
			xuatsp();
			// }
		} else if (apdungcho == "SP2T") {
			//Điều kiện mảng sp phải >= 2
			// if (Object.keys(prodarray).length >= SLsanpham) {
			j = 0;
			for (x in prodarray) {
				for (i = 1; i <= prodarray[x][2]; i++) {
					so = 1 * prodarray[x][3];

					if (prodarray[x][4] * 1 == 0 && so >= 70000) {
						a.push([x, so]);
					}
				}
			}

			//============ sap xep ====================================================	
			a.sort(sortFunction);
			function sortFunction(a, b) {
				if (a[1] == b[1]) {
					return 0;
				} else {
					return (a[1] > b[1]) ? -1 : 1;
				}
			}

			//=============tim vi tri set giam =======================================
			j = 0; i = 0; var mang = new Array();
			for (t in a) {
				i++;
				if (i == 2) { mang[j] = [a[t][0], parseInt(chietkhau)]; j++; }
				else { mang[j] = [a[t][0], 0]; j++; }
			}
			//==========================================================================
			//Tính lại % của sản phẩm được giảm giá
			for (t in mang) {
				if (mangsp[mang[t][0]][0] == macu) {
					mang[t][1] = parseInt(mang[t][1]) + parseInt(mang[t - 1][1]);
				} else {
					//mang[t][1] = mang[t][1]; 
					macu = mangsp[mang[t][0]][0];
				}
				mangsp[mang[t][0]][4] = mang[t][1] / mangsp[mang[t][0]][2];
			}
			xuatsp();
			// }
		}
	} else if (dieukien[1] == "GVC") {
		//0   1    2   3   4  5   6   
		//  #GVC#50000#DK#gia#>#70000#
		var sotiengiam = parseInt(dieukien[2]);
		var loaidieukien = dieukien[4];
		var sotienapdung = parseInt(dieukien[6]);
		var thoadieukien = false;
		if (loaidieukien == "gia") {
			var sanphamcaonhat = 0;
			for (x in prodarray) {
				var so = parseInt(prodarray[x][3]);
				if ((prodarray[x][4] * 1 == 0 && so >= sotienapdung) && so > sanphamcaonhat) {
					var thoadieukien = true;
					sanphamcaonhat = so;
				}
			}

			if (thoadieukien && sanphamcaonhat >= sotienapdung) {
				document.getElementById("bot").value = sotiengiam;
				document.getElementById("khachdua").value = 0;
			} else {
				document.getElementById("khachdua").value = 0;
				document.getElementById("bot").value = 0;
			}
		}
		xuatsp();
	} else if (dieukien[1] == "GPT") {
		//0  1  2  3   4  5  6   7  8
		// #GPT#10#DK#gia#>#1000#SL#2#
		if (dieukien[4] == "gia") {
			// if ()
			var apdungcho = dieukien[7];
			var SLsanpham = parseInt(dieukien[8]);
			var giatienapdung = parseInt(dieukien[6]);
			var chietkhau = parseInt(dieukien[2]);
			if (apdungcho == "SL") {
				//Điều kiện mảng sp phải >= 2 và 2 SP phải có ct khuyến mãi < 10%
				// if (Object.keys(prodarray).length >= SLsanpham) {
				for (x in prodarray) {
					// mangsp[x][4] = 0;

					for (i = 1; i <= prodarray[x][2]; i++) {
						so = 1 * prodarray[x][3];

						if ((prodarray[x][4] * 1) == 0 && so >= giatienapdung) {
							a.push([x, so]);
						}
					}
				}
				//============ sap xep ====================================================	
				a.sort(sortFunction);
				function sortFunction(a, b) {
					if (a[1] == b[1]) {
						return 0;
					} else {
						return (a[1] > b[1]) ? -1 : 1;
					}
				}
				//=============tim vi tri set giam =======================================
				i = 0; var j = 0; var mang = new Array();
				for (t in a) {
					if (i < SLsanpham && Object.keys(a).length >= SLsanpham) {
						mang[j] = [a[t][0], parseInt(chietkhau)];
						i++;
					} else {
						mang[j] = [a[t][0], 0];
					}
					j++;
				}
				//==========================================================================
				//Tính lại % của sản phẩm được giảm giá
				for (t in mang) {
					if (mangsp[mang[t][0]][0] == macu) {
						mang[t][1] = parseInt(mang[t][1]) + parseInt(mang[t - 1][1]);
					} else {
						//mang[t][1] = mang[t][1]; 
						macu = mangsp[mang[t][0]][0];
					}
					mangsp[mang[t][0]][4] = mang[t][1] / mangsp[mang[t][0]][2];
				}
				xuatsp();
			}
		}
	}
	// console.log(mangsp1);
}

function setmua2tang1() {
	localStorage.setItem("mangbd", JSON.stringify(mangthanhchuoi(mangsp)));
	var a = new Array();
	var tam = mangsp;
	var k = 0;
	for (x in tam) {
		for (i = 1; i <= tam[x][2]; i++) {
			so = 1 * tam[x][3];
			if (tam[x][4] * 1 == 0 && so >= 70000) {
				a.push([x, so]);
				k++;
			}
		}
	}
	//============ sap xep ====================================================	
	a.sort(sortFunction);
	function sortFunction(a, b) {
		if (a[1] == b[1]) {
			return 0;
		}
		else {
			return (a[1] > b[1]) ? -1 : 1;
		}
	}
	//=============tim vi tri set giam =======================================
	i = 0; var j = 0; var mang = new Array();
	for (t in a) {
		i++;

		if (i == 3) { mang[j] = [a[t][0], 100]; i = 0; j++; }
	}
	//==========================================================================
	for (t in mang) {
		// alert( mangsp[mang[t][0]][2] + '  ' + mang[t][1] );
		mangsp[mang[t][0]][4] = mang[t][1] / mangsp[mang[t][0]][2];
	}
	xuatsp();
}


function setmua2giam70() {
	localStorage.setItem("mangbd", JSON.stringify(mangthanhchuoi(mangsp)));
	var a = new Array();
	var tam = mangsp; var macu = ''; var tongck = 0;
	var k = 0;
	for (x in tam) {
		for (i = 1; i <= tam[x][2]; i++) {
			so = 1 * tam[x][3];

			if (tam[x][4] * 1 == 0 && so >= 70000) {
				a.push([x, so]);
				k++;
			}
		}
	}
	//============ sap xep ====================================================	
	a.sort(sortFunction);
	function sortFunction(a, b) {
		if (a[1] == b[1]) {
			return 0;
		}
		else {
			return (a[1] > b[1]) ? -1 : 1;
		}
	}
	//=============tim vi tri set giam =======================================
	i = 0; var j = 0; var mang = new Array();
	var idtruoc;
	for (t in a) {
		i++;

		if (i == 3) {

			if (a[t][0] == idtruoc) {
				for (key in mang) {
					if (mang[key][0] == idtruoc) {
						ck = mang[key][1] + 70;
						mang[key] = [a[t][0], ck]
					}
				}
			} else {
				mang[j] = [a[t][0], 70];
			}

			idtruoc = a[t][0];
			i = 0; j++;
		}
	}
	//==========================================================================
	for (t in mang) {
		if (mangsp[mang[t][0]][0] == macu) { tongck += mang[t][1]; } else { tongck = mang[t][1]; macu = mangsp[mang[t][0]][0]; }
		mangsp[mang[t][0]][4] = mang[t][1] / mangsp[mang[t][0]][2];
	}
	xuatsp();
}

function setmuaNgiamM(n, m)  // mua n sp giảm m%
{
	localStorage.setItem("mangbd", JSON.stringify(mangthanhchuoi(mangsp)));
	var a = new Array();
	var tam = mangsp; var macu = ''; var tongck = 0;
	var k = 0;
	for (x in tam) {
		for (i = 1; i <= tam[x][2]; i++) {
			so = 1 * tam[x][3];

			if (tam[x][4] * 1 == 0 && so >= 100) {
				a.push([x, so]);
				k++;
			}
		}
	}
	//============ sap xep ====================================================	
	a.sort(sortFunction);
	function sortFunction(a, b) {
		if (a[1] == b[1]) {
			return 0;
		}
		else {
			return (a[1] > b[1]) ? -1 : 1;
		}
	}
	//=============tim vi tri set giam =======================================
	i = 0; var j = 0; var mang = new Array();
	for (t in a) {
		i++;
		if (i == n) { mang[j] = [a[t][0], m]; i = 0; j++; break; }
	}
	//==========================================================================
	for (t in mang) {
		if (mangsp[mang[t][0]][0] == macu) { tongck += mang[t][1]; } else { tongck = mang[t][1]; macu = mangsp[mang[t][0]][0]; }
		mangsp[mang[t][0]][4] = mang[t][1] / mangsp[mang[t][0]][2];
	}
	xuatsp();
}


function setmuaNgiamMn(n, m)  // mua n sp giảm m%
{
	localStorage.setItem("mangbd", JSON.stringify(mangthanhchuoi(mangsp)));
	var a = new Array();
	var tam = mangsp; var macu = ''; var tongck = 0;
	var k = 0;
	for (x in tam) {
		for (i = 1; i <= tam[x][2]; i++) {
			so = 1 * tam[x][3];

			if (tam[x][4] * 1 == 0 && so >= 100) {
				a.push([x, so]);
				k++;
			}
		}
	}
	//============ sap xep ====================================================	
	a.sort(sortFunction);
	function sortFunction(a, b) {
		if (a[1] == b[1]) {
			return 0;
		}
		else {
			return (a[1] > b[1]) ? -1 : 1;
		}
	}
	//=============tim vi tri set giam =======================================
	i = 0; var j = 0; var mang = new Array();
	var idtruoc = 0;
	for (t in a) {
		i++;
		if (i == n) {

			if (a[t][0] == idtruoc) {
				for (key in mang) {
					if (mang[key][0] == idtruoc) {
						ck = mang[key][1] + m;
						mang[key] = [a[t][0], ck]
					}
				}
			} else {
				mang[j] = [a[t][0], m];
			}

			idtruoc = a[t][0];
			i = 0; j++;
		}
	}
	//==========================================================================
	for (t in mang) {
		if (mangsp[mang[t][0]][0] == macu) { tongck += mang[t][1]; } else { tongck = mang[t][1]; macu = mangsp[mang[t][0]][0]; }
		mangsp[mang[t][0]][4] = mang[t][1] / mangsp[mang[t][0]][2];
	}
	xuatsp();
}
function setmuaNgiamSP(n, m)  // mua n sp giảm còn m
{
	localStorage.setItem("mangbd", JSON.stringify(mangthanhchuoi(mangsp)));
	var a = new Array();
	var tam = mangsp; var macu = ''; var tongck = 0;
	var k = 0;
	for (x in tam) {
		for (i = 1; i <= tam[x][2]; i++) {
			so = 1 * tam[x][3];

			if (tam[x][4] * 1 == 0 && so >= m) {
				a.push([x, so]);
				k++;
			}
		}
	}


	//============ sap xep ====================================================	
	a.sort(sortFunction);
	function sortFunction(a, b) {
		if (a[1] == b[1]) {
			return 0;
		}
		else {
			return (a[1] > b[1]) ? -1 : 1;
		}
	}
	// console.log(a);
	//=============tim vi tri set giam =======================================
	i = 0; var j = 0; var mang = new Array();
	var idtruoc = 0;
	for (t in a) {
		i++;
		if (i == n) {

			if (a[t][0] == idtruoc) {
				for (key in mang) {
					if (mang[key][0] == idtruoc) {
						tienck = a[t][1] - m;
						ck = mang[key][1] + tienck;
						mang[key] = [a[t][0], ck]
					}
				}
			} else {
				mang[j] = [a[t][0], a[t][1] - m];
			}
			idtruoc = a[t][0];
			i = 0;
			j++;
		}
	}
	// console.log(mang);
	//==========================================================================
	for (t in mang) {
		if (mangsp[mang[t][0]][0] == macu) {
			tongck += mang[t][1];
		} else {
			tongck = mang[t][1]; macu = mangsp[mang[t][0]][0];
		}
		var ptchietkhau = (Math.floor((mang[t][1] / (mangsp[mang[t][0]][3] * mangsp[mang[t][0]][2])) * 100 * 100) / 100).toFixed(3);
		mangsp[mang[t][0]][4] = ptchietkhau;//((mang[t][1]/(mangsp[mang[t][0]][3]*mangsp[mang[t][0]][2]))*100).toFixed(3);
	}
	xuatsp();
	//	console.log(mangsp);
}
function setmuaNgiamSP2(n, m)  // mua n sp giảm còn m
{
	localStorage.setItem("mangbd", JSON.stringify(mangthanhchuoi(mangsp)));
	var a = new Array();
	var tam = mangsp; var macu = ''; var tongck = 0;
	var k = 0;
	for (x in tam) {
		for (i = 1; i <= tam[x][2]; i++) {
			so = 1 * tam[x][3];

			if (tam[x][4] * 1 == 0 && so >= m) {
				a.push([x, so]);
				k++;
			}
		}
	}
	//============ sap xep ====================================================	
	a.sort(sortFunction);
	function sortFunction(a, b) {
		if (a[1] == b[1]) {
			return 0;
		}
		else {
			return (a[1] > b[1]) ? -1 : 1;
		}
	}
	//=============tim vi tri set giam =======================================
	i = 0; var j = 0; var mang = new Array();
	for (t in a) {
		i++;
		if (i == n) { mang[j] = [a[t][0], m]; i = 0; j++; }
	}
	//==========================================================================
	for (t in mang) {
		if (mangsp[mang[t][0]][0] == macu) {
			tongck += mang[t][1];
		} else {
			tongck = mang[t][1]; macu = mangsp[mang[t][0]][0];
		}
		mangsp[mang[t][0]][4] = Number((100 - (mang[t][1] / mangsp[mang[t][0]][3]) * 100) / mangsp[mang[t][0]][2]).toFixed(2);
	}
	xuatsp();
}



function setmuaNgiamSP4(n, m)  // mua n sp giảm m%
{
	localStorage.setItem("mangbd", JSON.stringify(mangthanhchuoi(mangsp)));
	var a = new Array();
	var tam = mangsp; var macu = ''; var tongck = 0;
	var k = 0, pt = 0;
	for (x in tam) {
		for (i = 1; i <= tam[x][2]; i++) {
			so = 1 * tam[x][3];

			if (tam[x][4] * 1 == 0 && so >= m) {
				a.push([x, so]);
				k++;
			}
		}
	}
	//============ sap xep ====================================================	
	a.sort(sortFunction);
	function sortFunction(a, b) {
		if (a[1] == b[1]) {
			return 0;
		}
		else {
			return (a[1] > b[1]) ? -1 : 1;
		}
	}
	//=============tim vi tri set giam =======================================
	i = 0; var j = 0; var mang = new Array();
	for (t in a) {
		i++;
		// console.log(a[t]);
		// alert(a[t][1])
		pt = Number((100 - m * 100 / a[t][1]), 2).toFixed(2);
		if (i == n) { mang[j] = [a[t][0], pt]; i = 0; j++; }
	}
	//==========================================================================
	for (t in mang) {
		if (mangsp[mang[t][0]][0] == macu) { tongck += mang[t][1]; } else { tongck = mang[t][1]; macu = mangsp[mang[t][0]][0]; }
		mangsp[mang[t][0]][4] = Number(mang[t][1] / mangsp[mang[t][0]][2]).toFixed(2);
	}
	xuatsp();
}

// function setkhuyenmai34(loai, p1, p2) {
// 	var t1, t2;
// 	if (loai == '34') { t1 = 2; t2 = 3}

// 	//localStorage.setItem("mang1", JSON.stringify(mangsp)); // mang san pham dang hiển thị lưu lại
// 	//mangbd=mangthanhchuoi(mangsp);
// 	localStorage.setItem("mangbd", JSON.stringify(mangthanhchuoi(mangsp)));

// 	var a = new Array();
// 	var tam = mangsp; var macu = ''; var tongck = 0;
// 	var k = 0;

// 	for (x in tam) {
// 		for (i = 1; i <= tam[x][2]; i++) {
// 			so = 1 * tam[x][3];
// 			if (tam[x][4] * 1 == 0 && so > 1) {
// 				a.push([x, so]);
// 				k++;
// 			}
// 		}
// 	}
// 	//============ sap xep ====================================================	
// 	a.sort(sortFunction);
// 	function sortFunction(a, b) {
// 		if (a[1] == b[1]) {
// 			return 0;
// 		}
// 		else {
// 			return (a[1] > b[1]) ? -1 : 1;
// 		}
// 	}
// 	//=============tim vi tri set giam =======================================
// 	i = 0; var j = 0; var mang = new Array();
// 	// var idtruoc = 0;
// 	for (t in a) {
// 		i++;
// 		if (i == t1) {
// 			mang[j] = [a[t][0], p1];
// 		} else if (i == t2) {
// 			mang[j] = [a[t][0], p2];
// 		}
// 	}
// 	//==========================================================================
// 	for (t in mang) {
// 		//  alert(  mangsp[mang[t][0]][0]  + '===' + macu ); 
// 		if (mangsp[mang[t][0]][0] == macu) { 
// 			tongck += mang[t][1]; 
// 		} else { 
// 			tongck = mang[t][1]; macu = mangsp[mang[t][0]][0]; 
// 		}
// 		mangsp[mang[t][0]][4] = tongck / mangsp[mang[t][0]][2];
// 	}


// 	xuatsp();
// }


function ctrinh_sinhvien() {
	var makm = document.getElementById("makm").value;
	if (makm == "") {
		for (const key in mangsp) {
			var sotiensp = parseInt(mangsp[key][3]);
			var cksp = parseInt(mangsp[key][4]);
			// var slsp = parseInt(mangsp[key][2]);
			if (sotiensp > 70000 && cksp == 0) {
				mangsp[key][4] = 15;
			}
		}
		xuatsp();
	} else {
		alert("Không thể áp dụng 1 lúc 2 chương trình khuyến mãi!!");
	}
}

function giamtructiep() {
	var makm = document.getElementById("makm").value;
	var tongsotien = 0;
	if (makm == "") {
		for (const key in mangsp) {
			var sotiensp = parseInt(mangsp[key][3]);
			var cksp = parseInt(mangsp[key][4]);
			var slsp = parseInt(mangsp[key][2]);
			if (sotiensp > 1000 && cksp == 0) {
				tongsotien += (sotiensp * slsp)
			}
		}

		if (tongsotien >= 300000 && tongsotien < 500000) {
			document.getElementById("bot").value = 30000;
		} else if (tongsotien >= 500000 && tongsotien < 1000000) {
			document.getElementById("bot").value = 60000;
		} else if (tongsotien >= 1000000) {
			document.getElementById("bot").value = 150000;
		}

	} else {
		alert("Không thể áp dụng 1 lúc 2 chương trình khuyến mãi!!");
	}
}


function setkhuyenmai(loai, p1, p2, p3) {
	var t1, t2, t3;
	if (loai == '234') { t1 = 2; t2 = 3; t3 = 4; }
	else if (loai == '345') { t1 = 3; t2 = 4; t3 = 5; }

	//localStorage.setItem("mang1", JSON.stringify(mangsp)); // mang san pham dang hiển thị lưu lại
	//mangbd=mangthanhchuoi(mangsp);
	localStorage.setItem("mangbd", JSON.stringify(mangthanhchuoi(mangsp)));

	var a = new Array();
	var tam = mangsp; var macu = ''; var tongck = 0;
	var k = 0;

	for (x in tam) {
		for (i = 1; i <= tam[x][2]; i++) {
			so = 1 * tam[x][3];
			if (tam[x][4] * 1 == 0 && so > 1) {
				a.push([x, so]);
				k++;
			}
		}
	}
	//============ sap xep ====================================================	
	a.sort(sortFunction);
	function sortFunction(a, b) {
		if (a[1] == b[1]) {
			return 0;
		}
		else {
			return (a[1] > b[1]) ? -1 : 1;
		}
	}
	//=============tim vi tri set giam =======================================
	i = 0; var j = 0; var mang = new Array();
	// var idtruoc = 0;
	for (t in a) {
		i++;
		if (i == t1) {
			mang[j] = [a[t][0], parseInt(p1)];
		} else if (i == t2) {
			mang[j] = [a[t][0], parseInt(p2)];
		} else if (i == t3) {
			mang[j] = [a[t][0], parseInt(p3)];
			i = 0; j++;
		}
	}
	console.log(mang);
	//==========================================================================
	for (t in mang) {
		//  alert(  mangsp[mang[t][0]][0]  + '===' + macu ); 
		if (mangsp[mang[t][0]][0] == macu) { tongck += mang[t][1]; } else { tongck = mang[t][1]; macu = mangsp[mang[t][0]][0]; }
		mangsp[mang[t][0]][4] = tongck / mangsp[mang[t][0]][2];
	}


	xuatsp();
}

function set24giam34() {

	localStorage.setItem("mangbd", JSON.stringify(mangthanhchuoi(mangsp)));

	var a = new Array();
	var tam = mangsp1; var macu = ''; var tongck = 0;
	var k = 0;

	for (x in tam) {
		for (i = 1; i <= tam[x][2]; i++) {
			so = 1 * tam[x][3];
			if (tam[x][4] * 1 == 0 && so > 1) {
				a.push([x, so]);
				k++;
			}
		}
	}
	// console.log(a);
	//============ sap xep ====================================================	
	a.sort(sortFunction);
	function sortFunction(a, b) {
		if (a[1] == b[1]) {
			return 0;
		}
		else {
			return (a[1] < b[1]) ? -1 : 1;
		}
	}
	//=============tim vi tri set giam =======================================
	i = 0; var j = 0; var mang = new Array();

	for (t in a) {
		i++;

		var soluongsp = parseInt(Object.keys(a).length);
		var solangiam = soluongsp / 4;
		var solangiam40 = Math.floor(solangiam);
		var solangiam20 = Math.round(solangiam);

		if (i <= solangiam40) {
			mang[j] = [a[t][0], 40];
		} else if (i <= (solangiam20 + solangiam40)) {
			mang[j] = [a[t][0], 20];
		}
		j++;
	}
	// console.log(mang);
	//==========================================================================
	for (t in mang) {
		if (mangsp[mang[t][0]][0] == macu) {
			tongck += mang[t][1];
		} else {
			tongck = mang[t][1]; macu = mangsp[mang[t][0]][0];
		}
		mangsp[mang[t][0]][4] = tongck / mangsp[mang[t][0]][2];
	}

	xuatsp();
}


function set2chuongtrinh(sosp, v1, v2, g1, g2) {  // vi trí : ví dụ 23

	localStorage.setItem("mangbd", JSON.stringify(mangthanhchuoi(mangsp)));

	var a = new Array();
	var tam = mangsp1; var macu = ''; var tongck = 0;
	var k = 0;

	for (x in tam) {
		for (i = 1; i <= tam[x][2]; i++) {
			so = 1 * tam[x][3];
			if (tam[x][4] * 1 == 0 && so > 1) {
				a.push([x, so]);
				k++;
			}
		}
	}
	// console.log(a);
	//============ sap xep ====================================================	
	a.sort(sortFunction);
	function sortFunction(a, b) {
		if (a[1] == b[1]) {
			return 0;
		}
		else {
			return (a[1] < b[1]) ? -1 : 1;
		}
	}
	//=============tim vi tri set giam =======================================
	i = 0; var j = 0; var mang = new Array();

	for (t in a) {
		i++;

		var soluongsp = parseInt(Object.keys(a).length);
		var solangiam = soluongsp / sosp;
		var solangiamv2 = Math.floor(solangiam);
		var solangiamv1 = Math.round(solangiam);

		if (i <= solangiamv2) {
			mang[j] = [a[t][0], g2];
		} else if (i <= (solangiamv1 + solangiamv2)) {
			mang[j] = [a[t][0], g1];
		}
		j++;
	}
	// console.log(mang);
	//==========================================================================
	for (t in mang) {
		if (mangsp[mang[t][0]][0] == macu) {
			tongck += mang[t][1];
		} else {
			tongck = mang[t][1]; macu = mangsp[mang[t][0]][0];
		}
		mangsp[mang[t][0]][4] = tongck / mangsp[mang[t][0]][2];
	}

	xuatsp();
}

function setcungluc(loai, p1, p2, p3) {
	var t1, t2, t3;
	if (loai == '234') { t1 = 2; t2 = 3; t3 = 4; alert(t2) }
	else if (loai == '345') { t1 = 3; t2 = 4; t3 = 5; }
	else if (loai == '123') { t1 = 1; t2 = 2; t3 = 3; }
	//localStorage.setItem("mang1", JSON.stringify(mangsp)); // mang san pham dang hiển thị lưu lại
	//mangbd=mangthanhchuoi(mangsp);
	localStorage.setItem("mangbd", JSON.stringify(mangthanhchuoi(mangsp)));

	var a = new Array();
	var tam = mangsp; var macu = ''; var tongck = 0;
	var k = 0;

	for (x in tam) {
		for (i = 1; i <= tam[x][2]; i++) {
			so = 1 * tam[x][3];
			if (tam[x][4] * 1 == 0 && so > 1) {
				a.push([x, so]);
				k++;
			}
		}
	}
	console.log(a);
	//============ sap xep ====================================================	
	a.sort(sortFunction);
	function sortFunction(a, b) {
		if (a[1] == b[1]) {
			return 0;
		}
		else {
			return (a[1] > b[1]) ? -1 : 1;
		}
	}
	//=============tim vi tri set giam =======================================
	i = 0; var j = 0; var mang = new Array();
	// var idtruoc = 0;
	for (t in a) {
		i++;
		if (i == t1) {
			mang[j] = [a[t][0], parseInt(p1)];
		} else if (i == t2) {
			mang[j] = [a[t][0], parseInt(p2)];
		} else if (i == t3) {
			mang[j] = [a[t][0], parseInt(p3)];
			i = 0;
		}
		j++;
	}
	console.log(mang);
	//==========================================================================
	for (t in mang) {
		if (mangsp[mang[t][0]][0] == macu) {
			tongck += mang[t][1];
		} else {
			tongck = mang[t][1]; macu = mangsp[mang[t][0]][0];
		}
		mangsp[mang[t][0]][4] = tongck / mangsp[mang[t][0]][2];
	}

	xuatsp();
}

function xoaphieux(sophieu) {
	var cf = " Bạn có chắc chắn muốn xóa phiếu " + sophieu + " này hay không ? ";
	var n = confirm(cf);
	if (n == true) {
		poststr = "DATA=" + encodeURIComponent(sophieu) + "*@!" + encodeURIComponent(sophieu) + "*@!" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0);
		loadtrang('ketqualuu', "xuatkhoxoa", poststr, "xuly8");
	}
}
function luuphieuxuat() {
	if (document.getElementById('luu').disabled) return;

	if (document.getElementById('nguoitao123').value == "") { doithungan(); return; }

	if (document.getElementById('online').value == "0") {
		alert("Bạn chưa chọn nhân viên tư vấn");
		document.getElementById('online').focus();
		return;
	}
	var cf = " Bạn có chắc chắn muốn khóa phiếu này hay không ? ";
	if (thongbao(cf) == true) {
		var idluu, ngayxuatkho, sochungtu, xuatkho, tigia, lydo, khachhang, ghichu, tenkhachhang, tenlydo, idgoi, khachdua, qua, diem, ido, idch, idgioithieu, idchat, lydotra, nvonline, loaithanhtoan;
		sochungtu = document.getElementById('sochungtu').value;
		tigia = document.getElementById('TiGia').value;
		lydo = document.getElementById('lydo').value;
		khachhang = document.getElementById('idkh').value;
		if (khachhang == 0 || khachhang == '') { alert('Vui lòng chọn khách hàng !'); }
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

		idgioithieu = document.getElementById('idgioithieu').value;
		idchat = trim(document.getElementById('mavandon').value);
		nvonline = trim(document.getElementById('nvonline').value);
		lydotra = document.getElementById('lydotra').value;
		loaithanhtoan = document.getElementById('loaithanhtoan').value;
		//alert(loaithanhtoan) ; return ;
		if (kiemtraphieu() == true) {
			if (lydo != 5) idch = 0;

			document.getElementById('luu').disabled = true;
			poststr = "DATA=" + idgoi + "*@!" + encodeURIComponent(mangthanhchuoi(mangsp)) + "*@!" + encodeURIComponent(sochungtu);
			poststr += "*@!" + encodeURIComponent(xuatkho) + "*@!" + encodeURIComponent(tienbot) + "*@!" + encodeURIComponent(lydo);
			poststr += "*@!" + encodeURIComponent(ido) + "*@!" + encodeURIComponent(khachhang) + "*@!" + encodeURIComponent(ghichu);
			poststr += "*@!" + encodeURIComponent(vat) + "*@!" + encodeURIComponent(0) + "*@!" + encodeURIComponent(tenkhachhang);
			poststr += "*@!" + encodeURIComponent('diachi') + "*@!" + encodeURIComponent(0) + "*@!" + encodeURIComponent(khachdua);
			poststr += "*@!" + encodeURIComponent(qua) + "*@!" + encodeURIComponent(diem) + "*@!" + encodeURIComponent(makm) + "*@!" + encodeURIComponent(idch);
			poststr += "*@!" + encodeURIComponent(idgioithieu) + "*@!" + encodeURIComponent(idchat) + "*@!" + encodeURIComponent(lydotra) + "*@!" + encodeURIComponent(nvonline) + "*@!" + encodeURIComponent(loaithanhtoan);
			loadtrang('ketqualuu', "xuatkholuu", poststr, "xuly");
		}
		return false;
	}
}
//=======================================================



function setsanpham(id, ten, ma, gia, dvt, giagia, baohanh, sl, mt, giagiam, giamgop) // baohanh => giachan
{
	if (giagia < km) giagia = km;

	document.getElementById('idsp').value = id;
	document.getElementById('tensp').value = ten;
	document.getElementById('masp').value = ma;

	document.getElementById('dongia').value = gia;
	document.getElementById('giachan').value = baohanh;
	document.getElementById('sl').value = sl;
	document.getElementById('soluong').value = 1;
	document.getElementById('sanpham').innerHTML = "";
	document.getElementById('soluong').select();
	document.getElementById('chietkhau').value = giagia;

	document.getElementById('mt').value = mt;
	document.getElementById('giagiam').value = giagiam;
	document.getElementById('ghichu').value = giamgop;

	document.getElementById('chietkhauc').value = giagia;
	document.getElementById('giamgop').value = giamgop;
	document.getElementById('codeprotk').select();
}

function timtheomacode(v) {
	v = document.getElementById('codeprotk').value;
	if (v.lenth < 3) return;
	poststr = "DATA=" + encodeURIComponent(v) + "*@!" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0);
	loadtrang('khonghienthi', "xuattimtheoma", poststr, "xuly9");
}

function layvesoluong(macode) {
	for (x in mangsp) {
		if (mangsp[x][0] == macode) return mangsp[x][2];
	}
	return 0;
}


function thaydoisoluong(macode, soluong) {
	for (x in mangsp) {
		if (mangsp[x][0] == macode) mangsp[x][2] = soluong;
	}
	xuatsp();

}



function xuly9() {

	var tam = document.getElementById('khonghienthi').innerHTML;
	//alert(tam)
	var n = tam.split("##");


	if (n[1] == "") return;
	var IDK = document.getElementById('idkho').value;
	if (n[8] <= 0 && (IDK == '1010' || IDK == '54' || IDK == '1092' || IDK == '1060')) { alert("Kiểm tra lại khi xuất bán khi số lượng <=0"); }

	n[8] = 1 + parseFloat(layvesoluong(n[3]));
	thaydoisoluong(n[3], n[8]);
	//  document.getElementById("sound_element").innerHTML= "<embed src='images/ding.wav' hidden=true autostart=true loop=false>"; 
	document.getElementById('nhac').play();
	//alert(n[6])
	var dg = n[4];
	dg = dg.replace(',', ''); dg = dg.replace(',', '');
	var giagiam = Math.round(parseFloat(dg) - parseFloat(dg) * n[6] / 100);
	setsanpham(n[1], n[2], n[3], n[4], n[5], n[6], n[9], n[8], n[11], giagiam, n[13]);
	document.getElementById('soluong').value = n[8];
	document.getElementById('codeprotk').value = '';

	//if (n[8] == 1) document.getElementById('add').click();
	document.getElementById('add').click();


}
var timer;
function goisp(v) {
	clearTimeout(timer);
	timer = setTimeout(function validate() { timtheomacode(v) }, 500);
}


function xuly2() {
	document.getElementById('search2').click();

}

function khachhangtimtheomacode(v) {
	document.getElementById('search2').click();
	//  poststr="DATA="+    encodeURIComponent(v)+  "*@!"+ encodeURIComponent(0)+  "*@!"+ encodeURIComponent(0) ;
	//  loadtrang('khonghienthi', "khachhangtimtheoma", poststr,"xuly2") ;
}

function goikh(v) {
	if (v.length != 10) return;
	clearTimeout(timer);
	timer = setTimeout(function validate() { khachhangtimtheomacode(v) }, 500);
}


function timdiachicc(id) {
	poststr = "DATA=" + encodeURIComponent(id) + "*@!" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0);
	loadtrang('diachicc', "timdiachicc", poststr, "");
}



function timbaogiachuyen(t1) {
	baogiachuyen(t1);
	timphieu();
}


function xuly6() {
	//alert(ketqua)
	tam = document.getElementById('ketqualuu').innerHTML;
	var n = tam.split("*loi#");
	if (n[1] != "" && n.length > 1) { alert(n[1]); return; }
	document.getElementById('luu').disabled = true;
	document.getElementById('khoa').disabled = true;
	document.getElementById('huyphieu').disabled = true;
	document.getElementById('inan').disabled = "";
	document.getElementById('timk').click();
	goiin();
}

function khoaphieu() {
	var tt = 0;

	var cf = " Bạn có chắc chắn muốn khóa phiếu này hay không ? ";
	if (dakhoa == true) {
		sp = document.getElementById('idgoi').value;
		poststr = "DATA=" + encodeURIComponent(sp) + "*@!" + encodeURIComponent("nx") + "*@!" + encodeURIComponent(tt) + "*@!" + encodeURIComponent(document.getElementById('chonnhanqua').checked);
		loadtrang('ketqualuu', "xuatkhokhoaphieu", poststr, "xuly6");
		dakhoa = false;
	} else

		if (thongbao(cf) == true) {
			sp = document.getElementById('idgoi').value;
			poststr = "DATA=" + encodeURIComponent(sp) + "*@!" + encodeURIComponent("nx") + "*@!" + encodeURIComponent(tt) + "*@!" + encodeURIComponent(0);
			loadtrang('ketqualuu', "xuatkhokhoaphieu", poststr, "xuly6");
			dakhoa = false;
		}
}


function timkiemncc(t1, t2, t3, t4, t5) {
	poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(t2) + "*@!" + encodeURIComponent(t3) + "*@!" + encodeURIComponent(t4);
	poststr = poststr + "*@!" + encodeURIComponent(t5) + "*@!" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0);
	loadtrang('hienthinhacc', "xuattimkh", poststr, "");

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
		loadtrang('ketqualuu', "banhanghuyphieu", poststr, "xuly7");
	}

}




function xuattimsanpham(t1, t2, t3, t4, t5, t6) {

	poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(t2) + "*@!" + encodeURIComponent(t3) + "*@!" + encodeURIComponent(t4);
	poststr = poststr + "*@!" + encodeURIComponent(t5) + "*@!" + encodeURIComponent(t6);
	loadtrang('sanpham', "xuatkhotimsp", poststr, "");

}

function setkh(t1, t2, t3, t4, t5, t6) {
	document.getElementById('tenkh').innerHTML = t2
	document.getElementById('dckh').innerHTML = t3
	document.getElementById('idkh').value = t1
	km = t6;
	document.getElementById('tt').innerHTML = t4 + " CK: " + t6 + "%"
	if (t5 != '') {
		document.getElementById('nhanqua').style.display = '';
		t6 = t4.lastIndexOf('-');
		document.getElementById('diem').value = t4.substring(t6 + 1);
		if (parseFloat(document.getElementById('diem').value) >= 1000) {
			thuhangkhach = 1;
		} else thuhangkhach = 0;
	}
	else {
		//	document.getElementById('nhanqua').style.display = 'none' ;
		document.getElementById('diem').value = 0;
		thuhangkhach = 0;
	}

	document.getElementById('hienthongbao').style.display = "none";

	goidong()
}
var tinh = '';
var thanhpho = '';

function xulygoi() {
	if (document.getElementById('taomoikhach').value == '1') {
		$(document).ready(function () {
			$('.js-tinh').select2();
			$('.js-quan').select2();
			$('.js-phuong').select2();
			$('.js-tinh').on('select2:selecting', function (e) {
				//console.log('Selecting: ' , e.params.args.data);
				tinh = e.params.args.data.id;
				var poststr = "TINH=" + encodeURIComponent(e.params.args.data.id) + "*@!";

				loadtrang('khonghienthi', "ajaxtinhthanh", poststr, "xulyquan");
			});

			$('.js-quan').on('select2:selecting', function (e) {
				var poststr = "THANH=" + encodeURIComponent(tinh) + "*@!" + encodeURIComponent(e.params.args.data.id);
				loadtrang('khonghienthi', "ajaxtinhthanh", poststr, "xulyphuong");
			});
		});





	}
}


function xulyquan() {

	var tam = document.getElementById('khonghienthi').innerHTML;
	var quan = document.getElementById("quan");

	if (tam != "") {

		quan.innerHTML = tam;
		quan.disabled = false;

	}


}

function xulyphuong() {

	var tam = document.getElementById('khonghienthi').innerHTML;
	var phuong = document.getElementById("phuong");

	if (tam != "") {

		phuong.innerHTML = tam;
		phuong.disabled = false;

	}


}

function xulyluukhachmoi() {
	var mang = ketqua.split('###');
	document.getElementById('idkh').value = mang[2];
	document.getElementById('tenkh').innerHTML = mang[3];
	document.getElementById('dckh').innerHTML = mang[4];

	km = 0;
	document.getElementById('tt').innerHTML = '';
	document.getElementById('diem').value = 0;
	document.getElementById('hienthongbao').style.display = "none";
	goidong()

}


function luuthongtinkhach(t1, t2, t3, t4, t5, t6, t7, t8, t9, t10) { 	 // ngaysinh.value,xungho.value,address.value,tinhthanh.value,quan.value,phuong.value,notem.value
	t2 = trim(t2);
	if (t1 == '') { alert('Bạn chưa chọn nhóm khách hàng'); document.getElementById('khonghienthi').focus(); return; }
	if (t2.length < 10 || t2.length > 10) { alert('kiểm tra lại số điện thoại khách hàng'); document.getElementById('telm').focus(); return; }
	if (t3 == '') { alert('Bạn chưa nhập tên khách hàng'); document.getElementById('Namem').focus(); return; }
	if (t4 == '') { alert('Bạn chưa nhập ngày sinh khách hàng'); document.getElementById('ngaysinh').focus(); return; }
	if (t5 == '') { alert('Bạn chưa chọn xưng hô khách hàng'); document.getElementById('xungho').focus(); return; }
	if (t6 == '') { alert('Bạn chưa nhập địa chỉ khách hàng'); document.getElementById('address').focus(); return; }
	if (t7 == '0') { alert('Bạn chưa chọn tỉnh khách hàng'); document.getElementById('tinhthanh').focus(); return; }
	// if(t8=='0') { alert('Bạn chưa chọn quận khách hàng'); document.getElementById('quan').focus();return; }
	//  if(t9=='0') { alert('Bạn chưa chọn phường khách hàng'); document.getElementById('phuong').focus();return; }
	poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(t2) + "*@!" + encodeURIComponent(t3) + "*@!" + encodeURIComponent(t4) + "*@!" + encodeURIComponent(t5);
	poststr = poststr + "*@!" + encodeURIComponent(t6) + "*@!" + encodeURIComponent(t7) + "*@!" + encodeURIComponent(t8) + "*@!" + encodeURIComponent(t9) + "*@!" + encodeURIComponent(t10);
	loadtrang('hienthikh', "khachhangtaomoi", poststr, "xulyluukhachmoi");
	//alert('Luu xong !!!');
}

function timkiemkh(t1, t2, t3, t4, t5, t6, t7, t8) {
	poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(t2) + "*@!" + encodeURIComponent(t3) + "*@!" + encodeURIComponent(t4);
	poststr = poststr + "*@!" + encodeURIComponent(t5) + "*@!" + encodeURIComponent(t6) + "*@!" + encodeURIComponent(t7) + "*@!" + encodeURIComponent(t8);
	loadtrang('hienthikh', "xuatkhokhachhangtim", poststr, "xulygoi");
	//alert('Luu xong !!!');
}


function timsanpham(t1, t2, t3, t4, t5, t6, t7) {

	poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(t2) + "*@!" + encodeURIComponent(t3) + "*@!" + encodeURIComponent(t4);
	poststr = poststr + "*@!" + encodeURIComponent(t5) + "*@!" + encodeURIComponent(t6) + "*@!" + encodeURIComponent(t7);
	loadtrang('sanpham', "xuatkhotimsp", poststr, "");

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

function doithungan() {

	if (document.getElementById('hiethidoithungan').style.display == "") {
		document.getElementById('hiethidoithungan').style.display = "none";
	} else {
		document.getElementById('hiethidoithungan').style.display = "";
		//	document.getElementById('ma').focus();
	}

}
function xulydoithungan() {
	var kq = ketqua.split('###');
	if (kq[3] == 0) { alert('Sai mật khẩu vui lòng nhập mật khẩu đúng '); return; }
	document.getElementById('hienthithungan').innerHTML = kq[1];
	document.getElementById('nguoitao123').value = kq[2];

}

function goidoithungan(id, t) {

	poststr = "DATA=" + encodeURIComponent(id) + "*@!" + encodeURIComponent(t) + "*@!" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0);
	loadtrang('khonghienthi', "xuatkhodoithungan", poststr, "xulydoithungan");
}


function setnhacungcap(loai, id, diachi) {

	document.getElementById('khachhang').value = id;

	document.getElementById('timkhachhang').style.display = "none";
	document.getElementById('codechinh').style.display = "";
	document.getElementById('note').focus();

}
var idxe = '';




//=======================================================

function clearchon() {

	document.getElementById('NameTK').value = '';
	document.getElementById('codeprotk').value = '';
	document.getElementById('code').value = '';
	document.getElementById('IDGrouptk').value = '0';
	document.getElementById('sanpham').innerHTML = document.getElementById('luutimsp').innerHTML;
}
function kiemtraphieu() {
	if (document.getElementById('makm').value != '' && document.getElementById('idkh').value == 1) { alert('Bạn phải chọn khách hàng khi dùng mã khuyến mãi !'); timkhachhang(); return false; }
	if (document.getElementById('lydo').value == 0) {
		alert('Xin vui lòng chọn ly lo!');
		document.getElementById('lydo').focus();
		return false;
	}
	if (document.getElementById('lydo').value == 5 && document.getElementById('cuahang').value == 0) { alert('Bạn chưa chọn cửa hàng'); return false; }

	if (document.getElementById('lydo').value > 45 && trim(document.getElementById('mavandon').value) == '' && (document.getElementById('lydo').value) != 68) { alert('Bạn chưa nhập ID chat'); return false; }

	if (document.getElementById('lydo').value > 45 && trim(document.getElementById('nvonline').value) == '' && (document.getElementById('lydo').value) != 68) { alert('Bạn chưa chọn nhân viên pass đơn'); return false; }

	if (document.getElementById('idkh').value == 0) {
		alert('Xin vui lòng chọn khách hàng!');
		document.getElementById('khachhang').focus();
		return false;
	}
	if (mangsp.length == 0) {
		alert('Xin vui lòng chọn sản phẩm đã bán!');
		document.getElementById('codeprotk').focus();
		return false;
	}
	return true;
}


function timkhachhang() {
	if (document.getElementById('hienthongbao').style.display == "") {
		document.getElementById('hienthongbao').style.display = "none";
		document.getElementById('timkhachhanght').style.display = '';
		document.getElementById('timphieuxuat').style.display = 'none';


	} else {
		document.getElementById('hienthongbao').style.display = "";
		document.getElementById('timkhachhanght').style.display = '';
		document.getElementById('timphieuxuat').style.display = 'none';
		document.getElementById('ma').focus();
	}


}

function timkhachhang() {
	if (document.getElementById('hienthongbao').style.display == "") {
		document.getElementById('hienthongbao').style.display = "none";
		document.getElementById('timkhachhanght').style.display = '';
		document.getElementById('timphieuxuat').style.display = 'none';


	} else {
		document.getElementById('hienthongbao').style.display = "";
		document.getElementById('timkhachhanght').style.display = '';
		document.getElementById('timphieuxuat').style.display = 'none';
		document.getElementById('ma').focus();
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

//=======================================================

//===============================================


function timtrongbaogia(t0, t1, t2, t3, t4, t5, t6) {

	poststr = "DATA=" + encodeURIComponent(t0) + "*@!" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(t2) + "*@!" + encodeURIComponent(t3) + "*@!" + encodeURIComponent(t4);
	poststr = poststr + "*@!" + encodeURIComponent(t5) + "*@!" + encodeURIComponent(t6) + "*@!" + encodeURIComponent(0);
	loadtrang('httimxuatb', "xuattimbaogia", poststr, "");


}

function timdsphieuxuat(t0, t1, t2, t3, t4, t5, t6, t7, t8) {
	poststr = "DATA=" + encodeURIComponent(t0) + "*@!" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(t2) + "*@!" + encodeURIComponent(t3) + "*@!" + encodeURIComponent(t4);
	poststr = poststr + "*@!" + encodeURIComponent(t5) + "*@!" + encodeURIComponent(t6) + "*@!" + encodeURIComponent(t7) + "*@!" + encodeURIComponent(t8);
	loadtrang('httimxuat', "xuatkhotim", poststr, "");
}



function xuly4() {
	// alert( ketqua)
	var ma = ketqua.split('&$&');
	var m = ma[0].split('@$@');
	// alert( m[29])
	//0     1   2       3       4     5    6    7         8      9    10    11   12    13       14     15      16   17   18     19     20      21   22      23   24
	//ID,IDKho,IDNhaCC,IDNhap,NgayNh,SoCT,LyDo,SoNgayNo,IDTKNo,IDTKCo,TiGia,VAT,GhiChu,NgayTao,IDTao,NguoiGiao,Loai,ten,diachi,tenkho,tenlydo,tenN,diachiN,dakhoa,soxe

	//alert(m[5] )
	document.getElementById('sochungtu').value = m[5];
	document.getElementById('kho').value = m[8];
	document.getElementById('bot').value = m[10];
	document.getElementById('lydo').value = m[6];

	document.getElementById('idkh').value = m[2];
	document.getElementById('dckh').innerHTML = m[18];
	document.getElementById('tenkh').innerHTML = m[17];
	document.getElementById('idgoi').value = m[0];
	document.getElementById('note').value = m[12];
	document.getElementById('khachdua').value = m[29];
	document.getElementById('thongtinphieu').innerHTML = m[31];
	document.getElementById('textarea').value = m[24];  // tên kho
	document.getElementById('makm').value = m[15];
	document.getElementById('online').value = m[22];
	document.getElementById('mavandon').value = m[21];
	document.getElementById('nvonline').value = m[30];
	document.getElementById('lydotra').value = m[19];
	document.getElementById('cuahang').value = m[30];
	document.getElementById('idgioithieu').value = m[32];
	document.getElementById('loaithanhtoan').value = m[33];
	if (m[6] == 5) document.getElementById('cuahangdiv').style.display = '';
	if (m[6] > 45) document.getElementById('passdon').style.display = ''; else document.getElementById('passdon').style.display = 'none';
	$('.js-nv').select2();
	$('.js-ch').select2();
	$('.js-nvht').select2();
	$('.js-ol').select2();

	// document.getElementById('VAT').value = m[11]; 
	var msp = ma[1].split('@$&');
	var mang = new Array();
	var mgt = new Array();
	mangsp = mang;
	for (x in msp) { // alert(msp[x]);
		mgt = msp[x].split('@$@');
		//  (code, ten,    soluong,d ongia, thue,loaitien,ghichu,  mt,    giagiam);     9  
		mangsp[mgt[2]] = new Array(mgt[3], mgt[7], (mgt[4]), mgt[5], mgt[12], mgt[6], mgt[10], mgt[13], mgt[14]);
		//	mangsp[mgt[2]] = new Array(mgt[3],mgt[7],Math.abs(mgt[4]),mgt[5],mgt[12],mgt[6],mgt[10]);	
		//    Array(code  ,ten   ,soluong, dongia , chietkhau ,loaitien,ghichu);	  
	}
	xuatsp();
	timphieu();
}

function setlaiphieuxuat(t1, t2) {
	poststr = "DATA=" + "0*@!" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(t2) + "*@!" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0);
	loadtrang('khonghienthi', "xuatkhogoi", poststr, "xuly4");

	poststr = "DATA=" + "0*@!" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(t2) + "*@!" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0);

	//	  loadtrang('httimlai', "xuatkhoht", poststr,"") ;		
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
	document.getElementById('inan').disabled = "";
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

function xemthe(id, xuatxuat, kho, tu, den) {
	var st;
	st = "thekhoxem.php?t1=" + id + "&t2=" + xuatxuat + '&t3=' + kho + '&t4=' + tu + '&t5=' + den;
	window.open(st, 'popup', 'toolbar=no,status=no,scrollbars=yes,location=no,menubar=no,directories=no,width=1000,height=700,titlebar=no');
}


function previewimage(input, id) {
	var hinhanhtruoc = document.getElementById("hinhanhtruoc").value;
	if (id == 'anhmattruoc') {
		if (!hinhanhtruoc) {
			$("#hinhanhtruoc").html('');
		}
	}
	if (id == 'anhmatsau') {
		if (!hinhanhsau) {
			$("#hinhanhsau").html('');
		}
	}

	if (input.files) {
		var files = input.files;
		console.log(files);
		for (var i = 0; i < files.length; i++) {
			var file = files[i];
			if (file) {
				var reader = new FileReader();
				reader.onload = function (e) {
					var img = document.createElement("img");
					img.setAttribute("src", e.target.result);
					img.style.width = 200 + "px";
					img.style.marginLeft = 10 + "px";
					img.style.marginTop = 10 + "px";
					img.setAttribute("class", "file-upload-image");
					if (id == 'anhmattruoc') {
						$("#hinhanhtruoc").append(img);
					}
					if (id == 'anhmatsau') {
						$("#hinhanhsau").append(img);
					}

				};
				reader.readAsDataURL(file);
			} else {
				removeUpload();
			}
		}
	}
}


function luuanhxacminh(soct) {

	var anhtruoc = document.querySelector('#anhmattruoc').files[0];
	if (!anhtruoc) {
		alert("Vui lòng chọn đủ ảnh mặt của CCCD/CMND");
		return;
	} else {
		var formData = new FormData();
		formData.append("soct", soct);
		formData.append("anhtruoc",anhtruoc);
		$.ajax({
			url: "uploadimgconfirm.php",
			type: "POST",
			data: formData,
			success: function (msg) {
				alert(msg);
				goidong();
			},
			cache: false,
			contentType: false,
			processData: false
		});
	}

}

function nhapthongtin() {
	if (document.getElementById('xacnhanthongtin').style.display == "") {
		document.getElementById('xacnhanthongtin').style.display = "none";
	} else {
		document.getElementById('xacnhanthongtin').style.display = "";
	}

}

function timphieu() {


	if (document.getElementById('hienthongbao').style.display == "") {
		document.getElementById('hienthongbao').style.display = "none";
		document.getElementById('timkhachhanght').style.display = '';
		document.getElementById('timphieuxuat').style.display = 'none';
	} else {
		document.getElementById('hienthongbao').style.display = "";
		document.getElementById('timkhachhanght').style.display = 'none';
		document.getElementById('timphieuxuat').style.display = '';
	}

}
function thempt(t1, t2, t3, t4) {
	var sobaogia = document.getElementById('sochungtu').value;
	var st;
	st = "default.php?act=product&id=-1&t1=" + t1 + '&t2=' + t2 + '&t3=' + t3 + '&t4=' + t4;
	window.open(st, 'popup', 'toolbar=no,status=no,scrollbars=yes,location=no,menubar=no,directories=no,width=1000,height=600,titlebar=no');
}

function taomoi() {
	document.forms['frmxuat'].reset();
	document.getElementById('sanphamxuat').innerHTML = document.getElementById('luubd').innerHTML;
	document.getElementById('luu').disabled = '';
	document.getElementById('khoa').disabled = true;
}





function setnguoc(id, ten, ma, sl, gia, lt, chietkhau, note) {
	document.getElementById('idsp').value = id;
	document.getElementById('ten').value = ten;
	document.getElementById('ma').value = ma;

	document.getElementById('tensp').value = ten;
	document.getElementById('masp').value = ma;

	document.getElementById('soluong').value = txtFormatj(sl);
	document.getElementById('dongia').value = txtFormatj(gia);
	//	document.getElementById('giamgia').value= '0'; 
	document.getElementById('loaitien').value = lt;
	document.getElementById('chietkhau').value = chietkhau;
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


function goidongthe() {
	document.getElementById("hiethithongbao").style.display = 'none';
}

function capxuatgia(idsp, dongia) {
	poststr = "DATA=" + encodeURIComponent(idsp) + "*@!" + encodeURIComponent(dongia) + "*@!" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0);
	loadtrang('ketqualuu', "capxuatgia", poststr, "");
}

function addpro(idsp, ten, code, dongia, loaitien, soluong, chietkhau, ghichu, giachan, mt, giagiam, giamgop, slcon) {
	// alert('soluong '+soluong+' dongia '+dongia +' giagiam:'+giagiam+' giamgop '+giamgop+' slcon'+ slcon)
	var dg = dongia;
	dg = dg.replace(',', '');
	dg = dg.replace(',', '');
	dongia = dg;
	var dongia2 = document.getElementById('dongia2').value;
	dongia2 = dongia2.replace(',', '');
	dongia2 = dongia2.replace(',', '');

	var IDK = document.getElementById('idkho').value;
	if (slcon <= 0 && (IDK == '1010' || IDK == '54' || IDK == '1092' || IDK == '1060')) { alert("Kiểm tra lại khi xuất bán khi số lượng <=0"); }


	if (dongia2 * 1 > dg * 1) dongia = dongia2;
	if (chietkhau > 0 && (dongia * 1 < 70000)) { alert('Mã này giá nhỏ hơn 70.000 không được chiết khấu !!!'); }


	if (chietkhau > 0 && (code[code.length - 1] == 'Z' || code[code.length - 1] == 'z')) { alert('Mã Z này khuyến cáo không được chiết khấu !!!'); }
	if (idsp == '') {
		alert('Bạn Chưa chọn hàng hóa!!!'); document.getElementById('NameTK').focus(); return;
	}

	// if (chietkhau<km) chietkhau =km ;

	if (laso(giachan) > (parseFloat(dg) - parseFloat(dg) * chietkhau / 100)) {
		//  alert('Giảm giá không được vượt '+ txtFormatj(giachan)+' !!!');document.getElementById('chietkhau').focus(); return false;	
	}
	if (laso(dongia) == 0 && code != 'giamgia') {
		var cf = "Bạn chưa nhập đơn giá!!! \n\nBạn có muốn nhập hay không ?";
		var n = confirm(cf);
		if (n == true) {
			document.getElementById('dongia').focus();
			return false;
		}
	}

	if (document.getElementById('ol').value == 0) {

		if (code == 'giamgia' && dongia == 0) {
			document.getElementById('dongia').readOnly = false; soluong = "1";
			document.getElementById('dongia').focus();
			return;
		} else { document.getElementById('dongia').readOnly = true; }

	}

	if (trim(soluong) == '' || laso(soluong) == 0) {
		alert('Bạn chưa nhập số lượng!!!'); document.getElementById('soluong').focus(); return;
	}

	if (laso(soluong) < 0) {
		alert('Bạn không được nhập số Âm !!!');// document.getElementById('soluong').focus(); return;
	}
	//alert(document.getElementById('sl').value > soluong);
	var sl = laso(document.getElementById('sl').value);

	//alert(sl < soluong) ;
	//	if(document.getElementById('tenform').innerHTML== "xuatkho" && parseFloat(sl) < parseFloat(soluong) )
	//	{
	//		alert('Trong kho chỉ còn "' + sl + '" sản phẩm, vui lòng nhập thêm vào kho hoặc xuất ít hơn ' + sl +  ' !!!');
	//		document.getElementById('soluong').focus() ;
	//		document.getElementById('soluong').select() ;
	//		return ;
	//	}

	var giagiam = Math.round(parseFloat(dg) - parseFloat(dg) * chietkhau / 100);

	if (code == 'giamgia' && 1 * dg > 0) { dongia = -1 * ((dg)); }
	mangsp[idsp] = new Array(code, ten, soluong, dongia, chietkhau, loaitien, ghichu, mt, giagiam, giamgop);
	document.getElementById('codeprotk').value = '';

	xuatsp();
	document.getElementById('nhac').play();
	//	if(document.getElementById('tenform').innerHTML== "xuatkho" )	{ capxuatgia(idsp,dongia) ;}  
	document.getElementById('codeprotk').select();
	//tinhgiamgia(50,1)

	//Hải tự thêm
	mangsp1[idsp] = new Array(code, ten, soluong, dongia, chietkhau, loaitien, ghichu, mt, giagiam, giamgop);
	// console.log(mangsp1);
	if (document.getElementById("makm").value && document.getElementById('ketqualuu').innerHTML) {
		var dieukienvc = document.getElementById('ketqualuu').innerHTML;
		var dieukien = dieukienvc.split("**#");
		giamgiatudong(dieukien[3]);
	}

}


function addpro888(idsp, ten, code, dongia, loaitien, soluong, chietkhau, ghichu, giachan, mt, giagiam, giamgop) {

	var dg = dongia;
	dg = dg.replace(',', '');
	dg = dg.replace(',', '');
	dongia = dg;
	var dongia2 = document.getElementById('dongia2').value;
	dongia2 = dongia2.replace(',', '');
	dongia2 = dongia2.replace(',', '');
	if (dongia2 * 1 > dg * 1) dongia = dongia2;

	if (chietkhau > 0 && (dongia * 1 < 70000)) { alert('Mã này giá nhỏ hơn 70.000 không được chiết khấu !!!'); }


	if (chietkhau > 0 && (code[code.length - 1] == 'Z' || code[code.length - 1] == 'z')) { alert('Mã Z này khuyến cáo không được chiết khấu !!!'); }
	if (idsp == '') {
		alert('Bạn Chưa chọn hàng hóa!!!'); document.getElementById('NameTK').focus(); return;
	}

	// if (chietkhau<km) chietkhau =km ;

	if (laso(giachan) > (parseFloat(dg) - parseFloat(dg) * chietkhau / 100)) {
		//  alert('Giảm giá không được vượt '+ txtFormatj(giachan)+' !!!');document.getElementById('chietkhau').focus(); return false;	
	}
	if (laso(dongia) == 0 && code != 'giamgia' && code != 'giam50' && code != 'giam100') {
		var cf = "Bạn chưa nhập đơn giá!!! \n\nBạn có muốn nhập hay không ?";
		var n = confirm(cf);
		if (n == true) {
			document.getElementById('dongia').focus();
			return false;
		}
	}

	if (document.getElementById('ol').value == 0) {

		if (code == 'giamgia' && dongia == 0) {
			document.getElementById('dongia').readOnly = false; soluong = "1";
			document.getElementById('dongia').focus();
			return;
		} else { document.getElementById('dongia').readOnly = true; }

	}



	if (trim(soluong) == '' || laso(soluong) == 0) {
		alert('Bạn chưa nhập số lượng!!!'); document.getElementById('soluong').focus(); return;
	}

	if (laso(soluong) < 0) {
		alert('Bạn không được nhập số Âm !!!'); // document.getElementById('soluong').focus(); return;
	}
	//alert(document.getElementById('sl').value > soluong);
	var sl = laso(document.getElementById('sl').value);

	//alert(sl < soluong) ;
	//	if(document.getElementById('tenform').innerHTML== "xuatkho" && parseFloat(sl) < parseFloat(soluong) )
	//	{
	//		alert('Trong kho chỉ còn "' + sl + '" sản phẩm, vui lòng nhập thêm vào kho hoặc xuất ít hơn ' + sl +  ' !!!');
	//		document.getElementById('soluong').focus() ;
	//		document.getElementById('soluong').select() ;
	//		return ;
	//	}


	var giagiam = Math.round(parseFloat(dg) - parseFloat(dg) * chietkhau / 100);

	if (code == 'giamgia' && 1 * dg > 0) { dongia = -1 * ((dg)); }
	if (code == 'giam50' || code == 'giam100') { dongia = dg; }

	mangsp[idsp] = new Array(code, ten, soluong, dongia, chietkhau, loaitien, ghichu, mt, giagiam, giamgop);
	document.getElementById('codeprotk').value = '';

	xuatsp();
	document.getElementById('nhac').play();
	//	if(document.getElementById('tenform').innerHTML== "xuatkho" )	{ capxuatgia(idsp,dongia) ;}  
	document.getElementById('codeprotk').select();
	//tinhgiamgia(50,1)

	mangsp1[idsp] = new Array(code, ten, soluong, dongia, chietkhau, loaitien, ghichu, mt, giagiam, giamgop);

	if (document.getElementById("makm").value && document.getElementById('ketqualuu').innerHTML) {
		var dieukienvc = document.getElementById('ketqualuu').innerHTML;
		var dieukien = dieukienvc.split("**#");
		giamgiatudong(dieukien[3]);

	}
}

function resetpromo() {
	mangsp = mangsp1;
	xuatsp();
}


function xoapt(id) {

	var mt = new Array();
	var mt2 = new Array();
	if (id != '') {
		for (x in mangsp) {
			if (x != id) {
				mt[x] = mangsp[x];
				mt2[x] = mangsp1[x];
			}
		}
		mangsp = mt;
		mangsp1 = mt2;
		var tam = document.getElementById('ketqualuu').innerHTML;
		var makm = document.getElementById('makm').value;
		if (tam != "" && makm != "") {
			var n = tam.split("**#");
			if (n[3].indexOf('DKG') > 0 || n[3].indexOf('GVC') > 0 || n[3].indexOf('GPT') > 0) {
				giamgiatudong(n[3]);
			} else {
				xuatsp();
			}
		} else {
			xuatsp();
		}
	}
	document.getElementById('idsp').value = '';
	document.getElementById('masp').value = '';
	document.getElementById('tensp').value = '';
	document.getElementById('soluong').value = '';
	document.getElementById('dongia').value = '';
	document.getElementById('chietkhau').value = '';
	document.getElementById('loaitien').value = '';
	document.getElementById('ghichu').value = '';
	document.getElementById('mt').value = '';
	document.getElementById('giagiam').value = '';
	document.getElementById('giamgop').value = '';
}

function setthongtin(id) {

	if (mangsp.hasOwnProperty(id)) {
		document.getElementById('idsp').value = id;
		document.getElementById('masp').value = mangsp[id][0];
		document.getElementById('tensp').value = mangsp[id][1];
		document.getElementById('soluong').value = mangsp[id][2];
		document.getElementById('dongia').value = mangsp[id][3];
		document.getElementById('chietkhau').value = mangsp[id][4];
		document.getElementById('loaitien').value = mangsp[id][5];
		document.getElementById('ghichu').value = mangsp[id][6];
		document.getElementById('mt').value = mangsp[id][7];
		document.getElementById('giagiam').value = mangsp[id][8];
		document.getElementById('giamgop').value = mangsp[id][9];
		if (document.getElementById('ol').value == 0) {
			if (mangsp[id][0] == "giamgia") document.getElementById('dongia').readOnly = false; else document.getElementById('dongia').readOnly = true;
		}
		document.getElementById('dongia').focus();
	}

}

function xuatsp() {
	if (solancheck == 0) {
		kiemtragiamgia50();
	} else {
		solancheck = 0;
	}
	var x, stt, tam, lon1, lon2, lon3, dagiam, solangiam, str = "", manho = ''; stt = 0; lon1 = 0, lon2 = 0; lon3 = 0; chuagiam = true;
	var thanhtien, tong, nguyengia = 0, dem = 0; gianho = 10000000;
	tienbot = document.getElementById('bot').value;
	tienbot = tienbot.replace(',', ''); tienbot = tienbot.replace(',', ''); tienbot = tienbot.replace(',', '');
	var mt = new Array();
	//=============================kiem tra mua 3 giam 92== va tim sp nho nhat====================== (code,ten,soluong,dongia,chietkhau,loaitien,ghichu,mt,giagiam);
	if (tienbot == 0 && document.getElementById('ol').value == '0' && 1 == 2) {

		for (x in mangsp) {
			if (mangsp[x][3] == txtFormatj(mangsp[x][8])) {
				dem = dem + 1 * mangsp[x][2];
				//if( gianho>1*mangsp[x][8]) {gianho =1*mangsp[x][8] ;   } 

				if (lon3 < 1 * mangsp[x][8]) lon3 = 1 * mangsp[x][8];
				if (lon2 < lon3) { tam = lon2; lon2 = lon3; lon3 = tam; }
				if (lon1 < lon2) { tam = lon1; lon1 = lon2; lon2 = tam; }


			}

		}




		for (x in mangsp) {
			if (mangsp[x][3] == txtFormatj(mangsp[x][8])) {
				dem = dem + 1 * mangsp[x][2];
				//if( gianho>1*mangsp[x][8]) {gianho =1*mangsp[x][8] ;   } 

				if (lon3 < 1 * mangsp[x][8]) lon3 = 1 * mangsp[x][8];
				if (lon2 < lon3) { tam = lon2; lon2 = lon3; lon3 = tam; }
				if (lon1 < lon2) { tam = lon1; lon1 = lon2; lon2 = tam; }


			}

		}
		solangiam = Math.floor(dem / 3);
		if (dem >= 3) {
			if (lon2 == 0) lon2 = lon1; if (lon3 == 0) lon3 = lon2;

			for (x in mangsp) {
				//   alert(lon3+ '='+ lon2 +'='+ lon1)
				if (1 * mangsp[x][8] == lon3 && chuagiam) {
					mangsp[x][4] = Math.round(1000 * 92 / mangsp[x][2]) / 1000;
					chuagiam = false;
				} else if (mangsp[x][3] == txtFormatj(mangsp[x][8]) && mangsp[x][4] != 0) {
					mangsp[x][4] = 0;
				}

				mt[x] = mangsp[x];

			}
			mangsp = mt;

		}


	}
	//================so sanh chuong trinh khuyen mai ===============================================================
	//	thanhtien=0;
	//   for (x in mangsp)
	//	{  
	//		thanhtien =  doiso(mangsp[x][3]) *  doiso(mangsp[x][2])    ;	
	//		thanhtien  = thanhtien - thanhtien *  mangsp[x][4]/100   ;
	//		thanhtien  =   Math.round(thanhtien,0) ; 
	//		tong = tong + thanhtien ;		
	//	}
	//	tong = tong -1*tienbot ;
	//	alert(tong) ;
	//=============================kiem tra mua 3 giam 92========================


	thanhtien = 0; tong = 0;
	str = ' <table width="100%" border="0" cellpadding="0" cellspacing="0">';
	str += '    <tr bgcolor="#F8E4CB" > ';
	str += ' <td width="29"  align="center" class="cothienthi" height="23"><b>STT</b></td> ';
	str += ' <td width="115" align="center" class="cothienthi"><strong>Mã Hàng Hóa </strong></td> ';
	str += ' <td width="350" align="center" class="cothienthi"><strong>Tên Hàng Hóa</strong></td> ';
	str += ' <td width="45"  align="center" class="cothienthi"><strong>SL</strong></td> ';
	str += ' <td width="105" align="center" class="cothienthi"><strong>Đơn Giá </strong></td> ';
	str += ' <td width="51"  align="center" class="cothienthi"><strong>CK</strong></td> ';
	str += ' <td width="100" align="center" class="cothienthi"><strong>Thành Tiền </strong></td> ';
	str += ' <td width="300" align="center" class="cothienthi"><strong>Ghi Chú </strong></td> ';
	str += ' <td width="30"  align="center" class="cothienthi"><strong>X&#243;a</strong></td> ';
	str += ' </tr>';
	var mau, h1, h12;
	tongsl = 0;
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
		if (phantramgiam > 0) { mangsp[x][4] = 0; }
		//thanhtien  = doiso(mangsp[x][3]) *  doiso(mangsp[x][2])    ;	
		//thanhtien  = thanhtien - thanhtien *  mangsp[x][4]/100   ;

		thanhtien = Math.round(mangsp[x][3] * (1 - 1 * mangsp[x][4] / 100)) * mangsp[x][2]
		//thanhtien  = Math.round(thanhtien)  ; 
		if (mangsp[x][4] <= 0 && mangsp[x][3] >= 70000) nguyengia = nguyengia + thanhtien;

		tong = tong + thanhtien;
		tongsl = 1 * tongsl + 1 * mangsp[x][2];
		stt = stt + 1;
		str += '<TR onMouseOver="this.className=\'' + hl2 + '\'"   onMouseOut="this.className=\'' + h1 + '\'" bgcolor="' + mau + '" style="cursor:pointer" onclick="setthongtin(\'' + x + '\')">';
		str += ' <td class="cothienthi"  align="Right" height="23">' + stt + '</td>';
		str += ' <td class="cothienthi"  align=""  >&nbsp;' + mangsp[x][0] + ' ' + mangsp[x][7] + '</td>';
		str += ' <td class="cothienthi"  align=""  >&nbsp;' + mangsp[x][1] + '</td>';
		str += ' <td class="cothienthi"  align="right"  >&nbsp;' + mangsp[x][2] + '</td>';
		str += ' <td class="cothienthi"  align="right"  >&nbsp;' + txtFormatj(mangsp[x][3]) + '</td>';
		str += ' <td class="cothienthi"  align="center"  >&nbsp;' + mangsp[x][4] + '%</td>';
		str += ' <td class="cothienthi"  align="right"  >&nbsp;' + txtFormatj(thanhtien) + '&nbsp;</td>';
		str += ' <td class="cothienthi"  align=""  >&nbsp;' + mangsp[x][6] + '</td>';
		str += ' <td class="cothienthi"  align="center"  ><img onclick="xoapt(\'' + x + '\')" title=\"Xóa Mục\"  src="images/delete.gif" border="0"></td>';
		str += ' </Tr>';

	}
	str += ' <Tr class="cothienthi"><td colspan="3"    align="right" ><b> Tổng cộng nguyên giá</b> <b style="font-size:20px;color:blue;" >' + txtFormatj(nguyengia) + ' </b></td><td align="right"  class="chulon" ><b>' + txtFormatj(tongsl) + '&nbsp;</b></td><td>&nbsp;</td><td>&nbsp;</td><td  align="right"   class="chulon" ><b>' + txtFormatj(tong) + '</b> </td><td></td>';
	str += ' </Tr>';
	str += '</table>';
	document.getElementById('sanphamxuat').innerHTML = str;
	document.getElementById('tongtien').innerHTML = txtFormatj(tong);
	khachduatien = document.getElementById('khachdua').value;

	khachduatien = khachduatien.replace(',', '');
	khachduatien = khachduatien.replace(',', '');
	khachduatien = khachduatien.replace(',', '')
	if (khachduatien == '') khachduatien = 0;
	if (phantramgiam > 0) {
		tienbot = Math.round(tong * phantramgiam / 100);

		document.getElementById('bot').value = formatso(tienbot);
	}
	document.getElementById('tralai').innerHTML = txtFormatj(parseFloat(khachduatien) - parseFloat(tong) + parseFloat(tienbot));
	//  document.getElementById('tralai').innerHTML =  document.getElementById('tralai').innerHTML.replace('-,','-');
}
//===================================================================================== 
var tongtienhang, tienbot, khachdua;
function tinhtien(giatri) {
	giatri = giatri.replace(',', '');
	giatri = giatri.replace(',', '');
	giatri = giatri.replace(',', '');
	tongtienhang = document.getElementById('tongtien').innerHTML;
	tongtienhang = tongtienhang.replace(',', '');
	tongtienhang = tongtienhang.replace(',', '');
	tongtienhang = tongtienhang.replace(',', '');
	tienbot = document.getElementById('bot').value;
	tienbot = tienbot.replace(',', ''); tienbot = tienbot.replace(',', ''); tienbot = tienbot.replace(',', '');
	tongtienhang = tongtienhang * 1 - tienbot;

	document.getElementById('tralai').innerHTML = txtFormatj(parseFloat(giatri) - parseFloat(tongtienhang));
	document.getElementById('tralai').innerHTML = document.getElementById('tralai').innerHTML.replace('-,', '-');
}

function kiemtradongthoi(bot) {
	var ckx = '';
	bot = bot.replace(',', ''); bot = bot.replace(',', ''); bot = bot.replace(',', '');
	var mt = new Array();
	if (bot * 1 > 0) {
		for (x in mangsp) {
			mt[x] = mangsp[x];
			if (mt[x][4] > 0) {
				if (ckx == '') {
					var cf = "Bạn chỉ được chọn 1 loại khuyến mãi nhập voucher hoặc giảm giá!!! \n\nBạn có muốn xóa chiết khấu các sản phẩm đang có hay không ?";
					var n = confirm(cf);
					if (n == true) { setchietkhauchung('0'); return; }
					else { return; }
				}


			}
		}
	}
}

function tinhtienbot(bot) {

	khachdua = document.getElementById('khachdua').value;
	khachdua = khachdua.replace(',', '');
	khachdua = khachdua.replace(',', '');
	khachdua = khachdua.replace(',', '');
	tongtienhang = document.getElementById('tongtien').innerHTML;
	tongtienhang = tongtienhang.replace(',', '');
	tongtienhang = tongtienhang.replace(',', '');
	tongtienhang = tongtienhang.replace(',', '');


	tongtienhang = tongtienhang * 1 - bot;
	document.getElementById('tralai').innerHTML = txtFormatj(parseFloat(khachdua) - parseFloat(tongtienhang));
	document.getElementById('tralai').innerHTML = document.getElementById('tralai').innerHTML.replace('-,', '-');
}

function goiinlai() {
	innoidung(ketqua);
	innoidung(ketqua);
}

function xulyod() {
	document.getElementById('khonghienthiketqua').innerHTML = ketqua;
	// document.getElementById('anhqr').src= 
	document.getElementById('hiethithanhtoan').style.display = "";
	var nd = document.getElementById('thongtinthanhtoan').innerHTML;
	nd = nd.split("*");
	document.getElementById('sotienchuyen').innerHTML = "Số tiền chuyển: " + formatso(nd[1]);
	document.getElementById('noidungchuyen').innerHTML = "Nội dung chuyển: " + nd[2].replace('%20', ' ');
	document.getElementById('anhqrc').src = 'taomaqrnganhang.php?noidung=' + document.getElementById('thongtinthanhtoan').innerHTML;

	//document.getElementById('hienthiqrchuyenkhoan').innerHTML='http://localhost/fmstyle.ovn.vn/taomaqrnganhang.php?noidung='+ document.getElementById('thongtinthanhtoan').innerHTML ;
	//	alert( document.getElementById('thongtinthanhtoan').innerHTML )

	// eval(ketqua)

	var timet = setTimeout(function daluuxong1() { goiinlai() }, 100);

}
function goiin() {
	var so = document.getElementById('sochungtu').value;
	var st;
	//	st = "xuatkhoin.php?id=" + so  ;
	//window.open(st,'popup','toolbar=no,status=no,scrollbars=yes,location=no,menubar=no,directories=no,height=300px,titlebar=no') ;
	poststr = "DATA=" + encodeURIComponent(so) + "*@!" + encodeURIComponent(0);
	loadtrang('khonghienthi', "xuatkhoinmoi", poststr, "xulyod");

}
function goiinxuat() {
	var so = document.getElementById('sochungtu').value;
	var st;
	st = "xuatkhoin.php?id=" + so;
	window.open(st, 'popup', 'toolbar=no,status=no,scrollbars=yes,location=no,menubar=no,directories=no,width=1000,height=600,titlebar=no');
}
function lamlai() {
	document.forms['xuatsp'].btnUpdate.disabled = '';
}

function tinhgiamgia1(tongcong, giatri, loaitien) {
}
function tinhgiamgia2(tongcong, giatri, loaitien) {
	var tienchuagiam;
	document.getElementById('thanhtien').innerHTML = parseFloat(tienchuagiam) - parseFloat(document.getElementById('giamphamtram').innerHTML) - parseFloat(tongcong);
}
