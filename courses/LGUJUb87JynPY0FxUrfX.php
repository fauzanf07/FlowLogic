<?php 	
	session_start();
	include('../db.php');
	include('../server.php');
	if(!isset($_SESSION['name'])){
		header("Location: ".$mainUrl);
	}else{
		$username = $_SESSION['username'];
		$idUser= $_SESSION['user_id'];
		$query = "SELECT * FROM tb_user WHERE username='$username'";
		$hasil = mysqli_query($con, $query);
		$r = mysqli_fetch_assoc($hasil);

		$currCourse = $_SESSION['curr_course'];
		$progress = intval(($_SESSION['curr_course']/26)*100);
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
	<link rel="stylesheet" type="text/css" href="../css/courses/autorefresher.min.css">
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
		    <a class="navbar-brand" href="#"> <i class="bi bi-code-square"></i> FlowLogic</a>
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
												<li class="list-group-item ">
													<div style="width: 100%;">
														<div class="check-side ">
															<span
																class="checklist <?php if($currCourse>6) echo 'check'; ?>"><?php if($currCourse>6) echo '&#10003;'; ?></span>
														</div>
														<div class="material-name" data-course="6"
															data-curr="<?php echo $currCourse ?>">
															<a>Quiz Singkat</a>
															<div class="get-item">
																<span><i class="bi bi-diamond-fill"></i> Up to +100
																	&nbsp;&nbsp;</span>
																<span><i class="bi bi-star-fill"></i> Up to +300</span>
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
                                                <li class="list-group-item" >
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
												<li class="list-group-item">
                                                    <div style="width: 100%;">
                                                        <div class="check-side ">
                                                            <span
                                                                class="checklist <?php if($currCourse>11) echo 'check'; ?>"><?php if($currCourse>11) echo '&#10003;'; ?></span>
                                                        </div>
                                                        <div class="material-name" data-course="11"
                                                            data-curr="<?php echo $currCourse ?>">
                                                            <a>Challenge : Studi Kasus</a>
                                                            <div class="get-item">
                                                                <span><i class="bi bi-diamond-fill"></i> Up to +300
                                                                    &nbsp;&nbsp;</span>
                                                                <span><i class="bi bi-star-fill"></i> +300
                                                                    &nbsp;&nbsp;</span>
                                                                <span<i class="bi bi-award-fill"></i> 1</span>
                                                            </div>
                                                        </div>
                                                        <div class="user-footprint" id="userFootprintC11"
                                                            data-course="11">
                                                            <img class="user-img-footprint" id='userImgFootprintC11'>
                                                            <span class="user-total" id="totalUserC11"></span>
                                                        </div>
                                                    </div>
                                                </li>  
                                                <li class="list-group-item">
                                                    <div style="width: 100%;">
                                                        <div class="check-side ">
                                                            <span
                                                                class="checklist <?php if($currCourse>12) echo 'check'; ?>"><?php if($currCourse>12) echo '&#10003;'; ?></span>
                                                        </div>
                                                        <div class="material-name" data-course="12"
                                                            data-curr="<?php echo $currCourse ?>">
                                                            <a>Quiz Singkat</a>
                                                            <div class="get-item">
																<span><i class="bi bi-diamond-fill"></i> Up to +100
																	&nbsp;&nbsp;</span>
																<span><i class="bi bi-star-fill"></i> Up to +300</span>
															</div>
                                                        </div>
                                                        <div class="user-footprint" id="userFootprintC12"
                                                            data-course="12">
                                                            <img class="user-img-footprint" id='userImgFootprintC12'>
                                                            <span class="user-total" id="totalUserC12"></span>
                                                        </div>
                                                    </div>
                                                </li> 
                                            </ul>

											</div>
									    </div>
								</div>
								<div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingThree">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#flush-collapseThree"
                                            aria-expanded="false" aria-controls="flush-collapseThree">
                                            <b>Level 3: Fungsi dan Prosedur</b>
                                        </button>
                                    </h2>
                                    <div id="flush-collapseThree" class="accordion-collapse collapse"
                                        aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item">
                                                    <div style="width: 100%;">
                                                        <div class="check-side ">
                                                            <span
                                                                class="checklist <?php if($currCourse>13) echo 'check'; ?>"><?php if($currCourse>13) echo '&#10003;'; ?></span>
                                                        </div>
                                                        <div class="material-name" data-course="13"
                                                            data-curr="<?php echo $currCourse ?>">
                                                            <a>Pengenalan Pemrograman Struktur</a>
                                                            <div class="get-item">
                                                                <span><i class="bi bi-diamond-fill"></i> +0
                                                                    &nbsp;&nbsp;</span>
                                                                <span><i class="bi bi-star-fill"></i> +100</span>
                                                            </div>
                                                        </div>
                                                        <div class="user-footprint" id="userFootprintC13"
                                                            data-course="13">
                                                            <img class="user-img-footprint" id='userImgFootprintC13'>
                                                            <span class="user-total" id="totalUserC13"></span>
                                                        </div>
                                                    </div>
                                                </li>  
												<li class="list-group-item">
                                                    <div style="width: 100%;">
                                                        <div class="check-side ">
                                                            <span
                                                                class="checklist <?php if($currCourse>14) echo 'check'; ?>"><?php if($currCourse>14) echo '&#10003;'; ?></span>
                                                        </div>
                                                        <div class="material-name" data-course="14"
                                                            data-curr="<?php echo $currCourse ?>">
                                                            <a>Variabel Lokal dan Global</a>
                                                            <div class="get-item">
                                                                <span><i class="bi bi-diamond-fill"></i> +0
                                                                    &nbsp;&nbsp;</span>
                                                                <span><i class="bi bi-star-fill"></i> +100</span>
                                                            </div>
                                                        </div>
                                                        <div class="user-footprint" id="userFootprintC14"
                                                            data-course="14">
                                                            <img class="user-img-footprint" id='userImgFootprintC14'>
                                                            <span class="user-total" id="totalUserC14"></span>
                                                        </div>
                                                    </div>
                                                </li>  
												<li class="list-group-item">
                                                    <div style="width: 100%;">
                                                        <div class="check-side ">
                                                            <span
                                                                class="checklist <?php if($currCourse>15) echo 'check'; ?>"><?php if($currCourse>15) echo '&#10003;'; ?></span>
                                                        </div>
                                                        <div class="material-name" data-course="15"
                                                            data-curr="<?php echo $currCourse ?>">
                                                            <a>Identifikasi Variabel Lokal dan Global</a>
                                                            <div class="get-item">
                                                                <span><i class="bi bi-diamond-fill"></i> Up to +50
                                                                    &nbsp;&nbsp;</span>
                                                                <span><i class="bi bi-star-fill"></i> +0</span>
                                                            </div>
                                                        </div>
                                                        <div class="user-footprint" id="userFootprintC15"
                                                            data-course="15">
                                                            <img class="user-img-footprint" id='userImgFootprintC15'>
                                                            <span class="user-total" id="totalUserC15"></span>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div style="width: 100%;">
                                                        <div class="check-side ">
                                                            <span
                                                                class="checklist <?php if($currCourse>16) echo 'check'; ?>"><?php if($currCourse>16) echo '&#10003;'; ?></span>
                                                        </div>
                                                        <div class="material-name" data-course="16"
                                                            data-curr="<?php echo $currCourse ?>">
                                                            <a>Pengenalan Fungsi</a>
                                                            <div class="get-item">
                                                                <span><i class="bi bi-diamond-fill"></i> +0
                                                                    &nbsp;&nbsp;</span>
                                                                <span><i class="bi bi-star-fill"></i> +100</span>
                                                            </div>
                                                        </div>
                                                        <div class="user-footprint" id="userFootprintC16"
                                                            data-course="16">
                                                            <img class="user-img-footprint" id='userImgFootprintC16'>
                                                            <span class="user-total" id="totalUserC16"></span>
                                                        </div>
                                                    </div>
                                                </li>
												<li class="list-group-item">
                                                    <div style="width: 100%;">
                                                        <div class="check-side ">
                                                            <span
                                                                class="checklist <?php if($currCourse>17) echo 'check'; ?>"><?php if($currCourse>17) echo '&#10003;'; ?></span>
                                                        </div>
                                                        <div class="material-name" data-course="17"
                                                            data-curr="<?php echo $currCourse ?>">
                                                            <a>Struktur Fungsi</a>
                                                            <div class="get-item">
                                                                <span><i class="bi bi-diamond-fill"></i> +0
                                                                    &nbsp;&nbsp;</span>
                                                                <span><i class="bi bi-star-fill"></i> +100</span>
                                                            </div>
                                                        </div>
                                                        <div class="user-footprint" id="userFootprintC17"
                                                            data-course="17">
                                                            <img class="user-img-footprint" id='userImgFootprintC17'>
                                                            <span class="user-total" id="totalUserC17"></span>
                                                        </div>
                                                    </div>
                                                </li>
												<li class="list-group-item">
                                                    <div style="width: 100%;">
                                                        <div class="check-side ">
                                                            <span
                                                                class="checklist <?php if($currCourse>18) echo 'check'; ?>"><?php if($currCourse>18) echo '&#10003;'; ?></span>
                                                        </div>
                                                        <div class="material-name" data-course="18"
                                                            data-curr="<?php echo $currCourse ?>">
                                                            <a>Prototipe Fungsi</a>
                                                            <div class="get-item">
                                                                <span><i class="bi bi-diamond-fill"></i> +0
                                                                    &nbsp;&nbsp;</span>
                                                                <span><i class="bi bi-star-fill"></i> +100</span>
                                                            </div>
                                                        </div>
                                                        <div class="user-footprint" id="userFootprintC18"
                                                            data-course="18">
                                                            <img class="user-img-footprint" id='userImgFootprintC18'>
                                                            <span class="user-total" id="totalUserC18"></span>
                                                        </div>
                                                    </div>
                                                </li>
												<li class="list-group-item">
                                                    <div style="width: 100%;">
                                                        <div class="check-side ">
                                                            <span
                                                                class="checklist <?php if($currCourse>19) echo 'check'; ?>"><?php if($currCourse>19) echo '&#10003;'; ?></span>
                                                        </div>
                                                        <div class="material-name" data-course="19"
                                                            data-curr="<?php echo $currCourse ?>">
                                                            <a>Parameter Aktual dan Formal</a>
                                                            <div class="get-item">
                                                                <span><i class="bi bi-diamond-fill"></i> +0
                                                                    &nbsp;&nbsp;</span>
                                                                <span><i class="bi bi-star-fill"></i> +100</span>
                                                            </div>
                                                        </div>
                                                        <div class="user-footprint" id="userFootprintC19"
                                                            data-course="19">
                                                            <img class="user-img-footprint" id='userImgFootprintC19'>
                                                            <span class="user-total" id="totalUserC19"></span>
                                                        </div>
                                                    </div>
                                                </li>
												<li class="list-group-item">
                                                    <div style="width: 100%;">
                                                        <div class="check-side ">
                                                            <span
                                                                class="checklist <?php if($currCourse>20) echo 'check'; ?>"><?php if($currCourse>20) echo '&#10003;'; ?></span>
                                                        </div>
                                                        <div class="material-name" data-course="20"
                                                            data-curr="<?php echo $currCourse ?>">
                                                            <a>Pemanggilan Fungsi</a>
                                                            <div class="get-item">
                                                                <span><i class="bi bi-diamond-fill"></i> +0
                                                                    &nbsp;&nbsp;</span>
                                                                <span><i class="bi bi-star-fill"></i> +100</span>
                                                            </div>
                                                        </div>
                                                        <div class="user-footprint" id="userFootprintC20"
                                                            data-course="20">
                                                            <img class="user-img-footprint" id='userImgFootprintC20'>
                                                            <span class="user-total" id="totalUserC20"></span>
                                                        </div>
                                                    </div>
                                                </li>
												<li class="list-group-item">
                                                    <div style="width: 100%;">
                                                        <div class="check-side ">
                                                            <span
                                                                class="checklist <?php if($currCourse>21) echo 'check'; ?>"><?php if($currCourse>21) echo '&#10003;'; ?></span>
                                                        </div>
                                                        <div class="material-name" data-course="21"
                                                            data-curr="<?php echo $currCourse ?>">
                                                            <a>Pengenalan Prosedur</a>
                                                            <div class="get-item">
                                                                <span><i class="bi bi-diamond-fill"></i> +0
                                                                    &nbsp;&nbsp;</span>
                                                                <span><i class="bi bi-star-fill"></i> +100</span>
                                                            </div>
                                                        </div>
                                                        <div class="user-footprint" id="userFootprintC21"
                                                            data-course="21">
                                                            <img class="user-img-footprint" id='userImgFootprintC21'>
                                                            <span class="user-total" id="totalUserC21"></span>
                                                        </div>
                                                    </div>
                                                </li>
												<li class="list-group-item">
                                                    <div style="width: 100%;">
                                                        <div class="check-side ">
                                                            <span
                                                                class="checklist <?php if($currCourse>22) echo 'check'; ?>"><?php if($currCourse>22) echo '&#10003;'; ?></span>
                                                        </div>
                                                        <div class="material-name" data-course="22"
                                                            data-curr="<?php echo $currCourse ?>">
                                                            <a>Struktur Prosedur</a>
                                                            <div class="get-item">
                                                                <span><i class="bi bi-diamond-fill"></i> +0
                                                                    &nbsp;&nbsp;</span>
                                                                <span><i class="bi bi-star-fill"></i> +100</span>
                                                            </div>
                                                        </div>
                                                        <div class="user-footprint" id="userFootprintC22"
                                                            data-course="22">
                                                            <img class="user-img-footprint" id='userImgFootprintC22'>
                                                            <span class="user-total" id="totalUserC22"></span>
                                                        </div>
                                                    </div>
                                                </li>
												<li class="list-group-item">
                                                    <div style="width: 100%;">
                                                        <div class="check-side ">
                                                            <span
                                                                class="checklist <?php if($currCourse>23) echo 'check'; ?>"><?php if($currCourse>23) echo '&#10003;'; ?></span>
                                                        </div>
                                                        <div class="material-name" data-course="23"
                                                            data-curr="<?php echo $currCourse ?>">
                                                            <a>Prototipe Prosedur</a>
                                                            <div class="get-item">
                                                                <span><i class="bi bi-diamond-fill"></i> +0
                                                                    &nbsp;&nbsp;</span>
                                                                <span><i class="bi bi-star-fill"></i> +100</span>
                                                            </div>
                                                        </div>
                                                        <div class="user-footprint" id="userFootprintC23"
                                                            data-course="23">
                                                            <img class="user-img-footprint" id='userImgFootprintC23'>
                                                            <span class="user-total" id="totalUserC23"></span>
                                                        </div>
                                                    </div>
                                                </li>
												<li class="list-group-item">
                                                    <div style="width: 100%;">
                                                        <div class="check-side ">
                                                            <span
                                                                class="checklist <?php if($currCourse>24) echo 'check'; ?>"><?php if($currCourse>24) echo '&#10003;'; ?></span>
                                                        </div>
                                                        <div class="material-name" data-course="24"
                                                            data-curr="<?php echo $currCourse ?>">
                                                            <a>Pemanggilan Prosedur</a>
                                                            <div class="get-item">
                                                                <span><i class="bi bi-diamond-fill"></i> +0
                                                                    &nbsp;&nbsp;</span>
                                                                <span><i class="bi bi-star-fill"></i> +100</span>
                                                            </div>
                                                        </div>
                                                        <div class="user-footprint" id="userFootprintC24"
                                                            data-course="24">
                                                            <img class="user-img-footprint" id='userImgFootprintC24'>
                                                            <span class="user-total" id="totalUserC24"></span>
                                                        </div>
                                                    </div>
                                                </li>
												<li class="list-group-item">
                                                    <div style="width: 100%;">
                                                        <div class="check-side ">
                                                            <span
                                                                class="checklist <?php if($currCourse>25) echo 'check'; ?>"><?php if($currCourse>25) echo '&#10003;'; ?></span>
                                                        </div>
                                                        <div class="material-name" data-course="25"
                                                            data-curr="<?php echo $currCourse ?>">
                                                            <a>Challenge : Studi Kasus</a>
                                                            <div class="get-item">
																<span><i class="bi bi-diamond-fill"></i> Up to +200
                                                                    &nbsp;&nbsp;</span>
                                                                <span><i class="bi bi-star-fill"></i> Up to +165
                                                                    &nbsp;&nbsp;</span>
                                                                <span<i class="bi bi-award-fill"></i> 1</span>
                                                            </div>
                                                        </div>
                                                        <div class="user-footprint" id="userFootprintC25"
                                                            data-course="25">
                                                            <img class="user-img-footprint" id='userImgFootprintC25'>
                                                            <span class="user-total" id="totalUserC25"></span>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item" id="current-li">
                                                    <div style="width: 100%;">
                                                        <div class="check-side ">
                                                            <span
                                                                class="checklist <?php if($currCourse>26) echo 'check'; ?>"><?php if($currCourse>26) echo '&#10003;'; ?></span>
                                                        </div>
                                                        <div class="material-name" data-course="26"
                                                            data-curr="<?php echo $currCourse ?>">
                                                            <a>Quiz Singkat</a>
                                                            <div class="get-item">
																<span><i class="bi bi-diamond-fill"></i> +Up to 1000
                                                                    &nbsp;&nbsp;</span>
                                                                <span><i class="bi bi-star-fill"></i> +Up to 1000</span>
                                                            </div>
                                                        </div>
                                                        <div class="user-footprint" id="userFootprintC26"
                                                            data-course="26">
                                                            <img class="user-img-footprint" id='userImgFootprintC26'>
                                                            <span class="user-total" id="totalUserC26"></span>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
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
                        $sql = "SELECT * FROM tb_open_access WHERE id_user='$idUser' AND quiz='3'";
                        $res = mysqli_query($con, $sql);
                        $count = mysqli_num_rows($res);
                        if($count==0){
                    ?>
                    <p>Quiz ini masih terkunci. Untuk membukanya, kamu perlu membayar dengan 400 XP. Setelah membayar, kamu akan dapat mengakses dan mengikuti Quiz ini. XP yang kamu bayarkan akan dikurangi dari total XP yang kamu miliki. Jika kamu memiliki cukup XP, silakan lanjutkan pembayaran untuk membuka Quiz.</p>
                    <center><button class="btn btn-primary" onclick="openAccess(<?php echo $idUser; ?>,0,3,0)">Buka Quiz &nbsp;<i class="bi bi-key-fill"></i></button></center>
                    <br><br>
                    <?php
                        }else{

                    ?>
					<?php 
						$sql = "SELECT * FROM tb_quiz WHERE id_user='$idUser' AND quiz='3'";
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
										<li>Jika anda sudah yakin dengan jawaban Anda, segera mengklik tombol evaluasi untuk mengecek jawaban Anda apakah benar atau tidak.</li>
										<li>Setiap soal yang dijawab dengan benar, peserta didik akan mendapatkan xp dan poin dengan jumlah sesuai kecepatan anda menjawab soal.</li>
										<li>Setelah quiz selesai, peserta didik akan melihat peringkat pada quiz ini dari jumlah xp tertinggi sampai terendah.</li>
									</ol>
									<center><button class="btn-quiz" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next" onclick="startTimer(1,60);">Mulai Quiz</button></center>
								</div>
								<div class="carousel-item">
									<div class="auto-refresher" id="auto-refresher1"></div>
									<span class="timer">Time Remaining: <span id="auto-refresher-time-remaining1"></span></span>
									<p>Perhatikan program menggunakan bahasa c ini!</p>
                                    <center><img src="../images/quiz/quiz-soal-1-3.png" width="50%" height="auto"></center>
                                    <p>Pada program tersebut, variabel yang tepat untuk mengisi kode yang rumpang dan hasil output yang tepat jika diisi dengan variabel tersebut ialah…</p>
									<div class="pilgan-wrapper">
										<div class="pilgan-box" onclick="choose(this);" data-id="1" id="pilgan11">x, Nilai variabel global = 10</div>
										<div class="pilgan-box" onclick="choose(this);" data-id="2" id="pilgan12">x, Nilai variabel global = 15</div>
										<div class="pilgan-box" onclick="choose(this);" data-id="3" id="pilgan13">y, Nilai variabel global = 20</div>
										<div class="pilgan-box" onclick="choose(this);" data-id="4" id="pilgan14">y, Nilai variabel global = 25</div>
										<div class="pilgan-box" onclick="choose(this);" data-id="5" id="pilgan15">y, Program tidak bisa dieksekusi karena memiliki error</div>
									</div>
									<div class="point-xp">
										<span><i class="bi bi-star-fill"></i> XP : <span id="total-xp1"></span> &nbsp;&nbsp;</span>
										<span><i class="bi bi-diamond-fill"></i> Points : <span id="total-points1"></span></span>
									</div>
									<button class="btn-quiz next" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next" onclick="startTimer(2,60);" id="nextSoal1">Next</button>
									<button class="btn-quiz evaluasi" type="button"  onclick="evaluasi(1,60,false);" id="btnEval1">Evaluasi</button>
								</div>
								<div class="carousel-item">
									<div class="auto-refresher" id="auto-refresher2"></div>
									<span class="timer">Time Remaining: <span id="auto-refresher-time-remaining2"></span></span>
									<p>Perhatikan program menggunakan bahasa c ini!</p>
                                    <center><img src="../images/quiz/quiz-soal-2-3.png" width="50%" height="auto"></center>
                                    <p>Pada program tersebut, parameter aktual ditunjukan pada kotak berwarna…</p>
									<div class="pilgan-wrapper">
										<div class="pilgan-box" onclick="choose(this);" data-id="1" id="pilgan21">Merah</div>
										<div class="pilgan-box" onclick="choose(this);" data-id="2" id="pilgan22">Kuning</div>
										<div class="pilgan-box" onclick="choose(this);" data-id="3" id="pilgan23">Oranye</div>
										<div class="pilgan-box" onclick="choose(this);" data-id="4" id="pilgan24">Hijau</div>
										<div class="pilgan-box" onclick="choose(this);" data-id="5" id="pilgan25">Biru</div>
									</div>
									<div class="point-xp">
										<span><i class="bi bi-star-fill"></i> XP : <span id="total-xp2"></span> &nbsp;&nbsp;</span>
										<span><i class="bi bi-diamond-fill"></i> Points : <span id="total-points2"></span></span>
									</div>
									<button class="btn-quiz next" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next" onclick="startTimer(3,60);" id="nextSoal2">Next</button>
									<button class="btn-quiz evaluasi" type="button"  onclick="evaluasi(2,60,false);" id="btnEval2">Evaluasi</button>
								</div>
								<div class="carousel-item">
									<div class="auto-refresher" id="auto-refresher3"></div>
									<span class="timer">Time Remaining: <span id="auto-refresher-time-remaining3"></span></span>
									<p>Perhatikan pseudocode sebuah prosedur berikut!</p>
                                    <center><img src="../images/quiz/quiz-soal-3-3.png" width="50%" height="auto"></center>
                                    <p>Berdasarkan pseudocode diatas, jika kita memanggil prosedur tersebut sebagai berikut pro_ganjil_genap(101) di program utama, maka hasil output dari prosedur tersebut ialah…</p>
									<div class="pilgan-wrapper">
										<div class="pilgan-box" onclick="choose(this);" data-id="1" id="pilgan31">Ganjil</div>
										<div class="pilgan-box" onclick="choose(this);" data-id="2" id="pilgan32">Bilangan Ganjil</div>
										<div class="pilgan-box" onclick="choose(this);" data-id="3" id="pilgan33">Genap</div>
										<div class="pilgan-box" onclick="choose(this);" data-id="4" id="pilgan34">Bilangan Genap</div>
										<div class="pilgan-box" onclick="choose(this);" data-id="5" id="pilgan35">Tidak menghasilkan output apa-apa</div>
									</div>
									<div class="point-xp">
										<span><i class="bi bi-star-fill"></i> XP : <span id="total-xp3"></span> &nbsp;&nbsp;</span>
										<span><i class="bi bi-diamond-fill"></i> Points : <span id="total-points3"></span></span>
									</div>
									<button class="btn-quiz next" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next" onclick="startTimer(4,120);" id="nextSoal3">Next</button>
									<button class="btn-quiz evaluasi" type="button"  onclick="evaluasi(3,60,false);" id="btnEval3">Evaluasi</button>
								</div>
								<div class="carousel-item">
									<div class="auto-refresher" id="auto-refresher4"></div>
									<span class="timer">Time Remaining: <span id="auto-refresher-time-remaining4"></span></span>
									<p>Anti merupakan seseorang yang senang berolahraga. Setiap pagi anti selalu berlari jogging mengelilingi  sebuah lapangan dengan ukuran 10m x 15m. Anti ingin melihat jarak tempuh yang telah bisa dia lewati untuk mengetahui ketahanan dia berlari. Bantu anti membuat sebuah prosedur menampilkan jarak tempuh yang dia lewati berdasarkan nilai berapa kali dia mengelilingi lapangan yang dia input di program utama. Berikut ini manakah prosedur yang tepat untuk kasus diatas…</p>
									<div class="pilgan-wrapper">
										<div class="pilgan-box" onclick="choose(this);" data-id="1" id="pilgan41" style="min-width:40%;"><img src="../images/quiz/pilgan-4-a-3.png" width="100%" height="auto"></div>
										<div class="pilgan-box" onclick="choose(this);" data-id="2" id="pilgan42" style="min-width:40%;"><img src="../images/quiz/pilgan-4-b-3.png" width="100%" height="auto"></div>
										<div class="pilgan-box" onclick="choose(this);" data-id="3" id="pilgan43" style="min-width:40%;"><img src="../images/quiz/pilgan-4-c-3.png" width="100%" height="auto"></div>
										<div class="pilgan-box" onclick="choose(this);" data-id="4" id="pilgan44" style="min-width:40%;"><img src="../images/quiz/pilgan-4-d-3.png" width="100%" height="auto"></div>
										<div class="pilgan-box" onclick="choose(this);" data-id="5" id="pilgan45" style="min-width:40%;"><img src="../images/quiz/pilgan-4-e-3.png" width="100%" height="auto"></div>
									</div>
									<div class="point-xp">
										<span><i class="bi bi-star-fill"></i> XP : <span id="total-xp4"></span> &nbsp;&nbsp;</span>
										<span><i class="bi bi-diamond-fill"></i> Points : <span id="total-points4"></span></span>
									</div>
									<button class="btn-quiz next" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next" onclick="startTimer(5,120);" id="nextSoal4">Next</button>
									<button class="btn-quiz evaluasi" type="button"  onclick="evaluasi(4,120,false);" id="btnEval4">Evaluasi</button>
								</div>
								<div class="carousel-item">
									<div class="auto-refresher" id="auto-refresher5"></div>
									<span class="timer">Time Remaining: <span id="auto-refresher-time-remaining5"></span></span>
									<p>Perhatikan program menggunakan bahasa C ini!</p>
                                    <center><img src="../images/quiz/quiz-soal-5-3.png" width="50%" height="auto"></center>
                                    <p>Pada program tersebut, jika kita inputkan huruf A maka hasil outputnya akan bernilai 65, jika D hasilnya 68, jika G hasilnya 71, dan seterusnya sampai Z membentuk pola tertentu. Jika kita menginputkan huruf J, maka output yang akan dihasilkan adalah…</p>
									<div class="pilgan-wrapper">
										<div class="pilgan-box" onclick="choose(this);" data-id="1" id="pilgan51">72</div>
										<div class="pilgan-box" onclick="choose(this);" data-id="2" id="pilgan52">73</div>
										<div class="pilgan-box" onclick="choose(this);" data-id="3" id="pilgan53">74</div>
										<div class="pilgan-box" onclick="choose(this);" data-id="4" id="pilgan54">75</div>
										<div class="pilgan-box" onclick="choose(this);" data-id="5" id="pilgan55">76</div>
									</div>
									<div class="point-xp">
										<span><i class="bi bi-star-fill"></i> XP : <span id="total-xp5"></span> &nbsp;&nbsp;</span>
										<span><i class="bi bi-diamond-fill"></i> Points : <span id="total-points5"></span></span>
									</div>
                                    <button class="btn-quiz next" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next" onclick="startTimer(6,120);" id="nextSoal5">Next</button>
									
                                    <button class="btn-quiz evaluasi" type="button"  onclick="evaluasi(5,120,false);" id="btnEval5">Evaluasi</button>
								</div>
                                <div class="carousel-item">
									<div class="auto-refresher" id="auto-refresher6"></div>
									<span class="timer">Time Remaining: <span id="auto-refresher-time-remaining6"></span></span>
									<p>Perhatikan prosedur-prosedur berikut ini!</p>
                                    <center><img src="../images/quiz/quiz-soal-6-3.png" width="50%" height="auto"></center>
                                    <p>Prosedur-prosedur tersebut merupakan prosedur untuk memudahkan penjual barang untuk menghitung diskon serta total harga setelah diskon yang didapat oleh seorang pembeli di toko tersebut.  Jika seorang pembeli membeli 5 buah barang dengan harga per barang Rp. 5000, maka diskon serta harga setelah diskon yang diperoleh pembeli tersebut berdasarkan prosedur-prosedur diatas ialah…</p>
									<div class="pilgan-wrapper">
										<div class="pilgan-box" onclick="choose(this);" data-id="1" id="pilgan61">10%, Rp. 22500</div>
										<div class="pilgan-box" onclick="choose(this);" data-id="2" id="pilgan62">1%, Rp. 24750</div>
										<div class="pilgan-box" onclick="choose(this);" data-id="3" id="pilgan63">5%, Rp. 23750</div>
										<div class="pilgan-box" onclick="choose(this);" data-id="4" id="pilgan64">50%, Rp. 12500</div>
										<div class="pilgan-box" onclick="choose(this);" data-id="5" id="pilgan65">0%, Rp. 25000</div>
									</div>
									<div class="point-xp">
										<span><i class="bi bi-star-fill"></i> XP : <span id="total-xp6"></span> &nbsp;&nbsp;</span>
										<span><i class="bi bi-diamond-fill"></i> Points : <span id="total-points6"></span></span>
									</div>
									<button class="btn-quiz next" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next" onclick="startTimer(7,60);" id="nextSoal6">Next</button>
									<button class="btn-quiz evaluasi" type="button"  onclick="evaluasi(6,120,false);" id="btnEval6">Evaluasi</button>
								</div>
                                <div class="carousel-item">
									<div class="auto-refresher" id="auto-refresher7"></div>
									<span class="timer">Time Remaining: <span id="auto-refresher-time-remaining7"></span></span>
									<p>Perhatikan prosedur serta fungsi pada kode program berikut ini!</p>
                                    <center><img src="../images/quiz/quiz-soal-7-1-3.png" width="50%" height="auto"></center><br>
                                    <center><img src="../images/quiz/quiz-soal-7-2-3.png" width="50%" height="auto"></center>
                                    <p>Dari prosedur dan fungsi pada program diatas, apa perbedaan mendasar antara fungsi dan prosedur?</p>
									<div class="pilgan-wrapper">
										<div class="pilgan-box" onclick="choose(this);" data-id="1" id="pilgan71">Prosedur tidak mengembalikan nilai, sedangkan fungsi mengembalikan nilai.</div>
										<div class="pilgan-box" onclick="choose(this);" data-id="2" id="pilgan72">Fungsi tidak mengembalikan nilai, sedangkan prosedur mengembalikan nilai.</div>
										<div class="pilgan-box" onclick="choose(this);" data-id="3" id="pilgan73">Prosedur dan fungsi sama-sama mengembalikan nilai.</div>
										<div class="pilgan-box" onclick="choose(this);" data-id="4" id="pilgan74">Prosedur dan fungsi sama-sama tidak mengembalikan nilai.</div>
										<div class="pilgan-box" onclick="choose(this);" data-id="5" id="pilgan75">Prosedur dan fungsi sama-sama digunakan untuk mencetak string ke layar.</div>
									</div>
									<div class="point-xp">
										<span><i class="bi bi-star-fill"></i> XP : <span id="total-xp7"></span> &nbsp;&nbsp;</span>
										<span><i class="bi bi-diamond-fill"></i> Points : <span id="total-points7"></span></span>
									</div>
									<button class="btn-quiz next" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next" onclick="startTimer(8,120);" id="nextSoal7">Next</button>
									<button class="btn-quiz evaluasi" type="button"  onclick="evaluasi(7,60,false);" id="btnEval7">Evaluasi</button>
								</div>
                                <div class="carousel-item">
									<div class="auto-refresher" id="auto-refresher8"></div>
									<span class="timer">Time Remaining: <span id="auto-refresher-time-remaining8"></span></span>
									<p>Pak Eko adalah seorang guru sekaligus wali kelas di salah satu sekolah di kota Bandung. Di sekolah pak Eko, para murid telah menyelesaikan Ujian Akhir Semester dan akan diadakan pembagian rapor sekitar satu minggu lagi. Pak eko harus memasukan nilai dan predikat nilai ke dalam rapor siswa-siswa yang diwakilinya. Karena pak Eko kewalahan dalam memberikan predikat nilai-nilai siswanya, pak Eko membuat sebuah program dari bahasa C untuk memudahkannya memberikan predikat nilai siswa ketika nilai dimasukkan. Kode program tersebut sebagai berikut</p>
                                    <center><img src="../images/quiz/quiz-soal-8-3.png" width="30%" height="auto"></center>
                                    <p>Berdasarkan program tersebut, jika pak eko memasukan nilai 85, maka predikat yang dihasilkan adalah…</p>
									<div class="pilgan-wrapper">
										<div class="pilgan-box" onclick="choose(this);" data-id="1" id="pilgan81">A</div>
										<div class="pilgan-box" onclick="choose(this);" data-id="2" id="pilgan82">B</div>
										<div class="pilgan-box" onclick="choose(this);" data-id="3" id="pilgan83">C</div>
										<div class="pilgan-box" onclick="choose(this);" data-id="4" id="pilgan84">D</div>
										<div class="pilgan-box" onclick="choose(this);" data-id="5" id="pilgan85">E</div>
									</div>
									<div class="point-xp">
										<span><i class="bi bi-star-fill"></i> XP : <span id="total-xp8"></span> &nbsp;&nbsp;</span>
										<span><i class="bi bi-diamond-fill"></i> Points : <span id="total-points8"></span></span>
									</div>
									<button class="btn-quiz next" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next" onclick="startTimer(9,120);" id="nextSoal8">Next</button>
									<button class="btn-quiz evaluasi" type="button"  onclick="evaluasi(8,120,false);" id="btnEval8">Evaluasi</button>
								</div>
                                <div class="carousel-item">
									<div class="auto-refresher" id="auto-refresher9"></div>
									<span class="timer">Time Remaining: <span id="auto-refresher-time-remaining9"></span></span>
									<p>Perhatikan flowchart berikut ini!</p>
                                    <center><img src="../images/quiz/quiz-soal-9-3.png" width="30%" height="auto"></center>
                                    <p>Simbol warna merah pada flowchart tersebut untuk menjalankan sebuah sub-program. Jenis sub-program apa yang terdapat dalam flowchart tersebut dan kenapa?</p>
									<div class="pilgan-wrapper">
										<div class="pilgan-box" onclick="choose(this);" data-id="1" id="pilgan91">Prosedur. Karena terdapat nilai yang dapat dikembalikan pada sub-program tersebut</div>
										<div class="pilgan-box" onclick="choose(this);" data-id="2" id="pilgan92">Prosedur. Karena tidak terdapat nilai yang dapat dikembalikan pada sub-program tersebut</div>
										<div class="pilgan-box" onclick="choose(this);" data-id="3" id="pilgan93">Fungsi. Karena terdapat nilai yang dapat dikembalikan pada sub-program tersebut</div>
										<div class="pilgan-box" onclick="choose(this);" data-id="4" id="pilgan94">Fungsi. Karena tidak terdapat nilai yang dapat dikembalikan pada sub-program tersebut</div>
										<div class="pilgan-box" onclick="choose(this);" data-id="5" id="pilgan95">Fungsi. Karena sub-program dapat dipanggil di program utama</div>
									</div>
									<div class="point-xp">
										<span><i class="bi bi-star-fill"></i> XP : <span id="total-xp9"></span> &nbsp;&nbsp;</span>
										<span><i class="bi bi-diamond-fill"></i> Points : <span id="total-points9"></span></span>
									</div>
									<button class="btn-quiz next" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next" onclick="startTimer(10,120);" id="nextSoal9">Next</button>
									<button class="btn-quiz evaluasi" type="button"  onclick="evaluasi(9,120,false);" id="btnEval9">Evaluasi</button>
								</div>
                                <div class="carousel-item">
									<div class="auto-refresher" id="auto-refresher10"></div>
									<span class="timer">Time Remaining: <span id="auto-refresher-time-remaining10"></span></span>
									<p>Perhatikan kode program berikut ini!</p>
                                    <center><img src="../images/quiz/quiz-soal-10-3.png" width="30%" height="auto"></center>
                                    <p>Bagian program rumpang yang disorot menggunakan warna merah merupakan pemanggilan fungsi max pada program utama. Berikut ini cara pemanggilan fungsi max yang benar untuk mengisi bagian program yang rumpang tersebut dan hasil output yang tepat jika kode program rumpang tersebut diisi dengan pemanggilan fungsi max yang benar adalah…</p>
									<div class="pilgan-wrapper">
										<div class="pilgan-box" onclick="choose(this);" data-id="1" id="pilgan101">int max(a,b); “Max = 20”</div>
										<div class="pilgan-box" onclick="choose(this);" data-id="2" id="pilgan102">int max(a,b); “Max = “ </div>
										<div class="pilgan-box" onclick="choose(this);" data-id="3" id="pilgan103">max(a,b); “Max = 20”</div>
										<div class="pilgan-box" onclick="choose(this);" data-id="4" id="pilgan104">max(a, b); “Max = “</div>
										<div class="pilgan-box" onclick="choose(this);" data-id="5" id="pilgan105">max(int a, int b); “Max = 20”</div>
									</div>
									<div class="point-xp">
										<span><i class="bi bi-star-fill"></i> XP : <span id="total-xp10"></span> &nbsp;&nbsp;</span>
										<span><i class="bi bi-diamond-fill"></i> Points : <span id="total-points10"></span></span>
									</div>
									<button class="btn-quiz next" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next"  onclick="result(10,<?php echo $idUser; ?>);"  id="nextSoal10">Result</button>
									<button class="btn-quiz evaluasi" type="button"  onclick="evaluasi(10,120,false);" id="btnEval10">Evaluasi</button>
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
											$sql = "SELECT a.*, b.name FROM tb_quiz as a LEFT JOIN tb_user as b on a.id_user= b.id WHERE a.quiz='3' ORDER BY a.xp DESC, a.points DESC";
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
					}
					?>
					<button class="btn btn-course" id="previous" data-prev="11">Sebelumnya</button>
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
	      <strong class="me-auto">FlowLogic</strong>
	      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
	    </div>
	    <div class="toast-body" id="msgToast">
	    </div>
	  </div>
	</div>
	<div class="modal fade" id="exampleModal1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-bg-custom">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Naik Level <i class="bi bi-capslock-fill"></i>
                    </h1>
                </div>
                <div class="modal-body body-levelUp">
                    <center><img width="55%" height="auto" src="../images/level-up.gif" /></center>
                    <center>
                        <h4 class="levelUp-desc"></h4>
                    </center>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary main-bg-color" onclick="getNextCourse(13,<?php echo $currCourse ?>,'<?php echo $_SESSION['username']; ?>')">Next Course</button>
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
<script type="text/javascript" src="../js/courses/quiz/quiz3.js"></script>
</html>