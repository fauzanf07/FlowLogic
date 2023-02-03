<?php 
	session_start();
	if(!isset($_SESSION['name'])){
		header("Location: http://localhost/skripsi/");
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="stylesheet" type="text/css" href="../css/user/profile.css">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter&family=Roboto+Slab&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
	<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
</head>
<body>
	<div id="wrapper">
		<nav class="navbar sticky-top navbar-expand-lg bg-light">
		  <div class="container-fluid">
		    <a class="navbar-brand" href="#"> <i class="bi bi-code-square"></i> FunCode</a>
		    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		      <span class="navbar-toggler-icon"></span>
		    </button>
		    <div class="collapse navbar-collapse " id="navbarNav">
		      <ul class="navbar-nav ms-auto">
		        <li class="nav-item">
		          <a class="nav-link "  href="./home.php">Home</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link active" aria-current="profile" href="./profile.php" >Profile</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" href="./course.php">Course</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link btn btn-secondary" id="sign-out">Sign out <i class="bi bi-arrow-right"></i></a>
		        </li>
		      </ul>
		    </div>
		  </div>
		</nav>
		<div class="container">
			<div class="row row-profile">
				<div class="col-lg-3">
					<center><img src="<?php echo $_SESSION['photo_profile']; ?>" class="profile-pic" id="profile-pic"></center>
					<h3 class="profile-name"><?php echo $_SESSION['name']; ?></h3>
					<span class="username"><?php echo $_SESSION['username']; ?></span>
					<div class="info">
						<span class="info-item"><i class="bi bi-person-fill"></i>&nbsp;&nbsp; Level 3 - Explorer</span>
						<span class="info-item"><i class="bi bi-trophy-fill"></i>&nbsp;&nbsp; 10th</span>
						<span class="info-item"><i class="bi bi-diamond-fill"></i>&nbsp;&nbsp; 500 Points</span>
						<span class="info-item"><i class="bi bi-award-fill"></i>&nbsp;&nbsp; 3 Badges</span>
						<span class="info-item"><i class="bi bi-star-fill"></i>&nbsp;&nbsp; 1000 XP</span>
					</div>
				</div>
				<div class="col-lg-9 nav-info-user">
					<nav>
					  <div class="nav nav-tabs" id="nav-tab" role="tablist">
					    <button class="nav-link active" id="nav-feed-tab" data-bs-toggle="tab" data-bs-target="#nav-feed" type="button" role="tab" aria-controls="nav-feed" aria-selected="true"><i class="bi bi-chat-square-text-fill"></i>&nbsp;&nbsp;Feed</button>
					    <button class="nav-link" id="nav-progress-tab" data-bs-toggle="tab" data-bs-target="#nav-progress" type="button" role="tab" aria-controls="nav-progress" aria-selected="false"><i class="bi bi-layers-fill"></i>&nbsp;&nbsp;Progress</button>
					    <button class="nav-link" id="nav-badges-tab" data-bs-toggle="tab" data-bs-target="#nav-badges" type="button" role="tab" aria-controls="nav-badges" aria-selected="false"><i class="bi bi-award-fill"></i>&nbsp;&nbsp;Badges</button>
					  </div>
					</nav>
					<div class="tab-content" id="nav-tabContent">
						<div class="tab-pane fade show active" id="nav-feed" role="tabpanel" aria-labelledby="nav-feed-tab" tabindex="0">
							<div class="share-wrapper">
								<h3>Share your knowledge</h3>
								<div id="summernote"></div>
								<center><button type="button" class="btn btn-primary mt-4">SHARE YOUR KNOWLEDGE&nbsp; <i class="bi bi-send-fill"></i></button></center>
							</div>
							<div class="your-post">
								<div class="post">
									<div class="top">
										<div class="top-photo">
											<img src= "<?php echo $_SESSION['photo_profile']; ?>" class="avatar">
										</div>
										<div class="top-name">
											<b><span><?php echo $_SESSION['name']; ?></span></b><span>&nbsp;&nbsp;<?php echo $_SESSION['username']; ?></span><br>
											<span>20-08-2022 18:30</span>
										</div>
									</div>
									<div class="content-post">
										<p>I'm so happy that I have earned this badge! I can't wait to see you earn this badge too!</p>
										<center><img src="../images/badges.png" class="badges"></center>
									</div>
								</div>
							</div>
					  	</div>
					  	<div class="tab-pane fade" id="nav-progress" role="tabpanel" aria-labelledby="nav-progress-tab" tabindex="0">
						  	<div class="card card-progress">
								<h5 class="card-header">Course Progress</h5>
								<div class="card-body">
							    	<h6>Algorithm & Programming</h6>
								    <div class="progress">
									  <div class="progress-bar bg-warning progress-bar-striped" role="progressbar" aria-label="Example with label" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
									</div>
								</div>
							</div>
							<div class="card card-progress">
								<h5 class="card-header">Activity Histories</h5>
								<div class="card-body">
								    <div class="row-custom">
								    	<div class="coloumn-1"><i class="bi bi-arrow-up-circle-fill"></i>&nbsp; Level Up</div>
								    	<div class="coloumn-2">Level up to Level 3 and have become an Explorer</div>
								    </div>
								    <div class="row-custom">
								    	<div class="coloumn-1"><i class="bi bi-star-fill"></i>&nbsp; +500 XP</div>
								    	<div class="coloumn-2">You have finished basic algorithm material</div>
								    </div>
								    <div class="row-custom">
								    	<div class="coloumn-1"><i class="bi bi-award-fill"></i></i>&nbsp; New Badges</div>
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
					  	<div class="tab-pane fade" id="nav-badges" role="tabpanel" aria-labelledby="nav-badges-tab" tabindex="0">
						  	<div class="card card-badges" style="width: 18rem;">
								<img src="../images/badges.png" class="card-img-top" alt="...">
								<div class="card-body">
									<center><h5 class="card-title">Digital Badge System</h5></center>
								    <center><p class="card-text">COMPLETION BADGES</p></center><br/>
								    <center><p class="card-text">Earned: 14 Feb, 2022 02:30:00</p></center>
								</div>
							</div>
							<div class="card card-badges" style="width: 18rem;">
								<img src="../images/badges.png" class="card-img-top" alt="...">
								<div class="card-body">
									<center><h5 class="card-title">Digital Badge System</h5></center>
								    <center><p class="card-text">COMPLETION BADGES</p></center><br/>
								    <center><p class="card-text">Earned: 14 Feb, 2022 02:30:00</p></center>
								</div>
							</div>
							<div class="card card-badges" style="width: 18rem;">
								<img src="../images/badges.png" class="card-img-top" alt="...">
								<div class="card-body">
									<center><h5 class="card-title">Digital Badge System</h5></center>
								    <center><p class="card-text">COMPLETION BADGES</p></center><br/>
								    <center><p class="card-text">Earned: 14 Feb, 2022 02:30:00</p></center>
								</div>
							</div>
					  	</div>
					</div>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript" src="../js/user/profile.js"></script>
</html>