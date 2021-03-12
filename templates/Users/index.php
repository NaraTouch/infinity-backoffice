<div class="content-wrapper">
	<div class="row">
		<div class="col-lg-12 grid-margin stretch-card">
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
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th>#</th>
									<th>Name</th>
									<th>Email</th>
									<th>Groups</th>
									<th>Status</th>
									<th>Created</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php if(isset($users)):
								foreach ($users as $key => $value):
								?>
								<td><?= h($key) ?></td>
								<td><?= h($value->name) ?></td>
								<td><?= h($value->email) ?></td>
								<td><?= h($value->group->name) ?></td>
								<td>
									<?php if($value->active):?>
									<label class="badge badge-success">Active</label></td>
									<?php else: ?>
									<label class="badge badge-danger">InActive</label></td>
									<?php endif; ?>
								<td><?= date('Y-m-d H:i:s', strtotime($value->created)); ?></td>
								<td>
									<button type="button" class="btn btn-primary btn-sm">Edit</button>
									<button type="button" class="btn btn-danger btn-sm">Delete</button>
								</td>
								<?php
								endforeach;
								?>
								
								<?php else: ?>
									<tr>
										<td colspan="7" class="text-danger text-center"><?= __(NO_DATA) ?></td>
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