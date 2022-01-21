<?php 
include 'assets/header.php';
include 'assets\includes\form-handlers\settings_handler.php';


?>
<div class="centerer">
<div class="main-setting-container">

	<h4 class='accoutn-titlte'>Account Settings</h4>
	<?php
	echo "<img src='" . $user['profile_picture'] ."' id='small_profile_pics'>";
	?>
	<br>

	<h4>Edit Email</h4>

	<?php
	$user_data_query = mysqli_query($conn, "SELECT username, email FROM users WHERE username='$userLoggedIn'");
	$row = mysqli_fetch_array($user_data_query);

	$email = $row['email'];
	?>

	<form action="settings.php" method="POST">
		Email: <input class='settings-input' type="text" name="email" value="<?php echo $email; ?>"><br><br>

		<input type="submit" name="update_details" id="save_details" value="Update Details" class='settings-btn'><br><br>

	</form>

	<h4>Change Password</h4>
	<form action="settings.php" method="POST">
		Old Password: <input class='settings-input' type="password" name="old_password" ><br><br>
		New Password: <input class='settings-input' type="password" name="new_password_1" ><br><br>
		Confirm New Password: <input  class='settings-input' type="password" name="new_password_2" ><br><br>

        <?php echo $password_message; ?>

		<input type="submit" name="update_password" id="save_details" value="Update Password" class='settings-btn'><br>
	</form>


</div>
</div>