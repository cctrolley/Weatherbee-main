<link rel="stylesheet" href="assets/css/style.css">
<style>
    body{
        background-color: #FFFFFF;
        margin:0;
        overflow: hidden;
    }
    form{
        margin:0;
    }

</style>

<?php  
require "assets/config/db.php";
include 'assets/classes/user.php';
include 'assets/classes/post.php';


	if (isset($_SESSION['username'])) {
		$userLoggedIn = $_SESSION['username'];
		$user_details_query = mysqli_query($conn, "SELECT * FROM users WHERE username='$userLoggedIn'");
		$user = mysqli_fetch_array($user_details_query);
	}
	else {
		header("Location: login.php");
	}

	//Get id of post
	if(isset($_GET['post_id'])) {
		$post_id = $_GET['post_id'];
	}

	$get_likes = mysqli_query($conn, "SELECT likes, added_by FROM posts WHERE id='$post_id'");
	$row = mysqli_fetch_array($get_likes);
	$total_likes = $row['likes']; 
	$user_liked = $row['added_by'];


	//Like button
	if(isset($_POST['like_button'])) {
		$total_likes++;
		$query = mysqli_query($conn, "UPDATE posts SET likes='$total_likes' WHERE id='$post_id'");
		$insert_user = mysqli_query($conn, "INSERT INTO likes VALUES('', '$userLoggedIn', '$post_id')");

		//Insert Notification
	}
	//Unlike button
	if(isset($_POST['unlike_button'])) {
		$total_likes--;
		$query = mysqli_query($conn, "UPDATE posts SET likes='$total_likes' WHERE id='$post_id'");
		$insert_user = mysqli_query($conn, "DELETE FROM likes WHERE username='$userLoggedIn' AND post_id='$post_id'");
	}

	//Check for previous likes
	$check_query = mysqli_query($conn, "SELECT * FROM likes WHERE username='$userLoggedIn' AND post_id='$post_id'");
	$num_rows = mysqli_num_rows($check_query);

	if($num_rows > 0) {
		echo '<form action="likes.php?post_id=' . $post_id . '" method="POST" class="likes">
				<input type="submit" class="comment_like" name="unlike_button" value="♥">
				<div class="like_value">
                '. $total_likes .'
				</div>
			</form>
		';
	}
	else {
		echo '<form action="likes.php?post_id=' . $post_id . '" method="POST" class="likes"> 
				<input type="submit" class="comment_like" name="like_button" value="♡">
				<div class="like_value">
				'. $total_likes .'
				</div>
			</form>
		';
	}


	?>