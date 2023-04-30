<?php

include_once('custom/globals.php');

?>

<?php

include_once('fetch/winery_fetch_detail.php');

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
            <h1>Winery</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="winery.php">Winery List</a></li>
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

            <form method="post" >
              <!-- general form elements -->
              <div class="card card-primary">
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="winery_name">Name</label>
                        <input type="text" class="form-control form-control-border" name="winery_name" id="winery_name" placeholder="Name" autocomplete="off" value="<?php echo $winery_name;?>">
                      </div>
                      <div class="form-group">
                        <label for="winery_branch_ref">Branch</label>
                        <select class="custom-select form-control-border" name="winery_branch_ref" id="winery_branch_ref">
                          <option value="" <?php if($winery_branch_ref==""){echo 'selected="selected"';}?> >-- SELECT --</option>
                          <?php

                            $data_table_branch = $response_data->branch;

                            for($ij=0; $ij<count($data_table_branch); $ij++)
                            {
                              $data_row_branch = (array) $data_table_branch[$ij];
                              extract($data_row_branch);

                              $option = "<option value='".$branch_ref."'";
                              if($branch_ref==$winery_branch_ref)
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
                        <label for="winery_country_ref">Country</label>
                        <select class="custom-select form-control-border" name="winery_country_ref" id="winery_country_ref" onchange="js_winery_edit_country_change()">
                          <option value="" <?php if($winery_country_ref==""){echo 'selected="selected"';}?> >-- SELECT --</option>
                          <?php

                            $data_table_country = $response_data->country;

                            for($ij=0; $ij<count($data_table_country); $ij++)
                            {
                              $data_row_country = (array) $data_table_country[$ij];
                              extract($data_row_country);

                              $option = "<option value='".$country_ref."'";
                              if($country_ref==$winery_country_ref)
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
                        <label for="winery_region_ref">Region</label>
                        <select class="custom-select form-control-border" name="winery_region_ref" id="winery_region_ref">
                          <option value="">-- SELECT --</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="winery_status_id">Status</label>
                        <select class="custom-select form-control-border" name="winery_status_id" id="winery_status_id">
                          <option value="1" <?php if($winery_status_id=="1"){echo 'selected="selected"';}?> >Active</option>
                          <option value="2" <?php if($winery_status_id=="2"){echo 'selected="selected"';}?> >Inactive</option>
                          <option value="3" <?php if($winery_status_id=="3"){echo 'selected="selected"';}?> >Deleted</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="winery_ref">Reference</label>
                        <input type="text" class="form-control form-control-border" name="winery_ref" id="winery_ref" placeholder="Reference" readonly="readonly" value="<?php echo $winery_ref;?>">
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
  custom_js_nav_bar_selection("winery");
  function js_winery_edit_country_change()
  {
    FieldID = "winery_region_ref";
    CountryRef = $("#winery_country_ref").val();
    OptionToSelect = "<?php echo $winery_region_ref; ?>";
    custom_js_country_region_dropdown(FieldID,CountryRef,OptionToSelect);
  }
  js_winery_edit_country_change();
</script>