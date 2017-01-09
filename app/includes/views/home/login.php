<?php

if (!empty($_POST)) {

	$email = filter_var(trim(strtolower($_POST['email'])), FILTER_SANITIZE_EMAIL);
	$password = $_POST['password'];

	if (empty($_POST['email'])) {

		$errors[] = 'Email field should not be empty.';
	
	} else if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {

		$errors[] = 'Please enter a valid email address.';

	}

	if (empty($password)) {

		$errors[] = 'Password field should not be empty.';

	}

	if (empty($errors)) {

		$user = $get['user']->getUser($email);

		if ($user) {

			if (password_verify($password, $user['password'])) {

				$get['user']->login($email);

			} else {

				$errors[] = 'Email address and/or password is incorrect.';

			}

		} else {

			$errors[] = 'That email address is invalid or does not exist.';

		}

	}

}

?>

			<div class="section-wrapper main">
				<div class="container">
					<div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
						<div class="login-form">
							<header>
								<h2>Login</h2>
							</header>
							<?php if (!empty($errors)) General::errors($errors); ?>
							<form method="post">
								<div class="form-group">
									<input type="email" class="form-control" name="email" id="email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" placeholder="Email Address">
								</div>
								<div class="form-group">
									<input type="password" class="form-control" name="password" id="password" placeholder="Password">
								</div>
								<input type="hidden" name="token" value="<?php echo Session::get('token'); ?>">
								<button type="submit" class="btn btn-primary">Login</button>
								<a href="<?php print SITE_URL; ?>" class="btn btn-link">Cancel</a>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- end .section-wrapper -->
