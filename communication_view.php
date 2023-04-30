<?php

include_once('custom/globals.php');

?>

<?php

include_once('fetch/communication_fetch_detail.php');

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
            <h1>Communication</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="communication.php">Communication List</a></li>
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
                        <label for="communication_name">Name</label>
                        <input type="text" class="form-control form-control-border" name="communication_name" id="communication_name" placeholder="Name" autocomplete="off" value="<?php echo $communication_name;?>">
                      </div>
                      <div class="form-group">
                        <label for="communication_type">Type</label>
                        <select class="custom-select form-control-border" name="communication_type" id="communication_type">
                          <option value="Email" <?php if($communication_type=="Email"){echo 'selected="selected"';}?> >Email</option>
                          <option value="SMS" <?php if($communication_type=="SMS"){echo 'selected="selected"';}?> >SMS</option>
                          <option value="Phone" <?php if($communication_type=="Phone"){echo 'selected="selected"';}?> >Phone</option>
                          <option value="Mail" <?php if($communication_type=="Mail"){echo 'selected="selected"';}?> >Mail</option>
                          <option value="Pack" <?php if($communication_type=="Pack"){echo 'selected="selected"';}?> >Pack</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="communication_reason">Reason</label>
                        <select class="custom-select form-control-border" name="communication_reason" id="communication_reason">
                          <option value="Marketing" <?php if($communication_reason=="Marketing"){echo 'selected="selected"';}?> >Marketing</option>
                          <option value="Account Management" <?php if($communication_reason=="Account Management"){echo 'selected="selected"';}?> >Account Management</option>
                          <option value="Order Fulfilment" <?php if($communication_reason=="Order Fulfilment"){echo 'selected="selected"';}?> >Order Fulfilment</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="communication_code">Communication Code</label>
                        <input type="text" class="form-control form-control-border" name="communication_code" id="communication_code" placeholder="Communication Code" autocomplete="off" value="<?php echo $communication_code;?>">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="communication_status_id">Status</label>
                        <select class="custom-select form-control-border" name="communication_status_id" id="communication_status_id">
                          <option value="1" <?php if($communication_status_id=="1"){echo 'selected="selected"';}?> >Active</option>
                          <option value="2" <?php if($communication_status_id=="2"){echo 'selected="selected"';}?> >Inactive</option>
                          <option value="3" <?php if($communication_status_id=="3"){echo 'selected="selected"';}?> >Deleted</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="communication_ref">Reference</label>
                        <input type="text" class="form-control form-control-border" name="communication_ref" id="communication_ref" placeholder="Reference" readonly="readonly" value="<?php echo $communication_ref;?>">
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
  custom_js_nav_bar_selection("communication");
</script>