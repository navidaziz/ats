<!DOCTYPE html>
<html lang="en" dir="<?php echo $this->lang->line('direction'); ?>" />
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<title><?php echo $system_global_settings[0]->system_title ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
<meta name="description" content="">
<meta name="author" content="">
<link rel="stylesheet" type="text/css" href="<?php echo site_url("assets/".ADMIN_DIR."css/cloud-admin.css"); ?>" />
<link rel="stylesheet" type="text/css"  href="<?php echo site_url("assets/".ADMIN_DIR."css/themes/default.css"); ?>" id="skin-switcher" />
<link rel="stylesheet" type="text/css"  href="<?php echo site_url("assets/".ADMIN_DIR."css/responsive.css"); ?>" />

<!-- STYLESHEETS --><!--[if lt IE 9]><script src="js/flot/excanvas.min.js"></script><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script><![endif]-->

<link href="<?php echo site_url("assets/".ADMIN_DIR."font-awesome/css/font-awesome.min.css"); ?>" rel="stylesheet" />

<!-- ANIMATE -->
<link rel="stylesheet" type="text/css" href="<?php echo site_url("assets/".ADMIN_DIR."css/animatecss/animate.min.css"); ?>" />

<!-- date picker-->
<link rel="stylesheet" type="text/css" href="<?php echo site_url("assets/".ADMIN_DIR."js/bootstrap-datepicker/css/bootstrap-datepicker.css"); ?>" />

<!-- JQUERY -->
<script src="<?php echo site_url("assets/".ADMIN_DIR."js/jquery/jquery-2.0.3.min.js"); ?>"></script>

<!-- BOOTSTRAP -->
<script src="<?php echo site_url("assets/".ADMIN_DIR."bootstrap-dist/js/bootstrap.min.js"); ?>"></script>

<!-- GRITTER -->
<link rel="stylesheet" type="text/css" href="<?php echo site_url("assets/".ADMIN_DIR."js/gritter/css/jquery.gritter.css"); ?>" />
<!-- FONTS -->
<link href='<?php echo site_url("assets/".ADMIN_DIR."css/fonts.css"); ?>' rel='stylesheet' type='text/css' />

<!-- jstree resources -->
<script src="<?php echo site_url("assets/".ADMIN_DIR."jstree-dist/jstree.min.js"); ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo site_url("assets/".ADMIN_DIR."jstree-dist/themes/default/style.min.css"); ?>" />

<!-- HUBSPOT MESSENGER -->
<link rel="stylesheet" type="text/css" href="<?php echo site_url("assets/".ADMIN_DIR."js/hubspot-messenger/css/messenger.min.css"); ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo site_url("assets/".ADMIN_DIR."js/hubspot-messenger/css/messenger-theme-flat.min.css"); ?>" />
<script type="text/javascript" src="<?php echo site_url("assets/".ADMIN_DIR."js/hubspot-messenger/js/messenger.min.js"); ?>"></script>
<script type="text/javascript" src="<?php echo site_url("assets/".ADMIN_DIR."js/hubspot-messenger/js/messenger-theme-flat.js"); ?>"></script>
<!-- HUBSPOT MESSENGER -->
<!-- SELECT2 -->
<link rel="stylesheet" type="text/css" href="<?php echo site_url("assets/".ADMIN_DIR); ?>/js/select2/select2.min.css" />
<!-- TYPEAHEAD -->
<link rel="stylesheet" type="text/css" href="<?php echo site_url("assets/".ADMIN_DIR); ?>/js/typeahead/typeahead.css" />
<!-- SELECT2 -->
<link rel="stylesheet" type="text/css" href="<?php echo site_url("assets/".ADMIN_DIR); ?>/js/select2/select2.min.css" />
<!-- UNIFORM -->
<link rel="stylesheet" type="text/css" href="<?php echo site_url("assets/".ADMIN_DIR); ?>/js/uniform/css/uniform.default.min.css" />

<!-- DATE PICKER -->
<link rel="stylesheet" type="text/css" href="<?php echo site_url("assets/".ADMIN_DIR); ?>/js/datepicker/themes/default.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo site_url("assets/".ADMIN_DIR); ?>/js/datepicker/themes/default.date.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo site_url("assets/".ADMIN_DIR); ?>/js/datepicker/themes/default.time.min.css" />
<link rel="stylesheet" href="<?php echo site_url("assets/".ADMIN_DIR); ?>/horizontal_timeline/css/reset.css">
<!-- CSS reset -->
<link rel="stylesheet" href="<?php echo site_url("assets/".ADMIN_DIR); ?>/horizontal_timeline/css/style.css">
<!-- Resource style -->
<script src="<?php echo site_url("assets/".ADMIN_DIR); ?>/horizontal_timeline/js/modernizr.js"></script><!-- Modernizr -->
<!-- end time line -->
<!-- Bootstrap core CSS -->
<link href="<?php echo site_url("assets/".ADMIN_DIR); ?>/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<header class="navbar clearfix" id="header">
  <div class="container">
    <div class="navbar-brand"> 
      
      <!-- COMPANY LOGO --> 
      <a style="color:#FFF" href="<?php echo site_url(ADMIN_DIR.$this->session->userdata("role_homepage_uri")); ?>"> 
      <!-- <img src="<?php echo site_url("assets/uploads/".$system_global_settings[0]->sytem_admin_logo); ?>" alt="<?php echo $system_global_settings[0]->system_title ?>" title="<?php echo $system_global_settings[0]->system_title ?>" class="img-responsive " style="width:100px !important;"></a> --> 
      <?php echo $system_global_settings[0]->system_title; ?> </a> </div>
    
    <!-- BEGIN TOP NAVIGATION MENU -->
    <ul class="nav navbar-nav pull-right">
      <li style="float:right;" class="dropdown user" id="header-user"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <img alt="" 
      src="<?php echo site_url("assets/uploads/".$this->session->userdata("user_image")); ?>" /> <span class="username"><?php echo $this->session->userdata("user_title"); ?></span> <i class="fa fa-angle-down"></i> </a>
        <ul class="dropdown-menu">
          <li><a href="<?php echo site_url(ADMIN_DIR."users/update_profile"); ?>"><i class="fa fa-user"></i> Update Profile</a></li>
          <!--<li><a href="#"><i class="fa fa-cog"></i> Account Settings</a></li>
          <li><a href="#"><i class="fa fa-eye"></i> Privacy Settings</a></li>-->
          <li><a href="<?php echo site_url(ADMIN_DIR."users/logout"); ?>"><i class="fa fa-power-off"></i> Log Out</a></li>
        </ul>
      </li>
      
      <!-- END USER LOGIN DROPDOWN -->
    </ul>
    <!-- END TOP NAVIGATION MENU --> 
  </div>
</header>
<div class="container" style="margin-top:5px !important; font-size:10px;">
  <div class="row"> 
    <!-- MESSENGER -->
    <div class="col-md-4">
      
      <div class="box border blue" id="messenger">
        <div class="box-title">
          <h4>Add Income</h4>
         
        </div>
        <div class="box-body">
        
        
        
          <?php
                $add_form_attr = array("class" => "form-horizontal");
                echo form_open_multipart(ADMIN_DIR."income/save_data", $add_form_attr);
            ?>
          <div class="form-group">
            <?php
                    $label = array( "class" => "col-md-4 control-label",
                        "style" => "",
                    ); echo form_label($this->lang->line('customer_mobile_number'), "customer_mobile_number", $label);      ?>
            <div class="col-md-8">
              <?php
                    
                    $text = array(
                        "type"          =>  "text",
                        "name"          =>  "customer_mobile_number",
                        "id"            =>  "customer_mobile_number",
                        "class"         =>  "form-control",
                        "style"         =>  "","required"	  => "required","title"         =>  $this->lang->line('customer_mobile_number'),
                        "value"         =>  set_value("customer_mobile_number"),
                        "placeholder"   =>  $this->lang->line('customer_mobile_number')
                    );
                    echo  form_input($text);
                ?>
              <?php echo form_error("customer_mobile_number", "<p class=\"text-danger\">", "</p>"); ?> </div>
          </div>
          <div class="form-group">
            <?php
                    $label = array( "class" => "col-md-4 control-label",
                        "style" => "",
                    ); echo form_label($this->lang->line('customer_name'), "customer_name", $label);      ?>
            <div class="col-md-8">
              <?php
                    
                    $text = array(
                        "type"          =>  "text",
                        "name"          =>  "customer_name",
                        "id"            =>  "customer_name",
                        "class"         =>  "form-control",
                        "style"         =>  "","required"	  => "required","title"         =>  $this->lang->line('customer_name'),
                        "value"         =>  set_value("customer_name"),
                        "placeholder"   =>  $this->lang->line('customer_name')
                    );
                    echo  form_input($text);
                ?>
              <?php echo form_error("customer_name", "<p class=\"text-danger\">", "</p>"); ?> </div>
          </div>
          <div class="form-group">
            <?php
                    $label = array( "class" => "col-md-4 control-label",
                        "style" => "",
                    ); echo form_label($this->lang->line('customer_address'), "customer_address", $label);      ?>
            <div class="col-md-8">
              <?php
                    
                    $text = array(
                        "type"          =>  "text",
                        "name"          =>  "customer_address",
                        "id"            =>  "customer_address",
                        "class"         =>  "form-control",
                        "style"         =>  "","required"	  => "required","title"         =>  $this->lang->line('customer_address'),
                        "value"         =>  set_value("customer_address"),
                        "placeholder"   =>  $this->lang->line('customer_address')
                    );
                    echo  form_input($text);
                ?>
              <?php echo form_error("customer_address", "<p class=\"text-danger\">", "</p>"); ?> </div>
          </div>
          <div class="form-group">
            <?php
                    $label = array( "class" => "col-md-4 control-label",
                        "style" => "",
                    ); echo form_label($this->lang->line('project_name'), "project_name", $label);      ?>
            <div class="col-md-8">
              <?php
                    
                    $text = array(
                        "type"          =>  "text",
                        "name"          =>  "project_name",
                        "id"            =>  "project_name",
                        "class"         =>  "form-control",
                        "style"         =>  "","required"	  => "required","title"         =>  $this->lang->line('project_name'),
                        "value"         =>  set_value("project_name"),
                        "placeholder"   =>  $this->lang->line('project_name')
                    );
                    echo  form_input($text);
                ?>
              <?php echo form_error("project_name", "<p class=\"text-danger\">", "</p>"); ?> </div>
          </div>
          <div class="form-group">
            <?php
                    $label = array( "class" => "col-md-4 control-label",
                        "style" => "",
                    ); echo form_label($this->lang->line('project_address'), "project_address", $label);      ?>
            <div class="col-md-8">
              <?php
                    
                    $text = array(
                        "type"          =>  "text",
                        "name"          =>  "project_address",
                        "id"            =>  "project_address",
                        "class"         =>  "form-control",
                        "style"         =>  "","required"	  => "required","title"         =>  $this->lang->line('project_address'),
                        "value"         =>  set_value("project_address"),
                        "placeholder"   =>  $this->lang->line('project_address')
                    );
                    echo  form_input($text);
                ?>
              <?php echo form_error("project_address", "<p class=\"text-danger\">", "</p>"); ?> </div>
          </div>
          <div class="form-group">
            <?php
                    $label = array( "class" => "col-md-4 control-label",
                        "style" => "",
                    ); echo form_label($this->lang->line('total_price'), "total_price", $label);      ?>
            <div class="col-md-8">
              <?php
                    
                    $number = array(
                        "type"          =>  "number",
                        "name"          =>  "total_price",
                        "id"            =>  "total_price",
                        "class"         =>  "form-control",
                        "style"         =>  "","required"	  => "required","title"         =>  $this->lang->line('total_price'),
                        "value"         =>  set_value("total_price"),
                        "placeholder"   =>  $this->lang->line('total_price')
                    );
                    echo  form_input($number);
                ?>
              <?php echo form_error("total_price", "<p class=\"text-danger\">", "</p>"); ?> </div>
          </div>
          <div class="form-group">
            <?php
                    $label = array( "class" => "col-md-4 control-label",
                        "style" => "",
                    ); echo form_label($this->lang->line('discount'), "discount", $label);      ?>
            <div class="col-md-8">
              <?php
                    
                    $number = array(
                        "type"          =>  "number",
                        "name"          =>  "discount",
                        "id"            =>  "discount",
                        "class"         =>  "form-control",
                        "style"         =>  "","required"	  => "required","title"         =>  $this->lang->line('discount'),
                        "value"         =>  set_value("discount"),
                        "placeholder"   =>  $this->lang->line('discount')
                    );
                    echo  form_input($number);
                ?>
              <?php echo form_error("discount", "<p class=\"text-danger\">", "</p>"); ?> </div>
          </div>
          <div class="form-group">
            <?php
                    $label = array( "class" => "col-md-4 control-label",
                        "style" => "",
                    );
                    echo form_label($this->lang->line('courier_type'), "courier_type", $label);
                ?>
            <div class="col-md-8">
              <?php 
					$options = array("Normal" => "Normal", "Urgent" => "Urgent");
                        foreach($options as $option_value => $options_name){
                            
                            $data = array(
                                "name"        => "courier_type",
                                "id"          => "courier_type",
                                "value"       => $option_value,
                                "style"       => "",
								"required"	  => "required",
                                "class"       => "uniform"
                                );
							if($option_value == "Normal"){
								 $data = array("checked" => "checked");
								}	
                            echo form_radio($data)."<label for=\"courier_type\" style=\"margin-left:10px;\">$options_name</label>";
                            
                        }
                    ?>
              <?php echo form_error("courier_type", "<p class=\"text-danger\">", "</p>"); ?> </div>
          </div>
          <div class="col-md-offset-2 col-md-10">
            <?php
                $submit = array(
                    "type"  =>  "submit",
                    "name"  =>  "submit",
                    "value" =>  $this->lang->line('Save'),
					 "class" =>  "btn btn-primary",
                    "style" =>  ""
                );
                echo form_submit($submit); 
            ?>
            <?php
                $reset = array(
                    "type"  =>  "reset",
                    "name"  =>  "reset",
                    "value" =>  $this->lang->line('Reset'),
                    "class" =>  "btn btn-default",
                    "style" =>  ""
                );
                echo form_reset($reset); 
            ?>
          </div>
          <div style="clear:both;"></div>
          <?php echo form_close(); ?> </div>
      </div>
    </div>
    <!-- /MESSENGER -->
    
    <div class="col-md-8">
      <div class="box border blue" id="messenger">
        <div class="box-title">
          <h4>Income List</h4>
          <!--<div class="tools">
            
				<a href="#box-config" data-toggle="modal" class="config">
					<i class="fa fa-cog"></i>
				</a>
				<a href="javascript:;" class="reload">
					<i class="fa fa-refresh"></i>
				</a>
				<a href="javascript:;" class="collapse">
					<i class="fa fa-chevron-up"></i>
				</a>
				<a href="javascript:;" class="remove">
					<i class="fa fa-times"></i>
				</a>
				

			</div>--> 
        </div>
        <div class="box-body">
          <div class="table-responsive">
            <table class="table table-bordered" >
              <thead>
                <tr>
                  <th><?php echo $this->lang->line('customer_name'); ?></th>
                  <th><?php echo $this->lang->line('customer_mobile_number'); ?></th>
                  <th><?php echo $this->lang->line('customer_address'); ?></th>
                  <th><?php echo $this->lang->line('project_name'); ?></th>
                  <th><?php echo $this->lang->line('project_address'); ?></th>
                  <th><?php echo $this->lang->line('total_price'); ?></th>
                  <th><?php echo $this->lang->line('discount'); ?></th>
                  <th><?php echo $this->lang->line('courier_type'); ?></th>
                  <th><?php echo $this->lang->line('Status'); ?></th>
                  <th><?php echo $this->lang->line('Action'); ?></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($income as $income): ?>
                <tr>
                  <td><?php echo $income->customer_name; ?></td>
                  <td><?php echo $income->customer_mobile_number; ?></td>
                  <td><?php echo $income->customer_address; ?></td>
                  <td><?php echo $income->project_name; ?></td>
                  <td><?php echo $income->project_address; ?></td>
                  <td><?php echo $income->total_price; ?></td>
                  <td><?php echo $income->discount; ?></td>
                  <td><?php echo $income->courier_type; ?></td>
                  <td><?php echo status($income->status,  $this->lang); ?>
                    <?php
                                        
                                        //set uri segment
                                        if(!$this->uri->segment(4)){
                                            $page = 0;
                                        }else{
                                            $page = $this->uri->segment(4);
                                        }
                                        
                                        if($income->status == 0){
                                            echo "<a href='".site_url(ADMIN_DIR."income/publish/".$income->income_id."/".$page)."'> &nbsp;".$this->lang->line('Publish')."</a>";
                                        }elseif($income->status == 1){
                                            echo "<a href='".site_url(ADMIN_DIR."income/draft/".$income->income_id."/".$page)."'> &nbsp;".$this->lang->line('Draft')."</a>";
                                        }
                                    ?></td>
                  <td><a class="llink llink-view" href="<?php echo site_url(ADMIN_DIR."income/view_income/".$income->income_id."/".$this->uri->segment(4)); ?>"><i class="fa fa-eye"></i> </a> <a class="llink llink-edit" href="<?php echo site_url(ADMIN_DIR."income/edit/".$income->income_id."/".$this->uri->segment(4)); ?>"><i class="fa fa-pencil-square-o"></i></a> <a class="llink llink-trash" href="<?php echo site_url(ADMIN_DIR."income/trash/".$income->income_id."/".$this->uri->segment(4)); ?>"><i class="fa fa-trash-o"></i></a></td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
            <?php echo $pagination; ?> </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--/PAGE --> 
<!-- JAVASCRIPTS --> 
<!-- Placed at the end of the document so the pages load faster --> 

<!-- JQUERY UI--> 
<script src="<?php echo site_url("assets/".ADMIN_DIR."js/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.min.js"); ?>"></script> 

<!-- UNIFORM --> 
<script type="text/javascript" src="<?php echo site_url("assets/".ADMIN_DIR); ?>/js/uniform/jquery.uniform.min.js"></script> 

<!-- SLIMSCROLL --> 
<script type="text/javascript" src="<?php echo site_url("assets/".ADMIN_DIR."js/jQuery-slimScroll-1.3.0/jquery.slimscroll.min.js"); ?>"></script> 
<script type="text/javascript" src="<?php echo site_url("assets/".ADMIN_DIR."js/jQuery-slimScroll-1.3.0/slimScrollHorizontal.min.js"); ?>"></script> 
<!-- COOKIE --> 
<script type="text/javascript" src="<?php echo site_url("assets/".ADMIN_DIR."js/jQuery-Cookie/jquery.cookie.min.js"); ?>"></script> 
<!-- CUSTOM SCRIPT --> 

<script type="text/javascript" 
	src="<?php echo site_url("assets/".ADMIN_DIR."js/bootstrap-datepicker/js/bootstrap-datepicker.js"); ?>"></script> 

<!-- DATE PICKER --> 
<script type="text/javascript" src="<?php echo site_url("assets/".ADMIN_DIR."js/datepicker/picker.js"); ?>"></script> 
<script type="text/javascript" src="<?php echo site_url("assets/".ADMIN_DIR."js/datepicker/picker.date.js"); ?>"></script> 
<script type="text/javascript" src="<?php echo site_url("assets/".ADMIN_DIR."js/datepicker/picker.time.js"); ?>"></script> 
<script src="<?php echo site_url("assets/".ADMIN_DIR."js/script.js"); ?>"></script> 
<script>
  


	$(document).ready(function() {
		$(".datepicker").datepicker({
			
				format: 'yyyy-mm-dd',
                autoclose: true
            });
		
		});
		
	</script> 
<script type="text/javascript">
		jQuery(document).ready(function() {		
			App.setPage("widgets_box");  //Set current page
			App.init(); //Initialise plugins and elements
		});
	</script> 
<!-- /JAVASCRIPTS --> 
<script>
    $("img").error(function () {
  $(this).unbind("error").attr("src", "<?php echo site_url("assets/".ADMIN_DIR."img/no_image.png"); ?>");
});
</script>
</body>
</html>