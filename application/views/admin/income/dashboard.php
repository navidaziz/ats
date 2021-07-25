
<div class="container" style="margin-top:5px !important; font-size:10px;">
  <div class="row"> 
    <!-- MESSENGER --> 
    
    <!-- /MESSENGER -->
    
    <div class="col-md-12">
      <div class="box border blue" id="messenger">
        <div class="box-title">
          <h4 class="pull-left">Today</h4>
        </div>
        <div class="box-body">
        <div class="row"> 
    <!-- MESSENGER --> 
    
    <!-- /MESSENGER -->
    
    
          <div class="col-md-5">
          <table class="table table-bordered">
            <h4>Today</h4>
            <tr>
                <th><h5>Online</h5></th>
                <th><h5>Print</h5></th>
                <th><h5>Courier-(<?php echo $courier_count; ?>)</h5></th>
                <th><h5>Special Charges</h5></th>
                <th><h5>Others</th>
                
              <td style="color:green"><h5>Income</h5></td>
              <td style="color:red"><h5>Expense</h5></td>
              <td style="color:gray"><h5>Net Income</h5></td>
            </tr>
            <tr>
                <td><h4><strong><?php echo $online; ?></strong></h4></td>
                <td><h4><strong><?php echo $print; ?></strong></h4></td>
                <td><h4><strong><?php echo $courier; ?></strong></h4></td>
                <td><h4><strong><?php echo $special_charges; ?></strong></h4></td>
                <td><h4><strong><?php echo $others; ?></strong></h4></td>
                
              <td style="color:green"><h4><strong><?php echo $total_income; ?></strong></h4></td>
              <td style="color:red"><h4><strong><?php echo $total_expenses; ?></strong></h4></td>
              <td style="color:gray"><h4><strong><?php echo ($total_income-$total_expenses); ?></strong></h4></td>
            </tr>
            <tr>
                <td colspan="8">
                    <table class="table"><tr>
                    <?php $query="SELECT `income`.`reference` as title, count(`income`.`reference`) as total FROM `income` WHERE `income`.`reference` IS NOT NULL GROUP BY `income`.`reference` ORDER BY total DESC";
                    $references = $this->db->query($query)->result();
                    foreach($references as $reference){ ?>
                     <th><?php echo $reference->title ?></th><td><?php echo $reference->total; ?></td>
                     
              <?php } ?>
                    </tr></table>
                </td>
            </tr>
          </table>
          
          
          </div>
          
          <div class="col-md-2" >
              <h5>Today Expenses</h5>
              <div >
                <table class="table table-bordered">
                  <tr>
                    <td>Expense Type</td>
                    <td>Total Expense</td>
                  </tr>
                  <?php 
				  $total_expense = 0;
				  foreach($today_expenses as $expense_type){
					  $total_expense+=$expense_type->expense_total;
					  
					   ?>
			<tr>
                    <td><?php echo ucwords(strtolower($expense_type->expense_type)); ?></td>
                    <td><?php echo $expense_type->expense_total ?></td>
                  </tr>
				
               
			<?php } ?>
           
                </table>
              </div>
              <table class="table table-bordered">
              <tr><td><h5>Total Expense</h5></td> <td><h5><strong><?php echo "Rs ".$total_expense; ?></h5></strong></td></tr>
                </table>
            </div>
          
          
          <div class="col-md-3">
          <table class="table table-bordered">
            <h5>Today Employee Entries</h5>
            <tr>
              <td>Name</td>
              <td>Previous Month</td>
              <td>Current Month</td>
              <td>Total Entries</td>
            </tr>
            <?php 
		
		foreach($today_user_entries as $today_user_entrie){ ?>
            <tr>
              <td><?php echo $today_user_entrie->user_title; ?></td>
               <td><?php echo $today_user_entrie->previous_month; ?></td>
                <td><?php echo $today_user_entrie->this_month; ?></td>
              <td><?php echo $today_user_entrie->total; ?></td>
            </tr>
            <?php 	} ?>
          </table>
          </div>
          
          
          <div class="col-md-2">
              <table class="table table-bordered">
                  
                  <h5>New Customers Year Wise</h5>
                  <tr><th>Year</th> 
                  <th>Total</th>
                     <th>Old</th>
                     <th>New</th></tr>
                 
              <?php $query="SELECT *, (select count( DISTINCT income.customer_mobile_number) from income where year(income.created_date) = year_wise_new_customers.year )-`year_wise_new_customers`.`new_customers` as old_customer FROM `year_wise_new_customers`
";
                    $year_wise_new_customers = $this->db->query($query)->result();
                    foreach($year_wise_new_customers as $year_wise_new_customer){ ?>
                     <tr><th><?php echo $year_wise_new_customer->year ?></th>  
                     <td><?php echo $year_wise_new_customer->old_customer+$year_wise_new_customer->new_customers; ?></td>
                     <td><?php echo $year_wise_new_customer->old_customer ?></td>
                     <td><?php echo $year_wise_new_customer->new_customers ?></td></tr>
                    
              <?php } ?>
                 
              </table>
          </div>
          
          
          </div>
          <!--<div id="tody" ></div>-->
        </div>
      </div>
    </div>
    
    <div class="col-md-12">
      <div class="box border blue" id="messenger">
        <div class="box-title">
          <h4 class="pull-left">Current Month Day Wise Report</h4>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="hidden-xs col-md-5">
              <div id="current_month_report" ></div>
            </div>
            <div class="col-md-7" >
              <h2>Current Month Day Wise Report</h2>
              <div style=" width:100%; height:350px !important; overflow:scroll; overflow-x: hidden;">
                <table class="table" >
                  <tr>
                    <td>Date</td>
                    <td>Couriers Income</td>
                                <td>No of Couriers</td>
                                <td>Courier Expense</td>
                                <td>Per Courier Expense</td>
                    <td>Income</td>
                    <td>Expense</td>
                    <td>Net Icome</td>
                  </tr>
                  <?php 
			  $count = 0;
			  $total_income =0;
			  $total_expense = 0;
			  $total_net_income = 0;
			  $income_expence_reportarray = $income_expence_report;
krsort($income_expence_reportarray);

//var_dump($income_expence_reportarray);

foreach($income_expence_reportarray as $date => $report){ 


			  $total_income+=$report['income'];
			  $total_expense+=$report['expense'];
			  $total_net_income+=$report['net_income']; ?>
                  <tr <?php if($count==0){ ?> style="background-color:#9F9 !important; " <?php $count++; } ?>>
                    <td><?php echo $date; ?></td>
                      
                                <td><?php echo $report['courier']; ?></td>
                                <td><?php echo $report['courier_count']; ?></td>
                                <td><?php echo $report['courier_expense']; ?></td>
                                <td><?php 
                                if($report['courier_count']>0){
                                    echo round($report['courier_expense']/$report['courier_count'],1);
                                }else{
                                    echo 0;
                                }
                                 ?></td>

                          
                    <td><?php echo $report['income']; ?></td>
                    <td><?php echo $report['expense']; ?></td>
                    <td><?php echo $report['net_income']; ?></td>
                  </tr>
                  <?php } ?>
                </table>
              </div>
              <table class="table">
              <tr>
              <td><h5>Total Income</h5></td><td><h5><strong><?php echo "Rs ".$total_income; ?></strong></h5></td>
              <td><h5>Total Expense</h5></td><td><h5><strong><?php echo "Rs ".$total_expense; ?></h5></strong></td>
              <td><h5>Total Net Icome</h5></td><td><h5><strong><?php echo "Rs ".$total_net_income; ?></strong></h5></td>
              </tr>
                </table>
            </div>
            
            <div class="hidden-xs col-md-6">
              <div id="Expense_type" ></div>
            </div>
            
            <div class="col-md-6" >
              <h2>Current Month Expenses Report</h2>
              <div style=" width:100%; height:350px !important; overflow:scroll; overflow-x: hidden;">
                <table class="table" >
                  <tr>
                    <td>Expense Type</td>
                    <td>Total Expense</td>
                  </tr>
                  <?php 
				  $total_expense = 0;
				  foreach($expense_types as $expense_type){
					  $total_expense+=$expense_type->expense_total;
					  
					   ?>
			<tr>
                    <td><?php echo ucwords(strtolower($expense_type->expense_type)); ?></td>
                    <td><?php echo $expense_type->expense_total ?></td>
                  </tr>
				
               
			<?php } ?>
           
                </table>
              </div>
              <table class="table">
              <tr><td><h5>Total Expense</h5></td> <td><h5><strong><?php echo "Rs ".$total_expense; ?></h5></strong></td></tr>
                </table>
            </div>
            
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <div class="box border blue" id="messenger">
        <div class="box-title">
          <h4 class="pull-left">Monthly Report</h4>
        </div>
        
        
        <div class="box-body">
          <div class="row">
            <div class="hidden-xs col-md-6">
              <div id="year_monthly_report" ></div>
            </div>
            <div class="col-md-6" >
              <h2>Monthly Report</h2>
              <div style=" width:100%; height:350px !important; overflow:scroll; overflow-x: hidden;">
                <table class="table">
                  <tr>
                    <td>Date</td>
                    <td>Income</td>
                    <td>Expense</td>
                    <td>Net Icome</td>
                  </tr>
                  <?php 

foreach($month_income_expence_report as $date => $report){  ?>
                  <tr  <?php if($date==date("F, Y", time())){ ?> style="background-color:#9F9 !important; font-size:16px;" <?php $count++; } ?>>
                    <td><?php echo $date; ?></td>
                    <td><?php echo $report['income']; ?></td>
                    <td><?php echo $report['expense']; ?></td>
                    <td><?php echo $report['net_income']; ?></td>
                  </tr>
                  <?php } ?>
                </table>
              </div>
            </div>
            
            
            
            
            
          </div>
          
          <hr />
          
          <div class="row" style="margin-top:10px;">
                <div class="col-md-6">
                    <div id="year_report" ></div>
                </div>
                <div class="col-md-6">
                    
                    <table class="table">
                  <tr>
                    <td>Year</td>
                    <td>Income</td>
                    <td>Expense</td>
                    <td>Net Icome</td>
                  </tr>
                  <?php 

foreach($years_report as $report){  ?>
                  <tr  <?php if($report->year==date("Y", time())){ ?> style="background-color:#9F9 !important; font-size:16px;" <?php $count++; } ?>>
                    <td><?php echo $report->year; ?></td>
                    <td><?php echo $report->income_per_year; ?></td>
                    <td><?php echo $report->expense_per_year; ?></td>
                    <td><?php echo ($report->income_per_year-$report->expense_per_year); ?></td>
                  </tr>
                  <?php } ?>
                </table>
                    
                    
                </div>
            </div>
          
          
          
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">




$(function () {
    $('#Expense_type').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Current Month Expenses'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            type: 'category',
            labels: {
                rotation: -45,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Expenses (Rs)'
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: 'Expenses : <b>{point.y:.1f} Rs</b>'
        },
        series: [{
            name: 'Expenses',
            data: [
			
			<?php foreach($expense_types as $expense_type){ ?>
			
				['<?php echo ucwords(strtolower($expense_type->expense_type)); ?>', <?php echo $expense_type->expense_total ?>],
               
			<?php } ?>
               
            ],
            dataLabels: {
                enabled: true,
                rotation: -90,
                color: '#FFFFFF',
                align: 'right',
                format: '{point.y:.1f}', // one decimal
                y: 10, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }]
    });
});
		



$(function () {
    $('#tody').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Monthly Average Rainfall'
        },
        subtitle: {
            text: 'Source: WorldClimate.com'
        },
        xAxis: {
            categories: [
                'Income',
                'Expense',
                'Net Income',
                
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Rainfall (mm)'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Income',
            data: [<?php echo $total_income;  ?>]

        }, {
            name: 'Expense',
             data: [<?php echo $total_expenses;  ?>]

        }, {
            name: 'Net Income',
             data: [<?php echo $total_net_income;  ?>]

        }]
    });
});
				
			
			
			
$(function () {
    $('#year_monthly_report').highcharts({
        title: {
            text: 'Monthly Report',
            x: -20 //center
        },
        subtitle: {
            text: 'Monthly income, expenses and netincome Report',
            x: -20
        },
        xAxis: {
            categories: [
			<?php 
			$income = "";
			$expense = "";
			$net_income = "";
			foreach($month_income_expence_report as $date => $report){ 
			$income.= $report['income'].", " ;
			$expense.= $report['expense'].", " ;
			$net_income.= $report['net_income'].", " ;
			?>
			'<?php echo $date; ?>',
			<?php } ?>
			]
        },
        yAxis: {
            title: {
                text: 'Income / Expenses'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: ' Total'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: 'Incomes',
            data: [<?php echo $income; ?>]
        }, {
            name: 'Expenses',
            data: [<?php echo $expense; ?>]
        },
		{
            name: 'Net Income',
            data: [<?php echo $net_income; ?>]
        }
		
		]
    });
});			
			
			
			
$(function () {
    $('#current_month_report').highcharts({
        title: {
            text: 'Current Month ',
            x: -20 //center
        },
        subtitle: {
            text: 'Day Wise income, expenses and netincome Report',
            x: -20
        },
        xAxis: {
            categories: [
			<?php 
			$income = "";
			$expense = "";
			$net_income = "";
			foreach($income_expence_report as $date => $report){ 
			$income.= $report['income'].", " ;
			$expense.= $report['expense'].", " ;
			$net_income.= $report['net_income'].", " ;
			?>
			'<?php echo $date; ?>',
			<?php } ?>
			]
        },
        yAxis: {
            title: {
                text: 'Income / Expenses'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: ' Total'
        },
        legend: {
            layout: 'horizontal',
            align: 'bottom',
            verticalAlign: 'bottom',
            borderWidth: 0
        },
        series: [{
            name: 'Incomes',
            data: [<?php echo $income; ?>]
        }, {
            name: 'Expenses',
            data: [<?php echo $expense; ?>]
        },
		{
            name: 'Net Income',
            data: [<?php echo $net_income; ?>]
        }
		
		]
    });
});		



$(function () {
    $('#year_report').highcharts({
        title: {
            text: 'Yearly Report',
            x: -20 //center
        },
        subtitle: {
            text: 'Yearly income, expenses and netincome Report',
            x: -20
        },
        xAxis: {
            categories: [
			<?php 
			$income = "";
			$expense = "";
			$net_income = "";
			foreach($years_report as $report){ 
			$income.= $report->income_per_year.", " ;
			$expense.= $report->expense_per_year.", " ;
			$net_income.= ($report->income_per_year-$report->expense_per_year).", " ;
			?>
			'<?php echo $report->year; ?>',
			<?php } ?>
			]
        },
        yAxis: {
            title: {
                text: 'Income / Expenses'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: ' Total'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: 'Incomes',
            data: [<?php echo $income; ?>]
        }, {
            name: 'Expenses',
            data: [<?php echo $expense; ?>]
        },
		{
            name: 'Net Income',
            data: [<?php echo $net_income; ?>]
        }
		
		]
    });
});			
			
		
		</script> 
<script src="<?php echo site_url("assets/".ADMIN_DIR); ?>/Highcharts/js/highcharts.js"></script> 
<script src="<?php echo site_url("assets/".ADMIN_DIR); ?>/Highcharts/js/highcharts-more.js"></script> 
<script src="<?php echo site_url("assets/".ADMIN_DIR); ?>/Highcharts/js/modules/exporting.js"></script> 
<script src="<?php echo site_url("assets/".ADMIN_DIR); ?>/Highcharts/js/modules/drilldown.js"></script> 
