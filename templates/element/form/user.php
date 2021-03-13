<div class="content-wrapper">
	<div class="row">
		<div class="col-12 grid-margin">
			<div class="card">
				<div class="card-body">
					<?= $this->element('component/table_head'); ?>
					<form action="add" method="post" class="form-sample">
						<p class="card-description">
							Personal info
						</p>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group row">
									<label class="col-sm-3 col-form-label">Name</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" name="name" placeholder="Name"/>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group row">
									<label class="col-sm-3 col-form-label">Email</label>
									<div class="col-sm-9">
										<input type="email" name="email" class="form-control form-control-lg" placeholder="Email" />
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group row">
									<label class="col-sm-3 col-form-label">Group</label>
									<div class="col-sm-9">
										<div class="form-group">
											<select class="js-example-basic-single w-100" name="groups">
												<?php
												if (isset($groups)) :
													foreach ($groups as $g => $v_g) :
												?>
													<option value="<?= $v_g->id; ?>" ><?= $v_g->name; ?></option>
												<?php
													endforeach;
												else:
												?>
													<option value="">No Group!!!</option>
												<?php endif; ?>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group row">
									<label class="col-sm-3 col-form-label">Status</label>
									<div class="col-sm-4">
										<div class="form-check">
											<label class="form-check-label">
												<input type="radio" class="form-check-input" name="status" value="true" checked>
												Active
											</label>
										</div>
									</div>
									<div class="col-sm-5">
										<div class="form-check">
											<label class="form-check-label">
												<input type="radio" class="form-check-input" name="status" value="false">
												Inactive
											</label>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group row">
									<label class="col-sm-3 col-form-label">Password</label>
									<div class="col-sm-9">
										<input type="password" name="password" class="form-control form-control-lg" placeholder="Password" />
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group row">
									<label class="col-sm-3 col-form-label">Confirm Password</label>
									<div class="col-sm-9">
										<input type="password" name="confirm_password" class="form-control form-control-lg" placeholder="Confirm Password" />
									</div>
								</div>
							</div>
						</div>
						<?= $this->element('component/button_submit'); ?>
						<?= $this->element('component/button_cancel'); ?>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>