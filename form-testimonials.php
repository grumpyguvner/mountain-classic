<?php
$alert = null;
if(isset($_POST['send'])=="sendform"){
	
// Validation Check

$continue = true;
$validation = "";

if(empty($_POST['testimonial-name'])){
	$continue = false;
	$validation = "Your Name, ";
}
if(empty($_POST['testimonial-email'])){
	$continue = false;
	$validation .= "Email Address, ";
}
if(empty($_POST['testimonial-location'])){
	$continue = false;
	$validation .= "Location (Town / City), ";
}
if(empty($_POST['testimonial-title'])){
	$continue = false;
	$validation .= "Testimonial Title, ";
}
if(empty($_POST['testimonial-message'])){
	$continue = false;
	$validation .= "Your Testimonial";
}

// Validation OK, send email

if($continue===true){
		
	require 'system/email/phpmailer/PHPMailerAutoload.php';
	
	// Hotel Details
	
	$hotel_name = "Base Hotel";
	$hotel_email = "test@klayemorrison.com";
	
	// Send Email to Hotel
	
	$message = file_get_contents('system/email/template-hotel-testimonial.php');
	$message = str_replace('[name]', $_POST['testimonial-name'], $message);
	$message = str_replace('[email]', $_POST['testimonial-email'], $message);
	$message = str_replace('[location]', $_POST['testimonial-location'], $message);
	$message = str_replace('[title]', $_POST['testimonial-title'], $message);
	$message = str_replace('[message]', $_POST['testimonial-message'], $message);
	
	$mail = new PHPMailer;
	$mail->setFrom($_POST['testimonial-email'], $_POST['testimonial-name']);
	$mail->addAddress($hotel_email, $hotel_name);
	$mail->Subject = 'New Testimonial from '.$_POST['testimonial-name'];
	$mail->MsgHTML($message);
	if (!$mail->send()) {
		$alert = "<div class='alert error'><i class='fa fa-exclamation-circle'></i> <strong>There was an error.</strong></div>";
	}
	else {
		$alert = "<div class='alert success'><i class='fa fa-check-circle'></i> <strong>Thank you for your testimonial.</strong> We will review your feedback and use it to improve our level of service.</div>";
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
<title>Write in Guest Book</title>
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
        <p class="title"><strong>Share your Experience</strong></p>
        <p>Your feedback means the world to us, it's how we improve our level of service. Feel free to share your experience if you've stayed with us before.</p>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input name="testimonial-name" type="text" placeholder="Your Name" />
            <input name="testimonial-email" type="text" placeholder="Email Address" />
            <input name="testimonial-location" type="text" placeholder="Location (Town / Country)" />
            <input name="testimonial-title" type="text" placeholder="Testimonial Title" />
            <textarea name="testimonial-message" placeholder="Your Testimonial"></textarea>
            <button name="send" value="sendform"><span data-hover="Write in Guest Book">Write in Guest Book</span></button>
        </form>
    </div>
</div>
</body>
</html>
