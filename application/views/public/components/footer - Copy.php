<?php 
//var_dump($system_global_settings);
?> <footer>
    <div class="color-part2"></div>
    <div class="color-part"></div>
    <div class="container-fluid">
      <div class="row block-content">
        <div class="col-sm-4 wow zoomIn" data-wow-delay="0.3s"> <a href="<?php echo base_url("/movers"); ?>"><img title="<?php echo $system_global_settings->system_title; ?> Logo" src="<?php echo base_url("assets/uploads/".$system_global_settings->sytem_public_logo); ?>" style="height:50px;" /></a>
          <p style="color:black;"><?php echo substr($system_global_settings->description,0, 400); ?>...</p>
          <div class="footer-icons" >
          <?php foreach($social_media_icons as $social_media_icon): ?>
           <a style="color:black !important" href="<?php echo $social_media_icon->social_media_link; ?>"><i class="<?php echo $social_media_icon->social_media_icon; ?>-square fa-2x"></i></a> 		 <?php endforeach; ?>
           </div>
           </div>
        <div class="col-sm-2 wow zoomIn" data-wow-delay="0.3s">
          <h4>WE OFFERS</h4>
          <nav> <!--<a href="<?php echo site_url("assets/".PUBLIC_DIR); ?>/#">Sea Freight</a> <a href="<?php echo site_url("assets/".PUBLIC_DIR); ?>/#">Road Transportation</a> <a href="<?php echo site_url("assets/".PUBLIC_DIR); ?>/#">Air Freight</a> <a href="<?php echo site_url("assets/".PUBLIC_DIR); ?>/#">Railway Logistics</a> <a href="<?php echo site_url("assets/".PUBLIC_DIR); ?>/#">Packaging & Storage</a> <a href="<?php echo site_url("assets/".PUBLIC_DIR); ?>/#">Warehousing</a>--> </nav>
        </div>
        <div class="col-sm-2 wow zoomIn" data-wow-delay="0.3s">
          <h4>MAIN LINKS</h4>
          <nav> <!--<a href="<?php echo site_url("assets/".PUBLIC_DIR); ?>/01_home.html">Home</a> <a href="<?php echo site_url("assets/".PUBLIC_DIR); ?>/06_services.html">Our Services</a> <a href="<?php echo site_url("assets/".PUBLIC_DIR); ?>/04_about.html">About Us</a> <a href="<?php echo site_url("assets/".PUBLIC_DIR); ?>/07_services.html">News</a> <a href="<?php echo site_url("assets/".PUBLIC_DIR); ?>/10_blog.html">Shop</a> <a href="<?php echo site_url("assets/".PUBLIC_DIR); ?>/12_contact.html">Contact</a>--> </nav>
        </div>
        <div class="col-sm-4 wow zoomIn" data-wow-delay="0.3s">
          <h4><?php echo $this->lang->line("CONTACT INFO"); ?></h4>
         <?php echo $this->lang->line("CONTACT INFO DETAIL"); ?>
          <div class="contact-info"> 
          <span><i class="fa fa-location-arrow"></i><strong><?php echo $system_global_settings->system_title; ?></strong><br>
            <?php echo $system_global_settings->address; ?></span> 
            <span><i class="fa fa-phone"></i><?php echo $system_global_settings->phone_number; ?> , <?php echo $system_global_settings->mobile_number; ?></span>  <span><i class="fa fa-fax"></i><?php echo $system_global_settings->fax_number; ?></span> </div>
            <span><i class="fa fa-envelope"></i> <?php echo $system_global_settings->email_address; ?></span> 
           
        </div>
      </div>
      <div class="copy text-right"><a id="to-top" href="#this-is-top"><i class="fa fa-chevron-up"></i></a><?php echo $this->lang->line("Created by"); ?> <a href="<?php echo site_url("assets/".PUBLIC_DIR); ?>/#"><?php echo $this->lang->line("Developer"); ?></a> &copy; <?php echo date("Y", time()); ?> <?php echo $system_global_settings->system_title; ?></div>
    </div>
  </footer>
</div>
<!--Main--> 
<script src="<?php echo site_url("assets/".PUBLIC_DIR); ?>/js/jquery-1.11.3.min.js"></script> 
<script src="<?php echo site_url("assets/".PUBLIC_DIR); ?>/js/jquery-ui.min.js"></script> 
<script src="<?php echo site_url("assets/".PUBLIC_DIR); ?>/js/bootstrap.min.js"></script> 
<script src="<?php echo site_url("assets/".PUBLIC_DIR); ?>/js/modernizr.custom.js"></script> 
<script src="<?php echo site_url("assets/".PUBLIC_DIR); ?>/assets/rendro-easy-pie-chart/dist/jquery.easypiechart.min.js"></script> 
<script src="<?php echo site_url("assets/".PUBLIC_DIR); ?>/js/waypoints.min.js"></script> 
<script src="<?php echo site_url("assets/".PUBLIC_DIR); ?>/js/jquery.easypiechart.min.js"></script> 
<!-- Loader --> 
<script src="<?php echo site_url("assets/".PUBLIC_DIR); ?>/assets/loader/js/classie.js"></script> 
<script src="<?php echo site_url("assets/".PUBLIC_DIR); ?>/assets/loader/js/pathLoader.js"></script> 
<script src="<?php echo site_url("assets/".PUBLIC_DIR); ?>/assets/loader/js/main.js"></script> 
<script src="<?php echo site_url("assets/".PUBLIC_DIR); ?>/js/classie.js"></script> 
<!--Switcher--> 
<script src="<?php echo site_url("assets/".PUBLIC_DIR); ?>/assets/switcher/js/switcher.js"></script> 
<!--Owl Carousel--> 
<script src="<?php echo site_url("assets/".PUBLIC_DIR); ?>/assets/owl-carousel/owl.carousel.min.js"></script> 
<!-- SCRIPTS --> 
<script type="text/javascript" src="<?php echo site_url("assets/".PUBLIC_DIR); ?>/assets/isotope/jquery.isotope.min.js"></script> 
<!--Theme--> 
<script src="<?php echo site_url("assets/".PUBLIC_DIR); ?>/js/jquery.smooth-scroll.js"></script> 
<script src="<?php echo site_url("assets/".PUBLIC_DIR); ?>/js/wow.min.js"></script> 
<script src="<?php echo site_url("assets/".PUBLIC_DIR); ?>/js/jquery.placeholder.min.js"></script> 
<script src="<?php echo site_url("assets/".PUBLIC_DIR); ?>/js/smoothscroll.min.js"></script> 
<script src="<?php echo site_url("assets/".PUBLIC_DIR); ?>/js/theme.js"></script>
</body>
</html>
