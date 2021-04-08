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
						$_dir_id = '';
						$_current_dir = '';
					?>
					<div class="row">
						<div class="col-12">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb bg-light border-0">
									<?php
										if ($list->metadata->path == '/') :
											$_current_dir = '/';
											$_dir_id = $list->metadata->folderid;
									?>
										<li class="breadcrumb-item">
											<?php
												echo $this->Html->link('Home', [
													'controller' => 'PClouds',
													'action' => 'index',
												]);
											?>
										</li>
									<?php
										else :
											$dir = explode('/', $list->metadata->path);
											$_dir_id = $list->metadata->folderid;
											$path = '';
											foreach ($dir as $key => $value) :
												if ($value) :
													$path .= '/'.$value;
													$_current_dir = $path;
									?>
										<li class="breadcrumb-item">
											<?php
												echo $this->Html->link($value, [
													'controller' => 'PClouds',
													'action' => 'index',
													'?' =>
														['path' => $path]
												]);
											?>
										</li>
									<?php
											else :
									?>
										<li class="breadcrumb-item">
											<?php
												echo $this->Html->link('Home', [
													'controller' => 'PClouds',
													'action' => 'index',
												]);
											?>
										</li>
									<?php
												endif;
											endforeach;
										endif;
									?>
								</ol>
							</nav>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb bg-light mb-0 pb-0 pl-0 border-0 bg-white" >
									<li class="breadcrumb-item dropdown">
										<button class="btn btn-outline-info btn-sm dropdown-toggle"
												type="button"
												id="dropdownMenuSizeButton3"
												data-toggle="dropdown"
												aria-haspopup="true"
												aria-expanded="false"
										>
											Option
										</button>
										<div class="dropdown-menu" aria-labelledby="dropdownMenuSizeButton3">
											<h6 class="dropdown-header">Settings</h6>
											<?= $this->Html->link(
												'Create Folder' ,
												[
													'controller' => 'PClouds',
													'action' => 'createFolderIfNotExists',
													'?' =>
														[
															'path' => $_current_dir,
															'folder_id' => $_dir_id
													],
												],
												[
													'alt' => 'create folder',
													'target' => '_blank',
													'escape' => false,
													'class' => 'dropdown-item',
												]
											) ?>
											<?= $this->Html->link('Upload Files' ,
												[
													'controller' => 'PClouds',
													'action' => 'uploadFile',
													'?' => [
														'path' => $_current_dir,
														'folder_id' => $_dir_id
													]
												],
												[
													'alt' => 'upload files',
													'target' => '_blank',
													'escape' => false,
													'class' => 'dropdown-item',
												]
											) ?>
											<?= $this->Html->link('Delete checked' ,
												[ ],
												[
													'alt' => 'Delete checked files',
													'escape' => false,
													'class' => 'dropdown-item',
													'id' => 'deleteAllFile'
												]
											) ?>
										</div>
									</li>
								</ol>
							</nav>
						</div>
					</div>
					<div class="row">
						<div class="table-responsive">
							<table class="table table-striped">
								<thead>
									<tr>
										<th>
											<div class="form-check form-check-flat form-check-primary mt-0 mb-0">
												<label class="form-check-label">
													<input type="checkbox" class="form-check-input" id="checkAll">
												</label>
											</div>
										</th>
										<th>Asset</th>
										<th>Name</th>
										<th>Sized</th>
										<th>Date</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php if ($list->metadata->contents && count($list->metadata->contents) > 0) :?>
										<?php foreach ($list->metadata->contents as $key => $value):?>
										<tr>
											<td>
												<div class="form-check form-check-flat form-check-primary mt-0 mb-0">
													<label class="form-check-label">
														<?php
															$id = '';
															$type = '';
															if (strtolower($value->icon) == 'folder') :
																$type = 'folderid';
																$id = $value->folderid;
															elseif (strtolower($value->icon) == 'document') :
																$type = 'fileid';
																$id = $value->fileid;
															elseif (strtolower($value->icon) == 'image') :
																$type = 'fileid';
																$id = $value->fileid;
															endif;
														?>
														<input 
															type="checkbox"
															value="<?=$id?>"
															class="form-check-input"
															data-path="<?=$_current_dir;?>"
															data-type="<?=$type;?>"
														>
													</label>
												</div>
											</td>
											<td class="py-1">
												<?php
												if (strtolower($value->icon) == 'folder') :
													$url = $this->Url->build([
														'controller' => 'PClouds',
														'action' => 'index', '?' => [
															'path' => $value->path,
														]
													]);
												?>
													<a href="<?= $url;?>" class="h3">
														<i class="mdi mdi-folder"></i>
													</a>
												<?php elseif (strtolower($value->icon) == 'document') : ?>
													<i class="mdi mdi-file-document"></i>
												<?php elseif ($list->metadata->path != '/' && strtolower($value->icon) == 'image') :
													$ext = explode('/', $value->contenttype);
													$origin_width = 500;
													$origin_height = 100;
													if (isset($value->width)) {
														$origin_width = $value->width;
													}
													if (isset($value->height)) {
														$origin_height = $value->height;
													}
													$url = $list->metadata->pub_url.
														'?fileid='.$value->fileid
														.'&code='.$list->metadata->auth->code
														.'&type='.$ext[1]
														.'&size='.$origin_width.'x'.$origin_height;
													$image_url = $list->metadata->pub_url.
															'?fileid='.$value->fileid
															.'&code='.$list->metadata->auth->code
															.'&type='.$ext[1]
															.'&size=100x100';
												?>
													<a href="<?=$url?>" target="_blank">
														<img class="rounded-0" src="<?= $image_url;?>" alt="<?= $value->name;?>">
													</a>
												<?php else:?>
													<a class="h3">
														<i class="mdi mdi-file-outline"></i>
													</a>
												<?php endif;?>
											</td>
											<td><?= h($value->name)?></td>
											<td>
												<?php
													if (strtolower($value->icon) == 'image' || strtolower($value->icon) == 'document') :
														echo number_format($value->size / 1024, 2) . ' KB';
													else :
														echo '-';
													endif;
												?>
											</td>
											<td><?= date('Y-m-d H:i:s', strtotime($value->created)); ?></td>
											<td>
												<?php
												if (strtolower($value->icon) == 'folder') :
													echo $this->Html->link('Edit', [
																'action' => 'edit_folder',
																'?' => [
																	'path' => $_current_dir,
																	'name' => $value->name,
																	'folder_id' => $value->folderid,
																]
															],
															[
																'target' => '_blank',
																'class' => 'btn btn-primary btn-sm',
																'escape' => false,
															]
														);
													echo $this->Html->link('Delete', [
															'action' => 'delete_folder',
															'?' => [
																'path' => $_current_dir,
																'folder_id' => $value->folderid,
															]
														],
														[
															'target' => '_self',
															'class' => 'btn btn-danger btn-sm',
															'escape' => false,
														]
													);
												else :
													echo $this->Html->link('Edit', [
																'action' => 'edit_file',
																'?' => [
																	'path' => $_current_dir,
																	'name' => $value->name,
																	'file_id' => $value->fileid,
																]
															],
															[
																'target' => '_blank',
																'class' => 'btn btn-primary btn-sm',
																'escape' => false,
															]
														);
													echo $this->Html->link('Delete', [
															'action' => 'delete_file',
															'?' => [
																'path' => $_current_dir,
																'file_id' => $value->fileid,
															]
														],
														[
															'target' => '_self',
															'class' => 'btn btn-danger btn-sm',
															'escape' => false,
														]
													);
												endif;
												?>
											</td>
										</tr>
										<?php endforeach; ?>
									<?php else :?>
										<tr>
											<td colspan="6" class="text-danger text-center"><?= __(NO_DATA) ?></td>
										</tr>
									<?php endif; ?>
								</tbody>
							</table>
						</div>
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
<?php
	echo $this->Html->script([
		'jquery-3.6.0.min',
		'file-scritp',
	]);
	echo $this->fetch('script');
?>