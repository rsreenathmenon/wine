<?php

include_once('custom/globals.php');

?>

<?php

include_once('fetch/custpackfeedback_fetch_table.php');

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
            <h1 class="m-0">Customer Pack Feedback</h1>
          </div><!-- /.col -->

          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="customers.php">Customers List</a></li>
              <li class="breadcrumb-item active">Customer Pack Feedback</li>
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
                              <label for="filterField1">Pack Code</label>
                              <input type="text" name="custpackfeedback_name" class="form-control form_search_input_text" id="custpackfeedback_name" placeholder="Enter Pack Code" value="<?php echo $_REQUEST['custpackfeedback_name']; ?>">
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

          <!-- Customer Menu -->
          <div class="col-md-12">
            <div class="card card-primary card-outline">
              <div class="card-body">
                <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link" href="customers_view.php?ref=<?php echo $CUS;?>" role="tab">View</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="customers_edit.php?ref=<?php echo $CUS;?>" role="tab">Edit</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="custpack.php?cus=<?php echo $CUS;?>" role="tab">Pack</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link nav-link-active" href="custpackfeedback.php?cus=<?php echo $CUS;?>" role="tab">Feedback</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="custpackmystery.php?cus=<?php echo $CUS;?>" role="tab">Mystery</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="custcourse.php?cus=<?php echo $CUS;?>" role="tab">Course</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="custcom.php?cus=<?php echo $CUS;?>" role="tab">Communication</a>
                  </li>
                </ul>
              </div>
              <!-- /.card -->
            </div>
            <!-- /.card -->
          </div>

          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <!-- <h3 class="card-title">Striped Full Width Table</h3> -->
                <a class="btn btn-primary" href="custpackfeedback_edit.php?cus=<?php echo $CUS; ?>"><i class="nav-icon fas fa-plus"></i> New</a> 
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
                      <th>Pack Code</th>
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
                        <td><?php echo $DATA_SINGLE->custpackfeedback_id; ?></td>
                        <td><?php echo $DATA_SINGLE->custpackfeedback_name ; ?></td>
                        <td>
                          <?php 
                            $status = $DATA_SINGLE->custpackfeedback_status_id; 
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
                            <a type="button" class="btn btn-sm btn-success" href="custpackfeedback_view.php?cus=<?php echo $CUS; ?>&ref=<?php echo $DATA_SINGLE->custpackfeedback_ref; ?>"><i class="nav-icon fas fa-eye"></i></a> 
                            <a type="button" class="btn btn-sm btn-warning" href="custpackfeedback_edit.php?cus=<?php echo $CUS; ?>&ref=<?php echo $DATA_SINGLE->custpackfeedback_ref; ?>"><i class="nav-icon fas fa-edit"></i></a> 
                            <!-- <a type="button" class="btn btn-sm btn-danger" href="custpackfeedback_delete.php?ref=<?php echo $DATA_SINGLE->custpackfeedback_ref; ?>"><i class="nav-icon fas fa-trash"></i></a> -->
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
  custom_js_cust_nav_bar_selection("nav-link-active");
</script>