<?php

include_once('custom/globals.php');

?>

<?php

//include_once('fetch/list_generator_query_generator.php');

$SHOW_LEVEL = 1;

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
            <h1 class="m-0">WineQ Inventory Analysis</h1>
          </div><!-- /.col -->

          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo HTTP_SERVER; ?>">Home</a></li>
              <li class="breadcrumb-item active">WineQ Inventory Analysis</li>
            </ol>
          </div><!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


	<form id="filter-form" method="post" class="col-12">
	    <!-- Main content -->
	    <section class="content">
	        <div class="row">
	            <div class="col-12" id="accordion">


					<input type="text" name="show_level" class="form-control form_search_input_text hide" id="show_level" placeholder="Level" value="<?php echo $SHOW_LEVEL; ?>">
		                              

					<div id="accordiancard_1" class="card card-warning card-outline">
						<a class="d-block w-100" data-toggle="collapse" href="#collapsezipcode">
							<div class="card-header">
								<h4 class="card-title w-100">
									Step 1 - Enter Zip Code
								</h4>
							</div>
						</a>
						<div id="collapsezipcode" class="collapse" data-parent="#accordion">
							<div class="card-body">
								
						

							<div class="card-body">
								<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
									<label for="filterField1">Zip Code</label>
									<input type="text" class="form-control" id="wineq_zipcode" name="wineq_zipcode" placeholder="Enter Zip Code" value="" />
									</div>
								</div>
								</div>
							</div>
							<!-- /.card-body -->

							<div class="card-footer">
								<button type="button" class="btn btn-primary filter-btn filter-btn-navigation" value="2">Next</button>
							</div>
							

							</div>
						</div>
					</div>


					<div id="accordiancard_2" class="card card-warning card-outline">
						<a class="d-block w-100" data-toggle="collapse" href="#collapseinvent_p_code">
							<div class="card-header">
								<h4 class="card-title w-100">
									Step 2 - Enter Inventory Profile Number
								</h4>
							</div>
						</a>
						<div id="collapseinvent_p_code" class="collapse" data-parent="#accordion">
							<div class="card-body">
								
						

							<div class="card-body">
								<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
									<label for="filterField1">Inventory Profile Number</label>
									<input type="text" class="form-control" id="wineq_inventory_p_no" name="wineq_inventory_p_no" placeholder="Enter Inventory Profile Number" value="" />
									</div>
								</div>
								</div>
							</div>
							<!-- /.card-body -->

							<div class="card-footer">
								<button type="button" class="btn btn-warning filter-btn filter-btn-navigation" value="1">Back</button>
								<button type="button" class="btn btn-primary filter-btn filter-btn-navigation" value="3">Next</button>
							</div>
							

							</div>
						</div>
					</div>


	                <div id="accordiancard_3" class="card card-warning card-outline">
	                    <a class="d-block w-100" data-toggle="collapse" href="#collapsefilter">
	                        <div class="card-header">
	                            <h4 class="card-title w-100">
	                                Step 3 - Filters
	                            </h4>
	                        </div>
	                    </a>
	                    <div id="collapsefilter" class="collapse" data-parent="#accordion">
	                        <div class="card-body">
	                            
	                    

		                      <div class="card-body">
		                        <div class="row">

		                        	<div class="col-sm-6">
				                        <div class="card card-primary filter-sub-section">

				                          <div class="card-header">
				                            <h3 class="card-title">Select Wine Category</h3>

				                            <div class="card-tools">
				                              <button type="button" class="btn btn-tool data_collapse_btn_common" data-card-widget="collapse"><i class="fas fa-minus"></i>
				                            </div>
				                            <!-- /.card-tools -->
				                          </div>
				                          <!-- /.card-header -->
				                          <div class="card-body">
				                            
				                            
											<div class="form-group">
												<label for="customers_age">Categories</label>
												<div class="row">
													<div class="col-6">
														<input type="text" class="form-control form-control-border form-control-text-min" name="customers_age_start" id="customers_age_start" placeholder="Start Range" autocomplete="off">
													</div>
													<div class="col-6">
														<input type="text" class="form-control form-control-border form-control-text-min" name="customers_age_end" id="customers_age_end" placeholder="End Range" autocomplete="off">
													</div>
												</div>
											</div>
				                            
											<div class="row">
												<div class="form-group col-lg-6">
													<label for="customers_red_wine">Red Wine</label>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" value="Cabernet Sauvignon" name="customers_red_wine[]"><label class="form-check-label">
															Cabernet Sauvignon
														</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" value="Merlot" name="customers_red_wine[]"><label class="form-check-label">
															Merlot
														</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" value="Zinfandel" name="customers_red_wine[]"><label class="form-check-label">
															Zinfandel
														</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" value="Syrah/Shiraz" name="customers_red_wine[]"><label class="form-check-label">
															Syrah/Shiraz
														</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" value="Malbec" name="customers_red_wine[]"><label class="form-check-label">
															Malbec
														</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" value="Pinot Noir" name="customers_red_wine[]"><label class="form-check-label">
															Pinot Noir
														</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" value="Sangiovese" name="customers_red_wine[]"><label class="form-check-label">
															Sangiovese
														</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" value="Nebbiolo" name="customers_red_wine[]"><label class="form-check-label">
															Nebbiolo
														</label>
													</div>
												</div>

												
												<div class="form-group col-lg-6">
													<label for="customers_white_wine">White Wine</label>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" value="Chardonnay" name="customers_white_wine[]"><label class="form-check-label">
															Chardonnay
														</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" value="Pinot Gris" name="customers_white_wine[]"><label class="form-check-label">
															Pinot Gris
														</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" value="Sauvignon blanc" name="customers_white_wine[]"><label class="form-check-label">
															Sauvignon blanc
														</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" value="Riesling" name="customers_white_wine[]"><label class="form-check-label">
															Riesling
														</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" value="White Zinfandel" name="customers_white_wine[]"><label class="form-check-label">
															White Zinfandel
														</label>
													</div>
												</div>

																								
												<div class="form-group col-lg-6">
													<label for="customers_other_wine">Other</label>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" value="Rose" name="customers_other_wine[]"><label class="form-check-label">
															Rose
														</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" value="Sparkling" name="customers_other_wine[]"><label class="form-check-label">
															Sparkling
														</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" value="Dessert" name="customers_other_wine[]"><label class="form-check-label">
															Dessert
														</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" value="Fortified" name="customers_other_wine[]"><label class="form-check-label">
															Fortified
														</label>
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
								<button type="button" class="btn btn-warning filter-btn filter-btn-navigation" value="2">Back</button>
								<button type="button" class="btn btn-primary filter-btn filter-btn-navigation" value="4">Analyse</button>
							</div>
	                    

	                        </div>
	                    </div>
	                </div>


	                <div id="accordiancard_4" class="card card-warning card-outline">
	                    <a class="d-block w-100" data-toggle="collapse" href="#collapsereviewtotal">
	                        <div class="card-header">
	                            <h4 class="card-title w-100">
	                                Step 4 - Review Wine
	                            </h4>
	                        </div>
	                    </a>
	                    <div id="collapsereviewtotal" class="collapse" data-parent="#accordion">
	                        <div class="card-body">
							
						
								<div class="card">
									<!-- /.card-header -->
									<div class="card-body p-0">
										<table class="table table-striped">
											<thead>
											<tr>
												<th>Name</th>
												<th>Customer Status</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
											</thead>
											<tbody>
											<?php
											$DATA = array();
											$tempObj1->name = "Persona B - Bargain Hunter";
											$tempObj1->status_id = "40";
											$tempObj1->chart = "40";
											array_push($DATA,$tempObj1);
											
											$tempObj2->name = "Persona A - Just Turned Legal Drinkers";
											$tempObj2->status_id = "25";
											$tempObj2->chart = "12";
											array_push($DATA,$tempObj2);
											
											$tempObj3->name = "Persona C – The Explorer";
											$tempObj3->status_id = "15";
											$tempObj3->chart = "15";
											array_push($DATA,$tempObj3);
											
											$tempObj4->name = "Persona E – Wine Snobs";
											$tempObj4->status_id = "12";
											$tempObj4->chart = "25";
											array_push($DATA,$tempObj4);
											
											$tempObj5->name = "Persona D  - The Nervous Buyer";
											$tempObj5->status_id = "6";
											$tempObj5->chart = "6";
											array_push($DATA,$tempObj5);

											for($ijk=0; $ijk< count($DATA); $ijk++)
											{
												$DATA_SINGLE = $DATA[$ijk];
											?>

												<tr>
												<td><?php echo $DATA_SINGLE->name ; ?></td>
												<td><?php echo $DATA_SINGLE->status_id ; ?>% of customers</td>
												<td>
													<?php 
													$chart = $DATA_SINGLE->chart; 
													$class = "bg-info";

													if($chart<15)
													{
														$class = "bg-danger";
														
													}
													else if($chart<=35)
													{
														$class = "bg-warning";
														
													}
													else
													{
														$class = "bg-success";
														
													}

													?>
													<div class="progress progress-xs">
														<div class="progress-bar <?php echo $class ;?>" style="width: <?php echo $DATA_SINGLE->chart ; ?>%"></div>
													</div>
												</td>
												<td>
													<div class="btn-group">
													<button type="button" class="btn btn-success filter-btn filter-btn-navigation" value="5">View Wine Suggestions</button>
													</div>
												</td>
												</tr>

											<?php
											}
											?>
											</tbody>
										</table>
									</div>
									<!-- /.card-body -->

									
								</div>
							</div>

							<div class="card-footer">
								<button type="button" class="btn btn-warning filter-btn filter-btn-navigation" value="3">Back</button>
							</div>


	                    </div>

	                </div>


	                <div id="accordiancard_5" class="card card-warning card-outline">
	                    <a class="d-block w-100" data-toggle="collapse" href="#collapseaddtoclient">
	                        <div class="card-header">
	                            <h4 class="card-title w-100">
									Suggestions 
	                            </h4>
	                        </div>
	                    </a>
	                    <div id="collapseaddtoclient" class="collapse" data-parent="#accordion">
	                        <div class="card-body">
							
						
								<div class="card">
									<!-- /.card-header -->
									<div class="card-body p-0">
										<table class="table table-striped">
											<thead>
											<tr>
												<th>Name</th>
												<th>Vintage</th>
												<th>Varietal</th>
												<th>Winery</th>
												<th>Distributor</th>
												<th>Cost</th>
												<th>RRP</th>
												<th>Margin</th>
												<th>Action</th>
											</tr>
											</thead>
											<tbody>
											<?php
											$DATA = array();
											$tempObj1->name = "Upper Sky";
											$tempObj1->vintage = "2018";
											$tempObj1->varietal = "Pinot Noir";
											$tempObj1->winery = "Bosman";
											$tempObj1->distributor = "Southern Glazer's";
											$tempObj1->cost = "$9.00";
											$tempObj1->rrp = "$14.75";
											$tempObj1->margin = "64%";
											array_push($DATA,$tempObj1);
											
											$tempObj2->name = "Kroon";
											$tempObj2->vintage = "2018";
											$tempObj2->varietal = "Pinot Noir";
											$tempObj2->winery = "De Grendel";
											$tempObj2->distributor = "Southern Glazer's";
											$tempObj2->cost = "$9.50";
											$tempObj2->rrp = "$15.20";
											$tempObj2->margin = "60%";
											array_push($DATA,$tempObj2);
											
											$tempObj3->name = "Old mountain";
											$tempObj3->vintage = "2020";
											$tempObj3->varietal = "Pinot Noir";
											$tempObj3->winery = "Iona";
											$tempObj3->distributor = "Southern Glazer's";
											$tempObj3->cost = "$8.75";
											$tempObj3->rrp = "$13.90";
											$tempObj3->margin = "59%";
											array_push($DATA,$tempObj3);
											
											$tempObj4->name = "Camino";
											$tempObj4->vintage = "2019";
											$tempObj4->varietal = "Pinot Noir";
											$tempObj4->winery = "Bad River";
											$tempObj4->distributor = "Southern Glazer's";
											$tempObj4->cost = "$10.00";
											$tempObj4->rrp = "$15.00";
											$tempObj4->margin = "50%";
											array_push($DATA,$tempObj4);
											
											$tempObj5->name = "Jayne's";
											$tempObj5->vintage = "2019";
											$tempObj5->varietal = "Pinot Noir";
											$tempObj5->winery = "Paul Smith";
											$tempObj5->distributor = "Southern Glazer's";
											$tempObj5->cost = "$9.80";
											$tempObj5->rrp = "$14.00";
											$tempObj5->margin = "43%";
											array_push($DATA,$tempObj5);
											
											$tempObj6->name = "Village";
											$tempObj6->vintage = "2019";
											$tempObj6->varietal = "Pinot Noir";
											$tempObj6->winery = "Mount Blue";
											$tempObj6->distributor = "Southern Glazer's";
											$tempObj6->cost = "$10.10";
											$tempObj6->rrp = "$14.20";
											$tempObj6->margin = "41%";
											array_push($DATA,$tempObj6);
											
											$tempObj7->name = "Sandstone SOIL";
											$tempObj7->vintage = "2020";
											$tempObj7->varietal = "Pinot Noir";
											$tempObj7->winery = "Rocky Outcrop";
											$tempObj7->distributor = "Southern Glazer's";
											$tempObj7->cost = "$10.20";
											$tempObj7->rrp = "$13.00";
											$tempObj7->margin = "27%";
											array_push($DATA,$tempObj7);

											for($ijk=0; $ijk< count($DATA); $ijk++)
											{
												$DATA_SINGLE = $DATA[$ijk];
											?>

												<tr>
												<td><?php echo $DATA_SINGLE->name ; ?></td>
												<td><?php echo $DATA_SINGLE->vintage ; ?></td>
												<td><?php echo $DATA_SINGLE->varietal ; ?></td>
												<td><?php echo $DATA_SINGLE->winery ; ?></td>
												<td><?php echo $DATA_SINGLE->distributor ; ?></td>
												<td><?php echo $DATA_SINGLE->cost ; ?></td>
												<td><?php echo $DATA_SINGLE->rrp ; ?></td>
												<td><?php echo $DATA_SINGLE->margin ; ?></td>
												<td>
													<div class="btn-group">
													<a type="button" class="btn btn-sm btn-success">Add to Cart</a> 
													</div>
												</td>
												</tr>

											<?php
											}
											?>
											</tbody>
										</table>
									</div>
									<!-- /.card-body -->

									
								</div>
							</div>

							<div class="card-footer">
								<button type="button" class="btn btn-warning filter-btn filter-btn-navigation" value="4">Back</button>
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
  custom_js_nav_bar_selection("wineq");
  //custom_js_show_accordian_level("<?php echo $SHOW_LEVEL; ?>");
  //custom_js_show_accordian_hierarchy("<?php echo $SHOW_LEVEL; ?>",5);
  // custom_js_number_field_check();
  // custom_js_datepicker_activate();
  // custom_js_navigation_list_generator();
  // custom_js_reset_filter_list_generator();
  // custom_js_open_all_filter_list_generator();
  //custom_js_show_accordian_hierarchy_hide("<?php echo $SHOW_LEVEL; ?>",5);
  //custom_js_pagination_sync("<?php echo $PAGE; ?>");
  //custom_js_show_filter("<?php echo $SHOW_FILTER; ?>");
  //custom_js_submit_filter();    

  function js_wineq_navigation(sectionToMove)
  {

	for(i=1; i<=5; i++){
	$("#accordiancard_"+i).removeClass("card-success").addClass("card-danger");
	}

	for(i=sectionToMove; i<=5; i++){
	$("#accordiancard_"+i).addClass("hide");
	}

	for(i=1; i<=sectionToMove; i++){
	$("#accordiancard_"+i).removeClass("hide");
	}


	$("#accordiancard_"+sectionToMove).removeClass("card-danger").addClass("card-success");
	$("#accordiancard_"+sectionToMove+" .d-block").click();
  }

  $(".filter-btn-navigation").click(function(){
	  var sectionToMove = $(this).val();
	  
	  js_wineq_navigation(sectionToMove);
  });
  js_wineq_navigation(1);
</script>