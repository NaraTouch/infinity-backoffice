<!DOCTYPE html>
<html lang="en">
	<head>
		<?php $image_url = $this->Url->build('/', ['escape' => false,'fullBase' => true,]);?>
		<meta charset="utf-8">
		<link href="<?= $image_url.'images/logo.svg'?>" rel="shortcut icon">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Midone admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
		<meta name="keywords" content="admin template, Midone admin template, dashboard template, flat admin template, responsive admin template, web app">
		<meta name="author" content="LEFT4CODE">
		<title>Dashboard - Midone - Tailwind HTML Admin Template</title>
		<?php
		echo $this->Html->css([
			'app',
		]);
		echo $this->fetch('css');
		?>
	</head>

	<body class="main">
		<?= $this->element('component/mobile_menu'); ?>
		<div class="flex">
			<?= $this->element('component/menu'); ?>
			<!-- BEGIN: Content -->
			<div class="content">
				<?= $this->element('component/top_bar'); ?>
				<?= $this->fetch('content'); ?>
			</div>
			<!-- END: Content -->
		</div>
	</body>
	<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=["your-google-map-api"]&libraries=places"></script>
<?php
	echo $this->Html->script([
		'app'
	]);
	echo $this->fetch('script');
?>
</html>
