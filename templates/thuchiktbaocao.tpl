<style>
    .wrapper {
        width: 100%;
        height: 140vh;
    }

    .header {
        width: 100%;
    }

    #modal_tkno_co {
        position: fixed;
        width: 100%;
        display: none;
        height: 100%;
        top: 0;
        left: 0;
        align-items: center;
        justify-content: center;
        background-color: #0000004d;
        z-index: 10;
    }

    #modal_tkno_co .content {
        display: flex;
        background-color: #FFFFFF;
        width: 360px;
        height: 200px;
        align-items: center;
        flex-direction: column;
        padding: 0.5em;
        justify-content: space-around;
        border: 2px solid #f18b8b;
    }

    #modal_tkno_co .content .form_imput {
        display: flex;
        width: 100%;
        justify-content: space-around;
    }

    #modal_tkno_co .content .form_imput div {
        display: flex;
        width: 50%;
        align-items: center;
    }

    #modal_tkno_co .content .form_imput>div>span {
        font-size: 14px;
        display: flex;
        color: #FF6666;
        width: 40%;
        font-weight: bold;
    }

    #modal_tkno_co .content .form_imput div div {
        display: flex;
        width: 60%;
        margin-right: 1em;
    }

    #modal_tkno_co .content .form_button {
        display: flex;
        width: 100%;
    }

    #modal_tkno_co .btn_action {
        background-color: unset;
        border: none;
        padding: 0.5em 1em;
        border-radius: 5px;
        color: #ffffff;
    }

    .btn_pink {
        background-color: #FF3366 !important;
    }

    .btn_green {
        background-color: #009966 !important;
    }

    .reset_btn {
        border: none;
        background-color: unset;
    }

    .reset_btn:focus {
        outline: none;
        border: none;
    }

    .note_ {
        display: flex;
        justify-content: flex-end;
        width: 90%;
        margin: 0 auto;
        /* padding-bottom: 1em; */
        margin-top: -1.5em;
        margin-bottom: 1em;
    }

    .note {
        font-size: 13px;
        font-weight: bold;
    }

    .notification {
        position: fixed;
        right: 10px;
        background-color: #009688cf;
        color: #ffffff;
        height: 50px;
        width: 150px;
        border-radius: 5px;
        display: flex;
        z-index: 1000;
        align-items: center;
        justify-content: center;
        box-shadow: 1px 1px 5px #616161;
        font-size: 12px;
        backdrop-filter: blur(1px);
        font-weight: bold;
        opacity: 1;
        /*animation: notifi 0.3s linear;*/
    }

    .notification.show {
        display: flex;
        opacity: 1;
        animation: notifi 0.3s linear;
    }

    @keyframes notifi {
        0% {
            opacity: 0;
            top: 140px
        }

        100% {
            opacity: 1;
            top: 100px
        }
    }

    .close_notifi {
        position: absolute;
        right: 0px;
        top: 0px;
    }
</style>
<form name="frmProduct1" id="frmProduct1" method="post" onsubmit="resetform(event)">
    <div id="modal_tkno_co">
        <div class="content">
            <div class="form_imput">
                <div><span>TK nợ:</span>
                    <div>
                        <select onkeypress="return chuyentiep(event,'idnhan')" name="tknokxd" class="js-tknokxd"
                            id="tknokxd" style="width:200px" title="Tài khoản nợ" onchange="">
                            <option value=""></option> {tkno}
                        </select>
                    </div>
                </div>
                <div><span>TK có:</span>
                    <div>
                        <select onkeypress="return chuyentiep(event,'idnhan')" name="tkcokxd" class="js-tkcokxd"
                            id="tkcokxd" style="width:200px" title="tài khoản có">
                            <option value=""></option> {tkco}
                        </select>
                    </div>
                </div>
            </div>
            <div class="form_button">
                <button type="button" class="btn_action btn_pink" onclick="goiduyetkxn()">Lưu</button>
                <button type="button " class="btn_action btn_green" onclick="dongformkxd()">Đóng</button>
            </div>
        </div>
    </div>
    <div style="clear:left;width:100%;overflow:hidden">
        <div class="nenbao">
            <div class="nencon">
                <legend>
                    <a style="cursor:pointer">
                        <label style="Color:#FF3300;Font-Weight:Bold;Font-size:9pt;">Thu chi kế toán báo cáo</label></a>
                </legend>
                <div style="padding:5px">
                    <div class="note_"> {chuoiCHadmin} <button type="button" class="reset_btn note"
                            style="color:#9e9e9e">Cửa hàng <span id="maCHadmin">{macuahang}:</span></button>
                        <button class="reset_btn note" style="color:#ff9800" onclick="timphieuthongbao(1,2)"
                            title="Các phiếu yêu cầu chỉnh sửa bắt buộc trong 48h">YC chỉnh sửa (<span
                                id="yccs_note">0</span>)</button>
                        <button class="reset_btn note" style="color:#4caf50" onclick="timphieuthongbao(1,4)"
                            title="Các phiếu đã được duyệt">Duyệt (<span id="duyet_note">0</span>)</button>
                        <button class="reset_btn note" style="color:#f44336" onclick="timphieuthongbao(1,3)"
                            title="Các phiếu không được duyệt">Không duyệt (<span
                                id="khongduyet_note">0</span>)</button>
                        <button class="reset_btn note" style="color:#2196f3" onclick="timphieuthongbao(1,1)"
                            title="Các phiếu chưa được duyệt">Chưa duyệt (<span id="chuaduyet_note">0</span>)</button>
                        <div id="thongbaores" style="display:none"></div>
                        <button class="reset_btn note" style="color:#2196f3" onclick="GetthongbaoPhieu()"
                            title="Cập nhật dữ liệu mới">Cập nhật dữ liệu <img src="images/loading.gif"
                                style="display:none" id="loadingcapnhat" /></button>
                    </div>
                    <div>
                        <input type="text" name="soct" placeholder="Số chứng từ" id="soct" class="inpl"
                            ondblclick="this.value=''" style="width:100px"
                            onkeypress="return chuyentiep(event,'nhacct')" value="" />
                        <!-- <input type="text" name="tuvan" placeholder="Mã NV"  id="tuvan" class="inpl" ondblclick="this.value=''" style="width:60px" onkeypress="return chuyentiep(event,'nhacct')"   value="" />
	&nbsp;
                <input type="text" name="ten" id="ten"  placeholder="Tên NV"  class="inpl" ondblclick="this.value=''" style="width:60px" onkeypress="return chuyentiep(event,'nhacct')"   value="" />
                <input type="text" name="sotien" placeholder="Số tiền"  id="sotien" class="inpl" ondblclick="this.value=''" style="width:60px" onkeypress="return chuyentiep(event,'nhacct')"   value="" />
                <input type="text" name="hoadon" placeholder="Số hóa đơn"  id="hoadon" class="inpl" ondblclick="this.value=''" style="width:70px" onkeypress="return chuyentiep(event,'nhacct')"   value="" />-->
                        <select onkeypress="return chuyentiep(event,'idnhan')" name="cuahang" id="cuahang" class="js-ch"
                            style="width:180px" title="cửa hàng"> {tatca} {kho} </select>
                        <select onkeypress="return chuyentiep(event,'idnhan')" name="loaithuchi" id="loaithuchi"
                            style="width:50px" title="Tình trạng">
                            <option value="" selected="selected">Loại</option>
                            <option value="1">Thu</option>
                            <option value="2">Chi</option>
                        </select>
                        <select onkeypress="return chuyentiep(event,'idnhan')" name="nguoixacnhan" id="nguoixacnhan"
                            style="width:100px" title="Người xác nhận">
                            <option value="" selected="selected">Người xác nhận</option>
                            <option value="4">Điều hàng XN</option>
                            <option value="1">Thủ quỷ XN</option>
                            <option value="2">Kế toán Online XN</option>
                            <option value="3">Kế toán cửa hàng XN</option>
                        </select>
                        <select onkeypress="return chuyentiep(event,'idnhan')" name="tinhtrang" id="tinhtrang"
                            style="width:115px" title="Tình trạng">
                            <option value="" selected="selected">Tình trạng Duyệt</option>
                            <option value="0">Chưa duyệt</option>
                            <option value="1">Chưa duyệt có lý do</option>
                            <option value="2">Yêu cầu chỉnh sửa</option>
                            <option value="5">Đã chỉnh sửa</option>
                            <option value="3">Không duyệt</option>
                            <option value="4">Đã duyệt</option>
                        </select> Ngày <input onkeypress="return chuyentiep(event,'denngay')"
                            title="Click đôi để xoá trắng" ondblclick="xoatrang(this)" type="text" name="tungay"
                            id="tungay" class="text" style="width:65px" value="{tungay}" />
                        <img src="images/img.gif" id="Lichtungaytao2" style="cursor: pointer; border: 0px solid red;"
                            title="Date selector" onclick="displayCalendar(frmProduct1.tungay,'dd/mm/yyyy',this)" />đến
                        <input onkeypress="return chuyentiep(event,'denngay')" title="Click đôi để xoá trắng"
                            ondblclick="xoatrang(this)" type="text" name="denngay" id="denngay" class="text"
                            style="width:65px" value="{denngay}" /><img src="images/img.gif" id="Lichtungaytao2"
                            style="cursor: pointer; border: 0px solid red;" title="Date selector"
                            onclick="displayCalendar(frmProduct1.denngay,'dd/mm/yyyy',this)" />
                        <select onkeypress="return chuyentiep(event,'idnhan')" name="loc" class="js-loc" id="loc"
                            style="width:115px" title="Lọc theo">
                            <option value=""></option>
                            <option value="1">HĐBH</option>
                            <option value="2">STKNH</option>
                            <option value="3">Tên TKNH</option>
                            <option value="4">Mã vận đơn</option>
                            <option value="5">Đơn vị vận chuyển</option>
                            <option value="8">NCC</option>
                            <option value="9">Mã NV</option>
                            <option value="10">Phiếu xuất</option>
                            <option value="11">Tài khoản nợ</option>
                            <option value="12">Tài khoản có</option>
                        </select>
                        <select onkeypress="return chuyentiep(event,'idnhan')" name="dinhkhoantim"
                            class="js-dinhkhoantim" id="dinhkhoantim" style="width:200px" title="Định khoản"
                            onchange="">
                            <option value=""></option> {dinhkhoanthuchi}
                        </select>
                        <select onkeypress="return chuyentiep(event,'idnhan')" name="tkno" class="js-tkno" id="tkno"
                            style="width:115px" title="Tài khoản nợ" onchange="">
                            <option value=""></option> {tkno}
                        </select>
                        <select onkeypress="return chuyentiep(event,'idnhan')" name="tkco" class="js-tkco" id="tkco"
                            style="width:115px" title="tài khoản có">
                            <option value=""></option> {tkco}
                        </select>
                        <input onkeypress="return chuyentiep(event,'denngay')" type="text" name="diengiai_"
                            id="diengiai_" class="text" style="width:100px" value="{diengiai_}"
                            placeholder='Diễn giải' />
                        <select onkeypress="return chuyentiep(event,'idnhan')" name="themtimkiem" class="js-themtimkiem"
                            id="themtimkiem" style="width:130px" title="Thêm điều kiện tìm"
                            onchange="themdieukiemtim(event)">
                            <option value="" selected="selected">Thêm điều kiện tìm</option>
                            <option value="stknh" data-id='14' title="Số tài khoản ngân hàng">STKNH</option>
                            <option value="tentknh" data-id='15' title="tên khoản ngân hàng">Tên TKNH</option>
                            <option value="mavd" data-id='16' title="mã vận đơn">Mã vận đơn</option>
                            <option value="dvvc" data-id='17' title="đơn vị vận chuyển">Đơn vị vận chuyển</option>
                            <option value="ncc" data-id='18' title="nhà cung cấp">NCC</option>
                            <option value="manv" data-id='19' title="mã nhân viên">Mã NV</option>
                            <option value="phieuxuat" data-id='20' title="phiếu xuất">Phiếu xuất</option>
                            <!-- <option value="tkno" data-id='t21tam' title="tài khoản nợ">Tài khoản nợ</option>
		 <option value="tkco" data-id='t22tam' title="tài khoản có">Tài khoản có</option>-->
                            <option value="diengiai" data-id='23' title="diễn giải">Diễn giải</option>
                            <option value="dinhkhoan" data-id='24' title="định khoản">Định khoản</option>
                            <option value="psno" data-id='25' title="phát sinh nợ">psno</option>
                            <option value="psco" data-id='26' title="phát sinh có">psco</option>
                            <option value="dongia" data-id='27' title="đơn giá">dongia</option>
                            <option value="soluong" data-id='28' title="Số lượng">soluong</option>
                            <option value="dvt" data-id='29' title="đơn vị tính">dvt</option>
                            <option value="ngaytao" data-id='30' title="ngày tạo phiếu">ngày tạo phiếu</option>
                        </select>
                        <input type="button"
                            onclick="return timphieu('' ,cuahang.value,tungay.value,denngay.value,tinhtrang.value,'',0,'',soct.value,loc.value,tkno.value,tkco.value,loaithuchi.value,nguoixacnhan.value)"
                            name="search" style="width:65px" id="search" value="Tim kiếm" />
                        <input type="button"
                            onclick="return timphieu('' ,cuahang.value,tungay.value,denngay.value,tinhtrang.value,'',0,'',soct.value,loc.value,tkno.value,tkco.value,loaithuchi.value,nguoixacnhan.value)"
                            name="search2" style="width:65px;display:none"  id=" search2 " value=" Gộp NV " />
						<input type="button" onclick=" xuatexel(1) " name=" search3 " style=" width:65px;display:none" id=" search3" value="Excel" />
                        <input type="button"
                            onclick="return timphieutonghop('' ,cuahang.value,tungay.value,denngay.value,tinhtrang.value,'',0,'',soct.value,loc.value,tkno.value,tkco.value,loaithuchi.value,nguoixacnhan.value,1,1)"
                            name="search" style="width:65px" id="search" value="Tổng hợp" />
                        
                        <input type="button"
                            onclick="return timphieutonghop('' ,cuahang.value,tungay.value,denngay.value,tinhtrang.value,'',0,'',soct.value,loc.value,tkno.value,tkco.value,loaithuchi.value,nguoixacnhan.value,1,5)"
                            name="search" style="width:auto" id="search" value="Tổng hợp chi tiết" />
                        
                        <input type="button"
                            onclick="return timphieutonghop('' ,cuahang.value,tungay.value,denngay.value,tinhtrang.value,'',0,'',soct.value,loc.value,tkno.value,tkco.value,loaithuchi.value,nguoixacnhan.value,1,2)"
                            name="search" style="width:auto" id="search" value="Báo cáo ĐH OL" />
                        
                        <input type="button"
                            onclick="return timphieutonghop('' ,cuahang.value,tungay.value,denngay.value,tinhtrang.value,'',0,'',soct.value,loc.value,tkno.value,tkco.value,loaithuchi.value,nguoixacnhan.value,1,3)"
                            name="search" style="width:auto" id="search" value="Báo cáo DHOLPD" />
                        
                        <input type="button"
                            onclick="return timphieutonghop('' ,cuahang.value,tungay.value,denngay.value,tinhtrang.value,'',0,'',soct.value,loc.value,tkno.value,tkco.value,loaithuchi.value,nguoixacnhan.value,1,4)"
                            name="search" style="width:auto" id="search" value="Báo cáo DSDH" />
                        
                        <input type="button"
                            onclick="return timphieutonghop('' ,cuahang.value,tungay.value,denngay.value,tinhtrang.value,'',0,'',soct.value,loc.value,tkno.value,tkco.value,loaithuchi.value,nguoixacnhan.value,1,6)"
                            name="search" style="width:auto" id="search" value="Báo cáo KTT/T" />
                        
                        <input type="button"
                            onclick="return timphieutonghop('' ,cuahang.value,tungay.value,denngay.value,tinhtrang.value,'',0,'',soct.value,loc.value,tkno.value,tkco.value,loaithuchi.value,nguoixacnhan.value,1,7)"
                            name="search" style="width:auto" id="search" value="Báo cáo công nợ" />
                        
                        <input type="button"
                            onclick="return timphieutonghop('' ,cuahang.value,tungay.value,denngay.value,tinhtrang.value,'',0,'',soct.value,loc.value,tkno.value,tkco.value,loaithuchi.value,nguoixacnhan.value,1,8)"
                            name="search" style="width:auto" id="search" value="Báo cáo Doanh thu" />
                        
                        <input type="button"
                            onclick="return timphieutonghop('' ,cuahang.value,tungay.value,denngay.value,tinhtrang.value,'',0,'',soct.value,loc.value,tkno.value,tkco.value,loaithuchi.value,nguoixacnhan.value,1,9)"
                            name="search" style="width:auto" id="search" value="Báo cáo TM" />
                        
                        <input type="button"
                            onclick="return timphieutonghop('' ,cuahang.value,tungay.value,denngay.value,tinhtrang.value,'',0,'',soct.value,loc.value,tkno.value,tkco.value,loaithuchi.value,nguoixacnhan.value,1,10)"
                            name="search" style="width:auto" id="search" value="Báo cáo NTTKQ" />
                        <input type="button" onclick="xuatexel(12)" name="search3" style="width:auto" id="search3"
                            value="Excel NTTKQ" />
                        <input type="button"
                            onclick="return timphieutonghop('' ,cuahang.value,tungay.value,denngay.value,tinhtrang.value,'',0,'',soct.value,loc.value,tkno.value,tkco.value,loaithuchi.value,nguoixacnhan.value,1,11)"
                            name="search" style="width:auto" id="search" value="Báo cáo kết tiền" />
                        <input type="button" onclick="xuatexel(13)" name="search3" style="width:auto" id="search3"
                            value="Excel Kết tiền" />
                        <input type="button" onclick="xuatexel(17)" name="search3" style="width:auto;display:none"
                            id="search3" value="Excel Lương Onl ĐH  đang xử lý" />
                        <input type="button"
                            onclick="return timphieutonghop('' ,cuahang.value,tungay.value,denngay.value,tinhtrang.value,'',0,'',soct.value,loc.value,tkno.value,tkco.value,loaithuchi.value,nguoixacnhan.value,1,15)"
                            name="search" style="width:auto" id="search" value="BC lý do trả hàng" />
                        <input type="button" onclick="xuatexel(18)" name="search3" style="width:auto" id="search3"
                            value="Exel lý do trả hàng" />
                        <input type="button"
                            onclick="return timphieutonghop('' ,cuahang.value,tungay.value,denngay.value,tinhtrang.value,'',0,'',soct.value,loc.value,tkno.value,tkco.value,loaithuchi.value,nguoixacnhan.value,1,16)"
                            name="search" style="width:auto" id="search" value="BC lý do trả hàng gộp" />
                        <input type="button" onclick="xuatkq()" name="search3" style="width:auto" id="search3"
                            value="Exel lý do trả hàng gộp" />
                        <input type="button"
                            onclick="return timphieutonghop('' ,cuahang.value,tungay.value,denngay.value,tinhtrang.value,'',0,'',soct.value,loc.value,tkno.value,tkco.value,loaithuchi.value,nguoixacnhan.value,1,17)"
                            name="search" style="width:auto" id="search" value="Tổng hợp thu chi" />
                        <input type="button" onclick="xuatkq()" name="search3" style="width:auto" id="search3"
                            value="Exel Tổng hợp thu chi" />
                    </div>
                    <div style="padding-top:0.5em;display:flex">
                        <div style="display:inline-block" id="themdieukiemtim_show"></div>
                    </div>
                    <span id="ghichuxoa" style="display:none;color:red">double click vào input để gỡ bỏ</span>
                    <div id="httim" style="padding-bottom:3em ">
                    </div>
                    <div id="httimexel" style="display:none "></div>
                    <div id="khonghienthi" style="display: "></div>
                </div>
            </div>
        </div>
</form>
<form name="xuatketqua" id="xuatketqua" action="xuatfilexelkt.php" method="post" target="_blank">
    <input type="hidden" id="dataexel" name="dataexel" />
    <input type="hidden" id="tonghop" name="tonghop" />
    <!--<input type="submit" name="btnxuatexel" value="xuatexel"/>-->
</form>
</form>
<form name="xuatketqua1" id="xuatketqua1" action="xuatfile.php" method="post" target="_blank">
    <input name="noidung" id="noidung" type="hidden" value="Chưa chọn dữ liệu">
    <input name="tenfile" id="tenfile" type="hidden" value="baocaoluongonline.xls">
    <input name="loaifile" id="loaifile" type="hidden" value="application/vnd.ms-excel">
</form>
</div>
<style>
    #poupduyet {
        display: none;
        width: 100%;
        height: 120vh;
        position: fixed;
        left: 0;
        top: 0;
        align-items: center;
        justify-content: center;
        z-index: 100;
        background-color: #00000045;
    }
</style>
<div id="poupduyet">
</div>
<script src="js/jquery-1.7.2.min.js"></script>
<script src="js/select2.min.js"></script>
<link rel="stylesheet" media="screen" href="js/select2.min.css">
<script language="JavaScript">
    function dongformkxd() {

        $("#tknokxd").val("");
        $("#tknokxd").trigger("change");
        $("#tkcokxd").val("")
        $("#tkcokxd").trigger("change");
        $("#modal_tkno_co").css("display", "none");
    }

    function showformkxd() {
        $("#modal_tkno_co").css("display", "flex");

    }

    function getValue(e) {
        console.log($(e.target).select2('val'))
    }

    $(document).ready(function () {

        $('.js-nv').select2();
        $('.js-tkno').select2({
            multiple: true,
            placeholder: "tài khoản nợ",

        });
        $('.js-dinhkhoantim').select2({
            multiple: true,
            placeholder: "Định khoản thu chi",

        });
        $('.js-tkco').select2({
            multiple: true,
            placeholder: "tài khoản có",

        });
        $('.js-tknokxd').select2({

            placeholder: "tài khoản nợ",

        });
        $('.js-tkcokxd').select2({

            placeholder: "tài khoản có",

        });

        $('.js-loc').select2();
        $('.js-themtimkiem').select2();
        $('.js-ch').select2();
    });



    function xuatkq() {
        document.getElementById("noidung").value = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><html><body>' + document.getElementById("showtb_xuat").innerHTML + "</body></html>";
        // alert( document.getElementById("xuatketqua1").value);
        document.getElementById("xuatketqua1").submit();
    }


    //============================================================

    var capnhap = '';


    function ask() {
        var n = confirm("Bạn có muốn xóa không");
        if (n == false) {
            return false;

        }
    }
    //=======================
    function setHeight() {
        var tb1 = document.getElementById("dopcccc").rows;

        var tb2 = document.getElementById("dopcccc1").rows;
        for (var j = 0; j < tb1.length; j++) {
            var maxheight = 0;
            var tr1 = tb1[j];
            var tr2 = tb2[j];
            var maxheight = tr1.offsetHeight;
            if (tr1.offsetHeight < tr2.offsetHeight) {
                maxheight = tr2.offsetHeight;
            }
            if (tr1.getElementsByTagName('td')[1]) {
                tr1.getElementsByTagName('td')[1].height = (maxheight + 10) + "px";
                tr2.getElementsByTagName('td')[1].height = (maxheight + 10) + "px";
            }

        }

    }


    var curentpage = 1;
    var curentpage2 = 1;
    var curentpage3 = 1;
    var totalpage = 0;
    var limit = 500;
    var tonghop = false;
    var t1tam = '';
    t2tam = '';
    t3tam = '';
    t4tam = '';
    t5tam = '';
    t6tam = '';
    t7tam = '';
    t8tam = '';
    t9tam = '';
    t10tam = '';
    t11tam = '';
    t12tam = '';
    t13tam = '';
    t14tam = '';
    t15tam = '';
    t16tam = '';
    t17tam = '';
    t18tam = '';
    t19tam = '';
    t20tam = '';
    t21tam = '';
    t22tam = '';
    t23tam = '';
    t24tam = '';
    t25tam = '';
    t26tam = '';
    t27tam = '';
    t28tam = '';
    t29tam = '';
    t30tam = '';
    t31tam = '';
    t32tam = '';
    t34tam = '';
    t35tam = '';
    t36tam = '';
    t37tam = ''

    function timphieu(t1, t2, t3, t4, t5, t6, t7, t8, t9, t10, t11, t12, t32, t34, t13 = 1, t33 = '', t36 = '', t37 = '', t38 = '') {
        tonghop = false;
        //console.log(t32);
        //return;
        t1tam = t1;
        t2tam = t2;
        t3tam = t3;
        t4tam = t4;
        t5tam = t5;
        t6tam = t6;
        t7tam = t7;
        t8tam = t8;
        t9tam = t9;
        t10tam = t10;
        t13tam = t13;
        t32tam = t32;
        t34tam = t34;
        t35tam = '';
        //get thêm dieu kien
        if (document.getElementById("stknh")) {
            t14tam = document.getElementById("stknh").value;
        }
        if (document.getElementById("tentknh")) {
            t15tam = document.getElementById("tentknh").value;
        }
        if (document.getElementById("mavd")) {
            t16tam = document.getElementById("mavd").value;
        }
        if (document.getElementById("dvvc")) {
            t17tam = document.getElementById("dvvc").value;
        }
        if (document.getElementById("ncc")) {
            t18tam = document.getElementById("ncc").value;
        }
        if (document.getElementById("manv")) {
            t19tam = document.getElementById("manv").value;
        }
        if (document.getElementById("phieuxuat")) {
            t20tam = document.getElementById("phieuxuat").value;
        }
        if (document.getElementById("tkno")) {
            t21tam = document.getElementById("tkno").value;
        }
        if (document.getElementById("tkco")) {
            t22tam = document.getElementById("tkco").value;
        }
        if (document.getElementById("diengiai")) {
            t23tam = document.getElementById("diengiai").value;
        } else {
            t23tam = document.getElementById("diengiai_").value;
        }
        if (document.getElementById("dinhkhoan")) {
            t24tam = document.getElementById("dinhkhoan").value;
        }
        if (document.getElementById("psno")) {
            t25tam = document.getElementById("psno").value;
        }
        if (document.getElementById("psco")) {
            t26tam = document.getElementById("psco").value;
        }
        if (document.getElementById("dongia")) {
            t27tam = document.getElementById("dongia").value;
        }
        if (document.getElementById("soluong")) {
            t28tam = document.getElementById("soluong").value;
        }
        if (document.getElementById("dvt")) {
            t29tam = document.getElementById("dvt").value;
        }

        if (document.getElementById("ngaythuchitu")) {
            t30tam = document.getElementById("ngaythuchitu").value;
        }
        if (document.getElementById("ngaythuchiden")) {
            t31tam = document.getElementById("ngaythuchiden").value;
        }
        var tknoval = $(".js-tkno").select2('val');
        var tkcoval = $(".js-tkco").select2('val');
        if (tknoval) {
            for (var i = 0; i < tknoval.length; i++) {
                if (tknoval[i]) {
                    if (t11) {
                        t11 += "," + tknoval[i];
                    } else {
                        t11 += tknoval[i];
                    }
                }
            }
        }
        if (tkcoval) {
            for (var i = 0; i < tkcoval.length; i++) {
                if (tkcoval[i]) {
                    if (t12) {
                        t12 += "," + tkcoval[i];
                    } else {
                        t12 += tkcoval[i];
                    }
                }
            }
        }

        var dinhkhoantim = $(".js-dinhkhoantim").select2('val');
        if (dinhkhoantim) {
            for (var i = 0; i < dinhkhoantim.length; i++) {
                if (dinhkhoantim[i]) {
                    if (t35tam) {
                        t35tam += "," + dinhkhoantim[i];
                    } else {
                        t35tam += dinhkhoantim[i];
                    }
                }
            }
        }
        //t11=t11.slice(0, -1);
        //t12=t12.slice(0, -1);

        t11tam = t11;
        t12tam = t12;


        poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(t2) + "*@!" + encodeURIComponent(t3) + "*@!" + encodeURIComponent(t4);
        poststr = poststr + "*@!" + encodeURIComponent(t5) + "*@!" + encodeURIComponent(t6) + "*@!" + encodeURIComponent(t7) + "*@!" + encodeURIComponent(t8) + "*@!" + encodeURIComponent(t9) + "*@!" + encodeURIComponent(t10) + "*@!" + encodeURIComponent(t11) + "*@!" + encodeURIComponent(t12) + "*@!" + encodeURIComponent(t13);
        poststr = poststr + "*@!" + encodeURIComponent(t14tam) + "*@!" + encodeURIComponent(t15tam) + "*@!" + encodeURIComponent(t16tam) + "*@!" + encodeURIComponent(t17tam) + "*@!" + encodeURIComponent(t18tam) + "*@!" + encodeURIComponent(t19tam) + "*@!" + encodeURIComponent(t20tam) + "*@!" + encodeURIComponent(t21tam) + "*@!" + encodeURIComponent(t22tam) + "*@!" + encodeURIComponent(t23tam) + "*@!" + encodeURIComponent(t24tam) + "*@!" + encodeURIComponent(t25tam) + "*@!" + encodeURIComponent(t26tam) + "*@!" + encodeURIComponent(t27tam) + "*@!" + encodeURIComponent(t28tam) + "*@!" + encodeURIComponent(t29tam) + "*@!" + encodeURIComponent(t30tam) + "*@!" + encodeURIComponent(t31tam) + "*@!" + encodeURIComponent(t32) + "*@!" + encodeURIComponent(limit) + "*@!" + encodeURIComponent(t34tam) + "*@!" + encodeURIComponent(t35tam) + "*@!" + encodeURIComponent(t36) + "*@!" + encodeURIComponent(t37) + "*@!" + encodeURIComponent(t38);

        if (t7 == 1) loadtrang('httim', "thuonghoadongoptim", poststr, "");
        else loadtrang('httim', "thuchiktbaocaotim", poststr, "xuly4");

    }

    // bộc lọc theo cột
    function setDataMang() {
        var datajson = document.getElementById('data_mang_json').innerHTML;

        localStorage.setItem("dulieutonghop", datajson);
    }

    function getDataMang(id) {
        var result = localStorage.getItem(id);

        if (result) {
            return JSON.parse(result);
        }
        return;

    }

    function getDataMangTk() {
        var result = document.getElementById('data_mang_tk_json').innerHTML;

        if (result) {
            return JSON.parse(result);
        }
        return;

    }

    function getDataMangTon() {
        var result = document.getElementById('data_mang_cuahangtam_json').innerHTML;

        if (result) {
            return JSON.parse(result);
        }
        return;

    }

    function showFilter(id) {
        var fil = document.getElementById(id);
        var fils = document.getElementsByClassName("select_filter");

        if (fil.classList.contains('show_fil')) {
            fil.classList.remove("show_fil");
        } else {

            for (var i = 0; i < fils.length; i++) {
                fils[i].classList.remove("show_fil");
            }
            fil.classList.add("show_fil");
        }
    }

    function filter_column(type) {

        var data = getDataMang('dulieutonghop');

        var mangfill = [];
        var checkboxdata = document.getElementsByClassName(type);
        for (var i = 0; i < checkboxdata.length; i++) {
            if (checkboxdata[i].checked) {
                mangfill.push(checkboxdata[i].value);
            }
        }

    }
    var filterKhuvuc = false;
    var filtergopmien = false;
    var filtergoptinh = false;
    function checked_column(e, type) {
        var target = e.target;
        var data = getDataMang('dulieutonghop');
        var fillname = target.getAttribute('fill-name');
        var datafill = target.getAttribute('data-fill');
        var mangfilltam = [];
        if (datafill) {
            datafill = JSON.parse(datafill);
            if (datafill) {
                for (x in datafill) {
                    if (datafill[x]) {
                        mangfilltam.push(x);
                        for (y in datafill[x]) {
                            mangfilltam.push(y);
                        }
                    }
                }
            }
        }

        var checkboxdata = document.getElementsByClassName(type);
        var hidden_when_all = document.getElementsByClassName("hidden_when_all");

        if (!target.checked) {
            document.getElementById("checkall_" + type).checked = false;
            if (type == "tencuahang") {
                var uncheckall = 0;
                for (var i = 0; i < checkboxdata.length; i++) {
                    if (mangfilltam) {

                        if (mangfilltam.includes(checkboxdata[i].value)) {
                            checkboxdata[i].checked = false;
                            uncheckall++;
                        }
                    } else {

                        if (checkboxdata[i].checked == false) {
                            uncheckall++;
                        }
                    }
                }

                if (uncheckall == checkboxdata.length) {

                    for (var i = 0; i < hidden_when_all.length; i++) {
                        hidden_when_all[i].style.display = "none"
                        // delete mangfill[checkboxdata[i].value];
                    }
                    return;
                }
            }
        } else {
            var ischeckall = true;
            for (var i = 0; i < checkboxdata.length; i++) {
                if (mangfilltam) {
                    if (mangfilltam.includes(checkboxdata[i].value)) {
                        checkboxdata[i].checked = true;
                        uncheckall++;
                    }
                } else {

                    if (!checkboxdata[i].checked) {
                        ischeckall = false
                    }
                }
            }
            if (ischeckall) {
                document.getElementById("checkall_" + type).checked = true;
            }
        }


        var data = getDataMang('dulieutonghop');

        var mangfill = [];
        for (var i = 0; i < checkboxdata.length; i++) {
            if (checkboxdata[i].checked) {
                mangfill.push(checkboxdata[i].value);
            }
        }

        if (type == "tencuahang") {
            for (var i = 0; i < hidden_when_all.length; i++) {
                hidden_when_all[i].style.display = "table-cell"
                // delete mangfill[checkboxdata[i].value];
            }
        }
        if (type == "khoanmuctc" && filterKhuvuc) {
            console.log("mangfillmangfill", mangfill)
            for (var i = 0; i < hidden_when_all.length; i++) {
                hidden_when_all[i].style.display = "none"
                // delete mangfill[checkboxdata[i].value];
            }
            filldataTong(type, data, mangfill);
            return;
        }

        if (type == "khoanmuctc" && filtergopmien) {

            fillGop(type, data, mangfill);
            return;
        }
        if (type == "khoanmuctc" && filtergoptinh) {

            fillGopTinh(type, data, mangfill);
            return;
        }
        filldataShow(type, data, mangfill);
    }
    var mangluulai = [];

    function filldataShow(type, data, mangfill) {
        filterKhuvuc = false;
        filtergopmien = false;
        filtergoptinh = false;
        var mangtk = getDataMangTk();
        var mangton = getDataMangTon();
        var h = 0;
        var chuoithml = '';
        var chuoithmltam1 = ''

        for (mamien in data) {
            if (mamien) {
                h++;

                chuoithml += "<tr style='background-color: #ff98006e;'><td>" + h + "</td><td style='    background-color: #ff9800; color: #ffffff;'>" + mamien + "</td><td colspan='7'></td></tr>";

                for (khuvuc in data[mamien]) {

                    if (khuvuc) {
                        h++;
                        chuoithml += "<tr style='background-color: #ff98006e;'><td>" + h + "</td><td style='    background-color: #ff9800; color: #ffffff;'>" + khuvuc + "</td><td colspan='7'></td></tr>";


                        for (cuahang in data[mamien][khuvuc]) {
                            console.log(cuahang);
                            console.log(data[mamien][khuvuc]);

                            //filter
                            if (type == "tencuahang") {
                                if (!mangfill.includes(cuahang)) {
                                    continue;
                                }
                            }
                            var tongpsno = 0;
                            var tongpsco = 0;
                            var tongpsnoco = 0;
                            chuoithmltam1 += "<tr style='background-color: #0096886e;'>";
                            var chuoithmltam2 = '';
                            h++;



                            for (ngay in data[mamien][khuvuc][cuahang]) {

                                var ngaytam = '';

                                var tongtiematketve = 0;
                                for (dinhkhoan in data[mamien][khuvuc][cuahang][ngay]) {
                                    var valueg = data[mamien][khuvuc][cuahang][ngay][dinhkhoan];
                                    var style = '';
                                    //filter
                                    if (type == "khoanmuctc") {
                                        if (!mangfill.includes(dinhkhoan)) {
                                            continue;
                                        }
                                    }

                                    //filter
                                    if (type == "tkno") {
                                        if (!mangfill.includes(valueg.tkno)) {
                                            continue;
                                        }
                                    }
                                    //filter
                                    if (type == "tkco") {
                                        if (!mangfill.includes(valueg.tkco)) {
                                            continue;
                                        }
                                    }
                                    tongpsno += valueg.psno * 1;
                                    tongpsco += valueg.psco * 1;
                                    tongpsnoco += valueg.tongpsnoco * 1;
                                    if (dinhkhoan != 'TL' && dinhkhoan != 'TLDK') {

                                        tongtiematketve += valueg.psno * 1;
                                        tongtiematketve -= valueg.psco * 1;

                                    }


                                    if (ngay != ngaytam) {

                                        style = " style='background-color: #3f51b5a8;color: #ffffff'";
                                        ngaytam = ngay;
                                    }

                                    var tkno = mangtk[valueg.tkno] ? mangtk[valueg.tkno] : "";
                                    var tkco = mangtk[valueg.tkco] ? mangtk[valueg.tkco] : ""
                                    if (chuoithmltam2 == "") {
                                        chuoithmltam2 += "<td>" + h + "</td><td style='background-color: #009688; color: #ffffff'>" + cuahang + "</td><td " + style + " class='hidden_when_all'>" + ngay + "</td>";
                                        chuoithmltam2 += "<td  class=''>" + valueg.khoanmuctc + "</td><td  class='hidden_when_all'>" + tkno + "</td><td  class='hidden_when_all'>" + tkco + "</td><td>" + formatso(valueg.psno) + "</td><td>" + formatso(valueg.psco) + "</td><td>" + formatso(valueg.tongpsnoco) + "</td></tr>";

                                    } else {

                                        chuoithmltam2 += "<tr><tr><td>" + h + "</td><td></td><td " + style + "  class='hidden_when_all'>" + ngay + "</td><td  class=''>" + valueg.khoanmuctc + "</td><td  class='hidden_when_all'>" + tkno + "</td><td  class='hidden_when_all'>" + tkco + "</td><td>" + formatso(valueg.psno) + "</td><td>" + formatso(valueg.psco) + "</td><td>" + formatso(valueg.tongpsnoco) + "</td></tr></tr>";
                                    }
                                    h++;
                                    mangluulai[mamien] = data;

                                }
                            }

                            var tongton = mangton[cuahang].tongton ? formatso(mangton[cuahang].tongton) : 0;
                            //var tongtm='';
                            //var tongtm='';(mangton[cuahang].tongtoncu)
                            var tongtm = mangton[cuahang].tongton * 1 + tongtiematketve * 1;
                            chuoithmltam1 += chuoithmltam2;
                            chuoithmltam1 += "<tr style='background-color: #9e9e9e47;'><td>" + h + "</td><td></td><td>Tổng</td><td></td><td></td><td></td><td style='color: #3f51b5;'>" + formatso(tongpsno) + "</td><td style='color: #3f51b5;'>" + formatso(tongpsco) + "</td><td style='color: #3f51b5;'>" + formatso(tongpsnoco) + "</td></tr>";

                            chuoithmltam1 += "<tr style='background-color: #9e9e9e47;'><td>" + h + "</td><td></td><td>Tổng tồn</td><td  style='text-align:center;color: #ff5722;'>" + tongton + "</td><td>Tổng TM</td><td style='text-align:center;color: #ff5722;' colspan='4'>" + formatso(tongtm) + " <span style='margin-left:30px;font-style:italic'>(*) Không cộng tiền lẻ và tiền lẻ đầu kỳ</span></td></tr>";
                        }
                        chuoithml += chuoithmltam1;
                        chuoithmltam1 = '';
                    }
                }
            }
        }


        document.getElementById("show_dulieu_mang").innerHTML = chuoithml;
    }


    function checked_all(e, type) {

        var target = e.target;
        var data = getDataMang('dulieutonghop');
        var checkboxdata = document.getElementsByClassName(type);
        var hidden_when_all = document.getElementsByClassName("hidden_when_all");
        var mangfill = [];
        if (!target.checked) {
            for (var i = 0; i < checkboxdata.length; i++) {
                checkboxdata[i].checked = false
                // delete mangfill[checkboxdata[i].value];

            }
            if (type == 'tencuahang') {

                filldataTong(type, data);

                for (var i = 0; i < hidden_when_all.length; i++) {
                    hidden_when_all[i].style.display = "none"

                }
                return;
            }



        } else {
            for (var i = 0; i < checkboxdata.length; i++) {
                checkboxdata[i].checked = true
                mangfill.push(checkboxdata[i].value);
            }

            for (var i = 0; i < hidden_when_all.length; i++) {
                hidden_when_all[i].style.display = "table-cell"


            }


            if (type == 'khoanmuctc') {
                if (filterKhuvuc) {
                    filldataTong(type, data, mangfill);
                    for (var i = 0; i < hidden_when_all.length; i++) {
                        hidden_when_all[i].style.display = "none"

                    }
                }
                if (filtergopmien) {
                    fillGop(type, data, mangfill);
                    for (var i = 0; i < hidden_when_all.length; i++) {
                        hidden_when_all[i].style.display = "none"

                    }
                }
                if (filtergoptinh) {
                    fillGopTinh(type, data, mangfill);
                    for (var i = 0; i < hidden_when_all.length; i++) {
                        hidden_when_all[i].style.display = "none"

                    }
                }


                return;
            }

            /*if (type == "khoanmuctc" && filtergoptinh) {
        	
                fillGopTinh(type, data, mangfill);
                return;
            }*/
            filldataShow(type, data, mangfill);
        }
    }

    function checkFillGop(e, type) {
        var target = e.target;
        var data = getDataMang('dulieutonghop');
        var hidden_when_all = document.getElementsByClassName("hidden_when_all");

        if (target.checked) {


            if (type == 'gopmien') {
                fillGop(type);
            }
            if (type == 'goptinh') {
                fillGopTinh(type);
            }

            for (var i = 0; i < hidden_when_all.length; i++) {
                hidden_when_all[i].style.display = "none"

            }
        }
        else {
            filldataShow(type, data, []);
            for (var i = 0; i < hidden_when_all.length; i++) {
                hidden_when_all[i].style.display = "table-cell"

            }
        }


    }
    function fillGopTinh(type, data = '', mangfill = '') {

        filterKhuvuc = false;
        filtergopmien = false;
        filtergoptinh = true;
        var mangtk = getDataMangTk();
        var mangton = getDataMangTon();
        var data = getDataMang('dulieutonghop');
        var h = 0;
        var chuoithml = '';
        var chuoithmltam1 = ''

        var mangloc = {};
        for (mamien in data) {


            for (khuvuc in data[mamien]) {
                var psno = 0;
                var psco = 0;
                var tongpsnoco = 0;
                var tongton = 0;
                var tongtm = 0
                if (mamien) {
                    if (!mangloc[khuvuc]) {
                        mangloc = {
                            ...mangloc,
                            [khuvuc]: {
                                data: {},
                                psno: 0, psco: 0, tongpsnoco: 0, tongton: 0, tongtm: 0
                            }
                        }

                    }
                    for (cuahang in data[mamien][khuvuc]) {
                        var chuoithmltam2 = '';
                        h++;
                        for (ngay in data[mamien][khuvuc][cuahang]) {
                            var ngaytam = '';
                            var tongtiematketve = 0;
                            for (dinhkhoan in data[mamien][khuvuc][cuahang][ngay]) {

                                //fillter
                                if (mangfill && !mangfill.includes(dinhkhoan)) {
                                    continue;
                                }
                                var valueg = data[mamien][khuvuc][cuahang][ngay][dinhkhoan];
                                var style = '';
                                if (dinhkhoan != 'TL' && dinhkhoan != 'TLDK') {
                                    tongtiematketve += valueg.psno * 1;
                                    tongtiematketve -= valueg.psco * 1;

                                }
                                valueg.psno = valueg.psno ? (valueg.psno * 1) : 0
                                psno += valueg.psno;
                                psco += valueg.psco;
                                tongpsnoco += valueg.tongpsnoco;
                                if (!mangloc[khuvuc].data[dinhkhoan]) {
                                    mangloc[khuvuc].data[dinhkhoan] = { tongpsno: 0, tongpsco: 0, tongpsnoco: 0, ten: valueg.khoanmuctc }
                                    mangloc[khuvuc].data[dinhkhoan] = { ...mangloc[khuvuc].data[dinhkhoan], tongpsno: mangloc[khuvuc].data[dinhkhoan].tongpsno += valueg.psno }
                                    mangloc[khuvuc].data[dinhkhoan] = { ...mangloc[khuvuc].data[dinhkhoan], tongpsco: mangloc[khuvuc].data[dinhkhoan].tongpsco += valueg.psco }
                                    mangloc[khuvuc].data[dinhkhoan] = { ...mangloc[khuvuc].data[dinhkhoan], tongpsnoco: mangloc[khuvuc].data[dinhkhoan].tongpsnoco += valueg.tongpsnoco }

                                } else {

                                    mangloc[khuvuc].data[dinhkhoan] = { ...mangloc[khuvuc].data[dinhkhoan], tongpsno: mangloc[khuvuc].data[dinhkhoan].tongpsno += valueg.psno }
                                    mangloc[khuvuc].data[dinhkhoan] = { ...mangloc[khuvuc].data[dinhkhoan], tongpsco: mangloc[khuvuc].data[dinhkhoan].tongpsco += valueg.psco }
                                    mangloc[khuvuc].data[dinhkhoan] = { ...mangloc[khuvuc].data[dinhkhoan], tongpsnoco: mangloc[khuvuc].data[dinhkhoan].tongpsnoco += valueg.tongpsnoco }
                                }
                            }
                        }

                        tongton += (mangton[cuahang].tongton * 1) ? (mangton[cuahang].tongton * 1) : 0;
                        tongtm += ((mangton[cuahang].tongton * 1) + (tongtiematketve * 1));
                    }
                    mangloc[khuvuc]['tongton'] += tongton
                    mangloc[khuvuc]['tongtm'] += tongtm
                    mangloc[khuvuc]['psno'] += psno
                    mangloc[khuvuc]['psco'] += psco
                    mangloc[khuvuc]['tongpsnoco'] += tongpsnoco
                }


            }
        }


        h = 0;
        console.log(mangloc);
        
        var chuoithmltam1 = ''
        var chuoithmltam2 = ''
        var mangloctam = { ...mangloc };

        for (x in mangloctam) {

            var tongpsno = 0;
            var tongpsco = 0;
            var tongpsnoco = 0;

            valueg = mangloctam[x];
            h++;
            chuoithmltam2 += "<tr><td>" + h + "</td><td style='background-color: #009688; color: #ffffff' colspan='5'>" + x + "</td></tr>";
            for (y in valueg.data) {
                valuey = valueg.data[y];
                h++;
                tongpsno += valuey.tongpsno;
                tongpsco += valuey.tongpsco;
                tongpsnoco += valuey.tongpsnoco;
                chuoithmltam2 += "<tr><td>" + h + "</td><td></td>";
                chuoithmltam2 += "<td  class=''>" + valuey.ten + "</td><td>" + formatso(valuey.tongpsno) + "</td><td>" + formatso(valuey.tongpsco) + "</td><td>" + formatso(valuey.tongpsnoco) + "</td></tr>";
            }
            chuoithmltam2 += "<tr style='background-color: #9e9e9e47;'><td>" + h + "</td><td>Tổng</td><td></td><td style='color: #3f51b5;'>" + formatso(tongpsno) + "</td><td style='color: #3f51b5;'>" + formatso(tongpsco) + "</td><td style='color: #3f51b5;'>" + formatso(tongpsnoco) + "</td></tr>";

            chuoithmltam2 += "<tr style='background-color: #9e9e9e47;'><td>" + h + "</td><td>Tổng tồn</td><td></td><td  style='text-align:center;color: #ff5722;'>" + formatso(valueg['tongton']) + "</td><td>Tổng TM</td><td style='text-align:center;color: #ff5722;'>" + formatso(valueg['tongtm']) + " <span style='margin-left:30px;font-style:italic'><br>(*) Không cộng tiền lẻ và tiền lẻ đầu kỳ</span></td></tr>";


        }



        document.getElementById("show_dulieu_mang").innerHTML = chuoithmltam2;
    }
    function fillGop(type, data = '', mangfill = '') {

        filterKhuvuc = false;
        filtergoptinh = false;
        filtergopmien = true;
        var mangtk = getDataMangTk();
        var mangton = getDataMangTon();
        var data = getDataMang('dulieutonghop');
        var h = 0;
        var chuoithml = '';
        var chuoithmltam1 = ''

        var mangloc = {};
        for (mamien in data) {
            var psno = 0;
            var psco = 0;
            var tongpsnoco = 0;
            var tongton = 0;
            var tongtm = 0
            if (mamien) {
                if (!mangloc[mamien]) {
                    mangloc = {
                        ...mangloc,
                        [mamien]: {
                            data: {},
                            psno: 0, psco: 0, tongpsnoco: 0, tongton: 0, tongtm: 0
                        }
                    }

                }

                for (khuvuc in data[mamien]) {
                    for (cuahang in data[mamien][khuvuc]) {
                        var chuoithmltam2 = '';
                        h++;
                        for (ngay in data[mamien][khuvuc][cuahang]) {
                            var ngaytam = '';
                            var tongtiematketve = 0;
                            for (dinhkhoan in data[mamien][khuvuc][cuahang][ngay]) {

                                //fillter
                                if (mangfill && !mangfill.includes(dinhkhoan)) {
                                    continue;
                                }
                                var valueg = data[mamien][khuvuc][cuahang][ngay][dinhkhoan];
                                var style = '';
                                if (dinhkhoan != 'TL' && dinhkhoan != 'TLDK') {
                                    tongtiematketve += valueg.psno * 1;
                                    tongtiematketve -= valueg.psco * 1;

                                }
                                valueg.psno = valueg.psno ? (valueg.psno * 1) : 0
                                psno += valueg.psno;
                                psco += valueg.psco;
                                tongpsnoco += valueg.tongpsnoco;
                                if (!mangloc[mamien].data[dinhkhoan]) {
                                    mangloc[mamien].data[dinhkhoan] = { tongpsno: 0, tongpsco: 0, tongpsnoco: 0, ten: valueg.khoanmuctc }
                                    mangloc[mamien].data[dinhkhoan] = { ...mangloc[mamien].data[dinhkhoan], tongpsno: mangloc[mamien].data[dinhkhoan].tongpsno += valueg.psno }
                                    mangloc[mamien].data[dinhkhoan] = { ...mangloc[mamien].data[dinhkhoan], tongpsco: mangloc[mamien].data[dinhkhoan].tongpsco += valueg.psco }
                                    mangloc[mamien].data[dinhkhoan] = { ...mangloc[mamien].data[dinhkhoan], tongpsnoco: mangloc[mamien].data[dinhkhoan].tongpsnoco += valueg.tongpsnoco }

                                } else {

                                    mangloc[mamien].data[dinhkhoan] = { ...mangloc[mamien].data[dinhkhoan], tongpsno: mangloc[mamien].data[dinhkhoan].tongpsno += valueg.psno }
                                    mangloc[mamien].data[dinhkhoan] = { ...mangloc[mamien].data[dinhkhoan], tongpsco: mangloc[mamien].data[dinhkhoan].tongpsco += valueg.psco }
                                    mangloc[mamien].data[dinhkhoan] = { ...mangloc[mamien].data[dinhkhoan], tongpsnoco: mangloc[mamien].data[dinhkhoan].tongpsnoco += valueg.tongpsnoco }
                                }
                            }
                        }

                        tongton += (mangton[cuahang].tongton * 1) ? (mangton[cuahang].tongton * 1) : 0;
                        tongtm += ((mangton[cuahang].tongton * 1) + (tongtiematketve * 1));
                    }

                }

                mangloc[mamien]['tongton'] += tongton
                mangloc[mamien]['tongtm'] += tongtm
                mangloc[mamien]['psno'] += psno
                mangloc[mamien]['psco'] += psco
                mangloc[mamien]['tongpsnoco'] += tongpsnoco
            }
        }


        h = 0;
        console.log(mangloc);
        

        var chuoithmltam1 = ''
        var chuoithmltam2 = ''
        var mangloctam = { ...mangloc };

        for (x in mangloctam) {
            valueg = mangloctam[x];

            var tongpsno = 0;
            var tongpsco = 0;
            var tongpsnoco = 0;

            h++;
            chuoithmltam2 += "<tr><td>" + h + "</td><td style='background-color: #009688; color: #ffffff' colspan='5'>" + x + "</td></tr>";
            for (y in valueg.data) {
                valuey = valueg.data[y];
                h++;
                tongpsno += valuey.tongpsno;
                tongpsco += valuey.tongpsco;
                tongpsnoco += valuey.tongpsnoco;
                chuoithmltam2 += "<tr><td>" + h + "</td><td></td>";
                chuoithmltam2 += "<td  class=''>" + valuey.ten + "</td><td>" + formatso(valuey.tongpsno) + "</td><td>" + formatso(valuey.tongpsco) + "</td><td>" + formatso(valuey.tongpsnoco) + "</td></tr>";
            }
            chuoithmltam2 += "<tr style='background-color: #9e9e9e47;'><td>" + h + "</td><td>Tổng</td><td></td><td style='color: #3f51b5;'>" + formatso(tongpsno) + "</td><td style='color: #3f51b5;'>" + formatso(tongpsco) + "</td><td style='color: #3f51b5;'>" + formatso(tongpsnoco) + "</td></tr>";

            chuoithmltam2 += "<tr style='background-color: #9e9e9e47;'><td>" + h + "</td><td>Tổng tồn</td><td></td><td  style='text-align:center;color: #ff5722;'>" + formatso(valueg['tongton']) + "</td><td>Tổng TM</td><td style='text-align:center;color: #ff5722;'>" + formatso(valueg['tongtm']) + " <span style='margin-left:30px;font-style:italic'><br>(*) Không cộng tiền lẻ và tiền lẻ đầu kỳ</span></td></tr>";


        }



        document.getElementById("show_dulieu_mang").innerHTML = chuoithmltam2;
    }
    function filldataTong(type, data, mangfill = '') {
        filterKhuvuc = true;
        filtergopmien = false;
        filtergoptinh = false;
        var mangtk = getDataMangTk();
        var mangton = getDataMangTon();

        var h = 0;
        var chuoithml = '';
        var chuoithmltam1 = ''
        var psno = 0;
        var psco = 0;
        var tongpsnoco = 0;
        var tongton = 0;
        var tongtm = 0
        var mangloc = { data: {}, psno: 0, psco: 0, tongpsnoco: 0 };
        for (mamien in data) {
            for (khuvuc in data[mamien]) {
                for (cuahang in data[mamien][khuvuc]) {
                    var chuoithmltam2 = '';
                    h++;
                    for (ngay in data[mamien][khuvuc][cuahang]) {
                        var ngaytam = '';
                        var tongtiematketve = 0;
                        for (dinhkhoan in data[mamien][khuvuc][cuahang][ngay]) {

                            //fillter
                            if (mangfill && !mangfill.includes(dinhkhoan)) {
                                continue;
                            }
                            var valueg = data[mamien][khuvuc][cuahang][ngay][dinhkhoan];
                            var style = '';
                            if (dinhkhoan != 'TL' && dinhkhoan != 'TLDK') {
                                tongtiematketve += valueg.psno * 1;
                                tongtiematketve -= valueg.psco * 1;

                            }
                            valueg.psno = valueg.psno ? (valueg.psno * 1) : 0
                            psno += valueg.psno;
                            psco += valueg.psco;
                            tongpsnoco += valueg.tongpsnoco;
                            if (!mangloc.data[dinhkhoan]) {
                                mangloc.data[dinhkhoan] = { tongpsno: 0, tongpsco: 0, tongpsnoco: 0, ten: valueg.khoanmuctc }
                                mangloc.data[dinhkhoan] = { ...mangloc.data[dinhkhoan], tongpsno: mangloc.data[dinhkhoan].tongpsno += valueg.psno }
                                mangloc.data[dinhkhoan] = { ...mangloc.data[dinhkhoan], tongpsco: mangloc.data[dinhkhoan].tongpsco += valueg.psco }
                                mangloc.data[dinhkhoan] = { ...mangloc.data[dinhkhoan], tongpsnoco: mangloc.data[dinhkhoan].tongpsnoco += valueg.tongpsnoco }

                            } else {

                                mangloc.data[dinhkhoan] = { ...mangloc.data[dinhkhoan], tongpsno: mangloc.data[dinhkhoan].tongpsno += valueg.psno }
                                mangloc.data[dinhkhoan] = { ...mangloc.data[dinhkhoan], tongpsco: mangloc.data[dinhkhoan].tongpsco += valueg.psco }
                                mangloc.data[dinhkhoan] = { ...mangloc.data[dinhkhoan], tongpsnoco: mangloc.data[dinhkhoan].tongpsnoco += valueg.tongpsnoco }
                            }
                        }
                    }
                    tongton += (mangton[cuahang].tongton * 1) ? (mangton[cuahang].tongton * 1) : 0;
                    tongtm += ((mangton[cuahang].tongton * 1) + (tongtiematketve * 1));
                }

            }
        }
        mangloc['tongton'] = tongton
        mangloc['tongtm'] = tongtm
        mangloc['psno'] = psno
        mangloc['psco'] = psco
        mangloc['tongpsnoco'] = tongpsnoco
        h = 0;
        var tongpsno = 0;
        var tongpsco = 0;
        var tongpsnoco = 0;

        var chuoithmltam1 = ''
        var chuoithmltam2 = ''
        var mangloctam = { ...mangloc.data };

        for (x in mangloctam) {
            valueg = mangloctam[x];
            h++;
            tongpsno += valueg.tongpsno;
            tongpsco += valueg.tongpsco;
            tongpsnoco += valueg.tongpsnoco;


            chuoithmltam2 += "<tr><td>" + h + "</td><td style='background-color: #009688; color: #ffffff'></td><td " + style + " class='hidden_when_all' style='display:none'></td>";
            chuoithmltam2 += "<td  class=''>" + valueg.ten + "</td><td  class='hidden_when_all' style='display:none'></td><td  class='hidden_when_all' style='display:none'></td><td>" + formatso(valueg.tongpsno) + "</td><td>" + formatso(valueg.tongpsco) + "</td><td>" + formatso(valueg.tongpsnoco) + "</td></tr>";

        }
        chuoithmltam1 += "<tr style='background-color: #9e9e9e47;'><td>" + h + "</td><td></td><td>Tổng</td><td style='color: #3f51b5;'>" + formatso(tongpsno) + "</td><td style='color: #3f51b5;'>" + formatso(tongpsco) + "</td><td style='color: #3f51b5;'>" + formatso(tongpsnoco) + "</td></tr>";

        chuoithmltam1 += "<tr style='background-color: #9e9e9e47;'><td>" + h + "</td><td></td><td>Tổng tồn</td><td  style='text-align:center;color: #ff5722;'>" + formatso(mangloc['tongton']) + "</td><td>Tổng TM</td><td style='text-align:center;color: #ff5722;'>" + formatso(mangloc['tongtm']) + " <span style='margin-left:30px;font-style:italic'><br>(*) Không cộng tiền lẻ và tiền lẻ đầu kỳ</span></td></tr>";
        chuoithmltam2 += chuoithmltam1;


        document.getElementById("show_dulieu_mang").innerHTML = chuoithmltam2;
    }
    function filldataArea(type, data, mangfill = []) {
        filterKhuvuc = true;
        var keys = Object.keys(data);
        var values = Object.values(data);
        var mangtk = getDataMangTk();
        var mangton = getDataMangTon();
        var h = 0;
        var chuoithml = '';
        var chuoithmltam1 = '';

        // console.log(data);
        var mangdulieu = [];
        for (var i = 0; i < keys.length; i++) {
            var tongpsno = 0;
            var tongpsco = 0;
            var tongpsnoco = 0;

            var tongtm = 0;
            var tongton = 0;
            if (keys[i]) {
                h++;
                chuoithml += "<tr style='background-color: #ff98006e;'><td>" + h + "</td><td style='    background-color: #ff9800; color: #ffffff;'>" + keys[i] + "</td><td colspan='4'></td> </tr>";
                //<td colspan='4'></td>
                var value = Object.values(values[i]);
                var key = Object.keys(values[i]);
                var khoanmuctruoc = [];
                console.log(khoanmuctruoc);
                for (let l = 0; l < value.length; l++) {
                    // console.log(key[l]);
                    var cuahang = value[l];
                    var macuahangs = Object.keys(cuahang);
                    var ngays = Object.values(cuahang);

                    for (var j = 0; j < ngays.length; j++) {
                        var tongtiematketve = 0;
                        var ngay = ngays[j];
                        var tenkhoanmuc = Object.keys(ngay);
                        var dinhkhoans = Object.values(ngay);
                        for (var k = 0; k < dinhkhoans.length; k++) {
                            if (type == "khoanmuctc") {
                                if (!mangfill.includes(tenkhoanmuc[k])) {
                                    continue;
                                }
                            }
                            console.log(mangfill);
                            if (khoanmuctruoc[tenkhoanmuc[k]] !== undefined) {
                                khoanmuctruoc[tenkhoanmuc[k]]['psco'] = khoanmuctruoc[tenkhoanmuc[k]]['psco'] * 1 + dinhkhoans[k]['psco'] * 1;
                                khoanmuctruoc[tenkhoanmuc[k]]['psno'] = khoanmuctruoc[tenkhoanmuc[k]]['psno'] * 1 + dinhkhoans[k]['psno'] * 1;
                                khoanmuctruoc[tenkhoanmuc[k]]['tongpsnoco'] = khoanmuctruoc[tenkhoanmuc[k]]['tongpsnoco'] * 1 + dinhkhoans[k]['tongpsnoco'] * 1;
                            } else {
                                khoanmuctruoc[tenkhoanmuc[k]] = dinhkhoans[k];
                            }
                            var dinhkhoan = dinhkhoans[k];
                            var keydk = Object.keys(dinhkhoan);
                            var valuedk = Object.values(dinhkhoan);
                            var ngaytam = '';

                            var valueg = dinhkhoan;

                            tongpsno += valueg.psno * 1;
                            tongpsco += valueg.psco * 1;

                            tongpsnoco += valueg.tongpsnoco * 1;
                            if (keydk[k] != 'TL' && keydk[k] != 'TLDK') {

                                tongtiematketve += valueg.psno * 1;
                                tongtiematketve -= valueg.psco * 1;

                            }
                        }
                        tongtm += mangton[key[l]].tongton * 1 + tongtiematketve * 1;
                        tongton += mangton[key[l]].tongtoncu * 1;
                    }

                }
                var stt = 2;
                for (const key in khoanmuctruoc) {
                    if (Object.hasOwnProperty.call(khoanmuctruoc, key)) {
                        chuoithml += "<tr><td>" + stt + "</td><td></td><td>" + khoanmuctruoc[key]['khoanmuctc'] + "</td><td  class='hidden_when_all' style='display:none'>" + khoanmuctruoc[key]['tkno'] + "</td><td  class='hidden_when_all' style='display:none'>" + khoanmuctruoc[key]['tkno'] + "</td><td>" + formatso(khoanmuctruoc[key]['psno']) + "</td><td>" + formatso(khoanmuctruoc[key]['psco']) + "</td><td>" + formatso(khoanmuctruoc[key]['tongpsnoco']) + "</td></tr>";
                    }
                    stt++;
                }

                chuoithml += "<tr style='background-color: #9e9e9e47;color: #ff5722;'><td ></td><td>Tổng:</td><td></td><td>" + formatso(tongpsno) + "</td><td>" + formatso(tongpsco) + "</td><td>" + formatso(tongpsnoco) + "</td></tr>"
                chuoithml += "<tr style='background-color: #9e9e9e47;color: #ff5722;'><td ></td><td>Tổng tồn:</td><td>" + formatso(tongton) + "</td><td>Tổng TM</td><td colspan='2' class='text-center font-weight-bold'>" + formatso(tongtm) + "</td></tr>";
            }
        }
        document.getElementById("show_dulieu_mang").innerHTML = chuoithml;
    }

    // bộc lọc theo cột
    function xuly4() {
        if (document.getElementById("totalpage")) {

            totalpage = document.getElementById("totalpage").value;
        }
        if (!tonghop) {
            setHeight();
        }
        setDataMang();
    }

    function timphieutonghop(t1, t2, t3, t4, t5, t6, t7, t8, t9, t10, t11, t12, t32, t34, t13 = 1, loai) {
        console.log(loai);
        tonghop = true;
        t1tam = t1;
        t2tam = t2;
        t3tam = t3;
        t4tam = t4;
        t5tam = t5;
        t6tam = t6;
        t7tam = t7;
        t8tam = t8;
        t9tam = t9;
        t10tam = t10;
        t13tam = t13;
        t32tam = t32;
        t34tam = t34;
        //get thêm dieu kien
        if (document.getElementById("stknh")) {
            t14tam = document.getElementById("stknh").value;
        }
        if (document.getElementById("tentknh")) {
            t15tam = document.getElementById("tentknh").value;
        }
        if (document.getElementById("mavd")) {
            t16tam = document.getElementById("mavd").value;
        }
        if (document.getElementById("dvvc")) {
            t17tam = document.getElementById("dvvc").value;
        }
        if (document.getElementById("ncc")) {
            t18tam = document.getElementById("ncc").value;
        }
        if (document.getElementById("manv")) {
            t19tam = document.getElementById("manv").value;
        }
        if (document.getElementById("phieuxuat")) {
            t20tam = document.getElementById("phieuxuat").value;
        }
        if (document.getElementById("tkno")) {
            t21tam = document.getElementById("tkno").value;
        }
        if (document.getElementById("tkco")) {
            t22tam = document.getElementById("tkco").value;
        }
        if (document.getElementById("diengiai")) {
            t23tam = document.getElementById("diengiai").value;
        } else {
            t23tam = document.getElementById("diengiai_").value;
        }
        if (document.getElementById("dinhkhoan")) {
            t24tam = document.getElementById("dinhkhoan").value;
        }
        if (document.getElementById("psno")) {
            t25tam = document.getElementById("psno").value;
        }
        if (document.getElementById("psco")) {
            t26tam = document.getElementById("psco").value;
        }
        if (document.getElementById("dongia")) {
            t27tam = document.getElementById("dongia").value;
        }
        if (document.getElementById("soluong")) {
            t28tam = document.getElementById("soluong").value;
        }
        if (document.getElementById("dvt")) {
            t29tam = document.getElementById("dvt").value;
        }

        if (document.getElementById("ngaythuchitu")) {
            t30tam = document.getElementById("ngaythuchitu").value;
        }
        if (document.getElementById("ngaythuchiden")) {
            t31tam = document.getElementById("ngaythuchiden").value;
        }
        var tknoval = $(".js-tkno").select2('val');
        var tkcoval = $(".js-tkco").select2('val');
        if (tknoval) {
            for (var i = 0; i < tknoval.length; i++) {
                if (tknoval[i]) {
                    if (t11) {
                        t11 += "," + tknoval[i];
                    } else {
                        t11 += tknoval[i];
                    }
                }
            }
        }
        if (tkcoval) {
            for (var i = 0; i < tkcoval.length; i++) {
                if (tkcoval[i]) {
                    if (t12) {
                        t12 += "," + tkcoval[i];
                    } else {
                        t12 += tkcoval[i];
                    }
                }
            }
        }
        t11tam = t11;
        t12tam = t12;
        var dinhkhoantim = $(".js-dinhkhoantim").select2('val');

        var t35tam1 = t35tam.split(",");
        if (dinhkhoantim) {
            for (var i = 0; i < dinhkhoantim.length; i++) {
                if (dinhkhoantim[i]) {
                    if (t35tam) {
                        if (!t35tam1.includes(dinhkhoantim[i])) {
                            t35tam += dinhkhoantim[i] + ",";
                        }
                    } else {
                        t35tam += dinhkhoantim[i];
                    }
                }
            }
        } else {
            t35tam = '';
        }
        poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(t2) + "*@!" + encodeURIComponent(t3) + "*@!" + encodeURIComponent(t4);
        poststr = poststr + "*@!" + encodeURIComponent(t5) + "*@!" + encodeURIComponent(t6) + "*@!" + encodeURIComponent(t7) + "*@!" + encodeURIComponent(t8) + "*@!" + encodeURIComponent(t9) + "*@!" + encodeURIComponent(t10) + "*@!" + encodeURIComponent(t11) + "*@!" + encodeURIComponent(t12) + "*@!" + encodeURIComponent(t13);
        poststr = poststr + "*@!" + encodeURIComponent(t14tam) + "*@!" + encodeURIComponent(t15tam) + "*@!" + encodeURIComponent(t16tam) + "*@!" + encodeURIComponent(t17tam) + "*@!" + encodeURIComponent(t18tam) + "*@!" + encodeURIComponent(t19tam) + "*@!" + encodeURIComponent(t20tam) + "*@!" + encodeURIComponent(t21tam) + "*@!" + encodeURIComponent(t22tam) + "*@!" + encodeURIComponent(t23tam) + "*@!" + encodeURIComponent(t24tam) + "*@!" + encodeURIComponent(t25tam) + "*@!" + encodeURIComponent(t26tam) + "*@!" + encodeURIComponent(t27tam) + "*@!" + encodeURIComponent(t28tam) + "*@!" + encodeURIComponent(t29tam) + "*@!" + encodeURIComponent(t30tam) + "*@!" + encodeURIComponent(t31tam) + "*@!" + encodeURIComponent(t32) + "*@!" + encodeURIComponent(limit) + "*@!" + encodeURIComponent(t34) + "*@!" + encodeURIComponent(t35tam) + "*@!" + encodeURIComponent(loai);

        if (loai == 1) {
            loadtrang('httim', "thuchiktbaocaotonghop", poststr, "xuly4");

        } else if (loai == 2) {
            loadtrang('httim', "thuchiktbaocaodhonline", poststr, "xuly4");
        } else if (loai == 3) {
            loadtrang('httim', "thuchiktbaocaodhonlinepd", poststr, "xuly4");
        } else if (loai == 4) {
            loadtrang('httim', "thuchiktbaocaodhonlinedsdh", poststr, "xuly4");
        } else if (loai == 5) {
            loadtrang('httim', "thuchiktbaocaotonghopchitiet", poststr, "xuly4");
        } else if (loai == 6) {
            loadtrang('httim', "thuchiktbaocaotienthua", poststr, "xuly4");
        } else if (loai == 7) {
            loadtrang('httim', "thuchiktbaocaocongno", poststr, "xuly4");
        } else if (loai == 8) {
            loadtrang('httim', "thuchiktbaocaodoanhthu", poststr, "xuly4");
        } else if (loai == 9) {
            loadtrang('httim', "thuchiktbaocaotienmat", poststr, "xuly4");
        } else if (loai == 10) {
            loadtrang('httim', "thuchiktbaocaoNTQ", poststr, "xuly4");
        } else if (loai == 11) {
            loadtrang('httim', "baocaokettiench", poststr, "xuly4");
        } else if (loai == 12) {
            loadtrang('httim', "thuchiktbaocaoluongonl", poststr, "xuly4");
        } else if (loai == 13) {
            loadtrang('httim', "thuchiktbaocaoluongonl", poststr, "xuly4");
        } else if (loai == 14) {
            loadtrang('httim', "thuchiktbaocaoluongonl", poststr, "xuly4");
        } else if (loai == 15) {
            loadtrang('httim', "thuchiktbaocaoLDTH", poststr, "xuly4");
        } else if (loai == 16) {
            loadtrang('httim', "thuchiktbaocaoLDTHgop", poststr, "xuly4");
        } else if (loai == 17) {
            loadtrang('httim', "thuchiktbaocaotonghopthuchi", poststr, "xuly4");
        }
    }

    function phantrangAjax(value, loai = 1, type = '') {
        if (loai == 1) {
            if (value == -1) {
                if (curentpage == 1) {
                    value = 1;
                } else {
                    value = curentpage - 1;
                }
            } else if (value == -2) {
                if (curentpage == totalpage) {
                    value = totalpage;
                } else {
                    value = curentpage + 1;
                }
            }

            $("#loading1").css("display", "inline-block");
            timphieu(t1tam, t2tam, t3tam, t4tam, t5tam, t6tam, t7tam, t8tam, t9tam, t10tam, t11tam, t12tam, t32tam, t34tam, value, limit);
            //console.log(value)
            curentpage = parseInt(value);
        } else if (loai == 2) {
            if (value == -1) {
                if (curentpage2 == 1) {
                    value = 1;
                } else {
                    value = curentpage2 - 1;
                }
            } else if (value == -2) {
                if (curentpage2 == totalpage) {
                    value = totalpage;
                } else {
                    value = curentpage2 + 1;
                }
            }

            $("#loading1").css("display", "inline-block");
            timphieutonghop(t1tam, t2tam, t3tam, t4tam, t5tam, t6tam, t7tam, t8tam, t9tam, t10tam, t11tam, t12tam, t32tam, t34tam, value, 1);
            curentpage2 = parseInt(value);
        } else if (loai == 3) {

            if (value == -1) {
                if (curentpage3 == 1) {
                    value = 1;
                } else {
                    value = curentpage2 - 1;
                }
            } else if (value == -2) {
                if (curentpage3 == totalpage) {
                    value = totalpage;
                } else {
                    value = curentpage3 + 1;
                }
            }

            if (type) {
                timphieutonghop(t1tam, t2tam, t3tam, t4tam, t5tam, t6tam, t7tam, t8tam, t9tam, t10tam, t11tam, t12tam, t32tam, t34tam, value, type);
            } else {

                timphieutonghop(t1tam, t2tam, t3tam, t4tam, t5tam, t6tam, t7tam, t8tam, t9tam, t10tam, t11tam, t12tam, t32tam, t34tam, value, 2);
            }
            curentpage3 = parseInt(value);
        } else {
            timphieutonghop(t1tam, t2tam, t3tam, t4tam, t5tam, t6tam, t7tam, t8tam, t9tam, t10tam, t11tam, t12tam, t32tam, t34tam, value, loai);
        }
    }

    function xuatexel(loai) {

        var chuoiwhere = t1tam + "*@!" + t2tam + "*@!" + t3tam + "*@!" + t4tam + "*@!" + t5tam + "*@!" + t6tam + "*@!" + t7tam + "*@!" + t8tam + "*@!" + t9tam + "*@!" + t10tam + "*@!" + t11tam + "*@!" + t12tam + "*@!" + t13tam + "*@!" + t14tam + "*@!" + t15tam + "*@!" + t16tam + "*@!" + t17tam + "*@!" + t18tam + "*@!" + t19tam + "*@!" + t20tam + "*@!" + t21tam + "*@!" + t22tam + "*@!" + t23tam + "*@!" + t24tam + "*@!" + t25tam + "*@!" + t26tam + "*@!" + t27tam + "*@!" + t28tam + "*@!" + t29tam + "*@!" + t30tam + "*@!" + t31tam + "*@!" + t32tam + "*@!" + t34tam + "*@!" + t35tam + "*@!";
        console.log(t14tam);
        if (loai == 17 || loai == 18) {

            var chuoiwhere = t1tam + "*@!" + t2tam + "*@!" + document.getElementById("tungay").value + "*@!" + document.getElementById("denngay").value + "*@!" + t5tam + "*@!" + t6tam + "*@!" + t7tam + "*@!" + t8tam + "*@!" + t9tam + "*@!" + t10tam + "*@!" + t11tam + "*@!" + t12tam + "*@!" + t13tam + "*@!" + t14tam + "*@!" + t15tam + "*@!" + t16tam + "*@!" + t17tam + "*@!" + t18tam + "*@!" + t19tam + "*@!" + t20tam + "*@!" + t21tam + "*@!" + t22tam + "*@!" + t23tam + "*@!" + t24tam + "*@!" + t25tam + "*@!" + t26tam + "*@!" + t27tam + "*@!" + t28tam + "*@!" + t29tam + "*@!" + t30tam + "*@!" + t31tam + "*@!" + t32tam + "*@!" + t34tam + "*@!" + t35tam + "*@!";

        }
        if (loai == 1) {
            document.getElementById("dataexel").value = chuoiwhere;
            document.getElementById("tonghop").value = '';

        } else {
            document.getElementById("dataexel").value = chuoiwhere;
            document.getElementById("tonghop").value = loai;
        }

        document.getElementById("xuatketqua").submit();
    }

    function settype(valu) {
        document.getElementById('dachon').value = valu;
    }


    function kiemtra() {
        //   if (capnhap != '') { return false ;}
        if (document.getElementById('tuvandung').value == "0") {
            alert('Bạn chưa nhập tư vấn đúng');
            document.getElementById('tuvandung').focus();
            return false;
        }


        return true;
    }

    function duyet(tc, sp, loai, tennv, lydo, nvxn) { //tungay,denngay,luachon,nhomtk,taikhoan2,lydo2,tr

        if (loai == 0) return;
        capnhap = tc;
        var cf = " Bạn có chắc chắn muốn duyệt phiếu cho nhân viên " + tennv + " này hay không ? ";
        if (thongbao(cf) == false) {
            return
        } else {
            poststr = "DATAC=" + encodeURIComponent(tc) + "*@!" + encodeURIComponent(idlogin) + "*@!" + encodeURIComponent(loai) + "*@!" + encodeURIComponent(lydo) + "*@!" + encodeURIComponent(0);
            loadtrang('khonghienthi', "thuonghoadonduyet", poststr, "xuly1");
        }
    }
    var nvxnt = '';
    var idphieu = '';

    function xuly1() {
        tam = document.getElementById('khonghienthi').innerHTML;
        //alert(tam);
        var n = tam.split("###");
        console.log(n);
        if (n[1] == "-6") {
            alert(n[2]);
            return;
        }
        if (n[1] == "6") {

            document.getElementById('lydo' + nvxnt + idphieu).innerHTML = n[4];
            document.getElementById('lydo_tingtrang' + idphieu).innerHTML = n[4];
            return;
        }
        if (n[1] == "-1") {
            alert(n[2]);
            return;
        }
        document.getElementById('tinhtrang_' + idphieu).innerHTML = n[2];
        /*if (n[1]=="1") 
        {    
                 
                //document.getElementById('duyetad'+nvxnt).innerHTML= n[3];  
           // alert(n[2]);
            return;
        }
        else*/

        if (n[1] == "3" || n[1] == "2" || n[1] == "1") {

            document.getElementById(nvxnt + idphieu).value = n[1];
            if (n[1] != "1") {
                //document.getElementById(nvxnt+idphieu).disabled=true 
            }
            document.getElementById('lydo' + nvxnt + idphieu).innerHTML = n[5];
            document.getElementById('lydo_tingtrang' + idphieu).innerHTML = n[5];
        } else if (n[1] == "4") {
            document.getElementById('lydo' + nvxnt + idphieu).innerHTML = n[5];
            document.getElementById('lydo_tingtrang' + idphieu).innerHTML = n[5];
            document.getElementById(nvxnt + idphieu).value = n[1];
            //document.getElementById(nvxnt+idphieu).disabled=true

        }


        dongformkxd();
    }
    var lydokxd = '';
    var valuekxd = '';

    function goiduyet(id, value, nvxn, kxd,ts='') {
        nvxnt = nvxn;
        idphieu = id;
        var lydo = '';
var ngayhuudung='';
        if (value == 3 || value == 2 || value == 1) {
            lydo = prompt("Nhập Lý do: ");
            if (lydo == null) return;
        } else if (value == 4) {
            lydo = prompt("Nhập Lý do\n(*)lưu ý lý do trước đó sẽ bị xóa: ");
            if (lydo == null) return;
        }
		lydokxd = lydo;
		 valuekxd = value;
		 if (kxd) {
            showformkxd();
            return;
        }
		if(ts=="CMTS"){
		  	ngayhuudung = prompt("Nhập Số ngày hữu dụng\n(*)");
            if (ngayhuudung == null) return;
		}
       
      
        poststr = "DATAC=" + encodeURIComponent(id) + "*@!" + encodeURIComponent(value) + "*@!" + encodeURIComponent(lydo)+ "*@!" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0)+ "*@!" + encodeURIComponent(ngayhuudung);
        loadtrang('khonghienthi', "thuchiktbaocaoduyet", poststr, "xuly1");

    }

    function goiduyetMutiple(value, nvxn) {
        nvxnt = nvxn;
        if (value == 0) {
            return;
        }
        var lydo = '';
        if (value == 3 || value == 2 || value == 1) {
            lydo = prompt("Nhập Lý do: ");
            if (lydo == null) return;
        }
        var checkMutipl = document.getElementsByClassName("checkMutipl");
        var chuoicheckMutipl = '';
        for (var i = 0; i < checkMutipl.length; i++) {
            var element = checkMutipl[i];

            if (element.checked == true && element.disabled == false) {
                chuoicheckMutipl += element.value + "###";
            }
        }
        //return;
        if (!chuoicheckMutipl) {
            alert("Thao tác không thực hiện được");
            return;
        }

        poststr = "DUYETMUTIL=" + encodeURIComponent(chuoicheckMutipl) + "*@!" + encodeURIComponent(value) + "*@!" + encodeURIComponent(lydo) + "*@!" + encodeURIComponent(1);
        loadtrang('khonghienthi', "thuchiktbaocaoduyet", poststr, "xuly2");
    }

    function xuly2() {
        tam = document.getElementById('khonghienthi').innerHTML;
        //alert(tam);
        var n = tam.split("###");
        console.log(n);
        if (n[1] == "-1") {
            alert(n[2]);
            return;
        }
        alert(n[2]);
        var mangidphieu = n[4].split("-");
        console.log(mangidphieu);
        for (var i = 0; i < mangidphieu.length; i++) {
            var el = mangidphieu[i];
            document.getElementById('tinhtrang_' + el).innerHTML = n[2];
        }


        if (n[1] == "3" || n[1] == "2" || n[1] == "1") {
            for (var i = 0; i < mangidphieu.length; i++) {
                var el = mangidphieu[i];
                document.getElementById(nvxnt + el).value = n[1];
                if (n[1] != "1") {
                    document.getElementById("checkMutipl" + el).disabled = true
                    document.getElementById(nvxnt + el).disabled = true
                }
                document.getElementById('lydo' + nvxnt + el).innerHTML = n[5];

            }
        } else if (n[1] == "4") {
            for (var i = 0; i < mangidphieu.length; i++) {
                var el = mangidphieu[i];
                document.getElementById("checkMutipl" + el).disabled = true
                document.getElementById(nvxnt + el).value = n[1];
                document.getElementById(nvxnt + el).disabled = true
            }
        }
    }

    function capnhatlydo(id, nxn) {
        idphieu = id;
        nvxnt = nxn;
        var lydo = prompt("Nhập Lý do: ");
        if (!lydo) {
            return;

        }
        poststr = "CAPNHATLYDO=" + encodeURIComponent(id) + "*@!" + encodeURIComponent(lydo) + "*@!";
        loadtrang('khonghienthi', "thuchiktbaocaoduyet", poststr, "xuly1");
    }

    function goiduyetkxn() {
        var tknokxd = $("#tknokxd").val();
        var tkcokxd = $("#tkcokxd").val();
        poststr = "DATAC=" + encodeURIComponent(idphieu) + "*@!" + encodeURIComponent(valuekxd) + "*@!" + encodeURIComponent(lydokxd) + "*@!" + encodeURIComponent(tknokxd) + "*@!" + encodeURIComponent(tkcokxd);
        loadtrang('khonghienthi', "thuchiktbaocaoduyet", poststr, "xuly1");

    }

    function thongtinlydo(lydo) {
        alert(lydo);
    }

    function closepop(id) {
        document.getElementById(id).style.display = "none";
    }

    function showpop(id) {
        document.getElementById(id).style.display = "flex";
    }

    function showloading1() {
        if (document.getElementById('loading1')) {
            document.getElementById('loading1').style.display = "flex";
        }
    }


    function closeloading1() {
        if (document.getElementById('loading1')) {
            document.getElementById('loading1').style.display = "none";
        }
    }

    function getphieu(id, idpop) {
        showpop(idpop);
        poststr = "DATA=" + encodeURIComponent(id);
        loadtrang('poupduyet', "thuchiketoanform", poststr, "xuly3");

    }

    function xuly3() {
        $('.js-tkco').select2();
        $('.js-tkno').select2();
        $('.js-dinhkhoanthuchi').select2();
    }

    function goitennv(value) {
        document.getElementById('resgoitenv').style.display = "block";
        poststr = "GOITENNV=" + encodeURIComponent(value);
        loadtrang('resgoitenv', "thuchiktchinhsua", poststr, "xuly5");
    }

    function xuly5() {

        var tam = document.getElementById('resgoitenv').innerHTML;
        if (tam) {
            tam = tam.split("###");

            if (tam[1] == 1) {
                document.getElementById('resgoitenv').style.display = "none";
                document.getElementById('tennv').value = tam[2];
            }

        }

    }

    function goitenNH(value) {
        document.getElementById('resgoitenh').style.display = "block";
        poststr = "GOITENNH=" + encodeURIComponent(value);
        loadtrang('resgoitenh', "thuchiktchinhsua", poststr, "xuly6");
    }

    function xuly6() {

        var tam = document.getElementById('resgoitenh').innerHTML;
        if (tam) {
            tam = tam.split("###");

            if (tam[1] == 1) {
                document.getElementById('resgoitenh').style.display = "none";
                document.getElementById('tentknh').value = tam[2];
            }

        }

    }


    function luuchinhsua(id) {
        document.getElementById('resluusua').style.display = "block";
        var IDcha = document.getElementById('dinhkhoanthuchi').value;
        var note = document.getElementById('diengiai').value;
        var dongia = document.getElementById('dongia').value;
        var ngaysua = document.getElementById('ngaysua').value;
        var loaitk = document.getElementById('cuahang').value;
        var phieuxuat = document.getElementById('phieuxuat').value;
        var psno = document.getElementById('psno').value;
        var psco = document.getElementById('psco').value;
        var donvi = document.getElementById('donvi').value;
        var soluong = document.getElementById('soluong').value;
        var dongia = document.getElementById('dongia').value;
        var tkno = $("#tknosua").val();

        var tkco = $("#tkcosua").val();

        var hdbh = document.getElementById('hdbh').value;
        var sotknh = document.getElementById('sotknh').value;
        var tentknh = document.getElementById('tentknh').value;
        var mavandon = document.getElementById('mavandon').value;
        var ncc = document.getElementById('ncc').value;
        var manv = document.getElementById('manv').value;
        var phithukh = document.getElementById('phithukh').value;
        var lydo = $("#dinhkhoanthuchi option:selected").text();
        var loaiphieu = document.getElementById('loaiphieu').value;
        var dvvc = document.getElementById('dvvc').value;
        poststr = "LUUSUA=" + encodeURIComponent(IDcha) + "*@!" + encodeURIComponent(note) + "*@!" + encodeURIComponent(dongia) + "*@!" + encodeURIComponent(ngaysua) + "*@!" + encodeURIComponent(loaitk) + "*@!" + encodeURIComponent(phieuxuat) + "*@!" + encodeURIComponent(psno) + "*@!" + encodeURIComponent(psco) + "*@!" + encodeURIComponent(donvi) + "*@!" + encodeURIComponent(soluong) + "*@!" + encodeURIComponent(dongia) + "*@!" + encodeURIComponent(tkno) + "*@!" + encodeURIComponent(tkco) + "*@!" + encodeURIComponent(hdbh) + "*@!" + encodeURIComponent(sotknh) + "*@!" + encodeURIComponent(tentknh) + "*@!" + encodeURIComponent(mavandon) + "*@!" + encodeURIComponent(ncc) + "*@!" + encodeURIComponent(manv) + "*@!" + encodeURIComponent(lydo) + "*@!" + encodeURIComponent(id) + "*@!" + encodeURIComponent(loaiphieu) + "*@!" + encodeURIComponent(dvvc) + "*@!" + encodeURIComponent(phithukh);
        loadtrang('resluusua', "thuchiktchinhsua", poststr, "xuly7");
    }

    function xuly7() {

        var tam = document.getElementById('resluusua').innerHTML;
        if (tam) {
            tam = tam.split("###");

            if (tam[1] == 1) {
                document.getElementById('resluusua').style.display = "none";
                alert(tam[2]);
                closepop('poupduyet');
            } else {
                alert(tam[2]);
            }

        }

    }


    function themdieukiemtim(e) {
        var target = e.target;
        var value = target.value;
        var title = target.options[target.selectedIndex].text;
        var dataid = target.options[target.selectedIndex].getAttribute("data-id");
        var check = false;
        var inputshow = document.getElementById("themdieukiemtim_show").getElementsByTagName("input");
        if (inputshow.length > 0) {
            for (var i = 0; i < inputshow.length; i++) {
                var element = inputshow[i];

                var id = element.getAttribute("id");

                if (id == value || id == value + "tu" || id == value + "den") {
                    check = true;
                }
            }
        }
        if (!check) {
            var input = '';
            if (value != "") {
                input = document.createElement("input");
                if (value == "ngaytao") {
                    var span = document.createElement("span");
                    span.innerHTML = " &nbsp;  từ &nbsp; ";
                    var span2 = document.createElement("span");
                    span2.innerHTML = " &nbsp;  đến &nbsp; ";

                    input2 = document.createElement("input");
                    input.type = "date";
                    input.name = value + "tu";
                    input.id = value + "tu";
                    input.style.lineHeight = 'unset';
                    input.setAttribute("data-id", dataid);
                    input.setAttribute("placeholder", title);
                    span.ondblclick = (event) => {
                        deletinput(event);
                    }
                    input2.type = "date";
                    input2.name = value + "den";
                    input2.id = value + "den";
                    input2.style.lineHeight = 'unset';
                    input2.setAttribute("data-id", dataid + 1);
                    input2.setAttribute("placeholder", title);
                    span2.ondblclick = (event) => {
                        deletinput(event);
                    }
                    span.append(input);
                    span2.append(input2);
                    document.getElementById("themdieukiemtim_show").append(span);
                    document.getElementById("themdieukiemtim_show").append(span2);
                } else {
                    input.name = value;
                    input.id = value;
                    input.type = "text";
                    input.style.lineHeight = 'unset';
                    input.setAttribute("placeholder", title);
                    input.setAttribute("data-id", dataid);
                    input.ondblclick = (event) => {
                        deletinput(event);
                    }
                    document.getElementById("themdieukiemtim_show").append(input);
                }



                document.getElementById("ghichuxoa").style.display = "block";

            }
        }

    }


    function deletinput(e) {
        var target = e.target;
        var dataid = target.getAttribute("data-id");

        resetvaraible(dataid);
        console.log(t24tam);
        target.remove();
        var tam = document.getElementById("themdieukiemtim_show");

        if (tam.getElementsByTagName("input").length <= 0) {
            document.getElementById("ghichuxoa").style.display = "none";
        }
    }

    function resetvaraible(tenbien) {
        switch (tenbien) {
            case '14':
                t14tam = '';
                break;
            case '15':
                t15tam = '';
                break;
            case '16':
                t16tam = '';
                break;
            case '17':
                t17tam = '';
                break;
            case '18':
                t18tam = '';
                break;
            case '19':
                t19tam = '';
                break;
            case '20':
                t20tam = '';
                break;
            case '21':
                t21tam = '';
                break;
            case '22':
                t22tam = '';
                break;
            case '23':
                t23tam = '';
                break;
            case '24':
                t24tam = '';

                break;
            case '25':
                t25tam = '';
                break;
            case '26':
                t26tam = '';
                break;
            case '27':
                t27tam = '';
                break;
            case '28':
                t28tam = '';
                break;
            case '29':
                t29tam = '';
                break;
            case '30':
                t30tam = '';
                break;
            case '31':
                t31tam = '';
                break;
            default:
                break;

        }

    }

    function showChondong() {
        var sel = document.getElementById("select_sodong");
        if (sel.classList.contains("show")) {
            sel.classList.remove("show");
        } else {
            sel.classList.add("show");
        }
    }

    function resetform(e) {
        //console.log(e);
        e.preventDefault();
    }

    function SendLimit(limits, loai) {
        limit = limits;
        if (loai == 1) {
            timphieu(t1tam, t2tam, t3tam, t4tam, t5tam, t6tam, t7tam, t8tam, t9tam, t10tam, t11tam, t12tam, t32tam, t34tam, t13tam, limit);
        } else {

            timphieutonghop(t1tam, t2tam, t3tam, t4tam, t5tam, t6tam, t7tam, t8tam, t9tam, t10tam, t11tam, t12tam, t32tam, t34tam, t13tam, loai);

        }
    }

    function SendLimitKeyup(e, loai) {
        var target = e.target;
        limit = target.value;

        if (e.keyCode == 13) {

            if (loai == 1) {
                timphieu(t1tam, t2tam, t3tam, t4tam, t5tam, t6tam, t7tam, t8tam, t9tam, t10tam, t11tam, t12tam, t32tam, t34tam, t13tam, limit);
            } else if (loai == 3) {
                timphieutonghop(t1tam, t2tam, t3tam, t4tam, t5tam, t6tam, t7tam, t8tam, t9tam, t10tam, t11tam, t12tam, t32tam, t34tam, t13tam, 2);
            } else {
                timphieutonghop(t1tam, t2tam, t3tam, t4tam, t5tam, t6tam, t7tam, t8tam, t9tam, t10tam, t11tam, t12tam, t32tam, t34tam, t13tam, loai);
            }
        }

    }

    function checkSelectAll(e) {
        var checkMutipl = document.getElementsByClassName("checkMutipl");
        if (e.target.checked == true) {

            for (var i = 0; i < checkMutipl.length; i++) {
                var element = checkMutipl[i];
                element.checked = true;
            }
        } else {

            for (var i = 0; i < checkMutipl.length; i++) {
                var element = checkMutipl[i];
                element.checked = false;
            }
        }
    }

    function OnchangeDinhKhoan(value) {
        isloading(true, "loadingtime1");
        isloading(true, "loadingtime");
        poststr = "GOITK=" + encodeURIComponent(value) + "*@!";
        loadtrang('resgoitk', "thuchiktchinhsua", poststr, "xuly8");

    }

    function xuly8() {
        var tam = document.getElementById("resgoitk").innerHTML;
        if (tam) {
            tam = tam.split("###");
            document.getElementById("tkcosua").innerHTML = tam[3];
            document.getElementById("tknosua").innerHTML = tam[2];
            var thongtin = tam[4];
            if (thongtin) {
                thongtin = thongtin.split("*");
                //console.log(thongtin);
                $(".ttf").each((index, item) => {
                    item.disabled = true;
                });
                $(".ttf").each((index, item) => {

                    for (var i = 0; i < thongtin.length; i++) {
                        var el = thongtin[i];
                        if ($(item).hasClass("ttf_" + el)) {
                            item.disabled = false;
                        }


                    }
                });
            }

        }
        isloading(false, "loadingtime1");
        isloading(false, "loadingtime");
    }

    function isloading(type, id) {
        if (type) {
            if (document.getElementById(id)) {
                document.getElementById(id).style.display = "inline-block";
            }
        } else {
            if (document.getElementById(id)) {
                document.getElementById(id).style.display = "none";
            }
        }
    }


    function togglechuaload(type) {

        if (type) {
            document.getElementById("chuaload").style.display = 'flex';
            return;
        }
        document.getElementById("chuaload").style.display = 'none';
    }

    var idchadmin = '';

    function timphieuthongbao(loai, tinhtrang) {

        timphieu(t1tam, t2tam, t3tam, t4tam, t5tam, t6tam, t7tam, t8tam, t9tam, t10tam, t11tam, t12tam, t32tam, t34tam, '', '', loai, tinhtrang, idchadmin);
    }
    var ngaymoi = '{ngayhientai}';

    function GetthongbaoPhieu() {
        isloading(true, "loadingcapnhat");
        poststr = "GETTHONGBAOPHIEU=" + encodeURIComponent(ngaymoi) + "*@!" + encodeURIComponent(idchadmin) + "*@!";
        loadtrang('thongbaores', "thuchiktthongbao", poststr, "xuly9");

    }
    var checkloaitk = '{checkloaitk}';
    window.onload = () => {
        //console.log(checkloaitk);
        if (checkloaitk) {
            //GetthongbaoPhieu();
        }
    }

    /*function addEvent(obj, evt, fn) {
          if (obj.addEventListener) {
              obj.addEventListener(evt, fn, false);
          }
          else if (obj.attachEvent) {
              obj.attachEvent("on" + evt, fn);
          }
      }
      addEvent(window, "load", function (e) {
          addEvent(document, "mouseleave", function (e) {
              e = e ? e : window.event;
              var from = e.relatedTarget || e.toElement;
              if (!from || from.nodeName == "HTML") {

                $(document).ajaxStop(function(){
                    alert("All AJAX requests completed");
                  });
              }
          });
      });*/
    var arrtam = [];
    var topNo = 100;

    function xuly9() {
        var tam = document.getElementById("thongbaores").innerHTML;
        console.log(tam);
        if (tam) {
            tam = JSON.parse(tam);

            console.log(tam);
            var dulieumoi = tam.dulieumoi;
            if (dulieumoi.ngaymoi) {
                ngaymoi = dulieumoi.ngaymoi;
            }
            var moi = dulieumoi.moi;
            if (moi.length > 0) {

                for (var i = 0; i < moi.length; i++) {
                    var element = moi[i];
                    var text = element.soct + " " + element.tinhtrang;
                    var tinhtrangso = element.tinhtrangso;
                    var mau = '';
                    if (tinhtrangso == 3) {
                        mau = '#f44336c9';
                    }
                    if (tinhtrangso == 5) {
                        mau = '#ff9800b8';
                    }
                    var idnoti = element.soct;
                    idnoti = idnoti.replace(".", "").replace(".", "");
                    if (arrtam.includes(idnoti)) {
                        idnoti = idnoti + "1";
                    }
                    arrtam.push(idnoti);
                    var notifi = CreateNotification(text, idnoti, topNo, mau);
                    topNo += 60;
                    $('body').append(notifi);
                    //$("#"+element.soct).animate({top:(top+40)+"px",opacity:0},0.3,'slow');
                    //$("#"+element.soct).animate({top:top+"px",opacity:1},0.3,'slow');

                }
            }
            document.getElementById("yccs_note").innerHTML = tam.tongyeucauchinhsua ? tam.tongyeucauchinhsua : "0";
            document.getElementById("chuaduyet_note").innerHTML = tam.tongchuaduyet ? tam.tongchuaduyet : "0";
            document.getElementById("duyet_note").innerHTML = tam.tongduyet ? tam.tongduyet : "0";
            document.getElementById("khongduyet_note").innerHTML = tam.tongkhongduyet ? tam.tongkhongduyet : "0";
            isloading(false, "loadingcapnhat");

            /*setTimeout(() => {
                    GetthongbaoPhieu();
            }, 3000);*/


        }
    }



    function CreateNotification(text, id, top, mau) {
        return '<style>@keyframes ' + id + '{0%{opacity: 0;top:' + (top + 40) + 'px}100%{opacity: 1;top:' + (top) + 'px}} #' + id + '{top:' + top + 'px;animation: ' + id + ' 0.3s linear;}</style><div class="notification" id="' + id + '" style="background-color:' + mau + '"><button type="button" class="reset_btn close_notifi" onclick="this.parentElement.remove()">&times;</button><div>' + text + '</div></div>';
    }

    function changetab(e, classname) {
        var target = e.target;
        var tabindex = target.getAttribute("tabindex");
        var tabs = document.getElementsByClassName(classname);
        for (var i = 0; i < tabs.length; i++) {
            var el = tabs[i];
            var tabid = el.getAttribute("tabindex");
            if (tabindex == tabid) {
                el.style.display = "block";
            } else {
                el.style.display = "none";
            }
        }

    }

    function OnchangeCH(e) {
        var target = e.target;
        var value = target.value;
        idchadmin = value;
        var text = target.options[target.selectedIndex].text;
        document.getElementById("maCHadmin").innerHTML = text + " :";
        GetthongbaoPhieu(value);
    }
</script>