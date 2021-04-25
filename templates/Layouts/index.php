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
										<select class="js-example-basic-single w-100" name="subpage_id">
											<?php
												if (isset($subpages)) :
													$default_s = 'selected';
													$id = null;
													if ($this->request->getQuery('subpage_id')) :
														$id = $this->request->getQuery('subpage_id');
														$default_s = '';
													endif;
												?>
												<option value="" <?= $default_s;?>>Please select Sub Page</option>
											<?php

												foreach ($subpages as $key => $value) :
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
												<option value="">No Sub Page!!!</option>
											<?php endif; ?>
										</select>
									</div>
								</div>
							</div>
							<div class="col-sm-2 col-12">
								<div class="form-group row">
									<div class="col-12">
										<select class="js-example-basic-single w-100" name="component_id">
											<?php
												if (isset($components)) :
													$default_s = 'selected';
													$id = null;
													if ($this->request->getQuery('component_id')) :
														$id = $this->request->getQuery('component_id');
														$default_s = '';
													endif;
												?>
												<option value="" <?= $default_s;?>>Please select Component</option>
											<?php

												foreach ($components as $key => $value) :
												$selected = '';
												if ($id == $value->id) {
													$selected = 'selected';
												}
											?>
												<option value="<?= $value->id; ?>" <?= $selected;?>><?= $value->name; ?></option>
											<?php
												endforeach;
											else:
											?>
												<option value="">No Component!!!</option>
											<?php endif; ?>
										</select>
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
									<th>Sub Page</th>
									<th>Component</th>
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
										<td><?= h($value->subpage->display) ?></td>
										<td><?= h($value->component->name) ?></td>
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