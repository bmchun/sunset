<?php
//极光push消息
$push = '
<div class="admin-content">
	<div class="am-cf am-padding">
		<div class="am-fl am-cf">
			<strong class="am-text-primary am-text-lg">消息Push</strong>
		</div>
		<div class="am-g">
			<div class="am-u-sm-12 am-u-md-6">
				<div class="am-btn-toolbar">
					<div class="am-u-sm-12 am-u-md-3">
							<form action="../api/push.php" method="post">
          						<input type="text" class="am-form-field" style = "width:400px" name="k">
								<input type="submit" value="submit">
							</from>
      				</div>	
				</div>
			</div>
		</div>
	</div>
</div>
		';