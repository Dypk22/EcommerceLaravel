<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from gambolthemes.net/html-items/gambo_admin/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 23 Jun 2021 07:53:08 GMT -->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description-gambolthemes" content="">
<meta name="author-gambolthemes" content="">
<title>Gambo Supermarket Admin</title>
<link href="{{asset('admin_assets/css/styles.css')}}" rel="stylesheet">
<link href="{{asset('admin_assets/css/admin-style.css')}}" rel="stylesheet">

<link href="{{asset('admin_assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('admin_assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
</head>
<body class="bg-sign">
<div id="layoutAuthentication">
<div id="layoutAuthentication_content">
<main>
<div class="container">
<div class="row justify-content-center">
<div class="col-lg-5">
<div class="card shadow-lg border-0 rounded-lg mt-5">
<div class="card-header card-sign-header">
<h3 class="text-center font-weight-light my-4">Login</h3>
</div>
<div class="card-body">
<form action="{{route('admin.auth')}}" method="post">
@csrf
<div class="form-group">
<label class="form-label" for="inputEmailAddress">Email*</label>
<input class="form-control py-3" id="inputEmailAddress" name="email" required="" type="email" placeholder="Enter email address">
</div>
<div class="form-group">
<label class="form-label" for="inputPassword">Password*</label>
<input class="form-control py-3" id="inputPassword" type="password" name="password" required="" placeholder="Enter password">
</div>
<div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
<button type="submit" class="btn btn-sign hover-btn">Login <i class="fas fa-sign-in-alt"></i></button>
</div>
@if(session()->has('error'))
                                <div class="alert mt-3 alert-danger alert-dismissible fade show">
                                    {{session('error')}}  
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div> 
                                @endif 	
</form>
</div>
</div>
</div>
</div>
</div>
</main>
</div>
</div>
<script src="{{asset('admin_assets/js/jquery-3.4.1.min.js')}}"></script>
<script src="{{asset('admin_assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('admin_assets/js/scripts.js')}}"></script>
</body>

<!-- Mirrored from gambolthemes.net/html-items/gambo_admin/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 23 Jun 2021 07:53:08 GMT -->
</html>
