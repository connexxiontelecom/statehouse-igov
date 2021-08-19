<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>iGov </title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta content="" name="description" />
	<meta content="Connexxion Telecom" name="author" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<!-- App favicon -->
	<link rel="shortcut icon" href="/assetsa/images/favicon.ico">
	
	<!-- App css -->
	<link href="/assetsa/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
	<link href="/assetsa/css/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />
	
	<link href="/assetsa/css/bootstrap-dark.min.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" disabled />
	<link href="/assetsa/css/app-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet"  disabled />
	
	<!-- icons -->
	<link href="/assetsa/css/icons.min.css" rel="stylesheet" type="text/css" />

</head>

<body class="auth-fluid-pages pb-0">

<div class="auth-fluid">
	<!--Auth fluid left content -->
	<div class="auth-fluid-form-box">
		<div class="align-items-center d-flex h-100">
			<div class="card-body">
				
				<!-- Logo -->
				<div class="justify-content-center">
					<div class="auth-logo">
						<a href="<?=site_url('office') ?>" class="logo logo-dark text-center">
                                    <span class="logo-lg">
                                        <img src="/assetsa/images/logo-sm.png" alt="" height="200">
                                    </span>
						</a>
						
						<a href="<?=site_url('office') ?>" class="logo logo-light text-center">
                                    <span class="logo-lg">
                                        <img src="/assetsa/images/logo-sm.png" alt="" height="200">
                                    </span>
						</a>
					</div>
				</div>
				
				<div class="row justify-content-center">
					<div class="col-12">
						<div class="error-text-box">
							<svg viewBox="0 0 600 200">
								<!-- Symbol-->
								<symbol id="s-text">
									<text text-anchor="middle" x="50%" y="50%" dy=".35em">404!</text>
								</symbol>
								<!-- Duplicate symbols-->
								<use class="text" xlink:href="#s-text"></use>
								<use class="text" xlink:href="#s-text"></use>
								<use class="text" xlink:href="#s-text"></use>
								<use class="text" xlink:href="#s-text"></use>
								<use class="text" xlink:href="#s-text"></use>
							</svg>
						</div>
						<div class="text-center">
							<h3 class="mt-0 mb-2">Whoops! Page not found </h3>
							<p class="text-muted mb-3">It's looking like you may have taken a wrong turn. Don't worry...
								it happens to the best of us. You might want to check your internet connection.
								Here's a little tip that might help you get back on track.</p>
							
							<a href="<?=site_url('office') ?>" class="btn btn-success waves-effect waves-light">Back to Dashboard</a>
						</div>
						<!-- end row -->
					
					</div> <!-- end col -->
				</div>
				<!-- end row -->
				
				<!-- Footer-->
				<footer class="footer footer-alt">
					<p class="text-muted">2021 - <script>document.write(new Date().getFullYear())</script> &copy; iGov by <a href="javascript: void(0);" class="text-muted">Connexxion Telecom</a> </p>
				</footer>
			
			</div> <!-- end .card-body -->
		</div> <!-- end .align-items-center.d-flex.h-100-->
	</div>
	<!-- end auth-fluid-form-box-->
	
	<!-- Auth fluid right content -->
	<div class="auth-fluid-right text-center">
	</div>
	<!-- end Auth fluid right content -->
</div>
<!-- end auth-fluid-->

<!-- Vendor js -->
<script src="/assetsa/js/vendor.min.js"></script>

<!-- App js -->
<script src="/assetsa/js/app.min.js"></script>

</body>
</html>
