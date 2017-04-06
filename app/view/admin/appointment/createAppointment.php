<?php

Debug::debugP($race);
?>
<form action="" method="POST" class="form-horizontal">
	<fieldset>
		<legend>Création</legend>
		<div class="form-group">
			<label for="dateOfApp" class="col-lg-2 control-label">Date</label>
			<div class="col-lg-10">
				<input type="date" name="dateOfApp" id="dateOfApp" class="form-control" require/>
			</div>
		</div>

		<div class="form-group">
			<label for="TimeOfApp" class="col-lg-2 control-label">Heure</label>
			<div class="col-lg-10">
				<input type="time" name="timeOfApp" id="timeOfApp" class="form-control" require/>
			</div>
		</div>

		<div class="form-group">
			<label for="status" class="col-lg-2 control-label">Confirmation</label>
			<div class="col-lg-10">
				<select name="status" class="form-control" id="status">
					<option value="1">Confirmé</option>
					<option value="0">Non Confirmé</option>
				</select>
				<br>
			</div>
		</div>

		<div class="form-group">
			<label for="idUser" class="col-lg-2 control-label">User</label>
			<div class="col-lg-10">
				<select name="idUser" class="form-control" id="idUser">
					<option value="" >--Choisissez un User</option>
					<?php foreach ($user as $key => $value): ?>
						<option value="<?= $value->UsersId ?>"><?= $value->UsersName ?></option>
					<?php endforeach ?>
				</select>
				<br>
			</div>
		</div>

		<div class="form-group">
			<label for="idRace" class="col-lg-2 control-label">Choisir votre/vos animeaux à voir</label>
			<div class="col-lg-5">
				<select name="idUser" class="form-control" id="esp">
					<option value="" >--Choisissez une Race</option>
					<?php foreach ($race as $key => $value): ?>
						<option value=<?= $value->id ?> ><?= $value->name ?></option>
					<?php endforeach ?>
				</select>
			</div>
			<div class="col-lg-5">
				<select name="idUser" class="form-control" id="selectRace">
					<option value="" >--Choisissez une Espèce</option>
				</select>
			</div>
			<br>
		</div>


		<div class="form-group">
			<div class="col-lg-10 col-lg-offset-2">
				<button type="submit" class="btn btn-primary">Crée</button>
			</div>
		</div>
	</fieldset>
</form>