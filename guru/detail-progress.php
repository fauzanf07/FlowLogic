<?php 
	session_start();
	include("../db.php");
	include('../server.php');
	if(!isset($_SESSION['name'])){
		header("Location: ".$mainUrl);
	}
    $idUser = $_GET['user'];
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
				<a class="navbar-brand" href="#"> <i class="bi bi-code-square"></i> FlowLogic</a><br><br>
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
				<div class="section" id="challenge-menu">
					<i class="bi bi-clipboard-check"></i> &nbsp;&nbsp; Challenges Siswa</span>
				</div>
				<br><br>
				<center><a class="btn btn-success" href="../guru">Home <i class="bi bi-arrow-right"></i></a></center>
			</div>
			<div class="col-lg-9 right-content">
				<div class="content-3" style="display:block;">
					<h3 id="chlg-title"><i class="bi bi-people-fill"></i>  &nbsp;&nbsp; Detail Progress Siswa</h3>
                    <br><br>
					<table class="table table-striped" id="table-user">
							<tbody>
								<?php 
                                    $sql = "SELECT a.*, b.curr_course FROM tb_user AS a JOIN tb_courses AS b ON b.id_user = a.id WHERE a.id='$idUser'" ;
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $id_user = $row['id'];
                                    $query = mysqli_query($con,"SELECT AVG(`nilai`) AS avg FROM `tb_quiz` WHERE id_user='$id_user'");
                                    $res = mysqli_fetch_assoc($query);
                                    $avg = $res['avg'] ?? 0;

                                    $query = mysqli_query($con,"SELECT COUNT(*) AS jml FROM `tb_users_badge` WHERE id_user='$id_user'");
                                    $res = mysqli_fetch_assoc($query);
                                    $bdg = $res['jml'] ?? 0;

                                    mysqli_query($con, "CALL `nilai_siswa`('$id_user', @p1, @p2, @p3, @p4, @p5, @p6)");
                                    $query = "SELECT @p1 AS `quiz1`, @p2 AS `quiz2`, @p3 AS `quiz3`, @p4 AS `chal1`, @p5 AS `chal2`, @p6 AS `chal3`";
                                    $hasil = mysqli_query($con, $query);
                                    $r_hasil = mysqli_fetch_assoc($hasil);
                                    $quiz1 = $r_hasil['quiz1'] ?? '0 (Belum mengerjakan)';
                                    $quiz2 = $r_hasil['quiz2'] ?? '0 (Belum mengerjakan)';
                                    $quiz3 = $r_hasil['quiz3'] ?? '0 (Belum mengerjakan)';
                                    $chal1 = $r_hasil['chal1'] ?? '-';
                                    $chal2 = $r_hasil['chal2'] ?? '-';
                                    $chal3 = $r_hasil['chal3'] ?? '0 (Belum mengerjakan)';
                                    echo "
                                        <tr>
                                            <th>Nama</th>
                                            <td>".$row["name"]."</td>
                                        </tr>
                                        <tr>
                                            <th>Progress</th>
                                            <td><div class='progress' role='progressbar' aria-label='Default striped example' aria-valuenow='10' aria-valuemin='0' aria-valuemax='100'>
                                            <div class='progress-bar progress-bar-striped' style='width: ". ($row["curr_course"]*4)."%'>".($row["curr_course"]*4)."%</div>
                                            </div></td>
                                        </tr>
                                        <tr>
                                            <th>Rata-Rata Nilai</th>
                                            <td>".$avg."</td>
                                        </tr>
                                        <tr>
                                            <th>Badges</th>
                                            <td>".$bdg."</td>
                                        </tr>
                                        <tr>
                                            <th>Quiz 1</th>
                                            <td>".$quiz1."</td>
                                        </tr>
                                        <tr>
                                            <th>Quiz 2</th>
                                            <td>".$quiz2."</td>
                                        </tr>
                                        <tr>
                                            <th>Quiz 3</th>
                                            <td>".$quiz3."</td>
                                        </tr>
                                        <tr>
                                            <th>Challenge 1</th>
                                            <td>".$chal1."</td>
                                        </tr>
                                        <tr>
                                            <th>Challenge 2</th>
                                            <td>".$chal2."</td>
                                        </tr>
                                        <tr>
                                            <th>Challenge 3</th>
                                            <td>".$chal3."</td>
                                        </tr>
                                        
                                    ";
				        	 ?>

							</tbody>
						</table>
				</div>
			</div>
		</div>
	</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
	integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
	integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
	crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/froala-editor@latest/js/plugins/image.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="../js/admin/view-challenge.js"></script>

</html>