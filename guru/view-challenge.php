<?php 
	session_start();
	include("../db.php");
	include('../server.php');
	if(!isset($_SESSION['name'])){
		header("Location: ".$mainUrl);
	}
    $idPost = $_GET['id'];
    $idUser = $_GET['user'];
    $challenge = $_GET['challenge'];
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
				<div class="section" id="progress-menu">
					<span><i class="bi bi-people-fill"></i> &nbsp;&nbsp; Progress Siswa</span>
				</div>
				<div class="section" id="postingan-menu">
					<i class="bi bi-file-earmark-richtext-fill"></i> &nbsp;&nbsp; Postingan Siswa</span>
				</div>
				<div class="section current" id="challenge-menu">
					<i class="bi bi-clipboard-check"></i> &nbsp;&nbsp; Challenges Siswa</span>
				</div>
				<br><br>
				<center><a class="btn btn-success" href="../guru">Home <i class="bi bi-arrow-right"></i></a></center>
			</div>
			<div class="col-lg-9 right-content">
				<div class="content-3" style="display:block;">
					<h3 id="chlg-title"><i class="bi bi-clipboard-check"></i>  &nbsp;&nbsp; Challenges Siswa</h3>
					<div class="your-post">
                        <?php
                            $sql = "SELECT *, b.photo_profile, b.username, b.name FROM tb_post AS a JOIN tb_user AS b ON a.id_user = b.id WHERE a.id = '$idPost'";
                            $result = mysqli_query($con, $sql);
                            while($r_post = mysqli_fetch_assoc($result)){
                                $id_post = $idPost;
                                $nilai = $r_post['grade'];
                                echo '
                                    <div class="post">
                                        <div class="top">
                                            <div class="top-photo">
                                                <img src= '. $r_post['photo_profile'] .' class="avatar">
                                            </div>
                                            <div class="top-name">
                                                <b><span><a class="no-undr" href="#">'. $r_post['name'] .'</a></span></b><span>&nbsp;&nbsp;'. $r_post['username'] .'</span>
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
                                $curr_user_id = $_SESSION['user_id'];	
                                $curr_username = $_SESSION['username'];
                                $curr_photoProfile = $_SESSION['photo_profile'];
                                mysqli_query($con, "CALL like_comment('$curr_user_id','$id_post',@liked,@likes,@comments)");
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
                                                        <b><span><a class="no-undr" href="#">'.$r_comments['username'].'</a></span></b><span>&nbsp;&nbsp;'.$r_comments['created_at'].'</span><br>
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
                                                    <div class="send" id="send'.$id_post.'" data-id="'.$id_post.'" data-username="'. $curr_username.'" data-profile="'. $curr_photoProfile .'" data-user="'. $curr_user_id.'" onclick="sendComment(this);">
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
                    <?php 
                        if($nilai == '-'){

                    ?>
                        <label for="nilai" class='form-nilai'>Beri Nilai : </label>
                        <select name="nilai" id="nilai" class='form-nilai'>
                            <option value="A" selected>A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                        </select>
                        &nbsp;&nbsp;<button class='btn btn-success admin btn-action' data-id='<?php echo $idPost ?>' data-user='<?php echo $idUser ?>' data-status='1' data-challenge='<?php echo $challenge ?>' id='accepted' onclick='usersChallenge(this);' style='width: 100px;'>Terima</button>&nbsp;&nbsp;
                        <button class='btn btn-danger admin btn-action' data-id='<?php echo $idPost ?>' data-user='<?php echo $idUser ?>'  data-status='2' data-challenge='<?php echo $challenge ?>' id='rejected' onclick='usersChallenge(this);' style='width: 100px;'>Tolak</button>&nbsp;&nbsp;
                    <?php
                        }else{

                    ?>
                    <br>
                    <span><b>Nilai : </b><?php echo $nilai ?></span>
                    <?php
                        }
                    ?>
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