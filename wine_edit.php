<?php

include_once('custom/globals.php');

?>

<?php

include_once('fetch/wine_fetch_detail.php');

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
            <h1>Wine</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="wine.php">Wine List</a></li>
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
                    <a class="nav-link" href="wine_view.php?ref=<?php echo $wine_ref;?>" role="tab">View</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link nav-link-active" href="wine_edit.php?ref=<?php echo $wine_ref;?>" role="tab">Edit</a>
                  </li>
                  <?php

                    $data_table_winestyle = $response_data->winestyle_topmenu;

                    for($ij=0; $ij<count($data_table_winestyle); $ij++)
                    {
                      $data_row_winestyle = (array) $data_table_winestyle[$ij];
                      extract($data_row_winestyle);

                      $classSelection = "";
                      if($winestyle_ref==$wine_winestyle_ref)
                      {
                        $classSelection .= "nav-link-active";
                      }

                      ?>
                      <li class="nav-item">
                        <a class="nav-link <?php echo $classSelection;?>" href="wine_aroma_mapping.php?ref=<?php echo $wine_ref;?>&winestyle_ref=<?php echo $winestyle_ref;?>" role="tab"><?php echo $winestyle_name;?></a>
                      </li>
                      <?php
                    }

                  ?>
                </ul>
              </div>
              <!-- /.card -->
            </div>
            <!-- /.card -->
          </div>


          <div class="col-md-12">

            <form action="process/wine_process.php" method="post" >
              <!-- general form elements -->
              <div class="card card-primary">
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="wine_branch_ref">Branch</label>
                        <select class="custom-select form-control-border" name="wine_branch_ref" id="wine_branch_ref">
                          <option value="" <?php if($wine_branch_ref==""){echo 'selected="selected"';}?> >-- SELECT --</option>
                          <?php

                            $data_table_branch = $response_data->branch;

                            for($ij=0; $ij<count($data_table_branch); $ij++)
                            {
                              $data_row_branch = (array) $data_table_branch[$ij];
                              extract($data_row_branch);

                              $option = "<option value='".$branch_ref."'";
                              if($branch_ref==$wine_branch_ref)
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
                        <label for="wine_name">Name</label>
                        <input type="text" class="form-control form-control-border" name="wine_name" id="wine_name" placeholder="Name" autocomplete="off" value="<?php echo $wine_name;?>">
                      </div>
                      <div class="form-group">
                        <label for="wine_code">Code</label>
                        <input type="text" class="form-control form-control-border" name="wine_code" id="wine_code" placeholder="Code" autocomplete="off" value="<?php echo $wine_code;?>">
                      </div>
                      <div class="form-group">
                        <label for="wine_winery_ref">Winery</label>
                        <select class="custom-select form-control-border" name="wine_winery_ref" id="wine_winery_ref">
                          <option value="" <?php if($wine_winery_ref==""){echo 'selected="selected"';}?> >-- SELECT --</option>
                          <?php

                            $data_table_winery = $response_data->winery;

                            for($ij=0; $ij<count($data_table_winery); $ij++)
                            {
                              $data_row_winery = (array) $data_table_winery[$ij];
                              extract($data_row_winery);

                              $option = "<option value='".$winery_ref."'";
                              if($winery_ref==$wine_winery_ref)
                              {
                                $option .= "selected='selected'";
                              }
                              $option .= ">";
                              $option .= $winery_name;
                              $option .= "</option>";

                              echo $option;
                            }

                          ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="wine_country_ref">Country</label>
                        <select class="custom-select form-control-border" name="wine_country_ref" id="wine_country_ref" onchange="js_wine_edit_country_change()">
                          <option value="" <?php if($wine_country_ref==""){echo 'selected="selected"';}?> >-- SELECT --</option>
                          <?php

                            $data_table_country = $response_data->country;

                            for($ij=0; $ij<count($data_table_country); $ij++)
                            {
                              $data_row_country = (array) $data_table_country[$ij];
                              extract($data_row_country);

                              $option = "<option value='".$country_ref."'";
                              if($country_ref==$wine_country_ref)
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
                        <label for="wine_region_ref">Region</label>
                        <select class="custom-select form-control-border" name="wine_region_ref" id="wine_region_ref">
                          <option value="">-- SELECT --</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="wine_vintage">Vintage</label>
                        <select class="custom-select form-control-border" name="wine_vintage" id="wine_vintage">
                          <option value="" <?php if($wine_vintage==""){echo 'selected="selected"';}?> >-- SELECT --</option>
                          <?php

                            for($ij=1980; $ij<=date("Y"); $ij++)
                            {
                              $option = "<option value='".$ij."'";
                              if($ij==$wine_vintage)
                              {
                                $option .= "selected='selected'";
                              }
                              $option .= ">";
                              $option .= $ij;
                              $option .= "</option>";

                              echo $option;
                            }

                          ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="wine_winestyle_ref">Style</label>
                        <select class="custom-select form-control-border" name="wine_winestyle_ref" id="wine_winestyle_ref">
                          <option value="" <?php if($wine_winestyle_ref==""){echo 'selected="selected"';}?> >-- SELECT --</option>
                          <?php

                            $data_table_winestyle = $response_data->winestyle;

                            for($ij=0; $ij<count($data_table_winestyle); $ij++)
                            {
                              $data_row_winestyle = (array) $data_table_winestyle[$ij];
                              extract($data_row_winestyle);

                              $option = "<option value='".$winestyle_ref."'";
                              if($winestyle_ref==$wine_winestyle_ref)
                              {
                                $option .= "selected='selected'";
                              }
                              $option .= ">";
                              $option .= $winestyle_name;
                              $option .= "</option>";

                              echo $option;
                            }

                          ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="wine_alchol_per">% Alchol</label>
                        <input type="text" class="form-control form-control-border" name="wine_alchol_per" id="wine_alchol_per" placeholder="% Alchol" autocomplete="off" value="<?php echo $wine_alchol_per;?>">
                      </div>
                      <div class="form-group">
                        <label for="wine_ph_level">pH Level</label>
                        <input type="text" class="form-control form-control-border" name="wine_ph_level" id="wine_ph_level" placeholder="pH Level" autocomplete="off" value="<?php echo $wine_ph_level;?>">
                      </div>
                      <div class="form-group">
                        <label for="wine_sugar_per">% Sugar</label>
                        <input type="text" class="form-control form-control-border" name="wine_sugar_per" id="wine_sugar_per" placeholder="% Sugar" autocomplete="off" value="<?php echo $wine_sugar_per;?>">
                      </div>
                      <div class="form-group">
                        <label for="wine_price_point">Price Point</label>
                        <input type="text" class="form-control form-control-border" name="wine_price_point" id="wine_price_point" placeholder="Price Point" autocomplete="off" value="<?php echo $wine_price_point;?>">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="wine_status_id">Status</label>
                        <select class="custom-select form-control-border" name="wine_status_id" id="wine_status_id">
                          <option value="1" <?php if($wine_status_id=="1"){echo 'selected="selected"';}?> >Active</option>
                          <option value="2" <?php if($wine_status_id=="2"){echo 'selected="selected"';}?> >Inactive</option>
                          <option value="3" <?php if($wine_status_id=="3"){echo 'selected="selected"';}?> >Deleted</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="wine_ref">Reference</label>
                        <input type="text" class="form-control form-control-border" name="wine_ref" id="wine_ref" placeholder="Reference" readonly="readonly" value="<?php if($_REQUEST['clone']!="true"){ echo $wine_ref; }?>">
                      </div>
                      <div class="form-group">
                        <label for="wine_blend">Blend</label>
                        <select class="custom-select form-control-border" name="wine_blend" id="wine_blend">
                          <option value="1" <?php if($wine_blend=="1"){echo 'selected="selected"';}?> >Yes</option>
                          <option value="2" <?php if($wine_blend!="1"){echo 'selected="selected"';}?> >No</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="wine_varietal">Varietal</label>
                          <?php

                          	$data_table_winevarientalmap = $response_data->winevarientalmap;
                          	$data_row_winevarientalmap = (array) $data_table_winevarientalmap;

                            $data_table_varietal = $response_data->varietal;

                            for($ij=0; $ij<count($data_table_varietal); $ij++)
                            {
                              $data_row_varietal = (array) $data_table_varietal[$ij];
                              extract($data_row_varietal);

                              $checkBox = "<div class='form-check'>";
                              $checkBox .= "<input class='form-check-input' type='checkbox' name='wine_varietal[]' ";
                              $checkBox .= " value='".$varietal_ref."' ";
                              if (in_array($varietal_ref, $data_row_winevarientalmap)) 
                              {
								                $checkBox .= " checked='checked' ";
							                }
                              $checkBox .= ">";
                              $checkBox .= "<label class='form-check-label'>";
                              $checkBox .= $varietal_name;
                              $checkBox .= "</label>";
                              $checkBox .= "</div>";

                              echo $checkBox;
                            }

                          ?>

                      </div>

                    </div>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
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
  custom_js_nav_bar_selection("wine");
  function js_wine_edit_country_change()
  {
    FieldID = "wine_region_ref";
    CountryRef = $("#wine_country_ref").val();
    OptionToSelect = "<?php echo $wine_region_ref; ?>";
    custom_js_country_region_dropdown(FieldID,CountryRef,OptionToSelect);
  }
  js_wine_edit_country_change();
  custom_js_cust_nav_bar_selection("nav-link-active");
</script>