<div class="dropdown-menu__content box bg-theme-26 dark:bg-dark-6 text-white">
	<div class="p-4 border-b border-theme-27 dark:border-dark-3">
		<div class="font-medium"><?= $this->request->getSession()->read('Auth.User.email');?></div>
		<div class="text-xs text-theme-28 mt-0.5 dark:text-gray-600">Software Engineer</div>
	</div>
	<div class="p-2">
		<a href="" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md"> <i data-feather="user" class="w-4 h-4 mr-2"></i> Profile </a>
		<a href="" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md"> <i data-feather="edit" class="w-4 h-4 mr-2"></i> Add Account </a>
		<a href="" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md"> <i data-feather="lock" class="w-4 h-4 mr-2"></i> Reset Password </a>
		<a href="" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md"> <i data-feather="help-circle" class="w-4 h-4 mr-2"></i> Help </a>
	</div>
	<div class="p-2 border-t border-theme-27 dark:border-dark-3">
		<?= $this->Html->link(
			'<i data-feather="toggle-right" class="w-4 h-4 mr-2"></i>' . __('Logout'),
			[
				'controller' => '/',
				'action' => 'logout'
			],
			[
				'escape' => false,
				'title' => __('Logout'),
				'class' => 'flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md'
			]
		) ?>
	</div>
</div>