<style>
	.input-text {
		border-radius: 5px;
		line-height: 30px;
		border: 1px solid gainsboro;
	}

	.button-search {
		border-radius: 5px;
		border: 1px solid gainsboro;
		padding: 5px;
	}

	#form-table-display {
		display: flex;
		justify-content: space-around;
	}

	.table-search {
		width: 30%;
	}

	.table-response {
		width: 70%;
		/* border: 1px solid rgb(201, 194, 194); */
		background-color: rgb(241, 241, 241);
		/* border-radius: 5px; */
		padding: 5px;
	}

	#data-response {
		word-wrap: break-word;
		padding-left: 5px;
	}

	.title-response {
		font-weight: bold;
		text-decoration: underline;
	}

	pre {
		line-height: 0.6;
	}

	.text-left {
		text-align: left;
		white-space: pre-wrap;
		word-wrap: break-word;
		line-height: 1.4;
		display: flex;
		justify-content: flex-start;
		max-width: 70%;
	}

	.text-right {
		text-align: right;
		white-space: pre-wrap;
		word-wrap: break-word;
		line-height: 1.4;
		display: flex;
		justify-content: flex-end;
	}

	.date-send-right {
		display: flex;
		font-size: 10px;
		font-style: italic;
		justify-content: flex-end;
	}

	.date-send-left {
		display: flex;
		font-size: 10px;
		font-style: italic;
	}

	.text-border-right {
		border: 1px solid gray;
		border-radius: 5px;
		padding: 5px;
		margin-bottom: 7px;
		max-width: 70%;
		background-color: #89f5c3a1;
	}

	.text-border-left {
		border: 1px solid gray;
		border-radius: 5px;
		padding: 5px;
		margin-bottom: 7px;
		max-width: 70%;
	}

	
	.item-chatbox {
		cursor: pointer;
	}

	.item-chatbox:hover {
		background-color: rgb(235, 231, 231);
	}

	.border-image {
		width: 50px;
		height: 50px;
		border-radius: 25px;
	}

	.title-chatbox {
		display: block;
		padding: 10px;
		color: #191919;
		font-size: 15px;
		font-weight: 700;
		border-bottom: 1px solid black;
	}

	.chatbox-list{
		background-color: rgb(255, 255, 255);
	}

	.image-thumb {
		max-width: 70%;
	}

	.contains-images {
		display: flex;
		align-items: center;
		justify-content: center;
	}
</style>
<div class="nenbao">
	<fieldset class="nencon">
		<legend>
			<a style="cursor:pointer">
				<h4 style="Color:#FF3300;Font-Weight:Bold;">Tin Nhắn Chưa Phản Hồi</h4>
			</a>
		</legend>

		<div id="form-table-display">

			<div class="table-search">
				<div style="border: 1px solid black;">
					<div class="title-chatbox">Hội thoại</div>
					<div class="chatbox-list">
						<!-- BEGIN: block_message_unreply -->
						<div class="item-chatbox" style="padding: 9px 15px;" onclick="get_msg_recent('{id_zalo}')">
							<div style="display: flex; align-items: center; white-space: nowrap;
								text-overflow: ellipsis;
								overflow: hidden;
								width: 85%;">
								<div class="site-box-left"><img class="border-image" src="{user_avatar}" alt=""></div>
								<div class="site-box-right" style="padding-left: 8px;">
									<div class="customer_name" style="font-weight: bold; font-size: 16px;">{user_display_name}</div>
									<div><span>{message}</span></div>
								</div>
							</div>
						</div>
						<!-- END: block_message_unreply -->
					</div>
				</div>
			</div>
			<div class="table-response">
				<div>
					<h5 class="title-response">Tin nhắn gần đây: </h5>
				</div>
				<div id="data-response">
				</div>
			</div>


		</div>

		<script src="js/jquery-1.7.2.min.js"></script>
		<script language="JavaScript">

			function get_msg_recent(idzalo) {
				poststr = "DATA=" + encodeURIComponent(idzalo) + "*@!"
				loadtrang('data-response', "kiemtrazaloapi", poststr, "");
			}
		</script>

	</fieldset>
</div>
