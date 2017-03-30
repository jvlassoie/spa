<form action="" method="POST">
	<div class="form-group">
		<input type="text" name="name" value="<?= $donnees[0]->BreedsName ?>" class="form-control" require/>
	</div>
	<div class="form-group">
		<select name="idSpecie">
			<option value="<?= $donnees[0]->SpeciesId ?>"><?= $donnees[0]->SpeciesName ?></option>
			<?php foreach ($listeSpecies as $key => $value) { ?>
			<?php if ($value->id != $donnees[0]->SpeciesId): ?>
				<option value="$value->id"><?= $value->name ?></option>
			<?php endif; ?>
			<?php } ?>
		</select>
	</div>
	<button type="submit" class="btn btn-primary">Modifier</button>
</form>

