<div class="content-wrapper">
	<div class="row">
		<div class="col-12 grid-margin">
			<div class="card">
				<div class="card-body">
					<?= $this->element('component/table_head'); ?>
						<?php
							echo $this->Form->create($account, [
								'class' => 'form-sample',
							]);
							if (isset($account)) {
								echo $this->Form->hidden('id');
							}
						?>
						<p class="card-description">
							P-Cloud
						</p>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group row">
									<label class="col-sm-3 col-form-label">Websites</label>
									<div class="col-sm-9">
										<div class="form-group">
											<select class="js-example-basic-single w-100" name="website_id">
												<?php
												if (isset($websites)) :
													$selected = 'selected';
													if ($website) {
														$selected = '';
													}
												?>
												<option value="" <?= $selected;?>>Please select Website</option>
												<?php
													foreach ($websites as $k => $v) :
													$_selected = '';
													if ($website == $v->id) {
														$_selected = 'selected';
													}
												?>
													<option value="<?= $v->id; ?>" <?= $_selected;?>><?= $v->display; ?></option>
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
							</div>
							<div class="col-md-6">
								<div class="form-group row">
									<label class="col-sm-3 col-form-label">Email</label>
									<div class="col-sm-9">
										<?php
											echo $this->Form->input('email', [
												'type' => 'text',
												'class' => 'form-control',
												'placeholder' => 'Email',
												'label' => false,
												'required' => false,
											]);
										?>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group row">
									<label class="col-sm-3 col-form-label">Password</label>
									<div class="col-sm-9">
										<?php
											echo $this->Form->input('password', [
												'type' => 'password',
												'class' => 'form-control form-control-lg',
												'placeholder' => 'Password',
												'label' => false,
												'required' => false,
											]);
										?>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group row">
									<label class="col-sm-3 col-form-label">Status</label>
									<?php
										$_active = 'checked';
										$_inactive = '';
										if (!$active) {
											$_active = '';
											$_inactive = 'checked';
										}
									?>
									<div class="col-sm-4">
										<div class="form-check">
											<label class="form-check-label">
												<input 
													type="radio"
													class="form-check-input"
													name="active"
													value=1
													<?= $_active;?>
												>
												Active
											</label>
										</div>
									</div>
									<div class="col-sm-5">
										<div class="form-check">
											<label class="form-check-label">
												<input
													type="radio"
													class="form-check-input"
													name="active"
													value=0
													<?= $_inactive;?>
												>
												Inactive
											</label>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?= $this->element('component/button_submit'); ?>
						<?= $this->element('component/button_cancel'); ?>
					<?= $this->Form->end(); ?>
				</div>
			</div>
		</div>
	</div>
</div>