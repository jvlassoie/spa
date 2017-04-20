<div id="HTMLtoPDF">
<ul class="list-group">
	<li class="list-group-item"><h4>Nombre d'Animaux : <?= $nbAnimal->Counter ?></h4></li>
	<?php foreach ($nbAnimalBySpecie as $key => $value): ?>
		<?php if ($value > 0): ?>
			<li class="list-group-item"><h5><?= $key.' : '.$value  ?></h5></li>
		<?php endif; ?>
	<?php endforeach; ?>
</ul>

<h1>Total Animals</h1>
<div class="progress progress-striped active">
	<div class="progress-bar progress-bar-success" style="width: 100%"></div>
</div>
<p class="lead pull-right">100%</p></br>

<?php foreach ($nbAnimalBySpecie as $key => $value): ?>
	<?php if ($value > 0): ?>
	</br>
	<h3><?= $key ?></h3>
	<div class="progress progress-striped active">
		<div class="progress-bar progress-bar-success" style="width: <?= $value*100/$nbAnimal->Counter ?>%"></div>
	</div>
	<p class="lead pull-right"><?= $value*100/$nbAnimal->Counter ?>%</p>
<?php endif; ?>
<?php endforeach; ?>
</div>

<a href="#" class='btn btn-primary' onclick="HTMLtoPDF()">Download PDF</a>