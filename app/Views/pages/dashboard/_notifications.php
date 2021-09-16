<p class="text-muted">Get up to date with all the latest activities on your iGov account.</p>
<div class="card-box" style="border-radius: 10px">
  <h4 class="header-title mb-3">Recent <span class="text-muted">Activities</span></h4>
  <div class="list-group">
    <?php if (empty($notifications)): ?>
      No recent activities
    <?php else: ?>
    <?php foreach ($notifications as $notification):?>
      <a href="javascript:void(0)" class="list-group-item list-group-item-action">
        <div class="d-flex w-100 justify-content-between">
          <h5 class="mb-1"><?=$notification['subject']?></h5>
          <small>
            <?php $date = date_create($notification['created_at']);
            echo date_format($date,"d M Y H:i a");
            ?>
          </small>
        </div>
        <p class="mb-1"><?=$notification['body']?></p>
        <small><?=$notification['cta']?></small>
      </a>
    <?php endforeach;?>
    <?php endif;?>
  </div>
</div>