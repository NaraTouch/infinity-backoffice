<!-- BEGIN: Top Bar -->
<div class="top-bar">
	<?= $this->element('breadcrumbs'); ?>
	<!-- BEGIN: Search -->
	<div class="intro-x relative mr-3 sm:mr-6">
		<div class="search hidden sm:block">
			<input type="text" class="search__input form-control border-transparent placeholder-theme-13" placeholder="Search...">
			<i data-feather="search" class="search__icon dark:text-gray-300"></i> 
		</div>
		<a class="notification sm:hidden" href=""> <i data-feather="search" class="notification__icon dark:text-gray-300"></i> </a>
		<div class="search-result">
			<?= $this->element('component/search_recommend'); ?>
		</div>
	</div>
	<!-- END: Search -->
	<!-- BEGIN: Notifications -->
	<div class="intro-x dropdown mr-auto sm:mr-6">
		<div class="dropdown-toggle notification notification--bullet cursor-pointer" role="button" aria-expanded="false"> <i data-feather="bell" class="notification__icon dark:text-gray-300"></i> </div>
		<?= $this->element('component/notification'); ?>
	</div>
	<!-- END: Notifications -->
	<!-- BEGIN: Account Menu -->
	<div class="intro-x dropdown w-8 h-8">
		<div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in" role="button" aria-expanded="false">
			<img alt="Midone Tailwind HTML Admin Template" src="images/profile-6.jpg">
		</div>
		<div class="dropdown-menu w-56">
			<?= $this->element('component/profile_options'); ?>
		</div>
	</div>
	<!-- END: Account Menu -->
</div>
<!-- END: Top Bar -->