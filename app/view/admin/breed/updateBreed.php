<form action="" method="POST" class="form-horizontal">
	<fieldset>
		<legend>Modification</legend>
		<div class="form-group">
			<label for="name" class="col-lg-2 control-label">Nom de la race</label>
			<div class="col-lg-10">
				<input type="text" name="name" id="name" value="<?= $donnees[0]->BreedsName ?>" class="form-control" require/>
			</div>
		</div>
		
		<div class="form-group">
			<label for="select" class="col-lg-2 control-label">Nom de l'espèce</label>
			<div class="col-lg-10">
				<select name="idSpecie" class="form-control" id="select">
					<option value="<?= $donnees[0]->SpeciesId ?>"><?= $donnees[0]->SpeciesName ?></option>
					<?php foreach ($listeSpecies as $key => $value): ?>
					<?php if ($value->id != $donnees[0]->SpeciesId): ?>
						<option value="<?= $value->id ?>"><?= $value->name ?></option>
					<?php endif; ?>
					<?php endforeach ?>
				</select>
				<br>
			</div>
		</div>
		<div class="form-group">
			<div class="col-lg-10 col-lg-offset-2">
				<button type="submit" class="btn btn-primary">Modifier</button>
			</div>
		</div>
	</fieldset>
</form>