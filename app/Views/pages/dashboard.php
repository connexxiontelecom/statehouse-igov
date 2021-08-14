<?= $this->extend('layouts/master') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
	<!-- start page title -->
	<div class="row">
		<div class="col-12">
			<div class="page-title-box">
				<div class="page-title-right">
          <span class="text-muted">
						<?php $date = date_create(date('d M Y'));
						echo date_format($date,"l, d F Y");
						?>
          </span>
				</div>
				<h4 class="page-title">Good morning, <?=session()->user_name?>!</h4>
        <p class="text-muted mt-n2">Here is what is happening in your IGOV account today.</p>
			</div>
		</div>
	</div>
  <div class="mt-3">
    <ul class="nav nav-tabs nav-bordered bg-light">
      <li class="nav-item">
        <a href="#home1" data-toggle="tab" aria-expanded="false" class="nav-link active" style="background-color: transparent !important;">
          Overview
        </a>
      </li>
      <li class="nav-item">
        <a href="#profile1" data-toggle="tab" aria-expanded="true" class="nav-link" style="background-color: transparent !important;">
          Profile
        </a>
      </li>
      <li class="nav-item">
        <a href="#messages1" data-toggle="tab" aria-expanded="false" class="nav-link" style="background-color: transparent !important;">
          Messages
        </a>
      </li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane fade show active" id="home1">
        <p>Home Vakal text here dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>
        <p class="mb-0">Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p>
      </div>
      <div class="tab-pane fade" id="profile1">
        <p>Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p>
        <p class="mb-0">Vakal text here dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>
      </div>
      <div class="tab-pane" id="messages1">
        <p>Vakal text here dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>
        <p class="mb-0">Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p>
      </div>
    </div>
  </div>
	<!-- end page title -->
</div> <!-- container -->
<?= $this->endSection() ?>
