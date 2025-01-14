<?php
	session_start();
	require_once "../api/endpoints.php";

	if(isset($_SESSION["login"])) {
		header("location: ../admin");
	};
?>

<!doctype html>
<html lang="en">
  <head>
  	<title>Login</title>
	<link href="../assets/img/favicon.png" rel="icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/style.css">

	</head>
	<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-7 col-lg-5">
					<div class="login-wrap p-4 p-md-5">
		      	<div class="icon d-flex align-items-center justify-content-center">
		      		<span class="fa fa-user-o"></span>
		      	</div>
		      	<h3 class="text-center mb-4">Login</h3>
				<form action="../api/auth/validations.php" method="POST" id="login-form" class="login-form">
					<?php
						if(isset($_SESSION["auth"])) {
							$message = $_SESSION["auth"];
							echo "<div class='alert alert-danger' role='alert'>$message</div>";
							unset($_SESSION["auth"]);
						}
					?>
						<div class="form-group">
							<input name="username" type="text" class="form-control rounded-left" placeholder="Username" required>
						</div>
						<div class="form-group d-flex">
							<input name="password" type="password" class="form-control rounded-left" placeholder="Password" required>
						</div>
						<div class="form-group">
							<button name="submit" type="submit" class="form-control btn btn-primary rounded submit px-3">Login</button>
						</div>
						<div class="form-group d-md-flex">
							<div class="w-50">
								<label class="checkbox-wrap checkbox-primary">Remember Me
									<input type="checkbox" name="rememberme" checked>
									<span class="checkmark"></span>
								</label>
							</div>
							<div class="w-50 text-md-right">
								<a href="#">Forgot Password</a>
							</div>
						</div>
	          	</form>
	        </div>
				</div>
			</div>
		</div>
	</section>

	<!-- <script type="text/javascript">
		const loginForm = document.querySelector("#login-form");
		loginForm.addEventListener("submit", event => {
			event.preventDefault();

			let url = "<?= $validations ?>";
			let formData = new FormData();

			fetch(url, {method: "POST", body: formData})
			.then((res) => {
				return res.json();
			}).then((data) => {
				console.log(data);

			}).catch((err) => {
				console.error("error!");
			});

		}) -->

		

	</script>

	</body>
</html>

