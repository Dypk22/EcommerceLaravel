<!DOCTYPE html>
<html lang="en">
   <!-- Mirrored from gambolthemes.net/html-items/gambo_admin/index by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 23 Jun 2021 07:51:23 GMT -->
   <head>
      <!-- Favicon Icon -->
      <link rel="icon" type="image/png" href="{{asset('admin_assets/images/fav.png')}}">
   
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description-gambolthemes" content="">
      <meta name="author-gambolthemes" content="">
      <title>@yield('page_title')</title>
      <link href="{{asset('admin_assets/css/styles.css')}}" rel="stylesheet">
      <link href="{{asset('admin_assets/css/admin-style.css')}}" rel="stylesheet">
      <link href="{{asset('admin_assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
      <link href="{{asset('admin_assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
   </head>
   <body class="sb-nav-fixed">
      <nav class="sb-topnav navbar navbar-expand navbar-light bg-clr">
         <a class="navbar-brand logo-brand" href="/admin">{{Config::get('constants.site_name')}}</a>
         <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
         <a href="https://gambolthemes.net/html-items/gambo_supermarket_demo/index" class="frnt-link"><i class="fas fa-external-link-alt"></i>Home</a>
         <ul class="navbar-nav ml-auto mr-md-0">
            <li class="nav-item dropdown">
               <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
               <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                  <a class="dropdown-item admin-dropdown-item" href="edit_profile">Edit Profile</a>
                  <a class="dropdown-item admin-dropdown-item" href="change_password">Change Password</a>
                  <a class="dropdown-item admin-dropdown-item" href="{{url('admin/logout')}}">Logout</a>
               </div>
            </li>
         </ul>
      </nav>
      <div id="layoutSidenav">
         <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
               <div class="sb-sidenav-menu">
                  <div class="nav">
                     <a class="nav-link @yield('home_active')" href="/admin">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                     </a>
                     <a class="nav-link @yield('categories_active') collapsed" href="javascript::void(0)" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-newspaper"></i></div>
                        Categories
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                     </a>
                     <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                           <a class="nav-link sub_nav_link" href="{{url('/admin/category')}}">See All</a>
                           <a class="nav-link sub_nav_link" href="{{url('/admin/category/manage-category')}}">Add New</a>
                           <!-- <a class="nav-link sub_nav_link" href="post_categories">Categories</a> -->
                           <!-- <a class="nav-link sub_nav_link" href="post_tags">Tags</a> -->
                        </nav>
                     </div>
                     <a class="nav-link @yield('sub_categories_active') collapsed" href="javascript::void(0)" data-toggle="collapse" data-target="#collapseLocations" aria-expanded="false" aria-controls="collapseLocations">
                        <div class="sb-nav-link-icon"><i class="fas fa-map-marker-alt"></i></div>
                        Sub Category
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                     </a>
                     <div class="collapse" id="collapseLocations" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                           <a class="nav-link sub_nav_link" href="{{url('/admin/sub-category')}}">See All</a>
                           <a class="nav-link sub_nav_link" href="{{url('/admin/sub-category/manage-sub-category')}}">Add New</a>
                        </nav>
                     </div>
                     <!-- <a class="nav-link @yield('orders_active') collapsed" href="javascript::void(0)" data-toggle="collapse" data-target="#collapseAreas" aria-expanded="false" aria-controls="collapseAreas">
                        <div class="sb-nav-link-icon"><i class="fas fa-map-marked-alt"></i></div>
                        Orders
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                     </a>
                     <div class="collapse" id="collapseAreas" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                           <a class="nav-link sub_nav_link" href="{{url('/admin/orders')}}">All Orders</a>
                        </nav>
                     </div>-->
                     <a class="nav-link @yield('categories_active') collapsed" data-toggle="collapse" data-target="#collapseCategories" aria-expanded="false" aria-controls="collapseCategories">
                        <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                        Categories
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                     </a>
                     <div class="collapse" id="collapseCategories" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                           <a class="nav-link sub_nav_link" href="{{url('admin/category/')}}">All Categories</a>
                           <a class="nav-link sub_nav_link" href="{{url('admin/category/manage-category/')}}">Add Category</a>
                        </nav>
                     </div>
                     <a class="nav-link @yield('shops_active') collapsed" href="#" data-toggle="collapse" data-target="#collapseShops" aria-expanded="false" aria-controls="collapseShops">
                        <div class="sb-nav-link-icon"><i class="fas fa-store"></i></div>
                        Shops
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                     </a>
                     <div class="collapse" id="collapseShops" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                           <a class="nav-link sub_nav_link" href="shops">All Shops</a>
                           <a class="nav-link sub_nav_link" href="add_shop">Add Shop</a>
                        </nav>
                     </div>
                     <a class="nav-link @yield('products_active') collapsed" href="javascript::void(0)" data-toggle="collapse" data-target="#collapseProducts" aria-expanded="false" aria-controls="collapseProducts">
                        <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                        Products
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                     </a>
                     <div class="collapse" id="collapseProducts" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                           <a class="nav-link sub_nav_link" href="{{url('/admin/products')}}">All Products</a>
                           <a class="nav-link sub_nav_link" href="{{url('/admin/products/manage-products')}}">Add Product</a>
                        </nav>
                     </div>
                     <a class="nav-link @yield('orders_active')" href="{{url('/admin/orders')}}">
                        <div class="sb-nav-link-icon"><i class="fas fa-cart-arrow-down"></i></div>
                        Orders
                     </a>
                     <a class="nav-link" href="customers">
                        <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                        Customers
                     </a>
                     <a class="nav-link" href="offers">
                        <div class="sb-nav-link-icon"><i class="fas fa-gift"></i></div>
                        Offers
                     </a>
                     <a class="nav-link" href="pages">
                        <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                        Pages
                     </a>
                     <a class="nav-link" href="menu">
                        <div class="sb-nav-link-icon"><i class="fas fa-layer-group"></i></div>
                        Menu
                     </a>
                     <a class="nav-link" href="updater">
                        <div class="sb-nav-link-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                        Updater
                     </a>
                     <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSettings" aria-expanded="false" aria-controls="collapseSettings">
                        <div class="sb-nav-link-icon"><i class="fas fa-cog"></i></div>
                        Setting
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                     </a>
                     <div class="collapse" id="collapseSettings" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                           <a class="nav-link sub_nav_link" href="general_setting">General Settings</a>
                           <a class="nav-link sub_nav_link" href="payment_setting">Payment Settings</a>
                           <a class="nav-link sub_nav_link" href="email_setting">Email Settings</a>
                        </nav>
                     </div>
                     <a class="nav-link" href="reports">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-bar"></i></div>
                        Reports
                     </a>
                  </div>
               </div>
            </nav>
         </div>
         <div id="layoutSidenav_content">
            @section('container')
            @show
            <footer class="py-4 bg-footer mt-auto">
               <div class="container-fluid">
                  <div class="d-flex align-items-center footer-links justify-content-between small">
                     <?php $year=date('Y'); $final_year=substr( $year, -2); ?>
                     <div class="text-muted-1">© 2020-<?php echo $final_year; ?> <b>Grockart Supermarket</b>. by <a href="http://officialdypknawani.freesite.vip/" target="_blank">Dypk Nawani</a></div>
                     <div class="footer-links">
                        <a href="{{url('/privacy-policy')}}">Privacy Policy</a>
                        <a href="{{url('/term-conditions')}}">Terms &amp; Conditions</a>
                     </div>
                  </div>
               </div>
            </footer>
         </div>
      </div>
      <script src="{{asset('admin_assets/js/jquery-3.4.1.min.js')}}"></script>
      <script src="{{asset('admin_assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
      <script src="{{asset('admin_assets/vendor/chart/highcharts.js')}}"></script>
      <script src="{{asset('admin_assets/vendor/chart/exporting.js')}}"></script>
      <script src="{{asset('admin_assets/vendor/chart/export-data.js')}}"></script>
      <script src="{{asset('admin_assets/vendor/chart/accessibility.js')}}"></script>
      <script src="{{asset('admin_assets/js/scripts.js')}}"></script>
      <script src="{{asset('admin_assets/js/chart.js')}}"></script>
      <script src="{{asset('admin_assets/js/main.js')}}"></script>
   </body>
   <!-- Mirrored from gambolthemes.net/html-items/gambo_admin/index by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 23 Jun 2021 07:52:11 GMT -->
</html>