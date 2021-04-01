<?php
	echo $this->Html->css([
		'file-style',
	]);
	echo $this->fetch('css');
?>
<div class="content-wrapper">
	<div class="row">
		<div class="col-lg-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Upload Your file here!!!</h4>
					<footer class="blockquote-footer">Duplicate file <cite title="Source Title">will be overwrite</cite></footer>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-6 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Drag and Drop</h4>
					<div class="row">
						<div class="col-12">
							<div 
								id="dropFiles"
								class="dropFiles border border-3"
								data-path="<?= $this->request->getQuery('path')?>"
								data-folder_id="<?= $this->request->getQuery('folder_id')?>"
								>
								Drag and drop File Here.
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-6 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Progress Console</h4>
					<div class="row">
						<div class="col-12">
							<div id="messages">
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
	echo $this->Html->script([
		'jquery-3.6.0.min',
		'file-scritp',
	]);
	echo $this->fetch('script');
?>
