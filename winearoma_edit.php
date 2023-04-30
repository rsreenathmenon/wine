<?php

include_once('custom/globals.php');

?>

<?php

include_once('fetch/winearoma_fetch_detail.php');

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
            <h1>Wine Aroma</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="winearoma.php">Wine Aroma List</a></li>
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

            <form action="process/winearoma_process.php" method="post" >
              <!-- general form elements -->
              <div class="card card-primary">
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="winearoma_name">Name</label>
                        <input type="text" class="form-control form-control-border" name="winearoma_name" id="winearoma_name" placeholder="Name" autocomplete="off" value="<?php echo $winearoma_name;?>">
                      </div>
                      <div class="form-group">
                        <label for="winearoma_winestyle_ref">Wine Style</label>
                        <select class="custom-select form-control-border" name="winearoma_winestyle_ref" id="winearoma_winestyle_ref">
                          <option value="" <?php if($winearoma_winestyle_ref==""){echo 'selected="selected"';}?> >-- SELECT --</option>
                          <?php

                            $data_table_winestyle = $response_data->winestyle;

                            for($ij=0; $ij<count($data_table_winestyle); $ij++)
                            {
                              $data_row_winestyle = (array) $data_table_winestyle[$ij];
                              extract($data_row_winestyle);

                              $option = "<option value='".$winestyle_ref."'";
                              if($winestyle_ref==$winearoma_winestyle_ref)
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
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="winearoma_status_id">Status</label>
                        <select class="custom-select form-control-border" name="winearoma_status_id" id="winearoma_status_id">
                          <option value="1" <?php if($winearoma_status_id=="1"){echo 'selected="selected"';}?> >Active</option>
                          <option value="2" <?php if($winearoma_status_id=="2"){echo 'selected="selected"';}?> >Inactive</option>
                          <option value="3" <?php if($winearoma_status_id=="3"){echo 'selected="selected"';}?> >Deleted</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="winearoma_ref">Reference</label>
                        <input type="text" class="form-control form-control-border" name="winearoma_ref" id="winearoma_ref" placeholder="Reference" readonly="readonly" value="<?php echo $winearoma_ref;?>">
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
  custom_js_nav_bar_selection("winearoma");
</script>