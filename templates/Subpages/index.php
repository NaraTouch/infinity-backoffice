<div class="content-wrapper">
	<div class="row">
		<div class="col-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<div class="btn-toolbar justify-content-between">
						<div class="btn-group" >
							<?= $this->element('component/table_head'); ?>
						</div>
						<div class="input-group">
							<?= $this->element('component/button_add'); ?>
						</div>
					</div>
					<form class="form-sample">
						<div class="row">
							<div class="col-sm-2 col-12">
								<div class="form-group row">
									<div class="col-12">
										<select class="js-example-basic-single w-100" name="page_id">
											<?php
												if (isset($pages)) :
													$default_s = 'selected';
													$id = null;
													if ($this->request->getQuery('page_id')) :
														$id = $this->request->getQuery('page_id');
														$default_s = '';
													endif;
												?>
												<option value="" <?= $default_s;?>>Please select Page</option>
											<?php

												foreach ($pages as $key => $value) :
												$selected = '';
												if ($id == $value->id) {
													$selected = 'selected';
												}
											?>
												<option value="<?= $value->id; ?>" <?= $selected;?>><?= $value->display; ?></option>
											<?php
												endforeach;
											else:
											?>
												<option value="">No Page!!!</option>
											<?php endif; ?>
										</select>
									</div>
								</div>
							</div>
							<div class="col-sm-2 col-12">
								<div class="form-group row">
									<div class="col-12">
										<input 
											type="text"
											class="form-control"
											name="keywords"
											value="<?= ($this->request->getQuery('keywords')) ? $this->request->getQuery('keywords') : ''?>"
											placeholder="Page Name"/>
									</div>
								</div>
							</div>
							<div class="col-sm-2 col-12">
								<div class="form-group row">
									<div class="col-12">
										<button type="submit" class="btn btn-primary mb-2">Submit</button>
									</div>
								</div>
							</div>
						</div>
					</form>
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th>#</th>
									<th>Page</th>
									<th>Name</th>
									<th>Display</th>
									<th>Tag Link</th>
									<th>Icon</th>
									<th>Code</th>
									<th>Sort</th>
									<th>Status</th>
									<th>Created</th>
									<?= $this->element('component/th_action'); ?>
								</tr>
							</thead>
							<tbody>
								<?php if($data):
									foreach ($data as $key => $value):
								?>
									<tr>
										<td><?= h($key) ?></td>
										<td><?= h($value->page->display) ?></td>
										<td><?= h($value->name) ?></td>
										<td><?= h($value->display) ?></td>
										<td><?= h($value->tag_links) ?></td>
										<td><?= (isset($value->icon)) ? h($value->icon) : '-'?></td>
										<td><?= h($value->code) ?></td>
										<td>
											<label class="badge badge-success"><?= h($value->sort) ?></label>
										</td>
										<td>
											<?php if($value->active):?>
											<label class="badge badge-success">Active</label>
											<?php else: ?>
											<label class="badge badge-danger">InActive</label>
											<?php endif; ?>
										</td>
										<td><?= date('Y-m-d H:i:s', strtotime($value->created)); ?></td>
										<td>
											<?php
											if (!empty($features)
												&& (isset($features['edit'])
												&& $features['edit'] == true)):
												echo $this->Html->link('Edit', [
														'action' => 'edit',
														$value->id
													],
													[
														'class' => 'btn btn-primary btn-sm',
														'escape' => false,
													]
												);
											endif;
											if (!empty($features)
												&& (isset($features['delete'])
												&& $features['delete'] == true)):
												echo $this->Html->link('Delete', [
														'action' => 'delete',
														$value->id
													],
													[
														'class' => 'btn btn-danger btn-sm',
														'escape' => false,
													]
												);
											endif;
											?>
										</td>
									</tr>
								<?php
									endforeach;
								?>
								<?php else: ?>
									<tr>
										<td colspan="10" class="text-danger text-center"><?= __(NO_DATA) ?></td>
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