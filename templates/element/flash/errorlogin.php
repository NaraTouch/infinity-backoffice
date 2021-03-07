<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
	$message = h($message);
}
?>
<div class="intro-x mt-8" onclick="this.classList.add('hidden');">
	<div class="alert alert-danger show flex items-center mb-2" role="alert">
		<i data-feather="alert-octagon" class="w-6 h-6 mr-2"></i> <?= $message ?>
	</div>
</div>
