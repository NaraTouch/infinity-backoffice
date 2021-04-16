<?php
$controller = $this->request->getParam('controller');
if (!empty($features)
		&& (isset($features['add'])
		&& $features['add'] == true)):

	echo $this->Html->link('Add', [
		'controller' => $controller,
		'action' => 'add'
	],[
		'class' => 'btn btn-success btn-md'
	]);
endif;
?>