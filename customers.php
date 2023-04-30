<?php

include_once('custom/globals.php');

?>

<?php

include_once('fetch/customers_fetch_table.php');

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
            <h1 class="m-0">Customers</h1>
          </div><!-- /.col -->

          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo HTTP_SERVER; ?>">Home</a></li>
              <li class="breadcrumb-item active">Customers</li>
            </ol>
          </div><!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12" id="accordion">
                <div class="card card-warning card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseSix">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                Filters
                            </h4>
                        </div>
                    </a>
                    <div id="collapseSix" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            
                    <form id="filter-form" method="post">

                      <input type="text" name="p" class="form-control hide" id="pagination_page" placeholder="Pagination" value="1">
                      
                      <div class="card-body">
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="filterField1">Name</label>
                              <input type="text" name="customers_name" class="form-control form_search_input_text" id="customers_name" placeholder="Enter Name" value="<?php echo $_REQUEST['customers_name']; ?>">
                            </div>

                            <div class="form-group">
                              <label for="filterField1">Company</label>
                              <input type="text" name="customers_company" class="form-control form_search_input_text" id="customers_company" placeholder="Enter Company" value="<?php echo $_REQUEST['customers_company']; ?>">
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="filterField1">Cohort</label>
                              <input type="text" name="customers_cohort" class="form-control form_search_input_text" id="customers_cohort" placeholder="Enter Cohort" value="<?php echo $_REQUEST['customers_cohort']; ?>">
                            </div>

                            <div class="form-group">
                              <label for="customers_branch_ref">Branch</label>
                              <select class="custom-select form-control-border form_search_input_select" name="customers_branch_ref" id="customers_branch_ref">
                                <option value="" selected='selected' >-- SELECT --</option>
                                <?php

                                  $data_table_branch = $response_data->branch;

                                  for($ij=0; $ij<count($data_table_branch); $ij++)
                                  {
                                    $data_row_branch = (array) $data_table_branch[$ij];
                                    extract($data_row_branch);

                                    $option = "<option value='".$branch_ref."'";
                                    if($branch_ref==$_REQUEST['customers_branch_ref'])
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
                          </div>

                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="customers_source_ref">Date Range Start</label>

                              <div class="input-group date form-control-datepicker" id="customers_created_start" data-target-input="nearest">
                                  <input type="text" class="form-control form_search_input_text datetimepicker-input" data-target="#customers_created_start" name="customers_created_start" value="<?php echo $_POST['customers_created_start'];?>">
                                  <div class="input-group-append" data-target="#customers_created_start" data-toggle="datetimepicker">
                                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                  </div>
                              </div>
                            </div>
                          </div>

                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="customers_source_ref">Date Range End</label>

                              <div class="input-group date form-control-datepicker" id="customers_created_end" data-target-input="nearest">
                                  <input type="text" class="form-control form_search_input_text datetimepicker-input" data-target="#customers_created_end" name="customers_created_end" value="<?php echo $_POST['customers_created_end'];?>">
                                  <div class="input-group-append" data-target="#customers_created_end" data-toggle="datetimepicker">
                                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                  </div>
                              </div>
                            </div>
                          </div>

                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="customers_country_ref">Country</label>
                              <select class="custom-select form-control-border form_search_input_select" name="customers_country_ref" id="customers_country_ref">
                                <option value="" selected='selected' >-- SELECT --</option>
                                <?php

                                  $data_table_country = $response_data->country;

                                  for($ij=0; $ij<count($data_table_country); $ij++)
                                  {
                                    $data_row_country = (array) $data_table_country[$ij];
                                    extract($data_row_country);

                                    $option = "<option value='".$country_ref."'";
                                    if($country_ref==$_REQUEST['customers_country_ref'])
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
                          </div>

                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="customers_source_ref">Source</label>
                              <select class="custom-select form-control-border form_search_input_select" name="customers_source_ref" id="customers_source_ref">
                                <option value="" selected='selected' >-- SELECT --</option>
                                <?php

                                  $data_table_source = $response_data->source;

                                  for($ij=0; $ij<count($data_table_source); $ij++)
                                  {
                                    $data_row_source = (array) $data_table_source[$ij];
                                    extract($data_row_source);

                                    $option = "<option value='".$source_ref."'";
                                    if($source_ref==$_REQUEST['customers_source_ref'])
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
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="customers_status_id">Status</label>
                              <select class="custom-select form-control-border form_search_input_status" name="customers_status_id" id="customers_status_id">
                                <option value="" selected='selected' >-- SELECT --</option>
                                <?php


                                  for($ij=1; $ij<=3; $ij++)
                                  {
                                    switch ($ij) {
                                      case "1":
                                        $status_name = "Active";
                                        break;
                                      case "2":
                                        $status_name = "Inactive";
                                        break;
                                      case "3":
                                        $status_name = "Deleted";
                                        break;
                                      default:
                                        $status_name = "Undefined";
                                    }

                                    $option = "<option value='".$ij."'";
                                    if($ij==$_REQUEST['customers_status_id'])
                                    {
                                      $option .= "selected='selected'";
                                    }
                                    $option .= ">";
                                    $option .= $status_name;
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
                        <button type="button" class="btn btn-primary filter-btn">Submit</button>
                        <button type="button" class="btn btn-primary filter-reset">Reset</button>
                      </div>
                    </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->


    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">

          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <!-- <h3 class="card-title">Striped Full Width Table</h3> -->
                <a class="btn btn-primary" href="customers_edit.php"><i class="nav-icon fas fa-plus"></i> New</a> 
                <div class="card-tools">
                  <select class="custom-select">
                    <?php 
                    for($pageListing=1; $pageListing<=$PAGE_COUNT; $pageListing++)
                    {
                      echo '<option value="'.$pageListing.'">Page '.$pageListing.'</option>';
                    }
                    ?>
                    
                  </select>
                </div>

              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th style="width: 10px">ID</th>
                      <th>Name</th>
                      <th>Status</th>
                      <th style="width: 80px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    $DATA = $response_data->data;
                    for($ijk=0; $ijk< count($DATA); $ijk++)
                    {
                      $DATA_SINGLE = $DATA[$ijk];
                  ?>

                      <tr>
                        <td><?php echo $DATA_SINGLE->customers_id; ?></td>
                        <td><?php echo $DATA_SINGLE->customers_name ; ?></td>
                        <td>
                          <?php 
                            $status = $DATA_SINGLE->customers_status_id; 
                            $class = "bg-info";
                            $label = "Active";

                            switch ($status) {
                              case "1":
                                $label = "Active";
                                $class = "bg-info";
                                break;
                              case "2":
                                $label = "Inactive";
                                $class = "bg-danger";
                                break;
                              default:
                                $label = "Deleted";
                                $class = "bg-success";
                            }

                          ?>
                          <span class="btn btn-sm <?php echo $class; ?>"><?php echo $label; ?></span>
                        </td>
                        <td>
                          <div class="btn-group">
                            <a type="button" class="btn btn-sm btn-success" href="customers_view.php?ref=<?php echo $DATA_SINGLE->customers_ref; ?>"><i class="nav-icon fas fa-eye"></i></a> 
                            <a type="button" class="btn btn-sm btn-warning" href="customers_edit.php?ref=<?php echo $DATA_SINGLE->customers_ref; ?>"><i class="nav-icon fas fa-edit"></i></a> 
                            <a type="button" class="btn btn-sm btn-success" href="custpack.php?cus=<?php echo $DATA_SINGLE->customers_ref; ?>"><i class="nav-icon fas fa-object-group"></i></a> 
                            <a type="button" class="btn btn-sm btn-warning" href="custpackfeedback.php?cus=<?php echo $DATA_SINGLE->customers_ref; ?>"><i class="nav-icon fas fa-archive"></i></a> 
                            <a type="button" class="btn btn-sm btn-success" href="custpackmystery.php?cus=<?php echo $DATA_SINGLE->customers_ref; ?>"><i class="nav-icon fas fa-drum"></i></a> 
                            <a type="button" class="btn btn-sm btn-warning" href="custcourse.php?cus=<?php echo $DATA_SINGLE->customers_ref; ?>"><i class="nav-icon fas fa-book-open"></i></a> 
                            <a type="button" class="btn btn-sm btn-info" href="custcom.php?cus=<?php echo $DATA_SINGLE->customers_ref; ?>"><i class="nav-icon fas fa-rss"></i></a> 
                            <!-- <a type="button" class="btn btn-sm btn-danger" href="customers_delete.php?ref=<?php echo $DATA_SINGLE->customers_ref; ?>"><i class="nav-icon fas fa-trash"></i></a> -->
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
          <!-- /.col-md-6 -->


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
  custom_js_nav_bar_selection("customers");
  custom_js_pagination_sync("<?php echo $PAGE; ?>");
  custom_js_show_filter("<?php echo $SHOW_FILTER; ?>");
  custom_js_submit_filter();
  custom_js_datepicker_activate();
</script>