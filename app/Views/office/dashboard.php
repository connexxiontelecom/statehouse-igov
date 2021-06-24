<?= 
    $this->extend('layouts/admin')
?>




<?= $this->section('content') ?>


<div class="container-fluid">
	
	<!-- start page title -->
	<div class="row">
		<div class="col-12">
			<div class="page-title-box">
				<div class="page-title-right">
					<form class="form-inline">
						<div class="form-group">
							<div class="input-group input-group-sm">
								<input type="text" class="form-control border" id="dash-daterange">
								<div class="input-group-append">
                                                        <span class="input-group-text bg-blue border-blue text-white">
                                                            <i class="mdi mdi-calendar-range"></i>
                                                        </span>
								</div>
							</div>
						</div>
						<a href="javascript: void(0);" class="btn btn-blue btn-sm ml-2">
							<i class="mdi mdi-autorenew"></i>
						</a>
						<a href="javascript: void(0);" class="btn btn-blue btn-sm ml-1">
							<i class="mdi mdi-filter-variant"></i>
						</a>
					</form>
				</div>
				<h4 class="page-title">iGov Administrator</h4>
			</div>
		</div>
	</div>
	<!-- end page title -->
	
	<div class="row">
		<div class="well col-md-4 col-xl-3">
			<div class="card-box bg-pattern">
				<div class="text-center">
					<img src="/assets/images/users/user-1.jpg" alt="logo" class="avatar-xl rounded-circle mb-3">
					<h4 class="mb-1 font-20">Good Morning, </h4>
					<p class="text-muted  font-14">Auta</p>
				</div>
				
				<p class="font-14 text-center text-muted">
					Maitama, Federal Capital Territory
				</p>
				
				<div class="text-center">
					<a href="javascript:void(0);" class="btn btn-sm btn-light">View more info</a>
				</div>
				
				
			</div> <!-- end card-box -->
		</div> <!-- end col-->
		
		<div class="well col-md-4 col-xl-3">
			<div class="card-box ribbon-box">
				<div class="ribbon ribbon-primary float-right"><i class="mdi mdi-access-point mr-1"></i> Activity Stream</div>
				
				<div class="ribbon-content">
					<p class="mb-0">Quisque nec turpis at urna dictum luctus. Suspendisse convallis dignissim eros at volutpat. In egestas
						mattis dui. Aliquam mattis dictum aliquet. Nulla sapien mauris, eleifend et sem ac, commodo dapibus odio.</p>
				</div>
			</div>
		</div> <!-- end col-->
		
		
		<div class="well col-md-4 col-xl-3" >
			<div class="card-box ribbon-box">
				<div class="ribbon ribbon-primary float-right"><i class="mdi mdi-access-point mr-1"></i> Notice Board</div>
				
				<div class="ribbon-content">
					<p class="mb-0">Quisque nec turpis at urna dictum luctus. Suspendisse convallis dignissim eros at volutpat. In egestas
						mattis dui. Aliquam mattis dictum aliquet. Nulla sapien mauris, eleifend et sem ac, commodo dapibus odio.</p>
				</div>
			</div>
		</div> <!-- end col-->
	
	</div>
	<!-- end row-->
	
	<div class="row">
		
		<div class="well col-md-4 col-xl-3">
			<div class="card-box">
				
					
					
					<h6 class="font-13 text-muted text-uppercase mb-2">Events</h6>
					<div data-simplebar style="max-height: 300px">
						<a href="javascript:void(0);" class="text-body">
							<div class="media p-2">
								<img src="../assets/images/users/user-2.jpg" class="mr-2 rounded-circle" height="42" alt="Brandon Smith" />
								<div class="media-body">
									<h5 class="mt-0 mb-0 font-14">
										<span class="float-right text-muted font-weight-normal font-12">4:30am</span>
										Brandon Smith
									</h5>
									<p class="mt-1 mb-0 text-muted font-14">
										<span class="w-25 float-right text-right"><span class="badge badge-soft-danger">3</span></span>
										<span class="w-75">How are you today?</span>
									</p>
								</div>
							</div>
						</a>
						
						<a href="javascript:void(0);" class="text-body">
							<div class="media p-2">
								<img src="../assets/images/users/user-5.jpg" class="mr-2 rounded-circle" height="42" alt="James Z" />
								<div class="media-body">
									<h5 class="mt-0 mb-0 font-14">
										<span class="float-right text-muted font-weight-normal font-12">5:30am</span>
										James Z
									</h5>
									<p class="mt-1 mb-0 text-muted font-14">
										<span class="w-75">Hey! a reminder for tomorrow's meeting...</span>
									</p>
								</div>
							</div>
						</a>
						
						<a href="javascript:void(0);" class="text-body">
							<div class="media p-2">
								<img src="../assets/images/users/user-7.jpg" class="mr-2 rounded-circle" height="42" alt="Maria C" />
								<div class="media-body">
									<h5 class="mt-0 mb-0 font-14">
										<span class="float-right text-muted font-weight-normal font-12">Thu</span>
										Maria C
									</h5>
									<p class="mt-1 mb-0 text-muted font-14">
										<span class="w-25 float-right text-right"><span class="badge badge-soft-danger">2</span></span>
										<span class="w-75">Are we going to have this week's planning meeting today?</span>
									</p>
								</div>
							</div>
						</a>
						
						<a href="javascript:void(0);" class="text-body">
							<div class="media bg-light p-2">
								<img src="../assets/images/users/user-10.jpg"
									 class="mr-2 rounded-circle" height="42" alt="Rhonda D" />
								<div class="media-body">
									<h5 class="mt-0 mb-0 font-14">
										<span class="float-right text-muted font-weight-normal font-12">Wed</span>
										Rhonda D
									</h5>
									<p class="mt-1 mb-0 text-muted font-14">
										<span class="w-75">Please check these design assets...</span>
									</p>
								</div>
							</div>
						</a>
						
						<a href="javascript:void(0);" class="text-body">
							<div class="media p-2">
								<img src="../assets/images/users/user-3.jpg"
									 class="mr-2 rounded-circle" height="42" alt="Michael H" />
								<div class="media-body">
									<h5 class="mt-0 mb-0 font-14">
										<span class="float-right text-muted font-weight-normal font-12">Tue</span>
										Michael H
									</h5>
									<p class="mt-1 mb-0 text-muted font-14">
										<span class="w-75">Are you free for 15 min? I would like to discuss something...</span>
									</p>
								</div>
							</div>
						</a>
						
						<a href="javascript:void(0);" class="text-body">
							<div class="media p-2">
								<img src="../assets/images/users/user-6.jpg"
									 class="mr-2 rounded-circle" height="42" alt="Thomas R" />
								<div class="media-body">
									<h5 class="mt-0 mb-0 font-14">
										<span class="float-right text-muted font-weight-normal font-12">Tue</span>
										Thomas R
									</h5>
									<p class="mt-1 mb-0 text-muted font-14">
										<span class="w-75">Let's have meeting today between me, you and Tony...</span>
									</p>
								</div>
							</div>
						</a>
						
						<a href="javascript:void(0);" class="text-body">
							<div class="media p-2">
								<img src="../assets/images/users/user-8.jpg"
									 class="mr-2 rounded-circle" height="42" alt="Thomas J" />
								<div class="media-body">
									<h5 class="mt-0 mb-0 font-14">
										<span class="float-right text-muted font-weight-normal font-12">Tue</span>
										Thomas J
									</h5>
									<p class="mt-1 mb-0 text-muted font-14">
										<span class="w-75">Howdy?</span>
									</p>
								</div>
							</div>
						</a>
						
						<a href="javascript:void(0);" class="text-body">
							<div class="media p-2">
								<img src="../assets/images/users/user-4.jpg"
									 class="mr-2 rounded-circle" height="42" alt="Ricky J" />
								<div class="media-body">
									<h5 class="mt-0 mb-0 font-14">
										<span class="float-right text-muted font-weight-normal font-12">Mon</span>
										Ricky J
									</h5>
									<p class="mt-1 mb-0 text-muted font-14">
										<span class="w-75">Are you interested in learning?</span>
									</p>
								</div>
							</div>
						</a>
					
					</div> <!-- end slimscroll-->
					
			
			</div>
		</div> <!-- end col-->
		
		<div class="well col-md-4 col-xl-3">
			<div class="card-box ribbon-box">
				<div class="ribbon ribbon-primary float-right"><i class="mdi mdi-access-point mr-1"></i> Feedback</div>
				
				<div class="ribbon-content">
				
				</div>
			</div>
		</div> <!-- end col-->
		
		


		<div class="well col-md-4 col-xl-3">
			<div class="card-box">
				<h6 class="font-13 text-muted text-uppercase mb-2">Chats</h6>
				<div data-simplebar style="max-height: 300px">
					<a href="javascript:void(0);" class="text-body">
						<div class="media p-2">
							<img src="../assets/images/users/user-2.jpg" class="mr-2 rounded-circle" height="42" alt="Brandon Smith" />
							<div class="media-body">
								<h5 class="mt-0 mb-0 font-14">
									<span class="float-right text-muted font-weight-normal font-12">4:30am</span>
									Brandon Smith
								</h5>
								<p class="mt-1 mb-0 text-muted font-14">
									<span class="w-25 float-right text-right"><span class="badge badge-soft-danger">3</span></span>
									<span class="w-75">How are you today?</span>
								</p>
							</div>
						</div>
					</a>
					
					<a href="javascript:void(0);" class="text-body">
						<div class="media p-2">
							<img src="../assets/images/users/user-5.jpg" class="mr-2 rounded-circle" height="42" alt="James Z" />
							<div class="media-body">
								<h5 class="mt-0 mb-0 font-14">
									<span class="float-right text-muted font-weight-normal font-12">5:30am</span>
									James Z
								</h5>
								<p class="mt-1 mb-0 text-muted font-14">
									<span class="w-75">Hey! a reminder for tomorrow's meeting...</span>
								</p>
							</div>
						</div>
					</a>
					
					<a href="javascript:void(0);" class="text-body">
						<div class="media p-2">
							<img src="../assets/images/users/user-7.jpg" class="mr-2 rounded-circle" height="42" alt="Maria C" />
							<div class="media-body">
								<h5 class="mt-0 mb-0 font-14">
									<span class="float-right text-muted font-weight-normal font-12">Thu</span>
									Maria C
								</h5>
								<p class="mt-1 mb-0 text-muted font-14">
									<span class="w-25 float-right text-right"><span class="badge badge-soft-danger">2</span></span>
									<span class="w-75">Are we going to have this week's planning meeting today?</span>
								</p>
							</div>
						</div>
					</a>
					
					<a href="javascript:void(0);" class="text-body">
						<div class="media bg-light p-2">
							<img src="../assets/images/users/user-10.jpg"
								 class="mr-2 rounded-circle" height="42" alt="Rhonda D" />
							<div class="media-body">
								<h5 class="mt-0 mb-0 font-14">
									<span class="float-right text-muted font-weight-normal font-12">Wed</span>
									Rhonda D
								</h5>
								<p class="mt-1 mb-0 text-muted font-14">
									<span class="w-75">Please check these design assets...</span>
								</p>
							</div>
						</div>
					</a>
					
					<a href="javascript:void(0);" class="text-body">
						<div class="media p-2">
							<img src="../assets/images/users/user-3.jpg"
								 class="mr-2 rounded-circle" height="42" alt="Michael H" />
							<div class="media-body">
								<h5 class="mt-0 mb-0 font-14">
									<span class="float-right text-muted font-weight-normal font-12">Tue</span>
									Michael H
								</h5>
								<p class="mt-1 mb-0 text-muted font-14">
									<span class="w-75">Are you free for 15 min? I would like to discuss something...</span>
								</p>
							</div>
						</div>
					</a>
					
					<a href="javascript:void(0);" class="text-body">
						<div class="media p-2">
							<img src="../assets/images/users/user-6.jpg"
								 class="mr-2 rounded-circle" height="42" alt="Thomas R" />
							<div class="media-body">
								<h5 class="mt-0 mb-0 font-14">
									<span class="float-right text-muted font-weight-normal font-12">Tue</span>
									Thomas R
								</h5>
								<p class="mt-1 mb-0 text-muted font-14">
									<span class="w-75">Let's have meeting today between me, you and Tony...</span>
								</p>
							</div>
						</div>
					</a>
					
					<a href="javascript:void(0);" class="text-body">
						<div class="media p-2">
							<img src="../assets/images/users/user-8.jpg"
								 class="mr-2 rounded-circle" height="42" alt="Thomas J" />
							<div class="media-body">
								<h5 class="mt-0 mb-0 font-14">
									<span class="float-right text-muted font-weight-normal font-12">Tue</span>
									Thomas J
								</h5>
								<p class="mt-1 mb-0 text-muted font-14">
									<span class="w-75">Howdy?</span>
								</p>
							</div>
						</div>
					</a>
					
					<a href="javascript:void(0);" class="text-body">
						<div class="media p-2">
							<img src="../assets/images/users/user-4.jpg"
								 class="mr-2 rounded-circle" height="42" alt="Ricky J" />
							<div class="media-body">
								<h5 class="mt-0 mb-0 font-14">
									<span class="float-right text-muted font-weight-normal font-12">Mon</span>
									Ricky J
								</h5>
								<p class="mt-1 mb-0 text-muted font-14">
									<span class="w-75">Are you interested in learning?</span>
								</p>
							</div>
						</div>
					</a>
				
				</div> <!-- end slimscroll-->
			</div>
		</div> <!-- end col-->
	
	</div>
	<!-- end row-->

</div> <!-- container -->


<?= $this->endSection() ?>
