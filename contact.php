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
<title>Base Hotel - Contact</title>
<link rel="stylesheet" href="css/classic.css">
<link class="colour" rel="stylesheet" href="css/colour-classic-ski.css">
<link class="pattern" rel="stylesheet" href="css/pattern-classic-ski.css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
</head>
<body class="fullwidth">
<!-- Navigation | START -->
<div id="nav">
    <div class="centre">
        <a href="index.html" class="logo"><img alt="" src="system/images/logo.png" /></a>
        <nav>
            <ul>
            	<li class="mobile"><a href="contact.php" class="navbook">Book Online</a></li>
                <li><a href="index.html">Home</a>
                	<ul>
                    	<li><a href="index.html">Home 1 &nbsp;(Default)</a></li>
                        <li><a href="index2.html">Home 2 &nbsp;(Full Screen)</a></li>
                        <li><a href="index3.html">Home 3 &nbsp;(Colourful)</a></li>
                        <li><a href="single.html">Single Page</a></li>
                    </ul>
                </li>
                <li><a href="accommodation.html">Accommodation</a>
                	<ul>
                    	<li><a href="accommodation.html">Accommodation List 1</a></li>
                        <li><a href="accommodation2.html">Accommodation List 2</a></li>
                        <li><a href="room.html">Room Detail 1</a></li>
                        <li><a href="room2.html">Room Detail 2</a></li>
                    </ul>
                </li>
                <li><a href="about.html">More Pages</a>
                	<ul>
                    	<li><a href="about.html">About Hotel</a></li>
                        <li><a href="restaurant.php">Restaurant</a></li>
                        <li><a href="specials.html">Special Offers</a></li>
                        <li><a href="gallery.html">Photo Gallery</a></li>
                        <li><a href="location.html">Location</a></li>
                        <li><a href="blog.html">Our Blog <i class="fa fa-chevron-right"></i></a>
                        	<ul>
                                <li><a href="blog.html">Blog Overview</a></li>
                                <li><a href="blog-post.html">Blog Post</a></li>
                            </ul>
                        </li>
                        <li><a href="guest-book.html">Guest Book</a></li>
                        <li><a href="faqs.html">FAQs</a></li>
                        <li><a class="promopopup">Promo Popup</a></li>
                    </ul>
                </li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
            <a id="pull"><i class="fa fa-bars"></i></a>
        </nav>
        <!-- Languages | START -->
        <div id="language">
        	<ul>
            	<li class="en"><a>EN</a></li>
                <li class="cn"><a href="#">CN</a></li>
                <li class="fr"><a href="#">FR</a></li>
                <li class="de"><a href="#">DE</a></li>
                <li class="it"><a href="#">IT</a></li>
            </ul>
        </div>
        <!-- Languages | END -->
        <a href="contact.php" class="book"><span data-hover="Book Online">Book Online</span> <i class="fa fa-check-circle"></i></a>
        <div class="shadow"></div>
    </div>
</div>
<!-- Navigation | END -->
<div id="container">
	<!-- Header | Start -->
	<header>
    	<div id="header">
        	<div class="h1">
                <h1><span>Contact</span>
                <span class="tagline">Get in touch with Base Hotel</span></h1>
            </div>
        </div>
    </header>
    <!-- Header | END -->
    <!-- Content | START -->
    <main>
    	<div class="centre">
            <!-- Contact Form | START -->
        	<div id="contact">
            	<img src="http://dummyimage.com/1200x400" width="1200" height="400" alt="" />
                <?=$alert;?>
                <form name="contact" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
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
            101 Luxury Street, Perth, WA Australia 6000<br />
            <a href="location.html"><i class="fa fa-map-marker"></i> Explore Our Location</a></p>
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
    <!-- Sitewide Extras | START -->
    <div id="extras">
    	<div class="centre">
        	<!-- List Items (Specials Slider) | START -->
            <div id="specials" class="list">
                <div class="back">
                    <div class="slider">
                    	<div class="item">
                        	<img alt="" src="http://dummyimage.com/1200x400" width="1200" height="400" />
                            <div class="details">
                                <a href="specials.html">
                                    <div class="title">Family Escape<br />
                                    <span>Activity Package</span></div>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna.<br />
                                    <strong>Stay from $249 per night</strong></p>
                                    <div class="button"><span data-hover="View Special">View Special</span></div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="nav"></div>
            </div>
            <!-- List Items (Specials Slider) | END -->
        	<!-- Recent Blog Posts | START -->
            <div class="recent">
                <a href="blog-post.html">
                	<div class="date">
                    	<span class="month">Dec</span>
                        <span class="day">12</span>
                    </div>
                    <p class="title">Our Latest Hotel Awards</p>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque...</p>
                </a>
                <a href="blog-post.html">
                	<div class="date">
                    	<span class="month">Nov</span>
                        <span class="day">27</span>
                    </div>
                    <p class="title">Free Wi-Fi in all rooms</p>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque...</p>
                </a>
            </div>
            <!-- Recent Blog Posts | END -->
        	<!-- Footer Testimonial | START -->
            <div class="footertestimonial">
            	<i class="fa fa-quote-left"></i>
                <p class="title">Comfortable & spacious apartment</p>
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Lorem ipsum dolor sit amet...</p>
                <div class="author">&ndash; <strong>John Smith</strong> <span>(Sydney, Australia)</span></div>
                <a href="guest-book.html" class="button"><span data-hover="Read Guest Book">Read Guest Book</span></a>
            </div>
            <!-- Footer Testimonial | END -->
        </div>
    </div>
    <!-- Sitewide Extras | END -->
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
            	<!-- Contact Details | START -->
            	<div class="contact">
                	<p><strong class="phone">+61 8 3456 7890</strong><br />
                    <a href="mailto:stay@basehotel.com">stay@basehotel.com</a><br /><br />
                    <i class="fa fa-map-marker"></i> 101 Luxury Street<br />
                    Perth, WA Australia 6000<br />
                    <a href="https://www.google.com/maps/dir/Current+Location/-31.957482,115.856868" target="_blank"><strong>Get Directions</strong></a></p>
                </div>
                <!-- Contact Details | END -->
                <div class="dark"></div>
            </div>
        </div>
    	<!-- Footer Links | START -->
    	<div id="footerlinks">
        	<div class="centre">
            	<span>Copyright &copy; <script>var d = new Date(); document.write(d.getFullYear());</script> <strong>Base Hotel</strong></span><a href="index.html">Home</a><a href="sitemap.html">Sitemap</a><span><a href="http://themeforest.net/item/base-hotel-responsive-booking-gallery-template/10517095?ref=Klayemore" target="_blank">Template By KM</a></span><span></span>
            </div>
        </div>
        <!-- Footer Links | END -->
    </footer>
    <!-- Footer | END -->
</div>
<!-- Promo Popup | START -->
<div id="pop">
	<img alt="" src="http://dummyimage.com/400x150" width="400" height="150" />
    <div class="container">
        <p class="title"><strong>Our latest special offers,</strong><br />
        straight to your inbox</p>
        <p>Stay up to date with the latest specials from Base Hotel. Subscribe and save on your next stay.</p>
        <form>
            <input name="email" type="text" placeholder="Your email address" />
            <button><span data-hover="Subscribe">Subscribe</span></button>
        </form>
        <p class="close closepop"><a>Continue browsing site</a></p>
        <i class="fa fa-close closepop"></i>
    </div>
</div>
<!-- Promo Popup | END -->
<script src="system/js/plugins.js"></script>
<script src="system/js/global.js"></script>
</body>
</html>