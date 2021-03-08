<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
	$message = h($message);
}
?>
<div class="text-center mt-4 font-weight-light" onclick="this.classList.add('hidden');">
	<span class="text-danger d-block text-truncate">
		<?= $message ?>
	</span>
</div>
