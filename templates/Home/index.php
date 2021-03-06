<div class="nk-main">
	<div class="nk-gap-2"></div>
	<div class="container">
		<!-- Start: Image Slider -->
			<?=$this->element('home/slider'); ?>
		<!-- END: Image Slider -->
		<!-- START: Categories -->
			<?=$this->element('home/categories_widget'); ?>
		<!-- END: Categories -->
		<div class="row vertical-gap">
			<div class="col-lg-8">
				<!-- START: Latest Matches -->
					<?=$this->element('home/latest_matches'); ?>
				<!-- END: Latest Matches -->
			</div>
			<div class="col-lg-4">
				<!-- START: Left Sidebar -->
					<?=$this->element('home/left_sidebar'); ?>
				<!-- END: Sidebar -->
			</div>
		</div>
		<div class="nk-gap-2"></div>
		<!-- START: Latest News -->
			<?=$this->element('home/latest_new'); ?>
		<!-- END: Latest News -->
	</div>
	<div class="nk-gap-4"></div>
</div>