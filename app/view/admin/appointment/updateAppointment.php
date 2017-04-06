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
			<label for="idUser" class="col-lg-2 control-label">Choisir votre/vos animeaux à voir</label>
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
			<div class="col-lg-10 col-lg-offset-2">
				<button type="submit" class="btn btn-primary">Modifier</button>
			</div>
		</div>
	</fieldset>
</form>