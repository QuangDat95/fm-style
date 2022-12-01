<!-- BEGIN: block_login -->
<div class="wrapper_login">
    <div class="login-page">
        <div class="form">
            <!--<form class="register-form">
						<input type="text" placeholder="tên đặt nhập" name="txtUserName" />
						<input type="password" placeholder="password" name="txtPassword" />
						<input type="text" placeholder="email address" />
						<button>create</button>
						<p class="message">Already registered? <a href="#">Sign In</a></p>
					</form>-->
            <form class="login-form" action="" method="post">
                <input type="text" placeholder="username" placeholder="tên đặt nhập" name="txtUserName" />
                <input type="password" placeholder="password" placeholder="password" name="txtPassword" />
                <button type="submit" name="btnLogin">login</button>
                <!-- <p class="message">Not registered? <a href="#">Create an account</a></p> -->
            </form>
        </div>
    </div>
    <script>
        /*$('.message a').click(function() {
                                                                            $('form').animate({
                                                                                height: "toggle",
                                                                                opacity: "toggle"
                                                                            }, "slow");
                                                                        });*/
    </script>
</div>
<!-- END: block_login -->
<!-- BEGIN: block_home -->
<div class="tt">
    <img src="./images/logonho.png" />
    <h1>Bán hàng</h1>
</div>
<section class="info_nv">
    <!-- <div class="title"><span>Thông tin nhân viên</span></div> -->
    <div class="info">
        <div><label>Người bán</label>:</div>
        <div>Đoàn tấn đạt</div>
    </div class="info">
    <div class="info">
        <div><label>Ngày bán</label>:</div>
        <div>Đoàn tấn đạt</div>
    </div>
    <div class="info">
        <div><label>Chi nhánh</label>:</div>
        <div>48 yên bái</div>
    </div>
</section>
<section class="info_nv">
    <!-- <div class="title"><span>Tìm sản phẩm</span></div> -->
    <div class="info">
        <div class="find">
            <div id="loadingtim" style=""><img style="width:20px" src="images/loading.gif" />loading...</div>
            <input type="text" id="masp" name="masp">
            <button class="btn btn-wraning " onClick="timtheomacode(masp.value)">Tìm</button>
            <div class="scaner_w">
                <div class="scaner"><button onClick="loadfile()" class="btn">
                        <ul class="bars">
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                        <div class="scanner">
                            <div>
                                <ul>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                </ul>
                            </div>
                        </div>
                    </button></div>
            </div>
        </div>
    </div>
</section>
<section class="info_nv findpr">
    <!-- <div class="title"><span>Thông tin bán</span></div> -->
    <div class="tableresponsive ">
        <div id="showsp">
            <!-- <div class="itempr boder_" id="itempr1" data-id="1">
                        <div class="left" id="itemprleft1" data-id="1">
                            <div class="name" data-id="1">tên sp</div>
                            <div class="price" data-id="1">
                                <span data-id="1">123456</span>
                                <span data-id="1">x</span>
                            </div>
                        </div>
                        <div class="right" id="itemprright1" data-id="1">
                            <div class="price " data-id="1">
                                <div class="slthaydoi" id="slthaydoi" data-id="1">1</div>
                                <button class="btn tanggiam" data-id="1">-</button>
                                <button class="btn tanggiam" data-id="1">+</button>
                            </div>
                        </div>
                        <button class="delete_hidden " id="delete_hidden1">Xóa</button>
                    </div> -->
        </div>
    </div>
</section>
<section class="bottom">
    <div class="tongtienhd" id="tongtienhd">
    </div>
    <div>
        <div class="left">Đặt hàng</div>
        <div class="right">Thanh toán</div>
    </div>
</section>
<section data-include="scaner" id="screen_scan">
    <!-- <iframe src=""></iframe> -->
</section>
<div id="reshidden" style="display:none"></div>
</div>
<script src="./js/jquery.js"></script>
<script type="text/javascript" src="./js/function.js"></script>
<script language=JavaScript src="./js/load.js"></script>
<script language=JavaScript src="./js/xuatkho.js"></script>
<script src="./qrcode1/minified/html5-qrcode.min.js"></script>
<script>
    var tapped = false
    $(".row_pr").each((index, el) => {
        $(el).on("touchstart", function(e) {
            var id = el.getAttribute("data-id");
            if (!tapped) { //if tap is not set, set up single tap
                tapped = setTimeout(function() {
                    tapped = null
                        //insert things you want to do when single tapped
                }, 300); //wait 300ms then run single click code
            } else { //tapped within 300ms of last tap. double tap
                clearTimeout(tapped); //stop single tap callback
                tapped = null
                    //insert things you want to do when double tapped
                console.log(id)
                $(".delete_hidden").removeClass("show_table_cell");
                $("#delete_hidden" + id).addClass("show_table_cell");
                $("#delete_hidden_close").addClass("show_table_cell");
            }
            e.preventDefault()
        });
    });

    function showDelete(id) {
        $(".delete_hidden").removeClass("show_table_cell");
        $("#delete_hidden" + id).addClass("show_table_cell");
        $("#delete_hidden_close").addClass("show_table_cell");
    }

    function closeDelete(id) {
        $(".delete_hidden").removeClass("show_table_cell");
    }

    function showscreen_scan() {
        $("#screen_scan").addClass("show_flex");
    }

    function clsoecreen_scan() {
        $("#screen_scan").removeClass("show_flex");
    }

    function loadfileiframe() {
        showscreen_scan();
        $("#screen_scan iframe").attr("src", "quetma.php")
    }

    function loadfile() {
        showscreen_scan();
        var includes = $('[data-include]')
        $.each(includes, function() {
            var file = 'templates/' + $(this).data('include') + '.tpl'
            $(this).load(file)
        })
    }
    ///vuốt màn hình
    var xDown = null;
    var yDown = null;

    function getTouches(evt) {
        return evt.touches || // browser API
            evt.originalEvent.touches; // jQuery
    }

    function handleTouchStart(evt) {
        const firstTouch = getTouches(evt)[0];
        xDown = firstTouch.clientX;
        yDown = firstTouch.clientY;
    };

    function handleTouchMove(evt) {
        if (!xDown || !yDown) {
            return;
        }
        var target = evt.target;
        var dataid = target.getAttribute('data-id');
        var iditem = "#itempr" + dataid;
        var iditleft = "#itemprleft" + dataid;
        var iditright = "#itemprright" + dataid;
        var btnxoa = "#delete_hidden" + dataid;
        var xUp = evt.touches[0].clientX;
        var yUp = evt.touches[0].clientY;
        var xDiff = xDown - xUp;
        var yDiff = yDown - yUp;
        if (Math.abs(xDiff) > Math.abs(yDiff)) {
            /*most significant*/
            if (xDiff > 0) {
                /* left swipe */
                $(iditleft).addClass('dichuyentrai');
                $(iditleft).addClass('dichuyentrai');
                $(btnxoa).addClass('show_width');
                //$("#itempr" + dataid + " right").addClass("dichuyentrai");
                console.log(iditleft);
            } else {
                /* right swipe */
                $(iditleft).removeClass('dichuyentrai');
                $(iditright).removeClass('dichuyentrai');
                $(btnxoa).removeClass('show_width');
            }
        } else {
            if (yDiff > 0) {
                /* up swipe */
            } else {
                /* down swipe */
            }
        }
        /* reset values */
        xDown = null;
        yDown = null;
    };
</script>
<!-- END: block_home -->