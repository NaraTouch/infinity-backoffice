<div class="content-wrapper">
	<div class="row">
		<div class="col-12 grid-margin">
			<div class="card">
				<div class="card-body">
					<?= $this->element('component/table_head'); ?>
						<?php
							echo $this->Form->create($layout, [
								'class' => 'form-sample',
							]);
							if (isset($layout)) {
								echo $this->Form->hidden('id');
							}
						?>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group row">
									<label class="col-sm-3 col-form-label">Sub Pages</label>
									<div class="col-sm-9">
										<div class="form-group">
											<select class="js-example-basic-single w-100" name="subpage_id">
												<?php
												if (isset($subpages)) :
													$selected = 'selected';
													if ($subpage) {
														$selected = '';
													}
												?>
												<option value="" <?= $selected;?>>Please select Sub Page</option>
												<?php
													foreach ($subpages as $k => $v) :
													$_selected = '';
													if ($subpage == $v->id) {
														$_selected = 'selected';
													}
												?>
													<option value="<?= $v->id; ?>" <?= $_selected;?>><?= $v->display; ?></option>
												<?php
													endforeach;
												else:
												?>
													<option value="">No Sub Pages!!!</option>
												<?php endif; ?>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group row">
									<label class="col-sm-3 col-form-label">Components</label>
									<div class="col-sm-9">
										<div class="form-group">
											<select class="js-example-basic-single w-100" name="component_id">
												<?php
												if (isset($components)) :
													$selected = 'selected';
													if ($component) {
														$selected = '';
													}
												?>
												<option value="" <?= $selected;?>>Please select Components</option>
												<?php
													foreach ($components as $k => $v) :
													$_selected = '';
													if ($component == $v->id) {
														$_selected = 'selected';
													}
												?>
													<option value="<?= $v->id; ?>" <?= $_selected;?>><?= $v->name; ?></option>
												<?php
													endforeach;
												else:
												?>
													<option value="">No Components!!!</option>
												<?php endif; ?>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group row">
									<label class="col-sm-3 col-form-label">Sort</label>
									<div class="col-sm-9">
										<?php
											echo $this->Form->input('sort', [
												'type' => 'text',
												'class' => 'form-control',
												'placeholder' => 'Sort',
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