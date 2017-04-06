<form action="" method="POST" class="form-horizontal">
	<fieldset>
		<legend>Modifier</legend>
		<div class="form-group">
			<label for="name" class="col-lg-2 control-label">Nom de l'espèce</label>
			<div class="col-lg-10">
				<input type="text" name="name" value="<?= $donnees[0]->name ?>" class="form-control" require/>
			</div>
		</div>
		<div class="col-lg-10 col-lg-offset-2">
			<button type="submit" class="btn btn-primary">Modifier</button>
		</div>
	</fieldset>
</form>
