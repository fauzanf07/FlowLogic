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
		$progress = intval(($_SESSION['curr_course']/8)*100);
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
    <title>Notasi Algoritmik</title>
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
                                                <li class="list-group-item" id="current-li">
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
                    <h4>Notasi Algoritmik</h4>
                    <p>Masih berhubung dengan artikel sebelumnya, pada artikel ini kita akan membahas bagaimana menulis notasi-notasi umum yang ada di bahasa pemrograman kedalam notasi algoritmik di Pseudocode. Tanpa basa-basi lagi, berikut adalah bagaimana notasi-notasi umum yang ada di bahasa pemrograman dituliskan dalam notasi algoritmik pada Pseudocode. </p>
                    <ol>
                        <li>
                            <h5><i>Variable Assignment</i></h5>
                            <p><i>Variable Assignment</i> merupakan pengisian atau penyimpanan nilai ke dalam sebuah variabel. <i>Assignment Variable</i> pada umumnya menggunakan = di dalam bahasa pemrograman contohnya pada bahasa C, C++, Java, Python, dll. Ada juga yang menggunakan := seperti di dalam bahasa pemrograman Pascal dan Ada. Nah untuk di Pseudocode penulisan <i>Assignment Variable</i> ini kita menggunakan simbol &#8592;. Contohnya seperti berikut.</p>
                            <center><code>max &#8592; x</code></center>
                            <p>Notasi algoritmik diatas mengandung arti bahwa variabel max akan menyimpan nilai yang ada di variabel x. Notasi algoritmik tersebut setara dengan <code>max = x;</code> pada bahasa C atau <code>max := x;</code> pada bahasa Pascal.</p>
                        </li>
                        <li>
                            <h5>Operasi Matematika</h5>
                            <p>Operasi matematika seperti penjumlahan, pengurangan, perkalian, dan pembagian juga perlu dituliskan dalam notasi algoritmik di Pseudocode karena operasi matematika ini sangat sering digunakan dalam bahasa pemrograman. Berikut ini adalah contoh penulisan notasi algoritmik untuk operasi matematika umum:</p>
                            <ul>
                                <li><b>Penjumlahan:</b></li>
                                <center><code>hasil ← a + b</code></center>
                                <p>Artinya, variabel "hasil" akan menyimpan hasil penjumlahan antara variabel "a" dan "b".</p>
                                <li><b>Pengurangan</b></li>
                                <center><code>selisih ← x - y</code></center>
                                <p>Artinya, variabel "selisih" akan menyimpan hasil pengurangan antara variabel "x" dan "y".</p>
                                <li><b>Perkalian:</b></li>
                                <center><code>hasil ← c * d</code></center>
                                <p>Artinya, variabel "hasil" akan menyimpan hasil perkalian antara variabel "c" dan "d".</p>
                                <li><b>Pembagian:</b></li>
                                <center><code>hasil ← p / q</code></center>
                                <p>Artinya, variabel "hasil" akan menyimpan hasil pembagian antara variabel "p" dan "q".</p>
                            </ul>
                        </li>
                        <li>
                            <h5>Operator Perbandingan</h5>
                            <p>Operator perbandingan dalam notasi algoritmik Pseudocode digunakan untuk membandingkan dua nilai atau variabel. Hasil perbandingan ini akan menghasilkan nilai kebenaran (boolean) yaitu True (benar) atau False (salah). Berikut adalah beberapa contoh operator perbandingan dan cara penulisannya dalam notasi algoritmik Pseudocode:</p>
                            <table class="table">
                                <tr>
                                    <th>Operator</th>
                                    <th>Notasi Algoritmik</th>
                                </tr>
                                <tr>
                                    <td>Perbandingan Sama Dengan (==)</td>
                                    <td>
                                        <code>
<pre>
if variable1 == variable2 then
    // pernyataan jika variable1 sama dengan variable2
else
    // pernyataan jika variable1 tidak sama dengan variable2
end if
</pre>

                                        </code>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Perbandingan Tidak Sama Dengan (!=)</td>
                                    <td>
                                        <code>
<pre>
if variable1 != variable2 then
    // pernyataan jika variable1 sama dengan variable2
else
    // pernyataan jika variable1 tidak sama dengan variable2
end if
</pre>

                                        </code>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Perbandingan Lebih Besar (>)</td>
                                    <td>
                                        <code>
<pre>
if variable1 > variable2 then
    // pernyataan jika variable1 lebih besar dari variable2
else
    // pernyataan jika variable1 tidak lebih besar dari variable2
end if
</pre>

                                        </code>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Perbandingan Lebih Kecil (<)</td>
                                    <td>
                                        <code>
<pre>
if variable1 < variable2 then
    // pernyataan jika variable1 lebih kecil dari variable2
else
    // pernyataan jika variable1 tidak lebih kecil dari variable2
end if
</pre>

                                        </code>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Perbandingan Lebih Besar Sama Dengan (>=)</td>
                                    <td>
                                        <code>
<pre>
if variable1 >= variable2 then
    // pernyataan jika variable1 lebih besar atau sama dengan variable2
else
    // pernyataan jika variable1 tidak lebih besar atau sama dengan variable2
end if
</pre>

                                        </code>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Perbandingan Lebih Kecil Sama Dengan (<=)</td>
                                    <td>
                                        <code>
<pre>
if variable1 <= variable2 then
    // pernyataan jika variable1 lebih kecil atau sama dengan variable2
else
    // pernyataan jika variable1 tidak lebih kecil atau sama dengan variable2
end if

</pre>

                                        </code>
                                    </td>
                                </tr>
                            </table>
                        </li>
                        <li>
                            <h5><i>Conditional Statements</i></h5>
                            <p>Pada bahasa pemrograman, kita sering menggunakan statement kondisional seperti if-else untuk membuat keputusan berdasarkan kondisi tertentu. Berikut adalah contoh penulisan notasi algoritmik untuk statement kondisional:</p>
                            <code><pre>
if x > y then
    write("x lebih besar dari y")
else then
    write("y lebih besar dari x")
end if
                            </pre></code>
                            <p>Notasi algoritmik diatas menggambarkan penggunaan statement kondisional if-else dalam membandingkan nilai variabel "x" dan "y".</p>
                        </li>
                        <li>
                            <h5><i>Looping</i></h5>
                            <p>Looping atau perulangan digunakan untuk mengulang sebuah blok perintah berulang kali selama kondisi tertentu terpenuhi. Berikut adalah contoh penulisan notasi algoritmik untuk perulangan:</p>
                            <ul>
                                <li><b>Perulangan While:</b></li>
                                <code>
                                    <pre>

while (kondisi terpenuhi)
    ...(blok perintah)...
end while </pre>
                                </code>
                                <p>Notasi algoritmik di atas mengindikasikan bahwa blok perintah akan terus dijalankan selama kondisi terpenuhi. Berikut contoh pseudocode yang terdapat perulangan while.</p>
                                <center><img src="../images/contoh-while-pse.png" width="25%" height="auto" alt=""></center>
                                <li><b>Perulangan For:</b></li>
                                <code>
                                    <pre>

for (iterasi)
    ...(blok perintah)...
end for </pre>
                                </code>
                                <p>Notasi algoritmik ini menunjukkan bahwa blok perintah akan dijalankan untuk setiap elemen dalam kumpulan data.Berikut contoh pseudocode yang terdapat perulangan for.</p>
                                <center><img src="../images/contoh-for-pse.png" width="25%" height="auto" alt=""></center>
                            </ul>
                        </li>
                        <li>
                            <h5>Prosedur</h5>
                            <p>Prosedur adalah blok kode yang dapat dipanggil dan digunakan berulang kali dalam sebuah program. Berikut adalah contoh penulisan notasi algoritmik untuk prosedur:</p>
                            <code>
                                <pre>

Prosedur nama_prosedur(input (<i>tipe data</i>) (<i>parameter)</i>)

Deskripsi
    (variabel dan tipe data)

Deklarasi
    (blok program)
</pre>
                            </code>
                            <p>Notasi algoritmik di atas menunjukkan struktur dasar untuk mendefinisikan sebuah prosedur dengan nama "nama_prosedur" dan menerima parameter jika diperlukan. Contoh prosedur pada pseudocode.</p>
                            <center><img src="../images/contoh-prosedur-pse.png" width="30%" height="auto" alt=""></center>
                        </li>
                        <li>
                            <h5>Fungsi</h5>
                            <p>Fungsi adalah blok kode yang mengembalikan nilai tertentu setelah dieksekusi. Hampir sama dengan penulisan notasi algoritmik untuk prosedur, berikut adalah contoh penulisan notasi algoritmik untuk fungsi:</p>
                            <code>
                                <pre>

Fungsi nama_fungsi(input (<i>tipe data</i>) (<i>parameter)</i>; output (<i>tipe data</i>) (<i>nilai)</i>)

Deskripsi
    (variabel dan tipe data)

Deklarasi
    (blok program)
    return (nilai)
</pre>
                            </code>
                            <p>Notasi algoritmik di atas menunjukkan struktur dasar untuk mendefinisikan sebuah fungsi dengan nama "nama_fungsi" dan menerima parameter jika diperlukan. Fungsi tersebut akan mengembalikan nilai setelah eksekusi.</p>
                            <center><img src="../images/contoh-fungsi-pse.png" width="40%" height="auto" alt=""></center>
                            <p>Jika kita perhatikan, terdapat dua pendefinisian yang ada di dalam kurung setelah nama fungsi yakni input dan output. Apa bedanya? Pendefinisian input yang terdapat di fungsi tersebut merupakan parameter-paramater yang akan diterima oleh fungsi tersebut. Sedangan pada pendefinisian output pada fungsi tersebut merupakan sebuah nilai yang akan dikeluarkan oleh fungsi tersebut.</p>
                        </li>
                    </ol>
                    <p>Dengan mengetahui cara menulis notasi-notasi umum bahasa pemrograman dalam notasi algoritmik di Pseudocode, kita dapat dengan lebih mudah merancang algoritma dan memahami logika pemrograman tanpa harus terikat dengan sintaksis dari bahasa pemrograman tertentu. Notasi algoritmik memberikan fleksibilitas dan pemahaman yang lebih luas dalam menyusun algoritma secara umum.</p>
                    <div style="clear:both;"></div>
                    <button class="btn btn-course" id="previous" data-prev="8">Sebelumnya</button>
                    <button class="btn btn-course f-right" id="next" data-next="10" data-curr="<?php echo $currCourse ?>"
                        data-reward='0' data-username="<?php echo $_SESSION['username']; ?>" data-user="<?php echo $idUser; ?>" data-materi="Notasi Algoritmik" data-artikel="1">Berikutnya</button>
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