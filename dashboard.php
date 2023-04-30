<?php

include_once('custom/globals.php');

?>

<?php

include_once('fetch/dashboard_fetch.php');

?>

<?php
/* TOP TEMPLATE START */
include_once("layout/top-header.php");
include_once("layout/navbar.php");
include_once("layout/aside.php");
/* TOP TEMPLATE END */
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->

          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo HTTP_SERVER; ?>">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Database Size (Last 6 Months)</h5>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-8">
                    <p class="text-center">
                      <strong id="customers_created_label">New Registration: 1 Jan, 2022 - 30 Jul, 2022</strong>
                    </p>

                    <div class="chart">
                      <!-- Sales Chart Canvas -->
                      <canvas id="salesChart" height="180" style="height: 180px;"></canvas>
                    </div>
                    <!-- /.chart-responsive -->
                  </div>
                  <!-- /.col -->
                  <div class="col-md-4">
                    <p class="text-center">
                      <strong>Registration Type</strong>
                    </p>
          
                    <?php 
                    $customers_regtype = $response_data->customers_regtype;

                    $grand_total = 0;

                    $progress_class_array = array('','bg-primary','bg-danger','bg-info');

                    for($i=0;$i<1;$i++)
                    {

                      $customers_regtype_row = (array) $customers_regtype[$i];
                      extract($customers_regtype_row);

                      $grand_total = $total;

                    }

                    for($i=1;$i<count($customers_regtype);$i++)
                    {

                      $customers_regtype_row = (array) $customers_regtype[$i];
                      extract($customers_regtype_row);
                      ?>
                      <div class="progress-group">
                        <?php echo $label;?>
                        <span class="float-right"><b><?php echo $total;?></b>/<?php echo $grand_total;?></span>
                        <div class="progress progress-sm">
                          <div class="progress-bar <?php echo $progress_class_array[$i];?>" style="width: <?php echo $percentage;?>%"></div>
                        </div>
                      </div>
                      <!-- /.progress-group -->
                      <?php

                    }
                    ?>

                    <!-- <div class="progress-group">
                      Full
                      <span class="float-right"><b>200</b>/600</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-primary" style="width: 33.33%"></div>
                      </div>
                    </div>

                    <div class="progress-group">
                      Partial
                      <span class="float-right"><b>400</b>/600</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-danger" style="width: 66.66%"></div>
                      </div>
                    </div> -->

                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- ./card-body -->
              <div class="card-footer">
                <div class="row">

          
                    <?php 
                    $source_name = $response_data->source_name;

                    $progress_class_array = array('text-success','text-warning','text-danger');

                    for($i=0;$i<count($source_name);$i++)
                    {

                      $source_name_row = (array) $source_name[$i];
                      extract($source_name_row);


                      $class_to_choose = $progress_class_array[2];
                      if($total != "0")
                      {
                        $class_to_choose = $progress_class_array[0];
                      }
                      ?>

                      <div class="col-sm-2 col-6">
                        <div class="description-block border-right">
                          <span class="description-percentage <?php echo $class_to_choose;?>"><!-- <i class="fas fa-caret-up"></i> --> <?php echo $total;?></span>
                          <h5 class="description-header"> </h5>
                          <span class="description-text"><?php echo $label;?></span>
                        </div>
                        <!-- /.description-block -->
                      </div>
                      <!-- /.col -->
                      <?php

                    }
                    ?>
                  <!-- <div class="col-sm-2 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 17%</span>
                      <h5 class="description-header"> </h5>
                      <span class="description-text">TOTAL</span>
                    </div>
                  </div>
                  <div class="col-sm-2 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> 0%</span>
                      <h5 class="description-header"> </h5>
                      <span class="description-text">Organic</span>
                    </div>
                  </div>
                  <div class="col-sm-2 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 20%</span>
                      <h5 class="description-header"> </h5>
                      <span class="description-text">Adwords</span>
                    </div>
                  </div>
                  <div class="col-sm-2 col-6">
                    <div class="description-block">
                      <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> 18%</span>
                      <h5 class="description-header"> </h5>
                      <span class="description-text">Social Media</span>
                    </div>
                  </div>
                  <div class="col-sm-2 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 20%</span>
                      <h5 class="description-header"> </h5>
                      <span class="description-text">Word of Mouth</span>
                    </div>
                  </div>
                  <div class="col-sm-2 col-6">
                    <div class="description-block">
                      <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> 18%</span>
                      <h5 class="description-header"> </h5>
                      <span class="description-text">Trade Shows</span>
                    </div>
                  </div> -->
                </div>
                <!-- /.row -->
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->


        
        <div class="row">

          <!-- MEMBERSHIPS -->  
          <?php 
          $customers_memlvl = $response_data->customers_memlvl;
          $customers_memlvl_last_7 = $response_data->customers_memlvl_last_7;

          $progress_class_logo = array('fa-balance-scale', 'fa-crown', 'fa-coins', 'fa-book-dead');
          $progress_class_array = array('bg-info','bg-warning','bg-success','bg-danger');

          for($i=0;$i<count($customers_memlvl);$i++)
          {

            $customers_memlvl_row = (array) $customers_memlvl[$i];
            extract($customers_memlvl_row);

            $total_last_7 = 0;

            for($j=0;$j<count($customers_memlvl_last_7);$j++)
            {              
              $customers_memlvl_last_7_row = (array) $customers_memlvl_last_7[$j];

              if($label == $customers_memlvl_last_7_row['label'])
              {
                $total_last_7 = $customers_memlvl_last_7_row['total'];
              }
            }

            ?>

            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box">
                <span class="info-box-icon <?php echo $progress_class_array[$i];?> elevation-1"><i class="fas <?php echo $progress_class_logo[$i];?>"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text"><?php echo $label;?> Memberships</span>
                  <span class="info-box-number">
                    <?php echo $total;?>
                    <small><?php echo $percentage;?>%</small>
                    +<?php echo $total_last_7;?>
                    <small>(7 Days)</small>
                  </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>
            <?php

          }
          ?>        
          

        </div>
        <!-- /.row -->


        
        <div class="row">

          <!-- LOYALTY -->  
          <?php 
          $customers_loyaltylvl = $response_data->customers_loyaltylvl;
          $customers_loyaltylvl_last_7 = $response_data->customers_loyaltylvl_last_7;

          $progress_class_logo = array('fa-tag', 'fa-heart', 'fa-crown', 'fa-cloud-download-alt');
          $progress_class_array = array('bg-info','bg-danger','bg-warning','bg-success');

          for($i=1;$i<count($customers_loyaltylvl);$i++)
          {

            $customers_loyaltylvl_row = (array) $customers_loyaltylvl[$i];
            extract($customers_loyaltylvl_row);

            $total_last_7 = 0;

            for($j=0;$j<count($customers_loyaltylvl_last_7);$j++)
            {              
              $customers_loyaltylvl_last_7_row = (array) $customers_loyaltylvl_last_7[$j];

              if($label == $customers_loyaltylvl_last_7_row['label'])
              {
                $total_last_7 = $customers_loyaltylvl_last_7_row['total'];
              }
            }

            ?>

            <div class="col-md-4">
              <!-- Info Boxes Style 2 -->
              <div class="info-box mb-3 <?php echo $progress_class_array[$i];?>">
                <span class="info-box-icon"><i class="fas <?php echo $progress_class_logo[$i];?>"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text"><?php echo $label;?></span>
                  <span class="info-box-number">
                    <?php echo $total;?>
                    <small><?php echo $percentage;?>%</small>
                    +<?php echo $total_last_7;?>
                    <small>(7 Days)</small>
                  </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box --> 
            </div> 
            <?php

          }
          ?>         

          

        </div>
        <!-- /.row -->


        <div class="row">

          <!-- GENDER -->
          <div class="col-12 col-sm-6 col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Gender</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <!-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button> -->
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-8">
                    <div class="chart-responsive">
                      <canvas id="pieChart1" height="150"></canvas>
                    </div>
                    <!-- ./chart-responsive -->
                  </div>
                  <!-- /.col -->
                  <div class="col-md-4">
                    <ul class="chart-legend clearfix" id="pieChartLegend1">
                      <li><i class="far fa-circle text-danger"></i> Chrome</li>
                      <li><i class="far fa-circle text-success"></i> IE</li>
                      <li><i class="far fa-circle text-warning"></i> FireFox</li>
                      <li><i class="far fa-circle text-info"></i> Safari</li>
                      <li><i class="far fa-circle text-primary"></i> Opera</li>
                      <li><i class="far fa-circle text-secondary"></i> Navigator</li>
                    </ul>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>

          <!-- AGE -->
          <div class="col-12 col-sm-6 col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Age</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <!-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button> -->
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-8">
                    <div class="chart-responsive">
                      <canvas id="pieChart2" height="150"></canvas>
                    </div>
                    <!-- ./chart-responsive -->
                  </div>
                  <!-- /.col -->
                  <div class="col-md-4">
                    <ul class="chart-legend clearfix" id="pieChartLegend2">
                      <li><i class="far fa-circle text-danger"></i> 18 - 25</li>
                      <li><i class="far fa-circle text-success"></i> 26 - 33</li>
                      <li><i class="far fa-circle text-warning"></i> 34 - 41</li>
                      <li><i class="far fa-circle text-info"></i> 42 - 49</li>
                      <li><i class="far fa-circle text-primary"></i> 50 - 57</li>
                      <li><i class="far fa-circle text-secondary"></i> 58+</li>
                    </ul>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>

          <!-- STATE -->
          <div class="col-12 col-sm-6 col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Other Drink Of Choice</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <!-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button> -->
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-8">
                    <div class="chart-responsive">
                      <canvas id="pieChart3" height="150"></canvas>
                    </div>
                    <!-- ./chart-responsive -->
                  </div>
                  <!-- /.col -->
                  <div class="col-md-4">
                    <ul class="chart-legend clearfix" id="pieChartLegend3">
                      <li><i class="far fa-circle text-danger"></i> Chrome</li>
                      <li><i class="far fa-circle text-success"></i> IE</li>
                      <li><i class="far fa-circle text-warning"></i> FireFox</li>
                      <li><i class="far fa-circle text-info"></i> Safari</li>
                      <li><i class="far fa-circle text-primary"></i> Opera</li>
                      <li><i class="far fa-circle text-secondary"></i> Navigator</li>
                    </ul>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>

          <!-- VARIETAL PREFERENCE -->
          <div class="col-12 col-sm-6 col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Wine Style Preference</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <!-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button> -->
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-8">
                    <div class="chart-responsive">
                      <canvas id="pieChart4" height="150"></canvas>
                    </div>
                    <!-- ./chart-responsive -->
                  </div>
                  <!-- /.col -->
                  <div class="col-md-4">
                    <ul class="chart-legend clearfix" id="pieChartLegend4">
                      <li><i class="far fa-circle text-danger"></i> Chrome</li>
                      <li><i class="far fa-circle text-success"></i> IE</li>
                      <li><i class="far fa-circle text-warning"></i> FireFox</li>
                      <li><i class="far fa-circle text-info"></i> Safari</li>
                      <li><i class="far fa-circle text-primary"></i> Opera</li>
                      <li><i class="far fa-circle text-secondary"></i> Navigator</li>
                    </ul>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>

          <!-- AVERAGE SPEND -->
          <div class="col-12 col-sm-6 col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Average Wine Spend</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <!-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button> -->
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-8">
                    <div class="chart-responsive">
                      <canvas id="pieChart5" height="150"></canvas>
                    </div>
                    <!-- ./chart-responsive -->
                  </div>
                  <!-- /.col -->
                  <div class="col-md-4">
                    <ul class="chart-legend clearfix" id="pieChartLegend5">
                      <li><i class="far fa-circle text-danger"></i> Chrome</li>
                      <li><i class="far fa-circle text-success"></i> IE</li>
                      <li><i class="far fa-circle text-warning"></i> FireFox</li>
                      <li><i class="far fa-circle text-info"></i> Safari</li>
                      <li><i class="far fa-circle text-primary"></i> Opera</li>
                      <li><i class="far fa-circle text-secondary"></i> Navigator</li>
                    </ul>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>

          <!-- DRINKS PER WEEK -->
          <div class="col-12 col-sm-6 col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Drinks Per Week</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <!-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button> -->
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-8">
                    <div class="chart-responsive">
                      <canvas id="pieChart6" height="150"></canvas>
                    </div>
                    <!-- ./chart-responsive -->
                  </div>
                  <!-- /.col -->
                  <div class="col-md-4">
                    <ul class="chart-legend clearfix" id="pieChartLegend6">
                      <li><i class="far fa-circle text-danger"></i> Chrome</li>
                      <li><i class="far fa-circle text-success"></i> IE</li>
                      <li><i class="far fa-circle text-warning"></i> FireFox</li>
                      <li><i class="far fa-circle text-info"></i> Safari</li>
                      <li><i class="far fa-circle text-primary"></i> Opera</li>
                      <li><i class="far fa-circle text-secondary"></i> Navigator</li>
                    </ul>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>

        </div>
        <!-- /.row -->




      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php
/* BOTTOM TEMPLATE START */
include_once("layout/aside-right.php");
include_once("layout/footer.php");
include_once("layout/bottom-footer.php");
/* BOTTOM TEMPLATE END */
?>

<script type="text/javascript">
  custom_js_nav_bar_selection("dashboard");
  // custom_js_pagination_sync("<?php echo $PAGE; ?>");
  // custom_js_show_filter("<?php echo $SHOW_FILTER; ?>");
  // custom_js_submit_filter();
</script>

<script type="text/javascript">
/* global Chart:false */

$(function () {
  'use strict'


          //--------------------------------------
          // - START DATABASE SIZE LAST 6 MONTHS -
          //--------------------------------------

          // Get context with jQuery - using jQuery's .get() method.
          var salesChartCanvas = $('#salesChart').get(0).getContext('2d');

          
          <?php 
          $loop_label = array();
          $loop_new_count = array();
          $loop_total_count = array();
          $label_start = "";
          $label_end = "";
          $customers_created = $response_data->customers_created;
          $customers_created_total = $response_data->customers_created_total;

          for($i=0;$i<count($customers_created);$i++)
          {

            $customers_created_row = (array) $customers_created[$i];
            $customers_created_total_row = (array) $customers_created_total[$i];

            if($i==0)
            {
              $label_start = $customers_created_row[0]->month.", ".$customers_created_row[0]->year;
            }
            $label_end = $customers_created_row[0]->month.", ".$customers_created_row[0]->year;

            $loop_label[] = "'".$customers_created_row[0]->month."'";
            $loop_new_count[] = $customers_created_row[0]->total;
            $loop_total_count[] = $customers_created_total_row[0]->total;
          }

          $loop_label = implode(',', $loop_label);
          $loop_new_count = implode(',', $loop_new_count);
          $loop_total_count = implode(',', $loop_total_count);
          $customers_created_label = "New Registration: ".$label_start." - ".$label_end;
          ?>

          $('#customers_created_label').html("<?php echo $customers_created_label;?>");


          var salesChartData = {
            labels: [<?php echo $loop_label;?>],
            datasets: [
              {
                label: 'Digital Goods',
                backgroundColor: 'rgba(60,141,188,0.9)',
                borderColor: 'rgba(60,141,188,0.8)',
                pointRadius: false,
                pointColor: '#3b8bba',
                pointStrokeColor: 'rgba(60,141,188,1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data: [<?php echo $loop_new_count;?>]
              },
              {
                label: 'Electronics',
                backgroundColor: 'rgba(210, 214, 222, 1)',
                borderColor: 'rgba(210, 214, 222, 1)',
                pointRadius: false,
                pointColor: 'rgba(210, 214, 222, 1)',
                pointStrokeColor: '#c1c7d1',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(220,220,220,1)',
                data: [<?php echo $loop_total_count;?>]
              }
            ]
          };

          var salesChartOptions = {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
              display: false
            },
            scales: {
              xAxes: [{
                gridLines: {
                  display: false
                }
              }],
              yAxes: [{
                gridLines: {
                  display: false
                }
              }]
            }
          };

          // This will get the first returned node in the jQuery collection.
          // eslint-disable-next-line no-unused-vars
          var salesChart = new Chart(salesChartCanvas, {
            type: 'line',
            data: salesChartData,
            options: salesChartOptions
          }
          );

          //-------------------------------------
          // - END  DATABASE SIZE LAST 6 MONTHS -
          //-------------------------------------






      <?php

      $customers_sex_type = array('Unknown','Male','Female','Other');

      $piechart_return_names = array('','customers_sex','customers_age','customers_occas_drink_before_wine','customers_fav_wine_1','customers_avg_sp_per_bot_wine','customers_glasses_a_week');

        for($ijkl=1;$ijkl<=6;$ijkl++)
        {
          $DATA_RESPONSE = $response_data->{$piechart_return_names[$ijkl]};

          $DATA_COLOR = array('#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de', '#3EE761', '#5D52BF', '#7E9950', '#54FAA2', '#F20DA5', '#A73E48');


          $loop_label = array();
          $loop_total_count = array();
          $loop_color = array();
          $label_legend = "";

          for($i=1;$i<count($DATA_RESPONSE);$i++)
          {

            $DATA_RESPONSE_row = (array) $DATA_RESPONSE[$i];
            extract($DATA_RESPONSE_row);

            if($piechart_return_names[$ijkl]=='customers_sex')
            {
              $label = $customers_sex_type[$label]." (".$percentage."%)";
            }

            $loop_label[] = "'".$label."'";
            $loop_total_count[] = $total;

            $loop_color[] = "'".$DATA_COLOR[$i]."'";
            $label_legend .= '<li><i class=\"far fa-circle\" style=\"color: '.$DATA_COLOR[$i].';\"></i> '.$label.'</li>';
          }

          $loop_label = implode(',', $loop_label);
          $loop_total_count = implode(',', $loop_total_count);
          $loop_color = implode(',', $loop_color);


      ?>
          $('#pieChartLegend<?php echo $ijkl; ?>').html("<?php echo $label_legend;?>");
          //-------------
          // - PIE CHART -
          //-------------
          // Get context with jQuery - using jQuery's .get() method.
          var pieChartCanvas = $('#pieChart<?php echo $ijkl; ?>').get(0).getContext('2d');
          var pieData = {
            labels: [<?php echo $loop_label; ?>],
            datasets: [
              {
                data: [<?php echo $loop_total_count; ?>],
                backgroundColor: [<?php echo $loop_color; ?>]
              }
            ]
          };
          var pieOptions = {
            legend: {
              display: false
            }
          };
          // Create pie or douhnut chart
          // You can switch between pie and douhnut using the method below.
          // eslint-disable-next-line no-unused-vars
          var pieChart = new Chart(pieChartCanvas, {
            type: 'doughnut',
            data: pieData,
            options: pieOptions
          });

          //-----------------
          // - END PIE CHART -
          //-----------------

      <?php 
        }
      ?>

});

</script>
