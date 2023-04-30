<?php

include_once('custom/globals.php');

?>

<?php

include_once('fetch/custcom_fetch_detail.php');

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
            <h1>Customer Communication</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="custcom.php?cus=<?php echo $CUS;?>">Customer Communication List</a></li>
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
                        <label for="custcom_communication_ref">Communication Ref</label>

                        <select class="custom-select form-control-border" name="custcom_communication_ref" id="custcom_communication_ref">
                          <option value="">-- SELECT --</option>
                          <?php

                            $data_table_communication = $response_data->communication;

                            for($ij=0; $ij<count($data_table_communication); $ij++)
                            {
                              $data_row_communication = (array) $data_table_communication[$ij];
                              extract($data_row_communication);

                              $option = "<option value='".$communication_ref."'";
                              if($communication_ref==$custcom_communication_ref)
                              {
                                $option .= "selected='selected'";
                              }
                              $option .= ">";
                              $option .= $communication_name. " [ ". $communication_code ." ]";
                              $option .= "</option>";

                              echo $option;
                            }

                          ?>
                        </select>

                          <?php

                            $data_table_communication = $response_data->communication;

                            for($ij=0; $ij<count($data_table_communication); $ij++)
                            {
                              $data_row_communication = (array) $data_table_communication[$ij];
                              extract($data_row_communication);
                              ?>
                              <input type="hidden" id="custcom_communication_ref_<?php echo $communication_ref;?>" value="<?php echo $communication_code;?>">
                              <?php
                            }

                          ?>

                      </div>
                      <div class="form-group">
                        <label for="custcom_name">Communication Code</label>
                        <input type="text" class="form-control form-control-border" name="custcom_name" id="custcom_name" placeholder="Communication Code" autocomplete="off" value="<?php echo $custcom_name;?>">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="custcom_status_id">Status</label>
                        <select class="custom-select form-control-border" name="custcom_status_id" id="custcom_status_id">
                          <option value="1" <?php if($custcom_status_id=="1"){echo 'selected="selected"';}?> >Active</option>
                          <option value="2" <?php if($custcom_status_id=="2"){echo 'selected="selected"';}?> >Inactive</option>
                          <option value="3" <?php if($custcom_status_id=="3"){echo 'selected="selected"';}?> >Deleted</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="custcom_ref">Reference</label>
                        <input type="text" class="form-control form-control-border" name="custcom_ref" id="custcom_ref" placeholder="Reference" readonly="readonly" value="<?php echo $custcom_ref;?>">
                      </div>
                      <div class="form-group">
                        <label for="custcom_created">Created Date</label>
                        <input type="text" class="form-control form-control-border" name="custcom_created" id="custcom_created" placeholder="Reference" readonly="readonly" value="<?php echo $custcom_created;?>">
                      </div>
                      <div class="form-group">
                        <label for="custcom_modified">Modified Date</label>
                        <input type="text" class="form-control form-control-border" name="custcom_modified" id="custcom_modified" placeholder="Reference" readonly="readonly" value="<?php echo $custcom_modified;?>">
                      </div>

                      <div class="form-group">
                        <label for="custcom_customer_ref">Customer Ref</label>
                        <input type="text" class="form-control form-control-border" name="custcom_customer_ref" id="custcom_customer_ref" placeholder="Customer Ref" readonly="readonly" autocomplete="off" value="<?php echo $custcom_customer_ref;?>">
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

  $("#custcom_communication_ref").change(function(){
    var valueToShow = "";

    if($(this).val()!="")
    {
      valueToShow = $("#custcom_communication_ref_"+$(this).val()).val();
    }

    $("#custcom_name").val(valueToShow);
  });
</script>