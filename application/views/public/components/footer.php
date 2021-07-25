

	<!-- Start Footer Area -->
	<footer class="footer-area section-gap" style="padding: 50px 0 !important;">
		<div class="container">
			<div class="row">
            
            
            <div class="ol-lg-6 col-md-6 single-footer-widget" data-wow-delay="0.3s" style="color: rgb(255, 201, 10) !important"> 
             <h4 id="log_title" style="color: rgb(255, 201, 10);">Darewro Delivery Services</h4><!--<a href="<?php echo base_url("/movers"); ?>"><img title="<?php echo $system_global_settings->system_title; ?> Logo" src="<?php echo base_url("assets/uploads/".$system_global_settings->sytem_public_logo); ?>" style="height:50px;" /></a>-->
          <p><?php echo substr($system_global_settings->description,0, 600); ?> <a href="" style="color:#F00"><em>Read More...</em></a></p>
          
           </div>
            
            
            <div class="col-lg-4 col-md-6 single-footer-widget" data-wow-delay="0.3s">
          <h4 style="color:#FFF">Contact Us</h4>
       <p style="color:#FFF">Contact Detail</p>
          <div class="contact-info" style="color:#FFF"> 
          <span> <i class="fa fa-location-arrow"></i> <strong> <?php echo $system_global_settings->system_title; ?></strong><br>
            <?php echo $system_global_settings->address; ?></span> <br>
            <span> <i class="fa fa-phone"></i> <?php echo $system_global_settings->phone_number; ?> , <?php echo $system_global_settings->mobile_number; ?></span> <br> <span><i class="fa fa-fax"></i> <?php echo $system_global_settings->fax_number; ?></span> <br></div>
            <span style="color:#FFF"> <i class="fa fa-envelope"></i> <?php echo $system_global_settings->email_address; ?></span> 
           
        </div>
            
				
				<div class="col-lg-2 col-md-6 single-footer-widget">
					<h4>Follow Us</h4>
					<div class="footer-icons" >
          <?php 
		  $count=1;
		  foreach($social_media_icons as $social_media_icon): ?>
           <a style="color: rgb(255, 201, 10) !important; font-size:24px" target="new" href="<?php echo $social_media_icon->social_media_link; ?>"><i class="<?php echo $social_media_icon->social_media_icon; ?>-square fa-2x"></i></a> 		 
		  <?php if($count%2==0) { echo '<br />';} ?>
		   <?php 
		   $count++;
		   endforeach; ?>
           </div>
                    
				</div>
				
				
				<div style="text-align:center !important; width:100%; margin-top:10px !important; color:#FFF" > <?php echo date("Y", time()); ?> 
                   &copy;  <strong><span style="color: rgb(255, 201, 10) !important">Dar</span>
                    <span style="font-size:24px !important; color:#F00 !important">e</span>
                    <span style="color: rgb(255, 201, 10) !important">wro</span></strong>
                    </div>
			</div>
			
		</div>
	</footer>
	<!-- End Footer Area -->

	<!-- ####################### Start Scroll to Top Area ####################### -->
	<div id="back-top">
		<a title="Go to Top" href="#"></a>
	</div>
	<!-- ####################### End Scroll to Top Area ####################### -->

	<script src="<?php echo site_url("assets/".PUBLIC_DIR); ?>/js/vendor/jquery-2.2.4.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
	 crossorigin="anonymous"></script>
	<script src="js/vendor/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
	<script src="<?php echo site_url("assets/".PUBLIC_DIR); ?>/js/easing.min.js"></script>
	<script src="<?php echo site_url("assets/".PUBLIC_DIR); ?>/js/hoverIntent.js"></script>
	<script src="<?php echo site_url("assets/".PUBLIC_DIR); ?>/js/superfish.min.js"></script>
	<script src="<?php echo site_url("assets/".PUBLIC_DIR); ?>/js/jquery.ajaxchimp.min.js"></script>
	<script src="<?php echo site_url("assets/".PUBLIC_DIR); ?>/js/jquery.magnific-popup.min.js"></script>
	<script src="<?php echo site_url("assets/".PUBLIC_DIR); ?>/js/owl.carousel.min.js"></script>
	<script src="<?php echo site_url("assets/".PUBLIC_DIR); ?>/js/owl-carousel-thumb.min.js"></script>
	<script src="<?php echo site_url("assets/".PUBLIC_DIR); ?>/js/jquery.sticky.js"></script>
	<script src="<?php echo site_url("assets/".PUBLIC_DIR); ?>/js/jquery.nice-select.min.js"></script>
	<script src="<?php echo site_url("assets/".PUBLIC_DIR); ?>/js/parallax.min.js"></script>
	<script src="<?php echo site_url("assets/".PUBLIC_DIR); ?>/js/waypoints.min.js"></script>
	<script src="<?php echo site_url("assets/".PUBLIC_DIR); ?>/js/wow.min.js"></script>
	<script src="<?php echo site_url("assets/".PUBLIC_DIR); ?>/js/jquery.counterup.min.js"></script>
	<script src="<?php echo site_url("assets/".PUBLIC_DIR); ?>/js/mail-script.js"></script>
	<script src="<?php echo site_url("assets/".PUBLIC_DIR); ?>/js/main.js"></script>
    <script>
    $(function () { 
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) { 
           // $('.navbar .navbar-brand img').attr('src','http://placehold.it/220?text=Original+Logo!');
      // $('#').attr('color','white');
	   document.getElementById("dar").style.color = "#FFC90A";
	   document.getElementById("wro").style.color = "#FFC90A";
		}
        if ($(this).scrollTop() < 100) { 
		document.getElementById("dar").style.color = "black";
		document.getElementById("wro").style.color = "black";
		//
           // $('.navbar .navbar-brand img').attr('src','http://placehold.it/120?text=Original+Logo!');
        }
    })
});
    
	</script>
    
</body>

</html>

