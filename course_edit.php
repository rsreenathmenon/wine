<?php

include_once('custom/globals.php');

?>

<?php

include_once('fetch/course_fetch_detail.php');

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
            <h1>Course</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="course.php">Course List</a></li>
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

            <form action="process/course_process.php" method="post" >
              <!-- general form elements -->
              <div class="card card-primary">
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="course_name">Name</label>
                        <input type="text" class="form-control form-control-border" name="course_name" id="course_name" placeholder="Name" autocomplete="off" value="<?php echo $course_name;?>">
                      </div>
                      <div class="form-group">
                        <label for="course_code">Moodle Code</label>
                        <input type="text" class="form-control form-control-border" name="course_code" id="course_code" placeholder="Moodle Code" autocomplete="off" value="<?php echo $course_code;?>">
                      </div>
                      <div class="form-group">
                        <label for="course_coursecategory_ref">Category</label>
                        <select class="custom-select form-control-border" name="course_coursecategory_ref" id="course_coursecategory_ref">
                          <option value="" <?php if($course_coursecategory_ref==""){echo 'selected="selected"';}?> >-- SELECT --</option>
                          <?php

              							$data_table_coursecategory = $response_data->coursecategory;

              							for($ij=0; $ij<count($data_table_coursecategory); $ij++)
              							{
              							  $data_row_coursecategory = (array) $data_table_coursecategory[$ij];
              							  extract($data_row_coursecategory);

              							  $option = "<option value='".$coursecategory_ref."'";
              							  if($coursecategory_ref==$course_coursecategory_ref)
              							  {
              							  	$option .= "selected='selected'";
              							  }
              							  $option .= ">";
              							  $option .= $coursecategory_name;
              							  $option .= "</option>";

              							  echo $option;
              							}

              						?>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="course_status_id">Status</label>
                        <select class="custom-select form-control-border" name="course_status_id" id="course_status_id">
                          <option value="1" <?php if($course_status_id=="1"){echo 'selected="selected"';}?> >Active</option>
                          <option value="2" <?php if($course_status_id=="2"){echo 'selected="selected"';}?> >Inactive</option>
                          <option value="3" <?php if($course_status_id=="3"){echo 'selected="selected"';}?> >Deleted</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="course_ref">Reference</label>
                        <input type="text" class="form-control form-control-border" name="course_ref" id="course_ref" placeholder="Reference" readonly="readonly" value="<?php echo $course_ref;?>">
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
  custom_js_nav_bar_selection("course");
</script>