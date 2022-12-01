<style>
@media all and (min-width: 320px) {

	.inforqr{
		display: flex;
		/* align-items: center; */
		/* justify-content: center; */
		flex-direction: column;
		width: 100%;
		margin: 0 auto;
		padding:1em;	
	}
	.inforqr .thongtin{
		
	}
	.inforqr .thongtin ul li{
			list-style-type:none;
	}
	.inforqr .thongtin .title{
			font-size: 18px;
		font-weight: 700;
	}
}
@media all and (min-width: 1024px) {

	.inforqr{
		display: flex;
		/* align-items: center; */
		/* justify-content: center; */
		flex-direction: column;
		width: 50%;
		margin: 0 auto
	}
	.inforqr .thongtin{
		
	}
	.inforqr .thongtin ul li{
			list-style-type:none;
	}
	.inforqr .thongtin .title{
			font-size: 18px;
		font-weight: 700;
	}
}

</style>


<div class="inforqr">
	<div class="title">
		<h1>Xin chào, {user_fullname}</h1>
	</div>
	<div class="thongtin">
		<ul>
			<li class="title">Thông tin cá nhân</li>
			<li>Email: {user_email}</li>
			<li>Địa chỉ: {address} </li>
			<li class="title">Thông tin tài sản FM</li>
			<li> Điểm: vàng {vang} bạc {bac}</li>
			<li> voucher: </li>
		</ul>
		
	</div>
</div>