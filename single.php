<?php
$alert = null;
if(isset($_POST['send'])=="sendform"){
	
// Validation Check

$continue = true;
$validation = "";

if(empty($_POST['contact-name'])){
	$continue = false;
	$validation = "First Name, ";
}
if(empty($_POST['contact-email'])){
	$continue = false;
	$validation .= "Email Address, ";
}
if(empty($_POST['contact-phone'])){
	$continue = false;
	$validation .= "Phone Number";
}

// Validation OK, send email

if($continue===true){
		
	require 'system/email/phpmailer/PHPMailerAutoload.php';
	
	// Hotel Details
	
	$hotel_name = "Base Hotel";
	$hotel_email = "test@klayemorrison.com";
	
	// Send Email to Guest
	
	$message = file_get_contents('system/email/template-guest.php');
	$message = str_replace('[name]', $_POST['contact-name'], $message);
	$message = str_replace('[email]', $_POST['contact-email'], $message);
	$message = str_replace('[phone]', $_POST['contact-phone'], $message);
	$message = str_replace('[arrival]', $_POST['contact-arrival'], $message);
	$message = str_replace('[departure]', $_POST['contact-departure'], $message);
	$message = str_replace('[rooms]', $_POST['contact-rooms'], $message);
	$message = str_replace('[adults]', $_POST['contact-adults'], $message);
	$message = str_replace('[children]', $_POST['contact-children'], $message);
	$message = str_replace('[message]', $_POST['contact-message'], $message);
	
	$mail = new PHPMailer;
	$mail->setFrom($hotel_email, $hotel_name);
	$mail->addAddress($_POST['contact-email'], $_POST['contact-name']);
	$mail->Subject = $hotel_name.' Booking Request';
	$mail->MsgHTML($message);
	$mail->IsHTML(true);
	$mail->send();
	
	// Send Email to Hotel
	
	$message = file_get_contents('system/email/template-hotel.php');
	$message = str_replace('[name]', $_POST['contact-name'], $message);
	$message = str_replace('[email]', $_POST['contact-email'], $message);
	$message = str_replace('[phone]', $_POST['contact-phone'], $message);
	$message = str_replace('[arrival]', $_POST['contact-arrival'], $message);
	$message = str_replace('[departure]', $_POST['contact-departure'], $message);
	$message = str_replace('[rooms]', $_POST['contact-rooms'], $message);
	$message = str_replace('[adults]', $_POST['contact-adults'], $message);
	$message = str_replace('[children]', $_POST['contact-children'], $message);
	$message = str_replace('[message]', $_POST['contact-message'], $message);
	
	$mail = new PHPMailer;
	$mail->setFrom($_POST['contact-email'], $_POST['contact-name']);
	$mail->addAddress($hotel_email, $hotel_name);
	$mail->Subject = 'Booking Request from '.$_POST['contact-name'];
	$mail->MsgHTML($message);
	if (!$mail->send()) {
		$alert = "<div class='alert error'><i class='fa fa-exclamation-circle'></i> <strong>There was an error, please call us to make a booking.</strong></div>";
	}
	else {
		$alert = "<div class='alert success'><i class='fa fa-check-circle'></i> <strong>Thank you for your booking request, we will get back to you as soon as possible.</strong> To avoid missing out, please give us a call so that we may assist you sooner.</div>";
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
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Base Hotel - Experience Luxury</title>
<link rel="stylesheet" href="system/css/global.css">
<link class="colour" rel="stylesheet" href="system/css/colour-blue.css">
<link class="pattern" rel="stylesheet" href="system/css/pattern-china.css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
</head>
<body class="singlepage fullwidth">
<!-- Navigation | START -->
<div id="nav">
    <div class="centre">
        <img alt="" src="system/images/logo.png" class="logo" />
        <div class="shadow"></div>
    </div>
</div>
<!-- Navigation | END -->
<div id="container">
	<!-- Header | START -->
	<header>
    	<!-- Featured Slider | START -->
        <div id="featured">
        	<div class="slider">
            	<div class="item">
                    <img alt="" src="http://dummyimage.com/1800x800" width="1800" height="800" />
                </div>
            </div>
            <div class="centre">
            	<div class="nav">
                    <a class="prev"><i class="fa fa-chevron-left"></i></a>
                    <a class="next"><i class="fa fa-chevron-right"></i></a>
                </div>
            </div>
        </div>
        <!-- Featured Slider | END -->
        <!-- Check Rates Banner | START -->
        <div id="check">
        	<div class="centre">
            	<form action="single.php#contact" method="post">
                	<div class="field calendar"><input name="arrival" type="text" placeholder="Arrival" id="arrival" readonly /><i class="fa fa-calendar-o"></i></div>
                    <div class="field calendar"><input name="departure" type="text" placeholder="Departure" id="departure" readonly /><i class="fa fa-calendar-o"></i></div>
                    <div class="field select">
                        <select name="rooms">
                            <option value="1 Room">1 Room</option>
                            <option value="2 Rooms">2 Rooms</option>
                            <option value="3 Rooms">3 Rooms</option>
                        </select>
                        <i class="fa fa-chevron-down"></i>
                    </div>
                    <div class="field select">
                        <select name="adults">
                            <option value="1 Adult">1 Adult</option>
                            <option value="2 Adults">2 Adults</option>
                            <option value="3 Adults">3 Adults</option>
                            <option value="4 Adults">4 Adults</option>
                            <option value="5 Adults">5 Adults</option>
                        </select>
                        <i class="fa fa-chevron-down"></i>
                    </div>
                    <div class="field select">
                        <select name="children">
                        	<option value="0 Children">0 Children</option>
                            <option value="1 Child">1 Child</option>
                            <option value="2 Children">2 Children</option>
                            <option value="3 Children">3 Children</option>
                            <option value="4 Children">4 Children</option>
                        </select>
                        <i class="fa fa-chevron-down"></i>
                    </div>
                    <button><span data-hover="Book a Room">Book a Room</span></button>
                </form>
            </div>
        </div>
        <!-- Check Rates Banner | END -->
    </header>
    <!-- Header | END -->
    <!-- Content | START -->
    <main>
    	<div class="centre">
            <h1>Experience Luxury & <strong>Find Your Base</strong></h1>
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Nullam mollis. Ut justo. Suspendisse potenti. Sed egestas, ante et vulputate volutpat, eros pede semper est, vitae luctus metus libero eu augue. Morbi purus libero, faucibus adipiscing, commodo quis, gravida id, est. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna.</p>
            <!-- USP Boxes | START -->
            <section class="usp">
            	<div class="box">
                	<i class="fa fa-trophy"></i>
                	<h3>Rated #1 on TripAdvisor</h3>
                	<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id.</p>
                </div>
                <div class="box">
                	<i class="fa fa-cutlery"></i>
                	<h3>Award-Winning Restaurant</h3>
                	<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id.</p>
                </div>
                <div class="box">
                	<i class="fa fa-user"></i>
                	<h3>24 Hour Concierge Service</h3>
                	<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id.</p>
                </div>
            </section>
            <!-- USP Boxes | END -->
        </div>
    <!-- Content | END -->
    <!-- Gallery Slider | START -->
    <div id="galleryslider" class="manual">
    	<div class="slidecontainer">
            <div class="slider">
            	<img alt="" src="http://dummyimage.com/900x600" width="900" height="600" />
            	<img alt="" src="http://dummyimage.com/900x600" width="900" height="600" />
            	<img alt="" src="http://dummyimage.com/900x600" width="900" height="600" />
            	<img alt="" src="http://dummyimage.com/900x600" width="900" height="600" />
            </div>
            <div class="centre">
                <div class="nav">
                    <a class="prev"><i class="fa fa-chevron-left"></i></a>
                    <a class="next"><i class="fa fa-chevron-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Gallery Slider | END -->
    <!-- Content | START -->
    <div class="centre">
        <div id="content">
            <h2><strong>Find Your Base</strong> with our selection of rooms & suites</h2>
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Nullam mollis. Ut justo. Suspendisse potenti. Sed egestas, ante et vulputate volutpat, eros pede semper est, vitae luctus metus libero eu augue. Morbi purus libero, faucibus adipiscing, commodo quis, gravida id, est. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna.</p>
            <table>
                <tr>
                    <th>Room Type</th>
                    <th>Low Season</th>
                    <th>Mid Season</th>
                    <th>High Season</th>
                </tr>
                <tr>
                    <td><strong>Standard Room</strong></td>
                    <td>$149</td>
                    <td>$169</td>
                    <td>$199</td>
                </tr>
                <tr>
                    <td><strong>Ocean View Room</strong></td>
                    <td>$199</td>
                    <td>$219</td>
                    <td>$249</td>
                </tr>
                <tr>
                    <td><strong>Deluxe Room</strong></td>
                    <td>$225</td>
                    <td>$245</td>
                    <td>$275</td>
                </tr>
                <tr>
                    <td><strong>Junior Suite</strong></td>
                    <td>$240</td>
                    <td>$260</td>
                    <td>$290</td>
                </tr>
                <tr>
                    <td><strong>Premiere Suite</strong></td>
                    <td>$279</td>
                    <td>$299</td>
                    <td>$329</td>
                </tr>
                <tr>
                    <td><strong>3 Bed Penthouse</strong></td>
                    <td>$329</td>
                    <td>$349</td>
                    <td>$379</td>
                </tr>
            </table>
            <a href="#" class="button"><span data-hover="Book a Room">Book a Room</span></a>
        </div>
    </div>
    <!-- Feature List | START -->
    <section id="featurelist">
        <div class="centre">
            <h2>Things to do in Perth</h2>
            <!-- Slideshow | START -->
            <div id="slideshow">
                <div class="slider">
                    <div class="item"><img alt="" src="http://dummyimage.com/1200x600" width="1200" height="600" /></div>
                </div>
                <div class="nav">
                    <a class="prev"><i class="fa fa-chevron-left"></i></a>
                    <a class="next"><i class="fa fa-chevron-right"></i></a>
                </div>
            </div>
            <!-- Slideshow | END -->
            <div class="featurelist">
                <div class="feature">
                    <img alt="" src="http://dummyimage.com/120x120" width="120" height="120" class="thumb" />
                    <div class="details">
                        <h3>The Bell Tower</h3>
                        <p>Barrack Square Riverside Drive<br /><br />
                        <a href="#"><i class="fa fa-external-link"></i> Visit Website</a></p>
                    </div>
                    <div class="copy">
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Nullam mollis. Ut justo. Suspendisse potenti. Sed egestas, ante et vulputate volutpat.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Feature List | END -->
    <!-- Content | END -->
    <!-- Content | START -->
        <div class="centre">
            <!-- Contact Form | START -->
        	<div id="contact">
            	<img src="http://dummyimage.com/1200x400" width="1200" height="400" alt="" />
                <?=$alert;?>
                <form name="contact" action="<?php echo $_SERVER['PHP_SELF']; ?>#contact" method="post">
                	<?php
					(isset($_POST["rooms"])) ? $rooms = $_POST["rooms"] : $rooms = $_POST["contact-rooms"];
					(isset($_POST["adults"])) ? $adults = $_POST["adults"] : $adults  = $_POST["contact-adults"];
					(isset($_POST["children"])) ? $children = $_POST["children"] : $children = $_POST["contact-children"];
					?>
                    <div class="col">
                        <div class="field mandatory"><input name="contact-name" type="text" placeholder="Your Name" id="contact-name" value="<?php echo isset($_POST['contact-name'])?$_POST['contact-name']:""; ?>" /></div>
                        <div class="field mandatory"><input name="contact-email" type="text" placeholder="Email Address" id="contact-email" value="<?php echo isset($_POST['contact-email'])?$_POST['contact-email']:""; ?>" /></div>
                        <div class="field mandatory"><input name="contact-phone" type="text" placeholder="Phone Number" id="contact-phone" value="<?php echo isset($_POST['contact-phone'])?$_POST['contact-phone']:""; ?>" /></div>
                    </div>
                    <div class="col">
                        <div class="field calendar"><input name="contact-arrival" type="text" placeholder="Arrival Date" id="contact-arrival" value="<?php if (isset($_POST['arrival']) && !empty($_POST['arrival'])) { echo $_POST['arrival']; } else { echo isset($_POST['contact-arrival'])?$_POST['contact-arrival']:""; } ?>" readonly /><i class="fa fa-calendar-o"></i></div>
                        <div class="field calendar"><input name="contact-departure" type="text" placeholder="Departure Date" id="contact-departure" value="<?php if (isset($_POST['departure']) && !empty($_POST['departure'])) { echo $_POST['departure']; } else { echo isset($_POST['contact-departure'])?$_POST['contact-departure']:""; } ?>" readonly /><i class="fa fa-calendar-o"></i></div>
                        <div class="select">
                        	<select name="contact-rooms" id="contact-rooms" class="infants">
                                <option <?php if ($rooms == 1 ) echo 'selected'; ?> value="1">1 Room</option>
                                <option <?php if ($rooms == 2 ) echo 'selected'; ?> value="2" >2 Rooms</option>
                                <option <?php if ($rooms == 3 ) echo 'selected'; ?> value="3" >3 Rooms</option>
                            </select>
                            <select name="contact-adults" id="contact-adults" class="adults">
                                <option <?php if ($adults == 1 ) echo 'selected'; ?> value="1" >1 Adult</option>
                                <option <?php if ($adults == 2 ) echo 'selected'; ?> value="2">2 Adults</option>
                                <option <?php if ($adults == 3 ) echo 'selected'; ?> value="3" >3 Adults</option>
                                <option <?php if ($adults == 4 ) echo 'selected'; ?> value="4" >4 Adults</option>
                                <option <?php if ($adults == 5 ) echo 'selected'; ?> value="5" >5 Adults</option>
                            </select>
                            <select name="contact-children" id="contact-children" class="children">
                                <option <?php if ($children == 0 ) echo 'selected'; ?> value="0">0 Children</option>
                                <option <?php if ($children == 1 ) echo 'selected'; ?> value="1" >1 Child</option>
                                <option <?php if ($children == 2 ) echo 'selected'; ?> value="2" >2 Children</option>
                                <option <?php if ($children == 3 ) echo 'selected'; ?> value="3" >3 Children</option>
                                <option <?php if ($children == 4 ) echo 'selected'; ?> value="4" >4 Children</option>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="field"><textarea name="contact-message" placeholder="Message" id="contact-message"><?php echo isset($_POST['contact-message'])?$_POST['contact-message']:""; ?></textarea></div>
                    </div>
                    <button name="send" value="sendform"><span data-hover="Send Booking Request">Send Booking Request</span></button>
                </form>
            </div>
            <!-- Contact Form | END -->
            <h2 style="margin:0;"><strong>+61 8 3456 7890</strong></h2>
            <p style="margin:0;"><a href="mailto:stay@basehotel.com">stay@basehotel.com</a><br />
            101 Luxury Street, Perth, WA Australia 6000</p>
        </div>
        <!-- Google Map | START -->
        <script>
			function initialize() {
			var latlng = new google.maps.LatLng(-31.957482,115.856868);
			var myOptions = {
			zoom: 14,
			center: latlng,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			scrollwheel: false
			};
			var map = new google.maps.Map(document.getElementById('googlemap'), myOptions);
			var marker = new google.maps.Marker({
			position: latlng, 
			map: map,
			icon: "system/images/point.png"
			});
			}
			function loadScript() {
			var script = document.createElement('script');
			script.type = 'text/javascript';
			script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&'+'callback=initialize';
			document.body.appendChild(script);
			}
			window.onload = loadScript;
		</script>
    	<div id="map">
            <div id="googlemap"></div>
        </div>
        <!-- Google Map | END -->
    </main>
    <!-- Content | END -->
    <!-- Footer | START -->
    <footer>
    	<div id="footer">
        	<div class="centre">
                <!-- Subscribe / Social | START -->
                <div class="news">
                	<div class="title"><span>News & Offers</span></div>
                    <div class="subscribe">
                        <form>
                            <input name="email" type="text" placeholder="Your email address" />
                            <button><span data-hover="Sign Up">Sign Up</span></button>
                        </form>
                    </div>
                    <div class="social">
                    	<a href="#" title="Facebook"><i class="fa fa-facebook"></i></a>
                        <a href="#" title="Twitter"><i class="fa fa-twitter"></i></a>
                        <a href="#" title="Pinterest"><i class="fa fa-pinterest-p"></i></a>
                    </div>
                </div>
                <!-- Subscribe / Social | END -->
            </div>
        </div>
        <!-- Footer Links | START -->
    	<div id="footerlinks">
        	<div class="centre">
            	Copyright &copy; <script>var d = new Date(); document.write(d.getFullYear());</script> <strong>Base Hotel</strong><span><a href="http://themeforest.net/item/base-hotel-responsive-booking-gallery-template/10517095?ref=Klayemore" target="_blank">Template By KM</a></span>
            </div>
        </div>
        <!-- Footer Links | END -->
    </footer>
    <!-- Footer | END -->
</div>
<script src="system/js/plugins.js"></script>
<script src="system/js/global.js"></script>
</body>
</html>