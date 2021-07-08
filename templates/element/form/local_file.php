<div class="content-wrapper">
	<div class="row">
		<div class="col-12 grid-margin">
			<div class="card">
				<div class="card-body">
					<?= $this->element('component/table_head'); ?>
						<?php
							echo $this->Form->create($folder, [
								'class' => 'form-sample',
							]);
						?>
						<p class="card-description">
							Folder
						</p>
						<div class="row">
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
						<?= $this->element('component/button_submit'); ?>
						<?= $this->element('component/button_cancel'); ?>
					<?= $this->Form->end(); ?>
				</div>
			</div>
		</div>
	</div>
</div>