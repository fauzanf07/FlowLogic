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
        $id_user= $r['id'];

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
<!--COURSE 4 -->
<!DOCTYPE html>
<html>

<head>
    <title>Pengenalan Pseudocode</title>
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
            <a class="navbar-brand" href="#"> <i class="bi bi-code-square"></i> FlowLogic</a>
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
                                                <li class="list-group-item" id="current-li">
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
                                                <li class="list-group-item">
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
                    <p>Selamat anda sudah mencapai di level 2! Di dalam level 2 ini anda akan mempelajari mengenai pseudocode yang mana pseudocode ini salah satu cara penyajian algoritma seperti flowchart namun pada pseudocode ini hampir mirip dengan bahasa pemrograman dibanding dengan Flowchart. Untuk informasi lebih lanjut mari kita simak berikut ini!</p>
                    <h4>Pengenalan pseudocode?</h4><br>
                    <center><img src="../images/pseudocode.jpg" width="60%" height="auto"></center><br>
                    <p><b>Pseudocode</b> menggabungkan kata <b>"pseudo"</b> yang berarti tiruan atau imitasi, dan <b>"code"</b> yang merujuk pada kode yang terkait dengan instruksi yang ditulis dalam bahasa komputer (bahasa pemrograman). Dalam terjemahan sederhana, pseudocode adalah imitasi atau tiruan dari kode bahasa pemrograman. Dalam dasarnya, pseudocode adalah bahasa yang digunakan oleh para programmer untuk memikirkan masalah yang perlu dipecahkan tanpa harus memperhatikan sintaksis dari bahasa pemrograman tertentu. Tidak ada aturan tertentu dalam penulisan sintaksis dalam pseudocode. Oleh karena itu, pseudocode digunakan untuk menggambarkan logika urutan langkah dalam program tanpa memperhatikan bahasa pemrograman yang digunakan. Meskipun pseudocode tidak memiliki aturan penulisan sintaksis, pada level ini akan memberikan beberapa aturan penulisan sintaksis yang sederhana agar pembaca dapat lebih mudah mempelajari algoritma-algoritma yang ada dalam level ini.</p>
                    <p>Begini, sekarang anda lihat bahasa pemrograman di bawah ini.</p><br>
                    <center><img src="../images/contoh-algoritma.png" width="60%" height="auto"></center><br>
                    <p>Apakah anda yakin bahwa semua orang bahkan orang awam akan mengerti mengenai bahasa pemrograman C diatas? Tentu saja tidak karena tidak semua orang memahami bahasa pemrograman C. Sekarang bandingkan dengan bahasa pseudocode dibawah ini.</p>
                    <center><img src="../images/contoh-pseudocode.png" width="60%" height="auto"></center><br>
                    <p>Apakah cara penyajian algoritma menentukan bilangan ganjil lebih mudah dimengerti melalui bahasa pemrograman atau pseudocode? Anda pasti merasakan bahwa cara penyajian pseudocode lebih mudah dimengerti dibandingkan dengan bahasa pemrograman karena pseudocode ini disajikan dengan bahasa sehari-hari. Umumnya, pseudocode ditulis dengan bahasa Inggris karena lebih mudah ketika mengkonversikannya ke bahasa pemrograman. Tapi juga tidak masalah jika Anda menggunakan bahasa Indonesia.</p>
                    <br><h4>Apa fungsi pseudocode?</h4><br>
                    <p>Seperti yang dijelaskan diatas bahwa pseudocode digunakan oleh para programmer untuk memikirkan masalah yang perlu dipecahkan tanpa harus memperhatikan sintaksis dari bahasa pemrograman tertentu. Namun terdapat beberapa fungsi pseudocode lagi, yakni sebagai berikut.</p>
                    <ol>
                        <h5><li>Sebagai media dokumentasi</li></h5>
                        <p>Dokumentasi berperan penting sebagai panduan untuk memastikan bahwa proses perancangan program sesuai dengan harapan. Dokumentasi merupakan elemen krusial dalam pembangunan proyek, karena akan dibutuhkan oleh para programmer untuk mengecek logika program jika terjadi error atau bug di masa yang akan datang.</p>
                        <h5><li>Sebagai Titik Tengah Antara Flowchart dan Kode</li></h5>
                        <p>Bagi pengembang yang baru memulai, seringkali mengalami kesulitan dalam mengubah alur diagram atau flowchart menjadi kode pemrograman. Namun, pseudocode hadir sebagai jembatan yang baik, karena membantu dalam melakukan transisi secara efektif dan efisien.</p>
                        <h5><li>Sebagai Jembatan Komunikasi</li></h5>
                        <p>Pseudocode berfungsi sebagai jembatan yang memungkinkan seorang programmer berkolaborasi dengan anggota tim dari berbagai divisi seperti mitra bisnis, manajer, desainer, dan lainnya. Dengan menggunakan pseudocode, programmer dapat dengan mudah menjelaskan bagaimana mekanisme kode bekerja, yang pada gilirannya meningkatkan efektivitas komunikasi.</p>
                        <h5><li>Mempercepat Proses Penyelesaian</li></h5>
                        <p>Tujuan utama penggunaan pseudocode adalah untuk mempercepat proses pembuatan sistem. Berbeda dengan diagram alur yang memiliki format dan struktur yang agak sulit dipahami secara langsung, pseudocode menggunakan struktur yang sederhana dan mudah dibaca. Ini juga membuatnya lebih mudah untuk dimodifikasi.</p>
                        <p>Dengan pseudocode, proses konversi ke dalam bahasa pemrograman tidak memerlukan waktu yang lama, karena alur algoritma telah digambarkan dengan jelas.</p>
                    </ol>
                    <p>Menerapkan pseudocode akan memberi banyak manfaat. Misalnya, Anda dapat mengurangi kesalahan ketika melakukan coding, karena hanya tinggal melihat alur yang telah dituangkan dalam pseudocode.</p>
                    <p>Berkat pseudocode juga, proses coding akan menjadi lancar dan hasil akhir proyek website Anda pun akan menjadi bagus.</p>
                    <button class="btn btn-course" id="previous" data-prev="6">Sebelumnya</button>
                    <button class="btn btn-course f-right" id="next" data-next="8" data-curr="<?php echo $currCourse ?>"
                        data-reward='0' data-username="<?php echo $_SESSION['username']; ?>" data-user="<?php echo $idUser; ?>" data-materi="Pengenalan Pseudocode" data-artikel="1">Berikutnya</button>
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
                    <button type="button" class="btn-close btn-close-levelUp" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body body-levelUp">
                    <center><img width="55%" height="auto" src="../images/level-up.gif" /></center>
                    <center>
                        <h4 class="levelUp-desc"></h4>
                    </center>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-close-levelUp"
                        data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary main-bg-color">Next Course</button>
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