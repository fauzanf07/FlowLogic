<?php 
	session_start();
	if(!isset($_SESSION['name'])){
		header("Location: http://localhost/skripsi/");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Course</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="stylesheet" type="text/css" href="../css/user/course.css">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter&family=Roboto+Slab&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
	<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>
<body>
	<nav class="navbar navbar-expand-lg bg-light sticky-top" style="top: 0; bottom: 0;">
		<div class="container-fluid">
		    <a class="navbar-brand" href="#"> <i class="bi bi-code-square"></i> FunCode</a>
		    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		      <span class="navbar-toggler-icon"></span>
		    </button>
		    <div class="collapse navbar-collapse " id="navbarNav">
			    <ul class="navbar-nav ms-auto">
			        <li class="nav-item">
			        	<a class="nav-link "  href="./home.php">Home</a>
			        </li>
			        <li class="nav-item">
			        	<a class="nav-link" href="./profile.php" >Profile</a>
			        </li>
			        <li class="nav-item">
			        	<a class="nav-link active" aria-current="course" href="#">Course</a>
			        </li>
			        <li class="nav-item">
			          <a class="nav-link btn btn-secondary" id="sign-out">Sign out <i class="bi bi-arrow-right"></i></a>
			        </li>
			    </ul>
		    </div>
		</div>
	</nav>
	<div class="header-page">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-3">
					<img src="../images/img-class.png" class="img-class" data-aos="zoom-in">
				</div>
				<div class="col-lg-6" style="padding-top: 5px;">
					<h3 id="class-title">Algorithm & Programming</h3>
					<span id="info-class"><i class="bi bi-clock-fill"></i>&nbsp; 7 jam belajar&nbsp;&nbsp;&nbsp;&nbsp;<i class="bi bi-people-fill"></i>&nbsp; 52 siswa terdaftar</span>
					<p id="class-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas dictum libero nibh, et ultricies velit pharetra eu. Maecenas convallis elit urna, at pretium leo tempus id. Praesent semper mi leo, et posuere tellus laoreet nec. Nulla vulputate est id augue imperdiet, et condimentum nulla posuere.</p>
				</div>
				<div class="col-lg-3 card-class">
					<div class="card">
						<div class="card-body">
						    <div class="progress" style="height: 30px;">
								 <div class="progress-bar bg-warning progress-bar-striped" role="progressbar" aria-label="Example with label" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
							</div>
							<a href="../courses/course1.php" type="button" class="btn btn-class">Lanjutkan Kelas</a>
							<hr>
							<a href="#info-class-section" type="button" class="btn btn-info-class">Informasi Kelas</a>
							<a href="#silabus-section" type="button" class="btn btn-info-class mt-15">Lihat Silabus</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="info-class-page" id="info-class-section">
		<div class="container-fluid">
			<center><h2>Informasi Kelas</h2></center>
			<div class="row" style="padding: 50px 0px 60px 0px; border-bottom: 3px solid #f3f3f4;">
				<div class="col-lg-4 col-card-info">
					<div class="card" style="width: 100%;" data-aos="zoom-in">
					  	<div class="card-body">
						    <h5 class="card-title">Lorem Ipsum :</h5>
						    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas dictum libero nibh, et ultricies velit pharetra eu. Maecenas convallis elit urna, at pretium leo tempus id. Praesent semper mi leo, et posuere tellus laoreet nec. Nulla vulputate est id augue imperdiet, et condimentum nulla posuere. Fusce nec ultrices ex, a faucibus purus. Maecenas scelerisque dolor ut lacinia tincidunt. Aliquam ultrices neque ac tellus accumsan auctor. Integer vel lorem leo. Aliquam tincidunt sapien nec eros lobortis, dapibus vestibulum enim porta. Quisque at bibendum arcu.</p>
					  	</div>
					</div>
				</div>
				<div class="col-lg-4 col-card-info">
					<div class="card" style="width: 100%;" data-aos="zoom-in">
					  	<div class="card-body">
						    <h5 class="card-title">Lorem Ipsum :</h5>
						    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas dictum libero nibh, et ultricies velit pharetra eu. Maecenas convallis elit urna, at pretium leo tempus id. Praesent semper mi leo, et posuere tellus laoreet nec. Nulla vulputate est id augue imperdiet, et condimentum nulla posuere. Fusce nec ultrices ex, a faucibus purus. Maecenas scelerisque dolor ut lacinia tincidunt. Aliquam ultrices neque ac tellus accumsan auctor. Integer vel lorem leo. Aliquam tincidunt sapien nec eros lobortis, dapibus vestibulum enim porta. Quisque at bibendum arcu.</p>
					  	</div>
					</div>
				</div>
				<div class="col-lg-4 col-card-info">
					<div class="card" style="width: 100%;" data-aos="zoom-in">
					  	<div class="card-body">
						    <h5 class="card-title">Lorem Ipsum :</h5>
						    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas dictum libero nibh, et ultricies velit pharetra eu. Maecenas convallis elit urna, at pretium leo tempus id. Praesent semper mi leo, et posuere tellus laoreet nec. Nulla vulputate est id augue imperdiet, et condimentum nulla posuere. Fusce nec ultrices ex, a faucibus purus. Maecenas scelerisque dolor ut lacinia tincidunt. Aliquam ultrices neque ac tellus accumsan auctor. Integer vel lorem leo. Aliquam tincidunt sapien nec eros lobortis, dapibus vestibulum enim porta. Quisque at bibendum arcu.</p>
					  	</div>
					</div>
				</div>
			</div>	
		</div>
	</div>
	<div class="silabus-page" id="silabus-section">
		<center><h2>Silabus</h2></center>
		<center><span style="font-size: 18px; margin-top: 10px; display: inline-block; ">Materi yang akan anda pelajari</span></center>
		<div class="card materials" data-aos="zoom-in">
			<div class="card-body" id="material1">
			    <h5 class="material-titles">Lorem Ipsum </h5>
			    <p class="mt-15">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas dictum libero nibh, et ultricies velit pharetra eu.</p>
			    <div class="card-flex">
			    	<span><i class="bi bi-card-text"></i>&nbsp;&nbsp;5 Artikel &nbsp;&#10072;&nbsp; <i class="bi bi-card-checklist"></i>&nbsp;&nbsp;1 Ujian</span>
			    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="bi bi-clock-history"></i>&nbsp;&nbsp; 5 Menit
			</div>
			<div class="collapse collapse-materials" id="materialCollapse1">
				<ul>
					<li>
						<div class="checklist check">&#10003;</div>
						<span class="material-name">Lorem ipsum dolor sit amet, consectetur adipiscing elit&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="bi bi-clock-history"></i>&nbsp; 5 Menit</span>
					</li>
					<li>
						<div class="checklist"></div>
						<span class="material-name">Lorem ipsum dolor sit amet, consectetur adipiscing elit&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="bi bi-clock-history"></i>&nbsp; 5 Menit</span>
					</li>
					<li>
						<div class="checklist"></div>
						<span class="material-name">Lorem ipsum dolor sit amet, consectetur adipiscing elit&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="bi bi-clock-history"></i>&nbsp; 5 Menit</span>
					</li>
					<li>
						<div class="checklist"></div>
						<span class="material-name">Lorem ipsum dolor sit amet, consectetur adipiscing elit&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="bi bi-clock-history"></i>&nbsp; 5 Menit</span>
					</li>
					<li>
						<div class="checklist"></div>
						<span class="material-name">Lorem ipsum dolor sit amet, consectetur adipiscing elit&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="bi bi-clock-history"></i>&nbsp; 5 Menit</span>
					</li>
				</ul>
			</div>
			
		</div>
		<div class="card materials" data-aos="zoom-in">
			<div class="card-body" id="material2">
			    <h5 class="material-titles">Lorem Ipsum </h5>
			    <p class="mt-15">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas dictum libero nibh, et ultricies velit pharetra eu.</p>
			    <div class="card-flex">
			    	<span><i class="bi bi-card-text"></i>&nbsp;&nbsp;5 Artikel &nbsp;&#10072;&nbsp; <i class="bi bi-card-checklist"></i>&nbsp;&nbsp;1 Ujian</span>
			    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="bi bi-clock-history"></i>&nbsp;&nbsp; 5 Menit
			</div>
			<div class="collapse collapse-materials" id="materialCollapse2">
				<ul>
					<li>
						<div class="checklist check">&#10003;</div>
						<span class="material-name">Lorem ipsum dolor sit amet, consectetur adipiscing elit&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="bi bi-clock-history"></i>&nbsp; 5 Menit</span>
					</li>
					<li>
						<div class="checklist"></div>
						<span class="material-name">Lorem ipsum dolor sit amet, consectetur adipiscing elit&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="bi bi-clock-history"></i>&nbsp; 5 Menit</span>
					</li>
					<li>
						<div class="checklist"></div>
						<span class="material-name">Lorem ipsum dolor sit amet, consectetur adipiscing elit&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="bi bi-clock-history"></i>&nbsp; 5 Menit</span>
					</li>
					<li>
						<div class="checklist"></div>
						<span class="material-name">Lorem ipsum dolor sit amet, consectetur adipiscing elit&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="bi bi-clock-history"></i>&nbsp; 5 Menit</span>
					</li>
					<li>
						<div class="checklist"></div>
						<span class="material-name">Lorem ipsum dolor sit amet, consectetur adipiscing elit&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="bi bi-clock-history"></i>&nbsp; 5 Menit</span>
					</li>
				</ul>
			</div>
			
		</div>
		<div class="card materials" data-aos="zoom-in">
			<div class="card-body" id="material3">
			    <h5 class="material-titles">Lorem Ipsum </h5>
			    <p class="mt-15">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas dictum libero nibh, et ultricies velit pharetra eu.</p>
			    <div class="card-flex">
			    	<span><i class="bi bi-card-text"></i>&nbsp;&nbsp;5 Artikel &nbsp;&#10072;&nbsp; <i class="bi bi-card-checklist"></i>&nbsp;&nbsp;1 Ujian</span>
			    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="bi bi-clock-history"></i>&nbsp;&nbsp; 5 Menit
			</div>
			<div class="collapse collapse-materials" id="materialCollapse3">
				<ul>
					<li>
						<div class="checklist check">&#10003;</div>
						<span class="material-name">Lorem ipsum dolor sit amet, consectetur adipiscing elit&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="bi bi-clock-history"></i>&nbsp; 5 Menit</span>
					</li>
					<li>
						<div class="checklist"></div>
						<span class="material-name">Lorem ipsum dolor sit amet, consectetur adipiscing elit&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="bi bi-clock-history"></i>&nbsp; 5 Menit</span>
					</li>
					<li>
						<div class="checklist"></div>
						<span class="material-name">Lorem ipsum dolor sit amet, consectetur adipiscing elit&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="bi bi-clock-history"></i>&nbsp; 5 Menit</span>
					</li>
					<li>
						<div class="checklist"></div>
						<span class="material-name">Lorem ipsum dolor sit amet, consectetur adipiscing elit&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="bi bi-clock-history"></i>&nbsp; 5 Menit</span>
					</li>
					<li>
						<div class="checklist"></div>
						<span class="material-name">Lorem ipsum dolor sit amet, consectetur adipiscing elit&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="bi bi-clock-history"></i>&nbsp; 5 Menit</span>
					</li>
				</ul>
			</div>
			
		</div>
		<div class="card materials" data-aos="zoom-in">
			<div class="card-body" id="material4">
			    <h5 class="material-titles">Lorem Ipsum </h5>
			    <p class="mt-15">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas dictum libero nibh, et ultricies velit pharetra eu.</p>
			    <div class="card-flex">
			    	<span><i class="bi bi-card-text"></i>&nbsp;&nbsp;5 Artikel &nbsp;&#10072;&nbsp; <i class="bi bi-card-checklist"></i>&nbsp;&nbsp;1 Ujian</span>
			    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="bi bi-clock-history"></i>&nbsp;&nbsp; 5 Menit
			</div>
			<div class="collapse collapse-materials" id="materialCollapse4">
				<ul>
					<li>
						<div class="checklist check">&#10003;</div>
						<span class="material-name">Lorem ipsum dolor sit amet, consectetur adipiscing elit&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="bi bi-clock-history"></i>&nbsp; 5 Menit</span>
					</li>
					<li>
						<div class="checklist"></div>
						<span class="material-name">Lorem ipsum dolor sit amet, consectetur adipiscing elit&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="bi bi-clock-history"></i>&nbsp; 5 Menit</span>
					</li>
					<li>
						<div class="checklist"></div>
						<span class="material-name">Lorem ipsum dolor sit amet, consectetur adipiscing elit&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="bi bi-clock-history"></i>&nbsp; 5 Menit</span>
					</li>
					<li>
						<div class="checklist"></div>
						<span class="material-name">Lorem ipsum dolor sit amet, consectetur adipiscing elit&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="bi bi-clock-history"></i>&nbsp; 5 Menit</span>
					</li>
					<li>
						<div class="checklist"></div>
						<span class="material-name">Lorem ipsum dolor sit amet, consectetur adipiscing elit&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="bi bi-clock-history"></i>&nbsp; 5 Menit</span>
					</li>
				</ul>
			</div>
			
		</div>
		<div class="card materials" data-aos="zoom-in">
			<div class="card-body" id="material5">
			    <h5 class="material-titles">Lorem Ipsum </h5>
			    <p class="mt-15">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas dictum libero nibh, et ultricies velit pharetra eu.</p>
			    <div class="card-flex">
			    	<span><i class="bi bi-card-text"></i>&nbsp;&nbsp;5 Artikel &nbsp;&#10072;&nbsp; <i class="bi bi-card-checklist"></i>&nbsp;&nbsp;1 Ujian</span>
			    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="bi bi-clock-history"></i>&nbsp;&nbsp; 5 Menit
			</div>
			<div class="collapse collapse-materials" id="materialCollapse5">
				<ul>
					<li>
						<div class="checklist check">&#10003;</div>
						<span class="material-name">Lorem ipsum dolor sit amet, consectetur adipiscing elit&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="bi bi-clock-history"></i>&nbsp; 5 Menit</span>
					</li>
					<li>
						<div class="checklist"></div>
						<span class="material-name">Lorem ipsum dolor sit amet, consectetur adipiscing elit&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="bi bi-clock-history"></i>&nbsp; 5 Menit</span>
					</li>
					<li>
						<div class="checklist"></div>
						<span class="material-name">Lorem ipsum dolor sit amet, consectetur adipiscing elit&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="bi bi-clock-history"></i>&nbsp; 5 Menit</span>
					</li>
					<li>
						<div class="checklist"></div>
						<span class="material-name">Lorem ipsum dolor sit amet, consectetur adipiscing elit&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="bi bi-clock-history"></i>&nbsp; 5 Menit</span>
					</li>
					<li>
						<div class="checklist"></div>
						<span class="material-name">Lorem ipsum dolor sit amet, consectetur adipiscing elit&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="bi bi-clock-history"></i>&nbsp; 5 Menit</span>
					</li>
				</ul>
			</div>
			
		</div>
	</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript" src="../js/user/course.js"></script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init();
</script>
</html>