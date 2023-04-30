<?php

include_once('custom/globals.php');

?>

<?php

include_once('fetch/custpackmystery_fetch_detail.php');

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
            <h1>Customer Pack Mystery</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="custpackmystery.php?cus=<?php echo $CUS;?>">Customer Pack Mystery List</a></li>
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
                        <label for="custpackmystery_name">Pack Code</label>
                        <input type="text" class="form-control form-control-border" name="custpackmystery_name" id="custpackmystery_name" placeholder="Pack Code" autocomplete="off" value="<?php echo $custpackmystery_name;?>">
                      </div>

                      <div class="form-group">
                        <label for="custpackmystery_customer_ref">Customer Ref</label>
                        <input type="text" class="form-control form-control-border" name="custpackmystery_customer_ref" id="custpackmystery_customer_ref" placeholder="Customer Ref" autocomplete="off" value="<?php echo $custpackmystery_customer_ref;?>">
                      </div>
                      <div class="form-group">
                        <label for="custpackmystery_pack_ref">Pack Ref</label>
                        <input type="text" class="form-control form-control-border" name="custpackmystery_pack_ref" id="custpackmystery_pack_ref" placeholder="Pack Ref" autocomplete="off" value="<?php echo $custpackmystery_pack_ref;?>">
                      </div>

                      <div class="form-group">
                        <label for="custpackmystery_variety">Variety</label>
                        <input type="text" class="form-control form-control-border" name="custpackmystery_variety" id="custpackmystery_variety" placeholder="Variety" autocomplete="off" value="<?php echo $custpackmystery_variety;?>">
                      </div>
                      <div class="form-group">
                        <label for="custpackmystery_country">Country</label>
                        <input type="text" class="form-control form-control-border" name="custpackmystery_country" id="custpackmystery_country" placeholder="Country" autocomplete="off" value="<?php echo $custpackmystery_country;?>">
                      </div>
                      <div class="form-group">
                        <label for="custpackmystery_region">Region</label>
                        <input type="text" class="form-control form-control-border" name="custpackmystery_region" id="custpackmystery_region" placeholder="Region" autocomplete="off" value="<?php echo $custpackmystery_region;?>">
                      </div>
                      <div class="form-group">
                        <label for="custpackmystery_vintage">Vintage</label>
                        <input type="text" class="form-control form-control-border" name="custpackmystery_vintage" id="custpackmystery_vintage" placeholder="Vintage" autocomplete="off" value="<?php echo $custpackmystery_vintage;?>">
                      </div>
                      <div class="form-group">
                        <label for="custpackmystery_price_point">Price Point</label>
                        <input type="text" class="form-control form-control-border" name="custpackmystery_price_point" id="custpackmystery_price_point" placeholder="Price Point" autocomplete="off" value="<?php echo $custpackmystery_price_point;?>">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="custpackmystery_status_id">Status</label>
                        <select class="custom-select form-control-border" name="custpackmystery_status_id" id="custpackmystery_status_id">
                          <option value="1" <?php if($custpackmystery_status_id=="1"){echo 'selected="selected"';}?> >Active</option>
                          <option value="2" <?php if($custpackmystery_status_id=="2"){echo 'selected="selected"';}?> >Inactive</option>
                          <option value="3" <?php if($custpackmystery_status_id=="3"){echo 'selected="selected"';}?> >Deleted</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="custpackmystery_ref">Reference</label>
                        <input type="text" class="form-control form-control-border" name="custpackmystery_ref" id="custpackmystery_ref" placeholder="Reference" readonly="readonly" value="<?php echo $custpackmystery_ref;?>">
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
</script>