<div class="container">
	<ul class="nk-breadcrumbs">
		<?php
		$controller = $this->request->getParam('controller');
		$actions = $this->request->getParam('action');
		?>
		<li>
			<?= $this->Html->link($controller, [
				'controller' => $controller,
				'action' => $actions
			]); ?>
		</li>
		<li><span class="fa fa-angle-right"></span></li>
		<li>
			<?= $this->Html->link($actions, [
				'controller' => $controller,
				'action' => $actions
			]); ?>
		</li>
		<?php if(isset($breadcrumbs)): ?>
			<li><span class="fa fa-angle-right"></span></li>
			<li><span><?= $breadcrumbs;?></span></li>
		<?php else: ?>
			<li></li>
			<li></li>
		<?php endif; ?>
	</ul>
</div>