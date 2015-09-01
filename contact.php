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
	
	$hotel_name = "Classic Alpine";
	$hotel_email = "info@classicalpine.com";
	
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
	$mail->Subject = $hotel_name.' Contact Request';
	$mail->MsgHTML($message);
	$mail->IsHTML(true);
//	$mail->send();
	
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
	$mail->Subject = 'Contact Request from '.$_POST['contact-name'];
	$mail->MsgHTML($message);
//	if (!$mail->send()) {
//		$alert = "<div class='alert error'><i class='fa fa-exclamation-circle'></i> <strong>We are sorry but there was an error, please try again later or call us.</strong></div>";
//	}
//	else {
//		$alert = "<div class='alert success'><i class='fa fa-check-circle'></i> <strong>Thank you for your contact request, we will get back to you as soon as possible.</strong> To avoid missing out, please give us a call so that we may assist you sooner.</div>";
//	}
    $alert = "<div class='alert error'><i class='fa fa-exclamation-circle'></i> <strong>We are sorry but there was an error, please try again later or call us.</strong></div>";
}
else {
	$alert = "<div class='alert validate'><i class='fa fa-exclamation-circle'></i> Please fill out the following fields: <strong>".$validation."</strong></div>";
}
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Classic Alpine - Contact Us, Get in touch with Classic Alpine</title>
<link rel="stylesheet" href="/css/classic.css">
<link class="colour" rel="stylesheet" href="/css/colour-classic-ski.css">
<link class="pattern" rel="stylesheet" href="/css/pattern-classic-ski.css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
</head>
<body class="fullwidth">
<!-- Navigation | START -->
<div id="nav">
    <div class="centre">
        <a href="/index.html" class="logo"><img alt="" src="/img/logo.png" /></a>
        <nav>
            <ul>
            	<li class="mobile"><a href="/contact.php" class="navbook">Book Online</a></li>
                <li><a href="/index.html">Home</a></li>
                <li><a href="/resorts.html">Our Resorts</a>
                	<ul>
                        <li><a href="/resorts/flaine.html">Flaine</a></li>
                    	<li><a href="/resorts/la-clusaz.html">La Clusaz</a></li>
                        <li><a href="/resorts/morzine.html">Morzine</a></li>
                        <li><a href="/resorts/les-saisies.html">Les Saisies</a></li>
                        <li><a href="/resorts/crest-voland.html">Crest-Voland</a></li>
                    </ul>
                </li>
                <li><a href="/dates-and-prices.html">Book Here</a>
                    <ul>
                        <li><a href="/dates-and-prices.html">Dates &amp; Prices</a></li>
                        <li><a href="/how-to-book.html">How To Book</a></li>
                        <li><a href="/downloads/booking-form.pdf">Booking Form</a></li>
                        <li><a href="/booking-conditions.html">Booking Conditions</a></li>
                    </ul>
                </li>
                <li><a href="/determining-your-ski-level.html">Find Your Ski Level</a></li>
                <li><a href="/about-us.html">About Us</a></li>
                <li><a href="/contact.php">Contact</a></li>
            </ul>
            <a id="pull"><i class="fa fa-bars"></i></a>
        </nav>
        <!-- Languages | START --> <!--
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
        <!-- <a href="/contact.php" class="book"><span data-hover="Book Online">Book Online</span> <i class="fa fa-check-circle"></i></a> -->
        <div class="shadow"></div>
    </div>
</div>
<!-- Navigation | END -->
<div id="container">
	<!-- Header | Start -->
	<header>
    	<div id="header">
        	<div class="h1">
                <h1><span>Contact Us</span>
                <span class="tagline">Get in touch with Classic Alpine</span></h1>
            </div>
        </div>
    </header>
    <!-- Header | END -->
    <!-- Content | START -->
    <main>
    	<div class="centre">
            <!-- Contact Form | START -->
        	<div id="contact">
            	<img src="/img/contact/contact.jpg" width="1200" height="400" alt="" />
                <?=$alert;?>
                <form name="contact" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <div class="col">
                        <div class="field mandatory"><input name="contact-name" type="text" placeholder="Your Name" id="contact-name" value="<?php echo isset($_POST['contact-name'])?$_POST['contact-name']:''; ?>" /></div>
                        <div class="field mandatory"><input name="contact-email" type="text" placeholder="Email Address" id="contact-email" value="<?php echo isset($_POST['contact-email'])?$_POST['contact-email']:''; ?>" /></div>
                        <div class="field mandatory"><input name="contact-phone" type="text" placeholder="Phone Number" id="contact-phone" value="<?php echo isset($_POST['contact-phone'])?$_POST['contact-phone']:''; ?>" /></div>
                    </div>
                    <div class="col">
                        <div class="field"><textarea name="contact-message" placeholder="Message" id="contact-message"><?php echo isset($_POST['contact-message'])?$_POST['contact-message']:""; ?></textarea></div>
                    </div>
                    <div class="col">
                        <div class="contact">
                            <p><strong class="phone">01444 390 242</strong><br />
                            <a href="mailto:info@classicalpine.com">info@classicalpine.com</a><br /><br />
                            <i class="fa fa-map-marker"></i> 2A Albert Street, Tring<br />
                            Hertfordshire, HP23 6AU</p>
                        </div>
                    </div>
                    <button name="send" value="sendform"><span data-hover="Send Contact Request">Send Contact Request</span></button>
                </form>
            </div>
            <!-- Contact Form | END -->
            <h2 style="margin:0;"><strong>01444 390 242</strong></h2>
            <p style="margin:0;"><a href="mailto:info@classicalpine.com">info@classicalpine.com</a><br />
            2A Albert Street, Tring, Hertfordshire, HP23 6AU</p>
        </div>
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
                        	<img alt="" src="/img/early-booking-discount/early-booking-discount.jpg" width="1200" height="400" />                             <div class="details">                                 <a href="/specials.html">                                     <div class="title">Early Booking Discount<br />
                                    <span>Until 15th October</span></div>
                                    <p>Book before the 15th October 2015 and we will give you a 5% discount on the cost of your holiday.<br />
                                    <div class="button"><span data-hover="Read More">Read More</span></div>
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
                <a href="/beginners-group.html">
                	<div class="date">
                    	<span class="month">Jan</span>
                        <span class="day">15</span>
                    </div>
                    <p class="title">Beginners&apos; Group</p>
                    <p>We will be running a beginners&apos; group in Les Saisies from Jan 15th to Jan 22nd 2016.</p>
                </a>
                <a href="/off-piste-technique-group.html">
                	<div class="date">
                    	<span class="month">Jan</span>
                        <span class="day">22</span>
                    </div>
                    <p class="title">Off-Piste Technique Group</p>
                    <p>Advanced skiiers might like our off-piste technique group in Flaine from Jan 22nd to Jan 29th 2016.</p>
                </a>
                <a href="/beginners-group.html">
                    <div class="date">
                        <span class="month">Mar</span>
                        <span class="day">13</span>
                    </div>
                    <p class="title">Beginners&apos; Group</p>
                    <p>We will be back in Les Saisies from Mar 13th to Mar 20th 2016 with another beginners&apos; group.</p>
                </a>
            </div>
            <!-- Recent Blog Posts | END -->
        	<!-- Footer Testimonial | START -->
            <div class="footertestimonial">
            	<i class="fa fa-quote-left"></i>
                <p class="title">Welcome to the Classic Alpine Ski Club</p>
                <p>Hitting your 50’s or 60’s is the beginning of something new and exciting. It’s the moment to start indulging yourself a bit more; to visit new places, try out new things or quite simply do more of what you enjoy.</p>
                <p>For many people skiing is a part of that and whether you are a beginner or have more experience, it is so much more fun when you share your time in the mountains with small groups of other like-minded people.</p>
                <div class="author">&ndash; <strong>Helen &amp; Stewart Macintosh</strong></div>                 <a href="/about-us.html" class="button"><span data-hover="Read More">Read More</span></a>
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
                    </div>
                </div>
                <!-- Subscribe / Social | END -->
            	<!-- Contact Details | START -->
            	<div class="contact">
                	<p><strong class="phone">01444 390 242</strong><br />
                    <a href="mailto:info@classicalpine.com">info@classicalpine.com</a><br /><br />
                    <i class="fa fa-map-marker"></i> 2A Albert Street, Tring<br />
                    Hertfordshire, HP23 6AU</p>
                </div>
                <!-- Contact Details | END -->
                <div class="dark"></div>
            </div>
        </div>
    	<!-- Footer Links | START -->
    	<div id="footerlinks">
        	<div class="centre">
            	<span>Copyright &copy; <script>var d = new Date(); document.write(d.getFullYear());</script> <strong>Classic Alpine</strong></span> <span><a href="http://www.totallyboundless.com" target="_blank">Built by Totally Boundless</a></span>
            </div>
        </div>
        <!-- Footer Links | END -->
        <!-- TTA Member | START -->
        <div id="tta">
            <div class="centre">
                <div class="details">
                    <a class="logo" target="_blank" href="http://www.traveltrust.co.uk"
                       title="Travel Trust Association">
                        <img src="http://images.traveltrust.co.uk/MemberLogos/memberlogocolour.aspx?tta=Q3634"
                             alt="Travel Trust Association" style="border: 0;">
                    </a>

                    <p>Classic Alpine is a member of the <a target="_blank" href="http://www.traveltrust.co.uk"
                                                            title="Travel Trust Association">Travel Trust
                        Association</a> which offers you 100% Financial Protection.<br>Check the TTA website to <a
                            target="_blank" href="http://www.traveltrust.co.uk/default.aspx?tabid=148"
                            title="Travel Trust Association">verify our TTA membership</a>.</p>
                </div>
            </div>
        </div>
        <!-- TTA Member | END -->
    </footer>
    <!-- Footer | END -->
</div>
<!-- Promo Popup | START -->
<div id="pop">
	<img alt="" src="http://dummyimage.com/400x150" width="400" height="150" />
    <div class="container">
        <p class="title"><strong>Our latest special offers,</strong><br />
        straight to your inbox</p>
        <p>Stay up to date with the latest specials from Classic Alpine. Subscribe and save on your next stay.</p>
        <form>
            <input name="email" type="text" placeholder="Your email address" />
            <button><span data-hover="Subscribe">Subscribe</span></button>
        </form>
        <p class="close closepop"><a>Continue browsing site</a></p>
        <i class="fa fa-close closepop"></i>
    </div>
</div>
<!-- Promo Popup | END -->
<script src="/system/js/plugins.js"></script>
<script src="/system/js/global.js"></script>
</body>
</html>