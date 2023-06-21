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
        $id_user= $r['id'];

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
    <title>Challenge: Studi Kasus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" type="text/css" href="../css/courses/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&family=Roboto+Slab&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css" rel="stylesheet"
        type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/4.0.17/css/froala_style.min.css"
        integrity="sha512-7LA92qqMxQg1dy0GXIaceecW4zpFq/pu2inmPOd/IaCjDnjzDP1luaG9NTYU8BeaUmBw73jHCGRJjQ3xDpdDlg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/froala-editor@latest/css/plugins/image.min.css" rel="stylesheet"
        type="text/css" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>

<body>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasRightLabel"><i class="bi bi-trophy-fill"></i>&nbsp;&nbsp;Top Ranks
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close" id="closeRanks"></button>
        </div>
        <div class="offcanvas-body">
            <div class="ranks">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Points</th>
                            <th scope="col">XP</th>
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
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="course" href="../user/course.php"
                            style="text-align: center;">Corridor</a>
                    </li>
                    <div class="btn-group dropdown-center">
                        <button type="button" class="btn btn-light dropdown-toggle btn-nav" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img src="<?php echo $_SESSION['photo_profile']; ?>" class="photo_profile">
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="../user/home.php"><i
                                        class="bi bi-house-fill"></i>&nbsp;&nbsp; Home</a></li>
                            <li><a class="dropdown-item"
                                    href="../user/profile.php?user=<?php echo $_SESSION['username']; ?>"><i
                                        class="bi bi-person-fill"></i>&nbsp;&nbsp; Profile</a></li>
                            <li><a class="dropdown-item" href="../user/logout.php"><i
                                        class="bi bi-box-arrow-right"></i>&nbsp;&nbsp; Logout</a></li>
                        </ul>
                    </div>
                    <button class="btn btn-light btn-nav" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" id="btnRanks" onclick="getRanks(false, true);"><i
                            class="bi bi-trophy-fill"></i></button>
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
                            <div class="progress-bar <?php echo $progressBg; ?> progress-bar-striped" role="progressbar"
                                aria-label="Example with label"
                                style="width: <?php echo $progress . "%"; ?>;" aria-valuenow=" 25" aria-valuemin="0"
                                aria-valuemax="100"><?php echo $progress . "%"; ?></div>
                        </div>
                        <div class="element-game">
                            <span><i class="bi bi-capslock-fill"></i> Level <?php echo $r['level']; ?>
                                &nbsp;&nbsp;</span>
                            <span><i class="bi bi-star-fill"></i> <span id="xpUser"><?php echo $r['xp']; ?> XP</span>
                                &nbsp;&nbsp;</span>
                            <span><i class="bi bi-diamond-fill"></i> <span
                                    id="pointsUser"><?php echo $r['point']; ?></span> Points</span>
                        </div>
                        <span style="display:block;clear:both;"></span>
                        <hr>
                        <a href="../user/course.php" class="btn btn-info-class">Kembali ke Corridor</a>
                        <a href="../user/home.php" class="btn btn-info-class mt-15">Kembali ke Home</a>
                    </div>
                    <div class="side-modules">
                        <h5>Daftar Modul</h5>
                        <hr>
                        <div class="module-lists bg-light">
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                            aria-expanded="false" aria-controls="flush-collapseOne">
                                            <b>Level 1: Diagram Alir (Flowchart)</b>
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse"
                                        aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
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
                                                                <span><i class="bi bi-star-fill"></i> +300
                                                                    &nbsp;&nbsp;</span>
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
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo"
                                            aria-expanded="false" aria-controls="flush-collapseTwo">
                                            <b>Level 2: Pseudocode</b>
                                        </button>
                                    </h2>
                                    <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                        aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
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
                                                        <div class="user-footprint" id="userFootprintC1"
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
                                                <li class="list-group-item" id="current-li">
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
																<span><i class="bi bi-diamond-fill"></i> Up to +25
																	&nbsp;&nbsp;</span>
																<span><i class="bi bi-star-fill"></i> Up to +500</span>
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
                    <h4>Challenge: Studi Kasus</h4>
                    <p>Selamat Anda telah mencapai di akhir-akhir level ini!! Untuk menerapkan pengetahuan yang telah kamu
                        dapat di level 2 ini, kami tantang anda untuk mengikuti challenge ini. Tentunya terdapat
                        beberapa keuntungan jika anda mengikuti challenge ini yakni mendapatkan poin sampai 300 points, 300 XP, dan 1
                        Badge (Lencana). Ayo ikuti challenge ini! Semakin banyak points dan xp yang kamu dapat, semakin
                        besar peluang anda memenangkan reward dari kami!</p>
                    <b>
                        <p>Ketentuan Challenge : </p>
                    </b>
                    <ol>
                        <li>Cari atau temukan permasalahan di kehidupan sehari-hari.</li>
                        <li>Buatlah langkah-langkah (algoritma) untuk menyelesaikan permasalahan tersebut. Anda bisa mengambil permasalahan dan algoritma dari challenge sebelumnya.</li>
                        <li>Setelah itu, buatlah pseudocode dari algoritma tersebut.</li>
                        <li>Share algoritma dan pseudocode anda di box share your knowledge di bawah ini.</li>
                        <li>Konten yang dibagikan harus memuat seluruh ketentuan dan tidak mengandung SARA dan
                            pornografi.</li>
                    </ol>
                    <?php
                        $sql = "SELECT * FROM tb_post WHERE id_user='$id_user' AND challenge='2' ORDER BY created_at DESC";
                        $res = mysqli_query($con, $sql);
                        $count = mysqli_num_rows($res);
                        if($count!=0){
                            $row = mysqli_fetch_assoc($res);
                            $status = $row['status'];
                        }
                        if($count== 0 || $status == 2){
                    ?>
                    <div class="share-wrapper">
                        <textarea id="shareBox"></textarea>
                        <center><button type="button" id="share" data-username="<?php echo $username; ?>" data-challenge='2'
                                onclick="share(this);" class="btn btn-primary mt-4">SHARE YOUR KNOWLEDGE&nbsp; <i
                                    class="bi bi-send-fill"></i></button></center>
                    </div>
                    <?php
                        }if($count!=0){
                    ?>
                    <div class="your-post">
                        <?php

									$sql = "SELECT * FROM tb_post WHERE id_user='$id_user' AND challenge='2' ORDER BY created_at DESC";
									$result = mysqli_query($con, $sql);
									while($r_post = mysqli_fetch_assoc($result)){
										$id_post = $r_post['id'];
										echo '
											<div class="post">
												<div class="top">
													<div class="top-photo">
														<img src= '. $r['photo_profile'] .' class="avatar">
													</div>
													<div class="top-name">
														<b><span><a class="no-undr" href="./profile.php?user='.$r['username'].'">'. $r['name'] .'</a></span></b><span>&nbsp;&nbsp;'. $r['username'] .'</span>
														<div class="control">';
														if($r_post['status']==0){
															echo '
																<span class="pending">Pending <i class="bi bi-clock"></i></span>
															';
														}else if($r_post['status']==1){
															echo '
																<span class="accepted">Diterima &#10003;</span>
															';
														}else{
															echo '
															<span class="rejected">Ditolak</span>
															';
														}
														echo '
														</div>
														<br>
														<span>'.$r_post['created_at'].'</span>
													</div>
												</div>
												<div class="content-post fr-view">
													'.$r_post['content'].'
												</div>';
										$curr_user_id = $_SESSION['user_id'];	
										$curr_username = $_SESSION['username'];
										$curr_photoProfile = $_SESSION['photo_profile'];
										mysqli_query($con, "CALL like_comment('$curr_user_id','$id_post',@liked,@likes,@comments)");
										$query_lico = "SELECT @liked,@likes,@comments";
										$hasil_lico = mysqli_query($con, $query_lico);
										$r_lico = mysqli_fetch_assoc($hasil_lico);
										echo '
												<div class="lico-section">
												';
												if($r_lico['@liked'] == 0){
													echo '<span id="like'.$id_post.'" data-id="'.$id_post.'" data-user="'.$curr_user_id.'" data-liked="'.$r_lico['@liked'].'" class="lico-button like-btn" style="color:#adadad;" onclick="likeBtn(this);"><i class="bi bi-heart-fill"></i></span><span class="amount me-3 likes" data-id="'.$id_post.'" id="likeAmount'.$id_post.'">'.$r_lico['@likes'].'</span>';
												}else{
													echo '<span id="like'.$id_post.'" data-id="'.$id_post.'" data-user="'.$curr_user_id.'" data-liked="'.$r_lico['@liked'].'" class="lico-button like-btn" style="color:#f00;" onclick="likeBtn(this);"><i class="bi bi-heart-fill"></i></span><span class="amount me-3 likes" data-id="'.$id_post.'" id="likeAmount'.$id_post.'">'.$r_lico['@likes'].'</span>';
												}
												echo '
													<span id="comment'.$id_post.'" data-id="'.$id_post.'" data-show="0" class="lico-button comment-btn" onclick="commBtn(this);"><i class="bi bi-chat-square-dots-fill"></i></span><span class="amount" id="commAmount'.$id_post.'">'.$r_lico['@comments'].'</span>
												</div>
												<div class="clear"></div>
												<div class="comment-section" id="comSect'.$id_post.'">
													<h6>Komentar &middot; <span id="commentAmount'.$id_post.'">'.$r_lico['@comments'].'</span></h6>
													<div id="comments'.$id_post.'">';

												$query_comments = "SELECT a.*, b.username, b.photo_profile FROM tb_comment_post AS a LEFT JOIN tb_user as b ON a.id_user = b.id WHERE a.id_post = '$id_post';";
												$hasil_comments = mysqli_query($con, $query_comments);
												while($r_comments = mysqli_fetch_array($hasil_comments)){
													echo '
														<div class="comment">
															<div class="image-profile">
																<img src="'.$r_comments['photo_profile'].'" class="avatar">
															</div>
															<div class="com-sect">
																<b><span><a class="no-undr" href="./profile.php?user='.$r_comments['username'].'">'.$r_comments['username'].'</a></span></b><span>&nbsp;&nbsp;'.$r_comments['created_at'].'</span><br>
																<p class="isi-comment">'.$r_comments['comment'].'</p>
															</div>
														</div>
													';
												}
												echo'
													</div>
													<div class="comment-form">
														<div class="input-comment">
															<textarea class="form-control comment-control" placeholder="Tulis komentar di sini" id="commentBox'.$id_post.'" data-id="'.$id_post.'" oninput="onInput(this);"></textarea>
														</div>
														<div class="send-comment">
															<div class="send" id="send'.$id_post.'" data-id="'.$id_post.'" data-username="'. $curr_username.'" data-profile="'. $curr_photoProfile .'" data-user="'. $curr_user_id.'" onclick="sendComment(this);">
																<i class="bi bi-send-fill"></i>
															</div>
														</div>
														<div class="clear"></div>
													</div>
												</div>
											</div>
										';
									}
								?>

                    </div>
					<br>
					
                    <?php
						}
						$sql = "SELECT * FROM tb_post WHERE id_user='$id_user' AND challenge='2' AND `status`='1'";
						$result = mysqli_query($con, $sql);
						$cnt = mysqli_num_rows($result);
						if($cnt !=0){
							$row = mysqli_fetch_assoc($result);
							$nilai = $row['grade'];
							if($nilai=='A'){
								$point = 300;
							}else if($nilai=='B'){
								$point = 200;
							}else{
								$point = 100;
							}
					?>
                    <p><b>Selamat! Anda telah menyelesaikan Challenge ini. Reward yang kamu dapat :</b></p>
					<table class="table" style="width: 50%;">
						<tbody>
							<tr>
								<th>XP</th>
								<td>300</td>
							</tr>
							<tr>
								<th>Points</th>
								<td><?php echo $point; ?></td>
							</tr>
							<tr>
								<th>Nilai</th>
								<td><?php echo $nilai; ?></td>
							</tr>
							<tr>
								<th>Badges</th>
								<td><img src="../images/badges/analis-logika.png" alt="" width="100%" height="auto"></td>
							</tr>
						</tbody>
					</table>
                    <?php
                        }
                        ?>
                    <button class="btn btn-course" id="previous" data-prev="10">Sebelumnya</button>
                    <button class="btn btn-course f-right" id="next" data-next="12" data-curr="<?php echo $currCourse ?>"
                        data-reward='0' data-username="<?php echo $_SESSION['username']; ?>" data-user="<?php echo $idUser; ?>" data-materi="Challenge 1" data-artikel="0">Berikutnya</button>
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
                    <button type="button" class="btn btn-primary main-bg-color" onclick="getNextCourse(7,<?php echo $currCourse ?>,'<?php echo $_SESSION['username']; ?>')">Next Course</button>
                </div>
            </div>
        </div>
    </div>
    <div id="tsparticles"></div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
    integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tsparticles/2.9.3/tsparticles.min.js"
    integrity="sha512-+YPbXItNhUCZR3fn5KeWPtJrXuoqRYQ4Gd1rIjEFG+h8UJYekebhOMh84vv7q+Y1sy5kdIIVtfftehCiigriMQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/tsparticles-preset-confetti@2/tsparticles.preset.confetti.bundle.min.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.15.2/ace.js"
    integrity="sha512-NSbvq6xPdfFIa2wwSh8vtsPL7AyYAYRAUWRDCqFH34kYIjQ4M7H2POiULf3CH11TRcq3Ww6FZDdLZ8msYhMxjg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js">
</script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/froala-editor@latest/js/plugins/image.min.js"></script>
<script type="text/javascript" src="../js/courses/courses.js"></script>

</html>