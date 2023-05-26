<?php 	
	session_start();
	include('../db.php');
	if(!isset($_SESSION['name'])){
		header("Location: http://localhost/skripsi/");
	}else{
		$username = $_SESSION['username'];
		$query = "SELECT * FROM tb_user WHERE username='$username'";
		$hasil = mysqli_query($con, $query);
		$r = mysqli_fetch_assoc($hasil);

		$currCourse = $_SESSION['curr_course'];
		$progress = intval(($_SESSION['curr_course']/5)*100);
		$progressBg = "";
		if($progress<=30){
			$progressBg = "bg-danger";
		}else if($progress<=60){
			$progressBg = "bg-warning";
		}else{
			$progressBg = "bg-success";
		}
	}
 ?>
 <!--COURSE 1 -->
<!DOCTYPE html>
<html>
<head>
	<title>Course 1</title>
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
											  	<li class="list-group-item" id="current-li">
											  		<div style="width: 100%;">
											  			<div class="check-side ">
											  				<span class="checklist <?php if($currCourse>1) echo 'check'; ?>"><?php if($currCourse>1) echo '&#10003;'; ?></span>
											  			</div>
											  			<div class="material-name" data-course="1" data-curr="<?php echo $currCourse ?>">
											  				<a>Pengenalan Flowchart</a>
															<div class="get-item">
																<span><i class="bi bi-diamond-fill"></i> +0 &nbsp;&nbsp;</span>
																<span><i class="bi bi-star-fill"></i> +100</span>
															</div>
											  			</div>
											  			<div class="user-footprint" id="userFootprintC1" data-course="1">
											  				<img class="user-img-footprint" id='userImgFootprintC1'>
											  				<span class="user-total" id="totalUserC1"></span>
											  			</div>
											  		</div>
												</li>
											  <li class="list-group-item">
											  		<div style="width: 100%;">
											  			<div class="check-side ">
											  				<span class="checklist <?php if($currCourse>2) echo 'check'; ?>"><?php if($currCourse>2) echo '&#10003;'; ?></span>
											  			</div>
											  			<div class="material-name" data-course="2" data-curr="<?php echo $currCourse ?>">
											  				<a>Simbol dan Notasi Flowchart</a>
															<div class="get-item">
																<span><i class="bi bi-diamond-fill"></i> +0 &nbsp;&nbsp;</span>
																<span><i class="bi bi-star-fill"></i> +100</span>
															</div>
											  			</div>
											  			<div class="user-footprint" id="userFootprintC2" data-course="2">
											  				<img  class="user-img-footprint" id='userImgFootprintC2'>
											  				<span class="user-total" id="totalUserC2"></span>
											  			</div>
											  		</div>
											  </li>
											  <li class="list-group-item">
											  		<div style="width: 100%;">
											  			<div class="check-side">
											  				<span class="checklist <?php if($currCourse>3) echo 'check'; ?>"><?php if($currCourse>3) echo '&#10003;'; ?></span>
											  			</div>
											  			<div class="material-name" data-course="3" data-curr="<?php echo $currCourse ?>">
											  				<a>Pemahaman Alur Flowchart</a>
															<div class="get-item">
																<span><i class="bi bi-diamond-fill"></i> +0 &nbsp;&nbsp;</span>
																<span><i class="bi bi-star-fill"></i> +100</span>
															</div>
											  			</div>
											  			<div class="user-footprint" id="userFootprintC3" data-course="3">
											  				<img  class="user-img-footprint" id='userImgFootprintC3'>
											  				<span class="user-total" id="totalUserC3"></span>
											  			</div>
											  		</div>
											  </li>
											  <li class="list-group-item">
											  		<div style="width: 100%;">
											  			<div class="check-side ">
											  				<span class="checklist <?php if($currCourse>4) echo 'check'; ?>"><?php if($currCourse>4) echo '&#10003;'; ?></span>
											  			</div>
											  			<div class="material-name" data-course="4" data-curr="<?php echo $currCourse ?>">
											  				<a>Teknik membuat Flowchart</a>
															<div class="get-item">
																<span><i class="bi bi-diamond-fill"></i> +0 &nbsp;&nbsp;</span>
																<span><i class="bi bi-star-fill"></i> +100</span>
															</div>
											  			</div>
											  			<div class="user-footprint" id="userFootprintC4" data-course="4">
											  				<img  class="user-img-footprint" id='userImgFootprintC4'>
											  				<span class="user-total" id="totalUserC4"></span>
											  			</div>
											  		</div>
											  </li>
											  <li class="list-group-item">
											  		<div style="width: 100%;">
											  			<div class="check-side ">
											  				<span class="checklist <?php if($currCourse>5) echo 'check'; ?>"><?php if($currCourse>5) echo '&#10003;'; ?></span>
											  			</div>
											  			<div class="material-name" data-course="5" data-curr="<?php echo $currCourse ?>">
											  				<a>Quiz Singkat</a>
															<div class="get-item">
																<span><i class="bi bi-diamond-fill"></i> Up to +25 &nbsp;&nbsp;</span>
																<span><i class="bi bi-star-fill"></i> Up to +500</span>
															</div>
											  			</div>
											  			<div class="user-footprint" id="userFootprintC5" data-course="5">
											  				<img  class="user-img-footprint" id='userImgFootprintC5'>
											  				<span class="user-total" id="totalUserC5"></span>
											  			</div>
											  		</div>
											  </li>
											  <li class="list-group-item">
											  		<div style="width: 100%;">
											  			<div class="check-side ">
											  				<span class="checklist <?php if($currCourse>6) echo 'check'; ?>"><?php if($currCourse>6) echo '&#10003;'; ?></span>
											  			</div>
											  			<div class="material-name" data-course="6" data-curr="<?php echo $currCourse ?>">
											  				<a>Challenge: Studi Kasus</a>
															<div class="get-item">
																<span><i class="bi bi-diamond-fill"></i> +30 &nbsp;&nbsp;</span>
																<span><i class="bi bi-star-fill"></i> +300</span>
															</div>
											  			</div>
											  			<div class="user-footprint" id="userFootprintC5" data-course="5">
											  				<img  class="user-img-footprint" id='userImgFootprintC5'>
											  				<span class="user-total" id="totalUserC5"></span>
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
					<p>Mungkin bagi seseorang yang berkecimpung dalam bidang algoritma dan pemrograman tidaklah asing mengenai diagram alir atau sering disebut juga Flowchart dan mungkin dari beberapa kalangan awam masih belum memahami apa itu flowchart. Flowchart ini cukup penting untuk digunakan sebelum kita membuat sebuah program di komputer, terlepas dari bahasa pemrograman apapun yang digunakan. Untuk mengetahui lebih lanjut mengenai flowchart, mari kita simak bahasan berikut ini!</p>
					<h4>Apa itu flowchart?</h4><br>
					<center><img src="../images/ilustrasi-flowchart.jpg" alt="Ilustrasi Flowchart" height="auto" width="60%"></center>
					<br><p>Flowchart atau sering disebut juga Diagram Alir merupakan sebuah diagram yang merepresentasikan algoritma atau langkah-langkah dan keputusan melakukan sebuah proses dari suatu program. </p>

					<p>Pada prinsipnya, flowchart digambarkan menggunakan simbol-simbol yang mewakili berbagai proses. Setiap simbol melambangkan suatu proses khusus. Sedangkan untuk menghubungkan satu proses dengan proses berikutnya, digunakan garis penghubung.</p>

					<p>Dengan menggunakan flowchart, setiap langkah dalam proses dapat diilustrasikan secara lebih terperinci. Selain itu, apabila ada penambahan langkah baru, dapat dengan mudah dilakukan melalui flowchart ini.</p>

					<p>Setelah selesai membuat flowchart, tugas programmer adalah menerjemahkan desain logis tersebut menjadi program menggunakan bahasa pemrograman yang telah disepakati.</p>

					<h4>Tujuan flowchart</h4>

					<p>Flowchart atau diagram alir digunakan untuk menggambarkan langkah-langkah penyelesaian suatu masalah secara sederhana, jelas, teratur, dan terstruktur. Tujuan dari penggunaan flowchart ini adalah untuk memberikan pemahaman yang lebih baik tentang tahapan yang diperlukan dalam menyelesaikan masalah tersebut. Flowchart menggunakan simbol-simbol standar yang membantu dalam mengkomunikasikan informasi dengan efektif.</p>
					<p>Sehingga masalah yang tadinya rumit menjadi lebih mudah untuk dipahami dan dicari solusinya dengan penjelasan yang sederhana memakai diagram alir.</p>

					<h2>Jenis-jenis flowchart</h2>
					<p>Flowchart sendiri terdiri dari lima jenis, masing-masing jenis memiliki ciri khas tersendiri. Berikut  jenis-jenisnya:</p>

					<ol>
						<li><b>Flowchart Dokumen</b></li>
						<p>Terdapat jenis flowchart yang pertama disebut sebagai flowchart dokumen atau juga dikenal sebagai paperwork flowchart. Flowchart dokumen digunakan untuk melacak jalur alur form dari satu bagian ke bagian lainnya, termasuk proses, pencatatan, dan penyimpanan laporan.</p>
						<li><b>Flowchart Program</b></li>
						<p>Flowchart ini secara terperinci menggambarkan prosedur dari proses program. Flowchart program terdiri dari dua jenis, yaitu flowchart logika program (program logic flowchart) dan flowchart program komputer terinci (detailed computer program flowchart).</p>
						<li><b>Flowchart Process</b></li>
						<p>Flowchart proses merupakan metode visualisasi rekayasa industri yang digunakan untuk memperinci dan menganalisis langkah-langkah berikutnya dalam sebuah prosedur atau sistem.</p>
						<li><b>Flowchart Sistem</b></li>
						<p>Flowchart sistem ini digunakan untuk menggambarkan secara keseluruhan tahapan atau proses kerja yang sedang berlangsung di dalam sistem. Flowchart sistem juga memberikan urutan rinci dari setiap prosedur yang terdapat dalam sistem tersebut.</p>
						<li><b>Flowchart Skematik</b></li>
						<p>Dan yang terakhir adalah Flowchart Skematik. Flowchart ini memperlihatkan urutan prosedur dalam suatu sistem, serupa dengan flowchart sistem. Namun, terdapat perbedaan dalam penggunaan simbol-simbol untuk menggambarkan alur. Flowchart skematik juga menggunakan gambar-gambar komputer dan peralatan lainnya untuk membantu pemahaman flowchart bagi orang yang tidak terbiasa.</p>
					</ol>
					<!-- <div class="container">
						<div class="row">
							<div class="col-lg-6">
								<select class="form-select lang-list" aria-label="Default select example">
									<option value="1 csharp" selected>C#</option>
									<option value="4 java">Java</option>
									<option value="5 python">Python</option>
									<option value="6 c_cpp">C (gcc)</option>
									<option value="7 c_cpp">C++ (gcc)</option>
									<option value="8 php">Php</option>
									<option value="12 ruby">Ruby</option>
									<option value="13 perl">Perl</option>
									<option value="17 javascript">Javascript</option>
									<option value="20 golang">Go</option>
									<option value="37 swift">Swift</option>
									<option value="43 kotlin">Kotlin</option>
								</select><button type="button" class="btn btn-success float-end" id="run"><i class="bi bi-play-fill"></i> RUN</button>
								<pre id="editor">using System;
namespace HelloWorld
{
	class Program
	{
		static void Main(string[] args)
		{
			Console.WriteLine("Hello World!");    
		}
	}
}
								</pre>
							</div>
							<div class="col-lg-6">
								<h3>Result</h3>
								<div class="preview-code">
								</div>
							</div>
						</div>
					</div> -->
					<button class="btn btn-course f-right" id="next" data-next="2" data-curr="<?php echo $currCourse ?>" data-reward='0' data-username="<?php echo $_SESSION['username']; ?>">Berikutnya</button>
					<div style="clear: both;"></div>
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
<script type="text/javascript" src="../js/courses/ace-editor.js"></script>
</html>