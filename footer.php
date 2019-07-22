<!-- Subscribe Area
============================================ -->
<div class="subscribe-area">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 text-center">
				<div class="subscribe-container">
					<!-- Subscribe Text -->
					<div class="subscribe-text fix">
						<h2>Get Notified of any offers!</h2>
						<p>Subscribe to our Newsletter to be notified about promotions</p>
					</div>
					<!-- Subscribe Form -->
					<div class="subscribe-form fix">
						<form id="subscribe-form" onSubmit ="return nsSubscribe();">
							<input type="text" placeholder="Your email address" id="newsletter_mail" />
							<input type="submit" value="submit" />
						</form>
                     </div>
                    <span id="newsletterSucces"></span>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Footer Area
============================================ -->
<div class="footer-area">
	<!-- Footer Top -->
	<div class="footer-top">
		<div class="container">
			<div class="row">
				<!-- Footer Widget About -->
				<div class="footer-widget footer-widget-about col-md-3 col-sm-5">
					<img src="img/footer-logo-new.png" alt="" />
					<p>A one stop place for fashion products and jewelry. You will find exclusive gift items for various occasion.</p>
					<div class="footer-social">
						<a href="#"><i class="mo-facebook"></i></a>
						<a href="#"><i class="mo-twitter"></i></a>
						<a href="#"><i class="mo-google-plus"></i></a>
						<a href="#"><i class="mo-pinterest"></i></a>
					</div>
				</div>
				<!-- Footer Widget Address -->
				<div class="footer-widget footer-widget-address col-md-2 col-md-offset-1 col-sm-5 col-sm-offset-2">
					<h3>address</h3>
					<p>Road# 30, House# 16, APT-B7, Sector# 07 <br />Uttara, Dhaka 1230<br/> Bangladesh</p>
					<p>sales@bellsandwhistles.com.bd</p>
				</div>
				<!-- Footer Widget Collection -->
				<div class="footer-widget footer-widget-collection col-md-2 col-md-offset-1 col-sm-5">
					<h3>collection</h3>
					<ul>
						<li><a href="#">Men</a></li>
						<li><a href="#">Women</a></li>
						<li><a href="#">Accessories</a></li>
						<li><a href="#">Gifts</a></li>
						<li><a href="#">Coming Soon</a></li>
					</ul>
				</div>
				<!-- Footer Widget Shop -->
				<div class="footer-widget footer-widget-shop col-md-2 col-md-offset-1 col-sm-5 col-sm-offset-2">
					<h3>shop</h3>
					<ul>
						<li><a href="single-page.html">About Us</a></li>
						<li><a href="terms-of-service/">Terms and Conditions</a></li>
                        <li><a href="return-policy/">Return Policy</a></li>
						<li><a href="privacy-policy/">Privacy Policy</a></li>
						<li><a href="contact/">Contact</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- Footer Bottom -->
	<div class="footer-bottom">
		<div class="container">
			<div class="row">
				<!-- Footer Copyright -->
				<div class="copyright col-sm-6 text-left"><p>&copy; 2019 <a href="#">Bells &amp; Whistles</a>. All Rights Reserved</p></div>
				<!-- Footer Payment -->
				<div class="payment col-sm-6 text-right"><img src="img/cod.png" alt="COD" /> <img src="img/bkash.png" alt="COD" /></div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
            
        function nsSubscribe()
            {
               var nsEmail = $("#newsletter_mail").val();
               if(!validateEmail($('#newsletter_mail').val())) 
               {
                  window.alert("Please enter a valid email address.");
                  return false;   
               }    
               if(nsEmail === "")
               {
                   alert("Please insert your email for subscription");
                   $("#newsletter_mail").focus();
                   return false;
               }    
               var dataString = "nsEmail="+nsEmail;
               $.ajax({
                type: "POST",
                url: "insertNewsletter.php",
                data: dataString,
                success: function(result) {
                 //alert(result);
                 if(result === '')
                 {    
                  $("#newsletterSucces").html("<p style='width:100%; font-weight: bold; color:#ffffff;'>Subscription Successfull!</p>");
                 }
                 else
                 {
                   $("#newsletterSucces").html(result);  
                 }    
               }
              });
            return false;    
            }
        </script>     