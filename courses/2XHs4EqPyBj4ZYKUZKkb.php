<?php 	
	session_start();
	include('../db.php');
	if(!isset($_SESSION['name'])){
		header("Location: http://localhost/skripsi/");
	}else{
		$username = $_SESSION['username'];
		$idUser= $_SESSION['user_id'];
		$query = "SELECT * FROM tb_user WHERE username='$username'";
		$hasil = mysqli_query($con, $query);
		$r = mysqli_fetch_assoc($hasil);

		$currCourse = $_SESSION['curr_course'];
		$progress = intval(($_SESSION['curr_course']/5)*100);
		$progressBg = "";
		if($progress <=30){
			$progressBg = "bg-danger";
		}else if($progress<=60){
			$progressBg = "bg-warning";
		}else{
			$progressBg = "bg-success";
		}
	}
 ?>
 <!--COURSE 5 -->
<!DOCTYPE html>
<html>
<head>
	<title>Quiz Singkat</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="stylesheet" type="text/css" href="../css/courses/style.css">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter&family=Roboto+Slab&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
	<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>
<body>
	<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
		<div class="offcanvas-header">
			<h5 class="offcanvas-title" id="offcanvasRightLabel"><i class="bi bi-trophy-fill"></i>&nbsp;&nbsp;Top Ranks</h5>
				<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
		</div>
		<div class="offcanvas-body">
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
	<nav class="navbar navbar-expand-lg bg-light sticky-top" style="top: 0; bottom: 0;" id="navbar">
		<div class="container-fluid">
		    <a class="navbar-brand" href="#"> <i class="bi bi-code-square"></i> FunCode</a>
		    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		      <span class="navbar-toggler-icon"></span>
		    </button>
		    <div class="collapse navbar-collapse " id="navbarNav">
			    <ul class="navbar-nav ms-auto">
			    	<li class="nav-item">
			        	<a class="nav-link active" aria-current="course" href="../user/course.php" style="text-align: center;">Corridor</a>
			        </li>
			        <div class="btn-group dropdown-center">
						<button type="button" class="btn btn-light dropdown-toggle btn-nav" data-bs-toggle="dropdown" aria-expanded="false">
						    <img src="<?php echo $_SESSION['photo_profile']; ?>" class="photo_profile">
						</button>
						<ul class="dropdown-menu">
						    <li><a class="dropdown-item" href="../user/home.php"><i class="bi bi-house-fill"></i>&nbsp;&nbsp; Home</a></li>
						    <li><a class="dropdown-item" href="../user/profile.php?user=<?php echo $_SESSION['username']; ?>"><i class="bi bi-person-fill"></i>&nbsp;&nbsp; Profile</a></li>
						    <li><a class="dropdown-item" href="../user/logout.php"><i class="bi bi-box-arrow-right"></i>&nbsp;&nbsp; Logout</a></li>
						</ul>
					</div>
					<button class="btn btn-light btn-nav" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="bi bi-trophy-fill"></i></button>
			    </ul>
		    </div>
		</div>
	</nav>
	<div class="container">
		<div class="row">
			<div class="col-lg-4 order-lg-1 order-md-2">
				<div class="side-nav">
					<div class="side-progress">
						<h5>Progress Kelas</h5>
						<div class="progress" style="height: 30px; margin-top: 10px;">
							<div class="progress-bar <?php echo $progressBg; ?> progress-bar-striped" role="progressbar" aria-label="Example with label" style="width: <?php echo $progress . "%"; ?>; aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $progress . "%"; ?></div>
						</div>
						<div class="element-game">
							<span><i class="bi bi-capslock-fill"></i> Level <?php echo $r['level']; ?> &nbsp;&nbsp;</span>
							<span><i class="bi bi-star-fill"></i> <span id="xpUser"><?php echo $r['xp']; ?> XP</span> &nbsp;&nbsp;</span>
							<span><i class="bi bi-diamond-fill"></i> <span id="pointsUser"><?php echo $r['point']; ?> Points</span></span>
						</div>
						<span style="display:block;clear:both;"></span>
						<hr>
						<a href="../user/course.php" class="btn btn-info-class">Kembali ke Corridor</a>
						<a href="../user/home.php"  class="btn btn-info-class mt-15">Kembali ke Home</a>
					</div>
					<div class="side-modules">
						<h5>Daftar Modul</h5>
						<hr>
						<div class="module-lists bg-light">
							<div class="accordion accordion-flush" id="accordionFlushExample">
								<div class="accordion-item">
								    <h2 class="accordion-header" id="flush-headingOne">
								      	<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
										  <b>Level 1: Diagram Alir (Flowchart)</b>
								      	</button>
								    </h2>
								    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
								      	<div class="accordion-body">
								      		<ul class="list-group list-group-flush">
											  <li class="list-group-item">
													<div style="width: 100%;">
														<div class="check-side ">
															<span
																class="checklist <?php if($currCourse>1) echo 'check'; ?>"><?php if($currCourse>1) echo '&#10003;'; ?></span>
														</div>
														<div class="material-name" data-course="1"
															data-curr="<?php echo $currCourse ?>">
															<a>Pengenalan Flowchart</a>
															<div class="get-item">
																<span><i class="bi bi-diamond-fill"></i> +0
																	&nbsp;&nbsp;</span>
																<span><i class="bi bi-star-fill"></i> +100</span>
															</div>
														</div>
														<div class="user-footprint" id="userFootprintC1"
															data-course="1">
															<img class="user-img-footprint" id='userImgFootprintC1'>
															<span class="user-total" id="totalUserC1"></span>
														</div>
													</div>
												</li>
												<li class="list-group-item">
													<div style="width: 100%;">
														<div class="check-side ">
															<span
																class="checklist <?php if($currCourse>2) echo 'check'; ?>"><?php if($currCourse>2) echo '&#10003;'; ?></span>
														</div>
														<div class="material-name" data-course="2"
															data-curr="<?php echo $currCourse ?>">
															<a>Simbol dan Notasi Flowchart</a>
															<div class="get-item">
																<span><i class="bi bi-diamond-fill"></i> +0
																	&nbsp;&nbsp;</span>
																<span><i class="bi bi-star-fill"></i> +100</span>
															</div>
														</div>
														<div class="user-footprint" id="userFootprintC2"
															data-course="2">
															<img class="user-img-footprint" id='userImgFootprintC2'>
															<span class="user-total" id="totalUserC2"></span>
														</div>
													</div>
												</li>
												<li class="list-group-item">
													<div style="width: 100%;">
														<div class="check-side">
															<span
																class="checklist <?php if($currCourse>3) echo 'check'; ?>"><?php if($currCourse>3) echo '&#10003;'; ?></span>
														</div>
														<div class="material-name" data-course="3"
															data-curr="<?php echo $currCourse ?>">
															<a>Pemahaman Alur Flowchart</a>
															<div class="get-item">
																<span><i class="bi bi-diamond-fill"></i> +0
																	&nbsp;&nbsp;</span>
																<span><i class="bi bi-star-fill"></i> +100</span>
															</div>
														</div>
														<div class="user-footprint" id="userFootprintC3"
															data-course="3">
															<img class="user-img-footprint" id='userImgFootprintC3'>
															<span class="user-total" id="totalUserC3"></span>
														</div>
													</div>
												</li>
												<li class="list-group-item">
													<div style="width: 100%;">
														<div class="check-side ">
															<span
																class="checklist <?php if($currCourse>4) echo 'check'; ?>"><?php if($currCourse>4) echo '&#10003;'; ?></span>
														</div>
														<div class="material-name" data-course="4"
															data-curr="<?php echo $currCourse ?>">
															<a>Teknik membuat Flowchart</a>
															<div class="get-item">
																<span><i class="bi bi-diamond-fill"></i> +0
																	&nbsp;&nbsp;</span>
																<span><i class="bi bi-star-fill"></i> +100</span>
															</div>
														</div>
														<div class="user-footprint" id="userFootprintC4"
															data-course="4">
															<img class="user-img-footprint" id='userImgFootprintC4'>
															<span class="user-total" id="totalUserC4"></span>
														</div>
													</div>
												</li>
												<li class="list-group-item " id="current-li">
													<div style="width: 100%;">
														<div class="check-side ">
															<span
																class="checklist <?php if($currCourse>5) echo 'check'; ?>"><?php if($currCourse>5) echo '&#10003;'; ?></span>
														</div>
														<div class="material-name" data-course="5"
															data-curr="<?php echo $currCourse ?>">
															<a>Quiz Singkat</a>
															<div class="get-item">
																<span><i class="bi bi-diamond-fill"></i> Up to +25
																	&nbsp;&nbsp;</span>
																<span><i class="bi bi-star-fill"></i> Up to +500</span>
															</div>
														</div>
														<div class="user-footprint" id="userFootprintC5"
															data-course="5">
															<img class="user-img-footprint" id='userImgFootprintC5'>
															<span class="user-total" id="totalUserC5"></span>
														</div>
													</div>
												</li>
												<li class="list-group-item">
													<div style="width: 100%;">
														<div class="check-side ">
															<span
																class="checklist <?php if($currCourse>6) echo 'check'; ?>"><?php if($currCourse>6) echo '&#10003;'; ?></span>
														</div>
														<div class="material-name" data-course="6"
															data-curr="<?php echo $currCourse ?>">
															<a>Challenge: Studi Kasus</a>
															<div class="get-item">
																<span><i class="bi bi-diamond-fill"></i> +30
																	&nbsp;&nbsp;</span>
																<span><i class="bi bi-star-fill"></i> +300 &nbsp;&nbsp;</span>
                                                                <span<i class="bi bi-award-fill"></i> 1</span>
															</div>
														</div>
														<div class="user-footprint" id="userFootprintC6"
															data-course="6">
															<img class="user-img-footprint" id='userImgFootprintC6'>
															<span class="user-total" id="totalUserC6"></span>
														</div>
													</div>
												</li>
											</ul>
								      	</div>
								    </div>
								</div>
								<div class="accordion-item">
								    <h2 class="accordion-header" id="flush-headingTwo">
									    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
									        Lorem ipsum dolor sit amet
									    </button>
								    </h2>
									    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
									    	<div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the second item's accordion body. Let's imagine this being filled with some actual content.</div>
									    </div>
								</div>
								<div class="accordion-item">
								    <h2 class="accordion-header" id="flush-headingThree">
								      	<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
								       		Lorem ipsum dolor sit amet
								      	</button>
								    </h2>
								    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
								      	<div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion body. Nothing more exciting happening here in terms of content, but just filling up the space to make it look, at least at first glance, a bit more representative of how this would look in a real-world application.</div>
								    </div>
								</div>
								<div class="accordion-item">
								    <h2 class="accordion-header" id="flush-headingFour">
								      	<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
								       		Lorem ipsum dolor sit amet
								      	</button>
								    </h2>
								    <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
								      	<div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion body. Nothing more exciting happening here in terms of content, but just filling up the space to make it look, at least at first glance, a bit more representative of how this would look in a real-world application.</div>
								    </div>
								</div>
								<div class="accordion-item">
								    <h2 class="accordion-header" id="flush-headingFive">
								      	<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
								       		Lorem ipsum dolor sit amet
								      	</button>
								    </h2>
								    <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
								      	<div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion body. Nothing more exciting happening here in terms of content, but just filling up the space to make it look, at least at first glance, a bit more representative of how this would look in a real-world application.</div>
								    </div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-8 side-right order-lg-2 corder-md-1">
				<div class="right-content">
				<h1>Quiz Singkat</h1>
					<?php 
						$sql = "SELECT * FROM tb_quiz WHERE id_user='$idUser'";
						$res = mysqli_query($con, $sql);
						$amount = mysqli_num_rows($res);
						if($amount==0){
					?>
					<div class="quiz-box">
						<div class="pop-up">
								<h5>Benar!</h5>
								<span class="icon-eval"><i class="bi bi-check-circle"></i></span>
								<div class="point-xp">
									<span><i class="bi bi-star-fill"></i> XP : +<span id="add-xp" style="display:inline-block"></span> &nbsp;&nbsp;</span>
									<span><i class="bi bi-diamond-fill"></i> Points : +<span id="add-points" style="display:inline-block"></span></span>
								</div>
						</div>
						<div id="carouselExampleControlsNoTouching" class="carousel slide" data-bs-touch="false">
							<div class="carousel-inner">
								<div class="carousel-item active">
									<h6>Mengenai Quiz:</h6>
									<ol>
										<li>Setiap soal akan diberikan waktu yang telah ditentukan untuk menjawab soal tersebut.</li>
										<li>Setiap soal yang dijawab dengan benar, peserta didik akan mendapatkan xp dengan jumlah sesuai kecepatan anda menjawab soal dan 5 coin per soal yang benar.</li>
										<li>Setelah quiz selesai, peserta didik akan melihat peringkat pada quiz ini dari jumlah xp tertinggi sampai terendah.</li>
									</ol>
									<center><button class="btn-quiz" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next" onclick="startTimer(1,20);">Mulai Quiz</button></center>
								</div>
								<div class="carousel-item">
									<div class="auto-refresher" id="auto-refresher1"></div>
									<span class="timer">Time Remaining: <span id="auto-refresher-time-remaining1"></span></span>
									<p>Tujuan utama penggunaan flowchart dalam analisis proses atau algoritma adalah...</p>
									<div class="pilgan-wrapper">
										<div class="pilgan-box" onclick="choose(this);" data-id="1" id="pilgan11">Mengoptimalkan kecepatan komputasi</div>
										<div class="pilgan-box" onclick="choose(this);" data-id="2" id="pilgan12">Menyediakan dokumentasi visual yang mudah dipahami</div>
										<div class="pilgan-box" onclick="choose(this);" data-id="3" id="pilgan13">Meningkatkan keamanan data</div>
										<div class="pilgan-box" onclick="choose(this);" data-id="4" id="pilgan14">Memvisualisasikan data statistik</div>
										<div class="pilgan-box" onclick="choose(this);" data-id="5" id="pilgan15">Menghubungkan perangkat keras dan perangkat lunak</div>
									</div>
									<div class="point-xp">
										<span><i class="bi bi-star-fill"></i> XP : <span id="total-xp1"></span> &nbsp;&nbsp;</span>
										<span><i class="bi bi-diamond-fill"></i> Points : <span id="total-points1"></span></span>
									</div>
									<button class="btn-quiz next" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next" onclick="startTimer(2,20);" id="nextSoal1">Next</button>
									<button class="btn-quiz evaluasi" type="button"  onclick="evaluasi(1,20,false);" id="btnEval1">Evaluasi</button>
								</div>
								<div class="carousel-item">
									<div class="auto-refresher" id="auto-refresher2"></div>
									<span class="timer">Time Remaining: <span id="auto-refresher-time-remaining2"></span></span>
									<p>Perbedaan antara flowchart vertikal dan flowchart horizontal terletak pada...</p>
									<div class="pilgan-wrapper">
										<div class="pilgan-box" onclick="choose(this);" data-id="1" id="pilgan21">Bentuk simbol yang digunakan</div>
										<div class="pilgan-box" onclick="choose(this);" data-id="2" id="pilgan22">Urutan langkah-langkah dalam algoritma</div>
										<div class="pilgan-box" onclick="choose(this);" data-id="3" id="pilgan23">Jenis perangkat keras yang digunakan</div>
										<div class="pilgan-box" onclick="choose(this);" data-id="4" id="pilgan24">Cara penyusunan elemen-elemen flowchart</div>
										<div class="pilgan-box" onclick="choose(this);" data-id="5" id="pilgan25">Kecepatan pemrosesan data</div>
									</div>
									<div class="point-xp">
										<span><i class="bi bi-star-fill"></i> XP : <span id="total-xp2"></span> &nbsp;&nbsp;</span>
										<span><i class="bi bi-diamond-fill"></i> Points : <span id="total-points2"></span></span>
									</div>
									<button class="btn-quiz next" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next" onclick="startTimer(3,20);" id="nextSoal2">Next</button>
									<button class="btn-quiz evaluasi" type="button"  onclick="evaluasi(2,20,false);" id="btnEval2">Evaluasi</button>
								</div>
								<div class="carousel-item">
									<div class="auto-refresher" id="auto-refresher3"></div>
									<span class="timer">Time Remaining: <span id="auto-refresher-time-remaining3"></span></span>
									<p>Simbol umum yang sering digunakan dalam flowchart termasuk...</p>
									<div class="pilgan-wrapper">
										<div class="pilgan-box" onclick="choose(this);" data-id="1" id="pilgan31">Segitiga, kotak, dan panah</div>
										<div class="pilgan-box" onclick="choose(this);" data-id="2" id="pilgan32">Lingkaran, garis, dan persegi panjang</div>
										<div class="pilgan-box" onclick="choose(this);" data-id="3" id="pilgan33">Kubus, segitiga, dan elips</div>
										<div class="pilgan-box" onclick="choose(this);" data-id="4" id="pilgan34">Silinder, hexagon, dan panah</div>
										<div class="pilgan-box" onclick="choose(this);" data-id="5" id="pilgan35">Kotak, silinder, dan elips</div>
									</div>
									<div class="point-xp">
										<span><i class="bi bi-star-fill"></i> XP : <span id="total-xp3"></span> &nbsp;&nbsp;</span>
										<span><i class="bi bi-diamond-fill"></i> Points : <span id="total-points3"></span></span>
									</div>
									<button class="btn-quiz next" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next" onclick="startTimer(4,20);" id="nextSoal3">Next</button>
									<button class="btn-quiz evaluasi" type="button"  onclick="evaluasi(3,20,false);" id="btnEval3">Evaluasi</button>
								</div>
								<div class="carousel-item">
									<div class="auto-refresher" id="auto-refresher4"></div>
									<span class="timer">Time Remaining: <span id="auto-refresher-time-remaining4"></span></span>
									<p>Pengendalian alur dalam flowchart mengacu pada...</p>
									<div class="pilgan-wrapper">
										<div class="pilgan-box" onclick="choose(this);" data-id="1" id="pilgan41">Pengaturan tingkat kecepatan pemrosesan</div>
										<div class="pilgan-box" onclick="choose(this);" data-id="2" id="pilgan42">Mengatur arus listrik dalam sistem komputer</div>
										<div class="pilgan-box" onclick="choose(this);" data-id="3" id="pilgan43">Penggunaan simbol khusus dalam algoritma</div>
										<div class="pilgan-box" onclick="choose(this);" data-id="4" id="pilgan44">Memantau kinerja sistem secara real-time</div>
										<div class="pilgan-box" onclick="choose(this);" data-id="5" id="pilgan45">Mengatur urutan eksekusi instruksi dalam algoritma</div>
									</div>
									<div class="point-xp">
										<span><i class="bi bi-star-fill"></i> XP : <span id="total-xp4"></span> &nbsp;&nbsp;</span>
										<span><i class="bi bi-diamond-fill"></i> Points : <span id="total-points4"></span></span>
									</div>
									<button class="btn-quiz next" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next" onclick="startTimer(5,20);" id="nextSoal4">Next</button>
									<button class="btn-quiz evaluasi" type="button"  onclick="evaluasi(4,20,false);" id="btnEval4">Evaluasi</button>
								</div>
								<div class="carousel-item">
									<div class="auto-refresher" id="auto-refresher5"></div>
									<span class="timer">Time Remaining: <span id="auto-refresher-time-remaining5"></span></span>
									<p>Flowchart sering digunakan dalam bidang...</p>
									<div class="pilgan-wrapper">
										<div class="pilgan-box" onclick="choose(this);" data-id="1" id="pilgan51">Seni dan desain</div>
										<div class="pilgan-box" onclick="choose(this);" data-id="2" id="pilgan52">Musik dan hiburan</div>
										<div class="pilgan-box" onclick="choose(this);" data-id="3" id="pilgan53">Ilmu pengetahuan dan teknologi</div>
										<div class="pilgan-box" onclick="choose(this);" data-id="4" id="pilgan54">Bisnis dan pemasaran</div>
										<div class="pilgan-box" onclick="choose(this);" data-id="5" id="pilgan55">Olahraga dan kebugaran</div>
									</div>
									<div class="point-xp">
										<span><i class="bi bi-star-fill"></i> XP : <span id="total-xp5"></span> &nbsp;&nbsp;</span>
										<span><i class="bi bi-diamond-fill"></i> Points : <span id="total-points5"></span></span>
									</div>
									<button class="btn-quiz next" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next"  onclick="result(5,<?php echo $idUser; ?>);"id="nextSoal5">Result</button>
									<button class="btn-quiz evaluasi" type="button"  onclick="evaluasi(5,20,false);" id="btnEval5">Evaluasi</button>
								</div>
								<div class="carousel-item">
									<div class="container">
										<div class="row">
											<div class="col-lg-7">
												<h4>Rankings</h4>
												<table class="table" style="color:white;">
													<thead>
														<tr>
														<th scope="col">#</th>
														<th scope="col">Nama</th>
														<th scope="col">XP</th>
														<th scope="col">Points</th>
														</tr>
													</thead>
													<tbody id="rank-table">
													</tbody>
												</table>
											</div>
											<div class="col-lg-5">
												<h4>Result</h4>
												<hr>
												<table style="width:100%;">
													<tr>
														<th style="width:60%;">Jumlah Benar&nbsp;&nbsp;&nbsp;</th>
														<td id="jmlBnr"> </td>
													</tr>
													<tr>
														<th style="width:60%;">Jumlah Salah</th>
														<td id="jmlSlh"> </td>
													</tr>
													<tr>
														<th style="width:60%;">Total XP</th>
														<td id="totalResXP"> </td>
													</tr>
													<tr>
														<th style="width:60%;">Total Point</th>
														<td id="totalResPoints"> </td>
													</tr>
													<tr>
														<th style="width:60%;">Nilai</th>
														<td id="totalNilai"> </td>
													</tr>
													<tr>
														<th style="width:60%;"><br>Grade</th>
														<td>
															<br>
															<div class="grade" id="grade">
																
															</div>
														</td>
													</tr>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php
						}
						else{
					?>
					<div class="quiz-box">
						<div class="container">
							<div class="row">
								<div class="col-lg-7">
									<h4>Rankings</h4>
									<table class="table" style="color:white;">
										<thead>
											<tr>
											<th scope="col">#</th>
											<th scope="col">Nama</th>
											<th scope="col">XP</th>
											<th scope="col">Points</th>
											</tr>
										</thead>
										<tbody id="rank-table">
										<?php
											$sql = "SELECT a.*, b.name FROM tb_quiz as a LEFT JOIN tb_user as b on a.id_user= b.id ORDER BY a.xp DESC, a.points DESC";
											$res = mysqli_query($con, $sql);
											$i=1;
											while($row =mysqli_fetch_assoc($res))
											{
												echo "
													<tr>
														<th scope='row'>".$i."</th>
														<td>".$row['name']."</td>
														<td>".$row['xp']."</td>
														<td>".$row['points']."</td>
													</tr>
												";
												$i++;
											}
										?>
										</tbody>
									</table>
								</div>
								<div class="col-lg-5">
									<?php
										$sql = "SELECT * FROM tb_quiz WHERE id_user='$idUser'";
										$res = mysqli_query($con, $sql);
										$row=mysqli_fetch_assoc($res);
									?>
									<h4>Result</h4>
									<hr>
									<table style="width:100%;">
										<tr>
											<th style="width:60%;">Jumlah Benar&nbsp;&nbsp;&nbsp;</th>
											<td id="jmlBnr"><?php echo $row['benar']; ?></td>
										</tr>
										<tr>
											<th style="width:60%;">Jumlah Salah</th>
											<td id="jmlSlh"><?php echo $row['salah']; ?> </td>
										</tr>
										<tr>
											<th style="width:60%;">Total XP</th>
											<td id="totalResXP"><?php echo $row['xp']; ?> </td>
										</tr>
										<tr>
											<th style="width:60%;">Total Point</th>
											<td id="totalResPoints"> <?php echo $row['points']; ?></td>
										</tr>
										<tr>
											<th style="width:60%;">Nilai</th>
											<td id="totalNilai"><?php echo $row['nilai']; ?></td>
										</tr>
										<tr>
											<th style="width:60%;"><br>Grade</th>
											<td>
												<br>
												<?php
													$grade = $row['grade'];
													if($grade == 'A' || $grade=='B'){
														echo '<div class="grade" id="grade" style="color:#0cff00; border:2px solid #0cff00">'.$grade.'</div>';
													}else if($grade == 'C'){
														echo '<div class="grade" id="grade" style="color:yellow; border:2px solid yellow">'.$grade.'</div>';
													}else{
														echo '<div class="grade" id="grade" style="color:red; border:2px solid red">'.$grade.'</div>';
													}
												?>
												
											</td>
										</tr>
									</table>
								</div>
							</div>
						</div>
					</div>
					<?php
						}
					?>
					<button class="btn btn-course" id="previous" data-prev="4">Sebelumnya</button>
					<button class="btn btn-course f-right" id="next" data-next="6" data-curr="<?php echo $currCourse ?>" data-reward='0' data-username="<?php echo $_SESSION['username']; ?>">Berikutnya</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
		    <div class="modal-content">
		      	<div class="modal-header">
		        		<h5 class="modal-title" id="exampleModalLabel">Pengguna yang sudah mencapai modul ini</h5>
		        		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		      	</div>
		      	<div class="modal-body">
			    	<table class="table" id="usersOnTheCourse">
						<tbody>
						</tbody>
					</table>
		      	</div>
		    </div>
		</div>
	</div>
	<div class="toast-container position-fixed bottom-0 end-0 p-3">
	  <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
	    <div class="toast-header">
	      <i class="bi bi-code-square"></i>&nbsp;&nbsp;
	      <strong class="me-auto">FunCode</strong>
	      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
	    </div>
	    <div class="toast-body" id="msgToast">
	    </div>
	  </div>
	</div>
	<div class="modal fade" id="exampleModal1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content modal-bg-custom">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="staticBackdropLabel">Naik Level <i class="bi bi-capslock-fill"></i></h1>
					<button type="button" class="btn-close btn-close-levelUp" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body body-levelUp">
					<center><img width="55%" height="auto" src="../images/level-up.gif"/></center>
					<center><h4 class="levelUp-desc"></h4></center>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary btn-close-levelUp" data-bs-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary main-bg-color">Next Course</button>
				</div>
			</div>
		</div>
	</div>
	<div id="tsparticles"></div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tsparticles/2.9.3/tsparticles.min.js" integrity="sha512-+YPbXItNhUCZR3fn5KeWPtJrXuoqRYQ4Gd1rIjEFG+h8UJYekebhOMh84vv7q+Y1sy5kdIIVtfftehCiigriMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/tsparticles-preset-confetti@2/tsparticles.preset.confetti.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.15.2/ace.js" integrity="sha512-NSbvq6xPdfFIa2wwSh8vtsPL7AyYAYRAUWRDCqFH34kYIjQ4M7H2POiULf3CH11TRcq3Ww6FZDdLZ8msYhMxjg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="../js/courses/autorefresher.js"></script>
<script type="text/javascript" src="../js/courses/courses.js"></script>
<script type="text/javascript" src="../js/courses/quiz/quiz1.js"></script>
</html>