<?php
    echo view('templates/_header.php');
?>

<body data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": false}'>
<?php if($firstTime): ?>
<div class="se-pre-con"></div>
<?php endif; ?>
<!-- Begin page -->
<div id="wrapper">
	
	<!-- Topbar Start -->
	<div class="navbar-custom">
		<div class="container-fluid">
			<ul class="list-unstyled topnav-menu float-right mb-0">
				
				<li class="dropdown d-inline-block d-lg-none">
					<a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
						<i class="fe-search noti-icon"></i>
					</a>
					<div class="dropdown-menu dropdown-lg dropdown-menu-right p-0">
						<form class="p-3">
							<input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
						</form>
					</div>
				</li>
				<li class="dropdown d-none d-lg-inline-block">
					<a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="fullscreen" href="#">
						<i class="fe-maximize noti-icon"></i>
					</a>
				</li>
				<li class="dropdown notification-list topbar-dropdown">
					<a class="nav-link dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
						<i class="fe-bell noti-icon"></i>
<!--						<span class="badge badge-danger rounded-circle noti-icon-badge">9</span>-->
					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-lg">
						<!-- item-->
						<div class="dropdown-item noti-title">
							<h5 class="m-0">
                <span class="float-right">
                    <a href="" class="text-dark">
                        <small>Clear All</small>
                    </a>
                </span>Notification
							</h5>
						</div>
						
						<div class="noti-scroll" data-simplebar>
							
							<!-- item-->
<!--							<a href="javascript:void(0);" class="dropdown-item notify-item active">-->
<!--								<div class="notify-icon">-->
<!--									<img src="../assets/images/users/user-1.jpg" class="img-fluid rounded-circle" alt="" /> </div>-->
<!--								<p class="notify-details">Cristina Pride</p>-->
<!--								<p class="text-muted mb-0 user-msg">-->
<!--									<small>Hi, How are you? What about our next meeting</small>-->
<!--								</p>-->
<!--							</a>-->
						
						<!-- All-->
						<a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
							View all
							<i class="fe-arrow-right"></i>
						</a>
					
					</div>
				</li>
				<li class="dropdown notification-list topbar-dropdown">
					<a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
<!--						<img src="../assets/images/users/user-1.jpg" alt="user-image" class="rounded-circle">-->
						<span class="pro-user-name ml-1"><?=ucfirst($username); ?> <i class="mdi mdi-chevron-down"></i></span>
					</a>
					<div class="dropdown-menu dropdown-menu-right profile-dropdown ">
						<!-- item-->
						<div class="dropdown-header noti-title">
							<h6 class="text-overflow m-0">Welcome!</h6>
						</div>
						
						<!-- item-->
						<a href="<?=site_url('my-account')?>" class="dropdown-item notify-item">
							<i class="fe-user"></i>
							<span>My Account</span>
						</a>
						<div class="dropdown-divider"></div>
						
						<!-- item-->
						<a href="/logout" class="dropdown-item notify-item text-danger">
							<i class="fe-log-out"></i>
							<span>Logout</span>
						</a>
					
					</div>
				</li>
<!--				<li class="dropdown notification-list">-->
<!--					<a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect waves-light">-->
<!--						<i class="fe-settings noti-icon"></i>-->
<!--					</a>-->
<!--				</li>-->
			</ul>
			
			<!-- LOGO -->
			<div class="logo-box">
				<a href="/" class="logo logo-dark text-center">
          <span class="logo-sm">
            <img src="../assets/images/logo-sm.png" alt="" height="50">
            <span class="logo-lg-text-light">iGov</span>
          </span>
					<span class="logo-lg">
            <img src="../assets/images/logo-sm.png" alt="" height="50">
            <span class="logo-lg-text-light">IG</span>
          </span>
				</a>
				<a href="/" class="logo logo-light text-center">
          <span class="logo-sm">
            <img src="../assets/images/logo-sm.png" alt="" height="50">
          </span>
					<span class="logo-lg">
            <img src="../assets/images/logo-sm.png" alt="" height="50">
          </span>
				</a>
			</div>
			<ul class="list-unstyled topnav-menu topnav-menu-left m-0">
				<li>
					<button class="button-menu-mobile waves-effect waves-light">
						<i class="fe-menu"></i>
					</button>
				</li>
				<li>
					<!-- Mobile menu toggle (Horizontal Layout)-->
					<a class="navbar-toggle nav-link" data-toggle="collapse" data-target="#topnav-menu-content">
						<div class="lines">
							<span></span>
							<span></span>
							<span></span>
						</div>
					</a>
					<!-- End mobile menu toggle-->
				</li>
			</ul>
			<div class="clearfix"></div>
		</div>
	</div>
	<!-- end Topbar -->
	
	<!-- ========== Left Sidebar Start ========== -->
	<div class="left-side-menu">
		
		<div class="h-100" data-simplebar>
			
			<!-- User box -->
			<div class="user-box text-center">
<!--				<img src="../assets/images/users/user-1.jpg" alt="user-img" title="Mat Helme"-->
<!--					 class="rounded-circle avatar-md">-->
				<div class="dropdown">
					<a href="javascript: void(0);" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block"
					   data-toggle="dropdown">
            <span class="pro-user-name ml-1"><?=ucfirst($username); ?></span>
          </a>

          <div class="dropdown-menu user-pro-dropdown">
						
						<!-- item-->
						<a href="<?=site_url('my-account')?>" class="dropdown-item notify-item">
							<i class="fe-user mr-1"></i>
							<span>My Account</span>
						</a>
						
						<!-- item-->
						<a href="/logout" class="dropdown-item notify-item">
							<i class="fe-log-out mr-1"></i>
							<span>Logout</span>
						</a>
					
					</div>
				</div>
			</div>
			
			<!--- Sidemenu -->
			<div id="sidebar-menu">
				<ul id="side-menu">
					<li class="menu-title">Navigation</li>
					<li>
						<a href="/">
							<i data-feather="airplay"></i>
							<span> Dashboard </span>
						</a>
					</li>
          <li>
            <a href="#messaging" data-toggle="collapse">
              <i data-feather="message-square"></i>
              <span> e-Messaging </span>
              <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="messaging">
              <ul class="nav-second-level">
                <li><a href="<?=site_url('memos'); ?>">Memo</a></li>
                <li><a href="<?=site_url('circulars'); ?>">Circular</a></li>
                <li><a href="<?=site_url('notices')?>">Notice Board</a></li>
                <li><a href="<?= route_to('messages-in','INBOX') ?>">Email</a></li>
                <li><a href="<?= route_to('chat') ?>">Chat</a></li>
              </ul>
            </div>
          </li>
          <li>
            <a href="#office" data-toggle="collapse">
              <i data-feather="briefcase"></i>
              <span> e-Office </span>
              <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="office">
              <ul class="nav-second-level">
                <li><a href="<?=site_url('workflow-requests'); ?>">Workflow Requests</a></li>
                <li><a href="<?=site_url('tasks'); ?>">Tasks</a></li>
                <li><a href="<?=site_url('trainings')?>">Trainings</a></li>
                <li><a href="<?=site_url('correspondence')?>">Correspondence</a></li>
              </ul>
            </div>
          </li>
          <li>
            <a href="<?= route_to('manage-projects') ?>">
              <i data-feather="clipboard"></i>
              <span>Projects</span>
            </a>
          </li>
          <li>
            <a href="#procurementMenu" data-toggle="collapse">
              <i data-feather="grid"></i>

              <span> Procurement </span>
              <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="procurementMenu">
              <ul class="nav-second-level">
                <li>
                  <a href="<?= route_to('manage-vendors') ?>">Manage Vendors</a>
                </li>
                <li>
                  <a href="<?= route_to('manage-products') ?>">Manage Products</a>
                </li>
              </ul>
            </div>
          </li>
          <li>
            <a href="#fleet" data-toggle="collapse">
              <i data-feather="truck"></i>
              <span>Manage Fleet</span>
              <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="fleet">
              <ul class="nav-second-level">
                <li><a href="<?=site_url('active-vehicles')?>">Active Vehicles</a></li>
                <li><a href="<?=site_url('drivers')?>">Drivers</a></li>
                <li><a href="<?=site_url('renewal-schedules'); ?>">Renewal Schedule</a></li>
                <li><a href="<?=site_url('maintenance-schedules'); ?>">Maintenance Schedule</a></li>
                <li><a href="#">Disposed Vehicles</a></li>
              </ul>
            </div>
          </li>
          <li>
            <a href="#budget" data-toggle="collapse">
              <i data-feather="book"></i>
              <span> Finance </span>
              <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="budget">
              <ul class="nav-second-level">
                <li><a href="<?= site_url('/budget-input') ?>">Budget Chart</a></li>
              </ul>
            </div>
          </li>
          <?php if (session()->has_registry_access):?>
            <li>
              <a href="<?= site_url('registry') ?>">
                <i data-feather="inbox"></i>
                <span> Registry </span>
              </a>
            </li>
          <?php endif;?>
          <li>
            <a href="#meeting" data-toggle="collapse">
              <i data-feather="video"></i>
              <span> Meetings </span>
              <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="meeting">
              <ul class="nav-second-level">

                <li><a href="<?= site_url('/meetings') ?>">Meetings</a></li>
				 <li><a href="<?= site_url('/new-meeting') ?>">New Meeting</a></li>
              </ul>
            </div>
          </li>
          <li>
            <a href="<?= route_to('reminder') ?>">
              <i data-feather="calendar"></i>
              <span> Reminders </span>
            </a>
          </li>
          <li>
            <a href="<?= site_url('g-drive') ?>">
              <i data-feather="cloud"></i>
              <span> GDrive </span>
            </a>
          </li>

          <li>
            <a href="#settings" data-toggle="collapse">
              <i data-feather="settings"></i>
              <span> Settings </span>
              <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="settings">
              <ul class="nav-second-level">
                <li><a href="<?= site_url('/my-account') ?>">My Account</a></li>
                <li><a href="<?= site_url('/email-settings') ?>">Email Settings</a></li>
              </ul>
            </div>
          </li>
				</ul>
			</div>
			<!-- End Sidebar -->
			<div class="clearfix"></div>
		</div>
		<!-- Sidebar -left -->
	</div>
	<!-- Left Sidebar End -->
	<!-- ============================================================== -->
	<!-- Start Page Content here -->
	<!-- ============================================================== -->
	<div class="content-page">
		<div class="content">
			<!-- Start Content-->
			<?= $this->renderSection('content') ?>
		</div> <!-- content -->
		<!-- Footer Start -->
		<footer class="footer">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-6">
						Copyright <script>document.write(new Date().getFullYear())</script> &copy; iGov. Powered by <a href="https://telecom.connexxiongroup.com" target="_blank">Connexxion Telecom</a>
					</div>
					<div class="col-md-6">
						<div class="text-md-right footer-links d-none d-sm-block">
							<a href="https://telecom.connexxiongroup.com/contact-us">Contact Us</a>
						</div>
					</div>
				</div>
			</div>
		</footer>
		<!-- end Footer -->
	
	</div>
	
	<!-- ============================================================== -->
	<!-- End Page content -->
	<!-- ============================================================== -->


</div>
<!-- END wrapper -->

<!-- Right Sidebar -->
<div class="right-bar">
	<div data-simplebar class="h-100">
		<!-- Nav tabs -->
		<ul class="nav nav-tabs nav-bordered nav-justified" role="tablist">
			<li class="nav-item">
				<a class="nav-link py-2 active" data-toggle="tab" href="#settings-tab" role="tab">
					<i class="mdi mdi-cog-outline d-block font-22 my-1"></i>
				</a>
			</li>
		</ul>
		<!-- Tab panes -->
		<div class="tab-content pt-0">
			<div class="tab-pane active" id="settings-tab" role="tabpanel">
				<h6 class="font-weight-medium px-3 m-0 py-2 font-13 text-uppercase bg-light">
					<span class="d-block py-1">Theme Settings</span>
				</h6>
				
				<div class="p-3">
					<div class="alert alert-warning" role="alert">
						<strong>Customize </strong> the overall color scheme, sidebar menu, etc.
					</div>
					
					<h6 class="font-weight-medium font-14 mt-4 mb-2 pb-1">Color Scheme</h6>
					<div class="custom-control custom-switch mb-1">
						<input type="radio" class="custom-control-input" name="color-scheme-mode" value="light"
							   id="light-mode-check" checked />
						<label class="custom-control-label" for="light-mode-check">Light Mode</label>
					</div>
					
					<div class="custom-control custom-switch mb-1">
						<input type="radio" class="custom-control-input" name="color-scheme-mode" value="dark"
							   id="dark-mode-check" />
						<label class="custom-control-label" for="dark-mode-check">Dark Mode</label>
					</div>
					
					<!-- Width -->
					<h6 class="font-weight-medium font-14 mt-4 mb-2 pb-1">Width</h6>
					<div class="custom-control custom-switch mb-1">
						<input type="radio" class="custom-control-input" name="width" value="fluid" id="fluid-check" checked />
						<label class="custom-control-label" for="fluid-check">Fluid</label>
					</div>
					<div class="custom-control custom-switch mb-1">
						<input type="radio" class="custom-control-input" name="width" value="boxed" id="boxed-check" />
						<label class="custom-control-label" for="boxed-check">Boxed</label>
					</div>
					
					<!-- Menu positions -->
					<h6 class="font-weight-medium font-14 mt-4 mb-2 pb-1">Menus (Leftsidebar and Topbar) Positon</h6>
					
					<div class="custom-control custom-switch mb-1">
						<input type="radio" class="custom-control-input" name="menus-position" value="fixed" id="fixed-check"
							   checked />
						<label class="custom-control-label" for="fixed-check">Fixed</label>
					</div>
					
					<div class="custom-control custom-switch mb-1">
						<input type="radio" class="custom-control-input" name="menus-position" value="scrollable"
							   id="scrollable-check" />
						<label class="custom-control-label" for="scrollable-check">Scrollable</label>
					</div>
					
					<!-- Left Sidebar-->
					<h6 class="font-weight-medium font-14 mt-4 mb-2 pb-1">Left Sidebar Color</h6>
					
					<div class="custom-control custom-switch mb-1">
						<input type="radio" class="custom-control-input" name="leftsidebar-color" value="light" id="light-check" checked />
						<label class="custom-control-label" for="light-check">Light</label>
					</div>
					
					<div class="custom-control custom-switch mb-1">
						<input type="radio" class="custom-control-input" name="leftsidebar-color" value="dark" id="dark-check" />
						<label class="custom-control-label" for="dark-check">Dark</label>
					</div>
					
					<div class="custom-control custom-switch mb-1">
						<input type="radio" class="custom-control-input" name="leftsidebar-color" value="brand" id="brand-check" />
						<label class="custom-control-label" for="brand-check">Brand</label>
					</div>
					
					<div class="custom-control custom-switch mb-3">
						<input type="radio" class="custom-control-input" name="leftsidebar-color" value="gradient" id="gradient-check" />
						<label class="custom-control-label" for="gradient-check">Gradient</label>
					</div>
					
					<!-- size -->
					<h6 class="font-weight-medium font-14 mt-4 mb-2 pb-1">Left Sidebar Size</h6>
					
					<div class="custom-control custom-switch mb-1">
						<input type="radio" class="custom-control-input" name="leftsidebar-size" value="default"
							   id="default-size-check" checked />
						<label class="custom-control-label" for="default-size-check">Default</label>
					</div>
					
					<div class="custom-control custom-switch mb-1">
						<input type="radio" class="custom-control-input" name="leftsidebar-size" value="condensed"
							   id="condensed-check" />
						<label class="custom-control-label" for="condensed-check">Condensed <small>(Extra Small size)</small></label>
					</div>
					
					<div class="custom-control custom-switch mb-1">
						<input type="radio" class="custom-control-input" name="leftsidebar-size" value="compact"
							   id="compact-check" />
						<label class="custom-control-label" for="compact-check">Compact <small>(Small size)</small></label>
					</div>
					
					<!-- User info -->
					<h6 class="font-weight-medium font-14 mt-4 mb-2 pb-1">Sidebar User Info</h6>
					
					<div class="custom-control custom-switch mb-1">
						<input type="checkbox" class="custom-control-input" name="leftsidebar-user" value="fixed" id="sidebaruser-check" />
						<label class="custom-control-label" for="sidebaruser-check">Enable</label>
					</div>
					
					
					<!-- Topbar -->
					<h6 class="font-weight-medium font-14 mt-4 mb-2 pb-1">Topbar</h6>
					
					<div class="custom-control custom-switch mb-1">
						<input type="radio" class="custom-control-input" name="topbar-color" value="dark" id="darktopbar-check"
							   checked />
						<label class="custom-control-label" for="darktopbar-check">Dark</label>
					</div>
					
					<div class="custom-control custom-switch mb-1">
						<input type="radio" class="custom-control-input" name="topbar-color" value="light" id="lighttopbar-check" />
						<label class="custom-control-label" for="lighttopbar-check">Light</label>
					</div>
					
					
					<button class="btn btn-primary btn-block mt-4" id="resetBtn">Reset to Default</button>
					
					<a href="https://1.envato.market/uboldadmin"
					   class="btn btn-danger btn-block mt-3" target="_blank"><i class="mdi mdi-basket mr-1"></i> Purchase Now</a>
				
				</div>
			
			</div>
		</div>
	</div> <!-- end slimscroll-menu-->
</div>
<!-- /Right-bar -->
	
	
	
	
	
<?php echo view('templates/_footer'); ?>
