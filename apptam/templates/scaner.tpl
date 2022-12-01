<div class="wrap_scan" id="wrap_scan_remove">
    <div class="title_sc" align="center">Scaner</div>
    <div class="qr-reader">
        <div id="qr-reader" style="width:100%"></div>
        <div id="qr-reader-results" style="">
            <div id="result_content">
                <div id="close" style="display:flex;">
                    <h1>Kết quả</h1><button onClick="closepop()" style="">X</button>
                </div>
                <div id="info">
                    <div id="loading"><img src="images/loading.gif" />Loading...</div>
                    <p><label class="lab">Mã Sản phẩm: </label><input type="text" id="maspres" /><button id="btncopy" onClick="coppylink('maspres')" value="">copy</button></p>
                    <p><label class="lab ">tên Sản phẩm: </label><span class="lab " id="tensp"></span></p>
                    <p><img src="" id="anhsp" /></p>
                </div>
            </div>
        </div>
    </div>
    <button onClick="closeScan()" class="btn_default" id="closesc" style="">Close</button>
</div>
<div id="khonghienthi" style="display:none">
</div>
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
            alert(`Scan result ${decodedText}`, decodedResult);
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

        //  timtheomacode(decodedText);
        var html5QrcodeScanner = new Html5QrcodeScanner("qr-reader", {
            fps: 2,
            qrbox: {
                width: 300,
                height: 300
            },
            aspectRatio: 1.333334
        });
        html5QrcodeScanner.render(onScanSuccess);
        // html5QrcodeScanner.stop().then((ignore) => {
        //     // QR Code scanning is stopped.
        // }).catch((err) => {
        //     // Stop failed, handle it.
        // });
    });

    function getsp(masp) {
        poststr = "DATA=" + encodeURIComponent(masp) + "*@!" + encodeURIComponent(0);
        loadtrang('khonghienthi', "kiemtrasp", poststr, "xuly1");
    }

    function xuly1() {
        var tam = document.getElementById('khonghienthi').innerHTML;
        if (tam) {
            document.getElementById('tensp').innerHTML = tam;
            document.getElementById('maspres').value = masp;
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

    function vidOff() {
        //clearInterval(theDrawLoop);
        //ExtensionData.vidStatus = 'off';
        vid.pause();
        vid.src = "";
        localstream.getTracks()[0].stop();
        // console.log("Vid off");
    }

    function closeScan() {
        $("#qr-reader__dashboard_section_csr button:last-child").click();
        clsoecreen_scan();
        // document.getElementById('wrap_scan_remove').remove();
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