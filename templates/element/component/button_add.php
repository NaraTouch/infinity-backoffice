<?php
$controller = $this->request->getParam('controller');
?>
<?= $this->Html->link('Add', [
	'controller' => $controller,
	'action' => 'add'
],[
	'class' => 'btn btn-success btn-md'
]); ?>