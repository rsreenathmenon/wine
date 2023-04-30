<?php

include_once('custom/globals.php');

?>

<?php

include_once('fetch/source_fetch_detail.php');

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
            <h1>Source</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="source.php">Source List</a></li>
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
                        <label for="source_name">Name</label>
                        <input type="text" class="form-control form-control-border" name="source_name" id="source_name" placeholder="Name" autocomplete="off" value="<?php echo $source_name;?>">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="source_status_id">Status</label>
                        <select class="custom-select form-control-border" name="source_status_id" id="source_status_id">
                          <option value="1" <?php if($source_status_id=="1"){echo 'selected="selected"';}?> >Active</option>
                          <option value="2" <?php if($source_status_id=="2"){echo 'selected="selected"';}?> >Inactive</option>
                          <option value="3" <?php if($source_status_id=="3"){echo 'selected="selected"';}?> >Deleted</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="source_ref">Reference</label>
                        <input type="text" class="form-control form-control-border" name="source_ref" id="source_ref" placeholder="Reference" readonly="readonly" value="<?php echo $source_ref;?>">
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
  custom_js_nav_bar_selection("source");
</script>