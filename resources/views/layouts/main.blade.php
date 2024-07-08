<?php 
  $user_auth = Auth::user();
  date_default_timezone_set('Asia/Manila');
  //$datetoday = date('Y-m-d H:i:s');
  $year = date('Y');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>BEVMI - PREVSYS</title>
  <link rel="stylesheet" href="{{asset('vendors/mdi/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/style.css')}}">
  <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
  <link rel="shortcut icon" href="{{asset('images/PREVSYS-LOGO-mini.png')}}" />
  @yield('styles')
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="navbar-brand-wrapper d-flex justify-content-center">
        <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">  
          <a class="navbar-brand brand-logo" href="index.html"><img src="{{asset('images/LOGO-PREVSYS.png')}}" alt="logo" style="width: 100%; height: 50px; margin-left: -9px;"/></a>
          <a class="navbar-brand brand-logo-mini" href="index.html"><img src="{{asset('images/PREVSYS-LOGO-mini.png')}}" alt="logo"/></a>
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-sort-variant"></span>
          </button>
        </div>  
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown mr-4">
            <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center notification-dropdown" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="mdi mdi-bell mx-0"></i>
              <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="notificationDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
              <a class="dropdown-item">
                <div class="item-thumbnail">
                  <div class="item-icon bg-success">
                    <i class="mdi mdi-information mx-0"></i>
                  </div>
                </div>
                <div class="item-content">
                  <h6 class="font-weight-normal">Application Error</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    Just now
                  </p>
                </div>
              </a>
              <a class="dropdown-item">
                <div class="item-thumbnail">
                  <div class="item-icon bg-warning">
                    <i class="mdi mdi-settings mx-0"></i>
                  </div>
                </div>
                <div class="item-content">
                  <h6 class="font-weight-normal">Settings</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    Private message
                  </p>
                </div>
              </a>
              <a class="dropdown-item">
                <div class="item-thumbnail">
                  <div class="item-icon bg-info">
                    <i class="mdi mdi-account-box mx-0"></i>
                  </div>
                </div>
                <div class="item-content">
                  <h6 class="font-weight-normal">New user registration</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    2 days ago
                  </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              @if(empty($user_auth->photo))
                <img src="{{asset('user_images/main.png')}}" alt="profile"/>
              @else
                <img src="{{asset('user_images')}}/{{$user_auth->photo}}" alt="profile"/>
              @endif
              <span class="nav-profile-name">{{$user_auth->name}}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" href="{{url('logout')}}">
                <i class="mdi mdi-logout text-primary"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="{{route('header.index')}}">
              <i class="mdi mdi-content-paste menu-icon"></i>
              <span class="menu-title">CALENDAR</span>
            </a>
          </li> 
          <li class="nav-item">
            <a class="nav-link" href="{{route('inventories.index')}}">
              <i class="mdi mdi-barcode menu-icon"></i>
              <span class="menu-title">INVENTORY</span>
            </a>
          </li> 
          <li class="nav-item"> 
            <a class="nav-link" data-toggle="collapse" href="#setting" aria-expanded="false" aria-controls="auth">
              <i class="mdi mdi-account menu-icon"></i>
              <span class="menu-title">ADMIN SETTINGS</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="setting">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="{{route('users.index')}}">
                    <span class="menu-title">Users</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{route('companies.index')}}">
                    <span class="menu-title">Companies</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{route('frequency.index')}}">
                    <span class="menu-title">Frequencies</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{route('types.index')}}">
                    <span class="menu-title">Types</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{route('locations.index')}}">
                    <span class="menu-title">Location</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{route('departments.index')}}">
                    <span class="menu-title">Department</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{url('logout')}}">
              <i class="mdi mdi-logout menu-icon"></i>
              <span class="menu-title">LOGOUT</span>
            </a>
          </li> 
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                  <div class="mr-md-3 mr-xl-5">
                    <h2>@yield('title')</h2>
                    <p class="mb-md-0">@yield('subtitle').</p>
                  </div>
                  <div class="d-flex">
                    <i class="mdi mdi-home text-muted hover-cursor"></i>
                    <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;@yield('breadcrumbs_1')&nbsp;/&nbsp;</p>
                    <p class="text-primary mb-0 hover-cursor">@yield('breadcrumbs_2')</p>
                  </div>
                </div>
                <div class="d-flex justify-content-between align-items-end flex-wrap">
                    @yield('button')
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 stretch-card">
                @yield('main')
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © <?php echo $year;?> <a>BEVMI</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">IT DEPARTMENT <i class="mdi mdi-heart text-danger"></i></span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->

    <script src="{{asset('vendors/base/vendor.bundle.base.js')}}"></script>
    <script src="{{asset('js/jquery-3.7.1.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
  @yield('scripts')
</body>

</html>

