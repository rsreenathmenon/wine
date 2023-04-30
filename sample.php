<?php

include_once('custom/globals.php');

?>

<?php

include_once('fetch/users_fetch_table.php');

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
            <h1 class="m-0">Starter Page</h1>
          </div><!-- /.col -->

          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo HTTP_SERVER; ?>">Home</a></li>
              <li class="breadcrumb-item active">Starter Page</li>
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
                              <label for="filterField1">First Name</label>
                              <input type="text" name="users_firstname" class="form-control" id="users_firstname" placeholder="Enter First Name" value="<?php echo $_REQUEST['users_firstname']; ?>">
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="filterField2">Last Name</label>
                              <input type="text" name="users_lastname" class="form-control" id="users_lastname" placeholder="Enter First Name" value="<?php echo $_REQUEST['users_lastname']; ?>">
                            </div>
                          </div>
                      </div>
                      </div>
                      <!-- /.card-body -->

                      <div class="card-footer">
                        <button type="button" class="btn btn-primary filter-btn">Submit</button>
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
                      <th>Email</th>
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
                        <td><?php echo $DATA_SINGLE->users_id; ?></td>
                        <td><?php echo $DATA_SINGLE->users_firstname ." ". $DATA_SINGLE->users_lastname ; ?></td>
                        <td><?php echo $DATA_SINGLE->users_email ; ?></td>
                        <td>
                          <?php 
                            $status = $DATA_SINGLE->users_status_id; 
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
                            <a type="button" class="btn btn-sm btn-success" href="users_view.php?ref=<?php echo $DATA_SINGLE->users_ref; ?>"><i class="nav-icon fas fa-eye"></i></a> 
                            <a type="button" class="btn btn-sm btn-warning" href="users_edit.php?ref=<?php echo $DATA_SINGLE->users_ref; ?>"><i class="nav-icon fas fa-edit"></i></a> 
                            <!-- <a type="button" class="btn btn-sm btn-danger" href="users_delete.php?ref=<?php echo $DATA_SINGLE->users_ref; ?>"><i class="nav-icon fas fa-trash"></i></a> -->
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
  custom_js_nav_bar_selection("users");
  custom_js_pagination_sync("<?php echo $PAGE; ?>");
  custom_js_show_filter("<?php echo $SHOW_FILTER; ?>");
  custom_js_submit_filter();
</script>