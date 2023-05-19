<?php 
	session_start();
	include("../db.php");
	if(!isset($_SESSION['name'])){
		header("Location: http://localhost/skripsi/");
	}
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
	<link href="https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/4.0.17/css/froala_style.min.css" integrity="sha512-7LA92qqMxQg1dy0GXIaceecW4zpFq/pu2inmPOd/IaCjDnjzDP1luaG9NTYU8BeaUmBw73jHCGRJjQ3xDpdDlg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link href="https://cdn.jsdelivr.net/npm/froala-editor@latest/css/plugins/image.min.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-3 left-content bg-light">
				<a class="navbar-brand" href="#"> <i class="bi bi-code-square"></i> FunCode</a><br><br>
				<img src="<?php echo $_SESSION["photo_profile"]; ?>" class="avatar" />
				<div style="text-align: center;">
					<span class="" id="profile-name"><?php echo $_SESSION["name"]; ?></span>&nbsp;&nbsp;<i
						class="bi bi-check-circle"></i>
				</div>
				<div class="section current" id="progress-menu">
					<span><i class="bi bi-people-fill"></i> &nbsp;&nbsp; Progress Siswa</span>
				</div>
				<div class="section" id="postingan-menu">
					<i class="bi bi-file-earmark-richtext-fill"></i> &nbsp;&nbsp; Postingan Siswa</span>
				</div>
				<br><br>
				<button class="nav-link btn" id="sign-out" onclick="logout()">Sign out <i
						class="bi bi-arrow-right"></i></button>
			</div>
			<div class="col-lg-9 right-content">
				<div class="content-1">
					<h3 id="progress-title"><i class="bi bi-people-fill"></i> &nbsp;&nbsp; Hasil Belajar Siswa</h3>
					<div class="chart">
						<canvas id="myChart"></canvas>
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
									  	echo "
									  		<tr>
								        		<td>".$row["name"]."</td>
								        		<td><div class='progress' role='progressbar' aria-label='Default striped example' aria-valuenow='10' aria-valuemin='0' aria-valuemax='100'>
												<div class='progress-bar progress-bar-striped' style='width: ". ($row["curr_course"]*20)."%'>".($row["curr_course"]*20)."%</div>
											  </div></td>
											  	<td><center>0</center></td>
												<td><center>0</center></td>
								        		<td>
								        			<button class='btn btn-success admin btn-action' data-id='".$row["id"]."'>Detail</button>&nbsp;&nbsp;
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
				<div class="content-2">
					<h3 id="post-title"><i class="bi bi-file-earmark-richtext-fill"></i> &nbsp;&nbsp; Postingan Siswa</h3>
					<?php
						$sql = "SELECT a.*, b.name, b.username, b.photo_profile FROM tb_post AS a JOIN tb_user AS b ON b.id = a.id_user ORDER BY a.status,created_at DESC";
						$result = mysqli_query($con, $sql);
						while($r_post = mysqli_fetch_assoc($result)){
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
									</div>
								</div>
							';
						}
					?>
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
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/froala-editor@latest/js/plugins/image.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript" src="../js/admin/admin.js"></script>

</html>