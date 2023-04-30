
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Rubay Wines</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/avatar.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="users_edit.php?ref=<?php echo $_SESSION['user']['users_ref']; ?>" class="d-block">
            <?php 
              echo $_SESSION['user']['users_firstname'] ." ". $_SESSION['user']['users_lastname'];
            ?>
          </a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <!-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-item">
            <a href="branch.php" class="nav-link nav-link-branch">
              <i class="nav-icon fas fa-barcode"></i>
              <p>
                Branch
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="communication.php" class="nav-link nav-link-communication">
              <i class="nav-icon fas fa-rss"></i>
              <p>
                Communication
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="com_generator.php" class="nav-link nav-link-com_generator">
              <i class="nav-icon fas fa-rss"></i>
              <p>
                Communication Generator
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="country.php" class="nav-link nav-link-country">
              <i class="nav-icon fas fa-globe"></i>
              <p>
                Country
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="course.php" class="nav-link nav-link-course">
              <i class="nav-icon fas fa-book-open"></i>
              <p>
                Course
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="coursecategory.php" class="nav-link nav-link-coursecategory">
              <i class="nav-icon fas fa-archive"></i>
              <p>
                Course Category
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="customers.php" class="nav-link nav-link-customers active">
              <i class="nav-icon fas fa-address-book"></i>
              <p>
                Customers
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="list_generator.php" class="nav-link nav-link-list_generator active">
              <i class="nav-icon fas fa-brain"></i>
              <p>
                List Generator
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="custpackmysterylist.php" class="nav-link nav-link-custpackmysterylist active">
              <i class="nav-icon fas fa-drum"></i>
              <p>
                Mystery wine
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="pack.php" class="nav-link nav-link-pack">
              <i class="nav-icon fas fa-object-group"></i>
              <p>
                Pack
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="region.php" class="nav-link nav-link-region">
              <i class="nav-icon fas fa-chess-rook"></i>
              <p>
                Region
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="report_pack_generator.php" class="nav-link nav-link-report_pack">
              <i class="nav-icon fas fa-chart-area"></i>
              <p>
                Report Pack
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="wineq.php" class="nav-link nav-link-wineq">
              <i class="nav-icon fas fa-briefcase"></i>
              <p>
                WineQ
              </p>
            </a>
          </li>

          <!-- <li class="nav-item">
            <a href="#" class="nav-link nav-link-report_wine">
              <i class="nav-icon fas fa-chart-bar"></i>
              <p>
                Report Wine
              </p>
            </a>
          </li> -->

          <li class="nav-item">
            <a href="states.php" class="nav-link nav-link-states">
              <i class="nav-icon fas fa-globe"></i>
              <p>
                States
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="source.php" class="nav-link nav-link-source">
              <i class="nav-icon fas fa-atom"></i>
              <p>
                Source
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="users.php" class="nav-link nav-link-users">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Users
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="varietal.php" class="nav-link nav-link-varietal">
              <i class="nav-icon fas fa-chess"></i>
              <p>
                Variety
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="wine.php" class="nav-link nav-link-wine">
              <i class="nav-icon fas fa-wine-glass"></i>
              <p>
                Wine
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="winestyle.php" class="nav-link nav-link-winestyle">
              <i class="nav-icon fas fa-cube"></i>
              <p>
                Wine Styles
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="winery.php" class="nav-link nav-link-winery">
              <i class="nav-icon fas fa-building"></i>
              <p>
                Winery
              </p>
            </a>
          </li>

          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <!-- <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Starter Pages
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Active Page</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inactive Page</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Simple Link
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li> -->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>