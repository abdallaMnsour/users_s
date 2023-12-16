<?php
session_start();
if (isset($_GET['clear']) && $_GET['clear'] == 'true') {
	session_unset();
}
if (isset($_SESSION['person'])) {
	$username = $_SESSION['person']['username'];
	$email = $_SESSION['person']['email'];
	$password1 = $_SESSION['person']['password1'];
	$password2 = $_SESSION['person']['password2'];
	$address1 = $_SESSION['person']['address1'];
	$address2 = $_SESSION['person']['address2'];
	$phone = $_SESSION['person']['phone'];
	$country = $_SESSION['person']['country'];
	$county = $_SESSION['person']['county'];
	$city = $_SESSION['person']['city'];
	$gender = $_SESSION['person']['gender'];
} else {
	$username = '';
	$email = '';
	$password1 = '';
	$password2 = '';
	$address1 = '';
	$address2 = '';
	$phone = '';
	$country = '';
	$county = '';
	$city = '';
	$gender = '';
}


?>
<!DOCTYPE html>
<html>

<head>
	<title>Register</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="style.css" rel="stylesheet" type="text/css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="shortcut icon" href="../img/favicon.png">
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
						Create an account
					</h4>
					<form action="../functions/users/register.php" method="post" enctype="multipart/form-data">

						<!-- التحقق مما اذا قام المستخدم بالقيام ببعض التعديلات في حقول الادخال -->
						<?php if (isset($_SESSION['input_false'])) : ?>
							<div class="alert alert-danger"><i class="fa-solid fa-triangle-exclamation"></i> <?= $_SESSION['input_false'] ?></div>
						<?php endif; ?>

						<!-- التحقق مما اذا كان هناك خطا في ال sql ام لا -->
						<?php if (isset($_SESSION['errors']['sql'])) : ?>
							<div class="alert alert-danger mb-5"><i class="fa-solid fa-triangle-exclamation"></i> you have an error in you'r sql<br><b>message :</b> <?= $_SESSION['errors_update']['sql'] ?> please <a href="mailto:a.mansour.code@gmail.com">contact with developer</a></div>
						<?php endif; ?>

						<div class="form-input">
							<span><i class="fa fa-user-o"></i></span>
							<input type="text" name="username" placeholder="Full Name" required value="<?= $username ?>" />
						</div>
						<?php if (isset($_SESSION['errors']['username'])) : ?>
							<div class="alert alert-danger"><?= $_SESSION['errors']['username'] ?></div>
						<?php endif; ?>

						<div class="form-input">
							<span><i class="fa fa-envelope-o"></i></span>
							<input type="email" name="email" placeholder="Email Address" required value="<?= $email ?>" />
						</div>
						<?php if (isset($_SESSION['errors']['email'])) : ?>
							<div class="alert alert-danger"><?= $_SESSION['errors']['email'] ?></div>
						<?php endif; ?>

						<div class="form-input">
							<span><i class="fa fa-key"></i></span>
							<input type="password" name="password1" placeholder="Password" required value="<?= $password1 ?>" />
						</div>
						<?php if (isset($_SESSION['errors']['password'])) : ?>
							<div class="alert alert-danger"><?= $_SESSION['errors']['password'] ?></div>
						<?php endif; ?>

						<div class="form-input">
							<span><i class="fa fa-key"></i></span>
							<input type="password" name="password2" placeholder="Password" required value="<?= $password2 ?>" />
						</div>
						<?php if (isset($_SESSION['errors']['password2'])) : ?>
							<div class="alert alert-danger"><?= $_SESSION['errors']['password2'] ?></div>
						<?php endif; ?>

						<div class="form-input">
							<span><i class="fa-solid fa-location-dot"></i></span>
							<input type="text" name="address1" placeholder="Address 1" required value="<?= $address1 ?>" />
						</div>
						<?php if (isset($_SESSION['errors']['address'])) : ?>
							<div class="alert alert-danger"><?= $_SESSION['errors']['address'] ?></div>
						<?php endif; ?>

						<div class="form-input">
							<span><i class="fa-solid fa-location-dot"></i></span>
							<input type="text" name="address2" placeholder="Address 2" value="<?= $address2 ?>" />
						</div>

						<div class="form-input">
							<span><i class="fa-solid fa-phone"></i></span>
							<input type="text" name="phone" placeholder="Phone" required value="<?= $phone ?>" />
						</div>
						<?php if (isset($_SESSION['errors']['phone'])) : ?>
							<div class="alert alert-danger"><?= $_SESSION['errors']['phone'] ?></div>
						<?php endif; ?>

						<div class="form-input">
							<span><i class="fa-regular fa-flag"></i></span>
							<input type="text" name="county" placeholder="County" required value="<?= $county ?>" />
						</div>
						<?php if (isset($_SESSION['errors']['county'])) : ?>
							<div class="alert alert-danger"><?= $_SESSION['errors']['county'] ?></div>
						<?php endif; ?>

						<div class="form-input">
							<span><i class="fa-solid fa-city"></i></span>
							<input type="text" name="city" placeholder="city" required value="<?= $city ?>" />
						</div>
						<?php if (isset($_SESSION['errors']['city'])) : ?>
							<div class="alert alert-danger"><?= $_SESSION['errors']['city'] ?></div>
						<?php endif; ?>

						<div class="form-group">
							<label class="text-small text-uppercase" for="country">Country</label>
							<select name="country" aria-label="Default select example" class="form-select selectpicker country w-100" id="country" data-width="fit" data-style="form-control form-control-lg" data-title="Select your country">
								<?php if (isset($_SESSION['person']['country'])) : ?>
									<option value="<?= $country ?>"><?= $country ?></option>
								<?php endif; ?>
							</select>
						</div>
						<?php if (isset($_SESSION['errors']['country'])) : ?>
							<div class="alert alert-danger"><?= $_SESSION['errors']['country'] ?></div>
						<?php endif; ?>

						<div class="mb-3">
							<label for="image" class="form-label">You'r image</label>
							<input class="form-control" type="file" name="image" id="image">
						</div>
						<?php if (isset($_SESSION['errors']['image'])) : ?>
							<div class="alert alert-danger"><?= $_SESSION['errors']['image'] ?></div>
						<?php endif; ?>

						<div class="form-input pl-2">
							<span style="position: relative;" class="d-block pl-0"><i class="d-block mb-2 fa-solid fa-venus-mars"></i></span>
							<label class="mb-0">Gender</label><br>
							<input style="width:10px;height:10px" class="mb-0" type="radio" name="gender" value="0" <?= $gender == 0 ? 'checked' : '' ?> required id="male" /> <label for="male" class="m-0">male</label> <br>
							<input style="width:10px;height:10px" class="" type="radio" name="gender" value="1" <?= $gender == 1 ? 'checked' : '' ?> required id="female" /> <label for="female" class="m-0">female</label>
						</div>

						<div class="mb-3 d-flex align-items-center">
							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" id="cb1" name="remember" value="yes">
								<label class="custom-control-label" for="cb1">remember me</label>
							</div>
						</div>

						<div class="mb-3">
							<button type="submit" class="btn btn-block">
								Register
							</button>
						</div>
						<a href="?clear=true" class="link link-danger"><i class="fa-solid fa-triangle-exclamation"></i> clear the input</a>


						<div class="text-center mb-3">
							or register with
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
							Already have an account
							<a class="login-link" href="login.php">Login here</a>
						</div>

					</form>
				</div>
			</div>

			<div class="col-lg-6 d-none d-lg-block image-container"></div>
		</div>
	</div>
	<script src="../js/jquery-3.6.1.min.js"></script>
	<script>
		$.getJSON('../js/countries.json', function(data) {
			$.each(data, function(key, value) {
				var selectOption = "<option value='" + value.name + "' data-dial-code='" + value.dial_code + "'>" + value.name + "</option>";
				$("select.country").append(selectOption);
			});
		})
	</script>
</body>

</html>

<?php
$_SESSION['input_false'] = null;
