<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<?php $image_url = $this->Url->build('/', ['escape' => false,'fullBase' => true,]);?>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Skydash Admin</title>
		<link rel="shortcut icon" href="<?= $image_url.'images/favicon.png'?>" />
		<?php
			echo $this->Html->css([
				'vendors/feather/feather',
				'vendors/ti-icons/css/themify-icons',
				'vendors/css/vendor.bundle.base',
				'vertical-layout-light/style',
			]);
			echo $this->fetch('css');
		?>
	</head>
	<body>
		<div class="container-scroller">
			<!-- navbar -->
			<?= $this->element('component/nav_bar'); ?>
			<!-- partial -->
			<div class="container-fluid page-body-wrapper">
				<!-- sidebar -->
				<?= $this->element('component/sidebar'); ?>
				<div class="main-panel">
					<?= $this->fetch('content'); ?>
					<!-- content-wrapper ends -->
					<!-- footer -->
					<?= $this->element('footer'); ?>
				</div>
				<!-- main-panel ends -->
			</div>
			<!-- page-body-wrapper ends -->
		</div>
		<!-- container-scroller -->
		<?php
		echo $this->Html->script([
			'vendors/js/vendor.bundle.base',
			'off-canvas',
			'hoverable-collapse',
			'template',
		]);
		echo $this->fetch('script');
		?>
	</body>
</html>

