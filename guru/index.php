<?php 
	session_start();
	include("../db.php");
	include('../server.php');
	if(!isset($_SESSION['name'])){
		header("Location: ".$mainUrl);
	}
	$user_id = $_SESSION['user_id'];
	$username = $_SESSION['username'];
	$photoProfile = $_SESSION['photo_profile'];
	$quizAverages = [];

	for ($quizNumber = 1; $quizNumber <= 3; $quizNumber++) {
		$sql = "SELECT AVG(nilai) as avg FROM tb_quiz WHERE quiz = $quizNumber";
		$query = mysqli_query($con, $sql);
		$row = mysqli_fetch_assoc($query);
		$average = $row['avg'] ?? 0;
		$quizAverages[$quizNumber] = $average;
	}

	$avg_quiz1 = $quizAverages[1] ?? 0;
	$avg_quiz2 = $quizAverages[2] ?? 0;
	$avg_quiz3 = $quizAverages[3] ?? 0;

	setcookie('quiz1',$avg_quiz1);
	setcookie('quiz2',$avg_quiz2);
	setcookie('quiz3',$avg_quiz3);

	mysqli_query($con, "CALL `grade_challenge`(@p0, @p1, @p2, @p3, @p4, @p5)");
	$query = "SELECT @p0 AS `1_a`, @p1 AS `1_b`, @p2 AS `1_c`, @p3 AS `2_a`, @p4 AS `2_b`, @p5 AS `2_c`";
	$hasil = mysqli_query($con, $query);
	$r_hasil = mysqli_fetch_assoc($hasil);
	
	setcookie('1_a',$r_hasil['1_a']);
	setcookie('1_b',$r_hasil['1_b']);
	setcookie('1_c',$r_hasil['1_c']);
	setcookie('2_a',$r_hasil['2_a']);
	setcookie('2_b',$r_hasil['2_b']);
	setcookie('2_c',$r_hasil['2_c']);
?>
<!DOCTYPE html>
<html>

<head>
	<title>Administrator</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="stylesheet" type="text/css" href="../css/admin/style.css">
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
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-3 left-content bg-light">
				<a class="navbar-brand" href="#"> <i class="bi bi-code-square"></i> FlowLogic</a><br><br>
				<img src="<?php echo $_SESSION["photo_profile"]; ?>" class="avatar" />
				<div style="text-align: center;">
					<span class="" id="profile-name"><?php echo $_SESSION["name"]; ?></span>&nbsp;&nbsp;<i
						class="bi bi-check-circle"></i>
				</div>
				<div class="section current menu" id="progress-menu">
					<span><i class="bi bi-people-fill"></i> &nbsp;&nbsp; Progress Siswa</span>
				</div>
				<div class="section menu" id="postingan-menu">
					<i class="bi bi-file-earmark-richtext-fill"></i> &nbsp;&nbsp; Postingan Siswa</span>
				</div>
				<div class="section menu" id="challenge-menu">
					<i class="bi bi-clipboard-check"></i> &nbsp;&nbsp; Challenges Siswa</span>
				</div>
				<div class="section menu" id="point-menu">
					<i class="bi bi-diamond-fill"></i> &nbsp;&nbsp; Bonus Poin</span>
				</div>
				<div class="section menu" id="rank-menu">
					<i class="bi bi-trophy-fill"></i>&nbsp;&nbsp;Current Rankings</span>
				</div>
				<br><br>
				<button class="nav-link btn" id="sign-out" onclick="logout()">Sign out <i
						class="bi bi-arrow-right"></i></button>
			</div>
			<div class="col-lg-9 right-content">
				<div class="content-1 content">
					<h3 id="progress-title"><i class="bi bi-people-fill"></i> &nbsp;&nbsp; Hasil Belajar Siswa</h3>
					<div class="container-fluid">
						<div class="row">
							<div class="col-lg-6">
								<div class="chart">
									<canvas id="myChart"></canvas>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="chart">
									<canvas id="myChart1"></canvas>
								</div>
							</div>
						</div>
					</div>
					<button class="btn btn-primary download">Download</button>
					<div class="user-list" id="progress-list">
						<table class="table table-striped" id="table-user">
							<thead>
								<tr>
									<th>Nama</th>
									<th>Progress</th>
									<th>Rata-rata nilai</th>
									<th>Badges</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$sql = "SELECT a.*, b.curr_course FROM tb_user AS a JOIN tb_courses AS b ON b.id_user = a.id" ;
								$result = mysqli_query($con,$sql);
				        		if (mysqli_num_rows($result) > 0) {
									while($row = mysqli_fetch_array($result)) {
										$id_user = $row['id'];
										$query = mysqli_query($con,"SELECT AVG(`nilai`) AS avg FROM `tb_quiz` WHERE id_user='$id_user'");
										$res = mysqli_fetch_assoc($query);
										$avg = $res['avg'] ?? 0;

										$query = mysqli_query($con,"SELECT COUNT(*) AS jml FROM `tb_users_badge` WHERE id_user='$id_user'");
										$res = mysqli_fetch_assoc($query);
										$bdg = $res['jml'] ?? 0;

									  	echo "
									  		<tr>
								        		<td>".$row["name"]."</td>
								        		<td><div class='progress' role='progressbar' aria-label='Default striped example' aria-valuenow='10' aria-valuemin='0' aria-valuemax='100'>
												<div class='progress-bar progress-bar-striped' style='width: ". ($row["curr_course"]*4)."%'>".($row["curr_course"]*4)."%</div>
											  </div></td>
											  	<td><center>".$avg."</center></td>
												<td><center>".$bdg."</center></td>
								        		<td>
								        			<a class='btn btn-success admin btn-action' href=./detail-progress.php?user=".$id_user.">Detail</button>&nbsp;&nbsp;
								        		</td>
								        	</tr>
									  	";
									}
								}
				        	 ?>

							</tbody>
						</table>
					</div>
				</div>
				<div class="content-2 content">
					<h3 id="post-title"><i class="bi bi-file-earmark-richtext-fill"></i> &nbsp;&nbsp; Postingan Siswa
					</h3>
					<?php
						$sql = "SELECT a.*, b.name, b.username, b.photo_profile FROM tb_post AS a JOIN tb_user AS b ON b.id = a.id_user WHERE a.challenge ='0' OR (a.challenge ='1' AND a.status='1') ORDER BY a.status,created_at DESC";
						$result = mysqli_query($con, $sql);
						while($r_post = mysqli_fetch_assoc($result)){
							$id = $r_post['id_user'];
							$id_post = $r_post['id'];
							echo '
								<div class="post">
									<div class="top">
										<div class="top-photo">
											<img src="'.$r_post['photo_profile'].'"  class="avatar">
										</div>
										<div class="top-name">
											<b><span>'.$r_post['name'].'</span></b><span>&nbsp;&nbsp;'.$r_post['username'].'</span>
											<div class="control" id="control'.$r_post['id'].'">';
											if($r_post['status']==0){
												echo '
													<button class="btn btn-success" data-id="'.$r_post['id'].'" id="accept'.$r_post['id'].'" onclick="controlPost(this,1);">Terima</button>
													<button class="btn btn-danger" data-id="'.$r_post['id'].'" id="reject'.$r_post['id'].'" onclick="controlPost(this,2);">Tolak</button>
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
				<div class="content-3 content">
					<h3 id="chlg-title"><i class="bi bi-clipboard-check"></i> &nbsp;&nbsp; Challenges Siswa</h3>
					<div class="user-list">
						<table class="table table-striped" id="table-chall">
							<thead>
								<tr>
									<th>Nama</th>
									<th>Challenge</th>
									<th>Created at</th>
									<th>Status</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$sql = "SELECT a.*, b.name FROM tb_post AS a JOIN tb_user AS b ON a.id_user = b.id WHERE a.challenge != '0'" ;
								$result = mysqli_query($con,$sql);
				        		if (mysqli_num_rows($result) > 0) {
									while($row = mysqli_fetch_array($result)) {
									  	echo "
									  		<tr>
								        		<td>".$row["name"]."</td>
								        		<td>".$row['challenge']."</td>
											  	<td>".$row['created_at']."</td>
												<td id='statusCol".$row['id']."'>";
												if($row['status'] == 0){
													echo '<span class="pending">Pending <i class="bi bi-clock"></i></span>';
												}else if($row['status'] == 1){
													echo '<span class="accepted">Diterima &#10003;</span>';
												}else{
													echo '<span class="rejected">Ditolak</span>';
												}
										echo "</td>
								        		<td>
														<a class='btn admin btn-action' data-id='".$row["id"]."' href='./view-challenge.php?id=".$row['id']."&user=".$row['id_user']."&challenge=".$row['challenge']."' style='width: 100px; background-color:#6a00ff; color:#fff;'>Lihat</a>&nbsp;&nbsp;
								        		</td>
								        	</tr>";
										  
									}
								}
				        	 ?>

							</tbody>
						</table>
					</div>
				</div>
				<div class="content-4 content">
					<h3 id="poin-title"><i class="bi bi-diamond-fill"></i> &nbsp;&nbsp; Bonus Poin</h3>
					<div class="user-list">
						<h4>Poin diserahkan pada </h4><br>
						<div class="input-group mb-3">
							<label class="input-group-text" for="inputGroupSelect01">Nama Siswa</label>
							<select class="form-select" id="studentsName">
								<?php
									$sql = "SELECT * FROM tb_user" ;
									$result = mysqli_query($con,$sql);
									if (mysqli_num_rows($result) > 0) {
										while($row = mysqli_fetch_array($result)) {
											echo "<option value=".$row['id'].">".$row['id']. ' - '. $row['name']."</option>";
										}
									}
								?>
							</select>
						</div>
						<div class="input-group flex-nowrap">
							<span class="input-group-text" >Jumlah Poin</span>
							<input type="number" class="form-control" placeholder="Jumlah Poin"  aria-describedby="addon-wrapping" id="jmlPoin">
						</div>
						<br>
						<div class="input-group flex-nowrap">
							<span class="input-group-text" >Deskripsi</span>
							<input type="text" class="form-control" placeholder="Deskripsi" aria-label="Deskripsi" aria-describedby="addon-wrapping" id="desc">
						</div>
						<center><button type="button" class="btn btn-primary" style="width:100px; margin-top:20px;" id="kirim">Kirim</button></center>
					</div>
				</div>
				<div class="content-5 content">
					<h3 id="rank-title"><i class="bi bi-trophy-fill"></i>&nbsp;&nbsp;Current Rankings</span></h3>
					<br>
					<table class="table">
					  <thead>
					    <tr>
					      <th scope="col">#</th>
					      <th scope="col">Name</th>
					      <th scope="col">Points</th>
						  <th scope="col">Xp</th>
					    </tr>
					  </thead>
					  <tbody id="tableRanks">
						<?php
							$sql = "SELECT * FROM tb_user WHERE admin='0' ORDER BY point DESC, xp DESC";
							$result = mysqli_query($con, $sql);
							$i=1;
							while($row = mysqli_fetch_assoc($result)){
								echo '
									<tr>
										<th scope="row">'.$i.'</th>
										<td>'.$row['name'].'</td>
										<td>'.$row['point'].'</td>
										<td>'.$row['xp'].'</td>
									</tr>
								';
								$i++;
							}
						?>
					  </tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
<script type="text/javascript" src="../js/admin/admin.js"></script>

</html>