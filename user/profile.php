<?php 
	session_start();
	if(!isset($_SESSION['name'])){
		header("Location: http://localhost/skripsi/");
	}
	include("../db.php");
	$username = $_GET['user'];
	$sql = "SELECT a.*,b.curr_course FROM tb_user as a LEFT JOIN tb_courses as b ON a.id = b.id_user WHERE username='$username'";
	$query = mysqli_query($con,$sql);
	$res = mysqli_fetch_assoc($query);
	$user_id = $res['id'];
	$photoProfile = $res['photo_profile'];
	$name = $res['name'];
	$currCourse = $res['curr_course'];
	$progress = intval(($currCourse/5)*100);
	$progressBg = "";
	if($progress<=30){
		$progressBg = "bg-danger";
	}else if($progress<=60){
		$progressBg = "bg-warning";
	}else{
		$progressBg = "bg-success";
	}
 ?>
<!DOCTYPE html>
<html>

<head>
	<title>Profile</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="stylesheet" type="text/css" href="../css/user/profile.css">
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
</head>

<body>
	<div id="wrapper">
		<nav class="navbar sticky-top navbar-expand-lg bg-light">
			<div class="container-fluid">
				<a class="navbar-brand" href="#"> <i class="bi bi-code-square"></i> FunCode</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
					aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse " id="navbarNav">
					<ul class="navbar-nav ms-auto">
						<li class="nav-item">
							<a class="nav-link " href="./home.php">Home</a>
						</li>
						<li class="nav-item">
							<?php
								if($username == $_SESSION['username']){
									echo '<a class="nav-link active" aria-current="profile" href="./profile.php">Profile</a>';
								}else{
									echo '<a class="nav-link" aria-current="profile" href="./profile.php">Profile</a>';
								}
							?>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="./course.php">Corridor</a>
						</li>
						<li class="nav-item">
							<a class="nav-link btn btn-secondary" id="sign-out">Sign out <i
									class="bi bi-arrow-right"></i></a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<div class="container">
			<div class="row row-profile">
				<div class="col-lg-3">
					<center><img src="<?php echo $photoProfile; ?>" class="profile-pic" id="profile-pic">
					</center>
					<h3 class="profile-name"><?php echo $name; ?></h3>
					<span class="username-profile"><?php echo $username; ?></span>
					<div class="info">
						<?php
							$sql = "SELECT * FROM tb_user WHERE username='$username'";
							$result = mysqli_query($con, $sql);
							$r = mysqli_fetch_assoc($result);
							$id_user = $r['id'];
						?>
						<span class="info-item"><i class="bi bi-person-fill"></i>&nbsp;&nbsp; Level
							<?php echo $r['level']; ?> - Explorer</span>
						<span class="info-item"><i class="bi bi-trophy-fill"></i>&nbsp;&nbsp; 10th</span>
						<span class="info-item"><i class="bi bi-diamond-fill"></i>&nbsp;&nbsp;
							<?php echo $r['point']; ?> Point(s)</span>
						<span class="info-item"><i class="bi bi-award-fill"></i>&nbsp;&nbsp; 3 Badges</span>
						<span class="info-item"><i class="bi bi-star-fill"></i>&nbsp;&nbsp; <?php echo $r['xp']; ?>
							XP</span>
					</div>
				</div>
				<div class="col-lg-9 nav-info-user">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<button class="nav-link active" id="nav-feed-tab" data-bs-toggle="tab"
								data-bs-target="#nav-feed" type="button" role="tab" aria-controls="nav-feed"
								aria-selected="true"><i
									class="bi bi-chat-square-text-fill"></i>&nbsp;&nbsp;Feed</button>
							<button class="nav-link" id="nav-progress-tab" data-bs-toggle="tab"
								data-bs-target="#nav-progress" type="button" role="tab" aria-controls="nav-progress"
								aria-selected="false"><i class="bi bi-layers-fill"></i>&nbsp;&nbsp;Progress</button>
							<button class="nav-link" id="nav-badges-tab" data-bs-toggle="tab"
								data-bs-target="#nav-badges" type="button" role="tab" aria-controls="nav-badges"
								aria-selected="false"><i class="bi bi-award-fill"></i>&nbsp;&nbsp;Badges</button>
						</div>
					</nav>
					<div class="tab-content" id="nav-tabContent">
						<div class="tab-pane fade show active" id="nav-feed" role="tabpanel"
							aria-labelledby="nav-feed-tab" tabindex="0">
							<?php 
								if($username == $_SESSION['username'])
								{
							?>
							<div class="share-wrapper">
								<h3>Share your knowledge</h3>
								<textarea id="shareBox"></textarea>
								<center><button type="button" id="share"
										data-username="<?php echo $username; ?>" onclick="share(this);"
										class="btn btn-primary mt-4">SHARE YOUR KNOWLEDGE&nbsp; <i
											class="bi bi-send-fill"></i></button></center>
							</div>
							<?php
								}
								?>
							<div class="your-post">
								<?php

									$sql = "SELECT * FROM tb_post WHERE id_user='$id_user' ORDER BY created_at DESC";
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
										mysqli_query($con, "CALL like_comment('$user_id','$id_post',@liked,@likes,@comments)");
										$query_lico = "SELECT @liked,@likes,@comments";
										$hasil_lico = mysqli_query($con, $query_lico);
										$r_lico = mysqli_fetch_assoc($hasil_lico);
										echo '
												<div class="lico-section">
												';
												if($r_lico['@liked'] == 0){
													echo '<span id="like'.$id_post.'" data-id="'.$id_post.'" data-user="'.$user_id.'" data-liked="'.$r_lico['@liked'].'" class="lico-button like-btn" style="color:#adadad;" onclick="likeBtn(this);"><i class="bi bi-heart-fill"></i></span><span class="amount me-3 likes" data-id="'.$id_post.'" id="likeAmount'.$id_post.'">'.$r_lico['@likes'].'</span>';
												}else{
													echo '<span id="like'.$id_post.'" data-id="'.$id_post.'" data-user="'.$user_id.'" data-liked="'.$r_lico['@liked'].'" class="lico-button like-btn" style="color:#f00;" onclick="likeBtn(this);"><i class="bi bi-heart-fill"></i></span><span class="amount me-3 likes" data-id="'.$id_post.'" id="likeAmount'.$id_post.'">'.$r_lico['@likes'].'</span>';
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
															<div class="send" id="send'.$id_post.'" data-id="'.$id_post.'" data-username="'. $username.'" data-profile="'. $photoProfile .'" data-user="'. $user_id.'" onclick="sendComment(this);">
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
						</div>
						<div class="tab-pane fade" id="nav-progress" role="tabpanel" aria-labelledby="nav-progress-tab"
							tabindex="0">
							<div class="card card-progress">
								<h5 class="card-header">Course Progress</h5>
								<div class="card-body">
									<h6>Algorithm & Programming</h6>
									<div class="progress">
										<div class="progress-bar <?php echo $progressBg; ?> progress-bar-striped"
											role="progressbar" aria-label="Example with label"
											style="width: <?php echo $progress . "%"; ?>;" aria-valuenow=" 25"
											aria-valuemin="0" aria-valuemax="100"><?php echo $progress . "%"; ?></div>
									</div>
								</div>
							</div>
							<div class="card card-progress">
								<h5 class="card-header">Activity Histories</h5>
								<div class="card-body">
									<div class="row-custom">
										<div class="coloumn-1"><i class="bi bi-arrow-up-circle-fill"></i>&nbsp; Level Up
										</div>
										<div class="coloumn-2">Level up to Level 3 and have become an Explorer</div>
									</div>
									<div class="row-custom">
										<div class="coloumn-1"><i class="bi bi-star-fill"></i>&nbsp; +500 XP</div>
										<div class="coloumn-2">You have finished basic algorithm material</div>
									</div>
									<div class="row-custom">
										<div class="coloumn-1"><i class="bi bi-award-fill"></i></i>&nbsp; New Badges
										</div>
										<div class="coloumn-2">You have earned Digital Badge System</div>
									</div>
								</div>
							</div>
							<div class="card card-progress">
								<h5 class="card-header">Points Histories</h5>
								<div class="card-body">
									<span>Your current points : <b>500 Pts</b></span>
									<div class="row-custom">
										<div class="coloumn-1"><i class="bi bi-diamond-fill"></i>&nbsp; +500 Pts</div>
										<div class="coloumn-2">You have finished Assignment 1</div>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="nav-badges" role="tabpanel" aria-labelledby="nav-badges-tab"
							tabindex="0">
							<div class="card card-badges" style="width: 18rem;">
								<img src="../images/badges/penguasa-alur.png" class="card-img-top" alt="...">
								<div class="card-body">
									<center>
										<h5 class="card-title">PENGUASA ALUR</h5>
									</center>
									<center>
										<p class="card-text">Diberikan kepada peserta yang mampu menguasai flowchart dengan baik dan menerapkan prinsip alur logis.</p>
									</center><br />
									<center>
										<p class="card-text">Earned: 14 Feb, 2022 02:30:00</p>
									</center>
								</div>
							</div>
							<div class="card card-badges" style="width: 18rem;">
								<img src="../images/badges/ahli-prosedur.png" class="card-img-top" alt="...">
								<div class="card-body">
									<center>
										<h5 class="card-title">AHLI PROSEDUR</h5>
									</center>
									<center>
										<p class="card-text">Diberikan kepada peserta yang terampil dalam merancang dan mengimplementasikan prosedur yang efektif dan efisien.</p>
									</center><br />
									<center>
										<p class="card-text">Earned: 14 Feb, 2022 02:30:00</p>
									</center>
								</div>
							</div>
							<div class="card card-badges" style="width: 18rem;">
								<img src="../images/badges/analis-logika.png" class="card-img-top" alt="...">
								<div class="card-body">
									<center>
										<h5 class="card-title">ANALIS LOGIKA</h5>
									</center>
									<center>
										<p class="card-text">Diberikan kepada peserta yang terampil dalam menganalisis masalah dan merancang solusi menggunakan flowchart dan pseudocode.</p>
									</center><br />
									<center>
										<p class="card-text">Earned: 14 Feb, 2022 02:30:00</p>
									</center>
								</div>
							</div>
							<div class="card card-badges" style="width: 18rem;">
								<img src="../images/badges/pakar-fungsi.png" class="card-img-top" alt="...">
								<div class="card-body">
									<center>
										<h5 class="card-title">PAKAR FUNGSI</h5>
									</center>
									<center>
										<p class="card-text">Diberikan kepada peserta yang mahir dalam menggunakan fungsi dan mampu mengoptimalkan penggunaannya dalam pemrograman.</p>
									</center><br />
									<center>
										<p class="card-text">Earned: 14 Feb, 2022 02:30:00</p>
									</center>
								</div>
							</div>
							<div class="card card-badges" style="width: 18rem;">
								<img src="../images/badges/penakluk-kode.png" class="card-img-top" alt="...">
								<div class="card-body">
									<center>
										<h5 class="card-title">PENAKLUK KODE</h5>
									</center>
									<center>
										<p class="card-text"> Diberikan kepada peserta yang mampu menguasai dan mengatasi tantangan-tantangan dalam pemrograman.</p>
									</center><br />
									<center>
										<p class="card-text">Earned: 14 Feb, 2022 02:30:00</p>
									</center>
								</div>
							</div>
							<div class="card card-badges" style="width: 18rem;">
								<img src="../images/badges/aktivis-unggul.png" class="card-img-top" alt="...">
								<div class="card-body">
									<center>
										<h5 class="card-title">AKTIVIS UNGGUL</h5>
									</center>
									<center>
										<p class="card-text">Diberikan kepada peserta yang aktif berbagi pengetahuan, bertanya, dan memberi komentar dalam proses pembelajaran..</p>
									</center><br />
									<center>
										<p class="card-text">Earned: 14 Feb, 2022 02:30:00</p>
									</center>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
		    <div class="modal-content">
		      	<div class="modal-header">
		        		<h5 class="modal-title" id="exampleModalLabel">Yang menyukai postingan ini</h5>
		        		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		      	</div>
		      	<div class="modal-body">
			    	<table class="table" id="likers">
						<tbody>
						</tbody>
					</table>
		      	</div>
		    </div>
		</div>
	</div>
	<div class="black-wrapper change-pic-pop-up"></div>
	<div class="card w-40 change-pic-pop-up card-change-pic">
		<div class="card-body">
			<i class="bi bi-x" id="close"></i>
			<center><img src='<?php echo $_SESSION['photo_profile']; ?>' class="change-img" id="change-img"></center>
			<form method="post" id="change-img-form">
				<div class="input-group mb-3">
					<input type="file" class="form-control" id="inputGroupFile02">
					<label class="input-group-text" for="inputGroupFile02">Upload</label>
				</div>
			</form>
			<buttton class="btn btn-primary w-100 mt-20" id="change-pic">Change Photo Profile</buttton>
		</div>
	</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
	integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
	integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
	crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js">
</script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/froala-editor@latest/js/plugins/image.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript" src="../js/user/profile.js"></script>

</html>