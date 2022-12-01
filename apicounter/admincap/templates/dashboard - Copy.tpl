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

        animateNumber(50, 0, 0, function(number) {
            const formattedNumber = number.toLocaleString()
            document.getElementById('counter-one').innerText = formattedNumber
        })

        animateNumber(150, 0, 0, function(number) {
            const formattedNumber = number.toLocaleString()
            document.getElementById('counter-two').innerText = formattedNumber
        })

        animateNumber(505, 0, 0, function(number) {
            const formattedNumber = number.toLocaleString()
            document.getElementById('counter-three').innerText = formattedNumber
        })
    })
</script> 
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
<!--<div class="content-wrapper">    
    <div class="content-header">
      <div class="container-fluid">
       <H3>{titlePage}</H3>	  	 
	   <div align="center"><B><I>{hientai}</I></B></div> -->
	   
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
                            <p id="counter-one">
                                50
                            </p>
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
                            <p id="counter-two">
                                150
                            </p>
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
                            <p id="counter-three">
                                505
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


	 <!-- </div>
	 </div>
</div>  -->
		
		
		
   

    
	
   
    
