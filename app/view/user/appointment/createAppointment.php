<form action="" method="POST" class="form-horizontal">
	<fieldset>
		<legend>Création</legend>
		<div class="form-group">
			<label for="datepicker" class="col-lg-2 control-label">Date</label>
			<div class="col-lg-10">
				<input type="text" name="dateOfApp" id="datepicker" class="form-control" require/>
			</div>
		</div>

		<div class="form-group">
			<label for="timepicker" class="col-lg-2 control-label">Heure</label>
			<div class="col-lg-10">
				<input type="text" name="timeOfApp" id="timepicker" class="form-control" require/>
			</div>
		</div>

		<div class="form-group">
			<label for="idRace" class="col-lg-2 control-label">Choisir votre/vos animeaux à voir</label>
			<div class="col-lg-5">
				<select name="idSpecie" class="form-control" id="esp">
					<option value="" >--Choisissez une Espèce</option>
					<?php foreach ($race as $key => $value): ?>
						<option value=<?= $value->id ?> ><?= $value->name ?></option>
					<?php endforeach ?>
				</select>
			</div>
			<div class="col-lg-5">
				<select name="idBreed" class="form-control" id="selectRace">
					<option value="" >--Choisissez une Race</option>

				</select>
			</div>
			<br>
		</div>

		<legend>Liste des Animaux</legend>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Nom</th>
					<th>Description</th>
					<th>Age</th>
					<th>Action</th>

				</tr>
			</thead>
			<tbody id="selectAnimal">


			</tbody>
		</table>

		<legend>Liste des Animaux Selectionnés</legend>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Nom</th>
					<th>Description</th>
					<th>Age</th>
					<th>Action</th>

				</tr>
			</thead>
			<tbody id="selectedAnimals">



			</tbody>
		</table>

		<div id="addListAnimals">
			
		
		</div>
		
		<div class="form-group">
			<div class="col-lg-10 col-lg-offset-2">
				<button type="submit" class="btn btn-primary">Crée</button>
			</div>
		</div>
	</fieldset>
</form>