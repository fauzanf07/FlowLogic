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
 <!--COURSE 4 -->
<!DOCTYPE html>
<html>
<head>
	<title>Teknik membuat Flowchart</title>
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
						<tbody id="tableRanks">

						</tbody>
					</table>
				<button type="button" class="btn btn-outline-secondary" id="loadRanksMore" onclick="getRanks(true, false);">Load More</button>
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
					<button class="btn btn-light btn-nav" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" onclick="getRanks(false, true);"><i class="bi bi-trophy-fill"></i></button>
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
							<div class="progress-bar <?php echo $progressBg; ?> progress-bar-striped" role="progressbar" aria-label="Example with label" style="width: <?php echo $progress . "%"; ?>;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $progress . "%"; ?></div>
						</div>
						<div class="element-game">
							<span><i class="bi bi-capslock-fill"></i> Level <?php echo $r['level']; ?> &nbsp;&nbsp;</span>
							<span><i class="bi bi-star-fill"></i> <span id="xpUser"><?php echo $r['xp']; ?> XP</span> &nbsp;&nbsp;</span>
							<span><i class="bi bi-diamond-fill"></i> <span id="pointsUser"><?php echo $r['point']; ?></span> Points</span>
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
												<li class="list-group-item" id="current-li">
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
												<li class="list-group-item">
													<div style="width: 100%;">
														<div class="check-side ">
															<span
																class="checklist <?php if($currCourse>5) echo 'check'; ?>"><?php if($currCourse>5) echo '&#10003;'; ?></span>
														</div>
														<div class="material-name" data-course="5"
															data-curr="<?php echo $currCourse ?>">
															<a>Challenge: Studi Kasus</a>
															<div class="get-item">
																<span><i class="bi bi-diamond-fill"></i> Up to +300
																	&nbsp;&nbsp;</span>
																<span><i class="bi bi-star-fill"></i> +300 &nbsp;&nbsp;</span>
                                                                <span<i class="bi bi-award-fill"></i> 1</span>
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
															<a>Quiz Singkat</a>
															<div class="get-item">
																<span><i class="bi bi-diamond-fill"></i> Up to +25
																	&nbsp;&nbsp;</span>
																<span><i class="bi bi-star-fill"></i> Up to +500</span>
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
									        <b>Level 2: Pseudocode</b>
									    </button>
								    </h2>
									    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
									    	<div class="accordion-body">
												<ul class="list-group list-group-flush">
													<li class="list-group-item">
														<div style="width: 100%;">
															<div class="check-side ">
																<span
																	class="checklist <?php if($currCourse>7) echo 'check'; ?>"><?php if($currCourse>7) echo '&#10003;'; ?></span>
															</div>
															<div class="material-name" data-course="7"
																data-curr="<?php echo $currCourse ?>">
																<a>Pengenalan Pseudocode</a>
																<div class="get-item">
																	<span><i class="bi bi-diamond-fill"></i> +0
																		&nbsp;&nbsp;</span>
																	<span><i class="bi bi-star-fill"></i> +100</span>
																</div>
															</div>
															<div class="user-footprint" id="userFootprintC7"
																data-course="7">
																<img class="user-img-footprint" id='userImgFootprintC7'>
																<span class="user-total" id="totalUserC7"></span>
															</div>
														</div>
													</li>  
													<li class="list-group-item">
														<div style="width: 100%;">
															<div class="check-side ">
																<span
																	class="checklist <?php if($currCourse>8) echo 'check'; ?>"><?php if($currCourse>8) echo '&#10003;'; ?></span>
															</div>
															<div class="material-name" data-course="8"
																data-curr="<?php echo $currCourse ?>">
																<a>Struktur Pseudocode</a>
																<div class="get-item">
																	<span><i class="bi bi-diamond-fill"></i> +0
																		&nbsp;&nbsp;</span>
																	<span><i class="bi bi-star-fill"></i> +100</span>
																</div>
															</div>
															<div class="user-footprint" id="userFootprintC8"
																data-course="8">
																<img class="user-img-footprint" id='userImgFootprintC8'>
																<span class="user-total" id="totalUserC8"></span>
															</div>
														</div>
													</li>
													<li class="list-group-item">
														<div style="width: 100%;">
															<div class="check-side ">
																<span
																	class="checklist <?php if($currCourse>9) echo 'check'; ?>"><?php if($currCourse>9) echo '&#10003;'; ?></span>
															</div>
															<div class="material-name" data-course="9"
																data-curr="<?php echo $currCourse ?>">
																<a>Notasi Algoritmik</a>
																<div class="get-item">
																	<span><i class="bi bi-diamond-fill"></i> +0
																		&nbsp;&nbsp;</span>
																	<span><i class="bi bi-star-fill"></i> +100</span>
																</div>
															</div>
															<div class="user-footprint" id="userFootprintC9"
																data-course="9">
																<img class="user-img-footprint" id='userImgFootprintC9'>
																<span class="user-total" id="totalUserC9"></span>
															</div>
														</div>
													</li> 
													<li class="list-group-item">
														<div style="width: 100%;">
															<div class="check-side ">
																<span
																	class="checklist <?php if($currCourse>10) echo 'check'; ?>"><?php if($currCourse>10) echo '&#10003;'; ?></span>
															</div>
															<div class="material-name" data-course="10"
																data-curr="<?php echo $currCourse ?>">
																<a>Cara menulis Pseudocode</a>
																<div class="get-item">
																	<span><i class="bi bi-diamond-fill"></i> +0
																		&nbsp;&nbsp;</span>
																	<span><i class="bi bi-star-fill"></i> +100</span>
																</div>
															</div>
															<div class="user-footprint" id="userFootprintC10"
																data-course="10">
																<img class="user-img-footprint" id='userImgFootprintC10'>
																<span class="user-total" id="totalUserC10"></span>
															</div>
														</div>
													</li>     
												</ul>
											</div>
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
					<p>Setelah Anda mempelajari dengan baik tentang pemahaman alur flowchart, saatnya menggali lebih dalam dengan mempelajari teknik penggambaran flowchart. Dalam artikel ini, kita akan membahas bagaimana cara menggambar atau merancang flowchart dengan benar. Dengan memahami teknik penggambaran ini, kalian akan memiliki keterampilan yang kuat dalam merepresentasikan langkah-langkah proses dengan jelas dan terstruktur. Mari kita mulai petualangan baru ini dalam menguasai teknik penggambaran flowchart yang akan membuka pintu menuju pemahaman yang lebih mendalam tentang dunia flowchart!</p>
					<p>Sebelum kita memelajari teknik penggambaran flowchart, alangkah baiknya kita mengenal software untuk membuat flowchart itu sendiri. Sebenarnya flowchart juga dapat digambar di kertas, tetapi akan lebih mudah jika kita menggunakan software pembuat flowchart berikut ini.</p>
					<ol>
						<h5><li>Microsoft Visio</li></h5>
						<center><img src="../images/visio.png" alt="" width="30%" height="auto"></center>
						<p>Visio merupakan salah satu platform yang paling umum digunakan untuk membuat flowchart dan diagram. Ini menyediakan beragam bentuk dan simbol yang dapat digunakan untuk menggambarkan alur proses dengan mudah.</p>
						<h5><li>Lucidchart</li></h5>
						<center><img src="../images/lucidchart.png" alt="" width="30%" height="auto"></center>
						<p>Lucidchart adalah platform berbasis web yang memungkinkan Anda membuat flowchart secara online. Ini memiliki antarmuka yang intuitif dan menyediakan berbagai pilihan bentuk, simbol, dan template untuk membuat flowchart yang menarik. Klik <a href="https://www.lucidchart.com/" target="blank">disini</a> untuk ke Lucidchart</p>
						<h5><li>Draw.io atau Diagrams.net</li></h5>
						<center><img src="../images/diagrams-logo.png" alt="" width="25%" height="auto"></center>
						<p>Draw.io atau Diagrams.net adalah platform diagram online yang dapat digunakan untuk membuat flowchart, diagram alur kerja, dan banyak jenis diagram lainnya. Ini menyediakan beragam pilihan bentuk, simbol, dan opsi kustomisasi. Klik <a href="https://draw.io/" target="blank">disini</a> untuk ke Diagrams.net</p>
						<h5><li>Gliffy</li></h5>
						<center><img src="../images/gliffy.png" alt="" width="30%" height="auto"></center>
						<p>Gliffy adalah platform lain yang memungkinkan Anda membuat flowchart dengan mudah. Ini menyediakan antarmuka yang sederhana dan intuitif, serta pilihan simbol dan bentuk yang lengkap.</p>
						<h5><li>Google Drawings</li></h5>
						<center><img src="../images/google-drawing.jpg" alt="" width="30%" height="auto"></center>
						<p>Google Drawings merupakan alat yang terintegrasi dengan Google Drive. Ini menyediakan fitur dasar untuk membuat flowchart dan diagram dengan mudah dan berbagi dengan kolaborator.</p>
					</ol>
					<p>Selain itu, ada juga perangkat lunak diagram lainnya seperti Dia, OmniGraffle, dan SmartDraw yang dapat digunakan untuk membuat flowchart. Pilihan platform tergantung pada preferensi pribadi dan kebutuhan kalian dalam membuat dan berbagi flowchart.</p>

					<h5>Teknik Membuat Flowchart</h5>
					<p>Sebelum membuat flowchart langkah pertama yang harus kamu lakukan ialah melakukan langkah-langkah satu persatu penyelesaian permasalahan akan dijadikan flowchart. Misalkan kita akan membuat flowchart dengan permasalahan menentukan bilangan positif, negatif, dan 0. Berikut langkah-langkah untuk menyelesaikan permasalah tersebut.</p>
					<ol>
						<li>Mulai</li>
						<li>Persiapkan bilangan</li>	
						<li>Masukkan bilangan</li>
						<li>Jika bilangan lebih dari 0, maka tampilkan "Bilangan Positif" lalu selesai. Jika tidak, maka lanjutkan ke langkah selanjutnya</li>
						<li>Jika bilangan lebih dari 0, maka tampilkan "Bilangan Negatif" lalu selesai. Jika tidak, maka lanjutkan ke langkah selanjutnya</li>
						<li>Jika bilangan sama dengan 0, maka tampilkan "Bilangan Nol" lalu selesai. Jika tidak, maka lanjutkan ke langkah selanjutnya</li>
						<li>Selesai</li>
					</ol>
					<p>Langkah berikutnya yakni menganalisis setiap langkah dan menginterpretasikannya kedalam simbol flowchart yang sesuai. Mari kita analisis dan interpretasikan langkah-langkah pada permasalahan sebelumnya ke dalam simbol flowchart. </p>
					<ol>
						<li>Langkah pertama dapat kita interpretasikan ke dalam simbol terminator karena terminator digunakan untuk mengawali atau mengakhiri program. Maka hasilnya akan seperti dibawah ini.
							<br><img src="../images/simbol/langkah-1.png" alt="">
						</li><br>
						<li>Langkah kedua simbol flowchart yang sesuai dengan langkah tersebut ialah simbol preparation karena bilangan ini menjadi wadah penyimpan yang akan digunakan untuk menyimpan angka tersebut. Kita tentukan bilangan tersebut berbentuk bilangan bulat maka hasilnya akan seperti berikut.
							<br><img src="../images/simbol/langkah-2.png" alt="">
						</li><br>
						<li>
							Selanjutnya simbol flowchart yang sesuai dengan langkah ketiga ialah simbol input karena kita harus menginputkan atau memasukan sebuah bilangan. Maka hasilnya akan seperti ini
							<br><img src="../images/simbol/langkah-3.png" alt="">
						</li><br>
						<li>
							Berikutnya pada langkah ke 4 ini terdapat dua simbol yakni simbol decision dan simbol output. Simbol decision untuk menentukan kondisi apakah bilangan lebih dari nol. Sedangkan simbol output digunakan untuk menampilkan teks berupa "Bilangan Positif". Hasilnya akan seperti berikut.
							<br><img src="../images/simbol/langkah-4.png" alt="">
						</li><br>
						<li>
							Pada langkah ke 5 ini sama seperti langkah ke 4 terdapat dua simbol yakni simbol decision dan simbol output. Hasilnya akan seperti berikut.
							<br><img src="../images/simbol/langkah-5.png" alt="">
						</li><br>
						<li>
							Pada langkah ke 6 ini sama seperti langkah ke 4 dan 5 maka hasilnya akan seperti berikut.
							<br><img src="../images/simbol/langkah-6.png" alt="">
						</li><br>
						<li>
							Dan langkah yang terakhir kita menggunakan simbol terminator yang mana untuk mengakhiri program.
							<br><img src="../images/simbol/langkah-7.png" alt="">
						</li><br>
					</ol>
					<p>Setelah menganalisis setiap langkah dan menginterpretasikannya kedalam simbol flowchart yang sesuai, selanjutnya susun simbol-simbol tersebut dan beri alur flowchart menggunakan panah sesuai alur pada langkah-langkah yang kita buat. Maka hasil flowchart dari permasalahan tersebut akan jadi seperti ini.</p>
					<center><img src="../images/simbol/result-flowchart.png" width="30%" height="auto" alt=""></center>
					<button class="btn btn-course" id="previous" data-prev="3">Sebelumnya</button>
					<button class="btn btn-course f-right" id="next" data-next="5" data-curr="<?php echo $currCourse ?>" data-reward='0' data-username="<?php echo $_SESSION['username']; ?>" data-user="<?php echo $idUser; ?>" data-materi="Teknik Membuat Flowchart" data-artikel="1">Berikutnya</button>
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
<script type="text/javascript" src="../js/courses/courses.js"></script>
</html>