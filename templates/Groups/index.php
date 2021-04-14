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
					<form class="form-sample">
						<div class="row">
							<div class="col-2">
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
							<div class="col-2">
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
									<th>Name</th>
									<th>Display</th>
									<th>Code</th>
									<th>Status</th>
									<th>Super User</th>
									<th>Created</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php if($groups):
									foreach ($groups as $key => $value):
								?>
									<tr>
										<td><?= h($key) ?></td>
										<td><?= h($value->name) ?></td>
										<td><?= h($value->display) ?></td>
										<td><?= h($value->code) ?></td>
										<td>
											<?php if($value->super_user):?>
											<label class="badge badge-success">Super User</label>
											<?php else: ?>
											<label class="badge badge-danger">Not Super User</label>
											<?php endif; ?>
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
											<?= $this->Html->link('Edit', [
													'action' => 'edit',
													$value->id
												],
												[
													'class' => 'btn btn-primary btn-sm',
													'escape' => false,
												]
											); ?>
											<?= $this->Html->link('Delete', [
													'action' => 'delete',
													$value->id
												],
												[
													'class' => 'btn btn-danger btn-sm',
													'escape' => false,
												]
											); ?>
										</td>
									</tr>
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