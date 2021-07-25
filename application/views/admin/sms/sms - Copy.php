<!-- PAGE HEADER-->

<div class="row">
  <div class="col-sm-12">
    <div class="page-header"> 
      <!-- STYLER --> 
      
      <!-- /STYLER --> 
      <!-- BREADCRUMBS -->
      <ul class="breadcrumb">
        <li> <i class="fa fa-home"></i> <a href="<?php echo site_url(ADMIN_DIR.$this->session->userdata("role_homepage_uri")); ?>"><?php echo $this->lang->line('Home'); ?></a> </li>
        <li><?php echo $title; ?></li>
      </ul>
      <!-- /BREADCRUMBS -->
      <div class="row">
        <div class="col-md-6">
          <div class="clearfix">
            <h3 class="content-title pull-left"><?php echo $title; ?></h3>
          </div>
          <div class="description"><?php echo $title; ?></div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /PAGE HEADER --> 

<!-- PAGE MAIN CONTENT -->
<div class="row"> 
  <!-- MESSENGER -->
  <div class="col-md-12">
    <div class="box border blue" id="messenger">
      <div class="box-title">
        <h4><i class="fa fa-bell"></i> <?php echo $title; ?></h4>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-4">
            <div class="box border primary">
              <div class="box-title">
                <h4><i class="fa fa-bars"></i>Text Message</h4>
                
              </div>
              <div class="box-body big">
            <script>
            function get_text_count(){
				var text = $('#message').val();
				$('#count_text').html("Text Count: "+text.length);
				}
            </script>
                <form onsubmit="return confirm('Are you sure ? you want to submit');" method="post" action="<?php echo site_url(ADMIN_DIR."sms/submit_sms"); ?>" class="form-horizontal" role="form">
                  
                  <div class="form-group">
                    <textarea name="message" required="required" minlength="50" onkeyup="get_text_count()" id="message" class="form-control" rows="3"></textarea>
                   <span id="count_text" class="pull-right">Text Count: 0</span>
                  </div>
                  <div class="form-group"> 
                  <button type="submit" class="btn btn-primary " style="width:100%">Submit SMS</button>
												  </div>
                  
                </form>
              </div>
            </div>
          </div>
          <div class="col-md-6"> </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /MESSENGER --> 
</div>
