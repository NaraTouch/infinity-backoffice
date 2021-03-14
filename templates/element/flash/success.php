<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
	$message = h($message);
}
?>
<div class="content-wrapper" onclick="this.classList.add('hidden');" style="padding-bottom: 0px;">
	<div class="row">
		<div class="col-lg-12 grid-margin stretch-card" style="margin-bottom: 0px;">
			<div class="card">
				<div class="card-body" style="padding-bottom: 0px;">
					<h4 class="card-title text-success"><?= $message ?></h4>
				</div>
			</div>
		</div>
	</div>
</div>