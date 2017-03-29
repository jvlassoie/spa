<table class="table table-striped">
	<thead>
		<tr>
			<th>Name</th>
			<th>Status</th>
			<th>DateArrived</th>
			<th>Description</th>
			<th>Breed Name</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<a href='/animal/create/' class='btn btn-success btn-lg pull-right'>create</a> 
		<br/>

		<?php
		// echo "<pre>";
		// print_r($a);
		// echo "</pre>";
		foreach ($a as $key => $value) {
		?>
			<tr>
				<td><?= $value->AnimalsName ?></td>
				<td><?= $value->AnimalsStatus ?></td>
				<td><?= $value->AnimalsDateArrived ?></td>
				<td><?= $value->AnimalsDescription ?></td>
				<td><?= $value->BreedsName ?></td>
				<td>
					<a href="/animal/update/<?= $value->id ?>" class='btn btn-primary'>Edit</a> 
					<a href="/animal/view/delete/<?= $value->id ?>" class='btn btn-danger' onclick='return confirmDelete()'>Delete</a>
				</td>
			</tr>
		<?php
			}

		?>
	</tbody>
</table>



