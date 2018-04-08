<?php
	if(!empty($_POST["forgot-password"])){
		$conn = mysqli_connect("localhost", "root", "", "user");
		
		$condition = "";
		if(!empty($_POST["user-email"])) {
			if(!empty($condition)) {
				$condition = " and ";
			}
			$condition = " email = '" . $_POST["user-email"] . "'";
		}
		
		if(!empty($condition)) {
			$condition = " where " . $condition;
		}

		$sql = "select * from tbl_registered_users " . $condition;
		$result = mysqli_query($conn,$sql);
		$user = mysqli_fetch_array($result);
		if(!empty($user)) {
			$to = $user['email'];
$subject = "Forgot Password";
$newpass = rand();
$message = "Please check your new password as : ".$newpass;	


        $sql = "update table tbl_registered_users set password =".md5($newpass)." where email ='".$user['email']."'";
        
        $db->exec($sql);
        
        $database->closeConnection();
       
// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <webmaster@example.com>' . "\r\n";

if(@mail($to,$subject,$message,$headers))
{
	echo "Mail sent";
	
}
else
{
	echo "failed";
}

			
//			require_once("forgot-password-recovery-mail.php");
		} else {
			$error_message = 'No User Found';
		}
	}
?>
<script>
function validate_forgot() {
	if((document.getElementById("user-email").value == "")) {
		document.getElementById("validation-message").innerHTML = "Email is required!"
		return false;
	}
	return true
}
</script>
<link rel="stylesheet" type="text/css" href="styles.css">

<div class="demo-content">
<form name="frmForgot" id="frmForgot" method="post" onSubmit="return validate_forgot();">
<h1>Forgot Password?</h1>
	<?php if(!empty($success_message)) { ?>
	<div class="success_message"><?php echo $success_message; ?></div>
	<?php } ?>

	<div id="validation-message">
		<?php if(!empty($error_message)) { ?>
	<?php echo $error_message; ?>
	<?php } ?>
	</div>

            <div class="row">
                <label>Email</label><span id="email_error"></span>
                <div>
                    <input type="text" name="user-email" id="user-email"
                        class="form-control"
                        placeholder="Enter your Email ID">

                </div>
            </div>
            <div class="row">
                <div>
                    <input type="submit" name="forgot-password" id="forgot-password" value="Submit" class="form-submit-button">
                </div>
            </div>

	
	
</form>
</div>