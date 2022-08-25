<!DOCTYPE html>
<html>
<head>
	<title>Fun Code</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/landing-page/style.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter&family=Roboto+Slab&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>
<body>
	<div id="wrapper">
		<div class="black-wrapper"></div>
		<div id="content">
			<nav class="navbar">
			  <div class="container-fluid">
			    <a class="navbar-brand" href="#">
			      	<i class="bi bi-code-square"></i>
			      FunCode
			    </a>
			    <button type="button" class="btn btn-sign f-right" onclick="signIn()">Sign In</button>
			  </div>
			</nav>
			<div class="form-section">
				<h1>Improve Your Programming Skills Here</h1>
				<p>Be the best programmer and make yourself stand out from others at your work • <b><span>Join Us!</span></b></p>
				<div class="container-fluid">
					<div class="col-lg-7 col-sm-12 form">
						<form method="post" id="signUpForm">
							<div class="input-group flex-nowrap">
							  <span class="input-group-text" id="addon-wrapping">Email</span>
							  <input type="email" id="inputEmail" class="form-control input-sign-up" placeholder="Input your Email" aria-label="Email" aria-describedby="addon-wrapping" required="required">
							</div>
							<div class="input-group flex-nowrap">
							  <span class="input-group-text" id="addon-wrapping">Name</span>
							  <input type="text"  id="inputName" class="form-control input-sign-up" placeholder="Input your Name" aria-label="Name" aria-describedby="addon-wrapping" required="required">
							</div>
							<div class="input-group flex-nowrap">
							  <span class="input-group-text" id="addon-wrapping">Username</span>
							  <input type="text" id="inputUsername" class="form-control input-sign-up" placeholder="Input your Userame" aria-label="Username" aria-describedby="addon-wrapping" required="required">
							</div>
							<div class="input-group flex-nowrap">
							  <span class="input-group-text" id="addon-wrapping">Password</span>
							  <input type="password" id="inputPassword" class="form-control input-sign-up" placeholder="Input your Password" aria-label="Password" aria-describedby="addon-wrapping" required="required">
							</div>
							<button type="button" id="submit" class="btn btn-sign">Sign Up Now</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="black-wrapper sign-in-pop-up"></div>
		<div class="card w-40 sign-in-pop-up card-sign-in">
		  <div class="card-body">
		    <a class="navbar-brand c-black" href="#">
			    <i class="bi bi-code-square"></i>
			      FunCode
			</a>
			<i class="bi bi-x" id="close"></i>
		    <form method="post" id="signInForm">
		    	<input type="text" id="signUsername" class="form-control mt-20" placeholder="Userame or Email">
		    	<input type="password" id="signPassword" class="form-control mt-20"  placeholder="Password">
		    	<a href="forgot-password.php" class="link">Forgot Password?</a>
		    </form>
		    <buttton class="btn btn-primary w-100 mt-20" id="sign-in">Sign In</buttton>
		  </div>
		</div>
	</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="js/landing-page/landing-page.js"></script>
</html>