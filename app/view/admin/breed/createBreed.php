<form action="" method="POST" class="form-horizontal">
	<fieldset>
		<legend>Création</legend>
		<div class="form-group">
			<label for="name" class="col-lg-2 control-label">Nom de la race</label>
			<div class="col-lg-10">
				<input type="text" name="name" id="name" class="form-control" require/>
			</div>
		</div>
		
		<div class="form-group">
			<label for="select" class="col-lg-2 control-label">Nom de l'espèce</label>
			<div class="col-lg-10">
				<select name="idSpecie" class="form-control" id="select">
					<?php foreach ($listeSpecies as $key => $value) { ?>
					<option value="<?= $value->id ?>"><?= $value->name ?></option>
					<?php } ?>
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