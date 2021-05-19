<div class="content-wrapper">
	<div class="row">
		<div class="col-12 grid-margin">
			<div class="card">
				<div class="card-body">
					<?= $this->element('component/table_head'); ?>
						<?php
							echo $this->Form->create($website, [
								'class' => 'form-sample',
							]);
							if (isset($website)) {
								echo $this->Form->hidden('id');
							}
						?>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group row">
									<label class="col-sm-3 col-form-label">Templates</label>
									<div class="col-sm-9">
										<div class="form-group">
											<select class="js-example-basic-single w-100" name="template_id">
												<?php
												if (isset($templates)) :
													$selected = 'selected';
													if ($templates) {
														$selected = '';
													}
												?>
												<option value="" <?= $selected;?>>Please select Template</option>
												<?php
													foreach ($templates as $k => $v) :
													$_selected = '';
													if ($template == $v->id) {
														$_selected = 'selected';
													}
												?>
													<option value="<?= $v->id; ?>" <?= $_selected;?>><?= $v->name; ?></option>
												<?php
													endforeach;
												else:
												?>
													<option value="">No Template!!!</option>
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
												'class' => 'form-control form-control-lg',
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
									<label class="col-sm-3 col-form-label">Domain</label>
									<div class="col-sm-9">
										<?php
											echo $this->Form->input('domain', [
												'type' => 'text',
												'class' => 'form-control',
												'placeholder' => 'Domain',
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
									<label class="col-sm-3 col-form-label">Code</label>
									<div class="col-sm-9">
										<?php
											echo $this->Form->input('code', [
												'type' => 'text',
												'class' => 'form-control',
												'placeholder' => 'Code',
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
						<div class="row">
							<div class="col-md-6">
								<div class="form-group row">
									<label class="col-sm-3 col-form-label">Applications</label>
									<div class="col-sm-9">
										<div class="form-group">
											<select class="js-example-basic-single w-100" name="application_id">
												<?php
												if (isset($applications)) :
													$selected = 'selected';
													if ($applications) {
														$selected = '';
													}
												?>
												<option value="" <?= $selected;?>>Please select Applications</option>
												<?php
													foreach ($applications as $k => $v) :
													$_selected = '';
													if ($application == $v->id) {
														$_selected = 'selected';
													}
												?>
													<option value="<?= $v->id; ?>" <?= $_selected;?>><?= $v->display; ?></option>
												<?php
													endforeach;
												else:
												?>
													<option value="">No Applications!!!</option>
												<?php endif; ?>
											</select>
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