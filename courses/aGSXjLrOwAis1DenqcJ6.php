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
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"
                id="closeRanks"></button>
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
                <button type="button" class="btn btn-outline-secondary" id="loadRanksMore"
                    onclick="getRanks(true, false);">Load More</button>
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
                        data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" id="btnRanks"
                        onclick="getRanks(false, true);"><i class="bi bi-trophy-fill"></i></button>
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
                                aria-label="Example with label" style="width: <?php echo $progress . "%"; ?>;"
                                aria-valuenow=" 25" aria-valuemin="0" aria-valuemax="100"><?php echo $progress . "%"; ?>
                            </div>
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
                                                <li class="list-group-item" id="current-li">
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
                    <h4>Challenge: Studi Kasus</h4>
                    <?php
                        $sql = "SELECT * FROM tb_open_access WHERE id_user='$id_user' AND challenge='3'";
                        $res = mysqli_query($con, $sql);
                        $count = mysqli_num_rows($res);
                        if($count==0){
                    ?>
                    <p>Challenge ini masih terkunci. Untuk membukanya, kamu perlu membayar dengan 600 XP. Setelah
                        membayar, kamu akan dapat mengakses dan mengikuti Challenge ini. XP yang kamu bayarkan akan
                        dikurangi dari total XP yang kamu miliki. Jika kamu memiliki cukup XP, silakan lanjutkan
                        pembayaran untuk membuka Challenge dan menikmati tantangan yang ada.</p>
                    <center><button class="btn btn-primary" id="bukaChall"
                            onclick="openAccess(<?php echo $id_user; ?>,3,0,0)">Buka Challenge &nbsp;<i
                                class="bi bi-key-fill"></i></button></center>
                    <br><br>
                    <?php
                        }else{

                    ?>
                    <p>Selamat Anda telah mencapai di akhir-akhir level ini!! Untuk menerapkan pengetahuan yang telah
                        kamu
                        dapat di level 3 ini, kami tantang anda untuk mengikuti challenge ini. Tentunya terdapat
                        beberapa keuntungan jika anda mengikuti challenge ini yakni mendapatkan poin sampai 165 points,
                        200 XP, dan 1
                        Badge (Lencana). Ayo ikuti challenge ini! Semakin banyak points dan xp yang kamu dapat, semakin
                        besar peluang anda memenangkan reward dari kami!</p>
                    <b>
                        <p>Ketentuan Challenge : </p>
                    </b>
                    <ol>
                        <li>Yang harus kamu lakukan pada challenge ini ialah hanya mengis kode rumpang pada setiap studi kasus yang diberikan hingga kode tersebut dapat dijalankan dan sesuai dengan output yang diharapkan.</li>
                        <li>Program di dalam semua studi kasus ini tidak memerlukan input apapun baik di dalam prosedur maupun fungsi. Jadi kamu cukup memasukan nilai atau variabel yang telah disediakan ke dalam fungsi atau prosedur.</li>
                        <li>Pastikan tombol RUN pada studi kasus berubah menjadi warna hijau ketika studi kasus berhasil diselesaikan dan Anda akan melihat daftar user tercepat dalam menyelesaikan studi kasus tersebut.</li>
                        <li>Setiap studi kasus memiliki rewards yang dapat diperoleh jika kamu menyelesaikan studi kasus tersebut.</li>
                        <li>Jika kamu telah menyelesaikan semua studi kasus di dalam challenge ini, kamu akan mendapatkan sebuah lencana. Jadi pastikan anda menyelesaikan semua studi kasus ini!</li>
                    </ol>
                    <div class="challenge-box">
                        <div id="carouselExampleControlsNoTouching" class="carousel slide" data-bs-touch="false">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <?php
                                        $sql = "SELECT * FROM tb_challenge_code WHERE id_user = '$idUser' AND sk='1'";
                                        $query1 = mysqli_query($con,$sql);
                                        $result1 = mysqli_fetch_assoc($query1);
                                        $exist = mysqli_num_rows($query1);
                                        $button = $exist!=0 ? 'btn-success' : 'btn-primary';
                                        $display = $exist!=0 ? 'block' : 'none';
                                        if($exist!=0){
                                            $sql = "SELECT a.*, b.name FROM tb_challenge_code as a LEFT JOIN tb_user as b on a.id_user= b.id WHERE a.sk='1' ORDER BY a.submit_at DESC";
                                            $query2 = mysqli_query($con,$sql);
                                        }
                                    ?>
                                    <h4>Studi Kasus 1 (20 point, 30 XP)</h4>
                                    <div class="container">
                                        <div class="row">
                                            <b>Output yang diharapkan : </b>
                                            <p>Hasil penjumlahan: 25</p>
                                            <div class="col-lg-6">

                                                <select class="form-select lang-list"
                                                    aria-label="Default select example">
                                                    <option value="6 c_cpp">C (gcc)</option>
                                                </select><button type="button" id="button0"
                                                    class="btn <?php echo $button; ?> float-end" id="run"
                                                    <?php if($exist==0){ ?>onclick="run(<?php echo $idUser; ?>,0,'Hasil penjumlahan: 25',20,30);" <?php } ?>><i
                                                        class="bi bi-play-fill"></i> RUN</button>
                                                <pre id="editor" class="editor">
<?php
if($exist==0){
?>
#include &lt;stdio.h&gt;

// Deklarasikan prototipe fungsi dengan parameter formal
....

int main() {
    int a = 10;
    int b = 15;

    // Panggil fungsi addNumbers dengan parameter aktual
    printf("Hasil penjumlahan: %d", ...);
    return 0;
}

//Isi dengan parameter formal yang sesuai
int addNumbers(...,...) {
    int sum = num1 + num2;
    return sum;
}
<?php
}else{
    echo $result1['code'];
}
?>
                                        </pre>
                                            </div>
                                            <div class="col-lg-6">
                                                <h3>Result</h3>
                                                <div class="preview-code" id="preview-code0">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <table class="table" id="table0" style="display: <?php echo $display; ?>;">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Nama</th>
                                                <th scope="col">Submit dengan benar pada</th>
                                            </tr>
                                        </thead>
                                        <tbody id="rank-table0">
                                            <?php
                                                if($exist!=0){
                                                    $i=1;
                                                    while($row =mysqli_fetch_assoc($query2))
                                                    {
                                                        echo "
                                                            <tr>
                                                                <td>".$i."</td>
                                                                <td>".$row['name']."</td>
                                                                <td>".$row['submit_at']."</td>
                                                            </tr>
                                                        ";
                                                        $i++;
                                                    }
                                                    
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                    <button class="btn-challenge next-chll" type="button"
                                        data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next"
                                        id="nextSoal1">Next</button>
                                </div>
                                <div class="carousel-item ">
                                    <?php
                                        $sql = "SELECT * FROM tb_challenge_code WHERE id_user = '$idUser' AND sk='2'";
                                        $query1 = mysqli_query($con,$sql);
                                        $result1 = mysqli_fetch_assoc($query1);
                                        $exist = mysqli_num_rows($query1);
                                        $button = $exist!=0 ? 'btn-success' : 'btn-primary';
                                        $display = $exist!=0 ? 'block' : 'none';
                                        if($exist!=0){
                                            $sql = "SELECT a.*, b.name FROM tb_challenge_code as a LEFT JOIN tb_user as b on a.id_user= b.id WHERE a.sk='2' ORDER BY a.submit_at DESC";
                                            $query2 = mysqli_query($con,$sql);
                                        }
                                    ?>
                                    <h4>Studi Kasus 2 (25 point, 35 XP)</h4>
                                    <div class="container">
                                        <div class="row">
                                            <b>Output yang diharapkan : </b>
                                            <p>Luas lingkaran dengan jari-jari 10.00 adalah 314.00</p>
                                            <div class="col-lg-6">

                                                <select class="form-select lang-list"
                                                    aria-label="Default select example">
                                                    <option value="6 c_cpp">C (gcc)</option>
                                                </select><button type="button" id="button1"
                                                    class="btn <?php echo $button; ?> float-end" id="run"
                                                    <?php if($exist==0){ ?>onclick="run(<?php echo $idUser; ?>,1,'Luas lingkaran dengan jari-jari 10.00 adalah 314.00',25,35);" <?php } ?>><i
                                                        class="bi bi-play-fill"></i> RUN</button>
                                                <pre id="editor" class="editor">
<?php
if($exist==0){
?>
#include &lt;stdio.h&gt;

//Deklarasikan variabel global phi
... = 3.14;

//Deklarasikan fungsi hitungLuasLingkaran
...

int main() {
    float radius = 10;

    //Panggil fungsi hitungLuasLingkaran dengan parameter aktual
    float luas = ...;
    
    printf("Luas lingkaran dengan jari-jari %.2f adalah %.2f", radius, luas);
    
    return 0;
}

//Isikan tipe data fungsi dengan sesuai
... hitungLuasLingkaran(float radius) {
    float luas = phi * radius * radius;
    return luas;
}

<?php
}else{
    echo $result1['code'];
}
?>
                                        </pre>
                                            </div>
                                            <div class="col-lg-6">
                                                <h3>Result</h3>
                                                <div class="preview-code" id="preview-code1">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <table class="table" id="table1" style="display: <?php echo $display; ?>;">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Nama</th>
                                                <th scope="col">Submit dengan benar pada</th>
                                            </tr>
                                        </thead>
                                        <tbody id="rank-table1">
                                            <?php
                                                if($exist!=0){
                                                    $i=1;
                                                    while($row =mysqli_fetch_assoc($query2))
                                                    {
                                                        echo "
                                                            <tr>
                                                                <td>".$i."</td>
                                                                <td>".$row['name']."</td>
                                                                <td>".$row['submit_at']."</td>
                                                            </tr>
                                                        ";
                                                        $i++;
                                                    }
                                                    
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                    <button class="btn-challenge" type="button"
                                        data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="previous"
                                        id="previousSoal2">Previous</button>
                                    <button class="btn-challenge next-chll" type="button"
                                        data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next"
                                        id="nextSoal2">Next</button>
                                </div>
                                <div class="carousel-item ">
                                    <?php
                                        $sql = "SELECT * FROM tb_challenge_code WHERE id_user = '$idUser' AND sk='3'";
                                        $query1 = mysqli_query($con,$sql);
                                        $result1 = mysqli_fetch_assoc($query1);
                                        $exist = mysqli_num_rows($query1);
                                        $button = $exist!=0 ? 'btn-success' : 'btn-primary';
                                        $display = $exist!=0 ? 'block' : 'none';
                                        if($exist!=0){
                                            $sql = "SELECT a.*, b.name FROM tb_challenge_code as a LEFT JOIN tb_user as b on a.id_user= b.id WHERE a.sk='3' ORDER BY a.submit_at DESC";
                                            $query2 = mysqli_query($con,$sql);
                                        }
                                    ?>
                                    <h4>Studi Kasus 3 (30 point, 40 XP)</h4>
                                    <div class="container">
                                        <div class="row">
                                            <b>Output yang diharapkan : </b>
                                            <p>Keliling persegi panjang: 50</p>
                                            <div class="col-lg-6">

                                                <select class="form-select lang-list"
                                                    aria-label="Default select example">
                                                    <option value="6 c_cpp">C (gcc)</option>
                                                </select><button type="button" id="button2"
                                                    class="btn <?php echo $button; ?> float-end" id="run"
                                                    <?php if($exist==0){ ?>onclick="run(<?php echo $idUser; ?>,2,'Keliling persegi panjang: 50',30,40);" <?php } ?>><i
                                                        class="bi bi-play-fill"></i> RUN</button>
                                                <pre id="editor" class="editor">
<?php
if($exist==0){
?>
#include &lt;stdio.h&gt;

//Deklarasikan prototipe prosedur hitungKeliling
...

int main() {
    int panjang =20;
    int lebar = 5;
    int keliling;

    //Panggil prosedur hitungKeliling
    ... 

    printf("Keliling persegi panjang: %d", keliling);
    return 0;
}

void hitungKeliling(int panjang, int lebar, int* keliling) {
    ...
}

<?php
}else{
    echo $result1['code'];
}
?>
                                        </pre>
                                            </div>
                                            <div class="col-lg-6">
                                                <h3>Result</h3>
                                                <div class="preview-code" id="preview-code2">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <table class="table" id="table2" style="display: <?php echo $display; ?>;">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Nama</th>
                                                <th scope="col">Submit dengan benar pada</th>
                                            </tr>
                                        </thead>
                                        <tbody id="rank-table2">
                                            <?php
                                                if($exist!=0){
                                                    $i=1;
                                                    while($row =mysqli_fetch_assoc($query2))
                                                    {
                                                        echo "
                                                            <tr>
                                                                <td>".$i."</td>
                                                                <td>".$row['name']."</td>
                                                                <td>".$row['submit_at']."</td>
                                                            </tr>
                                                        ";
                                                        $i++;
                                                    }
                                                    
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                    <button class="btn-challenge" type="button"
                                        data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="previous"
                                        id="previousSoal3">Previous</button>
                                    <button class="btn-challenge next-chll" type="button"
                                        data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next"
                                        id="nextSoal3">Next</button>
                                </div>
                                <div class="carousel-item ">
                                    <?php
                                        $sql = "SELECT * FROM tb_challenge_code WHERE id_user = '$idUser' AND sk='4'";
                                        $query1 = mysqli_query($con,$sql);
                                        $result1 = mysqli_fetch_assoc($query1);
                                        $exist = mysqli_num_rows($query1);
                                        $button = $exist!=0 ? 'btn-success' : 'btn-primary';
                                        $display = $exist!=0 ? 'block' : 'none';
                                        if($exist!=0){
                                            $sql = "SELECT a.*, b.name FROM tb_challenge_code as a LEFT JOIN tb_user as b on a.id_user= b.id WHERE a.sk='4' ORDER BY a.submit_at DESC";
                                            $query2 = mysqli_query($con,$sql);
                                        }
                                    ?>
                                    <h4>Studi Kasus 4 (40 point, 45 XP)</h4>
                                    <div class="container">
                                        <div class="row">
                                            <b>Output yang diharapkan : </b>
                                            <p>RETUPMOK</p>
                                            <div class="col-lg-6">

                                                <select class="form-select lang-list"
                                                    aria-label="Default select example">
                                                    <option value="6 c_cpp">C (gcc)</option>
                                                </select><button type="button" id="button3"
                                                    class="btn <?php echo $button; ?> float-end" id="run"
                                                    <?php if($exist==0){ ?>onclick="run(<?php echo $idUser; ?>,3,'RETUPMOK',40,45);" <?php } ?>><i
                                                        class="bi bi-play-fill"></i> RUN</button>
                                                <pre id="editor" class="editor">
<?php
if($exist==0){
?>
#include &lt;stdio.h&gt;
#include &lt;string.h&gt;

//Deklarasikan prototipe prosedur
...

int main() {
    char kata[8] = "KOMPUTER";

    balikKata(kata);

    return 0;
}

void balikKata(char kata[8]) {
    //isi dengan kode yang menghasilkan output yang benar
    ...
}

<?php
}else{
    echo $result1['code'];
}
?>
                                        </pre>
                                            </div>
                                            <div class="col-lg-6">
                                                <h3>Result</h3>
                                                <div class="preview-code" id="preview-code3">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <table class="table" id="table3" style="display: <?php echo $display; ?>;">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Nama</th>
                                                <th scope="col">Submit dengan benar pada</th>
                                            </tr>
                                        </thead>
                                        <tbody id="rank-table3">
                                            <?php
                                                if($exist!=0){
                                                    $i=1;
                                                    while($row =mysqli_fetch_assoc($query2))
                                                    {
                                                        echo "
                                                            <tr>
                                                                <td>".$i."</td>
                                                                <td>".$row['name']."</td>
                                                                <td>".$row['submit_at']."</td>
                                                            </tr>
                                                        ";
                                                        $i++;
                                                    }
                                                    
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                    <button class="btn-challenge" type="button"
                                        data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="previous"
                                        id="previousSoal4">Previous</button>
                                    <button class="btn-challenge next-chll" type="button"
                                        data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next"
                                        id="nextSoal4">Next</button>
                                </div>
                                <div class="carousel-item ">
                                    <?php
                                        $sql = "SELECT * FROM tb_challenge_code WHERE id_user = '$idUser' AND sk='5'";
                                        $query1 = mysqli_query($con,$sql);
                                        $result1 = mysqli_fetch_assoc($query1);
                                        $exist = mysqli_num_rows($query1);
                                        $button = $exist!=0 ? 'btn-success' : 'btn-primary';
                                        $display = $exist!=0 ? 'block' : 'none';
                                        if($exist!=0){
                                            $sql = "SELECT a.*, b.name FROM tb_challenge_code as a LEFT JOIN tb_user as b on a.id_user= b.id WHERE a.sk='5' ORDER BY a.submit_at DESC";
                                            $query2 = mysqli_query($con,$sql);
                                        }
                                    ?>
                                    <h4>Studi Kasus 5 (50 point, 50 XP)</h4>
                                    <div class="container">
                                        <div class="row">
                                            <b>Deskripsi</b>
                                            <p>Buatlah sebuah program yang menampilkan pola bilangan berikut sampai suku ke-10. Pola bilangan : 2,8,18,32,50, …</p>
                                            <b>Output yang diharapkan : </b>
                                            <p>2 8 18 32 50 72 98 128 162 200 </p>
                                            <div class="col-lg-6">

                                                <select class="form-select lang-list"
                                                    aria-label="Default select example">
                                                    <option value="6 c_cpp">C (gcc)</option>
                                                </select><button type="button" id="button4"
                                                    class="btn <?php echo $button; ?> float-end" id="run"
                                                    <?php if($exist==0){ ?>onclick="run(<?php echo $idUser; ?>,4,'2 8 18 32 50 72 98 128 162 200 ',50,50);" <?php } ?>><i
                                                        class="bi bi-play-fill"></i> RUN</button>
                                                <pre id="editor" class="editor">
<?php
if($exist==0){
?>
#include &lt;stdio.h&gt;

//Deklarasikan prototipe prosedur atau fungsi
...

int main() {
    int suku = 10;
    //Lengkapi kode dibagian sini sehingga menghasilkan output yang diharapkan
    ...

    return 0;
}

//Tentukan cetakPola ini prosedur atau fungsi
... cetakPola(int suku) {
    //isi dengan kode yang menghasilkan output yang benar
    ...
}

<?php
}else{
    echo $result1['code'];
}
?>
                                        </pre>
                                            </div>
                                            <div class="col-lg-6">
                                                <h3>Result</h3>
                                                <div class="preview-code" id="preview-code4">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <table class="table" id="table4" style="display: <?php echo $display; ?>;">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Nama</th>
                                                <th scope="col">Submit dengan benar pada</th>
                                            </tr>
                                        </thead>
                                        <tbody id="rank-table4">
                                            <?php
                                                if($exist!=0){
                                                    $i=1;
                                                    while($row =mysqli_fetch_assoc($query2))
                                                    {
                                                        echo "
                                                            <tr>
                                                                <td>".$i."</td>
                                                                <td>".$row['name']."</td>
                                                                <td>".$row['submit_at']."</td>
                                                            </tr>
                                                        ";
                                                        $i++;
                                                    }
                                                    
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                    <button class="btn-challenge" type="button"
                                        data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="previous"
                                        id="previousSoal5">Previous</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        $sql = "SELECT * FROM tb_challenge_code WHERE id_user='$idUser'";
                        $query = mysqli_query($con, $sql);
                        $num = mysqli_num_rows($query);
                        $displayBadge = $num == 5? "block": "none";
                    ?>
                    <div id="getBadge" style="display: <?php echo $displayBadge; ?>;">
                        <br>
                        <h5>Selamat Anda Mendapatkan sebuah Badge (Lencana)!</h5>
                        <p>Anda memenangkan badge ini karena Anda telah menyelesaikan semua studi kasus di Challenge ini. Berikut Badge yang anda dapatkan : </p>
                        <img src="../images/badges/penakluk-kode.png" width="40%" height="auto">
                    </div>
                    <?php
                    }
                        ?>
                    <button class="btn btn-course" id="previous" data-prev="24">Sebelumnya</button>
                    <button class="btn btn-course f-right" id="next" data-next="26"
                        data-curr="<?php echo $currCourse ?>" data-reward='0'
                        data-username="<?php echo $_SESSION['username']; ?>" data-user="<?php echo $idUser; ?>"
                        data-materi="Challenge 3" data-artikel="0">Berikutnya</button>
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
                    <button type="button" class="btn btn-primary main-bg-color"
                        onclick="getNextCourse(7,<?php echo $currCourse ?>,'<?php echo $_SESSION['username']; ?>')">Next
                        Course</button>
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
<script type="text/javascript" src="../js/courses/challenge.js"></script>

</html>