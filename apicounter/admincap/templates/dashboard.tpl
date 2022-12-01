<style>
    .card-header-top {
        display: flex;
        justify-content: space-between;
    }
    
    .card-icon,
    .card-title {
        color: #fff;
    }
    
    .card-text {
        font-size: 50px;
        text-align: center;
        color: #fff;
        font-weight: 700;
    }
    
    .card-header {
        border-radius: 10px;
        box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    }
    
    .card-one {
        background-color: #3498db;
    }
    
    .card-two {
        background-color: #2ecc71;
    }
    
    .card-three {
        background-color: #e67e22;
    }
</style>
<script>document.getElementsByTagName("title")[0].innerHTML='{titlePage}';</script>
<div class="content-wrapper">
<div align="center"><B><I>{hientai}</I></B></div>
    <div class="content-header">
        <div class="title">
            <H3>{titlePage}</H3>	   
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="card-header card-one">
                        <div class="card-header-top">
                            <div class="card-icon"><i class="nav-icon far fa-calendar-alt"></i></div>
                            <div class="card-title">Hiện tại</div>
                        </div>
                        <div class="card-text">
                            <div class="container mt-3">
                                <div class="row">
                                    <div class="col-md-6" style="border-right: 1px dashed;">
                                        <h4>
                                            Vào
                                        </h4>
                                        <p id="counter-1">
                                            {demvao}
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <h4>
                                            Ra
                                        </h4>
                                        <p id="counter-2">
                                            {demra}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-header card-two">
                        <div class="card-header-top">
                            <div class="card-icon"><i class="nav-icon far fa-calendar-alt"></i></div>
                            <div class="card-title">7 ngày vừa qua</div>
                        </div>
                        <div class="card-text">
                            <div class="container mt-3">
                                <div class="row">
                                    <div class="col-md-6" style="border-right: 1px dashed;">
                                        <h4>
                                            Vào
                                        </h4>
                                        <p id="counter-3">
                                            {demvao7}
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <h4>
                                            Ra
                                        </h4>
                                        <p id="counter-4">
                                            {demra7}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-header card-three">
                        <div class="card-header-top">
                            <div class="card-icon"><i class="nav-icon far fa-calendar-alt"></i></div>
                            <div class="card-title">30 ngày vừa qua</div>
                        </div>
                        <div class="card-text">
                            <div class="container mt-3">
                                <div class="row">
                                    <div class="col-md-6" style="border-right: 1px dashed;">
                                        <h4>
                                            Vào
                                        </h4>
                                        <p id="counter-5">
                                            {demvao30}
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <h4>
                                            Ra
                                        </h4>
                                        <p id="counter-6">
                                            {demra30}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--
<script>
    function animateNumber(finalNumber, delay, startNumber = 0, callback) {
        let currentNumber = startNumber
        const interval = window.setInterval(updateNumber, delay)

        function updateNumber() {
            if (currentNumber >= finalNumber) {
                clearInterval(interval)
            } else {
                currentNumber++
                callback(currentNumber)
            }
        }
    }

    document.addEventListener('DOMContentLoaded', function() {

        animateNumber(155, 0, 0, function(number) {
            const formattedNumber = number.toLocaleString()
            document.getElementById('counter-1').innerText = formattedNumber
        })

        animateNumber(1440, 0, 0, function(number) {
            const formattedNumber = number.toLocaleString()
            document.getElementById('counter-2').innerText = formattedNumber
        })
        animateNumber(155, 0, 0, function(number) {
            const formattedNumber = number.toLocaleString()
            document.getElementById('counter-3').innerText = formattedNumber
        })

        animateNumber(1440, 0, 0, function(number) {
            const formattedNumber = number.toLocaleString()
            document.getElementById('counter-4').innerText = formattedNumber
        })
        animateNumber(155, 0, 0, function(number) {
            const formattedNumber = number.toLocaleString()
            document.getElementById('counter-5').innerText = formattedNumber
        })

        animateNumber(1440, 0, 0, function(number) {
            const formattedNumber = number.toLocaleString()
            document.getElementById('counter-6').innerText = formattedNumber
        })
    })
</script>
-->