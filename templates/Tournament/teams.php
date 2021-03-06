<?php $image_url = $this->Url->build('/', ['escape' => false,'fullBase' => true,]); ?>
<div class="nk-main">
	<!-- START: Breadcrumbs -->
	<div class="nk-gap-1"></div>
		<?=$this->element('breadcrumbs'); ?>
	<div class="nk-gap-1"></div>
	<!-- END: Breadcrumbs -->
	
	<div class="container">
		<div class="row vertical-gap">
			<div class="col-lg-8">
				<!-- START: Teams -->
				<div class="nk-team">
					<div class="nk-team-logo">
						<img src="<?= $image_url.'images/team-1-lg.jpg';?>" alt="">
					</div>
					<div class="nk-team-cont">
						<h3 class="h5 mb-20"><span class="text-main-1">Team:</span> SK Telecom T1</h3>
						<h4 class="h6 mb-5">Members:</h4>
						<?= $this->Html->link('Duke', [
							'controller' => 'Tournament',
							'action' => 'teammate',
							'?' => [
									'teammate_id' => 'Duke',
								],
						]); ?>
						<?= $this->Html->link('Bangi', [
							'controller' => 'Tournament',
							'action' => 'teammate',
							'?' => [
									'teammate_id' => 'Bangi',
								],
						]); ?>
						<?= $this->Html->link('Faker', [
							'controller' => 'Tournament',
							'action' => 'teammate',
							'?' => [
									'teammate_id' => 'Faker',
								],
						]); ?>
						<?= $this->Html->link('Bang', [
							'controller' => 'Tournament',
							'action' => 'teammate',
							'?' => [
									'teammate_id' => 'Bang',
								],
						]); ?>
						<?= $this->Html->link('Wolf', [
							'controller' => 'Tournament',
							'action' => 'teammate',
							'?' => [
									'teammate_id' => 'Wolf',
								],
						]); ?>
						<div class="nk-team-photo" style="background-image: url('<?= $image_url.'images/team-photo.png';?>');"></div>
					</div>
				</div>

				<div class="nk-team">
					<div class="nk-team-logo">
						<img src="<?= $image_url.'images/team-2-lg.jpg';?>" alt="">
					</div>
					<div class="nk-team-cont">
						<h3 class="h5 mb-20"><span class="text-main-1">Team:</span> Team Solomid</h3>
						<h4 class="h6 mb-5">Members:</h4>
						<?= $this->Html->link('Duke', [
							'controller' => 'Tournament',
							'action' => 'teammate',
							'?' => [
									'teammate_id' => 'Duke',
								],
						]); ?>
						<?= $this->Html->link('Bangi', [
							'controller' => 'Tournament',
							'action' => 'teammate',
							'?' => [
									'teammate_id' => 'Bangi',
								],
						]); ?>
						<?= $this->Html->link('Faker', [
							'controller' => 'Tournament',
							'action' => 'teammate',
							'?' => [
									'teammate_id' => 'Faker',
								],
						]); ?>
						<?= $this->Html->link('Bang', [
							'controller' => 'Tournament',
							'action' => 'teammate',
							'?' => [
									'teammate_id' => 'Bang',
								],
						]); ?>
						<?= $this->Html->link('Wolf', [
							'controller' => 'Tournament',
							'action' => 'teammate',
							'?' => [
									'teammate_id' => 'Wolf',
								],
						]); ?>
						<div class="nk-team-photo" style="background-image: url('<?= $image_url.'images/team-photo.png';?>');"></div>
					</div>
				</div>

				<div class="nk-team">
					<div class="nk-team-logo">
						<img src="<?= $image_url.'images/team-3-lg.jpg';?>" alt="">
					</div>
					<div class="nk-team-cont">
						<h3 class="h5 mb-20"><span class="text-main-1">Team:</span> Cloud 9</h3>
						<h4 class="h6 mb-5">Members:</h4>
						<?= $this->Html->link('Duke', [
							'controller' => 'Tournament',
							'action' => 'teammate',
							'?' => [
									'teammate_id' => 'Duke',
								],
						]); ?>
						<?= $this->Html->link('Bangi', [
							'controller' => 'Tournament',
							'action' => 'teammate',
							'?' => [
									'teammate_id' => 'Bangi',
								],
						]); ?>
						<?= $this->Html->link('Faker', [
							'controller' => 'Tournament',
							'action' => 'teammate',
							'?' => [
									'teammate_id' => 'Faker',
								],
						]); ?>
						<?= $this->Html->link('Bang', [
							'controller' => 'Tournament',
							'action' => 'teammate',
							'?' => [
									'teammate_id' => 'Bang',
								],
						]); ?>
						<?= $this->Html->link('Wolf', [
							'controller' => 'Tournament',
							'action' => 'teammate',
							'?' => [
									'teammate_id' => 'Wolf',
								],
						]); ?>
						<div class="nk-team-photo" style="background-image: url('<?= $image_url.'images/team-photo.png';?>');"></div>
					</div>
				</div>

				<div class="nk-team">
					<div class="nk-team-logo">
						<img src="<?= $image_url.'images/team-4-lg.jpg';?>" alt="">
					</div>
					<div class="nk-team-cont">
						<h3 class="h5 mb-20"><span class="text-main-1">Team:</span> Counter Logic Gaming</h3>
						<h4 class="h6 mb-5">Members:</h4>
						<?= $this->Html->link('Duke', [
							'controller' => 'Tournament',
							'action' => 'teammate',
							'?' => [
									'teammate_id' => 'Duke',
								],
						]); ?>
						<?= $this->Html->link('Bangi', [
							'controller' => 'Tournament',
							'action' => 'teammate',
							'?' => [
									'teammate_id' => 'Bangi',
								],
						]); ?>
						<?= $this->Html->link('Faker', [
							'controller' => 'Tournament',
							'action' => 'teammate',
							'?' => [
									'teammate_id' => 'Faker',
								],
						]); ?>
						<?= $this->Html->link('Bang', [
							'controller' => 'Tournament',
							'action' => 'teammate',
							'?' => [
									'teammate_id' => 'Bang',
								],
						]); ?>
						<?= $this->Html->link('Wolf', [
							'controller' => 'Tournament',
							'action' => 'teammate',
							'?' => [
									'teammate_id' => 'Wolf',
								],
						]); ?>
						<div class="nk-team-photo" style="background-image: url('<?= $image_url.'images/team-photo.png';?>');"></div>
					</div>
				</div>

				<div class="nk-team">
					<div class="nk-team-logo">
						<img src="<?= $image_url.'images/team-1-lg.jpg';?>" alt="">
					</div>
					<div class="nk-team-cont">
						<h3 class="h5 mb-20"><span class="text-main-1">Team:</span> fnatic</h3>
						<h4 class="h6 mb-5">Members:</h4>
						<?= $this->Html->link('Duke', [
							'controller' => 'Tournament',
							'action' => 'teammate',
							'?' => [
									'teammate_id' => 'Duke',
								],
						]); ?>
						<?= $this->Html->link('Bangi', [
							'controller' => 'Tournament',
							'action' => 'teammate',
							'?' => [
									'teammate_id' => 'Bangi',
								],
						]); ?>
						<?= $this->Html->link('Faker', [
							'controller' => 'Tournament',
							'action' => 'teammate',
							'?' => [
									'teammate_id' => 'Faker',
								],
						]); ?>
						<?= $this->Html->link('Bang', [
							'controller' => 'Tournament',
							'action' => 'teammate',
							'?' => [
									'teammate_id' => 'Bang',
								],
						]); ?>
						<?= $this->Html->link('Wolf', [
							'controller' => 'Tournament',
							'action' => 'teammate',
							'?' => [
									'teammate_id' => 'Wolf',
								],
						]); ?>
						<div class="nk-team-photo" style="background-image: url('<?= $image_url.'images/team-photo.png';?>');"></div>
					</div>
				</div>

				<div class="nk-team">
					<div class="nk-team-logo">
						<img src="<?= $image_url.'images/team-2-lg.jpg';?>" alt="">
					</div>
					<div class="nk-team-cont">
						<h3 class="h5 mb-20"><span class="text-main-1">Team:</span> Origen</h3>
						<h4 class="h6 mb-5">Members:</h4>
						<?= $this->Html->link('Duke', [
							'controller' => 'Tournament',
							'action' => 'teammate',
							'?' => [
									'teammate_id' => 'Duke',
								],
						]); ?>
						<?= $this->Html->link('Bangi', [
							'controller' => 'Tournament',
							'action' => 'teammate',
							'?' => [
									'teammate_id' => 'Bangi',
								],
						]); ?>
						<?= $this->Html->link('Faker', [
							'controller' => 'Tournament',
							'action' => 'teammate',
							'?' => [
									'teammate_id' => 'Faker',
								],
						]); ?>
						<?= $this->Html->link('Bang', [
							'controller' => 'Tournament',
							'action' => 'teammate',
							'?' => [
									'teammate_id' => 'Bang',
								],
						]); ?>
						<?= $this->Html->link('Wolf', [
							'controller' => 'Tournament',
							'action' => 'teammate',
							'?' => [
									'teammate_id' => 'Wolf',
								],
						]); ?>
						<div class="nk-team-photo" style="background-image: url('<?= $image_url.'images/team-photo.png';?>');"></div>
					</div>
				</div>
				<!-- END: Teams -->
			</div>
			<div class="col-lg-4">
				<!-- START: Left Sidebar -->
					<?=$this->element('home/left_sidebar'); ?>
				<!-- END: Sidebar -->
			</div>
		</div>
	</div>
</div>