<?php
$alert = null;
if(isset($_POST['send'])=="sendform"){
	
// Validation Check

$continue = true;
$validation = "";

if(empty($_POST['booking-date'])){
	$continue = false;
	$validation = "Booking Date, ";
}
if(empty($_POST['booking-people'])){
	$continue = false;
	$validation .= "No. of People, ";
}
if(empty($_POST['booking-name'])){
	$continue = false;
	$validation .= "Your Name, ";
}
if(empty($_POST['booking-email'])){
	$continue = false;
	$validation .= "Email Address, ";
}
if(empty($_POST['booking-phone'])){
	$continue = false;
	$validation .= "Phone Number";
}

// Validation OK, send email

if($continue===true){
		
	require 'system/email/phpmailer/PHPMailerAutoload.php';
	
	// Hotel Details
	
	$hotel_name = "Classic Alpine";
	$hotel_email = "info@classicalpine.com";
	
	// Send Email to Hotel
	
	$message = file_get_contents('system/email/template-hotel-reservation.php');
	$message = str_replace('[date]', $_POST['booking-date'], $message);
	$message = str_replace('[people]', $_POST['booking-people'], $message);
	$message = str_replace('[name]', $_POST['booking-name'], $message);
	$message = str_replace('[email]', $_POST['booking-email'], $message);
	$message = str_replace('[phone]', $_POST['booking-phone'], $message);
	
	$mail = new PHPMailer;
	$mail->setFrom($_POST['booking-email'], $_POST['booking-name']);
	$mail->addAddress($hotel_email, $hotel_name);
	$mail->Subject = 'Restaurant Booking Request from '.$_POST['booking-name'];
	$mail->MsgHTML($message);
	if (!$mail->send()) {
		$alert = "<div class='alert error'><i class='fa fa-exclamation-circle'></i> <strong>There was an error, please call us to make a reservation.</strong></div>";
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
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Classic Alpine - Restaurant</title>
<link rel="stylesheet" href="/css/classic-1509070750.css">
<link class="colour" rel="stylesheet" href="/css/colour-classic-ski.css">
<link class="pattern" rel="stylesheet" href="/css/pattern-classic-ski.css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
</head>
<body>
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
                </li><li><a href="/determining-your-ski-level.html">Find Your Ski Level</a></li>
                <li><a href="/about-us.html">About Us</a></li>
                <li><a href="/contact.php">Contact</a></li>
            </ul>
            <a id="pull"><i class="fa fa-bars"></i></a>
        </nav>
        <div class="shadow"></div>
    </div>
</div>
<!-- Navigation | END -->
<div id="container">
	<header>
    	<div id="header">
        	<div class="h1">
                <h1><span>Restaurant</span>
                <span class="tagline">A Gourmet Dining Experience</span></h1>
            </div>
        </div>
    </header>
    <!-- Header | END -->
    <!-- Content | START -->
    <main>
    	<div class="centre">
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
        	<div id="left">
                <div id="content">
                    <h2><strong>Award-Winning</strong> Restaurant</h2>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Nullam mollis. Ut justo.</p>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Nullam mollis. Ut justo. Suspendisse potenti. Sed egestas, ante et vulputate volutpat, eros pede semper est, vitae luctus metus libero eu augue. Morbi purus libero, faucibus adipiscing, commodo quis, gravida id, est.</p>
                    <!-- Menu | START -->
                    <section id="menu">
                    	<h3><i class="fa fa-cutlery"></i> Dining Menu</h3>
                    	<div class="menu">
                            <h4>
                            	Breakfast <span>7.30am &ndash; 12.00pm</span>
                            	<img alt="" src="http://dummyimage.com/120x120" width="120" height="120" />
                            </h4>
                            <ul>
                                <li>
                                    <h5>Lorem ipsum dolor</h5>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>
                                    <div class="price">
                                    	<div>$15</div>
                                    </div>
                                </li>
                                <li>
                                    <h5>Aliquam tincidunt</h5>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio.</p>
                                    <div class="price">
                                    	<div><span>Small</span> $10</div>
                                        <div><span>Large</span> $18</div>
                                    </div>
                                </li>
                                <li>
                                    <h5>Vestibulum auctor <span class="tag" title="Vegetarian">V</span></h5>
                                    <p>Lorem ipsum dolor sit amet, consectetuer.</p>
                                    <div class="price">
                                    	<div>$18</div>
                                    </div>
                                </li>
                                <li>
                                    <h5>Nunc dignissim <span class="tag" title="Vegetarian">V</span> <span class="tag" title="Gluten Free">GF</span></h5>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>
                                    <div class="price">
                                    	<div>$19.5</div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="menu">
                            <h4>
                            	Lunch <span>12.00pm &ndash; 3.30pm</span>
                            	<img alt="" src="http://dummyimage.com/120x120" width="120" height="120" />
                            </h4>
                            <ul>
                                <li>
                                    <h5>Cras ornare tristique elit</h5>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>
                                    <div class="price">
                                    	<div>$18</div>
                                    </div>
                                </li>
                                <li>
                                    <h5>Vivamus vestibulum</h5>
                                    <p>Lorem ipsum dolor sit amet, consectetuer.</p>
                                    <div class="price">
                                    	<div>$22.5</div>
                                    </div>
                                </li>
                                <li>
                                    <h5>Praesent placerat <span class="tag" title="Vegetarian">V</span> <span class="tag" title="Dairy Free">DF</span></h5>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio.</p>
                                    <div class="price">
                                    	<div>$24</div>
                                    </div>
                                </li>
                                <li>
                                    <h5>Fusce pellentesque <span class="tag" title="Vegetarian">V</span> <span class="tag" title="Gluten Free">GF</span></h5>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>
                                    <div class="price">
                                    	<div><span>2 Share</span> $30</div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="menu">
                            <h4>
                            	Dinner <span>5.00pm &ndash; 10.00pm</span>
                            	<img alt="" src="http://dummyimage.com/120x120" width="120" height="120" />
                            </h4>
                            <ul>
                                <li>
                                    <h5>Vestibulum commodo</h5>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>
                                    <div class="price">
                                    	<div>$25</div>
                                    </div>
                                </li>
                                <li>
                                    <h5>Ut aliquam sollicitudin <span class="tag" title="Spicy">S</span></h5>
                                    <p>Lorem ipsum dolor sit amet, consectetuer.</p>
                                    <div class="price">
                                    	<div>$27.5</div>
                                    </div>
                                </li>
                                <li class="featured">
                                    <h5>Integer vitae libero <span class="tag">Chef's Pick</span></h5>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>
                                    <div class="price">
                                    	<div>$29</div>
                                    </div>
                                </li>
                                <li>
                                    <h5>Cras iaculis</h5>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio.</p>
                                    <div class="price">
                                    	<div>$28</div>
                                        <div><span>+ Potato</span> $30</div>
                                    </div>
                                </li>
                                <li>
                                    <h5>Donec quis dui <span class="tag" title="Vegetarian">V</span></h5>
                                    <p>Lorem ipsum dolor sit amet, consectetuer.</p>
                                    <div class="price">
                                    	<div>$30</div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <h3><i class="fa fa-glass"></i> Drinks Menu</h3>
                    	<div class="menu">
                            <h4>
                            	Non-Alcoholic
                            	<img alt="" src="http://dummyimage.com/120x120" width="120" height="120" />
                            </h4>
                            <ul>
                                <li>
                                    <h5>Soft Drinks</h5>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>
                                    <div class="price">
                                    	<div>$5</div>
                                    </div>
                                </li>
                                <li>
                                    <h5>Milkshakes</h5>
                                    <p>Lorem ipsum dolor sit amet, consectetuer.</p>
                                    <div class="price">
                                    	<div>$5</div>

                                    </div>
                                </li>
                                <li>
                                    <h5>Bottled Spring Water</h5>
                                    <div class="price">
                                    	<div>$4</div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="menu">
                            <h4>
                            	Coffee <span>By Experienced Baristas</span>
                            	<img alt="" src="http://dummyimage.com/120x120" width="120" height="120" />
                            </h4>
                            <ul>
                                <li>
                                    <h5>Cappuccino</h5>
                                    <div class="price">
                                    	<div>$4.5</div>
                                    </div>
                                </li>
                                <li>
                                    <h5>Flat White</h5>
                                    <div class="price">
                                    	<div>$4.5</div>
                                    </div>
                                </li>
                                <li>
                                    <h5>Latte</h5>
                                    <div class="price">
                                    	<div>$4.5</div>
                                    </div>
                                </li>
                                <li>
                                    <h5>Macchiato</h5>
                                    <div class="price">
                                    	<div>$4</div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="menu">
                            <h4>
                            	Wine <span>From Local Vineyards</span>
                            	<img alt="" src="http://dummyimage.com/120x120" width="120" height="120" />
                            </h4>
                            <ul>
                                <li>
                                    <h5>Lorem ipsum dolor</h5>
                                    <p>2012 - Lorem ipsum dolor sit amet, consectetuer.</p>
                                    <div class="price">
                                    	<div><span>Glass</span> $10</div>
                                        <div><span>Bottle</span> $59</div>
                                    </div>
                                </li>
                                <li>
                                    <h5>Cras ornare tristique</h5>
                                    <p>2010 - Lorem ipsum dolor sit amet.</p>
                                    <div class="price">
                                    	<div><span>Glass</span> $12</div>
                                        <div><span>Bottle</span> $65</div>
                                    </div>
                                </li>
                                <li>
                                    <h5>Vivamus vestibulum</h5>
                                    <p>2008 - Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>
                                    <div class="price">
                                    	<div><span>Glass</span> $18</div>
                                        <div><span>Bottle</span> $96</div>
                                    </div>
                                </li>
                                <li>
                                    <h5>Fusce pellentesque</h5>
                                    <p>2007 - Lorem ipsum dolor sit amet, consectetuer.</p>
                                    <div class="price">
                                    	<div><span>Glass</span> $22</div>
                                        <div><span>Bottle</span> $115</div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </section>
                    <!-- Menu | END -->
                </div>
            </div>
            <!-- Sidebar | START -->
            <aside class="layout2">
            	<div id="scroll">
                	<!-- Reservations Form | START -->
                    <div id="block" class="form">
                        <div class="blocktitle"><span>Reservations</span></div>
                        <?=$alert;?>
                        <form id="reservations" action="<?php echo $_SERVER['PHP_SELF']; ?>#menu" method="post">
                        	<p><strong>01444 390 242</strong><br />
                            <a href="/mailto:dine@basehotel.com">dine@basehotel.com</a></p>
                        	<div class="fieldgroup">
                                <div class="field calendar"><input name="booking-date" type="text" placeholder="Booking Date" id="bookingdate" readonly /><i class="fa fa-calendar-o"></i></div>
                                <div class="field"><input name="booking-people" type="text" placeholder="No. of People" /></div>
                                <div class="field"><input name="booking-name" type="text" placeholder="Your Name" /></div>
                                <div class="field"><input name="booking-email" type="text" placeholder="Email Address" /></div>
                                <div class="field"><input name="booking-phone" type="text" placeholder="Phone Number" /></div>
                            </div>
                            <button name="send" value="sendform"><span data-hover="Book a Table">Book a Table</span></button>
                        </form>
                    </div>
                    <!-- Reservations Form | END -->
                    <!-- List Items (Specials Slider) | START -->
                    <div id="specials" class="list">
                        <div class="slider">
                        	<div class="item">
                                <img alt="" src="http://dummyimage.com/380x250" width="380" height="250" />
                                <div class="details">
                                    <a href="/specials.html">
                                        <div class="title">Early Booking Discount<br />
                                        <span>Until 15th October</span></div>
                                        <div class="text">Book before the 15th October 2015 and we will give you a 5% discount on the cost of your holiday.</div>
                                        <div class="button"><span data-hover="Read More">Read More</span></div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="nav"></div>
                    </div>
                    <!-- List Items (Specials Slider) | END -->
                </div>
            </aside>
            <!-- Sidebar | END -->
        </div>
    </main>
    <!-- Content | END -->
    <!-- Sitewide Extras | START -->
    <div id="extras">
    	<div class="centre">
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
                <p class="title">Welcome to the Classic&nbsp;Alpine&nbsp;Ski&nbsp;Club</p>
                <p>Hitting your 50’s or 60’s is the beginning of something new and exciting. It’s the moment to start indulging yourself a bit more; to visit new places, try out new things or quite simply do more of what you enjoy.</p>
                <p>For many people skiing is a part of that and whether you are a beginner or have more experience, it is so much more fun when you share your time in the mountains with small groups of other like-minded people.</p>
                <div class="author">&ndash; <strong>Helen &amp; Stewart Macintosh</strong></div>
                <a href="/about-us.html" class="button"><span data-hover="Read More">Read More</span></a>
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
                        <form action="http://newsletters.boundlessmarketing.co.uk/t/j/s/xkhthy/" method="post" id="subForm">                             <input id="fieldEmail" name="cm-xkhthy-xkhthy" type="email" required placeholder="Your email address"/>                             <button type="submit"><span data-hover="Sign Up">Sign Up</span></button>                         </form>                     </div>
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
<script src="/system/js/global-1509070742.js"></script>
</body>
</html>