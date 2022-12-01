<!DOCTYPE html>
<html lang="en">

<head>
    <!-- <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <title>Document</title>
</head>

<body>
    <style>
    @media all and (min-width: 414px) {}

    /* @media all and (min-width: 600px) { */
    .title {
        font-size: 70px;
    }

    #qr-reader-results {
        width: 100%;
        height: 100%;
        display: none;
        position: fixed;
        background-color: #00000057;
        align-items: flex-end;
        transiton: all 0.9s linear;
    }

    #result_content {
        border: 1px solid silver;
        background-color: #FFFFFF;
        width: 90%;
        height: 80%;
        margin: 0 auto;
        padding: 1em;
        border-radius: 10px;
    }

    #result_content input {
        width: 40%;
    }

    #result_content input,
    #result_content button {}

    #result_content button {}

    #info {
        margin-top: 30px;
        display: flex;
        height: 100%;
        flex-direction: column;
    }

    #result_content .lab {
        font-size: 40px;
        font-weight: bold;
    }

    #result_content h1 {
        font-size: 40px;
    }

    .scan {
        min-height: 80%;
    }

    .wrap_scan {
        width: 100%;
        /*background-color:#FFFFFF;*/
        height: 100vh;
        position: fixed;
        display: flex;
        flex-direction: column;
    }

    input,
    button,
    select,
    textarea {
        font-size: unset !important;
        font-size: 30px !important;
        padding: 1em;
    }

    .qr-reader {
        width: 100%;
        display: flex;
        height: 80% !important;
    }

    #qr-reader {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100% !important;
    }

    #qr-reader video {
        /*object-fit: cover;
				width:95% !important;
				height:100%;*/
    }

    #qr-reader__scan_region {
        /*   width: 100% !important;
    margin: 0 auto;
   
			text-align: center;
			display: flex;
			position: relative;
			background-color: #ffffff;
			flex-direction: column;
			align-items: center;
			justify-content: center;*/
    }

    #qr-shaded-region {}

    #qr-reader__scan_region img {
        width: 50%;
    }

    #qr-reader__dashboard_section_swaplink {
        text-decoration: underline;
        display: inline-block;
        font-size: 40px;
        margin-top: 1em;
        color: #000000;
    }

    #qr-reader__dashboard_section_fsr {
        font-size: 40px;
        display: flex;
    }

    #qr-reader__dashboard_section_fsr input {
        width: 70% !important;
        /* height: 100px; */
        margin: 0 auto;
        border: 1px solid #ffffff;
    }

    /*#qr-reader__dashboard_section_swaplink{
			display:flex !important;
			color:#FFFFFF;
			justify-content: center;
		}*/
    #close {
        display: flex;
        padding: 0.5em;
        align-items: center;
        justify-content: space-between;
    }

    #close button {
        background-color: unset;
        border: none;
        font-size: 40px !important;
    }

    #close button:focus {
        border: none;
        outline: none;
    }

    #close button:active {
        border: none;
        outline: none;
    }

    #loading {
        display: none;
        align-items: center;
        justify-content: center;
        font-size: 30px;
    }

    #loading img {
        width: 50px;
    }

    @media all and (min-width: 1024px) {

        #result_content input,
        #result_content button {}

        #result_content button {}

        #info {
            margin-top: 0;
            display: flex;
            height: 100%;
            flex-direction: column;
        }

        #result_content .lab {
            font-size: 18px;
            font-weight: bold;
        }

        #result_content h1 {
            font-size: 18px;
        }

        #close {
            display: none !important;
        }

        #qr-reader-results {
            position: unset;
            display: flex;
            border: 1px solid silver;
            width: 45%;
            height: 100%;
        }

        #result_content {
            border: 1px solid silver;
            background-color: #FFFFFF;
            width: 100%;
            height: 100%;
            margin: 0 auto;
            border-radius: 0;
            padding: 0 1em;
        }

        .wrap_scan {
            width: 100%;
            /*background-color:#FFFFFF;*/
            height: 100vh;
            position: unset;
        }

        .wrap_scan {}

        .wrap_scan {
            width: 100%;
            /*background-color:#FFFFFF;*/
            height: 100vh;
        }

        input,
        button,
        select,
        textarea {
            font-size: unset !important;
            font-size: 14px !important;
            padding: 0.5em;
        }

        #qr-reader {
            display: flex;
            width: 60% !important;
            flex-direction: column;
            justify-content: space-between;
        }

        #qr-reader video {
            object-fit: cover;
        }

        #qr-reader__scan_region {
            /*width:100% !important;
			margin:0 auto;
				
			text-align: center;
			display: flex;
			position: relative;
			background-color: #000;
			flex-direction: column;
			align-items: center;
			justify-content: center;*/
        }

        #qr-reader__scan_region {}

        #qr-reader__scan_region img {
            width: 40%;
        }

        #qr-reader__dashboard_section_swaplink {
            text-decoration: underline;
            display: inline-block;
            font-size: 20px;
            margin-top: 1em;
            color: #000;
        }

        #qr-reader__dashboard_section_fsr {
            font-size: 40px;
        }

        #qr-reader__dashboard_section_fsr input {
            width: 80% !important;
            margin: 0 auto;
        }
    }
    </style>
    <div class="wrap_scan">
        <div class="title" align="center">Scaner</div>
        <div class="qr-reader">
            <div id="qr-reader" style="width:100%"></div>
            <div id="qr-reader-results" style="">
                <div id="result_content">
                    <div id="close" style="display:flex;">
                        <h1>Kết quả</h1><button onClick="closepop()" style="">X</button>
                    </div>
                    <div id="info">
                        <div id="loading"><img src="images/loading.gif" />Loading...</div>
                        <p><label class="lab">Mã Sản phẩm: </label><input type="text" id="masp" /><button id="btncopy"
                                onClick="coppylink('masp')" value="">copy</button></p>
                        <p><label class="lab ">tên Sản phẩm: </label><span class="lab " id="tensp"></span></p>
                        <p><img src="" id="anhsp" /></p>
                    </div>
                </div>
            </div>
        </div>
        <button onClick="test()">test</button>
    </div>
    <div id="khonghienthi" style="display:none">
    </div>
    <script src="js/jquery.js"></script>
    <script type="text/javascript" src="js/function.js"></script>
    <script language=JavaScript src="js/load.js"></script>
    <script src="qrcode1/minified/html5-qrcode.min.js"></script>
    <script>
    function docReady(fn) {
        // see if DOM is already available
        if (document.readyState === "complete" || document.readyState === "interactive") {
            // call on next available tick
            setTimeout(fn, 1);
        } else {
            document.addEventListener("DOMContentLoaded", fn);
        }
    }
    var masp = '';
    docReady(function() {
        var resultContainer = document.getElementById('qr-reader-results');
        var lastResult, countResults = 0;

        function onScanSuccess(decodedText, decodedResult) {
            // alert(`Scan result ${decodedText}`, decodedResult);
            /*  if (decodedText !== lastResult) {
                  ++countResults;
                  lastResult = decodedText;
                  // Handle on success condition with the decoded message.
                  alert(`Scan result ${decodedText}`, decodedResult);
              }*/
            //reseresult();
            masp = decodedText;
            showloading();
            showpop();
            getsp(decodedText);
        }
        var html5QrcodeScanner = new Html5QrcodeScanner("qr-reader", {
            fps: 2,
            qrbox: 500
        });
        html5QrcodeScanner.render(onScanSuccess);
    });

    function getsp(masp) {
        poststr = "DATA=" + encodeURIComponent(masp) + "*@!" + encodeURIComponent(0);
        loadtrang('khonghienthi', "kiemtrasp", poststr, "xuly1");
    }

    function xuly1() {
        var tam = document.getElementById('khonghienthi').innerHTML;
        if (tam) {
            document.getElementById('tensp').innerHTML = tam;
            document.getElementById('masp').value = masp;
            document.getElementById('btncopy').value = masp;
            closeloading();
        } else {
            document.getElementById('tensp').innerHTML = 'Sản phẩm ko có!';
        }
    }

    function reseresult() {
        document.getElementById('tensp').innerHTML = '';
        document.getElementById('masp').value = '';
        document.getElementById('btncopy').value = '';
    }

    function showpop() {
        var resultContainer = document.getElementById('qr-reader-results');
        resultContainer.style.display = "flex";
    }

    function closepop() {
        var resultContainer = document.getElementById('qr-reader-results');
        resultContainer.style.display = "none";
    }

    function showloading() {
        var resultContainer = document.getElementById('loading');
        resultContainer.style.display = "flex";
    }

    function closeloading() {
        var resultContainer = document.getElementById('loading');
        resultContainer.style.display = "none";
    }

    function test() {
        var resultContainer = document.getElementById('qr-reader-results');
        resultContainer.style.display = "flex";
    }

    function coppylink(value) {
        var input = document.getElementById(value);
        input.select();
        var result = document.execCommand('copy');
    }
    </script>
</body>

</html>