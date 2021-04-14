<?php
	echo $this->Form->create($permission, [
		'class' => 'form-sample',
	]);
	if (isset($permission)) {
		echo $this->Form->hidden('role_id');
	}
?>
<div class="content-wrapper" style="padding-bottom: 0px;">
	<div class="row">
		<div class="col-lg-12 grid-margin stretch-card" style="margin-bottom: 0px;">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Permission for role : <?= h($role_name);?></h4>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="content-wrapper" style="padding-bottom: 0px;">
	<div class="row">
		<?php if (isset($module_list)) :
				foreach ($module_list as $k_module => $module) : ?>
			<div class="col-2 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title"><?= h($module->display);?></h4>
						<div class="row">
							<div class="col-12">
								<?php foreach ($module->methods as $k_method => $method):
									$name = 'permission['.$method->id.'][method_id]';
									$checked = '';
									foreach ($permission_list as $k_permission => $v_permission) :
										if ($v_permission->method_id == $method->id) {
											$checked = 'checked';
										}
									endforeach;
								?>
									<div class="form-group">
										<div class="form-check">
											<label class="form-check-label">
												<input 
													type="checkbox"
													value="<?= $method->id.'-'.$module->id ?>"
													name="<?= $name ?>"
													class="form-check-input"
													<?= $checked;?>
												>
												<?= h($method->display);?>
											</label>
										</div>
									</div>
								<?php endforeach;?>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php endforeach;
			endif;
		?>
	</div>
</div>

<div class="content-wrapper" style="padding-top: 0px;">
	<div class="row">
		<div class="col-lg-12 grid-margin stretch-card" style="margin-bottom: 0px;">
			<div class="card">
				<div class="card-body">
						<?= $this->element('component/button_submit'); ?>
						<?= $this->element('component/button_cancel'); ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?= $this->Form->end(); ?>