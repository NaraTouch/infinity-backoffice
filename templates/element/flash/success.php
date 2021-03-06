<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
	$message = h($message);
}
?>
<div class="nk-footer nk-btn-color-main-1" onclick="this.classList.add('hidden');" style="border-style: none;">
	<div class="container">
		<div class="nk-gap-1">
			<center>
				<h6 style="margin-top: 5px;">
					<?= $message ?>
				</h6>
			</center>
		</div>
	</div>
</div>
