<!-- TABLE STRIPED -->
<div class="panel">
	<div class="panel-heading">
		<h3 class="panel-title">Department List</h3>
	</div>
	<div class="panel-body">

	    <a class="btn btn-primary" href="<?php echo site_url('departments/create'); ?>" >New Department</a>

		<table class="table table-striped">
			<thead>
				<tr>
					<th>#</th>
					<th>Department Name</th>
					<th>Department Description</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				
				<?php 

				foreach ($records as $key => $value) {
					
				?>

				<tr>
					<td><?php echo $value->department_id; ?></td>
					<td><?php echo $value->department_name; ?></td>
					<td><?php echo $value->department_description ?></td>
					<td>
						
					<a class="btn btn-warning" href="<?php echo site_url('departments/edit/'.$value->department_id); ?>">Edit</a>

					
					<?php echo form_open('departments/delete'); ?>

					<button type="submit" class="btn btn-danger delete">Delete</button>
					
					<?php echo form_hidden('department_id',$value->department_id); ?>
					
					<?php echo form_close(); ?>



					</td>
				</tr>

				<?php } ?>
				
			</tbody>
		</table>
	</div>
</div>
<!-- END TABLE STRIPED -->