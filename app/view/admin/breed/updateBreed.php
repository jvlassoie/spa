<!DOCTYPE html>
<form action="" method="POST">
	<div class="form-group">
		<input type="text" name="name" value="<?= $donnees[0]->name ?>" class="form-control" require/>
	</div>
	<div class="form-group">
		<input type="number" name="idSpecie" value="<?= $donnees[0]->idSpecie ?>" class="form-control" require/>
	</div>
	<button type="submit" class="btn btn-primary">Modifier</button>
</form>

