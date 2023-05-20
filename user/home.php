<?php 
	session_start();
	if(!isset($_SESSION['name'])){
		header("Location: http://localhost/skripsi/");
	}
	$user_id = $_SESSION['user_id'];
	$photoProfile = $_SESSION['photo_profile'];
	$username = $_SESSION['username'];
	include("../db.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="stylesheet" type="text/css" href="../css/user/home.css">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter&family=Roboto+Slab&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
	<link href="https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/4.0.17/css/froala_style.min.css" integrity="sha512-7LA92qqMxQg1dy0GXIaceecW4zpFq/pu2inmPOd/IaCjDnjzDP1luaG9NTYU8BeaUmBw73jHCGRJjQ3xDpdDlg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link href="https://cdn.jsdelivr.net/npm/froala-editor@latest/css/plugins/image.min.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<nav class="navbar navbar-expand-lg sticky-top bg-light">
	  <div class="container-fluid">
	    <a class="navbar-brand" href="#"> <i class="bi bi-code-square"></i> FunCode</a>
	    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	      <span class="navbar-toggler-icon"></span>
	    </button>
	    <div class="collapse navbar-collapse " id="navbarNav">
	      <ul class="navbar-nav ms-auto">
	        <li class="nav-item">
	          <a class="nav-link active" aria-current="page" href="#">Home</a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" href="./profile.php?user=<?php echo $_SESSION['username']; ?>">Profile</a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" href="./course.php">Corridor</a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link btn btn-secondary" id="sign-out">Sign out <i class="bi bi-arrow-right"></i></a>
	        </li>
	      </ul>
	    </div>
	  </div>
	</nav>
	<div class="container">
		<div class="row">
			<div class="col-lg-7">
				<h3 class="header">What's new?</h3>
				<button type="button" class="btn btn-light" id="refresh">Refresh</button>
				<?php

					$sql = "SELECT * FROM tb_post AS a WHERE a.status='1' ORDER BY accepted_at DESC";
					$result = mysqli_query($con, $sql);
					while($r_post = mysqli_fetch_assoc($result)){
						$id = $r_post['id_user'];
						$id_post = $r_post['id'];
						$query = "SELECT * FROM tb_user WHERE id='$id'";
						$hasil = mysqli_query($con, $query);
						$r = mysqli_fetch_assoc($hasil);
						echo '
							<div class="post">
								<div class="top">
									<div class="top-photo">
										<img src= '. $r['photo_profile'] .' class="avatar">
									</div>
									<div class="top-name">
										<b><span><a class="no-undr" href="./profile.php?user='.$r['username'].'">'. $r['name'] .'</a></span></b><span>&nbsp;&nbsp;'. $r['username'] .'</span><br>
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
									echo '<span id="like'.$id_post.'" data-id="'.$id_post.'" data-user="'.$user_id.'" data-liked="'.$r_lico['@liked'].'" class="lico-button like-btn" style="color:#adadad;" onclick="likeBtn(this);"><i class="bi bi-heart-fill"></i></span><span class="amount me-3" id="likeAmount'.$id_post.'">'.$r_lico['@likes'].'</span>';
								}else{
									echo '<span id="like'.$id_post.'" data-id="'.$id_post.'" data-user="'.$user_id.'" data-liked="'.$r_lico['@liked'].'" class="lico-button like-btn" style="color:#f00;" onclick="likeBtn(this);"><i class="bi bi-heart-fill"></i></span><span class="amount me-3" id="likeAmount'.$id_post.'">'.$r_lico['@likes'].'</span>';
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
				<button type="button" class="btn btn-outline-secondary" id="loadPostMore">Load More</button>
			</div>
			<div class="col-lg-1">
			</div>
			<div class="col-lg-4" id="curr-ranks">
				<h3 class="header"><i class="bi bi-trophy-fill"></i>&nbsp;&nbsp;Current Rankings</h3>
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
	</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript" src="../js/user/home.js"></script>

</html>