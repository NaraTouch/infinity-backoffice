<?php
	echo $this->Html->css([
		'folder',
	]);
	echo $this->fetch('css');
	$query = $this->request->getQuery();
	$id = $query['id'];
	$path = $query['path'];
	$before_path = $query['path'];
	$_current_dir = '';
?>
<div class="content-wrapper">
	<div class="row">
		<div class="col-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<div class="btn-group">
						<?= $this->element('component/table_head'); ?>
					</div>
					<div class="row">
						<div class="col-12">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb bg-light border-0">
									<?php
										if ($list && isset($list)) :
											$list_path = $list->path;
											$_exp = explode("\\",$list_path);
											if (count($_exp) == 2 && $_exp[1] == '') :
									?>
										<li class="breadcrumb-item">
											<?php
												echo $this->Html->link('Home', [
													'controller' => 'LocalFileManagers',
													'action' => 'fileManager',
													'?' => [
														'id' => $id,
														'path' => '\\'
													]
												]);
											?>
										</li>
									<?php
											else :
												foreach ($_exp as $e => $ex) :
													if ($e == 0) :
												?>
													<li class="breadcrumb-item">
														<?php
															echo $this->Html->link('Home', [
																'controller' => 'LocalFileManagers',
																'action' => 'fileManager',
																'?' => [
																	'id' => $id,
																	'path' => '\\'
																]
															]);
														?>
													</li>
												<?php
													else:
												?>
													<li class="breadcrumb-item">
														<?php
															echo $this->Html->link($ex, [
																'controller' => 'LocalFileManagers',
																'action' => 'fileManager',
																'?' => [
																	'id' => $id,
																	'path' => '\\'.$ex
																]
															]);
														?>
													</li>
												<?php
													endif;
												endforeach;
											endif;
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
											<?php
											
											if (!empty($features)
												&& (isset($features['createFolderIfNotExists'])
												&& $features['createFolderIfNotExists'] == true)):
													echo $this->Html->link(
													'Create Folder' ,
													[
														'controller' => 'LocalFileManagers',
														'action' => 'createFolderIfNotExists',
														'?' => [
															'id' => $id,
															'path' => $before_path,
														],
													],
													[
														'alt' => 'create folder',
														'target' => '_blank',
														'escape' => false,
														'class' => 'dropdown-item',
													]
												);
											endif;
											
											if (!empty($features)
												&& (isset($features['uploadFile'])
												&& $features['uploadFile'] == true)):
												echo $this->Html->link('Upload Files' ,
													[
														'controller' => 'PClouds',
														'action' => 'uploadFile',
														'?' => [
															
														]
													],
													[
														'alt' => 'upload files',
														'target' => '_blank',
														'escape' => false,
														'class' => 'dropdown-item',
													]
												);
											endif;
											
											if (!empty($features) && (
													(isset($features['deleteFolder']) && $features['deleteFolder'] == true) ||
													(isset($features['deleteFile']) && $features['deleteFile'] == true)
												)):
												echo $this->Html->link('Delete checked' ,
													[ ],
													[
														'alt' => 'Delete checked files',
														'escape' => false,
														'class' => 'dropdown-item',
														'id' => 'deleteAllFile'
													]
												);
											endif;
											
										?>
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
										<?= $this->element('component/th_action'); ?>
									</tr>
								</thead>
								<tbody>
									<?php if ($list && ($list->directory && isset($list->directory))) :?>
										<?php foreach ($list->directory as $key => $value):
											$list_path = $list->path;
											$name = $key;
											$type = $value->type;
											$info = $value->info;
											$image_url = '';
											if (!empty($info)) {
												$image_url = $info->dirname.'\\'.$name;
											}
										?>
										<tr>
											<td>
												<div class="form-check form-check-flat form-check-primary mt-0 mb-0">
													<label class="form-check-label">
														<input 
															type="checkbox"
															value="<?= $name; ?>"
															class="form-check-input"
															data-type="<?= $type; ?>"
														>
													</label>
												</div>
											</td>
											<td class="py-1">
												<?php if (strtolower($type) == 'folder') :
													$url = $this->Url->build([
														'controller' => 'LocalFileManagers',
														'action' => 'fileManager',
														'?' => [
															'id' => $id,
															'path' => $list_path.'\\'.$name
														]
													]);
												?>
													<a href="<?= $url; ?>" class="h3">
														<i class="mdi mdi-folder"></i>
													</a>
												<?php elseif (strtolower($type) == 'document') : ?>
													<i class="mdi mdi-file-document"></i>
												<?php elseif (strtolower($type) == 'image') : ?>
													<a href="<?= $image_url; ?>" target="_blank">
														<img class="rounded-0"
															 src="<?= $image_url; ?>"
															 alt="<?= $name; ?>"
															 width="100"
															 height="100"
														>
													</a>
												<?php else:?>
													<a class="h3">
														<i class="mdi mdi-file-outline"></i>
													</a>
												<?php endif;?>
											</td>
											<td><?= h($name)?></td>
											<td>
												<?php
													if (strtolower($type) == 'image' || strtolower($type) == 'document') :
														echo number_format($info->filesize / 1024, 2) . ' KB';
													else :
														echo '-';
													endif;
												?>
											</td>
											<td>
												<?php
												if (strtolower($type) == 'folder') :
													if (!empty($features)
														&& (isset($features['renameFolder'])
														&& $features['renameFolder'] == true)):
														echo $this->Html->link('Edit', [
																	'action' => 'edit_folder',
																	'?' => [
																		'id' => $id,
																		'dir_path' => $list_path,
																		'name' => $name,
																		'path' => $before_path,
																	]
																],
																[
																	'target' => '_blank',
																	'class' => 'btn btn-primary btn-sm',
																	'escape' => false,
																]
															);
													endif;
													
													if (!empty($features)
														&& (isset($features['deleteFolder'])
														&& $features['deleteFolder'] == true)):
														echo $this->Html->link('Delete', [
																'action' => 'deleteFolder',
																'?' => [
																	'id' => $id,
																	'dir_path' => $list_path,
																	'name' => $name,
																	'path' => $before_path,
																]
															],
															[
																'target' => '_self',
																'class' => 'btn btn-danger btn-sm',
																'escape' => false,
															]
														);
													endif;
												else :
													if (strtolower($type) == 'image') :
														?>
														<button
															class="btn btn-success btn-sm copy-btn"
															data-clipboard-text="<?= $image_url;?>"
														>Copy Link</button>
													<?php
													endif;
													if (!empty($features)
														&& (isset($features['renameFile'])
														&& $features['renameFile'] == true)):
														echo $this->Html->link('Edit', [
																	'action' => 'edit_file',
																	'?' => [
																		'id' => $id,
																		'dir_path' => $list_path,
																		'name' => $name,
																		'path' => $before_path,
																	]
																],
																[
																	'target' => '_blank',
																	'class' => 'btn btn-primary btn-sm',
																	'escape' => false,
																]
															);
													endif;
													if (!empty($features)
														&& (isset($features['deleteFile'])
														&& $features['deleteFile'] == true)):
														echo $this->Html->link('Delete', [
																'action' => 'deleteFile',
																'?' => [
																	'id' => $id,
																	'dir_path' => $list_path,
																	'name' => $name,
																	'path' => $before_path,
																]
															],
															[
																'target' => '_self',
																'class' => 'btn btn-danger btn-sm',
																'escape' => false,
															]
														);
													endif;
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