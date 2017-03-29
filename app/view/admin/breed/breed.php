<table class="table table-striped">
	<thead>
		<tr>
			<th>Name</th>
			<th>Specie</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<a href='/breed/create/' class='btn btn-success btn-lg pull-right'>create</a> 
		<br/>

		<?php
		foreach ($a as $key => $value) {
		?>
			<tr>
				<td><?= $value->BreedsName ?></td>
				<td><?= $value->SpeciesName ?></td>
				<td>
					<a href="/breed/update/<?= $value->id ?>" class='btn btn-primary'>Edit</a> 
					<a href="/breed/view/delete/<?= $value->id ?>" class='btn btn-danger' onclick='return confirmDelete()'>Delete</a>
				</td>
			</tr>
		<?php
			}

		?>
	</tbody>
</table>



