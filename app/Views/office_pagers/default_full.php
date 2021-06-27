

<div class="row">
	<div class="col-4 offset-3">
		<ul class="pagination pagination-rounded justify-content-end mb-3">
			
			<li class="page-item">
				<a class="page-link" href="<?= $pager->getFirst() ?>" aria-label="<?= lang('Pager.first') ?>">
					<span aria-hidden="true">«</span>
					<span class="sr-only"><?= lang('Pager.first') ?></span>
				</a>
			</li>
			<?php if ($pager->hasPrevious()) : ?>
			<li class="page-item">
				<a class="page-link" href="<?= $pager->getFirst() ?>" aria-label="<?= lang('Pager.first') ?>">
					<span aria-hidden="true">«</span>
					<span class="sr-only"><?= lang('Pager.first') ?></span>
				</a>
			</li>
				
				<li class="page-item">
					<a class="page-link" href="<?= $pager->getPrevious() ?>" aria-label="<?= lang('Pager.previous') ?>">
						<span aria-hidden="true">«</span>
						<span class="sr-only"><?= lang('Pager.previous') ?></span>
					</a>
				</li>
			
			<?php endif; ?>
			
			
			<?php foreach ($pager->links() as $link) : ?>
				<li <?= $link['active'] ? 'class="page-item active"' : 'class="page-item"' ?>>
					<a class="page-link" href="<?= $link['uri'] ?>">
						<?= $link['title'] ?>
					</a>
				</li>
			<?php endforeach ?>
			
			<?php if ($pager->hasNext()) : ?>
				<li class="page-item">
					<a class="page-link" href="<?= $pager->getNext() ?>" aria-label="<?= lang('Pager.next') ?>">
						<span aria-hidden="true">»</span>
						<span class="sr-only"><?= lang('Pager.next') ?></span>
					</a>
				</li>
				
				
			
			<?php endif; ?>
			<li class="page-item">
				<a class="page-link" href="<?= $pager->getLast() ?>" aria-label="<?= lang('Pager.last') ?>">
					<span aria-hidden="true">»</span>
					<span class="sr-only"><?= lang('Pager.last') ?></span>
				</a>
			</li>
		</ul>
	</div> <!-- end col-->
</div>
