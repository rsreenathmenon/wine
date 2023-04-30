<?php

include_once('custom/globals.php');

?>

<?php

include_once('fetch/users_fetch_detail.php');

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
            <h1>User Detail</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="users.php">User List</a></li>
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

            <form id="quickForm" action="process/users_process.php" method="post" novalidate="novalidate">
              <!-- general form elements -->
              <div class="card card-primary">
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="users_firstname">First Name</label>
                        <input type="text" class="form-control form-control-border" name="users_firstname" id="users_firstname" placeholder="First Name" autocomplete="off" value="<?php echo $users_firstname;?>">
                      </div>
                      <div class="form-group">
                        <label for="users_lastname">Last Name</label>
                        <input type="text" class="form-control form-control-border" name="users_lastname" id="users_lastname" placeholder="Last Name" autocomplete="off" value="<?php echo $users_lastname;?>">
                      </div>
                      <div class="form-group">
                        <label for="users_email">Email</label>
                        <input type="text" class="form-control form-control-border" name="users_email" id="users_email" placeholder="Email" autocomplete="off" value="<?php echo $users_email;?>">
                      </div>
                      <div class="form-group">
                        <label for="users_username">UserName</label>
                        <input type="text" class="form-control form-control-border" name="users_username" id="users_username" placeholder="UserName" autocomplete="off" value="<?php echo $users_username;?>">
                      </div>
                      <div class="form-group">
                        <label for="users_password">Password</label>
                        <input type="password" class="form-control form-control-border" name="users_password" id="users_password" placeholder="Password" autocomplete="off" value="<?php echo $users_password;?>">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="users_status_id">Status</label>
                        <select class="custom-select form-control-border" name="users_status_id" id="users_status_id">
                          <option value="1" <?php if($users_status_id=="1"){echo 'selected="selected"';}?> >Active</option>
                          <option value="2" <?php if($users_status_id=="2"){echo 'selected="selected"';}?> >Inactive</option>
                          <option value="3" <?php if($users_status_id=="3"){echo 'selected="selected"';}?> >Deleted</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="users_ref">Reference</label>
                        <input type="text" class="form-control form-control-border" name="users_ref" id="users_ref" placeholder="Reference" readonly="readonly" value="<?php echo $users_ref;?>">
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
  custom_js_nav_bar_selection("users");

$(function () {
  $('#quickForm').validate({
    rules: {
      users_email: {
        required: true,
        email: true,
      },
      users_password: {
        required: true,
        minlength: 5
      },
      users_username: {
        required: true,
        minlength: 5
      },
      terms: {
        required: true
      },
    },
    messages: {
      users_email: {
        required: "Please enter a email address",
        email: "Please enter a vaild email address"
      },
      users_password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
      users_username: {
        required: "Please provide a Username",
        minlength: "Your username must be at least 5 characters long"
      },
      terms: "Please accept our terms"
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});

</script>