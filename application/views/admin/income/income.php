<div class="container" style="margin-top:5px !important; font-size:10px;">
  <div class="row">
    <!-- MESSENGER -->
    <div class="col-md-4">
      <div class="box border blue" id="messenger">
        <div class="box-title">
          <h4>Add Income</h4>
        </div>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script>
          $(function() {
            var projects = [
              <?php foreach ($project_names as $project_name) {
                echo '"' . $project_name->project_name . '", ';
              } ?>
            ];
            $("#project_name").autocomplete({
              source: projects
            });
          });
        </script>
        <script>
          function get_mobile_number_info() {
            var customer_mobile_number = $("#customer_mobile_number").val();
            customer_mobile_number = customer_mobile_number.replace(/[^\/\d]/g, '');
            if (customer_mobile_number.length == 11) {
              console.log(customer_mobile_number.length)
              url = "<?php echo base_url() . "" . ADMIN_DIR; ?>/income/get_customer_information/" + customer_mobile_number;
              $.ajax({
                type: "POST",
                url: url,
                data: {}
              }).done(function(data) {
                var customer_information = JSON.parse(data);
                console.log(customer_information);

                if (customer_information.info_data == 'no') {
                  $('#customer_name').focus();

                } else {
                  $('#customer_name').val(customer_information.customer_name);
                  $('#customer_address').val(customer_information.customer_address);
                  if (customer_information.customer_name == '') {
                    $('#regular_customer').html('<span style="color:green">New Customer</span>');
                  } else {
                    $('#regular_customer').html('<span style="color:green">' + customer_information.customer_name + ' visit ATS office <strong style="color:red">' + customer_information.total + '</strong> times.</span>');
                  }
                  $('#project_name').focus();
                }

              });
            }
            //         alert();
            //         var customer_mobile_number = $("#customer_mobile_number").val();
            // customer_mobile_number = customer_mobile_number.replace(/[^\/\d]/g,'');
            // if(customer_mobile_number.length=>12){
            //     console.log(customer_mobile_number);
            // }
          }



          $(document).keypress(function(e) {
            if (e.which == 13) {

              activeObj = document.activeElement;
              if (activeObj.id == 'customer_mobile_number') {
                var customer_mobile_number = $("#customer_mobile_number").val();
                customer_mobile_number = customer_mobile_number.replace(/[^\/\d]/g, '');
                url = "<?php echo base_url() . "" . ADMIN_DIR; ?>/income/get_customer_information/" + customer_mobile_number;
                $.ajax({
                  type: "POST",
                  url: url,
                  data: {}
                }).done(function(data) {
                  var customer_information = JSON.parse(data);
                  console.log(customer_information);

                  if (customer_information.info_data == 'no') {
                    $('#customer_name').focus();
                  } else {
                    $('#customer_name').val(customer_information.customer_name);
                    //$('#customer_address').val(customer_information.customer_address);
                    $('#project_name').focus();
                  }

                });
              }
              //get mobile information 
              if (activeObj.id == 'project_name') {
                var project_name = $("#project_name").val();
                url = "<?php echo base_url() . "" . ADMIN_DIR; ?>/income/get_project_address/";
                $.ajax({
                  type: "POST",
                  url: url,
                  data: {
                    project_name: project_name
                  }
                }).done(function(data) {
                  var project_information = JSON.parse(data);
                  console.log(project_information);

                  if (project_information.info_data == 'no') {
                    $('#project_address').focus();
                  } else {
                    $('#project_address').val(project_information.project_address);
                    $('#total_price').focus();
                  }

                });
              }

            }
          });
        </script>
        <div class="box-body">
          <?php
          $add_form_attr = array("class" => "form-horizontal");
          echo form_open_multipart(ADMIN_DIR . "income/save_data", $add_form_attr);
          ?>
          <div class="form-group">
            <?php
            $label = array(
              "class" => "col-md-4 control-label",
              "style" => "",
            );
            echo form_label($this->lang->line('customer_mobile_number'), "customer_mobile_number", $label);      ?>
            <div class="col-md-8">
              <?php

              $text = array(
                "type"          =>  "text",
                "name"          =>  "customer_mobile_number",
                "id"            =>  "customer_mobile_number",
                "class"         =>  "form-control",
                "style"         =>  "",
                "required"    => "required",
                "onkeyup"    => "get_mobile_number_info()",
                "title"         =>  $this->lang->line('customer_mobile_number'),
                "value"         =>  set_value("customer_mobile_number"),
                "placeholder"   =>  $this->lang->line('customer_mobile_number')
              );
              echo  form_input($text);
              ?>
              <?php echo form_error("customer_mobile_number", "<p class=\"text-danger\">", "</p>"); ?> </div>
          </div>
          <div class="form-group">
            <?php
            $label = array(
              "class" => "col-md-4 control-label",
              "style" => "",
            );
            echo form_label($this->lang->line('customer_name'), "customer_name", $label);      ?>
            <div class="col-md-8">
              <?php

              $text = array(
                "type"          =>  "text",
                "name"          =>  "customer_name",
                "id"            =>  "customer_name",
                "class"         =>  "form-control",
                "style"         =>  "",
                "required"    => "required",
                "title"         =>  $this->lang->line('customer_name'),
                "value"         =>  set_value("customer_name"),
                "placeholder"   =>  $this->lang->line('customer_name')
              );
              echo  form_input($text);
              ?>
              <?php echo form_error("customer_name", "<p class=\"text-danger\">", "</p>"); ?>
              <div id="regular_customer"></div>

            </div>
          </div>


          <input type="hidden" name="customer_address" value="" id="customer_address" class="form-control" style="" title="Address" placeholder="Address">


          <div class="form-group">
            <?php
            $label = array(
              "class" => "col-md-4 control-label",
              "style" => "",
            );
            echo form_label("Apply for", "project_name", $label);      ?>
            <div class="col-md-8">
              <?php

              $text = array(
                "type"          =>  "text",
                "name"          =>  "project_name",
                "id"            =>  "project_name",
                "class"         =>  "form-control",
                "style"         =>  "",
                "required"    => "required",
                "title"         =>  "SST, PST, CT, Clark",
                "value"         =>  set_value("project_name"),
                "placeholder"   =>  "SST, PST, CT, Clark etc",
              );
              echo  form_input($text);
              ?>
              <?php echo form_error("project_name", "<p class=\"text-danger\">", "</p>"); ?> </div>
          </div>

          Reference:
          <table class="table" style="text-align:center !important">
            <tr>
              <td> <input style="cursor: pointer;" type="radio" id="sms" name="reference" value="sms"><label for="sms">SMS</label> </td>
              <td>
                <input style="cursor: pointer;" type="radio" id="whatsapp" name="reference" value="whatsapp"><label for="whatsapp">Whatapp</label>
              </td>
              <td>
                <input style="cursor: pointer;" type="radio" id="facebook" name="reference" value="facebook"><label for="whatapp">Facebook</label>
              </td>
              <td>
                <input style="cursor: pointer;" type="radio" id="advertisment" name="reference" value="advertisment"><label for="advertisment">Advertisment</label>
              </td>
              <td>
                <input style="cursor: pointer;" type="radio" id="fm" name="reference" value="fm"><label for="fm">FM Radio</label>
              </td>
              <td><input style="cursor: pointer;" type="radio" id="reference" name="reference" value="reference"><label for="reference">Reference</label></td>
            </tr>
          </table>
          <input type="hidden" name="project_address" value="" id="project_address" class="form-control" style="" title="Print, Online, Courier, Apply etc..." placeholder="Print, Online, Courier, Apply etc...">
          <input type="hidden" name="total_price" value="" id="total_price" class="form-control" style="" required="required" title="Total Price" placeholder="Total Price">


          <input type="hidden" name="discount" value="0" id="discount" class="form-control" style="" required title="Discount" placeholder="Discount">


          <input type="hidden" name="courier_type" value="Null" id="courier_type" required="required" class="uniform">
          <table>
            <tr>
              <th>Online</th>
              <th>Print</th>
              <th>Courier</th>
              <th>Special Charges</th>
              <th>Others</th>
            </tr>
            <tr>
              <td><input type="number" required min="0" onkeyup="sum_incom()" value="0" name="online" id="online" class="form-control"></td>
              <td><input type="number" required min="0" onkeyup="sum_incom()" value="0" name="print" id="print" class="form-control"></td>
              <td><input type="number" required min="0" onkeyup="sum_incom()" value="0" name="courier" id="courier" class="form-control"></td>
              <td><input type="number" required min="0" onkeyup="sum_incom()" value="0" name="special_charges" id="special_charges" class="form-control"></td>
              <td><input type="number" required min="0" onkeyup="sum_incom()" value="0" name="others" id="others" class="form-control"></td>
            </tr>
            <tr>

              <th>
                <h3>Total</h3>
              </th>
              <th colspan="2">
                <h3>Rs: <strong id="g_total">0</strong></h3>
              </th>
              <th colspan="2">

                <?php
                $submit = array(
                  "type"  =>  "submit",
                  "name"  =>  "submit",
                  "value" =>  $this->lang->line('Save'),
                  "class" =>  "btn btn-primary",
                  "style" =>  "width:100%"
                );
                echo form_submit($submit);
                ?>


              </th>

            </tr>
          </table>

          <script>
            function sum_incom() {

              var project_address = "";

              var online = parseInt($('#online').val()) + 0;
              if (isNaN(online)) {
                online = 0;
              }

              if (online > 0) {
                project_address = project_address + 'Online, ';
              }
              var print = parseInt($('#print').val()) + 0;
              if (isNaN(print)) {
                print = 0;
              }

              if (print > 0) {
                project_address = project_address + 'Print, ';
              }


              var courier = parseInt($('#courier').val()) + 0;
              if (isNaN(courier)) {
                courier = 0;
              }

              if (courier > 0) {
                project_address = project_address + 'Courier, ';
              }


              var special_charges = parseInt($('#special_charges').val()) + 0;
              if (isNaN(special_charges)) {
                special_charges = 0;
              }

              if (special_charges > 0) {
                project_address = project_address + 'Special Charges, ';
              }

              var others = parseInt($('#others').val()) + 0;
              if (isNaN(others)) {
                others = 0;
              }

              if (others > 0) {
                project_address = project_address + 'Others, ';
              }

              var total_sum_income = online + print + courier + special_charges + others;
              console.log(project_address);
              $('#total_price').val(total_sum_income);
              $('#g_total').html(total_sum_income);
              $('#project_address').val(project_address);


            }
          </script>



          <div class="col-md-12"> <span class="pull-left"> <a class="btn btn-danger" href="<?php echo base_url(ADMIN_DIR . "expenses/view"); ?>">Add Expenses</a> </span>
            <?php if ($this->session->userdata['user_id'] == 10 or $this->session->userdata['user_id'] == 18) { ?>
              <span class="pull-left" style="margin-left:5px;"> <a class="btn btn-success" href="<?php echo base_url(ADMIN_DIR . "income/dashboard"); ?>">Dashboard</a> </span>

            <?php } ?>
          </div>
          <div style="clear:both;"></div>
          <?php echo form_close(); ?>
        </div>
      </div>

      <?php if ($this->session->userdata['user_id'] == 18) { ?>
        <div class="box border blue" id="messenger">
          <div class="box-title">
            <h4 class="pull-left">Search</h4>
          </div>
          <div class="box-body">
            <form role="form" method="post">

              <!--<div class="form-group">-->
              <!--  <label for="search_by" class="control-label" style="">Search By</label>           -->
              <!--    <input type="radio" name="search_by" value="invoice_number" <?php if ($this->input->post("search_by") == 'invoice_number') { ?>  checked <?php } ?> id="search_by"  required="required" class="uniform">-->
              <!--    <label for="courier_type" style="margin-left:10px;">Invoice No.</label>-->
              <!--    <input type="radio" name="search_by" value="mobile_number" <?php if ($this->input->post("search_by") == 'mobile_number') { ?>  checked <?php } ?> id="search_by"  required="required" class="uniform"><label for="courier_type" style="margin-left:10px;">Mobile No.</label>             -->
              <!--</div>-->

              <div class="form-group">
                <label for="exampleInputEmail1">Search</label>
                <input class="form-control" <?php if ($this->input->post("search")) { ?> value="<?php echo $this->input->post("search"); ?>" <?php } ?> name="search" type="text" id="search" placeholder="Search here" required>
                <button type="submit">Search</button>
              </div>



            </form>
            <form role="form" method="post">
              <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="date" name="start_date" id="start_date" value="<?php if ($this->input->post("start_date")) {
                                                                              echo $this->input->post("start_date");
                                                                            } else {
                                                                              echo date("Y-m-d", time());
                                                                            } ?>" class="form-control" style="" required="required" title="Start Date" placeholder="Start Date">
              </div>
              <div class="form-group">
                <label for="end_date">End Date</label>
                <input type="date" name="end_date" id="end_date" value="<?php if ($this->input->post("end_date")) {
                                                                          echo $this->input->post("end_date");
                                                                        } else {
                                                                          echo date("Y-m-d", time());
                                                                        } ?>" class="form-control" style="" required="required" title="End Date" placeholder="End Date">
              </div>
              <button class="btn btn-success" type="submit" name="date_search" value="date_search">Search</button>
            </form>


          </div>
        </div>

      <?php } ?>


    </div>



    <!-- /MESSENGER -->

    <div class="col-md-8">
      <div class="box border blue" id="messenger">
        <div class="box-title">
          <h4 class="pull-left">Today Income List </h4>
          <!-- <h4 class="pull-right" style="color:#FF0 !important;"><em>Today Total Income: Rs</em> <?php echo $total_income; ?></h4>-->
        </div>
        <div class="box-body">
          <div class="table-responsive">
            <?php if ($this->input->post("search")) { ?>
              <h4 style="color:green">Search Result For <em style="color:red;">"<?php echo $this->input->post("search");  ?>"</em>. Search Option by "<em style="color:red;"><?php echo ucwords(str_replace("_", " ", $this->input->post("search_by")));  ?>"</em>
                <span class="pull-right"><a href="">Close Search</a></span>

              </h4>
            <?php } ?>


            <p style="text-align:center" id="pending_sms">
              <?php



              $query = "SELECT count(*) as total FROM `sms` WHERE status=0";
              $query_result = $this->db->query($query);
              $total_sms = $query_result->result()[0]->total;


              echo "Total Pending SMS <i class=\"fa fa-mobile\"></i> <strong>" . $total_sms . "   </strong>";

              $query = "SELECT last_updated FROM `sms` WHERE status=1 ORDER BY last_updated DESC LIMIT 2";
              $query_result = $this->db->query($query);
              $datelast = $query_result->result()[0]->last_updated;
              $date_last = new DateTime($query_result->result()[0]->last_updated);
              $date_2n_last = new DateTime($query_result->result()[1]->last_updated);

              $interval = $date_last->diff($date_2n_last);
              echo "(" . $interval->format('%i M %s sec') . ")"; //00 years 0 months 0 days 08 hours 0 minutes 0 seconds

              $now_date = new DateTime();
              $interval = $date_last->diff($now_date);

              echo " Last Message (" . $interval->format('%d %i M %s sec') . ") ago."; //00 years 0 months 0 days 08 hours 0 minutes 0 seconds


              if ($interval->format('%i') >= 5) {
                echo '<div class="alert alert-danger" role="alert"> Mobile off kindly check the mobile! Thanks. 
		      ' . date("d M Y g:i:s a", strtotime($datelast)) . '
		      </div>';
              }

              ?>



            </p>


            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Invoice No.</th>
                  <th>Date</th>
                  <th><?php echo $this->lang->line('customer_name'); ?></th>
                  <th><?php echo $this->lang->line('customer_mobile_number'); ?></th>
                  <!--<th><?php echo $this->lang->line('customer_address'); ?></th>-->
                  <th><?php //echo $this->lang->line('project_name'); 
                      ?> Apply For</th>
                  <th>Online</th>
                  <th>Print</th>
                  <th>Courier</th>
                  <th>Spe. Charges</th>
                  <th>Others</th>
                  <th><?php echo $this->lang->line('total_price'); ?></th>
                  <th>Entry By</th>
                  <td><i class="fa fa-print" aria-hidden="true"></i></td>
                </tr>
              </thead>
              <tbody>
                <?php
                $count = 1;

                foreach ($income as $income): ?>
                  <tr>
                    <td><?php echo $count++; ?></td>
                    <td><?php echo $income->invoice_number; ?></td>
                    <td><?php echo date('d M, y', strtotime($income->created_date)); ?></td>
                    <td><?php echo $income->customer_name; ?></td>
                    <td><?php echo $income->customer_mobile_number; ?></td>
                    <!--<td><?php echo $income->customer_address; ?></td>-->
                    <td><?php echo $income->project_name; ?></td>
                    <td><?php echo $income->online; ?></td>
                    <td><?php echo $income->print; ?></td>
                    <td><?php echo $income->courier; ?></td>
                    <td><?php echo $income->special_charges; ?></td>
                    <td><?php echo $income->others; ?></td>

                    </td>

                    <td><?php echo $income->total_price; ?></td>
                    <td><?php echo $user_list[$income->created_by]; ?></td>
                    <td>
                      <a target="new" href="<?php echo base_url(ADMIN_DIR . "income/print_invoice/" . $income->income_id); ?>">
                        <i class="fa fa-print" aria-hidden="true"></i>
                      </a>

                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>

            <script>
              function print_invoice(income_id) {
                url = "<?php echo base_url() . "" . ADMIN_DIR; ?>/income/print_invoice/" + income_id;
                $.ajax({
                  type: "POST",
                  url: url,
                  data: {}
                }).done(function(data) {
                  var customer_information = JSON.parse(data);


                });
              }
            </script>

            <?php echo $pagination; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="http://ipms.kpdata.gov.pk/assets/plugins/inputmaskv4/min/jquery.inputmask.bundle.min.js"
  type="text/javascript"></script>
<script>
  $(document).ready(function() {

    $("body").on('focus', '#customer_mobile_number', function() {
      $(this).inputmask("0999 9999999");
    });

  });
</script>