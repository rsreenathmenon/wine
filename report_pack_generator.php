<?php

include_once('custom/globals.php');

?>

<?php

include_once('fetch/report_pack_query_generator.php');

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
            <h1 class="m-0">Report Pack</h1>
          </div><!-- /.col -->

          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo HTTP_SERVER; ?>">Home</a></li>
              <li class="breadcrumb-item active">Report Pack</li>
            </ol>
          </div><!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


	<form id="filter-form" method="post">
	    <!-- Main content -->
	    <section class="content">
	        <div class="row">
	            <div class="col-12" id="accordion">


					<input type="text" name="show_level" class="form-control form_search_input_text hide" id="show_level" placeholder="Level" value="<?php echo $SHOW_LEVEL; ?>">
		                              

	                <div id="accordiancard_1" class="card card-warning card-outline">
	                    <a class="d-block w-100" data-toggle="collapse" href="#collapsepackCode">
	                        <div class="card-header">
	                            <h4 class="card-title w-100">
	                                Step 1 - Pack Code
	                            </h4>
	                        </div>
	                    </a>
	                    <div id="collapsepackCode" class="collapse" data-parent="#accordion">
	                        <div class="card-body">
	                            
	                    

		                      <div class="card-body">
		                        <div class="row">
		                          <div class="col-sm-6">
		                            <div class="form-group">
		                              <label for="filterField1">Select Pack Code</label>
		                              <select class="custom-select form-control-border" name="report_pack_name" id="report_pack_name">
				                          <option value="" <?php if($_POST['report_pack_name']==""){echo 'selected="selected"';}?> >-- SELECT --</option>
				                          <?php

				              							$data_table_pack = $response_data->pack;

				              							for($ij=0; $ij<count($data_table_pack); $ij++)
				              							{
				              							  $data_row_pack = (array) $data_table_pack[$ij];
				              							  extract($data_row_pack);

				              							  $option = "<option value='".$pack_ref."'";
				              							  if($pack_ref==$_POST['report_pack_name'])
				              							  {
				              							  	$option .= "selected='selected'";
				              							  }
				              							  $option .= ">";
				              							  $option .= $pack_code;
				              							  $option .= "</option>";

				              							  echo $option;
				              							}

				              						?>
				                        </select>
		                            </div>
		                          </div>
		                        </div>
		                      </div>
		                      <!-- /.card-body -->

		                      <div class="card-footer">
		                        <button type="button" class="btn btn-primary filter-btn filter-btn-navigation" value="1">Search</button>
		                      </div>
		                    

	                        </div>
	                    </div>
	                </div>


	                <div id="accordiancard_2" class="card card-warning card-outline">
	                    <a class="d-block w-100" data-toggle="collapse" href="#collapsefilter">
	                        <div class="card-header">
	                            <h4 class="card-title w-100">
	                                Step 2 - Filters
	                            </h4>
	                        </div>
	                    </a>
	                    <div id="collapsefilter" class="collapse" data-parent="#accordion">
	                      
	                      <div class="card-body">
		                      <div class="row">
		                      	<div class="col-lg-12">
		                    
									            <div class="card">
									              <div class="card-header bg-primary">
									              	
									                <h3 class="card-title">Wines Details</h3>

									              </div>
									              <!-- /.card-header -->
									              <div class="card-body p-0">
									                <table class="table table-striped table-hover">
									                  <thead>
									                    <tr>
									                      <th style="width:20%"></th>
									                      <th style="width:20%" class="text-center">#1</th>
									                      <th style="width:20%" class="text-center">#2</th>
									                      <th style="width:20%" class="text-center">#3</th>
									                      <th style="width:20%" class="text-center">#4</th>
									                    </tr>
									                  </thead>
									                  <tbody>
									                  <?php
									                    $customers_fav_wine_1 = $response_data->customers_fav_wine_1;
									                    $customers_fav_wine_2 = $response_data->customers_fav_wine_2;
									                    $customers_fav_wine_3 = $response_data->customers_fav_wine_3;
									                    $customers_fav_wine_4 = $response_data->customers_fav_wine_4;
									                  ?>

									                      <tr>
									                        <th>Name</th>
									                        <td><?php echo $customers_fav_wine_1->wine_name ; ?></td>
									                        <td><?php echo $customers_fav_wine_2->wine_name ; ?></td>
									                        <td><?php echo $customers_fav_wine_3->wine_name ; ?></td>
									                        <td><?php echo $customers_fav_wine_4->wine_name ; ?></td>
									                      </tr>
									                      
									                      <tr>
									                        <th>Winery</th>
									                        <td><?php echo $customers_fav_wine_1->winery_name ; ?></td>
									                        <td><?php echo $customers_fav_wine_2->winery_name ; ?></td>
									                        <td><?php echo $customers_fav_wine_3->winery_name ; ?></td>
									                        <td><?php echo $customers_fav_wine_4->winery_name ; ?></td>
									                      </tr>
									                      
									                      <tr>
									                        <th>Varietal</th>
									                        <td><?php echo $customers_fav_wine_1->varietal_name_list ; ?></td>
									                        <td><?php echo $customers_fav_wine_2->varietal_name_list ; ?></td>
									                        <td><?php echo $customers_fav_wine_3->varietal_name_list ; ?></td>
									                        <td><?php echo $customers_fav_wine_4->varietal_name_list ; ?></td>
									                      </tr>
									                      
									                      <tr>
									                        <th>Region</th>
									                        <td><?php echo $customers_fav_wine_1->region_name ; if($customers_fav_wine_1->states_name){ echo ", ".$customers_fav_wine_1->states_name ;} ?> </td>
									                        <td><?php echo $customers_fav_wine_2->region_name ; if($customers_fav_wine_2->states_name){ echo ", ".$customers_fav_wine_2->states_name ;} ?></td>
									                        <td><?php echo $customers_fav_wine_3->region_name ; if($customers_fav_wine_3->states_name){ echo ", ".$customers_fav_wine_3->states_name ;} ?></td>
									                        <td><?php echo $customers_fav_wine_4->region_name ; if($customers_fav_wine_4->states_name){ echo ", ".$customers_fav_wine_4->states_name ;} ?></td>
									                      </tr>
									                      
									                      <tr>
									                        <th>Vintage</th>
									                        <td><?php echo $customers_fav_wine_1->wine_vintage ; ?></td>
									                        <td><?php echo $customers_fav_wine_2->wine_vintage ; ?></td>
									                        <td><?php echo $customers_fav_wine_3->wine_vintage ; ?></td>
									                        <td><?php echo $customers_fav_wine_4->wine_vintage ; ?></td>
									                      </tr>
									                  </tbody>
									                </table>
									              </div>
									              <!-- /.card-body -->
									              
									            </div>



				                    
									            <div class="card">
									              <div class="card-header bg-info">
									              	
									                <h3 class="card-title">Comparative Rankings</h3>

									              </div>
									              <!-- /.card-header -->
									              <div class="card-body p-0">
									                <table class="table table-striped table-hover">
									                  <thead>
									                    <tr>
									                      <th style="width:20%"></th>
									                      <th style="width:20%" class="text-center">#1</th>
									                      <th style="width:20%" class="text-center">#2</th>
									                      <th style="width:20%" class="text-center">#3</th>
									                      <th style="width:20%" class="text-center">#4</th>
									                    </tr>
									                  </thead>
									                  <tbody>
									                  <?php
									                    $cal_taste_score = json_decode(json_encode($response_data->cal_taste_score), true);
									                    $cal_smell_score = json_decode(json_encode($response_data->cal_smell_score), true);
									                    $cal_overall_score = json_decode(json_encode($response_data->cal_overall_score), true);
									                    $cal_first_in_pack_score = json_decode(json_encode($response_data->cal_first_in_pack_score), true);
									                    $cal_drink_again_score = json_decode(json_encode($response_data->cal_drink_again_score), true);
									                    $cal_most_expensive_score = json_decode(json_encode($response_data->cal_most_expensive_score), true);
									                    $cal_cheapest_score = json_decode(json_encode($response_data->cal_cheapest_score), true);
									                  ?>
									                  		<tr>
									                        <th>Taste</th>
									                        <td class="text-center"><?php echo $cal_taste_score['1'] ; ?></td>
									                        <td class="text-center"><?php echo $cal_taste_score['2'] ; ?></td>
									                        <td class="text-center"><?php echo $cal_taste_score['3'] ; ?></td>
									                        <td class="text-center"><?php echo $cal_taste_score['4'] ; ?></td>
									                      </tr>

									                      <tr>
									                        <th>Aroma</th>
									                        <td class="text-center"><?php echo $cal_smell_score['1'] ; ?></td>
									                        <td class="text-center"><?php echo $cal_smell_score['2'] ; ?></td>
									                        <td class="text-center"><?php echo $cal_smell_score['3'] ; ?></td>
									                        <td class="text-center"><?php echo $cal_smell_score['4'] ; ?></td>
									                      </tr>

									                      <tr>
									                        <th>Overall</th>
									                        <td class="text-center"><?php echo $cal_overall_score['1'] ; ?></td>
									                        <td class="text-center"><?php echo $cal_overall_score['2'] ; ?></td>
									                        <td class="text-center"><?php echo $cal_overall_score['3'] ; ?></td>
									                        <td class="text-center"><?php echo $cal_overall_score['4'] ; ?></td>
									                      </tr>

									                      <tr>
									                        <th>Price Perception (Most Expensive) </th>
									                        <td class="text-center"><?php echo $cal_most_expensive_score['1'] ; ?></td>
									                        <td class="text-center"><?php echo $cal_most_expensive_score['2'] ; ?></td>
									                        <td class="text-center"><?php echo $cal_most_expensive_score['3'] ; ?></td>
									                        <td class="text-center"><?php echo $cal_most_expensive_score['4'] ; ?></td>
									                      </tr>

									                      <tr>
									                        <th>Price Perception (Cheapest) </th>
									                        <td class="text-center"><?php echo $cal_cheapest_score['1'] ; ?></td>
									                        <td class="text-center"><?php echo $cal_cheapest_score['2'] ; ?></td>
									                        <td class="text-center"><?php echo $cal_cheapest_score['3'] ; ?></td>
									                        <td class="text-center"><?php echo $cal_cheapest_score['4'] ; ?></td>
									                      </tr>

									                      <tr>
									                        <th>Drink Again</th>
									                        <td class="text-center"><?php echo $cal_drink_again_score['1'] ; ?></td>
									                        <td class="text-center"><?php echo $cal_drink_again_score['2'] ; ?></td>
									                        <td class="text-center"><?php echo $cal_drink_again_score['3'] ; ?></td>
									                        <td class="text-center"><?php echo $cal_drink_again_score['4'] ; ?></td>
									                      </tr>

									                      <tr>
									                        <th>Favourite</th>
									                        <td class="text-center"><?php echo $cal_first_in_pack_score['1'] ; ?></td>
									                        <td class="text-center"><?php echo $cal_first_in_pack_score['2'] ; ?></td>
									                        <td class="text-center"><?php echo $cal_first_in_pack_score['3'] ; ?></td>
									                        <td class="text-center"><?php echo $cal_first_in_pack_score['4'] ; ?></td>
									                      </tr>

									                      
									                  </tbody>
									                </table>
									              </div>
									              <!-- /.card-body -->
									              
									            </div>




				                    
									            <div class="card">
									              <div class="card-header bg-lightblue">
									              	
									                <h3 class="card-title">Relative Scores</h3>

									              </div>
									              <!-- /.card-header -->
									              <div class="card-body p-0">
									                <table class="table table-striped table-hover">
									                  <thead>
									                    <tr>
									                      <th style="width:20%"></th>
									                      <th style="width:20%" class="text-center">#1</th>
									                      <th style="width:20%" class="text-center">#2</th>
									                      <th style="width:20%" class="text-center">#3</th>
									                      <th style="width:20%" class="text-center">#4</th>
									                    </tr>
									                  </thead>
									                  <tbody>									                  
									                  <?php
									                    $customers_score_wine_1 = $response_data->customers_score_wine_1;
									                    $customers_score_wine_2 = $response_data->customers_score_wine_2;
									                    $customers_score_wine_3 = $response_data->customers_score_wine_3;
									                    $customers_score_wine_4 = $response_data->customers_score_wine_4;
									                  ?>
									                      <tr>
									                        <th>Taste</th>
									                        <td class="text-center"><?php echo $customers_score_wine_1->taste_score ; ?></td>
									                        <td class="text-center"><?php echo $customers_score_wine_2->taste_score ; ?></td>
									                        <td class="text-center"><?php echo $customers_score_wine_3->taste_score ; ?></td>
									                        <td class="text-center"><?php echo $customers_score_wine_4->taste_score ; ?></td>
									                      </tr>

									                      <tr>
									                        <th>Aroma</th>
									                        <td class="text-center"><?php echo $customers_score_wine_1->smell_score ; ?></td>
									                        <td class="text-center"><?php echo $customers_score_wine_2->smell_score ; ?></td>
									                        <td class="text-center"><?php echo $customers_score_wine_3->smell_score ; ?></td>
									                        <td class="text-center"><?php echo $customers_score_wine_4->smell_score ; ?></td>
									                      </tr>

									                      <tr>
									                        <th>Overall</th>
									                        <td class="text-center"><?php echo $customers_score_wine_1->overall_score ; ?></td>
									                        <td class="text-center"><?php echo $customers_score_wine_2->overall_score ; ?></td>
									                        <td class="text-center"><?php echo $customers_score_wine_3->overall_score ; ?></td>
									                        <td class="text-center"><?php echo $customers_score_wine_4->overall_score ; ?></td>
									                      </tr>

									                      <tr>
									                        <th>Price Perception (Most Expensive) </th>
									                        <td class="text-center"><?php echo $customers_score_wine_1->most_expensive_score ; ?></td>
									                        <td class="text-center"><?php echo $customers_score_wine_2->most_expensive_score ; ?></td>
									                        <td class="text-center"><?php echo $customers_score_wine_3->most_expensive_score ; ?></td>
									                        <td class="text-center"><?php echo $customers_score_wine_4->most_expensive_score ; ?></td>
									                      </tr>

									                      <tr>
									                        <th>Price Perception (Cheapest) </th>
									                        <td class="text-center"><?php echo $customers_score_wine_1->cheapest_score ; ?></td>
									                        <td class="text-center"><?php echo $customers_score_wine_2->cheapest_score ; ?></td>
									                        <td class="text-center"><?php echo $customers_score_wine_3->cheapest_score ; ?></td>
									                        <td class="text-center"><?php echo $customers_score_wine_4->cheapest_score ; ?></td>
									                      </tr>

									                      <tr>
									                        <th>Drink Again</th>
									                        <td class="text-center"><?php echo $customers_score_wine_1->drink_again ; ?>%</td>
									                        <td class="text-center"><?php echo $customers_score_wine_2->drink_again ; ?>%</td>
									                        <td class="text-center"><?php echo $customers_score_wine_3->drink_again ; ?>%</td>
									                        <td class="text-center"><?php echo $customers_score_wine_4->drink_again ; ?>%</td>
									                      </tr>

									                      <tr>
									                        <th>Favourite</th>
									                        <td class="text-center"><?php echo $customers_score_wine_1->first_in_pack_score ; ?></td>
									                        <td class="text-center"><?php echo $customers_score_wine_2->first_in_pack_score ; ?></td>
									                        <td class="text-center"><?php echo $customers_score_wine_3->first_in_pack_score ; ?></td>
									                        <td class="text-center"><?php echo $customers_score_wine_4->first_in_pack_score ; ?></td>
									                      </tr>
									                  </tbody>
									                </table>
									              </div>
									              <!-- /.card-body -->
									              
									            </div>

								          	</div>
								          </div>
								        </div>
	                    </div>
	                </div>



	            </div>
	        </div>
	    </section>
	    <!-- /.content -->
	</form>

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
  custom_js_nav_bar_selection("report_pack");
  custom_js_show_accordian_level("<?php echo $SHOW_LEVEL; ?>");
  custom_js_show_accordian_hierarchy("<?php echo $SHOW_LEVEL; ?>",5);
  custom_js_number_field_check();
  custom_js_datepicker_activate();
  custom_js_navigation_report_pack();
  // custom_js_reset_filter_report_pack();
  // custom_js_open_all_filter_report_pack();
  custom_js_show_accordian_hierarchy_hide("<?php echo $SHOW_LEVEL; ?>",2);
  
  //custom_js_pagination_sync("<?php echo $PAGE; ?>");
  //custom_js_show_filter("<?php echo $SHOW_FILTER; ?>");
  //custom_js_submit_filter();    
</script>