<?= $this->extend('layouts/master') ?>
<?= $this->section('extra-styles') ?>
<link rel="stylesheet" href="/vendors/index.css">
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="container-fluid">
	
	
	<!-- start page title -->
	<div class="row">
		<div class="col-12">
			<div class="page-title-box">
				<div class="page-title-right">
					<ol class="breadcrumb m-0">
						<li class="breadcrumb-item"><a href="<?= site_url() ?>">iGov</a></li>
						<li class="breadcrumb-item"><a href="<?=site_url('meetings') ?>">Meetings</a></li>
						<li class="breadcrumb-item active">Join Meeting</li>
					</ol>
				</div>
				<h4 class="page-title"> Meeting</h4>
			</div>
		</div>
	</div>
	<!-- end page title -->
	
	
	<div class="row" style="background-color: black">
		<div class="col-sm-12"  style="background-color: black">
			<div class="card"  style="background-color: black">
				<div class="card-body"  style="background-color: black">
					
					<div class="row"  style="background-color: black">
						<div class="col-xl-12">
							
							
							<div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
								<strong>Congratulations!</strong><span> You can invite others join this channel by click </span><a href="" target="_blank">here</a>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div id="success-alert-with-token" class="alert alert-success alert-dismissible fade show" role="alert">
								<strong>Congratulations!</strong><span> Joined room successfully. </span>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div id="success-alert-with-token" class="alert alert-success alert-dismissible fade show" role="alert">
								<strong>Congratulations!</strong><span> Joined room successfully. </span>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							
							<div class="container">
								<form id="join-form">
									<div class="row join-info-group">
										<div class="col-sm">
										
											<input id="appid" type="hidden" value="<?=$app_id ?>" placeholder="enter appid" required>
														</div>
										<div class="col-sm">
											
											<input id="token" type="hidden" value="<?=$token ?>" placeholder="enter token">
														</div>
										<div class="col-sm">
											
											<input id="channel" type="hidden" value="<?=$channel ?>" placeholder="enter channel name" required>
														</div>
									</div>
									
									<div class="button-group">
										<button id="join" type="submit" class="btn btn-primary btn-sm">Join</button>
										<button id="leave" type="button" class="btn btn-primary btn-sm" disabled>Leave</button>
									</div>
								</form>
								<input type="hidden" id="user-name" value="<?=$user_name; ?>">
								
								<div class="card video-group" style="background-color:black">
									<div class="card-body" style="margin-left: 3%;">
										<div class="row">
											<div class="col-sm-4">
												<div class="col" >
													<p id="local-player-name" class="player-name"></p>
													<div id="local-player" class="player" style="margin-left: -50px"></div>
													<button id="share" onclick="shareScreen()" type="button" class="btn btn-primary btn-sm">Share</button>
													<button id="stopshare" onclick="stopShare()" type="button" class="btn btn-primary btn-sm">Stop Share</button>
												
												</div>
											</div>
											<div class="col">
												<div class="col">
													<div id="remote-playerlist" style="margin-left: 150px"></div>
												</div>
											</div>
										</div>
									</div>
								
									
									<div class="w-100"></div>
									
								</div>
							</div>
						
						</div> <!-- end col -->
					</div> <!-- end row -->
				
				
				</div> <!-- end card-body -->
			</div> <!-- end card-->
		
		</div> <!-- end col -->
	</div>

</div>



<!-- Long Content Scroll Modal -->

<?= $this->endSection() ?>
<?= $this->section('extra-scripts') ?>

<!--<script src="/assets/js/pages/sweet-alerts.init.js"></script>-->
<script src="/vendors/jquery-3.4.1.min.js"></script>
<script src="/vendors/bootstrap.bundle.min.js"></script>
<script src="/vendors/AgoraRTC_N-4.6.3.js"></script>
<script>
	var user_name = <?=$user_name; ?>
</script>
<script src="/vendors/index.js"></script>
<!--<script src="/vendors/shareTheScreen.js"></script>-->
<script>
	$('#share').hide();
	$('#stopshare').hide();
	window.addEventListener("beforeunload", function (e) {
		var confirmationMessage = 'It looks like you have been editing something. '
				+ 'If you leave before saving, your changes will be lost.';
		
		(e || window.event).returnValue = confirmationMessage;
		return confirmationMessage;
	});
</script>

<?= $this->endSection() ?>
