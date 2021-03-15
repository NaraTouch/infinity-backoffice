<?php
	$menu = [];
	if ($this->request->getSession()->read('Auth.User')) :
		$menu = $this->request->getSession()->read('Auth.User.menu');
	endif;
?>
<nav class="sidebar sidebar-offcanvas" id="sidebar">
	<ul class="nav">
		<?php
		foreach ($menu as $key => $value) :
			if (count($value['methods']) == 1) :
				foreach ($value['methods'] as $k => $v) :
					if ($v['is_menu']) : ?>
					<li class="nav-item">
						<?= $this->Html->link(
							$v['symbol'].'<span class="menu-title">'. __($v['display']).'</span>' ,
							[
								'controller' => $value['name'],
								'action' => $v['name']
							],
							[
								'escape' => false,
								'title' => __($v['display']),
								'class' => 'nav-link'
							]
						) ?>
					</li>
		<?php
					endif;
				endforeach;
			else : ?>
				<li class="nav-item">
					<a class="nav-link"
						data-toggle="collapse"
						href="<?='#'.$value['name'];?>"
						aria-expanded="false"
						aria-controls="<?=$value['name'];?>">
						<?=$value['symbol'];?>
						<span class="menu-title"><?=$value['display'];?></span>
						<i class="menu-arrow"></i>
					</a>
					<div class="collapse" id="<?=$value['name'];?>">
						<ul class="nav flex-column sub-menu">
							<?php foreach ($value['methods'] as $_k => $_v) :
								if ($_v['is_menu']):?>
								<li class="nav-item">
									<?= $this->Html->link(__($_v['display']) ,
										[
											'controller' => $value['name'],
											'action' => $_v['name']
										],
										[
											'escape' => false,
											'title' => __($_v['display']),
											'class' => 'nav-link'
										]
									) ?>
								</li>
							<?php
								endif;
							endforeach;?>
						</ul>
					</div>
				</li>
		<?php
			endif;
		endforeach;
		?>
	</ul>
</nav>
