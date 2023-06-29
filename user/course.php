<?php 
	session_start();
	include("../db.php");
	if(!isset($_SESSION['name'])){
		header("Location: http://localhost/skripsi/");
	}else{
		$currCourse = $_SESSION['curr_course'];
		$progress = intval(($_SESSION['curr_course']/20)*100);
		$progressBg = "";
		if($progress<=30){
			$progressBg = "bg-danger";
		}else if($progress<=60){
			$progressBg = "bg-warning";
		}else{
			$progressBg = "bg-success";
		}
		$jmlUser = 0;
		$sql = "SELECT * FROM tb_user WHERE `admin` = '0'" ;
		$query = mysqli_query($con, $sql);
		$jmlUser = mysqli_num_rows($query);
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
		    <a class="navbar-brand" href="#"> <i class="bi bi-code-square"></i> FlowLogic</a>
		    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		      <span class="navbar-toggler-icon"></span>
		    </button>
		    <div class="collapse navbar-collapse " id="navbarNav">
			    <ul class="navbar-nav ms-auto">
			        <li class="nav-item">
			        	<a class="nav-link "  href="./home.php">Home</a>
			        </li>
			        <li class="nav-item">
			        	<a class="nav-link" href="./profile.php?user=<?php echo $_SESSION['username']; ?>" >Profile</a>
			        </li>
			        <li class="nav-item">
			        	<a class="nav-link active" aria-current="course" href="#">Corridor</a>
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
					<h3 id="class-title">Pemrograman Dasar</h3>
					<span id="info-class"><i class="bi bi-clock-fill"></i>&nbsp; 7 jam belajar&nbsp;&nbsp;&nbsp;&nbsp;<i class="bi bi-people-fill"></i>&nbsp; <?php echo $jmlUser; ?> siswa terdaftar</span>
					<p id="class-desc">Kelas ini bertujuan untuk mengajarkan peserta didik tentang konsep dasar dalam pemrograman melalui topik seperti flowchart, pseudocode, prosedur, dan fungsi. Peserta didik akan memperoleh pemahaman mendalam tentang bagaimana mengorganisir, menganalisis, dan merencanakan langkah-langkah dalam menyelesaikan masalah pemrograman. Selain itu kelas ini juga dirancang untuk meningkatkan kemampuan Computational Thinking peserta didik.</p>
				</div>
				<div class="col-lg-3 card-class">
					<div class="card">
						<div class="card-body">
						    <div class="progress" style="height: 30px;">
								 <div class="progress-bar <?php echo $progressBg; ?> progress-bar-striped" role="progressbar" aria-label="Example with label" style="width: <?php echo $progress . "%"; ?>; aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $progress . "%"; ?></div>
							</div>
							<button type="button" class="btn btn-class" id="continueClass" data-course="<?php echo $_SESSION['curr_course'] ?>" data-username = "<?php echo $_SESSION['username'] ?>">Lanjutkan Kelas</button>
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
				<div class="col-lg-6 col-md-6 col-card-info">
					<div class="card card-info" style="width: 100%;" data-aos="zoom-in">
					  	<div class="card-body">
						    <h5 class="card-title">Flowchart</h5>
						    <p class="card-text">Peserta didik akan belajar tentang bagaimana membuat diagram visual yang menggambarkan urutan langkah-langkah dalam algoritma. Kalian akan belajar mengenali simbol-simbol dalam flowchart, menghubungkan langkah-langkah, dan memahami alur logika dari suatu program.</p>
					  	</div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-card-info">
					<div class="card card-info" style="width: 100%;" data-aos="zoom-in">
					  	<div class="card-body">
						    <h5 class="card-title">Pseudocode</h5>
						    <p class="card-text">Peserta didik akan mempelajari tentang penulisan pseudocode, yaitu suatu metode deskripsi dalam bahasa yang mirip dengan bahasa pemrograman, namun lebih sederhana. Kalian akan belajar merancang algoritma menggunakan pseudocode sebagai langkah awal sebelum menerjemahkannya menjadi kode pemrograman.</p>
					  	</div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 mt-4 col-card-info">
					<div class="card card-info" style="width: 100%;" data-aos="zoom-in">
					  	<div class="card-body">
						    <h5 class="card-title">Prosedur</h5>
						    <p class="card-text">Peserta didik akan memahami konsep dasar tentang prosedur atau subrutin. Kalian akan belajar bagaimana mengelompokkan serangkaian instruksi yang terkait ke dalam suatu blok yang dapat dipanggil atau digunakan berulang kali dalam program. Peserta didik juga akan mempelajari tentang parameter dan pengembalian nilai dalam prosedur</p>
					  	</div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 mt-4 col-card-info">
					<div class="card card-info" style="width: 100%;" data-aos="zoom-in">
					  	<div class="card-body">
						    <h5 class="card-title">Fungsi</h5>
						    <p class="card-text">Peserta didik akan belajar tentang fungsi sebagai blok kode yang dapat menerima argumen dan mengembalikan nilai. Kalian akan memahami bagaimana mendefinisikan fungsi, mengirimkan nilai ke fungsi, dan menggunakan nilai yang dikembalikan oleh fungsi dalam program.</p>
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
			    <h5 class="material-titles">Level 1: Diagram Alir (Flowchart) </h5>
			    <p class="mt-15">Peserta didik akan belajar mengenai apa itu flowchart, mengenali simbol-simbol dalam flowchart, memahami alur dari suatu flowchart, serta teknik penggambaran flowchart</p>
			    <div class="card-flex">
			    	<span><i class="bi bi-card-text"></i>&nbsp;&nbsp;6 Artikel &nbsp;&#10072;&nbsp; <i class="bi bi-card-checklist"></i>&nbsp;&nbsp;1 Quiz &nbsp;&#10072;&nbsp; <i class="bi bi-clipboard-check"></i>&nbsp;&nbsp;1 Challenge</span>
			    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="bi bi-clock-history"></i>&nbsp;&nbsp; 48 Menit &nbsp;&nbsp;&nbsp;<i class="bi bi-diamond-fill"></i>&nbsp;&nbsp;325 points &nbsp;&nbsp;&nbsp;<i class="bi bi-star-fill"></i>&nbsp;&nbsp;1200 XP &nbsp;&nbsp;&nbsp;<i class="bi bi-award-fill"></i>&nbsp;&nbsp;1 Badge
			</div>
			<div class="collapse collapse-materials" id="materialCollapse1">
				<ul>
					<li>
						<div class="checklist <?php if($currCourse>1){ echo 'check';} ?>"><?php if($currCourse>1){ echo '&#10003;';} ?></div>
						<span class="material-name">Pengenalan Flowchart&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="bi bi-clock-history"></i>&nbsp; 5 Menit &nbsp;&nbsp;&nbsp;<i class="bi bi-star-fill"></i>&nbsp;&nbsp;100 XP</span>
					</li>
					<li>
						<div class="checklist <?php if($currCourse>2){ echo 'check';} ?>"><?php if($currCourse>2){ echo '&#10003;';} ?></div>
						<span class="material-name">Simbol dan Notasi Flowchart&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="bi bi-clock-history"></i>&nbsp; 5 Menit &nbsp;&nbsp;&nbsp;<i class="bi bi-star-fill"></i>&nbsp;&nbsp;100 XP</span>
					</li>
					<li>
						<div class="checklist <?php if($currCourse>3){ echo 'check';} ?>"><?php if($currCourse>3){ echo '&#10003;';} ?></div>
						<span class="material-name">Pemahaman Alur Flowchart&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="bi bi-clock-history"></i>&nbsp; 10 Menit &nbsp;&nbsp;&nbsp;<i class="bi bi-star-fill"></i>&nbsp;&nbsp;100 XP</span>
					</li>
					<li>
						<div class="checklist <?php if($currCourse>4){ echo 'check';} ?>"><?php if($currCourse>4){ echo '&#10003;';} ?></div>
						<span class="material-name">Teknik Membuat Flowchart&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="bi bi-clock-history"></i>&nbsp; 10 Menit &nbsp;&nbsp;&nbsp;<i class="bi bi-star-fill"></i>&nbsp;&nbsp;100 XP</span>
					</li>
					<li>
						<div class="checklist <?php if($currCourse>5){ echo 'check';} ?>"><?php if($currCourse>5){ echo '&#10003;';} ?></div>
						<span class="material-name"><b>Challenge :</b> Studi Kasus&nbsp;&nbsp;&nbsp;<i class="bi bi-clock-history"></i>&nbsp; 15 Menit &nbsp;&nbsp;&nbsp;<i class="bi bi-star-fill"></i>&nbsp;&nbsp;300 XP &nbsp;&nbsp;&nbsp;<i class="bi bi-diamond-fill"></i>&nbsp;&nbsp;Up to 300 points &nbsp;&nbsp;&nbsp;<i class="bi bi-award-fill"></i>&nbsp;&nbsp;1 Badge</span>
					</li>
					<li>
						<div class="checklist <?php if($currCourse>6){ echo 'check';} ?>"><?php if($currCourse>6){ echo '&#10003;';} ?></div>
						<span class="material-name">Quiz Singkat&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="bi bi-clock-history"></i>&nbsp; 3 Menit &nbsp;&nbsp;&nbsp;<i class="bi bi-star-fill"></i>&nbsp;&nbsp;Up to 500 XP&nbsp;&nbsp;&nbsp;<i class="bi bi-diamond-fill"></i>&nbsp;&nbsp;Up to 25 points</span>
					</li>
					
				</ul>
			</div>
			
		</div>
		<div class="card materials" data-aos="zoom-in">
			<div class="card-body" id="material2">
			    <h5 class="material-titles">Level 2: Pseudocode</h5>
			    <p class="mt-15">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas dictum libero nibh, et ultricies velit pharetra eu.</p>
			    <div class="card-flex">
			    	<span><i class="bi bi-card-text"></i>&nbsp;&nbsp;6 Artikel &nbsp;&#10072;&nbsp; <i class="bi bi-card-checklist"></i>&nbsp;&nbsp;1 Quiz&nbsp;&#10072;&nbsp; <i class="bi bi-clipboard-check"></i>&nbsp;&nbsp;1 Challenge</span>
			    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="bi bi-clock-history"></i>&nbsp;&nbsp; 40 Menit &nbsp;&nbsp;&nbsp;<i class="bi bi-diamond-fill"></i>&nbsp;&nbsp;325 points &nbsp;&nbsp;&nbsp;<i class="bi bi-star-fill"></i>&nbsp;&nbsp;1200 XP &nbsp;&nbsp;&nbsp;<i class="bi bi-award-fill"></i>&nbsp;&nbsp;1 Badge
			</div>
			<div class="collapse collapse-materials" id="materialCollapse2">
				<ul>
					<li>
						<div class="checklist <?php if($currCourse>7){ echo 'check';} ?>"><?php if($currCourse>7){ echo '&#10003;';} ?></div>
						<span class="material-name">Pengenalan Pseudocode&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="bi bi-clock-history"></i>&nbsp; 5 Menit &nbsp;&nbsp;&nbsp;<i class="bi bi-star-fill"></i>&nbsp;&nbsp;100 XP</span>
					</li>
					<li>
						<div class="checklist <?php if($currCourse>8){ echo 'check';} ?>"><?php if($currCourse>8){ echo '&#10003;';} ?></div>
						<span class="material-name">Struktur Pseudocode&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="bi bi-clock-history"></i>&nbsp; 5 Menit &nbsp;&nbsp;&nbsp;<i class="bi bi-star-fill"></i>&nbsp;&nbsp;100 XP</span>
					</li>
					<li>
						<div class="checklist <?php if($currCourse>9){ echo 'check';} ?>"><?php if($currCourse>9){ echo '&#10003;';} ?></div>
						<span class="material-name">Notasi Algoritmik&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="bi bi-clock-history"></i>&nbsp; 8 Menit &nbsp;&nbsp;&nbsp;<i class="bi bi-star-fill"></i>&nbsp;&nbsp;100 XP</span>
					</li>
					<li>
						<div class="checklist <?php if($currCourse>10){ echo 'check';} ?>"><?php if($currCourse>10){ echo '&#10003;';} ?></div>
						<span class="material-name">Cara menulis Pseudocode&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="bi bi-clock-history"></i>&nbsp; 4 Menit &nbsp;&nbsp;&nbsp;<i class="bi bi-star-fill"></i>&nbsp;&nbsp;100 XP</span>
					</li>
					<li>
						<div class="checklist <?php if($currCourse>11){ echo 'check';} ?>"><?php if($currCourse>11){ echo '&#10003;';} ?></div>
						<span class="material-name"><b>Challenge :</b> Studi Kasus&nbsp;&nbsp;&nbsp;<i class="bi bi-clock-history"></i>&nbsp; 15 Menit &nbsp;&nbsp;&nbsp;<i class="bi bi-star-fill"></i>&nbsp;&nbsp;300 XP &nbsp;&nbsp;&nbsp;<i class="bi bi-diamond-fill"></i>&nbsp;&nbsp;Up to 300 points &nbsp;&nbsp;&nbsp;<i class="bi bi-award-fill"></i>&nbsp;&nbsp;1 Badge</span>
					</li>
					<li>
						<div class="checklist <?php if($currCourse>12){ echo 'check';} ?>"><?php if($currCourse>12){ echo '&#10003;';} ?></div>
						<span class="material-name">Quiz Singkat&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="bi bi-clock-history"></i>&nbsp; 3 Menit &nbsp;&nbsp;&nbsp;<i class="bi bi-star-fill"></i>&nbsp;&nbsp;Up to 500 XP&nbsp;&nbsp;&nbsp;<i class="bi bi-diamond-fill"></i>&nbsp;&nbsp;Up to 25 points</span>
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