<?php 
	session_start();
	if(!isset($_SESSION['name'])){
		header("Location: http://localhost/skripsi/");
	}
	include("../db.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="stylesheet" type="text/css" href="../css/user/home.css">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter&family=Roboto+Slab&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
	<link href="https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/4.0.17/css/froala_style.min.css" integrity="sha512-7LA92qqMxQg1dy0GXIaceecW4zpFq/pu2inmPOd/IaCjDnjzDP1luaG9NTYU8BeaUmBw73jHCGRJjQ3xDpdDlg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link href="https://cdn.jsdelivr.net/npm/froala-editor@latest/css/plugins/image.min.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<nav class="navbar navbar-expand-lg sticky-top bg-light">
	  <div class="container-fluid">
	    <a class="navbar-brand" href="#"> <i class="bi bi-code-square"></i> FunCode</a>
	    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	      <span class="navbar-toggler-icon"></span>
	    </button>
	    <div class="collapse navbar-collapse " id="navbarNav">
	      <ul class="navbar-nav ms-auto">
	        <li class="nav-item">
	          <a class="nav-link active" aria-current="page" href="#">Home</a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" href="./profile.php">Profile</a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" href="./course.php">Course</a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link btn btn-secondary" id="sign-out">Sign out <i class="bi bi-arrow-right"></i></a>
	        </li>
	      </ul>
	    </div>
	  </div>
	</nav>
	<div class="container">
		<div class="row">
			<div class="col-lg-7">
				<h3 class="header">What's new?</h3>
				<button type="button" class="btn btn-light" id="refresh">Refresh</button>
				<?php

					$sql = "SELECT * FROM tb_post ORDER BY created_at DESC";
					$result = mysqli_query($con, $sql);
					while($r_post = mysqli_fetch_assoc($result)){
						$id = $r_post['id_user'];
						$query = "SELECT * FROM tb_user WHERE id='$id'";
						$hasil = mysqli_query($con, $query);
						$r = mysqli_fetch_assoc($hasil);
						echo '
							<div class="post">
								<div class="top">
									<div class="top-photo">
										<img src= '. $r['photo_profile'] .' class="avatar">
									</div>
									<div class="top-name">
										<b><span>'. $r['name'] .'</span></b><span>&nbsp;&nbsp;'. $r['username'] .'</span><br>
										<span>'.$r_post['created_at'].'</span>
									</div>
								</div>
								<div class="content-post fr-view">
									'.$r_post['content'].'
								</div>
							</div>
						';
					}
				?>
				<button type="button" class="btn btn-outline-secondary" id="loadPostMore">Load More</button>
			</div>
			<div class="col-lg-1">
			</div>
			<div class="col-lg-4" id="curr-ranks">
				<h3 class="header"><i class="bi bi-trophy-fill"></i>&nbsp;&nbsp;Current Rankings</h3>
				<div class="ranks">
					<table class="table">
					  <thead>
					    <tr>
					      <th scope="col">#</th>
					      <th scope="col">Name</th>
					      <th scope="col">Points</th>
					    </tr>
					  </thead>
					  <tbody>
					    <tr>
					      <th scope="row">1</th>
					      <td>Ahmad Wahyudin Suryono</td>
					      <td>2000</td>
					    <tr>
					      <th scope="row">2</th>
					      <td>Ahmad Wahyudin Suryono</td>
					      <td>2000</td>
					    </tr>
					    <tr>
					      <th scope="row">3</th>
					      <td>Ahmad Wahyudin Suryono</td>
					      <td>2000</td>
					    </tr>
					    <tr>
					      <th scope="row">4</th>
					      <td>Ahmad Wahyudin Suryono</td>
					      <td>2000</td>
					    </tr>
					    <tr>
					      <th scope="row">5</th>
					      <td>Ahmad Wahyudin Suryono</td>
					      <td>2000</td>
					    </tr>
					    <tr>
					      <th scope="row">6</th>
					      <td>Ahmad Wahyudin Suryono</td>
					      <td>2000</td>
					    </tr>
					    <tr>
					      <th scope="row">7</th>
					      <td>Ahmad Wahyudin Suryono</td>
					      <td>2000</td>
					    </tr>
					    <tr>
					      <th scope="row">8</th>
					      <td>Ahmad Wahyudin Suryono</td>
					      <td>2000</td>
					    </tr>
					    <tr>
					      <th scope="row">9</th>
					      <td>Ahmad Wahyudin Suryono</td>
					      <td>2000</td>
					    </tr>
					    <tr>
					      <th scope="row">10</th>
					      <td>Ahmad Wahyudin Suryono</td>
					      <td>2000</td>
					    </tr>
					  </tbody>
					</table>
					<button type="button" class="btn btn-outline-secondary" id="loadRanksMore">Load More</button>
				</div>

			</div>
		</div>
	</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript" src="../js/user/home.js"></script>

</html>