<?php

include_once('custom/globals.php');

?>

<?php

include_once('fetch/report_wine_query_generator.php');

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
            <h1 class="m-0">List Generator</h1>
          </div><!-- /.col -->

          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo HTTP_SERVER; ?>">Home</a></li>
              <li class="breadcrumb-item active">List Generator</li>
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
		                              <select class="custom-select form-control-border" name="report_wine_name" id="report_wine_name">
				                          <option value="" <?php if($_POST['report_wine_name']==""){echo 'selected="selected"';}?> >-- SELECT --</option>
				                          <?php

				              							$data_table_pack = $response_data->pack;

				              							for($ij=0; $ij<count($data_table_pack); $ij++)
				              							{
				              							  $data_row_pack = (array) $data_table_pack[$ij];
				              							  extract($data_row_pack);

				              							  $option = "<option value='".$pack_ref."'";
				              							  if($pack_ref==$_POST['report_wine_name'])
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
	                            
	                    

		                      <div class="card-body">
		                        <div class="row">

		                        	<div class="col-sm-6">
				                        <div class="card card-primary filter-sub-section collapsed-card">

				                          <div class="card-header">
				                            <h3 class="card-title">Demographic</h3>

				                            <div class="card-tools">
				                              <button type="button" class="btn btn-tool data_collapse_btn_common" data-card-widget="collapse"><i class="fas fa-plus"></i>
				                            </div>
				                            <!-- /.card-tools -->
				                          </div>
				                          <!-- /.card-header -->
				                          <div class="card-body">
				                            
				                            
											<div class="form-group">
												<label for="customers_age">Age</label>
												<div class="row">
													<div class="col-6">
														<input type="number" class="form-control form-control-border form-control-number-min" name="customers_age_start" id="customers_age_start" placeholder="Start Range" autocomplete="off" min="18" value="<?php echo $_POST['customers_age_start'];?>">
													</div>
													<div class="col-6">
														<input type="number" class="form-control form-control-border form-control-number-min" name="customers_age_end" id="customers_age_end" placeholder="End Range" autocomplete="off" min="18" value="<?php echo $_POST['customers_age_end'];?>">
													</div>
												</div>
											</div>
				                            
											<div class="row">
												<div class="form-group col-lg-6">
													<label for="customers_educationlevel">Education</label>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" value="1" <?php if (in_array("1", $_POST['customers_educationlevel'])){  echo "checked='checked'";  } ?> name="customers_educationlevel[]"><label class="form-check-label">High School</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" value="2" <?php if (in_array("2", $_POST['customers_educationlevel'])){  echo "checked='checked'";  } ?> name="customers_educationlevel[]"><label class="form-check-label">Diploma / Certificate</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" value="3" <?php if (in_array("3", $_POST['customers_educationlevel'])){  echo "checked='checked'";  } ?> name="customers_educationlevel[]"><label class="form-check-label">Degree</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" value="4" <?php if (in_array("4", $_POST['customers_educationlevel'])){  echo "checked='checked'";  } ?> name="customers_educationlevel[]"><label class="form-check-label">Post Graduate</label>
													</div>
												</div>

												<div class="form-group col-lg-6">
													<label for="customers_sex">Sex</label>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" value="1" <?php if (in_array("1", $_POST['customers_sex'])){  echo "checked='checked'";  } ?> name="customers_sex[]"><label class="form-check-label">Male</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" value="2" <?php if (in_array("2", $_POST['customers_sex'])){  echo "checked='checked'";  } ?> name="customers_sex[]"><label class="form-check-label">Female</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" value="3" <?php if (in_array("3", $_POST['customers_sex'])){  echo "checked='checked'";  } ?> name="customers_sex[]"><label class="form-check-label">Other</label>
													</div>
												</div>

												<div class="form-group col-lg-6">
													<label for="customers_maritalstatus">Relationship Status</label>												
													<div class="form-check">
														<input class="form-check-input" type="checkbox" value="1" <?php if (in_array("1", $_POST['customers_maritalstatus'])){  echo "checked='checked'";  } ?> name="customers_maritalstatus[]"><label class="form-check-label">Single</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" value="2" <?php if (in_array("2", $_POST['customers_maritalstatus'])){  echo "checked='checked'";  } ?> name="customers_maritalstatus[]"><label class="form-check-label">Married</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" value="3" <?php if (in_array("3", $_POST['customers_maritalstatus'])){  echo "checked='checked'";  } ?> name="customers_maritalstatus[]"><label class="form-check-label">Widowed</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" value="4" <?php if (in_array("4", $_POST['customers_maritalstatus'])){  echo "checked='checked'";  } ?> name="customers_maritalstatus[]"><label class="form-check-label">Divorced</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" value="5" <?php if (in_array("5", $_POST['customers_maritalstatus'])){  echo "checked='checked'";  } ?> name="customers_maritalstatus[]"><label class="form-check-label">Seperated</label>
													</div>
												</div>

												<div class="form-group col-lg-6">
													<label for="customers_country_ref">Country</label>	
													<?php

					                                  $data_table_country = $response_data->country;
					                                  for($ij=0; $ij<count($data_table_country); $ij++)
					                                  {
					                                    $data_row_country = (array) $data_table_country[$ij];
					                                    extract($data_row_country);
					                                    ?>
															<div class="form-check">
																<input class="form-check-input" type="checkbox" value="<?php echo $country_ref; ?>" <?php if (in_array($country_ref, $_POST['customers_country_ref'])){  echo "checked='checked'";  } ?> name="customers_country_ref[]"><label class="form-check-label"><?php echo $country_name; ?></label>
															</div>
					                                    <?php
					                                  }

					                                ?>

												</div>

												<div class="form-group col-lg-6">
													<label for="customers_states_ref">States</label>	
													<?php

					                                  $data_table_states = $response_data->states;
					                                  for($ij=0; $ij<count($data_table_states); $ij++)
					                                  {
					                                    $data_row_states = (array) $data_table_states[$ij];
					                                    extract($data_row_states);
					                                    ?>
															<div class="form-check">
																<input class="form-check-input" type="checkbox" value="<?php echo $states_ref; ?>" <?php if (in_array($states_ref, $_POST['customers_states_ref'])){  echo "checked='checked'";  } ?> name="customers_states_ref[]"><label class="form-check-label"><?php echo $states_name; ?></label>
															</div>
					                                    <?php
					                                  }

					                                ?>

												</div>

											</div>
				                            				 

				                          </div>
				                          <!-- /.card-body -->
				                        </div>
				                        <!-- /.card -->
				                    </div>



				                    

		                        	<div class="col-sm-6">
				                        <div class="card card-primary filter-sub-section collapsed-card">

				                          <div class="card-header">
				                            <h3 class="card-title">Wine Preferences</h3>

				                            <div class="card-tools">
				                              <button type="button" class="btn btn-tool data_collapse_btn_common" data-card-widget="collapse"><i class="fas fa-plus"></i>
				                            </div>
				                            <!-- /.card-tools -->
				                          </div>
				                          <!-- /.card-header -->
				                          <div class="card-body">
				                            
				                            
											<div class="row">
												
												<div class="form-group col-lg-6">
													<label for="customers_fav_wine_1">Wine Style - Favourite</label>	
													<?php

					                                  $data_table_customers_fav_wine_1 = $response_data->customers_fav_wine_1;
					                                  for($ij=0; $ij<count($data_table_customers_fav_wine_1); $ij++)
					                                  {
					                                    $data_row_customers_fav_wine_1 = (array) $data_table_customers_fav_wine_1[$ij];
					                                    extract($data_row_customers_fav_wine_1);

					                                    ?>
															<div class="form-check">
																<input class="form-check-input" type="checkbox" value="<?php echo $customers_fav_wine_1; ?>" <?php if (in_array($customers_fav_wine_1, $_POST['customers_fav_wine_1'])){  echo "checked='checked'";  } ?> name="customers_fav_wine_1[]"><label class="form-check-label"><?php echo $customers_fav_wine_1; ?></label>
															</div>
					                                    <?php
					                                  }

					                                ?>

												</div>
												
												<div class="form-group col-lg-6">
													<label for="customers_fav_wine_2">Wine Style - Second Favourite</label>	
													<?php

					                                  $data_table_customers_fav_wine_2 = $response_data->customers_fav_wine_2;
					                                  for($ij=0; $ij<count($data_table_customers_fav_wine_2); $ij++)
					                                  {
					                                    $data_row_customers_fav_wine_2 = (array) $data_table_customers_fav_wine_2[$ij];
					                                    extract($data_row_customers_fav_wine_2);

					                                    ?>
															<div class="form-check">
																<input class="form-check-input" type="checkbox" value="<?php echo $customers_fav_wine_2; ?>" <?php if (in_array($customers_fav_wine_2, $_POST['customers_fav_wine_2'])){  echo "checked='checked'";  } ?> name="customers_fav_wine_2[]"><label class="form-check-label"><?php echo $customers_fav_wine_2; ?></label>
															</div>
					                                    <?php
					                                  }

					                                ?>

												</div>
												
												<div class="form-group col-lg-6">
													<label for="customers_least_fav_wine">Wine Style - Least Favourite</label>	
													<?php

					                                  $data_table_customers_least_fav_wine = $response_data->customers_least_fav_wine;
					                                  for($ij=0; $ij<count($data_table_customers_least_fav_wine); $ij++)
					                                  {
					                                    $data_row_customers_least_fav_wine = (array) $data_table_customers_least_fav_wine[$ij];
					                                    extract($data_row_customers_least_fav_wine);

					                                    ?>
															<div class="form-check">
																<input class="form-check-input" type="checkbox" value="<?php echo $customers_least_fav_wine; ?>" <?php if (in_array($customers_least_fav_wine, $_POST['customers_least_fav_wine'])){  echo "checked='checked'";  } ?> name="customers_least_fav_wine[]"><label class="form-check-label"><?php echo $customers_least_fav_wine; ?></label>
															</div>
					                                    <?php
					                                  }

					                                ?>

												</div>
												
												<div class="form-group col-lg-6">
													<label for="customers_avg_sp_per_bot_wine">Normal Purchase Price</label>	
													<?php

					                                  $data_table_customers_avg_sp_per_bot_wine = $response_data->customers_avg_sp_per_bot_wine;
					                                  for($ij=0; $ij<count($data_table_customers_avg_sp_per_bot_wine); $ij++)
					                                  {
					                                    $data_row_customers_avg_sp_per_bot_wine = (array) $data_table_customers_avg_sp_per_bot_wine[$ij];
					                                    extract($data_row_customers_avg_sp_per_bot_wine);

					                                    ?>
															<div class="form-check">
																<input class="form-check-input" type="checkbox" value="<?php echo $customers_avg_sp_per_bot_wine; ?>" <?php if (in_array($customers_avg_sp_per_bot_wine, $_POST['customers_avg_sp_per_bot_wine'])){  echo "checked='checked'";  } ?> name="customers_avg_sp_per_bot_wine[]"><label class="form-check-label"><?php echo $customers_avg_sp_per_bot_wine; ?></label>
															</div>
					                                    <?php
					                                  }

					                                ?>

												</div>
												
												<div class="form-group col-lg-6">
													<label for="customers_glasses_a_week">Glass of Wine Per Week</label>	
													<?php

					                                  $data_table_customers_glasses_a_week = $response_data->customers_glasses_a_week;
					                                  for($ij=0; $ij<count($data_table_customers_glasses_a_week); $ij++)
					                                  {
					                                    $data_row_customers_glasses_a_week = (array) $data_table_customers_glasses_a_week[$ij];
					                                    extract($data_row_customers_glasses_a_week);

					                                    ?>
															<div class="form-check">
																<input class="form-check-input" type="checkbox" value="<?php echo $customers_glasses_a_week; ?>" <?php if (in_array($customers_glasses_a_week, $_POST['customers_glasses_a_week'])){  echo "checked='checked'";  } ?> name="customers_glasses_a_week[]"><label class="form-check-label"><?php echo $customers_glasses_a_week; ?></label>
															</div>
					                                    <?php
					                                  }

					                                ?>

												</div>
												
												<div class="form-group col-lg-6">
													<label for="customers_ethnicity">Ethnicity</label>	
													<?php

					                                  $data_table_customers_ethnicity = $response_data->customers_ethnicity;
					                                  for($ij=0; $ij<count($data_table_customers_ethnicity); $ij++)
					                                  {
					                                    $data_row_customers_ethnicity = (array) $data_table_customers_ethnicity[$ij];
					                                    extract($data_row_customers_ethnicity);

					                                    ?>
															<div class="form-check">
																<input class="form-check-input" type="checkbox" value="<?php echo $customers_ethnicity; ?>" <?php if (in_array($customers_ethnicity, $_POST['customers_ethnicity'])){  echo "checked='checked'";  } ?> name="customers_ethnicity[]"><label class="form-check-label"><?php echo $customers_ethnicity; ?></label>
															</div>
					                                    <?php
					                                  }

					                                ?>

												</div>
												
												<div class="form-group col-lg-6">
													<label for="customers_wine_varietal">Wine Varietal</label>	
													<?php

					                                  $data_table_customers_wine_varietal = $response_data->customers_wine_varietal;
					                                  for($ij=0; $ij<count($data_table_customers_wine_varietal); $ij++)
					                                  {
					                                    $data_row_customers_wine_varietal = (array) $data_table_customers_wine_varietal[$ij];
					                                    extract($data_row_customers_wine_varietal);

					                                    ?>
															<div class="form-check">
																<input class="form-check-input" type="checkbox" value="<?php echo $customers_wine_varietal; ?>" <?php if (in_array($customers_wine_varietal, $_POST['customers_wine_varietal'])){  echo "checked='checked'";  } ?> name="customers_wine_varietal[]"><label class="form-check-label"><?php echo $customers_wine_varietal; ?></label>
															</div>
					                                    <?php
					                                  }

					                                ?>

												</div>
												
												<div class="form-group col-lg-6">
													<label for="customers_fav_wine_region">Favourite Wine Country</label>	
													<?php

					                                  $data_table_customers_fav_wine_region = $response_data->customers_fav_wine_region;
					                                  for($ij=0; $ij<count($data_table_customers_fav_wine_region); $ij++)
					                                  {
					                                    $data_row_customers_fav_wine_region = (array) $data_table_customers_fav_wine_region[$ij];
					                                    extract($data_row_customers_fav_wine_region);

					                                    ?>
															<div class="form-check">
																<input class="form-check-input" type="checkbox" value="<?php echo $customers_fav_wine_region; ?>" <?php if (in_array($customers_fav_wine_region, $_POST['customers_fav_wine_region'])){  echo "checked='checked'";  } ?> name="customers_fav_wine_region[]"><label class="form-check-label"><?php echo $customers_fav_wine_region; ?></label>
															</div>
					                                    <?php
					                                  }

					                                ?>

												</div>
												
												<div class="form-group col-lg-6">
													<label for="customers_normally_buy_wine">Normal Purchase Channel</label>	
													<?php

					                                  $data_table_customers_normally_buy_wine = $response_data->customers_normally_buy_wine;
					                                  for($ij=0; $ij<count($data_table_customers_normally_buy_wine); $ij++)
					                                  {
					                                    $data_row_customers_normally_buy_wine = (array) $data_table_customers_normally_buy_wine[$ij];
					                                    extract($data_row_customers_normally_buy_wine);

					                                    ?>
															<div class="form-check">
																<input class="form-check-input" type="checkbox" value="<?php echo $customers_normally_buy_wine; ?>" <?php if (in_array($customers_normally_buy_wine, $_POST['customers_normally_buy_wine'])){  echo "checked='checked'";  } ?> name="customers_normally_buy_wine[]"><label class="form-check-label"><?php echo $customers_normally_buy_wine; ?></label>
															</div>
					                                    <?php
					                                  }

					                                ?>

												</div>
												
												<div class="form-group col-lg-6">
													<label for="customers_occas_drink_before_wine">What you occasionally choose before wine</label>	
													<?php

					                                  $data_table_customers_occas_drink_before_wine = $response_data->customers_occas_drink_before_wine;
					                                  for($ij=0; $ij<count($data_table_customers_occas_drink_before_wine); $ij++)
					                                  {
					                                    $data_row_customers_occas_drink_before_wine = (array) $data_table_customers_occas_drink_before_wine[$ij];
					                                    extract($data_row_customers_occas_drink_before_wine);

					                                    ?>
															<div class="form-check">
																<input class="form-check-input" type="checkbox" value="<?php echo $customers_occas_drink_before_wine; ?>" <?php if (in_array($customers_occas_drink_before_wine, $_POST['customers_occas_drink_before_wine'])){  echo "checked='checked'";  } ?> name="customers_occas_drink_before_wine[]"><label class="form-check-label"><?php echo $customers_occas_drink_before_wine; ?></label>
															</div>
					                                    <?php
					                                  }

					                                ?>

												</div>
												
												<div class="form-group col-lg-6">
													<label for="customers_last_winery_visit">When did you last visit a winery</label>	
													<?php

					                                  $data_table_customers_last_winery_visit = $response_data->customers_last_winery_visit;
					                                  for($ij=0; $ij<count($data_table_customers_last_winery_visit); $ij++)
					                                  {
					                                    $data_row_customers_last_winery_visit = (array) $data_table_customers_last_winery_visit[$ij];
					                                    extract($data_row_customers_last_winery_visit);

					                                    ?>
															<div class="form-check">
																<input class="form-check-input" type="checkbox" value="<?php echo $customers_last_winery_visit; ?>" <?php if (in_array($customers_last_winery_visit, $_POST['customers_last_winery_visit'])){  echo "checked='checked'";  } ?> name="customers_last_winery_visit[]"><label class="form-check-label"><?php echo $customers_last_winery_visit; ?></label>
															</div>
					                                    <?php
					                                  }

					                                ?>

												</div>
												
												<div class="form-group col-lg-6">
													<label for="customers_member_wine_club">Are you a member of a wine club</label>	
													<?php

					                                  $data_table_customers_member_wine_club = $response_data->customers_member_wine_club;
					                                  for($ij=0; $ij<count($data_table_customers_member_wine_club); $ij++)
					                                  {
					                                    $data_row_customers_member_wine_club = (array) $data_table_customers_member_wine_club[$ij];
					                                    extract($data_row_customers_member_wine_club);

					                                    ?>
															<div class="form-check">
																<input class="form-check-input" type="checkbox" value="<?php echo $customers_member_wine_club; ?>" <?php if (in_array($customers_member_wine_club, $_POST['customers_member_wine_club'])){  echo "checked='checked'";  } ?> name="customers_member_wine_club[]"><label class="form-check-label"><?php echo $customers_member_wine_club; ?></label>
															</div>
					                                    <?php
					                                  }

					                                ?>

												</div>

											</div>
				 

				                          </div>
				                          <!-- /.card-body -->
				                        </div>
				                        <!-- /.card -->
				                    </div>


				                    

		                        	<div class="col-sm-6">
				                        <div class="card card-primary filter-sub-section collapsed-card">

				                          <div class="card-header">
				                            <h3 class="card-title">Administration</h3>

				                            <div class="card-tools">
				                              <button type="button" class="btn btn-tool data_collapse_btn_common" data-card-widget="collapse"><i class="fas fa-plus"></i>
				                            </div>
				                            <!-- /.card-tools -->
				                          </div>
				                          <!-- /.card-header -->
				                          <div class="card-body">
				                            
				                            
											<div class="form-group">
												<label for="customers_created">Date Created</label>
												<div class="row">
													<div class="col-6">

									                    <div class="input-group date form-control-datepicker" id="customers_created_start" data-target-input="nearest">
									                        <input type="text" class="form-control datetimepicker-input" data-target="#customers_created_start" name="customers_created_start" value="<?php echo $_POST['customers_created_start'];?>">
									                        <div class="input-group-append" data-target="#customers_created_start" data-toggle="datetimepicker">
									                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
									                        </div>
									                    </div>

													</div>
													<div class="col-6">

									                    <div class="input-group date form-control-datepicker" id="customers_created_end" data-target-input="nearest">
									                        <input type="text" class="form-control datetimepicker-input" data-target="#customers_created_end" name="customers_created_end" value="<?php echo $_POST['customers_created_end'];?>">
									                        <div class="input-group-append" data-target="#customers_created_end" data-toggle="datetimepicker">
									                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
									                        </div>
									                    </div>

													</div>
												</div>
											</div>
				 

				                          </div>
				                          <!-- /.card-body -->
				                        </div>
				                        <!-- /.card -->
				                    </div>


				                    

		                        	<div class="col-sm-6">
				                        <div class="card card-primary filter-sub-section collapsed-card">

				                          <div class="card-header">
				                            <h3 class="card-title">Wine Packs Sent / Responses Received</h3>

				                            <div class="card-tools">
				                              <button type="button" class="btn btn-tool data_collapse_btn_common" data-card-widget="collapse"><i class="fas fa-plus"></i>
				                            </div>
				                            <!-- /.card-tools -->
				                          </div>
				                          <!-- /.card-header -->
				                          <div class="card-body">
				                            
				                            
											<div class="form-group">
												<label for="custpack_sent">Number Packs Sent</label>
												<div class="row">
													<div class="col-6">
														<input type="number" class="form-control form-control-border form-control-number-min" name="custpack_sent_start" id="custpack_sent_start" placeholder="Start Range" autocomplete="off" min="0" value="<?php echo $_POST['custpack_sent_start'];?>">
													</div>
													<div class="col-6">
														<input type="number" class="form-control form-control-border form-control-number-min" name="custpack_sent_end" id="custpack_sent_end" placeholder="End Range" autocomplete="off" min="0" value="<?php echo $_POST['custpack_sent_end'];?>">
													</div>
												</div>
											</div>
				                            
											<div class="form-group">
												<label for="custpack_response_received">Number Responses Received </label>
												<div class="row">
													<div class="col-6">
														<input type="number" class="form-control form-control-border form-control-number-min" name="custpack_response_received_start" id="custpack_response_received_start" placeholder="Start Range" autocomplete="off" min="0" value="<?php echo $_POST['custpack_response_received_start'];?>">
													</div>
													<div class="col-6">
														<input type="number" class="form-control form-control-border form-control-number-min" name="custpack_response_received_end" id="custpack_response_received_end" placeholder="End Range" autocomplete="off" min="0" value="<?php echo $_POST['custpack_response_received_end'];?>">
													</div>
												</div>
											</div>
				                            
											<div class="form-group">
												<label for="packresponse_received">In Last xx Days</label>
												<div class="row">
													<div class="col-6">
														<input type="number" class="form-control form-control-border form-control-number-min" name="packresponse_received_start" id="packresponse_received_start" placeholder="Start Range" autocomplete="off" min="0" value="<?php echo $_POST['packresponse_received_start'];?>">
													</div>
													<div class="col-6">
														<input type="number" class="form-control form-control-border form-control-number-min" name="packresponse_received_end" id="packresponse_received_end" placeholder="End Range" autocomplete="off" min="0" value="<?php echo $_POST['packresponse_received_end'];?>">
													</div>
												</div>
											</div>
				 

				                          </div>
				                          <!-- /.card-body -->
				                        </div>
				                        <!-- /.card -->
				                    </div>


				                    

		                        	<div class="col-sm-6">
				                        <div class="card card-primary filter-sub-section collapsed-card">

				                          <div class="card-header">
				                            <h3 class="card-title">Wine Pack Feedback Responsiveness</h3>

				                            <div class="card-tools">
				                              <button type="button" class="btn btn-tool data_collapse_btn_common" data-card-widget="collapse"><i class="fas fa-plus"></i>
				                            </div>
				                            <!-- /.card-tools -->
				                          </div>
				                          <!-- /.card-header -->
				                          <div class="card-body">
				                            
											<div class="form-group">
												<label for="custpack_avg_days_response">Ave days response time</label>
												<div class="row">
													<div class="col-6">
														<input type="number" class="form-control form-control-border form-control-number-min" name="custpack_avg_days_response_start" id="custpack_avg_days_response_start" placeholder="Start Range" autocomplete="off" min="0" value="<?php echo $_POST['custpack_avg_days_response_start'];?>">
													</div>
													<div class="col-6">
														<input type="number" class="form-control form-control-border form-control-number-min" name="custpack_avg_days_response_end" id="custpack_avg_days_response_end" placeholder="End Range" autocomplete="off" min="0" value="<?php echo $_POST['custpack_avg_days_response_end'];?>">
													</div>
												</div>
											</div>
				                            
											<div class="form-group">
												<label for="custpack_score_incl_1">Number packs with responses including a score of 1</label>
												<div class="row">
													<div class="col-6">
														<input type="number" class="form-control form-control-border form-control-number-min" name="custpack_score_incl_1_start" id="custpack_score_incl_1_start" placeholder="Start Range" autocomplete="off" min="0" value="<?php echo $_POST['custpack_score_incl_1_start'];?>">
													</div>
													<div class="col-6">
														<input type="number" class="form-control form-control-border form-control-number-min" name="custpack_score_incl_1_end" id="custpack_score_incl_1_end" placeholder="End Range" autocomplete="off" min="0" value="<?php echo $_POST['custpack_score_incl_1_end'];?>">
													</div>
												</div>
											</div>
				                            
											<div class="form-group">
												<label for="custpack_score_incl_5">Number packs with responses including a score of 5</label>
												<div class="row">
													<div class="col-6">
														<input type="number" class="form-control form-control-border form-control-number-min" name="custpack_score_incl_5_start" id="custpack_score_incl_5_start" placeholder="Start Range" autocomplete="off" min="0" value="<?php echo $_POST['custpack_score_incl_5_start'];?>">
													</div>
													<div class="col-6">
														<input type="number" class="form-control form-control-border form-control-number-min" name="custpack_score_incl_5_end" id="custpack_score_incl_5_end" placeholder="End Range" autocomplete="off" min="0" value="<?php echo $_POST['custpack_score_incl_5_end'];?>">
													</div>
												</div>
											</div>
				                            
											<div class="form-group">
												<label for="packresponse_avg_date">In Last xx Days</label>
												<div class="row">
													<div class="col-6">
														<input type="number" class="form-control form-control-border form-control-number-min" name="packresponse_avg_date_start" id="packresponse_avg_date_start" placeholder="Start Range" autocomplete="off" min="0" value="<?php echo $_POST['packresponse_avg_date_start'];?>">
													</div>
													<div class="col-6">
														<input type="number" class="form-control form-control-border form-control-number-min" name="packresponse_avg_date_end" id="packresponse_avg_date_end" placeholder="End Range" autocomplete="off" min="0" value="<?php echo $_POST['packresponse_avg_date_end'];?>">
													</div>
												</div>
											</div>
				 

				                          </div>
				                          <!-- /.card-body -->
				                        </div>
				                        <!-- /.card -->
				                    </div>


				                    

		                        	<div class="col-sm-6">
				                        <div class="card card-primary filter-sub-section collapsed-card">

				                          <div class="card-header">
				                            <h3 class="card-title">Ignore clients</h3>

				                            <div class="card-tools">
				                              <button type="button" class="btn btn-tool data_collapse_btn_common" data-card-widget="collapse"><i class="fas fa-plus"></i>
				                            </div>
				                            <!-- /.card-tools -->
				                          </div>
				                          <!-- /.card-header -->
				                          <div class="card-body">
				                            
											<div class="row">
												<div class="form-group col-lg-6">
													<label for="custpack_already_sent_ignore">Ignore clients who have already received this pack code?</label>
													<div class="form-check">
														<input class="form-check-input" type="radio" value="1" <?php if($_POST['custpack_already_sent_ignore']=="1"){  echo "checked='checked'";  } ?> name="custpack_already_sent_ignore"><label class="form-check-label">Yes</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="radio" value="2" <?php if($_POST['custpack_already_sent_ignore']=="2"){  echo "checked='checked'";  } ?> name="custpack_already_sent_ignore"><label class="form-check-label">No</label>
													</div>
												</div>

											</div>
				 

				                          </div>
				                          <!-- /.card-body -->
				                        </div>
				                        <!-- /.card -->
				                    </div>

		                        </div>
		                      </div>
		                      <!-- /.card-body -->



		                      <div class="card-footer">
		                        <button type="button" class="btn btn-primary filter-btn filter-btn-navigation" value="2">Filter</button>
		                        <button type="button" class="btn btn-danger filter-btn filter-reset-list-generator">Reset</button>
		                      </div>
	                    

	                        </div>
	                    </div>
	                </div>


	                <div id="accordiancard_3" class="card card-warning card-outline">
	                    <a class="d-block w-100" data-toggle="collapse" href="#collapsereviewtotal">
	                        <div class="card-header">
	                            <h4 class="card-title w-100">
	                                Step 3 - Review Total
	                            </h4>
	                        </div>
	                    </a>
	                    <div id="collapsereviewtotal" class="collapse" data-parent="#accordion">
	                        <div class="card-body">
	                            
	                    

		                      <div class="card-body">
		                        <div class="row">
		                          <div class="col-sm-6">
		                            <div class="form-group">
		                              <label for="filterField1">Total Customers Found: <?php echo $response_data->total_customers_found;?></label>
		                            </div>
		                          </div>
		                        </div>
		                      </div>
		                      <!-- /.card-body -->

		                      <div class="card-footer">
		                        <button type="button" class="btn btn-primary filter-btn filter-btn-navigation" value="3">Proceed</button>
		                      </div>
	                    

	                        </div>
	                    </div>
	                </div>


	                <div id="accordiancard_4" class="card card-warning card-outline">
	                    <a class="d-block w-100" data-toggle="collapse" href="#collapseaddtoclient">
	                        <div class="card-header">
	                            <h4 class="card-title w-100">
	                                Step 4 - Write To Client File
	                            </h4>
	                        </div>
	                    </a>
	                    <div id="collapseaddtoclient" class="collapse" data-parent="#accordion">
	                        <div class="card-body">
	                            
	                    

		                      <div class="card-body">
				                            
								<div class="row">
									<div class="form-group col-lg-6">
										<label for="customers_add_to_custpack">Add Pack Details To Customer?</label>
										<div class="form-check">
											<input class="form-check-input" type="radio" value="1" name="customers_add_to_custpack"><label class="form-check-label">Yes</label>
										</div>
										<div class="form-check">
											<input class="form-check-input" type="radio" value="2" name="customers_add_to_custpack" checked="checked"><label class="form-check-label">No</label>
										</div>
									</div>

								</div>
		                      </div>
		                      <!-- /.card-body -->

		                      <div class="card-footer">
		                        <button type="button" class="btn btn-primary filter-btn filter-btn-navigation" value="4">Continue</button>
		                      </div>
	                    

	                        </div>
	                    </div>
	                </div>


	                <div id="accordiancard_5" class="card card-warning card-outline">
	                    <a class="d-block w-100" data-toggle="collapse" href="#collapseexportdata">
	                        <div class="card-header">
	                            <h4 class="card-title w-100">
	                                Step 5 - What To Do With List
	                            </h4>
	                        </div>
	                    </a>
	                    <div id="collapseexportdata" class="collapse" data-parent="#accordion">

		                      <div class="card-footer">
		                      	<?php 
		                      	if(trim($response_data->report_wine_ref)!="")
		                      	{
		                      	?>
			                        <a target="_blank" href="process/report_wine_export_excel.php?report_wine_ref=<?php echo $response_data->report_wine_ref;?>" class="btn btn-primary filter-btn filter-btn-export" value="excel">Excel</a>
			                        <label> &nbsp;  &nbsp;  &nbsp; </label>
			                        <a target="_blank" href="process/report_wine_export_phone.php?report_wine_ref=<?php echo $response_data->report_wine_ref;?>" class="btn btn-primary filter-btn filter-btn-export" value="phoneList">Phone List</a>
			                        <label> &nbsp;  &nbsp;  &nbsp; </label>
			                        <button type="button" class="btn btn-primary filter-btn filter-btn-export" value="australiaPostLabel">Australia Post Label</button>
		                        <?php
			                    }
			                    ?>
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
  custom_js_nav_bar_selection("report_wine");
  custom_js_show_accordian_level("<?php echo $SHOW_LEVEL; ?>");
  custom_js_show_accordian_hierarchy("<?php echo $SHOW_LEVEL; ?>",5);
  custom_js_number_field_check();
  custom_js_datepicker_activate();
  // custom_js_navigation_report_wine();
  // custom_js_reset_filter_report_wine();
  // custom_js_open_all_filter_report_wine();
  // custom_js_show_accordian_hierarchy_hide("<?php echo $SHOW_LEVEL; ?>",5);
  
  //custom_js_pagination_sync("<?php echo $PAGE; ?>");
  //custom_js_show_filter("<?php echo $SHOW_FILTER; ?>");
  //custom_js_submit_filter();    
</script>