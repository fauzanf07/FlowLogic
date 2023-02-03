<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Fun Code</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../css/sign-in/style.css?v=1.0">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg  nav-parent">
        <div class="container-fluid">
            <a class="navbar-brand" href="..">
			    <h4><i class="bi bi-code-square"></i>&nbsp;&nbsp;FunCode</h4>
			</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto item-nav">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                    <a class="nav-link" href="#">About</a>
                    <a class="nav-link" href="#">Contact</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="main-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <center><img class="img-ilustrasi" src="../images/ilustrasi2.png" alt="ilustrasi"></center>
                </div>
                <div class="col-lg-6">
                    <div class="d-flex align-items-center" style="min-height: 100%">
                        <div class="box login-wrapper">
                            <center><h3>MASUK</h3></center>
                            <center><img class="avatar" src="../images/avatar.jpg" alt=""></center>
                            <form method="post">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">@</span>
                                    <input type="text" class="form-control" placeholder="Username atau Email" aria-label="Username" aria-describedby="basic-addon1" id="signUsername">
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-key"></i></span>
                                    <input type="password" class="form-control" placeholder="Kata sandi" aria-label="Username" aria-describedby="basic-addon1" id="signPassword">
                                </div>
                                <button type="button" class="btn btn-primary w-100 btn-signin" id="sign-in">SIGN IN</button>
                                <center><span class="d-block mt-3">Pengguna baru? <a href="../sign-up" target="_blank" rel="noopener noreferrer">Buat sebuah akun</a></span></center>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="../js/sign-in/sign-in.js"></script>
</html>