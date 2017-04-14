<ul class="pagination">
	<?php for($i=1;$i<= $pagination->pages;$i++): ?>
		<li><a href=<?= '/'.$controller.'/view/'.$i ?> ><?= $i ?></a></li>
	<?php endfor; ?>
</ul>