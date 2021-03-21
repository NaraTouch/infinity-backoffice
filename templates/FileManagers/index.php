<?php
	echo $this->Html->css([
		'folder',
	]);
	echo $this->fetch('css');
?>
<div class="content-wrapper">
	<div class="row">
		<div class="col-lg-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<div class="btn-group">
						<?= $this->element('component/table_head'); ?>
					</div>
					<?php
						if ($list && isset($list)) :
					?>
					<div class="row">
						<div class="col-12">
							<?php
								$dir = explode('/', $list->path);
								$path = '';
								foreach ($dir as $key => $value) :
									if ($value) :
										$path .= '/'.$value;
										echo $this->Html->link('/'.$value, [
											'controller' => 'FileManagers',
											'action' => 'index',
											'?' =>
												['path' => $path]
										],[
											'class' => 'card-description pr-1'
										]);
									endif;
								endforeach;
							?>
						</div>
					</div>
					<div class="row">
						<?php
							if ($list->contents && count($list->contents) > 0) :
								foreach ($list->contents as $key => $value):
									if (strtolower($value->icon) == 'folder') :
							?>
									<div class="folder">
										<p class="folder-p"><?= h($value->name)?></p>
									</div>
							<?php
									elseif (strtolower($value->icon) == 'document') :
							?>
									<div class="document">
										<p class="document-p"><?= h($value->name)?></p>
									</div>
							<?php
									elseif (strtolower($value->icon) == 'image') :
									$ext = explode('/', $value->contenttype);
									$image_url = $value->public_url
											.'?fileid='.$value->fileid
											.'&code='.$value->link->code
											.'&size=600x400';
							?>
									<!-- Gallery item -->
									<div class="col-lg-3 col-md-3 col-4 mb-4">
										<div class="bg-white rounded shadow-sm">
											<img src="<?= $image_url;?>" alt="<?= $value->name;?>" class="img-fluid card-img-top">
											<div class="p-4 img-details-p">
												<h5 class="img-n">
													<a href="#" class="text-dark"><?= $value->name;?></a>
												</h5>
												<p class="small text-muted mb-0 img-n">
													<?= date('Y-m-d H:i:s', strtotime($value->created)); ?>
												</p>
												<div class="d-flex align-items-center justify-content-between rounded-pill bg-light px-3 py-2 mt-4">
													<p class="small mb-0">
														<span class="font-weight-bold img-n"><?= $ext[1];?></span>
													</p>
													<div class="badge badge-danger px-3 rounded-pill font-weight-normal img-n">New</div>
												</div>
											</div>
										</div>
									</div>
									<!-- End -->
							<?php
								
									endif;
							?>
							
						<?php
								endforeach;
							else :
						?>
							<h2>No Data</h2>
						<?php
							endif;
						?>
					</div>
					<?php else: ?>
					<h4 class="card-title text-center">File not found!!!</h4>
					<div class="media text-center">
						<div class="media-body">
							<p class="card-text text-danger">please refresh your browser.</p>
						</div>
					</div>
					<?php endif; ?>
					
				</div>
			</div>
		</div>
	</div>
</div>