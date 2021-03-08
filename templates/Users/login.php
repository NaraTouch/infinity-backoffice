<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<?php $image_url = $this->Url->build('/', ['escape' => false,'fullBase' => true,]);?>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Skydash Admin</title>
		<?php
			echo $this->Html->css([
				'vendors/feather/feather',
				'vendors/ti-icons/css/themify-icons',
				'vendors/css/vendor.bundle.base',
				'vertical-layout-light/style',
			]);
			echo $this->fetch('css');
		?>
		<link rel="shortcut icon" href="<?= $image_url.'images/favicon.png'?>" />
	</head>

	<body>
		<div class="container-scroller">
			<div class="container-fluid page-body-wrapper full-page-wrapper">
				<div class="content-wrapper d-flex align-items-center auth px-0">
					<div class="row w-100 mx-0">
						<div class="col-lg-4 mx-auto">
							<div class="auth-form-light text-left py-5 px-4 px-sm-5">
								<div class="brand-logo">
									<img src="<?= $image_url.'images/logo.svg'?>" alt="logo">
								</div>
								<h4>Hello! let's get started</h4>
								<h6 class="font-weight-light">Sign in to continue.</h6>
								<form action="login" method="post" class="pt-3">
									<div class="form-group">
										<input
											type="email"
											name="email"
											class="form-control form-control-lg"
											placeholder="Username"
										>
									</div>
									<div class="form-group">
										<input
											type="password"
											name="password"
											class="form-control form-control-lg"
											placeholder="Password"
										>
									</div>
									<?= $this->Flash->render() ?>
									<div class="mt-3">
										<?php
										echo $this->Form->button('SIGN IN', [
											'type' => 'submit',
											'class' => 'btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn',
										]); ?>
									</div>
									<div class="my-2 d-flex justify-content-between align-items-center">
										<div class="form-check">
											<label class="form-check-label text-muted">
												<input type="checkbox" class="form-check-input">
												Keep me signed in
											</label>
										</div>
										<a href="#" class="auth-link text-black">Forgot password?</a>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- content-wrapper ends -->
			</div>
			<!-- page-body-wrapper ends -->
		</div>
		<?php
		echo $this->Html->script([
			'vendors/js/vendor.bundle.base',
			'off-canvas',
			'hoverable-collapse',
			'template',
		]);
		echo $this->fetch('script');
		?>
	</body>

</html>
