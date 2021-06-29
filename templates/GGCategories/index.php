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
										<select class="js-example-basic-single w-100" name="website_id">
											<?php
												if (isset($websites)) :
													$default_s = 'selected';
													$id = null;
													if ($this->request->getQuery('website_id')) :
														$id = $this->request->getQuery('website_id');
														$default_s = '';
													endif;
												?>
												<option value="" <?= $default_s;?>>Please select Website</option>
											<?php

												foreach ($websites as $key => $value) :
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
												<option value="">No Website!!!</option>
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
											placeholder="Group Name"/>
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
									<th>Website</th>
									<th>Title</th>
									<th>Icon</th>
									<th>Tag Links</th>
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
										<td><?= (isset($value->website->display)) ? h($value->website->display) : '-' ?></td>
										<td><?= h($value->title) ?></td>
										<td>
											<?php
												$image = explode('size', $value->icon);
												$image_url = $image[0].'size=100x100';
											?>
											<a href="<?= $value->icon; ?>" target="_blank">
												<img class="rounded-0" src="<?= $image_url; ?>" alt="<?= $value->website->display;?>">
											</a>
										</td>
										<td><?= h($value->tag_links) ?></td>
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
										<td colspan="9" class="text-danger text-center"><?= __(NO_DATA) ?></td>
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