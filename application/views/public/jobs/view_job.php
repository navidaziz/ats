<!-- PAGE HEADER-->
<div class="breadcrumb-box">
  <div class="container">
			<!-- BREADCRUMBS -->
			<ul class="breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a href="<?php echo site_url("Home"); ?>">Home</a>
					<span class="divider">/</span>
				</li><li>
				<i class="fa fa-table"></i>
				<a href="<?php echo site_url("jobs/view/"); ?>">Jobs</a>
				<span class="divider">/</span>
			</li><li ><?php echo $title; ?> </li>
				</ul>
			</div>
		</div>
		<!-- .breadcrumb-box --><section id="main">
			  <header class="page-header">
				<div class="container">
				  <h1 class="title"><?php echo $title; ?></h1>
				</div>
			  </header>
			  <div class="container">
			  <div class="row">
			  <?php $this->load->view(PUBLIC_DIR."components/nav"); ?><div class="content span9 pull-right">
            <div class="table-responsive">
                
                    <table class="table">
						<thead>
						  
						</thead>
						<tbody>
					  <?php foreach($jobs as $job): ?>
                         
                         
            <tr>
                <th><?php echo $this->lang->line('job_title'); ?></th>
                <td>
                    <?php echo $job->job_title; ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $this->lang->line('job_summary'); ?></th>
                <td>
                    <?php echo $job->job_summary; ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $this->lang->line('job_detail'); ?></th>
                <td>
                    <?php echo $job->job_detail; ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $this->lang->line('job_end_date'); ?></th>
                <td>
                    <?php echo $job->job_end_date; ?>
                </td>
            </tr>
            <tr>
                <th>Job Image</th>
                <td>
                <?php
                    echo file_type(base_url("assets/uploads/".$job->job_image));
                ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $this->lang->line('job_source_title'); ?></th>
                <td>
                    <?php echo $job->job_source_title; ?>
                </td>
            </tr>
                         
                      <?php endforeach; ?>
						</tbody>
					  </table>
                      
                      
                      

            </div>
			
			</div>
		</div>
	 </div>
  <!-- .container --> 
</section>
<!-- #main -->
