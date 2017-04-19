<table class="table table-striped">
	<thead>
		<tr>
			<th>Name</th>
			<th>Status</th>
			<th>DateArrived</th>
			<th>Description</th>
			<th>Age</th>
			<th>Breed Name</th>
			<th>Specie Name</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php
			include_once('../app/view/public/shorting.php');
		?>
		<a href='/animal/create/' class='btn btn-success btn-lg pull-right'>create</a> 
		<br/>

		<?php

		foreach ($a as $key => $value) {
			?>
			<tr>
				<td><?= $value->AnimalsName ?></td>
				<td><?= ($value->AnimalsStatus == 1)?"Disponible":"Indisponible" ; ?></td>
				<td><?= $value->AnimalsDateArrived ?></td>
				<td><?= $value->AnimalsDescription ?></td>
				<td><?= ($value->AnimalsAge == null or 0)?"Age inconnu":$value->AnimalsAge; ?></td>
				<td><?= $value->SpeciesName ?></td>
				<td><?= $value->BreedsName ?></td>
				<td>
					<a href="/animal/update/<?= $value->AnimalsId ?>" class='btn btn-primary'>Edit</a> 
					<a href="/animal/delete/<?= $value->AnimalsId ?>" class='btn btn-danger' onclick='return confirmDelete()'>Delete</a>
				</td>
			</tr>
			<?php
		}

		?>
	</tbody>
</table>

<?php
include('../app/view/public/pagination.php');
?>




