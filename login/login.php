<?php
if (isset($_GET['no_user'])) {
	$email_bool = true;
	$email = $_GET['no_user'];
} else {
	$email_bool = false;
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Login</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
</head>

<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-6 form-block px-4">
				<div class="col-lg-8 col-md-6 col-sm-8 col-xs-12 form-box">
					<div class="text-center mb-3 mt-5">
						<img src="logo.png" width="150px">
					</div>
					<h4 class="text-center mb-4">
						Login into account
					</h4>
					<form action="../functions/users/login.php" method="post">
						<?php if ($email_bool) : ?>
							<div class="alert alert-danger">email or password is wrong please try again</div>
						<?php endif; ?>
						<div class="form-input">
							<span><i class="fa fa-envelope-o"></i></span>
							<input type="email" name="email" placeholder="Email Address" required value="<?= $email ?? '' ?>" />
						</div>
						<div class="form-input">
							<span><i class="fa fa-key"></i></span>
							<input type="password" name="password" placeholder="Password" required>
						</div>

						<div class="mb-3 d-flex align-items-center">
							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" id="cb1" name="remember" value="yes">
								<label class="custom-control-label" for="cb1">Remember me</label>
							</div>
						</div>

						<div class="mb-3">
							<button type="submit" class="btn btn-block">
								Login
							</button>
						</div>

						<div class="text-right ">
							<a href="reset.php" class="forget-link">
								Forgot password?
							</a>
						</div>

						<div class="text-center mb-3">
							or login with
						</div>

						<div class="row mb-3">
							<div class="col-4">
								<a href="" class="btn btn-block btn-social btn-facebook">
									<i class="fa fa-facebook"></i>
								</a>
							</div>

							<div class="col-4">
								<a href="" class="btn btn-block btn-social btn-google">
									<i class="fa fa-google"></i>
								</a>
							</div>

							<div class="col-4">
								<a href="" class="btn btn-block btn-social btn-twitter">
									<i class="fa fa-twitter"></i>
								</a>
							</div>
						</div>

						<div class="text-center mb-5">
							Don't have an account?
							<a class="register-link" href="register.php">Register here</a>
						</div>
					</form>
				</div>
			</div>

			<div class="col-lg-6 d-none d-lg-block image-container"></div>
		</div>
	</div>
</body>

</html>