<table class="table table-striped">
	<thead>
		<tr>
			<th>Name</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<a href='/role/create/' class='btn btn-success btn-lg pull-right'>create</a> 
		<br/>

		<?php
		foreach ($a as $key => $value) {
		?>
			<tr>
				<td><?= $value->name ?></td>
				<td>
					<a href="/role/update/<?= $value->id ?>" class='btn btn-primary'>Edit</a> 
					<a href="/role/view/delete/<?= $value->id ?>" class='btn btn-danger' onclick='return confirmDelete()'>Delete</a>
				</td>
			</tr>
		<?php
			}

		?>
	</tbody>
</table>



