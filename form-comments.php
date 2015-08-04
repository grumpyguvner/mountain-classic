<?php
$alert = null;
if(isset($_POST['send'])=="sendform"){
	
// Validation Check

$continue = true;
$validation = "";

if(empty($_POST['comment-name'])){
	$continue = false;
	$validation = "Your Name, ";
}
if(empty($_POST['comment-email'])){
	$continue = false;
	$validation .= "Email Address, ";
}
if(empty($_POST['comment-message'])){
	$continue = false;
	$validation .= "Your Comment";
}

// Validation OK, send email

if($continue===true){
		
	require 'system/email/phpmailer/PHPMailerAutoload.php';
	
	// Hotel Details
	
	$hotel_name = "Base Hotel";
	$hotel_email = "test@klayemorrison.com";
	
	// Send Email to Hotel
	
	$message = file_get_contents('system/email/template-hotel-comment.php');
	$message = str_replace('[post]', $_POST['comment-post'], $message);
	$message = str_replace('[name]', $_POST['comment-name'], $message);
	$message = str_replace('[email]', $_POST['comment-email'], $message);
	$message = str_replace('[message]', $_POST['comment-message'], $message);
	
	$mail = new PHPMailer;
	$mail->setFrom($_POST['comment-email'], $_POST['comment-name']);
	$mail->addAddress($hotel_email, $hotel_name);
	$mail->Subject = 'New Blog Comment from '.$_POST['comment-name'];
	$mail->MsgHTML($message);
	if (!$mail->send()) {
		$alert = "<div class='alert error'><i class='fa fa-exclamation-circle'></i> <strong>There was an error.</strong></div>";
	}
	else {
		$alert = "<div class='alert success'><i class='fa fa-check-circle'></i> <strong>Thank you for your comment.</strong> It is currently under review and will be added to the site shortly.</div>";
	}
}
else {
	$alert = "<div class='alert validate'><i class='fa fa-exclamation-circle'></i> Please fill out the following fields: <strong>".$validation."</strong></div>";
}
}
?>
<!DOCTYPE HTML>
<!-- Base Hotel: HTML Template by Klaye Morrison (http://klayemorrison.com) -->
<html>
<head>
<meta charset="utf-8">
<title>Leave a Comment</title>
<link rel="stylesheet" href="system/css/global.css">
<link class="colour" rel="stylesheet" href="system/css/colour-blue.css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<script src="system/js/plugins.js"></script>
<script src="system/js/global.js"></script>
</head>
<body>
<div id="pop" class="popform">
	<?=$alert;?>
    <div class="container">
        <p class="title"><strong>Leave a Comment</strong></p>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        	<input name="comment-post" type="hidden" value="<?php echo $_GET['post']; ?>" />
            <input name="comment-name" type="text" placeholder="Your Name" />
            <input name="comment-email" type="text" placeholder="Email Address" />
            <textarea name="comment-message" placeholder="Your Comment"></textarea>
            <button name="send" value="sendform"><span data-hover="Submit Comment">Submit Comment</span></button>
        </form>
    </div>
</div>
</body>
</html>
