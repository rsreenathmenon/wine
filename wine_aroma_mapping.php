<?php

include_once('custom/globals.php');

?>

<?php

include_once('fetch/wine_aroma_mapping_fetch_detail.php');

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
            <h1>Wine</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="wine.php">Wine List</a></li>
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

          <!-- Customer Menu -->
          <div class="col-md-12">
            <div class="card card-primary card-outline">
              <div class="card-body">
                <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link" href="wine_view.php?ref=<?php echo $wine_ref;?>" role="tab">View</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="wine_edit.php?ref=<?php echo $wine_ref;?>" role="tab">Edit</a>
                  </li>
                  <?php

                    $data_table_winestyle = $response_data->winestyle_topmenu;

                    for($ij=0; $ij<count($data_table_winestyle); $ij++)
                    {
                      $data_row_winestyle = (array) $data_table_winestyle[$ij];
                      extract($data_row_winestyle);

                      $classSelection = "";
                      if($winestyle_ref==$WINESTYLE_REF)
                      {
                        $classSelection .= "nav-link-active";
                      }

                      ?>
                      <li class="nav-item">
                        <a class="nav-link <?php echo $classSelection;?>" href="wine_aroma_mapping.php?ref=<?php echo $wine_ref;?>&winestyle_ref=<?php echo $winestyle_ref;?>" role="tab"><?php echo $winestyle_name;?></a>
                      </li>
                      <?php
                    }

                  ?>
                </ul>
              </div>
              <!-- /.card -->
            </div>
            <!-- /.card -->
          </div>


          <div class="col-md-12">

            <form action="process/wine_process.php" method="post" >
              <!-- general form elements -->
              <div class="card card-primary">
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-6">
                      
                      <div class="form-group">
                        <label for="wine_name">Wine Name</label>
                        <input type="text" class="form-control form-control-border" placeholder="Name" readonly="readonly" autocomplete="off" value="<?php echo $wine_name;?>">
                      </div>

                      <div class="form-group">
                        <label for="wine_varietal">Aroma</label>
                          <?php

                            $data_table_winearomamap = $response_data->winearomamap;

                            $data_table_winearoma = $response_data->winearoma;

                            for($ij=0; $ij<count($data_table_winearoma); $ij++)
                            {
                              $data_row_winearoma = (array) $data_table_winearoma[$ij];
                              extract($data_row_winearoma);

                              ?>
                              <div class='form-group'>
                                <div class="row">
                                  <div class="col-sm-6">
                                    <label class='form-check-label'> <?php echo $winearoma_name; ?></label>
                                  </div>
                                  <div class="col-sm-6">
                                  
                                    <select class="custom-select form-control-border" name="winearomamap_rating_<?php echo $winearoma_ref; ?>" id="winearomamap_rating_<?php echo $winearoma_ref; ?>">
                                      <?php
                                        for($ijk=0; $ijk<=6; $ijk++)
                                        {
                                          ?>
                                          <option value="<?php echo $ijk; ?>" ><?php echo $ijk; ?></option>
                                          <?php
                                        }
                                      ?>
                                      
                                    </select>
                                  </div>
                                </div>
                              </div>
                              <?php
                            }


                          ?>

                      </div>
                      
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="winearomamap_wine_ref">Wine Reference</label>
                        <input type="text" class="form-control form-control-border" name="winearomamap_wine_ref" id="winearomamap_wine_ref" placeholder="Reference" readonly="readonly" value="<?php echo $REF; ?>">
                      </div>
                      <div class="form-group">
                        <label for="winearomamap_winestyle_ref">Wine Style Reference</label>
                        <input type="text" class="form-control form-control-border" name="winearomamap_winestyle_ref" id="winearomamap_winestyle_ref" placeholder="Reference" readonly="readonly" value="<?php echo $WINESTYLE_REF; ?>">
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
  <?php
    for($ij=0; $ij<count($data_table_winearomamap); $ij++)
    {
      $data_row_winearomamap = (array) $data_table_winearomamap[$ij];
      extract($data_row_winearomamap);
      ?>
      $("#winearomamap_rating_<?php echo $winearomamap_winearoma_ref; ?>").val("<?php echo $winearomamap_rating; ?>");
      <?php
    }
  ?>
  custom_js_nav_bar_selection("wine");
  function js_wine_edit_country_change()
  {
    FieldID = "wine_region_ref";
    CountryRef = $("#wine_country_ref").val();
    OptionToSelect = "<?php echo $wine_region_ref; ?>";
    custom_js_country_region_dropdown(FieldID,CountryRef,OptionToSelect);
  }
  js_wine_edit_country_change();
  custom_js_cust_nav_bar_selection("nav-link-active");
</script>