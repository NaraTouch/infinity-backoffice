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
		<div class="col-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Drag and Drop</h4>
					<div class="row">
						<div class="col-12">
							<div class="file-drop-area">
								<span class="fake-btn">Choose files</span>
								<span class="file-msg">or drag and drop files here</span>
								<input 
									data-website_id="<?= $this->request->getQuery('website_id')?>"
									data-path="<?= $this->request->getQuery('path')?>"
									data-folder_id="<?= $this->request->getQuery('folder_id')?>"
									class="file-input" 
									type="file" multiple>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Progressing</h4>
						<p class="card-description">
							Your file <code> start upload here!!!</code>
						</p>
						<div class="table-responsive">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th>Name</th>
									<th>Size</th>
									<th>Progress</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody id="file-table-console"> </tbody>
						</table>
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
