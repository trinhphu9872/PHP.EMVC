<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Shin Shop | AdminPage</title>
  <base href="/PHP.EMVC/">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="views/admin/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="views/admin/AdminLTE/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="views/admin/AdminLTE/bower_components/Ionicons/css/ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="views/admin/AdminLTE/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="views/admin/AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="views/admin/AdminLTE/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
   folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="views/admin/AdminLTE/dist/css/skins/_all-skins.min.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style>
    .custom-banner {
      max-height: 400px;
      overflow: hidden;
      text-align: center;
    }

    .custom-banner a {
      position: relative;
      top: 200px;
      z-index: 1;
    }
  </style>
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <header class="main-header">

      <!-- Logo -->
      <a href="Admin/indexadmin/Dashboard" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">Shin</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">Shin</span>
      </a>

      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- Notifications: style can be found in dropdown.less -->
            <li class="dropdown notifications-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-bell-o"></i>
                <!-- <span class="label label-warning">10</span> -->
              </a>
              <ul class="dropdown-menu">
                <!-- <li class="header">You have 10 notifications</li> -->
                <li>
                  <!-- inner menu: contains the actual data -->
                  <ul class="menu">

                  </ul>
                </li>
                <!-- <li class="footer"><a href="#">View all</a></li> -->
              </ul>
            </li>
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="https://ecdn.game4v.com/g4v-content/uploads/2021/10/27072500/Sharingan-1-game4v-1635294299-10-e1635294382699.jpg" class="user-image" alt="User Image">
                <span class="hidden-xs"><?php echo $_SESSION['admin']['username'] ?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <img src="https://ecdn.game4v.com/g4v-content/uploads/2021/10/27072500/Sharingan-1-game4v-1635294299-10-e1635294382699.jpg" class="img-circle" alt="User Image">

                  <p>
                    <?php echo $_SESSION['admin']['username'] ?> Software Developer
                  </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <!-- <div class="pull-left">
                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                  </div> -->
                  <div class="pull-right">
                    <a href="Admin/indexAdmin/logout" class="btn btn-default btn-flat">Đăng xuất</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>

      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="https://ecdn.game4v.com/g4v-content/uploads/2021/10/27072500/Sharingan-1-game4v-1635294299-10-e1635294382699.jpg" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p><?php echo $_SESSION['admin']['username'] ?></p>

          </div>
        </div>
        <!-- search form -->
        <!-- <form action="#" method="get" class="sidebar-form">
          <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
              <span type="submit" name="search" id="search-btn" class="btn btn-flat">
                <i class="fa fa-search"></i>
              </span>
            </span>
          </div>
        </form> -->
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">MAIN MENU</li>
          <li id="dbtab">
            <a href="Admin/indexadmin/Dashboard">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              <span class="pull-right-container">
              </span>
            </a>
          </li>
          <!-- <li id="gdtab">
            <a href="Admin/order">
              <i class="fa fa-exchange"></i>
              <span>Giao dịch</span>
            </a>
          </li> -->
          <li id="sptab">
            <a href="Admin/productadmin">
              <i class="fa fa-th"></i> <span>Sản phẩm</span>
            </a>
          </li>
          <li id="dmsptab">
            <a href="Admin/category">
              <i class="fa fa-pie-chart"></i>
              <span>Danh mục sản phẩm</span>
            </a>
          </li>

          <?php if ($_SESSION['admin']['role_id'] == '1') : ?>
            <li id="tvtab">
              <a href="Admin/member">
                <i class="fa fa-user-circle"></i>
                <span>Thành viên</span>
              </a>

            </li>
            <li>
              <a href="Admin/permission">
                <i class="fa fa-database"></i>
                <span>Permission</span>
              </a>
            </li>
          <?php elseif ($_SESSION['admin']['role_id'] == '2') :  ?>

          <?php endif  ?>

          <li id="pttab">
            <!-- <a href="analytics">
              <i class="fa fa-bar-chart"></i> <span>Phân tích</span>
              <!-- <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            <!-- <ul class="treeview-menu">
              <li><a href="analytics"><i class="fa fa-circle-o"></i> Thành viên</a></li>
              <li><a href="#"><i class="fa fa-circle-o"></i> Giao dịch</a></li>
              <li><a href="#"><i class="fa fa-circle-o"></i> Sản phẩm nhập vào</a></li>
              <li><a href="#"><i class="fa fa-circle-o"></i> Sản phẩm bán ra</a></li>
            </ul> -->
          </li>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div>

      </div>
      <!-- CONTEN HERE ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
      <?php echo $content; ?>
      <!-- ~END CONTENT ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~   -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <div class="pull-right hidden-xs">

      </div>

    </footer>
  </div>
  <!-- ./wrapper -->
  <script>

  </script>
</body>

</html>