<div class="content-wrapper">
	<div class="row">
		<div class="col-12 grid-margin">
			<div class="card">
				<div class="card-body">
					<?= $this->element('component/table_head'); ?>
						<?php
							echo $this->Form->create($role, [
								'class' => 'form-sample',
							]);
							if (isset($role)) {
								echo $this->Form->hidden('id');
							}
						?>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group row">
									<label class="col-sm-3 col-form-label">Groups</label>
									<div class="col-sm-9">
										<div class="form-group">
											<select class="js-example-basic-single w-100" name="group_id">
												<?php
												if (isset($groups)) :
													$selected = 'selected';
													if ($group) {
														$selected = '';
													}
												?>
												<option value="" <?= $selected;?>>Please select Groups</option>
												<?php
													foreach ($groups as $m => $v_m) :
													$selected_group = '';
													if ($group == $v_m->id) {
														$selected_group = 'selected';
													}
												?>
													<option value="<?= $v_m->id; ?>" <?= $selected_group;?>><?= $v_m->name; ?></option>
												<?php
													endforeach;
												else:
												?>
													<option value="">No Groups!!!</option>
												<?php endif; ?>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group row">
									<label class="col-sm-3 col-form-label">Name</label>
									<div class="col-sm-9">
										<?php
											echo $this->Form->input('name', [
												'type' => 'text',
												'class' => 'form-control',
												'placeholder' => 'Name',
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
									<label class="col-sm-3 col-form-label">Display</label>
									<div class="col-sm-9">
										<?php
											echo $this->Form->input('display', [
												'type' => 'text',
												'class' => 'form-control',
												'placeholder' => 'Display',
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