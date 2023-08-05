<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>FlowLogic</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../css/sign-up/style.css?v=1.0">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg  nav-parent">
        <div class="container-fluid">
            <a class="navbar-brand" href="..">
			    <h4><i class="bi bi-code-square"></i>&nbsp;&nbsp;FlowLogic</h4>
			</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto item-nav">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                    <a class="nav-link" href="#">About</a>
                    <a class="nav-link" href="#">Contact</a>
                    <a href="../sign-in" class="btn btn-primary sign-in-btn">Sign In</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="main-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="signup-title">
						<h1>Sign Up</h1>
					</div>
					<form>
						<div class="form-group">
							<label for="inputEmail">Email address</label>
							<input type="email" id="inputEmail" class="form-control" placeholder="name@example.com">
						</div>
                        <div class="form-group">
							<label for="inputEmail">Username</label>
							<input type="text" id="inputUsername" class="form-control" placeholder="User123">
						</div>
                        <div class="form-group w-48 d-inline-block input-split">
							<label for="inputEmail">Nama Lengkap</label>
							<input type="text" id="inputName" class="form-control" placeholder="Masukkan Nama Lengkap">
						</div>
                        <div class="form-group w-48 d-inline-block fl-right input-split">
							<label for="inputEmail">Kelas</label>
							<select id="inputKelas" class="form-select" aria-label="Default select example">
								<option value="XI PPLG 1" selected>XI PPLG 1</option>
								<option value="XI PPLG 2">XI PPLG 2</option>
							</select>
						</div>
						<div class="form-group w-48 d-inline-block input-split">
							<label for="inputPassword">Password</label>
							<input type="password" id="inputPassword" class="form-control" id="inputPassword" placeholder="Password">
						</div>
						<div class="form-group w-48 d-inline-block fl-right input-split">
							<label for="inputConfPassword">Konfirmasi Password</label>
							<input type="password" id="inputKonPassword" class="form-control" id="inputConfPassword" placeholder="Password">
						</div>
						<div class="form-group form-check">
							<input type="checkbox" class="form-check-input" id="verif">
							<label class="form-check-label" for="verif" >Semua data sudah benar</label>
						</div>
						<div class="class-btn">
							<button type="button" class="btn btn-primary submit-btn" id="submit">Submit <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner"></button>
						</div>
					</form>
                </div>
            </div>
        </div>
    </div>

    <footer>
		<div class="copyright">
			<p>© 2023 by Fauzan Fiqriansyah</p>
		</div>
		<div class="background-footer"></div>
	</footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="../js/sign-up/sign-up.js"></script>
</html>