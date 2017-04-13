<form action="" method="POST" class="form-horizontal">
	<fieldset>
		<legend>Modification</legend>

		<div class="form-group">
			<label for="dateOfApp" class="col-lg-2 control-label">Date</label>
			<div class="col-lg-10">
				<input type="date" name="dateOfApp" id="dateOfApp" class="form-control" value=<?= $donnees[0]->AppointmentsDateOfApp ?> require/>
			</div>
		</div>

		<div class="form-group">
			<label for="TimeOfApp" class="col-lg-2 control-label">Heure</label>
			<div class="col-lg-10">
				<input type="time" name="timeOfApp" id="timeOfApp" class="form-control"  value=<?= $donnees[0]->AppointmentsTimeOfApp ?>  require/>
			</div>
		</div>

		<div class="form-group">
			<label for="status" class="col-lg-2 control-label">Confirmation</label>
			<div class="col-lg-10">
				<select name="status" class="form-control" id="status">
					<?php if($donnees[0]->AppointmentsStatus == 1): ?>
						<option value="1" selected>Confirmé</option>
						<option value="0">Non Confirmé</option>
					<?php else: ?>
						<option value="1">Confirmé</option>
						<option value="0" selected>Non Confirmé</option>

					<?php endif ?>
				</select>
				<br>
			</div>
		</div>

		<div class="form-group">
			<label for="idUser" class="col-lg-2 control-label">User</label>
			<div class="col-lg-10">
				<select name="idUser" class="form-control" id="idUser">
					<option value="<?= $donnees[0]->UsersId ?>"><?= $donnees[0]->UsersName ?></option>
					<?php foreach ($user as $key => $value): ?>
						<?php if($value->UsersId != $donnees[0]->UsersId): ?>
							<option value="<?= $value->UsersId ?>" ><?= $value->UsersName ?></option>
						<?php  endif ?>
					<?php endforeach ?>
				</select>
				<br>
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
			<? foreach($donnees as $key => $value): ?>
				<tr>
				<input type="hidden" value= <?= $value->AnimalsId  ?> >
					<td>  <?= $value->AnimalsName ?> </td>
					<td> <?= $value->AnimalsDescription ?> </td>
					<td> <?= $value->AnimalsAge ?> </td>
					<td><button class="btn btn-danger" id="RemoveAnimal" type="button">Remove</button></td>
				</tr>
			<? endforeach; ?>

			</tbody>
		</table>

		<div id="addListAnimals">
			<? foreach($donnees as $key => $value): ?>
			<input type='hidden' name='listAnimals[]' value= <?= $value->AnimalsId  ?> />
			<? endforeach; ?>

		</div>
		

		<div class="form-group">
			<div class="col-lg-10 col-lg-offset-2">
				<button type="submit" class="btn btn-primary">Modifier</button>
			</div>
		</div>
	</fieldset>
</form>