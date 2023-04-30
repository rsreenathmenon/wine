<?php

include_once('custom/globals.php');

?>

<?php

include_once('fetch/customers_fetch_detail.php');

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
            <h1>Customers</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="customers.php">Customers List</a></li>
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

          <!-- Customer Menu -->
          <div class="col-md-12">
            <div class="card card-primary card-outline">
              <div class="card-body">
                <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link nav-link-active active" href="customers_view.php?ref=<?php echo $customers_ref;?>" role="tab">View</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" href="customers_edit.php?ref=<?php echo $customers_ref;?>" role="tab">Edit</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="custpack.php?cus=<?php echo $customers_ref;?>" role="tab">Pack</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="custpackfeedback.php?cus=<?php echo $customers_ref;?>" role="tab">Feedback</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="custpackmystery.php?cus=<?php echo $customers_ref;?>" role="tab">Mystery</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="custcourse.php?cus=<?php echo $customers_ref;?>" role="tab">Course</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="custcom.php?cus=<?php echo $customers_ref;?>" role="tab">Communication</a>
                  </li>
                </ul>
              </div>
              <!-- /.card -->
            </div>
            <!-- /.card -->
          </div>

          <div class="col-md-12">

            <form method="post" >
              <!-- general form elements -->
              <div class="card card-primary">
                <!-- /.card-header -->
                <div class="card-body">

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="customers_firstname">First Name</label>
                        <input type="text" class="form-control form-control-border" name="customers_firstname" id="customers_firstname" placeholder="First Name" autocomplete="off" value="<?php echo $customers_firstname;?>">
                      </div>
                      <div class="form-group">
                        <label for="customers_lastname">Last Name</label>
                        <input type="text" class="form-control form-control-border" name="customers_lastname" id="customers_lastname" placeholder="Last Name" autocomplete="off" value="<?php echo $customers_lastname;?>">
                      </div>
                      <div class="form-group">
                        <label for="customers_email">Email</label>
                        <input type="text" class="form-control form-control-border" name="customers_email" id="customers_email" placeholder="Email" autocomplete="off" value="<?php echo $customers_email;?>">
                      </div>
                      <div class="form-group">
                        <label for="customers_phone">Phone</label>
                        <input type="text" class="form-control form-control-border" name="customers_phone" id="customers_phone" placeholder="Phone" autocomplete="off" value="<?php echo $customers_phone;?>">
                      </div>
                      <div class="form-group">
                        <label for="customers_dob">DOB</label>
                        <input type="text" class="form-control form-control-border" name="customers_dob" id="customers_dob" placeholder="DOB" autocomplete="off" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask value="<?php echo $customers_dob;?>">
                      </div>
                      <div class="form-group">
                        <label for="customers_sex">Sex</label>
                        <select class="custom-select form-control-border" name="customers_sex" id="customers_sex">
                          <option value="0" <?php if($customers_sex=="0"){echo 'selected="selected"';}?> >-- SELECT --</option>
                          <option value="1" <?php if($customers_sex=="1"){echo 'selected="selected"';}?> >Male</option>
                          <option value="2" <?php if($customers_sex=="2"){echo 'selected="selected"';}?> >Female</option>
                          <option value="3" <?php if($customers_sex=="3"){echo 'selected="selected"';}?> >Other</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="customers_maritalstatus">Marital Status</label>
                        <select class="custom-select form-control-border" name="customers_maritalstatus" id="customers_maritalstatus">
                          <option value="0" <?php if($customers_maritalstatus=="0"){echo 'selected="selected"';}?> >-- SELECT --</option>
                          <option value="1" <?php if($customers_maritalstatus=="1"){echo 'selected="selected"';}?> >Single</option>
                          <option value="2" <?php if($customers_maritalstatus=="2"){echo 'selected="selected"';}?> >Married</option>
                          <option value="3" <?php if($customers_maritalstatus=="3"){echo 'selected="selected"';}?> >Widowed</option>
                          <option value="4" <?php if($customers_maritalstatus=="4"){echo 'selected="selected"';}?> >Divorced</option>
                          <option value="5" <?php if($customers_maritalstatus=="5"){echo 'selected="selected"';}?> >Seperated</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="customers_educationlevel">Education Level</label>
                        <select class="custom-select form-control-border" name="customers_educationlevel" id="customers_educationlevel">
                          <option value="0" <?php if($customers_educationlevel=="0"){echo 'selected="selected"';}?> >-- SELECT --</option>
                          <option value="1" <?php if($customers_educationlevel=="1"){echo 'selected="selected"';}?> >High School</option>
                          <option value="2" <?php if($customers_educationlevel=="2"){echo 'selected="selected"';}?> >Diploma / Certificate</option>
                          <option value="3" <?php if($customers_educationlevel=="3"){echo 'selected="selected"';}?> >Degree</option>
                          <option value="4" <?php if($customers_educationlevel=="4"){echo 'selected="selected"';}?> >Post Graduate</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="customers_source_ref">Source</label>
                        <select class="custom-select form-control-border" name="customers_source_ref" id="customers_source_ref">
                          <option value="" <?php if($customers_source_ref==""){echo 'selected="selected"';}?> >-- SELECT --</option>
                          <?php

                            $data_table_source = $response_data->source;

                            for($ij=0; $ij<count($data_table_source); $ij++)
                            {
                              $data_row_source = (array) $data_table_source[$ij];
                              extract($data_row_source);

                              $option = "<option value='".$source_ref."'";
                              if($source_ref==$customers_source_ref)
                              {
                                $option .= "selected='selected'";
                              }
                              $option .= ">";
                              $option .= $source_name;
                              $option .= "</option>";

                              echo $option;
                            }

                          ?>
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="customers_branch_ref">Branch</label>
                        <select class="custom-select form-control-border" name="customers_branch_ref" id="customers_branch_ref">
                          <option value="" <?php if($customers_branch_ref==""){echo 'selected="selected"';}?> >-- SELECT --</option>
                          <?php

                            $data_table_branch = $response_data->branch;

                            for($ij=0; $ij<count($data_table_branch); $ij++)
                            {
                              $data_row_branch = (array) $data_table_branch[$ij];
                              extract($data_row_branch);

                              $option = "<option value='".$branch_ref."'";
                              if($branch_ref==$customers_branch_ref)
                              {
                                $option .= "selected='selected'";
                              }
                              $option .= ">";
                              $option .= $branch_name. " [ ". $branch_code ." ]";
                              $option .= "</option>";

                              echo $option;
                            }

                          ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="customers_address1">Address 1</label>
                        <textarea class="form-control form-control-border" name="customers_address1" id="customers_address1" placeholder="Address 1"><?php echo $customers_address1;?></textarea>
                      </div>
                      <div class="form-group">
                        <label for="customers_address2">Address 2</label>
                        <textarea class="form-control form-control-border" name="customers_address2" id="customers_address2" placeholder="Address 1"><?php echo $customers_address2;?></textarea>
                      </div>
                      <div class="form-group">
                        <label for="customers_suburb">Suburb</label>
                        <input type="text" class="form-control form-control-border" name="customers_suburb" id="customers_suburb" placeholder="Suburb" autocomplete="off" value="<?php echo $customers_suburb;?>">
                      </div>
                      <!-- <div class="form-group">
                        <label for="customers_state">State</label>
                        <input type="text" class="form-control form-control-border" name="customers_state" id="customers_state" placeholder="Postcode" autocomplete="off" value="<?php echo $customers_state;?>">
                      </div> -->
                      <div class="form-group">
                        <label for="customers_states_ref">State</label>
                        <select class="custom-select form-control-border" name="customers_states_ref" id="customers_states_ref">
                          <option value="">-- SELECT --</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="customers_postcode">Postcode</label>
                        <input type="text" class="form-control form-control-border" name="customers_postcode" id="customers_postcode" placeholder="Postcode" autocomplete="off" value="<?php echo $customers_postcode;?>">
                      </div>
                      <div class="form-group">
                        <label for="customers_country_ref">Country</label>
                        <select class="custom-select form-control-border" name="customers_country_ref" id="customers_country_ref" onchange="js_customers_edit_country_change()">
                          <option value="" <?php if($customers_country_ref==""){echo 'selected="selected"';}?> >-- SELECT --</option>
                          <?php

                            $data_table_country = $response_data->country;

                            for($ij=0; $ij<count($data_table_country); $ij++)
                            {
                              $data_row_country = (array) $data_table_country[$ij];
                              extract($data_row_country);

                              $option = "<option value='".$country_ref."'";
                              if($country_ref==$customers_country_ref)
                              {
                                $option .= "selected='selected'";
                              }
                              $option .= ">";
                              $option .= $country_name;
                              $option .= "</option>";

                              echo $option;
                            }

                          ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="customers_product">Product</label>
                        <input type="text" class="form-control form-control-border" name="customers_product" id="customers_product" placeholder="Product" autocomplete="off" value="<?php echo $customers_product;?>">
                      </div>
                      <div class="form-group">
                        <label for="customers_company">Company</label>
                        <input type="text" class="form-control form-control-border" name="customers_company" id="customers_company" placeholder="Company" autocomplete="off" value="<?php echo $customers_company;?>">
                      </div>
                      <div class="form-group">
                        <label for="customers_sp_instruct">Delivery/special instruction</label>
                        <textarea class="form-control form-control-border" name="customers_sp_instruct" id="customers_sp_instruct" placeholder="Delivery/special instruction"><?php echo $customers_sp_instruct;?></textarea>
                      </div>
                      <div class="form-group">
                        <label for="customers_regtype">Registration</label>
                        <select class="custom-select form-control-border" name="customers_regtype" id="customers_regtype">
                          <option value="" <?php if($customers_regtype==""){echo 'selected="selected"';}?> >-- SELECT --</option>
                          <option value="Partial" <?php if($customers_regtype=="Partial"){echo 'selected="selected"';}?> >Partial</option>
                          <option value="Full" <?php if($customers_regtype=="Full"){echo 'selected="selected"';}?> >Full</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="customers_memlvl">Membership Level</label>
                        <select class="custom-select form-control-border" name="customers_memlvl" id="customers_memlvl">
                          <option value="" <?php if($customers_memlvl==""){echo 'selected="selected"';}?> >-- SELECT --</option>
                          <option value="Free" <?php if($customers_memlvl=="Free"){echo 'selected="selected"';}?> >Free</option>
                          <option value="Paid" <?php if($customers_memlvl=="Paid"){echo 'selected="selected"';}?> >Paid</option>
                          <option value="Expired" <?php if($customers_memlvl=="Expired"){echo 'selected="selected"';}?> >Expired</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="customers_status_id">Status</label>
                        <select class="custom-select form-control-border" name="customers_status_id" id="customers_status_id">
                          <option value="1" <?php if($customers_status_id=="1"){echo 'selected="selected"';}?> >Active</option>
                          <option value="2" <?php if($customers_status_id=="2"){echo 'selected="selected"';}?> >Inactive</option>
                          <option value="3" <?php if($customers_status_id=="3"){echo 'selected="selected"';}?> >Deleted</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="customers_created">Created On</label>
                        <input type="text" class="form-control form-control-border" name="customers_created" id="customers_created" placeholder="Created On" readonly="readonly" value="<?php echo $customers_created;?>">
                      </div>
                      <div class="form-group">
                        <label for="customers_ref">Reference</label>
                        <input type="text" class="form-control form-control-border" name="customers_ref" id="customers_ref" placeholder="Reference" readonly="readonly" value="<?php echo $customers_ref;?>">
                      </div>

                      <div class="form-group">
                        <label for="customers_moodle_ref">Moodle Ref</label>
                        <input type="text" class="form-control form-control-border" name="customers_moodle_ref" id="customers_moodle_ref" placeholder="Moodle Ref" readonly="readonly" autocomplete="off" value="<?php echo $customers_moodle_ref;?>">
                      </div>


                      <div class="form-group">
                        <label for="customers_over_18">Over 18</label>
                        <input type="text" class="form-control form-control-border" name="customers_over_18" id="customers_over_18" placeholder="Over 18" autocomplete="off" value="<?php echo $customers_over_18;?>">
                      </div>
                      <div class="form-group">
                        <label for="customers_confirm_give_feedback">Confirm Give Feedback</label>
                        <input type="text" class="form-control form-control-border" name="customers_confirm_give_feedback" id="customers_confirm_give_feedback" placeholder="Confirm Give Feedback" autocomplete="off" value="<?php echo $customers_confirm_give_feedback;?>">
                      </div>
                      <div class="form-group">
                        <label for="customers_fav_wine_1">Fav Wine 1</label>
                        <input type="text" class="form-control form-control-border" name="customers_fav_wine_1" id="customers_fav_wine_1" placeholder="Fav Wine 1" autocomplete="off" value="<?php echo $customers_fav_wine_1;?>">
                      </div>
                      <div class="form-group">
                        <label for="customers_fav_wine_2">Fav Wine 2</label>
                        <input type="text" class="form-control form-control-border" name="customers_fav_wine_2" id="customers_fav_wine_2" placeholder="Fav Wine 2" autocomplete="off" value="<?php echo $customers_fav_wine_2;?>">
                      </div>
                      <div class="form-group">
                        <label for="customers_least_fav_wine">Least Fav Wine</label>
                        <input type="text" class="form-control form-control-border" name="customers_least_fav_wine" id="customers_least_fav_wine" placeholder="Least Fav Wine" autocomplete="off" value="<?php echo $customers_least_fav_wine;?>">
                      </div>
                      <div class="form-group">
                        <label for="customers_avg_sp_per_bot_wine">Avg Spend Per Bottle Wine</label>
                        <input type="text" class="form-control form-control-border" name="customers_avg_sp_per_bot_wine" id="customers_avg_sp_per_bot_wine" placeholder="Avg Spend Per Bottle Wine" autocomplete="off" value="<?php echo $customers_avg_sp_per_bot_wine;?>">
                      </div>
                      <div class="form-group">
                        <label for="customers_fav_wine_region">Fav Wine Region</label>
                        <input type="text" class="form-control form-control-border" name="customers_fav_wine_region" id="customers_fav_wine_region" placeholder="Fav Wine Region" autocomplete="off" value="<?php echo $customers_fav_wine_region;?>">
                      </div>
                      <div class="form-group">
                        <label for="customers_normally_buy_wine">Normally Buy Wine</label>
                        <input type="text" class="form-control form-control-border" name="customers_normally_buy_wine" id="customers_normally_buy_wine" placeholder="Normally Buy Wine" autocomplete="off" value="<?php echo $customers_normally_buy_wine;?>">
                      </div>
                      <div class="form-group">
                        <label for="customers_member_wine_club">Member Wine Club</label>
                        <input type="text" class="form-control form-control-border" name="customers_member_wine_club" id="customers_member_wine_club" placeholder="Member Wine Club" autocomplete="off" value="<?php echo $customers_member_wine_club;?>">
                      </div>
                      <div class="form-group">
                        <label for="customers_last_winery_visit">Last Winery Visit</label>
                        <input type="text" class="form-control form-control-border" name="customers_last_winery_visit" id="customers_last_winery_visit" placeholder="Last Winery Visit" autocomplete="off" value="<?php echo $customers_last_winery_visit;?>">
                      </div>
                      <div class="form-group">
                        <label for="customers_occas_drink_before_wine">Occasionally Drink Before Wine</label>
                        <input type="text" class="form-control form-control-border" name="customers_occas_drink_before_wine" id="customers_occas_drink_before_wine" placeholder="Occasionally Drink Before Wine" autocomplete="off" value="<?php echo $customers_occas_drink_before_wine;?>">
                      </div>
                      <div class="form-group">
                        <label for="customers_glasses_a_week">Glasses A Week</label>
                        <input type="text" class="form-control form-control-border" name="customers_glasses_a_week" id="customers_glasses_a_week" placeholder="Occasionally Drink Before Wine" autocomplete="off" value="<?php echo $customers_glasses_a_week;?>">
                      </div>
                      <div class="form-group">
                        <label for="customers_ethnicity">Ethnicity</label>
                        <input type="text" class="form-control form-control-border" name="customers_ethnicity" id="customers_ethnicity" placeholder="Occasionally Drink Before Wine" autocomplete="off" value="<?php echo $customers_ethnicity;?>">
                      </div>
                      <div class="form-group">
                        <label for="customers_wine_varietal">Wine Varietal</label>
                        <input type="text" class="form-control form-control-border" name="customers_wine_varietal" id="customers_wine_varietal" placeholder="Occasionally Drink Before Wine" autocomplete="off" value="<?php echo $customers_wine_varietal;?>">
                      </div>
                      <div class="form-group">
                        <label for="customers_cohort">Cohort</label>
                        <input type="text" class="form-control form-control-border" name="customers_cohort" id="customers_cohort" placeholder="Cohort" autocomplete="off" value="<?php echo $customers_cohort;?>">
                      </div>
                      <div class="form-group">
                        <label for="customers_enrollment">Enrollment</label>
                        <input type="text" class="form-control form-control-border" name="customers_enrollment" id="customers_enrollment" placeholder="Enrollment" autocomplete="off" value="<?php echo $customers_enrollment;?>">
                      </div>
                      <div class="form-group">
                        <label for="customers_loyaltylvl">Loyalty Level</label>
                        <select class="custom-select form-control-border" name="customers_loyaltylvl" id="customers_loyaltylvl">
                          <option value="" <?php if($customers_loyaltylvl==""){echo 'selected="selected"';}?> >-- SELECT --</option>
                          <option value="Bronze" <?php if($customers_loyaltylvl=="Bronze"){echo 'selected="selected"';}?> >Bronze</option>
                          <option value="Silver" <?php if($customers_loyaltylvl=="Silver"){echo 'selected="selected"';}?> >Silver</option>
                          <option value="Gold" <?php if($customers_loyaltylvl=="Gold"){echo 'selected="selected"';}?> >Gold</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="customers_optout">Opt Out</label>
                        <select class="custom-select form-control-border" name="customers_optout" id="customers_optout">
                          <option value="" <?php if($customers_optout==""){echo 'selected="selected"';}?> >-- SELECT --</option>
                          <option value="Yes" <?php if($customers_optout=="Yes"){echo 'selected="selected"';}?> >Yes</option>
                          <option value="No" <?php if($customers_optout=="No"){echo 'selected="selected"';}?> >No</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="customers_classification">Classification</label>
                        <select class="custom-select form-control-border" name="customers_classification" id="customers_classification">
                          <option value="" <?php if($customers_classification==""){echo 'selected="selected"';}?> >-- SELECT --</option>
                          <option value="Standard" <?php if($customers_classification=="Standard"){echo 'selected="selected"';}?> >Standard</option>
                          <option value="VIP" <?php if($customers_classification=="VIP"){echo 'selected="selected"';}?> >VIP</option>
                          <option value="Media" <?php if($customers_classification=="Media"){echo 'selected="selected"';}?> >Media</option>
                          <option value="Other" <?php if($customers_classification=="Other"){echo 'selected="selected"';}?> >Other</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
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
  custom_js_nav_bar_selection("customers");
  function js_customers_edit_country_change()
  {
    FieldID = "customers_states_ref";
    CountryRef = $("#customers_country_ref").val();
    OptionToSelect = "<?php echo $customers_states_ref; ?>";
    custom_js_state_dropdown(FieldID,CountryRef,OptionToSelect);
  }
  js_customers_edit_country_change();
  custom_js_cust_nav_bar_selection("nav-link-active");
</script>