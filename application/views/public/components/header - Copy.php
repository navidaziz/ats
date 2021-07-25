<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

<title><?php if(isset($pageTitle)){ echo $pageTitle; }?></title>
 <meta name="description" content="<?php if(isset($pageDescription)){ echo $pageDescription; } ?>">
  <meta name="keywords" content="<?php if(isset($pageKeywords)){ echo $pageKeywords; } ?>">
<meta name="robots" content="" />
<link href="<?php echo site_url("assets/".PUBLIC_DIR); ?>/css/master.css" rel="stylesheet">

<!--
			Google Font
			============================================= -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,500,600" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500i" rel="stylesheet">

	<!--
			CSS
			============================================= -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/themify-icons/0.1.2/css/themify-icons.css">
	<link rel="stylesheet" href="<?php echo site_url("assets/".PUBLIC_DIR); ?>/css/linearicons.css">
	<link rel="stylesheet" href="<?php echo site_url("assets/".PUBLIC_DIR); ?>/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo site_url("assets/".PUBLIC_DIR); ?>/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo site_url("assets/".PUBLIC_DIR); ?>/css/magnific-popup.css">
	<link rel="stylesheet" href="<?php echo site_url("assets/".PUBLIC_DIR); ?>/css/nice-select.css">
	<link rel="stylesheet" href="<?php echo site_url("assets/".PUBLIC_DIR); ?>/css/animate.min.css">
	<link rel="stylesheet" href="<?php echo site_url("assets/".PUBLIC_DIR); ?>/css/owl.carousel.css">
	<link rel="stylesheet" href="<?php echo site_url("assets/".PUBLIC_DIR); ?>/css/main.css">


</head>
<style>

.p1-gradient-bg, .primary-btn, .primary-btn.white:hover, .banner-content .input-wrap .search-btn, .courses-list li:hover, .testimonials-area .owl-thumb-item.active .overlay-grad, .testimonials-area .owl-thumb-item .overlay-grad:hover, .top-category-widget-area .single-cat-widget:hover .overlay-bg, .post-content-area .single-post .primary-btn:hover, .blog-pagination .page-item.active .page-link, .blog-pagination .page-link:hover, .widget-wrap .newsletter-widget .bbtns, .footer-area .single-footer-widget .click-btn, .footer-area .footer-bottom .footer-social a:hover {

    background: -webkit-linear-gradient(90deg, #fff700d6 0%, #ffd400 100%) !important;
    background: -moz-linear-gradient(90deg, #fff700d6 0%, #ffd400 100%) !important;
    background: -o-linear-gradient(90deg, #fff700d6 0%, #ffd400 100%) !important;
    background: -ms-linear-gradient(90deg, #fff700d6 0%, #ffd400 100%) !important;
    background: linear-gradient(90deg, #fff700d6 0%, #ffd400 100%) !important;
}
.footer-area {
    background: #1f1f1f;
}
</style>
<body>

	<!-- Start Header Area -->
	<header id="header">
		<div class="container">
			<div class="row align-items-center justify-content-between d-flex">
				<div id="logo">
					<a href="index.html" style="color:#FFF">
                    <h6>Test Project</h6>
                    <!--<img id="logo" width="152" height="40" src="img/logo.png" alt="" title="" />--></a>
				</div>
				<nav id="nav-menu-container">
					<ul class="nav-menu">
						<li class="menu-active"><a href="index.html">Home</a></li>
						<li><a href="about.html">About</a></li>
						<li><a href="courses.html">Courses</a></li>
						<li class="menu-has-children"><a href="">Pages</a>
							<ul>
								<li><a href="elements.html">Elements</a></li>
							</ul>
						</li>
						<li class="menu-has-children"><a href="">Blog</a>
							<ul>
								<li><a href="blog-home.html">Blog Home</a></li>
								<li><a href="blog-single.html">Blog Details</a></li>
							</ul>
						</li>
						<li><a href="contact.html">Contact</a></li>
					</ul>
				</nav><!-- #nav-menu-container -->
			</div>
		</div>
	</header>
	<!-- End Header Area -->








</head>
<body data-scrolling-animations="true">
<div class="sp-body">
<!-- Loader Landing Page -->
<div id="ip-container" class="ip-container">
  <div class="ip-header" >
    <div class="ip-loader"> 
    <img title="<?php echo $system_global_settings->system_title; ?> Logo" src="<?php echo base_url("assets/uploads/".$system_global_settings->sytem_public_logo); ?>" style=" width:400px;" />
    <svg class="ip-inner" width="60px" height="60px" viewBox="0 0 80 80">
      <path class="ip-loader-circlebg" d="M40,10C57.351,10,71,23.649,71,40.5S57.351,71,40.5,71 S10,57.351,10,40.5S23.649,10,39.3,10z"/>
      <path id="ip-loader-circle" class="ip-loader-circle" d="M40,10C57.351,10,71,23.649,71,40.5S57.351,71,40.5,71 S10,57.351,10,40.5S23.649,10,40.5,10z"/>
      </svg> 
      Please wait ....
      </div>
  </div>
</div>
<header id="this-is-top">
  <div class="container-fluid">
    <div class="topmenu row">
      <nav class="col-sm-offset-3 col-md-offset-4 col-lg-offset-4 col-sm-6 col-md-5 col-lg-5"> <a href="#why_choose_us"><?php echo $this->lang->line('Why Choose Us'); ?></a> </nav>
      <nav class="text-right col-sm-3 col-md-3 col-lg-3"> 
       <?php foreach($social_media_icons as $social_media_icon): ?>
      <a target="new" href="<?php echo $social_media_icon->social_media_link; ?>"><i class="<?php echo $social_media_icon->social_media_icon; ?>"></i></a> 
      <?php endforeach; ?>
          </nav>
    </div>
    <div class="row header">
      <div class="col-sm-3 col-md-3 col-lg-3"> <img title="<?php echo $system_global_settings->system_title; ?> Logo" src="<?php echo base_url("assets/uploads/".$system_global_settings->sytem_public_logo); ?>" style=" width:220px;" /> </div>
      <div class="col-sm-offset-1 col-md-offset-1 col-lg-offset-1 col-sm-8 col-md-8 col-lg-8">
        <div class="text-right header-padding">
          <div class="h-block"><span><?php echo $this->lang->line("CALL US"); ?></span><?php echo $system_global_settings->phone_number; ?> , <?php echo $system_global_settings->mobile_number; ?></div>
           <div class="h-block"><span><?php echo $this->lang->line("FAX"); ?></span><?php echo $system_global_settings->fax_number; ?> </div>
          <div class="h-block"><span><?php echo $this->lang->line("EMAIL US"); ?></span><?php echo $system_global_settings->email_address; ?></div>
          <div class="h-block"><span>WORKING HOURS</span>
          Hours 9:00 AM - 12:00 AM
          <?php //echo $system_global_settings->start_time; ?><?php //echo $system_global_settings->end_time; ?></div>
          <!--<a class="btn btn-success" href="<?php echo site_url("assets/".PUBLIC_DIR); ?>/#"><?php echo $this->lang->line("GET A FREE QUOTE"); ?></a>--> </div>
      </div>
    </div>
    <div id="main-menu-bg"></div>
    <a id="menu-open" href="<?php echo site_url("assets/".PUBLIC_DIR); ?>/#"><i class="fa fa-bars"></i></a>
    <nav class="main-menu navbar-main-slide">
      <ul class="nav navbar-nav navbar-main" >
        <li > <a   href="<?php echo base_url(""); ?>"> <?php  echo $this->lang->line('HOME'); ?></a>
          <?php foreach($menu_pages as $menu_page){ ?>
          <?php if(count($menu_page->menu_sub_pages)>0){ ?>
        <li class="dropdown" ><a data-toggle="dropdown" class="dropdown-toggle border-hover-color1" href="<?php echo base_url("page/view_page/".$menu_page->page_id); ?>" ><?php echo $menu_page->page_name; ?> <i class="fa fa-angle-down"></i></a>
        <ul class="dropdown-menu">
          <?php foreach($menu_page->menu_sub_pages as $menu_sub_page){ ?>
          <li> <a href="<?php echo base_url("page/view_page/".$menu_sub_page->page_id); ?>" ><?php echo $menu_sub_page->page_name; ?></a></li>
          <?php } ?>
        </ul>
        </li>
        <?php }else{?>
         <li  ><a  href="<?php echo base_url("page/view_page/".$menu_page->page_id); ?>" ><?php echo $menu_page->page_name; ?></a></li>
       <?php } ?>
        <?php } ?>
        <li><a href="<?php echo base_url("/services"); ?>"><?php echo $this->lang->line("Services"); ?></a></li>
       <!--   <li><a href="<?php echo base_url("/gallery"); ?>"><?php echo $this->lang->line("Gallery"); ?></a></li>-->
        <li><a href="<?php echo base_url("/contact_us"); ?>"><?php echo $this->lang->line("Contact Us Page"); ?></a></li>
      </ul>
     
      <div class="search-form-modal transition">
        <form class="navbar-form header_search_form">
          <i class="fa fa-times search-form_close"></i>
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Search">
          </div>
          <button type="submit" class="btn btn_search customBgColor"><?php echo $this->lang->line("Search"); ?></button>
        </form>
      </div>
    </nav>
    <a id="menu-close" href="<?php echo site_url("assets/".PUBLIC_DIR); ?>/#"><i class="fa fa-times"></i></a> </div>
</header>

