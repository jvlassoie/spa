<ul class="pagination">
	<?php for($i=1;$i<= $pagination->pages;$i++): ?>
		<li><a href=<?= '/'.$controller.'/view/'.((!empty($parameters))?$parameters[0]:'DESC').'/'.$i ?> ><?= $i ?></a></li>
	<?php endfor; ?>
</ul>