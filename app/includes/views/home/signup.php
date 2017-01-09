<?php

if (!empty($_POST)) {

	$errors = array();

	$email = filter_var(trim(strtolower($_POST['email'])), FILTER_SANITIZE_EMAIL);
	$password = $_POST['password'];
	$repeat_password = $_POST['repeat_password'];
	// $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

	if (empty($_POST['email'])) {

		$errors[] = 'Email field should not be empty.';
	
	} else if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {

		$errors[] = 'Please enter a valid email address.';

	}

	if (empty($password)) {

		$errors[] = 'Password field should not be empty.';

	}

	if (empty($repeat_password)) {

		$errors[] = 'Repeat Password field should not be empty.';

	}

	// pw min length

	if ($repeat_password !== $password) {

		$errors[] = 'Password fields do not match.';

	}

	if (empty($errors)) {

		if ($get['user']->getUser($email) === false) {

			$user_data = array(
				'email' => $email,
				'password' => password_hash($password, PASSWORD_DEFAULT)
			);

			$get['user']->signup($user_data);

		} else {

			$errors[] = 'An account with this email address already exists.';

		}

	}

}

?>

			<div class="section-wrapper main">
				<div class="container">
					<div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
						<div class="login-form">
							<header>
								<h2>Sign up</h2>
							</header>
							<span>Enter your email address and password to sign up.</span>
							<?php if (!empty($errors)) General::errors($errors); ?>
							<form method="post">
								<div class="form-group">
									<input type="email" class="form-control" name="email" id="email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" placeholder="Email Address">
								</div>
								<div class="form-group">
									<input type="password" class="form-control" name="password" id="password" placeholder="Password">
								</div>
								<div class="form-group">
									<input type="password" class="form-control" name="repeat_password" id="repeat_password" placeholder="Repeat Password">
								</div>
								<input type="hidden" name="token" value="<?php echo Session::get('token'); ?>">
								<button type="submit" class="btn btn-primary">Sign up</button>
								<a href="/login" class="btn btn-link">Cancel</button>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- end .section-wrapper -->