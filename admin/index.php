<?php 
	session_start();
	$con = mysqli_connect('localhost', 'root', '','db_gamifikasi');
	$sql = "SELECT * FROM tb_user" ;
	$result = mysqli_query($con,$sql);
	if(!isset($_SESSION['name'])){
		header("Location: http://localhost/skripsi/");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Administrator</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="stylesheet" type="text/css" href="../css/admin/style.css">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter&family=Roboto+Slab&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
</head>
<body>
	<nav class="navbar">
	  <div class="container-fluid">
	    <a class="navbar-brand" href="#">
			<i class="bi bi-code-square"></i>
			FunCode
		</a>
		<span id="admin-mode">Administrator Mode &nbsp;&nbsp;<a id="logout" href="javascript:logout();" style="color: #000;"><i class="bi bi-door-open-fill" style="font-size: 20px"></i></a></span>
	  </div>
	</nav>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-3 left-content bg-light">
				<img src="<?php echo $_SESSION["photo_profile"]; ?>" class="avatar"/>
				<div style="text-align: center;">
					<span class="" id="profile-name"><?php echo $_SESSION["name"]; ?></span>&nbsp;&nbsp;<i class="bi bi-check-circle"></i>
				</div>
				<div class="section current" id="user-menu">
					<span><i class="bi bi-people-fill" ></i> &nbsp;&nbsp; Manajemen User</span>
				</div>
				<div class="section" id="assignments-menu">
					<i class="bi bi-file-earmark-code-fill"></i> &nbsp;&nbsp; Assignments</span>
				</div>
				<div class="section last-section" id="achievements-menu">
					<span><i class="bi bi-trophy-fill"></i> &nbsp;&nbsp; Achievements</span>
				</div>
			</div>
			<div class="col-lg-9 right-content">
				<h3 id="user-title"><i class="bi bi-people-fill" ></i> &nbsp;&nbsp; Manajemen User</h3>
				<div class="user-list" id="user-list">
					<table class="table table-striped" id="table-user">
						<thead>
				            <tr>
				                <th>Email</th>
				                <th>Username</th>
				                <th>Name</th>
				                <th>Admin</th>
				                <th>Action</th>
				            </tr>
				        </thead>
				        <tbody>
				        	<?php 
				        		if (mysqli_num_rows($result) > 0) {
									while($row = mysqli_fetch_array($result)) {
									  	echo "
									  		<tr>
								        		<td>".$row["email"]."</td>
								        		<td>".$row["username"]."</td>
								        		<td>".$row["name"]."</td>
								        		<td>";
								        		if($row["admin"] == 1){ echo "<i class='bi bi-check-lg'></i>";}
								        		echo "</td>
								        		<td>
								        			<button class='btn btn-success admin btn-action' data-id='".$row["id"]."' onclick='changeAdmin(this)'>Change Admin</button>&nbsp;&nbsp;
								        			<button class='btn btn-danger btn-action' data-id='".$row["id"]."' onclick = 'deleteUser(this)'>Delete</button>
								        		</td>
								        	</tr>
									  	";
									}
								}
				        	 ?>
				        	
				        </tbody>
					</table>
				</div>
				<h3 id="assign-title"><i class="bi bi-file-earmark-code-fill" ></i> &nbsp;&nbsp; Assignments</h3>
				<div class="user-list" id="assignments">
					<table class="table table-striped" id="table-user">
						<thead>
				            <tr>
				                <th>Username</th>
				                <th>Assignment</th>
				                <th>Action</th>
				            </tr>
				        </thead>
				        <tbody>
				        	
				        </tbody>
				    </table>
				</div>
				<h3 id="achv-title"><i class="bi bi-trophy-fill" ></i> &nbsp;&nbsp; Achievements</h3>
				<div class="user-list" id="achievements">
					<table class="table table-striped" id="table-user">
						<thead>
				            <tr>
				                <th>Username</th>
				                <th>Assignment</th>
				                <th>Action</th>
				            </tr>
				        </thead>
				        <tbody>
				        	
				        </tbody>
				    </table>
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
<script type="text/javascript" src="../js/admin/admin.js"></script>
</html>