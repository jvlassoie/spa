<?php foreach ($donnees as $key => $value): ?>
	<form action="" method="POST" class="form-horizontal">
		<fieldset>
			<legend>Modification</legend>
			<div class="form-group">
				<label for="name" class="col-lg-2 control-label">Nom de l'Animal</label>
				<div class="col-lg-10">
					<input type="text" name="name" id="name" class="form-control" value=<?= $value->AnimalsName ?> require/>
				</div>
			</div>

			<div class="form-group">
				<label for="status" class="col-lg-2 control-label">Disponibilité</label>
				<div class="col-lg-10">
					<select name="status" class="form-control" id="status">
						<?php if($value->AnimalsStatus == 1): ?>
						<option value="1" selected>Disponible</option>
						<option value="0">Indisponible</option>
						<?php else: ?>
						<option value="1">Disponible</option>
						<option value="0" selected>Indisponible</option>

					<?php endif ?>
					</select>
					<br>
				</div>
			</div>

			<div class="form-group">
				<label for="dateArrived" class="col-lg-2 control-label">Date d'arrivée</label>
				<div class="col-lg-10">
					<input type="date" name="dateArrived" id="dateArrived" class="form-control" value=<?= $value->AnimalsDateArrived ?> require/>
				</div>
			</div>

			<div class="form-group">
				<label for="description" class="col-lg-2 control-label">Description</label>
				<div class="col-lg-10">
					<input type="text" name="description" id="description" class="form-control" value=<?= $value->AnimalsDescription ?> require/>
				</div>
			</div>	


			<div class="form-group">
				<label for="age" class="col-lg-2 control-label">Age</label>
				<div class="input-group col-lg-2">	
					<input type="number" name="age" id="age" class="form-control" value=<?= $value->AnimalsAge ?> require/>
					<span class="input-group-addon">Année(s)</span>
				</div>
			</div>	

			<div class="form-group">
				<label for="esp" class="col-lg-2 control-label">Espèce</label>
				<div class="col-lg-10">
					<select name="idSpecie" class="form-control" id="esp">
						<option value=<?= $value->SpeciesId ?> ><?= $value->SpeciesName ?></option>
						<?php foreach ($listeSpecies as $keySpe => $valueSpe) { ?>
						<?php if($valueSpe->id != $value->SpeciesId): ?>
							<option value="<?= $valueSpe->id ?>"><?= $valueSpe->name ?></option>
						<?php  endif ?>
						<?php } ?>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label for="selectRace" class="col-lg-2 control-label">Race</label>
				<div class="col-lg-10">
					<select name="idBreed" class="form-control" id="selectRace">
						<option value=<?= $value->BreedsId ?> ><?= $value->BreedsName ?></option>
						<?php foreach ($listeBreeds as $keyBre => $valueBre) { ?>
						<?php if($valueBre->id != $value->BreedsId): ?>
							<option value="<?= $valueBre->id ?>"><?= $valueBre->name ?></option>
						<?php  endif ?>
						<?php } ?>
					</select>
					<br>
				</div>
			</div>


			<div class="form-group">
				<div class="col-lg-10 col-lg-offset-2">
					<button type="submit" class="btn btn-primary">Créer</button>
				</div>
			</div>
		</fieldset>
	</form>
<?php  endforeach ?>