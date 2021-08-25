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
							<li class="breadcrumb-item active">Meeting</li>
						</ol>
					</div>
					<h4 class="page-title"> Meeting</h4>
				</div>
			</div>
		</div>
		<!-- end page title -->
		
		
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-body">
						
						<div class="row">
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
												<p class="join-info-text">AppID</p>
												<input id="appid" type="text" placeholder="enter appid" required>
												<p class="tips">If you don`t know what is your appid, checkout <a href="https://docs.agora.io/en/Agora%20Platform/terms?platform=All%20Platforms#a-nameappidaapp-id">this</a></p>
											</div>
											<div class="col-sm">
												<p class="join-info-text">Token(optional)</p>
												<input id="token" type="text" placeholder="enter token">
												<p class="tips">If you don`t know what is your token, checkout <a href="https://docs.agora.io/en/Agora%20Platform/terms?platform=All%20Platforms#a-namekeyadynamic-key">this</a></p>
											</div>
											<div class="col-sm">
												<p class="join-info-text">Channel</p>
												<input id="channel" type="text" placeholder="enter channel name" required>
												<p class="tips">If you don`t know what is your channel, checkout <a href="https://docs.agora.io/en/Agora%20Platform/terms?platform=All%20Platforms#channel">this</a></p>
											</div>
										</div>
										
										<div class="button-group">
											<button id="join" type="submit" class="btn btn-primary btn-sm">Join</button>
											<button id="leave" type="button" class="btn btn-primary btn-sm" disabled>Leave</button>
										</div>
									</form>
									
									<div class="row video-group">
										<div class="col">
											<p id="local-player-name" class="player-name"></p>
											<div id="local-player" class="player"></div>
										</div>
										<div class="w-100"></div>
										<div class="col">
											<div id="remote-playerlist"></div>
										</div>
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
<script src="/vendors/index.js"></script>

<?= $this->endSection() ?>
