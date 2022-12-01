<script src="js/jquery.js"></script>
<script type="text/javascript" src="js/chamcongqr/jquery.qrcode.js"></script>
<script type="text/javascript" src="js/chamcongqr/qrcode.js"></script>
<script src="./js/chamcongqr/face-api.js"></script>
<script src="./js/chamcongqr/html2canvas.min.js"></script>


<style>
    #githubLink {
        position: absolute;
        right: 0;
        top: 12px;
        color: #2D99FF;
    }

    .notifi {
        position: fixed;
        top: 100px;
        animation: notification 0.4s linear;
        right: 100px;
        background-color: #ffffff;
        padding: 10px 30px;
        font-weight: bold;
        box-shadow: 1px 1px 5px #e2e2e2;
        transition: all 0.3 linear;
    }

    h1 {
        margin: 10px 0;
        font-size: 40px;
    }

    #loadingMessage {
        text-align: center;
        padding: 40px;
        background-color: #eee;
    }

    #canvas {
        /* width: 70% !important; */
        z-index: 0;
    }

    #content__img {
        display: flex;
        flex-wrap: wrap;
        width: 50%;
        height: 400px;
        overflow: scroll;
    }

    #output {

        background: #eee;
        padding: 10px;
        padding-bottom: 0;
    }

    #output div {
        padding-bottom: 10px;
        word-wrap: break-word;
    }

    #noQRFound {
        text-align: center;
    }

    .container_ {
        display: flex;
        position: relative;
        justify-content: center;
    }

    #video_ {
        width: 600px;
        height: 480px;
        position: relative;
    }

    .form-face .selectSection {
        display: flex;
        padding: 10px;
        grid-template-columns: 1fr;
        flex-wrap: wrap;
    }

    .form-face .selectSection button {
        margin: 5px 5px;
        width: 80px;
        height: 111px;
        font-size: 12px;
        display: flex;
        align-items: flex-end;
        padding: 0;
        justify-content: center;
        color: #ff9800;
        font-weight: bold;
    }

    .button-next {}

    .image {
        display: none;
    }

    #xemhinh__ {
        display: none;
        position: fixed;
        background-color: #00000042;
        width: 100%;
        height: 100vh;
        left: 0;
        top: 0;
        align-items: center;
        justify-content: center;

    }

    .selectSection button {
        height: 85px
    }

    .selectSection button:hover {
        cursor: pointer;
    }

    .active {
        background-color: #87CEEB !important;
    }

    /* hides every element except the first */
    .content:not(:first-child) {
        display: none;
    }

    .contentSection {
        display: block;
    }

    .content {
        width: 130px;
    }

    .container_ video {
        width: 100%;
        height: 462px;
    }

    .container_ canvas {
        width: 100%
    }

    .container_ .left {
        width: 20%
    }

    .container_ .middle {
        width: 55%;
        position: relative
    }

    .container_ .middle .button-next {

        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .container_ .right {
        width: 35%;
        max-width: 35%;
        overflow-x: scroll;
        display: flex;
        position: relative;
    }

    .container_ .right .contentSection {
        display: flex;
        position: absolute;
        bottom: 0
    }

    .container_ .right .right_w {
        width: 100%;
        height: 100%;
    }

    #show_img_cap {
        display: flex;
        flex-direction: row;
        /* flex-wrap: wrap; */
        max-height: 279px;
        overflow-x: scroll;
        justify-content: flex-start;
        width: 350px;
    }

    #qrcoderes {
        width: 100%
    }

    #xemhinh__ .show_hinh_nhan_dien {
        display: flex;
        width: 700px;
        height: 500px;
        background-color: #ffffff;
        padding: 20px;
        flex-direction: column;
    }

    #xemhinh__ .show_hinh_nhan_dien .close__ {
        display: flex;
        justify-content: flex-end;
    }

    #xemhinh__ .show_hinh_nhan_dien img {
        margin-right: 10px;
        margin-bottom: 10px
    }

    #xemhinh__ .show_hinh_nhan_dien .content__ {

        display: flex;
        flex-direction: row;
        flex-wrap: wrap;

        height: 100%;
        padding: 20px
    }

    #loading {
        display: none;
        justify-content: center;
        align-items: center;

    }

    #avata {
        width: 50%;
        padding-right: 10px
    }

    #avata img {
        width: 100%;
    }

    #xemhinh__ .show_hinh_nhan_dien .content__ .img_ {
        background-position: center;
        background-repeat: no-repeat;
        background-size: contain;
        width: 80px;
        height: 80px;
        margin-bottom: 10px;
        margin-right: 10px;
    }

    .bg_contain {
        background-position: top;
        background-repeat: no-repeat;
        background-size: contain
    }

    .btn.active {
        background-color: #607d8b !important;
    }

    #loading_ {
        position: absolute;
        width: 100%;
        height: 100%;
        left: 0;
        top: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        background-color: #0000005c;
        display: none;
        z-index: 10000;
    }

    #container_video {
        position: relative
    }

    .find-image {
        margin: 10px 0 0 10px;
    }
</style>
</head>

<body>
    <div id="khonghienthi" style="display:none">

    </div>
    <div class="container_" id="container_">
        <div class="left">
            <div class="form-face" style="z-index: 99999; cursor: pointer;">
                <div class="selectSection">
                    <button type="button" data-number="1" id="1-1" onClick="SetidButton(1)"
                        class="bg_contain  btn_mau btn " style="background-image:url(images/trainface/doidien.jpg);"
                        disabled="disabled">Đối diện mặt</button>
                    <button type="button" data-number="2" id="2" onClick="SetidButton(2)" class="bg_contain btn_mau btn"
                        style="background-image:url(images/trainface/nghiengtrai.jpg)" disabled="disabled">Nghiêng
                        trái</button>
                    <button type="button" data-number="3" id="3" onClick="SetidButton(3)"
                        class="bg_contain btn_mau  btn" style="background-image:url(images/trainface/nghiengphai.jpg)"
                        disabled="disabled">Nghiêng phải</button>
                    <button type="button" data-number="4" id="4" onClick="SetidButton(4)" class="bg_contain btn_mau btn"
                        style="background-image:url(images/trainface/nguoctrai.jpg)" disabled="disabled">Ngước
                        trái</button>
                    <button type="button" data-number="5" id="5" onClick="SetidButton(5)" class="bg_contain btn_mau btn"
                        style="background-image:url(images/trainface/nguocphai.jpg)" disabled="disabled">Ngước
                        phải</button>
                    <button type="button" data-number="6" id="6" onClick="SetidButton(6)" class="bg_contain btn_mau btn"
                        style="background-image:url(images/trainface/nhinxuong.jpg)" disabled="disabled">Cuối
                        đầu</button>
                    <button type="button" data-number="7" id="7" onClick="SetidButton(7)" class="bg_contain btn_mau btn"
                        style="background-image:url(images/trainface/nguoclen.jpg)" disabled="disabled">Ngước
                        lên</button>
                </div>
            </div>
        </div>
        <div class="middle">
            <div id="container_video">
                <video id="video"></video>
                <canvas id="canvas" hidden></canvas>
                <div id="loading_"><img src="images/loading.gif" />Loading..</div>
            </div>
            <div class="button-next">
                <div>
                    <div id="loading" style="display:none;color:#FF0000;font-weight:bold"><img
                            src="images/loading.gif" />Loading..</div>
                </div>
                <div style="display:none">
                    <button id="chup" onClick="snapPicture()" disabled="disabled">Chụp hình</button>
                    <button id="luu" onClick="luuanh()" disabled="disabled">Lưu</button>
                </div>
            </div>
        </div>
        <div class="right">
            <div class="right_w" style="background-color: brown">
                <div id="output" style="display:flex;flex-direction: column">
                    <div>
                        <span id="outputData" style="color:#006600;font-weight:bold;    margin-left: 10px;"> </span>
                    </div>
                    <div>
                        <input type="text" value="" onChange="checkmanv(this.value)" id="manv" required>
                        <button onClick="showQRcode('',1)">chỉ tạo mã</button>
                        <div id="outputMessage">No QR code detected.</div>
                    </div>

                </div>

                <div id="show_img_cap">

                </div>
                <div id="show_img_current">

                </div>
                <div class="contentSection">
                    <!--<img class="content" data-number="1" src="images/trainface/doidien.jpg" alt="">
                <img class="content" data-number="2" src="images/trainface/nghiengtrai.jpg" alt="">
                <img class="content" data-number="3" src="images/trainface/nghiengphai.jpg" alt="">
                <img class="content" data-number="4" src="images/trainface/nguoctrai.jpg" alt="">
                <img class="content" data-number="5" src="images/trainface/nguocphai.jpg" alt="">
                <img class="content" data-number="6" src="images/trainface/nhinxuong.jpg" alt="">
                <img class="content" data-number="7" src="images/trainface/nguoclen.jpg" alt="">-->
                </div>
            </div>
        </div>




    </div>
    <div id="img_out" style="width:500px;margin-bottom:1em"></div>
    <div id="qrcoderes" style="display:none">

        <div class="qr_w"
            style="padding:20px;display:flex;align-items: center; justify-content: center;    background-color: #ffffff;">
            <div id="qrcode" style="height:450px;width:450px;" v-loading="PanoramaInfo.bgenerateing"></div>
        </div>

    </div>
    <div class="find-image">
        <h4>Kiểm tra hình ảnh</h4>
        <div>
            <input type="manv" id="check_manv" placeholder="Nhập mã NV">
            <button type="button" onclick="xemhinhnhandien(1,check_manv.value)">Kiểm tra</button>
        </div>
        <div id="xemhinh__">

            <div class="show_hinh_nhan_dien">
                <div class="close__">
                    <button onclick="xemhinhnhandien(2)">Close</button>
                </div>
                <div id="loading">
                    <img src="images/loading.gif" />
                </div>
                <div class="content__">
                    <div id="avata">
                    </div>
                    <div id="content__img"></div>
                </div>
            </div>
        </div>
    </div>




    <script>
        var video = document.getElementById("video");
        var canvasElement = document.getElementById("canvas");
        var canvas_ = canvasElement.getContext("2d");

        var loadingMessage = document.getElementById("loadingMessage");
        var outputContainer = document.getElementById("output");
        var outputMessage = document.getElementById("outputMessage");
        var outputData = document.getElementById("outputData");
        var beforeCode = '';
        var isFace = 0;
        var domain = 'js/chamcongqr/';
        var idbutton = "1-1";
        var LinkApi = "https://sv4.ovn.vn:70";
        //var LinkApi = "https://sv6.ovn.vn:90";
        function SetidButton(value) {
            idbutton = value
        }

        function downloadURI() {
            var html = document.getElementById("qrcoderes");
            html2canvas(document.querySelector("#qrcoderes"), {
                width: 500,
                height: 500
            }).then(canvas => {
                document.getElementById("qrcoderes").style.display = "none"

                var link = document.createElement("a");
                document.getElementById("img_out").innerHTML = "";
                document.getElementById("img_out").append(canvas);
                /*  link.download = name;
                  link.href = canvas.toDataURL();
                  link.click()*/
            });



        };

        function xemhinhnhandien(type, manv = "") {
            var LinkApi = 'https://image.fmstyle.com.vn/anhchamcong/nhanviengetanh.php';
            var linkhinh = "https://image.fmstyle.com.vn/anhchamcong/";
            console.log(manv);
            if (type == 1) {

                if (!manv) {
                    return;
                }
                manv = manv.toLowerCase();
                document.getElementById("avata").innerHTML = '<img src="https://image.fmstyle.com.vn/anhchamcong/anhnv/' + manv + '.png"/>'

                isLoading(true)
                document.getElementById('xemhinh__').style.display = "flex";
                document.getElementById("content__img").innerHTML = "";
                sendAjax(LinkApi + "?type=getface", "POST", { "manv": manv }).then(response => response.text()).then(result => {

                    result = JSON.parse(result)
                    if (result.code == 200) {
                        var data = result.data;

                        var chuoihtml = '';
                        for (var i = 0; i < data.length; i++) {

                            chuoihtml += '<div class="img_" style="background-image:url(' + linkhinh + data[i] + ')"></div>';
                            var div = document.createElement("div");
                            div.setAttribute("class", "img_");
                            div.style.backgroundImage = 'url(' + linkhinh + data[i] + ')';

                            document.getElementById("content__img").append(div)
                        }

                    } else {
                        document.getElementById("content__img").innerHTML = result.message
                    }
                    console.log('result', result);

                    isLoading(false)
                }).catch(error => {
                    isLoading(false)
                    console.log('error', error);

                });

            } else {
                document.getElementById('xemhinh__').style.display = "none";
            }
        }
        function showQRcode(value, type = 2) {
            if (type == 1) {
                value = document.getElementById("manv").value
                if (!value) {
                    return
                }
            }


            let qrcode = new QRCode(document.getElementById("qrcode"),
                {
                    text: value,
                    width: 450,
                    height: 450,

                    // colorDark : "#000000",
                    //colorLight : "#ffffff",
                    //correctLevel : QRCode.CorrectLevel.H
                });
            setTimeout(
                function () {
                    //contextTextBox.drawImage(img, 0, 0, 378, 150);
                    let dataUrl = document.querySelector('#qrcode').querySelector('img').src;

                    downloadURI();
                }
                , 1000);
            document.getElementById("qrcoderes").style.display = "flex"
        };

        let Buttons = document.querySelectorAll(".selectSection button");
        for (let button of Buttons) {
            // listen for a click event 
            button.addEventListener('click', (e) => {
                const et = e.target;
                const active = document.querySelector(".active");
                if (active) {
                    active.classList.remove("active");
                }
                et.classList.add("active");
                let allContent = document.querySelectorAll('.content');
                for (let content of allContent) {
                    if (content.getAttribute('data-number') === button.getAttribute('data-number')) {
                        content.style.display = "block";
                    }
                    else {
                        content.style.display = "none";
                    }
                }
            });
        }

        function sendAjax(LinkApi, method, data) {
            var myHeaders = new Headers();
            myHeaders.append("Content-Type", "application/json");
            var raw = JSON.stringify(data);
            var requestOptions = {
                method: 'POST',
                headers: myHeaders,
                body: raw,
                redirect: 'follow'
            };
            return fetch(LinkApi, requestOptions)
        }
        function isLoading(type) {
            if (type) {
                document.getElementById("loading_").style.display = "flex";
            }
            else {
                document.getElementById("loading_").style.display = "none";
            }
        }
        function drawLine(begin, end, color) {
            canvas.beginPath();
            canvas.moveTo(begin.x, begin.y);
            canvas.lineTo(end.x, end.y);
            canvas.lineWidth = 4;
            canvas.strokeStyle = color;
            canvas.stroke();
        }

        function ConvertCanvasToImg(canvas, input, code) {

            // init canvas with video input
            canvas.width = input.width;
            canvas.height = input.height;
            canvas.getContext('2d').drawImage(input, 0, 0, canvas.width, canvas.height);
            let ctx = canvas.getContext("2d");
            //draw a red box
            ctx.fillStyle = "#FF0000";
            ctx.fillRect(10, 10, 30, 30);
            var w_t = canvas.width;
            var h_t = canvas.height;
            var datet = new Date().toLocaleString();
            ctx.font = "20pt Calibri";
            ctx.fillText(datet, 350, 30);
            ctx.fillText(code, 350, 60);
            let url = canvas.toDataURL();

            return url;
        }
        Promise.all([
            faceapi.nets.tinyFaceDetector.loadFromUri(domain + 'models'),
            faceapi.nets.faceLandmark68Net.loadFromUri(domain + 'models'),
            faceapi.nets.faceRecognitionNet.loadFromUri(domain + 'models'),
            faceapi.nets.faceExpressionNet.loadFromUri(domain + 'models')
        ]).then(startVideo)
        async function startVideo() {
            if (navigator.mediaDevices.getUserMedia) {
                navigator.mediaDevices.getUserMedia({
                    video: true
                }).then(async function (stream) {

                    video.srcObject = stream;
                    video.setAttribute("playsinline", true); // required to tell iOS safari we don't want fullscreen
                    await video.play();
                    //var $this = this; //cache
                    canvasElement.height = video.videoHeight;
                    canvasElement.width = video.videoWidth;
                    video.width = 640;
                    video.height = 480;
                    video.setAttribute("playsinline",
                        true); // required to tell iOS safari we don't want fullscreen
                    console.log(video);
                    const canvas = faceapi.createCanvasFromMedia(video)
                    canvas.setAttribute("onclick", "snapPicture()");
                    canvas.style.position = 'absolute';
                    canvas.style.top = 0;
                    canvas.style.left = 0;
                    document.getElementById('container_video').append(canvas);

                    const displaySize = {
                        width: video.width,
                        height: video.height
                    }
                    faceapi.matchDimensions(canvas, displaySize);
                    setInterval(async () => {

                        canvas_.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);
                        const detections = await faceapi.detectAllFaces(video,
                            new faceapi.TinyFaceDetectorOptions())
                            .withFaceLandmarks().withFaceExpressions()
                        const resizedDetections = faceapi.resizeResults(detections,
                            displaySize)
                        canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas
                            .height)
                        faceapi.draw.drawDetections(canvas, resizedDetections)
                        // faceapi.draw.drawFaceLandmarks(canvas, resizedDetections)
                        // faceapi.draw.drawFaceExpressions(canvas, resizedDetections)
                        isFace = detections.length;
                    }, 100);


                });
            }
        }
        /*(
         async function startVideo() {
             navigator.mediaDevices.getUserMedia({
                 video: {
                     facingMode: "environment"
                 }
             }).then(async function (stream) {
                 video.srcObject = stream;
               
                 video.setAttribute("playsinline", true); // required to tell iOS safari we don't want fullscreen
                 await video.play();
                 canvasElement.height = video.videoHeight;
                          canvasElement.width = video.videoWidth;
                 //cVideo.addEventListener("loadedmetadata", ()=>{{);
                     (function loop() {
                     	
                             canvas = canvasElement.getContext("2d");
                             canvas.drawImage(video, 0, 0,canvasElement.width,canvasElement.height);
                             canvas.scale(1, 1);
                             setTimeout(loop, 1000 / 30); // drawing at 30fps
                     })();
                 	
         /
                
                
             });
 
 
         }
 )()
 */

        function checkmanv(manv) {
            isLoading(true)
            var poststr = "DATA=" + encodeURIComponent(manv) + "*@!";
            loadtrang('khonghienthi', "facetraincheck", poststr, "xuly1");
        }

        function xuly1() {
            isLoading(false);
            var tam = document.getElementById("khonghienthi").innerHTML;


            if (tam) {
                tam = tam.split("###");
                console.log(tam);
                if (tam[1] == 1) {
                    notification(200, "Tìm thấy nhân viên")
                    document.getElementById("outputData").innerHTML = tam[4];
                    document.getElementById("chup").disabled = false
                }
                if (tam[1] == 0) {
                    notification(201, "Không tìm thấy nhân viên")
                }
            }
        }
        var anhnv = '';

        var imgAr = [];



        var slanh = 0;
        function snapPicture() {
            var code = document.getElementById('manv').value;
            if (!code) {
                alert("Vui lòng nhập mã nhân viên!");
                return;
            }
            if (imgAr.length > 5) {
                document.getElementById('luu').disabled = false;
            }
            if (imgAr.length > 9) {
                document.getElementById('chup').disabled = true;
            }
            //anhnv = ConvertCanvasToImg(canvas, video);
            var img = document.createElement("img");
            canvas_.fillStyle = "#FF0000";
            canvas_.fillRect(10, 10, 30, 30);
            var w_t = canvas_.width;
            var h_t = canvas_.height;
            var datet = new Date().toLocaleString();
            canvas_.font = "20pt Calibri";
            canvas_.fillText(datet, 350, 30);
            canvas_.fillText(code, 350, 60);
            img.src = canvasElement.toDataURL();

            document.getElementById("show_img_current").innerHTML = '<img  style="width:100%" src="' + canvasElement.toDataURL() + '"/>'

            img.style.width = "50px";
            img.style.marginRight = "10px"
            img.style.marginTop = "10px"
            img.style.marginBottom = "10px"


            document.getElementById("show_img_cap").append(img);

            const btn_mau = document.getElementsByClassName('btn_mau');
            console.log(btn_mau);
            for (var i = 0; i < btn_mau.length; i++) {
                slanh++;
                btn_mau[i].style.backgroundImage = "url('"+img+"')";
            }


            luuanh1(canvasElement.toDataURL(), code);

            //document.getElementById(idbutton).disabled=true;
            //chuyenut();
            // console.log(imgAr);



            //var dataImg = {
            //    id: code,
            //     url: src
            //  };

            //  return anhnv;

        }

        function luuanh1(links, code) {
            console.log(links);
            isLoading(true)
            sendAjax(LinkApi + '/addfaceone', 'POST', {
                "type": 1,
                "manv": code,
                "links": links,
                "stt": (imgAr.length + 1)
            }).then(response => response.text())
                .then(result => {
                    result = JSON.parse(result)
                    console.log(result);
                    if (result.code == 200) {
                        chuyenut1();
                        if (imgAr.length >= 7) {
                            notification(300, "Chụp xong rồi !")
                            imgAr = [];
                            resetnutmau1();

                        } else {
                            imgAr.push(links);
                            notification(result.code, result.message)
                        }

                    }
                    isLoading(false)


                })
                .catch(error => {
                    notification(201, "Lỗi! vui lòng thử lại")
                    console.log('error', error);
                    isLoading(false)
                });
        }

        function resetnutmau() {
            const btn_mau = document.getElementsByClassName('btn_mau');
            for (var i = 0; i < btn_mau.length; i++) {
                const element = btn_mau[i];
                element.disabled = false;
                element.classList.remove("active");
            }
            btn_mau[0].classList.add("active");
        }
        function resetnutmau1() {
            const btn_mau = document.getElementsByClassName('btn_mau');
            for (var i = 0; i < btn_mau.length; i++) {
                const element = btn_mau[i];

                element.classList.remove("active");
            }

        }
        function chuyenut1() {
            const btn_mau = document.getElementsByClassName('btn_mau');
            let next = 0;
            for (var i = 0; i < btn_mau.length; i++) {
                const element = btn_mau[i];
                if (!element.classList.contains("active")) {
                    next = i;
                    break;
                }
            }
            btn_mau[next].classList.add("active");
        }

        function chuyenut() {
            const btn_mau = document.getElementsByClassName('btn_mau');
            for (var i = 1; i < btn_mau.length; i++) {
                const element = btn_mau[i];
                var dat_num = element.getAttribute("data-number");
                if (dat_num != 1) {
                    if (element.disabled == false) {
                        document.getElementById(dat_num).classList.add("active");
                        idbutton = dat_num;
                        console.log(dat_num);
                        break;
                    }
                }



                //return;
                //if(dat_num!="1"){

                //}	
            }
        }
        function luuanh() {
            const valueName = document.getElementById('manv').value;
            if (!valueName) {
                alert("Vui lòng nhập mã nhân viên!");
                return;
            }

            if (imgAr.length <= 0) {
                alert("Chụp tối thiểu 5 tấm hình!");
                return;
            }
            document.getElementById('luu').disabled = true;
            isLoading(true)

            sendAjax(LinkApi + '/addface', 'POST', {
                "type": 1,
                "manv": valueName,
                "links": imgAr
            }).then(response => response.text())
                .then(result => {

                    result = JSON.parse(result)
                    console.log(result);
                    if (result.code == 203) {

                    }

                    if (result.code == 200) {

                        showQRcode(valueName);
                        document.getElementById('manv').value = '';
                        document.getElementById("show_img_cap").innerHTML = "";
                        document.getElementById('luu').disabled = true;
                        document.getElementById('chup').disabled = true;


                        var data1 = result.data1;
                        if (data1) {
                            data1 = JSON.parse(data1);
                            console.log('data1', data1.data.length);
                            if (data1.data.length < imgAr.length) {
                                notification(201, "Ko đủ hình ảnh khuôn mặt. vui lòng chụp lại")
                            } else {
                                notification(result.code, result.message)
                            }

                        }

                    }
                    else {
                        notification(result.code, result.message)
                        document.getElementById('chup').disabled = false;
                        document.getElementById('luu').disabled = false;
                    }


                    isLoading(false)
                    imgAr = [];
                    resetnutmau();
                })
                .catch(error => {
                    notification(201, "Lỗi! vui lòng thử lại")
                    console.log('error', error);
                    isLoading(false)
                    document.getElementById('luu').disabled = false;
                    imgAr = [];
                    resetnutmau();
                });



        }


        function checkimgSize(src) {

            var base64str = src.substr(22);
            var decoded = atob(base64str);

            return decoded.length;
        }

        function luuanhnhanvien(poststr) {
            var LinkApi = "/fm/nhanvienluuanh.php";
            // var LinkApi = "https://localhost/fmstylemoi.vn/nhanvienluuanh.php/";	
            // send ajax	
            //   alert(LinkApi) ; return ;	
            const sendimg = sendAjax(LinkApi, "POST", {
                data: JSON.stringify(poststr)
            });
            sendimg.done(function (response, textStatus, jqXHR) {

                luuAnhTam(poststr);

                if (response.data == -2) {
                    alert('Hình ảnh chưa được tạo vui lòng chụp lại!');
                }
                if (response.data == 0) {
                    guilaianh();
                    localStorage.setItem("kiemtraham", 1);
                } else {
                    var hinhtam = localStorage.getItem("hinhtam");
                    if (hinhtam) {
                        hinhtam = JSON.parse(hinhtam);
                        var tama = hinhtam.filter((element, index) => {
                            return element.id != poststr.id;
                        });
                        localStorage.setItem("hinhtam", JSON.stringify(tama));
                    }
                }
                localStorage.setItem("imguser", response.data);
            });
            sendimg.fail(function (jqXHR, textStatus, errorThrown) {
                console.error("The following error occurred: " + textStatus, errorThrown);
            });
        }
        var vitrihinh = 0;


        function guilaianh() {
            localStorage.setItem("kiemtraham", 1);
            var hinhtam = localStorage.getItem("hinhtam");
            if (hinhtam) {
                hinhtam = JSON.parse(hinhtam);
                if (hinhtam.length > 0) {

                    var LinkApi = "/fm/nhanvienluuanh.php";

                    const sendimg = sendAjax(LinkApi, "POST", {
                        data: JSON.stringify(hinhtam[0])
                    });
                    sendimg.done(function (response, textStatus, jqXHR) {

                        if (response.data != 0) {
                            vitrihinh++;
                            console.log('tải thành công');
                            var tama = hinhtam.filter((element, index) => {
                                return index > 0;
                            });

                            localStorage.setItem("hinhtam", JSON.stringify(tama));
                            setTimeout(() => {
                                guilaianh();
                            }, 5000);
                        } else {

                            console.log('tải lại');
                            localStorage.setItem("kiemtraham", 0);
                            setTimeout(() => {
                                kiemtraanhloi();
                            }, 5000);

                        }


                    });
                    sendimg.fail(function (jqXHR, textStatus, errorThrown) {
                        console.error("The following error occurred: " + textStatus, errorThrown);
                    });
                }
            }

        }

        function luuAnhTam(poststr) {
            var hinhtam = localStorage.getItem("hinhtam");

            if (hinhtam) {
                hinhtam = JSON.parse(hinhtam);

            } else {
                hinhtam = [];
            }
            var index = -1;
            if (hinhtam.length > 0) {
                for (var i = 0; i < hinhtam.length; i++) {
                    if (hinhtam[i].id == poststr.id) {

                        index = i;
                    }
                }

            }

            if (index != -1) {
                hinhtam[index].url = poststr.url;
            }

            if (index == -1) {
                hinhtam.push(poststr);
            }

            if (hinhtam.length == 0) {
                hinhtam.push(poststr);
            }

            localStorage.setItem("hinhtam", JSON.stringify(hinhtam));

        }
        var clearinte = '';

        window.onload = () => {
            kiemtraanhloi(2)
        }

        function kiemtraanhloi(trt = '') {
            clearinte = setInterval(() => {
                var kiemtrahinh = localStorage.getItem("kiemtraham");
                var hinhtam = localStorage.getItem("hinhtam");

                if (hinhtam) {
                    if (trt == 2) {
                        guilaianh();
                        clearInterval(clearinte);
                    }
                    hinhtam = JSON.parse(hinhtam);
                    if (kiemtrahinh != 1) {
                        if (hinhtam.length > 0) {
                            guilaianh();
                        }
                    } else {
                        clearInterval(clearinte);
                    }
                } else {
                    return;
                }

            }, 5000);

        };
        var idnot = 1;

        function notification(code, text) {
            var div = document.createElement("div");
            div.innerHTML = text;
            div.classList.add("notifi");
            div.setAttribute("id", idnot);
            if (code == 201) {
                div.style.color = '#ff9800';
            }
            if (code == 200) {
                div.style.color = 'green';
            }
            if (code == 300) {
                div.style.color = '#e91e63';
            }
            document.body.appendChild(div);
            setTimeout(() => {
                document.getElementById(idnot).remove();
            }, 3000);
        }
    </script>