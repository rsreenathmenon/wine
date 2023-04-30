<?php

include_once('custom/globals.php');

?>

<?php

include_once('fetch/custpack_fetch_detail.php');

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
            <h1>Customer Pack</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="custpack.php?cus=<?php echo $CUS;?>">Customer Pack List</a></li>
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
                        <label for="custpack_pack_ref">Pack Ref</label>

                        <select class="custom-select form-control-border" name="custpack_pack_ref" id="custpack_pack_ref">
                          <option value="">-- SELECT --</option>
                          <?php

                            $data_table_pack = $response_data->pack;

                            for($ij=0; $ij<count($data_table_pack); $ij++)
                            {
                              $data_row_pack = (array) $data_table_pack[$ij];
                              extract($data_row_pack);

                              $option = "<option value='".$pack_ref."'";
                              if($pack_ref==$custpack_pack_ref)
                              {
                                $option .= "selected='selected'";
                              }
                              $option .= ">";
                              $option .= $pack_name. " [ ". $pack_code ." ]";
                              $option .= "</option>";

                              echo $option;
                            }

                          ?>
                        </select>

                          <?php

                            $data_table_pack = $response_data->pack;

                            for($ij=0; $ij<count($data_table_pack); $ij++)
                            {
                              $data_row_pack = (array) $data_table_pack[$ij];
                              extract($data_row_pack);
                              ?>
                              <input type="hidden" id="custpack_pack_ref_<?php echo $pack_ref;?>" value="<?php echo $pack_code;?>">
                              <?php
                            }

                          ?>

                      </div>
                      <div class="form-group">
                        <label for="custpack_name">Pack Code</label>
                        <input type="text" class="form-control form-control-border" name="custpack_name" id="custpack_name" placeholder="Pack Code" autocomplete="off" value="<?php echo $custpack_name;?>">
                      </div>
                      <div class="form-group">
                        <label for="custpack_autosent">Auto Sent</label>
                        <select class="custom-select form-control-border" name="custpack_autosent" id="custpack_autosent">
                          <option value="0" <?php if($custpack_autosent=="0"){echo 'selected="selected"';}?> >Not Sent</option>
                          <option value="1" <?php if($custpack_autosent=="1"){echo 'selected="selected"';}?> >Sent</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="custpack_manualsent">Manual Sent</label>
                        <select class="custom-select form-control-border" name="custpack_manualsent" id="custpack_manualsent">
                          <option value="0" <?php if($custpack_manualsent=="0"){echo 'selected="selected"';}?> >Not Sent</option>
                          <option value="1" <?php if($custpack_manualsent=="1"){echo 'selected="selected"';}?> >Sent</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="custpack_feedback">Feedback Received</label>
                        <select class="custom-select form-control-border" name="custpack_feedback" id="custpack_feedback">
                          <option value="0" <?php if($custpack_feedback=="0"){echo 'selected="selected"';}?> >Not Received</option>
                          <option value="1" <?php if($custpack_feedback=="1"){echo 'selected="selected"';}?> >Received</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="custpack_status_id">Status</label>
                        <select class="custom-select form-control-border" name="custpack_status_id" id="custpack_status_id">
                          <option value="1" <?php if($custpack_status_id=="1"){echo 'selected="selected"';}?> >Active</option>
                          <option value="2" <?php if($custpack_status_id=="2"){echo 'selected="selected"';}?> >Inactive</option>
                          <option value="3" <?php if($custpack_status_id=="3"){echo 'selected="selected"';}?> >Deleted</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="custpack_ref">Reference</label>
                        <input type="text" class="form-control form-control-border" name="custpack_ref" id="custpack_ref" placeholder="Reference" readonly="readonly" value="<?php echo $custpack_ref;?>">
                      </div>
                      <div class="form-group">
                        <label for="custpack_created">Created Date</label>
                        <input type="text" class="form-control form-control-border" name="custpack_created" id="custpack_created" placeholder="Reference" readonly="readonly" value="<?php echo $custpack_created;?>">
                      </div>
                      <div class="form-group">
                        <label for="custpack_modified">Modified Date</label>
                        <input type="text" class="form-control form-control-border" name="custpack_modified" id="custpack_modified" placeholder="Reference" readonly="readonly" value="<?php echo $custpack_modified;?>">
                      </div>
                      <div class="form-group">
                        <label for="custpack_feedback_on">Feedback Date</label>
                        <input type="text" class="form-control form-control-border" name="custpack_feedback_on" id="custpack_feedback_on" placeholder="Reference" readonly="readonly" value="<?php echo $custpack_feedback_on;?>">
                      </div>

                      <div class="form-group">
                        <label for="custpack_customer_ref">Customer Ref</label>
                        <input type="text" class="form-control form-control-border" name="custpack_customer_ref" id="custpack_customer_ref" placeholder="Customer Ref" readonly="readonly" autocomplete="off" value="<?php echo $custpack_customer_ref;?>">
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

  $("#custpack_pack_ref").change(function(){
    var valueToShow = "";

    if($(this).val()!="")
    {
      valueToShow = $("#custpack_pack_ref_"+$(this).val()).val();
    }

    $("#custpack_name").val(valueToShow);
  });
</script>