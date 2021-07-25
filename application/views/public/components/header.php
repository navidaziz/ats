<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

<title><?php if(isset($pageTitle)){ echo $pageTitle; }?></title>
 <meta name="description" content="<?php if(isset($pageDescription)){ echo $pageDescription; } ?>">
  <meta name="keywords" content="<?php if(isset($pageKeywords)){ echo $pageKeywords; } ?>">
<meta name="robots" content="" />

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

    background: -webkit-linear-gradient(90deg, #FFDD64 0%, #FFC90A 100%) !important;
    background: -moz-linear-gradient(90deg, #FFDD64 0%, #FFC90A 100%) !important;
    background: -o-linear-gradient(90deg, #FFDD64 0%, #FFC90A 100%) !important;
    background: -ms-linear-gradient(90deg, #FFDD64 0%, #FFC90A 100%) !important;
    background: linear-gradient(90deg, #FFDD64 0%, #FFC90A 100%) !important;
}
.footer-area {
    background: #1f1f1f;
}

#header.header-scrolled {
	
    background: rgb(255, 201, 10, 0.9) !important;
    transition: all 0.5s;
}

.nav-menu a {
    padding: 0 8px 0px 8px;
    text-decoration: none;
    display: inline-block;
    color: #000;
    font-size: 14px;
    text-transform: capitalize;
    outline: none;
}


</style>
<body>

	<!-- Start Header Area -->
	<header id="header">
		<div class="container">
			<div class="row align-items-center justify-content-between d-flex">
				<div id="logo">
					<a href="<?php echo base_url("/home"); ?>" style="color:#FFF"><img id="logo" width="152", height="40"  title="<?php echo $system_global_settings->system_title; ?> Logo" src="<?php echo base_url("assets/uploads/".$system_global_settings->sytem_public_logo); ?>" />
                </div>
				<nav id="nav-menu-container">
					<ul class="nav-menu" ">
                    
                    
                    
                    
                     <li class="menu-active" > 
                     <a   href="<?php echo base_url("/home"); ?>"> <?php  echo $this->lang->line('HOME'); ?></a>
          <?php foreach($menu_pages as $menu_page){ ?>
          <?php if(count($menu_page->menu_sub_pages)>0){ ?>
        <li class="menu-has-children" ><a  href="<?php echo base_url("page/view_page/".$menu_page->page_id); ?>" ><?php echo $menu_page->page_name; ?> </a>
        <ul >
          <?php foreach($menu_page->menu_sub_pages as $menu_sub_page){ ?>
          <li> <a   href="<?php echo base_url("page/view_page/".$menu_sub_page->page_id); ?>" ><?php echo $menu_sub_page->page_name; ?></a></li>
          <?php } ?>
        </ul>
        </li>
        <?php }else{?>
         <li  ><a  href="<?php echo base_url("page/view_page/".$menu_page->page_id); ?>" ><?php echo $menu_page->page_name; ?></a></li>
       <?php } ?>
        <?php } ?>
        <li><a href="<?php echo base_url("/services"); ?>"><?php echo $this->lang->line("Services"); ?></a></li>
        <li><a  href="<?php echo base_url("/contact_us"); ?>"><?php echo $this->lang->line("Contact Us Page"); ?></a></li>
        
					</ul>
				</nav><!-- #nav-menu-container -->
			</div>
		</div>
	</header>
	<!-- End Header Area -->
    
   