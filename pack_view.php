<?php

include_once('custom/globals.php');

?>

<?php

include_once('fetch/pack_fetch_detail.php');

?>

<?php

$data_table = $response_data->data;

for($ij=0; $ij<count($data_table); $ij++)
{
  $data_row = (array) $data_table[$ij];
  extract($data_row);
}

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
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pack</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="pack.php">Pack List</a></li>
              <li class="breadcrumb-item active">Details</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">

            <form action="process/pack_process.php" method="post" >
              <!-- general form elements -->
              <div class="card card-primary">
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="pack_name">Name</label>
                        <input type="text" class="form-control form-control-border" name="pack_name" id="pack_name" placeholder="Name" autocomplete="off" value="<?php echo $pack_name;?>">
                      </div>
                      <div class="form-group">
                        <label for="pack_code">Code</label>
                        <input type="text" class="form-control form-control-border" name="pack_code" id="pack_code" placeholder="Code" autocomplete="off" value="<?php echo $pack_code;?>">
                      </div>
                      <div class="form-group">
                        <label for="pack_wine_type">Wine Type</label>
                        <select class="custom-select form-control-border class-order-code-generator" name="pack_wine_type" id="pack_wine_type">
                          <option value="">-- SELECT --</option>
                          <option value="R" <?php if($pack_wine_type=="R"){echo 'selected="selected"';}?> >Red</option>
                          <option value="W" <?php if($pack_wine_type=="W"){echo 'selected="selected"';}?> >White</option>
                          <option value="M" <?php if($pack_wine_type=="M"){echo 'selected="selected"';}?> >Mixed</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="pack_order_code">Order Code</label>
                        <input type="text" class="form-control form-control-border" name="pack_order_code" id="pack_order_code" placeholder="Order Code" autocomplete="off" value="<?php echo $pack_order_code;?>" readonly="readonly">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="pack_status_id">Status</label>
                        <select class="custom-select form-control-border" name="pack_status_id" id="pack_status_id">
                          <option value="1" <?php if($pack_status_id=="1"){echo 'selected="selected"';}?> >Active</option>
                          <option value="2" <?php if($pack_status_id=="2"){echo 'selected="selected"';}?> >Inactive</option>
                          <option value="3" <?php if($pack_status_id=="3"){echo 'selected="selected"';}?> >Deleted</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="pack_ref">Reference</label>
                        <input type="text" class="form-control form-control-border" name="pack_ref" id="pack_ref" placeholder="Reference" readonly="readonly" value="<?php echo $pack_ref;?>">
                      </div>

                      <div class="form-group">
                        <label for="pack_order_month">Month</label>
                        <select class="custom-select form-control-border class-order-code-generator" name="pack_order_month" id="pack_order_month">
                          <option value="">-- SELECT --</option>
                          <?php
                            for($ij=1; $ij<=12; $ij++)
                            {
                              $month = $ij;
                              if($month < 10)
                              {
                                $month = "0".$month;
                              }

                              $option = "<option value='".$month."'";
                              if ($month == trim($pack_order_month)) 
                              {
                                $option .= " selected='selected' ";
                              }
                              $option .= ">";
                              $option .= $month;
                              $option .= "</option>";

                              echo $option;
                            }

                          ?>
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="pack_order_year">Year</label>
                        <select class="custom-select form-control-border class-order-code-generator" name="pack_order_year" id="pack_order_year">
                          <option value="">-- SELECT --</option>
                          <?php
                            for($ij=2021; $ij<=2050; $ij++)
                            {
                              $option = "<option value='".$ij."'";
                              if ($ij == trim($pack_order_year)) 
                              {
                                $option .= " selected='selected' ";
                              }
                              $option .= ">";
                              $option .= $ij;
                              $option .= "</option>";

                              echo $option;
                            }

                          ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">

                  <?php

                    $data_table_winepackmap = $response_data->winepackmap;
                    $data_row_winepackmap = (array) $data_table_winepackmap;

                    for($ijklm=1; $ijklm<=4; $ijklm++)
                    {

                  ?>

                      <div class="col-sm-6">
                        <div class="card card-primary">
                          <div class="card-header">
                            <h3 class="card-title">Wine <?php echo $ijklm; ?></h3>

                            <div class="card-tools">
                              <button type="button" class="btn btn-tool data_collapse_btn_common data_collapse_btn_<?php echo $ijklm; ?>" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </div>
                            <!-- /.card-tools -->
                          </div>
                          <!-- /.card-header -->
                          <div class="card-body">
                            
                            <div class="form-group">
                              <label for="wine_ref">Choose Wine</label>
                              <select class="custom-select form-control-border form_wine_ref" id="wine_ref_<?php echo $ijklm; ?>" name="wine_ref[]">
                                <option value="">-- SELECT --</option>
                                <?php

                                  $data_table_wine = $response_data->wine;

                                  for($ij=0; $ij<count($data_table_wine); $ij++)
                                  {
                                    $data_row_wine = (array) $data_table_wine[$ij];
                                    extract($data_row_wine);

                                    $option = "<option value='".$wine_ref."'";
                                    if ($wine_ref == trim($data_row_winepackmap[$ijklm])) 
                                    {
                                      $option .= " selected='selected' ";
                                    }
                                    $option .= ">";
                                    $option .= $wine_name;
                                    $option .= "</option>";

                                    echo $option;
                                  }

                                ?>
                              </select>
                            </div>



                            <div class="col-sm-12">
                              <div class="card card-success">
                                <div class="card-header" style="background-color: #343a40;">
                                  <h3 class="card-title">Filter</h3>

                                  <div class="card-tools">
                                    <button type="button" class="btn btn-tool data_collapse_btn_common_inner data_collapse_btn_inner_<?php echo $ijklm; ?>" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                  </div>
                                  <!-- /.card-tools -->
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">

                                  <div class="row">
                                    <div class="col-sm-6">
                                      <div class="form-group">
                                        <label for="wine_branch_ref">Branch</label>
                                        <select class="custom-select form-control-border" id="wine_branch_ref_<?php echo $ijklm; ?>">
                                          <option value="">-- SELECT --</option>
                                          <?php

                                            $data_table_branch = $response_data->branch;

                                            for($ij=0; $ij<count($data_table_branch); $ij++)
                                            {
                                              $data_row_branch = (array) $data_table_branch[$ij];
                                              extract($data_row_branch);

                                              $option = "<option value='".$branch_ref."'";
                                              $option .= ">";
                                              $option .= $branch_name. " [ ". $branch_code ." ]";
                                              $option .= "</option>";

                                              echo $option;
                                            }

                                          ?>
                                        </select>
                                      </div>
                                      <div class="form-group">
                                        <label for="wine_country_ref">Country</label>
                                        <select class="custom-select form-control-border" id="wine_country_ref_<?php echo $ijklm; ?>" onchange="js_wine_edit_country_change('<?php echo $ijklm; ?>')">
                                          <option value="">-- SELECT --</option>
                                          <?php

                                            $data_table_country = $response_data->country;

                                            for($ij=0; $ij<count($data_table_country); $ij++)
                                            {
                                              $data_row_country = (array) $data_table_country[$ij];
                                              extract($data_row_country);

                                              $option = "<option value='".$country_ref."'";
                                              $option .= ">";
                                              $option .= $country_name;
                                              $option .= "</option>";

                                              echo $option;
                                            }

                                          ?>
                                        </select>
                                      </div>
                                      <div class="form-group">
                                        <label for="wine_region_ref">Region</label>
                                        <select class="custom-select form-control-border" id="wine_region_ref_<?php echo $ijklm; ?>">
                                          <option value="">-- SELECT --</option>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="col-sm-6">
                                      <div class="form-group">
                                        <label for="wine_winery_ref">Winery</label>
                                        <select class="custom-select form-control-border" id="wine_winery_ref_<?php echo $ijklm; ?>">
                                          <option value="">-- SELECT --</option>
                                          <?php

                                            $data_table_winery = $response_data->winery;

                                            for($ij=0; $ij<count($data_table_winery); $ij++)
                                            {
                                              $data_row_winery = (array) $data_table_winery[$ij];
                                              extract($data_row_winery);

                                              $option = "<option value='".$winery_ref."'";
                                              $option .= ">";
                                              $option .= $winery_name;
                                              $option .= "</option>";

                                              echo $option;
                                            }

                                          ?>
                                        </select>
                                      </div>
                                      <div class="form-group">
                                        <label for="wine_vintage">Vintage</label>
                                        <select class="custom-select form-control-border" id="wine_vintage_<?php echo $ijklm; ?>">
                                          <option value="">-- SELECT --</option>
                                          <?php

                                            for($ij=1980; $ij<=date("Y"); $ij++)
                                            {
                                              $option = "<option value='".$ij."'";
                                              $option .= ">";
                                              $option .= $ij;
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
                                  <button type="button" class="btn btn-primary" onclick="js_pack_edit_wine_search('<?php echo $ijklm; ?>')">Search</button>
                                </div>
                              </div>
                              <!-- /.card -->
                            </div>
 

                          </div>
                          <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                      </div>


                  <?php
                    }
                  ?> 

                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                </div>
              </div>
              <!-- /.card -->
            </form>

          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

<?php
/* BOTTOM TEMPLATE START */
include_once("layout/aside-right.php");
include_once("layout/footer.php");
include_once("layout/bottom-footer.php");
/* BOTTOM TEMPLATE END */
?>

<script type="text/javascript">
  custom_js_nav_bar_selection("pack");
  function js_wine_edit_country_change(choice)
  {
    FieldID = "wine_region_ref_"+choice;
    CountryRef = $("#wine_country_ref_"+choice).val();
    OptionToSelect = "";
    custom_js_country_region_dropdown(FieldID,CountryRef,OptionToSelect);
  }
  for(var i=1; i<=12; i++)
  {
    js_wine_edit_country_change(i);
  }
  function js_pack_edit_wine_search(choice)
  {
    FieldID = "wine_ref_"+choice;
    BranchRef = $("#wine_branch_ref_"+choice).val();
    CountryRef = $("#wine_country_ref_"+choice).val();
    RegionRef = $("#wine_region_ref_"+choice).val();
    WineryRef = $("#wine_winery_ref_"+choice).val();
    VintageRef = $("#wine_vintage_"+choice).val();
    OptionToSelect = "";
    custom_js_pack_edit_wine_search_dropdown(FieldID, BranchRef, CountryRef, RegionRef, WineryRef, VintageRef, OptionToSelect);
  }

  //$(".data_collapse_btn_common").click();
  $(".data_collapse_btn_common_inner").click();

  var counter=0;
  $(".form_wine_ref").each(function(){
    counter++;

    if($(this).val()=="")
    {
      $(".data_collapse_btn_"+counter).click();
    }
  });
  
</script>