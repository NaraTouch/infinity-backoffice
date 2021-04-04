<div class="content-wrapper">
	<div class="row">
		<div class="col-12 grid-margin">
			<div class="card">
				<div class="card-body">
					<?= $this->element('component/table_head'); ?>
						<?php
							echo $this->Form->create($method, [
								'class' => 'form-sample',
							]);
							if (isset($method)) {
								echo $this->Form->hidden('id');
							}
						?>
						<p class="card-description">
							Personal info
						</p>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group row">
									<label class="col-sm-3 col-form-label">Modules</label>
									<div class="col-sm-9">
										<div class="form-group">
											<select class="js-example-basic-single w-100" name="module_id">
												<?php
												if (isset($modules)) :
													$selected = 'selected';
													if ($module) {
														$selected = '';
													}
												?>
												<option value="" <?= $selected;?>>Please select Modules</option>
												<?php
													foreach ($modules as $m => $v_m) :
													$selected_module = '';
													if ($module == $v_m->id) {
														$selected_module = 'selected';
													}
												?>
													<option value="<?= $v_m->id; ?>" <?= $selected_module;?>><?= $v_m->display; ?></option>
												<?php
													endforeach;
												else:
												?>
													<option value="">No Modules!!!</option>
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
									<label class="col-sm-3 col-form-label">Symbol</label>
									<div class="col-sm-9">
										<?php
											echo $this->Form->input('symbol', [
												'type' => 'text',
												'class' => 'form-control',
												'placeholder' => 'Symbol',
												'label' => false,
												'required' => false,
											]);
										?>
									</div>
								</div>
							</div>
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
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group row">
									<label class="col-sm-3 col-form-label">Is Menu</label>
									<?php
										$_is_menu = 'checked';
										$_not_menu = '';
										if (!$is_menu) {
											$_is_menu = '';
											$_not_menu = 'checked';
										}
									?>
									<div class="col-sm-4">
										<div class="form-check">
											<label class="form-check-label">
												<input 
													type="radio"
													class="form-check-input"
													name="is_menu"
													value=1
													<?= $_is_menu;?>
												>
												Yes
											</label>
										</div>
									</div>
									<div class="col-sm-5">
										<div class="form-check">
											<label class="form-check-label">
												<input
													type="radio"
													class="form-check-input"
													name="is_menu"
													value=0
													<?= $_not_menu;?>
												>
												No
											</label>
										</div>
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