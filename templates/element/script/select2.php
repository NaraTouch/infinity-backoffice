<?php
	echo $this->Html->css([
		'vendors/select2/select2.min',
	]);
	echo $this->fetch('css');
	echo $this->Html->script([
			'vendors/select2/select2.min',
			'select2',
		]);
	echo $this->fetch('script');
?>