<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Create Employee</h3>
								</div>
								<div class="panel-body">

									<?php

									 //paparkan notice kalau ada validation error 

									if(validation_errors())
									{

									?>

									<div class="alert alert-danger alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<i class="fa fa-times-circle"></i> Please fix the form error below
									</div>

									<?php } ?>
									
									<!-- open form -->

									<?php echo form_open('employees/create'); ?>

									<div class="form-group">
										
										<?php 

										echo form_label('First Name', 'employee_name');	
										echo form_input('first_name',set_value('first_name'),'class="form-control"');
										echo form_error('first_name', '<p class="text-danger">', '</p>');
										?>

									</div>

									<div class="form-group">
										
										<?php 

										echo form_label('Last Name', 'last_name');	
										echo form_input('last_name',set_value('last_name'),'class="form-control"');
										echo form_error('last_name', '<p class="text-danger">', '</p>');
										?>

									</div>

									<div class="form-group">
										
										<?php 

										echo form_label('Department', 'department_id');	
										echo form_dropdown('department_id', $department_records, set_value('department_id'),'class="form-control"');
										echo form_error('department_id', '<p class="text-danger">', '</p>');
										?>

									</div>

									<div class="form-group">
										<?php 

										echo form_label('Profile Picture', 'profile_picture');

										?>
										<div id="upload"></div>

										<div id="upload_preview"></div>

									</div>

									<button type="submit" class="btn btn-warning">Submit</button>

									<a href="<?php echo site_url('employees/index'); ?>" class="btn btn-default">Cancel</a>

									<?php echo form_close(); ?>

									<!-- end form -->
									
								</div>
							</div>