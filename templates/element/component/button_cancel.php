<?php
$controller = $this->request->getParam('controller');
?>
<?= $this->Html->link('Cancel', [
	'controller' => $controller,
	'action' => 'index'
],[
	'class' => 'btn btn-light'
]); ?>