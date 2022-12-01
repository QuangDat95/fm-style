<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><br />
<div class="nenbao">
    <fieldset class="nencon">
        <legend>
            <a style="cursor:pointer">
                <label style="Color:#FF3300;Font-Weight:Bold;Font-size:9pt;"> Khu Vực </label>
            </a>
        </legend>

        <script language=JavaScript src='scripts/innovaeditor.js'></script>
        <!-- BEGIN: block_khht1 -->
        <form name="frmProduct1" method="post">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td colspan="7">
                        [ <a href="default.php?act=tinh&id=-1">Thêm Mới</a>]&nbsp;&nbsp;[<a href="default.php?act=md">Đóng Lại</a>]&nbsp;&nbsp;Tên
                        <input type="text" name="NameS" class="text" size="10" value="{NameS}" />&nbsp;&nbsp;

                        <select class="js-tinh" id="IDKhuVuc" name="IDKhuVuc" onchange="loadquan(event)" style="width:200px">
					<option value="">vui lòng chọn tỉnh</option>
					{tinh}
				</select>
                        <script>
                            function loadquan(e) {
                                console.log(e);
                                var id = e.target.value
                                postr = "DATA=" + encodeURIComponent(id);
                                loadtrang('loadlaiquan', "loadquan", postr, "xuly2");

                            }

                            function xuly2() {
                                var tam = document.getElementById("loadlaiquan").innerHTML;
                                //console.log(tam);

                            }
                        </script>
                        <select class="js-quan" name="quan" id="loadlaiquan" onchange="loadphuong(event)" style="width:200px">
							<option value="">vui lòng chọn quận</option>
						</select>
                        <script>
                            function loadphuong(e) {
                                console.log(e);
                                var id = e.target.value
                                postr = "DATA=" + encodeURIComponent(id);
                                loadtrang('loadlaiphuong', "loadphuong", postr, "xuly3");

                            }

                            function xuly3() {
                                var tam = document.getElementById("loadlaiphuong").innerHTML;
                                //console.log(tam);

                            }
                        </script>
                        <select class="js-phuong" name="phuong" id="loadlaiphuong" onchange="loadduong(event)" style="width:200px">
							<option value="">vui lòng chọn phường</option>
					
				</select>
                        <script>
                            function loadduong(e) {
                                console.log(e);
                                var id = e.target.value
                                postr = "DATA=" + encodeURIComponent(id);
                                loadtrang('loadlaiduong', "loadduong", postr, "xuly4");

                            }

                            function xuly4() {
                                var tam = document.getElementById("loadlaiduong").innerHTML;
                                //console.log(tam);

                            }
                        </script>

                        <select class="js-duong" name="duong" id="loadlaiduong" style="width:200px">
							<option value="">vui lòng chọn đường</option>
				</select>

                        <input type="submit" name="search" value="Tìm kiếm" />
                    </td>
                </tr>

                <tr bgcolor="#F8E4CB">
                    <td align="center" style='border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 0.4pt 0in 0.4pt' height="23" width="41"><b>STT</b></td>
                    <td width="829" align="center" style='border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'><strong>Tên Tỉnh - TP </strong></td>


                    <td width="201" align="center" style='border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 0.4pt 0in 0.4pt'><strong>C&#7853;p nh&#7853;p</strong></td>
                    <td width="143" align="center" style='border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 0.4pt 0in 0.4pt'><strong>X&#243;a</strong></td>
                </tr>
                <!-- End: block_khht1 -->
                <!-- BEGIN: block_khht -->
                <tr bgcolor="{color}">
                    <td style="border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 0.4pt 0in 0.4pt;padding-right:12px" align="right">&nbsp;{stt}</td>

                    <td valign="middle" style="border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">
                        <label for="sele<%=j%>" style="Font-Weight:Normal;Color:Black;">&nbsp;{Name} </label></td>


                    <td align="center" style="border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 3.4pt 0in 3.4pt"><label for="sele<%=j%>" style="Font-Weight:Normal;Color:Black;cursor:hand">
				
				<a href = "default.php?act=tinh&id={ID}"> <img src = "images/book_addressHS.png" border = "0" ></a></label> </td>


                    <td align="center" style="border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">
                        <a onclick='return ask()' href="default.php?act=tinh&Del={ID}"><img src="images/delete.gif" border="0"></a>
                    </td>
                </tr>

                <!-- End: block_khht -->

                <!-- BEGIN: block_proht2 -->
                <tr style="padding-top:10">
                    <td align="right" colspan="4"> {list_page}</td>
                </tr>
            </table>
            <input type="hidden" name="currentPage" />
        </form>
        <!-- End: block_proht2 -->


        <!-- BEGIN: block_kh -->
        <form name="frmkho" method="post">
            <table width="100%" border="0">
                <tr>
                    <td colspan="2" align="center" style="color:#FF6600;padding-bottom:10px">
                        <h3>{t-c}</h3>
                        <input name="id" type="hidden" value="{idgoi}" /></td>
                </tr>
                <tr>
                    <td width="17%">Tên Tỉnh - TP </td>
                    <td width="83%">
                        <input type="Text" ID="Name" name="Name" class="text" size="50" value="{Name}" /> * </td>
                </tr>
                <tr>
                    <td width="17%">Vị Trí </td>
                    <td width="83%">
                        <input type="Text" name="Rank" ID="Rank" class="text" size="6" value="{Rank}" />
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="Submit" class="text" name="btnUpdate" onclick="return kiemtra()" value="Cập nhập"> <input type="submit" class="text" name="cancel" value="Quay Lại" /> </td>
                </tr>
            </table>
        </form>

        <!-- END: block_kh -->
        <!-- BEGIN: block_khupdate -->
        <script language="JavaScript">
            alert('Cập nhập Tỉnh - TP thành công');
            location.replace("default.php?act=tinh");
        </script>
        <!-- END: block_khupdate -->

        <!-- BEGIN: block_ajack -->
        <script language="javascript">
            function makeObject() {
                var x;
                var browser = navigator.appName;
                if (browser == "Microsoft Internet Explorer") {
                    x = new ActiveXObject("Microsoft.XMLHTTP");
                } else {
                    x = new XMLHttpRequest();
                }
                return x;
            }

            var request = makeObject();


            //============================================================


            function findtemp(id) {
                request.open('get', 'findtemp.php?id=' + id);

                request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                request.onreadystatechange = outputfindtemp;

                request.send('');
            }

            function outputfindtemp() {
                if (request.readyState == 1)

                { //You can add animated gif while loading //
                    //document.getElementById('temp').innerHTML = "<p>&nbsp;</p><p align='left' style='padding-left:200'><img               src='images/downloading.gif'></p>";
                }
                if (request.readyState == 4) {
                    var data = request.responseText;

                    document.getElementById('templa').innerHTML = data;
                }
            }

            function ask() {
                var n = confirm("Bạn có muốn xóa không");
                if (n == false) {
                    return false;

                }
            }
        </script>
        <!-- END: block_ajack -->
        <script language="JavaScript">
            function trim(str) {
                ch = '';
                for (i = 0; i < str.length; i++) {
                    cha = str.charAt(i);
                    if (cha != ' ') {
                        ch = ch + cha;
                    }
                }
                return ch;
            }

            function kiemtra() {
                if (trim(document.getElementById('Name').value) == '') {
                    alert('Bạn chưa nhập tên Tỉnh ');
                    document.getElementById('Name').focus();
                    return false;

                }

                return true;
            }
        </script>
        <script type="text/javascript">
            //select2 form search
            $('select').select2({
                theme: 'bootstrap4',
                allowClear: false,
            });
        </script>

    </fieldset>
</div>