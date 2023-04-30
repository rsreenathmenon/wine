<?php

include_once('custom/globals.php');

?>

<?php

include_once('fetch/custpackfeedback_fetch_detail.php');

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
            <h1>Customer Pack Feedback</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="custpackfeedback.php?cus=<?php echo $CUS;?>">Customer Pack Feedback List</a></li>
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
                        <label for="custpackfeedback_name">Pack Code</label>
                        <input type="text" class="form-control form-control-border" name="custpackfeedback_name" id="custpackfeedback_name" placeholder="Pack Code" autocomplete="off" value="<?php echo $custpackfeedback_name;?>">
                      </div>

                      <div class="form-group">
                        <label for="custpackfeedback_first_in_pack">First In Pack</label>
                        <input type="text" class="form-control form-control-border" name="custpackfeedback_first_in_pack" id="custpackfeedback_first_in_pack" placeholder="First In Pack" autocomplete="off" value="<?php echo $custpackfeedback_first_in_pack;?>">
                      </div>
                      <div class="form-group">
                        <label for="custpackfeedback_second_in_pack">Second In Pack</label>
                        <input type="text" class="form-control form-control-border" name="custpackfeedback_second_in_pack" id="custpackfeedback_second_in_pack" placeholder="Second In Pack" autocomplete="off" value="<?php echo $custpackfeedback_second_in_pack;?>">
                      </div>
                      <div class="form-group">
                        <label for="custpackfeedback_most_expensive">Think Most Expensive</label>
                        <input type="text" class="form-control form-control-border" name="custpackfeedback_most_expensive" id="custpackfeedback_most_expensive" placeholder="Think Most Expensive" autocomplete="off" value="<?php echo $custpackfeedback_most_expensive;?>">
                      </div>
                      <div class="form-group">
                        <label for="custpackfeedback_cheapest">Think Cheapest</label>
                        <input type="text" class="form-control form-control-border" name="custpackfeedback_cheapest" id="custpackfeedback_cheapest" placeholder="Think Cheapest" autocomplete="off" value="<?php echo $custpackfeedback_cheapest;?>">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="custpackfeedback_status_id">Status</label>
                        <select class="custom-select form-control-border" name="custpackfeedback_status_id" id="custpackfeedback_status_id">
                          <option value="1" <?php if($custpackfeedback_status_id=="1"){echo 'selected="selected"';}?> >Active</option>
                          <option value="2" <?php if($custpackfeedback_status_id=="2"){echo 'selected="selected"';}?> >Inactive</option>
                          <option value="3" <?php if($custpackfeedback_status_id=="3"){echo 'selected="selected"';}?> >Deleted</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="custpackfeedback_ref">Reference</label>
                        <input type="text" class="form-control form-control-border" name="custpackfeedback_ref" id="custpackfeedback_ref" placeholder="Reference" readonly="readonly" value="<?php echo $custpackfeedback_ref;?>">
                      </div>

                      <div class="form-group">
                        <label for="custpackfeedback_customer_ref">Customer Ref</label>
                        <input type="text" class="form-control form-control-border" name="custpackfeedback_customer_ref" id="custpackfeedback_customer_ref" placeholder="Customer Ref" autocomplete="off" value="<?php echo $custpackfeedback_customer_ref;?>">
                      </div>
                      <div class="form-group">
                        <label for="custpackfeedback_pack_ref">Pack Ref</label>
                        <input type="text" class="form-control form-control-border" name="custpackfeedback_pack_ref" id="custpackfeedback_pack_ref" placeholder="Pack Ref" autocomplete="off" value="<?php echo $custpackfeedback_pack_ref;?>">
                      </div>
                    </div>
                  </div>


                  <div class="row">

                  <?php

                    $data_table_winepackmap = $response_data->winepackmap;
                    $data_row_winepackmap = (array) $data_table_winepackmap;

                    for($ijklm=1; $ijklm<=4; $ijklm++)
                    {

                  ?>

                      <div class="col-sm-6">
                        <div class="card card-primary">
                          <div class="card-header">
                            <h3 class="card-title">Wine <?php echo $ijklm; ?></h3>

                            <div class="card-tools">
                              <button type="button" class="btn btn-tool data_collapse_btn_common data_collapse_btn_<?php echo $ijklm; ?>" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </div>
                            <!-- /.card-tools -->
                          </div>
                          <!-- /.card-header -->
                          <div class="card-body">
                            <div class="form-group">
                              <label for="custpackfeedback_wine_<?php echo $ijklm; ?>_smell">Wine <?php echo $ijklm; ?> Smell</label>
                              <input type="text" class="form-control form-control-border" name="custpackfeedback_wine_<?php echo $ijklm; ?>_smell" id="custpackfeedback_wine_<?php echo $ijklm; ?>_smell" placeholder="Wine <?php echo $ijklm; ?> Smell" autocomplete="off" value="<?php echo ${"custpackfeedback_wine_".$ijklm."_smell"}; ?>">
                            </div>
                            <div class="form-group">
                              <label for="custpackfeedback_wine_<?php echo $ijklm; ?>_taste">Wine <?php echo $ijklm; ?> Taste</label>
                              <input type="text" class="form-control form-control-border" name="custpackfeedback_wine_<?php echo $ijklm; ?>_taste" id="custpackfeedback_wine_<?php echo $ijklm; ?>_taste" placeholder="Wine <?php echo $ijklm; ?> Taste" autocomplete="off" value="<?php echo ${"custpackfeedback_wine_".$ijklm."_taste"};?>">
                            </div>
                            <div class="form-group">
                              <label for="custpackfeedback_wine_<?php echo $ijklm; ?>_overall">Wine <?php echo $ijklm; ?> Overall</label>
                              <input type="text" class="form-control form-control-border" name="custpackfeedback_wine_<?php echo $ijklm; ?>_overall" id="custpackfeedback_wine_<?php echo $ijklm; ?>_overall" placeholder="Wine <?php echo $ijklm; ?> Overall" autocomplete="off" value="<?php echo ${"custpackfeedback_wine_".$ijklm."_overall"};?>">
                            </div>
                            <div class="form-group">
                              <label for="custpackfeedback_wine_<?php echo $ijklm; ?>_drink_again">Wine <?php echo $ijklm; ?> Drink Again</label>
                              <input type="text" class="form-control form-control-border" name="custpackfeedback_wine_<?php echo $ijklm; ?>_drink_again" id="custpackfeedback_wine_<?php echo $ijklm; ?>_drink_again" placeholder="Wine <?php echo $ijklm; ?> Drink Again" autocomplete="off" value="<?php echo ${"custpackfeedback_wine_".$ijklm."_drink_again"};?>">
                            </div>
                            <div class="form-group">
                              <label for="custpackfeedback_wine_<?php echo $ijklm; ?>_eat_with">Wine <?php echo $ijklm; ?> Eat With</label>
                              <input type="text" class="form-control form-control-border" name="custpackfeedback_wine_<?php echo $ijklm; ?>_eat_with" id="custpackfeedback_wine_<?php echo $ijklm; ?>_eat_with" placeholder="Wine <?php echo $ijklm; ?> Eat With" autocomplete="off" value="<?php echo ${"custpackfeedback_wine_".$ijklm."_eat_with"};?>">
                            </div>
                            <div class="form-group">
                              <label for="custpackfeedback_wine_<?php echo $ijklm; ?>_comments">Wine <?php echo $ijklm; ?> Other Comments</label>
                              <input type="text" class="form-control form-control-border" name="custpackfeedback_wine_<?php echo $ijklm; ?>_comments" id="custpackfeedback_wine_<?php echo $ijklm; ?>_comments" placeholder="Wine <?php echo $ijklm; ?> Other Comments" autocomplete="off" value="<?php echo ${"custpackfeedback_wine_".$ijklm."_comments"};?>">
                            </div>
 

                          </div>
                          <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                      </div>


                  <?php
                    }
                  ?> 

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