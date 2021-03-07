<!-- BEGIN: Breadcrumb -->
	<div class="-intro-x breadcrumb mr-auto hidden sm:flex">
		<?php
		$controller = $this->request->getParam('controller');
		$actions = $this->request->getParam('action');
		?>
		<a href="">Application</a>
		<i data-feather="chevron-right" class="breadcrumb__icon"></i>
		<a href="" class="breadcrumb--active"><?= $controller;?></a>
		<?php if ($actions != 'index') :?>
		<i data-feather="chevron-right" class="breadcrumb__icon"></i>
		<a href="" class="breadcrumb--active"><?= $actions;?></a>
		<?php endif;?>
	</div>
<!-- END: Breadcrumb -->